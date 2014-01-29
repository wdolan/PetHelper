<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!--Software Engineering Fall 2013-->
<!--Team WoW-->
<!--Bill Dolan, Lindsay Coburn, Lewis Gilzeane, and Dan Jospeh-->
<!--Page that handles how to compare one player to another.-->
<?php
//Open the session with needed information
define('INCLUDE_CHECK',true);

require 'connect.php';
require 'functions.php';
session_name('tzLogin');
session_start();
if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
			header("Location: demo.php");
	exit;
}
?>
<html>
<head>
<title>WoW Pets Compare</title>
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
<!--Navigation bar-->
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
			
			if(isset($_GET['logoff']))
				{
					$_SESSION = array();
					session_destroy();
	
					header("Location: demo.php?logoff");
					exit;
				}
			
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

<?php
//Calls the list of pets with the default or first Character name put in
//Calls the list of pets with the second character name put in.
//Opens sessions to read variables

//Construct a link to the print list of all pets
//Uses flag to print primary user
$link = '<a href="petprint.php?name=';
$link = $link . $_SESSION["name"];
$link = $link . '&realm=';
$link = $link . $_SESSION["realmreal"];
$link = $link . '&flag=1';
$link = $link . '"';


//Save variables so the second call does not overwrite them.
$first->name = $_SESSION["name"];
$first->realm = $_SESSION["realm"];
$first->realmreal = $_SESSION["realmreal"];
$first->acount = $_SESSION["acount"];
$first->battle = $_SESSION["battle"];
$first->pets = $_SESSION["pets"];
?>
<div id="main">
<div class="container">
<?php
//Print the details of the first character for user review of information
echo $first->name,  "<br/>", $first->realm,  "<br/>", $first->battle,  "<br/>";
echo "Amount of pets collected : ", $first->acount, " of a Total 723 possible pets.<br/>";

//Display the link for the print list
echo $link,'>See list</a><br/>';
?>
</div>
<div class="container">
<?php
//Move over variables for scrape of the second character
$_GET["name"] = $_GET["name2"];
$_GET["realm"] = $_GET["realm2"];

//Call the read for the second character
include 'petread2.php';

//Construct a link to the print list of all pets for second character
//uses flag 0 to indicate secondary target user for comparison
$link = '<a href="petprint.php?name=';
$link = $link . $_GET["name"];
$link = $link . '&realm=';
$link = $link . $_GET["realm"];
$link = $link . '&flag=0';
$link = $link . '"';

//Display the link for the print list of the second character
echo $link,'onclick="setflag();">See list</a><br/>';
?>
</div>
<?php
//Copy back over written session variables from the second scrape call.
$_SESSION["name"] = $first->name;
$_SESSION["realm"] = $first->realm;
$_SESSION["realmreal"] = $first->realmreal;
$_SESSION["acount"] = $first->acount;
$_SESSION["battle"] = $first->battle;
$_SESSION["pets"] = $first->pets;
?>
<div class="container">
<?php
	echo '<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>';
?>
</div>
</div>
</body></html>