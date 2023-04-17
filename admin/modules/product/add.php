<?php
    require_once __DIR__ ."../../../autoload/autoload.php";
    $open = "product";

    $categories = $db->fetchAll("category");
    
    
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
        
        if (! isset($_FILES['pro_thumbar']))
        {
            $error['pro_thumbar'] = "Hình ảnh sản phẩm không được bỏ trống";
        }
        
        if (empty($error))
        {
            if (isset($_FILES['pro_thumbar']))
            {
                $file_name = $_FILES['pro_thumbar']['name'];
                $file_tmp = $_FILES['pro_thumbar']['tmp_name'];
                $file_type = $_FILES['pro_thumbar']['type'];
                $file_error = $_FILES['pro_thumbar']['error'];
                
                if ($file_error == 0)
                {
                    $part = ROOT. "product/";
                    $data['pro_thumbar'] = $file_name;
                }

                $id_insert = $db->insert("product", $data);
                if ($id_insert)
                {
                    
                    move_uploaded_file($file_tmp, $part.$file_name);
                    $_SESSION['success'] = "Thêm mới thành công";
                    redirectAdmin("product");
                } else {
                    $_SESSION['error'] = "Thêm mới thất bại";
                }
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
                                    <input type="text" class="form-control" name="pro_name" placeholder="Name ..." autocomplete="off" value="">
                                    <?php if (isset($error['pro_name'])) : ?>
                                        <p class="text-danger"> <?php echo $error['pro_name'] ?> </p>
                                    <?php endif ?>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name">Giá sản phẩm <b class="text-danger">(*)</b></label>
                                            <input type="number" class="form-control" name="pro_price" placeholder="1.000.000" data-type="currency" value="">
                                            <?php if (isset($error['pro_price'])) : ?>
                                                <p class="text-danger"> <?php echo $error['pro_price'] ?> </p>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name">Giảm giá</label>
                                            <input type="number" class="form-control" name="pro_sale" placeholder="5%" data-type="currency" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name">Số lượng <b class="text-danger">(*)</b></label>
                                            <input type="number" class="form-control" name="pro_number" placeholder="50" data-type="currency" value="">
                                            <?php if (isset($error['pro_number'])) : ?>
                                                <p class="text-danger"> <?php echo $error['pro_number'] ?> </p>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Danh mục <b class="text-danger">(*)</b></label>
                                    <select name="pro_category_id" class="form-control">
                                        <option value="">___Click___</option>
                                        <?php foreach($categories as $cate) : ?>
                                            <option value="<?php echo $cate['id'] ?>">
                                                <?php echo $cate['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (isset($error['pro_category_id'])) : ?>
                                        <p class="text-danger"><?php echo $error['pro_category_id'] ?></p>
                                    <?php endif ?>
                                </div>
                                <div class="form-group">
                                    <label for="name">Description <b class="text-danger">(*)</b></label>
                                    <textarea name="pro_description" class="form-control" cols="5" rows="4" autocomplete="off"></textarea>
                                    <?php if (isset($error['pro_description'])) : ?>
                                        <p class="text-danger"> <?php echo $error['pro_description'] ?> </p>
                                    <?php endif ?>
                                </div>
                                
                                <div class="row">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-5 control-label">Hình ảnh <b class="text-danger">(*)</b></label>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" id="name" name="pro_thumbar">
                                            <?php if(isset($error['pro_thumbar'])) : ?>
                                                <p class="text-danger"> <?php echo $error['pro_thumbar'] ?> </p>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
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