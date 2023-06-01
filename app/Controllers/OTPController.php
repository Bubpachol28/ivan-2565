<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\UsersModel;
use App\Models\OTPModel;
use App\Models\SettingModel;

class OTPController extends Controller
{

  public function forgotPwd()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $email = $this->request->getVar('email');
    $phone = $this->request->getVar('phone');
    $model = new UsersModel();
    $model_otp = new OTPModel();
    $check_user_num = $model->check_user_byEmailPhone_num($email, $phone);
    if ($check_user_num == 1) {
      $check_user = $model->check_user_byEmailPhone($email, $phone);
      foreach ($check_user as $value) {
        $User_ID = $value['User_ID'];
      }
      function generateRandomString($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
      }
      $otp_code = generateRandomString(4);
      $key = generateRandomString(150);
      $end_key = generateRandomString(250);
      $n_1 = rand(0, 9);
      $n_2 = rand(0, 9);
      $n_3 = rand(0, 9);
      $n_4 = rand(0, 9);
      $n_5 = rand(0, 9);
      $n_6 = rand(0, 9);
      $otp = $n_1.$n_2.$n_3.$n_4.$n_5.$n_6;

      $model_setting = new SettingModel();
      $data_setting = $model_setting->get_setting();
      $otp_off_time = $data_setting->otp_off_time;

      $timeout = time() + $otp_off_time;

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
        CURLOPT_POSTFIELDS =>'{
          "sender": "'.$otp_name.'",
          "msisdn": ["'.$phone.'"],
          "message": "(Ref:'.$otp_code.') หมายเลข OTP ของคุณคือ '.$otp.'"
      }',
        CURLOPT_HTTPHEADER => array(
          'Authorization: Bearer '.$otp_token,
          'Content-Type: application/json'
        ),
      ));
  
      $response = json_decode(curl_exec($curl));
  
      curl_close($curl);

      $thsms_status = $response->success;
      if ($thsms_status == true) {
        $data = [
          'TimeToSend' => time(),
          'TimeToOut' => $timeout,
          'Refer' => $otp_code,
          'Number' => $otp,
          'OTP_Key' => $key,
          'End_Key' => $end_key,
          'ToPhone' => $phone,
          'User' => $User_ID,
          'Type' => 1,
        ];
        $model_otp->save($data);
        $session->setFlashdata('swel_title', 'ข้อมูลถูกต้อง');
        $session->setFlashdata('swel_text', 'ระบบกำลังส่ง OTP ไปยังเบอร์โทรศัพท์หมายเลข '.$phone);
        $session->setFlashdata('swel_icon', 'success');
        $session->setFlashdata('swel_button', 'ดำเนินการต่อ');
        return redirect()->to('/confirm-otp?refer='.$otp_code.'&key='.$key);
      } else {
        $thsms_code = $response->code;
        $thsms_errors = $response->errors;
        $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
        if ($thsms_code == "422") {
          $session->setFlashdata('swel_text', 'จำนวนการส่ง SMS ของระบบหมดลงแล้ว โปรดรอการแก้ไข ('.$thsms_code.')');
        } else if ($thsms_code == "404") {
          $session->setFlashdata('swel_text', 'ไม่พบผู้ส่ง SMS ของระบบ โปรดรอการแก้ไข ('.$thsms_code.')');
        } else {
          $session->setFlashdata('swel_text', $thsms_errors.' ('.$thsms_code.')');
        }
        $session->setFlashdata('swel_icon', 'error');
        $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
        return redirect()->to('/forgot-password');
      }
    } else {
      $session->setFlashdata('swel_title', 'ไม่พบข้อมูล');
      $session->setFlashdata('swel_text', 'อีเมล หรือรหัสผ่าน ไม่สอดคล้องกับข้อมูลในระบบ!');
      $session->setFlashdata('swel_icon', 'error');
      $session->setFlashdata('swel_button', 'ลองอีกครั้ง');

      $session->setFlashdata('email', $email);
      $session->setFlashdata('phone', $phone);
      return redirect()->to('/forgot-password');
    }
  }

  public function reset_password()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    helper(['form']);
    $rules = [
      'otp' => [
        'rules' => 'required|min_length[6]|max_length[6]',
        'errors' => [
          'required' => 'โปรดระบุรหัส OTP!',
          'min_length' => 'รหัส OTP จะต้องมีความยาวอย่างน้อย 6 ตัวอักษร',
          'max_length' => 'รหัส OTP จะต้องมีความยาวไม่เกิน 6 ตัวอักษร',
        ],
      ],
    ];
    $otp = $this->request->getVar('otp');
    $refer = $this->request->getVar('refer');
    $key = $this->request->getVar('key');
    if ($this->validate($rules)) {
      $model_otp = new OTPModel();
      $con_otp = $model_otp->confirm_otp_type_1_model($otp, $refer, $key);
      if (isset($con_otp) && !empty($con_otp) && $con_otp >= 1) {
        $session->setFlashdata('swel_title', 'สำเร็จ');
        $session->setFlashdata('swel_text', 'คุณสามารถเปลี่ยนรหัสผ่านได้แล้วในขณะนี้');
        $session->setFlashdata('swel_icon', 'success');
        $session->setFlashdata('swel_button', 'ดำเนินการต่อ');
        // เพิ่มเวลา otp_key_off_time นาที ในการเปลี่ยนรหัสผ่าน!

        $model_setting = new SettingModel();
        $data_setting = $model_setting->get_setting();
        $otp_key_off_time = $data_setting->otp_key_off_time;

        $model_otp->update_TimestampAfterConfirmOTP($otp, $refer, $key, $otp_key_off_time);
        $get_end_key = $model_otp->getEndKey($otp, $refer, $key);
        foreach ($get_end_key as $value) {
          $User_ID = $value['User'];
          $end_key = $value['End_Key'];
        }
        $model_otp->delete_OtherData_ByUserID_Type1($User_ID);
        return redirect()->to('/new-password?pwd='.$end_key);
      } else {
        $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
        $session->setFlashdata('swel_text', 'ไม่พบข้อมูล หรือคีย์นี้อาจหมดอายุ!');
        $session->setFlashdata('swel_icon', 'error');
        $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
        return redirect()->to('/forgot-password');
      }
    } else {
      $validation = $this->validator->listErrors();
      $session->setFlashdata('validation', $validation);
      return redirect()->to('/confirm-otp?refer='.$refer.'&key='.$key);
    }
  }
}
