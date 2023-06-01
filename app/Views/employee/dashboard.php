<!DOCTYPE html>
<html lang="en">

<head>
  <title>I-Van</title>
  <?php require_once(APPPATH . 'Views/components_emp/header.php'); ?>
  <style>
    ul.pagination li a {
      border: 2px solid #FFC758;
      border-radius: 10px;
      padding: 0px 20px 0px 20px;
      margin-right: 3px;
      color: black;
      text-decoration: none;
    }

    ul.pagination li a:hover {
      background-color: wheat;
      border: 2px solid #FFC758;
      border-radius: 10px;
      padding: 0px 20px 0px 20px;
      margin-right: 3px;
      color: black;
      text-decoration: none;
    }

    .active a {
      background-color: #FFC758;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <?php require_once(APPPATH . 'Views/components_emp/wrapper.php'); ?>
    <div id="content">
      <?php require_once(APPPATH . 'Views/components_emp/navbar.php'); ?>
      <div class="row mx-0 px-0 mt-4">
        <div class="col-1 ps-0"></div>
        <div class="col-10">
          <center>
            <!-- <h4 class="text-center my-5">ข้อมูลสถิติ</h4> -->
            <div class="row">
              <div class="col-3">
                <div class="tabcard-user">
                  <h5>
                    จำนวนผู้ใช้บริการ
                  </h5>
                  <br>
                  <div class="text-user">
                    <?php echo $count_all_users; ?>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="tabcard-user">
                  <h5>
                    รายได้ของวันนี้
                  </h5>
                  <br>
                  <div class="text-user">
                    <?php echo $sum_price_day; ?>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="tabcard-user">
                  <h5>
                    รายได้ของเดือน
                  </h5>
                  <br>
                  <div class="text-user">
                    <?php echo $sum_price_month; ?>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="tabcard-user">
                  <h5>
                    รายได้ของปี
                  </h5>
                  <br>
                  <div class="text-user">
                    <?php echo $sum_price_year; ?>
                  </div>
                </div>
              </div>
              <div class="col-3 mt-2">
                <div class="tabcard-user">
                  <h5>
                    จำนวนการจองของวัน
                  </h5>
                  <br>
                  <div class="text-user">
                    <?php echo $count_all_payments_day; ?>
                  </div>
                </div>
              </div>
              <div class="col-3 mt-2">
                <div class="tabcard-user">
                  <h5>
                    การจองที่สำเร็จ
                  </h5>
                  <br>
                  <div class="text-user text-success">
                    <?php echo $count_all_payments_success; ?>
                  </div>
                </div>
              </div>
              <div class="col-3 mt-2">
                <a href="<?php echo base_url('/check-payment'); ?>">
                  <div class="tabcard-hover">
                    <h5>
                      การจองที่กำลังรอ
                    </h5>
                    <br>
                    <div class="text-user text-warning">
                      <?php echo $count_all_payments_waiting; ?>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-3 mt-2">
                <div class="tabcard-user">
                  <h5>
                    การจองทั้งหมด
                  </h5>
                  <br>
                  <div class="text-user">
                    <?php echo $count_all_payments; ?>
                  </div>
                </div>
              </div>
            </div>
          </center>
          <div class="tabcard-showuser">
            <div class="row">
              <div class="col-6">
                <h3 class="ps-3">ข้อมูลการจอง</h3>
              </div>
              <div class="col-6 d-flex flex-row-reverse pt-2">
                <?= $pager->links(); ?>
              </div>
            </div>
            <table class="table tb-dash-table table-hover">
              <thead>
                <tr>
                  <th class="tb-dash-th">หมายเลข</th>
                  <th class="tb-dash-th">รหัสการจอง</th>
                  <th class="tb-dash-th">ชื่อผู้จอง</th>
                  <th class="tb-dash-th">วัน / เวลา</th>
                  <th class="tb-dash-th">ยอดชำระ</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($allreservations as $value) { ?>
                  <tr data-bs-toggle="tooltip" data-bs-placement="bottom" <?php
                                                                          if ($value['Confirm'] == 'success') {
                                                                            echo 'title="การชำระเงินเสร็จสิ้นแล้ว"';
                                                                          } else if ($value['Confirm'] == 'cancel') {
                                                                            echo 'title="รายการถูกยกเลิกโดยระบบ"';
                                                                          } else if ($value['Confirm'] == 'waiting') {
                                                                            echo 'title="กำลังรอการตรวจสอบ"';
                                                                          } else {
                                                                            echo 'title="เกิดข้อผิดพลาดไม่ทราบสาเหตุ!"';
                                                                          }
                                                                          ?>>
                    <td class="tb-dash-td">
                      <label class="form-check-label">
                        <?= $value['Reserve_ID']; ?>
                      </label>
                    </td>
                    <td class="tb-dash-td">
                      <label class="form-check-label">
                        <?= $value['Reserve_Code'] ?>
                      </label>
                    </td>
                    <td class="tb-dash-td">
                      <label class="form-check-label">
                        <?= $value['F_Name'] . " " . $value['L_Name']; ?>
                      </label>
                    </td>
                    <td class="tb-dash-td">
                      <label class="form-check-label">
                        <?php
                        $date = date_create($value['Re_DateTime']);
                        echo date_format($date, "d/m/Y - H.i");
                        ?>
                      </label>
                    </td>
                    <td class="tb-dash-td">
                      <label class="form-check-label">
                        <?php if ($value['Confirm'] == 'success') { ?>
                          <font color="green"><?= "฿" . $value['Total_Price']; ?></font>
                        <?php } else if ($value['Confirm'] == 'cancel') { ?>
                          <font color="red"><?= "฿" . $value['Total_Price']; ?></font>
                        <?php } else if ($value['Confirm'] == 'waiting') { ?>
                          <font color="orange"><?= "฿" . $value['Total_Price']; ?></font>
                        <?php } else { ?>
                          <font color="black"><?= "฿" . $value['Total_Price']; ?></font>
                        <?php } ?>
                      </label>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-1 pe-0"></div>
      </div>
    </div> <!-- END CONTENT -->
  </div> <!-- END Wrapper -->
</body>

</html>
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

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