<?php
    require_once __DIR__ ."../autoload/autoload.php";
    $sqlHomecate = "SELECT name , id FROM category WHERE home = 1 ORDER BY updated_at";
    $CategoryHome = $db->fetchsql($sqlHomecate);
    $data = [];

    foreach ($CategoryHome as $item) {
        $cateId = intval($item['id']);
        $sql = "SELECT * FROM product WHERE pro_category_id = $cateId";
        $productHome = $db->fetchsql($sql);
        $data[$item['name']] = $productHome;
    }
?>
<?php require_once __DIR__ ."../layouts/header.php"; ?>
                    <div class="col-md-9 bor">
                        <section id="slide" class="text-center" >
                            <img src="images/slide/sl3.jpg" class="img-thumbnail">
                        </section>
                        <section class="box-main1">
                            <?php foreach($data as $key => $value) : ?>
                                <h3 class="title-main"><a href=""><?php echo $key ?></a> </h3>
                                
                                <div class="showitem" style="margin-top: 10px; margin-bottom: 10px">
                                    <?php foreach ($value as $item) : ?>
                                        <div class="col-md-3 item-product bor">
                                            <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                                                <img src="<?php echo uploads() ?>/product/<?php echo $item['pro_thumbar'] ?>" class="" width="100%" height="170px">
                                            </a>
                                            <div class="info-item">
                                                <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><?php echo $item['pro_name'] ?></a>
                                                <?php if($item['pro_sale'] == 0): ?>
                                                    <p><b class="price"><?php echo formatPrice($item['pro_price']) ?> đ</b></p>
                                                <?php else : ?>
                                                    <p><strike class="sale"><?php echo formatPrice($item['pro_price']) ?> đ</strike> <b class="price"><?php echo number_format(((100 - $item['pro_sale'])*$item['pro_price'])/100,0, ',', '.') ?> đ</b></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="hidenitem">
                                                <p><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                                                <p><a href=""><i class="fa fa-heart"></i></a></p>
                                                <p><a href=""><i class="fa fa-shopping-basket"></i></a></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </section>
                    </div>
                </div>
<?php require_once __DIR__ ."../layouts/footer.php"; ?>