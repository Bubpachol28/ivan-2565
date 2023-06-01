<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
  protected $table = 'ticket';
  protected $primaryKey = 'Tick_ID ';
  protected $allowedFields = ['Tick_ID ', 'Tick_GetDateTime', 'Tick_Code', 'Pay_ID'];

  public function get_history($user_ID)
  {
    $where_sql = "reservation.User_ID = $user_ID and payment.Confirm = 'success'";
    return $this->db
      ->table('ticket')
      ->join('payment', 'ticket.Pay_ID = payment.Pay_ID')
      ->join('reservation', 'payment.Reserve_ID = reservation.Reserve_ID ')
      ->join('station', 'station.Station_ID = reservation.Station_Start')
      ->where($where_sql)
      ->orderby('tick_ID', 'DESC')
      ->get()
      ->getResultArray();
  }

  public function check_ticket($Pay_ID)
  {
    $session = session();
    $ses_userid = $session->get('ses_id');
    $where_sql = "ticket.Pay_ID = $Pay_ID AND payment.User_ID = $ses_userid";
    $data = $this->db
      ->table('ticket')
      ->join('payment', 'payment.Pay_ID = ticket.Pay_ID')
      ->where($where_sql)
      ->countAllResults();
    return $data;
  }

  public function getTicket($ses_userid)
  {
    $where_sql = "payment.User_ID = $ses_userid AND reservation.Status = 'confirm' AND payment.Confirm = 'success'";
    $data = $this->db
      ->table('ticket')
      ->join('payment', 'ticket.Pay_ID = payment.Pay_ID')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->join('dock_car', 'reservation.Dock_car_id = dock_car.Dock_car_id')
      ->join('ticket_price', 'reservation.Tic_Price_ID = ticket_price.Tic_Price_ID')
      ->join('van', 'dock_car.Van_ID = van.Van_ID')
      ->join('station', 'station.Station_ID = reservation.Station_Start')
      ->where($where_sql)
      ->orderBy('ticket.Tick_ID', 'DESC')
      ->limit(1)
      ->get()
      ->getResultArray();
    return $data;
  }

  public function getTicket_byTicketId_row($ticket_code)
  {
    $where_sql = "Tick_Code = '$ticket_code'";
    return $this->db
      ->table('ticket')
      ->where($where_sql)
      ->countAllResults();
  }

  public function getTicket_byTicketId($ticket_code)
  {
    $where_sql = "ticket.Tick_Code = '$ticket_code'";
    return $this->db
      ->table('ticket')
      ->join('payment', 'ticket.Pay_ID = payment.Pay_ID')
      ->join('reservation', 'reservation.Reserve_ID = payment.Reserve_ID')
      ->join('dock_car', 'reservation.Dock_car_id = dock_car.Dock_car_id')
      ->join('ticket_price', 'reservation.Tic_Price_ID = ticket_price.Tic_Price_ID')
      ->join('van', 'dock_car.Van_ID = van.Van_ID')
      ->where($where_sql)
      ->orderBy('ticket.Tick_ID', 'DESC')
      ->limit(1)
      ->get()
      ->getResultArray();
  }

}
