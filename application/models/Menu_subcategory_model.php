<?php
class Menu_subcategory_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		ini_set('memory_limit', '1024M'); 
    }
   
    function get_menu_operation_data()
	{
		$str = "SELECT * FROM ref_menu_operation order by id ASC";
		$query=$this->db->query($str);
		return $query->result();
    }
    function get_menu_group_data()
	{
		$str = "SELECT * FROM menu_group order by sort_order ASC";
		$query=$this->db->query($str);
		return $query->result();
	}
    function get_menu_category_data()
	{
		$str = "SELECT * FROM menu_category order by id ASC";
		$query=$this->db->query($str);
		return $query->result();
    }
    
    function get_menu_link_info($add_edit,$id)
	{
		if($id!=''){
			$this->db->limit(2);
			$data = $this->db->get_where('menu_link', array('id' => $id));
			// echo $this->db->last_query();
			return $data->row();
		}else{return array();}
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
				$filtervalue = str_replace('"', '\"', str_replace("'", "\'", $this->input->get('filtervalue'.$i)));
				// get the filter's condition.
				$filtercondition = $this->input->get('filtercondition'.$i);
				// get the filter's column.
				$filterdatafield = $this->input->get('filterdatafield'.$i);
				// get the filter's operator.
				$filteroperator = $this->input->get('filteroperator'.$i);		
				
				
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
		}else{$where=array();}
		
		if ($sortorder == '')
		{
			$sortdatafield="j0.id";
			$order = "asc";
		}
		
		
		
		$this->db
			->select("SQL_CALC_FOUND_ROWS j0.*,j1.menu_name,j2.menu_cate_name", FALSE)
			->from('menu_link as j0', FALSE)
            ->join("menu_group as j1", "j0.menu_group_id=j1.id", "left")
            ->join("menu_category as j2", "j0.menu_cate_id=j2.id", "left")
			->where('j0.data_status', '1', FALSE)
			->where($where)
			->order_by($sortdatafield,$sortorder)
			->limit($limit, $offset);
		$q = $this->db->get();
		
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
    
    function get_MenuCatagory_data()
	{  $id=$this->input->post('catId');
		$str = "SELECT * FROM menu_category where menu_group_id='".$id."' order by id ASC";
        $query=$this->db->query($str);
        //echo $this->db->last_query();exit;
        return $query->result();
        
    }
    
    function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		$this->db->trans_begin();
		//print_r($_POST); exit;
	    $data = array(
            'menu_group_id' => $this->security->xss_clean(trim($this->input->post('group_ddl'))),
            'menu_cate_id' => $this->security->xss_clean(trim($this->input->post('catagory_ddl'))),
            'menu_operation' => $this->security->xss_clean(trim($this->input->post('Operation_ddl'))),
			'menu_link_name' => $this->security->xss_clean(trim($this->input->post('menu_link_name'))),
			'url_prefix' => $this->security->xss_clean(trim($this->input->post('url_prefix'))),
			'sort_order' => $this->security->xss_clean($this->input->post('sort_order')),

		);
		if($add_edit=="add")
		{			
			$data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
			$data['entry_datetime'] = date('Y-m-d H:i:s');
			$this->db->insert('menu_link', $data);
			$insert_idss = $this->db->insert_id();
			
			$data2 = $this->user_model->user_activities(1,$insert_idss,'menu_link','Add Menu sub Category');
		
		}else{		
			$data['last_modify_by']=$this->session->userdata['ast_user']['user_id'];
			$data['last_modify_datetime']=date('Y-m-d H:i:s');
			$this->db->where('id', $edit_id);
			$this->db->update('menu_link', $data);
			
			$data2 = $this->user_model->user_activities(2,$edit_id,'menu_link','Edit Menu  Sub Category');
			
			$insert_idss = $edit_id;
		}
		if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
				return 00;
		}
		else
		{
			$this->db->trans_commit();
			return $insert_idss;
		}

    }
    
    function duplicate_name($field,$val,$edit_id=NULL)
	{  
		//echo $field; exit;
		$where="data_status=1 and (upper(".$field.")='".strtoupper($val)."')";
		if($edit_id!=''){$where.=" and id!='".$edit_id."'";}
		$this->db->where($where, NULL, FALSE);
		$this->db->from('menu_link');
		$q=$this->db->get();
		 // echo $this->db->last_query();exit;
		return $q->num_rows();
	}

	function duplicate_sort_order($edit_id=NULL)
	{  
		//echo $field; exit;
		$valSort=$this->input->post('valSort');
		$valgroup=$this->input->post('valgroup');
		$valcatagory=$this->input->post('valcatagory');
		$where="data_status=1 and menu_group_id='".$valgroup."' AND menu_cate_id='".$valcatagory."' AND sort_order='".$valSort."'";
		//echo $where; exit;
		if($edit_id!=''){$where.=" and id!='".$edit_id."'";}
		$this->db->where($where, NULL, FALSE);
		$this->db->from('menu_link');
		$q=$this->db->get();
		//echo $this->db->last_query();exit;
		return $q->num_rows();
	}

	function duplicate_ink_name($edit_id=NULL)
	{  
		//echo $field; exit;
		$valcatagory=$this->input->post('valcatagory');
		$valgroup=$this->input->post('valgroup');
		$vallink_name=$this->input->post('vallink_name');
		$where="data_status=1 and menu_group_id='".$valgroup."' AND menu_cate_id='".$valcatagory."' AND menu_link_name='".$vallink_name."'";
		//echo $where; exit;
		if($edit_id!=''){$where.=" and id!='".$edit_id."'";}
		$this->db->where($where, NULL, FALSE);
		$this->db->from('menu_link');
		$q=$this->db->get();
		//echo $this->db->last_query();exit;
		return $q->num_rows();
	}

    function check_menu_cat_exists($menu_group_id)
	{
		$count = 0;
		$res = $this->db->query("SELECT   COUNT(*) AS rowcount  FROM users_right WHERE menu_link_id =".$menu_group_id." AND data_status=1")->row();
		//print_r($res) ; exit ;
		if(is_object($res))
		{
			//$count = $res['rowcount'];
			$count = $res->rowcount;
		}
		//echo $count; exit;
		return $count;
	}
	
	function delete_action()
	{
		$this->db->trans_begin();
		if($this->input->post('id'))
		{
			$item = array(
						'data_status' => 0
					);
			$this->db->where(array('id'=>$this->input->post('id'),'data_status'=>1));
			$this->db->update('menu_category',$item);
		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
			return $this->input->post('id');
		}
	}

}
?> 