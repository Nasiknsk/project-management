<?php

session_start();

	if(isset($_POST["Login"]))
		{
	
			$con = mysqli_connect('localhost','root', '');
			
			mysqli_select_db($con,'project_management');
			
			
			$reg_number = $_POST['reg_num'];

			$pass = $_POST['pass'];

			//$pwd = md5('$pass');
			$pass = md5($_POST['pass']);

			$s = " select * from member where reg_num = '$reg_number' && pass= '$pass'";
			
			$result = mysqli_query($con, $s);

			$num = mysqli_num_rows($result);
			
			if($num == 1){
				
				header("location: Member/m_main.html");
				
			}
			else{
					
					echo "error in login";
			}
			/*if($num == 1){
				
				header("location: Member/m_main.html");
				
			}
			else{
					
					echo "error in login";
			}*/
		}
	else
		echo "Didn't press login button";



?>