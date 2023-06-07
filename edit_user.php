<?php 

include('config.php');
require_once('repository/LoginRepository.php');

$id = $_SESSION['id'];
$user = fnLocalizaUserPorId($id);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width ,initial-scale=1">
    <script src="https://kit.fontawesome.com/7c9e86ad48.js" crossorigin="anonymous"></script>    
    <title>Usuário</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body> <?php include("navbar.php")?>

<div class="col-6 offset-3">
    <div id="form-rect">
    <h1>Editar conta</h1>
            <form action="editUser.php" method="post" class="form" enctype="multipart/form-data">
            <div>
                    <label for="emailId" class="form-label">E-mail</label>
                    <input type="email" name="email" id="emailId" class="form-control" placeholder="<?= $_SESSION['login']->email?>" required>
                </div>
                <div>
                    <label for="senhaId" class="form-label">Usuário</label>
                    <input type="text" name="user" id="userId" class="form-control" placeholder="<?= $_SESSION['login']->user?>" required>
                </div>
                <div>
                    <label for="ageId" class="form-label">Idade</label>
                    <input type="text" name="age" id="ageId" class="form-control" placeholder="<?= $_SESSION['login']->age?>" required>
                </div>
 
                <div>
                    <input type="submit" class="submit-btn" value="Editar conta">
                    <hr>
                  <input onclick="window.location='user.php'" type="button" class="submit-btn" value="Cancelar edição">
                </div>
                <div id="notify" class="form-text text-capitalize fs-4"><?= isset($_COOKIE['notify']) ? $_COOKIE['notify'] : '' ?></div>
            </form>
        
    </div>

<?php include('footer.php') ?></body>
</html>