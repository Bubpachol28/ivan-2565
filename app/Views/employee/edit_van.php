<!DOCTYPE html>
<html lang="en">

<head>
  <title>I-Van</title>
  <?php require_once(APPPATH . 'Views/components_emp/header.php'); ?>
</head>

<body>
  <div class="wrapper">
    <?php require_once(APPPATH . 'Views/components_emp/wrapper.php'); ?>
    <div id="content">
      <?php require_once(APPPATH . 'Views/components_emp/navbar.php'); ?>
      <div class="container">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10 justify-content-md-center px-4">
            <h4 class="text-center my-5">แก้ไขข้อมูลรถ</h4>
            <div class="tabcard_des mt-4">
              <?php $validation = session()->getFlashdata('validation');
              if (isset($validation)) { ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('validation') ?></div>
              <?php } ?>
              <form action="<?php echo base_url('/VanController/edit_van_form') ?>" method="post">
                <div class="row">
                  <input type="hidden" name="van_id" value="<?php echo $v_van_id; ?>">
                  <div class="col-3 mt-3">
                    <label class="fs20">หมายเลขรถ</label>
                  </div>
                  <div class="col-9 mt-3">
                    <input class="input-fieldd" type="text" placeholder="หมายเลขรถ" name="van_num" value="<?php echo $v_van_num; ?>">
                  </div>
                  <div class="col-3 mt-3">
                    <label class="fs20">ทะเบียนรถ</label>
                  </div>
                  <div class="col-9 mt-3">
                    <input class="input-fieldd" type="text" placeholder="ทะเบียนรถ" name="plate" value="<?php echo $v_plate; ?>">
                  </div>
                  <div class="col-3 mt-3">
                    <label class="fs20">ชื่อผู้ขับ</label>
                  </div>
                  <div class="col-9 mt-3">
                    <select class="form-select input-fieldd" name="driver">
                      <option class="hide-selected">เลือกผู้ขับ</option>
                      <?php foreach ($driverlist as $value) { ?>
                        <option value="<?= $value['User_ID']; ?>" <?php if ($v_driver_id == $value['User_ID']) { echo "selected"; } ?> ><?= $value['F_Name'] . " " . $value['L_Name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-3 mt-3">
                    <label class="fs20">จำนวนที่รองรับ</label>
                  </div>
                  <div class="col-9 mt-3">
                    <select class="form-select input-fieldd" name="seats">
                      <option value="" class="hide-selected">จำนวนที่รองรับ</option>
                      <?php
                      for ($x = 10; $x <= 16; $x += 1) {
                      ?>
                        <option value="<?php echo $x; ?>" <?php if($v_seats_num == $x) { echo "selected"; } ?> ><?php echo $x; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <center>
                  <button class="btn btn-success me-3 mt-5">ยืนยัน</button>
                  <button class="btn btn-outline-danger mt-5">ยกเลิก</button>
                </center>
              </form>
            </div>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
    </div> <!-- END CONTENT -->
  </div> <!-- END Wrapper -->
</body>
</html>
<script>
  $(document).ready(function() {
    // For This Page
    document.getElementById("wrapper-6").style.background = "#FFB000";

    <?php if (session()->getFlashdata('swel_title')) { ?>
      swal({
        title: "<?= session()->getFlashdata('swel_title') ?>",
        text: "<?= session()->getFlashdata('swel_text') ?>",
        icon: "<?= session()->getFlashdata('swel_icon') ?>",
        button: "<?= session()->getFlashdata('swel_button') ?>",
      });
    <?php } ?>
  });
</script>