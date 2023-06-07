<?php
    require_once('Connection.php');

    function fnAddManga($titulo, $anime, $volume,$categoria, $nota, $sumario, $capa, $conteudo){
        $con = getConnection();
        $sql = "insert into manga (titulo, anime, volume,categoria, nota, sumario, capa, conteudo) values (:pTitulo, :pAnime, :pVolume, :pCategoria, :pNota, :pSumario, :pCapa, :pConteudo)";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(":pTitulo", $titulo);
        $stmt->bindParam(":pAnime", $anime);
        $stmt->bindParam(":pVolume", $volume);
        $stmt->bindParam(":pCategoria", $categoria);
        $stmt->bindParam(":pNota", $nota);
        $stmt->bindParam(":pSumario", $sumario);
        $stmt->bindParam(":pCapa", $capa);
        $stmt->bindParam(":pConteudo", $conteudo);

        return $stmt->execute();
    }

    function fnAddArea($nome){
        $con = getConnection();
        $sql = "insert into areas (nome) values (:pNome)";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(":pNome", $nome);
        return $stmt->execute();
    }

    function fnAddCompetencia($nome){
        $con = getConnection();
        $sql = "insert into competencias (nome) values (:pNome)";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(":pNome", $nome);
        return $stmt->execute();
    }

    function fnLocalizaUserPorNome($nome) {
        $con = getConnection();
        $sql = "select * from login where user = :pNome";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":pNome", $nome);

        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        return null;
    }

    function fnAddColaboradoresProjeto($colaboradorId, $projeto_id, $cargo){
        $con = getConnection();
        $sql = "insert into projeto_colaboradores(colaborador_id, projeto_id, cargo) values (:pColaboradorId, :pProjeto_id, :pCargo)";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(":pColaboradorId", $colaboradorId);
        $stmt->bindParam(":pProjeto_id", $projeto_id);
        $stmt->bindParam(":pCargo", $cargo);

        return $stmt->execute();
    }

    function fnAddAreasSecundariasColaboradores($colaboradorId, $areaId){
        $con = getConnection();
        $sql = "insert into colaborador_areas (colaborador_id, area_id) values (:pColaboradorId, :pAreaId)";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(":pColaboradorId", $colaboradorId);
        $stmt->bindParam(":pAreaId", $areaId);

        return $stmt->execute();
    }

    function fnAddCompetenciasColaboradores($colaboradorId, $competenciaId){
        $con = getConnection();
        $sql = "insert into colaborador_competencia (colaborador_id, competencia_id) values (:pColaboradorId, :pCompetenciaId)";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(":pColaboradorId", $colaboradorId);
        $stmt->bindParam(":pCompetenciaId", $competenciaId);

        return $stmt->execute();
    }

    function fnAddAreasSecundariasProjeto($colaboradorId, $areaId){
        $con = getConnection();
        $sql = "insert into projeto_areas (projeto_id, competencia_id) values (:pColaboradorId, :pAreaId)";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(":pColaboradorId", $colaboradorId);
        $stmt->bindParam(":pAreaId", $areaId);

        return $stmt->execute();
    }

    function fnAddCompetenciasProjeto($colaboradorId, $competenciaId){
        $con = getConnection();
        $sql = "insert into projeto_competencia (projeto_id, competencia_id) values (:pColaboradorId, :pCompetenciaId)";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(":pColaboradorId", $colaboradorId);
        $stmt->bindParam(":pCompetenciaId", $competenciaId);

        return $stmt->execute();
    }

    function fnAddAreaPrincipal($colaboradorId, $competencia_id){
        $con = getConnection();
        $sql = "insert into colaborador_area_principal (colaborador_id, area_id) values (:pColaboradorId, :pAreaId)";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(":pColaboradorId", $colaboradorId);
        $stmt->bindParam(":pAreaId", $competencia_id);

        return $stmt->execute();
    }

    function fnLocalizaProjetoPorLider($lider_id) {
        $con = getConnection();
        $sql = "select * from projetos where lider_id = :pLiderID";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pLiderID", $lider_id);

        if($stmt->execute()){
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $stmt->fetchAll();
        }
        return null;
    }

    function fnListAreas() {
        $con = getConnection();
        $sql = "select * from areas";
        $result = $con->query($sql);
        $lstAreas = array();

        while($area = $result->fetch(PDO::FETCH_OBJ)){
            array_push($lstAreas, $area);
        }

        return $lstAreas;
    }

    function fnListCompetencias() {
        $con = getConnection();
        $sql = "select * from competencias";
        $result = $con->query($sql);
        $lstAreas = array();

        while($area = $result->fetch(PDO::FETCH_OBJ)){
            array_push($lstAreas, $area);
        }

        return $lstAreas;
    }

    function fnLocalizaAreaPrincipalPorId($id) {
        $con = getConnection();
        $sql = "select areas.* from areas join colaborador_area_principal on areas.id = colaborador_area_principal.area_id where colaborador_area_principal.colaborador_id = :pColaborador";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pColaborador", $id);

        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        return null;
    }

    function fnLocalizaColaboradoresPorProjeto($projeto_id) {
        $con = getConnection();
        $sql = "select login.* from login join projeto_colaboradores on login.id = projeto_colaboradores.colaborador_id where projeto_colaboradores.projeto_id = :pProjeto_id";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pProjeto_id", $projeto_id);

        $stmt->execute();
        $lstAreas = array();

        while ($area = $stmt->fetch(PDO::FETCH_OBJ)) {
            array_push($lstAreas, $area);
        }

        return $lstAreas;
    }

    function fnLocalizaCargoProjetoPorId($colaborador_id, $projeto_id) {
        $con = getConnection();
        $sql = "select * from projeto_colaboradores where colaborador_id = :pColaborador_id and projeto_id = :pProjeto_id";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pColaborador_id", $colaborador_id);
        $stmt->bindParam(":pProjeto_id", $projeto_id);

        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        return null;
    }

    function fnLocalizaAreasSecundariasPorId($id) {
        $con = getConnection();
        $sql = "select areas.* from areas join colaborador_areas on areas.id = colaborador_areas.area_id where colaborador_areas.colaborador_id = :pColaborador";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pColaborador", $id);

        $stmt->execute();
        $lstAreas = array();

        while ($area = $stmt->fetch(PDO::FETCH_OBJ)) {
            array_push($lstAreas, $area);
        }

        return $lstAreas;
    }

    function fnLocalizaProjetoPorId($id) {
        $con = getConnection();
        $sql = "select * from projetos where id = :pId";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pId", $id);

        $stmt->execute();
        $lstAreas = array();

        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        return null;
    }

    function fnLocalizaCompetenciasPorId($id) {
        $con = getConnection();
        $sql = "select competencias.* from competencias join colaborador_competencia on competencias.id = colaborador_competencia.competencia_id where colaborador_competencia.colaborador_id = :pColaborador";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pColaborador", $id);

        $stmt->execute();
        $lstAreas = array();

        while ($area = $stmt->fetch(PDO::FETCH_OBJ)) {
            array_push($lstAreas, $area);
        }

        return $lstAreas;
    }

    function fnLocalizaProjetoPorColaborador($colaborador_id) {
        $con = getConnection();
        $sql = "select projetos.* from projetos join projeto_colaboradores on projetos.id = projeto_colaboradores.projeto_id where projeto_colaboradores.colaborador_id = :pColaborador_id";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pColaborador_id", $colaborador_id);

        $stmt->execute();
        $lstAreas = array();

        while ($area = $stmt->fetch(PDO::FETCH_OBJ)) {
            array_push($lstAreas, $area);
        }

        return $lstAreas;
    }

    function fnLocalizaCompetenciaProjetoPorId($id) {
        $con = getConnection();
        $sql = "select competencias.* from competencias join projeto_competencia on competencias.id = projeto_competencia.competencia_id where projeto_competencia.projeto_id = :pColaborador";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pColaborador", $id);

        $stmt->execute();
        $lstAreas = array();

        while ($area = $stmt->fetch(PDO::FETCH_OBJ)) {
            array_push($lstAreas, $area);
        }

        return $lstAreas;
    }


    function fnLocalizaAreasProjetoPorId($id) {
        $con = getConnection();
        $sql = "select areas.* from areas join projeto_areas on areas.id = projeto_areas.competencia_id where projeto_areas.projeto_id = :pColaborador";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pColaborador", $id);

        $stmt->execute();
        $lstAreas = array();

        while ($area = $stmt->fetch(PDO::FETCH_OBJ)) {
            array_push($lstAreas, $area);
        }

        return $lstAreas;
    }


    function fnLocalizaMangaPorTitulo($titulo) {
        $con = getConnection();
        $sql = "select * from manga where titulo like :pTitulo limit 20";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":pTitulo", "%{$titulo}%");

        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $stmt->fetchAll();
        }
    }

    function fnLocalizaMangaPorAnime($anime) {
        $con = getConnection();
        $sql = "select * from manga where anime like :pAnime limit 20";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":pAnime", "%{$anime}%");

        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $stmt->fetchAll();
        }
    }

    function fnLocalizaMangaPorCategoria($categoria) {
        $con = getConnection();
        $sql = "select * from manga where categoria like :pCategoria limit 20";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":pCategoria", "%{$categoria}%");

        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $stmt->fetchAll();
        }
    }

    function fnLocalizaMangaPorId($id) {
        $con = getConnection();
        $sql = "select * from manga where id = :pLiderID";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pLiderID", $id);

        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        return null;
    }

    function fnUpdateManga($id, $titulo, $anime, $volume, $categoria, $nota, $sumario) {
        $con = getConnection();
        $sql = "update manga set titulo = :pTitulo, anime= :pAnime, volume = :pVolume, categoria = :pCategoria, nota = :pNota, sumario = :pSumario where id = :pLiderID";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pLiderID", $id);
        $stmt->bindParam(":pTitulo", $titulo);
        $stmt->bindParam(":pAnime", $anime);
        $stmt->bindParam(":pVolume", $volume);
        $stmt->bindParam(":pCategoria", $categoria);
        $stmt->bindParam(":pNota", $nota);
        $stmt->bindParam(":pSumario", $sumario);

        return $stmt->execute();
    }

    function fnDeleteManga($projeto_id, $colaborador_id) {

        $con = getConnection();
        $sql = "delete from projeto_colaboradores where projeto_id = :pProjetoId and colaborador_id = :pColaboradorId";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pProjetoId", $projeto_id);
        $stmt->bindParam(":pColaboradorId", $colaborador_id);

        return $stmt->execute();
    }

    function fnUpdateNota($nota) {
        $con = getConnection();
        $sql = "update manga set nota = :Nota where id = :pLiderID";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pLiderID", $id);
        $stmt->bindParam(":Nota", $nota);

        return $stmt->execute();

    }

    function fnCountColaboradoresProjeto($projeto_id) {
        $con = getConnection();
        $sql = "select count(*) from projeto_colaboradores where projeto_id = :pProjetoId";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pProjetoId", $projeto_id);
        $stmt->execute();

        // Obtém o resultado da contagem
        $count = $stmt->fetchColumn();

        return $count;
    }

    function fnVerificarColaborador($colaborador_id, $projeto_id) {
        $con = getConnection();
        $sql = "select count(*) from projeto_colaboradores where projeto_id = :pProjetoId and colaborador_id = :pColaboradorId";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pColaboradorId", $colaborador_id);
        $stmt->bindParam(":pProjetoId", $projeto_id);
        $stmt->execute();

        // Obtém o resultado da contagem
        $count = $stmt->fetchColumn();

        return $count > 0; // Retorna true se a contagem for maior que zero, caso contrário, retorna false
    }


