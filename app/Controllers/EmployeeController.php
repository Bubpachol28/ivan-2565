<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PaymentModel;
use App\Models\ComplaintModel;
use App\Models\DockCarModel;
use App\Models\ReservationModel;
use App\Models\StationModel;
use App\Models\VanModel;

class EmployeeController extends BaseController
{
  public function dashboard()
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
        $data_sending['count_all_users'] = $model->count_all_users();
        $data_sending['count_all_payments'] = $model_payment->count_all_payments();
        $data_sending['count_all_payments_success'] = $model_payment->count_all_payments_success();
        $data_sending['count_all_payments_waiting'] = $model_payment->count_all_payments_waiting();
        $data_sending['count_all_payments_day'] = $model_payment->count_all_payments_day();
        $data_sending['allreservations'] = $model_payment->viewPaymentAll()->paginate(10);
        $data_sending['pager'] = $model_payment->pager;
        $data_payment_day = $model_payment->sum_price_day();
        foreach ($data_payment_day as $value) {
          if (isset($value['sumTotalPrice']) && !empty($value['sumTotalPrice'])) {
            $data_sending['sum_price_day'] = $value['sumTotalPrice'];
          } else {
            $data_sending['sum_price_day'] = "0";
          }
        }
        $data_payment_month = $model_payment->sum_price_month();
        foreach ($data_payment_month as $value) {
          if (isset($value['sumTotalPrice']) && !empty($value['sumTotalPrice'])) {
            $data_sending['sum_price_month'] = $value['sumTotalPrice'];
          } else {
            $data_sending['sum_price_month'] = "0";
          }
        }
        $data_payment_year = $model_payment->sum_price_year();
        foreach ($data_payment_year as $value) {
          if (isset($value['sumTotalPrice']) && !empty($value['sumTotalPrice'])) {
            $data_sending['sum_price_year'] = $value['sumTotalPrice'];
          } else {
            $data_sending['sum_price_year'] = "0";
          }
        }
        return view('employee/dashboard', $data_sending);
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

  public function manager()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 3) {
        $model = new UsersModel();
        $data = $model->where('User_ID', $ses_userid)->first();
        $data_sending['Q_F_Name'] = $data['F_Name'];
        $session->setFlashdata('swel_title', "ยินดีต้อนรับ ".$data_sending['Q_F_Name']);
        $session->setFlashdata('swel_button', 'เข้าใช้งาน');
        return redirect()->to('/dashboard');
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

  public function manage_van()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 3) {
      $model_van = new VanModel();
      $data_sending['vanlist'] = $model_van->van_list();
        return view('employee/manage_van', $data_sending);
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

  public function manage_traffic()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 3) {
        $model_DockCar = new DockCarModel();
        $data_sending['viewDockCar'] = $model_DockCar
        ->join('van', 'dock_car.Van_ID = van.Van_ID')
        ->join('station', 'dock_car.Station_ID = station.Station_ID')
        ->orderBy('Dock_car_id', 'ASC')
        ->paginate(10);
        $data_sending['pager'] = $model_DockCar->pager;
        return view('employee/manage_traffic', $data_sending);
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

  public function manage_user()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 3) {
      $data_sending['list_users'] = $model->viewAll_Users_1()->paginate(10);
      $data_sending['pager'] = $model->pager;
        return view('employee/manage_user', $data_sending);
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

  public function check_payment()
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
        $data_sending['listPaymentAll'] = $model_payment->viewPaymentAll_waiting();
        $data_sending['listPaymentAll_row'] = $model_payment->viewPaymentAll_waiting_row();
        return view('employee/check_payment', $data_sending);
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

  public function add_user()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    if (isset($ses_userid)) {
      $model = new UsersModel();
      require_once(APPPATH . 'Controllers/components/user_connect.php');
      if ($Q_Pos_ID >= 3) {
        return view('employee/add_user', $data_sending);
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

  public function customer_del_userId_byCB()
  {
    $user_id = $this->request->getVar('m_user_del_cb');
    $model = new UsersModel();
    $model->del_user_byId($user_id);
    return redirect()->to('/manage-user');
  }

  public function user_del_userId_byCB()
  {
    $user_id = $this->request->getVar('m_alluser_del_cb');
    $model = new UsersModel();
    $model->del_user_byId($user_id);
    return redirect()->to('/manage-allUsers');
  }
}