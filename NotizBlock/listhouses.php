<?php

@session_start();

require_once('Api.php');

$house = array();

if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
    //nothing to do here
}
else
{
    $api = new Api();
    
    $response = $api->listItem('house');
    
    $houses    = $response['data'];
}
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
            
            <center>
                
                <div style="display: inline-block; margin: auto;">

                    <div style="text-align: right;"><a style="color: white; text-align: right; font-weight: bold; text-decoration: none;" href="addhouse.php">Add House</a></div>
                    
                    <br />

                    <table class="bookList">
                        <thead>
                            <tr>
                                <th>HOUSE</th>
                                
                            </tr>
                        </thead>

                        <tbody>
    <?php                    
                            
                            $totalHouses = count($houses);
                            $counter = 0;
                                                        
                            for($i = 0; $i < $totalHouses; $i++)
                            {
                                
                                $rowType = $counter % 2 == 0 ? 'even' : 'odd';
                                
    ?>
                                <tr class="<?= $rowType ?>">
<?php
                                    for($r = 0; $r < 5 && $i < $totalHouses; $i++, $r++)
                                    {
                                        $house = $houses[$i];
?>
                                        <td style="text-align: center; padding: 10px;">
                                            <a href="viewhouse.php?houseId=<?= $house['itemid'] ?>">
                                                <img style="width: 150px; height: 150px; border: 1px solid #ccc" src="<?= $house['image'] != '' ? $house['image'] : 'images/paint.png' ?>" alt="<?= $book['title'] ?>" height="42" width="42" /> 
                                                <br /><br />
                                                <?= $house['description'] ?> <br /> <?= $house['askingPrice'] ?>
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

                </div>
                
            </center>
            
            <br/>
            
            <?php include 'footer.php'; ?>
        </div>
    </body>

</html>