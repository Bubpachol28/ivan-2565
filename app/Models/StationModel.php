<?php 

namespace App\Models;

use CodeIgniter\Model;

class StationModel extends Model {
  protected $table = 'station';
  protected $primaryKey = 'Station_ID';
  protected $allowedFields = ['Station_ID', 'Station_Name', 'Landmark', 'Province', 'District', 'SubDistrict', 'Lat', 'Lng'];

  public function getStation()
  {
    return $this->db
    ->table('station')
    ->orderBy('Station_ID', 'ASC')
    ->get()
    ->getResultArray();
  }

  public function getStationNK()
  {
    $where_sql = "Station_ID = 1 OR Station_ID = 7";
    return $this->db
    ->table('station')
    ->where($where_sql)
    ->orderBy('Station_ID', 'ASC')
    ->get()
    ->getResultArray();
  }

  public function getStationById_S($first_station)
  {
    $data = $this->where('Station_ID', $first_station)->first();
    if ($data) {
      return $data;
    }
  }

  public function getStationById_E($end_station)
  {
    $data = $this->where('Station_ID', $end_station)->first();
    if ($data) {
      return $data;
    }
  }
}