<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<!--Software Engineering Fall 2013-->
<!--Team WoW-->
<!--Bill Dolan, Lindsay Coburn, Lewis Gilzeane, and Dan Joseph-->
<!--This page takes information from the user on a type of pet they want to fight-->
<!--Then displays the best types of pets that will be able to fight against with-->


<html>
<head>
<title>WoW Pets </title>
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
//Open the PHP session for bar.
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

//If first starting the page display the different types of pets available to choose from
if(!isset($_GET['type']))
{
	echo '<div id="main"><div class="container"><center>';
	echo "<h1>What type of pet are you trying to fight?</h1><br/>";
	echo '<a href="types.php?type=beast"><img src="images/types/beast.png" alt="beast" width="" height="50"></a>';
	echo '<a href="types.php?type=critter"><img src="images/types/critter.png" alt="beast" width="" height="50"></a>';
	echo '<a href="types.php?type=dragon"><img src="images/types/dragon.png" alt="beast" width="" height="50"></a>';
	echo '<a href="types.php?type=elemental"><img src="images/types/elemental.png" alt="beast" width="" height="50"></a>';
	echo '<a href="types.php?type=flying"><img src="images/types/flying.png" alt="beast" width="" height="50"></a><br/>';

	echo '<a href="types.php?type=humanoid"><img src="images/types/humanoid.png" alt="beast" width="" height="50"></a>';
	echo '<a href="types.php?type=magical"><img src="images/types/magical.png" alt="beast" width="" height="50"></a>';
	echo '<a href="types.php?type=mechanical"><img src="images/types/mechanical.png" alt="beast" width="" height="50"></a>';
	echo '<a href="types.php?type=undead"><img src="images/types/undead.png" alt="beast" width="" height="50"></a>';
	echo '<a href="types.php?type=water"><img src="images/types/water.png" alt="beast" width="" height="50"></a>';
	echo '</center></div></div>';

}

//If a type has alredy been slected choose from the list below and display the correct information
if(isset($_GET['type']))
{
	echo '<div id="main"><div class="container"><center>';
	
// information about beast type pets
if($_GET['type']=='beast')
{
	echo '<img src="images/types/beast.png" alt="beast" width="" height="50"><br/>';
	echo "You have a beast type pet<br/>";
	echo 'Takes less damge from Humanoid pets<br/>';
	echo 'Takes more damge from Mechical pets<br/>';
	echo 'Idealy you would want a Flying type pet that does Mechanical damage in this case.<br/>';
	echo '<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>';
	echo '</div> <div class="container">';
	echo '<div id="text">Some good pets to use are:</div>';
	echo '<center>';
	echo '<a href="petdetails.php?ID=25110">Dragon Kite </br><img src="images/inv_misc_dragonkite_02.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=73368">Skywisp Moth </br><img src="images/ability_hunter_pet_moth.jpg"></a></br>';
	echo '</center></div>';
}

// information about critter type pets
if($_GET['type']=='critter')
{
	echo '<img src="images/types/critter.png" alt="critter" width="" height="50"><br/>';
	echo "You have a Critter type pet<br/>";
	echo 'Takes less damge from Elemental pets<br/>';
	echo 'Takes more damge from Beast pets<br/>';
	echo 'Idealy you would want a Humanoid type pet that does Beast damage in this case.<br/>';
	echo '<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>';
	echo '</div> <div class="container">';
	echo '<div id="text">Some good pets to use are:</div>';
	echo '<center>';
	echo '<a href="petdetails.php?ID=68664">Corefire Imp </br><img src="images/spell_shadow_summonimp.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=73668">Bonkers </br><img src="images/inv_pet_monkey.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=71033">Fiendish Imp </br><img src="images/ability_warlock_impoweredimp.jpg"></a></br>';
	echo '</center></div>';
}

// information about dragon type pets
if($_GET['type']=='dragon')
{
	echo '<img src="images/types/dragon.png" alt="dragon" width="" height="50"><br/>';
	echo "You have a Dragon type pet<br/>";
	echo 'Takes less damge from flying pets<br/>';
	echo 'Takes more damge from Humanoid pets<br/>';
	echo 'Idealy you would want a Undead type pet that does Humanoid damage in this case.<br/>';
	echo '<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>';
	echo '</div> <div class="container">';
	echo '<div id="text">Some good pets to use are:</div>';
	echo '<center>';
	echo '<a href="petdetails.php?ID=34770">Macabre Marionette </br><img src="images/inv_misc_bone_humanskull_02.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=62854">Scourged Whelpling </br><img src="images/inv_misc_head_dragon_black.jpg"></a></br>';
	echo '</center></div>';
}

// information about elemental type pets
if($_GET['type']=='elemental')
{
	echo '<img src="images/types/elemental.png" alt="elemental" width="" height="50"><br/>';
	echo "You have a Elemental type pet<br/>";
	echo 'Takes less damge from Mechanical pets<br/>';
	echo 'Takes more damge from Aquatic pets<br/>';
	echo 'Idealy you would want a Critter type pet that does Aquatic damage in this case.<br/>';
	echo '<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>';
	echo '</div> <div class="container">';
	echo '<div id="text">Some good pets to use are:</div>';
	echo '<center>';
	echo '<a href="petdetails.php?ID=62246">Shimmershell Snail </br><img src="images/trade_archaeology_fossil_snailshell.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=62313">Rusty Snail </br><img src="images/trade_archaeology_fossil_snailshell.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=63001">Silkbead Snail </br><img src="images/trade_archaeology_fossil_snailshell.jpg"></a></br>';
	echo '</center></div>';
}

// information about flying type pets
if($_GET['type']=='flying')
{
	echo '<img src="images/types/flying.png" alt="flying" width="" height="50"><br/>';
	echo "You have a Flying type pet<br/>";
	echo 'Takes less damge from Beast pets<br/>';
	echo 'Takes more damge from Magic pets<br/>';
	echo 'Idealy you would want a Dragon type pet that does Magic damage in this case.<br/>';
	echo '<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>';
	echo '</div> <div class="container">';
	echo '<div id="text">Some good pets to use are:</div>';
	echo '<center>';
	echo '<a href="petdetails.php?ID=68850">Emerald Proto-Whelp </br><img src="images/ability_mount_feldrake.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=68820">Infinite Whelpling </br><img src="images/achievement_boss_infinitecorruptor.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=62395">Nether Faerie Dragon </br><img src="images/inv_egg_06.jpg"></a></br>';
	echo '</center></div>';
}

// information about humanoid type pets
if($_GET['type']=='humanoid')
{
	echo '<img src="images/types/humanoid.png" alt="humanoid" width="" height="50"><br/>';
	echo "You have a Humanoid type pet<br/>";
	echo 'Takes less damge from Critter pets<br/>';
	echo 'Takes more damge from Undead pets<br/>';
	echo 'Idealy you would want a Beast type pet that does Undead damage in this case.<br/>';
	echo '<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>';
	echo '</div> <div class="container">';
	echo '<div id="text">Some good pets to use are:</div>';
	echo '<center>';
	echo '<a href="petdetails.php?ID=62186">Desert Spider </br><img src="images/ability_hunter_pet_spider.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=63304">Jungle Grub </br><img src="images/inv_pet_maggot.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=50586">Mr. Grubbs </br><img src="images/inv_pet_maggot.jpg"></a></br>';
	echo '</center></div>';
}

// information about magical type pets
if($_GET['type']=='magical')
{
	echo '<img src="images/types/magical.png" alt="magical" width="" height="50"><br/>';
	echo "You have a Magical type pet<br/>";
	echo 'Takes less damge from Aquatic pets<br/>';
	echo 'Takes more damge from Dragon pets<br/>';
	echo 'Idealy you would want a Mechanical type pet that does Dragon damage in this case.<br/>';
	echo '<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>';
	echo '</div> <div class="container">';
	echo '<div id="text">Some good pets to use are:</div>';
	echo '<center>';
	echo '<a href="petdetails.php?ID=64899">Mechanical Pandaren Dragonling </br><img src="images/achievement_dungeon_coablackdragonflight_normal.jpg"></a></br>';
	echo '</center></div>';
	
}

// information about mechanical type pets
if($_GET['type']=='mechanical')
{
	echo '<img src="images/types/mechanical.png" alt="mechanical" width="" height="50"><br/>';
	echo "You have a Mechanical type pet<br/>";
	echo 'Takes less damge from Magic pets<br/>';
	echo 'Takes more damge from Elemental pets<br/>';
	echo 'Idealy you would want a Elemental type pet that does Elemental damage in this case.<br/>';
	echo '<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>';
	echo '</div> <div class="container">';
	echo '<div id="text">Some good pets to use are:</div>';
	echo '<center>';
	echo '<a href="petdetails.php?ID=62020">Ruby Sapling </br><img src="images/ability_druid_forceofnature.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=62182">Amethyst Shale Hatchling </br><img src="images/inv_misc_qirajicrystal_05.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=68267">Cinder Kitten </br><img src="images/inv_misc_firekitty.jpg"></a></br>';
	echo '</center></div>';
}

// information about undead type pets
if($_GET['type']=='undead')
{
	echo '<img src="images/types/undead.png" alt="undead" width="" height="50"><br/>';
	echo "You have a Undead type pet<br/>";
	echo 'Takes less damge from Dragon pets<br/>';
	echo 'Takes more damge from Critter pets<br/>';
	echo 'Idealy you would want a Aquatic type pet that does Critter damage in this case.<br/>';
	echo '<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>';
	echo '</div> <div class="container">';
	echo '<div id="text">Some good pets to use are:</div>';
	echo '<center>';
	echo '<a href="petdetails.php?ID=62312">Frog </br><img src="images/spell_shaman_hex.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=62121">Turquoise Turtle </br><img src="images/inv_misc_fish_turtle_02.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=73359">Gulp Froglet </br><img src="images/inv_pet_toad_black.jpg"></a></br>';
	echo '</center></div>';
}

// information about water type pets
if($_GET['type']=='water')
{
	echo '<img src="images/types/water.png" alt="water" width="" height="50"><br/>';
	echo "You have a Aquatic type pet<br/>";
	echo 'Takes less damge from Undead pets<br/>';
	echo 'Takes more damge from Flying pets<br/>';
	echo 'Idealy you would want a Magic type pet that does Flying damage in this case.<br/>';
	echo '<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>';
	echo '</div> <div class="container">';
	echo '<div id="text">Some good pets to use are:</div>';
	echo '<center>';
	echo '<a href="petdetails.php?ID=33227">Enchanted Broom </br><img src="images/inv_pet_broom.jpg"></a></br>';
	echo '<a href="petdetails.php?ID=61877">Jade Owl </br><img src="images/inv_jewelcrafting_jadeowl.jpg"></a></br>';
	echo '</center></div>';
}
	echo '</center></div></div>';
}
?>
<!-- Code for the top bar panel-->
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

<?php if(!isset($_GET['type']))
{ 
?>
<!--Put the back button in its own element-->
<div id="main">
<div class="container">
	<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>
</div></div>
<?php
}
?>
	
</body></html>
