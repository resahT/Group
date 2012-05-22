<?php
require_once 'Api.php';

$api = new Api();

//Testing for login

  echo '***********************************************';
  echo '                     USER                       ';
  echo "*********************************************** ";

$result = $api->login('Tbee','resah');
echo var_dump($result)."Login working:";
        
$resultu1 = $api->login('Tbee2','resah');
echo " Login not working : ". var_dump($resultu1);

$resultu2 = $api->registerUser('Resah','Jones' , 'resss01', 'angelbaby@hotmail.com', 5334430, ' hottaz');
echo " register: ". var_dump($resultu2);


  echo '***********************************************';
  echo '                     Book                       ';
  echo "***********************************************\n";
  
  
//$resultb1 = $api->addBook('life', 'Dean','TaraPub','Direct','2009-01-03','1','computing','mint','10',
 //       'computing book for sale','1','book',' 2009-01-03 11:48:50','time,uu','path/to/image');
//var_dump($resultb1);

$resultb2 = $api->getownerBooks('1');
var_dump($resultb2);

//$resultb5 = $api->editbook($itemid, $title, $author, $publisher, $published_date, $edition, $subjectarea, $condition, $saletype, $askingprice, $description);
//var_dump($resultb5;)

$resultb3 = $api->rmbook('8');
 var_dump($resultb3);



