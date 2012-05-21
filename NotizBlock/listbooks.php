<?php

session_start();

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
                        <thead>
                            <tr>
                                <td>Title</td>
                                <td>Author</td>
                                <td>Publisher</td>
                                <td>Year</td>
                                <td>Edition</td>
                                <td>Subject Area</td>
                                <td>Condition</td>
                                <td>Description</td>
                            </tr>
                        </thead>

                        <tbody>
    <?php                    
                            $counter = 0;

                            foreach($books as $book)
                            {
                                $rowType = $counter % 2 == 0 ? 'even' : 'odd';
    ?>
                                <tr class="<?= $rowType ?>">
                                    <td><a href="viewbook.php?bookId=<?= $book['itemid'] ?>"><?= $book['title'] ?></a></td>
                                    <td><a href="viewbook.php?bookId=<?= $book['itemid'] ?>"><?= $book['author'] ?></a></td>
                                    <td><a href="viewbook.php?bookId=<?= $book['itemid'] ?>"><?= $book['publisher'] ?></a></td>
                                    <td><a href="viewbook.php?bookId=<?= $book['itemid'] ?>"><?= $book['pubYear'] ?></a></td>
                                    <td><a href="viewbook.php?bookId=<?= $book['itemid'] ?>"><?= $book['edition'] ?></a></td>
                                    <td><a href="viewbook.php?bookId=<?= $book['itemid'] ?>"><?= $book['subarea'] ?></a></td>
                                    <td><a href="viewbook.php?bookId=<?= $book['itemid'] ?>"><?= $book['cond'] ?></a></td>
                                    <td><a href="viewbook.php?bookId=<?= $book['itemid'] ?>"><?= $book['description'] ?></a></td>
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