<?php

@session_start();

require_once('Api.php');

$errors = array();

if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
    $fname              = mysql_real_escape_string($_REQUEST['fname']);
    $lname              = mysql_real_escape_string($_REQUEST['lname']); 
    $username           = mysql_real_escape_string($_REQUEST['username']); 
    $password           = mysql_real_escape_string($_REQUEST['password']); 
    $dept               = mysql_real_escape_string($_REQUEST['dept']); 
    $email              = mysql_real_escape_string($_REQUEST['email']); 
    $phone              = mysql_real_escape_string($_REQUEST['phone']); 
    $dateofRegistry     = date('Y-m-d H:i:s'); 
    $personalinfo       = mysql_real_escape_string($_REQUEST['personalinfo']); 
    $uimage             = mysql_real_escape_string($_REQUEST['uimage']);

    $api = new Api();
    
    $result = $api->registerUser($fname, $lname, $username, $password, $dept, $email, $phone, $dateofRegistry, $personalinfo, $uimage);
    
    if($result['result'] == 'SUCCESS')
    {
        //redirect to index        
        header("Location: login.php");
    }
    else
    {   
        //continue reloading this page
        $errors = $result['messages'];
    }
}
else
{
    $fname              = '';
    $lname              = ''; 
    $username           = ''; 
    $password           = ''; 
    $dept               = ''; 
    $email              = ''; 
    $phone              = ''; 
    $dateofRegistry     = ''; 
    $personalinfo       = ''; 
    $uimage             = '';
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
            <form id='register' class="formbox"action='register.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                    
                    <ul class="errorMessages">
<?php
                    foreach($errors as $error)
                    {
?>
                        <li><?= $error; ?></li>
<?php
                    }
?>
                    </ul>    
                    <!--<legend ><h2 class="capital">A<span>dd </span> Y<span>uh </span> S<span>elf(lol)(smh @ tara) </span> </h2></legend><br/>-->
					<legend><img src="images/register.png" alt="Register as a user"/></legend>
                    <div id="dimmer">
                        <div id="dimmerText">
                            <input type='hidden' name='submitted' id='submitted' value='1'/>

                            <label for='fname'>First name*:</label>
                            <input type='text' name='fname' id='fname' maxlength="50" value="<?= $fname ?>" /><br/><br/>

                            <label for='lname'>Last name*:</label>
                            <input type='text' name='lname' id='lname' maxlength="50" value="<?= $lname ?>" /><br/><br/>

                            <label for='username'>Username*:</label>
                            <input type='text' name='username' id='username' maxlength="50"  value="<?= $username ?>"  /><br/><br/>

                            <label>Department*:</label>
                            <select name="dept" id="select_dept">
                                <option value="">...</option>
                                <option value="compscie" <?php if ($dept == 'compscie'){ echo 'SELECTED = "SELECTED"'; } ?> >Computer Science</option>
                                <option value="physics" <?php if ($dept == 'physics'){ echo 'SELECTED = "SELECTED"'; } ?> >Physics</option>
                            </select><br/><br/>
                            
                            <label for='email'>Email Address*:</label>
                            <input type='text' name='email' id='email' maxlength="50"  value="<?= $email ?>" /><br/><br/>
                            
                            <label for='phone'>Phone*:</label>
                            <input type='text' name='phone' id='phone' maxlength="50"  value="<?= $phone ?>" /><br/><br/>

                            <label for='personalinfo'>Personal Info:</label>
                            <input type='text' name='personalinfo' id='personalinfo' maxlength="100"  value="<?= $personalinfo ?>" /><br/><br/>

                            <label for='password'>Password*:</label>
                            <input type='password' name='password' id='password' maxlength="15"  value="<?= $password ?>" /><br/><br/>

                            <label for='pic'>Upload a picture:</label>
                            <input name='MAX_FILE_SIZE' value='102400' type='hidden'/>
                            <input name='uimage' accept='image/jpeg' type='file' /><br/><br/>
                            <input type='submit' name='submit' value='submit'/>
                            
                        </div>
                    </div>
                </fieldset>
            </form>
            <?php include 'footer.php'; ?>
        </div>
    </body>

</html>