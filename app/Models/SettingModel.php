<?php 

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\returnSelf;

class SettingModel extends Model {
  protected $table = 'setting';
  protected $primaryKey = 'setting';
  protected $allowedFields = ['setting', 'otp_sender', 'otp_token', 'otp_off_time', 'otp_key_off_time', 'session_timeout', 'pay_time_off', 'fb_app_id', 'fb_app_secret', 'fb_default_graph_version', 'note'];

  public function get_setting()
  {
    return $this->db
      ->table('setting')
      ->where('setting', 1)
      ->get()
      ->getRow();
  }
}