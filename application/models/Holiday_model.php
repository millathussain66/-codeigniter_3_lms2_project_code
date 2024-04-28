<?php
class Holiday_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	}
	
	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
		
	   	if (isset($filterscount) && $filterscount > 0)
		{		
			$where = "(";
			
			$tmpdatafield = "";
			$tmpfilteroperator = "";
			for ($i=0; $i < $filterscount; $i++)
			{//$where2.="(".$this->input->get('filterdatafield'.$i)." like '%".$this->input->get('filtervalue'.$i)."%')";
			
				// get the filter's value.
				$filtervalue = $this->input->get('filtervalue'.$i);
				// get the filter's condition.
				$filtercondition = $this->input->get('filtercondition'.$i);
				// get the filter's column.
				$filterdatafield = $this->input->get('filterdatafield'.$i);
				// get the filter's operator.
				$filteroperator = $this->input->get('filteroperator'.$i);			
				
					
				if($filterdatafield=='name')
				{
					$filterdatafield='j1.name';
				}							
				else{$filterdatafield='j1.'.$filterdatafield;}
				
				if ($tmpdatafield == "")
				{
					$tmpdatafield = $filterdatafield;			
				}
				else if ($tmpdatafield <> $filterdatafield)
				{
					$where .= ")AND(";					
				}
				else if ($tmpdatafield == $filterdatafield)
				{
					if ($tmpfilteroperator == 0)
					{
						$where .= " AND ";
					}
					else $where .= " OR ";	
				}
				
				// build the "WHERE" clause depending on the filter's condition, value and datafield.
				switch($filtercondition)
				{
					case "CONTAINS":
						$where .= " ".$filterdatafield . " LIKE '%" . $filtervalue ."%'";						
						break;
					case "DOES_NOT_CONTAIN":
						$where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
						break;
					case "EQUAL":
						$where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
						break;
					case "NOT_EQUAL":
						$where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
						break;
					case "GREATER_THAN":
						$where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
						break;
					case "LESS_THAN":
						$where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
						break;
					case "GREATER_THAN_OR_EQUAL":
						$where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
						break;
					case "LESS_THAN_OR_EQUAL":
						$where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
						break;
					case "STARTS_WITH":
						$where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
						break;
					case "ENDS_WITH":
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
						break;
				}
								
				if ($i == $filterscount - 1)
				{
					$where .= ")";
				}
				$tmpfilteroperator = $filteroperator;
				$tmpdatafield = $filterdatafield;	
						
			}
			// build the query.			
		}
		else{$where=array();}
		
		
		
		if ($sortorder == '')
		{
			$sortdatafield="j1.name";
			$sortorder = "ASC";				
		}
				
		$this->db
			->select("SQL_CALC_FOUND_ROWS j1.name, j1.id", FALSE)
			->from('ref_country as j1')
			->where("j1.data_status>0", NULL, FALSE)
			->where($where)
			->order_by($sortdatafield,$sortorder)
			->limit($limit, $offset);
		$q=$this->db->get();
		
		$query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
		$objCount = $query->result_array();		
		$result["TotalRows"] = $objCount[0]['Count'];
		

		if ($q->num_rows() > 0){        
			$result["Rows"] = $q->result();
		} else {
			$result["Rows"] = array();
		}  		
		return $result;
	}
	
	
	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{	
		$str = "Delete From holidays where years = '".$this->input->post('year')."' and country_id = '".$edit_id."'";
		$this->db->query($str);

		$all_dates = explode(',', $this->input->post('dates'));
		foreach ($all_dates as $row) {
			if($row=='01/01/1900'){continue;}
			$p_value_date = $row;
			$v_date = implode('-',array_reverse(explode('/',$p_value_date)));
			$data[] = array(
						'country_id' => $edit_id,
						'years' => $this->input->post('year'),
						'holiy_dt' => $v_date,
						'e_by'   => $this->session->userdata['ast_user']['user_id'],
						'e_dt' => date('Y-m-d H:i:s')
					);			
		}
		
		if(count($data)>0)
		{
			$this->db->insert_batch('holidays', $data);
		}
		
		return $edit_id;
	}
	

	function get_info($id,$year=NULL)
	{
		if($id!=''){
			if($year!=NULL){$where=" and years='".$year."'";}else{$where="";}
			$this->db->query("SET SESSION group_concat_max_len = 1000000;");
			$str = "select s1.*, c.name as cName from
					(
			
					SELECT country_id, years, GROUP_CONCAT(date_format(holiy_dt, '%d/%m/%Y') SEPARATOR ',') as dates FROM holidays 
					WHERE country_id='".$id."' ".$where." group by years order by years DESC LIMIT 1
					) s1
					left outer join ref_country c on s1.country_id=c.id
					";
			$query=$this->db->query($str);
			return $query->row();
		}else{return array();}
	}
	
	function get_info_country($id)
	{		
		$str = "select c.name as cName from  ref_country c where c.id='".$id."'	";
		$query=$this->db->query($str);
		return $query->row()->cName;
		
	}
	
	
}
?>