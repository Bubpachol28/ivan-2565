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
              <h4 class="text-center my-5">เพิ่มข้อมูลลูกค้า</h4>
            </div>

            <div class="row">
              <div class="col-1"></div>
              <div class="col-2">
                <label for="inputPassword6" class="col-form-label">ชื่อ - นามสกุล</label>
              </div>
              <div class="col-7">
                <div class="input-group">
                  <input class="form-control " type="text" name="title" pattern="{5,30}" minlength="5" maxlength="30" required placeholder="ชื่อ - นามสกุล">
                </div>
              </div>
              <div class="col-1"></div>
            </div>
            <br><br>
            <div class="row">
              <div class="col-1"></div>
              <div class="col-2">
                <label for="inputPassword6" class="col-form-label">อีเมล</label>
              </div>
              <div class="col-7">
                <div class="input-group">
                  <input class="form-control " type="text" name="title" pattern="{5,30}" minlength="5" maxlength="30" required placeholder="Email">
                </div>
              </div>
              <div class="col-1"></div>
            </div>
            <br><br>
            <div class="row">
              <div class="col-1"></div>
              <div class="col-2">
                <label for="inputPassword6" class="col-form-label">เบอร์โทรศัพท์</label>
              </div>
              <div class="col-7">
                <div class="input-group">
                  <input class="form-control " type="text" name="title" pattern="{5,30}" minlength="5" maxlength="30" required placeholder="เบอร์โทรศัพท์">
                </div>
              </div>
              <div class="col-1"></div>
            </div>
            <br><br>

            <br><br>
            <center>
              <button type="button" class="button-add">เพิ่มข้อมูล</button>
              <button type="button" class="button-delete">ยกเลิก</button>
            </center>
          </div>
        </div>
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
  });
</script>