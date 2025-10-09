<?php
    include "../model/connection.php";
	include '../model/cadastro.factory.php';
    include '../model/usuario.factory.php';
    
    session_start();

    $idUser = $_SESSION['id'];
    $tipoUser = $_SESSION['tipo'];
    $user = new user();
    $userLogin = new Login();

    if($idUser == $_SESSION['id']){
        if($user->edit($_POST['senha'],$_POST['senhaAntiga'],$_POST['telefone'],$idUser))
        {
           // echo'<script> alert("Dados inseridos com sucesso"); window.location.href="/src/view/vw.perfil.php"</script>';
        }
        else
        {
        //echo "<script> alert('Erro ao inserir dados, tente novamente'); window.location.href='../view/vw.perfil.php'</script>";
        if(mysqli_connect_errno()){
            trigger_error( mysqli_connect_error());
            }
        }
    }
    
    if($tipoUser == 1){
        $updUser = new $usuario();
        if($updUser->edituser($_POST['nome'],$_POST['situacao'],$_POST['login'],$_POST['senha'],$_POST['telefone'], $_POST['cpf']))
        {
            //echo'<script> alert("Dados inseridos com sucesso"); window.location.href="/src/view/vw.perfil.php"</script>';
        }
        else
        {
            //echo "<script> alert('Erro ao inserir dados, tente novamente'); window.location.href='../view/vw.perfil.php'</script>";
            if(mysqli_connect_errno()){
                trigger_error( mysqli_connect_error());
            }
        }
    }
?>