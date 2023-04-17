<?php
    require_once __DIR__ ."../autoload/autoload.php";

    $id = intval(getInput('id'));

    $product = $db->fetchId("product", $id);
    // _debug(getInput('id'));die;
    if ($product)
    {
        if(isset($_SESSION['cart']))
        {
            if(isset($_SESSION['cart'][$id]))
            {
                $_SESSION['cart'][$id]['qty'] += 1;
            }
            else
            {
                $_SESSION['cart'][$id]['qty'] = 1;
            }
            $_SESSION['success'] = "Thêm sản phẩm vào giỏ hàng thành công";
            $_SESSION['cart'][$id]['id']     = $id;
            $_SESSION['cart'][$id]['name']   = $product['pro_name'];
            $_SESSION['cart'][$id]['price']  = $product['pro_price'];
            $_SESSION['cart'][$id]['sale']   = $product['pro_sale'];
            $_SESSION['cart'][$id]['avatar'] =  $product['pro_thumbar'];
            redirect("chi-tiet-san-pham.php?id=". $id);
        }
        else
        {
            $_SESSION['success'] = "Khởi tạo giỏ hàng thành công";
            $_SESSION['cart'][$id]['qty'] = 1;
            $_SESSION['cart'][$id]['id']     = $id;
            $_SESSION['cart'][$id]['name']   = $product['pro_name'];
            $_SESSION['cart'][$id]['price']  = $product['pro_price'];
            $_SESSION['cart'][$id]['sale']   = $product['pro_sale'];
            $_SESSION['cart'][$id]['avatar'] =  $product['pro_thumbar'];
            redirect("chi-tiet-san-pham.php?id=". $id);
        }
    }

?>