<?php @session_start() ?>

<div id="header"> 
    <div style=" border-bottom-style:groove; border-bottom-width:thick; left: 0px; z-index: 999; width: 100%;height: 100px;text-align: center;"">
<?php
            if (isset($_SESSION['user_info']) && !empty($_SESSION['user_info']))
            {
                $userinfo = $_SESSION['user_info'];
                
                $currentUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                
                $logoutUrl  = 'logout.php?returnTo=' . urlencode($currentUrl);
?>        
                <a id="loginposition" href="<?= $logoutUrl ?>" style="text-align: right"> <?php echo"You are logged in as: " . $userinfo['username'] ?></a>
<?php
            }
            else
            {
?>
                <a id="loginposition" href="login.php" style="text-align:right">Login</a>
<?php
            }
?>
        <div id="navPanel">
            <ul id="navlist" class="navlist">
                <li><a href="index.php" style="text-align:right; right; 50px; top: 20px;"> NotizBlock </a>&nbsp;&nbsp;&nbsp;</li>
                <li>&nbsp;&nbsp;<a href="listbooks.php"  style="text-align:right;  right: 150px;   top: 20px;"> Books  </a>&nbsp;&nbsp;&nbsp;</li>
                <li>&nbsp;&nbsp;<a href="listhouses.php" style="text-align:right;  right: 450px;   top: 20px;"> Houses </a>&nbsp;&nbsp;&nbsp;</li>
                <li>&nbsp;&nbsp;<a href="register.php" style="text-align:right;  right: 600px;   top: 20px;"> Register </a>&nbsp;&nbsp;&nbsp;</li> 
                <li>&nbsp;&nbsp;<a href="aboutus.php" style="text-align:right; right: 850; top: 20px;"> About Us </a></li>
            </ul>
        </div>

        <img  src="images/header1.JPG" alt="" style="margin: 0 auto; border: none;width: 100%;height: 100px;" />      
        <br />
        <img src="images/account_line.gif" alt="" />
    </div>

    <br />
    <br />

</div>