<?php
class Legal_affairs_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
	}



	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        $i=0;
        $where2 = "b.sts!='0'";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('1'))
        {
            array_push($condition_array,"b.region IN(".$this->session->userdata['ast_user']['legal_region'].")");
        }
        if (check_group('2'))
        {
            array_push($condition_array,"(b.case_deal_officer='".$this->session->userdata['ast_user']['user_id']."' or b.e_by='".$this->session->userdata['ast_user']['user_id']."')");
        }
        if(check_group('1') || check_group('2'))
        {
            $where2 .=implode(" OR ",$condition_array);
            $where2 .=") ";
        }
        if($this->input->get('req_type')!='') 
        {$where2.=" AND b.req_type = '".trim($this->input->get('req_type'))."'";}

        if($this->input->get('proposed_type')!='') 
        {$where2.=" AND b.proposed_type = '".trim($this->input->get('proposed_type'))."'";}

        if($this->input->get('case_number')!='') 
        {$where2.=" AND b.case_number = '".trim($this->input->get('case_number'))."'";}

        if($this->input->get('loan_ac')!='' && $this->input->get('proposed_type')!='') 
        {
            if ($this->input->get('proposed_type')=='Loan') {
                $where2.= " AND b.loan_ac='".$this->input->get('loan_ac')."'";
            }else if($this->input->get('proposed_type')=='Card')
            {
                $where2.= " AND b.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->get('hidden_loan_ac'))."'";
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

                if($filterdatafield=='loan_ac')
                {
                    $filterdatafield='b.loan_ac';
                }
                else if($filterdatafield=='ac_name')
                {
                    $filterdatafield='b.ac_name';
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield='j14.name';
                }
                else if($filterdatafield=='req_type')
                {
                    $filterdatafield='j1.name';
                }
                else if($filterdatafield=='case_number')
                {
                    $filterdatafield='b.case_number';
                }
                else if($filterdatafield=='case_section')
                {
                    $filterdatafield='b.case_section';
                }
                else if($filterdatafield=='region')
                {
                    $filterdatafield='j3.name';
                }
                else if($filterdatafield=='district')
                {
                    $filterdatafield='j5.name';
                }
                else if($filterdatafield=='e_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(b.e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield='j6.name';
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
                    $where .= " (j13.name LIKE '%".$filtervalue."%' OR j13.user_id LIKE '%".$filtervalue."%') ";
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
            $sortdatafield="b.id";
            $sortorder = "DESC";                
        }
    $this->db
    ->select('SQL_CALC_FOUND_ROWS b.e_by as e_by_id,b.suit_sts,b.id,b.loan_ac,b.ac_name,b.proposed_type,b.defendant_name,j0.name as branch_sol,
            	j1.name as req_type,j2.name as loan_segment,j3.name as region,
            	j5.name as district,CONCAT(j6.name," (",j6.pin,")")as recovery_am,j14.name as status,
            	j7.name as case_name,b.case_number,b.case_section,b.case_history,
            	DATE_FORMAT(b.next_date,"%d-%b-%Y") AS next_date,j8.name as case_sts,
            	CONCAT(j9.name," (",j9.pin,")")as filling_plaintiff,DATE_FORMAT(b.filling_date,"%d-%b-%Y") AS filling_date,
            	j10.name as prest_lawyer_name,j11.name as prest_court_name,j12.name as retail_branch,
            	b.remarks,CONCAT(j13.name," (",j13.user_id,")")as e_by,DATE_FORMAT(b.e_dt,"%d-%b-%y") AS e_dt
        ', FALSE)
            ->from("legal_affairs b")
            ->join('ref_branch_sol as j0', 'b.branch_sol=j0.code', 'left')
            ->join('ref_case_type_legal_affairs as j1', 'b.req_type=j1.id', 'left')
            ->join('ref_loan_segment as j2', 'b.loan_segment=j2.code', 'left')
            ->join('ref_legal_region as j3', 'b.region=j3.id', 'left')
            ->join('ref_legal_district as j5', 'b.district=j5.id', 'left')
            ->join('users_info as j6', 'b.recovery_am=j6.id', 'left')
            ->join('ref_case_name as j7', 'b.case_name=j7.id', 'left')
            ->join('ref_case_sts as j8', 'b.case_sts_prev_dt=j8.id', 'left')
            ->join('users_info as j9', 'b.filling_plaintiff=j9.id', 'left')
            ->join('ref_lawyer as j10', 'b.prest_lawyer_name=j10.id', 'left')
            ->join('ref_court as j11', 'b.prest_court_name=j11.id', 'left')
            ->join('ref_retail_branch as j12', 'b.retail_branch=j12.id', 'left')
            ->join('users_info as j13', 'b.e_by=j13.id', 'left')
            ->join('ref_status as j14', 'b.suit_sts=j14.id', 'left')
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
    function get_grid_data_case_sts($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        $i=0;
        //$where2 = "b.sts!='0' and b.life_cycle IN(4)";
        $where2 ="j0.sts!='0' AND j0.change_type IN(1)";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('1'))
        {
            array_push($condition_array,"c.region IN(".$this->session->userdata['ast_user']['legal_region'].")");
        }
        if (check_group('2'))
        {
            array_push($condition_array,"j0.e_by='".$this->session->userdata['ast_user']['user_id']."'");
            
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
                else if($filterdatafield=='ac_name')
                {
                    $filterdatafield='c.sl_no';
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield='j1.name';
                }
                else if($filterdatafield=='e_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='u_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(j0.u_dt,'%d-%b-%y %h:%i %p')";
                }
                

                else{$filterdatafield='b.'.$filterdatafield;}

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
                    $where .= " (j0.name LIKE '%".$filtervalue."%' OR j0.user_id LIKE '%".$filtervalue."%') ";
                }
                else if($filterdatafield =='u_by')
                {
                    $where .= " (j0.name LIKE '%".$filtervalue."%' OR j0.user_id LIKE '%".$filtervalue."%') ";
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
            $sortdatafield="j0.id";
            $sortorder = "DESC";                
        }
        $this->db
        ->select('SQL_CALC_FOUND_ROWS j0.*,j0.e_by as e_by_id,c.loan_ac,c.ac_name,c.id as suit_file_id,
            j1.name as status,
            CONCAT(j2.name," (",j2.user_id,")")as e_by,
            CONCAT(j3.name," (",j3.user_id,")")as u_by,
            DATE_FORMAT(j0.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
            DATE_FORMAT(j0.u_dt,"%d-%b-%y %h:%i %p") AS u_dt', FALSE)
            ->from("legal_affairs_case_sts j0")
            ->join('legal_affairs as c', 'c.id=j0.file_id', 'left')
            ->join('ref_status as j1', 'j0.sts=j1.id', 'left')
            ->join('users_info as j2', 'j0.e_by=j2.id', 'left')
            ->join('users_info as j3', 'j0.u_by=j3.id', 'left')
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
    function get_grid_data_bill($filterscount,$sortdatafield,$sortorder,$limit, $offset)
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
                    $filterdatafield='v.name';
                }
                else if($filterdatafield=='district_name')
                {
                    $filterdatafield='d.name';
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
        $where_initi=''; 
        if($where=='' || count($where)<=0){         
            //$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
        }
        
        if ($sortorder == '')
        {
            $sortdatafield="e.id";
            $sortorder = "DESC";                
        }
        $this->db->select('SQL_CALC_FOUND_ROWS e.*,j6.name as status,t.name as expenses_name,if(e.expense_type=1,l.name,u.name) as vendor_name,d.name as district_name,
        DATE_FORMAT(e.activities_date,"%d-%m-%Y") AS a_dt,s.name as act_name,IF(FIND_IN_SET(2,u.user_group_id),1,IF(FIND_IN_SET(4,u.user_group_id),3,IF(FIND_IN_SET(10,u.user_group_id),11,17))) as verifier_group_id
        ', FALSE)
            ->from("expenses e")
            ->join('ref_expense_type t', 't.id=e.expense_type', 'left')
            ->join('ref_lawyer l', 'l.id=e.vendor_id', 'left')
            ->join('users_info u', 'u.id=e.vendor_id', 'left')
            ->join('ref_legal_district d', 'd.id=e.district', 'left')
            ->join('ref_staff_conv_activities s', 's.id=e.activities_name', 'left')
            ->join('users_info u', 'e.e_by=u.id', 'left')
            ->join('ref_status as j6', 'e.v_sts=j6.id', 'left')
            ->where("e.sts<>'0' and e.module_name='case against bank bill'".$where_initi, NULL, FALSE)
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
            WHERE r.table_row_id= ".$this->db->escape($id)." AND r.section_name='legal_affair'  ".$where."  ORDER BY r.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
 	function get_suit_file_details($id)
    {
        $this->db
            ->select('b.id,ra.name as related_authority,b.police_station,b.loan_ac,b.ac_name,b.proposed_type,b.defendant_name,j0.name as branch_sol,
            	j1.name as req_type,j2.name as loan_segment,j3.name as region,
            	j5.name as district,CONCAT(j6.name," (",j6.pin,")")as recovery_am,
            	j7.name as case_name,b.case_number,b.case_section,b.case_history,
            	DATE_FORMAT(b.next_date,"%d-%b-%Y") AS next_date,j8.name as case_sts,
            	CONCAT(j9.name," (",j9.pin,")")as filling_plaintiff,DATE_FORMAT(b.filling_date,"%d-%b-%Y") AS filling_date,
            	j10.name as prest_lawyer_name,j11.name as prest_court_name,j12.name as retail_branch,
            	b.remarks,CONCAT(j13.name," (",j13.user_id,")")as e_by,DATE_FORMAT(b.e_dt,"%d-%b-%y") AS e_dt', FALSE)
            ->from("legal_affairs b")
            ->join('ref_branch_sol as j0', 'b.branch_sol=j0.code', 'left')
            ->join('ref_case_type_legal_affairs as j1', 'b.req_type=j1.id', 'left')
            ->join('ref_loan_segment as j2', 'b.loan_segment=j2.code', 'left')
            ->join('ref_legal_region as j3', 'b.region=j3.id', 'left')
            ->join('ref_legal_district as j5', 'b.district=j5.id', 'left')
            ->join('users_info as j6', 'b.recovery_am=j6.id', 'left')
            ->join('ref_case_name as j7', 'b.case_name=j7.id', 'left')
            ->join('ref_case_sts as j8', 'b.case_sts_prev_dt=j8.id', 'left')
            ->join('users_info as j9', 'b.filling_plaintiff=j9.id', 'left')
            ->join('ref_lawyer as j10', 'b.prest_lawyer_name=j10.id', 'left')
            ->join('ref_court as j11', 'b.prest_court_name=j11.id', 'left')
            ->join('ref_retail_branch as j12', 'b.retail_branch=j12.id', 'left')
            ->join('users_info as j13', 'b.e_by=j13.id', 'left')
            ->join('ref_related_authority as ra', 'b.related_authority=ra.id', 'left')
            ->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_all_cases()
    {
        $str_where = "1";
        $limit="";


        if (isset($_POST['search_field_input'])) {
            if (trim($this->input->post('search_field_input')) != '') {
                $str_where .= " AND s.loan_ac LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.org_loan_ac LIKE'%" .$this->Common_model->stringEncryption('encrypt',$this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.case_name LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.case_number LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.territory LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.ac_name LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
            }
        }




        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $str_where .=" AND (";
        }
        if (check_group('1'))
        {
            array_push($condition_array,"s.region IN(".$this->session->userdata['ast_user']['legal_region'].")");
        }
        if (check_group('2'))
        {
            array_push($condition_array,"s.case_deal_officer='".$this->session->userdata['ast_user']['user_id']."'");
        }
        if(check_group('1') || check_group('2'))
        {
            $str_where .=implode(" OR ",$condition_array);
            $str_where .=") ";
        }
        if (isset($_POST['proposed_type'])) {
            if (trim($this->input->post('proposed_type')) != '') {
                if (trim($this->input->post('proposed_type'))=='Loan') {
                    $str_where.= " AND s.loan_ac='".trim($this->input->post('loan_ac'))."'";
                }else
                {
                    $str_where.= " AND s.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
                }
            }
        }
        if (isset($_POST['req_type'])) {
            if (trim($this->input->post('req_type')) != '') {
                $str_where.= " AND s.req_type=".$this->db->escape(trim($this->input->post('req_type')));
            }
        }
        if(isset($_POST['case_number']))
        {
            if (trim($this->input->post('case_number')) != '') {
                $str_where.= " AND s.case_number=".$this->db->escape(trim($this->input->post('case_number')));
            }
        }
        if(isset($_POST['region']))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND s.region=".$this->db->escape(trim($this->input->post('region')));
            }
        }
        if(isset($_POST['district']))
        {
            if (trim($this->input->post('district')) != '') {
                $str_where.= " AND s.district=".$this->db->escape(trim($this->input->post('district')));
            }
        }
        if(isset($_POST['loan_segment']))
        {
            if (trim($this->input->post('loan_segment')) != '') {
                $str_where.= " AND s.loan_segment=".$this->db->escape(trim($this->input->post('loan_segment')));
            }
        }
        if(isset($_POST['limit']))
        {
            if (trim($this->input->post('limit')) != '' && trim($this->input->post('limit')) != 'All') {
                $limit.= " LIMIT ".trim($this->input->post('limit'));
            }
        }
        if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
        else{$filling_dt_from='0';}
        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
        else{$filling_dt_to='0';}

        if( $filling_dt_from!='0' && $filling_dt_to=='0')
        { $str_where.= " and s.filling_date='".$filling_dt_from."'"; }
        
        if( $filling_dt_from!='0' && $filling_dt_to!='0')
        { $str_where.= " and s.filling_date between '".$filling_dt_from."' and '".$filling_dt_to."'";}
    
        $str=" SELECT s.id,fr.name as final_remarks,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,cn.name as case_name,
        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,
        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,
        cs.name as case_sts_prev_dt,d.name as district,
        csn.name as case_sts_next_dt,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,
        lr.name as legal_region,ls.name as loan_segment,s.remarks,co.total_cost as total_legal_cost
            FROM legal_affairs as s
            LEFT OUTER JOIN ref_case_type_legal_affairs r ON (r.id=s.req_type)
            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
            LEFT OUTER JOIN ref_case_sts csn ON (csn.id=s.case_sts_next_dt)
            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
            LEFT OUTER JOIN(
                SELECT cost.case_number,cost.loan_ac,cost.district,cost.org_loan_ac,SUM(cost.amount) AS total_cost FROM cost_details cost GROUP BY cost.case_number,cost.district,cost.loan_ac,cost.org_loan_ac
            )co ON(co.case_number=s.case_number AND s.district=co.district AND s.loan_ac=co.loan_ac AND s.org_loan_ac=co.org_loan_ac)
            WHERE $str_where AND s.sts<>0 AND (s.suit_sts=51 OR s.suit_sts=76 OR s.suit_sts=81)   ORDER BY s.id ASC $limit";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_case_details_info($id)
    {
        $this->db
            ->select('b.req_type,fc.name as final_case_sts,fr.name as final_remarks,b.id,b.loan_ac,b.ac_name,r.name as case_type,j0.name as case_name,
                DATE_FORMAT(b.filling_date,"%d-%b-%Y") AS filling_date,
                b.case_number,DATE_FORMAT(b.ac_close_dt,"%d-%b-%y") as ac_close_dt,
                j4.name as filling_plaintiff,j4.pin as filling_plaintiff_pin,
                j8.name as lawyer_name,j9.name as prev_court_name,j10.name as prest_court_name,
                DATE_FORMAT(b.prev_date,"%d-%b-%y") AS prev_date,j1.name as case_sts_prev_dt,
                ram.name as recovery_am,d.name as district_name,
                lr.name as legal_region_name,ls.name as loan_segment', FALSE)
            ->from("legal_affairs b")
            ->join('ref_case_name as j0', 'b.case_name=j0.id', 'left')
            ->join('ref_case_sts as j1', 'b.case_sts_prev_dt=j1.id', 'left')
            ->join('ref_case_sts as fc', 'b.case_sts_next_dt=fc.id', 'left')
            ->join('users_info as j4', 'b.filling_plaintiff=j4.id', 'left')
            ->join('users_info as ram', 'b.recovery_am=ram.id', 'left')
            ->join('ref_case_type_legal_affairs as r', 'b.req_type=r.id', 'left')
            ->join('ref_legal_district as d', 'b.district=d.id', 'left')
            ->join('ref_lawyer as j8', 'b.prest_lawyer_name=j8.id', 'left')
            ->join('ref_loan_segment as ls', 'b.loan_segment=ls.code', 'left')
            ->join('ref_legal_region as lr', 'b.region=lr.id', 'left')
            ->join('ref_court as j9', 'b.prev_court_name=j9.id', 'left')
            ->join('ref_court as j10', 'b.prest_court_name=j10.id', 'left')
            ->join('ref_final_remarks as fr', 'fr.id=b.final_remarks', 'left')
            ->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_pre_case_sts($id)
    {
        $str=" SELECT cr.id as changed_id,ca.name as case_sts_next_dt,DATEDIFF(b.next_date,'".date('Y-m-d')."') as dif,b.case_sts_next_dt as next_date_sts,IF(b.next_dt_sts=1,DATE_FORMAT(b.next_date,'%d/%m/%Y'),b.next_date) AS next_date,b.case_sts_prev_dt as pre_case_sts_sl,cr.remarks as prev_case_sts_remarks,
            DATE_FORMAT(cr.case_dt,'%d-%b-%Y') AS prev_case_dt,cr.next_dt_remarks,scn.name as act_prev_date
            FROM legal_affairs as b
            LEFT OUTER JOIN ref_case_sts as ca on (b.case_sts_prev_dt=ca.id)
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as scn on (b.act_prev_date=scn.id)
            LEFT OUTER JOIN(
                SELECT c.* FROM legal_affairs_case_sts c WHERE c.sts<>0 AND c.change_type=1 AND c.file_id='".$id."' AND c.sts=51 ORDER BY id DESC LIMIT 1
            ) cr on (cr.file_id=b.id)
            WHERE b.id='".$id."' LIMIT 1";
        $query=$this->db->query($str);
        return $query->row();
    }
    function get_case_status_history($id)
    {
        if($id!=''){
            $str=" SELECT j0.*,pre_c.name as prev_case_sts,prs_c.name as present_case_sts,
            CONCAT(u.name,' (',u.pin,')')as e_by,DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,
            IF(j0.next_dt_sts=1,DATE_FORMAT(j0.next_case_dt,'%d-%b-%y'),j0.next_case_dt) AS next_case_dt,
            next_dt_pur.name as next_dt_purpose
            FROM legal_affairs_case_sts as j0
            LEFT OUTER JOIN ref_case_sts as pre_c on (j0.prev_item=pre_c.id)
            LEFT OUTER JOIN ref_case_sts as prs_c on (j0.case_sts=prs_c.id)
            LEFT OUTER JOIN ref_case_sts as next_dt_pur on (j0.next_date_purpose=next_dt_pur.id)
            LEFT OUTER JOIN users_info as u on (j0.e_by=u.id)
            WHERE j0.sts=51 AND j0.file_id= ".$id." AND j0.change_type=1 ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
	function get_add_action_data($id)
	{
		$this->db
			->select("b.*", FALSE)
			->from("legal_affairs b")
			->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
    function get_add_action_data_case_sts($id)
    {
        $this->db
            ->select("b.*", FALSE)
            ->from("legal_affairs_case_sts b")
            ->where("b.sts<>0 and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_all_expense_by_case($id,$req_type)
    {
        $join = "";
        if ($req_type==1) {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ni as a on (j0.activities_id=a.id AND j0.vendor_type=1)";
            $select = "a.name,";
        }
        else if ($req_type==2) {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ara as a on (j0.activities_id=a.id AND j0.vendor_type=1)";
            $select = "a.name,";
        }
        else
        {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ni as a on (j0.activities_id=a.id AND j0.vendor_type=1)";
            $select = "a.name,";
        }
        if($id!=''){
            $str=" SELECT j0.amount,j0.expense_remarks,IF(j0.vendor_type=1 or j0.vendor_type=4,l.name,IF(vendor_type=2,v.name,IF((j0.vendor_type=3 or j0.vendor_type=5),CONCAT(u.name,' (',u.pin,')'),j0.vendor_name))) as vendor_name,
            e.name as expense_type_name,DATE_FORMAT(j0.txrn_dt,'%d-%b-%y') AS activities_date,
            IF(j0.vendor_type=1,".$select."IF(j0.vendor_type=2,p.name,IF(j0.vendor_type=3,s.name,IF(j0.vendor_type=4,c.name,IF(j0.vendor_type=5,en.name,ot.name))))) as activities_name
            FROM cost_details as j0
            LEFT OUTER JOIN ref_expense_type as e on (j0.vendor_type=e.id)
            LEFT OUTER JOIN ref_lawyer as l on (j0.vendor_id=l.id and (j0.vendor_type=1 or j0.vendor_type=4))
            LEFT OUTER JOIN ref_paper_vendor as v on (j0.vendor_id=v.id and j0.vendor_type=2)
            LEFT OUTER JOIN users_info as u on (j0.vendor_id=u.id and (j0.vendor_type=3 or j0.vendor_type=5))
            LEFT OUTER JOIN ref_paper_bill_activities as p on (j0.activities_id=p.id and j0.vendor_type=2)
            LEFT OUTER JOIN ref_staff_conv_activities as s on (j0.activities_id=s.id and j0.vendor_type=3)
            LEFT OUTER JOIN ref_court_fee_activities as c on (j0.activities_id=c.id and j0.vendor_type=4)
            LEFT OUTER JOIN ref_court_entertainment_activities as en on (j0.activities_id=en.id and j0.vendor_type=5)
            LEFT OUTER JOIN ref_others_cost_activities as ot on (j0.activities_id=ot.id and j0.vendor_type=6)
            $join
            WHERE j0.suit_id= ".$id." AND j0.module_name='legal_affair' ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_add_action_data_suit($id)
    {
        $this->db
            ->select("b.*,j0.name as type_of_case,IF(b.next_dt_sts=1,DATE_FORMAT(b.next_date,'%d/%m/%Y'),b.next_date) AS next_date,DATEDIFF(b.next_date,'".date('Y-m-d')."') as dif", FALSE)
            ->from("legal_affairs b")
            ->join('ref_case_type_legal_affairs as j0', 'b.req_type=j0.id', 'left')
            ->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
	function delete_action($id=NULL,$bulk=NULL,$type=NULL)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if(isset($_POST['type']) && $this->input->post('type')=='delete'){
            $pre_action_result=$this->Common_model->get_pre_action_data('legal_affairs',$_POST['deleteEventId'],0,'sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('d_reason'=>trim($_POST['comments']), 'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('legal_affairs', $data);
                $data2 = $this->user_model->user_activities(15,'legal_affair',$this->input->post('deleteEventId'),'legal_affairs','Delete Legal Affairs Data('.$this->input->post('deleteEventId').')',$_POST['comments']);
            }
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='sendtochecker'){
            $pre_action_result=$this->Common_model->get_pre_action_data('legal_affairs',$_POST['deleteEventId'],'37','suit_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data2 = array('suit_sts' => 37,'stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('legal_affairs', $data2);
                $data3 = $this->user_model->user_activities(37,'legal_affair',$this->input->post('deleteEventId'),'legal_affairs','Legal Affairs send to checker('.$this->input->post('deleteEventId').')');
            }
            $id = $_POST['deleteEventId'];
            
        }
        if(isset($_POST['type']) && $this->input->post('type')=='approve'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_affairs',$_POST['deleteEventId'],'51,53,82','suit_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('suit_sts' => 51,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_affairs', $data);
				$data2 = $this->user_model->user_activities(51,'legal_affair',$this->input->post('deleteEventId'),'legal_affairs','Approve Legal Affairs('.$this->input->post('deleteEventId').')');
			}
			$id = $_POST['deleteEventId'];
			
		}
		if(isset($_POST['type']) && $this->input->post('type')=='reject'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_affairs',$_POST['deleteEventId'],'51,53,82','suit_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('suit_sts' => 53,'reject_reason'=>trim($_POST['reason']),'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_affairs', $data);

				$data2 = $this->user_model->user_activities(53,'legal_affair',$this->input->post('deleteEventId'),'legal_affairs','Reject Legal Affair('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
			$id = $_POST['deleteEventId'];
			
		}
		if(isset($_POST['type']) && $this->input->post('type')=='return'){
			$pre_action_result=$this->Common_model->get_pre_action_data('legal_affairs',$_POST['deleteEventId'],'51,53,82','suit_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('suit_sts' => 82,'return_reason'=>trim($_POST['reason']),'return_by'=> $this->session->userdata['ast_user']['user_id'], 'return_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('legal_affairs', $data);
				
				$data2 = $this->user_model->user_activities(82,'legal_affair',$this->input->post('deleteEventId'),'legal_affairs','Return legal Affairs ('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
			$id = $_POST['deleteEventId'];
		}
        if(isset($_POST['type']) && $this->input->post('type')=='updatenextdate'){
            $data['module_name'] = 'legal_affairs';
            $data['status_id'] = $_POST['deleteEventId'];
            $data['new_sts'] = $_POST['next_date_sts_grid'];
            $data['new_date'] = implode('-',array_reverse(explode('/',$this->input->post('new_next_date'))));
            $data['update_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['update_date'] = date('Y-m-d H:i:s');
            $this->db->insert('next_date_update_history', $data);
            
            
            $data4=array();
            $data4['next_dt_sts'] = 1;
            $data4['remarks_next_date'] = $_POST['next_dt_remarks'];
            $data4['case_sts_next_dt'] = $_POST['next_date_sts_grid'];
            $data4['next_date'] = implode('-',array_reverse(explode('/',$this->input->post('new_next_date'))));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('legal_affairs', $data4);
            $data3 = $this->user_model->user_activities(92,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Update Next Date('.$this->input->post('deleteEventId').')');
            $id = $_POST['deleteEventId'];
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
            return $id;
        }
    }
    function get_suit_info($id)
    {
        $this->db
            ->select("b.*", FALSE)
            ->from("legal_affairs b")
            ->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
	function add_edit_action()
	{
		$this->db->trans_begin();
	    //Case Data
	    $add_edit = $this->input->post('add_edit');
	    $case_data = array(
	    	'proposed_type' =>$this->security->xss_clean( $this->input->post('proposed_type_f')),
			'defendant_name' =>$this->security->xss_clean( $this->input->post('defendant_name')),
			'branch_sol' =>$this->security->xss_clean( $this->input->post('branch_sol')),
			'region' =>$this->security->xss_clean( $this->input->post('region')),
			'territory' =>$this->security->xss_clean( $this->input->post('territory')),
			'district' =>$this->security->xss_clean( $this->input->post('district')),
			'loan_segment' =>$this->security->xss_clean( $this->input->post('loan_segment')),
			'case_history' =>$this->security->xss_clean( $this->input->post('case_history')),
			'req_type' =>$this->security->xss_clean( $this->input->post('req_type_f')),
            'related_authority' =>$this->security->xss_clean( $this->input->post('related_authority')),
			'police_station' =>$this->security->xss_clean( $this->input->post('police_station')),
			'case_name' =>$this->security->xss_clean( $this->input->post('case_name')),
			'case_section' =>$this->security->xss_clean( $this->input->post('case_section')),
			'next_dt_sts' =>$this->security->xss_clean( $this->input->post('next_dt_sts_value')),
            'case_number' =>$this->security->xss_clean( $this->input->post('case_number_f')).'/'.$this->security->xss_clean( $this->input->post('case_year')),
			'filling_date' =>implode('-',array_reverse(explode('/',$this->input->post('filling_date')))),
			'case_sts_prev_dt' =>$this->security->xss_clean( $this->input->post('case_sts')),
            'initial_case_sts' =>$this->security->xss_clean( $this->input->post('case_sts')),
			'filling_plaintiff' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
            'present_plaintiff' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
            'case_deal_officer' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
			'recovery_am' =>$this->security->xss_clean( $this->input->post('recovery_am')),
			'prest_lawyer_name' =>$this->security->xss_clean( $this->input->post('prest_lawyer_name')),
			'prest_court_name' =>$this->security->xss_clean( $this->input->post('prest_court_name')),
			'retail_branch' =>$this->security->xss_clean( $this->input->post('retail_branch')),
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),
			'final_remarks' =>1

		);
		if ($_POST['proposed_type_f']=='Card') 
		{
			$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac_f')); 
		}
		else{$org_loan_ac='';}
		$case_data['loan_ac'] = $this->security->xss_clean($this->input->post('loan_ac_f'));
		$case_data['org_loan_ac'] = $org_loan_ac;
    	$case_data['ac_name'] = $this->security->xss_clean($this->input->post('ac_name'));
        if ($_POST['next_dt_sts_value']==1) {
            $case_data['next_date'] =implode('-',array_reverse(explode('/',$this->input->post('next_date'))));
        }
        else
        {
            $sys_config= $this->User_info_model->upr_config_row();
            $case_data['next_date'] = $sys_config->next_dt_text;
        }
		//For Pre Cas
	    
		if($add_edit=="add")
		{
			if($this->input->post('hidden_suit_id')!='')
		    {
		    	$suit_data = $this->Legal_file_process_model->get_suit_info($this->input->post('hidden_suit_id'));
		    	$case_data['pre_case_id'] = $suit_data->id;
		    	$case_data['loan_ac'] = $suit_data->loan_ac;
		    	$case_data['org_loan_ac'] = $suit_data->org_loan_ac;
		    	$case_data['pre_new_case'] = 1;
		    	$case_data['ac_name'] = $suit_data->ac_name;
		    }
			$case_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$case_data['e_dt'] = date('Y-m-d H:i:s');
			$case_data['suit_sts'] = 39;
			$this->db->insert('legal_affairs', $case_data);
			$insert_idss = $this->db->insert_id();
			$data2 = $this->user_model->user_activities(39,'legal_affair',$insert_idss,'legal_affairs','Legal Affairs Info Added('.$insert_idss.')');
		}
		else
		{
			$edit_id = $this->input->post('edit_id');
	  		$case_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$case_data['u_dt'] = date('Y-m-d H:i:s');
			$this->db->where('id', $edit_id);
			$this->db->update('legal_affairs', $case_data);
	  		$insert_idss = $edit_id;
	  		$data2 = $this->user_model->user_activities(35,'legal_affair',$insert_idss,'legal_affairs','Legal Affairs Info Updated('.$insert_idss.')');
	  		

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
    function add_edit_case_sts()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        //for back case status check
        if ($this->security->xss_clean($this->input->post('pre_case_sts_sl'))>$this->security->xss_clean( $this->input->post('case_sts'))) {
            $back_case_status = 1;
        }
        else
        {
            $back_case_status = 0;
        }
         if($this->security->xss_clean( $this->input->post('plaintiff'))!='')
         {
            $str = explode("_",$this->security->xss_clean( $this->input->post('plaintiff')));
            $plaintiff=$str[0];
         }
         else
         {
            $plaintiff='';
         }
         if($this->security->xss_clean( $this->input->post('lawyer'))!=0)
         {
            $noc_file = $this->get_file_name('noc_file','cma_file/noc_file/');
            $prev_lawyer_name = $this->input->post('lawyer');
         }
         else
         {
            $noc_file = '';
            $prev_lawyer_name = $_POST['present_lawyer_id'];
         }
         $optional_attachment = $this->get_file_name('optional_attachment','cma_file/optional_attachment/');
         $data = array(
                'file_id' =>$this->security->xss_clean( $this->input->post('suit_file_id')),
                'back_case_status' =>$back_case_status,
                'prev_item' =>$this->security->xss_clean( $this->input->post('pre_case_sts_sl')),
                'change_type' =>1,
                'noc_file' =>$noc_file,
                'optional_attachment' =>$optional_attachment,
                'final_remarks' =>$this->security->xss_clean( $this->input->post('final_remarks')),
                'case_sts' =>$this->security->xss_clean( $this->input->post('case_sts')),
                'new_lawyer_name' =>$this->security->xss_clean( $this->input->post('lawyer')),
                'new_plaintiff' =>$plaintiff,
                'next_dt_sts' =>$this->security->xss_clean( $this->input->post('next_dt_sts_value')),
                'new_court' =>$this->security->xss_clean( $this->input->post('court')),
                'new_district' =>$this->security->xss_clean( $this->input->post('district')),
                'case_dt' =>implode('-',array_reverse(explode('/',$this->input->post('case_dt')))),
                'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),
                'next_dt_remarks' =>$this->security->xss_clean( $this->input->post('next_dt_remarks')),
                'next_date_purpose' =>$this->security->xss_clean( $this->input->post('next_date_purpose'))
        );
         if ($_POST['next_dt_sts_value']==1) {
            $data['next_case_dt'] =implode('-',array_reverse(explode('/',$this->input->post('next_case_dt'))));
        }
        else
        {
            $sys_config= $this->User_info_model->upr_config_row();
            $data['next_case_dt'] = $sys_config->next_dt_text;
        }
        //Add Action
        if ($this->input->post('add_edit')=='add') 
        {
            //For old data
             $str="SELECT  j0.filling_plaintiff,j0.district,j0.prest_lawyer_name,j0.prest_court_name
                         FROM legal_affairs j0
                     WHERE j0.sts != '0'  AND j0.id= '".$this->input->post('suit_file_id')."'LIMIT 1";   
            $existing_data=$this->db->query($str)->row();
            $data['prev_plaintiff'] = $existing_data->filling_plaintiff;
            $data['prev_court'] = $existing_data->prest_court_name;
            $data['prev_lawyer_name'] = $existing_data->prest_lawyer_name;
            $data['prev_district'] = $existing_data->district;
            //Check For existing non verified request
            $str="SELECT  j0.sts
                         FROM legal_affairs_case_sts j0
                     WHERE j0.sts != '0'  AND j0.file_id= '".$this->input->post('suit_file_id')."' AND j0.change_type=1 ORDER BY j0.id DESC LIMIT 1";   
            $existing_data=$this->db->query($str)->row();
            if (!empty($existing_data)) {
                if ($existing_data->sts!=51 && $existing_data->sts!=91) {
                    return 'exist';
                }
            }
            //For New Court Change
            $data['e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['e_dt'] = date('Y-m-d H:i:s');
            $this->db->insert('legal_affairs_case_sts', $data);
            $insert_idss = $this->db->insert_id();
            $this->Common_model->add_expense($insert_idss,'legal affair',$prev_lawyer_name);
            $data2 = $this->user_model->user_activities(39,'legal_affair',$insert_idss,'legal_affairs_case_sts','Add Case Status & Expense Request('.$insert_idss.')');
        }
        else //For Update 
        {
            $edit_id = $this->input->post('edit_id');
            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $edit_id);
            $this->db->update('legal_affairs_case_sts', $data);
            $insert_idss = $edit_id;
            $this->Common_model->edit_expense($insert_idss,'legal affair',$prev_lawyer_name);
            $data2 = $this->user_model->user_activities(35,'legal_affair',$insert_idss,'legal_affairs_case_sts','Update Case Status & Expense Request('.$insert_idss.')');
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
    function get_expense_data($id)
    {
        if($id!=''){
            $str=" SELECT j0.*
            FROM expenses as j0
            WHERE j0.sts=1 AND j0.event_id= ".$this->db->escape($id)." AND j0.module_name='legal affair' ORDER BY id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function delete_action_case_sts($id=NULL,$bulk=NULL,$type=NULL)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($this->input->post('type')=='delete'){
            $pre_action_result=$this->Common_model->get_pre_action_data('legal_affairs_case_sts',$_POST['deleteEventId'],'0','sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('sts' => 0,'d_reason'=>$this->input->post('comments'),'d_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('legal_affairs_case_sts', $data);
                $data2 = $this->user_model->user_activities(67,'legal_affair',$this->input->post('deleteEventId'),'legal_affairs_case_sts','Case Status Delete('.$this->input->post('deleteEventId').')',$_POST['comments']);
            }
            
        }
        if($this->input->post('type')=='sendtochecker'){
            $pre_action_result=$this->Common_model->get_pre_action_data('legal_affairs_case_sts',$_POST['deleteEventId'],'37','sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data2 = array('sts' => 37,'stc_by'=> $this->session->userdata['ast_user']['user_id'],'stc_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('legal_affairs_case_sts', $data2);
                $data3 = $this->user_model->user_activities(37,'legal_affair',$this->input->post('deleteEventId'),'legal_affairs_case_sts','Case Status Send To Checker('.$this->input->post('deleteEventId').')');
            }
            
        }
        if($this->input->post('type')=='updatenextdate'){
            $data['module_name'] = 'legal_affairs';
            $data['status_id'] = $_POST['deleteEventId'];
            $data['new_sts'] = $_POST['next_date_sts_grid'];
            $data['new_date'] = implode('-',array_reverse(explode('/',$this->input->post('new_next_date'))));
            $data['update_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['update_date'] = date('Y-m-d H:i:s');
            $this->db->insert('next_date_update_history', $data);
            
            $data2 = array('next_dt_sts'=>1,'next_date_purpose'=>$_POST['next_date_sts_grid'],'next_case_dt'=> implode('-',array_reverse(explode('/',$this->input->post('new_next_date')))));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('legal_affairs_case_sts', $data2);
            //Update Case Status
            $str="SELECT  j0.remarks,j0.next_date_purpose,j0.next_dt_sts,j0.e_by,j0.case_dt,j0.next_case_dt,j0.final_remarks,j0.case_sts,j0.file_id,j0.new_lawyer_name,j0.new_plaintiff,j0.new_court,j0.new_district
                     FROM legal_affairs_case_sts j0
                 WHERE j0.sts != '0'  AND j0.id= '".$this->input->post('deleteEventId')."'";   
            $case_sts_data=$this->db->query($str)->row();
            $data4=array();
            $data4['next_dt_sts'] = $case_sts_data->next_dt_sts;
            $data4['case_sts_next_dt'] = $case_sts_data->next_date_purpose;
            $data4['next_date'] = $case_sts_data->next_case_dt;
            $this->db->where('id', $case_sts_data->file_id);
            $this->db->update('legal_affairs', $data4);
            $data3 = $this->user_model->user_activities(92,'legal_affair',$this->input->post('deleteEventId'),'legal_affairs_case_sts','Update Next Date('.$this->input->post('deleteEventId').')');
            
        }
        if($this->input->post('type')=='return_approval'){
            $pre_action_result=$this->Common_model->get_pre_action_data('legal_affairs_case_sts',$_POST['deleteEventId'],'91,90,51','sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data2 = array('sts' => 90,'r_reason' => $_POST['return_reason'],'r_by'=> $this->session->userdata['ast_user']['user_id'],'r_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('legal_affairs_case_sts', $data2);
                $data3 = $this->user_model->user_activities(90,'legal_affair',$this->input->post('deleteEventId'),'legal_affairs_case_sts','Case Status Return('.$this->input->post('deleteEventId').')',$_POST['return_reason']);
            }
            
        }
        if($this->input->post('type')=='reject_approval'){
            $pre_action_result=$this->Common_model->get_pre_action_data('legal_affairs_case_sts',$_POST['deleteEventId'],'91,90,51','sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data2 = array('sts' => 91,'reject_reason' => $_POST['return_reason'],'reject_by'=> $this->session->userdata['ast_user']['user_id'],'reject_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('legal_affairs_case_sts', $data2);
                $data3 = $this->user_model->user_activities(91,'legal_affair',$this->input->post('deleteEventId'),'legal_affairs_case_sts','Case Status Reject('.$this->input->post('deleteEventId').')',$_POST['return_reason']);
            }
            
        }
        if($this->input->post('type')=='verify'){
            $pre_action_result=$this->Common_model->get_pre_action_data('legal_affairs_case_sts',$_POST['deleteEventId'],'91,90,51','sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data2 = array('sts' => 51,'v_by'=> $this->session->userdata['ast_user']['user_id'],'v_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('legal_affairs_case_sts', $data2);
                //Update Case Status
                $str="SELECT  j0.remarks,j0.next_dt_sts,j0.next_date_purpose,j0.e_by,j0.case_dt,j0.e_dt,j0.next_case_dt,j0.final_remarks,j0.case_sts,j0.file_id,j0.new_lawyer_name,j0.new_plaintiff,j0.new_court,j0.new_district
                         FROM legal_affairs_case_sts j0
                     WHERE j0.sts != '0'  AND j0.id= '".$this->input->post('deleteEventId')."'";   
                $case_sts_data=$this->db->query($str)->row();

                $str2="SELECT  j0.*
                         FROM legal_affairs j0
                     WHERE j0.sts != '0'  AND j0.id= '".$case_sts_data->file_id."'";   
                $suit_data=$this->db->query($str2)->row();
                $loan_ac = $suit_data->loan_ac;
                $org_loan_ac = $suit_data->org_loan_ac;
                $ac_name = $suit_data->ac_name;
                $req_type = $suit_data->req_type;
                $loan_segment = $suit_data->loan_segment;
                $region = $suit_data->region;
                $territory = $suit_data->territory;
                $district = $suit_data->district;
                $proposed_type = $suit_data->proposed_type;
                $case_number = $suit_data->case_number;
                $prev_remarks = $suit_data->remarks_next_date;
                $data2 = array();
                if($case_sts_data->new_lawyer_name!='' && $case_sts_data->new_lawyer_name!=NULL && $case_sts_data->new_lawyer_name!=0)
                {
                    $data2['prest_lawyer_name'] = $case_sts_data->new_lawyer_name;
                    $data2['prev_lawyer_name'] = $suit_data->prest_lawyer_name;
                    $str="SELECT  j0.id
                         FROM legal_affairs_case_sts j0
                     WHERE j0.sts != '0' AND j0.sts=51 AND (j0.new_lawyer_name IS NOT NULL AND j0.new_lawyer_name!='0')  AND j0.file_id= '".$suit_data->id."' ORDER BY j0.id DESC LIMIT 1";   
                    $pre_changed_data=$this->db->query($str)->row();
                    if(!empty($pre_changed_data))
                    {
                        $new_data = array('suit_alocated_date_lawyer'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $pre_changed_data->id);
                        $this->db->update('legal_affairs_case_sts', $new_data);
                    }
                }
                if($case_sts_data->new_plaintiff!='' && $case_sts_data->new_plaintiff!=NULL && $case_sts_data->new_plaintiff!=0)
                {
                    $data2['prev_plaintiff'] = $suit_data->present_plaintiff;
                    $data2['present_plaintiff'] = $suit_data->case_deal_officer;
                    $data2['case_deal_officer'] = $case_sts_data->new_plaintiff;

                    $str="SELECT  j0.id
                         FROM legal_affairs_case_sts j0
                     WHERE j0.sts != '0' AND j0.sts=51 AND (j0.new_plaintiff IS NOT NULL AND j0.new_plaintiff!='0')  AND j0.file_id= '".$suit_data->id."' ORDER BY j0.id DESC LIMIT 1";   
                    $pre_changed_data=$this->db->query($str)->row();
                    if(!empty($pre_changed_data))
                    {
                        $new_data = array('suit_alocated_date_plaintiff'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $pre_changed_data->id);
                        $this->db->update('legal_affairs_case_sts', $new_data);
                    }
                }
                if($case_sts_data->new_court!='' && $case_sts_data->new_court!=NULL && $case_sts_data->new_court!=0)
                {
                    $data2['prest_court_name'] = $case_sts_data->new_court;
                    $data2['prev_court_name'] = $suit_data->prest_court_name;

                    $str="SELECT  j0.id
                         FROM legal_affairs_case_sts j0
                     WHERE j0.sts != '0' AND j0.sts=51 AND (j0.new_court IS NOT NULL AND j0.new_court!='0')  AND j0.file_id= '".$suit_data->id."' ORDER BY j0.id DESC LIMIT 1";   
                    $pre_changed_data=$this->db->query($str)->row();
                    if(!empty($pre_changed_data))
                    {
                        $new_data = array('suit_alocated_date_court'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $pre_changed_data->id);
                        $this->db->update('legal_affairs_case_sts', $new_data);
                    }
                }
                if($case_sts_data->new_district!='' && $case_sts_data->new_district!=NULL && $case_sts_data->new_district!=0)
                {
                    $data2['district'] = $case_sts_data->new_district;

                    $str="SELECT  j0.id
                         FROM legal_affairs_case_sts j0
                     WHERE j0.sts != '0' AND j0.sts=51 AND (j0.new_district IS NOT NULL AND j0.new_district!='0')  AND j0.file_id= '".$suit_data->id."' ORDER BY j0.id DESC LIMIT 1";   
                    $pre_changed_data=$this->db->query($str)->row();
                    if(!empty($pre_changed_data))
                    {
                        $new_data = array('suit_alocated_date_district'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $pre_changed_data->id);
                        $this->db->update('legal_affairs_case_sts', $new_data);
                    }
                }
                //For Update suitfile info
                
                //$data2['prev_date'] = $suit_data->filling_date;
                $data2['remarks_next_date'] = $case_sts_data->remarks;
                $data2['remarks_prev_date'] = $prev_remarks;
                $data2['case_sts_next_dt'] = $case_sts_data->next_date_purpose;
                $data2['next_date'] = $case_sts_data->next_case_dt;
                $data2['next_dt_sts'] = $case_sts_data->next_dt_sts;
                $data2['case_sts_prev_dt'] = $case_sts_data->case_sts;
                $data2['final_remarks'] = $case_sts_data->final_remarks;
                $data2['prev_date'] = $case_sts_data->case_dt;
                $data2['last_case_sts_update_dt'] = $case_sts_data->e_dt;
                $data2['last_case_sts_id'] = $_POST['deleteEventId'];
                if($case_sts_data->final_remarks==2) //When case withdrawn
                {
                    $data2['suit_sts'] = 76;
                    $data2['ac_close_by'] = $case_sts_data->e_by;
                    $data2['ac_close_dt'] = date('Y-m-d H:i:s');
                }
                else
                {
                    $data2['suit_sts'] = 51;
                    $data2['ac_close_by'] = "";
                    $data2['ac_close_dt'] = "";
                }
                $this->db->where('id', $case_sts_data->file_id);
                $this->db->update('legal_affairs', $data2);
                // echo $this->db->last_query();
                // exit;
                //Genereate Expenses
                $str="SELECT  j0.*,c.file_id
                         FROM expenses j0
                         LEFT OUTER JOIN legal_affairs_case_sts as c on (j0.event_id=c.id)
                     WHERE j0.sts != '0'  AND j0.event_id= '".$this->input->post('deleteEventId')."' AND j0.module_name='legal affair'";   
                $expense_data=$this->db->query($str)->result();
                if (!empty($expense_data)) {
                        $txrn_dt='';
                        $orginal_vendor_id = '';
                        $pre_case_act = 0;
                        foreach ($expense_data as $key) {
                            //Duplicate bill with proxy check
                            if($key->proxy_sts==1)
                            {
                                $txrn_dt=$key->activities_date;
                                $orginal_vendor_id = $key->proxy_against;
                            }
                            if($orginal_vendor_id==$key->vendor_id && $txrn_dt==$key->activities_date)
                            {
                                $duplicate_bill_with_proxy = 1;
                            }
                            else
                            {
                                $duplicate_bill_with_proxy = 0;
                            }
                            $cost_data = array(
                            'module_name' => 'legal_affair',
                            'main_table_name' => 'legal_affairs',
                            'main_table_id' => $key->file_id,
                            'sub_table_name' => 'expenses',
                            'sub_table_id' => $key->id,
                            'suit_id' => $key->file_id,
                            'activities_id' => $key->activities_name,
                            'vendor_type' => $key->expense_type,
                            'vendor_id' => $key->vendor_id,
                            'proxy_sts' => $key->proxy_sts,
                            'proxy_against' => $key->proxy_against,
                            'duplicate_bill_with_proxy' => $duplicate_bill_with_proxy,
                            'vendor_name' => $key->vendor_name,
                            'amount' =>$key->amount,
                            'txrn_dt' => $key->activities_date,
                            'loan_ac' =>$loan_ac,
                            'org_loan_ac' =>$org_loan_ac,
                            'ac_name' =>$ac_name,
                            'req_type' =>$req_type,
                            'proposed_type' =>$proposed_type,
                            'loan_segment' =>$loan_segment,
                            'case_number' =>$case_number,
                            'region' =>$region,
                            'territory' =>$territory,
                            'district' =>$district,
                            'expense_remarks' =>$key->remarks
                        );
                        $data3=$this->user_model->cost_details($cost_data);
                        $pre_case_act = $key->activities_name;
                    }
                    //Verify Expenses
                    $expense_data = array('v_sts' => 38);
                     $this->db->where('event_id',$_POST['deleteEventId']);
                     $this->db->where('module_name',"legal affair");
                     $this->db->update('expenses', $expense_data);

                    if($pre_case_act!=0)//For suit file last activities update
                    {
                        $suit_data = array('act_prev_date' => $pre_case_act);
                        $this->db->where('id', $case_sts_data->file_id);
                        $this->db->update('legal_affairs', $suit_data);
                    }
                }
                $data3 = $this->user_model->user_activities(51,'legal_affair',$this->input->post('deleteEventId'),'legal_affairs_case_sts','Case Status Verify('.$this->input->post('deleteEventId').')');
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
    function get_details_case_sts($id)
    {
        $this->db
            ->select('b.*,s.case_number,s.req_type,s.loan_ac,s.ac_name,j8.name as case_sts,j9.name as next_date_purpose,
                DATE_FORMAT(b.case_dt,"%d-%b-%y") AS case_dt,j10.name as prev_case_sts,
                IF(b.next_dt_sts=1,DATE_FORMAT(b.next_case_dt,"%d-%b-%y"),b.next_case_dt) AS next_case_dt,
                j11.name as new_lawyer_name,j12.name as new_court_name,j13.name as new_district_name,
                CONCAT(j14.name," (",j14.pin,")")as new_plaintiff_name,
                DATE_FORMAT(b.e_dt,"%d-%b-%y") AS e_dt,DATE_FORMAT(b.u_dt,"%d-%b-%y") AS u_dt,
                CONCAT(j6.name," (",j6.pin,")")as e_by,s.id as suit_file_id,
                CONCAT(j7.name," (",j7.pin,")")as u_by', FALSE)
            ->from("legal_affairs_case_sts b")
            ->join('legal_affairs as s', 'b.file_id=s.id', 'left')
            ->join('users_info as j6', 'b.e_by=j6.id', 'left')
            ->join('users_info as j7', 'b.u_by=j7.id', 'left')
            ->join('ref_case_sts as j8', 'b.case_sts=j8.id', 'left')
            ->join('ref_case_sts as j9', 'b.next_date_purpose=j9.id', 'left')
            ->join('ref_case_sts as j10', 'b.prev_item=j10.id', 'left')
            ->join('ref_lawyer as j11', 'b.new_lawyer_name=j11.id', 'left')
            ->join('ref_court as j12', 'b.new_court=j12.id', 'left')
            ->join('ref_legal_district as j13', 'b.new_district=j13.id', 'left')
            ->join('users_info as j14', 'b.new_plaintiff=j14.id', 'left')
            ->where("b.sts!=0 and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_expense_details($id,$req_type)
    {
        $join = "";
        $join = "LEFT OUTER JOIN ref_schedule_charges_legal_affairs as a on (j0.activities_name=a.id)";
            $select = "a.name,";
        if($id!=''){
            $str=" SELECT j0.amount,j0.proxy_sts,j0.proxy_against,j0.expense_type,j0.remarks,IF(j0.expense_type=1 or j0.expense_type=4,l.name,IF(expense_type=2,v.name,IF((j0.expense_type=3 or j0.expense_type=5),CONCAT(u.name,' (',u.pin,')'),j0.vendor_name))) as vendor_name,
            e.name as expense_type_name,DATE_FORMAT(j0.activities_date,'%d-%b-%y') AS activities_date,
            IF(j0.expense_type=1,".$select."IF(j0.expense_type=2,p.name,IF(j0.expense_type=3,s.name,IF(j0.expense_type=4,c.name,IF(j0.expense_type=5,en.name,ot.name))))) as activities_name
            FROM expenses as j0
            LEFT OUTER JOIN ref_expense_type as e on (j0.expense_type=e.id)
            LEFT OUTER JOIN ref_lawyer as l on (j0.vendor_id=l.id and (j0.expense_type=1 or j0.expense_type=4))
            LEFT OUTER JOIN ref_paper_vendor as v on (j0.vendor_id=v.id and j0.expense_type=2)
            LEFT OUTER JOIN users_info as u on (j0.vendor_id=u.id and (j0.expense_type=3 or j0.expense_type=5))
            LEFT OUTER JOIN ref_paper_bill_activities as p on (j0.activities_name=p.id and j0.expense_type=2)
            LEFT OUTER JOIN ref_staff_conv_activities as s on (j0.activities_name=s.id and j0.expense_type=3)
            LEFT OUTER JOIN ref_court_fee_activities as c on (j0.activities_name=c.id and j0.expense_type=4)
            LEFT OUTER JOIN ref_court_entertainment_activities as en on (j0.activities_name=en.id and j0.expense_type=5)
            LEFT OUTER JOIN ref_others_cost_activities as ot on (j0.activities_name=ot.id and j0.expense_type=6)
            $join
            WHERE j0.sts=1 AND j0.event_id= ".$this->db->escape($id)." AND j0.module_name='legal affair' ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_bulk_data()
    {
        $where2 = "b.sts!='0' AND b.change_type=1";
        $where2.=" AND b.sts = '37'";
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_from')!=0 && ($this->input->post('req_dt_to') == '' || $this->input->post('req_dt_to')==0)) 
        {$where2.=" AND DATE(b.e_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
        if($this->input->post('req_dt_from') != '' && $this->input->post('rec_dt_from')!=0 && $this->input->post('req_dt_to') != '' && $this->input->post('req_dt_to')!=0) 
        {$where2.=" AND DATE(b.e_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(b.e_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}

        $this->db
        ->select('b.*,s.case_number,s.loan_ac,s.ac_name,j8.name as case_sts,
                DATE_FORMAT(b.case_dt,"%d-%b-%y") AS case_dt,j10.name as prev_case_sts,
                DATE_FORMAT(b.next_case_dt,"%d-%b-%y") AS next_case_dt,
                DATE_FORMAT(b.e_dt,"%d-%b-%y") AS e_dt,DATE_FORMAT(b.u_dt,"%d-%b-%y") AS u_dt,
                CONCAT(j6.name," (",j6.user_id,")")as e_by,
                CONCAT(j7.name," (",j7.user_id,")")as u_by', FALSE)
            ->from("legal_affairs_case_sts b")
            ->join('legal_affairs as s', 'b.file_id=s.id', 'left')
            ->join('users_info as j6', 'b.e_by=j6.id', 'left')
            ->join('users_info as j7', 'b.u_by=j7.id', 'left')
            ->join('ref_case_sts as j8', 'b.case_sts=j8.id', 'left')
            ->join('ref_case_sts as j10', 'b.prev_item=j10.id', 'left')
            ->where($where2)
            ->order_by('b.id','DESC');
        $q=$this->db->get();
        return $q->result();
    }
    function bulk_acktion()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = true; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($this->input->post('operation')=='approve'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('legal_affairs_case_sts',$_POST['id_'.$i],'51','sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $data2 = array('sts' => 51,'v_by'=> $this->session->userdata['ast_user']['user_id'],'v_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('legal_affairs_case_sts', $data2);
                        //Update Case Status
                        $str="SELECT  j0.remarks,j0.next_case_dt,j0.next_dt_sts,j0.next_date_purpose,j0.e_by,j0.case_dt,j0.e_dt,j0.next_case_dt,j0.final_remarks,j0.case_sts,j0.file_id,j0.new_lawyer_name,j0.new_plaintiff,j0.new_court,j0.new_district
                                 FROM legal_affairs_case_sts j0
                             WHERE j0.sts != '0'  AND j0.id= '".$_POST['id_'.$i]."'";   
                        $case_sts_data=$this->db->query($str)->row();
                        $str2="SELECT  j0.*
                                 FROM legal_affairs j0
                             WHERE j0.sts != '0'  AND j0.id= '".$case_sts_data->file_id."'";   
                        $suit_data=$this->db->query($str2)->row();
                        $loan_ac = $suit_data->loan_ac;
                        $org_loan_ac = $suit_data->org_loan_ac;
                        $ac_name = $suit_data->ac_name;
                        $req_type = $suit_data->req_type;
                        $loan_segment = $suit_data->loan_segment;
                        $region = $suit_data->region;
                        $territory = $suit_data->territory;
                        $district = $suit_data->district;
                        $proposed_type = $suit_data->proposed_type;
                        $case_number = $suit_data->case_number;
                        $prev_remarks = $suit_data->remarks_next_date;
                        $data2 = array();
                        if($case_sts_data->new_lawyer_name!='' && $case_sts_data->new_lawyer_name!=NULL && $case_sts_data->new_lawyer_name!=0)
                        {
                            $data2['prest_lawyer_name'] = $case_sts_data->new_lawyer_name;
                            $data2['prev_lawyer_name'] = $suit_data->prest_lawyer_name;
                            $str="SELECT  j0.id
                                 FROM legal_affairs_case_sts j0
                             WHERE j0.sts != '0' AND j0.sts=51 AND (j0.new_lawyer_name IS NOT NULL AND j0.new_lawyer_name!='0')  AND j0.file_id= '".$suit_data->id."' ORDER BY j0.id DESC LIMIT 1";   
                            $pre_changed_data=$this->db->query($str)->row();
                            if(!empty($pre_changed_data))
                            {
                                $new_data = array('suit_alocated_date_lawyer'=>date('Y-m-d H:i:s'));
                                $this->db->where('id', $pre_changed_data->id);
                                $this->db->update('legal_affairs_case_sts', $new_data);
                            }
                        }
                        if($case_sts_data->new_plaintiff!='' && $case_sts_data->new_plaintiff!=NULL && $case_sts_data->new_plaintiff!=0)
                        {
                            $data2['prev_plaintiff'] = $suit_data->present_plaintiff;
                            $data2['present_plaintiff'] = $suit_data->case_deal_officer;
                            $data2['case_deal_officer'] = $case_sts_data->new_plaintiff;

                            $str="SELECT  j0.id
                                 FROM legal_affairs_case_sts j0
                             WHERE j0.sts != '0' AND j0.sts=51 AND (j0.new_plaintiff IS NOT NULL AND j0.new_plaintiff!='0')  AND j0.file_id= '".$suit_data->id."' ORDER BY j0.id DESC LIMIT 1";   
                            $pre_changed_data=$this->db->query($str)->row();
                            if(!empty($pre_changed_data))
                            {
                                $new_data = array('suit_alocated_date_plaintiff'=>date('Y-m-d H:i:s'));
                                $this->db->where('id', $pre_changed_data->id);
                                $this->db->update('legal_affairs_case_sts', $new_data);
                            }
                        }
                        if($case_sts_data->new_court!='' && $case_sts_data->new_court!=NULL && $case_sts_data->new_court!=0)
                        {
                            $data2['prest_court_name'] = $case_sts_data->new_court;
                            $data2['prev_court_name'] = $suit_data->prest_court_name;

                            $str="SELECT  j0.id
                                 FROM legal_affairs_case_sts j0
                             WHERE j0.sts != '0' AND j0.sts=51 AND (j0.new_court IS NOT NULL AND j0.new_court!='0')  AND j0.file_id= '".$suit_data->id."' ORDER BY j0.id DESC LIMIT 1";   
                            $pre_changed_data=$this->db->query($str)->row();
                            if(!empty($pre_changed_data))
                            {
                                $new_data = array('suit_alocated_date_court'=>date('Y-m-d H:i:s'));
                                $this->db->where('id', $pre_changed_data->id);
                                $this->db->update('legal_affairs_case_sts', $new_data);
                            }
                        }
                        if($case_sts_data->new_district!='' && $case_sts_data->new_district!=NULL && $case_sts_data->new_district!=0)
                        {
                            $data2['district'] = $case_sts_data->new_district;

                            $str="SELECT  j0.id
                                 FROM legal_affairs_case_sts j0
                             WHERE j0.sts != '0' AND j0.sts=51 AND (j0.new_district IS NOT NULL AND j0.new_district!='0')  AND j0.file_id= '".$suit_data->id."' ORDER BY j0.id DESC LIMIT 1";   
                            $pre_changed_data=$this->db->query($str)->row();
                            if(!empty($pre_changed_data))
                            {
                                $new_data = array('suit_alocated_date_district'=>date('Y-m-d H:i:s'));
                                $this->db->where('id', $pre_changed_data->id);
                                $this->db->update('legal_affairs_case_sts', $new_data);
                            }
                        }
                        //For Update suitfile info
                        
                        //$data2['prev_date'] = $suit_data->filling_date;
                        $data2['remarks_next_date'] = $case_sts_data->remarks;
                        $data2['remarks_prev_date'] = $prev_remarks;
                        $data2['case_sts_next_dt'] = $case_sts_data->next_date_purpose;
                        $data2['next_date'] = $case_sts_data->next_case_dt;
                        $data2['next_dt_sts'] = $case_sts_data->next_dt_sts;
                        $data2['case_sts_prev_dt'] = $case_sts_data->case_sts;
                        $data2['final_remarks'] = $case_sts_data->final_remarks;
                        $data2['prev_date'] = $case_sts_data->case_dt;
                        $data2['last_case_sts_update_dt'] = $case_sts_data->e_dt;
                        $data2['last_case_sts_id'] = $_POST['id_'.$i];
                        if($case_sts_data->final_remarks==2) //When case withdrawn
                        {
                            $data2['suit_sts'] = 76;
                            $data2['ac_close_by'] = $case_sts_data->e_by;
                            $data2['ac_close_dt'] = date('Y-m-d H:i:s');
                        }
                        $this->db->where('id', $case_sts_data->file_id);
                        $this->db->update('legal_affairs', $data2);
                        //Genereate Expenses
                        $str="SELECT  j0.*,c.file_id
                                 FROM expenses j0
                                 LEFT OUTER JOIN legal_affairs_case_sts as c on (j0.event_id=c.id)
                             WHERE j0.sts != '0'  AND j0.event_id= '".$this->input->post('id_'.$i)."' AND j0.module_name='legal affair'";   
                        $expense_data=$this->db->query($str)->result();
                        if (!empty($expense_data)) {
                                $txrn_dt='';
                                $orginal_vendor_id = '';
                                $pre_case_act=0;
                                foreach ($expense_data as $key) {
                                    //Duplicate bill with proxy check
                                    if($key->proxy_sts==1)
                                    {
                                        $txrn_dt=$key->activities_date;
                                        $orginal_vendor_id = $key->proxy_against;
                                    }
                                    if($orginal_vendor_id==$key->vendor_id && $txrn_dt==$key->activities_date)
                                    {
                                        $duplicate_bill_with_proxy = 1;
                                    }
                                    else
                                    {
                                        $duplicate_bill_with_proxy = 0;
                                    }
                                    $cost_data = array(
                                    'module_name' => 'legal_affair',
                                    'main_table_name' => 'legal_affairs',
                                    'main_table_id' => $_POST['suit_file_id_'.$i],
                                    'sub_table_name' => 'expenses',
                                    'sub_table_id' => $key->id,
                                    'suit_id' => $_POST['suit_file_id_'.$i],
                                    'vendor_type' => $key->expense_type,
                                    'vendor_id' => $key->vendor_id,
                                    'proxy_sts' => $key->proxy_sts,
                                    'proxy_against' => $key->proxy_against,
                                    'duplicate_bill_with_proxy' => $duplicate_bill_with_proxy,
                                    'vendor_name' => $key->vendor_name,
                                    'amount' =>$key->amount,
                                    'txrn_dt' => $key->activities_date,
                                    'loan_ac' =>$loan_ac,
                                    'org_loan_ac' =>$org_loan_ac,
                                    'ac_name' =>$ac_name,
                                    'req_type' =>$req_type,
                                    'proposed_type' =>$proposed_type,
                                    'loan_segment' =>$loan_segment,
                                    'case_number' =>$case_number,
                                    'region' =>$region,
                                    'territory' =>$territory,
                                    'district' =>$district,
                                    'expense_remarks' =>$key->remarks
                                );
                                $data3=$this->user_model->cost_details($cost_data);
                                $pre_case_act=$key->activities_name;
                            }
                            if($pre_case_act!=0)//For suit file last activities update
                            {
                                $suit_data = array('act_prev_date' => $pre_case_act);
                                $this->db->where('id', $case_sts_data->file_id);
                                $this->db->update('legal_affairs', $suit_data);
                            }
                        }
                        $data3 = $this->user_model->user_activities(51,'legal_affair',$this->input->post('id_'.$i),'legal_affairs_case_sts','Case Status Verify('.$this->input->post('id_'.$i).')');
                    }
                }
                
                
            }
        }
        if($this->input->post('operation')=='return'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('legal_affairs_case_sts',$_POST['id_'.$i],'90','sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $data2 = array('sts' => 90,'r_reason' => $_POST['return_reason'],'r_by'=> $this->session->userdata['ast_user']['user_id'],'r_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('legal_affairs_case_sts', $data2);
                        $data3 = $this->user_model->user_activities(90,'legal_affair',$this->input->post('id_'.$i),'legal_affairs_case_sts','Case Status Return('.$this->input->post('id_'.$i).')',$_POST['return_reason']);
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

}
?>
