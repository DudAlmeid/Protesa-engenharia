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
        public $idItem;
        public $dtTramite;
        public $tramite;
        public $userTramite;
        public $docAnx;
        public $imgAnx;
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

        function addTec($idTec,$situacao,$status,$idSol){
            $sql = "insert into tb_projeto (idUserTecnico,idSituacaoProjeto,idStatusProjeto,idSolicitacaoProjeto) values ('$idTec','$situacao','$status','$idSol')";
            return $this->con->query($sql);
        }
        function status($statusSol,$idSol)
        {
            $sql = "update tb_solicitacao SET idStatusSolicitacao = '$statusSol' where idSolicitacao = '$idSol'";
            return $this->con->query($sql);
        }
        function statusP($statusSol,$idProjeto)
        {
            $sql = "update tb_projeto SET idStatusProjeto = '$statusSol' where idProjeto = '$idProjeto'";
            return $this->con->query($sql);
        }
        
        function addTramite($dtTramite,$tramite, $userTramite, $docAnx, $imgAnx,$idProj)
        {
            $sql = "insert into tb_item_projeto (dtItemProjeto,dsItemProjeto,idItemUser,docItemProjeto,imgItemProjeto,idProjeto) values ('$dtTramite','$tramite','$userTramite','$docAnx','$imgAnx','$idProj')";
            return $this->con->query($sql);
        }

        function restSt($idProj){
            $sql = "update tb_projeto SET idStatusProjeto = '1' where idProjeto = '$idProj'";
            return $this->con->query($sql);
        }
    }

    function menuProj($idProj){
        $con = $GLOBALS["con"];
        $sql = "SELECT p.*, u.nmUser as 'nome', s.nmStatus as 'status', sol.dtSolicitacao as 'DtInc', sol.nmTituloSolicitacao as 'titulo', sol.dsSolicitacao as 'descricao'  FROM tb_projeto as p 
                inner join tb_cad_user u on u.idUser = p.idUserTecnico
                inner join tb_item_status s on s.idStatus = p.idStatusProjeto
                inner join tb_solicitacao sol on sol.idSolicitacao = p.idSolicitacaoProjeto
                WHERE idProjeto = $idProj";
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
                        <input type='hidden' name='idSol' value='$idSol'> 
                    </div>
                </div>
            ";
        }
    };

    function msgProj($idProj){
        $con = $GLOBALS["con"];
        $sql = "SELECT i.idItemProjeto as 'item', i.dtItemProjeto as 'dtItem', i.dsItemProjeto as 'descItem', i.imgItemProjeto as 'imgAnx', i.docItemProjeto as 'docAnx', u.nmUser as 'nome', u.idPerfil as 'perfil' FROM tb_item_projeto as i
                INNER JOIN tb_cad_user u ON i.idItemUser = u.idUser
                WHERE i.idProjeto = $idProj
                ORDER BY i.idItemProjeto ASC, i.dtItemProjeto DESC";
        $query = $con->query($sql);
        if (!$query) {
            die("Erro na consulta SQL: " . $con->error . "<br>SQL: " . $sql);
        }

        if ($query->num_rows == 0) {
            echo "
            <div <div class='chat-box'>
                <div class='conteudo'>
                    <p class='text-center'>Não há interações.</p>
                </div>
            </div>";
            return;
        }

        echo "<div class='chat-box'>";
        while ($row = $query->fetch_array()) {
            $nome = htmlspecialchars($row["nome"]);
            $dtItem = $row["dtItem"];
            $dtFormatada = date('d/m/Y H:i', strtotime($dtItem));
            $descricao = nl2br(htmlspecialchars($row["descItem"]));
            $perfil = $row["perfil"];
            $img = $row['imgAnx'];
            $doc = $row['docAnx'];

            if ($perfil == '3') {
                echo "
                <div class='mensagem usuario'>
                    <div class='conteudo'>
                        $descricao";
                        $caminho_base = '../Files_Protesa/';
                        $diretorio = $caminho_base . "chamado_" . $idProj . "/";
                        if (!empty($img) && file_exists($diretorio . $img)) {
                            echo"
                            <div class='anexo'>
                                <a href='{$diretorio}{$img}' target='_blank' style='color:rgb(0, 0, 0);'>Anexo ({$img})</a>
                            </div>";
                        }
                        if (!empty($doc) && file_exists($diretorio . $doc)) {
                            echo"
                            <div class='anexo'>
                                <a href='{$diretorio}{$doc}' target='_blank' style='color:rgb(0, 0, 0);'>Anexo ({$doc})</a>
                            </div>";
                        }
                        echo"
                        <small>$nome - $dtFormatada</small>
                    </div>
                </div>";
            } elseif ($perfil == '1' || $perfil == '2') {
                echo "
                <div class='mensagem tecnico'>
                    <div class='conteudo'>
                        $descricao";
                        $caminho_base = '../Files_Protesa/';
                        $diretorio = $caminho_base . "chamado_" . $idProj . "/";
                        if (!empty($img) && file_exists($diretorio . $img)) {
                            echo"
                            <div class='anexo'>
                                <a href='{$diretorio}{$img}' target='_blank' style='color:rgb(0, 0, 0);'>Anexo ({$img})</a>
                            </div>";
                        }
                        if (!empty($doc) && file_exists($diretorio . $doc)) {
                            echo"
                            <div class='anexo'>
                                <a href='{$diretorio}{$doc}' target='_blank' style='color:rgb(0, 0, 0);'>Anexo ({$doc})</a>
                            </div>";
                        }
                        echo"
                        <small>$nome - $dtFormatada</small>
                    </div>
                </div>";
            }
        }
    echo "
        </div>
        ";
    }

    function solCancelados(){
        $con = $GLOBALS["con"];
    $sql = "SELECT s.idSolicitacao as 'idSol', st.nmStatus as 'status', s.nmTituloSolicitacao as 'titulo', s.dtSolicitacao as 'dtSol' FROM tb_solicitacao as s
            inner join tb_item_status st on st.idStatus = s.idStatusSolicitacao
            WHERE idStatusSolicitacao = 8";
    $mysqli = datacon();
    if (!$mysqli) {
        return false;
    }
    $res = $mysqli->query($sql);
    if (!$res) {
        return false;
    }
    $data = [];
    while ($row = $res->fetch_assoc()) {        
        $data[] = $row;
        $idSol = $row['idSol'];
        $status = $row['status'];
        $titulo = $row['titulo'];
        $dt = $row['dtSol'];
    }
    return $data; 
    }

    function projCancelados(){
        $mysqli = datacon(); 
        if (!$mysqli) {
            return [];
        }
        $sql = "SELECT s.idSolicitacao as 'idSol', p.idProjeto as 'idProj', st.nmStatus as 'status', s.nmTituloSolicitacao as 'titulo', s.dtSolicitacao as 'dtSol' FROM tb_solicitacao as s
                inner join tb_projeto p on p.idSolicitacaoProjeto = s.idSolicitacao
                inner join tb_item_status st on st.idStatus = p.idStatusProjeto
                WHERE p.idStatusProjeto = 8";
        $res = $mysqli->query($sql);
        if (!$res) {
            return [];
        }

        $data = [];
        while ($row = $res->fetch_assoc()) {        
            $data[] = $row;
            $idSol = $row['idSol'];
            $idProj = $row['idProj'];
            $status = $row['status'];
            $titulo = $row['titulo'];
            $dt = $row['dtSol'];
        }
        return $data; 
    }
?>
