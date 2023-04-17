<?php
    require_once __DIR__ ."../../../autoload/autoload.php";
    $open = "category";

    $id = intval(getInput('id'));
    
    $EditCategory = $db->fetchId("category", $id);
    if (empty($EditCategory))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("category");
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        
        $data = [
            "name" => postInput('name'),
            "slug" => to_slug(postInput('name'))
        ];
        
        $error = [];
        if (postInput('name') == '')
        {
            $error['name'] = "Tên danh mục không được bỏ trống";
        }
        if (empty($error))
        {

            if($EditCategory['name'] != $data['name'])
            {
                $isset = $db->fetchOne("category", " name = '".$data['name']."' ");
                if(count($isset) > 0)
                {
                    $_SESSION['error'] = "Tên danh mục đã tồn tại !! ";
                }
                else
                {
                    $id_update = $db->update("category", $data, array("id"=>$id));
                    if ($id_update > 0)
                    {
                        $_SESSION['success'] = "Cập nhật thành công";
                        redirectAdmin("category");
                    } else {
                        $_SESSION['error'] = "Dữ liệu không thay đổi";
                        redirectAdmin("category");
                    }
                }
            }
            else
            {
                $id_update = $db->update("category", $data, array("id"=>$id));
                if ($id_update > 0)
                {
                    $_SESSION['success'] = "Cập nhật thành công";
                    redirectAdmin("category");
                } else {
                    $_SESSION['error'] = "Dữ liệu không thay đổi";
                    redirectAdmin("category");
                }
            }
        }
    }

?>
<?php require_once __DIR__ ."../../../layouts/header.php"; ?>
<div class="row">
    <diV class="col-lg-12">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Sửa danh mục</h1>
            <div class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="fas fa-fw fa-tachometer-alt"></i><a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <i class="fas fa-fw fa-folder"></i>Danh mục sản phẩm
                </li>
                <li class="breadcrumb-item active">
                    <i class="fas fa-fw fa-folder"></i>Sửa
                </li>
            </div>
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="col-sm-2 control-label">Tên danh mục</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" name="name" value="<?php echo $EditCategory['name'] ?>">
                        <?php if (isset($error['name'])) : ?>
                            <span class="text-danger"> <?php echo $error['name'] ?> </span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="<?php echo modules('category') ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Quay lại</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once __DIR__ ."../../../layouts/footer.php"; ?>