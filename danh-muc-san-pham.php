<?php
    require_once __DIR__ ."../autoload/autoload.php";

    $id = intval(getInput('id'));
    $EditCategory = $db->fetchId("category", $id);

    if (isset($_GET['p']))
    {
        $p = $_GET['p'];
    } else
    {
        $p = 1;
    }
    
    $sql = "SELECT * FROM product WHERE pro_category_id = $id";

    $total = count($db->fetchsql($sql));

    $product = $db->fetchJones("product", $sql, $total, $p, 2, true);
    $sotrang = $product['page'];
    unset($product['page']);

    $path = $_SERVER['SCRIPT_NAME'];
?>
<?php require_once __DIR__ ."../layouts/header.php"; ?>
                    <div class="col-md-9 bor">
                        <section class="box-main1">
                            <h3 class="title-main"><a href="javascript:void(0)"> <?php echo $EditCategory['name'] ?> </a> </h3>
                            <div class="showitem clearfix" style="margin-top: 10px; margin-bottom: 10px">
                                <?php foreach ($product as $item) : ?>
                                    <div class="col-md-3 item-product bor">
                                        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                                            <img src="<?php echo uploads() ?>/product/<?php echo $item['pro_thumbar'] ?>" class="" width="100%" height="160px">
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
                            <nav class="text-center">
                                <ul class="pagination">
                                    <?php for ($i=1; $i <= $sotrang ; $i++) : ?>
                                        <li class="<?php echo isset($_GET['p']) && $_GET['p'] == $i ? 'active' : '' ?>"><a href="<?php echo $path ?>?id=<?php echo $id ?>&&p=<?php echo $i ?>"><?php echo $i; ?></a></li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        </section>
                    </div>
                </div>                
<?php require_once __DIR__ ."../layouts/footer.php"; ?>