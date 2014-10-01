<?php
/*

	This page is to be called from httpone.php where
	that will send a HTTP request (GET or HEAD) with
	"Testin" in the header.

	This page can be executed alone and you can
	use web browsers that sends custom HTTP requests.
	(An example would be Firefox's Firebug.)

*/

date_default_timezone_set('America/Chicago');

header("HTTPtwo-loaded: true"); //responding

//only respond when it received "Testin" in the header
if(isset(getallheaders()['Testin'])){
	header("Testout: good news, it works"); //responding
}


//OUTPUT...

echo "<p>Requests (httptwo.php)...";
var_dump(getallheaders()); //request headers
echo "</p>";


echo "<p>To Respond (httptwo.php)...";
var_dump(headers_list()); //responses headers
echo "</p>";

exit;
?>