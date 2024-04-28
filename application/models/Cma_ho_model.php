<?php
class Cma_ho_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
	}



	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "b.sts!='0' and b.life_cycle IN(2,3,4)";
	   	if($this->input->get('region')!='') 
		{$where2.=" AND b.region = ".$this->db->escape(trim($this->input->get('region')));}
		if($this->input->get('territory')!='') 
		{$where2.=" AND b.territory = ".$this->db->escape(trim($this->input->get('territory')));}
		if($this->input->get('district')!='') 
		{$where2.=" AND b.district = ".$this->db->escape(trim($this->input->get('district')));}
		if($this->input->get('proposed_type_grid')!='') 
        {$where2.=" AND b.proposed_type = '".trim($this->input->get('proposed_type_grid'))."'";}

    	if($this->input->get('loan_ac_grid')!='' && $this->input->get('proposed_type_grid')!='') 
        {
            if ($this->input->get('proposed_type_grid')=='Loan') {
                $where2.= " AND b.loan_ac='".$this->input->get('loan_ac_grid')."'";
            }else if($this->input->get('proposed_type_grid')=='Card')
            {
                $where2.= " AND b.org_loan_ac = '".$this->Common_model->stringEncryption('encrypt',$this->input->get('hidden_loan_ac_grid'))."'";
            }
        }

	   	if($this->input->get('rec_dt_from') != '' && $this->input->get('rec_dt_from')!=0 && ($this->input->get('rec_dt_to') == '' || $this->input->get('rec_dt_to')==0)) 
		{$where2.=" AND DATE(b.rec_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('rec_dt_from')))))."'";}
		if($this->input->get('rec_dt_from') != '' && $this->input->get('rec_dt_from')!=0 && $this->input->get('rec_dt_to') != '' && $this->input->get('rec_dt_to')!=0) 
		{$where2.=" AND DATE(b.rec_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('rec_dt_from')))))."' AND DATE(b.rec_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('rec_dt_to')))))."'";}
		if($this->input->get('status')!='') 
		{
			if($this->input->get('status')=='00')
			{

				$where2.=" AND b.migration_sts=1"; 
			}
			else
			{
				$where2.=" AND b.cma_sts = '".trim($this->input->get('status'))."'";
				$where2.=" AND b.migration_sts<>1"; 
			}
		}
		else
		{
			$where2.=" AND b.migration_sts<>1"; 
		}
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
				else if($filterdatafield=='case_file_district')
				{
					$filterdatafield='cfd.name';
				}
				else if($filterdatafield=='unit_office_name')
				{
					$filterdatafield='j10.name';
				}
				else if($filterdatafield=='e_by')
				{
					//$filterdatafield='j2.name';
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
				else if($filterdatafield=='ho_return_reason')
				{
					$filterdatafield='b.ho_return_reason';
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
		// $where_initi=''; 
		// if($where=='' || count($where)<=0){			
		// 	$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		// }
		
		if ($sortorder == '')
		{
			//$sortdatafield="b.id";
			//$sortorder = "DESC";	
			$sortdatafield="j6.s_order";	
			$sortorder = "ASC";				
		}
	    $this->db
	    ->select('SQL_CALC_FOUND_ROWS b.*,IF(b.ho_return_reason IS NOT NULL OR b.holm_r_reason IS NOT NULL OR b.ho_decline_reason IS NOT NULL,1,"") as return_reason,A.other_ac,IF(b.cma_sts="10",CONCAT(j6.name," (",j12.user_id,")"),IF(b.cma_sts="59",CONCAT(j6.name," (",j15.pin,")"),j6.name)) as status,j7.name as region_name,j8.name as territory_name,
	    	j9.name as district_name,s.name as loan_segment,j10.name as unit_office_name,
	    	j1.name as request_type_name,IF(j6.s_order=30,1,j6.s_order) as priority_order,
	    	CONCAT(j2.name," (",j2.user_id,")")as e_by,
	    	cfd.name as case_file_district,
	    	CONCAT(j13.name," (",j13.user_id,")")as sth_by,
		    CONCAT(j14.name," (",j14.user_id,")")as v_by,
	    	CONCAT(j4.name," (",j4.user_id,")")as stc_by,
	    	CONCAT(j5.name," (",j5.user_id,")")as rec_by,
	    	DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
	    	DATE_FORMAT(b.stc_dt,"%d-%b-%y %h:%i %p") AS stc_dt,
	    	DATE_FORMAT(b.rec_dt,"%d-%b-%y %h:%i %p") AS rec_dt,
	    	DATE_FORMAT(b.sth_dt,"%d-%b-%y %h:%i %p") AS sth_dt,
		    DATE_FORMAT(b.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
	    	', FALSE)
			->from("cma b")
			->join('ref_req_type as j1', 'b.req_type=j1.id', 'left')
			->join('users_info as j2', 'b.e_by=j2.id', 'left')
			->join('users_info as j4', 'b.stc_by=j4.id', 'left')
			->join('users_info as j5', 'b.rec_by=j5.id', 'left')
			->join('ref_status as j6', 'b.cma_sts=j6.id', 'left')
			->join('ref_region as j7', 'b.region=j7.id', 'left')
			->join('ref_territory as j8', 'b.territory=j8.id', 'left')
			->join('ref_district as j9', 'b.district=j9.id', 'left')
			->join('ref_district as cfd', 'b.case_fill_dist=cfd.id', 'left')
			->join('ref_unit_office as j10', 'b.unit_office=j10.id', 'left')
			->join('users_info as j12', 'b.holm_checker_id=j12.id', 'left')
			->join('users_info as j13', 'b.sth_by=j13.id', 'left')
			->join('users_info as j14', 'b.v_by=j14.id', 'left')
			->join('users_info as j15', 'b.hoops_user=j15.id', 'left')
			->join('ref_loan_segment as s', 'b.loan_segment=s.code', 'left')
			->join('(SELECT f.cma_id,GROUP_CONCAT(IF(c.loan_ac<>f.ac_number,f.ac_number,NULL)  ORDER BY f.id ASC SEPARATOR ", " ) AS other_ac
                FROM cma_facility f 
                LEFT OUTER JOIN cma c ON(f.cma_id=c.id)
                WHERE f.sts<>0 
                GROUP BY f.cma_id) A', 'b.id=A.cma_id', 'left')
			->where($where)
			->where($where2)
			->order_by("priority_order ASC")
			//->order_by($sortdatafield,$sortorder)
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
			$where2.=" AND b.cma_sts IN(3,33)";
		}
		if ($this->input->post('operation')=='sta') 
		{
			$where2.=" AND b.cma_sts IN(6,11,7,8) AND b.ack_by='".$this->session->userdata['ast_user']['user_id']."'";
		}
		if ($this->input->post('operation')=='apv') 
		{
			$where2.=" AND b.cma_sts = '10' AND b.holm_checker_id='".$this->session->userdata['ast_user']['user_id']."'";
		}
		if ($this->input->post('operation')=='sthoops') 
		{
			$where2.=" AND b.cma_sts = '13'";
		}
		if($this->input->post('proposed_type')!='') 
		{$where2.=" AND b.proposed_type='".trim($this->input->post('proposed_type'))."'";}
		if($this->input->post('req_type')!='' && $this->input->post('req_type')!=0) 
		{$where2.=" AND b.req_type = '".trim($this->input->post('req_type'))."'";}

	   	if($this->input->post('region')!='' && $this->input->post('region')!=0) 
		{$where2.=" AND b.legal_region = ".$this->db->escape(trim($this->input->post('region')));}
		if($this->input->post('territory')!='' && $this->input->post('territory')!=0) 
		{$where2.=" AND b.territory = ".$this->db->escape(trim($this->input->post('territory')));}
		if($this->input->post('district')!='' && $this->input->post('district')!=0) 
		{$where2.=" AND b.district = ".$this->db->escape(trim($this->input->post('district')));}
		if($this->input->post('unit_office')!='' && $this->input->post('unit_office')!=0) 
		{$where2.=" AND b.unit_office = ".$this->db->escape(trim($this->input->post('unit_office')));}
	   	if($this->input->post('rec_dt_from') != '' && $this->input->post('rec_dt_from')!=0 && ($this->input->post('rec_dt_to') == '' || $this->input->post('rec_dt_to')==0)) 
		{$where2.=" AND DATE(b.rec_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('rec_dt_from')))))."'";}
		if($this->input->post('rec_dt_from') != '' && $this->input->post('rec_dt_from')!=0 && $this->input->post('rec_dt_to') != '' && $this->input->post('rec_dt_to')!=0) 
		{$where2.=" AND DATE(b.rec_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('rec_dt_from')))))."' AND DATE(b.rec_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('rec_dt_to')))))."'";}
		
		if($this->input->post('loan_segment')!='' && $this->input->post('loan_segment')!='') 
		{$where2.=" AND b.loan_segment = ".$this->db->escape(trim($this->input->post('loan_segment')));}

		$this->db
    	->select('b.id,b.loan_ac,b.sl_no,s.name as loan_segment,j7.name as region_name,j8.name as territory_name,
    	j9.name as district_name,j10.name as unit_office_name,
    	CONCAT(j5.name," (",j5.user_id,")")as rec_by,
    	DATE_FORMAT(b.rec_dt,"%d-%b-%y %h:%i %p") AS rec_dt
    	', FALSE)
			->from("cma b")
			->join('users_info as j5', 'b.rec_by=j5.id', 'left')
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
			->select("b.*", FALSE)
			->from("cma b")
			->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function get_info($add_edit,$id) // get data for edit
	{
		if($id!=''){
			$this->db
			->select("j0.*", FALSE)
			->from('cma as j0')
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
			->select("j0.*,auc.name as pre_auc_sts,a.auction_sts,CONCAT(j13.name,' (',j13.code,')') as branch_sol,
				j1.name as region_name,j2.name as territory_name,j3.name as district_name,
				j4.name as unit_office_name,r.name as req_type,r2.name as legal_region_name,
				j6.name as subject_name,j7.name as loan_segment,j8.name as e_by,
				CONCAT(j9.name,' (',j9.pin,')') as stc_by,
				CONCAT(j12.name,' (',j12.pin,')') as sth_by,
				CONCAT(j11.name,' (',j11.pin,')') as auction_complete_by,
				CONCAT(j10.name,' (',j10.pin,')') as rec_by,
				DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,
				DATE_FORMAT(j0.loan_sanction_dt,'%d-%b-%y %h:%i %p') AS loan_sanction_dt,
				DATE_FORMAT(j0.chq_expiry_date,'%d-%b-%y ') AS chq_expiry_date,
				DATE_FORMAT(j0.sth_dt,'%d-%b-%y %h:%i %p') AS sth_dt,
				DATE_FORMAT(j0.pre_case_fill_dt,'%d-%b-%y %h:%i %p') AS pre_case_fill_dt,
				DATE_FORMAT(j0.last_payment_date,'%d-%b-%y %h:%i %p') AS last_payment_date,
				DATE_FORMAT(j0.call_up_serv_dt,'%d-%b-%y %h:%i %p') AS call_up_serv_dt,
				DATE_FORMAT(a.ack_dt,'%d-%b-%y %h:%i %p') AS auction_complete_dt,
				r.name as req_type,
				DATE_FORMAT(j0.stc_dt,'%d-%b-%y %h:%i %p') AS stc_dt,DATE_FORMAT(j0.rec_dt,'%d-%b-%y %h:%i %p') AS rec_dt", FALSE)
			->from('cma as j0')
			->join('ref_auc_sts as auc', 'j0.pre_auc_sts=auc.id', 'left')
			->join('cma_auction as a', 'j0.id=a.cma_id', 'left')
			->join('ref_req_type as r', 'j0.req_type=r.id', 'left')
			->join("ref_region as j1", "j0.region=j1.id", "left")
			->join("ref_region as r2", "j0.legal_region=r2.id", "left")
			->join("ref_territory as j2", "j0.territory=j2.id", "left")
			->join("ref_district as j3", "j0.district=j3.id", "left")
			->join("ref_unit_office as j4", "j0.unit_office=j4.id", "left")
			->join("ref_subject_type as j6", "j0.sub_type=j6.id", "left")
			->join("ref_loan_segment as j7", "j0.loan_segment=j7.code", "left")
			->join("users_info as j8", "j0.e_by=j8.id", "left")
			->join("users_info as j9", "j0.stc_by=j9.id", "left")
			->join("users_info as j10", "j0.rec_by=j10.id", "left")
			->join("users_info as j11", "a.ack_by=j11.id", "left")
			->join("users_info as j12", "j0.sth_by=j12.id", "left")
			->join("ref_branch_sol as j13", "j0.branch_sol=j13.code", "left")
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
				date_format(j0.disbursement_date,'%d-%b-%y') as disbursement_date,
				date_format(j0.write_off_dt,'%d-%b-%y') as write_off_dt,
				date_format(j0.belance_dt,'%d-%b-%y') as belance_dt
			FROM cma_facility as j0
			LEFT OUTER JOIN ref_facility_name as f on (f.code=j0.facility_type)
			WHERE j0.cma_id= ".$this->db->escape($id)." AND j0.sts='1' AND j0.section_type='loan' ORDER BY id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_mortgage($id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT j0.*,v.name as valuator_name,rv.name as re_valuator_name,
				date_format(j0.mortgage_date,'%d-%b-%y') as mortgage_date,
				date_format(j0.valuator_date,'%d-%b-%y') as valuator_date,
				date_format(j0.re_valuator_date,'%d-%b-%y') as re_valuator_date
			FROM cma_facility_mortgage as j0
			LEFT OUTER JOIN ref_valuator as v on(v.id=j0.valuator_name)
			LEFT OUTER JOIN ref_revaluator as rv on(rv.id=j0.re_valuator_name)
			WHERE j0.cma_id= ".$this->db->escape($id)." AND j0.sts='1' ORDER BY j0.id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_security($id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT j0.*,j1.name as deed_type,d.name as district,t.name as thana,s.name as sub_reg_office,
				date_format(j0.reg_date,'%d-%b-%y') as reg_date,j2.name as mouza
			FROM cma_facility_mortgage_security as j0
			LEFT OUTER JOIN csms_ref_districts as d on(d.id=j0.district)
			LEFT OUTER JOIN csms_ref_thana as t on(t.id=j0.thana)
			LEFT OUTER JOIN csms_ref_sro_office_name as s on(s.id=j0.sub_reg_office)
			LEFT OUTER JOIN csms_ref_type_of_deed as j1 on(j1.id=j0.deed_type)
			LEFT OUTER JOIN csms_ref_mouza as j2 on(j2.id=j0.mouza)
			WHERE j0.cma_id= ".$this->db->escape($id)." AND j0.sts='1' ORDER BY j0.id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_bidder($id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT j0.*,b.name as bidder_rank,
				date_format(j0.pay_order_date,'%d-%b-%y') as pay_order_date
			FROM cma_auction_bidder as j0
			LEFT OUTER JOIN ref_bidder_rank b on(b.id=j0.bidder_rank)
			WHERE j0.cma_id= ".$this->db->escape($id)." AND j0.sts='1' ORDER BY j0.id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_card_facility($id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT f.id,DATE_FORMAT(f.card_issue_dt,'%d-%b-%Y') as card_issue_dt,
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
	function get_edit_card_facility($id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT
				date_format(j0.card_iss_date,'%d-%b-%y') as card_iss_date,
				date_format(j0.card_exp_date,'%d-%b-%y') as card_exp_date,
				date_format(j0.outstanding_bl_dt,'%d-%b-%y') as outstanding_bl_dt,
				j0.card_limit,j0.outstanding_bl
			FROM cma as j0
			WHERE j0.id= ".$this->db->escape($id)." AND j0.sts='1' ORDER BY id ASC";
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
			$this->db->update('cma', $facility_info);
			$data2 = $this->user_model->user_activities(34,'cma',$this->input->post('deleteEventId'),'cma_facility','Update Card Facility('.$this->input->post('deleteEventId').')');
		}
		//For Loan
		else
		{
			for($i=1;$i<= $_POST['facility_info_counter'];$i++)
			{
				$facility_info = array(
				'cma_id' => $this->security->xss_clean( $this->input->post('deleteEventId')),
				'facility_type' =>$this->security->xss_clean( $this->input->post('facility_type_'.$i)),
				'disbursement_date'=>implode('-',array_reverse(explode('/',$this->input->post('disbursement_date_'.$i)))),
				'expire_date'=>implode('-',array_reverse(explode('/',$this->input->post('expire_date_'.$i)))),
				'int_rate' => $this->security->xss_clean( $this->input->post('int_rate_'.$i)),
				'disbursed_amount' => $this->security->xss_clean( $this->input->post('disbursed_amount_'.$i)),
				'loan_tenor' => $this->security->xss_clean( $this->input->post('loan_tenor_'.$i)),
				'payble' => $this->security->xss_clean( $this->input->post('payble_'.$i)),
				'repayment' => $this->security->xss_clean( $this->input->post('repayment_'.$i)),
				'outstanding_bl' => $this->security->xss_clean( $this->input->post('outstanding_bl_'.$i)),
				'outstanding_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('outstanding_bl_dt_'.$i)))),
				'overdue_bl' => $this->security->xss_clean( $this->input->post('overdue_bl_'.$i)),
				'overdue_bl_dt'=>implode('-',array_reverse(explode('/',$this->input->post('overdue_bl_dt_'.$i)))),
				'call_up_dt'=>implode('-',array_reverse(explode('/',$this->input->post('call_up_dt_'.$i)))),
				'cl_bb' => $this->security->xss_clean( $this->input->post('cl_bb_'.$i)),
				'cl_bbl' => $this->security->xss_clean( $this->input->post('cl_bbl_'.$i)),
				'write_off_dt' => implode('-',array_reverse(explode('/',$this->input->post('write_off_dt_'.$i)))),
				'write_off_amount' => $this->security->xss_clean( $this->input->post('write_off_amount_'.$i)),
				'recovery_after_Wf' => $this->security->xss_clean( $this->input->post('recovery_after_Wf_'.$i)),
				'csms_new' => $this->security->xss_clean( $this->input->post('csms_new_'.$i)),
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
					$this->db->update('cma_facility', $data);
 				}
 				//For update the old row
 				else if($_POST['facility_info_edit_'.$i]!=0 && $_POST['facility_info_delete_'.$i]!=1)
 				{
 					$facility_info['u_by'] = $this->session->userdata['ast_user']['user_id'];
					$facility_info['u_dt'] = date('Y-m-d H:i:s');
 					$this->db->where('id',$_POST['facility_info_edit_'.$i]);
 					$this->db->where('section_type','loan');
					$this->db->update('cma_facility', $facility_info);
 				}
 				//For insert the new row
 				else if($_POST['facility_info_edit_'.$i]==0 && $_POST['facility_info_delete_'.$i]!=1)
 				{
 					$facility_info['e_by'] = $this->session->userdata['ast_user']['user_id'];
					$facility_info['e_dt'] = date('Y-m-d H:i:s');
 					$this->db->insert('cma_facility', $facility_info);
 				}
     			
			}
			$data2 = $this->user_model->user_activities(34,'cma',$this->input->post('deleteEventId'),'cma_facility','Update Loan Facility('.$this->input->post('deleteEventId').')');
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
		if(isset($_POST['sendtoholm']) && $this->input->post('sendtoholm') == 'sendtoholm'){
		$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'9,10','cma_sts');
		if (count($pre_action_result)>0) 
		{
			return 'taken';
		}
		else
		{
			$data = array('cma_sts' =>10,'holm_checker_id' => $this->input->post('checker_to_notify'), 'sth_by'=> $this->session->userdata['ast_user']['user_id'], 'sth_dt'=>date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma', $data);
			
			$data2 = $this->user_model->user_activities(10,'cma',$this->input->post('deleteEventId'),'cma','Send to HO Checker('.$this->input->post('deleteEventId').')');
		}
		
		
		}
		if($this->input->post('type')=='hold'){
			$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'7','cma_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('cma_sts' => 7,'hold_reason'=>trim($_POST['reason']),'hold_by'=> $this->session->userdata['ast_user']['user_id'], 'hold_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma', $data);
				$data2 = $this->user_model->user_activities(7,'cma',$this->input->post('deleteEventId'),'cma','Hold CMA('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
			
		}
		if($this->input->post('type')=='sendquery'){
			$data = array('cma_sts'=>8,'query'=>trim($_POST['reason']),'q_by'=> $this->session->userdata['ast_user']['user_id'], 'q_dt'=>date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma', $data);
			if ($this->db->affected_rows() > 0) 
			{
				if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'sendquery')
				{
					$str="SELECT  j0.sl_no,j0.rec_by,s.name as cma_sts
								 FROM cma j0
								 LEFT OUTER JOIN ref_status s on(j0.cma_sts=s.id)
							 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
							 
					$application_data=$this->db->query($str)->row();

	                $maker = $application_data->rec_by;
	              
					$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker."' LIMIT 1";
					$maker=$this->db->query($str1)->row();
					
	                if (!empty($maker->email_address) && $maker->email_address != null) {
	                   $subject="CMA Query!!";
					   $req_type=$application_data->cma_sts;
					   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
					   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
					    You Have some query on you initiated CMA.<br/><br/>
						Request Type: ".$req_type."<br/>
						Query: ".$_POST['reason']."<br/>
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
        	$application_data = $this->db->query("SELECT loan_ac,e_by,rec_by from cma where id='".$_POST['deleteEventId']."'")->row();
			$subject = "Case related any query by all stakeholder, A/C-".$application_data->loan_ac.',['.$_POST['reason'].']';
        	$url = base_url()."cma_process/details";
        	$data2 = $this->Common_model->push_notification_data($subject,$url,'cma',$_POST['deleteEventId'],date('Y-m-d'),'',$application_data->e_by,'1');
        	$data2 = $this->Common_model->push_notification_data($subject,$url,'cma',$_POST['deleteEventId'],date('Y-m-d'),'',$application_data->rec_by);
			$data2 = $this->user_model->user_activities(8,'cma',$this->input->post('deleteEventId'),'cma','Send query CMA('.$this->input->post('deleteEventId').')',$_POST['reason']);
		}
		if($this->input->post('type')=='return'){
			$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'9,10','cma_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('cma_sts' => 9,'life_cycle'=>1,'ho_return_reason'=>trim($_POST['reason']),'ho_r_by'=> $this->session->userdata['ast_user']['user_id'], 'ho_r_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma', $data);
				if ($this->db->affected_rows() > 0) 
				{
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'return')
					{
						$str="SELECT  j0.sl_no,j0.rec_by,s.name as cma_sts
									 FROM cma j0
									 LEFT OUTER JOIN ref_status s on(j0.cma_sts=s.id)
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $maker = $application_data->rec_by;
		              
						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker."' LIMIT 1";
						$maker=$this->db->query($str1)->row();
						
		                if (!empty($maker->email_address) && $maker->email_address != null) {
		                   $subject="CMA Returned!!";
						   $req_type=$application_data->cma_sts;
						   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
						   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
						    Your Recommended CMA Has been Returned.<br/><br/>
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
				$data2 = $this->user_model->user_activities(9,'cma',$this->input->post('deleteEventId'),'cma','Return CMA('.$this->input->post('deleteEventId').')',$_POST['reason']);
			
				$application_data = $this->db->query("SELECT loan_ac,e_by,rec_by from cma where id='".$_POST['deleteEventId']."'")->row();
				$subject = "CMA return, A/C-".$application_data->loan_ac.',['.$_POST['reason'].']';
	        	$url = base_url()."cma_process/details";
	        	$data2 = $this->Common_model->push_notification_data($subject,$url,'cma',$_POST['deleteEventId'],date('Y-m-d'),'',$application_data->e_by,'1');
	        	$data2 = $this->Common_model->push_notification_data($subject,$url,'cma',$_POST['deleteEventId'],date('Y-m-d'),'',$application_data->rec_by);
			}

			
		}
		if($this->input->post('type')=='holm_return'){
			$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'11,12,13','cma_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('cma_sts' => 11,'holm_r_reason'=>trim($_POST['reason']),'holm_r_by'=> $this->session->userdata['ast_user']['user_id'], 'holm_r_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma', $data);
			
				if ($this->db->affected_rows() > 0) 
				{
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'holm_return')
					{
						$str="SELECT  j0.sl_no,j0.sth_by,s.name as cma_sts
									 FROM cma j0
									 LEFT OUTER JOIN ref_status s on(j0.cma_sts=s.id)
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $maker = $application_data->sth_by;
		              
						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker."' LIMIT 1";
						$maker=$this->db->query($str1)->row();
						
		                if (!empty($maker->email_address) && $maker->email_address != null) {
		                   $subject="CMA Returned!!";
						   $req_type=$application_data->cma_sts;
						   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
						   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
						    Your Approved CMA Has been Returned.<br/><br/>
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
				$data2 = $this->user_model->user_activities(11,'cma',$this->input->post('deleteEventId'),'cma','HOLM Return CMA('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
			
		}
		if($this->input->post('type')=='acknowledgement'){
			$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'6','cma_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('cma_sts' => 6,'ack_by'=> $this->session->userdata['ast_user']['user_id'], 'ack_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma', $data);
				$data2 = $this->user_model->user_activities(6,'cma',$this->input->post('deleteEventId'),'cma','acknowledgement CMA('.$this->input->post('deleteEventId').')');
			}
			
		}
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'11,12,13','cma_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('cma_sts' => 13,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma', $data);
				$data2 = $this->user_model->user_activities(13,'cma',$this->input->post('deleteEventId'),'cma','Verify CMA('.$this->input->post('deleteEventId').')');
				$application_data = $this->db->query("SELECT loan_ac,e_by,sth_by from cma where id='".$_POST['deleteEventId']."'")->row();
				$subject = "CMA approved, A/C-".$application_data->loan_ac;
	        	$url = base_url()."cma_process/details";
	        	$data2 = $this->Common_model->push_notification_data($subject,$url,'cma',$_POST['deleteEventId'],date('Y-m-d'),'',$application_data->sth_by,'1');
			}
			
		}
		if($this->input->post('type')=='decline'){
			$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'11,12,13','cma_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('cma_sts' => 12,'ho_decline_reason'=>trim($_POST['reason']),'ho_decline_by'=> $this->session->userdata['ast_user']['user_id'], 'ho_decline_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('cma', $data);
				if ($this->db->affected_rows() > 0) 
				{
					if (isset($_POST['email_notification']) && $this->input->post('email_notification') == 'decline')
					{
						$str="SELECT  j0.sl_no,j0.sth_by,s.name as cma_sts
									 FROM cma j0
									 LEFT OUTER JOIN ref_status s on(j0.cma_sts=s.id)
								 WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
								 
						$application_data=$this->db->query($str)->row();

		                $maker = $application_data->sth_by;
		              
						$str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$maker."' LIMIT 1";
						$maker=$this->db->query($str1)->row();
						
		                if (!empty($maker->email_address) && $maker->email_address != null) {
		                   $subject="CMA Declined!!";
						   $req_type=$application_data->cma_sts;
						   $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
						   $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
						    Your Approved CMA Has been Declined.<br/><br/>
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
				$data2 = $this->user_model->user_activities(12,'cma',$this->input->post('deleteEventId'),'cma','Ho Decline CMA('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
			
		}
		if($this->input->post('type')=='sendtohoops'){
			// $pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'59','cma_sts');
			// if (count($pre_action_result)>0) 
			// {
			// 	return 'taken';
			// }
			// else
			// {
			// 	$data = array('hoops_user'=>$this->input->post('checker_to_notify'),'cma_sts' => 59,'life_cycle'=>3,'sthoops_by'=> $this->session->userdata['ast_user']['user_id'], 'sthoops_dt'=>date('Y-m-d H:i:s'));
			// 	$this->db->where('id', $_POST['deleteEventId']);
			// 	$this->db->update('cma', $data);
			// 	$data2 = $this->user_model->user_activities(59,'cma',$this->input->post('deleteEventId'),'cma','Send To Hoops CMA('.$this->input->post('deleteEventId').')');
			// }
			$data = array('hoops_user'=>$this->input->post('checker_to_notify'),'cma_sts' => 59,'life_cycle'=>3,'sthoops_by'=> $this->session->userdata['ast_user']['user_id'], 'sthoops_dt'=>date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('cma', $data);
			$data2 = $this->user_model->user_activities(59,'cma',$this->input->post('deleteEventId'),'cma','Send To Hoops CMA('.$this->input->post('deleteEventId').')');
			
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
			 		$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['event_id_'.$i],'6','cma_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('cma_sts' => 6,'ack_by'=> $this->session->userdata['ast_user']['user_id'], 'ack_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('cma', $data);
						$data2 = $this->user_model->user_activities(6,'cma',$_POST['event_id_'.$i],'cma','acknowledgement CMA('.$_POST['event_id_'.$i].')');
					}
			 	}
				
			}
		}
		if($this->input->post('operation')=='sta'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['event_id_'.$i],'10','cma_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('cma_sts' =>10,'holm_checker_id' => $this->input->post('holm'),'sth_by'=> $this->session->userdata['ast_user']['user_id'], 'sth_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('cma', $data);
						$data2 = $this->user_model->user_activities(10,'cma',$_POST['event_id_'.$i],'cma','Send to HO Checker('.$_POST['event_id_'.$i].')');
					}
			 	}
				
			}
		}
		if($this->input->post('operation')=='sta_return'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['event_id_'.$i],'9,10','cma_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('cma_sts' => 9,'life_cycle'=>1,'ho_return_reason'=>trim($_POST['hidden_return_reason']),'ho_r_by'=> $this->session->userdata['ast_user']['user_id'], 'ho_r_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('cma', $data);
						$data2 = $this->user_model->user_activities(9,'cma',$_POST['event_id_'.$i],'cma','Return CMA('.$_POST['event_id_'.$i].')',$_POST['hidden_return_reason']);
					}
			 	}
				
			}
		}
		if($this->input->post('operation')=='apv'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['event_id_'.$i],'13','cma_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('cma_sts' => 13,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('cma', $data);
						$data2 = $this->user_model->user_activities(13,'cma',$_POST['event_id_'.$i],'cma','Verify CMA('.$_POST['event_id_'.$i].')');
					}
			 	}
				
			}
		}
		if($this->input->post('operation')=='holm_return'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		$pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['event_id_'.$i],'11,12,13','cma_sts');
					if (count($pre_action_result)>0) 
					{
						return 'taken';
					}
					else
					{
						$data = array('cma_sts' => 11,'holm_r_reason'=>trim($_POST['hidden_return_reason']),'holm_r_by'=> $this->session->userdata['ast_user']['user_id'], 'holm_r_dt'=>date('Y-m-d H:i:s'));
						$this->db->where('id', $_POST['event_id_'.$i]);
						$this->db->update('cma', $data);
						$data2 = $this->user_model->user_activities(11,'cma',$_POST['event_id_'.$i],'cma','HOLM Return CMA('.$_POST['event_id_'.$i].')',$_POST['hidden_return_reason']);
					}
			 	}
				
			}
		}
		if($this->input->post('operation')=='sthoops'){
			for ($i=1;$i<= $_POST['event_counter'];$i++) 
			{ 
				if($_POST['event_delete_'.$i]!=1)
			 	{
			 		// $pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['event_id_'.$i],'59','cma_sts');
					// if (count($pre_action_result)>0) 
					// {
					// 	return 'taken';
					// }
					// else
					// {
					// 	$data = array('hoops_user'=>$this->input->post('hoops'),'cma_sts' => 59,'life_cycle'=>3,'sthoops_by'=> $this->session->userdata['ast_user']['user_id'], 'sthoops_dt'=>date('Y-m-d H:i:s'));
					// 	$this->db->where('id', $_POST['event_id_'.$i]);
					// 	$this->db->update('cma', $data);
					// 	$data2 = $this->user_model->user_activities(59,'cma',$_POST['event_id_'.$i],'cma','Send To HOOPS CMA('.$_POST['event_id_'.$i].')');
					// }
					$data = array('hoops_user'=>$this->input->post('hoops'),'cma_sts' => 59,'life_cycle'=>3,'sthoops_by'=> $this->session->userdata['ast_user']['user_id'], 'sthoops_dt'=>date('Y-m-d H:i:s'));
					$this->db->where('id', $_POST['event_id_'.$i]);
					$this->db->update('cma', $data);
					$data2 = $this->user_model->user_activities(59,'cma',$_POST['event_id_'.$i],'cma','Send To HOOPS CMA('.$_POST['event_id_'.$i].')');
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
}
?>
