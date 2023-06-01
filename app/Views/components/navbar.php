<?php
$session = session();
?>

<style>
  center nav ul li a {
    border: 2px solid #FFC758;
    border-radius: 10px;
    padding: 0px 20px 0px 20px;
    margin-right: 3px;
    color: black;
    text-decoration: none;
  }

  center nav ul li a:hover {
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
<nav class="navbar navbar-expand-xxl navbar-light bg-light">
  <div class="container-fluid nav-fix-width">
    <a class="nav-link nav-home logo" href="<?php echo base_url('/'); ?>"><img src="<?php echo base_url('ivanicon_gif_3.gif'); ?>" height="50px" class="pe-3"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse fontNav" id="navbarNav">
      <ul class="navbar-nav me-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link nav_link_text" href="<?php echo base_url('/'); ?>">หน้าหลัก</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav_link_text" href="<?php echo base_url('/reservation'); ?>">จองตั๋ว</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav_link_text" href="<?php echo base_url('/table'); ?>">ตารางเวลารถ</a>
        </li>
        <?php
        $ses_userid = $session->get('ses_id');
        if (isset($ses_userid)) {
        ?>
          <li class="nav-item">
            <a class="nav-link nav_link_text" href="<?php echo base_url('/history'); ?>">ประวัติการจอง</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_text" href="<?php echo base_url('/PaymentController/connect_checking'); ?>">ตรวจสอบสถานะการจอง</a>
          </li>
        <?php } ?>
      </ul>
      <?php if (isset($ses_userid)) { ?>
        <div class="dropdown dropdown-user">
          <a class="nav-link dropdown-toggle" role="button" id="id-btn-bell" aria-expanded="false">
            <i class="fas fa-bell text-black"></i>
            <?php if (isset($countnotification_unread) && !empty($countnotification_unread) && $countnotification_unread <= 5) { ?>
              <span id="noti_bell_badge" class="top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?php echo $countnotification_unread; ?>
              </span>
            <?php } ?>
          </a>
          <div class="navbar-nav">
            <center>
              <ul class="dropdown-menu-ul-bell dropdown-menu" aria-labelledby="id-btn-bell" style="text-align:left;">
                <li>
                  <span class="usrlist ps-3">การแจ้งเตือน</span>
                </li>
                <hr class="my-1" />
                <?php
                // if(isset($countnotification) && !empty($countnotification) && $countnotification > 5) {
                //  echo $pager->links();
                // }
                ?>
                <li class="fs12 px-3">
                  <?php if (isset($notification) && !empty($notification)) {
                    foreach ($notification as $key => $value) {
                  ?>
                      <span id="span_noti_1" class="pe-2"></span>
                      <?php
                      if ($value['N_Read'] == 'false') { ?>
                        <span id="noti_bell_newicon">
                          <font color="red">*</font>
                        </span>
                      <?php } ?>
                      <span id="span_noti_2"><?= $value['N_Message']; ?></span>
                      <hr class="my-0" />
                    <?php }
                  } else { ?>
                    <div id="nav-alert-noti" class="alert alert-danger ps-3" role="alert">
                      ไม่พบการแจ้งเตือนใดๆ
                    </div>
                  <?php } ?>
                </li>
                <hr class="mt-1 mb-2" />
                <div class="row">
                  <div class="col-1"></div>
                  <div class="col-5">
                    <button class="btn btn-outline-success fs12" onclick="realAllMSG();">อ่านทั้งหมด</button>
                  </div>
                  <div class="col-5">
                    <button class="btn btn-outline-danger fs12" onclick="deleteAllMSG();">ลบทั้งหมด</button>
                  </div>
                  <div class="col-1"></div>
                </div>
                <script>
                  function realAllMSG() {
                    $.ajax({
                      type: "POST",
                      url: "ajax_query/ajax_setRead.php",
                      dataType: "html",
                      data: {
                        user_id: <?php echo $_SESSION['ses_id']; ?>,
                      },
                      success: function(data) {
                        document.getElementById("noti_bell_badge").style.display = "none";
                        document.getElementById("noti_bell_newicon").style.display = "none";
                      },
                    });
                  }

                  function deleteAllMSG() {
                    $.ajax({
                      type: "POST",
                      url: "ajax_query/ajax_deleteMSG.php",
                      dataType: "html",
                      data: {
                        user_id: <?php echo $_SESSION['ses_id']; ?>,
                      },
                      success: function(data) {
                        document.getElementById("noti_bell_badge").style.display = "none";
                        document.getElementById("noti_bell_newicon").style.display = "none";
                        document.getElementById("span_noti_1").style.display = "none";
                        document.getElementById("span_noti_2").style.display = "none";
                        document.getElementById("span_noti_3").style.display = "none";
                      },
                    });
                  }
                </script>
              </ul>
            </center>
          </div>
        </div>
        <div id="userlog" class="text-center">
          <div class="dropdown-custom-nav">
            <a class="nav-link dropdown-toggle ps-3" role="button" id="id-btn-uname" aria-expanded="false">
              <?php
              if ($Q_Pos_ID == 1) {
                echo $Q_F_Name . " " . $Q_L_Name;
              } else {
                echo "(" . $Q_Pos_Name . ") " . $Q_F_Name;
              }
              ?>
            </a>
            <div class="dropdown-header-none"></div>
            <div class="dropdown-header-content">
              <a href="<?php echo base_url('/profile'); ?>" class="usrlist ps-3">
                <font color="#000000">บัญชีของฉัน</font>
              </a>
              <hr class="my-0" />
              <?php if (isset($Q_Pos_ID) && $Q_Pos_ID == 4) { ?>
                <!-- Admin -->
                <a href="<?php echo base_url('/EmployeeController/manager'); ?>" class="usrlist ps-3">
                  <font color="#44B3F7">การจัดการ</font>
                </a>
                <hr class="my-0" />
              <?php }
              if (isset($Q_Pos_ID) && $Q_Pos_ID == 3) { ?>
                <!-- Officer -->
                <a href="<?php echo base_url('/EmployeeController/manager'); ?>" class="usrlist ps-3">
                  <font color="#44B3F7">การจัดการ</font>
                </a>
                <hr class="my-0" />
              <?php }
              if (isset($Q_Pos_ID) && $Q_Pos_ID == 2) { ?>
                <!-- Driver -->
                <a href="<?php echo base_url('/EmployeeController/manager'); ?>" class="usrlist ps-3">
                  <font color="#44B3F7">ข้อมูลรถตู้</font>
                </a>
                <hr class="my-0" />
              <?php } ?>
              <?php if (isset($Reserve_ID_Nav) && !empty($Reserve_ID_Nav) and $Confirm_Nav == "success" and isset($CheckTicket_Nav) and $CheckTicket_Nav <= 0) { ?>
                <!-- If have Ticket -->
                <a href="<?php echo base_url('/TicketController/createTicket?pay=' . $Pay_ID_Nav); ?>" class="usrlist ps-3 text-bold">
                  <font color="#E5BF00">รับตั๋ว</font><img src="<?php echo base_url('/images/ticket_ex.gif'); ?>" width="25px" height="25px">
                </a>
              <?php } ?>
              <a href="<?php echo base_url('/reservation'); ?>" class="usrlist ps-3">
                <font color="#000000">การจอง</font>
              </a>
              <a href="<?php echo base_url('/history'); ?>" class="usrlist ps-3">
                <font color="#000000">ประวัติการจอง</font>
              </a>
              <a href="<?php echo base_url('/checking'); ?>" class="usrlist ps-3">
                <font color="#000000">สถานะการจอง</font>
              </a>
              <a href="<?php echo base_url('/complaint'); ?>" class="usrlist ps-3">
                <font color="#000000">รายงานปัญหา</font>
              </a>
              <hr class="my-0" />
              <a href="<?php echo base_url('/UserController/logout'); ?>" class="usrlist ps-3">
                <font color="red">ออกจากระบบ</font>
              </a>
            </div>
          </div>
        </div>
          <a href="<?php echo base_url('/profile'); ?>" class="nav-link px-0 py-0">
            <img src="<?php echo $Q_Picture; ?>" class="img-profile" width="100px" height="100px" alt="<?php echo $Q_Picture; ?>">
          </a>
      <?php } else { ?>
        <center>
          <a href="<?php echo base_url('/login'); ?>" class="nav-link button-login" role="button">เข้าสู่ระบบ</a>
          <a href="<?php echo base_url('/register'); ?>" class="nav-link button-regis" role="button">สมัครสมาชิก</a>
        </center>
      <?php } ?>
    </div>
  </div>
  </div>
</nav>