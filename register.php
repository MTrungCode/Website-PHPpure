<?php
    require_once __DIR__ ."../autoload/autoload.php";

    

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $data = [
            "name"     => postInput('name'),
            "email"    => postInput('email'),
            "gender"   => postInput('gender'),
            "password" => md5(postInput('password')),
            "birthday" => postInput('birthday'),
            "phone"    => postInput('phone'),
            "address"  => postInput('address')
        ];
        
        $error = [];
        if (postInput('name') == '')
        {
            $error['name'] = "Họ tên không được bỏ trống";
        }
        
        if (postInput('email') == '')
        {
            $error['email'] = "Email không được bỏ trống";
        }
        if (postInput('password') == '')
        {
            $error['password'] = "Mật khẩu không được bỏ trống";
        }
        if (postInput('phone') == '')
        {
            $error['phone'] = "Số điện thoại không được bỏ trống";
        }
        if (postInput('address') == '')
        {
            $error['address'] = "Địa chỉ không được bỏ trống";
        }

        if(empty($error))
        {
            $isset = $db->fetchOne("user", " email = '".$data['email']."' ");
            
            if($isset != NULL && (count($isset) > 0))
            {
                $_SESSION['error'] = "Email này đã tồn tại !! ";
            }
            else
            {
                $id_insert = $db->insert("user", $data);
                // _debug($id_insert);die;
                if ($id_insert > 0)
                {
                    $_SESSION['success'] = "Đăng ký thành công";
                    redirect("login.php");
                } else
                {
                    $_SESSION['error'] = "Đăng ký thất bại";
                }
            }
        }

    }
    
?>
<?php require_once __DIR__ ."../layouts/header.php"; ?>
                    <div class="col-md-9">
                        <section class="box-main1">
                            <div class="panel-group">
                                <div class="clearfix"></div>
                                <?php if(isset($_SESSION['error'])) : ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="panel panel-primary">
                                    <div class="panel-heading text-cNhập" style="font-size: 30px;font-family: sans-serif;font-weight: bold;">
                                        Đăng ký thành viên
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <form class="form-horizontal" action="" method="post">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">Name: <span class="text-danger">(*)</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ tên">
                                                    <?php if (isset($error['name'])) : ?>
                                                        <p class="text-danger"> <?php echo $error['name'] ?> </p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">Email: <span class="text-danger">(*)</span></label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email">
                                                    <?php if (isset($error['email'])) : ?>
                                                        <p class="text-danger"> <?php echo $error['email'] ?> </p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pwd">Giới tính:</label>
                                                <div class="col-sm-10">
                                                    <div class="col-sm-3">
                                                        <label for="email">Nam</label><br>
                                                        <input type="radio" id="M" name="gender" value="0">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="email">Nữ</label><br>
                                                        <input type="radio" id="F" name="gender" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pwd">Password: <span class="text-danger">(*)</span></label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="pwd" name="password" placeholder="Nhập mật khẩu">
                                                    <?php if (isset($error['password'])) : ?>
                                                        <p class="text-danger"> <?php echo $error['password'] ?> </p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pwd">Ngày sinh:</label>
                                                <div class="col-sm-10">
                                                    <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Nhập ngày sinh">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pwd">Điện thoại: <span class="text-danger">(*)</span></label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
                                                    <?php if (isset($error['phone'])) : ?>
                                                        <p class="text-danger"> <?php echo $error['phone'] ?> </p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="pwd">Địa chỉ: <span class="text-danger">(*)</span></label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="address" id="address" rows="5"></textarea>
                                                    <?php if (isset($error['address'])) : ?>
                                                        <p class="text-danger"> <?php echo $error['address'] ?> </p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success">Đăng ký</button>
                                                    <button type="submit" class="btn btn-danger">Hủy</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
<?php require_once __DIR__ ."../layouts/footer.php"; ?>