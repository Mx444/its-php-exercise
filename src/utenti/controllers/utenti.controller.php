<?php
require __DIR__ . '/../providers/utenti.service.php';
require __DIR__ . '/../../../vendor/autoload.php';
 class UtentiController{
    private UtentiService $utentiService;

    public function __construct()
    {
        $this-> utentiService = new UtentiService();
    }

    public function APIRegister(array $data){
        if(isset($data['nome']) && isset($data['cognome'])){
            try{
            $nome = $data['nome'];
            $cognome = $data['cognome'];
            $user = $this->utentiService->register($nome,$cognome);
            http_response_code(201);
            return $user;
            }catch(Exception $error){
                http_response_code(400);
                header("Location : index.php");
                exit();
            }
        }

    }
 }