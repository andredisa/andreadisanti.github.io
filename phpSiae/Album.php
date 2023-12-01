<?php
include("_cred.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

global $host, $db_username, $db_password, $db;
$conn = new mysqli($host, $db_username, $db_password, $db);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$album_titolo = $_GET['album'];

$query_canzoni = "SELECT canzone.Titolo, canzone.Durata, canzone.Link 
                  FROM album 
                  JOIN canzone ON album.ID_Album = canzone.ID_Album 
                  WHERE album.Titolo = '$album_titolo'";
$result_canzoni = $conn->query($query_canzoni);

?>

<html>
<head>
    <title>
        <?php echo $album_titolo; ?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">
            <?php echo $album_titolo; ?>
        </h2>
        <ul class="list-group">
            <?php while ($row = $result_canzoni->fetch_assoc()) { ?>
                <li class="list-group-item">
                    <h5>
                        <?php echo $row['Titolo']; ?>
                    </h5>
                    <p>Durata:
                        <?php echo $row['Durata']; ?>
                    </p>
                    <br>
                    <a href="<?php echo $row['Link']; ?>" target="_blank" class="btn btn-primary">Ascoltala su YouTube</a>
                </li>
            <?php } ?>
        </ul>
        <div class="text-center">
            <a href="index.php" class="btn btn-secondary">Torna all'Index</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>