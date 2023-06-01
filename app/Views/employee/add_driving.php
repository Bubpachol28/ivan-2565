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
              <h4 class="text-center my-5">เพิ่มข้อมูลการเดินรถ</h4>
            </div>
            <?php $validation = session()->getFlashdata('validation');
              if(isset($validation)) { ?>
              <div class="alert alert-danger mx-5"><?= session()->getFlashdata('validation') ?></div>
            <?php } ?>
            <form action="<?php echo base_url('/DockCarController/add_dock_car'); ?>" method="POST">
            <div class="row">
              <div class="col-1"></div>
              <div class="col-2">
                <label for="inputPassword6" class="col-form-label">เลือกรถ:</label>
              </div>
              <div class="col-7">
              <select class="form-select input-fieldd" name="id_van">
                  <option value="" class="hide-selected">เลือกหมายเลขรถ</option>
                  <?php foreach($list_van as $value){?>
                  <option value="<?= $value['Van_ID']; ?>"><?= $value['Van_Num'];?></option>
                  <?php }?>
                </select>
          
              </div>
              <div class="col-2"></div>
            </div>
            <br>
            <div class="row">
              <div class="col-1"></div>
              <div class="col-2">
                <label for="inputPassword6" class="col-form-label">เลือกลำดับรอบรถ:</label>
              </div>
              <div class="col-7">
              <select class="form-select input-fieldd" name="around_num">
                  <option value="" class="hide-selected">ลำดับรอบรถ</option>
                  <?php  
                  for ($x=1; $x<=4; $x+=1) {
                ?>
                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                <?php
                  }
                ?>
                </select>
              </div>
              
              <div class="col-2"></div>
            </div>
            <br>
            <div class="row">
              <div class="col-1"></div>
              <div class="col-2">
                <label for="inputPassword6" class="col-form-label">เลือกสถานีรถ:</label>
              </div>
              <div class="col-7">
              <select class="form-select input-fieldd" name="station_id">
                  <option value="" class="hide-selected">สถานีรถ</option>
                  <?php foreach($list_Station as $value){?>
                  <option value="<?= $value['Station_ID']; ?>"><?= $value['Station_Name'];?></option>
                  <?php }?>
                </select>
              </div>
              
              <div class="col-2"></div>
            </div>
            <br>
            <div class="row">
              <div class="col-1"></div>
              <div class="col-2">
                <label for="inputPassword6" class="col-form-label">รอบเวลารถ:</label>
              </div>
              <div class="col-4">
                <div class="input-group">
                  <i class="fa fa-clock-o fa-lg icon-heed" style="font-weight: normal;"></i>
                  <input class="form-control " type="time" name="out_van">
                </div>
              </div>
              <div class="col-5"></div>
            </div>
            <br>
            <div class="row">
              <div class="col-1"></div>
              <div class="col-2">
                <label for="inputPassword6" class="col-form-label">เลือกวันที่:</label>
              </div>
              <div class="col-4">
                <div class="input-group">
                  <i class="fa fa-calendar fa-lg icon-heed" style="font-weight: normal;"></i>
                  <input class="form-control" type="date" name="date_van">
                </div>
              </div>
              <div class="col-5"></div>
            </div>
            <br/>
            <div class="row mb-5">
              <div class="col-3"></div>
              <div class="col-4">
                <input type="checkbox" name="festival" id="cb_add_driving" value="festival">
                <label for="cb_add_driving">วันเทศกาล</label>
              </div>
              <div class="col-5"></div>
            </div>
            <center>
              <input type="submit" class="button-add" value="เพิ่มข้อมูล"> 
              <input type="button" class="button-delete" value="ยกเลิก">
            </center>
            </form>           
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