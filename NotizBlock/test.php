<?php
require_once 'Api.php';

$api = new Api();

//Testing for login

$result = $api->login('Tbee','resah');
var_dump($result);


$result1 = $api->login('Tbee2','resah');
var_dump($result1);

$result2 = $api->addBook('life', 'Dean','TaraPub','Direct','2/12/2012','1','computing','mint','10','computing book for sale');
var_dump($result2);
