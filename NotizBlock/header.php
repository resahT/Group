<?php session_start() ?>

<div id="header"> 
    <div style=" border-bottom-style:groove; border-bottom-width:thick; left: 0px;z-index: 999;width: 100%;height: 100px;text-align: center;"">
        <?php
            if (isset($_SESSION['user_info'])){
                $userinfo = $_SESSION['user_info'];
        ?>        
                <a id="loginposition" href=" " style="text-align:right"> <?php echo"You are logged in as: ".$userinfo['username'] ?></a>
        <?php      
            }           
            else{
        ?>
                <a id="loginposition" href="login.php" style="text-align:right">Login</a>
         <?php
            }
               
        ?>
         <a href="addbook.php "  style="text-align:right;  right: 150px;   top: 20px;"> Add book  </a> <br/>
         <a href="addhouse.php " style="text-align:right;  right: 450px;   top: 20px;"> Add House </a> <br/>
         <a href="register.php " style="text-align:right;  right: 600px;   top: 20px;"> Register  </a> <br/>
         
        <img  src="images/header1.JPG" alt="" style="margin: 0 auto; border: none;width: 100%;height: 100px;" />      
        <br />
        <img src="images/account_line.gif" alt="" />
     </div>
</div>