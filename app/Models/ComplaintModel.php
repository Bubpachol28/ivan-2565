<?php 

namespace App\Models;

use CodeIgniter\Model;

class ComplaintModel extends Model {
  protected $table = 'complaint';
  protected $primaryKey = 'Com_ID ';
  protected $allowedFields = ['Com_ID ', 'Com_Type_ID', 'Com_Topic', 'Com_Content'];

  public function view_all_complaint_row()
  {
    return $this->db
      ->table('complaint')
      ->countAllResults();
  }

  public function view_all_complaint()
  {
    $this->builder()
      ->orderBy('Com_ID', 'DESC');
    return $this;
  }
}