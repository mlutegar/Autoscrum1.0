<?php
    include('config.php');
    require_once('repository/loginrepository.php');
    require_once('repository/ProjetoRepository.php');
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
                            <div class="row mx-5">
                                <div class="col m-5">

                                    <div class="row">
                                        <h3 class="mb-3">Criação de conta para colaborador</h3>
                                    </div>
                                    <h1></h1>

                                    <div id="create_acc">
                                        <form action="createAccount_colaborador.php" method="post" id="form">
                                            <div class="row">

                                                <div class="col">
                                                    <label for="senhaId" class="form-label">Usuário</label>
                                                    <input type="text" name="user" id="userId" class="form-control"
                                                        placeholder="Informe o seu nome de usúario" required>
                                                </div>
                                                <div class="col">
                                                    <label for="emailId" class="form-label">E-mail</label>
                                                    <input type="email" name="email" id="emailId" class="form-control"
                                                        placeholder="Informe o e-mail" required>
                                                </div>
                                                <div class="col">
                                                    <label for="senhaId" class="form-label">Senha</label>
                                                    <input type="password" name="senha" id="senhaId"
                                                        class="form-control" placeholder="Informe a senha" required>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col">

                                                <select class="form-select" aria-label="Default select example"
                                                    name="area_principal" required>
                                                    <option selected>Selecione a sua área principal</option>
                                                    <?php foreach(fnListAreas() as $area):?>
                                                    <option value="<?= $area->id?>"><?= $area->nome?></option>
                                                    <?php endforeach;?>
                                                </select>

                                            </div>
                                            <hr>



                                            <div class="row">
                                                <div class="col">
                                                    <div class="card-header">
                                                        Selecione as suas áreas secundárias
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        <?php foreach(fnListAreas() as $area):?>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="<?=$area->id?>" id="<?= $area->nome?>"
                                                                name="areas_secundarias[]">
                                                            <!-- Adicione [] no nome para criar um array de valores -->
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                <?= $area->nome?>
                                                            </label>
                                                        </li>
                                                        <?php endforeach;?>
                                                    </ul>
                                                </div>

                                                <div class="col">
                                                    <div class="card-header">
                                                        Selecione as suas competências
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        <?php foreach(fnListCompetencias() as $competencia):?>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="<?= $competencia->id?>"
                                                                id="<?= $competencia->nome?>" name="competencias[]"
                                                                >
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                <?= $competencia->nome?>
                                                            </label>
                                                        </li>
                                                        <?php endforeach;?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">


                                                <div class="col">
                                                    <input class="btn btn-primary" type="submit" value="Cadastrar">
                                                </div>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

</html>

<script>
    document.getElementById("form").addEventListener("submit", function (event) {
        var checkboxes1 = document.querySelectorAll("input[name='areas_secundarias[]']");
        var checkboxes2 = document.querySelectorAll("input[name='competencias[]']");
        var checked1 = false;
        var checked2 = false;

        for (var i = 0; i < checkboxes1.length; i++) {
            if (checkboxes1[i].checked) {
                checked1 = true;
                break;
            }
        }

        if (!checked1 && !checked2) {
            event.preventDefault(); // Impede o envio do formulário
            alert("Selecione pelo menos uma área secundária.");
        }
    });
</script>