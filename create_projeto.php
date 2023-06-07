<?php

    include("navbar2.php");
    $id = $_SESSION['login']->id;
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
                                        <h3 class="mb-3">Criação de projeto</h3>
                                    </div>
                                    <h1></h1>

                                    <div id="create_acc">
                                        <form action="createProjeto.php" method="post" id="form">
                                            <input type="hidden" id="campo-oculto" name="lider"
                                                value="<?=$_SESSION['login']->id?>">
                                            <div class="row">

                                                <div class="col">
                                                    <label for="senhaId" class="form-label">Nome do projeto:</label>
                                                    <input type="text" name="nome" id="userId" class="form-control"
                                                        placeholder="Informe o seu nome do projeto" required>
                                                </div>
                                                <div class="col">
                                                    <label for="emailId" class="form-label">Objetivo do projeto:</label>
                                                    <input type="text" name="objetivo" id="emailId" class="form-control"
                                                        placeholder="Informe o objetivo do projeto" required>
                                                </div>
                                                <div class="col">
                                                    <label for="senhaId" class="form-label">Tamanho da equipe:</label>
                                                    <input type="number" name="tamanho" id="senhaId"
                                                        class="form-control" placeholder="Informe o tamanho da equipe"
                                                        required>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="card-header">
                                                        Selecione as áreas secundárias necessárias:
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
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <input type="text" name="area_nova"
                                                                        class="form-control"


                                                                        aria-describedby="button-addon2" id="narea">

                                                                </div>
                                                                <div class=col>
                                                                    <button type="button" id="add_area"
                                                                        onclick="adicionarArea();"
                                                                        class="btn btn-outline-primary">Adicionar</button>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="col">
                                                    <div class="card-header">
                                                        Selecione as competências necessárias:
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        <?php foreach(fnListCompetencias() as $competencia):?>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="<?= $competencia->id?>"
                                                                id="<?= $competencia->nome?>" name="competencias[]">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                <?= $competencia->nome?>
                                                            </label>
                                                        </li>
                                                        <?php endforeach;?>
                                                        <li class="list-group-item">
                                                        <div class="row">
                                                                <div class="col">
                                                                    <input id="ncompetencia" type="text" name="nova_comptencia"
                                                                        class="form-control"


                                                                        aria-describedby="button-addon2">

                                                                </div>
                                                                <div class=col>
                                                                    <button type="button" id="add_competencia"
                                                                        onclick="adicionarCompetencia();"
                                                                        class="btn btn-outline-primary">Adicionar</button>
                                                                </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">


                                                <div class="col">
                                                    <input class="btn btn-primary" type="submit" value="Cadastrar">
                                                </div>

                                        </form>
                                        <div id="output"></div>
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

    function adicionarArea() {
        var output = document.getElementById(
            'output'); // Obtém a referência ao elemento HTML onde os elementos serão escritos

        var form = document.createElement("form");
        form.setAttribute("action", "gerarArea.php");
        form.setAttribute("method", "post");
        form.setAttribute("id", "form");

        // Cria o elemento <input> e define seus atributos
        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", "create_area");
        input.setAttribute("value",document.getElementById("narea").value);

        // Adiciona o elemento <input> ao elemento <form>
        form.appendChild(input);

        // Cria o elemento <button> e define seu tipo
        var button = document.createElement("button");
        button.setAttribute("type", "submit");

        // Adiciona o elemento <button> ao elemento <form>
        form.appendChild(button);

        // Adiciona o formulário ao elemento pai desejado (por exemplo, o <body>)
        var parentElement = document.body; // Altere isso para o elemento pai desejado
        parentElement.appendChild(form);

        // Clica no botão de envio automaticamente
        button.click();
    }

    function adicionarCompetencia() {
        var output = document.getElementById(
            'output'); // Obtém a referência ao elemento HTML onde os elementos serão escritos

        var form = document.createElement("form");
        form.setAttribute("action", "gerarCompetencia.php");
        form.setAttribute("method", "post");
        form.setAttribute("id", "form");

        // Cria o elemento <input> e define seus atributos
        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", "create_competencia");
        input.setAttribute("value", document.getElementById("ncompetencia").value);

        // Adiciona o elemento <input> ao elemento <form>
        form.appendChild(input);

        // Cria o elemento <button> e define seu tipo
        var button = document.createElement("button");
        button.setAttribute("type", "submit");

        // Adiciona o elemento <button> ao elemento <form>
        form.appendChild(button);

        // Adiciona o formulário ao elemento pai desejado (por exemplo, o <body>)
        var parentElement = document.body; // Altere isso para o elemento pai desejado
        parentElement.appendChild(form);

        // Clica no botão de envio automaticamente
        button.click();
    }
</script>