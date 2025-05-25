<!DOCTYPE html>
    <html lang="pt-br">

    <?php 
    include '../template/referencia.php';
    include '../model/connection.php'; 
    include '../model/usuario.factory.php';
    include '../model/empresa.factory.php';
    include '..\controller\c.login.php';
    require "../template/fct.php";
    ?>

    <head>
        <title>Manutenção de Registros | PROTESA ENGENHARIA</title>
        <?php init(); ?>
    </head>

    <body>
        <?php navbarTecA();?>
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
                foreach ($list as $lista){ ?>
                    <ul class="list-group list-group-horizontal list-group-item-light">
                        <a class="list-group-item col-sm-1" href="vw.perfil.php"><?php echo $lista['idUser']?></a>
                        <a class="list-group-item col-sm-3"><?php echo $lista['nome'] ?></a>
                        <a class="list-group-item col-sm-2 text-center"><?php echo $lista['cpf'] ?></a>
                        <a class="list-group-item col-sm-4"><?php echo $lista['empresa'] ?></a>
                        <a class="list-group-item col-sm-1 text-center"><?php echo $lista['perfil'] ?></a>
                        <a class="list-group-item col-sm-1 text-center"><?php echo $lista['situacao'] ?></a>
                    </ul>
                <?php } ?>
            </div>
        </div>
        <br>                                          
        <?php footer(); ?>
    </body>
</html>