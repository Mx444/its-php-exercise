<?php
session_start();

include_once __DIR__ . '/../../src/utenti/controllers/utenti.controller.php';

$utentiController = new UtentiController();
$getUsers = $utentiController->GET_GetAll();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nome' => $_POST['nome'],
        'email' => $_POST['email']
    ];
    $utentiController->POST_Register($data);
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

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getUsers as $user) : ?>
                <tr>
                    <td><?= $user['nome'] ?></td>
                    <td><?= $user['email'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
</body>

</html>