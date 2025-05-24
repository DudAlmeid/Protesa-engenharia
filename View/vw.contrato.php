<!DOCTYPE html>
    <html lang="pt-br">

    <?php 
    include '../template/referencia.php';
    include '../model/connection.php'; 
    include '..\controller\c.login.php';
    require "../template/fct.php";
    ?>
    
    <head>
        <title>Contrato | PROTESA ENGENHARIA</title>
        <?php init(); ?>
        </head>

    <body>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <?php 
            if(isset($_SESSION['tipo'])){
                if($_SESSION['tipo']=='1'){
                    navbarTecA();
                    //solicitacao
                    echo"
                    <div class='row justify-content-center'>
                        <div class='col-sm-11'>
                            <header class='text-center'>
                                <br>
                                <h3>Cotações abertas</h3>
                                <br>
                            </header>  
                            <ul class='list-group list-group-horizontal list-group-item-secondary text-center'>
                                <li class='list-group-item col-sm-1'>ID</li>
                                <li class='list-group-item col-sm-8'>Titulo</li>
                                <li class='list-group-item col-sm-3'>Data Criação</li>
                            </ul> 
                            <br>
                            <?php
                            $listas = listProj();
                            foreach ($listas as $lista){ ?>
                                <ul class='list-group list-group-horizontal list-group-item-light'>
                                    <a class='list-group-item col-sm-1' href='visuCot.php?idProjeto=" . $lista['idProjeto'] . "'>" . $lista['idSolicitacao'] . "</a>
                                    <a class='list-group-item col-sm-8'>". $lista['nmTituloSolicitacao']."</a>
                                    <a class='list-group-item col-sm-3'>". implode('/', array_reverse(explode('-', $lista ['dtSolicitacao'])))."</a>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>";
                }
                else if($_SESSION['tipo'] == '2'){
                    navbarTec();
                    $id = $_SESSION['id'];
                }
                else if($_SESSION['tipo'] == '3'){
                    navbarCli();
                }
            }
            
        ?>

        <br>
        <!--solicitacao-->
        <div class="row justify-content-center">
            <div class="col-sm-11">
                <header class="text-center">
                    <br>
                    <h3>Cotações abertas</h3>
                    <br>
                </header>  
                <ul class="list-group list-group-horizontal list-group-item-secondary text-center">
                    <li class="list-group-item col-sm-1">ID</li>
                    <li class="list-group-item col-sm-8">Titulo</li>
                    <li class="list-group-item col-sm-3">Data Criação</li>
                </ul> 
                <br>
                <?php
                $listas = listProj();
                foreach ($listas as $lista){ ?>
                <form method="post" action="vw.visuCot.php" style="display:inline;">
                    <ul class="list-group list-group-horizontal list-group-item-light">
                        <input type="hidden" name="idProj" value="<?php echo $lista['idProj']; ?>">
                        <a class="list-group-item col-sm-1" href="vw.visuCot.php"><?php echo $lista['idSol']?></a>
                        <a class="list-group-item col-sm-8"><?php echo $lista['titulo'] ?></a>
                        <a class="list-group-item col-sm-3"><?php echo implode('/', array_reverse(explode('-', $lista ['dtSol']))); ?></a>
                    </ul>
                <?php } ?>
                </form>
            </div>
        </div>

        <br>
        <br>
        <br>
        <?php footer(); ?>
    </body>
</html>