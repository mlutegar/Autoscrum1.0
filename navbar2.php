<?php
include("header.php");
include('configAdmin.php');
require_once('repository/ProjetoRepository.php');
require_once('repository/LoginRepository.php');
$lider = fnLocalizaUserPorId($_SESSION['login']->id);
?>

<div class="mx-3 position-fixed" style="height:100%; width: 120px; top:0;">

    <div class="cointainer mx-auto"
        style="background-color: #002060; height: 90%;width: 70%;border-radius: 10px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); position: relative;">

        <div class="row mt-4">
            <div class="col-12 text-center my-4">
                <a href="user.php"><img src="img/home_button.png" width=25></a>
            </div>

           <!-- <div class="col-12 text-center my-4">
                <a href="projeto_atual.php"><img src="img/engine_button.png" width=25>
            </div>

            <div class="col-12 text-center my-4">
                <a href="admin_list.php"> <img src="img/tabble_button.png" width=25> </a>
            </div>-->
        </div>

        <?php if(empty(isset($_SESSION['login']))) : ?>
        <div class="row position-absolute mx-3" style="bottom: 30px;">
            <div class="col-12 text-center">
                <a href="login.php"><img src="img/person_button.png" width=25></a>
            </div>
        </div>
        <?php else: ?>
        <div class="row position-absolute mx-3" style="bottom: 30px;">
            <div class="col-12 text-center">
                <a href="logout.php"><img src="img/logout.png" width=25></a>
            </div>
        </div>
        <?php endif ?>

    </div>
</div>