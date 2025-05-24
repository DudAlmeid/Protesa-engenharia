<meta charset="UTF-8">
<?php
    function vwEmp(){
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM tb_cad_empresa";
        $query = $con->query($sql);
        echo '<p>Registros encontrados: '.$query->num_rows.'</p>';
        while($sql = $query->fetch_array()){
            $idEmpresa = $sql["idEmpresa"];
            $razaosocial= $sql["nmRazaoSocial"];
            $cnpj= $sql["idCNPJ"];
            $situacao= $sql["icSituacaoEmpresa"];     
            echo "<br/><tr>
            <td>$idEmpresa   |</td>
            <td>$razaosocial   |</td>
            <td>$cnpj   |</td>
            <td>$situacao   |</td>
            </tr>";
        }
    };
    class empresa{
        public $idEmpresa;
        public $nmRazaoSocial;
        public $idCNPJ;
        public $icSituacaoEmpresa;
        public $con;

        function __construct(){
            $this->con = $GLOBALS["con"];
        }
        function add($razaosocial, $cnpj, $situacao){
            $this->nmRazaoSocial =$razaosocial;
            $this->idCNPJ = $cnpj;
            $this->icSituacaoEmpresa =$situacao;
            $sql = "insert into tb_cad_empresa (`nmRazaoSocial`, `idCNPJ`, `icSituacaoEmpresa`) values ('$razaosocial','$cnpj','$situacao')";
            return $this->con->query($sql);
        }

    }
?>