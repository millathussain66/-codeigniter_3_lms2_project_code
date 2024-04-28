<?php
class user_info_model extends CI_Model {

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
				if($filterdatafield=='territory_name')
				{
					$filterdatafield='j3.name';
				}				
				else if($filterdatafield=='department_name')
				{
					$filterdatafield='j7.name';
				}
				else{$filterdatafield='j0.'.$filterdatafield;}
				
				
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
			$sortdatafield="j0.ID";
			$sortorder = "DESC";				
		}
		
		$admin_on_off='';
		if($this->session->userdata['ast_user']['user_system_admin_sts']!=2){
			$admin_on_off=" and j0.admin_status in (0,1)";
		}

		$this->db
			->select("SQL_CALC_FOUND_ROWS j0.lock_status,
			 j0.block_status,
			 j0.block_status AS unblock_status,
			 j0.id,
			 j0.entry_by,
			 j0.user_group_id,
			 j0.user_id,
			 j0.password_change_status,
			 j0.pin,
			 j0.name,
			 j0.user_address,
			 j0.mobile_number,
			 j0.email_address,
			 j0.verify_status,
			 j0.admin_status,
			 j0.send_to_checker,
			 j0.data_status,
			 j3.name AS territory_name,
			 j7.name AS department_name
			 ", FALSE)
			->from('users_info as j0')
			->join("ref_territory as j3", "j0.recovery_territory=j3.id", "left")
			->join("ref_department as j7", "j0.department_id=j7.id", "left")
			->where("j0.data_status=1 ".$admin_on_off." ", NULL, FALSE)
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

	function duplicate_name($field,$val,$edit_id=NULL)
	{
		$where="";
		if($field!="user_id"){
			$where.=" block_status=0 AND ";
		}
		$where.=" data_status=1 and (upper(".$field.")='".strtoupper($val)."')";
		if($edit_id!=''){$where.=" and id!='".$edit_id."'";}
		$this->db->where($where, NULL, FALSE);
		$this->db->from('users_info');
		$q=$this->db->get();
		// echo $this->db->last_query();exit;
		return $q->num_rows();
	}
	function get_verify_action_data($id,$v_sts)
	{
		$table_name="users_info";
		$ROW_ID="id";
		if($v_sts==2){
			$table_name="users_info_queue";
			$ROW_ID="row_id";
		}
		$str=" SELECT  j0.lock_status,j0.".$ROW_ID." as ID,
             j0.block_status,
             j0.block_status AS unblock_status,
             j0.user_group_id,
             j0.user_id,j0.picture,j0.signature,j0.remarks,j0.pin,j0.entry_by,
             j0.name,
             j0.user_address,
			 j0.verify_status,
			 j0.admin_status,
			 j0.send_to_checker,
			 j0.data_status,
			 j0.location,
			 j0.legal_region,
			 j0.legal_district,
			 j0.recovery_region,
			 j0.recovery_territory,
			 j0.recovery_unit_office,
			 j0.recovery_district,
			 j0.free_field_1,
			 j0.free_field_2,
			 j0.send_email_credential,
             j0.mobile_number,j0.entry_datetime,
             j0.email_address,
			 j0.last_modified_datetime,
			 j0.block_datetime,
			 j0.unblock_datetime,
             d.name AS designation_name,
             dept.name AS department_name,
			 fd.name AS functional_designation_name,
			 f3.name AS free_field_3_name,
			 f4.name AS free_field_4_name,
			 j2.name AS entry_by,
			 j3.name AS last_modified_by,
			 j4.name AS unblock_by,
			 j5.name AS block_by
        FROM ".$table_name." j0
             LEFT JOIN ref_designation d
                ON (j0.designation_id = d.id)
				LEFT JOIN users_info j2
                ON (j0.entry_by = j2.id)
				LEFT JOIN users_info j3
                ON (j0.last_modified_by = j3.id)
					LEFT JOIN users_info j4
                ON (j0.unblock_by = j4.id)
					LEFT JOIN users_info j5
                ON (j0.block_by = j5.id)
             LEFT JOIN ref_department dept
                ON (j0.department_id = dept.ID)
			LEFT JOIN ref_functional_designation fd
                ON (j0.functional_designation_id = fd.id)
			LEFT JOIN ref_user_free_field_3 f3
                ON (j0.free_field_3_id = f3.ID)
			LEFT JOIN ref_user_free_field_4 f4
                ON (j0.free_field_4_id = f4.ID)
			WHERE j0.data_status = '1'  AND j0.".$ROW_ID."= ".$id."  AND j0.verify_status=".$v_sts." ORDER BY j0.id DESC  LIMIT 1";

		$q=$this->db->query($str);
		return  $q->row();
	}
	
	function get_unit_data($ids)
	{
		if($ids==''){$ids='0';}	
		$str=" SELECT GROUP_CONCAT(CONCAT(u.name,' (',u.code,')')  order by u.name SEPARATOR '<br> ') AS ops_unit_office  FROM ref_unit_office  u 
		WHERE u.id IN (".$ids.")
";
		$q=$this->db->query($str); 
		return  $q->row();
		
	}
	function get_dist_data($ids)
	{
		if($ids==''){$ids='0';}	
		$str=" SELECT GROUP_CONCAT(u.name  order by u.name SEPARATOR '<br> ') AS ops_dist  FROM ref_legal_district  u 
		WHERE u.id IN (".$ids.")";
		$q=$this->db->query($str); 
		return  $q->row();
		
	}
	function get_multiselectdata($table_name,$ids,$column_name)
	{
		if($ids==''){$ids='0';}	
		$str=" SELECT GROUP_CONCAT(u.$column_name  order by u.$column_name SEPARATOR '<br> ') AS multi_name  FROM $table_name  u 
		WHERE u.id IN (".$ids.")";
		$q=$this->db->query($str); 
		return  $q->row();
		
	}
	function get_multiselectdata_comma($table_name,$ids,$column_name)
	{
		if($ids==''){$ids='0';}	
		$str=" SELECT GROUP_CONCAT(u.$column_name  order by u.$column_name SEPARATOR ',') AS multi_name  FROM $table_name  u 
		WHERE u.id IN (".$ids.")";
		$q=$this->db->query($str); 
		return  $q->row();
		
	}
	function get_month_data($ids)
	{
		if($ids==''){$ids='0';}	
		$str=" SELECT GROUP_CONCAT(u.name  order by u.id SEPARATOR ',') AS ops_month  FROM ref_billing_month  u 
		WHERE u.id IN (".$ids.")
";
		$q=$this->db->query($str); 
		return  $q->row();
		
	}
	function get_emp_type_data($ids)
	{
		if($ids==''){$ids='0';}	
		$str=" SELECT GROUP_CONCAT(u.name  order by u.id SEPARATOR ',') AS ops_emp_type  FROM ref_employee_type  u 
		WHERE u.id IN (".$ids.")
";
		$q=$this->db->query($str); 
		return  $q->row();
		
	}
	function get_paper_data($ids)
	{
		if($ids==''){$ids='0';}	
		$str=" SELECT GROUP_CONCAT(u.name  order by u.name SEPARATOR '<br> ') AS paper_name  FROM ref_paper  u 
		WHERE u.id IN (".$ids.")
";
		$q=$this->db->query($str); 
		return  $q->row();
		
	}
	
	function get_add_action_data($id)
	{
		$str=" SELECT  j0.lock_status,
             j0.block_status,
             j0.block_status AS unblock_status,
             j0.id,
			 	 j0.password_change_status,
             j0.user_group_id,
             j0.recovery_makers,
             j0.legal_makers,
             j0.recovery_region,
             j0.recovery_territory,
             j0.recovery_district,
             j0.recovery_unit_office,
             j0.legal_region,
             j0.legal_district,
             j0.user_id,j0.picture,j0.remarks,j0.pin,
             j0.name, j0.entry_by,
             j0.user_address,
			 j0.verify_status,
			 j0.admin_status,
			 j0.send_to_checker,
			 j0.data_status,
             j0.location,
			 j0.send_email_credential,
             j0.mobile_number,j0.entry_datetime,
             j0.email_address,
			 j0.free_field_1,
			 j0.free_field_2,
			 DATE_FORMAT(j0.entry_datetime,'%d-%b-%y %h:%i %p') AS e_dt,
			 DATE_FORMAT(j0.last_modified_datetime,'%d-%b-%y %h:%i %p') AS u_dt,
			 DATE_FORMAT(j0.unblock_datetime,'%d-%b-%y %h:%i %p') AS ac_dt,
			 j2.name AS entry_by,
			 j3.name AS last_modified_by,
			 j4.name AS unblock_by,
			 j5.name AS block_by,
			 j0.last_modified_datetime,
             d.name AS designation_name,
             dept.name AS department_name,
			 fd.name AS functional_designation_name,
			 f3.name AS free_field_3_name,
			 f4.NAME AS free_field_4_name
        FROM users_info j0
             LEFT JOIN user_group j1
                ON (j0.user_group_id = j1.id)
             LEFT JOIN ref_designation d
                ON (j0.designation_id = d.id)
             LEFT JOIN ref_department dept
                ON (j0.department_id = dept.id)
			LEFT JOIN ref_functional_designation fd
                ON (j0.functional_designation_id = fd.id)
			LEFT JOIN ref_user_free_field_3 f3
                ON (j0.free_field_3_id = f3.id)
			LEFT JOIN ref_user_free_field_4 f4
                ON (j0.free_field_4_id = f4.id)
             LEFT JOIN users_info j2
                ON (j0.entry_by = j2.id)
             LEFT JOIN users_info j4
                ON (j0.unblock_by = j4.id)
					LEFT JOIN users_info j5
                ON (j0.block_by = j5.id)
             LEFT JOIN users_info j3
                ON (j0.last_modified_by = j3.id)
			   WHERE j0.data_status = '1'  AND j0.id= ".$id." LIMIT 1";
		$q=$this->db->query($str);

		return  $q->row();
	}

	function get_checker_data($menu_link,$user_group_id=NULL,$condition=NULL){
		if ($user_group_id!=NULL) {
			$where=user_group_condition_maker($user_group_id,'users_info.user_group_id')." AND ";
		}else{$where="1 AND ";}
		if ($condition!=NULL) {
			$where.=$condition." AND ";
		}
		$str="SELECT users_info.id,users_info.name,users_info.pin,users_info.recovery_makers,user_id FROM users_info 
		LEFT OUTER JOIN users_right ON users_info.id=users_right.user_info_id
		WHERE ".$where." users_info.verify_status = '0' 
			AND users_info.block_status = '0'
			AND users_info.admin_status <> '2' AND users_right.menu_link_id=".$menu_link." ";
		$q=$this->db->query($str);

		return  $q->result();
	}
	function get_user_data($user_group_id=NULL,$condition=NULL){
		if ($user_group_id!=NULL) {
			$where=user_group_condition_maker($user_group_id,'users_info.user_group_id')." AND ";
		}else{$where="1 AND ";}

		if ($condition!=NULL) {
			$where.=$condition." AND ";
		}
		$str="SELECT users_info.id,users_info.name,users_info.pin,user_id,users_info.legal_region,users_info.recovery_territory,users_info.legal_district,users_info.recovery_unit_office FROM users_info
		WHERE ".$where." users_info.verify_status = '0' 
			AND users_info.block_status = '0'
			AND users_info.admin_status <> '2'";
		$q=$this->db->query($str);

		return  $q->result();
	}
 	function sendToChecker($send_to) {

        $employee_ID = $this->input->post('sendToCheckerIndexId');

        $data = array();              
        
            $data['send_to_checker'] = '1';
            $data['send_to_checker_date'] = date('Y-m-d H:i:s');
            $data['maker'] = $this->session->userdata['ast_user']['user_id'];
            $data['checker_id'] = $this->input->post('checker_to_notify');
			$notification=0;
			if($this->input->post('email_notification')=="email" ){
				$notification=1;
			}			
			
            $data['notify_by'] = $notification;
			//echo $notification;exit;
            $this->db->where('send_to_checker',null);
       
        
        $this->db->where('user_id', $employee_ID);
        $this->db->update('users_info', $data);
        /*if ($this->db->affected_rows() > 0 && $send_to == 'toMaker') 
		{
            if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'email')
			{
				$str="SELECT  j0.checker_id,j0.verify_status,j0.user_id,j0.name,j1.name AS Designation
							 FROM users_info j0
							 LEFT OUTER JOIN ref_designation j1 ON j1.id=j0.designation_id
						 WHERE j0.data_status = '1'  AND j0.user_id= '".$this->input->post('sendToCheckerIndexId')."' LIMIT 1";
						 
				$application_data=$this->db->query($str)->row();

                $maker_id = $application_data->checker_id;
              
				$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker_id."' LIMIT 1";
				$maker_info=$this->db->query($str1)->row();
				
                if (!empty($maker_info->email_address) && $maker_info->email_address != null) {
                   $subject="Request for Approval";
				   $req_type="";
				   if($application_data->verify_status==1){
					   $req_type.=" User Creation";
				   }
				   else if($application_data->verify_status==2 || $application_data->verify_status==8){
					   $req_type.=" User Profile Modification";
				   }
				   else if($application_data->verify_status==3){
					   $req_type.=" User Profile Deletion";
				   }
				   else if($application_data->verify_status==6){
					   $req_type.=" User Profile Deactivation";
				   }
				   else if($application_data->verify_status==7 || $application_data->verify_status==5){
					   $req_type.=" User Profile Activation";
				   }
				   else if($application_data->verify_status==4){
					   $req_type.=" User Pasword Reset";
				   }
				   $subject.="[".$req_type."] ";//(".date('l, M d, Y h:i:s A').')';
				   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
				    A request is waiting for your approval.<br/><br/>
					Request Type: ".$req_type."<br/>
					Request by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), ".$this->session->userdata['ast_user']['user_designation']." <br/>
					Request Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/>
					Request for: ".$application_data->name." (".$application_data->user_id."), ".$application_data->Designation."<br/><br/>
					Please login to  <a href=".base_url().">LMS Application</a>  to approve the request.<br/><br/> 
					This is a system generated email, no need to reply.<br/><br/>  
					Thanks</div>";
					$cc = '';
					$m=$this->User_model->send_email("", "", $maker_info->email_address, $cc, $subject,$message);
					
					//echo $m;exit;
                }
            }
         
        } */
		
		
			
			$data2 = $this->User_model->user_activities(37, '', 0, 'users_info', 'Send to checker ('.$employee_ID.')','', $this->session->userdata['ast_user']['user_id'],$this->input->post('sendToCheckerIndexId'));
			
			
    }
	function get_initial_action_data_by_employee_id($emplyeeid)
	{
		$str=" SELECT  j0.lock_status,j0.id as id,
             j0.block_status,
             j0.block_status AS unblock_status,
             j0.id,
             j0.user_group_id,
             j0.user_id,j0.picture,j0.pin,
			 j0.remarks,
             j0.name,
             j0.user_address,
             j0.location,
             j0.mobile_number,j0.entry_datetime,
             j0.email_address,
			 j0.send_email_credential,
			 j0.last_modified_datetime,
			 j0.free_field_1,
			 j0.free_field_2,
             j1.group_name AS group_name,
             d.name AS designation_name,
             dept.name AS department_name,
			 fd.name AS functional_designation_name,
			 f3.NAME AS free_field_3_name,
			 f4.NAME AS free_field_4_name
        FROM users_info j0
             LEFT JOIN user_group j1
                ON (j0.user_group_id = j1.id)
             LEFT JOIN ref_designation d
                ON (j0.designation_id = d.id)
			LEFT JOIN ref_functional_designation fd
                ON (j0.functional_designation_id = fd.id)
			LEFT JOIN ref_user_free_field_3 f3
                ON (j0.free_field_3_id = f3.id)
			LEFT JOIN ref_user_free_field_4 f4
                ON (j0.free_field_4_id = f4.id)
             LEFT JOIN ref_department dept
                ON (j0.department_id = dept.id)
			 WHERE j0.data_status = '1'  AND j0.user_id= '".$emplyeeid."' LIMIT 1";
		$q=$this->db->query($str);

		return  $q->row();
	}
	
	function deactivate_mail($email,$employee_ID,$name,$type_txt)
	{
		$ContactPerson = "LMS";
		$admineMail = '';
		if($type_txt==5){ $tp='Unlocked';}
		if($type_txt==7){ $tp='Activated';}
		$subject=$tp." User Id [".$employee_ID."] at LMS";
		$msg="Dear ".$name." ,<br><br>Your User Id have been ".$type_txt." at LMS";
		

		$msg.="<br><br>Click on the link to login now <a href='".base_url()."'>".base_url()."</a>
		<br/><br/>
		This is a system generated email, no need to reply.<br/><br/>  
		Thanks";

		if($email!="")
		{
			$cc='';
			$m=$this->User_model->send_email("", "", $email, $cc, $subject,$msg);
		}
	}
 	function send_email($fromEmail,$fromName, $toemail, $subject,$message)
	{
		$cc='';
		$m=$this->User_model->send_email("", "", $toemail, $cc, $subject,$message);

	 }
	
	
	function file_upload($input_name=NULL,$file=NULL)
	{
		
		$image = $_FILES[$input_name]['name'];
		$file_Size = $_FILES[$input_name]['size'];
			if ($image)
			{	
				$filename = stripslashes($_FILES[$input_name]['name']);
				$i = strrpos($filename,".");
				if (!$i) {$text[]="Unknown Extention";}
				$l = strlen($filename) - $i;
				$extension = substr($filename,$i+1,$l);				
				$extension = strtolower($extension);					
				$file_name_new='user_'.$this->session->userdata['ast_user']['user_id'].'_'.rand().'.'.$extension;								
			}
			if($file_name_new!='' && $image==true)
			{
				if(($file_Size >0))
				{
						$copied = copy($_FILES[$input_name]['tmp_name'], 'user_profile_images/'.$file_name_new);
						//if($_POST['hidden_'.$input_name]!=''){unlink("user_profile_images/".$_POST['hidden_'.$input_name]);}				
				}
				else{ 
						$text[]="Unknown Attached documents (AF) Extention";
				}
			}
		return  $file_name_new;
	}
	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		$this->db->trans_begin();
		if(isset($_FILES['picture']['name']))
		{				
			$picture = $this->file_upload('picture',$this->input->post('picture'));																		
		}
		else
		{
			if (isset($_POST['hidden_picture'])) {
				$picture = $_POST['hidden_picture'];
			}
			else
			{
				$picture='';	
			}
		}
		if(isset($_FILES['signature']['name']))
		{				
			$signature = $this->file_upload('signature',$this->input->post('signature'));																		
		}
		else
		{
			if (isset($_POST['hidden_signature'])) {
				$signature = $_POST['hidden_signature'];
			}
			else
			{
				$signature='';	
			}
		}
		
		$inpt_user_id=$this->user_model->clean_input_search_data($this->input->post('employee_ID'));
		$data = array(
					'user_id' => $this->security->xss_clean($inpt_user_id),
					'pin' => $this->security->xss_clean( $this->input->post('pin')),
					'name' => $this->security->xss_clean(ucwords($this->input->post('name'))),
					'user_group_id' =>$this->security->xss_clean( $this->input->post('work_group_id')),
					'legal_region' =>$this->security->xss_clean( $this->input->post('legal_region')),
					'legal_district' =>$this->security->xss_clean( $this->input->post('legal_district')),
					'recovery_region' =>$this->security->xss_clean( $this->input->post('recovery_region')),
					'recovery_territory' =>$this->security->xss_clean( $this->input->post('recovery_territory')),
					'recovery_district' =>$this->security->xss_clean( $this->input->post('recovery_district')),
					'recovery_unit_office' =>$this->security->xss_clean( $this->input->post('recovery_unit_office')),
					'recovery_makers' =>$this->security->xss_clean( $this->input->post('recovery_makers')),
					'legal_makers' =>$this->security->xss_clean( $this->input->post('legal_makers')),
					'designation_id' => $this->security->xss_clean($this->input->post('designation_id')),
					'department_id' => $this->security->xss_clean($this->input->post('department_id')),
					'bank_ac' => $this->security->xss_clean($this->input->post('bank_ac')),
					'mobile_number' => $this->security->xss_clean($this->input->post('mobile_number')),
					'email_address' => $this->security->xss_clean($this->input->post('email_address')),
					'picture' =>$picture,
					'signature' =>$signature,
					'remarks' => $this->security->xss_clean($this->input->post('remarks')),
					'location' => $this->security->xss_clean($this->input->post('location')),
					'functional_designation_id' => $this->security->xss_clean($this->input->post('fun_designation_id')),
					'send_email_credential' => $this->security->xss_clean($this->input->post('acceptterms')),
					'free_field_1' => $this->security->xss_clean($this->input->post('Free_Field_1')),
					'free_field_2' => $this->security->xss_clean($this->input->post('Free_Field_2')),
					'free_field_3_id' => $this->security->xss_clean($this->input->post('Free_Field_3')),
					'free_field_4_id' => $this->security->xss_clean($this->input->post('Free_Field_4'))
				);
				
		if($add_edit=="add")
		{
			$sys_config=$this->upr_config_row();
			$pass = $this->security->xss_clean($this->input->post('pass'));
			$pass2 = $this->User_model->encrypt($pass); 
			$_dbTable = 'users_info';
			
			$data['password_log'] = $pass2;
			
			$data['password_change_status'] = 0;
			$data['password_expiry_date'] = $sys_config->expiry_dt;
			$data['SESSION_idle_time'] = $sys_config->global_session_time;
			$data['global_session_time'] = $sys_config->global_session_time;
			$data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
			$data['entry_datetime'] = date('Y-m-d H:i:s');
			$data['verify_status'] = 1;
						
			$this->db->insert('users_info', $data);
			$insert_idss = $this->db->insert_id();
			$data['row_id'] = $insert_idss;
			$this->db->insert('users_info_queue', $data);
			$logdata = array(
							'user_id' => $insert_idss,
							'change_by' => $this->session->userdata['ast_user']['user_id'],
							'change_datetime' => date("Y-m-d H:i:s"),
							'password' => $pass2
					   );
			$logquery = $this->db->insert('user_password_change_history',$logdata);
			
			$data2 = $this->user_model->user_activities(39,'',$insert_idss,'users_info','Add User','', $this->session->userdata['ast_user']['user_id'],$this->security->xss_clean($inpt_user_id));
			
		}
		else
		{
			//Changes by Enayet 2022/03/06
			//For group change action
			$group_id = $this->security->xss_clean($this->input->post('work_group_id'));
			 $str="SELECT  j0.user_group_id
		                         FROM users_info j0
		                     WHERE j0.data_status= '1' AND j0.id='".$edit_id."' LIMIT 1";
		            $user_data=$this->db->query($str)->row();
		   if($group_id!=$user_data->user_group_id)
		   {
		   	$this->db->query("DELETE FROM users_right WHERE user_info_id IN(".$edit_id.")");
				$this->db->query("DELETE FROM users_right_details WHERE user_info_id IN(".$edit_id.")");	
				$this->set_default_group_rights($edit_id,$group_id);
		   }
			$data['last_modified_by'] = $this->session->userdata['ast_user']['user_id'];
			
			
			$data['last_modified_datetime'] = date('Y-m-d H:i:s');
			
			$this->db->where('id', $edit_id);
			$this->db->update('users_info', $data);
			
			$insert_idss = $edit_id;
			$data2 = $this->user_model->user_activities(35,'',$insert_idss,'users_info','Edit User','',$this->session->userdata['ast_user']['user_id'],$this->security->xss_clean($inpt_user_id));
			

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
			
			
			$data2 = $this->User_model->user_activities(46, '', $this->session->userdata['ast_user']['user_id'], 'users_info', 'Set Default User Privilege','', $this->session->userdata['ast_user']['user_id'],'');
			
			return 'success';
		}else{
			return 'No group rights found';
		}
	}

	function randomPassword()
	{
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i <= 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
	function get_admin_sts($edit_id=NULL)
	{
		if($edit_id!=NULL)
		{
			$sql="SELECT  DISTINCT j0.admin_status	FROM users_info j0 WHERE j0.id='".$edit_id."' LIMIT 1";
			$q=$this->db->query($sql);
			$s= $q->row();
			return $s->admin_status;
		}
	}
	function delete_action()
	{
		$ary=explode(',',$this->input->post('deleteEventId'));
		for($k=0; $k<count($ary); $k++)
		{
			if($this->input->post('type')=='delete'){
				$data = array('verify_status' => 3);
				$this->db->where('id', $ary[$k]);
				$this->db->where('id!=1',NULL, FALSE);
				$this->db->update('users_info', $data);

				if($ary[$k]!=1){

					$this->db
					->select("user_id", FALSE)
					->from('users_info');
					$this->db->where(" id='".$ary[$k]."' ", NULL, FALSE);
					$q=$this->db->get()->row();

					$data2 = $this->User_model->user_activities(15, '', $ary[$k], 'users_info', 'Delete User Id','', $this->session->userdata['ast_user']['user_id'],'');
					
				}
			}
		}
	}
	
	function reset_pass()
	{
		$this->db->trans_begin();
		$verifyEventId=$this->security->xss_clean($this->input->post('verifyEventId'));
		if($this->input->post('verify_type')=='Unlock'){
			
			$pass="";
			$data = array(
				//'verify_status' => '5'
				'lock_status' => '0'
			);
			$this->db->where('id', $verifyEventId);
			$this->db->update('users_info', $data);		
				
			//$this->db->set('lock_status', '0');		
			//$this->db->where('row_id', $this->input->post('verifyEventId'));
			//$this->db->update('users_info_queue', $data);

	
			$data2 = $this->user_model->user_activities(48,'',$verifyEventId,'users_info','Unlock Wrong Password Lock','', $this->session->userdata['ast_user']['user_id'],'');
		}

		else if($this->input->post('verify_type')=='Block'){
			$pass="";
			$data = array(
				'block_by' =>$this->session->userdata['ast_user']['user_id'],
				//'verify_status'=>6
				'block_status' => '1'
			);
			
			$this->db->set('block_datetime',date('Y-m-d H:i:s'));
			$this->db->where('id', $verifyEventId);
			$this->db->update('users_info', $data);
			
			//$this->db->set('block_status', '1');
			//$this->db->where('row_id', $this->input->post('verifyEventId'));
			//$this->db->update('users_info_queue', $data);
			
			$act_dec_Remarks=$this->security->xss_clean($this->input->post('act_dec_Remarks'));
			
			
			$data2 = $this->user_model->user_activities(49,'',$verifyEventId,'users_info','Deactivate User Id',$act_dec_Remarks, $this->session->userdata['ast_user']['user_id'],'');
			
		}

		else if($this->input->post('verify_type')=='UNBLOCK'){
			$pass="";
				$data = array(
				'unblock_by' =>$this->session->userdata['ast_user']['user_id'],
				//'verify_status'=>7
				'block_status' => '0'
			);
		
			$this->db->set('unblock_datetime',date('Y-m-d H:i:s'));
			
			$this->db->where('id', $verifyEventId);
			$this->db->update('users_info', $data);
			
			//$this->db->set('block_status', '0');
			//$this->db->where('row_id', $this->input->post('verifyEventId'));
			//$this->db->update('users_info_queue', $data);
			
			$act_dec_Remarks=$this->security->xss_clean($this->input->post('act_dec_Remarks'));
			$data2 = $this->user_model->user_activities(50,'',$verifyEventId,'users_info','Activate User Id',$act_dec_Remarks, $this->session->userdata['ast_user']['user_id'],'');
		}
		else if($this->input->post('verify_type')=='Delete Entry'){
			//$data['LAST_MODIFIED_BY']=$this->session->userdata['ast_user']['user_id'];
			$data = array(
				'verify_status' => '3',
				'delete_by' =>$this->session->userdata['ast_user']['user_id']
			);
			$this->db->set('delete_datetime',date('Y-m-d H:i:s'));
			$this->db->where('id', $this->input->post('verifyEventId'));
			$this->db->update('users_info', $data);
			
			$this->db->set('data_status','0');
			$this->db->where('row_id', $this->input->post('verifyEventId'));
			$this->db->update('users_info_queue', $data);
		}
		else if($this->input->post('verify_type')=='Approve'){				
				$pass='';	
				 if($this->input->post('v_sts')=='2'){				
					$data = array('data_status'=>1 ,
								  'verify_status' =>0,
								   'send_to_checker'=>null
									  );
				 }else  if($this->input->post('v_sts')=='3'){
					 $data = array(	'data_status'=>0 ,
					             // 'is_delete'=>1,
								  'delete_by'=> $this->session->userdata['ast_user']['user_id'] ,
					              'delete_datetime'=> date('Y-m-d H:i:s'),
								  'verify_status' =>0,
								  'send_to_checker'=>null
									  );
				 }
				 else  if($this->input->post('v_sts')=='4'){
					 $data = array(	'data_status'=>1,
								  'verify_status' =>0,
								  'send_to_checker'=>null
									  );
				 }
				 else  if($this->input->post('v_sts')=='5'){
					 $data = array(	'data_status'=>1,
								  'verify_status' =>0,
								  'lock_status'=>0,
								  'send_to_checker'=>null
									  );
				 }
				 else  if($this->input->post('v_sts')=='6'){
					 $data = array(	'data_status'=>1,
								  'verify_status' =>0,
								  'block_status'=>1,
								  'send_to_checker'=>null
									  );
				 }
				 else  if($this->input->post('v_sts')=='7'){
					 $data = array(	'data_status'=>1,
								  'verify_status' =>0,
								  'block_status'=>0,
								  'send_to_checker'=>null
									  );
				 }
				 else{
					 $data = array(	'data_status'=>1 ,
								  'verify_status' =>0,
								   'send_to_checker'=>null
									  );
				 }
				 $data['verify_by']=$this->session->userdata['ast_user']['user_id'];
				 $data['verify_datetime']=date('Y-m-d H:i:s');
				 
				$this->db->where('id', $verifyEventId);
				$this->db->where('verify_status', 1);
				$this->db->update('users_info', $data);
				
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					return 00;
				}
				
               if($this->input->post('v_sts') =='2'){	
				   $qry_inp =  'SELECT user_id,pin,name,user_group_id,designation_id,department_id,mobile_number,
				   region,territory,district,unit_office,
				   email_address,picture,signature,admin_status,user_address,remarks,location,functional_designation_id,send_email_credential,
				   free_field_1,free_field_2,free_field_3_id,free_field_4_id from users_info_queue 
				   WHERE row_id='.$this->input->post('verifyEventId').' AND data_status=1 AND verify_status=2';
				  $select = $this->db->query($qry_inp); 
					if($select->num_rows())
					{
						
						$previous_group_id = $this->db->query("SELECT user_group_id FROM users_info WHERE id=".$this->input->post('verifyEventId'))->row()->user_group_id;
						if($previous_group_id!= $select->row()->user_group_id)
						{
							$this->db->query("DELETE FROM users_right WHERE user_info_id IN(".$this->input->post('verifyEventId').")");
							$this->db->query("DELETE FROM users_right_details WHERE user_info_id IN(".$this->input->post('verifyEventId').")");
							
							$this->set_default_group_rights($this->input->post('verifyEventId'),$select->row()->user_group_id);
							
						}
						
						$this->db->where('id', $this->input->post('verifyEventId'));
						$this->db->update('users_info', $select->row());
					}
			   }
			  else if($this->input->post('v_sts') =='1'){	
				   $qry_inp =  'SELECT qq.user_id,qq.pin, qq.name, qq.email_address,qq.send_email_credential, qq.free_field_1, qq.free_field_2, qq.free_field_3_id, qq.free_field_4_id,ref_designation.name AS designation , mkid.name as mk_name, mkid.mobile_number as mk_mobile_number, mkid.email_address as mk_email_address 
				   from users_info_queue qq
                   LEFT OUTER JOIN ref_designation ON (qq.designation_id=ref_designation.id)
				   LEFT OUTER JOIN users_info mkid ON (qq.entry_by=mkid.id)
				   WHERE qq.row_id='.$verifyEventId.' AND qq.data_status=1 AND qq.verify_status=1';
				  $select = $this->db->query($qry_inp); 
				  $row_g = $select->row(); 
				  $sys_config=$this->upr_config_row();
				//  $pass='000';
				 // if($sys_config->default_password_type=='Custom'){ $pass=$sys_config->default_password;}
				 //$pass='Please contact the person below for the password: <br>Name:'.$row_g->mk_name.'<br>Phone:'.$row_g->mk_mobile_number.'<br>Email:'.$row_g->mk_email_address;
				  $pass='Already created your LMS user profile ('.$select->row()->pin.'). Please contact with IT- Access Control Management for password';
					if($select->num_rows())
					{
						//if($select->row()->send_email_credential==1)
						//{
							$this->login_mail($select->row()->email_address,$select->row()->user_id,$pass,$select->row()->name,$select->row()->designation);
						//}
					}
			   }
			  
			   else if($this->input->post('v_sts') =='5' || $this->input->post('v_sts') =='7'){				  
				  if($this->input->post('v_sts') =='7'){
					  $qry_inp =  'SELECT block_status,unblock_by,unblock_datetime from users_info_queue WHERE row_id='.$this->input->post('verifyEventId').' AND data_status=1 AND verify_status=7';
				  $select = $this->db->query($qry_inp); 
					if($select->num_rows())
					{
						$this->db->where('id', $this->input->post('verifyEventId'));
						$this->db->update('users_info', $select->row());
					} 
				   }
				 
				 $this->db
					->select("user_id,email_address,name", FALSE)
					->from('users_info');
					$this->db->where(" id='".$this->input->post('verifyEventId')."' ", NULL, FALSE);
					$q=$this->db->get()->row();
				if($q->email_address!='')
				{
					$this->deactivate_mail($q->email_address,$q->user_id,$q->name,$this->input->post('v_sts'));
				}

			   }			   
			 
			   else if($this->input->post('v_sts') =='6'){
					  $qry_inp =  'SELECT block_status,block_by,block_datetime from users_info_queue WHERE row_id='.$this->input->post('verifyEventId').' AND data_status=1 AND verify_status=7';
				  $select = $this->db->query($qry_inp); 
					if($select->num_rows())
					{
						$this->db->where('id', $this->input->post('verifyEventId'));
						$this->db->update('users_info', $select->row());
					} 
				   }
				
				
				$data2 = $this->User_model->user_activities(51, '', $this->input->post('verifyEventId'), 'users_info', 'Approve User Id','', $this->session->userdata['ast_user']['user_id'],'');
				
				
		}
		if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
				return 00;
		}
		else
		{
				$this->db->trans_commit();
				return $this->input->post('verifyEventId');
		}
	}
	
	function login_mail($email,$employee_ID,$pass,$name,$designation) 
	{
		$ContactPerson="LMS";
		$admineMail='';
		
		$subject="Your Profile at LMS Application is Successfully Created (".date('l, M d, Y h:i:s A').")";
		$msg="Dear Concern ,<br><br>Your profile at LMS application is successfully created.";
		$msg.="<br><br>Name:&nbsp;&nbsp;";
		$msg.=$name;	
		$msg.="<br><br>Designation:&nbsp;&nbsp;";
		$msg.=$designation;
		$msg.="<br><br>User ID:&nbsp;&nbsp;";
		$msg.=$employee_ID;	
		$msg.="<br><br>Password:&nbsp;&nbsp;";
		$msg.=$pass;	
		$msg.="<br><br>The system redirects you to change the password when you first login. Please change the password accordingly.";
		$msg.="<br><br>Please click here <a href='".base_url()."'>".base_url()."</a> to login. ";
		$msg.="<br><br>This is a system generated email, no need to reply.  ";
		$msg.="<br><br>Thanks";	
		
		if($email!="")
		{
			$this->send_email($ContactPerson,$admineMail,$email,$subject,$msg);
		}
	}
	
	function return_action()
	{
	  if($this->input->post('rType')=="Return")
	  {
		  if($this->input->post('v_sts')==1 || $this->input->post('v_sts')==2 || $this->input->post('v_sts')==8)
		  {
		   $data = array('send_to_checker' => null,'verify_status' => 8,'return_reason'=>$this->input->post('return_reason'));
		   $this->db->where('id', $this->input->post('deleteEventId'));
			$this->db->update('users_info', $data);
			
			
			/*if ($this->db->affected_rows() > 0 )
			{
            if (isset($_POST['email_notification_for_return']) && $this->input->post('email_notification_for_return') == 'email') {
               
				$str=" SELECT j0.maker, j0.email_address,j0.verify_status,j0.entry_by,j0.name,j0.user_id,j0.send_to_checker_date,
				j1.name AS designation FROM users_info j0
				LEFT OUTER JOIN ref_designation j1 ON j1.id=j0.designation_id
				WHERE j0.data_status = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
				
				$application_data = $this->db->query($str)->row();
				$str1=" SELECT j0.name,j0.user_id,j1.name AS designation FROM users_info j0
                  LEFT OUTER JOIN ref_designation j1 ON j1.id=j0.designation_id
				WHERE j0.data_status = '1'  AND j0.id= '".$application_data->maker."' LIMIT 1";
				
				$maker_data = $this->db->query($str1)->row();
                if (!empty($application_data->email_address) && $application_data->email_address != null)
				{
				   $subject = "Return";
				   $req_type="";
				   if($this->input->post('v_sts')==1){
					   $req_type.=" User Creation";
				   }
				   else if($this->input->post('v_sts')==2 || $this->input->post('v_sts')==8){
					   $req_type.=" User Profile Modification";
				   }
				   else if($this->input->post('v_sts')==3){
					   $req_type.=" User Profile Deletion";
				   }
				   else if($this->input->post('v_sts')==6){
					   $req_type.=" User Profile Deactivation";
				   }
				   else if($this->input->post('v_sts')==7 || $this->input->post('v_sts')==5){
					   $req_type.=" User Profile Activation";
				   }
				   else if($this->input->post('v_sts')==4){
					   $req_type.=" User Pasword Reset";
				   }
				   $subject.="[".$req_type."] Request";// (".date('l, M d, Y h:i:s A').')';
				   
				   $message = "Dear Concern, <br/><br/>
								Your request is returned by the approver.<br/><br/> 
								Request Type: ".$req_type."<br/>
								Request by: ".$maker_data->name." (".$maker_data->user_id."), ".$maker_data->designation." <br/>
								Request Date & Time: ".date('l, M d, Y h:i:s A',strtotime($application_data->send_to_checker_date))." <br/><br/>
								Request for: ".$application_data->name." (".$application_data->user_id."), ".$application_data->designation."<br/><br/>
								Returned by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), ".$this->session->userdata['ast_user']['user_designation']." <br/>
								Returned Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/> 
								Return Reason:<br/> 
								".$this->input->post('return_reason').",<br/><br/>

								Please login to  LMS Application  to see the details.<br/><br/> 
								This is a system generated email, no need to reply.<br/><br/> 
								Thanks 
								";
				$cc='';				
				$m=$this->User_model->send_email("", "", $application_data->email_address, $cc, $subject,$message);
				
					
                }
            }
         
        } */
		
	  }
	 
	  }
  	}
  
  	function reject_action()
  	{
	  
	  if($this->input->post('rType')=="Reject")
	  {
		   $data = array('send_to_checker' => null,'verify_status' => 0,'reject_reason' => $this->input->post('reject_reason'));
		   
		   if($this->input->post('v_sts') == 1)
		   {
			   $data['data_status'] = 0;
		   }
		   
		   $this->db->where('id', $this->input->post('deleteEventId'));
		   $this->db->update('users_info', $data);
			
		   $data2 = $this->user_model->user_activities(53,'',$this->input->post('verifyEventId'),'users_info','Reject',$this->input->post('reject_reason'), $this->session->userdata['ast_user']['user_id'],'');
		
		   /*if($this->db->affected_rows() > 0) 
		   {
				if (isset($_POST['email_notification_for_rejection']) && $this->input->post('email_notification_for_rejection') == 'email')
				{
				
					$str = "SELECT 
							j0.maker,
							  j0.email_address,
							  j0.verify_status,
							  j0.entry_by,
							  j0.name,
							  j0.user_id,
							  j0.send_to_checker_date,
							  j1.name AS designation 
							FROM
							  users_info j0 
							  LEFT OUTER JOIN ref_designation j1 
								ON j1.id = j0.designation_id 
							WHERE j0.data_status = '1' 
							  AND j0.id = '".$this->input->post('deleteEventId')."' 
							LIMIT 1";
					
					$application_data = $this->db->query($str)->row();
							//echo $this->db->last_query();   
					$makerstr = "SELECT 
							  j0.name,
							  j0.user_id,
							  j1.name AS designation 
							FROM
							  users_info j0 
							  LEFT OUTER JOIN ref_designation j1 
								ON j1.id = j0.designation_id 
							WHERE j0.data_status = '1' 
							  AND j0.id = '".$application_data->maker."' 
							LIMIT 1";
					
					$maker_data = $this->db->query($makerstr)->row();
					
					if (!empty($application_data->email_address) && $application_data->email_address != null)
					{
					   $subject = "Reject";
					   $req_type="";
					   if($this->input->post('v_sts')==1){
						   $req_type.=" User Creation";
					   }
					   else if($this->input->post('v_sts')==2 || $this->input->post('v_sts')==8){
						   $req_type.=" User Profile Modification";
					   }
					   else if($this->input->post('v_sts')==3){
						   $req_type.=" User Profile Deletion";
					   }
					   else if($this->input->post('v_sts')==6){
						   $req_type.=" User Profile Deactivation";
					   }
					   else if($this->input->post('v_sts')==7 || $this->input->post('v_sts')==5){
						   $req_type.=" User Profile Activation";
					   }
					   else if($this->input->post('v_sts')==4){
						   $req_type.=" User Pasword Reset";
					   }
					   $subject.="[".$req_type."] Request";// (".date('l, M d, Y h:i:s A').')';
					   
					   $message = "Dear Concern, <br/><br/>
									Your request is rejected by the approver.<br/><br/> 
									Request Type: ".$req_type."<br/>
									Request by: ".$maker_data->name." (".$maker_data->user_id."), ".$maker_data->designation." <br/>
									Request Date & Time: ".date('l, M d, Y h:i:s A',strtotime($application_data->send_to_checker_date))." <br/><br/>
									Request for: ".$application_data->name." (".$application_data->user_id."), ".$application_data->designation."<br/><br/>
									Rejected by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), ".$this->session->userdata['ast_user']['user_designation']." <br/>
									Rejected Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/> 
									Reject  Reason:<br/> 
									".$this->input->post('reject_reason').",<br/><br/>
									Please login to  LMS Application  to see the details.<br/><br/> 
									This is a system generated email, no need to reply.<br/><br/> 
									Thanks";
									$cc='';
									$m=$this->User_model->send_email("", "", $application_data->email_address, $cc, $subject,$message);
				
					
					}
				} 
			}*/
		}
	}
	

	function get_info($add_edit,$id)
	{
		if($id!=''){
			$this->db->limit(2);
			$this->db
			->select("SQL_CALC_FOUND_ROWS j0.*", FALSE)
			->from('users_info as j0')
			->where("j0.id= ".$id." ", NULL, FALSE);
		   $data=$this->db->get();
			
			//$data = $this->db->get_where('USERS_INFO', array('ID' => $id));

			return $data->row();
		}else{return array();}
	}

	//set right
	function getUGdateByID($insert_id=NULL)
	{
		$str = "select * from users_info where data_status='1' and id='".$insert_id."'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function total_sys_user_right_category()
	{
		$str = "select * from menu_category where data_status='1' order by menu_cate_name ASC";
		$query=$this->db->query($str);
		return $query->result();
	}
	function userstatusnewold($insert_id=NULL)
	{
		$str = "SELECT * FROM users_right WHERE data_status='1' AND user_info_id='".$insert_id."'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function total_sys_user_right_category_user($insert_id=NULL)
	{
		$str = "SELECT SURC.menu_cate_name as name,SURC.id
				FROM users_right UR
				LEFT OUTER JOIN menu_link SUR ON(UR.menu_link_id=SUR.id)
				LEFT OUTER JOIN menu_category SURC ON(SUR.menu_cate_id=SURC.id)
				WHERE UR.USER_INFO_ID='".$insert_id."' AND UR.data_status='1' AND SUR.data_status='1' AND SURC.data_status='1'
				GROUP BY SURC.id,SURC.menu_cate_name order by SURC.menu_cate_name ASC";
		$query=$this->db->query($str);
		return $query->result();
	}
	function sys_user_order($surcid=NULL)
	{
		$str = "select tr.menu_link_name as rname,tr.id as rid, tcr.*
				from menu_link tr
				left outer join menu_category tcr on (tr.menu_cate_id=tcr.id)
				where tr.menu_cate_id='".$surcid."' and tcr.data_status='1' and tr.data_status='1'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function sys_user_order_user($insert_id=NULL,$cat_id=NULL)
	{
		$str = "SELECT SUR.name as rname,SUR.id as rid, SURC.name as cname,SURC.id
				FROM usr_user_link_right UR
				LEFT OUTER JOIN menu_link SUR ON(UR.sys_link_id=SUR.id)
				LEFT OUTER JOIN sys_link_cat SURC ON(SUR.sys_link_cat_id=SURC.id)
				WHERE UR.user_info_id='".$insert_id."' AND SUR.sys_link_cat_id='".$cat_id."' and UR.sts='1'
				AND SUR.sts='1' AND SURC.sts='1'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function total_cate_right_chak($surcid=NULL,$chake=NULL)
	{
		$str = "select tr.id as srid,tr.name as srname,tcr.name as crname
		from menu_link tr
		left outer join sys_link_cat tcr on(tr.sys_link_cat_id=tcr.id)
		join usr_group_link_right grc on (tr.id=grc.sys_user_rightId )
		where tr.sys_link_cat_id='".$chake."' and tcr.sts='1'
		and tr.sts='1' and grc.Status='1' and grc.user_groupId='".$surcid."'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function sys_user_order_chak($surcid=NULL,$chake=NULL)
	{
		$str = "SELECT * FROM usr_group_link_right where user_groupId ='".$surcid."' AND sys_user_rightId='".$chake."'
		AND Status='1'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function sys_user_order_chak_user($surcid=NULL,$chake=NULL)
	{
		$str = "SELECT * FROM usr_user_link_right WHERE user_info_id ='".$surcid."'
		AND sys_link_id='".$chake."'  AND sts='1'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function delete_user_right_id($surcid=NULL)
	{
		$str = "Delete From users_right WHERE user_info_id ='".$surcid."'";
		$query=$this->db->query($str);
		//echo $this->db->last_query();exit;
		if (!empty($query)){
			return 1;
		}else{return 0;}
	}
	function delete_user_right_id_details($surcid=NULL)
	{
		$str = "Delete From users_right_details WHERE user_info_id ='".$surcid."'";
		$query=$this->db->query($str);
		if (!empty($query)){
			return 1;
		}else{return 0;}		
	}
	function delete_user_reference_right_id($surcid=NULL)
	{
		$str = "Delete From users_right_ref_table WHERE user_info_id ='".$surcid."'";
		$query=$this->db->query($str);
		if (!empty($query)){
			return 1;
		}else{return 0;}		
	}
	function delete_users_right_service_table($surcid=NULL)
	{
		$str = "Delete From users_right_service_table WHERE user_info_id ='".$surcid."'";
		$query=$this->db->query($str);
		if (!empty($query)){
			return 1;
		}else{return 0;}		
	}
	function delete_users_right_maintenance_table($surcid=NULL)
	{
		$str = "Delete From users_right_maintenance_table WHERE user_info_id ='".$surcid."'";
		$query=$this->db->query($str);
		if (!empty($query)){
			return 1;
		}else{return 0;}		
	}
	function old_pass_check($insert_id,$pass)
	{
		$this->db
			->select("*", FALSE)
			->from('users_info')
			->where("data_status='1' and id=".$insert_id." and password_log=".$this->db->escape($pass)." ", NULL, FALSE);
		  $q=$this->db->get();
		  return $q->num_rows();
	}
	function reset_userid_check($insert_id)
	{
		$this->db
			->select("*", FALSE)
			->from('users_info')
			->where("data_status='1' and verify_status='0' and block_status='0' and email_address=".$this->db->escape($insert_id)." ", NULL, FALSE);
		  $q=$this->db->get();
		  //and lock_status='0'
		// echo $this->db->last_query();exit;
		return $q->num_rows();
	}
	function resetpass_userid_check($insert_id)
	{
		//->where("password_change_status='0' and user_id=".$this->db->escape($insert_id)." ", NULL, FALSE);
		$this->db
			->select("*", FALSE)
			->from('users_info')
			->where("user_id=".$this->db->escape($insert_id)." ", NULL, FALSE);
		  $q=$this->db->get();
		// echo $this->db->last_query();exit;
		return $q->num_rows();
		
	}
	function getNextId2($table_name) {

	 $sql="SELECT MAX(id) AS nextid FROM ".strtolower($table_name)." WHERE change_by=".$this->session->userdata['ast_user']['user_id'];
	// echo $sql;exit;
	 $query=$this->db->query($sql)->row();
	  return $query->nextid;
	}

	

	function upr_config_row()
	{
		
		$this->db
			->select("*, DATE_ADD(CURRENT_DATE(), INTERVAL Password_validity_period DAY) expiry_dt", FALSE)
			->from('users_info_config');
		$data = $this->db->get()->row();
		return $data;	

	}


	function set_right_update($wg_id=NULL)
	{
		$quaryReport=$this->User_info_model->delete_user_right_id($wg_id);
		$quaryReport1=$this->User_info_model->delete_user_right_id_details($wg_id);
		
			
		   
		$data=array();
		$data1=array();
		$data2=array();
		$data5=array();
		$data6=array();
		$data7=array();
		$group_counter = $_POST['group_counter'];
		for($i=1;$i<=$group_counter;$i++)
		{
			$categ_counter = $_POST['group'.$i.'categ_counter'];
			for($j=1;$j<=$categ_counter;$j++)
			{
				$input_counter = $_POST['group'.$i.'categ'.$j.'input_counter'];
				for($k=1;$k<=$input_counter;$k++)
				{
					$id = $_POST['group'.$i.'categ'.$j.'id'.$k];
					$checked = isset($_POST['group'.$i.'categ'.$j.'input'.$k]);

					$link_id = $_POST['group'.$i.'categ'.$j.'id'.$k.'details_id'];
					//$link_id_value = isset($_POST['group'.$i.'categ'.$j.'input'.$k.'details_id']);
					$link_details = $_POST['group'.$i.'categ'.$j.'id'.$k.'details_link'];
					//$link_details_value = isset($_POST['group'.$i.'categ'.$j.'input'.$k.'details_link']);
					//echo $link_id.' sss'.$link_details.'aa'.$id;//exit;
					if($checked){

						if(!empty($link_id)){
							//echo "24";
							$link_id_value_arr=explode("###", $link_id);
							$link_details_value_arr=explode("###", $link_details);
							//print_r($link_id_value_arr);exit;
							for($d=0;$d<count($link_id_value_arr);$d++){
								$data1[]=array(
									'menu_link_details_id'=>$link_id_value_arr[$d],
									'url_profix'=>$link_details_value_arr[$d],
									'user_info_id'=>$wg_id,
									'menu_link_id'=>$id,
									'data_status'=>1,
									'entry_by'=>$this->session->userdata['ast_user']['user_id'],
									'entry_datetime'=> date('Y-m-d H:i:s')
								);
							}

						}
					}
					
				
					if($checked)
					{
						$data[]=array(
							'user_info_id'=>$wg_id,
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
			$this->db->insert_batch('users_right', $data);
		}
		if(!empty($data1)){
			$this->db->insert_batch('users_right_details', $data1);
			
		}
		
		
		$common = "select * from menu_link_details where common_status=1";
			$query1=$this->db->query($common);
			$common_query=$query1->result();
			if(!empty($common_query)){
				foreach($common_query as $cc){
					$data2[]=array(
										'menu_link_details_id'=>$cc->id,
										'url_profix'=>$cc->url_profix,
										'user_info_id'=>$wg_id,
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
			if(!empty($admin_query)){
				foreach($admin_query as $add){
					$data2[]=array(
										'menu_link_details_id'=>$add->ID,
										'url_profix'=>$add->url_profix,
										'user_info_id'=>$wg_id,
										'menu_link_id'=>$id,
										'data_status'=>1,
										'entry_by'=>$this->session->userdata['ast_user']['user_id'],
										'entry_datetime'=>date('Y-m-d H:i:s')
									);
				}

			}
			$this->db->insert_batch('users_right_details', $data2);	
				//echo $this->db->last_query();exit;
		return 1;
	}

	function system_link_list()
	{
		$sts = 0;
		
		if($this->session->userdata['ast_user']['user_system_admin_sts'] == 2)
		{
			$sts=1;
		}
		
		if($sts == 0)
		{
			$str = "SELECT 
					  tr.*,
					  tr.menu_link_name right_name,
					  tr.menu_cate_id categ_id,
					  tr.menu_group_id group_id,
					  cat.menu_cate_name categ_name,
					  gr.menu_name group_name 
					FROM
					  (SELECT 
						menu_link_id 
					  FROM
						users_right 
					  WHERE user_info_id = '".$this->session->userdata['ast_user']['user_id']."') s1 
					  LEFT OUTER JOIN menu_link tr 
						ON (tr.ID = s1.menu_link_id) 
					  LEFT OUTER JOIN menu_category cat 
						ON (cat.ID = tr.menu_cate_id) 
					  LEFT OUTER JOIN menu_group gr 
						ON (gr.ID = tr.menu_group_id) 
					WHERE cat.DATA_STATUS = '1' 
					  AND gr.DATA_STATUS = '1' 
					  AND tr.DATA_STATUS = '1' 
					ORDER BY tr.menu_group_id,
					  tr.menu_cate_id,
					  tr.sort_order";
		}
		else if($sts == 1)
		{
			$str = "SELECT 
					  tr.*,
					  tr.menu_link_name right_name,
					  tr.menu_cate_id categ_id,
					  tr.menu_group_id group_id,
					  cat.menu_cate_name categ_name,
					  gr.menu_name group_name 
					FROM
					  menu_link tr 
					  LEFT OUTER JOIN menu_category cat 
						ON (cat.id = tr.menu_cate_id) 
					  LEFT OUTER JOIN menu_group gr 
						ON (gr.id = tr.menu_group_id) 
					WHERE cat.data_status = '1' 
					  AND gr.data_status = '1' 
					  AND tr.data_status = '1' 
					ORDER BY tr.menu_group_id,
					  tr.menu_cate_id,
					  tr.sort_order";
		}

		$query=$this->db->query($str);
		return $query->result_array();
	}


	function get_ref_table_list()
    {
		$sts=0;
		if($this->session->userdata['ast_user']['user_system_admin_sts']==2){
			$sts=1;
		}
		if($sts==0){
		$str = "SELECT J0.* FROM reference_list J0 WHERE J0.data_status=1 ORDER BY J0.reference_name ASC";
		}else if($sts==1){
		$str = "SELECT J0.* FROM reference_list J0 WHERE J0.data_status=1 ORDER BY J0.reference_name ASC";
		}

		$query=$this->db->query($str);
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}
	
	function get_user_info_rights($Id=NULL)
    {
		if($Id==NULL){ return ''; }
		$str = "SELECT GROUP_CONCAT(gr.menu_link_id ORDER BY gr.menu_link_id SEPARATOR ',') AS sys_user_rightId
		        FROM users_right gr where gr.user_info_id='".$Id."' and gr.data_status='1' GROUP BY gr.user_info_id";
		$query=$this->db->query($str);
		$result=$query->row();
		
		if($query->num_rows()>0)
		{
			return $result->sys_user_rightId;
		}
		return '';
	}


	function get_working_group_rights($Id=NULL){
		if($Id==NULL){ return ''; }
		$str = "SELECT GROUP_CONCAT(gr.menu_link_id ORDER BY gr.menu_link_id SEPARATOR ',') sys_user_rightId,
				GROUP_CONCAT(ml.menu_operation ORDER BY ml.id SEPARATOR ',') menu_operation
								FROM user_group_right gr
				LEFT OUTER JOIN menu_link ml ON gr.menu_link_id=ml.id   
        WHERE gr.user_group_id='".$Id."' AND gr.data_status='1' GROUP BY gr.user_group_id";
		$query=$this->db->query($str);
		$result=$query->row();
		if($query->num_rows()>0){
			return $result;
		}
		return '';
	}
	function get_user_info($Id=NULL){
		if($Id==NULL){ return ''; }
		$this->db
				->select("j0.user_id,j0.name", FALSE)
				->from('users_info j0')
				->where("j0.data_status=1 AND j0.id=".$Id, NULL, FALSE)
				->limit(2);
		$q = $this->db->get();
		//echo $this->db->last_query();exit;
		if($q->num_rows()>0){
			return $q->row();
		} else { return ''; }
	}

	function get_working_group_info($add_edit,$id)
	{
		if($id!='')
		{
			$this->db->limit(2);
			$data = $this->db->get_where('user_group', array('id' => $id));
			return $data->row();
		}else{return array();}
	}
	
	function ref_table_right_details($user_id,$operation)
	{	
		$str = "SELECT GROUP_CONCAT(u.reference_table_id ORDER BY u.id SEPARATOR',') AS sys_user_referencerightid  FROM users_right_ref_table u where u.data_status=1  AND u.operation='".$operation."' AND u.user_info_id='".$user_id."'";
		$query=$this->db->query($str);
		$result=$query->row();	
		return $result;
	}
	function service_table_right_details($user_id,$operation)
	{	
		$str = "SELECT GROUP_CONCAT(u.reference_table_id ORDER BY u.id SEPARATOR',') AS sys_user_referencerightid FROM users_right_service_table u where u.data_status=1  AND u.operation='".$operation."' AND u.user_info_id='".$user_id."'";
		$query=$this->db->query($str);
		//echo $this->db->last_query();//exit;
		$result=$query->row();	
		return $result;
	}
	function maintenance_table_right_details($user_id,$operation)
	{	
		$str = "SELECT GROUP_CONCAT(u.reference_table_id ORDER BY u.id SEPARATOR',') AS sys_user_referencerightid FROM users_right_maintenance_table u where u.data_status=1  AND u.operation='".$operation."' AND u.user_info_id='".$user_id."'";
		$query=$this->db->query($str);
		$result=$query->row();	
		return $result;
	}
	function system_link_list_details($user_id,$sys_link_id)
	{	
		$str = "SELECT 
				  GROUP_CONCAT(id 
					ORDER BY id ASC SEPARATOR '###') AS link_details_id,
				  GROUP_CONCAT(
					url_profix 
					ORDER BY ID ASC SEPARATOR '###'
				  ) AS link_details_url 
				FROM
				   menu_link_details
				WHERE data_status = 1 AND menu_link_id='".$sys_link_id."'";
		$query=$this->db->query($str);
		$result=$query->row();	
		return $result;
	}
}
?>