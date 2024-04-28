<?php
class Menu_group_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		ini_set('memory_limit', '1024M'); 
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
		
		$con="j0.menu_name !=' ' AND j0.id != 12";

		/*if($this->session->userdata['ast_user']['user_system_admin_sts']==2)
		{
			$con="j0.group_name !=' ' ";
		}else{
			$con="j0.group_name !='Super Admin' ";
		} */
		
		$this->db
			->select("SQL_CALC_FOUND_ROWS j0.*", FALSE)
			->from('menu_group as j0', FALSE)
			->where('j0.data_status', '1', FALSE)
			->where($where)
			->where($con)
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


	function duplicate_name($field,$val,$edit_id=NULL)
	{
		$where="data_status=1 and (upper(".$field.")='".strtoupper($val)."')";
		if($edit_id!=''){$where.=" and id!='".$edit_id."'";}
		$this->db->where($where, NULL, FALSE);
		$this->db->from('menu_group');
		$q=$this->db->get();
		 // echo $this->db->last_query();exit;
		return $q->num_rows();
	}
	function getNextId() {
	 $sql="SELECT MAX(ID) AS nextid FROM menu_group WHERE entry_by=".$this->session->userdata['ast_user']['user_id'];
	 $query=$this->db->query($sql)->row();
	 //echo $this->db->last_query();
	  return $query->nextid;
	}
	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		$this->db->trans_begin();
	    $data = array(
			'sort_name' => $this->security->xss_clean(trim($this->input->post('sort_name'))),
			'menu_name' => $this->security->xss_clean(trim($this->input->post('menu_name'))),
			'has_child' => $this->security->xss_clean(trim($this->input->post('has_child'))),
			'url_prefix' => $this->security->xss_clean(trim($this->input->post('url_prefix'))),
			'sort_order' => $this->security->xss_clean($this->input->post('sort_order')),

		);
		if($add_edit=="add")
		{			
			$data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
			$data['entry_datetime'] = date('Y-m-d H:i:s');
			$this->db->insert('menu_group', $data);
			$insert_idss = $this->db->insert_id();
			
			$data2 = $this->user_model->user_activities(1,$insert_idss,'menu_group','Add Menu Group');
		
		}else{		
			$data['last_modify_by']=$this->session->userdata['ast_user']['user_id'];
			$data['last_modify_datetime']=date('Y-m-d H:i:s');
			$this->db->where('id', $edit_id);
			$this->db->update('menu_group', $data);
			
			$data2 = $this->user_model->user_activities(2,$edit_id,'menu_group','Edit Menu Group');
			
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
	
	function delete_action()
	{
		$this->db->trans_begin();
		if($this->input->post('id'))
		{
			$item = array(
						'data_status' => 0
					);
			$this->db->where(array('id'=>$this->input->post('id'),'data_status'=>1));
			$this->db->update('menu_group',$item);
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
	
    function check_menu_cat_exists($menu_group_id)
	{
		return $this->db->query("SELECT id FROM menu_category WHERE menu_group_id =".$menu_group_id." AND data_status=1")->result();
	}
	
	function get_menu_group_info($add_edit,$id)
	{
		if($id!=''){
			$this->db->limit(2);
			$data = $this->db->get_where('menu_group', array('ID' => $id));
			// echo $this->db->last_query();
			return $data->row();
		}else{return array();}
	}
	
	// Group rights start
	function system_cat_list()
	{
		$str = "select * from menu_category where data_status='1'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function wg_checked_right($Id=NULL)
	{
		$str = "select * from menu_link tr
				left outer join user_group_right gr
				on(tr.id=gr.menu_link_id) where gr.user_group_id='".$Id."' and gr.data_status='1' and tr.data_status='1'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function wg_link_list()
	{
		$str = "select * from menu_link where data_status='1'";
		$query=$this->db->query($str);
		return $query->result();
	}
	//any used of this function
	function total_cate_right_chak($wg_id=NULL,$cat_id=NULL)
	{
		$str = "select tr.id as srid,tr.name as srname
				from sys_links tr
				left outer join usr_group_link_right grc on(tr.id=grc.sys_user_rightId )
				where tr.sys_link_cat_id='".$cat_id."'
				and tr.sts='1' and grc.Status='1' and grc.user_groupId='".$wg_id."'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function sys_user_order($surcid=NULL)
	{
		$str = "select tr.name as rname,tr.id as rid,tcr.*
			from sys_links tr
			left outer join sys_link_cat tcr on(tr.sys_link_cat_id=tcr.id)
			where tr.sys_link_cat_id='".$surcid."'
			and tcr.sts='1' and tr.sts='1'";
		$query=$this->db->query($str);
		return $query->result();
	}
	//// any
	function sys_user_order_chak($surcid=NULL,$chake=NULL)
	{
		$str = "SELECT * FROM user_group_right where user_group_id ='".$surcid."' AND menu_link_id='".$chake."' AND data_status='1'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function delete_user_group_right($surcid=NULL)
	{
		$str = "Delete From user_group_right WHERE user_group_id ='".$surcid."'";
		$query=$this->db->query($str);
		if (!empty($query))
		{
			return 1;
		}
		else
		{
			return 0;
		}

	}
	function delete_user_group_right_details($surcid=NULL)
	{
		$str = "Delete From user_group_right_details WHERE user_group_id ='".$surcid."'";
		$query=$this->db->query($str);
		if (!empty($query))
		{
			return 1;
		}
		else
		{
			return 0;
		}

	}
	function delete_users_group_right_ref_table($surcid=NULL)
	{
		$str = "Delete From users_group_right_ref_table WHERE user_group_id ='".$surcid."'";
		$query=$this->db->query($str);
		if (!empty($query))
		{
			return 1;
		}
		else
		{
			return 0;
		}

	}
	function delete_users_group_right_service_table($surcid=NULL)
	{
		$str = "Delete From users_group_right_service_table WHERE user_group_id ='".$surcid."'";
		$query=$this->db->query($str);
		if (!empty($query))
		{
			return 1;
		}
		else
		{
			return 0;
		}

	}
	function delete_users_group_right_maintenance_table($surcid=NULL)
	{
		$str = "Delete From users_group_right_maintenance_table WHERE user_group_id ='".$surcid."'";
		$query=$this->db->query($str);
		if (!empty($query))
		{
			return 1;
		}
		else
		{
			return 0;
		}

	}
	function service_table_right_details($user_id,$operation)
	{	
		$str = "SELECT GROUP_CONCAT(u.reference_table_id ORDER BY u.ID SEPARATOR',') AS sys_user_referencerightid FROM users_group_right_service_table u where u.data_status=1  AND u.operation='".$operation."' AND u.user_group_id='".$user_id."'";
		$query=$this->db->query($str);
		$result=$query->row();	
		return $result;
	}
	function maintenance_table_right_details($user_id,$operation)
	{	
		$str = "SELECT GROUP_CONCAT(u.reference_table_id ORDER BY u.ID SEPARATOR',') AS sys_user_referencerightid FROM users_group_right_maintenance_table u where u.data_status=1  AND u.operation='".$operation."' AND u.user_group_id='".$user_id."'";
		$query=$this->db->query($str);
		$result=$query->row();	
		return $result;
	}
	// ---Modified by Rafiya
	function set_right_update($wg_id)
	{
        $this->db->trans_begin();
		$this->Menu_group_model->delete_user_group_right($wg_id);
		$this->Menu_group_model->delete_user_group_right_details($wg_id);
		$this->Menu_group_model->delete_users_group_right_ref_table($wg_id);
		$this->Menu_group_model->delete_users_group_right_service_table($wg_id);
		$this->Menu_group_model->delete_users_group_right_maintenance_table($wg_id); 
			
		$data = array();
		$data5 = array();
		$data6 = array();
		$data7 = array();
			
		$group_counter = $_POST['group_counter'];
			
		for($i = 1; $i <= $group_counter; $i++)
		{
			$categ_counter = $_POST['group'.$i.'categ_counter'];
			
			for($j = 1; $j <= $categ_counter; $j++)
			{
				$input_counter = $_POST['group'.$i.'categ'.$j.'input_counter'];
				for($k=1;$k<=$input_counter;$k++)
				{
					$id = $_POST['group'.$i.'categ'.$j.'id'.$k];
					$value = isset($_POST['group'.$i.'categ'.$j.'input'.$k]);
					$link_id = $_POST['group'.$i.'categ'.$j.'id'.$k.'details_id'];
					$link_details = $_POST['group'.$i.'categ'.$j.'id'.$k.'details_link'];
					if($value)
					{
						if(!empty($link_id))
						{
							$link_id_value_arr=explode("###", $link_id);
							$link_details_value_arr=explode("###", $link_details);
							for($d = 0; $d < count($link_id_value_arr); $d++)
							{
								$data1[] = array(
											'menu_link_details_id'=>$link_id_value_arr[$d],
											'url_profix'=>$link_details_value_arr[$d],
											'user_group_id'=>$wg_id,
											'menu_link_id'=>$id,
											'data_status'=>1,
											'entry_by'=>$this->session->userdata['ast_user']['user_id'],
											'entry_datetime'=>date('Y-m-d H:i:s')
										);
							}
						}
					}

					if($value)
					{
						$data[]	=	array(
									'user_group_id'=>$wg_id,
									'menu_link_id'=>$id,
									'data_status'=>1,
									'entry_by'=>$this->session->userdata['ast_user']['user_id'],
									'entry_datetime'=> date('Y-m-d H:i:s')
									);
					}
					
					if($i==3 && ($id == 28 || $id == 29 || $id == 30 || $id == 31))
					{
						
						$ref_table_id_list = $_POST['group'.$i.'REF_TABLE_LIST'.$j.'input'.$k];
						$opp_name = $_POST['group'.$i.'REF_TABLE_LIST'.$j.'id'.$k.'operation'];
						
						if($value)
						{
							if(!empty($ref_table_id_list))
							{
								
								$ref_table_right = "select * from reference_list_link_right where data_status=1 AND menu_operation='".$opp_name."' AND reference_table_id IN(".$ref_table_id_list.")";
								$query5=$this->db->query($ref_table_right);
								//echo $this->db->last_query();exit;
								$ref_table_right_query=$query5->result();
								//print_r($link_id_value_arr);exit;
								foreach($ref_table_right_query as $ref_right){
									$data5[]=array(
										'reference_table_id'=>$ref_right->reference_table_id,
										'reference_table_id_right_id'=>$ref_right->id,
										'user_group_id'=>$wg_id,
										'operation'=>$opp_name,
										'data_status'=>1,
										'entry_by'=>$this->session->userdata['ast_user']['user_id'],
										'entry_datetime'=>date('Y-m-d H:i:s')
									);
									
								}
							}
						}
					}	
					
					else if($i==$this->config->item('service_group_id') && in_array($id, $this->config->item('service_link_id')))
					{
						//echo $this->config->item('service_group_id');exit;
						$ref_table_id_list = explode(",",$_POST['group'.$i.'REF_TABLE_LIST'.$j.'input'.$k]);
						$opp_name = $_POST['group'.$i.'REF_TABLE_LIST'.$j.'id'.$k.'operation'];
						if($value)
						{
							if(!empty($ref_table_id_list))
							{
								foreach($ref_table_id_list as $ref_table_id_list_row)
								{
									 $ref_table_right = "select * from reference_list_link_right where data_status=1 AND menu_operation='".$opp_name."' AND reference_table_id =".$this->config->item('service_ref_id');;
									$query5 = $this->db->query($ref_table_right);

									$ref_table_right_query=$query5->result();
									
									foreach($ref_table_right_query as $ref_right)
									{
										$data6[]=array(
											//'reference_table_id'=>$ref_right->reference_table_id,  //10 service
											'reference_table_id'=>$ref_table_id_list_row,  //10 service
											'reference_table_id_right_id'=>$ref_right->id,    // 44 add 
											'user_group_id'=>$wg_id,
											'operation'=>$opp_name, //add
											'data_status'=>1,  
											'entry_by'=>$this->session->userdata['ast_user']['user_id'],
											'entry_datetime'=> date('Y-m-d H:i:s')
										);
										
									}
								}
							}
						}
					} 
					else if($i == $this->config->item('maintenance_group_id') && in_array($id, $this->config->item('maintenance_link_id')))
					{
						$ref_table_id_list = explode(",",$_POST['group'.$i.'REF_TABLE_LIST'.$j.'input'.$k]);
						$opp_name = $_POST['group'.$i.'REF_TABLE_LIST'.$j.'id'.$k.'operation'];
						
						if($value)
						{
							if(!empty($ref_table_id_list))
							{
								foreach($ref_table_id_list as $ref_table_id_list_row)
								{
									$ref_table_right = "select * from reference_list_link_right where data_status=1 AND menu_operation='".$opp_name."' AND reference_table_id =".$this->config->item('maintenance_ref_id');
									$query5 = $this->db->query($ref_table_right);
									$ref_table_right_query = $query5->result();
									foreach($ref_table_right_query as $ref_right)
									{
										$data7[]=array(
											//'reference_table_id'=>$ref_right->reference_table_id,
											'reference_table_id'=>$ref_table_id_list_row,
											'reference_table_id_right_id'=>$ref_right->id,
											'user_group_id'=>$wg_id,
											'operation'=>$opp_name,
											'data_status'=>1,
											'entry_by'=>$this->session->userdata['ast_user']['user_id'],
											'entry_datetime'=>date('Y-m-d H:i:s')
										);
										
									}
								}

							}
						}
					}					
				}
			}
		}
		/* echo '<pre>'; 
		print_r($data6); exit; */
		//print_r($data);
		
		/* 	print_r($data1);
			print_r($data5);
			print_r($data6);
			print_r($data7); */
		
			if(!empty($data))
			{
				$this->db->insert_batch('user_group_right', $data);
			}
			if(!empty($data1))
			{
				$this->db->insert_batch('user_group_right_details', $data1);
			}
			if(!empty($data5))
			{
				$this->db->insert_batch('users_group_right_ref_table', $data5);
			}
			if(!empty($data6))
			{
				$this->db->insert_batch('users_group_right_service_table', $data6);
			}
			if(!empty($data7))
			{
				$this->db->insert_batch('users_group_right_maintenance_table', $data7);
			}  
			
			$common = "select * from menu_link_details where common_status=1";
			$query1=$this->db->query($common);
			$common_query=$query1->result();
			if(!empty($common_query))
			{
				foreach($common_query as $cc)
				{
					$data2[]=array(
						'menu_link_details_id'=>$cc->id,
						'url_profix'=>$cc->url_profix,
						'user_group_id'=>$wg_id,
						'menu_link_id'=>$id,
						'data_status'=>1,
						'entry_by'=>$this->session->userdata['ast_user']['user_id'],
						'entry_datetime'=>date('Y-m-d H:i:s')
					);
				}

			}
			$admin = "select * from menu_link_details where admin_status=1";
			$query2=$this->db->query($admin);
			$common_query=$query2->result();
			if(!empty($admin_query))
			{
				foreach($admin_query as $add)
				{
					$data2[]=array(
						'menu_link_details_id'=>$add->id,
						'url_profix'=>$add->url_profix,
						'user_group_id'=>$wg_id,
						'menu_link_id'=>$id,
						'data_status'=>1,
						'entry_by'=>$this->session->userdata['ast_user']['user_id'],
						'entry_datetime'=>date('Y-m-d H:i:s')
					);
				}

			}
			$this->db->insert_batch('user_group_right_details', $data2);	
			
		 	$usersql = "SELECT GROUP_CONCAT(id) AS user_ids FROM users_info WHERE data_status=1 AND FIND_IN_SET($wg_id,user_group_id)";
			$userArray = $this->db->query($usersql)->row()->user_ids;
			$stru1 = "DELETE FROM users_right WHERE user_info_id IN ('".$userArray."')";
			$query1=$this->db->query($stru1);
			$stru2 = "DELETE FROM users_right_details WHERE user_info_id IN ('".$userArray."')";
		    $query2=$this->db->query($stru2);
			$stru3 = "DELETE FROM users_right_ref_table WHERE user_info_id IN ('".$userArray."')";
			$query3=$this->db->query($stru3);
			$stru4 = "DELETE FROM users_right_service_table WHERE user_info_id IN ('".$userArray."')";
			$query4 = $this->db->query($stru4);
			$stru5 = "DELETE FROM users_right_maintenance_table WHERE user_info_id IN ('".$userArray."')";
			$query5 = $this->db->query($stru5);
				//echo '<pre>'; print_r($data[0]);
				//echo count($data);
			$userIdArr = explode(",",$userArray);
			foreach($userIdArr AS $userIdArrrow)
			{
				if(!empty($data))
				{
					for($c = 0; $c < count($data); $c++)
					{
						$data[$c]["user_info_id"] = $userIdArrrow;
						unset($data[$c]["user_group_id"]);
					}
				}
				if(!empty($data1))
				{
					for($c1 = 0; $c1 < count($data1); $c1++)
					{
						$data1[$c1]["user_info_id"] = $userIdArrrow;
						unset($data1[$c1]["user_group_id"]);
					}
				}
				if(!empty($data5))
				{
					for($c5 = 0; $c5 < count($data5); $c5++)
					{
						$data5[$c5]["user_info_id"] = $userIdArrrow;
						unset($data5[$c5]["user_group_id"]);
					}
				}
				if(!empty($data6))
				{
					for($c6 = 0; $c6 < count($data6); $c6++)
					{
						$data6[$c6]["user_info_id"] = $userIdArrrow;
						unset($data6[$c6]["user_group_id"]);
					}
				}
				if(!empty($data7))
				{
					for($c7 = 0; $c7 < count($data7); $c7++)
					{
						$data7[$c7]["user_info_id"] = $userIdArrrow;
						unset($data7[$c7]["user_group_id"]);
					}
				}
				if(!empty($data2))
				{
					for($c2 = 0; $c2 < count($data2); $c2++)
					{
						$data2[$c2]["user_info_id"] = $userIdArrrow;
						unset($data2[$c2]["user_group_id"]);
					}
				}
			}
			
					
			if(!empty($data))
			{
				$this->db->insert_batch('users_right', $data);
			}
			if(!empty($data1))
			{
				$this->db->insert_batch('users_right_details', $data1);
				
			}
			if(!empty($data5))
			{
				$this->db->insert_batch('users_right_ref_table', $data5);
			}
			if(!empty($data6))
			{
				$this->db->insert_batch('users_right_service_table', $data6);
				//	echo $this->db->last_query();exit;
			}
			if(!empty($data7))
			{
				$this->db->insert_batch('users_right_maintenance_table', $data7);
			}
			if(!empty($data2))
			{
				$this->db->insert_batch('users_right_details', $data2);	
			}
			$data5 = array(
						'activities_id' => 4,
						'activities_by' => $this->session->userdata['ast_user']['user_id'],
						'activities_datetime' => date('Y-m-d H:i:s'),
						'ip_address' => $this->input->ip_address(),
						'operate_user_id' => $id,
						'table_name' => 'users_info', 
						'description_activities' => 'Set User Group Privilege'
					);
			if(!empty($data5))
			{
				$this->db->insert('user_activities_history', $data5);
			}	
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return 00;
			}
			else
			{
				$this->db->trans_commit();
				return 1;
			}

	}
	function ref_table_right_details($user_id,$operation)
	{	
		$str = "SELECT GROUP_CONCAT(u.reference_table_id ORDER BY u.id SEPARATOR',') AS sys_user_referencerightid FROM users_group_right_ref_table u where u.data_status=1  AND u.operation='".$operation."' AND u.user_group_id='".$user_id."'";
		$query=$this->db->query($str);
		//echo $this->db->last_query();exit;
		$result=$query->row();	
		return $result;
	}
	
	// Get all links with joining group and category ---Raihan
	function system_link_list()
	{
		$sts=0;
		if($this->session->userdata['ast_user']['user_system_admin_sts']==2){
			$sts=1;
		}
		if($sts==0){
		$str = "
				SELECT tr.*,
				       tr.menu_link_name right_name,
				       tr.menu_cate_id categ_id,
				       tr.menu_group_id group_id,
				       cat.menu_cate_name categ_name,
				       gr.menu_name group_name
				  FROM (SELECT menu_link_id
				          FROM users_right
				         WHERE USER_INFO_ID = '".$this->session->userdata['ast_user']['user_id']."') s1
				                left outer join menu_link tr on(tr.id=s1.menu_link_id)
				                left outer join menu_category cat on(cat.id=tr.menu_cate_id)
				                left outer join menu_group gr on(gr.id=tr.menu_group_id)
				                where cat.data_status='1' and gr.data_status='1' and tr.data_status='1'
                order by tr.menu_group_id,tr.menu_cate_id, tr.sort_order

				";
		}else if($sts==1){
		$str = "select tr.*,tr.menu_link_name right_name,tr.menu_cate_id categ_id, tr.menu_group_id group_id,
				cat.menu_cate_name categ_name,gr.menu_name group_name from menu_link tr
				left outer join menu_category cat on(cat.ID=tr.menu_cate_id)
				left outer join menu_group gr on(gr.ID=tr.menu_group_id)
				where cat.data_status='1' and gr.data_status='1' and tr.data_status='1'
				order by tr.menu_group_id,tr.menu_cate_id,  tr.sort_order";
		}

		$query=$this->db->query($str);
		// echo $this->db->last_query();exit;
		return $query->result_array();
	}
	function get_working_group_rights_old($Id=NULL)
	{
		if($Id==NULL){ return ''; }
		$str = "SELECT LISTAGG (gr.menu_link_id, ',')
          WITHIN GROUP (ORDER BY gr.menu_link_id)
          sys_user_rightid
       FROM user_group_right gr where gr.user_group_id='".$Id."' and gr.data_status='1' GROUP BY gr.user_group_id";
		$query=$this->db->query($str);
		// echo $this->db->last_query();exit;
		$result=$query->row();
		if($query->num_rows()>0){
			//echo $result->SYS_USER_RIGHTID;exit;
			return $result->sys_user_rightid;
		}
		return '';
	}
	
	function get_working_group_rights($Id=NULL)
	{
		if($Id==NULL){ return ''; }
		
		$str = "SELECT GROUP_CONCAT(gr.menu_link_id) sys_user_rightid from user_group_right gr where gr.user_group_id='".$Id."' and gr.data_status='1' GROUP BY gr.user_group_id";
		$query = $this->db->query($str);
		$result = $query->row();
		if($query->num_rows()>0)
		{
			return $result->sys_user_rightid;
		}
		return '';
	}
	
	function get_working_group_info($add_edit,$id)
	{
		if($id!='')
		{
			$this->db->limit(1);
			$data = $this->db->get_where('user_group', array('id' => $id));
			// echo $this->db->last_query();exit;
			return $data->row();
		}else{return array();}
	}
}
?>