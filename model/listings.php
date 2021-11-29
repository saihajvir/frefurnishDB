<?php
require_once("model/connect.php");

// GET FUNCTIONS

function GetListings(){
    global $db;
  
    $stmt = $db->prepare('SELECT * FROM `listings`');
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_CLASS);
}

function GetListingsById($id=null)
{
  global $db;

  $stmt = $db->prepare("SELECT * FROM `listings` WHERE `listings`.`id` = :id;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $stmt->execute
  (
    array(":id"=>$id)
  );

  return $stmt->fetchAll(PDO::FETCH_CLASS);
}

function GetListingsByName($listingName=null)
{
  global $db;

  $stmt = $db->prepare("SELECT * FROM `listings` WHERE listingName = :listingName;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $stmt->execute
  (
    array(":listingName"=>$listingName)
  );

  return $stmt->fetchAll(PDO::FETCH_CLASS);
}

  // -------------------------------------------------------------------------------------------------------------------------

// POST FUNCTIONS
function AddListing(
    $fuid,
    $listingName,
    $listingDescription,
    $listingCondition,
    $listingDate,
    $listingLocation,
    $pickup,
    $image,
    $status,
    $details
    )
  
  {
      global $db;

      $stmt = $db->prepare
      (
        "INSERT INTO `listings` 
        (
          `id`,
          `fuid`,
          `listingName`,
          `listingDescription`,
          `listingCondition`,
          `listingDate`,
          `listingLocation`,
          `pickup`,
          `image`,
          `status`,
          `details`
          ) 
          VALUES
          (
            NULL,
            :fuid,
            :listingName,
            :listingDescription,
            :listingCondition,
            :listingDate,
            :listingLocation,
            :pickup,
            :image,
            :status,
            :details)",
            array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY)
          );
  
      $stmt->execute
      (
        array
        (
          ":fuid"=>$fuid,
          ":listingName"=>$listingName,
          ":listingDescription"=>$listingDescription,
          ":listingCondition"=>$listingCondition,
          ":listingDate"=>$listingDate,
          ":listingLocation"=>$listingLocation,
          ":pickup"=>$pickup,
          ":image"=>$image,
          ":status"=>$status,
          ":details"=>$details,
        ));
      
      var_dump($stmt);
  
      return $db->lastInsertId();
  }

  // -------------------------------------------------------------------------------------------------------------------------

// PATCH FUNCTIONS
function UpdateListing($parr){
    global $db;
  
    if(!isset($parr['id'])){
      return false;
    }
  
    $str = array();
    $arr = array();
  
    if(isset($parr['listingName'])){
      array_push($str, "`listingName` = :listingName");
      $arr[':listingName'] = $parr['listingName'];
    }
  
    if(isset($parr['image'])){
      array_push($str, "`image` = :image");
      $arr[':image'] = $parr['image'];
    }
  
    if(isset($parr['listingDescription'])){
      array_push($str, "`listingDescription` = :listingDescription");
      $arr[':listingDescription'] = $parr['listingDescription'];
    }
  
    if(isset($parr['listingCondition'])){
      array_push($str, "`listingCondition` = :listingCondition");
      $arr[':listingCondition'] = $parr['listingCondition'];
    }
  
    if(isset($parr['listingLocation'])){
      array_push($str, "`listingLocation` = :listingLocation");
      $arr[':listingLocation'] = $parr['listingLocation'];
    }
  
    if(isset($parr['pickup'])){
      array_push($str, "`pickup` = :pickup");
      $arr[':pickup'] = $parr['pickup'];
    }
  
    if(isset($parr['status'])){
      array_push($str, "`status` = :status");
      $arr[':status'] = $parr['status'];
    }

    if(isset($parr['details'])){
        array_push($str, "`details` = :details");
        $arr[':details'] = $parr['details'];
      }
  
    $s = implode(', ', $str);
    
    $stmt = $db->prepare("UPDATE `listings` SET {$s} WHERE `listings`.`id` = :id;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $stmt->execute($parr);
  }

// -------------------------------------------------------------------------------------------------------------------------

// DELETE FUNCTIONS

function DeleteListing($id=NULL){
    global $db;
  
    if($id == NULL){
      return false;
    }  
  
    $stmt = $db->prepare("DELETE FROM `listings` WHERE `listings`.`id` = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    
    $stmt->execute
    (
      array
      (
        ":id"=>$id
      )
    );  
}    

?>


