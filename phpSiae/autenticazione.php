<?php
include("_cred.php");


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

global $host, $db_username, $db_password, $db;

$utente_autenticato = (!isset($_SESSION['codice_accesso']));

?>


<html>

<head>
    <title>Autenticazione</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Area Autenticata</h2>

        <?php if ($utente_autenticato) { ?>
            <div class="float-right">
                <a href="logout.php" class="btn btn-outline-primary">Logout</a>
            </div>

            <h3>Aggiungi Album</h3>
            <form method="post" action="autenticazione.php">
                <div class="form-group">
                    <label for="titolo_album">Titolo Album:</label>
                    <input type="text" class="form-control" id="titolo_album" name="titolo_album" required>
                </div>
                <button type="submit" class="btn btn-success" name="aggiungi_album">Aggiungi Album</button>
            </form>

            <h3>Rimuovi Album</h3>
            <form method="post" action="autenticazione.php">
                <div class="form-group">
                    <label for="id_album">ID Album:</label>
                    <input type="text" class="form-control" id="id_album" name="id_album" required>
                </div>
                <button type="submit" class="btn btn-danger" name="rimuovi_album">Rimuovi Album</button>
            </form>

            <h3>Modifica Titolo Album</h3>
            <form method="post" action="autenticazione.php">
                <div class="form-group">
                    <label for="id_album">ID Album:</label>
                    <input type="text" class="form-control" id="id_album" name="id_album" required>
                </div>
                <div class="form-group">
                    <label for="nuovo_titolo_album">Nuovo Titolo Album:</label>
                    <input type="text" class="form-control" id="nuovo_titolo_album" name="nuovo_titolo_album" required>
                </div>
                <button type="submit" class="btn btn-warning" name="modifica_titolo_album">Modifica Titolo Album</button>
            </form>

            <h3>Aggiungi Canzone</h3>
            <form method="post" action="autenticazione.php">
                <div class="form-group">
                    <label for="id_album_canzione">ID Album:</label>
                    <input type="text" class="form-control" id="id_album_canzione" name="id_album_canzione" required>
                </div>
                <div class="form-group">
                    <label for="titolo_canzione">Titolo Canzone:</label>
                    <input type="text" class="form-control" id="titolo_canzione" name="titolo_canzione" required>
                </div>
                <button type="submit" class="btn btn-success" name="aggiungi_canzione">Aggiungi Canzone</button>
            </form>

            <h3>Rimuovi Canzone</h3>
            <form method="post" action="autenticazione.php">
                <div class="form-group">
                    <label for="id_canzione">ID Canzone:</label>
                    <input type="text" class="form-control" id="id_canzione" name="id_canzione" required>
                </div>
                <button type="submit" class="btn btn-danger" name="rimuovi_canzione">Rimuovi Canzone</button>
            </form>

            <h3>Modifica Titolo Canzone</h3>
            <form method="post" action="autenticazione.php">
                <div class="form-group">
                    <label for="id_canzione">ID Canzone:</label>
                    <input type="text" class="form-control" id="id_canzione" name="id_canzione" required>
                </div>
                <div class="form-group">
                    <label for="nuovo_titolo_canzione">Nuovo Titolo Canzone:</label>
                    <input type="text" class="form-control" id="nuovo_titolo_canzione" name="nuovo_titolo_canzione" required>
                </div>
                <button type="submit" class="btn btn-warning" name="modifica_titolo_canzione">Modifica Titolo Canzone</button>
            </form>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                Accesso non autorizzato. Effettua il login.
            </div>
        <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
