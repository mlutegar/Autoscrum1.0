let projetos = [
    ["AutoScrum", ["Flexibilidade", "Lideranca"], ["Python", "PHP"], []],
    ["AutoSrum", ["Organizacao", "Lideranca"], ["Python", "PHP"], ["Marcos"]]
  ];
  let competencias = ["Flexibilidade", "Organizacao", "Lideranca", "Scrum"];
  let competencias_po = ["Flexibilidade"];
  let competencias_scrum_master = ["Lideranca"];
  let areas_de_conhecimento_lista = ["Python", "Java", "PHP", "Scrum"];

  let colaboradores = [
    ["Julio", ["Flexibilidade", "Lideranca"], "Python", ["PHP"]],
    ["Marcos", ["Lideranca", "Organizacao"], "PHP", ["Java"]],
    ["Paula", ["Organizacao"], "Java", ["Scrum"]]
  ];

  function criar_projeto() {
    let nome_proj = prompt("Informe o nome do Projeto: ");
    let competencias_proj = [];
    let area_conhecimento_proj = [];

    while (true) {
      let competencia = prompt("Informe as competencias buscadas para o projeto (digite 'Sair' para finalizar): ");
      if (competencia === "Sair") break;
      if (!competencias_proj.includes(competencia)) {
        competencias_proj.push(competencia);
      }
    }

    while (true) {
      let area_conhecimento = prompt("Informe as áreas de conhecimento buscadas para o projeto (digite 'Sair' para finalizar): ");
      if (area_conhecimento === "Sair") break;
      if (!area_conhecimento_proj.includes(area_conhecimento)) {
        area_conhecimento_proj.push(area_conhecimento);
      }
    }

    let n = parseInt(prompt("Informe o tamanho da equipe: "));
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
  }

  function editar_projeto(p) {
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
  }

  function criar_competencias() {
    let nome = prompt("Iniciando a funcao de adicionar competencias!\nInforme o nome da nova competencia: ");
    if (!competencias.includes(nome)) {
      competencias.push(nome);
    } else {
      console.log("Competencia existente");
    }
  }

  function selecionar_qualidades(nome, competencias, area_conhecimento) {
    let area_secundaria = [];
    let competencias_colaborador = [];

    console.log("Selecione as Competencias que voce possui:");
    for (let competencia of competencias) {
      let resposta = parseInt(prompt(`${competencia}\n`));
      if (resposta === 1) {
        competencias_colaborador.push(competencia);
      }
    }

    let area_principal = prompt(`Informe sua Area de Conhecimento Principal: ${area_conhecimento}\n `);

    console.log("Selecione outras areas de conhecimento que voce possui: ");
    for (let area of area_conhecimento) {
      let resposta = parseInt(prompt(`${area}\n`));
      if (resposta === 1) {
        area_secundaria.push(area);
      }
    }

    colaboradores.push([nome, competencias_colaborador, area_principal, area_secundaria]);
  }

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
        nota += 2 * colaborador[1].filter(comp => comp === comp_po).length;
      }
      for (let comp_sm of competencias_scrum_master) {
        nota += 1.5 * colaborador[1].filter(comp => comp === comp_sm).length;
      }

      let numero_campos_selecionados = colaborador[1].length + colaborador[3].length + 1;
      notas_projeto.push([colaborador[0], Math.round((nota / numero_campos_selecionados) + numero_campos_selecionados / 10, 2)]);
    }

    return notas_projeto;
  }

  function classificador(i, n) {
    let notas_projeto = nota_colaborador(i);
    let w = notas_projeto.sort((a, b) => a[1] - b[1]).slice(0, n);
    return w.map(item => item[0]);
  }

  // PROGRAMA

  let a = prompt("Bom dia. Deseja prosseguir como Administrador ou Colaborador?\n(A para ADM ||| C para Colaborador)\n");

  if (a === 'A') {
    console.log("Iniciando programa como ADM.");
    let nome_usuario = prompt("Informe seu nome: ");

    while (true) {
      let action = prompt(`Senhor(a) ${nome_usuario} o que deseja fazer?\nCriar Projeto (P) | Visualizar Projetos(O)\nCriar Competencias (C) | Visualizar Colaboradores (V)\nEditar equipes (E)\n`);

      if (action === 'P') {
        criar_projeto();
        console.log(projetos[projetos.length - 1]);
      } else if (action === 'V') {
        acessar(1);
      } else if (action === 'C') {
        criar_competencias();
        console.log(competencias);
      } else if (action === 'O') {
        acessar(0);
      } else if (action === 'E') {
        acessar(0);
        let p = parseInt(prompt("Selecione o projeto: "));
        editar_projeto(p);
      }
    }
  } else if (a === 'C') {
    console.log("Iniciando programa como Colaborador!");
    let nome_usuario = prompt("Informe seu nome:\n");
    selecionar_qualidades(nome_usuario, competencias, areas_de_conhecimento_lista);
    console.log(colaboradores);
  }