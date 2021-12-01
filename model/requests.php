<?php

require_once("model/connect.php");

// GET FUNCTIONS

function GetRequests(){
    global $db;
  
    $stmt = $db->prepare('SELECT * FROM `requests`');
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_CLASS);
}

function GetRequestsById($id=null)
{
  global $db;

  $stmt = $db->prepare("SELECT * FROM `requests` WHERE `requests`.`id` = :id;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $stmt->execute
  (
    array(":id"=>$id)
  );
  
  return $stmt->fetchAll(PDO::FETCH_CLASS);
}

function GetRequestsByListingId($listing_id=null)
{
  global $db;

  $stmt = $db->prepare("SELECT * FROM `requests` 
  LEFT JOIN `listings` ON `listings`.`id` = `requests`.`listing_id`
  LEFT JOIN `users` ON `users`.`fuid` = `requests`.`fuid`
  WHERE `requests`.`listing_id` = :listing_id;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $stmt->execute
  (
    array(":listing_id"=>$listing_id)
  );
  
  return $stmt->fetchAll(PDO::FETCH_CLASS);
}

// function GetRequestsByFuid($fuid=null)
// {
//   global $db;

//   $stmt = $db->prepare("SELECT * FROM `requests`
//   LEFT JOIN `listings` ON `listings`.`id` = `requests`.`listing_id`
//   LEFT JOIN `users` ON `users`.`fuid` = `listings`.`fuid`
//   WHERE `requests`.`fuid` = :fuid;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

//   $stmt->execute
//   (
//     array(":fuid"=>$fuid)
//   );
  
//   return $stmt->fetchAll(PDO::FETCH_CLASS);
// }

function GetWorkerRequestsByFuid($fuid=null)
{
  global $db;

  $stmt = $db->prepare("SELECT *, `donor`.`name` AS `dname`, `worker`.`name` AS `wname`, `requests`.`id` AS `rid`, `requests`.`status` AS `rstatus` FROM `requests`
  LEFT JOIN `listings` ON `listings`.`id` = `requests`.`listing_id`
  LEFT JOIN `users` AS `donor` ON `listings`.`fuid` = `donor`.`fuid`
  LEFT JOIN `users` AS `worker` ON `requests`.`fuid` = `worker`.`fuid`
  WHERE `requests`.`fuid` = :fuid;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $stmt->execute
  (
    array(":fuid"=>$fuid)
  );
  // var_dump($stmt);
  
  return $stmt->fetchAll(PDO::FETCH_CLASS);
}

function GetDonorRequestsByFuid($fuid=null)
{
  global $db;

  $stmt = $db->prepare("SELECT *, `donor`.`name` AS `dname`, `worker`.`name` AS `wname`, `requests`.`id` AS `rid`, `requests`.`status` AS `rstatus`, `donor`.`phone` AS `dphone`, `donor`.`address` AS `daddress` FROM `requests`
  LEFT JOIN `listings` ON `listings`.`id` = `requests`.`listing_id`
  LEFT JOIN `users` AS `donor` ON `listings`.`fuid` = `donor`.`fuid`
  LEFT JOIN `users` AS `worker` ON `requests`.`fuid` = `worker`.`fuid`
  WHERE `donor`.`fuid` = :fuid;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $stmt->execute
  (
    array(":fuid"=>$fuid)
  );
  // var_dump($stmt);
  
  return $stmt->fetchAll(PDO::FETCH_CLASS);
}


// function GetRequestsByFuid($fuid=null)
// {
//   global $db;

//   $stmt = $db->prepare("SELECT *, `donor`.`name` AS `dname`, `worker`.`name` AS `wname`, `donor`.`fuid` AS `dfuid`, `worker`.`fuid` AS `wfuid` FROM `requests`
//   LEFT JOIN `listings` ON `listings`.`id` = `requests`.`listing_id`
//   LEFT JOIN `users` AS `donor` ON `listings`.`fuid` = `donor`.`fuid`
//   LEFT JOIN `users` AS `worker` ON `requests`.`fuid` = `worker`.`fuid`
//   WHERE `requests`.`fuid` = :fuid;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

//   $stmt->execute
//   (
//     array(":fuid"=>$fuid)
//   );
  
//   return $stmt->fetchAll(PDO::FETCH_CLASS);
// }


function GetRequestsByName($listingName=null)
{
  global $db;

  $stmt = $db->prepare("SELECT * FROM `requests` WHERE listingName = :listingName;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $stmt->execute
  (
    array(":listingName"=>$listingName)
  );

  return $stmt->fetchAll(PDO::FETCH_CLASS);
}

  // -------------------------------------------------------------------------------------------------------------------------

// POST FUNCTIONS

function AddRequest(
    $listing_id,
    $fuid,
    $status
    )
  
  {
      global $db;

      $stmt = $db->prepare
      (
        "INSERT INTO `requests` 
        (
          `id`,
          `listing_id`,
          `fuid`,
          `status`
          ) 
          VALUES
          (
            NULL,
            :listing_id,
            :fuid,
            :status)",
            array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY)
          );
  
      $stmt->execute
      (
        array
        (
          ":listing_id"=>$listing_id,
          ":fuid"=>$fuid,
          ":status"=>$status
        ));
      
  
      return $db->lastInsertId();
  }

    // -------------------------------------------------------------------------------------------------------------------------

// PATCH FUNCTIONS
function UpdateRequest($parr){
    global $db;
  
    if(!isset($parr['id'])){
      return false;
    }
  
    $str = array();
    $arr = array();

    if(isset($parr['fuid'])){
      array_push($str, "`fuid` = :fuid");
      $arr[':fuid'] = $parr['fuid'];
    }
  
    if(isset($parr['meetingTime'])){
      array_push($str, "`meetingTime` = :meetingTime");
      $arr[':meetingTime'] = $parr['meetingTime'];
    }
  
    if(isset($parr['status'])){
      array_push($str, "`status` = :status");
      $arr[':status'] = $parr['status'];
    }

  
    $s = implode(', ', $str);
    
    $stmt = $db->prepare("UPDATE `requests` SET {$s} WHERE `requests`.`id` = :id;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $stmt->execute($parr);
  }

// -------------------------------------------------------------------------------------------------------------------------





?>

