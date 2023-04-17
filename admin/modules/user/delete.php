<?php
    require_once __DIR__ ."../../../autoload/autoload.php";
    $open = "user";

    $id = intval(getInput('id'));
    
    $EditUsert = $db->fetchId("user", $id);
    if (empty($EditUsert))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("user");
    }
    $num = $db->delete("user", $id);
    if ($num > 0)
    {
        $_SESSION['success'] = "Xóa thành công";
        redirectAdmin("user");
    } else {
        $_SESSION['error'] = "Xóa thất bại ";
        redirectAdmin("user");
    }

?>