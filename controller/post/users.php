<?php
// //make the rules
// if(isset($_POST['email'])){
//   //do a select to see if the same movie_name exists in the database, if it does not, then add the movie
//   $users = GetUsersByEmail($_POST['email']);
//   if(count($users)==0){
//     $lastid = AddUser($_POST['email']);
//     echo json_encode($lastid);
//   } else {
//     echo 'user exists!';
//   }
// }


//make the rules
if(
    isset(
        $_POST['fuid'],
        $_POST['worker'],
        $_POST['name'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['password']

    )
) {
    AddUser(
        $_POST['fuid'],
        $_POST['worker'],
        $_POST['name'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['password'],
      
    );
    
    echo 'added user';
}

?>