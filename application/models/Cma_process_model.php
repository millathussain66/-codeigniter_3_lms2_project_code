<?php
class Cma_process_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
	}



	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "b.sts!='0' and b.migration_sts<>1 ";  $filterdatafield2 =' ';
	   	if($this->input->get('region')!='' && $this->input->get('region')!=0) 
		{$where2.=" AND b.region = ".$this->db->escape(trim($this->input->get('region')));}
		if($this->input->get('territory')!='' && $this->input->get('territory')!=0) 
		{$where2.=" AND b.territory = ".$this->db->escape(trim($this->input->get('territory')));}
		if($this->input->get('district')!='' && $this->input->get('district')!=0) 
		{$where2.=" AND b.district = ".$this->db->escape(trim($this->input->get('district')));}
		if($this->input->get('unit_office')!='' && $this->input->get('unit_office')!=0) 
		{$where2.=" AND b.unit_office = ".$this->db->escape(trim($this->input->get('unit_office')));}
	   	if($this->input->get('rec_dt_from') != '' && $this->input->get('rec_dt_from')!=0 && ($this->input->get('rec_dt_to') == '' || $this->input->get('rec_dt_to')==0)) 
		{$where2.=" AND DATE(b.rec_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('rec_dt_from')))))."'";}
		if($this->input->get('rec_dt_from') != '' && $this->input->get('rec_dt_from')!=0 && $this->input->get('rec_dt_to') != '' && $this->input->get('rec_dt_to')!=0) 
		{$where2.=" AND DATE(b.rec_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('rec_dt_from')))))."' AND DATE(b.rec_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('rec_dt_to')))))."'";}
		if($this->input->get('status')!='' && $this->input->get('status')!=0) 
		{$where2.=" AND b.cma_sts = '".trim($this->input->get('status'))."'";}
		if($this->input->get('loan_segment')!='' && $this->input->get('loan_segment')!='') 
		{$where2.=" AND b.loan_segment = ".$this->db->escape(trim($this->input->get('loan_segment')));}

		if($this->input->get('cl_bbl')!='') 
		{$where2.=" AND b.cl_bbl = ".$this->db->escape(trim($this->input->get('cl_bbl')));}

		if($this->input->get('outst_range')!='') 
		{
			if ($this->input->get('outst_range')=='0-50000') {
				$where2.=" AND b.outstanding_bl >= 0 AND b.outstanding_bl <= 50000 ";
			}
			else if ($this->input->get('outst_range')=='50000-100000') {
				$where2.=" AND b.outstanding_bl >= 50000 AND b.outstanding_bl <= 100000 ";
			}
			else if ($this->input->get('outst_range')=='100000-500000') {
				$where2.=" AND b.outstanding_bl >= 100000 AND b.outstanding_bl <= 500000 ";
			}
			else if ($this->input->get('outst_range')=='500000-upper') {
				$where2.=" AND b.outstanding_bl >= 500000 ";
			}
			
		}




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
				else if($filterdatafield=='req_type')
				{
					$filterdatafield='j7.name';
				}
				else if($filterdatafield=='proposed_type')
				{
					$filterdatafield='b.proposed_type';
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
					$filterdatafield2 ='j8.user_id';
					$where2 .= " OR ( ".$filterdatafield2 . " LIKE '%" . $filtervalue ."%' )";
				}
				else if($filterdatafield=='return_reason_rm')
				{
					$filterdatafield='b.return_reason_rm';
				}
				
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
	    ->select('SQL_CALC_FOUND_ROWS b.id,IF(b.ho_return_reason IS NOT NULL OR b.return_reason_rm IS NOT NULL OR b.reject_reason_rm IS NOT NULL,1,"") as return_reason,b.req_type as req_type_id,s.name as loan_segment,b.e_by as e_by_id,b.territory,b.region,b.sec_sts,j7.name as req_type,b.proposed_type,b.cma_sts,
	    	IF(b.cma_sts="2",CONCAT(j6.name," (",j8.user_id,")"),j6.name) as status, 
	    	b.reject_reason_rm,b.sl_no,b.loan_ac,b.ac_name,b.return_reason_rm,b.reject_reason_rm,b.ho_return_reason,b.ho_decline_reason,b.holm_r_reason,
	    	b.checker_id,b.sts,b.cif,b.branch_sol,b.ac_name,
	    	CONCAT(j2.name," (",j2.user_id,")")as e_by,
	    	CONCAT(j9.name," (",j9.user_id,")")as sth_by,
	    	CONCAT(j10.name," (",j10.user_id,")")as v_by,
	    	CONCAT(j4.name," (",j4.user_id,")")as stc_by,CONCAT(j5.name," (",j5.user_id,")")as rec_by,
	    	DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
	    	DATE_FORMAT(b.stc_dt,"%d-%b-%y %h:%i %p") AS stc_dt,
	    	DATE_FORMAT(b.rec_dt,"%d-%b-%y %h:%i %p") AS rec_dt,
	    	DATE_FORMAT(b.sth_dt,"%d-%b-%y %h:%i %p") AS sth_dt,
	    	DATE_FORMAT(b.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
	    	', FALSE)
				->from("cma b")
				->join('users_info as j2', 'b.e_by=j2.id', 'left')
				->join('users_info as j4', 'b.stc_by=j4.id', 'left')
				->join('users_info as j5', 'b.rec_by=j5.id', 'left')
				->join('ref_status as j6', 'b.cma_sts=j6.id', 'left')
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
			$str=" SELECT j0.*,f.name as facility_type_name,date_format(j0.outstanding_bl_dt,'%d/%m/%Y') as outstanding_bl_dt,
				date_format(j0.overdue_bl_dt,'%d/%m/%Y') as overdue_bl_dt,
				date_format(j0.call_up_dt,'%d/%m/%Y') as call_up_dt,
				date_format(j0.expire_date,'%d/%m/%Y') as expire_date,
				date_format(j0.disbursement_date,'%d/%m/%Y') as disbursement_date
			FROM cma_facility as j0
			LEFT OUTER JOIN ref_facility_name f ON j0.facility_type=f.id
			WHERE j0.cma_id= ".$id." AND j0.sts='1' AND j0.section_type='card' ORDER BY id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_ln_cost_amount($table_name,$field_name,$id) // get data for edit
	{
		$str=" SELECT j0.$field_name as amount
		FROM $table_name as j0
		WHERE j0.id='".$id."' LIMIT 1";
		$query=$this->db->query($str);
		return $query->row();
	}
	function get_bulk_data()
	{
		$where2 = "b.sts!='0'";
		if ($this->input->post('operation')=='recommend') 
		{
			$where2.=" AND b.cma_sts IN(2,9) AND b.checker_id = '".$this->session->userdata['ast_user']['user_id']."'";
		}
		if($this->input->post('req_type')!='' && $this->input->post('req_type')!=0) 
		{$where2.=" AND b.req_type = '".trim($this->input->post('req_type'))."'";}
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
    	->select('b.id,b.req_type,b.sec_sts,b.loan_ac,b.sl_no,s.name as loan_segment,j7.name as region_name,j8.name as territory_name,
    	j9.name as district_name,j10.name as unit_office_name,
    	CONCAT(j5.name," (",j5.user_id,")")as e_by,
    	DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt
    	', FALSE)
			->from("cma b")
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
	function get_add_action_data($id)
	{
		$this->db
			->select("b.*,", FALSE)
			->from("cma b")
			->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function get_pre_cma_data($loan_ac,$type)
	{
		$where = "j0.sts<>0";
		if($type=='Loan')
		{
			$where.=" AND j0.loan_ac='".$loan_ac."'";
		}
		else
		{
			$where.=" AND j0.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$loan_ac)."'";
		}
		if($loan_ac!=''){
			$str="SELECT j0.id as cma_id,j0.req_type,j0.cma_sts,s.name AS status_name,IF(j0.cma_sts=5 OR j0.cma_sts=12,0,1) as duplicate
				FROM cma AS j0 
				LEFT OUTER JOIN ref_status s ON(j0.cma_sts=s.id)
				WHERE ".$where."
				ORDER BY j0.id DESC LIMIT 1";
			$query=$this->db->query($str);
			$result = $query->row();
			if(!empty($result)) //getting the last activites name and date
			{
				$str="SELECT ac.activities_datetime,
				DATE_FORMAT(ac.activities_datetime,'%d-%b-%y %h:%i %p') AS dt_fromat
				FROM
				user_activities_history ac
				WHERE ac.section_name='cma' AND ac.table_row_id='".$result->cma_id."'
				ORDER BY ac.id DESC LIMIT 1";
				$query2=$this->db->query($str)->row();
				if(!empty($query2))
				{
					$result->activities_datetime=$query2->activities_datetime;
					$result->dt_fromat=$query2->dt_fromat;
				}
				else
				{
					$result->activities_datetime='';
					$result->dt_fromat='';
				}
			}
			if(empty($result))//now checking the migrated data
			{
				$str="SELECT j0.id as cma_id,j0.req_type,j0.cma_sts,CONCAT(s.name,'(Migrated)') AS status_name,'1' as duplicate,DATE_FORMAT(j0.v_dt,'%d-%b-%y %h:%i %p') AS dt_fromat,j0.v_dt as activities_datetime
				FROM cma AS j0 
				LEFT OUTER JOIN ref_status s ON(j0.cma_sts=s.id)
				WHERE ".$where."
				ORDER BY j0.id DESC LIMIT 1";
				$query=$this->db->query($str);
				return $query->row();
			}
			else
			{
				return $result;
			}
		}
		else{return array();}
	}
	function get_facility_info_card($id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT DATE_FORMAT(f.card_issue_dt,'%d-%b-%Y') as card_issue_dt,
			DATE_FORMAT(f.outstanding_bl_dt,'%d-%b-%Y') as outstanding_bl_dt
			,DATE_FORMAT(f.card_exp_dt,'%d-%b-%Y') as card_exp_dt,f.card_limit,f.outstanding_bl,
			f.card_type,f.card_no,f.card_name
			FROM sub_card_data as f
			WHERE f.module_name = 'cma'  AND f.module_id= ".$this->db->escape($id)." ORDER BY f.id ASC";
			$query=$this->db->query($str);
			return $query->result();
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
            $file = $this->Common_model->get_file_name('cma',$field_name,$path);
		}//Taking Old File
		else if (isset($_POST['hidden_'.$field_name.'_value']) && $_POST['hidden_'.$field_name.'_select']=='0') 
		{
			$file = $_POST['hidden_'.$field_name.'_value'];
		}//Taking Full New File
		else
		{
			$file = $this->Common_model->get_file_name('cma',$field_name,$path);
		}
		return $file;
	}
	function add_edit_action($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
        if($editrow==""){$editrow=0;}
		$call_up_file = $this->get_file_name('call_up_file','cma_file/call_up_file/');

		$remarks_file = $this->get_file_name('remarks_file','cma_file/remarks_file/');

		$senction_letter = $this->get_file_name('senction_letter','cma_file/senction_letter/');
	    //CMA Data
	    if ($add_edit=="add") {
	    	$sl_no=$this->user_model->get_unique_serial('cma');
	    }else{$sl_no=$this->security->xss_clean( $this->input->post('sl_no_edit'));}
	    $cma_data = array(
	    	'sl_no' => $sl_no,
	    	'pre_cma_id' =>$this->security->xss_clean( $this->input->post('pre_cma_id')),
			'proposed_type' =>$this->security->xss_clean( $this->input->post('proposed_type')),
			'req_type' =>$this->security->xss_clean( $this->input->post('req_type')),
			'pre_case_type' =>$this->security->xss_clean( $this->input->post('pre_case_type')),
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
			'pre_cma_app_type' =>$this->security->xss_clean( $this->input->post('pre_cma_app_type')),
			'pre_cma_app_dt' =>implode('-',array_reverse(explode('/',$this->input->post('pre_cma_app_dt')))),
			'pre_case_sts' =>$this->security->xss_clean( $this->input->post('pre_case_sts')),
			'disposal_sts' =>$this->security->xss_clean( $this->input->post('disposal_sts')),
			'disposal_remarks' =>$this->security->xss_clean( $this->input->post('disposal_remarks')),
			'judgement_summery' =>$this->security->xss_clean( $this->input->post('judgement_summery')),
			'pre_case_fill_dt' =>implode('-',array_reverse(explode('/',$this->input->post('pre_case_fill_dt')))),
			'loan_sanction_dt' =>implode('-',array_reverse(explode('/',$this->input->post('loan_sanction_dt')))),
			'call_up_serv_dt' =>implode('-',array_reverse(explode('/',$this->input->post('call_up_serv_dt')))),
			'chq_expiry_date' =>implode('-',array_reverse(explode('/',$this->input->post('chq_expiry_date')))),
			'last_payment_date' =>implode('-',array_reverse(explode('/',$this->input->post('last_payment_date')))),
			'cl_bb_card' =>$this->security->xss_clean( $this->input->post('cl_bb_card')),
			'cl_bbl_card' =>$this->security->xss_clean( $this->input->post('cl_bbl_card')),
			'call_up_file' =>$call_up_file,
			'last_payment_amount' =>$this->security->xss_clean( $this->input->post('last_payment_amount')),
			'legal_region' =>$this->security->xss_clean( $this->input->post('legal_region')),
			'region' =>$this->security->xss_clean( $this->input->post('region')),
			'territory' =>$this->security->xss_clean( $this->input->post('territory')),
			'district' =>$this->security->xss_clean( $this->input->post('district')),
			'unit_office' =>$this->security->xss_clean( $this->input->post('unit_office')),
			'case_fill_dist' =>$this->security->xss_clean( $this->input->post('case_fill_dist')),
			'sec_sts' =>$this->security->xss_clean( $this->input->post('sec_sts')),
			'pre_auc_sts' =>$this->security->xss_clean( $this->input->post('pre_auc_sts')),
			'busi_sts' =>$this->security->xss_clean( $this->input->post('busi_sts')),
			'borr_sts' =>$this->security->xss_clean( $this->input->post('borr_sts')),
			//'recovery_am' =>$this->security->xss_clean( $this->input->post('recovery_am')),
			//'int_rate' =>$this->security->xss_clean( $this->input->post('int_rate')),
			'current_dpd' =>$this->security->xss_clean( $this->input->post('current_dpd')),
			'case_logic' =>$this->security->xss_clean( $this->input->post('case_logic')),
			'more_acc_available' =>$this->security->xss_clean( $this->input->post('more_acc_available')),
			'more_acc_number' =>$this->security->xss_clean( $this->input->post('more_acc_number')),
			'chq_sts' =>$this->security->xss_clean( $this->input->post('chq_sts')),
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),
			'remarks_file' =>$remarks_file,
			'senction_letter' =>$senction_letter
		);
	    //'subscription_date'=>implode('-',array_reverse(explode('/',$this->input->post('subscription_date')))),
		
		if($add_edit=="add")
		{
			if ($_POST['proposed_type']=='Card') 
			{
				$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac')); 
				$cma_data['customer_id'] = $this->security->xss_clean( $this->input->post('hidden_customer_id'));
			}
			else{$org_loan_ac='';}
			$cma_data['loan_ac'] = $this->security->xss_clean( $this->input->post('loan_ac'));
			$cma_data['org_loan_ac'] = $org_loan_ac;
			$cma_data['card_iss_date'] = implode('-',array_reverse(explode('/',$this->input->post('card_iss_date'))));
			$cma_data['card_exp_date'] = implode('-',array_reverse(explode('/',$this->input->post('card_exp_date'))));
			$cma_data['outstanding_bl_dt'] = implode('-',array_reverse(explode('/',$this->input->post('outstanding_bl_dt'))));
			$cma_data['card_limit'] = $this->security->xss_clean( $this->input->post('card_limit'));
			$cma_data['outstanding_bl'] = $this->security->xss_clean( $this->input->post('outstanding_bl'));
			$cma_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$cma_data['e_dt'] = date('Y-m-d H:i:s');
			$cma_data['cma_sts'] = 1;
			$this->db->insert('cma', $cma_data);
			$insert_idss = $this->db->insert_id();
			if($insert_idss==0)
			{
				$this->db->trans_rollback();
				$this->db->db_debug = $db_debug;
				return '00';		
			}
			else
			{
				//For All Card Data Insert
				if ($_POST['proposed_type']=='Card') 
				{
					for($i=1;$i<= $_POST['sub_card_counter'];$i++)
					{
						$card_info = array(
						'module_name' => 'cma',
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
				if ($this->input->post('sec_sts')==1 && $this->input->post('req_type')!=1) //For Secured CMA File's
				{
					for($i=1;$i<= $_POST['cma_document_counter'];$i++)
					{
						$file_name = $this->get_file_name($this->input->post('data_field_name_'.$i),'cma_file/document_file/');
						$file_info = array(
						'cma_id' => $insert_idss,
						'sort_order'=>$i,
						'data_field_name' =>$this->security->xss_clean( $this->input->post('data_field_name_'.$i)),
						'file_name' => $file_name
		     			);
		     			$this->db->insert('cma_document_file', $file_info);
		     			$insert_idss2 = $this->db->insert_id();
		     			if($insert_idss2==0)
						{
							$this->db->trans_rollback();
							$this->db->db_debug = $db_debug;
							return '00';		
						}
					}
				}
				for($i=1;$i<= $_POST['guarantor_info_counter'];$i++)
				{
					$guarantor_info = array(
					'cma_id' => $insert_idss,
					'guarantor_type' =>$this->security->xss_clean( $this->input->post('guarantor_type_'.$i)),
					'guarantor_cif' =>$this->security->xss_clean( $this->input->post('ac_no_'.$i)),
					'guarantor_name' => $this->security->xss_clean( $this->input->post('guarantor_name_'.$i)),
					'father_name' => $this->security->xss_clean( $this->input->post('father_name_'.$i)),
					'present_address' => $this->security->xss_clean( $this->input->post('present_address_'.$i)),
					'permanent_address' => $this->security->xss_clean( $this->input->post('permanent_address_'.$i)),
					'business_address' => $this->security->xss_clean( $this->input->post('business_address_'.$i)),
					'guar_sts' => $this->security->xss_clean( $this->input->post('guar_sts_'.$i)),
					'occ_sts' => $this->security->xss_clean( $this->input->post('occ_sts_'.$i)),
	     			);
	     			if ($_POST['guarantor_info_delete_'.$i]!=1) {
	     				$this->db->insert('cma_guarantor', $guarantor_info);
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
						'cma_id' => $insert_idss,
						'ac_number' => $this->input->post('ac_number_'.$i),
						'disbursement_date'=>implode('-',array_reverse(explode('/',$this->input->post('disbursement_date_'.$i)))),
						'expire_date'=>implode('-',array_reverse(explode('/',$this->input->post('expire_date_'.$i)))),
						'disbursed_amount' => $this->input->post('disbursed_amount_'.$i),
		     			'section_type' => 'card'
		     			);
		     			$this->db->insert('cma_facility', $card_facility);
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
							'cma_id' => $insert_idss,
							'ac_number' => $this->input->post('ac_number_'.$i),
							'sch_desc' => $this->input->post('sch_desc_'.$i),
							'ac_name' => $this->input->post('ac_name_'.$i),
							'facility_type' => $this->input->post('facility_type_'.$i),
							'disbursement_date'=>implode('-',array_reverse(explode('/',$this->input->post('disbursement_date_'.$i)))),
							'int_rate' => $this->input->post('int_rate_'.$i),
							'disbursed_amount' => $this->input->post('disbursed_amount_'.$i),
							'expire_date'=>implode('-',array_reverse(explode('/',$this->input->post('expire_date_'.$i)))),
							'disbursed_amount' => $this->security->xss_clean( $this->input->post('disbursed_amount_'.$i)),
							'due_installments' => $this->security->xss_clean( $this->input->post('due_installments_'.$i)),
							'loan_tenor' => $this->security->xss_clean( $this->input->post('loan_tenor_'.$i)),
							'payble' => $this->security->xss_clean( $this->input->post('payble_'.$i)),
							'repayment' => $this->security->xss_clean( $this->input->post('repayment_'.$i)),
							'outstanding_bl' => $this->security->xss_clean( $this->input->post('outstanding_bl_'.$i)),
							'outstanding_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('outstanding_bl_dt_'.$i)))),
							'overdue_bl' => $this->security->xss_clean( $this->input->post('overdue_bl_'.$i)),
							'overdue_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('overdue_bl_dt_'.$i)))),
							'call_up_dt'=>implode('-',array_reverse(explode('/',$this->input->post('call_up_dt_'.$i)))),
							'write_off_dt'=>implode('-',array_reverse(explode('/',$this->input->post('write_off_dt_'.$i)))),
							'write_off_amount' => $this->input->post('write_off_amount_'.$i),
							'recovery_after_Wf' => $this->input->post('recovery_after_Wf_'.$i),
							'cl_bb' => $this->security->xss_clean( $this->input->post('cl_bb_'.$i)),
							'cl_bbl' => $this->security->xss_clean( $this->input->post('cl_bbl_'.$i)),
							'csms_new' => 1,
			     			'section_type' => 'loan'
			     			);
			     			//For insert the new row
			 				if($_POST['facility_info_delete_'.$i]!=1)
			 				{
			 					if ($this->security->xss_clean( $this->input->post('loan_ac'))==$this->input->post('ac_number_'.$i)) 
								{
									$cma_data2=array(
										'outstanding_bl' => $this->security->xss_clean( $this->input->post('outstanding_bl_'.$i)),
										'outstanding_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('outstanding_bl_dt_'.$i)))),
										'cl_bbl' => $this->security->xss_clean( $this->input->post('cl_bbl_'.$i)),
										'int_rate' => $this->input->post('int_rate_'.$i),
									);
									$this->db->where('id', $insert_idss);
									$this->db->update('cma', $cma_data2);
								}
			 					$loan_facility['e_by'] = $this->session->userdata['ast_user']['user_id'];
								$loan_facility['e_dt'] = date('Y-m-d H:i:s');
			 					$this->db->insert('cma_facility', $loan_facility);
			 				}
			     			//$this->db->insert('cma_facility', $loan_facility);
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
			
		    $data2 = $this->user_model->user_activities(1,'cma',$insert_idss,'cma','Initiate CMA('.$insert_idss.')');
		}
		else
		{
			if($_POST['operation']!='ho_update') //When update request comes from field
			{
				$pre_action_result=$this->Common_model->get_pre_action_data('cma',$edit_id,'1,35,2,4,9,103','cma_sts');
				if (count($pre_action_result)<=0) 
				{
					return 'taken';
				}
			}
			
			if ($_POST['proposed_type']=='Loan' && $_POST['facility_info_counter']!=0) 
			{
				for($i=1;$i<= $_POST['facility_info_counter'];$i++)
				{
					
					$loan_facility = array(
					'disbursement_date'=>implode('-',array_reverse(explode('/',$this->input->post('disbursement_date_'.$i)))),
					'disbursed_amount' => $this->input->post('disbursed_amount_'.$i),
					'expire_date'=>implode('-',array_reverse(explode('/',$this->input->post('expire_date_'.$i)))),
					'int_rate' => $this->security->xss_clean( $this->input->post('int_rate_'.$i)),
					'loan_tenor' => $this->security->xss_clean( $this->input->post('loan_tenor_'.$i)),
					'payble' => $this->security->xss_clean( $this->input->post('payble_'.$i)),
					'repayment' => $this->security->xss_clean( $this->input->post('repayment_'.$i)),
					'outstanding_bl' => $this->security->xss_clean( $this->input->post('outstanding_bl_'.$i)),
					'outstanding_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('outstanding_bl_dt_'.$i)))),
					'overdue_bl' => $this->security->xss_clean( $this->input->post('overdue_bl_'.$i)),
					'overdue_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('overdue_bl_dt_'.$i)))),
					'call_up_dt'=>implode('-',array_reverse(explode('/',$this->input->post('call_up_dt_'.$i)))),
					'write_off_dt'=>implode('-',array_reverse(explode('/',$this->input->post('write_off_dt_'.$i)))),
					'write_off_amount' => $this->input->post('write_off_amount_'.$i),
					'recovery_after_Wf' => $this->input->post('recovery_after_Wf_'.$i),
					'cl_bb' => $this->security->xss_clean( $this->input->post('cl_bb_'.$i)),
					'cl_bbl' => $this->security->xss_clean( $this->input->post('cl_bbl_'.$i)),
					'csms_new' => $this->input->post('csms_new_'.$i),
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
						$this->db->update('cma_facility', $loan_facility);
	 				}
	 				//For update the old row
	 				else if($_POST['facility_info_edit_'.$i]!=0 && $_POST['facility_info_delete_'.$i]!=1)
	 				{
	 					if ($_POST['proposed_type']=='Loan') {
							if ($this->security->xss_clean( $this->input->post('loan_ac'))==$this->input->post('ac_number_'.$i)) 
							{
								$cma_data2=array(
									'outstanding_bl' => $this->security->xss_clean( $this->input->post('outstanding_bl_'.$i)),
									'outstanding_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('outstanding_bl_dt_'.$i)))),
									'cl_bbl' => $this->security->xss_clean( $this->input->post('cl_bbl_'.$i)),
									'int_rate' => $this->input->post('int_rate_'.$i),
								);
								$this->db->where('id', $edit_id);
								$this->db->update('cma', $cma_data2);
							}
						}
	 					$loan_facility['u_by'] = $this->session->userdata['ast_user']['user_id'];
						$loan_facility['u_dt'] = date('Y-m-d H:i:s');
	 					$this->db->where('id',$_POST['facility_info_edit_'.$i]);
	 					$this->db->where('section_type','loan');
						$this->db->update('cma_facility', $loan_facility);
	 				}
	 				//For insert the new row
	 				else if($_POST['facility_info_edit_'.$i]==0 && $_POST['facility_info_delete_'.$i]!=1)
	 				{
	 					$loan_facility['e_by'] = $this->session->userdata['ast_user']['user_id'];
						$loan_facility['e_dt'] = date('Y-m-d H:i:s');
	 					$this->db->insert('cma_facility', $loan_facility);
	 				}
				}
			}
			$security_change_sts = 0;
			$str="SELECT  j0.sec_sts
		                         FROM cma j0
		                     WHERE j0.id='".$edit_id."' LIMIT 1";
		            $old_data=$this->db->query($str)->row();
		   if($this->input->post('sec_sts')!=$old_data->sec_sts)
		   {
		   	$security_change_sts = 1;
		   }
	  		$cma_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$cma_data['u_dt'] = date('Y-m-d H:i:s');
			if($_POST['operation']!='ho_update') //When update request comes from field
			{
				$cma_data['cma_sts'] = 35;
			}
			
			$this->db->where('id', $edit_id);
			$this->db->update('cma', $cma_data);
			$insert_idss = $edit_id;
			if($this->db->affected_rows()==0)
			{
				$this->db->trans_rollback();
				$this->db->db_debug = $db_debug;
				return '00';		
			}
	  		else
	  		{
	  			if ($this->input->post('sec_sts')==1 && $this->input->post('req_type')!=1) //For Secured CMA File's
				{
					for($i=1;$i<= $_POST['cma_document_counter'];$i++)
					{
						$file_name = $this->get_file_name($this->input->post('data_field_name_'.$i),'cma_file/document_file/');
						// echo $file_name;
						// exit;
						$file_info = array(
						'cma_id' => $insert_idss,
						'sort_order'=>$i,
						'data_field_name' =>$this->security->xss_clean( $this->input->post('data_field_name_'.$i)),
						'file_name' => $file_name
		     			);
		     			//$this->db->where('id',$this->input->post('hidden_'.$this->input->post('data_field_name_'.$i).'_id'));
						//$this->db->update('cma_document_file', $file_info);
		     			//if ($this->input->post('hidden_'.$this->input->post('data_field_name_'.$i).'_id')!='') {//Update the old file
		     			if ($security_change_sts ==0) {	//For Update the old file
		     				$this->db->where('id',$this->input->post('hidden_'.$this->input->post('data_field_name_'.$i).'_id'));
							$this->db->update('cma_document_file', $file_info);
		     			}
		     			else //Insert new file
		     			{
		     				$this->db->insert('cma_document_file', $file_info);
		     				$insert_idss2 = $this->db->insert_id();
		     			}
		     			
					}
				}
				else//Delete the initieted doc file for unsecured
				{
					for($i=1;$i<= $_POST['cma_document_counter'];$i++)
					{
						if ($this->input->post('hidden_'.$this->input->post('data_field_name_'.$i).'_id')!='') {
							if ($this->input->post('hidden_'.$this->input->post('data_field_name_'.$i).'_value')!='') {
								$path = "cma_file/document_file/".$this->input->post('hidden_'.$this->input->post('data_field_name_'.$i).'_value');	  
							    //chmod($path, 0777);
							    if (file_exists($path)) {
					            	unlink($path);
					            }
				     			 
							}
							$str="Delete from cma_document_file where id ='".$this->input->post('hidden_'.$this->input->post('data_field_name_'.$i).'_id')."'";
		  					$query=$this->db->query($str);
						}
						
					}
				}
	  			//Gurantor Data Update
				for($i=1;$i<= $_POST['guarantor_info_counter_edit'];$i++)
				{
					$guarantor_info = array(
					'cma_id' => $insert_idss,
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
						$this->db->update('cma_guarantor', $data);
	 				}
	 				//For update the old row
	 				else if($_POST['guarantor_info_edit_'.$i]!=0 && $_POST['guarantor_info_delete_'.$i]!=1)
	 				{
	 					$this->db->where('id',$_POST['guarantor_info_edit_'.$i]);
						$this->db->update('cma_guarantor', $guarantor_info);
	 				}
	 				//For insert the new row
	 				else if($_POST['guarantor_info_edit_'.$i]==0 && $_POST['guarantor_info_delete_'.$i]==0)
	 				{
	 					$this->db->insert('cma_guarantor', $guarantor_info);
	 				}
	     			
				}
	  		}

	       $data2 = $this->user_model->user_activities(35,'cma',$insert_idss,'cma','Update CMA('.$insert_idss.')');

		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return '00';
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
			->select("j0.*,pre_cma.req_type as pre_req_type,IF(pre_cma.cma_sts=5 OR pre_cma.cma_sts=12,0,1) as pre_block_sts,date_format(j0.pre_cma_app_dt,'%d/%m/%Y') as pre_cma_app_dt_format", FALSE)
			->from('cma as j0')
			->join('cma as pre_cma', 'j0.pre_cma_id=pre_cma.id', 'left')
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
			->select("j0.*,a.ln_cost,a.paper_vendor as paper_vendor_id,a.paper_name as paper_name_id,a.complete_remarks,a.auction_sign_memo,j0.lawyer as lawyer_id,j0.sec_sts as sec_sts_id,a.auction_date,a.paper_date,a.auction_time,a.auction_address,a.paper_remarks,a.paper_name,a.paper_vendor,a.lawyer,a.ln_serve_dt,a.ln_expiry_dt,a.ln_scan_copy,a.legal_checker_id,auc.name as pre_auc_sts,a.auction_sts,j0.cma_sts as sts,j15.name as cma_sts,CONCAT(j13.name,' (',j13.code,')') as branch_sol,
				j1.name as region_name,j2.name as territory_name,j3.name as district_name,
				j29.name as busi_sts,j30.name as borr_sts,j31.name as case_logic,j32.name as chq_sts,
				j4.name as unit_office_name,r2.name as legal_region_name,j28.name as sec_sts,
				cs.name as pre_case_sts,j26.name as pre_case_type,j27.name as disposal_sts,
				j6.name as subject_name,j7.name as loan_segment,j8.name as e_by,
				j34.name as lawyer_name,DATE_FORMAT(a.ln_serve_dt,'%d-%b-%y') AS ln_serve_dt_format,
				DATE_FORMAT(a.ln_expiry_dt,'%d-%b-%y') AS ln_expiry_dt_format,j38.name as paper_vendor,
				j46.name as lawyer_legal,j0.req_type as requisition,
				aucsts.name as auction_team_auction_sts,
				j39.name as paper_name,j47.name as case_file_district,
				CONCAT(j33.name,' (',j33.pin,')') as st_auch_by,
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
				CONCAT(j35.name,' (',j35.pin,')') as auc_stc_by,
				CONCAT(j36.name,' (',j36.pin,')') as auc_v_by,
				CONCAT(j37.name,' (',j37.pin,')') as legal_response_by,
				CONCAT(j25.name,' (',j25.pin,')') as auction_complete_by,
				CONCAT(j40.name,' (',j40.pin,')') as auc_ack_by,
				CONCAT(j41.name,' (',j41.pin,')') as auc_st_l_by,
				CONCAT(j42.name,' (',j42.pin,')') as auc_comp_by,
				CONCAT(j43.name,' (',j43.pin,')') as sthoops_by,
				CONCAT(j44.name,' (',j44.pin,')') as deliver_by,
				CONCAT(j45.name,' (',j45.pin,')') as legal_ack_by,
				CONCAT(j48.name,' (',j48.pin,')') as reassigned_legal_user,
				CONCAT(j49.name,' (',j49.pin,')') as reassign_by,
				CONCAT(j50.name,' (',j50.pin,')') as hoops_hold_by,
				CONCAT(j51.name,' (',j51.pin,')') as account_close_by,
				CONCAT(j52.name,' (',j52.pin,')') as file_deliver_to,
				CONCAT(j55.name,' (',j55.pin,')') as auction_status_update_by,
				DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,r.name as req_type,
				DATE_FORMAT(j0.loan_sanction_dt,'%d-%b-%y') AS loan_sanction_dt,
				DATE_FORMAT(j0.file_close_dt,'%d-%b-%y') AS account_close_dt,
				DATE_FORMAT(j0.file_close_dt,'%d-%b-%y') AS account_close_dt,
				DATE_FORMAT(a.auc_sts_update_dt,'%d-%b-%y %h:%i %p') AS auc_sts_update_dt,
				DATE_FORMAT(a.stc_dt,'%d-%b-%y %h:%i %p') AS st_auch_dt,
				DATE_FORMAT(j0.pre_cma_app_dt,'%d-%b-%y') AS pre_cma_app_dt,
				DATE_FORMAT(j0.pre_case_fill_dt,'%d-%b-%y') AS pre_case_fill_dt,
				DATE_FORMAT(j0.last_payment_date,'%d-%b-%y') AS last_payment_date,
				DATE_FORMAT(j0.call_up_serv_dt,'%d-%b-%y') AS call_up_serv_dt,
				DATE_FORMAT(j0.return_dt_rm,'%d-%b-%y %h:%i %p') AS r_dt,
				DATE_FORMAT(j0.reject_dt_rm,'%d-%b-%y %h:%i %p') AS reject_dt_rm,
				DATE_FORMAT(j0.ack_dt,'%d-%b-%y %h:%i %p') AS ack_dt,
				DATE_FORMAT(j0.hold_dt,'%d-%b-%y %h:%i %p') AS hold_dt,
				DATE_FORMAT(j0.chq_expiry_date,'%d-%b-%y') AS chq_expiry_date,
				DATE_FORMAT(j0.sth_dt,'%d-%b-%y %h:%i %p') AS sth_dt,
				DATE_FORMAT(j0.q_dt,'%d-%b-%y %h:%i %p') AS q_dt,
				DATE_FORMAT(j0.ho_r_dt,'%d-%b-%y %h:%i %p') AS ho_r_dt,
				DATE_FORMAT(j0.v_dt,'%d-%b-%y %h:%i %p') AS v_dt,
				DATE_FORMAT(a.ack_dt,'%d-%b-%y %h:%i %p') AS auction_complete_dt,
				DATE_FORMAT(j0.holm_r_dt,'%d-%b-%y %h:%i %p') AS holm_r_dt,
				DATE_FORMAT(j0.ho_decline_dt,'%d-%b-%y %h:%i %p') AS ho_decline_dt,
				DATE_FORMAT(a.stc_dt,'%d-%b-%y %h:%i %p') AS auc_stc_dt,
				DATE_FORMAT(a.legal_response_dt,'%d-%b-%y %h:%i %p') AS legal_response_dt,
				DATE_FORMAT(a.auction_v_dt,'%d-%b-%y %h:%i %p') AS auction_v_dt,
				DATE_FORMAT(a.paper_date,'%d-%b-%y') AS paper_date,
				DATE_FORMAT(a.auction_date,'%d-%b-%y') AS auction_date,
				DATE_FORMAT(a.ack_dt,'%d-%b-%y %h:%i %p') AS auc_ack_dt,
				DATE_FORMAT(a.auc_st_l_dt,'%d-%b-%y %h:%i %p') AS auc_st_l_dt,
				DATE_FORMAT(j0.sthoops_dt,'%d-%b-%y %h:%i %p') AS sthoops_dt,
				DATE_FORMAT(j0.deliver_dt,'%d-%b-%y %h:%i %p') AS deliver_dt,
				DATE_FORMAT(a.auction_complete_dt,'%d-%b-%y %h:%i %p') AS auction_complete_dt,
				TIME_FORMAT(a.auction_time,'%h:%i %p') AS auction_time,
				DATE_FORMAT(j0.legal_ack_dt,'%d-%b-%y %h:%i %p') AS legal_ack_dt,
				DATE_FORMAT(j0.ln_sent_date,'%d-%b-%y %h:%i %p') AS ln_sent_date,
				DATE_FORMAT(j0.ln_val_dt,'%d-%b-%y %h:%i %p') AS ln_val_dt,
				DATE_FORMAT(j0.ln_val_dt,'%d-%b-%y %h:%i %p') AS ln_val_dt,
				DATE_FORMAT(j0.legal_reassign_dt,'%d-%b-%y %h:%i %p') AS legal_reassign_dt", FALSE)
			->from('cma as j0')
			->join('ref_auc_sts as auc', 'j0.pre_auc_sts=auc.id', 'left')
			->join('cma_auction as a', 'j0.id=a.cma_id', 'left')
			->join("users_info as j25", "a.ack_by=j25.id", "left")
			->join('ref_req_type as r', 'j0.req_type=r.id', 'left')
			->join("ref_region as j1", "j0.region=j1.id", "left")
			->join("ref_legal_region as r2", "j0.legal_region=r2.id", "left")
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
			->join("ref_status as j15", "j0.cma_sts=j15.id", "left")
			->join("users_info as j16", "j0.reject_by_rm=j16.id", "left")
			->join("users_info as j17", "j0.ack_by=j17.id", "left")
			->join("users_info as j18", "j0.hold_by=j18.id", "left")
			->join("users_info as j19", "j0.sth_by=j19.id", "left")
			->join("users_info as j20", "j0.q_by=j20.id", "left")
			->join("users_info as j21", "j0.ho_r_by=j21.id", "left")
			->join("users_info as j22", "j0.v_by=j22.id", "left")
			->join("users_info as j23", "j0.holm_r_by=j23.id", "left")
			->join("users_info as j24", "j0.ho_decline_by=j24.id", "left")
			->join("users_info as j50", "j0.hoops_hold_by=j50.id", "left")
			->join("users_info as j51", "j0.file_close_by=j51.id", "left")
			->join("users_info as j52", "j0.legal_user=j52.id", "left")
			->join("ref_case_sts as cs", "j0.pre_case_sts=cs.id", "left")
			->join("ref_req_type as j26", "j0.pre_case_type=j26.id", "left")
			->join("ref_disposal_sts as j27", "j0.disposal_sts=j27.id", "left")
			->join("ref_sec_sts as j28", "j0.sec_sts=j28.id", "left")
			->join("ref_busi_sts as j29", "j0.busi_sts=j29.id", "left")
			->join("ref_borr_sts as j30", "j0.borr_sts=j30.id", "left")
			->join("ref_case_logic as j31", "j0.case_logic=j31.id", "left")
			->join("ref_chq_sts as j32", "j0.chq_sts=j32.id", "left")
			->join("users_info as j33", "a.stc_by=j33.id", "left")
			->join("ref_lawyer as j34", "a.lawyer=j34.id", "left")
			->join("users_info as j35", "a.stc_by=j35.id", "left")
			->join("users_info as j36", "a.auction_v_by=j36.id", "left")
			->join("users_info as j55", "a.auc_sts_update_by=j55.id", "left")
			->join("users_info as j37", "a.legal_response_by=j37.id", "left")
			->join("ref_paper_vendor as j38", "a.paper_vendor=j38.id", "left")
			->join('ref_auc_sts as aucsts', 'a.auction_sts=aucsts.id', 'left')
			->join("ref_paper as j39", "a.paper_name=j39.id", "left")
			->join("users_info as j40", "a.ack_by=j40.id", "left")
			->join("users_info as j41", "a.auc_st_l_by=j41.id", "left")
			->join("users_info as j42", "a.auction_complete_by=j42.id", "left")
			->join("users_info as j43", "j0.sthoops_by=j43.id", "left")
			->join("users_info as j44", "j0.deliver_by=j44.id", "left")
			->join("users_info as j45", "j0.legal_ack_by=j45.id", "left")
			->join("ref_lawyer as j46", "j0.lawyer=j46.id", "left")
			->join("ref_legal_district as j47", "j0.case_fill_dist=j47.id", "left")
			->join("users_info as j48", "j0.temp_legal_user=j48.id", "left")
			->join("users_info as j49", "j0.legal_reassign_by=j49.id", "left")
			->where("j0.id='".$id."'",NULL,FALSE)
			->limit(1);
			return  $this->db->get()->row();
		}
		else{return NULL;}
	}
	function get_auction_details_by_cma($id) // get data for edit
	{
		if($id!=''){
			$this->db
			->select("a.loan_ac,a.cif,a.complete_remarks,a.auction_sign_memo,a.auction_date,a.paper_date,
				a.auction_time,a.auction_address,a.paper_remarks,a.auction_remarks,
				a.ln_serve_dt,a.ln_expiry_dt,a.ln_scan_copy,a.legal_checker_id,
				a.auction_sts,j34.name as lawyer_name,DATE_FORMAT(a.ln_serve_dt,'%d-%b-%y') AS ln_serve_dt_format,
				DATE_FORMAT(a.ln_expiry_dt,'%d-%b-%y') AS ln_expiry_dt_format,j38.name as paper_vendor,
				j39.name as paper_name,
				CONCAT(j33.name,' (',j33.pin,')') as st_auch_by,
				CONCAT(j35.name,' (',j35.pin,')') as auc_stc_by,
				CONCAT(j36.name,' (',j36.pin,')') as auc_v_by,
				CONCAT(j37.name,' (',j37.pin,')') as legal_response_by,
				CONCAT(j25.name,' (',j25.pin,')') as auction_complete_by,
				CONCAT(j40.name,' (',j40.pin,')') as auc_ack_by,
				CONCAT(j41.name,' (',j41.pin,')') as auc_st_l_by,
				CONCAT(j42.name,' (',j42.pin,')') as auc_comp_by,
				DATE_FORMAT(a.stc_dt,'%d-%b-%y %h:%i %p') AS st_auch_dt,
				DATE_FORMAT(a.auction_v_dt,'%d-%b-%y %h:%i %p') AS auction_v_dt,
				DATE_FORMAT(a.ack_dt,'%d-%b-%y %h:%i %p') AS auction_complete_dt,
				DATE_FORMAT(a.stc_dt,'%d-%b-%y %h:%i %p') AS auc_stc_dt,
				DATE_FORMAT(a.legal_response_dt,'%d-%b-%y %h:%i %p') AS legal_response_dt,
				DATE_FORMAT(a.auction_v_dt,'%d-%b-%y %h:%i %p') AS auction_v_dt,
				DATE_FORMAT(a.paper_date,'%d-%b-%y') AS paper_date,
				DATE_FORMAT(a.auction_date,'%d-%b-%y') AS auction_date,
				DATE_FORMAT(a.ack_dt,'%d-%b-%y %h:%i %p') AS auc_ack_dt,
				DATE_FORMAT(a.auc_st_l_dt,'%d-%b-%y %h:%i %p') AS auc_st_l_dt,
				DATE_FORMAT(a.auction_complete_dt,'%d-%b-%y %h:%i %p') AS auction_complete_dt,
				TIME_FORMAT(a.auction_time,'%h:%i %p') AS auction_time", FALSE)
			->from('cma_auction as a')
			->join("users_info as j25", "a.ack_by=j25.id", "left")
			->join("users_info as j33", "a.stc_by=j33.id", "left")
			->join("ref_lawyer as j34", "a.lawyer=j34.id", "left")
			->join("users_info as j35", "a.stc_by=j35.id", "left")
			->join("users_info as j36", "a.auction_v_by=j36.id", "left")
			->join("users_info as j37", "a.legal_response_by=j37.id", "left")
			->join("ref_paper_vendor as j38", "a.paper_vendor=j38.id", "left")
			->join("ref_paper as j39", "a.paper_name=j39.id", "left")
			->join("users_info as j40", "a.ack_by=j40.id", "left")
			->join("users_info as j41", "a.auc_st_l_by=j41.id", "left")
			->join("users_info as j42", "a.auction_complete_by=j42.id", "left")
			->where("a.cma_id='".$id."'",NULL,FALSE)
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
			FROM cma_guarantor g
			LEFT OUTER JOIN ref_guar_type t on(g.guarantor_type=t.code)
			LEFT OUTER JOIN ref_guar_sts s on(g.guar_sts=s.id)
			LEFT OUTER JOIN ref_guar_occ o on(g.occ_sts=o.code)
			WHERE g.sts = '1'  AND g.cma_id= ".$this->db->escape($id)." ORDER BY g.id ASC";
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
			WHERE r.table_row_id= ".$this->db->escape($id)." AND (r.section_name='cma' OR r.section_name='auction' OR (r.section_name='suit_file' AND r.table_name<>'change_request'))  ".$where."  ORDER BY r.id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_facility_info($add_edit,$id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT f.*,f1.name as facility_type_name,DATE_FORMAT(f.disbursement_date,'%d-%b-%y') as disbursement_date
			,DATE_FORMAT(f.expire_date,'%d-%b-%y') as expire_date
			,DATE_FORMAT(f.write_off_dt,'%d-%b-%y') as write_off_dt
			,DATE_FORMAT(f.outstanding_bl_dt,'%d-%b-%y') as outstanding_bl_dt
			,DATE_FORMAT(f.overdue_bl_dt,'%d-%b-%y') as overdue_bl_dt
			,DATE_FORMAT(f.call_up_dt,'%d-%b-%y') as call_up_dt
			FROM cma_facility as f
			LEFT OUTER JOIN ref_facility_name as f1 on (f1.code=f.facility_type)
			WHERE f.sts = '1'  AND f.cma_id= ".$this->db->escape($id)." ORDER BY f.id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_cma_doc_files($id,$condition=NULL) // get data for edit
	{
		if ($condition!=NULL) {
			$where=$condition;
		}else
		{
			$where="";
		}
		if($id!=''){
			$str=" SELECT f.*,d.name as org_document_name
			FROM cma_document_file as f
			LEFT OUTER JOIN ref_cma_document d on(d.data_field_name=f.data_field_name)
			WHERE f.cma_id= ".$this->db->escape($id)." ".$where." ORDER BY f.sort_order ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_court_fee_details($id) // get data for edit
	{
		
		if($id!=''){
			$str=" SELECT f.id,f.amount
			FROM cost_details as f
			WHERE f.memo_sts=0 AND f.vendor_type=4 AND f.activities_id=1 AND f.module_name='suit_file' AND f.main_table_name='cma' AND f.main_table_id= ".$this->db->escape($id)." LIMIT 1";
			$query=$this->db->query($str);
			return $query->row();
		}
		else{return NULL;}
	}
	function delete_action()
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start

		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('d_reason'=>trim($_POST['comments']),	'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma', $data);
				$data2 = $this->user_model->user_activities(15,'cma',$this->input->post('deleteEventId'),'cma','Delete CMA('.$this->input->post('deleteEventId').')',$_POST['comments']);
			}
		}
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],2,'cma_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('cma_sts' => '2', 'stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'checker_id' => $this->input->post('checker_to_notify'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma', $data);
				if ($this->db->affected_rows() > 0) 
				{
					//Sending Sms to recommender
					if (isset($_POST['sms_notification']) && $this->input->post('sms_notification') == 'sms')
					{
						$str="SELECT  j0.sl_no
									 FROM legal_notice j0
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $checker_id = $this->input->post('checker_to_notify');
		              
						$str1 = "SELECT  j0.mobile_number,j0.id FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$checker_id."' LIMIT 1";
						$checker_info=$this->db->query($str1)->row();
						
		                if (!empty($checker_info->mobile_number) && $checker_info->mobile_number != null) {
						   $message = "Need your recommendation for CMA ( :".$application_data->sl_no." )";
							$sms_history = array(
							'product_type' => 'cma',
							'product_id' => $this->input->post('deleteEventId'),
							'send_by'=>$this->session->userdata['ast_user']['user_id'],
							'send_dt'=>date('Y-m-d H:i:s'),
							'received_by' => $checker_info->id,
			     			'received_dt' => date('Y-m-d H:i:s')
			     			);
			     			$this->db->insert('sms_history', $sms_history);
			     			$history_id = $this->db->insert_id();
			     			$this->load->library('WebService');
							$ws = new WebService();
							//$dev_live='liv';
							$dev_live='dev';
							$api_url='https://lmstest.bracbank.com/lms/UBA/SendNotification/V1?wsdl';
							$user_id='LMS';
							$channel_id='LMS';
							$password='Ahj67#12i89kT!z';
							$sms_response=$ws->call_service('SendSms',$dev_live,$api_url,$user_id,$channel_id,$password,$checker_info->mobile_number,$message);
		                	if ($sms_response['message'][0]=='000') {
		                		$status='success';
		                	}
		                	else
		                	{
		                		$status='failed';
		                	}
		                	$sms_history['status'] = $status;
							$this->db->where('id', $history_id);
							$this->db->update('sms_history', $sms_history);
		                }
		            }
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'email')
					{
						$str="SELECT  j0.sl_no,s.name as cma_sts
									 FROM cma j0
									 LEFT OUTER JOIN ref_status s on(j0.cma_sts=s.id)
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $checker_id = $this->input->post('checker_to_notify');
		              
						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$checker_id."' LIMIT 1";
						$checker_info=$this->db->query($str1)->row();
						
		                if (!empty($checker_info->email_address) && $checker_info->email_address != null) {
		                   $subject="Request for Approval";
						   $req_type=$application_data->cma_sts;
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
							$m=$this->User_model->send_email("", "", $checker_info->email_address,"", $subject,$message);
							
							//echo $m;exit;
		                }
		            }
	        	}
				$data2 = $this->user_model->user_activities(2,'cma',$this->input->post('deleteEventId'),'cma','Sentochecker CMA('.$this->input->post('deleteEventId').')');
				
				$application_data = $this->db->query("SELECT loan_ac from cma where id='".$_POST['deleteEventId']."'")->row();
	        	
	        	$subject = "Need your Recommendation for CMA on this A/C-".$application_data->loan_ac;
	        	$url = base_url()."cma_process/details";
	        	$data2 = $this->Common_model->push_notification_data($subject,$url,'cma',$_POST['deleteEventId'],date('Y-m-d'),'',$this->input->post('checker_to_notify'),'1');
			}
		}
		if($this->input->post('type')=='recommend'){
			$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'3,24,4,5','cma_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				//Getting if any auction competed for this cma 
				$str1 = "SELECT  j0.id,j0.auction_sts FROM cma_auction j0 WHERE j0.cma_id= '".$this->input->post('deleteEventId')."' LIMIT 1";
				$pre_auction_data=$this->db->query($str1)->row();
				$query1 ="SELECT j0.loan_ac,j0.cif,j0.branch_sol,j0.region,j0.territory,j0.district,j0.unit_office
					FROM cma AS j0
					WHERE j0.id='".$_POST['deleteEventId']."' AND j0.sts='1' LIMIT 1";
					$Q1 = $this->db->query($query1);
					$query1Result = $Q1->result();
					$Arr = $Q1->row();
					 $cma_data = array(
			    	'cma_id' => $_POST['deleteEventId'],
					'loan_ac' =>$Arr->loan_ac,
					'cif' =>$Arr->cif,
					'branch_sol' =>$Arr->branch_sol,
					'region' =>$Arr->region,
					'territory' =>$Arr->territory,
					'district' =>$Arr->district,
					'unit_office' =>$Arr->unit_office,
					'auction_sts' =>24,
					'life_cycle' =>24,
					);
				//auction data exists and auction successfully competed
				if (!empty($pre_auction_data) && $pre_auction_data->auction_sts!=103) {
					$cma_sts=3;$desc="Recommend CMA";$life_cycle=2;
				}
				//When this is a fresh request for auction
				else if(empty($pre_auction_data) && $_POST['security_sts']==1 && ($_POST['case_type']==2 || $_POST['case_type']==5))
				{
					$desc="Send To Auction Team";
					$cma_sts=24;
					
					$this->db->insert('cma_auction', $cma_data);
					$life_cycle=1;
				}
				//When auction data exists and it was returned by auction team
				else if(!empty($pre_auction_data) && $pre_auction_data->auction_sts==103 && $_POST['security_sts']==1 && ($_POST['case_type']==2 || $_POST['case_type']==5))
				{
					$desc="Send To Auction Team";
					$cma_sts=24;
					$this->db->where('id', $pre_auction_data->id);
					$this->db->update('cma_auction', $cma_data);
					$life_cycle=1;
				}
				//when this is an unsecured file and no need auction
				else{$cma_sts=3;$desc="Recommend CMA";$life_cycle=2;}
				$data = array('cma_sts' => $cma_sts,'life_cycle'=>$life_cycle,'rec_by'=> $this->session->userdata['ast_user']['user_id'], 'rec_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma', $data);
				$data2 = $this->user_model->user_activities(3,'cma',$this->input->post('deleteEventId'),'cma','Recommend CMA('.$this->input->post('deleteEventId').')');
			}
			
		}
		if($this->input->post('type')=='reject'){
			$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'3,24,4,5','cma_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('cma_sts' => 5,'reject_reason_rm'=>trim($_POST['reason']),'reject_by_rm'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt_rm'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma', $data);
				if ($this->db->affected_rows() > 0) 
				{
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'reject')
					{
						$str="SELECT  j0.sl_no,j0.e_by,s.name as cma_sts
									 FROM cma j0
									 LEFT OUTER JOIN ref_status s on(j0.cma_sts=s.id)
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $maker = $application_data->e_by;
		              
						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker."' LIMIT 1";
						$maker=$this->db->query($str1)->row();
						
		                if (!empty($maker->email_address) && $maker->email_address != null) {
		                   $subject="CMA Declined!!";
						   $req_type=$application_data->cma_sts;
						   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
						   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
						    Your initiated CMA has been Declined.<br/><br/>
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

				$data2 = $this->user_model->user_activities(5,'cma',$this->input->post('deleteEventId'),'cma','Reject CMA('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
			
		}
		if($this->input->post('type')=='return'){
			$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'3,24,4,5','cma_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('cma_sts' => 4,'return_reason_rm'=>trim($_POST['reason']),'checker_id' =>0,'return_by_rm'=> $this->session->userdata['ast_user']['user_id'], 'return_dt_rm'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma', $data);
				if ($this->db->affected_rows() > 0) 
				{
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'return')
					{
						$str="SELECT  j0.sl_no,j0.e_by,s.name as cma_sts
									 FROM cma j0
									  LEFT OUTER JOIN ref_status s on(j0.cma_sts=s.id)
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $maker = $application_data->e_by;
		              
						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker."' LIMIT 1";
						$maker=$this->db->query($str1)->row();
						
		                if (!empty($maker->email_address) && $maker->email_address != null) {
		                   $subject="CMA Returned!!";
						   $req_type=$application_data->cma_sts;
						   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
						   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
						    Your initiated CMA has been Returned.<br/><br/>
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
				$data2 = $this->user_model->user_activities(4,'cma',$this->input->post('deleteEventId'),'cma','Return CMA('.$this->input->post('deleteEventId').')',$_POST['reason']);
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
			 		$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['event_id_'.$i],'3,24,4,5','cma_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						//For Auction Module
						//Getting if any auction competed for this cma 
						$str1 = "SELECT  j0.id FROM cma_auction j0 WHERE j0.cma_id= '".$_POST['event_id_'.$i]."' LIMIT 1";
						$pre_auction_data=$this->db->query($str1)->row();
						//For Auction Module
						if (!empty($pre_auction_data)) {
							$cma_sts=3;$desc="Recommend CMA";$life_cycle=2;
						}
						else if ($_POST['security_sts_'.$i]==1 && ($_POST['case_type_'.$i]==2 || $_POST['case_type_'.$i]==5)) {
							$desc="Send To Auction Team";
							$cma_sts=24;
							$query1 ="SELECT j0.loan_ac,j0.cif,j0.branch_sol,j0.region,j0.territory,j0.district,j0.unit_office
							FROM cma AS j0
							WHERE j0.id='".$_POST['event_id_'.$i]."' AND j0.sts='1' LIMIT 1";
							$Q1 = $this->db->query($query1);
							$query1Result = $Q1->result();
							$Arr = $Q1->row();
							 $cma_data = array(
					    	'cma_id' => $_POST['event_id_'.$i],
							'loan_ac' =>$Arr->loan_ac,
							'cif' =>$Arr->cif,
							'branch_sol' =>$Arr->branch_sol,
							'region' =>$Arr->region,
							'territory' =>$Arr->territory,
							'district' =>$Arr->district,
							'unit_office' =>$Arr->unit_office,
							'auction_sts' =>24,
							'life_cycle' =>24,
							);
							$this->db->insert('cma_auction', $cma_data);
							$life_cycle=1;
						}else{$cma_sts=3;$desc="Recommend CMA";$life_cycle=2;}
						$data = array('cma_sts' => $cma_sts,'life_cycle'=>$life_cycle,'rec_by'=> $this->session->userdata['ast_user']['user_id'], 'rec_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('cma', $data);
						$data2 = $this->user_model->user_activities(3,'cma',$_POST['event_id_'.$i],'cma','Recommend CMA('.$_POST['event_id_'.$i].')');
					}
			 	}
				
			}
		}
		if($this->input->post('type')=='Return'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['event_id_'.$i],'3,24,4,5','cma_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('cma_sts' => 4,'return_reason_rm'=>trim($_POST['hidden_return_reason']),'checker_id' =>0,'return_by_rm'=> $this->session->userdata['ast_user']['user_id'], 'return_dt_rm'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('cma', $data);
						$data2 = $this->user_model->user_activities(4,'cma',$_POST['event_id_'.$i],'cma','Return CMA('.$_POST['event_id_'.$i].')',$_POST['hidden_return_reason']);
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



	function make_str($id=NULL,$doc_file_condition=NULL,$mortgage_form=0)
	{
		$str='';
		if ($id!=NULL) {
			$result = $this->get_recommend_info($id);
			$cma_guarantor = $this->get_guarantor_info('edit',$id);
			if ($result->proposed_type=='Loan') {
			$facility_info = $this->get_facility_info('edit',$id);
			}
			else if($result->proposed_type=='Card')
			{
				$facility_info = $this->get_facility_info_card($id);
			}else{$facility_info=array();}
			$cma_mortgage = $this->Auction_model->get_mortgage_info_by_cma($id);
			$cma_mortgage_security = $this->Auction_model->get_mortgage_security($id);
			$doc_files = $this->get_cma_doc_files($id,$doc_file_condition);
			$bidder_info = $this->Cma_ho_model->get_bidder($id);
			if (!empty($result)) 
			{
				$str.='<tr>
					<td style="width:12%"><strong>SL No.</strong></td>
					<td style="width:30%">'.$result->sl_no.'</td>
					<td style="width:12%"><strong>Current/Updated Address</strong></td>
					<td style="width:30%">'.$result->current_address.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Type of Requisition</strong></td>
					<td style="width:30%">'.$result->req_type.'</td>
					<td style="width:12%"><strong>Region</strong></td>
					<td style="width:30%">'.$result->region_name.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Proposed Type</strong></td>
					<td style="width:30%">'.$result->proposed_type.'</td>
					<td style="width:12%"><strong>Territory </strong></td>
					<td style="width:30%">'.$result->territory_name.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>';
				if($result->proposed_type=='Loan'){
					$str.='Loan A/C No.';
				}
				else{$str.='Card No.';}
				$str.='</strong></td>
					<td style="width:30%">'.$result->loan_ac.'</td>
					<td style="width:12%"><strong>District</strong></td>
					<td style="width:30%">'.$result->district_name.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>CIF </strong></td>
					<td style="width:30%">'.$result->cif.'</td>
					<td style="width:12%"><strong>Unit Office (code)</strong></td>
					<td style="width:30%">'.$result->unit_office_name.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Branch SOL</strong></td>
					<td style="width:30%">'.$result->branch_sol.'</td>
					<td style="width:12%"><strong>More A/C No. </strong></td>
					<td style="width:30%">'.$result->more_acc_number.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>';
				if($result->proposed_type=='Loan'){
						$str.='Loan A/C Name.';
				}
				else{$str.='Name on Card';}
				$str.='</strong></td>
					<td style="width:30%">'.$result->ac_name.'</td>
					<td style="width:12%"><strong>Loan Sanction Date </strong></td>
					<td style="width:30%">'.$result->loan_sanction_dt.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Borrower Name</strong></td>
					<td style="width:30%">'.$result->brrower_name.'</td>
					
					<td style="width:12%"><strong>Initiate By</strong></td>
					<td style="width:30%">'.$result->e_by.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Spouse Name</strong></td>
					<td style="width:30%">';
				if($result->sub_type==3 && $result->spouse_name!='')
					{$str.=$result->spouse_name;}
				else{$str.='N/A';}
				$str.='</td>
					<td style="width:12%"><strong>Initiate Date Time</strong></td>
					<td style="width:30%">'.$result->e_dt.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Mother Name</strong></td>
					<td style="width:30%">';
				if($result->sub_type==3)
					{$str.=$result->mother_name;}
				else{$str.='N/A';}
				$str.='</td>
					<td style="width:12%"><strong>STC By</strong></td>
					<td style="width:30%">'.$result->stc_by.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Loan Segment (Portfolio) </strong></td>
					<td style="width:30%">'.$result->loan_segment.'</td>
					<td style="width:12%"><strong>STC Date TIme</strong></td>
					<td style="width:30%">'.$result->stc_dt.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Recommended By</strong></td>
					<td style="width:30%">'.$result->rec_by.'</td>
					<td style="width:12%"><strong>Recommended Date TIme</strong></td>
					<td style="width:30%">'.$result->rec_dt.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Send To Auc Checker By</strong></td>
					<td style="width:30%">'.$result->st_auch_by.'</td>
					<td style="width:12%"><strong>Send To Auc Checker Date</strong></td>
					<td style="width:30%">'.$result->st_auch_dt.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Call up Date</strong></td>
					<td style="width:30%">'.$result->call_up_serv_dt.'</td>
					<td style="width:12%"><strong>Return/Decline Message</strong></td>
					<td style="width:30%">';
				if ($result->return_reason_rm!=null)
				{
					$str.='	<a href="#" style="color:black" onclick="return r_history('.$result->id.')"><span>'.$result->return_reason_rm.'</span></a>';
				}
				$str.='</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Call Up File</strong></td>
					<td style="width:30%">';
						if ($result->call_up_file!='')
						{
							$str.='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/call_up_file/'.$result->call_up_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
						}
				$str.='</td>
					<td style="width:12%"><strong>Chq Expiry Date</strong></td>
					<td style="width:30%">'.$result->chq_expiry_date.'</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Last Payment Date</strong></td>
					<td style="width:30%">'.$result->last_payment_date.'</td>
					<td style="width:12%">Legal Region</td>
					<td style="width:30%">
						'.$result->legal_region_name.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Last Payment Amount</strong></td>
					<td style="width:30%">'.$result->last_payment_amount.'</td>
					<td style="width:12%">Pre Case Filling Date</td>
					<td style="width:30%">
						'.$result->pre_case_fill_dt.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Subject Type</strong></td>
					<td style="width:30%">'.$result->subject_name.'</td>
					<td style="width:12%">Previous CMA Approval Type</td>
					<td style="width:30%">
						'.$result->pre_cma_app_type.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Previous CMA Approval Date</strong></td>
					<td style="width:30%">'.$result->pre_cma_app_dt.'</td>
					<td style="width:12%">Previous Case Status</td>
					<td style="width:30%">
						'.$result->pre_case_sts.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Previous Case Type</strong></td>
					<td style="width:30%">'.$result->pre_case_type.'</td>
					<td style="width:12%">Disposal Status</td>
					<td style="width:30%">
						'.$result->disposal_sts.'
					</td>
				</tr>

				<tr>
					<td style="width:12%"><strong>Customer Contact Number</strong></td>
					<td style="width:30%">'.$result->mobile_no.'</td>
					<td style="width:12%">Disposal remarks</td>
					<td style="width:30%">
						'.$result->disposal_remarks.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Judgment Summary</strong></td>
					<td style="width:30%">'.$result->judgement_summery.'</td>
					<td style="width:12%">Previous Case Filing Date</td>
					<td style="width:30%">
						'.$result->pre_case_fill_dt.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Security Status</strong></td>
					<td style="width:30%">'.$result->sec_sts.'</td>
					<td style="width:12%">Business Status</td>
					<td style="width:30%">
						'.$result->busi_sts.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Borrower Status</strong></td>
					<td style="width:30%">'.$result->borr_sts.'</td>
					<td style="width:12%">Interest Rate (As per Sanction)</td>
					<td style="width:30%">
						'.$result->int_rate.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Logic for ARA Case</strong></td>
					<td style="width:30%">'.$result->case_logic.'</td>
					<td style="width:12%">Chq. Status</td>
					<td style="width:30%">
						'.$result->chq_sts.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Remarks</strong></td>
					<td style="width:30%">'.$result->remarks;
					if ($result->remarks_file!='')
					{
						$str.='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/remarks_file/'.$result->remarks_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
					}
					$str.='</td>
					<td style="width:12%">Current Dpd</td>
					<td style="width:30%">
						'.$result->current_dpd.'DPD
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Current Auction Sts</strong></td>
					<td style="width:30%">';
					if ($result->auction_sts=='33')
					{
						$str.='Completed';
					}
					$str.='</td>
					<td style="width:12%">Previous Auction Status</td>
					<td style="width:30%">
						'.$result->pre_auc_sts.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Send To Auc Checker By</strong></td>
					<td style="width:30%">'.$result->auc_stc_by.'</td>
					<td style="width:12%">Send To Auc Checker Date</td>
					<td style="width:30%">
						'.$result->auc_stc_dt.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Auction Verify By</strong></td>
					<td style="width:30%">'.$result->auc_v_by.'</td>
					<td style="width:12%">Auction Verify Date</td>
					<td style="width:30%">
						'.$result->auction_v_dt.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Legal Response By</strong></td>
					<td style="width:30%">'.$result->legal_response_by.'</td>
					<td style="width:12%">Legal Response Date</td>
					<td style="width:30%">
						'.$result->legal_response_dt.'
					</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Lawyer</strong></td>
					<td style="width:30%">
						'.$result->lawyer_name.'
					</td>
					<td style="width:12%">LN Scan Copy</td>
					<td style="width:30%">';
						if ($result->ln_scan_copy!='')
						{
							$str.='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/ln_scan_copy/'.$result->ln_scan_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
						}
					$str.='</td>
				</tr>
				<tr>
					<td style="width:12%"><strong>LN Serve Date</strong></td>
					<td style="width:30%">
						'.$result->ln_serve_dt_format.'
					</td>
					<td style="width:12%">LN Expiry Date</td>
					<td style="width:30%">
						'.$result->ln_expiry_dt_format.'
					</td>
				</tr>';

				if (!empty($cma_guarantor)) 
				{
					$str.='<tr>
					<td colspan="4" style="background: white;">
					</br>
						<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
						<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">';
						if($result->proposed_type=='Loan'){$str.='Borrower/Guarantor/Company Director/Owner';}
						else{$str.='Borrower/Reference';}
						$str.='</span>
						<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
						<tbody>
							<tr>
								<td width="10%" style="font-weight: bold;text-align:center">Type</td>
								<td width="10%" style="font-weight: bold;text-align:left">Name</td>
								<td width="10%" style="font-weight: bold;text-align:left">Father Name</td>
								<td width="15%" style="font-weight: bold;text-align:left">Present Address</td>
								<td width="15%" style="font-weight: bold;text-align:left">Permanent Address</td>
								<td width="15%" style="font-weight: bold;text-align:left">Business Address</td>
								<td width="10%" style="font-weight: bold;text-align:center">Status</td>
								<td width="15%" style="font-weight: bold;text-align:center">Occupation</td>
							</tr>';
					foreach ($cma_guarantor as $key) 
					{
						$str.='<tr>
									<td style="text-align:center">'.$key->type_name.'</td>
									<td style="text-align:left">'.$key->guarantor_name.'</td>
									<td style="text-align:left">'.$key->father_name.'</td>
									<td style="text-align:left">'.$key->present_address.'</td>
									<td style="text-align:left">'.$key->permanent_address.'</td>
									<td style="text-align:left">'.$key->business_address.'</td>
									<td style="text-align:center">'.$key->guar_sts_name.'</td>
									<td style="text-align:center">'.$key->occ_sts_name.'</td>
								</tr>';
					}

					$str.='</tbody>
						</table>
					</div>
					</td>
				</tr>';
				}
				if (!empty($doc_files)) {
					$str.='<tr>
						<td colspan="4" style="background: white;">
						</br>
							<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
							<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Secured Document Files</span>
							<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
							<tbody>

								<tr>
									<td width="70%" style="font-weight: bold;text-align:left">Document Title</td>
									<td width="30%" style="font-weight: bold;text-align:center">file</td>
								</tr>';
					foreach ($doc_files as $key) 
					{
						$str.='<tr>
									<td style="text-align:left">'.$key->org_document_name.'</td>
									<td style="text-align:center">';
									if ($key->file_name!='')
									{
										$str.='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/document_file/'.$key->file_name.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
									}
								$str.='</td>
								</tr>';
					}
					$str.='</tbody>
							</table>
						</div>
						</td>
					</tr>';
				}
				if ($result->proposed_type=='Loan') {
					if (!empty($facility_info)) {
						$str.='<tr><td colspan="4" style="background: white;">
						<br/>
							<div style="background-color:#eaeaea;padding:10px;margin:0 0px;overflow:scroll;padding-top:20px;">
							<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
							<table border="1" id="gurantor_table" style="table-layout: fixed;border-color:#c0c0c0;width:180%;margin:20px" >
									<thead>
										<tr>
											<td width="8%" style="font-weight: bold;text-align:left">Facility Type</td>
											<td width="10%" style="font-weight: bold;text-align:left">A/C Number</td>
											<td width="5%" style="font-weight: bold;text-align:left">Sch Desc</td>
											<td width="10%" style="font-weight: bold;text-align:left">Disbursement Date</td>
											<td width="7%" style="font-weight: bold;text-align:left">Expire Date</td>
											<td width="7%" style="font-weight: bold;text-align:left">Disbursed Amount</td>
											<td width="5%" style="font-weight: bold;text-align:left">Loan Tenor</td>
											<td width="5%" style="font-weight: bold;text-align:left">Payable</td>
											<td width="7%" style="font-weight: bold;text-align:left">Repayment</td>
											<td width="10%" style="font-weight: bold;text-align:left">Outstanding Balance</td>
											<td width="10%" style="font-weight: bold;text-align:left">Outstanding Balance Date</td>
											<td width="10%" style="font-weight: bold;text-align:left">Overdue Balance</td>
											<td width="10%" style="font-weight: bold;text-align:left">Overdue BL Date</td>
											<td width="10%" style="font-weight: bold;text-align:left">Call-up Date</td>
											<td width="7%" style="font-weight: bold;text-align:left">CL(BB)</td>
											<td width="7%" style="font-weight: bold;text-align:left">CL(BBL)</td>
											<td width="10%" style="font-weight: bold;text-align:left">Written-off Date</td>
											<td width="10%" style="font-weight: bold;text-align:left">Written-off Amt(A)</td>
											<td width="10%" style="font-weight: bold;text-align:left">Recovery After Written-off(B)</td>
										</tr>
									</thead>
									<tbody id="facility_info_body">';
							foreach ($facility_info as $key) {
								$str.='<tr>
										<td>
                    						'.$key->facility_type_name.'
										</td>
										<td>
                    						'.$key->ac_number.'<br/>
                    						'.$key->ac_name.'
										</td>
										<td>
                    						'.$key->sch_desc.'
										</td>
										<td>
                    						'.$key->disbursement_date.'
										</td>
										<td>
                    						'.$key->expire_date.'
										</td>
										<td>
                    						'.$key->disbursed_amount.'
										</td>
										<td>
                    						'.$key->loan_tenor.'
										</td>
										<td>
                    						'.$key->payble.'
										</td>
										<td>
                    						'.$key->repayment.'
										</td>
										<td>
                    						'.$key->outstanding_bl.'
										</td>
										<td>
                    						'.$key->outstanding_bl_dt.'
										</td>
										<td>
                    						'.$key->overdue_bl.'
										</td>
										<td>
                    						'.$key->overdue_bl_dt.'
										</td>
										<td>
                    						'.$key->call_up_dt.'
										</td>
										<td>
                    						'.$key->cl_bb.'
										</td>
										<td>
                    						'.$key->cl_bbl.'
										</td>
										<td>
                    						'.$key->write_off_dt.'
										</td>
										<td>
                    						'.$key->write_off_amount.'
										</td>
										<td>
                    						'.$key->recovery_after_Wf.'
										</td>
									</tr>';
							}
						$str.='</tbody>
									</table>
								</div>
							</td>
						</tr>';
					}
				}
				if ($result->proposed_type=='Card') 
				{
					if (!empty($facility_info)) 
					{
						$str.='<tr><td colspan="4" style="background: white;">
					<br/>
						<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
							<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:0px;">Facility Info</span>
							<table style="width: 100%;" id="guarantor_info">
								<thead>
									<tr>
										<td width="20%" style="font-weight: bold;text-align:center">Card Issuing Date</td>
										<td width="20%" style="font-weight: bold;text-align:center">Expire Date</td>
										<td width="20%" style="font-weight: bold;text-align:center">Credit Limit</td>
										<td width="20%" style="font-weight: bold;text-align:center">Outstanding Balance</td>
										<td width="20%" style="font-weight: bold;text-align:center">Outstanding BL DT</td>
									</tr>
								</thead>
								<tbody id="facility_info_body">';
						foreach ($facility_info as $key) 
						{
							$str.='<tr id="facility_info">
										<td>
		            						'.$key->card_iss_date.'
										</td>
										<td>
		            						'.$key->card_exp_date.'
										</td>
										<td>
		            						'.$key->card_limit.'
										</td>
										<td>
		            						'.$key->outstanding_bl.'
										</td>
										<td>
		            						'.$key->outstanding_bl_dt.'
										</td>
										</tr>';
						}
						$str.='</tbody>
									</table>
							</div>
						</td>
						</tr>';
					}
				}

				if (!empty($cma_mortgage) && $mortgage_form==0) 
				{
					$str.='<tr>
					<td colspan="4" style="background: white;">
						</br>
						<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;overflow:scroll;">
						<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Mortgage & Security Details</span>
						<table border="1" id="guarantor_info" cellspacing="0" cellpadding="5" style="margin-top:0px;border-color:#c0c0c0;width:98%;margin:20px" >
							<tbody>
								<tr>
									<th>Security</th>
									<th>P</th>
									<th>Mortgage <br/>Schedule Name</th>
									<th>Mortgage <br/>Dchedule Description</th>
									<th>Mortgage <br/>Deed Number</th>
									<th>Mortgage <br/>Date</th>
									<th>Valuator <br/>MV</th>
									<th>Total Land <br/>Area (in decimals)</th>
								</tr>';
					$cot=1;
					foreach ($cma_mortgage as $key) 
					{
						$str.='<tr>
									<td class="headtd" style="text-align:center;">
										<div id="headerRow_'.$cot.'">
											<span class="headSpan" style="display:none;" id="show_spand_'.$cot.'" onClick="ShowDiv('.$cot.')" >
											<img src="'.base_url().'images/hide.png" align="absmiddle" /></span>
											<span class="headSpan" id="hide_spand_'.$cot.'" onClick="HideDiv('.$cot.')"><img src="'.base_url().'images/show.png" align="absmiddle" ></span>
											<input type="hidden" name="mortgage_id_'.$cot.'" id="mortgage_id_'.$cot.'" value="'.$key->id.'">
											<input type="hidden" name="schedule_name_'.$cot.'" id="schedule_name_'.$cot.'" value="'.$key->mort_schedule_name.'">
										</div>
									</td>
									<td><div style="cursor:pointer" onclick="mortgagedetails('.$key->id.',\'mortgage\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>
									<td>'.$key->mort_schedule_name.'</td>
									<td>'.$key->mort_schedule_desc.'</td>
									<td>'.$key->deed_number.'</td>
									<td>'.$key->mortgage_date.'</td>
									<td>'.$key->valuator_mv.'</td>
									<td>'.$key->land_area.'</td>
								</tr>
								<tr style="vertical-align:top;" class="innertrow classes_'.$cot.'" id="tr_'.$cot.'">
									<td colspan="10">
										<table cellspacing="0" style="margin-top:0px;border:1px solid #008080" width="140%">
											<thead bgcolor="#008080" style="font-size:12px;color:black">
												<th width="5%">P</th>
												<th width="8%">Title deed number</th>
												<th width="8%">Date of registration</th>
												<th width="8%">Type of Deed</th>
												<th width="8%">District</th>
												<th width="8%">Thana/Police Station</th>
												<th width="8%">Sub-registry Office</th>
												<th width="10%">Mouza</th>
												<th width="8%">Land Area </th>
												<th width="8%">Plot Number</th>
												<th width="8%">Holding number</th>
												<th width="8%">Jote  No.</th>
												<th width="8%">CS Khatian no.</th>
												<th width="8%">SA/PS Khatian no.</th>
											</thead>
											<tbody>';
								$cot1=1;
								foreach ($cma_mortgage_security as $key1) 
								{
									if ($key1->mortgage_id==$key->id)
									{
										$str.='<tr>
												<td><div style="cursor:pointer" onclick="mortgagedetails('.$key1->id.',\'security\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>
												<td>'.$key1->title_deed_number.'</td>
												<td>'.$key1->reg_date.'</td>
												<td>'.$key1->deed_type.'</td>
												<td>'.$key1->district.'</td>
												<td>'.$key1->thana.'</td>
												<td>'.$key1->sub_reg_office.'</td>
												<td>'.$key1->mouza.'</td>
												<td>'.$key1->land_area.'</td>
												<td>'.$key1->plot_number.'</td>
												<td>'.$key1->holding_number.'</td>
												<td>'.$key1->jote_no.'</td>
												<td>'.$key1->cs_khatian_no.'</td>
												<td>'.$key1->sa_khatian_no.'</td>
											</tr>';
										$cot1++;
									}
								}
							$str.='<input type="hidden" name="security_counter_edit_'.$cot.'" id="security_counter_edit_'.$cot.'" value="'.($cot1-1).'">
											</tbody>
										</table>
									</td>
								</tr>';
						$cot++;
					}
					$str.='<input type="hidden" name="mortgage_counter" id="mortgage_counter" value="<?=$cot-1?>">
								</tbody>
							</table>
							</div>
						</td>
					</tr>';
				}
				if (!empty($bidder_info)) 
				{
					$str.='<tr>
					<td colspan="4" style="background: white;">
					</br>
						<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
						<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Bidder Info</span>
						<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
						<tbody>
							<tr>
								<td style="font-weight: bold;text-align:center">Bidder Name</td>
								<td style="font-weight: bold;text-align:center">Bidder Details</td>
								<td style="font-weight: bold;text-align:center">Bidder Rank</td>
								<td style="font-weight: bold;text-align:center">Selection</td>
								<td style="font-weight: bold;text-align:center">Pay Order No</td>
								<td style="font-weight: bold;text-align:center">Pay order date</td>
								<td style="font-weight: bold;text-align:center">Pay Order Amount</td>
								<td style="font-weight: bold;text-align:center">Bid Amount</td>
								<td style="font-weight: bold;text-align:center">Rs Plot No</td>
								<td style="font-weight: bold;text-align:center">Remarks</td>
							</tr>';
					foreach ($bidder_info as $key) 
					{
						if ($key->selected=='1') {
							$selected="Selected";
						}else{$selected="";}
						$str.='<tr>';
							$str.='<td align="center">'.$key->bidder_name.'</td>';
							$str.='<td align="center">'.$key->bidder_details.'</td>';
							$str.='<td align="center">'.$key->bidder_rank.'</td>';
							$str.='<td align="center">'.$selected.'</td>';
							$str.='<td align="center">'.$key->pay_order_no.'</td>';
							$str.='<td align="center">'.$key->pay_order_date.'</td>';
							$str.='<td align="center">'.$key->pay_order_amount.'</td>';
							$str.='<td align="center">'.$key->bid_amount.'</td>';
							$str.='<td align="center">'.$key->r_s_plot_no.'</td>';
							$str.='<td align="center">'.$key->remarks.'</td>';
						$str.='</tr>';
					}
					$str.='</tbody>
						</table>
					</div>
					</td>
				</tr>';

				}
			}
			return $str;
		}
		else
		{
			return '';
		}
	}

}
?>
