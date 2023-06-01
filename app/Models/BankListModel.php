<?php 

namespace App\Models;

use CodeIgniter\Model;

class BankListModel extends Model {
    protected $table = 'bank_list';
    protected $primaryKey = 'bank_ID ';
    protected $allowedFields = ['bank_ID ', 'bank_name_th', 'bank_name_en', 'bank_abbreviation', 'bank_number', 'bank_logo'];
}