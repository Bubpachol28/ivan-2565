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
        <div class=" tabcard_des">
          <h1 class="logreg-txt text-center py-5">เปลี่ยนรหัสผ่าน</h1>
          <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('msg'); ?></div>
          <?php endif; ?>
          <form action="<?php echo base_url('/UserController/update_pwd'); ?>" method="post">
            <div class="form-group row mb-4">
              <label for="staticEmail" class="col-md-3 col-sm-4 col-form-label logreg-label-txt pe-0">รหัสผ่านเดิม<font color="red"> *</font></label>
              <div class="col-md-9 col-sm-8">
                <input type="password" name="oldpassword" class="form-control" id="inputforoldpassword">
              </div>
            </div>
            <div class="form-group row mb-2">
              <label for="inputPassword" class="col-md-3 col-sm-4 col-form-label logreg-label-txt pe-0">รหัสผ่านใหม่<font color="red"> *</font></label>
              <div class="col-md-9 col-sm-8">
                <input type="password" name="newpassword" class="form-control mb-3" id="inputfornewpassword">
              </div>
            </div>
            <div class="form-group row mb-2">
              <label for="inputconfpassword" class="col-md-3 col-sm-4 col-form-label logreg-label-txt pe-0">ยืนยันรหัสผ่าน <font color="red"> *</font></label>
              <div class="col-md-9 col-sm-8">
                <input type="password" name="confpassword" class="form-control mb-3" id="inputconfpassword">
              </div>
            </div>
            <center>
              <button type="submit" class="btn btn-logreg-confirm mt-3 mb-5">ยืนยัน</button>
            </center>
          </form>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
  <?php require('components/footer.php'); ?>
</body>

</html>