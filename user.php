<?php
include('navbar2.php');
$id = $_SESSION['login']->id;
$user = fnLocalizaUserPorId($id);
$area_principal = fnLocalizaAreaPrincipalPorId($id);
$competencias = fnLocalizaCompetenciasPorId($id);
$areas = fnLocalizaAreasSecundariasPorId($id);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width ,initial-scale=1">
    <script src="https://kit.fontawesome.com/7c9e86ad48.js" crossorigin="anonymous"></script>
    <title>Usuário</title>
    <link rel="stylesheet" href="css/user.css">
</head>

<?php if($user->cargo == "Lider"):?>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card mb-5" style="border-radius: 15px;">
                    <div class="card-body p-4 cointainer">
                        <div class="row">
                            <h3 class="mb-3"><?=$_SESSION['login']->user?></h3>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="small mb-0"> <?=$_SESSION['login']->cargo?>

                            </div>

                            <div class="col">

                            </div>

                        </div>

                        <hr class="my-4">

                        <div class="row mx-1">
                            <div class="col">
                                <div class="card-header">
                                    Projetos <span class="mx-2">|</span> <button type="button"
                                        onclick="window.location='create_projeto.php'" class="btn btn-secondary">Criar novo
                                        projeto</button> <button type="button"
                                        onclick="window.location='list_completa.php'" class="btn btn-secondary">Visualizar todos os colaboradores</button>
                                </div>
                                <ul class="list-group list-group-flush">
                                <?php $n=0; foreach(fnLocalizaProjetoPorLider($id) as $projeto):?>
                                    <li class="list-group-item">
<div class="row">
                                    <div class="col">
                                        <?=$projeto->nome?>
                                        </div>
                                        <div class="col-1">
                                        <span class="mx-2">|</span>
                                        </div>
                                        <div class="col">
                                        <button type="button"
                                            class="btn btn-primary btn-sm" onclick="gerirManga(<?= $projeto->id?>, 'edit');">Tabela de colaboradores</button>
                                        </div>
                                        <div class="col-1">
                                        <span class="mx-2">|</span>
                                        </div>
                                        <div class="col">
                                        <button type="button"
                                            class="btn btn-primary btn-sm" onclick="gerirManga(<?= $projeto -> id?>, 'del')">Visualizar projeto</button>
                                        </div>
                                        </div>
                                    </li>
                                <?php $n++; endforeach; if ($n==0):?>
                                        <li class="list-group-item">
                                        Sem projeto
                                    </li>
                                <?php endif;?>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col">

                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <a href="logout.php">Deslogar</a>
                        </div>
                        <div id="notify" class="form-text text-capitalize fs-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php else:?>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card mb-5" style="border-radius: 15px;">
                    <div class="card-body p-4 cointainer">
                        <div class="row">
                            <h3 class="mb-3"><?=$_SESSION['login']->user?></h3>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="small mb-0"> <?=$_SESSION['login']->cargo?> <span class="mx-2">|</span>
                                    Aréa de conhecimento principal: <?= $area_principal->nome ?></p>

                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row mx-1">
                            <div class="col">
                                <div class="card-header">
                                    Áreas de conhecimento secundarias
                                </div>
                                <ul class="list-group list-group-flush">
                                    <?php foreach(fnLocalizaAreasSecundariasPorId($id) as $area):?>
                                    <li class="list-group-item"><?= $area->nome?></li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                            <div class="col">
                                <div class="card-header">
                                    Competências
                                </div>
                                <ul class="list-group list-group-flush">
                                    <?php foreach(fnLocalizaCompetenciasPorId($id) as $competencia):?>
                                    <li class="list-group-item"><?= $competencia->nome?></li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                            <div class="col">
                                <div class="card-header">
                                    Projetos acionados
                                </div>
                                <ul class="list-group list-group-flush">
                                <?php foreach(fnLocalizaProjetoPorColaborador($id) as $projeto):?>
                                    <li class="list-group-item">

                                    <div class="row">
                                    <div class="col">
                                    <?= $projeto->nome?>
                                    </div>

                                        <div class="col">
                                        <button type="button"
                                            class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" onclick="gerirManga(<?= $projeto->id?>, '');">Projeto</button>
                                        </div>
                                    </div>




                                </li>

                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <!--<a href="">Editar perfil</a>-->
                        </div>

                        <div class="row">
                            <a href="logout.php">Deslogar</a>
                        </div>
                        <div id="notify" class="form-text text-capitalize fs-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif?>

</div>

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

            url = 'projeto_atual.php';
            if(action === 'edit')
                url = 'admin_list.php';

            window.location.href = url;
        }
    </script>
</html>