<?php

@session_start();

require_once('Api.php');

$api = new Api();

$api->logout();

$returnAddress = urldecode($_REQUEST['returnTo']);

header("Location: " . $returnAddress);