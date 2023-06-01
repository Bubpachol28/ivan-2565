<?php 

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
      $data_sending['Q_Picture'] = "http://graph.facebook.com/".$data['Facebook']."/picture";
    }
  }

  // การแจ้งเตือนตรงระฆัง
  $model_notification_comp = new \App\Models\NotificationModel();
  $data_sending['notification'] = $model_notification_comp
  ->where('N_ToUser', $ses_userid)
  ->orderBy('N_AddDT', 'DESC')
  ->paginate(5);
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