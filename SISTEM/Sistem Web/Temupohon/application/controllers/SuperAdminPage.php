<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SuperAdminPage extends CI_Controller
{
	var $data = array();

	function __construct()
	{
		parent :: __construct();
		//$this->load->helper('form');
		$this->load->model(array('Userpage_m','admin_auth_m','upload_m'));
	}

	function index()
	{
		//$this->add_new();
		$data['title'] = 'Super Admin Page';
		if($this->admin_auth_m->check_logged()===FALSE){
			redirect(base_url().'AdminLogin/');
		}else{
			$data['search'] = $this->input->post('search');
			//set session user data untuk pencarian, untuk paging pencarian
			$this->session->set_userdata('sess_search', $data['search']);
			$this->db->like('nama', $data['search']);
			$this->db->from('admin');
			//Pagination init
			$config['base_url'] = base_url().'SuperAdminPage/index/page/';
			$config['total_rows'] = $this->db->count_all_results();
			$config['per_page'] = "5";
			$config['uri_segment'] = 4;
			$config['num_links'] = 4;
			$this->pagination->initialize($config);
			$this->data['ListAdmin'] = $this->Userpage_m->search_admin($config['per_page'], $this->uri->segment(4,0),$data['search']);
			$this->data['no'] = $this->uri->segment(4,0);

			$this->data['query'] = $this->Userpage_m->get_records();
			$data['body'] = $this->load->view('superadmin-page', $this->data);
			$this->load->view('output_html_v', $data);
		}
    
	}
	
	function add_new()
	{
		$data['title'] = "Tambah Data Admin";
		$this->data['is_update'] = 0;
		$this->$data['body'] = $this->load->view('tambah-pohon',$this->data);
		$this->load->view('output_html_v', $data);
	}
	
	function view($id) {
		$this->data['title'] = 'View Data Admin';
		$data['query'] = $this->Userpage_m->get_admin_records("id_admin = '$id'")->row_array();
		// $data['body'] = $this->load->view('view-admin', $data);
		// $this->load->view('output_html_v', $data);		
			//redirect('SuperAdminPage/view');

		$data['body'] = $this->load->view('view-admin', $data);
		$this->load->view('output_html_v', $data);
	}

	function edit($id){
		$this->data['title'] = "Update Data Admin";
		$this->data['query'] = $this->Userpage_m->get_records("id_admin = '$id'");
		// $this->data['query2'] = $this->Userpage_m->get_records("id_gambar = '$gambar'");
		$this->data['is_update'] = 1;

		// $data['nama_gambar']= $id;
		$data['body'] = $this->load->view('update-admin', $this->data);
		$this->load->view('output_html_v', $data);
	}
	
	function delete($id){
		
		if($this->Userpage_m->delete_admin_by_id($id)) {
			redirect('SuperAdminPage');
		}
	}

	function save($is_update = 0){
		
		$id_pohon = $this->input->post('id_pohon', true);
		
		$namapohon = $this->input->post('nama_pohon',true);
		
		$data['nama_pohon'] = $this->input->post('nama_pohon', true);
		$data['nama_latin'] = $this->input->post('nama_latin', true);
		$data['sinonim'] = $this->input->post('sinonim', true);
		$data['perawakan'] = $this->input->post('perawakan', true);
		$data['biologi'] = $this->input->post('biologi', true);
		$data['status_konservasi'] = $this->input->post('status_konservasi', true);
		$data['persebaran'] = $this->input->post('persebaran', true);
		
	

		if($is_update == 0){
			$data['id_pohon'] =  random_string('alnum');
			$idPohon = $data['id_pohon'];
			//Tambah Data Baru
			if($this->Userpage_m->insert($data)) {

				$ket_gambar= "Gambar Pohon";
				$config['upload_path'] = './assets/images/uploads/gambarPohon/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
				
				$config['max_size'] = '2048';
				$config['max_width'] = '1288';
				$config['max_height'] = '768';
				$config['file_name'] = $idPohon;
				
				

				$this->upload->initialize($config);
			

				if($_FILES['gambarPohon']['name']){
				if ($this->upload->do_upload('gambarPohon')){
					$gambar= $this->upload->data();
					$data = array (
									'id_gambar' => $idPohon,
									'nama_gambar'=> $gambar['file_name'],
									'tipe_gambar'=> $gambar['file_type'],
									'ket_gambar' => $ket_gambar);
					$where= array('id_gambar'=> $idPohon); 
					$this->upload_m->get_insert($data);
					// $this->upload_m->get_update($data, $where);
					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert- success\" id=\"alert\">Upload Berhasil</div></div>");
					// redirect('RegisterUser');
				} else {
					
					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert- danger\" id=\"alert\">Upload Gagal</div></div>");
					redirect('UserPage/add_new/');
					}

				 redirect('AdminPage');
			}
		}
}else{
			//Update Data
			$id = $this->input->post('id_pohon');
			$nama_gambar = $this->input->post('nama_gambar');

			if($this->Userpage_m->update_by_id($data, $id)) {

				// $ket_gambar= "Gambar Pohon";
				$config['upload_path'] = './assets/images/uploads/gambarPohon/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
				
				$config['max_size'] = '2048';
				$config['max_width'] = '1288';
				$config['max_height'] = '768';
				$config['file_name'] = $id;
				
				

				$this->upload->initialize($config);
			

				if($_FILES['gambarPohon']['name']){
				if ($this->upload->do_upload('gambarPohon')){
					$gambar= $this->upload->data();
					$data = array (
									
									'nama_gambar'=> $gambar['file_name'],
									'tipe_gambar'=> $gambar['file_type'],
									// 'ket_gambar' => $ket_gambar
									);
					$where= array('id_gambar'=> $idPohon); 
					// $this->upload_m->get_insert($data);
					$this->upload_m->get_update($data, $where);
					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert- success\" id=\"alert\">Upload Berhasil</div></div>");
					// redirect('RegisterUser');
				} else {
					
					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert- danger\" id=\"alert\">Upload Gagal</div></div>");
					redirect('UserPage/add_new/');
					}

				 redirect('AdminPage');
			}

				redirect('AdminPage');
			}
		}
}
	function masukanPengunjung() {
		$data['title'] = 'Masukan dari Pengunjung';
		$data['search'] = $this->input->post('search');
			//set session user data untuk pencarian, untuk paging pencarian
		$this->session->set_userdata('sess_search', $data['search']);
		$this->db->like('id_pesan', $data['search']);
		$this->db->from('masukanpengunjung');

		//Pagination init
		$config['base_url'] = base_url().'SuperAdminPage/masukanPengunjung/';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = "5";
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;
		
		$this->pagination->initialize($config);
		$id_logged_admin = $this->session->userdata('logged_admin');
		// var_dump($id_logged_user);
		// exit();
		$this->data['ListPesanAdmin'] = $this->Userpage_m->search_pesan_pengunjung($config['per_page'], $this->uri->segment(3,0),$data['search'], $id_logged_admin);
		$this->data['query'] = $this->Userpage_m->get_pesan_pengunjung();
		$this->data['no'] = $this->uri->segment(3,0);

		$data['body'] = $this->load->view('masukan-pengunjung', $this->data);
		$this->load->view('output_html_v', $data);
	}

	function viewMasukanPengunjung($id) {
		$data['title'] = "View Pesan Pengunjung";
		$data['query'] = $this->Userpage_m->get_pesan_pengunjung_records("id_pesan = '$id'")->row_array();
		$data['body'] = $this->load->view('view-pesan-pengunjung', $data);
		$this->load->view('output_html_v', $data);
	}

	function deleteMasukanPengunjung($id) {
		if ($this->Userpage_m->delete_pesan_pengunjung($id)) {
			redirect('SuperAdminPage/masukanPengunjung');
		}
	}
}

/* End of file buku.php */
/* Location: ./application/controllers/buku.php */