<meta charset="UTF-8">
<?php
    class Login{
        function __construct(){
        $this->con = $GLOBALS["con"];
    }
        public $idUser;
        public $nmLoginUser;
        public $nmSenhaUser;
        public $idPerfil;
        public $idEmpresa;
 
        public $con;

        function edit_bd($nmLoginUser){
            $sql = "select * from tb_cad_user where nmLoginUser = ". $nmLoginUser;
            $query = $this->con->query($sql);
            $res = $query->fetch_object();
            $this->nmLoginUser=$res->nmLoginUser;
            $this->nmSenhaUser=$res->nmSenhaUser;
            $this->idPerfil=$res->idPerfil;
        }

        function addUser($nmLoginUser, $nmSenhaUser){
            $sql = "insert into tb_cad_user (nmLoginUser, nmSenhaUser, idPerfil)" .
            "VALUES ('$nmLoginUser', '$nmSenhaUser', 3)";
            return $this->con->query($sql);
        }

        function addTec($nmLoginUser, $nmSenhaUser){
            $sql = "insert into tb_cad_user (nmLoginUser, nmSenhaUser, idPerfil)" .
            "VALUES ('$nmLoginUser', '$nmSenhaUser', 2)";
            return $this->con->query($sql);
        }

        function addAdmin($nmLoginUser, $nmSenhaUser){
            $sql = "insert into tb_cad_user (nmLoginUser, nmSenhaUser, idPerfil)" .
            "VALUES ('$nmLoginUser', '$nmSenhaUser', 1)";
            return $this->con->query($sql);
        }

        function editLogin($nmLoginUser, $nmSenhaUser){
            $sql = "update tb_cad_user set nmSenhaUser= '$nmSenhaUser' where nmLoginUser = '$nmLoginUser'";
            return $this->con->query($sql);
        }

        function inative($idUser, $nmLoginUser){
            $sql = "update tb_cad_user set icSituacaoUser = 0 where nmLoginUser = '$nmLoginUser'";
            return $this->con->query($sql);
        }
        function addSol($idUser,$idEmpresa){
            $this->idUser = $idUser;
            $this->idEmpresa = $idEmpresa;
        }
    }
?>