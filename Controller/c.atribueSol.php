<?php
    include "..\model\connection.php";
	include '..\model\projeto.factory.php';
    include '..\controller\c.login.php';
    require "../template/fct.php";

    if (isset($_POST['idSolicitacao'])) {
    $idSolicitacao = $_POST['idSolicitacao'];
    $idTec = $_SESSION['id'];
    $status = 2; 
    $situacao = 1;

    $atribue = new projeto();

    if ($atribue->addTec($idTec, $situacao, $status, $idSolicitacao)) {
        // Atualiza status da solicitação
        $atribue->status($status, $idSolicitacao);
        header("Location: ../view/vw.contrato.php");
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