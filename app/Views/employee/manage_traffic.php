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
      <div class="container">
        <div class="head-em">
          <h4 class="text-center my-5">จัดการการเดินรถ</h4>
        </div>
        <div class="tabcard_em px-4">
          <center>
            <?php echo $pager->links(); ?>
            <table class="mange-table" width="100%">
              <tr>
                <th class="mange-th">
                  <div class="form-check text-start">
                    <input type="checkbox" id="cd_manage_traffic" class="form-check-input" name="cd_manage_traffic" onClick="SelectAll(this);"> <label for="cd_manage_traffic">ทั้งหมด</label>
                  </div>
                </th>
                <th class="mange-th">ไอดี</th>
                <th class="mange-th">หมายเลขรถ</th>
                <th class="mange-th">สถานี</th>
                <th class="mange-th">รอบ</th>
                <th class="mange-th">เวลารถออก</th>
                <th class="mange-th">วัน</th>
                <th class="mange-th">แก้ไข</th>
              </tr>
              <?php foreach ($viewDockCar as $key => $value) { ?>
                <tr>
                  <td class="mange-td">
                    <div class="form-check">
                      <form action="<?php echo base_url('/DockCarController/del_dock_car_byId_CB'); ?>" method="POST">
                        <input class="form-check-input" type="checkbox" name="dockcar[]" value="<?= $value['Dock_car_id']; ?>" id="m_traffic_<?= $value['Dock_car_id']; ?>">
                    </div>
                  </td>
                  <td class="mange-td">
                    <label class="form-check-label" for="m_traffic_<?= $value['Dock_car_id']; ?>"><?= $value['Dock_car_id']; ?><label>
                  </td>
                  <td class="mange-td">
                    <label class="form-check-label" for="m_traffic_<?= $value['Dock_car_id']; ?>"><?= $value['Van_Num']; ?><label>
                  </td>
                  <td class="mange-td">
                    <label class="form-check-label" for="m_traffic_<?= $value['Dock_car_id']; ?>"><?= $value['Station_Name']; ?><label>
                  </td>
                  <td class="mange-td">
                    <label class="form-check-label" for="m_traffic_<?= $value['Dock_car_id']; ?>"><?= $value['Around_Num']; ?><label>
                  </td>
                  <td class="mange-td">
                    <label class="form-check-label" for="m_traffic_<?= $value['Dock_car_id']; ?>"><?= $value['Van_Out']; ?><label>
                  </td>
                  <td class="mange-td">
                    <label class="form-check-label" for="m_traffic_<?= $value['Dock_car_id']; ?>">
                      <?php
                      if ($value['Festival_Date'] == "0000-00-00") {
                        echo "ธรรมดา";
                      } else {
                        echo $value['Festival_Date'];
                      } ?><label>
                  </td>
                  <td class="mange-td">
                    <a class="btn btn-warning" href="<?php echo base_url('edit-driving').'/'.$value['Dock_car_id']; ?>">แก้ไข</a>
                  </td>
                </tr>
              <?php } ?>
            </table>
          </center>
          <br>
          <center>
            <a href="<?php echo base_url('/add-driving'); ?>" class="button-add me-3">เพิ่มข้อมูล</a>
            <input type="submit" class="button-delete" value="ลบข้อมูล"></a>
            </form>
          </center>
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
<script>
  function SelectAll(source) {
    var checkbox = document.getElementsByName('dockcar[]');
    for (var i = 0, n = checkbox.length; i < n; i++) {
      checkbox[i].checked = source.checked;
    }
  }
</script>