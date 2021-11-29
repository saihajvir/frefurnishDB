<?php

  if(isset($_PATCH['id'])){

    UpdateRequest($_PATCH);
    echo "updated!";
  }
?>