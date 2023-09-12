 <?php 

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



	 	$sql = mysqli_query($conn, "SELECT srl_No FROM minicourse ORDER BY srl_No DESC LIMIT 1");

			$SNoM = mysqli_fetch_row($sql);

		$a = 0;
?>
	



<html>
    
	<head> 
	<link rel="stylesheet" href="navi.css">
	<link rel="stylesheet" href="mini.css">
	
	</head>
   
    
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
				<a class="active" href="mini.php"> Mini Course</a>
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
				<a href="Miniupload.php"> <img src="images/upload_i.png" height="25px" width="25px"></a>
			</div>	
		</th>
		
		<th width="7.2%" style="background-color:#2568FB;">	
			<div class="navbar">
				<a href="D:\0. Sliate\Assinments\2nd sem\Human\parted\commen user\main.html"><font color="white"><b>LOG OUT</b></font></a>
			</div>	
		</th>
		
		
		<th >
			<div class="topnav">
				<div class="search-container">
					<form action="#">
						<input type="text" placeholder="Search.." name="search">
						<button type="submit"><i>search</i></button>
					</form>
				</div>
			</div>
		</th>
	</tr>
</table>
		  		  


<section>
	<div class="container">
<?php	
		



		$sql = "SELECT DISTINCT srl_No FROM minicourse WHERE deleteNo = '0' ORDER BY srl_No DESC ";
		$result = $conn->query($sql);
		while(($a<$SNoM[0]) && ($row = $result->fetch_assoc())){
			$SNo[0] = $row['srl_No'];

				$sqlN = $conn->query("SELECT Course_Name FROM minicourse where srl_No='$SNo[0]'");
					$data = $sqlN->fetch_assoc();
					

?>
		
				
					<div class="card">
						<div class="content">
							<div class="imgBx">
								<img src="images/mini.PNG">
							</div>
							<div class="contentBx">
								<h3><?php echo $data['Course_Name'] ?><br><span> Description</span></h3>
							</div>
						</div>
						<div class="sci">
							<li>
								<a href='dCourse.php?data= <?php echo "$SNo[0]"?>' name="start">ENROLL</a>
							</li>
						</div>
					</div>
					
<?php	    	

	      	$a++;
    	}
 ?>
 	</div>
  </section>
<?php
	 }
 ?>
	
	
	
			
 </body>
</html>