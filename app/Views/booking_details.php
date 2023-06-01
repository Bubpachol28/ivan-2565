<!DOCTYPE html>
<html lang="en">

<head>
	<title>I-Van Go</title>
	<?php require('components/header.php'); ?>
	<style>
		#map {
			width: 70%;
			height: 300px;
		}
	</style>
</head>

<body onload="init();">
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
					<div class="col-3"></div>
					<div class="col-5">
						<p class="pt-4 arrow-center text-center">หมายเลขบนตั๋ว: #<?php echo $Tick_Code; ?></p>
					</div>
				</div>
			</div>
			<div class="card-body-bd">
				<div class="col-4">
					<p class="pt-4 arrow-center text-center">I-Van</p>
				</div>
				<div class="col-8"></div>
				<div class="row">
					<div class="col-lg-8 col-12">
						<div class="row">
							<div class="col-md-8 col-6">
								<p class="pt-4 arrow-center text-center">วัน/ เดือน / ปี</p>
							</div>
							<div class="col-md-4 col-6">
								<p class="pt-4 arrow-center text-left"><?php echo $Go_Date; ?></p>
							</div>

							<div class="col-md-8 col-6">
								<p class="pt-4 arrow-center text-center">หมายเลขรถ</p>
							</div>
							<div class="col-md-4 col-6">
								<p class="pt-4 arrow-center text-left"><?php echo $Van_Num; ?></p>
							</div>

							<div class="col-md-8 col-6">
								<p class="pt-4 arrow-center text-center">สถานีต้นทาง</p>
							</div>
							<div class="col-md-4 col-6">
								<p class="pt-4 arrow-center text-left"><?php echo $Station_Start; ?></p>
							</div>

							<div class="col-md-8 col-6">
								<p class="pt-4 arrow-center text-center">สถานีปลายทาง</p>
							</div>
							<div class="col-md-4 col-6">
								<p class="pt-4 arrow-center text-left"><?php echo $Station_End; ?></p>
							</div>

							<div class="col-md-8 col-6">
								<p class="pt-4 arrow-center text-center">เวลารถออก</p>
							</div>
							<div class="col-md-4 col-6">
								<p class="pt-4 arrow-center text-left"><?php $timeformat = date_create($Van_Out);
																		echo date_format($timeformat, "H.i" . " น."); ?></p>
							</div>

							<div class="col-md-8 col-6">
								<p class="pt-4 arrow-center text-center">จำนวนที่นั่ง</p>
							</div>
							<div class="col-md-4 col-6">
								<p class="pt-4 arrow-center text-left"><?php echo $Re_Seate; ?> ที่นั่ง</p>
							</div>

							<div class="col-md-8 col-6">
								<p class="pt-4 arrow-center text-center">ราคาตั๋วชำระสำเร็จ</p>
							</div>
							<div class="col-md-4 col-6">
								<p class="pt-4 arrow-center text-left"><?php echo $Total_Price; ?> บาท</p>
							</div>

						</div>
					</div>
					<div class="col-lg-4 col-12 bd-align my-auto">
						<p><img src="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo base_url('/ticket') . "/" . $Tick_Code; ?>&chs=160x160&chld=L|0" style="width:60%;" height="60%"></img></p>
					</div>
				</div>
				<center>
					<script src="https://api.longdo.com/map/?key=19a9a5d074e991d8a68a986a512824e1"></script>
					<script>
						var marker = new longdo.Marker({
							lon: <?php echo $lng; ?>,
							lat: <?php echo $lat; ?>
						});

						function init() {
							map = new longdo.Map({
								placeholder: document.getElementById('map'),
								zoom: 13,
								lastView: false,
								location: {
									lat: <?php echo $lat; ?>,
									lon: <?php echo $lng; ?>
								}
							});
							map.Layers.setBase(longdo.Layers.GRAY);
							map.Overlays.add(marker);
						}
					</script>
					<div id="map" class="mt-4"></div>
					<br />
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