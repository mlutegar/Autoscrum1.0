<?php
   session_start();

   require_once('repository/LoginRepository.php');
   require_once('repository/ProjetoRepository.php');

   $area = filter_input(INPUT_POST, 'create_area', FILTER_SANITIZE_SPECIAL_CHARS);
   $page = "create_projeto.php";
   $msg = "";

   if(empty($area)){
    $msg = "Erro!";
   } else{
    if (!empty($area)) {
        fnAddArea($area);
   }
}

   $_SESSION['notify'] = $msg; // Armazena a mensagem na variável de sessão
   setcookie('notify', $msg, time() + 10, "autoscrum/{$page}", 'localhost');
   header("location: {$page}");
   exit;