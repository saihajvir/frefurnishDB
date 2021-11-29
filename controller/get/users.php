<?php
//then make the rules for the get request
if(count($_GET) == 0)
{
  echo json_encode(GetUsers());
}

else if(isset($_GET['fuid']))
{
    echo json_encode(GetUsersByFuid($_GET['fuid']));

}

else if(isset($_GET['name']))
{
  echo json_encode(GetUsersByName($_GET['name']));
}
?>