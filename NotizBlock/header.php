<?php @session_start() ?>










<div id="header"> 

        <?php
            if (isset($_SESSION['user_info'])){
                $userinfo = $_SESSION['user_info'];
        ?>        
                <a id="loginposition" href="logout.php" style="text-align:right">Logout</a> <a href ="userprof.php"><?php echo"You are logged in as: ".$userinfo['username'] ?></a>
        <?php      
            }           
            else{
        ?>
                <a id="loginposition" href="login.php" style="text-align:right">Login</a>
         <?php
            }
               
        ?>        
        <br />
        
      
        <nav>
			<a href="index.php">Notizblock</a>       
			<a href="listbooks.php">Books</a> 
			<a href="listhouses.php">Houses</a> 
			<a href="register.php">Register</a>
		</nav>
    <br />
    <br />
</div>

