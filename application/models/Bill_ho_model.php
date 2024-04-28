<?php
class Bill_ho_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
    }


    function court_return_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
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
        $where_initi=''; 
        if($where=='' || count($where)<=0){         
            //$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
        }
        
        if ($sortorder == '')
        {
            $sortdatafield="b.id";
            $sortorder = "DESC";                
        }
        $this->db->select('SQL_CALC_FOUND_ROWS b.*,d.name as district_name,l.name as lawyer_name,
        DATE_FORMAT(b.e_dt,"%d-%m-%Y") AS e_dt,CONCAT(u.name," (",u.user_id,")")as e_by,j6.name as status
        ', FALSE)
            ->from("court_fee_return b")
            ->join('ref_legal_district d', 'b.lawyer_district=d.id', 'left')
            ->join('ref_lawyer l', 'l.id=b.lawyer', 'left')
            ->join('users_info u', 'b.e_by=u.id', 'left')
            ->join('ref_status as j6', 'b.v_sts=j6.id', 'left')
            ->where("b.sts<>'0' and lif_cycle=2".$where_initi, NULL, FALSE)
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
    function court_adjust_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
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
        $where_initi=''; 
        if($where=='' || count($where)<=0){         
            //$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
        }
        
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
            ->where("b.sts<>'0' and b.life_cycle=2".$where_initi, NULL, FALSE)
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
    function get_grid_data_staff($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
       $i=0;
        $where2 = "a.sts<>0 and a.bill_type=3";
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

                if($filterdatafield=='sl_no')
                {
                    $filterdatafield='a.sl_no';
                }
                else if($filterdatafield=='dispatch_no')
                {
                    $filterdatafield='a.dispatch_no';
                }
                else if($filterdatafield=='bill_amount')
                {
                    $filterdatafield='a.bill_amount';
                }
                else if($filterdatafield=='discount_amount')
                {
                    $filterdatafield='a.discount_amount';
                }
                else if($filterdatafield=='bill_months')
                {
                    $filterdatafield='a.bill_months';
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
                    $filterdatafield = "DATE_FORMAT(a.memo_e_dt,'%d-%b-%y %h:%i %p')";
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
        // $where_initi=''; 
        // if($where=='' || count($where)<=0){          
        //  $where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
        // }
        
        if ($sortorder == '')
        {
            $sortdatafield="a.id";
            $sortorder = "DESC";  
            // $sortdatafield="j0.s_order";        
            // $sortorder = "ASC";               
        }
        $this->db
         ->select('SQL_CALC_FOUND_ROWS a.*,(a.bill_amount-a.discount_amount) AS invoice_amount,a.memo_e_by as e_by_id,
        j0.name as status,
        CONCAT(j1.name," (",j1.user_id,")")as e_by,
        CONCAT(j2.name," (",j2.user_id,")")as v_by,
        CONCAT(j3.name," (",j3.user_id,")")as stf_by,
        DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
        DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
        DATE_FORMAT(a.stf_dt,"%d-%b-%y %h:%i %p") AS stf_dt
        ', FALSE)
            ->from("bill_summery a")
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
            ->join('users_info as j2', 'a.v_by=j2.id', 'left')
            ->join('users_info as j3', 'a.stf_by=j3.id', 'left')
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
    function get_grid_data_court($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
       $i=0;
        $where2 = "a.sts<>0 and a.bill_type=5";
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

                if($filterdatafield=='sl_no')
                {
                    $filterdatafield='a.sl_no';
                }
                else if($filterdatafield=='dispatch_no')
                {
                    $filterdatafield='a.dispatch_no';
                }
                else if($filterdatafield=='bill_months')
                {
                    $filterdatafield='a.bill_months';
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
                    $filterdatafield = "DATE_FORMAT(a.memo_e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='v_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.v_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='stf_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.stf_dt,'%d-%b-%y %h:%i %p')";
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
                else if($filterdatafield =='stf_by')
                {
                    $where .= " (j3.name LIKE '%".$filtervalue."%' OR j3.user_id LIKE '%".$filtervalue."%') ";
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
            $sortdatafield="a.id";
            $sortorder = "DESC";  
            // $sortdatafield="j0.s_order";        
            // $sortorder = "ASC";                
        }
        $this->db
        ->select('SQL_CALC_FOUND_ROWS a.*,(a.bill_amount-a.discount_amount) AS invoice_amount,a.memo_e_by as e_by_id,
        j0.name as status,
        CONCAT(j1.name," (",j1.user_id,")")as e_by,
        CONCAT(j2.name," (",j2.user_id,")")as v_by,
        CONCAT(j3.name," (",j3.user_id,")")as stf_by,
        DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
        DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
        DATE_FORMAT(a.stf_dt,"%d-%b-%y %h:%i %p") AS stf_dt
        ', FALSE)
            ->from("bill_summery a")
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
            ->join('users_info as j2', 'a.v_by=j2.id', 'left')
            ->join('users_info as j3', 'a.stf_by=j3.id', 'left')
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
    function get_grid_data_lawyer($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
       $i=0;
        $where2 = "a.sts<>0 and a.bill_type=1 and a.hc_lawyer_bill_sts<>1";
        $field = "memo_e_dt";
        if($this->input->get('legal_region_grid')!='') 
        {$where2.=" AND l.region = '".trim($this->input->get('legal_region_grid'))."'";}
        if($this->input->get('legal_district_grid')!='') 
        {$where2.=" AND l.district = '".trim($this->input->get('legal_district_grid'))."'";}
        if($this->input->get('lawyer_grid')!='') 
        {$where2.=" AND a.vendor = '".trim($this->input->get('lawyer_grid'))."'";}
        if($this->input->get('status_grid')!='') 
        {
            $where2.=" AND a.sts = '".trim($this->input->get('status_grid'))."'";
            if($this->input->get('status_grid')==26)
                {
                    $field = "stc_dt";
                }
                else if($this->input->get('status_grid')==27)
                {
                    $field = "return_dt";
                }
                else if($this->input->get('status_grid')==28)
                {
                    $field = "reject_dt";
                }
                else if($this->input->get('status_grid')==29)
                {
                    $field = "v_dt";
                }
                else if($this->input->get('status_grid')==70)
                {
                    $field = "stf_dt";
                }
                else if($this->input->get('status_grid')==88)
                {
                    $field = "finance_v_dt";
                }
                else if($this->input->get('status_grid')==89)
                {
                    $field = "finanace_r_dt";
                }
        }
        if($this->input->get("from_date") != ''){$from_date= $this->input->get("from_date");} else{$from_date = '0';}
        if($this->input->get("to_date") != ''){$to_date= $this->input->get("to_date");} else{$to_date = '0';}
        if($from_date != '0'){$from_date = implode('-',array_reverse(explode('/',$from_date))); }
        else{$from_date='0';}
        if($to_date != '0'){ $to_date= implode('-',array_reverse(explode('/',$to_date))); }
        else{$to_date='0';}

        if( $from_date!='0' && $to_date=='0')
        { $where2.= " and DATE(a.$field)='".$from_date."'"; }
        
        if( $from_date!='0' && $to_date!='0')
        { $where2.= " and DATE(a.$field) between '".$from_date."' and '".$to_date."'";}
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

                if($filterdatafield=='sl_no')
                {
                    $filterdatafield='a.sl_no';
                }
                else if($filterdatafield=='dispatch_no')
                {
                    $filterdatafield='a.dispatch_no';
                }
                else if($filterdatafield=='bill_amount')
                {
                    $filterdatafield='a.bill_amount';
                }
                else if($filterdatafield=='discount_amount')
                {
                    $filterdatafield='a.discount_amount';
                }
                else if($filterdatafield=='bill_months')
                {
                    $filterdatafield='a.bill_months';
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
                    $filterdatafield = "DATE_FORMAT(a.memo_e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='v_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.v_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='stf_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.stf_dt,'%d-%b-%y %h:%i %p')";
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
                else if($filterdatafield =='stf_by')
                {
                    $where .= " (j3.name LIKE '%".$filtervalue."%' OR j3.user_id LIKE '%".$filtervalue."%') ";
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
            // $sortdatafield="j0.s_order";        
            // $sortorder = "ASC";                 
        }
        $this->db->select('SQL_CALC_FOUND_ROWS a.*,(a.bill_amount-a.discount_amount) AS invoice_amount,r.name as region_name,d.name as district_name,a.memo_e_by as e_by_id,l.name as lawyer_name,
        j0.name as status,
        CONCAT(j1.name," (",j1.user_id,")")as e_by,
        CONCAT(j2.name," (",j2.user_id,")")as v_by,
        CONCAT(j3.name," (",j3.user_id,")")as stf_by,
        DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
        DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
        DATE_FORMAT(a.stf_dt,"%d-%b-%y %h:%i %p") AS stf_dt
        ', FALSE)
            ->from("bill_summery a")
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('ref_lawyer as l', 'a.vendor=l.id', 'left')
            ->join('ref_legal_region as r', 'l.region=r.id', 'left')
            ->join('ref_legal_district as d', 'l.district=d.id', 'left')
            ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
            ->join('users_info as j2', 'a.v_by=j2.id', 'left')
            ->join('users_info as j3', 'a.stf_by=j3.id', 'left')
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
    function get_grid_data_lawyer_hc($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
       $i=0;
        $where2 = "a.sts<>0 and a.bill_type=1 and a.hc_lawyer_bill_sts=1";
        $field = "memo_e_dt";
        if($this->input->get('legal_region_grid')!='') 
        {$where2.=" AND l.region = '".trim($this->input->get('legal_region_grid'))."'";}
        if($this->input->get('legal_district_grid')!='') 
        {$where2.=" AND l.district = '".trim($this->input->get('legal_district_grid'))."'";}
        if($this->input->get('lawyer_grid')!='') 
        {$where2.=" AND a.vendor = '".trim($this->input->get('lawyer_grid'))."'";}
        if($this->input->get('status_grid')!='') 
        {
            $where2.=" AND a.sts = '".trim($this->input->get('status_grid'))."'";
            if($this->input->get('status_grid')==26)
            {
                $field = "stc_dt";
            }
            else if($this->input->get('status_grid')==27)
            {
                $field = "return_dt";
            }
            else if($this->input->get('status_grid')==28)
            {
                $field = "reject_dt";
            }
            else if($this->input->get('status_grid')==29)
            {
                $field = "v_dt";
            }
            else if($this->input->get('status_grid')==70)
            {
                $field = "stf_dt";
            }
            else if($this->input->get('status_grid')==88)
            {
                $field = "finance_v_dt";
            }
            else if($this->input->get('status_grid')==89)
            {
                $field = "finanace_r_dt";
            }
        }
        if($this->input->get("from_date") != ''){$from_date= $this->input->get("from_date");} else{$from_date = '0';}
        if($this->input->get("to_date") != ''){$to_date= $this->input->get("to_date");} else{$to_date = '0';}
        if($from_date != '0'){$from_date = implode('-',array_reverse(explode('/',$from_date))); }
        else{$from_date='0';}
        if($to_date != '0'){ $to_date= implode('-',array_reverse(explode('/',$to_date))); }
        else{$to_date='0';}

        if( $from_date!='0' && $to_date=='0')
        { $where2.= " and DATE(a.$field)='".$from_date."'"; }
        
        if( $from_date!='0' && $to_date!='0')
        { $where2.= " and DATE(a.$field) between '".$from_date."' and '".$to_date."'";}
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

                if($filterdatafield=='sl_no')
                {
                    $filterdatafield='a.sl_no';
                }
                else if($filterdatafield=='dispatch_no')
                {
                    $filterdatafield='a.dispatch_no';
                }
                else if($filterdatafield=='bill_amount')
                {
                    $filterdatafield='a.bill_amount';
                }
                else if($filterdatafield=='discount_amount')
                {
                    $filterdatafield='a.discount_amount';
                }
                else if($filterdatafield=='bill_months')
                {
                    $filterdatafield='a.bill_months';
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
                else if($filterdatafield=='e_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.memo_e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='v_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.v_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='stf_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.stf_dt,'%d-%b-%y %h:%i %p')";
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
                else if($filterdatafield =='stf_by')
                {
                    $where .= " (j3.name LIKE '%".$filtervalue."%' OR j3.user_id LIKE '%".$filtervalue."%') ";
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
            // $sortdatafield="j0.s_order";        
            // $sortorder = "ASC";                 
        }
        $this->db->select('SQL_CALC_FOUND_ROWS a.*,(a.bill_amount-a.discount_amount) AS invoice_amount,a.memo_e_by as e_by_id,l.name as lawyer_name,
        j0.name as status,
        CONCAT(j1.name," (",j1.user_id,")")as e_by,
        CONCAT(j2.name," (",j2.user_id,")")as v_by,
        CONCAT(j3.name," (",j3.user_id,")")as stf_by,
        DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
        DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
        DATE_FORMAT(a.stf_dt,"%d-%b-%y %h:%i %p") AS stf_dt
        ', FALSE)
            ->from("bill_summery a")
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('ref_lawyer as l', 'a.vendor=l.id', 'left')
            ->join('ref_legal_region as r', 'l.region=r.id', 'left')
            ->join('ref_legal_district as d', 'l.district=d.id', 'left')
            ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
            ->join('users_info as j2', 'a.v_by=j2.id', 'left')
            ->join('users_info as j3', 'a.stf_by=j3.id', 'left')
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
        $where2 = "a.sts<>0 and a.bill_type=4";
        $field = "memo_e_dt";
        if($this->input->get('legal_region_grid')!='') 
        {$where2.=" AND l.region = '".trim($this->input->get('legal_region_grid'))."'";}
        if($this->input->get('legal_district_grid')!='') 
        {$where2.=" AND l.district = '".trim($this->input->get('legal_district_grid'))."'";}
        if($this->input->get('lawyer_grid')!='') 
        {$where2.=" AND a.vendor = '".trim($this->input->get('lawyer_grid'))."'";}
        if($this->input->get('status_grid')!='') 
        {
            $where2.=" AND a.sts = '".trim($this->input->get('status_grid'))."'";
            if($this->input->get('status_grid')==26)
            {
                $field = "stc_dt";
            }
            else if($this->input->get('status_grid')==27)
            {
                $field = "return_dt";
            }
            else if($this->input->get('status_grid')==28)
            {
                $field = "reject_dt";
            }
            else if($this->input->get('status_grid')==29)
            {
                $field = "v_dt";
            }
            else if($this->input->get('status_grid')==70)
            {
                $field = "stf_dt";
            }
            else if($this->input->get('status_grid')==88)
            {
                $field = "finance_v_dt";
            }
            else if($this->input->get('status_grid')==89)
            {
                $field = "finanace_r_dt";
            }
        }
        if($this->input->get("from_date") != ''){$from_date= $this->input->get("from_date");} else{$from_date = '0';}
        if($this->input->get("to_date") != ''){$to_date= $this->input->get("to_date");} else{$to_date = '0';}
        if($from_date != '0'){$from_date = implode('-',array_reverse(explode('/',$from_date))); }
        else{$from_date='0';}
        if($to_date != '0'){ $to_date= implode('-',array_reverse(explode('/',$to_date))); }
        else{$to_date='0';}

        if( $from_date!='0' && $to_date=='0')
        { $where2.= " and DATE(a.$field)='".$from_date."'"; }
        
        if( $from_date!='0' && $to_date!='0')
        { $where2.= " and DATE(a.$field) between '".$from_date."' and '".$to_date."'";}
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

                if($filterdatafield=='sl_no')
                {
                    $filterdatafield='a.sl_no';
                }
                else if($filterdatafield=='dispatch_no')
                {
                    $filterdatafield='a.dispatch_no';
                }
                else if($filterdatafield=='bill_amount')
                {
                    $filterdatafield='a.bill_amount';
                }
                else if($filterdatafield=='discount_amount')
                {
                    $filterdatafield='a.discount_amount';
                }
                else if($filterdatafield=='bill_months')
                {
                    $filterdatafield='a.bill_months';
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
                else if($filterdatafield=='status')
                {
                    $filterdatafield='j0.name';
                }
                else if($filterdatafield=='e_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.memo_e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='v_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.v_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='stf_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.stf_dt,'%d-%b-%y %h:%i %p')";
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
                else if($filterdatafield =='stf_by')
                {
                    $where .= " (j3.name LIKE '%".$filtervalue."%' OR j3.user_id LIKE '%".$filtervalue."%') ";
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
         ->select('SQL_CALC_FOUND_ROWS a.*,(a.bill_amount-a.discount_amount) AS invoice_amount,a.memo_e_by as e_by_id,r.name as region_name,d.name as district_name,l.name as lawyer_name,
        j0.name as status,
        CONCAT(j1.name," (",j1.user_id,")")as e_by,
        CONCAT(j2.name," (",j2.user_id,")")as v_by,
        CONCAT(j3.name," (",j3.user_id,")")as stf_by,
        DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
        DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
        DATE_FORMAT(a.stf_dt,"%d-%b-%y %h:%i %p") AS stf_dt
        ', FALSE)
            ->from("bill_summery a")
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('ref_lawyer as l', 'a.vendor=l.id', 'left')
            ->join('ref_legal_region as r', 'l.region=r.id', 'left')
            ->join('ref_legal_district as d', 'l.district=d.id', 'left')
            ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
            ->join('users_info as j2', 'a.v_by=j2.id', 'left')
            ->join('users_info as j3', 'a.stf_by=j3.id', 'left')
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
    function get_grid_data_paper_bill($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
       $i=0;
        $where2 = "a.sts<>0 and a.bill_type=2";
        $field = "memo_e_dt";
        if($this->input->get('vendor_type')!='') 
        {
            $where2.=" AND a.vendor_type = '".trim($this->input->get('vendor_type'))."'";
            if($this->input->get('paper_vendor')!='') 
            {$where2.=" AND a.vendor = '".trim($this->input->get('paper_vendor'))."'";}
            if($this->input->get('staff')!='') 
            {$where2.=" AND a.vendor = '".trim($this->input->get('staff'))."'";}
        }
        if($this->input->get('status_grid')!='') 
        {
            $where2.=" AND a.sts = '".trim($this->input->get('status_grid'))."'";
            if($this->input->get('status_grid')==26)
            {
                $field = "stc_dt";
            }
            else if($this->input->get('status_grid')==27)
            {
                $field = "return_dt";
            }
            else if($this->input->get('status_grid')==28)
            {
                $field = "reject_dt";
            }
            else if($this->input->get('status_grid')==29)
            {
                $field = "v_dt";
            }
            else if($this->input->get('status_grid')==70)
            {
                $field = "stf_dt";
            }
            else if($this->input->get('status_grid')==88)
            {
                $field = "finance_v_dt";
            }
            else if($this->input->get('status_grid')==89)
            {
                $field = "finanace_r_dt";
            }
        }
        if($this->input->get("from_date") != ''){$from_date= $this->input->get("from_date");} else{$from_date = '0';}
        if($this->input->get("to_date") != ''){$to_date= $this->input->get("to_date");} else{$to_date = '0';}
        if($from_date != '0'){$from_date = implode('-',array_reverse(explode('/',$from_date))); }
        else{$from_date='0';}
        if($to_date != '0'){ $to_date= implode('-',array_reverse(explode('/',$to_date))); }
        else{$to_date='0';}

        if( $from_date!='0' && $to_date=='0')
        { $where2.= " and DATE(a.$field)='".$from_date."'"; }
        
        if( $from_date!='0' && $to_date!='0')
        { $where2.= " and DATE(a.$field) between '".$from_date."' and '".$to_date."'";}
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

                if($filterdatafield=='sl_no')
                {
                    $filterdatafield='a.sl_no';
                }
                else if($filterdatafield=='dispatch_no')
                {
                    $filterdatafield='a.dispatch_no';
                }
                else if($filterdatafield=='bill_amount')
                {
                    $filterdatafield='a.bill_amount';
                }
                else if($filterdatafield=='discount_amount')
                {
                    $filterdatafield='a.discount_amount';
                }
                else if($filterdatafield=='bill_months')
                {
                    $filterdatafield='a.bill_months';
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
                    $filterdatafield = "DATE_FORMAT(a.memo_e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='v_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.v_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='stf_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.stf_dt,'%d-%b-%y %h:%i %p')";
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
                else if($filterdatafield =='vendor_name')
                {
                    $where .= " (j3.name LIKE '%".$filtervalue."%' OR j4.name LIKE '%".$filtervalue."%') ";
                }
                else if($filterdatafield =='stf_by')
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
        }else{$where=array();}
        if ($sortorder == '')
        {
            $sortdatafield="a.id";
            $sortorder = "DESC";         
        }
        $this->db
         ->select('SQL_CALC_FOUND_ROWS a.*,(a.bill_amount-a.discount_amount) AS invoice_amount,IF(a.vendor_type="Vendor",j4.name,j3.name) as vendor_name,a.memo_e_by as e_by_id,
        j0.name as status,
        CONCAT(j1.name," (",j1.user_id,")")as e_by,
        CONCAT(j2.name," (",j2.user_id,")")as v_by,
        CONCAT(j5.name," (",j5.user_id,")")as stf_by,
        DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
        DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
        DATE_FORMAT(a.stf_dt,"%d-%b-%y %h:%i %p") AS stf_dt
        ', FALSE)
            ->from("bill_summery a")
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
            ->join('users_info as j2', 'a.v_by=j2.id', 'left')
            ->join('users_info as j3', 'a.vendor=j3.id and a.vendor_type="Staff"', 'left')
            ->join('ref_paper_vendor as j4', 'a.vendor=j4.id and a.vendor_type="Vendor"', 'left')
            ->join('users_info as j5', 'a.stf_by=j5.id', 'left')
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
    function get_grid_data_other_bill($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
       $i=0;
        $where2 = "a.sts<>0 and a.bill_type=6";
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

                if($filterdatafield=='sl_no')
                {
                    $filterdatafield='a.sl_no';
                }
                else if($filterdatafield=='dispatch_no')
                {
                    $filterdatafield='a.dispatch_no';
                }
                else if($filterdatafield=='bill_months')
                {
                    $filterdatafield='a.bill_months';
                }
                else if($filterdatafield=='bill_amount')
                {
                    $filterdatafield='a.bill_amount';
                }
                else if($filterdatafield=='discount_amount')
                {
                    $filterdatafield='a.discount_amount';
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
                    $filterdatafield = "DATE_FORMAT(a.memo_e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='v_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.v_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='stf_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.stf_dt,'%d-%b-%y %h:%i %p')";
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
                else if($filterdatafield =='stf_by')
                {
                    $where .= " (j3.name LIKE '%".$filtervalue."%' OR j3.user_id LIKE '%".$filtervalue."%') ";
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
            // $sortdatafield="j0.s_order";        
            // $sortorder = "ASC";              
        }
        $this->db
        ->select('SQL_CALC_FOUND_ROWS a.*,(a.bill_amount-a.discount_amount) AS invoice_amount,a.memo_e_by as e_by_id,
        j0.name as status,
        CONCAT(j1.name," (",j1.user_id,")")as e_by,
        CONCAT(j2.name," (",j2.user_id,")")as v_by,
        CONCAT(j3.name," (",j3.user_id,")")as stf_by,
        DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
        DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
        DATE_FORMAT(a.stf_dt,"%d-%b-%y %h:%i %p") AS stf_dt
        ', FALSE)
            ->from("bill_summery a")
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
            ->join('users_info as j2', 'a.v_by=j2.id', 'left')
            ->join('users_info as j3', 'a.stf_by=j3.id', 'left')
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
        $where2 = "";
        if($this->input->post('module_name')=='lawyer_bill')
        {
            $where2 = "a.sts<>0 and a.bill_type=1 and a.sts IN(26,30,89)";
        }
        else if($this->input->post('module_name')=='court_fee')
        {
            $where2 = "a.sts<>0 and a.bill_type=4 and a.sts IN(26,30,89)";
        }
        else if($this->input->post('module_name')=='lawyer_bill_hc')
        {
            $where2 = "a.sts<>0 and a.bill_type=1 and a.hc_lawyer_bill_sts=1 and a.sts IN(26,30,89)";
        }
        else if($this->input->post('module_name')=='paper_bill')
        {
            $where2 = "a.sts<>0 and a.bill_type=2 and a.sts IN(26,30,89)";
        }
        else if($this->input->post('module_name')=='court_enter')
        {
            $where2 = "a.sts<>0 and a.bill_type=5 and a.sts IN(26,30,89)";
        }
        if ($this->input->post('module_name')!='court_enter') {
            if($this->input->post('legal_region') != '')
            {
                $where2.=" AND l.region = '".$this->input->post('legal_region')."'";
            }
            if($this->input->post('legal_district') != '')
            {
                $where2.=" AND l.district = '".$this->input->post('legal_district')."'";
            }
            if($this->input->post('vendor') != '')
            {
                $where2.=" AND a.vendor = '".$this->input->post('vendor')."'";
            }
        }
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') == '') 
        {$where2.=" AND DATE(a.memo_e_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') != '') 
        {$where2.=" AND DATE(a.memo_e_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(a.memo_e_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}
        
        if ($this->input->post('module_name')=='lawyer_bill' || $this->input->post('module_name')=='lawyer_bill_hc' || $this->input->post('module_name')=='court_fee') {
            $this->db->select('a.*,r.name as region_name,d.name as district_name,a.memo_e_by as e_by_id,l.name as lawyer_name,
                j0.name as status,
                CONCAT(j1.name," (",j1.user_id,")")as e_by,
                CONCAT(j2.name," (",j2.user_id,")")as v_by,
                DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
                DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
                ', FALSE)
                    ->from("bill_summery a")
                    ->join('ref_status as j0', 'a.sts=j0.id', 'left')
                    ->join('ref_lawyer as l', 'a.vendor=l.id', 'left')
                    ->join('ref_legal_region as r', 'l.region=r.id', 'left')
                    ->join('ref_legal_district as d', 'l.district=d.id', 'left')
                    ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
                    ->join('users_info as j2', 'a.v_by=j2.id', 'left')
                    ->where($where2)
                ->order_by('a.id','DESC');
            $q=$this->db->get();
            return $q->result();
        }
        else if($this->input->post('module_name')=='paper_bill')
        {
            $this->db->select('a.*,(a.bill_amount-a.discount_amount) AS invoice_amount,IF(a.vendor_type="Vendor",l.name,j3.name) as vendor_name,a.memo_e_by as e_by_id,
            j0.name as status,
            CONCAT(j1.name," (",j1.user_id,")")as e_by,
            CONCAT(j2.name," (",j2.user_id,")")as v_by,
            DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
            DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
            ', FALSE)
                ->from("bill_summery a")
                ->join('ref_status as j0', 'a.sts=j0.id', 'left')
                ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
                ->join('users_info as j2', 'a.v_by=j2.id', 'left')
                ->join('users_info as j3', 'a.vendor=j3.id and a.vendor_type="Staff"', 'left')
                ->join('ref_paper_vendor as l', 'a.vendor=l.id and a.vendor_type="Vendor"', 'left')
                ->where($where2)
                ->order_by('a.id','DESC');
                $q=$this->db->get();
            return $q->result();
        }
        else if($this->input->post('module_name')=='court_enter')
        {
            $this->db->select('a.*,a.memo_e_by as e_by_id,
                j0.name as status,
                CONCAT(j1.name," (",j1.user_id,")")as e_by,
                CONCAT(j2.name," (",j2.user_id,")")as v_by,
                DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
                DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
                ', FALSE)
                    ->from("bill_summery a")
                    ->join('ref_status as j0', 'a.sts=j0.id', 'left')
                    ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
                    ->join('users_info as j2', 'a.v_by=j2.id', 'left')
                    ->where($where2)
                    ->order_by('a.id','DESC');
                $q=$this->db->get();
            return $q->result();
        }
        return array();
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
                    $pre_action_result=$this->Common_model->get_pre_action_data('bill_summery',$_POST['id_'.$i],'27,28,29','sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        
                       $data = array('sts' => 29,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $this->input->post('id_'.$i));
                        $this->db->update('bill_summery', $data);
                        $data3=array('memo_sts' => 29);
                        $this->db->where('bill_id', $this->input->post('id_'.$i));
                        $this->db->update('cost_details', $data3);
                        $data2 = $this->user_model->user_activities_bill(29,'bill_memo',$this->input->post('id_'.$i),'bill_summery','Approve Bill Memo('.$this->input->post('id_'.$i).')');
                    }
                }
                
                
            }
        }
        if($this->input->post('operation')=='return'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('bill_summery',$_POST['id_'.$i],'27,28,29','sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $data = array('sts' => 27,'return_reason' => $_POST['return_reason'],'return_by'=> $this->session->userdata['ast_user']['user_id'], 'return_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $this->input->post('id_'.$i));
                        $this->db->update('bill_summery', $data);
                        $data3=array('memo_sts' => 25);
                        $this->db->where('bill_id', $this->input->post('id_'.$i));
                        $this->db->update('cost_details', $data3);
                        $data2 = $this->user_model->user_activities_bill(27,'bill_memo',$this->input->post('id_'.$i),'bill_summery','Bill Memo Return By Checker('.$this->input->post('id_'.$i).')',$_POST['return_reason']);
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
    function get_add_action_data_staff($id)
    {
        $this->db
            ->select('a.*,CONCAT(u.name," (",u.pin,")") as vendor_name,a.vendor as vendor_id', FALSE)
            ->from("bill_summery a")
            ->join('users_info as u', 'a.vendor=u.id', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function get_bill_summery_data_by_id($id)
    {
        $this->db
            ->select('c.*,d.name as functional_desig,', FALSE)
            ->from("cost_details a")
            ->join('court_entertainment_data as c', 'a.main_table_id=c.id', 'left')
            ->join('ref_functional_designation as d', 'c.functional_desig=d.id', 'left')
            ->where("a.bill_id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function get_add_action_data_court($id)
    {
        $this->db
            ->select('a.*,CONCAT(u.name," (",u.pin,")") as vendor_name,a.vendor as vendor_id,
                DATE_FORMAT(a.received_dt,"%d/%m/%Y") as received_dt', FALSE)
            ->from("bill_summery a")
            ->join('users_info as u', 'a.vendor=u.id', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function get_add_action_data_lawyer($id)
    {
        $this->db
            ->select('a.*,CONCAT(u.name," (",u.code,")") as vendor_name,a.vendor as vendor_id,
                DATE_FORMAT(a.received_dt,"%d/%m/%Y") as received_dt', FALSE)
            ->from("bill_summery a")
            ->join('ref_lawyer as u', 'a.vendor=u.id', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function get_add_action_data_court_fee($id)
    {
        $this->db
            ->select('a.*,CONCAT(u.name," (",u.code,")") as vendor_name,a.vendor as vendor_id,
                DATE_FORMAT(a.received_dt,"%d/%m/%Y") as received_dt', FALSE)
            ->from("bill_summery a")
            ->join('ref_lawyer as u', 'a.vendor=u.id', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function get_add_action_data_paper_bill($id)
    {
        $this->db
            ->select('a.*,IF(a.vendor_type="Vendor",u.name,CONCAT(u1.name,"(",u1.pin,")")) as vendor_name,a.vendor as vendor_id,
                DATE_FORMAT(a.received_dt,"%d/%m/%Y") as received_dt', FALSE)
            ->from("bill_summery a")
            ->join('ref_paper_vendor as u', 'a.vendor=u.id and a.vendor_type="Vendor"', 'left')
            ->join('users_info as u1', 'a.vendor=u1.id and a.vendor_type="Staff"', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function get_add_action_data_other_bill($id)
    {
        $this->db
            ->select('a.*,a.vendor_name as vendor_name,a.vendor as vendor_id,
                DATE_FORMAT(a.received_dt,"%d/%m/%Y") as received_dt', FALSE)
            ->from("bill_summery a")
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
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
    function get_row_details_staff($id)
    {
        $this->db
            ->select('a.sl_no,a.file_for_finance,a.file_from_finance,a.finance_r_reason,DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
                CONCAT(u.name," (",u.pin,")") as vendor_name,tx.name as tax_vat_text,
                DATE_FORMAT(a.memo_e_dt,"%d-%b-%y") AS bill_dt,DATE_FORMAT(a.received_dt,"%d-%b-%y") AS received_dt,
                a.dispatch_no,a.bill_amount,a.discount_amount,
                a.memo_remarks,CONCAT(j6.name," (",j6.user_id,")")as memo_e_by,
                CONCAT(j8.name," (",j8.user_id,")")as stf_by,
                DATE_FORMAT(a.stf_dt,"%d-%b-%y") AS stf_dt,
                CONCAT(j9.name," (",j9.user_id,")")as finance_r_by,
                DATE_FORMAT(a.finanace_r_dt,"%d-%b-%y %h:%i %p") AS finanace_r_dt,
                CONCAT(j7.name," (",j7.user_id,")")as v_by', FALSE)
            ->from("bill_summery a")
            ->join('ref_tax_vat_text as tx', 'a.tax_vat_text=tx.id', 'left')
            ->join('users_info as u', 'a.vendor=u.id and a.bill_type=3', 'left')
            ->join('users_info as j6', 'a.memo_e_by=j6.id', 'left')
            ->join('users_info as j7', 'a.v_by=j7.id', 'left')
            ->join('users_info as j8', 'a.stf_by=j8.id', 'left')
            ->join('users_info as j9', 'a.finance_r_by=j9.id', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function get_row_details_court($id)
    {
        $this->db
            ->select('a.sl_no,a.file_for_finance,a.file_from_finance,a.finance_r_reason,DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
                CONCAT(u.name," (",u.pin,")") as vendor_name,
                DATE_FORMAT(a.memo_e_dt,"%d-%b-%y") AS bill_dt,DATE_FORMAT(a.received_dt,"%d-%b-%y") AS received_dt,
                a.dispatch_no,a.bill_amount,a.discount_amount,
                a.memo_remarks,CONCAT(j6.name," (",j6.user_id,")")as memo_e_by,j6f.name as memo_e_desig,
                CONCAT(j8.name," (",j8.user_id,")")as stf_by,j7f.name as memo_v_desig,
                CONCAT(j9.name," (",j9.user_id,")")as finance_r_by,
                DATE_FORMAT(a.finanace_r_dt,"%d-%b-%y %h:%i %p") AS finanace_r_dt,
                DATE_FORMAT(a.stf_dt,"%d-%b-%y %h:%i %p") AS stf_dt,
                CONCAT(j7.name," (",j7.user_id,")")as v_by', FALSE)
            ->from("bill_summery a")
            ->join('users_info as u', 'a.vendor=u.id and a.bill_type=5', 'left')
            ->join('users_info as j6', 'a.memo_e_by=j6.id', 'left')
            ->join('ref_functional_designation as j6f', 'j6.functional_designation_id=j6f.id', 'left')
            ->join('users_info as j7', 'a.v_by=j7.id', 'left')
            ->join('ref_functional_designation as j7f', 'j7.functional_designation_id=j7f.id', 'left')
            ->join('users_info as j8', 'a.stf_by=j8.id', 'left')
            ->join('users_info as j9', 'a.finance_r_by=j9.id', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function get_row_details_lawyer($id)
    {
        $this->db
            ->select('a.sl_no,a.file_for_finance,a.file_from_finance,a.finance_r_reason,DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
                CONCAT(u.name," (",u.code,")") as vendor_name,tx.name as tax_vat_text,
                DATE_FORMAT(a.memo_e_dt,"%d-%b-%y") AS bill_dt,DATE_FORMAT(a.received_dt,"%d-%b-%y") AS received_dt,
                a.dispatch_no,a.bill_amount,a.discount_amount,
                a.memo_remarks,CONCAT(j6.name," (",j6.user_id,")")as memo_e_by,
                CONCAT(j8.name," (",j8.user_id,")")as stf_by,
                DATE_FORMAT(a.stf_dt,"%d-%b-%y") AS stf_dt,
                CONCAT(j9.name," (",j9.user_id,")")as finance_r_by,
                DATE_FORMAT(a.finanace_r_dt,"%d-%b-%y %h:%i %p") AS finanace_r_dt,
                CONCAT(j7.name," (",j7.user_id,")")as v_by', FALSE)
            ->from("bill_summery a")
            ->join('ref_tax_vat_text as tx', 'a.tax_vat_text=tx.id', 'left')
            ->join('ref_lawyer as u', 'a.vendor=u.id and a.bill_type=1', 'left')
            ->join('users_info as j6', 'a.memo_e_by=j6.id', 'left')
            ->join('users_info as j7', 'a.v_by=j7.id', 'left')
            ->join('users_info as j8', 'a.stf_by=j8.id', 'left')
            ->join('users_info as j9', 'a.finance_r_by=j9.id', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function get_row_details_court_fee($id)
    {
        $this->db
            ->select('a.sl_no,a.file_for_finance,a.file_from_finance,a.finance_r_reason,DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
                CONCAT(u.name," (",u.code,")") as vendor_name,tx.name as tax_vat_text,
                DATE_FORMAT(a.memo_e_dt,"%d-%b-%y") AS bill_dt,
                DATE_FORMAT(a.received_dt,"%d-%b-%y") AS received_dt,
                DATE_FORMAT(a.stf_dt,"%d-%b-%y") AS stf_dt,
                DATE_FORMAT(a.stf_dt,"%d-%b-%y") AS stf_dt,
                a.dispatch_no,a.bill_amount,a.discount_amount,
                a.memo_remarks,CONCAT(j6.name," (",j6.user_id,")")as memo_e_by,
                CONCAT(j8.name," (",j8.user_id,")")as stf_by,
                CONCAT(j9.name," (",j9.user_id,")")as finance_r_by,
                DATE_FORMAT(a.finanace_r_dt,"%d-%b-%y %h:%i %p") AS finanace_r_dt,
                CONCAT(j7.name," (",j7.user_id,")")as v_by', FALSE)
            ->from("bill_summery a")
            ->join('ref_tax_vat_text as tx', 'a.tax_vat_text=tx.id', 'left')
            ->join('ref_lawyer as u', 'a.vendor=u.id and a.bill_type=4', 'left')
            ->join('users_info as j6', 'a.memo_e_by=j6.id', 'left')
            ->join('users_info as j7', 'a.v_by=j7.id', 'left')
            ->join('users_info as j8', 'a.stf_by=j8.id', 'left')
            ->join('users_info as j9', 'a.finance_r_by=j9.id', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function get_row_details_paper_bill($id)
    {

        $str = 'SELECT a.sl_no,a.legal_district,a.vendor_type,a.file_for_finance,a.file_from_finance,a.finance_r_reason,DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
                IF(a.vendor_type="Vendor",u.name,CONCAT(u1.name,"(",u1.pin,")")) as vendor_name,tx.name as tax_vat_text,
                DATE_FORMAT(a.memo_e_dt,"%d-%b-%y") AS bill_dt,DATE_FORMAT(a.received_dt,"%d-%b-%y") AS received_dt,
                a.dispatch_no,a.bill_amount,a.discount_amount,a.bill_months,
                a.memo_remarks,CONCAT(j6.name," (",j6.user_id,")")as memo_e_by,
                CONCAT(j8.name," (",j8.user_id,")")as stf_by,IF(a.vendor_type="Staff","",lr.name) as legal_region_name,
                CONCAT(j9.name," (",j9.user_id,")")as finance_r_by,
                DATE_FORMAT(a.stf_dt,"%d-%b-%y") AS stf_dt,
                DATE_FORMAT(a.finanace_r_dt,"%d-%b-%y %h:%i %p") AS finanace_r_dt,
                CONCAT(j7.name," (",j7.user_id,")")as v_by 
                FROM bill_summery a
                LEFT OUTER JOIN ref_tax_vat_text as tx on(a.tax_vat_text=tx.id)
                LEFT OUTER JOIN ref_paper_vendor as u on(a.vendor=u.id and a.bill_type=2 and a.vendor_type="Vendor")
                LEFT OUTER JOIN users_info as u1 on(a.vendor=u1.id and a.bill_type=2 and a.vendor_type="Staff")
                LEFT OUTER JOIN users_info as j6 on(a.memo_e_by=j6.id)
                LEFT OUTER JOIN users_info as j7 on(a.v_by=j7.id)
                LEFT OUTER JOIN ref_legal_region as lr on(u.region=lr.id and a.bill_type=2 and a.vendor_type="Vendor")
                LEFT OUTER JOIN users_info as j8 on(a.stf_by=j8.id)
                LEFT OUTER JOIN users_info as j9 on(a.finance_r_by=j9.id)
                WHERE a.id="'.$id.'" and a.sts<>0 LIMIT 1';
        $query=$this->db->query($str);
        return $query->row();
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
    function get_row_details_other_bill($id)
    {
        $this->db
            ->select('a.sl_no,a.file_for_finance,a.file_from_finance,a.finance_r_reason,DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,
                a.vendor_name as vendor_name,tx.name as tax_vat_text,
                DATE_FORMAT(a.memo_e_dt,"%d-%b-%y") AS bill_dt,DATE_FORMAT(a.received_dt,"%d-%b-%y") AS received_dt,
                a.dispatch_no,a.bill_amount,a.discount_amount,
                a.memo_remarks,CONCAT(j6.name," (",j6.user_id,")")as memo_e_by,
                CONCAT(j8.name," (",j8.user_id,")")as stf_by,
                CONCAT(j9.name," (",j9.user_id,")")as finance_r_by,
                DATE_FORMAT(a.finanace_r_dt,"%d-%b-%y %h:%i %p") AS finanace_r_dt,
                CONCAT(j7.name," (",j7.user_id,")")as v_by', FALSE)
            ->from("bill_summery a")
            ->join('ref_tax_vat_text as tx', 'a.tax_vat_text=tx.id', 'left')
            ->join('users_info as j6', 'a.memo_e_by=j6.id', 'left')
            ->join('users_info as j7', 'a.v_by=j7.id', 'left')
            ->join('users_info as j8', 'a.stf_by=j8.id', 'left')
            ->join('users_info as j9', 'a.finance_r_by=j9.id', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function get_report_details($id)
    {
        $this->db
            ->select('a.*,a.sl_no,DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,GROUP_CONCAT(j8.name order by j8.id ASC) as approver_name,j9.name as stc_name,j9.pin as stc_pin,"" as stc_group,j2.name as stc_designation, 
                e.name as bill_type_name,IF(a.bill_type=1,l.name,IF(a.bill_type=2,v.name,a.vendor_name)) as vendor_name,
                DATE_FORMAT(a.bill_dt,"%d-%b-%y") AS bill_dt,DATE_FORMAT(a.received_dt,"%d-%b-%y") AS received_dt,
                a.dispatch_no,a.bill_amount,a.discount_amount,
                a.memo_remarks,j6.name as memo_e_by,j6.pin as e_pin,"" as e_group,j11.name as e_designation,j7.name as v_by,"" as v_group,j7.pin as v_pin,j1.name as v_designation', FALSE)
            ->from("bill_summery a")
            ->join('ref_expense_type as e', 'e.id=a.bill_type', 'left')
            ->join('ref_lawyer as l', 'l.id=a.vendor', 'left')
            ->join('ref_paper_vendor as v', 'v.id=a.vendor', 'left')
            ->join('users_info as j6', 'a.memo_e_by=j6.id', 'left')
            ->join('ref_functional_designation as j11', 'j6.functional_designation_id=j11.id', 'left')
            ->join('users_info as j7', 'a.v_by=j7.id', 'left')
            ->join('ref_functional_designation as j1', 'j7.functional_designation_id=j1.id', 'left')
            ->join('users_info as j9', 'a.stc_by=j9.id', 'left')
            ->join('ref_functional_designation as j2', 'j9.functional_designation_id=j2.id', 'left')
            ->join('ref_approver_list as j8', 'find_in_set(j8.id, a.approver_list)', 'left')
            ->where("a.id='".$id."' and a.sts<>0", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function update_bill()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $final_amount = ($_POST['amount']-$_POST['diduction_amount']);
        $data = array('diduction_amount' => $_POST['diduction_amount'],'diduction_remarks'=>$_POST['diduction_remarks'],'amount'=>$final_amount,'ded_by'=> $this->session->userdata['ast_user']['user_id'], 'ded_dt'=>date('Y-m-d H:i:s'));
        $this->db->where('id', $_POST['id']);
        $this->db->update('cost_details', $data);
        $data2 = array(
            'cost_id' => $_POST['id'],
            'ded_amount' =>$_POST['diduction_amount'],
            'ded_remarks' =>$_POST['diduction_remarks'],
            'final_amount' =>$final_amount,
            'prev_amount' =>$_POST['amount'],
            'ded_by' =>$this->session->userdata['ast_user']['user_id'],
            'ded_dt' =>date('Y-m-d H:i:s')
        );
        $this->db->insert('diduction_history', $data2);
        $data2 = $this->user_model->user_activities_bill(39,'cost_details',$this->input->post('id'),'bill_summery','Add Diduction amount ('.$this->input->post('id').')');
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return '00';
        }
        else
        {
            $this->db->trans_commit();
            return $_POST['id'];
        }
    }
    function delete_action()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        if($this->input->post('type')=='sendtochecker'){
            $pre_action_result=$this->Common_model->get_pre_action_data('bill_summery',$_POST['verifyid'],'26','sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('sts' => 26,'stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('bill_summery', $data);
                $data3=array('memo_sts' => 26);
                $this->db->where('bill_id', $_POST['verifyid']);
                $this->db->update('cost_details', $data3);

                $application_data = $this->db->query("SELECT b.id,b.bill_type,
                    IF(b.bill_type IN(1,4),l.name,p.name) as vendor_name,b.bill_months 
                    from bill_summery b
                    LEFT OUTER JOIN ref_lawyer l on(l.id=b.vendor AND b.bill_type IN(1,4))
                    LEFT OUTER JOIN ref_paper_vendor p on(p.id=b.vendor AND b.bill_type IN(2))
                    where b.id='".$_POST['verifyid']."' AND b.bill_type IN(1,2,4)")->row();
                if(!empty($application_data))
                {
                    $subject = "";
                    $url = "";
                    if($application_data->bill_type=='1')
                    {
                        $subject = "Need Approval on ".$application_data->vendor_name." Professional Bill month of ".$application_data->bill_months;
                        $url=base_url()."bill_ho/lawyer_bill_details";
                    }
                    else if($application_data->bill_type=='4')
                    {
                        $subject = "Need Approval on ".$application_data->vendor_name." Court Fee month of ".$application_data->bill_months;
                        $url=base_url()."bill_ho/court_fee_details";
                    }
                    else if($application_data->bill_type=='2')
                    {
                        $subject = "Need Approval on Paper Publication Bill month of ".$application_data->bill_months." in favor of ".$application_data->vendor_name;
                        $url=base_url()."bill_ho/paper_bill_details";
                    }
                    $data2 = $this->Common_model->push_notification_data($subject,$url,'bill_summery',$_POST['verifyid'],date('Y-m-d'),'','all','1','11');
                }

                $data2 = $this->user_model->user_activities_bill(26,'bill_memo',$this->input->post('verifyid'),'bill_summery','Send to checker Bill Memo('.$this->input->post('verifyid').')');
            }
            
        }
        if($this->input->post('type')=='verify_return'){
                $pre_action_result=$this->Common_model->get_pre_action_data('bill_summery',$_POST['verifyid'],'27,28,29','sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('sts' => 27,'return_reason' => $_POST['return_reason_verify'],'return_by'=> $this->session->userdata['ast_user']['user_id'], 'return_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('bill_summery', $data);
                    $data3=array('memo_sts' => 25);
                    $this->db->where('bill_id', $_POST['verifyid']);
                    $this->db->update('cost_details', $data3);
                    $data2 = $this->user_model->user_activities_bill(27,'bill_memo',$this->input->post('verifyid'),'bill_summery','Bill Memo Return By Checker('.$this->input->post('verifyid').')',$_POST['return_reason_verify']);
                    
                    $application_data = $this->db->query("SELECT b.id,b.bill_type,b.memo_e_by,
                    IF(b.bill_type IN(1,4),l.name,p.name) as vendor_name,b.bill_months 
                    from bill_summery b
                    LEFT OUTER JOIN ref_lawyer l on(l.id=b.vendor AND b.bill_type IN(1,4))
                    LEFT OUTER JOIN ref_paper_vendor p on(p.id=b.vendor AND b.bill_type IN(2))
                    where b.id='".$_POST['verifyid']."' AND b.bill_type IN(1,2,4)")->row();
                    if(!empty($application_data))
                    {
                        $subject = "";
                        $url = "";
                        if($application_data->bill_type=='1')
                        {
                            $subject = $application_data->vendor_name." Professional Bill month of ".$application_data->bill_months." has been Returned.[".$_POST['return_reason_verify']."]";
                            $url=base_url()."bill_ho/lawyer_bill_details";
                        }
                        else if($application_data->bill_type=='4')
                        {
                            $subject = $application_data->vendor_name." Court Fee month of ".$application_data->bill_months." has been Returned.[".$_POST['return_reason_verify']."]";
                            $url=base_url()."bill_ho/court_fee_details";
                        }
                        else if($application_data->bill_type=='2')
                        {
                            $subject = "Paper Publication Bill month of ".$application_data->bill_months." in favor of ".$application_data->vendor_name." has been Returned.[".$_POST['return_reason_verify']."]";
                            $url=base_url()."bill_ho/paper_bill_details";
                        }
                        $data2 = $this->Common_model->push_notification_data($subject,$url,'bill_summery',$_POST['verifyid'],date('Y-m-d'),'',$application_data->memo_e_by,'1','11');
                    }
                }
                
            }
        if($this->input->post('type')=='verify_reject'){
                $pre_action_result=$this->Common_model->get_pre_action_data('bill_summery',$_POST['verifyid'],'27,28,29','sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('sts' => 28,'reject_reason' => $_POST['return_reason_verify'],'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('bill_summery', $data);
                    $data3=array('memo_sts' => 28);
                    $this->db->where('bill_id', $_POST['verifyid']);
                    $this->db->update('cost_details', $data3);
                    $data2 = $this->user_model->user_activities_bill(28,'bill_memo',$this->input->post('verifyid'),'bill_summery','Bill Memo Reject By Checker('.$this->input->post('verifyid').')',$_POST['return_reason_verify']);
                    
                    $application_data = $this->db->query("SELECT b.id,b.bill_type,b.memo_e_by,
                    IF(b.bill_type IN(1,4),l.name,p.name) as vendor_name,b.bill_months 
                    from bill_summery b
                    LEFT OUTER JOIN ref_lawyer l on(l.id=b.vendor AND b.bill_type IN(1,4))
                    LEFT OUTER JOIN ref_paper_vendor p on(p.id=b.vendor AND b.bill_type IN(2))
                    where b.id='".$_POST['verifyid']."' AND b.bill_type IN(1,2,4)")->row();
                    if(!empty($application_data))
                    {
                        $subject = "";
                        $url = "";
                        if($application_data->bill_type=='1')
                        {
                            $subject = $application_data->vendor_name." Professional Bill month of ".$application_data->bill_months." has been declined.[".$_POST['return_reason_verify']."]";
                            $url=base_url()."bill_ho/lawyer_bill_details";
                        }
                        else if($application_data->bill_type=='4')
                        {
                            $subject = $application_data->vendor_name." Court Fee month of ".$application_data->bill_months." has been declined.[".$_POST['return_reason_verify']."]";
                            $url=base_url()."bill_ho/court_fee_details";
                        }
                        else if($application_data->bill_type=='2')
                        {
                            $subject = "Paper Publication Bill month of ".$application_data->bill_months." in favor of ".$application_data->vendor_name." has been declined.[".$_POST['return_reason_verify']."]";
                            $url=base_url()."bill_ho/paper_bill_details";
                        }
                        $data2 = $this->Common_model->push_notification_data($subject,$url,'bill_summery',$_POST['verifyid'],date('Y-m-d'),'',$application_data->memo_e_by,'1','11');
                    }
                }
                
            }
        if($this->input->post('type')=='verify'){
                $pre_action_result=$this->Common_model->get_pre_action_data('bill_summery',$_POST['verifyid'],'27,28,29','sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    
                    //For Court Entertainment Bill Verify diduction amount
                    if(isset($_POST['court_entertainment']) && $_POST['court_entertainment']=='court_entertainment')
                    {
                        $str="SELECT  j0.amount,j0.diduction_amount,j0.id
                                     FROM cost_details j0
                                 WHERE j0.bill_id= '".$_POST['verifyid']."'";
                                     
                        $application_data=$this->db->query($str)->result();
                        if(!empty($application_data))
                        {
                            foreach ($application_data as $key) 
                            {
                                if($key->diduction_amount>0 && $key->diduction_amount!='' && $key->diduction_amount!=NULL)
                                {
                                    $final_amount = ($key->amount-$key->diduction_amount);
                                    $data3=array('amount' => $final_amount);
                                    $this->db->where('id', $key->id);
                                    $this->db->update('cost_details', $data3);
                                }
                            }
                        }
                    }
                    $data = array('sts' => 29,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('bill_summery', $data);
                    $data3=array('memo_sts' => 29);
                    $this->db->where('bill_id', $_POST['verifyid']);
                    $this->db->update('cost_details', $data3);

                    $application_data = $this->db->query("SELECT b.id,b.bill_type,b.memo_e_by,
                    IF(b.bill_type IN(1,4),l.name,p.name) as vendor_name,b.bill_months 
                    from bill_summery b
                    LEFT OUTER JOIN ref_lawyer l on(l.id=b.vendor AND b.bill_type IN(1,4))
                    LEFT OUTER JOIN ref_paper_vendor p on(p.id=b.vendor AND b.bill_type IN(2))
                    where b.id='".$_POST['verifyid']."' AND b.bill_type IN(1,2,4)")->row();
                    if(!empty($application_data))
                    {
                        $subject = "";
                        $url = "";
                        if($application_data->bill_type=='1')
                        {
                            $subject = "Head Office Approved the ".$application_data->vendor_name." Professional Bill month of ".$application_data->bill_months;
                            $url=base_url()."bill_ho/lawyer_bill_details";
                        }
                        else if($application_data->bill_type=='4')
                        {
                            $subject = "Head Office Approved the ".$application_data->vendor_name." Court Fee month of ".$application_data->bill_months;
                            $url=base_url()."bill_ho/court_fee_details";
                        }
                        else if($application_data->bill_type=='2')
                        {
                            $subject = "Head Office Approved the  Paper Publication Bill month of ".$application_data->bill_months." in favor of ".$application_data->vendor_name;
                            $url=base_url()."bill_ho/paper_bill_details";
                        }
                        $data2 = $this->Common_model->push_notification_data($subject,$url,'bill_summery',$_POST['verifyid'],date('Y-m-d'),'',$application_data->memo_e_by,'1','11');
                    }
                    $data2 = $this->user_model->user_activities_bill(29,'bill_memo',$this->input->post('verifyid'),'bill_summery','Approve Bill Memo('.$this->input->post('verifyid').')');
                }
                
            }
        if($this->input->post('type')=='sendtofinance'){
                $pre_action_result=$this->Common_model->get_pre_action_data('bill_summery',$_POST['verifyid'],'70','sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $file_for_finance = $this->get_file_name('file_for_finance','cma_file/file_for_finance/');
                    if($file_for_finance!='')
                    {
                        $history_data = array(
                            'bill_id' => $_POST['verifyid'],
                            'file_name'=> $file_for_finance, 
                            'operation'=> 'file_send_to_finance'
                            );
                        $this->db->insert('expense_file_transfer_history', $history_data);
                    }
                    $data = array('sts' => 70,'file_for_finance' => $file_for_finance,'stf_by'=> $this->session->userdata['ast_user']['user_id'], 'stf_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('bill_summery', $data);
                    $data3=array('memo_sts' => 70);
                    $this->db->where('bill_id', $_POST['verifyid']);
                    $this->db->update('cost_details', $data3);
                    $data2 = $this->user_model->user_activities_bill(70,'bill_memo',$this->input->post('verifyid'),'bill_summery','Approve Bill Memo('.$this->input->post('verifyid').')');
                }
                
            }
        if($this->input->post('type')=='return_finance_approval'){
                $pre_action_result=$this->Common_model->get_pre_action_data('bill_summery',$_POST['verifyid'],'89','sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $file_from_finance = $this->get_file_name('file_from_finance','cma_file/file_from_finance/');
                    if($file_from_finance!='')
                    {
                        $history_data = array(
                            'bill_id' => $_POST['verifyid'],
                            'file_name'=> $file_from_finance, 
                            'operation'=> 'file_send_by_finance'
                            );
                        $this->db->insert('expense_file_transfer_history', $history_data);
                    }
                    $data = array('sts' => 89,'finance_r_reason' => $_POST['return_reason'],'file_from_finance' => $file_from_finance,'finance_r_by'=> $this->session->userdata['ast_user']['user_id'], 'finanace_r_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('bill_summery', $data);
                    $data3=array('memo_sts' => 25);
                    $this->db->where('bill_id', $_POST['verifyid']);
                    $this->db->update('cost_details', $data3);
                    $data2 = $this->user_model->user_activities_bill(89,'bill_memo',$this->input->post('verifyid'),'bill_summery','Bill Memo Return From Finance('.$this->input->post('verifyid').')',$_POST['return_reason']);
                }
                
            }
            if($this->input->post('type')=='verifyfinance'){
                $pre_action_result=$this->Common_model->get_pre_action_data('bill_summery',$_POST['verifyid'],'88','sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('sts' => 88,'finance_v_by'=> $this->session->userdata['ast_user']['user_id'], 'finance_v_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('bill_summery', $data);
                    $data3=array('memo_sts' => 88);
                    $this->db->where('bill_id', $_POST['verifyid']);
                    $this->db->update('cost_details', $data3);
                    $data2 = $this->user_model->user_activities_bill(88,'bill_memo',$this->input->post('verifyid'),'bill_summery','Bill Memo Approve By Finance('.$this->input->post('verifyid').')');
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
            return $_POST['verifyid'];
        }
    }
    function delete_action_court_return()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $row = $this->db->query("SELECT c.bill_id
        FROM court_fee_return as c
        WHERE c.id='".$_POST['verifyid']."' LIMIT 1")->row();
        
        if($this->input->post('type')=='acknowledgement'){
            $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_return',$_POST['verifyid'],'6','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $bill_data['court_fee_return_sts'] = 6;
                $this->db->where('id', $row->bill_id);
                $this->db->update('cost_details', $bill_data);
                $data = array('v_sts' => 6,'hm_ack_by'=> $this->session->userdata['ast_user']['user_id'], 'hm_ack_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('court_fee_return', $data);
                $data2 = $this->user_model->user_activities_bill(6,'court_fee_return',$this->input->post('verifyid'),'court_fee_return','Acknowledge Court Fee Return('.$this->input->post('verifyid').')');
            }
            
        }
        if($this->input->post('type')=='sendtochecker'){
            $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_return',$_POST['verifyid'],'26','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $bill_data['court_fee_return_sts'] = 10;
                $this->db->where('id', $row->bill_id);
                $this->db->update('cost_details', $bill_data);
                $data = array('return_type' => $_POST['return_type'],'v_sts' => 10,'sthc_by'=> $this->session->userdata['ast_user']['user_id'], 'sthc_dt'=>date('Y-m-d H:i:s'));
                if($_POST['return_type']==2)
                {
                    $data['new_amount'] = $_POST['new_amount'];
                    $data['ho_partial_remarks'] = $_POST['partial_remarks'];
                }
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('court_fee_return', $data);
                $data2 = $this->user_model->user_activities_bill(10,'court_fee_return',$this->input->post('verifyid'),'court_fee_return','Send to Ho checker Court Fee Return('.$this->input->post('verifyid').')');
            }
            
        }
        if($this->input->post('type')=='verify_reject'){
                $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_return',$_POST['verifyid'],'12,13','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $bill_data['court_fee_return_sts'] = 0;
                    $this->db->where('id', $row->bill_id);
                    $this->db->update('cost_details', $bill_data);
                    $data = array('v_sts' => 12,'hc_reject_reason' => $_POST['return_reason_verify'],'hc_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'hc_reject_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('court_fee_return', $data);
                    $data2 = $this->user_model->user_activities_bill(12,'court_fee_return',$this->input->post('verifyid'),'court_fee_return','Court Fee Return Reject('.$this->input->post('verifyid').')',$_POST['return_reason_verify']);
                }
                
            }
        if($this->input->post('type')=='verify'){
                $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_return',$_POST['verifyid'],'12,13','sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $bill_data['court_fee_return_sts'] = 13;
                    $this->db->where('id', $row->bill_id);
                    $this->db->update('cost_details', $bill_data);
                    $data = array('v_sts' => 13,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('court_fee_return', $data);
                    $data2 = $this->user_model->user_activities_bill(13,'court_fee_return',$this->input->post('verifyid'),'court_fee_return','Approve Court Fee Return('.$this->input->post('verifyid').')');
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
            return $_POST['verifyid'];
        }
    }
    function delete_action_court_adjust()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $row = $this->db->query("SELECT c.adjustment_bill_id,c.new_account_bill_id,c.remainig_belance_from,c.remaining_belance_with
        FROM court_fee_adjustment as c 
        WHERE c.id='".$_POST['verifyid']."' LIMIT 1")->row();
        
        if($this->input->post('type')=='acknowledgement'){
            $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_adjustment',$_POST['verifyid'],'6','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $adjust_ac = $row->adjustment_bill_id;
                $new_ac = $row->new_account_bill_id;
                $data = array();
                $data['adjust_v_sts'] = 6;
                $this->db->where('id', $adjust_ac);
                $this->db->update('cost_details', $data);

                $this->db->where('id', $new_ac);
                $this->db->update('cost_details', $data);

                $data = array('v_sts' => 6,'hm_ack_by'=> $this->session->userdata['ast_user']['user_id'], 'hm_ack_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('court_fee_adjustment', $data);
                $data2 = $this->user_model->user_activities_bill(6,'court_fee_adjustment',$this->input->post('verifyid'),'court_fee_adjustment','Acknowledge Court Fee Adjustment('.$this->input->post('verifyid').')');
            }
            
        }
        if($this->input->post('type')=='sendtochecker'){
            $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_adjustment',$_POST['verifyid'],'26','v_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $adjust_ac = $row->adjustment_bill_id;
                $new_ac = $row->new_account_bill_id;
                $data = array();
                $data['adjust_v_sts'] = 10;
                $this->db->where('id', $adjust_ac);
                $this->db->update('cost_details', $data);

                $this->db->where('id', $new_ac);
                $this->db->update('cost_details', $data);

                $data = array('v_sts' => 10,'sthc_by'=> $this->session->userdata['ast_user']['user_id'], 'sthc_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['verifyid']);
                $this->db->update('court_fee_adjustment', $data);
                $data2 = $this->user_model->user_activities_bill(10,'court_fee_adjustment',$this->input->post('verifyid'),'court_fee_adjustment','Send to Ho checker Court Fee Adjustment('.$this->input->post('verifyid').')');
            }
            
        }
        if($this->input->post('type')=='verify_reject'){
                $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_adjustment',$_POST['verifyid'],'12,13','v_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
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
                    $data = array('v_sts' => 12,'hc_reject_reason' => $_POST['return_reason_verify'],'hc_reject_by'=> $this->session->userdata['ast_user']['user_id'], 'hc_reject_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('court_fee_adjustment', $data);
                    $data2 = $this->user_model->user_activities_bill(12,'court_fee_adjustment',$this->input->post('verifyid'),'court_fee_adjustment','Court Fee Adjustment Reject('.$this->input->post('verifyid').')',$_POST['return_reason_verify']);
                }
                
            }
        if($this->input->post('type')=='verify'){
                $pre_action_result=$this->Common_model->get_pre_action_data('court_fee_adjustment',$_POST['verifyid'],'12,13','sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $adjust_ac = $row->adjustment_bill_id;
                    $new_ac = $row->new_account_bill_id;
                    $remainig_belance_from = $row->remainig_belance_from;
                    $remaining_belance_with = $row->remaining_belance_with;
                    $data = array();
                    $data['adjust_v_sts'] = 13;
                    if($remainig_belance_from>0)
                    {
                        $data['amount'] = $remainig_belance_from;
                    }
                    $this->db->where('id', $adjust_ac);
                    $this->db->update('cost_details', $data);
                    $data = array();
                    $data['adjust_v_sts'] = 13;
                    if($remaining_belance_with>0)
                    {
                        $data['amount'] = $remaining_belance_with;
                    }
                    $this->db->where('id', $new_ac);
                    $this->db->update('cost_details', $data);
                    $data = array('v_sts' => 13,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['verifyid']);
                    $this->db->update('court_fee_adjustment', $data);
                    $data2 = $this->user_model->user_activities_bill(13,'court_fee_adjustment',$this->input->post('verifyid'),'court_fee_adjustment','Approve Court Fee Adjustment('.$this->input->post('verifyid').')');
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
            return $_POST['verifyid'];
        }
    }
    function add_edit_staff_bill_old($add_edit,$id,$editrow)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if ($add_edit=='add') {
            $sl_no = $this->Common_model->getMAxRef('bill_summery','sl_no',3);
            $dispatch_no = $this->Common_model->getMAxRef('bill_summery','dispatch_no',3);
        }else{$sl_no = $this->security->xss_clean( $this->input->post('sl_no'));$dispatch_no = $this->security->xss_clean( $this->input->post('dispatch_no'));}
        $data = array(
            'sl_no' => $sl_no,
            'bill_type' =>3,
            'received_dt' =>implode('-',array_reverse(explode('/',$this->input->post('received_dt')))),
            //'legal_am' =>$this->security->xss_clean( $this->input->post('legal_am')),
            'tax_vat_text' =>$this->security->xss_clean( $this->input->post('tax_vat_text')),
            'dispatch_no' =>$dispatch_no,//$this->security->xss_clean( $this->input->post('dispatch_no')),
            'bill_amount' =>$this->security->xss_clean( $this->input->post('hidden_bill_amount')),
            'discount_amount' =>$this->security->xss_clean( $this->input->post('discount_amount')),
            'memo_remarks' =>$this->security->xss_clean( $this->input->post('memo_remarks')),
            'payment_type' =>$this->security->xss_clean( $this->input->post('payment_type')),
            'approver_list' =>$this->security->xss_clean( $this->input->post('approver_list')),
            'sts' =>25
        );
        if ($this->input->post('payment_type')==1) {//For AC Transfer
            $data['bank_ac'] = $this->security->xss_clean( $this->input->post('bank_ac_ac'));
            $data['bank'] ='';
            $data['routing_no'] ='';
        }
        else//For Rtgs
        {
            $data['bank_ac'] = $this->security->xss_clean( $this->input->post('ac_no_rtgs'));
            $data['bank'] =$this->security->xss_clean( $this->input->post('bank'));
            $data['routing_no'] =$this->security->xss_clean( $this->input->post('routing_no'));
        }
        //For ADD
        if ($add_edit=='add') {
            $data['vendor'] =$this->security->xss_clean( $this->input->post('staff'));
            $data['year'] =$this->security->xss_clean( $this->input->post('year'));
            $data['month'] =$this->security->xss_clean( $this->input->post('bill_month'));
            $data['memo_e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['memo_e_dt'] = date('Y-m-d H:i:s');
            $this->db->insert('bill_summery', $data);
            $insert_idss = $this->db->insert_id();
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('cost_details',$_POST['event_id_'.$i],'25','memo_sts');
                    if (count($pre_action_result)>0) 
                    {
                        $this->db->trans_rollback();
                        return 'taken';
                    }
                    else
                    {
                        $data = array('memo_sts' => 25,'bill_id' => $insert_idss);
                        $this->db->where('id', $_POST['event_id_'.$i]);
                        $this->db->update('cost_details', $data);
                    }
                }
                
            }
            $data2 = $this->user_model->user_activities_bill(25,'bill_memo',$insert_idss,'bill_summery','Entry Bill Memo('.$insert_idss.')');
        }
        else //For Update Existing Suit Filling Info for this CMA
        {
            $edit_id = $id;
            if ($_POST['bill_select']==0) {//Delete when no bill selected
                $data['sts'] = 0;
                $data['d_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['d_dt'] = date('Y-m-d H:i:s');
                $data['d_reason'] = $_POST['delete_reason_staff_bill'];
            }
            else
            {
                $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['u_dt'] = date('Y-m-d H:i:s');
            }
            $this->db->where('id', $edit_id);
            $this->db->update('bill_summery', $data);
            $insert_idss = $edit_id;

            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $data = array('memo_sts' => 25,'bill_id' => $insert_idss);
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cost_details', $data);
                }
                else if($_POST['event_delete_'.$i]==1 && $_POST['event_memo_id_'.$i]==$insert_idss)
                {
                    $data = array('memo_sts' => 0,'bill_id' => '');
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cost_details', $data);
                }
                
                
            }
            $data2 = $this->user_model->user_activities_bill(35,'bill_memo',$insert_idss,'bill_summery','Update Bill Memo('.$insert_idss.')');
            
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
    function update_segment_wise_data($bill_id)
    {
        $str="SELECT 
          GROUP_CONCAT(
            sub2.account_counter 
            ORDER BY sub2.loan_segment ASC SEPARATOR '###'
          ) AS account_counter,
          GROUP_CONCAT(
            sub2.amount 
            ORDER BY sub2.loan_segment ASC SEPARATOR '###'
          ) AS amount,
          GROUP_CONCAT(
            sub2.discount_amount 
            ORDER BY sub2.loan_segment ASC SEPARATOR '###'
          ) AS discount_amount 
        FROM
          (SELECT 
            CONCAT(
          sub.loan_segment,
          '_',
          SUM(sub.account_counter)
        ) AS 'account_counter',
        sub.loan_segment,
        CONCAT(
          sub.loan_segment,
          '_',
          SUM(sub.amount)
        ) AS 'amount',
        CONCAT(
          sub.loan_segment,
          '_',
          SUM(sub.discount_amount)
        ) AS 'discount_amount',
        sub.bill_id 
      FROM
        (SELECT 
          bill_id,
          txrn_dt,
          amount,
          discount_amount,
          '1' AS account_counter,
          loan_segment 
        FROM
          cost_details 
        WHERE bill_id = '".$bill_id."' 
        ) sub GROUP BY sub.loan_segment) sub2 GROUP BY sub2.bill_id";
        $query=$this->db->query($str);
        $result =  $query->row();
        $protfolio_wise_discount = "";
        $protfolio_wise_account = "";
        $protfolio_wise_amount = "";
        if(!empty($result))
        {
            $protfolio_wise_discount = $result->discount_amount;
            $protfolio_wise_account = $result->account_counter;
            $protfolio_wise_amount = $result->amount;
        }
        $bill_data = array('protfolio_wise_discount' => $protfolio_wise_discount,
        'protfolio_wise_account' => $protfolio_wise_account,
        'protfolio_wise_amount' => $protfolio_wise_amount);
        $this->db->where('id', $bill_id);
        $this->db->update('bill_summery', $bill_data);
    }
    function add_edit_staff_bill($add_edit,$id,$editrow)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if ($add_edit=='add') {
            $sl_no = $this->Common_model->getMAxRef('bill_summery','sl_no',3);
            $dispatch_no = $this->Common_model->getMAxRef('bill_summery','dispatch_no',3);
        }else{$sl_no = $this->security->xss_clean( $this->input->post('sl_no'));$dispatch_no = $this->security->xss_clean( $this->input->post('dispatch_no'));}
        $data = array(
            'sl_no' => $sl_no,
            'tax_vat_text' =>$this->security->xss_clean( $this->input->post('tax_vat_text')),
            'dispatch_no' =>$dispatch_no,//$this->security->xss_clean( $this->input->post('dispatch_no')),
            'bill_amount' =>$this->security->xss_clean( $this->input->post('hidden_bill_amount')),
            'memo_remarks' =>$this->security->xss_clean( $this->input->post('memo_remarks')),
            'payment_type' =>$this->security->xss_clean( $this->input->post('payment_type')),
            'approver_list' =>$this->security->xss_clean( $this->input->post('approver_list')),
            'bill_type' =>3,
            'sts' =>25
        );
        if ($this->input->post('payment_type')==1) {//For AC Transfer
            $data['bank_ac'] = $this->security->xss_clean( $this->input->post('bank_ac_ac'));
            $data['bank'] ='';
            $data['routing_no'] ='';
        }
        else//For Rtgs
        {
            $data['bank_ac'] = $this->security->xss_clean( $this->input->post('ac_no_rtgs'));
            $data['bank'] =$this->security->xss_clean( $this->input->post('bank'));
            $data['routing_no'] =$this->security->xss_clean( $this->input->post('routing_no'));
        }
        //For ADD
        if ($add_edit=='add') {
            $data['vendor'] =$this->security->xss_clean( $this->input->post('staff'));
            $data['year'] =$this->security->xss_clean( $this->input->post('year'));
            $data['month'] =$this->security->xss_clean( $this->input->post('bill_month'));
            $data['memo_e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['memo_e_dt'] = date('Y-m-d H:i:s');
            $this->db->insert('bill_summery', $data);
            $insert_idss = $this->db->insert_id();
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $all_ids = $_POST['event_memo_id_'.$_POST['event_id_'.$i]];
                    $event_id = $_POST['event_id_'.$i];
                    $all_deduct_amount = $_POST['event_diduct_amount_'.$_POST['event_id_'.$i]];
                    $all_deduct_remarks = $_POST['event_diduct_remarks_'.$_POST['event_id_'.$i]];
                    if(substr($all_ids, -1)==',')//Removing Last Comma
                    {
                        $all_ids = substr($all_ids, 0, -1);
                    }
                    if(substr($all_deduct_amount, -4)=='####')//Removing Last Comma
                    {
                        $all_deduct_amount = substr($all_deduct_amount, 0, -4);
                    }
                    if(substr($all_deduct_remarks, -4)=='####')//Removing Last Comma
                    {
                        $all_deduct_remarks = substr($all_deduct_remarks, 0, -4);
                    }
                    $singl_id = explode(",",$all_ids);
                    for ($k=0; $k < count($singl_id); $k++) 
                    { 
                        $pre_action_result=$this->Common_model->get_pre_action_data('cost_details',$singl_id[$k],'25','memo_sts');
                        if (count($pre_action_result)>0) 
                        {
                            $this->db->trans_rollback();
                            return 'taken';
                        }
                        else
                        {
                            $deduct_amount = 0;
                            $deduct_remarks = "";
                            ///Fro Diduction Amount
                            if($all_deduct_amount!='')
                            {
                                $single_deduct_amount = explode("####",$all_deduct_amount);
                                if(!empty($single_deduct_amount))
                                {
                                    for ($j=0; $j <count($single_deduct_amount) ; $j++) 
                                    { 
                                        $per_deduct_amount  = $single_deduct_amount[$j];
                                        $diduct_id = explode("__$",$per_deduct_amount);
                                        if($diduct_id[0]==$singl_id[$k])
                                        {
                                            $deduct_amount = $diduct_id[1];
                                            break;
                                        }
                                        else
                                        {
                                            $deduct_amount = 0;
                                        }
                                    }
                                }
                                else
                                {
                                    $deduct_amount = 0;
                                }
                            }
                            //For Diduction Remarks
                            if($all_deduct_remarks!='')
                            {
                                $single_deduct_remarks = explode("####",$all_deduct_remarks);
                                if(!empty($single_deduct_remarks))
                                {
                                    for ($j=0; $j <count($single_deduct_remarks) ; $j++) 
                                    { 
                                        $per_deduct_remarks  = $single_deduct_remarks[$j];
                                        $diduct_id = explode("__$",$per_deduct_remarks);
                                        if($diduct_id[0]==$singl_id[$k])
                                        {
                                            $deduct_remarks = $diduct_id[1];
                                            break;
                                        }
                                        else
                                        {
                                            $deduct_remarks = "";
                                        }
                                    }
                                }
                                else
                                {
                                    $deduct_remarks = "";
                                }
                            }
                            

                            if($deduct_amount>0)
                            {
                                //Getting previous amount
                                $str="SELECT  j0.amount
                                                 FROM cost_details j0
                                             WHERE j0.id= '".$singl_id[$k]."' LIMIT 1";
                                             
                                $application_data=$this->db->query($str)->row();
                                $final_amount = ($application_data->amount-$deduct_amount);
                                $data2 = array(
                                    'cost_id' => $singl_id[$k],
                                    'ded_amount' =>$deduct_amount,
                                    'ded_remarks' =>$deduct_remarks,
                                    'final_amount' =>$final_amount,
                                    'prev_amount' =>$application_data->amount,
                                    'ded_by' =>$this->session->userdata['ast_user']['user_id'],
                                    'ded_dt' =>date('Y-m-d H:i:s')
                                );
                                $this->db->insert('diduction_history', $data2);
                            }
                            $data = array('memo_sts' => 25,'bill_id' => $insert_idss);
                            if($deduct_amount>0)
                            {
                                $data['diduction_amount'] = $deduct_amount;
                                $data['diduction_remarks']=$deduct_remarks;
                                //$data['amount']=$final_amount;
                                $data['ded_by']= $this->session->userdata['ast_user']['user_id'];
                                $data['ded_dt']=date('Y-m-d H:i:s');
                            }
                            $this->db->where('id', $singl_id[$k]);
                            $this->db->update('cost_details', $data);
                        }
                    }
                    
                }
                
            }
            $str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$insert_idss."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_months' => $bill_month);
            $this->db->where('id', $insert_idss);
            $this->db->update('bill_summery', $bill_data);
            //updating segment wise data
            $this->update_segment_wise_data($insert_idss);
            $data2 = $this->user_model->user_activities_bill(25,'bill_memo',$insert_idss,'bill_summery','Entry Bill Memo('.$insert_idss.')');
        }
        else 
        {
            $edit_id = $id;
            if ($_POST['bill_select']==0) {//Delete when no bill selected
                $data['sts'] = 0;
                $data['d_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['d_dt'] = date('Y-m-d H:i:s');
                $data['d_reason'] = $_POST['delete_reason_staff_bill'];
            }
            else
            {
                $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['u_dt'] = date('Y-m-d H:i:s');
            }
            $this->db->where('id', $edit_id);
            $this->db->update('bill_summery', $data);
            $insert_idss = $edit_id;
            //Initially unselecting all cost data then select only selected data in bellow function
            $data = array('memo_sts' => '','bill_id' => '');
            $this->db->where('bill_id', $insert_idss);
            $this->db->update('cost_details', $data);
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $all_ids = $_POST['event_memo_id_'.$_POST['event_id_'.$i]];
                    $event_id = $_POST['event_id_'.$i];
                    $all_deduct_amount = $_POST['event_diduct_amount_'.$_POST['event_id_'.$i]];
                    $all_deduct_remarks = $_POST['event_diduct_remarks_'.$_POST['event_id_'.$i]];
                    if(substr($all_ids, -1)==',')//Removing Last Comma
                    {
                        $all_ids = substr($all_ids, 0, -1);
                    }
                    if(substr($all_deduct_amount, -4)=='####')//Removing Last Comma
                    {
                        $all_deduct_amount = substr($all_deduct_amount, 0, -4);
                    }
                    if(substr($all_deduct_remarks, -4)=='####')//Removing Last Comma
                    {
                        $all_deduct_remarks = substr($all_deduct_remarks, 0, -4);
                    }
                    $singl_id = explode(",",$all_ids);
                    for ($k=0; $k < count($singl_id); $k++) 
                    { 
                        $deduct_amount = 0;
                        $deduct_remarks = "";
                        ///For Diduction Amount
                        if($all_deduct_amount!='')
                        {
                            $single_deduct_amount = explode("####",$all_deduct_amount);
                            if(!empty($single_deduct_amount))
                            {
                                for ($j=0; $j <count($single_deduct_amount) ; $j++) 
                                { 
                                    $per_deduct_amount  = $single_deduct_amount[$j];
                                    $diduct_id = explode("__$",$per_deduct_amount);
                                    if($diduct_id[0]==$singl_id[$k])
                                    {
                                        $deduct_amount = $diduct_id[1];
                                        break;
                                    }
                                    else
                                    {
                                        $deduct_amount = 0;
                                    }
                                }
                            }
                            else
                            {
                                $deduct_amount = 0;
                            }
                        }
                        //For Diduction Remarks
                        if($all_deduct_remarks!='')
                        {
                            $single_deduct_remarks = explode("####",$all_deduct_remarks);
                            if(!empty($single_deduct_remarks))
                            {
                                for ($j=0; $j <count($single_deduct_remarks) ; $j++) 
                                { 
                                    $per_deduct_remarks  = $single_deduct_remarks[$j];
                                    $diduct_id = explode("__$",$per_deduct_remarks);
                                    if($diduct_id[0]==$singl_id[$k])
                                    {
                                        $deduct_remarks = $diduct_id[1];
                                        break;
                                    }
                                    else
                                    {
                                        $deduct_remarks = "";
                                    }
                                }
                            }
                            else
                            {
                                $deduct_remarks = "";
                            }
                        }
                        

                        if($deduct_amount>0)
                        {
                            //Getting previous amount
                            $str="SELECT  j0.amount
                                             FROM cost_details j0
                                         WHERE j0.id= '".$singl_id[$k]."' LIMIT 1";
                                         
                            $application_data=$this->db->query($str)->row();
                            $final_amount = ($application_data->amount-$deduct_amount);
                            $data2 = array(
                                'cost_id' => $singl_id[$k],
                                'ded_amount' =>$deduct_amount,
                                'ded_remarks' =>$deduct_remarks,
                                'final_amount' =>$final_amount,
                                'prev_amount' =>$application_data->amount,
                                'ded_by' =>$this->session->userdata['ast_user']['user_id'],
                                'ded_dt' =>date('Y-m-d H:i:s')
                            );
                            $this->db->insert('diduction_history', $data2);
                        }
                        $data = array('memo_sts' => 25,'bill_id' => $insert_idss);
                        if($deduct_amount>0)
                        {
                            $data['diduction_amount'] = $deduct_amount;
                            $data['diduction_remarks']=$deduct_remarks;
                            //$data['amount']=$final_amount;
                            $data['ded_by']= $this->session->userdata['ast_user']['user_id'];
                            $data['ded_dt']=date('Y-m-d H:i:s');
                        }
                        $this->db->where('id', $singl_id[$k]);
                        $this->db->update('cost_details', $data);
                    }
                }
                else if($_POST['event_delete_'.$i]==1 && $_POST['event_bill_id_'.$i]==$insert_idss)
                {
                    $all_ids = $_POST['event_memo_id_'.$_POST['event_id_'.$i]];
                    $event_id = $_POST['event_id_'.$i];
                    if(substr($all_ids, -1)==',')//Removing Last Comma
                    {
                        $all_ids = substr($all_ids, 0, -1);
                    }
                    $singl_id = explode(",",$all_ids);
                    for ($k=0; $k < count($singl_id); $k++) 
                    { 
                        $data = array('memo_sts' => 0,'bill_id' => '','diduction_amount' => '','diduction_remarks' => '','ded_by' => '','ded_dt' => '');
                        $this->db->where('id', $singl_id[$k]);
                        $this->db->update('cost_details', $data);
                    }
                }
                
                
            }
            $str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$insert_idss."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_months' => $bill_month);
            $this->db->where('id', $insert_idss);
            $this->db->update('bill_summery', $bill_data);
            //updating segment wise data
            $this->update_segment_wise_data($insert_idss);
            $data2 = $this->user_model->user_activities_bill(35,'bill_memo',$insert_idss,'bill_summery','Update Bill Memo('.$insert_idss.')');
            
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
    function add_edit_court_bill($add_edit,$id,$editrow)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if ($add_edit=='add') {
            $sl_no = $this->Common_model->getMAxRef('bill_summery','sl_no',5);
            $dispatch_no = $this->Common_model->getMAxRef('bill_summery','dispatch_no',5);
        }else{$sl_no = $this->security->xss_clean( $this->input->post('sl_no'));$dispatch_no = $this->security->xss_clean( $this->input->post('dispatch_no'));}
        $data = array(
            'sl_no' => $sl_no,
            'bill_type' =>5,
            'bill_amount' =>$this->security->xss_clean( $this->input->post('hidden_bill_amount')),
            'dispatch_no' =>$dispatch_no,//$this->security->xss_clean( $this->input->post('dispatch_no')),
            'approver_list' =>$this->security->xss_clean( $this->input->post('approver_list')),
            'sts' =>25
        );
        //For ADD
        if ($add_edit=='add') {
            $data['month'] =$this->security->xss_clean( $this->input->post('hidden_billing_month'));
            $data['staff_pin'] =$this->security->xss_clean( $this->input->post('hidden_staff_pin'));
            $data['employee_type'] =$this->security->xss_clean( $this->input->post('hidden_emp_type'));
            $data['memo_e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['memo_e_dt'] = date('Y-m-d H:i:s');
            $this->db->insert('bill_summery', $data);
            $insert_idss = $this->db->insert_id();
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $all_ids = $_POST['event_memo_id_'.$_POST['event_id_'.$i]];
                    $event_id = $_POST['event_id_'.$i];
                    $all_deduct_amount = $_POST['event_diduct_amount_'.$_POST['event_id_'.$i]];
                    $all_deduct_remarks = $_POST['event_diduct_remarks_'.$_POST['event_id_'.$i]];
                    if(substr($all_ids, -1)==',')//Removing Last Comma
                    {
                        $all_ids = substr($all_ids, 0, -1);
                    }
                    if(substr($all_deduct_amount, -4)=='####')//Removing Last Comma
                    {
                        $all_deduct_amount = substr($all_deduct_amount, 0, -4);
                    }
                    if(substr($all_deduct_remarks, -4)=='####')//Removing Last Comma
                    {
                        $all_deduct_remarks = substr($all_deduct_remarks, 0, -4);
                    }
                    $singl_id = explode(",",$all_ids);
                    for ($k=0; $k < count($singl_id); $k++) 
                    { 
                        $pre_action_result=$this->Common_model->get_pre_action_data('cost_details',$singl_id[$k],'25','memo_sts');
                        if (count($pre_action_result)>0) 
                        {
                            $this->db->trans_rollback();
                            return 'taken';
                        }
                        else
                        {
                            $deduct_amount = 0;
                            $deduct_remarks = "";
                            ///Fro Diduction Amount
                            if($all_deduct_amount!='')
                            {
                                $single_deduct_amount = explode("####",$all_deduct_amount);
                                if(!empty($single_deduct_amount))
                                {
                                    for ($j=0; $j <count($single_deduct_amount) ; $j++) 
                                    { 
                                        $per_deduct_amount  = $single_deduct_amount[$j];
                                        $diduct_id = explode("__$",$per_deduct_amount);
                                        if($diduct_id[0]==$singl_id[$k])
                                        {
                                            $deduct_amount = $diduct_id[1];
                                            break;
                                        }
                                        else
                                        {
                                            $deduct_amount = 0;
                                        }
                                    }
                                }
                                else
                                {
                                    $deduct_amount = 0;
                                }
                            }
                            //For Diduction Remarks
                            if($all_deduct_remarks!='')
                            {
                                $single_deduct_remarks = explode("####",$all_deduct_remarks);
                                if(!empty($single_deduct_remarks))
                                {
                                    for ($j=0; $j <count($single_deduct_remarks) ; $j++) 
                                    { 
                                        $per_deduct_remarks  = $single_deduct_remarks[$j];
                                        $diduct_id = explode("__$",$per_deduct_remarks);
                                        if($diduct_id[0]==$singl_id[$k])
                                        {
                                            $deduct_remarks = $diduct_id[1];
                                            break;
                                        }
                                        else
                                        {
                                            $deduct_remarks = "";
                                        }
                                    }
                                }
                                else
                                {
                                    $deduct_remarks = "";
                                }
                            }
                            

                            if($deduct_amount>0)
                            {
                                //Getting previous amount
                                $str="SELECT  j0.amount
                                                 FROM cost_details j0
                                             WHERE j0.id= '".$singl_id[$k]."' LIMIT 1";
                                             
                                $application_data=$this->db->query($str)->row();
                                $final_amount = ($application_data->amount-$deduct_amount);
                                $data2 = array(
                                    'cost_id' => $singl_id[$k],
                                    'ded_amount' =>$deduct_amount,
                                    'ded_remarks' =>$deduct_remarks,
                                    'final_amount' =>$final_amount,
                                    'prev_amount' =>$application_data->amount,
                                    'ded_by' =>$this->session->userdata['ast_user']['user_id'],
                                    'ded_dt' =>date('Y-m-d H:i:s')
                                );
                                $this->db->insert('diduction_history', $data2);
                            }
                            $data = array('memo_sts' => 25,'bill_id' => $insert_idss);
                            if($deduct_amount>0)
                            {
                                $data['diduction_amount'] = $deduct_amount;
                                $data['diduction_remarks']=$deduct_remarks;
                                //$data['amount']=$final_amount;
                                $data['ded_by']= $this->session->userdata['ast_user']['user_id'];
                                $data['ded_dt']=date('Y-m-d H:i:s');
                            }
                            $this->db->where('id', $singl_id[$k]);
                            $this->db->update('cost_details', $data);
                        }
                    }
                    
                }
                
            }
            $str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$insert_idss."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_months' => $bill_month);
            $this->db->where('id', $insert_idss);
            $this->db->update('bill_summery', $bill_data);
            //updating segment wise data
            $this->update_segment_wise_data($insert_idss);
            $data2 = $this->user_model->user_activities_bill(25,'bill_memo',$insert_idss,'bill_summery','Entry Bill Memo('.$insert_idss.')');
        }
        else 
        {
            $edit_id = $id;
            if ($_POST['bill_select']==0) {//Delete when no bill selected
                $data['sts'] = 0;
                $data['d_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['d_dt'] = date('Y-m-d H:i:s');
                $data['d_reason'] = $_POST['delete_reason_court_bill'];
            }
            else
            {
                $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['u_dt'] = date('Y-m-d H:i:s');
            }
            $this->db->where('id', $edit_id);
            $this->db->update('bill_summery', $data);
            $insert_idss = $edit_id;
            //Initially unselecting all cost data then select only selected data in bellow function
            $data = array('memo_sts' => '','bill_id' => '');
            $this->db->where('bill_id', $insert_idss);
            $this->db->update('cost_details', $data);
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $all_ids = $_POST['event_memo_id_'.$_POST['event_id_'.$i]];
                    $event_id = $_POST['event_id_'.$i];
                    $all_deduct_amount = $_POST['event_diduct_amount_'.$_POST['event_id_'.$i]];
                    $all_deduct_remarks = $_POST['event_diduct_remarks_'.$_POST['event_id_'.$i]];
                    if(substr($all_ids, -1)==',')//Removing Last Comma
                    {
                        $all_ids = substr($all_ids, 0, -1);
                    }
                    if(substr($all_deduct_amount, -4)=='####')//Removing Last Comma
                    {
                        $all_deduct_amount = substr($all_deduct_amount, 0, -4);
                    }
                    if(substr($all_deduct_remarks, -4)=='####')//Removing Last Comma
                    {
                        $all_deduct_remarks = substr($all_deduct_remarks, 0, -4);
                    }
                    $singl_id = explode(",",$all_ids);
                    for ($k=0; $k < count($singl_id); $k++) 
                    { 
                        $deduct_amount = 0;
                        $deduct_remarks = "";
                        ///For Diduction Amount
                        if($all_deduct_amount!='')
                        {
                            $single_deduct_amount = explode("####",$all_deduct_amount);
                            if(!empty($single_deduct_amount))
                            {
                                for ($j=0; $j <count($single_deduct_amount) ; $j++) 
                                { 
                                    $per_deduct_amount  = $single_deduct_amount[$j];
                                    $diduct_id = explode("__$",$per_deduct_amount);
                                    if($diduct_id[0]==$singl_id[$k])
                                    {
                                        $deduct_amount = $diduct_id[1];
                                        break;
                                    }
                                    else
                                    {
                                        $deduct_amount = 0;
                                    }
                                }
                            }
                            else
                            {
                                $deduct_amount = 0;
                            }
                        }
                        //For Diduction Remarks
                        if($all_deduct_remarks!='')
                        {
                            $single_deduct_remarks = explode("####",$all_deduct_remarks);
                            if(!empty($single_deduct_remarks))
                            {
                                for ($j=0; $j <count($single_deduct_remarks) ; $j++) 
                                { 
                                    $per_deduct_remarks  = $single_deduct_remarks[$j];
                                    $diduct_id = explode("__$",$per_deduct_remarks);
                                    if($diduct_id[0]==$singl_id[$k])
                                    {
                                        $deduct_remarks = $diduct_id[1];
                                        break;
                                    }
                                    else
                                    {
                                        $deduct_remarks = "";
                                    }
                                }
                            }
                            else
                            {
                                $deduct_remarks = "";
                            }
                        }
                        

                        if($deduct_amount>0)
                        {
                            //Getting previous amount
                            $str="SELECT  j0.amount
                                             FROM cost_details j0
                                         WHERE j0.id= '".$singl_id[$k]."' LIMIT 1";
                                         
                            $application_data=$this->db->query($str)->row();
                            $final_amount = ($application_data->amount-$deduct_amount);
                            $data2 = array(
                                'cost_id' => $singl_id[$k],
                                'ded_amount' =>$deduct_amount,
                                'ded_remarks' =>$deduct_remarks,
                                'final_amount' =>$final_amount,
                                'prev_amount' =>$application_data->amount,
                                'ded_by' =>$this->session->userdata['ast_user']['user_id'],
                                'ded_dt' =>date('Y-m-d H:i:s')
                            );
                            $this->db->insert('diduction_history', $data2);
                        }
                        // else//For Removing Diduction
                        // {
                        //     //Getting previous amount
                        //     $str="SELECT  j0.amount,j0.diduction_amount
                        //                      FROM cost_details j0
                        //                  WHERE j0.id= '".$singl_id[$k]."' LIMIT 1";
                                         
                        //     $application_data=$this->db->query($str)->row();
                        //     if(!empty($application_data))
                        //     {
                        //         if($application_data->diduction_amount>0)
                        //         {
                        //             $final_amount = ($application_data->amount+$application_data->diduction_amount);
                        //             $data = array('amount' => $final_amount,'diduction_amount' => '','diduction_remarks' => '','ded_by' => '','ded_dt' => '');
                        //             $this->db->where('id', $singl_id[$k]);
                        //             $this->db->update('cost_details', $data);
                        //         }
                        //     }
                        // }
                        $data = array('memo_sts' => 25,'bill_id' => $insert_idss);
                        if($deduct_amount>0)
                        {
                            $data['diduction_amount'] = $deduct_amount;
                            $data['diduction_remarks']=$deduct_remarks;
                            //$data['amount']=$final_amount;
                            $data['ded_by']= $this->session->userdata['ast_user']['user_id'];
                            $data['ded_dt']=date('Y-m-d H:i:s');
                        }
                        $this->db->where('id', $singl_id[$k]);
                        $this->db->update('cost_details', $data);
                    }
                }
                else if($_POST['event_delete_'.$i]==1 && $_POST['event_bill_id_'.$i]==$insert_idss)
                {
                    $all_ids = $_POST['event_memo_id_'.$_POST['event_id_'.$i]];
                    $event_id = $_POST['event_id_'.$i];
                    if(substr($all_ids, -1)==',')//Removing Last Comma
                    {
                        $all_ids = substr($all_ids, 0, -1);
                    }
                    $singl_id = explode(",",$all_ids);
                    for ($k=0; $k < count($singl_id); $k++) 
                    { 
                        //Getting previous amount
                        // $str="SELECT  j0.amount,j0.diduction_amount
                        //                  FROM cost_details j0
                        //              WHERE j0.id= '".$singl_id[$k]."' LIMIT 1";
                                     
                        // $application_data=$this->db->query($str)->row();
                        //$final_amount = ($application_data->amount+$application_data->diduction_amount);
                        //$data = array('memo_sts' => 0,'amount' => $final_amount,'bill_id' => '','diduction_amount' => '','diduction_remarks' => '','ded_by' => '','ded_dt' => '');
                        $data = array('memo_sts' => 0,'bill_id' => '','diduction_amount' => '','diduction_remarks' => '','ded_by' => '','ded_dt' => '');
                        $this->db->where('id', $singl_id[$k]);
                        $this->db->update('cost_details', $data);
                    }
                }
                
                
            }
            $str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$insert_idss."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_months' => $bill_month);
            $this->db->where('id', $insert_idss);
            $this->db->update('bill_summery', $bill_data);
            $data2 = $this->user_model->user_activities_bill(35,'bill_memo',$insert_idss,'bill_summery','Update Bill Memo('.$insert_idss.')');
            
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
    function add_edit_lawyer_bill($add_edit,$id,$editrow)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if ($add_edit=='add') {
            $sl_no = $this->Common_model->getMAxRef('bill_summery','sl_no',1);
            $dispatch_no = $this->Common_model->getMAxRef('bill_summery','dispatch_no',1);
        }else{$sl_no = $this->security->xss_clean( $this->input->post('sl_no'));$dispatch_no = $this->security->xss_clean( $this->input->post('dispatch_no'));}
        $data = array(
            'sl_no' => $sl_no,
            'bill_type' =>1,
            'received_dt' =>implode('-',array_reverse(explode('/',$this->input->post('received_dt')))),
            'tax_vat_text' =>$this->security->xss_clean( $this->input->post('tax_vat_text')),
            'dispatch_no' =>$dispatch_no,//$this->security->xss_clean( $this->input->post('dispatch_no')),
            'bill_amount' =>$this->security->xss_clean( $this->input->post('hidden_bill_amount')),
            'discount_amount' =>$this->security->xss_clean( $this->input->post('discount_amount')),
            'memo_remarks' =>$this->security->xss_clean( $this->input->post('memo_remarks')),
            'special_bill_sts' =>$this->security->xss_clean( $this->input->post('special_bill_sts')),
            'payment_type' =>$this->security->xss_clean( $this->input->post('payment_type')),
            'approver_list' =>$this->security->xss_clean( $this->input->post('approver_list')),
            'sts' =>25
        );
        if(isset($_POST['hc_lawyer_bill'])){
            $data['hc_lawyer_bill_sts']=$_POST['hc_lawyer_bill'];
        }
        if ($this->input->post('payment_type')==1) {//For AC Transfer
            $data['bank_ac'] = $this->security->xss_clean( $this->input->post('bank_ac_ac'));
            $data['bank'] =6;
            $data['routing_no'] ='';
        }
        else//For Rtgs
        {
            $data['bank_ac'] = $this->security->xss_clean( $this->input->post('ac_no_rtgs'));
            $data['bank'] =$this->security->xss_clean( $this->input->post('bank'));
            $data['routing_no'] =$this->security->xss_clean( $this->input->post('routing_no'));
        }
        //For ADD
        if ($add_edit=='add') {
            $data['vendor'] =$this->security->xss_clean( $this->input->post('lawyer'));
            $data['year'] =$this->security->xss_clean( $this->input->post('year'));
            $data['month'] =$this->security->xss_clean( $this->input->post('bill_month'));
            $data['memo_e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['memo_e_dt'] = date('Y-m-d H:i:s');
            $this->db->insert('bill_summery', $data);
            $insert_idss = $this->db->insert_id();
            $total_discount_amount = 0;
            $total_bill_amount = 0;
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('cost_details',$_POST['event_id_'.$i],'25','memo_sts');
                    if (count($pre_action_result)>0) 
                    {
                        $this->db->trans_rollback();
                        return 'taken';
                    }
                    else
                    {
                        if($_POST['event_id_'.$i]>0)
                        {
                            $total_discount_amount = $total_discount_amount+(float)$_POST['discount_'.$i];
                            $total_bill_amount = $total_bill_amount+(float)$_POST['event_amount_'.$i];
                        }
                        $data = array('memo_sts' => 25,'bill_id' => $insert_idss,'discount_amount' => $_POST['discount_'.$i],'discount_remarks' => $_POST['discount_remarks_'.$i]);
                        $this->db->where('id', $_POST['event_id_'.$i]);
                        $this->db->update('cost_details', $data);
                    }
                }
                
            }
            $str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$insert_idss."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_amount' => $total_bill_amount,'discount_amount' => $total_discount_amount,'bill_months' => $bill_month);
            $this->db->where('id', $insert_idss);
            $this->db->update('bill_summery', $bill_data);
            //updating segment wise data
            $this->update_segment_wise_data($insert_idss);
            $data2 = $this->user_model->user_activities_bill(25,'bill_memo',$insert_idss,'bill_summery','Entry Bill Memo('.$insert_idss.')');
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
            $this->db->update('bill_summery', $data);
            $insert_idss = $edit_id;
            $total_discount_amount =0;
            $total_bill_amount =0;
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    if($_POST['event_id_'.$i]>0)
                    {
                        $total_discount_amount = $total_discount_amount+(float)$_POST['discount_'.$i];
                        $total_bill_amount = $total_bill_amount+(float)$_POST['event_amount_'.$i];
                    }
                    $data = array('memo_sts' => 25,'bill_id' => $insert_idss,'discount_amount' => $_POST['discount_'.$i],'discount_remarks' => $_POST['discount_remarks_'.$i]);
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cost_details', $data);
                }
                else if($_POST['event_delete_'.$i]==1 && $_POST['event_memo_id_'.$i]==$insert_idss)
                {
                    $data = array('memo_sts' => 0,'bill_id' => '','discount_amount' => '','discount_remarks' => '');
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cost_details', $data);
                }
                
                
            }
            $str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$insert_idss."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_amount' => $total_bill_amount,'discount_amount' => $total_discount_amount,'bill_months' => $bill_month);
            $this->db->where('id', $insert_idss);
            $this->db->update('bill_summery', $bill_data);
            //updating segment wise data
            $this->update_segment_wise_data($insert_idss);
            $data2 = $this->user_model->user_activities_bill(35,'bill_memo',$insert_idss,'bill_summery','Update Bill Memo('.$insert_idss.')');
            
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
        if ($add_edit=='add') {
            $sl_no = $this->Common_model->getMAxRef('bill_summery','sl_no',4);
            $dispatch_no = $this->Common_model->getMAxRef('bill_summery','dispatch_no',4);
        }else{$sl_no = $this->security->xss_clean( $this->input->post('sl_no'));$dispatch_no = $this->security->xss_clean( $this->input->post('dispatch_no'));}
        $data = array(
            'sl_no' => $sl_no,
            'bill_type' =>4,
            'received_dt' =>implode('-',array_reverse(explode('/',$this->input->post('received_dt')))),
            'dispatch_no' =>$dispatch_no,//$this->security->xss_clean( $this->input->post('dispatch_no')),
            'tax_vat_text' =>$this->security->xss_clean( $this->input->post('tax_vat_text')),
            'bill_amount' =>$this->security->xss_clean( $this->input->post('hidden_bill_amount')),
            'discount_amount' =>$this->security->xss_clean( $this->input->post('discount_amount')),
            'memo_remarks' =>$this->security->xss_clean( $this->input->post('memo_remarks')),
            'payment_type' =>$this->security->xss_clean( $this->input->post('payment_type')),
            'approver_list' =>$this->security->xss_clean( $this->input->post('approver_list')),
            'sts' =>25
        );
        if ($this->input->post('payment_type')==1) {//For AC Transfer
            $data['bank_ac'] = $this->security->xss_clean( $this->input->post('bank_ac_ac'));
            $data['bank'] ='';
            $data['routing_no'] ='';
        }
        else//For Rtgs
        {
            $data['bank_ac'] = $this->security->xss_clean( $this->input->post('ac_no_rtgs'));
            $data['bank'] =$this->security->xss_clean( $this->input->post('bank'));
            $data['routing_no'] =$this->security->xss_clean( $this->input->post('routing_no'));
        }
        //For ADD
        if ($add_edit=='add') {
            $data['vendor'] =$this->security->xss_clean( $this->input->post('lawyer'));
            $data['year'] =$this->security->xss_clean( $this->input->post('year'));
            $data['month'] =$this->security->xss_clean( $this->input->post('bill_month'));
            $data['memo_e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['memo_e_dt'] = date('Y-m-d H:i:s');
            $this->db->insert('bill_summery', $data);
            $insert_idss = $this->db->insert_id();
            $total_discount_amount =0;
            $total_bill_amount =0;
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('cost_details',$_POST['event_id_'.$i],'25','memo_sts');
                    if (count($pre_action_result)>0) 
                    {
                        $this->db->trans_rollback();
                        return 'taken';
                    }
                    else
                    {
                        if($_POST['event_id_'.$i]>0)
                        {
                            $total_discount_amount = $total_discount_amount+(float)$_POST['discount_'.$i];
                            $total_bill_amount = $total_bill_amount+(float)$_POST['event_amount_'.$i];
                        }
                        $data = array('memo_sts' => 25,'bill_id' => $insert_idss,'discount_amount' => $_POST['discount_'.$i],'discount_remarks' => $_POST['discount_remarks_'.$i]);
                        $this->db->where('id', $_POST['event_id_'.$i]);
                        $this->db->update('cost_details', $data);
                    }
                }
                
            }
            $str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$insert_idss."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_amount' => $total_bill_amount,'discount_amount' => $total_discount_amount,'bill_months' => $bill_month);
            $this->db->where('id', $insert_idss);
            $this->db->update('bill_summery', $bill_data);
            //updating segment wise data
            $this->update_segment_wise_data($insert_idss);
            $data2 = $this->user_model->user_activities_bill(25,'bill_memo',$insert_idss,'bill_summery','Entry Bill Memo('.$insert_idss.')');
        }
        else //For Update Existing Suit Filling Info for this CMA
        {
            $edit_id = $id;
            if ($_POST['bill_select']==0) {//Delete when no bill selected
                $data['sts'] = 0;
                $data['d_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['d_dt'] = date('Y-m-d H:i:s');
                $data['d_reason'] = $_POST['delete_reason_court_fee'];
            }
            else
            {
                $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['u_dt'] = date('Y-m-d H:i:s');
            }
            $this->db->where('id', $edit_id);
            $this->db->update('bill_summery', $data);
            $insert_idss = $edit_id;
            $total_discount_amount =0;
            $total_bill_amount =0;
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    if($_POST['event_id_'.$i]>0)
                    {
                        $total_discount_amount = $total_discount_amount+(float)$_POST['discount_'.$i];
                        $total_bill_amount = $total_bill_amount+(float)$_POST['event_amount_'.$i];
                    }
                    $data = array('memo_sts' => 25,'bill_id' => $insert_idss,'discount_amount' => $_POST['discount_'.$i],'discount_remarks' => $_POST['discount_remarks_'.$i]);
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cost_details', $data);
                }
                else if($_POST['event_delete_'.$i]==1 && $_POST['event_memo_id_'.$i]==$insert_idss)
                {
                    $data = array('memo_sts' => 0,'bill_id' => '','discount_amount' => '','discount_remarks' => '');
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cost_details', $data);
                }
                
                
            }
            $str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$insert_idss."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_amount' => $total_bill_amount,'discount_amount' => $total_discount_amount,'bill_months' => $bill_month);
            $this->db->where('id', $insert_idss);
            $this->db->update('bill_summery', $bill_data);
            //updating segment wise data
            $this->update_segment_wise_data($insert_idss);
            $data2 = $this->user_model->user_activities_bill(35,'bill_memo',$insert_idss,'bill_summery','Update Bill Memo('.$insert_idss.')');
            
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
    function add_edit_paper_bill($add_edit,$id,$editrow)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if ($add_edit=='add') {
            $sl_no = $this->Common_model->getMAxRef('bill_summery','sl_no',2);
            $dispatch_no = $this->Common_model->getMAxRef('bill_summery','dispatch_no',2);
        }else{$sl_no = $this->security->xss_clean( $this->input->post('sl_no'));$dispatch_no = $this->security->xss_clean( $this->input->post('dispatch_no'));}
        $data = array(
            'sl_no' => $sl_no,
            'bill_type' =>2,
            'received_dt' =>implode('-',array_reverse(explode('/',$this->input->post('received_dt')))),
            'dispatch_no' =>$dispatch_no,//$this->security->xss_clean( $this->input->post('dispatch_no')),
            'tax_vat_text' =>$this->security->xss_clean( $this->input->post('tax_vat_text')),
            'bill_amount' =>$this->security->xss_clean( $this->input->post('hidden_bill_amount')),
            'discount_amount' =>$this->security->xss_clean( $this->input->post('discount_amount')),
            'special_bill_sts' =>$this->security->xss_clean( $this->input->post('special_bill_sts')),
            'memo_remarks' =>$this->security->xss_clean( $this->input->post('memo_remarks')),
            'payment_type' =>$this->security->xss_clean( $this->input->post('payment_type')),
            'approver_list' =>$this->security->xss_clean( $this->input->post('approver_list')),
            'legal_region' =>$this->security->xss_clean( $this->input->post('legal_region')),
            'legal_district' =>$this->security->xss_clean( $this->input->post('legal_district')),
            'sts' =>25
        );
        if ($this->input->post('payment_type')==1) {//For AC Transfer
            $data['bank_ac'] = $this->security->xss_clean( $this->input->post('bank_ac_ac'));
            $data['bank'] ='';
            $data['routing_no'] ='';
        }
        else//For Rtgs
        {
            $data['bank_ac'] = $this->security->xss_clean( $this->input->post('ac_no_rtgs'));
            $data['bank'] =$this->security->xss_clean( $this->input->post('bank'));
            $data['routing_no'] =$this->security->xss_clean( $this->input->post('routing_no'));
        }
        //For ADD
        if ($add_edit=='add') {
            if($this->security->xss_clean( $this->input->post('vendor_type'))=='Vendor')
            {
                $data['vendor'] =$this->security->xss_clean( $this->input->post('paper_vendor'));
            }
            else
            {
                $data['vendor'] =$this->security->xss_clean( $this->input->post('staff'));
            }
            $data['vendor_type'] =$this->security->xss_clean( $this->input->post('vendor_type'));
            $data['year'] =$this->security->xss_clean( $this->input->post('year'));
            $data['month'] =$this->security->xss_clean( $this->input->post('bill_month'));
            $data['memo_e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['memo_e_dt'] = date('Y-m-d H:i:s');
            $this->db->insert('bill_summery', $data);
            $insert_idss = $this->db->insert_id();
            $total_discount_amount = 0;
            $total_bill_amount =0;
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('cost_details',$_POST['event_id_'.$i],'25','memo_sts');
                    if (count($pre_action_result)>0) 
                    {
                        $this->db->trans_rollback();
                        return 'taken';
                    }
                    else
                    {
                        if($_POST['event_id_'.$i]>0)
                        {
                            $total_discount_amount = $total_discount_amount+(float)$_POST['discount_'.$i];
                            $total_bill_amount = $total_bill_amount+(float)$_POST['event_amount_'.$i];
                        }
                        $data = array('memo_sts' => 25,'bill_id' => $insert_idss,'discount_amount' => $_POST['discount_'.$i],'discount_remarks' => $_POST['discount_remarks_'.$i]);
                        $this->db->where('id', $_POST['event_id_'.$i]);
                        $this->db->update('cost_details', $data);
                    }
                }
                
            }
            $str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$insert_idss."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_amount' => $total_bill_amount,'discount_amount' => $total_discount_amount,'bill_months' => $bill_month);
            $this->db->where('id', $insert_idss);
            $this->db->update('bill_summery', $bill_data);
            //updating segment wise data
            $this->update_segment_wise_data($insert_idss);
            $data2 = $this->user_model->user_activities_bill(25,'bill_memo',$insert_idss,'bill_summery','Entry Bill Memo('.$insert_idss.')');
        }
        else //For Update Existing Suit Filling Info for this CMA
        {
            $edit_id = $id;
            if ($_POST['bill_select']==0) {//Delete when no bill selected
                $data['sts'] = 0;
                $data['d_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['d_dt'] = date('Y-m-d H:i:s');
                $data['d_reason'] = $_POST['delete_reason_paper_bill'];
            }
            else
            {
                $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['u_dt'] = date('Y-m-d H:i:s');
            }
            $this->db->where('id', $edit_id);
            $this->db->update('bill_summery', $data);
            $insert_idss = $edit_id;
            $total_discount_amount = 0;
            $total_bill_amount =0;
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    if($_POST['event_id_'.$i]>0)
                    {
                        $total_discount_amount = $total_discount_amount+(float)$_POST['discount_'.$i];
                        $total_bill_amount = $total_bill_amount+(float)$_POST['event_amount_'.$i];
                    }
                    $data = array('memo_sts' => 25,'bill_id' => $insert_idss,'discount_amount' => $_POST['discount_'.$i],'discount_remarks' => $_POST['discount_remarks_'.$i]);
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cost_details', $data);
                }
                else if($_POST['event_delete_'.$i]==1 && $_POST['event_memo_id_'.$i]==$insert_idss)
                {
                    $data = array('memo_sts' => 0,'bill_id' => '','discount_amount' => '','discount_remarks' => '');
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cost_details', $data);
                }
                
                
            }
            $str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$insert_idss."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_amount' => $total_bill_amount,'discount_amount' => $total_discount_amount,'bill_months' => $bill_month);
            $this->db->where('id', $insert_idss);
            $this->db->update('bill_summery', $bill_data);
            //updating segment wise data
            $this->update_segment_wise_data($insert_idss);
            $data2 = $this->user_model->user_activities_bill(35,'bill_memo',$insert_idss,'bill_summery','Update Bill Memo('.$insert_idss.')');
            
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
    function add_edit_other_bill($add_edit,$id,$editrow)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if ($add_edit=='add') {
            $sl_no = $this->Common_model->getMAxRef('bill_summery','sl_no',6);
            $dispatch_no = $this->Common_model->getMAxRef('bill_summery','dispatch_no',6);
        }else{$sl_no = $this->security->xss_clean( $this->input->post('sl_no'));$dispatch_no = $this->security->xss_clean( $this->input->post('dispatch_no'));}
        $data = array(
            'sl_no' => $sl_no,
            'bill_type' =>6,
            'tax_vat_text' =>$this->security->xss_clean( $this->input->post('tax_vat_text')),
            'received_dt' =>implode('-',array_reverse(explode('/',$this->input->post('received_dt')))),
            'dispatch_no' =>$dispatch_no,//$this->security->xss_clean( $this->input->post('dispatch_no')),
            'bill_amount' =>$this->security->xss_clean( $this->input->post('hidden_bill_amount')),
            'discount_amount' =>$this->security->xss_clean( $this->input->post('discount_amount')),
            'memo_remarks' =>$this->security->xss_clean( $this->input->post('memo_remarks')),
            'payment_type' =>$this->security->xss_clean( $this->input->post('payment_type')),
            'approver_list' =>$this->security->xss_clean( $this->input->post('approver_list')),
            'sts' =>25
        );
        if ($this->input->post('payment_type')==1) {//For AC Transfer
            $data['bank_ac'] = $this->security->xss_clean( $this->input->post('bank_ac_ac'));
            $data['bank'] ='';
            $data['routing_no'] ='';
        }
        else//For Rtgs
        {
            $data['bank_ac'] = $this->security->xss_clean( $this->input->post('ac_no_rtgs'));
            $data['bank'] =$this->security->xss_clean( $this->input->post('bank'));
            $data['routing_no'] =$this->security->xss_clean( $this->input->post('routing_no'));
        }
        //For ADD
        if ($add_edit=='add') {
            $data['vendor_name'] =$this->security->xss_clean( $this->input->post('vendor_name'));
            $data['year'] =$this->security->xss_clean( $this->input->post('year'));
            $data['month'] =$this->security->xss_clean( $this->input->post('bill_month'));
            $data['memo_e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['memo_e_dt'] = date('Y-m-d H:i:s');
            $this->db->insert('bill_summery', $data);
            $insert_idss = $this->db->insert_id();
            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('cost_details',$_POST['event_id_'.$i],'25','memo_sts');
                    if (count($pre_action_result)>0) 
                    {
                        $this->db->trans_rollback();
                        return 'taken';
                    }
                    else
                    {
                        $data = array('memo_sts' => 25,'bill_id' => $insert_idss);
                        $this->db->where('id', $_POST['event_id_'.$i]);
                        $this->db->update('cost_details', $data);
                    }
                }
                
            }
            $str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$insert_idss."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_months' => $bill_month);
            $this->db->where('id', $insert_idss);
            $this->db->update('bill_summery', $bill_data);
            //updating segment wise data
            $this->update_segment_wise_data($insert_idss);
            $data2 = $this->user_model->user_activities_bill(25,'bill_memo',$insert_idss,'bill_summery','Entry Bill Memo('.$insert_idss.')');
        }
        else //For Update Existing Suit Filling Info for this CMA
        {
            $edit_id = $id;
            if ($_POST['bill_select']==0) {//Delete when no bill selected
                $data['sts'] = 0;
                $data['d_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['d_dt'] = date('Y-m-d H:i:s');
                $data['d_reason'] = $_POST['delete_reason_other_bill'];
            }
            else
            {
                $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
                $data['u_dt'] = date('Y-m-d H:i:s');
            }
            $this->db->where('id', $edit_id);
            $this->db->update('bill_summery', $data);
            $insert_idss = $edit_id;

            for ($i=1;$i<= $_POST['billcount'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $data = array('memo_sts' => 25,'bill_id' => $insert_idss);
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cost_details', $data);
                }
                else if($_POST['event_delete_'.$i]==1 && $_POST['event_memo_id_'.$i]==$insert_idss)
                {
                    $data = array('memo_sts' => 0,'bill_id' => '');
                    $this->db->where('id', $_POST['event_id_'.$i]);
                    $this->db->update('cost_details', $data);
                }
                
                
            }
            $str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$insert_idss."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_months' => $bill_month);
            $this->db->where('id', $insert_idss);
            $this->db->update('bill_summery', $bill_data);
            //updating segment wise data
            $this->update_segment_wise_data($insert_idss);
            $data2 = $this->user_model->user_activities_bill(35,'bill_memo',$insert_idss,'bill_summery','Update Bill Memo('.$insert_idss.')');
            
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
    function get_cost_details_staff_old($id,$month)
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
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(j0.txrn_dt)='".$_POST['year']."'";
        }
        //For type wise where condition
        $where2.="AND j0.vendor_id='".$id."'";
        //For type wise join table
        $select="CONCAT(u.name,' (',u.pin,')')";
        $join.='LEFT OUTER JOIN users_info as u on (j0.vendor_id=u.id and j0.vendor_type=3)';
        
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
        ac.name as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_staff_conv_activities as ac on (j0.activities_id=ac.id)
            WHERE j0.memo_sts=0 AND j0.vendor_type= 3 $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_staff($id,$month)
    {
        $where='';
        $where2='';
        $join='';
        $select='';
        $all_month = explode(",",$month);
        if($month!='')
        {
            $where2.="AND c.month IN('".$month."')";
        }
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND c.year IN('".$_POST['year']."')";
        }
        //For type wise where condition
        if ($id!='') {
            $where2.="AND c.staff_id='".$id."'";
        }
        $str=" SELECT c.*,c.id as event_id,u.name as employee_name,u.pin as staff_pin,e.amount,e.cost_ids,con.name as conv_type_name
            FROM staff_conv_data as c
            LEFT OUTER JOIN (
                SELECT a.main_table_id ,SUM(a.amount) AS amount,GROUP_CONCAT(a.id ORDER BY  a.id ASC SEPARATOR ',') AS cost_ids 
                FROM cost_details a
                WHERE a.main_table_name='staff_conv_data' AND a.memo_sts=0 AND a.vendor_type= 3
                GROUP BY a.main_table_id
            )e ON(c.id=e.main_table_id)
            LEFT OUTER JOIN ref_staff_conv_type con ON(con.id=c.conv_type)
            LEFT OUTER JOIN users_info u ON(u.id=c.staff_id)
            WHERE c.sts<>0 $where2 ORDER BY c.e_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_staff_all($id=NULL,$month=NULL)
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
        if($id!=NULL && $id!='0' && $id!='')
        {
            $where2.="AND j0.vendor_id='".$id."'";
        }
        if (isset($_POST['region']) && $_POST['region']!='') {
            $where2.="AND j0.region='".$_POST['region']."'";
        }

        if (isset($_POST['territory']) && $_POST['territory']!='') {
            $where2.="AND j0.territory='".$_POST['territory']."'";
        }

        if (isset($_POST['district']) && $_POST['district']!='') {
            $where2.="AND j0.district='".$_POST['district']."'";
        }
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(j0.txrn_dt)='".$_POST['year']."'";
        }
        if($this->input->post("dt_from") != ''){$dt_from= $this->input->post("dt_from");} else{$dt_from = '0';}
        if($this->input->post("dt_to") != ''){$dt_to= $this->input->post("dt_to");} else{$dt_to = '0';}
        if($dt_from != '0'){$dt_from = implode('-',array_reverse(explode('/',$dt_from))); }
        else{$dt_from='0';}
        if($dt_to != '0'){ $dt_to= implode('-',array_reverse(explode('/',$dt_to))); }
        else{$dt_to='0';}

        if( $dt_from!='0' && $dt_to=='0')
        { $where2.= " and j0.txrn_dt='".$dt_from."'"; }
        
        if( $dt_from!='0' && $dt_to!='0')
        { $where2.= " and j0.txrn_dt between '".$dt_from."' and '".$dt_to."'";}
        //For type wise join table
        $select="CONCAT(u.name,' (',u.pin,')')";
        $join.='LEFT OUTER JOIN users_info as u on (j0.vendor_id=u.id and j0.vendor_type=3)';
        
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
        ac.name as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_staff_conv_activities as ac on (j0.activities_id=ac.id)
            WHERE j0.memo_sts=0 AND j0.vendor_type= 3 $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_court_old($employee_type,$month,$staff_pin,$year)
    {
        $where='';
        $where2='';
        $join='';
        $select='';
        $legal_region = $this->input->post('legal_region');
        $legal_district = $this->input->post('legal_district');
        if($employee_type!='')
        {
            $where2.="AND c.employee_type IN('".$employee_type."')";
        }
        if($legal_region!='')
        {
            $where2.="AND u.region='".$legal_region."'";
        }
        if($legal_district!='')
        {
            $where2.="AND FIND_IN_SET('".$legal_district."',u.district)";
        }

        if($month!='')
        {
            $where2.="AND c.billing_month IN('".$month."')";
        }

        if($staff_pin!='')
        {
            $where2.="AND c.staff_pin='".$staff_pin."'";
        }
        if ($year) {
            $where2.="AND YEAR(e.txrn_dt)='".$year."'";
        }
        $str=" SELECT c.*,e.id as event_id,e.amount,
        DATE_FORMAT(e.txrn_dt,'%d-%b-%Y') as txrn_dt,
        ac.name as activities_name,e.loan_ac,e.case_number,r.name as legal_region
            FROM court_entertainment_data as c
            RIGHT OUTER JOIN cost_details e ON(c.id=e.main_table_id AND e.main_table_name='court_entertainment_data')
            LEFT OUTER JOIN ref_legal_region r ON(r.id=c.legal_region)
            LEFT OUTER JOIN users_info u ON(u.id=c.staff_id)
            LEFT OUTER JOIN ref_court_entertainment_activities as ac on (e.activities_id=ac.id)
            WHERE e.memo_sts=0 AND e.vendor_type= 5 $where2 ORDER BY e.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_court($employee_type,$month,$staff_pin,$year)
    {
        $where='';
        $where2='';
        $join='';
        $select='';
        $legal_region = $this->input->post('legal_region');
        $legal_district = $this->input->post('legal_district');
        if($employee_type!='')
        {
            $where2.="AND c.employee_type IN('".$employee_type."')";
        }
        if($legal_region!='')
        {
            $where2.="AND FIND_IN_SET(".$legal_region.",u.legal_region)";
        }
        if($legal_district!='')
        {
            $where2.="AND FIND_IN_SET('".$legal_district."',u.legal_district)";
        }
        if($month!='')
        {
            $where2.="AND c.billing_month IN('".$month."')";
        }

        if($staff_pin!='')
        {
            $where2.="AND c.staff_pin='".$staff_pin."'";
        }
        if ($year) {
            $where2.="AND YEAR(c.e_dt)='".$year."'";
        }
        $str=" SELECT c.*,c.id as event_id,e.amount,e.cost_ids,
        r.name as legal_region
            FROM court_entertainment_data as c
            LEFT OUTER JOIN (
                SELECT a.main_table_id ,SUM(a.amount) AS amount,GROUP_CONCAT(a.id ORDER BY  a.id ASC SEPARATOR ',') AS cost_ids FROM cost_details a
                WHERE a.main_table_name='court_entertainment_data' AND a.memo_sts=0 AND a.vendor_type= 5
                GROUP BY a.main_table_id
            )e ON(c.id=e.main_table_id)
            LEFT OUTER JOIN users_info u ON(u.id=c.staff_id)
            LEFT OUTER JOIN ref_legal_region r ON(r.id=c.legal_region)
            WHERE c.sts<>0 $where2 ORDER BY c.e_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_by_court_enter_id($event_id)
    {
        $str="SELECT a.loan_ac,r.name as req_type_name,a.ac_name,a.case_number,a.id,a.main_table_id ,a.amount AS amount,ac.name as activities_name,DATE_FORMAT(a.txrn_dt,'%d-%b-%Y') as txrn_dt,
        a.loan_ac,a.case_number
         FROM cost_details a
         LEFT OUTER JOIN ref_req_type r ON(r.id=a.req_type)
         LEFT OUTER JOIN ref_court_entertainment_activities as ac on (a.activities_id=ac.id)
         WHERE a.main_table_name='court_entertainment_data' AND a.main_table_id='".$event_id."' AND a.memo_sts=0 AND a.vendor_type= 5";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_cost_details_by_staff_conv_id($event_id)
    {
        $str="SELECT a.id,a.main_table_id ,a.amount AS amount,DATE_FORMAT(a.txrn_dt,'%d-%b-%Y') as txrn_dt,
        a.movement_details,a.move_of_transfortaion,a.particulars,a.place,a.description_of_journey,
        a.journey_time,a.journey_metar,a.reached_time,a.reached_metar,a.purpose,
        a.from,a.time_out,a.to,a.time_in,a.mode,a.breakdown_bill,
        DATE_FORMAT(a.to_date,'%d-%b-%Y') as to_date,DATE_FORMAT(a.from_date,'%d-%b-%Y') as from_date
         FROM cost_details a
         WHERE a.main_table_name='staff_conv_data' AND a.main_table_id='".$event_id."' AND a.memo_sts=0 AND a.vendor_type= 3";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_cost_details_by_court_enter_id_edit($event_id,$bill_id)
    {
        $str="SELECT a.loan_ac,r.name as req_type_name,a.ac_name,a.case_number,a.id,a.main_table_id ,a.amount AS amount,ac.name as activities_name,DATE_FORMAT(a.txrn_dt,'%d-%b-%Y') as txrn_dt,
        a.loan_ac,a.case_number
         FROM cost_details a
         LEFT OUTER JOIN ref_req_type r ON(r.id=a.req_type)
         LEFT OUTER JOIN ref_court_entertainment_activities as ac on (a.activities_id=ac.id)
         WHERE a.main_table_name='court_entertainment_data' AND a.main_table_id='".$event_id."' AND (a.memo_sts=0 OR a.bill_id='".$bill_id."') AND a.vendor_type= 5";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_cost_details_by_staff_conv_id_edit($event_id,$bill_id)
    {
        $str="SELECT a.id,a.main_table_id ,a.amount AS amount,DATE_FORMAT(a.txrn_dt,'%d-%b-%Y') as txrn_dt,
        a.movement_details,a.move_of_transfortaion,a.particulars,a.place,a.description_of_journey,
        a.journey_time,a.journey_metar,a.reached_time,a.reached_metar,a.purpose,
        a.from,a.time_out,a.to,a.time_in,a.mode,a.breakdown_bill,
        DATE_FORMAT(a.to_date,'%d-%b-%Y') as to_date,DATE_FORMAT(a.from_date,'%d-%b-%Y') as from_date
         FROM cost_details a
         WHERE a.main_table_name='staff_conv_data' AND a.main_table_id='".$event_id."' AND (a.memo_sts=0 OR a.bill_id='".$bill_id."') AND a.vendor_type= 3";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_cost_details_court_all($staff_id=NULL,$month=NULL)
    {
        $where='';
        $where2='';
        $join='';
        $select='';

        if($month!='')
        {
            $where2.="AND c.billing_month IN('".$month."')";
        }

        if($staff_id!=NULL && $staff_id!='0' && $staff_id!='')
        {
            $where2.="AND c.staff_id='".$staff_id."'";
        }
        if (isset($_POST['region']) && $_POST['region']!='') {
            $where2.="AND e.region=".$this->db->escape($_POST['region']);
        }

        if (isset($_POST['territory']) && $_POST['territory']!='') {
            $where2.="AND e.territory=".$this->db->escape($_POST['territory']);
        }

        if (isset($_POST['district']) && $_POST['district']!='') {
            $where2.="AND e.district=".$this->db->escape($_POST['district']);
        }
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(e.txrn_dt)=".$this->db->escape($_POST['year']);
        }

        if($this->input->post("dt_from") != ''){$dt_from= $this->input->post("dt_from");} else{$dt_from = '0';}
        if($this->input->post("dt_to") != ''){$dt_to= $this->input->post("dt_to");} else{$dt_to = '0';}
        if($dt_from != '0'){$dt_from = implode('-',array_reverse(explode('/',$dt_from))); }
        else{$dt_from='0';}
        if($dt_to != '0'){ $dt_to= implode('-',array_reverse(explode('/',$dt_to))); }
        else{$dt_to='0';}

        if( $dt_from!='0' && $dt_to=='0')
        { $where2.= " and e.txrn_dt='".$dt_from."'"; }
        
        if( $dt_from!='0' && $dt_to!='0')
        { $where2.= " and e.txrn_dt between '".$dt_from."' and '".$dt_to."'";}
        $str=" SELECT c.*,e.id as event_id,e.amount,c.employee_name as vendor_name,e.ac_name,
        DATE_FORMAT(e.txrn_dt,'%d-%b-%Y') as txrn_dt,
        ac.name as activities_name,e.loan_ac,e.case_number,r.name as legal_region
            FROM court_entertainment_data as c
            RIGHT OUTER JOIN cost_details e ON(c.id=e.main_table_id AND e.main_table_name='court_entertainment_data')
            LEFT OUTER JOIN ref_legal_region r ON(r.id=c.legal_region)
            LEFT OUTER JOIN ref_court_entertainment_activities as ac on (e.activities_id=ac.id)
            WHERE e.memo_sts=0 AND e.vendor_type= 5 $where2 ORDER BY e.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_lawyer($id,$month)
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
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(j0.txrn_dt) IN(".$_POST['year'].")";
        }
        //For type wise where condition
        $where2.="AND j0.vendor_id='".$id."'";
        //For type wise join table
        $select="CONCAT(u.name,' (',u.code,')')";
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=1)';
        
        $str=" SELECT sub.* FROM(
            SELECT j0.id,j0.expense_remarks,j0.duplicate_bill_with_proxy,j0.amount,$select as vendor_name,IF(j0.legal_select_sts=93,1,2) as selection_s_order,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,j0.txrn_dt as org_dt,
            j0.loan_ac,j0.ac_name,IF((j0.activities_id IN(1,33) AND j0.req_type=2) OR (j0.activities_id IN(1,29) AND j0.req_type<>2),CONCAT(rq.name,' Legal Notice'),j0.case_number) as case_number,
            IF(j0.activities_id=0,j0.description,IF(j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter',hc.name,IF(j0.main_table_name='case_against_bank',ca.name,IF(j0.main_table_name='legal_affairs',la.name,IF(j0.req_type=2,ar.name,ni.name))))) as activities_name
                FROM cost_details as j0
                $join
                LEFT OUTER JOIN ref_req_type as rq on (j0.req_type=rq.id)
                LEFT OUTER JOIN ref_schedule_charges_ara as ar on (j0.activities_id=ar.id and j0.req_type=2 AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma' OR j0.main_table_name='appeal_deposit_withdraw'))
                LEFT OUTER JOIN ref_schedule_charges_ni as ni on (j0.activities_id=ni.id and j0.req_type<>2 AND j0.req_type IS NOT NULL AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma' OR j0.main_table_name='appeal_deposit_withdraw'))
                LEFT OUTER JOIN ref_hc_activities as hc on (j0.activities_id=hc.id AND (j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter'))
                LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (j0.activities_id=ca.id AND j0.main_table_name='case_against_bank')
                LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (j0.activities_id=la.id AND j0.main_table_name='legal_affairs')
                WHERE j0.module_name<>'high_court' AND (j0.memo_sts=0 OR j0.memo_sts IS NULL) AND (j0.legal_select_sts=0 OR j0.legal_select_sts IS NULL OR j0.legal_select_sts=93) AND j0.vendor_type= 1 AND j0.main_table_name<>'legal_notice' $where2 $where ORDER BY j0.txrn_dt ASC
        )sub ORDER BY sub.selection_s_order ASC,sub.org_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_lawyer_hc($id,$month)
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
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(j0.txrn_dt)=".$this->db->escape($_POST['year']);
        }
        //For type wise where condition
        $where2.="AND j0.vendor_id='".$id."'";
        //For type wise join table
        $select="CONCAT(u.name,' (',u.code,')')";
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=1)';
        
        $str=" SELECT sub.* FROM(
            SELECT j0.id,j0.duplicate_bill_with_proxy,j0.amount,$select as vendor_name,IF(j0.legal_select_sts=93,1,2) as selection_s_order,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,j0.txrn_dt as org_dt,
            j0.loan_ac,j0.ac_name,j0.case_number,
            IF(j0.activities_id=0,j0.description,hc.name) as activities_name
                FROM cost_details as j0
                $join
                LEFT OUTER JOIN ref_hc_activities as hc on (j0.activities_id=hc.id AND j0.module_name='high_court')
                WHERE (j0.memo_sts=0 OR j0.memo_sts IS NULL) AND (j0.legal_select_sts=0 OR j0.legal_select_sts IS NULL OR j0.legal_select_sts=93) AND j0.vendor_type= 1 AND j0.module_name='high_court' $where2 $where ORDER BY j0.txrn_dt ASC
        )sub ORDER BY sub.selection_s_order ASC,sub.org_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_proxy_lawyer($id,$month)
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
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(j0.txrn_dt) IN(".$_POST['year'].")";
        }
        //For type wise where condition
        $where2.="AND j0.proxy_sts=1 AND j0.proxy_against=".$this->db->escape($id);
        //For type wise join table
        $select="CONCAT(u.name,' (',u.code,')')";
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=1)';
        
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
        j0.loan_ac,j0.ac_name,j0.case_number,
        IF(j0.activities_id=0,j0.description,IF(j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter',hc.name,IF(j0.main_table_name='case_against_bank',ca.name,IF(j0.main_table_name='legal_affairs',la.name,IF(j0.req_type=2,ar.name,ni.name))))) as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_schedule_charges_ara as ar on (j0.activities_id=ar.id and j0.req_type=2 AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (j0.activities_id=ni.id and j0.req_type<>2 AND j0.req_type IS NOT NULL AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (j0.activities_id=hc.id AND (j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (j0.activities_id=ca.id AND j0.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (j0.activities_id=la.id AND j0.main_table_name='legal_affairs')
            WHERE j0.memo_sts=0 AND j0.vendor_type= 1 AND j0.main_table_name<>'legal_notice' $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_lawyer_all($id=NULL,$month=NULL)
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
        if($id!=NULL && $id!='0' && $id!='')
        {
            $where2.="AND j0.vendor_id='".$id."'";
        }
        if (isset($_POST['region']) && $_POST['region']!='') {
            $where2.="AND j0.region=".$this->db->escape($_POST['region']);
        }

        if (isset($_POST['territory']) && $_POST['territory']!='') {
            $where2.="AND j0.territory=".$this->db->escape($_POST['territory']);
        }

        if (isset($_POST['district']) && $_POST['district']!='') {
            $where2.="AND j0.district=".$this->db->escape($_POST['district']);
        }

        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(j0.txrn_dt) IN(".$_POST['year'].")";
        }

        if($this->input->post("dt_from") != ''){$dt_from= $this->input->post("dt_from");} else{$dt_from = '0';}
        if($this->input->post("dt_to") != ''){$dt_to= $this->input->post("dt_to");} else{$dt_to = '0';}
        if($dt_from != '0'){$dt_from = implode('-',array_reverse(explode('/',$dt_from))); }
        else{$dt_from='0';}
        if($dt_to != '0'){ $dt_to= implode('-',array_reverse(explode('/',$dt_to))); }
        else{$dt_to='0';}

        if( $dt_from!='0' && $dt_to=='0')
        { $where2.= " and j0.txrn_dt=".$this->db->escape($dt_from); }
        
        if( $dt_from!='0' && $dt_to!='0')
        { $where2.= " and j0.txrn_dt between ".$this->db->escape($dt_from)." and ".$this->db->escape($dt_to);}


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
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (j0.activities_id=ni.id and j0.req_type<>2 AND j0.req_type IS NOT NULL AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (j0.activities_id=hc.id AND (j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (j0.activities_id=ca.id AND j0.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (j0.activities_id=la.id AND j0.main_table_name='legal_affairs')
            WHERE j0.memo_sts=0 AND j0.vendor_type= 1 AND j0.main_table_name<>'legal_notice' $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_court_fee($id,$month)
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
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(j0.txrn_dt) IN(".$_POST['year'].")";
        }
        //For type wise where condition
        $where2.="AND j0.vendor_id='".$id."'";
        //For type wise join table
        $select="CONCAT(u.name,' (',u.code,')')";
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=4)';
        
        $str=" SELECT sub.* FROM(
            SELECT j0.id,j0.amount,$select as vendor_name,IF(j0.legal_select_sts=93,1,2) as selection_s_order,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,j0.txrn_dt as org_dt,
            j0.loan_ac,j0.ac_name,j0.case_number,c.st_belance as suit_value,
            IF(j0.activities_id=0,j0.description,co.name) as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_court_fee_activities as co on (j0.activities_id=co.id AND j0.main_table_name='cma')
            LEFT OUTER JOIN cma as c on (j0.main_table_id=c.id AND j0.main_table_name='cma')
            WHERE (j0.memo_sts=0 OR j0.memo_sts IS NULL) AND ((j0.adjustment_sts IS NULL OR j0.adjustment_sts = '' OR j0.adjustment_sts = 0) OR (j0.adjustment_sts=1 AND (j0.fully_adjust_sts IS NULL OR j0.fully_adjust_sts = '' OR j0.fully_adjust_sts = 0) AND j0.adjust_v_sts=13)) AND (j0.legal_select_sts=0 OR j0.legal_select_sts IS NULL OR j0.legal_select_sts=93) AND j0.vendor_type= 4 $where2 $where ORDER BY j0.txrn_dt ASC
        )sub ORDER BY sub.selection_s_order ASC,sub.org_dt ASC";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_cost_details_court_fee_all($id=NULL,$month=NULL)
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
        if($id!=NULL && $id!='0' && $id!='')
        {
            $where2.="AND j0.vendor_id='".$id."'";
        }
        if (isset($_POST['region']) && $_POST['region']!='') {
            $where2.="AND j0.region=".$this->db->escape($_POST['region']);
        }

        if (isset($_POST['territory']) && $_POST['territory']!='') {
            $where2.="AND j0.territory=".$this->db->escape($_POST['territory']);
        }

        if (isset($_POST['district']) && $_POST['district']!='') {
            $where2.="AND j0.district=".$this->db->escape($_POST['district']);
        }
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(j0.txrn_dt) IN(".$_POST['year'].")";
        }

        if($this->input->post("dt_from") != ''){$dt_from= $this->input->post("dt_from");} else{$dt_from = '0';}
        if($this->input->post("dt_to") != ''){$dt_to= $this->input->post("dt_to");} else{$dt_to = '0';}
        if($dt_from != '0'){$dt_from = implode('-',array_reverse(explode('/',$dt_from))); }
        else{$dt_from='0';}
        if($dt_to != '0'){ $dt_to= implode('-',array_reverse(explode('/',$dt_to))); }
        else{$dt_to='0';}

        if( $dt_from!='0' && $dt_to=='0')
        { $where2.= " and j0.txrn_dt='".$dt_from."'"; }
        
        if( $dt_from!='0' && $dt_to!='0')
        { $where2.= " and j0.txrn_dt between '".$dt_from."' and '".$dt_to."'";}
        //For type wise join table
        $select="CONCAT(u.name,' (',u.code,')')";
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=4)';
        
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
        j0.loan_ac,j0.ac_name,j0.case_number,c.st_belance as suit_value,
        IF(j0.activities_id=0,j0.description,co.name) as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN cma as c on (j0.main_table_id=c.id AND j0.main_table_name='cma')
            LEFT OUTER JOIN ref_court_fee_activities as co on (j0.activities_id=co.id AND j0.main_table_name='cma')
            WHERE j0.memo_sts=0 AND j0.vendor_type= 4 $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_vendor_bank_details($id)
    {
        $str=" SELECT j0.*,b.name as bank_name,bs.name as branch_name
        FROM ref_paper_vendor as j0
        LEFT OUTER JOIN ref_bank as b on (j0.bank=b.id)
        LEFT OUTER JOIN ref_branch_sol as bs on (j0.branch=bs.id)
        WHERE j0.id='".$id."' LIMIT 1";
        $query=$this->db->query($str);
        return $query->row();
    }
    function get_cost_details_paper_bill($vendor_type,$id,$month)
    {
        $where='';
        $where2='';
        $join='';
        $select='';
        $all_month = explode(",",$month);
        if (count($all_month)>1) //For multiple month
        {
            $where=' AND (';
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
            $where=' AND MONTH(j0.txrn_dt) = '.$all_month[0];
        }
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(j0.txrn_dt) IN(".$_POST['year'].")";
        }
        //For type wise where condition
        if($vendor_type=='Vendor')
        {
            $where2.=" AND j0.vendor_id='".$id."' AND j0.paper_bill_vendor_type='Vendor'";
        }
        else
        {
            $where2.=" AND j0.vendor_id='".$id."' AND j0.paper_bill_vendor_type='Staff'";
        }
        if(isset($_POST['legal_region']) && $_POST['legal_region']!='')
        {
            //$where2.="AND j0.region='".$_POST['legal_region']."'";
            $where2.=" AND j0.region IN(".$_POST['legal_region'].")";
        }
        if(isset($_POST['legal_district']) && $_POST['legal_district']!='')
        {
            $where2.=" AND j0.district IN(".$_POST['legal_district'].")";
        }
        //For type wise join table
        $select="u.name";
        $join.='LEFT OUTER JOIN ref_paper_vendor as u on (j0.vendor_id=u.id and j0.vendor_type=2)';
        
        $str=" SELECT j0.*,p.name as paper_name,$select as vendor_name,u.id as vendor_id,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,j0.txrn_dt as org_dt,
        co.name as activities_name,
        j0.loan_ac,j0.ac_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_paper p on(j0.paper_id=p.id)
            LEFT OUTER JOIN ref_paper_bill_activities as co on (j0.activities_id=co.id AND j0.main_table_name='expenses')
            WHERE j0.memo_sts=0 AND j0.vendor_type= 2 $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_paper_bill_all($id=NULL,$month=NULL)
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
        if ($id!=NULL && $id!='0' && $id!='') {
            $where2.="AND j0.vendor_id='".$id."'";
        }
        if (isset($_POST['region']) && $_POST['region']!='') {
            $where2.="AND j0.region=".$this->db->escape($_POST['region']);
        }

        if (isset($_POST['territory']) && $_POST['territory']!='') {
            $where2.="AND j0.territory=".$this->db->escape($_POST['territory']);
        }

        if (isset($_POST['district']) && $_POST['district']!='') {
            $where2.="AND j0.district=".$this->db->escape($_POST['district']);
        }
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(j0.txrn_dt)=".$this->db->escape($_POST['year']);
        }

        if($this->input->post("dt_from") != ''){$dt_from= $this->input->post("dt_from");} else{$dt_from = '0';}
        if($this->input->post("dt_to") != ''){$dt_to= $this->input->post("dt_to");} else{$dt_to = '0';}
        if($dt_from != '0'){$dt_from = implode('-',array_reverse(explode('/',$dt_from))); }
        else{$dt_from='0';}
        if($dt_to != '0'){ $dt_to= implode('-',array_reverse(explode('/',$dt_to))); }
        else{$dt_to='0';}

        if( $dt_from!='0' && $dt_to=='0')
        { $where2.= " and j0.txrn_dt='".$dt_from."'"; }
        
        if( $dt_from!='0' && $dt_to!='0')
        { $where2.= " and j0.txrn_dt between '".$dt_from."' and '".$dt_to."'";}
        //For type wise join table
        $select="u.name";
        $join.='LEFT OUTER JOIN ref_paper_vendor as u on (j0.vendor_id=u.id and j0.vendor_type=2)';
        
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,j0.txrn_dt as org_dt,
        co.name as activities_name,p.name as paper_name,
        j0.loan_ac,j0.ac_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_paper p on(p.id=j0.paper_id)
            LEFT OUTER JOIN ref_paper_bill_activities as co on (j0.activities_id=co.id AND j0.main_table_name='expenses')
            WHERE j0.memo_sts=0 AND j0.vendor_type= 2 $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_other_bill($name,$month)
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
        if (isset($_POST['year']) && $_POST['year']!='') {
            $where2.="AND YEAR(j0.txrn_dt)='".$_POST['year']."'";
        }
        //For type wise where condition
        $where2.="AND j0.vendor_name='".$name."'";
        //For type wise join table
        $select="j0.vendor_name";
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,j0.txrn_dt as org_dt,
        co.name as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_others_cost_activities as co on (j0.activities_id=co.id AND j0.main_table_name='expenses')
            WHERE j0.memo_sts=0 AND j0.vendor_type= 6 $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_cost_details_other_bill_all($name=NULL,$month=NULL)
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
        if($name!=NULL && $name!='')
        {
            $where2.="AND j0.vendor_name='".$name."'";
        }
        if (isset($_POST['region']) && $_POST['region']!='') {
            $where2.="AND j0.region=".$this->db->escape($_POST['region']);
        }

        if (isset($_POST['territory']) && $_POST['territory']!='') {
            $where2.="AND j0.territory=".$this->db->escape($_POST['territory']);
        }

        if (isset($_POST['district']) && $_POST['district']!='') {
            $where2.="AND j0.district=".$this->db->escape($_POST['district']);
        }

        if($this->input->post("dt_from") != ''){$dt_from= $this->input->post("dt_from");} else{$dt_from = '0';}
        if($this->input->post("dt_to") != ''){$dt_to= $this->input->post("dt_to");} else{$dt_to = '0';}
        if($dt_from != '0'){$dt_from = implode('-',array_reverse(explode('/',$dt_from))); }
        else{$dt_from='0';}
        if($dt_to != '0'){ $dt_to= implode('-',array_reverse(explode('/',$dt_to))); }
        else{$dt_to='0';}

        if( $dt_from!='0' && $dt_to=='0')
        { $where2.= " and j0.txrn_dt='".$dt_from."'"; }
        
        if( $dt_from!='0' && $dt_to!='0')
        { $where2.= " and j0.txrn_dt between '".$dt_from."' and '".$dt_to."'";}
    
        //For type wise join table
        $select="j0.vendor_name";
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,j0.txrn_dt as org_dt,
        co.name as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_others_cost_activities as co on (j0.activities_id=co.id AND j0.main_table_name='expenses')
            WHERE j0.memo_sts=0 AND j0.vendor_type= 6 $where2 $where ORDER BY j0.txrn_dt ASC";
            $query=$this->db->query($str);
            return $query->result();
    }
    function get_bill_details_staff_old($id)
    {
        $where2='';
        $where='';
        $where2='';
        $join='';
        $select='';
        $select="CONCAT(u.name,' (',u.pin,')')";
        $join.='LEFT OUTER JOIN users_info as u on (j0.vendor_id=u.id and j0.vendor_type=3)';
        //For type wise where condition
        $where2.="AND j0.vendor_id='".$id."'";
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
        ac.name as activities_name
        FROM cost_details as j0
        $join
        LEFT OUTER JOIN ref_staff_conv_activities as ac on (j0.activities_id=ac.id)
        LEFT OUTER JOIN bill_summery b on(b.id=j0.bill_id)
        WHERE (j0.memo_sts=0 OR j0.memo_sts=25 OR j0.memo_sts=29) AND j0.vendor_type=3 $where2 ORDER BY j0.txrn_dt ASC";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_bill_details_staff($vendor_id,$month,$year,$bill_id)
    {
        $where='';
        $where2='';
        $join='';
        $select='';
        
        if($month!='')
        {
            $where2.="AND c.month IN('".$month."')";
        }

        if($year!='')
        {
            $where2.="AND c.year IN('".$year."')";
        }

        if($vendor_id!='' && $vendor_id!='0')
        {
            $where2.="AND c.staff_id='".$vendor_id."'";
        }
        //(SUM(IF(a.bill_id IS NOT NULL AND a.bill_id<>0 AND a.bill_id='".$bill_id."',a.amount,0))+SUM(IF(a.bill_id IS NOT NULL AND a.bill_id<>0 AND a.bill_id='".$bill_id."' AND a.diduction_amount IS NOT NULL,a.diduction_amount,0))) AS bill_amount,
        $str=" SELECT c.*,c.id as event_id,e.bill_amount,
                e.main_amount,e.cost_ids,e.cost_ids_un_selected,e.bill_ids,
                e.diduction_amount,
                con.name as conv_type_name,
                u.name as employee_name,u.pin as staff_pin,
                e.diduction_remarks
        FROM staff_conv_data as c
        LEFT OUTER JOIN (
            SELECT a.main_table_id ,SUM(IF(a.bill_id IS NOT NULL AND a.bill_id<>0 AND a.bill_id='".$bill_id."',a.amount,0)) AS bill_amount,
            SUM(IF(a.bill_id IS NULL OR a.bill_id=0,a.amount,0)) AS main_amount,
            GROUP_CONCAT(IF(a.bill_id IS NULL OR a.bill_id=0, a.id, NULL) ORDER BY  a.id ASC SEPARATOR ',') AS cost_ids_un_selected,
            GROUP_CONCAT(IF(a.bill_id='".$bill_id."', a.id, NULL) ORDER BY  a.id ASC SEPARATOR ',') AS cost_ids,
            GROUP_CONCAT(a.bill_id ORDER BY  a.id ASC SEPARATOR ',') AS bill_ids,
            GROUP_CONCAT(IF(a.bill_id='".$bill_id."', CONCAT(a.id,'__$',a.diduction_amount), NULL) ORDER BY  a.id ASC SEPARATOR '####') AS diduction_amount,
            GROUP_CONCAT(IF(a.bill_id='".$bill_id."', CONCAT(a.id,'__$',a.diduction_remarks), NULL) ORDER BY  a.id ASC SEPARATOR '####') AS diduction_remarks  
            FROM cost_details a
            WHERE a.main_table_name='staff_conv_data' AND (a.memo_sts=0 OR a.memo_sts=25 OR a.memo_sts=29) AND a.vendor_type= 3
            GROUP BY a.main_table_id
        )e ON(c.id=e.main_table_id)
        LEFT OUTER JOIN ref_staff_conv_type con ON(con.id=c.conv_type)
        LEFT OUTER JOIN users_info u ON(u.id=c.staff_id)
        WHERE 1 $where2 ORDER BY c.e_dt ASC";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_bill_details_court($employee_type,$staff_pin,$month,$bill_id)
    {
        $where='';
        $where2='';
        $join='';
        $select='';
        if($employee_type!='')
        {
            $where2.="AND c.employee_type IN('".$employee_type."')";
        }

        if($month!='')
        {
            $where2.="AND c.billing_month IN('".$month."')";
        }

        if($staff_pin!='')
        {
            $where2.="AND c.staff_pin='".$staff_pin."'";
        }
        //(SUM(IF(a.bill_id IS NOT NULL AND a.bill_id<>0 AND a.bill_id='".$bill_id."',a.amount,0))+SUM(IF(a.bill_id IS NOT NULL AND a.bill_id<>0 AND a.bill_id='".$bill_id."' AND a.diduction_amount IS NOT NULL,a.diduction_amount,0))) AS bill_amount,
        $str=" SELECT c.*,c.id as event_id,e.bill_amount,
                e.main_amount,e.cost_ids,e.cost_ids_un_selected,e.bill_ids,
                e.diduction_amount,
                e.diduction_remarks,
        r.name as legal_region
        FROM court_entertainment_data as c
        LEFT OUTER JOIN (
            SELECT a.main_table_id ,SUM(IF(a.bill_id IS NOT NULL AND a.bill_id<>0 AND a.bill_id='".$bill_id."',a.amount,0)) AS bill_amount,
            SUM(IF(a.bill_id IS NULL OR a.bill_id=0,a.amount,0)) AS main_amount,
            GROUP_CONCAT(IF(a.bill_id IS NULL OR a.bill_id=0, a.id, NULL) ORDER BY  a.id ASC SEPARATOR ',') AS cost_ids_un_selected,
            GROUP_CONCAT(IF(a.bill_id='".$bill_id."', a.id, NULL) ORDER BY  a.id ASC SEPARATOR ',') AS cost_ids,
            GROUP_CONCAT(a.bill_id ORDER BY  a.id ASC SEPARATOR ',') AS bill_ids,
            GROUP_CONCAT(IF(a.bill_id='".$bill_id."', CONCAT(a.id,'__$',a.diduction_amount), NULL) ORDER BY  a.id ASC SEPARATOR '####') AS diduction_amount,
            GROUP_CONCAT(IF(a.bill_id='".$bill_id."', CONCAT(a.id,'__$',a.diduction_remarks), NULL) ORDER BY  a.id ASC SEPARATOR '####') AS diduction_remarks  
            FROM cost_details a
            WHERE a.main_table_name='court_entertainment_data' AND (a.memo_sts=0 OR a.memo_sts=25 OR a.memo_sts=29) AND a.vendor_type= 5
            GROUP BY a.main_table_id
        )e ON(c.id=e.main_table_id)
        LEFT OUTER JOIN ref_legal_region r ON(r.id=c.legal_region)
        WHERE 1 $where2 ORDER BY c.e_dt ASC";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_bill_details_lawyer($id,$month=NULL,$year=NULL)
    {
        $where2='';
        $where='';
        $where2='';
        $join='';
        $select='';
        $select="CONCAT(u.name,' (',u.code,')')";
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=1)';
        //For type wise where condition
        $where2.="AND j0.vendor_id='".$id."'";
        if($month!=NULL)
        {
            $where2.='AND MONTH(j0.txrn_dt) IN('.$month.')';
        }
        if($year!=NULL)
        {
            $where2.='AND YEAR(j0.txrn_dt) IN('.$year.')';
        }
        //New query
        $str=" SELECT sub.* FROM(
            SELECT j0.memo_sts,j0.discount_remarks,j0.expense_remarks,j0.discount_amount,j0.duplicate_bill_with_proxy,j0.id,j0.bill_id,j0.amount,$select as vendor_name,IF(j0.legal_select_sts=93,1,2) as selection_s_order,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,j0.txrn_dt as org_dt,
            j0.loan_ac,j0.ac_name,IF((j0.activities_id IN(1,33) AND j0.req_type=2) OR (j0.activities_id IN(1,29) AND j0.req_type<>2),CONCAT(rq.name,' Legal Notice'),j0.case_number) as case_number,
            IF(j0.activities_id=0,j0.description,IF(j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter',hc.name,IF(j0.main_table_name='case_against_bank',ca.name,IF(j0.main_table_name='legal_affairs',la.name,IF(j0.req_type=2,ar.name,ni.name))))) as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_req_type as rq on (j0.req_type=rq.id)
            LEFT OUTER JOIN ref_schedule_charges_ara as ar on (j0.activities_id=ar.id and j0.req_type=2 AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (j0.activities_id=ni.id and j0.req_type<>2 AND j0.req_type IS NOT NULL AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (j0.activities_id=ca.id AND j0.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (j0.activities_id=la.id AND j0.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_hc_activities as hc on (j0.activities_id=hc.id AND (j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter'))
            LEFT OUTER JOIN bill_summery b on(b.id=j0.bill_id)
            WHERE j0.module_name<>'high_court' AND (j0.memo_sts=0 OR j0.memo_sts=25 OR j0.memo_sts=29) AND (j0.legal_select_sts=0 OR j0.legal_select_sts IS NULL OR j0.legal_select_sts=93) AND j0.main_table_name<>'legal_notice' AND  j0.vendor_type=1 $where2 ORDER BY j0.txrn_dt ASC
        )sub ORDER BY sub.selection_s_order ASC,sub.org_dt ASC";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_bill_details_lawyer_hc($id,$month=NULL,$year=NULL)
    {
        $where2='';
        $where='';
        $where2='';
        $join='';
        $select='';
        $select="CONCAT(u.name,' (',u.code,')')";
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=1)';
        //For type wise where condition
        $where2.="AND j0.vendor_id='".$id."'";
        if($month!=NULL)
        {
            $where2.='AND MONTH(j0.txrn_dt) IN('.$month.')';
        }
        if($year!=NULL)
        {
            $where2.='AND YEAR(j0.txrn_dt) IN('.$year.')';
        }
        //New query
        $str=" SELECT sub.* FROM(
            SELECT j0.memo_sts,j0.discount_remarks,j0.discount_amount,j0.duplicate_bill_with_proxy,j0.id,j0.bill_id,j0.amount,$select as vendor_name,IF(j0.legal_select_sts=93,1,2) as selection_s_order,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,j0.txrn_dt as org_dt,
            j0.loan_ac,j0.ac_name,j0.case_number,
            IF(j0.activities_id=0,j0.description,hc.name) as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN ref_hc_activities as hc on (j0.activities_id=hc.id AND j0.module_name='high_court')
            LEFT OUTER JOIN bill_summery b on(b.id=j0.bill_id)
            WHERE j0.module_name='high_court' AND (j0.memo_sts=0 OR j0.memo_sts=25 OR j0.memo_sts=29) AND (j0.legal_select_sts=0 OR j0.legal_select_sts IS NULL OR j0.legal_select_sts=93) AND j0.vendor_type=1 $where2 ORDER BY j0.txrn_dt ASC
        )sub ORDER BY sub.selection_s_order ASC,sub.org_dt ASC";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_bill_details_court_fee($id,$month=NULL,$year=NULL)
    {
        $where2='';
        $where='';
        $where2='';
        $join='';
        $select='';
        $select="CONCAT(u.name,' (',u.code,')')";
        $join.='LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=4)';
        //For type wise where condition
        $where2.="AND j0.vendor_id='".$id."'";
        if($month!=NULL)
        {
            $where2.='AND MONTH(j0.txrn_dt) IN('.$month.')';
        }
        if($year!=NULL)
        {
            $where2.='AND YEAR(j0.txrn_dt) IN('.$year.')';
        }
        $str=" SELECT sub.* FROM(
            SELECT j0.memo_sts,j0.discount_remarks,j0.discount_amount,j0.id,j0.bill_id,j0.amount,$select as vendor_name,IF(j0.legal_select_sts=93,1,2) as selection_s_order,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,j0.txrn_dt as org_dt,
            j0.loan_ac,j0.ac_name,j0.case_number,c.st_belance as suit_value,
            IF(j0.activities_id=0,j0.description,co.name) as activities_name
            FROM cost_details as j0
            $join
            LEFT OUTER JOIN cma as c on (j0.main_table_id=c.id AND j0.main_table_name='cma')
            LEFT OUTER JOIN ref_court_fee_activities as co on (j0.activities_id=co.id AND j0.main_table_name='cma')
            LEFT OUTER JOIN bill_summery b on(b.id=j0.bill_id)
            WHERE (j0.memo_sts=0 OR j0.memo_sts=25 OR j0.memo_sts=29) AND ((j0.adjustment_sts IS NULL OR j0.adjustment_sts = '' OR j0.adjustment_sts = 0) OR (j0.adjustment_sts=1 AND (j0.fully_adjust_sts IS NULL OR j0.fully_adjust_sts = '' OR j0.fully_adjust_sts = 0) AND j0.adjust_v_sts=13)) AND (j0.legal_select_sts=0 OR j0.legal_select_sts IS NULL OR j0.legal_select_sts=93) AND j0.vendor_type=4 $where2 ORDER BY j0.txrn_dt ASC
        )sub ORDER BY sub.selection_s_order ASC,sub.org_dt ASC";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_bill_details_paper_bill($id,$vendor_type,$legal_region,$legal_district)
    {
        $where2='';
        $where='';
        $where2='';
        $join='';
        $select='';
        $select="u.name";
        $join.='LEFT OUTER JOIN ref_paper_vendor as u on (j0.vendor_id=u.id and j0.vendor_type=2)';
        //For type wise where condition
        if($vendor_type=='Vendor')
        {
            $where2.=" AND j0.vendor_id='".$id."' AND j0.paper_bill_vendor_type='Vendor'";
        }
        else
        {
            $where2.=" AND j0.vendor_id='".$id."' AND j0.paper_bill_vendor_type='Staff'";
        }
        if($legal_region!='' && $legal_region!='0')
        {
            $where2.=" AND j0.region='".$legal_region."'";
        }
        if($legal_district!='' && $legal_district!=NULL)
        {
            $where2.=" AND j0.district IN(".$legal_district.")";
        }
        $str=" SELECT j0.*,$select as vendor_name,j0.discount_amount,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
        j0.loan_ac,j0.ac_name,j0.case_number,p.name as paper_name,
        co.name as activities_name
        FROM cost_details as j0
        $join
        LEFT OUTER JOIN ref_paper p on(j0.paper_id=p.id)
        LEFT OUTER JOIN ref_paper_bill_activities as co on (j0.activities_id=co.id AND j0.main_table_name='expenses')
        LEFT OUTER JOIN bill_summery b on(b.id=j0.bill_id)
        WHERE (j0.memo_sts=0 OR j0.memo_sts=25 OR j0.memo_sts=29) AND j0.vendor_type=2 $where2 ORDER BY j0.txrn_dt ASC";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_bill_details_other_bill($name)
    {
        $where2='';
        $where='';
        $where2='';
        $join='';
        $select='';
        $select="j0.vendor_name";
        //For type wise where condition
        $where2.="AND j0.vendor_name='".$name."'";
        $str=" SELECT j0.*,$select as vendor_name,
        DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
        co.name as activities_name
        FROM cost_details as j0
        $join
        LEFT OUTER JOIN ref_others_cost_activities as co on (j0.activities_id=co.id AND j0.main_table_name='expenses')
        LEFT OUTER JOIN bill_summery b on(b.id=j0.bill_id)
        WHERE (j0.memo_sts=0 OR j0.memo_sts=25 OR j0.memo_sts=29) AND j0.vendor_type=6 $where2 ORDER BY j0.txrn_dt ASC";
        $query=$this->db->query($str);
        return $query->result();
    }
    function get_staff_bill_details_by_id($bill_id)
    {
        if($bill_id!=''){
            $str=" SELECT SUM(j0.amount) as amount,con.name as conv_type_name,u.pin as staff_pin,u.name as employee_name,
            SUM(j0.diduction_amount) as diduction_amount,
            GROUP_CONCAT(j0.diduction_remarks ORDER BY  j0.id ASC SEPARATOR ',') AS diduction_remarks
            FROM cost_details as j0
            LEFT OUTER JOIN staff_conv_data en ON(en.id=j0.main_table_id)
            LEFT OUTER JOIN ref_staff_conv_type con ON(con.id=en.conv_type)
            LEFT OUTER JOIN users_info u ON(u.id=en.staff_id)
            WHERE  j0.bill_id= ".$bill_id." GROUP BY j0.main_table_id ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_court_bill_details_by_id($bill_id)
    {
        if($bill_id!=''){
            $str=" SELECT SUM(j0.amount) as amount,en.base_office_name,
            en.base_office_name,en.staff_pin,en.employee_name,en.job_grade,
            SUM(j0.diduction_amount) as diduction_amount,
            GROUP_CONCAT(j0.diduction_remarks ORDER BY  j0.id ASC SEPARATOR ',') AS diduction_remarks,
            r.name as legal_region,fd.name as functional_desig
            FROM cost_details as j0
            LEFT OUTER JOIN court_entertainment_data en ON(en.id=j0.main_table_id)
            LEFT OUTER JOIN ref_functional_designation fd on(en.functional_desig=fd.id)
            LEFT OUTER JOIN ref_legal_region r ON(r.id=en.legal_region)
            WHERE  j0.bill_id= ".$bill_id." GROUP BY j0.main_table_id ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_lawyer_bill_details_by_id($bill_id)
    {
        if($bill_id!=''){
            $str=" SELECT j0.amount,j0.description,j0.discount_amount,(j0.amount-j0.discount_amount) as invoice_amount,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
            CONCAT(u.name,' (',u.code,')') as vendor_name,
            j0.loan_ac,j0.ac_name,IF(j0.activities_id=1,CONCAT(rq.name,' Legal Notice'),j0.case_number) as case_number,
            IF(j0.activities_id=0,j0.description,IF(j0.module_name='high_court',hc.name,IF(j0.main_table_name='case_against_bank',ca.name,IF(j0.main_table_name='legal_affairs',la.name,IF(j0.req_type=2,ar.name,ni.name))))) as activities_name
            FROM cost_details as j0
            LEFT OUTER JOIN ref_req_type as rq on (j0.req_type=rq.id)
            LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=1)
            LEFT OUTER JOIN ref_schedule_charges_ara as ar on (j0.activities_id=ar.id and j0.req_type=2 AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (j0.activities_id=ni.id and j0.req_type<>2 AND j0.req_type IS NOT NULL AND (j0.main_table_name='suit_filling_info' OR j0.main_table_name='cma'  OR j0.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (j0.activities_id=ca.id AND j0.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (j0.activities_id=la.id AND j0.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_hc_activities as hc on (j0.activities_id=hc.id AND j0.module_name='high_court') WHERE  j0.bill_id= ".$bill_id." ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_court_fee_details_by_id($bill_id)
    {
        if($bill_id!=''){
            $str=" SELECT j0.amount,j0.description,j0.discount_amount,(j0.amount-j0.discount_amount) as invoice_amount,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
            CONCAT(u.name,' (',u.code,')') as vendor_name,
            j0.loan_ac,j0.ac_name,j0.case_number,
            IF(j0.activities_id=0,j0.description,co.name) as activities_name
            FROM cost_details as j0
            LEFT OUTER JOIN ref_lawyer as u on (j0.vendor_id=u.id and j0.vendor_type=4)
            LEFT OUTER JOIN ref_court_fee_activities as co on (j0.activities_id=co.id AND j0.main_table_name='cma')
            WHERE  j0.bill_id= ".$bill_id." ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_paper_bill_details_by_id($bill_id)
    {
        if($bill_id!=''){
            $str=" SELECT j0.amount,j0.description,j0.paper_expense_approval_file,j0.discount_amount,(j0.amount-j0.discount_amount) as invoice_amount,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
            u.name as vendor_name,p.name as paper_name,j0.paper_scan_copy,
           j0.loan_ac,j0.ac_name,j0.case_number,
            co.name as activities_name
            FROM cost_details as j0
            LEFT OUTER JOIN ref_paper p on (j0.paper_id=p.id)
            LEFT OUTER JOIN ref_paper_vendor as u on (j0.vendor_id=u.id and j0.vendor_type=2)
            LEFT OUTER JOIN ref_paper_bill_activities as co on (j0.activities_id=co.id AND j0.main_table_name='expenses')
            WHERE  j0.bill_id= ".$bill_id." ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_other_bill_details_by_id($bill_id)
    {
        if($bill_id!=''){
            $str=" SELECT j0.amount,j0.description,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,
            j0.vendor_name as vendor_name,
            co.name as activities_name
            FROM cost_details as j0
            LEFT OUTER JOIN ref_others_cost_activities as co on (j0.activities_id=co.id AND j0.main_table_name='expenses')
            WHERE  j0.bill_id= ".$bill_id." ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_xl_details_court_fee($bill_id)
    {
        if($bill_id!=''){
            $str="SELECT sub.v_by_name,sub.date_f_new as date_f,sub.ref_no,sub.branch_name,sub.tax_vat_text,sub.v_by_pin,sub.v_fun_deg,sub.e_by_name,sub.e_by_pin,sub.e_fun_deg,sub.txrn_dt,sub.district,sub.tin_number,sub.dispatch_no,sub.vendor_type,sub.loan_segment,sub.vendor_name,SUM(sub.amount) AS 'amount',SUM(sub.discount_amount) AS 'discount_amount',sub.bank_ac,sub.bank_name,
            SUM(sub.account_counter) AS 'account_counter'
             FROM
                    (
                    SELECT j0.amount,
                    j0.discount_amount,
                    e.name AS TYPE,
                    j0.description,
                    bil.dispatch_no,
                    bil.bank_ac,
                    eb.name as e_by_name,
                    eb.pin as e_by_pin,
                    ef.name as e_fun_deg,
                    vb.name as v_by_name,
                    vb.pin as v_by_pin,
                    vf.name as v_fun_deg,
                    ba.name as bank_name,
                    tx.name as tax_vat_text,
                    l.branch as branch_name,
                    '1' AS account_counter,
                    l.code as ref_no,
                    DATE_FORMAT(bil.memo_e_dt, '%d-%b-%Y') AS txrn_dt,
                    ex.name AS vendor_type,
                    j0.loan_segment AS loan_segment,
                    bil.bill_months as date_f,
                    CONCAT(DATE_FORMAT(bil.memo_e_dt, '%M'),'\'',DATE_FORMAT(bil.memo_e_dt, '%Y')) AS date_f_new,
                    l.name AS vendor_name,l.tin_number,d.name as district
                    FROM cost_details AS j0 
                    LEFT OUTER JOIN bill_summery bil ON(j0.bill_id=bil.id)
                    LEFT OUTER JOIN ref_tax_vat_text tx ON(bil.tax_vat_text=tx.id)
                    LEFT OUTER JOIN users_info eb ON(bil.memo_e_by=eb.id)
                    LEFT OUTER JOIN ref_functional_designation ef ON(eb.functional_designation_id=ef.id)
                    LEFT OUTER JOIN users_info vb ON(bil.v_by=vb.id)
                    LEFT OUTER JOIN ref_functional_designation vf ON(vb.functional_designation_id=vf.id)
                    LEFT OUTER JOIN ref_bank ba ON(bil.bank=ba.id)
                    LEFT OUTER JOIN ref_lawyer l 
                      ON (
                        l.id = j0.vendor_id 
                        AND j0.vendor_type = 4
                      )
                    LEFT OUTER JOIN ref_expense_type e 
                      ON (e.id = j0.vendor_type)
                    LEFT OUTER JOIN ref_legal_district AS d 
                      ON (
                        d.id = l.district
                      )
                    LEFT OUTER JOIN ref_court_fee_activities AS ac 
                      ON (j0.activities_id = ac.id) 
                    LEFT OUTER JOIN ref_expense_type AS ex 
                      ON (j0.vendor_type = ex.id) WHERE j0.bill_id= '".$bill_id."'
                    ORDER BY j0.id ASC 
                    )sub GROUP BY sub.loan_segment";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_xl_details_lawyer_bill($bill_id)
    {
        if($bill_id!=''){
            $str="SELECT sub.v_by_name,sub.date_f,sub.ref_no,sub.branch_name,sub.v_by_pin,sub.tax_vat_text,sub.v_fun_deg,sub.e_by_name,sub.e_by_pin,sub.e_fun_deg,sub.district,sub.tin_number,sub.txrn_dt,sub.dispatch_no,sub.vendor_type,sub.loan_segment,sub.vendor_name,SUM(sub.amount) AS 'amount',SUM(sub.discount_amount) AS 'discount_amount',sub.bank_ac,sub.bank_name,sub.special_bill_sts,sub.memo_remarks,
            SUM(sub.account_counter) AS 'account_counter'
             FROM
                    (
                    SELECT j0.amount,
                    j0.discount_amount,
                    e.name AS TYPE,
                    j0.description,
                    bil.dispatch_no,
                    eb.name as e_by_name,
                    eb.pin as e_by_pin,
                    ef.name as e_fun_deg,
                    vb.name as v_by_name,
                    vb.pin as v_by_pin,
                    vf.name as v_fun_deg,
                    bil.bank_ac,
                    l.branch as branch_name,
                    tx.name as tax_vat_text,
                    ba.name as bank_name,
                    '1' AS account_counter,
                    l.code as ref_no,
                    DATE_FORMAT(bil.memo_e_dt, '%d-%b-%Y') AS txrn_dt,
                    ex.name AS vendor_type,
                    j0.loan_segment AS loan_segment,
                    d.name as district,
                    bil.bill_months as date_f,
                    l.name AS vendor_name ,l.tin_number,
                    bil.special_bill_sts,bil.memo_remarks
                    FROM cost_details AS j0 
                    LEFT OUTER JOIN bill_summery bil ON(j0.bill_id=bil.id)
                    LEFT OUTER JOIN ref_tax_vat_text tx ON(bil.tax_vat_text=tx.id)
                    LEFT OUTER JOIN users_info eb ON(bil.memo_e_by=eb.id)
                    LEFT OUTER JOIN ref_functional_designation ef ON(eb.functional_designation_id=ef.id)
                    LEFT OUTER JOIN users_info vb ON(bil.v_by=vb.id)
                    LEFT OUTER JOIN ref_functional_designation vf ON(vb.functional_designation_id=vf.id)
                    LEFT OUTER JOIN ref_bank ba ON(bil.bank=ba.id)
                    LEFT OUTER JOIN ref_lawyer l 
                      ON (
                        l.id = j0.vendor_id 
                        AND j0.vendor_type = 1
                      )
                    LEFT OUTER JOIN ref_expense_type e 
                      ON (e.id = j0.vendor_type) 
                    LEFT OUTER JOIN ref_legal_district d 
                      ON (d.id = l.district) 
                    LEFT OUTER JOIN ref_expense_type AS ex 
                      ON (j0.vendor_type = ex.id) WHERE j0.bill_id= '".$bill_id."'
                    ORDER BY j0.id ASC 
                    )sub GROUP BY sub.loan_segment";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_xl_details_paper_bill($bill_id)
    {
        if($bill_id!=''){
            $str="SELECT sub.v_by_name,sub.district_name,sub.ref_no,sub.date_f,sub.tin,sub.branch_name,sub.tax_vat_text,sub.v_by_pin,sub.v_fun_deg,sub.e_by_name,sub.e_by_pin,sub.e_fun_deg,sub.txrn_dt,sub.dispatch_no,sub.vendor_type,sub.loan_segment,sub.vendor_name,SUM(sub.amount) AS 'amount',SUM(sub.discount_amount) AS 'discount_amount',sub.bank_ac,sub.bank_name,sub.special_bill_sts,sub.memo_remarks,

            SUM(sub.account_counter) AS 'account_counter'
             FROM
                    (
                    SELECT j0.amount,
                    j0.discount_amount,
                    e.name AS TYPE,
                    j0.description,
                    bil.dispatch_no,
                    eb.name as e_by_name,
                    eb.pin as e_by_pin,
                    ef.name as e_fun_deg,
                    vb.name as v_by_name,
                    vb.pin as v_by_pin,
                    vf.name as v_fun_deg,
                    bil.bank_ac,
                    l.code as ref_no,
                    tx.name as tax_vat_text,
                    ba.name as bank_name,
                    bs.name as branch_name,
                    '1' AS account_counter,
                    DATE_FORMAT(bil.memo_e_dt, '%d-%b-%Y') AS txrn_dt,
                    ex.name AS vendor_type,
                    j0.tin,
                    d.name as district_name,
                    j0.loan_segment AS loan_segment,
                    j0.district as district,
                    bil.bill_months as date_f,
                    IF(j0.paper_bill_vendor_type='Vendor',l.name,CONCAT(l2.name,'(',l2.pin,')')) AS vendor_name,
                    bil.special_bill_sts,bil.memo_remarks

                    FROM cost_details AS j0 
                    LEFT OUTER JOIN bill_summery bil ON(j0.bill_id=bil.id)
                    LEFT OUTER JOIN ref_tax_vat_text tx ON(bil.tax_vat_text=tx.id)
                    LEFT OUTER JOIN users_info eb ON(bil.memo_e_by=eb.id)
                    LEFT OUTER JOIN ref_functional_designation ef ON(eb.functional_designation_id=ef.id)
                    LEFT OUTER JOIN users_info vb ON(bil.v_by=vb.id)
                    LEFT OUTER JOIN ref_functional_designation vf ON(vb.functional_designation_id=vf.id)
                    LEFT OUTER JOIN ref_bank ba ON(bil.bank=ba.id)
                    LEFT OUTER JOIN ref_paper_vendor l 
                      ON (
                        l.id = j0.vendor_id 
                        AND j0.vendor_type = 2
                        AND j0.paper_bill_vendor_type='Vendor'
                      ) 
                    LEFT OUTER JOIN ref_legal_district d ON(d.id=l.district AND j0.paper_bill_vendor_type='Vendor')
                    LEFT OUTER JOIN users_info l2 
                      ON (
                        l2.id = j0.vendor_id 
                        AND j0.vendor_type = 2
                        AND j0.paper_bill_vendor_type='Staff'
                      ) 
                    LEFT OUTER JOIN ref_branch_sol bs ON(l.branch=bs.id)
                    LEFT OUTER JOIN ref_expense_type e 
                      ON (e.id = j0.vendor_type) 
                    LEFT OUTER JOIN ref_paper_bill_activities AS ac 
                      ON (j0.activities_id = ac.id) 
                    LEFT OUTER JOIN ref_expense_type AS ex 
                      ON (j0.vendor_type = ex.id) WHERE j0.bill_id= '".$bill_id."'
                    ORDER BY j0.id ASC 
                    )sub GROUP BY sub.loan_segment";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_details_court_enter($id)
    {
        if($id!=''){
            $str="SELECT j0.id,j0.amount,j0.description,j0.vendor_name,j0.vendor_pin,en.base_office_name,en.account_number,
            DATE_FORMAT(j0.txrn_dt,'%d-%b-%Y') as txrn_dt,r.name as legal_region,m.name as billing_month,e.remarks,
            ac.name as activities_name,fn.name as functional_desig,en.job_grade,en.mobile_no,en.account_number,
            j0.loan_ac,j0.ac_name,j0.case_number,req.name as req_type,c.name as court_name,d.name as district
            FROM cost_details as j0
            LEFT OUTER JOIN court_entertainment_data en ON(en.id=j0.main_table_id)
            LEFT OUTER JOIN ref_billing_month m ON(m.id=en.billing_month)
            LEFT OUTER JOIN expenses e ON(e.id=j0.sub_table_id)
            LEFT OUTER JOIN ref_functional_designation fn ON(fn.id=en.functional_desig)
            LEFT OUTER JOIN ref_legal_region r ON(r.id=en.legal_region)
            LEFT OUTER JOIN ref_legal_district d ON(d.id=j0.district)
            LEFT OUTER JOIN ref_req_type req ON(req.id=j0.req_type)
            LEFT OUTER JOIN ref_court c ON(c.id=j0.court_id)
            LEFT OUTER JOIN ref_court_entertainment_activities as ac on (j0.activities_id=ac.id)
            WHERE  j0.id= ".$id." LIMIT 1";
            $query=$this->db->query($str);
            return $query->row();
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
                            WHERE  j0.bill_id='".$bill_id."' GROUP BY j0.main_table_id ORDER BY j0.id ASC
                )sub GROUP BY sub.vendor_pin";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
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
            WHERE  j0.bill_id= ".$bill_id." GROUP BY j0.main_table_id ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_row_details_staff_conv($bill_id)
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
                        WHERE  j0.bill_id= ".$bill_id." GROUP BY en.staff_id,en.month ORDER BY j0.id ASC)sub
                        LEFT OUTER JOIN bill_summery bs ON(".$bill_id."=bs.id)
                        LEFT OUTER JOIN users_info ubs ON(bs.memo_e_by=ubs.id)
                        LEFT OUTER JOIN ref_functional_designation fdbs ON(ubs.functional_designation_id=fdbs.id)
                        LEFT OUTER JOIN users_info ubsv ON(bs.v_by=ubsv.id)
                        LEFT OUTER JOIN ref_functional_designation fdbsv ON(ubsv.functional_designation_id=fdbsv.id)";
            $query=$this->db->query($str);
            return $query->row();
        }
        else{return NULL;}
    }
    function get_total_expenses_staff_conv($bill_id)
    {
        if($bill_id!=''){
            $str="SELECT SUM(j0.amount) as amount,en.conv_type
            FROM cost_details as j0
            LEFT OUTER JOIN staff_conv_data en ON(en.id=j0.main_table_id)
            WHERE  j0.bill_id= ".$bill_id." GROUP BY en.conv_type ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_r_history($id,$type=Null) // get data for edit
    {
        if($id!=''){
            if ($type=='life_cycle') {
                $where="AND(r.activities_id=25 || r.activities_id=26 || r.activities_id=27 || r.activities_id=28 || r.activities_id=29 || r.activities_id=30 || r.activities_id=31 || r.activities_id=70 || r.activities_id=89 || r.activities_id=88)";
                
            }
            else
            {
                $where='';
            }
            $str=" SELECT r.description_activities as oprs_descriptions,r.oprs_reason,s.name as oprs_sts,DATE_FORMAT(r.activities_datetime,'%d-%b-%y %h:%i %p') AS oprs_dt,CONCAT(u.name,' (',u.user_id,')') as r_by
            FROM user_activities_bill as r
            LEFT OUTER JOIN users_info u ON u.id=r.activities_by
            LEFT OUTER JOIN ref_status s ON s.id=r.activities_id
            WHERE r.table_row_id= ".$id." AND (r.section_name='bill_memo')  ".$where."  ORDER BY r.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_staff_data()
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
    function bills_delete_ho($id,$reason){
        if($this->input->post('ho_operation_name')=='D')//For Delete Request
        {
            $str="SELECT  j0.*
                 FROM cost_details j0
             WHERE j0.id= '".$id."'";
            $application_data=$this->db->query($str)->result();
            //$final_data = array();
            if(!empty($application_data))
            {
                foreach ($application_data as $k => $value) {
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
                    $data['d_reason'] = $reason;
                    $this->db->insert('cost_details_deleted', $data);
                }
                $str="DELETE 
                         FROM cost_details j0
                     WHERE j0.id= '".$id."'";
                $application_data=$this->db->query($str);

                $data2 = $this->user_model->user_activities(15,'bill_ho',$id,'cost_details','Bill Delete By HO ('.$id.')',$reason);
            }
        }
        if($this->input->post('ho_operation_name')=='E')//For Edit Request
        {
            $new_amount = $this->input->post('new_amount');
            $new_txrn_dt = $this->input->post('new_txrn_dt');
            $data = array('amount' =>$new_amount,'txrn_dt' => implode('-',array_reverse(explode('/',$this->input->post('new_txrn_dt')))),'u_by'=> $this->session->userdata['ast_user']['user_id'], 'u_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $id);
            $this->db->update('cost_details', $data);
            $data2 = $this->user_model->user_activities_bill(35,'bill_memo',$id,'cost_details','Update Cost Data('.$id.')');
        }
    }
    function get_all_report_data($module_name){
        if($module_name=='lawyer_bill')
        {
            $where2 = "a.sts<>0 and a.bill_type=1 and a.hc_lawyer_bill_sts<>1";
            $field = "memo_e_dt";
            if($this->input->post('legal_region_grid')!='') 
            {$where2.=" AND l.region = '".trim($this->input->post('legal_region_grid'))."'";}
            if($this->input->post('legal_district_grid')!='') 
            {$where2.=" AND l.district = '".trim($this->input->post('legal_district_grid'))."'";}
            if($this->input->post('lawyer_grid')!='') 
            {$where2.=" AND a.vendor = '".trim($this->input->post('lawyer_grid'))."'";}
            if($this->input->post('status_grid')!='') 
            {
                $where2.=" AND a.sts = '".trim($this->input->post('status_grid'))."'";
                if($this->input->post('status_grid')==26)
                {
                    $field = "stc_dt";
                }
                else if($this->input->post('status_grid')==27)
                {
                    $field = "return_dt";
                }
                else if($this->input->post('status_grid')==28)
                {
                    $field = "reject_dt";
                }
                else if($this->input->post('status_grid')==29)
                {
                    $field = "v_dt";
                }
                else if($this->input->post('status_grid')==70)
                {
                    $field = "stf_dt";
                }
                else if($this->input->post('status_grid')==88)
                {
                    $field = "finance_v_dt";
                }
                else if($this->input->post('status_grid')==89)
                {
                    $field = "finanace_r_dt";
                }
            }
            
            


            if($this->input->post("from_date") != ''){$from_date= $this->input->post("from_date");} else{$from_date = '0';}
            if($this->input->post("to_date") != ''){$to_date= $this->input->post("to_date");} else{$to_date = '0';}
            if($from_date != '0'){$from_date = implode('-',array_reverse(explode('/',$from_date))); }
            else{$from_date='0';}
            if($to_date != '0'){ $to_date= implode('-',array_reverse(explode('/',$to_date))); }
            else{$to_date='0';}

            if( $from_date!='0' && $to_date=='0')
            { $where2.= " and DATE(a.$field)='".$from_date."'"; }
            
            if( $from_date!='0' && $to_date!='0')
            { $where2.= " and DATE(a.$field) between '".$from_date."' and '".$to_date."'";}


            $where="";
            $this->db->select('a.dispatch_no,a.protfolio_wise_discount,a.protfolio_wise_account,a.protfolio_wise_amount,a.bill_months,a.sl_no,a.memo_remarks,a.discount_amount,a.bill_amount,t.name as tx_name,r.name as region_name,d.name as district_name,a.memo_e_by as e_by_id,l.name as vendor_name,
            j0.name as status,
            CONCAT(j1.name," (",j1.user_id,")")as e_by,
            CONCAT(j2.name," (",j2.user_id,")")as v_by,
            DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
            DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
            ', FALSE)
                ->from("bill_summery a")
                ->join('ref_status as j0', 'a.sts=j0.id', 'left')
                ->join('ref_tax_vat_text as t', 'a.tax_vat_text=t.id', 'left')
                ->join('ref_lawyer as l', 'a.vendor=l.id', 'left')
                ->join('ref_legal_region as r', 'l.region=r.id', 'left')
                ->join('ref_legal_district as d', 'l.district=d.id', 'left')
                ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
                ->join('users_info as j2', 'a.v_by=j2.id', 'left')
                ->where($where2);
            $q=$this->db->get();
            return $q->result();
        }
        if($module_name=='court_fee')
        {
            $where2 = "a.sts<>0 and a.bill_type=4";
            $field = "memo_e_dt";
            if($this->input->post('legal_region_grid')!='') 
            {$where2.=" AND l.region = '".trim($this->input->post('legal_region_grid'))."'";}
            if($this->input->post('legal_district_grid')!='') 
            {$where2.=" AND l.district = '".trim($this->input->post('legal_district_grid'))."'";}
            if($this->input->post('lawyer_grid')!='') 
            {$where2.=" AND a.vendor = '".trim($this->input->post('lawyer_grid'))."'";}
            if($this->input->post('status_grid')!='') 
            {
                $where2.=" AND a.sts = '".trim($this->input->post('status_grid'))."'";
                if($this->input->post('status_grid')==26)
                {
                    $field = "stc_dt";
                }
                else if($this->input->post('status_grid')==27)
                {
                    $field = "return_dt";
                }
                else if($this->input->post('status_grid')==28)
                {
                    $field = "reject_dt";
                }
                else if($this->input->post('status_grid')==29)
                {
                    $field = "v_dt";
                }
                else if($this->input->post('status_grid')==70)
                {
                    $field = "stf_dt";
                }
                else if($this->input->post('status_grid')==88)
                {
                    $field = "finance_v_dt";
                }
                else if($this->input->post('status_grid')==89)
                {
                    $field = "finanace_r_dt";
                }
            }
            if($this->input->post("from_date") != ''){$from_date= $this->input->post("from_date");} else{$from_date = '0';}
            if($this->input->post("to_date") != ''){$to_date= $this->input->post("to_date");} else{$to_date = '0';}
            if($from_date != '0'){$from_date = implode('-',array_reverse(explode('/',$from_date))); }
            else{$from_date='0';}
            if($to_date != '0'){ $to_date= implode('-',array_reverse(explode('/',$to_date))); }
            else{$to_date='0';}

            if( $from_date!='0' && $to_date=='0')
            { $where2.= " and DATE(a.$field)='".$from_date."'"; }
            
            if( $from_date!='0' && $to_date!='0')
            { $where2.= " and DATE(a.$field) between '".$from_date."' and '".$to_date."'";}
            $where="";
            $this->db->select('a.dispatch_no,a.protfolio_wise_discount,a.protfolio_wise_account,a.protfolio_wise_amount,a.bill_months,a.sl_no,a.memo_remarks,a.discount_amount,a.bill_amount,t.name as tx_name,r.name as region_name,d.name as district_name,a.memo_e_by as e_by_id,l.name as vendor_name,
            j0.name as status,
            CONCAT(j1.name," (",j1.user_id,")")as e_by,
            CONCAT(j2.name," (",j2.user_id,")")as v_by,
            DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
            DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
            ', FALSE)
                ->from("bill_summery a")
                ->join('ref_status as j0', 'a.sts=j0.id', 'left')
                ->join('ref_tax_vat_text as t', 'a.tax_vat_text=t.id', 'left')
                ->join('ref_lawyer as l', 'a.vendor=l.id', 'left')
                ->join('ref_legal_region as r', 'l.region=r.id', 'left')
                ->join('ref_legal_district as d', 'l.district=d.id', 'left')
                ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
                ->join('users_info as j2', 'a.v_by=j2.id', 'left')
                ->where($where2);
            $q=$this->db->get();
            return $q->result();
        }
        if($module_name=='lawyer_bill_hc')
        {
            $where2 = "a.sts<>0 and a.bill_type=1 and a.hc_lawyer_bill_sts=1";
            $field = "memo_e_dt";
            if($this->input->post('legal_region_grid')!='') 
            {$where2.=" AND l.region = '".trim($this->input->post('legal_region_grid'))."'";}
            if($this->input->post('legal_district_grid')!='') 
            {$where2.=" AND l.district = '".trim($this->input->post('legal_district_grid'))."'";}
            if($this->input->post('lawyer_grid')!='') 
            {$where2.=" AND a.vendor = '".trim($this->input->post('lawyer_grid'))."'";}
            if($this->input->post('status_grid')!='') 
            {
                $where2.=" AND a.sts = '".trim($this->input->post('status_grid'))."'";
                if($this->input->post('status_grid')==26)
                {
                    $field = "stc_dt";
                }
                else if($this->input->post('status_grid')==27)
                {
                    $field = "return_dt";
                }
                else if($this->input->post('status_grid')==28)
                {
                    $field = "reject_dt";
                }
                else if($this->input->post('status_grid')==29)
                {
                    $field = "v_dt";
                }
                else if($this->input->post('status_grid')==70)
                {
                    $field = "stf_dt";
                }
                else if($this->input->post('status_grid')==88)
                {
                    $field = "finance_v_dt";
                }
                else if($this->input->post('status_grid')==89)
                {
                    $field = "finanace_r_dt";
                }
            }
            if($this->input->post("from_date") != ''){$from_date= $this->input->post("from_date");} else{$from_date = '0';}
            if($this->input->post("to_date") != ''){$to_date= $this->input->post("to_date");} else{$to_date = '0';}
            if($from_date != '0'){$from_date = implode('-',array_reverse(explode('/',$from_date))); }
            else{$from_date='0';}
            if($to_date != '0'){ $to_date= implode('-',array_reverse(explode('/',$to_date))); }
            else{$to_date='0';}

            if( $from_date!='0' && $to_date=='0')
            { $where2.= " and DATE(a.$field)='".$from_date."'"; }
            
            if( $from_date!='0' && $to_date!='0')
            { $where2.= " and DATE(a.$field) between '".$from_date."' and '".$to_date."'";}
            $where="";
            $this->db->select('a.dispatch_no,a.protfolio_wise_discount,a.protfolio_wise_account,a.protfolio_wise_amount,a.bill_months,a.sl_no,a.memo_remarks,a.discount_amount,a.bill_amount,t.name as tx_name,r.name as region_name,d.name as district_name,a.memo_e_by as e_by_id,l.name as vendor_name,
            j0.name as status,
            CONCAT(j1.name," (",j1.user_id,")")as e_by,
            CONCAT(j2.name," (",j2.user_id,")")as v_by,
            DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
            DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
            ', FALSE)
                ->from("bill_summery a")
                ->join('ref_status as j0', 'a.sts=j0.id', 'left')
                ->join('ref_tax_vat_text as t', 'a.tax_vat_text=t.id', 'left')
                ->join('ref_lawyer as l', 'a.vendor=l.id', 'left')
                ->join('ref_legal_region as r', 'l.region=r.id', 'left')
                ->join('ref_legal_district as d', 'l.district=d.id', 'left')
                ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
                ->join('users_info as j2', 'a.v_by=j2.id', 'left')
                ->where($where2);
            $q=$this->db->get();
            return $q->result();
        }
        if($module_name=='paper_bill')
        {
            $where2 = "a.sts<>0 and a.bill_type=2";
            $field = "memo_e_dt";
            if($this->input->post('vendor_type_grid')!='') 
            {
                $where2.=" AND a.vendor_type = '".trim($this->input->post('vendor_type_grid'))."'";
                if($this->input->post('paper_vendor_grid')!='') 
                {$where2.=" AND a.vendor = '".trim($this->input->post('paper_vendor_grid'))."'";}
                if($this->input->post('staff_grid')!='') 
                {$where2.=" AND a.vendor = '".trim($this->input->post('staff_grid'))."'";}
            }
            if($this->input->post('status_grid')!='') 
            {
                $where2.=" AND a.sts = '".trim($this->input->post('status_grid'))."'";
                if($this->input->post('status_grid')==26)
                {
                    $field = "stc_dt";
                }
                else if($this->input->post('status_grid')==27)
                {
                    $field = "return_dt";
                }
                else if($this->input->post('status_grid')==28)
                {
                    $field = "reject_dt";
                }
                else if($this->input->post('status_grid')==29)
                {
                    $field = "v_dt";
                }
                else if($this->input->post('status_grid')==70)
                {
                    $field = "stf_dt";
                }
                else if($this->input->post('status_grid')==88)
                {
                    $field = "finance_v_dt";
                }
                else if($this->input->post('status_grid')==89)
                {
                    $field = "finanace_r_dt";
                }
            }
            if($this->input->post("from_date") != ''){$from_date= $this->input->post("from_date");} else{$from_date = '0';}
            if($this->input->post("to_date") != ''){$to_date= $this->input->post("to_date");} else{$to_date = '0';}
            if($from_date != '0'){$from_date = implode('-',array_reverse(explode('/',$from_date))); }
            else{$from_date='0';}
            if($to_date != '0'){ $to_date= implode('-',array_reverse(explode('/',$to_date))); }
            else{$to_date='0';}

            if( $from_date!='0' && $to_date=='0')
            { $where2.= " and DATE(a.$field)='".$from_date."'"; }
            
            if( $from_date!='0' && $to_date!='0')
            { $where2.= " and DATE(a.$field) between '".$from_date."' and '".$to_date."'";}
            $this->db
            ->select('a.dispatch_no,a.protfolio_wise_discount,a.legal_district,a.protfolio_wise_account,a.protfolio_wise_amount,a.bill_months,a.sl_no,a.memo_remarks,"" as district_name,
                IF(a.vendor_type="Staff",CONCAT(uv.name,"(",uv.pin,")"),pv.name) as vendor_name,
                IF(a.vendor_type="Staff","",pr.name) as region_name,
                a.discount_amount,a.bill_amount,t.name as tx_name,a.memo_e_by as e_by_id,
                j0.name as status,
                CONCAT(j1.name," (",j1.user_id,")")as e_by,
                CONCAT(j2.name," (",j2.user_id,")")as v_by,
                DATE_FORMAT(a.memo_e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
                DATE_FORMAT(a.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
                ', FALSE)
                    ->from("bill_summery a")
                    ->join('users_info as uv', 'a.vendor=uv.id and a.vendor_type="Staff"', 'left')
                    ->join('ref_paper_vendor as pv', 'a.vendor=pv.id and a.vendor_type="Vendor"', 'left')
                    ->join('ref_legal_region as pr', 'pv.region=pr.id and a.vendor_type="Vendor"', 'left')
                    ->join('ref_tax_vat_text as t', 'a.tax_vat_text=t.id', 'left')
                    ->join('ref_status as j0', 'a.sts=j0.id', 'left')
                    ->join('users_info as j1', 'a.memo_e_by=j1.id', 'left')
                    ->join('users_info as j2', 'a.v_by=j2.id', 'left')
                    ->where($where2);
                $q=$this->db->get();
                return $q->result();
        }
        return array();
    }
    function get_all_report_data_ac_wise($module_name){
        if($module_name=='lawyer_bill')
        {
            $where2 = "a.sts<>0 and a.bill_type=1 and a.hc_lawyer_bill_sts<>1";
            $field = "memo_e_dt";
            if($this->input->post('legal_region_grid')!='') 
            {$where2.=" AND l.region = '".trim($this->input->post('legal_region_grid'))."'";}
            if($this->input->post('legal_district_grid')!='') 
            {$where2.=" AND l.district = '".trim($this->input->post('legal_district_grid'))."'";}
            if($this->input->post('lawyer_grid')!='') 
            {$where2.=" AND a.vendor = '".trim($this->input->post('lawyer_grid'))."'";}
            if($this->input->post('status_grid')!='') 
            {
                $where2.=" AND a.sts = '".trim($this->input->post('status_grid'))."'";
                if($this->input->post('status_grid')==26)
                {
                    $field = "stc_dt";
                }
                else if($this->input->post('status_grid')==27)
                {
                    $field = "return_dt";
                }
                else if($this->input->post('status_grid')==28)
                {
                    $field = "reject_dt";
                }
                else if($this->input->post('status_grid')==29)
                {
                    $field = "v_dt";
                }
                else if($this->input->post('status_grid')==70)
                {
                    $field = "stf_dt";
                }
                else if($this->input->post('status_grid')==88)
                {
                    $field = "finance_v_dt";
                }
                else if($this->input->post('status_grid')==89)
                {
                    $field = "finanace_r_dt";
                }
            }
            
            


            if($this->input->post("from_date") != ''){$from_date= $this->input->post("from_date");} else{$from_date = '0';}
            if($this->input->post("to_date") != ''){$to_date= $this->input->post("to_date");} else{$to_date = '0';}
            if($from_date != '0'){$from_date = implode('-',array_reverse(explode('/',$from_date))); }
            else{$from_date='0';}
            if($to_date != '0'){ $to_date= implode('-',array_reverse(explode('/',$to_date))); }
            else{$to_date='0';}

            if( $from_date!='0' && $to_date=='0')
            { $where2.= " and DATE(a.$field)='".$from_date."'"; }
            
            if( $from_date!='0' && $to_date!='0')
            { $where2.= " and DATE(a.$field) between '".$from_date."' and '".$to_date."'";}


            $query_str = "SELECT a.dispatch_no,a.bill_months,cd.ac_name,a.sl_no,
            a.memo_remarks,r.name as region_name,d.name as district_name,a.memo_e_by as e_by_id,
            l.name as vendor_name,j0.name as status,cd.amount as bill_amount, 
            cd.discount_amount as discount_amount,cd.loan_ac,cd.org_loan_ac,cd.proposed_type,
            CONCAT(j1.name,' (',j1.user_id,')')as e_by,
            CONCAT(j2.name,' (',j2.user_id,')')as v_by,
            DATE_FORMAT(a.memo_e_dt,'%d-%b-%y %h:%i %p') AS e_dt,
            DATE_FORMAT(a.stf_dt,'%d-%b-%y %h:%i %p') AS stf_dt,
            DATE_FORMAT(cd.txrn_dt,'%d-%b-%y') AS txrn_dt,
            cd.case_number,rq.name as type_of_case,
            IF(cd.activities_id=0,cd.description,IF(cd.main_table_name='case_against_bank',ca.name,IF(cd.main_table_name='legal_affairs',la.name,IF(cd.req_type=2,ar.name,ni.name)))) as act_name,
            l.code as vendor_ref_no,
            DATE_FORMAT(a.v_dt,'%d-%b-%y %h:%i %p') AS v_dt
            FROM bill_summery a
            LEFT OUTER JOIN cost_details as cd ON(a.id=cd.bill_id)
            LEFT OUTER JOIN ref_schedule_charges_ara as ar on (cd.vendor_type=1 AND cd.activities_id=ar.id and cd.req_type=2 AND (cd.main_table_name='suit_filling_info' OR cd.main_table_name='cma' OR cd.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (cd.vendor_type=1 AND cd.activities_id=ni.id and cd.req_type<>2 AND cd.req_type IS NOT NULL AND (cd.main_table_name='suit_filling_info' OR cd.main_table_name='cma' OR cd.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (cd.vendor_type=1 AND cd.activities_id=ca.id AND cd.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (cd.vendor_type=1 AND cd.activities_id=la.id AND cd.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_req_type as rq ON(cd.req_type=rq.id)
            LEFT OUTER JOIN ref_status as j0 ON(a.sts=j0.id)
            LEFT OUTER JOIN ref_lawyer as l ON(a.vendor=l.id)
            LEFT OUTER JOIN ref_legal_region as r ON(cd.region=r.id)
            LEFT OUTER JOIN ref_legal_district as d ON(cd.district=d.id)
            LEFT OUTER JOIN users_info as j1 ON(a.memo_e_by=j1.id)
            LEFT OUTER JOIN users_info as j2 ON(a.v_by=j2.id)
            WHERE $where2";
            $q = $this->db->query($query_str);
            return $q->result();
        }
        if($module_name=='court_fee')
        {
            $where2 = "a.sts<>0 and a.bill_type=4";
            $field = "memo_e_dt";
            if($this->input->post('legal_region_grid')!='') 
            {$where2.=" AND l.region = '".trim($this->input->post('legal_region_grid'))."'";}
            if($this->input->post('legal_district_grid')!='') 
            {$where2.=" AND l.district = '".trim($this->input->post('legal_district_grid'))."'";}
            if($this->input->post('lawyer_grid')!='') 
            {$where2.=" AND a.vendor = '".trim($this->input->post('lawyer_grid'))."'";}
            if($this->input->post('status_grid')!='') 
            {
                $where2.=" AND a.sts = '".trim($this->input->post('status_grid'))."'";
                if($this->input->post('status_grid')==26)
                {
                    $field = "stc_dt";
                }
                else if($this->input->post('status_grid')==27)
                {
                    $field = "return_dt";
                }
                else if($this->input->post('status_grid')==28)
                {
                    $field = "reject_dt";
                }
                else if($this->input->post('status_grid')==29)
                {
                    $field = "v_dt";
                }
                else if($this->input->post('status_grid')==70)
                {
                    $field = "stf_dt";
                }
                else if($this->input->post('status_grid')==88)
                {
                    $field = "finance_v_dt";
                }
                else if($this->input->post('status_grid')==89)
                {
                    $field = "finanace_r_dt";
                }
            }
            if($this->input->post("from_date") != ''){$from_date= $this->input->post("from_date");} else{$from_date = '0';}
            if($this->input->post("to_date") != ''){$to_date= $this->input->post("to_date");} else{$to_date = '0';}
            if($from_date != '0'){$from_date = implode('-',array_reverse(explode('/',$from_date))); }
            else{$from_date='0';}
            if($to_date != '0'){ $to_date= implode('-',array_reverse(explode('/',$to_date))); }
            else{$to_date='0';}

            if( $from_date!='0' && $to_date=='0')
            { $where2.= " and DATE(a.$field)='".$from_date."'"; }
            
            if( $from_date!='0' && $to_date!='0')
            { $where2.= " and DATE(a.$field) between '".$from_date."' and '".$to_date."'";}
            $query_str = "SELECT a.dispatch_no,a.bill_months,cd.ac_name,a.sl_no,a.memo_remarks,r.name as region_name,d.name as district_name,a.memo_e_by as e_by_id,l.name as vendor_name,
            j0.name as status,cd.amount as bill_amount, cd.discount_amount as discount_amount,cd.loan_ac,cd.org_loan_ac,cd.proposed_type,
            CONCAT(j1.name,' (',j1.user_id,')')as e_by,
            CONCAT(j2.name,' (',j2.user_id,')')as v_by,
            DATE_FORMAT(a.memo_e_dt,'%d-%b-%y %h:%i %p') AS e_dt,
            DATE_FORMAT(a.stf_dt,'%d-%b-%y %h:%i %p') AS stf_dt,
            DATE_FORMAT(cd.txrn_dt,'%d-%b-%y') AS txrn_dt,
            cd.case_number,rq.name as type_of_case,
            ca.name as act_name,
            l.code as vendor_ref_no,
            DATE_FORMAT(a.v_dt,'%d-%b-%y %h:%i %p') AS v_dt
            FROM bill_summery a
            LEFT OUTER JOIN cost_details as cd ON(a.id=cd.bill_id)
            LEFT OUTER JOIN ref_court_fee_activities as ca on (cd.activities_id=ca.id)
            LEFT OUTER JOIN ref_req_type as rq ON(cd.req_type=rq.id)
            LEFT OUTER JOIN ref_status as j0 ON(a.sts=j0.id)
            LEFT OUTER JOIN ref_lawyer as l ON(a.vendor=l.id)
            LEFT OUTER JOIN ref_legal_region as r ON(cd.region=r.id)
            LEFT OUTER JOIN ref_legal_district as d ON(cd.district=d.id)
            LEFT OUTER JOIN users_info as j1 ON(a.memo_e_by=j1.id)
            LEFT OUTER JOIN users_info as j2 ON(a.v_by=j2.id)
            WHERE $where2";

            $q = $this->db->query($query_str);
            return $q->result();
        }
        if($module_name=='lawyer_bill_hc')
        {
            $where2 = "a.sts<>0 and a.bill_type=1 and a.hc_lawyer_bill_sts=1";
            $field = "memo_e_dt";
            if($this->input->post('legal_region_grid')!='') 
            {$where2.=" AND l.region = '".trim($this->input->post('legal_region_grid'))."'";}
            if($this->input->post('legal_district_grid')!='') 
            {$where2.=" AND l.district = '".trim($this->input->post('legal_district_grid'))."'";}
            if($this->input->post('lawyer_grid')!='') 
            {$where2.=" AND a.vendor = '".trim($this->input->post('lawyer_grid'))."'";}
            if($this->input->post('status_grid')!='') 
            {
                $where2.=" AND a.sts = '".trim($this->input->post('status_grid'))."'";
                if($this->input->post('status_grid')==26)
                {
                    $field = "stc_dt";
                }
                else if($this->input->post('status_grid')==27)
                {
                    $field = "return_dt";
                }
                else if($this->input->post('status_grid')==28)
                {
                    $field = "reject_dt";
                }
                else if($this->input->post('status_grid')==29)
                {
                    $field = "v_dt";
                }
                else if($this->input->post('status_grid')==70)
                {
                    $field = "stf_dt";
                }
                else if($this->input->post('status_grid')==88)
                {
                    $field = "finance_v_dt";
                }
                else if($this->input->post('status_grid')==89)
                {
                    $field = "finanace_r_dt";
                }
            }
            if($this->input->post("from_date") != ''){$from_date= $this->input->post("from_date");} else{$from_date = '0';}
            if($this->input->post("to_date") != ''){$to_date= $this->input->post("to_date");} else{$to_date = '0';}
            if($from_date != '0'){$from_date = implode('-',array_reverse(explode('/',$from_date))); }
            else{$from_date='0';}
            if($to_date != '0'){ $to_date= implode('-',array_reverse(explode('/',$to_date))); }
            else{$to_date='0';}

            if( $from_date!='0' && $to_date=='0')
            { $where2.= " and DATE(a.$field)='".$from_date."'"; }
            
            if( $from_date!='0' && $to_date!='0')
            { $where2.= " and DATE(a.$field) between '".$from_date."' and '".$to_date."'";}
            $query_str = "SELECT a.dispatch_no,a.sl_no,cd.ac_name,a.bill_months,a.memo_remarks,r.name as region_name,d.name as district_name,a.memo_e_by as e_by_id,l.name as vendor_name,
            j0.name as status,cd.amount as bill_amount, cd.discount_amount as discount_amount,cd.loan_ac,cd.org_loan_ac,cd.proposed_type,
            CONCAT(j1.name,' (',j1.user_id,')')as e_by,
            CONCAT(j2.name,' (',j2.user_id,')')as v_by,
            DATE_FORMAT(a.memo_e_dt,'%d-%b-%y %h:%i %p') AS e_dt,
            DATE_FORMAT(a.stf_dt,'%d-%b-%y %h:%i %p') AS stf_dt,
            DATE_FORMAT(cd.txrn_dt,'%d-%b-%y') AS txrn_dt,
            cd.case_number,rq.name as type_of_case,
            ca.name as act_name,
            l.code as vendor_ref_no,
            DATE_FORMAT(a.v_dt,'%d-%b-%y %h:%i %p') AS v_dt
            FROM bill_summery a
            LEFT OUTER JOIN cost_details as cd ON(a.id=cd.bill_id)
            LEFT OUTER JOIN ref_hc_activities as ca on (cd.activities_id=ca.id)
            LEFT OUTER JOIN ref_req_type as rq ON(cd.req_type=rq.id)
            LEFT OUTER JOIN ref_status as j0 ON(a.sts=j0.id)
            LEFT OUTER JOIN ref_lawyer as l ON(a.vendor=l.id)
            LEFT OUTER JOIN ref_legal_region as r ON(cd.region=r.id)
            LEFT OUTER JOIN ref_legal_district as d ON(cd.district=d.id)
            LEFT OUTER JOIN users_info as j1 ON(a.memo_e_by=j1.id)
            LEFT OUTER JOIN users_info as j2 ON(a.v_by=j2.id)
            WHERE $where2";

            $q = $this->db->query($query_str);
            return $q->result();
        }
        if($module_name=='paper_bill')
        {
            $where2 = "a.sts<>0 and a.bill_type=2";
            $field = "memo_e_dt";
            if($this->input->post('vendor_type_grid')!='') 
            {
                $where2.=" AND a.vendor_type = '".trim($this->input->post('vendor_type_grid'))."'";
                if($this->input->post('paper_vendor_grid')!='') 
                {$where2.=" AND a.vendor = '".trim($this->input->post('paper_vendor_grid'))."'";}
                if($this->input->post('staff_grid')!='') 
                {$where2.=" AND a.vendor = '".trim($this->input->post('staff_grid'))."'";}
            }
            if($this->input->post('status_grid')!='') 
            {
                $where2.=" AND a.sts = '".trim($this->input->post('status_grid'))."'";
                if($this->input->post('status_grid')==26)
                {
                    $field = "stc_dt";
                }
                else if($this->input->post('status_grid')==27)
                {
                    $field = "return_dt";
                }
                else if($this->input->post('status_grid')==28)
                {
                    $field = "reject_dt";
                }
                else if($this->input->post('status_grid')==29)
                {
                    $field = "v_dt";
                }
                else if($this->input->post('status_grid')==70)
                {
                    $field = "stf_dt";
                }
                else if($this->input->post('status_grid')==88)
                {
                    $field = "finance_v_dt";
                }
                else if($this->input->post('status_grid')==89)
                {
                    $field = "finanace_r_dt";
                }
            }
            if($this->input->post("from_date") != ''){$from_date= $this->input->post("from_date");} else{$from_date = '0';}
            if($this->input->post("to_date") != ''){$to_date= $this->input->post("to_date");} else{$to_date = '0';}
            if($from_date != '0'){$from_date = implode('-',array_reverse(explode('/',$from_date))); }
            else{$from_date='0';}
            if($to_date != '0'){ $to_date= implode('-',array_reverse(explode('/',$to_date))); }
            else{$to_date='0';}

            if( $from_date!='0' && $to_date=='0')
            { $where2.= " and DATE(a.$field)='".$from_date."'"; }
            
            if( $from_date!='0' && $to_date!='0')
            { $where2.= " and DATE(a.$field) between '".$from_date."' and '".$to_date."'";}
            
            $query_str = "SELECT cd.amount as bill_amount,a.bill_months,cd.ac_name, cd.discount_amount as discount_amount,cd.loan_ac,cd.org_loan_ac,cd.proposed_type,
            a.dispatch_no,a.legal_district,a.sl_no,a.memo_remarks,dr.name as district_name,
                IF(a.vendor_type='Staff',CONCAT(uv.name,'(',uv.pin,')'),pv.name) as vendor_name,
                pr.name as region_name,a.memo_e_by as e_by_id,
                j0.name as status,CONCAT(j1.name,' (',j1.user_id,')')as e_by,
                CONCAT(j2.name,' (',j2.user_id,')')as v_by,
                DATE_FORMAT(a.memo_e_dt,'%d-%b-%y %h:%i %p') AS e_dt,
                DATE_FORMAT(a.stf_dt,'%d-%b-%y %h:%i %p') AS stf_dt,
                DATE_FORMAT(cd.txrn_dt,'%d-%b-%y') AS txrn_dt,
                cd.case_number,rq.name as type_of_case,
                ca.name as act_name,
                IF(a.vendor_type='Staff',uv.pin,pv.code) as vendor_ref_no,
                DATE_FORMAT(a.v_dt,'%d-%b-%y %h:%i %p') AS v_dt
            FROM bill_summery a
            LEFT OUTER JOIN cost_details as cd ON(a.id=cd.bill_id)
            LEFT OUTER JOIN ref_paper_bill_activities as ca on (cd.activities_id=ca.id)
            LEFT OUTER JOIN ref_req_type as rq ON(cd.req_type=rq.id)
            LEFT OUTER JOIN users_info as uv ON(a.vendor=uv.id and a.vendor_type='Staff')
            LEFT OUTER JOIN ref_paper_vendor as pv ON(a.vendor=pv.id and a.vendor_type='Vendor')
            LEFT OUTER JOIN ref_legal_region as pr ON(cd.region=pr.id)
            LEFT OUTER JOIN ref_legal_district as dr ON(cd.district=dr.id)
            LEFT OUTER JOIN ref_status as j0 ON(a.sts=j0.id)
            LEFT OUTER JOIN users_info as j1 ON(a.memo_e_by=j1.id)
            LEFT OUTER JOIN users_info as j2 ON(a.v_by=j2.id)
            WHERE $where2";
            $q = $this->db->query($query_str);
            return $q->result();
        }
        return array();
    }
    function get_expenese_details_court($id)
    {
        if($id!=''){
                $str="SELECT  SUM(b.amount) as amount,b.expense_remarks as remarks,ac.name as activities_name,DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') AS activities_date
                     FROM cost_details b
                     LEFT OUTER JOIN ref_court_entertainment_activities ac on(ac.id=b.activities_id)
                     WHERE b.bill_id='".$id."' GROUP BY b.main_table_id";
            $data = $this->db->query($str)->result();
        return $data;
        }
        else{return NULL;}
    }
}
?>
