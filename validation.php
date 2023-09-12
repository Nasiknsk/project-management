<?php
	session_start();

	$con = mysqli_connect('localhost','root', '');
	
	mysqli_select_db($con,'project_management');
	
	
	//Registration
if(isset($_POST["signup"]))

		{

					$name = $_POST['name'];
					$nic = $_POST['nicnum'];
					$r_num = $_POST['reg_num'];
					$email = $_POST['email'];
					$pass = $_POST['pass'];
					$c_pass = $_POST['c_pass'];

					$reg_number = strtoupper($r_num);

		$a = " SELECT * FROM student WHERE reg_num = '$reg_number' AND nic_num = '$nic'";
					
			$result1 = mysqli_query($con, $a);

			$num1 = mysqli_num_rows($result1);
					
			if($num1 != 1){
						//echo '<script>alert("Reg Number And NIC Number Doesnt match")</script>';
						//echo "Reg Number And NIC Number Doesnt match";	
						echo '<script type="text/javascript">'; 
						echo 'alert("Reg Number And NIC Number Doesnt match or you may be blocked by Admin");'; 
						echo 'window.location.href = "newSignin.html";';
						echo '</script>';
				}

			else{

					$s = " select * from member where reg_num = '$reg_number'";
					$result = mysqli_query($con, $s);
					
					$num = mysqli_num_rows($result);


					 if ($_POST["pass"] != $_POST["c_pass"]) 
					 	{   
					 		echo '<script type="text/javascript">'; 
							echo 'alert("Passwords Doesnt match or you may be blocked by Admin");'; 
							echo 'window.location.href = "newSignin.html";';
							echo '</script>';

					 		//echo"Passwords Doesnt match";
					 	} 

					 else 
					 	{  


							if($num == 1){
								echo '<script type="text/javascript">'; 
								echo 'alert("You Already Registerd! You can Login or you may be blocked by Admin");'; 
								echo 'window.location.href = "newSignin.html";';
								echo '</script>';

								//echo"You Already Registerd!";
								
							}
							else{
									//getting corse and year from reg number
									$myString = "$reg_number";

									$strArray = explode('/',$myString);
									$corse_Name = $strArray[1];
									$year = $strArray[2];
									$type = $strArray[3];
									//echo $year;


									if($type == 'F'){
										$type = 'FULL TIME';
									}else{
										$type = 'PART TIME';
									}

										
									if($corse_Name == 'IT'){ $course_id = 4;}
									else if($corse_Name == 'M'){$course_id = 2;}
									else if($corse_Name == 'A'){$course_id = 3;}
									else if($corse_Name == 'BA'){$course_id = 6;}
									else if($corse_Name == 'THM'){$course_id = 5;}
									else if($corse_Name == 'E'){$course_id = 1;}

									//$pwd = md5('$pass');

									$pass = md5($_POST['pass']);
									$reg="INSERT INTO member(name,nicnum,reg_num,course_id,batch,Type,email,pass)VALUES('$name','$nic','$reg_number', '$course_id','$year','$type','$email', '$pass')";
									
									mysqli_query($con, $reg);
									
									header("location: m_main.php");
									//header("location: ask_the_expert.html");
									
							}
						
						} 
						
					$sql = $con->query("SELECT name FROM member where reg_num = '$reg_number'");
					$data = $sql->fetch_assoc();

					$_SESSION['username'] = $data['name'];
					
			
			
					$sql1 = $con->query("SELECT id FROM member where reg_num = '$reg_number'");
					$data1 = $sql1->fetch_assoc();
											
					$_SESSION['userId'] = $data1['id'];

					$_SESSION['reg_num'] = $reg_number;

				}
				
		}
	//login
if(isset($_POST["Login"]))
		{
			$r_num = $_POST['reg_num'];
			$pass = $_POST['pass'];
			$reg_number = strtoupper($r_num);
		
			
			$sql = $con->query("SELECT name FROM member where reg_num = '$reg_number'");
            $data = $sql->fetch_assoc();

			$_SESSION['username'] = $data['name'];
			$_SESSION['reg_num'] = $reg_number;
			
			$sql1 = $con->query("SELECT id FROM member where reg_num = '$reg_number'");
            $data1 = $sql1->fetch_assoc();
					
			$_SESSION['userId'] = $data1['id'];

			
			$pass = md5($_POST['pass']);

			$s = " SELECT * FROM member WHERE reg_num = '$reg_number' AND pass= '$pass' AND block = '0'";
			$result = mysqli_query($con, $s);

			$c_name = " select name from member where reg_num = '$reg_number'";
			$result1 = mysqli_query($con, $c_name);
			
			$num = mysqli_num_rows($result);
			
			if($num == 1){
			
				//header("location: ask.html");
				//header("location: index.php");
				header("location: m_main.php");
				//echo $_SESSION['userID'] = $data['name'];
				//echo "loged in";
				
			}
			else{
					echo '<script type="text/javascript">'; 
					echo 'alert("incorrect index or Password! or you may be blocked by Admin");'; 
					echo 'window.location.href = "newSignin.html";';
					echo '</script>';

					//echo "error in login";
			}
			
		}
		

?>


