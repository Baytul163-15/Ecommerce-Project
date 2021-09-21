
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

    //
    if (isset($_POST['user_register_btn'])) {
        $msg = $obj_clintside->user_register($_POST);
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
                    <h2>User Registration Page</h2>
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
                            <form action="" name="frm-register" method="POST">
                                <p class="form-row">
                                    <label for="username">Username:<span class="requite">*</span></label>
                                    <input type="text" id="fid-name" name="username" value="" class="txt-input">
                                </p>
                                <p class="form-row">
                                    <label for="user_firstname">First Name:<span class="requite">*</span></label>
                                    <input type="text" id="fid-name" name="user_firstname" value="" class="txt-input">
                                </p>
                                <p class="form-row">
                                    <label for="user_lastname">Last Name:<span class="requite">*</span></label>
                                    <input type="text" id="fid-name" name="user_lastname" value="" class="txt-input">
                                </p>
                                <p class="form-row">
                                    <label for="useremail">Email Address:<span class="requite">*</span></label>
                                    <input type="email" id="fid-name" name="useremail" value="" class="txt-input">
                                </p>
                                <p class="form-row">
                                    <label for="user_password">Password:<span class="requite">*</span></label>
                                    <input type="password" id="fid-pass" name="user_password" value="" class="txt-input">
                                </p>
                                <p class="form-row">
                                    <label for="user_mobile">Mobile Number:<span class="requite">*</span></label>
                                    <input type="number" id="fid-pass" name="user_mobile" value="" class="txt-input">
                                </p>
                                <input type="hidden" name="user_roles" value="5">
                                <input class="btn btn-submit btn-bold btn-block" type="submit" value="Register" name="user_register_btn">                                
                            </form>
                            <br><br>
                        </div>
                    </div>

                    <!--Go to Register form-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="register-in-container">
                            <div class="intro">
                                <h4 class="box-title">Already Registered?</h4>
                                <p class="sub-title">Login to access your profile.</p>
                                <ul class="lis">
                                    <li>Check out faster</li>
                                    <li>Save multiple shipping anddesses</li>
                                    <li>Access your order history</li>
                                    <li>Track new orders</li>
                                    <li>Save items to your Wishlist</li>
                                </ul>
                                <a href="user_login.php" class="btn btn-bold">Login to account</a>
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