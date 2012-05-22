<?php

session_start();

$con = mysql_connect("localhost","root","");
if (!$con)
  {
	die('Could not connect: ' . mysql_error());
  }

mysql_select_db("notizblock", $con);

//$result = mysql_query("SELECT * FROM basicUser WHERE fname=''");
//$row = mysql_fetch_array($result);


//$fna= $_POST['fname'];
//echo $fna;
//mysql_query("UPDATE basicuser SET fname='"+" "+"', lname='"+$_POST['lname']+"', dept='"+$_POST['dept']+"', contact='"+$_POST['phone']+"', personalinfo='"+$_POST['personalinfo']+"' WHERE bUserid='"+$_SESSION['id'] +"'");
//edit me (above)
mysql_close($con);

$test=$_POST[Fname];
echo $test;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

    </head>
    <?php // include 'htmlhead.php'; edit me
   		//	include 'header.php'; 
    ?>
	
	<body>
	<form method="post" action="<?php echo $PHP_SELF;?>">
<table border="0">

	<tr>
		<td>First Name:</td>
		<td><input type="text" name="Fname" maxlength="50" size="40" value=<?= $_SESSION['fname']; ?>></td>
	</tr>
	
	<tr>
		<td>Last Name:</td>
		<td><input type="text" name="lname" maxlength="50" size="40" value=<?= $_SESSION['lname']; ?>></td>
	</tr>
		
	<tr>
		<td>Department:</td>
		<td><input type="text"  name="dept" maxlength="50" size="13" value=<?= $_SESSION['dept']; ?>></td>
	</tr>
	<tr>
		<td>Contact Number:</td>
		<td><input type="text"  name="contact" maxlength="50" size="13" value=<?= $_SESSION['phone']; ?>></td>
	</tr>
	<tr>
		<td>Personal Info</td>
		<td><textarea name="personinfo" rows="4" cols="20" >
		<?= $_SESSION['personalinfo']; ?>
		</textarea></td>
	</tr>
	<tr>
	<td><INPUT TYPE="submit" id="savebtn" NAME="save" Value="Save Changes" onClick=""></td>
	<td><INPUT TYPE="button" id="cancelbtn" NAME="cancel" Value="Cancel Changes" onClick="history.back()"></td>
	</tr>
	
</table>
	</form>
	
		
	</body>
</html>
