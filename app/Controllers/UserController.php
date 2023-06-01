<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\UsersModel;
use App\Models\OTPModel;
use App\Models\StationModel;
use App\Models\SettingModel;

class UserController extends Controller
{
  public function index()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    $model_station = new StationModel();
    $data_sending['station_getStations'] = $model_station->getStation();
    $data_sending['station_getStation_NK'] = $model_station->getStationNK();
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      return view('index', $data_sending);
    } else {
      return view('index', $data_sending);
    }
  }

  public function profile()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      return view('profile', $data_sending);
    } else {
      require_once(APPPATH . 'Controllers/components/setting.php');
      $session->setFlashdata('swel_title', $st_sw_title_unlogin);
      $session->setFlashdata('swel_text', $st_sw_text_unlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_unlogin);
      $session->setFlashdata('swel_button', $st_sw_button_unlogin);
      return redirect()->to('/login');
    }
  }

  public function editprofile()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      return view('editprofile', $data_sending);
    } else {
      require_once(APPPATH . 'Controllers/components/setting.php');
      $session->setFlashdata('swel_title', $st_sw_title_unlogin);
      $session->setFlashdata('swel_text', $st_sw_text_unlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_unlogin);
      $session->setFlashdata('swel_button', $st_sw_button_unlogin);
      return redirect()->to('/login');
    }
  }

  public function edit()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    helper(['form']);
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      $get_userId = $ses_userid;
      $get_email = $this->request->getVar('email');
      $data_users_email = $model->count_users_check_email($get_userId, $get_email);
      $get_phone = $this->request->getVar('phone');
      $data_users_phone = $model->count_users_check_phone($get_userId, $get_phone);
      $rules = [
        'firstname' => [
          'rules' => 'required|min_length[2]|max_length[25]',
          'errors' => [
            'required' => 'โปรดระบุชื่อ!',
            'min_length' => 'โปรดระบุชื่อที่ความยาวอย่างน้อย 2 ตัวอักษร',
            'max_length' => 'โปรดระบุชื่อที่ความยาวไม่เกิน 25 ตัวอักษร',
          ],
        ],
        'lastname' => [
          'rules' => 'required|min_length[2]|max_length[25]',
          'errors' => [
            'required' => 'โปรดระบุนามสกุล!',
            'min_length' => 'โปรดระบุนามสกุลที่ความยาวอย่างน้อย 2 ตัวอักษร',
            'max_length' => 'โปรดระบุนามสกุลที่ความยาวไม่เกิน 25 ตัวอักษร',
          ],
        ],
        'pic' => [
          'rules' => 'max_size[pic,2048]|ext_in[pic,png,jpg,jpge,gif]',
          'errors' => [
            'max_size' => 'ข้อผิดพลาด: รูปภาพต้องมีขนาดไม่เกิน 2MB',
            'ext_in' => 'ข้อผิดพลาด: โปรดใช้รูปภาพประเภท jpg, jpeg หรือ png',
          ],
        ],
      ];
      if ($data_users_email >= 1) {
        $rule_email = [
          'email' => [
            'rules' => 'required|min_length[5]|max_length[50]|valid_email',
            'errors' => [
              'required' => 'โปรดระบุอีเมล!',
              'valid_email' => 'รูปแบบของอีเมลไม่ถูกต้อง!',
            ],
          ],
        ];
      } else {
        $rule_email = [
          'email' => [
            'rules' => 'required|min_length[5]|max_length[50]|valid_email|is_unique[users.email]',
            'errors' => [
              'required' => 'โปรดระบุอีเมล!',
              'valid_email' => 'รูปแบบของอีเมลไม่ถูกต้อง!',
              'is_unique' => 'อีเมลนี้ถูกใช้แล้ว!',
            ],
          ],
        ];
      }
      if ($data_users_phone >= 1) {
        $rule_phone = [
          'phone' => [
            'rules' => 'required|min_length[10]|max_length[10]',
            'errors' => [
              'required' => 'โปรดระบุหมายเลขโทรศัพท์!',
              'min_length' => 'เบอร์โทรติดต่อต้องมีจำนวน 10 ตัวอักษร!',
              'max_length' => 'เบอร์โทรติดต่อต้องมีจำนวน 10 ตัวอักษร!',
            ],
          ],
        ];
      } else {
        $rule_phone = [
          'phone' => [
            'rules' => 'required|min_length[10]|max_length[10]|is_unique[users.phone]',
            'errors' => [
              'required' => 'โปรดระบุหมายเลขโทรศัพท์!',
              'min_length' => 'เบอร์โทรติดต่อต้องมีจำนวน 10 ตัวอักษร!',
              'max_length' => 'เบอร์โทรติดต่อต้องมีจำนวน 10 ตัวอักษร!',
              'is_unique' => 'หมายเลขโทรศัพท์นี้ถูกใช้แล้ว!',
            ],
          ],
        ];
      }
      if ($this->validate($rules) && $this->validate($rule_phone) && $this->validate($rule_email)) {
        $model = new UsersModel();
        $fileimg =  $this->request->getFile('pic');
        if (!file_exists($_FILES['pic']['tmp_name']) || !is_uploaded_file($_FILES['pic']['tmp_name'])) {
          $data = [
            'F_Name' => $this->request->getVar('firstname'),
            'L_Name' => $this->request->getVar('lastname'),
            'Email' => $get_email,
            'Phone' => $get_phone,
            'Last_Update' => time(),
          ];
        } else {
          $temp = explode(".", $_FILES["pic"]["name"]);
          $newfilename = $ses_userid . '.' . end($temp);
          $fileimg->move(ROOTPATH . 'uploads/userProfile', $newfilename, true);
          $data = [
            'F_Name' => $this->request->getVar('firstname'),
            'L_Name' => $this->request->getVar('lastname'),
            'Email' => $get_email,
            'Phone' => $get_phone,
            'Pic' => $newfilename,
            'Last_Update' => time(),
          ];
        }
        $model_data = $model->where('User_ID', $ses_userid)->first();
        if (isset($model_data)) {
          $model->update($ses_userid, $data);
          $session->setFlashdata('swel_title', 'สำเร็จ');
          $session->setFlashdata('swel_text', 'ข้อมูลของคุณได้รับการแก้ไขเรียบร้อยแล้ว!');
          $session->setFlashdata('swel_icon', 'success');
          $session->setFlashdata('swel_button', 'ตกลง');
          return redirect()->to('/profile');
        }
      } else {
        $data_sending['validation'] = $this->validator;
        return view('editprofile', $data_sending);
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

  public function delete_imgprofile()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    $model = new UsersModel();
    $data_model = $model->delete_imgprofile($ses_userid);
    if ($data_model) {
      return redirect()->to('/edit-form');
    } else {
      require_once(APPPATH . 'Controllers/components/setting.php');
      $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
      $session->setFlashdata('swel_text', 'ไม่สามารถดำเนินการลบรูปภาพโปรไฟล์นี้ได้ โปรดลองใหม่อีกครั้ง!');
      $session->setFlashdata('swel_icon', 'error');
      $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
      return redirect()->to('/edit-form');
    }
  }

  public function change_pass()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      return view('change_pass', $data_sending);
    } else {
      require_once(APPPATH . 'Controllers/components/setting.php');
      $session->setFlashdata('swel_title', $st_sw_title_unlogin);
      $session->setFlashdata('swel_text', $st_sw_text_unlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_unlogin);
      $session->setFlashdata('swel_button', $st_sw_button_unlogin);
      return redirect()->to('/login');
    }
  }

  public function forgot_password()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      return view('forgot_password');
    } else {
      return view('forgot_password');
    }
  }

  public function confirm_otp()
  {
    $session = session();
    $data_sending = [];
    $refer = $this->request->getVar('refer');
    $key = $this->request->getVar('key');
    if (isset($refer) && isset($key) && !empty($refer) && !empty($key)) {
      $ses_userid = $session->get('ses_id');
      if (isset($ses_userid)) {
        require_once(APPPATH . 'Controllers/components/setting.php');
        $session->setFlashdata('swel_title', $st_sw_title_alreadlogin);
        $session->setFlashdata('swel_text', $st_sw_text_alreadlogin);
        $session->setFlashdata('swel_icon', $st_sw_icon_alreadlogin);
        $session->setFlashdata('swel_button', $st_sw_button_alreadlogin);
        return redirect()->to('/');
      } else {
        $model_otp = new OTPModel();
        $data_otp = $model_otp->check_Refer_Key_type1($refer, $key);
        foreach ($data_otp as $value) {
          $ToPhone = $value['ToPhone'];
          $data_sending['phone_num_4_lenge'] = substr("$ToPhone", 0, -8) . "*****" . substr("$ToPhone", -4);
        }
        return view('confirm_otp', $data_sending);
      }
    } else {
      $session->setFlashdata('swel_title', 'คีย์ว่างเปล่า!');
      $session->setFlashdata('swel_text', 'ไม่สามารถระบุแหล่งที่มาใดๆ ได้ โปรดทำการกู้รหัสผ่านใหม้อีกครั้ง');
      $session->setFlashdata('swel_icon', 'error');
      $session->setFlashdata('swel_button', 'ย้อนกลับ');
      return redirect()->to('/forgot-password');
    }
  }

  public function update_pwd()
  {
    $session = session();
    helper(['form']);
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      $rules = [
        'oldpassword' => [
          'rules' => 'required|min_length[5]|max_length[30]',
          'errors' => [
            'required' => 'โปรดระบุรหัสผ่านเก่า!',
            'min_length' => 'รหัสผ่านต้องมีอย่างน้อย 3 ตัวอักษร!',
            'max_length' => 'รหัสผ่านต้องไม่เกิน 30 ตัวอักษร!',
          ],
        ],
        'newpassword' => [
          'rules' => 'required|min_length[5]|max_length[30]',
          'errors' => [
            'required' => 'โปรดระบุรหัสผ่านใหม่!',
            'min_length' => 'รหัสผ่านต้องมีอย่างน้อย 3 ตัวอักษร!',
            'max_length' => 'รหัสผ่านต้องไม่เกิน 30 ตัวอักษร!',
          ],
        ],
        'confpassword' => [
          'rules' => 'matches[newpassword]',
          'errors' => [
            'matches' => 'รหัสผ่านไม่ตรงกัน!',
          ],
        ],
      ];
      if ($this->validate($rules)) {
        $oldpass = $this->request->getVar('oldpassword');
        $getpass = $data['Pass'];
        $verify_password = password_verify($oldpass, $getpass);
        if ($verify_password) {
          $data = [
            'Pass' => password_hash($this->request->getVar('newpassword'), PASSWORD_DEFAULT),
            'Last_Update' => time(),
          ];
          $model_data = $model->where('User_ID', $ses_userid)->first();
          if (isset($model_data)) {
            $model->update($ses_userid, $data);
            $session->setFlashdata('swel_title', 'สำเร็จ');
            $session->setFlashdata('swel_text', 'รหัสผ่านของคุณได้รับการแก้ไขเรียบร้อยแล้ว!');
            $session->setFlashdata('swel_icon', 'success');
            $session->setFlashdata('swel_button', 'ตกลง');
            return redirect()->to('/profile');
          }
        } else {
          $session->setFlashdata('msg', 'รหัสผ่านเก่าไม่ถูกต้อง!');
          return redirect()->to('/change-password');
        }
      } else {
        $data_sending['validation'] = $this->validator;
        return view('editprofile', $data_sending);
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

  public function new_password()
  {
    $session = session();

    $pwd = $this->request->getVar('pwd');
    if (isset($pwd) && !empty($pwd)) {
      $ses_userid = $session->get('ses_id');
      if (isset($ses_userid)) {
        require_once(APPPATH . 'Controllers/components/setting.php');
        $session->setFlashdata('swel_title', $st_sw_title_alreadlogin);
        $session->setFlashdata('swel_text', $st_sw_text_alreadlogin);
        $session->setFlashdata('swel_icon', $st_sw_icon_alreadlogin);
        $session->setFlashdata('swel_button', $st_sw_button_alreadlogin);
        return redirect()->to('/');
      } else {
        $model_otp = new OTPModel();
        $check_end_key_num = $model_otp->check_End_Key($pwd);
        if ($check_end_key_num == 1) {
          return view('new_password');
        } else {
          $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด!');
          $session->setFlashdata('swel_text', 'ไม่มีข้อมูลคีย์นี้อยู่ในระบบ โปรดตรวจสอบคีย์ใหม่อีกครั้ง');
          $session->setFlashdata('swel_icon', 'error');
          $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
          return redirect()->to('/forgot-password');
        }
      }
    } else {
      $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด!');
      $session->setFlashdata('swel_text', 'ระบบไม่พบข้อมูลคีย์สำหรับการกำหนดรหัสผ่านใหม่');
      $session->setFlashdata('swel_icon', 'error');
      $session->setFlashdata('swel_button', 'กลับสู่หน้าหลัก');
      return redirect()->to('/');
    }
  }

  public function custom_new_password()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $pwdkey = $this->request->getVar('passwordkey');
    $pwd = $this->request->getVar('password');
    $cpwd = $this->request->getVar('confpassword');
    $ses_userid = $session->get('ses_id');
    if (isset($ses_userid)) {
      $session->setFlashdata('swel_title', $st_sw_title_alreadlogin);
      $session->setFlashdata('swel_text', $st_sw_text_alreadlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_alreadlogin);
      $session->setFlashdata('swel_button', $st_sw_button_alreadlogin);
      return redirect()->to('/');
    } else {
      $model_otp = new OTPModel();
      $data_otp_row = $model_otp->check_TimeToOut_ByEndKey($pwdkey);
      if ($data_otp_row >= 1) {
        if ((isset($pwd) && !empty($pwd)) || (isset($cpwd) && !empty($cpwd))) {
          if ($pwd == $cpwd) {
            $check_end_key = $model_otp->check_End_Key($pwdkey);
            if ($check_end_key == 1) {
              $get_userId_pwd = $model_otp->get_data_from_End_Key($pwdkey);
              foreach ($get_userId_pwd as $value) {
                $user_id = $value['User'];
              }
              $model = new UsersModel();
              $data = [
                'Pass' => password_hash($pwd, PASSWORD_DEFAULT),
                'Last_Update' => time(),
              ];
              $model->update($user_id, $data);
              $session->setFlashdata('swel_title', 'สำเร็จ');
              $session->setFlashdata('swel_text', 'รหัสผ่านของคุณได้รับการแก้ไขเรียบร้อยแล้ว!');
              $session->setFlashdata('swel_icon', 'success');
              $session->setFlashdata('swel_button', 'ตกลง');
              return redirect()->to('/login');
            } else {
              $session->setFlashdata('swel_title', 'ไม่มีคีย์ดังกล่าว!');
              $session->setFlashdata('swel_text', 'เกิดข้อผิดพลาดกับคีย์ในการกำหนดรหัสผ่าน โปรดลองใหม่อีกครั้ง');
              $session->setFlashdata('swel_icon', 'error');
              $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
              return redirect()->to('/new-password?pwd=' . $pwdkey);
            }
          } else {
            $session->setFlashdata('swel_title', 'รหัสผ่านไม่ตรงกัน!');
            $session->setFlashdata('swel_text', 'โปรดกำหนดรหัสผ่านให้ตรงกัน');
            $session->setFlashdata('swel_icon', 'error');
            $session->setFlashdata('swel_button', 'ย้อนกลับ');
            $session->setFlashdata('password', $pwd);
            return redirect()->to('/new-password?pwd=' . $pwdkey);
          }
        } else {
          $session->setFlashdata('swel_title', 'ข้อมูลว่างเปล่า!');
          $session->setFlashdata('swel_text', 'โปรดกำหนดรหัสผ่านก่อนี่จะดำเนินการในขั้นตอนต่อไป');
          $session->setFlashdata('swel_icon', 'error');
          $session->setFlashdata('swel_button', 'ย้อนกลับ');
          return redirect()->to('/new-password?pwd=' . $pwdkey);
        }
      } else {
        $session->setFlashdata('swel_title', 'หมดเวลาในการแก้ไขรหัสผ่าน!');
        $session->setFlashdata('swel_text', 'คุณมีเวลาเพียง 15 นาที ในการเปลี่ยนแปลงรหัสผ่าน');
        $session->setFlashdata('swel_icon', 'error');
        $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
        return redirect()->to('/login');
      }
    }
  }

  public function login()
  {
    helper(['form']);
    $session = session();
    $ses_userid = $session->get('ses_id');
    require_once(APPPATH . 'Controllers/components/setting.php');
    if (isset($ses_userid)) {
      $session->setFlashdata('swel_title', $st_sw_title_alreadlogin);
      $session->setFlashdata('swel_text', $st_sw_text_alreadlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_alreadlogin);
      $session->setFlashdata('swel_button', $st_sw_button_alreadlogin);
      return redirect()->to('/');
    } else {
      $data_sending = [];
      // require_once APPPATH . 'Libraries/vendor/autoload.php';

      // $model_setting = new SettingModel();
      // $data_setting = $model_setting->get_setting();
      // $fb_app_id = $data_setting->fb_app_id;
      // $fb_app_secret = $data_setting->fb_app_secret;
      // $fb_default_graph_version = $data_setting->fb_default_graph_version;

      // $facebook = new \Facebook\Facebook([
      //   'app_id' => $fb_app_id,
      //   'app_secret' => $fb_app_secret,
      //   'default_graph_version' => $fb_default_graph_version
      // ]);

      // $fb_helper = $facebook->getRedirectLoginHelper();

      // $fb_permissions = ['email'];
      // $data_sending['fb_login_url'] = $fb_helper->getLoginUrl(base_url('/facebook-connect'), $fb_permissions);

      return view('login', $data_sending);
    }
  }

  public function facebook_connect()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    require_once APPPATH . 'Libraries/vendor/autoload.php';

    $model_setting = new SettingModel();
    $data_setting = $model_setting->get_setting();
    $fb_app_id = $data_setting->fb_app_id;
    $fb_app_secret = $data_setting->fb_app_secret;
    $fb_default_graph_version = $data_setting->fb_default_graph_version;

    $facebook = new \Facebook\Facebook([
      'app_id' => $fb_app_id,
      'app_secret' => $fb_app_secret,
      'default_graph_version' => $fb_default_graph_version
    ]);

    $fb_helper = $facebook->getRedirectLoginHelper();

    $state = $this->request->getVar('state');
    if ($state) {
      $fb_helper->getPersistentDataHandler()->set('state', $state);
    }

    $code = $this->request->getVar('code');
    if (isset($code) && !empty($code)) {
      if (session()->get("access_token")) {
        $access_token = session()->get('access_token');
      } else {
        $access_token = $fb_helper->getAccessToken();
        session()->set("access_token", $access_token);
        $facebook->setDefaultAccessToken(session()->get('access_token'));
      }
      $graph_response = $facebook->get("/me?fields=name,first_name,last_name,email", $access_token);
      $fb_user_info = $graph_response->getGraphUser();

      $model = new UsersModel();
      if (isset($fb_user_info['email']) && !empty($fb_user_info['email'])) {
        $email = $fb_user_info['email'];
        $fbId = $fb_user_info['id'];
        $data_check_email = $model->count_data_login($email);
        if ($data_check_email >= 1) {
          $data_login = $model->get_data_login_fb($email, $fbId);
          if ($data_login) {
            $user_id = $data_login['User_ID'];
            $update_login = $model->update_login($user_id);
            if ($update_login) {
              // ไม่ดำเนินการใดๆ
            } else {
              $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด!');
              $session->setFlashdata('swel_text', 'ไม่สามารถปรับเปลี่ยนเวลาการเข้าสู่ระบบได้ โปรดติดต่อผู้ดูแลระบบ');
              $session->setFlashdata('swel_icon', 'error');
              $session->setFlashdata('swel_button', 'รับทราบ');
              return redirect()->to('/');
            }
            $arr_cookie_options = array(
              'path' => '/',
            );
            setcookie("email", "", $arr_cookie_options);
            setcookie("password", "", $arr_cookie_options);

            $model_setting = new SettingModel();
            $data_setting = $model_setting->get_setting();
            $session_timeout = $data_setting->session_timeout;

            $timestamp = time();
            $timestamp = $timestamp + $session_timeout;
            if ($session_timeout == -1) {
              $ses_data = [
                'ses_id' => $user_id,
                'ses_timestamp_kick' => -1,
              ];
            } else {
              $ses_data = [
                'ses_id' => $user_id,
                'ses_timestamp_kick' => $timestamp,
              ];
            }
            $session->set($ses_data);
            $session->setFlashdata('swel_title', 'เข้าสู่ระบบสำเร็จแล้ว');
            $session->setFlashdata('swel_icon', 'success');
            $session->setFlashdata('swel_button', 'เข้าใช้งาน');
            return redirect()->to('/');
          } else {
            $session->setFlashdata('msg', 'อีเมลดังกล่าวไม่ได้ถูกลงทะเบียนโดย Facebook หรือมีบัญชีอื่นที่ใช้อีเมลนี้อยู่แล้ว!');
            return redirect()->to('/login');
          }
        } else {
          if (!empty($fb_user_info['id'])) {
            $data_facebook = [
              'F_Name' => $fb_user_info['first_name'],
              'L_Name' => $fb_user_info['last_name'],
              'Email' => $fb_user_info['email'],
              'Pos_ID' => '1',
              'Last_Login' => time(),
              'Reg_Date' => time(),
              'Facebook' => $fb_user_info['id'],
              'IP_Address' => $_SERVER['REMOTE_ADDR'],
            ];
            $save_user = $model->save($data_facebook);
            if ($save_user) {
              $data_login = $model->get_data_login_fb($email, $fbId);
              if ($data_login) {
                $user_id = $data_login['User_ID'];
                $update_login = $model->update_login($user_id);
                if ($update_login) {
                  // ไม่ดำเนินการใดๆ
                } else {
                  $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด!');
                  $session->setFlashdata('swel_text', 'ไม่สามารถปรับเปลี่ยนเวลาการเข้าสู่ระบบได้ โปรดติดต่อผู้ดูแลระบบ');
                  $session->setFlashdata('swel_icon', 'error');
                  $session->setFlashdata('swel_button', 'รับทราบ');
                  return redirect()->to('/');
                }
                $arr_cookie_options = array(
                  'path' => '/',
                );
                setcookie("email", "", $arr_cookie_options);
                setcookie("password", "", $arr_cookie_options);

                $model_setting = new SettingModel();
                $data_setting = $model_setting->get_setting();
                $session_timeout = $data_setting->session_timeout;
    
                $timestamp = time();
                $timestamp = $timestamp + $session_timeout;
                if ($session_timeout == -1) {
                  $ses_data = [
                    'ses_id' => $user_id,
                    'ses_timestamp_kick' => -1,
                  ];
                } else {
                  $ses_data = [
                    'ses_id' => $user_id,
                    'ses_timestamp_kick' => $timestamp,
                  ];
                }
                $session->set($ses_data);
                $session->setFlashdata('swel_title', 'สำเร็จ!');
                $session->setFlashdata('swel_text', 'สมัครสมาชิกสำเร็จแล้ว คุณสามารถลงชื่อเข้าใช้งานระบบได้ในขณะนี้');
                $session->setFlashdata('swel_icon', 'success');
                $session->setFlashdata('swel_button', 'ดำเนินการต่อ');
                return redirect()->to('/');
              } else {
                $session->setFlashdata('msg', 'ไม่พบที่อยู่อีเมลนี้ในระบบ!');
                return redirect()->to('/login');
              }
            } else {
              $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด!');
              $session->setFlashdata('swel_text', 'ไม่สามารถลงทะเบียนเข้าใช้งานระบบได้ โปรดติดต่อผู้ดูแลระบบ');
              $session->setFlashdata('swel_icon', 'error');
              $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
              return redirect()->to('/login');
            }
          } else {
            $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด!');
            $session->setFlashdata('swel_text', 'ไม่พบข้อมูลการเชื่อมต่อ หรือคุณอาจไม่ได้ผูกอีเมลไว้กับ Facebook');
            $session->setFlashdata('swel_icon', 'error');
            $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
            return redirect()->to('/login');
          }
        }
      } else {
        $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
        $session->setFlashdata('swel_text', 'เราจำเป็นต้องใช้อีเมลของคุณในการยืนยันตัวตน!');
        $session->setFlashdata('swel_icon', 'error');
        $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
        return redirect()->to('/login');
      }
    } else {
      $session->setFlashdata('swel_title', 'คุณไม่ได้รับอนุญาตให้เข้าสู่หน้านี้!');
      $session->setFlashdata('swel_icon', 'error');
      $session->setFlashdata('swel_button', 'รับทราบ');
      return redirect()->to('/');
    }
  }

  public function auth()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $model = new UsersModel();
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');
    $rememberme = $this->request->getVar('rememberme');
    $arr_cookie_options = array(
    //   'expires' => time() + 10 * 365 * 24 * 60 * 60,
      'path' => '/',
    );
    if (isset($email) && !empty($email) && isset($password) && !empty($password)) {
      $data = $model->get_data_login($email);
      if ($data) {
        $data_model_count = $model->count_data_login($email);
        if ($data_model_count >= 1) {
          $data_login_fb_alert = $model->count_data_login_fb($email);
          if ($data_login_fb_alert >= 1) {
            $session->setFlashdata('msg', 'อีเมลนี้มีการลงทะเบียนโดย Facebook กับ I-Van แล้ว!');
            return redirect()->to('/login');
          } else {
            $user_id = $data['User_ID'];
            $pass = $data['Pass'];
            $verify_password = password_verify($password, $pass);
            if ($verify_password) {
              $update_login = $model->update_login($user_id);
              if ($update_login) {
                // ไม่ดำเนินการใดๆ
              } else {
                $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด!');
                $session->setFlashdata('swel_text', 'ไม่สามารถปรับเปลี่ยนเวลาการเข้าสู่ระบบได้ โปรดติดต่อผู้ดูแลระบบ');
                $session->setFlashdata('swel_icon', 'error');
                $session->setFlashdata('swel_button', 'รับทราบ');
                return redirect()->to('/');
              }

              $model_setting = new SettingModel();
              $data_setting = $model_setting->get_setting();
              $session_timeout = $data_setting->session_timeout;
  
              $timestamp = time();
              $timestamp = $timestamp + $session_timeout;
              if ($session_timeout <= -1) {
                $ses_data = [
                  'ses_id' => $user_id,
                  'ses_timestamp_kick' => -1,
                ];
              } else {
                $ses_data = [
                  'ses_id' => $user_id,
                  'ses_timestamp_kick' => $timestamp,
                ];
              }
              if (!empty($rememberme)) {
                setcookie("email", $email, $arr_cookie_options);
                setcookie("password", $password, $arr_cookie_options);
              } else {
                setcookie("email", "", $arr_cookie_options);
                setcookie("password", "", $arr_cookie_options);
              }
              $session->set($ses_data);
              $session->setFlashdata('swel_title', 'เข้าสู่ระบบสำเร็จแล้ว');
              $session->setFlashdata('swel_icon', 'success');
              $session->setFlashdata('swel_button', 'เข้าใช้งาน');
              return redirect()->to('/');
            } else {
              setcookie("email", $email, $arr_cookie_options);
              setcookie("password", "", $arr_cookie_options);
              $session->setFlashdata('msg', 'รหัสผ่านไม่ถูกต้อง!');
            }
            return redirect()->to('/login');
          }
        } else {
          setcookie("email", $email, $arr_cookie_options);
          setcookie("password", "", $arr_cookie_options);
          $session->setFlashdata('msg', 'ไม่พบที่อยู่อีเมลนี้ในระบบ!');
          return redirect()->to('/login');
        }
      } else {
        setcookie("email", $email, $arr_cookie_options);
        setcookie("password", "", $arr_cookie_options);
        $session->setFlashdata('msg', 'ไม่พบที่อยู่อีเมลนี้ในระบบ!');
        return redirect()->to('/login');
      }
    } else {
      setcookie("email", "", $arr_cookie_options);
      setcookie("password", "", $arr_cookie_options);
      $session->setFlashdata('msg', 'โปรดกรอกข้อมูลให้ครบถ้วน ก่อนดำเนินการเข้าสู่ระบบ!');
      return redirect()->to('/login');
    }
  }

  public function register()
  {
    helper(['form']);
    $session = session();
    $ses_userid = $session->get('ses_id');
    if (isset($ses_userid)) {
      require_once(APPPATH . 'Controllers/components/setting.php');
      $session->setFlashdata('swel_title', $st_sw_title_alreadlogin);
      $session->setFlashdata('swel_text', $st_sw_text_alreadlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_alreadlogin);
      $session->setFlashdata('swel_button', $st_sw_button_alreadlogin);
      return redirect()->to('/');
    } else {
      $session->destroy();
      return view('register');
    }
  }

  public function privacy()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      return view('privacy', $data_sending);
    } else {
      return view('privacy');
    }
  }

  public function new()
  {
    $session = session();
    helper(['form']);
    $rules = [
      'firstname' => [
        'rules' => 'required|min_length[2]|max_length[25]',
        'errors' => [
          'required' => 'โปรดระบุชื่อ!',
          'min_length' => 'โปรดระบุชื่อที่ความยาวอย่างน้อย 2 ตัวอักษร',
          'max_length' => 'โปรดระบุชื่อที่ความยาวไม่เกิน 25 ตัวอักษร',
        ],
      ],
      'lastname' => [
        'rules' => 'required|min_length[2]|max_length[25]',
        'errors' => [
          'required' => 'โปรดระบุนามสกุล!',
          'min_length' => 'โปรดระบุนามสกุลที่ความยาวอย่างน้อย 2 ตัวอักษร',
          'max_length' => 'โปรดระบุนามสกุลที่ความยาวไม่เกิน 25 ตัวอักษร',
        ],
      ],
      'email' => [
        'rules' => 'required|min_length[5]|max_length[50]|valid_email|is_unique[users.email]',
        'errors' => [
          'required' => 'โปรดระบุอีเมล!',
          'valid_email' => 'รูปแบบของอีเมลไม่ถูกต้อง!',
          'is_unique' => 'อีเมลนี้ถูกใช้แล้ว!',
        ],
      ],
      'phone' => [
        'rules' => 'required|min_length[10]|max_length[10]|is_unique[users.phone]',
        'errors' => [
          'required' => 'โปรดระบุหมายเลขโทรศัพท์!',
          'min_length' => 'เบอร์โทรติดต่อต้องมีจำนวน 10 ตัวอักษร!',
          'max_length' => 'เบอร์โทรติดต่อต้องมีจำนวน 10 ตัวอักษร!',
          'is_unique' => 'หมายเลขโทรศัพท์นี้ถูกใช้แล้ว!',
        ],
      ],
      'password' => [
        'rules' => 'required|min_length[5]|max_length[30]',
        'errors' => [
          'required' => 'โปรดระบุรหัสผ่าน!',
          'min_length' => 'รหัสผ่านต้องมีอย่างน้อย 5 ตัวอักษร!',
          'max_length' => 'รหัสผ่านต้องไม่เกิน 30 ตัวอักษร!',
        ],
      ],
      'confpassword' => [
        'rules' => 'required|matches[password]',
        'errors' => [
          'required' => 'โปรดยืนยันรหัสผ่าน!',
          'matches' => 'รหัสผ่านไม่ตรงกัน!',
        ],
      ],
      'acceptrule' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'คุณจำเป็นต้องยอมรับ นโยบาย และข้อตกลงของเว็บไซต์!',
        ],
      ],
    ];
    if ($this->validate($rules)) {
      $model = new UsersModel();
      $data = [
        'F_Name' => $this->request->getVar('firstname'),
        'L_Name' => $this->request->getVar('lastname'),
        'Email' => $this->request->getVar('email'),
        'Pass' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        'Phone' => $this->request->getVar('phone'),
        'Pos_ID' => '1',
        'Reg_Date' => time(),
        'IP_Address' => $_SERVER['REMOTE_ADDR'],
      ];
      $data_users = $model->where('Email', $this->request->getVar('email'))->first();
      if (isset($data_users)) {
        $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด!');
        $session->setFlashdata('swel_text', 'อีเมลนี้ถูกใช้แล้ว!');
        $session->setFlashdata('swel_icon', 'error');
        $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
        return redirect()->to('/register');
      } else {
        $data_save_user = $model->save($data);
        if ($data_save_user) {
          $session->setFlashdata('swel_title', 'สำเร็จ!');
          $session->setFlashdata('swel_text', 'สมัครสมาชิกสำเร็จแล้ว คุณสามารถลงชื่อเข้าใช้งานระบบได้ในขณะนี้');
          $session->setFlashdata('swel_icon', 'success');
          $session->setFlashdata('swel_button', 'ดำเนินการต่อ');
          return redirect()->to('/login');
        } else {
          $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด!');
          $session->setFlashdata('swel_text', 'ไม่สามารถลงทะเบียนเข้าใช้งานระบบได้ โปรดติดต่อผู้ดูแลระบบ');
          $session->setFlashdata('swel_icon', 'error');
          $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
          return redirect()->to('/login');
        }
      }
    } else {
      $validation = $this->validator->listErrors();
      $session->setFlashdata('validation', $validation);
      $firstname = $this->request->getVar('firstname');
      $lastname = $this->request->getVar('lastname');
      $phone = $this->request->getVar('phone');
      $email = $this->request->getVar('email');
      $checkbox = $this->request->getVar('acceptrule');
      if (isset($firstname)) {
        $session->setFlashdata('F_Name', $firstname);
      }
      if (isset($lastname)) {
        $session->setFlashdata('L_Name',  $lastname);
      }
      if (isset($phone)) {
        $session->setFlashdata('Phone', $phone);
      }
      if (isset($email)) {
        $session->setFlashdata('Email', $email);
      }
      if ($checkbox == "on") {
        $session->setFlashdata('checkbox', "on");
      }
      return redirect()->to('/register');
    }
  }

  public function update_user_byId()
  {
    $session = session();
    helper(['form']);
    $user_id = $this->request->getVar('user_id');
    $rules = [
      'user_id' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'เกิดข้อผิดพลาดกับรหัสผู้ใช้!',
        ],
      ],
      'firstname' => [
        'rules' => 'required|min_length[2]|max_length[25]',
        'errors' => [
          'required' => 'โปรดระบุชื่อ!',
          'min_length' => 'โปรดระบุชื่อที่ความยาวอย่างน้อย 2 ตัวอักษร',
          'max_length' => 'โปรดระบุชื่อที่ความยาวไม่เกิน 25 ตัวอักษร',
        ],
      ],
      'lastname' => [
        'rules' => 'required|min_length[2]|max_length[25]',
        'errors' => [
          'required' => 'โปรดระบุนามสกุล!',
          'min_length' => 'โปรดระบุนามสกุลที่ความยาวอย่างน้อย 2 ตัวอักษร',
          'max_length' => 'โปรดระบุนามสกุลที่ความยาวไม่เกิน 25 ตัวอักษร',
        ],
      ],
      // 'phone' => [
      //   'rules' => 'required|min_length[10]|max_length[10]',
      //   'errors' => [
      //     'required' => 'โปรดระบุหมายเลขโทรศัพท์!',
      //     'min_length' => 'เบอร์โทรติดต่อต้องมีจำนวน 10 ตัวอักษร!',
      //     'max_length' => 'เบอร์โทรติดต่อต้องมีจำนวน 10 ตัวอักษร!',
      //   ],
      // ],
      'position' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'โปรดเลือกตำแหน่ง!',
        ],
      ],
    ];
    if ($this->validate($rules)) {
      $model = new UsersModel();
      $data = [
        'F_Name' => $this->request->getVar('firstname'),
        'L_Name' => $this->request->getVar('lastname'),
        'Phone' => $this->request->getVar('phone'),
        'Pos_ID' => $this->request->getVar('position'),
        'Last_Update' => time(),
      ];
      $data_update_user = $model->update($user_id, $data);
      if ($data_update_user) {
        $session->setFlashdata('swel_title', 'สำเร็จ');
        $session->setFlashdata('swel_text', 'ข้อมูลของคุณได้รับการแก้ไขเรียบร้อยแล้ว!');
        $session->setFlashdata('swel_icon', 'success');
        $session->setFlashdata('swel_button', 'ตกลง');
        return redirect()->to('/manage-allUsers');
      } else {
        $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
        $session->setFlashdata('swel_text', 'ไม่สามารถบันทึกข้อมูลได้ โปรดติดต่อผู้ดูแลระบบ หรือลองใหม่อีกครั้ง');
        $session->setFlashdata('swel_icon', 'error');
        $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
        return redirect()->to('/manage-allUsers');
      }
    } else {
      $validation = $this->validator->listErrors();
      $session->setFlashdata('validation', $validation);
      return redirect()->to('/edit-officer' . '/' . $user_id);
    }
  }

  public function addofficer_form()
  {
    $session = session();
    helper(['form']);
    $rules = [
      'frist' => [
        'rules' => 'required|min_length[2]|max_length[15]',
        'errors' => [
          'required' => 'โปรดระบุชื่อ!',
        ],
      ],
      'lastname' => [
        'rules' => 'required|min_length[4]|max_length[10]',
        'errors' => [
          'required' => 'โปรดระบุนามสกุล!',
        ],
      ],
      'email' => [
        'rules' => 'required|min_length[5]|max_length[50]|valid_email|is_unique[users.email]',
        'errors' => [
          'required' => 'โปรดระบุอีเมล!',
          'valid_email' => 'รูปแบบของอีเมลไม่ถูกต้อง!',
          'is_unique' => 'อีเมลนี้ถูกใช้แล้ว!',
        ],
      ],
      'tel' => [
        'rules' => 'required|min_length[10]|max_length[10]',
        'errors' => [
          'required' => 'โปรดระบุหมายเลขโทรศัพท์!',
          'min_length' => 'เบอร์โทรติดต่อต้องมีจำนวน 10 ตัวอักษร!',
          'max_length' => 'เบอร์โทรติดต่อต้องมีจำนวน 10 ตัวอักษร!',
        ],
      ],
      'position' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'โปรดเลือกตำแหน่ง!',
        ],
      ],
    ];
    if ($this->validate($rules)) {
      $model = new UsersModel();
      $data = [
        'F_Name' => $this->request->getVar('frist'),
        'L_Name' => $this->request->getVar('lastname'),
        'Email' => $this->request->getVar('email'),
        'Pass' => password_hash($this->request->getVar('tel'), PASSWORD_DEFAULT),
        'Phone' => $this->request->getVar('tel'),
        'Pos_ID' => $this->request->getVar('position'),
        'Reg_Date' => time(),
        'Last_Update' => time(),
      ];
      $data_user_save = $model->save($data);
      if ($data_user_save) {
        $session->setFlashdata('swel_title', 'สำเร็จ!');
        $session->setFlashdata('swel_text', 'ข้อมูลของผู้ใช้ได้ถูกเพิ่มลงระบบเรียบร้อยแล้ว');
        $session->setFlashdata('swel_icon', 'success');
        $session->setFlashdata('swel_button', 'รับทราบ');
        return redirect()->to('/add-officer');
      } else {
        $session->setFlashdata('swel_title', 'เกิดข้อผิดพลาด');
        $session->setFlashdata('swel_text', 'ไม่สามารถบันทึกข้อมูลได้ โปรดติดต่อผู้ดูแลระบบ หรือลองใหม่อีกครั้ง');
        $session->setFlashdata('swel_icon', 'error');
        $session->setFlashdata('swel_button', 'ลองอีกครั้ง');
        return redirect()->to('/add-officer');
      }
    } else {
      $validation = $this->validator->listErrors();
      $session->setFlashdata('validation', $validation);
      return redirect()->to('/add-officer');
    }
  }

  public function logout()
  {
    $session = session();
    $session->destroy();
    return redirect()->to('/login');
  }

}
