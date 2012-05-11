<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <?php include 'htmlhead.php'; ?>

    </head>
    <body>
        <div id ="topContentWrap">
            <?php include 'header.php'; ?>
            <br/>
            <form id='Add Book'  class="formbox" action='addbook.php' method='post' accept-charset='UTF-8'>

                <fieldset>

                    <legend ><h2 class="capital">A<span>dd </span> <span> a </span> B<span>ook</span></h2></legend><br/>
                    <div id="dimmer">
                        <div id="dimmerText">
                            <input type='hidden' name='submitted' id='submitted' value='1'/>
                            <label for='title' class='need'>Title*:</label>
                            <input type='text' name='title' id='title' maxlength="90"/><br/><br/>

                            <label for='author' class='need'>Author*:</label>
                            <input type='text' name='author' id='author' maxlength="90"/><br/><br/>

                            <label for='edition' class='need'>Edition</label>
                            <input type='text' name='edition' id='edition' maxlength="5"/><br/><br/>

                            <label for='publisher' class='need'>Publisher</label>
                            <input type='text' name='publisher' id='pub' maxlength="90"/><br/><br/>

                            <label for='publisher'>Publisher Date</label>
                            <input type='text' name='publisher' id='pub' maxlength="90"/><br/><br/>
                    
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
                                <option value="refurbished">Refurbised</option>
                            </select><br/><br/>
                            <label class='need'>Asking Price*: $ </label>
                            <input type='text' name='bk_price'/><br/><br/>
                            
                            <label for='category'> Category </label>
                            <input type='text' name='category' id='category' maxlength="90"/><br/><br/>
                            
                            <label for='key1'> Keyword 1 </label>
                            <input type='text' name='keyword1' id='keyword1' maxlength="10"/><br/><br/> 
                            
                            <label for='key2'> Keyword 2 </label>
                            <input type='text' name='keyword2' id='keyword2' maxlength="10"/><br/><br/> 
                            
                            <label for='description' class='need'>Description:</label><br/>
                            <textarea name='description' cols="32" rows="5" wrap="hard"></textarea><br/><br/>
                            
                            
                            <label for='bkimg' class='need'>Upload a picture:</label>
                            <input name='MAX_FILE_SIZE' value='102400' type='hidden'/>
                            <input name='bkimage' accept='bkimage/jpeg' type='file'/><br/><br/>
                            
                            <input type='submit' name='submit' value='submit'/>
                            
                             
                        </div>
                    </div>
                </fieldset>
            </form>




            <?php include 'footer.php'; ?>
        </div>
    </body>

</html>
