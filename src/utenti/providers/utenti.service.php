<?php

require __DIR__ . '/../repositories/utenti.repository.php';
require __DIR__ . '/../../database/config.php';
require __DIR__ . '/../../utilis/regex.utilis.php';
require __DIR__ . '/../../../vendor/autoload.php';
class UtentiService
{
    private  $connection;
    private PDO $db;
    private UtentiRepository $utentiRepository;

    public function __construct()
    {
        $this->connection = new Database();
        $this->db = $this->connection->getConnection();
        $this->utentiRepository = new UtentiRepository($this->db);
    }

    public function register($nome, $email)
    {
        validateString($nome);
        validateString($email);

        try {
            $newUser = $this->utentiRepository->create($nome, $email);
            return $newUser;
        } catch (Exception $error) {
            throw new Exception('Errore registazione' . $error->getMessage());
        }
    }

    public function getAllUser()
    {
        try {
            return $this->utentiRepository->read();
        } catch (Exception $error) {
            throw new Exception('Errore utenti non trovati' . $error->getMessage());
        }
    }
}
