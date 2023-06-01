<?php 

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model {
    protected $table = 'notification';
    protected $primaryKey = 'N_ID ';
    protected $allowedFields = ['N_ID ', 'N_AddDT', 'N_Message', 'N_Read', 'N_ToUser'];

    public function getNotification()
    {
      $session = session();
      $ses_userid = $session->get('ses_id');
      return $this->db
        ->table('notification')
        ->where('N_ToUser', $ses_userid)
        ->orderBy('N_AddDT', 'DESC')
        ->limit(5)
        ->get()
        ->getResultArray();
    }

    public function CountNotificationOfUser_unread()
    {
      $session = session();
      $ses_userid = $session->get('ses_id');
      $where_sql = "N_ToUser = $ses_userid AND N_Read = 'false'";
      return $this->db
        ->table('notification')
        ->where($where_sql)
        ->countAllResults();
    }

    public function CountNotificationOfUser()
    {
      $session = session();
      $ses_userid = $session->get('ses_id');
      return $this->db
        ->table('notification')
        ->where('N_ToUser', $ses_userid)
        ->countAllResults();
    }
}