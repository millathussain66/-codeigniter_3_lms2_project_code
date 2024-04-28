<?php
class Utility_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	}


	function get_id_from_tbl_by_name($tablename,$columnname,$columnvalue)
	{
		$this->db->limit(1);
		$this->db->select("id", FALSE)->from($tablename)->where("LOWER(".$columnname.")"."='".strtolower(urldecode($columnvalue))."'", NULL, FALSE);
		$data = $this->db->get();
		$row = $data->row();
		if(!empty($row))
		{
			return $row->id;
		}else{
			return 0;
		}
	}
	function get_parameter_data($table,$orderby,$where=NULL)
	{
		 $this->db->select('*',FALSE);
		 $this->db->from($table);
		 if(!empty($where)) $this->db->where($where);
		 $this->db->order_by($orderby);
		 $q=$this->db->get();
		 return $q->result();
	}	
}
?>