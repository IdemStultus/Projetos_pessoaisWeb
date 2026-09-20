<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: /Trabalho%202t/Cadastrar/Login/login.php");
    exit;
}
?>