<?php

session_start();

require_once('Api.php');

$bookId   = $_REQUEST['bookId'];

$api      = new Api();

$errors   = array();

if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{    
    $result = $api->getCurrentUserInfo();
    
    if($result['result'] == 'SUCCESS')
    {
        $newBidAmount   = $_REQUEST['newBidAmount'];
        var_dump($result);die();
        $bUserid        = $result['data']['bUserid'];
        
        $response       = $api->addBid($bookId, $bUserid, $newBidAmount);
        
    }
    else
    {
        $errors[] = 'Unable to add bid because you are not logged in.';
    }
    
}
else
{
    //nothing to do here
}

$books          = array();

$response       = $api->getBook($bookId);

$bidResponse    = $api->viewBidHistory(2, $bookId);

$maxBidResponse = $api->getMaxBidAmount($bookId);

$maxBidAmount   = $maxBidResponse['data']['maxBidAmount'];

$book           = $response['data'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <?php include 'htmlhead.php'; ?>
    </head>
    <body>
        <div id ="topContentWrap">
            <?php include 'header.php'; ?>
            
            <br/>
            
            <div style="background: #fff;">
                
                    <ul class="errorMessages">
<?php
                    foreach($errors as $error)
                    {
?>
                        <li><?= $error; ?></li>
<?php
                    }
?>
                    </ul>    
            
                <table>
                    <tr>
                        <td>
                            <table class="viewDetails">

                                <tr><td class="heading">Title: </td><td><?= $book['title'] ?></td></tr>
                                <tr><td class="heading">Author: </td><td><?= $book['author'] ?></td></tr>
                                <tr><td class="heading">Publisher: </td><td><?= $book['publisher'] ?></td></tr>
                                <tr><td class="heading">Year: </td><td><?= $book['pubYear'] ?></td></tr>
                                <tr><td class="heading">Edition: </td><td><?= $book['edition'] ?></td></tr>
                                <tr><td class="heading">Subject Area: </td><td><?= $book['subarea'] ?></td></tr>
                                <tr><td class="heading">Condition: </td><td><?= $book['cond'] ?></td></tr>
                                <tr><td class="heading">Description: </td><td><?= $book['description'] ?></td></tr>

                            </table>
                        </td>
                        
                        <td>
                            <form method="POST">
                                <table>
                                    <tr>
                                        <td colspan="3"><fieldset><legend>Max Bid:</legend>$<?= $maxBidAmount ?></fieldset></td>
                                    </tr>
                                    <tr>
                                        <td>New Bid:</td><td><input name="newBidAmount" type="text" /></td><td><input type="submit" value="Bid!" /></td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                    
                </table>
                
                
                
            </div>

            <br/>
            
            <?php include 'footer.php'; ?>
        </div>
    </body>

</html>