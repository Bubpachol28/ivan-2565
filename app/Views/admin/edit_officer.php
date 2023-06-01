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
        <div class="g-3 align-items-center">
          <div class="tabcard_em px-4">
            <div class="head-em">
              <h4 class="text-center my-5">แก้ไขข้อมูลพนักงาน</h4>
            </div>
            <?php $validation = session()->getFlashdata('validation');
              if(isset($validation)) { ?>
              <div class="alert alert-danger mx-5"><?= session()->getFlashdata('validation') ?></div>
            <?php } ?>
            <form action="<?php echo base_url('UserController/update_user_byId'); ?>" method="POST">
            <div class="row">
              <div class="col-1"></div>
              <div class="col-2">
                <label for="inputPassword6" class="col-form-label">ชื่อ</label>
              </div>
              <div class="col-7">
                <input type="hidden" name="user_id" value="<?php echo $u_user_id; ?>" readonly>
                <input class="form-control" type="text" name="firstname" value="<?php echo $u_fname; ?>">
              </div>
              <div class="col-2"></div>
            </div>
            <br>

            <div class="row">
              <div class="col-1"></div>
              <div class="col-2">
                <label for="inputPassword6" class="col-form-label">นามสกุล</label>
              </div>
              <div class="col-7">
                <input class="form-control" type="text" name="lastname" value="<?php echo $u_lname; ?>">
              </div>
              <div class="col-2"></div>
            </div>
            <br>

            <div class="row">
              <div class="col-1"></div>
              <div class="col-2">
                <label for="inputPassword6" class="col-form-label">เบอร์โทรศัพท์</label>
              </div>
              <div class="col-7">
                <input class="form-control" type="number" name="phone" onkeydown="javascript: return event.keyCode == 69 ? false : true" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" value="<?php echo $u_phone; ?>">
              </div>
              <div class="col-2"></div>
            </div>
            <br>

            <div class="row">
              <div class="col-1"></div>
              <div class="col-2">
                <label for="inputPassword6" class="col-form-label">ตำแหน่ง</label>
              </div>
              <div class="col-7">
                  <select class="form-select input-field" name="position">
                    <option value="" class="hide-selected">ตำแหน่ง</option>
                    <?php foreach($userposition_list as $value){ ?>
                    <option value="<?= $value['Pos_ID']; ?>" <?php if ($u_position == $value['Pos_ID']) { echo "selected"; } ?> ><?= $value['Pos_Name']; ?></option> 
                    <?php } ?>
                  </select>
              </div>
              <div class="col-2"></div>
            </div>
            <div class="text-center mt-5">
              <input type="submit" class="button-add" value="บันทึก">
              <a href="<?php echo base_url('/manage-allUsers'); ?>" class="button-delete">ยกเลิก</a>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- END CONTENT -->
  </div> <!-- END Wrapper -->
</body>
</html>
<script>
$(document).ready(function () {
    // For This Page
    document.getElementById("wrapper-8").style.background = "#FFB000";

  <?php if(session()->getFlashdata('swel_title')) { ?>
    swal({
      title: "<?= session()->getFlashdata('swel_title') ?>",
      text: "<?= session()->getFlashdata('swel_text') ?>",
      icon: "<?= session()->getFlashdata('swel_icon') ?>",
      button: "<?= session()->getFlashdata('swel_button') ?>",
    });
  <?php } ?>
});
</script>