<?php
$host = "db";  // Nome do serviço no docker-compose.yml
$user = "root";
$password = "protesa123"; 
$database = "db_protesa";

$con = new mysqli($host, $user, $password, $database);

if ($con->connect_error) {
    die("Erro de conexão com o banco de dados: " . $con->connect_error);
}

// Configurar charset para evitar problemas com acentos
$con->set_charset("utf8mb4");
?>