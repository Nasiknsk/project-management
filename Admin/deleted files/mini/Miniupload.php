<?php

	include 'C:\xampp\htdocs\Project\admin_login.php';
   $servername = "localhost";
   $username = "root";
   $password = "";
   $database = "project_management";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
else{

		if(isset($_POST['submit'])){

			$Admin_Name = $_POST['name'];
			$Admin_ID = $_POST['Lec_Id'];
			$email = $_POST['email'];
	   		$Course_Name = $_POST['CourseName']; 


			$a= 1;

			$sql = mysqli_query($conn, "SELECT * FROM minicourse ORDER BY srl_No DESC LIMIT 1");
			$serial_No = mysqli_fetch_row($sql);
			$serial_No = $serial_No[1] + $a;

		    $countfiles = count($_FILES['myfile']['name']);
		   
			$a= 1;
		    for($i=0;$i<$countfiles;$i++){

		    	$tmpFilePath = $_FILES['myfile']['tmp_name'][$i];

		    	if ($tmpFilePath != ""){
				    //Setup our new file path
				    $newFilePath = "./course/" . $_FILES['myfile']['name'][$i];

				    //Upload the file into the temp dir
	    			if(move_uploaded_file($tmpFilePath, $newFilePath)) {
			        	$filename = $_FILES['myfile']['name'][$i];
			        	$sql = "INSERT INTO minicourse (srl_No,Admin_Name,Admin_ID,email,Course_Name,myfile)VALUES
			        	('$serial_No','$Admin_Name','$Admin_ID','$email','$Course_Name','$filename')";
			
			        	if ($conn->query($sql) === TRUE) {
				     	
						} 
			
			    	}
				}
			}
		}
                

   	$sql = "SELECT * FROM admin where email = '".$_SESSION['email']."' ";
	$result = $con->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	  	$name = $row['Name'];
	  	$email = $row['email'];
	  }
	} 


}


?>




<html>
	<head> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="navi.css">
		<link rel="stylesheet" href="up.css">
		
		
	</head>


<style>
	/* CSS */
<style>
	.button {
	  background-color: #4CAF50; /* Green */
	  border: none;
	  color: white;
	  padding: 26px 42px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 20px;
	  margin: 4px 2px;
	  transition-duration: 0.4s;
	  cursor: pointer;

	}

	.button5 {
	  background-color: #555555;
	  color: white;
	  border: 2px solid #555555;
	  height:40px;
	  width:100px;
	}

	.button5:hover {
	  background-color:  white;
	  color: black;
	}


</style>
</style>












<body>

<!--Navigation Bar -->
<table style="width:100%" border="0" collapse="0">
	<tr  style="height:20px">
		<th  width="1%">
		</th>
		<th  width="5%" align="left">
			<img src="images/logo.png" height="40px" width="40px"></a>
		</th>
		
		<th width="6">	
			<div class="navbar">
				<a href="a_main.html">Home</a>
			</div>	
		</th>
		
		
		
		<th width="9%">
			<div class="navbar">
				<a href="mini.php"> Mini Course</a>
			</div>	
		</th>
		
		<th width="11%">		
			<div class="navbar">
				<a href="ask_the_expert.php"> Ask the Expert </a>
			</div>	
		</th>
		
		<th width="5%">
			<div class="navbar">
				<a href="inbox.html" class="notification">
					<span><img src="images/inbox.png" height="25px" width="25px"></span>
					<span class="badge">0</span>
				</a>
			</div>	
		</th>
		
		<th width="7%">
			<div class="navbar">
				<a class="active" href="Miniupload.php"> <img src="images/upload_i.png" height="25px" width="25px"></a>
			</div>	
		</th>
		
		<th width="7.1%" style="background-color:#2568FB;">	
			<div class="navbar">
				<a href="D:\0. Sliate\Assinments\2nd sem\Human\parted\commen user\main.html"><font color="white"><b>LOG OUT</b></font></a>
			</div>	
		</th>
		
		
		
		<th>
			<div class="topnav">
				<div class="search-container">
					<form action="#">
						<input type="text" placeholder="Search.." name="search">
						<button type="submit" name = "search"><i>search</i></button>
					</form>
				</div>
			</div>
		</th>
	</tr>
</table>


<br><br>



<!-- From -->
<div class="login-box">
  <h2>Upload Mini Course</h2>
  <form action = "Miniupload.php" method = "post"  enctype="multipart/form-data">

    <div class="user-box">
      <input type="text" name="name" required="" value = <?php echo $name; ?>>
      <label>Name</label>
    </div>

    <div class="user-box">
      <input type="text" name="Lec_Id" required="" >
      <label><font size="2.5px">ID </font></label>
    </div>
	
	<div class="user-box">
      <input type="email" name="email" required="" value = <?php echo $email; ?>>
      <label>Email</label>
    </div>

	<div class="user-box">
      <input type="text" name="CourseName" required="">
      <label>Course Name</label>
    </div>

	<br>

	<div class="bn17"> 
		<label>Select Course Videos</label><br>
	  <input type="file" name="myfile[]" id="file" multiple value = "Select Course files">
	</div>
	
	

	<br><br>
	
		<button type="submit" class="button button5" name="submit"><b>UPLOAD</b></button>
	
  </form>
</div>


</body>
</html>



