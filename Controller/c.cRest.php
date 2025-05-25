<?php
    include "..\model\connection.php";
	include '..\model\cotacao.factory.php';
    include '..\model\projeto.factory.php';
    include '..\controller\c.login.php';
    require "../template/fct.php";

    //Solicitacao
    if (isset($_POST['idSol'])) {
    $idSolicitacao = $_POST['idSol']; 

    $rest = new cotacao();

    if ($rest->restSt($idSolicitacao)) {
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

    //Projeto
    if (isset($_POST['idProj'])) {
    $idProj = $_POST['idSolicitacao']; 

    $rest = new projeto();

    if ($rest->restSt($idProj)) {
        // Atualiza status do projeto
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