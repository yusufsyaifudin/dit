<?php $session_id = $this->session->userdata('masuk'); ?>
<?php if($session_id == TRUE) : ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Dashboard</title>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap-responsive.min.css"); ?>">
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
				<a class="brand" href="#">Manage</a>
				<ul class="nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="<?php echo base_url('index.php/admin/tambah_pemasukan'); ?>">Pemasukan</a></li>
					<li><a href="<?php echo base_url('index.php/admin/tambah_pengeluaran'); ?>">Pengeluaran</a></li>
					<li><a href="<?php echo base_url('index.php/home/logout'); ?>">Keluar</a></li>
				</ul>
				</div>
			</div>
		</nav>
		<div style="height:40px;"></div>
		<div class="container">
		<legend>Kegiatan terakhir</legend>
		<table class="table table-condensed">
			<thead><tr>
				<th>Nomor</th>
				<th>Tanggal</th>
				<th>Keterangan</th>
				<th>Pemasukan</th>
				<th>Pengeluaran</th>
				<th>Catatan</th>
			</tr></thead>
			<?php $i=0; ?>
			<?php if ($result) :
				foreach ($result as $hasil) : ?>
				<?php $i++; ?>
					<tr class="<?php if($hasil->jenis == "pengeluaran"): echo("error"); endif; ?>">
						<td><?php echo $i; ?></td>
						<td><?php echo $hasil->tanggal; ?></td>
						<td><?php if($hasil->kebutuhan == "primer"){echo '<i class="'."icon-arrow-down".'" title="'."Kebutuhan Primer!".'"></i> ';} elseif($hasil->kebutuhan == "sekunder") {echo '<i class="'."icon-warning-sign".'" title="'."Kebutuhan Sekunder!".'"></i> ';} elseif($hasil->kebutuhan == "tersier"){echo '<i class="'."icon-thumbs-down".'" title="'."Kebutuhan Tersier!".'"></i> ';} elseif($hasil->kebutuhan == "tabungan") {echo '<i class="'."icon-thumbs-up".'" title="'."Selamat Anda Menabung!".'"></i> ';} elseif ($hasil->jenis == "pemasukan") {echo '<i class="'."icon-arrow-up".'" title="'."Pemasukan!".'"></i> ';} ?><?php echo $hasil->keterangan; ?></td>
						<td><?php if($hasil->jenis == "pemasukan"): echo($hasil->jumlah); endif; ?></td>
						<td><?php if($hasil->jenis == "pengeluaran"): echo($hasil->jumlah);?> (<?php echo($hasil->kebutuhan);?>) <?php endif; ?></td>
						<td><?php echo $hasil->catatan; ?></td>
					</tr>
			<?php endforeach; endif; ?>
		</table>
		<div class="pagination"><?php echo $links; ?></div>
		<table class="pull-right">
			<tr>
				<td>Jumlah total pemasukan  </td>
				<td>:</td>
				<td>Rp.<?php print_r($pemasukan->jumlah); ?>,-</td>
			</tr>
			<tr>
				<td>Jumlah total pengeluaran  </td>
				<td>:</td>
				<td>Rp.<?php print_r($pengeluaran->jumlah); ?>,-</td>
			</tr>
			<tr>
				<td>Sisa  </td>
				<td>:</td>
				<td>Rp.<?php $sisa=$pemasukan->jumlah - $pengeluaran->jumlah; echo($sisa); ?>,-</td>
			</tr>
		</table>
		<legend>Laporan bulanan</legend>
		<?php  echo form_open('admin/bulanan') . "\n"; ?>
		<select name="bulan">
			<option selected="selected">Bulan</option>
			<option value="01">Januari</option>
			<option value="02">Februari</option>
			<option value="03">Maret</option>
			<option value="04">April</option>
			<option value="05">Mei</option>
			<option value="06">Juni</option>
			<option value="07">Juli</option>
			<option value="08">Agustus</option>
			<option value="09">September</option>
			<option value="10">Oktober</option>
			<option value="11">November</option>
			<option value="12">Desember</option>
		</select>
		<br>
		<select name="tahun">
			<option selected="selected">Tahun</option>
			<?php for ($t=2012; $t<=2036; $t++) { ?>
				<option value="<?php echo $t; ?>"><?php echo $t; ?></option>
			<?php } ?>
		</select>
		<br>
		<button type="submit" class="btn">Submit</button>
		<?php echo form_close(); ?>
		<hr>
		<span class="pull-right">Page rendered in {elapsed_time}seconds</span>
		</div>
	</body>
</html>
<?php else : ?>
<?php redirect(base_url()); ?>
<?php endif; ?>