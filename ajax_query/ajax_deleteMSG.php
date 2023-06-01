<?php

  require ('database.php');

  if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $User_ID = $_POST['user_id'];
    $sql = "DELETE FROM notification WHERE N_ToUser = $User_ID";
    $query = mysqli_query($connect, $sql);
  }

?>