<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminLogin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('admin_auth_m');
	}
	
	function index(){
		if($this->admin_auth_m->check_logged() === true)
			redirect(base_url().'AdminPage/');
			
			$sub_data['login_failed'] = '';
			$data['title'] = 'Admin Login';
			$data['body'] = $this->load->view('admin_login_v', $sub_data, true);
			
		if($this->input->post('submit_login')){
				$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');

				$this->form_validation->set_error_delimiters('<p/div style="color:red;">', '</div>');
			
			if($this->form_validation->run() == FALSE){
				$data['body'] = $this->load->view('admin_login_v', $sub_data, true);
				$this->load->view('output_html_v', $data);
			}else{
				$login_array = array($this->input->post('username'), $this->input->post('password'), $this->input->post('level'));
				if($this->admin_auth_m->process_login($login_array)){
				//login succesfull
					if ($this->input->post('level') =='admin') {
						redirect(base_url().'AdminPage/');
					}else if($this->input->post('level') == 'super-admin') {
					redirect(base_url().'SuperAdminPage/');
					}
				}
				else{
				$sub_data['login_failed'] = "<div style='color:red;'>Invalid Username or Password</div>";
				$data['body'] = $this->load->view('admin_login_v', $sub_data, true);
				$this->load->view('output_html_v', $data);
				}
			}
		}else{
		$this->load->view('output_html_v', $data);
		}
}
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'AdminLogin/');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */