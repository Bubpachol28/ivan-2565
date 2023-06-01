<?php

namespace App\Models;

use CodeIgniter\Model;

class DockCarModel extends Model
{
  protected $table = 'dock_car';
  protected $primaryKey = 'Dock_car_id';
  protected $allowedFields = ['Dock_car_id', 'Around_Num', 'Van_Out', 'Station_ID', 'Van_ID', 'Festival_Date'];

  public function viewDockCar()
  {
    return $this->db
      ->table('dock_car')
      ->join('van', 'dock_car.Van_ID = van.Van_ID')
      ->orderBy('Dock_car_id', 'ASC')
      ->get()
      ->getResultArray();
  }

  public function viewDockCar_kanjanaburi_Festival_Row()
  {
    $datenow = date('Y-m-d');
    $where_sql = "Station_ID = 7 AND Festival_Date = '$datenow'";
    return $this->db
      ->table('dock_car')
      ->join('van', 'dock_car.Van_ID = van.Van_ID')
      ->where($where_sql)
      ->orderBy('Van_Out', 'ASC')
      ->countAllResults();
  }

  public function viewDockCar_kanjanaburi_Default()
  {
    $where_sql = "Station_ID = 7 AND Festival_Date = '0000-00-00' OR Festival_Date = null";
    return $this->db
      ->table('dock_car')
      ->join('van', 'dock_car.Van_ID = van.Van_ID')
      ->where($where_sql)
      ->orderBy('Van_Out', 'ASC')
      ->get()
      ->getResultArray();
  }

  public function viewDockCar_kanjanaburi_Festival()
  {
    $where_sql = "Station_ID = 7";
    return $this->db
      ->table('dock_car')
      ->join('van', 'dock_car.Van_ID = van.Van_ID')
      ->where($where_sql)
      ->orderBy('Van_Out', 'ASC')
      ->get()
      ->getResultArray();
  }

  public function viewDockCar_nakhonpathom_Festival_Row()
  {
    $datenow = date('Y-m-d');
    $where_sql = "Station_ID = 1 AND Festival_Date = '$datenow'";
    return $this->db
      ->table('dock_car')
      ->join('van', 'dock_car.Van_ID = van.Van_ID')
      ->where($where_sql)
      ->orderBy('Van_Out', 'ASC')
      ->countAllResults();
  }

  public function viewDockCar_nakhonpathom_Default()
  {
    $where_sql = "Station_ID = 1 AND Festival_Date = '0000-00-00' OR Festival_Date = null";
    return $this->db
      ->table('dock_car')
      ->join('van', 'dock_car.Van_ID = van.Van_ID')
      ->where($where_sql)
      ->orderBy('Van_Out', 'ASC')
      ->get()
      ->getResultArray();
  }

  public function viewDockCar_nakhonpathom_Festival()
  {
    $where_sql = "Station_ID = 1";
    return $this->db
      ->table('dock_car')
      ->join('van', 'dock_car.Van_ID = van.Van_ID')
      ->where($where_sql)
      ->orderBy('Van_Out', 'ASC')
      ->get()
      ->getResultArray();
  }

  public function getTicketPriceBySelect($first_station, $end_station)
  {
    $where_sql = "Station_Start = $first_station AND Station_End = $end_station";
    $data = $this->where($where_sql)->first();
    if ($data) {
      return $data;
    }
  }

  public function getDock_car_Out_byId($dock_car_id)
  {
    return $this->db
      ->table('dock_car')
      ->where('Dock_car_id', $dock_car_id)
      ->limit(1)
      ->get()
      ->getResultArray();
  }

  public function del_dockcar_byId_CB($dockcar_id)
  {
    return $this->db
      ->table('dock_car')
      ->whereIn('Dock_car_id', $dockcar_id)
      ->delete();
  }
}
