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

        <?php 
            if(isset($_SESSION['tipo'])){
                if($_SESSION['tipo']=='1'){?>
                    <div class="row justify-content-center">
                        <div class="col-sm-11">
                            <header class="text-center">
                                <br>
                                <h3>Cotações abertas</h3>
                                <br>
                            </header>  
                            <ul class="list-group list-group-horizontal list-group-item-secondary text-center">
                                <li class="list-group-item col-sm-1">ID</li>
                                <li class="list-group-item col-sm-6">Titulo</li>
                                <li class="list-group-item col-sm-3">Status</li>
                                <li class="list-group-item col-sm-2">Data Criação</li>
                            </ul> 
                            <br>
                            <?php
                            $listas = listProjAdmin();
                            foreach ($listas as $lista){ ?>
                            <form method="get" action="vw.visuCot.php" style="display:inline;">
                                <input type="hidden" name="idProjeto" value="<?php echo $lista['idProjeto']; ?>">
                                <ul class="list-group list-group-horizontal list-group-item-light">
                                    <li class="list-group-item col-sm-1">
                                        <button type="submit" class="btn-as-text"><?php echo $lista['idSol']; ?></button>
                                    </li>
                                    <a class="list-group-item col-sm-6"><?php echo $lista['titulo'] ?></a>
                                    <a class="list-group-item col-sm-3"><?php echo $lista['status'] ?></a>
                                    <a class="list-group-item col-sm-2"><?php echo implode('/', array_reverse(explode('-', $lista ['dtSol']))); ?></a>
                                </ul>
                            </form>
                            <?php } ?>
                        </div>
                    </div><?php
                }
                else if($_SESSION['tipo'] == '2'){?>
                    <div class="row justify-content-center">
                        <div class="col-sm-11">
                            <header class="text-center">
                                <br>
                                <h3>Cotações abertas</h3>
                                <br>
                            </header>  
                            <ul class="list-group list-group-horizontal list-group-item-secondary text-center">
                                <li class="list-group-item col-sm-1">ID</li>
                                <li class="list-group-item col-sm-6">Titulo</li>
                                <li class="list-group-item col-sm-3">Status</li>
                                <li class="list-group-item col-sm-2">Data Criação</li>
                            </ul> 
                            <br>
                            <?php
                            $listas = listProj();
                            foreach ($listas as $lista){ ?>
                            <form method="get" action="vw.visuCot.php" style="display:inline;">
                                <input type="hidden" name="idProjeto" value="<?php echo $lista['idProjeto']; ?>">
                                <ul class="list-group list-group-horizontal list-group-item-light">
                                    <li class="list-group-item col-sm-1">
                                        <button type="submit" class="btn-as-text"><?php echo $lista['idSol']; ?></button>
                                    </li>
                                    <a class="list-group-item col-sm-6"><?php echo $lista['titulo'] ?></a>
                                    <a class="list-group-item col-sm-3"><?php echo $lista['status'] ?></a>
                                    <a class="list-group-item col-sm-2"><?php echo implode('/', array_reverse(explode('-', $lista ['dtSol']))); ?></a>
                                </ul>
                            </form>
                            <?php } ?>
                        </div>
                    </div><?php
                }
                else if($_SESSION['tipo'] == '3'){?>
                    <div class="row justify-content-center">
                        <div class="col-sm-11">
                            <header class="text-center">
                                <br>
                                <h3>Cotações abertas</h3>
                                <br>
                            </header>  
                            <ul class="list-group list-group-horizontal list-group-item-secondary text-center">
                                <li class="list-group-item col-sm-1">ID</li>
                                <li class="list-group-item col-sm-6">Titulo</li>
                                <li class="list-group-item col-sm-3">Status</li>
                                <li class="list-group-item col-sm-2">Data Criação</li>
                            </ul> 
                            <br>
                            <?php
                            $listas = listProj();
                            foreach ($listas as $lista){ ?>
                            <form method="get" action="vw.visuCot.php" style="display:inline;">
                                <input type="hidden" name="idProjeto" value="<?php echo $lista['idProjeto']; ?>">
                                <input type="hidden" name="idSol" value="<?php echo $lista['idSol']; ?>">
                                <ul class="list-group list-group-horizontal list-group-item-light">
                                    <li class="list-group-item col-sm-1">
                                        <button type="submit" class="btn-as-text"><?php echo $lista['idSol']; ?></button>
                                    </li>
                                    <a class="list-group-item col-sm-6"><?php echo $lista['titulo'] ?></a>
                                    <a class="list-group-item col-sm-3"><?php echo $lista['status'] ?></a>
                                    <a class="list-group-item col-sm-2"><?php echo implode('/', array_reverse(explode('-', $lista ['dtSol']))); ?></a>
                                </ul>
                            </form>
                            <?php } ?>
                        </div>
                    </div><?php
                }
            }
        ?>
        <br>
        <br>
        <br>
        <?php footer(); ?>
    </body>
</html>