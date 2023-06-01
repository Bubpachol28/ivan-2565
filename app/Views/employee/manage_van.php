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
        <h4 class="text-center my-5">การจัดการข้อมูลรถ</h4>
        <div class="tabcard-showuser">
          <div class="text-end mb-3">
            <button class="btn btn-success me-3"><a href="<?php echo base_url('/addvan'); ?>">เพิ่มข้อมูล</a></button>
          </div>
          <table class="table tb-dash-table table-hover">
            <tr>
              <th class="tb-dash-th">รหัสรถ</th>
              <th class="tb-dash-th">หมายเลขรถ</th>
              <th class="tb-dash-th">ป้ายทะเบียน</th>
              <th class="tb-dash-th">ที่นั่งจำกัด</th>
              <th class="tb-dash-th">ชื่อผู้ขับรถ</th>
              <th class="tb-dash-th">แก้ไข | ลบ</th>
            </tr>
            <?php foreach ($vanlist as $value) { ?>
              <tr>
                <td class="tb-dash-td">
                  <label class="form-check-label" for="list_a1">
                    <?= $value['Van_ID']; ?>
                  </label>
                </td>
                <td class="tb-dash-td">
                  <label class="form-check-label" for="list_a1">
                    <?= $value['Van_Num']; ?>
                  </label>
                </td>
                <td class="tb-dash-td">
                  <label class="form-check-label" for="list_a1">
                    <?= $value['Plate']; ?>
                    <label>
                </td>
                <td class="tb-dash-td">
                  <label class="form-check-label" for="list_a1">
                    <?= $value['Seats_Num']; ?>
                    <label>
                </td>
                <td class="tb-dash-td">
                  <label class="form-check-label" for="list_a1">
                    <?= $value['F_Name'] . " " . $value['L_Name']; ?>
                    <label>
                </td>
                <td class="tb-dash-td">
                  <button class="btn btn-warning me-3 px-4"><a href="<?php echo base_url('/edit-van').'/'.$value['Van_ID']; ?>">แก้ไข</a></button>
                  <button class="btn btn-danger"><a href="<?php echo base_url('/VanController/del_van_byId?van=') . $value['Van_ID']; ?>">ลบออก</a></button>
                </td>
              </tr><?php } ?>
          </table>
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