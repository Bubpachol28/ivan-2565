<?php

require ('database.php');
    
  if (isset($_POST['id_start']) && isset($_POST['id_end'])) {
    $start_ = $_POST['id_start'];
    $end_ = $_POST['id_end'];
    $sql = "SELECT * FROM ticket_price WHERE Station_Start = $start_ AND Station_End = $end_ LIMIT 1";
    $query = mysqli_query($connect, $sql);
    foreach ($query as $value) {
      echo $value['Tic_Price'];
    }
  }
?>