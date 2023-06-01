<?php

  require ('database.php');
  
  if (isset($_POST['id_start']) && !empty($_POST['id_start']) && isset($_POST['id_dock']) && !empty($_POST['id_dock']) && (isset($_POST['date']) && $_POST['date'] != null)) {
    $start_ = $_POST['id_start'];
    $dock_ = $_POST['id_dock'];
    $date_ = $_POST['date'];
    $sql = "SELECT * FROM reservation INNER JOIN dock_car ON reservation.Dock_car_id = dock_car.Dock_car_id JOIN van ON dock_car.Van_ID = van.Van_ID WHERE reservation.Dock_car_id = {$dock_} AND reservation.Station_Start = {$start_} AND reservation.Go_Date = '{$date_}' LIMIT 1";
    $query = mysqli_query($connect, $sql);
    $num_row_query = mysqli_num_rows($query);
    if($num_row_query >= 1) {
      $sql_find = "SELECT *, SUM(reservation.Re_Seate) AS Sum_Re_Seate FROM reservation INNER JOIN dock_car ON reservation.Dock_car_id = dock_car.Dock_car_id JOIN van ON dock_car.Van_ID = van.Van_ID WHERE reservation.Dock_car_id = {$dock_} AND reservation.Station_Start = {$start_} AND reservation.Go_Date = '{$date_}' LIMIT 1";
      $query_find = mysqli_query($connect, $sql_find);
      foreach ($query_find as $value_1) {
        $havechair = $value_1['Seats_Num'] - $value_1['Sum_Re_Seate'];
        echo $havechair;
      }
    } else {
      $sql_totalchair = "SELECT * FROM dock_car INNER JOIN van ON dock_car.Van_ID = van.Van_ID WHERE Dock_car_id = {$dock_} LIMIT 1";
      $query_totalchair = mysqli_query($connect, $sql_totalchair);
      foreach ($query_totalchair as $value_2) {
        echo $value_2['Seats_Num'];
      }
    }
  }
?>