<?php
$host = 'localhost';
$username = 'root';
$pass = '';
$conn = 'project_management';

$conn = new mysqli($host,$username,$pass,$conn);

if ($conn->connect_error) {
	 die("Connection Failed". $conn->connect_error);
}

?>