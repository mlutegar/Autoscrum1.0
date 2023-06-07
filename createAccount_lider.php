<?php
    session_start();

    require_once('repository/LoginRepository.php');

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
    $cargo = "Lider";
    $page = "login.php";

    if(empty($email) || empty($senha) || empty($user)){
        $msg = "Preencher todos os campos primeiro.";
    }
    else{
        if(fnCheckExistingEmail($email)){
            $msg = "Este email já está cadastrado";
            $page = "create_account_lider.php";
        } else{
                if(fnAddUser($user, $email, $senha, $cargo))
                    {
                        $msg = "Sucesso ao criar conta";
                    } else {
                        $msg = "Preencha todos os campos corretamente";
            }
        }
    }

    $_SESSION['notify'] = $msg; // Armazena a mensagem na variável de sessão

    setcookie('notify', $msg, time() + 10, "autoscrum/{$page}", 'localhost');
    header("location: {$page}");
    exit;