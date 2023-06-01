<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
  protected $table = 'reservation';
  protected $primaryKey = 'Reserve_ID';
  protected $allowedFields = ['Reserve_ID', 'Reserve_Code', 'User_ID', 'Re_Seate', 'Re_DateTime', 'Re_TimeStamp', 'Go_Date', 'Dock_car_id', 'Tic_Price_ID', 'Station_Start', 'Station_End', 'Total_Price', 'Status'];

  public function checkBeforeReservation($first_station, $time, $date)
  {
    $session = session();
    $where_sql = "reservation.Dock_car_id = $time AND reservation.Station_Start = $first_station AND reservation.Go_Date = '$date'";
    $data = $this->db
      ->table('reservation')
      ->join('dock_car', 'reservation.Dock_car_id = dock_car.Dock_car_id')
      ->join('van', 'dock_car.Van_ID = van.Van_ID')
      ->where($where_sql)
      ->limit(1)
      ->get()
      ->getResultArray();
    if ($data == null) {
      $where_sql = "dock_car.Dock_car_id = $time";
      $data_sending = $this->db
        ->table('dock_car')
        ->join('van', 'dock_car.Van_ID = van.Van_ID')
        ->where($where_sql)
        ->limit(1)
        ->get()
        ->getResultArray();
      foreach ($data_sending as $value) {
        $havechair = $value['Seats_Num'] * 1;
        $session->setFlashdata('seats_num', $value['Seats_Num']);
        $session->setFlashdata('havechair', $value['Seats_Num']);
      }
    } else {
      $where_sql = "reservation.Dock_car_id = $time AND reservation.Station_Start = $first_station AND reservation.Go_Date = '$date'";
      $data_sending = $this->db
        ->table('reservation')
        ->select('*')
        ->selectSUM('reservation.Re_Seate', 'Sum_Re_Seate')
        ->join('dock_car', 'reservation.Dock_car_id = dock_car.Dock_car_id')
        ->join('van', 'dock_car.Van_ID = van.Van_ID')
        ->where($where_sql)
        ->limit(1)
        ->get()
        ->getResultArray();
      foreach ($data_sending as $value) {
        $havechair = $value['Seats_Num'] - $value['Sum_Re_Seate'];
        $session->setFlashdata('seats_num', $value['Seats_Num']);
        $session->setFlashdata('havechair', $havechair);
      }
    }
    return $havechair;
  }

  public function getReservationForConfirm($ses_userid)
  {
    $where_sql = "reservation.User_ID = $ses_userid AND reservation.Status = 'waiting'";
    return $this->db
      ->table('reservation')
      ->join('dock_car', 'reservation.Dock_car_id = dock_car.Dock_car_id')
      ->join('ticket_price', 'reservation.Tic_Price_ID = ticket_price.Tic_Price_ID')
      ->where($where_sql)
      ->orderBy('reservation.Reserve_ID', 'DESC')
      ->limit(1)
      ->get()
      ->getResultArray();
  }

  public function getReservationForConfirm_ById($ses_userid, $reserve_id)
  {
    $where_sql = "reservation.User_ID = $ses_userid AND reservation.Status = 'waiting' AND reservation.Reserve_ID = $reserve_id";
    return $this->db
      ->table('reservation')
      ->join('dock_car', 'reservation.Dock_car_id = dock_car.Dock_car_id')
      ->join('ticket_price', 'reservation.Tic_Price_ID = ticket_price.Tic_Price_ID')
      ->where($where_sql)
      ->limit(1)
      ->get()
      ->getResultArray();
  }

  public function getReservationWaitingAll($ses_userid)
  {
    $where_sql = "reservation.User_ID = $ses_userid AND reservation.Status = 'waiting'";
    return $this->db
      ->table('reservation')
      ->where($where_sql)
      ->join('dock_car', 'reservation.Dock_car_id = dock_car.Dock_car_id')
      ->join('ticket_price', 'reservation.Tic_Price_ID = ticket_price.Tic_Price_ID')
      ->orderBy('reservation.Reserve_ID', 'ASC')
      ->get()
      ->getResultArray();
  }

  public function getReservationAfterConfirm($ses_userid)
  {
    $where_sql = "User_ID = $ses_userid AND Status = 'confirm'";
    $data = $this->db
      ->table('reservation')
      ->join('dock_car', 'reservation.Dock_car_id = dock_car.Dock_car_id')
      ->join('ticket_price', 'reservation.Tic_Price_ID = ticket_price.Tic_Price_ID')
      ->where($where_sql)
      ->orderBy('reservation.Reserve_ID', 'DESC')
      ->limit(1)
      ->get()
      ->getResultArray();
    return $data;
  }

  public function getReservationAfterConfirm_reId($ses_userid, $reId)
  {
    $where_sql = "User_ID = $ses_userid AND Reserve_ID = $reId AND Status = 'confirm'";
    $data = $this->db
      ->table('reservation')
      ->join('dock_car', 'reservation.Dock_car_id = dock_car.Dock_car_id')
      ->join('ticket_price', 'reservation.Tic_Price_ID = ticket_price.Tic_Price_ID')
      ->where($where_sql)
      ->orderBy('reservation.Reserve_ID', 'DESC')
      ->limit(1)
      ->get()
      ->getResultArray();
    return $data;
  }

  public function confirmReservationById($ses_userid, $Reserve_ID)
  {
    $where_sql = "User_ID = $ses_userid AND Reserve_ID = $Reserve_ID AND Status = 'waiting'";
    return $this->db
      ->table('reservation')
      ->set('Re_TimeStamp', time())
      ->set('Status', 'confirm')
      ->where($where_sql)
      ->update();
  }

  public function deleteReservationWaitingAll($ses_userid)
  {
    $where_sql = "User_ID = $ses_userid AND Status = 'waiting'";
    return $this->db
      ->table('reservation')
      ->where($where_sql)
      ->delete();
  }

  public function deleteReservationById($ses_userid, $Reserve_ID)
  {
    $where_sql = "User_ID = $ses_userid AND Reserve_ID = $Reserve_ID AND Status = 'waiting'";
    return $this->db
      ->table('reservation')
      ->where($where_sql)
      ->delete();
  }
}
