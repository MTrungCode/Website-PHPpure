<?php
    require_once __DIR__ ."../../../autoload/autoload.php";
    $open = "transaction";
    $transaction = $db->fetchAll("transaction");

?>
<?php require_once __DIR__ ."../../../layouts/header.php"; ?>
<div class="row">
    <diV class="col-lg-12">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">
                Quản lý giao dịch
            </h1>
            <div class="breadcrumb">
                <li class="breadcrumb-item">
                    <i class="fas fa-fw fa-tachometer-alt"></i><a href="">Dashboard</a>
                </li>
                <li class=" breadcrumb-item active">
                    <i class="fas fa-fw fa-folder"></i>Giao dịch
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
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách Giao dịch</h6>
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
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                            <?php foreach($transaction as $item) : ?>
                                                <tr>
                                                    <td><?php echo $item['tst_name'] ?></td>
                                                    <td><?php echo $item['tst_email'] ?></td>
                                                    <td><?php echo "0" . $item['tst_phone'] ?></td>
                                                    <td><?php echo $item['tst_address'] ?></td>
                                                    <td><?php echo $item['tst_total'] ?></td>
                                                    <td>
                                                        <select name="" id="<?php echo $item['tst_id'] ?>">
                                                            <option value=""><span class="badge badge-primary">Chưa xử lý</span></option>
                                                            <option value=""><span class="badge badge-info">Đang giao hàng</span></option>
                                                            <option value=""><span class="badge badge-success">Đã nhận hàng</span></option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <?php echo $item['tst_payment'] ?>
                                                    </td>
                                                    <td>
                                                        <a href="" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                                                        <a href="delete.php?id=<?php echo $item['tst_id'] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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