<?php
//Software Engineering Fall 2013
//Team WoW
//Bill, Lindsay, Lewis, and Dan

//PHP code that will look through a users collection to find a specific pet.
//Usage is that it needs the SESSION variables generated from the petread.php
//with the variables pets and acount and uses the passed GET target variable 
//as the pet to look for.

//Start the session for the script and read the needed values.
session_start();
//$pets = $_SESSION['pets'];
//$acount = $_SESSION['acount'];
include 'petsfulllist.php';

//Predefined values for operation
$count = 0;
$loop = false;

$target = ucwords($_GET['target']);

//Loop to look through all the pets for the target
while (!$loop)
{
//Checks the current pet in the stored array for the target
//And returns if it is the target and ends the loop.
	if ($target == $pets[$count]->name)
	{
		echo "You own the pet ", $pets[$count]->name, ". <br/>";
		$link = '<a href="petdetails.php?ID=';
		$link = $link . $pets[$count]->creatureID;
		$link = $link . '"> See the details </a><br/>';
		echo $link;
		$loop = true;
	}
//A way to exit the loop if the pet is not found.
//count + 1 is needed to prevent a out of array index issue.
	if (($count + 1) == $acount)
	{
		echo "You either don't own this pet or that name is invalid.<br/>";
		goto loopexit;
	}
	$count = $count + 1;
}
//Forced exit jump from a pet not found loop.
loopexit:
?>
<a href="options.html"> Back</a>
