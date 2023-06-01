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
      <div class="head-em">
        <h4 class="text-start my-5">ข้อมูลเจ้าของ SMS</h4>
      </div>
      <div class="row mx-0 px-0">
        <div class="col-1 ps-0"></div>
        <div class="col-10">
          <p><strong>ผู้ใช้ :</strong> <?php echo $response->data->user->username; ?></p>
          <p><strong>ชื่อ-นามสกุล :</strong> <?php echo $response->data->user->firstname . " " . $response->data->user->lastname; ?></p>
          <p><strong>เบอร์โทร :</strong> <?php echo $response->data->user->mobile; ?></p>
          <p><strong>อีเมล :</strong> <?php echo $response->data->user->email; ?></p>
          <p><strong>เครดิตคงเหลือ :</strong> <?php echo $response->data->wallet->credit; ?></p>
          <p><strong>ยอดเติมเงินสะสม :</strong> <?php echo $response->data->wallet->balance; ?></p>
        </div>
        <div class="col-1 pe-0"></div>
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