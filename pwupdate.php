<?php//Software Engineering Fall 2013//Team WoW//Bill Dolan, Lindsay Coburn, Lewis Gilzeane, and Dan Jospeh// Make a page that will allow a user to change their password//Open the session protocols
	define('INCLUDE_CHECK',true);
	require 'connect.php';
	require 'functions.php';
	session_name('tzLogin');
	session_start();	// Check the current user information from the server
	$row = mysql_fetch_row(mysql_query("SELECT id,usr,pass FROM tz_members WHERE usr='{$_SESSION['usr']}'"));
	$cpw = $_POST['cpw'];		// Check if the current password matches the users input
	if($row[2]==md5($cpw))
	{
	
		$result = mysql_query("SELECT id,email,pass,id FROM tz_members WHERE usr = '{$_SESSION['usr']}'");
		if (!$result) {
			echo 'Could not run query: ' . mysql_error();
			exit;
		}
		$row = mysql_fetch_row($result);
		$cnpw = $_POST['cnpw'];
		$npw = $_POST['npw'];	//Checks that the new password and confirmed password are the same.
		if($_POST['npw']==$_POST['cnpw'])
		{
			$npw = md5($npw);
			mysql_query("UPDATE  `tauruspc_wowpets`.`tz_members` SET  `pass` =  '{$npw}' WHERE  `tz_members`.`usr` = '{$_SESSION['usr']}'");			//sets value that was a success in password change
			$value = 'complete';
		}
		else
		{			//sets value that the two new passwords did not match
			$value = 'twomatch';
		}
	}
	
	else
	{		//Sets that the old password does not match the one on file
		$value = 'oldmatch';
	}
?>

<html>
<head>
<title>WoW Pets Character Select</title>
    <link rel="stylesheet" type="text/css" href="demo.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="login_panel/css/slide.css" media="screen" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    
    <!-- PNG FIX for IE6 -->
    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
    <!--[if lte IE 6]>
        <script type="text/javascript" src="login_panel/js/pngfix/supersleight-min.js"></script>
    <![endif]-->
    
    <script src="login_panel/js/slide.js" type="text/javascript"></script>
</head>
<body>

<?php 
		session_name('tzLogin');
		session_start();
 ?><!-- Sets the top panel in place-->
<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1>World of Warcraft Pet Helper</h1>
				<h2>Welcome to our pet helper</h2>		
				<p class="grey">Registration is free and Login to access tons of cool pet info! </p>
				<h2>Enjoy!</h2>

			</div>
            
            
            <?php
			
			if(!$_SESSION['id']):
			
			?>
            
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="" method="post">
					<h1>Member Login</h1>
                    
                    <?php
						
						if($_SESSION['msg']['login-err'])
						{
							echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
							unset($_SESSION['msg']['login-err']);
						}
					?>
					
					<label class="grey" for="username">Username:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="password">Password:</label>
					<input class="field" type="password" name="password" id="password" size="23" />
	            	<label><input name="rememberMe" id="rememberMe" type="checkbox" checked="checked" value="1" /> &nbsp;Remember me</label>
        			<div class="clear"></div>
					<input type="submit" name="submit" value="Login" class="bt_login" />
				</form>
			</div>
			<div class="left right">			
				<!-- Register Form -->
				<form action="" method="post">
					<h1>Not a member yet? Sign Up!</h1>		
                    
                    <?php
						
						if($_SESSION['msg']['reg-err'])
						{
							echo '<div class="err">'.$_SESSION['msg']['reg-err'].'</div>';
							unset($_SESSION['msg']['reg-err']);
						}
						
						if($_SESSION['msg']['reg-success'])
						{
							echo '<div class="success">'.$_SESSION['msg']['reg-success'].'</div>';
							unset($_SESSION['msg']['reg-success']);
						}
					?>
                    		
					<label class="grey" for="username">Username:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="email">Email:</label>
					<input class="field" type="text" name="email" id="email" size="23" />
					<label>A password will be e-mailed to you.</label>
					<input type="submit" name="submit" value="Register" class="bt_register" />
				</form>
			</div>
            
            <?php
			
			else:
			
			?>
            
            <div class="left">
            
            <h1>Members panel</h1>
            
            <p>You can put member-only data here</p>
            <a href="registered.php">View a special member page</a>
			<p><a href="demo.php">Go Home</a>
            <p>- or -</p>
            <a href="demo.php?logoff">Log off</a>
            
            </div>
            
            <div class="left right">
            </div>
            
            <?php
			endif;
			?>
		</div>
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
	    	<li class="left">&nbsp;</li>
	        <li>Hello <?php echo $_SESSION['usr'] ? $_SESSION['usr'] : 'Guest';?>!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#"><?php echo $_SESSION['id']?'Open Panel':'Log In | Register';?></a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->
<!--HTML that displays the result of te password change request-->
<div class="pageContent">
    <div id="main">
      <div class="container">
        <h1>Password Reset Options</h1>
        <h2></h2>
        </div>
        <div class="container">
		<?php if($value == 'complete') {?>
		Your password has been updated.
		<FORM><INPUT Type="button" VALUE="Home" onclick="location.href='demo.php';"></FORM>
		<?php }
		if($value == 'twomatch')
		{
		?>
		Your two passwords don't match.
		<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>
		<?php
		}
		if($value == 'oldmatch')
		{
		?>
		Your old password doesn't match.
		<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>
		<?php
		}
		?>
        </div>
        
      <div class="container tutorial-info">
	  <p>If you need help please contact <a href="mailto:support@billdolan.net?Subject=Pet help support" target="_top">
		support@billdolan.net</a> for more information </p>
      </div>
    </div>
</div>


</body>
</html>