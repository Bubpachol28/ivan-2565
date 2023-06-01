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
      <div class="col-md-10">
        <div class="tabcard_des px-4">
          <h2 class="text-center my-5">ประวัติการจองรถตู้</h2>
          <center>
            <?php if (isset($history) && !empty($history)) { ?>
                <?php
                foreach ($history as $history_) {
                ?>
                <div class="row his-res-table border-0 mt-3">
                  <div class="col-6 py-2 ps-5 text-start bg-pink-1 his-radius-td-1 his-font-txt">
                    <?php
                    $timeformat = date_create($history_['Re_DateTime']);
                    echo date_format($timeformat, "l d F Y");
                    ?>
                  </div>
                  <div class="col-6 py-2 text-end bg-pink-1 pe-5 his-radius-td-2 his-font-txt">
                    <a href="<?php echo base_url('/ticket' . "/" . $history_['Tick_Code']); ?>" target="_blank" class="unlink text-primary">รายละเอียด</a>
                  </div>
              </div>
              <div class="row">
                <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-5 col-sm-5 col-4 text-end pt-3 pb-0 his-font-txt">
                  <label><strong>หมายเลขตั๋ว</strong></label><br />
                  <label><strong>สถานี</strong></label><br />
                  <label><strong>วันที่เดินทาง</strong></label><br />
                  <label><strong>จำนวนที่นั่ง</strong></label>
                </div>
                <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1 d-xxl-block d-xl-block d-lg-none d-md-none d-sm-none d-none"></div>
                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-7 col-sm-7 col-8 text-start pt-3 pb-0 his-font-txt">
                  <label class="form-check-label"><?= $history_['Tick_Code']; ?></label><br />
                  <label class="form-check-label">
                    <?php
                    echo $history_['Station_Name'] . " - ";
                    foreach ($Station_End_Name as $his_end) {
                      if ($history_['Station_End'] == $his_end['Station_ID']) {
                        echo $his_end['Station_Name'];
                      }
                    }
                    ?>
                  </label><br />
                  <label class="form-check-label"><?= $history_['Go_Date']; ?></label><br />
                  <label class="form-check-label"><?= $history_['Re_Seate']; ?> ที่</label>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-5 col-sm-5 col-4 text-end pt-3 pb-0 his-font-txt">
                  <label><strong>ราคา <?= $history_['Total_Price']; ?> บาท</strong></label>
                </div>
                <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1 d-xxl-block d-xl-block d-lg-none d-md-none d-sm-none d-none"></div>
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-7 col-sm-7 col-8 text-start pt-3 pb-0 his-font-txt">
                  <a href="<?php echo base_url('/ticket' . "/" . $history_['Tick_Code']); ?>" target="_blank">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo base_url('/ticket' . "/" . $history_['Tick_Code']); ?>&chs=160x160&chld=L|0&choe=UTF-8" width="100px" height="100px">                 
                  </a>
                </div>
              </div>
            <?php } ?>
        </div>
      <?php } else { ?>
        <div class="alert alert-danger text-center mt-5" role="alert">
          ไม่พบประวัติการจองของคุณ!
        </div>
      <?php } ?>
      </center>
      </div>
    </div>
    <div class="col-md-1"></div>
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