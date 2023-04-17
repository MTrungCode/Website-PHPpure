<!DOCTYPE html>
<html>
    <head>
        <title>SSRPhone: Website bán điện thoại di động</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/bootstrap.min.css">
        
        <script  src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script  src="<?php echo base_url() ?>public/frontend/js/bootstrap.min.js"></script>
    
        <!---->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/slick.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/slick-theme.css"/>
        <!--slide-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/style.css">
        
    </head>
    <body>
        <div id="wrapper">
            <!---->
            <!--HEADER-->
            <div id="header">
                <div id="header-top">
                    <div class="container">
                        <div class="row clearfix">
                            <div class="col-md-6" id="header-text">
                                <a>SSRShop</a><b>Uy tín, chất lượng trên từng sản phẩm</b>
                            </div>
                            <div class="col-md-6">
                                <nav id="header-nav-top">
                                    <ul class="list-inline pull-right" id="headermenu">
                                        <?php if(isset($_SESSION['user'])) : ?> 
                                            <li>
                                                <a href=""><i class="fa fa-user"></i> <?php echo $_SESSION['user']['name'] ?> <i class="fa fa-caret-down"></i></a>
                                                <ul id="header-submenu">
                                                    <li><a href="">Orders</a></li>
                                                    <li><a href="">Contact</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="logout.php"><i class="fa fa-share-square-o"></i> Logout</a>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <a href="register.php"><i class="fa fa-unlock"></i> Register</a>
                                            </li>
                                            <li>
                                                <a href="login.php"><i class="fa fa-lock"></i> Login</a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row" id="header-main">
                        <div class="col-md-5">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label>
                                        <select name="category" class="form-control">
                                            <option> All Category</option>
                                            <?php foreach($category as $cate): ?>
                                                <option value="<?php echo $cate['id'] ?>"> <?php echo $cate['name'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </label>
                                    <input type="text" name="keywork" placeholder=" input keywork" class="form-control">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <a href="">
                                <img src="<?php echo base_url() ?>public/frontend/images/logo.gif" width="100%" height="120px">
                            </a>
                        </div>
                        <div class="col-md-3" id="header-right">
                            <div class="pull-right">
                                <div class="pull-left">
                                    <i class="glyphicon glyphicon-phone-alt"></i>
                                </div>
                                <div class="pull-right">
                                    <p id="hotline">HOTLINE</p>
                                    <p>0986420994</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END HEADER-->
            
            <!--MENUNAV-->
            <div id="menunav">
                <div class="container">
                    <nav>
                        <div class="home pull-left">
                            <a href="<?php echo base_url() ?>">Trang chủ</a>
                        </div>
                        <!--menu main-->
                        <ul id="menu-main">
                            <li>
                                <a href="">Shop</a>
                            </li>
                            <li>
                                <a href="">Mobile</a>
                            </li>
                            <li>
                                <a href="">Contact</a>
                            </li>
                            <li>
                                <a href="">Blog</a>
                            </li>
                            <li>
                                <a href="">About us</a>
                            </li>
                        </ul>
                        <!-- end menu main-->

                        <!--Shopping-->
                        <ul class="pull-right" id="main-shopping">
                            <li>
                                <a href="cart.php"><i class="fa fa-shopping-basket"></i> My Cart </a>
                            </li>
                        </ul>
                        <!--end Shopping-->
                    </nav>
                </div>
            </div>
            <!--ENDMENUNAV-->
            
            <div id="maincontent">
                <div class="container">
                    <div class="col-md-3  fixside" >
                        <div class="box-left box-menu" >
                            <h3 class="box-title"><i class="fa fa-list"></i>  Danh mục</h3>
                            <ul>
                                <?php foreach($category as $cate): ?>
                                    <li><a href="danh-muc-san-pham.php?id=<?php echo $cate['id'] ?>"><?php echo $cate['name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm mới </h3>
                            <ul>
                                <?php foreach($productNew as $item) : ?> 
                                    <li class="clearfix">
                                        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                                            <img src="<?php echo uploads() ?>/product/<?php echo $item['pro_thumbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                            <div class="info pull-right">
                                                <p class="name" title="<?php echo $item['pro_name'] ?>"><?php echo $item['pro_name'] ?></p >
                                                <?php if ($item['pro_sale'] != 0) : ?>
                                                    <b class="price">Giảm giá: <?php echo number_format(((100 - $item['pro_sale'])*$item['pro_price'])/100,0, ',', '.') ?> đ</b><br>
                                                    <b class="sale">Giá gốc: <?php echo formatPrice($item['pro_price']) ?> đ</b><br>
                                                <?php else : ?>
                                                    <b class="price">Giá gốc: <?php echo formatPrice($item['pro_price']) ?> đ</b><br>
                                                <?php endif; ?>
                                                <span class="view"><i class="fa fa-eye"></i> 0 : <i class="fa fa-heart-o"></i> 0</span>
                                            </div>
                                        </a>
                                    </li>
                               <?php endforeach; ?>
                            </ul>
                            <!-- </marquee> -->
                        </div>

                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm bán chạy </h3>
                            <ul>
                                
                                <li class="clearfix">
                                    <a href="">
                                        <img src="images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"> Loa  mới nhất 2016  Loa  mới nhất 2016 Loa  mới nhất 2016</p >
                                            <b class="price">Giảm giá: 6.090.000 đ</b><br>
                                            <b class="sale">Giá gốc: 7.000.000 đ</b><br>
                                            <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
                                        </div>
                                    </a>
                                </li>
                               
                            </ul>
                            <!-- </marquee> -->
                        </div>
                    </div>