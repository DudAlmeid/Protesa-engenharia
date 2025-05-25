<!DOCTYPE html>
    <html lang="pt-br">

    <?php 
    include '../template/referencia.php';
    include '../model/connection.php'; 
    include '..\controller\c.login.php';
    require "../template/fct.php";
    include '..\model\projeto.factory.php';
    ?>
    
    <head>
        <title>Chamados Cancelados | PROTESA ENGENHARIA</title>
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

        <?php 
            if(isset($_SESSION['tipo'])){
                if($_SESSION['tipo']=='1'){?>
                    <div class="row justify-content-center">
                        <div class="col-sm-11">
                            <header class="text-center">
                                <br>
                                <h3>Chamados Cancelados</h3>
                                <br>
                            </header>  
                            <ul class="list-group list-group-horizontal list-group-item-secondary text-center">
                                <li class="list-group-item col-sm-1">ID</li>
                                <li class="list-group-item col-sm-3">Titulo</li>
                                <li class="list-group-item col-sm-3">Tipo</li>
                                <li class="list-group-item col-sm-3">Status</li>
                                <li class="list-group-item col-sm-2">Data Criação</li>
                            </ul> 
                            <br>
                            <?php
                            $solicitacoes = solCancelados();
                            foreach ($solicitacoes as $sol){   $modalId = "modalRest_" . $sol['idSol'];?>
                            <form method="get" action="../controller/c.cRest.php" style="display:inline;">
                                <input type="hidden" name="idProjeto" value="<?php echo $sol['idProjeto']; ?>">
                                <ul class="list-group list-group-horizontal list-group-item-light">
                                   <li class="list-group-item col-sm-1">
                                        <button type="button" class="btn-as-text" data-toggle="modal" data-target="#<?php echo $modalId; ?>">
                                            <?php echo $sol['idSol']; ?>
                                        </button>
                                    </li>
                                    <a class="list-group-item col-sm-3"><?php echo $sol['titulo'] ?></a>
                                    <a class="list-group-item col-sm-3">Solicitação</a>
                                    <a class="list-group-item col-sm-3"><?php echo $sol['status'] ?></a>
                                    <a class="list-group-item col-sm-2"><?php echo implode('/', array_reverse(explode('-', $sol ['dtSol']))); ?></a>
                                </ul>

                                <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" role="dialog" aria-labelledby="restCh" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Restaurar chamado ID <?php echo $sol['idSol']; ?>?</h5>
                                            </div>
                                            <div class="modal-body">
                                                Deseja restaurar o chamado e adicionar à fila de chamados abertos?
                                            </div>
                                            <div class="container col-md-12 d-flex justify-content-start gap-2">
                                                <button type="reset" class="btn btn-primary btn-block mb-4" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary btn-block mb-4">Restaurar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php } ?>
                            <?php
                            $projetos = projCancelados();
                            foreach ($projetos as $proj){ $modalId = "modalRest_" . $proj['idProj'];?>
                            <form method="get" action="../controller/c.cRest.php" style="display:inline;">
                                <input type="hidden" name="idProjeto" value="<?php echo $proj['idProjeto']; ?>">
                                <ul class="list-group list-group-horizontal list-group-item-light">
                                    <li class="list-group-item col-sm-1">
                                        <button type="button" class="btn-as-text" data-toggle="modal" data-target="#<?php echo $modalId; ?>">
                                            <?php echo $proj['idProj']; ?>
                                        </button>
                                    </li>
                                    <a class="list-group-item col-sm-3"><?php echo $proj['titulo'] ?></a>
                                    <a class="list-group-item col-sm-3">Projeto</a>
                                    <a class="list-group-item col-sm-3"><?php echo $proj['status'] ?></a>
                                    <a class="list-group-item col-sm-2"><?php echo implode('/', array_reverse(explode('-', $proj ['dtSol']))); ?></a>
                                </ul>
                                <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" role="dialog" aria-labelledby="restCh" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Restaurar chamado ID <?php echo $proj['idProj']; ?>?</h5>
                                            </div>
                                            <div class="modal-body">
                                                Deseja restaurar o chamado e adicionar à fila de chamados abertos?
                                            </div>
                                            <div class="container col-md-12 d-flex justify-content-start gap-2">
                                                <button type="reset" class="btn btn-primary btn-block mb-4" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary btn-block mb-4">Restaurar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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