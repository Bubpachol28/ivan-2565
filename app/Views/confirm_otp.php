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
        <h4>ยืนยัน OTP
          <br></br>
        </h4>
        <?php $validation = session()->getFlashdata('validation');
          if(isset($validation)) { ?>
          <div class="alert alert-danger text-start"><?= session()->getFlashdata('validation') ?></div>
          <?php } ?>
        <form action="<?php echo base_url('/OTPController/reset_password?refer='.$_GET['refer'].'&key='.$_GET['key']); ?>" method="POST">
            <input class="form-control" type="number" placeholder="OTP" name="otp" onkeydown="javascript: return event.keyCode == 69 ? false : true" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="6" />
            <span>รหัสอ้างอิง: <?php echo $_GET['refer']; ?> ถูกส่งไปยัง <?php echo $phone_num_4_lenge; ?></span><br/>
            <input class="btn btn-logreg-confirm mt-3" type="submit" value="ยืนยัน" />
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
$(document).ready(function () {
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