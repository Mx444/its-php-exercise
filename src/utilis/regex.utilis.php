<?php
function validateString(string $nome)
{
    // Controlla che il nome contenga solo lettere (3-15 caratteri)
    if (!preg_match('/^[a-zA-Z]{3,15}$/', $nome)) {
        throw new Exception("Il nome può contenere solo lettere e deve essere lungo tra 3 e 15 caratteri!");
    }
}

function validateEmail(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Email non valida!");
    }
}
