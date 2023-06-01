<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PaymentModel;
use App\Models\TicketModel;
use App\Models\StationModel;
use App\Models\SettingModel;

class TicketController extends BaseController
{

  public function booking_details()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      $model_ticket = new TicketModel();
      $data_ticket = $model_ticket->getTicket($ses_userid);
      if ($data_ticket) {
        foreach ($data_ticket as $value) {
          $data_sending['Tick_Code'] = $value['Tick_Code'];
          $data_sending['Go_Date'] = $value['Go_Date'];
          $data_sending['Van_Num'] = $value['Van_Num'];
          $model_station = new StationModel();
          $first_Station = $value['Station_Start'];
          $station_start = $model_station->getStationById_S($first_Station);
          $data_sending['Station_Start'] = $station_start['Station_Name'];
          $end_station = $value['Station_End'];
          $station_end = $model_station->getStationById_E($end_station);
          $data_sending['Station_End'] = $station_end['Station_Name'];
          $data_sending['Van_Out'] = $value['Van_Out'];
          $data_sending['Re_Seate'] = $value['Re_Seate'];
          $data_sending['Total_Price'] = $value['Total_Price'];
          $data_sending['lat'] = $value['Lat'];
          $data_sending['lng'] = $value['Lng'];
        }
        return view('booking_details', $data_sending);
      } else {
        $session->setFlashdata('swel_title', 'ไม่พบตั๋ว');
        $session->setFlashdata('swel_text', 'ไม่พบข้อมูลตั๋วของคุณ!');
        $session->setFlashdata('swel_icon', 'error');
        $session->setFlashdata('swel_button', 'กลับสู่หน้าหลัก');
        return redirect()->to('/');
      }
    } else {
      require_once(APPPATH . 'Controllers/components/setting.php');
      $session->setFlashdata('swel_title', $st_sw_title_unlogin);
      $session->setFlashdata('swel_text', $st_sw_text_unlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_unlogin);
      $session->setFlashdata('swel_button', $st_sw_button_unlogin);
      return redirect()->to('/login');
    }
  }

  public function print_ticket($ticket_code)
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      $model_ticket = new TicketModel();
      $data_ticket_row = $model_ticket->getTicket_byTicketId_row($ticket_code);
      if ($data_ticket_row >= 1) {
        $data_ticket = $model_ticket->getTicket_byTicketId($ticket_code);
        foreach ($data_ticket as $value) {
          $data_sending['Tick_Code'] = $value['Tick_Code'];
          $data_sending['Go_Date'] = $value['Go_Date'];
          $data_sending['Van_Num'] = $value['Van_Num'];
          $model_station = new StationModel();
          $first_Station = $value['Station_Start'];
          $station_start = $model_station->getStationById_S($first_Station);
          $data_sending['Station_Start'] = $station_start['Station_Name'];
          $end_station = $value['Station_End'];
          $station_end = $model_station->getStationById_E($end_station);
          $data_sending['Station_End'] = $station_end['Station_Name'];
          $data_sending['Van_Out'] = $value['Van_Out'];
          $data_sending['Re_Seate'] = $value['Re_Seate'];
          $data_sending['Total_Price'] = $value['Total_Price'];
        }
        return view('ticket', $data_sending);
      } else {
        $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
        $session->setFlashdata('swel_text', 'ไม่พบหมายเลขตั๋วที่ท่านต้องการ!');
        $session->setFlashdata('swel_icon', 'error');
        $session->setFlashdata('swel_button', 'รับทราบ');
        return redirect()->to('/');
      }
    } else {
      $model_ticket = new TicketModel();
      $data_ticket_row = $model_ticket->getTicket_byTicketId_row($ticket_code);
      if ($data_ticket_row >= 1) {
        $data_ticket = $model_ticket->getTicket_byTicketId($ticket_code);
        foreach ($data_ticket as $value) {
          $data_sending['Tick_Code'] = $value['Tick_Code'];
          $data_sending['Go_Date'] = $value['Go_Date'];
          $data_sending['Van_Num'] = $value['Van_Num'];
          $model_station = new StationModel();
          $first_Station = $value['Station_Start'];
          $station_start = $model_station->getStationById_S($first_Station);
          $data_sending['Station_Start'] = $station_start['Station_Name'];
          $end_station = $value['Station_End'];
          $station_end = $model_station->getStationById_E($end_station);
          $data_sending['Station_End'] = $station_end['Station_Name'];
          $data_sending['Van_Out'] = $value['Van_Out'];
          $data_sending['Re_Seate'] = $value['Re_Seate'];
          $data_sending['Total_Price'] = $value['Total_Price'];
        }
        return view('ticket', $data_sending);
      } else {
        $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
        $session->setFlashdata('swel_text', 'ไม่พบหมายเลขตั๋วที่ท่านต้องการ!');
        $session->setFlashdata('swel_icon', 'error');
        $session->setFlashdata('swel_button', 'รับทราบ');
        return redirect()->to('/');
      }
    }
  }

  public function his_reservation()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      $model_ticket = new TicketModel();
      $user_ID = $ses_userid;
      $data_ticket = $model_ticket->get_history($user_ID);
      $data_sending['history'] = $data_ticket;
      $model_station = new StationModel();
      $data_sending['Station_End_Name'] = $model_station->getStation();
      return view('his_reservation', $data_sending);
    } else {
      $session = session();
      require_once(APPPATH . 'Controllers/components/setting.php');
      $session->setFlashdata('swel_title', $st_sw_title_unlogin);
      $session->setFlashdata('swel_text', $st_sw_text_unlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_unlogin);
      $session->setFlashdata('swel_button', $st_sw_button_unlogin);
      return redirect()->to('/login');
    }
  }

  public function createTicket()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $Pay_ID = $this->request->getVar('pay');
    if (isset($ses_userid)) {
      $model_payment = new PaymentModel();
      $model_ticket = new TicketModel();
      $data_payment = $model_payment->getPaymentByPayId($ses_userid, $Pay_ID);
      if (isset($data_payment) && !empty($data_payment)) {
        $year = date("y");
        $month = date("m");
        $day = date("d");
        $format_user = (($ses_userid * $ses_userid) - $ses_userid) + 2;
        if ($format_user < 10) {
          $format_user = "0" . $format_user;
        }
        $format_payid = (($Pay_ID * $Pay_ID) - $Pay_ID) + 2;
        if ($format_payid < 10) {
          $format_payid = "0" . $format_payid;
        }
        $ticket_code = "IV" . $day . $format_user . $month . $format_payid . $year;
        $ticket_num_row = $model_ticket->check_ticket($Pay_ID);
        if ($ticket_num_row >= 1) {
          return redirect()->to('/booking-details');
        } else {
          $getPhoneByTicketId = $model_payment->getTicketDataByPayId($Pay_ID);
          foreach ($getPhoneByTicketId as $value) {
            $phone = $value['Phone'];
            $start_station = $value['Station_Start'];
            $end_station = $value['Station_End'];
            $go_date = $value['Go_Date'];
            $van_out = $value['Van_Out'];
            $van_num = $value['Van_Num'];
          }
          $van_out_format = date_create($van_out);
          $van_out_format = date_format($van_out_format, "H.i");
          $time_to_send = '';
          date('Y-m-d H:i:s', strtotime(strtotime($time_to_send)));
          $van_out_sub = new \DateTime($go_date . " " . $van_out);
          $van_out_sub->sub(new \DateInterval('PT10M'));
          $time_to_send = $van_out_sub->format('Y-m-d H:i:s');
          $model_station = new StationModel();
          $data_station_start = $model_station->getStationById_S($start_station);
          $name_station_start = $data_station_start['Station_Name'];
          $data_station_end = $model_station->getStationById_E($end_station);
          $name_station_end = $data_station_end['Station_Name'];

          $model_setting = new SettingModel();
          $data_setting = $model_setting->get_setting();
          $otp_name = $data_setting->otp_sender;
          $otp_token = $data_setting->otp_token;

          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://thsms.com/api/send-sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "sender": "' . $otp_name . '",
                "msisdn": ["' . $phone . '"],
                "message": "ตั๋วหมายเลข ' . $ticket_code . ' ต้นทางจาก' . $name_station_start . ' ไปยัง' . $name_station_end . ' รถจะออกจากสถานีเวลา ' . $van_out_format . ' น. ของวันนี้ หมายเลขรถของคุณคือ ' . $van_num . '",
                "scheduled_delivery": "' . $time_to_send . '"
              }',
            CURLOPT_HTTPHEADER => array(
              'Authorization: Bearer ' . $otp_token,
              'Content-Type: application/json'
            ),
          ));

          $response = json_decode(curl_exec($curl));

          curl_close($curl);

          $thsms_status = $response->success;
          if ($thsms_status == true) {
            $data = [
              'Tick_GetDateTime' => date("Y-m-d H:i:s"),
              'Tick_Code' => $ticket_code,
              'Pay_ID' => $Pay_ID,
            ];
            $save_ticket = $model_ticket->save($data);
            if ($save_ticket && isset($save_ticket)) {
              $session->setFlashdata('swel_title', 'การแจ้งเตือน');
              $session->setFlashdata('swel_text', 'ระบบจะทำการแจ้งเตือนไปยังเบอร์โทรศัพท์หมายเลข ' . $phone . ' ล่วงหน้า 10 นาที ก่อนที่รถจะเทียบท่าสถานี' . $name_station_start);
              $session->setFlashdata('swel_icon', 'success');
              $session->setFlashdata('swel_button', 'รับทราบ');
              return redirect()->to('/booking-details');
            } else {
              $session->setFlashdata('swel_title', 'ไม่พบข้อมูลตั๋ว');
              $session->setFlashdata('swel_icon', 'error');
              $session->setFlashdata('swel_button', 'รับทราบ');
              return redirect()->to('/checking');
            }
          } else {
            $thsms_code = $response->code;
            $thsms_errors = $response->errors;
            $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
            if ($thsms_code == "422") {
              $session->setFlashdata('swel_text', 'จำนวนการส่ง SMS ของระบบหมดลงแล้ว โปรดรอการแก้ไข (' . $thsms_code . ')');
            } else if ($thsms_code == "404") {
              $session->setFlashdata('swel_text', 'ไม่พบผู้ส่ง SMS ของระบบ โปรดรอการแก้ไข (' . $thsms_code . ')');
            } else {
              $session->setFlashdata('swel_text', $thsms_errors . ' (' . $thsms_code . ')');
            }
            $session->setFlashdata('swel_icon', 'error');
            $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
            return redirect()->to('/checking');
          }
        }
      } else {
        $session->setFlashdata('swel_title', 'ไม่พบข้อมูล');
        $session->setFlashdata('swel_text', 'ไม่พบข้อมูลการชำระเงิน หรืออาจถูกยกเลิกโดยระบบ!');
        $session->setFlashdata('swel_icon', 'error');
        $session->setFlashdata('swel_button', 'รับทราบ');
        return redirect()->to('/checking');
      }
    } else {
      require_once(APPPATH . 'Controllers/components/setting.php');
      $session->setFlashdata('swel_title', $st_sw_title_unlogin);
      $session->setFlashdata('swel_text', $st_sw_text_unlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_unlogin);
      $session->setFlashdata('swel_button', $st_sw_button_unlogin);
      return redirect()->to('/login');
    }
  }
}
