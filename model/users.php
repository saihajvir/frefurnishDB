<?php

require_once("model/connect.php");

// GET FUNCTIONS

function GetUsers(){
    global $db;
  
    $stmt = $db->prepare('SELECT * FROM `users`');
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_CLASS);
}

function GetUsersById($id=null)
{
  global $db;

  $stmt = $db->prepare("SELECT * FROM `users` WHERE `users`.`id` = :id;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $stmt->execute
  (
    array(":id"=>$id)
  );

  return $stmt->fetchAll(PDO::FETCH_CLASS);
}

function GetUsersByFuid($fuid=null)
{
  global $db;

  $stmt = $db->prepare("SELECT *, `users`.`description` AS bio FROM `users` WHERE `users`.`fuid` = :fuid;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $stmt->execute
  (
    array(":fuid"=>$fuid)
  );

  return $stmt->fetchAll(PDO::FETCH_CLASS);
}

function GetUsersByName($name=null)
{
  global $db;

  $stmt = $db->prepare("SELECT * FROM `users` WHERE name = :name;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $stmt->execute
  (
    array(":name"=>$name)
  );

  return $stmt->fetchAll(PDO::FETCH_CLASS);
}
// -------------------------------------------------------------------------------------------------------------------------

// POST FUNCTIONS
function AddUser(
  $fuid,
  $worker,
  $name,
  $phone,
  $email,
  $password

  )

{
    global $db;

    $stmt = $db->prepare
    (
      "INSERT INTO `users` 
      (
        `id`,
        `fuid`,
        `worker`,
        `name`,
        `phone`,
        `email`,
        `password`
        ) 
        VALUES
        (
          NULL,
          :fuid,
          :worker,
          :name,
          :phone,
          :email,
          :password)",

          array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY)
        );

    $stmt->execute
    (
      array
      (
        ":fuid"=>$fuid,
        ":worker"=>$worker,
        ":name"=>$name,
        ":phone"=>$phone,
        ":email"=>$email,
        ":password"=>$password
 
      ));

    return $db->lastInsertId();
}

// -------------------------------------------------------------------------------------------------------------------------

// PATCH FUNCTIONS
function UpdateUser($parr){
  global $db;

  if(!isset($parr['fuid'])){
    return false;
  }

  $str = array();
  $arr = array();

  if(isset($parr['name'])){
    array_push($str, "`name` = :name");
    $arr[':name'] = $parr['name'];
  }

  if(isset($parr['pimage'])){
    array_push($str, "`pimage` = :pimage");
    $arr[':pimage'] = $parr['pimage'];
  }

  if(isset($parr['phone'])){
    array_push($str, "`phone` = :phone");
    $arr[':phone'] = $parr['phone'];
  }

  if(isset($parr['address'])){
    array_push($str, "`address` = :address");
    $arr[':address'] = $parr['address'];
  }

  if(isset($parr['workplace'])){
    array_push($str, "`workplace` = :workplace");
    $arr[':workplace'] = $parr['workplace'];
  }

  if(isset($parr['description'])){
    array_push($str, "`description` = :description");
    $arr[':description'] = $parr['description'];
  }

  if(isset($parr['credentials'])){
    array_push($str, "`credentials` = :credentials");
    $arr[':credentials'] = $parr['credentials'];
  }

  $s = implode(', ', $str);
  
  $stmt = $db->prepare("UPDATE `users` SET {$s} WHERE `users`.`fuid` = :fuid;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  $stmt->execute($parr);
}

// -------------------------------------------------------------------------------------------------------------------------

// DELETE FUNCTIONS

function DeleteUser($id=NULL){
    global $db;
  
    if($id == NULL){
      return false;
    }  
  
    $stmt = $db->prepare("DELETE FROM `users` WHERE `users`.`id` = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    
    $stmt->execute
    (
      array
      (
        ":id"=>$id
      )
    );  
}    

