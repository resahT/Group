<?php
require_once 'Api.php';

$api = new Api();

//Testing for login

$result = $api->login('Tbee','resah');
var_dump($result);


$result1 = $api->login('Tbee2','resah');
var_dump($result1);

$result2 = $api->addBook('life', 'Dean','TaraPub','Direct','2009-01-03','1','computing','mint','10',
        'computing book for sale','1','book',' 2009-01-03 11:48:50','time,uu','path/to/image');
var_dump($result2);

$result3 = $api->getownerBooks('1');
var_dump($result3);