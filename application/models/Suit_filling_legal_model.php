<?php
class Suit_filling_legal_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Cma_process_model', '', TRUE);
	}

    function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
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
                else if($filterdatafield=='cif')
                {
                    $filterdatafield='b.cif';
                }
                else if($filterdatafield=='status')
                {
                    $filterdatafield='j1.name';
                }
                else if($filterdatafield=='ac_name')
                {
                    $filterdatafield='b.ac_name';
                }
                else if($filterdatafield=='region_name')
                {
                    $filterdatafield='j7.name';
                }
                else if($filterdatafield=='req_type')
                {
                    $filterdatafield='j11.name';
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
            $sortdatafield="b.id";
            $sortorder = "DESC";                
        }
        $this->db
        ->select('b.*,j1.name as status,j11.name as req_type,j7.name as region_name,j8.name as territory_name,
        j9.name as district_name,j10.name as unit_office_name', FALSE)
            ->from("cma b")
            ->join('ref_status as j1', 'b.cma_sts=j1.id', 'left')
            ->join('ref_region as j7', 'b.region=j7.id', 'left')
            ->join('ref_territory as j8', 'b.territory=j8.id', 'left')
            ->join('ref_district as j9', 'b.district=j9.id', 'left')
            ->join('ref_unit_office as j10', 'b.unit_office=j10.id', 'left')
            ->join('ref_req_type as j11', 'b.req_type=j11.id', 'left')
            ->where($where)
             ->where("b.cma_sts=13",NULL,FALSE)
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
    function seconddb($accno){
        // $secound_db= $this->load->database('database_two', TRUE);
        //     $exist2 = $secound_db->query("SELECT m.id, m.mortgage_deed_no,m.mortgage_date, m.market_value_prprty,m.mortgage_land_value,
        //     lb.title_deed_number,lb.registration_dt,lb.deed_type,lb.district,lb.thana,lb.sro_name,lb.mouza,
        //     lb.land_area, lb.plot_number, lb.holding_number, lb.jote_no, 
        //     lb.khatian_no_cs, lb.khatian_no_sa, lb.khatian_no_rs,lb.khatian_no_bs,lb.khatian_nocity_jorip,lb.mutation_khatian_number,
        //     lb.dag_no_cs, lb.dag_no_sa, lb.dag_no_rs,lb.dag_no_bs,lb.dag_nocity_jorip
        //     FROM app_collateral_land_and_building_mortgage lbm 
        //     JOIN app_mortgage m ON (lbm.mortgage_id=m.id)
        //     JOIN app_collateral_land_and_building lb ON (lbm.security_id=lb.id)
        //     WHERE  m.sts=1  AND m.loan_ac_no='".$accno."' ORDER BY m.mortgage_deed_no ");
        //     $row = $exist2->result();
        $row=array();
        return $row;

    }
    function insert_get_id($table,$data){
        $this->load->database('default', TRUE);
        $this->db->insert($table, $data);
        $tmp = $this->db->insert_id();
        return $tmp;
    }
	function auction_complete($cma_id,$auction_id){
			$this->db->trans_begin(); 
			$this->db->query("UPDATE cma SET cma_sts=33 WHERE id=".$cma_id);
			$this->db->query("UPDATE cma_auction SET life_cycle=33 WHERE id=".$cma_id);
		if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return '00';
        }
        else
        {
			$section_name="auction";
		    $table_id=$auction_id;
		    $table_name="cma_auction";
		    $oprs_sts=16;
		    $oprs_by=$this->session->userdata['ast_user']['user_id'];
		    $oprs_dt=date('Y-m-d H:i:s');
		    $oprs_descriptions='Acknowledgement';
		    $oprs_remarks="Acknowledgement";
		    $this->User_model->operation_history($section_name,$table_id,$table_name,$oprs_sts,$oprs_by,$oprs_dt,$oprs_descriptions,$oprs_remarks);
			return $auction_id;
		}
	}
    function get_recommend_info($id) // get data for edit
    {
        if($id!=''){
            $this->db
            ->select("j0.*,j0.cma_sts as sts,j15.name as auction_sts,CONCAT(j13.name,' (',j13.code,')') as branch_sol,
                j1.name as region_name,j2.name as territory_name,j3.name as district_name,
                j4.name as unit_office_name,
                j6.name as subject_name,j7.name as loan_segment,j8.name as e_by,
                CONCAT(j9.name,' (',j9.user_id,')') as stc_by,
                CONCAT(j10.name,' (',j10.user_id,')') as rec_by,
                CONCAT(j14.name,' (',j14.user_id,')') as r_by,
                CONCAT(j16.name,' (',j16.user_id,')') as reject_by_rm,
                CONCAT(j17.name,' (',j17.user_id,')') as ack_by,
                CONCAT(j18.name,' (',j18.user_id,')') as hold_by,
                CONCAT(j19.name,' (',j19.user_id,')') as sth_by,
                CONCAT(j20.name,' (',j20.user_id,')') as q_by,
                CONCAT(j21.name,' (',j21.user_id,')') as ho_r_by,
                CONCAT(j22.name,' (',j22.user_id,')') as v_by,
                CONCAT(j23.name,' (',j23.user_id,')') as holm_r_by,
                CONCAT(j24.name,' (',j24.user_id,')') as ho_decline_by,
                DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,r.name as req_type,
                DATE_FORMAT(j0.stc_dt,'%d-%b-%y %h:%i %p') AS stc_dt,
                DATE_FORMAT(j0.return_dt_rm,'%d-%b-%y %h:%i %p') AS r_dt,
                DATE_FORMAT(j0.reject_dt_rm,'%d-%b-%y %h:%i %p') AS reject_dt_rm,
                DATE_FORMAT(j0.ack_dt,'%d-%b-%y %h:%i %p') AS ack_dt,
                DATE_FORMAT(j0.hold_dt,'%d-%b-%y %h:%i %p') AS hold_dt,
                DATE_FORMAT(j0.sth_dt,'%d-%b-%y %h:%i %p') AS sth_dt,
                DATE_FORMAT(j0.q_dt,'%d-%b-%y %h:%i %p') AS q_dt,
                DATE_FORMAT(j0.ho_r_dt,'%d-%b-%y %h:%i %p') AS ho_r_dt,
                DATE_FORMAT(j0.v_dt,'%d-%b-%y %h:%i %p') AS v_dt,
                DATE_FORMAT(j0.holm_r_dt,'%d-%b-%y %h:%i %p') AS holm_r_dt,
                DATE_FORMAT(j0.ho_decline_dt,'%d-%b-%y %h:%i %p') AS ho_decline_dt,
                DATE_FORMAT(j0.rec_dt,'%d-%b-%y %h:%i %p') AS rec_dt", FALSE)
            ->from('cma as j0')
            ->join('ref_req_type as r', 'j0.req_type=r.id', 'left')
            ->join("ref_region as j1", "j0.region=j1.id", "left")
            ->join("ref_territory as j2", "j0.territory=j2.id", "left")
            ->join("ref_district as j3", "j0.district=j3.id", "left")
            ->join("ref_unit_office as j4", "j0.unit_office=j4.id", "left")
            ->join("ref_subject_type as j6", "j0.sub_type=j6.id", "left")
            ->join("ref_loan_segment as j7", "j0.loan_segment=j7.id", "left")
            ->join("users_info as j8", "j0.e_by=j8.id", "left")
            ->join("users_info as j9", "j0.stc_by=j9.id", "left")
            ->join("users_info as j10", "j0.rec_by=j10.id", "left")
            ->join("users_info as j14", "j0.return_by_rm=j14.id", "left")
            ->join("ref_branch_sol as j13", "j0.branch_sol=j13.code", "left")
            ->join("ref_status as j15", "j0.cma_sts=j15.id", "left")
            ->join("users_info as j16", "j0.reject_by_rm=j16.id", "left")
            ->join("users_info as j17", "j0.ack_by=j17.id", "left")
            ->join("users_info as j18", "j0.hold_by=j18.id", "left")
            ->join("users_info as j19", "j0.sth_by=j19.id", "left")
            ->join("users_info as j20", "j0.q_by=j20.id", "left")
            ->join("users_info as j21", "j0.ho_r_by=j21.id", "left")
            ->join("users_info as j22", "j0.v_by=j22.id", "left")
            ->join("users_info as j23", "j0.holm_r_by=j23.id", "left")
            ->join("users_info as j24", "j0.ho_decline_by=j24.id", "left")
            ->where("j0.id='".$id."'",NULL,FALSE)
            ->limit(1);
            return  $this->db->get()->row();
        }
        else{return NULL;}
    }
    function get_guarantor_info($add_edit,$id) // get data for edit
    {
        if($id!=''){
            $str=" SELECT g.* ,t.name as type_name,s.name as guar_sts_name,o.name as occ_sts_name
            FROM cma_guarantor g
            LEFT OUTER JOIN ref_guar_type t on(g.guarantor_type=t.id)
            LEFT OUTER JOIN ref_guar_sts s on(g.guarantor_type=s.id)
            LEFT OUTER JOIN ref_guar_occ o on(g.guarantor_type=o.id)
            WHERE g.sts = '1'  AND g.cma_id= ".$this->db->escape($id)." ORDER BY g.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function add_edit_action($accno)
    {
        $cma_id = $this->input->post('cma_id');
        $auction_id = $this->input->post('auction_id');
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
		
		$result = $this->seconddb($accno);
        $editrow=0;
        $table_name = "cma_auction";
        $table_row_id = $auction_id;
        $activities_datetime = date('Y-m-d H:i:s');
        $activities_by = $this->session->userdata['ast_user']['user_id'];
        $ip_address = $this->input->ip_address();
        $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
        $activities_id = "2";
        $description_activities = "Update Auction Status";
        $e_by = $this->session->userdata['ast_user']['user_id'];
        $e_dt = date('Y-m-d H:i:s');
        $arr = array();$tmp=0;
        foreach($result as $val){
            if(in_array($val->mortgage_deed_no,$arr)!=true){
                array_push($arr,$val->mortgage_deed_no);
                $mort_data = array(
                    'cma_id' => $cma_id,
                    'deed_number' => $val->mortgage_deed_no,
                    'mortgage_date' =>$val->mortgage_date,
                    'valuator_mv' =>$val->market_value_prprty,
                    'land_area' =>$val->mortgage_land_value,
                    'csms_new'=>1,
                    'e_by'=>$e_by,
                    'e_dt'=>$e_dt,
                );
                
                $this->db->insert('cma_facility_mortgage', $mort_data);
                $tmp = $this->db->insert_id();
                if($this->db->affected_rows()==0){
                    $this->db->trans_rollback();
                    $this->db->db_debug = $db_debug;
                    return '00';        
                }
            }
            $dist =explode("_",$val->district);
            $thana =explode("_",$val->thana);
            $sro_name =explode("_",$val->sro_name);
            $mouza =explode("_",$val->mouza);
            $sequ = array(
                'cma_id'=>$cma_id,
                'mortgage_id'=>$tmp,
                'title_deed_number'=>$val->title_deed_number,
                'reg_date'=>$val->registration_dt,
                'deed_type'=>$val->deed_type,
                'district'=>$dist[0],
                'thana'=>$thana[0],
                'sub_reg_office'=>$sro_name[0],
                'mouza'=>$mouza[0],
                'land_area'=>$val->land_area,
                'plot_number'=>$val->plot_number,
                'holding_number'=>$val->holding_number,
                'jote_no'=>$val->jote_no,
                'cs_khatian_no'=>$val->khatian_no_cs,
                'rs_khatian_no'=>$val->khatian_no_rs,
                'bs_dp_khatian_no'=>$val->khatian_no_bs,
                'city_jorip_khatian_no'=>$val->khatian_nocity_jorip,
                'mutation_khatian_no'=>$val->mutation_khatian_number,
                'cs_dag_no'=>$val->dag_no_cs,
                'sa_dag_no'=>$val->dag_no_sa,
                'rs_dag_no'=>$val->dag_no_rs,
                'bs_dp_dag_no'=>$val->dag_no_bs,
                'city_jorip_dag_no'=>$val->dag_nocity_jorip,
                'csms_new'=>1,
                'e_by'=>$e_by,
                'e_dt'=>$e_dt,
            );
            $this->db->insert('cma_facility_mortgage_security', $sequ);
            if($this->db->affected_rows()==0){
                $this->db->trans_rollback();
                $this->db->db_debug = $db_debug;
                return '00';        
            }
            
        }
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return '00';
        }
        else
        {
            $this->db->trans_commit();
			$section_name="auction";
		    $table_id=$auction_id;
		    $table_name="cma_auction";
		    $oprs_sts=16;
		    $oprs_by=$this->session->userdata['ast_user']['user_id'];
		    $oprs_dt=date('Y-m-d H:i:s');
		    $oprs_descriptions='Acknowledgement';
		    $oprs_remarks="Acknowledgement";
		    $this->User_model->operation_history($section_name,$table_id,$table_name,$oprs_sts,$oprs_by,$oprs_dt,$oprs_descriptions,$oprs_remarks);
             return $tmp;
        }
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
    function mortgage_add_edit($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($editrow==""){$editrow=0;}

        $mort_data = array(
            'cma_id' => $this->security->xss_clean( $this->input->post('cma_id')),
            'mort_schedule_name' =>$this->security->xss_clean( $this->input->post('mortgageshedulename')),
            'mort_schedule_desc' =>$this->security->xss_clean( $this->input->post('mortgageschedule')),
            'deed_number' =>$this->security->xss_clean( $this->input->post('deednumber')),
            'mortgage_date' =>implode('-',array_reverse(explode('/',$this->input->post('mortgagedate')))),
            'valuator_name' =>$this->security->xss_clean( $this->input->post('valuatorname')),
            'valuator_date' =>implode('-',array_reverse(explode('/',$this->input->post('valuatordate')))),
            'valuator_mv' =>$this->security->xss_clean( $this->input->post('valuatormv')),
            'valuator_fsv' =>$this->security->xss_clean( $this->input->post('valuatorfsv')),
            're_valuator_name' =>$this->security->xss_clean( $this->input->post('revaluatorname')),
            're_valuator_date' =>implode('-',array_reverse(explode('/',$this->input->post('revaluatordate')))),
            're_valuator_mv' =>$this->security->xss_clean( $this->input->post('revaluemv')),
            're_valuator_fsv' =>$this->security->xss_clean( $this->input->post('revaluefsv')),
            'gov_mouza_rate' =>$this->security->xss_clean( $this->input->post('mouzarate')),
            'land_area' =>$this->security->xss_clean( $this->input->post('landarea')),
            'bounded_by' =>$this->security->xss_clean( $this->input->post('boundedby')),
            
        );
        //'subscription_date'=>implode('-',array_reverse(explode('/',$this->input->post('subscription_date')))),
        if($add_edit=="add")
        {
            $mort_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
            $mort_data['e_dt'] = date('Y-m-d H:i:s');
            $mort_data['csms_new'] = 0;
            $this->db->insert('cma_facility_mortgage', $mort_data);
            $insert_idss = $this->db->insert_id();
            if($this->db->affected_rows()==0)
            {
                $this->db->trans_rollback();
                $this->db->db_debug = $db_debug;
                return '00';        
            }
            $data2 = $this->user_model->user_activities(39,'auction',$insert_idss,'cma_facility_mortgage','Add Facility Mortgage For CMA('.$insert_idss.')');
        }
        else
        {
            $mort_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $mort_data['u_dt'] = date('Y-m-d H:i:s');
            
            $this->db->where('id', $edit_id);
            $this->db->update('cma_facility_mortgage', $mort_data);
            $insert_idss = $edit_id;
            if($this->db->affected_rows()==0)
            {
                $this->db->trans_rollback();
                $this->db->db_debug = $db_debug;
                return '00';        
            }
            $data2 = $this->user_model->user_activities(35,'auction',$insert_idss,'cma_facility_mortgage','Update Facility Mortgage For CMA('.$insert_idss.')');
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
    function get_paper_info($id) // get data for edit
    {
        if($id!=''){
            $this->db
            ->select("j0.auction_address,j0.paper_remarks,j2.name as paper_name,j3.name as paper_vendor,
                CONCAT(j4.name,' (',j4.user_id,')') as e_by,
                DATE_FORMAT(j0.paper_date,'%d-%b-%y %h:%i %p') AS paper_date,
                DATE_FORMAT(j0.paper_e_dt,'%d-%b-%y %h:%i %p') AS paper_e_dt,
                DATE_FORMAT(j0.auction_time,'%h:%i %p') AS auction_time,
                DATE_FORMAT(j0.auction_date,'%d-%b-%y %h:%i %p') AS auction_date", FALSE)
            ->from('cma_auction as j0')
            ->join("ref_paper as j2", "j0.paper_name=j2.id", "left")
            ->join("ref_paper_vendor as j3", "j0.paper_vendor=j3.id", "left")
            ->join("users_info as j4", "j0.paper_e_by=j4.id", "left")
            ->where("j0.id='".$id."'",NULL,FALSE)
            ->limit(1);
            return  $this->db->get()->row();
        }
        else{return NULL;}
    }
    function get_mortgage_info($id) // get data for edit
    {
        if($id!=''){
            $this->db
            ->select("j0.mort_schedule_name,j0.mort_schedule_desc,j0.deed_number,j0.valuator_name,
                j0.valuator_mv,j0.valuator_fsv,j0.re_valuator_name,j0.re_valuator_mv,j0.re_valuator_fsv,
                j0.gov_mouza_rate,j0.land_area,j0.bounded_by,
                DATE_FORMAT(j0.mortgage_date,'%d-%b-%y %h:%i %p') AS mortgage_date,
                DATE_FORMAT(j0.valuator_date,'%d-%b-%y %h:%i %p') AS valuator_date,
                DATE_FORMAT(j0.re_valuator_date,'%d-%b-%y %h:%i %p') AS re_valuator_date", FALSE)
            ->from('cma_facility_mortgage as j0')
            ->where("j0.id='".$id."'",NULL,FALSE)
            ->limit(1);
            return  $this->db->get()->row();
        }
        else{return NULL;}
    }
    function get_memo_details($id) // get data for edit
    {
        if($id!=''){
            $str=" SELECT b.* ,r.name as bidder_rank_name,
             DATE_FORMAT(b.pay_order_date,'%d-%b-%y') AS pay_order_dt
            FROM cma_auction_bidder b
            LEFT OUTER JOIN ref_bidder_rank r on(b.bidder_rank=r.id)
            WHERE b.sts = '1'  AND b.cma_id= ".$this->db->escape($id)." ORDER BY b.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
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
            WHERE r.table_row_id= ".$this->db->escape($id)." AND r.section_name='auction'  ".$where."  ORDER BY r.id ASC";
            $query=$this->db->query($str);
            return $query->result();
        }
        else{return NULL;}
    }
    function get_security_info($id) // get data for edit
    {
        if($id!=''){
            $this->db
            ->select("j0.*,
                DATE_FORMAT(j0.reg_date,'%d-%b-%y %h:%i %p') AS reg_date", FALSE)
            ->from('cma_facility_mortgage_security as j0')
            ->where("j0.id='".$id."'",NULL,FALSE)
            ->limit(1);
            return  $this->db->get()->row();
        }
        else{return NULL;}
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
    function security_add_edit($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($editrow==""){$editrow=0;}
        
        $mort_data = array(
            'cma_id' => $this->security->xss_clean( $this->input->post('cma_id')),
            'mortgage_id' =>$this->security->xss_clean( $this->input->post('mortgage_id')),
            'title_deed_number' =>$this->security->xss_clean( $this->input->post('deednumber')),
            'reg_date' =>implode('-',array_reverse(explode('/',$this->input->post('regdate')))),
            'deed_type' =>$this->security->xss_clean( $this->input->post('typeofdeed')),
            'district' =>$this->security->xss_clean( $this->input->post('district')),
            'thana' =>$this->security->xss_clean( $this->input->post('thana')),
            'sub_reg_office' =>$this->security->xss_clean( $this->input->post('unitoffice')),
            'mouza' =>$this->security->xss_clean( $this->input->post('mouza')),
            'land_area' =>$this->security->xss_clean( $this->input->post('landarea')),
            'plot_number' =>$this->security->xss_clean( $this->input->post('plotnumber')),
            'holding_number' =>$this->security->xss_clean( $this->input->post('holdingnum')),
            'jote_no' =>$this->security->xss_clean( $this->input->post('joteno')),
            'cs_khatian_no' =>$this->security->xss_clean( $this->input->post('cskhatianno')),
            'sa_khatian_no' =>$this->security->xss_clean( $this->input->post('sakhatianno')),
            'rs_khatian_no' =>$this->security->xss_clean( $this->input->post('rskhatianno')),
            'bs_dp_khatian_no' =>$this->security->xss_clean( $this->input->post('bskhatianno')),
            'city_jorip_khatian_no' =>$this->security->xss_clean( $this->input->post('cityjoripkhatianno')),
            'mutation_khatian_no' =>$this->security->xss_clean( $this->input->post('mutationkhatianno')),
            'cs_dag_no' =>$this->security->xss_clean( $this->input->post('csdagno')),
            'sa_dag_no' =>$this->security->xss_clean( $this->input->post('sadagno')),
            'rs_dag_no' =>$this->security->xss_clean( $this->input->post('rsdagno')),
            'bs_dp_dag_no' =>$this->security->xss_clean( $this->input->post('bsdagno')),
            'city_jorip_dag_no' =>$this->security->xss_clean( $this->input->post('cityjoripdagno')),
        );
        //'subscription_date'=>implode('-',array_reverse(explode('/',$this->input->post('subscription_date')))),
        if($add_edit=="add")
        {
            $mort_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
            $mort_data['e_dt'] = date('Y-m-d H:i:s');
            $mort_data['csms_new'] = 0;
            $this->db->insert('cma_facility_mortgage_security', $mort_data);
            $insert_idss = $this->db->insert_id();
            if($this->db->affected_rows()==0)
            {
                $this->db->trans_rollback();
                $this->db->db_debug = $db_debug;
                return '00';        
            }
            $data2 = $this->user_model->user_activities(39,'auction',$insert_idss,'cma_facility_mortgage_security','Add Facility Mortgage Security For CMA('.$insert_idss.')');
        }
        else
        {
            $mort_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
            $mort_data['u_dt'] = date('Y-m-d H:i:s');
            
            $this->db->where('id', $edit_id);
            $this->db->update('cma_facility_mortgage_security', $mort_data);
            $insert_idss = $edit_id;
            if($this->db->affected_rows()==0)
            {
                $this->db->trans_rollback();
                $this->db->db_debug = $db_debug;
                return '00';        
            }
            $data2 = $this->user_model->user_activities(35,'auction',$insert_idss,'cma_facility_mortgage_security','Update Facility Mortgage Security For CMA('.$insert_idss.')');
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
    function get_add_action_security_data($id)
    {
        $this->db
            ->select("b.*", FALSE)
            ->from("cma_facility_mortgage_security b")
            ->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
            ->limit(1);
        $data = $this->db->get()->row();
        //echo $this->db->last_query();
        return $data;
    }
    function add_paper_notice($edit_id=NULL,$editrow=NULL)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = true; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($editrow==""){$editrow=0;}
        
        $paper_data = array(
            'auction_sts' =>40,
            'paper_name' =>$this->security->xss_clean( $this->input->post('paper')),
            'paper_vendor' =>$this->security->xss_clean( $this->input->post('paper_vendor')),
            'paper_date' =>implode('-',array_reverse(explode('/',$this->input->post('paper_date')))),
            'auction_date' =>implode('-',array_reverse(explode('/',$this->input->post('auction_date')))),
            'auction_time' =>implode('-',array_reverse(explode('/',$this->input->post('auction_time')))),
            'auction_address' =>$this->security->xss_clean( $this->input->post('auction_address')),
            'paper_remarks' =>$this->security->xss_clean( $this->input->post('remarks')),
            'paper_e_by' => $this->session->userdata['ast_user']['user_id'],
            'paper_e_dt' =>  date('Y-m-d H:i:s')
        );
        $this->db->where('id', $edit_id);
        $this->db->update('cma_auction', $paper_data);
        $insert_idss = $edit_id;
        $data2 = $this->user_model->user_activities(40,'auction',$insert_idss,'cma_auction','Prepare Paper Notice('.$insert_idss.')');

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
    function add_memo($edit_id=NULL,$editrow=NULL)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($editrow==""){$editrow=0;}
        //For Memo Add Action
        if ($_POST['add_edit']==0) 
        {
           for($i=1;$i<= $_POST['bidder_info_counter'];$i++)
            {
                $bidder = array(
                'cma_id' =>$this->security->xss_clean( $this->input->post('cma_id')),
                'bidder_name' =>$this->security->xss_clean( $this->input->post('bidder_name_'.$i)),
                'bidder_details' =>$this->security->xss_clean( $this->input->post('bidder_details_'.$i)),
                'bidder_rank' =>$this->security->xss_clean( $this->input->post('bidder_rank_'.$i)),
                'pay_order_no' =>$this->security->xss_clean( $this->input->post('pay_order_no_'.$i)),
                'pay_order_date' =>implode('-',array_reverse(explode('/',$this->input->post('pay_order_date_'.$i)))),
                'pay_order_amount' =>$this->security->xss_clean( $this->input->post('pay_order_amount_'.$i)),
                'bid_amount' =>$this->security->xss_clean( $this->input->post('bid_amount_'.$i)),
                'auction_schedule' =>$this->security->xss_clean( $this->input->post('auction_schedule_'.$i)),
                'r_s_plot_no' =>$this->security->xss_clean( $this->input->post('r_s_plot_no_'.$i)),
                'remarks' =>$this->security->xss_clean( $this->input->post('remarks_'.$i)),
                'e_by' => $this->session->userdata['ast_user']['user_id'],
                'e_dt' =>  date('Y-m-d H:i:s')
                );
                if ($_POST['bidder_info_delete_'.$i]!=1) {
                    $this->db->insert('cma_auction_bidder', $bidder);
                }
                $insert_idss = $this->db->insert_id();
                if($insert_idss==0)
                {
                    $this->db->trans_rollback();
                    $this->db->db_debug = $db_debug;
                    return '00';        
                }
            }
            $data = array('auction_sts' =>18);
            $this->db->where('id', $_POST['id']);
            $this->db->update('cma_auction', $data);
            $data2 = $this->user_model->user_activities(18,'auction',$insert_idss,'cma_auction_bidder','Bidder Inforamtion Add('.$insert_idss.')');
        }
        //For Edit Memo Action
        else
        {
            for($i=1;$i<= $_POST['bidder_info_counter'];$i++)
            {
                $bidder = array(
                'cma_id' =>$this->security->xss_clean( $this->input->post('cma_id')),
                'bidder_name' =>$this->security->xss_clean( $this->input->post('bidder_name_'.$i)),
                'bidder_details' =>$this->security->xss_clean( $this->input->post('bidder_details_'.$i)),
                'bidder_rank' =>$this->security->xss_clean( $this->input->post('bidder_rank_'.$i)),
                'pay_order_no' =>$this->security->xss_clean( $this->input->post('pay_order_no_'.$i)),
                'pay_order_date' =>implode('-',array_reverse(explode('/',$this->input->post('pay_order_date_'.$i)))),
                'pay_order_amount' =>$this->security->xss_clean( $this->input->post('pay_order_amount_'.$i)),
                'bid_amount' =>$this->security->xss_clean( $this->input->post('bid_amount_'.$i)),
                'auction_schedule' =>$this->security->xss_clean( $this->input->post('auction_schedule_'.$i)),
                'r_s_plot_no' =>$this->security->xss_clean( $this->input->post('r_s_plot_no_'.$i)),
                'remarks' =>$this->security->xss_clean( $this->input->post('remarks_'.$i)),
                );
                // For skip The new deleted row
                if ($_POST['bidder_info_edit_'.$i]==0 && $_POST['bidder_info_delete_'.$i]==1) 
                {
                    continue;
                }
                //For Delete the old row
                if ($_POST['bidder_info_edit_'.$i]!=0 && $_POST['bidder_info_delete_'.$i]==1) 
                {
                    $data = array('sts' => 0);
                    $this->db->where('id',$_POST['bidder_info_edit_'.$i]);
                    $this->db->update('cma_auction_bidder', $data);
                }
                //For update the old row
                else if($_POST['bidder_info_edit_'.$i]!=0 && $_POST['bidder_info_delete_'.$i]!=1)
                {
                    $this->db->where('id',$_POST['bidder_info_edit_'.$i]);
                    $this->db->update('cma_auction_bidder', $bidder);
                }
                //For insert the new row
                else if($_POST['bidder_info_edit_'.$i]==0 && $_POST['bidder_info_delete_'.$i]==0)
                {
                    $this->db->insert('cma_auction_bidder', $bidder);
                }
                
            }
            $data = array('auction_sts' =>18);
            $this->db->where('id', $_POST['id']);
            $this->db->update('cma_auction', $data);
            $data2 = $this->user_model->user_activities(18,'auction',$_POST['id'],'cma_auction_bidder','Bidder Inforamtion Update('.$_POST['id'].')');
        }
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
    function send_email($fromEmail,$fromName, $toemail, $subject,$message)
    {

        require'PHPMailer/src/PHPMailer.php';
        require'PHPMailer/src/SMTP.php';
        require'PHPMailer/src/Exception.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';


        

        $mail->Subject =$subject;

        $toA=explode(",", $toemail);
        for($i=0; $i<count($toA);$i++)
        {
            $mail->addAddress($toA[$i], '');
        }
        //print_r($mail);
        //$mail->addAddress($toemail, 'to');
        //$mail->addAddress('sysadmin@thecitybank.com', 'to');
        //$mail->addAddress('mariom@mmtvbd.com', '');
        


        /* if($ccemail!='' && strlen($ccemail)>5){
            $ccA=explode(",", $ccemail);
            for($i=0; $i<count($ccA);$i++)
            {
                $mail->AddCC($ccA[$i], '');
            }
        }
        */
        
        $mail->setFrom($fromEmail, $fromName);
        $mail->msgHTML($message);
        $m='';
        // $mail->send();
        if(!$mail->Send())
        {
            $m= "Error sending: " . $mail->ErrorInfo;
        }
        else
        {
            $m= "Sent";
        }
        $mail->clearAddresses();


        return $m;

    }
    function delete_action()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false; // off display of db error
        $this->db->trans_begin(); // transaction start
        if($this->input->post('type')=='acknowledgement'){
            if ($_POST['auction_status']==1) {
                $data = array('auction_sts' => 33,'ack_by'=> $this->session->userdata['ast_user']['user_id'], 'ack_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('cma_auction', $data);
                $data = array('cma_sts' => 33,'auction_sts' => '1', 'auction_sts_by'=> $this->session->userdata['ast_user']['user_id'], 'auction_sts_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['cma_id']);
                $this->db->update('cma', $data);
                $data2 = $this->user_model->user_activities(33,'auction',$this->input->post('deleteEventId'),'cma_auction','Completed CMA Auction('.$this->input->post('deleteEventId').')');
            }
            else
            {
                $data = array('auction_sts' => '16', 'ack_by'=> $this->session->userdata['ast_user']['user_id'], 'ack_dt'=>date('Y-m-d H:i:s'));
                $this->db->where('id', $_POST['deleteEventId']);
                $this->db->update('cma_auction', $data);

                $data2 = $this->user_model->user_activities(16,'auction',$this->input->post('deleteEventId'),'cma_auction','Acknowledgement CMA Auction('.$this->input->post('deleteEventId').')');
                //Getting The Facility
                $result = $this->seconddb($_POST['loan_ac']);
                //echo "<pre>";print_r($result);exit;
                $cma_id=$_POST['cma_id'];
                $e_by = $this->session->userdata['ast_user']['user_id'];
                $e_dt = date('Y-m-d H:i:s');
                $arr = array();$tmp=0;
                foreach($result as $val){
                    if(in_array($val->mortgage_deed_no,$arr)!=true){
                        array_push($arr,$val->mortgage_deed_no);
                        $mort_data = array(
                            'cma_id' => $cma_id,
                            'deed_number' => $val->mortgage_deed_no,
                            'mortgage_date' =>$val->mortgage_date,
                            'valuator_mv' =>$val->market_value_prprty,
                            'land_area' =>$val->mortgage_land_value,
                            'csms_new'=>1,
                            'e_by'=>$e_by,
                            'e_dt'=>$e_dt,
                        );
                        //insert cma facility mortgage
                        $this->db->insert('cma_facility_mortgage', $mort_data);
                        $tmp = $this->db->insert_id();
                        if($this->db->affected_rows()==0){
                            $this->db->trans_rollback();
                            $this->db->db_debug = $db_debug;
                            return '00';        
                        }
                    }
                    $dist =explode("_",$val->district);
                    $thana =explode("_",$val->thana);
                    $sro_name =explode("_",$val->sro_name);
                    $mouza =explode("_",$val->mouza);
                    $sequ = array(
                        'cma_id'=>$cma_id,
                        'mortgage_id'=>$tmp,
                        'title_deed_number'=>$val->title_deed_number,
                        'reg_date'=>$val->registration_dt,
                        'deed_type'=>$val->deed_type,
                        'district'=>$dist[0],
                        'thana'=>$thana[0],
                        'sub_reg_office'=>$sro_name[0],
                        'mouza'=>$mouza[0],
                        'land_area'=>$val->land_area,
                        'plot_number'=>$val->plot_number,
                        'holding_number'=>$val->holding_number,
                        'jote_no'=>$val->jote_no,
                        'cs_khatian_no'=>$val->khatian_no_cs,
                        'rs_khatian_no'=>$val->khatian_no_rs,
                        'bs_dp_khatian_no'=>$val->khatian_no_bs,
                        'city_jorip_khatian_no'=>$val->khatian_nocity_jorip,
                        'mutation_khatian_no'=>$val->mutation_khatian_number,
                        'cs_dag_no'=>$val->dag_no_cs,
                        'sa_dag_no'=>$val->dag_no_sa,
                        'rs_dag_no'=>$val->dag_no_rs,
                        'bs_dp_dag_no'=>$val->dag_no_bs,
                        'city_jorip_dag_no'=>$val->dag_nocity_jorip,
                        'csms_new'=>1,
                        'e_by'=>$e_by,
                        'e_dt'=>$e_dt,
                    );
                    //Insert Cma Facility Mortgage Security
                    $this->db->insert('cma_facility_mortgage_security', $sequ);
                    if($this->db->affected_rows()==0){
                        $this->db->trans_rollback();
                        $this->db->db_debug = $db_debug;
                        return '00';        
                    }
                    
                }
                $data2 = $this->user_model->user_activities(16,'auction',$this->input->post('deleteEventId'),'cma_auction','Acknowledgement CMA Auction('.$this->input->post('deleteEventId').')');
            }
        }
        if($this->input->post('type')=='mortgage_delete'){
            $data = array('d_reason'=>trim($_POST['comments']), 'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma_facility_mortgage', $data);
            //Delete security under this mortgage
            $data = array('d_reason'=>trim($_POST['comments']), 'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('mortgage_id', $_POST['deleteEventId']);
            $this->db->update('cma_facility_mortgage_security', $data);
            $data2 = $this->user_model->user_activities(35,'auction',$this->input->post('deleteEventId'),'cma_facility_mortgage','Delete Mortgage('.$this->input->post('deleteEventId').')',$_POST['comments']);
        
        }
        if($this->input->post('type')=='security_delete'){
            //Delete security under this mortgage
            $data = array('d_reason'=>trim($_POST['comments']), 'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma_facility_mortgage_security', $data);
           $data2 = $this->user_model->user_activities(35,'auction',$this->input->post('deleteEventId'),'cma_facility_mortgage_security','Delete Mortgage Security('.$this->input->post('deleteEventId').')',$_POST['comments']);
        }
        if($this->input->post('type')=='verifypaper'){
            //Verify Paper notice
            $data = array('auction_sts'=>17,'paper_v_by'=> $this->session->userdata['ast_user']['user_id'], 'paper_v_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma_auction', $data);
            $data2 = $this->user_model->user_activities(17,'auction',$this->input->post('deleteEventId'),'cma_auction','Approve Paper Notice('.$this->input->post('deleteEventId').')');
            $str="SELECT  j0.id,j1.proposed_type,j1.loan_segment,j0.loan_ac,j0.region,j0.territory,j0.district,j0.unit_office,j0.paper_vendor,j0.paper_name
                         FROM cma_auction j0
                         LEFT OUTER JOIN cma j1 on(j0.cma_id=j0.id)
                     WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                     
            $application_data=$this->db->query($str)->row();
            $cost_data = array(
                'proposed_type' => $application_data->proposed_type,
                'table_name' => 'cma_auction',
                'table_id' => $this->input->post('deleteEventId'),
                'vendor_type' => 'Publisher',
                'amount' =>50,
                'qty' =>1,
                'description' => 'Paper Bill',
                'txrn_dt' => date("Y-m-d H:i:s"),
                'Activities_id' => 17,
                'vendor_id' => $application_data->paper_vendor,
                'ac_card_no' => $application_data->loan_ac,
                'Portfolio' => $application_data->loan_segment,
                'region' => $application_data->region,
                'territory' => $application_data->territory,
                'district' => $application_data->district,
                'unit_office' => $application_data->unit_office,
            );
            $data3=$this->user_model->cost_details($cost_data);
        }
        if($this->input->post('type')=='decline'){
            //Verify Paper notice
            $data = array('auction_sts'=>43,'paper_d_reason'=>trim($_POST['decline_reason']),'paper_d_by'=> $this->session->userdata['ast_user']['user_id'], 'papaer_d_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma_auction', $data);
            $data2 = $this->user_model->user_activities(43,'auction',$this->input->post('deleteEventId'),'cma_auction','Decline paper notice('.$this->input->post('deleteEventId').')',$_POST['decline_reason']);
            if ($this->db->affected_rows() > 0) 
            {
                if (isset($_POST['email_notification_for_return']) && $this->input->post('email_notification_for_return') == 'email')
                {
                    $str="SELECT  j0.id,s.name as auction_sts,j0.ack_by
                                 FROM cma_auction j0
                                 LEFT OUTER JOIN ref_status s on(j0.auction_sts=s.id)
                             WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                             
                    $application_data=$this->db->query($str)->row();

                    $checker_id = $application_data->ack_by;
                  
                    $str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$checker_id."' LIMIT 1";
                    $checker_info=$this->db->query($str1)->row();
                    
                    if (!empty($checker_info->email_address) && $checker_info->email_address != null) {
                       $subject="Request for Approval";
                       $req_type=$application_data->auction_sts;
                       $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
                       $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
                        A request is waiting for your approval.<br/><br/>
                        Request Type: ".$req_type."<br/>
                        Request by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), <br/>
                        Request Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/>
                        Please login to  <a href=".base_url().">LMS Application</a>  to approve the request.<br/><br/> 
                        This is a system generated email, no need to reply.<br/><br/>  
                        Thanks</div>";
                        $m=$this->send_email("enayet.ullah@mmtvbd.com", "LMS", $checker_info->email_address, $subject,$message);
                        
                        //echo $m;exit;
                    }
                }
            }
        }
        if($this->input->post('type')=='hold'){
            //Verify Paper notice
            $data = array('auction_sts'=>42,'paper_h_reason'=>trim($_POST['hold_reason']),'paper_h_by'=> $this->session->userdata['ast_user']['user_id'], 'paper_h_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma_auction', $data);
           
            if ($this->db->affected_rows() > 0) 
            {
                if (isset($_POST['email_notification_for_send_hold']) && $this->input->post('email_notification_for_send_hold') == 'email')
                {
                    $str="SELECT  j0.id,s.name as auction_sts,j0.ack_by
                                 FROM cma_auction j0
                                 LEFT OUTER JOIN ref_status s on(j0.auction_sts=s.id)
                             WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                             
                    $application_data=$this->db->query($str)->row();

                    $checker_id = $application_data->ack_by;
                  
                    $str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$checker_id."' LIMIT 1";
                    $checker_info=$this->db->query($str1)->row();
                    
                    if (!empty($checker_info->email_address) && $checker_info->email_address != null) {
                       $subject="Request for Approval";
                       $req_type=$application_data->auction_sts;
                       $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
                       $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
                        A request is waiting for your approval.<br/><br/>
                        Request Type: ".$req_type."<br/>
                        Request by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), <br/>
                        Request Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/>
                        Please login to  <a href=".base_url().">LMS Application</a>  to approve the request.<br/><br/> 
                        This is a system generated email, no need to reply.<br/><br/>  
                        Thanks</div>";
                        $m=$this->send_email("enayet.ullah@mmtvbd.com", "LMS", $checker_info->email_address, $subject,$message);
                        
                        //echo $m;exit;
                    }
                }
            }
             $data2 = $this->user_model->user_activities(42,'auction',$this->input->post('deleteEventId'),'cma_auction','Hold paper notice('.$this->input->post('deleteEventId').')',$_POST['hold_reason']);
        }
        if($this->input->post('type')=='return'){
            //Verify Paper notice
            $data = array('auction_sts'=>44,'paper_r_reason'=>trim($_POST['return_reason']),'paper_r_by'=> $this->session->userdata['ast_user']['user_id'], 'paper_r_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma_auction', $data);
            if ($this->db->affected_rows() > 0) 
            {
                if (isset($_POST['email_notification_for_return']) && $this->input->post('email_notification_for_return') == 'email')
                {
                    $str="SELECT  j0.id,s.name as auction_sts,j0.ack_by
                                 FROM cma_auction j0
                                 LEFT OUTER JOIN ref_status s on(j0.auction_sts=s.id)
                             WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                             
                    $application_data=$this->db->query($str)->row();

                    $checker_id = $application_data->ack_by;
                  
                    $str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$checker_id."' LIMIT 1";
                    $checker_info=$this->db->query($str1)->row();
                    
                    if (!empty($checker_info->email_address) && $checker_info->email_address != null) {
                       $subject="Request for Approval";
                       $req_type=$application_data->auction_sts;
                       $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
                       $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
                        A request is waiting for your approval.<br/><br/>
                        Request Type: ".$req_type."<br/>
                        Request by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), <br/>
                        Request Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/>
                        Please login to  <a href=".base_url().">LMS Application</a>  to approve the request.<br/><br/> 
                        This is a system generated email, no need to reply.<br/><br/>  
                        Thanks</div>";
                        $m=$this->send_email("enayet.ullah@mmtvbd.com", "LMS", $checker_info->email_address, $subject,$message);
                        
                        //echo $m;exit;
                    }
                }
            }
            $data2 = $this->user_model->user_activities(44,'auction',$this->input->post('deleteEventId'),'cma_auction','Return paper notice('.$this->input->post('deleteEventId').')',$_POST['return_reason']);
        }
        if($this->input->post('type')=='verify_memo'){
            //Verify Paper notice
            $data = array('auction_sts'=>22,'memo_v_by'=> $this->session->userdata['ast_user']['user_id'], 'memo_v_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma_auction', $data);
            $data2 = $this->user_model->user_activities(17,'auction',$this->input->post('deleteEventId'),'cma_auction','Approve memo ('.$this->input->post('deleteEventId').')');
        }
        if($this->input->post('type')=='memo_decline'){
            //Verify Paper notice
            $data = array('auction_sts'=>23,'memo_d_reason'=>trim($_POST['decline_reason']),'memo_d_by'=> $this->session->userdata['ast_user']['user_id'], 'memo_d_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma_auction', $data);
            $data2 = $this->user_model->user_activities(23,'auction',$this->input->post('deleteEventId'),'cma_auction','Decline Memo('.$this->input->post('deleteEventId').')',$_POST['decline_reason']);
            if ($this->db->affected_rows() > 0) 
            {
                if (isset($_POST['email_notification_for_return']) && $this->input->post('email_notification_for_return') == 'email')
                {
                    $str="SELECT  j0.id,s.name as auction_sts,j0.ack_by
                                 FROM cma_auction j0
                                 LEFT OUTER JOIN ref_status s on(j0.auction_sts=s.id)
                             WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                             
                    $application_data=$this->db->query($str)->row();

                    $checker_id = $application_data->ack_by;
                  
                    $str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$checker_id."' LIMIT 1";
                    $checker_info=$this->db->query($str1)->row();
                    
                    if (!empty($checker_info->email_address) && $checker_info->email_address != null) {
                       $subject="Request for Approval";
                       $req_type=$application_data->auction_sts;
                       $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
                       $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
                        A request is waiting for your approval.<br/><br/>
                        Request Type: ".$req_type."<br/>
                        Request by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), <br/>
                        Request Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/>
                        Please login to  <a href=".base_url().">LMS Application</a>  to approve the request.<br/><br/> 
                        This is a system generated email, no need to reply.<br/><br/>  
                        Thanks</div>";
                        $m=$this->send_email("enayet.ullah@mmtvbd.com", "LMS", $checker_info->email_address, $subject,$message);
                        
                        //echo $m;exit;
                    }
                }
            }
        }
        if($this->input->post('type')=='memo_hold'){
            //Verify Paper notice
            $data = array('auction_sts'=>21,'memo_h_reason'=>trim($_POST['hold_reason']),'memo_h_by'=> $this->session->userdata['ast_user']['user_id'], 'memo_h_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma_auction', $data);
           
            if ($this->db->affected_rows() > 0) 
            {
                if (isset($_POST['email_notification_for_send_hold']) && $this->input->post('email_notification_for_send_hold') == 'email')
                {
                    $str="SELECT  j0.id,s.name as auction_sts,j0.ack_by
                                 FROM cma_auction j0
                                 LEFT OUTER JOIN ref_status s on(j0.auction_sts=s.id)
                             WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                             
                    $application_data=$this->db->query($str)->row();

                    $checker_id = $application_data->ack_by;
                  
                    $str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$checker_id."' LIMIT 1";
                    $checker_info=$this->db->query($str1)->row();
                    
                    if (!empty($checker_info->email_address) && $checker_info->email_address != null) {
                       $subject="Request for Approval";
                       $req_type=$application_data->auction_sts;
                       $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
                       $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
                        A request is waiting for your approval.<br/><br/>
                        Request Type: ".$req_type."<br/>
                        Request by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), <br/>
                        Request Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/>
                        Please login to  <a href=".base_url().">LMS Application</a>  to approve the request.<br/><br/> 
                        This is a system generated email, no need to reply.<br/><br/>  
                        Thanks</div>";
                        $m=$this->send_email("enayet.ullah@mmtvbd.com", "LMS", $checker_info->email_address, $subject,$message);
                        
                        //echo $m;exit;
                    }
                }
            }
             $data2 = $this->user_model->user_activities(21,'auction',$this->input->post('deleteEventId'),'cma_auction','Hold Memo('.$this->input->post('deleteEventId').')',$_POST['hold_reason']);
        }
        if($this->input->post('type')=='memo_return'){
            //Verify Paper notice
            $data = array('auction_sts'=>20,'memo_r_reason'=>trim($_POST['return_reason']),'memo_r_by'=> $this->session->userdata['ast_user']['user_id'], 'memo_r_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma_auction', $data);
            if ($this->db->affected_rows() > 0) 
            {
                if (isset($_POST['email_notification_for_return']) && $this->input->post('email_notification_for_return') == 'email')
                {
                    $str="SELECT  j0.id,s.name as auction_sts,j0.ack_by
                                 FROM cma_auction j0
                                 LEFT OUTER JOIN ref_status s on(j0.auction_sts=s.id)
                             WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                             
                    $application_data=$this->db->query($str)->row();

                    $checker_id = $application_data->ack_by;
                  
                    $str1 = "SELECT  j0.email_address FROM users_info j0 WHERE j0.data_status = '1' AND j0.id= '".$checker_id."' LIMIT 1";
                    $checker_info=$this->db->query($str1)->row();
                    
                    if (!empty($checker_info->email_address) && $checker_info->email_address != null) {
                       $subject="Request for Approval";
                       $req_type=$application_data->auction_sts;
                       $subject.=" [".$req_type."] (".date('l, M d, Y h:i:s A').')';
                       $message = "<div style='font-family:calibri !important'>Dear Concern,<br/><br/>
                        A request is waiting for your approval.<br/><br/>
                        Request Type: ".$req_type."<br/>
                        Request by: ".$this->session->userdata['ast_user']['user_name']." (".$this->session->userdata['ast_user']['user_full_id']."), <br/>
                        Request Date & Time: ".date('l, M d, Y h:i:s A')." <br/><br/>
                        Please login to  <a href=".base_url().">LMS Application</a>  to approve the request.<br/><br/> 
                        This is a system generated email, no need to reply.<br/><br/>  
                        Thanks</div>";
                        $m=$this->send_email("enayet.ullah@mmtvbd.com", "LMS", $checker_info->email_address, $subject,$message);
                        
                        //echo $m;exit;
                    }
                }
            }
            $data2 = $this->user_model->user_activities(20,'auction',$this->input->post('deleteEventId'),'cma_auction','Return Memo('.$this->input->post('deleteEventId').')',$_POST['return_reason']);
        }
        if($this->input->post('type')=='update_bidder'){
            //Verify Paper notice
            $data = array('selected'=>1,'select_by'=> $this->session->userdata['ast_user']['user_id'], 'select_dt'=>date('Y-m-d H:i:s'));
            $this->db->where('id', $_POST['bidder']);
            $this->db->update('cma_auction_bidder', $data);
            $data = array('auction_sts'=>33);
            $this->db->where('id', $_POST['deleteEventId']);
            $this->db->update('cma_auction', $data);
            $data = array('cma_sts'=>33);
            $this->db->where('id', $_POST['cma_id']);
            $this->db->update('cma', $data);
            $data2 = $this->user_model->user_activities(33,'auction',$_POST['cma_id'],'cma_auction','Update Bidder And Complete Auction ('.$_POST['cma_id'].')');
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