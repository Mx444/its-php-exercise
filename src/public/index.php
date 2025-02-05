<?php
session_start();

include_once __DIR__ . '/../../src/utenti/controllers/utenti.controller.php';

$utentiController = new UtentiController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nome' => $_POST['nome'],
        'email' => $_POST['email']
    ];
    $utentiController->APIRegister($data);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>

<body>
    <form action="index.php" method="POST">
        <input type="text" name="nome" placeholder="Nome">
        <input type="text" name="email" placeholder="email">
        <button type="submit">Registrati</button>
    </form>
</body>

</html>