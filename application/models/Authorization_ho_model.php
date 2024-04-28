<?php
class Authorization_ho_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
    }



    function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
       $i=0;
        $where2 = "a.sts=1";
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

                if($filterdatafield=='type')
                {
                    $filterdatafield='t.name';
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield='j0.name';
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield='j0.name';
                }
                else if($filterdatafield=='sfa_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.sfa_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='auth_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(a.auth_dt,'%d-%b-%y %h:%i %p')";
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
                if($filterdatafield =='sfa_by')
                {
                    $where .= " (j1.name LIKE '%".$filtervalue."%' OR j1.user_id LIKE '%".$filtervalue."%') ";
                }
                else if($filterdatafield =='auth_by')
                {
                    $where .= " (j2.name LIKE '%".$filtervalue."%' OR j2.user_id LIKE '%".$filtervalue."%') ";
                }
                else if($filterdatafield =='loan_ac')
                {
                    $where .= " (c.loan_ac LIKE '%".$filtervalue."%' OR s.loan_ac LIKE '%".$filtervalue."%') ";
                }
                else if($filterdatafield =='ac_name')
                {
                    $where .= " (c.ac_name LIKE '%".$filtervalue."%' OR s.ac_name LIKE '%".$filtervalue."%') ";
                }
                else if($filterdatafield =='req_type_name')
                {
                    $where .= " (rq1.name LIKE '%".$filtervalue."%' OR rq2.name LIKE '%".$filtervalue."%') ";
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
    ->select('SQL_CALC_FOUND_ROWS a.*,t.name as type,
        j0.name as status,IF(a.event_name="cma",c.req_type,s.req_type) as req_type,
        IF(a.event_name="cma",c.loan_ac,s.loan_ac) as loan_ac,
        IF(a.event_name="cma",c.ac_name,s.ac_name) as ac_name,
        IF(a.event_name="cma",rq1.name,rq2.name) as req_type_name,
        r.change_type,
        CONCAT(j1.name," (",j1.user_id,")")as sfa_by,
        CONCAT(j2.name," (",j2.user_id,")")as auth_by,
        DATE_FORMAT(a.sfa_dt,"%d-%b-%y %h:%i %p") AS sfa_dt,
        DATE_FORMAT(a.auth_dt,"%d-%b-%y %h:%i %p") AS auth_dt
        ', FALSE)
            ->from("authorization a")
            ->join('ref_authorization_type as t', 'a.authorization_type=t.id', 'left')
            ->join('ref_status as j0', 'a.auth_sts=j0.id', 'left')
            ->join('users_info as j1', 'a.sfa_by=j1.id', 'left')
            ->join('users_info as j2', 'a.auth_by=j2.id', 'left')
            ->join('cma as c', 'a.event_id=c.id AND a.event_name="cma"', 'left')
            ->join('ref_req_type as rq1', 'c.req_type=rq1.id AND a.event_name="cma"', 'left')
            ->join('change_request as r', 'a.event_id=r.id AND a.event_name="suit_file"', 'left')
            ->join('suit_filling_info as s', 'r.suit_file_id=s.id AND a.event_name="suit_file"', 'left')
            ->join('ref_req_type as rq2', 's.req_type=rq2.id AND a.event_name="suit_file"', 'left')
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
    function get_add_action_data($id)
    {
        $this->db
            ->select('a.*,t.name as type,
                j0.name as status,
                CONCAT(j1.name," (",j1.user_id,")")as sfa_by,
                CONCAT(j2.name," (",j2.user_id,")")as auth_by,
                DATE_FORMAT(a.sfa_dt,"%d-%b-%y %h:%i %p") AS sfa_dt,
                DATE_FORMAT(a.auth_dt,"%d-%b-%y %h:%i %p") AS auth_dt', FALSE)
            ->from("authorization a")
            ->join('ref_authorization_type as t', 'a.authorization_type=t.id', 'left')
            ->join('ref_status as j0', 'a.auth_sts=j0.id', 'left')
            ->join('users_info as j1', 'a.sfa_by=j1.id', 'left')
            ->join('users_info as j2', 'a.auth_by=j2.id', 'left')
            ->where("a.id='".$id."' and a.sts=1", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }
    function delete_action()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        // For Appeal and Bail Money Authorization Operation's
        if ($this->input->post('operation_type')==3) {
            if($this->input->post('type')=='approve'){
                $pre_action_result=$this->Common_model->get_pre_action_data('authorization',$_POST['deleteEventId'],'67,69','auth_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                   
                    $data = array('v_sts' => 67);
                    $this->db->where('id', $_POST['EventId']);
                    $this->db->update('appeal_deposit', $data);
                    $data3=array('auth_sts' => 67,'auth_by'=> $this->session->userdata['ast_user']['user_id'], 'auth_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['deleteEventId']);
                    $this->db->update('authorization', $data3);
                    $data2 = $this->user_model->user_activities(67,'appeal_deposit',$this->input->post('EventId'),'authorization','Appeal and Bail Money Withdrawn Authorized('.$this->input->post('deleteEventId').')');
                }
                
            }
            if($this->input->post('type')=='return'){
                $pre_action_result=$this->Common_model->get_pre_action_data('authorization',$_POST['deleteEventId'],'67,69','auth_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data = array('v_sts' => 69);
                    $this->db->where('id', $_POST['EventId']);
                    $this->db->update('appeal_deposit', $data);
                    $data3=array('auth_sts' => 69,'sts' => 0,'reason'=>$this->input->post('reason'),'return_by'=> $this->session->userdata['ast_user']['user_id'], 'return_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['deleteEventId']);
                    $this->db->update('authorization', $data3);
                    $data = array('sts' => 69);
                    $data2 = $this->user_model->user_activities(69,'appeal_deposit',$this->input->post('EventId'),'authorization','Appeal and Bail Money Withdrawn Authorization Return('.$this->input->post('deleteEventId').')',$_POST['reason']);
                }
                
            }
            if($this->input->post('type')=='hold'){
               $data = array('v_sts' => 68);
                $this->db->where('id', $_POST['EventId']);
                $this->db->update('appeal_deposit', $data);
                $data3=array('auth_sts' => 68,'reason'=>$this->input->post('reason'),'hold_by'=> $this->session->userdata['ast_user']['user_id'], 'hold_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('authorization', $data3);
               
                $data2 = $this->user_model->user_activities(68,'appeal_deposit',$this->input->post('EventId'),'authorization','Appeal and Bail Money Withdrawn Authorization Hold('.$this->input->post('deleteEventId').')',$_POST['reason']);
                
            }
        }
        else
        {
            //For Suit File Authorization Operation's CMA
            if ($this->input->post('event_name')=='cma') {
                if($this->input->post('type')=='approve'){
                    $pre_action_result=$this->Common_model->get_pre_action_data('authorization',$_POST['deleteEventId'],'67,69','auth_sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $data = array('cma_sts' => 67);
                        $this->db->where('id', $_POST['EventId']);
                        $this->db->update('cma', $data);
                        $data = array('sts' => 67);
                        $this->db->where('cma_id', $_POST['EventId']);
                        $this->db->update('suit_filling_info', $data);
                        $data3=array('auth_sts' => 67,'auth_by'=> $this->session->userdata['ast_user']['user_id'], 'auth_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['deleteEventId']);
                        $this->db->update('authorization', $data3);
                        $data2 = $this->user_model->user_activities(67,'cma',$this->input->post('EventId'),'authorization','Suit File Authorized('.$this->input->post('deleteEventId').')');
                    }
                    
                }
                if($this->input->post('type')=='return'){
                    $pre_action_result=$this->Common_model->get_pre_action_data('authorization',$_POST['deleteEventId'],'67,69','auth_sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $data = array('cma_sts' => 69);
                        $this->db->where('id', $_POST['EventId']);
                        $this->db->update('cma', $data);
                        $data3=array('auth_sts' => 69,'sts' => 0,'reason'=>$this->input->post('reason'),'return_by'=> $this->session->userdata['ast_user']['user_id'], 'return_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['deleteEventId']);
                        $this->db->update('authorization', $data3);
                        $data = array('sts' => 69);
                        $this->db->where('cma_id', $_POST['EventId']);
                        $this->db->update('suit_filling_info', $data);
                        $data2 = $this->user_model->user_activities(69,'cma',$this->input->post('EventId'),'authorization','Suit Filing Authorization Return('.$this->input->post('deleteEventId').')',$_POST['reason']);
                    }
                    
                }
                if($this->input->post('type')=='hold'){
                   $data = array('cma_sts' => 68);
                    $this->db->where('id', $_POST['EventId']);
                    $this->db->update('cma', $data);
                    $data3=array('auth_sts' => 68,'reason'=>$this->input->post('reason'),'hold_by'=> $this->session->userdata['ast_user']['user_id'], 'hold_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['deleteEventId']);
                    $this->db->update('authorization', $data3);
                    $data = array('sts' => 68);
                    $this->db->where('cma_id', $_POST['EventId']);
                    $this->db->update('suit_filling_info', $data);
                    $data2 = $this->user_model->user_activities(68,'cma',$this->input->post('EventId'),'authorization','Suit Filing Authorization Hold('.$this->input->post('deleteEventId').')',$_POST['reason']);
                    
                }
            }

            if($this->input->post('event_name')=='suit_file')
            {
                if($this->input->post('type')=='approve'){
                    $pre_action_result=$this->Common_model->get_pre_action_data('authorization',$_POST['deleteEventId'],'67,69','auth_sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $str="SELECT  j0.*
                             FROM change_request j0
                         WHERE j0.sts != '0'  AND j0.id= '".$this->input->post('EventId')."' LIMIT 1";
                        $change_data=$this->db->query($str)->row();

                        $data = array('sts' => 67);
                        $this->db->where('id', $_POST['EventId']);
                        $this->db->update('change_request', $data);
                        $data3=array('auth_sts' => 67,'auth_by'=> $this->session->userdata['ast_user']['user_id'], 'auth_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['deleteEventId']);
                        $this->db->update('authorization', $data3);
                        $data2 = $this->user_model->user_activities(67,'authorization',$this->input->post('EventId'),'authorization','Change Request Authorized('.$this->input->post('deleteEventId').')');
                    }
                    
                }
                if($this->input->post('type')=='return'){
                    $pre_action_result=$this->Common_model->get_pre_action_data('authorization',$_POST['deleteEventId'],'67,69','auth_sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $data3=array('auth_sts' => 69,'sts' => 0,'reason'=>$this->input->post('reason'),'return_by'=> $this->session->userdata['ast_user']['user_id'], 'return_dt'=>date('Y-m-d H:i:s'));
                        $this->db->where('id', $_POST['deleteEventId']);
                        $this->db->update('authorization', $data3);
                        $data = array('sts' => 69);
                        $this->db->where('id', $_POST['EventId']);
                        $this->db->update('change_request', $data);
                        $data2 = $this->user_model->user_activities(69,'authorization',$this->input->post('EventId'),'authorization','Suit Filing Authorization Return('.$this->input->post('deleteEventId').')',$_POST['reason']);
                    }
                    
                }
                if($this->input->post('type')=='hold'){
                    $data3=array('auth_sts' => 68,'reason'=>$this->input->post('reason'),'hold_by'=> $this->session->userdata['ast_user']['user_id'], 'hold_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['deleteEventId']);
                    $this->db->update('authorization', $data3);
                    $data = array('sts' => 68);
                    $this->db->where('id', $_POST['EventId']);
                    $this->db->update('change_request', $data);
                    $data2 = $this->user_model->user_activities(68,'authorization',$this->input->post('EventId'),'authorization','Suit Filing Authorization Hold('.$this->input->post('deleteEventId').')',$_POST['reason']);
                    
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
            return $_POST['deleteEventId'];
        }
    }
    function bulk_acktion()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = true; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($this->input->post('operation')=='apv'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    //For CMA Suit File Authorization Operation's
                    if ($this->input->post('event_name_'.$i)=='cma') {
                        $pre_action_result=$this->Common_model->get_pre_action_data('authorization',$_POST['id_'.$i],'67','auth_sts');
                        if (count($pre_action_result)>0) 
                        {
                            return 'taken';
                        }
                        else
                        {
                            $data = array('cma_sts' => 67);
                            $this->db->where('id', $_POST['event_id_'.$i]);
                            $this->db->update('cma', $data);
                            $data = array('sts' => 67);
                            $this->db->where('cma_id', $_POST['event_id_'.$i]);
                            $this->db->update('suit_filling_info', $data);
                            $data3=array('auth_sts' => 67,'auth_by'=> $this->session->userdata['ast_user']['user_id'], 'auth_dt'=>date('Y-m-d H:i:s'));
                            $this->db->where('id', $_POST['id_'.$i]);
                            $this->db->update('authorization', $data3);
                            $data2 = $this->user_model->user_activities(67,'cma',$this->input->post('event_id_'.$i),'authorization','Suit File Authorized('.$this->input->post('id_'.$i).')');
                        }
                    }
                    //For Suit Authorization Operation's
                    if ($this->input->post('event_name_'.$i)=='suit_file') {
                        $pre_action_result=$this->Common_model->get_pre_action_data('authorization',$_POST['id_'.$i],'67','auth_sts');
                        if (count($pre_action_result)>0) 
                        {
                            return 'taken';
                        }
                        else
                        {
                            $data = array('sts' => 67);
                            $this->db->where('id', $_POST['event_id_'.$i]);
                            $this->db->update('change_request', $data);
                            $data3=array('auth_sts' => 67,'auth_by'=> $this->session->userdata['ast_user']['user_id'], 'auth_dt'=>date('Y-m-d H:i:s'));
                            $this->db->where('id', $_POST['id_'.$i]);
                            $this->db->update('authorization', $data3);
                            $data2 = $this->user_model->user_activities(67,'authorization',$this->input->post('event_id_'.$i),'authorization','Change Request Authorized('.$this->input->post('id_'.$i).')');
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
            $this->db->trans_commit();
            $this->db->db_debug = $db_debug;
            return 1;
        }
    }
    function get_bulk_data()
    {
        $where2 = "a.sts!='0'";
        if ($this->input->post('operation')=='apv') 
        {
            $where2.=" AND a.auth_sts = '66'";
        }
        if ($this->input->post('operation')=='download') 
        {
            $where2.=" AND a.auth_sts IN(67,78) AND a.authorization_type<>3";
        }
        if($this->input->post('legal_region') != '')
        {
            $where2.=" AND ((sf.legal_region = '".$this->input->post('legal_region')."' AND a.event_name='suit_file') OR (a.event_name='cma' and c.legal_region ='".$this->input->post('legal_region')."'))";
        }
        if($this->input->post('legal_district') != '')
        {
            $where2.=" AND ((sf.district = '".$this->input->post('legal_district')."' AND a.event_name='suit_file') OR (a.event_name='cma' and c.case_fill_dist ='".$this->input->post('legal_district')."'))";
        }
        if($this->input->post('case_deal_officer') != '')
        {
            $where2.=" AND ((sf.case_deal_officer = '".$this->input->post('case_deal_officer')."' AND a.event_name='suit_file') OR (a.event_name='cma' and c.legal_user ='".$this->input->post('case_deal_officer')."'))";
        }
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') == '') 
        {$where2.=" AND DATE(a.sfa_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_to') != '') 
        {$where2.=" AND DATE(a.sfa_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(a.sfa_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}

        if($this->input->post('auth_dt_from') != '' && $this->input->post('auth_dt_to') == '') 
        {$where2.=" AND DATE(a.auth_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('auth_dt_from')))))."'";}
        if($this->input->post('auth_dt_from') != '' && $this->input->post('auth_dt_to') != '') 
        {$where2.=" AND DATE(a.auth_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('auth_dt_from')))))."' AND DATE(a.auth_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('auth_dt_to')))))."'";}

        $this->db
        ->select('a.*,t.name as type,
        j0.name as status,
        CONCAT(j1.name," (",j1.user_id,")")as sfa_by,
        CONCAT(j2.name," (",j2.user_id,")")as auth_by,
        DATE_FORMAT(a.sfa_dt,"%d-%b-%y %h:%i %p") AS sfa_dt,
        DATE_FORMAT(a.auth_dt,"%d-%b-%y %h:%i %p") AS auth_dt
        ', FALSE)
           ->from("authorization a")
           ->join('cma as c', 'a.event_id=c.id and a.event_name="cma"', 'left')
           ->join('change_request as cr', 'a.event_id=cr.id and a.event_name="suit_file"', 'left')
           ->join('suit_filling_info as sf', 'sf.id=cr.suit_file_id', 'left')
            ->join('ref_authorization_type as t', 'a.authorization_type=t.id', 'left')
            ->join('ref_status as j0', 'a.auth_sts=j0.id', 'left')
            ->join('users_info as j1', 'a.sfa_by=j1.id', 'left')
            ->join('users_info as j2', 'a.auth_by=j2.id', 'left')
            ->where($where2)
            ->order_by('a.id','DESC');
        $q=$this->db->get();
        return $q->result();
    }
    function add_edit_suit_filling()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $data = array(
            'cma_id' =>$this->security->xss_clean( $this->input->post('cma_id')),
            'case_name' =>$this->security->xss_clean( $this->input->post('case_name')),
            'case_number' =>$this->security->xss_clean( $this->input->post('case_number')),
            'case_claim_amount' =>$this->security->xss_clean( $this->input->post('case_claim_amount')),
            'prev_date' =>implode('-',array_reverse(explode('/',$this->input->post('prev_date')))),
            'case_sts_prev_dt' =>$this->security->xss_clean( $this->input->post('case_sts_prev_dt')),
            'act_prev_date' =>$this->security->xss_clean( $this->input->post('act_prev_date')),
            'next_date' =>implode('-',array_reverse(explode('/',$this->input->post('next_date')))),
            'case_sts_next_dt' =>$this->security->xss_clean( $this->input->post('case_sts_next_dt')),
            'remarks_next_date' =>$this->security->xss_clean( $this->input->post('remarks_next_date')),
            'filling_plaintiff' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
            'filling_date' =>implode('-',array_reverse(explode('/',$this->input->post('filling_date')))),
            'case_deal_officer' =>$this->security->xss_clean( $this->input->post('case_deal_officer')),
            'prev_lawyer_name' =>$this->security->xss_clean( $this->input->post('prev_lawyer_name')),
            'prest_lawyer_name' =>$this->security->xss_clean( $this->input->post('prest_lawyer_name')),
            'prev_court_name' =>$this->security->xss_clean( $this->input->post('prev_court_name')),
            'prest_court_name' =>$this->security->xss_clean( $this->input->post('prest_court_name'))
        );
        //'subscription_date'=>implode('-',array_reverse(explode('/',$this->input->post('subscription_date')))),
        //For ADD Suit Filling Input
        if ($this->input->post('add_edit')=='add') {
            $data['e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['e_dt'] = date('Y-m-d H:i:s');
            $this->db->insert('suit_filling_info', $data);
            $insert_idss = $this->db->insert_id();
            for($i=1;$i<= $_POST['expense_counter'];$i++)
            {
                $expense_data = array(
                'cma_id' => $this->security->xss_clean( $this->input->post('cma_id')),
                'suit_fil_id' => $insert_idss,
                'expense_type' =>$this->security->xss_clean( $this->input->post('expense_type_'.$i)),
                'activities_name' => $this->security->xss_clean( $this->input->post('activities_name_'.$i)),
                'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
                'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i))
                );
                if ($this->input->post('expense_type_'.$i)==1) {
                    $expense_data['lawyer_name'] = $this->security->xss_clean( $this->input->post('lawyer_name_'.$i));
                    $expense_data['vendor_name'] ='';
                }
                else
                {
                     $expense_data['vendor_name'] = $this->security->xss_clean( $this->input->post('vendor_name_'.$i));
                     $expense_data['lawyer_name'] ='';
                }
                if ($_POST['expense_delete_'.$i]!=1) {
                    $this->db->insert('expenses', $expense_data);
                }
                $insert_idss2 = $this->db->insert_id();
                if($insert_idss2==0)
                {
                    $this->db->trans_rollback();
                    $this->db->db_debug = $db_debug;
                    return '00';        
                }
            }
            $data = array('cma_sts' => 64);
            $this->db->where('id', $_POST['cma_id']);
            $this->db->update('cma', $data);
            $data2 = $this->user_model->user_activities(64,'cma',$this->input->post('cma_id'),'cma','Suit Filling Info Added('.$this->input->post('cma_id').')');
        }
        else //For Update Existing Suit Filling Info for this CMA
        {
            $edit_id = $this->input->post('edit_id');
            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $edit_id);
            $this->db->update('suit_filling_info', $data);
            $insert_idss = $edit_id;

            for($i=1;$i<= $_POST['expense_counter'];$i++)
            {
                $expense_data = array(
                'cma_id' => $this->security->xss_clean( $this->input->post('cma_id')),
                'suit_fil_id' => $insert_idss,
                'expense_type' =>$this->security->xss_clean( $this->input->post('expense_type_'.$i)),
                'activities_name' => $this->security->xss_clean( $this->input->post('activities_name_'.$i)),
                'activities_date' => implode('-',array_reverse(explode('/',$this->input->post('activities_date_'.$i)))),
                'remarks' => $this->security->xss_clean( $this->input->post('remarks_'.$i))
                );
                if ($this->input->post('expense_type_'.$i)==1) {
                    $expense_data['lawyer_name'] = $this->security->xss_clean( $this->input->post('lawyer_name_'.$i));
                    $expense_data['vendor_name'] ='';
                }
                else
                {
                     $expense_data['vendor_name'] = $this->security->xss_clean( $this->input->post('vendor_name_'.$i));
                     $expense_data['lawyer_name'] ='';
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

            $data = array('cma_sts' => 65);
            $this->db->where('id', $_POST['cma_id']);
            $this->db->update('cma', $data);
            $data2 = $this->user_model->user_activities(65,'cma',$this->input->post('cma_id'),'cma','Suit Filling Info Updated('.$this->input->post('cma_id').')');
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
    function get_details_cma_authorization($auth_id,$cma_id)
    {
        if($auth_id!=0) //when request comes for case menagement grid athorization
        {
            $where = " AND a.id='".$auth_id."'";
        }
        else
        {
            $where = "";
        }
        if($cma_id!=''){
                $this->db
                ->select('DATE_FORMAT(c.ln_sent_date,"%d-%b-%y") AS ln_sent_date,a.au_serial,a.authorization_type,
                    DATE_FORMAT(c.ln_val_dt,"%d-%b-%y") AS ln_val_dt,c.final_ln,c.total_final_ln,c.brrower_name,
                    c.final_ln,l.name as lawyer,c.loan_ac,c.ac_name,s.name as ln_status,c.req_type,g.present_address as current_address,
                    u.name as plaintiff_name,u.pin as plaintiff_pin,f.name as functional_designation
                    ', FALSE)
                ->from("authorization a")
                ->join('cma as c', 'c.id=a.event_id', 'left')
                ->join('cma_guarantor as g', 'c.id=g.cma_id AND g.guarantor_type="M"', 'left')
                ->join('ref_lawyer as l', 'c.lawyer=l.id', 'left')
                ->join('ref_ln_status as s', 'c.ln_status=s.id', 'left')
                ->join('users_info as u', 'a.legal_user=u.id', 'left')
                ->join('ref_functional_designation as f', 'u.functional_designation_id=f.id', 'left')
                ->where("a.event_id='".$cma_id."' AND a.event_name='cma' AND a.sts<>0 $where", NULL, FALSE)
                ->order_by('a.id','DESC') //Getting The last authorization row for cma authorization
                ->limit(1);
            $data = $this->db->get()->row();
        return $data;
        }
        else{return NULL;}
    }
    function get_details_suit_authorization($id)
    {
        if($id!=''){
                $this->db
                    ->select('b.*,s.case_number,s.loan_ac,s.cif,s.ac_name,cr.borrower_name as brrower_name,cr.proprietor_address as current_address,
                        r.name as req_type,c.req_type as requisition_name,
                        DATE_FORMAT(b.sfa_dt,"%d-%b-%y") AS sfa_dt,
                        CONCAT(j5.name," (",j5.pin,")")as new_representive,
                        a.name as authorization_type_name,cn.name as case_name,
                        CONCAT(j4.name," (",j4.pin,")")as filling_plaintiff,
                        j4.name as plaintiff_name,j4.pin as plaintiff_pin,cr.prev_item,cr.new_item,
                        f.name as functional_designation,
                        CONCAT(j6.name," (",j6.pin,")")as sfa_by,IF(cr.prev_court IS NULL,court.name,court2.name) as court_name', FALSE)
                    ->from("authorization b")
                    ->join('change_request as cr', 'b.event_id=cr.id', 'left')
                    ->join('suit_filling_info as s', 'cr.suit_file_id=s.id', 'left')
                    ->join('ref_authorization_type as a', 'b.authorization_type=a.id', 'left')
                    ->join('ref_case_name as cn', 's.case_name=cn.id', 'left')
                    ->join('users_info as j4', 'cr.prev_item=j4.id', 'left')
                    ->join('ref_functional_designation as f', 'j4.functional_designation_id=f.id', 'left')
                    ->join('users_info as j5', 'cr.new_item=j5.id', 'left')
                    ->join('ref_court as court', 's.prest_court_name=court.id', 'left')
                    ->join('ref_court as court2', 'cr.prev_court=court2.id', 'left')
                    ->join('cma as c', 's.cma_id=c.id', 'left')
                    ->join('ref_req_type as r', 's.req_type=r.id', 'left')
                    ->join('users_info as j6', 'b.sfa_by=j6.id', 'left')
                    ->where("b.sts!=0 and b.id='".$id."'", NULL, FALSE)
                    ->limit(1);
                $data = $this->db->get()->row();
                //echo $this->db->last_query();
                return $data;
        }
        else{return NULL;}
    }
    function get_bail_money_details($id)
    {
        if($id!=''){
                $this->db
                ->select('d.*,DATE_FORMAT(d.deposit_date,"%d-%b-%y") AS deposit_date,
                    c.brrower_name,c.loan_ac,c.ac_name', FALSE)
                ->from("appeal_deposit d")
                ->join('cma as c', 'd.cma_id=c.id', 'left')
                ->where("d.id='".$id."'", NULL, FALSE)
                ->limit(1);
            $data = $this->db->get()->row();
        return $data;
        }
        else{return NULL;}
    }
    function get_suit_filling_details_by_id($id)
    {
        if($id!=''){
                $this->db
                ->select('b.case_number,b.case_claim_amount,j0.name as case_name,b.case_deal_officer as case_deal_officer_id,
                    b.prest_lawyer_name as prest_lawyer_id,b.prest_court_name as prest_court_id,
                    DATE_FORMAT(b.prev_date,"%d-%b-%y") AS prev_date,j1.name as case_sts_prev_dt,
                    j2.name as act_prev_date,DATE_FORMAT(b.next_date,"%d-%b-%y") AS next_date,
                    j3.name as case_sts_next_dt,b.remarks_next_date,j4.name as filling_plaintiff,
                    DATE_FORMAT(b.filling_date,"%d-%b-%y") AS filling_date,j5.name as present_plaintiff,
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
                ->join('users_info as j5', 'b.case_deal_officer=j5.id', 'left')
                ->join('users_info as j6', 'b.case_deal_officer=j6.id', 'left')
                ->join('ref_lawyer as j7', 'b.prev_lawyer_name=j7.id', 'left')
                ->join('ref_lawyer as j8', 'b.prest_lawyer_name=j8.id', 'left')
                ->join('ref_court as j9', 'b.prev_court_name=j9.id', 'left')
                ->join('ref_court as j10', 'b.prest_court_name=j10.id', 'left')
                ->join('users_info as j11', 'b.e_by=j11.id', 'left')
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
            WHERE j0.sts=1 AND j0.cma_id= ".$this->db->escape($id)." ORDER BY id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }

}
?>
