<?php
  if(isset($_PATCH['id'])){

    UpdateListing($_PATCH);
    echo "updated!";
  }
?>