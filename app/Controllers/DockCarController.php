<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsersModel;
use App\Models\DockCarModel;
use App\Models\TicketPriceModel;
use App\Models\VanModel;
use App\Models\StationModel;
use App\Models\PaymentModel;

class DockCarController extends Controller
{
  public function table_reservation()
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
    }
    $model_dockCar = new DockCarModel();
    $data_dockCar_kanjanaburi = $model_dockCar->viewDockCar_kanjanaburi_Festival_Row();
    if ($data_dockCar_kanjanaburi >= 1) {
      $data_sending['dockcars_kanjanaburi'] = $model_dockCar->viewDockCar_kanjanaburi_Festival();
    } else {
      $data_sending['dockcars_kanjanaburi'] = $model_dockCar->viewDockCar_kanjanaburi_Default();
    }
    $data_dockCar_nakhonpathom = $model_dockCar->viewDockCar_nakhonpathom_Festival_Row();
    if ($data_dockCar_nakhonpathom >= 1) {
      $data_sending['dockcars_nakhonpathom'] = $model_dockCar->viewDockCar_nakhonpathom_Festival();
    } else {
      $data_sending['dockcars_nakhonpathom'] = $model_dockCar->viewDockCar_nakhonpathom_Default();
    }
    $model_ticketprice = new TicketPriceModel();
    $data_sending['ticketprice_ntok'] = $model_ticketprice->CountTicketNtoK();
    $data_sending['ticketprice_kton'] = $model_ticketprice->CountTicketKtoN();
    return view('table_reservation', $data_sending);
  }

  public function add_driving()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $ses_posid = $session->get('ses_pos_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      if ($ses_posid >= 2) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      $model_van = new VanModel();
      $data_sending['list_van'] = $model_van->van_list();
      $model_station = new StationModel();
      $data_sending['list_Station'] = $model_station->getStation();
        return view('employee/add_driving', $data_sending);
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

  public function add_dock_car()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    helper(['form']);
    $ses_userid = $session->get('ses_id');
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      $rules = [
        'id_van' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'โปรดเลือกรถตู้โดยสารที่ต้องการ',
          ],
        ],
        'around_num' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'โปรดเลือกรอบรถของวัน',
          ],
        ],
        'station_id' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'โปรดเลือกสถานีที่รถเทียบท่า',
          ],
        ],
        'out_van' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'โปรดระบุเวลาที่รถเทียบท่า',
          ],
        ],
      ];
      if ($this->validate($rules)) {
        $model = new DockCarModel();
        $cb_festival = $this->request->getVar('festival');
        if (isset($cb_festival) && $cb_festival == "festival"){

        $data = [
          'Van_ID' => $this->request->getVar('id_van'),
          'Van_Out' => $this->request->getVar('out_van'),
          'Festival_Date' => $this->request->getVar('date_van'),
          'Station_ID' => $this->request->getVar('station_id'),
          'Around_Num' => $this->request->getVar('around_num'),

        ];
      } else {
        $data = [
          'Van_ID' => $this->request->getVar('id_van'),
          'Van_Out' => $this->request->getVar('out_van'),
          'Festival_Date' => "0000-00-00",
          'Station_ID' => $this->request->getVar('station_id'),
          'Around_Num' => $this->request->getVar('around_num'),

        ];
      }
        $model->save($data);
        $session->setFlashdata('swel_title', 'เพิ่มข้อมูลสำเร็จ...');
        $session->setFlashdata('swel_text', 'เพิ่มข้อมูลที่ระบุเข้าระบบเรียบร้อยแล้ว');
        $session->setFlashdata('swel_icon', 'success');
        $session->setFlashdata('swel_button', 'รับทราบ');
        return redirect()->to('/manage-traffic');
      }else {
        $validation = $this->validator->listErrors();
        $session->setFlashdata('validation', $validation);
        return redirect()->to('/add-driving');
      }
    } else {
      $session->setFlashdata('swel_title', $st_sw_title_unlogin);
      $session->setFlashdata('swel_text', $st_sw_text_unlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_unlogin);
      $session->setFlashdata('swel_button', $st_sw_button_unlogin);
      return redirect()->to('/login');
    }
  }

  public function edit_driving($Dock_car_id)
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $ses_posid = $session->get('ses_pos_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      if ($ses_posid >= 2) {
        $model = new UsersModel();
        require_once(APPPATH . 'Controllers/components/user_connect.php');
        $model_van = new VanModel();
        $data_sending['list_van'] = $model_van->van_list();
        $model_station = new StationModel();
        $data_sending['list_Station'] = $model_station->getStation();
        $model_dock_car = new DockCarModel();
        $data_dock_car = $model_dock_car->getDock_car_Out_byId($Dock_car_id);
        if (isset($data_dock_car) && !empty($data_dock_car)) {
          foreach ($data_dock_car as $value) {
            $data_sending['d_id'] = $value['Dock_car_id'];
            $data_sending['d_van_id'] = $value['Van_ID'];
            $data_sending['d_around_num'] = $value['Around_Num'];
            $data_sending['d_station_id'] = $value['Station_ID'];
            $data_sending['d_van_out'] = $value['Van_Out'];
            $data_sending['d_date'] = $value['Festival_Date'];
          }
        } else {
          $session->setFlashdata('swel_title', 'ไม่พบข้อมูล!');
          $session->setFlashdata('swel_text', 'ข้อมูลที่ได้รับ ไม่มีอยู่ในฐานข้อมูลของระบบ');
          $session->setFlashdata('swel_icon', 'error');
          $session->setFlashdata('swel_button', 'ตกลง');
          return redirect()->to('/manage-allUsers');
        }
        return view('employee/edit_driving', $data_sending);
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

  public function update_dock_car()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    helper(['form']);
    $ses_userid = $session->get('ses_id');
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      $Dock_car_id = $this->request->getVar('dock_car_id');
      $rules = [
        'dock_car_id' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'เกิดข้อผิดพลาดกับข้อมูลการเดินรถ',
          ],
        ],
        'id_van' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'โปรดเลือกรถตู้โดยสารที่ต้องการ',
          ],
        ],
        'around_num' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'โปรดเลือกรอบรถของวัน',
          ],
        ],
        'station_id' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'โปรดเลือกสถานีที่รถเทียบท่า',
          ],
        ],
        'out_van' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'โปรดระบุเวลาที่รถเทียบท่า',
          ],
        ],
      ];
      if ($this->validate($rules)) {
        $model_dock_car = new DockCarModel();
        $cd_festival = $this->request->getVar('festival');
        if (isset($cb_festival) && $cb_festival == "festival"){
          $data = [
            'Van_ID' => $this->request->getVar('id_van'),
            'Van_Out' => $this->request->getVar('out_van'),
            'Festival_Date' => $this->request->getVar('date_van'),
            'Station_ID' => $this->request->getVar('station_id'),
            'Around_Num' => $this->request->getVar('around_num'),
          ];
        } else {
          $data = [
            'Van_ID' => $this->request->getVar('id_van'),
            'Van_Out' => $this->request->getVar('out_van'),
            'Festival_Date' => "0000-00-00",
            'Station_ID' => $this->request->getVar('station_id'),
            'Around_Num' => $this->request->getVar('around_num'),

          ];
        }
        $model_dock_car->update($Dock_car_id, $data);
        $session->setFlashdata('swel_title', 'อัพเดตข้อมูลสำเร็จ...');
        $session->setFlashdata('swel_text', 'ข้อมูลที่มีการปรับเปลี่ยน ได้รับการแก้ไขเรียบร้อยแล้ว');
        $session->setFlashdata('swel_icon', 'success');
        $session->setFlashdata('swel_button', 'รับทราบ');
        return redirect()->to('/manage-traffic');
      }else {
        $validation = $this->validator->listErrors();
        $session->setFlashdata('validation', $validation);
        return redirect()->to('/edit-driving'.'/'.$Dock_car_id);
      }
    } else {
      $session->setFlashdata('swel_title', $st_sw_title_unlogin);
      $session->setFlashdata('swel_text', $st_sw_text_unlogin);
      $session->setFlashdata('swel_icon', $st_sw_icon_unlogin);
      $session->setFlashdata('swel_button', $st_sw_button_unlogin);
      return redirect()->to('/login');
    }
  }

  public function del_dock_car_byId_CB()
  {
    $dockcar_id = $this->request->getVar('dockcar');
    $model_dockcar = new DockCarModel();
    $model_dockcar->del_dockcar_byId_CB($dockcar_id);
    return redirect()->to('/manage-traffic');
  }
}