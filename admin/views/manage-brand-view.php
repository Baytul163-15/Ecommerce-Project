<!-- Object create and all data value store in veriable -->
<?php
    $obj_adminback = new adminBack();
    $brand_data = $obj_adminback->display_brand(); //all data value

    //Category publish/unpublis check and update to publish/unpublish.
    if(isset($_GET['status'])){
        $get_id = $_GET['id'];
        if ($_GET['status'] == 'publish') {
            $message = $obj_adminback->publish_brand($get_id);
        }elseif($_GET['status'] == 'unpublish'){
            $message = $obj_adminback->unpublish_brand($get_id);
        }elseif($_GET['status'] == 'delete'){ //Category delete
            $message = $obj_adminback->delete_brand($get_id);
        }
    }
?>


<div class="">
	<div class="brand_sub" style="padding-bottom: 15px;">
        <h2>Manage Brand</h2>
        <?php if (isset($message)) {
            echo "$message";
        } ?>
	</div>
	<div class="" style="padding-top: 15px;">
		<table class="table">
            <thead>
                <tr>
                    <th>Brand id</th>
                    <th>Brand Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($brand = mysqli_fetch_assoc($brand_data)){
                ?>  
                <tr>
                    <td><?php echo $brand['brand_id']; ?></td>
                    <td><?php echo $brand['brand_name']; ?></td>
                    <td><?php echo $brand['brand_des']; ?></td>
                    <td><?php 
                    //Publish/unpublish
                    if($brand['brand_status'] == 0){
                        echo "Unpublished";
                    ?>
                    <a class="btn btn-sm btn-success" href="?status=publish&&id=<?php echo $brand['brand_id']; ?>">Make Published</a>
                    <?php
                    }else{
                        echo "Published";
                    ?>
                        <a class="btn btn-sm btn-danger" href="?status=unpublish&&id=<?php echo $brand['brand_id']; ?>">Make Unpublished</a>
                    <?php
                    }
                    ?></td>
                    <td>
                        <a class="btn btn-primary" href="edit-brand.php?status=edit&&id=<?php echo $brand['brand_id']; ?>">Edit</a> <!--goto (edit-category-view.php) page-->
                        <a class="btn btn-danger" href="?status=delete&&id=<?php echo $brand['brand_id']; ?>">Delete</a>
                    </td>
                </tr>  
                <?php } ?>
            </tbody>
        </table>
	</div>
</div>