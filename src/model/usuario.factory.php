<meta charset="UTF-8">
<?php
    
    function listUser(){
        $con = $GLOBALS["con"];
        $sql = "SELECT u.idUser, u.nmUser, u.idCPF, e.nmRazaoSocial, p.nmPerfil, u.icSituacaoUser FROM tb_cad_user as u 
                inner join tb_cad_empresa e on e.idEmpresa = u.idEmpresa
                inner join tb_item_perfil p on p.idPerfil = u.idPerfil";
         $query = $con->query($sql);

        if (!$query) {
            echo "Erro na consulta: " . $con->error;
            return null;
        }
        $resultados = [];
        
        while($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $idUser = $row["idUser"];
            $nome = $row["nmUser"];           
            $cpf = $row["idCPF"];
            $empresa = $row["nmRazaoSocial"];
            $situacao = $row["icSituacaoUser"];     
            $perfil = $row["nmPerfil"];
            if($situacao == 1){
                $situacao = "Ativo";
            }
            else if($situacao == 0){
                $situacao = "Inativo";
            };
            $resultados[] = [
                'idUser' => $idUser,
                'nome' => $nome,
                'cpf' => $cpf,
                'empresa' => $empresa,
                'situacao' => $situacao,
                'perfil' => $perfil
            ];
        }
        return $resultados;
    };

    function vwUser($id){ //view admin
        $con = $GLOBALS["con"];
        $sql = "SELECT u.*, e.nmRazaoSocial as 'empresa' FROM tb_cad_user as u 
                inner join tb_cad_empresa e on u.idEmpresa = e.idEmpresa
                where idUser =".$id;

        $query = $con->query($sql);
        if (!$query) {
            die("Erro na query: " . $con->error);
        }

        while($row = $query->fetch_array()){
            $idUser = $row["idUser"];
            $nome= $row["nmUser"];
            $login= $row["nmLoginUser"];
            $senha= $row["nmSenhaUser"];
            $cpf= $row["idCPF"];
            $empresa= $row["empresa"];
            $telefone= $row["idTelefone"];
            $situacao= $row["icSituacaoUser"];
            $perfil = $row["idPerfil"];  
            if($situacao == 1){
                $aux = 1;
                $ck = "checked";
            }
            else if($situacao == 0){
                $aux = 0;
                $ck = "";
            }       
            echo "
                <form class='form-horizontal' action='/src/controller/c.updAdm.php' method='POST'>
                    <div class='row align-items-center'>
                        <div class='form-group col-md-1'>
                            <label for='nomeUser'>ID</label>
                            <input type='text' class='form-control form-control-sm' readonly name='idUser' id='nmUser' value=". $idUser.">
                        </div>
                        <div class='form-group col-md-8'>
                            <label for='nomeUser'>Nome Completo</label>
                            <input type='text' class='form-control form-control-sm' name='nome' id='nmUser' value=\"$nome\">
                        </div>
                        <div class='form-checkIC col-md-3 align-self-center'>
                            <input class='form-check-input'  type='checkbox' $ck value='$aux' id='icSituacaoUser' name='situacao'>
                            <label class='form-check-labelform-control-sm' for='icSituacaoUser'>Ativo</label>
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='form-group col-md-4'>
                            <label for='cpfUser'>CPF Usuário</label>
                            <input type='text' class='form-control form-control-sm' readonly id='idCpf' value='$cpf' name='cpf' min='11' maxlength='11' required placeholder=".$cpf.">
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='loginUser'>Login do Usuário</label>
                            <input type='text' class='form-control form-control-sm' id='nmLoginUser' name='login' value=".$login.">
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='senhaUser'>Senha do Usuário</label>
                            <input type='password' class='form-control form-control-sm' id='nmSenhaUser' name='senha' value=".$senha.">
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='form-group col-md-8'>
                            <label for='idEmpresa'>Empresa</label>
                            <input type='text' class='form-control form-control-sm' readonly name='empresa' id='idEmpresa' placeholder=\"$empresa   \">
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='idTelefone'>Telefone Contato</label>
                            <input type='tel' class='form-control form-control-sm' name='telefone' id='idTelefone' minlength='15' maxlength='15' onkeydown='javascript: fctMasc( this, mscTel );'  value=\"$telefone\">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class='row align-items-center'>
                        <div class='col-md-12 d-flex justify-content-start gap-2'>
                            <a type='reset' class='btn btn-primary btn-block mb-4' href='../view/vw.perfilUser.php' value='Cancelar'>Cancelar Edição</a>
                            <button type='submit' class='btn btn-primary btn-block mb-4' value='Salvar'>Salvar Alterações</button>
                        </div>
                    </div>
                </form>
            
            ";
        }
    };

    function vwOwner($id){ //view user
        $con = $GLOBALS["con"];
        $sql = "SELECT u.*, e.nmRazaoSocial as 'empresa' FROM tb_cad_user as u 
                inner join tb_cad_empresa e on u.idEmpresa = e.idEmpresa
                where idUser =".$id;
        $query = $con->query($sql);
        while($sql = $query->fetch_array()){
            $idUser = $sql["idUser"];
            $nome= $sql["nmUser"];
            $login= $sql["nmLoginUser"];
            $senha= $sql["nmSenhaUser"];            
            $cpf= $sql["idCPF"];
            $empresa= $sql["empresa"];
            $telefone= $sql["idTelefone"];
            $situacao= $sql["icSituacaoUser"]; 
            if ($situacao == 1){
                $ck = "checked";
            }   
            else{
                $ck = "";
            };
            $perfil = $sql["idPerfil"];         
            echo "
                <form class=''form-horizontal action='/src/controller/c.updPerfil.php' method='POST'>
                    <div class='row align-items-center'>
                        <div class='form-group col-md-1'>
                            <label for='nomeUser'>ID</label>
                            <input type='text' class='form-control form-control-sm' readonly name='nome' id='nmUser' placeholder=". $idUser.">
                        </div>
                        <div class='form-group col-md-9'>
                            <label for='nomeUser'>Nome Completo</label>
                            <input type='text' class='form-control form-control-sm'  name='nome' id='nmUser' placeholder=".$nome.">
                        </div>
                        <div class='form-checkIC col-md-2 align-self-center'>
                            <input class='form-check-input' type='checkbox' name='situacao' id='icSituacaoUser' value=".$situacao." ".$ck.">
                            <label class='form-check-labelform-control-sm' for='icSituacaoUser'>Ativo</label>
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='form-group col-md-4'>
                            <label for='loginUser'>Login do Usuário</label>
                            <input type='text' class='form-control form-control-sm' id='nmLoginUser' name='login' placeholder=".$login.">
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='cpfUser'>CPF Usuário</label>
                            <input type='text' class='form-control form-control-sm' readonly id='idCpf' name='cpf' min='11' maxlength='11' required placeholder=".$cpf.">
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='idEmpresa'>Empresa</label>
                            <input type='text' class='form-control form-control-sm' name='empresa' id='idEmpresa' placeholder=".$empresa.">
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='form-group col-md-4'>
                            <label for='idTelefone'>Telefone Contato</label>
                            <input type='tel' class='form-control form-control-sm' name='telefone' id='idTelefone' minlength='14' maxlength='14' required value='(13) 9' placeholder=".$telefone.">
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='senhaUser'>Senha Antiga</label>
                            <input type='password' class='form-control form-control-sm' id='senhaAntiga' min='8' maxlength='10' name='senhaAntiga'>
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='senhaUser'>Nova Senha</label>
                            <input type='password' class='form-control form-control-sm' id='nmSenhaUser' min='8' maxlength='10'name='senha'>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class='row align-items-center'>
                        <div class='fcol-md-12 d-flex justify-content-start gap-2'>
                            <a type='reset' class='btn btn-primary btn-block mb-4' href='../view/vw.contrato.php' value='Cancelar'>Cancelar Edição</a>
                            <button type='submit' class='btn btn-primary btn-block mb-4' value='Salvar'>Salvar Alterações</button>
                        </div>
                    </div>
                </form>
            
            ";
        }
    };
    class user {
        public $idUser;
        public $nmUser;
        public $nmLoginUser;
        public $nmSenhaUser;
        public $idCPF;
        public $idEmpresa;
        public $idTelefone;
        public $icSituacaoUser;
        public $idPerfil;
        public $con;

        function __construct(){
            $this->con = $GLOBALS["con"];
        }

        function edit_bd($idUser)
        {
            $sql = "select * from tb_cad_user where idUser =" . $idUser;
            $query = $this->con->query($sql);
            $res=$query->fetch_object();
            $this->idUser=$res->idUser;
            $this->nome=$res->nmUser;
            $this->login=$res->nmLoginUser;
            $this->senha=$res->nmSenhaUser;
            $this->cpf=$res->idCPF;
            $this->empresa=$res->idEmpresa;
            $this->situacao=$res->icSituacaoUser;
            $this->perfil=$res->idPerfil;
        }

        function add($nome, $login ,$senha, $cpf, $empresa, $telefone, $situacao, $perfil) {
            $sql = "insert into tb_cad_user (`nmUser`, `nmLoginUser`, `nmSenhaUser`, `idCPF`, `idEmpresa`, `idTelefone`, `icSituacaoUser`, `idPerfil`) values ('$nome','$login','$senha','$cpf','$empresa','$telefone','$situacao','$perfil')";
            return $this->con->query($sql);
        }
        function edit($nmSenhaUser, $auxSenha, $idTelefone, $idUser) {
            if($auxSenha == $_SESSION['senha'])
            {
                $sql = "update tb_cad_user set nmSenhaUser = '$nmSenhaUser', idTelefone = '$idTelefone' where idUser = '$idUser' and nmSenhaUser = '$auxSenha'";
                return $this->con->query($sql);
            }
            if(empty($auxSenha)){
                $sql = "update tb_cad_user set idTelefone = '$idTelefone' where idUser = '$idUser'";
                return $this->con->query($sql);
            }
            else 
            {
              echo"<script> alert('Não houve alterações.');window.location.href='../view/vw.perfil.php.php'</script>";
            }
        }

        function status($idUser)
        {
            $sql = "update tb_cad_user SET icSituacaiUser = 0 where idUser = '$idUser'";
            return $this->con->query($sql);
        }

        function edituser($nmUser,$icSituacaoUser,$nmLoginUser,$nmSenhaUser,$telefone,$cpf){
            $sql = "update tb_cad_user set nmUser = '$nmUser',  icSituacaoUser = '$icSituacaoUser', nmLoginUser = '$nmLoginUser', nmSenhaUser = '$nmSenhaUser', idTelefone = '$telefone' where idCPF = '$cpf'";
            return $this->con->query($sql);
        }
    }
?>