<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsersModel;
use App\Models\ComplaintModel;
use App\Models\ComplaintTypeModel;

class ComplaintController extends Controller
{
  public function manage_complaint()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 3) {
        $model_complaint = new ComplaintModel();
        $data_sending['all_complaint_row'] = $model_complaint->view_all_complaint_row();
        $data_sending['all_complaint'] = $model_complaint->view_all_complaint()->paginate(15);
        $data_sending['pager'] = $model_complaint->pager;
        return view('employee/manage_complaint', $data_sending);
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

  public function complaint()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    $model_comtype = new ComplaintTypeModel();
    $data_comtype = $model_comtype->view_all_complaint_type();
    if ($data_comtype) {
      $data_sending['com_type'] = $data_comtype;
      if (isset($ses_userid)) {
        $model = new UsersModel();
        require_once(APPPATH . 'Controllers/components/user_connect.php');
        return view('complaint', $data_sending);
      } else {
        return view('complaint', $data_sending);
      }
    } else {

    }
  }

  public function add_report()
  {
    $session = session();
    $data_sending = [];
    $model = new UsersModel();
    $rules = [
      'title' => [
        'rules' => 'required|min_length[5]|max_length[50]',
        'errors' => [
          'required' => 'โปรดระบุชื่อเรื่องของการร้องเรียน',
          'min_length' => 'หัวข้อต้องมีอย่างน้อย 5 ตัวอักษร',
          'max_length' => 'หัวข้อต้องไม่เกิน 50 ตัวอักษร',
        ],
      ],
      'type' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'โปรดเลือกประเภทของการร้องเรียน',
        ]
      ],
      'message' => [
        'rules' => 'required|min_length[5]|max_length[1000]',
        'errors' => [
          'required' => 'โปรดระบุรายละเอียดสำหรับการร้องเรียน',
          'min_length' => 'ข้อความต้องมีอย่างน้อย 5 ตัวอักษร',
          'max_length' => 'ข้อความต้องไม่เกิน 1,000 ตัวอักษร',
        ],
      ],
    ];
    $title = $this->request->getVar('title');
    $type = $this->request->getVar('type');
    $message = $this->request->getVar('message');
    if ($this->validate($rules)) {
      $model = new ComplaintModel();
      $data = [
        'Com_Topic' => $title,
        'Com_Type_ID' => $type,
        'Com_Content' => $message,
      ];
      $data_model_com = $model->save($data);
      if ($data_model_com) {
        $session->setFlashdata('success_report', 'รายงานปัญหาสำเร็จ!');
        return redirect()->to('/complaint');
      } else {
        $session->setFlashdata('error_report', 'เกิดข้อผิดพลาด: ไม่สามารถติดต่อกับระบบได้ โปรดลองใหม่อีกครั้ง!');
        return redirect()->to('/complaint');
      }
    } else {
      $validation = $this->validator->listErrors();
      $session->setFlashdata('error_report', $validation);
      $session->setFlashdata('flash_com_title', $title);
      $session->setFlashdata('flash_com_type', $type);
      $session->setFlashdata('flash_com_message', $message);
      return redirect()->to('/complaint');
    }
  }
}
