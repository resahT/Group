<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <?php include 'htmlhead.php'; ?>

    </head>
    <body>
        <div id ="topContentWrap">
            <?php include 'header.php'; ?>
            <br/>
            <div id="formContainer">
            <form id='Add Book'  class="formbox" action='addbook.php' method='post' accept-charset='UTF-8'>

                <fieldset>

                    <legend ><h2 class="capital">A<span>dd </span> <span> a </span> B<span>ook</span></h2></legend><br/>
                    
                        <input type='hidden' name='submitted' id='submitted' value='1'/>
                        <label for='title'>Title*:</label>
                        <input type='text' name='title' id='title' class='need'  maxlength="90"/><br/><br/>

                        <label for='author'>Author*:</label>
                        <input type='text' name='author' id='author' class='need' maxlength="90"/><br/><br/>

                        <label for='edition'>Edition</label>
                        <input type='text' name='edition' id='edition' class='need' maxlength="5"/><br/><br/>

                        <label for='publisher'>Publisher</label>
                        <input type='text' name='publisher' id='pub' class='need' maxlength="90"/><br/><br/>

                        <label>Bid/ Direct Sale*:</label>
                        <select name="saleType" id="select_saleType">
                            <option value="" class='need'>...</option>
                            <option value="bid">Up for Bid!</option>
                            <option value="sale">Direct Sale</option>
                        </select><br/><br/>
                        <label>Subject Area*:</label>
                        <select name="subarea" id="select_subarea">
                            <option value="">...</option>
                            <option value="computers">Computer Science</option>
                            <option value="physics">Physics</option>
                        </select><br/><br/>
                        <label>Condition*:</label>
                        <select name="condtion" id="select_condition">
                            <option value="">...</option>
                            <option value="new">Mint!</option>
                            <option value="old">Used</option>
                            <option value="refurbished">Refurbised</option>
                        </select><br/><br/>
                        <label>Asking Price*: $ </label>
                        <input type='text' name='bk_price'/><br/><br/>
                        <label for='description'>Description:</label><br/>
                        <textarea name='description' cols="32" rows="5" wrap="hard"></textarea><br/><br/>
                        <label for='bkimg'>Upload a picture:</label>
                        <input name='MAX_FILE_SIZE' value='102400' type='hidden'/>
                        <input name='bkimage' accept='bkimage/jpeg' type='file'/><br/><br/>
                        <input type='submit' name='submit' value='submit'/>
                  </fieldset>
                </form>
                <div>
                <div id="dimmer"> </div>
            


            <?php include 'footer.php'; ?>
        </div>
    </body>

</html>
