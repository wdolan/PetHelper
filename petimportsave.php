<?php
//Software Engineering Fall 2013
//Team WoW
//Bill Dolan, Lindsay Coburn, Lewis Gilzeane, and Dan Jospeh
//Prints a list of all the pets that are available to be gotten.
//This page will primairy only be used by administration
//This uses a known player with all available pets in the US market to update the internal lists.

$_GET['realm']='Madoran';
$_GET['name']='Doobjanka';
include 'petimport.php';
$count = 0;

$ourFileName = 'testfile.php';
$filetest = "<?php";
//file_put_contents($ourFileName, $filetest);

echo '$acount=',$acount,";<br/>";

//Function to open the connection for data collection
function get_url_contents($url)
	{
        $crl = curl_init();
        $timeout = 5;
        curl_setopt ($crl, CURLOPT_URL,$url);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
	}

	//Sets the ability to get the types of pet for the pet that is found.
function get_creature_type($ID)
	{
		$typeurl= 'http://www.wowhead.com/npc=' . $ID;
		$typedata = get_url_contents($typeurl);
		$pos = (strpos($typedata, '\x2Dpetfamily\x2D')+17);
		$typedata = substr($typedata,$pos, strlen($typedata));
		$type = substr($typedata, 0, (strpos($typedata, 'x22')-1));
		return $type;
	}

//Loops to make sure that it is not pulling more information that is available and make a document formated with PHP for later usage
while($count<$acount)
{
	$link = '<a href="petdetails.php?ID=';
	$link = $link . $pets[$count]->creatureID;
	$link = $link . '">';
	echo '$pets[', $count,']->creatureID=', $pets[$count]->creatureID, ';<br/>';
	echo '$pets[', $count,']->quality=', $pets[$count]->quality, ';<br/>';
	echo '$pets[', $count,']->level=', $pets[$count]->level, ';<br/>';
	echo '$pets[', $count,']->health=', $pets[$count]->health, ';<br/>';
	echo '$pets[', $count,']->power=', $pets[$count]->power, ';<br/>';
	echo '$pets[', $count,']->speed=', $pets[$count]->speed, ';<br/>';
	echo '$pets[', $count,']->name="', $pets[$count]->name, '";<br/>';
	echo '$pets[', $count,']->type="', get_creature_type($pets[$count]->creatureID), '";<br/>';
	$count = $count+1;
}
echo '?>';
?>

