<?php
    session_start();
    require_once('repository/LoginRepository.php');

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    $page = "user.php";

    if(!$_SESSION['login'] = fnLogin($email, $password)) {
        session_destroy();
        $page = "error_page.php";
        $expire = (time()+10);

        setcookie('notify', 'Falha ao efetuar o login', $expire, '/autoscrum/errorPage.php', 'localhost', isset($_SERVER['HTTPS']), true);
    }

    header("location: {$page}");
    exit;