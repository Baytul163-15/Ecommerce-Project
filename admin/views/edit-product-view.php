
<?php
    $obj_adminback = new adminBack();
    $ctg_info = $obj_adminback->display_category();
	$brand_info = $obj_adminback->display_brand();
    //Base on id $ edit data catch and compare to DBMS data then store in veriable.
    if (isset($_GET['prostatus'])) {
        $get_id = $_GET['id'];
        if ($_GET['prostatus'] == 'edit') {
            $pdt_info = $obj_adminback->product_edit($get_id);
        }
        //When press update button then data update to insert in database.
        if (isset($_POST['u_pdt_btn'])) {
            $return_msg = $obj_adminback->product_update($_POST); 
        }
    }
?>
<div class="">
	<div class="ctg_sub" style="padding-bottom: 15px;">
		<h2>Edit Category</h2>
	</div>
	<?php
	if (isset($return_msg)) {
		echo $return_msg;
	}
	?>
    <div class="" style="padding-top: 15px;">
		<form class="form" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
				<input hidden type="text" name="u_pdt_id" class="form-control" value="<?php echo $pdt_info['pdt_id']; ?>">
			</div>
			<div class="form-group">
				<label for="u_pdt_name">Product Edit</label>
				<input type="text" name="u_pdt_name" class="form-control" value="<?php echo $pdt_info['pdt_name']; ?>">
			</div>
			<div class="form-group">
				<label for="u_pdt_price">Product Price</label>
				<input type="number" name="u_pdt_price" class="form-control" value="<?php echo $pdt_info['pdt_price']; ?>">
			</div>
            <div class="form-group">
				<label for="u_pdt_des">Product Description</label>
				<input type="text" class="form-control" name="u_pdt_des" value="<?php echo $pdt_info['pdt_des']; ?>">
			</div>
            <div class="form-group">
				<label for="u_pdt_ctg">Product Category</label>
                <select name="u_pdt_ctg" class="form-control">
					<option>Please select one category</option>
                    <?php while ($pd_ctg = mysqli_fetch_assoc($ctg_info)) { ?>
					<option value="<?php echo $pd_ctg['ctg_id']; ?>"><?php echo $pd_ctg['ctg_name']; ?></option>
                    <?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="u_pdt_brand">Product Brand</label>
                <select name="u_pdt_brand" class="form-control">
					<option>Please select one brand</option>
                    <?php while ($pd_brand = mysqli_fetch_assoc($brand_info)) { ?>
					<option value="<?php echo $pd_brand['brand_id']; ?>"><?php echo $pd_brand['brand_name']; ?></option>
                    <?php } ?>
				</select>
			</div>
            <div class="form-group">
				<label for="u_pdt_img">Product Image</label>
				<input type="file" name="u_pdt_img" class="form-control">
			</div>
			<div class="form-group">
				<label for="u_pdt_status">Product Status</label>
				<select name="u_pdt_status" class="form-control">
					<option value="1">Published</option>
					<option value="0">Unpublished</option>
				</select>
			</div>
			<input type="submit" value="Update" name="u_pdt_btn" class="btn btn-primary btn-block">
		</form>
	</div>
</div>