<?php
    include('navbar2.php');
    $titulo = filter_input(INPUT_GET, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
    $id_projeto = $_SESSION['id'];
    $projeto = fnLocalizaProjetoPorId($id_projeto);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem</title>
</head>

<body>

    <div style="padding: 75px; margin: auto; width: 80%;">
        <div style="width: 100%; margin-left: 1.5%; margin-bottom: 5%">
            <form id="formSearchTitulo" role="search" method="post" action="localiza-colaborador.php">
                <input style="width: 95%;" id="searchTitulo" class="form-control me-2" size="21" name="titulo"
                    type="search" placeholder="Procurar" aria-label="Search">
            </form>
        </div>
        <table class="table table-striped" width=100%>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Área principal</th>
                    <th>Areas secundárias</th>
                    <th>Competências</th>
                    <th>Data cadastro</th>
                    <th>Gerenciar</th>
                </tr>
            </thead>
            <tbody>
                <?php $qtd=1; foreach(fnLocalizaColaboradoresPorProjeto($id_projeto) as $usuario):?>
                <tr>
                    <td><?= $usuario->id ?></td>
                    <td><?= $usuario->user ?></td>
                    <td><?php if($qtd==1){echo("PO");}elseif($qtd==2){echo("SM");}else{echo("Desenvolvimento");} ?></td>
                    <td><?php $area_principal = fnLocalizaAreaPrincipalPorId($usuario->id)?><?=$area_principal->nome?>
                    </td>
                    <td>
                        <?php foreach(fnLocalizaAreasSecundariasPorId($usuario->id) as $area):?>
                        <?= $area->nome?>
                        <?php endforeach;?>
                    </td>
                    <td>
                        <?php foreach(fnLocalizaCompetenciasPorId($usuario->id) as $competencia):?>
                        <?= $competencia->nome?>
                        <?php endforeach;?>
                    </td>
                    <td><?= $usuario->created_at ?></td>
                    <td><a style="color: red;" onclick="adicionarArea(<?=$usuario->id?>);" href="#">Remover</a></td>
                </tr>
                <?php $qtd++; endforeach;?>
            </tbody>
        </table>
    </div>

    <div id="output"></div>

    <?php if(isset($notificacao)) : ?>
    <tfoot>
        <tr>
            <td colspan="7"><?= $_COOKIE['notify'] ?></td>
        </tr>
    </tfoot>
    <?php endif; ?>

</body>
<script>
    window.post = (data) => {
        return fetch(
                'set-session.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }
            )
            .then(response => {
                console.log(`Requisição completa! Resposta:`, response);
            });
    }

    function gerirManga(id, action) {

        post({
            data: id
        });

        url = 'removerColaborador.php';
        if (action === 'edit')
            url = 'formulario-edita-manga.php';

        window.location.href = url;
    }

    function adicionarArea(colaborador_apagar) {
        var output = document.getElementById(
            'output'); // Obtém a referência ao elemento HTML onde os elementos serão escritos

        var form = document.createElement("form");
        form.setAttribute("action", "removerColaborador.php");
        form.setAttribute("method", "post");
        form.setAttribute("id", "form");

        // Cria o elemento <input> e define seus atributos
        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", "create_area");
        input.setAttribute("value", colaborador_apagar);

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

</html>
