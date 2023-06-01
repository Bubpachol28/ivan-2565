<!DOCTYPE html>
<html lang="en">

<head>
  <title>I-Van</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <?php require_once(APPPATH . 'Views/components_emp/header.php'); ?>
</head>

<body>
  <a href="<?php echo base_url('/ducument/view-pdf') ?>" class="btn btn-primary">
    Download PDF
  </a>
  <center>
    <p class="text-center fs25">ข้อมูลสถิติ</p>
    <table width="100%">
      <tr>
        <td class="tb-dash-td">
          <label>จำนวนผู้ใช้บริการ <?php echo $count_all_users; ?></label>
        </td>
        <td class="tb-dash-td">
          <label>รายได้ของวันนี้ ฿<?php echo $sum_price_day; ?></label>
        </td>
        <td class="tb-dash-td">
          <label>รายได้ของเดือน ฿<?php echo $sum_price_month; ?></label>
        </td>
        <td class="tb-dash-td">
          <label>รายได้ของปี ฿<?php echo $sum_price_year; ?></label>
        </td>
      </tr>
      <tr>
        <td class="tb-dash-td">
          <label>จำนวนการจองของวัน <?php echo $count_all_payments_day; ?></label>
        </td>
        <td class="tb-dash-td">
          <label>การจองที่สำเร็จ <?php echo $count_all_payments_success; ?></label>
        </td>
        <td class="tb-dash-td">
          <label>การจองที่กำลังรอ <?php echo $count_all_payments_waiting; ?></label>
        </td>
        <td class="tb-dash-td">
          <label>การจองทั้งหมด <?php echo $count_all_payments; ?></label>
        </td>
      </tr>
    </table>
  </center>
  <div class="tabcard-showuser">
    <h3 class="ps-3">ข้อมูลการจอง</h3>
    <table class="table tb-dash-table table-hover">
      <tr>
        <td class="tb-dash-td fs20">
          <label>หมายเลข</label>
        </td>
        <td class="tb-dash-td fs20">
          <label>รหัสการจอง</label>
        </td>
        <td class="tb-dash-td fs20">
          <label>ชื่อผู้จอง</label>
        </td>
        <td class="tb-dash-td fs20">
          <label>วัน / เวลา</label>
        </td>
        <td class="tb-dash-td fs20">
          <label>ยอดชำระ</label>
        </td>
      </tr>
      <?php foreach ($allreservations as $value) { ?>
        <tr>
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
    </table>
  </div>
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