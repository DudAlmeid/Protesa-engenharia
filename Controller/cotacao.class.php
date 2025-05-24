<?php
    class cotacao{
        public $idSolicitacao;
        public $titulo;
        public $descricao;
        public $status;
        public $dataSol;
        public $idUser;
        public $empresa;

        function __construct($idSolicitacao, $titulo, $descricao, $status,$dataSol,$idUser,$empresa){
        $this->idSolicitacao = $idSolicitacao;
        $this->nmTituloSolicitacao = $titulo;
        $this->dsSolicitacao = $descricao;
        $this->idStatusSolicitacao = $status;
        $this->dtSolicitacao = $dataSol;
        $this->idUserSolicitacao = $idUser;
        $this->idEmpresa = $empresa;
        }
    }
    class projeto{
        public $idProjeto;
        public $idTec;
        public $situacao;
        public $status;
        public $idSol;

        function __construct($idProjeto, $idTec, $situacao, $status,$idSol){
        $this->idProjeto = $idProjeto;
        $this->idUserTecnico = $idTec;
        $this->idSituacaoProjeto = $situacao;
        $this->idStatusSolicitacao = $status;
        $this->idSolicitacaoProjeto = $idSol;
        }
    }
?>