<?php

  require ('database.php');
  
  if (isset($_POST['pay_id'])) {
    $pay_id = $_POST['pay_id'];
    $user_id = $_POST['user_id'];
    $sql = "UPDATE payment SET Confirm = 'success' WHERE Pay_ID = $pay_id";
    $query = mysqli_query($connect, $sql);
    $N_AddDT = date("Y-m-d H:i:s");
    $N_Message = "การชำระเงินหมายเลข #PAY".$pay_id." เสร็จสมบูรณ์ ตอนนี้คุณสามารถรับตั๋วได้ที่หน้าตรวจสอบสถานะการจอง ☺";
    $N_ToUser = $user_id;
    $sql_noti = "INSERT INTO notification(N_AddDT,N_Message,N_Read,N_ToUser) VALUE ('$N_AddDT','$N_Message','false','$N_ToUser')";
    $query_noti = mysqli_query($connect, $sql_noti);
  } else {
    echo '<script type="text/javascript">alert("มีบางอย่างผิดพลาดในการลบข้อมูลการชำระเงิน!")</script>';
  }

?>