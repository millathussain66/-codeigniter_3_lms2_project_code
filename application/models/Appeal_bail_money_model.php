<?php
class Appeal_bail_money_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
	}



	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "a.sts=1 AND a.life_cycle=1";
		if($this->input->get('case_number')!='') 
		{$where2.=" AND f.case_number = ".$this->db->escape(trim($this->input->get('case_number')));}
		if($this->input->get('ac_name')!='' && !ctype_space($this->input->get('ac_name'))) 
		{$where2.=" AND f.ac_name = ".$this->db->escape(trim($this->input->get('ac_name')));}
		if($this->input->get('account')!='' && $this->input->get('account')!=0) 
		{$where2.=" AND f.loan_ac = ".$this->db->escape(trim($this->input->get('account')));}

		if($this->input->get('proposed_type')!='') 
		{$where2.=" AND f.proposed_type = ".$this->db->escape(trim($this->input->get('proposed_type')));}
		if($this->input->get('account')!='') 
		{
			if($this->input->get('proposed_type')=='Card'){
				$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->get('hidden_loan_ac')));
				$where2.=" AND f.org_loan_ac = '".$card."'";
			}else{
				if($this->input->get('account')!='' && $this->input->get('account')!=0) 
				{$where2.=" AND f.loan_ac = '".trim($this->input->get('account'))."'";}
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

        		if($filterdatafield=='deposit_dt')
				{
					$filterdatafield = "DATE_FORMAT(a.deposit_date,'%d-%m-%Y')";
				}				
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='f.ac_name';
				}
				else if($filterdatafield=='loan_ac')
				{
					$filterdatafield='f.loan_ac';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='f.case_number';
				}
				else
				{
					$filterdatafield='a.'.$filterdatafield;
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
			$sortdatafield="a.id";
			$sortorder = "DESC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS a.*,f.case_number,c.loan_ac,c.ac_name,c.id as cma_id,f.case_number,DATE_FORMAT(a.deposit_date,"%d-%m-%Y") AS deposit_dt,DATE_FORMAT(a.deposit_date,"%d/%m/%Y") AS depo_dt,t.name as appeal_bail_type', FALSE)
			->from("appeal_deposit a")
			->join('suit_filling_info f', 'f.id=a.suit_id', 'left')
			->join('ref_appeal_bail_type t', 't.id=a.appeal_bail_type', 'left')
			->join('cma c', 'c.id=f.cma_id', 'left')
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
	function get_pending_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{

	   	$i=0;
	   	//$where2 = "s.sts<>0 AND s.suit_sts=75 AND ((s.case_name=1 AND s.req_type=1) OR (s.case_name IN(5,6) AND s.req_type=2 AND s.re_case_sts=1 AND s.case_sts_prev_dt=29) OR (s.case_name=4 AND s.req_type=2 AND s.case_sts_prev_dt=29)) AND s.life_cycle <> 3 AND (s.deposit_percent-s.percent_depo)>0";
	   	$where2= '1 ';
		if($this->input->get('case_number')!='') 
		{$where2.=" AND s.case_number = ".$this->db->escape(trim($this->input->get('case_number')));}
		if($this->input->get('ac_name')!='' && !ctype_space($this->input->get('ac_name'))) 
		{$where2.=" AND s.ac_name = ".$this->db->escape(trim($this->input->get('ac_name')));}
		if($this->input->get('account')!='' && $this->input->get('account')!=0) 
		{$where2.=" AND s.loan_ac = ".$this->db->escape(trim($this->input->get('account')));}

		if($this->input->get('proposed_type')!='') 
		{$where2.=" AND s.proposed_type = ".$this->db->escape(trim($this->input->get('proposed_type')));}
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

        		if($filterdatafield=='deposit_dt')
				{
					$filterdatafield = "DATE_FORMAT(a.deposit_date,'%d-%m-%Y')";
				}				
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='s.ac_name';
				}
				else if($filterdatafield=='loan_ac')
				{
					$filterdatafield='s.loan_ac';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='s.case_number';
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
    	$this->db->select('SQL_CALC_FOUND_ROWS s.*
    		', FALSE)
			->from("(SELECT s2.*,IF(b.percent_depo IS NULL,0,b.percent_depo) AS percent_depo,IF(b.unverify IS NULL,0,b.unverify) AS unverify,(s2.deposit_percent - IF(b.percent_depo IS NULL,0,b.percent_depo)) AS total_percent,a.name AS appeal_bail_type_name,a.id AS appeal_bail_type FROM
				(SELECT s1.*, IF(s1.case_name = 1,'50',IF(s1.case_name = 4, '25', '10')) AS deposit_percent FROM suit_filling_info AS s1 WHERE s1.sts <> 0 
				  AND (s1.suit_sts = 75 OR s1.suit_sts = 76) AND (((s1.case_name = 1 OR s1.case_name = 16) AND s1.req_type = 1 ) 
				    OR (s1.case_name IN (5, 6) AND s1.req_type = 2 AND s1.re_case_sts = 1 AND (s1.case_sts_prev_dt = 29  OR s1.final_remarks=2)) 
				    OR (s1.case_name = 4 AND s1.req_type = 2 AND (s1.case_sts_prev_dt = 29  OR s1.final_remarks=2))
				  ) AND s1.deposit_sts=0 ) AS s2
				LEFT JOIN (SELECT 
					SUM(IF(life_cycle =2,deposit_percent,0)) AS percent_depo,
					SUM(IF(life_cycle =1,1,0)) AS unverify, suit_id 
				      FROM appeal_deposit WHERE sts <> 0 GROUP BY suit_id) AS b ON b.suit_id = s2.id
				LEFT JOIN ref_appeal_bail_type AS a ON a.id = IF(s2.case_name = 1 OR s2.case_name = 16,1,IF(s2.case_name = 4, 2, 3))) s")
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
	function withdrawn_pending_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "a.sts=1 AND a.life_cycle=2 AND (a.withdraw_id IS NULL OR a.withdraw_id=0)";
		if($this->input->get('case_number')!='') 
		{$where2.=" AND f.case_number = ".$this->db->escape(trim($this->input->get('case_number')));}
		if($this->input->get('ac_name')!='' && !ctype_space($this->input->get('ac_name'))) 
		{$where2.=" AND f.ac_name = ".$this->db->escape(trim($this->input->get('ac_name')));}
	
		if($this->input->get('account')!='' && $this->input->get('account')!=0) 
		{$where2.=" AND f.loan_ac = ".$this->db->escape(trim($this->input->get('account')));}
		if($this->input->get('proposed_type')!='') 
		{$where2.=" AND f.proposed_type = ".$this->db->escape(trim($this->input->get('proposed_type')));}
		if($this->input->get('account')!='') 
		{
			if($this->input->get('proposed_type')=='Card'){
				$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->get('hidden_loan_ac')));
				$where2.=" AND f.org_loan_ac = '".$card."'";
			}else{
				if($this->input->get('account')!='' && $this->input->get('account')!=0) 
				{$where2.=" AND f.loan_ac = '".trim($this->input->get('account'))."'";}
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

        		if($filterdatafield=='deposit_dt')
				{
					$filterdatafield = "DATE_FORMAT(a.deposit_date,'%d-%m-%Y')";
				}				
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='f.ac_name';
				}
				else if($filterdatafield=='loan_ac')
				{
					$filterdatafield='f.loan_ac';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='f.case_number';
				}
				else if($filterdatafield=='status_name')
				{
					$filterdatafield='s.name';
				}
				else
				{
					$filterdatafield='a.'.$filterdatafield;
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
		
		if ($sortorder == '')
		{
			$sortdatafield="a.id";
			$sortorder = "DESC";				
		}
    	$this->db->select('SQL_CALC_FOUND_ROWS a.*,f.loan_ac,f.ac_name,f.case_number,DATE_FORMAT(a.deposit_date,"%d-%m-%Y") AS deposit_dt,DATE_FORMAT(a.deposit_date,"%d/%m/%Y") AS depo_dt,DATE_FORMAT(a.withdraw_dt,"%d/%m/%Y") AS withdraw_dt,if(a.v_sts=77,s.name,s.name) as status_name,t.name as appeal_bail_type,sum(a.deposit_amt) as deposit_amt,sum(a.deposit_percent) as deposit_percent,count(a.suit_id) as total_row,sum(if(a.v_sts IN (77),1,0)) as verify_s,f.req_type', FALSE)
			->from("appeal_deposit a")
			->join('suit_filling_info f', 'f.id=a.suit_id', 'left')
			->join('ref_appeal_bail_type t', 't.id=a.appeal_bail_type', 'left')
			//->join('cma c', 'c.id=f.cma_id', 'left')
			->join('ref_status s', 's.id=a.v_sts', 'left')
			->where($where2)
			->where($where)
			->group_by('a.suit_id')
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
	function withdrawn_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "w.sts=1";
		if($this->input->get('case_number')!='') 
		{$where2.=" AND f.case_number = ".$this->db->escape(trim($this->input->get('case_number')));}
		if($this->input->get('ac_name')!='' && !ctype_space($this->input->get('ac_name'))) 
		{$where2.=" AND f.ac_name = ".$this->db->escape(trim($this->input->get('ac_name')));}
	
		if($this->input->get('account')!='' && $this->input->get('account')!=0) 
		{$where2.=" AND f.loan_ac = ".$this->db->escape(trim($this->input->get('account')));}
		if($this->input->get('proposed_type')!='') 
		{$where2.=" AND f.proposed_type = ".$this->db->escape(trim($this->input->get('proposed_type')));}
		if($this->input->get('account')!='') 
		{
			if($this->input->get('proposed_type')=='Card'){
				$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->get('hidden_loan_ac')));
				$where2.=" AND f.org_loan_ac = '".$card."'";
			}else{
				if($this->input->get('account')!='' && $this->input->get('account')!=0) 
				{$where2.=" AND f.loan_ac = '".trim($this->input->get('account'))."'";}
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

        		if($filterdatafield=='deposit_dt')
				{
					$filterdatafield = "DATE_FORMAT(a.deposit_date,'%d-%m-%Y')";
				}				
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='f.ac_name';
				}
				else if($filterdatafield=='loan_ac')
				{
					$filterdatafield='f.loan_ac';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='f.case_number';
				}
				else if($filterdatafield=='status_name')
				{
					$filterdatafield='s.name';
				}
				else
				{
					$filterdatafield='w.'.$filterdatafield;
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
		
		if ($sortorder == '')
		{
			$sortdatafield="w.id";
			$sortorder = "DESC";				
		}
    	$this->db->select('SQL_CALC_FOUND_ROWS w.*,f.loan_ac,f.ac_name,f.case_number,if(w.v_sts=77,s.name,s.name) as status_name,t.name as appeal_bail_type,a.deposit_amt,a.deposit_percent,DATE_FORMAT(w.withdraw_date,"%d/%m/%Y") as withdraw_date', FALSE)
			->from("appeal_deposit_withdraw w")
			->join("(SELECT SUM(deposit_percent) AS deposit_percent,SUM(deposit_amt) AS deposit_amt,appeal_bail_type,withdraw_id FROM appeal_deposit WHERE sts<>0 AND withdraw_id<>'' GROUP BY withdraw_id) as a", 'w.id=a.withdraw_id', 'left')
			->join('suit_filling_info f', 'f.id=w.suit_id', 'left')
			->join('ref_appeal_bail_type t', 't.id=a.appeal_bail_type', 'left')
			//->join('cma c', 'c.id=f.cma_id', 'left')
			->join('ref_status s', 's.id=w.v_sts', 'left')
			->where($where2)
			->where($where)
			//->group_by('a.withdraw_id')
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
	function data_details_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "a.sts=1 AND a.life_cycle=2 AND a.v_sts=77 ";
	   	if($this->input->get('datefrom')!='') 
		{$where2.=" AND date_format(a.withdraw_dt,'%d/%m/%Y') >= ".$this->db->escape($this->input->get('datefrom'));}
		if($this->input->get('dateto')!='') 
		{$where2.=" AND date_format(a.withdraw_dt,'%d/%m/%Y') <= ".$this->db->escape($this->input->get('dateto'));}

		if($this->input->get('case_number')!='') 
		{$where2.=" AND f.case_number = '".trim($this->input->get('case_number'))."'";}
		if($this->input->get('ac_name')!='' && !ctype_space($this->input->get('ac_name'))) 
		{$where2.=" AND f.ac_name = '".trim($this->input->get('ac_name'))."'";}
	
		if($this->input->get('account')!='' && $this->input->get('account')!=0) 
		{$where2.=" AND f.loan_ac = '".trim($this->input->get('account'))."'";}
		if($this->input->get('proposed_type')!='') 
		{$where2.=" AND f.proposed_type = '".trim($this->input->get('proposed_type'))."'";}
		if($this->input->get('account')!='') 
		{
			if($this->input->get('proposed_type')=='Card'){
				$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->get('hidden_loan_ac')));
				$where2.=" AND f.org_loan_ac = '".$card."'";
			}else{
				if($this->input->get('account')!='' && $this->input->get('account')!=0) 
				{$where2.=" AND f.loan_ac = '".trim($this->input->get('account'))."'";}
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

        		if($filterdatafield=='deposit_dt')
				{
					$filterdatafield = "DATE_FORMAT(a.deposit_date,'%d-%m-%Y')";
				}				
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='c.ac_name';
				}
				else if($filterdatafield=='loan_ac')
				{
					$filterdatafield='c.loan_ac';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='f.case_number';
				}
				else if($filterdatafield=='status_name')
				{
					$filterdatafield='s.name';
				}
				else
				{
					$filterdatafield='a.'.$filterdatafield;
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
		/*$where_initi=''; 
		if($where=='' || count($where)<=0){			
			//$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		}*/
		
		if ($sortorder == '')
		{
			$sortdatafield="a.id";
			$sortorder = "DESC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS a.*,c.loan_ac,c.ac_name,f.case_number,DATE_FORMAT(a.deposit_date,"%d-%m-%Y") AS deposit_dt,DATE_FORMAT(a.deposit_date,"%d/%m/%Y") AS depo_dt,DATE_FORMAT(a.withdraw_dt,"%d/%m/%Y") AS withdraw_dt,if(a.v_sts=77,s.name,"") as status_name,t.name as appeal_bail_type', FALSE)
			->from("appeal_deposit a")
			->join('suit_filling_info f', 'f.id=a.suit_id', 'left')
			->join('ref_appeal_bail_type t', 't.id=a.appeal_bail_type', 'left')
			->join('cma c', 'c.id=f.cma_id', 'left')
			->join('ref_status s', 's.id=a.v_sts', 'left')
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
	function bill_pending_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "e.sts=1 AND e.module_name='appeal_bail' AND cd.memo_sts!=31 ";
		

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

        		if($filterdatafield=='activities_date')
				{
					$filterdatafield = "DATE_FORMAT(e.activities_date,'%d-%m-%Y')";
				}				
				else if($filterdatafield=='bill_sts')
				{
					$filterdatafield='cd.memo_sts';
					if(strtolower($filtervalue)=='completed'){
						$filtervalue=31;
					}else{
						$filtercondition='NOT_EQUAL';
						$filtervalue=31;
					}
				}
				else if($filterdatafield=='expense_name')
				{
					$filterdatafield='et.name';
				}
				else if($filterdatafield=='vendor_name')
				{
					
				}
				else if($filterdatafield=='district_name')
				{
					$filterdatafield='d.name';
				}
				else if($filterdatafield=='activities')
				{
					$filterdatafield='ea.name';
				}
				else if($filterdatafield=='deposit_amt')
				{
					$filterdatafield='a.deposit_amt';
				}
				else if($filterdatafield=='deposit_dt')
				{
					$filterdatafield='DATE_FORMAT(a.deposit_date,"%d-%m-%Y")';
				}
				else if($filterdatafield=='arrested')
				{
					$filterdatafield='a.arrested';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='f.case_number';
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

				if($filterdatafield =='vendor_name')
				{
					$where .= " (l.name LIKE '%".$filtervalue."%' OR u.name LIKE '%".$filtervalue."%') ";
				}else{
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
			$sortdatafield="e.id";
			$sortorder = "DESC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS e.*,c.loan_ac,c.ac_name,f.case_number,cd.memo_sts,et.name as expense_name,ea.name as activities,d.name as district_name,if(e.expense_type=1,l.name,u.name) as vendor_name
    		,DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS activities_date,if(cd.memo_sts=31,"Completed","Pending") as bill_sts', FALSE)
			->from("expenses e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('users_info u', 'u.id=e.vendor_id', 'left')
			->join('ref_district d', 'd.id=e.district', 'left')
			->join('ref_expense_activities ea', 'ea.id=e.activities_name', 'left')
			->join('cost_details cd', 'cd.sub_table_name="expenses" AND cd.sub_table_id=e.id', 'left')
			//->join('appeal_deposit a', 'a.id=e.event_id', 'left')
			->join('suit_filling_info f', 'f.id=e.suit_id', 'left')
			->join('cma c', 'c.id=f.cma_id', 'left')
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
	function bill_completed_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "e.sts=1 AND e.module_name='appeal_bail' AND cd.memo_sts=31 ";
		

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

        		if($filterdatafield=='activities_date')
				{
					$filterdatafield = "DATE_FORMAT(e.activities_date,'%d-%m-%Y')";
				}				
				else if($filterdatafield=='bill_sts')
				{
					$filterdatafield='cd.memo_sts';
					if(strtolower($filtervalue)=='completed'){
						$filtervalue=31;
					}else{
						$filtercondition='NOT_EQUAL';
						$filtervalue=31;
					}
				}
				else if($filterdatafield=='expense_name')
				{
					$filterdatafield='et.name';
				}
				else if($filterdatafield=='vendor_name')
				{
					
				}
				else if($filterdatafield=='district_name')
				{
					$filterdatafield='d.name';
				}
				else if($filterdatafield=='activities')
				{
					$filterdatafield='ea.name';
				}
				else if($filterdatafield=='deposit_amt')
				{
					$filterdatafield='a.deposit_amt';
				}
				else if($filterdatafield=='deposit_dt')
				{
					$filterdatafield='DATE_FORMAT(a.deposit_date,"%d-%m-%Y")';
				}
				else if($filterdatafield=='arrested')
				{
					$filterdatafield='a.arrested';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='f.case_number';
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

				if($filterdatafield =='vendor_name')
				{
					$where .= " (l.name LIKE '%".$filtervalue."%' OR u.name LIKE '%".$filtervalue."%') ";
				}else{
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
			$sortdatafield="e.id";
			$sortorder = "DESC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS e.*,c.loan_ac,c.ac_name,f.case_number,cd.memo_sts,et.name as expense_name,ea.name as activities,d.name as district_name,if(e.expense_type=1,l.name,u.name) as vendor_name
    		,DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS activities_date,if(cd.memo_sts=31,"Completed","Pending") as bill_sts', FALSE)
			->from("expenses e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('users_info u', 'u.id=e.vendor_id', 'left')
			->join('ref_district d', 'd.id=e.district', 'left')
			->join('ref_expense_activities ea', 'ea.id=e.activities_name', 'left')
			->join('cost_details cd', 'cd.sub_table_id=e.id AND cd.sub_table_name="expenses"', 'left')
			//->join('appeal_deposit a', 'a.id=e.event_id', 'left')
			->join('suit_filling_info f', 'f.id=e.suit_id', 'left')
			->join('cma c', 'c.id=f.cma_id', 'left')
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
		if($this->input->get('account')!='' && $this->input->get('account')!=0) 
		{$where2.=" AND m.loan_ac = '".trim($this->input->get('account'))."'";}

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
		
		if ($sortorder == '')
		{
			$sortdatafield="s.id";
			$sortorder = "ASC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS s.*,c.executed_criterea, m.loan_ac, m.ac_name,o.case_number,
    		g.group_name,
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
	
    function add_edit_action()
	{
		$this->db->trans_begin();
		$editrow = $this->input->post('edit_row');
        if($editrow==""){$editrow=0;}
	    $table_name = "appeal_deposit";
	    $table_row_id = $editrow+1;
	    $edit_id = $this->input->post('edit_row');
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";
	    $change_date_format = str_replace('/', '-', $this->input->post('deposite_date'));
	    $act_date = date('Y-m-d',strtotime($change_date_format));
	    $appeal_bail_scan_copy = $this->get_file_name('appeal_bail_scan_copy','cma_file/appeal_bail_scan_copy/');
	    //AIT & VAT Data
	    $expenses = array(
			'appeal_bail_type' =>$this->security->xss_clean( $this->input->post('appeal_bail_type')),
			'suit_id' =>$this->security->xss_clean( $this->input->post('suit_id')),
			'wa_id' =>$this->security->xss_clean( $this->input->post('wa_id')),
			'deposit_amt' =>$this->security->xss_clean( $this->input->post('deposited_amount')),
			'deposit_percent' =>$this->security->xss_clean( $this->input->post('percent_deposit')),
			'deposit_date' =>$act_date,
			'appeal_bail_scan_copy' =>$appeal_bail_scan_copy,
			'arrested' =>$this->security->xss_clean( $this->input->post('arrested')),
		);
		if($this->input->post('add_edit')=="add")
		{
			$expenses['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['e_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 39;
			$this->db->insert('appeal_deposit', $expenses);
			$insert_idss = $this->db->insert_id();

			//$this->db->where('id', $this->input->post('suit_id'));
			//$this->db->update('suit_filling_info', array('deposit_sts'=>1));

		    $activities_id = 39;
		    $description_activities = 'Add Deposit Amount - ('.$insert_idss.')';
		}
		else
		{
	  		$expenses['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['u_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 35;
			$this->db->where('id', $edit_id);
			$this->db->update('appeal_deposit', $expenses);
	  		$insert_idss = $edit_id;

	        $activities_id = 35;
	        $description_activities = 'Edit Deoisut Amount - ('.$insert_idss.')';

		}
		

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities($activities_id,'',$insert_idss,$table_name,$description_activities);
			return $insert_idss;
		}


	}
	function add_edit_withdraw_action($add_edit=NULL,$edit_id=NULL,$editrow=NULL){
		$this->db->trans_begin();
        if($editrow==""){$editrow=0;}
	    $table_name = "appeal_deposit";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";
	    $appeal_id = '';
	    $change_date_format = str_replace('/', '-', $this->input->post('withdraw_date'));
		    $withdraw_date = date('Y-m-d',strtotime($change_date_format));
		$summary = array(
    		'suit_id'=>$this->security->xss_clean($this->input->post('suit_id')),
    		'withdraw_date'=>$withdraw_date,
    		//'appeal_id'=>$appeal_id
    	);
	    if($add_edit=='edit'){
	    	$summary['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$summary['u_dt'] = date('Y-m-d H:i:s');
			$summary['v_sts'] = 35;
			$this->db->where('id',$this->input->post('edit_row'));
        	$this->db->update('appeal_deposit_withdraw', $summary);
        	$with_idss = $this->input->post('edit_row');
	    }else{
	    	$summary['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$summary['e_dt'] = date('Y-m-d H:i:s');
			$summary['v_sts'] = 39;
        	$this->db->insert('appeal_deposit_withdraw', $summary);
        	$with_idss = $this->db->insert_id();
	    }
	    foreach($_POST['check'] as $key=>$val){
	    	if($key!=0){$comma=',';}else{$comma='';}
	    	$appeal_id.=$comma.$val;
	    	$expenses['w_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['w_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 35;
			$expenses['withdraw_dt'] = $withdraw_date;

			$expenses['withdraw_id'] = $with_idss;
			$this->db->where('id', $val);
			$this->db->update('appeal_deposit', $expenses);
	    }
	    if($add_edit=='edit'){
			$getrow = $this->db->query('SELECT * FROM appeal_deposit_withdraw WHERE id='.$with_idss)->row();
			$arr = explode(',',$getrow->appeal_id);
			$appe = explode(',',$appeal_id);
			foreach($arr as $key=>$val){
				if(!in_array($val,$appe)){
					$this->db->where('id', $val);
					$this->db->update('appeal_deposit', array('withdraw_id'=>'','v_sts'=>'38'));
				}
			}
		}
	    $this->db->where('id', $with_idss);
		$this->db->update('appeal_deposit_withdraw', array('appeal_id'=>$appeal_id));


		$suit_row=$this->db->query('select * from suit_filling_info where id='.$this->input->post('suit_id'))->row();
		for($i=1;$i<= $_POST['expense_counter'];$i++)
        {
        	$appeal_bail_bill_copy = $this->get_file_name('appeal_bail_bill_copy_'.$i,'cma_file/appeal_bail_bill_copy/');

            $expense_data = array(
            'event_id' => $with_idss,
            'suit_id' => $this->security->xss_clean($this->input->post('suit_id')),
            'proposed_type' => $suit_row->proposed_type,
            'org_loan_ac' =>  $suit_row->org_loan_ac,
            'account_number' =>  $suit_row->loan_ac,
            'ac_name' =>  $suit_row->ac_name,
            'req_type' =>  $suit_row->req_type,
            'case_number' =>  $suit_row->case_number,
            'region' =>  $suit_row->region,

            'module_name' =>'appeal_bail',
            'district' =>$this->security->xss_clean( $this->input->post('district_'.$i)),
            'expense_type' =>$this->security->xss_clean( $this->input->post('expense_type_'.$i)),
            'activities_name' => $this->security->xss_clean( $this->input->post('activities_name_'.$i)),
            'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
            'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
            'appeal_bail_bill_copy' => $appeal_bail_bill_copy,
            'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
            'vendor_id' => $this->security->xss_clean( $this->input->post('vendor_id_'.$i))
            );
            // For skip The new deleted row
            if ($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==1) 
            {
                continue;
            }
            //For Delete the old row
            if ($_POST['expense_edit_'.$i]!=0 && $_POST['expense_delete_'.$i]==1) 
            {
                $expense_data = array('sts' => 0);
                $this->db->where('id',$_POST['expense_edit_'.$i]);
                $this->db->update('expenses', $expense_data);
            }
            //For update the old row
            else if($_POST['expense_edit_'.$i]!=0 && $_POST['expense_delete_'.$i]!=1)
            {
            	$expense_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
				$expense_data['u_dt'] = date('Y-m-d H:i:s');
                $this->db->where('id',$_POST['expense_edit_'.$i]);
                $this->db->update('expenses', $expense_data);
            }
            //For insert the new row
            else if($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==0)
            {
            	$expense_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
				$expense_data['e_dt'] = date('Y-m-d H:i:s');
                $this->db->insert('expenses', $expense_data);
            }
            
        }
        if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities($activities_id,'',$this->security->xss_clean($this->input->post('edit_row')),$table_name,$description_activities);
			return $this->security->xss_clean($this->input->post('edit_row'));
		}
	}
	
	function delete_action(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "appeal_deposit";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';
		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('appeal_deposit',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('appeal_deposit', $data);
				$activities_id = 15;
				$description_activities = 'Delete Appeal Bail Deposit Money - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason =trim($_POST['comments']);
			}
			
		}
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('appeal_deposit',$_POST['deleteEventId'],37,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts' => 37, 's_by'=> $this->session->userdata['ast_user']['user_id'], 's_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('appeal_deposit', $data);
				$activities_id = 38;
				$description_activities = 'Appeal Bail Deposit Money Sendtochecker - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason ='';
			}
			
		}
		if($this->input->post('type')=='sendforauthorization'){
			$pre_action_result=$this->Common_model->get_pre_action_data('appeal_deposit',$_POST['verifyid'],66,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts'=>66);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('appeal_deposit', $data);

				$data4 = array('authorization_type' => 3,'event_id'=> $_POST['verifyid'],'auth_sts' => 66,'sfa_by'=> $this->session->userdata['ast_user']['user_id'], 'sfa_dt'=>date('Y-m-d H:i:s'));
                    $this->db->insert('authorization', $data4);

				$activities_id = 66;
				$description_activities = 'Send For Authorization Appeal and Bail Money Withdrawn - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['verifyid'];
				
			}
		}
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('appeal_deposit',$_POST['verifyid'],38,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38,'life_cycle'=>2);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('appeal_deposit', $data);
				$get_row = $this->db->query("SELECT s1.*,IF(s1.case_name = 1,'50',IF(s1.case_name = 4, '25', '10')) AS deposit_percent,a.depo
					FROM suit_filling_info s1 
					LEFT JOIN(
						SELECT SUM(deposit_percent) AS depo,suit_id FROM appeal_deposit WHERE suit_id=".$_POST['d_suit_id']." AND v_sts=38 AND sts<>0 GROUP BY suit_id
					) AS a ON a.suit_id=s1.id
					WHERE id=".$_POST['d_suit_id']." AND s1.sts <> 0 AND s1.deposit_sts=0")->row();
				if($get_row->depo>=$get_row->deposit_percent){
					$this->db->where('id', $this->input->post('d_suit_id'));
					$this->db->update('suit_filling_info', array('deposit_sts'=>1));
				}
				$activities_id = 38;
				$description_activities = 'Verify Appeal Bail Deposit Money - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];
				
			}
		}
		if($this->input->post('type')=='return'){
			$pre_action_result=$this->Common_model->get_pre_action_data('appeal_deposit',$_POST['verifyid'],20,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('sfc_by'=> $this->session->userdata['ast_user']['user_id'], 'sfc_dt'=>date('Y-m-d H:i:s'),'sfc_reason'=>trim($_POST['return_reason']),'v_sts'=>20);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('appeal_deposit', $data);
				$activities_id = 38;
				$description_activities = 'Send for Correction Appeal Bail Deposit Money - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];
				$reason =trim($_POST['return_reason']);
				
			}
		}
		
		if($this->input->post('type')=='withdrawn'){
			$pre_action_result=$this->Common_model->get_pre_action_data('appeal_deposit',$_POST['verifyid'],77,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{

				$data = array('w_by'=> $this->session->userdata['ast_user']['user_id'], 'w_dt'=>date('Y-m-d H:i:s'),'v_sts'=>77);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('appeal_deposit', $data);
				$activities_id = 38;
				$description_activities = 'Withdrawn Appeal Bail Deposit Money - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];

				//Genereate Expenses
                $str="SELECT  j0.*
                         FROM expenses j0
                     WHERE j0.sts != '0'  AND j0.event_id= '".$_POST['verifyid']."' AND j0.module_name='appeal_bail'";   
                $expense_data=$this->db->query($str)->result();

                $sql="SELECT * FROM suit_filling_info WHERE id = '".$_POST['d_suit_id']."'";   
                $suit_data=$this->db->query($sql)->row();

                if (!empty($expense_data)) {
                        foreach ($expense_data as $key) {
                            $cost_data = array(
                            'module_name' => 'suit_file',
                            'main_table_name' => 'appeal_deposit',
                            'main_table_id' => $_POST['verifyid'],
                            'sub_table_name' => 'expenses',
                            'sub_table_id' => $key->id,
                            'suit_id' => $_POST['d_suit_id'],
                            'activities_id' => $key->activities_name,
                            'vendor_type' => $key->expense_type,
                            'vendor_id' => $key->vendor_id,
                            'vendor_name' => $key->vendor_name,
                            'amount' =>$key->amount,
                            'txrn_dt' => $key->activities_date,
                            'proposed_type' => $suit_data->proposed_type,
                            'loan_ac' => $suit_data->loan_ac,
                            'org_loan_ac' => $suit_data->org_loan_ac,
                            'ac_name' => $suit_data->ac_name,
                            'case_number' => $suit_data->case_number,
                            'req_type' => $suit_data->req_type,
                            'loan_segment' => $suit_data->loan_segment,
                            'region' => $suit_data->region,
                            'territory' => $suit_data->territory,
                            'district' => $suit_data->district,
                            'suit_id' => $_POST['d_suit_id'],
                        );
                        $data3=$this->user_model->cost_details($cost_data);
                    }
                }

                // $application_data = $this->db->query("SELECT s.loan_ac,c.e_by
                //     from appeal_deposit c
                //     LEFT OUTER JOIN suit_filling_info s on(s.id=c.suit_id)
                //     where c.id='".$_POST['verifyid']."'")->row();
                // $subject = "Appeal Money recovery from the  A/C-".$application_data->loan_ac;
                // $url = base_url()."appeal_bail_money/get_details_withdraw";
                // $data2 = $this->Common_model->push_notification_data($subject,$url,'appeal_deposit',$_POST['verifyid'],date('Y-m-d'),'',$application_data->e_by,'1');
                
				
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
	function withdraw_delete_action(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "appeal_deposit";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';
		
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('appeal_deposit_withdraw',$_POST['deleteEventId'],37,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts' => 37, 'stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('appeal_deposit_withdraw', $data);
				$get_row = $this->db->query('select * from appeal_deposit_withdraw where id='.$_POST['deleteEventId'])->row();
				$ad_id = explode(',',$get_row->appeal_id);

				$data = array('v_sts' => 37, 'stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'));
				foreach($ad_id as $key=>$val){
					$this->db->where('id', $val);
					$this->db->update('appeal_deposit', $data);
				}

				$exdata = array('v_sts' => 37,'stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'));
				$this->db->where(array('module_name'=>'appeal_bail','event_id'=> $_POST['deleteEventId'],'suit_id'=>$_POST['d_suit_id'],'sts !='=>0));
                $this->db->update('expenses', $exdata);
				
				$activities_id = 37;
				$description_activities = 'Appeal Bail Deposit Money withdraw Sendtochecker - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason ='';
			}
			
		}
		if($this->input->post('type')=='verify_return'){
            $pre_action_result=$this->Common_model->get_pre_action_data('appeal_deposit_withdraw',$_POST['verifyid'],'90,77,91','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
            	$data = array('v_sts' => 90, 'r_reason' => $_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('appeal_deposit_withdraw', $data);

				$get_row = $this->db->query('select * from appeal_deposit_withdraw where id='.$_POST['verifyid'])->row();
				$ad_id = explode(',',$get_row->appeal_id);

				$data = array('v_sts' => 90,'return_reason' => $_POST['return_reason_verify'],'return_by'=> $this->session->userdata['ast_user']['user_id'], 'return_dt'=>date('Y-m-d H:i:s'));
				foreach($ad_id as $key=>$val){
					$this->db->where('id', $val);
					$this->db->update('appeal_deposit', $data);
				}

				
            	$data = array('v_sts' => 90,'r_reason' => $_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'));
                $this->db->where(array('module_name'=>'appeal_bail','event_id'=> $_POST['verifyid'],'suit_id'=>$_POST['d_suit_id'],'sts !='=>0));
                $this->db->update('expenses', $data);

                $reason=$_POST['return_reason_verify'];
                $activities_id = 90;
				$description_activities = 'Appeal Bail Deposit Money withdraw return - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];

            }
            
        }
        if($this->input->post('type')=='verify_reject'){
            $pre_action_result=$this->Common_model->get_pre_action_data('appeal_deposit_withdraw',$_POST['verifyid'],'91,77','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
            	$data = array('v_sts' => 91, 'reject_reason' => $_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('appeal_deposit_withdraw', $data);

				$get_row = $this->db->query('select * from appeal_deposit_withdraw where id='.$_POST['verifyid'])->row();
				$ad_id = explode(',',$get_row->appeal_id);

				$data = array('v_sts' => 91,'reject_reason' => $_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
				foreach($ad_id as $key=>$val){
					$this->db->where('id', $val);
					$this->db->update('appeal_deposit', $data);
				}

                $data = array('v_sts' => 91,'reject_reason' => $_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
                $this->db->where(array('module_name'=>'appeal_bail','event_id'=> $_POST['verifyid'],'suit_id'=>$_POST['d_suit_id'],'sts !='=>0));
                $this->db->update('expenses', $data);

                $reason=$_POST['return_reason_verify'];

                $activities_id = 91;
				$description_activities = 'Appeal Bail Deposit Money withdraw reject - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];
                
            }
            
        }
		if($this->input->post('type')=='withdrawn'){
			$pre_action_result=$this->Common_model->get_pre_action_data('appeal_deposit_withdraw',$_POST['verifyid'],77,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{

				$data = array('w_by'=> $this->session->userdata['ast_user']['user_id'], 'w_dt'=>date('Y-m-d H:i:s'),'v_sts'=>77);

				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('appeal_deposit_withdraw', $data);
				$get_row = $this->db->query('select * from appeal_deposit_withdraw where id='.$_POST['verifyid'])->row();
				$ad_id = explode(',',$get_row->appeal_id);

				$data = array('app_by'=> $this->session->userdata['ast_user']['user_id'], 'app_dt'=>date('Y-m-d H:i:s'),'v_sts'=>77);
				foreach($ad_id as $key=>$val){
					$this->db->where('id', $val);
					$this->db->update('appeal_deposit', $data);
				}

				$activities_id = 77;
				$description_activities = 'Withdrawn Appeal Bail Deposit Money - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];

				$depo_row = $this->db->query('select appeal_bail_type,sum(deposit_percent) as deposit_percent from appeal_deposit where suit_id='.$_POST['d_suit_id'].' AND v_sts=77 AND sts<>0 AND life_cycle=2 GROUP BY suit_id')->row();
				if($depo_row->appeal_bail_type==1 && $depo_row->deposit_percent>49){
					$this->db->where('id', $_POST['d_suit_id']);
					$this->db->update('suit_filling_info', array('deposit_sts'=>1));
				}else if($depo_row->appeal_bail_type==2 && $depo_row->deposit_percent>24){
					$this->db->where('id', $_POST['d_suit_id']);
					$this->db->update('suit_filling_info', array('deposit_sts'=>1));
				}else if($depo_row->appeal_bail_type==3 && $depo_row->deposit_percent>9){
					$this->db->where('id', $_POST['d_suit_id']);
					$this->db->update('suit_filling_info', array('deposit_sts'=>1));
				}

				//Genereate Expenses
                $str="SELECT  j0.*
                         FROM expenses j0
                     WHERE j0.sts != '0'  AND j0.event_id= '".$_POST['verifyid']."' AND j0.module_name='appeal_bail'";   
                $expense_data=$this->db->query($str)->result();

                $sql="SELECT * FROM suit_filling_info WHERE id = '".$_POST['d_suit_id']."'";   
                $suit_data=$this->db->query($sql)->row();

                if (!empty($expense_data)) {
                        foreach ($expense_data as $key) {
                        	$main_tab = 'appeal_deposit_withdraw';
                        	$main_tab_id = $_POST['verifyid'];
                        	if($key->expense_type==5){
                        		$user_info = $this->db->query("SELECT * FROM users_info WHERE id=".$key->vendor_id."")->row();
                        		$main_tab = 'court_entertainment_data';
                        		$bill_month = explode('-',$key->activities_date);
                        		$enter_tab = array(
							    	'employee_type' =>1,
									'staff_pin' =>$user_info->pin,
									'staff_id' =>$key->vendor_id,
									'employee_name' =>$user_info->name,
									//'court_approval_file' =>$court_approval_file,
									//'job_grade' =>,
									'functional_desig' =>$user_info->functional_designation_id,
									'mobile_no' =>$user_info->mobile_number,
									'billing_month' =>$bill_month[1],
									//'account_number' =>,
									// 'legal_region' =>$user_info->region,
									// 'district' =>$user_info->district,
									'appeal_deposit_id' =>$_POST['verifyid'],
									//'base_office_name' =>

								);
                        		$enter_tab['e_by'] = $this->session->userdata['ast_user']['user_id'];
								$enter_tab['e_dt'] = date('Y-m-d H:i:s');
								$enter_tab['v_sts'] = 39;
								$this->db->insert('court_entertainment_data', $enter_tab);
                        		$main_tab_id = $this->db->insert_id();
                        	}
                            $cost_data = array(
                            'module_name' => 'suit_file',
                            'main_table_name' => $main_tab,
                            'main_table_id' => $main_tab_id,
                            'sub_table_name' => 'expenses',
                            'sub_table_id' => $key->id,
                            'suit_id' => $_POST['d_suit_id'],
                            'activities_id' => $key->activities_name,
                            'vendor_type' => $key->expense_type,
                            'vendor_id' => $key->vendor_id,
                            'vendor_name' => $key->vendor_name,
                            'amount' =>$key->amount,
                            'txrn_dt' => $key->activities_date,
                            'proposed_type' => $suit_data->proposed_type,
                            'loan_ac' => $suit_data->loan_ac,
                            'org_loan_ac' => $suit_data->org_loan_ac,
                            'ac_name' => $suit_data->ac_name,
                            'case_number' => $suit_data->case_number,
                            'req_type' => $suit_data->req_type,
                            'loan_segment' => $suit_data->loan_segment,
                            'region' => $suit_data->region,
                            'territory' => $suit_data->territory,
                            'district' => $suit_data->district,
                        );
                        $data3=$this->user_model->cost_details($cost_data);
                    }
                }

                $application_data = $this->db->query("SELECT s.loan_ac,c.e_by
                    from appeal_deposit_withdraw c
                    LEFT OUTER JOIN suit_filling_info s on(s.id=c.suit_id)
                    where c.id='".$_POST['verifyid']."'")->row();
                $subject = "Appeal Money recovery from the  A/C-".$application_data->loan_ac;
                $url = base_url()."appeal_bail_money/get_details_withdraw";
                $data2 = $this->Common_model->push_notification_data($subject,$url,'appeal_deposit_withdraw',$_POST['verifyid'],date('Y-m-d'),'',$application_data->e_by,'1');
                
				
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
	
	function select_where($table,$where,$select='*'){
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$data = $this->db->get()->result();
		return $data;
	}


	function get_case_info($id){

		$sql = 'SELECT *
					FROM suit_filling_info 
				WHERE id='.$this->db->escape($id).' AND sts<>0 AND deposit_sts<>1';
		$q=$this->db->query($sql);
		$result = $q->row();
		return $result;
	}
	function ni_pending_deposit($id){
		$sql = "SELECT s2.*,IF(b.percent_depo IS NULL,0,b.percent_depo) AS percent_depo,IF(b.unverify IS NULL,0,b.unverify) AS unverify,(s2.deposit_percent - IF(b.percent_depo IS NULL,0,b.percent_depo)) AS pending_perchent,a.name AS appeal_bail_type_name,a.id AS appeal_bail_type FROM
				(SELECT s1.*, IF(s1.case_name = 1,'50',IF(s1.case_name = 4, '25', '10')) AS deposit_percent FROM suit_filling_info AS s1 WHERE s1.sts <> 0 
				  AND (s1.suit_sts = 75 OR s1.suit_sts = 76) AND (((s1.case_name = 1 OR s1.case_name = 16) AND s1.req_type = 1 ) 
				    OR (s1.case_name IN (5, 6) AND s1.req_type = 2 AND s1.re_case_sts = 1 AND (s1.case_sts_prev_dt = 29  OR s1.final_remarks=2)) 
				    OR (s1.case_name = 4 AND s1.req_type = 2 AND (s1.case_sts_prev_dt = 29  OR s1.final_remarks=2))
				  ) AND s1.deposit_sts=0 ) AS s2
				LEFT JOIN (SELECT 
					SUM(IF(life_cycle =2,deposit_percent,0)) AS percent_depo,
					SUM(IF(life_cycle =1,1,0)) AS unverify, suit_id 
				      FROM appeal_deposit WHERE sts <> 0 GROUP BY suit_id) AS b ON b.suit_id = s2.id
				LEFT JOIN ref_appeal_bail_type AS a ON a.id = IF(s2.case_name = 1,1,IF(s2.case_name = 4, 2, 3)) WHERE s2.id=".$this->db->escape($id)."";
		$q=$this->db->query($sql);
		$result = $q->row();
		return $result;
	}
	
	function get_case_edit_info($id){
		$this->db->select('a.*,date_format(a.deposit_date,"%d/%m/%Y") as deposit_date,s.case_number,s.case_claim_amount,
			s.org_loan_ac,s.loan_ac,s.proposed_type,s.ac_name,s.region,s.req_type', FALSE)
			->from("appeal_deposit a")
			->join('expenses e', 'e.event_id=a.id AND e.module_name="appeal_bail"', 'left')
			->join('suit_filling_info s', 's.id=a.suit_id', 'left')
			//->join('cma c', 'c.id=s.cma_id', 'left')
			->where("a.id='".$id."'", NULL, FALSE)
			->limit(1);
		$q=$this->db->get();
		$result = $q->row();
		$this->db->select('e.*,et.name as expense_name,l.name as lawyer_name,d.name as district_name,
			ea.name as activities,
			date_format(e.activities_date,"%d/%m/%Y")as activities_date', FALSE)
			->from("expenses e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('ref_district d', 'd.id=e.district', 'left')
			->join('ref_expense_activities ea', 'ea.id=e.activities_name', 'left')
			->where("e.event_id='".$id."' AND e.sts=1 AND e.module_name='appeal_bail'", NULL, FALSE);
			$q=$this->db->get();
		$result->bill = $q->result();
		return $result;
	}
	function get_details_pending_apeal($id){
		$this->db->select('s.*,c.sl_no,c.brrower_name,n.name as case_n', FALSE)
			->from("suit_filling_info s")
			->join('cma c', 'c.id=s.cma_id', 'left')
			->join('ref_case_name n', 'n.id=s.case_name', 'left')
			->where(array('s.id'=>$id,'s.sts'=>1))
			->limit(1);
		$q=$this->db->get();
		$suit_row = $q->row();
		$html = '';
		$html.='<table style="width: 100%;" class="preview_table2" >
			<tr>
                <th width="20%" align="left"><strong>CMA Serial No</strong></th>
                <td width="30%" align="left">'.$suit_row->sl_no.'</td>
                 <th width="20%" align="left"><strong>Case Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->case_n.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->ac_name.'</td>
                <th width="20%" align="left"><strong>Case Number</strong></th>
                <td width="30%" align="left" >'.$suit_row->case_number.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account</strong></th>
                <td width="30%" align="left" >'.$suit_row->loan_ac.'</td>
                <th width="20%" align="left"><strong>Appeal Bail Type</strong></th>
                <td width="30%" align="left" ></td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Borrower Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->brrower_name.'</td>
                <th width="20%" align="left"><strong>Deposited Amount</strong></th>
                <td width="30%" align="left" ></td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Loan Type</strong></th>
                <td width="30%" align="left" >'.$suit_row->proposed_type.'</td>
                <th width="20%" align="left"><strong>Arrested</strong></th>
                <td width="30%" align="left" ></td>
            </tr> 
            <tr>
                <th width="20%" align="left"><strong>Withdraw Date</strong></th>
                <td width="30%" align="left" ></td>
                <th width="20%" align="left"><strong>Deposited Date</strong></th>
                <td width="30%" align="left" ></td>
            </tr>
            </table><br><br>';
        return $html;
	}
	function get_details($id){
		$this->db->select('a.*,c.sl_no,c.proposed_type,c.loan_ac,c.ac_name,c.legal_region,
    	n.name as case_n,s.case_number,c.brrower_name,date_format(a.deposit_date,"%d-%m-%Y") as deposit_date,date_format(a.withdraw_dt,"%d-%m-%Y") as withdraw_dt,t.name as appeal_bail_type', FALSE)
			->from("appeal_deposit a")
			->join('suit_filling_info s', 's.id=a.suit_id', 'left')
			->join('cma c', 'c.id=s.cma_id', 'left')
			->join('ref_case_name n', 'n.id=s.case_name', 'left')
			->join('ref_appeal_bail_type t', 't.id=a.appeal_bail_type', 'left')
			->where(array('a.id'=>$id,'a.sts'=>1))
			->limit(1);
		$q=$this->db->get();
		$suit_row = $q->row();

		$this->db->select('e.*,et.name as expense_name,l.name as lawyer_name,d.name as district_name,
			if(sf.req_type=1,ni.name,ara.name) as activities,
			date_format(e.activities_date,"%d/%m/%Y")as activities_date', FALSE)
			->from("expenses e")
			->join('suit_filling_info sf', 'sf.id=e.suit_id', 'left')
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('ref_district d', 'd.id=e.district', 'left')
			->join('ref_schedule_charges_ara ara', 'ara.id=e.activities_name and sf.req_type=2', 'left')
			->join('ref_schedule_charges_ni ni', 'ni.id=e.activities_name and sf.req_type<>2', 'left')
			//->join('ref_expense_activities ea', 'ea.id=e.activities_name', 'left')
			->where("e.event_id='".$id."' AND e.module_name='appeal_bail' AND e.sts=1", NULL, FALSE);
			$q=$this->db->get();
		$suit_row->bill = $q->result();


		$html = '';
		$html.='<table style="width: 100%;" class="preview_table2" >
			<tr>
                <th width="20%" align="left"><strong>CMA Serial No</strong></th>
                <td width="30%" align="left">'.$suit_row->sl_no.'</td>
                 <th width="20%" align="left"><strong>Case Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->case_n.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->ac_name.'</td>
                <th width="20%" align="left"><strong>Case Number</strong></th>
                <td width="30%" align="left" >'.$suit_row->case_number.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account</strong></th>
                <td width="30%" align="left" >'.$suit_row->loan_ac.'</td>
                <th width="20%" align="left"><strong>Appeal Bail Type</strong></th>
                <td width="30%" align="left" >'.$suit_row->appeal_bail_type.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Borrower Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->brrower_name.'</td>
                <th width="20%" align="left"><strong>Deposited Amount</strong></th>
                <td width="30%" align="left" >'.$suit_row->deposit_amt.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Loan Type</strong></th>
                <td width="30%" align="left" >'.$suit_row->proposed_type.'</td>
                <th width="20%" align="left"><strong>Arrested</strong></th>
                <td width="30%" align="left" >'.$suit_row->arrested.'</td>
            </tr> 
            <tr>
                <th width="20%" align="left"><strong>Withdraw Date</strong></th>
                <td width="30%" align="left" >'.$suit_row->withdraw_dt.'</td>
                <th width="20%" align="left"><strong>Deposited Date</strong></th>
                <td width="30%" align="left" >'.$suit_row->deposit_date.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Return Reason</strong></th>
                <td width="30%" align="left" >'.$suit_row->sfc_reason.'</td>
                <th width="20%" align="left"><strong></strong></th>
                <td width="30%" align="left" ></td>
            </tr>
            </table><br><br>';
            
        	if(count($suit_row->bill)>0){
        	$html .='<table style="width:100%;" class="preview_table2">
        		<tr style="background-color: #dfdfdf;">
        			<th colspan="6">Bill Info</th>
        		</tr>
        		<tr>
        			<th>Expense Type</th>
        			<th>Vendor Name</th>
        			<th>Activities Name</th>
        			<th>Activities Date</th>
        			<th>Total Amount</th>
        			<th>Remarks</th>
        		</tr>';
        		foreach($suit_row->bill as $torrow){
        		$html .= '<tr>
        			<td>'.$torrow->expense_name.'</td>
        			<td>'.$torrow->lawyer_name.'</td>
        			<td>'.$torrow->activities.'</td>
        			<td>'.$torrow->activities_date.'</td>
        			<td>'.$torrow->amount.'</td>
        			<td>'.$torrow->remarks.'</td>
        		</tr>';
        		}
        	$html .= '</table>';
        	}
		return $html;
	}

	function get_details_withdraw($id){
		$this->db->select('a.*,s.case_number,
			s.org_loan_ac,s.loan_ac,s.proposed_type,s.ac_name,s.region,s.req_type', FALSE)
			//->from("appeal_deposit a")
			->from("appeal_deposit_withdraw a")
			//->join('expenses e', 'e.event_id=a.id AND e.module_name="appeal_bail"', 'left')
			->join('suit_filling_info s', 's.id=a.suit_id', 'left')
			//->join('cma c', 'c.id=s.cma_id', 'left')
			->where("a.id='".$id."' AND a.sts<>0", NULL, FALSE)
			;
		$q=$this->db->get();
		$result = $q->row();
		if($result->req_type==2)
		{
			$join = "ref_schedule_charges_ara ara";
		}
		else
		{
			$join = "ref_schedule_charges_ni ara";
		}
		$this->db->select('e.*,et.name as expense_name,if(e.expense_type=5,u.name,l.name) as lawyer_name,d.name as district_name,
			ara.name as activities,
			date_format(e.activities_date,"%d/%m/%Y")as activities_date', FALSE)
			->from("expenses e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('users_info u', 'u.id=e.vendor_id', 'left')
			->join('ref_district d', 'd.id=e.district', 'left')
			->join($join, 'ara.id=e.activities_name', 'left')
			->where("e.event_id='".$id."' AND e.sts=1 AND e.module_name='appeal_bail'", NULL, FALSE);
			$q=$this->db->get();
		$result->bill = $q->result();
		$this->db->select('d.*,DATE_FORMAT(d.deposit_date,"%d-%m-%Y") AS deposit_dt,DATE_FORMAT(d.deposit_date,"%d/%m/%Y") AS depo_dt,DATE_FORMAT(d.withdraw_dt,"%d/%m/%Y") AS withdraw_dt,s.case_number,
			s.org_loan_ac,s.loan_ac,s.proposed_type,s.ac_name,s.region,s.req_type,s.prest_lawyer_name,t.name as appeal_bail_type_name', FALSE)
			->from("appeal_deposit d")
			->join('suit_filling_info s', 's.id=d.suit_id', 'left')
			->join('ref_appeal_bail_type t', 't.id=d.appeal_bail_type', 'left')
			->where("d.id IN (".$result->appeal_id.") AND d.sts<>0", NULL, FALSE);
			$r=$this->db->get();
		$result->appeal_deposit = $r->result();
		$suit_row=$result;

		$html = '';
		$html.='<table style="width: 100%;" class="preview_table2" >
			
            <tr>
                <th width="20%" align="left"><strong>Account Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->ac_name.'</td>
                <th width="20%" align="left"><strong>Case Number</strong></th>
                <td width="30%" align="left" >'.$suit_row->case_number.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account</strong></th>
                <td width="30%" align="left" >'.$suit_row->loan_ac.'</td>
                <th width="20%" align="left"><strong>Proposed Type</strong></th>
                <td width="30%" align="left" >'.$suit_row->proposed_type.'</td>
            </tr>
            
            </table><br><br>';
            $html .='<table style="width:100%;" class="preview_table2">
        		<tr style="background-color: #dfdfdf;">
        			<th colspan="7">Deposit Info</th>
        		</tr>
        		<tr>
        			<th>Withdraw Date</th>
        			<th>Type Name</th>
        			<th>Deposit Date</th>
        			<th>Deposit Amount</th>
        			<th>Percentage</th>
        			<th>Arrested</th>
        			<th>Scan File</th>
        		</tr>';
        	foreach($suit_row->appeal_deposit as $torrow){
        		$html .= '<tr>
        			<td>'.$torrow->withdraw_dt.'</td>
        			<td>'.$torrow->appeal_bail_type_name.'</td>
        			<td>'.$torrow->deposit_dt.'</td>
        			<td>'.$torrow->deposit_amt.'</td>
        			<td>'.$torrow->deposit_percent.'</td>
        			<td>'.$torrow->arrested.'</td>
        			<td>';
        			if($torrow->appeal_bail_scan_copy!=''){
        			$html .= '<img id="file_preview_wa_scan_copy" onclick="popup(\''.base_url().'cma_file/appeal_bail_scan_copy/'.$torrow->appeal_bail_scan_copy.'\')" style=" cursor:pointer;text-align:center" src="'.base_url().'old_assets/images/print-preview.png" height="18">';
        			}
        			$html .= '</td>
        		</tr>';
        		}
        	$html .= '</table><br><br>';
            
        	if(count($suit_row->bill)>0){
        	$html .='<table style="width:100%;" class="preview_table2">
        		<tr style="background-color: #dfdfdf;">
        			<th colspan="7">Bill Info</th>
        		</tr>
        		<tr>
        			<th>Expense Type</th>
        			<th>Vendor Name</th>
        			<th>Activities Name</th>
        			<th>Activities Date</th>
        			<th>Total Amount</th>
        			<th>Scan File</th>
        			<th>Remarks</th>
        		</tr>';
        		foreach($suit_row->bill as $torrow){
        		$html .= '<tr>
        			<td>'.$torrow->expense_name.'</td>
        			<td>'.$torrow->lawyer_name.'</td>
        			<td>'.$torrow->activities.'</td>
        			<td>'.$torrow->activities_date.'</td>
        			<td>'.$torrow->amount.'</td>
        			<td>';
        			if($torrow->appeal_bail_bill_copy!=''){
        			$html .='<img id="file_preview_wa_scan_copy" onclick="popup(\''.base_url().'cma_file/appeal_bail_bill_copy/'.$torrow->appeal_bail_bill_copy.'\')" style=" cursor:pointer;text-align:center" src="'.base_url().'old_assets/images/print-preview.png" height="18">';
        			}
        			$html .='</td>
        			<td>'.$torrow->remarks.'</td>
        		</tr>';
        		}
        	$html .= '</table>';
        	}
		return $html;
	}
	function get_details_withdraw_pending($id){
		$this->db->select('s.id,s.case_number,
			s.org_loan_ac,s.loan_ac,s.proposed_type,s.ac_name,s.region,s.req_type', FALSE)
			
			->from("suit_filling_info s")
			->where("s.id='".$id."' AND s.sts<>0", NULL, FALSE)
			;
		$q=$this->db->get();
		$result = $q->row();
		
		$this->db->select('d.*,DATE_FORMAT(d.deposit_date,"%d-%m-%Y") AS deposit_dt,DATE_FORMAT(d.deposit_date,"%d/%m/%Y") AS depo_dt,DATE_FORMAT(d.withdraw_dt,"%d/%m/%Y") AS withdraw_dt,s.case_number,
			s.org_loan_ac,s.loan_ac,s.proposed_type,s.ac_name,s.region,s.req_type,s.prest_lawyer_name,t.name as appeal_bail_type_name', FALSE)
			->from("appeal_deposit d")
			->join('suit_filling_info s', 's.id=d.suit_id', 'left')
			->join('ref_appeal_bail_type t', 't.id=d.appeal_bail_type', 'left')
			->where("d.suit_id=".$result->id." AND (d.withdraw_id IS NULL OR d.withdraw_id=0) AND d.life_cycle=2 AND d.v_sts <>77 AND d.sts<>0", NULL, FALSE);
			$r=$this->db->get();
		$result->appeal_deposit = $r->result();
		$suit_row=$result;

		$html = '';
		$html.='<table style="width: 100%;" class="preview_table2" >
			
            <tr>
                <th width="20%" align="left"><strong>Account Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->ac_name.'</td>
                <th width="20%" align="left"><strong>Case Number</strong></th>
                <td width="30%" align="left" >'.$suit_row->case_number.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account</strong></th>
                <td width="30%" align="left" >'.$suit_row->loan_ac.'</td>
                <th width="20%" align="left"><strong>Proposed Type</strong></th>
                <td width="30%" align="left" >'.$suit_row->proposed_type.'</td>
            </tr>
            
            </table><br><br>';
            $html .='<table style="width:100%;" class="preview_table2">
        		<tr style="background-color: #dfdfdf;">
        			<th colspan="7">Deposit Info</th>
        		</tr>
        		<tr>
        			<th>Withdraw Date</th>
        			<th>Type Name</th>
        			<th>Deposit Date</th>
        			<th>Deposit Amount</th>
        			<th>Percentage</th>
        			<th>Arrested</th>
        			<th>Scan File</th>
        		</tr>';
        	foreach($suit_row->appeal_deposit as $torrow){
        		$html .= '<tr>
        			<td>'.$torrow->withdraw_dt.'</td>
        			<td>'.$torrow->appeal_bail_type_name.'</td>
        			<td>'.$torrow->deposit_dt.'</td>
        			<td>'.$torrow->deposit_amt.'</td>
        			<td>'.$torrow->deposit_percent.'</td>
        			<td>'.$torrow->arrested.'</td>
        			<td>';
        			if($torrow->appeal_bail_scan_copy=''){
        			$html .= '<img id="file_preview_wa_scan_copy" onclick="popup(\''.base_url().'cma_file/appeal_bail_scan_copy/'.$torrow->appeal_bail_scan_copy.'\')" style=" cursor:pointer;text-align:center" src="'.base_url().'old_assets/images/print-preview.png" height="18">';
        			}
        			$html .= '</td>
        		</tr>';
        		}
        	$html .= '</table><br><br>';
            
		return $html;
	}

	function get_billing_details($id){
		$where2 = "e.sts=1 AND e.module_name='appeal_bail' AND e.id= ".$id;
		$this->db->select('e.*,a.deposit_amt,a.arrested ,c.sl_no,c.proposed_type, c.loan_ac,c.ac_name,n.name as case_n,f.case_number,DATE_FORMAT(a.deposit_date,"%d-%m-%Y") AS deposit_dt,DATE_FORMAT(a.deposit_date,"%d/%m/%Y") AS depo_dt,cd.memo_sts,et.name as expense_name,if(f.req_type=1,ni.name,ara.name) as activities,d.name as district_name,if(e.expense_type=1,l.name,u.name) as vendor_name
    		,DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS activities_date,if(cd.memo_sts=31,"Completed","Pending") as bill_sts', FALSE)
			->from("expenses e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('users_info u', 'u.id=e.vendor_id', 'left')
			->join('ref_district d', 'd.id=e.district', 'left')
			->join('cost_details cd', 'cd.sub_table_name="expenses" AND cd.sub_table_id=e.id', 'left')
			->join('appeal_deposit a', 'a.id=e.event_id', 'left')
			->join('suit_filling_info f', 'f.id=e.suit_id', 'left')
			->join('ref_schedule_charges_ara ara', 'ara.id=e.activities_name and f.req_type=2', 'left')
			->join('ref_schedule_charges_ni ni', 'ni.id=e.activities_name and f.req_type<>2', 'left')
			->join('ref_case_name n', 'n.id=f.case_name', 'left')
			->join('cma c', 'c.id=f.cma_id', 'left')
			->where($where2)
			->limit(1);
		$q=$this->db->get();
		$suit_row = $q->row();
		$html = '';
		$html.='<table style="width: 100%;" class="preview_table2" >
			<tr>
                <th width="20%" align="left"><strong>CMA Serial No</strong></th>
                <td width="30%" align="left">'.$suit_row->sl_no.'</td>
                 <th width="20%" align="left"><strong>Case Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->case_n.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account Name</strong></th>
                <td width="30%" align="left" >'.$suit_row->ac_name.'</td>
                <th width="20%" align="left"><strong>Case Number</strong></th>
                <td width="30%" align="left" >'.$suit_row->case_number.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account</strong></th>
                <td width="30%" align="left" >'.$suit_row->loan_ac.'</td>
                <th width="20%" align="left"><strong>Deposited Amount</strong></th>
                <td width="30%" align="left" >'.$suit_row->deposit_amt.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Loan Type</strong></th>
                <td width="30%" align="left" >'.$suit_row->proposed_type.'</td>
                <th width="20%" align="left"><strong>Deposited Date</strong></th>
                <td width="30%" align="left" >'.$suit_row->deposit_dt.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>Arrested</strong></th>
                <td width="30%" align="left" >'.$suit_row->arrested.'</td>
                <th width="20%" align="left"><strong></strong></th>
                <td width="30%" align="left" ></td>
            </tr>
            </table><br><br>';
            $html .='<table style="width:100%;" class="preview_table2">
        		<tr style="background-color: #dfdfdf;">
        			<th colspan="7">Bill Info</th>
        		</tr>
        		<tr>
        			<th>Expense Type</th>
        			<th>Vendor Name</th>
        			<th>Activities Name</th>
        			<th>Activities Date</th>
        			<th>Total Amount</th>
        			<th>Remarks</th>
        			<th>Payment</th>
        		</tr>';
        		$html .= '<tr>
        			<td>'.$suit_row->expense_name.'</td>
        			<td>'.$suit_row->vendor_name.'</td>
        			<td>'.$suit_row->activities.'</td>
        			<td>'.$suit_row->activities_date.'</td>
        			<td>'.$suit_row->amount.'</td>
        			<td>'.$suit_row->remarks.'</td>
        			<td>'.$suit_row->bill_sts.'</td>
        		</tr>';
        	$html .= '</table>';
		return $html;
	}

	function get_deposit_file_info($id){
		$this->db->select('a.*,date_format(a.deposit_date,"%d/%m/%Y") as deposit_date,s.case_number,
			s.org_loan_ac,s.loan_ac,s.proposed_type,s.ac_name,s.region,s.req_type,s.prest_lawyer_name,t.name as appeal_bail_type_name', FALSE)
			->from("appeal_deposit a")
			->join('suit_filling_info s', 's.id=a.suit_id', 'left')
			->join('ref_appeal_bail_type t', 't.id=a.appeal_bail_type', 'left')
			->where("a.suit_id='".$id."' AND (a.withdraw_id IS NULL OR a.withdraw_id=0) AND a.life_cycle=2 AND a.v_sts <>77 AND a.sts<>0", NULL, FALSE)
			;
		$q=$this->db->get();
		$result = $q->result();
		$html='';
		$html .='<table style="width: 100%;" class="preview_table2"><tr>
            <th><input type="checkbox" onclick="onlyOne(this)" name="ddd" id="parent"></th>
            <th>Account Name</th>
            <th>Account Number</th>
            <th>Loan Type</th>
            <th>Case Number</th>
            <th>Appeal Bail Type</th>
            <th>Deposited Amount</th>
            <th>Deposit Percent</th>
            <th>Deposited Date</th>
            <th>Arrested</th>
            </tr>';
        foreach($result as $key=>$val){
            $html.='<tr>
                <td><input type="checkbox" onclick="onlyOne(this)" class="child" name="check[]" id="check" value="'.$val->id.'"></td>
                <td>'.$val->ac_name.'</td>
                <td>'.$val->loan_ac.'</td>
                <td>'.$val->proposed_type.'</td>
                <td>'.$val->case_number.'</td>
                <td>'.$val->appeal_bail_type_name.'</td>
                <td>'.$val->deposit_amt.'</td>
                <td>'.$val->deposit_percent.'</td>
                <td>'.$val->deposit_date.'</td>
                <td>'.$val->arrested.'</td>
                </tr>';
        }
        $html .='</html>';
		return $html;
	}
	function get_deposit_file_edit_info($id){
		$this->db->select('a.*,s.case_number,
			s.org_loan_ac,s.loan_ac,s.proposed_type,s.ac_name,s.region,s.req_type,
			date_format(a.withdraw_date,"%d/%m/%Y")as withdraw_date', FALSE)
			//->from("appeal_deposit a")
			->from("appeal_deposit_withdraw a")
			//->join('expenses e', 'e.event_id=a.id AND e.module_name="appeal_bail"', 'left')
			->join('suit_filling_info s', 's.id=a.suit_id', 'left')
			//->join('cma c', 'c.id=s.cma_id', 'left')
			->where("a.id='".$id."' AND a.sts<>0", NULL, FALSE)
			;
		$q=$this->db->get();
		$result = $q->row();
		$this->db->select('e.*,et.name as expense_name,l.name as lawyer_name,d.name as district_name,
			ea.name as activities,
			date_format(e.activities_date,"%d/%m/%Y")as activities_date', FALSE)
			->from("expenses e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('ref_district d', 'd.id=e.district', 'left')
			->join('ref_expense_activities ea', 'ea.id=e.activities_name', 'left')
			->where("e.event_id='".$id."' AND e.sts=1 AND e.module_name='appeal_bail'", NULL, FALSE);
			$q=$this->db->get();
		$result->bill = $q->result();
		$this->db->select('d.*,DATE_FORMAT(d.deposit_date,"%d-%m-%Y") AS deposit_dt,DATE_FORMAT(d.deposit_date,"%d/%m/%Y") AS depo_dt,DATE_FORMAT(d.withdraw_dt,"%d/%m/%Y") AS withdraw_dt,s.case_number,
			s.org_loan_ac,s.loan_ac,s.proposed_type,s.ac_name,s.region,s.req_type,s.prest_lawyer_name,t.name as appeal_bail_type_name', FALSE)
			->from("appeal_deposit d")
			->join('suit_filling_info s', 's.id=d.suit_id', 'left')
			->join('ref_appeal_bail_type t', 't.id=d.appeal_bail_type', 'left')
			->where("d.id IN (".$result->appeal_id.") AND d.v_sts IN (90,35,39,38) AND d.life_cycle=2 AND d.sts<>0", NULL, FALSE);
			$r=$this->db->get();
		$result->appeal_deposit = $r->result();
		return $result;
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

    function withdraw_xl(){
    	$where2 = "a.sts=1 AND a.life_cycle=2 ";
    	if($this->input->post('case_number')!='') 
		{$where2.=" AND f.case_number = '".trim($this->input->post('case_number'))."'";}

		if($this->input->post('datefrom')!='') 
		{$where2.=" AND date_format(a.withdraw_dt,'%d/%m/%Y') >= '".$this->input->post('datefrom')."'";}
		if($this->input->post('dateto')!='') 
		{$where2.=" AND date_format(a.withdraw_dt,'%d/%m/%Y') <= '".$this->input->post('dateto')."'";}

		if($this->input->post('ac_name')!='' && !ctype_space($this->input->post('ac_name'))) 
		{$where2.=" AND f.ac_name = '".trim($this->input->post('ac_name'))."'";}
		if($this->input->post('account')!='' && $this->input->post('account')!=0) 
		{$where2.=" AND f.loan_ac = '".trim($this->input->post('account'))."'";}

		if($this->input->post('proposed_type')!='') 
		{$where2.=" AND f.proposed_type = '".trim($this->input->post('proposed_type'))."'";}
		if($this->input->post('account')!='') 
		{
			if($this->input->post('proposed_type')=='Card'){
				$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->post('hidden_loan_ac')));
				$where2.=" AND f.org_loan_ac = '".$card."'";
			}else{
				if($this->input->post('account')!='' && $this->input->post('account')!=0) 
				{$where2.=" AND f.loan_ac = '".trim($this->input->post('account'))."'";}
			}
		}
		//return $where2;
    	$this->db->select('a.*,c.loan_ac,c.ac_name,f.case_number,DATE_FORMAT(a.deposit_date,"%d-%m-%Y") AS deposit_dt,DATE_FORMAT(a.deposit_date,"%d/%m/%Y") AS depo_dt,DATE_FORMAT(a.withdraw_dt,"%d/%m/%Y") AS withdraw_dt,if(a.v_sts=77,s.name,"") as status_name,t.name as appeal_bail_type,f.proposed_type,f.org_loan_ac', FALSE)
			->from("appeal_deposit a")
			->join('suit_filling_info f', 'f.id=a.suit_id', 'left')
			->join('ref_appeal_bail_type t', 't.id=a.appeal_bail_type', 'left')
			->join('cma c', 'c.id=f.cma_id', 'left')
			->join('ref_status s', 's.id=a.v_sts', 'left')
			->where($where2);
		$q=$this->db->get();
		return $q->result_array();
    }


}