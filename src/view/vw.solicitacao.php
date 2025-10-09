<?php 
    session_start();

    include '../template/referencia.php';
    include '../model/connection.php'; 
    include '../model/cotacao.factory.php';
    require "../template/fct.php";
?>

<!DOCTYPE html>
    <html lang="pt-br">
    
    <head>
        <title>Solicitação | PROTESA ENGENHARIA</title>
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
            }
        ?>
        <br>
        <!--Solicitações-->
        
        <?php 
            if(isset($_SESSION['tipo'])){
                if($_SESSION['tipo']=='1'){
                    SolicAberta();
                }
                else if($_SESSION['tipo'] == '2'){
                    SolicAberta();
                }
                else if($_SESSION['tipo'] == '3'){
                    $id = $_SESSION['id'];
                    SolicAbertaCli($id);                    
                }
            }
        ?>
        <br>
        <br>
        <br>
        <?php footer(); ?>
    </body>
</html>