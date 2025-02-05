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
        $this->utentiRepository = new UtentiRepository(db: $this->db);
    }

    public function register(string $nome, string $email): int|null
    {
        validateString(nome: $nome);
        validateEmail(email: $email);
        try {
            $newUser = $this->utentiRepository->create(nome: $nome, email: $email);
            return $newUser;
        } catch (Exception $error) {
            throw new Exception(message: 'Errore registazione' . $error->getMessage());
        }
    }

    public function getAllUser(): array
    {
        try {
            return $this->utentiRepository->read();
        } catch (Exception $error) {
            throw new Exception(message: 'Errore utenti non trovati' . $error->getMessage());
        }
    }

    public function updateName(int $id, string $newValue): int|null
    {
        validateString(nome: $newValue);
        try {
            $updated = $this->utentiRepository->update(id: $id, col: 'nome', value: $newValue);
            return $updated;
        } catch (Exception $error) {
            throw new Exception(message: 'Errore aggiornamento nome' . $error->getMessage());
        }
    }

    public function updateEmail(int $id, string $newValue): int|null
    {
        validateEmail(email: $newValue);
        try {
            $updated = $this->utentiRepository->update(id: $id, col: 'email', value: $newValue);
            return $updated;
        } catch (Exception $error) {
            throw new Exception(message: 'Errore aggiornamento email' . $error->getMessage());
        }
    }

    public function deleteUser(int $id): int|null
    {
        try {
            $deleted = $this->utentiRepository->delete(id: $id);
            return $deleted;
        } catch (Exception $error) {
            throw new Exception(message: 'Errore eliminazione utente' . $error->getMessage());
        }
    }

    public function deleteAllUser(): int|null
    {
        try {
            $deleted = $this->utentiRepository->deleteAll();
            return $deleted;
        } catch (Exception $error) {
            throw new Exception(message: 'Errore eliminazione utenti' . $error->getMessage());
        }
    }
}
