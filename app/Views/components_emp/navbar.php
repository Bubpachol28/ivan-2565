<nav class="navbar mb-3 navbar-expand-lg navbar-light ps-0">
  <button type="button" id="sidebarCollapse" class="btn btn-warning">
    <i class="fa fa-user-circle-o"></i>
    <span>ซ่อน | แสดง</span>
  </button>
  <div class="navbartip">
    <span class="pe-3">
      <?php
      echo $Q_F_Name . " " . $Q_L_Name . " [".$_SERVER['REMOTE_ADDR']."]";
      ?>
    </span>
    <a href="<?php echo base_url('/profile'); ?>">
      <img src="<?php echo $Q_Picture; ?>" class="img-profile" width="100px" height="100px" alt="<?php echo $Q_Picture; ?>" />
    </a>
  </div>
</nav>