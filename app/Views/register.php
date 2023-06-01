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
          <h1 class="logreg-txt text-center py-5">สมัครสมาชิก</h1>
          <?php $validation = session()->getFlashdata('validation');
          if(isset($validation)) { ?>
          <div class="alert alert-danger"><?= session()->getFlashdata('validation') ?></div>
          <?php } ?>
          <form action="<?php echo base_url('/UserController/new'); ?>" method="post">
            <div class="form-group row mb-4">
              <label for="inputfirstname" class="col-md-3 col-sm-4 col-form-label logreg-label-txt pe-0">ชื่อ<span class="pe-3"></span><font color="red">*</font></label>
              <div class="col-md-9 col-sm-8">
                <input type="text" name="firstname" class="form-control" id="inputfirstname" value="<?php if(session()->getFlashdata('F_Name')) { echo session()->getFlashdata('F_Name'); }?>">
              </div>
            </div>
            <div class="form-group row mb-4">
              <label for="inputlastname" class="col-md-3 col-sm-4 col-form-label logreg-label-txt pe-0">นามสกุล<font color="red"><span class="pe-3"></span>*</font></label>
              <div class="col-md-9 col-sm-8">
              <input type="text" name="lastname" class="form-control" id="inputlastname" value="<?php if(session()->getFlashdata('L_Name')) { echo session()->getFlashdata('L_Name'); }?>">
              </div>
            </div>
            <div class="form-group row mb-4">
              <label for="inputphone" class="col-md-3 col-sm-4 col-form-label logreg-label-txt pe-0">เบอร์โทรศัพท์<font color="red"><span class="pe-3"></span>*</font></label>
              <div class="col-md-9 col-sm-8">
                <input type="number" name="phone" class="form-control" id="inputphone" onkeydown="javascript: return event.keyCode == 69 ? false : true" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" value="<?php if(session()->getFlashdata('Phone')) { echo session()->getFlashdata('Phone'); }?>">
              </div>
            </div>
            <div class="form-group row mb-4">
              <label for="inputemail" class="col-md-3 col-sm-4 col-form-label logreg-label-txt pe-0">อีเมล<font color="red"><span class="pe-3"></span>*</font></label>
              <div class="col-md-9 col-sm-8">
                <input type="email" name="email" class="form-control" id="inputemail" value="<?php if(session()->getFlashdata('Email')) { echo session()->getFlashdata('Email'); }?>">
              </div>
            </div>
            <div class="form-group row mb-4">
              <label for="inputpassword" class="col-md-3 col-sm-4 col-form-label logreg-label-txt pe-0">รหัสผ่าน<font color="red"><span class="pe-3"></span>*</font></label>
              <div class="col-md-9 col-sm-8">
              <input type="password" name="password" class="form-control" id="inputpassword">
              </div>
            </div>
            <div class="form-group row mb-2">
              <label for="inputconfpassword" class="col-md-3 col-sm-4 col-form-label logreg-label-txt pe-0">ยืนยันรหัสผ่าน<font color="red"><span class="pe-3"></span>*</font></label>
              <div class="col-md-9 col-sm-8">
                <input type="password" name="confpassword" class="form-control mb-3" id="inputconfpassword">
                <input type="checkbox" name="acceptrule" id="cb-acceptrule" class="cb-acceptrule" <?php if(session()->getFlashdata('checkbox')) { echo "checked"; } ?> >
                <label for="cb-acceptrule" class="cb-acceptrule-txt mb-4">ฉันยอมรับ<a href="<?php echo base_url('/privacy'); ?>" class="acceptrule-link" target="_blank">นโยบายและข้อตกลง</a>ของเว็บไซต์ทั้งหมด<font color="red"><span class="pe-3"></span>*</font></label><br/>
              </div>
            </div>
            <center>
              <button type="button" class="btn btn-logreg-confirm mt-3 mb-5" data-bs-toggle="modal" data-bs-target="#register_model">สมัครสมาชิก</button>
            </center>

              <!-- Modal -->
              <div class="modal fade" id="register_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog reg-mt-dialog">
                  <div class="modal-content reg-model-content">
                    <div class="modal-header del-hr-model">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                      <span>ระบบจะทำการจัดเก็บข้อมูลส่วนบุคคลของผู้ใช้บริการในบางส่วน<br/>เพื่อนำไปใช้ในการบันทึกสถิติ ในการพัฒนาระบบต่อไป</span>
                      <button type="submit" class="btn btn-logreg-confirm mt-5">ยืนยันการสมัคร</button>
                    </div>
                  </div>
                </div>
              </div>
                </form>
</div>
                </div>
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
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : '{api-version}'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>