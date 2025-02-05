<?php
function validateString(string $data){
    if (!preg_match('/^[a-zA-Z]{3,15}$/', $data)) {
        throw new Exception("Può contenere solo lettere !");
    }
}