<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
set_include_path($_SERVER['DOCUMENT_ROOT']);

$httpbody = file_get_contents("php://input");
$json = json_decode($httpbody);
if($json != FALSE){

  //if you send a new movie name over under the variable movie_name, then I will add a new move to the database
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_POST = (array) $json;
  }

  if($_SERVER['REQUEST_METHOD'] == 'PATCH'){
    //echo "patch!";
    $_PATCH = (array) $json;
  }

  if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    //echo "patch!";
    $_DELETE = (array) $json;    
  }
} else {
  if($_SERVER['REQUEST_METHOD'] == 'PATCH'){
    parse_str($httpbody, $_PATCH);
  }
  if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    parse_str($httpbody, $_DELETE);
  }
}
?>
