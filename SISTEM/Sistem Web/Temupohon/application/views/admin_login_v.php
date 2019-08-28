<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-admin-login.css') ?>">
<body id="background-login-admin">
<div id="form-login-admin">
	<?php echo form_open(base_url().'AdminLogin/') ?>
	<?php echo validation_errors(); ?>
	<?php 
		 if($this->session->flashdata('sukses')) {   
   		  echo '<p class="warning" style="margin: 10px 20px;">'.$this->session->flashdata('sukses').'</p>';   
   		}   
   	?>  
   	
	<span><b><?php echo $login_failed; ?></b></span>

		<table>
		<tbody>
			<tr class="row-form1-admin">
				<td><h3>Username</h3></td>
				<td><input id="username-field-admin" type="text" name="username" value="<?php echo set_value("username"); ?>"></td>
				<td></td>
			</tr>
			<tr class="row-form2-admin">
				<td><h3>Password</h3></td>
				<td><input id="password-field-admin" type="password" name="password" value="<?php echo set_value("password"); ?>"></td>
				<td></td>
			</tr>
			<tr class="row-form3-admin">
				<td><h3>Level</h3></td>
				<td>
					<select name="level">
						<option value='admin'>Admin</option>
						<option value='super-admin'>Super-admin</option>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="tombol-login-admin" id="tombol-admin" value="Login" name="submit_login"></td>
			</tr>
			</tr>
		</tbody>
		</table>
		<a id="lupaPasswordAdmin" href="<?php echo base_url('LupaPasswordAdmin') ?>">Forgot Password ?</a>
		<a href="<?php echo base_url('welcome_page') ?>"></a>
	<?php echo form_close() ?>
	<a id='btn-back' href="<?php echo base_url('Welcome') ?>">Back</a>
	</div>
	</body>