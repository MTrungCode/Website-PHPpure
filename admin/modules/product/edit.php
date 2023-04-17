<?php
    require_once __DIR__ ."../../../autoload/autoload.php";
    $open = "product";

    $categories = $db->fetchAll("category");
    
    $products = $db->fetchAll("product");

    $id = intval(getInput('id'));

    $EditProduct = $db->fetchId("product", $id);
    
    if (empty($EditProduct))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("product");
    }
    // _debug($EditProduct);

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        
        $data = [
            "pro_name"         => postInput('pro_name'),
            "pro_slug"         => to_slug(postInput('pro_name')),
            "pro_price"        => postInput('pro_price'),
            "pro_sale"         => postInput('pro_sale'),
            "pro_number"       => postInput('pro_number'),
            "pro_description"  => postInput('pro_description'),
            "pro_category_id"  => postInput('pro_category_id')
        ];
        // _debug($data);die();
        $error = [];
        if (postInput('pro_name') == '')
        {
            $error['pro_name'] = "Tên sản phẩm không được bỏ trống";
        }
        if (postInput('pro_price') == '')
        {
            $error['pro_price'] = "Giá sản phẩm không được bỏ trống";
        }
        if (postInput('pro_number') == '')
        {
            $error['pro_number'] = "Số lượng sản phẩm không được bỏ trống";
        }
        if (postInput('pro_description') == '')
        {
            $error['pro_description'] = "Mô tả sản phẩm không được bỏ trống";
        }
        if (postInput('pro_category_id') == '')
        {
            $error['pro_category_id'] = "Danh mục sản phẩm không được bỏ trống";
        }
        
         if (empty($error))
         {
            $id_update = $db->update("product", $data, array("id" => $id));
            if ($id_update > 0)
            {
                $_SESSION['success'] = "Thêm mới thành công";
                redirectAdmin("product");
            } else {
                $_SESSION['error'] = "Thêm mới thất bại";
                redirectAdmin("product");
            }
         }
    }

?>
<?php require_once __DIR__ ."../../../layouts/header.php"; ?>
<div class="row">
    <diV class="col-lg-12">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Thêm mới sản phẩm</h1>
            <div class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="fas fa-fw fa-tachometer-alt"></i><a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <i class="fas fa-fw fa-folder"></i>Sản phẩm
                </li>
                <li class="breadcrumb-item active">
                    <i class="fas fa-fw fa-folder"></i>Thêm mới
                </li>
            </div>
            <section class="content">
                <form role="form" action="" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-8">
                        <div class="box box-qarning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Thông tin cơ bản</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm <b class="text-danger">(*)</b></label>
                                    <input type="text" class="form-control" name="pro_name" placeholder="Name ..." autocomplete="off" value="<?php echo $EditProduct['pro_name'] ?>">
                                    <?php if (isset($error['pro_name'])) : ?>
                                        <span class="text-danger"> <?php echo $error['pro_name'] ?> </span>
                                    <?php endif ?>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name">Giá sản phẩm <b class="text-danger">(*)</b></label>
                                            <input type="number" class="form-control" name="pro_price" placeholder="1.000.000" data-type="currency" value="<?php echo $EditProduct['pro_price'] ?>">
                                            <?php if (isset($error['pro_price'])) : ?>
                                                <span class="text-danger"> <?php echo $error['pro_price'] ?> </span>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name">Giảm giá</label>
                                            <input type="number" class="form-control" name="pro_sale" placeholder="5%" data-type="currency" value="<?php echo $EditProduct['pro_sale'] ?? "" ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name">Số lượng <b class="text-danger">(*)</b></label>
                                            <input type="number" class="form-control" name="pro_number" placeholder="50" data-type="currency" value="<?php echo $EditProduct['pro_number'] ?>">
                                            <?php if (isset($error['pro_number'])) : ?>
                                                <span class="text-danger"> <?php echo $error['pro_number'] ?> </span>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Description <b class="text-danger">(*)</b></label>
                                    <textarea name="pro_description" class="form-control" cols="5" rows="2" autocomplete="off"><?php echo $EditProduct['pro_description'] ?></textarea>
                                    <?php if (isset($error['pro_description'])) : ?>
                                        <span class="text-danger"> <?php echo $error['pro_description'] ?> </span>
                                    <?php endif ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Danh mục <b class="text-danger">(*)</b></label>
                                    <select name="pro_category_id" class="form-control">
                                        <option value="0">___Click___</option>
                                        <?php foreach($categories as $cate) : ?>
                                            <option value="<?php echo $cate['id'] ?>" <?php (isset($EditProduct['pro_category_id']) ?? 0 == $cate['id']) ? "selected='selected'" : "" ?>>
                                                <?php echo $cate['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (isset($error['pro_category_id'])) : ?>
                                        <span class="text-danger"><?php echo $error['pro_category_id'] ?></span>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box box-qarning">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ảnh đại diện <b class="text-danger">(*)</b></h3>
                            </div>
                            <div class="box-body block-images">
                                <div style="margin-bottom: 10px;"><img src="<?php echo public_admin() ?>images/avatar.jpg" onerror="this.onerror=null;this.src='<?php echo public_admin() ?>images/avatar.jpg';" alt="" class="img-thumbnail" style="width: 200px; height: 200px;"></div>
                                <div style="position: relative;"><a class="btn btn-primary" href="javascript:;"> Choose File...<input type="file" style="position: absolute;z-index: 2;top: 0;left: 0;filter: alpha(opacity=0);-ms-filter:&quot;progid:DXImageTransForm.Microsoft.Alpha(opacity=0)&quot;;opacity: 0;background-color: transparent;color: transparent;" name="pro_avatar" size="40" class="js-upload"></a><span class="label label-info" id="upload-file-info"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 clearfix">
                        <div class="box-footer text-center">
                            <a href="<?php echo modules('product') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Quay lại</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Lưu</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<?php require_once __DIR__ ."../../../layouts/footer.php"; ?>