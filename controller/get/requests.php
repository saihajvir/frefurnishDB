<?php
//then make the rules for the get request
if(count($_GET) == 0)
{
  echo json_encode(GetRequests());
}

// else if(isset($_GET['fuid']))
// {
//     echo json_encode(GetRequestsByFuid($_GET['fuid']));

// }

else if(isset($_GET['fuid']))
{

  require("model/users.php");
  //echo "test";
  $user = (array) GetUsersByFuid($_GET['fuid'])[0];
  // var_dump($user["worker"]);

  if($user["worker"] == "worker")
  {
    echo json_encode(GetWorkerRequestsByFuid($_GET['fuid']));
  } else if($user["worker"] == "donor") {
    echo json_encode(GetDonorRequestsByFuid($_GET['fuid']));

  }
  // {
  //   echo json_encode(GetWorkerRequestsByFuid($_GET['fuid']));
  // } else if(isset($_GET['worker' == 'donor'])) {
  //   echo json_encode(GetDonorRequestsByFuid($_GET['fuid']));

  
}

else if(isset($_GET['listing_id']))
{
  echo json_encode(GetRequestsByListingId($_GET['listing_id']));
}
?>