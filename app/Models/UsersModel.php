<?php 

namespace App\Models;

use CodeIgniter\Model;
use phpDocumentor\Reflection\Types\Null_;
use PHPUnit\Framework\Constraint\IsNull;

class UsersModel extends Model {

  protected $table = 'users';
  protected $primaryKey = 'User_ID';
  protected $allowedFields = ['User_ID', 'F_Name', 'L_Name', 'Email', 'Pass', 'Phone', 'Pic', 'Pos_ID', 'Facebook', 'Last_Login', 'Reg_Date', 'Last_Update', 'IP_Address'];

  public function get_data_login($email) 
  {
    $where_sql = "Email = '$email'";
    $data = $this
      ->table('users')
      ->where($where_sql)
      ->join('u_position', 'u_position.Pos_ID = users.Pos_ID')
      ->orderBy('User_ID', 'DESC')
      ->first();
    return $data;
  }

  public function get_data_login_fb($email, $fbId) 
  {
    $where_sql = "Email = '$email' AND Facebook = '$fbId'";
    $data = $this
      ->table('users')
      ->where($where_sql)
      ->join('u_position', 'u_position.Pos_ID = users.Pos_ID')
      ->orderBy('User_ID', 'DESC')
      ->first();
    return $data;
  }

  public function count_data_login($email) 
  {
    return $this->db
      ->table('users')
      ->where('Email', $email)
      ->countAllResults();
  }

  public function count_data_login_fb($email) 
  {
    $where_sql = "Email = '$email' AND Facebook IS NOT NULL";
    return $this->db
      ->table('users')
      ->where($where_sql)
      ->countAllResults();
  }

  public function update_login($User_ID)
  {
    return $this->db
    ->table('users')
    ->set('Last_login', time())
    ->set('IP_Address', $_SERVER['REMOTE_ADDR'])
    ->where('User_ID', $User_ID)
    ->update();
  }

  public function select_userByID($User_ID)
  {
    return $this->db
    ->table('users')
    ->where('User_ID', $User_ID)
    ->orderBy('User_ID', 'DESC')
    ->limit(1)
    ->get()
    ->getResultArray();
  }

  public function check_user_byEmailPhone($email, $phone)
  {
    $where_sql = "email = '$email' AND Phone = '$phone'";
    return $this->db
      ->table('users')
      ->where($where_sql)
      ->orderBy('User_ID', 'DESC')
      ->limit(1)
      ->get()
      ->getResultArray();
  }

  public function check_user_byEmailPhone_num($email, $phone)
  {
    $where_sql = "email = '$email' AND Phone = '$phone'";
    return $this->db
      ->table('users')
      ->where($where_sql)
      ->countAllResults();
  }

  public function viewAll_Users()
  {
    return $this->db
      ->table('users')
      ->join('u_position', 'users.Pos_ID = u_position.Pos_ID')
      ->orderBy('User_ID', 'ASC')
      ->get()
      ->getResultArray();
  }

  public function viewAll_Users_1()
  {
    $this->builder()
      ->where('Pos_ID', 1)
      ->orderBy('User_ID', 'ASC');
    return $this;
  }

  public function count_all_users()
  {
    return $this->db
      ->table('users')
      ->where('Pos_ID', 1)
      ->countAllResults();
  }

  public function del_user_byId($user_id)
  {
    return $this->db
      ->table('users')
      ->whereIn('User_ID', $user_id)
      ->delete();
  }

  public function driver_list()
  {
    $data = $this->db
    ->table('users')
    ->where('Pos_ID', 2)
    ->get()
    ->getResultArray();
    return $data;
  }

  public function count_users_check_email($get_userId, $get_email)
  {
    $where_sql = "User_ID = $get_userId AND Email = '$get_email'";
    return $this->db
      ->table('users')
      ->where($where_sql)
      ->countAllResults();
  }

  public function count_users_check_phone($get_userId, $get_phone)
  {
    $where_sql = "User_ID = $get_userId AND Phone = '$get_phone'";
    return $this->db
      ->table('users')
      ->where($where_sql)
      ->countAllResults();
  }

  public function delete_imgprofile($userId)
  {
    return $this->db
    ->table('users')
    ->set('Pic', null)
    ->where('User_ID', $userId)
    ->update();
  }
}