<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\SettingModel;

class SettingController extends BaseController
{

  public function setting()
  {
    require_once(APPPATH . 'Controllers/components/setting.php');
    $session = session();
    $ses_userid = $session->get('ses_id');
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 4) {
        $model_setting = new SettingModel();
        $setting_data = $model_setting->get_setting();
        $data_sending['otp_sender'] = $setting_data->otp_sender;
        $data_sending['otp_token'] = $setting_data->otp_token;
        $data_sending['otp_off_time'] = $setting_data->otp_off_time;
        $data_sending['otp_key_off_time'] = $setting_data->otp_key_off_time;
        $data_sending['session_timeout'] = $setting_data->session_timeout;
        $data_sending['pay_time_off'] = $setting_data->pay_time_off;
        $data_sending['fb_app_id'] = $setting_data->fb_app_id;
        $data_sending['fb_app_secret'] = $setting_data->fb_app_secret;
        $data_sending['fb_default_graph_version'] = $setting_data->fb_default_graph_version;
        $data_sending['note'] = $setting_data->note;
        return view('admin/setting', $data_sending);
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

  public function save()
  {
    require_once(APPPATH . 'Controllers/components/setting.php');
    $session = session();
    $ses_userid = $session->get('ses_id');
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 4) {
        $data = [
          'otp_sender' => $this->request->getvar('otp_sender'),
          'otp_token' => $this->request->getvar('otp_token'),
          'otp_off_time' => $this->request->getvar('otp_off_time'),
          'otp_key_off_time' => $this->request->getvar('otp_key_off_time'),
          'session_timeout' => $this->request->getvar('session_timeout'),
          'pay_time_off' => $this->request->getvar('pay_time_off'),
          'fb_app_id' => $this->request->getvar('fb_app_id'),
          'fb_app_secret' => $this->request->getvar('fb_app_secret'),
          'fb_default_graph_version' => $this->request->getvar('fb_default_graph_version'),
          'note' => $this->request->getvar('note'),
        ];
        $model_setting = new SettingModel();
        $data_setting = $model_setting->update(1, $data);
        if ($data_setting) {
          $session->setFlashdata('swel_title', 'สำเร็จ!');
          $session->setFlashdata('swel_text', 'บันทึกข้อมูลลงฐานข้อมูลของระบบเรียบร้อยแล้ว');
          $session->setFlashdata('swel_icon', 'success');
          $session->setFlashdata('swel_button', 'ดำเนินการต่อ');
        } else {
          $session->setFlashdata('swel_title', $st_sw_title_errmysql);
          $session->setFlashdata('swel_text', $st_sw_text_errmysql);
          $session->setFlashdata('swel_icon', $st_sw_icon_errmysql);
          $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
        }
        return redirect()->to('/setting');
      }
    }
  }
}
