<?php
include("_cred.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class GestioneCanzoni
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function ottieniCanzoniPerIDAlbum($idAlbum)
    {
        $query = "SELECT * FROM canzone WHERE ID_Album = $idAlbum";
        $result = $this->conn->query($query);
        $canzoni = [];

        while ($row = $result->fetch_assoc()) {
            $canzoni[] = $row;
        }

        return $canzoni;
    }
  

    public function aggiornaTitoloCanzone($idCanzone, $nuovoTitolo)
    {
        $query = "UPDATE canzone SET Titolo = '$nuovoTitolo' WHERE ID_Canzone = $idCanzone";
        $this->conn->query($query);
    }

    public function rimuoviCanzone($idCanzone)
    {
        $query = "DELETE FROM canzone WHERE ID_Canzone = $idCanzone";
        $this->conn->query($query);
    }

    public function aggiungiCanzone($idAlbum, $titolo)
    {
        $query = "INSERT INTO canzone (ID_Album, Titolo) VALUES ($idAlbum, '$titolo')";
        $this->conn->query($query);
    }
}
$gestioneCanzoni = new GestioneCanzoni($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['aggiungi_canzone'])) {
        $titolo = $_POST['titolo_canzone'];
        $albumId = $_POST['album_id'];
        $gestioneCanzoni->aggiungiCanzone($titolo, $albumId);
    } elseif (isset($_POST['rimuovi_canzone'])) {
        $canzoneId = $_POST['canzone_id'];
        $gestioneCanzoni->rimuoviCanzone($canzoneId);
    }
}
?>

<html>
<head>
    <title>Gestione Canzoni</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <form method="post" action="gestioneCanzoni.php">
            <div class="form-group">
                <label for="titolo_canzone">Titolo Canzone:</label>
                <input type="text" class="form-control" id="titolo_canzone" name="titolo_canzone" required>
            </div>
            <div class="form-group">
                <label for="album_id">ID Album:</label>
                <input type="text" class="form-control" id="album_id" name="album_id" required>
            </div>
            <button type="submit" class="btn btn-primary" name="aggiungi_canzone">Aggiungi Canzone</button>
        </form>

        <form method="post" action="gestioneCanzoni.php">
            <div class="form-group">
                <label for="canzone_id">ID Canzone da Rimuovere:</label>
                <input type="text" class="form-control" id="canzone_id" name="canzone_id" required>
            </div>
            <button type="submit" class="btn btn-danger" name="rimuovi_canzone">Rimuovi Canzone</button>
        </form>

        <form method="post" action="gestioneCanzoni.php">
            <div class="form-group">
                <label for="canzone_id">ID Canzone da Modificare:</label>
                <input type="text" class="form-control" id="canzone_id" name="canzone_id" required>
            </div>
            <div class="form-group">
                <label for="nuovo_titolo_canzone">Nuovo Titolo Canzone:</label>
                <input type="text" class="form-control" id="nuovo_titolo_canzone" name="nuovo_titolo_canzone" required>
            </div>
            <button type="submit" class="btn btn-warning" name="modifica_titolo_canzone">Modifica Titolo
                Canzone</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>