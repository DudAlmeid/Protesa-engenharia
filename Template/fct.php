<?php
function datacon(){
    $mysqli = new mysqli('localhost','root' ,'usbw','db_protesa');
    if($mysqli->connect_errno!=0){
        die("error".$mysqli->connect_error);
    }
    return $mysqli;
}
function getEmpresa(){
    $mysqli = datacon();

    if(!$mysqli){
        return false;
    }
    $res = $mysqli->query("SELECT * FROM tb_cad_empresa");
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

function getPerfil(){
    $mysqli = datacon();

    if(!$mysqli){
        return false;
    }
    $res = $mysqli->query("SELECT * FROM tb_item_perfil");
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;   
}

function getSolicitacao($id){
    $mysqli = datacon();

    if(!$mysqli){
        return false;
    }
    $res = $mysqli->query("SELECT * FROM tb_solicitacao where idUserSolicitacao ='$id' and idStatusSolicitacao =1");
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    if(empty($data)){
        $data = 0;
    }
    return $data; 
    
}
function getStatus(){
    $mysqli = datacon();

    if(!$mysqli){
        return false;
    }
    $res = $mysqli->query("SELECT * FROM tb_item_status");
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    return $data; 
}

function reqSol($id){
    $con = $GLOBALS["con"];
    $sql = "SELECT idUser, nmUser FROM tb_cad_user where idUser ='$id'";
    $query = $con->query($sql);
    while($sql = $query->fetch_array()){
        $nmUser= $sql["nmUser"];
        $id =$sql['idUser'];
        echo $nmUser;
    }
}

function reqSolEmp($id){
    $con = $GLOBALS["con"];
    $sql = "SELECT e.nmRazaoSocial, u.idEmpresa FROM tb_cad_user as u inner join tb_cad_empresa e on u.idEmpresa = e.idEmpresa where u.idUser ='$id'";
    $query = $con->query($sql);
    while($sql = $query->fetch_array()){
        $nmEmpresa= $sql["nmRazaoSocial"];
        $empresa = $sql['idEmpresa'];
        echo $nmEmpresa;
    }
}

function listProj(){
    $mysqli = datacon();
    if (!$mysqli) {
        return false;
    }
    if (!isset($_SESSION['id'])) {
        return false;
    }
    $idUser = (int) $_SESSION['id'];
    $sql = "SELECT sol.idSolicitacao as 'idSol', sol.nmTituloSolicitacao as 'titulo', st.nmStatus as 'status', sol.dtSolicitacao as 'dtSol', p.idProjeto as 'idProjeto' from tb_solicitacao as sol 
            inner join tb_projeto p on sol.idSolicitacao = p.idSolicitacaoProjeto 
            inner join tb_item_status st on p.idStatusProjeto = st.idStatus
            where sol.idStatusSolicitacao !=1 and p.idUserTecnico = $idUser || sol.idUserSolicitacao = $idUser";
    $res = $mysqli->query($sql);
    if (!$res) {
        // Se houver erro na consulta, pode retornar false ou tratar o erro
        return false;
    }
    $data = [];
    while ($row = $res->fetch_assoc()) {        
        $data[] = $row;
        $idSol = $row['idSol'];
        $idProjeto = $row['idProjeto'];
        $status = $row['status'];
        $titulo = $row['titulo'];
        $dt = $row['dtSol'];
    }
    return $data; 
}

function listProjAdmin(){
    $mysqli = datacon();
    if (!$mysqli) {
        return false;
    }
    $sql = "SELECT sol.idSolicitacao as 'idSol', st.nmStatus as 'status', sol.nmTituloSolicitacao as 'titulo', sol.dtSolicitacao as 'dtSol', p.idProjeto as 'idProjeto' from tb_solicitacao as sol 
            inner join tb_projeto p on sol.idSolicitacao = p.idSolicitacaoProjeto 
            inner join tb_item_status st on p.idStatusProjeto = st.idStatus
            where idStatusSolicitacao !=1";
    $res = $mysqli->query($sql);
    if (!$res) {
        // Se houver erro na consulta, pode retornar false ou tratar o erro
        return false;
    }
    $data = [];
    while ($row = $res->fetch_assoc()) {        
        $data[] = $row;
        $idSol = $row['idSol'];
        $idProjeto = $row['idProjeto'];
        $status = $row['status'];
        $titulo = $row['titulo'];
        $dt = $row['dtSol'];
    }
    return $data; 
}

?>