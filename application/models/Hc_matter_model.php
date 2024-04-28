<?php
class  Hc_matter_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
        $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}


	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "h.sts=1";

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

        		if($filterdatafield=='filing_date')
				{
					$filterdatafield = "DATE_FORMAT(h.filing_date,'%d-%m-%Y')";
				}	
				else if($filterdatafield=='last_act_date')
				{
					$filterdatafield = "DATE_FORMAT(h.last_act_date,'%d-%m-%Y')";
				}
				else if($filterdatafield=='case_sts_name')
				{
					$filterdatafield='cs.name';
				}
				else if($filterdatafield=='district_name')
				{
					$filterdatafield='d.name';
				}else if($filterdatafield=='hc_bench_name')
				{
					$filterdatafield='hb.name';
				}else if($filterdatafield=='assigned_lawyer_name')
				{
					$filterdatafield='al.name';
				}
				else if($filterdatafield=='ac_closing_status')
				{
					if(strtolower($filtervalue)=='yes'){
					$filtervalue=1;}
					else if(strtolower($filtervalue)=='no'){
					$filtervalue=2;}
				}
				else
				{
					$filterdatafield='h.'.$filterdatafield;
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
		// if($where=='' || count($where)<=0){			
		// 	//$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		// }
		
		if ($sortorder == '')
		{
			$sortdatafield="h.id";
			$sortorder = "DESC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS h.*,if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,bn.name as bench_number,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,
    		DATE_FORMAT(h.filing_date,"%d-%m-%Y") AS filing_date,
    		DATE_FORMAT(h.file_receive_date,"%d-%m-%Y") AS file_receive_date,sts.name as status,div.name as division_name,cat.name as case_category_name
    		', FALSE)
			->from("hc_matter h")
			->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
			->join('ref_loan_segment ls', 'ls.id=h.portfolio', 'left')
			->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
			->join('ref_hc_division div', 'div.id=h.hc_division', 'left')
			->join('ref_hc_case_category cat', 'cat.id=h.case_category', 'left')
			->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
			->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
			->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
			->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
			->join('ref_status sts', 'sts.id=h.v_sts', 'left')
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

	function hc_expencese_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "e.sts=1 ";

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

        		if($filterdatafield=='filing_date')
				{
					$filterdatafield = "DATE_FORMAT(h.filing_date,'%d-%m-%Y')";
				}	
				else if($filterdatafield=='last_act_date')
				{
					$filterdatafield = "DATE_FORMAT(h.last_act_date,'%d-%m-%Y')";
				}
				else if($filterdatafield=='case_sts_name')
				{
					$filterdatafield='cs.name';
				}
				else if($filterdatafield=='district_name')
				{
					$filterdatafield='d.name';
				}else if($filterdatafield=='hc_bench_name')
				{
					$filterdatafield='hb.name';
				}else if($filterdatafield=='assigned_lawyer_name')
				{
					$filterdatafield='al.name';
				}
				else if($filterdatafield=='ac_closing_status')
				{
					if(strtolower($filtervalue)=='yes'){
					$filtervalue=1;}
					else if(strtolower($filtervalue)=='no'){
					$filtervalue=2;}
				}
				else
				{
					$filterdatafield='h.'.$filterdatafield;
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
    	$this->db->select('SQL_CALC_FOUND_ROWS h.*,h.id as hc_id,e.id as ex_id,e.v_sts,e.batch_no,if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,bn.name as bench_number,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,div.name as division_name,
    		DATE_FORMAT(h.filing_date,"%d-%m-%Y") AS filing_date,
    		DATE_FORMAT(h.file_receive_date,"%d-%m-%Y") AS file_receive_date,et.name as expense_name,
    		a.name as act_name, p.name as paper_name, l.name as lname,e.batch_no,vs.name as status_name
    		', FALSE)
			->from("expenses  e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_paper_vendor p', 'p.id=e.vendor_id', 'left')
			->join('ref_hc_activities a', 'a.id=e.activities_name', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('hc_matter h', 'h.id=e.event_id', 'left')
			->join('ref_hc_division div', 'div.id=h.hc_division', 'left')
			->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
			->join('ref_loan_segment ls', 'ls.id=h.portfolio', 'left')
			->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
			->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
			->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
			->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
			->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
			->join('ref_status vs', 'vs.id=e.v_sts', 'left')
			->where($where2)
			->where($where)
			->group_by('e.batch_no')
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
		/*echo '<pre>';
		print_r($result);
		echo '</pre>';*/
		return $result;

	}

	function ad_expencese_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "e.sts=1 AND e.module_name='AD Matter'";

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

        		if($filterdatafield=='filing_date')
				{
					$filterdatafield = "DATE_FORMAT(h.filing_date,'%d-%m-%Y')";
				}	
				else if($filterdatafield=='last_act_date')
				{
					$filterdatafield = "DATE_FORMAT(h.last_act_date,'%d-%m-%Y')";
				}
				else if($filterdatafield=='case_sts_name')
				{
					$filterdatafield='cs.name';
				}
				else if($filterdatafield=='district_name')
				{
					$filterdatafield='d.name';
				}else if($filterdatafield=='hc_bench_name')
				{
					$filterdatafield='hb.name';
				}else if($filterdatafield=='assigned_lawyer_name')
				{
					$filterdatafield='al.name';
				}
				else if($filterdatafield=='ac_closing_status')
				{
					if(strtolower($filtervalue)=='yes'){
					$filtervalue=1;}
					else if(strtolower($filtervalue)=='no'){
					$filtervalue=2;}
				}
				else
				{
					$filterdatafield='h.'.$filterdatafield;
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
    	$this->db->select('SQL_CALC_FOUND_ROWS h.*,h.id as hc_id,e.id as ex_id,e.v_sts,e.batch_no,if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,bn.name as bench_number,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,
    		DATE_FORMAT(h.filing_date,"%d-%m-%Y") AS filing_date,
    		DATE_FORMAT(h.file_receive_date,"%d-%m-%Y") AS file_receive_date,et.name as expense_name,
    		a.name as act_name, p.name as paper_name, l.name as lname,vs.name as status_name
    		', FALSE)
			->from("expenses  e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_paper_vendor p', 'p.id=e.vendor_id', 'left')
			->join('ref_hc_activities a', 'a.id=e.activities_name', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('hc_matter_ad h', 'h.id=e.event_id', 'left')
			->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
			->join('ref_loan_segment ls', 'ls.id=h.portfolio', 'left')
			->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
			->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
			->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
			->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
			->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
			->join('ref_status vs', 'vs.id=e.v_sts', 'left')
			->where($where2)
			->where($where)
			->group_by('e.batch_no')
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
		/*echo '<pre>';
		print_r($result);
		echo '</pre>';*/
		return $result;

	}
	function case_status_update_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "h.sts=1 AND h.v_sts=38";

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

        		if($filterdatafield=='filing_date')
				{
					$filterdatafield = "DATE_FORMAT(h.filing_date,'%d-%m-%Y')";
				}	
				else if($filterdatafield=='last_act_date')
				{
					$filterdatafield = "DATE_FORMAT(h.last_act_date,'%d-%m-%Y')";
				}
				else if($filterdatafield=='case_sts_name')
				{
					$filterdatafield='cs.name';
				}
				else if($filterdatafield=='district_name')
				{
					$filterdatafield='d.name';
				}else if($filterdatafield=='hc_bench_name')
				{
					$filterdatafield='hb.name';
				}else if($filterdatafield=='assigned_lawyer_name')
				{
					$filterdatafield='al.name';
				}
				else if($filterdatafield=='ac_closing_status')
				{
					if(strtolower($filtervalue)=='yes'){
					$filtervalue=1;}
					else if(strtolower($filtervalue)=='no'){
					$filtervalue=2;}
				}
				else
				{
					$filterdatafield='h.'.$filterdatafield;
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
		//if($where=='' || count($where)<=0){			
			//$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		//}
		
		if ($sortorder == '')
		{
			$sortdatafield="h.id";
			$sortorder = "DESC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS h.*,if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,bn.name as bench_number,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,his.id as history_id,
    		DATE_FORMAT(h.filing_date,"%d-%m-%Y") AS filing_date,
    		DATE_FORMAT(h.file_receive_date,"%d-%m-%Y") AS file_receive_date,sts.name as status,div.name as division_name
    		', FALSE)
			->from("hc_matter h")
			->join('ref_hc_division div', 'div.id=h.hc_division', 'left')
			->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
			->join('ref_loan_segment ls', 'ls.id=h.portfolio', 'left')
			->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
			->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
			->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
			->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
			->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
			->join('ref_status sts', 'sts.id=h.verify', 'left')
			->join('hc_matter_hst his', 'his.hc_matter_id=h.id AND his.v_sts IN (35,39,37,90) AND his.sts=1', 'left')
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
	function ad_case_file_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "h.sts=1";

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

        		if($filterdatafield=='filing_date')
				{
					$filterdatafield = "DATE_FORMAT(h.filing_date,'%d-%m-%Y')";
				}	
				else if($filterdatafield=='last_act_date')
				{
					$filterdatafield = "DATE_FORMAT(h.last_act_date,'%d-%m-%Y')";
				}
				else if($filterdatafield=='case_sts_name')
				{
					$filterdatafield='cs.name';
				}
				else if($filterdatafield=='district_name')
				{
					$filterdatafield='d.name';
				}else if($filterdatafield=='hc_bench_name')
				{
					$filterdatafield='hb.name';
				}else if($filterdatafield=='assigned_lawyer_name')
				{
					$filterdatafield='al.name';
				}
				else if($filterdatafield=='ac_closing_status')
				{
					if(strtolower($filtervalue)=='yes'){
					$filtervalue=1;}
					else if(strtolower($filtervalue)=='no'){
					$filtervalue=2;}
				}
				else
				{
					$filterdatafield='h.'.$filterdatafield;
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
		//if($where=='' || count($where)<=0){			
			//$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		//}
		
		if ($sortorder == '')
		{
			$sortdatafield="h.id";
			$sortorder = "DESC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS h.*,if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,bn.name as bench_number,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,
    		DATE_FORMAT(h.filing_date,"%d-%m-%Y") AS filing_date,
    		DATE_FORMAT(h.file_receive_date,"%d-%m-%Y") AS file_receive_date,DATE_FORMAT(h.next_date,"%d-%m-%Y") AS next_date,ns.name as next_status_name,cat.name as case_category_name,sts.name as status
    		', FALSE)
			->from("hc_matter_ad h")
			->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
			->join('ref_loan_segment ls', 'ls.id=h.portfolio', 'left')
			->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
			->join('ref_hc_case_status ns', 'ns.id=h.next_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
			->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
			->join('ref_hc_case_category cat', 'cat.id=h.case_category', 'left')
			->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
			->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
			->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
			->join('ref_status sts', 'sts.id=h.v_sts', 'left')
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
	function ad_case_status_update_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "h.sts=1 AND h.v_sts=38";

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

        		if($filterdatafield=='filing_date')
				{
					$filterdatafield = "DATE_FORMAT(h.filing_date,'%d-%m-%Y')";
				}	
				else if($filterdatafield=='last_act_date')
				{
					$filterdatafield = "DATE_FORMAT(h.last_act_date,'%d-%m-%Y')";
				}
				else if($filterdatafield=='case_sts_name')
				{
					$filterdatafield='cs.name';
				}
				else if($filterdatafield=='district_name')
				{
					$filterdatafield='d.name';
				}else if($filterdatafield=='hc_bench_name')
				{
					$filterdatafield='hb.name';
				}else if($filterdatafield=='assigned_lawyer_name')
				{
					$filterdatafield='al.name';
				}
				else if($filterdatafield=='ac_closing_status')
				{
					if(strtolower($filtervalue)=='yes'){
					$filtervalue=1;}
					else if(strtolower($filtervalue)=='no'){
					$filtervalue=2;}
				}
				else
				{
					$filterdatafield='h.'.$filterdatafield;
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
			$sortdatafield="h.id";
			$sortorder = "DESC";				
		}
		//DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,
    	$this->db->select('SQL_CALC_FOUND_ROWS h.*,if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,bn.name as bench_number,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,his.id as history_id,
    		DATE_FORMAT(h.filing_date,"%d-%m-%Y") AS filing_date,
    		DATE_FORMAT(h.file_receive_date,"%d-%m-%Y") AS file_receive_date,
    		DATE_FORMAT(h.next_date,"%d-%m-%Y") AS next_date,ns.name as next_status_name,cat.name as case_category_name,sts.name as status
    		', FALSE)
			->from("hc_matter_ad h")
			->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
			->join('ref_loan_segment ls', 'ls.id=h.portfolio', 'left')
			->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
			->join('ref_hc_case_status ns', 'ns.id=h.next_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
			->join('ref_hc_case_category cat', 'cat.id=h.case_category', 'left')
			->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
			->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
			->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
			->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
			->join('ref_status sts', 'sts.id=h.verify', 'left')
			->join('hc_matter_hst_ad his', 'his.hc_matter_id=h.id AND his.v_sts IN (35,39,37,90) AND his.sts=1', 'left')
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
    	$this->db->select('SQL_CALC_FOUND_ROWS e.*,a.deposit_amt,a.arrested ,c.loan_ac,c.ac_name,f.case_number,DATE_FORMAT(a.deposit_date,"%d-%m-%Y") AS deposit_dt,DATE_FORMAT(a.deposit_date,"%d/%m/%Y") AS depo_dt,cd.memo_sts,et.name as expense_name,ea.name as activities,d.name as district_name,if(e.expense_type=1,l.name,u.name) as vendor_name
    		,DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS activities_date,if(cd.memo_sts=31,"Completed","Pending") as bill_sts', FALSE)
			->from("expenses e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('users_info u', 'u.id=e.vendor_id', 'left')
			->join('ref_legal_district d', 'd.id=e.district', 'left')
			->join('ref_expense_activities ea', 'ea.id=e.activities_name', 'left')
			->join('cost_details cd', 'cd.sub_table_id=e.id AND cd.sub_table_name="expenses"', 'left')
			->join('appeal_deposit a', 'a.id=e.event_id', 'left')
			->join('suit_filling_info f', 'f.id=a.suit_id', 'left')
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
		if($this->input->get('case_number')!='' && $this->input->get('case_number')!=0) 
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
	
    function add_edit_action($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
	{

		$this->db->trans_begin();
        if($editrow==""){$editrow=0;}
	    $table_name = "hc_matter";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";
	    
	    $this->form_validation->set_rules('loan_ac', 'loan_ac', 'trim|xss_clean|min_length[16]|max_length[16]');
	    $this->form_validation->set_rules('proposed_type', 'proposed_type', 'trim|xss_clean');
	    $this->form_validation->set_rules('hidden_loan_ac', 'hidden_loan_ac', 'trim|xss_clean');
	    $this->form_validation->set_rules('req_type', 'req_type', 'trim|xss_clean');
	    $this->form_validation->set_rules('region', 'region', 'trim|xss_clean');
	    //$this->form_validation->set_rules('territory', 'territory', 'trim|xss_clean');
	    $this->form_validation->set_rules('district', 'district', 'trim|xss_clean');
	    $this->form_validation->set_rules('hc_type', 'hc_type', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('account_name', 'account_name', 'trim|xss_clean');
	    $this->form_validation->set_rules('hc_dealing_officer', 'hc_dealing_officer', 'trim|xss_clean');
	    $this->form_validation->set_rules('portfolio', 'portfolio', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('lower_dealing_officer', 'lower_dealing_officer', 'trim|xss_clean');
	    $this->form_validation->set_rules('hc_division', 'hc_division', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('case_category', 'case_category', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('case_type', 'case_type', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('deposited_appeal_money', 'deposited_appeal_money', 'trim|xss_clean');
	    $this->form_validation->set_rules('case_no', 'case_no', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('file_receive_date', 'file_receive_date', 'trim|xss_clean');
	    $this->form_validation->set_rules('case_claim', 'case_claim', 'trim|xss_clean');
	    //$this->form_validation->set_rules('assigned_lawyer', 'assigned_lawyer', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('filing_date', 'filing_date', 'trim|xss_clean');
	    $this->form_validation->set_rules('name_dist', 'name_dist', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('present_status', 'present_status', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('last_activities', 'last_activities', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('present_casue_action', 'present_casue_action', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('hc_bench', 'hc_bench', 'trim|required|xss_clean');
	    //$this->form_validation->set_rules('bench_number', 'bench_number', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('remarks', 'remarks', 'trim|xss_clean');
	    $this->form_validation->set_rules('withdrawn_date', 'withdrawn_date', 'trim|xss_clean');
	    $this->form_validation->set_rules('ac_closing_status', 'ac_closing_status', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('next_status', 'next_status', 'trim|xss_clean');
	    $this->form_validation->set_rules('next_date', 'next_date', 'trim|xss_clean');
	    $this->form_validation->set_rules('year', 'year', 'trim|xss_clean');

	    if($this->input->post('present_status')==3){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('lcr_memo_no', 'lcr_memo_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('memo_date', 'memo_date', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_no', 'gp_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_date', 'gp_date', 'trim|required|xss_clean');
	    }elseif($this->input->post('present_status')==4){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
	    	if($this->input->post('status')==1){
	    		$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
	    	}
	    }elseif($this->input->post('present_status')==8||$this->input->post('present_status')==19){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    }elseif($this->input->post('present_status')==11){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('court_name', 'court_name', 'trim|required|xss_clean');
	    	if($this->input->post('status')==1){
	    		$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
	    	}
	    }elseif($this->input->post('present_status')==12){
	    	$this->form_validation->set_rules('lcr_memo_no', 'lcr_memo_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('memo_date', 'memo_date', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_no', 'gp_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_date', 'gp_date', 'trim|required|xss_clean');
	    }elseif($this->input->post('present_status')==13){
	    	$this->form_validation->set_rules('wp_amount', 'wp_amount', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('withdrawn_date', 'withdrawn_date', 'trim|required|xss_clean');
	    }elseif($this->input->post('present_status')==18){
	    	$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
	    }else{
	    	if($this->input->post('present_status')>19){
	    		$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	}else{
	    		$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
		    	if($this->input->post('status')==1){
		    		$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
		    	}
	    	}
	    	
	    }

	    if ($this->form_validation->run() == TRUE){
	    $filing_date = $this->input->post('filing_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('filing_date')))):'';
	    $withdrawn_date = $this->input->post('withdrawn_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('withdrawn_date')))):'';
	    $file_receive_date = $this->input->post('file_receive_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('file_receive_date')))):'';
	    
	    $expenses = array(
			'hc_matter_type' =>$this->security->xss_clean( $this->input->post('hc_type')),
			'proposed_type' =>$this->security->xss_clean( $this->input->post('proposed_type')),
			'ac_number' =>$this->security->xss_clean( $this->input->post('loan_ac')),
			'ac_name' =>$this->security->xss_clean( $this->input->post('account_name')),
			'portfolio' =>$this->security->xss_clean( $this->input->post('portfolio')),
			'hc_division' =>$this->security->xss_clean( $this->input->post('hc_division')),
			'case_category' =>$this->security->xss_clean( $this->input->post('case_category')),
			'case_type' =>$this->security->xss_clean( $this->input->post('case_type')),
			'case_no' =>$this->security->xss_clean( $this->input->post('case_no')),
			'case_claim' =>$this->security->xss_clean( $this->input->post('case_claim')),
			'name_dist' =>$this->security->xss_clean( $this->input->post('name_dist')),
			'present_status' =>$this->security->xss_clean( $this->input->post('present_status')),
			'next_status' =>$this->security->xss_clean( $this->input->post('next_status')),
			'next_dt_sts' =>$this->security->xss_clean( $this->input->post('next_dt_sts_value')),
			'last_act' =>$this->security->xss_clean( $this->input->post('last_activities')),
			'present_cause_action' =>$this->security->xss_clean( $this->input->post('present_casue_action')),
			'hc_bench' =>$this->security->xss_clean( $this->input->post('hc_bench')),
			//'bench_number' =>$this->security->xss_clean( $this->input->post('bench_number')),
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),
			'ac_closing_status' =>$this->security->xss_clean( $this->input->post('ac_closing_status')),
			'hc_dealing_officer' =>$this->security->xss_clean( $this->input->post('hc_dealing_officer')),
			'lower_dealing_officer' =>$this->security->xss_clean( $this->input->post('lower_dealing_officer')),
			'deposit_am_50' =>$this->security->xss_clean( $this->input->post('deposited_appeal_money')),
		);
		if($this->input->post('year')!=''){
			$expenses['next_date'] =$this->security->xss_clean( $this->input->post('year'));
		}
		if ($_POST['next_dt_sts_value']==1) {
            $expenses['next_date'] =implode('-',array_reverse(explode('/',$this->input->post('next_date'))));
        }
        else
        {
            $sys_config= $this->User_info_model->upr_config_row();
            $expenses['next_date'] = $sys_config->next_dt_text;
        }
		if($filing_date!=''){
			$expenses['filing_date']=$filing_date;
		}
		if($file_receive_date!=''){
			$expenses['file_receive_date']=$file_receive_date;
		}
	    if($this->input->post('proposed_type')=='Card'){
	    	$expenses['org_ac_number']=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->post('hidden_loan_ac')));
	    }
	    if($this->input->post('req_type')!=''){
	    	$expenses['req_type']=$this->security->xss_clean( $this->input->post('req_type'));
	    }
	    if($this->input->post('region')!=''){
	    	$expenses['region']=$this->security->xss_clean( $this->input->post('region'));
	    }
	    if($this->input->post('territory')!=''){
	    	$expenses['territory']=$this->security->xss_clean( $this->input->post('territory'));
	    }
	    if($this->input->post('district')!=''){
	    	$expenses['district']=$this->security->xss_clean( $this->input->post('district'));
	    }

	    $status_data = array();
	    if($this->input->post('present_status')==3){
	    	$memo_date = $this->input->post('memo_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('memo_date')))):'';
	    	$gp_date = $this->input->post('gp_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('gp_date')))):'';
	    	$status_data['sts_3_type']=$this->security->xss_clean( $this->input->post('status'));
	    	$status_data['sts_3_memo_no']=$this->security->xss_clean( $this->input->post('lcr_memo_no'));
	    	$status_data['sts_3_memo_dt']=$this->input->post('memo_date');
	    	$status_data['sts_3_gp_no']=$this->security->xss_clean( $this->input->post('gp_no'));
	    	$status_data['sts_3_gp_dt']=$this->input->post('gp_date');
	    	
	    }elseif($this->input->post('present_status')==4){
	    	$status_data['sts_4_type']=$this->security->xss_clean( $this->input->post('status'));
	    	$status_data['sts_4_name']=$this->security->xss_clean( $this->input->post('name'));
	    	if($this->input->post('status')==1){ 
	    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
	    		$status_data['sts_4_date']=$this->input->post('sts_date');
	    	}
	    }elseif($this->input->post('present_status')==8){
	    	$status_data['sts_8_type']=$this->security->xss_clean( $this->input->post('status'));
	    }elseif($this->input->post('present_status')==19){
	    	$status_data['sts_19_type']=$this->security->xss_clean( $this->input->post('status'));
	    }elseif($this->input->post('present_status')==11){
	    	$status_data['sts_11_type']=$this->security->xss_clean( $this->input->post('status'));
	    	$status_data['sts_11_cname']=$this->security->xss_clean( $this->input->post('court_name'));
	    	if($this->input->post('status')==1){
	    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
	    		$status_data['sts_11_date']=$this->input->post('sts_date');
	    	}
	    }elseif($this->input->post('present_status')==12){
	    	$memo_date = $this->input->post('memo_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('memo_date')))):'';
	    	$gp_date = $this->input->post('gp_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('gp_date')))):'';
	    	$status_data['sts_12_memo_no']=$this->security->xss_clean( $this->input->post('lcr_memo_no'));
	    	$status_data['sts_12_memo_dt']=$this->input->post('memo_date');
	    	$status_data['sts_12_gp_no']=$this->security->xss_clean( $this->input->post('gp_no'));
	    	$status_data['sts_12_gp_dt']=$this->input->post('gp_date');
	    }elseif($this->input->post('present_status')==13){
	    	$withdrawn_date = $this->input->post('withdrawn_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('withdrawn_date')))):'';
	    	$status_data['sts_13_amount']=$this->security->xss_clean( $this->input->post('wp_amount'));
	    	$status_data['sts_13_date']=$this->input->post('withdrawn_date');
	    }elseif($this->input->post('present_status')==18){
	    	$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
	    	$status_data['sts_18_date']=$this->input->post('sts_date');
	    }else{
	    	if($this->input->post('present_status')>19){
	    		$status_data['sts_type']=$this->security->xss_clean( $this->input->post('status'));
		    	if($this->input->post('status')==1){
		    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
		    		//$status_data['sts_date']=$this->input->post('sts_date');
		    		$status_data['sts_date']=date('d/m/Y');
		    	}
	    	}else{
		    	$status_data['sts_'.$this->input->post('present_status').'_type']=$this->security->xss_clean( $this->input->post('status'));
		    	if($this->input->post('status')==1){
		    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
		    		$status_data['sts_'.$this->input->post('present_status').'_date']=$this->input->post('sts_date');
		    	}
	    	}
	    }

	    /*print_r($status_data);
	    echo json_encode($status_data,true);
	    exit;*/
	    $history_add = array(
		    		'present_status'=>$this->input->post('present_status'),
		    		'last_act'=>$this->input->post('last_activities'),
		    		'hc_bench'=>$this->input->post('hc_bench'),
		    		'bench_number'=>$this->input->post('bench_number'),
		    		//'hc_lawyer'=>$this->input->post('assigned_lawyer'),
		    		'remarks'=>$this->input->post('remarks'),
		    		'data_field'=>json_encode($status_data,true),
		    		'next_status' =>$this->security->xss_clean( $this->input->post('next_status')),
					'next_dt_sts' =>$this->security->xss_clean( $this->input->post('next_dt_sts_value')),
		    );
	    if ($_POST['next_dt_sts_value']==1) {
            $history_add['next_date'] =implode('-',(explode('/',$this->input->post('next_date'))));
        }
        else
        {
            $sys_config= $this->User_info_model->upr_config_row();
            $history_add['next_date'] = $sys_config->next_dt_text;
        }
	    $his_id_expense = '';
		if($add_edit=="add")
		{
			$history_add['e_by']=$this->session->userdata['ast_user']['user_id'];
			$history_add['e_dt']=date('Y-m-d H:i:s');
			// new case update status change
			$history_add['v_sts']=39;

			$expenses['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['e_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 39;
			$expenses['verify'] = 39;
			if($this->input->post('suit_id')!=''){
			$expenses['suit_id'] =$this->input->post('suit_id');
			}
			$this->db->insert('hc_matter', $expenses);
			$insert_idss = $this->db->insert_id();
			$history_add['hc_matter_id']=$insert_idss;
			$this->db->insert('hc_matter_hst', $history_add);
			$his_id_expense=$this->db->insert_id();
			/*$status_data['last_entry_by']=$this->session->userdata['ast_user']['user_id'];
			$status_data['last_entry_dt']=date('Y-m-d H:i:s');
			$status_data['hc_matter_id']=$insert_idss;
			$this->db->insert('hc_matter_status', $status_data);*/
		    $activities_id = 39;
		    $description_activities = 'Add HC Matter - ('.$insert_idss.')';
		}
		else
		{
			$history_add['u_by']=$this->session->userdata['ast_user']['user_id'];
			$history_add['u_dt']=date('Y-m-d H:i:s');
			// new case update status change
			$history_add['v_sts']=35;

	  		$expenses['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['u_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 35;
			$expenses['verify'] = 35;
			$this->db->where('id', $edit_id);
			$this->db->update('hc_matter', $expenses);
			$this->db->where('id', $this->input->post('hc_id'));
			$this->db->update('hc_matter_hst', $history_add);
			$his_id_expense=$this->input->post('hc_id');
			/*$status_data['last_entry_by']=$this->session->userdata['ast_user']['user_id'];
			$status_data['last_entry_dt']=date('Y-m-d H:i:s');
			$this->db->where('hc_matter_id', $edit_id);
			$this->db->update('hc_matter_status', $status_data);*/
	  		$insert_idss = $edit_id;

	        $activities_id = 35;
	        $description_activities = 'Edit HC Matter - ('.$insert_idss.')';

		}
		
		// Expenses 
		$sql = "SELECT * from hc_matter where id=$insert_idss AND sts=1";
	    $res = $this->db->query($sql);
	    $hc_matter = $res->row();
	    $module = '';
	    if($this->input->post('hc_division')==1){
	    	$module = 'HC Matter';
	    }else if($this->input->post('hc_division')==2){
	    	$module = 'AD Matter';
	    }
	    //print_r($hc_matter);exit;
		for($i=1;$i<= $_POST['expense_counter'];$i++)
        {
        	$bill_copy = $this->get_file_name('bill_copy_'.$i,'cma_file/bill_copy/');
            $expense_data = array(
            'event_id' => $his_id_expense,
            'suit_id' => $insert_idss,
            'module_name' =>$module,
            'expense_type' =>$this->security->xss_clean( $this->input->post('expense_type_'.$i)),
            'activities_name' => $this->security->xss_clean( $this->input->post('activities_name_'.$i)),
            'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
            'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
            'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
            'vendor_name' => $this->security->xss_clean( $this->input->post('vendor_name_'.$i)),
            'vendor_id' => $this->security->xss_clean( $this->input->post('vendor_id_'.$i)),
            );
            
            $expense_data['appeal_bail_bill_copy']=$bill_copy;
            
            if(isset($_POST['add_expense'])){
            // For skip The new deleted row
            if ($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==1) 
            {
                continue;
            }
            //For Delete the old row
            if ($_POST['expense_edit_'.$i]!=0 && $_POST['expense_delete_'.$i]==1) 
            {
            	$activities_id=15;
                $expense_data = array('sts' => 0,'v_sts'=>15);
                $expense_data['d_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['d_dt']=date('Y-m-d H:i:s');
                $this->db->where("id='".$_POST['expense_edit_'.$i]."'AND batch_no IS NULL");
                $this->db->update('expenses', $expense_data);
            }
            //For update the old row
            else if($_POST['expense_edit_'.$i]!=0 && $_POST['expense_delete_'.$i]!=1)
            {
            	$activities_id=35;
            	$expense_data['v_sts']=35;
            	$expense_data['u_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['u_dt']=date('Y-m-d H:i:s');
                $this->db->where("id='".$_POST['expense_edit_'.$i]."'AND batch_no IS NULL");
                $this->db->update('expenses', $expense_data);
            }
            //For insert the new row
            else if($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==0)
            {
            	$activities_id=39;
            	$expense_data['v_sts']=39;
            	$expense_data['event_id']=$his_id_expense;
            	$expense_data['suit_id']=$insert_idss;
            	$expense_data['proposed_type']=$hc_matter->proposed_type;
            	$expense_data['org_loan_ac']=$hc_matter->org_ac_number;
            	$expense_data['account_number']=$hc_matter->ac_number;
            	$expense_data['ac_name']=$hc_matter->ac_name;
            	$expense_data['req_type']=$hc_matter->req_type;
            	$expense_data['case_number']=$hc_matter->case_no;
            	$expense_data['e_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['e_dt']=date('Y-m-d H:i:s');
            	/*if($this->input->post('add_edit')=='edit'){
            		$expense_data['batch_no']=$this->input->post('batch_no');
            	}else{
            		$expense_data['batch_no']=time().$this->session->userdata['ast_user']['user_id'];
            	}*/
                $this->db->insert('expenses', $expense_data);
            }
        	}else{
        		if($add_edit=="edit"){
        			if ($_POST['expense_edit_'.$i]!=0) 
		            {
		            	$activities_id=15;
		                $expense_data = array('sts' => 0,'v_sts'=>15);
		                $expense_data['d_by']=$this->session->userdata['ast_user']['user_id'];
		            	$expense_data['d_dt']=date('Y-m-d H:i:s');
		                $this->db->where("id='".$_POST['expense_edit_'.$i]."'AND batch_no IS NULL");
		                $this->db->update('expenses', $expense_data);
		            }
        		}
        	}
            
        }

        // end expeses

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities($activities_id,'HC Matter',$insert_idss,$table_name,$description_activities);
			// echo $insert_idss;
			// exit;
			return $insert_idss;
		}
		}else{
			return validation_errors();
		}


	}

	function expenceses_action($add_edit=NULL,$edit_id=NULL,$editrow=NULL){

		$this->db->trans_begin();
        if($editrow==""){$editrow=0;}
	    $table_name = "";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";
	    $insert_idss=$this->input->post('hc_id');
	    $module_name=$this->security->xss_clean( $this->input->post('module'));
	    /*if($module_name=='AD Matter'){
	    	$table_name = "hc_matter_ad";
	    }else{
	    	$table_name = "hc_matter";
	    }*/
	    $table_name = "hc_matter";
	    $sql = "SELECT * from hc_matter where id=".$this->db->escape($this->input->post('hc_id'))." AND sts=1";
	    $res = $this->db->query($sql);
	    $hc_matter = $res->row();
	    //print_r($hc_matter);exit;
		for($i=1;$i<= $_POST['expense_counter'];$i++)
        {
        	$bill_copy = $this->get_file_name('bill_copy_'.$i,'cma_file/bill_copy/');
            $expense_data = array(
            'event_id' => $this->security->xss_clean( $this->input->post('hc_id')),
            'module_name' =>$module_name,
            'district' =>$this->security->xss_clean( $this->input->post('district_'.$i)),
            'expense_type' =>$this->security->xss_clean( $this->input->post('expense_type_'.$i)),
            'activities_name' => $this->security->xss_clean( $this->input->post('activities_name_'.$i)),
            'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
            'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
            'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
            'vendor_name' => $this->security->xss_clean( $this->input->post('vendor_name_'.$i)),
            'vendor_id' => $this->security->xss_clean( $this->input->post('vendor_id_'.$i)),

            
            );
            $expense_data['appeal_bail_bill_copy']=$bill_copy;
            // For skip The new deleted row
            if ($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==1) 
            {
                continue;
            }
            //For Delete the old row
            if ($_POST['expense_edit_'.$i]!=0 && $_POST['expense_delete_'.$i]==1) 
            {
            	$activities_id=15;
                $expense_data = array('sts' => 0,'v_sts'=>15);
                $expense_data['d_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['d_dt']=date('Y-m-d H:i:s');
                $this->db->where(array('id'=>$_POST['expense_edit_'.$i],'batch_no'=>$this->input->post('batch_no')));
                $this->db->update('expenses', $expense_data);
            }
            //For update the old row
            else if($_POST['expense_edit_'.$i]!=0 && $_POST['expense_delete_'.$i]!=1)
            {
            	$activities_id=35;
            	$expense_data['v_sts']=35;
            	$expense_data['u_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['u_dt']=date('Y-m-d H:i:s');
                $this->db->where(array('id'=>$_POST['expense_edit_'.$i],'batch_no'=>$this->input->post('batch_no')));
                $this->db->update('expenses', $expense_data);
            }
            //For insert the new row
            else if($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==0)
            {
            	$activities_id=39;
            	$expense_data['v_sts']=39;
            	$expense_data['suit_id']=$hc_matter->suit_id;
            	$expense_data['proposed_type']=$hc_matter->proposed_type;
            	$expense_data['org_loan_ac']=$hc_matter->org_ac_number;
            	$expense_data['account_number']=$hc_matter->ac_number;
            	$expense_data['ac_name']=$hc_matter->ac_name;
            	$expense_data['req_type']=$hc_matter->req_type;
            	$expense_data['case_number']=$hc_matter->case_no;
            	$expense_data['e_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['e_dt']=date('Y-m-d H:i:s');
            	if($this->input->post('add_edit')=='edit'){
            		$expense_data['batch_no']=$this->input->post('batch_no');
            	}else{
            		$expense_data['batch_no']=time().$this->session->userdata['ast_user']['user_id'];
            	}
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
      		$this->User_model->user_activities_bill($activities_id,'',$insert_idss,$table_name,$description_activities);
			// echo $insert_idss;
			// exit;
			return $insert_idss;
		}
	}

	
	function add_edit_case_status_update($add_edit,$edit_row=null){
		$this->db->trans_begin();
        $editrow=0;
	    $table_name = "hc_matter";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";
	    
	    $this->form_validation->set_rules('hc_id', 'hc_id', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('disposal_sts', 'disposal_sts', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('hc_matter_id', 'hc_matter_id', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('case_sts', 'case_sts', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('last_act', 'last_act', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('hc_bench', 'hc_bench', 'trim|required|xss_clean');
	    //$this->form_validation->set_rules('bench_number', 'bench_number', 'trim|required|xss_clean');
	    //$this->form_validation->set_rules('hc_lawyer', 'hc_lawyer', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('previous_date', 'previous_date', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('remarks', 'remarks', 'trim|xss_clean');

	    $this->form_validation->set_rules('pre_case_sts', 'pre_case_sts', 'trim|xss_clean');
	    $this->form_validation->set_rules('pre_last_act', 'pre_last_act', 'trim|xss_clean');
	    $this->form_validation->set_rules('pre_hc_bench', 'pre_hc_bench', 'trim|xss_clean');
	    //$this->form_validation->set_rules('pre_bench_number', 'pre_bench_number', 'trim|xss_clean');
	    $this->form_validation->set_rules('pre_previous_date', 'pre_previous_date', 'trim|xss_clean');
	    //$this->form_validation->set_rules('pre_hc_lawyer', 'pre_hc_lawyer', 'trim|xss_clean');
	    $this->form_validation->set_rules('pre_remarks', 'pre_remarks', 'trim|xss_clean');

	    if($this->input->post('case_sts')==3){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('lcr_memo_no', 'lcr_memo_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('memo_date', 'memo_date', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_no', 'gp_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_date', 'gp_date', 'trim|required|xss_clean');
	    }elseif($this->input->post('case_sts')==4){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
	    	if($this->input->post('status')==1){
	    		$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
	    	}
	    }elseif($this->input->post('case_sts')==8||$this->input->post('case_sts')==19){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    }elseif($this->input->post('case_sts')==11){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('court_name', 'court_name', 'trim|required|xss_clean');
	    	if($this->input->post('status')==1){
	    		$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
	    	}
	    }elseif($this->input->post('case_sts')==12){
	    	$this->form_validation->set_rules('lcr_memo_no', 'lcr_memo_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('memo_date', 'memo_date', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_no', 'gp_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_date', 'gp_date', 'trim|required|xss_clean');
	    }elseif($this->input->post('case_sts')==13){
	    	$this->form_validation->set_rules('wp_amount', 'wp_amount', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('withdrawn_date', 'withdrawn_date', 'trim|required|xss_clean');
	    }elseif($this->input->post('case_sts')==18){
	    	$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
	    }else{
	    	if($this->input->post('case_sts')>19){
	    		$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	}else{
	    		$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
		    	if($this->input->post('status')==1){
		    		$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
		    	}
	    	}
	    	
	    }
	    
	    if ($this->form_validation->run() == TRUE){
	    	
			
	    //$last_act_date = $this->input->post('last_act_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('last_act_date')))):'';
	    //$pre_last_act_date = $this->input->post('pre_last_act_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('pre_last_act_date')))):'';

	    $hc_matter = $hc_present=array();

	    $previous_date = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('previous_date'))));

	    $hc_present = array(
			'present_status' =>$this->security->xss_clean( $this->input->post('case_sts')),
			'last_act' =>$this->security->xss_clean( $this->input->post('last_act')),
			'hc_bench' =>$this->security->xss_clean( $this->input->post('hc_bench')),
			//'bench_number' =>$this->security->xss_clean( $this->input->post('bench_number')),
			'final_sts' =>$this->security->xss_clean( $this->input->post('disposal_sts')),
			'previous_date' =>$previous_date,
			//'hc_lawyer' =>$this->security->xss_clean( $this->input->post('hc_lawyer')),
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),
			'next_status' =>$this->security->xss_clean( $this->input->post('next_status')),
			'next_dt_sts' =>$this->security->xss_clean( $this->input->post('next_dt_sts_value')),
		);
	    //$hc_present = array();
	    
		

		$status_data = array();
	    if($this->input->post('case_sts')==3){
	    	$memo_date = $this->input->post('memo_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('memo_date')))):'';
	    	$gp_date = $this->input->post('gp_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('gp_date')))):'';
	    	$status_data['sts_3_type']=$this->security->xss_clean( $this->input->post('status'));
	    	$status_data['sts_3_memo_no']=$this->security->xss_clean( $this->input->post('lcr_memo_no'));
	    	$status_data['sts_3_memo_dt']=$this->input->post('memo_date');
	    	$status_data['sts_3_gp_no']=$this->security->xss_clean( $this->input->post('gp_no'));
	    	$status_data['sts_3_gp_dt']=$this->input->post('gp_date');
	    	
	    }elseif($this->input->post('case_sts')==4){
	    	$status_data['sts_4_type']=$this->security->xss_clean( $this->input->post('status'));
	    	$status_data['sts_4_name']=$this->security->xss_clean( $this->input->post('name'));
	    	if($this->input->post('status')==1){
	    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
	    		$status_data['sts_4_date']=$this->input->post('sts_date');
	    	}
	    }elseif($this->input->post('case_sts')==8){
	    	$status_data['sts_8_type']=$this->security->xss_clean( $this->input->post('status'));
	    }elseif($this->input->post('case_sts')==19){
	    	$status_data['sts_19_type']=$this->security->xss_clean( $this->input->post('status'));
	    }elseif($this->input->post('case_sts')==11){
	    	$status_data['sts_11_type']=$this->security->xss_clean( $this->input->post('status'));
	    	$status_data['sts_11_cname']=$this->security->xss_clean( $this->input->post('court_name'));
	    	if($this->input->post('status')==1){
	    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
	    		$status_data['sts_11_date']=$this->input->post('sts_date');
	    	}
	    }elseif($this->input->post('case_sts')==12){
	    	$memo_date = $this->input->post('memo_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('memo_date')))):'';
	    	$gp_date = $this->input->post('gp_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('gp_date')))):'';
	    	$status_data['sts_12_memo_no']=$this->security->xss_clean( $this->input->post('lcr_memo_no'));
	    	$status_data['sts_12_memo_dt']=$this->input->post('memo_date');
	    	$status_data['sts_12_gp_no']=$this->security->xss_clean( $this->input->post('gp_no'));
	    	$status_data['sts_12_gp_dt']=$this->input->post('gp_date');
	    }elseif($this->input->post('case_sts')==13){
	    	$withdrawn_date = $this->input->post('withdrawn_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('withdrawn_date')))):'';
	    	$status_data['sts_13_amount']=$this->security->xss_clean( $this->input->post('wp_amount'));
	    	$status_data['sts_13_date']=$this->input->post('withdrawn_date');
	    }elseif($this->input->post('case_sts')==18){
	    	$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
	    	$status_data['sts_18_date']=$this->input->post('sts_date');
	    }else{
	    	if($this->input->post('case_sts')>19){
	    		$status_data['sts_type']=$this->security->xss_clean( $this->input->post('status'));
		    	if($this->input->post('status')==1){
		    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
		    		//$status_data['sts_date']=$this->input->post('sts_date');
		    		$status_data['sts_date']=date('d/m/Y');
		    	}
	    	}else{
		    	$status_data['sts_'.$this->input->post('case_sts').'_type']=$this->security->xss_clean( $this->input->post('status'));
		    	if($this->input->post('status')==1){
		    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
		    		$status_data['sts_'.$this->input->post('case_sts').'_date']=$this->input->post('sts_date');
		    	}
		    }
	    }
	    $his_id_expense='';
	    if($this->input->post('disposal_sts')==2){
	    	$file_upload = $this->get_file_name('file_upload','cma_file/hc_ad_file/');
	    	if($file_upload!=''){
	    		$hc_present['files']=$file_upload;
	    	}
	    }

	    if ($_POST['next_dt_sts_value']==1) {
            $hc_present['next_date'] =implode('-',array_reverse(explode('/',$this->input->post('next_date'))));
        }
        else
        {
            $sys_config= $this->User_info_model->upr_config_row();
            $hc_present['next_date'] = $sys_config->next_dt_text;
        }
		if($this->input->post('add_edit')=="add")
		{
			$this->db->select('*');
			$this->db->from('hc_matter_hst');
			$this->db->where(array('id'=>$this->input->post('hc_id'),'hc_matter_id'=>$this->input->post('hc_matter_id'),'v_sts'=>38,'sts'=>1));
			$this->db->order_by('id','DESC');
			$this->db->limit(1);
			$data = $this->db->get()->row();

			$hc_present['present_status_old'] =$data->present_status;
			$hc_present['last_act_old'] =$data->last_act;
			$hc_present['hc_bench_old'] =$data->hc_bench;
			$hc_present['bench_number_old'] =$data->bench_number;
			$hc_present['previous_date_old'] =$data->previous_date;
			//$hc_present['hc_lawyer_old'] =$data->hc_lawyer;
			$hc_present['remarks_old'] =$data->remarks;
			$hc_present['data_field_old'] =$data->data_field;
				
			$hc_present['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$hc_present['e_dt'] = date('Y-m-d H:i:s');
			// case update status change
			$hc_present['v_sts'] = 39;
			$hc_present['data_field'] = json_encode($status_data,true);
			$hc_present['hc_matter_id']=$this->input->post('hc_matter_id');
			$this->db->insert('hc_matter_hst', $hc_present);
			$his_id_expense=$this->db->insert_id();
			// case update status change
			$hc_matter['verify'] = 39;
			$this->db->where('id', $this->input->post('hc_matter_id'));
			$this->db->update('hc_matter', $hc_matter);
	  		$insert_idss = $this->input->post('hc_matter_id');

			/*$status_data['last_entry_by']=$this->session->userdata['ast_user']['user_id'];
			$status_data['last_entry_dt']=date('Y-m-d H:i:s');
			$this->db->where('hc_matter_id', $this->input->post('hc_matter_id'));
			$this->db->update('hc_matter_status', $status_data); */

		    $activities_id = 39;
		    $description_activities = 'HC Case Status Update HC Matter - ('.$insert_idss.')';
		}
		else
		{
			//print_r($hc_present);
	  		$hc_present['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$hc_present['u_dt'] = date('Y-m-d H:i:s');
			// case update status change
			$hc_present['v_sts'] = 35;
			$hc_present['data_field'] = json_encode($status_data,true);
			$this->db->where(array('id'=>$this->input->post('hc_id'),'hc_matter_id'=>$this->input->post('hc_matter_id'),'sts'=>1));
			$this->db->update('hc_matter_hst', $hc_present);
			$his_id_expense=$this->input->post('hc_id');
			$hc_matter['verify'] = 35;
			$this->db->where('id', $this->input->post('hc_matter_id'));
			$this->db->update('hc_matter', $hc_matter);
	  		//$insert_idss = $this->input->post('hc_matter_id');

	  		/*$status_data['last_entry_by']=$this->session->userdata['ast_user']['user_id'];
			$status_data['last_entry_dt']=date('Y-m-d H:i:s');
			$this->db->where('hc_matter_id', $this->input->post('hc_matter_id'));
			$this->db->update('hc_matter_status', $status_data);*/
			$insert_idss = $this->input->post('hc_matter_id');
	        $activities_id = 35;
	        $description_activities = 'Edit Case Status Update HC Matter - ('.$insert_idss.')';

		}
		

		// Expenses 
		$sql = "SELECT * from hc_matter where id=$insert_idss AND sts=1";
	    $res = $this->db->query($sql);
	    $hc_matter = $res->row();
	    //print_r($hc_matter);exit;
		for($i=1;$i<= $_POST['expense_counter'];$i++)
        {
        	$bill_copy = $this->get_file_name('bill_copy_'.$i,'cma_file/bill_copy/');
            $expense_data = array(
            'event_id' => $his_id_expense,
            'suit_id' => $insert_idss,
            'module_name' =>'HC Matter',
            'expense_type' =>$this->security->xss_clean( $this->input->post('expense_type_'.$i)),
            'activities_name' => $this->security->xss_clean( $this->input->post('activities_name_'.$i)),
            'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
            'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
            'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
            'vendor_name' => $this->security->xss_clean( $this->input->post('vendor_name_'.$i)),
            'vendor_id' => $this->security->xss_clean( $this->input->post('vendor_id_'.$i)),
            );
            $expense_data['appeal_bail_bill_copy']=$bill_copy;
            if(isset($_POST['add_expense'])){
            // For skip The new deleted row
            if ($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==1) 
            {
                continue;
            }
            //For Delete the old row
            if ($_POST['expense_edit_'.$i]!=0 && $_POST['expense_delete_'.$i]==1) 
            {
            	$activities_id=15;
                $expense_data = array('sts' => 0,'v_sts'=>15);
                $expense_data['d_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['d_dt']=date('Y-m-d H:i:s');
                $this->db->where("id='".$_POST['expense_edit_'.$i]."'AND batch_no IS NULL");
                $this->db->update('expenses', $expense_data);
            }
            //For update the old row
            else if($_POST['expense_edit_'.$i]!=0 && $_POST['expense_delete_'.$i]!=1)
            {
            	$activities_id=35;
            	$expense_data['v_sts']=35;
            	$expense_data['u_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['u_dt']=date('Y-m-d H:i:s');
                $this->db->where("id='".$_POST['expense_edit_'.$i]."'AND batch_no IS NULL");
                $this->db->update('expenses', $expense_data);
            }
            //For insert the new row
            else if($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==0)
            {
            	$activities_id=39;
            	$expense_data['v_sts']=39;
            	$expense_data['event_id']=$his_id_expense;
            	$expense_data['suit_id']=$insert_idss;
            	$expense_data['proposed_type']=$hc_matter->proposed_type;
            	$expense_data['org_loan_ac']=$hc_matter->org_ac_number;
            	$expense_data['account_number']=$hc_matter->ac_number;
            	$expense_data['ac_name']=$hc_matter->ac_name;
            	$expense_data['req_type']=$hc_matter->req_type;
            	$expense_data['case_number']=$hc_matter->case_no;
            	$expense_data['e_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['e_dt']=date('Y-m-d H:i:s');
            	/*if($this->input->post('add_edit')=='edit'){
            		$expense_data['batch_no']=$this->input->post('batch_no');
            	}else{
            		$expense_data['batch_no']=time().$this->session->userdata['ast_user']['user_id'];
            	}*/
                $this->db->insert('expenses', $expense_data);
            }
        	}else{
        		if($add_edit=="edit"){
        			if ($_POST['expense_edit_'.$i]!=0) 
		            {
		            	$activities_id=15;
		                $expense_data = array('sts' => 0,'v_sts'=>15);
		                $expense_data['d_by']=$this->session->userdata['ast_user']['user_id'];
		            	$expense_data['d_dt']=date('Y-m-d H:i:s');
		                $this->db->where("id='".$_POST['expense_edit_'.$i]."'AND batch_no IS NULL");
		                $this->db->update('expenses', $expense_data);
		            }
        		}
        	}
            
        }

        // end expeses

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities($activities_id,'HC Matter',$insert_idss,$table_name,$description_activities);
			// echo $insert_idss;
			// exit;
			return $insert_idss;
		}
		
		}else{
			return validation_errors();
		}

	}


	function delete_action(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "hc_matter";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';
		$this->db->select('*');
		$this->db->from('hc_matter_hst');
		$this->db->where(array('hc_matter_id'=>$_POST['verifyid'],'sts'=>1));
		$this->db->limit(1);
		$this->db->order_by('id','DESC');
		$data_res = $this->db->get()->row();

		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('hc_matter',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('hc_matter', $data);
				$activities_id = 15;
				$description_activities = 'Delete HC Matter - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason =trim($_POST['comments']);

				// Expense
				
				$hc_id_expense = $_POST['deleteEventId']; // suit_id for expese
				
				$data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$where = "suit_id=".$hc_id_expense." AND module_name='HC Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
			}
			
		}
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('hc_matter',$_POST['verifyid'],37,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts'=>37,'s_by'=> $this->session->userdata['ast_user']['user_id'], 's_dt'=>date('Y-m-d H:i:s'),'verify'=>37);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('hc_matter', $data);

				$data = array('s_by'=> $this->session->userdata['ast_user']['user_id'], 's_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
				$this->db->where("hc_matter_id=".$_POST['verifyid']." AND v_sts IN (35,39)");
				$this->db->update('hc_matter_hst', $data);

				$activities_id = 37;
				$description_activities = 'Send to Checker HC Matter - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];

				// Expense
				
				$his_id_expense= $data_res->id;
				$hc_id_expense = $_POST['verifyid']; // suit_id for expese
				
				$data = array('stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
				$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='HC Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
				
			}
		}
		if($this->input->post('type')=='verify_return'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_matter',$_POST['verifyid'],'90,38,91','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
            	$data = array('r_reason'=>$_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'),'v_sts'=>90,'verify'=>90);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('hc_matter', $data);

				$data = array('r_reason'=>$_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'),'v_sts'=>90);
				$this->db->where(array('hc_matter_id'=>$_POST['verifyid'],'v_sts'=>37));
				$this->db->update('hc_matter_hst', $data);

				$his_id_expense= $data_res->id; // event_id
				$hc_id_expense = $_POST['verifyid']; // suit_id

            	$data = array('r_reason'=>$_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'),'v_sts'=>90);

				$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='HC Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
                
                $reason=$_POST['return_reason_verify'];
                $activities_id = 90;
				$description_activities = 'Return HC Matter Expence- ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];

            }
            
        }
        if($this->input->post('type')=='verify_reject'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_matter',$_POST['verifyid'],'91,38','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {

            	$data = array('reject_reason'=>$_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'),'v_sts'=>91,'verify'=>91);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('hc_matter', $data);

				$data = array('reject_reason'=>$_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'),'v_sts'=>91);
				$this->db->where(array('hc_matter_id'=>$_POST['verifyid'],'v_sts'=>37));
				$this->db->update('hc_matter_hst', $data);

				$his_id_expense= $data_res->id; // event_id
				$hc_id_expense = $_POST['verifyid']; // suit_id

            	$data = array('reject_reason'=>$_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'),'v_sts'=>91);
            	$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='HC Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
                
                $reason=$_POST['return_reason_verify'];
                $activities_id = 91;
				$description_activities = 'Reject HC Matter Expence- ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];
                
            }
            
        }
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('hc_matter',$_POST['verifyid'],38,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				
				$obj = json_decode($data_res->data_field);
				$status_data=array();
				foreach($obj as $key => $val){
					// Check Date Data
					if (preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $val, $matches)) {
    					if (checkdate($matches[2], $matches[1], $matches[3])) {
						$status_data[$key]=date('Y-m-d',strtotime(str_replace('/', '-',$val)));
						}else{
							$status_data[$key]=$val;
						}
					}else{
						$status_data[$key]=$val;
					}
				}

				$status_data['last_entry_by']=$this->session->userdata['ast_user']['user_id'];
				$status_data['last_entry_dt']=date('Y-m-d H:i:s');
				$this->db->select('*');
				$this->db->from('hc_matter_status');
				$this->db->where(array('hc_matter_id'=>$_POST['verifyid']));
				$exit_row = $this->db->get()->result();
				if(count($exit_row)>0){
					$this->db->where('id', $exit_row[0]->id);
					$this->db->update('hc_matter_status', $status_data);
				}else{
					$status_data['hc_matter_id']=$_POST['verifyid'];
					$this->db->insert('hc_matter_status', $status_data);
				}

				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38,'verify'=>38);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('hc_matter', $data);

				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
				$this->db->where(array('hc_matter_id'=>$_POST['verifyid'],'v_sts'=>37));
				$this->db->update('hc_matter_hst', $data);

				$activities_id = 38;
				$description_activities = 'Verify HC Matter - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];



				// Expense
				$his_id_expense= $data_res->id;
				$hc_id_expense = $_POST['verifyid']; // suit_id for expese
				
				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
				$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='HC Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);

				//Genereate Expenses
                $str="SELECT  j0.*,h.proposed_type,h.ac_number,h.org_ac_number,h.ac_name,h.case_no,h.case_type,h.portfolio,h.region,h.territory,h.district
                        FROM expenses j0
                        LEFT JOIN hc_matter as h
						ON h.id = j0.suit_id
                     WHERE j0.sts != '0'  AND j0.event_id= '".$his_id_expense."' AND j0.suit_id='".$hc_id_expense."' AND j0.module_name='HC Matter'";   
                $expense_data=$this->db->query($str)->result();
                //echo $this->db->last_query();
                //print_r($expense_data);
                if (!empty($expense_data)) {
                        foreach ($expense_data as $key) {
                        	if($key->proposed_type=='Loan' && $key->ac_number!='' && $key->ac_number!=NULL)
							{
								if(strlen($key->ac_number)==16)
								{
									$cif = substr($key->ac_number,5,8);
								}
								else if(strlen($key->ac_number)==13)
								{
									$cif = substr($key->ac_number,1,8);
								}
								else
								{
									$cif = "";
								}
							}
							else
							{
								$cif = "";
							}
                            $cost_data = array(
                            'module_name' => 'high_court',
                            'main_table_name' => 'hc_matter_hst',
                            'main_table_id' => $key->event_id,
                            'sub_table_name' => 'expenses',
                            'sub_table_id' => $key->id,
                            'suit_id' => $key->suit_id,
                            'activities_id' => $key->activities_name,
                            'vendor_type' => $key->expense_type,
                            'vendor_id' => $key->vendor_id,
                            'vendor_name' => $key->vendor_name,
                            'amount' =>$key->amount,
                            'txrn_dt' => $key->activities_date,
                            'proposed_type' => $key->proposed_type,
                            'loan_ac' => $key->ac_number,
                            'cif' => $cif,
                            'org_loan_ac' => $key->org_ac_number,
                            'ac_name' => $key->ac_name,
                            'case_number' => $key->case_no,
                            'req_type' => $key->case_type,
                            'loan_segment' => $key->portfolio,
                            'region' => $key->region,
                            'territory' => $key->territory,
                            'district' => $key->district,
                            'expense_remarks' =>$key->remarks
                        );
                            //print_r($cost_data);
                        $data3=$this->user_model->cost_details($cost_data);

                    }
                    $activities_id = 38;
					$description_activities_expense = 'Verify HC Matter Expence- ('.$data_res->id.')';
					$this->User_model->user_activities_bill($activities_id,'expenses',$data_res->id,'hc_matter_hst',$description_activities_expense,$reason);
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
			$this->User_model->user_activities($activities_id,'HC Matter',$row_id,$table_name,$description_activities,$reason);

			$this->db->trans_commit();

			$this->db->db_debug = $db_debug;
			return $row_id;
		}
	}

	function status_delete_action(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "hc_matter";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';

		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_hst',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('hc_matter_hst', $data);

				$data = array('verify'=>38);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('hc_matter', $data);

				$activities_id = 15;
				$description_activities = 'Delete Case Status Update HC Matter - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason =trim($_POST['comments']);

				// Expense
				
				$his_id_expense = $_POST['deleteEventId']; // suit_id for expese
				
				$data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$where = "event_id=".$his_id_expense." AND module_name='HC Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
			}
			
		}
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_hst',$_POST['verifyid'],37,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('verify'=>37);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('hc_matter', $data);

				$data = array('s_by'=> $this->session->userdata['ast_user']['user_id'], 's_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
				$this->db->where("id=".$_POST['verifyid']." AND v_sts IN (35,39)");
				$this->db->update('hc_matter_hst', $data);

				$activities_id = 37;
				$description_activities = 'Send to Checker Case Status Update HC Matter - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];

				// Expense
				
				$his_id_expense= $_POST['verifyid'];
				$hc_id_expense = $_POST['deleteEventId']; // suit_id for expese
				
				$data = array('stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
				$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='HC Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
				
			}
		}

		if($this->input->post('type')=='verify_return'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_hst',$_POST['verifyid'],'90,38,91','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
            	$data = array('verify'=>90);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('hc_matter', $data);

				$data = array('r_reason'=>$_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'),'v_sts'=>90);
				$this->db->where(array('id'=>$_POST['verifyid'],'v_sts'=>37));
				$this->db->update('hc_matter_hst', $data);

				$his_id_expense= $_POST['verifyid']; // event_id
				$hc_id_expense = $_POST['deleteEventId']; // suit_id

            	$data = array('r_reason'=>$_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'),'v_sts'=>90);

				$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='HC Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
                
                $reason=$_POST['return_reason_verify'];
                $activities_id = 90;
				$description_activities = 'Return HC Matter Expence- ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];

            }
        }
        if($this->input->post('type')=='verify_reject'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_hst',$_POST['verifyid'],'91,38','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {

            	$data = array('verify'=>91);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('hc_matter', $data);

				$data = array('reject_reason'=>$_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'),'v_sts'=>91);
				$this->db->where(array('id'=>$_POST['verifyid'],'v_sts'=>37));
				$this->db->update('hc_matter_hst', $data);

				$his_id_expense= $_POST['verifyid']; // event_id
				$hc_id_expense = $_POST['deleteEventId']; // suit_id

            	$data = array('reject_reason'=>$_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'),'v_sts'=>91);
            	$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='HC Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
                
                $reason=$_POST['return_reason_verify'];
                $activities_id = 91;
				$description_activities = 'Reject HC Matter Expence- ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];
                
            } 
        }
		
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_hst',$_POST['verifyid'],38,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$this->db->select('*');
				$this->db->from('hc_matter_hst');
				$this->db->where(array('id'=>$_POST['verifyid'],'sts'=>1));
				$this->db->limit(1);
				$data_res = $this->db->get()->row();
				$obj = json_decode($data_res->data_field);
				$status_data=array();
				foreach($obj as $key => $val){
					// Check Date Data
					if (preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $val, $matches)) {
    					if (checkdate($matches[2], $matches[1], $matches[3])) {
						$status_data[$key]=date('Y-m-d',strtotime(str_replace('/', '-',$val)));
						}else{
							$status_data[$key]=$val;
						}
					}else{
						$status_data[$key]=$val;
					}
				}
				$status_data['last_entry_by']=$this->session->userdata['ast_user']['user_id'];
				$status_data['last_entry_dt']=date('Y-m-d H:i:s');

				$this->db->where('hc_matter_id', $this->input->post('deleteEventId'));
				$this->db->update('hc_matter_status', $status_data);
				

				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
				$this->db->where(array('id'=>$_POST['verifyid'],'v_sts'=>37));
				$this->db->update('hc_matter_hst', $data); 

				if($data_res->final_sts==2){
					$data = array('verify'=>38,'present_status'=>$data_res->present_status,'final_sts'=>2,'f_by'=>$this->session->userdata['ast_user']['user_id'],'f_dt'=>date('Y-m-d H:i:s'),'final_remarks'=>$data_res->remarks,'files'=>$data_res->files,'v_sts'=>94);
				}else{
					$data = array('verify'=>38,'present_status'=>$data_res->present_status);
				}
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('hc_matter', $data);

				$activities_id = 38;
				$description_activities = 'Verify Case Status Update HC Matter - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];
				//echo $this->db->last_query();

				// Expense
				$his_id_expense= $_POST['verifyid'];
				$hc_id_expense = $_POST['deleteEventId']; // suit_id for expese
				
				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
				$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='HC Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);

				//Genereate Expenses
                $str="SELECT  j0.*,h.proposed_type,h.ac_number,h.org_ac_number,h.ac_name,h.case_no,h.case_type,h.portfolio,h.region,h.territory,h.district
                        FROM expenses j0
                        LEFT JOIN hc_matter as h
						ON h.id = j0.suit_id
                     WHERE j0.sts != '0'  AND j0.event_id= '".$his_id_expense."' AND j0.suit_id='".$hc_id_expense."' AND j0.module_name='HC Matter'";   
                $expense_data=$this->db->query($str)->result();
                //echo $this->db->last_query();
                //print_r($expense_data);
                if (!empty($expense_data)) {
                        foreach ($expense_data as $key) {
                        	if($key->proposed_type=='Loan' && $key->ac_number!='' && $key->ac_number!=NULL)
							{
								if(strlen($key->ac_number)==16)
								{
									$cif = substr($key->ac_number,5,8);
								}
								else if(strlen($key->ac_number)==13)
								{
									$cif = substr($key->ac_number,1,8);
								}
								else
								{
									$cif = "";
								}
							}
							else
							{
								$cif = "";
							}
                            $cost_data = array(
                            'module_name' => 'high_court',
                            'main_table_name' => 'hc_matter_hst',
                            'main_table_id' => $key->event_id,
                            'sub_table_name' => 'expenses',
                            'sub_table_id' => $key->id,
                            'suit_id' => $key->suit_id,
                            'activities_id' => $key->activities_name,
                            'vendor_type' => $key->expense_type,
                            'vendor_id' => $key->vendor_id,
                            'vendor_name' => $key->vendor_name,
                            'amount' =>$key->amount,
                            'txrn_dt' => $key->activities_date,
                            'proposed_type' => $key->proposed_type,
                            'loan_ac' => $key->ac_number,
                            'cif' => $cif,
                            'org_loan_ac' => $key->org_ac_number,
                            'ac_name' => $key->ac_name,
                            'case_number' => $key->case_no,
                            'req_type' => $key->case_type,
                            'loan_segment' => $key->portfolio,
                            'region' => $key->region,
                            'territory' => $key->territory,
                            'district' => $key->district,
                            'expense_remarks' =>$key->remarks
                        );
                            //print_r($cost_data);
                        $data3=$this->user_model->cost_details($cost_data);

                    }
                    $activities_id = 38;
					$description_activities_expense = 'Verify HC Matter Expence- ('.$data_res->id.')';
					$this->User_model->user_activities_bill($activities_id,'expenses',$data_res->id,'hc_matter_hst',$description_activities_expense,$reason);
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
			$this->User_model->user_activities($activities_id,'HC Matter',$row_id,$table_name,$description_activities,$reason);
			$this->db->trans_commit();

			$this->db->db_debug = $db_debug;
			return $row_id;
		}
	}
	
	function get_expence_delete(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "expenses";
		$activities_id='';
		$row_id='';
		$description_activities='';
		if($_POST['module_name']=='AD Matter'){
	    	$module_name = "hc_matter_ad";
	    	$msg='AD';
	    }else{
	    	$module_name = "hc_matter";
	    	$msg='HC';
	    }
		$reason ='';
		$sql = 'SELECT * FROM expenses where batch_no='.$_POST['deleteEventId'].' AND sts=1';
		$q = $this->db->query($sql);
		$res = $q->result();
		foreach($res as $k =>$result){
			if($this->input->post('type')=='delete'){
				$pre_action_result=$this->Common_model->get_pre_action_data('expenses',$result->id,0,'sts');
				if (count($pre_action_result)>0) 
				{
					return 'taken';
				}
				else
				{
					$data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
					$this->db->where('id', $result->id);
					$this->db->update('expenses', $data);
					$activities_id = 15;
					$description_activities = 'Delete '.$msg.' Expenceses - ('.$result->id.')';
					$row_id=$result->id;
					$reason =trim($_POST['comments']);
				}
				
			}
			if($this->input->post('type')=='sendtochecker'){
				$pre_action_result=$this->Common_model->get_pre_action_data('expenses',$result->id,37,'v_sts');

				if (count($pre_action_result)>0) 
				{
					return 'taken';
				}
				else
				{
					$data = array('v_sts'=>37,'stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'));
					$this->db->where('id', $result->id);
					$this->db->update('expenses', $data);

					$activities_id = 37;
					$description_activities = 'Send to Checker '.$msg.' Matter Expence- ('.$result->id.')';
					$row_id=$result->id;
					
				}
			}
			if($this->input->post('type')=='verify_return'){
	            $pre_action_result=$this->Common_model->get_pre_action_data('expenses',$result->id,'90,38,91','v_sts');
	            if (count($pre_action_result)>0) 
	            {
	                return 'taken';
	            }
	            else
	            {
	            	$data = array('r_reason'=>$_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'),'v_sts'=>90);
					$this->db->where('id', $result->id);
					$this->db->update('expenses', $data);
	                
	                $reason=$_POST['return_reason_verify'];
	                $activities_id = 90;
					$description_activities = 'Return '.$msg.' Matter Expence- ('.$result->id.')';
					$row_id=$result->id;

	            }
	            
	        }
	        if($this->input->post('type')=='verify_reject'){
	            $pre_action_result=$this->Common_model->get_pre_action_data('appeal_deposit',$result->id,'91,38','v_sts');
	            if (count($pre_action_result)>0) 
	            {
	                return 'taken';
	            }
	            else
	            {
	            	$data = array('reject_reason'=>$_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'),'v_sts'=>91);
					$this->db->where('id', $result->id);
					$this->db->update('expenses', $data);
	                
	                $reason=$_POST['return_reason_verify'];
	                $activities_id = 91;
					$description_activities = 'Reject '.$msg.' Matter Expence- ('.$result->id.')';
					$row_id=$result->id;
	                
	            }
	            
	        }
			if($this->input->post('type')=='verify'){
				$pre_action_result=$this->Common_model->get_pre_action_data('expenses',$result->id,38,'v_sts');
				if (count($pre_action_result)>0) 
				{
					return 'taken';
				}
				else
				{
					$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
					$this->db->where('id', $result->id);
					$this->db->update('expenses', $data);

					//Genereate Expenses
	                $str="SELECT  j0.*,h.proposed_type,h.ac_number,h.org_ac_number,h.ac_name,h.case_no,h.case_type,h.portfolio,h.region,h.territory,h.district
	                        FROM expenses j0
	                        LEFT JOIN hc_matter as h
							ON h.id = j0.event_id
	                     WHERE j0.sts != '0'  AND j0.id= '".$result->id."' AND j0.module_name='".$_POST['module_name']."'";   
	                $expense_data=$this->db->query($str)->result();
	                //echo $this->db->last_query();
	                //print_r($expense_data);
	                if (!empty($expense_data)) {
	                        foreach ($expense_data as $key) {
	                        	if($key->proposed_type=='Loan' && $key->ac_number!='' && $key->ac_number!=NULL)
								{
									if(strlen($key->ac_number)==16)
									{
										$cif = substr($key->ac_number,5,8);
									}
									else if(strlen($key->ac_number)==13)
									{
										$cif = substr($key->ac_number,1,8);
									}
									else
									{
										$cif = "";
									}
								}
								else
								{
									$cif = "";
								}
	                            $cost_data = array(
	                            'module_name' => 'high_court',
	                            'main_table_name' => $module_name,
	                            'main_table_id' => $key->event_id,
	                            'sub_table_name' => 'expenses',
	                            'sub_table_id' => $key->id,
	                            'suit_id' => $key->event_id,
	                            'activities_id' => $key->activities_name,
	                            'vendor_type' => $key->expense_type,
	                            'vendor_id' => $key->vendor_id,
	                            'vendor_name' => $key->vendor_name,
	                            'amount' =>$key->amount,
	                            'txrn_dt' => $key->activities_date,
	                            'proposed_type' => $key->proposed_type,
	                            'loan_ac' => $key->ac_number,
	                            'cif' => $cif,
	                            'org_loan_ac' => $key->org_ac_number,
	                            'ac_name' => $key->ac_name,
	                            'case_number' => $key->case_no,
	                            'req_type' => $key->case_type,
	                            'loan_segment' => $key->portfolio,
	                            'region' => $key->region,
	                            'territory' => $key->territory,
	                            'district' => $key->district,
	                            'expense_remarks' =>$key->remarks
	                        );
	                            //print_r($cost_data);
	                        $data3=$this->user_model->cost_details($cost_data);
	                    }
	                }


					$activities_id = 38;
					$description_activities = 'Verify '.$msg.' Matter Expence- ('.$result->id.')';
					$row_id=$result->id;
					
				}
				
			}
			$this->User_model->user_activities_bill($activities_id,$module_name,$row_id,$table_name,$description_activities,$reason);
		}
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		}
		else {
			//$this->User_model->user_activities_bill($activities_id,$module_name,$row_id,$table_name,$description_activities,$reason);
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

	function get_case_status($id,$dropdown_name){
		if($dropdown_name=='division'){
			$str=" SELECT id,name FROM ref_hc_case_category WHERE hc_division=$id AND data_status = 1 ORDER BY id ASC";
	        $query=$this->db->query($str);
	        return $query->result();
		}else if($dropdown_name=='category'){
			$str=" SELECT id,name FROM ref_hc_case_type WHERE hc_category=$id AND data_status = 1 ORDER BY id ASC";
	        $query=$this->db->query($str);
	        return $query->result();
		}else if($dropdown_name=='type'){
			$this->db->select('type');
			$this->db->from('ref_hc_case_type');
			$this->db->where(array('id'=>$id,'data_status'=>1));
			$data = $this->db->get()->row();
			if($data->type==1){
				$str=" SELECT id,name FROM ref_hc_case_status WHERE type in(1,3) AND data_status = 1 ORDER BY id ASC";
	            $query=$this->db->query($str);
	            return $query->result();
			}else if($data->type==2){
				$str=" SELECT id,name FROM ref_hc_case_status WHERE type in(2,3) AND data_status = 1 ORDER BY id ASC";
	            $query=$this->db->query($str);
	            return $query->result();
			}else{
				$str=" SELECT id,name FROM ref_hc_case_status WHERE type in(1,2,3) AND data_status = 1 ORDER BY id ASC";
	            $query=$this->db->query($str);
	            return $query->result();
			}
		}
		
	}

	function get_case_info($id){
		$this->db->select('e.*,e.id as history_id,st.*,st.id as sts_id,os.name as old_present_sts_name,
			if(e.next_dt_sts=1,(DATEDIFF(e.next_date,"'.date("Y-m-d").'")),0) as dif,
			if(e.next_dt_sts=1,date_format(e.next_date,"%d/%m/%Y"),e.next_date) as next_date,
		   s.name as present_sts_name, ohb.name as old_hcbench,hb.name as p_hc_bench, ohcl.name as old_hc_lawyer, hcl.name as p_hc_lawyer,h.case_type,div.name as division_name,cat.name as case_category_name,t.name as type_name,h.case_no,
			if(UNIX_TIMESTAMP(st.sts_10_date) IS NULL,"",DATE_FORMAT(st.sts_10_date,"%d/%m/%Y")) AS sts_10_date,
			if(UNIX_TIMESTAMP(st.sts_11_date) IS NULL,"",DATE_FORMAT(st.sts_11_date,"%d/%m/%Y")) AS sts_11_date,
			if(UNIX_TIMESTAMP(st.sts_12_gp_dt) IS NULL,"",DATE_FORMAT(st.sts_12_gp_dt,"%d/%m/%Y")) AS sts_12_gp_dt,
			if(UNIX_TIMESTAMP(st.sts_12_memo_dt) IS NULL,"",DATE_FORMAT(st.sts_12_memo_dt,"%d/%m/%Y")) AS sts_12_memo_dt,
			if(UNIX_TIMESTAMP(st.sts_13_date) IS NULL,"",DATE_FORMAT(st.sts_13_date,"%d/%m/%Y")) AS sts_13_date,
			if(UNIX_TIMESTAMP(st.sts_14_date) IS NULL,"",DATE_FORMAT(st.sts_14_date,"%d/%m/%Y")) AS sts_14_date,
			if(UNIX_TIMESTAMP(st.sts_15_date) IS NULL,"",DATE_FORMAT(st.sts_15_date,"%d/%m/%Y")) AS sts_15_date,
			if(UNIX_TIMESTAMP(st.sts_16_date) IS NULL,"",DATE_FORMAT(st.sts_16_date,"%d/%m/%Y")) AS sts_16_date,
			if(UNIX_TIMESTAMP(st.sts_17_date) IS NULL,"",DATE_FORMAT(st.sts_17_date,"%d/%m/%Y")) AS sts_17_date,
			if(UNIX_TIMESTAMP(st.sts_18_date) IS NULL,"",DATE_FORMAT(st.sts_18_date,"%d/%m/%Y")) AS sts_18_date,
			if(UNIX_TIMESTAMP(st.sts_1_date) IS NULL,"",DATE_FORMAT(st.sts_1_date,"%d/%m/%Y")) AS sts_1_date,
			if(UNIX_TIMESTAMP(st.sts_2_date) IS NULL,"",DATE_FORMAT(st.sts_2_date,"%d/%m/%Y")) AS sts_2_date,
			if(UNIX_TIMESTAMP(st.sts_3_gp_dt) IS NULL,"",DATE_FORMAT(st.sts_3_gp_dt,"%d/%m/%Y")) AS sts_3_gp_dt,
			if(UNIX_TIMESTAMP(st.sts_3_memo_dt) IS NULL,"",DATE_FORMAT(st.sts_3_memo_dt,"%d/%m/%Y")) AS sts_3_memo_dt,
			if(UNIX_TIMESTAMP(st.sts_4_date) IS NULL,"",DATE_FORMAT(st.sts_4_date,"%d/%m/%Y")) AS sts_4_date,
			if(UNIX_TIMESTAMP(st.sts_5_date) IS NULL,"",DATE_FORMAT(st.sts_5_date,"%d/%m/%Y")) AS sts_5_date,
			if(UNIX_TIMESTAMP(st.sts_6_date) IS NULL,"",DATE_FORMAT(st.sts_6_date,"%d/%m/%Y")) AS sts_6_date,
			if(UNIX_TIMESTAMP(st.sts_7_date) IS NULL,"",DATE_FORMAT(st.sts_7_date,"%d/%m/%Y")) AS sts_7_date,
			if(UNIX_TIMESTAMP(st.sts_9_date) IS NULL,"",DATE_FORMAT(st.sts_9_date,"%d/%m/%Y")) AS sts_9_date,
			if(UNIX_TIMESTAMP(st.sts_date) IS NULL,"",DATE_FORMAT(st.sts_date,"%d/%m/%Y")) AS sts_date,
			if(UNIX_TIMESTAMP(e.previous_date) IS NULL,"",DATE_FORMAT(e.previous_date,"%d/%m/%Y")) AS previous_date,
			if(UNIX_TIMESTAMP(e.previous_date_old) IS NULL,"",DATE_FORMAT(e.previous_date_old,"%d/%m/%Y")) AS previous_date_old
			', FALSE)
			->from("hc_matter_hst e")
			->join('ref_case_sts os', 'os.id=e.present_status_old', 'left')
			->join('ref_case_sts s', 's.id=e.present_status', 'left')
			->join('ref_hc_bench ohb', 'ohb.id=e.hc_bench_old', 'left')
			->join('ref_hc_bench hb', 'hb.id=e.hc_bench', 'left')
			->join('ref_lawyer ohcl', 'ohcl.id=e.hc_lawyer_old', 'left')
			->join('ref_lawyer hcl', 'hcl.id=e.hc_lawyer', 'left')
			->join('hc_matter h', 'h.id=e.hc_matter_id', 'left')
			->join('ref_hc_division div', 'div.id=h.hc_division', 'left')
			->join('ref_hc_case_category cat', 'cat.id=h.case_category', 'left')
			->join('ref_hc_case_type t', 't.id=h.case_type', 'left')
			->join('hc_matter_status st', 'st.hc_matter_id=e.hc_matter_id', 'left')
			->where("e.hc_matter_id='".$id."' AND e.v_sts IN (38)", NULL, FALSE)
			->order_by("e.id", "DESC")
			->limit(1);
		$q=$this->db->get();
		$result = $q->row();
		return $result;
	}
	function get_case_history($id){
		$this->db->select('m.*,cs.name as case_sts_name,hb.name as hc_bench_name,al.name as hc_lawyer_name, CONCAT(ue.name,"(",ue.pin,")") as e_by,concat(uv.name,"(",uv.pin,")") as v_by,bn.name as bench_number
    		', FALSE)
			->from("hc_matter_hst m")
			->join('ref_hc_case_status cs', 'cs.id=m.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=m.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=m.bench_number', 'left')
			->join('ref_lawyer al', 'al.id=m.hc_lawyer', 'left')
			->join('users_info ue', 'ue.id=m.e_by', 'left')
			->join('users_info uv', 'uv.id=m.v_by', 'left')
			->where(array('m.sts'=>1,'m.hc_matter_id'=>$id,'m.v_sts'=>38));
			$this->db->order_by('m.id','desc');
		$q=$this->db->get();
		$result = $q->result_array();
		
		foreach($result as $key=>$value){
			$json = json_decode((string) $value['data_field']);
			$i=1;$a='';
			if($value['present_status']>19){
				$type = 'sts_type';
			}else{
				$type = 'sts_'.$value['present_status'].'_type';
			}
			if(!empty($json)){
			foreach($json as $k=>$val){
				if($k=='sts_4_name'){
					$res = $this->Common_model->get_row_data('ref_lawyer',array('id'=>$val,'data_status'=>1));
					$a.=$res->name;
				}else if($k==$type){
					if($val=='1'){
    					$a.='Yes';
    				}else if($val=='2'){
    					$a.='No';
    				}else{
    					$a.=$val;
    				}
				}else{
    				$a.=$val;
				}
				if($i!=count((array)$json)){
					$a.='; ';
				}
				$i++;
			}
			}
			$result[$key]['status_details']=$a;
		}
		return $result;
	}
	function get_case_history_ad($id){
		$this->db->select('m.*,cs.name as case_sts_name,hb.name as hc_bench_name,al.name as hc_lawyer_name, CONCAT(ue.name,"(",ue.pin,")") as e_by,concat(uv.name,"(",uv.pin,")") as v_by,bn.name as bench_number
    		', FALSE)
			->from("hc_matter_hst_ad m")
			->join('ref_hc_case_status cs', 'cs.id=m.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=m.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=m.bench_number', 'left')
			->join('ref_lawyer al', 'al.id=m.hc_lawyer', 'left')
			->join('users_info ue', 'ue.id=m.e_by', 'left')
			->join('users_info uv', 'uv.id=m.v_by', 'left')
			->where(array('m.sts'=>1,'m.hc_matter_id'=>$id,'m.v_sts'=>38));
			$this->db->order_by('m.id','desc');
		$q=$this->db->get();
		$result = $q->result_array();
		
		foreach($result as $key=>$value){
			$json = json_decode($value['data_field']);
			$i=1;$a='';
			if($value['present_status']>19){
				$type = 'sts_type';
			}else{
				$type = 'sts_'.$value['present_status'].'_type';
			}
			
			foreach($json as $k=>$val){
				if($k=='sts_4_name'){
					$res = $this->Common_model->get_row_data('ref_lawyer',array('id'=>$val,'data_status'=>1));
					$a.=$res->name;
				}else if($k==$type){
					if($val=='1'){
    					$a.='Yes';
    				}else if($val=='2'){
    					$a.='No';
    				}else{
    					$a.=$val;
    				}
				}else{
    				$a.=$val;
				}
				if($i!=count((array)$json)){
					$a.='; ';
				}
				$i++;
			}
			$result[$key]['status_details']=$a;
		}
		return $result;
	}
	
	function get_case_edit_info($id){
		$this->db->select('a.*,h.id as hist_id,if(a.next_dt_sts=1,date_format(a.next_date,"%d/%m/%Y"),a.next_date) as next_date,div.name as division_name,
			if(UNIX_TIMESTAMP(a.filing_date) IS NULL,"",DATE_FORMAT(a.filing_date,"%d/%m/%Y")) AS filing_date,
    		if(UNIX_TIMESTAMP(a.file_receive_date) IS NULL,"",DATE_FORMAT(a.file_receive_date,"%d/%m/%Y")) AS file_receive_date,h.data_field
			', FALSE)
			->from("hc_matter a")
			->join('ref_hc_division div', 'div.id=a.hc_division', 'left')
			->join('hc_matter_hst h', 'h.hc_matter_id=a.id AND h.v_sts IN (39,35,90)', 'left')
			->where("a.id='".$id."'", NULL, FALSE)
			->limit(1);
		$q=$this->db->get();
		$result = $q->row();
		return $result;
	}

	function get_case_expense_edit_info($id,$module_name,$history_id=null){
		$where ='';
		if($history_id!=''){
			$where='AND e.event_id='.$history_id;
		}
		$this->db->select('e.*,
			if(UNIX_TIMESTAMP(e.activities_date) IS NULL,"",DATE_FORMAT(e.activities_date,"%d/%m/%Y")) AS activities_date
			', FALSE)
			->from("expenses e")
			->where("e.suit_id=".$id." ".$where." AND e.module_name='".$module_name."' AND e.sts<>0 AND e.batch_no IS NULL AND e.v_sts IN (35,39,90)", NULL, FALSE);
		$q=$this->db->get();
		$result = $q->result();
		return $result;
	}

	function get_hc_info_for_ad($id){
		$this->db->select('a.*,h.id as hist_id,
			
			s.*,s.id as sts_id,a.id as id,
			if(UNIX_TIMESTAMP(s.sts_10_date) IS NULL,"",DATE_FORMAT(s.sts_10_date,"%d/%m/%Y")) AS sts_10_date,
			if(UNIX_TIMESTAMP(s.sts_11_date) IS NULL,"",DATE_FORMAT(s.sts_11_date,"%d/%m/%Y")) AS sts_11_date,
			if(UNIX_TIMESTAMP(s.sts_12_gp_dt) IS NULL,"",DATE_FORMAT(s.sts_12_gp_dt,"%d/%m/%Y")) AS sts_12_gp_dt,
			if(UNIX_TIMESTAMP(s.sts_12_memo_dt) IS NULL,"",DATE_FORMAT(s.sts_12_memo_dt,"%d/%m/%Y")) AS sts_12_memo_dt,
			if(UNIX_TIMESTAMP(s.sts_13_date) IS NULL,"",DATE_FORMAT(s.sts_13_date,"%d/%m/%Y")) AS sts_13_date,
			if(UNIX_TIMESTAMP(s.sts_14_date) IS NULL,"",DATE_FORMAT(s.sts_14_date,"%d/%m/%Y")) AS sts_14_date,
			if(UNIX_TIMESTAMP(s.sts_15_date) IS NULL,"",DATE_FORMAT(s.sts_15_date,"%d/%m/%Y")) AS sts_15_date,
			if(UNIX_TIMESTAMP(s.sts_16_date) IS NULL,"",DATE_FORMAT(s.sts_16_date,"%d/%m/%Y")) AS sts_16_date,
			if(UNIX_TIMESTAMP(s.sts_17_date) IS NULL,"",DATE_FORMAT(s.sts_17_date,"%d/%m/%Y")) AS sts_17_date,
			if(UNIX_TIMESTAMP(s.sts_18_date) IS NULL,"",DATE_FORMAT(s.sts_18_date,"%d/%m/%Y")) AS sts_18_date,
			if(UNIX_TIMESTAMP(s.sts_1_date) IS NULL,"",DATE_FORMAT(s.sts_1_date,"%d/%m/%Y")) AS sts_1_date,
			if(UNIX_TIMESTAMP(s.sts_2_date) IS NULL,"",DATE_FORMAT(s.sts_2_date,"%d/%m/%Y")) AS sts_2_date,
			if(UNIX_TIMESTAMP(s.sts_3_gp_dt) IS NULL,"",DATE_FORMAT(s.sts_3_gp_dt,"%d/%m/%Y")) AS sts_3_gp_dt,
			if(UNIX_TIMESTAMP(s.sts_3_memo_dt) IS NULL,"",DATE_FORMAT(s.sts_3_memo_dt,"%d/%m/%Y")) AS sts_3_memo_dt,
			if(UNIX_TIMESTAMP(s.sts_4_date) IS NULL,"",DATE_FORMAT(s.sts_4_date,"%d/%m/%Y")) AS sts_4_date,
			if(UNIX_TIMESTAMP(s.sts_5_date) IS NULL,"",DATE_FORMAT(s.sts_5_date,"%d/%m/%Y")) AS sts_5_date,
			if(UNIX_TIMESTAMP(s.sts_6_date) IS NULL,"",DATE_FORMAT(s.sts_6_date,"%d/%m/%Y")) AS sts_6_date,
			if(UNIX_TIMESTAMP(s.sts_7_date) IS NULL,"",DATE_FORMAT(s.sts_7_date,"%d/%m/%Y")) AS sts_7_date,
			if(UNIX_TIMESTAMP(s.sts_9_date) IS NULL,"",DATE_FORMAT(s.sts_9_date,"%d/%m/%Y")) AS sts_9_date,

			if(UNIX_TIMESTAMP(a.filing_date) IS NULL,"",DATE_FORMAT(a.filing_date,"%d/%m/%Y")) AS filing_date,
    		if(UNIX_TIMESTAMP(a.file_receive_date) IS NULL,"",DATE_FORMAT(a.file_receive_date,"%d/%m/%Y")) AS file_receive_date,h.data_field
			', FALSE)
			->from("hc_matter a")
			->join('hc_matter_status s', 's.hc_matter_id=a.id', 'left')
			->join('hc_matter_hst h', 'h.hc_matter_id=a.id AND h.v_sts IN (35,39,90)', 'left')
			->where("a.id='".$id."' AND a.sts <>0", NULL, FALSE)
			->limit(1);
		$q=$this->db->get();
		$result = $q->row();
		return $result;
	}
	function get_expence_edit_info($id){
		$this->db->select('e.*,
			h.hc_matter_type,h.ac_number,h.ac_name,h.case_no,h.id as hc_id,div.name as division_name,
			if(UNIX_TIMESTAMP(e.activities_date) IS NULL,"",DATE_FORMAT(e.activities_date,"%d/%m/%Y")) AS activities_date
			', FALSE)
			->from("expenses e")
			->join('hc_matter h', 'h.id=e.event_id', 'left')
			->join('ref_hc_division div', 'div.id=h.hc_division', 'left')
			->where("e.batch_no='".$id."' AND e.sts=1", NULL, FALSE);
		$q=$this->db->get();
		$result = $q->result();
		return $result;
	}

	function get_expence_edit_info_ad($id){
		$this->db->select('e.*,
			h.hc_matter_type,h.ac_number,h.ac_name,h.case_no,h.id as hc_id,
			if(UNIX_TIMESTAMP(e.activities_date) IS NULL,"",DATE_FORMAT(e.activities_date,"%d/%m/%Y")) AS activities_date
			', FALSE)
			->from("expenses e")
			->join('hc_matter_ad h', 'h.id=e.event_id', 'left')
			->where("e.batch_no='".$id."' AND e.module_name='".$this->input->post('module_name')."' AND e.sts=1", NULL, FALSE);
		$q=$this->db->get();
		$result = $q->result();
		return $result;
	}

	function get_details($id){
		$hc_matter_type = $this->input->post('hc_matter_type');
		$this->db->select('h.*,div.name as division_name,cat.name as case_category_name,
			if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,
			
			d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,ht.name as hc_type_name,hd.name as hc_officer,IF(h.lower_dealing_officer>0,hl.name,h.lower_dealing_officer_str) as lower_officer,ls.name as portfolio_name,dm.name as deposit_am_50, 
			if(UNIX_TIMESTAMP(h.filing_date) IS NULL,"",DATE_FORMAT(h.filing_date,"%d/%m/%Y")) AS filing_date,
    		if(UNIX_TIMESTAMP(h.file_receive_date) IS NULL,"",DATE_FORMAT(h.file_receive_date,"%d/%m/%Y")) AS file_receive_date,bn.name as bench_number
    		', FALSE)
			->from("hc_matter h")
			->join('ref_hc_division div', 'div.id=h.hc_division', 'left')
			->join('ref_hc_case_category cat', 'cat.id=h.case_category', 'left')
			->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
			->join('ref_appeal_deposit_money dm', 'dm.id=h.deposit_am_50', 'left')
			->join('ref_loan_segment ls', 'ls.code=h.portfolio', 'left')
			->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
			->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
			->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
			->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
			->where(array('h.id'=>$id,'h.sts'=>1));
		$q=$this->db->get();
		$result = $q->row();
		//print_r($result);

		$this->db->select('m.*,cs.name as case_sts_name,hb.name as hc_bench_name,al.name as hc_lawyer_name, CONCAT(ue.name,"(",ue.pin,")") as e_by,concat(uv.name,"(",uv.pin,")") as v_by,bn.name as bench_number
    		', FALSE)
			->from("hc_matter_hst m")
			->join('ref_hc_case_status cs', 'cs.id=m.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=m.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=m.bench_number', 'left')
			->join('ref_lawyer al', 'al.id=m.hc_lawyer', 'left')
			->join('users_info ue', 'ue.id=m.e_by', 'left')
			->join('users_info uv', 'uv.id=m.v_by', 'left')
			->where(array('m.sts'=>1,'m.hc_matter_id'=>$result->id));
		$q=$this->db->get();
		$history = $q->result();

		$this->db->select('e.*,et.name as expense_name, 
			pv.name as paper_name, l.name as lawyer_name, u.name as staff_name, d.name as district_name,a.name as activities_name
    		', FALSE)
			->from("expenses e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_paper_vendor pv', 'pv.id=e.vendor_id', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('users_info u', 'u.id=e.vendor_id', 'left')
			->join('ref_legal_district d', 'd.id=e.district', 'left')
			->join('ref_hc_activities a', 'a.id=e.activities_name', 'left')
			->where("e.suit_id=".$result->id." AND e.module_name ='HC Matter' AND e.sts<>0 AND e.v_sts NOT IN (91) ");
		$q=$this->db->get();
		$expense_data = $q->result();


		$html = '';
		$html.='<table style="width: 100%;" class="preview_table2" >
			<tr>
                <th width="20%" align="left"><strong>Division</strong></th>
                <td width="30%" align="left">'.$result->division_name.'</td>
                <th width="20%" align="left"><strong>High Court Dealing officer</strong></th>
                <td width="30%" align="left" >'.$result->hc_officer.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>HC Case Type</strong></th>
                <td width="30%" align="left">'.$result->hc_matter_type.'</td>
                <th width="20%" align="left"><strong>Dealing officer</strong></th>
                <td width="30%" align="left" >'.$result->lower_officer.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account Name</strong></th>
                <td width="30%" align="left" >'.$result->ac_name.'</td>
                <th width="20%" align="left"><strong>Case Category</strong></th>
                <td width="30%" align="left" >'.$result->case_category_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account No</strong></th>
                <td width="30%" align="left" >'.$result->ac_number.'</td>
                <th width="20%" align="left"><strong>Case Types</strong></th>
                <td width="30%" align="left" >'.$result->hc_type_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>H. C. Mater number</strong></th>
                <td width="30%" align="left" >'.$result->case_no.'</td>
                <th width="20%" align="left"><strong>Present Status</strong></th>
                <td width="30%" align="left" >'.$result->case_sts_name.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>Portfolio</strong></th>
                <td width="30%" align="left" >'.$result->portfolio_name.'</td>
                <th width="20%" align="left"><strong>50% Deposited Appeal money</strong></th>
                <td width="30%" align="left" >'.$result->deposit_am_50.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>Filing Date</strong></th>
                <td width="30%" align="left" >'.$result->filing_date.'</td>
                <th width="20%" align="left"><strong>File Receive Date</strong></th>
                <td width="30%" align="left" >'.$result->file_receive_date.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>Name Of DIST</strong></th>
                <td width="30%" align="left" >'.$result->district_name.'</td>
                <th width="20%" align="left"><strong>Case Claim</strong></th>
                <td width="30%" align="left" >'.$result->case_claim.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>Bench Name</strong></th>
                <td width="30%" align="left" >'.$result->hc_bench_name.'</td>
                <th width="20%" align="left"><strong>Bench Number</strong></th>
                <td width="30%" align="left" >'.$result->bench_number.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Last Activities</strong></th>
                <td width="30%" align="left" >'.$result->last_act.'</td>
                <th width="20%" align="left"><strong>A/C Closing Status</strong></th>
                <td width="30%" align="left" >'.$result->ac_closing_status.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Subject matter/cause of action</strong></th>
                <td width="30%" align="left" >'.$result->present_cause_action.'</td>
                <th width="20%" align="left"><strong>Remarks</strong></th>
                <td width="30%" align="left" >'.$result->remarks.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Files</strong></th>
                <td width="30%" align="left" >';
                if($result->files!=''){
                $html.='<img id="file_preview_wa_scan_copy" onclick="popup(\''.base_url().'cma_file/hc_ad_file/'.$result->files.'\')" style=" cursor:pointer;text-align:center" src="'.base_url().'old_assets/images/print-preview.png" height="18">';
            	}
                $html.='</td>
                <th width="20%" align="left"></th>
                <td width="30%" align="left" ></td>
            </tr>
            
            </table>';
            $html.='<h4>Status History</h4><table style="width: 100%;" class="preview_table2">
            	<thead>
            		<tr>
            			<th>Sl</th>
            			<th>Case Status</th>
            			<th>Details</th>
            			<th>Case Activities</th>
            			<th>Remarks</th>
            			<th>Entry By</th>
            			<th>Entry Date</th>
            			<th>Verify By</th>
            			<th>Verify Date</th>
            		</tr>
            	</thead>
            	<tbody>';
            	foreach($history as $ke=>$hist){
            		$i=$ke+1;
            		$html.='<tr>
            			<td>'.$i.'</td>
            			<td>'.$hist->case_sts_name.'</td>
            			<td>';
            			// Json decode
            			if($hist->data_field!=NULL){
            			$json = json_decode($hist->data_field);
            			$i=1;
            			if($hist->present_status>19){
							$type = 'sts_type';
						}else{
							$type = 'sts_'.$hist->present_status.'_type';
						}
						// history data formated 
            			foreach($json as $k=>$val){
            				$a='';
            				if($k=='sts_4_name'){
            					$res = $this->Common_model->get_row_data('ref_lawyer',array('id'=>$val,'data_status'=>1));
            					$a=$res->name;
            				}else if($k==$type){
								if($val=='1'){
			    					$a='Yes';
			    				}else if($val=='2'){
			    					$a='No';
			    				}else{
			    					$a=$val;
			    				}
							}else{
	            				$a=$val;
            				}
            				$html.=$a;
            				if($i!=count((array)$json)){
            					$html.=';';
            				}
            				$i++;
            			}}
            			$html.='</td>
            			<td>'.$hist->last_act.'</td>
            			<td>'.$hist->remarks.'</td>
            			<td>'.$hist->e_by.'</td>
            			<td>'.$hist->e_dt.'</td>
            			<td>'.$hist->v_by.'</td>
            			<td>'.$hist->v_dt.'</td>
            		</tr>';
            	}
            	$html.='</tbody>
            </table>';

            $html.='<h4>Expence Details</h4><table style="width: 100%;" class="preview_table2">
            	<thead>
            		<tr>
            			<th>Expense Type</th>
            			<th>District</th>
            			<th>Vendor Name</th>
            			<th>Activities Name</th>
            			<th>Activities Date</th>
            			<th>Total Amount</th>
            			<th>Files</th>
            			<th>Remarks</th>
            		</tr>
            	</thead>
            	<tbody>';
            	foreach($expense_data as $key=>$row){
            		$html.='<tr>
            			<td>'.$row->expense_name.'</td>';
            			if($row->expense_type==1){
            				$html.='<td></td>';
            		 		$html.='<td>'.$row->lawyer_name.'</td>';
            			}
            			elseif($row->expense_type==2){
            				$html.='<td></td>';
            				$html.='<td>'.$row->paper_name.'</td>';
            			}
            			elseif($row->expense_type==3){
            				$html.='<td>'.$row->district_name.'</td>';
            				$html.='<td>'.$row->staff_name.'</td>';
            			}else{
            				$html.='<td></td>';
            				$html.='<td>'.$row->vendor_name.'</td>';
            			}
            		 $html.='<td>'.$row->activities_name.'</td>
            			<td>'.$row->activities_date.'</td>
            			<td>'.$row->amount.'</td>
            			<td>';
            			if($row->appeal_bail_bill_copy!=''){
			                $html.='<img id="file_preview_wa_scan_copy" onclick="popup(\''.base_url().'cma_file/bill_copy/'.$row->appeal_bail_bill_copy.'\')" style=" cursor:pointer;text-align:center" src="'.base_url().'old_assets/images/print-preview.png" height="18">';
			            	}
            			$html .='</td>
            			<td>'.$row->remarks.'</td>
            		</tr>';
            	}
            	$html.='</tbody>
            </table>';
            
		return $html;
	}
	function get_data_details_preview($id){
		$hc_matter_type = $this->input->post('hc_matter_type');
		$this->db->select('h.*,
			if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,
			
			d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,ht.name as hc_type_name,hd.name as hc_officer,IF(h.lower_dealing_officer>0,hl.name,h.lower_dealing_officer_str) as lower_officer,ls.name as portfolio_name,dm.name as deposit_am_50, 
			if(UNIX_TIMESTAMP(h.filing_date) IS NULL,"",DATE_FORMAT(h.filing_date,"%d/%m/%Y")) AS filing_date,
    		if(UNIX_TIMESTAMP(h.file_receive_date) IS NULL,"",DATE_FORMAT(h.file_receive_date,"%d/%m/%Y")) AS file_receive_date,bn.name as bench_number
    		', FALSE)
			->from("hc_matter h")
			->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
			->join('ref_appeal_deposit_money dm', 'dm.id=h.deposit_am_50', 'left')
			->join('ref_loan_segment ls', 'ls.code=h.portfolio', 'left')
			->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
			->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
			->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
			->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
			->where(array('h.id'=>$id,'h.sts'=>1));
		$q=$this->db->get();
		$result = $q->row();
		//print_r($result);

		$this->db->select('m.*,cs.name as case_sts_name,hb.name as hc_bench_name,al.name as hc_lawyer_name, CONCAT(ue.name,"(",ue.pin,")") as e_by,concat(uv.name,"(",uv.pin,")") as v_by,bn.name as bench_number
    		', FALSE)
			->from("hc_matter_hst m")
			->join('ref_hc_case_status cs', 'cs.id=m.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=m.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=m.bench_number', 'left')
			->join('ref_lawyer al', 'al.id=m.hc_lawyer', 'left')
			->join('users_info ue', 'ue.id=m.e_by', 'left')
			->join('users_info uv', 'uv.id=m.v_by', 'left')
			->where(array('m.sts'=>1,'m.hc_matter_id'=>$result->id));
		$q=$this->db->get();
		$history = $q->result();

		$this->db->select('e.*,et.name as expense_name, 
			pv.name as paper_name, l.name as lawyer_name, u.name as staff_name, d.name as district_name,a.name as activities_name
    		', FALSE)
		
			->from("cost_details e")
			->join('ref_expense_type et', 'et.id=e.vendor_type', 'left')
			->join('ref_paper_vendor pv', 'pv.id=e.vendor_id', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('users_info u', 'u.id=e.vendor_id', 'left')
			->join('ref_legal_district d', 'd.id=e.district', 'left')
			->join('ref_hc_activities a', 'a.id=e.activities_id', 'left')
			->where("e.suit_id=".$result->id." AND e.module_name ='high_court' AND e.main_table_name='hc_matter_hst' ");
		$q=$this->db->get();
		$expense_data = $q->result();


		$html = '';
		$html.='<table style="width: 100%;" class="preview_table2" >
			<tr>
                <th width="20%" align="left"><strong>HC Case Type</strong></th>
                <td width="30%" align="left">'.$result->hc_matter_type.'</td>
                <th width="20%" align="left"><strong>High Court Dealing officer</strong></th>
                <td width="30%" align="left" >'.$result->hc_officer.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account Name</strong></th>
                <td width="30%" align="left" >'.$result->ac_name.'</td>
                <th width="20%" align="left"><strong>Dealing officer</strong></th>
                <td width="30%" align="left" >'.$result->lower_officer.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account No</strong></th>
                <td width="30%" align="left" >'.$result->ac_number.'</td>
                <th width="20%" align="left"><strong>Case Types</strong></th>
                <td width="30%" align="left" >'.$result->hc_type_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Portfolio</strong></th>
                <td width="30%" align="left" >'.$result->portfolio_name.'</td>
                <th width="20%" align="left"><strong>Present Status</strong></th>
                <td width="30%" align="left" >'.$result->case_sts_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>H. C. Mater number</strong></th>
                <td width="30%" align="left" >'.$result->case_no.'</td>
                <th width="20%" align="left"><strong>50% Deposited Appeal money</strong></th>
                <td width="30%" align="left" >'.$result->deposit_am_50.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Filing Date</strong></th>
                <td width="30%" align="left" >'.$result->filing_date.'</td>
                <th width="20%" align="left"><strong>File Receive Date</strong></th>
                <td width="30%" align="left" >'.$result->file_receive_date.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>Name Of DIST</strong></th>
                <td width="30%" align="left" >'.$result->district_name.'</td>
               <th width="20%" align="left"><strong>Case Claim</strong></th>
                <td width="30%" align="left" >'.$result->case_claim.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>Bench Name</strong></th>
                <td width="30%" align="left" >'.$result->hc_bench_name.'</td>
                <th width="20%" align="left"><strong>Bench Number</strong></th>
                <td width="30%" align="left" >'.$result->bench_number.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Last Activities</strong></th>
                <td width="30%" align="left" >'.$result->last_act.'</td>
                <th width="20%" align="left"><strong>A/C Closing Status</strong></th>
                <td width="30%" align="left" >'.$result->ac_closing_status.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Subject matter/cause of action</strong></th>
                <td width="30%" align="left" >'.$result->present_cause_action.'</td>
                <th width="20%" align="left"><strong>Remarks</strong></th>
                <td width="30%" align="left" >'.$result->remarks.'</td>
            </tr>
            
            </table>';
            $html.='<h4>Status History</h4><table style="width: 100%;" class="preview_table2">
            	<thead>
            		<tr>
            			<th>Sl</th>
            			<th>Case Status</th>
            			<th>Details</th>
            			<th>Case Activities</th>
            			<th>Remarks</th>
            			<th>Entry By</th>
            			<th>Entry Date</th>
            			<th>Verify By</th>
            			<th>Verify Date</th>
            		</tr>
            	</thead>
            	<tbody>';
            	foreach($history as $ke=>$hist){
            		$i=$ke+1;
            		$html.='<tr>
            			<td>'.$i.'</td>
            			<td>'.$hist->case_sts_name.'</td>
            			<td>';
            			// Json decode
            			$json = json_decode($hist->data_field);
            			$i=1;
            			if($hist->present_status>19){
							$type = 'sts_type';
						}else{
							$type = 'sts_'.$hist->present_status.'_type';
						}
						// history data formated 
						if(!empty($json)){
	            			foreach($json as $k=>$val){
	            				$a='';
	            				if($k=='sts_4_name'){
	            					$res = $this->Common_model->get_row_data('ref_lawyer',array('id'=>$val,'data_status'=>1));
	            					$a=$res->name;
	            				}else if($k==$type){
									if($val=='1'){
				    					$a='Yes';
				    				}else if($val=='2'){
				    					$a='No';
				    				}else{
				    					$a=$val;
				    				}
								}else{
		            				$a=$val;
		            				
	            				}
	            				$html.=$a;
	            				if($i!=count((array)$json)){
	            					$html.=';';
	            				}
	            				$i++;
	            			}
            			}
            			$html.='</td>
            			<td>'.$hist->last_act.'</td>
            			<td>'.$hist->remarks.'</td>
            			<td>'.$hist->e_by.'</td>
            			<td>'.$hist->e_dt.'</td>
            			<td>'.$hist->v_by.'</td>
            			<td>'.$hist->v_dt.'</td>
            		</tr>';
            	}
            	$html.='</tbody>
            </table>';

    		$html.='<h4>Expence Details</h4><table style="width: 100%;" class="preview_table2">
            	<thead>
            		<tr>
            			<th>Expense Type</th>
            			<th>District</th>
            			<th>Vendor Name</th>
            			<th>Activities Name</th>
            			<th>Activities Date</th>
            			<th>Total Amount</th>
            			<th>Remarks</th>
            		</tr>
            	</thead>
            	<tbody>';
            	$total = 0;
            	foreach($expense_data as $key=>$row){
            		$total +=$row->amount;
            		$html.='<tr>
            			<td>'.$row->expense_name.'</td>';
            			if($row->vendor_type==1){
            				$html.='<td></td>';
            		 		$html.='<td>'.$row->lawyer_name.'</td>';
            			}
            			elseif($row->vendor_type==2){
            				$html.='<td></td>';
            				$html.='<td>'.$row->paper_name.'</td>';
            			}
            			elseif($row->vendor_type==3){
            				$html.='<td>'.$row->district_name.'</td>';
            				$html.='<td>'.$row->staff_name.'</td>';
            			}else{
            				$html.='<td></td>';
            				$html.='<td>'.$row->vendor_name.'</td>';
            			}
            		 $html.='<td>'.$row->activities_name.'</td>
            			<td>'.$row->txrn_dt.'</td>
            			<td>'.$row->amount.'</td>
            			<td>'.$row->expense_remarks.'</td>
            		</tr>';
            	}
            	$html.='</tbody>
            	<tfoot>
            		<tr>
            			<th colspan="5" style="text-align:right;">Total</th>
            			<th>'.$total.'</th>
            			<th></th>
            		</tr>
            	</tfoot>
            </table>';
            
		return $html;
	}
	function get_billing_details($id){
		$where2 = "e.sts=1 AND e.module_name='appeal_bail' AND e.id= ".$id;
		$this->db->select('e.*,a.deposit_amt,a.arrested ,c.sl_no,c.proposed_type, c.loan_ac,c.ac_name,n.name as case_n,f.case_number,DATE_FORMAT(a.deposit_date,"%d-%m-%Y") AS deposit_dt,DATE_FORMAT(a.deposit_date,"%d/%m/%Y") AS depo_dt,cd.memo_sts,et.name as expense_name,ea.name as activities,d.name as district_name,if(e.expense_type=1,l.name,u.name) as vendor_name
    		,DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS activities_date,if(cd.memo_sts=31,"Completed","Pending") as bill_sts', FALSE)
			->from("expenses e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('users_info u', 'u.id=e.vendor_id', 'left')
			->join('ref_legal_district d', 'd.id=e.district', 'left')
			->join('ref_expense_activities ea', 'ea.id=e.activities_name', 'left')

			->join('cost_details cd', 'cd.sub_table_name="expenses" AND cd.sub_table_id=e.id', 'left')

			->join('appeal_deposit a', 'a.id=e.event_id', 'left')
			->join('suit_filling_info f', 'f.id=a.suit_id', 'left')
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


	function hc_caseup_edit($id,$history_id){
		$this->db->select('e.*,e.id as history_id,os.name as old_present_sts_name, 
			s.name as present_sts_name, ohb.name as old_hcbench,hb.name as p_hc_bench, ohcl.name as old_hc_lawyer, hcl.name as p_hc_lawyer,
			st.*,st.id as sts_id,
			if(e.next_date="Yet To Fix",e.next_date,DATE_FORMAT(e.next_date,"%d/%m/%Y")) as next_date,
			if(UNIX_TIMESTAMP(st.sts_10_date) IS NULL,"",DATE_FORMAT(st.sts_10_date,"%d/%m/%Y")) AS sts_10_date,
			if(UNIX_TIMESTAMP(st.sts_11_date) IS NULL,"",DATE_FORMAT(st.sts_11_date,"%d/%m/%Y")) AS sts_11_date,
			if(UNIX_TIMESTAMP(st.sts_12_gp_dt) IS NULL,"",DATE_FORMAT(st.sts_12_gp_dt,"%d/%m/%Y")) AS sts_12_gp_dt,
			if(UNIX_TIMESTAMP(st.sts_12_memo_dt) IS NULL,"",DATE_FORMAT(st.sts_12_memo_dt,"%d/%m/%Y")) AS sts_12_memo_dt,
			if(UNIX_TIMESTAMP(st.sts_13_date) IS NULL,"",DATE_FORMAT(st.sts_13_date,"%d/%m/%Y")) AS sts_13_date,
			if(UNIX_TIMESTAMP(st.sts_14_date) IS NULL,"",DATE_FORMAT(st.sts_14_date,"%d/%m/%Y")) AS sts_14_date,
			if(UNIX_TIMESTAMP(st.sts_15_date) IS NULL,"",DATE_FORMAT(st.sts_15_date,"%d/%m/%Y")) AS sts_15_date,
			if(UNIX_TIMESTAMP(st.sts_16_date) IS NULL,"",DATE_FORMAT(st.sts_16_date,"%d/%m/%Y")) AS sts_16_date,
			if(UNIX_TIMESTAMP(st.sts_17_date) IS NULL,"",DATE_FORMAT(st.sts_17_date,"%d/%m/%Y")) AS sts_17_date,
			if(UNIX_TIMESTAMP(st.sts_18_date) IS NULL,"",DATE_FORMAT(st.sts_18_date,"%d/%m/%Y")) AS sts_18_date,
			if(UNIX_TIMESTAMP(st.sts_1_date) IS NULL,"",DATE_FORMAT(st.sts_1_date,"%d/%m/%Y")) AS sts_1_date,
			if(UNIX_TIMESTAMP(st.sts_2_date) IS NULL,"",DATE_FORMAT(st.sts_2_date,"%d/%m/%Y")) AS sts_2_date,
			if(UNIX_TIMESTAMP(st.sts_3_gp_dt) IS NULL,"",DATE_FORMAT(st.sts_3_gp_dt,"%d/%m/%Y")) AS sts_3_gp_dt,
			if(UNIX_TIMESTAMP(st.sts_3_memo_dt) IS NULL,"",DATE_FORMAT(st.sts_3_memo_dt,"%d/%m/%Y")) AS sts_3_memo_dt,
			if(UNIX_TIMESTAMP(st.sts_4_date) IS NULL,"",DATE_FORMAT(st.sts_4_date,"%d/%m/%Y")) AS sts_4_date,
			if(UNIX_TIMESTAMP(st.sts_5_date) IS NULL,"",DATE_FORMAT(st.sts_5_date,"%d/%m/%Y")) AS sts_5_date,
			if(UNIX_TIMESTAMP(st.sts_6_date) IS NULL,"",DATE_FORMAT(st.sts_6_date,"%d/%m/%Y")) AS sts_6_date,
			if(UNIX_TIMESTAMP(st.sts_7_date) IS NULL,"",DATE_FORMAT(st.sts_7_date,"%d/%m/%Y")) AS sts_7_date,
			if(UNIX_TIMESTAMP(st.sts_9_date) IS NULL,"",DATE_FORMAT(st.sts_9_date,"%d/%m/%Y")) AS sts_9_date,
			if(UNIX_TIMESTAMP(st.sts_date) IS NULL,"",DATE_FORMAT(st.sts_date,"%d/%m/%Y")) AS sts_date,
			if(UNIX_TIMESTAMP(e.previous_date) IS NULL,"",DATE_FORMAT(e.previous_date,"%d/%m/%Y")) AS previous_date,
			if(UNIX_TIMESTAMP(e.previous_date_old) IS NULL,"",DATE_FORMAT(e.previous_date_old,"%d/%m/%Y")) AS previous_date_old
			', FALSE)
			->from("hc_matter_hst e")
			->join('ref_case_sts os', 'os.id=e.present_status_old', 'left')
			->join('ref_case_sts s', 's.id=e.present_status', 'left')
			->join('ref_hc_bench ohb', 'ohb.id=e.hc_bench_old', 'left')
			->join('ref_hc_bench hb', 'hb.id=e.hc_bench', 'left')
			->join('ref_lawyer ohcl', 'ohcl.id=e.hc_lawyer_old', 'left')
			->join('ref_lawyer hcl', 'hcl.id=e.hc_lawyer', 'left')
			->join('hc_matter_status st', 'st.hc_matter_id=e.hc_matter_id', 'left')
			->where("e.id=".$history_id." AND e.hc_matter_id=".$id." AND e.v_sts IN (35,39,90)", NULL, FALSE)
			->order_by("e.id", "DESC")
			->limit(1);
		$q=$this->db->get();
		$result = $q->row();
		return $result;
	}

	//  HC Expence 
	function get_expence_details(){
		$module_name = $this->input->post('module_name');
		$table = 'hc_matter';
		/*if($module_name=='AD Matter'){
			$table = 'hc_matter_ad';
		}else{
			$table = 'hc_matter';
		}*/
		$id = $this->input->post('id');
		//echo $id;
		$this->db->select('e.*,et.name as expense_name, 
			pv.name as paper_name, l.name as lawyer_name, u.name as staff_name, d.name as district_name,a.name as activities_name, h.hc_matter_type,h.ac_number,h.ac_name,h.case_no,h.case_claim,h.last_act,h.present_cause_action,div.name as division_name,
			if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,
			dh.name as district_nameh,cs.name as case_sts_name,hb.name as hc_bench_name,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,dm.name as deposit_am_50, 
			if(UNIX_TIMESTAMP(h.filing_date) IS NULL,"",DATE_FORMAT(h.filing_date,"%d/%m/%Y")) AS filing_date,
    		if(UNIX_TIMESTAMP(h.file_receive_date) IS NULL,"",DATE_FORMAT(h.file_receive_date,"%d/%m/%Y")) AS file_receive_date,bn.name as bench_number
    		', FALSE)
			->from("expenses e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_paper_vendor pv', 'pv.id=e.vendor_id', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('users_info u', 'u.id=e.vendor_id', 'left')
			->join('ref_legal_district d', 'd.id=e.district', 'left')
			->join('ref_hc_activities a', 'a.id=e.activities_name', 'left')
			->join($table.' h', 'h.id=e.event_id', 'left')
			->join('ref_hc_division div', 'div.id=h.hc_division', 'left')
			->join('ref_legal_district dh', 'dh.id=h.name_dist', 'left')
			->join('ref_appeal_deposit_money dm', 'dm.id=h.deposit_am_50', 'left')
			->join('ref_loan_segment ls', 'ls.id=h.portfolio', 'left')
			->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
			->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
			->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
			->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
			->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
			->where(array('e.batch_no'=>$id,'e.module_name'=>$module_name,'e.sts<>'=>0));
		$q=$this->db->get();
		$result = $q->result();

		$html = '';
		$html.='<table style="width: 100%;" class="preview_table2" >
			<tr>
				<th width="20%" align="left"><strong>Division</strong></th>
                <td width="30%" align="left">'.$result[0]->division_name.'</td>
                
                <th width="20%" align="left"><strong>High Court Dealing officer</strong></th>
                <td width="30%" align="left" >'.$result[0]->hc_officer.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>HC Case Type</strong></th>
                <td width="30%" align="left">'.$result[0]->hc_matter_type.'</td>
               
                <th width="20%" align="left"><strong>Lower Court Dealing officer</strong></th>
                <td width="30%" align="left" >'.$result[0]->lower_officer.'</td>
            </tr>
            <tr>
            	 <th width="20%" align="left"><strong>Account Name</strong></th>
                <td width="30%" align="left" >'.$result[0]->ac_name.'</td>
                
                <th width="20%" align="left"><strong>Case Types</strong></th>
                <td width="30%" align="left" >'.$result[0]->hc_type_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account No</strong></th>
                <td width="30%" align="left" >'.$result[0]->ac_number.'</td>
                <th width="20%" align="left"><strong>Present Status</strong></th>
                <td width="30%" align="left" >'.$result[0]->case_sts_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Case/Rule NO</strong></th>
                <td width="30%" align="left" >'.$result[0]->case_no.'</td>
                <th width="20%" align="left"><strong>50% Deposited Appeal money</strong></th>
                <td width="30%" align="left" >'.$result[0]->deposit_am_50.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Filing Date</strong></th>
                <td width="30%" align="left" >'.$result[0]->filing_date.'</td>
                <th width="20%" align="left"><strong>Assigned Lawyer</strong></th>
                <td width="30%" align="left" >'.$result[0]->assigned_lawyer_name.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>Name Of DIST</strong></th>
                <td width="30%" align="left" >'.$result[0]->district_nameh.'</td>
                <th width="20%" align="left"><strong>File Receive Date</strong></th>
                <td width="30%" align="left" >'.$result[0]->file_receive_date.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>NAME OF HIGH COURT BENCH</strong></th>
                <td width="30%" align="left" >'.$result[0]->hc_bench_name.'</td>
                <th width="20%" align="left"><strong>Case Claim</strong></th>
                <td width="30%" align="left" >'.$result[0]->case_claim.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Last Activities</strong></th>
                <td width="30%" align="left" >'.$result[0]->last_act.'</td>
                <th width="20%" align="left"><strong>A/C Closing Status</strong></th>
                <td width="30%" align="left" >'.$result[0]->ac_closing_status.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Present CAUSE OF ACTION</strong></th>
                <td width="30%" align="left" >'.$result[0]->present_cause_action.'</td>
                <th width="20%" align="left"><strong>Remarks</strong></th>
                <td width="30%" align="left" >'.$result[0]->remarks.'</td>
            </tr>
            
            </table>';
            $html.='<h4>Expence Details</h4><table style="width: 100%;" class="preview_table2">
            	<thead>
            		<tr>
            			<th>Expense Type</th>
            			<th>District</th>
            			<th>Vendor Name</th>
            			<th>Activities Name</th>
            			<th>Activities Date</th>
            			<th>Total Amount</th>
            			<th>Files</th>
            			<th>Remarks</th>
            		</tr>
            	</thead>
            	<tbody>';
            	foreach($result as $key=>$row){
            		$html.='<tr>
            			<td>'.$row->expense_name.'</td>';
            			if($row->expense_type==1){
            				$html.='<td></td>';
            		 		$html.='<td>'.$row->lawyer_name.'</td>';
            			}
            			elseif($row->expense_type==2){
            				$html.='<td></td>';
            				$html.='<td>'.$row->paper_name.'</td>';
            			}
            			elseif($row->expense_type==3){
            				$html.='<td>'.$row->district_name.'</td>';
            				$html.='<td>'.$row->staff_name.'</td>';
            			}else{
            				$html.='<td></td>';
            				$html.='<td>'.$row->vendor_name.'</td>';
            			}
            		 $html.='<td>'.$row->activities_name.'</td>
            			<td>'.$row->activities_date.'</td>
            			<td>'.$row->amount.'</td>
            			<td>';
            			if($row->appeal_bail_bill_copy!=''){
			                $html.='<img id="file_preview_wa_scan_copy" onclick="popup(\''.base_url().'cma_file/bill_copy/'.$row->appeal_bail_bill_copy.'\')" style=" cursor:pointer;text-align:center" src="'.base_url().'old_assets/images/print-preview.png" height="18">';
			            	}
            			$html .='</td>
            			<td>'.$row->remarks.'</td>
            		</tr>';
            	}
            	$html.='</tbody>
            </table>';
            
		return $html;
	}

	//// Appeale Division Case File

	function add_edit_action_ad($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
	{
		$this->db->trans_begin();
        if($editrow==""){$editrow=0;}
	    $table_name = "hc_matter_ad";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";
	    
	    $this->form_validation->set_rules('loan_ac', 'loan_ac', 'trim|required|xss_clean|min_length[16]|max_length[16]');
	    $this->form_validation->set_rules('proposed_type', 'proposed_type', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('hidden_loan_ac', 'hidden_loan_ac', 'trim|xss_clean');
	    $this->form_validation->set_rules('req_type', 'req_type', 'trim|xss_clean');
	    $this->form_validation->set_rules('region', 'region', 'trim|xss_clean');
	    $this->form_validation->set_rules('territory', 'territory', 'trim|xss_clean');
	    $this->form_validation->set_rules('district', 'district', 'trim|xss_clean');
	    $this->form_validation->set_rules('hc_type', 'hc_type', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('account_name', 'account_name', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('hc_dealing_officer', 'hc_dealing_officer', 'trim|xss_clean');
	    $this->form_validation->set_rules('portfolio', 'portfolio', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('lower_dealing_officer', 'lower_dealing_officer', 'trim|xss_clean');
	    $this->form_validation->set_rules('hc_division', 'hc_division', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('case_type', 'case_type', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('case_category', 'case_category', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('deposited_appeal_money', 'deposited_appeal_money', 'trim|xss_clean');
	    $this->form_validation->set_rules('case_no', 'case_no', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('file_receive_date', 'file_receive_date', 'trim|xss_clean');
	    $this->form_validation->set_rules('case_claim', 'case_claim', 'trim|xss_clean');
	    $this->form_validation->set_rules('assigned_lawyer', 'assigned_lawyer', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('filing_date', 'filing_date', 'trim|xss_clean');
	    $this->form_validation->set_rules('name_dist', 'name_dist', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('present_status', 'present_status', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('next_status', 'next_status', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('next_date', 'next_date', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('year', 'year', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('last_activities', 'last_activities', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('present_casue_action', 'present_casue_action', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('hc_bench', 'hc_bench', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('bench_number', 'bench_number', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('remarks', 'remarks', 'trim|xss_clean');
	    $this->form_validation->set_rules('withdrawn_date', 'withdrawn_date', 'trim|xss_clean');
	    $this->form_validation->set_rules('ac_closing_status', 'ac_closing_status', 'trim|required|xss_clean');

	    if($this->input->post('present_status')==3){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('lcr_memo_no', 'lcr_memo_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('memo_date', 'memo_date', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_no', 'gp_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_date', 'gp_date', 'trim|required|xss_clean');
	    }elseif($this->input->post('present_status')==4){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
	    	if($this->input->post('status')==1){
	    		$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
	    	}
	    }elseif($this->input->post('present_status')==8||$this->input->post('present_status')==19){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    }elseif($this->input->post('present_status')==11){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('court_name', 'court_name', 'trim|required|xss_clean');
	    	if($this->input->post('status')==1){
	    		$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
	    	}
	    }elseif($this->input->post('present_status')==12){
	    	$this->form_validation->set_rules('lcr_memo_no', 'lcr_memo_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('memo_date', 'memo_date', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_no', 'gp_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_date', 'gp_date', 'trim|required|xss_clean');
	    }elseif($this->input->post('present_status')==13){
	    	$this->form_validation->set_rules('wp_amount', 'wp_amount', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('withdrawn_date', 'withdrawn_date', 'trim|required|xss_clean');
	    }elseif($this->input->post('present_status')==18){
	    	$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
	    }else{
	    	if($this->input->post('present_status')>19){
	    		$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	}else{
		    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
		    	if($this->input->post('status')==1){
		    		$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
		    	}
	    	}
	    }

	    if ($this->form_validation->run() == TRUE){
	    $filing_date = $this->input->post('filing_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('filing_date')))):'';
	    $withdrawn_date = $this->input->post('withdrawn_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('withdrawn_date')))):'';
	    $file_receive_date = $this->input->post('file_receive_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('file_receive_date')))):'';
	    $next_date = $this->input->post('next_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('next_date')))):'';
	    $expenses = array(
			'hc_matter_type' =>$this->security->xss_clean( $this->input->post('hc_type')),
			'ac_number' =>$this->security->xss_clean( $this->input->post('loan_ac')),
			'ac_name' =>$this->security->xss_clean( $this->input->post('account_name')),
			'proposed_type' =>$this->security->xss_clean( $this->input->post('proposed_type')),
			'portfolio' =>$this->security->xss_clean( $this->input->post('portfolio')),
			'case_category' =>$this->security->xss_clean( $this->input->post('case_category')),
			'case_type' =>$this->security->xss_clean( $this->input->post('case_type')),
			'case_no' =>$this->security->xss_clean( $this->input->post('case_no')),
			'case_claim' =>$this->security->xss_clean( $this->input->post('case_claim')),
			'name_dist' =>$this->security->xss_clean( $this->input->post('name_dist')),
			'present_status' =>$this->security->xss_clean( $this->input->post('present_status')),
			'next_status' =>$this->security->xss_clean( $this->input->post('next_status')),
			'next_date' =>$next_date,
			'year' =>$this->security->xss_clean( $this->input->post('year')),
			'last_act' =>$this->security->xss_clean( $this->input->post('last_activities')),
			'present_cause_action' =>$this->security->xss_clean( $this->input->post('present_casue_action')),
			'hc_bench' =>$this->security->xss_clean( $this->input->post('hc_bench')),
			'bench_number' =>$this->security->xss_clean( $this->input->post('bench_number')),
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),
			'ac_closing_status' =>$this->security->xss_clean( $this->input->post('ac_closing_status')),
			'hc_dealing_officer' =>$this->security->xss_clean( $this->input->post('hc_dealing_officer')),
			'lower_dealing_officer' =>$this->security->xss_clean( $this->input->post('lower_dealing_officer')),
			'deposit_am_50' =>$this->security->xss_clean( $this->input->post('deposited_appeal_money')),
			'assigned_lawyer' =>$this->security->xss_clean( $this->input->post('assigned_lawyer')),
			
		);
		if($filing_date!=''){
			$expenses['filing_date']=$filing_date;
		}
		if($file_receive_date!=''){
			$expenses['file_receive_date']=$file_receive_date;
		}
	    
		if($this->input->post('proposed_type')=='Card'){
	    	$expenses['org_ac_number']=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean( $this->input->post('hidden_loan_ac')));
	    }
	    if($this->input->post('req_type')!=''){
	    	$expenses['req_type']=$this->security->xss_clean( $this->input->post('req_type'));
	    }
	    if($this->input->post('region')!=''){
	    	$expenses['region']=$this->security->xss_clean( $this->input->post('region'));
	    }
	    if($this->input->post('territory')!=''){
	    	$expenses['territory']=$this->security->xss_clean( $this->input->post('territory'));
	    }
	    if($this->input->post('district')!=''){
	    	$expenses['district']=$this->security->xss_clean( $this->input->post('district'));
	    }

	    $status_data = array();
	    if($this->input->post('present_status')==3){
	    	$memo_date = $this->input->post('memo_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('memo_date')))):'';
	    	$gp_date = $this->input->post('gp_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('gp_date')))):'';
	    	$status_data['sts_3_type']=$this->security->xss_clean( $this->input->post('status'));
	    	$status_data['sts_3_memo_no']=$this->security->xss_clean( $this->input->post('lcr_memo_no'));
	    	$status_data['sts_3_memo_dt']=$memo_date;
	    	$status_data['sts_3_gp_no']=$this->security->xss_clean( $this->input->post('gp_no'));
	    	$status_data['sts_3_gp_dt']=$gp_date;
	    	
	    }elseif($this->input->post('present_status')==4){
	    	$status_data['sts_4_type']=$this->security->xss_clean( $this->input->post('status'));
	    	$status_data['sts_4_name']=$this->security->xss_clean( $this->input->post('name'));
	    	if($this->input->post('status')==1){
	    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
	    		$status_data['sts_4_date']=$sts_date;
	    	}
	    }elseif($this->input->post('present_status')==8){
	    	$status_data['sts_8_type']=$this->security->xss_clean( $this->input->post('status'));
	    }elseif($this->input->post('present_status')==19){
	    	$status_data['sts_19_type']=$this->security->xss_clean( $this->input->post('status'));
	    }elseif($this->input->post('present_status')==11){
	    	$status_data['sts_11_type']=$this->security->xss_clean( $this->input->post('status'));
	    	$status_data['sts_11_cname']=$this->security->xss_clean( $this->input->post('court_name'));
	    	if($this->input->post('status')==1){
	    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
	    		$status_data['sts_11_date']=$sts_date;
	    	}
	    }elseif($this->input->post('present_status')==12){
	    	$memo_date = $this->input->post('memo_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('memo_date')))):'';
	    	$gp_date = $this->input->post('gp_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('gp_date')))):'';
	    	$status_data['sts_12_memo_no']=$this->security->xss_clean( $this->input->post('lcr_memo_no'));
	    	$status_data['sts_12_memo_dt']=$memo_date;
	    	$status_data['sts_12_gp_no']=$this->security->xss_clean( $this->input->post('gp_no'));
	    	$status_data['sts_12_gp_dt']=$gp_date;
	    }elseif($this->input->post('present_status')==13){
	    	$withdrawn_date = $this->input->post('withdrawn_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('withdrawn_date')))):'';
	    	$status_data['sts_13_amount']=$this->security->xss_clean( $this->input->post('wp_amount'));
	    	$status_data['sts_13_date']=$withdrawn_date;
	    }elseif($this->input->post('present_status')==18){
	    	$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
	    	$status_data['sts_18_date']=$sts_date;
	    }else{
	    	if($this->input->post('present_status')>19){
	    		$status_data['sts_type']=$this->security->xss_clean( $this->input->post('status'));
		    	if($this->input->post('status')==1){
		    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
		    		//$status_data['sts_date']=$this->input->post('sts_date');
		    		$status_data['sts_date']=date('d/m/Y');
		    	}
	    	}else{
		    	$status_data['sts_'.$this->input->post('present_status').'_type']=$this->security->xss_clean( $this->input->post('status'));
		    	if($this->input->post('status')==1){
		    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
		    		$status_data['sts_'.$this->input->post('present_status').'_date']=$sts_date;
		    	}
	    	}
	    	
	    }

	    /*print_r($status_data);
	    echo json_encode($status_data,true);
	    exit;*/
	    $history_add = array(
		    		'present_status'=>$this->input->post('present_status'),
		    		'last_act'=>$this->input->post('last_activities'),
		    		'hc_bench'=>$this->input->post('hc_bench'),
		    		'bench_number'=>$this->input->post('bench_number'),
		    		//'hc_lawyer'=>$this->input->post('assigned_lawyer'),
		    		'remarks'=>$this->input->post('remarks'),
		    		'data_field'=>json_encode($status_data,true)
		    );
	    $his_id_expense = '';
		if($add_edit=="add")
		{
			$history_add['e_by']=$this->session->userdata['ast_user']['user_id'];
			$history_add['e_dt']=date('Y-m-d H:i:s');
			// new case update status change
			$history_add['v_sts']=39;

			$expenses['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['e_dt'] = date('Y-m-d H:i:s');
			$expenses['suit_id'] = $this->input->post('suit_id');
			$expenses['hc_id'] = $this->input->post('hc_id');
			$expenses['v_sts'] = 39;
			$expenses['verify'] = 39;
			$this->db->insert('hc_matter_ad', $expenses);
			$insert_idss = $this->db->insert_id();
			$history_add['hc_matter_id']=$insert_idss;
			$this->db->insert('hc_matter_hst_ad', $history_add);
			$his_id_expense=$this->db->insert_id();
			/*$status_data['last_entry_by']=$this->session->userdata['ast_user']['user_id'];
			$status_data['last_entry_dt']=date('Y-m-d H:i:s');
			$status_data['hc_matter_id']=$insert_idss;
			$this->db->insert('hc_matter_status_ad', $status_data);*/
		    $activities_id = 39;
		    $description_activities = 'Add AD Matter - ('.$insert_idss.')';
		}
		else
		{
			$history_add['u_by']=$this->session->userdata['ast_user']['user_id'];
			$history_add['u_dt']=date('Y-m-d H:i:s');
			// new case update status change
			$history_add['v_sts']=35;

	  		$expenses['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['u_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 35;
			$expenses['verify'] = 35;
			$this->db->where('id', $edit_id);
			$this->db->update('hc_matter_ad', $expenses);
			$this->db->where('id', $this->input->post('hist_id'));
			$this->db->update('hc_matter_hst_ad', $history_add);
			$his_id_expense=$this->input->post('hist_id');
			/*$status_data['last_entry_by']=$this->session->userdata['ast_user']['user_id'];
			$status_data['last_entry_dt']=date('Y-m-d H:i:s');
			$this->db->where('hc_matter_id', $edit_id);
			$this->db->update('hc_matter_status_ad', $status_data);*/
	  		$insert_idss = $edit_id;

	        $activities_id = 35;
	        $description_activities = 'Edit AD Matter - ('.$insert_idss.')';

		}
		
		// Expenses 
		$sql = "SELECT * from hc_matter_ad where id=$insert_idss AND sts=1";
	    $res = $this->db->query($sql);
	    $hc_matter = $res->row();
	    //print_r($hc_matter);exit;
		for($i=1;$i<= $_POST['expense_counter'];$i++)
        {
            $expense_data = array(
            'event_id' => $his_id_expense,
            'suit_id' => $insert_idss,
            'module_name' =>'AD Matter',
            'expense_type' =>$this->security->xss_clean( $this->input->post('expense_type_'.$i)),
            'activities_name' => $this->security->xss_clean( $this->input->post('activities_name_'.$i)),
            'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
            'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
            'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
            'vendor_name' => $this->security->xss_clean( $this->input->post('vendor_name_'.$i)),
            'vendor_id' => $this->security->xss_clean( $this->input->post('vendor_id_'.$i)),
            );
            if(isset($_POST['add_expense'])){
            // For skip The new deleted row
            if ($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==1) 
            {
                continue;
            }
            //For Delete the old row
            if ($_POST['expense_edit_'.$i]!=0 && $_POST['expense_delete_'.$i]==1) 
            {
            	$activities_id=15;
                $expense_data = array('sts' => 0,'v_sts'=>15);
                $expense_data['d_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['d_dt']=date('Y-m-d H:i:s');
                $this->db->where("id='".$_POST['expense_edit_'.$i]."'AND batch_no IS NULL");
                $this->db->update('expenses', $expense_data);
            }
            //For update the old row
            else if($_POST['expense_edit_'.$i]!=0 && $_POST['expense_delete_'.$i]!=1)
            {
            	$activities_id=35;
            	$expense_data['v_sts']=35;
            	$expense_data['u_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['u_dt']=date('Y-m-d H:i:s');
                $this->db->where("id='".$_POST['expense_edit_'.$i]."'AND batch_no IS NULL");
                $this->db->update('expenses', $expense_data);
            }
            //For insert the new row
            else if($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==0)
            {
            	$activities_id=39;
            	$expense_data['v_sts']=39;
            	$expense_data['event_id']=$his_id_expense;
            	$expense_data['suit_id']=$insert_idss;
            	$expense_data['proposed_type']=$hc_matter->proposed_type;
            	$expense_data['org_loan_ac']=$hc_matter->org_ac_number;
            	$expense_data['account_number']=$hc_matter->ac_number;
            	$expense_data['ac_name']=$hc_matter->ac_name;
            	$expense_data['req_type']=$hc_matter->req_type;
            	$expense_data['case_number']=$hc_matter->case_no;
            	$expense_data['e_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['e_dt']=date('Y-m-d H:i:s');
            	/*if($this->input->post('add_edit')=='edit'){
            		$expense_data['batch_no']=$this->input->post('batch_no');
            	}else{
            		$expense_data['batch_no']=time().$this->session->userdata['ast_user']['user_id'];
            	}*/
                $this->db->insert('expenses', $expense_data);
            }
        	}else{
        		if($add_edit=="edit"){
        			if ($_POST['expense_edit_'.$i]!=0) 
		            {
		            	$activities_id=15;
		                $expense_data = array('sts' => 0,'v_sts'=>15);
		                $expense_data['d_by']=$this->session->userdata['ast_user']['user_id'];
		            	$expense_data['d_dt']=date('Y-m-d H:i:s');
		                $this->db->where("id='".$_POST['expense_edit_'.$i]."'AND batch_no IS NULL");
		                $this->db->update('expenses', $expense_data);
		            }
        		}
        	}
            
        }

        // end expeses

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities($activities_id,'AD Matter',$insert_idss,$table_name,$description_activities);
			// echo $insert_idss;
			// exit;
			return $insert_idss;
		}
		}else{
			return validation_errors();
		}


	}

	function get_details_ad($id){
		$hc_matter_type = $this->input->post('hc_matter_type');
		$this->db->select('h.*,
			if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,
			
			d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,dm.name as deposit_am_50, 
			if(UNIX_TIMESTAMP(h.filing_date) IS NULL,"",DATE_FORMAT(h.filing_date,"%d/%m/%Y")) AS filing_date,
    		if(UNIX_TIMESTAMP(h.file_receive_date) IS NULL,"",DATE_FORMAT(h.file_receive_date,"%d/%m/%Y")) AS file_receive_date,
    		if(UNIX_TIMESTAMP(h.next_date) IS NULL,"",DATE_FORMAT(h.next_date,"%d/%m/%Y")) AS next_date,cat.name as case_category_name,ns.name as next_status_name,bn.name as bench_number
    		', FALSE)
			->from("hc_matter_ad h")
			->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
			->join('ref_appeal_deposit_money dm', 'dm.id=h.deposit_am_50', 'left')
			->join('ref_loan_segment ls', 'ls.id=h.portfolio', 'left')
			->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
			->join('ref_hc_case_status ns', 'ns.id=h.next_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
			->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
			->join('ref_hc_case_category cat', 'cat.id=h.case_category', 'left')
			->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
			->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
			->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
			->where(array('h.id'=>$id,'h.sts'=>1,'h.hc_matter_type'=>$hc_matter_type));
		$q=$this->db->get();
		$result = $q->row();
		//print_r($result);

		$this->db->select('m.*,cs.name as case_sts_name,hb.name as hc_bench_name,al.name as hc_lawyer_name, CONCAT(ue.name,"(",ue.pin,")") as e_by,concat(uv.name,"(",uv.pin,")") as v_by,bn.name as bench_number
    		', FALSE)
			->from("hc_matter_hst_ad m")
			->join('ref_hc_case_status cs', 'cs.id=m.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=m.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=m.bench_number', 'left')
			->join('ref_lawyer al', 'al.id=m.hc_lawyer', 'left')
			->join('users_info ue', 'ue.id=m.e_by', 'left')
			->join('users_info uv', 'uv.id=m.v_by', 'left')
			->where(array('m.sts'=>1,'m.hc_matter_id'=>$result->id));
		$q=$this->db->get();
		$history = $q->result();

		$this->db->select('e.*,et.name as expense_name, 
			pv.name as paper_name, l.name as lawyer_name, u.name as staff_name, d.name as district_name,a.name as activities_name
    		', FALSE)
			->from("expenses e")
			->join('ref_expense_type et', 'et.id=e.expense_type', 'left')
			->join('ref_paper_vendor pv', 'pv.id=e.vendor_id', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('users_info u', 'u.id=e.vendor_id', 'left')
			->join('ref_legal_district d', 'd.id=e.district', 'left')
			->join('ref_hc_activities a', 'a.id=e.activities_name', 'left')
			->where("e.suit_id=".$result->id." AND e.module_name ='AD Matter' AND e.sts<>0 AND e.v_sts NOT IN (91) ");
		$q=$this->db->get();
		$expense_data = $q->result();

		$html = '';
		$html.='<table style="width: 100%;" class="preview_table2" >
			<tr>
                <th width="20%" align="left"><strong>HC Case Type</strong></th>
                <td width="30%" align="left">'.$result->hc_matter_type.'</td>
                <th width="20%" align="left"><strong>Dealing Officer</strong></th>
                <td width="30%" align="left" >'.$result->hc_officer.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account Name</strong></th>
                <td width="30%" align="left" >'.$result->ac_name.'</td>
                <th width="20%" align="left"><strong>Lower Court Dealing officer</strong></th>
                <td width="30%" align="left" >'.$result->lower_officer.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account No</strong></th>
                <td width="30%" align="left" >'.$result->ac_number.'</td>
                <th width="20%" align="left"><strong>Case Category</strong></th>
                <td width="30%" align="left" >'.$result->case_category_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Portfolio</strong></th>
                <td width="30%" align="left" >'.$result->portfolio_name.'</td>
                <th width="20%" align="left"><strong>Case Types</strong></th>
                <td width="30%" align="left" >'.$result->hc_type_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>H. C. Mater number</strong></th>
                <td width="30%" align="left" >'.$result->case_no.'</td>
                <th width="20%" align="left"><strong>Present Status</strong></th>
                <td width="30%" align="left" >'.$result->case_sts_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Filing Date</strong></th>
                <td width="30%" align="left" >'.$result->filing_date.'</td>
                <th width="20%" align="left"><strong>Next Status</strong></th>
                <td width="30%" align="left" >'.$result->next_status.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>Name Of DIST</strong></th>
                <td width="30%" align="left" >'.$result->district_name.'</td>
                <th width="20%" align="left"><strong>Next Date</strong></th>
                <td width="30%" align="left" >'.$result->next_date.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>Bench Name</strong></th>
                <td width="30%" align="left" >'.$result->hc_bench_name.'</td>
                <th width="20%" align="left"><strong>Year</strong></th>
                <td width="30%" align="left" >'.$result->year.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Last Activities</strong></th>
                <td width="30%" align="left" >'.$result->last_act.'</td>
                <th width="20%" align="left"><strong>Lawyer Name</strong></th>
                <td width="30%" align="left" >'.$result->assigned_lawyer_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Bench Number</strong></th>
                <td width="30%" align="left" >'.$result->bench_number.'</td>
                <th width="20%" align="left"><strong>File Receive Date</strong></th>
                <td width="30%" align="left" >'.$result->file_receive_date.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Subject matter/cause of action</strong></th>
                <td width="30%" align="left" >'.$result->present_cause_action.'</td>
                <th width="20%" align="left"><strong>50% Deposited Appeal money</strong></th>
                <td width="30%" align="left" >'.$result->deposit_am_50.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>A/C Closing Status</strong></th>
                <td width="30%" align="left" >'.$result->ac_closing_status.'</td>
                <th width="20%" align="left"><strong>Case Claim</strong></th>
                <td width="30%" align="left" >'.$result->case_claim.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Remarks</strong></th>
                <td width="30%" align="left" >'.$result->remarks.'</td>
                <th width="20%" align="left"><strong>File</strong></th>
                <td width="30%" align="left" >';
                if($result->files!=''){
                $html.='<img id="file_preview_wa_scan_copy" onclick="popup(\''.base_url().'cma_file/hc_ad_file/'.$result->files.'\')" style=" cursor:pointer;text-align:center" src="'.base_url().'old_assets/images/print-preview.png" height="18">';
            	}
                 $html.='</td>
            </tr>
            
            </table>';
            $html.='<h4>Status History</h4><table style="width: 100%;" class="preview_table2">
            	<thead>
            		<tr>
            			<th>Sl</th>
            			<th>Case Status</th>
            			<th>Details</th>
            			<th>Case Activities</th>
            			<th>Remarks</th>
            			<th>Entry By</th>
            			<th>Entry Date</th>
            			<th>Verify By</th>
            			<th>Verify Date</th>
            		</tr>
            	</thead>
            	<tbody>';
            	foreach($history as $ke=>$hist){
            		$i=$ke+1;
            		$html.='<tr>
            			<td>'.$i.'</td>
            			<td>'.$hist->case_sts_name.'</td>
            			<td>';
            			$json = json_decode($hist->data_field);
            			$i=1;
            			if($hist->present_status>19){
							$type = 'sts_type';
						}else{
							$type = 'sts_'.$hist->present_status.'_type';
						}
							
            			foreach($json as $k=>$val){
            				$a='';
            				if($k=='sts_4_name'){
            					$res = $this->Common_model->get_row_data('ref_lawyer',array('id'=>$val,'data_status'=>1));
            					$a=$res->name;
            				}else if($k==$type){
								if($val=='1'){
			    					$a='Yes';
			    				}else if($val=='2'){
			    					$a='No';
			    				}else{
			    					$a=$val;
			    				}
							}else{
	            				$a=$val;
	            				
            				}
            				$html.=$a;
            				if($i!=count((array)$json)){
            					$html.=';';
            				}
            				$i++;
            			}
            			$html.='</td>
            			<td>'.$hist->last_act.'</td>
            			<td>'.$hist->remarks.'</td>
            			<td>'.$hist->e_by.'</td>
            			<td>'.$hist->e_dt.'</td>
            			<td>'.$hist->v_by.'</td>
            			<td>'.$hist->v_dt.'</td>
            		</tr>';
            	}
            	$html.='</tbody>
            </table>';
            $html.='<h4>Expence Details</h4><table style="width: 100%;" class="preview_table2">
            	<thead>
            		<tr>
            			<th>Expense Type</th>
            			<th>District</th>
            			<th>Vendor Name</th>
            			<th>Activities Name</th>
            			<th>Activities Date</th>
            			<th>Total Amount</th>
            			<th>Remarks</th>
            		</tr>
            	</thead>
            	<tbody>';
            	foreach($expense_data as $key=>$row){
            		$html.='<tr>
            			<td>'.$row->expense_name.'</td>';
            			if($row->expense_type==1){
            				$html.='<td></td>';
            		 		$html.='<td>'.$row->lawyer_name.'</td>';
            			}
            			elseif($row->expense_type==2){
            				$html.='<td></td>';
            				$html.='<td>'.$row->paper_name.'</td>';
            			}
            			elseif($row->expense_type==3){
            				$html.='<td>'.$row->district_name.'</td>';
            				$html.='<td>'.$row->staff_name.'</td>';
            			}else{
            				$html.='<td></td>';
            				$html.='<td>'.$row->vendor_name.'</td>';
            			}
            		 $html.='<td>'.$row->activities_name.'</td>
            			<td>'.$row->activities_date.'</td>
            			<td>'.$row->amount.'</td>
            			<td>'.$row->remarks.'</td>
            		</tr>';
            	}
            	$html.='</tbody>
            </table>';
		return $html;
	}
	function get_data_details_preview_ad($id){
		$hc_matter_type = $this->input->post('hc_matter_type');
		$this->db->select('h.*,
			if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,
			
			d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,dm.name as deposit_am_50, 
			if(UNIX_TIMESTAMP(h.filing_date) IS NULL,"",DATE_FORMAT(h.filing_date,"%d/%m/%Y")) AS filing_date,
    		if(UNIX_TIMESTAMP(h.file_receive_date) IS NULL,"",DATE_FORMAT(h.file_receive_date,"%d/%m/%Y")) AS file_receive_date,
    		if(UNIX_TIMESTAMP(h.next_date) IS NULL,"",DATE_FORMAT(h.next_date,"%d/%m/%Y")) AS next_date,cat.name as case_category_name,ns.name as next_status_name,bn.name as bench_number
    		', FALSE)
			->from("hc_matter_ad h")
			->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
			->join('ref_appeal_deposit_money dm', 'dm.id=h.deposit_am_50', 'left')
			->join('ref_loan_segment ls', 'ls.id=h.portfolio', 'left')
			->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
			->join('ref_hc_case_status ns', 'ns.id=h.next_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
			->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
			->join('ref_hc_case_category cat', 'cat.id=h.case_category', 'left')
			->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
			->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
			->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
			->where(array('h.id'=>$id,'h.sts'=>1,'h.hc_matter_type'=>$hc_matter_type));
		$q=$this->db->get();
		$result = $q->row();
		//print_r($result);

		$this->db->select('m.*,cs.name as case_sts_name,hb.name as hc_bench_name,al.name as hc_lawyer_name, CONCAT(ue.name,"(",ue.pin,")") as e_by,concat(uv.name,"(",uv.pin,")") as v_by,bn.name as bench_number
    		', FALSE)
			->from("hc_matter_hst_ad m")
			->join('ref_hc_case_status cs', 'cs.id=m.present_status', 'left')
			->join('ref_hc_bench hb', 'hb.id=m.hc_bench', 'left')
			->join('ref_hc_bench_number bn', 'bn.id=m.bench_number', 'left')
			->join('ref_lawyer al', 'al.id=m.hc_lawyer', 'left')
			->join('users_info ue', 'ue.id=m.e_by', 'left')
			->join('users_info uv', 'uv.id=m.v_by', 'left')
			->where(array('m.sts'=>1,'m.hc_matter_id'=>$result->id));
		$q=$this->db->get();
		$history = $q->result();

		$this->db->select('e.*,et.name as expense_name, 
			pv.name as paper_name, l.name as lawyer_name, u.name as staff_name, d.name as district_name,a.name as activities_name
    		', FALSE)
			->from("cost_details e")
			->join('ref_expense_type et', 'et.id=e.vendor_type', 'left')
			->join('ref_paper_vendor pv', 'pv.id=e.vendor_id', 'left')
			->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
			->join('users_info u', 'u.id=e.vendor_id', 'left')
			->join('ref_legal_district d', 'd.id=e.district', 'left')
			->join('ref_hc_activities a', 'a.id=e.activities_id', 'left')
			->where("e.suit_id=".$this->db->escape($result->id)." AND e.module_name ='high_court' AND e.main_table_name ='hc_matter_hst_ad' ");
		$q=$this->db->get();
		$expense_data = $q->result();

		$html = '';
		$html.='<table style="width: 100%;" class="preview_table2" >
			<tr>
                <th width="20%" align="left"><strong>HC Case Type</strong></th>
                <td width="30%" align="left">'.$result->hc_matter_type.'</td>
                <th width="20%" align="left"><strong>Dealing Officer</strong></th>
                <td width="30%" align="left" >'.$result->hc_officer.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account Name</strong></th>
                <td width="30%" align="left" >'.$result->ac_name.'</td>
                <th width="20%" align="left"><strong>Lower Court Dealing officer</strong></th>
                <td width="30%" align="left" >'.$result->lower_officer.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Account No</strong></th>
                <td width="30%" align="left" >'.$result->ac_number.'</td>
                <th width="20%" align="left"><strong>Case Category</strong></th>
                <td width="30%" align="left" >'.$result->case_category_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Portfolio</strong></th>
                <td width="30%" align="left" >'.$result->portfolio_name.'</td>
                <th width="20%" align="left"><strong>Case Types</strong></th>
                <td width="30%" align="left" >'.$result->hc_type_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>H. C. Mater number</strong></th>
                <td width="30%" align="left" >'.$result->case_no.'</td>
                <th width="20%" align="left"><strong>Present Status</strong></th>
                <td width="30%" align="left" >'.$result->case_sts_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Filing Date</strong></th>
                <td width="30%" align="left" >'.$result->filing_date.'</td>
                <th width="20%" align="left"><strong>Next Status</strong></th>
                <td width="30%" align="left" >'.$result->next_status.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>Name Of DIST</strong></th>
                <td width="30%" align="left" >'.$result->district_name.'</td>
                <th width="20%" align="left"><strong>Next Date</strong></th>
                <td width="30%" align="left" >'.$result->next_date.'</td>
            </tr>
            <tr>
            	<th width="20%" align="left"><strong>Bench Name</strong></th>
                <td width="30%" align="left" >'.$result->hc_bench_name.'</td>
                <th width="20%" align="left"><strong>Year</strong></th>
                <td width="30%" align="left" >'.$result->year.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Last Activities</strong></th>
                <td width="30%" align="left" >'.$result->last_act.'</td>
                <th width="20%" align="left"><strong>Lawyer Name</strong></th>
                <td width="30%" align="left" >'.$result->assigned_lawyer_name.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Bench Number</strong></th>
                <td width="30%" align="left" >'.$result->bench_number.'</td>
                <th width="20%" align="left"><strong>File Receive Date</strong></th>
                <td width="30%" align="left" >'.$result->file_receive_date.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Subject matter/cause of action</strong></th>
                <td width="30%" align="left" >'.$result->present_cause_action.'</td>
                <th width="20%" align="left"><strong>50% Deposited Appeal money</strong></th>
                <td width="30%" align="left" >'.$result->deposit_am_50.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>A/C Closing Status</strong></th>
                <td width="30%" align="left" >'.$result->ac_closing_status.'</td>
                <th width="20%" align="left"><strong>Case Claim</strong></th>
                <td width="30%" align="left" >'.$result->case_claim.'</td>
            </tr>
            <tr>
                <th width="20%" align="left"><strong>Remarks</strong></th>
                <td width="30%" align="left" >'.$result->remarks.'</td>
                <th width="20%" align="left"><strong></strong></th>
                <td width="30%" align="left" ></td>
            </tr>
            
            </table>';
            $html.='<h4>Status History</h4><table style="width: 100%;" class="preview_table2">
            	<thead>
            		<tr>
            			<th>Sl</th>
            			<th>Case Status</th>
            			<th>Details</th>
            			<th>Case Activities</th>
            			<th>Remarks</th>
            			<th>Entry By</th>
            			<th>Entry Date</th>
            			<th>Verify By</th>
            			<th>Verify Date</th>
            		</tr>
            	</thead>
            	<tbody>';
            	foreach($history as $ke=>$hist){
            		$i=$ke+1;
            		$html.='<tr>
            			<td>'.$i.'</td>
            			<td>'.$hist->case_sts_name.'</td>
            			<td>';
            			$json = json_decode($hist->data_field);
            			$i=1;
            			if($hist->present_status>19){
							$type = 'sts_type';
						}else{
							$type = 'sts_'.$hist->present_status.'_type';
						}
							
            			foreach($json as $k=>$val){
            				$a='';
            				if($k=='sts_4_name'){
            					$res = $this->Common_model->get_row_data('ref_lawyer',array('id'=>$val,'data_status'=>1));
            					$a=$res->name;
            				}else if($k==$type){
								if($val=='1'){
			    					$a='Yes';
			    				}else if($val=='2'){
			    					$a='No';
			    				}else{
			    					$a=$val;
			    				}
							}else{
	            				$a=$val;
	            				
            				}
            				$html.=$a;
            				if($i!=count((array)$json)){
            					$html.=';';
            				}
            				$i++;
            			}
            			$html.='</td>
            			<td>'.$hist->last_act.'</td>
            			<td>'.$hist->remarks.'</td>
            			<td>'.$hist->e_by.'</td>
            			<td>'.$hist->e_dt.'</td>
            			<td>'.$hist->v_by.'</td>
            			<td>'.$hist->v_dt.'</td>
            		</tr>';
            	}
            	$html.='</tbody>
            </table>';
            $html.='<h4>Expence Details</h4><table style="width: 100%;" class="preview_table2">
            	<thead>
            		<tr>
            			<th>Expense Type</th>
            			<th>District</th>
            			<th>Vendor Name</th>
            			<th>Activities Name</th>
            			<th>Activities Date</th>
            			<th>Total Amount</th>
            			<th>Remarks</th>
            		</tr>
            	</thead>
            	<tbody>';
            	$total=0;
            	foreach($expense_data as $key=>$row){
            		$total +=$row->amount;
            		$html.='<tr>
            			<td>'.$row->expense_name.'</td>';
            			if($row->vendor_type==1){
            				$html.='<td></td>';
            		 		$html.='<td>'.$row->lawyer_name.'</td>';
            			}
            			elseif($row->vendor_type==2){
            				$html.='<td></td>';
            				$html.='<td>'.$row->paper_name.'</td>';
            			}
            			elseif($row->vendor_type==3){
            				$html.='<td>'.$row->district_name.'</td>';
            				$html.='<td>'.$row->staff_name.'</td>';
            			}else{
            				$html.='<td></td>';
            				$html.='<td>'.$row->vendor_name.'</td>';
            			}
            		 $html.='<td>'.$row->activities_name.'</td>
            			<td>'.$row->txrn_dt.'</td>
            			<td>'.$row->amount.'</td>
            			<td>'.$row->expense_remarks.'</td>
            		</tr>';
            	}
            	$html.='</tbody>
            	<thead>
            		<tr>
            			<th colspan="5" style="text-align:right;">Activities Date</th>
            			<th>'.$total.'</th>
            			<th></th>
            		</tr>
            	</thead>
            </table>';
		return $html;
	}
	function get_case_edit_info_ad($id){
		$this->db->select('a.*,h.id as hist_id,
			if(UNIX_TIMESTAMP(a.filing_date) IS NULL,"",DATE_FORMAT(a.filing_date,"%d/%m/%Y")) AS filing_date,
			if(UNIX_TIMESTAMP(a.next_date) IS NULL,"",DATE_FORMAT(a.next_date,"%d/%m/%Y")) AS next_date,
    		if(UNIX_TIMESTAMP(a.file_receive_date) IS NULL,"",DATE_FORMAT(a.file_receive_date,"%d/%m/%Y")) AS file_receive_date,h.data_field
			', FALSE)
			->from("hc_matter_ad a")
			->join('hc_matter_hst_ad h', 'h.hc_matter_id=a.id AND h.v_sts IN (35,39,90)', 'left')
			->where("a.id='".$id."'", NULL, FALSE)
			->limit(1);
		$q=$this->db->get();
		$result = $q->row();
		return $result;
	}

	function delete_action_ad(){

		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "hc_matter_ad";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';

		$this->db->select('*');
		$this->db->from('hc_matter_hst_ad');
		$this->db->where(array('hc_matter_id'=>$_POST['verifyid'],'sts'=>1));
		$this->db->limit(1);
		$this->db->order_by('id','DESC');
		$data_res = $this->db->get()->row();

		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_ad',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('hc_matter_ad', $data);
				$activities_id = 15;
				$description_activities = 'Delete AD Matter - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason =trim($_POST['comments']);

				// Expense
				
				$hc_id_expense = $_POST['deleteEventId']; // suit_id for expese
				
				$data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$where = "suit_id=".$hc_id_expense." AND module_name='AD Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
			}
			
		}
		if($this->input->post('type')=='sendtochecker'){
			
			$pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_ad',$_POST['verifyid'],37,'v_sts');

			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts'=>37,'s_by'=> $this->session->userdata['ast_user']['user_id'], 's_dt'=>date('Y-m-d H:i:s'),'verify'=>37);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('hc_matter_ad', $data);
				$data = array('s_by'=> $this->session->userdata['ast_user']['user_id'], 's_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);

				$this->db->where("hc_matter_id=".$_POST['verifyid']." AND v_sts IN (35,39)");
				$this->db->update('hc_matter_hst_ad', $data);
				$activities_id = 37;
				$description_activities = 'Send to Checker AD Matter - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];

				// Expense
				
				$his_id_expense= $data_res->id;
				$hc_id_expense = $_POST['verifyid']; // suit_id for expese
				
				$data = array('stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
				$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='AD Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
				
			}
		}
		if($this->input->post('type')=='verify_return'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_ad',$_POST['verifyid'],'90,38,91','v_sts');

            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
            	$data = array('r_reason'=>$_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'),'v_sts'=>90,'verify'=>90);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('hc_matter_ad', $data);

				$data = array('r_reason'=>$_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'),'v_sts'=>90);
				$this->db->where(array('hc_matter_id'=>$_POST['verifyid'],'v_sts'=>37));
				$this->db->update('hc_matter_hst_ad', $data);

				$his_id_expense= $data_res->id; // event_id
				$hc_id_expense = $_POST['verifyid']; // suit_id

            	$data = array('r_reason'=>$_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'),'v_sts'=>90);

				$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='AD Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
                
                $reason=$_POST['return_reason_verify'];
                $activities_id = 90;
				$description_activities = 'Return HC Matter Expence- ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];

            }
            
        }
        if($this->input->post('type')=='verify_reject'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_ad',$_POST['verifyid'],'91,38','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {

            	$data = array('reject_reason'=>$_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'),'v_sts'=>91,'verify'=>91);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('hc_matter_ad', $data);

				$data = array('reject_reason'=>$_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'),'v_sts'=>91);
				$this->db->where(array('hc_matter_id'=>$_POST['verifyid'],'v_sts'=>37));
				$this->db->update('hc_matter_hst_ad', $data);

				$his_id_expense= $data_res->id; // event_id
				$hc_id_expense = $_POST['verifyid']; // suit_id

            	$data = array('reject_reason'=>$_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'),'v_sts'=>91);
            	$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='AD Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
                
                $reason=$_POST['return_reason_verify'];
                $activities_id = 91;
				$description_activities = 'Reject HC Matter Expence- ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];
                
            }
            
        }
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_ad',$_POST['verifyid'],38,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				/*$this->db->select('*');
				$this->db->from('hc_matter_hst_ad');
				$this->db->where(array('hc_matter_id'=>$_POST['verifyid'],'sts'=>1));
				$this->db->limit(1);
				$data_res = $this->db->get()->row();*/
				$obj = json_decode($data_res->data_field);
				$status_data=array();
				foreach($obj as $key => $val){
					// Check Date Data
					if (preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $val, $matches)) {
    					if (checkdate($matches[2], $matches[1], $matches[3])) {
						$status_data[$key]=date('Y-m-d',strtotime(str_replace('/', '-',$val)));
						}else{
							$status_data[$key]=$val;
						}
					}else{
						$status_data[$key]=$val;
					}
				}
				

				$status_data['last_entry_by']=$this->session->userdata['ast_user']['user_id'];
				$status_data['last_entry_dt']=date('Y-m-d H:i:s');
				$this->db->select('*');
				$this->db->from('hc_matter_status_ad');
				$this->db->where(array('hc_matter_id'=>$_POST['verifyid']));
				$exit_row = $this->db->get()->result();
				if(count($exit_row)>0){
					$this->db->where('id', $exit_row[0]->id);
					$this->db->update('hc_matter_status_ad', $status_data);
				}else{
					$status_data['hc_matter_id']=$_POST['verifyid'];
					$this->db->insert('hc_matter_status_ad', $status_data);
				}

				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38,'verify'=>38);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('hc_matter_ad', $data);

				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
				$this->db->where(array('hc_matter_id'=>$_POST['verifyid'],'v_sts'=>37));
				$this->db->update('hc_matter_hst_ad', $data);

				$activities_id = 38;
				$description_activities = 'Verify AD Matter - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];


				// Expense
				$his_id_expense= $data_res->id;
				$hc_id_expense = $_POST['verifyid']; // suit_id for expese
				
				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
				$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='AD Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);

				//Genereate Expenses
                $str="SELECT  j0.*,h.proposed_type,h.ac_number,h.org_ac_number,h.ac_name,h.case_no,h.case_type,h.portfolio,h.region,h.territory,h.district
                        FROM expenses j0
                        LEFT JOIN hc_matter_ad as h
						ON h.id = j0.suit_id
                     WHERE j0.sts != '0'  AND j0.event_id= '".$his_id_expense."' AND j0.suit_id='".$hc_id_expense."' AND j0.module_name='AD Matter'";   
                $expense_data=$this->db->query($str)->result();
                //echo $this->db->last_query();
                //print_r($expense_data);
                if (!empty($expense_data)) {
                        foreach ($expense_data as $key) {
                        	if($key->proposed_type=='Loan' && $key->ac_number!='' && $key->ac_number!=NULL)
							{
								if(strlen($key->ac_number)==16)
								{
									$cif = substr($key->ac_number,5,8);
								}
								else if(strlen($key->ac_number)==13)
								{
									$cif = substr($key->ac_number,1,8);
								}
								else
								{
									$cif = "";
								}
							}
							else
							{
								$cif = "";
							}
                            $cost_data = array(
                            'module_name' => 'high_court',
                            'main_table_name' => 'hc_matter_hst_ad',
                            'main_table_id' => $key->event_id,
                            'sub_table_name' => 'expenses',
                            'sub_table_id' => $key->id,
                            'suit_id' => $key->suit_id,
                            'activities_id' => $key->activities_name,
                            'vendor_type' => $key->expense_type,
                            'vendor_id' => $key->vendor_id,
                            'vendor_name' => $key->vendor_name,
                            'amount' =>$key->amount,
                            'txrn_dt' => $key->activities_date,
                            'proposed_type' => $key->proposed_type,
                            'loan_ac' => $key->ac_number,
                            'cif' => $cif,
                            'org_loan_ac' => $key->org_ac_number,
                            'ac_name' => $key->ac_name,
                            'case_number' => $key->case_no,
                            'req_type' => $key->case_type,
                            'loan_segment' => $key->portfolio,
                            'region' => $key->region,
                            'territory' => $key->territory,
                            'district' => $key->district,
                            'expense_remarks' =>$key->remarks
                        );
                            //print_r($cost_data);
                        $data3=$this->user_model->cost_details($cost_data);

                    }
                    $activities_id = 38;
					$description_activities_expense = 'Verify AD Matter Expence- ('.$data_res->id.')';
					$this->User_model->user_activities_bill($activities_id,'expenses',$data_res->id,'hc_matter_hst_ad',$description_activities_expense,$reason);
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
			$this->User_model->user_activities($activities_id,'suit_file',$row_id,$table_name,$description_activities,$reason);
			$this->db->trans_commit();

			$this->db->db_debug = $db_debug;
			return $row_id;
		}
	}


	// Appeal Division Case Status Update

	function get_case_info_ad($id){
		$this->db->select('e.*,e.id as history_id,st.*,st.id as sts_id,os.name as old_present_sts_name, s.name as present_sts_name, ohb.name as old_hcbench,hb.name as p_hc_bench, ohcl.name as old_hc_lawyer, hcl.name as p_hc_lawyer,h.case_type,
			if(UNIX_TIMESTAMP(st.sts_10_date) IS NULL,"",DATE_FORMAT(st.sts_10_date,"%d/%m/%Y")) AS sts_10_date,
			if(UNIX_TIMESTAMP(st.sts_11_date) IS NULL,"",DATE_FORMAT(st.sts_11_date,"%d/%m/%Y")) AS sts_11_date,
			if(UNIX_TIMESTAMP(st.sts_12_gp_dt) IS NULL,"",DATE_FORMAT(st.sts_12_gp_dt,"%d/%m/%Y")) AS sts_12_gp_dt,
			if(UNIX_TIMESTAMP(st.sts_12_memo_dt) IS NULL,"",DATE_FORMAT(st.sts_12_memo_dt,"%d/%m/%Y")) AS sts_12_memo_dt,
			if(UNIX_TIMESTAMP(st.sts_13_date) IS NULL,"",DATE_FORMAT(st.sts_13_date,"%d/%m/%Y")) AS sts_13_date,
			if(UNIX_TIMESTAMP(st.sts_14_date) IS NULL,"",DATE_FORMAT(st.sts_14_date,"%d/%m/%Y")) AS sts_14_date,
			if(UNIX_TIMESTAMP(st.sts_15_date) IS NULL,"",DATE_FORMAT(st.sts_15_date,"%d/%m/%Y")) AS sts_15_date,
			if(UNIX_TIMESTAMP(st.sts_16_date) IS NULL,"",DATE_FORMAT(st.sts_16_date,"%d/%m/%Y")) AS sts_16_date,
			if(UNIX_TIMESTAMP(st.sts_17_date) IS NULL,"",DATE_FORMAT(st.sts_17_date,"%d/%m/%Y")) AS sts_17_date,
			if(UNIX_TIMESTAMP(st.sts_18_date) IS NULL,"",DATE_FORMAT(st.sts_18_date,"%d/%m/%Y")) AS sts_18_date,
			if(UNIX_TIMESTAMP(st.sts_1_date) IS NULL,"",DATE_FORMAT(st.sts_1_date,"%d/%m/%Y")) AS sts_1_date,
			if(UNIX_TIMESTAMP(st.sts_2_date) IS NULL,"",DATE_FORMAT(st.sts_2_date,"%d/%m/%Y")) AS sts_2_date,
			if(UNIX_TIMESTAMP(st.sts_3_gp_dt) IS NULL,"",DATE_FORMAT(st.sts_3_gp_dt,"%d/%m/%Y")) AS sts_3_gp_dt,
			if(UNIX_TIMESTAMP(st.sts_3_memo_dt) IS NULL,"",DATE_FORMAT(st.sts_3_memo_dt,"%d/%m/%Y")) AS sts_3_memo_dt,
			if(UNIX_TIMESTAMP(st.sts_4_date) IS NULL,"",DATE_FORMAT(st.sts_4_date,"%d/%m/%Y")) AS sts_4_date,
			if(UNIX_TIMESTAMP(st.sts_5_date) IS NULL,"",DATE_FORMAT(st.sts_5_date,"%d/%m/%Y")) AS sts_5_date,
			if(UNIX_TIMESTAMP(st.sts_6_date) IS NULL,"",DATE_FORMAT(st.sts_6_date,"%d/%m/%Y")) AS sts_6_date,
			if(UNIX_TIMESTAMP(st.sts_7_date) IS NULL,"",DATE_FORMAT(st.sts_7_date,"%d/%m/%Y")) AS sts_7_date,
			if(UNIX_TIMESTAMP(st.sts_9_date) IS NULL,"",DATE_FORMAT(st.sts_9_date,"%d/%m/%Y")) AS sts_9_date,
			if(UNIX_TIMESTAMP(st.sts_date) IS NULL,"",DATE_FORMAT(st.sts_date,"%d/%m/%Y")) AS sts_date,
			if(UNIX_TIMESTAMP(e.previous_date) IS NULL,"",DATE_FORMAT(e.previous_date,"%d/%m/%Y")) AS previous_date,
			if(UNIX_TIMESTAMP(e.previous_date_old) IS NULL,"",DATE_FORMAT(e.previous_date_old,"%d/%m/%Y")) AS previous_date_old
			', FALSE)
			->from("hc_matter_hst_ad e")
			->join('ref_case_sts os', 'os.id=e.present_status_old', 'left')
			->join('ref_case_sts s', 's.id=e.present_status', 'left')
			->join('ref_hc_bench ohb', 'ohb.id=e.hc_bench_old', 'left')
			->join('ref_hc_bench hb', 'hb.id=e.hc_bench', 'left')
			->join('ref_lawyer ohcl', 'ohcl.id=e.hc_lawyer_old', 'left')
			->join('ref_lawyer hcl', 'hcl.id=e.hc_lawyer', 'left')
			->join('hc_matter_ad h', 'h.id=e.hc_matter_id', 'left')
			->join('hc_matter_status_ad st', 'st.hc_matter_id=e.hc_matter_id', 'left')
			->where("e.hc_matter_id='".$id."' AND e.v_sts IN (38)", NULL, FALSE)
			->order_by("e.id", "DESC")
			->limit(1);
		$q=$this->db->get();
		$result = $q->row();
		return $result;
	}

	function add_edit_case_status_update_ad($add_edit,$edit_row=null){
		$this->db->trans_begin();
        $editrow=0;
	    $table_name = "hc_matter_ad";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";

	    $this->form_validation->set_rules('hc_id', 'hc_id', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('disposal_sts', 'disposal_sts', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('hc_matter_id', 'hc_matter_id', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('case_sts', 'case_sts', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('last_act', 'last_act', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('hc_bench', 'hc_bench', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('bench_number', 'bench_number', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('previous_date', 'previous_date', 'trim|required|xss_clean');
	    //$this->form_validation->set_rules('hc_lawyer', 'hc_lawyer', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('remarks', 'remarks', 'trim|xss_clean');

	    $this->form_validation->set_rules('pre_case_sts', 'pre_case_sts', 'trim|xss_clean');
	    $this->form_validation->set_rules('pre_last_act', 'pre_last_act', 'trim|xss_clean');
	    $this->form_validation->set_rules('pre_hc_bench', 'pre_hc_bench', 'trim|xss_clean');
	    //$this->form_validation->set_rules('pre_hc_lawyer', 'pre_hc_lawyer', 'trim|xss_clean');
	    $this->form_validation->set_rules('pre_remarks', 'pre_remarks', 'trim|xss_clean');

	    if($this->input->post('case_sts')==3){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('lcr_memo_no', 'lcr_memo_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('memo_date', 'memo_date', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_no', 'gp_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_date', 'gp_date', 'trim|required|xss_clean');
	    }elseif($this->input->post('case_sts')==4){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
	    	if($this->input->post('status')==1){
	    		$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
	    	}
	    }elseif($this->input->post('case_sts')==8||$this->input->post('case_sts')==19){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    }elseif($this->input->post('case_sts')==11){
	    	$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('court_name', 'court_name', 'trim|required|xss_clean');
	    	if($this->input->post('status')==1){
	    		$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
	    	}
	    }elseif($this->input->post('case_sts')==12){
	    	$this->form_validation->set_rules('lcr_memo_no', 'lcr_memo_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('memo_date', 'memo_date', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_no', 'gp_no', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('gp_date', 'gp_date', 'trim|required|xss_clean');
	    }elseif($this->input->post('case_sts')==13){
	    	$this->form_validation->set_rules('wp_amount', 'wp_amount', 'trim|required|xss_clean');
	    	$this->form_validation->set_rules('withdrawn_date', 'withdrawn_date', 'trim|required|xss_clean');
	    }elseif($this->input->post('case_sts')==18){
	    	$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
	    }else{
	    	if($this->input->post('case_sts')>19){
	    		$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
	    	}else{
	    		$this->form_validation->set_rules('status', 'status', 'trim|required|xss_clean');
		    	if($this->input->post('status')==1){
		    		$this->form_validation->set_rules('sts_date', 'sts_date', 'trim|required|xss_clean');
		    	}
	    	}
	    	
	    }
	    
	    if ($this->form_validation->run() == TRUE){
	    	
			
	    //$last_act_date = $this->input->post('last_act_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('last_act_date')))):'';
	    //$pre_last_act_date = $this->input->post('pre_last_act_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('pre_last_act_date')))):'';

	    $hc_matter = $hc_present=array();
	    $previous_date = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('previous_date'))));

	    $hc_present = array(
			'present_status' =>$this->security->xss_clean( $this->input->post('case_sts')),
			'last_act' =>$this->security->xss_clean( $this->input->post('last_act')),
			'bench_number' =>$this->security->xss_clean( $this->input->post('bench_number')),
			'hc_bench' =>$this->security->xss_clean( $this->input->post('hc_bench')),
			'final_sts' =>$this->security->xss_clean( $this->input->post('disposal_sts')),
			'previous_date' =>$previous_date,
			//'hc_lawyer' =>$this->security->xss_clean( $this->input->post('hc_lawyer')),
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),
		);
	    //$hc_present = array();
	    
		

		$status_data = array();
	    if($this->input->post('case_sts')==3){
	    	$memo_date = $this->input->post('memo_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('memo_date')))):'';
	    	$gp_date = $this->input->post('gp_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('gp_date')))):'';
	    	$status_data['sts_3_type']=$this->security->xss_clean( $this->input->post('status'));
	    	$status_data['sts_3_memo_no']=$this->security->xss_clean( $this->input->post('lcr_memo_no'));
	    	$status_data['sts_3_memo_dt']=$this->input->post('memo_date');
	    	$status_data['sts_3_gp_no']=$this->security->xss_clean( $this->input->post('gp_no'));
	    	$status_data['sts_3_gp_dt']=$this->input->post('gp_date');
	    	
	    }elseif($this->input->post('case_sts')==4){
	    	$status_data['sts_4_type']=$this->security->xss_clean( $this->input->post('status'));
	    	$status_data['sts_4_name']=$this->security->xss_clean( $this->input->post('name'));
	    	if($this->input->post('status')==1){
	    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
	    		$status_data['sts_4_date']=$this->input->post('sts_date');
	    	}
	    }elseif($this->input->post('case_sts')==8){
	    	$status_data['sts_8_type']=$this->security->xss_clean( $this->input->post('status'));
	    }elseif($this->input->post('case_sts')==19){
	    	$status_data['sts_19_type']=$this->security->xss_clean( $this->input->post('status'));
	    }elseif($this->input->post('case_sts')==11){
	    	$status_data['sts_11_type']=$this->security->xss_clean( $this->input->post('status'));
	    	$status_data['sts_11_cname']=$this->security->xss_clean( $this->input->post('court_name'));
	    	if($this->input->post('status')==1){
	    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
	    		$status_data['sts_11_date']=$this->input->post('sts_date');
	    	}
	    }elseif($this->input->post('case_sts')==12){
	    	$memo_date = $this->input->post('memo_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('memo_date')))):'';
	    	$gp_date = $this->input->post('gp_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('gp_date')))):'';
	    	$status_data['sts_12_memo_no']=$this->security->xss_clean( $this->input->post('lcr_memo_no'));
	    	$status_data['sts_12_memo_dt']=$this->input->post('memo_date');
	    	$status_data['sts_12_gp_no']=$this->security->xss_clean( $this->input->post('gp_no'));
	    	$status_data['sts_12_gp_dt']=$this->input->post('gp_date');
	    }elseif($this->input->post('case_sts')==13){
	    	$withdrawn_date = $this->input->post('withdrawn_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('withdrawn_date')))):'';
	    	$status_data['sts_13_amount']=$this->security->xss_clean( $this->input->post('wp_amount'));
	    	$status_data['sts_13_date']=$this->input->post('withdrawn_date');
	    }elseif($this->input->post('case_sts')==18){
	    	$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
	    	$status_data['sts_18_date']=$this->input->post('sts_date');
	    }else{
	    	if($this->input->post('case_sts')>19){
	    		$status_data['sts_type']=$this->security->xss_clean( $this->input->post('status'));
		    	if($this->input->post('status')==1){
		    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
		    		//$status_data['sts_date']=$this->input->post('sts_date');
		    		$status_data['sts_date']=date('d/m/Y');
		    	}
	    	}else{

		    	$status_data['sts_'.$this->input->post('case_sts').'_type']=$this->security->xss_clean( $this->input->post('status'));
		    	if($this->input->post('status')==1){
		    		$sts_date = $this->input->post('sts_date')!=''?date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('sts_date')))):'';
		    		$status_data['sts_'.$this->input->post('case_sts').'_date']=$this->input->post('sts_date');
		    	}
		    }
	    }
	    if($this->input->post('disposal_sts')==2){
	    	$file_upload = $this->get_file_name('file_upload','cma_file/hc_ad_file/');
	    	if($file_upload!=''){
	    		$hc_present['files']=$file_upload;
	    	}
	    }
	    $his_id_expense='';
		if($this->input->post('add_edit')=="add")
		{
			$this->db->select('*');
			$this->db->from('hc_matter_hst_ad');
			$this->db->where(array('id'=>$this->input->post('hc_id'),'hc_matter_id'=>$this->input->post('hc_matter_id'),'v_sts'=>38,'sts'=>1));
			$this->db->order_by('id','DESC');
			$this->db->limit(1);
			$data = $this->db->get()->row();
			//echo $this->db->last_query();
			$hc_present['present_status_old'] =$data->present_status;
			$hc_present['last_act_old'] =$data->last_act;
			$hc_present['hc_bench_old'] =$data->hc_bench;
			$hc_present['bench_number_old'] =$data->bench_number;
			$hc_present['previous_date_old'] =$data->previous_date;
			//$hc_present['hc_lawyer_old'] =$data->hc_lawyer;
			$hc_present['remarks_old'] =$data->remarks;
			$hc_present['data_field_old'] =$data->data_field;
				
			$hc_present['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$hc_present['e_dt'] = date('Y-m-d H:i:s');
			// case update status change
			$hc_present['v_sts'] = 39;
			$hc_present['data_field'] = json_encode($status_data,true);
			$hc_present['hc_matter_id']=$this->input->post('hc_matter_id');
			$this->db->insert('hc_matter_hst_ad', $hc_present);
			$his_id_expense=$this->db->insert_id();
			// case update status change
			$hc_matter['verify'] = 39;
			$this->db->where('id', $this->input->post('hc_matter_id'));
			$this->db->update('hc_matter_ad', $hc_matter);
	  		$insert_idss = $this->input->post('hc_matter_id');

		    $activities_id = 39;
		    $description_activities = 'Add Case Status Update AD Matter - ('.$insert_idss.')';
		}
		else
		{
			//print_r($hc_present);
	  		$hc_present['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$hc_present['u_dt'] = date('Y-m-d H:i:s');
			// case update status change
			//$hc_present['v_sts'] = 0;
			$hc_present['data_field'] = json_encode($status_data,true);
			$this->db->where("id =".$this->input->post('hc_id')." AND hc_matter_id=".$this->input->post('hc_matter_id')." AND v_sts IN (39,35) ");
			$this->db->update('hc_matter_hst_ad', $hc_present);
			$his_id_expense=$this->input->post('hc_id');
			$insert_idss = $this->input->post('hc_matter_id');
	        $activities_id = 35;
	        $description_activities = 'Edit Case Status Update AD Matter - ('.$insert_idss.')';

		}

		// Expenses 
		$sql = "SELECT * from hc_matter_ad where id=$insert_idss AND sts=1";
	    $res = $this->db->query($sql);
	    $hc_matter = $res->row();
	    //print_r($hc_matter);exit;
		for($i=1;$i<= $_POST['expense_counter'];$i++)
        {
            $expense_data = array(
            'event_id' => $his_id_expense,
            'suit_id' => $insert_idss,
            'module_name' =>'AD Matter',
            'expense_type' =>$this->security->xss_clean( $this->input->post('expense_type_'.$i)),
            'activities_name' => $this->security->xss_clean( $this->input->post('activities_name_'.$i)),
            'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
            'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
            'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
            'vendor_name' => $this->security->xss_clean( $this->input->post('vendor_name_'.$i)),
            'vendor_id' => $this->security->xss_clean( $this->input->post('vendor_id_'.$i)),
            );
            if(isset($_POST['add_expense'])){
            // For skip The new deleted row
            if ($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==1) 
            {
                continue;
            }
            //For Delete the old row
            if ($_POST['expense_edit_'.$i]!=0 && $_POST['expense_delete_'.$i]==1) 
            {
            	$activities_id=15;
                $expense_data = array('sts' => 0,'v_sts'=>15);
                $expense_data['d_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['d_dt']=date('Y-m-d H:i:s');
                $this->db->where("id='".$_POST['expense_edit_'.$i]."'AND batch_no IS NULL");
                $this->db->update('expenses', $expense_data);
            }
            //For update the old row
            else if($_POST['expense_edit_'.$i]!=0 && $_POST['expense_delete_'.$i]!=1)
            {
            	$activities_id=35;
            	$expense_data['v_sts']=35;
            	$expense_data['u_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['u_dt']=date('Y-m-d H:i:s');
                $this->db->where("id='".$_POST['expense_edit_'.$i]."'AND batch_no IS NULL");
                $this->db->update('expenses', $expense_data);
            }
            //For insert the new row
            else if($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==0)
            {
            	$activities_id=39;
            	$expense_data['v_sts']=39;
            	$expense_data['event_id']=$his_id_expense;
            	$expense_data['suit_id']=$insert_idss;
            	$expense_data['proposed_type']=$hc_matter->proposed_type;
            	$expense_data['org_loan_ac']=$hc_matter->org_ac_number;
            	$expense_data['account_number']=$hc_matter->ac_number;
            	$expense_data['ac_name']=$hc_matter->ac_name;
            	$expense_data['req_type']=$hc_matter->req_type;
            	$expense_data['case_number']=$hc_matter->case_no;
            	$expense_data['e_by']=$this->session->userdata['ast_user']['user_id'];
            	$expense_data['e_dt']=date('Y-m-d H:i:s');
            	/*if($this->input->post('add_edit')=='edit'){
            		$expense_data['batch_no']=$this->input->post('batch_no');
            	}else{
            		$expense_data['batch_no']=time().$this->session->userdata['ast_user']['user_id'];
            	}*/
                $this->db->insert('expenses', $expense_data);
            }
        	}else{
        		if($add_edit=="edit"){
        			if ($_POST['expense_edit_'.$i]!=0) 
		            {
		            	$activities_id=15;
		                $expense_data = array('sts' => 0,'v_sts'=>15);
		                $expense_data['d_by']=$this->session->userdata['ast_user']['user_id'];
		            	$expense_data['d_dt']=date('Y-m-d H:i:s');
		                $this->db->where("id='".$_POST['expense_edit_'.$i]."'AND batch_no IS NULL");
		                $this->db->update('expenses', $expense_data);
		            }
        		}
        	}
            
        }

        // end expeses


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities($activities_id,'AD Matter',$insert_idss,$table_name,$description_activities);
			
			return $insert_idss;
		}
		
		}else{
			return validation_errors();
		}

	}

	function hc_caseup_edit_ad($id,$history_id){
		$this->db->select('e.*,e.id as history_id,st.*,st.id as sts_id,os.name as old_present_sts_name, s.name as present_sts_name, ohb.name as old_hcbench,hb.name as p_hc_bench, ohcl.name as old_hc_lawyer, hcl.name as p_hc_lawyer,
			if(UNIX_TIMESTAMP(st.sts_10_date) IS NULL,"",DATE_FORMAT(st.sts_10_date,"%d/%m/%Y")) AS sts_10_date,
			if(UNIX_TIMESTAMP(st.sts_11_date) IS NULL,"",DATE_FORMAT(st.sts_11_date,"%d/%m/%Y")) AS sts_11_date,
			if(UNIX_TIMESTAMP(st.sts_12_gp_dt) IS NULL,"",DATE_FORMAT(st.sts_12_gp_dt,"%d/%m/%Y")) AS sts_12_gp_dt,
			if(UNIX_TIMESTAMP(st.sts_12_memo_dt) IS NULL,"",DATE_FORMAT(st.sts_12_memo_dt,"%d/%m/%Y")) AS sts_12_memo_dt,
			if(UNIX_TIMESTAMP(st.sts_13_date) IS NULL,"",DATE_FORMAT(st.sts_13_date,"%d/%m/%Y")) AS sts_13_date,
			if(UNIX_TIMESTAMP(st.sts_14_date) IS NULL,"",DATE_FORMAT(st.sts_14_date,"%d/%m/%Y")) AS sts_14_date,
			if(UNIX_TIMESTAMP(st.sts_15_date) IS NULL,"",DATE_FORMAT(st.sts_15_date,"%d/%m/%Y")) AS sts_15_date,
			if(UNIX_TIMESTAMP(st.sts_16_date) IS NULL,"",DATE_FORMAT(st.sts_16_date,"%d/%m/%Y")) AS sts_16_date,
			if(UNIX_TIMESTAMP(st.sts_17_date) IS NULL,"",DATE_FORMAT(st.sts_17_date,"%d/%m/%Y")) AS sts_17_date,
			if(UNIX_TIMESTAMP(st.sts_18_date) IS NULL,"",DATE_FORMAT(st.sts_18_date,"%d/%m/%Y")) AS sts_18_date,
			if(UNIX_TIMESTAMP(st.sts_1_date) IS NULL,"",DATE_FORMAT(st.sts_1_date,"%d/%m/%Y")) AS sts_1_date,
			if(UNIX_TIMESTAMP(st.sts_2_date) IS NULL,"",DATE_FORMAT(st.sts_2_date,"%d/%m/%Y")) AS sts_2_date,
			if(UNIX_TIMESTAMP(st.sts_3_gp_dt) IS NULL,"",DATE_FORMAT(st.sts_3_gp_dt,"%d/%m/%Y")) AS sts_3_gp_dt,
			if(UNIX_TIMESTAMP(st.sts_3_memo_dt) IS NULL,"",DATE_FORMAT(st.sts_3_memo_dt,"%d/%m/%Y")) AS sts_3_memo_dt,
			if(UNIX_TIMESTAMP(st.sts_4_date) IS NULL,"",DATE_FORMAT(st.sts_4_date,"%d/%m/%Y")) AS sts_4_date,
			if(UNIX_TIMESTAMP(st.sts_5_date) IS NULL,"",DATE_FORMAT(st.sts_5_date,"%d/%m/%Y")) AS sts_5_date,
			if(UNIX_TIMESTAMP(st.sts_6_date) IS NULL,"",DATE_FORMAT(st.sts_6_date,"%d/%m/%Y")) AS sts_6_date,
			if(UNIX_TIMESTAMP(st.sts_7_date) IS NULL,"",DATE_FORMAT(st.sts_7_date,"%d/%m/%Y")) AS sts_7_date,
			if(UNIX_TIMESTAMP(st.sts_9_date) IS NULL,"",DATE_FORMAT(st.sts_9_date,"%d/%m/%Y")) AS sts_9_date,
			if(UNIX_TIMESTAMP(st.sts_date) IS NULL,"",DATE_FORMAT(st.sts_date,"%d/%m/%Y")) AS sts_date,
			if(UNIX_TIMESTAMP(e.previous_date) IS NULL,"",DATE_FORMAT(e.previous_date,"%d/%m/%Y")) AS previous_date,
			if(UNIX_TIMESTAMP(e.previous_date_old) IS NULL,"",DATE_FORMAT(e.previous_date_old,"%d/%m/%Y")) AS previous_date_old
			', FALSE)
			->from("hc_matter_hst_ad e")
			->join('ref_case_sts os', 'os.id=e.present_status_old', 'left')
			->join('ref_case_sts s', 's.id=e.present_status', 'left')
			->join('ref_hc_bench ohb', 'ohb.id=e.hc_bench_old', 'left')
			->join('ref_hc_bench hb', 'hb.id=e.hc_bench', 'left')
			->join('ref_lawyer ohcl', 'ohcl.id=e.hc_lawyer_old', 'left')
			->join('ref_lawyer hcl', 'hcl.id=e.hc_lawyer', 'left')
			->join('hc_matter_status_ad st', 'st.hc_matter_id=e.hc_matter_id', 'left')
			->where("e.id=".$history_id." AND e.hc_matter_id=".$id." AND e.v_sts IN (35,39,90)", NULL, FALSE)
			->order_by("e.id", "DESC")
			->limit(1);
		$q=$this->db->get();
		$result = $q->row();
		return $result;
	}
	

	function status_delete_action_ad(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "hc_matter_ad";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';
		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_hst_ad',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('hc_matter_hst_ad', $data);

				$data = array('verify'=>38);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('hc_matter_ad', $data);

				$activities_id = 15;
				$description_activities = 'Delete Case Status Update AD Matter - ('.$_POST['deleteEventId'].')';
				$row_id=$_POST['deleteEventId'];
				$reason =trim($_POST['comments']);

				// Expense
				
				$his_id_expense = $_POST['deleteEventId']; // suit_id for expese
				
				$data = array('d_reason'=>trim($_POST['comments']),'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$where = "event_id=".$his_id_expense." AND module_name='AD Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
			}
			
		}
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_hst_ad',$_POST['verifyid'],37,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('verify'=>37);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('hc_matter_ad', $data);

				$data = array('s_by'=> $this->session->userdata['ast_user']['user_id'], 's_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
				$this->db->where("id=".$_POST['verifyid']." AND v_sts IN (39,35)");
				$this->db->update('hc_matter_hst_ad', $data);

				$activities_id = 37;
				$description_activities = 'Send to Checker Case Status Update AD Matter - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];
				
				// Expense
				
				$his_id_expense= $_POST['verifyid'];
				$hc_id_expense = $_POST['deleteEventId']; // suit_id for expese
				
				$data = array('stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
				$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='AD Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
			}
		}
		if($this->input->post('type')=='verify_return'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_hst_ad',$_POST['verifyid'],'90,38,91','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
            	$data = array('verify'=>90);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('hc_matter_ad', $data);

				$data = array('r_reason'=>$_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'),'v_sts'=>90);
				$this->db->where(array('id'=>$_POST['verifyid'],'v_sts'=>37));
				$this->db->update('hc_matter_hst_ad', $data);

				$his_id_expense= $_POST['verifyid']; // event_id
				$hc_id_expense = $_POST['deleteEventId']; // suit_id

            	$data = array('r_reason'=>$_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'),'v_sts'=>90);

				$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='AD Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
                
                $reason=$_POST['return_reason_verify'];
                $activities_id = 90;
				$description_activities = 'Return AD Matter Expence- ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];

            }
        }
        if($this->input->post('type')=='verify_reject'){
            $pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_hst_ad',$_POST['verifyid'],'91,38','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {

            	$data = array('verify'=>91);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('hc_matter_ad', $data);

				$data = array('reject_reason'=>$_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'),'v_sts'=>91);
				$this->db->where(array('id'=>$_POST['verifyid'],'v_sts'=>37));
				$this->db->update('hc_matter_hst_ad', $data);

				$his_id_expense= $_POST['verifyid']; // event_id
				$hc_id_expense = $_POST['deleteEventId']; // suit_id

            	$data = array('reject_reason'=>$_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'),'v_sts'=>91);
            	$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='AD Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);
                
                $reason=$_POST['return_reason_verify'];
                $activities_id = 91;
				$description_activities = 'Reject HC Matter Expence- ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];
                
            } 
        }
		
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('hc_matter_hst_ad',$_POST['verifyid'],38,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{

				$this->db->select('*');
				$this->db->from('hc_matter_hst_ad');
				$this->db->where(array('id'=>$_POST['verifyid'],'sts'=>1));
				$this->db->limit(1);
				$data_res = $this->db->get()->row();
				$obj = json_decode($data_res->data_field);
				$status_data=array();
				foreach($obj as $key => $val){
					// Check Date Data
					if (preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $val, $matches)) {
    					if (checkdate($matches[2], $matches[1], $matches[3])) {
						$status_data[$key]=date('Y-m-d',strtotime(str_replace('/', '-',$val)));
						}else{
							$status_data[$key]=$val;
						}
					}else{
						$status_data[$key]=$val;
					}
				}
				$status_data['last_entry_by']=$this->session->userdata['ast_user']['user_id'];
				$status_data['last_entry_dt']=date('Y-m-d H:i:s');

				$this->db->where('hc_matter_id', $this->input->post('deleteEventId'));
				$this->db->update('hc_matter_status_ad', $status_data);


				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
				$this->db->where(array('id'=>$_POST['verifyid'],'v_sts'=>37));
				$this->db->update('hc_matter_hst_ad', $data); 


				if($data_res->final_sts==2){
					$data = array('verify'=>38,'present_status'=>$data_res->present_status,'final_sts'=>2,'f_by'=>$this->session->userdata['ast_user']['user_id'],'f_dt'=>date('Y-m-d H:i:s'),'final_remarks'=>$data_res->remarks,'files'=>$data_res->files,'v_sts'=>94);
				}else{
					$data = array('verify'=>38,'present_status'=>$data_res->present_status);
				}
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('hc_matter_ad', $data);

				$activities_id = 38;
				$description_activities = 'Verify Case Status Update AD Matter - ('.$_POST['verifyid'].')';
				$row_id=$_POST['verifyid'];
				
				// Expense
				$his_id_expense= $_POST['verifyid'];
				$hc_id_expense = $_POST['deleteEventId']; // suit_id for expese
				
				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
				$where = "event_id=".$his_id_expense." AND suit_id=".$hc_id_expense." AND module_name='AD Matter' AND sts<>0";
				$this->db->where($where);
				$this->db->update('expenses', $data);

				//Genereate Expenses
                $str="SELECT  j0.*,h.proposed_type,h.ac_number,h.org_ac_number,h.ac_name,h.case_no,h.case_type,h.portfolio,h.region,h.territory,h.district
                        FROM expenses j0
                        LEFT JOIN hc_matter_ad as h
						ON h.id = j0.suit_id
                     WHERE j0.sts != '0'  AND j0.event_id= '".$his_id_expense."' AND j0.suit_id='".$hc_id_expense."' AND j0.module_name='AD Matter'";   
                $expense_data=$this->db->query($str)->result();
                //echo $this->db->last_query();
                //print_r($expense_data);
                if (!empty($expense_data)) {
                        foreach ($expense_data as $key) {
                        	if($key->proposed_type=='Loan' && $key->ac_number!='' && $key->ac_number!=NULL)
							{
								if(strlen($key->ac_number)==16)
								{
									$cif = substr($key->ac_number,5,8);
								}
								else if(strlen($key->ac_number)==13)
								{
									$cif = substr($key->ac_number,1,8);
								}
								else
								{
									$cif = "";
								}
							}
							else
							{
								$cif = "";
							}
                            $cost_data = array(
                            'module_name' => 'high_court',
                            'main_table_name' => 'hc_matter_hst_ad',
                            'main_table_id' => $key->event_id,
                            'sub_table_name' => 'expenses',
                            'sub_table_id' => $key->id,
                            'suit_id' => $key->suit_id,
                            'activities_id' => $key->activities_name,
                            'vendor_type' => $key->expense_type,
                            'vendor_id' => $key->vendor_id,
                            'vendor_name' => $key->vendor_name,
                            'amount' =>$key->amount,
                            'txrn_dt' => $key->activities_date,
                            'proposed_type' => $key->proposed_type,
                            'cif' => $cif,
                            'loan_ac' => $key->ac_number,
                            'org_loan_ac' => $key->org_ac_number,
                            'ac_name' => $key->ac_name,
                            'case_number' => $key->case_no,
                            'req_type' => $key->case_type,
                            'loan_segment' => $key->portfolio,
                            'region' => $key->region,
                            'territory' => $key->territory,
                            'district' => $key->district,
                            'expense_remarks' =>$key->remarks
                        );
                            //print_r($cost_data);
                        $data3=$this->user_model->cost_details($cost_data);

                    }
                    $activities_id = 38;
					$description_activities_expense = 'Verify AD Matter Expence- ('.$data_res->id.')';
					$this->User_model->user_activities_bill($activities_id,'expenses',$data_res->id,'hc_matter_hst_ad',$description_activities_expense,$reason);
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
			$this->User_model->user_activities($activities_id,'AD Matter',$row_id,$table_name,$description_activities,$reason);
			$this->db->trans_commit();

			$this->db->db_debug = $db_debug;
			return $row_id;
		}
	}

	// Case Details

	function hc_case_details(){
			$str_where = "h.sts =1 AND h.v_sts IN (38,94)";
			
		    if (isset($_POST['present_status'])) {
		        if (trim($this->input->post('present_status')) != '') {
		            $str_where.= " AND h.present_status='".trim($this->input->post('present_status'))."'";
		        }
		    }
		    if(isset($_POST['s_case_number']))
		    {
		        if (trim($this->input->post('s_case_number')) != '') {
		            $str_where.= " AND h.case_no='".trim($this->input->post('s_case_number'))."'";
		        }
		    }
		    if(isset($_POST['s_account']))
		    {
		        if (trim($this->input->post('s_account')) != '') {
		            $str_where.= " AND h.ac_number='".trim($this->input->post('s_account'))."'";
		        }
		    }
		    if(isset($_POST['proposed_type']))
		    {
		        if (trim($this->input->post('proposed_type')) != '') {
		            $str_where.= " AND h.proposed_type='".trim($this->input->post('proposed_type'))."'";
		        }
		    }
		    if (isset($_POST['s_hc_division'])) {
		        if (trim($this->input->post('s_hc_division')) != '') {
		            $str_where.= " AND h.hc_division='".trim($this->input->post('s_hc_division'))."'";
		        }
		    } 
		    if (isset($_POST['s_case_category'])) {
		        if (trim($this->input->post('s_case_category')) != '') {
		            $str_where.= " AND h.case_category='".trim($this->input->post('s_case_category'))."'";
		        }
		    } 
		    if (isset($_POST['s_case_type'])) {
		        if (trim($this->input->post('s_case_type')) != '') {
		            $str_where.= " AND h.case_type='".trim($this->input->post('s_case_type'))."'";
		        }
		    } 
			$this->db->select('h.*,if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,
				DATE_FORMAT(h.filing_date,"%d-%m-%Y") AS filing_date,div.name as division_name,cat.name as case_category_name,
				DATE_FORMAT(h.file_receive_date,"%d-%m-%Y") AS file_receive_date,bn.name as bench_number
				', FALSE)
				->from("hc_matter h")
				->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
				->join('ref_loan_segment ls', 'ls.code=h.portfolio', 'left')
				->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
				->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
				->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
				->join('ref_hc_division div', 'div.id=h.hc_division', 'left')
				->join('ref_hc_case_category cat', 'cat.id=h.case_category', 'left')
				->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
				->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
				->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
				->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
				->where($str_where)
				->order_by('h.id','DESC');
			$query=$this->db->get();
			return $query->result();
		

	}
	function hc_case_details_xl(){
		//if(isset($_POST['mk_xl'])){
			$str_where = "h.sts =1 AND h.v_sts IN (38,94)";
			
		     if(isset($_POST['s_case_number']))
		    {
		        if (trim($this->input->post('s_case_number')) != '') {
		            $str_where.= " AND h.case_no='".trim($this->input->post('s_case_number'))."'";
		        }
		    }
		    if(isset($_POST['s_account']))
		    {
		        if (trim($this->input->post('s_account')) != '') {
		            $str_where.= " AND h.ac_number='".trim($this->input->post('s_account'))."'";
		        }
		    }
		    if(isset($_POST['proposed_type']))
		    {
		        if (trim($this->input->post('proposed_type')) != '') {
		            $str_where.= " AND h.proposed_type='".trim($this->input->post('proposed_type'))."'";
		        }
		    }
		    if (isset($_POST['s_hc_division'])) {
		        if (trim($this->input->post('s_hc_division')) != '') {
		            $str_where.= " AND h.hc_division='".trim($this->input->post('s_hc_division'))."'";
		        }
		    } 
		    if (isset($_POST['s_case_category'])) {
		        if (trim($this->input->post('s_case_category')) != '') {
		            $str_where.= " AND h.case_category='".trim($this->input->post('s_case_category'))."'";
		        }
		    } 
		    if (isset($_POST['s_case_type'])) {
		        if (trim($this->input->post('s_case_type')) != '') {
		            $str_where.= " AND h.case_type='".trim($this->input->post('s_case_type'))."'";
		        }
		    } 
			$this->db->select('h.*,if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,
				hs.sts_13_amount as withdrawn_amt,ad.name as deposit_am_50, hs.sts_12_memo_no as lcr_send_memo,hs.sts_3_memo_no as lcr_receive_memo,
				if(hs.sts_5_type=1,"Yes",if(hs.sts_5_type=2,"No","")) as power_submit,
				if(hs.sts_8_type=1,"Yes",if(hs.sts_8_type=2,"No","")) as compromised,
				DATE_FORMAT(hs.sts_13_date,"%d-%m-%Y") AS withdrawn_date,
				DATE_FORMAT(h.filing_date,"%d-%m-%Y") AS filing_date,div.name as division_name,cat.name as case_category_name,
				DATE_FORMAT(h.file_receive_date,"%d-%m-%Y") AS file_receive_date,bn.name as bench_number
				', FALSE)
				->from("hc_matter h")
				->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
				->join('ref_loan_segment ls', 'ls.code=h.portfolio', 'left')
				->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
				->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
				->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
				->join('ref_hc_division div', 'div.id=h.hc_division', 'left')
				->join('ref_hc_case_category cat', 'cat.id=h.case_category', 'left')
				->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
				->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
				->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
				->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
				->join('ref_appeal_deposit_money ad', 'ad.id=h.deposit_am_50', 'left')
				->join('hc_matter_status hs', 'hs.hc_matter_id=h.id', 'left')
				->where($str_where)
				->order_by('h.id','ASC');
			$query=$this->db->get();
			return $query->result_array();
		/*}else{
			return array();
		}*/

	}

	function ad_case_details(){
			/*print_r($_POST);
			exit;*/
			$str_where = "h.sts =1 AND h.v_sts IN (38,94)";
			if (isset($_POST['portfolio'])) {
		        if (trim($this->input->post('portfolio')) != '') {
		            $str_where.= " AND h.portfolio=".$this->db->escape(trim($this->input->post('portfolio')));
		        }
		    }
		    if (isset($_POST['case_category'])) {
		        if (trim($this->input->post('case_category')) != '') {
		            $str_where.= " AND h.case_category=".$this->db->escape(trim($this->input->post('case_category')));
		        }
		    } 
		    if (isset($_POST['case_type'])) {
		        if (trim($this->input->post('case_type')) != '') {
		            $str_where.= " AND h.case_type=".$this->db->escape(trim($this->input->post('case_type')));
		        }
		    }
		    if (isset($_POST['present_status'])) {
		        if (trim($this->input->post('present_status')) != '') {
		            $str_where.= " AND h.present_status=".$this->db->escape(trim($this->input->post('present_status')));
		        }
		    }
		    if(isset($_POST['case_number']))
		    {
		        if (trim($this->input->post('case_number')) != '') {
		            $str_where.= " AND h.case_no=".$this->db->escape(trim($this->input->post('case_number')));
		        }
		    }
		    if(isset($_POST['ac_no']))
		    {
		        if (trim($this->input->post('ac_no')) != '') {
		            $str_where.= " AND h.ac_number=".$this->db->escape(trim($this->input->post('ac_no')));
		        }
		    }
		    if(isset($_POST['proposed_type']))
		    {
		        if (trim($this->input->post('proposed_type')) != '') {
		            $str_where.= " AND h.proposed_type=".$this->db->escape(trim($this->input->post('proposed_type')));
		        }
		    }
			$this->db->select('h.*,if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,
				DATE_FORMAT(h.filing_date,"%d-%m-%Y") AS filing_date,
				DATE_FORMAT(h.file_receive_date,"%d-%m-%Y") AS file_receive_date,cat.name as case_category_name,bn.name as bench_number
				', FALSE)
				->from("hc_matter_ad h")
				->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
				->join('ref_loan_segment ls', 'ls.code=h.portfolio', 'left')
				->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
				->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
				->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
				->join('ref_hc_case_category cat', 'cat.id=h.case_category', 'left')
				->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
				->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
				->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
				->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
				->where($str_where)
				->order_by('h.id','DESC')
				->limit($_POST['limit']);
			$query=$this->db->get();
			return $query->result();
		

	}
	function ad_case_details_xl(){
		if(isset($_POST['mk_xl'])){
			$str_where = "h.sts =1 AND h.v_sts IN (38,94)";
			if (isset($_POST['portfolio'])) {
		        if (trim($this->input->post('portfolio')) != '') {
		            $str_where.= " AND h.portfolio=".$this->db->escape(trim($this->input->post('portfolio')));
		        }
		    }
		    if (isset($_POST['case_category'])) {
		        if (trim($this->input->post('case_category')) != '') {
		            $str_where.= " AND h.case_category=".$this->db->escape(trim($this->input->post('case_category')));
		        }
		    } 
		    if (isset($_POST['case_type'])) {
		        if (trim($this->input->post('case_type')) != '') {
		            $str_where.= " AND h.case_type=".$this->db->escape(trim($this->input->post('case_type')));
		        }
		    } 
		    if (isset($_POST['present_status'])) {
		        if (trim($this->input->post('present_status')) != '') {
		            $str_where.= " AND h.present_status=".$this->db->escape(trim($this->input->post('present_status')));
		        }
		    }
		    if(isset($_POST['case_number']))
		    {
		        if (trim($this->input->post('case_number')) != '') {
		            $str_where.= " AND h.case_no=".$this->db->escape(trim($this->input->post('case_number')));
		        }
		    }
		    if(isset($_POST['ac_no']))
		    {
		        if (trim($this->input->post('ac_no')) != '') {
		            $str_where.= " AND h.ac_number=".$this->db->escape(trim($this->input->post('ac_no')));
		        }
		    }
		    if(isset($_POST['proposed_type']))
		    {
		        if (trim($this->input->post('proposed_type')) != '') {
		            $str_where.= " AND h.proposed_type=".$this->db->escape(trim($this->input->post('proposed_type')));
		        }
		    }
			$this->db->select('h.*,if(h.ac_closing_status=1,"Yes",if(h.ac_closing_status=2,"No","")) as ac_closing_status,d.name as district_name,cs.name as case_sts_name,hb.name as hc_bench_name,ht.name as hc_type_name,hd.name as hc_officer,hl.name as lower_officer,al.name as assigned_lawyer_name,ls.name as portfolio_name,
				hs.sts_13_amount as withdrawn_amt,ad.name as deposit_am_50, hs.sts_12_memo_no as lcr_send_memo,hs.sts_3_memo_no as lcr_receive_memo,
				if(hs.sts_5_type=1,"Yes",if(hs.sts_5_type=2,"No","")) as power_submit,
				if(hs.sts_8_type=1,"Yes",if(hs.sts_8_type=2,"No","")) as compromised,
				DATE_FORMAT(hs.sts_13_date,"%d-%m-%Y") AS withdrawn_date,
				DATE_FORMAT(h.filing_date,"%d-%m-%Y") AS filing_date,
				DATE_FORMAT(h.file_receive_date,"%d-%m-%Y") AS file_receive_date,
				DATE_FORMAT(h.next_date,"%d-%m-%Y") AS next_date,cat.name as case_category_name,
				ns.name as next_status_name,bn.name as bench_number
				', FALSE)
				->from("hc_matter_ad h")
				->join('ref_legal_district d', 'd.id=h.name_dist', 'left')
				->join('ref_loan_segment ls', 'ls.code=h.portfolio', 'left')
				->join('ref_hc_case_status cs', 'cs.id=h.present_status', 'left')
				->join('ref_hc_case_status ns', 'ns.id=h.next_status', 'left')
				->join('ref_hc_bench hb', 'hb.id=h.hc_bench', 'left')
				->join('ref_hc_bench_number bn', 'bn.id=h.bench_number', 'left')
				->join('ref_hc_case_category cat', 'cat.id=h.case_category', 'left')
				->join('ref_hc_case_type ht', 'ht.id=h.case_type', 'left')
				->join('users_info hd', 'hd.id=h.hc_dealing_officer', 'left')
				->join('users_info hl', 'hl.id=h.lower_dealing_officer', 'left')
				->join('ref_lawyer al', 'al.id=h.assigned_lawyer', 'left')
				->join('ref_appeal_deposit_money ad', 'ad.id=h.deposit_am_50', 'left')
				->join('hc_matter_status_ad hs', 'hs.hc_matter_id=h.id', 'left')
				->where($str_where)
				->order_by('h.id','ASC')
				->limit($_POST['limit']);
			$query=$this->db->get();
			return $query->result_array();
		}else{
			return array();
		}

	}


	function get_expense_amount($act_id,$district=null,$req_type=null){
		
	  		$select = "a.instation as amount";
	  	$table_name = "ref_hc_activities";
		$sql="SELECT $select FROM $table_name a WHERE a.id='".$act_id."'";
		$query=$this->db->query($sql)->row();
		return $query;
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



    // HC Bill Expense Start


    function get_cost_details_lawyer($id=NULL,$month=NULL)
    {
        $where='';
        $where2='';
        $join='';
        $select='';
        $all_month = explode(",",$month);
        if (count($all_month)>1) //For multiple month
        {
            $where='AND (';
            for ($i=0; $i < count($all_month); $i++) 
            { 
               if($i==count($all_month)-1)//For last condition
               {
                $where.='MONTH(j0.txrn_dt) = '.$all_month[$i];
               }
               else //For others condition
               {
                $where.='MONTH(j0.txrn_dt) = '.$all_month[$i].' OR ';
               }
            }
            $where.=')';
        }
        else //For singel month
        {
            $where='AND MONTH(j0.txrn_dt) = '.$all_month[0];
        }
        //For type wise where condition
        if($id!=NULL && $id!=0 && $id!='')
        {
            $where2.="AND j0.vendor_id='".$id."'";
        }
        if (isset($_POST['year']) && $_POST['year']!=0) {
            $where2.="AND YEAR(j0.txrn_dt)='".$_POST['year']."'";
        }
        //For type wise join table
        $select="CONCAT(u.name,' (',u.code,')')";
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=1)';
        
        $str=" SELECT j0.*,a.name as activities_name,CONCAT(u.name,' (',u.code,')') AS vendor_name
				FROM cost_details j0
				LEFT OUTER JOIN ref_hc_activities AS a ON a.id = j0.activities_id
				LEFT OUTER JOIN ref_lawyer AS u ON (j0.vendor_id=u.id AND j0.vendor_type=1)
				WHERE (j0.memo_sts=0 OR j0.memo_sts IS NULL) AND (j0.legal_select_sts=0 OR j0.legal_select_sts IS NULL) AND 
				j0.vendor_type= 1 AND j0.module_name='high_court' $where2 $where
				ORDER BY j0.txrn_dt ASC";
        $query=$this->db->query($str);
        return $query->result();
    }

    function get_grid_data_lawyer($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
       $i=0;
        $where2 = "a.sts<>0 and a.selection_type='lawyer_bill_hc'";
        if (check_group('1'))
        {
            $where2 .=" AND j1.region IN(".$this->session->userdata['ast_user']['legal_region'].")";
        }
        else if (check_group('2'))
        {
            $where2 .=" AND a.e_by='".$this->session->userdata['ast_user']['user_id']."'";
        }
        $where="";
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

                if($filterdatafield=='total_selected')
                {
                    $filterdatafield='a.total_selected';
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield='j0.name';
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield='j0.name';
                }
                else if($filterdatafield=='e_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='v_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.v_dt,'%d-%b-%y %h:%i %p')";
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
                    $where .= " (j1.name LIKE '%".$filtervalue."%' OR j1.user_id LIKE '%".$filtervalue."%') ";
                }
                else if($filterdatafield =='v_by')
                {
                    $where .= " (j2.name LIKE '%".$filtervalue."%' OR j2.user_id LIKE '%".$filtervalue."%') ";
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
            $sortdatafield="a.id";
            $sortorder = "DESC";             
        }
        $this->db
        ->select('SQL_CALC_FOUND_ROWS a.*,a.e_by as e_by_id,
            j0.name as status,
            CONCAT(j1.name," (",j1.user_id,")")as e_by,
            CONCAT(j2.name," (",j2.user_id,")")as v_by,
            DATE_FORMAT(a.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
            DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
            ', FALSE)
            ->from("legal_bill_selection a")
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('users_info as j1', 'a.e_by=j1.id', 'left')
            ->join('users_info as j2', 'a.v_by=j2.id', 'left')
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

    function add_edit_lawyer_bill($add_edit,$id,$editrow)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $data = array(
            'selection_type' =>'lawyer_bill_hc',
            'sts' =>95
        );
        //For ADD
        if ($add_edit=='add') {
        	$data['lawyer'] =$this->security->xss_clean( $this->input->post('lawyer'));
            $data['year'] =$this->security->xss_clean( $this->input->post('year'));
            $data['month'] =$this->security->xss_clean( $this->input->post('bill_month'));
            $data['e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['e_dt'] = date('Y-m-d H:i:s');
            $this->db->insert('legal_bill_selection', $data);
            $insert_idss = $this->db->insert_id();
            $counter = 0;
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                	$counter++;
                    $pre_action_result=$this->Common_model->get_pre_action_data('cost_details',$_POST['event_id_'.$i],'95','legal_select_sts');
                    if (count($pre_action_result)>0) 
                    {
                        $this->db->trans_rollback();
                        return 'taken';
                    }
                    else
                    {
                        $data = array('legal_select_sts' => 95,'legal_select_id' => $insert_idss);
                        $this->db->where('id', $_POST['event_id_'.$i]);
                        $this->db->update('cost_details', $data);
                    }
                }
                
            }
            $data = array('total_selected' => $counter);
            $this->db->where('id', $insert_idss);
            $this->db->update('legal_bill_selection', $data);

            $data2 = $this->user_model->user_activities_bill(95,'legal_bill_selection',$insert_idss,'legal_bill_selection','Select Lawyer Bill For HO('.$insert_idss.')');
        }	
        else //For Update Existing Suit Filling Info for this CMA
        {
            $edit_id = $id;
            if ($_POST['bill_select']==0) {//Delete when no bill selected
                $data['sts'] = 0;
                $data['d_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['d_dt'] = date('Y-m-d H:i:s');
                $data['d_reason'] = $_POST['delete_reason_lawyer_bill'];
            }
            else
            {
                $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['u_dt'] = date('Y-m-d H:i:s');
            }
            $this->db->where('id', $edit_id);
            $this->db->update('legal_bill_selection', $data);
            $insert_idss = $edit_id;

            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $data = array('legal_select_sts' => 95,'legal_select_id' => $insert_idss);
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cost_details', $data);
                }
                else if($_POST['event_delete_'.$i]==1 && $_POST['event_memo_id_'.$i]==$insert_idss)
                {
                    $data = array('legal_select_sts' => 0,'legal_select_id' => '');
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cost_details', $data);
                }
                
                
            }
            $data2 = $this->user_model->user_activities_bill(95,'legal_bill_selection',$insert_idss,'legal_bill_selection','Update Lawyer Bill For HO('.$insert_idss.')');
            
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
    function get_lawyer_bill_details_by_id($id)
    {
        if($id!=''){
            $str=" SELECT j0.amount,j0.description,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
            CONCAT(u.name,' (',u.code,')') as vendor_name,
            j0.loan_ac,j0.ac_name,j0.case_number,
            IF(j0.activities_id=0,j0.description,hc.name) as activities_name
            FROM cost_details as j0
            LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=1)
            LEFT OUTER JOIN ref_hc_activities as hc on (j0.activities_id=hc.id AND j0.module_name='high_court')
            WHERE  j0.legal_select_id= ".$this->db->escape($id)." AND j0.module_name='high_court' ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_row_details_lawyer($id)
    {
        $this->db
            ->select('a.*,DATE_FORMAT(a.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
                CONCAT(u.name," (",u.code,")") as vendor_name,
                CONCAT(j6.name," (",j6.user_id,")")as e_by,
                CONCAT(j7.name," (",j7.user_id,")")as v_by', FALSE)
            ->from("legal_bill_selection a")
            ->join('ref_lawyer as u', 'a.lawyer=u.id', 'left')
            ->join('users_info as j6', 'a.e_by=j6.id', 'left')
            ->join('users_info as j7', 'a.v_by=j7.id', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }

    function get_add_action_data_lawyer($id)
    {
        $this->db
            ->select('a.*,l.name as lawyer_name', FALSE)
            ->from("legal_bill_selection a")
            ->join('ref_lawyer l', 'l.id=a.lawyer', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }

    function get_bill_details_lawyer($id=NULL,$month=NULL,$year=NULL)
    {
        $where='';
        $where2='';
        $join='';
        $select='';
        $where2.=' AND MONTH(j0.txrn_dt) IN('.$month.')' ;
        //For type wise where condition
        if($id!=NULL && $id!=0 && $id!='')
        {
            $where2.=" AND j0.vendor_id='".$id."'";
        }
        $where2.=" AND YEAR(j0.txrn_dt)='".$year."'";
        //For type wise join table
        $select="CONCAT(u.name,' (',u.code,')')";
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=1)';
        
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
        j0.loan_ac,j0.ac_name,j0.case_number,
        IF(j0.activities_id=0,j0.description,IF(j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter',hc.name,'')) as activities_name
            FROM cost_details as j0
            $join
            
            LEFT OUTER JOIN ref_hc_activities as hc on (j0.activities_id=hc.id AND (j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter'))
            
            WHERE j0.module_name='high_court' AND (j0.memo_sts=0 OR j0.memo_sts IS NULL) AND (j0.legal_select_sts=0 OR j0.legal_select_sts IS NULL OR j0.legal_select_sts=95 OR j0.legal_select_sts=90) AND j0.vendor_type= 1 $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }


}