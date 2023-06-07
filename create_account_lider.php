<?php
    include('config.php');
    require_once('repository/loginrepository.php');
    include("navbar.php")
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width ,initial-scale=1">
    <script src="https://kit.fontawesome.com/7c9e86ad48.js" crossorigin="anonymous"></script>
    <title>Cadastro</title>
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card mb-5" style="border-radius: 15px;">
                        <div class="card-body p-4 cointainer">
                            <div class="cointainer mx-5">
                                <div class="row mx-5">
                                    <div class="col m-5">
                                        <main>
                                            <div id="form-rect">
                                                <h1>Criar conta</h1>
                                                <div id="create_acc">
                                                    <form action="createAccount_lider.php" method="post" id="form">
                                                        <div>
                                                            <label for="emailId" class="form-label">E-mail</label>
                                                            <input type="email" name="email" id="emailId"
                                                                class="form-control" placeholder="Informe o e-mail"
                                                                required>
                                                        </div>
                                                        <div>
                                                            <label for="senhaId" class="form-label">Usuário</label>
                                                            <input type="text" name="user" id="userId"
                                                                class="form-control"
                                                                placeholder="Informe o seu nome de usúario" required>
                                                        </div>
                                                        <div>
                                                            <label for="senhaId" class="form-label">Senha</label>
                                                            <input type="password" name="senha" id="senhaId"
                                                                class="form-control" placeholder="Informe a senha"
                                                                required>
                                                        </div>

                                                        <div class="row my-3">
                                                            <div class="col">
                                                                <input class="btn btn-primary" type="submit"
                                                                    value="Criar conta">
                                                            </div>
                                                        </div>
                                                        
                                                    </form>

                                                </div>
                                        </main>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</html>