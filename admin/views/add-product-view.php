
<?php
	//Show category and brand list for upload/add product.
    $obj_adminback = new adminBack();
    $ctg_info = $obj_adminback->only_display_publish_category();
	$brand_info = $obj_adminback->only_display_public_brand();

	//boject create for product. all data sotr in function.
	if (isset($_POST['pdt_btn'])) {
		$return_msg = $obj_adminback->add_product($_POST);
	}
?>
<div class="">
	<div class="ctg_sub" style="padding-bottom: 15px;">
		<h2>Add Product</h2>
	</div>
	<?php
		if (isset($return_msg)){
			echo $return_msg;
		}
	?>
	<div class="" style="padding-top: 15px;">
		<form class="form" action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="pdt_name">Product Name</label>
				<input type="text" name="pdt_name" class="form-control">
			</div>
			<div class="form-group">
				<label for="pdt_price">Product Price</label>
				<input type="number" name="pdt_price" class="form-control">
			</div>
            <div class="form-group">
				<label for="pdt_des">Product Description</label>
				<textarea class="form-control" name="pdt_des" rows="3"></textarea>
			</div>
            <div class="form-group">
				<label for="pdt_ctg">Product Category</label>
                <select name="pdt_ctg" class="form-control">
					<option>Please select one category</option>
                    <?php while ($pd_ctg = mysqli_fetch_assoc($ctg_info)) { ?>
					<option value="<?php echo $pd_ctg['ctg_id']; ?>"><?php echo $pd_ctg['ctg_name']; ?></option>
                    <?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="pdt_brand">Product Brand</label>
                <select name="pdt_brand" class="form-control">
					<option>Please select one brand</option>
                    <?php while ($pd_brand = mysqli_fetch_assoc($brand_info)) { ?>
					<option value="<?php echo $pd_brand['brand_id']; ?>"><?php echo $pd_brand['brand_name']; ?></option>
                    <?php } ?>
				</select>
			</div>
            <div class="form-group">
				<label for="pdt_img">Product Image</label>
				<input type="file" name="pdt_img" class="form-control">
			</div>
			<div class="form-group">
				<label for="pdt_status">Product Status</label>
				<select name="pdt_status" class="form-control">
					<option value="1">Published</option>
					<option value="0">Unpublished</option>
				</select>
			</div>
			<input type="submit" value="Add Product" name="pdt_btn" class="btn btn-primary btn-block">
		</form>
	</div>
</div>