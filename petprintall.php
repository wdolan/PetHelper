<?php
//Software Engineering Fall 2013
//Team WoW
//Bill Dolan, Lindsay Coburn, Lewis Gilzeane, and Dan Jospeh
//Prints a list of all the pets that are available to be gotten.
include 'petsfulllist.php';
$count = 0;
//Uses the list linked from the include and steps through each pet and displays its information
while($count<$acount)
{
	$link = '<a href="petdetails.php?ID=';
	$link = $link . $pets[$count]->creatureID;
	$link = $link . '">';
	echo "Pet Name: ", $link, $pets[$count]->name, "</a> Creature ID ", $pets[$count]->creatureID,	" Level - ", $pets[$count]->level, "<br/>";
	echo "Quality of pet: ", $pets[$count]->quality, " Health - ", $pets[$count]->health, " Power - ", $pets[$count]->power," Speed - ", $pets[$count]->speed,"<br/>";
	$count = $count+1;
	echo "Total pets : ", $count, '<br/>';
}
?>

