<!DOCTYPE html>
<html lang="en">

<head>
  <title>I-Van</title>
  <?php require('components/header.php'); ?>
</head>

<body>
  <?php require('components/navbar.php'); ?>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 justify-content-md-center px-4">
        <div class=" tabcard_des px-0">
          <h1 class="logreg-txt text-center py-5">ข้อมูลส่วนตัว</h1>
          <center>
            <img src="<?php echo $Q_Picture; ?>" width="100px" height="100px" alt="<?php echo $Q_Picture; ?>" class="profile-user-profile">
          </center>
          <br>
          <div class="container">
            <div class="row pf-font-text">
              <div class="col-1"></div>
              <div class="col-10">
                <div class="row mt-4">
                  <div class="col-sm-3 col-2"></div>
                  <div class="col-3 txt-color-1">
                    <txt>ชื่อ </txt>
                  </div>
                  <div class="col-sm-6 col-7 txt-color-5">
                    <txt> <?php echo $Q_F_Name; ?></txt>
                  </div>

                </div>
                <div class="row mt-4">
                  <div class="col-sm-3 col-2"></div>
                  <div class="col-3 txt-color-1">
                    <txt>นามสกุล </txt>
                  </div>
                  <div class="col-6 txt-color-5">
                    <txt><?php echo $Q_L_Name; ?> </txt>
                  </div>

                </div>

                <div class="row mt-4">
                  <div class="col-sm-3 col-2"></div>
                  <div class="col-3 txt-color-1">
                    <txt>อีเมล </txt>
                  </div>
                  <div class="col-6 txt-color-5">
                    <txt><?php echo $Q_Email; ?> </txt>
                  </div>

                </div>
                <div class="row mt-4">
                  <div class="col-sm-3 col-2"></div>
                  <div class="col-3 txt-color-1">
                    <txt>เบอร์โทรศัพท์ </txt>
                  </div>
                  <div class="col-6 txt-color-5">
                    <txt id="profile_phone"><?php if (isset($Q_Phone)) {
                                              echo $Q_Phone;
                                            } else {
                                              echo "ไม่ระบุ";
                                            } ?></txt>
                  </div>

                </div>

                <?php if ($Q_Facebook == '' || $Q_Facebook == null) { ?>
                  <div class="row mt-4">
                    <div class="col-sm-3 col-2"></div>
                    <div class="col-3 txt-color-1">
                      <span>รหัสผ่าน </span>
                    </div>
                    <div class="col-6 txt-color-5">
                      <a href="<?php echo base_url('/change-password'); ?>" class="unlink">เปลี่ยนรหัสผ่าน</a>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <div class="col-1"></div>
            </div>

          </div>
          <br>
          <center>
            <a href="<?php echo base_url('/edit-form'); ?>" class="btn btn-logreg-confirm mt-3 mb-5">แก้ไขโปรไฟล์</a>
          </center>
        </div>
      </div>
      <div class="col-2"></div>
    </div>
  </div>
  <?php require('components/footer.php'); ?>
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
  });
</script>
<script>
  $(document).ready(function() {
    var phoneNo = document.getElementById('profile_phone').innerHTML;
    document.getElementById('profile_phone').innerHTML = phoneNo.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
  });
</script>