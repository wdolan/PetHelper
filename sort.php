<?php
//Software Engineering Fall 2013
//Team WoW
//Bill, Lindsay, Lewis, and Dan
//Useage takes a list of pets from the session that has been read before
// Then will sort that list based on the name field of the array
// Then it returns that value back to the open session variable.

//Opens session to read in the list of pets from petread.php on start of app
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
$pets=$_SESSION['pets'];
$sflag=$_GET['sflag'];
echo $_GET['sflag'], "<br/>";

//Defins the needed function to sort the name field of the array
function cmp_by_name($val1, $val2){
  return strcmp($val1->name, $val2->name);
}

function cmp_by_level($val1, $val2){
	if ($val2->level < $val1->level)
	{
		return -1;
	}
	else {return 1;}
}
usort($_SESSION['pets2'],"cmp_by_level");
//Does the sort of the array for the correct type of sort requested
if($sflag=='1')
{
	echo "Hello from fuction<br/>";
	usort($pets, "cmp_by_level");
	$_SESSION['pets']=$pets;
	$_SESSION['sorted']='lyes';
	echo $_SESSION['sorted'], "<br/>";
	$bounce = 'petprint.php?flag=' . $_SESSION['flag'];
	header("Location: $bounce");
}
if($sflag=='0')
{	
	usort($pets, "cmp_by_name");
	$_SESSION['pets']=$pets;
	$_SESSION['sorted']='yes';
	$bounce = 'petprint.php?flag=' . $_SESSION['flag'];
	header("Location: $bounce");
}
?>
