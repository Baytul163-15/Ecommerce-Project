

<?php
    $obj_adminback = new adminBack();
    $product_data = $obj_adminback->display_product();

    if(isset($_GET['status'])){
        $get_id = $_GET['id'];
        if ($_GET['status'] == 'publish') {
            $message = $obj_adminback->publish_product($get_id);
        }elseif($_GET['status'] == 'unpublish'){
            $message = $obj_adminback->unpublish_product($get_id);
        }
    }

    if (isset($_GET['prostatus'])) {
        $proid = $_GET['id'];
        if ($_GET['prostatus'] == 'delete') {
            $msg = $obj_adminback->delete_product($proid);
        }
    }
?>

<div class="">
	<div class="ctg_sub" style="padding-bottom: 15px;">
        <h2>Manage Product</h2>    
	</div>
	<div class="" style="padding-top: 15px;">
		<table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>image</th>
                    <th>Description</th>
                    <th>Brand Name</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($product = mysqli_fetch_assoc($product_data)){
                ?>  
                    <tr>
                        <td><?php echo $product['pdt_id']; ?></td>
                        <td><?php echo $obj_adminback->textShorten($product['pdt_name'], 30); ?></td>
                        <td><?php echo $product['pdt_price']; ?></td>
                        <td><img style="height:100px;" src="Upload/<?php echo $product['pdt_img']; ?>"></td>
                        <td><?php echo $obj_adminback->textShorten($product['pdt_des'], 40); ?></td>
                        <td><?php echo $product['brand_name']; ?></td>
                        <td><?php echo $product['ctg_name']; ?></td>
                        <td><?php 
                        //Publish/unpublish
                        if($product['pdt_status'] == 0){
                            echo "Unpublished";
                        ?>
                        <a class="btn btn-sm btn-success" href="?status=publish&&id=<?php echo $product['pdt_id']; ?>">Make Published</a>
                        <?php
                        }else{
                            echo "Published";
                        ?>
                            <a class="btn btn-sm btn-danger" href="?status=unpublish&&id=<?php echo $product['pdt_id']; ?>">Make Unpublished</a>
                        <?php
                        }
                        ?></td>
                        <td>
                            <a class="btn btn-primary" href="edit-product.php?prostatus=edit&&id=<?php echo $product['pdt_id']; ?>">Edit</a> 
                            <a class="btn btn-danger" href="?prostatus=delete&&id=<?php echo $product['pdt_id']; ?>">Delete</a>
                        </td>
                    </tr>  
                <?php } ?>
            </tbody>
        </table>
	</div>
</div>