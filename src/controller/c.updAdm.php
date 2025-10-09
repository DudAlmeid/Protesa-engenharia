<?php
    include "../model/connection.php";
	include '../model/cadastro.factory.php';
    include '../model/usuario.factory.php';
    
    $situacao = isset($_POST['situacao']) ? $_POST['situacao'] : 0;
    $updUser = new user();
    if($updUser->edituser($_POST['nome'],$_POST['situacao'],$_POST['login'],$_POST['senha'],$_POST['telefone'], $_POST['cpf']))
    {
        echo'<script> alert("Dados inseridos com sucesso"); window.location.href="/src/view/vw.usuario.php"</script>';
    }
    else
    {
       echo "<script> alert('Erro ao inserir dados, tente novamente'); window.location.href='../view/vw.usuario.php'</script>";
        if(mysqli_connect_errno()){
            trigger_error( mysqli_connect_error());
        }
    }
    
?>