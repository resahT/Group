<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <?php include 'htmlhead.php'; ?>
		<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.js"></script>
    </head>  	
	<body>
		<div id="topContentWrap">
			<?php include 'header.php'; ?>
			
			<div id="livingSpacesPanel" onclick="viewhouse.php">
				<h2>Living Spaces<h2>
				<h3>Need a place to stay this semester?
				Check out the living spaces around Mona
				today!!</h3>
				<div class="read"><a href="viewhouse.php">see more</a></div>
			</div>
			
			<div id="bookPanel" href="viewbook.php">
				<h2>Text Books</h2>
				<h3>Get the Text books you need today!!
				Old, New and Anywhere in between for the
				lowest prices!!</h3>
				<div class="read"><a href="viewbook.php">see more</a></div>
			</div>
			
			<div id="indexpic">
				<img src="images/ls.jpg" width="200" height="200" alt="image1" class="left"/>
				<img src="images/bks2.png" width="200" height="200" alt="image2" class="right"/>
				<img src="images/books.jpg" width="200" height="200" alt="image3" class="right"/>
			</div>
		</div>
		<?php include 'footer.php'; ?>
	</body>
</html>