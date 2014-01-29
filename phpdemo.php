<!-- Bill Dolan, Andrea Rommal, Ben Kronisch-->
<!-- HTML Sim project-->
<!-- Team ABB-->
<!-- Software Engineering Fall 2013-->
<!-- Input page and code for the form input -->
<!-- Gathers information from the user that powers the simulation -->

<html>
  <head>
    <title>Land of Dinos</title>
	<link href="SimABB-style.css" type="text/css"rel="stylesheet" />
  </head>

  <body>
	<div>
    <?php
      // if name is not found, display form for start of the game
      if (!array_key_exists('name', $_GET)) {
    ?>
	<center>
	<!-- Diplay a general welcome that outlines and sets up the game -->
	<h1>Welcome.</h1>
	<h2> Getting ready to take a trip to the past? </h2>
	<h3> Lets just gather some information before we hop in the <a  style="text-decoration:none; color:black" href="http://www.bbcamerica.com/anglophenia/files/2012/12/tardis2.jpg">time machine</a> shall we?</h3>
	<hr><hr>
	<!-- Form to get starting information and loop back to the php and start the simulation -->
      <form method="GET" action="phpdemo.php">
		<table border="1" width="350">
			<tr>
				<td>Name: </td>
				<td> <input type="text" name="name"> </td>
			</tr>
			<tr>
				<td>Want to play a game?</td>
				<td><input type="radio" name="game" value="yes">Yes <input type="radio" name="game" value="no">No</td>
			</tr>
		</table>
		<!-- Sets the basic starting values for defaults of health and the like -->
		<input type="hidden" name="health" value="10">
		<input type="hidden" name="days" value="14">
		<input type="hidden" name="defense" value="0">
		<input type="hidden" name="defenseadd" value="0">
		<input type="hidden" name="shelter" value="0">
		<input type="hidden" name="event" value="111">
		<input type="hidden" name="food" value="6">
		<input type="submit" value="Submit">
      </form>
	</center>
	<p align="right">
		<input type="button" value="Resume Game?" 
							onclick="window.location.href='pause.php?pause=0'" />
	</p>
    <?php
      // otherwise, process form  
      } else {
		// Check to make sure name is not empty
		if ($_GET['name']==null)
		{
			?>
			<center><br/> Sorry we didn't understand your name.</center>
			<input type="button" value="Try again?" 
							onclick="window.location.href='welcome.html'" />
			<?php
			$_GET['name']='Name';
			exit;
		}
		// Check to make sure the user did not put in a invalid name
		// That might break code.
		if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_GET['name']))
		{
			?>
			<center><br/> Sorry we didn't understand your name.</center>
			<input type="button" value="Try again?" 
							onclick="window.location.href='welcome.html'" />
			<?php
			$_GET['name']='Name';
			exit;
		}
        if ($_GET['game']=='yes') {
		  ?>
		<center>
		<!-- Beginning of the typical page that asks the user to make a choice. -->
		<h1> Hello <?php echo $_GET['name']?>,</h1>
		<!-- Nice little story outline that sets the mood -->
		<h2>Ahhhh. Beginning our day. So much to do.<br/> 
		You only have so much daylight available and only so much energy. <br/>
		You are trying to conserve energy and what little resources you have. <br/>
		It is 6:00am and the sun has just risen, 
		what should we do today?</h2><br/><br/>
		<?php 
			// PHP code that will use a base value to display a reminder of how the game starts out and what values
			// This code is used so this information is only displayed the first time on the status page.
			if($_GET['event']==111){
				?>
				<h3>Keep in mind you start out with <?php echo $_GET['health']?> health, no defense or shelter, and 6 food rations.<br>
				Now just try and hold in there until us programmers come back and pull you to the future again.</h3>
				<?php
				$_GET['event']=0;}
		?>
		<h4>Choose your action for the day:</h4>
		<!-- Allow the user to make a choice and submit that information to the PHP status page for calculation and display -->
		<hr><hr>
		<!-- Display the form for user choice. -->
		<form method="GET" action=status1.php>
		<table>
		<tr>
			<td><input type="radio" name="defenseadd" value="add"> </td>
			<td>Build Defense</td>
		</tr>
		<tr>
			<td><input type="radio" name="defenseadd" value="food" checked></td>
			<td>Gather food</td>
		</tr>
		<tr>
			<td><input type="radio" name="defenseadd" value="shelt"></td>
			<td>Build a shelter</td>
		</tr>
		<tr>
			<td><input type="radio" name="defenseadd" value="expl"></td>
			<td>Explore the island</td>
		</tr>
		</table>
		<!-- Added information so that the variables are passed to the status page with the form GET method -->
		<input type="hidden" name="health" value=<?php echo $_GET['health'] ?>>
		<input type="hidden" name="name" value=<?php echo $_GET['name'] ?>>
		<input type="hidden" name="game" value=<?php echo $_GET['game'] ?>>
		<input type="hidden" name="days" value=<?php echo $_GET['days'] ?>>
		<input type="hidden" name="defense" value=<?php echo $_GET['defense'] ?>>
		<input type="hidden" name="shelter" value=<?php echo $_GET['shelter'] ?>>
		<input type="hidden" name="event" value=<?php echo $_GET['event'] ?>>
		<input type="hidden" name="food" value=<?php echo $_GET['food'] ?>>
		<input type="submit" value="Submit">
      </form>
	  <br>
	  <p align=right>
	  <input type="button" value="Pause Game" 
				onclick="window.location.href='pause.php?name=<?php echo $_GET['name'] ?>&game=<?php echo $_GET['game']?>&health=<?php echo $_GET['health']?>&days=<?php echo $_GET['days']?>&defense=<?php echo $_GET['defense']?>&event=<?php echo $_GET['event']?>&food=<?php echo $_GET['food']?>&shelter=<?php echo $_GET['shelter']?>&defenseadd=<?php echo $_GET['defenseadd']?>&pause=1 '" />
	  </p>
	  <hr><hr>
	  		<br/>
		<!-- End game option -->
		<center><br/> Tired of struggling to survive?</center>
		<input type="button" value="Embrace Demise" 
							onclick="window.location.href='closing.html'" />
		</center>
	  <?php
		} 
			// Option added so that if "No" is selected as a option to wanting to play it allows exit as well.
			else {
				print "You are free to leave.<br>";
				print "While you still can.<br>";
				?>
				
						<input type="button" value="Run away little girl" 
							onclick="window.location.href='closing.html'" />
				<?php
				}

      }
    ?>
	</div>
  </body>
</html>