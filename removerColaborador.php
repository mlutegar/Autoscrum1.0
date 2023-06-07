<?php
    require_once('repository/ProjetoRepository.php');
    session_start();

    $colaborador = filter_input(INPUT_POST, 'create_area', FILTER_SANITIZE_NUMBER_INT);
    $page = "admin_list.php";

    $msg = "";
    if(fnDeleteManga($_SESSION['id'], $colaborador)){
        $msg = "Sucesso ao deletar";
    } else {
        $msg = "Falha ao deletar";
    }

    $_SESSION['notify'] = $msg; // Armazena a mensagem na variável de sessão
    setcookie('notify', $msg, time() + 10, "/autoscrum/{$page}", 'localhost');
    header("location: {$page}");
    exit;