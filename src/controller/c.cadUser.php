<?php
    include "../model/connection.php";
	include '../model/cadastro.factory.php';
    include '../model/usuario.factory.php';
    
    $usuario = new user();
    $userLogin = new Login();

    if($usuario->add($_POST['nome'],$_POST['login'],$_POST['senha'],$_POST['cpf'],$_POST['empresa'],$_POST['telefone'],$_POST['situacao'],$_POST['perfil']))
    {
        echo'<script> alert("Dados inseridos com sucesso"); window.location.href="/src/view/vw.manUsuario.php"</script>';
        header("Location: ../view/vw.manUsuario.php");
    }
    else
    {
       echo "<script> alert('Erro ao inserir dados, tente novamente'); window.location.href='../view/vw.manUsuario.php'</script>";
       if(mysqli_connect_errno()){
        trigger_error( mysqli_connect_error());
        }
    }
?>