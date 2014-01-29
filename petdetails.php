<!DOCTYPE html>
<!--Software Engineering Fall 2013-->
<!--Team WoW-->
<!--Bill Dolan, Lindsay Coburn, Lewis Gilzeane, and Dan Jospeh-->
<!--Page that handels the output of specific details for a pet-->
<?php
//Confirm login information for the navigation bar
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
<html lang="en">
  <head>
    <meta charset="utf-8">
    
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
  <!--Navigiation bar-->
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
// Sets the URL for pulling data
$url = "www.wowhead.com/npc=";
$url = $url . $_GET["ID"];
// Initializes counter for array of storage.
$acount = 0;
session_start();

//Function that opens the connections for data retrieval
function get_url_contents($url){
        $crl = curl_init();
        $timeout = 5;
        curl_setopt ($crl, CURLOPT_URL,$url);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
}
// Copys data into internal string
$retrievedData = get_url_contents($url);
$url2 = "http://www.warcraftpets.com/search/?q=pandaren monk";
$retrievedData2 = get_url_contents($url2);
//echo $retrievedData2;
$datastore = $retrievedData;
$pos = (strpos($retrievedData, '<title>')+7);
$retrievedData = substr($retrievedData,$pos,strlen($retrievedData));
$petsdata->name = substr($retrievedData,0,(strpos($retrievedData, " - ")));
?>
<div id="main">
<div class="container">
<?php
echo "Pets Name - ", $petsdata->name, "<br/>";
$link = '<a href="map.php';
//$link = $link . $_GET["ID"];
$_SESSION["ID"]=$_GET["ID"];
$link = $link . '">';
echo $link, 'Map </a> <br/>';

//Searches the page for the icon image of the pet and then
//echos that out onto the pet details page.
$pos = (strpos($retrievedData, 'Icon.create(')+13);
$iconname = substr($retrievedData, $pos, (strpos($retrievedData, ', 1)')-($pos+1)));
$imagepet = '<img src="http://wow.zamimg.com/images/wow/icons/large/';
$imagepet = $imagepet . $iconname . '.jpg">';
echo $imagepet;
?>
</div>
<div class="container">
<?php
echo "<br/><br/> <center><h1>Pet abilities</h1></center> <br/>";
?>
</div>
<?php
//Finding and setting icon output
$iconurl = 'http://wow.zamimg.com/images/wow/icons/large/'. $iconname . '.jpg';
//Parse wowhead.com output for the needed information about the pets abilities.
$pos = (strpos($retrievedData, 'tab_abilities')+15);
$retrievedData = substr($retrievedData, $pos, strlen($retrievedData));
$pos = strpos($retrievedData, '{');
$pos2 = strpos($retrievedData, '}');
$abilityline = substr($retrievedData, $pos, (strpos($retrievedData, "}")-($pos-1)));
$pos = (strpos($retrievedData, '},{')+3);
$pos = (strpos($abilityline, 'damage')+8);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->damage =  substr($abilityline, 0, (strpos($abilityline, ',')));
$pos = (strpos($abilityline, 'icon":')+7);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->icon = substr($abilityline,0, (strpos($abilityline, '"')));

?>
<div id="main">
<div class="container">
<?php
echo '<img src="http://wow.zamimg.com/images/wow/icons/large/', $petsdata->icon, '.jpg"><br/>';
$pos = (strpos($abilityline, '"id"')+5);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->id =  substr($abilityline, 0, (strpos($abilityline, ',')));
$pos = (strpos($abilityline, 'name')+7);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->name =  substr($abilityline, 0, (strpos($abilityline, '"')));
echo "Name of ability - " , $petsdata->name, "<br/>";
echo "Damage ability - " , $petsdata->damage, "<br/>";
echo "Id number - " , $petsdata->id, "<br/>";
?> </div> <?php

$pos = (strpos($retrievedData, '},{')+3);
$retrievedData = substr($retrievedData,($pos-1), strlen($retrievedData));
$pos = strpos($retrievedData, '{');
$pos2 = strpos($retrievedData, '}');
$abilityline = substr($retrievedData, $pos, (strpos($retrievedData, "}")-($pos-1)));
if(strpos($abilityline, 'damage'))
{
	$pos = (strpos($abilityline, 'damage')+8);
	$abilityline = substr($abilityline,$pos, strlen($abilityline));
	$petsdata->damage =  substr($abilityline, 0, (strpos($abilityline, ',')));
}
else
{
	$petsdata->damage = 'No Damage';
}
$pos = (strpos($abilityline, 'icon":')+7);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->icon2 = substr($abilityline,0, (strpos($abilityline, '"')));

?>
<div class="container">
<?php
echo '<img src="http://wow.zamimg.com/images/wow/icons/large/', $petsdata->icon2, '.jpg"><br/>';
$pos = (strpos($abilityline, '"id"')+5);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->id =  substr($abilityline, 0, (strpos($abilityline, ',')));
$pos = (strpos($abilityline, 'name')+7);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->name =  substr($abilityline, 0, (strpos($abilityline, '"')));
echo "Name of ability - " , $petsdata->name, "<br/>";
echo "Damage ability - " , $petsdata->damage, "<br/>";
echo "Id number - " , $petsdata->id, "<br/>";
?> </div> <?php
//echo substr($retrievedData, 0, 10), "<br/>";
$pos = (strpos($retrievedData, '},{'));
$retrievedData = substr($retrievedData, (strpos($retrievedData, '}')+1), (strlen($retrievedData)));
$abilityline = substr($retrievedData, strpos($retrievedData, '{'),(strpos($retrievedData, '}')+1));
if(strpos($abilityline, 'damage'))
{
	$pos = (strpos($abilityline, 'damage')+8);
	$abilityline = substr($abilityline,$pos, strlen($abilityline));
	$petsdata->damage =  substr($abilityline, 0, (strpos($abilityline, ',')));
}
else
{
	$petsdata->damage = 'No Damage';
}
$pos = (strpos($abilityline, 'icon":')+7);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->icon3 = substr($abilityline,0, (strpos($abilityline, '"')));
?>
<div class="container">
<?php
echo '<img src="http://wow.zamimg.com/images/wow/icons/large/', $petsdata->icon3, '.jpg"><br/>';
$pos = (strpos($abilityline, '"id"')+5);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->id =  substr($abilityline, 0, (strpos($abilityline, ',')));
$pos = (strpos($abilityline, 'name')+7);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->name =  substr($abilityline, 0, (strpos($abilityline, '"')));
echo "Name of ability - " , $petsdata->name, "<br/>";
echo "Damage ability - " , $petsdata->damage, "<br/>";
echo "Id number - " , $petsdata->id, "<br/>";
?> </div> <?php

$retrievedData = substr($retrievedData, (strpos($retrievedData, '}')+2), (strlen($retrievedData)));
$abilityline = substr($retrievedData, strpos($retrievedData, '{'),(strpos($retrievedData, '}')+1));
if(strpos($abilityline, 'damage'))
{
	$pos = (strpos($abilityline, 'damage')+8);
	$abilityline = substr($abilityline,$pos, strlen($abilityline));
	$petsdata->damage =  substr($abilityline, 0, (strpos($abilityline, ',')));
}
else
{
	$petsdata->damage = 'No Damage';
}
$pos = (strpos($abilityline, 'icon":')+7);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->icon4 = substr($abilityline,0, (strpos($abilityline, '"')));

?>
<div class="container">
<?php
echo '<img src="http://wow.zamimg.com/images/wow/icons/large/', $petsdata->icon4, '.jpg"><br/>';
$pos = (strpos($abilityline, '"id"')+5);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->id =  substr($abilityline, 0, (strpos($abilityline, ',')));
$pos = (strpos($abilityline, 'name')+7);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->name =  substr($abilityline, 0, (strpos($abilityline, '"')));
echo "Name of ability - " , $petsdata->name, "<br/>";
echo "Damage ability - " , $petsdata->damage, "<br/>";
echo "Id number - " , $petsdata->id, "<br/>";
?> </div> <?php
$retrievedData = substr($retrievedData, (strpos($retrievedData, '}')+2), (strlen($retrievedData)));
$abilityline = substr($retrievedData, strpos($retrievedData, '{'),(strpos($retrievedData, '}')+1));
if(strpos($abilityline, 'damage'))
{
	$pos = (strpos($abilityline, 'damage')+8);
	$abilityline = substr($abilityline,$pos, strlen($abilityline));
	$petsdata->damage =  substr($abilityline, 0, (strpos($abilityline, ',')));
}
else
{
	$petsdata->damage = 'No Damage';
}
$pos = (strpos($abilityline, 'icon":')+7);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->icon5 = substr($abilityline,0, (strpos($abilityline, '"')));

?>
<div class="container">
<?php
echo '<img src="http://wow.zamimg.com/images/wow/icons/large/', $petsdata->icon5, '.jpg"><br/>';
$pos = (strpos($abilityline, '"id"')+5);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->id =  substr($abilityline, 0, (strpos($abilityline, ',')));
$pos = (strpos($abilityline, 'name')+7);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->name =  substr($abilityline, 0, (strpos($abilityline, '"')));
echo "Name of ability - " , $petsdata->name, "<br/>";
echo "Damage ability - " , $petsdata->damage, "<br/>";
echo "Id number - " , $petsdata->id, "<br/>";
?> </div> <?php
$retrievedData = substr($retrievedData, (strpos($retrievedData, '}')+2), (strlen($retrievedData)));
$abilityline = substr($retrievedData, strpos($retrievedData, '{'),(strpos($retrievedData, '}')+1));
if(strpos($abilityline, 'damage'))
{
	$pos = (strpos($abilityline, 'damage')+8);
	$abilityline = substr($abilityline,$pos, strlen($abilityline));
	$petsdata->damage =  substr($abilityline, 0, (strpos($abilityline, ',')));
}
else
{
	$petsdata->damage = 'No Damage';
}
$pos = (strpos($abilityline, 'icon":')+7);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->icon6 = substr($abilityline,0, (strpos($abilityline, '"')));

?>
<div class="container">
<?php
echo '<img src="http://wow.zamimg.com/images/wow/icons/large/', $petsdata->icon6, '.jpg"><br/>';
$pos = (strpos($abilityline, '"id"')+5);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->id =  substr($abilityline, 0, (strpos($abilityline, ',')));
$pos = (strpos($abilityline, 'name')+7);
$abilityline = substr($abilityline,$pos, strlen($abilityline));
$petsdata->name =  substr($abilityline, 0, (strpos($abilityline, '"')));
echo "Name of ability - " , $petsdata->name, "<br/>";
echo "Damage ability - " , $petsdata->damage, "<br/>";
echo "Id number - " , $petsdata->id, "<br/>";
// Code that will search for the character desired
// And then start data extraction
?> </div> 


<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>
</body></html>
