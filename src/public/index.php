<?php
require_once __DIR__ . '/../../src/utenti/controllers/utenti.controller.php';

$utentiController = new UtentiController();
$users = $utentiController->getAllUser();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nome' => $_POST['nome'],
        'email' => $_POST['email']
    ];
    $utentiController->registerUser($data);
    header('Location: ./index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = [
        'id' => $_POST['id'],
        'newValue' => $_POST['newValue']
    ];
    $utentiController->updateName($data);
    header('Location: ./index.php');
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Utenti</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input,
        button {
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Lista Utenti</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['nome'] ?></td>
                    <td><?= $user['email'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Registra Nuovo Utente</h2>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Registra</button>
        </form>

        <h2>Aggiorna Nome Utente</h2>
        <form method="PUT">
            <input type="hidden" name="_method" value="PUT">
            <input type="number" name="id" placeholder="ID Utente" required>
            <input type="text" name="newValue" placeholder="Nuovo Nome" required>
            <button type="submit">Aggiorna</button>
        </form>
    </div>
</body>

</html>