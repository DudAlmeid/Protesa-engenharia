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
    <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Chamado #123</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .chamado-info p {
            margin: 8px 0;
            font-size: 16px;
            color: #555;
        }

        .status-info {
            padding: 4px 10px;
            background-color: #ffc107;
            color: #212529;
            border-radius: 5px;
            font-weight: bold;
        }

        .chat-box {
            margin: 30px 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .mensagem {
            max-width: 75%;
            padding: 15px;
            border-radius: 10px;
            position: relative;
            font-size: 15px;
            line-height: 1.4;
        }

        .mensagem.usuario {
            background-color: #e9f5ff;
            align-self: flex-start;
            border-left: 4px solid #2196f3;
        }

        .mensagem.tecnico {
            background-color: #e6ffe9;
            align-self: flex-end;
            border-left: 4px solid #28a745;
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
            font-size: 14px;
        }

        select, input[type="submit"] {
            margin-top: 10px;
            padding: 10px;
            font-size: 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chamado #123 - Computador não liga</h2>

        <div class="chamado-info">
            <p><strong>Solicitante:</strong> João Silva</p>
            <p><strong>Status:</strong> <span class="status-info">Em Atendimento</span></p>
            <p><strong>Descrição:</strong> O computador do setor de RH não está ligando. Já foi verificado o cabo de energia.</p>
        </div>

        <div class="chat-box">
            <div class="mensagem usuario">
                <div class="conteudo">
                    O computador parou de funcionar hoje de manhã.
                    <small>João Silva - 20/05/2025 09:15</small>
                </div>
            </div>

            <div class="mensagem tecnico">
                <div class="conteudo">
                    Verificado. Fonte queimada. Iniciando troca do componente.
                    <small>Maria Sousa (Técnico) - 20/05/2025 10:10</small>
                </div>
            </div>

            <div class="mensagem usuario">
                <div class="conteudo">
                    Obrigado pelo retorno! Aguardando solução.
                    <small>João Silva - 20/05/2025 10:15</small>
                </div>
            </div>
        </div>

        <div class="formulario-resposta">
            <h3>Responder</h3>
            <form action="responder_chamado.php" method="post">
                <textarea name="mensagem" rows="4" placeholder="Digite sua mensagem..." required></textarea>

                <label for="status">Alterar Status:</label>
                <select name="status" id="status">
                    <option value="aberto">Aberto</option>
                    <option value="em atendimento" selected>Em Atendimento</option>
                    <option value="fechado">Fechado</option>
                </select>

                <input type="hidden" name="chamado_id" value="123">
                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>
    </body>
  
</html>