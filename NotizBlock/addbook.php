<?php

session_start();

require_once('Api.php');

$api = new Api();

if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{    
    $title          = $_REQUEST["title"];
    $author         = $_REQUEST["author"];
    $edition        = $_REQUEST["edition"];
    $publisher      = $_REQUEST["publisher"];
    $publishedDate  = $_REQUEST["publishedDate"];
    $saletype       = $_REQUEST["saleType"];
    $subjectarea    = $_REQUEST["subarea"];
    $condition      = $_REQUEST["condtion"];
    $askingprice    = $_REQUEST["bk_price"];
    $category       = $_REQUEST["category"];        

    $keyword1       = $_REQUEST["keyword1"];
    $keyword2       = $_REQUEST["keyword2"];

    $keywords       = $keyword1 . ',' . $keyword2;

    $image          = null;

    $description = $_REQUEST["description"];

    $uploadtime = 0;
        
    $result = $api->getCurrentUserInfo();

    if($result['result'] == 'SUCCESS')
    {
        $bUserId        = $result['data']['bUserid'];
                
        //= $_REQUEST["MAX_FILE_SIZE"];
        // = $_REQUEST["bkimage"];
        
        $addBookResult = $api->addBook($title, $author, $publisher, $saletype, $publishedDate, $edition, $subjectarea, $condition, 
                         $askingprice, $description, $bUserId, $category, $uploadtime, $keywords, $image);

        var_dump($addBookResult);

        die();

        if($addBookResult['result'] == 'SUCCESS')
        {
            //if a string is returned (admin/basic) then set the session
            header("Location: listbooks.php");
        }
        else
        {    
            //redisplay add book form
        }
    }
    else
    {
        $errors[] = 'You need to be logged in to add a book.';
    }
}
else
{
    $title          = '';
    $author         = '';
    $edition        = '';
    $publisher      = '';
    $publishedDate  = '';
    $saletype       = '';
    $subjectarea    = '';
    $condition      = '';
    $askingprice    = '';
    $category       = '';
    $keyword1       = '';
    $keyword2       = '';

    $image          = null;

    $description    = '';

    $uploadtime     = 0;
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
            <form id='Add Book'  class="formbox" action='addbook.php' method='POST' accept-charset='UTF-8'>

                <fieldset>

                    <!--<legend ><h2 class="capital">A<span>dd </span> <span> a </span> B<span>ook</span></h2></legend><br/>-->
					<legend><img src="images/bk.png" alt="add a book"/></legend>
                    <div id="dimmer">
                        <div id="dimmerText">
                            <input type='hidden' name='submitted' id='submitted' value='1'/>
                            <label for='title' class='need'>Title*:</label>
                            <input type='text' name='title' id='title' maxlength="90" value="<?= $title ?>" /><br/><br/>

                            <label for='author' class='need'>Author*:</label>
                            <input type='text' name='author' id='author' maxlength="90" value="<?= $author ?>" /><br/><br/>

                            <label for='edition' class='need'>Edition</label>
                            <input type='text' name='edition' id='edition' maxlength="5" value="<?= $edition ?>" /><br/><br/>

                            <label for='publisher' class='need'>Publisher</label>
                            <input type='text' name='publisher' id='pub' maxlength="90" value="<?= $publisher ?>" /><br/><br/>

                            <label for='publisher'>Published Date</label>
                            <input type='text' name='publishedDate' id='pub' maxlength="90" value="<?= $publishedDate ?>" /><br/><br/>
                    
                            <label class='need'>Bid/ Direct Sale*:</label>
                            <select name="saleType" id="select_saleType">
                                <option value="">...</option>
                                <option value="bid">Up for Bid!</option>
                                <option value="sale">Direct Sale</option>
                            </select><br/><br/>
                            <label class='need'>Subject Area*:</label>
                            <select name="subarea" id="select_subarea">
                                <option value="">...</option>
                                <option value="computers">Computer Science</option>
                                <option value="physics">Physics</option>
                            </select><br/><br/>
                            <label class='need'>Condition*:</label>
                            <select name="condtion" id="select_condition">
                                <option value="">...</option>
                                <option value="new">Spanking New</option>
                                <option value="new">Mint!</option>
                                <option value="old">Used</option>
                                <option value="refurbished">Refurbished</option>
                            </select><br/><br/>
                            <label class='need'>Asking Price*: $ </label>
                            <input type='text' name='bk_price' value="<?= $askingprice ?>" /><br/><br/>
                            
                            <label for='category'> Category </label>
                            <input type='text' name='category' id='category' maxlength="90" value="<?= $category ?>" /><br/><br/>
                            
                            <label for='key1'> Keyword 1 </label>
                            <input type='text' name='keyword1' id='keyword1' maxlength="10" value="<?= $keyword1 ?>" /><br/><br/> 
                            
                            <label for='key2'> Keyword 2 </label>
                            <input type='text' name='keyword2' id='keyword2' maxlength="10" value="<?= $keyword2 ?>" /><br/><br/> 
                            
                            <label for='description' class='need'>Description:</label><br/>
                            <textarea name="description" cols="32" rows="5" wrap="hard" value="<?= $description ?>" ></textarea><br/><br/>                            
                            
                            <label for='bkimg' class='need'>Upload a picture:</label>
                            <input name='MAX_FILE_SIZE' value='102400' type='hidden'/>
                            <input name='bkimage' accept='bkimage/jpeg' type='file'/><br/><br/>
                            
                            <input type='submit' name='submit' value='Register'/>
                            
                             
                        </div>
                    </div>
                </fieldset>
            </form>




            <?php include 'footer.php'; ?>
        </div>
    </body>

</html>
