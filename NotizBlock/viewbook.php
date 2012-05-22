<?php

@session_start();

require_once('Api.php');

$bookId   = $_REQUEST['bookId'];

$api      = new Api();

$errors   = array();

$response       = $api->getItem($bookId,'book');

$userInfoResult = $api->getCurrentUserInfo();

//add a log of the item that is being viewed
if($userInfoResult['result'] == 'SUCCESS')
{
    $bUserid            = $userInfoResult['data']['bUserid'];
    
    $viewedItemResult   = $api->addItemsViewed($bookId, $bUserid);
}

//get recommended items
$recommendedItems = array();

if($userInfoResult['result'] == 'SUCCESS')
{    
    $recommededItemsResult = $api->getRecommendedItems($bUserid, 'book', $bookId);
    
    if($recommededItemsResult['result'] == 'SUCCESS')
    {
        $recommendedItems = $recommededItemsResult['data'];
    }
}

if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{    
    if(isset($_REQUEST['buyNow']) && $_REQUEST['buyNow'] == 'buyNow')
    {       
        $result         = $api->getCurrentUserInfo();
        
        if($result['result'] == 'SUCCESS')
        {        
            $bUserid        = $result['data']['bUserid'];

            $buyResult      = $api->buyItem($bUserid, $bookId, 'book', $response['data']['askingPrice']);

            if($buyResult['result'] == 'SUCCESS')
            {
                header("Location: listbooks.php?status=itemPurchased");
                die();
            }
            else
            {
                $errors[] = 'Item could not be purchased.';
            }
        }
        else
        {
            $errors[] = 'Cannot purchase item because you are not logged in.';
        }
    }
    else
    {
        $result = $api->getCurrentUserInfo();

        if($result['result'] == 'SUCCESS')
        {
            $newBidAmount   = $_REQUEST['newBidAmount'];

            $bUserid        = $result['data']['bUserid'];

            $addBidResponse       = $api->addBid($bookId, $bUserid, $newBidAmount);        
        }
        else
        {
            $errors[] = 'Unable to add bid because you are not logged in.';
        }
    }
}
else
{
    //nothing to do here
}




$bidResponse    = $api->viewBidHistory(2, $bookId);

$maxBidResponse = $api->getMaxBidAmount($bookId);

$maxBidAmount   = $maxBidResponse['result'] == 'SUCCESS' ? $maxBidResponse['data']['maxBidAmount'] : 0;

$book           = $response['data'];

$askingPrice    = $response['data']['askingPrice'];

    
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
            
            <div style=" text-align:center;background:dimgrey; ">
                
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
<?php 
                        if(strtoupper($book['saleType']) == 'BIDDING')
                        {
?>                       
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
<?php
                        }
                        else
                        {
?>
                            <form method="POST">
                                <table>
                                    <tr>
                                        <td><fieldset><legend>Price:</legend>$<?= $askingPrice ?></fieldset></td>
                                    </tr>
                                    <tr>
                                        <td><input type="hidden" value="buyNow" name="buyNow" /><input type="submit"  value="Buy Now!" /></td>
                                    </tr>
                                </table>
                            </form>
<?php
                        }
?>
                        </td>
                    </tr>
                    
                </table>
<?php
        if(!empty($recommendedItems))
        {
?>
                <h3>We think you may like the following books:</h3>
                
                <table>
                    
<?php
                        foreach($recommendedItems as $item)
                        {
?>
                            <tr><td><a href="viewbook.php?bookId=<?= $item['itemid'] ?>"> <?= $item['title'] . ' by ' . $item['author'] ?></a></td></tr>
<?php                        
                        }
?>
                    
                </table>
<?php
        }
?>
            </div>

            <br/>
            
            <?php include 'footer.php'; ?>
        </div>
    </body>

</html>