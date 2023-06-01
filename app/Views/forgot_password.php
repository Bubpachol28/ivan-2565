<?php $session = session(); ?>
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
      <div class="col-md-8 justify-content-md-center px-4 text-center">
        <div class="tabcard_des px-4">
          <h4 class="text-center my-5">ลืมรหัสผ่าน</h4>
          <center>

            <form action="<?php echo base_url('/OTPController/forgotPwd'); ?>" method="POST">
              <div class="form-group row mb-4">
                <label for="staticEmail" class="col-md-4 col-sm-4 col-form-label logreg-label-txt">อีเมลที่ใช้ลงทะเบียน</label>
                <div class="col-md-7 col-sm-8">
                  <input class="form-control" type="email" name="email" placeholder="example@ivan.com" value="<?php if (session()->getFlashdata('email')) {
                                                                                                                echo session()->getFlashdata('email');
                                                                                                              } else if (isset($_COOKIE['email'])) {
                                                                                                                echo $_COOKIE['email'];
                                                                                                              } ?>" required />
                </div>
              </div>

              <div class="form-group row mb-4">
                <label for="staticEmail" class="col-md-4 col-sm-4 col-form-label logreg-label-txt">เบอร์โทรศัพท์ (10หลัก)</label>
                <div class="col-md-7 col-sm-8">
                  <input class="form-control " type="number" name="phone" placeholder="" value="<?php if (session()->getFlashdata('phone')) {
                                                                                                  echo session()->getFlashdata('phone');
                                                                                                } ?>" onkeydown="javascript: return event.keyCode == 69 ? false : true" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" required />
                </div>
              </div>
              <button type="submit" class="btn btn-logreg-confirm mt-3 mb-5">ขอรหัส OTP</button>

            </form>
          </center>
        </div>
      </div>
      <div class="col-md-2"></div>
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