<?php
  $host = "localhost";
  // $username = "adminivan_ivan";
  // $password = "singtopza4112544";
  $username = "root";
  $password = "";
  $database = "adminivan_ivan";
  $connect = mysqli_connect($host,$username,$password,$database) or die ("ERROR CANT NOT FIND DATABASE");
  mysqli_set_charset($connect, "utf8mb4");
  date_default_timezone_set('Asia/Bangkok');
?>