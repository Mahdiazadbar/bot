<?php

ini_set('display_errors',1);
error_reporting(E_ALL);


include 'database.php';

$myfunc= new func();
$result=$myfunc->database_helper("SELECT * FROM seriallist WHERE startserial<='FC5089619' AND endserial>='FC5089619'");

while($row = $result->fetch_assoc()) {
   
   
    echo $row["startserial"];

}
?>