<?php 
namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;

use CodeIgniter\Controller;
use App\Models\UsersModel;
use App\Models\PaymentModel;

class PdfController extends Controller
{
  public function index() 
	{
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    $model = new UsersModel();
    require_once(APPPATH . 'Controllers/components/user_connect_unses.php');
    if (isset($ses_userid)) {
      if ($Q_Pos_ID >= 2) {
      $model_payment = new PaymentModel();
        $data_sending['count_all_users'] = $model->count_all_users();
        $data_sending['count_all_payments'] = $model_payment->count_all_payments();
        $data_sending['count_all_payments_success'] = $model_payment->count_all_payments_success();
        $data_sending['count_all_payments_waiting'] = $model_payment->count_all_payments_waiting();
        $data_sending['count_all_payments_day'] = $model_payment->count_all_payments_day();
        $data_sending['allreservations'] = $model_payment->viewPaymentAll_PDF();
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
        return view('employee/pdf_view', $data_sending);
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

  public function view_pdf()
  {
    $session = session();
    require_once(APPPATH . 'Controllers/components/setting.php');
    $ses_userid = $session->get('ses_id');
    $data_sending = [];
    $model = new UsersModel();
    require_once(APPPATH . 'Controllers/components/user_connect_unses.php');
    if (isset($ses_userid)) {
      if ($Q_Pos_ID >= 2) {
      $model_payment = new PaymentModel();
        $data_sending['count_all_users'] = $model->count_all_users();
        $data_sending['count_all_payments'] = $model_payment->count_all_payments();
        $data_sending['count_all_payments_success'] = $model_payment->count_all_payments_success();
        $data_sending['count_all_payments_waiting'] = $model_payment->count_all_payments_waiting();
        $data_sending['count_all_payments_day'] = $model_payment->count_all_payments_day();
        $data_sending['allreservations'] = $model_payment->viewPaymentAll_PDF();
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
        //About PDF
        $options = new Options();
        $options->set('isRemoteEnabled', 'true');
        // $options->set('defaultFont', 'itim');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('employee/pdf_view', $data_sending));
        // $dompdf->setPaper('A4', 'portrait'); แนวตั้ง
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $date = date('Y-m-d');
        $dompdf->stream("I-VAN State of ".$date, array("Attachment" => false));
        exit(0);
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