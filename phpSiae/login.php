<?php
include("_cred.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

global $host, $db_username, $db_password, $db;
session_start();

if (isset($_SESSION['codice_accesso'])) {
    header("Location: autenticazione.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codice_accesso_inserito = $_POST['codice_accesso'];

    $conn = new mysqli($host, $db_username, $db_password, $db);

    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }

    $codice_accesso_inserito = $conn->real_escape_string($codice_accesso_inserito);
    $query = "SELECT * FROM Autore WHERE Codice = '$codice_accesso_inserito'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $_SESSION['codice_accesso'] = $codice_accesso_inserito;
        header("Location: autenticazione.php");
        exit();
    } else {
        $error_message = "Codice d'accesso non valido. Riprova.";
    }

    $conn->close();
}
?>


<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Login</h1>

        <?php
        if (isset($error_message)) {
            echo "<div class='alert alert-danger' role='alert'>$error_message</div>";
        }
        ?>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="codice_accesso">Codice d'accesso</label>
                <input type="text" class="form-control" id="codice_accesso" name="codice_accesso" required>
            </div>
            <button type="submit" class="btn btn-primary">Accedi</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
