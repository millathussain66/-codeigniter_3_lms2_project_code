<?php
class Legal_file_process_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
    }



    function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        $i=0;
        $where2 = "b.sts!='0' and b.life_cycle IN(4)";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('1'))
        {
            array_push($condition_array,"b.legal_region IN(".$this->session->userdata['ast_user']['legal_region'].")");
           
        }
        if (check_group('2'))
        {
            array_push($condition_array,"b.legal_user='".$this->session->userdata['ast_user']['user_id']."'");
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
        
        if ($sortorder == '')
        {
            $sortdatafield="b.id";
            $sortorder = "DESC";                
        }
        //AS PER prince bhai mail request ln exipiry date reached or not user can continiue next process(SF) thats why ln_exp_sts will always return 1 if not null
    //IF(b.ln_val_dt IS NULL,"0",IF(b.ln_val_dt<="' . date("Y-m-d") . '","1","0")) as ln_exp_sts,
    $this->db
    ->select('SQL_CALC_FOUND_ROWS b.*,A.total_auth,IF(b.cma_sts="60" OR b.cma_sts="104",CONCAT(j6.name," ",j12.name," (",j12.pin,")"),j6.name) as status,j7.name as region_name,j8.name as territory_name,
        j9.name as district_name,s.name as loan_segment,j10.name as unit_office_name,
        j1.name as request_type_name,
        CONCAT(j2.name," (",j2.user_id,")")as e_by,
        IF(b.ln_val_dt IS NULL,"0",IF(b.ln_val_dt<="' . date("Y-m-d") . '","1","1")) as ln_exp_sts,
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
            ->join('ref_legal_region as j7', 'b.legal_region=j7.id', 'left')
            ->join('ref_territory as j8', 'b.territory=j8.id', 'left')
            ->join('ref_legal_district as j9', 'b.case_fill_dist=j9.id', 'left')
            ->join('ref_unit_office as j10', 'b.unit_office=j10.id', 'left')
            ->join('users_info as j12', 'b.legal_user=j12.id', 'left')
            ->join('users_info as j13', 'b.sth_by=j13.id', 'left')
            ->join('users_info as j14', 'b.v_by=j14.id', 'left')
            ->join('ref_loan_segment as s', 'b.loan_segment=s.code', 'left')
            ->join('(SELECT a.event_id,COUNT(a.id) AS total_auth FROM authorization AS a WHERE (a.authorization_type=8 OR a.authorization_type=1) AND a.event_name="cma" AND a.sts=1 AND a.auth_sts=67 GROUP BY a.event_id) A', 'b.id=A.event_id', 'left')
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
    function get_suit_file_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        $i=0;
        $where2 = "b.sts!='0' AND (b.re_case_sts=0 OR b.re_case_sts IS NULL)";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('2')) //For Legal Maker
        {
            array_push($condition_array,"(b.case_deal_officer='".$this->session->userdata['ast_user']['user_id']."' OR b.e_by='".$this->session->userdata['ast_user']['user_id']."')");
        }
        if (check_group('1')) //For Legal Checker
        {
            array_push($condition_array,"b.legal_region IN(".$this->session->userdata['ast_user']['legal_region'].")");
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
                $where2.= " AND b.org_loan_ac = '".$this->Common_model->stringEncryption('encrypt',$this->input->get('hidden_loan_ac'))."'";
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
                else if($filterdatafield=='loan_segment')
                {
                    $filterdatafield='s.name';
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
            $sortdatafield="b.id";
            $sortorder = "DESC";                
        }
    $this->db
    ->select('SQL_CALC_FOUND_ROWS b.*,b.e_by as e_by_id,j6.name as status,j7.name as region_name,j8.name as territory_name,
        j9.name as district_name,s.name as loan_segment,
        j1.name as request_type_name,
        CONCAT(j2.name," (",j2.user_id,")")as e_by,
        DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt
        ', FALSE)
            ->from("suit_filling_info b")
            ->join('ref_req_type as j1', 'b.req_type=j1.id', 'left')
            ->join('users_info as j2', 'b.e_by=j2.id', 'left')
            ->join('ref_status as j6', 'b.suit_sts=j6.id', 'left')
            ->join('ref_region as j7', 'b.region=j7.id', 'left')
            ->join('ref_territory as j8', 'b.territory=j8.id', 'left')
            ->join('ref_legal_district as j9', 'b.district=j9.id', 'left')
            ->join('users_info as j12', 'b.legal_user=j12.id', 'left')
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
    function get_recase_file_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        $i=0;
        $where2 = "b.sts!='0' AND b.re_case_sts=1";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('2')) //For Legal Maker
        {
            array_push($condition_array,"(b.case_deal_officer='".$this->session->userdata['ast_user']['user_id']."' OR b.e_by='".$this->session->userdata['ast_user']['user_id']."')");
        }
        if (check_group('1')) //For Legal Checker
        {
            array_push($condition_array,"b.legal_region IN(".$this->session->userdata['ast_user']['legal_region'].")");
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
                $where2.= " AND b.org_loan_ac = '".$this->Common_model->stringEncryption('encrypt',$this->input->get('hidden_loan_ac'))."'";
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
                else if($filterdatafield=='loan_segment')
                {
                    $filterdatafield='s.name';
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
        // $where_initi=''; 
        // if($where=='' || count($where)<=0){          
        //  $where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
        // }
        
        if ($sortorder == '')
        {
            $sortdatafield="b.id";
            $sortorder = "DESC";                
        }
    $this->db
    ->select('SQL_CALC_FOUND_ROWS b.*,b.e_by as e_by_id,j6.name as status,j7.name as region_name,j8.name as territory_name,
        j9.name as district_name,s.name as loan_segment,
        j1.name as request_type_name,
        CONCAT(j2.name," (",j2.user_id,")")as e_by,
        DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt
        ', FALSE)
            ->from("suit_filling_info b")
            ->join('ref_req_type as j1', 'b.req_type=j1.id', 'left')
            ->join('users_info as j2', 'b.e_by=j2.id', 'left')
            ->join('ref_status as j6', 'b.suit_sts=j6.id', 'left')
            ->join('ref_region as j7', 'b.region=j7.id', 'left')
            ->join('ref_territory as j8', 'b.territory=j8.id', 'left')
            ->join('ref_legal_district as j9', 'b.district=j9.id', 'left')
            ->join('users_info as j12', 'b.legal_user=j12.id', 'left')
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
    function get_file_name($field_name,$path)
    {
        //Deleteng old file when no new file selected
        if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='0') 
        {
            $delete_path = $path.$_POST['hidden_'.$field_name.'_value'];      
            //chmod($path, 0777);
            if (file_exists($delete_path)) {
                unlink($delete_path);  
            } 
            $file ="";
        }//Deleteng old file and new file selected
        else if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='1') 
        {
            $delete_path = $path.$_POST['hidden_'.$field_name.'_value'];      
            //chmod($path, 0777);
            if (file_exists($delete_path)) {
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
    function get_all_cases()
    {
        $str_where = "1";
        $limit="";



        if (isset($_POST['search_field_input'])) {
            if (trim($this->input->post('search_field_input')) != '') {

                $str_where .= " AND s.loan_ac LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.org_loan_ac LIKE'%" .$this->Common_model->stringEncryption('encrypt',$this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.cif LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.case_number LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.territory LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.case_claim_amount LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
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
            array_push($condition_array,"s.legal_region IN(".$this->session->userdata['ast_user']['legal_region'].")");
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
        if(isset($_POST['cif']))
        {
            if (trim($this->input->post('cif')) != '') {
                $str_where.= " AND s.cif=".$this->db->escape(trim($this->input->post('cif')));
            }
        }
        if(isset($_POST['region']))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND s.legal_region=".$this->db->escape(trim($this->input->post('region')));
            }
        }
        if(isset($_POST['territory']))
        {
            if (trim($this->input->post('territory')) != '') {
                $str_where.= " AND s.territory=".$this->db->escape(trim($this->input->post('territory')));
            }
        }
        if(isset($_POST['district']))
        {
            if (trim($this->input->post('district')) != '') {
                $str_where.= " AND s.district=".$this->db->escape(trim($this->input->post('district')));
            }
        }
        if(isset($_POST['unit_office']))
        {
            if (trim($this->input->post('unit_office')) != '') {
                $str_where.= " AND s.unit_office=".$this->db->escape(trim($this->input->post('unit_office')));
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
        if($this->input->post("next_date") != ''){$next_date= $this->input->post("next_date");} else{$next_date = '0';}
        if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
        else{$filling_dt_from='0';}
        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
        else{$filling_dt_to='0';}

        if( $filling_dt_from!='0' && $filling_dt_to=='0')
        { $str_where.= " and s.filling_date='".$filling_dt_from."'"; }

        if( $next_date!='0')
        { $str_where.= " and s.next_date='".$next_date."'"; }
        
        if( $filling_dt_from!='0' && $filling_dt_to!='0')
        { $str_where.= " and s.filling_date between '".$filling_dt_from."' and '".$filling_dt_to."'";}

    
        $str=" SELECT s.id,s.org_loan_ac,s.sts,s.prev_filling_date,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,DATE_FORMAT(s.last_date,'%d-%b-%y') AS last_date,last.name as last_step,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
        lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,IF(s.re_case_sts=1,co.total_cost,(IF(co.total_cost IS NOT NULL,co.total_cost,0)+IF(co3.total_cost IS NOT NULL,co3.total_cost,0)+IF(co2.total_cost IS NOT NULL,co2.total_cost,0))) as total_legal_cost,
        CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
        CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,cd.mobile_number as case_deal_officer_phone,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
            FROM suit_filling_info as s
            LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
            LEFT OUTER JOIN ref_case_sts last ON (last.id=s.last_step)
            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.legal_region)
            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
            LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
            LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
            LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
            LEFT OUTER JOIN(
                SELECT cost.case_number,cost.loan_ac,cost.district,cost.org_loan_ac,SUM(cost.amount) AS total_cost 
                FROM (
                    SELECT c1.case_number,c1.loan_ac,c1.district,c1.org_loan_ac,c1.legal_cost AS amount
                    FROM legal_cost c1
                    UNION ALL 
                    SELECT c.case_number,c.loan_ac,c.district,c.org_loan_ac,c.amount
                    FROM cost_details c
                    ) cost 
                GROUP BY cost.case_number,cost.district,cost.loan_ac,cost.org_loan_ac
            )co ON(co.case_number=s.case_number AND s.district=co.district AND s.loan_ac=co.loan_ac AND s.org_loan_ac=co.org_loan_ac)
            -- for legal notice bill
            LEFT OUTER JOIN( 
                SELECT cost.loan_ac,cost.req_type,cost.org_loan_ac,SUM(cost.amount) AS total_cost 
                FROM (
                    SELECT c.case_number,c.req_type,c.loan_ac,c.district,c.org_loan_ac,c.amount
                    FROM cost_details c
                    WHERE c.activities_id=1 AND c.vendor_type=1
                    ) cost 
                GROUP BY cost.loan_ac,cost.org_loan_ac,cost.req_type
            )co2 ON(s.loan_ac=co2.loan_ac AND s.org_loan_ac=co2.org_loan_ac AND s.req_type=co2.req_type)
            -- for Court Fee bill
            LEFT OUTER JOIN( 
                SELECT cost.loan_ac,cost.req_type,cost.org_loan_ac,SUM(cost.amount) AS total_cost 
                FROM (
                    SELECT c.case_number,c.req_type,c.loan_ac,c.district,c.org_loan_ac,c.amount
                    FROM cost_details c
                    WHERE c.activities_id=1 AND c.vendor_type=4 AND (c.case_number IS NULL OR c.case_number='')
                    ) cost 
                GROUP BY cost.loan_ac,cost.org_loan_ac,cost.req_type
            )co3 ON(s.loan_ac=co3.loan_ac AND s.org_loan_ac=co3.org_loan_ac AND s.req_type=co3.req_type)
            -- LEFT OUTER JOIN(
            --     SELECT f.cma_id,GROUP_CONCAT(IF(c.loan_ac<>f.ac_number,f.ac_number,NULL)  ORDER BY f.id ASC SEPARATOR ', ' ) AS other_ac
            --     FROM cma_facility f
            --     LEFT OUTER JOIN cma c ON(f.cma_id=c.id) 
            --     WHERE f.sts<>0 
            --     GROUP BY f.cma_id
            -- )oth_ac ON(c.id=oth_ac.cma_id)
            WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) AND (s.suit_sts=75 OR s.suit_sts=76 OR s.suit_sts=81)   ORDER BY s.id ASC $limit";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_lawyer_email_phone($id)
    {
        $this->db
            ->select("b.mobile,b.email,b.bank,b.ac_no,b.tin_number,b.bin_number", FALSE)
            ->from("ref_lawyer b")
            ->where("b.data_status='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
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
    function get_total_address($id)
    {
        $str="SELECT (sub.total_address1+sub.total_address2+sub.total_address3) AS total
            FROM (
            SELECT g.*,
            SUM(CASE WHEN (g.permanent_address IS NOT NULL AND g.permanent_address <> ' ') THEN 1 ELSE 0 END) AS total_address1, 
            SUM(CASE WHEN (g.present_address IS NOT NULL AND g.present_address <> ' ') THEN 1 ELSE 0 END) AS total_address2,
            SUM(CASE WHEN (g.business_address IS NOT NULL AND g.business_address <> ' ') THEN 1 ELSE 0 END) AS total_address3
            FROM cma_guarantor g WHERE g.cma_id='".$id."' AND g.sts<>0
            )sub";
        $query=$this->db->query($str);
        return $query->row();
        
    }
    function get_add_action_data_suit($id)
    {
        // type_of_case_name
        $this->db
            ->select("b.*,j0.name as type_of_case,j0.type_of_case as type_of_case_name,DATEDIFF(b.next_date,'".date('Y-m-d')."') as dif,IF(b.next_dt_sts=1,DATE_FORMAT(b.next_date,'%d/%m/%Y'),b.next_date) AS next_date,DATE_FORMAT(b.prev_date,'%d/%m/%Y') as prev_date
            ", FALSE)
            ->from("suit_filling_info b")
            ->join('ref_req_type as j0', 'b.req_type=j0.id', 'left')
            ->where("b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_add_action_data_recase($id)
    {
        $this->db
            ->select("b.*,j1.case_number as pre_case_number", FALSE)
            ->from("suit_filling_info b")
            ->join('suit_filling_info as j1', 'b.pre_suit_id=j1.id', 'left')
            ->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_suit_info($id)
    {
        $this->db
            ->select("b.*", FALSE)
            ->from("suit_filling_info b")
            ->where("b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_cma_info($id)
    {
        $this->db
            ->select("b.case_fill_dist,b.lawyer,b.outstanding_bl,b.rec_by,b.unit_office,b.legal_region,b.id,b.loan_ac,b.ac_name,b.org_loan_ac,b.st_belance,b.lawyer,b.total_final_ln,
                b.proposed_type,j0.name as type_of_case,j0.type_of_case as type_of_case_name,b.legal_user,b.req_type,b.loan_segment,b.region,b.territory,b.case_fill_dist as district", FALSE)
            ->from("cma b")
            ->join('ref_req_type as j0', 'b.req_type=j0.id', 'left')
            ->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_cma_info_edit($id)
    {
        $this->db
            ->select("b.more_acc_number,b.district as cma_district,b.customer_id,b.mobile_no,b.cif,b.branch_sol,b.outstanding_bl,b.rec_by,b.unit_office,b.legal_region,b.id,b.loan_ac,b.ac_name,b.org_loan_ac,b.st_belance,b.lawyer,b.total_final_ln,b.case_fill_dist,
                b.proposed_type,j0.name as type_of_case,b.legal_user,b.req_type,b.loan_segment,b.region,b.territory,b.case_fill_dist as district", FALSE)
            ->from("cma b")
            ->join('ref_req_type as j0', 'b.req_type=j0.id', 'left')
            ->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_all_expense_by_case($id,$req_type,$cma_id=NULL)
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
            WHERE (j0.suit_id= ".$id." OR (j0.main_table_id='".$cma_id."' AND j0.main_table_name='cma')) AND j0.module_name='suit_file' ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_case_details_info($id)
    {
        $this->db
            ->select('b.cma_id,b.arji_copy,b.remarks_prev_date,b.req_type,fc.name as final_case_sts,ns.name as next_date_case_sts,fr.name as final_remarks,b.id,c.brrower_name,g.present_address as current_address,b.loan_ac,b.ac_name,r.name as case_type,j0.name as case_name,
                DATE_FORMAT(b.filling_date,"%d-%b-%Y") AS filling_date,IF(b.next_dt_sts=1,DATE_FORMAT(b.next_date,"%d/%m/%Y"),b.next_date) AS next_date,
                b.case_number,DATE_FORMAT(b.ac_close_dt,"%d-%b-%y") as ac_close_dt,b.org_loan_ac,b.proposed_type,
                b.case_claim_amount,b.outstanding_bl,j4.name as filling_plaintiff,j4.pin as filling_plaintiff_pin,
                b.case_deal_officer as case_deal_officer_id,j6.name as case_deal_officer,j6.pin as case_deal_officer_pin,j6.mobile_number as case_deal_officer_phone,
                j8.name as lawyer_name,j9.name as prev_court_name,j10.name as prest_court_name,b.prest_court_name as present_court_id,
                DATE_FORMAT(b.prev_date,"%d-%b-%y") AS prev_date,j1.name as case_sts_prev_dt,IF(b.req_type=2,sca.name,scn.name) as act_prev_date,
                ram.name as recovery_am,u.name as unit_office_name,t.name as territory_name,d.name as district_name,
                lr.name as legal_region_name,ls.name as loan_segment', FALSE)
            ->from("suit_filling_info b")
            ->join('cma as c', 'b.cma_id=c.id', 'left')
            ->join('cma_guarantor as g', 'g.cma_id=c.id AND g.guarantor_type="M"', 'left')
            ->join('ref_case_name as j0', 'b.case_name=j0.id', 'left')
            ->join('ref_case_sts as j1', 'b.case_sts_prev_dt=j1.id', 'left')
            ->join('ref_case_sts as ns', 'b.case_sts_next_dt=ns.id', 'left')
            ->join('ref_schedule_charges_ni as scn', 'b.act_prev_date=scn.id AND b.req_type=1', 'left')
            ->join('ref_schedule_charges_ara as sca', 'b.act_prev_date=sca.id AND b.req_type=2', 'left')
            ->join('ref_case_sts as fc', 'b.case_sts_prev_dt=fc.id', 'left')
            ->join('users_info as j4', 'b.filling_plaintiff=j4.id', 'left')
            ->join('users_info as j6', 'b.case_deal_officer=j6.id', 'left')
            ->join('users_info as ram', 'b.recovery_am=ram.id', 'left')
            ->join('ref_req_type as r', 'b.req_type=r.id', 'left')
            ->join('ref_unit_office as u', 'b.unit_office=u.id', 'left')
            ->join('ref_territory as t', 'b.territory=t.id', 'left')
            ->join('ref_legal_district as d', 'b.district=d.id', 'left')
            ->join('ref_lawyer as j8', 'b.prest_lawyer_name=j8.id', 'left')
            ->join('ref_loan_segment as ls', 'b.loan_segment=ls.code', 'left')
            ->join('ref_legal_region as lr', 'b.legal_region=lr.id', 'left')
            ->join('ref_court as j9', 'b.prev_court_name=j9.id', 'left')
            ->join('ref_court as j10', 'b.prest_court_name=j10.id', 'left')
            ->join('ref_final_remarks as fr', 'fr.id=b.final_remarks', 'left')
            ->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_suit_file_details($id)
    {
        $this->db
            ->select('b.id,b.arji_copy,b.judge_name,b.both_case_sts,b.merge_case_sts,b.proposed_type,b.req_type,b.case_number,b.case_claim_amount,j0.name as case_name,b.case_deal_officer as case_deal_officer_id,
                    b.prest_lawyer_name as prest_lawyer_id,b.prest_court_name as prest_court_id,
                    DATE_FORMAT(b.prev_date,"%d-%b-%y") AS prev_date,j1.name as case_sts_prev_dt,
                    IF(b.req_type=2,sca.name,scn.name) as act_prev_date,IF(b.next_dt_sts=1,DATE_FORMAT(b.next_date,"%d-%b-%y"),b.next_date) AS next_date,
                    j3.name as case_sts_next_dt,b.remarks_next_date,CONCAT(j4.name," (",j4.user_id,")") as filling_plaintiff,
                    DATE_FORMAT(b.filling_date,"%d-%b-%y") AS filling_date,
                    CONCAT(j6.name," (",j6.user_id,")")as case_deal_officer,j7.name as prev_lawyer_name,
                    j8.name as prest_lawyer_name,j9.name as prev_court_name,j10.name as prest_court_name,
                    b.loan_ac,b.ac_name,CONCAT(j11.name," (",j11.user_id,")")as e_by,
                    DATE_FORMAT(b.e_dt,"%d-%b-%y") AS e_dt', FALSE)
            ->from("suit_filling_info b")
            ->join('ref_case_name as j0', 'b.case_name=j0.id', 'left')
            ->join('ref_case_sts as j1', 'b.case_sts_prev_dt=j1.id', 'left')
            ->join('ref_schedule_charges_ara as sca', 'b.act_prev_date=sca.id AND b.req_type=2', 'left')
            ->join('ref_schedule_charges_ni as scn', 'b.act_prev_date=scn.id AND b.req_type=1', 'left')
            ->join('ref_case_sts as j3', 'b.case_sts_next_dt=j3.id', 'left')
            ->join('users_info as j4', 'b.filling_plaintiff=j4.id', 'left')
            ->join('users_info as j6', 'b.case_deal_officer=j6.id', 'left')
            ->join('ref_lawyer as j7', 'b.prev_lawyer_name=j7.id', 'left')
            ->join('ref_lawyer as j8', 'b.prest_lawyer_name=j8.id', 'left')
            ->join('ref_court as j9', 'b.prev_court_name=j9.id', 'left')
            ->join('ref_court as j10', 'b.prest_court_name=j10.id', 'left')
            ->join('users_info as j11', 'b.e_by=j11.id', 'left')
            ->where("b.sts<>0 and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_expense_details($id,$req_type)
    {
        $join = "";
        $select = "";
        if ($req_type==1) {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ni as a on (j0.activities_name=a.id AND j0.expense_type=1)";
            $select = "a.name,";
        }
        else if ($req_type==2) {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ara as a on (j0.activities_name=a.id AND j0.expense_type=1)";
            $select = "a.name,";
        }
        else
        {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ni as a on (j0.activities_name=a.id AND j0.expense_type=1)";
            $select = "a.name,";
        }
        if($id!=''){
            $str=" SELECT j0.amount,j0.expense_type,j0.remarks,IF(j0.expense_type=1 or j0.expense_type=4,l.name,IF(expense_type=2,v.name,IF((j0.expense_type=3 or j0.expense_type=5),CONCAT(u.name,' (',u.pin,')'),j0.vendor_name))) as vendor_name,
            e.name as expense_type_name,DATE_FORMAT(j0.activities_date,'%d-%b-%y') AS activities_date,
            IF(j0.expense_type=1,".$select."IF(j0.expense_type=1,a.name,IF(j0.expense_type=2,p.name,IF(j0.expense_type=3,s.name,IF(j0.expense_type=4,c.name,IF(j0.expense_type=5,en.name,ot.name)))))) as activities_name
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
            WHERE j0.sts=1 AND j0.event_id= ".$id." AND j0.module_name='Suit File' ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_suit_filling_details_by_cmaid($id)
    {
        if($id!=''){
                $this->db
                ->select('b.id,b.judge_name,b.judge_phone,b.arji_copy,b.case_number,b.case_claim_amount,j0.name as case_name,b.case_deal_officer as case_deal_officer_id,
                    b.prest_lawyer_name as prest_lawyer_id,b.prest_court_name as prest_court_id,
                    DATE_FORMAT(b.prev_date,"%d-%b-%y") AS prev_date,j1.name as case_sts_prev_dt,
                    IF(b.req_type=2,sca.name,scn.name) as act_prev_date,DATE_FORMAT(b.next_date,"%d-%b-%y") AS next_date,
                    j3.name as case_sts_next_dt,b.remarks_next_date,CONCAT(j4.name," (",j4.user_id,")") as filling_plaintiff,
                    DATE_FORMAT(b.filling_date,"%d-%b-%y") AS filling_date,
                    CONCAT(j6.name," (",j6.user_id,")")as case_deal_officer,j7.name as prev_lawyer_name,
                    j8.name as prest_lawyer_name,j9.name as prev_court_name,j10.name as prest_court_name,
                    c.loan_ac,c.ac_name,CONCAT(j11.name," (",j11.user_id,")")as e_by,
                    DATE_FORMAT(b.e_dt,"%d-%b-%y") AS e_dt
                    ', FALSE)
                ->from("suit_filling_info b")
                ->join('cma as c', 'b.cma_id=c.id', 'left')
                ->join('ref_case_name as j0', 'b.case_name=j0.id', 'left')
                ->join('ref_case_sts as j1', 'b.case_sts_prev_dt=j1.id', 'left')
                ->join('ref_schedule_charges_ara as sca', 'b.act_prev_date=sca.id AND b.req_type=2', 'left')
                ->join('ref_schedule_charges_ni as scn', 'b.act_prev_date=scn.id AND b.req_type=1', 'left')
                ->join('ref_case_sts as j3', 'b.case_sts_next_dt=j3.id', 'left')
                ->join('users_info as j4', 'b.filling_plaintiff=j4.id', 'left')
                ->join('users_info as j6', 'b.case_deal_officer=j6.id', 'left')
                ->join('ref_lawyer as j7', 'b.prev_lawyer_name=j7.id', 'left')
                ->join('ref_lawyer as j8', 'b.prest_lawyer_name=j8.id', 'left')
                ->join('ref_court as j9', 'b.prev_court_name=j9.id', 'left')
                ->join('ref_court as j10', 'b.prest_court_name=j10.id', 'left')
                ->join('users_info as j11', 'b.e_by=j11.id', 'left')
                ->where("b.cma_id='".$id."' and b.sts<>0 and (b.re_case_sts=0 OR b.re_case_sts=NULL)", NULL, FALSE)
                ->limit(1);
            $data = $this->db->get()->row();
        return $data;
        }
        else{return NULL;}
    }
    function get_package_details($id,$req_type)
    {
        $join = "";
        if ($req_type==1) {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ni as a on (h.activities_id=a.id)";
            $select = "a.name as activities_name,";
        }
        else if ($req_type==2) {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ara as a on (h.activities_id=a.id)";
            $select = "a.name as activities_name,";
        }
        else
        {
            $join = "LEFT OUTER JOIN ref_schedule_charges_ni as a on (h.activities_id=a.id)";
            $select = "a.name as activities_name,";
        }
        if($id!=''){
            $str="SELECT h.*,".$select."h.id as history_id,c.id as package_id,c.case_number,c.loan_ac,IF(c.disbursed_amount IS NULL,0,c.disbursed_amount) as disbursed_amount,c.package_amount,l.name as lawyer_name
            FROM package_select_history as h 
            LEFT OUTER JOIN lawyer_package_bill_setup c on(h.package_id=c.id)
            LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
            $join
            WHERE h.event_id='".$id."' AND h.amount_selection=1 AND h.event_table_name='suit_filling_info' LIMIT 1";
            $query=$this->db->query($str);
            return $query->row();
        }
        else{return NULL;}
    }
    function get_suit_filling_details_by_cmaid_all($id)
    {
        if($id!=''){
                $this->db
                ->select('b.id,b.judge_name,b.judge_phone,b.arji_copy,b.case_number,b.case_claim_amount,j0.name as case_name,b.case_deal_officer as case_deal_officer_id,
                    b.prest_lawyer_name as prest_lawyer_id,b.prest_court_name as prest_court_id,
                    DATE_FORMAT(b.prev_date,"%d-%b-%y") AS prev_date,j1.name as case_sts_prev_dt,
                    j2.name as act_prev_date,DATE_FORMAT(b.next_date,"%d-%b-%y") AS next_date,
                    j3.name as case_sts_next_dt,b.remarks_next_date,CONCAT(j4.name," (",j4.user_id,")") as filling_plaintiff,
                    DATE_FORMAT(b.filling_date,"%d-%b-%y") AS filling_date,
                    CONCAT(j6.name," (",j6.user_id,")")as case_deal_officer,j7.name as prev_lawyer_name,
                    j8.name as prest_lawyer_name,j9.name as prev_court_name,j10.name as prest_court_name,
                    c.loan_ac,c.ac_name,CONCAT(j11.name," (",j11.user_id,")")as e_by,
                    DATE_FORMAT(b.e_dt,"%d-%b-%y") AS e_dt
                    ', FALSE)
                ->from("suit_filling_info b")
                ->join('cma as c', 'b.cma_id=c.id', 'left')
                ->join('ref_case_name as j0', 'b.case_name=j0.id', 'left')
                ->join('ref_case_sts as j1', 'b.case_sts_prev_dt=j1.id', 'left')
                ->join('ref_case_sts as j2', 'b.act_prev_date=j2.id', 'left')
                ->join('ref_case_sts as j3', 'b.case_sts_next_dt=j3.id', 'left')
                ->join('users_info as j4', 'b.filling_plaintiff=j4.id', 'left')
                ->join('users_info as j6', 'b.case_deal_officer=j6.id', 'left')
                ->join('ref_lawyer as j7', 'b.prev_lawyer_name=j7.id', 'left')
                ->join('ref_lawyer as j8', 'b.prest_lawyer_name=j8.id', 'left')
                ->join('ref_court as j9', 'b.prev_court_name=j9.id', 'left')
                ->join('ref_court as j10', 'b.prest_court_name=j10.id', 'left')
                ->join('users_info as j11', 'b.e_by=j11.id', 'left')
                ->where("b.cma_id='".$id."' and b.sts<>0 and (b.re_case_sts=0 or b.re_case_sts is null)", NULL, FALSE)
                ->limit(1);
            $data = $this->db->get()->row();
        return $data;
        }
        else{return NULL;}
    }
    function add_court_fee()
    {
        $str="SELECT  j0.req_type,j0.legal_region,j0.case_fill_dist,j0.cif,j0.loan_ac,j0.org_loan_ac,j0.ac_name,j0.loan_segment,j0.region,j0.territory,j0.district,j0.id,j0.proposed_type
                 FROM cma j0
             WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";

        $application_data=$this->db->query($str)->row();
        $loan_ac = $application_data->loan_ac;
        $cif = $application_data->cif;
        $org_loan_ac = $application_data->org_loan_ac;
        $ac_name = $application_data->ac_name;
        $req_type = $application_data->req_type;
        $loan_segment = $application_data->loan_segment;
        $region = $application_data->legal_region;
        $territory = $application_data->territory;
        $district = $application_data->case_fill_dist;
        $proposed_type = $application_data->proposed_type;
            $cost_data = array(
            'module_name' => 'suit_file',
            'main_table_name' => 'cma',
            'main_table_id' => $this->input->post('deleteEventId'),
            'activities_id' => 1,
            'vendor_type' => 4,
            'vendor_id' => $_POST['lawyer'],
            'amount' =>$_POST['court_fee_amount'],
            'txrn_dt' => date('Y-m-d H:i:s'),
            'loan_ac' =>$loan_ac,
            'cif' =>$cif,
            'org_loan_ac' =>$org_loan_ac,
            'ac_name' =>$ac_name,
            'req_type' =>$req_type,
            'proposed_type' =>$proposed_type,
            'loan_segment' =>$loan_segment,
            'region' =>$region,
            'territory' =>$territory,
            'district' =>$district
        );
        $data3=$this->user_model->cost_details($cost_data);
    }
    function delete_action($id=NULL,$bulk=NULL,$type=NULL)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        if(isset($_POST['type']) && $this->input->post('type')=='acknowledgement'){
            //Reassigned File Acknowledgement
            $str="SELECT  j0.cma_sts_before_reas,j0.temp_legal_user,j0.cma_sts
                             FROM cma j0
                         WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();
            if($application_data->cma_sts==87)//Reassigned File Acknowledgement
            {
                $data = array('cma_sts_before_reas' =>0,'cma_sts' => $application_data->cma_sts_before_reas,'legal_ack_by'=> $this->session->userdata['ast_user']['user_id'], 'legal_ack_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('cma', $data);
                $data2 = $this->user_model->user_activities(61,'cma',$this->input->post('deleteEventId'),'cma','File acknowledgement by legal after Reassign('.$this->input->post('deleteEventId').')');

            }
            else //First Time Acknowledgement
            {
                $pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'61','cma_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('cma_sts' => 61,'legal_ack_by'=> $this->session->userdata['ast_user']['user_id'], 'legal_ack_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['deleteEventId']);
                    $this->db->update('cma', $data);
                    $data2 = $this->user_model->user_activities(61,'cma',$this->input->post('deleteEventId'),'cma','File acknowledgement by legal('.$this->input->post('deleteEventId').')');
                    $application_data = $this->db->query("SELECT hoops_user FROM cma where id='".$_POST['deleteEventId']."'")->row();
                    $subject = "File acknowledged by Legal officer";
                    $url = base_url()."cma_process/details";
                    $data2 = $this->Common_model->push_notification_data($subject,$url,'cma',$_POST['deleteEventId'],date('Y-m-d'),'',$application_data->hoops_user,'1');
                }
            }
            
            $id = $_POST['deleteEventId'];
            
        }
        if(isset($_POST['ad_type']) && $this->input->post('ad_type')=='save'){

            $str="SELECT  j0.id
                     FROM cost_details j0
                 WHERE j0.module_name='suit_file' AND j0.txrn_dt='".implode('-',array_reverse(explode('/',$this->input->post('ln_sent_date'))))."' AND j0.vendor_type=1 AND j0.activities_id=1  AND j0.main_table_name='cma' AND j0.main_table_id= '".$this->input->post('ad_deleteEventId')."' LIMIT 1";

            $bill_data=$this->db->query($str)->row();
            if(!empty($bill_data))
            {
                return 'ln bill exists!';
            }
            //Generaing Total LN Costs
            $str="SELECT  j0.req_type,j0.cif,j0.loan_ac,j0.org_loan_ac,j0.ac_name,j0.loan_segment,j0.region,j0.territory,j0.district,j0.id,j0.proposed_type
                     FROM cma j0
                 WHERE j0.id= '".$this->input->post('ad_deleteEventId')."' LIMIT 1";

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
                'module_name' => 'suit_file',
                'main_table_name' => 'cma',
                'main_table_id' => $this->input->post('ad_deleteEventId'),
                'activities_id' => 1,
                'vendor_type' => 1,
                'vendor_id' => $_POST['ad_lawyer'],
                'amount' =>$_POST['total_ln_cost'],
                'expense_remarks' => $_POST['total_ln_cost_remarks'],
                'txrn_dt' => implode('-',array_reverse(explode('/',$this->input->post('ln_sent_date')))),
                'loan_ac' =>$loan_ac,
                'cif' =>$cif,
                'org_loan_ac' =>$org_loan_ac,
                'ac_name' =>$ac_name,
                'req_type' =>$req_type,
                'proposed_type' =>$proposed_type,
                'loan_segment' =>$loan_segment,
                'region' =>$region,
                'territory' =>$territory,
                'district' =>$district
            );
            $data3=$this->user_model->cost_details($cost_data);
            //////////////////////
            $final_ln = $this->get_file_name('final_ln','cma_file/ln_scan_copy/');
            $lawyer_ack_copy = $this->get_file_name('lawyer_ack_copy','cma_file/lawyer_ack_copy/');
            $data = array('cma_sts' => 62,
                'ln_sent_date' => implode('-',array_reverse(explode('/',$this->input->post('ln_sent_date')))),
                'ln_val_dt' => implode('-',array_reverse(explode('/',$this->input->post('ln_val_dt')))),
                'adi_by'=> $this->session->userdata['ast_user']['user_id'],
                'adi_dt'=>date('Y-m-d H:i:s'),
                'ln_status'=>$_POST['ln_status'],
                'total_final_ln'=>$_POST['total_final_ln'],
                'final_ln'=>$final_ln,
                'lawyer_ack_copy'=>$lawyer_ack_copy
                );
            $this->db->where('id', $_POST['ad_deleteEventId']);
            $this->db->update('cma', $data);
            $data2 = $this->user_model->user_activities(62,'cma',$this->input->post('ad_deleteEventId'),'cma','Additioanl Input Given('.$this->input->post('ad_deleteEventId').')');
            $id = $_POST['ad_deleteEventId'];
            
        }
        if(isset($_POST['type']) && $this->input->post('type')=='sendnotificationlawyer'){
            //Generating Court Feee
            if($_POST['new_court_fee_sts']==1) //For New Court Fee
            {
                //IF cout fee give to the old lawyer
                $pre_court_fee_data = $this->db->query("SELECT c.*
                    FROM cost_details as c 
                    WHERE c.vendor_type=4 AND c.main_table_name='cma' AND c.main_table_id=".$this->input->post('deleteEventId')." ORDER BY c.id DESC LIMIT 1 " )->row();
                if(!empty($pre_court_fee_data))
                {
                    if($pre_court_fee_data->vendor_id!=$_POST['lawyer'] && $pre_court_fee_data->court_fee_return_sts!=13 && $pre_court_fee_data->bill_id!='' && $pre_court_fee_data->bill_id!='0' && $pre_court_fee_data->bill_id!=NULL)
                    {
                        return "99999";
                    }
                    else if($pre_court_fee_data->vendor_id==$_POST['lawyer'] && $pre_court_fee_data->bill_id!='' && $pre_court_fee_data->bill_id!='0' && $pre_court_fee_data->bill_id!=NULL)
                    {
                        if($_POST['court_fee_id']!=0)
                        {
                            //Updating the court fee to new lawyer
                            $data = array(
                                'vendor_id'=> $_POST['lawyer'], 
                                );
                            $this->db->where('id', $_POST['court_fee_id']);
                            $this->db->update('cost_details', $data);
                        }
                    }
                    else if($pre_court_fee_data->vendor_id!=$_POST['lawyer'] && $pre_court_fee_data->court_fee_return_sts==13 && $pre_court_fee_data->bill_id!='' && $pre_court_fee_data->bill_id!='0' && $pre_court_fee_data->bill_id!=NULL)
                    {
                        $this->add_court_fee();
                    }

                }
                else
                {
                    $this->add_court_fee();
                }

            }
            else
            {
                if($_POST['court_fee_id']!=0)
                {
                    //Updating the court fee to new lawyer
                    $data = array(
                        'vendor_id'=> $_POST['lawyer'], 
                        );
                    $this->db->where('id', $_POST['court_fee_id']);
                    $this->db->update('cost_details', $data);
                }
            }

            $data = array('cma_sts' => 63,
                'lawyer_n_send_by'=> $this->session->userdata['ast_user']['user_id'], 
                'lawyer'=> $_POST['lawyer'],
                'lawyer_n_send_dt'=>date('Y-m-d H:i:s')
                );
            if($_POST['hidden_req_type']==1)
            {
                $data['l_branch']= $_POST['branch'];
                $data['l_bank']= $_POST['bank'];
                $data['chq_amount']= $_POST['chq_amount'];
                $data['chq_number']= $_POST['chq_number'];
                $data['l_dishonor_dt']= implode('-',array_reverse(explode('/',$this->input->post('dishonor_dt'))));
            }
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma', $data);
            $history_data = array(
                'event_id' => $_POST['deleteEventId'],
                'lawyer_id'=> $_POST['lawyer'], 
                'select_by'=> $this->session->userdata['ast_user']['user_id'],
                'select_dt'=>date('Y-m-d H:i:s')
                );
            $this->db->insert('legal_lawyer_select_history', $history_data);
            if (isset($_POST['notification_type']) && ($this->input->post('notification_type') == 'Email' || $this->input->post('notification_type') == 'BOTH') )
            {
                $str="SELECT  j0.sl_no,s.name as cma_sts
                             FROM cma j0
                             LEFT OUTER JOIN ref_status s on(j0.cma_sts=s.id)
                         WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
                $application_data=$this->db->query($str)->row();
                
                if (!empty($this->input->post('email_address')) && $this->input->post('email_address') != null) {
                   $subject="File Assigned";
                   $message = $this->lawyer_notification_format($_POST['deleteEventId'],$_POST['lawyer']);
                    $m=$this->User_model->send_email("", "", $this->input->post('email_address'),"", $subject,$message);
                    
                    //echo $m;exit;
                    $data2 = $this->user_model->user_activities(63,'cma',$this->input->post('deleteEventId'),'cma','Send Notification To Lawyer By Email('.$this->input->post('email_address').')('.$this->input->post('deleteEventId').')');
                }

            }
            if (isset($_POST['notification_type']) && ($this->input->post('notification_type') == 'SMS' || $this->input->post('notification_type') == 'BOTH')) {
               
               $this->load->library('WebService');
                $ws = new WebService();
                $api_config2=$this->Common_model->get_api_config_data('CBS Middleware','Loan Details');
                if ($api_config2->active_sts==1) {
                    $str="SELECT  j0.sl_no,j0.id,j0.chq_amount,j0.chq_number,DATE_FORMAT(j0.l_dishonor_dt,'%d-%b-%y') as l_dishonor_dt,j0.req_type,j0.loan_ac,j0.ac_name,j0.st_belance,u.name as legal_user_name,u.mobile_number
                                 FROM cma j0
                                 LEFT OUTER JOIN users_info u on(j0.legal_user=u.id)
                             WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                             
                    $application_data=$this->db->query($str)->row();
                    $message='Some case related documents are sent to your chambers. Requested to communicate with '.$application_data->legal_user_name.', '.$application_data->mobile_number;
                    $sms = $this->user_model->send_sms($message,$this->input->post('mobile'),'cma',$this->input->post('deleteEventId'),0);
                    
                }

               $data2 = $this->user_model->user_activities(63,'cma',$this->input->post('deleteEventId'),'cma','Send Notification To Lawyer By SMS('.$this->input->post('mobile').')('.$this->input->post('deleteEventId').')');
            }
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='sendforauthorization'){
            $pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'66','cma_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('cma_sts' => 66);
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('cma', $data);
                $data2 = array('sts' => 66);
                $this->db->where('cma_id', $_POST['deleteEventId']);
                $this->db->update('suit_filling_info', $data2);
                $str="SELECT  j0.req_type,j0.legal_user
                             FROM cma j0
                         WHERE j0.sts <>0 AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                
                $application_data=$this->db->query($str)->row();
                if ($application_data->req_type==2) {
                    $auth_type = 1; //For ARA Filling Authorization
                }
                else
                {
                    $auth_type = 8;//For Others Authorization
                }
                $data4 = array('legal_user' =>$application_data->legal_user,'event_name' =>'cma','authorization_type' => $auth_type,'event_id'=> $_POST['deleteEventId'],'auth_sts' => 66,'sfa_by'=> $this->session->userdata['ast_user']['user_id'], 'sfa_dt'=>date('Y-m-d H:i:s'));
                $this->db->insert('authorization', $data4);
                $data3 = $this->user_model->user_activities(66,'cma',$this->input->post('deleteEventId'),'cma','Suit File Send For Authorization('.$this->input->post('deleteEventId').')');
            }
            $id = $_POST['deleteEventId'];
            
        }
        if(isset($_POST['type']) && $this->input->post('type')=='delete'){
            $pre_action_result=$this->Common_model->get_pre_action_data('suit_filling_info',$_POST['deleteEventId'],0,'sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                //after verify delete
                $str="SELECT  j0.suit_sts
                         FROM suit_filling_info j0
                     WHERE j0.sts != '0'  AND j0.id= '".$this->input->post('deleteEventId')."'";   
                $suit_data=$this->db->query($str)->row();
                if($suit_data->suit_sts==75 || $suit_data->suit_sts==76)
                {
                    $str="SELECT  j0.id
                         FROM cost_details j0
                     WHERE j0.module_name='suit_file' AND j0.main_table_name='suit_filling_info' AND j0.main_table_id= '".$this->input->post('deleteEventId')."'";   
                    $bill_data=$this->db->query($str)->result();
                    if(count($bill_data)>0)
                    {
                        return 'Bill exists';
                    }

                    $str="SELECT  j0.id
                         FROM change_request j0
                     WHERE j0.change_type=1 AND j0.sts<>0 AND j0.suit_file_id= '".$this->input->post('deleteEventId')."'";   
                    $status_data=$this->db->query($str)->result();
                    if(count($status_data)>0)
                    {
                        return 'Status Exists';
                    }
                    $str="SELECT  j0.cma_id
                         FROM suit_filling_info j0
                     WHERE j0.sts != '0'  AND j0.id= '".$this->input->post('deleteEventId')."'";   
                    $cma_data2=$this->db->query($str)->row();
                    $data = array('d_reason'=>trim($_POST['comments']), 'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['deleteEventId']);
                    $this->db->update('suit_filling_info', $data);
                    if(!empty($cma_data2) && $cma_data2->cma_id!='' && $cma_data2->cma_id!=NULL)
                    {
                        $data = array('cma_sts' => 67);
                        $this->db->where('id', $cma_data2->cma_id);
                        $this->db->update('cma', $data);
                    }

                }
                else
                {
                    $str="SELECT  j0.cma_id
                         FROM suit_filling_info j0
                     WHERE j0.sts != '0'  AND j0.id= '".$this->input->post('deleteEventId')."'";   
                    $cma_data2=$this->db->query($str)->row();
                    $data = array('d_reason'=>trim($_POST['comments']), 'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['deleteEventId']);
                    $this->db->update('suit_filling_info', $data);

                    //Delete Expenses
                    $expense_data = array('sts' => 0);
                     $this->db->where('event_id',$_POST['deleteEventId']);
                     $this->db->where('module_name',"Suit File");
                     $this->db->update('expenses', $expense_data);
                    
                    $data = array('cma_sts' => 67);
                    $this->db->where('id', $cma_data2->cma_id);
                    $this->db->update('cma', $data);
                }
                //Normally delete
                
                $data2 = $this->user_model->user_activities(15,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Delete Suit File Info('.$this->input->post('deleteEventId').')',$_POST['comments']);
            }
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='confirm'){
            $pre_action_result=$this->Common_model->get_pre_action_data('suit_filling_info',$_POST['deleteEventId'],'75','suit_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data2 = array('suit_sts' => 75,'confirm_by'=> $this->session->userdata['ast_user']['user_id'], 'confirm_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('suit_filling_info', $data2);
                $str="SELECT  j0.case_number,j0.cif,j0.e_by,j0.e_dt,j0.req_type,j0.loan_ac,j0.org_loan_ac,j0.ac_name,j0.loan_segment,j0.region,j0.territory,j0.district,j0.id,j0.proposed_type
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
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
                $case_number = $application_data->case_number;

                //Genereate Package Expenses
                $str="SELECT  j0.*,s.lawyer,IF(s.disbursed_amount IS NULL,0,s.disbursed_amount) as disbursed_amount,s.package_amount
                         FROM package_select_history j0
                         LEFT OUTER JOIN lawyer_package_bill_setup s on(s.id=j0.package_id)
                     WHERE j0.event_table_name='suit_filling_info' AND j0.amount_selection=1 AND j0.event_id= '".$this->input->post('deleteEventId')."' LIMIT 1";   
                $package_data=$this->db->query($str)->row();
                if (!empty($package_data)) {
                    $total_disbursed_amount = $package_data->disbursed_amount+$package_data->amount;
                    if($total_disbursed_amount>$package_data->package_amount)
                    {
                        return 'limitcrossed';
                    }
                    if($total_disbursed_amount==$package_data->package_amount)
                    {
                        $disbursed_sts = 1;
                    }
                    else
                    {
                        $disbursed_sts = 0;
                    }
                    //update total disbursed amount
                    $data = array('disbursed_amount' => $total_disbursed_amount,'disbursed_sts' => $disbursed_sts);
                    $this->db->where('id', $package_data->package_id);
                    $this->db->update('lawyer_package_bill_setup', $data);

                    $cost_data = array(
                            'module_name' => 'suit_file',
                            'main_table_name' => 'suit_filling_info',
                            'main_table_id' => $this->input->post('deleteEventId'),
                            'sub_table_name' => 'package_select_history',
                            'sub_table_id' => $package_data->id,
                            'suit_id' => $this->input->post('deleteEventId'),
                            'activities_id' => $package_data->activities_id,
                            'package_id' => $package_data->package_id,
                            'vendor_type' => 1,
                            'vendor_id' => $package_data->lawyer,
                            'amount' =>$package_data->amount,
                            'txrn_dt' => $application_data->e_dt,
                            'loan_ac' =>$loan_ac,
                            'cif' =>$cif,
                            'org_loan_ac' =>$org_loan_ac,
                            'ac_name' =>$ac_name,
                            'req_type' =>$req_type,
                            'proposed_type' =>$proposed_type,
                            'loan_segment' =>$loan_segment,
                            'case_number' =>$case_number,
                            'region' =>$region,
                            'territory' =>$territory,
                            'district' =>$district
                        );
                    $data3=$this->user_model->cost_details($cost_data);
                    
                }

                //Genereate Expenses
                $str="SELECT  j0.*
                         FROM expenses j0
                     WHERE j0.sts != '0'  AND j0.event_id= '".$this->input->post('deleteEventId')."' AND j0.module_name='Suit File'";   
                $expense_data=$this->db->query($str)->result();
                if (!empty($expense_data)) {
                        foreach ($expense_data as $key) {
                            $cost_data = array(
                            'module_name' => 'suit_file',
                            'main_table_name' => 'suit_filling_info',
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
                            'loan_ac' =>$loan_ac,
                            'cif' =>$cif,
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
                        if ($key->package_select_sts==0) { //skipping the package selected bill
                            $data3=$this->user_model->cost_details($cost_data);
                        }
                    }
                    //Verify Expenses
                    $expense_data = array('v_sts' => 38);
                     $this->db->where('event_id',$_POST['deleteEventId']);
                     $this->db->where('module_name',"Suit File");
                     $this->db->update('expenses', $expense_data);
                }
                $data3 = $this->user_model->user_activities(75,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Suit File Confirmed by legal('.$this->input->post('deleteEventId').')');
            }
            $id = $_POST['deleteEventId'];
            
        }
        if(isset($_POST['type']) && $this->input->post('type')=='closeaccount'){
            $pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['deleteEventId'],'76','cma_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $close_account_file = $this->get_file_name('close_account_file','cma_file/close_account_file/');
                $data = array('cma_sts' => 76,'close_account_file' => $close_account_file,'file_close_remarks' => $_POST['close_account_remarks'],'file_close_by'=> $this->session->userdata['ast_user']['user_id'], 'file_close_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('cma', $data);
                $data3 = $this->user_model->user_activities(76,'cma',$this->input->post('deleteEventId'),'cma','Account Closed by legal('.$this->input->post('deleteEventId').')',$_POST['close_account_remarks']);
            }
            $id = $_POST['deleteEventId'];
            
        }
        if(isset($_POST['type']) && $this->input->post('type')=='reassign'){
            $data = array('cma_id' => $_POST['deleteEventId'],'reason'=> $_POST['comments'],'pre_legal_user' => $_POST['pre_legal_user'],'prest_legal_user' => $_POST['legal_user'],'e_by'=> $this->session->userdata['ast_user']['user_id'], 'e_dt'=>date('Y-m-d H:i:s'));
            $this->db->insert('cma_legal_user_change_history', $data);
            $insert_idss = $this->db->insert_id();
            $str="SELECT  j0.cma_sts
                             FROM cma j0
                         WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();
            $data = array('change_history_id' => $insert_idss,'cma_sts_before_reas' => $application_data->cma_sts,'reassign_reason'=> $_POST['comments'],'cma_sts' => 84,'temp_legal_user' => $_POST['legal_user'],'legal_reassign_by'=> $this->session->userdata['ast_user']['user_id'], 'legal_reassign_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma', $data);
            
            
            //Creating Automatic Authorization Request

            $str="SELECT  j0.id,j0.req_type
                             FROM suit_filling_info j0
                         WHERE j0.sts = '1' AND j0.suit_sts=75  AND j0.cma_id= '".$_POST['deleteEventId']."' AND j0.re_case_sts<>1 LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();
            if(!empty($application_data))
            {
                if($application_data->req_type==2)
                {
                    $type = 4;
                }
                else
                {
                    $type = 9;
                }
                $data = array(
                    'suit_file_id' =>$application_data->id,
                    'authorization_type' =>$type,
                    'new_item' =>$_POST['legal_user'],
                    'change_type' =>2,
                    'change_date' =>date('Y-m-d H:i:s'),
                    'change_reason' =>$this->security->xss_clean( $this->input->post('remarks'))
                );
                $data['prev_item'] = $_POST['pre_legal_user'];
                $data['e_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['e_dt'] = date('Y-m-d H:i:s');
                $this->db->insert('change_request', $data);
            }

            $data3 = $this->user_model->user_activities(85,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Reassign Legal User('.$this->input->post('deleteEventId').')',$_POST['comments']);
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='reassign_file'){
            $str="SELECT  j0.temp_deal_officer,j0.prest_court_name,j0.present_plaintiff,j0.case_deal_officer,j0.change_history_id
                     FROM suit_filling_info j0
                 WHERE j0.id= '".$_POST['deleteEventId']."' LIMIT 1";
            $application_data=$this->db->query($str)->row();
            $data = array('suit_id' => $_POST['deleteEventId'],'reason'=> $_POST['reassign_reason'],'pre_legal_user' => $_POST['pre_legal_user'],'prest_legal_user' => $_POST['legal_user'],'e_by'=> $this->session->userdata['ast_user']['user_id'], 'e_dt'=>date('Y-m-d H:i:s'));
            if($_POST['court']!='')//When Court Name Changed
            {
                $data['pre_court'] = $application_data->prest_court_name;
                $data['present_court'] = $_POST['court'];
            }
            $this->db->insert('cma_legal_user_change_history', $data);
            $insert_idss = $this->db->insert_id();

            $data = array('change_history_id' => $insert_idss,'reassign_reason'=> $_POST['reassign_reason'],'suit_sts' => 84,'temp_deal_officer' => $_POST['legal_user'],'reassign_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_dt'=>date('Y-m-d H:i:s'));
            if($_POST['court']!='')//When Court Name Changed
            {
                $data['temp_court'] = $_POST['court'];
            }
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('suit_filling_info', $data);
            

            $data3 = $this->user_model->user_activities(85,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Reassign Legal User('.$this->input->post('deleteEventId').')',$_POST['reassign_reason']);
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='reject_reassign_approval'){
            $str="SELECT  j0.cma_sts_before_reas,j0.change_history_id
                             FROM cma j0
                         WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();
            $data = array('temp_legal_user' =>0,'cma_sts' => $application_data->cma_sts_before_reas,'reassign_reject_reason'=> $_POST['reject_reason'],'reassign_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_reject_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma', $data);

            $data = array('sts' =>86,'reassign_reject_reason'=> $_POST['reject_reason'],'reassign_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_reject_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $application_data->change_history_id);
            $this->db->update('cma_legal_user_change_history', $data);

            $data3 = $this->user_model->user_activities(86,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Reassign Approval Reject('.$this->input->post('deleteEventId').')',$_POST['reject_reason']);
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='reject_reassign_approval_file'){
            $str="SELECT  j0.change_history_id
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();

            $data = array('temp_deal_officer' =>0,'temp_court' =>0,'temp_lawyer' =>0,'suit_sts' => 75,'reassign_reject_reason'=> $_POST['reject_reason'],'reassign_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_reject_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('suit_filling_info', $data);

            $data = array('sts' =>86,'reassign_reject_reason'=> $_POST['reject_reason'],'reassign_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_reject_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $application_data->change_history_id);
            $this->db->update('cma_legal_user_change_history', $data);

            $data3 = $this->user_model->user_activities(86,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Reassign Approval Reject('.$this->input->post('deleteEventId').')',$_POST['reject_reason']);
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='reassign_approval'){
            $str="SELECT  j0.cma_sts_before_reas,j0.temp_legal_user,j0.change_history_id
                             FROM cma j0
                         WHERE j0.sts = '1'  AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();
            $data = array('legal_user' =>$application_data->temp_legal_user,'temp_legal_user' =>0,'cma_sts' => 87,'reassign_v_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_v_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma', $data);

            $data = array('sts' =>87,'reassign_v_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_v_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $application_data->change_history_id);
            $this->db->update('cma_legal_user_change_history', $data);

            $str="SELECT  j0.id,j0.req_type,j0.present_plaintiff,j0.filling_plaintiff,j0.case_deal_officer
                             FROM suit_filling_info j0
                         WHERE j0.sts = '1' AND j0.suit_sts=75  AND j0.cma_id= '".$_POST['deleteEventId']."' AND j0.re_case_sts<>1 LIMIT 1";
                         
            $suit_data=$this->db->query($str)->row();
            if(!empty($suit_data))
            {
                $data2=array();
                $data2['prev_plaintiff'] = $suit_data->present_plaintiff;
                $data2['present_plaintiff'] = $suit_data->case_deal_officer;
                $data2['case_deal_officer'] = $application_data->temp_legal_user;

                $this->db->where('id', $suit_data->id);
                $this->db->update('suit_filling_info', $data2);
            }
            $data3 = $this->user_model->user_activities(87,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Reassign Approval Approved('.$this->input->post('deleteEventId').')');
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='reassign_approval_file'){
            $str="SELECT  j0.temp_deal_officer,j0.prest_court_name,j0.prest_lawyer_name,j0.temp_court,j0.temp_lawyer,j0.present_plaintiff,j0.case_deal_officer,j0.change_history_id
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();
            $data = array('suit_sts' => 75,'reassign_v_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_v_dt'=>date('Y-m-d H:i:s'));
            if($application_data->temp_deal_officer!='' && $application_data->temp_deal_officer!=NULL && $application_data->temp_deal_officer!=0)
            {
                $data['present_plaintiff'] = $application_data->case_deal_officer;
                $data['prev_plaintiff'] = $application_data->present_plaintiff;
                $data['case_deal_officer'] = $application_data->temp_deal_officer;
                $data['temp_deal_officer'] = 0;
            }
            if($application_data->temp_court!='' && $application_data->temp_court!=NULL && $application_data->temp_court!=0)
            {
                $data['prest_court_name'] = $application_data->temp_court;
                $data['prev_court_name'] = $application_data->prest_court_name;
                $data['temp_court'] = 0;
            }
            if($application_data->temp_lawyer!='' && $application_data->temp_lawyer!=NULL && $application_data->temp_lawyer!=0)
            {
                $data['prest_lawyer_name'] = $application_data->temp_lawyer;
                $data['prev_lawyer_name'] = $application_data->prest_lawyer_name;
                $data['temp_lawyer'] = 0;
            }
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('suit_filling_info', $data);

            $data = array('sts' =>87,'reassign_v_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_v_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $application_data->change_history_id);
            $this->db->update('cma_legal_user_change_history', $data);

            $data3 = $this->user_model->user_activities(87,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Reassign Approval Approved('.$this->input->post('deleteEventId').')');
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='updatenextdate'){
            $data['module_name'] = 'suit_file';
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
            $this->db->update('suit_filling_info', $data4);
            $data3 = $this->user_model->user_activities(92,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Update Next Date('.$this->input->post('deleteEventId').')');
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='putup_file'){

            $data = array('suit_id' => $_POST['deleteEventId'],'reason'=> $_POST['putup_comments'],'e_by'=> $this->session->userdata['ast_user']['user_id'], 'e_dt'=>date('Y-m-d H:i:s'));
            $this->db->insert('suit_putup_history', $data);
            $insert_idss = $this->db->insert_id();

            $data = array('put_up_history_id' => $insert_idss,'put_up_reason'=> $_POST['putup_comments'],'suit_sts' => 97,'put_up_by'=> $this->session->userdata['ast_user']['user_id'], 'put_up_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('suit_filling_info', $data);
            

            $data3 = $this->user_model->user_activities(97,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','PUT-UP('.$this->input->post('deleteEventId').')',$_POST['putup_comments']);
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='reject_putup_approval_file'){
            $str="SELECT  j0.put_up_history_id
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();

            $data = array('suit_sts' => 76,'put_up_reject_reason'=> $_POST['reject_reason_putup'],'put_up_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'put_up_reject_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('suit_filling_info', $data);

            $data = array('sts' =>53,'reject_reason'=> $_POST['reject_reason_putup'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $application_data->put_up_history_id);
            $this->db->update('suit_putup_history', $data);

            $data3 = $this->user_model->user_activities(53,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','PUT-UP Approval Reject('.$this->input->post('deleteEventId').')',$_POST['reject_reason_putup']);
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='putup_approval_file'){
            $str="SELECT  j0.put_up_history_id
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();
            $data = array('suit_sts' =>75,'final_remarks' =>1,'put_up_v_by'=> $this->session->userdata['ast_user']['user_id'], 'put_up_v_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('suit_filling_info', $data);

            $data = array('sts' =>75,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $application_data->put_up_history_id);
            $this->db->update('suit_putup_history', $data);

            $data3 = $this->user_model->user_activities(51,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','PUT-UP Approval Approved('.$this->input->post('deleteEventId').')');
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='editcourtfee'){

            $data = array('cma_id' => $_POST['deleteEventId'],'reason'=> $_POST['editcourtfee_reason'],'court_fee_id' => $_POST['pre_court_fee_id'],'pre_court_fee' => $_POST['pre_court_fee'],'new_court_fee' => $_POST['court_fee'],'pre_case_claim_amount' => $_POST['pre_case_claim_amount'],'new_case_claim_amount' => $_POST['case_claim_amount'],'u_by'=> $this->session->userdata['ast_user']['user_id'], 'u_dt'=>date('Y-m-d H:i:s'));
            $this->db->insert('court_fee_edit_history', $data);
            $insert_idss = $this->db->insert_id();

            $data = array('st_belance'=> $_POST['case_claim_amount']);
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma', $data);

            if($_POST['pre_court_fee_id']!='')
            {
                $data = array('amount'=> $_POST['court_fee']);
                $this->db->where('id', $_POST['pre_court_fee_id']);
                $this->db->update('cost_details', $data);
            }
            $data3 = $this->user_model->user_activities(35,'suit_file',$this->input->post('deleteEventId'),'cma','Update Court Fee & Case Claim Amount('.$this->input->post('deleteEventId').')',$_POST['editcourtfee_reason']);
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
    function lawyer_notification_format($cma_id,$lawyer_id,$bulk=NULL)
    {
        $str="SELECT  j0.sl_no,j0.id,j0.chq_amount,j0.chq_number,DATE_FORMAT(j0.l_dishonor_dt,'%d-%b-%y') as l_dishonor_dt,j0.req_type,j0.loan_ac,j0.ac_name,j0.st_belance,u.name as legal_user_name,u.mobile_number
                         FROM cma j0
                         LEFT OUTER JOIN users_info u on(j0.legal_user=u.id)
                     WHERE j0.sts = '1'  AND j0.id= '".$cma_id."' LIMIT 1";
                     
        $application_data=$this->db->query($str)->row();
        $str="SELECT  j0.id,j0.name,c.name as court_name,j0.chamber
                         FROM ref_lawyer j0
                         LEFT OUTER JOIN ref_court c on (j0.court_id=c.id)
                     WHERE j0.id= '".$lawyer_id."' LIMIT 1";
                     
            $lawyer_data=$this->db->query($str)->row();
        $html='';
        $html.='
            <!DOCTYPE html>
            <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
            <head>
                <meta charset="utf-8"> <!-- utf-8 works for most cases -->
                <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale should not be necessary -->
                <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
                <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
                <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

                <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

                <!-- CSS Reset : BEGIN -->
                <style>

                    html,
            body {
                margin: 0 auto !important;
                padding: 0 !important;
                height: 100% !important;
                width: 100% !important;
                background: #ffffff;
            }

            /* What it does: Stops email clients resizing small text. */
            * {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            /* What it does: Centers email on Android 4.4 */
            div[style*="margin: 16px 0"] {
                margin: 0 !important;
            }

            /* What it does: Stops Outlook from adding extra spacing to tables. */
            table,
            td {
                mso-table-lspace: 0pt !important;
                mso-table-rspace: 0pt !important;
            }

            /* What it does: Fixes webkit padding issue. */
            table {
                border-spacing: 0 !important;
                border-collapse: collapse !important;
                table-layout: fixed !important;
                margin: 0 auto !important;
            }

            /* What it does: Uses a better rendering method when resizing images in IE. */
            img {
                -ms-interpolation-mode:bicubic;
            }

            /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
            a {
                text-decoration: none;
            }

            /* What it does: A work-around for email clients meddling in triggered links. */
            *[x-apple-data-detectors],  /* iOS */
            .unstyle-auto-detected-links *,
            .aBn {
                border-bottom: 0 !important;
                cursor: default !important;
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }

            /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
            .a6S {
                display: none !important;
                opacity: 0.01 !important;
            }

            /* What it does: Prevents Gmail from changing the text color in conversation threads. */
            .im {
                color: inherit !important;
            }

            img.g-img + div {
                display: none !important;
            }

            /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
            /* Create one of these media queries for each additional viewport size you would like to fix */

            /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
            @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
                u ~ div .email-container {
                    min-width: 320px !important;
                }
            }
            /* iPhone 6, 6S, 7, 8, and X */
            @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
                u ~ div .email-container {
                    min-width: 375px !important;
                }
            }
            /* iPhone 6+, 7+, and 8+ */
            @media only screen and (min-device-width: 414px) {
                u ~ div .email-container {
                    min-width: 414px !important;
                }
            }

                </style>

                <!-- CSS Reset : END -->

                <!-- Progressive Enhancements : BEGIN -->
                <style>

                    .primary{
                background: #f85e9f;
            }
            .bg_white{
                background: #ffffff;
            }
            .bg_light{
                background: #fafafa;
            }
            .bg_black{
                background: #000000;
            }
            .bg_dark{
                background: rgba(0,0,0,.8);
            }
            .email-section{
                padding:2.5em;
            }

            /*BUTTON*/
            .btn{
                padding: 5px 15px;
                display: inline-block;
            }
            .btn.btn-primary{
                border-radius: 5px;
                background: #f85e9f;
                color: #ffffff;
            }
            .btn.btn-white{
                border-radius: 5px;
                background: #ffffff;
                color: #000000;
            }
            .btn.btn-white-outline{
                border-radius: 5px;
                background: transparent;
                border: 1px solid #fff;
                color: #fff;
            }
            .btn.btn-black-outline{
                border-radius: 0px;
                background: transparent;
                border: 2px solid #000;
                color: #000;
                font-weight: 700;
            }

            h1,h2,h3,h4,h5,h6{
                font-family: "Lato", sans-serif;
                color: #000000;
                margin-top: 0;
                font-weight: 400;
            }

            body{
                font-family: "Lato", sans-serif;
                font-weight: 400;
                font-size: 15px;
                line-height: 1.8;
                color: rgba(0,0,0,.4);
            }

            a{
                color: #f85e9f;
            }

            table{
            }
            /*LOGO*/

            .logo h1{
                margin: 0;
            }
            .logo h1 a{
                color: #000000;
                font-size: 20px;
                font-weight: 700;
                text-transform: uppercase;
                font-family: "Lato", sans-serif;
                border: 2px solid #000;
                padding: .2em 1em;
            }

            .navigation{
                padding: 0;
                padding: 1em 0;
                /*background: rgba(0,0,0,1);*/
                border-top: 1px solid rgba(0,0,0,.05);
                border-bottom: 1px solid rgba(0,0,0,.05);
            }
            .navigation li{
                list-style: none;
                display: inline-block;;
                margin-left: 5px;
                margin-right: 5px;
                font-size: 13px;
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 2px;
            }
            .navigation li a{
                color: rgba(0,0,0,1);
            }

            /*HERO*/
            .hero{
                position: relative;
                z-index: 0;
            }

            .hero .text{
                color: rgba(0,0,0,.3);
            }
            .hero .text h2{
                color: #000;
                font-size: 30px;
                margin-bottom: 0;
                font-weight: 300;
            }
            .hero .text h2 span{
                font-weight: 600;
                color: #f85e9f;
            }


            /*HEADING SECTION*/
            .heading-section{
            }
            .heading-section h2{
                color: #000000;
                font-size: 28px;
                margin-top: 0;
                line-height: 1.4;
                font-weight: 400;
            }
            .heading-section .subheading{
                margin-bottom: 20px !important;
                display: inline-block;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 2px;
                color: rgba(0,0,0,.4);
                position: relative;
            }
            .heading-section .subheading::after{
                position: absolute;
                left: 0;
                right: 0;
                bottom: -10px;
                content: "";
                width: 100%;
                height: 2px;
                background: #f85e9f;
                margin: 0 auto;
            }

            .heading-section-white{
                color: rgba(255,255,255,.8);
            }
            .heading-section-white h2{
                font-family: 
                line-height: 1;
                padding-bottom: 0;
            }
            .heading-section-white h2{
                color: #ffffff;
            }
            .heading-section-white .subheading{
                margin-bottom: 0;
                display: inline-block;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 2px;
                color: rgba(255,255,255,.4);
            }


            ul.social{
                padding: 0;
            }
            ul.social li{
                display: inline-block;
                margin-right: 10px;
            }

            /*FOOTER*/

            .footer{
                border-top: 1px solid rgba(0,0,0,.05);
                color: rgba(0,0,0,.5);
            }
            .footer .heading{
                color: #000;
                font-size: 20px;
            }
            .footer ul{
                margin: 0;
                padding: 0;
            }
            .footer ul li{
                list-style: none;
                margin-bottom: 10px;
            }
            .footer ul li a{
                color: rgba(0,0,0,1);
            }
            </style>


            </head>

            <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
                <center style="width: 100%; background-color: #ffffff;">
                <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
                  &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                </div>
                <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                    <!-- BEGIN BODY -->
                  <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                    <tr>
                        <td>Ref: BBL/HO/L & R/2022/</td>
                    </tr>
                    <tr>
                        <td>'.date('Y-M-d').'</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>'.$lawyer_data->name.'</b></td>
                    </tr>
                    <tr>
                        <td><b>Adv. Address:'.$lawyer_data->chamber.'</b></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>RE: Legal action against the defaulter Client/s under ';
                    if($application_data->req_type==1)
                    {
                        $html.='<b>Negotiable Instruments Act 1881.</b>';
                    }
                    else
                    {
                        $html.='<b>Artha Rin Adalot Ain-2003.</b>';
                    }
                    $html.='</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Dear Sir,    </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Greetings from BRAC Bank PLC.!</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Please be informed that BBL has extended loan facilities to the following borrower/s vide details of provided copies of documents. In the meantime, the client/s became as defaulter and has failed to take any positive steps to settle the outstanding with BBL.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <table cellspacing="2" cellpadding="2" border="1" width="100%" style="text-align:center;">
                                ';
                    if($bulk==NULL && $application_data->req_type==2)
                    {
                        $html.='<tr style="background:#E6B8B7;font-weight: bold;">
                                    <td>SL</td>
                                    <td>Loan A/C No</td>
                                    <td>Loan A/C Name</td>
                                    <td>ARA Balance</td>
                                </tr>';
                        $html.='<tr style="background:#E6B8B7;font-weight: bold;">
                                    <td>1</td>
                                    <td>'.$application_data->loan_ac.'</td>
                                    <td>'.$application_data->ac_name.'</td>
                                    <td>'.$application_data->st_belance.'</td>
                                </tr>';
                    }
                    if($bulk==NULL && $application_data->req_type==1)
                    {
                        $html.='<tr style="background:#E6B8B7;font-weight: bold;">
                                    <td>Loan A/C No</td>
                                    <td>A/C Name</td>
                                    <td>Cheque Number</td>
                                    <td>Dishonor Date</td>
                                    <td>Cheque Amount</td>
                                </tr>';
                        $html.='<tr style="background:#E6B8B7;font-weight: bold;">
                                    <td>'.$application_data->loan_ac.'</td>
                                    <td>'.$application_data->ac_name.'</td>
                                    <td>'.$application_data->chq_number.'</td>
                                    <td>'.$application_data->l_dishonor_dt.'</td>
                                    <td>'.$application_data->chq_amount.'</td>
                                </tr>';
                    }
                                
                $html.='</table>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>In the view of the above situations, we request you to initiate legal action on behalf of BBL under <b>';
                    if($application_data->req_type==1)
                    {
                        $html.='<b>Negotiable Instruments Act 1881 </b>against the mentioned defaulter client/s.';
                    }
                    else
                    {
                        $html.='<b>Artha Rin Adalot Ain-2003 </b>against the mentioned defaulter client/s.';
                    }
                    $html.='</tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Kindly communicate with our assigned official <b>'.$application_data->legal_user_name.', Cell: '.$application_data->mobile_number.' </b> if you need any documents or have any queries. </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Thank you so much for your continued support to BBL.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td><img src="cid:my-attach" alt=""></td>
                    </tr>
                    <tr>
                        <td>_________________________________</td>
                    </tr>
                    <tr>
                        <td><b>Mustafizur Rahman</b></td>
                    </tr>
                    <tr>
                        <td>Senior Manager </td>
                    </tr>
                    <tr>
                        <td>Head of Central Region</td>
                    </tr>
                    <tr>
                        <td>Litigation Management Department</td>
                    </tr>
                    <tr>
                        <td>Legal & Recovery Division</td>
                    </tr>
                    <tr>
                        <td>BRAC Bank PLC.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    
                  </table>
                  
                </div>
              </center>
            </body>
            </html>
        ';
        return $html;
    }
    function delete_action_recase($id=NULL,$bulk=NULL,$type=NULL)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if(isset($_POST['type']) && $this->input->post('type')=='delete'){
            $pre_action_result=$this->Common_model->get_pre_action_data('suit_filling_info',$_POST['deleteEventId'],0,'sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('d_reason'=>trim($_POST['comments']), 'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('suit_filling_info', $data);
                 //Delete Expenses
                $expense_data = array('sts' => 0);
                 $this->db->where('event_id',$_POST['deleteEventId']);
                 $this->db->where('module_name',"Suit File");
                 $this->db->update('expenses', $expense_data);
                $data2 = $this->user_model->user_activities(15,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Delete Recase File Info('.$this->input->post('deleteEventId').')',$_POST['comments']);
            }
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='ho_delete'){
            $pre_action_result=$this->Common_model->get_pre_action_data('suit_filling_info',$_POST['deleteEventId'],0,'sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                //Checking first any action taken with cost data 
                $str="SELECT  j0.*
                             FROM cost_details j0
                         WHERE (j0.legal_select_sts!=0 OR j0.memo_sts!=0 OR j0.court_fee_return_sts!=0 OR j0.adjustment_sts IS NOT NULL OR (j0.bill_id IS NOT NULL AND j0.bill_id!=0)) AND j0.main_table_name='suit_filling_info' AND j0.main_table_id= '".$this->input->post('deleteEventId')."'";
                $application_data=$this->db->query($str)->result();
                if(!empty($application_data))
                {
                    return 'bill taken';
                }
                $data = array('d_reason'=>trim($_POST['comments']), 'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('suit_filling_info', $data);
                ///making previous case alive
                $str="SELECT  j0.pre_suit_id,j0.both_case_sts
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                $application_data=$this->db->query($str)->row();
                if($application_data->both_case_sts==0)
                {
                    $data4 = array('merged_with' => '','final_remarks' => 1,'suit_sts' => 75,'merged_sts' => 0,'sts' => 1,'ac_close_by'=> '', 'ac_close_dt'=>'');
                    $this->db->where('id', $application_data->pre_suit_id);
                    $this->db->update('suit_filling_info', $data4);
                }
                 //Delete Expenses
                $expense_data = array('sts' => 0);
                 $this->db->where('event_id',$_POST['deleteEventId']);
                 $this->db->where('module_name',"Suit File");
                 $this->db->update('expenses', $expense_data);

                //Delete Case Status
                 $data = array('sts' => 0,'d_reason'=>$this->input->post('comments'),'d_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
                 $this->db->where('suit_file_id', $_POST['deleteEventId']);
                $this->db->update('change_request', $data);
                //Delete Cost Data
                $str="SELECT  j0.*
                             FROM cost_details j0
                         WHERE j0.main_table_name='suit_filling_info' AND j0.main_table_id= '".$this->input->post('deleteEventId')."'";
                $application_data=$this->db->query($str)->result();
                //$final_data = array();
                if(!empty($application_data))
                {
                    foreach ($application_data as $key => $value) {
                        $data=array();
                        foreach($value as $keyIn => $value2) {
                            if($keyIn=='id')
                            {
                                $data['org_id'] = $value2;
                            }
                            else
                            {
                                $data[$keyIn] = $value2;
                            }
                            
                        }
                        $data['d_by'] = $this->session->userdata['ast_user']['user_id'];
                        $data['d_dt'] = date('Y-m-d H:i:s');
                        $data['d_reason'] = $this->input->post('comments');
                        $this->db->insert('cost_details_deleted', $data);
                    }
                    $str="DELETE 
                             FROM cost_details j0
                         WHERE j0.main_table_name='suit_filling_info' AND j0.main_table_id= '".$this->input->post('deleteEventId')."'";
                    $application_data=$this->db->query($str);
                }
                $data2 = $this->user_model->user_activities(15,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Delete Recase File Info('.$this->input->post('deleteEventId').')',$_POST['comments']);
            }
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='confirm'){
            $pre_action_result=$this->Common_model->get_pre_action_data('suit_filling_info',$_POST['deleteEventId'],'75','suit_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data2 = array('suit_sts' => 75,'confirm_by'=> $this->session->userdata['ast_user']['user_id'], 'confirm_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('suit_filling_info', $data2);
                $str="SELECT  j0.case_number,j0.cif,j0.merge_case_sts,j0.e_dt,j0.e_by,j0.req_type,j0.both_case_sts,j0.pre_suit_id,j0.loan_ac,j0.org_loan_ac,j0.ac_name,j0.loan_segment,j0.region,j0.territory,j0.district,j0.id,j0.proposed_type
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                $count=0;//Fixed for borower 3 address
                $application_data=$this->db->query($str)->row();
                //Checking previous case running or not if not running the close it
                if($application_data->both_case_sts==0 && $application_data->merge_case_sts==1)
                {
                    $str="SELECT  j0.final_remarks
                                 FROM suit_filling_info j0
                             WHERE j0.id= '".$application_data->pre_suit_id."' LIMIT 1";
                    $pre_suit_data=$this->db->query($str)->row();
                    if($pre_suit_data->final_remarks==1)
                    {
                        $data4 = array('merged_with' => $this->input->post('deleteEventId'),'final_remarks' => 2,'suit_sts' => 76,'merged_sts' => 1,'sts' => 0,'ac_close_by'=> $application_data->e_by, 'ac_close_dt'=>date('Y-m-d H:i:s'));
                    }
                    else
                    {
                        $data4 = array('merged_with' => $this->input->post('deleteEventId'),'merged_sts' => 1,'sts' => 0);
                    }
                    $this->db->where('id', $application_data->pre_suit_id);
                    $this->db->update('suit_filling_info', $data4);
                }
                ////////
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
                $case_number = $application_data->case_number;

                //Genereate Package Expenses
                $str="SELECT  j0.*,s.lawyer,IF(s.disbursed_amount IS NULL,0,s.disbursed_amount) as disbursed_amount,s.package_amount
                         FROM package_select_history j0
                         LEFT OUTER JOIN lawyer_package_bill_setup s on(s.id=j0.package_id)
                     WHERE j0.event_table_name='suit_filling_info' AND j0.amount_selection=1 AND j0.event_id= '".$this->input->post('deleteEventId')."' LIMIT 1";   
                $package_data=$this->db->query($str)->row();
                if (!empty($package_data)) {
                    $total_disbursed_amount = $package_data->disbursed_amount+$package_data->amount;
                    if($total_disbursed_amount>$package_data->package_amount)
                    {
                        return 'limitcrossed';
                    }
                    if($total_disbursed_amount==$package_data->package_amount)
                    {
                        $disbursed_sts = 1;
                    }
                    else
                    {
                        $disbursed_sts = 0;
                    }
                    //update total disbursed amount
                    $data = array('disbursed_amount' => $total_disbursed_amount,'disbursed_sts' => $disbursed_sts);
                    $this->db->where('id', $package_data->package_id);
                    $this->db->update('lawyer_package_bill_setup', $data);

                    $cost_data = array(
                            'module_name' => 'suit_file',
                            'main_table_name' => 'suit_filling_info',
                            'main_table_id' => $this->input->post('deleteEventId'),
                            'sub_table_name' => 'package_select_history',
                            'sub_table_id' => $package_data->id,
                            'suit_id' => $this->input->post('deleteEventId'),
                            'activities_id' => $package_data->activities_id,
                            'package_id' => $package_data->package_id,
                            'vendor_type' => 1,
                            'vendor_id' => $package_data->lawyer,
                            'amount' =>$package_data->amount,
                            'txrn_dt' => $application_data->e_dt,
                            'loan_ac' =>$loan_ac,
                            'cif' =>$cif,
                            'org_loan_ac' =>$org_loan_ac,
                            'ac_name' =>$ac_name,
                            'req_type' =>$req_type,
                            'proposed_type' =>$proposed_type,
                            'loan_segment' =>$loan_segment,
                            'case_number' =>$case_number,
                            'region' =>$region,
                            'territory' =>$territory,
                            'district' =>$district
                        );
                    $data3=$this->user_model->cost_details($cost_data);
                    
                }

                //Genereate Expenses
                $str="SELECT  j0.*
                         FROM expenses j0
                     WHERE j0.sts != '0'  AND j0.event_id= '".$this->input->post('deleteEventId')."' AND j0.module_name='Suit File'";   
                $expense_data=$this->db->query($str)->result();
                if (!empty($expense_data)) {
                        foreach ($expense_data as $key) {
                            $cost_data = array(
                            'module_name' => 'suit_file',
                            'main_table_name' => 'suit_filling_info',
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
                            'loan_ac' =>$loan_ac,
                            'cif' =>$cif,
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
                        if ($key->package_select_sts==0) { //skipping the package selected bill
                            $data3=$this->user_model->cost_details($cost_data);
                        }
                    }
                    //Verify Expenses
                    $expense_data = array('v_sts' => 38);
                     $this->db->where('event_id',$_POST['deleteEventId']);
                     $this->db->where('module_name',"Suit File");
                     $this->db->update('expenses', $expense_data);
                }
                $data3 = $this->user_model->user_activities(75,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Suit File Confirmed by legal('.$this->input->post('deleteEventId').')');
            }
            $id = $_POST['deleteEventId'];
            
        }
        if(isset($_POST['type']) && $this->input->post('type')=='updatenextdate'){
            $data['module_name'] = 'suit_file';
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
            $this->db->update('suit_filling_info', $data4);
            $data3 = $this->user_model->user_activities(92,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Update Next Date('.$this->input->post('deleteEventId').')');
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='reassign_file'){
            $str="SELECT  j0.temp_deal_officer,j0.prest_court_name,j0.present_plaintiff,j0.case_deal_officer,j0.change_history_id
                     FROM suit_filling_info j0
                 WHERE j0.id= '".$_POST['deleteEventId']."' LIMIT 1";
            $application_data=$this->db->query($str)->row();
            $data = array('suit_id' => $_POST['deleteEventId'],'reason'=> $_POST['reassign_reason'],'pre_legal_user' => $_POST['pre_legal_user'],'prest_legal_user' => $_POST['legal_user'],'e_by'=> $this->session->userdata['ast_user']['user_id'], 'e_dt'=>date('Y-m-d H:i:s'));
            if($_POST['court']!='')//When Court Name Changed
            {
                $data['pre_court'] = $application_data->prest_court_name;
                $data['present_court'] = $_POST['court'];
            }
            $this->db->insert('cma_legal_user_change_history', $data);
            $insert_idss = $this->db->insert_id();

            $data = array('change_history_id' => $insert_idss,'reassign_reason'=> $_POST['reassign_reason'],'suit_sts' => 84,'temp_deal_officer' => $_POST['legal_user'],'reassign_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_dt'=>date('Y-m-d H:i:s'));
            if($_POST['court']!='')//When Court Name Changed
            {
                $data['temp_court'] = $_POST['court'];
            }
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('suit_filling_info', $data);
            

            $data3 = $this->user_model->user_activities(85,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Reassign Legal User('.$this->input->post('deleteEventId').')',$_POST['reassign_reason']);
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='reject_reassign_approval_file'){
            $str="SELECT  j0.change_history_id
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();

            $data = array('temp_deal_officer' =>0,'temp_court' =>0,'temp_lawyer' =>0,'suit_sts' => 75,'reassign_reject_reason'=> $_POST['reject_reason'],'reassign_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_reject_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('suit_filling_info', $data);

            $data = array('sts' =>86,'reassign_reject_reason'=> $_POST['reject_reason'],'reassign_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_reject_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $application_data->change_history_id);
            $this->db->update('cma_legal_user_change_history', $data);

            $data3 = $this->user_model->user_activities(86,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Reassign Approval Reject('.$this->input->post('deleteEventId').')',$_POST['reject_reason']);
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='reassign_approval_file'){
            $str="SELECT  j0.temp_deal_officer,j0.prest_court_name,j0.prest_lawyer_name,j0.temp_court,j0.temp_lawyer,j0.present_plaintiff,j0.case_deal_officer,j0.change_history_id
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();
            $data = array('suit_sts' => 75,'reassign_v_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_v_dt'=>date('Y-m-d H:i:s'));
            if($application_data->temp_deal_officer!='' && $application_data->temp_deal_officer!=NULL && $application_data->temp_deal_officer!=0)
            {
                $data['present_plaintiff'] = $application_data->case_deal_officer;
                $data['prev_plaintiff'] = $application_data->present_plaintiff;
                $data['case_deal_officer'] = $application_data->temp_deal_officer;
                $data['temp_deal_officer'] = 0;
            }
            if($application_data->temp_court!='' && $application_data->temp_court!=NULL && $application_data->temp_court!=0)
            {
                $data['prest_court_name'] = $application_data->temp_court;
                $data['prev_court_name'] = $application_data->prest_court_name;
                $data['temp_court'] = 0;
            }
            if($application_data->temp_lawyer!='' && $application_data->temp_lawyer!=NULL && $application_data->temp_lawyer!=0)
            {
                $data['prest_lawyer_name'] = $application_data->temp_lawyer;
                $data['prev_lawyer_name'] = $application_data->prest_lawyer_name;
                $data['temp_lawyer'] = 0;
            }
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('suit_filling_info', $data);

            $data = array('sts' =>87,'reassign_v_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_v_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $application_data->change_history_id);
            $this->db->update('cma_legal_user_change_history', $data);

            $data3 = $this->user_model->user_activities(87,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','Reassign Approval Approved('.$this->input->post('deleteEventId').')');
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='putup_file'){

            $data = array('suit_id' => $_POST['deleteEventId'],'reason'=> $_POST['putup_comments'],'e_by'=> $this->session->userdata['ast_user']['user_id'], 'e_dt'=>date('Y-m-d H:i:s'));
            $this->db->insert('suit_putup_history', $data);
            $insert_idss = $this->db->insert_id();

            $data = array('put_up_history_id' => $insert_idss,'put_up_reason'=> $_POST['putup_comments'],'suit_sts' => 97,'put_up_by'=> $this->session->userdata['ast_user']['user_id'], 'put_up_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('suit_filling_info', $data);
            

            $data3 = $this->user_model->user_activities(97,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','PUT-UP('.$this->input->post('deleteEventId').')',$_POST['putup_comments']);
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='reject_putup_approval_file'){
            $str="SELECT  j0.put_up_history_id
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();

            $data = array('suit_sts' => 76,'put_up_reject_reason'=> $_POST['reject_reason_putup'],'put_up_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'put_up_reject_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('suit_filling_info', $data);

            $data = array('sts' =>53,'reject_reason'=> $_POST['reject_reason_putup'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $application_data->put_up_history_id);
            $this->db->update('suit_putup_history', $data);

            $data3 = $this->user_model->user_activities(53,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','PUT-UP Approval Reject('.$this->input->post('deleteEventId').')',$_POST['reject_reason_putup']);
            $id = $_POST['deleteEventId'];
        }
        if(isset($_POST['type']) && $this->input->post('type')=='putup_approval_file'){
            $str="SELECT  j0.put_up_history_id
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            $application_data=$this->db->query($str)->row();
            $data = array('suit_sts' =>75,'final_remarks' =>1,'put_up_v_by'=> $this->session->userdata['ast_user']['user_id'], 'put_up_v_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('suit_filling_info', $data);

            $data = array('sts' =>75,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $application_data->put_up_history_id);
            $this->db->update('suit_putup_history', $data);

            $data3 = $this->user_model->user_activities(51,'suit_file',$this->input->post('deleteEventId'),'suit_filling_info','PUT-UP Approval Approved('.$this->input->post('deleteEventId').')');
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
    function get_bulk_data()
    {
        $where2 = "b.sts!='0' and b.life_cycle='4'";
        if ($this->input->post('operation')=='blk_lawyer') 
        {
            $where2.=" AND b.cma_sts IN(61,62,63,67,69) AND b.legal_user = ".$this->session->userdata['ast_user']['user_id']."";
        }
        if ($this->input->post('operation')=='blk_rf') 
        {
            $where2.=" AND b.cma_sts IN(61,62,63,67,69) AND b.legal_user = ".$this->session->userdata['ast_user']['user_id']."";
        }
        if ($this->input->post('operation')=='blk_ack') 
        {
            $where2.=" AND b.cma_sts IN(60,87) AND b.legal_user = ".$this->session->userdata['ast_user']['user_id']."";
        }
        if ($this->input->post('operation')=='blk_rf_approve') 
        {
            $where2.=" AND b.cma_sts IN(84)";
        }
        if($this->input->post('region')!='' && $this->input->post('region')!=0) 
        {$where2.=" AND b.legal_region = '".trim($this->input->post('region'))."'";}
        if($this->input->post('territory')!='' && $this->input->post('territory')!=0) 
        {$where2.=" AND b.territory = '".trim($this->input->post('territory'))."'";}
        if($this->input->post('district')!='' && $this->input->post('district')!=0) 
        {$where2.=" AND b.case_fill_dist = '".trim($this->input->post('district'))."'";}
        if($this->input->post('unit_office')!='' && $this->input->post('unit_office')!=0) 
        {$where2.=" AND b.unit_office = '".trim($this->input->post('unit_office'))."'";}
        if($this->input->post('rec_dt_from') != '' && $this->input->post('rec_dt_from')!=0 && ($this->input->post('rec_dt_to') == '' || $this->input->post('rec_dt_to')==0)) 
        {$where2.=" AND DATE(b.rec_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('rec_dt_from')))))."'";}
        if($this->input->post('rec_dt_from') != '' && $this->input->post('rec_dt_from')!=0 && $this->input->post('rec_dt_to') != '' && $this->input->post('rec_dt_to')!=0) 
        {$where2.=" AND DATE(b.rec_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('rec_dt_from')))))."' AND DATE(b.rec_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('rec_dt_to')))))."'";}
        
        if($this->input->post('loan_segment')!='' && $this->input->post('loan_segment')!='') 
        {$where2.=" AND b.loan_segment = '".trim($this->input->post('loan_segment'))."'";}

        if($this->input->post('req_type')!='' && $this->input->post('req_type')!='') 
        {$where2.=" AND b.req_type = '".trim($this->input->post('req_type'))."'";}

        $this->db
        ->select('b.legal_user,b.id,b.loan_ac,b.ac_name,b.sl_no,s.name as loan_segment,j7.name as region_name,j8.name as territory_name,
        j9.name as district_name,j10.name as unit_office_name,
        CONCAT(j5.name," (",j5.user_id,")")as rec_by,r.name as requisition_name,
        DATE_FORMAT(b.rec_dt,"%d-%b-%y %h:%i %p") AS rec_dt,b.st_belance,b.req_type
        ', FALSE)
            ->from("cma b")
            ->join('users_info as j5', 'b.rec_by=j5.id', 'left')
            ->join('ref_legal_region as j7', 'b.legal_region=j7.id', 'left')
            ->join('ref_territory as j8', 'b.territory=j8.id', 'left')
            ->join('ref_legal_district as j9', 'b.case_fill_dist=j9.id', 'left')
            ->join('ref_unit_office as j10', 'b.unit_office=j10.id', 'left')
            ->join('ref_loan_segment as s', 'b.loan_segment=s.code', 'left')
            ->join('ref_req_type as r', 'b.req_type=r.id', 'left')
            ->where($where2)
            ->order_by('b.id','DESC');
        $q=$this->db->get();
        return $q->result();
    }
    function get_bulk_data_recase()
    {
        $where2 = "b.sts!='0' AND b.re_case_sts=1 AND b.suit_sts IN(64,65)";
        
        if (check_group('2')) //For Legal Maker
        {
            $where2.=" and (b.case_deal_officer='".$this->session->userdata['ast_user']['user_id']."' or b.e_by='".$this->session->userdata['ast_user']['user_id']."')";
        }
        else if (check_group('1')) //For Legal Checker
        {
            $where2.=" and b.legal_region IN(".$this->session->userdata['ast_user']['legal_region'].")";
        }
        else if(check_group('2'))
        {
            if($this->input->post('legal_region') != '')
            {
                $where2.=" AND b.legal_region = '".$this->input->post('legal_region')."'";
            }
            if($this->input->post('legal_district') != '')
            {
                $where2.=" AND b.district = '".$this->input->post('legal_district')."'";
            }
            if($this->input->post('case_deal_officer') != '')
            {
                $where2.=" AND b.case_deal_officer = '".$this->input->post('case_deal_officer')."'";
            }
        }
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') == '') 
        {$where2.=" AND DATE(b.e_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') != '') 
        {$where2.=" AND DATE(b.e_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(b.e_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}

        $this->db
        ->select('b.*,b.e_by as e_by_id,j6.name as status,j7.name as region_name,j8.name as territory_name,
        j9.name as district_name,s.name as loan_segment,
        j1.name as request_type_name,
        CONCAT(j2.name," (",j2.user_id,")")as e_by,
        DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt', FALSE)
            ->from("suit_filling_info b")
            ->join('ref_req_type as j1', 'b.req_type=j1.id', 'left')
            ->join('users_info as j2', 'b.e_by=j2.id', 'left')
            ->join('ref_status as j6', 'b.suit_sts=j6.id', 'left')
            ->join('ref_region as j7', 'b.region=j7.id', 'left')
            ->join('ref_territory as j8', 'b.territory=j8.id', 'left')
            ->join('ref_legal_district as j9', 'b.district=j9.id', 'left')
            ->join('users_info as j12', 'b.legal_user=j12.id', 'left')
            ->join('ref_loan_segment as s', 'b.loan_segment=s.code', 'left')
            ->where($where2)
            ->order_by('b.id','DESC');
        $q=$this->db->get();
        return $q->result();
    }
    function add_edit_suit_filling()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $arji_copy = $this->get_file_name('arji_copy','cma_file/arji_copy/');
        $cma_data = $this->get_cma_info_edit($this->input->post('hidden_cma_id'));
        $data = array(
            'proposed_type' =>$cma_data->proposed_type,
            'cif' =>$cma_data->cif,
            'loan_ac' =>$cma_data->loan_ac,
            'org_loan_ac' =>$cma_data->org_loan_ac,
            'ac_name' =>$cma_data->ac_name,
            'legal_user' =>$cma_data->legal_user,
            'req_type' =>$cma_data->req_type,
            'branch_sol' =>$cma_data->branch_sol,
            'loan_segment' =>$cma_data->loan_segment,
            'region' =>$cma_data->region,
            'territory' =>$cma_data->territory,
            'district' =>$cma_data->district,
            'cma_district' =>$cma_data->cma_district,
            'outstanding_bl' =>$cma_data->outstanding_bl,
            'recovery_am' =>$cma_data->rec_by,
            'unit_office' =>$cma_data->unit_office,
            'legal_region' =>$cma_data->legal_region,
            'customer_id' =>$cma_data->customer_id,
            'mobile_no' =>$cma_data->mobile_no,
            'more_acc_number' =>$cma_data->more_acc_number,
            'final_remarks' =>1,
            'cma_id' =>$this->security->xss_clean( $this->input->post('hidden_cma_id')),
            //'case_name' =>$this->security->xss_clean( $this->input->post('case_name')),
            'arji_copy' =>$arji_copy,
            'case_number' =>$this->security->xss_clean( $this->input->post('case_prefix')).'-'.$this->security->xss_clean( $this->input->post('case_number')).'/'.$this->security->xss_clean( $this->input->post('case_year')),
            'case_claim_amount' =>$this->security->xss_clean( $this->input->post('case_claim_amount')),
            'judge_name' =>$this->security->xss_clean( $this->input->post('judge_name')),
            'judge_phone' =>$this->security->xss_clean( $this->input->post('judge_phone')),
            'prev_date' =>implode('-',array_reverse(explode('/',$this->input->post('prev_date')))),
            'initial_case_sts_dt' =>implode('-',array_reverse(explode('/',$this->input->post('prev_date')))),
            'initial_case_sts' =>$this->security->xss_clean( $this->input->post('case_sts_prev_dt')),
            'case_sts_prev_dt' =>$this->security->xss_clean( $this->input->post('case_sts_prev_dt')),
            'next_dt_sts' =>$this->security->xss_clean( $this->input->post('next_dt_sts_value')),
            'case_sts_next_dt' =>$this->security->xss_clean( $this->input->post('case_sts_next_dt')),
            'remarks_next_date' =>$this->security->xss_clean( $this->input->post('remarks_next_date')),
            'filling_plaintiff' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
            'filling_date' =>implode('-',array_reverse(explode('/',$this->input->post('filling_date')))),
            'present_plaintiff' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
            'case_deal_officer' =>$this->security->xss_clean( $this->input->post('case_deal_officer')),
            'prev_lawyer_name' =>$this->security->xss_clean( $this->input->post('prev_lawyer_name')),
            'prest_lawyer_name' =>$this->security->xss_clean( $this->input->post('prest_lawyer_name')),
            'prev_court_name' =>$this->security->xss_clean( $this->input->post('prev_court_name')),
            'prest_court_name' =>$this->security->xss_clean( $this->input->post('prest_court_name'))
        );
        if ($_POST['next_dt_sts_value']==1) {
            $data['next_date'] =implode('-',array_reverse(explode('/',$this->input->post('next_date'))));
        }
        else
        {
            $sys_config= $this->User_info_model->upr_config_row();
            $data['next_date'] = $sys_config->next_dt_text;
        }
        //'subscription_date'=>implode('-',array_reverse(explode('/',$this->input->post('subscription_date')))),
        //For ADD Suit Filling Input
        if ($this->input->post('add_edit')=='add') {
            $data['e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['e_dt'] = date('Y-m-d H:i:s');
            $data['suit_sts'] = 64;
            $this->db->insert('suit_filling_info', $data);
            $insert_idss = $this->db->insert_id();
            $this->Common_model->add_expense($insert_idss,'Suit File');
            //for package bill amount
            if(isset($_POST['package_sts']) && $_POST['package_sts']==1)
            {

                $package_data = array(
                        'package_id' =>$this->security->xss_clean( $this->input->post('package_id')),
                        'event_id' =>$insert_idss,
                        'event_table_name' =>'suit_filling_info',
                        'activities_id' =>$this->security->xss_clean( $this->input->post('activities_name_package')),
                        'amount' =>$this->security->xss_clean( $this->input->post('package_bill_amount')),
                        'amount_selection' =>($this->security->xss_clean( $this->input->post('package_amount'))=='with_amount')?1:0
                );
                $this->db->insert('package_select_history', $package_data);
            }
            $data = array('cma_sts' => 64);
            $this->db->where('id', $_POST['hidden_cma_id']);
            $this->db->update('cma', $data);
            $data2 = $this->user_model->user_activities(64,'suit_file',$insert_idss,'suit_filling_info','Suit Filling Info Added('.$insert_idss.')');
        }
        else //For Update Existing Suit Filling Info for this CMA
        {
            $edit_id = $this->input->post('edit_id');
            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $edit_id);
            $this->db->update('suit_filling_info', $data);
            $insert_idss = $edit_id;

            $this->Common_model->edit_expense($insert_idss,'Suit File');
            //for package bill amount
            if(isset($_POST['package_sts']) && $_POST['package_sts']==1)
            {

                $package_data = array(
                        'package_id' =>$this->security->xss_clean( $this->input->post('package_id')),
                        'event_id' =>$insert_idss,
                        'event_table_name' =>'suit_filling_info',
                        'activities_id' =>$this->security->xss_clean( $this->input->post('activities_name_package')),
                        'amount' =>$this->security->xss_clean( $this->input->post('package_bill_amount')),
                        'amount_selection' =>($this->security->xss_clean( $this->input->post('package_amount'))=='with_amount')?1:0
                );
                $this->db->where('id', $_POST['package_history_id']);
                $this->db->update('package_select_history', $package_data);
            }
            $data2 = $this->user_model->user_activities(65,'suit_file',$this->input->post('edit_id'),'suit_filling_info','Suit Filling Info Updated('.$this->input->post('edit_id').')');
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
    function add_edit_suit_filling_after_verify()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $arji_copy = $this->get_file_name('arji_copy','cma_file/arji_copy/');
        $data = array(
            'arji_copy' =>$arji_copy,
            'case_number' =>$this->security->xss_clean( $this->input->post('case_prefix')).'-'.$this->security->xss_clean( $this->input->post('case_number')).'/'.$this->security->xss_clean( $this->input->post('case_year')),
            'case_claim_amount' =>$this->security->xss_clean( $this->input->post('case_claim_amount')),
            'judge_name' =>$this->security->xss_clean( $this->input->post('judge_name')),
            'judge_phone' =>$this->security->xss_clean( $this->input->post('judge_phone')),
            'initial_case_sts_dt' =>implode('-',array_reverse(explode('/',$this->input->post('prev_date')))),
            'initial_case_sts' =>$this->security->xss_clean( $this->input->post('case_sts_prev_dt')),
            'filling_plaintiff' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
            'next_dt_sts' =>$this->security->xss_clean( $this->input->post('next_dt_sts_value')),
            'case_sts_next_dt' =>$this->security->xss_clean( $this->input->post('case_sts_next_dt')),
            'remarks_next_date' =>$this->security->xss_clean( $this->input->post('remarks_next_date')),
            'filling_date' =>implode('-',array_reverse(explode('/',$this->input->post('filling_date')))),
            'case_deal_officer' =>$this->security->xss_clean( $this->input->post('case_deal_officer')),
            'prest_lawyer_name' =>$this->security->xss_clean( $this->input->post('prest_lawyer_name')),
            'prest_court_name' =>$this->security->xss_clean( $this->input->post('prest_court_name'))
        );
        if ($_POST['next_dt_sts_value']==1) {
            $data['next_date'] =implode('-',array_reverse(explode('/',$this->input->post('next_date'))));
        }
        else
        {
            $sys_config= $this->User_info_model->upr_config_row();
            $data['next_date'] = $sys_config->next_dt_text;
        }
        $edit_id = $this->input->post('edit_id');
        $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
        $data['u_dt'] = date('Y-m-d H:i:s');
        $this->db->where('id', $edit_id);
        $this->db->update('suit_filling_info', $data);
        $insert_idss = $edit_id;
        //updating the bill information
        $str="SELECT  j0.id
                 FROM expenses j0
             WHERE j0.sts != '0'  AND j0.event_id= '".$insert_idss."' AND j0.module_name='Suit File'";   
        $expense_data=$this->db->query($str)->result();
        if(!empty($expense_data))
        {
            foreach($expense_data as $key)
            {
                $expense_data = array(
                    'case_number' =>$this->security->xss_clean( $this->input->post('case_prefix')).'-'.$this->security->xss_clean( $this->input->post('case_number')).'/'.$this->security->xss_clean( $this->input->post('case_year')),
                    'vendor_id' =>$this->security->xss_clean( $this->input->post('prest_lawyer_name'))
                );
                $this->db->where('id', $key->id);
                $this->db->update('expenses', $expense_data);
            }
        }
        //updating the bill information
        $str="SELECT  j0.id
                 FROM cost_details j0
             WHERE (j0.memo_sts=0 or j0.memo_sts IS NULL) AND j0.vendor_type=1 AND j0.main_table_name='suit_filling_info' AND j0.module_name='suit_file' AND (j0.main_table_id='".$insert_idss."' OR j0.suit_id='".$insert_idss."')";   
        $expense_data=$this->db->query($str)->result();
        if(!empty($expense_data))
        {
            foreach($expense_data as $key)
            {
                $expense_data = array(
                    'case_number' =>$this->security->xss_clean( $this->input->post('case_prefix')).'-'.$this->security->xss_clean( $this->input->post('case_number')).'/'.$this->security->xss_clean( $this->input->post('case_year')),
                    'vendor_id' =>$this->security->xss_clean( $this->input->post('prest_lawyer_name'))
                );
                $this->db->where('id', $key->id);
                $this->db->update('cost_details', $expense_data);
            }
        }
        $data2 = $this->user_model->user_activities(65,'suit_file',$this->input->post('edit_id'),'suit_filling_info','Suit Filling Info Updated('.$this->input->post('edit_id').')');
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
    function get_prev_filling_date($suit_id)
    {
        $prev_filling_date="";
        $data2=array();
        $suit_id = $suit_id;
        while(1)
        {
            if($suit_id == 0)
            {
                break;
            }
            $str="SELECT  j0.filling_date,j0.pre_suit_id
                         FROM suit_filling_info j0
                     WHERE (j0.sts<>0 OR (j0.sts=0 AND j0.merged_sts=1)) AND j0.id='".$suit_id."' LIMIT 1";
            $pre_suit_data=$this->db->query($str)->row();
            if(!empty($pre_suit_data))
            {
                if($prev_filling_date=='')
                {
                    $prev_filling_date.=$pre_suit_data->filling_date;
                }
                else
                {
                    $prev_filling_date.=', '.$pre_suit_data->filling_date;
                }
                if($pre_suit_data->pre_suit_id!=0 && $pre_suit_data->pre_suit_id!=NULL && $pre_suit_data->pre_suit_id!='')
                {
                    $suit_id = $pre_suit_data->pre_suit_id;
                }
                else
                {
                    $suit_id = 0;
                }
            }
            else
            {
                $suit_id =0;
            }
        }
        return $prev_filling_date;
    }
    function add_edit_recase_filling()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = true; // off display of db error
        $this->db->trans_begin(); // transaction start
        $suit_data = $this->get_suit_info($this->input->post('hidden_pre_suit_id'));
        if($this->input->post('merge_case_sts')==1)
        {
            $case_number = $suit_data->case_number.'('.$this->security->xss_clean( $this->input->post('case_prefix')).'-'.$this->security->xss_clean( $this->input->post('case_number')).'/'.$this->security->xss_clean( $this->input->post('case_year')).')';
        }
        else
        {
            $case_number = $this->security->xss_clean( $this->input->post('case_prefix')).'-'.$this->security->xss_clean( $this->input->post('case_number')).'/'.$this->security->xss_clean( $this->input->post('case_year'));
        }
        $data = array(
            'proposed_type' =>$suit_data->proposed_type,
            'cif' =>$suit_data->cif,
            'loan_ac' =>$suit_data->loan_ac,
            'org_loan_ac' =>$suit_data->org_loan_ac,
            'ac_name' =>$suit_data->ac_name,
            'legal_user' =>$suit_data->legal_user,
            'req_type' =>$suit_data->req_type,
            'branch_sol' =>$suit_data->branch_sol,
            'loan_segment' =>$suit_data->loan_segment,
            'region' =>$suit_data->region,
            'territory' =>$suit_data->territory,
            'district' =>$suit_data->district,
            'cma_district' =>$suit_data->cma_district,
            'outstanding_bl' =>$suit_data->outstanding_bl,
            'recovery_am' =>$suit_data->recovery_am,
            'unit_office' =>$suit_data->unit_office,
            'legal_region' =>$suit_data->legal_region,
            'customer_id' =>$suit_data->customer_id,
            'mobile_no' =>$suit_data->mobile_no,
            'more_acc_number' =>$suit_data->more_acc_number,
            'final_remarks' =>1,
            'cma_id' =>$this->security->xss_clean( $this->input->post('hidden_cma_id')),
            'pre_suit_id' =>$this->security->xss_clean( $this->input->post('hidden_pre_suit_id')),
            'prev_filling_date' =>$this->get_prev_filling_date($this->input->post('hidden_pre_suit_id')),
            'case_name' =>$this->security->xss_clean( $this->input->post('case_name')),
            'case_number' =>$case_number,
            'prev_date' =>implode('-',array_reverse(explode('/',$this->input->post('prev_date')))),
            'initial_case_sts_dt' =>implode('-',array_reverse(explode('/',$this->input->post('prev_date')))),
            'initial_case_sts' =>$this->security->xss_clean( $this->input->post('case_sts_prev_dt')),
            'case_sts_prev_dt' =>$this->security->xss_clean( $this->input->post('case_sts_prev_dt')),
            'case_claim_amount' =>$this->security->xss_clean( $this->input->post('case_claim_amount')),
            'next_dt_sts' =>$this->security->xss_clean( $this->input->post('next_dt_sts_value')),
            'both_case_sts' =>$this->security->xss_clean( $this->input->post('both_case_sts')),
            'merge_case_sts' =>$this->security->xss_clean( $this->input->post('merge_case_sts')),
            'case_sts_next_dt' =>$this->security->xss_clean( $this->input->post('case_sts_next_dt')),
            'remarks_next_date' =>$this->security->xss_clean( $this->input->post('remarks_next_date')),
            'remarks' =>$this->security->xss_clean( $this->input->post('remarks_next_date')),
            'filling_plaintiff' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
            'present_plaintiff' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
            'case_deal_officer' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
            'filling_date' =>implode('-',array_reverse(explode('/',$this->input->post('filling_date')))),
            'prest_lawyer_name' =>$this->security->xss_clean( $this->input->post('prest_lawyer_name')),
            'prest_court_name' =>$this->security->xss_clean( $this->input->post('prest_court_name'))
        );
        if ($_POST['next_dt_sts_value']==1) {
            $data['next_date'] =implode('-',array_reverse(explode('/',$this->input->post('next_date'))));
        }
        else
        {
            $sys_config= $this->User_info_model->upr_config_row();
            $data['next_date'] = $sys_config->next_dt_text;
        }
        //'subscription_date'=>implode('-',array_reverse(explode('/',$this->input->post('subscription_date')))),
        //For ADD Suit Filling Input
        if ($this->input->post('add_edit')=='add') {
            $data['re_case_sts'] = 1;
            $data['e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['e_dt'] = date('Y-m-d H:i:s');
            $data['suit_sts'] = 64;
            $this->db->insert('suit_filling_info', $data);
            $insert_idss = $this->db->insert_id();
            $this->Common_model->add_expense($insert_idss,'Suit File');
            //for package bill amount
            if(isset($_POST['package_sts']) && $_POST['package_sts']==1)
            {

                $package_data = array(
                        'package_id' =>$this->security->xss_clean( $this->input->post('package_id')),
                        'event_id' =>$insert_idss,
                        'event_table_name' =>'suit_filling_info',
                        'activities_id' =>$this->security->xss_clean( $this->input->post('activities_name_package')),
                        'amount' =>$this->security->xss_clean( $this->input->post('package_bill_amount')),
                        'amount_selection' =>($this->security->xss_clean( $this->input->post('package_amount'))=='with_amount')?1:0
                );
                $this->db->insert('package_select_history', $package_data);
            }
            $data2 = $this->user_model->user_activities(64,'suit_file',$insert_idss,'suit_filling_info','Suit Filling Info Added('.$insert_idss.')');
        }
        else //For Update Existing Suit Filling Info for this CMA
        {
            $edit_id = $this->input->post('edit_id');
            $this->Common_model->edit_expense($edit_id,'Suit File');
            //for package bill amount
            if(isset($_POST['package_sts']) && $_POST['package_sts']==1)
            {

                $package_data = array(
                        'package_id' =>$this->security->xss_clean( $this->input->post('package_id')),
                        'event_id' =>$edit_id,
                        'event_table_name' =>'suit_filling_info',
                        'activities_id' =>$this->security->xss_clean( $this->input->post('activities_name_package')),
                        'amount' =>$this->security->xss_clean( $this->input->post('package_bill_amount')),
                        'amount_selection' =>($this->security->xss_clean( $this->input->post('package_amount'))=='with_amount')?1:0
                );
                $this->db->where('id', $_POST['package_history_id']);
                $this->db->update('package_select_history', $package_data);
            }
            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $edit_id);
            $this->db->update('suit_filling_info', $data);
            $insert_idss = $edit_id;

            
            $data2 = $this->user_model->user_activities(65,'suit_file',$this->input->post('edit_id'),'suit_filling_info','Suit Filling Info Updated('.$this->input->post('edit_id').')');
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
    function add_edit_recase_filling_after_verify()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $suit_data = $this->get_suit_info($this->input->post('hidden_pre_suit_id'));
        if($this->input->post('merge_case_sts')==1)
        {
            $case_number = $suit_data->case_number.'('.$this->security->xss_clean( $this->input->post('case_prefix')).'-'.$this->security->xss_clean( $this->input->post('case_number')).'/'.$this->security->xss_clean( $this->input->post('case_year')).')';
        }
        else
        {
            $case_number = $this->security->xss_clean( $this->input->post('case_prefix')).'-'.$this->security->xss_clean( $this->input->post('case_number')).'/'.$this->security->xss_clean( $this->input->post('case_year'));
        }
        $data = array(
            'case_number' =>$case_number,
            'initial_case_sts_dt' =>implode('-',array_reverse(explode('/',$this->input->post('prev_date')))),
            'initial_case_sts' =>$this->security->xss_clean( $this->input->post('case_sts_prev_dt')),
            'case_claim_amount' =>$this->security->xss_clean( $this->input->post('case_claim_amount')),
            'filling_plaintiff' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
            'case_deal_officer' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
            'filling_date' =>implode('-',array_reverse(explode('/',$this->input->post('filling_date')))),
            'prest_lawyer_name' =>$this->security->xss_clean( $this->input->post('prest_lawyer_name')),
            'prest_court_name' =>$this->security->xss_clean( $this->input->post('prest_court_name'))
        );
        $edit_id = $this->input->post('edit_id');
        $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
        $data['u_dt'] = date('Y-m-d H:i:s');
        $this->db->where('id', $edit_id);
        $this->db->update('suit_filling_info', $data);
        $insert_idss = $edit_id;
        //updating the bill information
        $str="SELECT  j0.id
                 FROM expenses j0
             WHERE j0.sts != '0'  AND j0.event_id= '".$insert_idss."' AND j0.module_name='Suit File'";   
        $expense_data=$this->db->query($str)->result();
        if(!empty($expense_data))
        {
            foreach($expense_data as $key)
            {
                $expense_data = array(
                    'case_number' =>$case_number,
                    'vendor_id' =>$this->security->xss_clean( $this->input->post('prest_lawyer_name'))
                );
                $this->db->where('id', $key->id);
                $this->db->update('expenses', $expense_data);
            }
        }
        //updating the bill information
        $str="SELECT  j0.id
                 FROM cost_details j0
             WHERE (j0.memo_sts=0 or j0.memo_sts IS NULL) AND j0.vendor_type=1 AND j0.main_table_name='suit_filling_info' AND j0.module_name='suit_file' AND (j0.main_table_id='".$insert_idss."' OR j0.suit_id='".$insert_idss."')";   
        $expense_data=$this->db->query($str)->result();
        if(!empty($expense_data))
        {
            foreach($expense_data as $key)
            {
                $expense_data = array(
                    'case_number' =>$case_number,
                    'vendor_id' =>$this->security->xss_clean( $this->input->post('prest_lawyer_name'))
                );
                $this->db->where('id', $key->id);
                $this->db->update('cost_details', $expense_data);
            }
        }
        $data2 = $this->user_model->user_activities(65,'suit_file',$this->input->post('edit_id'),'suit_filling_info','Suit Filling Info Updated('.$this->input->post('edit_id').')');
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
    function get_r_history($id,$type=Null) // get data for edit
    {
        if($id!=''){
            if ($type=='life_cycle') {
                $where='';
            }
            else
            {
                $where="AND(r.activities_id=7 || r.activities_id=4 || r.activities_id=5 || r.activities_id=8 || r.activities_id=9 || r.activities_id=11 || r.activities_id=12 || r.activities_id=90)";
            }
            $str=" SELECT r.description_activities as oprs_descriptions,r.oprs_reason,s.name as oprs_sts,DATE_FORMAT(r.activities_datetime,'%d-%b-%y %h:%i %p') AS oprs_dt,CONCAT(u.name,' (',u.user_id,')') as r_by
            FROM user_activities_history as r
            LEFT OUTER JOIN users_info u ON u.id=r.activities_by
            LEFT OUTER JOIN ref_status s ON s.id=r.activities_id
            WHERE r.table_row_id= ".$this->db->escape($id)." AND r.table_name='suit_filling_info' AND r.section_name='suit_file'  ".$where."  ORDER BY r.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_suit_filling_info($id)
    {
        if($id!=''){
                $this->db
                ->select("b.*", FALSE)
                ->from("suit_filling_info b")
                ->where("b.cma_id='".$id."'", NULL, FALSE)
                ->limit(1);
            $data = $this->db->get()->row();
        return $data;
        }
        else{return NULL;}
    }
    function get_expenese_info($id)
    {
        if($id!=''){
                $this->db
                ->select("b.*", FALSE)
                ->from("expenses b")
                ->where("b.event_id='".$id."' AND b.module_name='Suit File' AND b.sts<>0", NULL, FALSE);
            $data = $this->db->get()->result();
        return $data;
        }
        else{return NULL;}
    }
    function get_loan_ac_name_info($id)
    {
        if($id!=''){
                $this->db
                ->select("b.loan_ac,b.ac_name,b.st_belance,b.lawyer,b.legal_user,b.total_final_ln,b.req_type,b.district", FALSE)
                ->from("cma b")
                ->where("b.id='".$id."'", NULL, FALSE)
                ->limit(1);
            $data = $this->db->get()->row();
        return $data;
        }
        else{return NULL;}
    }
    function get_expense_data($id)
    {
        if($id!=''){
            $str=" SELECT j0.*
            FROM expenses as j0
            WHERE j0.sts=1 AND j0.event_id= ".$this->db->escape($id)." AND j0.module_name='Suit File' ORDER BY id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function bulk_acktion()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = true; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($this->input->post('operation')=='blk_lawyer'){
            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    //Generating Court Feee
                    if($_POST['new_court_fee_sts_'.$i]==1) //For New Court Fee
                    {
                        //IF cout fee give to the old lawyer
                        $pre_court_fee_data = $this->db->query("SELECT c.*
                            FROM cost_details as c 
                            WHERE c.vendor_type=4 AND c.main_table_name='cma' AND c.main_table_id=".$_POST['event_id_'.$i]." ORDER BY c.id DESC LIMIT 1 " )->row();
                        if(!empty($pre_court_fee_data))
                        {
                            if($pre_court_fee_data->vendor_id!=$_POST['lawyer'] && $pre_court_fee_data->court_fee_return_sts!=13 && $pre_court_fee_data->bill_id!='' && $pre_court_fee_data->bill_id!='0' && $pre_court_fee_data->bill_id!=NULL)
                            {
                                continue;
                            }
                            else if($pre_court_fee_data->vendor_id==$_POST['lawyer'] && $pre_court_fee_data->bill_id!='' && $pre_court_fee_data->bill_id!='0' && $pre_court_fee_data->bill_id!=NULL)
                            {
                                continue;
                            }
                            else if($pre_court_fee_data->vendor_id!=$_POST['lawyer'] && $pre_court_fee_data->court_fee_return_sts==13 && $pre_court_fee_data->bill_id!='' && $pre_court_fee_data->bill_id!='0' && $pre_court_fee_data->bill_id!=NULL)
                            {
                                $str="SELECT  j0.req_type,j0.cif,j0.loan_ac,j0.org_loan_ac,j0.ac_name,j0.loan_segment,j0.region,j0.territory,j0.district,j0.id,j0.proposed_type
                                 FROM cma j0
                                 WHERE j0.id= '".$_POST['event_id_'.$i]."' LIMIT 1";

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
                                    'module_name' => 'suit_file',
                                    'main_table_name' => 'cma',
                                    'main_table_id' => $_POST['event_id_'.$i],
                                    'activities_id' => 1,
                                    'vendor_type' => 4,
                                    'vendor_id' => $_POST['lawyer'],
                                    'amount' =>$_POST['court_fee_amount_'.$i],
                                    'txrn_dt' => date('Y-m-d H:i:s'),
                                    'loan_ac' =>$loan_ac,
                                    'cif' =>$cif,
                                    'org_loan_ac' =>$org_loan_ac,
                                    'ac_name' =>$ac_name,
                                    'req_type' =>$req_type,
                                    'proposed_type' =>$proposed_type,
                                    'loan_segment' =>$loan_segment,
                                    'region' =>$region,
                                    'territory' =>$territory,
                                    'district' =>$district
                                );
                                $data3=$this->user_model->cost_details($cost_data);
                            }

                        }
                        else
                        {
                            $str="SELECT  j0.req_type,j0.cif,j0.loan_ac,j0.org_loan_ac,j0.ac_name,j0.loan_segment,j0.region,j0.territory,j0.district,j0.id,j0.proposed_type
                                 FROM cma j0
                             WHERE j0.id= '".$_POST['event_id_'.$i]."' LIMIT 1";

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
                                'module_name' => 'suit_file',
                                'main_table_name' => 'cma',
                                'main_table_id' => $_POST['event_id_'.$i],
                                'activities_id' => 1,
                                'vendor_type' => 4,
                                'vendor_id' => $_POST['lawyer'],
                                'amount' =>$_POST['court_fee_amount_'.$i],
                                'txrn_dt' => date('Y-m-d H:i:s'),
                                'loan_ac' =>$loan_ac,
                                'cif' =>$cif,
                                'org_loan_ac' =>$org_loan_ac,
                                'ac_name' =>$ac_name,
                                'req_type' =>$req_type,
                                'proposed_type' =>$proposed_type,
                                'loan_segment' =>$loan_segment,
                                'region' =>$region,
                                'territory' =>$territory,
                                'district' =>$district
                            );
                            $data3=$this->user_model->cost_details($cost_data);
                        }
                        

                    }
                    else
                    {
                        if($_POST['court_fee_id_'.$i]!=0)
                        {
                            //Updating the court fee to new lawyer
                            $data = array(
                                'vendor_id'=> $_POST['lawyer'], 
                                );
                            $this->db->where('id', $_POST['court_fee_id_'.$i]);
                            $this->db->update('cost_details', $data);
                        }
                    }
                    $data = array('cma_sts' => 63,
                    'lawyer_n_send_by'=> $this->session->userdata['ast_user']['user_id'], 
                    'lawyer'=> $_POST['lawyer'],
                    'lawyer_n_send_dt'=>date('Y-m-d H:i:s')
                    );
                    if($_POST['hidden_req_type_'.$i]==1)
                    {
                        $data['l_branch']= $_POST['branch_'.$i];
                        $data['l_bank']= $_POST['bank_'.$i];
                        $data['chq_amount']= $_POST['chq_amount_'.$i];
                        $data['chq_number']= $_POST['chq_number_'.$i];
                        $data['l_dishonor_dt']= implode('-',array_reverse(explode('/',$this->input->post('dishonor_dt_'.$i))));
                    }
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cma', $data);
                    $history_data = array(
                        'event_id' => $_POST['event_id_'.$i],
                        'lawyer_id'=> $_POST['lawyer'], 
                        'select_by'=> $this->session->userdata['ast_user']['user_id'],
                        'select_dt'=>date('Y-m-d H:i:s')
                        );
                    $this->db->insert('legal_lawyer_select_history', $history_data);
                }
                
            }

            if (isset($_POST['notification_type']) && ($this->input->post('notification_type') == 'Email' || $this->input->post('notification_type') == 'BOTH'))
                    {
                        $str="SELECT  j0.sl_no,s.name as cma_sts
                                     FROM cma j0
                                     LEFT OUTER JOIN ref_status s on(j0.cma_sts=s.id)
                                 WHERE j0.sts = '1'  AND j0.id= '".$_POST['event_id_'.$i]."' LIMIT 1";
                                 
                        $application_data=$this->db->query($str)->row();
                        
                        if (!empty($this->input->post('email_address')) && $this->input->post('email_address') != null) {
                           $subject="Request for Approval";
                           $req_type=$application_data->cma_sts;
                           $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
                           $message = $this->lawyer_notification_format($_POST['event_id_'.$i],$_POST['lawyer']);
                            $m=$this->User_model->send_email("", "", $this->input->post('email_address'),"", $subject,$message);
                            
                            //echo $m;exit;
                            $data2 = $this->user_model->user_activities(63,'cma',$this->input->post('deleteEventId'),'cma','Send Notification To Lawyer By Email('.$this->input->post('email_address').')('.$_POST['event_id_'.$i].')');
                        }

                    }
                    if (isset($_POST['notification_type']) && ($this->input->post('notification_type') == 'SMS' || $this->input->post('notification_type') == 'BOTH')) {
                       $this->load->library('WebService');
                        $ws = new WebService();
                        $api_config2=$this->Common_model->get_api_config_data('CBS Middleware','Loan Details');
                        if ($api_config2->active_sts==1) {
                            $str="SELECT  j0.sl_no,j0.id,j0.chq_amount,j0.chq_number,DATE_FORMAT(j0.l_dishonor_dt,'%d-%b-%y') as l_dishonor_dt,j0.req_type,j0.loan_ac,j0.ac_name,j0.st_belance,u.name as legal_user_name,u.mobile_number
                                         FROM cma j0
                                         LEFT OUTER JOIN users_info u on(j0.legal_user=u.id)
                                     WHERE j0.sts = '1'  AND j0.id= '".$_POST['event_id_'.$i]."' LIMIT 1";
                                     
                            $application_data=$this->db->query($str)->row();
                            $message='Some case related documents are sent to your chambers. Requested to communicate with '.$application_data->legal_user_name.', '.$application_data->mobile_number;
                            $sms = $this->user_model->send_sms($message,$this->input->post('mobile'),'cma',$_POST['event_id_'.$i],0); 
                            
                            
                        }
                       $data2 = $this->user_model->user_activities(63,'cma',$_POST['event_id_'.$i],'cma','Send Notification To Lawyer By SMS('.$this->input->post('mobile').')('.$_POST['event_id_'.$i].')');
                    }
        }
        if($this->input->post('operation')=='blk_rf'){
            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $str="SELECT  j0.cma_sts
                             FROM cma j0
                         WHERE j0.sts = '1'  AND j0.id= '".$_POST['event_id_'.$i]."' LIMIT 1";
                         
                        $application_data=$this->db->query($str)->row();
                        $data = array('cma_sts_before_reas' => $application_data->cma_sts,'reassign_reason'=> $_POST['comments'],'cma_sts' => 84,'temp_legal_user' => $_POST['legal_user'],'legal_reassign_by'=> $this->session->userdata['ast_user']['user_id'], 'legal_reassign_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['event_id_'.$i]);
                        $this->db->update('cma', $data);
                        $data = array('cma_id' => $_POST['event_id_'.$i],'reason'=> $_POST['comments'],'pre_legal_user' => $_POST['pre_legal_user_'.$i],'prest_legal_user' => $_POST['legal_user'],'e_by'=> $this->session->userdata['ast_user']['user_id'], 'e_dt'=>date('Y-m-d H:i:s'));
                        $this->db->insert('cma_legal_user_change_history', $data);
                        
                        //Creating Automatic Authorization Request

                        $str="SELECT  j0.id,j0.req_type
                                         FROM suit_filling_info j0
                                     WHERE j0.sts = '1' AND j0.suit_sts=75  AND j0.cma_id= '".$_POST['event_id_'.$i]."' AND j0.re_case_sts<>1 LIMIT 1";
                                     
                        $application_data=$this->db->query($str)->row();
                        if(!empty($application_data))
                        {
                            if($application_data->req_type==2)
                            {
                                $type = 4;
                            }
                            else
                            {
                                $type = 9;
                            }
                            $data = array(
                                'suit_file_id' =>$application_data->id,
                                'authorization_type' =>$type,
                                'new_item' =>$_POST['legal_user'],
                                'change_type' =>2,
                                'change_date' =>date('Y-m-d H:i:s'),
                                'change_reason' =>$this->security->xss_clean( $this->input->post('remarks'))
                            );
                            $data['prev_item'] = $_POST['pre_legal_user_'.$i];
                            $data['e_by'] = $this->session->userdata['ast_user']['user_id'];
                            $data['e_dt'] = date('Y-m-d H:i:s');
                            $this->db->insert('change_request', $data);
                        }


                        $data3 = $this->user_model->user_activities(85,'suit_file',$_POST['event_id_'.$i],'suit_filling_info','Reassign Legal User('.$_POST['event_id_'.$i].')',$_POST['comments']);
                }
                
            }
        }
        if($this->input->post('operation')=='blk_ack'){
            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    //Reassigned File Acknowledgement
                    $str="SELECT  j0.cma_sts_before_reas,j0.temp_legal_user,j0.cma_sts
                                     FROM cma j0
                                 WHERE j0.sts = '1'  AND j0.id= '".$_POST['event_id_'.$i]."' LIMIT 1";
                                 
                    $application_data=$this->db->query($str)->row();
                    if($application_data->cma_sts==87)//Reassigned File Acknowledgement
                    {
                        $data = array('cma_sts_before_reas' =>0,'cma_sts' => $application_data->cma_sts_before_reas,'legal_ack_by'=> $this->session->userdata['ast_user']['user_id'], 'legal_ack_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['event_id_'.$i]);
                        $this->db->update('cma', $data);
                        $data2 = $this->user_model->user_activities(61,'cma',$_POST['event_id_'.$i],'cma','File acknowledgement by legal after Reassign('.$_POST['event_id_'.$i].')');

                    }
                    else //First Time Acknowledgement
                    {
                        $pre_action_result=$this->Common_model->get_pre_action_data('cma',$_POST['event_id_'.$i],'61','cma_sts');
                        if (count($pre_action_result)>0) 
                        {
                            return 'taken';
                        }
                        else
                        {
                            $data = array('cma_sts' => 61,'legal_ack_by'=> $this->session->userdata['ast_user']['user_id'], 'legal_ack_dt'=>date('Y-m-d H:i:s'));
                            $this->db->where('id', $_POST['event_id_'.$i]);
                            $this->db->update('cma', $data);
                            $data2 = $this->user_model->user_activities(61,'cma',$_POST['event_id_'.$i],'cma','File acknowledgement by legal('.$_POST['event_id_'.$i].')');
                        }
                    }
                }
                
            }
        }
        if($this->input->post('operation')=='blk_rf_approve'){
            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    //Reassigned File Acknowledgement
                    $str="SELECT  j0.cma_sts_before_reas,j0.temp_legal_user,j0.change_history_id
                             FROM cma j0
                         WHERE j0.sts = '1'  AND j0.id= '".$_POST['event_id_'.$i]."' LIMIT 1";
                         
                    $application_data=$this->db->query($str)->row();
                    $data = array('legal_user' =>$application_data->temp_legal_user,'temp_legal_user' =>0,'cma_sts' => 87,'reassign_v_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_v_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cma', $data);

                    $data = array('sts' =>87,'reassign_v_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_v_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $application_data->change_history_id);
                    $this->db->update('cma_legal_user_change_history', $data);

                    $str="SELECT  j0.id,j0.req_type,j0.present_plaintiff,j0.filling_plaintiff,j0.case_deal_officer
                                     FROM suit_filling_info j0
                                 WHERE j0.sts = '1' AND j0.suit_sts=75  AND j0.cma_id= '".$_POST['event_id_'.$i]."' AND j0.re_case_sts<>1 LIMIT 1";
                                 
                    $suit_data=$this->db->query($str)->row();
                    if(!empty($suit_data))
                    {
                        $data2=array();
                        $data2['prev_plaintiff'] = $suit_data->present_plaintiff;
                        $data2['present_plaintiff'] = $suit_data->case_deal_officer;
                        $data2['case_deal_officer'] = $application_data->temp_legal_user;

                        $this->db->where('id', $suit_data->id);
                        $this->db->update('suit_filling_info', $data2);
                    }
                    $data3 = $this->user_model->user_activities(87,'suit_file',$_POST['event_id_'.$i],'suit_filling_info','Reassign Approval Approved('.$_POST['event_id_'.$i].')');
                    $id = $_POST['event_id_'.$i];
                }
                
            }
        }
        if($this->input->post('operation')=='blk_rf_reject'){
            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    //Reassigned File Acknowledgement
                    $str="SELECT  j0.cma_sts_before_reas,j0.change_history_id
                             FROM cma j0
                         WHERE j0.sts = '1'  AND j0.id= '".$_POST['event_id_'.$i]."' LIMIT 1";
                         
                    $application_data=$this->db->query($str)->row();
                    $data = array('temp_legal_user' =>0,'cma_sts' => $application_data->cma_sts_before_reas,'reassign_reject_reason'=> $_POST['return_reason'],'reassign_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_reject_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cma', $data);

                    $data = array('sts' =>86,'reassign_reject_reason'=> $_POST['return_reason'],'reassign_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_reject_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $application_data->change_history_id);
                    $this->db->update('cma_legal_user_change_history', $data);

                    $data3 = $this->user_model->user_activities(86,'suit_file',$_POST['event_id_'.$i],'suit_filling_info','Reassign Approval Reject('.$_POST['event_id_'.$i].')',$_POST['return_reason']);
                    $id = $_POST['event_id_'.$i];
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
    function bulk_acktion_recase()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = true; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($this->input->post('operation')=='approve'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('suit_filling_info',$_POST['id_'.$i],'75','suit_sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $data2 = array('suit_sts' => 75,'confirm_by'=> $this->session->userdata['ast_user']['user_id'], 'confirm_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('suit_filling_info', $data2);
                        $str="SELECT  j0.case_number,j0.cif,j0.e_dt,j0.e_by,j0.req_type,j0.both_case_sts,j0.pre_suit_id,j0.loan_ac,j0.org_loan_ac,j0.ac_name,j0.loan_segment,j0.region,j0.territory,j0.district,j0.id,j0.proposed_type
                                     FROM suit_filling_info j0
                                 WHERE j0.id= '".$_POST['id_'.$i]."' LIMIT 1";
                        $count=0;//Fixed for borower 3 address
                        $application_data=$this->db->query($str)->row();
                        //Checking previous case running or not if not running the close it
                        if($application_data->both_case_sts==0)
                        {
                            $data4 = array('merged_with' => $_POST['id_'.$i],'final_remarks' => 2,'suit_sts' => 76,'merged_sts' => 1,'sts' => 0,'ac_close_by'=> $application_data->e_by, 'ac_close_dt'=>date('Y-m-d H:i:s'));
                            $this->db->where('id', $application_data->pre_suit_id);
                            $this->db->update('suit_filling_info', $data4);
                        }
                        ////////
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
                        $case_number = $application_data->case_number;

                        //Genereate Package Expenses
                        $str="SELECT  j0.*,s.lawyer,IF(s.disbursed_amount IS NULL,0,s.disbursed_amount) as disbursed_amount,s.package_amount
                                 FROM package_select_history j0
                                 LEFT OUTER JOIN lawyer_package_bill_setup s on(s.id=j0.package_id)
                             WHERE j0.event_table_name='suit_filling_info' AND j0.amount_selection=1 AND j0.event_id= '".$_POST['id_'.$i]."' LIMIT 1";   
                        $package_data=$this->db->query($str)->row();
                        if (!empty($package_data)) {
                            $total_disbursed_amount = $package_data->disbursed_amount+$package_data->amount;
                            if($total_disbursed_amount>$package_data->package_amount)
                            {
                                return 'limitcrossed';
                            }
                            if($total_disbursed_amount==$package_data->package_amount)
                            {
                                $disbursed_sts = 1;
                            }
                            else
                            {
                                $disbursed_sts = 0;
                            }
                            //update total disbursed amount
                            $data = array('disbursed_amount' => $total_disbursed_amount,'disbursed_sts' => $disbursed_sts);
                            $this->db->where('id', $package_data->package_id);
                            $this->db->update('lawyer_package_bill_setup', $data);

                            $cost_data = array(
                                    'module_name' => 'suit_file',
                                    'main_table_name' => 'suit_filling_info',
                                    'main_table_id' => $_POST['id_'.$i],
                                    'sub_table_name' => 'package_select_history',
                                    'sub_table_id' => $package_data->id,
                                    'suit_id' => $_POST['id_'.$i],
                                    'activities_id' => $package_data->activities_id,
                                    'package_id' => $package_data->package_id,
                                    'vendor_type' => 1,
                                    'vendor_id' => $package_data->lawyer,
                                    'amount' =>$package_data->amount,
                                    'txrn_dt' => $application_data->e_dt,
                                    'loan_ac' =>$loan_ac,
                                    'cif' =>$cif,
                                    'org_loan_ac' =>$org_loan_ac,
                                    'ac_name' =>$ac_name,
                                    'req_type' =>$req_type,
                                    'proposed_type' =>$proposed_type,
                                    'loan_segment' =>$loan_segment,
                                    'case_number' =>$case_number,
                                    'region' =>$region,
                                    'territory' =>$territory,
                                    'district' =>$district
                                );
                            $data3=$this->user_model->cost_details($cost_data);
                            
                        }


                        //Genereate Expenses
                        $str="SELECT  j0.*
                                 FROM expenses j0
                             WHERE j0.sts != '0'  AND j0.event_id= '".$_POST['id_'.$i]."' AND j0.module_name='Suit File'";   
                        $expense_data=$this->db->query($str)->result();
                        if (!empty($expense_data)) {
                                foreach ($expense_data as $key) {
                                    $cost_data = array(
                                    'module_name' => 'suit_file',
                                    'main_table_name' => 'suit_filling_info',
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
                                    'loan_ac' =>$loan_ac,
                                    'cif' =>$cif,
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
                                if ($key->package_select_sts==0) { //skipping the package selected bill
                                    $data3=$this->user_model->cost_details($cost_data);
                                }
                            }
                            //Verify Expenses
                            $expense_data = array('v_sts' => 38);
                             $this->db->where('event_id',$_POST['id_'.$i]);
                             $this->db->where('module_name',"Suit File");
                             $this->db->update('expenses', $expense_data);
                        }
                        $data3 = $this->user_model->user_activities(75,'suit_file',$_POST['id_'.$i],'suit_filling_info','Suit File Confirmed by legal('.$_POST['id_'.$i].')');
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
    function bulk_acktion_file()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = true; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($this->input->post('operation')=='reassign'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('suit_filling_info',$_POST['id_'.$i],'84','suit_sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $str="SELECT  j0.temp_deal_officer,j0.prest_court_name,j0.present_plaintiff,j0.case_deal_officer,j0.change_history_id
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$_POST['id_'.$i]."' LIMIT 1";
                         
                        $application_data=$this->db->query($str)->row();

                        $data = array('suit_id' => $_POST['id_'.$i],'reason'=> $_POST['reassign_reason'],'pre_legal_user' => $application_data->case_deal_officer,'prest_legal_user' => $_POST['legal_user'],'e_by'=> $this->session->userdata['ast_user']['user_id'], 'e_dt'=>date('Y-m-d H:i:s'));
                        if($_POST['court']!='')//When Court Name Changed
                        {
                            $data['pre_court'] = $application_data->prest_court_name;
                            $data['present_court'] = $_POST['court'];
                        }
                        $this->db->insert('cma_legal_user_change_history', $data);
                        $insert_idss = $this->db->insert_id();

                        $data = array('change_history_id' => $insert_idss,'reassign_reason'=> $_POST['reassign_reason'],'suit_sts' => 84,'temp_deal_officer' => $_POST['legal_user'],'reassign_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_dt'=>date('Y-m-d H:i:s'));
                        if($_POST['court']!='')//When Court Name Changed
                        {
                            $data['temp_court'] = $_POST['court'];
                        }
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('suit_filling_info', $data);
                        

                        $data3 = $this->user_model->user_activities(85,'suit_file',$_POST['id_'.$i],'suit_filling_info','Reassign Legal User('.$_POST['id_'.$i].')',$_POST['reassign_reason']);
                        $id = $_POST['id_'.$i];
                    }
                }
                
                
            }
        }
        if($this->input->post('operation')=='approve'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('suit_filling_info',$_POST['id_'.$i],'87','suit_sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $str="SELECT  j0.temp_deal_officer,j0.prest_court_name,j0.prest_lawyer_name,j0.temp_court,j0.temp_lawyer,j0.present_plaintiff,j0.case_deal_officer,j0.change_history_id
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$_POST['id_'.$i]."' LIMIT 1";
                         
                        $application_data=$this->db->query($str)->row();
                        $data = array('suit_sts' => 75,'reassign_v_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_v_dt'=>date('Y-m-d H:i:s'));
                        if($application_data->temp_deal_officer!='' && $application_data->temp_deal_officer!=NULL && $application_data->temp_deal_officer!=0)
                        {
                            $data['present_plaintiff'] = $application_data->case_deal_officer;
                            $data['prev_plaintiff'] = $application_data->present_plaintiff;
                            $data['case_deal_officer'] = $application_data->temp_deal_officer;
                            $data['temp_deal_officer'] = 0;
                        }
                        if($application_data->temp_court!='' && $application_data->temp_court!=NULL && $application_data->temp_court!=0)
                        {
                            $data['prest_court_name'] = $application_data->temp_court;
                            $data['prev_court_name'] = $application_data->prest_court_name;
                            $data['temp_court'] = 0;
                        }
                        if($application_data->temp_lawyer!='' && $application_data->temp_lawyer!=NULL && $application_data->temp_lawyer!=0)
                        {
                            $data['prest_lawyer_name'] = $application_data->temp_lawyer;
                            $data['prev_lawyer_name'] = $application_data->prest_lawyer_name;
                            $data['temp_lawyer'] = 0;
                        }
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('suit_filling_info', $data);

                        $data = array('sts' =>87,'reassign_v_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_v_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $application_data->change_history_id);
                        $this->db->update('cma_legal_user_change_history', $data);

                        $data3 = $this->user_model->user_activities(87,'suit_file',$_POST['id_'.$i],'suit_filling_info','Reassign Approval Approved('.$_POST['id_'.$i].')');
                        $id = $_POST['id_'.$i];
                    }
                }
                
                
            }
        }
        if($this->input->post('operation')=='reject'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('suit_filling_info',$_POST['id_'.$i],'86','suit_sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $str="SELECT  j0.change_history_id
                             FROM suit_filling_info j0
                         WHERE j0.id= '".$_POST['id_'.$i]."' LIMIT 1";
                         
                        $application_data=$this->db->query($str)->row();

                        $data = array('temp_deal_officer' =>0,'temp_court' =>0,'temp_lawyer' =>0,'suit_sts' => 75,'reassign_reject_reason'=> $_POST['return_reason'],'reassign_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_reject_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('suit_filling_info', $data);

                        $data = array('sts' =>86,'reassign_reject_reason'=> $_POST['return_reason'],'reassign_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_reject_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $application_data->change_history_id);
                        $this->db->update('cma_legal_user_change_history', $data);

                        $data3 = $this->user_model->user_activities(86,'suit_file',$_POST['id_'.$i],'suit_filling_info','Reassign Approval Reject('.$_POST['id_'.$i].')',$_POST['return_reason']);
                        $id = $_POST['id_'.$i];
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
    function load_bulk_data_file($module)
    {
        if($module=='blk_rf_main')
        {
            $where2 = "b.sts!='0' AND b.suit_sts=75 AND b.re_case_sts<>1";
        }
        if($module=='blk_rf_approve_main')
        {
            $where2 = "b.sts!='0' AND b.suit_sts=84 AND b.re_case_sts<>1";
        }
        //for recase
        if($module=='blk_rf_recase')
        {
            $where2 = "b.sts!='0' AND b.suit_sts=75 AND b.re_case_sts=1";
        }
        if($module=='blk_rf_approve_recase')
        {
            $where2 = "b.sts!='0' AND b.suit_sts=84 AND b.re_case_sts=1";
        }
        
        if (check_group('2')) //For Legal Maker
        {
            $where2.=" and b.case_deal_officer='".$this->session->userdata['ast_user']['user_id']."'";
        }
        else if (check_group('1')) //For Legal Checker
        {
            $where2.=" and b.legal_region IN(".$this->session->userdata['ast_user']['legal_region'].")";
        }
        else if(check_group('1') || check_group('2'))
        {
            if($this->input->post('legal_region') != '')
            {
                $where2.=" AND b.legal_region = '".$this->input->post('legal_region')."'";
            }
            if($this->input->post('legal_district') != '')
            {
                $where2.=" AND b.district = '".$this->input->post('legal_district')."'";
            }
            if($this->input->post('case_deal_officer') != '')
            {
                $where2.=" AND b.case_deal_officer = '".$this->input->post('case_deal_officer')."'";
            }
        }
        if($module=='blk_rf')
        {
            if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') == '') 
            {$where2.=" AND DATE(b.e_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
            if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') != '') 
            {$where2.=" AND DATE(b.e_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(b.e_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}
        }
        if($module=='blk_rf_approve')
        {
            if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') == '') 
            {$where2.=" AND DATE(b.reassign_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
            if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') != '') 
            {$where2.=" AND DATE(b.reassign_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(b.reassign_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}
        }

        $this->db
        ->select('b.*,b.e_by as e_by_id,j6.name as status,j7.name as region_name,j8.name as territory_name,
        j9.name as district_name,s.name as loan_segment,
        j1.name as request_type_name,
        CONCAT(j2.name," (",j2.user_id,")")as e_by,
        DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt', FALSE)
            ->from("suit_filling_info b")
            ->join('ref_req_type as j1', 'b.req_type=j1.id', 'left')
            ->join('users_info as j2', 'b.e_by=j2.id', 'left')
            ->join('ref_status as j6', 'b.suit_sts=j6.id', 'left')
            ->join('ref_region as j7', 'b.region=j7.id', 'left')
            ->join('ref_territory as j8', 'b.territory=j8.id', 'left')
            ->join('ref_legal_district as j9', 'b.district=j9.id', 'left')
            ->join('users_info as j12', 'b.legal_user=j12.id', 'left')
            ->join('ref_loan_segment as s', 'b.loan_segment=s.code', 'left')
            ->where($where2)
            ->order_by('b.id','DESC');
        $q=$this->db->get();
        return $q->result();
    }
}
?>
