<?php
    require_once('repository/ProjetoRepository.php');
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);

    header("location: listagem-de-projeto_atual.php?titulo={$titulo}");
    exit;