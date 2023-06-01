<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\UsersModel;
use App\Models\PaymentModel;
use App\Models\ReservationModel;
use App\Models\StationModel;
use App\Models\BankListModel;
use App\Models\SettingModel;

class PaymentController extends Controller
{
  public function payment()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    require_once(APPPATH . 'Controllers/components/setting.php');
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      $model_banklist = new BankListModel();
      $data_sending['banklist'] = $model_banklist->findAll();
      $model_reservation = new ReservationModel();
      $data_reservation = $model_reservation->getReservationAfterConfirm($ses_userid);
      if(isset($data_reservation) && !empty($data_reservation)) {
        foreach ($data_reservation as $value) {
          $reservation_id = $value['Reserve_ID'];
        }
      } else {
        $session->setFlashdata('swel_title', 'ไม่พบข้อมูล');
        $session->setFlashdata('swel_text', 'ข้อมูลการจองของคุณอาจถูกลบ หรือยกเลิกโดยระบบ!');
        $session->setFlashdata('swel_icon', 'warning');
        $session->setFlashdata('swel_button', 'ย้อนกลับ');
        return redirect()->to('/reservation');
      }
      $model_payment = new PaymentModel();
      $data_payment = $model_payment->getPaymentByReserveId($ses_userid, $reservation_id);
      if(isset($data_payment) && !empty($data_payment)) {
        // พบข้อมูลการชำระเงิน ระบบจะคัดการจองนี้ออก
        $session->setFlashdata('swel_title', 'ไม่พบข้อมูล');
        $session->setFlashdata('swel_text', 'ข้อมูลการจองของคุณอาจถูกลบ หรือยกเลิกโดยระบบ!');
        $session->setFlashdata('swel_icon', 'warning');
        $session->setFlashdata('swel_button', 'ย้อนกลับ');
        return redirect()->to('/reservation');
      } else {

        $model_setting = new SettingModel();
        $data_setting = $model_setting->get_setting();
        $pay_time_off = $data_setting->pay_time_off;

        foreach ($data_reservation as $value) {
          $data_sending['Reserve_ID'] = $value['Reserve_ID'];
          $data_sending['Van_Out'] = $value['Van_Out']." น.";
          $data_sending['Go_Date'] = $value['Go_Date'];
          $first_Station = $value['Station_Start'];
          $end_station = $value['Station_End'];
          $model_station = new StationModel();
          $station_start = $model_station->getStationById_S($first_Station);
          $station_end = $model_station->getStationById_E($end_station);
          $data_sending['Station_Start'] = $station_start['Station_Name'];
          $data_sending['Station_End'] = $station_end['Station_Name'];
          $data_sending['Re_Seate'] = $value['Re_Seate'];
          $data_sending['Re_TimeStamp'] = $value['Re_TimeStamp'];
          $data_sending['Tic_Price'] = $value['Tic_Price'];
          $data_sending['Total_Price'] = $value['Total_Price'];
          $data_sending['TimeToPay'] = $pay_time_off;
          return view('payment', $data_sending);
        }
      }
    } else {
      $session->setFlashdata('swel_title', $st_sw_title_unlogin);
      $session->setFlashdata('swel_text', $st_sw_text_unlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_unlogin);
      $session->setFlashdata('swel_button', $st_sw_button_unlogin);
      return redirect()->to('/login');
    }
  }

  public function add_payment()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    if (isset($ses_userid)) {
      $bank_id = $this->request->getVar('radioBank');
      $reId = $this->request->getVar('reId');
      if (isset($reId) && !empty($reId)) {
        if (isset($bank_id) && !empty($bank_id)) {
          if (!file_exists($_FILES['slip']['tmp_name']) || !is_uploaded_file($_FILES['slip']['tmp_name'])) {
            $session->setFlashdata('bank_id', $bank_id);
            $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
            $session->setFlashdata('swel_text', 'โปรดอัพโหลดสลิปเพื่อยืนยันการชำระเงิน!');
            $session->setFlashdata('swel_icon', 'error');
            $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
            return redirect()->to('/payment');
          } else {
            $model_reservation = new ReservationModel();
            $data_reservation = $model_reservation->getReservationAfterConfirm_reId($ses_userid, $reId);
            if ($data_reservation) {
              foreach ($data_reservation as $value) {
                $Reserve_ID = $value['Reserve_ID'];
              }
              $fileimg =  $this->request->getFile('slip');
              $temp = explode(".", $_FILES["slip"]["name"]);
              $newfilename = "U".$ses_userid."R".$Reserve_ID."B".$bank_id.'.'.end($temp);
              $fileimg->move(ROOTPATH . 'uploads/slip', $newfilename, true);
              $data = [
                'User_ID' => $ses_userid,
                'Pay_DateTime' => date("Y-m-d H:i:s"),
                'Bank' => $bank_id,
                'Slip' => $newfilename,
                'Confirm' => "waiting",
                'Reserve_ID' => $Reserve_ID,
              ];
              $model_payment = new PaymentModel();
              $data_save_add_payment = $model_payment->save($data);
              if ($data_save_add_payment) {
                $session->setFlashdata('swel_title', 'ชำระเงินเรียบร้อยแล้ว!');
                $session->setFlashdata('swel_text', 'การชำระเงินของคุณจะได้รับการตรวจสอบภายใน 15 นาที');
                $session->setFlashdata('swel_button', 'รับทราบ');
                return redirect()->to('/checking');
              } else {
                $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
                $session->setFlashdata('swel_text', 'ไม่สามารถบันทึกข้อมูลลงบนระบบได้ โปรดลองใหม่อีกครั้ง!');
                $session->setFlashdata('swel_icon', 'error');
                $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
                return redirect()->to('/payment');
              }
            } else {
              $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
              $session->setFlashdata('swel_text', 'ไม่สามารถเชื่อมต่อกับฐานข้อมูลระบบได้ โปรดลองใหม่อีกครั้ง!');
              $session->setFlashdata('swel_icon', 'error');
              $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
              return redirect()->to('/payment');
            }
          }
        } else {
          $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
          $session->setFlashdata('swel_text', 'โปรดเลือกธนาคารที่ชำระเงินเพื่อยืนยันการชำระเงิน!');
          $session->setFlashdata('swel_icon', 'error');
          $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
          return redirect()->to('/payment');
        }
      } else {
        $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
        $session->setFlashdata('swel_text', 'ไม่พบข้อมูลการจอง โปรดลองใหม่อีกครั้ง!');
        $session->setFlashdata('swel_icon', 'error');
        $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
        return redirect()->to('/payment');
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

  public function cancel_payment()
  {
    $session = session();
    $pay_id = $this->request->getVar('pay_id');
    $reason = $this->request->getVar('reason');
    $data = [
      'Confirm' => "cancel",
      'Note' => $reason,
    ];
    $model_payment = new PaymentModel();
    $data_payment_cancel = $model_payment->update($pay_id, $data);
    if ($data_payment_cancel) {
      $session->setFlashdata('swel_title', 'การยกเลิกสำเร็จแล้ว');
      $session->setFlashdata('swel_text', 'ผู้ใช้จะได้รับการแจ้งเตือน และทราบหมายเหตุของการยกเลิก!');
      $session->setFlashdata('swel_icon', 'success');
      $session->setFlashdata('swel_button', 'ดำเนินการต่อ');
    } else {
      require_once(APPPATH . 'Controllers/components/setting.php');
      $session->setFlashdata('swel_title', $st_sw_title_unlogin);
      $session->setFlashdata('swel_text', $st_sw_text_unlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_unlogin);
      $session->setFlashdata('swel_button', $st_sw_button_unlogin);
      return redirect()->to('/login');
    }
    return redirect()->to('/check-payment');
  }

  public function connect_checking()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    if (isset($ses_userid)) {
      $model = new UsersModel();
      $model_ticket = new PaymentModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      $data_ticket = $model_ticket->getReservationAfterConfirm($ses_userid);
      if ($data_ticket) {
        foreach ($data_ticket as $value) {
          $p_status = $value['Confirm'];
          $p_note = $value['Note'];
          if ($p_note == "" || $p_note == null) {
            $p_note = "ไม่ระบุ";
          }
        }
        if ($p_status == "cancel") {
          $session->setFlashdata('swel_title', 'การจองถูกยกเลิก!');
          $session->setFlashdata('swel_text', 'หมายเหตุ: '.$p_note);
          $session->setFlashdata('swel_icon', 'error');
          $session->setFlashdata('swel_button', 'รับทราบ');
        } else if ($p_status == "success") {
          $session->setFlashdata('swel_title', 'ชำระเงินสำเร็จ!');
          $session->setFlashdata('swel_text', 'การจองของคุณได้รับการยืนยันแล้ว คุณสามารถรับตั๋วได้ที่ด่านล่าง');
          $session->setFlashdata('swel_icon', 'success');
          $session->setFlashdata('swel_button', 'รับทราบ');
        } else if ($p_status == "waiting") {

        } else {
          $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาดกับระบบ!');
          $session->setFlashdata('swel_text', 'โปรดติดต่อผู้ดูแลระบบ เพื่อตรวจสอบข้อผิดพลาด');
          $session->setFlashdata('swel_icon', 'error');
          $session->setFlashdata('swel_button', 'รับทราบ');
        }
        return redirect()->to('/checking');
      } else {
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

  public function manage_around()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 3) {
        $model_payment = new PaymentModel();
        $model_station = new StationModel();
        $data_sending['around_G'] = $model_payment->view_all_around_byReservation_G();
        $data_sending['around'] = $model_payment->view_all_around_byReservation();
        $data_sending['station'] = $model_station->getStation();
        return view('employee/manage_around', $data_sending);
      } else {
        $session->setFlashdata('swel_title', $st_sw_title_blockpage);
        $session->setFlashdata('swel_text', $st_sw_text_blockpage);
        $session->setFlashdata('swel_icon', $st_sw_icon_blockpage);
        $session->setFlashdata('swel_button', $st_sw_button_blockpage);
        return redirect()->to('/');
      }
    } else {
      $session->setFlashdata('swel_title', $st_sw_title_unlogin);
      $session->setFlashdata('swel_text', $st_sw_text_unlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_unlogin);
      $session->setFlashdata('swel_button', $st_sw_button_unlogin);
      return redirect()->to('/login');
    }
  }
}