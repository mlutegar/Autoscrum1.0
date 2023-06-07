<?php
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('DATABASE', 'autoscrum');

    function getConnection()
    {
        $dsn = 'mysql:host=' . HOST . ';dbname=' . DATABASE;

        $con = new PDO($dsn, USER, PASS) or die('Erro ao tentar conectar ao banco') ;
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->query("SET @@global.time_zone = '+3:00'");

        return $con;
    };