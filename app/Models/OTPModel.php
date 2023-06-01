<?php 

namespace App\Models;

use CodeIgniter\Model;

class OTPModel extends Model {
    protected $table = 'otp';
    protected $primaryKey = 'OTP_ID ';
    protected $allowedFields = ['OTP_ID', 'TimeToSend', 'TimeToOut', 'Refer', 'Number', 'OTP_Key', 'End_Key', 'ToPhone', 'User', 'Type'];

    public function confirm_otp_type_1_model($otp, $refer, $key)
    {
      $timestamp_now = time();
      $where_sql = "Number = $otp AND Refer = '$refer' AND OTP_Key = '$key' AND Type = 1 AND TimeToOut >= $timestamp_now";
      return $this->db
        ->table('otp')
        ->where($where_sql)
        ->countAllResults();
    }

    public function check_Refer_Key_type1($refer, $key)
    {
      $where_sql = "Refer = '$refer' AND OTP_Key = '$key' AND Type = 1";
      return $this->db
        ->table('otp')
        ->where($where_sql)
        ->orderBy('OTP_ID', 'DESC')
        ->limit(1)
        ->get()
        ->getResultArray();
    }

    public function update_TimestampAfterConfirmOTP($otp, $refer, $key, $st_otp_time_out_key)
    {
      $where_sql = "Number = $otp AND Refer = '$refer' AND OTP_Key = '$key'";
      $timestamp = time() + $st_otp_time_out_key;
      return $this->db
        ->table('otp')
        ->set('TimeToOut', $timestamp)
        ->where($where_sql)
        ->update();
    }

    public function check_TimeToOut_ByEndKey($key)
    {
      $timestamp_now = time();
      $where_sql = "End_Key = '$key' AND TimeToOut >= $timestamp_now";
      return $this->db
        ->table('otp')
        ->where($where_sql)
        ->countAllResults();
    }

    public function getEndKey($otp, $refer, $key)
    {
      $timestamp_now = time();
      $where_sql = "Number = $otp AND Refer = '$refer' AND OTP_Key = '$key' AND TimeToOut > $timestamp_now";
      return $this->db
        ->table('otp')
        ->select('User, End_Key')
        ->where($where_sql)
        ->orderBy('OTP_ID', 'DESC')
        ->limit(1)
        ->get()
        ->getResultArray();
    }

    public function delete_OtherData_ByUserID_Type1($User_ID)
    {
      $timestamp_now = time();
      $where_sql = "User = $User_ID AND TimeToOut < $timestamp_now AND Type = 1";
      return $this->db
      ->table('otp')
      ->where($where_sql)
      ->delete();
    }

    public function check_End_Key($key)
    {
      $timestamp_now = time();
      $where_sql = "End_Key = '$key' AND TimeToOut > $timestamp_now";
      return $this->db
        ->table('otp')
        ->where($where_sql)
        ->limit(1)
        ->countAllResults();
    }

    public function get_data_from_End_Key($key)
    {
      $timestamp_now = time();
      $where_sql = "End_Key = '$key' AND TimeToOut > $timestamp_now";
      return $this->db
        ->table('otp')
        ->where($where_sql)
        ->orderBy('OTP_ID', 'DESC')
        ->limit(1)
        ->get()
        ->getResultArray();
    }
}