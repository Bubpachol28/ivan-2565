<?php 

namespace App\Models;

use CodeIgniter\Model;

class ComplaintTypeModel extends Model {
  protected $table = 'complaint_type';
  protected $primaryKey = 'Com_Type_ID ';
  protected $allowedFields = ['Com_Type_ID ', 'Com_Type_Name'];

  public function view_all_complaint_type()
  {
    return $this->db
      ->table('complaint_type')
      ->orderBy('Com_Type_ID', 'ASC')
      ->get()
      ->getResultArray();
  }
}