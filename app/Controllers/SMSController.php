<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

use App\Models\UsersModel;
use App\Models\SettingModel;

class SMSController extends BaseController
{ 
  use ResponseTrait;

  public function check_credit()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    $model = new UsersModel();
    require_once(APPPATH . 'Controllers/components/user_connect.php');
    if (isset($Q_Pos_ID)) {
      if ($Q_Pos_ID >= 4) {

        $model_setting = new SettingModel();
        $data_setting = $model_setting->get_setting();
        $otp_token = $data_setting->otp_token;

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://thsms.com/api/me',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$otp_token,
            'Content-Type: application/json'
          ),
        ));
        $data_sending['response'] = json_decode(curl_exec($curl));
        curl_close($curl);
        return view('admin/check_credit', $data_sending);
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