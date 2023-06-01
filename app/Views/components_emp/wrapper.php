<?php $session = session(); ?>
<nav id="sidebar" class="sidebar">
  <div class="sidebar-header">
    <h3 class="text-center"><a href="<?= base_url('/dashboard'); ?>">I-VAN</a></h3>
  </div>
  <ul class="list-unstyled">
    <p class="listboxpfh fs20">Managers</p>
    <li>
      <a href="<?php echo base_url('dashboard'); ?>" id="wrapper-1" class="listboxpf ps-5 fs16">หน้าหลัก</a>
    </li>
    <li>
      <a href="<?php echo base_url('manage-user'); ?>" id="wrapper-2" class="listboxpf ps-5 fs16">จัดการลูกค้า</a>
    </li>
    <?php
    if (isset($Q_Pos_ID) && $Q_Pos_ID >= 4) { ?>
      <!-- Admin -->
      <li>
        <a href="<?php echo base_url('manage-allUsers'); ?>" id="wrapper-3" class="listboxpf ps-5 fs16">จัดการผู้ใช้</a>
      </li>
    <?php } ?>
    <li>
      <a href="<?php echo base_url('check-payment'); ?>" id="wrapper-4" class="listboxpf ps-5 fs16">ตรวจสอบการชำระเงิน</a>
    </li>
    <li>
      <a href="<?php echo base_url('manage-traffic'); ?>" id="wrapper-5" class="listboxpf ps-5 fs16">จัดการการเดินรถ</a>
    </li>
    <li>
      <a href="<?php echo base_url('around'); ?>" id="wrapper-6" class="listboxpf ps-5 fs16">ตรวจสอบรอบจอง</a>
    </li>
    <li>
      <a href="<?php echo base_url('create-pdf'); ?>" id="wrapper-7" class="listboxpf ps-5 fs16" target="_blank">พิมพ์เอกสาร</a>
    </li>
    <li>
      <a href="<?php echo base_url('manage-van'); ?>" id="wrapper-8" class="listboxpf ps-5 fs16">จัดการข้อมูลรถ</a>
    </li>
    <li>
      <a href="<?php echo base_url('manage-complaint'); ?>" id="wrapper-9" class="listboxpf ps-5 fs16">การรายงานปัญหา</a>
    </li>
    <?php if (isset($Q_Pos_ID) && $Q_Pos_ID >= 4) { ?>
      <!-- Admin -->
      <li>
        <a href="<?php echo base_url('check-credit'); ?>" id="wrapper-10" class="listboxpf ps-5 fs16">ข้อความ SMS</a>
      </li>
      <li>
        <a href="<?php echo base_url('setting'); ?>" id="wrapper-11" class="listboxpf ps-5 fs16">การตั้งค่า</a>
      </li>
    <?php } ?>
    <p class="listboxpfh fs20">Others</p>
    <li>
      <a href="<?php echo base_url(''); ?>" class="listboxpf ps-5 fs16">กลับสู่หน้าหลัก</a>
    </li>
    <li>
      <a href="<?php echo base_url('UserController/logout'); ?>" class="listboxpf ps-5 fs16 text-danger">ออกจากระบบ</a>
    </li>
  </ul>
</nav>
<script type="text/javascript">
  $(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
      $('#sidebar').toggleClass('active');
    });
    if (window.location.href == "<?php echo base_url('dashboard'); ?>") {
      document.getElementById("wrapper-1").style.background = "#FFB000";
    } else if (window.location.href == "<?php echo base_url('manage-user'); ?>") {
      document.getElementById("wrapper-2").style.background = "#FFB000";
    } else if (window.location.href == "<?php echo base_url('manage-allUsers'); ?>" || window.location.href == "<?php echo base_url('add-officer'); ?>") {
      document.getElementById("wrapper-3").style.background = "#FFB000";
    } else if (window.location.href == "<?php echo base_url('check-payment'); ?>") {
      document.getElementById("wrapper-4").style.background = "#FFB000";
    } else if (window.location.href == "<?php echo base_url('manage-traffic'); ?>" || window.location.href == "<?php echo base_url('add-driving'); ?>") {
      document.getElementById("wrapper-5").style.background = "#FFB000";
    } else if (window.location.href == "<?php echo base_url('around'); ?>") {
      document.getElementById("wrapper-6").style.background = "#FFB000";
    } else if (window.location.href == "<?php echo base_url('create-pdf'); ?>") {
      document.getElementById("wrapper-7").style.background = "#FFB000";
    } else if (window.location.href == "<?php echo base_url('manage-van'); ?>" || window.location.href == "<?php echo base_url('addvan'); ?>") {
      document.getElementById("wrapper-8").style.background = "#FFB000";
    } else if (window.location.href == "<?php echo base_url('manage-complaint'); ?>") {
      document.getElementById("wrapper-9").style.background = "#FFB000";
    } else if (window.location.href == "<?php echo base_url('check-credit'); ?>") {
      document.getElementById("wrapper-10").style.background = "#FFB000";
    } else if (window.location.href == "<?php echo base_url('setting'); ?>") {
      document.getElementById("wrapper-11").style.background = "#FFB000";
    }
  });
</script>