<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <?php include 'htmlhead.php'; ?>
    </head>
    <body>
        <div id ="topContentWrap">
            <?php include 'header.php'; ?>
            <br/>
            <form id='register' class="formbox"action='register.php' method='post' accept-charset='UTF-8'>
                <fieldset >
                    <!--<legend ><h2 class="capital">A<span>dd </span> Y<span>uh </span> S<span>elf(lol)(smh @ tara) </span> </h2></legend><br/>-->
					<legend><img src="images/register.png" alt="Register as a user"/></legend>
                    <div id="dimmer">
                        <div id="dimmerText">
                            <input type='hidden' name='submitted' id='submitted' value='1'/>

                            <label for='fname'>
                              <div align="left">First name*:</div>
                            </label>
                            <div align="left">
                              <input type='text' name='fname' id='fname' maxlength="50"/>
                              <br/><br/>
                              
                            </div>
                            <label for='lname'>
                              <div align="left">Last name*:</div>
                            </label>
                            <div align="left">
                              <input type='text' name='lname' id='lname' maxlength="50"/>
                              <br/><br/>
                              
                            </div>
                            <label for='uname'>
                              <div align="left">Username*:</div>
                            </label>
                            <div align="left">
                              <input type='text' name='uname' id='uname' maxlength="50"/>
                              <br/><br/>
                              
                            </div>
                            <label>
                              <div align="left">Department*:</div>
                            </label>
                            <div align="left">
                              <select name="dept" id="select_dept">
                                <option value="">...</option>
                                <option value="compscie">Computer Science</option>
                                <option value="physics">Physics</option>
                              </select>
                              <br/><br/>
                            </div>
                            <label for='email'>
                              <div align="left">Email Address*:</div>
                            </label>
                            <div align="left">
                              <input type='text' name='email' id='email' maxlength="50"/>
                              <br/><br/>
                              
                            </div>
                            <label for='pinfo'>
                              <div align="left">Personal Info:</div>
                            </label>
                            <div align="left">
                              <input type='text' name='pinfo' id='pinfo' maxlength="100"/>
                              <br/><br/>
                              
                            </div>
                            <label for='pwd'>
                              <div align="left">Password*:</div>
                            </label>
                            <div align="left">
                              <input type='password' name='pwd' id='pwd' maxlength="15"/>
                              <br/><br/>
                              
                            </div>
                            <label for='pic'>
                              <div align="left">Upload a picture:</div>
                            </label>
                            <div align="left">
                              <input name='MAX_FILE_SIZE' value='102400' type='hidden'/>
                              <input name='image' accept='image/jpeg' type='file'/><br/><br/>
                              <input type='submit' name='submit' value='submit'/>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
            <?php include 'footer.php'; ?>
        </div>
    </body>

</html>