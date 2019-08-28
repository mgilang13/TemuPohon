<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserLogin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('auth_m');
	}
	
	function index(){
		if($this->auth_m->check_logged()=== true)
			redirect(base_url().'UserPage/');
			
			$sub_data['login_failed'] = '';
			$data['title'] = 'User Login';
			$data['body'] = $this->load->view('user_login_v', $sub_data, true);
			
		if($this->input->post('submit_login')){
				$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
				$this->form_validation->set_error_delimiters('<p/div style="color:red;">', '</div>');
			
			if($this->form_validation->run() == FALSE){
				$data['body'] = $this->load->view('user_login_v', $sub_data, true);
				$this->load->view('output_html_v', $data);
			}else{
				$login_array = array($this->input->post('username'), $this->input->post('password'));
			

				if($this->auth_m->process_login($login_array)){
					
				//login succesfull
					redirect(base_url().'UserPage/');
				}else{
				$sub_data['login_failed'] = "<div style='color:red;'>Invalid Username or Password</div>";
				$data['body'] = $this->load->view('user_login_v', $sub_data, true);
				$this->load->view('output_html_v', $data);
				}
			}
		}else{
		$this->load->view('output_html_v', $data);
		}
}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'UserLogin/');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */