<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- include jquery library from google code -->
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.js"></script>
<!-- include jQuery UI from google code -->
<script type="type/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script rc="/scripts/custom.js">
$.expander.defaults.slicePoint = 120;
			$(document).ready(function(){
				$('div.welcomePanel p').expander();
			});</script>
	
	 <head>
        <?php include 'htmlhead.php'; ?>
    </head>    
	
	<body>
		<div id="contentWrap">
			<div id="aboutheader">
				<img src="images/aboutus.png" alt="notizblock" vspace="5" hspace="40"/>
				<a href="index.php">Back to Home</a>
			</div>
			<div id="welcomePanel">
					<div id="dimmer">
						<div id="dimmerText" align="left">
							<p><img src="images/welcome.png" alt="Welcome" hspace="10"/><br/>
							NotizBlock is an online advertisement and sale platform that seeks
							to develop the basic necessities of campus life, leaving the rest
							of the UWI experience up to you...
							Our categories include: Books and Off-Campus Housing.</p>
							<p>If you are interested in buying or selling books in any 
							condition, or if you have the resources to buy and sell housing
							in and around the Mona area, NotizBlock is the place to be.
							If you are interested in taking part in any of these categories
							just click on the tabs found on the menu. Now! The sale process
							take place in two different ways. The items can either be up for
							direct sale or up for bidz.
							A Direct sale would mean, there is one asking price, no bargaining.
							However, items that are up for bidz, as it suggests would accomodate
							users bidding for the item which would go to the highest bidder at 
							the end of the bidding period.</p>
						</div>
					</div>
			</div>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			
			<?php include 'footer.php'; ?>
		</div>
	</body>
</html>
<div id="steps">
	<div .step1>
		<h2>Step 1</h2>
		<h4>If you haven't signed up yet...click the "Register Now" link
		and register with your name, email, password, department and any
		personal information you'd like to share with potential buyers.
		You can even upload a picture!</h4>
	</div>
	<div .step2>
		<h2>Step 2</h2>
		<h4>To begin using the site - Login with the username and password
		you had provided when registering. From there, you can either use 
		the menu or the links on the homepage to select a category, whether
		it be books or living spaces. Enter the necessary information and
		press the submit button.</h4>
	</div>
	<div .step3>
		<h2>Step 3</h2>
		<h4>Feel free to view what is available on NotizBlock.</h4>
	</div>
</div>