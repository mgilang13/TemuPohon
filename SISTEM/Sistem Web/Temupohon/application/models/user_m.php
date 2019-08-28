<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends CI_Model
{
	private $table_name = 'user';

	function __construct()
	{
		parent :: __construct();
	}

	function get_records($criteria = '', $order = '', $limit = '', $offset = 0)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		if ($criteria != '')
			$this->db->where($criteria);
		if ($order != '')
			$this->db->order_by($order);
		if ($limit != '')
			$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}

	function insert($data) 
	{
		$query = $this->db->insert($this->table_name, $data);
		return $query;
	}
	
	function search_result($perPage, $uri, $search)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		if(!empty($search)){
			$this->db->like('username', $search);
		}
		$this->db->order_by('username','asc');
		$getData = $this->db->get('', $perPage, $uri);
		
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else
			return null;
	}

	function update_by_id($data, $id)
	{
		$this->db->where("ID = '$id'");
		$query = $this->db->update($this->table_name, $data);
		return $query;
	}

	function delete_by_id($id)
	{
		$query = $this->db->delete($this->table_name, "ID = '$id'");
		return $query;
	}
	
	function alldata()
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->order_by('username','ASC');
		$getData = $this->db->get();
		if($getData->num_rows() > 0)
			return $getData->result_array();
		else return null;
	}
	
	function check_query($username){
		$this->db->where('username', $username);
		$query = $this->db->get($this->table_name);
		if($query->num_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file user_m.php */
/* Location: ./application/models/user_m.php */