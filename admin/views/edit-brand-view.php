<?php
$obj_adminback = new adminBack();
//Base on id $ edit data catch and compare to DBMS data then store in veriable.
if (isset($_GET['status'])) {
    $get_id = $_GET['id'];
    if ($_GET['status'] == 'edit') {
        $return_info = $obj_adminback->brand_edit($get_id);
    }
    //When press update button then data update to insert in database.
    if (isset($_POST['u_brand_btn'])) {
        $return_msg = $obj_adminback->brand_update($_POST); 
    }
}
?>

<div class="">
	<div class="brand_sub" style="padding-bottom: 15px;">
		<h2>Edit Category</h2>
	</div>
	<?php
	if (isset($return_msg)) {
		echo $return_msg;
	}
	?>
	<div class="" style="padding-top: 15px;">
		<form action="" method="POST">
        <div class="form-group">
				<input hidden type="text" name="u_brand_id" class="form-control" value="<?php echo $return_info['brand_id']; ?>">
			</div>
			<div class="form-group">
				<label for="u_brand_name">Brand Name</label>
				<input type="text" name="u_brand_name" class="form-control" value="<?php echo $return_info['brand_name']; ?>">
			</div>
			<div class="form-group">
				<label for="u_brand_des">Category Description</label>
				<input type="text" name="u_brand_des" class="form-control" value="<?php echo $return_info['brand_des']; ?>">
			</div>
			<input type="submit" value="Update" name="u_brand_btn" class="btn btn-primary" style="width:100%;">
			<?php
				if (isset($return_message)) {
					echo $return_message;
				}
			?>
		</form>
	</div>
</div>