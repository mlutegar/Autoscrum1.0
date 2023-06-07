<?php include("navbar.php");?>

<style>
  .btn-bg-image1:hover {
    background-image: url('img/cadastro_colaborador_hover.png');
  }

  .btn-bg-image1:active {
    background-image: url('img/cadastro_colaborador_clicado.png');
  }


  .btn-bg-image2:hover {
    background-image: url('img/cadastro_lider_hover.png');
  }

  .btn-bg-image2:active {
    background-image: url('img/cadastro_lider_clicado.png');
  }

  .btn-bg-image1 {
    background-image: url('img/cadastro_colaborador.png');
    background-repeat: no-repeat;
    background-size: cover;
    height: 151.2px;
    /* 378 */
    width: 370.4px;
    /* 926 */
    transition: background-image 0.2s ease;
  }

  .btn-bg-image2 {
    background-image: url('img/cadastro_lider.png');
    background-repeat: no-repeat;
    background-size: cover;
    height: 151.2px;
    /* 378 */
    width: 370.4px;
    /* 926 */
    transition: background-image 0.2s ease;
  }
</style>

<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="mb-5">
          <div class="cointainer">
            <div class="row mx-5">
              <div class="cointainer mx-5">
              </div>
              <div class="row mx-5 justify-content-center">
                <div class="col">
                  <button onclick="window.location='create_account_colaborador.php'" class="btn btn-bg-image1"></button>
                </div>
                <div class="col">
                  <button onclick="window.location='create_account_lider.php'" class="btn btn-bg-image2"></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>