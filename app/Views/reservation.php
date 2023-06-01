<!DOCTYPE html>
<html lang="en">

<head>
  <title>I-Van</title>
  <?php require('components/header.php'); ?>
</head>

<body>
  <?php require('components/navbar.php'); ?>
  <center>
    <div class="fontCompany2">
      <h1>จองตั๋วรถตู้</h1>
    </div>
  </center>

  <?php if (session()->getFlashdata('has_beforce_reservation')) { ?>
    <!-- Modal -->
    <div class="modal fade" id="model_beforce_reservation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">คุณมีการจองที่ยังไม่ได้ยืนยัน!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php
            $has_beforce_reservation = session()->getFlashdata('has_beforce_reservation');
            foreach ($has_beforce_reservation as $value) { ?>
              <div class="row mb-4">
                <div class="col-1">
                  <input type="radio" id="radio_old_reserve_<?= $value['Reserve_ID']; ?>" class="radio_modal_reservaion mt-2" name="radio_old_reserve" value="<?= $value['Reserve_ID']; ?>" required>
                </div>
                <div class="col-11">
                  <?php
                  $dateReserve = $value['Re_DateTime'];
                  $dateReserve = date_create($dateReserve);
                  $dateReserveFormat = date_format($dateReserve, "วันที่ d/m/Y เวลา H:i น.");
                  $goDate = $value['Go_Date'];
                  $goDate = date_create($goDate);
                  $goDateFormat = date_format($goDate, "วันที่ d/m/Y");
                  $vanOut = $value['Van_Out'];
                  $vanOut = date_create($vanOut);
                  $vanOutFormat = date_format($vanOut, "เวลา H:i น.");
                  ?>
                  <label for="radio_old_reserve_<?= $value['Reserve_ID']; ?>"><strong>หมายเลข :</strong> <?= $value['Reserve_Code']; ?></label><br />
                  <?php
                  foreach ($station_getStations as $station_value) {
                    if ($station_value['Station_ID'] == $value['Station_Start']) {
                      $station_start_name = $station_value['Station_Name'];
                    }
                    if ($station_value['Station_ID'] == $value['Station_End']) {
                      $station_end_name = $station_value['Station_Name'];
                    }
                  }
                  ?>
                  <label for="radio_old_reserve_<?= $value['Reserve_ID']; ?>"><strong>สถานี :</strong> <?= $station_start_name . " ไปยัง " . $station_end_name; ?></label><br />
                  <label for="radio_old_reserve_<?= $value['Reserve_ID']; ?>"><strong>รอบรถ :</strong> <?php echo $goDateFormat . " " . $vanOutFormat; ?></label><br />
                  <label for="radio_old_reserve_<?= $value['Reserve_ID']; ?>" class="fs12 text-secondary fst-italic">วันเวลาที่ทำการจอง : <?php echo $dateReserveFormat; ?></label><br />
                </div>
              </div>
            <?php } ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ภายหลัง</button>
            <a href="<?php echo base_url('/ReservationController/cancelAll'); ?>" class="btn btn-danger">ยกเลิกทั้งหมด</a>
            <a href="<?php echo base_url('/confirm-reservation?r=') . $value['Reserve_ID']; ?>" id="a-connect-modal-conreserve" class="btn btn-success">ดำเนินการ<a />
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(window).on('load', function() {
        $('#model_beforce_reservation').modal('show');
      });
    </script>
  <?php } ?>

  <div class="row mx-0">
    <div class="col-1"></div>
    <div class="col-10">
      <form action="<?php echo base_url('/ReservationController/addreservation'); ?>" method="post">
        <div class="tabcard3">
          <div class="row">
            <div class="col-md-3 col-6">
              <center>
                <div class="text-center my-2">
                  <select id="select-start-form" class="form-select class_station class_selected reserve-font-txt" name="first_station" onchange="select_start(this)" required>
                    <?php if (session()->getFlashdata('first_station_id')) : ?>
                      <option value="<?= session()->getFlashdata('first_station_id'); ?>" class="hide-selected"><?= session()->getFlashdata('first_station_name'); ?></option>
                    <?php else : ?>
                      <option value="" class="hide-selected">ต้นทาง</option>
                    <?php endif;
                    foreach ($station_getStation_NK as $station_getStation__NK) { ?>
                      <option value="<?php echo $station_getStation__NK['Station_ID']; ?>"><?php echo $station_getStation__NK['Station_Name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </center>
            </div>
            <div class="col-md-3 col-6">
              <center>
                <div class="text-center my-2">
                  <select id="select-end-form" class="form-select class_station class_selected reserve-font-txt" name="end_station" onchange="select_end(this)" required>
                    <?php if (session()->getFlashdata('end_station_id')) : ?>
                      <option value="<?= session()->getFlashdata('end_station_id'); ?>" class="hide-selected"><?= session()->getFlashdata('end_station_name'); ?></option>
                    <?php else : ?>
                      <option value="" class="hide-selected">ปลายทาง</option>
                    <?php endif;
                    foreach ($station_getStations as $station_getStation) { ?>
                      <option value="<?php echo $station_getStation['Station_ID']; ?>"><?php echo $station_getStation['Station_Name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </center>
            </div>
            <div class="col-md-3 col-6">
              <?php if (session()->getFlashdata('date')) : ?>
                <input class="my-2 form-control reserve-font-txt" id="date" onchange="changedate();" type="date" name="date" value="<?= session()->getFlashdata('date') ?>" required disabled>
              <?php else : ?>
                <input class="my-2 form-control reserve-font-txt" id="date" onchange="changedate();" type="date" value="<?php echo date('Y-m-d'); ?>" name="date" required disabled>
              <?php endif; ?>
            </div>
            <div class="col-md-3 col-6">
              <div class="input-group">
                <select id="time" class="form-select my-2 time form-control-index class_selected reserve-font-txt" name="time" onchange="changetime(this)" required disabled>
                  <?php if (session()->getFlashdata('time')) : ?>
                    <option value="<?= session()->getFlashdata('time') ?>"><?= session()->getFlashdata('fixtime') ?></option>
                  <?php else : ?>
                    <option value="" class="hide-selected">เวลา</option>
                  <?php endif; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-5 reserve-font-txt">
          <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h6 class="card-title1 text-left">รายละเอียดเส้นทาง</h6>
            <div class="crad1">
              <div class="row">
                <div class="col-5 text-end reserve-font-pd">
                  <p class="pt-2">เส้นทาง:</p>
                </div>
                <div class="col-7">
                  <p class="pt-2 text-left">
                    <span id="id_p_start_station">
                      <?php if (session()->getFlashdata('first_station_name')) : ?>
                        <?= session()->getFlashdata('first_station_name') ?>
                      <?php endif; ?>
                    </span>
                    <span id="id_p_end_station">
                      <?php if (session()->getFlashdata('end_station_name')) : ?>
                        <?= " - " . session()->getFlashdata('end_station_name') ?>
                      <?php endif; ?>
                    </span>
                  </p>
                </div>
                <div class="col-5 text-end reserve-font-pd">
                  <p class="pt-2">วันที่เดินทาง:</p>
                </div>
                <div class="col-7">
                  <p class="pt-2 text-left" id="id-date-reservation">
                    <?php if (session()->getFlashdata('date')) : ?>
                      <?= session()->getFlashdata('date') ?>
                    <?php endif; ?>
                  </p>
                </div>
                <div class="col-5 text-end reserve-font-pd">
                  <p class="pt-2">เวลาที่ออก:</p>
                </div>
                <div class="col-7">
                  <p class="pt-2 text-left" id="id-time-reservation">
                    <?php if (session()->getFlashdata('time')) : ?>
                      <?= session()->getFlashdata('fixtime') ?> น.
                    <?php endif; ?>
                  </p>
                </div>
                <div class="col-5 text-end reserve-font-pd">
                  <p class="pt-2">ปลายทางที่ลง:</p>
                </div>
                <div class="col-7">
                  <p class="pt-2 text-left" id="id_p_end_station_2">
                    <?php if (session()->getFlashdata('end_station_name')) : ?>
                      <?= session()->getFlashdata('end_station_name') ?>
                    <?php endif; ?>
                  </p>
                </div>
                <div class="col-5 text-end reserve-font-pd">
                  <p class="pt-2">จำนวนที่นั่งทั้งหมด:</p>
                </div>
                <div class="col-7">
                  <p class="pt-2 text-left">
                    <span id="totalchair">
                      <?php if (session()->getFlashdata('seats_num')) : ?>
                        <?= session()->getFlashdata('seats_num') ?>
                      <?php endif; ?>
                    </span>
                  </p>
                </div>
                <div class="col-5 text-end reserve-font-pd">
                  <p class="pt-2">ที่นั่งว่าง:</p>
                </div>
                <div class="col-7">
                  <p class="pt-2 text-left">
                    <span id="havechair">
                      <?php if (session()->getFlashdata('havechair')) : ?>
                        <?= session()->getFlashdata('havechair') ?>
                      <?php endif; ?>
                    </span>
                  </p>
                </div>
                <div class="col-5 text-end reserve-font-pd">
                  <p class="pt-2">ราคา:</p>
                </div>
                <div class="col-7">
                  <p class="pt-2 text-left">
                    <span id="price_per_reservation">
                      <?php if (session()->getFlashdata('ticket_price')) : ?>
                        <?= session()->getFlashdata('ticket_price') . " บาท" ?>
                      <?php endif; ?>
                    </span><span id="bath"></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h6 class="card-title2">จำนวนที่นั่ง</h6>
            <div class="crad2">
              <div class="row">
                <div class="col-5">
                  <p class="pt-4 text-center">เลือกจำนวนที่นั่ง</p>
                </div>
                <div class="col-4">
                  <div class="text-center mt-3">
                    <select id="select-chair" class="form-select class_havechair reserve-font-txt" name="select-chair" required>
                      <option value="" class="hide-selected">จำนวน</option>
                      <?php if (session()->getFlashdata('havechair')) {
                        for ($x = 1; $x <= session()->getFlashdata('havechair'); $x++) { ?>
                          <option value="<?php echo $x; ?>"><?php echo $x; ?></option>;
                        <?php } ?>
                      <?php } else { ?>
                        <option value="" class="text-center" disabled>---> กรุณาเลือกวันเวลาที่ต้องการจอง <---</option>
                          <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <h6 class="mt-4 card-title2">ยอดรวมที่ต้องชำระ</h6>
            <div class="crad3">
              <div class="row">
                <div class="col-4">
                  <p class="pt-4 arrow-center text-center">ราคาตั๋ว</p>
                </div>
                <div class="col-3">
                  <p class="pt-4 arrow-center text-left">
                    <span id="chair_reservation"></span>
                    <span id="price_per_reservation_count">
                      <?php if (session()->getFlashdata('ticket_price')) : ?>
                        <?= session()->getFlashdata('ticket_price') ?>
                      <?php endif; ?>
                    </span>
                  </p>
                </div>
                <div class="col-2">
                  <p class="pt-4 arrow-center text-center">รวม</p>
                </div>
                <div class="col-3">
                  <p class="pt-4 arrow-center text-left"><span id="total_price_reservation"></span></p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-1"></div>
    <center>
      <button type="submit" id="con_page_reservation" class="nav-link btn-logreg-confirm" style="width:200px;" onclick="checksubmit()">ยืนยันการจอง</button>
    </center>
  </div>
  </form>
  <?php require('components/footer.php'); ?>
</body>

</html>
<script>
  function checksubmit() {
    var start = document.getElementById("select-start-form").value;
    var end = document.getElementById("select-end-form").value;
    var go_date = document.getElementById("date").value;
    var go_time = document.getElementById("time").value;
    var chair = document.getElementById("select-chair").value;
    if (start == "" || start == null) {
      var msg_start = "ต้นทาง ";
    } else {
      var msg_start = "";
    }
    if (end == "" || end == null) {
      var msg_end = "ปลายทาง ";
    } else {
      var msg_end = "";
    }
    if (go_date == "" || go_date == null) {
      var msg_date = "วันที่ ";
    } else {
      var msg_date = "";
    }
    if (go_time == "" || go_time == null) {
      var msg_time = "เวลา ";
    } else {
      var msg_time = "";
    }
    if (chair == "" || chair == null) {
      var msg_chair = "จำนวนที่นั่ง ";
    } else {
      var msg_chair = "";
    }
    if (msg_start == "" && msg_end == "" && msg_date == "" && msg_time == "" && msg_chair == "") {

    } else {
      swal({
          title: "โปรดกรอกข้อมูลให้ครบถ้วน!",
          text: "โปรดเลือก " + msg_start + msg_end + msg_date + msg_time + msg_chair + "ก่อนทำการจอง!",
          icon: "warning",
          button: "รับทราบ",
      });
    }
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



    var start = document.getElementById("select-start-form").value;
    var end = document.getElementById("select-end-form").value;
    if (start == 0 || end == 0) {
      document.getElementById("time").disabled = true;
      document.getElementById("date").disabled = true;
    } else {
      document.getElementById("time").disabled = false;
      document.getElementById("date").disabled = false;
      if (start == end) {
        document.getElementById("select-start-form").value = '';
        document.getElementById("select-end-form").value = '';
        swal({
          title: "เกิดข้อผิดพลาด",
          text: "ไม่สามารถเลือกต้นทาง และปลายทางซ้ำกันได้!",
          icon: "error",
          button: "รับทราบ",
        });
      }
    }

    if (start == 0 || end == 0) {
      document.getElementById("time").disabled = true;
      document.getElementById("date").disabled = true;
    } else {
      document.getElementById("time").disabled = false;
      document.getElementById("date").disabled = false;
      if (start == end) {
        document.getElementById("select-start-form").value = '';
        document.getElementById("select-end-form").value = '';
        swal({
          title: "เกิดข้อผิดพลาด",
          text: "ไม่สามารถเลือกต้นทาง และปลายทางซ้ำกันได้!",
          icon: "error",
          button: "รับทราบ",
        });
      }
    }
  });
</script>
<script>
  /* เริ่มต้น -- จับค่าใน Radio in Modal */
  var radio = document.querySelectorAll(".radio_modal_reservaion");

  function checkBox(e) {
    var a = document.getElementById('a-connect-modal-conreserve');
    a.href = "<?php echo base_url('/confirm-reservation?r='); ?>" + e.target.value;
  }
  radio.forEach(check => {
    check.addEventListener("click", checkBox);
  });
  /* สิ้นสุด -- จับค่าใน Radio in Modal */
</script>
<script>
  function changetime(selTag) {
    var time = selTag.options[selTag.selectedIndex].text;
    if (time >= 1) {
      document.getElementById("id-time-reservation").innerHTML = time + " น.";
    }
    var date = document.getElementById("date").value;
    if (typeof date.foo !== 'undefined' && date != null) {
      document.getElementById("totalchair").innerHTML = "";
      document.getElementById("havechair").innerHTML = "";
    }
    var start = document.getElementById("select-start-form").value;
    var go_dock = document.getElementById("time").value;

    $.ajax({
      type: "POST",
      url: "ajax_query/ajax_findchair.php",
      dataType: "html",
      data: {
        id_start: start,
        id_dock: go_dock,
        date: date
      },
      success: function(data) {
        $('#totalchair').html(data);
      },
      error() {
        $('#totalchair').html('An Error');
      }
    });
    $.ajax({
      type: "POST",
      url: "ajax_query/ajax_countchair.php",
      dataType: "html",
      data: {
        id_start: start,
        id_dock: go_dock,
        date: date
      },
      success: function(data) {
        $('#havechair').html(data);
        let havechair = "<option value=\"\" class=\"hide-selected\">จำนวน</option>";
        if (data >= 1) {
          for (let num = 1; num <= data; num++) {
            havechair += "<option value=" + num + ">" + num + "</option>";
          }
        } else {
          havechair += "<option value=\"\" class=\"text-center\" disabled>---> ไม่มีที่นั่งว่าง <---</option>";
        }
        document.getElementById("select-chair").innerHTML = havechair;
      },
      error() {
        $('#havechair').html('An Error');
      }
    });
  }

  $('.class_selected').change(function() {
    var date = document.getElementById("date").value;
    document.getElementById("id-date-reservation").innerHTML = date;
    var start = document.getElementById("select-start-form").value;
    var end = document.getElementById("select-end-form").value;
    var go_dock = document.getElementById("time").value;
    var chair = document.getElementById("select-chair").value;
    var price = document.getElementById("price_per_reservation_count").innerHTML;
    var total = chair * price;
    document.getElementById("chair_reservation").innerHTML = chair + " x ";
    document.getElementById("total_price_reservation").innerHTML = total + " บาท";
    $.ajax({
      type: "POST",
      url: "ajax_query/ajax_findchair.php",
      dataType: "html",
      data: {
        id_start: start,
        id_dock: go_dock,
        date: date
      },
      success: function(data) {
        $('#totalchair').html(data);
      },
      error() {
        $('#totalchair').html('An Error');
      }
    });

    $.ajax({
      type: "POST",
      url: "ajax_query/ajax_countchair.php",
      dataType: "html",
      data: {
        id_start: start,
        id_dock: go_dock,
        date: date
      },
      success: function(data) {
        $('#havechair').html(data);
        let havechair = "<option value=\"\" class='hide-selected'>จำนวน</option>";
        if (data >= 1) {
          for (let num = 1; num <= data; num++) {
            havechair += "<option value=" + num + ">" + num + "</option>";
          }
        } else {
          if (go_dock == null || go_dock == "") {
            havechair += "<option value=\"\" class=\"text-center\" disabled>---> กรุณาเลือกวันเวลาที่ต้องการจอง <---</option>";
          } else {
            havechair += "<option value=\"\" class=\"text-center\" disabled>---> ไม่มีที่นั่งว่าง <---</option>";
          }
        }
        document.getElementById("select-chair").innerHTML = havechair;
      },
      error() {
        $('#havechair').html('An Error');
      }
    });
  });

  $('.class_havechair').change(function() {
    var date = document.getElementById("date").value;
    document.getElementById("id-date-reservation").innerHTML = date;
    var start = document.getElementById("select-start-form").value;
    var go_dock = document.getElementById("time").value;
    var chair = document.getElementById("select-chair").value;
    var price = document.getElementById("price_per_reservation_count").innerHTML;
    var total = chair * price;
    document.getElementById("chair_reservation").innerHTML = chair + " x ";
    document.getElementById("total_price_reservation").innerHTML = total + " บาท";
  });

  function changedate() {
    var date = document.getElementById("date").value;
    document.getElementById("id-date-reservation").innerHTML = date;
  };

  function select_start(selTag) {
    var start_station = selTag.options[selTag.selectedIndex].text;
    document.getElementById("id_p_start_station").innerHTML = start_station;
    document.getElementById("id-time-reservation").innerHTML = null;
    var defaulttime = "<option value=\"\" class=\"hide_selected\">เวลา</option>"
    document.getElementById("time").innerHTML = defaulttime;
  }

  function select_end(selTag) {
    var end_station = selTag.options[selTag.selectedIndex].text;
    document.getElementById("id_p_end_station").innerHTML = " - " + end_station;
    document.getElementById("id_p_end_station_2").innerHTML = end_station;
  }

  $('.class_station').change(function() {
    var start = document.getElementById("select-start-form").value;
    var end = document.getElementById("select-end-form").value;
    if (start == "" || end == "") {
      document.getElementById("time").disabled = true;
      document.getElementById("date").disabled = true;
    } else {
      document.getElementById("time").disabled = false;
      document.getElementById("date").disabled = false;
      if (start == end) {
        document.getElementById("select-start-form").value = '';
        document.getElementById("select-end-form").value = '';
        document.getElementById("id-date-reservation").innerHTML = '';
        document.getElementById("id_p_start_station").innerHTML = ''
        document.getElementById("id_p_end_station").innerHTML = ''
        document.getElementById("id_p_end_station_2").innerHTML = ''
        document.getElementById("bath").innerHTML = ''
        swal({
          title: "เกิดข้อผิดพลาด",
          text: "ไม่สามารถเลือกต้นทาง และปลายทางซ้ำกันได้!",
          icon: "error",
          button: "รับทราบ",
        });
      }
      $.ajax({
        type: "POST",
        url: "ajax_query/ajax_findprice.php",
        dataType: "html",
        data: {
          id_start: start,
          id_end: end
        },
        success: function(data) {
          $('#price_per_reservation').html(data);
          $('#price_per_reservation_count').html(data);
          if (data >= 1) {
            document.getElementById("bath").innerHTML = " บาท";
          }
        },
        error() {
          $('#price_per_reservation').html('An Error');
        }
      });
    }
  });

  $('#time').focus(function() {
    var start = document.getElementById("select-start-form").value;
    var date = document.getElementById("date").value;
    document.getElementById("id-time-reservation").innerHTML = null;
    $.ajax({
      type: "POST",
      url: "ajax_query/ajax_findtime.php",
      dataType: "html",
      data: {
        id_start: start,
        date: date
      },
      success: function(data) {
        $('#time').html(data);
      },
      error() {
        $('#time').html('An Error');
      }
    });
  });
</script>
<script>
  $(function() {
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var month2 = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var day2 = dtToday.getDate() + 3;

    if (month < 10 && month > 0) {
      month = '0' + month;
    } else if (month > 12) {
      month = '01';
    } else {
      month = month;
    }

    if (day < 10 && day > 0) {
      day = '0' + day;
    } else {
      day = day;
    }
    if (day2 < 10 && day2 > 0) {
      day2 = '0' + day2;
    } else if (day2 > 30) {
      if (month2 < 10 && month2 > 0) {
        month2 = '0' + month2;
      } else if (month2 > 12) {
        month2 = '01'
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
    $('#date').attr({
      'min': minDate,
      'max': maxDate
    });
  });
</script>