<?php
include 'C:\xampp\htdocs\Project\Member\miniup.php';
session_start();


$RegNo1 = $_SESSION['regNum'];


$query = "SELECT * FROM projects where RegNo ='$RegNo1'";
	$result = $conn->query($query);

$i=1;
while($row = $result->fetch_assoc()) 
{

?>
<table border="4" align="center">
<tr>
<td> Name &emsp;&emsp;</td>
<td><?php echo $row["Name"]; ?></td>&emsp;
</tr>
<tr>
<td>Register Number &emsp;&emsp;</td>
<td><?php echo $row["RegNo"]; ?></td>&emsp;

</tr>
<tr>
<td>Email id &emsp;&emsp;</td>
<td><?php echo $row["Email"]; ?></td>&emsp;

</tr>
<tr>
<td><a href="proj/<?php echo $row['Files'] ?>" target="_blank">view file</a></td>
<td><?php echo $row["Files"]; ?></td>&emsp;

</tr>
</table>
<?php
$i++;

}
?>
</table>
</body>
</html> 