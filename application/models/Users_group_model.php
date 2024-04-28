<?php
class Users_group_model extends CI_Model {

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
			$sortdatafield="j0.group_name";
			$order = "asc";
		}

		if($this->session->userdata['ast_user']['user_system_admin_sts']==2){
			$con="j0.group_name !=' ' ";
		}else{
			$con="j0.group_name !='Super Admin' ";
		}
		
		$this->db
			->select("SQL_CALC_FOUND_ROWS j0.*", FALSE)
			->from('user_group as j0', FALSE)
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
		$this->db->from('user_group');
		$q=$this->db->get();
		 // echo $this->db->last_query();exit;
		return $q->num_rows();
	}
	function getNextId() {
	 $sql="SELECT MAX(id) AS NEXTID FROM user_group WHERE entry_by=".$this->session->userdata['ast_user']['user_id'];
	 $query=$this->db->query($sql)->row();
	 //echo $this->db->last_query();
	  return $query->NEXTID;
	}
	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		$this->db->trans_begin();
	    $data = array(
			'group_name' => $this->security->xss_clean(trim($this->input->post('msgArea'))),
			'group_code' => $this->security->xss_clean(trim($this->input->post('code'))),
			'remarks' => $this->security->xss_clean($this->input->post('remarks')),

		);
		if($add_edit=="add")
		{			
			$data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
			$data['entry_datetime'] = date('Y-m-d H:i:s');
			$this->db->insert('user_group', $data);
			$insert_idss = $this->db->insert_id();
			
			$data2 = $this->user_model->user_activities(39,'',$insert_idss,'user_group','Add User Group','',$this->session->userdata['ast_user']['user_id'],$this->security->xss_clean(trim($this->input->post('msgArea'))));
		
		}else{		
			$data['last_modified_by']=$this->session->userdata['ast_user']['user_id'];
			$data['last_modified_datetime']=date('Y-m-d H:i:s');
			$this->db->where('id', $edit_id);
			$this->db->update('user_group', $data);
			
			$data2 = $this->user_model->user_activities(35,'',$edit_id,'user_group','Edit User Group','',$this->session->userdata['ast_user']['user_id'],$this->security->xss_clean(trim($this->input->post('msgArea'))));
			
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
		if($this->input->post('id')){
			$item=array(
				'data_status'=>0

			);
			$this->db->where(array('id'=>$this->input->post('id'),'data_status'=>1));
			$this->db->update('user_group',$item);
			$this->db->query("DELETE FROM user_group_right WHERE user_group_id='".$this->input->post('id')."'");
			$data2 = $this->user_model->user_activities(15,'',$this->input->post('id'),'user_group','Delete User Group','',$this->session->userdata['ast_user']['user_id'],'');

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

	function get_users_group_info($add_edit,$id)
	{
		if($id!=''){
			$this->db->limit(2);
			$data = $this->db->get_where('user_group', array('id' => $id));
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
		$str = "SELECT GROUP_CONCAT(u.reference_table_id ORDER BY u.id SEPARATOR',') AS sys_user_referencerightid FROM users_group_right_service_table u where u.data_status=1  AND u.operation='".$operation."' AND u.user_group_id='".$user_id."'";
		$query=$this->db->query($str);
		$result=$query->row();	
		return $result;
	}
	function maintenance_table_right_details($user_id,$operation)
	{	
		$str = "SELECT GROUP_CONCAT(u.reference_table_id ORDER BY u.id SEPARATOR',') AS sys_user_referencerightid FROM users_group_right_maintenance_table u where u.data_status=1  AND u.operation='".$operation."' AND u.user_group_id='".$user_id."'";
		$query=$this->db->query($str);
		$result=$query->row();	
		return $result;
	}
	// ---Modified by Rafiya
	function set_right_update($wg_id)
	{

			//Chaged by Enayet (02/27/2022)
			$pre_reght_result = $this->db->query("SELECT GROUP_CONCAT(u.menu_link_id) ids FROM user_group_right u WHERE u.user_group_id=".$wg_id." AND u.data_status=1 GROUP BY  u.user_group_id")->row();
			$pre_reght_dtails_result = $this->db->query("SELECT GROUP_CONCAT(u.menu_link_details_id) ids FROM user_group_right_details u WHERE u.user_group_id=".$wg_id." AND u.data_status=1 GROUP BY  u.user_group_id")->row();
			/////////
		   	$this->Users_group_model->delete_user_group_right($wg_id);
		   	$this->Users_group_model->delete_user_group_right_details($wg_id);
		    
			$data=array();
			$data1=array();
			$data5=array();
			$data6=array();
			$data7=array();
			
			
			$dataa=array();
			$dataa_d=array();
			
			$group_counter = $_POST['group_counter'];
			
			for($i=1;$i<=$group_counter;$i++)
			{
				$categ_counter = $_POST['group'.$i.'categ_counter'];
				for($j=1;$j<=$categ_counter;$j++){
					$input_counter = $_POST['group'.$i.'categ'.$j.'input_counter'];
					for($k=1;$k<=$input_counter;$k++){
							$id = $_POST['group'.$i.'categ'.$j.'id'.$k];
							$value = isset($_POST['group'.$i.'categ'.$j.'input'.$k]);
							$link_id = $_POST['group'.$i.'categ'.$j.'id'.$k.'details_id'];
							$link_details = $_POST['group'.$i.'categ'.$j.'id'.$k.'details_link'];
							if($value){

								if(!empty($link_id)){
									$link_id_value_arr=explode("###", $link_id);
									$link_details_value_arr=explode("###", $link_details);
									//print_r($link_id_value_arr);exit;
									for($d=0;$d<count($link_id_value_arr);$d++){
										$data1[]=array(
											'menu_link_details_id'=>$link_id_value_arr[$d],
											'url_profix'=>$link_details_value_arr[$d],
											'user_group_id'=>$wg_id,
											'data_status'=>1,
											'entry_by'=>$this->session->userdata['ast_user']['user_id'],
											'entry_datetime'=>date('Y-m-d H:i:s')
										);
									}

								}
						}

						if($value){
							$data[]=array(
							'user_group_id'=>$wg_id,
							'menu_link_id'=>$id,
							'data_status'=>1,
							'entry_by'=>$this->session->userdata['ast_user']['user_id'],
							'entry_datetime'=> date('Y-m-d H:i:s')
							);
						}
				
				
								
					}
				}
			}
			
			if(!empty($data)){
				$this->db->insert_batch('user_group_right', $data);
			}
			if(!empty($data1)){
				$this->db->insert_batch('user_group_right_details', $data1);
			}
			$result = $this->db->query("SELECT GROUP_CONCAT(u.id) ids FROM users_info u WHERE FIND_IN_SET('".$wg_id."',u.user_group_id) AND u.data_status=1");
			if($result->num_rows()>0){
				$row = $result->row();
				if($row->ids !=''){
					//Chaged by Enayet (02/27/2022)
					if(!empty($pre_reght_result))
					{
						$this->db->query("DELETE FROM users_right WHERE user_info_id IN(".$row->ids.") AND menu_link_id IN(".$pre_reght_result->ids.")");
					}
					else
					{
						$this->db->query("DELETE FROM users_right WHERE user_info_id IN(".$row->ids.")");
					}
					
					if(!empty($pre_reght_dtails_result))
					{
						$this->db->query("DELETE FROM users_right_details WHERE user_info_id IN(".$row->ids.") AND menu_link_id IN(".$pre_reght_dtails_result->ids.")");
					}
					else
					{
						$this->db->query("DELETE FROM users_right_details WHERE user_info_id IN(".$row->ids.")");
					}
					///////////////////////
					//// UPDATE CODE FOR MULTI GROUP BY ENAYET (2023-10-04)

					$user_id_array = explode(",",$row->ids);

					for ($i=0; $i<count($user_id_array); $i++) { 
						$user_result = $this->db->query("SELECT u.id,u.user_group_id FROM users_info u WHERE u.id='".$user_id_array[$i]."' LIMIT 1")->row();
						if(!empty($user_result))
						{
							$this->set_default_group_rights($user_result->id,$user_result->user_group_id);
						}
					}

					///////////// END //////////////
					//$this->db->query("DELETE FROM users_right WHERE user_info_id IN(".$row->ids.")");
					//$this->db->query("DELETE FROM users_right_details WHERE user_info_id IN(".$row->ids.")");
					// $arr = explode(",",$row->ids);
					// $count = count($dataa);
					// foreach($arr as $id){
					// 	for($i=0;$i<$count;$i++){
					// 		$dataa[$i]['user_info_id'] = $id;
					// 		$dataa_d[$i]['user_info_id'] = $id;
					// 	}
					// 	if(!empty($dataa)){
					// 		$this->db->insert_batch('users_right', $dataa);
					// 	}
					// 	if(!empty($dataa_d)){
							
					// 		//$this->db->insert_batch('users_right_details', $dataa_d);
					// 	}
					// }

				}
			}
			$data2 = $this->user_model->user_activities(45,'',$wg_id,'user_group','Set User Group Right','',$this->session->userdata['ast_user']['user_id'],'');
			return 1;

	}
	function set_default_group_rights($id,$gid)
	{
		$str = "SELECT DISTINCT menu_link_id from user_group_right where user_group_id IN(".$gid.")";
		$query = $this->db->query($str);
		$result =$query->result();
		$str1 = "SELECT DISTINCT menu_link_id,menu_link_details_id from user_group_right_details where user_group_id IN(".$gid.")";
		$query1 = $this->db->query($str1);
		$result1 = $query1->result();
	
		
		
		$data = array();
		$data1 = array();
		$data2 = array();
		$data3 = array();
		$data4 = array();
		$data5 = array();

		if(count($result)>0)
		{
			foreach($result as $row)
			{
				$data[] = array(
							'user_info_id' => $id,
							'menu_link_id' => $row->menu_link_id,
							'entry_by' => $this->session->userdata['ast_user']['user_id'],
							'entry_datetime' => date('Y-m-d H:i:s')
						);
			}
			if(!empty($data)){
			$this->db->insert_batch('users_right', $data);
			}
			foreach($result1 as $row1)
			{
				$data1[] = array(
								'user_info_id' => $id,
								'menu_link_id' => $row1->menu_link_id,
								'menu_link_details_id' => $row1->menu_link_details_id,
								'entry_by' => $this->session->userdata['ast_user']['user_id'],
								'entry_datetime' => date('Y-m-d H:i:s')
							);
			}
			
			if(!empty($data1)){
			$this->db->insert_batch('users_right_details', $data1); 
			}
			return 'success';
		}else{
			return 'No group rights found';
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
				       gr.menu_name GROUP_NAME
				  FROM (SELECT menu_link_id
				          FROM users_right
				         WHERE user_info_id = '".$this->session->userdata['ast_user']['user_id']."') s1
				                left outer join menu_link tr on(tr.id=s1.menu_link_id)
				                left outer join menu_category cat on(cat.id=tr.menu_cate_id)
				                left outer join menu_group gr on(gr.id=tr.menu_group_id)
				                where cat.data_status='1' and gr.data_status='1' and tr.data_status='1'
                order by tr.menu_group_id,tr.menu_cate_id

				";
		}else if($sts==1){
		$str = "select tr.*,tr.menu_link_name right_name,tr.menu_cate_id categ_id, tr.menu_group_id group_id,
				cat.menu_cate_name categ_name,gr.menu_name GROUP_NAME from menu_link tr
				left outer join menu_category cat on(cat.id=tr.menu_cate_id)
				left outer join menu_group gr on(gr.id=tr.menu_group_id)
				where cat.data_status='1' and gr.data_status='1' and tr.data_status='1'
				order by tr.menu_group_id,tr.menu_cate_id";
		}

		$query=$this->db->query($str);
		// echo $this->db->last_query();exit;
		return $query->result_array();
	}
	function get_working_group_rights_old($Id=NULL){
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