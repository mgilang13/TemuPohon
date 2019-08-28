<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class AdminPage extends CI_Controller

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

		$data['title'] = 'Admin Page';

		if($this->admin_auth_m->check_logged()===FALSE){

			redirect(base_url().'AdminLogin/');

		}else{

			$data['search'] = $this->input->post('search');

			//set session user data untuk pencarian, untuk paging pencarian

			$this->session->set_userdata('sess_search', $data['search']);

			$this->db->like('nama_pohon', $data['search']);

			$this->db->from('datapohon');

			//Pagination init

			$config['base_url'] = base_url().'AdminPage/index/page/';

			$config['total_rows'] = $this->db->count_all_results();

			$config['per_page'] = "5";

			$config['uri_segment'] = 4;

			$config['num_links'] = 4;

			$this->pagination->initialize($config);

			$this->data['ListPohon'] = $this->Userpage_m->search_result($config['per_page'], $this->uri->segment(4,0),$data['search']);



			$this->data['query'] = $this->Userpage_m->get_records();

			$this->data['banner'] =  $this->session->userdata('logged_admin');

			$data['body'] = $this->load->view('admin-page', $this->data);

			$this->load->view('output_html_v', $data);

		}

    

	}

	

	function add_new()

	{

		$this->data['title'] = "Tambah Data Pohon";

		$this->data['is_update'] = 0;

		$data['body'] = $this->load->view('tambah-pohon',$this->data);

		$this->load->view('output_html_v', $data);

	}

	

	function view($id) {



		$this->data['title'] = "View Data User";

		$data['query'] = $this->Userpage_m->get_records("id_admin = '$id'");



		// $data['nama_pohon'] = $this->input->post('nama_pohon', true);

		// $data['nama_latin'] = $this->input->post('nama_latin', true);

		// $data['sinonim'] = $this->input->post('sinonim', true);

		// $data['perawakan'] = $this->input->post('perawakan', true);

		// $data['biologi'] = $this->input->post('biologi', true);

		// $data['status_konservasi'] = $this->input->post('status_konservasi', true);

		// $data['persebaran'] = $this->input->post('persebaran', true);



		

if ($this->Userpage_m->view_by_id($data, $id)) {

		$data['body'] = $this->load->view('view-pohon', $this->data);

		$this->load->view('output_html_v', $data);

			redirect('UserPage/view');

		}

		

	}



	function edit($id){

		$this->data['title'] = "Update Data Pohon";

		$this->data['query'] = $this->Userpage_m->get_records("id_pohon = '$id'");

		// $this->data['query2'] = $this->Userpage_m->get_records("id_gambar = '$gambar'");

		$this->data['is_update'] = 1;



		// $data['nama_gambar']= $id;

		$data['body'] = $this->load->view('update-pohon', $this->data);

		$this->load->view('output_html_v', $data);

	}

	

	function delete($id){

		

		if($this->Userpage_m->delete_user_by_id($id)) {

			redirect('AdminPage/pesanUser');

		}

	}



	function pesanUser() {

		$data['title'] = "Pesan User";

	

		$data['search'] = $this->input->post('search');

		//set session user data untuk pencarian, untuk paging pencarian

		$this->session->set_userdata('sess_search', $data['search']);

		$this->db->like('nama', $data['search']);

		$this->db->from('user');

		

		//Pagination init

		$config['base_url'] = base_url().'AdminPage/pesanUser/';

		$config['total_rows'] = $this->db->count_all_results();

		$config['per_page'] = "5";

		$config['uri_segment'] = 3;

		$config['num_links'] = 3;

		

		$this->pagination->initialize($config);

		$this->data['ListUser'] = $this->Userpage_m->search_user($config['per_page'], $this->uri->segment(3,0),$data['search']);

		$this->data['query'] = $this->Userpage_m->get_user_records();

		$this->data['user'] = $this->Userpage_m->list_user();

		$this->data['no'] = $this->uri->segment(3,0);

		$data['body'] = $this->load->view('pesan-user', $this->data);

		$this->load->view('output_html_v', $data);

		}



	function sendMessages() {

		$id_pesan = time();

		$id_user= $this->input->post('id_user');

		$isi_pesan = $this->input->post('isi_pesan');

		$id_admin = $this->session->userdata('logged_admin');

		$nama_admin = $this->db->query("SELECT nama from admin where id_admin='$id_admin';")->row_array();

		$nama_admin2 = $nama_admin['nama'];

		

		$input_data = array(

			'id_pesan' => $id_pesan,

			'id_admin' => $id_admin,

			'id_user' => $id_user,

			'isi_pesan' => $isi_pesan,

			'nama_admin' => $nama_admin2

			);

		if($this->Userpage_m->insertPesan($input_data)) {

			redirect(base_url().'AdminPage/pesanUser');

		}else {

			$data['body'] = 'error on query';

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



	  function print_qr($id)

    {

        $qr_code_config = array();

        $qr_code_config['cacheable'] = $this->config->item('cacheable');

        $qr_code_config['cachedir'] = $this->config->item('cachedir');

        $qr_code_config['imagedir'] = $this->config->item('imagedir');

        $qr_code_config['errorlog'] = $this->config->item('errorlog');

        $qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');

        $qr_code_config['quality'] = $this->config->item('quality');

        $qr_code_config['size'] = $this->config->item('size');

        $qr_code_config['black'] = $this->config->item('black');

        $qr_code_config['white'] = $this->config->item('white');



        $this->ci_qr_code->initialize($qr_code_config);



        // get full data pohon

        $data_pohon = $this->Userpage_m->get_records("id_pohon = '$id'")->row_array();

        $image_name = $id . "qr.png";

       

        // create pohon content

        $codeContents = "Nama Pohon:";

        $codeContents .= $data_pohon['nama_pohon'];

        $codeContents .= "\n";

        $codeContents .= "Nama Latin:";

        $codeContents .=  $data_pohon['nama_latin'];

        $codeContents .= "\n";

        $codeContents .= "Sinonim :";

        $codeContents .=  $data_pohon['sinonim'];

        $codeContents .= "\n";

        $codeContents .= "Perawakan: ";

        $codeContents .=  $data_pohon['perawakan'];

        $codeContents .= "\n";

        $codeContents .= "Biologi: ";

        $codeContents .=  $data_pohon['biologi'];

        $codeContents .= "\n";

        $codeContents .= "Status Konservasi : ";

        $codeContents .=  $data_pohon['status_konservasi'];

        $codeContents .= "\n";

        $codeContents .= "Persebaran : ";

        $codeContents .=  $data_pohon['persebaran'];



        $params['data'] = $codeContents;

        $params['level'] = 'H';

        $params['size'] = 2;



        $params['savepohon'] = FCPATH . $qr_code_config['imagedir'] . $image_name;

        $this->ci_qr_code->generate($params);



        $this->data['qr_code_image_url'] = base_url() . $qr_code_config['imagedir'] . $image_name;



        // save image path in tree table

        $this->Userpage_m->change_pohonqr($id, $image_name);

        // then redirect to see image link

        $file = $params['savepohon'];

        if(file_exists($file)){

            header('Content-Description: File Transfer');

            header('Content-Type: text/csv');

            header('Content-Disposition: attachment; filename='.basename($file));

            header('Content-Transfer-Encoding: binary');

            header('Expires: 0');

            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

            header('Pragma: public');

            header('Content-Length: ' . filesize($file));

            ob_clean();

            flush();

            readfile($file);

            unlink($file); // deletes the temporary file



            exit;

        }

    }

}



/* End of file buku.php */

/* Location: ./application/controllers/buku.php */