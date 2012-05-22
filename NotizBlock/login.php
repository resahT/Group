<?php

@session_start();

require_once('Api.php');

$username   = '';
$password   = '';
$errors     = array();

if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $api = new Api();

    $result = $api->login($username, $password);

    if($result['result'] == 'SUCCESS')
    {
        header("Location: index.php");
		$_SESSION['transfer']=$username;
    }
    else
    {    
        //continue to redisplay login page
        $errors = $result['messages'];
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <?php include 'htmlhead.php'; ?>    
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <link rel="stylesheet" href="css/logincss.css" type="text/css" media="screen" title="default" />
        <!--  jquery core -->
        <script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

        <!-- Custom jquery scripts -->
        <script src="js/jquery/custom_jquery.js" type="text/javascript"></script>

        <!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
        <script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).pngFix( );
            });
        </script>
    </head>
    
    <body id="login-bg"> 

        <?php include 'header.php'; ?>
        
        <!-- Start: login-holder -->
        <div class="central">

          
                <!-- start logo -->
                <div id="logo-login">
                        <a href="index.php"><img src=" " width="156" height="150" alt="" /></a>
                </div>
                <!-- end logo -->

                <div class="clear"></div>

                <!--  start loginbox ................................................................................. -->
                <!--<div id="loginbox">-->
                    
                    
                    
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
                
                <!--form for submission to php-->
                <form method="post">
                    <!--  start login-inner -->
                    <div id="login-inner" style="padding:auto;margin:auto;">
                            <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                    <th>Username</th>
                                    <td><input type="text" name="username" class="login-inp" value="<?= $username ?>" /></td>
                            </tr>
                            <tr>
                                    <th>Password</th>
                                    <td><input type="password" name="password" value="" onfocus="this.value=''" class="login-inp" />

                            </tr>

                            <tr>
                                    <th></th>
                                    <td valign="top"><input type="checkbox" class="checkbox-size" id="login-check" /><label for="login-check">Remember me</label></td>
                            </tr>
                            <tr>
                                    <th></th>
                                    <td><input type="submit" class="submit-login"  /></td>
                            </tr>
                            </table>
                    </div>
                    <!--  end login-inner -->
                </form>
                <div class="clear"></div>
                <a href="" class="forgot-pwd">Forgot Password?</a>
        <!--</div>-->
        <!--  end loginbox -->

                <!--  start forgotbox ................................................................................... -->
                <div id="forgotbox">
                        <div id="forgotbox-text">Please send us your email and we'll reset your password.</div>
                        <!--  start forgot-inner -->
                        <div id="forgot-inner">
                        <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                                <th>Email address:</th>
                                <td><input type="text" value=""   class="login-inp" /></td>
                        </tr>
                        <tr>
                                <th> </th>
                                <td><input type="button" class="submit-login"  /></td>
                        </tr>
                        </table>
                        </div>
                        <!--  end forgot-inner -->
                        <div class="clear"></div>
                        <a href="" class="back-login">Back to login</a>
                </div>
                <!--  end forgotbox -->

        </div>
        <!-- End: login-holder -->
        
        <?php include 'footer.php'; ?>
    </body>
</html>