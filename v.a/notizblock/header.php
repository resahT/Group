<?php session_start() ?>

<div id="header"> 

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
        
        
        
		 <!--div id="navPanel">
		 <ul ="navlist">
		 <li><a href="index.php" style="text-align:right; right; 50px; top: 20px;"> Notizblock </a>&nbsp;&nbsp;&nbsp;</li>
         <li>&nbsp;&nbsp;<a href="addbook.php "  style="text-align:right;  right: 150px;   top: 20px;"> Add book  </a>&nbsp;&nbsp;&nbsp;</li>
         <li>&nbsp;&nbsp;<a href="addhouse.php " style="text-align:right;  right: 450px;   top: 20px;"> Add House </a>&nbsp;&nbsp;&nbsp;</li>
         <li>&nbsp;&nbsp;<a href="register.php " style="text-align:right;  right: 600px;   top: 20px;"> Register  </a>&nbsp;&nbsp;&nbsp;</li> 
		 <li>&nbsp;&nbsp;<a href="aboutus.php" style="text-align:right; right: 850; top: 20px;"> About Us </a></li>
		 </ul>
		 </div-->
         
        <!--img  src="images/header1.JPG" alt="" style="margin: 0 auto; border: none;width: 100%;height: 100px;" /-->      
        <br />
        <!--img src="images/account_line.gif" alt="" /-->
        
      
        <nav>
 <a href="index.php">Notizblock</a>       
<a href="addbook.php">Add Book</a> 
<a href="addhouse.php"> Add House</a> 
<a href="register.php">Register</a>
<a href="aboutus.php">About Us</a> 

</nav>

    
    <br />
    <br />

