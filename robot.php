<?php
include 'database.php';




define('BOT_TOKEN', '434702436:AAGqJZJ1HTwf6quxtKYTxFYxqi37SoUo3Pg');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
parse_str(file_get_contents("php://input"), $datax);             
$datax = json_decode(json_encode($datax));


function apiRequestWebhook($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }

  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }

  $parameters["method"] = $method;

  header("Content-Type: application/json");
  echo json_encode($parameters);
  return true;
}

function exec_curl_request($handle) {
  $response = curl_exec($handle);

  if ($response === false) {
    $errno = curl_errno($handle);
    $error = curl_error($handle);
    error_log("Curl returned error $errno: $error\n");
    curl_close($handle);
    return false;
  }

  $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
  curl_close($handle);

  if ($http_code >= 500) {
    // do not wat to DDOS server if something goes wrong
    sleep(10);
    return false;
  } else if ($http_code != 200) {
    $response = json_decode($response, true);
    error_log("Request has failed with error {$response['error_code']}: {$response['description']}\n");
    if ($http_code == 401) {
      throw new Exception('Invalid access token provided');
    }
    return false;
  } else {
    $response = json_decode($response, true);
    if (isset($response['description'])) {
      error_log("Request was successfull: {$response['description']}\n");
    }
    $response = $response['result'];
  }

  return $response;
}

function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }

  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }

  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = API_URL.$method.'?'.http_build_query($parameters);

  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);

  return exec_curl_request($handle);
}

function apiRequestJson($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }

  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }

  $parameters["method"] = $method;

  $handle = curl_init(API_URL);
	
	

  curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
  curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));


  return exec_curl_request($handle);
}

function processMessage($message,$payl) {

$myfunc= new func();


  $chat_id = $message['chat']['id'];
  $message_id = $message['message_id'];
  $text = $message['text'];
  
  $user=$message['from'];
  $userid=$user['id'];
  $first_name=$user['first_name'];
  $last_name=$user['last_name'];
  $username=$user['username'];
  
  

  
  
      $first_set = array('?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
    $second_set = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    $latin = range(0, 9);
    $text=str_replace($first_set, $latin, $text);
    $text= str_replace($second_set, $latin, $text);


   
   $query="insert into userid (userid,first_name,last_name,username) values ('$userid','$first_name','$last_name','$username')";
  $insert_user=$myfunc->database_helper($query);
   
   $da=date("Y-m-d H:i:s");
  $query="insert into searchedtext (userid,searchText,date) values ('$userid','$text','$da')";
  $insert_text=$myfunc->database_helper($query);
  


if ($text=="/start") {


apiRequestJson("sendMessage", array('chat_id' => $chat_id,"send_message"=>$message_id, "text" => "Hologram Approval Tools/Bot
Please insert the hologram code:", "parse_mode"=>"HTML"));

}else{
 $text = $text;
 
 

 
$result=$myfunc->database_helper("SELECT * FROM seriallist WHERE startserial<='$text' AND endserial>='$text'");


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
   
   
    $startserial=$row["startserial"];
	$endserial=$row["endserial"];
	
	 


	$l = $row["l"];
	$m = $row["m"];
	$n = $row["n"];
	$o = $row["o"];
	$p = $row["p"];
	$q = $row["q"];
	$r = $row["r"];
	
    $customer = $row["customer"];
    
	$customer = $row["customer"];
	$ref_num = $row["ref_num"];
	$date = $row["dateT"];
        
	
    }
	$missingcodes=array($l,$m,$n,$o,$p,$p,$q,$r);
	
	if (in_array($text, $missingcodes, true) || (strlen($text) < strlen($startserial) || strlen($text) > strlen($endserial))) {
		
			 apiRequestJson("sendMessage", array('chat_id' => $chat_id,"reply_to_message_id"=>$message_id,
 
  "text" => "❌ The Code is INVALID. Please insert new hologram code."));		
   
   }else{
	
	
       apiRequestJson("sendMessage", array('chat_id' => $chat_id,"reply_to_message_id"=>$message_id,
           
         
           "text" => "Hologram Code: $text
Product Ref: $ref_num
Hologram Date: $date
✅ Approved - Schneider Electric"));	
	   
   }
}else{
	
	
	
	///////////// کد وجود ندارد
	
		 apiRequestJson("sendMessage", array('chat_id' => $chat_id,"reply_to_message_id"=>$message_id,
 
  "text" => "❌ The Code is INVALID. Please insert new hologram code."));  
}



 apiRequestJson("sendMessage", array('chat_id' => $chat_id,"reply_to_message_id"=>$message_id, "text" => "Please insert the hologram code:", "parse_mode"=>"HTML"));  
}

 

}



$content = file_get_contents("php://input");
$update = json_decode($content, true);


if (isset($update["message"])) {
 processMessage($update["message"],$update);
  

}

//}
   
?>