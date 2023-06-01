<!DOCTYPE html>
<html lang="en">

<head>
  <title>I-Van</title>
  <?php require('components/header.php'); ?>
</head>

<body>
  <?php require('components/navbar.php'); ?>
  <div class="container check-re-font">
    <div class="row row-check-re">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="tabcard_des px-4">
          <center>
            <h2 class="text-center my-5">ตรวจสอบสถานะการจอง</h2>
            <?php if (isset($Reserve_ID)) { ?>
            <div class="card">
              <div class="card-header card-header-check-re">
                <p><strong>ข้อมูลผู้ใช้บริการ</strong></p>
              </div>
              <div class="card-body card-body-check-re">
                <div class="text-data">
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">ชื่อ-นามสกุล:</p>
                    </div>
                    <div class="col-7">
                      <p><?php echo $Q_F_Name." ".$Q_L_Name; ?></p>
                    </div>
                  </div>
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">เบอร์โทรศัพท์:</p>
                    </div>
                    <div class="col-7">
                      <p><?php echo $Q_Phone; ?></p>
                    </div>
                  </div>
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">อีเมล:</p>
                    </div>
                    <div class="col-7">
                      <p><?php echo $Q_Email; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-distance card-distance-check-re">
            </div>
            <div class="card">
              <div class="card-header card-header-check-re">
                <p><strong>ข้อมูลสถานะการจองทั้งหมด</strong></p>
              </div>
              <div class="card-body card-body-check-re">
                <div class="text-data text-data-check-re">
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">สถานีต้นทาง:</p>
                    </div>
                    <div class="col-7">
                      <p class="text-left"><?php echo $Station_Start; ?></p>
                    </div>

                  </div>

                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">สถานีปลายทาง:</p>
                    </div>
                    <div class="col-7">
                      <p class="text-left"><?php echo $Station_End; ?></p>
                    </div>

                  </div>
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">วัน / เดือน / ปี:</p>
                    </div>
                    <div class="col-7">
                      <p class="text-left"><?php echo $Go_Date; ?></p>
                    </div>

                  </div>
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">เวลาที่ออก:</p>
                    </div>
                    <div class="col-7">
                      <p class="text-left"><?php echo $Van_Out; ?></p>
                    </div>

                  </div>
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">จำนวนที่นั่ง:</p>
                    </div>
                    <div class="col-7">
                      <p class="text-left"><?php echo $Re_Seate; ?> ที่นั่ง</p>
                    </div>

                  </div>
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">ราคา:</p>
                    </div>
                    <div class="col-7">
                      <p class="text-left"><?php echo $Total_Price; ?> บาท</p>
                    </div>

                  </div>
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">สถานะ:</p>
                    </div>
                    <div class="col-7">
                      <p class="text-left"><?php echo $Status_Format; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } else { ?>
          <div class="alert alert-danger text-center mt-5" role="alert">
            ไม่พบข้อมูลการจองของคุณ!
          </div>
        <?php } ?>
          </center>
        </div>
      </div>
    </div>
  </div>
  <center>
    <?php if (isset($Reserve_ID) && !empty($Reserve_ID) AND $Confirm == "success") { ?>
      <a href="<?php echo base_url('/TicketController/createTicket?pay='.$Pay_ID); ?>" class="btn btn-logreg-confirm mt-3" style="width:200px;">รับตั๋ว</a>
    <?php } else if (isset($Reserve_ID) && !empty($Reserve_ID)) { ?>
      <button class="btn btn-logreg-confirm mt-3" style="width:200px;" disabled>รับตั๋ว</button>
    <?php } ?>
  </center>
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