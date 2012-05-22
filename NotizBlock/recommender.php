<?php

if(!isset($recommendedItems))
{
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

    if(false)
    {
    ?>
            <h3 style="display: none;">We think you may like the following books:</h3>

            <table style="border: 1px solid black; display: none;">

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
}

                    $books = $recommendedItems;
                    
                    
?>
        <br />
        <br />
        <br />  
        <center>
                    <table class="">
                        <thead >
                            <tr>
                                <td colspan="5" style="text-align:center;font-weight:bolder; color: white">We think you may like the following items:</td>
                                
                            </tr>
                        </thead>

                        <tbody>
    <?php                   
                            $totalBooks = count($books);
                            $counter = 0;
                                                        
                            for($i = 0; $i < $totalBooks; $i++)
                            {
                                
                                $rowType = $counter % 2 == 0 ? 'even' : 'odd';
                                
    ?>
                                <tr class="<?= $rowType ?>">
<?php
                                    for($r = 0; $r < 5 && $i < $totalBooks; $i++, $r++)
                                    {
                                        $book = $books[$i];
?>
                                        <td style="text-align: center; padding: 10px;">
                                            <a href="viewbook.php?bookId=<?= $book['itemid'] ?>">
                                                <img style="width: 150px; height: 150px; border: 1px solid #ccc" src="<?= $book['image'] != '' ? $book['image'] : 'images/books.jpg' ?>" alt="<?= $book['title'] ?>" height="42" width="42" /> 
                                                <br />
                                                <?= $book['title'] ?> by <?= $book['author'] ?>
                                                <br/>
                                                <?= $book['askingPrice'] ?> via <?= $book['saleType'] ?>
                                            </a>
                                        </td>
<?php
                                    }
?>
                                    
                                </tr>
        <?php                   
                                $counter++;
                            }
        ?>                    

                        </tbody>
                    </table>
        </center>