<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <?php include 'htmlhead.php'; ?>
    </head>
	<body>
		<div id ="topContentWrap">
			<?php include 'header.php';?>
			<br/>
			<form id='register' class="formbox"action='register.php' method='post' accept-charset='UTF-8'>
			<fieldset >
                         <legend ><h2 class="capital">A<span>dd </span> Y<span>uh </span> S<span>elf(lol)(smh @ tara) </span> </h2></legend><br/>
			<input type='hidden' name='submitted' id='submitted' value='1'/>
                        
			<label for='fname'>First name*:</label>
                            <input type='text' name='fname' id='fname' maxlength="50"/><br/><br/>
                            
			<label for='lname'>Last name*:</label>
                            <input type='text' name='lname' id='lname' maxlength="50"/><br/><br/>
                            
			<label for='uname'>Username*:</label>
                            <input type='text' name='uname' id='uname' maxlength="50"/><br/><br/>
                            
			<label>Department*:</label>
			<select name="dept" id="select_dept">
				<option value="">...</option>
				<option value="compscie">Computer Science</option>
				<option value="physics">Physics</option>
			</select><br/><br/>
			<label for='email'>Email Address*:</label>
                            <input type='text' name='email' id='email' maxlength="50"/><br/><br/>
                            
			<label for='pinfo'>Personal Info:</label>
                            <input type='text' name='pinfo' id='pinfo' maxlength="100"/><br/><br/>
                            
			<label for='pwd'>Password*:</label>
                            <input type='password' name='pwd' id='pwd' maxlength="15"/><br/><br/>
                            
			<label for='pic'>Upload a picture:</label>
                            <input name='MAX_FILE_SIZE' value='102400' type='hidden'/>
                            <input name='image' accept='image/jpeg' type='file'/><br/><br/>
                            <input type='submit' name='submit' value='submit'/>
			</fieldset>
			</form>
			<?php include 'footer.php'; ?>
		</div>
	</body>
	
</html>