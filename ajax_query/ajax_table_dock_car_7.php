<?php

require ('database.php');
    
  if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $sql = "SELECT * FROM dock_car INNER JOIN van ON dock_car.Van_ID = van.Van_ID WHERE Station_ID = 7 AND Festival_Date = '$date'";
    $query = mysqli_query($connect, $sql);
    $row = mysqli_num_rows($query);
    if ($row >= 1) {
      // Festival
      $sql_list = "SELECT * FROM dock_car INNER JOIN van ON dock_car.Van_ID = van.Van_ID WHERE Station_ID = 7 ORDER BY Van_Out ASC";
      $query_list = mysqli_query($connect, $sql_list);
    } else {
      // Default
      $sql_list = "SELECT * FROM dock_car INNER JOIN van ON dock_car.Van_ID = van.Van_ID WHERE Station_ID = 7 AND Festival_Date = '0000-00-00' OR Festival_Date = null ORDER BY Van_Out ASC";
      $query_list = mysqli_query($connect, $sql_list);
    }
    foreach ($query_list as $value) {
      $timeFormat = date_create($value['Van_Out']);
      $timeFormat_New = date_format($timeFormat, "H.i"." น.");
      echo "<tr>";
      echo "<td class=\"tb-res-td\">";
      echo "<label class=\"form-check-label\" for=\"list_a".$value['Dock_car_id']."\">".$value['Van_Num']."</label>";
      echo "</td>";
      echo "<td class=\"tb-res-td\">";
      echo "<label class=\"form-check-label\" for=\"list_a".$value['Dock_car_id']."\">".$timeFormat_New."</label>";
      echo "</td>";
      echo "<tr>";
    }
  }
?>