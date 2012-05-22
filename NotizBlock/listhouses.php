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
                                <td>Image</td>
                                <td>Bedroom</td>
                                <td>Bathroom</td>
                                <td>Facilities</td>
                                <td>Location</td>
                                <td>Description</td>
                                
                            </tr>
                        </thead>

                        <tbody>
    <?php                    
                            $counter = 0;

                            foreach($houses as $house)
                            {
                                $rowType = $counter % 2 == 0 ? 'even' : 'odd';
    ?>
                                <tr class="<?= $rowType ?>">
                                    <td><a href="viewhouse.php?houseId=<?= $house['itemid'] ?>"><?= $house['image'] ?></a></td>
                                    <td><a href="viewhouse.php?houseId=<?= $house['itemid'] ?>"><?= $house['bedrooms'] ?></a></td>
                                    <td><a href="viewhouse.php?houseId=<?= $house['itemid'] ?>"><?= $house['bathrooms'] ?></a></td>
                                    <td><a href="viewhouse.php?houseId=<?= $house['itemid'] ?>"><?= $house['facilities'] ?></a></td>
                                    <td><a href="viewhouse.php?houseId=<?= $house['itemid'] ?>"><?= $house['locatedNear'] ?></a></td>
                                    <td><a href="viewhouse.php?houseId=<?= $house['itemid'] ?>"><?= $house['description'] ?></a></td>
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