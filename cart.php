<?php
    require_once __DIR__ ."../autoload/autoload.php";

    if (isset($_SESSION['user']['id']))
    {
        $users = $db->fetchId("user", $_SESSION['user']['id']);
    }
    // _debug($users);die;
    $total_money = 0;
    $price = 0;
    if (isset($_SESSION['cart']))
    {
        foreach ($_SESSION['cart'] as $item) {
            if($item['sale'] != 0)
            {
                $price = ((100 - $item['sale'])*$item['price']/100)*$item['qty'];
                $total_money += $price;
            }
            else
            {
                $price = $item['price']*$item['qty'];
                $total_money += $price;
            }
        }
    }
    // _debug($_SESSION['cart']);die;
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $data = [
            "tst_name"     => postInput('tst_name'),
            "tst_email"    => postInput('tst_email'),
            "tst_phone"    => postInput('tst_phone'),
            "tst_address"  => postInput('tst_address'),
            "tst_note"   => postInput('tst_note'),
            "tst_total" => postInput('tst_total'),
            "tst_payment" => postInput('tst_payment')
        ];
        
        $error = [];
        if (postInput('tst_name') == '')
        {
            $error['tst_name'] = "Họ tên không được bỏ trống";
        }
        if (postInput('tst_email') == '')
        {
            $error['tst_email'] = "Email không được bỏ trống";
        }
        if (postInput('tst_phone') == '')
        {
            $error['tst_phone'] = "Số điện thoại không được bỏ trống";
        }
        if (postInput('tst_address') == '')
        {
            $error['tst_address'] = "Địa chỉ không được bỏ trống";
        }
        if(empty($error))
        {
            $id_insert = $db->insert("transaction", $data);
            // _debug($id_insert);die;
            if ($id_insert > 0)
            {
                redirect();
            } else
            {
                $_SESSION['error'] = "Thanh toán thất bại";
            }
        }
    }

?>
<?php require_once __DIR__ ."../layouts/header.php"; ?>
                    <div class="col-md-9 bor">
                        <section class="box-main1" >
                            <div class="clearfix"></div>
                            <?php if(isset($_SESSION['error'])) : ?>
                                <div class="alert alert-danger" style="margin-top: 3px;">
                                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                                </div>
                            <?php endif; ?>
                            <div class="panel panel-primary" style="margin-top: 5px;">
                                <div class="panel-heading" style="font-size: 20px;font-family: sans-serif;font-weight: bold;">
                                    Thông tin sản phẩm
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-2">Name</div>
                                            <div class="col-sm-2">Avatar</div>
                                            <div class="col-sm-2">Price</div>
                                            <div class="col-sm-2">Quantity</div>
                                            <div class="col-sm-2">Total</div>
                                            <div class="col-sm-2"></div>
                                        </div>
                                    </div>
                                    <?php if(isset($_SESSION['cart'])) : ?>
                                        <?php foreach($_SESSION['cart'] as  $item) : ?>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-2"><?php echo $item['name'] ?></div>
                                                    <div class="col-sm-2">
                                                        <a href="">
                                                            <img src="<?php echo uploads() ?>/product/<?php echo $item['avatar'] ?>" alt="" width="80px" height="60px">
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <?php if($item['sale'] == 0): ?>
                                                            <p><b class="price"><?php echo formatPrice($item['price']) ?> đ</b></p>
                                                        <?php else : ?>
                                                            <p><strike class="sale"><?php echo formatPrice($item['price']) ?> đ</strike> <b class="price"><?php echo number_format(((100 - $item['sale'])*$item['price'])/100,0, ',', '.') ?> đ</b></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="number" class="form-control" value="<?php echo $item['qty'] ?>" >
                                                        <a href="updateqty.php?id=<?php echo $item['id'] ?>" class="btn btn-xs btn-info" style="margin-top: 2px;"> Update </a>                                                
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <?php if($item['sale'] != 0): ?>
                                                            <?php echo formatPrice(((100 - $item['sale'])*$item['price']/100)*$item['qty']) ?> đ
                                                        <?php else : ?>
                                                            <?php echo formatPrice($item['price']*$item['qty']) ?> đ
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <a href="del-cart-product.php?id=<?php echo $item['id'] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="sidebar-divider my-0">
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="panel panel-primary" style="margin-top: 5px;">
                                <div class="panel-heading" style="font-size: 20px;font-family: sans-serif;font-weight: bold;">
                                    Thông tin khách hàng
                                </div>
                                <div class="panel-body">
                                    <?php if(isset($_SESSION['user'])) : ?>
                                        <?php foreach($users as $user) : ?>
                                            <form class="form-horizontal" action="" method="post">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Name: <span class="text-danger">(*)</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="name" name="tst_name" value="<?php echo $user['name'] ?>" placeholder="Nhập họ tên">
                                                        <?php if (isset($error['tst_name'])) : ?>
                                                            <p class="text-danger"> <?php echo $error['tst_name'] ?> </p>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Email: <span class="text-danger">(*)</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="email" name="tst_email" value="<?php echo $user['email'] ?>" placeholder="Nhập email">
                                                        <?php if (isset($error['tst_email'])) : ?>
                                                            <p class="text-danger"> <?php echo $error['tst_email'] ?> </p>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="pwd">Điện thoại: <span class="text-danger">(*)</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" id="phone" name="tst_phone" value="<?php echo $user['phone'] ?>" placeholder="Nhập số điện thoại">
                                                        <?php if (isset($error['tst_phone'])) : ?>
                                                            <p class="text-danger"> <?php echo $error['tst_phone'] ?> </p>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="pwd">Địa chỉ: <span class="text-danger">(*)</span></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="address" name="tst_address" value="<?php echo $user['address'] ?>" placeholder="Nhập địa chỉ">
                                                        <?php if (isset($error['tst_address'])) : ?>
                                                            <p class="text-danger"> <?php echo $error['tst_address'] ?> </p>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="pwd">Ghi chú: </label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name="tst_note" id="note" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="pwd">Tổng tiền: </label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" id="total" name="tst_total" value="<?php echo $total_money ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" class="btn btn-success">
                                                            <p style="font-size: inherit;font-family: ui-sans-serif;">ĐẶT HÀNG THANH TOÁN SAU</p>
                                                            <p>(Trả tiền khi nhận hàng tại nhà)</p>
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">
                                                            <p style="font-size: inherit;font-family: ui-sans-serif;">THANH TOÁN ONLINE</p>
                                                            <p>(Bằng thẻ ATM, Visa, Master)</p>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <form class="form-horizontal" action="" method="post">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">Name: <span class="text-danger">(*)</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="name" name="tst_name" value="" placeholder="Nhập họ tên">
                                                    <?php if (isset($error['tst_name'])) : ?>
                                                        <p class="text-danger"> <?php echo $error['tst_name'] ?> </p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">Email: <span class="text-danger">(*)</span></label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="email" name="tst_email" value="" placeholder="Nhập email">
                                                    <?php if (isset($error['tst_email'])) : ?>
                                                        <p class="text-danger"> <?php echo $error['tst_email'] ?> </p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pwd">Điện thoại: <span class="text-danger">(*)</span></label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="phone" name="tst_phone" value="" placeholder="Nhập số điện thoại">
                                                    <?php if (isset($error['tst_phone'])) : ?>
                                                        <p class="text-danger"> <?php echo $error['tst_phone'] ?> </p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pwd">Địa chỉ: <span class="text-danger">(*)</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="address" name="tst_address" value="" placeholder="Nhập địa chỉ">
                                                    <?php if (isset($error['tst_address'])) : ?>
                                                        <p class="text-danger"> <?php echo $error['tst_address'] ?> </p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pwd">Ghi chú: </label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="tst_note" id="note" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pwd">Tổng tiền: </label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="total" name="tst_total" value="<?php echo $total_money ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="tst_payment" value="1" class="btn btn-success">
                                                        <p style="font-size: inherit;font-family: ui-sans-serif;">ĐẶT HÀNG THANH TOÁN SAU</p>
                                                        <p>(Trả tiền khi nhận hàng tại nhà)</p>
                                                    </button>
                                                    <button type="submit" name="tst_payment" value="2" class="btn btn-danger">
                                                        <p style="font-size: inherit;font-family: ui-sans-serif;">THANH TOÁN ONLINE</p>
                                                        <p>(Bằng thẻ ATM, Visa, Master)</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </section>      
                    </div>
                </div>                
<?php require_once __DIR__ ."../layouts/footer.php"; ?>