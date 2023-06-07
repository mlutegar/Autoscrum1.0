<?php
    session_start();

    require_once('repository/LoginRepository.php');
    require_once('repository/ProjetoRepository.php');

    $tamanho = filter_input(INPUT_POST, 'tamanho', FILTER_SANITIZE_NUMBER_INT);
    $objetivo = filter_input(INPUT_POST, 'objetivo', FILTER_SANITIZE_SPECIAL_CHARS);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $areas_secundarias = filter_input(INPUT_POST, 'areas_secundarias', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $competencias = filter_input(INPUT_POST, 'competencias', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $lider = filter_input(INPUT_POST, 'lider', FILTER_SANITIZE_NUMBER_INT);
    $page = "create_projeto.php";

    if(empty($tamanho) || empty($nome) || empty($lider) || $tamanho<3){
        $msg = "Preencher todos os campos primeiro.";
    } else{
        $colaboradorId = fnAddProjeto($nome, $lider, $objetivo, $tamanho);
        if (!(empty($colaboradorId))) {
            $msg = "Sucesso ao criar o projeto";
            // Armazena o ID do usuário cadastrado

            if (!empty($areas_secundarias)) {
                foreach ($areas_secundarias as $area_secundaria) {
                    // Usa o ID do usuário cadastrado na função fnAddAreasSecundariasColaboradores
                    fnAddAreasSecundariasProjeto($colaboradorId, $area_secundaria);
                }
            }

            if (!empty($competencias)) {
                foreach ($competencias as $competencia) {
                    // Usa o ID do usuário cadastrado na função fnAddAreasSecundariasColaboradores
                    fnAddCompetenciasProjeto($colaboradorId, $competencia);
                }
            }

            $page = "user.php";

            } else {
            $msg = "Preencha todos os campos corretamente";
        }
    }

    $_SESSION['notify'] = $msg; // Armazena a mensagem na variável de sessão
    setcookie('notify', $msg, time() + 10, "autoscrum/{$page}", 'localhost');
    header("location: {$page}");
    exit;