<!DOCTYPE html>
<html lang="en">

<head>
  <title>I-Van</title>
  <?php require('components/header.php'); ?>
</head>

<body>
  <?php require('components/navbar.php'); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 justify-content-md-center px-4">
        <div class=" tabcard_des" style="padding: 20px 10% 20px 10%;">
          <h1 class="logreg-txt text-center py-5">รายงานปัญหา</h1>
          <?php if (session()->getFlashdata('error_report')) { ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error_report'); ?></div>
          <?php } ?>
          <?php if (session()->getFlashdata('success_report')) { ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success_report'); ?></div>
            <center><a href="<?php echo base_url('/report'); ?>" class="btn btn-logreg-confirm mt-5 mb-5">ย้อนกลับ</a></center>
          <?php } else { ?>
            <form action="<?php echo base_url('/ComplaintController/add_report'); ?>" method="post">
            <div class="row">
              <div class="col-sm-3 col-12 mb-4 pe-4 comp-font-text">
                <label class="fs18">ชื่อเรื่อง:</label>
              </div>
              <div class="col-sm-9 col-12 mb-4">
                <div class="input-group">
                  <i class="fa fa-edit icon fa-lg icon-heed" style="font-weight: normal;"></i>
                  <input class="input-fieldd form-control fs18" type="text" name="title" value="<?php if(session()->getFlashdata('flash_com_title')) { echo session()->getFlashdata('flash_com_title'); } ?>">
                </div>
              </div>
              <div class="col-sm-3 col-12 mb-4 pe-4 comp-font-text">
                <label class="fs18">ประเภท:</label>
              </div>
              <div class="col-sm-9 col-12 mb-4">
                <div class="input-group">
                <select name="type" class="form-select input-fieldd fs18">
                  <option value="" class="hide-selected">เลือกประเภทรายงาน</option>
                  <?php foreach($com_type as $value) { ?>
                    <option value="<?= $value['Com_Type_ID']; ?>" <?php
                    $Com_Type_ID = session()->getFlashdata('flash_com_type');
                      if(isset($Com_Type_ID)) { 
                        if($value['Com_Type_ID'] == $Com_Type_ID) { 
                          echo "selected";
                        }
                      } ?> ><?= $value['Com_Type_Name']; ?></option>
                  <?php } ?>
                </select>
                </div>
              </div>
              <div class="col-sm-3 col-12 mb-4 pe-4 comp-font-text">
                <label class="fs18">ข้อความ:</label>
              </div>
              <div class="col-sm-9 col-12S mb-4">
                <div class="input-group">
                  <i class="fa fa-edit icon fa-lg icon-heed" style="font-weight: normal;"></i>
                  <textarea class="form-control input-fieldd fs18" rows="8" id="comment" name="message"><?php if(session()->getFlashdata('flash_com_message')) { echo session()->getFlashdata('flash_com_message'); } ?></textarea>
                </div>
              </div>
            </div>
              <center>
                <button type="submit" class="btn btn-logreg-confirm mt-3 mb-5">ส่งข้อความ</button>
              </center>
            </form>
          <?php } ?>
        </div>
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
  <?php require('components/footer.php'); ?>
</body>

</html>