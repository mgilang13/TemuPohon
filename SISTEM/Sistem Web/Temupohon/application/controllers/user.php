<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
	var $data = array();

	function __construct()
	{	
		parent :: __construct();
		$this->load->model(array('user_m','auth_m','encrypt_m'));
		$this->data['opt_level'] = array('admin'=>'Admin', 'user'=>'User');
		$this->data['opt_gender'] = array('Male'=>'Male', 'Female'=>'Female');
	}
	
	function index()	
	{
		if($this->auth_m->check_logged()===FALSE){
			redirect(base_url().'login/');
		} else {
			$data['search'] = $this->input->post('search');
			//set session user data untuk pencarian, untuk paging pencarian
			$this->session->set_userdata('sess_search', $data['search']);
			$this->db->like('username', $data['search']);
			$this->db->from('user');
			//Pagination init
			$config['base_url'] = base_url().'user/index/page/';
			$config['total_rows'] = $this->db->count_all_results();
			$config['per_page'] = "5";
			$config['uri_segment'] = 4;
			$config['num_links'] = 4;
			$this->pagination->initialize($config);
			$this->data['ListUser'] = $this->user_m->search_result($config['per_page'], $this->uri->segment(4,0),$data['search']);
		
		$this->data['query'] = $this->user_m->get_records();
		$data['body'] = $this->load->view('user_v', $this->data);
		$this->load->view('output_html_v', $data);
		}
	}
	
	function add_new()
	{
		$this->data['is_update'] = 0;
		$data['body'] = $this->load->view('form_user', $this->data);
		$this->load->view('output_html_v', $data);
	}
	
	function topdf(){
		prep_pdf();
		$data['user'] = $this->user_m->alldata();
		$titlecolumn = array(
							'nama' => 'Nama',
							'username' => 'Username',
							'email' => 'Email',
							'alamat' => 'Alamat',
							'gender' => 'Jenis Kelamin',
							'level' => 'Level'
		);
		$this->cezpdf->ezTable($data['user'], $titlecolumn, 'User Data');
		$this->cezpdf->ezStream(array('Content-Disposition'=>'Data_User_'.time().'.pdf'));
	}
	
	function edit($id)
	{
		$this->data['query'] = $this->user_m->get_records("ID = '$id'");
		$this->data['is_update'] = 1;
		$data['body'] = $this->load->view('form_user', $this->data);
		$this->load->view('output_html_v', $data);
	}
	
	function delete($id)
	{
		if ($this->user_m->delete_by_id($id))
		redirect('user');
	}
	
	function toexcel(){
		$this->excel->setActiveSheetIndex(0);
		$data = $this->user_m->alldata();
		
		$this->excel->stream('Data_User_'.time().'.xls', $data);
	}

	function save($is_update = 0)
	{
		$this->form_validation->set_rules('nama', 'Nama','trim|required|xss_clean');
		$this->form_validation->set_rules('username', 'Username','trim|required|alpha_dash|min_length[3]|max_length[20]|xss_clean|strtolower');
		$this->form_validation->set_rules('email', 'Email','trim|required|min_length[5]|max_length[35]|valid_email');
		$this->form_validation->set_rules('alamat', 'Alamat','trim|required|xss_clean');
		$this->form_validation->set_rules('gender', 'Jenis Kelamin','trim|required|xss_clean');
        $this->form_validation->set_rules('level', 'Level','trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<div style="color:red;">','</div>');

		$data['nama'] = $this->input->post('nama', true);
		$data['username'] = $this->input->post('username', true,'strtolower');
		$data['email'] = $this->input->post('email', true);
		$data['alamat'] = $this->input->post('alamat', true);
		$data['gender'] = $this->input->post('gender', true);
		$data['level'] = $this->input->post('level', true);
		$data['salt'] = $this->encrypt_m->genRndSalt();
		$data['password'] = $this->encrypt_m->encryptUserPwd($this->input->post('password', true), $data['salt']);

		if ($is_update == 0)
		{
			$this->form_validation->set_rules('password', 'Password','trim|required|min_length[5]|max_length[35]|xss_clean');
			if ($this->form_validation->run() == FALSE) {
			$this->data['is_update'] = 0;
			$data['body'] = $this->load->view('form_user_error', $this->data);
			$this->load->view('output_html_v', $data);
		} else {
			if ($this->user_m->check_query($data['username']) == false) {

			//Tambah data baru
			if ($this->user_m->insert($data))
				redirect('user');
			} else {
				echo "<div style='color:red;'>username sudah ada, silahkan ubah</div><br/>";
				$this->data['is_update'] = 0;
				$data['body'] = $this->load->view('form_user_error', $this->data);
				$this->load->view('output_html_v', $data);
			}
		}
	}
	else
	{
		$this->form_validation->set_rules('password', 'Password','trim|min_length[5]|max_length[35]|xss_clean');
		//Update data
		$id = $this->input->post('ID');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
        $username2 = $this->input->post('username2');
		$password = $this->input->post('password');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$gender = $this->input->post('gender');
		$level = $this->input->post('level');
		$rand_salt = $this->encrypt_m->genRndSalt();
		$encrypt_pass = $this->encrypt_m->encryptUserPwd($password,$rand_salt);
		
		if ($password == '')
		{
			$data = array('nama'=>$nama, 'username'=>$username,'email'=>$email, 'alamat'=>$alamat, 'gender'=>$gender, 'level'=>$level);
		}
		else
		{
			$data = array('nama'=>$nama, 'username'=>$username,'password'=>$encrypt_pass, 'email'=>$email, 'alamat'=>$alamat, 'gender'=>$gender,'level'=>$level, 'salt'=>$rand_salt);
		}
			if ($this->form_validation->run() == FALSE) {
				$this->data['is_update'] = 1;
				$data['body'] = $this->load->view('form_user_error', $this->data);
				$this->load->view('output_html_v', $data);
			} else {
                if($this->input->post('username')==$username2){
                    if ($this->user_m->update_by_id($data, $id))
				    redirect('user');
                }
                else if ($this->user_m->check_query($data['username']) == false) {
				    if ($this->user_m->update_by_id($data, $id))
				    redirect('user');
                } 
                else {
				    echo "<div style='color:red;'>username sudah ada, silahkan ubah</div><br/>";
				    $this->data['is_update'] = 1;
				    $data['body'] = $this->load->view('form_user_error', $this->data);
				    $this->load->view('output_html_v', $data);
			     }
			}
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */