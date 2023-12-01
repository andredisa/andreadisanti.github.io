<?php

include("_cred.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

global $host, $db_username, $db_password, $db;

$conn = new mysqli($host, $db_username, $db_password, $db);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$query_autori_album = "SELECT autore.NomeArte, album.Titolo AS AlbumTitolo, album.Copertina 
                      FROM autore 
                      JOIN album ON autore.ID_Autore = album.ID_Autore";
$result_autori_album = $conn->query($query_autori_album);

$is_logged_in = false;

session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    $is_logged_in = true;
}
?>

<html>
<head>
    <title>Index</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Catalogo Musicale</h2>
        <div class="float-right">
            <?php
            if ($is_logged_in) {
                echo '<a href="gestisci_album.php" class="btn btn-outline-primary">Gestisci Album</a>';
            } else {
                echo '<a href="login.php" class="btn btn-outline-primary">Login</a>';
            }
            ?>
        </div>
        <div class="row">
            <?php while ($row = $result_autori_album->fetch_assoc()) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                    <img src="imgs/<?php echo $row['Copertina']; ?>" class="card-img-top" alt="Copertina">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $row['AlbumTitolo']; ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $row['NomeArte']; ?>
                            </p>
                            <a href="Album.php?album=<?php echo urlencode($row['AlbumTitolo']); ?>"
                                class="btn btn-primary">Visualizza Canzoni</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
