<?php

class UtentiRepository{
    private PDO $db;

   public function __construct(PDO $db) {
        $this->db = $db;
   }


   public function create(string $nome, string $cognome):int {
    $query = "INSERT INTO utenti (nome, cognome) VALUES (:nome, :cognome)";
    $stmt = $this->db->prepare($query);
    $stmt->execute(['nome' => $nome, 'cognome' => $cognome]);
    return (int) $this->db->lastInsertId();
   }

   public function read(){
     $query = "SELECT * FROM utenti";
     $stmt = $this->db->prepare($query);
     $stmt ->execute();
     return $stmt-> fetch(mode: PDO::FETCH_ASSOC) ?: null;
   }

   
}