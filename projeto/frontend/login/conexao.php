<?php
// Dados da conexão
$host = "localhost"; // Ou 127.0.0.1 http://localhost:8081/phpmyadmin/   http://localhost:8081/projeto/frontend/menu/menu.php
$password = ""; // 
$database = "forcegym"; 

// Criando a conexão
$conn = new mysqli($host, $user, $password, $database);

// Testando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>