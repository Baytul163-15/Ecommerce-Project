
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

    //For userLogin
    if (isset($_POST['user_login_btn'])) {
        $msg = $obj_clintside->user_login($_POST);
    }

    //For 
    if (isset($_SESSION['userid'])) {
        $userId = $_SESSION['userid'];
        if ($userId) {
            header('location:user_profile.php');
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
            <div class="container">
                <div class="text-center">
                    <h2>User Login Page</h2>
                </div>
                <?php
                    if (isset($msg)) { 
                        echo $msg;
                    }
                ?>
                <div class="row">
                    <!--Form Sign In-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="signin-container">
                            <form action="#" name="frm-login" method="post">
                                <p class="form-row">
                                    <label for="useremail">Email Address:<span class="requite">*</span></label>
                                    <input type="email" id="fid-name" name="useremail" value="" class="txt-input">
                                </p>
                                <p class="form-row">
                                    <label for="user_password">Password:<span class="requite">*</span></label>
                                    <input type="password" id="fid-pass" name="user_password" value="" class="txt-input">
                                </p>
                                <br>
                                <input class="btn btn-submit btn-bold btn-block" type="submit" value="Login" name="user_login_btn"> <br>
                                <a href="user_password_recover.php" class="link-to-help">Forgot your password</a>
                            </form>
                        </div>
                    </div>

                    <!--Go to Register form-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="register-in-container">
                            <div class="intro">
                                <h4 class="box-title">New Customer?</h4>
                                <p class="sub-title">Create an account with us and you’ll be able to:</p>
                                <ul class="lis">
                                    <li>Check out faster</li>
                                    <li>Save multiple shipping anddesses</li>
                                    <li>Access your order history</li>
                                    <li>Track new orders</li>
                                    <li>Save items to your Wishlist</li>
                                </ul>
                                <a href="user_registration.php" class="btn btn-bold">Create an account</a>
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