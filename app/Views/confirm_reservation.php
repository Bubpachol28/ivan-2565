<!DOCTYPE html>
<html lang="en">

<head>
  <title>I-Van</title>
  <?php require('components/header.php'); ?>
</head>

<body>
  <?php require('components/navbar.php'); ?>
  <div class="container">
    <div class="row row-check-re">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="tabcard_des px-4">
          <center>
            <h2 class="text-center my-5">ยืนยันสถานะการจองตั๋ว</h2>
            <div class="card">
              <div class="card-header card-header-check-re">
                <p>ข้อมูลผู้ใช้บริการ</p>
              </div>
              <div class="card-body card-body-check-re">
                <div class="text-data">
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">ชื่อ-นามสกุล: </p>
                    </div>
                    <div class="col-7">
                      <p><?php echo $Q_F_Name . " " . $Q_L_Name; ?></p>
                    </div>
                  </div>
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">เบอร์โทรศัพท์: </p>
                    </div>
                    <div class="col-7">
                      <p><?php echo $Q_Phone; ?></p>
                    </div>
                  </div>
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">อีเมล: </p>
                    </div>
                    <div class="col-7">
                      <p><?php echo $Q_Email; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card" style="margin-top: 50px;">
              <div class="card-header card-header-check-re">
                <p>ข้อมูลสถานะการจอง</p>
              </div>
              <div class="card-body card-body-check-re">
                <div class="text-data">
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">สถานีต้นทาง:</p>
                    </div>
                    <div class="col-7">
                      <p><?php echo $Station_Start; ?></p>
                    </div>
                  </div>
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">สถานีปลายทาง:</p>
                    </div>
                    <div class="col-7">
                      <p><?php echo $Station_End; ?></p>
                    </div>
                  </div>
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">วันที่เดินทาง: </p>
                    </div>
                    <div class="col-7">
                      <p><?php echo $Go_Date; ?></p>
                    </div>
                  </div>
                  <div class="row row-check-re">
                    <div class="col-5">
                      <p class="text-center">เวลารถออก: </p>
                    </div>
                    <div class="col-7">
                      <p><?php echo $Van_Out; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card" style="margin-top: 50px;">
              <div class="card-header card-header-check-re">
                <p>ยอดเงินรวมที่ต้องชำระ</p>
              </div>
              <div class="card-body card-body-check-re px-0">
                <div class="text-data mx-0 d-md-block d-none">
                  <div class="row text-center">
                    <div class="col-3">
                      <span class="txt-color-1">ราคาตั๋วทั่วไป</span>
                    </div>
                    <div class="col-2">
                      <span>จำนวนที่นั่ง</span>
                    </div>
                    <div class="col-2">
                    </div>
                    <div class="col-2">
                      <span>ราคา</span>
                    </div>
                    <div class="col-3">
                      <strong><span>รวม(บาท)</span></strong>
                    </div>
                  </div>
                  <hr />
                  <div class="row text-center">
                    <div class="col-3">
                    </div>
                    <div class="col-2">
                      <span><?php echo $Re_Seate; ?></span>
                    </div>
                    <div class="col-2">
                      <span class="text-danger">x</span>
                    </div>
                    <div class="col-2">
                      <span><?php echo $Tic_Price; ?></span>
                    </div>
                    <div class="col-3">
                      <strong><span class="text-danger"><?php echo $Total_Price; ?></span></strong>
                    </div>
                  </div>
                  <hr />
                </div>
                <div class="text-data mx-0 d-md-none d-blcok">
                  <span class="txt-color-1 ms-5">ราคาตั๋วทั่วไป</span>
                  <hr />
                  <span class="ms-5">จำนวนที่นั่ง : <?php echo $Re_Seate; ?></span><br />
                  <span class="ms-5">ราคา : <?php echo $Tic_Price; ?></span><br />
                  <strong class="ms-5"><span>รวม(บาท) : </span><span class="text-danger"><?php echo $Total_Price; ?></span></strong>
                  <hr />
                </div>
                <div class="btn-group" role="group">
                  <a href="<?php echo base_url('/ReservationController/confirm') . "?reId=$Reserve_ID" ?>" class="btn btn-logreg-confirm mb-3">ยืนยันการจอง</a>
                  <p class="px-3"></p>
                  <a href="<?php echo base_url('/ReservationController/cancel') . "?reId=$Reserve_ID" ?>" class="btn btn-logreg-confirm mb-3">ยกเลิกการจอง</a>
                </div>
              </div>
            </div>
          </center>
        </div>
      </div>
    </div>
  </div>
  <?php require('components/footer.php'); ?>
</body>

</html>