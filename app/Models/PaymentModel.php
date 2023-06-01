<?php 

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model {
  protected $table = 'payment';
  protected $primaryKey = 'Pay_ID ';
  protected $allowedFields = ['Pay_ID ', 'User_ID', 'Pay_DateTime', 'Pay_Date', 'Bank', 'Slip', 'Confirm', 'Note', 'Reserve_ID'];

  public function getReservationAfterConfirm($ses_userid)
  {
    $where_sql = "payment.User_ID = $ses_userid";
    $data = $this->db
      ->table('payment')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->join('dock_car', 'reservation.Dock_car_id = dock_car.Dock_car_id')
      ->join('ticket_price', 'reservation.Tic_Price_ID = ticket_price.Tic_Price_ID')
      ->where($where_sql)
      ->orderBy('payment.Pay_ID', 'DESC')
      ->limit(1)
      ->get()
      ->getResultArray();
    return $data;
  }

  public function getPaymentByReserveId($ses_userid, $reservation_id)
  {
    $where_sql = "User_ID = $ses_userid AND Reserve_ID = $reservation_id";
    $data = $this->db
      ->table('payment')
      ->where($where_sql)
      ->orderBy('Reserve_ID', 'DESC')
      ->limit(1)
      ->get()
      ->getResultArray();
    return $data;
  }

  public function getPaymentByPayId($ses_userid, $Pay_ID)
  {
    $where_sql = "User_ID = $ses_userid AND Pay_ID = $Pay_ID";
    $data = $this->db
      ->table('payment')
      ->where($where_sql)
      ->orderBy('Pay_ID', 'DESC')
      ->limit(1)
      ->get()
      ->getResultArray();
    return $data;
  }

  public function viewPaymentAll_waiting()
  {
    $where_sql = "payment.confirm = 'waiting'";
    $data = $this->db
      ->table('payment')
      ->join('users', 'users.User_ID = payment.User_ID')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->join('dock_car', 'dock_car.Dock_car_id = reservation.Dock_car_id')
      ->join('bank_list', 'bank_list.bank_ID = payment.bank')
      ->where($where_sql)
      ->orderBy('Pay_DateTime', 'ASC')
      ->get()
      ->getResultArray();
    return $data;
  }

  public function viewPaymentAll_waiting_row()
  {
    $where_sql = "payment.confirm = 'waiting'";
    $data = $this->db
      ->table('payment')
      ->join('users', 'users.User_ID = payment.User_ID')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->join('dock_car', 'dock_car.Dock_car_id = reservation.Dock_car_id')
      ->where($where_sql)
      ->countAllResults();
    return $data;
  }

  public function count_all_payments()
  {
    $data = $this->db
      ->table('payment')
      ->countAllResults();
    return $data;
  }

  public function count_all_payments_success()
  {
    return $this->db
      ->table('payment')
      ->where('Confirm', 'success')
      ->countAllResults();
  }

  public function count_all_payments_waiting()
  {
    return $this->db
      ->table('payment')
      ->where('Confirm', 'waiting')
      ->countAllResults();
  }

  public function count_all_payments_day()
  {
    $datanow = date("Y-m-d");
    $where_sql = "Confirm = 'success' AND Pay_DateTime >= '$datanow'";
    return $this->db
      ->table('payment')
      ->where($where_sql)
      ->countAllResults();
  }

  // สำรอง ยังไม่มีการเรียกใช้งาน
  public function sum_price_total()
  {
    $where_sql = "Confirm = 'success'";
    return $this->db
      ->table('payment')
      ->select('sum(Total_Price) as sumTotalPrice')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->where($where_sql)
      ->get()
      ->getResultArray();
  }

  public function sum_price_day()
  {
    $datenow = date("Y-m-d");
    $where_sql = "Confirm = 'success' AND Pay_DateTime >= '$datenow'";
    return $this->db
      ->table('payment')
      ->select('sum(Total_Price) as sumTotalPrice')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->where($where_sql)
      ->get()
      ->getResultArray();
  }

  public function sum_price_month()
  {
    // $month = date("m");
    // $value = $month - 1;
    // if($value == 0) {
    //   $value = "12";
    // } else if($value <= 9) {
    //   $value = "0".$value;
    // }
    $date_start = date("Y-m")."-01";
    $date_end = date("Y-m")."-31";
    $where_sql = "Confirm = 'success' AND Pay_DateTime >= '$date_start' AND Pay_DateTime <= '$date_end'";
    return $this->db
      ->table('payment')
      ->select('sum(Total_Price) as sumTotalPrice')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->where($where_sql)
      ->get()
      ->getResultArray();
  }

  public function sum_price_year()
  {
    // $year = date("Y");
    // $value = $year - 1;
    $date_start = date("Y")."-01-01";
    $date_end = date("Y")."-12-31";
    $where_sql = "Confirm = 'success' AND Pay_DateTime >= '$date_start' AND Pay_DateTime <= '$date_end'";
    return $this->db
      ->table('payment')
      ->select('sum(Total_Price) as sumTotalPrice')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->where($where_sql)
      ->get()
      ->getResultArray();
  }

  public function viewPaymentAll()
  {
    $this->builder()
      // ->table('payment') // if use builder, hide table!
      ->join('users', 'users.User_ID = payment.User_ID')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->join('dock_car', 'dock_car.Dock_car_id = reservation.Dock_car_id')
      ->orderBy('Pay_ID', 'DESC');
      // hide get and getResultArray when use pagination!
      // ->get()
      // ->getResultArray();
      return $this;
  }

  public function viewPaymentAll_PDF()
  {
    return $this->db
      ->table('payment')
      ->join('users', 'users.User_ID = payment.User_ID')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->join('dock_car', 'dock_car.Dock_car_id = reservation.Dock_car_id')
      ->orderBy('Pay_ID', 'DESC')
      ->get()
      ->getResultArray();
  }

  public function getTicketDataByPayId($Pay_ID)
  {
    return $this->db
      ->table('payment')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->join('users', 'users.User_ID = reservation.User_ID')
      ->join('dock_car', 'dock_car.Dock_car_id = reservation.Dock_car_id')
      ->join('van', 'van.Van_ID = dock_car.Van_ID')
      ->where('Pay_ID', $Pay_ID)
      ->get()
      ->getResultArray();
  }

  public function view_all_around_byReservation_G()
  {
    $where_sql = "payment.confirm = 'success'";
    return $this->db
      ->table('payment')
      ->select('*')
      ->selectSum('Re_Seate', 'sum_re')
      ->selectCount('reservation.User_ID', 'count_re')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->join('dock_car', 'dock_car.Dock_car_id = reservation.Dock_car_id')
      ->join('van', 'van.Van_ID = dock_car.Van_ID')
      ->where($where_sql)
      ->groupBy('Reserve_Code')
      ->orderBy('Go_Date', 'DESC')
      ->get()
      ->getResultArray();
  }

  public function view_all_around_byReservation()
  {
    $where_sql = "payment.confirm = 'success'";
    return $this->db
      ->table('payment')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->join('users', 'users.User_ID = reservation.User_ID')
      ->join('ticket_price', 'ticket_price.Tic_Price_ID = reservation.Tic_Price_ID')
      ->where($where_sql)
      ->get()
      ->getResultArray();
  }
}