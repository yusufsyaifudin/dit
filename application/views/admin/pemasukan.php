<?php $session_id = $this->session->userdata('masuk'); ?>
<?php if($session_id == TRUE) : ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Tambah Pemasukan</title>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap-responsive.min.css"); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/ui-lightness/jquery-ui-1.8.23.custom.css'); ?>">
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.8.0.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui-1.8.23.custom.min.js'); ?>"></script>
		<script type="text/javascript">
			$(function(){
				// Datepicker
				$( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd"});

			});
		</script>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
				<a class="brand" href="#">Manage</a>
				<ul class="nav">
					<li><a href="<?php echo base_url('index.php/admin/dashboard') ?>">Home</a></li>
					<li class="active"><a href="#">Pemasukan</a></li>
					<li><a href="<?php echo base_url('index.php/admin/tambah_pengeluaran'); ?>">Pengeluaran</a></li>
					<li><a href="<?php echo base_url('index.php/home/logout'); ?>">Keluar</a></li>
				</ul>
				</div>
			</div>
		</nav>
		<div style="height:40px;"></div>
	<?php if ($this->session->flashdata('message')) : ?>
			<div class="alert alert-info"><?php echo $this->session->flashdata('message'); ?></div>
	<?php else: ?>

     	<div class="container">
		<?php  echo form_open('admin/tambah_pemasukan') . "\n"; ?>
		<table>
			<tr>
				<td>Keterangan* </td>
				<td><input type="text" name="keterangan" placeholder="Keterangan"></td>
			</tr>
			<tr>
				<td>Jumlah* </td>
				<td><div class="input-prepend input-append">
					<span class="add-on">Rp.</span><input class="span2" id="appendedPrependedInput" size="16" type="text" name="jumlah" placeholder="Jumlah"><span class="add-on">,-</span>
					</div></td>
			</tr>
			<tr>
				<td>Tanggal* </td>
				<td><input id="datepicker" type="text" name="tanggal" placeholder="YYYY-mm-dd"></td>
			</tr>
			<tr>
				<td>Catatan</td>
				<td><input type="text" name="catatan" placeholder="Misal: sumber dana, dll)"></td>
			</tr>
			<tr>
				<td></td>
				<td><button type="submit" name="" class="btn pull-right">Simpan</button></td>
			</tr>
		</table>
		<?php echo form_close(); ?>
		<span class="pull-right">Page rendered in {elapsed_time}s</span>
		</div>
	<?php endif; ?>
	</body>
</html>
<?php else : ?>
<?php redirect(base_url()); ?>
<?php endif; ?>