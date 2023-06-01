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
          <h4 class="text-center my-5">ตรวจสอบรอบจอง</h4>
        </div>
        <div class="tabcard_em px-4">
          <?php foreach ($around_G as $value_G) { ?>
            <div id="around_list_<?= $value_G['Reserve_Code']; ?>" class="around_list border border-warning rounded ps-3 py-2 fs16 mt-3" onclick="active_list('<?= $value_G['Reserve_Code']; ?>')">
              <div id="around_header_<?= $value_G['Reserve_Code']; ?>">วันที่ <font color="#808080"><?= $value_G['Go_Date']; ?> </font>เวลา <font color="#808080"><?= $value_G['Van_Out']; ?></font> หมายเลขรอบ <font color="#808080"><?= $value_G['Dock_car_id']; ?></font> รหัสการจอง <font color="#808080"><?= $value_G['Reserve_Code']; ?></font> จำนวน <font color="#808080"><?= $value_G['count_re']; ?> </font>รายการ</div>
              <div id="around_body_<?= $value_G['Reserve_Code']; ?>" style="display: none;">
              <?php foreach ($around as $value) { ?>
                <?php if($value['Reserve_Code'] == $value_G['Reserve_Code']) { ?>
                    <div>• <?= $value['F_Name']." ".$value['L_Name']." | "; ?>
                    <?php
                    foreach($station as $ss_value) {
                      if($ss_value['Station_ID'] == $value['Station_Start']) {
                        echo $ss_value['Station_Name'];
                      }
                    }
                    foreach($station as $se_value) {
                      if($se_value['Station_ID'] == $value['Station_End']) {
                        echo " > ".$se_value['Station_Name'];
                      }
                    }
                    ?>
                    <?= " | ".$value['Re_Seate']." ที่นั่ง | ราคาตั๋ว ".$value['Tic_Price']." บาท"; ?>
                    </div>
                <?php }
                } $seats_remind = $value_G['Seats_Num']-$value_G['sum_re']; ?>
              <span class="fs14"><?= "ที่นั่งสูงสุด ".$value_G['Seats_Num']." จองแล้ว ".$value_G['sum_re']." คงเหลือ ".$seats_remind." ที่นั่ง"; ?></span>
              </div>
            </div>
          <?php } ?>
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

  function active_list(code) {
    var custom = 'rgb(255, 212, 133)';
    var white = 'rgb(255, 255, 255)';
    var around_list = document.getElementById("around_list_"+code);
    var around_body = document.getElementById("around_body_"+code);
    var around_header = document.getElementById("around_header_"+code);
    var currenColor = window.getComputedStyle(around_list, null).backgroundColor;
    if (currenColor === custom) {
      around_list.style.backgroundColor = white;
      around_body.style.display = "none";
      around_header.style.fontWeight = null;
    } else {
      around_list.style.backgroundColor = custom;
      around_list.style.transition = "all 0.3s";
      around_body.style.display = "block";
      around_header.style.fontWeight = "900";
    }
  }

  function disableselect(e) {
    return false
  }
  function reEnable() {
    return true
  }
  //if IE4+
  document.onselectstart=new Function ("return false")
  //if NS6
  if (window.sidebar){
    document.onmousedown=disableselect
    document.onclick=reEnable
  }
</script>