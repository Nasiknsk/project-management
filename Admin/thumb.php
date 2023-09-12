<?php
	$sname = "localhost";
	$uname = "root";
	$password = "";
	$db_name = "test";

	$conn = mysqli_connect($sname, $uname, $password, $db_name);

	
if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	
	echo "<pre>";
	print_r($_FILES['my_image']);
	echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];

	if ($error === 0) {
		if ($img_size > 12500000) {
			echo "Sorry, your file is too large.";
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("Thumb-", true).'.'.$img_ex_lc;
				$img_upload_path = 'thumb/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "INSERT INTO image(filename)VALUES('$new_img_name')";
				mysqli_query($conn, $sql);
				
				header("Location: mini.php");
			}else {
				echo "You can't upload files of this type";
		      
			}
		}
	}else {
		echo"unknown error occurred!";
		
	}

}else {
	echo "can't upload ";
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="thumb.php" method="post">
		<b> Change Thumbnail  : </b> <input type="file" name="my_image">
		 <input type="submit" name="submit" value="Upload">   
	</form>

</body>
</html>

