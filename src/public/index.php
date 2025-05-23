<?php
require_once __DIR__ . '/../../src/utenti/controllers/utenti.controller.php';

$utentiController = new UtentiController();
$users = $utentiController->getAllUser();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registerUser'])) {
        $data = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email']
        ];
        $utentiController->registerUser($data);
        header('Location: ./index.php');
        exit();
    }

    if (isset($_POST['updateName'])) {
        $data = [
            'id' => $_POST['id'],
            'newValue' => $_POST['newValue']
        ];
        $utentiController->updateName($data);
        header('Location: ./index.php');
        exit();
    }

    if (isset($_POST['updateEmail'])) {
        $data = [
            'id' => $_POST['id'],
            'newValue' => $_POST['newValue']
        ];
        $utentiController->updateEmail($data);
        header('Location: ./index.php');
        exit();
    }

    if (isset($_POST['deleteUser'])) {
        $data = [
            'id' => $_POST['id']
        ];
        $utentiController->deleteUser($data);
        header('Location: ./index.php');
        exit();
    }

    if (isset($_POST['deleteAll'])) {
        $utentiController->deleteAllUser();
        header('Location: ./index.php');
        exit();
    }
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
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['nome']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Registra Nuovo Utente</h2>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit" name="registerUser">Registra</button>
        </form>

        <h2>Aggiorna Nome Utente</h2>
        <form method="POST">
            <input type="number" name="id" placeholder="ID Utente" required>
            <input type="text" name="newValue" placeholder="Nuovo Nome" required>
            <button type="submit" name="updateName">Aggiorna</button>
        </form>

        <h2>Aggiorna Email Utente</h2>
        <form method="POST">
            <input type="number" name="id" placeholder="ID Utente" required>
            <input type="email" name="newValue" placeholder="Nuova Email" required>
            <button type="submit" name="updateEmail">Aggiorna</button>
        </form>

        <h2>Elimina Utente</h2>
        <form method="POST">
            <input type="number" name="id" placeholder="ID Utente" required>
            <button type="submit" name="deleteUser">Elimina</button>
        </form>

        <h2>Elimina Tutti gli Utenti</h2>
        <form method="POST">
            <button type="submit" name="deleteAll">Elimina Tutti</button>
        </form>

        <?php if (isset($_SESSION['success'])): ?>
            <div style="color: green; margin-top: 20px;">
                <?= $_SESSION['success'] ?>
            </div>
            <?php unset($_SESSION['success']);
            ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div style="color: red; margin-top: 20px;">
                <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']);
            ?>
        <?php endif; ?>

    </div>
</body>

</html>