<meta charset="UTF-8">
<?php
    date_default_timezone_set('America/Sao_Paulo');
    function vwSolicAdmin(){
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM tb_solicitacao";
        $query = $con->query($sql);
        echo '<p>Registros encontrados: '.$query->num_rows.'</p>';
        while($sql = $query->fetch_array()){
            $idSolicitacao = $sql["idSolicitacao"];
            $nmTituloSolicitacao= $sql["nmTituloSolicitacao"];
            $dsSolicitacao= $sql["dsSolicitacao"];
            $idStatusSolicitacao= $sql["idStatusSolicitacao"];
            $dtSolicitacao = $sql["dtSolicitacao"];
            $idUserSolicitacao = $sql["idUserSolicitacao"];
            $idEmpresaSolicitacao = $sql["idEmpresa"];
            echo "<br/><tr>
            <td>$idSolicitacao   |</td>
            <td>$nmTituloSolicitacao   |</td>
            <td>$dsSolicitacao   |</td>
            <td>$idStatusSolicitacao   |</td>
            <td>$dtSolicitacao   |</td>
            <td>$idUserSolicitacao   |</td>
            <td>$idEmpresaSolicitacao   |</td>
            </tr>";
        }
    };

    class cotacao{

        function __construct(){
            $this->con = $GLOBALS["con"];
        }
        public $idSol;
        public $titulo;
        public $descricao;
        public $status;
        public $dataSol;
        public $idUser;
        public $empresa;
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

        function addSol($titulo, $descricao, $status, $dataSol, $id, $empresa) {
            $sql = "insert into tb_solicitacao (nmTituloSolicitacao, dsSolicitacao, idStatusSolicitacao, dtSolicitacao, idUserSolicitacao,idEmpresa) values ('$titulo','$descricao','$status',STR_TO_DATE('$dataSol','%Y-%m-%d'),'$id','$empresa')";
            return $this->con->query($sql);
        }

       function cancelaSol($idSolicitacao){
            $sql = "update tb_solicitacao SET idStatusSolicitacao = '8' where idSolicitacao = '$idSolicitacao'";
            return $this->con->query($sql);
       }
       function restSt($idSolicitacao){
            $sql = "update tb_solicitacao SET idStatusSolicitacao = '1' where idSolicitacao = '$idSolicitacao'";
            return $this->con->query($sql);
       }
    }
    
    function SolicAberta() {
    $con = $GLOBALS["con"];
    $sql = "SELECT * FROM tb_solicitacao WHERE idStatusSolicitacao = 1 and idStatusSolicitacao not in (8)";
    $query = $con->query($sql);

    echo "
    <div class='container'>
        <div class='row'>";
            while ($row = $query->fetch_array()) {
                $idSol = $row["idSolicitacao"];
                $titulo = htmlspecialchars($row["nmTituloSolicitacao"]);
                $descricao = htmlspecialchars($row["dsSolicitacao"]);
                $dataSol = $row["dtSolicitacao"];
                echo "
                <div class='col-md-3 mb-3'> <!-- 4 cards por linha -->
                    <form method='POST' action='/src/controller/c.atribueSol.php'>
                        <div class='card card-fixa h-1000'> <!-- h-100 para altura igual -->
                            <div class='card-body'>
                                <h6 class='h6-peq text-end'>ID: ".$idSol."</h6>
                                <h5 class='card-header'>".$titulo."</h5>
                                <p class='card-text'>".$descricao."</p>
                            </div>
                            <div class='card-footer'>
                                <input type='hidden' name='idSolicitacao' value='".$idSol."'>
                                <button type='submit' class='btn btn-primary btn-block mb-4'>Atribuir</button>
                            </div>
                            <div class='card-footer'>
                                <small class='text-muted'>Solicitado em: ".implode('/', array_reverse(explode('-', $dataSol)))."</small>
                            </div>
                        </div>
                    </form>
                </div>
                ";
                }
            echo "
        </div>
    </div>
    ";
    }

    function SolicAbertaCli($id) {
    $con = $GLOBALS["con"];
    $sql = "SELECT * FROM tb_solicitacao where idUserSolicitacao='$id' and idStatusSolicitacao =1 and idStatusSolicitacao not in (8)";
    $query = $con->query($sql);

    echo "
    <div class='container'>
        <div class='row'>";
            while ($row = $query->fetch_array()) {
                $idSol = $row["idSolicitacao"];
                $titulo = htmlspecialchars($row["nmTituloSolicitacao"]);
                $descricao = htmlspecialchars($row["dsSolicitacao"]);
                $dataSol = $row["dtSolicitacao"];
                echo "
                <div class='col-md-3 mb-3'> <!-- 4 cards por linha -->
                    <form method='POST' action='/src/controller/c.cancelSol.php'>
                        <div class='card card-fixa h-1000'> <!-- h-100 para altura igual -->
                            <div class='card-body'>
                                <h6 class='h6-peq text-end'>ID: ".$idSol."</h6>
                                <h5 class='card-header'>".$titulo."</h5>
                                <p class='card-text'>".$descricao."</p>
                            </div>
                            <div class='card-footer'>
                                <input type='hidden' name='idSolicitacao' value='".$idSol."'>
                                <button type='submit' class='btn btn-primary btn-block mb-4'>Cancelar Solicitação</button>
                            </div>
                            <div class='card-footer'>
                                <small class='text-muted'>Solicitado em: ".implode('/', array_reverse(explode('-', $dataSol)))."</small>
                            </div>
                        </div>
                    </form>
                </div>
                ";
                }
            echo "
        </div>
    </div>
    ";
    }
?>