<?php
// Dados da conexão
$host = "localhost"; // Ou 127.0.0.1 http://127.0.0.1:8081/phpmyadmin
$user = "root"; // Usuário padrão do 
$password = ""; // 
$database = "forcegym"; 

// Criando a conexão
$conn = new mysqli($host, $user, $password, $database);

// Testando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>