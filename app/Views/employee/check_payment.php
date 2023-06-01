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
        <div class="head-em">
          <h4 class="text-center my-5">ตรวจสอบการชำระเงิน</h4>
        </div>
        <div class="tabcard_em px-4">
          <?php if ($listPaymentAll_row >= 1) { ?>
            <?php foreach ($listPaymentAll as $value) { ?>
              <div id="tb-payment-<?= $value['Pay_ID']; ?>">
                <div class="row" style="text-align: left;">
                  <div class="col-1"></div>
                  <div class="col-3">
                  <div class="txt-pay">
                    รหัสการชำระเงิน : <?= $value['Pay_ID']; ?>
                  </div>
                    <span>ชื่อ-นามสกุล :</span><br/>
                    <span>วัน/เดือน/ปี :</span><br/>
                    <span>เวลาที่จอง :</span><br/>
                    <span>ธนาคารที่ชำระ :</span><br/>
                  </div>
                  <div class="col-3">
                    <br/>
                    <span>
                      <?php
                      echo $value['F_Name'] . " " . $value['L_Name'];
                      ?>
                    </span><br/>
                    <span><?= $value['Go_Date']; ?></span><br/>
                    <span><?= $value['Van_Out']; ?> น.</span><br/>
                    <span><?= $value['bank_name_th']; ?> (<?= $value['bank_abbreviation']; ?>)</span>
                  </div>
                  <div class="col-1">
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#<?= "IDIS" . $value['Pay_ID']; ?>" style="margin-top:45px;">ดูสลิป</button>
                  </div>
                  <div class="col-1">
                    <center>
                      <div class="mt-5">
                        <span class="text-danger"><?= "฿" . $value['Total_Price']; ?></span>
                      </div>
                      <!-- Modal -->
                      <div class="modal fade" id="<?= "IDIS".$value['Pay_ID']; ?>" tabindex="-1" aria-labelledby="ExampleLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-0 py-0">
                              <img src="<?= base_url('uploads/slip/'.$value['Slip']); ?>" width="100%">
                            </div>
                          </div>
                        </div>
                      </div>
                    </center>
                  </div>
                  <div class="col-3 text-center">
                    <button class="btn btn-success my-3" onclick="update_payment(<?= $value['Pay_ID']; ?>, <?= $value['User_ID']; ?>)">ยืนยัน</button><br/>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#model<?= $value['Pay_ID']; ?>">ยกเลิก</button>
                    <!-- Modal -->
                    <div class="modal fade" id="model<?= $value['Pay_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ยกเลิกการชำระเงิน <strong>#<?= $value['Pay_ID']; ?></strong></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action="<?php echo base_url('PaymentController/cancel_payment'); ?>" method="post">
                            <div class="modal-body">
                              <label for="reason">โปรดระบุหมายเหตุ</label>
                              <input type="hidden" name="pay_id" value="<?= $value['Pay_ID']; ?>">
                              <textarea type="text" id="reason" class="form-control" name="reason" required></textarea>
                            </div>
                            <div class="modal-footer">
                              <input type="submit" class="btn btn-success" value="ยืนยัน" />
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->
                  </div>
                </div>
                <hr>
              </div>
            <?php
            }
          } else {
            ?>
            <div class="alert alert-danger mb-0" role="alert">
              ไม่มีข้อมูลการชำระเงินที่ต้องตรวจสอบ
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<script>
  function update_payment(id, uid) {
    swal({
        title: "คุณมั่นใจที่จะอนุมัติการจองหรือไม่?",
        buttons: true,
        icon: 'info',
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type: "POST",
            url: "ajax_query/ajax_updatepayment.php",
            dataType: "html",
            data: {
              pay_id: id,
              user_id: uid
            },
            error() {
              alert("มีบางอย่างผิดพลาด โปรดติดต่อผู้ดูแลระบบโดยด่วน!");
            }
          });
          document.getElementById("tb-payment-" + id).style.display = "none";
          swal("ยืนยันข้อมูลการชำระเงินเสร็จสิ้น", {
            icon: "success",
          });
        }
      });
  }
</script>
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