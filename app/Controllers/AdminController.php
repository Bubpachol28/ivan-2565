<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\UsersModel;
use App\Models\UserPositionModel;

class AdminController extends Controller
{
  public function manage_allUsers()
  {
    require_once(APPPATH . 'Controllers/components/setting.php');
    $session = session();
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      $model_position = new UserPositionModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 4) {
        $position_select = $this->request->getVar('p');
          if (isset($position_select)) {
            $data_sending['list_users'] = $model
            ->join('u_position', 'users.Pos_ID = u_position.Pos_ID')
            ->where('u_position.Pos_ID', $position_select)
            ->orderBy('User_ID', 'ASC')
            ->paginate(10);
          } else {
            $data_sending['list_users'] = $model
            ->join('u_position', 'users.Pos_ID = u_position.Pos_ID')
            ->orderBy('User_ID', 'ASC')
            ->paginate(10);
          }
        $data_sending['pager'] = $model->pager;
        $data_sending['all_position'] = $model_position->userposition_list();
        return view('admin/manage_allusers', $data_sending);
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

  public function add_officer()
  {
    require_once(APPPATH . 'Controllers/components/setting.php');
    $session = session();
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 4) {
        $model_userposition = new UserPositionModel();
        $data_sending['userposition_list'] = $model_userposition->userposition_list();
        return view('admin/add_officer', $data_sending);
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

  public function edit_officer($User_ID)
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 4) {
        $model_userposition = new UserPositionModel();
        $data_sending['userposition_list'] = $model_userposition->userposition_list();
        $data_userId = $model->select_userByID($User_ID);
        if (isset($data_userId) && !empty($data_userId)) {
          foreach ($data_userId as $value) {
            $data_sending['u_user_id'] = $value['User_ID'];
            $data_sending['u_fname'] = $value['F_Name'];
            $data_sending['u_lname'] = $value['L_Name'];
            $data_sending['u_email'] = $value['Email'];
            $data_sending['u_phone'] = $value['Phone'];
            $data_sending['u_position'] = $value['Pos_ID'];
          }
        } else {
          $session->setFlashdata('swel_title', 'ไม่พบข้อมูล!');
          $session->setFlashdata('swel_text', 'ข้อมูลที่ได้รับ ไม่มีอยู่ในฐานข้อมูลของระบบ');
          $session->setFlashdata('swel_icon', 'error');
          $session->setFlashdata('swel_button', 'ตกลง');
          return redirect()->to('/manage-allUsers');
        }
        return view('admin/edit_officer', $data_sending);
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
