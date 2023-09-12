<?php
	session_start();

	if(isset($_POST['signup']))
		{


			$con = mysqli_connect('localhost','root', '');
			mysqli_select_db($con,'project_management');
			

					$name = $_POST['name'];
					$nic = $_POST['nicnum'];
					$reg_number = $_POST['reg_num'];
					$email = $_POST['email'];
					$pass = $_POST['pass'];
					$c_pass = $_POST['c_pass'];


		$a = " select * from student where reg_num = '$reg_number' && nic_num= '$nic'";
					
			$result1 = mysqli_query($con, $a);

			$num1 = mysqli_num_rows($result1);
					
			if($num1 != 1){
						
						echo "Reg Number And NIC Number Doesnt match";	
				}

			else{

					$s = " select * from member where reg_num = '$reg_number'";
					$result = mysqli_query($con, $s);
					
					$num = mysqli_num_rows($result);


					 if ($_POST["pass"] != $_POST["c_pass"]) 
					 	{   
					 		echo"Passwords Doesnt match";
					 	} 

					 else 
					 	{  


							if($num == 1){
								echo"You Already Registerd!";
								
							}
							else{
									//$pwd = md5('$pass');
									$pass = md5($_POST['pass']);
									$reg="insert into member(name,nicnum,reg_num,email,pass)values('$name','$nic','$reg_number','$email', '$pass')";
									
									/*$hashed = hash(sha512, $pass);
									$reg="insert into member(name,nicnum,reg_num,course,email,pass)values('$name','$nic','$reg_number','$course','$email', '$hashed')";*/
									mysqli_query($con, $reg);
									header("location: Member/m_main.html");
									//echo"registerd";
							}
						
						} 
				}
				
		}
?>