<!DOCTYPE html>
<html lang="en">

<head>
	<title>รายละเอียดตั๋ว</title>
	<?php require('components/header.php'); ?>
</head>

<body>
	<?php require('components/navbar.php'); ?>

	<div class="fluid-bd">
		<center center>
			<div class="container">
				<span class="fontCompany-bd">
					<h1>รายละเอียดตั๋ว</h1>
				</span>
			</div>
		</center>
		<div class="card-bd">
			<div class="card-title-bd">
				<div class="row">
					<div class="col-4">
						<p class="pt-4 arrow-center text-center">รายละเอียด</p>
					</div>
					<div class="col-3"> </div>
					<div class="col-5">
						<p class="pt-4 arrow-center text-center"><span class="tk-txt-code">หมายเลขบนตั๋ว:</span> <?php echo "#" . $Tick_Code; ?></p>
					</div>
				</div>
			</div>
			<div class="card-body-bd">
				<div class="col-4">
					<p class="pt-4 arrow-center text-center">I-Van</p>
				</div>
				<div class="row">

					<div class="col-6">
						<p class="pt-4 arrow-center text-center">วัน/ เดือน / ปี</p>
					</div>
					<div class="col-6">
						<p class="pt-4 arrow-center text-left"><?php echo $Go_Date; ?></p>
					</div>

					<div class="col-6">
						<p class="pt-4 arrow-center text-center">หมายเลขรถ</p>
					</div>
					<div class="col-6">
						<p class="pt-4 arrow-center text-left"><?php echo $Van_Num; ?></p>
					</div>

					<div class="col-6">
						<p class="pt-4 arrow-center text-center">สถานีต้นทาง</p>
					</div>
					<div class="col-6">
						<p class="pt-4 arrow-center text-left"><?php echo $Station_Start; ?></p>
					</div>

					<div class="col-6">
						<p class="pt-4 arrow-center text-center">สถานีปลายทาง</p>
					</div>
					<div class="col-6">
						<p class="pt-4 arrow-center text-left"><?php echo $Station_End; ?></p>
					</div>

					<div class="col-6">
						<p class="pt-4 arrow-center text-center">เวลารถออก</p>
					</div>
					<div class="col-6">
						<p class="pt-4 arrow-center text-left"><?php $timeformat = date_create($Van_Out);
																echo date_format($timeformat, "H.i" . " น."); ?></p>
					</div>

					<div class="col-6">
						<p class="pt-4 arrow-center text-center">จำนวนที่นั่ง</p>
					</div>
					<div class="col-6">
						<p class="pt-4 arrow-center text-left"><?php echo $Re_Seate; ?> ที่นั่ง</p>
					</div>

					<div class="col-6">
						<p class="pt-4 arrow-center text-center">ราคาตั๋วชำระสำเร็จ</p>
					</div>
					<div class="col-6">
						<p class="pt-4 arrow-center text-left"><?php echo $Total_Price; ?> บาท</p>
					</div>

				</div>
				<br>
				<center>
					<a href="<?php echo base_url('/'); ?>" class="btn-logreg-confirm mt-3" style="width:200px;">กลับสู่หน้าหลัก</a>
				</center>
			</div>
		</div>
	</div>

	<?php require('components/footer.php'); ?>

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