<?php
    require_once __DIR__ ."../autoload/autoload.php";

    $id = intval(getInput('id'));
    $product = $db->fetchId("product", $id);

?>
<?php require_once __DIR__ ."../layouts/header.php"; ?>
                    <div class="col-md-9 bor">
                        <div class="clearfix"></div>
                        <?php if(isset($_SESSION['success'])) : ?>
                            <div class="alert alert-success">
                                <?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
                            </div>
                        <?php endif; ?>
                        <section class="box-main1" >
                            <div class="col-md-6 text-center">
                                <img src="<?php echo uploads() ?>/product/<?php echo $product['pro_thumbar'] ?>" class="img-responsive bor" id="imgmain" width="100%" height="370" data-zoom-image="<?php echo uploads() ?>/product/<?php echo $product['pro_thumbar'] ?>">
                                <ul class="text-center bor clearfix" id="imgdetail">
                                    <li>
                                        <img src="<?php echo uploads() ?>/product/<?php echo $product['pro_thumbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                    </li>
                                    <li>
                                        <img src="<?php echo uploads() ?>/product/<?php echo $product['pro_thumbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                    </li>
                                    <li>
                                        <img src="<?php echo uploads() ?>/product/<?php echo $product['pro_thumbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                    </li>
                                    <li>
                                        <img src="<?php echo uploads() ?>/product/<?php echo $product['pro_thumbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                    </li>
                                
                                </ul>
                            </div>
                            <div class="col-md-6 bor" style="margin-top: 20px;padding: 30px;">
                                <ul id="right">
                                    <li><h3> <?php echo $product['pro_name'] ?> </h3></li>
                                    <li><p><b> Số lượng hiện có: <?php echo $product['pro_number'] ?> </b></p></li>
                                    <?php if($product['pro_sale'] == 0): ?>
                                        <li><p><b class="price"><?php echo formatPrice($product['pro_price']) ?> đ</b></p></li>
                                    <?php else : ?>
                                        <li><p><strike class="sale"><?php echo formatPrice($product['pro_price']) ?> đ</strike> <b class="price"><?php echo number_format(((100 - $product['pro_sale'])*$product['pro_price'])/100,0, ',', '.') ?> đ</b></p></li>
                                    <?php endif; ?>
                                    <li><a href="addcart.php?id=<?php echo $product['id'] ?>" class="btn btn-default"> <i class="fa fa-shopping-basket"></i>Add TO Cart</a></li>
                                </ul>
                            </div>
                        </section>      
                        <div class="col-md-12" id="tabdetail">
                            <div class="row list-group"> 
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-bs-toggle="tab" href="#home">Mô tả sản phẩm</a></li>
                                    <li><a data-bs-toggle="tab" href="#menu1">Thông tin khác</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane active">
                                        <h3>Nội dung</h3>
                                        <p><pre><?php echo $product['pro_description'] ?></pre></p>
                                    </div>
                                    <div id="menu1" class="tab-pane">
                                        <h3> Thông tin khác </h3>
                                        <p>Đang cập nhật.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
<?php require_once __DIR__ ."../layouts/footer.php"; ?>