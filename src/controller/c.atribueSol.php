<?php
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: ../view/vw.login.php');
    exit();
}

include "../model/connection.php";
include '../model/projeto.factory.php';
require "../template/fct.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idSolicitacao'])) {

    $idSolicitacao = intval($_POST['idSolicitacao']);
    $idTec = intval($_SESSION['id']);
    $status = 2; 
    $situacao = 1;

    if ($idSolicitacao <= 0) {
        header("Location: ../view/vw.solicitacao.php?error=invalid_id");
        exit();
    }

    $atribue = new projeto();

    if ($atribue->addTec($idTec, $situacao, $status, $idSolicitacao)) {
        $atribue->status($status, $idSolicitacao);
        header('Location: ../view/vw.contrato.php');
        exit(); 
    } else {
        $erro = $atribue->con->error;
        header("Location: ../view/vw.solicitacao.php?idSolicitacao=$idSolicitacao&error=" . urlencode($erro));
        exit();
    }
}
