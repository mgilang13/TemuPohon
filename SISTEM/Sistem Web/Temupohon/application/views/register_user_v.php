<body>
<div>
<header id="header-register-user">
		<img src="<?php echo base_url("assets/images/big-icon.png") ?>"> 
		<h1 class="title-page">Register User</h1>
</header>

	<div class="content">
		
			<?php echo form_open_multipart('RegisterUser') ?>
			<span><?php echo $captcha_return?><?php echo validation_errors() ?><?php echo $check_username_email ?></span>
			<div id="form-left">
			<table>

				<tr>
					<td><div claass="form-control"><h3>Nama : </h3></div></td>
					<td>
						<input class="field" type="text" name="nama" value="<?php echo set_value('nama') ?>"/>
					</td>
				</tr>
				
				<tr>
					<td><div class="form-control"><h3>Username : </h3></div></td>
					<td>
						<input class="field" type="text" name="username" value="<?php echo set_value('username') ?>"/>
					</td>
				</tr>
				
				<tr>
					<td><div class="form-control"><h3>Password : </h3></div></td>
					<td>
						<input class="field" type="password" name="password" value="<?php echo set_value('password') ?>"/>
					</td>
				</tr>
				
				<tr>
					<td><div class="form-control"><h3>Ulangi Password : </h3></div></td>
					<td>
						<input class="field" type="password" name="passconf" value="<?php echo set_value('passconf') ?>"/>
					</td>
				</tr>
				
				<tr>
					<td><div class="form-control"><h3>Email : </h3></div></td>

					<td>
						<input class="field" type="text" name="email" value="<?php echo set_value('email') ?>"/>
					</td>
				</tr>
				
				<tr>
					<td><div class="form-control"><h3>Alamat : </h3></div></td>
					<td>
						<textarea class="field-area" name="alamat"><?php echo set_value('alamat') ?></textarea>
					</td>
				</tr>
				
				<tr>
					<td><div class="form-control"><h3>Jenis Kelamin : </h3></div></td>
					<td>
						<input class="gender" type="radio" name="gender" value="Male" <?php echo set_radio('gender', 'Male'); ?>" checked> Male 
						<input class="gender" type="radio" name="gender" value="Female" <?php echo set_radio('gender', 'Female'); ?>"> Female
					</td>
				</tr>

				<tr>
					<td><div class="form-control"><h3>Pekerjaan</h3></div></td>
					<td>
						<select class="field" name="job" value="job">
							<option value="Ilmuwan" ?>Ilmuwan</option>
							<option value="Ahli Botani" >Ahli Botani</option>
							<option value="Ahli Kehutanan" >Ahli Kehutanan</option>
							<option value="Ahli Lingkungan">Ahli Lingkungan</option>
						</select>
					</td>
				</tr>
		</table>
			</div>
			
			<div id="vr-line">
					<img src="<?php echo base_url("assets/icons/vr-line.png") ?>">
			</div>
		
			<div id="form-right">
		<table>
				<tr> 
					<td>
						<h3>Upload Gambar KTP/SIM/Kartu Identitas</h3>
					</td>
					<td>
					<div><?php echo $this->session->flashdata('pesan');?>
					<table>
							<tr>
								<td>File Identitas</td>
								<td><div><input type="file" name="filefoto" class="form-control" required></div></td>
							</tr>
							<!-- <tr>
								<td colspan="2"><input type="submit" class="btn btn-success" value="Simpan"></td>
							</tr> -->
						</table>
					</div>
					</td>
				</tr>

				<tr>
					<td><h3>Ketik Captcha Berikut</h3>
					<?php echo $cap_img; ?></td>
					<td>

					<input class="field" type="text" name="captcha" value=""/></td>
				</tr>
				
				<tr>
					<td colspan="2"><input id="checkbox" type="checkbox" name="terms" value="1" <?php echo set_checkbox('terms', '1'); ?> />Saya Setuju Tentang Terms Of Service dan Privacy Policy Aplikasi Ini.
				</td>
				</tr>
				
				<tr>
					<td><input id="simpanData" type="submit" value="Register" name="submit"/>
				</td>
				</tr>
			</table>
			</div>
			
			<?php echo form_close()?>
	</div>
</body>