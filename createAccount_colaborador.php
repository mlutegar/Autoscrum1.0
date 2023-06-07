<?php
    session_start();

    require_once('repository/LoginRepository.php');
    require_once('repository/ProjetoRepository.php');

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
    $area_principal = filter_input(INPUT_POST, 'area_principal', FILTER_SANITIZE_SPECIAL_CHARS);
    $areas_secundarias = filter_input(INPUT_POST, 'areas_secundarias', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $competencias = filter_input(INPUT_POST, 'competencias', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $cargo = "Colaborador";
    $page = "create_account_colaborador.php";

    if(empty($email) || empty($senha) || empty($user) || empty($cargo)){
        $msg = "Preencher todos os campos primeiro.";
    } else{
        if(fnCheckExistingEmail($email)){
            $msg = "Este email já está cadastrado";
        } else{
            $colaboradorId = fnAddUser($user, $email, $senha, $cargo);
            if (!(empty($colaboradorId))) {
                $msg = "Sucesso ao criar conta";
                // Armazena o ID do usuário cadastrado

                if (!empty($areas_secundarias)) {
                    foreach ($areas_secundarias as $area_secundaria) {
                        // Usa o ID do usuário cadastrado na função fnAddAreasSecundariasColaboradores
                        fnAddAreasSecundariasColaboradores($colaboradorId, $area_secundaria);
                    }
                }
                if (!empty($competencias)) {
                    foreach ($competencias as $competencia) {
                        // Usa o ID do usuário cadastrado na função fnAddAreasSecundariasColaboradores
                        fnAddCompetenciasColaboradores($colaboradorId, $competencia);
                    }
                }

                if (!empty($area_principal)) {
                        fnAddAreaPrincipal($colaboradorId, $area_principal);
                    }

                $page = "login.php";

                } else {
                $msg = "Preencha todos os campos corretamente";
            }
        }
    }

    $_SESSION['notify'] = $msg; // Armazena a mensagem na variável de sessão
    setcookie('notify', $msg, time() + 10, "autoscrum/{$page}", 'localhost');
    header("location: {$page}");
    exit;