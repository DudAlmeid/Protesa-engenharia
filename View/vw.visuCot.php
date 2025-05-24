<!DOCTYPE html>
<html lang="pt-br">
    <?php
    include '../template/referencia.php';
    include '../model/connection.php'; 
    include '..\controller\c.login.php';
    include '../model/projeto.factory.php';
    require "../template/fct.php";
    $idProj = $_GET['idProjeto'];
    ?>
    
    <head>
        <title>Projeto <?php echo $idProj ?> | PROTESA ENGENHARIA</title>
        <?php init(); ?>
    </head>
    <body>
        <style>
        
        .container-prj {
            max-width: 99%;
            margin: 10px auto;
            padding: 30px;
            background-color: #212529;
        }

        h2 {
            font-family: sans-serif;
            font-size: 30px;
            font-weight: 350;
            text-transform: uppercase;
            margin-bottom: 20px;
            color: #fff;;
        }

        .chamado-info p {
            font-family: sans-serif;
            font-size: 40px;
            font-weight: 535000;
            margin: 8px 0;
            font-size: 16px;
            color: #fff;;
        }

        .status-info {
            padding: 4px 10px;
            background-color:rgb(255, 147, 7);
            color: #212529;
            border-radius: 5px;
            font-weight: bold;
        }

        .chat-box {
           max-width: 90%;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .mensagem {
            max-width: 90%;
            padding: 15px;
            border-radius: 10px;
            position: relative;
            font-size: 15px;
            line-height: 1.4;
        }

        .mensagem.usuario {
            background-color:rgba(255, 174, 25, 0.14);
            border-left: 4px solid #ffaf19;
            align-self: flex-start;
            margin-left: 0;
            margin-right: auto;
        }

        .mensagem.tecnico {
            background-color:rgba(0, 0, 0, 0.06);
            border-right: 4px solid black;
            align-self: flex-end;
            margin-left: auto;
            margin-right: 0;
        }

        .mensagem .conteudo small {
            display: block;
            margin-top: 8px;
            color: #777;
            font-size: 13px;
        }

        .formulario-resposta {
            margin-top: 30px;
        }

        .formulario-resposta h3 {
            margin-bottom: 15px;
            color: #444;
        }

        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            resize: vertical;
            font-size: 12px;
        }
        .formulario-resposta{
            max-width: 99%;
            margin: 10px auto;
            padding: 30px;
            background-color:rgba(50, 52, 53, 0.14);
        }

        </style>
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
        <!--menu lateral-->
        <?php menuProj($idProj);?>
        <?php msgProj($idProj);?>

        <div class='formulario-resposta'>
            <label>Responder</label>
            <form action='../controller/c.atChamado.php' method='POST' enctype="multipart/form-data">
                <textarea name='tramite' rows='4' placeholder='Digite sua mensagem...' required></textarea>
                <br><br>
                 <div class="col-md-12">
                    <label>Status solicitação:</label>
                    <select name="idStatus" class="form-control form-control-sm">
                        <option value="">Selecione...</option>
                        <?php
                            $allstatus = getStatus();
                            foreach ($allstatus as $status){
                            ?>
                            <option value="<?php echo $status['idStatus'] ?>">
                                    <?php echo $status['nmStatus'] ?>     
                            </option>
                            <?php $idStatus == $status['idStatus'];?>
                            <?php 
                            }
                        ?>
                    </select>
                </div>
                <br>
                <label for='arquivo'>Anexar Documento:</label>
                <input type='file' name='docAnx' class="input-anexo" id='docAnx' class='form-control-file'>
                <br>
                <label for='arquivo'>Anexar Imagens:</label>
                <input type='file' name='imgAnx' class="input-anexo" id='imgAnx' class='form-control-file'>
                <input type='hidden' name='idProj' value="<?php echo $idProj ?>"> 
                <input type='submit' class='btn btn-primary btn-block mb-4' value='Enviar'>
            </form>
        </div>
        <?php footer(); ?>
    </body>
</html>