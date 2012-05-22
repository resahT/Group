<?php

session_start();

require_once('Api.php');

$houseId   = $_REQUEST['houseId'];

$api      = new Api();

$errors   = array();

$userInfoResult = $api->getCurrentUserInfo();

if($userInfoResult['result'] == 'SUCCESS')
{
    $bUserid            = $userInfoResult['data']['bUserid'];
    
    $viewedItemResult   = $api->addItemsViewed($houseId, $bUserid);
}

if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{    
    $result = $api->getCurrentUserInfo();
    
    if($result['result'] == 'SUCCESS')
    {
        $newBidAmount   = $_REQUEST['newBidAmount'];
        
        $bUserid        = $result['data']['bUserid'];
        
        $response       = $api->addBid($houseId, $bUserid, $newBidAmount);        
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

$houses          = array();

$response       = $api->getItem($houseId,'house');

$bidResponse    = $api->viewBidHistory(2, $houseId);

$maxBidResponse = $api->getMaxBidAmount($houseId);

$maxBidAmount   = $maxBidResponse['data']['maxBidAmount'];

$house           = $response['data'];

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

                                <tr><td class="heading">Image:       </td><td><?= $house['image'] ?></td></tr>
                                <tr><td class="heading">Bedroom:     </td><td><?= $house['bedrooms'] ?></td></tr>
                                <tr><td class="heading">Bathroom:    </td><td><?= $house['bathrooms'] ?></td></tr>
                                <tr><td class="heading">Facilities:  </td><td><?= $house['facilities'] ?></td></tr>
                                <tr><td class="heading">Location:    </td><td><?= $house['locatedNear'] ?></td></tr>
                                <tr><td class="heading">Description: </td><td><?= $house['description'] ?></td></tr>

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