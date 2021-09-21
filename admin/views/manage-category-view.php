<!-- Object create and all data value store in veriable -->
<?php
    $obj_adminback = new adminBack();
    $ctg_data = $obj_adminback->display_category(); //all data value

    //Category publish/unpublis check and update to publish/unpublish.
    if(isset($_GET['status'])){
        $get_id = $_GET['id'];
        if ($_GET['status'] == 'publish') {
            $message = $obj_adminback->publish_category($get_id);
        }elseif($_GET['status'] == 'unpublish'){
            $message = $obj_adminback->unpublish_category($get_id);
        }elseif($_GET['status'] == 'delete'){ //Category delete
            $message = $obj_adminback->delete_category($get_id);
        }
    }
?>


<div class="">
	<div class="ctg_sub" style="padding-bottom: 15px;">
        <h2>Manage Category</h2>
        <?php if (isset($message)) {
            echo "$message";
        } ?>
	</div>
	<div class="" style="padding-top: 15px;">
		<table class="table">
            <thead>
                <tr>
                    <th>Ctg id</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($ctg = mysqli_fetch_assoc($ctg_data)){
                ?>  
                <tr>
                    <td><?php echo $ctg['ctg_id']; ?></td>
                    <td><?php echo $ctg['ctg_name']; ?></td>
                    <td><?php echo $ctg['ctg_des']; ?></td>
                    <td><?php 
                    //Publish/unpublish
                    if($ctg['ctg_status'] == 0){
                        echo "Unpublished";
                    ?>
                    <a class="btn btn-sm btn-success" href="?status=publish&&id=<?php echo $ctg['ctg_id']; ?>">Make Published</a>
                    <?php
                    }else{
                        echo "Published";
                    ?>
                        <a class="btn btn-sm btn-danger" href="?status=unpublish&&id=<?php echo $ctg['ctg_id']; ?>">Make Unpublished</a>
                    <?php
                    }
                    ?></td>
                    <td>
                        <a class="btn btn-primary" href="edit-category.php?status=edit&&id=<?php echo $ctg['ctg_id']; ?>">Edit</a> <!--goto (edit-category-view.php) page-->
                        <a class="btn btn-danger" href="?status=delete&&id=<?php echo $ctg['ctg_id']; ?>">Delete</a>
                    </td>
                </tr>  
                <?php } ?>
            </tbody>
        </table>
	</div>
</div>