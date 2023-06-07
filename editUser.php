<?php
    require_once('repository/LoginRepository.php');
    require_once('util/base64.php');
    session_start();

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_NUMBER_INT);
    $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);

    $id = $_SESSION['login']->id;

    if(empty($email) || empty($user) || empty($age) || empty($id)){
        $msg = "Preencher todos os campos primeiro.";
    }
    else{
        if(fnUpdateUser($id, $email, $user, $age)) {
            $msg = "Sucesso ao gravar";
        } else {
            $msg = "Falha na gravação";
        }
    }

    $page = "edit_user.php";
    setcookie('notify', $msg, time() + 10, "autoscrum/{$page}", 'localhost');
    header("location: {$page}");
    exit;