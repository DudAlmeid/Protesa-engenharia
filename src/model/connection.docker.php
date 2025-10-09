<?php
// Configuração para Docker
$db_host = getenv('DB_HOST') ?: 'db';
$db_user = getenv('DB_USER') ?: 'root';
$db_password = getenv('DB_PASSWORD') ?: 'protesa123';
$db_name = getenv('DB_NAME') ?: 'db_protesa';

$con = new mysqli($db_host, $db_user, $db_password, $db_name);

if(mysqli_connect_errno()){
    trigger_error(mysqli_connect_error());
}

// Definir charset para evitar problemas com acentos
mysqli_set_charset($con, "utf8");
?>