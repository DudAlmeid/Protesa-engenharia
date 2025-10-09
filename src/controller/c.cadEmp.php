<?php
    include "../model/connection.php";
	include '../model/cadastro.factory.php';
    include '../model/empresa.factory.php';
    
    $emp = new empresa();

    if($emp->add($_POST['razaosocial'],$_POST['cnpj'],$_POST['situacao']))
    {
        header("Location: ../view/vw.manUsuario.php");
		echo '<script> alert("Dados inseridos com sucesso"); window.location.href="/src/view/vw.manUsuario.php"</script>';
    }
    else
    {
       echo "<script> alert('Erro ao inserir dados, tente novamente'); window.location.href='../view/vw.manUsuario.php'</script>";
       if(mysqli_connect_errno()){
        trigger_error( mysqli_connect_error());
        }
    }
?>