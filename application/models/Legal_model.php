<?php
class Legal_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Cma_process_model', '', TRUE);
	}

    function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        $i=0;
        $where2 = "b.life_cycle=17";
        if(check_group('2'))
        {
            $where2 .=" AND legal_checker_id='".$this->session->userdata['ast_user']['user_id']."'";
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
                else if($filterdatafield=='cif')
                {
                    $filterdatafield='b.cif';
                }
                else if($filterdatafield=='ac_name')
                {
                    $filterdatafield='j2.ac_name';
                }
                else if($filterdatafield=='status')
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
                else if($filterdatafield=='serial')
                {
                    $filterdatafield='j2.sl_no';
                }
                else if($filterdatafield=='unit_office_name')
                {
                    $filterdatafield='j10.name';
                }
                else if($filterdatafield=='e_dt')
                {
                    //$filterdatafield='b.e_dt';
                    $filterdatafield = "DATE_FORMAT(j2.e_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='stc_dt')
                {
                    //$filterdatafield='b.stc_dt';
                    $filterdatafield = "DATE_FORMAT(j2.stc_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='sth_dt')
                {
                    //$filterdatafield='b.stc_dt';
                    $filterdatafield = "DATE_FORMAT(j2.sth_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='v_dt')
                {
                    //$filterdatafield='b.stc_dt';
                    $filterdatafield = "DATE_FORMAT(j2.v_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='ln_expiry_dt')
                {
                    //$filterdatafield='b.stc_dt';
                    $filterdatafield = "DATE_FORMAT(b.ln_expiry_dt,'%d-%b-%y')";
                }
                else if($filterdatafield=='ln_serve_dt')
                {
                    //$filterdatafield='b.stc_dt';
                    $filterdatafield = "DATE_FORMAT(b.ln_serve_dt,'%d-%b-%y')";
                }
                else if($filterdatafield=='rec_dt')
                {
                    //$filterdatafield='b.rec_dt';
                    $filterdatafield = "DATE_FORMAT(j2.rec_dt,'%d-%b-%y %h:%i %p')";
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
                    $where .= " (j6.name LIKE '%".$filtervalue."%' OR j6.user_id LIKE '%".$filtervalue."%') ";
                }
                else if($filterdatafield =='sth_by')
                {
                    $where .= " (j4.name LIKE '%".$filtervalue."%' OR j4.user_id LIKE '%".$filtervalue."%') ";
                }
                else if($filterdatafield =='v_by')
                {
                    $where .= " (j5.name LIKE '%".$filtervalue."%' OR j5.user_id LIKE '%".$filtervalue."%') ";
                }
                else if($filterdatafield =='rec_by')
                {
                    $where .= " (j11.name LIKE '%".$filtervalue."%' OR j11.user_id LIKE '%".$filtervalue."%') ";
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
        ->select('b.*,b.legal_ack_by,b.legal_checker_id,j2.sl_no as serial,
            IF(b.auction_sts="17" OR b.auction_sts="40",CONCAT(j1.name," (",j12.user_id,")"),j1.name) as status,
            j7.name as region_name,j8.name as territory_name,
        j9.name as district_name,j10.name as unit_office_name,j2.ac_name,
        CONCAT(j3.name," (",j3.user_id,")")as e_by,
        CONCAT(j4.name," (",j4.user_id,")")as sth_by,
        CONCAT(j5.name," (",j5.user_id,")")as v_by,
        CONCAT(j6.name," (",j6.user_id,")")as stc_by,
        CONCAT(j11.name," (",j11.user_id,")")as rec_by,
        DATE_FORMAT(j2.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
        DATE_FORMAT(b.ln_expiry_dt,"%d-%b-%y") AS ln_expiry_dt,
        DATE_FORMAT(b.ln_serve_dt,"%d-%b-%y") AS ln_serve_dt,
        DATE_FORMAT(j2.stc_dt,"%d-%b-%y %h:%i %p") AS stc_dt,
        DATE_FORMAT(j2.rec_dt,"%d-%b-%y %h:%i %p") AS rec_dt,
        DATE_FORMAT(j2.sth_dt,"%d-%b-%y %h:%i %p") AS sth_dt,
        DATE_FORMAT(j2.v_dt,"%d-%b-%y %h:%i %p") AS v_dt
        ', FALSE)
            ->from("cma_auction b")
            ->join('cma as j2', 'b.cma_id=j2.id', 'left')
            ->join('users_info as j3', 'j2.e_by=j3.id', 'left')
            ->join('users_info as j4', 'j2.sth_by=j4.id', 'left')
            ->join('users_info as j5', 'j2.v_by=j5.id', 'left')
            ->join('users_info as j6', 'j2.stc_by=j6.id', 'left')
            ->join('users_info as j11', 'j2.rec_by=j11.id', 'left')
            ->join('ref_status as j1', 'b.auction_sts=j1.id', 'left')
            ->join('ref_region as j7', 'b.region=j7.id', 'left')
            ->join('ref_territory as j8', 'b.territory=j8.id', 'left')
            ->join('ref_district as j9', 'b.district=j9.id', 'left')
            ->join('ref_unit_office as j10', 'b.unit_office=j10.id', 'left')
            ->join('users_info as j12', 'b.legal_checker_id=j12.id', 'left')
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
    function get_info($id) // get data for edit
    {
        if($id!=''){
            $this->db
            ->select("j0.*", FALSE)
            ->from('cma_auction as j0')
            ->where("j0.id='".$id."'",NULL,FALSE)
            ->limit(1);
            return  $this->db->get()->row();
        }
        else{return NULL;}
    }
    function get_data($table){
        $this->db
            ->select('*')
            ->from($table);
            return  $this->db->get()->result();
    }
    function insert_get_id($table,$data){
        $this->load->database('default', TRUE);
        $this->db->insert($table, $data);
        $tmp = $this->db->insert_id();
        return $tmp;
    }
    function get_where($table, $where,$col=NULL,$order="ASC")
    {
        $this->db->select('*');
        $this->db->from($table);
        if($where != ''){
            $this->db->where($where);
        }
        if($col!='' && $order=''){
            $this->db->order_by($col,$order);
        }
        $res=$this->db->get();
        $result = $res->result();
        return $result;
    }
    function get_add_action_data($id)
    {
        $this->db
            ->select("b.*", FALSE)
            ->from("cma_facility_mortgage b")
            ->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function get_add_action_data_auction($id)
    {
        $this->db
            ->select("b.*", FALSE)
            ->from("cma_auction b")
            ->where("b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
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
            $file = $this->Common_model->get_file_name('cma_auction',$field_name,$path);
        }//Taking Old File
        else if (isset($_POST['hidden_'.$field_name.'_value']) && $_POST['hidden_'.$field_name.'_select']=='0') 
        {
            $file = $_POST['hidden_'.$field_name.'_value'];
        }//Taking Full New File
        else
        {
            $file = $this->Common_model->get_file_name('cma_auction',$field_name,$path);
        }
        return $file;
    }
    function delete_action()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($this->input->post('type')=='acknowledgement'){
            $pre_action_result=$this->Common_model->get_pre_action_data('cma_auction',$_POST['deleteEventId'],'40','auction_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $data = array('auction_sts' => '40', 'legal_ack_by'=> $this->session->userdata['ast_user']['user_id'], 'legal_ack_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('cma_auction', $data);
                $data2 = $this->user_model->user_activities(40,'auction',$this->input->post('cma_id'),'cma_auction','Legal Acknowledgement CMA Auction('.$this->input->post('deleteEventId').')');
            }
        }
        if($this->input->post('type')=='send_response'){
            $pre_action_result=$this->Common_model->get_pre_action_data('cma_auction',$_POST['deleteEventId'],'42','auction_sts');
            if (count($pre_action_result)>0) 
            {
                return 'taken';
            }
            else
            {
                $ln_scan_copy = $this->get_file_name('ln_scan_copy','cma_file/ln_scan_copy/');
                $data = array(
                    'auction_sts' => '42', 
                    'lawyer' => $this->input->post('lawyer'),
                    'ln_cost' => $this->input->post('ln_cost'),
                    'legal_response_by'=> $this->session->userdata['ast_user']['user_id'], 
                    'legal_response_dt'=>date('Y-m-d H:i:s'),
                    'ln_serve_dt' =>implode('-',array_reverse(explode('/',$this->input->post('ln_serve_dt')))),
                    'ln_expiry_dt' =>implode('-',array_reverse(explode('/',$this->input->post('ln_expiry_dt')))),
                    'ln_scan_copy' =>$ln_scan_copy
                    );
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('cma_auction', $data);
                $cma_data = $this->db->query("SELECT s.proposed_type,s.cif,s.loan_ac,s.ac_name,s.org_loan_ac,
                    s.ac_name,s.req_type,s.legal_region,s.id,s.territory,s.case_fill_dist,s.loan_segment
                 FROM cma s WHERE s.id='".$_POST['cma_id']."' LIMIT 1")->row();
                $cost_data = array(
                   'module_name' =>'suit_file',
                   'main_table_name' =>'cma',
                   'cma_id' =>$_POST['cma_id'],
                   'main_table_id' =>$_POST['cma_id'],
                   'proposed_type' =>$cma_data->proposed_type,
                   'loan_ac' =>$cma_data->loan_ac,
                   'cif' =>$cma_data->cif,
                   'org_loan_ac' =>$cma_data->org_loan_ac,
                   'ac_name' =>$cma_data->ac_name,
                   'req_type' =>$cma_data->req_type,
                   'region' =>$cma_data->legal_region,
                   'district' =>$cma_data->case_fill_dist,
                   'territory' =>$cma_data->territory,
                   'vendor_id' =>$this->input->post('lawyer'),
                   'vendor_type' =>1,
                   'activities_id' =>($cma_data->req_type==2)?33:29,
                   'loan_segment' =>$cma_data->loan_segment,
                   'txrn_dt' =>implode('-',array_reverse(explode('/',$this->input->post('ln_serve_dt')))),
                   'amount' =>$this->input->post('ln_cost')
                );
                $data3=$this->user_model->cost_details($cost_data);
                $data2 = $this->user_model->user_activities(42,'auction',$this->input->post('cma_id'),'cma_auction','Legal Response CMA Auction('.$this->input->post('deleteEventId').')');
            
                $application_data = $this->db->query("SELECT ack_by FROM cma_auction where id='".$_POST['deleteEventId']."'")->row();
                $subject = "Legal Notice Date Expaired on Date: ".implode('-',array_reverse(explode('/',$this->input->post('ln_expiry_dt')))).", A/C Name: ".$cma_data->ac_name;
                $url = base_url()."cma_process/details";
                $data2 = $this->Common_model->push_notification_data($subject,$url,'cma',$_POST['cma_id'],implode('-',array_reverse(explode('/',$this->input->post('ln_expiry_dt')))),'',$application_data->ack_by,'1');
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

}

?>