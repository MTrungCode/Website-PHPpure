<?php
    session_start();
    require_once __DIR__ ."../../libraries/Database.php";
    require_once __DIR__ ."../../libraries/Function.php";
    $db = new Database;

    $category = $db->fetchAll("category");
    $sql = "SELECT * FROM product ORDER BY created_at LIMIT 4";
    $productNew = $db->fetchsql($sql);
    
?>