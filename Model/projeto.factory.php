<meta charset="UTF-8">
<?php 
    class projeto{
        function __construct(){
            $this->con = $GLOBALS["con"];
        }
        public $idProjeto;
        public $idUserTecnico;
        public $idSituacaoProjeto;
        public $idStatusProjeto;
        public $idSol;
        public $con;

        function edit_bd($idSol)
        {
            $sql = "select * from tb_solicitacao where idSolicitacao ='$idSol'";
            $query = $this->con->query($sql);
            $res=$query->fetch_object();
            $this->idSol = $res->idSolicitacao;
            $this->titulo = $res->nmTituloSolicitacao;
            $this->descricao = $res-> dsSolicitacao;
            $this->status = $res->idStatusSolicitacao;
            $this->date = $res->dtSolicitacao;
        }

        function addTEc($idTec,$situacao,$status,$idSol){
            $sql = "insert into tb_projeto (idUserTecnico,idSituacaoProjeto,idStatusProjeto,idSolicitacaoProjeto) values ('$idTec','$situacao','$status','$idSol')";
            return $this->con->query($sql);
        }
        function status($statusSol,$idSol)
        {
            $sql = "update tb_solicitacao SET idStatusSolicitacao = '$statusSol' where idSolicitacao = '$idSol'";
            return $this->con->query($sql);
        }
    }

    function menuProj($idProjeto){
        $con = $GLOBALS["con"];
        $sql = "SELECT p.*, u.nmUser as 'nome', s.nmStatus as 'status', sol.dtSolicitacao as 'DtInc', sol.nmTituloSolicitacao as 'titulo', sol.dsSolicitacao as 'descricao'  FROM tb_projeto as p 
                inner join tb_cad_user u on u.idUser = p.idUserTecnico
                inner join tb_item_status s on s.idStatus = p.idStatusProjeto
                inner join tb_solicitacao sol on sol.idSolicitacao = p.idSolicitacaoProjeto
                WHERE idProjeto = ".$idProjeto."";
        $query = $con->query($sql);
        if (!$query) {
            die("Erro na consulta SQL: " . $con->error . "<br>SQL: " . $sql);
        }
        while ($row = $query->fetch_array()) {
            $idProjeto = $row["idProjeto"];
            $idSol = $row["idSolicitacaoProjeto"];
            $tecnico = htmlspecialchars($row["nome"]);
            $status = $row["status"];
            $date = $row["DtInc"];
            $titulo = $row["titulo"];
            $descricao = $row["descricao"];

            echo "
                <div class='container-prj'>
                    <h2>Projeto: $titulo</h2>
                    <div class='chamado-info'>
                        <p><strong>Descrição:</strong> $descricao</p>
                        <p><strong>Data de Criação: </strong>".implode('/', array_reverse(explode('-', $date)))."</p>
                        <p><strong>Status: </strong> <span class='status'>$status </span></p>
                        <p><strong>Técnico: </strong> $tecnico</p>
                    </div>
                </div>
            ";
        }
    };

    function msgProj($idProjeto){
        $con = $GLOBALS["con"];
        $sql = "SELECT i.idItemProjeto as 'item', i.dtItemProjeto as 'dtItem', i.dsItemProjeto as 'descItem', i.imgItemProjeto as 'imgAnx', i.docItemProjeto as 'docAnx', u.nmUser as 'nome', u.idPerfil as 'perfil' FROM tb_item_projeto as i
                INNER JOIN tb_cad_user u ON i.idItemUser = u.idUser
                WHERE i.idProjeto = $idProjeto
                ORDER BY i.idItemProjeto ASC, i.dtItemProjeto DESC";
        $query = $con->query($sql);
        if (!$query) {
            die("Erro na consulta SQL: " . $con->error . "<br>SQL: " . $sql);
        }

        if ($query->num_rows == 0) {
            echo "<p>Não há interações.</p>";
            return;
        }

        echo "<div class='chat-box'>";
        while ($row = $query->fetch_array()) {
        $nome = htmlspecialchars($row["nome"]);
        $dtItem = $row["dtItem"];
        $dtFormatada = date('d/m/Y H:i', strtotime($dtItem));
        $descricao = nl2br(htmlspecialchars($row["descItem"]));
        $perfil = $row["perfil"];

        if ($perfil == '3') {
            echo "
            <div class='mensagem usuario'>
                <div class='conteudo'>
                    $descricao
                    <small>$nome - $dtFormatada</small>
                </div>
            </div>";
        } elseif ($perfil == '1' || $perfil == '2') {
            echo "
            <div class='mensagem tecnico'>
                <div class='conteudo'>
                    $descricao
                    <small>$nome - $dtFormatada</small>
                </div>
            </div>";
        }
    }
    echo "
        <div class='formulario-resposta'>
        <h4>Responder</h4>
        <form action='responder_chamado.php' method='POST'>
            <textarea name='mensagem' rows='4' placeholder='Digite sua mensagem...' required></textarea>
            <label for='status'>Alterar Status:</label>
            <select name='status' id='status'>
                <option value='aberto'>Aberto</option>
                <option value='em atendimento' selected>Em Atendimento</option>
                <option value='fechado'>Fechado</option>
            </select>

            <input type='hidden' name='chamado_id' value='123'>
            <input type='submit' class='btn btn-primary btn-block mb-4' value='Enviar'>
        </form>
    </div>
        </div>
        ";
    }
?>
