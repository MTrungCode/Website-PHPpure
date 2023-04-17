<?php
    require_once __DIR__ ."../../../autoload/autoload.php";
    $open = "category";

    $category = $db->fetchAll("category");
?>
<?php require_once __DIR__ ."../../../layouts/header.php"; ?>
<div class="row">
    <diV class="col-lg-12">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">
                Danh mục sản phẩm
                <a href="add.php" class="btn btn-success">Thêm mới <i class="fa fa-plus"></i></a>
            </h1>
            <div class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="fas fa-fw fa-tachometer-alt"></i><a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <i class="fas fa-fw fa-folder"></i>Danh mục sản phẩm
                </li>
            </div>
            <div class="clearfix"></div>
            <?php if(isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
                </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" style="font-size: 1rem">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Home</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $stt = 1; foreach ($category as $cate) : ?>
                                            <tr>
                                                <td><?php echo $stt ?></td>
                                                <td><?php echo $cate['name'] ?></td>
                                                <td><?php echo $cate['slug'] ?></td>
                                                <td>
                                                    <a href="home.php?id=<?php echo $cate['id'] ?>" class="btn btn-xs <?php echo $cate['home'] == 1 ? 'btn-info' : 'btn-secondary' ?>">
                                                        <?php echo $cate['home'] == 1 ? 'Hiển thị' : 'Không' ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $cate['created_at'] ?></td>
                                                <td>
                                                    <a href="edit.php?id=<?php echo $cate['id'] ?>" class="btn btn-xs btn-info">
                                                        <i class="fa fa-pen" title="Sửa"></i>
                                                    </a>
                                                    <a href="delete.php?id=<?php echo $cate['id'] ?>" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash" title="Xóa"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $stt++; endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ ."../../../layouts/footer.php"; ?>