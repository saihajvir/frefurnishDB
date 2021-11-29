<?php
  // //then make the rules for the get request

  // if(isset($_PATCH['name']) && isset($_PATCH['id'])){
  //   UpdateName($_PATCH['name'], $_PATCH['id']);
  //   echo "updated!";
  // }

  if(isset($_PATCH['fuid'])){

    UpdateUser($_PATCH);
    echo "updated!";
  }
?>