<?php 
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: vw.login.php");
    exit();
}

include '../template/referencia.php';
include '../model/connection.php'; 
include '../controller/usuario.class.php';
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
            navbarCli(); 
            $date = getdate();
            $date['mday']['mon']['year'];
            $empresa = $_SESSION['empresa'];
            $id = $_SESSION['id'];
        ?>

        <br>
        <!--solicitacao-->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="col-md-auto">
                    <div class="border border-white">
                        <header class="text-center">
                            <br>
                            <h1>Realize a sua solicitação!</h1>
                            <br>
                        </header>   
                        <form name="formCadSol" class="form-horizontal" action="../controller/c.cadSol.php" method="POST" onsubmit="return(verifica()" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="dtSol">Data Criação</label>
                                    <input name="dataSol" id="dataSol" readonly class="form-control form-control-sm text-center" value="<?php echo ( $date['mday'] < 10 ? '0' : '' ) . $date['mday'] . '/' . ( $date['mon'] < 10 ? '0' : '' ) . $date['mon'] . '/' . $date['year']; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nomeSol">Requerente</label>
                                    <input name="idUser" id="nome" readonly class="form-control form-control-sm text-center" value="<?php reqSol($id);?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="empSol">Empresa</label>
                                    <input name="empresa" id="empresa" readonly class="form-control form-control-sm text-center" value="<?php reqSolEmp($id);?>">
                                </div>
                            </div>   
                            <br> 
                            <div class="form-group col-md-12">
                                <label for="tituloSol">Titulo</label>
                                <input type="text" name="titulo" id="titulo" class="form-control form-control-sm" placeholder="Palavras-chave">
                            </div>
                            <br>    
                            <div class="form-group col-md-12">
                                <label for="desricaoSol">Descrição da Solicitação</label>
                                <textarea type="text" name="descricao" id="descricao" class="form-control form-control-sm" maxlength = '5000'placeholder="Limite de 5000 caracteres"></textarea>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block mb-4" value="Enviar">Enviar</button>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
    
        <?php footer(); ?>
    </body>
</html>