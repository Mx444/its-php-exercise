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

    public function POST_Register(array $data)
    {
        if (isset($data['nome']) && isset($data['email'])) {
            try {
                $nome = $data['nome'];
                $email = $data['email'];
                $user = $this->utentiService->register($nome, $email);
                http_response_code(201);
                $_SESSION['success'] = "Utente registrato con successo";
                exit();
            } catch (Exception $error) {
                http_response_code(400);
                $_SESSION['error'] = "Errore nella registrazione";
                header("Location : index.php");
                exit();
            }
        } else {
            http_response_code(400);
            $_SESSION['error'] = "Errore nella registrazione";
            header("Location : index.php");
            exit();
        }
    }

    public function GET_GetAll()
    {
        try {
            $users = $this->utentiService->getAllUser();
            http_response_code(200);
            return $users;
        } catch (Exception $error) {
            http_response_code(400);
            header("Location : index.php");
            exit();
        }
    }
}
