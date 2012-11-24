<?php $session_id = $this->session->userdata('masuk'); ?>
<?php if($session_id == TRUE) : ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Laporan Bulanan</title>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap-responsive.min.css"); ?>">
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
				<a class="brand" href="#">Manage</a>
				<ul class="nav">
					<li><a href="<?php echo base_url('index.php/admin/dashboard') ?>">Home</a></li>
					<li><a href="<?php echo base_url('index.php/admin/tambah_pemasukan'); ?>">Pemasukan</a></li>
					<li><a href="<?php echo base_url('index.php/admin/tambah_pengeluaran'); ?>">Pengeluaran</a></li>
					<li><a href="<?php echo base_url('index.php/home/logout'); ?>">Keluar</a></li>
				</ul>
				</div>
			</div>
		</nav>
		<div style="height:40px;"></div>
		<div class="container">
		<table class="table table-condensed">
			<legend>Laporan bulanan (<?php echo $bulan.'/'.$tahun; ?>)</legend>
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
						<td>Rp.<span class="pull-right"><?php if($hasil->jenis == "pemasukan"): echo($hasil->jumlah); endif; ?></span</td>
						<td>Rp.<span class="pull-right"><?php if($hasil->jenis == "pengeluaran"): echo($hasil->jumlah); endif; ?></span></td>
						<td><?php echo $hasil->catatan; ?></td>
					</tr>
			<?php endforeach; endif; ?>
					<tr>
						<td></td>
						<td></td>
						<td>Jumlah</td>
						<td>Rp.<span class="pull-right"><?php print_r($pemasukan->jumlah); ?></span></td>
						<td>Rp.<span class="pull-right"><?php print_r($pengeluaran->jumlah); ?></span></td>
					</tr>
		</table>
		<h3>Sisa bulan ini: Rp.<?php $sisa=$pemasukan->jumlah - $pengeluaran->jumlah; echo($sisa); ?>,-</h3>

		<br><br>
		<legend>Grafik <code>PEMASUKAN <?php if ($pemasukan->jumlah > $pengeluaran->jumlah) { echo(">"); } elseif ($pemasukan->jumlah < $pengeluaran->jumlah) { echo("<"); } else { echo("="); } ?> PENGELUARAN</code></legend>
		<?php $total=$pemasukan->jumlah + $pengeluaran->jumlah; ?>
		<?php $masuk=$pemasukan->jumlah; $pemasukan=$masuk/$total*100; ?>
		<?php $keluar=$pengeluaran->jumlah; $pengeluaran=$keluar/$total*100; ?>

				<div class="span2">Pemasukan</div>
				<div class="span8"><div class="progress"><div class="bar" style="width: <?php echo(int)($pemasukan); ?>%;"><?php echo($pemasukan); ?>%</div></div></div>
				<span class="span1"></span>

				<div class="span2">Pengeluaran Total</div>
				<div class="span8"><div class="progress"><div class="bar bar-danger" style="width: <?php  echo(int)($pengeluaran); ?>%;"><?php  echo($pengeluaran); ?>%</div></div></div>

				<br>
				<br>
				<br>
				<br>
				<br>
				<span class="pull-right">Page rendered in {elapsed_time} s</span>
		</div>
	</body>
</html>
<?php else : ?>
<?php redirect(base_url()); ?>
<?php endif; ?>