<?php
class Warrant_arrest_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
	}



	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
		$where2 = "s.sts=1 AND ((s.case_sts_prev_dt=15 AND s.req_type=1) OR (s.case_name =4 AND s.req_type =2 AND s.case_sts_prev_dt=29))";

		if($this->input->get('serial_no')!='') 
		{$where2.=" AND c.sl_no = '".trim($this->input->get('serial_no'))."'";}
		if($this->input->get('case_number')!='') 
		{
			//$casenum= str_replace('_','/',trim($this->input->get('case_number')));
			$where2.=" AND s.case_number = '".trim($this->input->get('case_number'))."'";
		}
		
		if($this->input->get('proposed_type')!='') 
		{$where2.=" AND s.proposed_type = '".trim($this->input->get('proposed_type'))."'";}
		if($this->input->get('account')!='') 
		{
			if($this->input->get('proposed_type')=='Card'){
				$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->get('hidden_loan_ac')));
				$where2.=" AND s.org_loan_ac = '".$card."'";
			}else{
				if($this->input->get('account')!='' && $this->input->get('account')!=0) 
				{$where2.=" AND s.loan_ac = '".trim($this->input->get('account'))."'";}
			}
		}
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

        		if($filterdatafield=='a_dt')
				{
					$filterdatafield = "DATE_FORMAT(e.activities_date,'%d-%m-%Y')";
				}				
				else if($filterdatafield=='arrested_by')
				{
					$filterdatafield='a.name';
				}
				else if($filterdatafield=='sl_no')
				{
					$filterdatafield='c.sl_no';
				}
				else if($filterdatafield=='proposed_type')
				{
					$filterdatafield='s.proposed_type';
				}
				else if($filterdatafield=='loan_ac')
				{
					$filterdatafield='s.loan_ac';
				}
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='s.ac_name';
				}
				else if($filterdatafield=='case_n')
				{
					$filterdatafield='n.name';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='s.case_number';
				}
				else if($filterdatafield=='case_claim_amount')
				{
					$filterdatafield='s.case_claim_amount';
				}
				else if($filterdatafield=='owner_name')
				{
					$filterdatafield='o.guarantor_name';
				}
				else if($filterdatafield=='na_wa')
				{
					$filterdatafield='w.name';
				}
				else if($filterdatafield=='disposal_sts')
				{
					$filterdatafield='d.name';
				}
				else
				{
					$filterdatafield='e.'.$filterdatafield;
				}

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
		$where_initi=''; 
		/*if($where=='' || count($where)<=0){			
			//$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		}*/
		
		if ($sortorder == '')
		{
			$sortdatafield="s.id";
			$sortorder = "DESC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS s.*, s.id as suit_id,s.cma_id,s.case_name, s.case_number,s.case_claim_amount,c.sl_no,s.proposed_type,s.loan_ac,s.ac_name,s.legal_region,
    	n.name as case_n, o.guarantor_name as owner_name,o.guarantor_type as owner_type,cs.name as case_sts,f.id as wa_id,f.v_sts as wa_v_sts,f.status as setteled_sts,cr.name as executed_criterea_name
    	', FALSE)
			->from("suit_filling_info s")
			->join('cma c', 'c.id=s.cma_id', 'left')
			->join('file_executed_data f', 'f.file_id=s.id AND f.sts<>0', 'left')
			->join("ref_execution_criteria cr",'cr.id=f.executed_criterea', 'left')
			->join('ref_case_name n', 'n.id=s.case_name', 'left')
			->join('ref_case_sts cs', 'cs.id=s.case_sts_prev_dt', 'left')
			->join('cma_guarantor o', 'o.cma_id=s.cma_id AND o.guarantor_type="M"', 'left')
			->where($where2)
			->where($where)
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
	function get_wa_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
		$where2 = "e.sts=1 AND e.v_sts in (35,39,37)";
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

        		if($filterdatafield=='a_dt')
				{
					$filterdatafield = "DATE_FORMAT(e.activities_date,'%d-%m-%Y')";
				}				
				else if($filterdatafield=='arrested_by')
				{
					$filterdatafield='a.name';
				}else if($filterdatafield=='fsts')
				{
					$filterdatafield='e.status';
					if(strtolower($filtervalue)=='setteled'){
						$filtervalue=2;
					}else{
						$filtervalue=1;
					}
					
				}
				else if($filterdatafield=='sl_no')
				{
					$filterdatafield='c.sl_no';
				}
				else if($filterdatafield=='proposed_type')
				{
					$filterdatafield='s.proposed_type';
				}
				else if($filterdatafield=='loan_ac')
				{
					$filterdatafield='s.loan_ac';
				}
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='s.ac_name';
				}
				else if($filterdatafield=='case_n')
				{
					$filterdatafield='n.name';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='s.case_number';
				}
				else if($filterdatafield=='case_claim_amount')
				{
					$filterdatafield='s.case_claim_amount';
				}
				else if($filterdatafield=='owner_name')
				{
					$filterdatafield='o.guarantor_name';
				}
				else if($filterdatafield=='na_wa')
				{
					$filterdatafield='w.name';
				}
				else if($filterdatafield=='disposal_sts')
				{
					$filterdatafield='d.name';
				}
				else
				{
					$filterdatafield='e.'.$filterdatafield;
				}

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
		$where_initi=''; 
		/*if($where=='' || count($where)<=0){			
			//$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		}*/
		
		if ($sortorder == '')
		{
			$sortdatafield="e.id";
			$sortorder = "DESC";				
		}
		
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS e.*,if(e.status=1,"Pending","Setteled") as fsts, s.id as suit_id,s.cma_id,s.case_name, s.case_number,s.case_claim_amount,c.sl_no,s.proposed_type,s.loan_ac,s.ac_name,s.legal_region,
    	n.name as case_n, o.guarantor_name as owner_name,o.guarantor_type as owner_type,a.name as arrested_by,w.name as na_wa,d.name as disposal_sts,cr.name as executed_criterea_name
    	', FALSE)
			->from("file_executed_data e")
			->join("suit_filling_info s",'s.id=e.file_id', 'left')
			->join("ref_execution_criteria cr",'cr.id=e.executed_criterea', 'left')
			->join('cma c', 'c.id=s.cma_id', 'left')
			->join('ref_case_name n', 'n.id=s.case_name', 'left')
			->join('cma_guarantor o', 'o.cma_id=s.cma_id AND o.guarantor_type="M"', 'left')
			->join('ref_arrested_by a', 'a.id=e.arrested_by', 'left')
			->join('ref_nature_warrent_arrest w', 'w.id=e.nature_wa', 'left')
			->join('ref_disposal_sts d', 'd.id=e.wa_status', 'left')
			//->join('cma_guarantor g', 'g.cma_id=s.cma_id AND g.guarantor_type="G"', 'left')
			->where($where2)
			->where($where)
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
	function get_executed_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
		$where2 = "e.sts=1 AND e.v_sts=38 AND e.status=1";
	   	if($this->input->get('serial_no')!='') 
		{$where2.=" AND c.sl_no = '".trim($this->input->get('serial_no'))."'";}
		if($this->input->get('case_number')!='') 
		{
			//$casenum= str_replace('_','/',trim($this->input->get('case_number')));
			$where2.=" AND s.case_number = '".trim($this->input->get('case_number'))."'";
		}
		if($this->input->get('s_arrested_by')!='' && $this->input->get('s_arrested_by')!=0) 
		{$where2.=" AND e.arrested_by = '".trim($this->input->get('s_arrested_by'))."'";}
		
		if($this->input->get('proposed_type')!='') 
		{$where2.=" AND s.proposed_type = '".trim($this->input->get('proposed_type'))."'";}
		if($this->input->get('account')!='') 
		{
			if($this->input->get('proposed_type')=='Card'){
				$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->get('hidden_loan_ac')));
				$where2.=" AND s.org_loan_ac = '".$card."'";
			}else{
				if($this->input->get('account')!='' && $this->input->get('account')!=0) 
				{$where2.=" AND s.loan_ac = '".trim($this->input->get('account'))."'";}
			}
		}
		//echo $where2;
	   
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

        		if($filterdatafield=='a_dt')
				{
					$filterdatafield = "DATE_FORMAT(e.activities_date,'%d-%m-%Y')";
				}				
				else if($filterdatafield=='arrested_by')
				{
					$filterdatafield='a.name';
				}else if($filterdatafield=='fsts')
				{
					$filterdatafield='e.status';
					if(strtolower($filtervalue)=='setteled'){
						$filtervalue=2;
					}else{
						$filtervalue=1;
					}
					
				}
				else if($filterdatafield=='sl_no')
				{
					$filterdatafield='c.sl_no';
				}
				else if($filterdatafield=='proposed_type')
				{
					$filterdatafield='s.proposed_type';
				}
				else if($filterdatafield=='loan_ac')
				{
					$filterdatafield='s.loan_ac';
				}
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='s.ac_name';
				}
				else if($filterdatafield=='case_n')
				{
					$filterdatafield='n.name';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='s.case_number';
				}
				else if($filterdatafield=='case_claim_amount')
				{
					$filterdatafield='s.case_claim_amount';
				}
				else if($filterdatafield=='owner_name')
				{
					$filterdatafield='o.guarantor_name';
				}
				else if($filterdatafield=='na_wa')
				{
					$filterdatafield='w.name';
				}
				else if($filterdatafield=='disposal_sts')
				{
					$filterdatafield='d.name';
				}
				else
				{
					$filterdatafield='e.'.$filterdatafield;
				}

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
		$where_initi=''; 
		/*if($where=='' || count($where)<=0){			
			//$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		}*/
		
		if ($sortorder == '')
		{
			$sortdatafield="e.id";
			$sortorder = "DESC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS e.*,if(e.status=1,"Pending","Setteled") as fsts, s.id as suit_id,s.cma_id,s.case_name, s.case_number,s.case_claim_amount,c.sl_no,s.proposed_type,s.loan_ac,s.ac_name,s.legal_region,
    	n.name as case_n, o.guarantor_name as owner_name,o.guarantor_type as owner_type,a.name as arrested_by,w.name as na_wa,d.name as disposal_sts,cr.name as executed_criterea_name
    	', FALSE)
			->from("file_executed_data e")
			->join("suit_filling_info s",'s.id=e.file_id', 'left')
			->join("ref_execution_criteria cr",'cr.id=e.executed_criterea', 'left')
			->join('cma c', 'c.id=s.cma_id', 'left')
			->join('ref_case_name n', 'n.id=s.case_name', 'left')
			->join('cma_guarantor o', 'o.cma_id=s.cma_id AND o.guarantor_type="M"', 'left')
			->join('ref_arrested_by a', 'a.id=e.arrested_by', 'left')
			->join('ref_nature_warrent_arrest w', 'w.id=e.nature_wa', 'left')
			->join('ref_disposal_sts d', 'd.id=e.wa_status', 'left')
			//->join('cma_guarantor g', 'g.cma_id=s.cma_id AND g.guarantor_type="G"', 'left')
			->where($where2)
			->where($where)
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
	function get_setteled_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "e.sts=1 AND e.v_sts=38 AND e.status=2";
	   	if($this->input->get('serial_no')!='') 
		{$where2.=" AND c.sl_no = '".trim($this->input->get('serial_no'))."'";}
		if($this->input->get('case_number')!='') 
		{$where2.=" AND s.case_number = '".trim($this->input->get('case_number'))."'";}
		if($this->input->get('ac_name')!='' && !ctype_space($this->input->get('ac_name'))) 
		{$where2.=" AND c.ac_name = '".trim($this->input->get('ac_name'))."'";}

		if($this->input->get('proposed_type')!='') 
		{$where2.=" AND s.proposed_type = '".trim($this->input->get('proposed_type'))."'";}
		if($this->input->get('account')!='') 
		{
			if($this->input->get('proposed_type')=='Card'){
				$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->get('hidden_loan_ac')));
				$where2.=" AND s.org_loan_ac = '".$card."'";
			}else{
				if($this->input->get('account')!='' && $this->input->get('account')!=0) 
				{$where2.=" AND s.loan_ac = '".trim($this->input->get('account'))."'";}
			}
		}
		//echo $where2;
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

        		if($filterdatafield=='a_dt')
				{
					$filterdatafield = "DATE_FORMAT(e.activities_date,'%d-%m-%Y')";
				}				
				else if($filterdatafield=='arrested_by')
				{
					$filterdatafield='a.name';
				}else if($filterdatafield=='fsts')
				{
					$filterdatafield='e.status';
					if(strtolower($filtervalue)=='setteled'){
						$filtervalue=2;
					}else{
						$filtervalue=1;
					}
					
				}
				else if($filterdatafield=='sl_no')
				{
					$filterdatafield='c.sl_no';
				}
				else if($filterdatafield=='proposed_type')
				{
					$filterdatafield='s.proposed_type';
				}
				else if($filterdatafield=='loan_ac')
				{
					$filterdatafield='s.loan_ac';
				}
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='s.ac_name';
				}
				else if($filterdatafield=='case_n')
				{
					$filterdatafield='n.name';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='s.case_number';
				}
				else if($filterdatafield=='case_claim_amount')
				{
					$filterdatafield='s.case_claim_amount';
				}
				else if($filterdatafield=='owner_name')
				{
					$filterdatafield='o.guarantor_name';
				}
				else if($filterdatafield=='na_wa')
				{
					$filterdatafield='w.name';
				}
				else if($filterdatafield=='disposal_sts')
				{
					$filterdatafield='d.name';
				}
				else
				{
					$filterdatafield='e.'.$filterdatafield;
				}

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
		$where_initi=''; 
		/*if($where=='' || count($where)<=0){			
			//$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		}*/
		
		if ($sortorder == '')
		{
			$sortdatafield="e.id";
			$sortorder = "DESC";				
		}
		
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS e.*,if(e.status=1,"Pending","Setteled") as fsts, s.id as suit_id,s.cma_id,s.case_name, s.case_number,s.case_claim_amount,c.sl_no,s.proposed_type,s.loan_ac,s.ac_name,s.legal_region,
    	n.name as case_n, o.guarantor_name as owner_name,o.guarantor_type as owner_type,a.name as arrested_by,w.name as na_wa,d.name as disposal_sts,cr.name as executed_criterea_name
    	', FALSE)
			->from("file_executed_data e")
			->join("suit_filling_info s",'s.id=e.file_id', 'left')
			->join("ref_execution_criteria cr",'cr.id=e.executed_criterea', 'left')
			->join('cma c', 'c.id=s.cma_id', 'left')
			->join('ref_case_name n', 'n.id=s.case_name', 'left')
			->join('cma_guarantor o', 'o.cma_id=s.cma_id AND o.guarantor_type="M"', 'left')
			->join('ref_arrested_by a', 'a.id=e.arrested_by', 'left')
			->join('ref_nature_warrent_arrest w', 'w.id=e.nature_wa', 'left')
			->join('ref_disposal_sts d', 'd.id=e.wa_status', 'left')
			//->join('cma_guarantor g', 'g.cma_id=s.cma_id AND g.guarantor_type="G"', 'left')
			->where($where2)
			->where($where)
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
	function get_pending_incentive_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "s.sts=1 AND s.paid_sts IS NULL ";
		if($this->input->get('case_number')!='') 
		{$where2.=" AND o.case_number = '".trim($this->input->get('case_number'))."'";}
		if($this->input->get('u_name')!='' && !ctype_space($this->input->get('u_name'))) 
		{$where2.=" AND s.executor_name = '".trim($this->input->get('u_name'))."'";
		$where2.=" OR u.name = '".trim($this->input->get('u_name'))."'";}

		if($this->input->get('proposed_type')!='') 
		{$where2.=" AND o.proposed_type = '".trim($this->input->get('proposed_type'))."'";}
		if($this->input->get('account')!='') 
		{
			if($this->input->get('proposed_type')=='Card'){
				$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->get('hidden_loan_ac')));
				$where2.=" AND o.org_loan_ac = '".$card."'";
			}else{
				if($this->input->get('account')!='' && $this->input->get('account')!=0) 
				{$where2.=" AND o.loan_ac = '".trim($this->input->get('account'))."'";}
			}
		}

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

        		if($filterdatafield=='a_dt')
				{
					$filterdatafield = "DATE_FORMAT(e.activities_date,'%d-%m-%Y')";
				}
				else if($filterdatafield=='group_name')
				{
					$filterdatafield='g.group_name';
				}
				else if($filterdatafield=='loan_ac')
				{
					$filterdatafield='m.loan_ac';
				}
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='m.ac_name';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='o.case_number';
				}
				else if($filterdatafield =='user_name'){

				}else if($filterdatafield =='pin'){

				}
				else
				{
					$filterdatafield='s.'.$filterdatafield;
				}

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

				if($filterdatafield =='user_name')
				{
					$where .= " (u.name LIKE '%".$filtervalue."%' OR s.executor_name LIKE '%".$filtervalue."%') ";
				}else if($filterdatafield =='pin'){
					$where .= " (u.pin LIKE '%".$filtervalue."%' OR s.executor_pin LIKE '%".$filtervalue."%') ";
				}
				else
				{
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
		$where_initi=''; 
		/*if($where=='' || count($where)<=0){			
			//$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		}*/
		
		if ($sortorder == '')
		{
			$sortdatafield="s.id";
			$sortorder = "ASC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS s.*,c.executed_criterea, m.loan_ac, m.ac_name,o.case_number,
    		if(s.executor_type=0,"Others",g.group_name) as group_name,
    		if(s.executor IS NULL,s.executor_pin,u.pin) as pin, 
    		if(s.executor IS NULL,s.executor_name,u.name) as user_name,cr.name as executed_criterea_name
    	', FALSE)
			->from("file_executor s")
			->join('file_executed_data c', 'c.id=s.executed_id', 'left')
			->join("ref_execution_criteria cr",'cr.id=c.executed_criterea', 'left')
			->join('user_group g', 'g.id=s.executor_type', 'left')
			->join('suit_filling_info o', 'o.id=c.file_id', 'left')
			->join('cma m', 'm.id=o.cma_id', 'left')
			->join('users_info u', 'u.id=s.executor', 'left')
			//->join('cma_guarantor g', 'g.cma_id=s.cma_id AND g.guarantor_type="G"', 'left')
			->where($where2)
			->where($where)
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
	function get_executed_incentive_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "s.sts=1 AND s.paid_sts ='paid' ";
		if($this->input->get('case_number')!='' ) 
		{$where2.=" AND o.case_number = '".trim($this->input->get('case_number'))."'";}
		if($this->input->get('u_name')!='' && !ctype_space($this->input->get('u_name'))) 
		{$where2.=" AND s.executor_name = '".trim($this->input->get('u_name'))."'";
		$where2.=" OR u.name = '".trim($this->input->get('u_name'))."'";}

		if($this->input->get('proposed_type')!='') 
		{$where2.=" AND o.proposed_type = '".trim($this->input->get('proposed_type'))."'";}
		if($this->input->get('account')!='') 
		{
			if($this->input->get('proposed_type')=='Card'){
				$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->get('hidden_loan_ac')));
				$where2.=" AND o.org_loan_ac = '".$card."'";
			}else{
				if($this->input->get('account')!='' && $this->input->get('account')!=0) 
				{$where2.=" AND o.loan_ac = '".trim($this->input->get('account'))."'";}
			}
		}

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

        		if($filterdatafield=='a_dt')
				{
					$filterdatafield = "DATE_FORMAT(e.activities_date,'%d-%m-%Y')";
				}
				else if($filterdatafield=='group_name')
				{
					$filterdatafield='g.group_name';
				}
				else if($filterdatafield=='loan_ac')
				{
					$filterdatafield='m.loan_ac';
				}
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='m.ac_name';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='o.case_number';
				}
				else if($filterdatafield =='user_name'){

				}else if($filterdatafield =='pin'){
					
				}
				else
				{
					$filterdatafield='s.'.$filterdatafield;
				}

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

				if($filterdatafield =='user_name')
				{
					$where .= " (u.name LIKE '%".$filtervalue."%' OR s.executor_name LIKE '%".$filtervalue."%') ";
				}else if($filterdatafield =='pin'){
					$where .= " (u.pin LIKE '%".$filtervalue."%' OR s.executor_pin LIKE '%".$filtervalue."%') ";
				}
				else
				{
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
		$where_initi=''; 
		/*if($where=='' || count($where)<=0){			
			//$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		}*/
		
		if ($sortorder == '')
		{
			$sortdatafield="s.id";
			$sortorder = "ASC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS s.*,c.executed_criterea, m.loan_ac, m.ac_name,o.case_number,if(s.executor_type=0,"Others",g.group_name) as group_name,
    		if(s.executor IS NULL,s.executor_pin,u.pin) as pin, 
    		if(s.executor IS NULL,s.executor_name,u.name) as user_name,cr.name as executed_criterea_name
    	', FALSE)
			->from("file_executor s")
			->join('file_executed_data c', 'c.id=s.executed_id', 'left')
			->join("ref_execution_criteria cr",'cr.id=c.executed_criterea', 'left')
			->join('user_group g', 'g.id=s.executor_type', 'left')
			->join('suit_filling_info o', 'o.id=c.file_id', 'left')
			->join('cma m', 'm.id=o.cma_id', 'left')
			->join('users_info u', 'u.id=s.executor', 'left')
			//->join('cma_guarantor g', 'g.cma_id=s.cma_id AND g.guarantor_type="G"', 'left')
			->where($where2)
			->where($where)
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
	function activities_id($activity=NULL)
    {
	    $str = "SELECT a.id FROM user_activities_list a WHERE a.activities_name = '$activity'";
			$query=$this->db->query($str);
			return $query->result();

    }
    function add_edit_action($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
	{
		$this->db->trans_begin();
        if($editrow==""){$editrow=0;}
	    $table_name = "file_executed_data";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";
	    $change_date_format = str_replace('/', '-', (string) $this->input->post('activities_date'));
	    $act_date = date('Y-m-d',strtotime($change_date_format));
	    
	    //AIT & VAT Data
	    $expenses = array(
			'file_id' =>$this->security->xss_clean( $this->input->post('suit_id')),
			'nature_wa' =>$this->security->xss_clean( $this->input->post('nature_wa')),
		);
		$settele= array();
		if(isset($_POST['setteled'])){
			$expenses['status']=2;
			$settele['life_cycle']=2;
			$settele['suit_sts']=76;
			$settele['final_remarks']=2;
			$settele['ac_close_by']=$this->session->userdata['ast_user']['user_id'];
			$settele['ac_close_dt']=date('Y-m-d H:i:s');
		}else{
			$expenses['status']=1;
			$settele['life_cycle']=1;
			$settele['arrested_sts']=1;
			$issue_date=implode('-',array_reverse(explode('/',$this->input->post('issue_date'))));
			$expenses['arrested_by']=$this->security->xss_clean( $this->input->post('arrested_by'));
			$expenses['wa_status']=$this->security->xss_clean( $this->input->post('wa_status'));
			$expenses['executed_criterea']=$this->security->xss_clean( $this->input->post('criteria'));
			$expenses['sharok_no']=$this->security->xss_clean( $this->input->post('sharok_no'));
			if($issue_date!=''){
				$expenses['issue_date']=$issue_date;
			}
			$expenses['ps_name']=$this->security->xss_clean( $this->input->post('ps_name'));
			//$expenses['wa_scan_copy']=$wa_scan_copy;
		}


		if($add_edit=="add")
		{
			$expenses['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['e_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 39;
			$this->db->insert('file_executed_data', $expenses);
			$insert_idss = $this->db->insert_id();

			$counter = $this->input->post('file_counter');
			for($i=1; $i<=$counter; $i++){
				if($this->input->post('del_row_'.$i)==0){
					$wa_scan_copy = $this->get_file_name('wa_scan_copy_'.$i,'cma_file/wa_scan_copy/');
					$data['e_by'] = $this->session->userdata['ast_user']['user_id'];
					$data['e_dt'] = date('Y-m-d H:i:s');
					$data['executed_id'] = $insert_idss;
					$data['wa_scan_copy'] = $wa_scan_copy;
					$this->db->insert('file_executed_files', $data);
				}
			}
			$this->db->where('id', $this->input->post('suit_id'));
			$this->db->update('suit_filling_info', $settele);
			
			//file_executed_files
			//$this->db->where('id', $this->input->post('suit_id'));
			//$this->db->update('suit_filling_info', array('life_cycle'=>1));
		    $activities_id = 39;
		    $description_activities = 'Add Executed WA - ';
		}
		else
		{
			$pre_action_result=$this->Common_model->get_where_data('file_executed_data',array('sts'=>1,'id'=>$edit_id));
			if($pre_action_result[0]->v_sts ==35 || $pre_action_result[0]->v_sts ==39){
				$expenses['u_by'] = $this->session->userdata['ast_user']['user_id'];
				$expenses['u_dt'] = date('Y-m-d H:i:s');
				$expenses['v_sts'] = 35;
			}
	  		
			$this->db->where('id', $edit_id);
			$this->db->update('file_executed_data', $expenses);
	  		$insert_idss = $edit_id;

	  		$counter = $this->input->post('file_counter');
			for($i=1; $i<=$counter; $i++){
				if($this->input->post('del_row_'.$i)==0 && $this->input->post('edit_file_row_'.$i)==0 ){
					$wa_scan_copy = $this->get_file_name('wa_scan_copy_'.$i,'cma_file/wa_scan_copy/');
					$data['e_by'] = $this->session->userdata['ast_user']['user_id'];
					$data['e_dt'] = date('Y-m-d H:i:s');
					$data['executed_id'] = $insert_idss;
					$data['wa_scan_copy'] = $wa_scan_copy;
					if($wa_scan_copy!=''){
						$this->db->insert('file_executed_files', $data);
					}					
				}
				if($this->input->post('del_row_'.$i)==0 && $this->input->post('edit_file_row_'.$i)!=0 ){
					$wa_scan_copy = $this->get_file_name('wa_scan_copy_'.$i,'cma_file/wa_scan_copy/');
					$data['u_by'] = $this->session->userdata['ast_user']['user_id'];
					$data['u_dt'] = date('Y-m-d H:i:s');
					$data['wa_scan_copy'] = $wa_scan_copy;
					$this->db->where('id', $this->input->post('edit_file_row_'.$i));
					$this->db->update('file_executed_files', $data);
				}
				if($this->input->post('del_row_'.$i)==1 && $this->input->post('edit_file_row_'.$i)!=0 ){
					$wa_scan_copy = $this->get_file_name('wa_scan_copy_'.$i,'cma_file/wa_scan_copy/');
					$row = $this->db->query('select * from file_executed_files where id='.$this->input->post('edit_file_row_'.$i))->row();
					if(file_exists('cma_file/wa_scan_copy/'.$row->wa_scan_copy)){
		            	unlink('cma_file/wa_scan_copy/'.$row->wa_scan_copy); 
		            }  
					$this->db->where('id', $this->input->post('edit_file_row_'.$i));
					$this->db->delete('file_executed_files');
				}
			}
			$this->db->where('id', $this->input->post('suit_id'));
			$this->db->update('suit_filling_info', $settele);
	        $activities_id = 35;
	        $description_activities = 'Edit Executed WA - ';

		}
		$whoexe =$exetor = '';
		if(!isset($_POST['setteled'])){
		for($i=0;$i<$this->input->post('executed_counter');$i++){

			if(isset($_POST['check_'.$i])){
				$chang_date_format = date('Y-m-d',strtotime(str_replace('/','-',(string) $this->input->post('executed_date_'.$i))));
				$exedata = array(
					'executed_id'=>$insert_idss,
					'who_executed'=>$this->security->xss_clean($this->input->post('gid_'.$i)),
					'executed_dt'=>$this->security->xss_clean($chang_date_format),
					'remarks'=>$this->security->xss_clean( $this->input->post('remarks_'.$i)),
				);
				if($this->input->post('tedid_'.$i)>0){
					$exedata['u_by']=$this->session->userdata['ast_user']['user_id'];
					$exedata['u_dt']=date('Y-m-d H:i:s');
					$this->db->where('id', $this->input->post('tedid_'.$i));
					$this->db->update('file_executed_by', $exedata);
					$who_idss =$this->input->post('tedid_'.$i);
				}else{
					$exedata['e_by']=$this->session->userdata['ast_user']['user_id'];
					$exedata['e_dt']=date('Y-m-d H:i:s');
					$this->db->insert('file_executed_by', $exedata);
					$who_idss = $this->db->insert_id();
				}
				if($whoexe!=''){$comma=',';}else{$comma='';}
				$whoexe.=$comma.$who_idss;
			}else{
				if($this->input->post('tedid_'.$i)>0){
					$this->db->where('id', $this->input->post('tedid_'.$i));
					$this->db->update('file_executed_by', array('sts'=>0,'d_by'=>$this->session->userdata['ast_user']['user_id'],'d_dt'=>date('Y-m-d H:i:s')));
				}
			}
		}

		for($i=1;$i<=$this->input->post('executor_counter');$i++){

			if($this->input->post('executor_info_delete_'.$i)==0){
				$exedata = array(
					'executed_id'=>$insert_idss,
					'executor_type'=>$this->security->xss_clean($this->input->post('executor_type_'.$i)),
					'amount'=>$this->security->xss_clean( $this->input->post('amount_'.$i)),
					'pariculars'=>$this->security->xss_clean( $this->input->post('pariculars_'.$i)),
				);
				if($this->input->post('user_id_'.$i)>0){
					$exedata['executor']=$this->security->xss_clean($this->input->post('user_id_'.$i));
					$exedata['executor_pin']='';
					$exedata['executor_name']='';
				}else{
					//$exedata['executor']=''
					$exedata['executor']=NULL;
					$exedata['executor_pin']=$this->security->xss_clean($this->input->post('pin_'.$i));
					$exedata['executor_name']=$this->security->xss_clean($this->input->post('name_'.$i));
				}
				
				if($this->input->post('executor_info_edit_'.$i)>0){
					$exedata['u_by']=$this->session->userdata['ast_user']['user_id'];
					$exedata['u_dt']=date('Y-m-d H:i:s');
					$this->db->where('id', $this->input->post('executor_info_edit_'.$i));
					$this->db->update('file_executor', $exedata);
					$tor_idss=$this->input->post('executor_info_edit_'.$i);
				}else{
					$exedata['e_by']=$this->session->userdata['ast_user']['user_id'];
					$exedata['e_dt']=date('Y-m-d H:i:s');
					$this->db->insert('file_executor', $exedata);
					$tor_idss = $this->db->insert_id();
				}
				if($exetor!=''){$comma=',';}else{$comma='';}
				$exetor.=$comma.$tor_idss;
			}else{
				if($this->input->post('executor_info_edit_'.$i)>0 && $this->input->post('executor_info_delete_'.$i)>0){
					$exedata['d_by']=$this->session->userdata['ast_user']['user_id'];
					$exedata['d_dt']=date('Y-m-d H:i:s');
					$exedata['sts']=0;
					$this->db->where('id', $this->input->post('executor_info_edit_'.$i));
					$this->db->update('file_executor', $exedata);
				}
				
			}
		}
		
		}
		$history = array(
			'file_id' =>$insert_idss,
			'nature_wa' =>$this->security->xss_clean( $this->input->post('nature_wa')),
		);
		$history['arrested_by']=$this->security->xss_clean( $this->input->post('arrested_by'));
		$history['wa_status']=$this->security->xss_clean( $this->input->post('wa_status'));
		$history['executed_criterea']=$this->security->xss_clean( $this->input->post('criteria'));
		$history['sharok_no']=$this->security->xss_clean( $this->input->post('sharok_no'));
		if($issue_date!=''){
			$history['issue_date']=$issue_date;
		}
		$history['ps_name']=$this->security->xss_clean( $this->input->post('ps_name'));
		$history['who_executed']=$whoexe;
		$history['executor']=$exetor;
		$history['e_by']=$this->session->userdata['ast_user']['user_id'];
		$history['e_dt']=date('Y-m-d H:i:s');
		$this->db->insert('file_executed_history', $history);

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities($activities_id,'wa',$insert_idss,$table_name,$description_activities);
			// echo $insert_idss;
			// exit;
			return $insert_idss;
		}


	}
	function get_add_action_data($id)
	{
		$this->db
			->select("b.*", FALSE)
			->from("expenses b")
			->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function delete_action(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "suit_filling_info";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';
		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('expenses',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('d_reason'=>trim($_POST['comments']),	'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('expenses', $data);
				$activities_id = 15;
				$description_activities = 'Delete Staff Conveyance - ';
				$row_id=$_POST['deleteEventId'];
				$reason =trim($_POST['comments']);
			}
			
		}
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('file_executed_data',$_POST['deleteEventId'],37,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts' => 37, 's_by'=> $this->session->userdata['ast_user']['user_id'], 's_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('file_executed_data', $data);
				$activities_id = 38;
				$description_activities = 'File Sendtochecker - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason ='';
			}
			
		}

		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('file_executed_data',$_POST['deleteEventId'],38,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts' => 38, 'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('file_executed_data', $data);
				$activities_id = 38;
				$description_activities = 'File Verify - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason ='';
			}
			
		}
		if($this->input->post('type')=='paid'){
			$pre_action_result=$this->Common_model->get_where_data('file_executor',array('paid_sts'=>'paid','sts'=>1,'id'=>$_POST['deleteEventId']));
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('paid_sts'=>'paid','p_by'=> $this->session->userdata['ast_user']['user_id'], 'p_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('file_executor', $data);
				$activities_id = 31;
				$description_activities = 'Payment Completed - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason ='';
				$table_name='file_executor';
			}
			
		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		}
		else {
			$this->User_model->user_activities($activities_id,'suit_file',$row_id,$table_name,$description_activities,$reason);
			$this->db->trans_commit();

			$this->db->db_debug = $db_debug;
			return $row_id;
		}
	}
	function incentive_delete_action(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "suit_filling_info";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';
		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('expenses',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('d_reason'=>trim($_POST['comments']),	'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('expenses', $data);
				$activities_id = 15;
				$description_activities = 'Delete Staff Conveyance - ';
				$row_id=$_POST['deleteEventId'];
				$reason =trim($_POST['comments']);
			}
			
		}
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('file_executor',$_POST['deleteEventId'],37,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts' => 37, 's_by'=> $this->session->userdata['ast_user']['user_id'], 's_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('file_executor', $data);
				$activities_id = 38;
				$description_activities = 'File Executor Sendtochecker - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason ='';
			}
			
		}

		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('file_executor',$_POST['deleteEventId'],38,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts' => 38,'paid_sts'=>'paid', 'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'p_by'=> $this->session->userdata['ast_user']['user_id'], 'p_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('file_executor', $data);
				$activities_id = 38;
				$description_activities = 'File Executor Verify - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason ='';
			}
			
		}
		if($this->input->post('type')=='paid'){
			$pre_action_result=$this->Common_model->get_where_data('file_executor',array('paid_sts'=>'paid','sts'=>1,'id'=>$_POST['deleteEventId']));
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('paid_sts'=>'paid','p_by'=> $this->session->userdata['ast_user']['user_id'], 'p_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('file_executor', $data);
				$activities_id = 31;
				$description_activities = 'Payment Completed - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason ='';
				$table_name='file_executor';
			}
			
		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		}
		else {
			$this->User_model->user_activities($activities_id,'suit_file',$row_id,$table_name,$description_activities,$reason);
			$this->db->trans_commit();

			$this->db->db_debug = $db_debug;
			return $row_id;
		}
	}
	function get_guarrentor_ower_info($table,$where){
		$this->db
			->select('*')
			->from($table)
			->where($where)
			->order_by('id',"DESC");
		$data = $this->db->get()->result();
		return $data;
	}
	function get_executor_type($table,$col,$where,$select=null){
		if(!empty($select)){$this->db->select($select);}
		else{$this->db->select('*');}
		$this->db->from($table);
		$this->db->where_in($col,$where);
		$data = $this->db->get()->result();
		return $data;
	}
	function select_where($table,$where,$select=null){
		if(!empty($select)){$this->db->select($select);}
		else{$this->db->select('*');}
		$this->db->from($table);
		$this->db->where($where);
		$data = $this->db->get()->result();
		return $data;
	}

	function get_executed_row_details($id){
		$this->db->select('e.*, s.id as suit_id,s.cma_id,s.case_name, s.case_number,s.case_claim_amount,c.sl_no,c.proposed_type,c.loan_ac,c.ac_name,c.legal_region,
    	n.name as case_n, o.guarantor_name as owner_name,o.guarantor_type as owner_type,a.name as arrested_by,w.name as na_wa,d.name as disposal_sts
    	', FALSE)
			->from("file_executed_data e")
			->join("suit_filling_info s",'s.id=e.file_id', 'left')
			->join('cma c', 'c.id=s.cma_id', 'left')
			->join('ref_case_name n', 'n.id=s.case_name', 'left')
			->join('cma_guarantor o', 'o.cma_id=s.cma_id AND o.guarantor_type="M"', 'left')
			->join('ref_arrested_by a', 'a.id=e.arrested_by', 'left')
			->join('ref_nature_warrent_arrest w', 'w.id=e.nature_wa', 'left')
			->join('ref_disposal_sts d', 'd.id=e.wa_status', 'left')
			//->join('cma_guarantor g', 'g.cma_id=s.cma_id AND g.guarantor_type="G"', 'left')
			->where("e.id=".$id." AND e.sts=1 AND s.life_cycle=1 ", NULL, FALSE)
			->limit(1);
		$q=$this->db->get();
		$result = $q->result_array();

		// Multiple Executed
		$this->db->select("f.*,g.guarantor_type,g.guarantor_name");
		$this->db->from('file_executed_by as f');
		$this->db->join("cma_guarantor as g", "g.id=f.who_executed", "left");
		$this->db->where('f.executed_id', $result[0]['id']);
		$this->db->where('f.sts', '1');
		
   		$executed = $this->db->get()->result_array();
   		$result[0]['executed'] = $executed;

   		// Multiple Executor
   		$this->db->select("r.*,if(r.executor_type=0,'Others',u.group_name) as group_name,if(r.executor IS NULL,r.executor_pin,t.pin) as pin,if(r.executor IS NULL,r.executor_name,t.name) as u_name");
		$this->db->from('file_executor as r');
		$this->db->join("user_group as u", "u.id=r.executor_type", "left");
		$this->db->join("users_info as t", "t.id=r.executor", "left");
		$this->db->where('r.executed_id', $result[0]['id']);
		$this->db->where('r.sts', '1');
		
   		$executed = $this->db->get()->result_array();
   		$result[0]['executor'] = $executed;

		//$result['']
		return $result;

	}

	function get_executed_row_edit($id){
		$this->db->select('e.*, s.id as suit_id,s.cma_id,s.case_name, s.case_number,s.case_claim_amount,c.sl_no,c.proposed_type,c.loan_ac,c.ac_name,c.legal_region,
    	n.name as case_n, o.guarantor_name as owner_name,o.guarantor_type as owner_type,a.name as arrested_name,w.name as na_wa,d.name as disposal_sts
    	', FALSE)
			->from("file_executed_data e")
			->join("suit_filling_info s",'s.id=e.file_id', 'left')
			->join('cma c', 'c.id=s.cma_id', 'left')
			->join('ref_case_name n', 'n.id=s.case_name', 'left')
			->join('cma_guarantor o', 'o.cma_id=s.cma_id AND o.guarantor_type="M"', 'left')
			->join('ref_arrested_by a', 'a.id=e.arrested_by', 'left')
			->join('ref_nature_warrent_arrest w', 'w.id=e.nature_wa', 'left')
			->join('ref_disposal_sts d', 'd.id=e.wa_status', 'left')
			//->join('cma_guarantor g', 'g.cma_id=s.cma_id AND g.guarantor_type="G"', 'left')
			->where("e.id=".$this->db->escape($id)." AND e.sts=1 ", NULL, FALSE)
			->limit(1);
		$q=$this->db->get();
		$result = $q->result_array();

		// Multiple File
		$this->db->select('*', FALSE)
			->from("file_executed_files")
			->where(array('executed_id'=>$result[0]['id'],'sts'=>1));
		$ext=$this->db->get();
		$result[0]['wa_files'] = $ext->result_array();

		// Multiple Executed
		$this->db->select("f.*,date_format(f.executed_dt,'%d-%m-%Y') as executed_dt,g.guarantor_type,g.guarantor_name");
		$this->db->from('file_executed_by as f');
		$this->db->join("cma_guarantor as g", "g.id=f.who_executed", "left");
		$this->db->where('f.executed_id', $result[0]['id']);
		$this->db->where('f.sts', '1');
		
   		$executed = $this->db->get()->result_array();
   		$result[0]['executed'] = $executed;

   		// Multiple Executor
   		$this->db->select("r.*,if(r.executor_type=0,'Others',u.group_name) as group_name,if(r.executor IS NULL,r.executor_pin,if(r.executor=0,r.executor_pin,t.pin)) as pin,if(r.executor IS NULL,r.executor_name,if(r.executor=0,r.executor_name,t.name)) as u_name,if(r.executor IS NULL,0,r.executor) as executor");
		$this->db->from('file_executor as r');
		$this->db->join("user_group as u", "u.id=r.executor_type", "left");
		$this->db->join("users_info as t", "t.id=r.executor", "left");
		$this->db->where('r.executed_id', $result[0]['id']);
		$this->db->where('r.sts', '1');
		
   		$executed = $this->db->get()->result_array();
   		$result[0]['executor'] = $executed;
   		$arr = array();
   		foreach($result[0]['executed'] as $ddd){
   			array_push($arr,$ddd['who_executed']);
   		}
   		$this->db->select('guarantor_type,id,guarantor_name');
		$this->db->from('cma_guarantor');
		$this->db->where(array('cma_id'=>$result[0]['cma_id'],'sts'=>1));
		if(!empty($arr)){
		$this->db->where_not_in('id',$arr);
		}
		$this->db->order_by('id',"DESC");
		$result[0]['guarantor'] = $this->db->get()->result_array();


		//$result['']
		return $result;
	}

	function get_details($id){
		$this->db->select("e.*,c.sl_no,c.proposed_type,c.loan_ac,c.ac_name,c.legal_region,
    	n.name as case_n,s.case_number,c.brrower_name,ar.name as arrested_by,nw.name as nature_wa,dp.name as wa_status,if(e.status=1,'Pending','Satteled') as fsts,cr.name as executed_criterea,date_format(e.issue_date,'%d/%m/%Y') as issue_date", FALSE)
			->from("file_executed_data e")
			->join('ref_arrested_by ar', 'ar.id=e.arrested_by', 'left')
			->join('ref_nature_warrent_arrest nw', 'nw.id=e.nature_wa', 'left')
			->join('ref_disposal_sts dp', 'dp.id=e.wa_status', 'left')
			->join('suit_filling_info s', 's.id=e.file_id', 'left')
			->join('ref_execution_criteria cr', 'cr.id=e.executed_criterea', 'left')
			->join('cma c', 'c.id=s.cma_id', 'left')
			->join('ref_case_name n', 'n.id=s.case_name', 'left')
			->where(array('e.id'=>$id))
			->limit(1);
		$q=$this->db->get();
		$suit_row = $q->row();

		$this->db->select('*', FALSE)
			->from("file_executed_files")
			->where(array('executed_id'=>$suit_row->id,'sts'=>1));
		$ext=$this->db->get();
		$suit_row->wa_files = $ext->result();

		$this->db->select('d.*,date_format(d.executed_dt,"%d-%m-%Y") as executed_dt,g.guarantor_type,g.guarantor_name
    	', FALSE)
			->from("file_executed_by d")
			->join('cma_guarantor g', 'g.id=d.who_executed', 'left')
			->where(array('d.executed_id'=>$suit_row->id,'d.sts'=>1));
		$ext=$this->db->get();
		$suit_row->executed = $ext->result();


		$this->db->select("r.*,if(r.executor IS NULL,r.executor_pin,t.pin) as pin,if(r.executor IS NULL,r.executor_name,t.name) as u_name,if(r.executor_type=0,'Others',u.group_name) as group_name");
		$this->db->from('file_executor as r');
		$this->db->join("user_group as u", "u.id=r.executor_type", "left");
		$this->db->join("users_info as t", "t.id=r.executor", "left");
		$this->db->where('r.executed_id', $suit_row->id);
		$this->db->where('r.sts', '1');
		$ext=$this->db->get();
		$suit_row->executor = $ext->result();


		$html = '';
		$html.='<table style="width: 100%;" class="preview_table2" >
			<tr>
                <th width="20%" align="left"><strong>CMA Serial No</strong></th>
                <td width="30%" align="left">'.$suit_row->sl_no.'</td>
                <th width="20%" align="left"><strong>Arrested By</strong></th>
                <td width="30%" align="left" >'.$suit_row->arrested_by.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->ac_name.'</td>
                <th width="20%" align="left"><strong>WA Status</strong></th>
                <td width="30%" align="left" >'.$suit_row->wa_status.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account</strong></th>
                <td width="30%" align="left" >'.$suit_row->loan_ac.'</td>
                <th width="20%" align="left"><strong>Execution Criteria</strong></th>
                <td width="30%" align="left" >'.$suit_row->executed_criterea.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Borrower Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->brrower_name.'</td>
                <th width="20%" align="left"><strong>Status</strong></th>
                <td width="30%" align="left" >'.$suit_row->fsts.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Loan Type</strong></th>
                <td width="30%" align="left" >'.$suit_row->proposed_type.'</td>
                <th width="20%" align="left"><strong>Police Station Sharok no</strong></th>
                <td width="30%" align="left" >'.$suit_row->sharok_no.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Case Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->case_n.'</td>
                <th width="20%" align="left"><strong>Issue Date</strong></th>
                <td width="30%" align="left" >'.$suit_row->issue_date.'</td>
            </tr>
            <tr>
               	<th width="20%" align="left"><strong>Case Number</strong></th>
                <td width="30%" align="left" >'.$suit_row->case_number.'</td>
                <th width="20%" align="left"><strong>Police Station Name </strong></th>
                <td width="30%" align="left" >'.$suit_row->ps_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Nature of WA</strong></th>
                <td width="30%" align="left">'.$suit_row->nature_wa.'</td>
                <th width="20%" align="left"><strong>W/A Copy Attested</strong></th>
                <td width="30%" align="left" >';
                foreach($suit_row->wa_files as $vale){
                	$html .='<img id="file_preview_wa_scan_copy" onclick="popup(\''.base_url().'cma_file/wa_scan_copy/'.$vale->wa_scan_copy.'\')" style=" cursor:pointer;text-align:center" src="'.base_url().'old_assets/images/print-preview.png" height="18">';
                }
                
            $html .='</td>
            </tr>
            
            </table>';
            if(count($suit_row->executed)>0){
            $html .='<br><br>
            <table style="width:100%;" class="preview_table2">
        		<tr style="background-color: #aadeff;">
        			<th colspan="3">Who Executed?</th>
        		</tr>
        		<tr>
        			<th>Name</th>
        			<th>Executed Date</th>
        			<th>Remarks</th>
        		</tr>';
        		foreach($suit_row->executed as $exerow){
        			$guarantor = $exerow->guarantor_name.' ('.$exerow->guarantor_type.')';
        			if($exerow->who_executed==0){$guarantor='Others';}
        		$html .= '<tr>
        			<td>'.$guarantor.'</td>
        			<td>'.$exerow->executed_dt.'</td>
        			<td>'.$exerow->remarks.'</td>
        		</tr>';
        		}
        	$html .= '</table><br><br>';
        	}
        	if(count($suit_row->executor)>0){
        	$html .='<table style="width:100%;" class="preview_table2">
        		<tr style="background-color: #009cff;">
        			<th colspan="6">Executor</th>
        		</tr>
        		<tr>
        			<th>Type</th>
        			<th>Pin</th>
        			<th>Name</th>
        			<th>Amount</th>
        			<th>Status</th>
        			<th>Remarks</th>
        		</tr>';
        		foreach($suit_row->executor as $torrow){
        		$html .= '<tr>
        			<td>'.$torrow->group_name.'</td>
        			<td>'.$torrow->pin.'</td>
        			<td>'.$torrow->u_name.'</td>
        			<td>'.$torrow->amount.'</td>
        			<td>'.$torrow->paid_sts.'</td>
        			<td>'.$torrow->pariculars.'</td>
        		</tr>';
        		}
        	$html .= '</table>';
        	}
		return $html;
	}


	function executed_incentive_xl(){
		$where2 = "s.sts=1 AND s.paid_sts ='paid' ";
		if($this->input->post('s_case_number')!='' ) 
		{$where2.=" AND o.case_number = '".trim($this->input->post('s_case_number'))."'";}
		if($this->input->post('s_name')!='' && !ctype_space($this->input->post('s_name'))) 
		{$where2.=" AND s.executor_name = '".trim($this->input->post('s_name'))."'";
		$where2.=" OR u.name = '".trim($this->input->post('s_name'))."'";}

		if($this->input->post('s_proposed_type')!='') 
		{$where2.=" AND o.proposed_type = '".trim($this->input->post('s_proposed_type'))."'";}
		if($this->input->post('s_account')!='') 
		{
			if($this->input->post('s_proposed_type')=='Card'){
				$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->post('hidden_loan_ac')));
				$where2.=" AND o.org_loan_ac = '".$card."'";
			}else{
				if($this->input->post('s_account')!='' && $this->input->post('s_account')!=0) 
				{$where2.=" AND o.loan_ac = '".trim($this->input->post('s_account'))."'";}
			}
		}

		$this->db->select('s.*,c.executed_criterea, m.loan_ac, m.ac_name,o.case_number,
    		if(s.executor_type=0,"Others",g.group_name) as group_name,o.proposed_type,
    		if(s.executor IS NULL,s.executor_pin,u.pin) as pin, 
    		if(s.executor IS NULL,s.executor_name,u.name) as user_name
    	', FALSE)
			->from("file_executor s")
			->join('file_executed_data c', 'c.id=s.executed_id', 'left')
			->join('user_group g', 'g.id=s.executor_type', 'left')
			->join('suit_filling_info o', 'o.id=c.file_id', 'left')
			->join('cma m', 'm.id=o.cma_id', 'left')
			->join('users_info u', 'u.id=s.executor', 'left')
			//->join('cma_guarantor g', 'g.cma_id=s.cma_id AND g.guarantor_type="G"', 'left')
			->where($where2);
		$q=$this->db->get();
		return $result = $q->result();
	}

	function get_file_name($field_name,$path)
    {

        //Deleteng old file when no new file selected
        if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='0') 
        {
            $delete_path = $path.$_POST['hidden_'.$field_name.'_value'];      
            //chmod($path, 0777);
            if(file_exists($delete_path)){
            unlink($delete_path);  
            } 
            $file ="";
        }//Deleteng old file and new file selected
        else if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='1') 
        {
            $delete_path = $path.$_POST['hidden_'.$field_name.'_value'];      
            //chmod($path, 0777);
            if(file_exists($delete_path)){
            	unlink($delete_path); 
            }              
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




}