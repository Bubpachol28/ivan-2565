<!DOCTYPE html>
<html lang="en">

<head>
  <title>I-Van</title>
  <?php require_once(APPPATH . 'Views/components_emp/header.php'); ?>
  <!-- <style>
    .input-setting {
      color: green;
    }
  </style> -->
</head>

<body>
  <div class="wrapper">
    <?php require_once(APPPATH . 'Views/components_emp/wrapper.php'); ?>
    <div id="content">
      <?php require_once(APPPATH . 'Views/components_emp/navbar.php'); ?>
      <div class="head-em">
        <h4 class="text-start my-5">การตั้งค่า</h4>
      </div>
      <div class="row mx-0 px-0">
        <div class="col-1 ps-0"></div>
        <div class="col-10">
          <form action="<?php echo base_url('SettingController/save'); ?>" method="POST">
            <div class="form-group">
              <label for="otp_sender"><strong>ชื่อผู้ส่งโอทีพี :</strong> <?php echo $otp_sender; ?></label>
              <input type="text" id="otp_sender" name="otp_sender" class="form-control input-setting mb-3" placeholder="ตัวอย่าง : Now" value="<?php echo $otp_sender; ?>" />
              <label for="otp_token" onclick="otp_token();" style="text-overflow: ellipsis; width: 400px; overflow: hidden; white-space: nowrap;"><strong>คีย์เข้าใช้โอทีพี :</strong> <?php echo $otp_token; ?></label>
              <textarea rows="3" id="otp_token" name="otp_token" class="form-control input-setting mb-3" placeholder="ตัวอย่าง : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."><?php echo $otp_token; ?></textarea>
              <label for="otp_off_time"><strong>ระยะการหมดเวลาของ OTP (หน่วยวินาที) :</strong> <?php echo $otp_off_time; ?> วินาที</label>
              <input type="number" id="otp_off_time" name="otp_off_time" class="form-control input-setting mb-3" placeholder="ตัวอย่าง : 900" value="<?php echo $otp_off_time; ?>" />
              <label for="otp_key_off_time"><strong>ระยะการหมดเวลาของคีย์ OTP (หน่วยวินาที) :</strong> <?php echo $otp_key_off_time; ?> วินาที</label>
              <input type="number" id="otp_key_off_time" name="otp_key_off_time" class="form-control input-setting mb-3" placeholder="ตัวอย่าง : 900" value="<?php echo $otp_key_off_time; ?>" />
              <label for="session_timeout"><strong>ระยะการหมดเวลาของเซสชั่น (-1 ไม่จำกัด หน่วยวินาที) :</strong> <?php echo $session_timeout; ?> วินาที</label>
              <input type="number" id="session_timeout" name="session_timeout" class="form-control input-setting mb-3" placeholder="ตัวอย่าง : 6400" value="<?php echo $session_timeout; ?>" />
              <label for="pay_time_off"><strong>ระยะการหมดเวลาของการชำระเงิน (หน่วยนาที) :</strong> <?php echo $pay_time_off; ?> นาที</label>
              <input type="number" id="pay_time_off" name="pay_time_off" class="form-control input-setting mb-3" placeholder="ตัวอย่าง : 15" value="<?php echo $pay_time_off; ?>" />
              <label for="fb_app_id"><strong>เฟสบุ๊คแอปไอดี :</strong> <?php echo $fb_app_id; ?></label>
              <input type="text" id="fb_app_id" name="fb_app_id" class="form-control input-setting mb-3" placeholder="ตัวอย่าง : 610041970537938" value="<?php echo $fb_app_id; ?>" />
              <label for="fb_app_secret"><strong>เฟสบุ๊คแอปคีย์ความปลอดภัย :</strong> <?php echo $fb_app_secret; ?></label>
              <input type="text" id="fb_app_secret" name="fb_app_secret" class="form-control input-setting mb-3" placeholder="ตัวอย่าง : 8b014dd5a63e6349a7509e6c7e5ae4ea" value="<?php echo $fb_app_secret; ?>" />
              <label for="fb_default_graph_version"><strong>เฟสบุ๊คแอปเวอร์ชั่น :</strong> <?php echo $fb_default_graph_version; ?></label>
              <input type="text" id="fb_default_graph_version" name="fb_default_graph_version" class="form-control input-setting mb-3" placeholder="ตัวอย่าง : v14.0" value="<?php echo $fb_default_graph_version; ?>" />
              <label for="note" style="text-overflow: ellipsis; width: 400px; overflow: hidden; white-space: nowrap;"><strong>โน๊ต :</strong> <?php echo $note; ?></label>
              <textarea rows="5" id="note" name="note" class="form-control input-setting mb-3"><?php echo $note; ?></textarea>
              <input type="submit" class="btn btn-primary mt-3 mb-5" value="บันทึก" style="width: 100%;" />
            </div>
          </form>
        </div>
        <div class="col-1 pe-0"></div>
      </div>
    </div> <!-- END CONTENT -->
  </div> <!-- END Wrapper -->
</body>

</html>
<script>
  $(document).ready(function() {
    <?php if (session()->getFlashdata('swel_title')) { ?>
      swal({
        title: "<?= session()->getFlashdata('swel_title') ?>",
        text: "<?= session()->getFlashdata('swel_text') ?>",
        icon: "<?= session()->getFlashdata('swel_icon') ?>",
        button: "<?= session()->getFlashdata('swel_button') ?>",
      });
    <?php } ?>

    $("input").change(function() {
      var otp_sender = document.getElementById('otp_sender').value;
      if (otp_sender == "" || otp_sender == 0 || otp_sender == null) {
        document.getElementById('otp_sender').style.borderColor="red";
      }
      var otp_token = document.getElementById('otp_token').value;
      if (otp_token == "" || otp_token == 0 || otp_token == null) {
        document.getElementById('otp_token').style.borderColor="red";
      }
      var otp_off_time = document.getElementById('otp_off_time').value;
      if (otp_off_time == "" || otp_off_time == 0 || otp_off_time == null) {
        document.getElementById('otp_off_time').style.borderColor="red";
      }
      var otp_key_off_time = document.getElementById('otp_key_off_time').value;
      if (otp_key_off_time == "" || otp_key_off_time == 0 || otp_key_off_time == null) {
        document.getElementById('otp_key_off_time').style.borderColor="red";
      }
      var ses
      sion_timeout = document.getElementById('session_timeout').value;
      if (session_timeout == "" || session_timeout == 0 || session_timeout == null) {
        document.getElementById('session_timeout').style.borderColor="red";
      }
      var pay_time_off = document.getElementById('pay_time_off').value;
      if (pay_time_off == "" || pay_time_off == 0 || pay_time_off == null) {
        document.getElementById('pay_time_off').style.borderColor="red";
      }
      var fb_app_id = document.getElementById('fb_app_id').value;
      if (fb_app_id == "" || fb_app_id == 0 || fb_app_id == null) {
        document.getElementById('fb_app_id').style.borderColor="red";
      }
      var fb_app_secret = document.getElementById('fb_app_secret').value;
      if (fb_app_secret == "" || fb_app_secret == 0 || fb_app_secret == null) {
        document.getElementById('fb_app_secret').style.borderColor="red";
      }
      var fb_default_graph_version = document.getElementById('fb_default_graph_version').value;
      if (fb_default_graph_version == "" || fb_default_graph_version == 0 || fb_default_graph_version == null) {
        document.getElementById('fb_default_graph_version').style.borderColor="red";
      }
    });
  });

  function otp_token() {
    var text = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90aHNtcy5jb21cL21hbmFnZVwvYXBpLWtleSIsImlhdCI6MTY1NjgzNjMwNiwibmJmIjoxNjU2ODM2MzA2LCJqdGkiOiIyZTdXamRKblRsTTJVUEJ2Iiwic3ViIjoxMDYxNzUsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.Hm3GFETQxd51p3g-9Ocj_Mzb2WqVZABoCjlJN_cK6K4";
    navigator.clipboard.writeText(text).then(function() {
      console.log('Copying to clipboard was successful! > ' + text);
    });
  }
</script>
