<?php
    require_once __DIR__ ."../autoload/autoload.php";

    unset($_SESSION['user']);
    redirect();
?>