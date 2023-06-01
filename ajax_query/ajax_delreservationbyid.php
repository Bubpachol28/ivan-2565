<?php

  require ('database.php');
  
  if (isset($_POST['reserve_id'])) {
    $Reserve_ID = $_POST['reserve_id'];
    $User_ID = $_POST['userid'];
    $sql = "DELETE FROM reservation WHERE User_ID = $User_ID AND Reserve_ID = $Reserve_ID";
    $query = mysqli_query($connect, $sql);
  } else {
    echo '<script type="text/javascript">alert("มีบางอย่างผิดพลาดในการยกเลิกการจอง!")</script>';
  }
?>