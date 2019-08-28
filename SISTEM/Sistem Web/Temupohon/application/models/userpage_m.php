<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Userpage_m extends CI_Model{
	private $table_name1 = 'datapohon';
	private $table_name2 = 'uploadimage';
	private $table_name3 = 'pesan-admin';
	private $table_name4 = 'admin';
	private $table_name5 = 'user';
	private $table_name6 = 'masukanpengunjung';

	function __construct(){
		parent:: __construct();
	}
	
	function get_records($criteria = '', $order = '', $limit = '', $offset = 0){
		$this->db->select('*');
		$this->db->from($this->table_name1);
		$this->db->order_by('nama_pohon','asc');
		if($criteria != '')
			$this->db->where($criteria);
		if($order != '')
			$this->db->order_by($order);
		if($limit != '')
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
			
	}
	
	function get_admin_records($criteria = '', $order = '', $limit = '', $offset = 0){
		$this->db->select('*');
		$this->db->from($this->table_name4);
		$this->db->order_by('nama','asc');
		if($criteria != '')
			$this->db->where($criteria);
		if($order != '')
			$this->db->order_by($order);
		if($limit != '')
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
			
	}

	function get_user_records($criteria = '', $order = '', $limit = '', $offset = 0){
		$this->db->select('*');
		$this->db->from($this->table_name5);
		$this->db->order_by('nama','asc');
		if($criteria != '')
			$this->db->where($criteria);
		if($order != '')
			$this->db->order_by($order);
		if($limit != '')
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
			
	}

	function get_pesan_pengunjung($criteria = '', $order = '', $limit = '', $offset = 0){
		$this->db->select('*');
		$this->db->from($this->table_name6);
		$this->db->order_by('waktu','desc');
		if($criteria != '')
			$this->db->where($criteria);
		if($order != '')
			$this->db->order_by($order);
		if($limit != '')
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
			
	}


	function get_pesan_user_records($criteria = '', $order = '', $limit = '', $offset = 0){
		$this->db->select('*');
		$this->db->from($this->table_name3);
		$this->db->order_by('waktu','desc');
		if($criteria != '')
			$this->db->where($criteria);
		if($order != '')
			$this->db->order_by($order);
		if($limit != '')
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
			
	}

	function get_pesan_pengunjung_records($criteria = '', $order = '', $limit = '', $offset = 0){
		$this->db->select('*');
		$this->db->from($this->table_name6);
		$this->db->order_by('waktu','desc');
		if($criteria != '')
			$this->db->where($criteria);
		if($order != '')
			$this->db->order_by($order);
		if($limit != '')
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
			
	}

	function search_result($perPage, $uri, $search)
	{
		$this->db->select('*');
		$this->db->from($this->table_name1);
		if(!empty($search)){
			$this->db->like('nama_pohon', $search);
		}
		$this->db->order_by('nama_pohon','asc');
		$getData = $this->db->get('', $perPage, $uri);
		
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}

	function search_admin($perPage, $uri, $search) {
		$this->db->select('*');
		$this->db->from($this->table_name4);
		$this->db->where("level = 'admin'");
		if(!empty($search)){
			$this->db->like('nama', $search);
		}
		$this->db->order_by('nama','asc');
		$getData = $this->db->get('', $perPage, $uri);
		
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}
	
	function search_user($perPage, $uri, $search)
	{
		$this->db->select('*');
		$this->db->from($this->table_name5);
		if(!empty($search)){
			$this->db->like('nama', $search);
		}
		$this->db->order_by('nama','asc');
		$getData = $this->db->get('', $perPage, $uri);
		
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}

	function search_pesan_admin($perPage, $uri, $search, $id_logged_user) {
		
		$this->db->select('*');
		$this->db->from($this->table_name3);
		$this->db->where("id_user = '$id_logged_user'");
		if(!empty($search)){
			$this->db->like('nama_admin', $search);
		}
		$this->db->order_by('waktu','desc');
		$getData = $this->db->get('', $perPage, $uri);
		
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}

	function search_pesan_pengunjung($perPage, $uri, $search, $id_logged_admin) {
		
		$this->db->select('*');
		$this->db->from($this->table_name6);
		if(!empty($search)){
			$this->db->like('nama_pengunjung', $search);
		}
		$this->db->order_by('waktu','desc');
		$getData = $this->db->get('', $perPage, $uri);
		
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}

	function list_user()
	{
		$getData = $this->db->get('user');
		
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return array();
	}

	function insert($data){
		$query = $this->db->insert($this->table_name1, $data);
		return $query;
	}

	function insertPesan($data) {

		return  $this->db->insert($this->table_name3, $data);
	}
	
	function update_by_id($data, $id){
		
		// $result = $this->db->query("SELECT nama_gambar FROM datapohon WHERE id_pohon = '$id';")->row_array();
		// $nama_gambar = empty($result ['nama_gambar']) ? '' : 'assets/images/uploads/gambarPohon/'.$result['nama_gambar'];

		// if(file_exists($nama_gambar)) {
		// 	@unlink($nama_gambar);
		// }
		$result = $this->db->query("SELECT nama_gambar FROM datapohon WHERE id_pohon = '$id';")->row_array();
		$nama_gambar = empty($result ['nama_gambar']) ? '' : 'assets/images/uploads/gambarPohon/'.$result['nama_gambar'];

		

		$this->db->where("id_pohon = '$id'");
		// $this->db->where("id_gambar = '$gambar'");
		$query = $this->db->update($this->table_name1, $data);

		// $query2 = $this->db->update($this->table_name2, $gambar);
		return $query;
	}
	
		function update_admin_by_id($data, $id){
		
		// $result = $this->db->query("SELECT nama_gambar FROM datapohon WHERE id_pohon = '$id';")->row_array();
		// $nama_gambar = empty($result ['nama_gambar']) ? '' : 'assets/images/uploads/gambarPohon/'.$result['nama_gambar'];

		// if(file_exists($nama_gambar)) {
		// 	@unlink($nama_gambar);
		// }

		$result = $this->db->query("SELECT nama_gambar FROM admin WHERE id_admin = $id;")->row_array();
		$nama_gambar = empty($result ['nama_gambar']) ? '' : 'assets/images/uploads/imagektp/'.$result['nama_gambar'];

		

		$this->db->where("id_admin = '$id'");
		// $this->db->where("id_gambar = '$gambar'");

		$query = $this->db->update($this->table_name4, $data);
		// $query2 = $this->db->update($this->table_name2, $gambar);
		return $query;
	}

		function update_user_by_id($data, $id){
		
		// $result = $this->db->query("SELECT nama_gambar FROM datapohon WHERE id_pohon = '$id';")->row_array();
		// $nama_gambar = empty($result ['nama_gambar']) ? '' : 'assets/images/uploads/gambarPohon/'.$result['nama_gambar'];

		// if(file_exists($nama_gambar)) {
		// 	@unlink($nama_gambar);
		// }
	
		$result = $this->db->query("SELECT nama_gambar FROM user WHERE id_user = $id;")->row_array();
		$nama_gambar = empty($result ['nama_gambar']) ? '' : 'assets/images/uploads/imagektp/'.$result['nama_gambar'];

		$this->db->where("id_user = '$id'");
		// $this->db->where("id_gambar = '$gambar'");
		$query = $this->db->update($this->table_name5, $data);
		// $query2 = $this->db->update($this->table_name2, $gambar);
	

		return $query;
	}

public function view_by_id($data, $id) {
			$data['query'] = $this->db->query("SELECT * FROM datapohon WHERE id_pohon = '$id';")->row_array();
			// var_dump($query);
			// 	exit();
			// $query = $this->db->select($this->table_name1, $data);
			return $data['query'];
	}

public function view_admin($data, $id) {
		$data['query']=$this->db->query("SELECT * FROM admin WHERE id_admin = '$id';")->row_array();
		return $data['query'];
}

	function delete_by_id($id){
		
		$nama_gambar = '';

		// $this->db->select("nama_gambar");
		// $this->db->from($this->table_name1);
		// $this->db->where("id_pohon", $id);
		// $sintaks = $this->db->get();
		// if ($sintaks->num_rows()) {
		// // 	$nama_gambar = $row['nama_gambar'];

		// }
		
	
		$result = $this->db->query("SELECT nama_gambar FROM datapohon WHERE id_pohon = '$id';")->row_array();
		$nama_gambar = empty($result ['nama_gambar']) ? '' : 'assets/images/uploads/gambarPohon/'.$result['nama_gambar'];

		//cek gambar
		if(file_exists($nama_gambar)) {
			@unlink($nama_gambar);
		}
		// $this->db->where($this->table_name2, "nama_gambar = '$nama_gambar'");
	
		
		$query = $this->db->delete($this->table_name1, "id_pohon = '$id'");
		$query = $this->db->delete($this->table_name2, "id_gambar = '$id'");
		return $query;
	}

	function delete_pesan_by_id($id){
	
		$query = $this->db->delete($this->table_name3, "id_pesan = '$id'");
		return $query;
	}


	function delete_user_by_id($id){
		
		$nama_gambar = '';

		// $this->db->select("nama_gambar");
		// $this->db->from($this->table_name1);
		// $this->db->where("id_pohon", $id);
		// $sintaks = $this->db->get();
		// if ($sintaks->num_rows()) {
		// // 	$nama_gambar = $row['nama_gambar'];

		// }
		
	
		$result = $this->db->query("SELECT nama_gambar FROM user WHERE id_user = '$id';")->row_array();
		$nama_gambar = empty($result ['nama_gambar']) ? '' : 'assets/images/uploads/imagektp/'.$result['nama_gambar'];

		//cek gambar
		if(file_exists($nama_gambar)) {
			@unlink($nama_gambar);
		}
		// $this->db->where($this->table_name2, "nama_gambar = '$nama_gambar'");
	
		
		$query = $this->db->delete($this->table_name5, "id_user = '$id'");
		$query = $this->db->delete($this->table_name2, "id_gambar = '$id'");
		return $query;
	}

	function delete_admin_by_id($id){
		
		$nama_gambar = '';

		// $this->db->select("nama_gambar");
		// $this->db->from($this->table_name1);
		// $this->db->where("id_pohon", $id);
		// $sintaks = $this->db->get();
		// if ($sintaks->num_rows()) {
		// // 	$nama_gambar = $row['nama_gambar'];

		// }
		
	
		$result = $this->db->query("SELECT nama_gambar FROM admin WHERE id_admin = '$id';")->row_array();
		$nama_gambar = empty($result ['nama_gambar']) ? '' : 'assets/images/uploads/imagektp/'.$result['nama_gambar'];
		
		//cek gambar
		if(file_exists($nama_gambar)) {
			@unlink($nama_gambar);
		}
		// $this->db->where($this->table_name2, "nama_gambar = '$nama_gambar'");
	
		
		$query = $this->db->delete($this->table_name4, "id_admin = '$id'");
		$query = $this->db->delete($this->table_name2, "id_gambar = '$id'");
		return $query;
	}

	function delete_pesan_pengunjung($id){
	
		$query = $this->db->delete($this->table_name6, "id_pesan = '$id'");
		return $query;
	}

	 function change_pohonqr($id_pohon, $pohon_qr)
    {
        $this->db->where('id_pohon', $id_pohon);
        $this->db->set('pohon_qr', $pohon_qr);
        $this->db->update('datapohon');
    }
}

/* End of file buku_m.php */
/* Location: ,/application/models/buku_m.php */