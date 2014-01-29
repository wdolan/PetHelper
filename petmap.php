<?php
//Software Engineering Fall 2013
//Team WoW
//Bill Dolan, Lindsay Coburn, Lewis Gilzeane, and Dan Jospeh
//Code that will pull and display map for pet location

// Sets the URL for pulling data
$url = "www.wowhead.com/npc=";
$url = $url . $_GET["ID"];
//echo "ID Url to be used -" , $url , "<br/>";
// Initializes counter for array of storage.
$acount = 0;

//Function to retrieve the data
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
//$page = '<html><head>';
$posdelete = (strpos($retrievedData,'<title>')-8);
$page = $page . (substr($retrievedData, (strpos($retrievedData,'<title>'))  , (strpos($retrievedData, '</title>')-$posdelete)));
$page = $page . get_url_contents('http://www.billdolan.net/header.html');
//Fall back to check if it has a map or not based on the site.
if(null==strpos($retrievedData, '</script><div>This NPC'))
{
	echo "No map for this pet <br/>";
	goto done;
}
$pos = (strpos($retrievedData, '</script><div>This NPC')+9);
$retrievedData = substr($retrievedData,$pos,strlen($retrievedData));
$page2 = substr($retrievedData,0,(strpos($retrievedData, "//]]></script>")+14));
$page2 = $page2 . "</body></html>";
done:
?>
