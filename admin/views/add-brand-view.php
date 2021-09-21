
<!-- Catch Add_brand input form data -->
<?php
	$obj_adminback = new adminBack();
	 if (isset($_POST['brand_btn'])) {
	 	//For message show + Data insert object.
	 	$return_message = $obj_adminback->add_brand($_POST);
	}
?>
<div class="">
	<div class="ctg_sub" style="padding-bottom: 15px;">
		<h2>Add Brand</h2>
	</div>
	<div class="" style="padding-top: 15px;">
		<form action="" method="POST">
			<div class="form-group">
				<label for="brand_name">Brand Name</label>
				<input type="text" name="brand_name" class="form-control">
			</div>
			<div class="form-group">
				<label for="brand_des">Brand Description</label>
				<input type="text" name="brand_des" class="form-control">
			</div>
			<div class="form-group">
				<label for="brand_status">Brand Status</label>
				<select name="brand_status" class="form-control">
					<option value="1">Published</option>
					<option value="0">Unpublished</option>
				</select>
			</div>
			<input type="submit" value="Add Brand" name="brand_btn" class="btn btn-primary" style="width:100%;">
			<?php
				if (isset($return_message)) {
					echo $return_message;
				}
			?>
		</form>
	</div>
</div>