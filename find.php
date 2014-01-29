<?php
//Software Engineering Fall 2013
//Team WoW
//Bill, Lindsay, Lewis, and Dan

// Find PHP funtion.

//PHP code that will look through a users collection to find a specific pet.
//Usage is that it needs the SESSION variables generated from the petread.php
//with the variables pets and acount and uses the passed GET target variable 
//as the pet to look for.

//Start the session for the script and read the needed values.
//Uses this flag if a user is searching if they have a target pet
if($_GET['flag']=="1")
{
	//Make sure sessions are open
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
	$pets = $_SESSION['pets'];
	$acount = $_SESSION['acount'];
}
//Uses this flag if a user is searching if a pet exists
if($_GET['flag']=="0")
{
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
	include 'petsfulllist.php';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="generator" content="CoffeeCup HTML Editor (www.coffeecup.com)">
    <meta name="dcterms.created" content="Wed, 11 Sep 2013 05:27:36 GMT">
    <meta name="description" content="">
    <meta name="keywords" content="">
    
<link href="file.css" type="text/css" rel="stylesheet" />
<!-- add link for CSS file here-->
<title>WoW Pets Find</title>
    <link rel="stylesheet" type="text/css" href="demo.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="login_panel/css/slide.css" media="screen" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    
    <!-- PNG FIX for IE6 -->
    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
    <!--[if lte IE 6]>
        <script type="text/javascript" src="login_panel/js/pngfix/supersleight-min.js"></script>
    <![endif]-->
    
    <script src="login_panel/js/slide.js" type="text/javascript"></script>
    </style>
    
  </head>
  <body>
  <!--Navigation bar code-->
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
<?php
//Predefined values for operation
$count = 0;
$loop = false;

//Makes the searched target have a capital letter in the first character of each word
$target = ucwords($_GET['target']);

//Loop to look through all the pets for the target
while (!$loop)
{
//Checks the current pet in the stored array for the target
//And returns if it is the target and ends the loop.
	if ($target == $pets[$count]->name)
	{
		?>
		<div id="main">
		<div class="container">
		<?php
		echo "You own the pet ", $pets[$count]->name, ". <br/>";
		$link = '<a href="petdetails.php?ID=';
		$link = $link . $pets[$count]->creatureID;
		$link = $link . '"> See the details </a><br/>';
		echo $link;
		$loop = true;
		?>
		</div></div>
		<?php
	}
//A way to exit the loop if the pet is not found.
//count + 1 is needed to prevent a out of array index issue.
	if (($count + 1) == $acount)
	{
		?>
		<div id="main">
		<div class="container">
		<?php
		echo "You either don't own this pet or that name is invalid.<br/>";
		goto loopexit;
		?>
		</div></div>
		<?php
	}
	$count = $count + 1;
}
//Forced exit jump from a pet not found loop.
loopexit:
?>
<!--Need to have a back button-->
<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>
</body></html>