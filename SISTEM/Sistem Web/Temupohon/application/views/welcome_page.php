<!DOCTYPE html>
<html>
<head>
	<title>Selamat Datang di Temu Pohon</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-home.css') ?>">
</head>
<body>
    <header id="header-welcome">
    	<h1>Selamat Datang di Website Temu Pohon</h1>
    </header>
	    <div id="sisi-kiri" class="content">
	    	<img src="<?php echo base_url('assets/images/big-icon.png') ?>">
	    </div>
	    <div id="tombol" class="content">
	    		<a class="tombol-block" id="home" onmouseover="sembunyikan()" href="<?php echo site_url("Welcome") ?>">
	    		<span class="icon-block">
	    			<img src=<?php echo base_url("assets/icons/homeicon1.png") ?>>
	    		</span>
	    		Home
	    		</a>
	    		<a class="tombol-block" id="login" onclick="tampilkan()" onmouseover="tampilkan()" href="#">
	    		<span class="icon-block">
	    			<img src=<?php echo base_url("assets/icons/login-icon.png") ?>>
	    		</span>
	    		Login
	    		</a>
	    		<a class="tombol-block" id="tentangkami" onmouseover="sembunyikan()" href="https://drive.google.com/open?id=1nSU7vhksWBWEq83qlkirx2VGG3T5fhec">
	    		<span class="icon-block">
	    			<img src=<?php echo base_url("assets/icons/tentangkami-icon.png") ?>>
	    		</span>
	    		Download Apps
	    		</a>
	    		<a class="tombol-block" id="registrasiuser" onmouseover="sembunyikan()" href="<?php echo site_url("RegisterUser") ?>">
	    		<span class="icon-block">
	    			<img src=<?php echo base_url("assets/icons/registrasi-icon.png") ?>>
	    		</span>
	    		Registrasi User
	    		</a>
	    	<div class="content-submenu" id="submenuLogin">
		    		
		    		<a class="submenu" id="user-btn" href="<?php echo site_url("UserLogin") ?>">
		    		<span class="icon-block">
		    			<img src="<?php echo base_url("assets/icons/user-login.png") ?>">
		    		</span>
		    		User
		    		</a>
		    		<a class="submenu" id="admin-btn" href="<?php echo site_url("AdminLogin") ?>">
					<span class="icon-block">
		    			<img src="<?php echo base_url("assets/icons/admin-login.png") ?>">
		    			</span>
		    		Admin
		    		</a>
	    	</div>
	    </div>
	    
	    <div id="sisi-kanan" class="content">
	    	<img src="<?php echo base_url('assets/images/tree-home.png') ?>">
	    </div>

	    <script type="text/javascript">
	    	function tampilkan() {
	    		document.getElementById("submenuLogin").style.visibility = "visible";
	    	}

	    	function sembunyikan() {
	    		document.getElementById("submenuLogin").style.visibility = "hidden";
	    	}
	    </script>
</body>

</html>