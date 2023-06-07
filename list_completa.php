<?php

    include('navbar2.php');
    $titulo = filter_input(INPUT_GET, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
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
                <input style="width: 95%;" id="searchTitulo" class="form-control me-2" size="21" name="titulo" type="search" placeholder="Procurar" aria-label="Search">
            </form>
        </div>
        <table class="table table-striped" width=100%>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Área principal</th>
                    <th>Areas secundárias</th>
                    <th>Competências</th>
                    <th>Data cadastro</th>
                </tr>
            </thead>
            <tbody>
            <?php $qtd=1; foreach(fnListColaboradores() as $usuario):?>
                    <tr>
                        <td><?= $usuario->id ?></td>
                        <td><?= $usuario->user ?></td>
                        <td><?php $area_principal = fnLocalizaAreaPrincipalPorId($usuario->id)?><?=$area_principal->nome?></td>
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
                    </tr>
                    <?php $qtd++; endforeach;?>
            </tbody>
        </table>
    </div>

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
                'set-session.php',
                {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(data)
                }
            )
            .then(response => {
                console.log(`Requisição completa! Resposta:`, response);
            });
        }

        function gerirManga(id, action) {

            post({data : id});

            url = 'removerColaborador.php';
            if(action === 'edit')
                url = 'formulario-edita-manga.php';

            window.location.href = url;
        }
    </script>
</html>

