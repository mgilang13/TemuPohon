<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_auth_m extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->model('admin_encrypt_m');
	}
	
	function process_login($login_array_input = NULL){
		if(!isset($login_array_input) OR count($login_array_input) != 3)
			return false;
		
		//set its variable
		$username = $login_array_input[0];
		$password = $login_array_input[1];
		$level = $login_array_input[2];
		
		//select data from database to check user exist or not?
		$this->db->where('username', $username);
		$this->db->where('level', $level);
		$this->db->limit(1);
		$query = $this->db->get('admin');

		if($query->num_rows() > 0){
			$row = $query->row();
			$admin_id = $row->id_admin;
			$admin_pass = $row->password;
			$admin_salt = $row->salt;
            $level = $row->level;

            // var_dump($this->admin_encrypt_m->encryptUserPwd($password, $admin_salt));
            // exit();
			if($this->admin_encrypt_m->encryptUserPwd($password, $admin_salt) === $admin_pass) {
				$this->session->set_userdata('logged_admin', $admin_id);
                $this->session->set_userdata('level', $level);
				return true;
			}
			return false;
		}
		return false;
		
	}
	
	function check_logged(){
		return ($this->session->userdata('logged_admin'))?TRUE:FALSE;
	}
	
	function logged_id(){
		return ($this->check_logged())?$this->session->userdata('logged_admin'):'';
	}
}

/* End of File auth_m.php */
/* Location: ./applications/models/auth_m.php */