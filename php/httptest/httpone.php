<?php
/*
	HTTP request/response test with cURL.
	Make sure you have the cURL extension enabled
	in your PHP configuration. (php.ini)

	This page calls httptwo.php through HTTP and retrive
	headers from both this and httptwo.php.

	You can also visit httptwo.php as well!
*/

date_default_timezone_set('America/Chicago');

header("done: yes"); //responding...

echo "<p>Requests (httpone.php)...<br/>";
var_dump(getallheaders()); //requests...
echo "</p>";

//START cURL...

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://".$_SERVER['HTTP_HOST']."/httptwo.php");
curl_setopt($ch, CURLOPT_HEADER,true); //outputs the header info

//If this is true, cURL will NOT include the body
//when curl_exec() is called. This would use the HEAD
//HTTP method. If false, curl_exec() includes the body in the 
//returing string.
//Regardless, httptwo.php will still execute.

curl_setopt($ch, CURLOPT_NOBODY,false);


//to allow curl_exec() to return a string

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


//sending an http request...
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Testin: does it work?'
));

$result = curl_exec($ch);
$header = substr($result, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
$header = explode("\r\n",$header );
$body = substr($result, curl_getinfo($ch, CURLINFO_HEADER_SIZE));

curl_close($ch);
//END of cURL


//OUTPUT...
echo $body;

echo "<p>Responses (httptwo.php from httpone.php)...<br/>";
var_dump($header);
echo "</p>";


echo "<p>To Respond (httpone.php)...<br/>";
var_dump(headers_list());
echo "</p>";

exit();
?>