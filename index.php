
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

            <!--Block 01: Main Slide-->
            <?php include_once("includes/block-slider.php"); ?>

            <!--Block 02: Banners-->
            <?php include_once("includes/banners.php"); ?>

            <!--Block 03: Product Tabs-->
            <?php include_once("includes/related-product-first.php"); ?>

            <!--Block 04: Banner Promotion 01-->
            

            <!--Block 05: Banner promotion 02-->
            

            <!--Block 06: Products-->
            <div class="Product-box sm-margin-top-96px">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-6">
                            <!-- Deals Of The Days -->
                            <?php include_once("includes/dealsof_the_day.php"); ?>
                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-6">
                            <!-- Advance Product Box -->
                            <?php include_once("includes/advance-product-box.php"); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!--Block 07: Brands-->
            <?php include_once("includes/home-brand.php"); ?>

            <!--Block 08: Blog Posts-->
            

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