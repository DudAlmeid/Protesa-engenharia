<?php
require_once '../config/session_config.php';
include "../model/connection.php";

if (mysqli_connect_errno()) {
    $_SESSION['erro'] = "Erro de conexão com o MySQL: " . mysqli_connect_error();
    header("Location: ../view/vw.login.php");
    exit();
}

if (isset($_POST['login'])) {
    $login_usuario = mysqli_real_escape_string($con, $_POST['login']);
    $senha_usuario = mysqli_real_escape_string($con, $_POST['senha']);
    
    $sql = "SELECT idUser, nmUser, nmLoginUser, nmSenhaUser, idPerfil, icSituacaoUser, idEmpresa 
            FROM tb_cad_user 
            WHERE nmLoginUser = ? AND nmSenhaUser = ? AND icSituacaoUser = 1";
    
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $login_usuario, $senha_usuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
        
        // CONFIGURAR TODAS AS VARIÁVEIS DE SESSÃO
        $_SESSION['logado'] = true;
        $_SESSION['id'] = $usuario['idUser'];
        $_SESSION['nome'] = $usuario['nmUser'];
        $_SESSION['login'] = $usuario['nmLoginUser'];
        $_SESSION['tipo'] = $usuario['idPerfil'];
        $_SESSION['situacao'] = $usuario['icSituacaoUser'];
        $_SESSION['empresa'] = $usuario['idEmpresa'];
        
        if ($_SESSION['tipo'] == '1') {
            header("Location: ../view/vw.usuario.php");
        } else {
            header("Location: ../view/vw.solicitacao.php");
        }
        exit();
        
    } else {
        $_SESSION['erro'] = "Usuário ou senha incorretos!";
        header("Location: ../view/vw.login.php");
        exit();
    }
}
?>