<?php
    session_start();
    
    $_SESSION['id'] = json_decode(file_get_contents('php://input'), true)["data"];
    echo $_SESSION['id'];
    exit; 