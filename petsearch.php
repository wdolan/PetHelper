<?php

//Software Engineering Fall 2013
//Team WoW
//Bill Dolan, Lindsay Coburn, Lewis Gilzeane, and Dan Jospeh
// This code allows to search through a list for a specific pet.

//predefined character for testings
//$_GET["name"] = "lucian";
$_GET["realm"] = "cenarion-circle";
//$target = "Mini Thor";
//load the php module for usable data
include 'petread.php';
//search thru list for required pet.
$count = 0;
check:
//If found display the correct information.
if($_GET["target"]==$pets[$count]->name)
{	
	echo "You have this pet in your collection. <br/>";
	echo "Pet Name: ", $pets[$count]->name, " Creature ID ", $pets[$count]->creatureID,	" Level - ", $pets[$count]->level, "<br/>";
	echo "Quality of pet: ", $pets[$count]->quality, " Health - ", $pets[$count]->health, " Power - ", $pets[$count]->power," Speed - ", $pets[$count]->speed,"<br/>";
	$link = '<a href="http://mathcs.muhlenberg.edu/~wd248119/petdetails.php?ID=';
	$link = $link . $pets[$count]->creatureID;
	$link = $link . '"';
	echo $link,'>Pet information</a>';
	exit;
}

//Fallback if the pet is not found
else
{
	$count = $count+1;
	if($count == $acount)
	{
		goto done;
	}
	goto check;
}
done:
echo "Pet not owned";
exit;
?>
