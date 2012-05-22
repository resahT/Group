<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <?php include 'htmlhead.php'; ?>
        <script type="text/javascript" src="jquery.js"></script>
				<script type="text/javascript">
					$(document).ready(function(){
							$("livingSpacesPanel").click(function(){
								$("livingSpacesExtend").slideToggle("slow");
							});
					});
				</script>
    </head>    

<body>
	
        <div id="topContentWrap">
             <?php include 'header.php'; ?>
             
     
<div id="navigation">  


        <img src="images/aboutus.png" alt="header" />
     </div>
             
				<div class="central">
				
                <div id="livingSpacesPanel">
					
					
                    <!--div id="house">
						<a href="#">Housing</a-->
						
						<h2>Living Spaces</h2>
                    
                    <h3>Off- campus housing conveniently located in and around Mona!</h3>
                    
                    <div class="read">
						<a href="#">see more</a>
						</div>
					
						</div>
                    
                   
						<div id="bookPanel">
                    <!--div id="book"><a href="#">Books</a></div-->
                    <h2>Books</h2>
                  
                    <h3>New & used text books for Computer Science and Physics students</h3>
                    <div class="read"><a href="#">see more</a></div>
                    
                    
                </div>
                </div>
                
                
                
                
				<!--div id="livingSpacesExtend">talk that talk to me yeh</div-->
                
                
                
                
                
                <!--div id="rightPanel">
                    <div id="menu">
                    </div>
                    <div id="iconLinks">
                    </div>
                </div-->
            </div>
        
        <!--div id="middleWrap">
            <div id="middlePanel">
            </div>
            
            
            </div-->
            <?php include 'footer.php'; ?>
            
        </div>
    </body>
</html>
