<?php
    include('navbar2.php');

    $id_projeto = $_SESSION['id'];
    $projeto = fnLocalizaProjetoPorId($id_projeto);
    $id = $_SESSION['login']->id;
    $dono = fnLocalizaUserPorId($projeto->lider_id);
    $qtd_colaboradores = fnCountColaboradoresProjeto($id_projeto);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width ,initial-scale=1">
    <script src="https://kit.fontawesome.com/7c9e86ad48.js" crossorigin="anonymous"></script>
    <title>Projeto</title>
</head>

<body>

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card mb-5" style="border-radius: 15px;">
                        <div class="card-body p-4 cointainer">
                            <div class="row">
                                <h3 class="mb-3">Projeto: <?=$projeto->nome?></h3>
                            </div>
                            <div class="row">
                                <p class="small mb-0"> Lider : <?=$dono->user?> <span class="mx-2">|</span> Objetivo: <?=$projeto->objetivo?></p>
                            </div>

                            <hr class="my-4">

                            <div class="row mx-1">
                                <div class="col">
                                    <div class="card-header">
                                        Áreas de conhecimento do projeto
                                    </div>
                                    <ul class="list-group list-group-flush">
                                    <?php foreach(fnLocalizaAreasProjetoPorId($id_projeto) as $area):?>
                                        <li class="list-group-item"><?=$area->nome?></li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>

                                <div class="col">
                                    <div class="card-header">
                                        Competências do projeto
                                    </div>
                                    <ul class="list-group list-group-flush">
                                    <?php foreach(fnLocalizaCompetenciaProjetoPorId($id_projeto) as $area):?>
                                        <li class="list-group-item"><?= $area->nome?></li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>

                                <div class="col">
                                    <div class="card-header">
                                        Equipe <?=$projeto->tamanho?>/<?=$qtd_colaboradores?>
                                    </div>

                                    <ul class="list-group list-group-flush">
                                    <?php $qtd=1; foreach(fnLocalizaColaboradoresPorProjeto($id_projeto) as $equipe):?>
                                            <li class="list-group-item"><?= $equipe->user?> : <?php if($qtd==1){echo("PO");}elseif($qtd==2){echo("SM");}else{echo("Desenvolvimento");} ?></li>

                                        <?php $qtd++; endforeach;?>
                                    <form action="gerarEquipe.php" method="post" id="form">

                                        <div id="output"></div>

                                        </form>
                                        <?php if ($lider->cargo == "Lider"):?>
                                    <button onclick="main()" id="criar_equipe" class="btn btn-primary" value="">Gerar equipe</button>
                                    <?php endif;?>
                                    </ul>

                                </div>
                                <div id="notify" class="form-text text-capitalize fs-4">

                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
    let projetos = [["", [""], [""], [""]],];
  let competencias = [
    <?php foreach(fnListCompetencias() as $competencia):?>
"<?=$competencia->nome?>",
      <?php endforeach?>
  ];
  let competencias_po = ["Flexibilidade"];
  let competencias_scrum_master = ["Lideranca"];
  let areas_de_conhecimento_lista = [
    <?php foreach(fnListAreas() as $area):?>
      "<?=$area->nome?>",
      <?php endforeach?>
    ];


  let colaboradores = [

    <?php

        foreach(fnListColaboradores() as $usuario):
        $id_usuario = $usuario->id;
        if(!fnVerificarColaborador($id_usuario, $id_projeto)):
    ?>
       ["<?=$usuario->user?>",
        [
            <?php foreach(fnLocalizaCompetenciasPorId($id_usuario) as $competencia):?>
                "<?=$competencia->nome?>",
            <?php endforeach ?>
        ],

        <?php $area_principal = fnLocalizaAreaPrincipalPorId($id_usuario); ?>
        "<?=$area_principal->nome?>",

        [
            <?php foreach(fnLocalizaAreasSecundariasPorId($id_usuario) as $area):?>
            "<?= $area->nome?>",
            <?php endforeach;?>

        ]],
    <?php
    endif;
    endforeach;?>
  ];

  function escreverElementosNoHTML(array) {
  var output = document.getElementById('output'); // Obtém a referência ao elemento HTML onde os elementos serão escritos

  for (var i = 0; i < array.length; i++) {
    var elemento = array[i]; // Obtém o elemento atual

    var novoLi = document.createElement('li'); // Cria um novo elemento <li>
    novoLi.classList.add('list-group-item'); // Adiciona a classe 'list-group-item' ao elemento <li>

    var novoInput = document.createElement('input'); // Cria um novo elemento <input>
    novoInput.setAttribute('name', 'equipe[]'); // Define o atributo 'name' como 'equipe[]'
    novoInput.setAttribute('value', elemento); // Define o atributo 'value' com o valor do elemento

    novoLi.appendChild(novoInput); // Adiciona o elemento <input> ao elemento <li>
    output.appendChild(novoLi); // Adiciona o elemento <li> ao elemento HTML de saída
  }

  var botaoCriarEquipe = document.getElementById('criar_equipe'); // Obtém a referência ao botão "criar_equipe"
  botaoCriarEquipe.parentNode.removeChild(botaoCriarEquipe); // Remove o botão "criar_equipe"

  var novoBotao = document.createElement('button'); // Cria um novo elemento <button>
  novoBotao.setAttribute('type', 'submit'); // Define o tipo do botão como 'submit'
  novoBotao.classList.add('btn', 'btn-primary'); // Adiciona as classes 'btn' e 'btn-primary' ao botão
  novoBotao.textContent = 'Confirmar'; // Define o texto do botão como 'Confirmar'

  output.appendChild(novoBotao); // Adiciona o botão ao elemento HTML de saída
}



  function criar_projeto(nome_proj, competencias_proj, area_conhecimento_proj, n) {
    let i = [nome_proj, competencias_proj, area_conhecimento_proj];
    let equipe = classificador(i, n);
    i.push(equipe);
    projetos.push(i);
    return i;
  }

  function acessar(area) {
    if (area === 1) {
      console.log("Colaboradores:");
      for (let colaborador of colaboradores) {
        console.log(`Nome: ${colaborador[0]}\nCompetencias: ${colaborador[1]}\nArea Principal: ${colaborador[2]}\nArea Secundaria: ${colaborador[3]}\n`);
      }
    } else {
      console.log("Projetos:");
      for (let projeto of projetos) {
        console.log(`Nome: ${projeto[0]}\nCompetencias: ${projeto[1]}\nAreas De Conhecimento: ${projeto[2]}\nEquipe: ${projeto[3]}\n`);
      }
    }

    var equipe = projetos[1][3];
    var PO  = projetos[1][3][0];
    var SM  = projetos[1][3][1];
    console.log(PO);
    console.log(SM);


    escreverElementosNoHTML(equipe);
  }

  /*function editar_projeto(p) {
    let acao = prompt(`Vamos prosseguir na edicao da equipe do projeto: ${projetos[p][0]}\nColaboradores na equipe: ${projetos[p][projetos[p].length - 1]}\nDeseja: Remover (R) ou Adicionar(A) ou Trocar(T)\n`);

    if (acao === 'R') {
      let x = prompt("Selecione o colaborador: ");
      projetos[p][projetos[p].length - 1].splice(projetos[p][projetos[p].length - 1].indexOf(x), 1);
      return;
    }

    let colaboradores_fora_projeto = colaboradores.filter(c => !projetos[p][projetos[p].length - 1].includes(c[0])).map(c => c[0]);
    console.log(colaboradores_fora_projeto);

    let x = prompt("Selecione o colaborador a ser adicionado: ");
    if (acao === 'A') {
      projetos[p][projetos[p].length - 1].push(x);
      return;
    }

    let y = prompt("Selecione o colaborador a ser substituido: ");
    let posicao = projetos[p][projetos[p].length - 1].indexOf(y);
    projetos[p][projetos[p].length - 1][posicao] = x;
  }*/

  function nota_colaborador(i) {
    let notas_projeto = [];
    for (let colaborador of colaboradores) {
      let nota = 0;
      for (let competencia of i[1]) {
        nota += colaborador[1].filter(comp => comp === competencia).length;
      }
      for (let area_de_conheci of i[2]) {
        nota += 1.5 * colaborador[3].filter(area => area === area_de_conheci).length;
      }
      for (let comp_po of competencias_po) {
        nota += 0.1 * colaborador[1].filter(comp => comp === comp_po).length;
      }
      for (let comp_sm of competencias_scrum_master) {
        nota += 0.1 * colaborador[1].filter(comp => comp === comp_sm).length;
      }

      let numero_campos_selecionados = colaborador[1].length + colaborador[3].length + 1;
      notas_projeto.push([colaborador[0], Math.round((nota / numero_campos_selecionados) + numero_campos_selecionados / 10, 2)]);
    }

    return notas_projeto;
  }

  function classificador(i, n) {
    let notas_projeto = nota_colaborador(i);
    let w = notas_projeto.sort((a, b) =>  b[1] - a[1]).slice(0, n);

    return w.map(item => item[0]);
  }

  // PROGRAMA

  function main(){
    criar_projeto(
            "<?=$projeto->nome?>",
            [
                <?php foreach(fnLocalizaCompetenciaProjetoPorId($id_projeto) as $area):?>
                    "<?= $area->nome?>",
                <?php endforeach;?>
            ],
            [
                <?php foreach(fnLocalizaAreasProjetoPorId($id_projeto) as $area):?>
                    "<?=$area->nome?>",
                <?php endforeach;?>
            ],
            <?=($projeto->tamanho)-$qtd_colaboradores?>
        );

        acessar(0);

        /*console.log(projetos[projetos.length - 1]);

    while (true) {
      let action = prompt(`Senhor(a) o que deseja fazer?\nCriar Projeto (P) | Visualizar Projetos(O)\nCriar Competencias (C) | Visualizar Colaboradores (V)\nEditar equipes (E)\n`);

      if (action === 'V') {
        acessar(1);
      } else if (action === 'O') {
        acessar(0);
      } else if (action === 'E') {
        acessar(0);
        let p = parseInt(prompt("Selecione o projeto: "));
        editar_projeto(p);
      }
    }*/
  }

</script>

</html>