
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

    //Add_to_cart: when press addtocart button then this product information pass to addtocart page table.
    if (isset($_POST['addtocart'])) {
        if (isset($_SESSION['cart'])) {
            $produycts_name = array_column($_SESSION['cart'], 'pdt_name');
            if (in_array($_POST['pdt_name'], $produycts_name)) {
                echo "
                    <script>
                        alert('This product already added !');
                    </script>
                ";
            }else{
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count]=array(
                    'pdt_name' => $_POST['pdt_name'],
                    'pdt_price' => $_POST['pdt_price'],
                    'pdt_img' => $_POST['pdt_img'],
                    'quantity'=> 1
                );
            }
        }else{
            $_SESSION['cart'][0]=array(
                'pdt_name' => $_POST['pdt_name'],
                'pdt_price' => $_POST['pdt_price'],
                'pdt_img' => $_POST['pdt_img'],
                'quantity'=> 1
            ); 
        }
    }

    //Add_to_cart: when
    if (isset($_POST['remove_product'])) {
        foreach($_SESSION['cart'] as $key=>$value){
            if ($value['pdt_name']== $_POST['remove_pdt_name']) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
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
            <br><br><br><br>
                <!--Cart Table-->
                <div class="shopping-cart-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="box-title">Your cart items</h3>
                            <form class="shopping-cart-form" action="#" method="post">
                                <table class="shop_table cart-form">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product Name</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Action</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if (isset($_SESSION['cart'])) {
                                                $subtotal = 0;
                                                $total_product = 0;
                                                foreach($_SESSION['cart'] as $key=>$value) { 
                                                    $subtotal = $subtotal + $value['pdt_price'];
                                                    $total_product++;
                                        ?>
                                            <tr class="cart_item">
                                                <td class="product-thumbnail" data-title="Product Name">
                                                    <a class="prd-thumb" href="#">
                                                        <figure><img width="113" height="113" src="admin/Upload/<?php echo $value['pdt_img']; ?>" alt="shipping cart"></figure>
                                                    </a>
                                                    <a class="prd-name" href="#"><?php echo $value['pdt_name']; ?></a>
                                                    <!-- <div class="action">
                                                        <form action="" method="POST">
                                                            <a href="#" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <input type="hidden" name="remove_pdt_name" value="<?php echo $value['pdt_name']; ?>">
                                                            <a class="remove" type="submit" value="remove product" name="remove_product"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                        </form>
                                                    </div> -->
                                                </td>
                                                <td class="product-price" data-title="Price">
                                                    <div class="price price-contain">
                                                        <ins><span class="price-amount"><span class="currencySymbol">£</span><?php echo $value['pdt_price']; ?></span></ins>
                                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                                    </div>
                                                </td>
                                                <td class="product-quantity" data-title="Quantity">
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="remove_pdt_name" value="<?php echo $value['pdt_name']; ?>">  
                                                        <input type="submit" class="btn btn-danger" value="remove product" name="remove_product">
                                                    </form>
                                                </td>
                                                <td class="product-subtotal" data-title="Total">
                                                    <div class="price price-contain">
                                                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } }else{
                                            echo "Product Table are empty !";
                                        } ?>
                                        <tr class="cart_item wrap-buttons">
                                            <td class="wrap-btn-control" colspan="4">
                                                <a href="add_to_cart.php" class="btn back-to-shop">Back to Shop</a>
                                                <button class="btn btn-update" type="submit" disabled>update</button>
                                                <button class="btn btn-clear" type="reset">clear all</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div class="shpcart-subtotal-block">
                                <div class="subtotal-line">
                                    <b class="stt-name">Subtotal <span class="sub">(<?php echo $total_product; ?> Item)</span></b>
                                    <span class="stt-price">£ <?php echo $subtotal; ?></span>
                                </div>
                                <div class="subtotal-line">
                                    <b class="stt-name">Shipping</b>
                                    <span class="stt-price">£0.00</span>
                                </div>
                                <div class="tax-fee">
                                    <p class="title">Est. Taxes & Fees</p>
                                    <p class="desc">Based on 56789</p>
                                </div>
                                <div class="btn-checkout">
                                    <a href="#" class="btn checkout">Check out</a>
                                </div>
                                <div class="biolife-progress-bar">
                                    <table>
                                        <tr>
                                            <td class="first-position">
                                                <span class="index">$0</span>
                                            </td>
                                            <td class="mid-position">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="last-position">
                                                <span class="index">$99</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="pickup-info"><b>Free Pickup</b> is available as soon as today More about shipping and pickup</p>
                            </div>
                        </div>
                    </div>
                </div>
            <br><br><br><br>
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