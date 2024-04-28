<?php
class Bill_data_edit_model extends CI_Model {

     function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
    }

    function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
        
    
            $i=0;
            $where2 = "c.vendor_type='1' AND (c.bill_id='0' OR c.bill_id IS NULL)";

            if($this->input->get('req_type')!='') 
            {$where2.=" AND c.vendor_id = '".trim($this->input->get('req_type'))."'";}

            if($this->input->get('proposed_type')!='') 
            {$where2.=" AND c.proposed_type = '".trim($this->input->get('proposed_type'))."'";}

            if($this->input->get('case_number')!='') 
            {$where2.=" AND c.case_number = '".trim($this->input->get('case_number'))."'";}

            if($this->input->get('loan_ac')!='' && $this->input->get('proposed_type')!='') 
            {
                if ($this->input->get('proposed_type')=='Loan') {
                    $where2.= " AND c.loan_ac='".$this->input->get('loan_ac')."'";
                }else if($this->input->get('proposed_type')=='Card')
                {
                    $where2.= " AND c.org_loan_ac = '".$this->Common_model->stringEncryption('encrypt',$this->input->get('hidden_loan_ac'))."'";
                }
            }

            if($this->input->get('txrn_dt_from') != '' && $this->input->get('txrn_dt_from')!=0 && ($this->input->get('txrn_dt_to') == '' || $this->input->get('txrn_dt_to')==0)) 
            {$where2.=" AND DATE(c.txrn_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_from')))))."'";}
      
            if($this->input->get('txrn_dt_from') != '' && $this->input->get('txrn_dt_from')!=0 && $this->input->get('txrn_dt_to') != '' && $this->input->get('txrn_dt_to')!=0) 
            {$where2.=" AND DATE(c.txrn_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_from')))))."' AND DATE(c.txrn_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_to')))))."'";}
    


            if (isset($filterscount) && $filterscount > 0)
            {
                $where = "(";

                $tmpdatafield = "";
                $tmpfilteroperator = "";
                for ($i=0; $i < $filterscount; $i++)
                {

                    // get the filter's value.
                    $filtervalue = $this->input->get('filtervalue'.$i);
                    // get the filter's condition.
                    $filtercondition = $this->input->get('filtercondition'.$i);
                    // get the filter's column.
                    $filterdatafield = $this->input->get('filterdatafield'.$i);
                    // get the filter's operator.
                    $filteroperator = $this->input->get('filteroperator'.$i);

                    if($filterdatafield=='proposed_type')
                    {
                        $filterdatafield='c.proposed_type';
                    }
                    else if($filterdatafield=='loan_ac')
                    {
                        $filterdatafield='c.loan_ac';
                    }
                    else if($filterdatafield=='case_number')
                    {
                        $filterdatafield='c.case_number';
                    }

                    else if($filterdatafield=='lawyer_name')
                    {
                        $filterdatafield='l.name';
                    }
                    else if($filterdatafield=='ac_name')
                    {
                        $filterdatafield='c.ac_name';
                    }

                    else if($filterdatafield=='region')
                    {
                        $filterdatafield='lr.name';
                    }
                    else if($filterdatafield=='district')
                    {
                        $filterdatafield='ld.name';
                    }

                    else if($filterdatafield=='amount')
                    {
                        $filterdatafield='c.amount';
                    }
                    else if($filterdatafield=='txrn_dt')
                    {
                        $filterdatafield = "DATE_FORMAT(c.txrn_dt,'%d-%b-%y %h:%i %p')";
                    }
                    else if($filterdatafield=='cif')
                    {
                        $filterdatafield='c.cif';
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
                $sortdatafield="c.id";
                $sortorder = "DESC";                
            }

            $this->db
            ->select('SQL_CALC_FOUND_ROWS c.*,c.vendor_name,c.cif,c.case_number,c.proposed_type,c.loan_ac,c.ac_name,c.amount,
                    l.name as lawyer_name, 
                    lr.name as region, 
                    ld.name as district, 
                    DATE_FORMAT(c.txrn_dt,"%d-%b-%y") AS txrn_dt
                    ', FALSE)
                    ->from("cost_details c")
                    ->join('ref_lawyer l', 'l.id=c.vendor_id', 'left')
                    ->join('ref_legal_region lr', 'lr.id=c.region', 'left')
                    ->join('ref_legal_district ld', 'ld.id=c.district', 'left')
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

    function get_edit_info($id){
	 
		if ($id != '') {
			$this->db->select('c.case_number,c.paper_bill_vendor_type,c.region,c.district,c.vendor_id,c.amount,
            DATE_FORMAT(c.txrn_dt,"%d/%m/%Y") as txrn_dt
            ', FALSE)
				->from("cost_details c")
				->where("c.id='" . $id . "'", NULL, FALSE)
				->limit(1);
			$q = $this->db->get();
			return $q->row();
		} else {
			return 'Data Not Found.';
		}
    }
    
    function edit_action()
    {

        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        $edit_row = $this->input->post('edit_row');

        $data = array(
            'case_number' =>$this->security->xss_clean( $this->input->post('case_number')),
            'region' =>$this->security->xss_clean( $this->input->post('legal_region')),
            'district' =>$this->security->xss_clean( $this->input->post('legal_district')),
            'amount' =>$this->security->xss_clean( $this->input->post('amount')),
            'txrn_dt' => implode('-', array_reverse(explode('/', $this->input->post('txrn_dt')))),
        );

        $row = $this->db->query('SELECT bill_id FROM cost_details WHERE id='.$edit_row)->row();

        if(empty($row->bill_id) || $row->bill_id=='0' || $row->bill_id ==NULL){

            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $edit_row);
            $this->db->update('cost_details', $data);
            $insert_idss = $edit_row;

           $this->user_model->user_activities(2,'cost_details',$this->input->post('edit_row'),'cost_details','Bill Data Edited After Verify('.$this->input->post('edit_row').')');

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


        }else{
            $insert_idss = 404;
            return $insert_idss;
        }

    }

    function edit_action_lawyer_bill()
    {

        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        $edit_row = $this->input->post('edit_row');

        $data = array(
            'vendor_id' =>$this->security->xss_clean( $this->input->post('lawyer')),
            'case_number' =>$this->security->xss_clean( $this->input->post('case_number')),
            'region' =>$this->security->xss_clean( $this->input->post('legal_region')),
            'district' =>$this->security->xss_clean( $this->input->post('legal_district')),
            'amount' =>$this->security->xss_clean( $this->input->post('amount')),
            'txrn_dt' => implode('-', array_reverse(explode('/', $this->input->post('txrn_dt')))),
        );

        $row = $this->db->query('SELECT bill_id FROM cost_details WHERE id='.$edit_row)->row();

        if(empty($row->bill_id) || $row->bill_id=='0' || $row->bill_id ==NULL){

            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $edit_row);
            $this->db->update('cost_details', $data);
            $insert_idss = $edit_row;

           $this->user_model->user_activities(2,'cost_details',$this->input->post('edit_row'),'cost_details','Bill Data Edited After Verify('.$this->input->post('edit_row').')');

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


        }else{
            $insert_idss = 404;
            return $insert_idss;
        }

    }

    function edit_action_paper()
    {

        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        $edit_row = $this->input->post('edit_row');

        $data = array(
            'vendor_id' =>$this->security->xss_clean( $this->input->post('lawyer')),
            'case_number' =>$this->security->xss_clean( $this->input->post('case_number')),
            'region' =>$this->security->xss_clean( $this->input->post('legal_region')),
            'district' =>$this->security->xss_clean( $this->input->post('legal_district')),
            'amount' =>$this->security->xss_clean( $this->input->post('amount')),
            'txrn_dt' => implode('-', array_reverse(explode('/', $this->input->post('txrn_dt')))),
        );

        $row = $this->db->query('SELECT bill_id FROM cost_details WHERE id='.$edit_row)->row();

        if(empty($row->bill_id) || $row->bill_id=='0' || $row->bill_id ==NULL){

            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $edit_row);
            $this->db->update('cost_details', $data);
            $insert_idss = $edit_row;

           $this->user_model->user_activities(2,'cost_details',$this->input->post('edit_row'),'cost_details','Bill Data Edited After Verify('.$this->input->post('edit_row').')');

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


        }else{
            $insert_idss = 404;
            return $insert_idss;
        }

    }

    function get_lawyer_bill_details($id)
    {
        $this->db
            ->select('a.case_number,a.amount,a.proposed_type,a.loan_ac,a.cif,a.ac_name,l.name as lawyer_name,a.vendor_name,
            lr.name as region, 
            ld.name as district, 
            DATE_FORMAT(a.txrn_dt,"%d-%b-%y %h:%i %p") AS txrn_dt,
            DATE_FORMAT(a.u_dt,"%d-%b-%y %h:%i %p") AS u_dt
            
            ', FALSE)
            ->from("cost_details a")
            ->join('ref_lawyer l', 'l.id=a.vendor_id', 'left')
            ->join('ref_legal_region lr', 'lr.id=a.region', 'left')
            ->join('ref_legal_district ld', 'ld.id=a.district', 'left')

            ->where("a.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        return $data;
    }


    // curt fee
    function get_grid_data_grid_court($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
    

        $i=0;
        $where2 = "c.vendor_type='4' AND (c.bill_id='0' OR c.bill_id IS NULL) AND c.court_fee_return_sts='0' AND (c.adjustment_sts='0' OR c.adjustment_sts IS NULL)";

        if($this->input->get('req_type')!='') 
        {$where2.=" AND c.vendor_id = '".trim($this->input->get('req_type'))."'";}

        if($this->input->get('proposed_type')!='') 
        {$where2.=" AND c.proposed_type = '".trim($this->input->get('proposed_type'))."'";}

        if($this->input->get('case_number')!='') 
        {$where2.=" AND c.case_number = '".trim($this->input->get('case_number'))."'";}

        if($this->input->get('loan_ac')!='' && $this->input->get('proposed_type')!='') 
        {
            if ($this->input->get('proposed_type')=='Loan') {
                $where2.= " AND c.loan_ac='".$this->input->get('loan_ac')."'";
            }else if($this->input->get('proposed_type')=='Card')
            {
                $where2.= " AND c.org_loan_ac = '".$this->Common_model->stringEncryption('encrypt',$this->input->get('hidden_loan_ac'))."'";
            }
        }

        if($this->input->get('txrn_dt_from') != '' && $this->input->get('txrn_dt_from')!=0 && ($this->input->get('txrn_dt_to') == '' || $this->input->get('txrn_dt_to')==0)) 
        {$where2.=" AND DATE(c.txrn_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_from')))))."'";}
  
        if($this->input->get('txrn_dt_from') != '' && $this->input->get('txrn_dt_from')!=0 && $this->input->get('txrn_dt_to') != '' && $this->input->get('txrn_dt_to')!=0) 
        {$where2.=" AND DATE(c.txrn_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_from')))))."' AND DATE(c.txrn_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_to')))))."'";}



        if (isset($filterscount) && $filterscount > 0)
        {
            $where = "(";

            $tmpdatafield = "";
            $tmpfilteroperator = "";
            for ($i=0; $i < $filterscount; $i++)
            {

                // get the filter's value.
                $filtervalue = $this->input->get('filtervalue'.$i);
                // get the filter's condition.
                $filtercondition = $this->input->get('filtercondition'.$i);
                // get the filter's column.
                $filterdatafield = $this->input->get('filterdatafield'.$i);
                // get the filter's operator.
                $filteroperator = $this->input->get('filteroperator'.$i);

                if($filterdatafield=='proposed_type')
                {
                    $filterdatafield='c.proposed_type';
                }
                else if($filterdatafield=='loan_ac')
                {
                    $filterdatafield='c.loan_ac';
                }
                else if($filterdatafield=='case_number')
                {
                    $filterdatafield='c.case_number';
                }

                else if($filterdatafield=='lawyer_name')
                {
                    $filterdatafield='l.name';
                }
                else if($filterdatafield=='ac_name')
                {
                    $filterdatafield='c.ac_name';
                }

                else if($filterdatafield=='region')
                {
                    $filterdatafield='lr.name';
                }
                else if($filterdatafield=='district')
                {
                    $filterdatafield='ld.name';
                }

                else if($filterdatafield=='amount')
                {
                    $filterdatafield='c.amount';
                }
                else if($filterdatafield=='txrn_dt')
                {
                    $filterdatafield = "DATE_FORMAT(c.txrn_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='cif')
                {
                    $filterdatafield='c.cif';
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
            $sortdatafield="c.id";
            $sortorder = "DESC";                
        }

        $this->db
        ->select('SQL_CALC_FOUND_ROWS c.*,c.vendor_name,c.cif,c.case_number,c.proposed_type,c.loan_ac,c.ac_name,c.amount,
                l.name as lawyer_name, 
                lr.name as region, 
                ld.name as district, 
                DATE_FORMAT(c.txrn_dt,"%d-%b-%y") AS txrn_dt
                ', FALSE)
                ->from("cost_details c")
                ->join('ref_lawyer l', 'l.id=c.vendor_id', 'left')
                ->join('ref_legal_region lr', 'lr.id=c.region', 'left')
                ->join('ref_legal_district ld', 'ld.id=c.district', 'left')
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

    function edit_action_curt()
      {

        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        $edit_row = $this->input->post('edit_row');

        $data = array(
            'vendor_id' =>$this->security->xss_clean( $this->input->post('lawyer')),
            'case_number' =>$this->security->xss_clean( $this->input->post('case_number')),
            'region' =>$this->security->xss_clean( $this->input->post('legal_region')),
            'district' =>$this->security->xss_clean( $this->input->post('legal_district')),
            'amount' =>$this->security->xss_clean( $this->input->post('amount')),
            'txrn_dt' => implode('-', array_reverse(explode('/', $this->input->post('txrn_dt')))),
        );

        $row = $this->db->query('SELECT bill_id,adjustment_sts,court_fee_return_sts FROM cost_details WHERE id='.$edit_row)->row();




        if(empty($row->bill_id) || $row->bill_id=='0' || $row->bill_id ==NULL && $row->adjustment_sts ='0' && empty($row->court_fee_return_sts ) || $row->court_fee_return_sts=='0'){

            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $edit_row);
            $this->db->update('cost_details', $data);
            $insert_idss = $edit_row;

           $this->user_model->user_activities(2,'cost_details',$this->input->post('edit_row'),'cost_details','Bill Data Edited After Verify('.$this->input->post('edit_row').')');

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


        }else{
            $insert_idss = 404;
            return $insert_idss;
        }

    }

    // Paaper Vendor
    function get_grid_data_paper_vendor($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
    

        $i=0;
        $where2 = "c.vendor_type='2' AND (c.bill_id='0' OR c.bill_id IS NULL)";


        if($this->input->get('vendor_type')!='') 
        {
            $where2.=" AND c.paper_bill_vendor_type = '".trim($this->input->get('vendor_type'))."'";
            if($this->input->get('paper_vendor')!='') 
            {$where2.=" AND c.vendor_id = '".trim($this->input->get('paper_vendor'))."'";}
            if($this->input->get('staff')!='') 
            {$where2.=" AND c.vendor_id = '".trim($this->input->get('staff'))."'";}
        }



        if($this->input->get('proposed_type')!='') 
        {$where2.=" AND c.proposed_type = '".trim($this->input->get('proposed_type'))."'";}

        if($this->input->get('case_number')!='') 
        {$where2.=" AND c.case_number = '".trim($this->input->get('case_number'))."'";}

        if($this->input->get('loan_ac')!='' && $this->input->get('proposed_type')!='') 
        {
            if ($this->input->get('proposed_type')=='Loan') {
                $where2.= " AND c.loan_ac='".$this->input->get('loan_ac')."'";
            }else if($this->input->get('proposed_type')=='Card')
            {
                $where2.= " AND c.org_loan_ac = '".$this->Common_model->stringEncryption('encrypt',$this->input->get('hidden_loan_ac'))."'";
            }
        }

        if($this->input->get('txrn_dt_from') != '' && $this->input->get('txrn_dt_from')!=0 && ($this->input->get('txrn_dt_to') == '' || $this->input->get('txrn_dt_to')==0)) 
        {$where2.=" AND DATE(c.txrn_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_from')))))."'";}
  
        if($this->input->get('txrn_dt_from') != '' && $this->input->get('txrn_dt_from')!=0 && $this->input->get('txrn_dt_to') != '' && $this->input->get('txrn_dt_to')!=0) 
        {$where2.=" AND DATE(c.txrn_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_from')))))."' AND DATE(c.txrn_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_to')))))."'";}


        if (isset($filterscount) && $filterscount > 0)
        {
            $where = "(";

            $tmpdatafield = "";
            $tmpfilteroperator = "";
            for ($i=0; $i < $filterscount; $i++)
            {

                // get the filter's value.
                $filtervalue = $this->input->get('filtervalue'.$i);
                // get the filter's condition.
                $filtercondition = $this->input->get('filtercondition'.$i);
                // get the filter's column.
                $filterdatafield = $this->input->get('filterdatafield'.$i);
                // get the filter's operator.
                $filteroperator = $this->input->get('filteroperator'.$i);

                if($filterdatafield=='proposed_type')
                {
                    $filterdatafield='c.proposed_type';
                }
                else if($filterdatafield=='loan_ac')
                {
                    $filterdatafield='c.loan_ac';
                }
                else if($filterdatafield=='case_number')
                {
                    $filterdatafield='c.case_number';
                }

                else if($filterdatafield=='lawyer_name')
                {
                    $filterdatafield='l.name';
                }
                else if($filterdatafield=='ac_name')
                {
                    $filterdatafield='c.ac_name';
                }

                else if($filterdatafield=='region')
                {
                    $filterdatafield='lr.name';
                }
                else if($filterdatafield=='district')
                {
                    $filterdatafield='ld.name';
                }

                else if($filterdatafield=='amount')
                {
                    $filterdatafield='c.amount';
                }
                else if($filterdatafield=='txrn_dt')
                {
                    $filterdatafield = "DATE_FORMAT(c.txrn_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='cif')
                {
                    $filterdatafield='c.cif';
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
            $sortdatafield="c.id";
            $sortorder = "DESC";                
        }

        $this->db
        ->select('SQL_CALC_FOUND_ROWS c.*,c.cif,c.case_number,c.proposed_type,c.loan_ac,c.ac_name,c.amount,c.vendor_id,c.paper_bill_vendor_type,
                lr.name as region, 
                ld.name as district, 
                DATE_FORMAT(c.txrn_dt,"%d-%b-%y") AS txrn_dt,
                IF(c.paper_bill_vendor_type="Vendor",j4.name,j3.name) as vendor_name_search
                ', FALSE)
                ->from("cost_details c")
                ->join('ref_legal_region lr', 'lr.id=c.region', 'left')
                ->join('ref_legal_district ld', 'ld.id=c.district', 'left')

                ->join('users_info as j3',       'c.vendor_id=j3.id and c.paper_bill_vendor_type="Staff"', 'left')
                ->join('ref_paper_vendor as j4', 'c.vendor_id=j4.id and c.paper_bill_vendor_type="Vendor"', 'left')

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
    // staff_conveyance
    
    function staff_conveyance_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
    
        $i=0;
        $where2 = "c.vendor_type='3' AND (c.bill_id='0' OR c.bill_id IS NULL)";



        if($this->input->get('staff_grid_conv')!='' && $this->input->get('staff_grid_conv')!=0) 
		{$where2.=" AND c.vendor_id = '".trim($this->input->get('staff_grid_conv'))."'";}

        if($this->input->get('case_number')!='' && $this->input->get('case_number')!=0) 
		{$where2.=" AND c.case_number = '".trim($this->input->get('case_number'))."'";}



        if($this->input->get('proposed_type')!='') 
        {$where2.=" AND c.proposed_type = '".trim($this->input->get('proposed_type'))."'";}


        if($this->input->get('loan_ac')!='' && $this->input->get('proposed_type')!='') 
        {
            if ($this->input->get('proposed_type')=='Loan') {
                $where2.= " AND c.loan_ac='".$this->input->get('loan_ac')."'";
            }else if($this->input->get('proposed_type')=='Card')
            {
                $where2.= " AND c.org_loan_ac = '".$this->Common_model->stringEncryption('encrypt',$this->input->get('hidden_loan_ac'))."'";
            }
        }


        if($this->input->get('txrn_dt_from') != '' && $this->input->get('txrn_dt_from')!=0 && ($this->input->get('txrn_dt_to') == '' || $this->input->get('txrn_dt_to')==0)) 
        {$where2.=" AND DATE(c.txrn_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_from')))))."'";}
  
        if($this->input->get('txrn_dt_from') != '' && $this->input->get('txrn_dt_from')!=0 && $this->input->get('txrn_dt_to') != '' && $this->input->get('txrn_dt_to')!=0) 
        {$where2.=" AND DATE(c.txrn_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_from')))))."' AND DATE(c.txrn_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_to')))))."'";}



        if (isset($filterscount) && $filterscount > 0)
        {
            $where = "(";

            $tmpdatafield = "";
            $tmpfilteroperator = "";
            for ($i=0; $i < $filterscount; $i++)
            {

                // get the filter's value.
                $filtervalue = $this->input->get('filtervalue'.$i);
                // get the filter's condition.
                $filtercondition = $this->input->get('filtercondition'.$i);
                // get the filter's column.
                $filterdatafield = $this->input->get('filterdatafield'.$i);
                // get the filter's operator.
                $filteroperator = $this->input->get('filteroperator'.$i);

                if($filterdatafield=='proposed_type')
                {
                    $filterdatafield='c.proposed_type';
                }
                else if($filterdatafield=='loan_ac')
                {
                    $filterdatafield='c.loan_ac';
                }
                else if($filterdatafield=='case_number')
                {
                    $filterdatafield='c.case_number';
                }

                else if($filterdatafield=='lawyer_name')
                {
                    $filterdatafield='l.name';
                }
                else if($filterdatafield=='ac_name')
                {
                    $filterdatafield='c.ac_name';
                }

                else if($filterdatafield=='region')
                {
                    $filterdatafield='lr.name';
                }
                else if($filterdatafield=='district')
                {
                    $filterdatafield='ld.name';
                }

                else if($filterdatafield=='amount')
                {
                    $filterdatafield='c.amount';
                }
                else if($filterdatafield=='txrn_dt')
                {
                    $filterdatafield = "DATE_FORMAT(c.txrn_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='cif')
                {
                    $filterdatafield='c.cif';
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
            $sortdatafield="c.id";
            $sortorder = "DESC";                
        }

        

        $this->db
        ->select('SQL_CALC_FOUND_ROWS c.*,c.cif,c.case_number,c.proposed_type,c.loan_ac,c.ac_name,c.amount,c.vendor_id,c.paper_bill_vendor_type,
                lr.name as region, 
                ld.name as district, ven.name as vendor_name_search,
                DATE_FORMAT(c.txrn_dt,"%d-%b-%y") AS txrn_dt,
                ', FALSE)
                ->from("cost_details c")
                ->join('ref_legal_region lr', 'lr.id=c.region', 'left')
                ->join('ref_legal_district ld', 'ld.id=c.district', 'left')

                ->join('users_info ven', 'ven.id=c.vendor_id', 'left')

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
    function get_edit_info_staff_conveyance($id){
	 
		if ($id != '') {
			$this->db->select('c.*,c.case_number,c.region,c.district,c.amount,
            DATE_FORMAT(c.txrn_dt,"%d/%m/%Y") as txrn_dt,
            DATE_FORMAT(c.to_date,"%d/%m/%Y") as to_date,
            DATE_FORMAT(c.from_date,"%d/%m/%Y") as from_date
            ', FALSE)
				->from("cost_details c")
				->where("c.id='" . $id . "'", NULL, FALSE)
				->limit(1);
			$q = $this->db->get();
			return $q->row();
		} else {
			return 'Data Not Found.';
		}
    }
    function edit_action_staff_conveyance()
      {

        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        $edit_row = $this->input->post('edit_row');

        $data = array(

            'movement_details' =>$this->security->xss_clean( $this->input->post('movement_details')),
            'move_of_transfortaion' =>$this->security->xss_clean( $this->input->post('move_of_transfortaion')),
            'particulars' =>$this->security->xss_clean( $this->input->post('particulars')),
            'place' =>$this->security->xss_clean( $this->input->post('place')),
            'description_of_journey' =>$this->security->xss_clean( $this->input->post('description_of_journey')),
            'journey_time' =>$this->security->xss_clean( $this->input->post('journey_time')),
            'journey_metar' =>$this->security->xss_clean( $this->input->post('journey_metar')),
            'reached_time' =>$this->security->xss_clean( $this->input->post('reached_time')),
            'reached_metar' =>$this->security->xss_clean( $this->input->post('reached_metar')),
            'purpose' =>$this->security->xss_clean( $this->input->post('purpose')),
            'from' =>$this->security->xss_clean( $this->input->post('from')),
            'time_out' =>$this->security->xss_clean( $this->input->post('time_out')),
            'to' =>$this->security->xss_clean( $this->input->post('to')),
            'time_in' =>$this->security->xss_clean( $this->input->post('time_in')),
            'mode' =>$this->security->xss_clean( $this->input->post('mode')),
            'breakdown_bill' =>$this->security->xss_clean( $this->input->post('breakdown_bill')),

            'from_date' => implode('-', array_reverse(explode('/', $this->input->post('from_date')))),
            'to_date' => implode('-', array_reverse(explode('/', $this->input->post('to_date')))),
            
            'amount' =>$this->security->xss_clean( $this->input->post('amount')),
            'txrn_dt' => implode('-', array_reverse(explode('/', $this->input->post('txrn_dt')))),
        );

        $row = $this->db->query('SELECT bill_id FROM cost_details WHERE id='.$edit_row)->row();

        if(empty($row->bill_id) || $row->bill_id=='0' || $row->bill_id ==NULL){

            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $edit_row);
            $this->db->update('cost_details', $data);
            $insert_idss = $edit_row;

           $this->user_model->user_activities(2,'cost_details',$this->input->post('edit_row'),'cost_details','Bill Data Edited After Verify('.$this->input->post('edit_row').')');

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


        }else{
            $insert_idss = 404;
            return $insert_idss;
        }

    }

   	//  Court Entertainment

    function court_entertainment_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
    
        $i=0;
        $where2 = "c.vendor_type='5' AND (c.bill_id='0' OR c.bill_id IS NULL)";



        if($this->input->get('staff_grid_conv')!='' && $this->input->get('staff_grid_conv')!=0) 
        {$where2.=" AND c.vendor_id = '".trim($this->input->get('staff_grid_conv'))."'";}

        if($this->input->get('case_number')!='' && $this->input->get('case_number')!=0) 
        {$where2.=" AND c.case_number = '".trim($this->input->get('case_number'))."'";}

        if($this->input->get('proposed_type')!='') 
        {$where2.=" AND c.proposed_type = '".trim($this->input->get('proposed_type'))."'";}

        if($this->input->get('case_number')!='') 
        {$where2.=" AND c.case_number = '".trim($this->input->get('case_number'))."'";}

        if($this->input->get('loan_ac')!='' && $this->input->get('proposed_type')!='') 
        {
            if ($this->input->get('proposed_type')=='Loan') {
                $where2.= " AND c.loan_ac='".$this->input->get('loan_ac')."'";
            }else if($this->input->get('proposed_type')=='Card')
            {
                $where2.= " AND c.org_loan_ac = '".$this->Common_model->stringEncryption('encrypt',$this->input->get('hidden_loan_ac'))."'";
            }
        }


        if($this->input->get('txrn_dt_from') != '' && $this->input->get('txrn_dt_from')!=0 && ($this->input->get('txrn_dt_to') == '' || $this->input->get('txrn_dt_to')==0)) 
        {$where2.=" AND DATE(c.txrn_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_from')))))."'";}
  
        if($this->input->get('txrn_dt_from') != '' && $this->input->get('txrn_dt_from')!=0 && $this->input->get('txrn_dt_to') != '' && $this->input->get('txrn_dt_to')!=0) 
        {$where2.=" AND DATE(c.txrn_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_from')))))."' AND DATE(c.txrn_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_to')))))."'";}



        if (isset($filterscount) && $filterscount > 0)
        {
            $where = "(";

            $tmpdatafield = "";
            $tmpfilteroperator = "";
            for ($i=0; $i < $filterscount; $i++)
            {

                // get the filter's value.
                $filtervalue = $this->input->get('filtervalue'.$i);
                // get the filter's condition.
                $filtercondition = $this->input->get('filtercondition'.$i);
                // get the filter's column.
                $filterdatafield = $this->input->get('filterdatafield'.$i);
                // get the filter's operator.
                $filteroperator = $this->input->get('filteroperator'.$i);

                if($filterdatafield=='proposed_type')
                {
                    $filterdatafield='c.proposed_type';
                }
                else if($filterdatafield=='loan_ac')
                {
                    $filterdatafield='c.loan_ac';
                }
                else if($filterdatafield=='case_number')
                {
                    $filterdatafield='c.case_number';
                }

                else if($filterdatafield=='lawyer_name')
                {
                    $filterdatafield='l.name';
                }
                else if($filterdatafield=='ac_name')
                {
                    $filterdatafield='c.ac_name';
                }

                else if($filterdatafield=='region')
                {
                    $filterdatafield='lr.name';
                }
                else if($filterdatafield=='district')
                {
                    $filterdatafield='ld.name';
                }

                else if($filterdatafield=='amount')
                {
                    $filterdatafield='c.amount';
                }
                else if($filterdatafield=='txrn_dt')
                {
                    $filterdatafield = "DATE_FORMAT(c.txrn_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='cif')
                {
                    $filterdatafield='c.cif';
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
            $sortdatafield="c.id";
            $sortorder = "DESC";                
        }

        

        $this->db
        ->select('SQL_CALC_FOUND_ROWS c.*,c.cif,c.case_number,c.proposed_type,c.loan_ac,c.ac_name,c.amount,c.vendor_id,c.paper_bill_vendor_type,
                lr.name as region, 
                ld.name as district, ven.name as vendor_name_search,
                DATE_FORMAT(c.txrn_dt,"%d-%b-%y") AS txrn_dt,
                ', FALSE)
                ->from("cost_details c")
                ->join('ref_legal_region lr', 'lr.id=c.region', 'left')
                ->join('ref_legal_district ld', 'ld.id=c.district', 'left')

                ->join('users_info ven', 'ven.id=c.vendor_id', 'left')

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

    function get_edit_info_court_entertainment($id){
	 
		if ($id != '') {
			$this->db->select('c.case_number,c.region,c.district,c.amount,c.activities_id,c.expense_remarks,
            DATE_FORMAT(c.txrn_dt,"%d/%m/%Y") as txrn_dt
            ', FALSE)
				->from("cost_details c")
				->where("c.id='" . $id . "'", NULL, FALSE)
				->limit(1);
			$q = $this->db->get();
			return $q->row();
		} else {
			return 'Data Not Found.';
		}
    }


    function edit_action_court_entertainment()
    {



        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        $edit_row = $this->input->post('edit_row');

        $data = array(
            'case_number' =>$this->security->xss_clean( $this->input->post('case_number')),
            'region' =>$this->security->xss_clean( $this->input->post('legal_region')),
            'district' =>$this->security->xss_clean( $this->input->post('legal_district')),
            'amount' =>$this->security->xss_clean( $this->input->post('amount')),
            'txrn_dt' => implode('-', array_reverse(explode('/', $this->input->post('txrn_dt')))),

            'activities_id' =>$this->security->xss_clean( $this->input->post('expense_activities')),
            'expense_remarks' =>$this->security->xss_clean( $this->input->post('expense_remarks')),

        );

        $row = $this->db->query('SELECT bill_id FROM cost_details WHERE id='.$edit_row)->row();

        if(empty($row->bill_id) || $row->bill_id=='0' || $row->bill_id ==NULL){

            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $edit_row);
            $this->db->update('cost_details', $data);
            $insert_idss = $edit_row;

           $this->user_model->user_activities(2,'cost_details',$this->input->post('edit_row'),'cost_details','Bill Data Edited After Verify('.$this->input->post('edit_row').')');

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


        }else{
            $insert_idss = 404;
            return $insert_idss;
        }
    }

    //  Others

    function others_grid($filterscount,$sortdatafield,$sortorder,$limit, $offset)
    {
    
        $i=0;
        $where2 = "c.vendor_type='6' AND (c.bill_id='0' OR c.bill_id IS NULL)";


        if($this->input->get('vendor_name')!='' && $this->input->get('vendor_name')!=0) 
        {$where2.=" AND c.vendor_name = '".trim($this->input->get('vendor_name'))."'";}


        
        if($this->input->get('activities_grid')!='' && $this->input->get('activities_grid')!=0) 
        {$where2.=" AND c.activities_id = '".trim($this->input->get('activities_grid'))."'";}



        if($this->input->get('txrn_dt_from') != '' && $this->input->get('txrn_dt_from')!=0 && ($this->input->get('txrn_dt_to') == '' || $this->input->get('txrn_dt_to')==0)) 
        {$where2.=" AND DATE(c.txrn_dt) ='".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_from')))))."'";}
  
        if($this->input->get('txrn_dt_from') != '' && $this->input->get('txrn_dt_from')!=0 && $this->input->get('txrn_dt_to') != '' && $this->input->get('txrn_dt_to')!=0) 
        {$where2.=" AND DATE(c.txrn_dt) >= '".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_from')))))."' AND DATE(c.txrn_dt) <= '".implode('-',array_reverse(explode('/',trim($this->input->get('txrn_dt_to')))))."'";}




        if (isset($filterscount) && $filterscount > 0)
        {
            $where = "(";

            $tmpdatafield = "";
            $tmpfilteroperator = "";
            for ($i=0; $i < $filterscount; $i++)
            {

                // get the filter's value.
                $filtervalue = $this->input->get('filtervalue'.$i);
                // get the filter's condition.
                $filtercondition = $this->input->get('filtercondition'.$i);
                // get the filter's column.
                $filterdatafield = $this->input->get('filterdatafield'.$i);
                // get the filter's operator.
                $filteroperator = $this->input->get('filteroperator'.$i);

                if($filterdatafield=='proposed_type')
                {
                    $filterdatafield='c.proposed_type';
                }
                else if($filterdatafield=='loan_ac')
                {
                    $filterdatafield='c.loan_ac';
                }
                else if($filterdatafield=='case_number')
                {
                    $filterdatafield='c.case_number';
                }

                else if($filterdatafield=='lawyer_name')
                {
                    $filterdatafield='l.name';
                }
                else if($filterdatafield=='ac_name')
                {
                    $filterdatafield='c.ac_name';
                }

                else if($filterdatafield=='region')
                {
                    $filterdatafield='lr.name';
                }
                else if($filterdatafield=='district')
                {
                    $filterdatafield='ld.name';
                }

                else if($filterdatafield=='amount')
                {
                    $filterdatafield='c.amount';
                }
                else if($filterdatafield=='txrn_dt')
                {
                    $filterdatafield = "DATE_FORMAT(c.txrn_dt,'%d-%b-%y %h:%i %p')";
                }
                else if($filterdatafield=='cif')
                {
                    $filterdatafield='c.cif';
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
            $sortdatafield="c.id";
            $sortorder = "DESC";                
        }

        

        $this->db
        ->select('SQL_CALC_FOUND_ROWS c.*,c.cif,c.case_number,c.proposed_type,c.loan_ac,c.ac_name,c.amount,c.vendor_id,c.paper_bill_vendor_type,
                lr.name as region,c.vendor_name,c.activities_id,
                ld.name as district, ven.name as vendor_name_search,
                DATE_FORMAT(c.txrn_dt,"%d-%b-%y") AS txrn_dt,
                ', FALSE)
                ->from("cost_details c")
                ->join('ref_legal_region lr', 'lr.id=c.region', 'left')
                ->join('ref_legal_district ld', 'ld.id=c.district', 'left')

                ->join('users_info ven', 'ven.id=c.vendor_id', 'left')

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
    function get_edit_info_others($id){
	 
		if ($id != '') {
			$this->db->select('c.vendor_name,c.region,c.district,c.amount,c.activities_id,c.expense_remarks,
            DATE_FORMAT(c.txrn_dt,"%d/%m/%Y") as txrn_dt
            ', FALSE)
				->from("cost_details c")
				->where("c.id='" . $id . "'", NULL, FALSE)
				->limit(1);
			$q = $this->db->get();
			return $q->row();
		} else {
			return 'Data Not Found.';
		}
    }
    function edit_action_others()
    {



        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start

        $edit_row = $this->input->post('edit_row');


        $change_date_format = str_replace('/', '-', (string)$this->input->post('activities_date'));
	    $act_date = date('Y-m-d',strtotime($change_date_format));

        $data = array(

            'vendor_name' =>$this->security->xss_clean($this->input->post('vendor_name')),
			'activities_id' =>$this->security->xss_clean($this->input->post('activities')),
			'txrn_dt' =>$this->security->xss_clean($act_date),
			'amount' =>$this->security->xss_clean( $this->input->post('amount')),
			'expense_remarks' =>$this->security->xss_clean( $this->input->post('remarks')),

        );

        $row = $this->db->query('SELECT bill_id FROM cost_details WHERE id='.$edit_row)->row();

        if(empty($row->bill_id) || $row->bill_id=='0' || $row->bill_id ==NULL){

            $data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $data['u_dt'] = date('Y-m-d H:i:s');
            $this->db->where('id', $edit_row);
            $this->db->update('cost_details', $data);
            $insert_idss = $edit_row;

           $this->user_model->user_activities(2,'cost_details',$this->input->post('edit_row'),'cost_details','Bill Data Edited After Verify('.$this->input->post('edit_row').')');

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


        }else{
            $insert_idss = 404;
            return $insert_idss;
        }
    }

}

?>