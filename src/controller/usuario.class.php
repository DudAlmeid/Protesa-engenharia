<?php
    class user{
        public $idUser;
        public $nome;
        public $login;
        public $senha;
        public $cpf;
        public $empresa;
        public $telefone;
        public $situacao;
        public $perfil;
        //public $idSolicitacao;

        function __construct($idUser, $nome, $login, $senha, $empresa, $telefone, $situacao, $perfil){
            $this->idUser = $idUser;
            $this->nmUser = $nome;
            $this->nmLoginUser = $login;
            $this->nmSenhaUser = $senha;
            $this->idEmpresa = $empresa;  
            $this->idTelefone = $telefone;    
            $this->icSituacaoUser = $situacao;
            $this->idPerfil = $perfil;
        }

    }

    class Login{
        public $login;
        public $senha;
        public $perfil;
        public $situacao;

        function __construct($login, $senha, $perfil,$situacao){
            $this->nmLoginUser = $login;
            $this->nmSenhaUser = $senha;
            $this->idPerfil = $perfil;
            $this->icSituacaoUser = $situacao;
        }
    }

?>
