<?php 
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: vw.login.php");
    exit();
}

include '../model/connection.php'; 
include '../model/usuario.factory.php';
include '../model/empresa.factory.php';
require "../template/fct.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
    <?php
    include '../template/referencia.php';
    ?>
    
    <head>
        <title>Manutenção de Registros | PROTESA ENGENHARIA</title>
        <?php init(); ?>
    </head>

    <body>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        
        <?php 
        if(isset($_SESSION['tipo'])){
            if($_SESSION['tipo']=='1'){
                navbarTecA();
            }
            else if($_SESSION['tipo'] == '2'){
                navbarTec();
            }
            else if($_SESSION['tipo'] == '3'){
                navbarCli();                    
            }
        } else {
            echo "<div class='alert alert-warning'>Tipo de usuário não definido na sessão.</div>";
        }
        ?>
        
        <!--lista de usuarios cadastrados-->
        <div class="row justify-content-center">
            <div class="col-sm-11">
                <header class="text-center">
                    <br>
                    <h3>Usuários</h3>
                    <br>
                </header>  
                <ul class="list-group list-group-horizontal list-group-item-secondary text-center">
                    <li class="list-group-item col-sm-1">ID</li>
                    <li class="list-group-item col-sm-3">Nome</li>
                    <li class="list-group-item col-sm-2">CPF</li>
                    <li class="list-group-item col-sm-4">Empresa</li>
                    <li class="list-group-item col-sm-1">Perfil</li>
                    <li class="list-group-item col-sm-1">Situação</li>
                </ul> 
                <?php
                $list = listUser();
                if ($list && count($list) > 0) {
                    foreach ($list as $lista){ 
                ?>
                <form method="get" action="vw.perfilUser.php" style="display:inline;">
                    <input type="hidden" name="idUser" value="<?php echo $lista['idUser']; ?>">
                    <ul class="list-group list-group-horizontal list-group-item-light">
                        <li class="list-group-item col-sm-1">
                            <button type="submit" class="btn-as-text"><?php echo $lista['idUser']; ?></button>
                        </li>
                        <a class="list-group-item col-sm-3"><?php echo $lista['nome']; ?></a>
                        <a class="list-group-item col-sm-2 text-center"><?php echo $lista['cpf']; ?></a>
                        <a class="list-group-item col-sm-4"><?php echo $lista['empresa']; ?></a>
                        <a class="list-group-item col-sm-1 text-center"><?php echo $lista['perfil']; ?></a>
                        <a class="list-group-item col-sm-1 text-center"><?php echo $lista['situacao']; ?></a>
                    </ul>
                </form>
                <?php 
                    }
                } else {
                    echo "<div class='alert alert-info'>Nenhum usuário encontrado.</div>";
                }
                ?>
            </div>
        </div>
        <br>                                          
        <?php footer(); ?>
    </body>
</html>