<?php

@session_start();

require_once('Api.php');

$books = array();

if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
    //nothing to do here
}
else
{
    $api = new Api();
    
    $response = $api->listItem('book');
    
    $books    = $response['data'];
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

                    <div style="text-align: right;"><a style="color: white; text-align: right; font-weight: bold; text-decoration: none;" href="addbook.php">Add Book</a></div>
                    
                    <br />

                    <table class="bookList">
                        <thead >
                            <tr>
                                <td style="font-size:large">Books</td>
                                
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
                                    for($r = 0; $r < 3 && $i < $totalBooks; $i++, $r++)
                                    {
                                        $book = $books[$i];
?>
                                        <td style="text-align: center; padding: 10px;">
                                            <a href="viewbook.php?bookId=<?= $book['itemid'] ?>">
                                                <img style="width: 200px; height: 200px; border: 1px solid #ccc" src="<?= $book['image'] != '' ? $book['image'] : 'images/books.jpg' ?>" alt="<?= $book['title'] ?>" height="42" width="42" /> 
                                                <br />
                                                <?= $book['title'] ?> by <?= $book['author'] ?>
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