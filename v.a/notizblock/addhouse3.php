<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <?php include 'htmlhead.php'; ?>
    </head>
    <body>
        <div id ="topContentWrap">
            <?php include 'header.php'; ?>
            <br/>
            <form id='addhouse' class="formbox"action='addhouse.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                    <!--<legend ><h2 class="capital">R<span>egister </span>L<span>iving</span>S<span>pace</span></h2></legend>-->
					<legend><img src="images/adh.png" alt="Register LivingSpace"/></legend>
                    <div id="dimmer">
                        <div id="dimmerText">
                            <input type='hidden' name='submitted' id='submitted' value='1'/>
                            <label for='bedrooms' class='need'>bedrooms* : </label>
                            <input type='text' name='bedrooms' id='bedrooms' maxlength="3"/><br/><br/>

                            <label for='bedrooms'class='need'>bathrooms* : </label>
                            <input type='text' name='bathrooms' id='bathrooms' maxlength="3"/><br/><br/>

                            <label class='need'>Facilities*:</label>
                            <select name="facilities" id="select_facilities">
                                <option value="">...</option>
                                <option value="shared">Shared Facilities</option>
                                <option value="single">Single Flat</option>
                            </select><br/><br/>

                            <label for='location' class='need'>Located Near : </label>
                            <input type='text' name='location' id='location' maxlength="30"/><br/><br/>

                            <label class='need'>Asking Price* : $ </label>
                            <input type='text' name='bk_price'/><br/><br/>
                            <label for='description' class='need'>Description : </label><br/>
                            <textarea name='description' cols="32" rows="5" wrap="hard"></textarea><br/><br/>
                            <label for='bkimg' class='need'>Upload a picture : </label>
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