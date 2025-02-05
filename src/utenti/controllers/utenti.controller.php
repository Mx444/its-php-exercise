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

    public function APIRegister(array $data)
    {
        if (isset($data['nome']) && isset($data['email'])) {
            try {
                $nome = $data['nome'];
                $email = $data['email'];
                $user = $this->utentiService->register($nome, $email);
                http_response_code(201);
                return $user;
            } catch (Exception $error) {
                http_response_code(400);
                header("Location : index.php");
                exit();
            }
        }
    }
}
