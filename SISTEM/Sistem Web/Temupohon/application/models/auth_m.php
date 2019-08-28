<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_m extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->model('encrypt_m');
	}
	
	function process_login($login_array_input = NULL){

	if(!isset($login_array_input) OR count($login_array_input) != 2) {
			
			return false;
		}
		
		
		//set its variable
		$username = $login_array_input[0];
		$password = $login_array_input[1];
		
		//select data from database to check user exist or not?
		$this->db->where('username', $username);
		$this->db->limit(1);
		$query = $this->db->get('user');

		if($query->num_rows() > 0){
			$row = $query->row();
			$user_id = $row->id_user;
			$user_pass = $row->password;
			$user_salt = $row->salt;
			$nama= $row->nama;
			// var_dump($row);
			// exit();
           //

			if($this->encrypt_m->encryptUserPwd($password, $user_salt) === $user_pass) {

				$this->session->set_userdata('logged_user', $user_id);
				$this->session->set_userdata('nama', $nama);
    //             $this->session->set_userdata('level', $level);
				 return true;
			}
			return false;
		}
		return false;
		
	}
	
	function check_logged(){
		return ($this->session->userdata('logged_user'))?TRUE:FALSE;
	}
	
	function logged_id(){
		return ($this->check_logged())?$this->session->userdata('logged_user'):'';
	}
}

/* End of File auth_m.php */
/* Location: ./applications/models/auth_m.php */