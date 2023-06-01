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
      <div class="col-md-8 justify-content-md-center px-4">
        <div class="tabcard_des">
          <h1 class="logreg-txt text-center py-5">เข้าสู่ระบบ</h1>
          <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('msg'); ?></div>
          <?php endif; ?>
          <form action="<?php echo base_url('/UserController/auth'); ?>" method="post">
            <div class="form-group row mb-4">
              <label for="staticEmail" class="col-md-3 col-sm-4 col-form-label logreg-label-txt">อีเมล</label>
              <div class="col-md-9 col-sm-8">
                <input type="email" name="email" class="form-control" id="inputforemail" value="<?php if (isset($_COOKIE['email'])) { echo $_COOKIE['email']; } ?>" />
              </div>
            </div>
            <div class="form-group row mb-2">
              <label for="inputPassword" class="col-md-3 col-sm-4 col-form-label logreg-label-txt">รหัสผ่าน</label>
              <div class="col-md-9 col-sm-8">
                <input type="password" name="password" class="form-control mb-3" id="inputforpassword" value="<?php if (isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" />
                <input type="checkbox" name="rememberme" id="cb-rememberme" class="cb-rememberme" <?php if (isset($_COOKIE["email"])) { echo "checked"; } ?> />
                <label for="cb-rememberme" class="cb-rememberme-txt mb-4">จดจำฉัน</label><br />
                <label class="unaccount-txt">ยังไม่มีบัญชี <a href="<?php echo base_url('/register') ?>" class="unaccount-link">คลิกที่นี่</a></label>
              </div>
            </div>
            <center>
              <div class="mt-5"><a href="<?php echo base_url('/forgot-password'); ?>" class="forgot-pwd-txt">ลืมรหัสผ่าน?</a></div>
              <button type="submit" class="btn btn-logreg-confirm mt-3 mb-5">เข้าสู่ระบบ</button>
            </center>
          </form>
          <center>
          <?php if (isset($fb_login_url)) { ?>
            <div class="fb-btn-d">
              <a href="<?= $fb_login_url; ?>" class="fb btn-fb">
                <i class="fa fa-facebook fa-fw"></i> ดำเนินการต่อด้วย Facebook
              </a>
          </div>
          <div class="fb-btn-m">
              <a href="<?= $fb_login_url; ?>" class="fb btn-fb">
                <i class="fa fa-facebook fa-fw"></i> ลงชื่อเข้าใช้งาน
              </a>
          </div>
          </center>
          <?php } ?>
        </div>

      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
  <?php require('components/footer.php'); ?>
</body>

</html>
<?php if (session()->getFlashdata('swel_title')) { ?>
<script>
  $(document).ready(function() {
      swal({
        title: "<?= session()->getFlashdata('swel_title') ?>",
        text: "<?= session()->getFlashdata('swel_text') ?>",
        icon: "<?= session()->getFlashdata('swel_icon') ?>",
        button: "<?= session()->getFlashdata('swel_button') ?>",
      });
  });
</script>
<?php } ?>