<?php

@session_start();

require_once('Api.php');

$api = new Api();

$api->logout();
$returnAddress = urldecode($_REQUEST['returnTo']);
if ($returnAddress!=null){
   header("Location: " . $returnAddress); 
}
else{
    header("Location: "."login.php");
}


