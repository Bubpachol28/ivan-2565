<?php 

namespace App\Models;

use CodeIgniter\Model;

class OTPTypeModel extends Model {
    protected $table = 'otp_type';
    protected $primaryKey = 'Type_ID ';
    protected $allowedFields = ['Type_ID ', 'Type_Name'];
}