<?php
require __DIR__ . '/../providers/utenti.service.php';
require __DIR__ . '/../../../vendor/autoload.php';
class UtentiController
{
    private UtentiService $utentiService;

    public function __construct()
    {
        $this->utentiService = new UtentiService();
    }

    public function registerUser(array $data)
    {
        if (isset($data['nome']) && isset($data['email'])) {
            try {
                $nome = $data['nome'];
                $email = $data['email'];
                $this->utentiService->register($nome, $email);
                http_response_code(201);
                $_SESSION['success'] = "Utente registrato con successo";
            } catch (Exception $error) {
                http_response_code(400);
                $_SESSION['error'] = $error->getMessage();
            }
        } else {
            http_response_code(400);
            $_SESSION['error'] = "Errore nella registrazione";
        }
    }

    public function getAllUser()
    {
        try {
            $users = $this->utentiService->getAllUser();
            http_response_code(200);
            return $users;
        } catch (Exception $error) {
            http_response_code(400);
            $_SESSION['error'] = $error->getMessage();
        }
    }

    public function updateName(array $data)
    {
        $id = $data['id'];
        $newValue = $data['$newValue'];
        try {
            $updated = $this->utentiService->updateName($id, $newValue);
            if ($updated) {
                http_response_code(200);
                $_SESSION['success'] = "Nome aggiornato con successo";
            } else {
                http_response_code(400);
                $_SESSION['error'] = "Errore nell'aggiornamento del nome";
            }
        } catch (Exception $error) {
            http_response_code(400);
            $_SESSION['error'] = $error->getMessage();
        }
    }

    public function updateEmail(array $data)
    {
        $id = $data['id'];
        $newValue = $data['newValue'];
        try {
            $updated = $this->utentiService->updateEmail($id, $newValue);
            if ($updated) {
                http_response_code(200);
                $_SESSION['success'] = "Email aggiornata con successo";
            } else {
                http_response_code(400);
                $_SESSION['error'] = "Errore nell'aggiornamento dell'email";
            }
        } catch (Exception $error) {
            http_response_code(400);
            $_SESSION['error'] = $error->getMessage();
        }
    }


    public function deleteUser(array $data)
    {
        $id = $data['id'];
        try {
            $this->utentiService->deleteUser($id);
            http_response_code(200);
            $_SESSION['success'] = "Utente eliminato con successo";
        } catch (Exception $error) {
            http_response_code(400);
            $_SESSION['error'] =  $error->getMessage();
        }
    }
}
