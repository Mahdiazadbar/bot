<?php

class func {

function database_helper($query){
	$servername = "localhost";
$username = "bot";
$password = "GITBmQAm2j";
$dbname = "bot";

$ourconnection = new mysqli($servername, $username, $password, $dbname);
$ourconnection->set_charset('utf8');
return $ourconnection->query($query);
}

}



?>