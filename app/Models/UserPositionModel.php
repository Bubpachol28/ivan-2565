<?php 

namespace App\Models;

use CodeIgniter\Model;

class UserPositionModel extends Model {
    protected $table = 'u_position';
    protected $primaryKey = 'Pos_ID ';
    protected $allowedFields = ['Pos_ID ', 'Pos_Name', 'Pos_Name_TH'];

    public function userposition_list()
    {
        return $this->db
        ->table('u_position')
        ->orderBy('Pos_ID', 'DESC')
        ->get()
        ->getResultArray();
    }
}

?>