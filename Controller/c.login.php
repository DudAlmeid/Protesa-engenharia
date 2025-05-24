<?php
    include "../model/connection.php";
    session_start(['cookie_lifetime' => 86400]);

    $_SESSION ['logado'] = false;
    if (mysqli_connect_errno()) {
        echo "Erro de conexão com o MySQLI: ". mysqli_connect_error();
    }

    if (isset($_POST['login'])) 
    {
        $login_usuario = mysqli_real_escape_string($con, $_POST['login']);
        $senha_usuario = mysqli_real_escape_string($con, $_POST['senha']);
        $login = "select nmLoginUser, nmSenhaUser, idPerfil from tb_cad_user where nmLoginUser = '$login_usuario' and nmSenhaUser = '$senha_usuario'";
        $procura = mysqli_query($con, $login);
        $checa_usuario = mysqli_num_rows($procura);
        if ($checa_usuario > 0) {
            $_SESSION ['logado'] = true;
            $tipo = mysqli_fetch_array($procura);
            $_SESSION['tipo'] = $tipo['idPerfil'];
            $_SESSION['login'] = $tipo['nmLoginUser'];
            $_SESSION['senha'] = $tipo['nmSenhaUser'];
            
            if($_SESSION['tipo'] == '1'){
                $login = mysqli_real_escape_string($con, $_SESSION['login']);
                $senha = mysqli_real_escape_string($con, $_SESSION['senha']);
                $usuario = "SELECT * FROM tb_cad_user where nmLoginUser = '$login_usuario' and nmSenhaUser = '$senha_usuario'";
                $getData = mysqli_query($con, $usuario);
                $getRow = mysqli_num_rows($getData);
                if($getRow > 0) {
                    $id = mysqli_fetch_array($getData);
                    $_SESSION['situacao'] = $id['icSituacaoUser'];
                    if($_SESSION['situacao'] == '1'){
                        $_SESSION['nome'] = $id['nmUser'];
                        $_SESSION['id'] = $id['idUser'];
                        $_SESSION['perfil'] = $id['idPerfil'];  
                        $_SESSION['empresa'] = $id['idEmpresa'];
                        $_SESSION['telefone'] = $id['idTelefone'];
                        $_SESSION['senhaAntiga'] = $id['auxSenha'];
                        header("Location:../view/vw.usuario.php");
                    }
                    else{
                        echo "<script>alert('Esta conta foi desativada.');
                        window.location.href='../controller/c.logout.php';
                        window.location.href='../view/vw.login.php';</script>";
                    }
                }
            }
            if($_SESSION['tipo'] == '2'){
                $login = mysqli_real_escape_string($con, $_SESSION['login']);
                $senha = mysqli_real_escape_string($con, $_SESSION['senha']);
                $usuario = "SELECT * FROM tb_cad_user where nmLoginUser = '$login_usuario' and nmSenhaUser = '$senha_usuario'";
                $getData = mysqli_query($con, $usuario);
                $getRow = mysqli_num_rows($getData);
                if($getRow > 0) {
                    $id = mysqli_fetch_array($getData);
                    $_SESSION['situacao'] = $id['icSituacaoUser'];
                    if($_SESSION['situacao'] == '1'){
                        $_SESSION['nome'] = $id['nmUser'];
                        $_SESSION['id'] = $id['idUser'];
                        $_SESSION['perfil'] = $id['idPerfil']; 
                        $_SESSION['empresa'] = $id['idEmpresa']; 
                        $_SESSION['telefone'] = $id['idTelefone'];
                        $_SESSION['senhaAntiga'] = $id['auxSenha'];
                        header("Location:../view/vw.solicitacao.php");
                    }
                    else{
                        echo "<script>alert('Esta conta foi desativada. Entre em contato com o Administrador do sistema.');
                        window.location.href='../controller/c.logout.php';
                        window.location.href='../view/vw.login.php';</script>";
                    }
                }
            }
            if($_SESSION['tipo'] == '3'){
                $login = mysqli_real_escape_string($con, $_SESSION['login']);
                $senha = mysqli_real_escape_string($con, $_SESSION['senha']);
                $usuario = "SELECT * FROM tb_cad_user where nmLoginUser = '$login_usuario' and nmSenhaUser = '$senha_usuario'";
                $getData = mysqli_query($con, $usuario);
                $getRow = mysqli_num_rows($getData);
                if($getRow > 0) {
                    $id = mysqli_fetch_array($getData);
                    $_SESSION['situacao'] = $id['icSituacaoUser'];
                    if($_SESSION['situacao'] == '1'){
                        $_SESSION['nome'] = $id['nmUser'];
                        $_SESSION['id'] = $id['idUser'];
                        $_SESSION['perfil'] = $id['idPerfil'];  
                        $_SESSION['empresa'] = $id['idEmpresa'];
                        $_SESSION['telefone'] = $id['idTelefone'];
                        $_SESSION['senhaAntiga'] = $id['auxSenha'];
                        header("Location:../view/vw.solicitacao.php");
                        }
                        else{
                            echo "<script>alert('Esta conta foi desativada. Entre em contato com o representante da empresa.');
                            window.location.href='../controller/c.logout.php';
                            window.location.href='../view/vw.login.php';</script>";
                        }
                    }
                }
            }
        else{
            echo "<script>alert('Usuario ou senha incorreto'); window.location.href='../view/vw.login.php';</script>";
        }
    }
?>