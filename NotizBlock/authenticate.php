<?php

session_start();

$con = mysql_connect("localhost","root","");

if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("db", $con);
$Username = $_POST['username'];
$Password = $_POST['password'];

$sql="SELECT idnumber, userAccess FROM idpasswords WHERE idnumber='" . $Username . "' and idpassword='" . $Password . "'";

$r = mysql_query($sql);

if(!$r) {
   $err=mysql_error();
   print $err;
   exit();
}

$isAuthenticated = false;

while($row = mysql_fetch_array($r))
{
  echo $row['username'];
  $access= $row['userAccess'];
  $isAuthenticated = true;
  
}

if($isAuthenticated)
{
   $_SESSION['userType'] = $access;
   header("Location: index.php");  
}
else
{
    header("Location: login.php"); 
}
mysql_close($con);
?>