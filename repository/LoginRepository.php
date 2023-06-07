<?php
    require_once('Connection.php');

    function fnLogin($email, $password) {
        $con = getConnection();
        $sql = "select id, created_at, user, foto, cargo, email from login where email = :pEmail and senha = :pSenha";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pEmail", $email);
        $stmt->bindValue(":pSenha", md5($password));

        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        return null;
    }

    function fnAddUser($user, $email, $senha, $cargo)
    {
        $con = getConnection();

        $sql = "insert into login (user, email, senha, cargo) values (:pUser, :pEmail, :pSenha, :pCargo)";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pUser", $user);
        $stmt->bindParam(":pEmail", $email);
        $stmt->bindParam(":pCargo", $cargo);
        $stmt->bindValue(":pSenha", md5($senha));

        if ($stmt->execute()) {
            // Retorna o ID do usuário inserido
            return $con->lastInsertId();
        } else {
            return false;
        }
    }

    function fnAddProjeto($nome, $lider, $objetivo, $tamanho)
    {
        $con = getConnection();

        $sql = "insert into projetos(nome, lider_id, objetivo, tamanho) values (:pNome, :pLider, :pObjetivo, :pTamanho)";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pNome", $nome);
        $stmt->bindParam(":pLider", $lider);
        $stmt->bindParam(":pObjetivo", $objetivo);
        $stmt->bindParam(":pTamanho", $tamanho);

        if ($stmt->execute()) {
            // Retorna o ID do usuário inserido
            return $con->lastInsertId();
        } else {
            return false;
        }
    }

    function fnAddEquipeProjeto($projetoId, $colaboradorId, $cargo) {
        $con = getConnection();
        $sql = "insert into projeto_colaboradores (colaborador_id, projeto_id, cargo) values (:pColaboradorId, :pProjetoId, :pCargo)";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(":pColaboradorId", $colaboradorId);
        $stmt->bindParam(":pProjetoId", $projetoId);
        $stmt->bindParam(":pCargo", $cargo);

        return $stmt->execute();
    }

    function fnCheckExistingEmail($email)
    {
        $con = getConnection();

        $sql = "select count(*) from login where email = :pEmail";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pEmail", $email);
        $stmt->execute();

        $count = $stmt->fetchColumn();

        // Se o valor de $count for maior que 0, o email já existe no banco de dados
        return ($count > 0);
    }

    function fnListUsers() {
        $con = getConnection();
        $sql = "select * from login";
        $result = $con->query($sql);
        $lstUsers = array();

        while($user = $result->fetch(PDO::FETCH_OBJ)){
            array_push($lstUsers, $user);
        }

        return $lstUsers;
    }

    function fnListColaboradores() {
        $con = getConnection();
        $sql = "select * from login where cargo = 'colaborador'";
        $result = $con->query($sql);
        $lstUsers = array();

        while($user = $result->fetch(PDO::FETCH_OBJ)){
            array_push($lstUsers, $user);
        }

        return $lstUsers;
    }

    function fnLocalizaUserPorId($id) {
        $con = getConnection();
        $sql = "select * from login where id = :pID";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pID", $id);

        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        return null;
    }

    function fnAtualizaSenha($email, $senha) {
        $con = getConnection();

        $sql = "update login set senha = :pSenha where email = :pEmail";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pEmail", $email);
        $stmt->bindValue(":pSenha", md5($senha));

        if($stmt->execute()) {
            return true;
        }

        return false;
    }
    function fnUpdateUser($id, $email, $user, $age) {
        $con = getConnection();
        $sql = "update login set email = :pEmail, age = :pAge, user = :pUser where id = :pID";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pID", $id);
        $stmt->bindParam(":pEmail", $email);
        $stmt->bindParam(":pAge", $age);
        $stmt->bindParam(":pUser", $user);

        return $stmt->execute();
    }