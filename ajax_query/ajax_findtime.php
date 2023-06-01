<?php

require ('database.php');
    
  if (isset($_POST['id_start'])) {
    $start_ = $_POST['id_start'];
    $date_ = $_POST['date'];
    $datenow = date("Y-m-d");
    $timenow = date("H:i:s");

    $sql_check_date = "SELECT * FROM dock_car WHERE Festival_Date = '$date_' ORDER BY Dock_car_id DESC";
    $query_check_date = mysqli_query($connect, $sql_check_date);
    $row_query_check_date = mysqli_num_rows($query_check_date);
    if ($row_query_check_date >= 1) {
      if ($date_ == $datenow) {
        $sql = "SELECT * FROM dock_car INNER JOIN van ON dock_car.Van_ID = van.Van_ID WHERE Station_ID = $start_ AND Van_Out > '$timenow' GROUP BY Van_Out ORDER BY Van_Out ASC";
      } else {
        $sql = "SELECT * FROM dock_car INNER JOIN van ON dock_car.Van_ID = van.Van_ID WHERE Station_ID = $start_ ORDER BY Van_Out ASC, Dock_car_id DESC";
      }
      $query = mysqli_query($connect, $sql);
      $rowfindtime = mysqli_num_rows($query);
      echo '<option value="" class="hide-selected">เวลา</option>';
      if ($rowfindtime <= 0) {
        echo '<option value="" class="text-center" disabled>---> ไม่มีรอบรถเวลานี้ <---</option>';
      }
      foreach ($query as $value) {
        $timeformat = date_create($value['Van_Out']);
        $fixtime = date_format($timeformat, "H.i");
        echo '<option value="'.$value['Dock_car_id'].'">'.$fixtime.'</option>';
      }
    } else {
      if ($date_ == $datenow) {
        $sql = "SELECT * FROM dock_car INNER JOIN van ON dock_car.Van_ID = van.Van_ID WHERE Station_ID = $start_ AND Van_Out > '$timenow' AND Festival_Date = '0000-00-00' OR Festival_Date = null GROUP BY Van_Out ORDER BY Van_Out ASC";
      } else {
        $sql = "SELECT * FROM dock_car INNER JOIN van ON dock_car.Van_ID = van.Van_ID WHERE Station_ID = $start_ AND Festival_Date = '0000-00-00' OR Festival_Date = null GROUP BY Van_Out ORDER BY Van_Out ASC";
      }
      $query = mysqli_query($connect, $sql);
      $rowfindtime = mysqli_num_rows($query);
      echo '<option value="" class="hide-selected">เวลา</option>';
      if ($rowfindtime <= 0) {
        echo '<option value="" class="text-center" disabled>---> ไม่มีรอบรถเวลานี้ <---</option>';
      }
      foreach ($query as $value) {
        $timeformat = date_create($value['Van_Out']);
        $fixtime = date_format($timeformat, "H.i");
        echo '<option value="'.$value['Dock_car_id'].'">'.$fixtime.'</option>';
      }
    }
  }
?>