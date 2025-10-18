<?php
    function init(){
        setlocale(LC_ALL, 'pt_BR.utf-8');
        date_default_timezone_set('America/Sao_Paulo');
        echo"
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://getbootstrap.com/docs/5.3/assets/css/docs.css' rel='stylesheet'>
        <link rel='icon' href='/src/template/img/icon.png'/>
        <link rel='stylesheet' type='text/css' media='screen' href='/src/template/css/bootstrap.css' />
        <link rel='stylesheet' type='text/css' media=screen href='/src/template/css/estilo.css' />
        <link rel='stylesheet' href='/src/template/css/themify-icons/themify-icons.css'>
        <link rel='stylesheet' href='/src/template/css/bootstrap-icons-1.11.3/font/bootstrap-icons.css'>
        <script src='/src/template/js/bootstrap.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>";
    }
?>

<meta charset="UTF-8">
<?php
    function navbar(){
        echo "
            <nav class='navbar navbar-expand-md sticky-top navbar-dark bg-dark'>  
                <div class='container-fluid'>
                    <a class='navbar-brand' href='/src/view/index.php'>
                        <img src='/src/template/img/protesa_engenharia_logo.jpg' width='50' height='50' class='d-inline-block align-top' alt=''>
                    </a>
                    <!--menu responsivo-->
                    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#menu' aria-controls='menu' aria-expanded='false' aria-label='Toggle navigation'>
                        <span class='navbar-toggler-icon'></span>
                    </button>
                    <div class='collapse navbar-collapse' id='menu'>
                        <ul class='navbar-nav mr-auto'>
                            <li class='nav-item active'>
                                <a class='nav-link' href='/src/view/index.php'>Home</a>
                            </li>
                            <li class='nav-item active'>
                                <a class='nav-link' href='/src/view/vw.login.php'>Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        ";  
    }   
    function navbarTecA(){
        if(isset($_SESSION['tipo'])){
            if($_SESSION['tipo'] == '1'){
                echo" 
                    <nav class='navbar navbar-expand-md sticky-top navbar-dark bg-dark'>  
                        <div class='container-fluid'>
                            <a class='navbar-brand' href='/src/view/index.php'>
                                <img src='/src/template/img/protesa_engenharia_logo.jpg' width='50' height='50' class='d-inline-block align-top' alt=''>
                            </a>
                            <!--menu responsivo-->
                            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#menu' aria-controls='menu' aria-expanded='false' aria-label='Toggle navigation'>
                                <span class='navbar-toggler-icon'></span>
                            </button>
                            <div class='collapse navbar-collapse' id='menu'>
                                <ul class='navbar-nav mr-auto'>
                                    <li class='nav-item active'>
                                        <a class='nav-link' href='/src/view/vw.usuario.php'>Usuários</a>
                                    </li>
                                    <li class='nav-item active'>
                                        <a class='nav-link' href='/src/view/vw.solicitacao.php'>Solicitação</a>
                                    </li>
                                    <li class='nav-item active'>
                                        <a class='nav-link' href='/src/view/vw.contrato.php'>Contratos</a>
                                    </li>
                                    <li class='nav-item active'>
                                        <a class='nav-link' href='/src/view/vw.perfil.php'>Perfil</a>
                                    </li>      
                                    <li class='nav-item active'>
                                        <a class='nav-link' href='/src/view/vw.chCancelado.php'>Cancelamentos</a>
                                    </li>                             
                                    <li>
                                        <a class='nav-link me-2' href='/src/controller/c.logout.php'><span class='ti-close'></span>&nbspSair</a>
                                    </li>
                                </ul>
                            </div>
                            <a class='nav-link'>
                            ".'User: '.$_SESSION['nome'].'   |   ID: '.$_SESSION['id']."
                            </a>
                            <a class='nav-link active' href='/src/view/vw.manUsuario.php'>Cadastrar Usuário</a>
                        </div>
                    </nav>
                ";
            }
        }
    }
    function navbarTec(){
        if(isset($_SESSION['tipo'])){
            if($_SESSION['tipo'] == '2'){
                echo" 
                    <nav class='navbar navbar-expand-md sticky-top navbar-dark bg-dark'>  
                        <div class='container-fluid'>
                            <a class='navbar-brand' href='/src/view/index.php'>
                                <img src='/src/template/img/protesa_engenharia_logo.jpg' width='50' height='50' class='d-inline-block align-top' alt=''>
                            </a>
                            <!--menu responsivo-->
                            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#menu' aria-controls='menu' aria-expanded='false' aria-label='Toggle navigation'>
                                <span class='navbar-toggler-icon'></span>
                            </button>
                            <div class='collapse navbar-collapse' id='menu'>
                                <ul class='navbar-nav mr-auto'>
                                    <li class='nav-item active'>
                                        <a class='nav-link' href='/src/view/vw.solicitacao.php'>Solicitação</a>
                                    </li>
                                    <li class='nav-item active'>
                                        <a class='nav-link' href='/src/view/vw.contrato.php'>Contratos</a>
                                    </li>
                                    <li class='nav-item active'>
                                        <a class='nav-link' href='/src/view/vw.perfil.php'>Perfil</a>
                                    </li>
                                    <li>
                                        <a class='nav-link me-2' href='/src/controller/c.logout.php'><span class='ti-close'></span>&nbspSair</a>
                                    </li>
                                </ul>
                            </div>
                            <a class='nav-link'>
                            ".'User: '.$_SESSION['nome'].'   |   ID: '.$_SESSION['id']."
                            </a>
                        </div>
                    </nav>
                ";
            }
        }
    }
    function navbarCli(){
        if(isset($_SESSION['tipo'])){
            if($_SESSION['tipo'] == '3'){
                echo" 
                    <nav class='navbar navbar-expand-md sticky-top navbar-dark bg-dark'>  
                        <div class='container-fluid'>
                            <a class='navbar-brand' href='/src/view/index.php'>
                                <img src='/src/template/img/protesa_engenharia_logo.jpg' width='50' height='50' class='d-inline-block align-top' alt=''>
                            </a>
                            <!--menu responsivo-->
                            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#menu' aria-controls='menu' aria-expanded='false' aria-label='Toggle navigation'>
                                <span class='navbar-toggler-icon'></span>
                            </button>
                            <div class='collapse navbar-collapse' id='menu'>
                                <ul class='navbar-nav mr-auto'>
                                    <li class='nav-item active'>
                                        <a class='nav-link' href='/src/view/vw.solicitacao.php'>Solicitação</a>
                                    </li>
                                    <li class='nav-item active'>
                                        <a class='nav-link' href='/src/view/vw.contrato.php'>Contratos</a>
                                    </li>
                                    <li class='nav-item active'>
                                        <a class='nav-link' href='/src/view/vw.perfil.php'>Perfil</a>
                                    </li>
                                    <li>
                                        <a class='nav-link me-2' href='/src/controller/c.logout.php'><span class='ti-close'></span>&nbspSair</a>
                                    </li>
                                </ul>
                            </div>
                            <a class='nav-link'>
                            ".'User: '.$_SESSION['nome'].'   |   ID: '.$_SESSION['id']."
                            </a>
                            <a class='nav-link active' href='/src/view/vw.cadSol.php'>Solicitar</a>
                        </div>
                    </nav>
                ";
            }
        }
    }
    function footer(){
        echo "
            <footer class='text-center bg-body-tertiary'>
                <div class='container pt-4'>
                    <section class='mb-4'>
                        <a data-mdb-ripple-init class='btn btn-link btn-floating btn-lg text-body m-1'
                            href='https://www.linkedin.com/company/protesa-engenharia/about/'
                            role='button'
                            data-mdb-ripple-color='dark'>
                            <i class='bi-linkedin'></i>
                        </a>

                        <a data-mdb-ripple-init class='btn btn-link btn-floating btn-lg text-body m-1'
                            href='https://www.econodata.com.br/consulta-empresa/40670110000185-PROTESA-ENGENHARIA-LTDA'
                            role='button'
                            data-mdb-ripple-color='dark'>
                            <i class='bi-google'></i>
                        </a>

                        <a data-mdb-ripple-init class='btn btn-link btn-floating btn-lg text-body m-1'
                            href='https://www.linkedin.com/company/protesa-engenharia/about/'
                            role='button'
                            data-mdb-ripple-color='dark'>
                            <i class='bi-facebook'></i>
                        </a>

                        <a data-mdb-ripple-init class='btn btn-link btn-floating btn-lg text-body m-1'
                            href='https://www.linkedin.com/company/protesa-engenharia/about/'
                            role='button'
                            data-mdb-ripple-color='dark'>
                            <i class='bi-instagram'></i>
                        </a>

                        <a data-mdb-ripple-init class='btn btn-link btn-floating btn-lg text-body m-1'
                            href='https://wa.me/5513981575713'
                            role='button'
                            data-mdb-ripple-color='dark'>
                            <i class='bi-whatsapp'></i>
                        </a>
                    </section>
                </div>

                <div class='text-center p-4' style='background-color: rgba(0, 0, 0, 0.05);'>
                    <div class='footer-copyright text-center py-0' style='font-size: 9pt'>Projeto Integrador em Computação I | Grupo 21 | Univesp | 01/2025.</div>
                    <div class='footer-copyright text-center py-3' style='font-size: 8pt'>Todos os direitos reservados. </div>
                </div>
            </footer>
        ";
    }
?>