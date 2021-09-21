<?php
$obj_adminback = new adminBack();
//Base on id $ edit data catch and compare to DBMS data then store in veriable.
if (isset($_GET['status'])) {
    $get_id = $_GET['id'];
    if ($_GET['status'] == 'edit') {
        $return_info = $obj_adminback->category_edit($get_id);
    }
    //When press update button then data update to insert in database.
    if (isset($_POST['u_ctg_btn'])) {
        $return_msg = $obj_adminback->category_update($_POST); 
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
		<form action="" method="POST">
        	<div class="form-group">
				<input hidden type="text" name="u_ctg_id" class="form-control" value="<?php echo $return_info['ctg_id']; ?>">
			</div>
			<div class="form-group">
				<label for="u_ctg_name">Category Name</label>
				<input type="text" name="u_ctg_name" class="form-control" value="<?php echo $return_info['ctg_name']; ?>">
			</div>
			<div class="form-group">
				<label for="u_ctg_des">Category Description</label>
				<input type="text" name="u_ctg_des" class="form-control" value="<?php echo $return_info['ctg_des']; ?>">
			</div>
			<input type="submit" value="Update" name="u_ctg_btn" class="btn btn-primary" style="width:100%;">
			<?php
				if (isset($return_message)) {
					echo $return_message;
				}
			?>
		</form>
	</div>
</div>