<?php
include "../model/connection.php";
include "../model/projeto.factory.php";
require "../template/fct.php";

$userTramite = $_SESSION['id'];

date_default_timezone_set('America/Sao_Paulo');
$dtTramite = date('Y-m-d H:i:s');

$docNomeFinal = null;
$imgNomeFinal = null;
$caminho_base = '../Files_Protesa/';
$diretorio = $caminho_base . "chamado_" . $_POST['idProj'] . "/";
if (!file_exists($diretorio)) {
    if (!mkdir($diretorio, 0777, true)) {
        die("Erro ao criar diretório: $diretorio");
    }
}

if (isset($_FILES['imgAnx']) && $_FILES['imgAnx']['error'] == 0) {
    $ext = strtolower(pathinfo($_FILES['imgAnx']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, array('jpg', 'jpeg', 'png'))) {
        $imgNomeFinal = uniqid('img_') . '.' . $ext;
        if (!move_uploaded_file($_FILES['imgAnx']['tmp_name'], $diretorio . $imgNomeFinal)) {
            die("Erro ao mover imagem.");
        }
    } else {
        die("Extensão da imagem inválida.");
    }
}

if (isset($_FILES['docAnx']) && $_FILES['docAnx']['error'] == 0) {
    $ext = strtolower(pathinfo($_FILES['docAnx']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, array('doc', 'docx', 'pdf', 'xlsx'))) {
        $docNomeFinal = uniqid('doc_') . '.' . $ext;
        if (!move_uploaded_file($_FILES['docAnx']['tmp_name'], $diretorio . $docNomeFinal)) {
            die("Erro ao mover documento.");
        }
    } else {
        die("Extensão do documento inválida.");
    }
}

$tramite = new projeto();
if ($tramite->addTramite($dtTramite, $_POST['tramite'], $userTramite, $docNomeFinal, $imgNomeFinal, $_POST['idProj'])) {
    $tramite->statusP($_POST['idStatus'], $_POST['idProj']);
    echo $_POST['idStatus'];
    header("Location: ../view/vw.contrato.php");
    exit;
} else {
    echo "Erro ao salvar no banco.";
}

if(isset($_POST['idStatus'])){
    if($_POST['idStatus'] == 8){
        $cancela = new cotacao();
            if ($cancela->cancelaSol($idSol)) {
        header("Location: ../view/vw.solicitacao.php");
        exit;
        } else {
            echo "<script> alert('Erro ao inserir dados, tente novamente');</script>";
            if (mysqli_connect_errno()) {
                trigger_error(mysqli_connect_error());
            }
        }
        } else {
            echo "<script>alert('Solicitação inválida');</script>";     
        }
    }

?>