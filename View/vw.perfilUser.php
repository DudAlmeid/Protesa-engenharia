<!DOCTYPE html>
<html lang="pt-br">
    <?php
    include '../template/referencia.php';
    include '../model/connection.php'; 
    include '..\controller\c.login.php';
    include '../model/usuario.factory.php';
    require "../template/fct.php";
    $idUser = $_GET['idUser'];
    ?>
    
    <head>
        <title>Perfil | PROTESA ENGENHARIA</title>
        <?php init(); ?>
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <?php navbarTecA(); ?>
        <br>
        <br>
        <!--Form de alteração-->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <header class="text-center">
                        <br>
                        <h1>Alterar cadastro</h1>
                        <br>
                    </header>   
                    <?php vwUser($idUser);?>
                </div>
            </div>
        </div>
    </body>
</html>