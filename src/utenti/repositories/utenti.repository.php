<?php

class UtentiRepository
{
  private PDO $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function create(string $nome, string $email): ?int
  {
    try {
      $query = "INSERT INTO utenti (nome, email) VALUES (:nome, :email)";
      $stmt = $this->db->prepare($query);
      $stmt->execute(['nome' => $nome, 'email' => $email]);
      return (int) $this->db->lastInsertId() ?: null;
    } catch (PDOException $e) {
      return null;
    }
  }

  public function read(): array
  {
    try {
      $query = "SELECT * FROM utenti";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (PDOException $e) {
      return [];
    }
  }

  public function update(int $id, string $col, $value): ?int
  {
    $validColumns = ['nome', 'email'];
    if (!in_array($col, $validColumns)) {
      throw new InvalidArgumentException("Invalid column name");
    }

    try {
      $query = "UPDATE utenti SET $col = :value WHERE id = :id";
      $stmt = $this->db->prepare($query);
      $stmt->execute(['id' => $id, 'value' => $value]);
      return $stmt->rowCount() ?: null;
    } catch (PDOException $e) {
      return null;
    }
  }

  public function delete(int $id): ?int
  {
    try {
      $query = "DELETE FROM utenti WHERE id = :id";
      $stmt = $this->db->prepare($query);
      $stmt->execute(['id' => $id]);
      return $stmt->rowCount() ?: null;
    } catch (PDOException $e) {
      return null;
    }
  }

  public function deleteAll(): ?int
  {
    try {
      $query = "DELETE FROM utenti";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      return $stmt->rowCount() ?: null;
    } catch (PDOException $e) {
      return null;
    }
  }
}
