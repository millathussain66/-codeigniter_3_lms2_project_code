<?php
class Authorization_request_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
    }



    function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        $i=0;
        //$where2 = "b.sts!='0' and b.life_cycle IN(4)";
        $where2 ="j0.sts!='0' AND j0.change_type IN(2)";
        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('2')) //For Legal Maker
        {
            array_push($condition_array,"j0.e_by='".$this->session->userdata['ast_user']['user_id']."'");
        }
        if (check_group('1')) //For Legal Checker
        {
            array_push($condition_array,multi_selected_query_maker_2($this->session->userdata['ast_user']['legal_region'],'j2.legal_region'));
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
                else if($filterdatafield=='request_type_name')
                {
                    $filterdatafield='rq.name';
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
    ->select('SQL_CALC_FOUND_ROWS j0.*,rq.name as req_type_name,a.id as auth_id,j0.e_by as e_by_id,b.cma_id as cma_id,b.loan_ac,b.ac_name,b.id as suit_file_id,
        j1.name as status,
        CONCAT(j2.name," (",j2.user_id,")")as e_by,
        CONCAT(j3.name," (",j3.user_id,")")as u_by,
        DATE_FORMAT(j0.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
        t.name as authorization_type_name,
        DATE_FORMAT(j0.u_dt,"%d-%b-%y %h:%i %p") AS u_dt
        ', FALSE)
            ->from("change_request j0")
            ->join('authorization as a', 'a.event_id=j0.id AND a.event_name="suit_file" AND a.sts<>0', 'left')
            ->join('suit_filling_info as b', 'b.id=j0.suit_file_id', 'left')
            ->join('ref_req_type as rq', 'b.req_type=rq.id', 'left')
            ->join('ref_status as j1', 'j0.sts=j1.id', 'left')
            ->join('ref_authorization_type as t', 'j0.authorization_type=t.id', 'left')
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
    function get_expense_data($id)
    {
        if($id!=''){
            $str=" SELECT j0.*
            FROM expenses as j0
            WHERE j0.sts=1 AND j0.event_id= ".$this->db->escape($id)." ORDER BY id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_dropdown_data($district_id,$dropdown_name)
    {
        if($district_id!='' && $dropdown_name=='d_officer'){
            $str=" SELECT j0.pin,j0.id,j0.name
            FROM users_info as j0
            WHERE j0.verify_status = '0' 
            AND j0.block_status = '0'
            AND j0.admin_status <> '2' AND FIND_IN_SET($district_id,j0.legal_district) ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else if($district_id!='' && $dropdown_name=='lawyer'){
            $str=" SELECT j0.code,j0.id,j0.name
            FROM ref_lawyer as j0
            WHERE 
            j0.data_status = '1' AND j0.district= ".$this->db->escape($district_id)." ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else if($district_id!='' && $dropdown_name=='staff'){
            $str=" SELECT j0.pin,j0.id,j0.name
            FROM users_info as j0
            WHERE 
            j0.verify_status = '0' 
            AND j0.block_status = '0'
            AND j0.admin_status <> '2' AND FIND_IN_SET($district_id,j0.legal_district) ORDER BY j0.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_data_by_pin($pin)
    { 
        $where="b.pin='".$pin."' and b.lock_status<>1 and b.block_status<>1";
        $this->db->select('b.id', FALSE)
            ->from("users_info b")
            ->where($where)
            ->order_by('b.id','DESC')
            ->limit(1);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->row();
        } else {
            return array();
        }
    }
    function get_add_action_data($id)
    {
        $this->db
            ->select("b.*,a.id as auth_id,s.loan_ac,s.cif", FALSE)
            ->from("change_request b")
            ->join('suit_filling_info as s', 'b.suit_file_id=s.id', 'left')
            ->join('authorization as a', 'b.id=a.event_id AND a.event_name="suit_file" and a.sts<>0', 'left')
            ->where("b.sts!=0 and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_details($id)
    {
        $this->db
            ->select('b.*,s.case_number,s.loan_ac,s.ac_name,b.borrower_name as brrower_name,b.proprietor_address as current_address,
                DATE_FORMAT(b.change_date,"%d-%b-%y") AS change_date,r.name as req_type,c.req_type as requisition_name,
                DATE_FORMAT(b.e_dt,"%d-%b-%y") AS e_dt,DATE_FORMAT(b.u_dt,"%d-%b-%y") AS u_dt,
                CONCAT(j5.name," (",j5.pin,")")as new_representive,
                a.name as authorization_type_name,cn.name as case_name,
                CONCAT(j4.name," (",j4.pin,")")as filling_plaintiff,
                CONCAT(j6.name," (",j6.pin,")")as e_by,court.name as court_name,
                CONCAT(j7.name," (",j7.pin,")")as u_by', FALSE)
            ->from("change_request b")
            ->join('ref_authorization_type as a', 'b.authorization_type=a.id', 'left')
            ->join('suit_filling_info as s', 'b.suit_file_id=s.id', 'left')
            ->join('ref_case_name as cn', 's.case_name=cn.id', 'left')
            ->join('users_info as j4', 'b.prev_item=j4.id', 'left')
            ->join('users_info as j5', 'b.new_item=j5.id', 'left')
            ->join('ref_court as court', 's.prest_court_name=court.id', 'left')
            ->join('cma as c', 's.cma_id=c.id', 'left')
            ->join('ref_req_type as r', 's.req_type=r.id', 'left')
            ->join('users_info as j6', 'b.e_by=j6.id', 'left')
            ->join('users_info as j7', 'b.u_by=j7.id', 'left')
            ->where("b.sts!=0 and b.id='".$id."' AND b.change_type=2", NULL, FALSE)
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
        if($this->input->post('type')=='delete'){
            $pre_action_result=$this->Common_model->get_pre_action_data('change_request',$_POST['deleteEventId'],'0','sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('sts' => 0,'d_reason'=>$this->input->post('comments'),'d_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('change_request', $data);
                $data2 = $this->user_model->user_activities(67,'suit_file',$this->input->post('deleteEventId'),'change_request','Suit File Authorization Request Delete('.$this->input->post('deleteEventId').')',$_POST['comments']);
            }
            $id = $_POST['deleteEventId'];
        }
        if($this->input->post('type')=='sendtochecker'){
            $pre_action_result=$this->Common_model->get_pre_action_data('change_request',$_POST['deleteEventId'],'66','sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $str="SELECT  j0.authorization_type
                             FROM change_request j0
                         WHERE j0.sts <>0 AND j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                
                $application_data=$this->db->query($str)->row();
                $sts = 66;
                $str = 'Authorization Request Send For Authorization';
                $data2 = array('sts' => $sts);
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('change_request', $data2);
                $auth_row = $this->db->query("SELECT c.y_flag_approval_file,c.approver_name,c.approver_pin,c.y_flag
                    FROM change_request as c 
                    WHERE c.id='".$_POST['deleteEventId']."' LIMIT 1")->row();
                $data4 = array('y_flag_approval_file' => $auth_row->y_flag_approval_file,'approver_name' => $auth_row->approver_name,'approver_pin' => $auth_row->approver_pin,'y_flag' => $auth_row->y_flag,'event_name' =>'suit_file','authorization_type' => $application_data->authorization_type,'event_id'=> $_POST['deleteEventId'],'auth_sts' => 66,'sfa_by'=> $this->session->userdata['ast_user']['user_id'], 'sfa_dt'=>date('Y-m-d H:i:s'));
                $this->db->insert('authorization', $data4);
                $data3 = $this->user_model->user_activities($sts,'suit_file',$this->input->post('deleteEventId'),'change_request',$str.'('.$this->input->post('deleteEventId').')');
                
                $subject = "Need Authorization copy for filing or others purpose";
                $url = base_url()."authorization_request/details";
                $data2 = $this->Common_model->push_notification_data($subject,$url,'authorization_request',$this->input->post('deleteEventId'),date('Y-m-d'),'','all','1','10');
            }
            $id = $_POST['deleteEventId'];
            
        }
        if($this->input->post('type')=='return'){
            $pre_action_result=$this->Common_model->get_pre_action_data('change_request',$_POST['deleteEventId'],'74','sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('sts' => 74,'super_r_reason'=>$this->input->post('reason'),'super_r_by'=> $this->session->userdata['ast_user']['user_id'], 'super_r_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                 $this->db->update('change_request', $data);
                $data2 = $this->user_model->user_activities(74,'suit_file',$this->input->post('deleteEventId'),'change_request','Authorization Request Retrun By supervisor('.$this->input->post('deleteEventId').')',$_POST['reason']);
            }
            $id = $_POST['deleteEventId'];
            
        }
        if($this->input->post('type')=='bulk_create'){
            for ($i=1;$i<= $_POST['total_row'];$i++) 
            { 
                if($_POST['event_id_'.$i]!='')
                {
                    $data = array(
                        'suit_file_id' =>$_POST['event_id_'.$i],
                        'authorization_type' =>$_POST['auth_type_id_'.$i],
                        'new_item' =>$_POST['user_id_'.$i],
                        'prev_item' =>$_POST['user_id2_'.$i],
                        'proprietor_address' =>$_POST['address_'.$i],
                        'borrower_name' =>$_POST['borrower_name_'.$i],
                        'change_type' =>2,
                        'change_date' =>date('Y-m-d H:i:s')
                    );

                     // if ($_POST['auth_type_id_'.$i]==4 || $_POST['auth_type_id_'.$i]==9) {
                     //     $str="SELECT  j0.filling_plaintiff
                     //                     FROM suit_filling_info j0
                     //                 WHERE j0.sts <>0 AND j0.id= '".$_POST['event_id_'.$i]."' LIMIT 1";
                            
                     //        $application_data=$this->db->query($str)->row();

                     //     $data['prev_item'] = $application_data->filling_plaintiff;
                     // }
                    $data['e_by'] = $this->session->userdata['ast_user']['user_id'];
                    $data['e_dt'] = date('Y-m-d H:i:s');
                    $this->db->insert('change_request', $data);
                    $insert_idss = $this->db->insert_id();
                    $data2 = $this->user_model->user_activities(39,'suit_file',$insert_idss,'change_request','Add Authorization Request('.$insert_idss.')');
                }
                
            }
            $id = $insert_idss;
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
    function get_bulk_data($operation)
    {
        $where2 = "a.sts!='0'";
        if ($operation=='apv') 
        {
            $where2.=" AND a.auth_sts = '66' AND a.event_name='suit_file'";
        }
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_from')!=0 && ($this->input->post('req_dt_to') == '' || $this->input->post('req_dt_to')==0)) 
        {$where2.=" AND DATE(a.sfa_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
        if($this->input->post('req_dt_from') != '' && $this->input->post('rec_dt_from')!=0 && $this->input->post('req_dt_to') != '' && $this->input->post('req_dt_to')!=0) 
        {$where2.=" AND DATE(a.sfa_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(a.sfa_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}

        $this->db
        ->select('a.*,t.name as type,
        j0.name as status,
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
            ->where($where2)
            ->order_by('a.id','DESC');
        $q=$this->db->get();
        return $q->result();
    }
    function get_bulk_data_sfa($operation)
    {
        $where2 = "a.sts!='0' AND a.change_type IN(2)";
        //$where2.=" and a.e_by='".$this->session->userdata['ast_user']['user_id']."'";
        if ($operation=='sfa') 
        {
            $where2.=" AND a.sts IN(35,39,69,80)";
        }
        if($this->input->post('req_dt_from') != '' && $this->input->post('req_dt_from')!=0 && ($this->input->post('req_dt_to') == '' || $this->input->post('req_dt_to')==0)) 
        {$where2.=" AND DATE(a.e_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."'";}
        if($this->input->post('req_dt_from') != '' && $this->input->post('rec_dt_from')!=0 && $this->input->post('req_dt_to') != '' && $this->input->post('req_dt_to')!=0) 
        {$where2.=" AND DATE(a.e_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_from')))))."' AND DATE(a.e_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->post('req_dt_to')))))."'";}

        $this->db
        ->select('a.*,t.name as type,"" as event_id,"suit_file" as event_name,
        j0.name as status,
        CONCAT(j1.name," (",j1.user_id,")")as sfa_by,
        DATE_FORMAT(a.e_dt,"%d-%b-%y %h:%i %p") AS sfa_dt
        ', FALSE)
           ->from("change_request a")
            ->join('ref_authorization_type as t', 'a.authorization_type=t.id', 'left')
            ->join('ref_status as j0', 'a.sts=j0.id', 'left')
            ->join('users_info as j1', 'a.e_by=j1.id', 'left')
            ->where($where2)
            ->order_by('a.id','DESC');
        $q=$this->db->get();
        return $q->result();
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
                    //For Suit Authorization Operation's
                    if ($this->input->post('event_name_'.$i)=='suit_file') {
                        $pre_action_result=$this->Common_model->get_pre_action_data('authorization',$_POST['id_'.$i],'67','auth_sts');
                        if (count($pre_action_result)>0) 
                        {
                            return 'taken';
                        }
                        else
                        {
                            $data = array('sts' => 78);
                            $this->db->where('id', $_POST['event_id_'.$i]);
                            $this->db->update('change_request', $data);
                            $data3=array('auth_sts' => 78,'auth_by'=> $this->session->userdata['ast_user']['user_id'], 'auth_dt'=>date('Y-m-d H:i:s'));
                            $this->db->where('id', $_POST['id_'.$i]);
                            $this->db->update('authorization', $data3);
                            $data2 = $this->user_model->user_activities(78,'authorization',$this->input->post('event_id_'.$i),'authorization','Change Request Authorized('.$this->input->post('id_'.$i).')');
                            
                            // $subject = "Need Authorization copy for filing or others purpose";
                            // $url = base_url()."authorization_request/details";
                            // $data2 = $this->Common_model->push_notification_data($subject,$url,'authorization_request',$this->input->post('event_id_'.$i),date('Y-m-d'),'','all','1','10');
                        }
                    }
                }
                
                
            }
        }
        if($this->input->post('operation')=='sfa'){

            for ($i=1;$i<= $_POST['event_counter'];$i++) 
            { 
                if($_POST['event_delete_'.$i]!=1)
                {
                    $pre_action_result=$this->Common_model->get_pre_action_data('change_request',$_POST['id_'.$i],'66','sts');
                    if (count($pre_action_result)>0) 
                    {
                        return 'taken';
                    }
                    else
                    {
                        $str="SELECT  j0.authorization_type
                                     FROM change_request j0
                                 WHERE j0.sts <>0 AND j0.id= '".$_POST['id_'.$i]."' LIMIT 1";
                        
                        $application_data=$this->db->query($str)->row();
                        $sts = 66;
                        $str = 'Authorization Request Send For Authorization';
                        $data2 = array('sts' => $sts);
                        $this->db->where('id', $_POST['id_'.$i]);
                        $this->db->update('change_request', $data2);
                        $auth_row = $this->db->query("SELECT c.y_flag_approval_file,c.approver_name,c.approver_pin,c.y_flag
                            FROM change_request as c 
                            WHERE c.id='".$_POST['id_'.$i]."' LIMIT 1")->row();
                        $data4 = array('y_flag_approval_file' => $auth_row->y_flag_approval_file,'approver_name' => $auth_row->approver_name,'approver_pin' => $auth_row->approver_pin,'y_flag' => $auth_row->y_flag,'event_name' =>'suit_file','authorization_type' => $application_data->authorization_type,'event_id'=> $_POST['id_'.$i],'auth_sts' => 66,'sfa_by'=> $this->session->userdata['ast_user']['user_id'], 'sfa_dt'=>date('Y-m-d H:i:s'));
                        $this->db->insert('authorization', $data4);
                        $data3 = $this->user_model->user_activities($sts,'suit_file',$_POST['id_'.$i],'change_request',$str.'('.$_POST['id_'.$i].')');
                        
                        $subject = "Need Authorization copy for filing or others purpose";
                        $url = base_url()."authorization_request/details";
                        $data2 = $this->Common_model->push_notification_data($subject,$url,'authorization_request',$_POST['id_'.$i],date('Y-m-d'),'','all','1','10');
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
    function give_authorization()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        if($this->input->post('event_name')=='suit_file')
        {
            if($this->input->post('type')=='approve'){
                $pre_action_result=$this->Common_model->get_pre_action_data('authorization',$_POST['deleteEventId'],'78,80','auth_sts');
                
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

                    $data = array('sts' => 78);
                    $this->db->where('id', $_POST['EventId']);
                    $this->db->update('change_request', $data);
                    $data3=array('auth_sts' => 78,'auth_by'=> $this->session->userdata['ast_user']['user_id'], 'auth_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['deleteEventId']);
                    $this->db->update('authorization', $data3);
                    $data2 = $this->user_model->user_activities(78,'authorization',$this->input->post('EventId'),'authorization','Authorization Request Authorized('.$this->input->post('deleteEventId').')');
                }
                
            }
            if($this->input->post('type')=='return'){
                $pre_action_result=$this->Common_model->get_pre_action_data('authorization',$_POST['deleteEventId'],'78,80','auth_sts');
                if (count($pre_action_result)>0) 
                {
                    return 'taken';
                }
                else
                {
                    $data3=array('auth_sts' => 80,'sts' => 0,'reason'=>$this->input->post('reason'),'return_by'=> $this->session->userdata['ast_user']['user_id'], 'return_dt'=>date('Y-m-d H:i:s'));
                    $this->db->where('id', $_POST['deleteEventId']);
                    $this->db->update('authorization', $data3);
                    $data = array('sts' => 80);
                    $this->db->where('id', $_POST['EventId']);
                    $this->db->update('change_request', $data);
                    $data2 = $this->user_model->user_activities(80,'authorization',$this->input->post('EventId'),'authorization','Suit Filing Authorization Return('.$this->input->post('deleteEventId').')',$_POST['reason']);
                }
                
            }
            if($this->input->post('type')=='hold'){
                $data3=array('auth_sts' => 79,'reason'=>$this->input->post('reason'),'hold_by'=> $this->session->userdata['ast_user']['user_id'], 'hold_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('authorization', $data3);
                $data = array('sts' => 79);
                $this->db->where('id', $_POST['EventId']);
                $this->db->update('change_request', $data);
                $data2 = $this->user_model->user_activities(79,'authorization',$this->input->post('EventId'),'authorization','Suit Filing Authorization Hold('.$this->input->post('deleteEventId').')',$_POST['reason']);
                
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
    function add_edit()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $y_flag_approval_file = $this->get_file_name('y_flag_approval_file','cma_file/y_flag_approval_file/');
         $data = array(
                'suit_file_id' =>$this->security->xss_clean( $this->input->post('hidden_suit_id')),
                'authorization_type' =>$this->security->xss_clean( $this->input->post('authorization_type')),
                'new_item' =>$this->security->xss_clean( $this->input->post('new_representive')),
                'prev_item' =>$this->security->xss_clean( $this->input->post('pre_representive')),
                'prev_court' =>$this->security->xss_clean( $this->input->post('court')),
                'y_flag' =>$this->security->xss_clean( $this->input->post('hidden_y_flag')),
                'approver_name' =>$this->security->xss_clean( $this->input->post('approver_name')),
                'approver_pin' =>$this->security->xss_clean( $this->input->post('approver_pin')),
                'proprietor_address' =>$this->security->xss_clean( $this->input->post('proprietor_address')),
                'borrower_name' =>$this->security->xss_clean( $this->input->post('borrower_name')),
                'change_type' =>2,
                'y_flag_approval_file' =>$y_flag_approval_file,
                'change_date' =>date('Y-m-d H:i:s'),
                'change_reason' =>$this->security->xss_clean( $this->input->post('remarks'))
            );

         // if ($this->security->xss_clean( $this->input->post('authorization_type'))==4 || $this->security->xss_clean( $this->input->post('authorization_type'))==9) {
         //     $str="SELECT  j0.case_deal_officer
         //                     FROM suit_filling_info j0
         //                 WHERE j0.sts <>0 AND j0.id= '".$this->input->post('hidden_suit_id')."' LIMIT 1";
                
         //        $application_data=$this->db->query($str)->row();

         //     $data['prev_item'] = $application_data->case_deal_officer;
         // }
        //Add Action
        if ($this->input->post('add_edit')=='add') 
        {
            $data['e_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['e_dt'] = date('Y-m-d H:i:s');
            $this->db->insert('change_request', $data);
            $insert_idss = $this->db->insert_id();
            $data2 = $this->user_model->user_activities(39,'suit_file',$insert_idss,'change_request','Add Authorization Request('.$insert_idss.')');
        }
        else //For Update 
        {
            $edit_id = $this->input->post('edit_id');
            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $edit_id);
            $this->db->update('change_request', $data);
            $insert_idss = $edit_id;
            $data2 = $this->user_model->user_activities(35,'suit_file',$insert_idss,'change_request','Update Authorization Request('.$insert_idss.')');
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
    function get_r_history($id,$type=Null) // get data for edit
    {
        if($id!=''){
            if ($type=='life_cycle') {
                $where="AND(r.activities_id=39 || r.activities_id=35 || r.activities_id=66 || r.activities_id=67 || r.activities_id=68 || r.activities_id=69 || r.activities_id=70 || r.activities_id=71 || r.activities_id=73 || r.activities_id=74)";
            }
            else
            {
                $where="";
            }
            $str=" SELECT r.description_activities as oprs_descriptions,r.oprs_reason,s.name as oprs_sts,DATE_FORMAT(r.activities_datetime,'%d-%b-%y %h:%i %p') AS oprs_dt,CONCAT(u.name,' (',u.user_id,')') as r_by
            FROM user_activities_history as r
            LEFT OUTER JOIN users_info u ON u.id=r.activities_by
            LEFT OUTER JOIN ref_status s ON s.id=r.activities_id
            WHERE r.table_row_id= ".$id." AND (r.section_name='suit_file' OR r.section_name='authorization')  ".$where."  ORDER BY r.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }

}
?>
