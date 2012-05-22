<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
	die('Could not connect: ' . mysql_error());
  }

mysql_select_db("notizblock", $con);

$result = mysql_query("SELECT * FROM basicUser WHERE fname=''");
$row = mysql_fetch_array($result);

 session_start();
 $_SESSION['id'] = $row['bUserid'];
 $_SESSION['fname'] = $row['fname'];
 $_SESSION['lname'] = $row['lname'];
 $_SESSION['dept'] = $row['dept'];
 $_SESSION['phone'] = $row['phone'];
 $_SESSION['personalinfo'] = $row['personalinfo'];

mysql_close($con);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
     
    </head>
    <?php  include 'htmlhead.php';
   			include 'header.php'; 
    ?>
	
	<body>
	<form name="user" action="saveuserprofiles.php" method="post">
<table border="0">

	<tr>
		<td>Name:</td>
		<td><label><?= $row['fname']; ?>&nbsp;<?= $row['lname']; ?></label></td>
	</tr>
		<td>Username:</td>
		<td><label><?= $row['username']; ?></label></td>
	</tr>
	<tr>
		<td>Department:</td>
		<td><label><?= $row['dept']; ?></label></td>
	</tr>
	<tr>
		<td>Email Address:</td>
		<td><label><?= $row['email']; ?></label></td>
	</tr>        
	<tr>
		<td>Contact Number:</td>
		<td><label><?= $row['phone']; ?></label></td>
	</tr>
	<tr>
		<td>Personal Info</td>
		<td><label><?= $row['personalinfo']; ?></label></td>
	</tr>
	<tr>
	<td></td>
	<td><INPUT TYPE="submit" id="editbtn" NAME="edit" Value="Edit Contact Information" ></td>

</table>
	</form>
	
	
	<p>
		<a href="addbook.php">Add Book</a>
	</p>
	
	<p>
		<a href="addhouse.php">Add House</a>
	</p>

	
	</body>
</html>
