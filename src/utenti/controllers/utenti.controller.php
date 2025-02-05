<?php
session_start();
require __DIR__ . '/../providers/utenti.service.php';
require __DIR__ . '/../../../vendor/autoload.php';

class UtentiController
{
    private UtentiService $utentiService;

    public function __construct()
    {
        $this->utentiService = new UtentiService();
    }

    public function registerUser(array $data): never
    {
        if (isset($data['nome']) && isset($data['email'])) {
            try {
                $this->utentiService->register(nome: $data['nome'], email: $data['email']);
                $_SESSION['success'] = "Utente registrato con successo";
            } catch (Exception $error) {
                $_SESSION['error'] = $error->getMessage();
            }
        } else {
            $_SESSION['error'] = "Errore nella registrazione";
        }
        header(header: 'Location: ./index.php');
        exit();
    }

    public function getAllUser(): array
    {
        try {
            return $this->utentiService->getAllUser();
        } catch (Exception $error) {
            $_SESSION['error'] = $error->getMessage();
            return [];
        }
    }

    public function updateName(array $data): never
    {
        if (!isset($data['id']) || !isset($data['newValue'])) {
            $_SESSION['error'] = "Dati mancanti per l'aggiornamento";
            header(header: 'Location: ./index.php');
            exit();
        }

        try {
            $updated = $this->utentiService->updateName(id: $data['id'], newValue: $data['newValue']);
            $_SESSION['success'] = $updated ? "Nome aggiornato con successo" : "Errore nell'aggiornamento del nome";
        } catch (Exception $error) {
            $_SESSION['error'] = $error->getMessage();
        }
        header(header: 'Location: ./index.php');
        exit();
    }

    public function updateEmail(array $data): never
    {
        if (!isset($data['id']) || !isset($data['newValue'])) {
            $_SESSION['error'] = "Dati mancanti per l'aggiornamento";
            header(header: 'Location: ./index.php');
            exit();
        }

        try {
            $updated = $this->utentiService->updateEmail(id: $data['id'], newValue: $data['newValue']);
            $_SESSION['success'] = $updated ? "Email aggiornata con successo" : "Errore nell'aggiornamento dell'email";
        } catch (Exception $error) {
            $_SESSION['error'] = $error->getMessage();
        }
        header(header: 'Location: ./index.php');
        exit();
    }

    public function deleteUser(array $data): never
    {
        if (!isset($data['id'])) {
            $_SESSION['error'] = "ID mancante per eliminare l'utente";
            header(header: 'Location: ./index.php');
            exit();
        }

        try {
            $this->utentiService->deleteUser(id: $data['id']);
            $_SESSION['success'] = "Utente eliminato con successo";
        } catch (Exception $error) {
            $_SESSION['error'] = $error->getMessage();
        }
        header(header: 'Location: ./index.php');
        exit();
    }

    public function deleteAllUser(): never
    {
        try {
            $this->utentiService->deleteAllUser();
            $_SESSION['success'] = "Utenti eliminaticon successo";
        } catch (Exception $error) {
            $_SESSION['error'] = $error->getMessage();
        }
        header(header: 'Location: ./index.php');
        exit();
    }
}
