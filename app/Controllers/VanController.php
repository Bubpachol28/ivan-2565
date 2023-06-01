<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\VanModel;

class VanController extends BaseController
{
  public function addvan()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 2) {
      $data_sending['driverlist'] = $model->driver_list();
        return view('employee/addvan', $data_sending);
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
      return redirect()->to('/');
    }
  }

  public function addvan_form()
  {
    $session = session();
    helper(['form']);
    $rules = [
      'van_num' => [
        'rules' => 'required|min_length[2]|max_length[15]',
        'errors' => [
          'required' => 'โปรดระบุหมายเลขรถ!',
          'min_length' => 'หมายเลขรถต้องมีไม่น้อยกว่า 2 ตัว !',
          'max_length' => 'หมายเลขรถต้องมีน้อยกว่า 15 ตัว!',
        ],
      ],
      'plate' => [
        'rules' => 'required|min_length[4]|max_length[10]',
        'errors' => [
          'required' => 'โปรดระบุทะเบียนรถ!',
          'min_length' => 'โปรดระบุทะเบียนรถต้องมีไม่น้อยกว่า 4 ตัว !',
          'max_length' => 'โปรดระบุทะเบียนรถต้องมีน้อยกว่า 10 ตัว!',
        ],
      ],
      'driver' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'โปรดเลือกผู้ขับ!',
        ],
      ],
        'seats' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'โปรดเลือกจำนวนที่นั่งสูงสุด!',
          ],
        ],
      ];
      if ($this->validate($rules)) {
        $model_van = new VanModel();
        $data = [
          'Van_Num' => $this->request->getVar('van_num'),
          'Plate' => $this->request->getVar('plate'),
          'Driver_ID' => $this->request->getVar('driver'),
          'Seats_Num' => $this->request->getVar('seats'),
        ];
        $model_van->save($data);
        $session->setFlashdata('swel_title', 'สำเร็จ!');
        $session->setFlashdata('swel_text', 'ข้อมูลของรถตู้โดยสารถูกเพิ่มลงระบบเรียบร้อยแล้ว');
        $session->setFlashdata('swel_icon', 'success');
        $session->setFlashdata('swel_button', 'รับทราบ');
        return redirect()->to('/addvan');
      } else {
        $validation = $this->validator->listErrors();
      $session->setFlashdata('validation', $validation);
      return redirect()->to('/addvan');
      }
  }

  public function edit_van_form()
  {
    $session = session();
    helper(['form']);
    $van_id = $this->request->getVar('van_id');
    $rules = [
      'van_id' => [
        'rules' => 'required|min_length[1]|max_length[15]',
        'errors' => [
          'required' => 'โปรดระบุรหัสรถ!',
          'min_length' => 'รหัสรถต้องมีไม่น้อยกว่า 1 ตัว !',
          'max_length' => 'รหัสรถต้องมีน้อยกว่า 15 ตัว!',
        ],
      ],
      'van_num' => [
        'rules' => 'required|min_length[2]|max_length[15]',
        'errors' => [
          'required' => 'โปรดระบุหมายเลขรถ!',
          'min_length' => 'หมายเลขรถต้องมีไม่น้อยกว่า 2 ตัว !',
          'max_length' => 'หมายเลขรถต้องมีน้อยกว่า 15 ตัว!',
        ],
      ],
      'plate' => [
        'rules' => 'required|min_length[4]|max_length[10]',
        'errors' => [
          'required' => 'โปรดระบุทะเบียนรถ!',
          'min_length' => 'โปรดระบุทะเบียนรถต้องมีไม่น้อยกว่า 4 ตัว !',
          'max_length' => 'โปรดระบุทะเบียนรถต้องมีน้อยกว่า 10 ตัว!',
        ],
      ],
      'driver' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'โปรดเลือกผู้ขับ!',
        ],
      ],
        'seats' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'โปรดเลือกจำนวนที่นั่งสูงสุด!',
          ],
        ],
      ];
      if ($this->validate($rules)) {
        $model_van = new VanModel();
        $data = [
          'Van_Num' => $this->request->getVar('van_num'),
          'Plate' => $this->request->getVar('plate'),
          'Driver_ID' => $this->request->getVar('driver'),
          'Seats_Num' => $this->request->getVar('seats'),
        ];
        $model_van->update($van_id, $data);
        $session->setFlashdata('swel_title', 'สำเร็จ!');
        $session->setFlashdata('swel_text', 'แก้ไขข้อมูลของรถตู้โดยสารลงระบบเรียบร้อยแล้ว');
        $session->setFlashdata('swel_icon', 'success');
        $session->setFlashdata('swel_button', 'โอเคร!!');
        return redirect()->to('/manage-van');
      } else {
        $validation = $this->validator->listErrors();
        $session->setFlashdata('validation', $validation);
        return redirect()->to('/edit-van'.'/'.$van_id);
      }
  }

  public function del_van_byId()
  {
    $van = $this->request->getVar('van');
    $model_van = new VanModel();
    $model_van->van_del_by_id($van);
    return redirect()->to('/manage-van');
  }

  public function edit_van($van_id)
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 2) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      $data_sending['driverlist'] = $model->driver_list();
        if (isset($van_id) && !empty($van_id)) {
          $model_van = new VanModel();
          $data_van = $model_van->van_find_by_id($van_id);
          if (isset($data_van) && !empty($data_van)) {
            foreach($data_van as $value){
              $data_sending['v_van_id'] = $van_id;
              $data_sending['v_van_num'] = $value['Van_Num'];
              $data_sending['v_plate'] = $value['Plate'];
              $data_sending['v_driver_id'] = $value['Driver_ID'];
              $data_sending['v_seats_num'] = $value['Seats_Num'];
              $data_sending['v_fname'] = $value['F_Name'];
              $data_sending['v_lname'] = $value['L_Name'];
            }
            return view('employee/edit_van', $data_sending);
          } else {
            $session->setFlashdata('swel_title', 'ไม่พบข้อมูล!');
            $session->setFlashdata('swel_text', 'ข้อมูลที่ได้รับ ไม่มีอยู่ในฐานข้อมูลของระบบ');
            $session->setFlashdata('swel_icon', 'error');
            $session->setFlashdata('swel_button', 'ตกลง');
            return redirect()->to('/manage-van');
          }
        }
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
      return redirect()->to('/');
    }
  }
}