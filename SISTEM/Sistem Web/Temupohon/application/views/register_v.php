<div>
	<h1>Register</h1>
	<?php echo form_open(base_url()."register/") ?>
	<span><?php $captcha_return?><?php echo validation_errors() ?></span>
	
	<div>
		<div>Nama : </div>
		<div>
			<input type="text" name="nama" value="<?php echo set_value('nama') ?>"/>
		</div>
	</div>
	
	<div>
		<div>Username : </div>
		<div>
			<input type="text" name="username" value="<?php echo set_value('username') ?>"/>
		</div>
	</div>
	
	<div>
		<div>Password : </div>
		<div>
			<input type="password" name="password" value="<?php echo set_value('password') ?>"/>
		</div>
	</div>
	
	<div>
		<div>Ulangi Password : </div>
		<div>
			<input type="password" name="passconf" value="<?php echo set_value('passconf') ?>"/>
		</div>
	</div>
	
	<div>
		<div>Email : </div>
		<div>
			<input type="text" name="email" value="<?php echo set_value('email') ?>"/>
		</div>
	</div>
	
	<div>
		<div>Alamat : </div>
		<div>
			<textarea name="alamat"><?php echo set_value('alamat') ?></textarea>
		</div>
	</div>
	
	<div>
		<div>Jenis Kelamin : </div>
		<div>
			<input type="radio" name="gender" value="Male" <?php echo set_radio('gender', 'Male'); ?> /> Male &nbsp;&nbsp;
			<input type="radio" name="gender" value="Female" <?php echo set_radio('gender', 'Female'); ?> /> Female
		</div>
	</div>
	
	<div>
		Ketik Captcha Berikut : <br/><br/>
		<?php echo $cap_img; ?>
		<input type="text" name="captcha" value=""/>
	</div>
	
	<div>
		<input type="checkbox" name="terms" value="1" <?php echo set_checkbox('terms', '1'); ?> />Saya Setuju Tentang Terms Of Service dan Privacy Policy Aplikasi Ini.
	</div>
	
	<div>
		<input type="submit" value="Register" name="submit"/>
	</div>
	
	<?php echo form_close()?>
</div>