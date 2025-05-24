<!DOCTYPE html>
    <html lang="pt-br">

    <?php 
    include '../template/referencia.php';
    include '../model/connection.php'; 
    include '../model/cotacao.factory.php';
    include '../model/projeto.factory.php';

    include '..\controller\c.login.php';
    require "../template/fct.php";
    ?>

    <head>
        <title>Manutenção de Registros | PROTESA ENGENHARIA</title>
        <?php init(); ?>
    </head>
    <body>
    <?php foreach ($mensagens as $msg): ?>
    <div class="mensagem <?= $msg['tipo_usuario'] == 'tecnico' ? 'tecnico' : 'usuario' ?>">
        <div class="conteudo">
            <?= nl2br(htmlspecialchars($msg['texto'])) ?>
            <small><?= $msg['data_envio'] ?></small>

            <?php
                $idProj = $msg['id_projeto']; // ou pegue do escopo se já tiver
                $imgAnexo = $msg['img_anexo']; // nome do arquivo salvo
                $docAnexo = $msg['doc_anexo'];
                $caminho = "../Files_Protesa/chamado_" . $idProj . "/";
            ?>

            <?php if (!empty($imgAnexo) && file_exists($caminho . $imgAnexo)): ?>
                <div class="anexo">
                    <a href="<?= $caminho . $imgAnexo ?>" target="_blank">
                        <img src="<?= $caminho . $imgAnexo ?>" alt="Imagem Anexada" style="max-width: 150px; border: 1px solid #ccc; margin-top: 10px;">
                    </a>
                </div>
            <?php endif; ?>

            <?php if (!empty($docAnexo) && file_exists($caminho . $docAnexo)): ?>
                <div class="anexo">
                    <a href="<?= $caminho . $docAnexo ?>" target="_blank" style="color: #007bff; margin-top: 10px; display: block;">
                        📄 Abrir Documento (<?= strtoupper(pathinfo($docAnexo, PATHINFO_EXTENSION)) ?>)
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>

    </body>
  
</html> 