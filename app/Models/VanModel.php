<?php 

namespace App\Models;

use CodeIgniter\Model;

class VanModel extends Model {
    protected $table = 'van';
    protected $primaryKey = 'Van_ID ';
    protected $allowedFields = ['Van_ID ', 'Driver_ID', 'Van_Num', 'Plate', 'Seats_Num'];

    public function van_list(){
      $data = $this->db
      ->table('van')
      ->orderBy('Van_ID','ASC')
      ->join('users','van.Driver_ID = users.User_ID')
      ->get()
      ->getResultArray();
      return $data;  
  }

  public function van_find_by_id($van_id){
      $data = $this->db
      ->table('van')
      ->where('Van_ID',$van_id)
      ->join('users','van.Driver_ID = users.User_ID')
      ->limit(1)
      ->get()
      ->getResultArray();
      return $data;  
  }

  public function van_del_by_id($van_id){
    return $this->db
    ->table('van')
    ->where('Van_ID',$van_id)
    ->delete(); 
  }
}