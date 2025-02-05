<?php

class UtentiRepository
{
  private PDO $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }


  public function create(string $nome, string $email): int
  {
    $query = "INSERT INTO utenti (nome, email) VALUES (:nome, :email)";
    $stmt = $this->db->prepare($query);
    $stmt->execute(['nome' => $nome, 'email' => $email]);
    return (int) $this->db->lastInsertId() ?: null;
  }

  public function read()
  {
    $query = "SELECT * FROM utenti";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(mode: PDO::FETCH_ASSOC) ?: null;
  }

  public function update($id, $col, $value)
  {
    $query = "UPDATE utenti SET $col = :value WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->execute(['id' => $id, 'value' => $value]);
    return $stmt->rowCount() ?: null;
  }

  public function delete($id)
  {
    $query = "DELETE FROM utenti WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->execute(['id' => $id]);
    return $stmt->rowCount() ?: null;
  }
}
