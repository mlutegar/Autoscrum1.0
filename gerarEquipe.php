<?php
   session_start();

   require_once('repository/LoginRepository.php');
   require_once('repository/ProjetoRepository.php');

   $equipe = filter_input(INPUT_POST, 'equipe', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
   $cargo = 1;
   $page = "projeto_atual.php";
   $id_projeto = $_SESSION['id'];

   if(empty($equipe)){
    $msg = "Erro na formação da equipe";
   } else{
    $msg = "Equipe formada com sucesso";
    if (!empty($equipe)) {
        foreach ($equipe as $colaborador) {
            // Usa o ID do usuário cadastrado na função fnAddAreasSecundariasColaboradores
            $id_colaborador = fnLocalizaUserPorNome($colaborador);
            fnAddColaboradoresProjeto($id_colaborador->id, $id_projeto, $cargo);
            $cargo++;
      }
   }
}


   $_SESSION['notify'] = $msg; // Armazena a mensagem na variável de sessão
   setcookie('notify', $msg, time() + 10, "autoscrum/{$page}", 'localhost');
   header("location: {$page}");
   exit;