<?php 
    include '../template/referencia.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Login | PROTESA ENGENHARIA</title>
    <?php init(); ?>
</head>

<body>
    <?php navbar();?>

    <section id="login">
        <div class="fundoLogin wow fadeIn">
            <br>
            <br>
            <h1 class="mb-4 pb-0">Acesse sua <span>conta</span></h1>
            <br>
            <div class="tab-content col-md-12 d-flex justify-content-center">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form method="post" action="../controller/c.login.php">
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="user" id="inputName" class="form-control" name="login" placeholder="Usuário" required autofocus/>
                        </div>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" id="inputPassword" class="form-control" name="senha" placeholder="Senha" required />
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6 d-flex justify-content-center">
                            <!-- Checkbox -->
                                <div class="form-check mb-3 mb-md-0">
                                    <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                    <label class="form-check-label opt" for="loginCheck"> Lembre-se de mim </label>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                            <!-- Esqueceu a senha -->
                            <a href="#!"><span>Esqueceu a senha?</span></a>
                            </div>
                        </div>
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    

    <?php footer();?>
</body>
</html>