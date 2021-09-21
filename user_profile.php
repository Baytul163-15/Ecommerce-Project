
<?php  ?>

<?php
    session_start();
    include("admin/classes/adminBack.php");
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

    if (isset($_POST['user_login_btn'])) {
        $msg = $obj_clintside->user_login($_POST);
    }

    //
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    if ($userid == null) {
        header('location:user_login.php');
    }

    if (isset($_GET['logoutuser'])) {
        if ($_GET['logoutuser']='logout') {
            $obj_clintside->userLogout();
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
        <div class="container">
            <div class="user_profile">
                <h2>User Profile Page</h2>
            </div>
            <div class="user_info">
                <div class="user_details">
                    <div class="user_pro">
                        <h3>Hello <?php if (isset($username)) { echo strtoupper($username); } ?></h3>
                    </div>
                    <div class="user_pro"><a href="#" class="edit user_pro"><i class="fa fa-user-circle fa-lg" aria-hidden="true">Basic Information</i></a></div>
                    <div class="user_pro"><a href="#" class="edit user_pro"><i class="fa fa-map-marker fa-lg" aria-hidden="true">Address</i></a></div>
                    <div class="user_pro"><a href="#" class="edit user_pro"><i class="fa fa-list fa-lg" aria-hidden="true">Order</i></a></div>
                    <div class="user_pro"><a href="#" class="edit user_pro"><i class="fa fa-user-circle fa-lg" aria-hidden="true">Review</i></a></div>
                    <a href="?logoutuser=logout"><button class="btn btn-success">Logout</button></a>
                </div>
                <div class="history">
                    <!--Cart Table-->
                    <div class="shopping-cart-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h3 class="box-title">Order History</h3>
                                <form class="shopping-cart-form" action="#" method="post">
                                    <table class="shop_table cart-form">
                                        <thead>
                                        <tr>
                                            <th class="product-name">Product Name</th>
                                            <th class="product-price">Total Paid</th>
                                            <th class="product-quantity">Oder Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="cart_item">
                                            <td class="product-thumbnail" data-title="Product Name">
                                                <a class="prd-thumb" href="#">
                                                    <figure><img width="113" height="113" src="assets/images/shippingcart/pr-01.jpg" alt="shipping cart"></figure>
                                                </a>
                                                <a class="prd-name" href="#">National Fresh Fruit</a> 
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                <div class="price price-contain">
                                                    <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                    <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                                </div>
                                            </td>
                                            <td class="product-subtotal" data-title="Total">
                                                Pending
                                            </td>
                                        </tr>
                                        <tr class="cart_item wrap-buttons">
                                            <td class="wrap-btn-control" colspan="4">
                                                <a class="btn back-to-shop">Back to Shop</a>
                                                <button class="btn btn-update" type="submit" disabled>update</button>
                                                <button class="btn btn-clear" type="reset">clear all</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
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