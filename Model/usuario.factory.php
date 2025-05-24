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
            // Armazenar os dados em um array
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

    function vwUser(){ //view admin
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM tb_cad_user";
        $query = $con->query($sql);
        echo '<p>Registros encontrados: '.$query->num_rows.'</p>';
        while($sql = $query->fetch_array()){
            $idUser = $sql["idUser"];
            $nome= $sql["nmUser"];
            $login= $sql["nmLoginUser"];
            $senha= $sql["nmSenhaUser"];            
            $cpf= $sql["idCPF"];
            $empresa= $sql["idEmpresa"];
            $telefone= $sql["idTelefone"];
            $situacao= $sql["icSituacaoUser"];     
            $perfil = $sql["idPerfil"];         
            echo "
                <form class=''form-horizontal action='..\controller\c.updPerfil.php' method='POST'>
                    <div class='row align-items-center'>
                        <div class='form-group col-md-1'>
                            <label for='nomeUser'>ID</label>
                            <input type='text' class='form-control form-control-sm' readonly name='nome' id='nmUser' placeholder=". $idUser.">
                        </div>
                        <div class='form-group col-md-8'>
                            <label for='nomeUser'>Nome Completo</label>
                            <input type='text' class='form-control form-control-sm' readonly name='nome' id='nmUser' placeholder=".$nome.">
                        </div>
                        <div class='form-checkIC col-md-3 align-self-center'>
                            <input class='form-check-input'  type='checkbox' value='1' id='icSituacaoUser' name='situacao'>
                            <label class='form-check-labelform-control-sm' for='icSituacaoUser'>Ativo</label>
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='form-group col-md-4'>
                            <label for='cpfUser'>CPF Usuário</label>
                            <input type='text' class='form-control form-control-sm' onkeydown='javascript:fncMasc(this, mscCPF),validaCPF(this,mscCPF);' id='idCpf' name='cpf' min='11' maxlength='11' required placeholder=".$cpf.">
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='loginUser'>Login do Usuário</label>
                            <input type='text' class='form-control form-control-sm' id='nmLoginUser' name='login' placeholder=".$login.">
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='senhaUser'>Senha do Usuário</label>
                            <input type='password' class='form-control form-control-sm' id='nmSenhaUser' name='senha' placeholder=".$senha.">
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='form-group col-md-8'>
                            <label for='idEmpresa'>Empresa</label>
                            <input type='text' class='form-control form-control-sm' readonly name='empresa' id='idEmpresa' placeholder=".$empresa.">
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='idTelefone'>Telefone Contato</label>
                            <input type='tel' class='form-control form-control-sm' name='telefone' id='idTelefone' minlength='15' maxlength='15' onkeydown='javascript: fctMasc( this, mscTel );' required value='(13) 9' placeholder=".$telefone.">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class='row align-items-center'>
                        <div class='col-md-12 d-flex justify-content-start gap-2'>
                            <a type='reset' class='btn btn-primary btn-block mb-4' href='../view/vw.contrato.php' value='Cancelar'>Cancelar Edição</a>
                            <button type='submit' class='btn btn-primary btn-block mb-4' value='Salvar'>Salvar Alterações</button>
                        </div>
                    </div>
                </form>
            
            ";
        }
    };

    function vwOwner($id){ //view user
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM tb_cad_user where idUser =".$id;
        $query = $con->query($sql);
        while($sql = $query->fetch_array()){
            $idUser = $sql["idUser"];
            $nome= $sql["nmUser"];
            $login= $sql["nmLoginUser"];
            $senha= $sql["nmSenhaUser"];            
            $cpf= $sql["idCPF"];
            $empresa= $sql["idEmpresa"];
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
                <form class=''form-horizontal action='..\controller\c.updPerfil.php' method='POST'>
                    <div class='row align-items-center'>
                        <div class='form-group col-md-1'>
                            <label for='nomeUser'>ID</label>
                            <input type='text' class='form-control form-control-sm' readonly name='nome' id='nmUser' placeholder=". $idUser.">
                        </div>
                        <div class='form-group col-md-9'>
                            <label for='nomeUser'>Nome Completo</label>
                            <input type='text' class='form-control form-control-sm' readonly name='nome' id='nmUser' placeholder=".$nome.">
                        </div>
                        <div class='form-checkIC col-md-2 align-self-center'>
                            <input class='form-check-input' type='checkbox' name='situacao' disabled id='icSituacaoUser' value=".$situacao." ".$ck.">
                            <label class='form-check-labelform-control-sm' for='icSituacaoUser'>Ativo</label>
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='form-group col-md-4'>
                            <label for='loginUser'>Login do Usuário</label>
                            <input type='text' class='form-control form-control-sm' id='nmLoginUser' readonly name='login' placeholder=".$login.">
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='cpfUser'>CPF Usuário</label>
                            <input type='text' class='form-control form-control-sm' readonly id='idCpf' name='cpf' min='11' maxlength='11' required placeholder=".$cpf.">
                        </div>
                        <div class='form-group col-md-4'>
                            <label for='idEmpresa'>Empresa</label>
                            <input type='text' class='form-control form-control-sm' readonly name='empresa' id='idEmpresa' placeholder=".$empresa.">
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
    }
?>