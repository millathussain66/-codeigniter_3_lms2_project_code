<?php
class Edit_suit_file_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
    }

    function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        $i=0;
        $where2 = "b.sts!='0'";
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
    function add_edit_suit_filling_after_verify()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        $arji_copy = $this->get_file_name('arji_copy','cma_file/arji_copy/');
        $data = array(
            'arji_copy' =>$arji_copy,
            'case_number' =>$this->security->xss_clean( $this->input->post('case_number')),
            'case_claim_amount' =>$this->security->xss_clean( $this->input->post('case_claim_amount')),
            'judge_name' =>$this->security->xss_clean( $this->input->post('judge_name')),
            'judge_phone' =>$this->security->xss_clean( $this->input->post('judge_phone')),
            'prev_date' =>implode('-',array_reverse(explode('/',$this->input->post('prev_date')))),
            'case_sts_prev_dt' =>$this->security->xss_clean( $this->input->post('case_sts_prev_dt')),
            'filling_plaintiff' =>$this->security->xss_clean( $this->input->post('filling_plaintiff')),
            'next_dt_sts' =>$this->security->xss_clean( $this->input->post('next_dt_sts_value')),
            'not_available_sts' =>$this->security->xss_clean( $this->input->post('not_available_sts_value')),
            'case_sts_next_dt' =>$this->security->xss_clean( $this->input->post('case_sts_next_dt')),
            'remarks_next_date' =>$this->security->xss_clean( $this->input->post('remarks_next_date')),
            'filling_date' =>implode('-',array_reverse(explode('/',$this->input->post('filling_date')))),
            'case_deal_officer' =>$this->security->xss_clean( $this->input->post('case_deal_officer')),
            'prest_lawyer_name' =>$this->security->xss_clean( $this->input->post('prest_lawyer_name')),
            'anytime_edit_sts' =>1,
            'final_remarks' =>$this->security->xss_clean( $this->input->post('final_remarks')),
            'prest_court_name' =>$this->security->xss_clean( $this->input->post('prest_court_name')),
            
            'region' =>$this->security->xss_clean( $this->input->post('region')),
            'territory' =>$this->security->xss_clean( $this->input->post('territory')),
            'cma_district' =>$this->security->xss_clean( $this->input->post('cma_district')),
            'loan_segment' =>$this->security->xss_clean( $this->input->post('loan_segment')),
            'legal_region' =>$this->security->xss_clean( $this->input->post('legal_region')),
            'district' =>$this->security->xss_clean( $this->input->post('district')),
            'req_type' =>$this->security->xss_clean( $this->input->post('type_of_case')),
            'case_name' =>$this->security->xss_clean( $this->input->post('type_of_case_name'))
        );


        if($_POST['hidden_cma_id']!="" || !empty($_POST['hidden_cma_id'] || $_POST['hidden_cma_id']!='0')){

            $cma_data = array(
                'region' =>$this->security->xss_clean( $this->input->post('region')),
                'territory' =>$this->security->xss_clean( $this->input->post('territory')),
                'district' =>$this->security->xss_clean( $this->input->post('cma_district')),
                'loan_segment' =>$this->security->xss_clean( $this->input->post('loan_segment')),
                'legal_region' =>$this->security->xss_clean( $this->input->post('legal_region')),
                'case_fill_dist' =>$this->security->xss_clean( $this->input->post('district')),
            );

            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $_POST['hidden_cma_id']);
            $this->db->update('cma', $cma_data);



        }









        if ($_POST['next_dt_sts_value']==1) {
            $data['next_date'] =implode('-',array_reverse(explode('/',$this->input->post('next_date'))));
        }
        else
        {
            $sys_config= $this->User_info_model->upr_config_row();
            if($this->security->xss_clean( $this->input->post('not_available_sts_value'))==1)
            {
                $data['next_date'] = $sys_config->not_available_text;
            }
            else
            {
                $data['next_date'] = $sys_config->next_dt_text;
            }
        }
        if($this->security->xss_clean( $this->input->post('final_remarks'))==2) //When case withdrawn
        {
            $data['suit_sts'] = 76;
            $data['ac_close_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['ac_close_dt'] = date('Y-m-d H:i:s');
        }
        else
        {
            $data['suit_sts'] = 75;
            $data['ac_close_by'] = "";
            $data['ac_close_dt'] = "";
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
                    'req_type' =>$this->security->xss_clean( $this->input->post('type_of_case')),
                    'case_number' =>$this->security->xss_clean( $this->input->post('case_number'))
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
                    'req_type' =>$this->security->xss_clean( $this->input->post('type_of_case')),
                    'case_number' =>$this->security->xss_clean( $this->input->post('case_number'))
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
}
?>
