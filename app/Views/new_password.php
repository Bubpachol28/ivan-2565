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
      <div class="col-md-3"></div>
      <div class="col-md-6 justify-content-md-center px-4 text-center">
        <div class="tabcard_des px-4">
          <h4>กำหนดรหัสผ่านใหม่</h4>
          <br></br>
          <?php $validation = session()->getFlashdata('validation');
          if (isset($validation)) { ?>
            <div class="alert alert-danger text-start"><?= session()->getFlashdata('validation') ?></div>
          <?php } ?>
          <form action="<?php echo base_url('/UserController/custom_new_password'); ?>" method="POST">
            <input type="hidden" name="passwordkey" value="<?php if (isset($_GET['pwd']) && !empty($_GET['pwd'])) {
                                                              echo $_GET['pwd'];
                                                            } ?>">
            <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน" autocomplete="off" value="<?php if (session()->getFlashdata('password')) {
                                                                                                                            echo session()->getFlashdata('password');
                                                                                                                          } ?>">
            <input type="password" name="confpassword" class="form-control mt-3" placeholder="ยืนยันรหัสผ่าน">
            <input class="btn btn-logreg-confirm mt-3" type="submit" value="เปลี่ยนรหัสผ่าน" />
          </form>
        </div>
      </div>
      <div class="col-md-3"></div>
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