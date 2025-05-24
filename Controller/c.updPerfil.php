<?php
    include "..\model\connection.php";
	include '..\model\cadastro.factory.php';
    include '..\model\usuario.factory.php';
    
    session_start();

    $idUser = $_SESSION['id'];
    $user = new user();
    $userLogin = new Login();

    if($user->edit($_POST['senha'],$_POST['senhaAntiga'],$_POST['telefone'],$idUser))
    {
        echo'<script> alert("Dados inseridos com sucesso"); window.location.href="../view/vw.contrato.php"</script>';
    }
    else
    {
       echo "<script> alert('Erro ao inserir dados, tente novamente'); window.location.href='../view/vw.perfil.php'</script>";
       if(mysqli_connect_errno()){
        trigger_error( mysqli_connect_error());
        }
    }
?>