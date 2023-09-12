<?php 
 	include 'C:\xampp\htdocs\Project\admin_login.php';
   $servername = "localhost";
   $username = "root";
   $password = "";
   $database = "project_management";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);




		$_SNo = $_GET['data']; 

		$sql= "UPDATE minicourse SET deleteNo ='1' WHERE srl_No = '$_SNo'";
		if (mysqli_query($conn, $sql)) {
		 //echo "Record Deleted successfully";
		 header("location: mini.php");
		  
		} else {
		  echo "Error in Deleting record: " . $conn->error;
		}


?>