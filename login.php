<?php
    require_once __DIR__ ."../autoload/autoload.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $data = [
            "email"    => postInput('email'),
            "password" => md5(postInput('password')),
        ];
        
        $error = [];
        if (postInput('email') == '')
        {
            $error['email'] = "Email không được bỏ trống";
        }
        if (postInput('password') == '')
        {
            $error['password'] = "Mật khẩu không được bỏ trống";
        }
        
        if(empty($error))
        {
            $isset = $db->fetchOne("user", "email = '".$data['email']."' AND password = '".$data['password']."'");
            if(count($isset) < 0)
            {
                $_SESSION['error'] = "Email hoặc mật khẩu không đúng! Vui lòng kiểm tra lại";
            }
            else
            {
                $_SESSION['user']['id'] = $isset['id'];
                $_SESSION['user']['name'] = $isset['name'];
                redirect();
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
                                        Đăng nhập
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <form class="form-horizontal" action="" method="post">                                            
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
                                                <label class="control-label col-sm-2" for="pwd">Password: <span class="text-danger">(*)</span></label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="pwd" name="password" placeholder="Nhập mật khẩu">
                                                    <?php if (isset($error['password'])) : ?>
                                                        <p class="text-danger"> <?php echo $error['password'] ?> </p>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success">Đăng nhập</button>
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