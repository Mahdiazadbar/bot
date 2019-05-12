<?php

include 'database.php';


$post = file_get_contents('php://input');
$result = json_decode($post, true);

$mac = $result["mac"];


$myfunc = new func();




$response["list"] = array();
$query = $myfunc->database_helper()->query("select * from tbl");

$i = 0;
if ($query->num_rows > 0) {
    while($row = $query->fetch_assoc()) {
        $i++;
        if ($row["state"] == 1) {


            $na = $row["uname"];
            array_push($response["list"], $na);

        }
    }
} else {
    echo "0 results";


}


$response["success"] = true;


echo json_encode($response);


?>