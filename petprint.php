<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<!--Software Engineering Fall 2013-->
<!--Team WoW-->
<!--Bill Dolan, Lindsay Coburn, Lewis Gilzeane, and Dan Jospeh-->
<!--This page sets up the printing system for listing pets with the navigation bar-->

<html>
<head>
<title>WoW Pets Pets List</title>
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
//Opens the session and reads in values from the previous search
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
//$pets = $_SESSION['pets'];
//$acount = $_SESSION['acount'];
$flag = $_GET['flag'];
$_SESSION['flag']=$flag;
$sorted = null;
$letter = 'A';

//Flag check to see based on the call if it will print
//either the primary user or a user for comparison
if($flag == '1') // Indicates for the primary user
{
	//Copy in the data for the primary data
	$pets = $_SESSION['pets'];
	$acount = $_SESSION['acount'];
	$sorted = $_SESSION['sorted'];
	echo $sorted. "<br/>";
}

if($flag == '0') //Indicates for the secondary player
{
	//Copy in the data for the secondary player
	$pets = $_SESSION['pets2'];
	$acount = $_SESSION['acount2'];
	$sorted = 'yes';
}
//Sets a flag for printing the lists of all pets available
if($flag == '2')
{
	include 'petsfulllist.php';
	$sorted='yes';
}
?>
<!--Starts HTML and navigation output-->
	<div id="main">
	<div class="container">
	<?php
if($sorted=='yes')
//Change display with letter jumps if it is sorted by name
{
	echo "<h1> Sorted by name </h2><br/>";
	while($letter != "AA")
	{
		echo '<A HREF="#letter',$letter,'"> ',$letter,'</A> ';
		$letter++;
	}
	$letter='A';
	echo "<br/>";
}
//Change output if sorted by level
if($sorted=='lyes')
{
	echo "<h1> Sorted by level </h1><br/>";
}
?>
</div>
<!--Buttons to change the type of sort that is being used-->
<FORM><INPUT Type="button" VALUE="Sort by name" onclick="location.href='sort.php?sflag=0';"></FORM>
<FORM><INPUT Type="button" VALUE="Sort by level" onclick="location.href='sort.php?sflag=1';"></FORM>
<?php
//Initialize counter for the loop
$count = 0;

//Generic back button to the last page the user was at
echo '<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>';

// Display the total number of pets as confirmation
?>
	<div class="container">
	<?php
echo "Total number of pets in this list : ", $acount, "<br/>";
?>
</div>
<?php

// Loop that prints out all of the pets in the list.
while($count<$acount)
{
	$link = '<a href="petdetails.php?ID=';
	$link = $link . $pets[$count]->creatureID;
	$link = $link . '">';
	//Displays the letter navigation jumps
	if($sorted=='yes')
	{
		if($letter!=null)
		{
			if($letter==$pets[$count]->name[0])
			{
				?>
				<div class="container">
				<?php
				echo '<A NAME="letter',$letter,'">Letter ',$letter,'</A><br/> ';
				$letter++;
				?>
				</div>
				<?php
			}
			if($count<($acount-1))
			{
				if($letter<$pets[($count+1)]->name[0])
				{
					$letter = $pets[($count+1)]->name[0];
				}
				if($letter==$pets[$count]->name[0]&&$letter==$pets[($count+1)]->name[0])
				{
					$letter=null;
				}
			}
			if($letter=='AA')
			{
				$letter=null;
			}
		}
	}
	?>
	<div class="container">
	<?php
	//Code that prints the pets basic details
	echo "Pet Name: ", $link, $pets[$count]->name, "</a> Creature ID ", $pets[$count]->creatureID,	" Level - ", $pets[$count]->level, "<br/>";
	echo "Quality of pet: ", $pets[$count]->quality, " Health - ", $pets[$count]->health, " Power - ", $pets[$count]->power," Speed - ", $pets[$count]->speed,"<br/>";
	if($flag='2')
	{
		echo "Type of pet ", $pets[$count]->type, ".<br/>";
	}
	$count = $count+1;
	?>
	</div>
	<?php
}
?>
</div>
<!--Navigaiton bar system-->
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
<!--End contact information-->
<div class="pageContent">
    <div id="main">
      <div class="container">
		</div>
        
      <div class="container tutorial-info">
	  <p>If you need help please contact <a href="mailto:support@billdolan.net?Subject=Pet help support" target="_top">
		support@billdolan.net</a> for more information </p>
		<?php echo strcmp("21","9"); ?>
      </div>
    </div>
</div>

</body>
</html>
