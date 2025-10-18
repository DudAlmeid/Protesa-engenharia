<?php
    $referencia_path = dirname(__DIR__) . '/template/referencia.php';
    if (file_exists($referencia_path)) {
        include $referencia_path;
    } else {
        die("Arquivo de referência não encontrado: " . $referencia_path);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Home PROTESA ENGENHARIA</title>
        <?php init(); ?>
    </head>

    <body>
        <?php
            if (function_exists('navbar')) {
                navbar();
            }
        ?>

        <section id="intro">
            <div class="intro-container wow fadeIn">
                <h1 class="mb-4 pb-0"><span>PROTESA</span> ENGENHARIA</h1>
                <h6 class="mb-4 pb-0">Especialista em atividades de coordenação e controle da operação de energia elétrica.</h6>
            </div>
        </section>

        <?php 
            if (function_exists('footer')) {
                footer();
            }
        ?>
    </body>
</html>