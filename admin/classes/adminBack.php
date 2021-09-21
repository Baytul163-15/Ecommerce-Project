<?php
	
	class adminBack
	{
		private $conn;
		
		public function __construct()
		{
			$dbhost = "localhost";
			$dbuser = "root";
			$dbpass = "";
			$dbname = "ecommerce";

			$this->conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

			if (!$this->conn) {
				die("Database connection error !");
			}
		}

		//Admin login System Data fetch.
		function admin_login($data){
			$admin_email = $data['admin_email'];
			$admin_pass  = md5($data['admin_pass']);

			$query = "SELECT * FROM adminlog WHERE admin_email = '$admin_email' AND admin_pass= '$admin_pass'";

			if (mysqli_query($this->conn, $query)) {
				$result = mysqli_query($this->conn, $query);
				$admin_info = mysqli_fetch_assoc($result);

				if ($admin_info) {
					session_start();
					$_SESSION['id'] = $admin_info['id'];
					$_SESSION['adminEmail'] = $admin_info['admin_email'];
					$_SESSION['adminPass'] = $admin_info['admin_pass'];
					header('location:dashboard.php');
				}else{
					$errmsg = "Your username or password is incorrect!";
					return $errmsg;
				}
			}
		}

		//Admin logout System 
		function adminLogout(){
			unset($_SESSION['id']);
			unset($_SESSION['adminEmail']);
			unset($_SESSION['adminPass']);
			header('location:index.php');
		}

		/** Start Brand Section **/
		//Catch Add_brand data to push veriable from (add-brand-view.php).
		function add_brand($data){
			$brand_name  = $data['brand_name'];
			$brand_des   = $data['brand_des'];
			$brand_status=$data['brand_status'];

			$query = "INSERT INTO brand(brand_name,brand_des,brand_status) VALUE('$brand_name','$brand_des','$brand_status')";
			if (mysqli_query($this->conn, $query)) {
				$message = "Brand Addes Successfully.";
				return $message;
			}else{
				$message = "Brand Not Added!";
				return $message;
			}
		}

		//Display all Category from DBMS in (manage_brand.php) page.
		function display_brand(){     
			$query = "SELECT * FROM brand";
			if(mysqli_query($this->conn, $query)){
				$return_brand = mysqli_query($this->conn, $query);
				return $return_brand;
			}
		}

		//Display all Publish brand from DBMS in (manage_brand.php) page.
		function only_display_public_brand(){     
			$query = "SELECT * FROM brand WHERE brand_status=1";
			if(mysqli_query($this->conn, $query)){
				$return_brand = mysqli_query($this->conn, $query);
				return $return_brand;
			}
		}

		//If your product in stoke then you publish the product.
		function publish_brand($id){
			$query = "UPDATE brand SET brand_status=1 WHERE brand_id=$id";
			if (mysqli_query($this->conn, $query)) {
				$message = "Brand unpublish successfully.";
				return $message;
			}else{
				$message = "Brand not unpublish! Some Problem found.";
				return $message;
			}
		}

		//If your product out of stoke then you unpublish the product.
		function unpublish_brand($id){
			$query = "UPDATE brand SET brand_status=0 WHERE brand_id=$id";
			if (mysqli_query($this->conn, $query)) {
				$message = "Brand publish successfully.";
				return $message;
			}else{
				$message = "Brand not publish! Some Problem found.";
				return $message;
			}
		}

		//When your product not abailable in stoke then you delete the product.
		function delete_brand($id){
			$query = "DELETE FROM brand WHERE brand_id=$id";
			if (mysqli_query($this->conn, $query)) {
				$message = "Brand deleted successfully.";
				return $message;
			}else{
				$message = "Brand not deleted! Some Problem found.";
				return $message;
			}
		}

		//Data get for edit-brand.
		function brand_edit($id){
			$query = "SELECT * FROM brand WHERE brand_id=$id";
			if (mysqli_query($this->conn, $query)) {
				$brand_info = mysqli_query($this->conn, $query);
				$brand_info = mysqli_fetch_assoc($brand_info);
				return $brand_info;
			}
		}

		//Data update for edit-brand pourpose.
		function brand_update($received_data){
			$brand_name = $received_data['u_brand_name'];
			$brand_des = $received_data['u_brand_des'];
			$brand_id = $received_data['u_brand_id'];

			$query = "UPDATE brand SET brand_name='$brand_name', brand_des='$brand_des' WHERE brand_id=$brand_id ";
			if (mysqli_query($this->conn, $query)) {
				$return_message = "Brand Updated Successfully.";
				return $return_message;
			}
		}
		/** End Brand Section **/

		/** Start Category Section **/
		//Catch Add_category data to push veriable from (add-categoty-view.php).
		function add_category($data){
			$ctg_name  = $data['ctg_name'];
			$ctg_des   = $data['ctg_des'];
			$ctg_status=$data['ctg_status'];

			$query = "INSERT INTO category(ctg_name,ctg_des,ctg_status) VALUE('$ctg_name','$ctg_des','$ctg_status')";
			if (mysqli_query($this->conn, $query)) {
				$message = "Category Addes Successfully.";
				return $message;
			}else{
				$message = "Category Not Added!";
				return $message;
			}
		}

		//Display all Category from DBMS in (manage_category.php) page.
		function display_category(){
			$query = "SELECT * FROM category";
			if(mysqli_query($this->conn, $query)){
				$return_ctg = mysqli_query($this->conn, $query);
				return $return_ctg;
			}
		}

		//Display all Category from DBMS in (manage_category.php) page.
		function only_display_publish_category(){
			$query = "SELECT * FROM category WHERE ctg_status=1";
			if(mysqli_query($this->conn, $query)){
				$return_ctg = mysqli_query($this->conn, $query);
				return $return_ctg;
			}
		}

		//If your product in stoke then you publish the product.
		function publish_category($id){
			$query = "UPDATE category SET ctg_status=1 WHERE ctg_id=$id";
			if (mysqli_query($this->conn, $query)) {
				$message = "Category unpublish successfully.";
				return $message;
			}else{
				$message = "Category not unpublish! Some Problem found.";
				return $message;
			}
		}

		//If your product out of stoke then you unpublish the product.
		function unpublish_category($id){
			$query = "UPDATE category SET ctg_status=0 WHERE ctg_id=$id";
			if (mysqli_query($this->conn, $query)) {
				$message = "Category publish successfully.";
				return $message;
			}else{
				$message = "Category not publish! Some Problem found.";
				return $message;
			}
		}

		//When your product not abailable in stoke then you delete the product.
		function delete_category($id){
			$query = "DELETE FROM category WHERE ctg_id=$id";
			if (mysqli_query($this->conn, $query)) {
				$message = "Category deleted successfully.";
				return $message;
			}else{
				$message = "Category not deleted! Some Problem found.";
				return $message;
			}
		}

		//Data get for edit-category.
		function category_edit($id){
			$query = "SELECT * FROM category WHERE ctg_id=$id";
			if (mysqli_query($this->conn, $query)) {
				$category_info = mysqli_query($this->conn, $query);
				$cat_info = mysqli_fetch_assoc($category_info);
				return $cat_info;
			}
		}

		//Data update for edit-category pourpose.
		function category_update($received_data){
			$ctg_name = $received_data['u_ctg_name'];
			$ctg_des = $received_data['u_ctg_des'];
			$ctg_id = $received_data['u_ctg_id'];

			$query = "UPDATE category SET ctg_name='$ctg_name', ctg_des='$ctg_des' WHERE ctg_id=$ctg_id ";
			if (mysqli_query($this->conn, $query)) {
				$return_message = "Category Updated Successfully.";
				return $return_message;
			}
		}
		/** End Category Section **/

		/** Start Product Section **/
		//function create for add_product. all data sotr in function and pass data.

		function add_product($pdt_data){
			$pdt_name  = $pdt_data['pdt_name'];
			$pdt_price = $pdt_data['pdt_price'];
			$pdt_des   = $pdt_data['pdt_des'];
			$pdt_ctg   = $pdt_data['pdt_ctg'];
			$pdt_brand = $pdt_data['pdt_brand'];
			$pdt_img_name   = $_FILES['pdt_img']['name'];
			$pdt_img_size   = $_FILES['pdt_img']['size'];
			$pdt_temp_name  = $_FILES['pdt_img']['tmp_name'];
			$pdt_ext = pathinfo($pdt_img_name, PATHINFO_EXTENSION);
			$pdt_status= $pdt_data['pdt_status']; 
			if ($pdt_ext == 'jpeg' or $pdt_ext == 'png' or $pdt_ext == 'jpg') {
				if ($pdt_img_size <= 2097152) {
					$query = "INSERT INTO product(pdt_name,pdt_price,pdt_des,pdt_ctg,pdt_brand,pdt_img,pdt_status) 
					VALUE('$pdt_name',$pdt_price,'$pdt_des','$pdt_ctg','$pdt_brand','$pdt_img_name','$pdt_status')";
					if (mysqli_query($this->conn, $query)) {
						move_uploaded_file($pdt_temp_name, 'Upload/'.$pdt_img_name);
						$msg = "Product Added Successfully.";
						return $msg;
					}
				}else{
					$msg = "Your image should be less or equal 2MB!";
					return $msg;
				}
			}else{
				$msg = "Your file is not valid! please upload JPG or PNG file";
				return $msg;
			}
		}


		// function display_product(){
		// 	$query = "SELECT p.*, c.ctg_name, b.brand_name
		// 			FROM product as p, category as c, brand as b
		// 			WHERE p.pdt_ctg = c.ctg_id AND p.pdt_brand = b.brand_id ORDER BY p.pdt_id DESC";
		// 	if (mysqli_query($this->conn, $query)) {
		// 		$product = mysqli_query($this->conn, $query);
		// 		return $product;
		// 	}
		// }

		//view function form product_info view table data pass to manage product-product-view.
		function display_product(){
			$query = "SELECT * FROM product_info";
			if (mysqli_query($this->conn, $query)) {
				$product = mysqli_query($this->conn, $query);
		 		return $product;
			}
		}

		//textShorten code.
		public function textShorten($text, $limit = 400){
			$text = $text. " ";
			$text = substr($text, 0, $limit);
			$text = substr($text, 0, strrpos($text, ' '));
			$text = $text.".....";
			return $text;
		}

		//If your product in stoke then you publish the product.
		function publish_product($id){
			$query = "UPDATE product SET pdt_status=1 WHERE pdt_id=$id";
			if (mysqli_query($this->conn, $query)) {
				$message = "Product unpublish successfully.";
				return $message;
			}else{
				$message = "Product not unpublish! Some Problem found.";
				return $message;
			}
		}

		//If your product out of stoke then you unpublish the product.
		function unpublish_product($id){
			$query = "UPDATE product SET pdt_status=0 WHERE pdt_id=$id";
			if (mysqli_query($this->conn, $query)) {
				$message = "Product publish successfully.";
				return $message;
			}else{
				$message = "Product not publish! Some Problem found.";
				return $message;
			}
		}

		function delete_product($data){
			$query = "DELETE FROM product WHERE pdt_id=$data";
			if (mysqli_query($this->conn, $query)) {
				$message = "Product deleted successfully.";
				return $message;
			}else{
				$message = "Product not deleted! Some Problem found.";
				return $message;
			}
		}

		//If your product
		function product_edit($data){
			$query = "SELECT * FROM product_info WHERE pdt_id=$data";
			if (mysqli_query($this->conn, $query)) {
				$pro_info = mysqli_query($this->conn, $query);
				$get_pro = mysqli_fetch_assoc($pro_info);
				return $get_pro;
			}
		}

		//product Update: 
		function product_update($id){
			$pdt_id = $id['u_pdt_id'];
			$pdt_name  = $id['u_pdt_name'];
			$pdt_price = $id['u_pdt_price'];
			$pdt_des   = $id['u_pdt_des'];
			$pdt_ctg   = $id['u_pdt_ctg'];
			$pdt_brand = $id['u_pdt_brand'];
			$pdt_img_name   = $_FILES['u_pdt_img']['name'];
			$pdt_img_size   = $_FILES['u_pdt_img']['size'];
			$pdt_temp_name  = $_FILES['u_pdt_img']['tmp_name'];
			$pdt_ext = pathinfo($pdt_img_name, PATHINFO_EXTENSION);
			$pdt_status= $id['u_pdt_status']; 
			if ($pdt_ext == 'jpeg' or $pdt_ext == 'png' or $pdt_ext == 'jpg') {
				if ($pdt_img_size <= 2097152) {
					$query = "UPDATE product SET 
					pdt_name='$pdt_name',
					pdt_price = '$pdt_price',
					pdt_des = '$pdt_des',
					pdt_ctg = '$pdt_ctg',
					pdt_brand = '$pdt_brand',
					pdt_img = '$pdt_img_name',
					pdt_status = '$pdt_status' WHERE pdt_id =$pdt_id";
					if (mysqli_query($this->conn, $query)) {
						move_uploaded_file($pdt_temp_name, 'Upload/'.$pdt_img_name);
						$msg = "Product Updated Successfully.";
						return $msg;
					}
				}else{
					$msg = "Your image should be less or equal 2MB!";
					return $msg;
				}
			}else{
				$msg = "Your file is not valid! please upload JPG or PNG file";
				return $msg;
			}
		}
		/** End Product Section **/

		/******* Cluient side section *******/

		//Category: Function using for data compare and get in database to categorywise_product page.
		function product_by_ctg($data){
			$query = "SELECT * FROM product_info WHERE ctg_id=$data";
			if (mysqli_query($this->conn, $query)) {
				$catproinfo = mysqli_query($this->conn, $query);
				return $catproinfo;
			}
		}

		//Brand: Function using for data compare and get in database to categorywise_product page.
		function product_by_brand($data){
			$query = "SELECT * FROM product_info WHERE brand_id=$data";
			if (mysqli_query($this->conn, $query)) {
				$brandproinfo = mysqli_query($this->conn, $query);
				return $brandproinfo;
			}
		}

		//single_Product: Function using for data compare and get in database to single_product page.
		function display_single_product($id){
			$query = "SELECT * FROM product_info WHERE pdt_id=$id";
			if (mysqli_query($this->conn, $query)) {
				$brandproinfo = mysqli_query($this->conn, $query);
				return $brandproinfo;
			}
		}

		//single_Product: Related product show
		function display_related_product($data){
			$query = "SELECT * FROM product_info WHERE ctg_id=$data AND pdt_status=1 ORDER BY pdt_id DESC LIMIT 4";
			if (mysqli_query($this->conn, $query)) {
				$brandproinfo = mysqli_query($this->conn, $query);
				return $brandproinfo;
			}
		}

		function display_product_category_name($data){
			$query = "SELECT * FROM product_info WHERE ctg_id=$data";
			if (mysqli_query($this->conn, $query)) {
				$brandproinfo = mysqli_query($this->conn, $query);
				$ctg = mysqli_fetch_assoc($brandproinfo);
				return $ctg;
			}
		}

		function display_product_brand_name($data){
			$query = "SELECT * FROM product_info WHERE brand_id=$data";
			if (mysqli_query($this->conn, $query)) {
				$brandproinfo = mysqli_query($this->conn, $query);
				$brand = mysqli_fetch_assoc($brandproinfo);
				return $brand;
			}
		}

		//come from user register page.
		function user_register($data){
			$username  = $data['username'];
			$firstname = $data['user_firstname'];
			$lastname  = $data['user_lastname'];
			$email     = $data['useremail'];
			$password  = md5($data['user_password']);
			$mobilenum = $data['user_mobile'];
			$userrole  = $data['user_roles'];

			$get_user_data = "SELECT * FROM user_reg WHERE user_name='$username' or user_email='$email'";
			$send_data = mysqli_query($this->conn, $get_user_data);
			$row = mysqli_num_rows($send_data);

			if ($row==1) {
				$msg = "This Username and Email Already Exist !";
				return $msg;
			}else{
				if (strlen($mobilenum) < 11 or strlen($mobilenum) > 11 ) {
					$msg = "Your mobile Number Shhould Not Be Less Than 11 or Grater Than 11 Digit";
					return $msg;
				}else{
					$query = "INSERT INTO user_reg(user_name,user_firstname,user_lastname,user_email,user_password,user_moblie,user_roles) 
						VALUE('$username','$firstname','$lastname','$email','$password','$mobilenum','$userrole')";
					if (mysqli_query($this->conn, $query)) {
						$msg = "Your account successfully registered.";
						return $msg;
					}
				}
			}		
		}

		//User login System Data fetch.
		function user_login($data){
			$user_email = $data['useremail'];
			$user_pass  = md5($data['user_password']);

			$query = "SELECT * FROM user_reg WHERE user_email = '$user_email' AND user_password= '$user_pass'";

			if (mysqli_query($this->conn, $query)) {
				$result = mysqli_query($this->conn, $query);
				$user_info = mysqli_fetch_assoc($result);

				if ($user_info) {
					header('location:user_profile.php');
					session_start();
					$_SESSION['userid'] = $user_info['user_id'];
					$_SESSION['useremail'] = $user_info['user_email'];
					$_SESSION['user_pass'] = $user_info['user_password'];
					$_SESSION['username'] = $user_info['user_name'];
				}else{
					$errmsg = "Your username or password is incorrect!";
					return $errmsg;
				}
			}
		}

		//User logout System 
		function userLogout(){
			unset($_SESSION['userid']);
			unset($_SESSION['useremail']);
			unset($_SESSION['user_pass']);
			unset($_SESSION['username']);
			header('location:user_login.php');
		}


		function all_product(){
			$query = "SELECT * FROM product_info WHERE pdt_status=1";
			if (mysqli_query($this->conn, $query)) {
				$product = mysqli_query($this->conn, $query);
		 		return $product;
			}
		}













	}
?>