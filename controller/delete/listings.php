<?php
  //then make the rules for the get request
  if(isset($_DELETE['id'])){
    DeleteListing($_DELETE['id']);
    echo "deleted!";
  }
?>