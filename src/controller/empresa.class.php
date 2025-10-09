<?php
    class empresa{
        public $idEmpresa;
        public $razaoSocial;
        public $cnpj;
        public $situacao;
        

        function __construct($idEmpresa, $razaoSocial, $cnpj, $situacao){
            $this->idEmpresa = $idEmpresa;
            $this->nmRazaoSocial =$razaoSocial;
            $this->idCNPJ = $cnpj;
            $this->icSituacaoEmpresa =$situacao;
        }

    }

?>
