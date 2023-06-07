<?php
    include('configAdmin.php');
    require_once('repository/ProjetoRepository.php');
    $id = $_SESSION['id'];
    $manga = fnLocalizaMangaPorId($id);
?>

<!doctype html>
<html lang="pt_BR">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulário Edição de Manga</title>
    <<link rel="stylesheet" href="css/login.css">
  </head>

  <body><?php include("navbar.php");?>

    <div>
        <div id="form-rect">
            <form id="editaManga" action="editaManga.php" method="post" enctype="multipart/form-data">
            <h1>Cadastrar manga</h1>
              <div style="width: 100%;">
                <a href="#" onclick="return confirm ('Deseja realmente trocar a capa?') ? trocarImagem() : '';"><img src="<?= $manga->capa ?>" id="manga-cover"></a>
                <p style="text-align:center"><?= $manga->titulo ?></p>
              </div>
                <input type="hidden" name="idManga" id="mangaId" value="<?= $manga->id ?>">

                <label>Anime</label>
                <input type="text" name="anime" id="animeId" value="<?= $manga->anime ?>" required>

                <label>Volume</label>
                <input type="number" name="volume" id="volumeId" value="<?= $manga->volume ?>" required>

                <label>Categoria</label>
                <input type="text" name="categoria" id="categoriaId" value="<?= $manga->categoria?>">

                <label>Nota</label>
                <input type="number" name="nota" id="notaId" value="<?= $manga->nota?>">

                <label>Sumário <input style="height: 300px;" name="sumario" rows="8" id="sumarioId" value="<?= $manga->sumario ?>"></label>

                <input class="submit-btn" type="submit" value="Enviar">
                <div id="notify"><?= isset($_COOKIE['notify']) ? $_COOKIE['notify'] : '' ?></div>
          </form>
        </div>
    </div>

  <?php include("footer.php");?>
  <script src="js/base64.js"></script></body>
  <script>
    function trocarImagem(){
      window.location.href = "capa_change.php";
    }
  </script>
</html>