<?php
    require_once __DIR__ ."../autoload/autoload.php";

    $id = intval(getInput('id'));
    
    if (empty($_SESSION['cart'][$id]))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirect("cart.php");
    }
    else
    {
        unset($_SESSION['cart'][$id]);
        redirect("cart.php");
    }

?>