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
        public $idItem;
        public $dtTramite;
        public $tramite;
        public $userTramite;
        public $docAnx;
        public $imgAnx;


        function __construct($idProjeto, $idTec, $situacao, $status,$idSol,$idItem,$tramite,$userTramite,$dtTramite,$docAnx,$imgAnx){
        $this->idProjeto = $idProjeto;
        $this->idUserTecnico = $idTec;
        $this->idSituacaoProjeto = $situacao;
        $this->idStatusSolicitacao = $status;
        $this->idSolicitacaoProjeto = $idSol;
        $this->idItemProjeto = $idItem;
        $this->dsItemProjeto = $tramite;
        $this->dtItemProjeto = $dtTramite;
        $this->idItemUser = $userTramite;
        $this->docItemProjeto = $docAnx;
        $this->imgItemProjeto = $imgAnx;
        }
    }
?>