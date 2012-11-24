<?php $session_id = $this->session->userdata('masuk'); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Welcome</title>
		  <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>">
		  <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap-responsive.min.css"); ?>">
		  <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
		  <script type="text/javascript">
		  $(".alert").alert();
		  </script>
	</head>
	<body>
<?php if($session_id == TRUE) : ?>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
				<a class="brand" href="#">Manage</a>
				<ul class="nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="<?php echo base_url('index.php/admin/tambah_pemasukan'); ?>">Pemasukan</a></li>
					<li><a href="<?php echo base_url('index.php/admin/tambah_pengeluaran'); ?>">Pengeluaran</a></li>
					<li><a href="<?php echo base_url('index.php/home/logout'); ?>">Keluar</a></li>
				</ul>
				</ul>
				</div>
			</div>
		</div>
<?php else : ?>
		<?php if ($this->session->flashdata('message')) : ?>
     	<div class="alert alert-error"><?php echo $this->session->flashdata('message'); ?></div>
		<?php endif; ?>

	<div class="container">
		<div class="span6">
		<legend>Login</legend>
		<?php  echo form_open('home/login') . "\n"; ?>
		<span class="input-prepend">
			<span class="add-on"><i class="icon-user"></i></span><input type="text" name="username" placeholder="Username"><br>
			<span class="add-on"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password"><br>
		</span>
			<button type="submit" name="" class="btn">Login</button>
		<?php echo form_close(); ?>
		</div>

		<div class="span5">
		<legend>Daftar</legend>
		<?php  echo form_open('home/daftar') . "\n"; ?>
		<span class="input-prepend">
			<span class="add-on"><i class="icon-user"></i></span><input type="text" name="username" placeholder="Username"><br>
			<span class="add-on"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password"><br>
			<span class="add-on"><i class="icon-envelope"></i></span><input type="text" name="email" placeholder="Email"><br>
		</span>
			<button type="submit" name="" class="btn">Daftar</button>
		<?php echo form_close(); ?>
		</div>
		<legend>Dokumentasi</legend>
		<ul>
		<li>Atur hostname, username, dan password di application/config/database.php</li>
		<li>Atur base_url() di application/config/config.php</li>
		<li>Buat table di database dengan query :
		<code>CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;</code></li>
		<li>Selesai, gunakan form DAFTAR dahulu sebelum LOGIN.</li>
		</ul>
		<span class="pull-right"><small>ver1.0 | rendered in {elapsed_time}s</small></span>
		
	</div>
<?php endif; ?>
	</body>
</html>