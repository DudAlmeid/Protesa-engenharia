<?php 
    require_once '../config/session_config.php';
if (empty($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: vw.login.php");
    exit();
}

    include '../template/referencia.php';
    include '../model/connection.php'; 
    include '../model/usuario.factory.php';
    include '../model/empresa.factory.php';
    require "../template/fct.php";
?>

<!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <title>Manutenção de Registros | PROTESA ENGENHARIA</title>
        <?php init(); ?>
    </head>

    <body>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <!--navbar-->
        <?php navbarTecA();?>
        <!--formulario de cadastro Usu/Emp-->
        <div class="consistent-height">
            <ul class="nav nav-pills nav-justified mb-3" id="navAdmin" role="tablist">
                <li class="nav-item">
                    <a 
                        class="nav-link active"
                        id="tab-user"
                        data-toggle="tab"
                        href="#pills-user"
                        aria-selected="true"> Usuário
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a 
                        class="nav-link"
                        id="tab-emp"
                        data-toggle="tab"
                        href="#pills-emp"
                        aria-selected="false"> Empresa
                    </a>
                </li>
            </ul>                   
            <div class="tab-content">
                <!--formulario user-->
                <div
                    class="tab-pane active"
                    id="pills-user">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="col-md-auto">
                                    <div class="border border-white">
                                        <header class="text-center">
                                            <br>
                                            <h1>Cadastro de Usuário</h1>
                                            <br>
                                        </header>   
                                        <form name="formCadUser" class="form-horizontal" action="../controller/c.cadUser.php" method="POST" onsubmit="return(verifica()" enctype="multipart/form-data">
                                            <div class="row align-items-center">
                                                <div class="form-group col-md-9">
                                                    <label for="nomeUser">Nome Completo</label>
                                                    <input type="text" class="form-control form-control-sm" name="nome" id="nmUser" placeholder="Terezinha de Jesus">
                                                </div>
                                                
                                                <div class="form-checkIC col-md-3 align-self-center">
                                                    <input class="form-check-input"  type="checkbox" value="1" id="icSituacaoUser" name="situacao">
                                                    <label class="form-check-labelform-control-sm" for="icSituacaoUser">Ativo</label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="cpfUser">CPF Usuário</label>
                                                    <input type="text" class="form-control form-control-sm" onkeydown="javascript:fncMasc(this, mscCPF),validaCPF(this,mscCPF);" id="idCpf" name="cpf" min="11" maxlength="11" required placeholder="000.000.000-00">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="loginUser">Login do Usuário</label>
                                                    <input type="text" class="form-control form-control-sm" id="nmLoginUser" name="login" placeholder="TJESUS">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="senhaUser">Senha do Usuário</label>
                                                    <input type="password" class="form-control form-control-sm" id="nmSenhaUser" min="8" maxlength="10" name="senha" placeholder="Mínimo 6 | Máximo 10">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="form-group col-md-8">
                                                    <label for="idEmpresa">Empresa</label>
                                                    <select id="idEmpresa" name="empresa" class="form-control form-control-sm">
                                                        <option value="">Selecione...</option>
                                                        <?php
                                                            $empresas = getEmpresa();
                                                            foreach ($empresas as $empresa){
                                                            ?>
                                                            <option value="<?php echo $empresa['idEmpresa'] ?>"> <?php echo $empresa['nmRazaoSocial'] ?></option>
                                                            <?php $idEmpresa == $empresa['idEmpresa'];?>
                                                            <?php 
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="idTelefone">Telefone Contato</label>
                                                    <input type="tel" class="form-control form-control-sm" name="telefone" id="idTelefone" minlength="15" maxlength="15" onkeydown="javascript: fctMasc( this, mscTel );" required value="(13) 9" placeholder="(00)00000-0000">
                                                </div>
                                            </div>
                                            <br>
                                            <label for="idPerfil">Tipo de Perfil</label>
                                            <div class="form-check">  
                                                <div class=" form-check-inline text-center">
                                                    <?php
                                                        $perfis = getPerfil();
                                                        foreach ($perfis as $perfil){
                                                            ?>
                                                            <input class="form-check-input" type="radio" name="perfil" id="<?php echo $perfil['idPerfil']?>" value="<?php echo $perfil['idPerfil']?>">
                                                            <label class="form-check-label" name="<?php echo $perfil['idPerfil']?>"> <?php echo $perfil['nmPerfil']?> &nbsp &nbsp&nbsp &nbsp&nbsp &nbsp</label>
                                                            <?php
                                                        }       
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-md-12 d-flex justify-content-start gap-2">
                                                <a type="reset" class="btn btn-primary btn-block mb-4" href="/src/view/vw.usuario.php" value="Cancelar">Cancelar</a>
                                                <button type="submit" class="btn btn-primary btn-block mb-4" value="Enviar">Cadastrar</button>
                                            </div>
                                        </form>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--formulario empresa-->
                <div
                    class="tab-pane"
                    id="pills-emp">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="col-md-auto">
                                    <div class="border border-white">
                                        <header class="text-center">
                                            <br>
                                            <h1>Cadastro de Empresa</h1>
                                            <br>
                                        </header>   
                                        <form name="formCadEmp" class="form-horizontal" action="../controller/c.cadEmp.php" method="POST" onsubmit="return(verifica()" enctype="multipart/form-data">
                                            <div class="row align-items-center">
                                                <div class="form-group col-md-9">
                                                    <label for="cnpjEmp">CNPJ</label>
                                                    <input type="text" class="form-control form-control-sm" onkeydown="javascript:fncMasc(this, mscCNPJ),validaCNPJ(this,mscCNPJ);" name="cnpj" id="idCNPJ" min="14" maxlength="14" required placeholder="00.000.000/0000-00">
                                                </div>
                                                <div class="form-checkIC col-md-3 align-self-center">
                                                    <input class="form-check-input"  type="checkbox" value="1" id="icSituacaoEmpresa" name="situacao">
                                                    <label class="form-check-labelform-control-sm" for="icSituacaoEmpresa">Ativo</label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="razaoSocial">Razão Social</label>
                                                    <input type="text" class="form-control form-control-sm" name="razaosocial" id="nmRazaoSocial" placeholder="Protesa Engenharia LTDA">
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="col-md-12 d-flex justify-content-start gap-2">
                                                <a type="reset" class="btn btn-primary btn-block mb-4" href="/src/view/vw.usuario.php" value="Cancelar">Cancelar</a>
                                                <button type="submit" class="btn btn-primary btn-block mb-4" value="Enviar">Cadastrar</button>
                                            </div>
                                        </form>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <br>                                          
        <?php footer(); ?>
    </body>
</html>