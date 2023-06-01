<?php
// เซสชั่นป้องกัน
$ses_timestamp_kick_comp = $session->get('ses_timestamp_kick');
if (isset($ses_timestamp_kick_comp) && !empty($ses_timestamp_kick_comp)) {
?>
  <script src="<?php echo base_url('javascript/jquery-3.6.0.min.js'); ?>"></script>
  <script type="text/javascript">
    function timeref() {
      var refresh = 800;
      mytime = setTimeout('sessionTime()', refresh)
    }

    function sessionTime() {
      var dtime = new Date();
      var timestamp = dtime.getTime();
      if (<?php echo $ses_timestamp_kick_comp; ?> == -1) {

      } else if (timestamp >= "<?php echo $ses_timestamp_kick_comp . "000"; ?>") {
        swal({
          title: "เซสชั่นหมดอายุ!",
          text: "โปรดทำการเข้าสู่ระบบใหม่อีกครั้ง เพื่อใช้งานต่อ",
          icon: "warning",
          button: "เข้าสู่ระบบ",
        }).then(function() {
          location.href = "<?php echo base_url('/logout'); ?>";
        });
      }
      timeref();
      var timecheck = timestamp - <?php echo $session->get('ses_timestamp_kick') . "000"; ?>;
      // console.log(timecheck);
    }
    $(document).ready(sessionTime);
  </script>
<?php
} else {
}

// ข้อมูลบนแถบตัวเลือก 
$data = $model->where('User_ID', $ses_userid)->join('u_position', 'users.Pos_ID = u_position.Pos_ID')->first();
$data_sending['Q_ID'] = $data['User_ID'];
$data_sending['Q_F_Name'] = $data['F_Name'];
$data_sending['Q_L_Name'] = $data['L_Name'];
$data_sending['Q_Email'] = $data['Email'];
$data_sending['Q_Phone'] = $data['Phone'];
$data_sending['Q_Pos_ID'] = $data['Pos_ID'];
$Q_Pos_ID = $data['Pos_ID'];
$data_sending['Q_Pos_Name'] = $data['Pos_Name_TH'];
$data_sending['Q_Facebook'] = $data['Facebook'];
if ($data['Facebook'] == '' || $data['Facebook'] == null) {
  if (isset($data['Pic']) && $data['Pic'] != null) {
    $data_sending['Q_Picture'] = base_url('uploads/userProfile/' . $data['Pic']);
  } else {
    $data_sending['Q_Picture'] = base_url('images/no-picture.png');
  }
} else {
  if (str_contains($data['Pic'], '.')) {
    $data_sending['Q_Picture'] = base_url('uploads/userProfile/' . $data['Pic']);
  } else {
    $data_sending['Q_Picture'] = "http://graph.facebook.com/" . $data['Facebook'] . "/picture";
  }
}

// การแจ้งเตือนตรงระฆัง
$model_notification_comp = new \App\Models\NotificationModel();
// ถอนด้านล่างออก เนื่องจากทำให้เว็บไซต์เกิดความล่าช้า มีปัญหาที่ Paginate
// $data_sending['notification'] = $model_notification_comp
//   ->where('N_ToUser', $ses_userid)
//   ->orderBy('N_AddDT', 'DESC')
//   ->paginate(5);
// จึงใช้อีกรูปแบบแทน
$data_sending['notification'] = $model_notification_comp->getNotification();

$data_sending['pager'] = $model_notification_comp->pager;
$data_sending['countnotification_unread'] = $model_notification_comp->CountNotificationOfUser_unread();
$data_sending['countnotification'] = $model_notification_comp->CountNotificationOfUser();

// ปุ่มนำไปรับตั๋ว
$model_payment_comp = new \App\Models\PaymentModel();
$data_payment_comp = $model_payment_comp->getReservationAfterConfirm($ses_userid);
foreach ($data_payment_comp as $value) {
  $data_sending['Pay_ID_Nav'] = $value['Pay_ID'];
  $payId_comp = $value['Pay_ID'];
  $data_sending['Reserve_ID_Nav'] = $value['Reserve_ID'];
  $data_sending['Confirm_Nav'] = $value['Confirm'];
}
$model_ticket_comp = new \App\Models\TicketModel();
if (isset($payId_comp) && !empty($payId_comp)) {
  $data_sending['CheckTicket_Nav'] = $model_ticket_comp->check_ticket($payId_comp);
}

?>