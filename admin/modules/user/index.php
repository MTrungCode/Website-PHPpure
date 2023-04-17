<?php
    require_once __DIR__ ."../../../autoload/autoload.php";
    $open = "user";
    $users = $db->fetchAll("user");

?>
<?php require_once __DIR__ ."../../../layouts/header.php"; ?>
<div class="row">
    <diV class="col-lg-12">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">
                Quản lý thành viên
            </h1>
            <div class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="fas fa-fw fa-tachometer-alt"></i><a href="">Dashboard</a>
                </li>
                <li class=" breadcrumb-item active">
                    <i class="fas fa-fw fa-folder"></i>Thành viên
                </li>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách Thành viên</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="font-size: 14px">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Birthday</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                            <?php foreach($users as $user) : ?>
                                                <tr>
                                                    <td><?php echo $user['name'] ?></td>
                                                    <td><?php echo $user['email'] ?></td>
                                                    <td>
                                                        <?php if($user['gender'] == 0) : ?>
                                                            <span class="badge badge-info">Nam</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-danger">Nữ</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo $user['birthday'] ?></td>
                                                    <td><?php echo "0" . $user['phone'] ?></td>
                                                    <td><?php echo $user['address'] ?></td>
                                                    <td>
                                                        <a href="delete.php?id=<?php echo $item['id'] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
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
</div>
<?php require_once __DIR__ ."../../../layouts/footer.php"; ?>