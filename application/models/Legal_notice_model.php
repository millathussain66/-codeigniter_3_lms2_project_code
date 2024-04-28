<?php
class Legal_notice_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
	}



	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   $where2 = "b.sts!='0'";  $filterdatafield2 =' ';	

	    if($this->input->get('region')!='' && $this->input->get('region')!=0) 
		{$where2.=" AND b.region = '".trim($this->input->get('region'))."'";}
		if($this->input->get('territory')!='' && $this->input->get('territory')!=0) 
		{$where2.=" AND b.territory = '".trim($this->input->get('territory'))."'";}
		if($this->input->get('district')!='' && $this->input->get('district')!=0) 
		{$where2.=" AND b.district = '".trim($this->input->get('district'))."'";}
		if($this->input->get('unit_office')!='' && $this->input->get('unit_office')!=0) 
		{$where2.=" AND b.unit_office = '".trim($this->input->get('unit_office'))."'";}
	   	if($this->input->get('rec_dt_from') != '' && $this->input->get('rec_dt_from')!=0 && ($this->input->get('rec_dt_to') == '' || $this->input->get('rec_dt_to')==0)) 
		{$where2.=" AND DATE(b.rec_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('rec_dt_from')))))."'";}
		if($this->input->get('rec_dt_from') != '' && $this->input->get('rec_dt_from')!=0 && $this->input->get('rec_dt_to') != '' && $this->input->get('rec_dt_to')!=0) 
		{$where2.=" AND DATE(b.rec_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('rec_dt_from')))))."' AND DATE(b.rec_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('rec_dt_to')))))."'";}
		if($this->input->get('status')!='' && $this->input->get('status')!=0) 
		{$where2.=" AND b.legal_notice_sts = '".trim($this->input->get('status'))."'";}
		if($this->input->get('loan_segment')!='' && $this->input->get('loan_segment')!='') 
		{$where2.=" AND b.loan_segment = '".trim($this->input->get('loan_segment'))."'";}
		// else
		// {
		// 	if ($this->session->userdata['ast_user']['user_work_group_id']=='4') //For Recovery Maker
		// 	{
		// 		$where2 .="AND b.legal_notice_sts ='1'";
		// 	}
		// 	else if($this->session->userdata['ast_user']['user_work_group_id']=='3')//Recovery Checker
		// 	{
		// 		$where2 .="AND b.legal_notice_sts ='2'";
		// 	}
		// 	else if($this->session->userdata['ast_user']['user_work_group_id']=='17')//Region Manager
		// 	{
		// 		$where2 .="AND b.legal_notice_sts ='2'";
		// 	}
		// }

		if($this->input->get('v_dt_from') != '' && $this->input->get('v_dt_from')!=0 && ($this->input->get('v_dt_to') == '' || $this->input->get('v_dt_to')==0)) 
		{$where2.=" AND DATE(b.v_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('v_dt_from')))))."'";}
		if($this->input->get('v_dt_from') != '' && $this->input->get('v_dt_from')!=0 && $this->input->get('v_dt_to') != '' && $this->input->get('v_dt_to')!=0) 
		{$where2.=" AND DATE(b.v_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('v_dt_from')))))."' AND DATE(b.v_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('v_dt_to')))))."'";}

		if($this->input->get('e_dt_from') != '' && $this->input->get('e_dt_from')!=0 && ($this->input->get('e_dt_to') == '' || $this->input->get('e_dt_to')==0)) 
		{$where2.=" AND DATE(b.e_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('e_dt_from')))))."'";}
		if($this->input->get('e_dt_from') != '' && $this->input->get('e_dt_from')!=0 && $this->input->get('e_dt_to') != '' && $this->input->get('e_dt_to')!=0) 
		{$where2.=" AND DATE(b.e_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('e_dt_from')))))."' AND DATE(b.e_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('e_dt_to')))))."'";}
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

        		if($filterdatafield=='loan_ac')
				{
					$filterdatafield='b.loan_ac';
				}
				else if($filterdatafield=='sl_no')
				{
					$filterdatafield='b.sl_no';
				}
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='b.ac_name';
				}
				else if($filterdatafield=='loan_segment')
				{
					$filterdatafield='s.name';
				}
				else if($filterdatafield=='proposed_type')
				{
					$filterdatafield='b.proposed_type';
				}
				else if($filterdatafield=='req_type')
				{
					$filterdatafield='j7.name';
				}
				else if($filterdatafield=='e_dt')
				{
					//$filterdatafield='b.e_dt';
					$filterdatafield = "DATE_FORMAT(b.e_dt,'%d-%b-%y %h:%i %p')";
				}
				else if($filterdatafield=='stc_dt')
				{
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(b.stc_dt,'%d-%b-%y %h:%i %p')";
				}
				else if($filterdatafield=='sth_dt')
				{
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(b.sth_dt,'%d-%b-%y %h:%i %p')";
				}
				else if($filterdatafield=='v_dt')
				{
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(b.v_dt,'%d-%b-%y %h:%i %p')";
				}
				else if($filterdatafield=='rec_dt')
				{
					//$filterdatafield='b.rec_dt';
					$filterdatafield = "DATE_FORMAT(b.rec_dt,'%d-%b-%y %h:%i %p')";
				}
				else if($filterdatafield=='status')
				{
					$filterdatafield='j6.name';
				}
				// else if($filterdatafield=='return_reason_rm')
				// {
				// 	$filterdatafield='b.return_reason_rm';
				// }
				
				//else{$filterdatafield='b.'.$filterdatafield;}

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
				if($filterdatafield =='e_by')
				{
					$where .= " (j2.name LIKE '%".$filtervalue."%' OR j2.user_id LIKE '%".$filtervalue."%') ";
				}
				else if($filterdatafield =='stc_by')
				{
					$where .= " (j4.name LIKE '%".$filtervalue."%' OR j4.user_id LIKE '%".$filtervalue."%') ";
				}
				else if($filterdatafield =='sth_by')
				{
					$where .= " (j9.name LIKE '%".$filtervalue."%' OR j9.user_id LIKE '%".$filtervalue."%') ";
				}
				else if($filterdatafield =='v_by')
				{
					$where .= " (j10.name LIKE '%".$filtervalue."%' OR j10.user_id LIKE '%".$filtervalue."%') ";
				}
				else if($filterdatafield =='rec_by')
				{
					$where .= " (j5.name LIKE '%".$filtervalue."%' OR j5.user_id LIKE '%".$filtervalue."%') ";
				}
				else{
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
		// $where_initi=''; 
		// if($where=='' || count($where)<=0){			
		// 	$where_initi.=" ";
		// }
		if ($sortorder == '')
		{
			//$sortdatafield="b.id";
			//$sortorder = "DESC";	
			$sortdatafield="j6.s_order";		
			$sortorder = "ASC";		
		}
		if($this->input->get('sorting')!='') { $sortdatafield = $this->input->get('sorting');}
		if($this->input->get('ordering')!='') { $sortorder = $this->input->get('ordering'); }
		$condition_array=array();
		if(check_group('4') || check_group('3') || check_group('17'))
		{
			$where2 .=" AND (";
		}
		if (check_group('4')) //For Recovery Maker
		{
			array_push($condition_array,"b.e_by='".$this->session->userdata['ast_user']['user_id']."'");
		}
		if(check_group('3'))//Recovery Checker
		{
			array_push($condition_array,"(b.e_by IN(".$this->session->userdata['ast_user']['recovery_makers'].") OR b.checker_id='".$this->session->userdata['ast_user']['user_id']."')");
		}
		if(check_group('17'))//Region Manager
		{
			array_push($condition_array,"b.region IN(".$this->session->userdata['ast_user']['recovery_region'].")");
		}
		if(check_group('4') || check_group('3') || check_group('17'))
		{
			$where2 .=implode(" OR ",$condition_array);
			$where2 .=") ";
		}
	    $this->db
	    ->select('SQL_CALC_FOUND_ROWS b.id,IF(b.ho_return_reason IS NOT NULL OR b.return_reason_rm IS NOT NULL OR b.reject_reason_rm IS NOT NULL,1,"") as return_reason,j6.s_order,s.name as loan_segment,IF(b.legal_notice_sts="2",CONCAT(j6.name," (",j8.user_id,")"),j6.name) as status,
	    	b.sl_no,b.loan_ac,b.ac_name,CONCAT(j2.name," (",j2.user_id,")")as e_by,
	    	DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,b.return_reason_rm,b.reject_reason_rm,b.ho_return_reason,b.ho_decline_reason,b.holm_r_reason,
	    	CONCAT(j4.name," (",j4.user_id,")")as stc_by,
	    	CONCAT(j9.name," (",j9.user_id,")")as sth_by,
	    	CONCAT(j10.name," (",j10.user_id,")")as v_by,
	    	DATE_FORMAT(b.stc_dt,"%d-%b-%y %h:%i %p") AS stc_dt,
	    	CONCAT(j5.name," (",j5.user_id,")")as rec_by,
	    	DATE_FORMAT(b.rec_dt,"%d-%b-%y %h:%i %p") AS rec_dt,
	    	DATE_FORMAT(b.sth_dt,"%d-%b-%y %h:%i %p") AS sth_dt,
	    	DATE_FORMAT(b.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
	    	b.e_by as e_by_id,b.territory,b.region,j7.name as req_type,b.proposed_type,b.legal_notice_sts,
	    	b.reject_reason_rm,b.ac_name,
	    	b.checker_id,b.sts,b.cif,b.branch_sol,
	    	', FALSE)
				->from("legal_notice b")
				->join('users_info as j2', 'b.e_by=j2.id', 'left')
				->join('users_info as j4', 'b.stc_by=j4.id', 'left')
				->join('users_info as j5', 'b.rec_by=j5.id', 'left')
				->join('ref_status as j6', 'b.legal_notice_sts=j6.id', 'left')
				->join('ref_req_type as j7', 'b.req_type=j7.id', 'left')
				->join('users_info as j8', 'b.checker_id=j8.id', 'left')
				->join('users_info as j9', 'b.sth_by=j9.id', 'left')
				->join('users_info as j10', 'b.v_by=j10.id', 'left')
				->join('ref_loan_segment as s', 'b.loan_segment=s.code', 'left')
				->where($where)
				->where($where2)
				->order_by($sortdatafield,$sortorder)
				->limit($limit, $offset);
			$q=$this->db->get();

		$query = $this->db->query('SELECT FOUND_ROWS() AS Count');
		$objCount = $query->result_array();
		$result["TotalRows"] = $objCount[0]['Count'];

		if ($q->num_rows() > 0){
			$result["Rows"] = $q->result();
		} else {
			$result["Rows"] = array();
		}
		return $result;
	}
    function get_card_facility($id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT j0.*,f.name as facility_type_name,date_format(j0.outstanding_bl_dt,'%d-%b-%y') as outstanding_bl_dt,
				date_format(j0.overdue_bl_dt,'%d-%b-%y') as overdue_bl_dt,
				date_format(j0.call_up_dt,'%d-%b-%y') as call_up_dt,
				date_format(j0.expire_date,'%d-%b-%y') as expire_date,
				date_format(j0.disbursement_date,'%d-%b-%y') as disbursement_date
			FROM legal_notice_facility as j0
			LEFT OUTER JOIN ref_facility_name f ON j0.facility_type=f.id
			WHERE j0.legal_notice_id= ".$this->db->escape($id)." AND j0.sts='1' AND j0.section_type='card' ORDER BY id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_add_action_data($id)
	{
		$this->db
			->select("b.*", FALSE)
			->from("legal_notice b")
			->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function get_pre_ln_data($loan_ac,$type=NULL)
	{
		if($loan_ac!=''){
			$where = "";
			if($type=='Card')
			{
				$ac = $this->Common_model->stringEncryption('encrypt',$loan_ac);
				$where = "j0.org_loan_ac ='".$ac."'";
			}
			else
			{
				$where = "j0.loan_ac ='".$loan_ac."'";
			}
			$str="SELECT j0.id,j0.legal_notice_sts,j0.proposed_type,CONCAT(u.name, '(',u.pin,')') as pre_ln_by,j0.id,j0.proposed_type,DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS dt_fromat,j0.e_dt
				FROM legal_notice AS j0 
				LEFT OUTER JOIN users_info u on(u.id=j0.e_by)
				WHERE $where
				AND j0.sts = '1' 
				ORDER BY j0.id DESC LIMIT 1";
			$query=$this->db->query($str);
			return $query->row();
		}
		else{return NULL;}
	}
	function get_pre_ln_data_by_id($id)
	{
		if($id!=''){
			$str="SELECT j0.id,j0.legal_notice_sts,j0.proposed_type,CONCAT(u.name, '(',u.pin,')') as pre_ln_by,j0.id,j0.proposed_type,DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS dt_fromat,j0.e_dt
				FROM legal_notice AS j0 
				LEFT OUTER JOIN users_info u on(u.id=j0.e_by)
				WHERE j0.id ='".$id."'
				AND j0.sts = '1' 
				ORDER BY j0.id DESC LIMIT 1";
			$query=$this->db->query($str);
			return $query->row();
		}
		else{return NULL;}
	}
	function get_file_name($field_name,$path)
	{
		//Deleteng old file when no new file selected
		if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='0') 
		{
			$delete_path = $path.$_POST['hidden_'.$field_name.'_value'];	  
		    //chmod($path, 0777);
            unlink($delete_path);	
            $file ="";
		}//Deleteng old file and new file selected
		else if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='1') 
		{
			$delete_path = $path.$_POST['hidden_'.$field_name.'_value'];	  
		    //chmod($path, 0777);
            unlink($delete_path);	
            $file = $this->Common_model->get_file_name('ln',$field_name,$path);
		}//Taking Old File
		else if (isset($_POST['hidden_'.$field_name.'_value']) && $_POST['hidden_'.$field_name.'_select']=='0') 
		{
			$file = $_POST['hidden_'.$field_name.'_value'];
		}//Taking Full New File
		else
		{
			$file = $this->Common_model->get_file_name('ln',$field_name,$path);
		}
		return $file;
	}
	function add_edit_action($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
        if($editrow==""){$editrow=0;}
	    
		$call_up_file = $this->get_file_name('call_up_file','legal_notice_file/call_up_file/');
	    //Legal Notice Data
	    if ($add_edit=="add") {
	    	$sl_no=$this->user_model->get_unique_serial('ln');
	    }else{$sl_no=$this->security->xss_clean( $this->input->post('sl_no_edit'));}
	    $legal_notice_data = array(
	    	'sl_no' => $sl_no,
			'proposed_type' =>$this->security->xss_clean( $this->input->post('proposed_type')),
			'mobile_no' =>$this->security->xss_clean( $this->input->post('mobile_no')),
			'cif' =>$this->security->xss_clean( $this->input->post('cif')),
			'branch_sol' =>$this->security->xss_clean( $this->input->post('branch_sol')),
			'ac_name' =>$this->security->xss_clean( $this->input->post('ac_name')),
			'brrower_name' =>$this->security->xss_clean( $this->input->post('brrower_name')),
			'sub_type' =>$this->security->xss_clean( $this->input->post('sub_type')),
			'loan_segment' =>$this->security->xss_clean( $this->input->post('loan_segment')),
			'current_address' =>$this->security->xss_clean( $this->input->post('current_address')),
			'mother_name' =>$this->security->xss_clean( $this->input->post('mother_name')),
			'spouse_name' =>$this->security->xss_clean( $this->input->post('spouse_name')),
			'region' =>$this->security->xss_clean( $this->input->post('region')),
			'territory' =>$this->security->xss_clean( $this->input->post('territory')),
			'district' =>$this->security->xss_clean( $this->input->post('district')),
			'cl_bb_card' =>$this->security->xss_clean( $this->input->post('cl_bb_card')),
			'cl_bbl_card' =>$this->security->xss_clean( $this->input->post('cl_bbl_card')),
			'unit_office' =>$this->security->xss_clean( $this->input->post('unit_office')),
			//'req_type' =>$this->security->xss_clean( $this->input->post('req_type')),
			'more_acc_available' =>$this->security->xss_clean( $this->input->post('more_acc_available')),
			'more_acc_number' =>$this->security->xss_clean( $this->input->post('more_acc_number')),
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),
			'pre_ln_dt' =>implode('-',array_reverse(explode('/',$this->input->post('pre_ln_dt')))),
			'pre_ln_id' =>$this->security->xss_clean( $this->input->post('pre_ln_id')),
			'call_up_dt' =>implode('-',array_reverse(explode('/',$this->input->post('call_up_dt')))),
			'call_up_file' =>$call_up_file
		);
	    //'subscription_date'=>implode('-',array_reverse(explode('/',$this->input->post('subscription_date')))),
		if($add_edit=="add")
		{
			if ($_POST['proposed_type']=='Card') 
			{
				$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac')); 
				$legal_notice_data['customer_id'] = $this->security->xss_clean( $this->input->post('hidden_customer_id'));
			}
			else{$org_loan_ac='';}
			$legal_notice_data['loan_ac'] = $this->security->xss_clean($this->input->post('loan_ac'));
			$legal_notice_data['org_loan_ac'] = $org_loan_ac;
			$legal_notice_data['card_iss_date'] = implode('-',array_reverse(explode('/',$this->input->post('card_iss_date'))));
			$legal_notice_data['card_exp_date'] = implode('-',array_reverse(explode('/',$this->input->post('card_exp_date'))));
			$legal_notice_data['outstanding_bl_dt'] = implode('-',array_reverse(explode('/',$this->input->post('outstanding_bl_dt'))));
			$legal_notice_data['card_limit'] = $this->security->xss_clean( $this->input->post('card_limit'));
			$legal_notice_data['outstanding_bl'] = $this->security->xss_clean( $this->input->post('outstanding_bl'));
			$legal_notice_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$legal_notice_data['e_dt'] = date('Y-m-d H:i:s');
			$legal_notice_data['legal_notice_sts'] = 1;
			$this->db->insert('legal_notice', $legal_notice_data);
			$insert_idss = $this->db->insert_id();
			if($insert_idss==0)
			{
				$this->db->trans_rollback();
				$this->db->db_debug = $db_debug;
				return '01';		
			}
			else
			{
				//For All Card Data Insert
				if ($_POST['proposed_type']=='Card') 
				{
					for($i=1;$i<= $_POST['sub_card_counter'];$i++)
					{
						$card_info = array(
						'module_name' => 'ln',
						'module_id' => $insert_idss,
						'card_type' =>$this->security->xss_clean( $this->input->post('card_type_'.$i)),
						'card_no' =>$this->security->xss_clean( $this->input->post('card_no_'.$i)),
						'org_card_no' => $this->Common_model->stringEncryption('encrypt',$this->input->post('org_card_no_'.$i)),
						'card_name' => $this->security->xss_clean( $this->input->post('card_name_'.$i)),
						'card_issue_dt' => implode('-',array_reverse(explode('/',$this->input->post('card_issue_dt_'.$i)))),
						'card_exp_dt' => implode('-',array_reverse(explode('/',$this->input->post('card_exp_dt_'.$i)))),
						'card_limit' => $this->security->xss_clean( $this->input->post('card_limit_'.$i)),
						'outstanding_bl' => $this->security->xss_clean( $this->input->post('outstanding_bl_'.$i)),
						'outstanding_bl_dt' => implode('-',array_reverse(explode('/',$this->input->post('outstanding_bl_dt_'.$i)))),
		     			);
		     			$this->db->insert('sub_card_data', $card_info);
					}
				}
				
				for($i=1;$i<= $_POST['guarantor_info_counter'];$i++)
				{
					$guarantor_info = array(
					'legal_notice_id' => $insert_idss,
					'guarantor_cif' =>$this->security->xss_clean( $this->input->post('ac_no_'.$i)),
					'guarantor_type' =>$this->security->xss_clean( $this->input->post('guarantor_type_'.$i)),
					'guarantor_name' => $this->security->xss_clean( $this->input->post('guarantor_name_'.$i)),
					'father_name' => $this->security->xss_clean( $this->input->post('father_name_'.$i)),
					'present_address' => $this->security->xss_clean( $this->input->post('present_address_'.$i)),
					'permanent_address' => $this->security->xss_clean( $this->input->post('permanent_address_'.$i)),
					'business_address' => $this->security->xss_clean( $this->input->post('business_address_'.$i)),
					'guar_sts' => $this->security->xss_clean( $this->input->post('guar_sts_'.$i)),
					'occ_sts' => $this->security->xss_clean( $this->input->post('occ_sts_'.$i)),
	     			);
	     			if ($_POST['guarantor_info_delete_'.$i]!=1) {
	     				$this->db->insert('legal_notice_guarantor', $guarantor_info);
	     			}
	     			$insert_idss2 = $this->db->insert_id();
	     			if($insert_idss2==0)
					{
						$this->db->trans_rollback();
						$this->db->db_debug = $db_debug;
						return '00';		
					}
				}
				if ($_POST['proposed_type']=='Card') 
				{
					for($i=1;$i<= $_POST['card_facility_counter'];$i++)
					{
						$card_facility = array(
						'legal_notice_id' => $insert_idss,
						'ac_number' => $this->input->post('ac_number_'.$i),
						'disbursement_date'=>implode('-',array_reverse(explode('/',$this->input->post('disbursement_date_'.$i)))),
						'expire_date'=>implode('-',array_reverse(explode('/',$this->input->post('expire_date_'.$i)))),
						'disbursed_amount' => $this->input->post('disbursed_amount_'.$i),
		     			'section_type' => 'card'
		     			);
		     			$this->db->insert('legal_notice_facility', $card_facility);
		     			$insert_idss2 = $this->db->insert_id();
		     			if($insert_idss2==0)
						{
							$this->db->trans_rollback();
							$this->db->db_debug = $db_debug;
							return '00';		
						}
					}
				}
				else
				{
					if ($_POST['facility_info_counter']!=0) 
					{
						for($i=1;$i<= $_POST['facility_info_counter'];$i++)
						{
							$loan_facility = array(
							'legal_notice_id' => $insert_idss,
							'ac_number' => $this->input->post('ac_number_'.$i),
							'sch_desc' => $this->input->post('sch_desc_'.$i),
							'ac_name' => $this->input->post('ac_name_'.$i),
							'facility_type' => $this->input->post('facility_type_'.$i),
							'disbursement_date'=>implode('-',array_reverse(explode('/',$this->input->post('disbursement_date_'.$i)))),
							'disbursed_amount' => $this->input->post('disbursed_amount_'.$i),
							'expire_date'=>implode('-',array_reverse(explode('/',$this->input->post('expire_date_'.$i)))),
							'disbursed_amount' => $this->security->xss_clean( $this->input->post('disbursed_amount_'.$i)),
							'due_installments' => $this->security->xss_clean( $this->input->post('due_installments_'.$i)),
							'payble' => $this->security->xss_clean( $this->input->post('payble_'.$i)),
							'repayment' => $this->security->xss_clean( $this->input->post('repayment_'.$i)),
							'outstanding_bl' => $this->security->xss_clean( $this->input->post('outstanding_bl_'.$i)),
							'outstanding_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('outstanding_bl_dt_'.$i)))),
							'overdue_bl' => $this->security->xss_clean( $this->input->post('overdue_bl_'.$i)),
							'overdue_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('overdue_bl_dt_'.$i)))),
							'call_up_dt'=>implode('-',array_reverse(explode('/',$this->input->post('call_up_dt_'.$i)))),
							'cl_bb' => $this->security->xss_clean( $this->input->post('cl_bb_'.$i)),
							'cl_bbl' => $this->security->xss_clean( $this->input->post('cl_bbl_'.$i)),
							'api_new' => 1,
			     			'section_type' => 'loan'
			     			);
			     			//For insert the new row
			 				if($_POST['facility_info_delete_'.$i]!=1)
			 				{
			 					$loan_facility['e_by'] = $this->session->userdata['ast_user']['user_id'];
								$loan_facility['e_dt'] = date('Y-m-d H:i:s');
			 					$this->db->insert('legal_notice_facility', $loan_facility);
			 				}
			     			//$this->db->insert('legal_notice_facility', $loan_facility);
			     			$insert_idss2 = $this->db->insert_id();
			     			if($insert_idss2==0)
							{
								$this->db->trans_rollback();
								$this->db->db_debug = $db_debug;
								return '00';		
							}
						}
					}
				}
			}
			$data2 = $this->user_model->user_activities(1,'f_legal_notice',$insert_idss,'legal_notice','Initiate Legal Notice('.$insert_idss.')');
		}
		else
		{
			if ($_POST['facility_info_counter']!=0) 
			{
				for($i=1;$i<= $_POST['facility_info_counter'];$i++)
				{
					$loan_facility = array(
					'disbursement_date'=>implode('-',array_reverse(explode('/',$this->input->post('disbursement_date_'.$i)))),
					'expire_date'=>implode('-',array_reverse(explode('/',$this->input->post('expire_date_'.$i)))),
					'disbursed_amount' => $this->security->xss_clean( $this->input->post('disbursed_amount_'.$i)),
					'due_installments' => $this->security->xss_clean( $this->input->post('due_installments_'.$i)),
					'payble' => $this->security->xss_clean( $this->input->post('payble_'.$i)),
					'repayment' => $this->security->xss_clean( $this->input->post('repayment_'.$i)),
					'outstanding_bl' => $this->security->xss_clean( $this->input->post('outstanding_bl_'.$i)),
					'outstanding_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('outstanding_bl_dt_'.$i)))),
					'overdue_bl' => $this->security->xss_clean( $this->input->post('overdue_bl_'.$i)),
					'overdue_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('overdue_bl_dt_'.$i)))),
					'call_up_dt'=>implode('-',array_reverse(explode('/',$this->input->post('call_up_dt_'.$i)))),
					'cl_bb' => $this->security->xss_clean( $this->input->post('cl_bb_'.$i)),
					'cl_bbl' => $this->security->xss_clean( $this->input->post('cl_bbl_'.$i)),
					'api_new' => 1,
	     			'section_type' => 'loan'
	     			);
	     			// For skip The new deleted row
	 				if ($_POST['facility_info_edit_'.$i]==0 && $_POST['facility_info_delete_'.$i]==1) 
	 				{
	 					continue;
	 				}
	 				//For Delete old row
	 				if ($_POST['facility_info_edit_'.$i]!=0 && $_POST['facility_info_delete_'.$i]==1) 
	 				{
	 					$loan_facility = array('sts' => 0);
	 					$loan_facility['u_by'] = $this->session->userdata['ast_user']['user_id'];
						$loan_facility['u_dt'] = date('Y-m-d H:i:s');
	 					$this->db->where('id',$_POST['facility_info_edit_'.$i]);
	 					$this->db->where('section_type','loan');
						$this->db->update('legal_notice_facility', $loan_facility);
	 				}
	 				//For update the old row
	 				else if($_POST['facility_info_edit_'.$i]!=0 && $_POST['facility_info_delete_'.$i]!=1)
	 				{
	 					$loan_facility['u_by'] = $this->session->userdata['ast_user']['user_id'];
						$loan_facility['u_dt'] = date('Y-m-d H:i:s');
	 					$this->db->where('id',$_POST['facility_info_edit_'.$i]);
	 					$this->db->where('section_type','loan');
						$this->db->update('legal_notice_facility', $loan_facility);
	 				}
	 				//For insert the new row
	 				else if($_POST['facility_info_edit_'.$i]==0 && $_POST['facility_info_delete_'.$i]!=1)
	 				{
	 					$loan_facility['e_by'] = $this->session->userdata['ast_user']['user_id'];
						$loan_facility['e_dt'] = date('Y-m-d H:i:s');
	 					$this->db->insert('legal_notice_facility', $loan_facility);
	 				}
				}
			}
	  		$legal_notice_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$legal_notice_data['u_dt'] = date('Y-m-d H:i:s');
			if($_POST['operation']!='ho_update') //When update request comes from field
			{
				$legal_notice_data['legal_notice_sts'] = 1;
			}
			$this->db->where('id', $edit_id);
			$this->db->update('legal_notice', $legal_notice_data);
			$insert_idss = $edit_id;
			if($this->db->affected_rows()==0)
			{
				$this->db->trans_rollback();
				$this->db->db_debug = $db_debug;
				return '00';		
			}
	  		else
	  		{
	  			//Gurantor Data Update
				for($i=1;$i<= $_POST['guarantor_info_counter_edit'];$i++)
				{
					$guarantor_info = array(
					'legal_notice_id' => $insert_idss,
					'guarantor_type' =>$this->security->xss_clean( $this->input->post('guarantor_type_'.$i)),
					'guarantor_name' => $this->security->xss_clean( $this->input->post('guarantor_name_'.$i)),
					'father_name' => $this->security->xss_clean( $this->input->post('father_name_'.$i)),
					'present_address' => $this->security->xss_clean( $this->input->post('present_address_'.$i)),
					'permanent_address' => $this->security->xss_clean( $this->input->post('permanent_address_'.$i)),
					'business_address' => $this->security->xss_clean( $this->input->post('business_address_'.$i)),
					'guar_sts' => $this->security->xss_clean( $this->input->post('guar_sts_'.$i)),
					'occ_sts' => $this->security->xss_clean( $this->input->post('occ_sts_'.$i)),
	     			);
	 				// For skip The new deleted row
	 				if ($_POST['guarantor_info_edit_'.$i]==0 && $_POST['guarantor_info_delete_'.$i]==1) 
	 				{
	 					continue;
	 				}
	 				//For Delete the old row
	 				if ($_POST['guarantor_info_edit_'.$i]!=0 && $_POST['guarantor_info_delete_'.$i]==1) 
	 				{
	 					$data = array('sts' => 0);
	 					$this->db->where('id',$_POST['guarantor_info_edit_'.$i]);
						$this->db->update('legal_notice_guarantor', $data);
	 				}
	 				//For update the old row
	 				else if($_POST['guarantor_info_edit_'.$i]!=0 && $_POST['guarantor_info_delete_'.$i]!=1)
	 				{
	 					$this->db->where('id',$_POST['guarantor_info_edit_'.$i]);
						$this->db->update('legal_notice_guarantor', $guarantor_info);
	 				}
	 				//For insert the new row
	 				else if($_POST['guarantor_info_edit_'.$i]==0 && $_POST['guarantor_info_delete_'.$i]==0)
	 				{
	 					$this->db->insert('legal_notice_guarantor', $guarantor_info);
	 				}
	     			
				}
	  		}

	        $data2 = $this->user_model->user_activities(35,'f_legal_notice',$insert_idss,'legal_notice','Update Legal Notice('.$insert_idss.')');
		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return '03';
		}
		else
		{
			$this->db->trans_commit();
			return $insert_idss;
		}


	}
	function get_info($add_edit,$id) // get data for edit
	{
		if($id!=''){
			$this->db
			->select("j0.*", FALSE)
			->from('legal_notice as j0')
			->where("j0.id='".$id."'",NULL,FALSE)
			->limit(1);
			return  $this->db->get()->row();
		}
		else{return NULL;}
	}
	function get_recommend_info($id) // get data for edit
	{
		if($id!=''){
			$this->db
			->select("j0.*,j0.legal_notice_sts as sts,j15.name as legal_notice_sts,CONCAT(j13.name,' (',j13.code,')') as branch_sol,
				j1.name as region_name,j2.name as territory_name,j3.name as district_name,
				j4.name as unit_office_name,j26.name as lawyer_name,
				j6.name as subject_name,j7.name as loan_segment,
				CONCAT(j8.name,' (',j8.pin,')') as e_by,
				CONCAT(j9.name,' (',j9.pin,')') as stc_by,
				CONCAT(j10.name,' (',j10.pin,')') as rec_by,
				CONCAT(j14.name,' (',j14.pin,')') as r_by,
				CONCAT(j16.name,' (',j16.pin,')') as reject_by_rm,
				CONCAT(j17.name,' (',j17.pin,')') as ack_by,
				CONCAT(j18.name,' (',j18.pin,')') as hold_by,
				CONCAT(j19.name,' (',j19.pin,')') as sth_by,
				CONCAT(j20.name,' (',j20.pin,')') as q_by,
				CONCAT(j21.name,' (',j21.pin,')') as ho_r_by,
				CONCAT(j22.name,' (',j22.pin,')') as v_by,
				CONCAT(j23.name,' (',j23.pin,')') as holm_r_by,
				CONCAT(j24.name,' (',j24.pin,')') as ho_decline_by,
				CONCAT(j25.name,' (',j25.pin,')') as l_sent_by,
				DATE_FORMAT(j0.call_up_dt,'%d-%b-%y %h:%i %p') AS call_up_dt,
				DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,r.name as req_type,
				DATE_FORMAT(j0.stc_dt,'%d-%b-%y %h:%i %p') AS stc_dt,
				DATE_FORMAT(j0.return_dt_rm,'%d-%b-%y %h:%i %p') AS r_dt,
				DATE_FORMAT(j0.reject_dt_rm,'%d-%b-%y %h:%i %p') AS reject_dt_rm,
				DATE_FORMAT(j0.ack_dt,'%d-%b-%y %h:%i %p') AS ack_dt,
				DATE_FORMAT(j0.hold_dt,'%d-%b-%y %h:%i %p') AS hold_dt,
				DATE_FORMAT(j0.sth_dt,'%d-%b-%y %h:%i %p') AS sth_dt,
				DATE_FORMAT(j0.q_dt,'%d-%b-%y %h:%i %p') AS q_dt,
				DATE_FORMAT(j0.ho_r_dt,'%d-%b-%y %h:%i %p') AS ho_r_dt,
				DATE_FORMAT(j0.v_dt,'%d-%b-%y %h:%i %p') AS v_dt,
				DATE_FORMAT(j0.holm_r_dt,'%d-%b-%y %h:%i %p') AS holm_r_dt,
				DATE_FORMAT(j0.ho_decline_dt,'%d-%b-%y %h:%i %p') AS ho_decline_dt,
				DATE_FORMAT(j0.call_up_dt,'%d-%b-%y %h:%i %p') AS call_up_dt,
				DATE_FORMAT(j0.legal_notice_s_dt,'%d-%b-%y %h:%i %p') AS legal_notice_s_dt,
				DATE_FORMAT(j0.rec_dt,'%d-%b-%y %h:%i %p') AS rec_dt", FALSE)
			->from('legal_notice as j0')
			->join('ref_req_type as r', 'j0.req_type=r.id', 'left')
			->join("ref_region as j1", "j0.region=j1.id", "left")
			->join("ref_territory as j2", "j0.territory=j2.id", "left")
			->join("ref_district as j3", "j0.district=j3.id", "left")
			->join("ref_unit_office as j4", "j0.unit_office=j4.id", "left")
			->join("ref_subject_type as j6", "j0.sub_type=j6.id", "left")
			->join("ref_loan_segment as j7", "j0.loan_segment=j7.code", "left")
			->join("users_info as j8", "j0.e_by=j8.id", "left")
			->join("users_info as j9", "j0.stc_by=j9.id", "left")
			->join("users_info as j10", "j0.rec_by=j10.id", "left")
			->join("users_info as j14", "j0.return_by_rm=j14.id", "left")
			->join("ref_branch_sol as j13", "j0.branch_sol=j13.code", "left")
			->join("ref_status as j15", "j0.legal_notice_sts=j15.id", "left")
			->join("users_info as j16", "j0.reject_by_rm=j16.id", "left")
			->join("users_info as j17", "j0.ack_by=j17.id", "left")
			->join("users_info as j18", "j0.hold_by=j18.id", "left")
			->join("users_info as j19", "j0.sth_by=j19.id", "left")
			->join("users_info as j20", "j0.q_by=j20.id", "left")
			->join("users_info as j21", "j0.ho_r_by=j21.id", "left")
			->join("users_info as j22", "j0.v_by=j22.id", "left")
			->join("users_info as j23", "j0.holm_r_by=j23.id", "left")
			->join("users_info as j24", "j0.ho_decline_by=j24.id", "left")
			->join("users_info as j25", "j0.legal_notice_s_by=j25.id", "left")
			->join("ref_lawyer as j26", "j0.lawyer=j26.id", "left")
			->where("j0.id='".$id."'",NULL,FALSE)
			->limit(1);
			return  $this->db->get()->row();
		}
		else{return NULL;}
	}
	function get_guarantor_info($add_edit,$id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT g.* ,
			IF(g.guar_sts='', ' ', s.name) as guar_sts_name,
			IF(g.guarantor_type='', ' ', t.name) as type_name,
			IF(g.occ_sts='', ' ', o.name) as occ_sts_name
			FROM legal_notice_guarantor g
			LEFT OUTER JOIN ref_guar_type t on(g.guarantor_type=t.code)
			LEFT OUTER JOIN ref_guar_sts s on(g.guar_sts=s.id)
			LEFT OUTER JOIN ref_guar_occ o on(g.occ_sts=o.code)
			WHERE g.sts = '1'  AND g.legal_notice_id= ".$this->db->escape($id)." ORDER BY g.id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_r_history($id,$type=Null) // get data for edit
	{
		if($id!=''){
			if ($type=='life_cycle') {
				$where='';
			}
			else
			{
				$where="AND(r.activities_id=7 || r.activities_id=4 || r.activities_id=5 || r.activities_id=8 || r.activities_id=9 || r.activities_id=11 || r.activities_id=12)";
			}
			$str=" SELECT r.description_activities as oprs_descriptions,r.oprs_reason,s.name as oprs_sts,DATE_FORMAT(r.activities_datetime,'%d-%b-%y %h:%i %p') AS oprs_dt,CONCAT(u.name,' (',u.user_id,')') as r_by
			FROM user_activities_history as r
			LEFT OUTER JOIN users_info u ON u.id=r.activities_by
			LEFT OUTER JOIN ref_status s ON s.id=r.activities_id
			WHERE r.table_row_id= ".$this->db->escape($id)." AND r.section_name='f_legal_notice'  ".$where."  ORDER BY r.id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_facility_info($add_edit,$id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT f.*,DATE_FORMAT(f.disbursement_date,'%d-%b-%y') as disbursement_date
			,DATE_FORMAT(f.expire_date,'%d-%b-%y') as expire_date,
			DATE_FORMAT(f.outstanding_bl_dt,'%d-%b-%y') as outstanding_bl_dt,
			DATE_FORMAT(f.overdue_bl_dt,'%d-%b-%y') as overdue_bl_dt,
			DATE_FORMAT(f.call_up_dt,'%d-%b-%y') as call_up_dt
			FROM legal_notice_facility as f
			WHERE f.sts = '1'  AND f.legal_notice_id= ".$this->db->escape($id)." ORDER BY f.id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_facility_edit_info_card($id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT DATE_FORMAT(f.card_iss_date,'%d-%b-%y') as card_iss_date,
			DATE_FORMAT(f.outstanding_bl_dt,'%d-%b-%y') as outstanding_bl_dt
			,DATE_FORMAT(f.card_exp_date,'%d-%b-%y') as card_exp_date,f.card_limit,f.outstanding_bl
			FROM legal_notice as f
			WHERE f.sts = '1'  AND f.id= ".$this->db->escape($id)." ORDER BY f.id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_facility_info_card($id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT DATE_FORMAT(f.card_issue_dt,'%d-%b-%Y') as card_issue_dt,
			DATE_FORMAT(f.outstanding_bl_dt,'%d-%b-%Y') as outstanding_bl_dt
			,DATE_FORMAT(f.card_exp_dt,'%d-%b-%Y') as card_exp_dt,f.card_limit,f.outstanding_bl,
			f.card_type,f.card_no,f.card_name
			FROM sub_card_data as f
			WHERE f.module_name = 'ln'  AND f.module_id= ".$this->db->escape($id)." ORDER BY f.id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function delete_action()
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start

		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('d_reason'=>trim($_POST['comments']),	'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);
				$data2 = $this->user_model->user_activities(15,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Delete Legal Notice('.$this->input->post('deleteEventId').')',$_POST['comments']);
			}
			
		}
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],2,'legal_notice_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('legal_notice_sts' => '2', 'stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'checker_id' => $this->input->post('checker_to_notify'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);
				if ($this->db->affected_rows() > 0) 
				{
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'email')
					{
						$str="SELECT  j0.sl_no,s.name as legal_notice_sts
									 FROM legal_notice j0
									 LEFT OUTER JOIN ref_status s on(j0.legal_notice_sts=s.id)
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $checker_id = $this->input->post('checker_to_notify');
		              
						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$checker_id."' LIMIT 1";
						$checker_info=$this->db->query($str1)->row();
						
		                if (!empty($checker_info->email_address) && $checker_info->email_address != null) {
		                   $subject="Request for Approval";
						   $req_type=$application_data->legal_notice_sts;
						   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
						   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
						    A request is waiting for your approval.<br/><br/>
							Request Type: ".$req_type."<br/>
							Request by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), <br/>
							Request Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/>
							Request for: SL NO:".$application_data->sl_no."<br/><br/>
							Please login to  <a href=".base_url().">LMS Application</a>  to approve the request.<br/><br/> 
							This is a system generated email, no need to reply.<br/><br/>  
							Thanks</div>";
							$m=$this->User_model->send_email("", "", $checker_info->email_address,"" ,$subject,$message);
							
							//echo $m;exit;
		                }
		            }
	        	}
	        	$application_data = $this->db->query("SELECT loan_ac from legal_notice where id='".$_POST['deleteEventId']."'")->row();
	        	
	        	$subject = "Need your Recommendation for 1st legal notice issue on this A/C-".$application_data->loan_ac;
	        	$url = base_url()."legal_notice/details";
	        	$data2 = $this->Common_model->push_notification_data($subject,$url,'legal_notice',$_POST['deleteEventId'],date('Y-m-d'),'',$this->input->post('checker_to_notify'),'1');
				
				$data2 = $this->user_model->user_activities(2,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Send To Recommender('.$this->input->post('deleteEventId').')');
			}
			
		}
		if($this->input->post('type')=='recommend'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],'3,4,5','legal_notice_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('legal_notice_sts' => 3,'life_cycle'=>2,'rec_by'=> $this->session->userdata['ast_user']['user_id'], 'rec_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);
				$data2 = $this->user_model->user_activities(3,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Recommend Legal Notice('.$this->input->post('deleteEventId').')');
			}
			
		}
		if($this->input->post('type')=='reject'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],'3,4,5','legal_notice_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('legal_notice_sts' => 5,'reject_reason_rm'=>trim($_POST['reason']),'reject_by_rm'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt_rm'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);
				if ($this->db->affected_rows() > 0) 
				{
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'reject')
					{
						$str="SELECT  j0.sl_no,j0.e_by,s.name as legal_notice_sts
									 FROM legal_notice j0
									 LEFT OUTER JOIN ref_status s on(j0.legal_notice_sts=s.id)
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $maker = $application_data->e_by;
		              
						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker."' LIMIT 1";
						$maker=$this->db->query($str1)->row();
						
		                if (!empty($maker->email_address) && $maker->email_address != null) {
		                   $subject="1st Legal Notice Declined!!";
						   $req_type=$application_data->legal_notice_sts;
						   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
						   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
						    Your initiated 1st legal notice has been Declined.<br/><br/>
							Request Type: ".$req_type."<br/>
							Request by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), <br/>
							Request Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/>
							Request for: SL NO:".$application_data->sl_no."<br/><br/>
							Please login to  <a href=".base_url().">LMS Application</a>  to approve the request.<br/><br/> 
							This is a system generated email, no need to reply.<br/><br/>  
							Thanks</div>";
							$m=$this->User_model->send_email("", "", $maker->email_address,"", $subject,$message);
							
							//echo $m;exit;
		                }
		            }
	        	}

				$data2 = $this->user_model->user_activities(5,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Reject Legal Notice('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
			
		}
		if($this->input->post('type')=='return'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],'3,4,5','legal_notice_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('legal_notice_sts' => 4,'return_reason_rm'=>trim($_POST['reason']),'checker_id' =>0,'return_by_rm'=> $this->session->userdata['ast_user']['user_id'], 'return_dt_rm'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);
				if ($this->db->affected_rows() > 0) 
				{
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'return')
					{
						$str="SELECT  j0.sl_no,j0.e_by,s.name as legal_notice_sts
									 FROM legal_notice j0
									  LEFT OUTER JOIN ref_status s on(j0.legal_notice_sts=s.id)
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $maker = $application_data->e_by;
		              
						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker."' LIMIT 1";
						$maker=$this->db->query($str1)->row();
						
		                if (!empty($maker->email_address) && $maker->email_address != null) {
		                   $subject="1st Legal Notice Returned!!";
						   $req_type=$application_data->legal_notice_sts;
						   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
						   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
						    Your initiated 1st legal notice has been Returned.<br/><br/>
							Request Type: ".$req_type."<br/>
							Request by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), <br/>
							Request Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/>
							Request for: SL NO:".$application_data->sl_no."<br/><br/>
							Please login to  <a href=".base_url().">LMS Application</a>  to approve the request.<br/><br/> 
							This is a system generated email, no need to reply.<br/><br/>  
							Thanks</div>";
							$m=$this->User_model->send_email("", "", $maker->email_address,"", $subject,$message);
		                }
		            }
	        	}
				$data2 = $this->user_model->user_activities(4,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Return Legal Notice('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		}
		else {
			$this->db->trans_commit();
			$this->db->db_debug = $db_debug;
			return $_POST['deleteEventId'];
		}
	}
	function bulk_acktion()
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = true; // off display of db error
		$this->db->trans_begin(); // transaction start
		if($this->input->post('type')=='Recommend'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['event_id_'.$i],'3,4,5','legal_notice_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('legal_notice_sts' => 3,'life_cycle'=>2,'rec_by'=> $this->session->userdata['ast_user']['user_id'], 'rec_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('legal_notice', $data);
						$data2 = $this->user_model->user_activities(3,'f_legal_notice',$_POST['event_id_'.$i],'legal_notice','Recommend Legal Notice('.$_POST['event_id_'.$i].')');
					}
			 	}
				
			}
		}
		if($this->input->post('type')=='Return'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['event_id_'.$i],'3,4,5','legal_notice_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('legal_notice_sts' => 4,'return_reason_rm'=>trim($_POST['hidden_return_reason']),'checker_id' =>0,'return_by_rm'=> $this->session->userdata['ast_user']['user_id'], 'return_dt_rm'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('legal_notice', $data);
						$data2 = $this->user_model->user_activities(4,'f_legal_notice',$_POST['event_id_'.$i],'legal_notice','Return Legal Notice('.$_POST['event_id_'.$i].')',$_POST['hidden_return_reason']);
					}
			 	}
				
			}
		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		}
		else {
			$this->db->trans_commit();
			$this->db->db_debug = $db_debug;
			return 1;
		}
	}
	function get_bulk_data()
	{
		$where2 = "b.sts!='0'";
		if ($this->input->post('operation')=='recommend') 
		{
			$where2.=" AND b.legal_notice_sts IN(2,9) AND b.checker_id = '".$this->session->userdata['ast_user']['user_id']."'";
		}
	   	if($this->input->post('region')!='' && $this->input->post('region')!=0) 
		{$where2.=" AND b.region = '".trim($this->input->post('region'))."'";}
		if($this->input->post('territory')!='' && $this->input->post('territory')!=0) 
		{$where2.=" AND b.territory = '".trim($this->input->post('territory'))."'";}
		if($this->input->post('district')!='' && $this->input->post('district')!=0) 
		{$where2.=" AND b.district = '".trim($this->input->post('district'))."'";}
		if($this->input->post('unit_office')!='' && $this->input->post('unit_office')!=0) 
		{$where2.=" AND b.unit_office = '".trim($this->input->post('unit_office'))."'";}
	   	if($this->input->post('ini_dt_from') != '' && $this->input->post('ini_dt_from')!=0 && ($this->input->post('ini_dt_to') == '' || $this->input->post('ini_dt_to')==0)) 
		{$where2.=" AND DATE(b.e_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('ini_dt_from')))))."'";}
		if($this->input->post('ini_dt_from') != '' && $this->input->post('ini_dt_from')!=0 && $this->input->post('ini_dt_to') != '' && $this->input->post('ini_dt_to')!=0) 
		{$where2.=" AND DATE(b.e_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('ini_dt_from')))))."' AND DATE(b.e_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('ini_dt_to')))))."'";}
		
		if($this->input->post('loan_segment')!='' && $this->input->post('loan_segment')!='') 
		{$where2.=" AND b.loan_segment = '".trim($this->input->post('loan_segment'))."'";}

		$this->db
    	->select('b.id,b.req_type,b.loan_ac,b.sl_no,s.name as loan_segment,j7.name as region_name,j8.name as territory_name,
    	j9.name as district_name,j10.name as unit_office_name,
    	CONCAT(j5.name," (",j5.user_id,")")as e_by,
    	DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt
    	', FALSE)
			->from("legal_notice b")
			->join('users_info as j5', 'b.e_by=j5.id', 'left')
			->join('ref_region as j7', 'b.region=j7.id', 'left')
			->join('ref_territory as j8', 'b.territory=j8.id', 'left')
			->join('ref_district as j9', 'b.district=j9.id', 'left')
			->join('ref_unit_office as j10', 'b.unit_office=j10.id', 'left')
			->join('ref_loan_segment as s', 'b.loan_segment=s.code', 'left')
			->where($where2)
			->order_by('b.id','DESC');
		$q=$this->db->get();
		return $q->result();
	}

}
?>
