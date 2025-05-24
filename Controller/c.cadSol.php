<?php

use Vtiful\Kernel\Format;
    include "..\model\connection.php";
    require '..\model\cotacao.factory.php';
    include '..\controller\c.login.php';
    
    $idUser = $_SESSION['id'];
    $empresa = $_SESSION['empresa'];
    $status = 1;
    $dataSol = date('Y-m-d');
    $sol = new cotacao();

    if($sol->addSol($_POST['titulo'],$_POST['descricao'],$status,$dataSol, $idUser, $empresa))
    {
        echo '<script> alert("Solicitação criada com sucesso");</script>';
        header("Location: ../view/vw.solicitacao.php");
    }
    else
    {
       echo "<script> alert('Erro ao inserir dados, tente novamente'); </script>";
       header("Location:../view/vw.solicitacao.php");
       if(mysqli_connect_errno()){
            echo error_log('Erro de conexão:  '.mysqli_connect_errno());
        }
    }
?> 