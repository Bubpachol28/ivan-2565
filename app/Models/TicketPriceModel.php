<?php 

namespace App\Models;

use CodeIgniter\Model;

class TicketPriceModel extends Model {
    protected $table = 'ticket_price';
    protected $primaryKey = 'Tic_Price_ID';
    protected $allowedFields = ['Tic_Price_ID', 'Station_Start', 'Station_End', 'Tic_Price'];

    public function getTicketPrice()
    {
      return $this->db
      ->table('ticket_price')
      ->orderBy('Tic_Price_ID', 'ASC')
      ->get()
      ->getResultArray();
    }

    public function getTicketPriceById($first_station, $end_station)
    {
      $where_sql = "Station_Start={$first_station} AND Station_End={$end_station}";
      $data = $this->where($where_sql)->first();
      if ($data) {
        return $data;
      }
    }

    public function CountTicketNtoK()
    {
      return $this->db
      ->table('ticket_price')
      ->join('station', 'ticket_price.Station_End = station.Station_ID')
      ->where('Station_Start', 1)
      ->orderBy('Tic_Price', 'ASC')
      ->get()
      ->getResultArray();
    }

    public function CountTicketKtoN()
    {
      return $this->db
      ->table('ticket_price')
      ->join('station', 'ticket_price.Station_End = station.Station_ID')
      ->where('Station_Start', 7)
      ->orderBy('Tic_Price', 'ASC')
      ->get()
      ->getResultArray();
    }
}