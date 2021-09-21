
<?php include("admin/classes/adminBack.php") ?>

<?php
    //Show category and brand list for upload/add product.
    $obj_clintside = new adminBack();
    $ctg_info = $obj_clintside->only_display_publish_category();
	$brand_info = $obj_clintside->only_display_public_brand();

    //category data store in array for reuse in one page many time.
    $ctgData = array();
    $brandData = array();
    while($data = mysqli_fetch_assoc($ctg_info)){
        $ctgDatas[] = $data; 
    }
    //Brand data store in array for reuse in one page many time.
    while($info = mysqli_fetch_assoc($brand_info)){
        $brandDatas[] = $info; 
    }

    //status and id using value pass in adminBack function from Categorywise_product page.
    if (isset($_GET['status'])) {
        $brandId = $_GET['id'];
        if ($_GET['status']== 'brandview') {
            $brandData = $obj_clintside->product_by_brand($brandId);
            $pros = array();
            while($prodatas = mysqli_fetch_assoc($brandData)){
                $pros[] = $prodatas;
            }  
        }
    } 

    //status and id using value pass in adminBack function from Categorywise_product page.
    if (isset($_GET['status'])) {
        $brand_id = $_GET['id'];
        if ($_GET['status']== 'brandview') {
            $brandName = $obj_clintside->display_product_brand_name($brand_id);      
        }
    }
?>


<!DOCTYPE html>
<html class="no-js" lang="en">
    <?php include_once("includes/head.php"); ?>

<body class="biolife-body">
    <?php include_once("includes/preloader.php"); ?>

    <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-03">

        <?php include_once("includes/header-top-nav.php"); ?>
        <?php include_once("includes/header-middle-nav.php"); ?>
        <?php include_once("includes/header-bottom-nav.php"); ?>

    </header>
    <!-- END HEADER -->

    <!-- Page Contain -->
    <div class="page-contain">

        <!-- Main content -->
        <div id="main-content" class="main-content">

            <!--Hero Section-->
            <div class="hero-section hero-background">
                <h1 class="page-title">
                    <?php
                        echo $brandName['brand_name'];
                    ?>
                </h1>
            </div>

            <!--Navigation section-->
            <div class="container">
                <nav class="biolife-nav">
                    <ul>
                        <li class="nav-item"><a href="index-2.html" class="permal-link">Home</a></li>
                        <li class="nav-item"><span class="current-page">
                            <?php 
                                echo $brandName['brand_name'];
                            ?>
                        </span></li>
                    </ul>
                </nav>
            </div>
            <div class="container">
                <div class="page-contain category-page no-sidebar">
        <div class="container">
            <div class="row">

                <!-- Main content -->
                <div id="main-content" class="main-content col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-category grid-style"> 
                        <div class="row">
                            <ul class="products-list">
                                <?php foreach($pros as $pro){ ?>
                                <li class="product-item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="#" class="link-to-product">
                                                <img src="admin/Upload/<?php echo $pro['pdt_img']; ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories"><?php echo $pro['brand_name']; ?></b>
                                            <h4 class="product-title"><a href="#" class="pr-name"><?php echo $pro['pdt_name']; ?></a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol">£</span><?php echo $pro['pdt_price']; ?></span></ins>
                                            </div>
                                            <div class="shipping-info">
                                                <p class="shipping-day">3-Day Shipping</p>
                                                <p class="for-today">Pree Pickup Today</p>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food safety.</p>
                                                <div class="buttons">
                                                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                    <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                    <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="biolife-panigations-block">
                            <ul class="panigation-contain">
                                <li><span class="current-page">1</span></li>
                                <li><a href="#" class="link-page">2</a></li>
                                <li><a href="#" class="link-page">3</a></li>
                                <li><span class="sep">....</span></li>
                                <li><a href="#" class="link-page">20</a></li>
                                <li><a href="#" class="link-page next"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include_once("includes/footer.php"); ?>

    <!--Footer For Mobile-->
    <?php include_once("includes/footer-for-mobile.php"); ?>

    <!-- Mobile Gloval Block -->
    <?php include_once("includes/mobile-gloval-block.php"); ?>

    <!--Quickview Popup-->
    
    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <!-- All Script Link -->
    <?php include_once("includes/script.php"); ?>

</body>

</html>