<?php
//then make the rules for the get request
if(count($_GET) == 0)
{
  echo json_encode(GetListings());
}

else if(isset($_GET['id']))
{
  if(is_numeric($_GET['id']))
  {
    //get individual movies
    echo json_encode(GetListingsById($_GET['id']));
  } else{
    echo "invalid request";
  }

}

else if(isset($_GET['listingName']))
{
  echo json_encode(GetListingsByName($_GET['listingName']));
}
?>