<?php
    include "..\model\connection.php";
	include '..\model\cotacao.factory.php';
    include '..\controller\c.login.php';
    require "../template/fct.php";

    if (isset($_POST['idSolicitacao'])) {
    $idSolicitacao = $_POST['idSolicitacao']; 

    $cancela = new cotacao();

    if ($cancela->cancelaSol($idSolicitacao)) {
        // Atualiza status da solicitação
        header("Location: ../view/vw.solicitacao.php");
        exit;
    } else {
        echo "<script> alert('Erro ao inserir dados, tente novamente');</script>";
        if (mysqli_connect_errno()) {
            trigger_error(mysqli_connect_error());
        }
    }
    } else {
        echo "<script>alert('Solicitação inválida');</script>";
    }
?>