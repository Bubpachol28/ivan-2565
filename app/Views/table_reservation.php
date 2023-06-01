<!DOCTYPE html>
<html lang="en">

<head>
  <title>I-Van</title>
  <?php require('components/header.php'); ?>
</head>

<body>
  <?php require('components/navbar.php'); ?>
  <div class="container">
    <h2 class="text-center my-5">ดูตารางเวลารถ</h2>
    <div class="input-group date ms-auto" style="width:200px;">
      <input type="date" id="input-date" onchange="list_table_reserve()" class="form-control form-control-index" name="date" value="<?php echo date("Y-m-d"); ?>" required />
    </div>
    <div class="row">
      <p class="mb-0">เส้นทาง : นครปฐม(มาลัยแมน) -> กาญจนบุรี(บขส.)</p>
      <div class="col-lg-6 col-12 px-3 mt-3">
        <table class="tb-res-table table tb-dash-table table-borderless table-hover fs17">
          <thead>
            <tr class="tr-color-tbre">
              <th class="tb-res-th">หมายเลขรถ</th>
              <th class="tb-res-th">รอบเวลารถ</th>
            </tr>
          </thead>
          <tbody id="list_n_to_k">
            <?php foreach ($dockcars_nakhonpathom as $value) { ?>
              <tr>
                <td class="tb-res-td">
                  <label class="form-check-label"><?php echo $value['Van_Num']; ?></label>
                </td>
                <td class="tb-res-td">
                  <label class="form-check-label">
                    <?php
                    $timeformat = date_create($value['Van_Out']);
                    echo date_format($timeformat, "H.i" . " น.");
                    ?>
                  </label>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="col-lg-6 col-12 px-3 mt-3">
        <table class="tb-res-table table tb-dash-table table-borderless table-hover fs17">
          <tr class="tr-color-tbre">
            <th class="tb-res-th">ปลายทาง</th>
            <th class="tb-res-th">ราคา(บาท)</th>
          </tr>
          <?php foreach ($ticketprice_ntok as $price_ntok) { ?>
            <tr>
              <td class="tb-res-td">
                <label class="form-check-label"><?php echo $price_ntok['Station_Name']; ?></label>
              </td>
              <td class="tb-res-td">
                <label class="form-check-label"><?php echo $price_ntok['Tic_Price']; ?><label>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <br> <br>
    <p>เส้นทาง กาญจนบุรี(บขส.) -> นครปฐม(มาลัยแมน)</p>
    <div class="row">
      <div class="col-lg-6 col-12 px-3 mt-3">
        <table class="tb-res-table table tb-dash-table table-borderless table-hover fs17">
          <thead>
            <tr class="tr-color-tbre">
              <th class="tb-res-th">หมายเลขรถ</th>
              <th class="tb-res-th">รอบเวลารถ</th>
            </tr>
          </thead>
          <tbody id="list_k_to_n">
            <?php foreach ($dockcars_kanjanaburi as $value) { ?>
              <tr>
                <td class="tb-res-td">
                  <label class="form-check-label"><?php echo $value['Van_Num']; ?></label>
                </td>
                <td class="tb-res-td">
                  <label class="form-check-label">
                    <?php
                    $timeformat = date_create($value['Van_Out']);
                    echo date_format($timeformat, "H.i" . " น.");
                    ?>
                  </label>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="col-lg-6 col-12 px-3 mt-3">
        <table class="tb-res-table table tb-dash-table table-borderless table-hover fs17">
          <tr class="tr-color-tbre">
            <th class="tb-res-th">ปลายทาง</th>
            <th class="tb-res-th">ราคา(บาท)</th>
          </tr>
          <?php foreach ($ticketprice_kton as $price_kton) { ?>
            <tr>
              <td class="tb-res-td">
                <label class="form-check-label"><?php echo $price_kton['Station_Name']; ?></label>
              </td>
              <td class="tb-res-td">
                <label class="form-check-label"><?php echo $price_kton['Tic_Price']; ?></label>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
  <br><br>
  <center>
    <div class="btn-group" role="group" aria-label="Basic example">
      <a href="<?php echo base_url('/reservation') ?>" class="button btn-logreg-confirm mb-5">จองตั๋วที่นี่</a>
    </div>
  </center>
  </div>
  <?php require('components/footer.php'); ?>
</body>

</html>
<script>
  function list_table_reserve() {
    var date = document.getElementById("input-date").value;
    $.ajax({
      type: "POST",
      url: "ajax_query/ajax_table_dock_car_1.php",
      dataType: "html",
      data: {
        date: date
      },
      success: function(data) {
        $('tbody#list_n_to_k').html(data);
      },
      error() {
        $('tbody#list_n_to_k').html('An Error');
      }
    });
    $.ajax({
      type: "POST",
      url: "ajax_query/ajax_table_dock_car_7.php",
      dataType: "html",
      data: {
        date: date
      },
      success: function(data) {
        $('tbody#list_k_to_n').html(data);
      },
      error() {
        $('tbody#list_k_to_n').html('An Error');
      }
    });
  }
</script>
<script>
  $(function(){
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var month2 = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var day2 = dtToday.getDate() + 3;

    if(month < 10 && month > 0) {
      month = '0' + month;
    } else if (month > 12) {
      month = '0' + 1;
    } else {
      month = month;
    }

    if(day < 10 && day > 0) {
      day = '0' + day;
    } else {
      day = day;
    }
    if(day2 < 10 && day2 > 0) {
      day2 = '0' + day2;
    } else if (day2 > 30) {
      if(month2 < 10 && month2 > 0) {
        month2 = '0' + month2;
      } else if (month2 > 12) {
        month2 = '01';
      } else {
        month2 = month2+1;
      }
      day2 = '03';
    } else {
      day2 = day2;
    }
    var year = dtToday.getFullYear();
    var minDate = year + '-' + month + '-' + day;
    var maxDate = year + '-' + month2 + '-' + day2;
    $('#input-date').attr({
      'min': minDate,
      'max': maxDate
    });
  });
</script>