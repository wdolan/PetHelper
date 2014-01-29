<?php
//Software Engineering Fall 2013
//Team WoW
//Bill Dolan, Lindsay Coburn, Lewis Gilzeane, and Dan Jospeh
// Sets up the input of data for data scraping

//Useage 
// Takes a character name from get name
// Takes a realm from realm
// Then outputs list of pets as a return in array "pets"

// Sets the URL for pulling data
$a = "http://us.battle.net/api/wow/character/";
$a = $a . $_GET["realm"] . "/";
$url = $a . $_GET["name"];
$url = $url . "?fields=pets";
// Initializes counter for array of storage.
$acount = 0;
//$file = $_GET["name"] . '.txt';
//echo $file, "<br/>";

//Define the fuction to sort by name.
function cmp_by_name($val1, $val2){
  return strcmp($val1->name, $val2->name);
}

// Copys data into internal string
$retrievedData = @file_get_contents($url);

//echo $retrievedData;

// Code that will search for the character desired
// And then start data extraction
$pos = (strpos($retrievedData, 'status'));
//Error if the searched user is not found.
if($retrievedData == NULL)
{
	echo "Character not found.";
	exit;
}
//Finding the name from input
$pos = (strpos($retrievedData, 'name')+7);
if(strpos($retrievedData, 'name')) 
{
   $retrievedData = substr($retrievedData,$pos, strlen($retrievedData));
   $data->name=substr($retrievedData, 0, (strpos($retrievedData, ',')-1));
   $pos = strpos($retrievedData, ',');
}

// Extracting the Realm name
$pos = (strpos($retrievedData, 'realm')+8);
if(strpos($retrievedData, 'realm')) 
{
   $retrievedData = substr($retrievedData,$pos, strlen($retrievedData));
   $data->realm=substr($retrievedData, 0, (strpos($retrievedData, ',')-1));
   $pos = strpos($retrievedData, ',');
}

// Extracting the battlegroup
$pos = (strpos($retrievedData, 'battlegroup')+14);
if(strpos($retrievedData, 'battlegroup')) 
{
   $retrievedData = substr($retrievedData,$pos, strlen($retrievedData));
   $data->battle=substr($retrievedData, 0, (strpos($retrievedData, ',')-1));
   $pos = strpos($retrievedData, ',');
}
// Display Character Data
echo $data->name,  "<br/>", $data->realm,  "<br/>", $data->battle,  "<br/>";

// Display a list of pets
// loop that for every name that is in the list will output the details of the pet.
while(strpos($retrievedData, 'name'))
{	
	//Retrieve the creature ID
	$pos = (strpos($retrievedData, 'creatureId')+12);
	$retrievedData = substr($retrievedData,$pos, strlen($retrievedData));
	$pets[$acount]->creatureID =  substr($retrievedData, 0, (strpos($retrievedData, ',')));
	//Get the qualtiy ID level
	$pos = (strpos($retrievedData, 'qualityId')+11);
	$retrievedData = substr($retrievedData,$pos, strlen($retrievedData));
	$pets[$acount]->quality =  substr($retrievedData, 0, (strpos($retrievedData, ',')));
	//Grabs the level of the pet
	$pos = (strpos($retrievedData, 'level')+7);
	$retrievedData = substr($retrievedData,$pos, strlen($retrievedData));
	$pets[$acount]->level =  substr($retrievedData, 0, (strpos($retrievedData, ',')));
	$pos = strpos($retrievedData, ',');
	//Get the Health of the pet that is collected
	$pos = (strpos($retrievedData, 'health')+8);
	$retrievedData = substr($retrievedData,$pos, strlen($retrievedData));
	$pets[$acount]->health =  substr($retrievedData, 0, (strpos($retrievedData, ',')));
	//Get the power of the pet that is collected
	$pos = (strpos($retrievedData, 'power')+7);
	$retrievedData = substr($retrievedData,$pos, strlen($retrievedData));
	$pets[$acount]->power =  substr($retrievedData, 0, (strpos($retrievedData, ',')));
	//Get the speed of the pet that is collected
	$pos = (strpos($retrievedData, 'speed')+7);
	$retrievedData = substr($retrievedData,$pos, strlen($retrievedData));
	$pets[$acount]->speed =  substr($retrievedData, 0, (strpos($retrievedData, '}')));
	//Retrieve the Name
	$pos = (strpos($retrievedData, 'creatureName')+15);
	$retrievedData = substr($retrievedData,$pos, strlen($retrievedData));
	$pets[$acount]->name = substr($retrievedData, 0, (strpos($retrievedData, ',')-1));
	$pos = strpos($retrievedData, ',');
	//echo "Pet Name: ", $pets[$acount]->name, " Creature ID ", $pets[$acount]->creatureID,	" Level - ", $pets[$acount]->level, "<br/>";
	//echo "Quality of pet: ", $pets[$acount]->quality, " Health - ", $pets[$acount]->health, " Power - ", $pets[$acount]->power," Speed - ", $pets[$acount]->speed,"<br/>";
	$acount = $acount + 1;
}

//Does the sort of the array
usort($pets, "cmp_by_name");

//file_put_contents($file, $pets);
echo "Amount of pets collected : ", $acount, "<br/>";
return $pets;
echo "<br/>Done";
?>