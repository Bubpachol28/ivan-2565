<?php
$session = session();
$checkname = $session->get('ses_id');
$ses_F_Name = $session->get('ses_first_name');
$ses_L_Name = $session->get('ses_last_name');
$ses_Email = $session->get('ses_email');
$ses_Phone = $session->get('ses_phone');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>I-Van</title>
  <?php require('components/header.php'); ?>
</head>

<body onload="timeout()">
  <?php require('components/navbar.php');
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 justify-content-md-center px-4">
        <div class="payment-tabcard-des">
          <h1 id="payment-header" class="logreg-txt text-center py-3">ชำระเงิน</h1>
          <div id="hideontimeout">
            <form action="<?php echo base_url('/PaymentController/add_payment'); ?>" method="POST" enctype="multipart/form-data">
              <table class="pm-table" width="100%">
                <thead>
                  <tr>
                    <th colspan="3" class="pm-th">ข้อมูลผู้ใช้บริการ</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="pm-td pt-3" width="30%">ชื่อ-นามสกุล:</td>
                    <td class="pm-td-input pt-3" width="70%"><?php echo $Q_F_Name . " " . $Q_L_Name; ?></td>
                  </tr>
                  <tr>
                    <td class="pm-td pt-3" width="30%">เบอร์โทรศัพท์:</td>
                    <td class="pm-td-input pt-3" width="70%"><?php echo $Q_Phone; ?></td>
                  </tr>
                  <tr>
                    <td class="pm-td pt-3" width="30%">อีเมล:</td>
                    <td class="pm-td-input pt-3" width="70%"><?php echo $Q_Email; ?></td>
                  </tr>
                </tbody>
              </table>
              <table class="pm-table mt-4" width="100%">
                <thead>
                  <tr>
                    <th colspan="3" class="pm-th">ข้อมูลสถานะการจอง</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="pm-td pt-3" width="30%">สถานีต้นทาง:</td>
                    <td class="pm-td-input pt-3" width="70%"><?php echo $Station_Start; ?></td>
                  </tr>
                  <tr>
                    <td class="pm-td pt-3" width="30%">สถานีปลายทาง:</td>
                    <td class="pm-td-input pt-3" width="70%"><?php echo $Station_End; ?></td>
                  </tr>
                  <tr>
                    <td class="pm-td pt-3" width="30%">วัน / เดือน / ปี:</td>
                    <td class="pm-td-input pt-3" width="70%"><?php echo $Go_Date; ?></td>
                  </tr>
                  <tr>
                    <td class="pm-td pt-3" width="30%">เวลาที่ออก:</td>
                    <td class="pm-td-input pt-3" width="70%"><?php echo $Van_Out; ?></td>
                  </tr>
                  <tr>
                    <td class="pm-td pt-3" width="30%">จำนวนที่นั่ง:</td>
                    <td class="pm-td-input pt-3" width="70%"><?php echo $Re_Seate; ?></td>
                  </tr>
                </tbody>
              </table>
              <table class="pm-table pm-del-border mt-4" width="100%">
                <thead>
                  <tr>
                    <th colspan="3" class="pm-th">ยอดเงินรวมที่ต้องชำระ</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="pm-td pt-3" width="30%"><strong>ราคารวม:</strong></td>
                    <td class="pm-td-input pt-3 text-danger" width="70%"><strong><?php echo "฿" . $Total_Price; ?></strong></td>
                  </tr>
                </tbody>
              </table>
              <table class="pm-table pm-del-top" width="100%">
                <thead>
                  <tr>
                    <th colspan="3" class="pm-th-bank">ช่องทางการชำระเงิน</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="pm-td-input" width="100%">
                      <div class="row">
                        <?php foreach ($banklist as $value) { ?>
                          <div class="col-sm-6">
                            <div class="custom-control custom-radio ps-5">
                              <input type="radio" id="customRadio<?= $value['bank_ID']; ?>" name="radioBank" class="custom-control-input" value="<?= $value['bank_ID']; ?>" <?php if (session()->getFlashdata('bank_id') && $value['bank_ID'] == session()->getFlashdata('bank_id')) { echo "checked"; } ?> >
                              <label class="custom-control-label" for="customRadio<?= $value['bank_ID']; ?>">
                                <img src="<?php echo base_url('images/' . $value['bank_logo']); ?>" width="50px" class="mx-3 mb-4" />
                                หมายเลข: <?= $value['bank_number']; ?>
                              </label>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </td>
                  </tr>
                </tbody>
                <thead>
                  <tr>
                    <th colspan="3" class="pm-th-bank">หลักฐานการชำระเงิน</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td width="50%">
                      <div class="mb-4 mt-2" style="padding:0px 60px;">
                        <input type="hidden" name="reId" value="<?php echo $Reserve_ID; ?>">
                        <input type="file" name="slip" id="formFile" class="form-control" accept="image/x-png,image/jpeg,image/jpg">
                      </div>
                    </td>
                    <td width="50%"></td>
                  </tr>
                </tbody>
              </table>
              <center><button type="submit" class="btn btn-logreg-confirm mt-5 mb-4">ชำระเงิน</button></center>
            </form>
          </div>
          <center>
            <strong>
              <font color="red"><span id="timeout"></span></font>
            </strong>
            <div id="payment-timeout" style="display:none;">
              <br /><a href="<?php echo base_url('/reservation'); ?>" class="btn btn-logreg-confirm my-4">กลับไปการจอง</a>
            </div>
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
<script>
  function timeout_c() {
    var refresh = 500;
    mytime = setTimeout('timeout()', refresh)
  }

  function timeout() {
    var time_now = new Date();
    var minutesToAdd = <?php echo $TimeToPay; ?>; // 1 = 1 นาที
    var gtime = <?php echo $Re_TimeStamp . "000"; ?>;
    var time = gtime + minutesToAdd * 60000;
    var resettime = time - time_now.getTime();
    if (resettime > 0) {
      var seconds = Math.floor((resettime / 1000) % 60);
      var minutes = Math.floor((resettime / (1000 * 60)) % 60);
      minutes = (minutes < 10) ? +minutes : minutes;
      seconds = (seconds < 10) ? +seconds : seconds;
      var time_set_m = minutes;
      if (time_set_m < 10) {
        time_set_m = "0" + time_set_m;
      }
      var time_set_s = seconds;
      if (time_set_s < 10) {
        time_set_s = "0" + time_set_s;
      }
      var time_now_set = time_set_m + ":" + time_set_s;
      document.getElementById("timeout").innerHTML = "โปรดชำระเงินภายใน " + time_now_set + " นาที!";
    } else {
      $.ajax({
        type: "POST",
        url: "ajax_query/ajax_delreservationbyid.php",
        dataType: "html",
        data: {
          userid: <?php echo $Q_ID; ?>,
          reserve_id: <?php echo $Reserve_ID; ?>
        },
        beforeSend: function() {
          $('#timeout').html('กำลังลบข้อมูล...');
        },
        success: function(data) {
          $('#timeout').html('หมดเวลา! การจองนี้ถูกยกเลิกเรียบร้อยแล้ว');
          document.getElementById("hideontimeout").style.display = "none";
          document.getElementById("payment-timeout").style.display = "block";
          document.getElementById("payment-header").innerHTML = "การชำระเงินล้มเหลว!";
          clearInterval(mytime);
        },
        error() {
          $('#timeout').html('มีบางอย่างผิดพลาด!');
          document.getElementById("hideontimeout").style.display = "none";
          document.getElementById("payment-timeout").style.display = "block";
          document.getElementById("payment-header").innerHTML = "การชำระเงินล้มเหลว!";
          clearInterval(mytime);
        }
      });
    }
    timeout_c();
  }
</script>