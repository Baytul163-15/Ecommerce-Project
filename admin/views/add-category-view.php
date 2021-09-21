<!-- Catch Add_category input form data -->
<?php
	$obj_adminback = new adminBack();
	if (isset($_POST['ctg_btn'])) {
		//For message show + Data insert object.
		$return_message = $obj_adminback->add_category($_POST);
	}
?>
<div class="">
	<div class="ctg_sub" style="padding-bottom: 15px;">
		<h2>Add Category</h2>
	</div>
	<div class="" style="padding-top: 15px;">
		<form action="" method="POST">
			<div class="form-group">
				<label for="ctg_name">Category Name</label>
				<input type="text" name="ctg_name" class="form-control">
			</div>
			<div class="form-group">
				<label for="ctg_des">Category Description</label>
				<input type="text" name="ctg_des" class="form-control">
			</div>
			<div class="form-group">
				<label for="ctg_status">Category Status</label>
				<select name="ctg_status" class="form-control">
					<option value="1">Published</option>
					<option value="0">Unpublished</option>
				</select>
			</div>
			<input type="submit" value="Add Category" name="ctg_btn" class="btn btn-primary" style="width:100%;">
			<?php
				if (isset($return_message)) {
					echo $return_message;
				}
			?>
		</form>
	</div>
</div>