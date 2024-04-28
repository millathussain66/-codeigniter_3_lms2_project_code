<?php
class Expenses_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
	}
	function get_grid_data_lawyer($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
       $i=0;
        $where2 = "a.sts<>0 and a.selection_type='lawyer_bill'";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('2')) //For Legal Maker
        {
            array_push($condition_array,"a.e_by='".$this->session->userdata['ast_user']['user_id']."'");
        }
        if (check_group('1')) //For Legal Checker
        {
            array_push($condition_array,multi_selected_query_maker_2($this->session->userdata['ast_user']['legal_region'],'j1.legal_region'));
        }
        if(check_group('1') || check_group('2'))
        {
            $where2 .=implode(" OR ",$condition_array);
            $where2 .=") ";
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
                }else if($filterdatafield=='lawyer_name')
                {
                    $filterdatafield='l.name';
                }
                else if($filterdatafield=='region_name')
                {
                    $filterdatafield='r.name';
                }
                else if($filterdatafield=='district_name')
                {
                    $filterdatafield='d.name';
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
        ->select('SQL_CALC_FOUND_ROWS a.*,a.e_by as e_by_id,r.name as region_name,d.name as district_name,l.name as lawyer_name,
            j0.name as status,
            CONCAT(j1.name," (",j1.user_id,")")as e_by,
            CONCAT(j2.name," (",j2.user_id,")")as v_by,
            DATE_FORMAT(a.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
            DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
            ', FALSE)
            ->from("legal_bill_selection a")
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('ref_lawyer as l', 'a.lawyer=l.id', 'left')
            ->join('ref_legal_region as r', 'l.region=r.id', 'left')
            ->join('ref_legal_district as d', 'l.district=d.id', 'left')
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
    function get_grid_data_court_fee($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
       $i=0;
        $where2 = "a.sts<>0 and a.selection_type='court_fee'";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('2')) //For Legal Maker
        {
            array_push($condition_array,"a.e_by='".$this->session->userdata['ast_user']['user_id']."'");
        }
        if (check_group('1')) //For Legal Checker
        {
            array_push($condition_array,multi_selected_query_maker_2($this->session->userdata['ast_user']['legal_region'],'j1.legal_region'));
        }
        if(check_group('1') || check_group('2'))
        {
            $where2 .=implode(" OR ",$condition_array);
            $where2 .=") ";
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
                else if($filterdatafield=='lawyer_name')
                {
                    $filterdatafield='l.name';
                }
                else if($filterdatafield=='region_name')
                {
                    $filterdatafield='r.name';
                }
                else if($filterdatafield=='district_name')
                {
                    $filterdatafield='d.name';
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
            ->select('SQL_CALC_FOUND_ROWS a.*,a.e_by as e_by_id,r.name as region_name,d.name as district_name,l.name as lawyer_name,
                j0.name as status,
                CONCAT(j1.name," (",j1.user_id,")")as e_by,
                CONCAT(j2.name," (",j2.user_id,")")as v_by,
                DATE_FORMAT(a.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
                DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
                ', FALSE)
            ->from("legal_bill_selection a")
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('ref_lawyer as l', 'a.lawyer=l.id', 'left')
            ->join('ref_legal_region as r', 'l.region=r.id', 'left')
            ->join('ref_legal_district as d', 'l.district=d.id', 'left')
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
	function get_grid_data_court_return($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
        $where2 = "b.sts<>'0'";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('2')) //For Legal Maker
        {
            array_push($condition_array,"b.e_by='".$this->session->userdata['ast_user']['user_id']."'");
        }
        if (check_group('1')) //For Legal Checker
        {
            array_push($condition_array,multi_selected_query_maker_2($this->session->userdata['ast_user']['legal_region'],'u.legal_region'));
        }
        if(check_group('1') || check_group('2'))
        {
            $where2 .=implode(" OR ",$condition_array);
            $where2 .=") ";
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

        		if($filterdatafield=='loan_ac')
				{
					$filterdatafield='b.loan_ac';
				}
				else if($filterdatafield=='e_dt')
				{
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(b.e_dt,'%d-%b-%y %h:%i %p')";
				}
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='b.ac_name';
				}
				else if($filterdatafield=='district_name')
				{
					$filterdatafield='d.name';
				}
				else if($filterdatafield=='lawyer_name')
				{
					$filterdatafield='l.name';
				}
				else if($filterdatafield=='status')
				{
					$filterdatafield='j6.name';
				}
				else if($filterdatafield=='return_amount')
				{
					$filterdatafield='b.return_amount';
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

				if($filterdatafield =='e_by')
				{
					$where .= " (u.name LIKE '%".$filtervalue."%' OR u.user_id LIKE '%".$filtervalue."%') ";
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
		if ($sortorder == '')
		{
			$sortdatafield="b.id";
			$sortorder = "DESC";				
		}
    	$this->db->select('SQL_CALC_FOUND_ROWS b.*,d.name as district_name,l.name as lawyer_name,IF(FIND_IN_SET(2,u.user_group_id),1,IF(FIND_IN_SET(4,u.user_group_id),3,IF(FIND_IN_SET(10,u.user_group_id),11,17))) as verifier_group_id,
    	DATE_FORMAT(b.e_dt,"%d-%m-%Y") AS e_dt,CONCAT(u.name," (",u.user_id,")")as e_by,j6.name as status
    	', FALSE)
			->from("court_fee_return b")
			->join('ref_legal_district d', 'b.lawyer_district=d.id', 'left')
			->join('ref_lawyer l', 'l.id=b.lawyer', 'left')
			->join('users_info u', 'b.e_by=u.id', 'left')
			->join('ref_status as j6', 'b.v_sts=j6.id', 'left')
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
    function get_grid_data_court_adjust($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        $i=0;
        $where2 = "b.sts<>'0'";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('2')) //For Legal Maker
        {
            array_push($condition_array,"b.e_by='".$this->session->userdata['ast_user']['user_id']."'");
        }
        if (check_group('1')) //For Legal Checker
        {
            array_push($condition_array,multi_selected_query_maker_2($this->session->userdata['ast_user']['legal_region'],'u.legal_region'));
        }
        if(check_group('1') || check_group('2'))
        {
            $where2 .=implode(" OR ",$condition_array);
            $where2 .=") ";
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

                if($filterdatafield=='loan_ac')
                {
                    $filterdatafield='c.loan_ac';
                }
                else if($filterdatafield=='e_dt')
                {
                    //$filterdatafield='b.stc_dt';
                    $filterdatafield = "DATE_FORMAT(b.e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='ac_name')
                {
                    $filterdatafield='c.ac_name';
                }
                else if($filterdatafield=='district_name')
                {
                    $filterdatafield='d.name';
                }
                else if($filterdatafield=='lawyer_name')
                {
                    $filterdatafield='l.name';
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield='j6.name';
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

                if($filterdatafield =='e_by')
                {
                    $where .= " (u.name LIKE '%".$filtervalue."%' OR u.user_id LIKE '%".$filtervalue."%') ";
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
        
        if ($sortorder == '')
        {
            $sortdatafield="b.id";
            $sortorder = "DESC";                
        }
        $this->db->select('SQL_CALC_FOUND_ROWS b.*,c.loan_ac,c.ac_name,d.name as district_name,l.name as lawyer_name,IF(FIND_IN_SET(2,u.user_group_id),1,IF(FIND_IN_SET(4,u.user_group_id),3,IF(FIND_IN_SET(10,u.user_group_id),11,17))) as verifier_group_id,
        DATE_FORMAT(b.e_dt,"%d-%m-%Y") AS e_dt,CONCAT(u.name," (",u.user_id,")")as e_by,j6.name as status
        ', FALSE)
            ->from("court_fee_adjustment b")
            ->join('cost_details c', 'b.adjustment_bill_id=c.id', 'left')
            ->join('ref_lawyer l', 'l.id=c.vendor_id', 'left')
            ->join('ref_legal_district d', 'l.district=d.id', 'left')
            ->join('users_info u', 'b.e_by=u.id', 'left')
            ->join('ref_status as j6', 'b.v_sts=j6.id', 'left')
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
	function get_grid_data_staff($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
        $where2 = "e.sts<>'0'";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('2')) //For Legal Maker
        {
            array_push($condition_array,"e.e_by='".$this->session->userdata['ast_user']['user_id']."'");
        }
        if (check_group('1')) //For Legal Checker
        {
            array_push($condition_array,multi_selected_query_maker_2($this->session->userdata['ast_user']['legal_region'],'u.legal_region'));
        }
        if(check_group('1') || check_group('2'))
        {
            $where2 .=implode(" OR ",$condition_array);
            $where2 .=") ";
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

                if($filterdatafield=='e_dt')
                {
                    $filterdatafield = "DATE_FORMAT(e.e_dt,'%d-%m-%Y')";
                }  
                else if($filterdatafield=='staff_pin')
                {
                    $filterdatafield='u.pin';
                }
                else if($filterdatafield=='employee_name')
                {
                    $filterdatafield='u.name';
                }
                else if($filterdatafield=='functional_desig')
                {
                    $filterdatafield='e.functional_desig';
                }
                else if($filterdatafield=='billing_month')
                {
                    $filterdatafield='m.name';
                }
                else if($filterdatafield=='legal_region')
                {
                    $filterdatafield='r.name';
                }
                else if($filterdatafield=='district')
                {
                    $filterdatafield='d.name';
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield='j6.name';
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

                if($filterdatafield =='e_by')
                {
                    $where .= " (u.name LIKE '%".$filtervalue."%' OR u.pin LIKE '%".$filtervalue."%') ";
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
        if ($sortorder == '')
        {
            $sortdatafield="e.id";
            $sortorder = "DESC";                
        }
        $this->db->select('SQL_CALC_FOUND_ROWS e.*,fd.name as functional_desig,u.name as employee_name,u.pin as staff_pin,j6.name as status,"" as district,
        "" as legal_region,DATE_FORMAT(e.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,CONCAT(u.name," (",u.pin,")") as e_by,m.name as billing_month,IF(FIND_IN_SET(2,u.user_group_id),1,IF(FIND_IN_SET(4,u.user_group_id),3,IF(FIND_IN_SET(10,u.user_group_id),11,17))) as verifier_group_id
        ', FALSE)
            ->from("staff_conv_data e")
            ->join('users_info u', 'e.e_by=u.id', 'left')
            ->join('ref_functional_designation fd', 'fd.id=u.functional_designation_id', 'left')
            ->join('ref_billing_month m', 'm.id=e.month', 'left')
            ->join('ref_status as j6', 'e.v_sts=j6.id', 'left')
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
	function get_grid_data_court_enter($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
        $where2 = "e.sts<>'0'";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('2')) //For Legal Maker
        {
            array_push($condition_array,"e.e_by='".$this->session->userdata['ast_user']['user_id']."'");
        }
        if (check_group('1')) //For Legal Checker
        {
            array_push($condition_array,multi_selected_query_maker_2($this->session->userdata['ast_user']['legal_region'],'u.legal_region'));
        }
        if(check_group('1') || check_group('2'))
        {
            $where2 .=implode(" OR ",$condition_array);
            $where2 .=") ";
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

        		if($filterdatafield=='e_dt')
				{
					$filterdatafield = "DATE_FORMAT(e.e_dt,'%d-%m-%Y')";
				}				
				else if($filterdatafield=='employee_type')
				{
					$filterdatafield='t.name';
				}
				else if($filterdatafield=='staff_pin')
				{
					$filterdatafield='e.staff_pin';
				}
				else if($filterdatafield=='employee_name')
				{
					$filterdatafield='e.employee_name';
				}
				else if($filterdatafield=='job_grade')
				{
					$filterdatafield='e.job_grade';
				}
				else if($filterdatafield=='functional_desig')
				{
					$filterdatafield='e.functional_desig';
				}
				else if($filterdatafield=='mobile_no')
				{
					$filterdatafield='e.mobile_no';
				}
				else if($filterdatafield=='billing_month')
				{
					$filterdatafield='m.name';
				}
				else if($filterdatafield=='account_number')
				{
					$filterdatafield='e.account_number';
				}
				else if($filterdatafield=='legal_region')
				{
					$filterdatafield='r.name';
				}
				else if($filterdatafield=='district')
				{
					$filterdatafield='d.name';
				}
				else if($filterdatafield=='base_office_name')
				{
					$filterdatafield='e.base_office_name';
				}
				else if($filterdatafield=='status')
				{
					$filterdatafield='j6.name';
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

				if($filterdatafield =='e_by')
				{
					$where .= " (u.name LIKE '%".$filtervalue."%' OR u.pin LIKE '%".$filtervalue."%') ";
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
		if ($sortorder == '')
		{
			$sortdatafield="e.id";
			$sortorder = "DESC";				
		}
    	$this->db->select('SQL_CALC_FOUND_ROWS e.*,j6.name as status,t.name as employee_type,d.name as district,
    	r.name as legal_region,DATE_FORMAT(e.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,CONCAT(u.name," (",u.pin,")") as e_by,m.name as billing_month,IF(FIND_IN_SET(2,u.user_group_id),1,IF(FIND_IN_SET(4,u.user_group_id),3,IF(FIND_IN_SET(10,u.user_group_id),11,17))) as verifier_group_id
    	', FALSE)
			->from("court_entertainment_data e")
			->join('ref_employee_type t', 't.id=e.employee_type', 'left')
			->join('ref_legal_district d', 'd.id=e.district', 'left')
			->join('ref_legal_region r', 'r.id=e.legal_region', 'left')
			->join('ref_billing_month m', 'm.id=e.billing_month', 'left')
			->join('users_info u', 'e.e_by=u.id', 'left')
			->join('ref_status as j6', 'e.v_sts=j6.id', 'left')
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
	function get_grid_data_paper($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
        $where2 = "e.sts<>'0'";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('2')) //For Legal Maker
        {
            array_push($condition_array,"e.e_by='".$this->session->userdata['ast_user']['user_id']."'");
        }
        if (check_group('1')) //For Legal Checker
        {
            array_push($condition_array,multi_selected_query_maker_2($this->session->userdata['ast_user']['legal_region'],'u.legal_region'));
        }
        if(check_group('1') || check_group('2'))
        {
            $where2 .=implode(" OR ",$condition_array);
            $where2 .=") ";
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
				else if($filterdatafield=='proposed_type')
				{
					$filterdatafield='e.proposed_type';
				}
				else if($filterdatafield=='loan_ac')
				{
					$filterdatafield='e.loan_ac';
				}
				else if($filterdatafield=='ac_name')
				{
					$filterdatafield='e.ac_name';
				}
				else if($filterdatafield=='status')
				{
					$filterdatafield='j6.name';
				}
				else if($filterdatafield=='district_name')
				{
					$filterdatafield='d.name';
				}
				else if($filterdatafield=='case_number')
				{
					$filterdatafield='e.case_number';
				}
				else if($filterdatafield=='under_section_name')
				{
					$filterdatafield='us.name';
				}
                else if($filterdatafield=='e_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(e.e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='v_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(e.v_dt,'%d-%b-%y %h:%i %p')";
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

				if($filterdatafield =='e_by')
                {
                    $where .= " (j1.name LIKE '%".$filtervalue."%' OR j1.user_id LIKE '%".$filtervalue."%') ";
                }
                else if($filterdatafield =='v_by')
                {
                    $where .= " (j2.name LIKE '%".$filtervalue."%' OR j2.user_id LIKE '%".$filtervalue."%') ";
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
		if ($sortorder == '')
		{
			$sortdatafield="e.id";
			$sortorder = "DESC";				
		}
    	$this->db->select('SQL_CALC_FOUND_ROWS e.*,j6.name as status,d.name as district_name,us.name as under_section_name,
    	u.user_group_id,DATE_FORMAT(e.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
            DATE_FORMAT(e.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
            CONCAT(j1.name," (",j1.user_id,")")as e_by,
            CONCAT(j2.name," (",j2.user_id,")")as v_by,
        IF(FIND_IN_SET(2,u.user_group_id),1,IF(FIND_IN_SET(4,u.user_group_id),3,IF(FIND_IN_SET(10,u.user_group_id),11,IF(FIND_IN_SET(12,u.user_group_id),12,17)))) as verifier_group_id
    	', FALSE)
			->from("paper_bill_data e")
			->join('ref_legal_district d', 'd.id=e.district', 'left')
			->join('ref_under_section us', 'us.id=e.under_section', 'left')
			->join('users_info u', 'e.e_by=u.id', 'left')
			->join('ref_status as j6', 'e.v_sts=j6.id', 'left')
            ->join('users_info as j1', 'e.e_by=j1.id', 'left')
            ->join('users_info as j2', 'e.v_by=j2.id', 'left')
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
	function get_grid_data_others($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
        $where2 = "e.sts<>'0' and e.module_name='others'";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('2')) //For Legal Maker
        {
            array_push($condition_array,"e.e_by='".$this->session->userdata['ast_user']['user_id']."'");
        }
        if (check_group('1')) //For Legal Checker
        {
            array_push($condition_array,multi_selected_query_maker_2($this->session->userdata['ast_user']['legal_region'],'u.legal_region'));
        }
        if(check_group('1') || check_group('2'))
        {
            $where2 .=implode(" OR ",$condition_array);
            $where2 .=") ";
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
				else if($filterdatafield=='expenses_name')
				{
					$filterdatafield='t.name';
				}
				else if($filterdatafield=='vendor_name')
				{
					$filterdatafield='e.name';
				}
				else if($filterdatafield=='act_name')
				{
					$filterdatafield='s.name';
				}
				else if($filterdatafield=='status')
				{
					$filterdatafield='j6.name';
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
		if ($sortorder == '')
		{
			$sortdatafield="e.id";
			$sortorder = "DESC";				
		}
    	$this->db->select('SQL_CALC_FOUND_ROWS e.*,j6.name as status,t.name as expenses_name,e.vendor_name as vendor_name,
    	DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,s.name as act_name,u.user_group_id,IF(FIND_IN_SET(2,u.user_group_id),1,IF(FIND_IN_SET(4,u.user_group_id),3,IF(FIND_IN_SET(10,u.user_group_id),11,17))) as verifier_group_id
    	', FALSE)
			->from("expenses e")
			->join('ref_expense_type t', 't.id=e.expense_type', 'left')
			->join('users_info u', 'e.e_by=u.id', 'left')
			->join('ref_status as j6', 'e.v_sts=j6.id', 'left')
			->join('ref_others_cost_activities s', 's.id=e.activities_name', 'left')
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
        
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
        j0.loan_ac,j0.ac_name,IF(j0.activities_id=1,CONCAT(rq.name,' Legal Notice'),j0.case_number) as case_number,
        IF(j0.activities_id=0,j0.description,IF(j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter',hc.name,IF(j0.main_table_name='case_against_bank',ca.name,IF(j0.main_table_name='legal_affairs',la.name,IF(j0.req_type=2,ar.name,ni.name))))) as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_req_type as rq on (j0.req_type=rq.id)
            LEFT OUTER JOIN ref_schedule_charges_ara as ar on (j0.activities_id=ar.id and j0.req_type=2 AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (j0.activities_id=ni.id and (j0.req_type=1 or j0.req_type=3 or j0.req_type=4) AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (j0.activities_id=hc.id AND (j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (j0.activities_id=ca.id AND j0.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (j0.activities_id=la.id AND j0.main_table_name='legal_affairs')
            WHERE j0.module_name<>'high_court' AND (j0.memo_sts=0 OR j0.memo_sts IS NULL) AND (j0.legal_select_sts=0 OR j0.legal_select_sts IS NULL) AND j0.vendor_type= 1 AND j0.main_table_name<>'legal_notice' $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_court_fee($id=NULL,$month=NULL)
    {
        $where='';
        $where2='';
        $join='';
        $select='';
        if($month!='')
        {
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
        }
        //For type wise where condition
        if($id!=NULL && $id!=0 && $id!='')
        {
            $where2.="AND j0.vendor_id='".$id."'";
        }
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(j0.txrn_dt)='".$_POST['year']."'";
        }

        $select="CONCAT(u.name,' (',u.code,')')";
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=4)';
        
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
        j0.loan_ac,j0.ac_name,j0.case_number,
        IF(j0.activities_id=0,j0.description,co.name) as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_court_fee_activities as co on (j0.activities_id=co.id AND j0.main_table_name='cma')
            WHERE (j0.memo_sts=0 OR j0.memo_sts IS NULL) AND ((j0.adjustment_sts IS NULL OR j0.adjustment_sts = '' OR j0.adjustment_sts = 0) OR (j0.adjustment_sts=1 AND (j0.fully_adjust_sts IS NULL OR j0.fully_adjust_sts = '' OR j0.fully_adjust_sts = 0) AND j0.adjust_v_sts=13)) AND (j0.legal_select_sts=0 OR j0.legal_select_sts IS NULL) AND j0.vendor_type= 4 $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_court_adjust($id=NULL,$month=NULL)
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

        $select="CONCAT(u.name,' (',u.code,')')";
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=4)';
        
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
        j0.loan_ac,j0.ac_name,j0.case_number,d.name as district_name,
        IF(j0.activities_id=0,j0.description,co.name) as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_court_fee_activities as co on (j0.activities_id=co.id AND j0.main_table_name='cma')
            LEFT OUTER JOIN ref_legal_district d ON(d.id=u.district)
            WHERE j0.memo_sts=88 AND ((j0.adjustment_sts IS NULL OR j0.adjustment_sts = '' OR j0.adjustment_sts = 0) OR (j0.adjustment_sts=1 AND (j0.fully_adjust_sts IS NULL OR j0.fully_adjust_sts = '' OR j0.fully_adjust_sts = 0) AND j0.adjust_v_sts=13)) AND (j0.court_fee_return_sts IS NULL OR j0.court_fee_return_sts = '' OR j0.court_fee_return_sts=0) AND j0.vendor_type= 4 $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
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
        j0.loan_ac,j0.ac_name,IF(j0.activities_id=1,CONCAT(rq.name,' Legal Notice'),j0.case_number) as case_number,
        IF(j0.activities_id=0,j0.description,IF(j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter',hc.name,IF(j0.main_table_name='case_against_bank',ca.name,IF(j0.main_table_name='legal_affairs',la.name,IF(j0.req_type=2,ar.name,ni.name))))) as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_req_type as rq on (j0.req_type=rq.id)
            LEFT OUTER JOIN ref_schedule_charges_ara as ar on (j0.activities_id=ar.id and j0.req_type=2 AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (j0.activities_id=ni.id and (j0.req_type=1 or j0.req_type=3 or j0.req_type=4) AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (j0.activities_id=hc.id AND (j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (j0.activities_id=ca.id AND j0.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (j0.activities_id=la.id AND j0.main_table_name='legal_affairs')
            WHERE j0.module_name<>'high_court' AND (j0.memo_sts=0 OR j0.memo_sts IS NULL) AND (j0.legal_select_sts=0 OR j0.legal_select_sts IS NULL OR j0.legal_select_sts=95 OR j0.legal_select_sts=90) AND j0.vendor_type= 1 AND j0.main_table_name<>'legal_notice'$where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_bill_details_court_fee($id=NULL,$month=NULL,$year=NULL)
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
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=4)';
        
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
        j0.loan_ac,j0.ac_name,j0.case_number,
        IF(j0.activities_id=0,j0.description,co.name) as activities_name
        FROM cost_details as j0
        $join
        LEFT OUTER JOIN ref_court_fee_activities as co on (j0.activities_id=co.id AND j0.main_table_name='cma')
        LEFT OUTER JOIN bill_summery b on(b.id=j0.bill_id)
        WHERE (j0.memo_sts=0 OR j0.memo_sts IS NULL) AND ((j0.adjustment_sts IS NULL OR j0.adjustment_sts = '' OR j0.adjustment_sts = 0) OR (j0.adjustment_sts=1 AND (j0.fully_adjust_sts IS NULL OR j0.fully_adjust_sts = '' OR j0.fully_adjust_sts = 0) AND j0.adjust_v_sts=13)) AND (j0.legal_select_sts=0 OR j0.legal_select_sts IS NULL OR j0.legal_select_sts=95 OR j0.legal_select_sts=90)  AND j0.vendor_type=4$where2 ORDER BY j0.txrn_dt ASC";
        $query=$this->db->query($str);
        return $query->result();
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
	    $table_name = "expenses";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";
	    $change_date_format = str_replace('/', '-', (string)$this->input->post('activities_date'));
	    $act_date = date('Y-m-d',strtotime($change_date_format));
	    
	    //AIT & VAT Data
	    $expenses = array(
			'module_name' =>'staff',
			'district' =>$this->security->xss_clean( $this->input->post('district')),
			'expense_type' =>3,
			'vendor_id' =>$this->security->xss_clean( $this->input->post('staff')),
			'activities_name' =>$this->security->xss_clean( $this->input->post('activities')),
			'activities_date' =>$this->security->xss_clean( $act_date),
			'amount' =>$this->security->xss_clean( $this->input->post('amount')),
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),

		);
		if($add_edit=="add")
		{
			$expenses['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['e_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 39;
			$this->db->insert('expenses', $expenses);
			$insert_idss = $this->db->insert_id();

		    $activities_id = 39;
		    $description_activities = 'Add Staff Conveyance - ';
		}
		else
		{
	  		$expenses['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['u_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 35;
			$this->db->where('id', $edit_id);
			$this->db->update('expenses', $expenses);
	  		$insert_idss = $edit_id;

	        $activities_id = 35;
	        $description_activities = 'Edit Staff Conveyance - ';

		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities_bill($activities_id,'expenses',$insert_idss,$table_name,$description_activities);
			// echo $insert_idss;
			// exit;
			return $insert_idss;
		}


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
    function get_staff()
    {
    	$str=" SELECT j0.pin,j0.id,j0.name
            FROM users_info as j0
            WHERE 
            j0.verify_status = '0' 
            AND j0.block_status = '0'
            AND j0.admin_status <> '2' ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function add_edit_court_adjust($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
    {
        $this->db->trans_begin();
        if($editrow==""){$editrow=0;}
        $table_name = "court_fee_adjustment";
        $activities_datetime = date('Y-m-d H:i:s');
        $activities_by = $this->session->userdata['ast_user']['user_id'];
        $ip_address = $this->input->ip_address();
        $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
        $activities_id = "";
        $description_activities = "";
        $str = explode("_",$this->security->xss_clean( $this->input->post('new_court_fee')));
        $new_amount = $str[1];
        $old_amount = $this->security->xss_clean( $this->input->post('court_fee_amount_from'));
        $final_amount = $old_amount-$new_amount;
        if($final_amount>0)//when old amount bigger then new amount
        {
            $remainig_belance_from = $final_amount;
            $remaining_belance_with = 0;
        }
        else if($final_amount==0)//when both amount are same
        {
            $remainig_belance_from = 0;
            $remaining_belance_with = 0;
        }
        else //when new amount bigger then old amount
        {
            $remainig_belance_from = 0;
            $remaining_belance_with = $new_amount-$old_amount;
        }
        $lawyer_ack_copy = $this->get_file_name('lawyer_ack_copy','cma_file/lawyer_ack_copy/');
        $expenses = array(
            'lawyer_id' =>$this->security->xss_clean( $this->input->post('hidden_lawyer_id')),
            'adjustment_bill_id' =>$this->security->xss_clean( $this->input->post('adjust_bill_id')),
            'adjustment_reason' =>$this->security->xss_clean( $this->input->post('adjustment_reason')),
            'new_account_bill_id' =>$str[0],
            'lawyer_ack_copy' =>$lawyer_ack_copy,
            'purchase_status' =>$this->security->xss_clean( $this->input->post('purchase_status')),
            'adjustment_amount_from' =>$old_amount,
            'adjustment_amount_with' =>$new_amount,
            'remainig_belance_from' =>$remainig_belance_from,
            'remaining_belance_with' =>$remaining_belance_with,
        );
        
        if($add_edit=="add")
        {
            $expenses['e_by'] = $this->session->userdata['ast_user']['user_id'];
            $expenses['e_dt'] = date('Y-m-d H:i:s');
            $expenses['v_sts'] = 39;
            $this->db->insert('court_fee_adjustment', $expenses);
            $insert_idss = $this->db->insert_id();
            $activities_id = 39;
            $description_activities = 'Add Court Fee Adjustment - ';
            //Updating Bill Tble
            $data = array();
            $data['adjust_v_sts'] = 39;
            $data['adjustment_sts'] = 1;
            $data['adjustment_from'] = $this->security->xss_clean( $this->input->post('adjust_bill_id'));
            if($final_amount>=0)
            {
                $data['fully_adjust_sts'] = 1;
            }
            else
            {
                $data['remaining_belance'] = $new_amount-$old_amount;
            }
            $this->db->where('id', $str[0]);
            $this->db->update('cost_details', $data);

            $data = array();
            $data['adjust_v_sts'] = 39;
            $data['adjustment_sts'] = 1;
            $data['adjustment_with'] = $str[0];
            if($final_amount>0)
            {
                $data['remaining_belance'] = $old_amount-$new_amount;
                
            }
            else
            {
                $data['fully_adjust_sts'] = 1;
            }
            $this->db->where('id', $this->security->xss_clean( $this->input->post('adjust_bill_id')));
            $this->db->update('cost_details', $data);
        }
        else
        {
            $row = $this->db->query("SELECT c.adjustment_bill_id,c.new_account_bill_id
             FROM court_fee_adjustment as c 
                WHERE c.id='".$edit_id."' LIMIT 1")->row();
            $adjust_ac = $row->adjustment_bill_id;
            $new_ac = $row->new_account_bill_id;
            $data = array();
            $data['adjust_v_sts'] = "";
            $data['adjustment_sts'] = "";
            $data['adjustment_from'] = "";
            $data['adjustment_with'] = "";
            $data['remaining_belance'] = "";
            $data['fully_adjust_sts'] = "";
            $this->db->where('id', $adjust_ac);
            $this->db->update('cost_details', $data);

            $this->db->where('id', $new_ac);
            $this->db->update('cost_details', $data);

            $expenses['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $expenses['u_dt'] = date('Y-m-d H:i:s');
            $expenses['v_sts'] = 35;
            $this->db->where('id', $edit_id);
            $this->db->update('court_fee_adjustment', $expenses);
            $insert_idss = $edit_id;
            $activities_id = 35;
            $description_activities = 'Edit Court Fee Adjustment - ';

            //Updating Bill Tble
            $data = array();
            $data['adjust_v_sts'] = 39;
            $data['adjustment_sts'] = 1;
            $data['adjustment_from'] = $this->security->xss_clean( $this->input->post('adjust_bill_id'));
            if($final_amount>0)
            {
                $data['fully_adjust_sts'] = 1;
            }
            else
            {
                $data['remaining_belance'] = $new_amount-$old_amount;
            }
            $this->db->where('id', $str[0]);
            $this->db->update('cost_details', $data);

            $data = array();
            $data['adjust_v_sts'] = 39;
            $data['adjustment_sts'] = 1;
            $data['adjustment_with'] = $str[0];
            if($final_amount>0)
            {
                $data['remaining_belance'] = $old_amount-$new_amount;
                
            }
            else
            {
                $data['fully_adjust_sts'] = 1;
            }
            $this->db->where('id', $this->security->xss_clean( $this->input->post('adjust_bill_id')));
            $this->db->update('cost_details', $data);

        }
        

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return 00;
        }
        else
        {
            $this->db->trans_commit();
            $this->User_model->user_activities_bill($activities_id,'expenses',$insert_idss,$table_name,$description_activities);
            return $insert_idss;
        }


    }
	function add_edit_action_court_enter($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
	{
		$this->db->trans_begin();
        if($editrow==""){$editrow=0;}
	    $table_name = "court_entertainment_data";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";
	    $court_approval_file = $this->get_file_name('court_approval_file','cma_file/court_approval_file/');
	    $expenses = array(
	    	'employee_type' =>$this->security->xss_clean( $this->input->post('employee_type')),
			'staff_pin' =>$this->session->userdata["ast_user"]["pin"],
			'staff_id' =>$this->session->userdata["ast_user"]["user_id"],
			'employee_name' =>$this->session->userdata["ast_user"]["user_name"],
			'court_approval_file' =>$court_approval_file,
			'job_grade' =>$this->security->xss_clean( $this->input->post('job_grade')),
			'functional_desig' =>$this->session->userdata["ast_user"]["functional_designation_id"],
			'mobile_no' =>$this->security->xss_clean( $this->input->post('mobile_no')),
			'billing_month' =>$this->security->xss_clean( $this->input->post('billing_month')),
			'account_number' =>$this->security->xss_clean( $this->input->post('account_number')),
			'legal_region' =>$this->session->userdata["ast_user"]["legal_region"],
			'district' =>$this->session->userdata["ast_user"]["legal_district"],
			'base_office_name' =>$this->security->xss_clean( $this->input->post('base_office_name'))

		);

		if($add_edit=="add")
		{
			$expenses['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['e_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 39;
			$this->db->insert('court_entertainment_data', $expenses);
			$insert_idss = $this->db->insert_id();
			for($i=1;$i<= $_POST['expense_counter'];$i++)
	        {
	            $expense_data = array(
	            'event_id' => $insert_idss,
	            'module_name' =>'court',
	            'expense_type' =>5, //Court Entertainment
	            'suit_id' =>$this->security->xss_clean( $this->input->post('suit_id_'.$i)),
	            'proposed_type' =>$this->security->xss_clean( $this->input->post('proposed_type_'.$i)),
	            'account_number' =>$this->security->xss_clean( $this->input->post('account_no_'.$i)),
	            'req_type' =>$this->security->xss_clean( $this->input->post('req_type_'.$i)),
	            'ac_name' =>$this->security->xss_clean( $this->input->post('ac_name_'.$i)),
	            'case_number' =>$this->security->xss_clean( $this->input->post('case_no_'.$i)),
	            'activities_name' => $this->security->xss_clean( $this->input->post('activities_name_'.$i)),
	            'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
	            'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
            	'remarks' => $this->security->xss_clean( $this->input->post('particulars_'.$i)),
            	'vendor_name' => $this->session->userdata["ast_user"]["user_name"],
            	'vendor_pin' => $this->session->userdata["ast_user"]["pin"],
            	'region' => $this->session->userdata["ast_user"]["legal_region"],
            	'district' => $this->session->userdata["ast_user"]["legal_district"],
            	'vendor_id' => $this->session->userdata["ast_user"]["user_id"],
            	'vendor_ac_no' => $this->security->xss_clean( $this->input->post('account_number'))
	            );
	            if ($_POST['proposed_type_'.$i]=='Card') 
				{
					$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac_'.$i)); 
				}
				else{$org_loan_ac='';}
				$expense_data['org_loan_ac'] = $org_loan_ac;
	            if ($_POST['expense_delete_'.$i]!=1) {
	                $this->db->insert('expenses', $expense_data);
	            }
	            $insert_idss2 = $this->db->insert_id();
	        }
		    $activities_id = 39;
		    $description_activities = 'Add Court Entertainment - ';
		}
		else
		{
	  		$expenses['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['u_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 35;
			$this->db->where('id', $edit_id);
			$this->db->update('court_entertainment_data', $expenses);
	  		$insert_idss = $edit_id;
	  		for($i=1;$i<= $_POST['expense_counter'];$i++)
	        {
	            $expense_data = array(
	            'event_id' => $insert_idss,
	            'module_name' =>'court',
	            'expense_type' =>5, //Court Entertainment
	            'suit_id' =>$this->security->xss_clean( $this->input->post('suit_id_'.$i)),
	            'proposed_type' =>$this->security->xss_clean( $this->input->post('proposed_type_'.$i)),
	            'account_number' =>$this->security->xss_clean( $this->input->post('account_no_'.$i)),
	            'req_type' =>$this->security->xss_clean( $this->input->post('req_type_'.$i)),
	            'ac_name' =>$this->security->xss_clean( $this->input->post('ac_name_'.$i)),
	            'case_number' =>$this->security->xss_clean( $this->input->post('case_no_'.$i)),
	            'activities_name' => $this->security->xss_clean( $this->input->post('activities_name_'.$i)),
	            'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
	            'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
            	'remarks' => $this->security->xss_clean( $this->input->post('particulars_'.$i)),
            	'vendor_name' => $this->session->userdata["ast_user"]["user_name"],
            	'vendor_pin' => $this->session->userdata["ast_user"]["pin"],
            	'region' => $this->session->userdata["ast_user"]["region"],
            	'district' => $this->session->userdata["ast_user"]["district"],
            	'vendor_id' => $this->session->userdata["ast_user"]["user_id"],
            	'vendor_ac_no' => $this->security->xss_clean( $this->input->post('account_number'))
	            );
	            if ($_POST['proposed_type_'.$i]=='Card' && $_POST['hidden_loan_ac_'.$i]=='') //For old card data
				{
					$org_loan_ac=$_POST['hidden_pre_org_ac_'.$i];
				}
				else if($_POST['proposed_type_'.$i]=='Card' && $_POST['hidden_loan_ac_'.$i]!='') //For Updateed Card Data
				{
					$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac_'.$i)); 
				}
				else{$org_loan_ac='';}
				$expense_data['org_loan_ac'] = $org_loan_ac;
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
	                $this->db->where('id',$_POST['expense_edit_'.$i]);
	                $this->db->update('expenses', $expense_data);
	            }
	            //For insert the new row
	            else if($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==0)
	            {
	                $this->db->insert('expenses', $expense_data);
	            }
	            
	        }
	        $activities_id = 35;
	        $description_activities = 'Edit Court Entertainment - ';

		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities_bill($activities_id,'expenses',$insert_idss,$table_name,$description_activities);
			// echo $insert_idss;
			// exit;
			return $insert_idss;
		}


	}
    function add_edit_action_staff_conv($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
    {
        $this->db->trans_begin();
        if($editrow==""){$editrow=0;}
        $table_name = "staff_conv_data";
        $table_row_id = $editrow+1;
        $activities_datetime = date('Y-m-d H:i:s');
        $activities_by = $this->session->userdata['ast_user']['user_id'];
        $ip_address = $this->input->ip_address();
        $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
        $activities_id = "";
        $description_activities = "";
        $data = array(
            'staff_id' =>$this->session->userdata['ast_user']['user_id'],
            'year' =>$this->security->xss_clean( $this->input->post('year')),
            'month' =>$this->security->xss_clean( $this->input->post('month')),
            'conv_type' =>$this->security->xss_clean( $this->input->post('staff_conv_type'))
        );

        if($add_edit=="add")
        {
            $data['e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['e_dt'] = date('Y-m-d H:i:s');
            $data['v_sts'] = 39;
            $this->db->insert('staff_conv_data', $data);
            $insert_idss = $this->db->insert_id();
            $type = $this->security->xss_clean( $this->input->post('staff_conv_type'));
            for($i=1;$i<= $_POST['expense_counter'];$i++)
            {
                if($type==1)
                {
                    $expense_data = array(
                    'event_id' => $insert_idss,
                    'module_name' =>'staff',
                    'expense_type' =>3, //Staff Conveyence
                    'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
                    'movement_details' =>$this->security->xss_clean( $this->input->post('movement_details_'.$i)),
                    'move_of_transfortaion' =>$this->security->xss_clean( $this->input->post('transportaion_mode_'.$i)),
                    'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
                    'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
                    'vendor_id' => $this->session->userdata["ast_user"]["user_id"]
                    );
                }
                else if($type==2)
                {
                    $expense_data = array(
                    'event_id' => $insert_idss,
                    'module_name' =>'staff',
                    'expense_type' =>3, //Staff Conveyence
                    'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
                    'particulars' =>$this->security->xss_clean( $this->input->post('particulars_'.$i)),
                    'place' =>$this->security->xss_clean( $this->input->post('place_'.$i)),
                    'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
                    'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
                    'vendor_id' => $this->session->userdata["ast_user"]["user_id"]
                    );
                }
                else if($type==3)
                {
                    $expense_data = array(
                    'event_id' => $insert_idss,
                    'module_name' =>'staff',
                    'expense_type' =>3, //Staff Conveyence
                    'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
                    'description_of_journey' =>$this->security->xss_clean( $this->input->post('description_'.$i)),
                    'journey_time' =>$this->security->xss_clean( $this->input->post('journey_time_'.$i)),
                    'journey_metar' =>$this->security->xss_clean( $this->input->post('journey_metar_'.$i)),
                    'reached_time' =>$this->security->xss_clean( $this->input->post('reached_time_'.$i)),
                    'reached_metar' =>$this->security->xss_clean( $this->input->post('reached_metar_'.$i)),
                    'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
                    'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
                    'vendor_id' => $this->session->userdata["ast_user"]["user_id"]
                    );
                }
                else if($type==4)
                {
                    $expense_data = array(
                    'event_id' => $insert_idss,
                    'module_name' =>'staff',
                    'expense_type' =>3, //Staff Conveyence
                    'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
                    'purpose' =>$this->security->xss_clean( $this->input->post('purpose_'.$i)),
                    'from' =>$this->security->xss_clean( $this->input->post('from_'.$i)),
                    'time_out' =>$this->security->xss_clean( $this->input->post('time_out_'.$i)),
                    'to' =>$this->security->xss_clean( $this->input->post('to_'.$i)),
                    'time_in' =>$this->security->xss_clean( $this->input->post('time_in_'.$i)),
                    'mode' =>$this->security->xss_clean( $this->input->post('mode_'.$i)),
                    'breakdown_bill' =>$this->security->xss_clean( $this->input->post('breakdown_bill_'.$i)),
                    'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
                    'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
                    'vendor_id' => $this->session->userdata["ast_user"]["user_id"]
                    );
                }
                else if($type==5)
                {
                    $expense_data = array(
                    'event_id' => $insert_idss,
                    'module_name' =>'staff',
                    'expense_type' =>3, //Staff Conveyence
                    'from_date' => implode('-',array_reverse(explode('/',$this->input->post('from_date_'.$i)))),
                    'to_date' => implode('-',array_reverse(explode('/',$this->input->post('to_date_'.$i)))),
                    'particulars' =>$this->security->xss_clean( $this->input->post('particulars_'.$i)),
                    'place' =>$this->security->xss_clean( $this->input->post('place_'.$i)),
                    'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
                    'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
                    'vendor_id' => $this->session->userdata["ast_user"]["user_id"]
                    );
                }
                else
                {
                    $expense_data = array(
                    'event_id' => $insert_idss,
                    'module_name' =>'staff',
                    'expense_type' =>3, //Staff Conveyence
                    'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
                    'movement_details' =>$this->security->xss_clean( $this->input->post('movement_details_'.$i)),
                    'move_of_transfortaion' =>$this->security->xss_clean( $this->input->post('transportaion_mode_'.$i)),
                    'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
                    'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
                    'vendor_id' => $this->session->userdata["ast_user"]["user_id"]
                    );
                }
                
                if ($_POST['expense_delete_'.$i]!=1) {
                    $this->db->insert('expenses', $expense_data);
                }
                $insert_idss2 = $this->db->insert_id();
            }
            $activities_id = 39;
            $description_activities = 'Add Staff Conv - ';
        }
        else
        {
            $expenses['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $expenses['u_dt'] = date('Y-m-d H:i:s');
            $expenses['v_sts'] = 35;
            $this->db->where('id', $edit_id);
            $this->db->update('staff_conv_data', $expenses);
            $insert_idss = $edit_id;
            $type = $this->security->xss_clean( $this->input->post('staff_conv_type'));
            for($i=1;$i<= $_POST['expense_counter'];$i++)
            {
                if($type==1)
                {
                    $expense_data = array(
                    'event_id' => $insert_idss,
                    'module_name' =>'staff',
                    'expense_type' =>3, //Staff Conveyence
                    'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
                    'movement_details' =>$this->security->xss_clean( $this->input->post('movement_details_'.$i)),
                    'move_of_transfortaion' =>$this->security->xss_clean( $this->input->post('transportaion_mode_'.$i)),
                    'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
                    'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
                    'vendor_id' => $this->session->userdata["ast_user"]["user_id"]
                    );
                }
                else if($type==2)
                {
                    $expense_data = array(
                    'event_id' => $insert_idss,
                    'module_name' =>'staff',
                    'expense_type' =>3, //Staff Conveyence
                    'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
                    'particulars' =>$this->security->xss_clean( $this->input->post('particulars_'.$i)),
                    'place' =>$this->security->xss_clean( $this->input->post('place_'.$i)),
                    'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
                    'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
                    'vendor_id' => $this->session->userdata["ast_user"]["user_id"]
                    );
                }
                else if($type==3)
                {
                    $expense_data = array(
                    'event_id' => $insert_idss,
                    'module_name' =>'staff',
                    'expense_type' =>3, //Staff Conveyence
                    'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
                    'description_of_journey' =>$this->security->xss_clean( $this->input->post('description_'.$i)),
                    'journey_time' =>$this->security->xss_clean( $this->input->post('journey_time_'.$i)),
                    'journey_metar' =>$this->security->xss_clean( $this->input->post('journey_metar_'.$i)),
                    'reached_time' =>$this->security->xss_clean( $this->input->post('reached_time_'.$i)),
                    'reached_metar' =>$this->security->xss_clean( $this->input->post('reached_metar_'.$i)),
                    'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
                    'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
                    'vendor_id' => $this->session->userdata["ast_user"]["user_id"]
                    );
                }
                else if($type==4)
                {
                    $expense_data = array(
                    'event_id' => $insert_idss,
                    'module_name' =>'staff',
                    'expense_type' =>3, //Staff Conveyence
                    'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
                    'purpose' =>$this->security->xss_clean( $this->input->post('purpose_'.$i)),
                    'from' =>$this->security->xss_clean( $this->input->post('from_'.$i)),
                    'time_out' =>$this->security->xss_clean( $this->input->post('time_out_'.$i)),
                    'to' =>$this->security->xss_clean( $this->input->post('to_'.$i)),
                    'time_in' =>$this->security->xss_clean( $this->input->post('time_in_'.$i)),
                    'mode' =>$this->security->xss_clean( $this->input->post('mode_'.$i)),
                    'breakdown_bill' =>$this->security->xss_clean( $this->input->post('breakdown_bill_'.$i)),
                    'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
                    'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
                    'vendor_id' => $this->session->userdata["ast_user"]["user_id"]
                    );
                }
                else if($type==5)
                {
                    $expense_data = array(
                    'event_id' => $insert_idss,
                    'module_name' =>'staff',
                    'expense_type' =>3, //Staff Conveyence
                    'from_date' => implode('-',array_reverse(explode('/',$this->input->post('from_date_'.$i)))),
                    'to_date' => implode('-',array_reverse(explode('/',$this->input->post('to_date_'.$i)))),
                    'particulars' =>$this->security->xss_clean( $this->input->post('particulars_'.$i)),
                    'place' =>$this->security->xss_clean( $this->input->post('place_'.$i)),
                    'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
                    'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
                    'vendor_id' => $this->session->userdata["ast_user"]["user_id"]
                    );
                }
                else
                {
                    $expense_data = array(
                    'event_id' => $insert_idss,
                    'module_name' =>'staff',
                    'expense_type' =>3, //Staff Conveyence
                    'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
                    'movement_details' =>$this->security->xss_clean( $this->input->post('movement_details_'.$i)),
                    'move_of_transfortaion' =>$this->security->xss_clean( $this->input->post('transportaion_mode_'.$i)),
                    'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
                    'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i)),
                    'vendor_id' => $this->session->userdata["ast_user"]["user_id"]
                    );
                }
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
                    $this->db->where('id',$_POST['expense_edit_'.$i]);
                    $this->db->update('expenses', $expense_data);
                }
                //For insert the new row
                else if($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==0)
                {
                    $this->db->insert('expenses', $expense_data);
                }
                
            }
            $activities_id = 35;
            $description_activities = 'Edit Staff Conveyence - ';

        }


        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return 00;
        }
        else
        {
            $this->db->trans_commit();
            $this->User_model->user_activities_bill($activities_id,'expenses',$insert_idss,$table_name,$description_activities);
            return $insert_idss;
        }


    }
	function add_edit_action_paper($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
	{
		$this->db->trans_begin();
        if($editrow==""){$editrow=0;}
	    $table_name = "expenses";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $activities_id = "";
	    $description_activities = "";
	    
	 	if ($_POST['proposed_type']=='Card') 
		{
			$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac')); 
		}
		else{$org_loan_ac='';}
        $case_number = $this->security->xss_clean( $this->input->post('case_number'));
        $suit_id = $this->security->xss_clean( $this->input->post('hidden_suit_id'));
        if($this->security->xss_clean( $this->input->post('account_type'))==2)//after case
        {
            $row = $this->db->query("SELECT c.id,c.case_number 
                FROM suit_filling_info as c 
                WHERE c.id='".$this->security->xss_clean( $this->input->post('case_number'))."' LIMIT 1")->row();
            $case_number = $row->case_number;
            $suit_id = $row->id;
        }
	    $paper_data = array(
	    	'proposed_type' =>$this->security->xss_clean( $this->input->post('proposed_type')),
	    	'req_type' =>$this->security->xss_clean( $this->input->post('req_type')),
	    	'pre_pub_dt' =>$this->security->xss_clean( $this->input->post('hidden_pre_pub_dt')),
	    	'pre_pub_paper_name' =>$this->security->xss_clean( $this->input->post('hidden_pre_paper_id')),
	    	'pre_pub_copy' =>$this->security->xss_clean( $this->input->post('hidden_pre_pub_file')),
	    	'pre_pub_id' =>$this->security->xss_clean( $this->input->post('hidden_pre_pub_id')),
	    	'loan_ac' =>$this->security->xss_clean( $this->input->post('loan_ac')),
			'ac_name' =>$this->security->xss_clean( $this->input->post('hidden_ac_name')),
			'account_type' =>$this->security->xss_clean( $this->input->post('account_type')),
			'district' =>$this->security->xss_clean( $this->input->post('hidden_district_id')),
			'under_section' =>$this->security->xss_clean( $this->input->post('under_section')),
			'case_number' =>$case_number,
			'cma_id' =>$this->security->xss_clean( $this->input->post('hidden_cma_id')),
			'suit_id' =>$suit_id,
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),

		);
		if($add_edit=="add")
		{
			$paper_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$paper_data['e_dt'] = date('Y-m-d H:i:s');
			$paper_data['v_sts'] = 39;
			$this->db->insert('paper_bill_data', $paper_data);
			$insert_idss = $this->db->insert_id();
			for($i=1;$i<= $_POST['expense_counter'];$i++)
	        {
	        	$paper_scan_copy = $this->get_file_name('paper_scan_copy_'.$i,'cma_file/paper_scan_copy/');
	        	$paper_expense_approval_file = $this->get_file_name('paper_expense_approval_file_'.$i,'cma_file/paper_expense_approval_file/');
	            if($this->security->xss_clean( $this->input->post('vendor_type_'.$i))=='Vendor')
	            {
	            	$vendor_id = $this->security->xss_clean( $this->input->post('paper_vendor_'.$i));
	            }
	            else
	            {
	            	$vendor_id = $this->security->xss_clean( $this->input->post('staff_'.$i));
	            }
	            $expense_data = array(
	            'event_id' => $insert_idss,
	            'module_name' =>'paper',
	            'expense_type' =>2, //Paper Bill
	            'vendor_id' =>$vendor_id,
	            'account_no' =>$this->security->xss_clean( $this->input->post('account_no_'.$i)),
	            'vendor_type' =>$this->security->xss_clean( $this->input->post('vendor_type_'.$i)),
	            'tin' =>$this->security->xss_clean( $this->input->post('tin_'.$i)),
	            'bin' =>$this->security->xss_clean( $this->input->post('bin_'.$i)),
	            'mousak' =>$this->security->xss_clean( $this->input->post('mousak_'.$i)),
	            'paper_name' =>$this->security->xss_clean( $this->input->post('paper_name_'.$i)),
	            'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('publication_date_'.$i)))),
	            'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
            	'paper_scan_copy' => $paper_scan_copy,
            	'paper_expense_approval_file' => $paper_expense_approval_file
	            );
	            if ($_POST['expense_delete_'.$i]!=1) {
	                $this->db->insert('expenses', $expense_data);
	            }
	            $insert_idss2 = $this->db->insert_id();
	        }
		    $activities_id = 39;
		    $description_activities = 'Add Paper Bill - ';
		}
		else
		{
	  		$paper_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$paper_data['u_dt'] = date('Y-m-d H:i:s');
			$paper_data['v_sts'] = 35;
			$this->db->where('id', $edit_id);
			$this->db->update('paper_bill_data', $paper_data);
	  		$insert_idss = $edit_id;
	  		for($i=1;$i<= $_POST['expense_counter'];$i++)
	        {
	        	$paper_scan_copy = $this->get_file_name('paper_scan_copy_'.$i,'cma_file/paper_scan_copy/');
	            $paper_expense_approval_file = $this->get_file_name('paper_expense_approval_file_'.$i,'cma_file/paper_expense_approval_file/');
	            if($this->security->xss_clean( $this->input->post('vendor_type_'.$i))=='Vendor')
	            {
	            	$vendor_id = $this->security->xss_clean( $this->input->post('paper_vendor_'.$i));
	            }
	            else
	            {
	            	$vendor_id = $this->security->xss_clean( $this->input->post('staff_'.$i));
	            }
	            $expense_data = array(
	            'event_id' => $insert_idss,
	            'module_name' =>'paper',
	            'expense_type' =>2, //Paper Bill
	            'vendor_id' =>$vendor_id,
	            'account_no' =>$this->security->xss_clean( $this->input->post('account_no_'.$i)),
	            'vendor_type' =>$this->security->xss_clean( $this->input->post('vendor_type_'.$i)),
	            'tin' =>$this->security->xss_clean( $this->input->post('tin_'.$i)),
	            'bin' =>$this->security->xss_clean( $this->input->post('bin_'.$i)),
	            'mousak' =>$this->security->xss_clean( $this->input->post('mousak_'.$i)),
	            'paper_name' =>$this->security->xss_clean( $this->input->post('paper_name_'.$i)),
	            'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('publication_date_'.$i)))),
	            'amount' => $this->security->xss_clean( $this->input->post('amount_'.$i)),
            	'paper_scan_copy' => $paper_scan_copy,
            	'paper_expense_approval_file' => $paper_expense_approval_file
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
	                $this->db->where('id',$_POST['expense_edit_'.$i]);
	                $this->db->update('expenses', $expense_data);
	            }
	            //For insert the new row
	            else if($_POST['expense_edit_'.$i]==0 && $_POST['expense_delete_'.$i]==0)
	            {
	                $this->db->insert('expenses', $expense_data);
	            }
	        }
	        $activities_id = 35;
	        $description_activities = 'Edit Paper Bill - ';

		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities_bill($activities_id,'expenses',$insert_idss,$table_name,$description_activities);
			// echo $insert_idss;
			// exit;
			return $insert_idss;
		}


	}
	function get_vendor_info($type,$id)
    {
        if($type=='paper')
        {
        	$this->db
            ->select("b.ac,b.tin,b.bin", FALSE)
            ->from("ref_paper_vendor b")
            ->where("b.data_status='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        	$data = $this->db->get()->row();
        }
        else
        {
        	$data = array();
        }
        return $data;
    }
	function add_edit_action_others($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
	{
		$this->db->trans_begin();
        if($editrow==""){$editrow=0;}
	    $table_name = "expenses";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";
	    $change_date_format = str_replace('/', '-', (string)$this->input->post('activities_date'));
	    $act_date = date('Y-m-d',strtotime($change_date_format));
	    
	    //AIT & VAT Data
	    $expenses = array(
			'module_name' =>'others',
			'expense_type' =>6,
			'vendor_name' =>$this->security->xss_clean( $this->input->post('vendor_name')),
			'activities_name' =>$this->security->xss_clean( $this->input->post('activities')),
			'activities_date' =>$this->security->xss_clean( $act_date),
			'amount' =>$this->security->xss_clean( $this->input->post('amount')),
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),

		);
		if($add_edit=="add")
		{
			$expenses['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['e_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 39;
			$this->db->insert('expenses', $expenses);
			$insert_idss = $this->db->insert_id();

		    $activities_id = 39;
		    $description_activities = 'Add Others Bill - ';
		}
		else
		{
	  		$expenses['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$expenses['u_dt'] = date('Y-m-d H:i:s');
			$expenses['v_sts'] = 35;
			$this->db->where('id', $edit_id);
			$this->db->update('expenses', $expenses);
	  		$insert_idss = $edit_id;

	        $activities_id = 35;
	        $description_activities = 'Edit Others Bill - ';

		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities_bill($activities_id,'expenses',$insert_idss,$table_name,$description_activities);
			// echo $insert_idss;
			// exit;
			return $insert_idss;
		}


	}
	function add_edit_court_fee_return($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
	{
		$this->db->trans_begin();
        if($editrow==""){$editrow=0;}
	    $table_name = "court_fee_return";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";
	    $row = $this->db->query("SELECT c.amount
	    	FROM cost_details as c
			WHERE c.id='".$_POST['court_fee_amount']."' LIMIT 1")->row();
	    $court_fee_return_application = $this->get_file_name('court_fee_return_application','cma_file/court_fee_return_application/');
	    $data = array(
			'bill_id' =>$this->security->xss_clean( $this->input->post('court_fee_amount')),
			'loan_ac' =>$this->security->xss_clean( $this->input->post('hidden_loan_ac')),
			'ac_name' =>$this->security->xss_clean( $this->input->post('hidden_ac_name')),
			'lawyer' =>$this->security->xss_clean( $this->input->post('lawyer')),
			'return_type' =>$this->security->xss_clean( $this->input->post('return_type')),
			'return_amount_by_field' =>$this->security->xss_clean( $this->input->post('new_amount')),
			'new_amount' =>$this->security->xss_clean( $this->input->post('new_amount')),
			'lawyer_district' =>$this->security->xss_clean( $this->input->post('lawyer_district')),
			'court_fee_return_application' =>$court_fee_return_application,
			'return_amount' =>$row->amount,
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),

		);
		if($add_edit=="add")
		{
            $bill_data=array();
			$bill_data['court_fee_return_sts'] = 39;
			$this->db->where('id', $this->security->xss_clean( $this->input->post('court_fee_amount')));
			$this->db->update('cost_details', $bill_data);

			$data['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$data['e_dt'] = date('Y-m-d H:i:s');
			$data['v_sts'] = 39;
			$this->db->insert('court_fee_return', $data);
			$insert_idss = $this->db->insert_id();

		    $activities_id = 39;
		    $description_activities = 'Add Court Fee Return - ';
		}
		else
		{
            //clearing the previous bill
            $bill_data=array();
            $bill_data['court_fee_return_sts'] = '0';
            $this->db->where('id', $this->security->xss_clean( $this->input->post('pre_bill_id')));
            $this->db->update('cost_details', $bill_data);

            $bill_data=array();
			$bill_data['court_fee_return_sts'] = 35;
			$this->db->where('id', $this->security->xss_clean( $this->input->post('court_fee_amount')));
			$this->db->update('cost_details', $bill_data);

	  		$data['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$data['u_dt'] = date('Y-m-d H:i:s');
			$data['v_sts'] = 35;
			$this->db->where('id', $edit_id);
			$this->db->update('court_fee_return', $data);
	  		$insert_idss = $edit_id;

	        $activities_id = 35;
	        $description_activities = 'Edit Court Fee Return - ';

		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities_bill($activities_id,'court_fee_return',$insert_idss,$table_name,$description_activities);
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
	function get_add_action_data_court_enter($id)
	{
		$this->db
			->select("b.*", FALSE)
			->from("court_entertainment_data b")
			->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
    function get_add_action_data_staff_conv($id)
    {
        $this->db
            ->select("b.*", FALSE)
            ->from("staff_conv_data b")
            ->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
	function get_add_action_data_paper($id)
	{
		$this->db
			->select("b.*,p.name as paper_name,d.name as district_name,DATE_FORMAT(b.pre_pub_dt,'%d-%b-%y %h:%i %p') AS pre_pub_dt_show", FALSE)
			->from("paper_bill_data b")
			->join('ref_legal_district d', 'd.id=b.district', 'left')
			->join('ref_paper p', 'p.id=b.pre_pub_paper_name', 'left')
			->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
    function get_add_action_data_court_adjust($id)
    {
        $this->db
            ->select("b.*,cd.amount as adjustment_amount,cd.loan_ac as adjusted_loan_ac,cd2.loan_ac,l.name as lawyer_name,d.name as district_name", FALSE)
            ->from("court_fee_adjustment b")
            ->join('cost_details cd', 'cd.id=b.adjustment_bill_id', 'left')
            ->join('cost_details cd2', 'cd2.id=b.new_account_bill_id', 'left')
            ->join('ref_lawyer l', 'l.id=cd.vendor_id', 'left')
            ->join('ref_legal_district d', 'd.id=l.district', 'left')
            ->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
	function get_add_action_data_court_return($id)
	{
		$this->db
			->select("b.*,d.name as district_name", FALSE)
			->from("court_fee_return b")
			->join('ref_legal_district d', 'd.id=b.lawyer_district', 'left')
			->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
    function get_lawyer_info_by_lawyer_id($id)
    {
        $this->db
            ->select("b.region,b.district", FALSE)
            ->from("ref_lawyer b")
            ->where("b.data_status='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
	function get_expenese_info_court($id)
    {
        if($id!=''){
                $this->db
                ->select("b.*", FALSE)
                ->from("expenses b")
                ->where("b.event_id='".$id."' AND b.module_name='court' AND b.sts<>0", NULL, FALSE);
            $data = $this->db->get()->result();
        return $data;
        }
        else{return NULL;}
    }
    function get_expenese_info_staff_conv($id)
    {
        if($id!=''){
                $this->db
                ->select("b.id,b.movement_details,b.move_of_transfortaion,b.particulars,
                    b.place,b.description_of_journey,b.journey_time,b.journey_metar,b.reached_time,b.reached_metar,
                    b.purpose,b.from,b.time_out,b.to,b.time_in,b.mode,b.breakdown_bill,b.to_date,
                    b.from_date,b.activities_date,b.amount,b.remarks", FALSE)
                ->from("expenses b")
                ->where("b.event_id='".$id."' AND b.module_name='staff' AND b.sts<>0", NULL, FALSE);
            $data = $this->db->get()->result();
        return $data;
        }
        else{return NULL;}
    }
    function get_expenese_details_staff_conv($id)
    {
        if($id!=''){
                $this->db
                ->select("DATE_FORMAT(b.activities_date,'%d-%b-%Y') AS activities_date,
                    DATE_FORMAT(b.from_date,'%d-%b-%Y') AS from_date,
                    DATE_FORMAT(b.to_date,'%d-%b-%Y') AS to_date,b.id,b.movement_details,b.move_of_transfortaion,b.particulars,
                    b.place,b.description_of_journey,b.journey_time,b.journey_metar,b.reached_time,b.reached_metar,
                    b.purpose,b.from,b.time_out,b.to,b.time_in,b.mode,b.breakdown_bill,b.amount,b.remarks", FALSE)
                ->from("expenses b")
                ->where("b.event_id='".$id."' AND b.module_name='staff' AND b.sts<>0", NULL, FALSE);
            $data = $this->db->get()->result();
        return $data;
        }
        else{return NULL;}
    }
    function get_expenese_info_paper($id)
    {
        if($id!=''){
                $this->db
                ->select("b.*", FALSE)
                ->from("expenses b")
                ->where("b.event_id='".$id."' AND b.module_name='paper' AND b.sts<>0", NULL, FALSE);
            $data = $this->db->get()->result();
        return $data;
        }
        else{return NULL;}
    }
	function delete_action(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "expenses";
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
			$pre_action_result=$this->Common_model->get_pre_action_data('expenses',$_POST['verifyid'],37,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('expenses', $data);
				$activities_id = 37;
				$description_activities = 'Send to Checker Staff Conveyance - ';
				$row_id=$_POST['verifyid'];
				
			}
		}
		if($this->input->post('type')=='verify_return'){
                $pre_action_result=$this->Common_model->get_pre_action_data('expenses',$_POST['verifyid'],'38,90,91','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('v_sts' => 90,'r_reason' => $_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('expenses', $data);
                    $activities_id = 90;
					$description_activities = 'Bill Return By Checker - ';
					$row_id=$_POST['verifyid'];
                }
                
            }
        if($this->input->post('type')=='verify_reject'){
                $pre_action_result=$this->Common_model->get_pre_action_data('expenses',$_POST['verifyid'],'38,90,91','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('v_sts' => 91,'reject_reason' => $_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('expenses', $data);
                    $activities_id = 91;
					$description_activities = 'Bill Rjected By Checker - ';
					$row_id=$_POST['verifyid'];
                }
                
            }
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('expenses',$_POST['verifyid'],'38,90,91','v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('expenses', $data);
				$activities_id = 38;
				$description_activities = 'Verify Staff Conveyance - ';
				$row_id=$_POST['verifyid'];
				//Genereate Expenses
                $str="SELECT  j0.*
                         FROM expenses j0
                     WHERE j0.sts != '0'  AND j0.id= '".$_POST['verifyid']."'";

                $expense_data=$this->db->query($str)->result();
                if (!empty($expense_data)) {
                        foreach ($expense_data as $key) {
                        	//For Court Entertainment Expnese Data   
                        	if($key->module_name=='paper')//for paper bill
                        	{
                        		$str="SELECT  j0.req_type,j0.cif,j0.loan_ac,j0.org_loan_ac,j0.ac_name,j0.loan_segment,j0.region,j0.territory,j0.district,j0.id,j0.proposed_type
	                             FROM cma j0
		                         WHERE j0.id= '".$key->event_id."' LIMIT 1";
				                $count=0;//Fixed for borower 3 address
				                $application_data=$this->db->query($str)->row();
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
			                	$cost_data = array(
			                		'module_name' => 'paper_bill',
		                            'main_table_name' => 'expenses',
		                            'main_table_id' => $key->id,
		                            'sub_table_name' => '',
		                            'sub_table_id' => '',
		                            'activities_id' => $key->activities_name,
		                            'vendor_type' => $key->expense_type,
		                            'vendor_id' => $key->vendor_id,
		                            'vendor_name' => $key->vendor_name,
		                            'amount' =>$key->amount,
		                            'txrn_dt' => $key->activities_date,
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
		                            'expense_remarks' =>$key->remarks
		                        );
		                        $data3=$this->user_model->cost_details($cost_data);
                        	}
                        	else
                        	{
                        		$cost_data = array(
		                            'main_table_name' => 'expenses',
		                            'main_table_id' => $key->id,
		                            'sub_table_name' => '',
		                            'sub_table_id' => '',
		                            'activities_id' => $key->activities_name,
		                            'vendor_type' => $key->expense_type,
		                            'vendor_id' => $key->vendor_id,
		                            'vendor_name' => $key->vendor_name,
		                            'amount' =>$key->amount,
		                            'txrn_dt' => $key->activities_date,
		                            'expense_remarks' =>$key->remarks
		                        );
		                        $data3=$this->user_model->cost_details($cost_data);
                        	}
                            
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
			$this->User_model->user_activities_bill($activities_id,'expenses',$row_id,$table_name,$description_activities,$reason);
			$this->db->trans_commit();

			$this->db->db_debug = $db_debug;
			return $row_id;
		}
	}
	function delete_action_lawyer_bill(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "legal_bill_selection";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';
		
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_bill_selection',$_POST['verifyid'],37,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{

				$bill_data['legal_select_sts'] = 37;
				$this->db->where('legal_select_id', $_POST['verifyid']);
				$this->db->update('cost_details', $bill_data);
				$data = array('stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'sts'=>37);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('legal_bill_selection', $data);
				$activities_id = 37;
				$description_activities = 'Send to Checker Lawyer Bill Selection - ';
				$row_id=$_POST['verifyid'];
				
			}
		}
		if($this->input->post('type')=='verify_return'){
                $pre_action_result=$this->Common_model->get_pre_action_data('legal_bill_selection',$_POST['verifyid'],'38,90,91','sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                
                	$bill_data['legal_select_sts'] = 90;
					$this->db->where('legal_select_id', $_POST['verifyid']);
					$this->db->update('cost_details', $bill_data);

                    $data = array('sts' => 90,'return_reason' => $_POST['return_reason_verify'],'return_by'=> $this->session->userdata['ast_user']['user_id'], 'return_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('legal_bill_selection', $data);
                    $activities_id = 90;
					$description_activities = 'Lawyer Selection Entry Return By Checker - ';
					$row_id=$_POST['verifyid'];
                }
                
            }
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_bill_selection',$_POST['verifyid'],93,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$bill_data['legal_select_sts'] = 93;
				$this->db->where('legal_select_id', $_POST['verifyid']);
				$this->db->update('cost_details', $bill_data);

				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'sts'=>93);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('legal_bill_selection', $data);
				$activities_id = 93;
				$description_activities = 'Verify Lawyer Bill Selection - ';
				$row_id=$_POST['verifyid'];
				
			}
		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		}
		else {
			$this->User_model->user_activities_bill($activities_id,'legal_bill_selection',$row_id,$table_name,$description_activities,$reason);
			$this->db->trans_commit();

			$this->db->db_debug = $db_debug;
			return $row_id;
		}
	}
	function delete_action_court_fee(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "legal_bill_selection";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';
		
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_bill_selection',$_POST['verifyid'],37,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{

				$bill_data['legal_select_sts'] = 37;
				$this->db->where('legal_select_id', $_POST['verifyid']);
				$this->db->update('cost_details', $bill_data);
				$data = array('stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'sts'=>37);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('legal_bill_selection', $data);
				$activities_id = 37;
				$description_activities = 'Send to Checker Court Fee Selection - ';
				$row_id=$_POST['verifyid'];
				
			}
		}
		if($this->input->post('type')=='verify_return'){
                $pre_action_result=$this->Common_model->get_pre_action_data('legal_bill_selection',$_POST['verifyid'],'38,90,91','sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                
                	$bill_data['legal_select_sts'] = 90;
					$this->db->where('legal_select_id', $_POST['verifyid']);
					$this->db->update('cost_details', $bill_data);

                    $data = array('sts' => 90,'return_reason' => $_POST['return_reason_verify'],'return_by'=> $this->session->userdata['ast_user']['user_id'], 'return_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('legal_bill_selection', $data);
                    $activities_id = 90;
					$description_activities = 'Court Fee Selection Entry Return By Checker - ';
					$row_id=$_POST['verifyid'];
                }
                
            }
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_bill_selection',$_POST['verifyid'],93,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$bill_data['legal_select_sts'] = 93;
				$this->db->where('legal_select_id', $_POST['verifyid']);
				$this->db->update('cost_details', $bill_data);

				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'sts'=>93);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('legal_bill_selection', $data);
				$activities_id = 93;
				$description_activities = 'Verify Court Fee Selection - ';
				$row_id=$_POST['verifyid'];
				
			}
		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		}
		else {
			$this->User_model->user_activities_bill($activities_id,'legal_bill_selection',$row_id,$table_name,$description_activities,$reason);
			$this->db->trans_commit();

			$this->db->db_debug = $db_debug;
			return $row_id;
		}
	}
    function delete_action_court_adjust(){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $table_name = "court_fee_adjustment";
        $activities_id='';
        $row_id='';
        $description_activities='';
        $reason ='';
        
        if($this->input->post('type')=='delete'){
            $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_adjustment',$_POST['deleteEventId'],0,'sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $row = $this->db->query("SELECT c.adjustment_bill_id,c.new_account_bill_id
                 FROM court_fee_adjustment as c 
                    WHERE c.id='".$_POST['deleteEventId']."' LIMIT 1")->row();
                $adjust_ac = $row->adjustment_bill_id;
                $new_ac = $row->new_account_bill_id;
                $data = array();
                $data['adjust_v_sts'] = "";
                $data['adjustment_sts'] = "";
                $data['adjustment_from'] = "";
                $data['adjustment_with'] = "";
                $data['remaining_belance'] = "";
                $data['fully_adjust_sts'] = "";
                $this->db->where('id', $adjust_ac);
                $this->db->update('cost_details', $data);

                $this->db->where('id', $new_ac);
                $this->db->update('cost_details', $data);


                $data = array('d_reason'=>trim($_POST['comments']), 'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('court_fee_adjustment', $data);
                $description_activities = 'Delete Court Fee Adjustment - ';
                $row_id=$_POST['deleteEventId'];
                $reason =trim($_POST['comments']);
            }
            
        }
        if($this->input->post('type')=='sendtochecker'){
            $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_adjustment',$_POST['verifyid'],37,'v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $row = $this->db->query("SELECT c.adjustment_bill_id,c.new_account_bill_id
                FROM court_fee_adjustment as c 
                WHERE c.id='".$_POST['verifyid']."' LIMIT 1")->row();
                $adjust_ac = $row->adjustment_bill_id;
                $new_ac = $row->new_account_bill_id;
                $data = array();
                $data['adjust_v_sts'] = 37;
                $this->db->where('id', $adjust_ac);
                $this->db->update('cost_details', $data);

                $this->db->where('id', $new_ac);
                $this->db->update('cost_details', $data);

                $data = array('stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('court_fee_adjustment', $data);
                $activities_id = 37;
                $description_activities = 'Send to Checker Court Fee Adjustment - ';
                $row_id=$_POST['verifyid'];
                
            }
        }
        if($this->input->post('type')=='verify_return'){
                $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_adjustment',$_POST['verifyid'],'38,90,91','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $row = $this->db->query("SELECT c.adjustment_bill_id,c.new_account_bill_id
                    FROM court_fee_adjustment as c 
                    WHERE c.id='".$_POST['verifyid']."' LIMIT 1")->row();
                    $adjust_ac = $row->adjustment_bill_id;
                    $new_ac = $row->new_account_bill_id;
                    $data = array();
                    $data['adjust_v_sts'] = 90;
                    $this->db->where('id', $adjust_ac);
                    $this->db->update('cost_details', $data);

                    $this->db->where('id', $new_ac);
                    $this->db->update('cost_details', $data);

                    $data = array('v_sts' => 90,'r_reason' => $_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('court_fee_adjustment', $data);
                    $activities_id = 90;
                    $description_activities = 'Court Fee Adjustment Entry Return By Checker - ';
                    $row_id=$_POST['verifyid'];
                }
                
            }
            if($this->input->post('type')=='verify'){
                $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_adjustment',$_POST['verifyid'],93,'v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $row = $this->db->query("SELECT c.adjustment_bill_id,c.new_account_bill_id
                    FROM court_fee_adjustment as c 
                    WHERE c.id='".$_POST['verifyid']."' LIMIT 1")->row();
                    $adjust_ac = $row->adjustment_bill_id;
                    $new_ac = $row->new_account_bill_id;
                    $data = array();
                    $data['adjust_v_sts'] = 93;
                    $this->db->where('id', $adjust_ac);
                    $this->db->update('cost_details', $data);

                    $this->db->where('id', $new_ac);
                    $this->db->update('cost_details', $data);

                    $data = array('life_cycle'=>2,'sthm_by'=> $this->session->userdata['ast_user']['user_id'], 'sthm_dt'=>date('Y-m-d H:i:s'),'v_sts'=>93);
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('court_fee_adjustment', $data);
                    $activities_id = 93;
                    $description_activities = 'Verify Court Court Fee Adjustment - ';
                    $row_id=$_POST['verifyid'];

                    $application_data = $this->db->query("SELECT c.loan_ac,l.name as vendor_name
                        from court_fee_adjustment a
                        LEFT OUTER JOIN cost_details c on(c.id=a.adjustment_bill_id)
                        LEFT OUTER JOIN ref_lawyer l on(l.id=c.vendor_id)
                        where a.id='".$_POST['verifyid']."'")->row();
                    $subject = "Need Court Fee adjustment from the A/C-".$application_data->loan_ac." in favor of ".$application_data->vendor_name;
                    $url = base_url()."expenses/court_adjust_details";
                    $data2 = $this->Common_model->push_notification_data($subject,$url,'court_fee_adjustment',$_POST['verifyid'],date('Y-m-d'),'','all','1','10');
                    
                }
            }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->db->db_debug = $db_debug;
            return 0;
        }
        else {
            $this->User_model->user_activities_bill($activities_id,'court_fee_return',$row_id,$table_name,$description_activities,$reason);
            $this->db->trans_commit();

            $this->db->db_debug = $db_debug;
            return $row_id;
        }
    }
	function delete_action_court_return(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "court_fee_return";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';
		
		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('court_fee_return',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$row = $this->db->query("SELECT c.bill_id
		    	FROM court_fee_return as c
				WHERE c.id='".$_POST['deleteEventId']."' LIMIT 1")->row();
				$bill_data['court_fee_return_sts'] = 0;
				$this->db->where('id', $row->bill_id);
				$this->db->update('cost_details', $bill_data);


				$data = array('d_reason'=>trim($_POST['comments']),	'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('court_fee_return', $data);
				$description_activities = 'Delete Court Fee Return - ';
				$row_id=$_POST['deleteEventId'];
				$reason =trim($_POST['comments']);
			}
			
		}
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('court_fee_return',$_POST['verifyid'],37,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$row = $this->db->query("SELECT c.bill_id
		    	FROM court_fee_return as c
				WHERE c.id='".$_POST['verifyid']."' LIMIT 1")->row();
				$bill_data['court_fee_return_sts'] = 37;
				$this->db->where('id', $row->bill_id);
				$this->db->update('cost_details', $bill_data);

				$data = array('stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('court_fee_return', $data);
				$activities_id = 37;
				$description_activities = 'Send to Checker Court Fee Return - ';
				$row_id=$_POST['verifyid'];
				
			}
		}
		if($this->input->post('type')=='verify_return'){
                $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_return',$_POST['verifyid'],'38,90,91','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                	$row = $this->db->query("SELECT c.bill_id
			    	FROM court_fee_return as c
					WHERE c.id='".$_POST['verifyid']."' LIMIT 1")->row();
                	$bill_data['court_fee_return_sts'] = 90;
					$this->db->where('id', $row->bill_id);
					$this->db->update('cost_details', $bill_data);

                    $data = array('v_sts' => 90,'r_reason' => $_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('court_fee_return', $data);
                    $activities_id = 90;
					$description_activities = 'Court Fee Return Entry Return By Checker - ';
					$row_id=$_POST['verifyid'];
                }
                
            }
        if($this->input->post('type')=='verify_reject'){
                $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_return',$_POST['verifyid'],'38,90,91','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                	$row = $this->db->query("SELECT c.bill_id
			    	FROM court_fee_return as c
					WHERE c.id='".$_POST['verifyid']."' LIMIT 1")->row();
                	$bill_data['court_fee_return_sts'] = 0;
					$this->db->where('id', $row->bill_id);
					$this->db->update('cost_details', $bill_data);

                    $data = array('v_sts' => 91,'reject_reason' => $_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('court_fee_return', $data);
                    $activities_id = 91;
					$description_activities = 'Court Fee Return Entry Rjected By Checker - ';
					$row_id=$_POST['verifyid'];
                }
                
            }
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('court_fee_return',$_POST['verifyid'],93,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$row = $this->db->query("SELECT c.bill_id
		    	FROM court_fee_return as c
				WHERE c.id='".$_POST['verifyid']."' LIMIT 1")->row();
				$bill_data['court_fee_return_sts'] = 93;
				$this->db->where('id', $row->bill_id);
				$this->db->update('cost_details', $bill_data);

				$data = array('lif_cycle'=>2,'sthm_by'=> $this->session->userdata['ast_user']['user_id'], 'sthm_dt'=>date('Y-m-d H:i:s'),'v_sts'=>93);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('court_fee_return', $data);
				$activities_id = 93;
				$description_activities = 'Verify Court Court Fee Return - ';
				$row_id=$_POST['verifyid'];


                $application_data = $this->db->query("SELECT c.loan_ac,l.name as vendor_name
                    from court_fee_return c
                    LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
                    where a.id='".$_POST['verifyid']."'")->row();
                $subject = "Need Court Fee return from the A/C-".$application_data->loan_ac." in favor of ".$application_data->vendor_name;
                $url = base_url()."expenses/court_return_details";
                $data2 = $this->Common_model->push_notification_data($subject,$url,'court_fee_return',$_POST['verifyid'],date('Y-m-d'),'','all','1','10');
				
			}
		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		}
		else {
			$this->User_model->user_activities_bill($activities_id,'court_fee_return',$row_id,$table_name,$description_activities,$reason);
			$this->db->trans_commit();

			$this->db->db_debug = $db_debug;
			return $row_id;
		}
	}
	function delete_action_court_enter(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "court_entertainment_data";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';
		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('court_entertainment_data',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('d_reason'=>trim($_POST['comments']),	'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('court_entertainment_data', $data);
				//Delete Expenses
                $expense_data = array('sts' => 0);
                 $this->db->where('event_id',$_POST['deleteEventId']);
                 $this->db->where('module_name',"court");
                 $this->db->update('expenses', $expense_data);
				$activities_id = 15;
				$description_activities = 'Delete Court Entertainment - ';
				$row_id=$_POST['deleteEventId'];
				$reason =trim($_POST['comments']);
			}
			
		}
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('court_entertainment_data',$_POST['verifyid'],37,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('court_entertainment_data', $data);
				$activities_id = 37;
				$description_activities = 'Send to Checker Court Entertainment - ';
				$row_id=$_POST['verifyid'];
				
			}
		}
		if($this->input->post('type')=='verify_return'){
                $pre_action_result=$this->Common_model->get_pre_action_data('court_entertainment_data',$_POST['verifyid'],'38,90,91','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('v_sts' => 90,'r_reason' => $_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('court_entertainment_data', $data);
                    $activities_id = 90;
					$description_activities = 'Bill Return By Checker - ';
					$row_id=$_POST['verifyid'];
                }
                
            }
        if($this->input->post('type')=='verify_reject'){
                $pre_action_result=$this->Common_model->get_pre_action_data('court_entertainment_data',$_POST['verifyid'],'38,90,91','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('v_sts' => 91,'reject_reason' => $_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('court_entertainment_data', $data);
                    $activities_id = 91;
					$description_activities = 'Bill Rjected By Checker - ';
					$row_id=$_POST['verifyid'];
                }
                
            }
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('court_entertainment_data',$_POST['verifyid'],38,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('court_entertainment_data', $data);
				$activities_id = 38;
				$description_activities = 'Verify Court Entertainment - ';
				$row_id=$_POST['verifyid'];
				//Genereate Expenses
                $str="SELECT  j0.*
                         FROM expenses j0
                     WHERE j0.sts != '0' AND j0.module_name='court'  AND j0.event_id= '".$_POST['verifyid']."'";

                $expense_data=$this->db->query($str)->result();
                if (!empty($expense_data)) {
                        foreach ($expense_data as $key) {
                        	//echo $key->suit_id;
                        	$str2="SELECT  j0.prest_court_name as court_id,j0.loan_segment,j0.cif
			                         FROM suit_filling_info j0
			                     WHERE j0.sts != '0' AND j0.id='".$key->suit_id."'";

			                $suit_data=$this->db->query($str2)->row();
			                if(!empty($suit_data))
			                {
                                $cif = $suit_data->cif;
			                	$court_id = $suit_data->court_id;
                                $loan_segment = $suit_data->loan_segment;
			                }else{$court_id = 0;$cif = '';$loan_segment = '';}
                        $cost_data = array(
                        	'module_name' => 'suit_file',
                            'main_table_name' => 'court_entertainment_data',
                            'main_table_id' => $key->event_id,
                            'sub_table_name' => 'expenses',
                            'sub_table_id' => $key->id,
                            'activities_id' => $key->activities_name,
                            'vendor_type' => $key->expense_type,
                            'vendor_name' => $key->vendor_name,
                            'vendor_pin' => $key->vendor_pin,
                            'amount' =>$key->amount,
                            'txrn_dt' => $key->activities_date,
                            'loan_ac' =>$key->account_number,
                            'cif' =>$cif,
                            'req_type' =>$key->req_type,
                            'case_number' =>$key->case_number,
                            'region' =>$key->region,
                            'district' =>$key->district,
                            'vendor_ac_no' =>$key->vendor_ac_no,
                            'proposed_type' =>$key->proposed_type,
                            'org_loan_ac' =>$key->org_loan_ac,
                            'ac_name' =>$key->ac_name,
                            'vendor_id' =>$key->vendor_id,
                            'suit_id' =>$key->suit_id,
                            'court_id' =>$court_id,
                            'loan_segment' =>$loan_segment,
                            'expense_remarks' =>$key->remarks

                        );
                        $data3=$this->user_model->cost_details($cost_data);
                            
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
			$this->User_model->user_activities_bill($activities_id,'court_entertainment_data',$row_id,$table_name,$description_activities,$reason);
			$this->db->trans_commit();

			$this->db->db_debug = $db_debug;
			return $row_id;
		}
	}
    function delete_action_staff_conv(){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $table_name = "staff_conv_data";
        $activities_id='';
        $row_id='';
        $description_activities='';
        $reason ='';
        if($this->input->post('type')=='delete'){
            $pre_action_result=$this->Common_model->get_pre_action_data('staff_conv_data',$_POST['deleteEventId'],0,'sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('d_reason'=>trim($_POST['comments']), 'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('staff_conv_data', $data);
                //Delete Expenses
                $expense_data = array('sts' => 0);
                 $this->db->where('event_id',$_POST['deleteEventId']);
                 $this->db->where('module_name',"staff");
                 $this->db->update('expenses', $expense_data);
                $activities_id = 15;
                $description_activities = 'Delete Staff Conveyence - ';
                $row_id=$_POST['deleteEventId'];
                $reason =trim($_POST['comments']);
            }
            
        }
        if($this->input->post('type')=='sendtochecker'){
            $pre_action_result=$this->Common_model->get_pre_action_data('staff_conv_data',$_POST['verifyid'],37,'v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('staff_conv_data', $data);
                $activities_id = 37;
                $description_activities = 'Send to Checker Staff Conveyence - ';
                $row_id=$_POST['verifyid'];
                
            }
        }
        if($this->input->post('type')=='verify_return'){
                $pre_action_result=$this->Common_model->get_pre_action_data('staff_conv_data',$_POST['verifyid'],'38,90,91','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('v_sts' => 90,'r_reason' => $_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('staff_conv_data', $data);
                    $activities_id = 90;
                    $description_activities = 'Bill Return By Checker - ';
                    $row_id=$_POST['verifyid'];
                }
                
            }
        if($this->input->post('type')=='verify_reject'){
                $pre_action_result=$this->Common_model->get_pre_action_data('staff_conv_data',$_POST['verifyid'],'38,90,91','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('v_sts' => 91,'reject_reason' => $_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('staff_conv_data', $data);
                    $activities_id = 91;
                    $description_activities = 'Bill Rjected By Checker - ';
                    $row_id=$_POST['verifyid'];
                }
                
            }
        if($this->input->post('type')=='verify'){
            $pre_action_result=$this->Common_model->get_pre_action_data('staff_conv_data',$_POST['verifyid'],38,'v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('staff_conv_data', $data);
                $activities_id = 38;
                $description_activities = 'Verify Staff conveyence - ';
                $row_id=$_POST['verifyid'];
                //Genereate Expenses
                $str="SELECT  j0.*,u.name as staff_name,u.pin as staff_pin,'' as region_id,'' as district_id
                         FROM expenses j0
                         LEFT OUTER JOIN staff_conv_data s on(j0.event_id=s.id)
                         LEFT OUTER JOIN users_info u on(u.id=s.staff_id)
                     WHERE j0.sts != '0' AND j0.module_name='staff'  AND j0.event_id= '".$_POST['verifyid']."'";
                $expense_data=$this->db->query($str)->result();
                if (!empty($expense_data)) {
                        foreach ($expense_data as $key) {
                        $cost_data = array(
                            'module_name' => 'staff_conv',
                            'main_table_name' => 'staff_conv_data',
                            'main_table_id' => $key->event_id,
                            'sub_table_name' => 'expenses',
                            'vendor_name' => $key->staff_name,
                            'vendor_pin' => $key->staff_pin,
                            'amount' =>$key->amount,
                            'txrn_dt' => $key->activities_date,
                            'region' =>$key->region_id,
                            'district' =>$key->district_id,
                            'vendor_id' =>$key->vendor_id,
                            'vendor_type' => $key->expense_type,
                            'movement_details' =>$key->movement_details,
                            'move_of_transfortaion' =>$key->move_of_transfortaion,
                            'particulars' =>$key->particulars,
                            'place' =>$key->place,
                            'description_of_journey' =>$key->description_of_journey,
                            'journey_time' =>$key->journey_time,
                            'journey_metar' =>$key->journey_metar,
                            'reached_time' =>$key->reached_time,
                            'reached_metar' =>$key->reached_metar,
                            'purpose' =>$key->purpose,
                            'from' =>$key->from,
                            'time_out' =>$key->time_out,
                            'to' =>$key->to,
                            'time_in' =>$key->time_in,
                            'mode' =>$key->mode,
                            'breakdown_bill' =>$key->breakdown_bill,
                            'to_date' =>$key->to_date,
                            'from_date' =>$key->from_date,
                            'expense_remarks' =>$key->remarks

                        );
                        $data3=$this->user_model->cost_details($cost_data);
                            
                    }
                }

                $application_data = $this->db->query("SELECT CONCAT(u.name,'(',u.pin,')') as e_by_name
                    from staff_conv_data c
                    LEFT OUTER JOIN users_info u on(u.id=c.e_by)
                    where c.id='".$_POST['verifyid']."'")->row();
                $subject = "Convinced bill submit from Mr. ".$application_data->e_by_name;
                $url = base_url()."expenses/get_staff_conv_details";
                $data2 = $this->Common_model->push_notification_data($subject,$url,'staff_conv_data',$_POST['verifyid'],date('Y-m-d'),'','all','1','10');
                
            }
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->db->db_debug = $db_debug;
            return 0;
        }
        else {
            $this->User_model->user_activities_bill($activities_id,'staff_conv_data',$row_id,$table_name,$description_activities,$reason);
            $this->db->trans_commit();

            $this->db->db_debug = $db_debug;
            return $row_id;
        }
    }
	function delete_action_paper(){
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
		$table_name = "paper_bill_data";
		$activities_id='';
		$row_id='';
		$description_activities='';
		$reason ='';
		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('paper_bill_data',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('d_reason'=>trim($_POST['comments']),	'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'),'v_sts'=>15);
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('paper_bill_data', $data);
				//Delete Expenses
                $expense_data = array('sts' => 0);
                 $this->db->where('event_id',$_POST['deleteEventId']);
                 $this->db->where('module_name',"paper");
                 $this->db->update('expenses', $expense_data);
				$activities_id = 15;
				$description_activities = 'Delete Paper Bill - ';
				$row_id=$_POST['deleteEventId'];
				$reason =trim($_POST['comments']);
			}
			
		}
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('paper_bill_data',$_POST['verifyid'],37,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'v_sts'=>37);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('paper_bill_data', $data);
				$activities_id = 37;
				$description_activities = 'Send to Checker Paper Bill - ';
				$row_id=$_POST['verifyid'];
				
			}
		}
		if($this->input->post('type')=='verify_return'){
                $pre_action_result=$this->Common_model->get_pre_action_data('paper_bill_data',$_POST['verifyid'],'38,90,91','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('v_sts' => 90,'r_reason' => $_POST['return_reason_verify'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('paper_bill_data', $data);
                    $activities_id = 90;
					$description_activities = 'Bill Return By Checker - ';
					$row_id=$_POST['verifyid'];
                }
                
            }
        if($this->input->post('type')=='verify_reject'){
                $pre_action_result=$this->Common_model->get_pre_action_data('paper_bill_data',$_POST['verifyid'],'38,90,91','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('v_sts' => 91,'reject_reason' => $_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('paper_bill_data', $data);
                    $activities_id = 91;
					$description_activities = 'Bill Rjected By Checker - ';
					$row_id=$_POST['verifyid'];
                }
                
            }
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('paper_bill_data',$_POST['verifyid'],38,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
				$this->db->where('id', $_POST['verifyid']);
				$this->db->update('paper_bill_data', $data);
				$activities_id = 38;
				$description_activities = 'Verify Paper Bill - ';
				$row_id=$_POST['verifyid'];
				//Genereate Expenses
                $str="SELECT  j0.*
                         FROM expenses j0
                     WHERE j0.sts != '0' AND j0.module_name='paper'  AND j0.event_id= '".$_POST['verifyid']."'";

                $expense_data=$this->db->query($str)->result();

                $str="SELECT  j0.*
                         FROM paper_bill_data j0
                     WHERE j0.sts != '0' AND j0.id= '".$_POST['verifyid']."' LIMIT 1";

                $bill_data=$this->db->query($str)->row();
                if($bill_data->account_type==2)
                {
                    $str="SELECT  j0.*
                         FROM suit_filling_info j0
                     WHERE j0.id= '".$bill_data->suit_id."' LIMIT 1";

                    $suit_data=$this->db->query($str)->row();
                    $loan_segment = $suit_data->loan_segment;
                    $region = $suit_data->legal_region;
                    $territory = $suit_data->territory;
                    $district = $suit_data->district;
                    $loan_ac = $suit_data->loan_ac;
                    $cif = $suit_data->cif;
                    $org_loan_ac = $suit_data->org_loan_ac;
                }
                else
                {
                    $str="SELECT  j0.*
                         FROM cma j0
                     WHERE j0.id= '".$bill_data->cma_id."' LIMIT 1";

                    $cma_id=$this->db->query($str)->row();
                    $loan_segment = $cma_id->loan_segment;
                    $region = $cma_id->legal_region;
                    $territory = $cma_id->territory;
                    $district = $cma_id->case_fill_dist;
                    $loan_ac = $cma_id->loan_ac;
                    $cif = $cma_id->cif;
                    $org_loan_ac = $cma_id->org_loan_ac;
                }
                if (!empty($expense_data)) {
                        foreach ($expense_data as $key) {
                        $cost_data = array(
                        	'module_name' => 'suit_file',
                            'main_table_name' => 'paper_bill_data',
                            'main_table_id' => $_POST['verifyid'],
                            'sub_table_name' => 'expenses',
                            'sub_table_id' => $key->id,
                            'vendor_type' => 2,
                            'vendor_id' => $key->vendor_id,
                            'paper_bill_vendor_type' => $key->vendor_type,
                            'paper_id' => $key->paper_name,
                            'cma_id' => $bill_data->cma_id,
                            'suit_id' => $bill_data->suit_id,
                            'tin' => $key->tin,
                            'bin' => $key->bin,
                            'mousak' => $key->mousak,
                            'paper_scan_copy' => $key->paper_scan_copy,
                            'paper_expense_approval_file' => $key->paper_expense_approval_file,
                            'amount' =>$key->amount,
                            'txrn_dt' => $key->activities_date,
                            'loan_ac' =>$loan_ac,
                            'cif' =>$cif,
                            'loan_segment' =>$loan_segment,
                            'req_type' =>$bill_data->req_type,
                            'case_number' =>$bill_data->case_number,
                            'region' =>$region,
                            'territory' =>$territory,
                            'district' =>$district,
                            'vendor_ac_no' =>$key->account_no,
                            'proposed_type' =>$bill_data->proposed_type,
                            'ac_name' =>$bill_data->ac_name

                        );
                        if($bill_data->proposed_type=='Card')
                        {
                            $cost_data['org_loan_ac']=$org_loan_ac;
                        }
                        $data3=$this->user_model->cost_details($cost_data);
                            
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
			$this->User_model->user_activities_bill($activities_id,'paper_bill_data',$row_id,$table_name,$description_activities,$reason);
			$this->db->trans_commit();

			$this->db->db_debug = $db_debug;
			return $row_id;
		}
	}
	function get_row_details_paper($id) {
		$this->db
			->select("e.*,p.name as pre_paper_name,j6.name as status,r.name as req_type_name,d.name as district_name,us.name as under_section_name,
    		u.user_group_id,DATE_FORMAT(e.pre_pub_dt,'%d-%b-%') AS pre_pub_dt,DATE_FORMAT(e.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,CONCAT(u.name,' (',u.pin,')') as e_by,", FALSE)
			->from("paper_bill_data e")
			->join('ref_legal_district d', 'd.id=e.district', 'left')
			->join('ref_req_type r', 'r.id=e.req_type', 'left')
			->join('ref_under_section us', 'us.id=e.under_section', 'left')
			->join('users_info u', 'e.e_by=u.id', 'left')
			->join('ref_status as j6', 'e.v_sts=j6.id', 'left')
			->join('ref_paper as p', 'p.id=e.pre_pub_paper_name', 'left')
			->where("e.sts<>'0' and e.id='$id'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function get_row_details_court_return($id) {
		$this->db
			->select("e.*,cm.st_belance,rt.name as return_type_name,IF(e.return_type=1,e.return_amount,e.new_amount) as return_amount,j6.name as status,l.name as lawyer_name,d.name as district_name,DATE_FORMAT(e.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,CONCAT(u.name,' (',u.pin,')') as e_by,", FALSE)
			->from("court_fee_return e")
			->join('cost_details c', 'c.id=e.bill_id', 'left')
			->join('cma cm', 'cm.id=c.main_table_id', 'left')
			->join('ref_legal_district d', 'd.id=e.lawyer_district', 'left')
			->join('ref_lawyer l', 'l.id=e.lawyer', 'left')
			->join('ref_return_type rt', 'e.return_type=rt.id', 'left')
			->join('users_info u', 'e.e_by=u.id', 'left')
			->join('ref_status as j6', 'e.v_sts=j6.id', 'left')
			->where("e.sts<>'0' and e.id='$id'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
    function get_row_details_court_adjust($id) {
        $this->db
            ->select("e.*,j6.name as status,cd.loan_ac as adjusted_ac,cd2.loan_ac as new_loan_ac
                ,l.name as lawyer_name,d.name as district_name,
                DATE_FORMAT(e.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,
                CONCAT(u.name,' (',u.pin,')') as e_by,", FALSE)
            ->from("court_fee_adjustment e")
            ->join('cost_details cd', 'cd.id=e.adjustment_bill_id', 'left')
            ->join('cost_details cd2', 'cd2.id=e.new_account_bill_id', 'left')
            ->join('ref_lawyer l', 'l.id=e.lawyer_id', 'left')
            ->join('ref_legal_district d', 'd.id=l.district', 'left')
            ->join('users_info u', 'e.e_by=u.id', 'left')
            ->join('ref_status as j6', 'e.v_sts=j6.id', 'left')
            ->where("e.sts<>'0' and e.id='$id'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
	function get_row_details_court_enter($id) {
		$this->db
			->select("e.*,fd.name as func_desig,j6.name as status,t.name as employee_type,d.name as district,
    		r.name as legal_region,uv.name as v_by_name,uv.pin as v_by_pin,u.name as e_by_name,u.pin as e_by_pin,efd.name as e_by_desig,vfd.name as v_by_desig,DATE_FORMAT(e.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,CONCAT(u.name,' (',u.pin,')') as e_by,m.name as billing_month", FALSE)
			->from("court_entertainment_data e")
			->join('ref_employee_type t', 't.id=e.employee_type', 'left')
			->join('ref_legal_district d', 'd.id=e.district', 'left')
			->join('ref_legal_region r', 'r.id=e.legal_region', 'left')
			->join('ref_billing_month m', 'm.id=e.billing_month', 'left')
			->join('users_info u', 'e.e_by=u.id', 'left')
            ->join('users_info uv', 'e.v_by=uv.id', 'left')
			->join('ref_status as j6', 'e.v_sts=j6.id', 'left')
			->join('ref_functional_designation as fd', 'e.functional_desig=fd.id', 'left')
            ->join('ref_functional_designation as efd', 'u.functional_designation_id=efd.id', 'left')
            ->join('ref_functional_designation as vfd', 'uv.functional_designation_id=vfd.id', 'left')
			->where("e.sts<>'0' and e.id='$id'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
    function get_total_expenses_staff_conv($bill_id)
    {
        if($bill_id!=''){
            $str="SELECT SUM(j0.amount) as amount,en.conv_type
            FROM cost_details as j0
            LEFT OUTER JOIN staff_conv_data en ON(en.id=j0.main_table_id)
            WHERE  j0.module_name='staff_conv' AND j0.main_table_name='staff_conv_data' AND j0.main_table_id= ".$bill_id." GROUP BY en.conv_type ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_row_details_staff_conv_for_memo($bill_id)
    {
        if($bill_id!=''){
            $str="SELECT sub.*,ubs.name as e_by_name,ubs.pin as e_by_pin,fdbs.name as e_by_desig,
            ubsv.name as v_by_name,ubsv.pin as v_by_pin,fdbsv.name as v_by_desig
            FROM
            (SELECT u.bank_ac,u.mobile_number,
                        GROUP_CONCAT(DISTINCT(m.name) ORDER BY m.id ASC SEPARATOR ',') as billing_month,
                        u.name as staff_name,fd.name as functional_desig,
                        u.pin as staff_pin
                        FROM cost_details as j0
                        LEFT OUTER JOIN staff_conv_data en ON(en.id=j0.main_table_id)
                        LEFT OUTER JOIN users_info u ON(en.staff_id=u.id)
                        LEFT OUTER JOIN ref_functional_designation fd ON(u.functional_designation_id=fd.id)
                        LEFT OUTER JOIN ref_billing_month m ON(m.id=en.month)
                        WHERE j0.module_name='staff_conv' AND j0.main_table_name='staff_conv_data' AND j0.main_table_id= ".$bill_id." GROUP BY en.staff_id,en.month ORDER BY j0.id ASC)sub
                        LEFT OUTER JOIN staff_conv_data bs ON(".$bill_id."=bs.id)
                        LEFT OUTER JOIN users_info ubs ON(bs.e_by=ubs.id)
                        LEFT OUTER JOIN ref_functional_designation fdbs ON(ubs.functional_designation_id=fdbs.id)
                        LEFT OUTER JOIN users_info ubsv ON(bs.v_by=ubsv.id)
                        LEFT OUTER JOIN ref_functional_designation fdbsv ON(ubsv.functional_designation_id=fdbsv.id)";
            $query=$this->db->query($str);
            return $query->row();
        }
        else{return NULL;}
    }
    function get_row_details_staff_conv($id) {
        $this->db
            ->select("e.*,fd.name as func_desig,u.name as employee_name,u.pin as staff_pin,j6.name as status,'' as district,
            '' as legal_region,DATE_FORMAT(e.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,CONCAT(u.name,' (',u.pin,')') as e_by,m.name as billing_month", FALSE)
            ->from("staff_conv_data e")
            ->join('users_info u', 'e.e_by=u.id', 'left')
            ->join('ref_billing_month m', 'm.id=e.month', 'left')
            ->join('ref_status as j6', 'e.v_sts=j6.id', 'left')
            ->join('ref_functional_designation as fd', 'u.functional_designation_id=fd.id', 'left')
            ->where("e.sts<>'0' and e.id='$id'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_expenese_court_entertainment_details($id)
    {
        if($id!=''){
                $str="SELECT  b.*,b.amount,r.name as req_type,ac.name as activities_name,DATE_FORMAT(b.activities_date,'%d-%b-%Y') AS activities_date
                     FROM expenses b
                     LEFT OUTER JOIN ref_req_type r on(r.id=b.req_type)
                     LEFT OUTER JOIN ref_court_entertainment_activities ac on(ac.id=b.activities_name)
                     WHERE b.event_id='".$id."' AND b.module_name='court' AND b.sts<>0";
            $data = $this->db->query($str)->result();
        return $data;
        }
        else{return NULL;}
    }
	function get_expenese_details_court($id)
    {
        if($id!=''){
        		$str="SELECT  b.*,SUM(b.amount) as amount,r.name as req_type,ac.name as activities_name,DATE_FORMAT(b.activities_date,'%d-%b-%Y') AS activities_date
                     FROM expenses b
                     LEFT OUTER JOIN ref_req_type r on(r.id=b.req_type)
                     LEFT OUTER JOIN ref_court_entertainment_activities ac on(ac.id=b.activities_name)
                     WHERE b.event_id='".$id."' AND b.module_name='court' AND b.sts<>0 GROUP BY b.activities_name";
            $data = $this->db->query($str)->result();
        return $data;
        }
        else{return NULL;}
    }
    function get_expenese_details_paper($id)
    {
        if($id!=''){
                $this->db
                ->select("b.*,IF(b.vendor_type='Vendor',v.name,CONCAT(u.name,'(',u.pin,')')) as vendor_name,p.name as paper_name,DATE_FORMAT(b.activities_date,'%d-%b-%Y') AS activities_date", FALSE)
                ->from("expenses b")
                ->join('ref_paper_vendor v', 'v.id=b.vendor_id AND b.vendor_type="Vendor"', 'left')
                ->join('users_info u', 'u.id=b.vendor_id AND b.vendor_type="Staff"', 'left')
                ->join('ref_paper p', 'p.id=b.paper_name', 'left')
                ->where("b.event_id='".$id."' AND b.module_name='paper' AND b.sts<>0", NULL, FALSE);
            $data = $this->db->get()->result();
        return $data;
        }
        else{return NULL;}
    }
    function add_edit_lawyer_bill($add_edit,$id,$editrow)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $data = array(
            'selection_type' =>'lawyer_bill',
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
    function add_edit_court_fee($add_edit,$id,$editrow)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $data = array(
            'selection_type' =>'court_fee',
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
    function get_lawyer_bill_details_by_id($id)
    {
        if($id!=''){
            $str=" SELECT j0.amount,j0.description,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
            CONCAT(u.name,' (',u.code,')') as vendor_name,
            j0.loan_ac,j0.ac_name,j0.case_number,
            IF(j0.activities_id=0,j0.description,IF(j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter',hc.name,IF(j0.main_table_name='case_against_bank',ca.name,IF(j0.main_table_name='legal_affairs',la.name,IF(j0.req_type=2,ar.name,ni.name))))) as activities_name
            FROM cost_details as j0
            LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=1)
            LEFT OUTER JOIN ref_schedule_charges_ara as ar on (j0.activities_id=ar.id and j0.req_type=2 AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (j0.activities_id=ni.id and (j0.req_type=1 or j0.req_type=3 or j0.req_type=4) AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (j0.activities_id=ca.id AND j0.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (j0.activities_id=la.id AND j0.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_hc_activities as hc on (j0.activities_id=hc.id AND (j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter'))
            WHERE  j0.legal_select_id= ".$this->db->escape($id)." ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }

    function get_court_fee_details_by_id($id)
    {
        if($id!=''){
        	$str=" SELECT j0.amount,j0.description,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
            CONCAT(u.name,' (',u.code,')') as vendor_name,
            j0.loan_ac,j0.ac_name,j0.case_number,
            IF(j0.activities_id=0,j0.description,co.name) as activities_name
            FROM cost_details as j0
            LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=4)
            LEFT OUTER JOIN ref_court_fee_activities as co on (j0.activities_id=co.id AND j0.main_table_name='cma')
            WHERE  j0.legal_select_id= ".$this->db->escape($id)." ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_bulk_data_lawyer()
    {
        $where2 = "a.sts<>0 and a.selection_type='lawyer_bill' and a.sts=37";
        if (check_group('1'))
        {
            $where2 .=multi_selected_query_maker($this->session->userdata['ast_user']['legal_region'],'j1.legal_region');//" AND u.region IN(".$this->session->userdata['ast_user']['legal_region'].")";
        }
        if($this->input->post('case_deal_officer') != '')
        {
            $where2.=" AND a.e_by = '".$this->input->post('case_deal_officer')."'";
        }
        if($this->input->post('lawyer') != '')
        {
            $where2.=" AND a.lawyer = '".$this->input->post('lawyer')."'";
        }
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') == '') 
        {$where2.=" AND DATE(a.e_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') != '') 
        {$where2.=" AND DATE(a.e_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(a.e_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}

        $this->db
        ->select('a.*,a.e_by as e_by_id,l.name as lawyer_name,
            j0.name as status,
            CONCAT(j1.name," (",j1.user_id,")")as e_by,
            CONCAT(j2.name," (",j2.user_id,")")as v_by,
            DATE_FORMAT(a.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
            DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt', FALSE)
            ->from("legal_bill_selection a")
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('ref_lawyer as l', 'a.lawyer=l.id', 'left')
            ->join('users_info as j1', 'a.e_by=j1.id', 'left')
            ->join('users_info as j2', 'a.v_by=j2.id', 'left')
            ->where($where2)
            ->order_by('a.id','DESC');
        $q=$this->db->get();
        return $q->result();
    }
    function get_bulk_data_court_fee()
    {
        $where2 = "a.sts<>0 and a.selection_type='court_fee' and a.sts=37";
        if (check_group('1'))
        {
            $where2 .=multi_selected_query_maker($this->session->userdata['ast_user']['legal_region'],'j1.legal_region');//" AND u.region IN(".$this->session->userdata['ast_user']['legal_region'].")";
        }
        if($this->input->post('case_deal_officer') != '')
        {
            $where2.=" AND a.e_by = '".$this->input->post('case_deal_officer')."'";
        }
        if($this->input->post('lawyer') != '')
        {
            $where2.=" AND a.lawyer = '".$this->input->post('lawyer')."'";
        }
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') == '') 
        {$where2.=" AND DATE(a.e_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') != '') 
        {$where2.=" AND DATE(a.e_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(a.e_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}

        $this->db
        ->select('a.*,a.e_by as e_by_id,l.name as lawyer_name,
            j0.name as status,
            CONCAT(j1.name," (",j1.user_id,")")as e_by,
            CONCAT(j2.name," (",j2.user_id,")")as v_by,
            DATE_FORMAT(a.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
            DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt', FALSE)
            ->from("legal_bill_selection a")
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('ref_lawyer as l', 'a.lawyer=l.id', 'left')
            ->join('users_info as j1', 'a.e_by=j1.id', 'left')
            ->join('users_info as j2', 'a.v_by=j2.id', 'left')
            ->where($where2)
            ->order_by('a.id','DESC');
        $q=$this->db->get();
        return $q->result();
    }
    function get_bulk_data_court_enter()
    {
        $where2 = "e.sts<>'0' and e.v_sts=37 ";
        if (check_group('1'))
        {
            $where2 .=multi_selected_query_maker($this->session->userdata['ast_user']['legal_region'],'u.legal_region');//" AND u.region IN(".$this->session->userdata['ast_user']['legal_region'].")";
        }
        if($this->input->post('case_deal_officer') != '')
        {
            $where2.=" AND e.e_by = '".$this->input->post('case_deal_officer')."'";
        }
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') == '') 
        {$where2.=" AND DATE(e.e_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') != '') 
        {$where2.=" AND DATE(e.e_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(e.e_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}

        $this->db
        ->select('e.*,j6.name as status,t.name as employee_type,d.name as district,
        r.name as legal_region,DATE_FORMAT(e.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,CONCAT(u.name," (",u.pin,")") as e_by,m.name as billing_month,IF(FIND_IN_SET(2,u.user_group_id),1,IF(FIND_IN_SET(4,u.user_group_id),3,IF(FIND_IN_SET(10,u.user_group_id),11,17))) as verifier_group_id', FALSE)
            ->from("court_entertainment_data e")
            ->join('ref_employee_type t', 't.id=e.employee_type', 'left')
            ->join('ref_legal_district d', 'd.id=e.district', 'left')
            ->join('ref_legal_region r', 'r.id=e.legal_region', 'left')
            ->join('ref_billing_month m', 'm.id=e.billing_month', 'left')
            ->join('users_info u', 'e.e_by=u.id', 'left')
            ->join('ref_status as j6', 'e.v_sts=j6.id', 'left')
            ->where($where2)
            ->order_by('e.id','DESC');
        $q=$this->db->get();
        return $q->result();
    }
    function get_bulk_data_paper()
    {
        $where2 = "e.sts<>'0' and e.v_sts=37 ";
        if (check_group('1'))
        {
            $where2 .=multi_selected_query_maker($this->session->userdata['ast_user']['legal_region'],'u.legal_region');//" AND u.region IN(".$this->session->userdata['ast_user']['legal_region'].")";
        }
        if($this->input->post('case_deal_officer') != '')
        {
            $where2.=" AND e.e_by = '".$this->input->post('case_deal_officer')."'";
        }
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') == '') 
        {$where2.=" AND DATE(e.e_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') != '') 
        {$where2.=" AND DATE(e.e_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(e.e_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}

        $this->db
        ->select('e.*,j6.name as status,d.name as district_name,us.name as under_section_name,
        u.user_group_id,IF(FIND_IN_SET(2,u.user_group_id),1,IF(FIND_IN_SET(4,u.user_group_id),3,IF(FIND_IN_SET(10,u.user_group_id),11,17))) as verifier_group_id', FALSE)
            ->from("paper_bill_data e")
            ->join('ref_legal_district d', 'd.id=e.district', 'left')
            ->join('ref_under_section us', 'us.id=e.under_section', 'left')
            ->join('users_info u', 'e.e_by=u.id', 'left')
            ->join('ref_status as j6', 'e.v_sts=j6.id', 'left')
            ->where($where2)
            ->order_by('e.id','DESC');
        $q=$this->db->get();
        return $q->result();
    }
    function bulk_acktion()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = true; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($this->input->post('operation')=='approve' && ($this->input->post('module_name')=='lawyer_apv' || $this->input->post('module_name')=='court_fee_apv')){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('legal_bill_selection',$_POST['id_'.$i],93,'sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $table_name = "legal_bill_selection";
                        $bill_data['legal_select_sts'] = 93;
                        $this->db->where('legal_select_id', $_POST['id_'.$i]);
                        $this->db->update('cost_details', $bill_data);

                        $data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'sts'=>93);
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('legal_bill_selection', $data);
                        $activities_id = 93;
                        $description_activities = 'Verify Lawyer Bill Selection - ';
                        $reason = "";
                        $row_id=$_POST['id_'.$i];
                        $this->User_model->user_activities_bill($activities_id,'legal_bill_selection',$row_id,$table_name,$description_activities,$reason);
                        
                    }
                }
                
                
            }
        }
        if($this->input->post('operation')=='return' && ($this->input->post('module_name')=='lawyer_apv' || $this->input->post('module_name')=='court_fee_apv')){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('legal_bill_selection',$_POST['id_'.$i],'38,90,91','sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $table_name = "legal_bill_selection";
                        $bill_data['legal_select_sts'] = 90;
                        $this->db->where('legal_select_id', $_POST['id_'.$i]);
                        $this->db->update('cost_details', $bill_data);

                        $data = array('sts' => 90,'return_reason' => $_POST['return_reason'],'return_by'=> $this->session->userdata['ast_user']['user_id'], 'return_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('legal_bill_selection', $data);
                        $activities_id = 90;
                        $description_activities = 'Lawyer Selection Entry Return By Checker - ';
                        $row_id=$_POST['id_'.$i];
                        $reason = $_POST['return_reason'];
                        $this->User_model->user_activities_bill($activities_id,'legal_bill_selection',$row_id,$table_name,$description_activities,$reason);
                    }
                }
                
                
            }
        }

        if($this->input->post('operation')=='approve' && $this->input->post('module_name')=='court_enter_apv'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('court_entertainment_data',$_POST['id_'.$i],38,'v_sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $table_name = "court_entertainment_data";
                        $data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('court_entertainment_data', $data);
                        $activities_id = 38;
                        $description_activities = 'Verify Court Entertainment - ';
                        $row_id=$_POST['id_'.$i];
                        $reason="";
                        //Genereate Expenses
                        $str="SELECT  j0.*
                                 FROM expenses j0
                             WHERE j0.sts != '0' AND j0.module_name='court'  AND j0.event_id= '".$_POST['id_'.$i]."'";

                        $expense_data=$this->db->query($str)->result();
                        if (!empty($expense_data)) {
                                foreach ($expense_data as $key) {
                                    //echo $key->suit_id;
                                    $str2="SELECT  j0.prest_court_name as court_id,j0.cif
                                             FROM suit_filling_info j0
                                         WHERE j0.sts != '0' AND j0.id='".$key->suit_id."'";

                                    $suit_data=$this->db->query($str2)->row();
                                    if(!empty($suit_data))
                                    {
                                        $court_id = $suit_data->court_id;
                                        $cif = $suit_data->cif;
                                        $loan_segment = $suit_data->loan_segment;
                                    }else{$court_id = 0;$cif = '';$loan_segment = '';}
                                $cost_data = array(
                                    'module_name' => 'suit_file',
                                    'main_table_name' => 'court_entertainment_data',
                                    'main_table_id' => $key->event_id,
                                    'sub_table_name' => 'expenses',
                                    'sub_table_id' => $key->id,
                                    'activities_id' => $key->activities_name,
                                    'vendor_type' => $key->expense_type,
                                    'vendor_name' => $key->vendor_name,
                                    'vendor_pin' => $key->vendor_pin,
                                    'amount' =>$key->amount,
                                    'txrn_dt' => $key->activities_date,
                                    'loan_ac' =>$key->account_number,
                                    'cif' =>$cif,
                                    'req_type' =>$key->req_type,
                                    'case_number' =>$key->case_number,
                                    'region' =>$key->region,
                                    'district' =>$key->district,
                                    'vendor_ac_no' =>$key->vendor_ac_no,
                                    'proposed_type' =>$key->proposed_type,
                                    'org_loan_ac' =>$key->org_loan_ac,
                                    'ac_name' =>$key->ac_name,
                                    'vendor_id' =>$key->vendor_id,
                                    'suit_id' =>$key->suit_id,
                                    'loan_segment' =>$loan_segment,
                                    'court_id' =>$court_id,
                                    'expense_remarks' =>$key->remarks

                                );
                                $data3=$this->user_model->cost_details($cost_data);
                                    
                            }
                        }
                        $this->User_model->user_activities_bill($activities_id,'court_entertainment_data',$row_id,$table_name,$description_activities,$reason);
                        
                    }
                }
                
                
            }
        }
        if($this->input->post('operation')=='return'  && $this->input->post('module_name')=='court_enter_apv'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('court_entertainment_data',$_POST['id_'.$i],'38,90,91','v_sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $table_name = "court_entertainment_data";
                        $data = array('v_sts' => 90,'r_reason' => $_POST['return_reason'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('court_entertainment_data', $data);
                        $activities_id = 90;
                        $description_activities = 'Bill Return By Checker - ';
                        $row_id=$_POST['id_'.$i];
                        $reason = $_POST['return_reason'];
                        $this->User_model->user_activities_bill($activities_id,'court_entertainment_data',$row_id,$table_name,$description_activities,$reason);
                    }
                }
                
                
            }
        }

        if($this->input->post('operation')=='approve' && $this->input->post('module_name')=='paper_apv'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('paper_bill_data',$_POST['id_'.$i],38,'v_sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $table_name = "paper_bill_data";
                        $data = array('v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'),'v_sts'=>38);
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('paper_bill_data', $data);
                        $activities_id = 38;
                        $description_activities = 'Verify Paper Bill - ';
                        $row_id=$_POST['id_'.$i];
                        $reason="";
                        //Genereate Expenses
                        $str="SELECT  j0.*
                                 FROM expenses j0
                             WHERE j0.sts != '0' AND j0.module_name='paper'  AND j0.event_id= '".$_POST['id_'.$i]."'";

                        $expense_data=$this->db->query($str)->result();

                        $str="SELECT  j0.*
                                 FROM paper_bill_data j0
                             WHERE j0.sts != '0' AND j0.id= '".$_POST['id_'.$i]."' LIMIT 1";

                        $bill_data=$this->db->query($str)->row();
                        if($bill_data->account_type==2)
                        {
                            $str="SELECT  j0.*
                                 FROM suit_filling_info j0
                             WHERE j0.id= '".$bill_data->suit_id."' LIMIT 1";

                            $suit_data=$this->db->query($str)->row();
                            $loan_segment = $suit_data->loan_segment;
                            $region = $suit_data->legal_region;
                            $cif = $suit_data->cif;
                            $territory = $suit_data->territory;
                            $district = $suit_data->district;
                        }
                        else
                        {
                            $str="SELECT  j0.*
                                 FROM cma j0
                             WHERE j0.id= '".$bill_data->cma_id."' LIMIT 1";

                            $cma_id=$this->db->query($str)->row();
                            $loan_segment = $cma_id->loan_segment;
                            $region = $cma_id->legal_region;
                            $cif = $cma_id->cif;
                            $territory = $cma_id->territory;
                            $district = $cma_id->case_fill_dist;
                        }
                        if (!empty($expense_data)) {
                                foreach ($expense_data as $key) {
                                $cost_data = array(
                                    'module_name' => 'suit_file',
                                    'main_table_name' => 'paper_bill_data',
                                    'main_table_id' => $_POST['id_'.$i],
                                    'sub_table_name' => 'expenses',
                                    'sub_table_id' => $key->id,
                                    'vendor_type' => 2,
                                    'vendor_id' => $key->vendor_id,
                                    'paper_bill_vendor_type' => $key->vendor_type,
                                    'paper_id' => $key->paper_name,
                                    'cma_id' => $bill_data->cma_id,
                                    'suit_id' => $bill_data->suit_id,
                                    'tin' => $key->tin,
                                    'bin' => $key->bin,
                                    'mousak' => $key->mousak,
                                    'paper_scan_copy' => $key->paper_scan_copy,
                                    'paper_expense_approval_file' => $key->paper_expense_approval_file,
                                    'amount' =>$key->amount,
                                    'txrn_dt' => $key->activities_date,
                                    'loan_ac' =>$bill_data->loan_ac,
                                    'cif' =>$cif,
                                    'loan_segment' =>$loan_segment,
                                    'req_type' =>$bill_data->req_type,
                                    'case_number' =>$bill_data->case_number,
                                    'region' =>$region,
                                    'territory' =>$territory,
                                    'district' =>$district,
                                    'vendor_ac_no' =>$key->account_no,
                                    'proposed_type' =>$bill_data->proposed_type,
                                    'org_loan_ac' =>$bill_data->org_loan_ac,
                                    'ac_name' =>$bill_data->ac_name

                                );
                                $data3=$this->user_model->cost_details($cost_data);
                                    
                            }
                        }
                        $this->User_model->user_activities_bill($activities_id,'paper_bill_data',$row_id,$table_name,$description_activities,$reason);
                        
                    }
                }
                
                
            }
        }
        if($this->input->post('operation')=='return'  && $this->input->post('module_name')=='paper_apv'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('paper_bill_data',$_POST['id_'.$i],'38,90,91','v_sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $table_name = "paper_bill_data";
                        $data = array('v_sts' => 90,'r_reason' => $_POST['return_reason'],'r_by'=> $this->session->userdata['ast_user']['user_id'], 'r_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('paper_bill_data', $data);
                        $activities_id = 90;
                        $description_activities = 'Bill Return By Checker - ';
                        $row_id=$_POST['id_'.$i];
                        $reason = $_POST['return_reason'];
                        $this->User_model->user_activities_bill($activities_id,'paper_bill_data',$row_id,$table_name,$description_activities,$reason);
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
    function get_xl_details_staff_conv($bill_id)
    {
        if($bill_id!=''){
            $str="SELECT SUM(j0.amount) as amount,en.year,u.bank_ac,u.mobile_number,en.conv_type,
            r.name as region,m.name as billing_month,u.name as staff_name,u.pin as staff_pin,
            d.name as district_name
            FROM cost_details as j0
            LEFT OUTER JOIN staff_conv_data en ON(en.id=j0.main_table_id)
            LEFT OUTER JOIN users_info u ON(en.staff_id=u.id)
            LEFT OUTER JOIN ref_billing_month m ON(m.id=en.month)
            LEFT OUTER JOIN ref_legal_region r ON(r.id=u.region)
            LEFT OUTER JOIN ref_legal_district d ON(d.id=u.district)
            WHERE j0.module_name='staff_conv' AND j0.main_table_name='staff_conv_data' AND  j0.main_table_id= ".$bill_id." GROUP BY j0.main_table_id ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_xl_details_court_enter($bill_id)
    {
        if($bill_id!=''){
            $str="SELECT sub.*,SUM(sub.amount) AS amount,GROUP_CONCAT(DISTINCT(sub.billing_month) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS billing_month FROM 
                (
                SELECT SUM(j0.amount) AS amount,j0.description,j0.vendor_name,j0.vendor_pin,en.base_office_name,
                            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') AS txrn_dt,r.name AS legal_region,m.name AS billing_month,
                            fn.name AS functional_desig,en.job_grade,en.mobile_no,en.account_number,
                            j0.loan_ac,j0.ac_name,j0.case_number
                            FROM cost_details AS j0
                            LEFT OUTER JOIN court_entertainment_data en ON(en.id=j0.main_table_id)
                            LEFT OUTER JOIN ref_billing_month m ON(m.id=en.billing_month)
                            LEFT OUTER JOIN ref_functional_designation fn ON(fn.id=en.functional_desig)
                            LEFT OUTER JOIN ref_legal_region r ON(r.id=en.legal_region)
                            WHERE j0.main_table_name='court_entertainment_data' AND j0.main_table_id='".$bill_id."' GROUP BY j0.main_table_id ORDER BY j0.id ASC
                )sub GROUP BY sub.vendor_pin";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
}