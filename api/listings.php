<?php
require_once("config.php");
require_once('model/listings.php');
//GetMovies();
//exit;

/*
  Have a user login with their Firebase authentication
  Create movies for their account
  Get movies that belongs to their account
  Get all the movies from every account
  Update and Delete movies from their account
*/

//if you send an variable name movies using a get request, and assign the value all, then I will send back all the movies
if($_SERVER['REQUEST_METHOD'] == 'GET'){
  require_once("controller/get/listings.php");
}

//if you send a new movie name over under the variable movie_name, then I will add a new move to the database
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  require_once("controller/post/listings.php");
}

if($_SERVER['REQUEST_METHOD'] == 'PATCH'){
  require_once("controller/patch/listings.php");
}

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
  require_once("controller/delete/listings.php");
}
?>