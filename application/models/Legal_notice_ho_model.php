<?php
class Legal_notice_ho_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
	}



	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "b.sts!='0' and b.life_cycle='2'";
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

		if($this->input->get('v_dt_from') != '' && $this->input->get('v_dt_from')!=0 && ($this->input->get('v_dt_to') == '' || $this->input->get('v_dt_to')==0)) 
		{$where2.=" AND DATE(b.v_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('v_dt_from')))))."'";}
		if($this->input->get('v_dt_from') != '' && $this->input->get('v_dt_from')!=0 && $this->input->get('v_dt_to') != '' && $this->input->get('v_dt_to')!=0) 
		{$where2.=" AND DATE(b.v_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('v_dt_from')))))."' AND DATE(b.v_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('v_dt_to')))))."'";}

		if($this->input->get('ack_dt_from') != '' && $this->input->get('ack_dt_from')!=0 && ($this->input->get('ack_dt_to') == '' || $this->input->get('ack_dt_to')==0)) 
		{$where2.=" AND DATE(b.ack_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('ack_dt_from')))))."'";}
		if($this->input->get('ack_dt_from') != '' && $this->input->get('ack_dt_from')!=0 && $this->input->get('ack_dt_to') != '' && $this->input->get('ack_dt_to')!=0) 
		{$where2.=" AND DATE(b.ack_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('ack_dt_from')))))."' AND DATE(b.ack_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('ack_dt_to')))))."'";}
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
				else if($filterdatafield=='qty')
				{
					$filterdatafield='j11.qty';
				}
				else if($filterdatafield=='amount')
				{
					$filterdatafield='j11.amount';
				}
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='b.ac_name';
				}
				else if($filterdatafield=='loan_segment')
				{
					$filterdatafield='s.name';
				}
				else if($filterdatafield=='request_type_name')
				{
					$filterdatafield='j1.name';
				}
				else if($filterdatafield=='region_name')
				{
					$filterdatafield='j7.name';
				}
				else if($filterdatafield=='territory_name')
				{
					$filterdatafield='j8.name';
				}
				else if($filterdatafield=='district_name')
				{
					$filterdatafield='j9.name';
				}
				else if($filterdatafield=='unit_office_name')
				{
					$filterdatafield='j10.name';
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
				// else if($filterdatafield=='ho_return_reason')
				// {
				// 	$filterdatafield='b.ho_return_reason';
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
					$where .= " (j13.name LIKE '%".$filtervalue."%' OR j13.user_id LIKE '%".$filtervalue."%') ";
				}
				else if($filterdatafield =='v_by')
				{
					$where .= " (j14.name LIKE '%".$filtervalue."%' OR j14.user_id LIKE '%".$filtervalue."%') ";
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

		if ($sortorder == '')
		{
			//$sortdatafield="b.id";
			//$sortorder = "DESC";	
			$sortdatafield="j6.s_order";		
			$sortorder = "ASC";				
		}
	    $this->db
	    ->select('SQL_CALC_FOUND_ROWS b.*,IF(b.ho_return_reason IS NOT NULL OR b.holm_r_reason IS NOT NULL OR b.ho_decline_reason IS NOT NULL,1,"") as return_reason,j11.ln_total_qty as qty,s.name as loan_segment,j11.ln_per_cost as amount,IF(b.legal_notice_sts="10",CONCAT(j6.name," (",j12.user_id,")"),j6.name) as status,j7.name as region_name,j8.name as territory_name,
	    	j9.name as district_name,j10.name as unit_office_name,
	    	j1.name as request_type_name,CONCAT(j2.name," (",j2.user_id,")")as e_by,
	    	CONCAT(j13.name," (",j13.user_id,")")as sth_by,
		    CONCAT(j14.name," (",j14.user_id,")")as v_by,
	    	CONCAT(j4.name," (",j4.user_id,")")as stc_by,CONCAT(j5.name," (",j5.user_id,")")as rec_by,
	    	DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
	    	DATE_FORMAT(b.stc_dt,"%d-%b-%y %h:%i %p") AS stc_dt,
	    	DATE_FORMAT(b.rec_dt,"%d-%b-%y %h:%i %p") AS rec_dt,
	    	DATE_FORMAT(b.sth_dt,"%d-%b-%y %h:%i %p") AS sth_dt,
		    DATE_FORMAT(b.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
	    	', FALSE)
			->from("legal_notice b")
			->join('ref_req_type as j1', 'b.req_type=j1.id', 'left')
			->join('users_info as j2', 'b.e_by=j2.id', 'left')
			->join('users_info as j4', 'b.stc_by=j4.id', 'left')
			->join('users_info as j5', 'b.rec_by=j5.id', 'left')
			->join('ref_status as j6', 'b.legal_notice_sts=j6.id', 'left')
			->join('ref_region as j7', 'b.region=j7.id', 'left')
			->join('ref_territory as j8', 'b.territory=j8.id', 'left')
			->join('ref_district as j9', 'b.district=j9.id', 'left')
			->join('ref_unit_office as j10', 'b.unit_office=j10.id', 'left')
			->join('legal_notice_cost_details as j11', 'b.id=j11.main_table_id AND j11.main_table_name="legal_notice" AND j11.ln_cost_select_sts=1', 'left')
			->join('users_info as j12', 'b.holm_checker_id=j12.id', 'left')
			->join('users_info as j13', 'b.sth_by=j13.id', 'left')
			->join('users_info as j14', 'b.v_by=j14.id', 'left')
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
	function get_bulk_data()
	{
		$where2 = "b.sts!='0' and b.life_cycle='2'";
		if ($this->input->post('operation')=='ack') 
		{
			$where2.=" AND b.legal_notice_sts = '3'";
		}
		if ($this->input->post('operation')=='sta') 
		{
			$where2.=" AND b.legal_notice_sts IN(6,11,7,8) AND b.ack_by='".$this->session->userdata['ast_user']['user_id']."'";
		}
		if ($this->input->post('operation')=='apv') 
		{
			$where2.=" AND b.legal_notice_sts = '10' AND b.holm_checker_id='".$this->session->userdata['ast_user']['user_id']."'";
		}
		if ($this->input->post('operation')=='lns') 
		{
			$where2.=" AND b.legal_notice_sts = '13'";
		}
		if ($this->input->post('operation')=='download') 
		{
			if($this->input->post('type')!='All')
			{
				$where2.=" AND b.legal_notice_sts = '13' AND b.proposed_type='".$this->input->post('type')."'";
			}
			else
			{
				$where2.=" AND b.legal_notice_sts = '13'";
			}
			
		}
	   	if($this->input->post('region')!='' && $this->input->post('region')!=0) 
		{$where2.=" AND b.region = '".trim($this->input->post('region'))."'";}
		if($this->input->post('territory')!='' && $this->input->post('territory')!=0) 
		{$where2.=" AND b.territory = '".trim($this->input->post('territory'))."'";}
		if($this->input->post('district')!='' && $this->input->post('district')!=0) 
		{$where2.=" AND b.district = '".trim($this->input->post('district'))."'";}
		if($this->input->post('unit_office')!='' && $this->input->post('unit_office')!=0) 
		{$where2.=" AND b.unit_office = '".trim($this->input->post('unit_office'))."'";}
	   	if($this->input->post('rec_dt_from') != '' && $this->input->post('rec_dt_from')!=0 && ($this->input->post('rec_dt_to') == '' || $this->input->post('rec_dt_to')==0)) 
		{$where2.=" AND DATE(b.rec_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('rec_dt_from')))))."'";}
		if($this->input->post('rec_dt_from') != '' && $this->input->post('rec_dt_from')!=0 && $this->input->post('rec_dt_to') != '' && $this->input->post('rec_dt_to')!=0) 
		{$where2.=" AND DATE(b.rec_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('rec_dt_from')))))."' AND DATE(b.rec_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('rec_dt_to')))))."'";}
		
		if($this->input->post('loan_segment')!='' && $this->input->post('loan_segment')!='') 
		{$where2.=" AND b.loan_segment = '".trim($this->input->post('loan_segment'))."'";}

		$this->db
    	->select('b.id,b.download_sts,b.proposed_type,b.loan_ac,b.sl_no,s.name as loan_segment,j7.name as region_name,j8.name as territory_name,
    	j9.name as district_name,j10.name as unit_office_name,
    	CONCAT(j5.name," (",j5.user_id,")")as rec_by,
    	DATE_FORMAT(b.rec_dt,"%d-%b-%y %h:%i %p") AS rec_dt
    	', FALSE)
			->from("legal_notice b")
			->join('users_info as j5', 'b.rec_by=j5.id', 'left')
			->join('ref_status as j6', 'b.legal_notice_sts=j6.id', 'left')
			->join('ref_region as j7', 'b.region=j7.id', 'left')
			->join('ref_territory as j8', 'b.territory=j8.id', 'left')
			->join('ref_district as j9', 'b.district=j9.id', 'left')
			->join('ref_unit_office as j10', 'b.unit_office=j10.id', 'left')
			->join('ref_loan_segment as s', 'b.loan_segment=s.code', 'left')
			->where($where2)
			->order_by('b.id','ASC');
		$q=$this->db->get();
		return $q->result();
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
				$file_name_new='Doc_Files_'.$this->session->userdata['ast_user']['user_id'].'_'.rand().'.'.$extension;								
			}
			if($file_name_new!='' && $image==true)
			{
				if(($file_Size >0))
				{
						$copied = copy($_FILES[$input_name]['tmp_name'], 'legal_notice_file/updated_file/'.$file_name_new);
						if($_POST['hidden_'.$input_name]!=''){unlink("legal_notice_file/updated_file/".$_POST['hidden_'.$input_name]);}				
				}
				else{ 
						$text[]="Unknown Attached documents (AF) Extention";
				}
			}
		return  $file_name_new;
	}
	function upload_file()
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = true; // off display of db error
		$this->db->trans_begin(); // transaction start
		$updated_file = $this->Legal_notice_model->get_file_name('updated_file','Legal_notice_file/updated_file/');
		$data = array('updated_file' => $updated_file);
		$this->db->where('id', $_POST['deleteEventId']);
		$this->db->update('legal_notice', $data);
		$data2 = $this->user_model->user_activities(56,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Upload 1st Legal Notice('.$this->input->post('deleteEventId').')');
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
			->select("j0.*,CONCAT(j13.name,' (',j13.code,')') as branch_sol,
				j1.name as region_name,j2.name as territory_name,j3.name as district_name,
				j4.name as unit_office_name,r.name as req_type,
				j6.name as subject_name,j7.name as loan_segment,j8.name as e_by,CONCAT(j9.name,' (',j9.pin,')') as stc_by,
				CONCAT(j10.name,' (',j10.pin,')') as rec_by,
				CONCAT(j11.name,' (',j11.pin,')') as sth_by,
				CONCAT(j12.name,' (',j12.pin,')') as ack_by,
				CONCAT(j15.name,' (',j15.pin,')') as rec_by,
				DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,
				DATE_FORMAT(j0.rec_dt,'%d-%b-%y %h:%i %p') AS rec_dt,
				DATE_FORMAT(j0.ack_dt,'%d-%b-%y %h:%i %p') AS ack_dt,
				DATE_FORMAT(j0.sth_dt,'%d-%b-%y %h:%i %p') AS sth_dt,
				r.name as req_type,
				DATE_FORMAT(j0.stc_dt,'%d-%b-%y %h:%i %p') AS stc_dt,DATE_FORMAT(j0.rec_dt,'%d-%b-%y %h:%i %p') AS rec_dt,j14.name as lawyer_name,
				DATE_FORMAT(j0.call_up_dt,'%d-%b-%y %h:%i %p') AS call_up_dt
				", FALSE)
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
			->join("users_info as j11", "j0.sth_by=j11.id", "left")
			->join("users_info as j12", "j0.ack_by=j12.id", "left")
			->join("users_info as j15", "j0.rec_by=j15.id", "left")
			->join("ref_branch_sol as j13", "j0.branch_sol=j13.code", "left")
			->join("ref_lawyer as j14", "j0.lawyer=j14.id", "left")
			->where("j0.id='".$id."'",NULL,FALSE)
			->limit(1);
			return  $this->db->get()->row();
		}
		else{return NULL;}
	}
	function get_facility($id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT j0.*,f.name as facility_type_name,date_format(j0.outstanding_bl_dt,'%d-%b-%y') as outstanding_bl_dt,
				date_format(j0.overdue_bl_dt,'%d-%b-%y') as overdue_bl_dt,
				date_format(j0.call_up_dt,'%d-%b-%y') as call_up_dt,
				date_format(j0.expire_date,'%d-%b-%y') as expire_date,
				date_format(j0.disbursement_date,'%d-%b-%y') as disbursement_date
			FROM legal_notice_facility as j0
			LEFT OUTER JOIN ref_facility_name as f on (f.code=j0.facility_type)
			WHERE j0.legal_notice_id= ".$this->db->escape($id)." AND j0.sts='1' AND j0.section_type='loan' ORDER BY id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_card_facility($id) // get data for edit
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
	function get_edit_card_facility($id) // get data for edit
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
	function update_facility()
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		//For card facility update
		if ($_POST['proposed_type']=='Card') 
		{
			$facility_info = array(
			'card_iss_date'=>implode('-',array_reverse(explode('/',$this->input->post('card_iss_date')))),
			'card_exp_date'=>implode('-',array_reverse(explode('/',$this->input->post('card_exp_date')))),
			'card_limit' => $this->security->xss_clean( $this->input->post('card_limit')),
			'outstanding_bl' => $this->security->xss_clean( $this->input->post('outstanding_bl')),
			'outstanding_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('outstanding_bl_dt')))),
 			);
 			$facility_info['card_f_u_by'] = $this->session->userdata['ast_user']['user_id'];
			$facility_info['card_f_u_dt'] = date('Y-m-d H:i:s');
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('legal_notice', $facility_info);
			$data2 = $this->user_model->user_activities(34,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice_facility','Update Card Facility('.$this->input->post('deleteEventId').')');
		}
		//For Loan
		else
		{
			for($i=1;$i<= $_POST['facility_info_counter'];$i++)
			{
				$facility_info = array(
				'legal_notice_id' => $this->security->xss_clean( $this->input->post('deleteEventId')),
				'facility_type' =>$this->security->xss_clean( $this->input->post('facility_type_'.$i)),
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
				'api_new' => $this->security->xss_clean( $this->input->post('api_new_'.$i)),
     			'section_type' =>'loan'
     			);
				// For skip The new deleted row
 				if ($_POST['facility_info_edit_'.$i]==0 && $_POST['facility_info_delete_'.$i]==1) 
 				{
 					continue;
 				}
 				//For Delete old row
 				if ($_POST['facility_info_edit_'.$i]!=0 && $_POST['facility_info_delete_'.$i]==1) 
 				{
 					$data = array('sts' => 0);
 					$data['u_by'] = $this->session->userdata['ast_user']['user_id'];
					$data['u_dt'] = date('Y-m-d H:i:s');
 					$this->db->where('id',$_POST['facility_info_edit_'.$i]);
 					$this->db->where('section_type','loan');
					$this->db->update('legal_notice_facility', $data);
 				}
 				//For update the old row
 				else if($_POST['facility_info_edit_'.$i]!=0 && $_POST['facility_info_delete_'.$i]!=1)
 				{
 					$facility_info['u_by'] = $this->session->userdata['ast_user']['user_id'];
					$facility_info['u_dt'] = date('Y-m-d H:i:s');
 					$this->db->where('id',$_POST['facility_info_edit_'.$i]);
 					$this->db->where('section_type','loan');
					$this->db->update('legal_notice_facility', $facility_info);
 				}
 				//For insert the new row
 				else if($_POST['facility_info_edit_'.$i]==0 && $_POST['facility_info_delete_'.$i]!=1)
 				{
 					$facility_info['e_by'] = $this->session->userdata['ast_user']['user_id'];
					$facility_info['e_dt'] = date('Y-m-d H:i:s');
 					$this->db->insert('legal_notice_facility', $facility_info);
 				}
     			
			}
			$data2 = $this->user_model->user_activities(34,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice_facility','Update Loan Facility('.$this->input->post('deleteEventId').')');
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
	function delete_action($id=NULL,$bulk=NULL,$type=NULL)
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = true; // off display of db error
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
		if(isset($_POST['sendtoholm']) && $this->input->post('sendtoholm') == 'sendtoholm'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],'9,10','legal_notice_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('legal_notice_sts' =>10,'holm_checker_id' => $this->input->post('checker_to_notify'),'lawyer' => $this->input->post('lawyer'), 'sth_by'=> $this->session->userdata['ast_user']['user_id'], 'sth_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);
				$application_data = $this->db->query("SELECT loan_ac from legal_notice where id='".$_POST['deleteEventId']."'")->row();
				$subject = "Need your Approval for 1st legal notice issue on this A/C-".$application_data->loan_ac;
	        	$url = base_url()."legal_notice/details";
	        	$data2 = $this->Common_model->push_notification_data($subject,$url,'legal_notice',$_POST['deleteEventId'],date('Y-m-d'),'',$this->input->post('checker_to_notify'),'1');
				$data2 = $this->user_model->user_activities(10,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Send to HO Checker('.$this->input->post('deleteEventId').')');
			}
		}
		if($this->input->post('type')=='hold'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],'7','legal_notice_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('legal_notice_sts' => 7,'hold_reason'=>trim($_POST['reason']),'hold_by'=> $this->session->userdata['ast_user']['user_id'], 'hold_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);
				$data2 = $this->user_model->user_activities(7,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Hold Legal Notice('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
		}
		if($this->input->post('type')=='sendquery'){
			$data = array('legal_notice_sts'=>8,'query'=>trim($_POST['reason']),'q_by'=> $this->session->userdata['ast_user']['user_id'], 'q_dt'=>date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('legal_notice', $data);
			if ($this->db->affected_rows() > 0) 
			{
				if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'sendquery')
				{
					$str="SELECT  j0.sl_no,j0.rec_by,s.name as legal_notice_sts
								 FROM legal_notice j0
								 LEFT OUTER JOIN ref_status s on(j0.legal_notice_sts=s.id)
							 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
							 
					$application_data=$this->db->query($str)->row();

	                $maker = $application_data->rec_by;
	              
					$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker."' LIMIT 1";
					$maker=$this->db->query($str1)->row();
	                if (!empty($maker->email_address) && $maker->email_address != null) {
	                   $subject="1st Legal Notice Query!!";
					   $req_type=$application_data->legal_notice_sts;
					   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
					   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
					    You Have some query on you Recommended 1st Legal Notice.<br/><br/>
						Request Type: ".$req_type."<br/>
						Query: ".$_POST['reason']."<br/>
						Request by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), <br/>
						Request Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/>
						Request for: SL NO:".$application_data->sl_no."<br/><br/>
						Please login to  <a href=".base_url().">LMS Application</a>  to approve the request.<br/><br/> 
						This is a system generated email, no need to reply.<br/><br/>  
						Thanks</div>";
						$m=$this->User_model->send_email("", "", $maker->email_address, "",$subject,$message);
						
						//echo $m;exit;
	                }
	            }
        	}
			$data2 = $this->user_model->user_activities(8,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Send query Legal Notice('.$this->input->post('deleteEventId').')',$_POST['reason']);
		}
		if($this->input->post('type')=='return'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],'9,10','legal_notice_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('legal_notice_sts' => 9,'life_cycle'=>1,'ho_return_reason'=>trim($_POST['reason']),'ho_r_by'=> $this->session->userdata['ast_user']['user_id'], 'ho_r_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);
				if ($this->db->affected_rows() > 0) 
				{
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'return')
					{
						$str="SELECT  j0.sl_no,j0.rec_by,s.name as legal_notice_sts
									 FROM legal_notice j0
									 LEFT OUTER JOIN ref_status s on(j0.legal_notice_sts=s.id)
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $maker = $application_data->rec_by;
		              
						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker."' LIMIT 1";
						$maker=$this->db->query($str1)->row();
						
		                if (!empty($maker->email_address) && $maker->email_address != null) {
		                   $subject="1st Legal Notice Returned!!";
						   $req_type=$application_data->legal_notice_sts;
						   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
						   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
						    Your Recommended 1st Legal Notice Has been Returned.<br/><br/>
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
				$data2 = $this->user_model->user_activities(9,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Return Legal Notice('.$this->input->post('deleteEventId').')',$_POST['reason']);
				$application_data = $this->db->query("SELECT loan_ac,e_by,rec_by from legal_notice where id='".$_POST['deleteEventId']."'")->row();
				$subject = "1st Legal Notice return, A/C-".$application_data->loan_ac.',['.$_POST['reason'].']';
	        	$url = base_url()."legal_notice/details";
	        	$data2 = $this->Common_model->push_notification_data($subject,$url,'legal_notice',$_POST['deleteEventId'],date('Y-m-d'),'',$application_data->e_by,'1');
	        	$data2 = $this->Common_model->push_notification_data($subject,$url,'legal_notice',$_POST['deleteEventId'],date('Y-m-d'),'',$application_data->rec_by);
			}
			
		}
		if($this->input->post('type')=='holm_return'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],'11,12,13','legal_notice_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('legal_notice_sts' => 11,'holm_r_reason'=>trim($_POST['reason']),'holm_r_by'=> $this->session->userdata['ast_user']['user_id'], 'holm_r_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);
				if ($this->db->affected_rows() > 0) 
				{
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'holm_return')
					{
						$str="SELECT  j0.sl_no,j0.sth_by,s.name as legal_notice_sts
									 FROM legal_notice j0
									 LEFT OUTER JOIN ref_status s on(j0.legal_notice_sts=s.id)
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $maker = $application_data->sth_by;
		              
						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker."' LIMIT 1";
						$maker=$this->db->query($str1)->row();
						
		                if (!empty($maker->email_address) && $maker->email_address != null) {
		                   $subject="1st Legal Notice Returned!!";
						   $req_type=$application_data->legal_notice_sts;
						   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
						   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
						    Your Approved 1st Legal Notice Has been Returned.<br/><br/>
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
				$data2 = $this->user_model->user_activities(11,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','HO Checker Return Legal Notice('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
			
		}
		if($this->input->post('type')=='acknowledgement'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],'6','legal_notice_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('legal_notice_sts' => 6,'ack_by'=> $this->session->userdata['ast_user']['user_id'], 'ack_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);
				$data2 = $this->user_model->user_activities(6,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','acknowledgement Legal Notice('.$this->input->post('deleteEventId').')');
			}
		}
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],'11,12,13','legal_notice_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('legal_notice_sts' => 13,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);
				$data2 = $this->user_model->user_activities(13,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Verify Legal Notice('.$this->input->post('deleteEventId').')');
			}
		}
		if ($this->input->post('type')=='sentlegalnotice') {
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],'14','legal_notice_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('legal_notice_sts' => 14,'legal_notice_s_by'=> $this->session->userdata['ast_user']['user_id'], 'legal_notice_s_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);
				$data2 = $this->user_model->user_activities(14,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Send Legal Notice('.$this->input->post('deleteEventId').')');
				// For insert cost data
				$str="SELECT  j0.req_type,j0.cif,j0.loan_ac,j0.org_loan_ac,j0.ac_name,j0.loan_segment,j0.region,j0.territory,j0.district,j0.id,j0.lawyer,j0.current_address,j0.proposed_type
	                         FROM legal_notice j0
	                     WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
	            $count=0;//Fixed for borower 3 address
	            $application_data=$this->db->query($str)->row();
	            $vendor_id = $application_data->lawyer;
	            $loan_ac = $application_data->loan_ac;
	            $cif = $application_data->cif;
	            $org_loan_ac = $application_data->org_loan_ac;
	            $ac_name = $application_data->ac_name;
	            $req_type = $application_data->req_type;
	            $loan_segment = $application_data->loan_segment;
	            $region = $application_data->region;
	            $territory = $application_data->territory;
	            $district = $application_data->district;
	            $proposed_type = $application_data->proposed_type;
	            // if ($application_data->current_address!='') {//Checking Borrower 4th address
	            // 	$count++;

	            // }
	            $str="SELECT  j0.*
	                         FROM legal_notice_guarantor j0
	                     WHERE j0.legal_notice_id= '".$this->input->post('deleteEventId')."'";
	            $TotalRows=$this->db->query($str)->result();
	            foreach ($TotalRows as $key) //Counint the total adress of guarantor
	            {
	            	if ($key->present_address!='') {
	            		$str = str_replace(' ', '', $key->present_address);
	            		if(strlen($str)>0)
	            		{
	            			$count++;
	            		}
	            		
	            	}
	            	if ($key->permanent_address!='') {
	            		$str = str_replace(' ', '', $key->permanent_address);
	            		if(strlen($str)>0)
	            		{
	            			$count++;
	            		}
	            	}
	            	if ($key->business_address!='') {
	            		$str = str_replace(' ', '', $key->business_address);
	            		if(strlen($str)>0)
	            		{
	            			$count++;
	            		}
	            	}
	            }
	            //For get ammount
	            $str="SELECT  j0.*
	                         FROM ref_ln_cost j0
	                     WHERE j0.type= '1' LIMIT 1";
	            $cost_amount=$this->db->query($str)->row();
	            $pad_cost = $cost_amount->cost*$count;
	            $sig_cost = $cost_amount->signatur_cost*$count;
	            $per_cost = $cost_amount->cost+$cost_amount->signatur_cost;
	            //For Pad Cost
	            $cost_data = array(
	            	'module_name' => 'legal_notice',
	                'main_table_name' => 'legal_notice',
	                'main_table_id' => $this->input->post('deleteEventId'),
	                'vendor_type' => 1,
	                'vendor_id' => $vendor_id,
	                'activities_id' => 0,
	                'amount' =>$pad_cost,
	                'qty' =>$count,
	                'description' => '1st legal notice @ lawyer pad',
					'txrn_dt' => date("Y-m-d H:i:s"),
					'loan_ac' =>$loan_ac,
					'cif' =>$cif,
					'org_loan_ac' =>$org_loan_ac,
					'ac_name' =>$ac_name,
					'req_type' =>$req_type,
					'proposed_type' =>$proposed_type,
					'loan_segment' =>$loan_segment,
					'region' =>$region,
					'territory' =>$territory,
					'district' =>$district,
	            );
	            $data3=$this->user_model->cost_details_legal_notice($cost_data);
	            //For Signature Cost
	            $cost_data = array(
	            	'module_name' => 'legal_notice',
	                'main_table_name' => 'legal_notice',
	                'main_table_id' => $this->input->post('deleteEventId'),
	                'vendor_type' => 1,
	                'vendor_id' => $vendor_id,
	                'activities_id' => 0,
	                'amount' =>$sig_cost,
	                'qty' =>$count,
	                'ln_total_qty' =>$count,
	                'ln_per_cost' =>$per_cost,
	                'ln_cost_select_sts' =>1,
	                'description' => '1st legal notice @ lawyer pad Signatur Cost',
					'txrn_dt' => date("Y-m-d H:i:s"),
					'loan_ac' =>$loan_ac,
					'cif' =>$cif,
					'org_loan_ac' =>$org_loan_ac,
					'ac_name' =>$ac_name,
					'req_type' =>$req_type,
					'proposed_type' =>$proposed_type,
					'loan_segment' =>$loan_segment,
					'region' =>$region,
					'territory' =>$territory,
					'district' =>$district,
	            );
	            $data3=$this->user_model->cost_details_legal_notice($cost_data);

	            $application_data = $this->db->query("SELECT loan_ac,e_by from legal_notice where id='".$_POST['deleteEventId']."'")->row();
				$subject = "1st Legal Notice sent on this A/C-".$application_data->loan_ac.', Sending Date: '.date('d-M-Y');
	        	$url = base_url()."legal_notice/details";
	        	$data2 = $this->Common_model->push_notification_data($subject,$url,'legal_notice',$_POST['deleteEventId'],date('Y-m-d'),'',$application_data->e_by,'1');
			}
		}
		if($this->input->post('type')=='decline'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['deleteEventId'],'11,12,13','legal_notice_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('legal_notice_sts' => 12,'ho_decline_reason'=>trim($_POST['reason']),'ho_decline_by'=> $this->session->userdata['ast_user']['user_id'], 'ho_decline_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_notice', $data);

				if ($this->db->affected_rows() > 0) 
				{
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'decline')
					{
						$str="SELECT  j0.sl_no,j0.sth_by,s.name as legal_notice_sts
									 FROM legal_notice j0
									 LEFT OUTER JOIN ref_status s on(j0.legal_notice_sts=s.id)
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $maker = $application_data->sth_by;
		              
						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker."' LIMIT 1";
						$maker=$this->db->query($str1)->row();
						
		                if (!empty($maker->email_address) && $maker->email_address != null) {
		                   $subject="1st Legal Notice Declined!!";
						   $req_type=$application_data->legal_notice_sts;
						   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
						   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
						    Your Approved 1st Legal Notice Has been Declined.<br/><br/>
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
				$data2 = $this->user_model->user_activities(12,'f_legal_notice',$this->input->post('deleteEventId'),'legal_notice','Ho Decline Legal Notice('.$this->input->post('deleteEventId').')',$_POST['reason']);
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
		if($this->input->post('operation')=='ack'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['event_id_'.$i],'6','legal_notice_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('legal_notice_sts' => 6,'ack_by'=> $this->session->userdata['ast_user']['user_id'], 'ack_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('legal_notice', $data);
						$data2 = $this->user_model->user_activities(6,'f_legal_notice',$_POST['event_id_'.$i],'legal_notice','acknowledgement Legal Notice('.$_POST['event_id_'.$i].')');
					}
			 	}
				
			}
		}
		if($this->input->post('operation')=='sta'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['event_id_'.$i],'10','legal_notice_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('legal_notice_sts' =>10,'holm_checker_id' => $this->input->post('holm'),'lawyer' => $this->input->post('lawyer'), 'sth_by'=> $this->session->userdata['ast_user']['user_id'], 'sth_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('legal_notice', $data);
						$data2 = $this->user_model->user_activities(10,'f_legal_notice',$_POST['event_id_'.$i],'legal_notice','Send to HO Checker('.$_POST['event_id_'.$i].')');
					}
			 	}
				
			}
		}
		if($this->input->post('operation')=='sta_return'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['event_id_'.$i],'9,10','legal_notice_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('legal_notice_sts' => 9,'life_cycle'=>1,'ho_return_reason'=>trim($_POST['hidden_return_reason']),'ho_r_by'=> $this->session->userdata['ast_user']['user_id'], 'ho_r_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('legal_notice', $data);
						$data2 = $this->user_model->user_activities(9,'f_legal_notice',$_POST['event_id_'.$i],'legal_notice','Return Legal Notice('.$_POST['event_id_'.$i].')',$_POST['hidden_return_reason']);
					}
			 	}
				
			}
		}
		if($this->input->post('operation')=='apv'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['event_id_'.$i],'13','legal_notice_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('legal_notice_sts' => 13,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('legal_notice', $data);
						$data2 = $this->user_model->user_activities(13,'f_legal_notice',$_POST['event_id_'.$i],'legal_notice','Verify Legal Notice('.$_POST['event_id_'.$i].')');
					}
			 	}
				
			}
		}
		if($this->input->post('operation')=='holm_return'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['event_id_'.$i],'11,12,13','legal_notice_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('legal_notice_sts' => 11,'holm_r_reason'=>trim($_POST['hidden_return_reason']),'holm_r_by'=> $this->session->userdata['ast_user']['user_id'], 'holm_r_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('legal_notice', $data);
						$data2 = $this->user_model->user_activities(11,'f_legal_notice',$_POST['event_id_'.$i],'legal_notice','HO Checker Return Legal Notice('.$_POST['event_id_'.$i].')',$_POST['hidden_return_reason']);
					}
			 	}
				
			}
		}
		if($this->input->post('operation')=='lns'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('legal_notice',$_POST['event_id_'.$i],'14','legal_notice_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('legal_notice_sts' => 14,'legal_notice_s_by'=> $this->session->userdata['ast_user']['user_id'], 'legal_notice_s_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('legal_notice', $data);
						$data2 = $this->user_model->user_activities(14,'f_legal_notice',$_POST['event_id_'.$i],'legal_notice','Send Legal Notice('.$_POST['event_id_'.$i].')');
						// For insert cost data
						$str="SELECT  j0.req_type,j0.cif,j0.loan_ac,j0.org_loan_ac,j0.ac_name,j0.loan_segment,j0.region,j0.territory,j0.district,j0.id,j0.lawyer,j0.current_address,j0.proposed_type
			                         FROM legal_notice j0
			                     WHERE j0.id= '".$_POST['event_id_'.$i]."' LIMIT 1";
			            $count=0;//Fixed for borower 3 address
			            $application_data=$this->db->query($str)->row();
			            $vendor_id = $application_data->lawyer;
			            $loan_ac = $application_data->loan_ac;
			            $cif = $application_data->cif;
			            $org_loan_ac = $application_data->org_loan_ac;
			            $ac_name = $application_data->ac_name;
			            $req_type = $application_data->req_type;
			            $loan_segment = $application_data->loan_segment;
			            $region = $application_data->region;
			            $territory = $application_data->territory;
			            $district = $application_data->district;
			            $proposed_type = $application_data->proposed_type;
			            if ($application_data->current_address!='') {//Checking Borrower 4th address
			            	$count++;
			            }
			            $str="SELECT  j0.*
			                         FROM legal_notice_guarantor j0
			                     WHERE j0.legal_notice_id= '".$_POST['event_id_'.$i]."'";
			            $TotalRows=$this->db->query($str)->result();
			            foreach ($TotalRows as $key) //Counint the total adress of guarantor
			            {
			            	if ($key->present_address!='') {
			            		$count++;
			            	}
			            	if ($key->permanent_address!='') {
			            		$count++;
			            	}
			            	if ($key->business_address!='') {
			            		$count++;
			            	}
			            }
			            //For get ammount
			            $str="SELECT  j0.*
			                         FROM ref_ln_cost j0
			                     WHERE j0.type= '1' LIMIT 1";
			            $cost_amount=$this->db->query($str)->row();
			            $pad_cost = $cost_amount->cost*$count;
			            $sig_cost = $cost_amount->signatur_cost*$count;
			            $per_cost = $cost_amount->cost+$cost_amount->signatur_cost;
			            //For Pad Cost
			            $cost_data = array(
			            	'module_name' => 'legal_notice',
			                'main_table_name' => 'legal_notice',
			                'main_table_id' => $_POST['event_id_'.$i],
			                'vendor_type' => 1,
			                'vendor_id' => $vendor_id,
			                'activities_id' => 0,
			                'amount' =>$pad_cost,
			                'qty' =>$count,
			                'description' => '1st legal notice @ lawyer pad',
							'txrn_dt' => date("Y-m-d H:i:s"),
							'loan_ac' =>$loan_ac,
							'cif' =>$cif,
							'org_loan_ac' =>$org_loan_ac,
							'ac_name' =>$ac_name,
							'req_type' =>$req_type,
							'proposed_type' =>$proposed_type,
							'loan_segment' =>$loan_segment,
							'region' =>$region,
							'territory' =>$territory,
							'district' =>$district,
			            );
			            $data3=$this->user_model->cost_details_legal_notice($cost_data);
			            //For Signature Cost
			            $cost_data = array(
			            	'module_name' => 'legal_notice',
			                'main_table_name' => 'legal_notice',
			                'main_table_id' => $_POST['event_id_'.$i],
			                'vendor_type' => 1,
			                'vendor_id' => $vendor_id,
			                'activities_id' => 0,
			                'amount' =>$sig_cost,
			                'qty' =>$count,
			                'ln_total_qty' =>$count,
			                'ln_per_cost' =>$per_cost,
			                'ln_cost_select_sts' =>1,
			                'description' => '1st legal notice @ lawyer pad Signatur Cost',
							'txrn_dt' => date("Y-m-d H:i:s"),
							'loan_ac' =>$loan_ac,
							'cif' =>$cif,
							'org_loan_ac' =>$org_loan_ac,
							'ac_name' =>$ac_name,
							'req_type' =>$req_type,
							'proposed_type' =>$proposed_type,
							'loan_segment' =>$loan_segment,
							'region' =>$region,
							'territory' =>$territory,
							'district' =>$district,
			            );
			            $data3=$this->user_model->cost_details_legal_notice($cost_data);
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
	public function get_word_data($id){
		$where = "j0.id='".$id."'";
		$this->db
			->select("j0.id,j0.ln_serial,j0.proposed_type,j0.sl_no,r.name as loan_type,j0.loan_ac,DATE_FORMAT(j0.v_dt,'%d-%M-%Y') as ln_v_dt,j0.ac_name,
				j0.current_address,j9.name,j9.designation,j9.chamber,j8.name as tm_name,j8.mobile_number,j9.signature,
				c.name as court_name", FALSE)
			->from('legal_notice as j0')
			->join('ref_req_type as r', 'j0.req_type=r.id', 'left')
			->join("users_info as j8", "j0.rec_by=j8.id", "left")
			->join("ref_lawyer as j9", "j0.lawyer=j9.id", "left")
			->join("ref_court as c", "j9.court_id=c.id", "left")
			->where($where,NULL,FALSE);


			$query = $this->db->get()->result_array();
			foreach($query as $i=>$product) {
				
				$grt=" select g.* ,
					IF(g.guar_sts='', ' ', s.name) as guar_sts_name,
					IF(g.guarantor_type='', ' ', t.name) as type_name,
					IF(g.occ_sts='', ' ', o.name) as occ_sts_name
					from legal_notice_guarantor g
					left outer join ref_guar_type t on (g.guarantor_type=t.code)
					left outer join ref_guar_sts s on (g.guar_sts=s.id)
					left outer join ref_guar_occ o on (g.occ_sts=o.code)
					where g.legal_notice_id='".$product['id']."' and g.sts=1 
					order by case when g.guarantor_type = 'M' then 1 else 2 end";
				$images_query =$this->db->query($grt)->result_array();
				
				
		   		$query[$i]['guarntor'] = $images_query;
			}
			foreach($query as $i=>$product) {
				if($product['proposed_type']=='Loan'){
					$this->db->select("sum(f0.outstanding_bl) AS outstanding_bl,
				GROUP_CONCAT(DISTINCT(DATE_FORMAT(f0.disbursement_date,'%d-%b-%y')) ORDER BY f0.id ASC SEPARATOR ',') AS disbursement_date,
				GROUP_CONCAT(DISTINCT(DATE_FORMAT(f0.outstanding_bl_dt,'%d-%b-%y')) ORDER BY f0.id ASC SEPARATOR ',') AS outstanding_bl_dt,
				GROUP_CONCAT(DISTINCT(f0.sch_desc) ORDER BY f0.id ASC SEPARATOR ',') AS sch_desc_s,
				GROUP_CONCAT(DISTINCT(f0.ac_number) ORDER BY f0.id ASC SEPARATOR ',') AS l_ac_numbers,
				GROUP_CONCAT(DISTINCT(f0.ac_name) ORDER BY f0.id ASC SEPARATOR ',') AS l_ac_names,
				GROUP_CONCAT(f0.disbursed_amount ORDER BY f0.id ASC SEPARATOR ',') AS disbursed_amount");
					$this->db->from('legal_notice_facility as f0');
					$this->db->where('f0.legal_notice_id', $product['id']);
					$this->db->where('f0.sts', '1');
					$this->db->where('f0.section_type', 'loan');
					
			   		$images_query = $this->db->get()->result_array();
			   		$query[$i]['facility_loan'] = $images_query;

				}else{
					$this->db->select("date_format(card_iss_date,'%d/%m/%Y') as card_iss_date,
					date_format(card_exp_date,'%d/%m/%Y') as card_exp_date,
					card_limit,outstanding_bl");
					$this->db->from('legal_notice');
					$this->db->where('id', $product['id']);
					$this->db->where('sts', '1');

			   		$images_query = $this->db->get()->result_array();
			   		$query[$i]['facility'] = $images_query;
				}
			}
			return  $query;
	}
	public function get_word_card_data($id){
		$where = "l.id='".$id."' AND l.sts='1'";
		$this->db
			->select("l.sl_no,l.customer_id,l.ln_serial,l.loan_ac,l.org_loan_ac,l.ac_name, c.name as court_name,DATE_FORMAT(l.v_dt,'%d-%M-%Y') as ln_v_dt,
			l.current_address,DATE_FORMAT(l.card_iss_date,'%d-%b-%y') AS card_iss_date,
			DATE_FORMAT(l.outstanding_bl_dt,'%d-%b-%y') AS outstanding_bl_dt,
			DATE_FORMAT(l.card_exp_date,'%d-%b-%y') AS card_exp_date,
			l.card_limit,l.outstanding_bl,j0.name,j0.designation,j0.signature,j0.chamber,j1.name as tm_name,j1.mobile_number,l.proposed_type,l.id
				", FALSE)
			->from('legal_notice AS l')
			->join('ref_lawyer as j0', 'l.lawyer=j0.id', 'left')
			// ->join("users_info as j1", "l.rec_by=j1.id", "left")
			->join("users_info as j1", "l.e_by=j1.id", "left")
			->join("ref_court as c", "j0.court_id=c.id", "left")
			->where($where,NULL,FALSE);
			$query = $this->db->get()->result_array();
			
			
			foreach($query as $i=>$product) {
				
				$grt=" select g.* ,
					IF(g.guar_sts='', ' ', s.name) as guar_sts_name,
					IF(g.guarantor_type='', ' ', t.name) as type_name,
					IF(g.occ_sts='', ' ', o.name) as occ_sts_name
					from legal_notice_guarantor g
					left outer join ref_guar_type t on (g.guarantor_type=t.code)
					left outer join ref_guar_sts s on (g.guar_sts=s.id)
					left outer join ref_guar_occ o on (g.occ_sts=o.code)
					where g.legal_notice_id='".$product['id']."' and g.sts=1 and  g.guarantor_type = 'M'
					";
				$images_query =$this->db->query($grt)->result_array();
		   		$query[$i]['guarntor'] = $images_query;
			}
			return  $query;
	}

}
?>
