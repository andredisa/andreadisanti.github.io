<?php
include("_cred.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class GestioneAlbum
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function aggiungiAlbum($titolo, $nomeArte, $copertina)
    {
        $query = "INSERT INTO album (Titolo, ID_Autore, Copertina) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $titolo, $nomeArte, $copertina);
        $stmt->execute();
    }

    public function rimuoviAlbum($albumId)
    {
        $query = "DELETE FROM album WHERE ID_Album = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $albumId);
        $stmt->execute();
    }

    public function modificaTitoloAlbum($albumId, $nuovoTitolo)
    {
        $query = "UPDATE album SET Titolo = ? WHERE ID_Album = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $nuovoTitolo, $albumId);
        $stmt->execute();
    }
}

$gestioneAlbum = new GestioneAlbum($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['aggiungi_album'])) {
        $titolo = $_POST['titolo_album'];
        $nomeArte = $_POST['nome_arte'];
        $copertina = $_POST['copertina_album'];
        $gestioneAlbum->aggiungiAlbum($titolo, $nomeArte, $copertina);
    } elseif (isset($_POST['rimuovi_album'])) {
        $albumId = $_POST['album_id'];
        $gestioneAlbum->rimuoviAlbum($albumId);
    } elseif (isset($_POST['modifica_titolo_album'])) {
        $albumId = $_POST['album_id'];
        $nuovoTitolo = $_POST['nuovo_titolo_album'];
        $gestioneAlbum->modificaTitoloAlbum($albumId, $nuovoTitolo);
    }
}
?>
<html>
<head>
    <title>Gestione Album</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <form method="post" action="gestioneAlbum.php">
            <div class="form-group">
                <label for="titolo_album">Titolo Album:</label>
                <input type="text" class="form-control" id="titolo_album" name="titolo_album" required>
            </div>
            <div class="form-group">
                <label for="nome_arte">Nome Arte:</label>
                <input type="text" class="form-control" id="nome_arte" name="nome_arte" required>
            </div>
            <div class="form-group">
                <label for="copertina_album">URL Copertina Album:</label>
                <input type="text" class="form-control" id="copertina_album" name="copertina_album" required>
            </div>
            <button type="submit" class="btn btn-primary" name="aggiungi_album">Aggiungi Album</button>
        </form>

        <form method="post" action="gestioneAlbum.php">
            <div class="form-group">
                <label for="album_id">ID Album da Rimuovere:</label>
                <input type="text" class="form-control" id="album_id" name="album_id" required>
            </div>
            <button type="submit" class="btn btn-danger" name="rimuovi_album">Rimuovi Album</button>
        </form>

        <form method="post" action="gestioneAlbum.php">
            <div class="form-group">
                <label for="album_id">ID Album da Modificare:</label>
                <input type="text" class="form-control" id="album_id" name="album_id" required>
            </div>
            <div class="form-group">
                <label for="nuovo_titolo_album">Nuovo Titolo Album:</label>
                <input type="text" class="form-control" id="nuovo_titolo_album" name="nuovo_titolo_album" required>
            </div>
            <button type="submit" class="btn btn-warning" name="modifica_titolo_album">Modifica Titolo Album</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
