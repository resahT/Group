<?php

//get recommended items
$recommendedItems = array();

$bookId   = isset($_REQUEST['bookId']) ? $_REQUEST['bookId'] : 0;

$api      = new Api();

$errors   = array();

$userInfoResult = $api->getCurrentUserInfo();

//add a log of the item that is being viewed
if($userInfoResult['result'] == 'SUCCESS')
{
    $bUserid            = $userInfoResult['data']['bUserid'];
    
    $viewedItemResult   = $api->addItemsViewed($bookId, $bUserid);
}

if($userInfoResult['result'] == 'SUCCESS')
{    
    $recommededItemsResult = $api->getRecommendedItems($bUserid, 'book');
    
    if($recommededItemsResult['result'] == 'SUCCESS')
    {
        $recommendedItems = $recommededItemsResult['data'];
    }
}

if(!empty($recommendedItems))
{
?>
        <h3>We think you may like the following books:</h3>

        <table style="border: 1px solid black;">

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