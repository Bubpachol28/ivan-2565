<?php

  require ('database.php');
  
  if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $User_ID = $_POST['user_id'];
    $sql = "UPDATE notification SET N_Read = 'true' WHERE N_ToUser = $User_ID AND N_Read = 'false'";
    $query = mysqli_query($connect, $sql);
  }

?>