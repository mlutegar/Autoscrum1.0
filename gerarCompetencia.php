<?php
   session_start();

   require_once('repository/LoginRepository.php');
   require_once('repository/ProjetoRepository.php');

   $competencia = filter_input(INPUT_POST, 'create_competencia', FILTER_SANITIZE_SPECIAL_CHARS);
   $page = "create_projeto.php";
   $msg = "";

   if(empty($competencia)){
    $msg = "Erro!";
   } else{
    if (!empty($competencia)) {
        fnAddCompetencia($competencia);
   }
}

   $_SESSION['notify'] = $msg; // Armazena a mensagem na variável de sessão
   setcookie('notify', $msg, time() + 10, "autoscrum/{$page}", 'localhost');
   header("location: {$page}");
   exit;