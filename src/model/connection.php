<?php
// Tentar usar MYSQL_URL primeiro (Railway formato completo)
$mysql_url = getenv('MYSQL_URL');

if ($mysql_url) {
    // Parse da URL: mysql://user:password@host:port/database
    $url_parts = parse_url($mysql_url);
    $host = $url_parts['host'];
    $user = $url_parts['user'];
    $password = $url_parts['pass'];
    $database = ltrim($url_parts['path'], '/');
    $port = $url_parts['port'] ?? 3306;
} else {
    // Usar variáveis individuais (para Railway/produção) ou valores padrão (para desenvolvimento local)
    $host = getenv('DB_HOST') ?: getenv('MYSQLHOST') ?: 'db';
    $user = getenv('DB_USER') ?: getenv('MYSQLUSER') ?: 'root';
    $password = getenv('DB_PASSWORD') ?: getenv('MYSQLPASSWORD') ?: 'protesa123';
    $database = getenv('DB_NAME') ?: getenv('MYSQLDATABASE') ?: 'db_protesa';
    $port = getenv('DB_PORT') ?: getenv('MYSQLPORT') ?: 3306;
}

$con = new mysqli($host, $user, $password, $database, $port);

if ($con->connect_error) {
    die("Erro de conexão com o banco de dados: " . $con->connect_error);
}

// Configurar charset para evitar problemas com acentos
$con->set_charset("utf8mb4");
?>