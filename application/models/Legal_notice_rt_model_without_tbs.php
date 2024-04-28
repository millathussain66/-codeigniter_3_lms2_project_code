<?php
class Legal_notice_rt_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	}
	function get_daily_report_data()
	{
		$ToDate = $this->security->xss_clean(trim($this->input->post('ToDate'))); 
		$FromDate = $this->security->xss_clean(trim($this->input->post('FromDate'))); 
		//$appFromDate = $this->security->xss_clean(trim($this->input->post('appFromDate'))); 
		//$appToDate = $this->security->xss_clean(trim($this->input->post('appToDate'))); 
		$region_id = $this->security->xss_clean(trim($this->input->post('region_id')));
		$status_id = $this->security->xss_clean(trim($this->input->post('status_id')));
		$territory = $this->security->xss_clean(trim($this->input->post('territory')));
		$district = $this->security->xss_clean(trim($this->input->post('district')));
		$unit_office = $this->security->xss_clean(trim($this->input->post('unit_office')));
		$limit = $this->security->xss_clean(trim($this->input->post('limit')));

		$proposed_type = $this->security->xss_clean(trim($this->input->post('proposed_type')));

		$where='j0.sts=1';
		if($status_id==1){
			$col_name='e_dt';
		}else if($status_id==2){
			$col_name='stc_dt';
		}else if($status_id==3){
			$col_name='rec_dt';
		}else if($status_id==4){
			$col_name='return_dt_rm';
		}else if($status_id==5){
			$col_name='reject_dt_rm';
		}else if($status_id==6){
			$col_name='ack_dt';
		}else if($status_id==7){
			$col_name='hold_dt';
		}else if($status_id==8){
			$col_name='q_dt';
		}else if($status_id==9){
			$col_name='ho_r_dt';
		}else if($status_id==10){
			$col_name='sth_dt';
		}else if($status_id==11){
			$col_name='holm_r_dt';
		}else if($status_id==12){
			$col_name='ho_decline_dt';
		}else if($status_id==13){
			$col_name='v_dt';
		}else if($status_id==14){
			$col_name='legal_notice_s_dt';
		}else {
			$col_name='e_dt';
		}
		if($ToDate != '' && $FromDate!=''){
          $where .=' and DATE(j0.'.$col_name.') between "'.implode('-',array_reverse(explode('/',(string) $FromDate))).'" 
               and "'.implode('-',array_reverse(explode('/',(string) $ToDate))).'"  '; 
        }
        /*if($appToDate != '' && $appFromDate!=''){
          $where .=' and DATE(j0.rec_dt) between "'.implode('-',array_reverse(explode('/',$appFromDate))).'" 
               and "'.implode('-',array_reverse(explode('/',$appToDate))).'"  '; 
        }*/
        if($proposed_type!=''){
        	$where .=" and j0.proposed_type=".$this->db->escape($proposed_type); 
        }

        if ($region_id != '0') {
            $where .=' and j0.region='.$this->db->escape($region_id); 
        }
        if ($territory != '') {
            $where .=' and j0.territory='.$this->db->escape($territory); 
        }
        if ($district != '') {
            $where .=' and j0.district='.$this->db->escape($district); 
        }
        if ($unit_office != '') {
            $where .=' and j0.unit_office='.$this->db->escape($unit_office); 
        }
        if ($status_id != '0') {
            $where .=' and j0.legal_notice_sts='.$this->db->escape($status_id); 
        }

		$this->db
			->select("j0.*,j0.legal_notice_sts as sts,j15.name as legal_notice_sts,CONCAT(j13.name,' (',j13.code,')') as branch_sol,br.adress_field,br.br_counter,br.adress,
				j1.name as region_name,j2.name as territory_name,j3.name as district_name,
				j4.name as unit_office_name,j25.name as lawyer,
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
			->from('legal_notice as j0')
			->join('ln_address_by_br_serial as br', 'j0.id=br.ln_id', 'left')
			->join('ref_req_type as r', 'j0.req_type=r.id', 'left')
			->join("ref_region as j1", "j0.region=j1.id", "left")
			->join("ref_territory as j2", "j0.territory=j2.id", "left")
			->join("ref_district as j3", "j0.district=j3.id", "left")
			->join("ref_unit_office as j4", "j0.unit_office=j4.id", "left")
			->join("ref_subject_type as j6", "j0.sub_type=j6.id", "left")
			->join("ref_loan_segment as j7", "j0.loan_segment=j7.code", "left")
			->join("users_info as j8", "j0.e_by=j8.id", "left")
			->join("users_info as j9", "j0.stc_by=j9.id", "left")
			->join("users_info as j10", "j0.rec_by=j10.id", "left")
			->join("users_info as j14", "j0.return_by_rm=j14.id", "left")
			->join("ref_branch_sol as j13", "j0.branch_sol=j13.code", "left")
			->join("ref_status as j15", "j0.legal_notice_sts=j15.id", "left")
			->join("users_info as j16", "j0.reject_by_rm=j16.id", "left")
			->join("users_info as j17", "j0.ack_by=j17.id", "left")
			->join("users_info as j18", "j0.hold_by=j18.id", "left")
			->join("users_info as j19", "j0.sth_by=j19.id", "left")
			->join("users_info as j20", "j0.q_by=j20.id", "left")
			->join("users_info as j21", "j0.ho_r_by=j21.id", "left")
			->join("users_info as j22", "j0.v_by=j22.id", "left")
			->join("users_info as j23", "j0.holm_r_by=j23.id", "left")
			->join("users_info as j24", "j0.ho_decline_by=j24.id", "left")
			->join("ref_lawyer as j25", "j0.lawyer=j25.id", "left")
			->where($where,NULL,FALSE);
			$this->db->order_by('j0.id','desc');
			if($limit!='all'){
				$this->db->limit($limit); 
			}

		return $this->db->get()->result();
		//echo $this->db->last_query();
		
	}
	function get_xl_daily_report_data(){
		
		$ToDate = implode('-',array_reverse(explode('/',(string) $this->input->post($this->input->post('ToDate'))))); 
        $FromDate = implode('-',array_reverse(explode('/',(string) $this->input->post($this->input->post('FromDate')))));  
        //$appFromDate = implode('-',array_reverse(explode('/',$this->input->post($this->input->post('appFromDate'))))); 
        //$appToDate = implode('-',array_reverse(explode('/',$this->input->post($this->input->post('appToDate')))));
		$region_id = $this->security->xss_clean(trim($this->input->post('region_id')));
		$status_id = $this->security->xss_clean(trim($this->input->post('status_id')));
		$territory = $this->security->xss_clean(trim($this->input->post('territory')));
		$district = $this->security->xss_clean(trim($this->input->post('district')));
		$unit_office = $this->security->xss_clean(trim($this->input->post('unit_office')));
		$limit = $this->security->xss_clean(trim($this->input->post('limit')));
		$proposed_type = $this->security->xss_clean(trim($this->input->post('proposed_type')));

		$where='j0.sts=1';
		if($status_id==1){
			$col_name='e_dt';
		}else if($status_id==2){
			$col_name='stc_dt';
		}else if($status_id==3){
			$col_name='rec_dt';
		}else if($status_id==4){
			$col_name='return_dt_rm';
		}else if($status_id==5){
			$col_name='reject_dt_rm';
		}else if($status_id==6){
			$col_name='ack_dt';
		}else if($status_id==7){
			$col_name='hold_dt';
		}else if($status_id==8){
			$col_name='q_dt';
		}else if($status_id==9){
			$col_name='ho_r_dt';
		}else if($status_id==10){
			$col_name='sth_dt';
		}else if($status_id==11){
			$col_name='holm_r_dt';
		}else if($status_id==12){
			$col_name='ho_decline_dt';
		}else if($status_id==13){
			$col_name='v_dt';
		}else if($status_id==14){
			$col_name='legal_notice_s_dt';
		}else {
			$col_name='e_dt';
		}
		if($ToDate != '' && $FromDate!=''){
          $where .=' and DATE(j0.'.$col_name.') between "'.implode('-',array_reverse(explode('/',(string) $FromDate))).'" 
               and "'.implode('-',array_reverse(explode('/',(string) $ToDate))).'"  '; 
        }
		
        /*if($appToDate != '' && $appFromDate!=''){
          $where .=' and DATE(j0.rec_dt) between '.$this->db->escape($appFromDate).' 
               and '.$this->db->escape($appToDate);  
        }*/
        if($proposed_type!=''){
        	$where .=' and j0.proposed_type='.$this->db->escape($proposed_type); 
        }
        if ($region_id != 0) {
            $where .=' and j0.region='.$this->db->escape($region_id); 
        }
        if ($territory != '') {
            $where .=' and j0.territory='.$this->db->escape($territory); 
        }
        if ($district != '') {
            $where .=' and j0.district='.$this->db->escape($district); 
        }
        if ($unit_office != '') {
            $where .=' and j0.unit_office='.$this->db->escape($unit_office); 
        }
        if ($status_id != 0) {
            $where .=' and j0.legal_notice_sts='.$this->db->escape($status_id); 
        }
        



		$this->db
			->select("j0.*,j0.legal_notice_sts as sts,j15.name as legal_notice_sts,CONCAT(j13.name,' (',j13.code,')') as branch_sol,
				j1.name as region_name,j2.name as territory_name,j3.name as district_name,
				j4.name as unit_office_name,j26.name as lawyer_name,
				j6.name as subject_name,j7.name as loan_segment,
				CONCAT(j8.name,' (',j8.pin,')') as e_by,
				CONCAT(j9.name,' (',j9.pin,')') as stc_by,
				CONCAT(j10.name,' (',j10.pin,')') as rec_by,
				CONCAT(j14.name,' (',j14.pin,')') as r_by,
				CONCAT(j16.name,' (',j16.pin,')') as reject_by_rm,
				CONCAT(j17.name,' (',j17.pin,')') as ack_by,
				CONCAT(j18.name,' (',j18.pin,')') as hold_by,
				CONCAT(j19.name,' (',j19.pin,')') as sth_by,
				CONCAT(j20.name,' (',j20.pin,')') as q_by,
				CONCAT(j21.name,' (',j21.pin,')') as ho_r_by,
				CONCAT(j22.name,' (',j22.pin,')') as v_by,
				CONCAT(j23.name,' (',j23.pin,')') as holm_r_by,
				CONCAT(j24.name,' (',j24.pin,')') as ho_decline_by,
				CONCAT(j25.name,' (',j25.pin,')') as l_sent_by,
				IF(DATE_FORMAT(j0.call_up_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.call_up_dt,'%Y-%m-%d'),'') AS call_up_dt,
				IF(DATE_FORMAT(j0.e_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.e_dt,'%Y-%m-%d'),'') AS e_dt,r.name as req_type,
				IF(DATE_FORMAT(j0.stc_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.stc_dt,'%Y-%m-%d'),'') AS stc_dt,
				IF(DATE_FORMAT(j0.return_dt_rm,'%d%m%Y') != 0,DATE_FORMAT(j0.return_dt_rm,'%Y-%m-%d'),'') AS r_dt,
				IF(DATE_FORMAT(j0.reject_dt_rm,'%d%m%Y') != 0,DATE_FORMAT(j0.reject_dt_rm,'%Y-%m-%d'),'') AS reject_dt_rm,
				IF(DATE_FORMAT(j0.ack_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.ack_dt,'%Y-%m-%d'),'') AS ack_dt,
				IF(DATE_FORMAT(j0.hold_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.hold_dt,'%Y-%m-%d'),'') AS hold_dt,
				IF(DATE_FORMAT(j0.sth_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.sth_dt,'%Y-%m-%d'),'') AS sth_dt,
				IF(DATE_FORMAT(j0.q_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.q_dt,'%Y-%m-%d'),'') AS q_dt,
				IF(DATE_FORMAT(j0.ho_r_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.ho_r_dt,'%Y-%m-%d'),'') AS ho_r_dt,
				IF(DATE_FORMAT(j0.v_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.v_dt,'%Y-%m-%d'),'') AS v_dt,
				IF(DATE_FORMAT(j0.holm_r_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.holm_r_dt,'%Y-%m-%d'),'') AS holm_r_dt,
				IF(DATE_FORMAT(j0.ho_decline_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.ho_decline_dt,'%Y-%m-%d'),'') AS ho_decline_dt,
				IF(DATE_FORMAT(j0.legal_notice_s_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.legal_notice_s_dt,'%Y-%m-%d'),'') AS legal_notice_s_dt,
				IF(DATE_FORMAT(j0.rec_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.rec_dt,'%Y-%m-%d'),'') AS rec_dt", FALSE)
			->from('legal_notice as j0')
			->join('ref_req_type as r', 'j0.req_type=r.id', 'left')
			->join("ref_region as j1", "j0.region=j1.id", "left")
			->join("ref_territory as j2", "j0.territory=j2.id", "left")
			->join("ref_district as j3", "j0.district=j3.id", "left")
			->join("ref_unit_office as j4", "j0.unit_office=j4.id", "left")
			->join("ref_subject_type as j6", "j0.sub_type=j6.id", "left")
			->join("ref_loan_segment as j7", "j0.loan_segment=j7.code", "left")
			->join("users_info as j8", "j0.e_by=j8.id", "left")
			->join("users_info as j9", "j0.stc_by=j9.id", "left")
			->join("users_info as j10", "j0.rec_by=j10.id", "left")
			->join("users_info as j14", "j0.return_by_rm=j14.id", "left")
			->join("ref_branch_sol as j13", "j0.branch_sol=j13.code", "left")
			->join("ref_status as j15", "j0.legal_notice_sts=j15.id", "left")
			->join("users_info as j16", "j0.reject_by_rm=j16.id", "left")
			->join("users_info as j17", "j0.ack_by=j17.id", "left")
			->join("users_info as j18", "j0.hold_by=j18.id", "left")
			->join("users_info as j19", "j0.sth_by=j19.id", "left")
			->join("users_info as j20", "j0.q_by=j20.id", "left")
			->join("users_info as j21", "j0.ho_r_by=j21.id", "left")
			->join("users_info as j22", "j0.v_by=j22.id", "left")
			->join("users_info as j23", "j0.holm_r_by=j23.id", "left")
			->join("users_info as j24", "j0.ho_decline_by=j24.id", "left")
			->join("users_info as j25", "j0.legal_notice_s_by=j25.id", "left")
			->join("ref_lawyer as j26", "j0.lawyer=j26.id", "left")
			->where($where,NULL,FALSE);
			$this->db->order_by('j0.id','desc');
			if($limit!='all'){
    			$this->db->limit($limit);
    		}

			$query = $this->db->get()->result_array();

			foreach($query as $i=>$product) {
				$this->db->select("g.* ,
					IF(g.guar_sts='', ' ', s.name) as guar_sts_name,
					IF(g.guarantor_type='', ' ', t.name) as type_name,
					IF(g.occ_sts='', ' ', o.name) as occ_sts_name");
				$this->db->from('legal_notice_guarantor as g');
				$this->db->join("ref_guar_type as t", "g.guarantor_type=t.code", "left OUTER");
				$this->db->join("ref_guar_sts as s", "g.guar_sts=s.id", "left OUTER");
				$this->db->join("ref_guar_occ as o", "g.occ_sts=o.code", "left OUTER");
				$this->db->where('g.legal_notice_id', $product['id']);
				$this->db->where('g.sts', '1');

		   		$images_query = $this->db->get()->result_array();
		   		$query[$i]['guarntor'] = $images_query;
			}
			foreach($query as $i=>$product) {
				if($product['proposed_type']=='Loan'){
					$this->db->select("f0.*,f1.name as facility_type_name,
					IF(DATE_FORMAT(f0.outstanding_bl_dt,'%d%m%Y') != 0,date_format(f0.outstanding_bl_dt,'%Y-%m-%d'),'') as outstanding_bl_dt,
					IF(DATE_FORMAT(f0.overdue_bl_dt,'%d%m%Y') != 0,date_format(f0.overdue_bl_dt,'%Y-%m-%d'),'') as overdue_bl_dt,
					IF(DATE_FORMAT(f0.call_up_dt,'%d%m%Y') != 0,date_format(f0.call_up_dt,'%Y-%m-%d'),'') as call_up_dt,
					IF(DATE_FORMAT(f0.expire_date,'%d%m%Y') != 0,date_format(f0.expire_date,'%Y-%m-%d'),'') as expire_date,
					IF(DATE_FORMAT(f0.disbursement_date,'%d%m%Y') != 0,date_format(f0.disbursement_date,'%Y-%m-%d'),'') as disbursement_date");
					$this->db->from('legal_notice_facility as f0');
					$this->db->join("ref_facility_name as f1", "f0.facility_type=f1.code", "left OUTER");
					$this->db->where('f0.legal_notice_id', $product['id']);
					$this->db->where('f0.sts', '1');
					$this->db->where('f0.section_type', 'loan');
					
			   		$images_query = $this->db->get()->result_array();
			   		$query[$i]['facility_loan'] = $images_query;

				}else{
					$this->db->select("date_format(card_iss_date,'%Y-%m-%d') as card_iss_date,
					date_format(card_exp_date,'%Y-%m-%d') as card_exp_date,
					card_limit,outstanding_bl");
					$this->db->from('legal_notice');
					$this->db->where('id', $product['id']);
					$this->db->where('sts', '1');

			   		$images_query = $this->db->get()->result_array();
			   		$query[$i]['facility'] = $images_query;
				}
			}
			return  $query;
			
			//return  $this->db->get()->result();
			
	}
	function xl_daily_report_br(){
		
		$ToDate = $this->security->xss_clean(trim($this->input->post('ToDate'))); 
		$FromDate = $this->security->xss_clean(trim($this->input->post('FromDate'))); 
		//$appFromDate = $this->security->xss_clean(trim($this->input->post('appFromDate'))); 
		//$appToDate = $this->security->xss_clean(trim($this->input->post('appToDate'))); 
		$region_id = $this->security->xss_clean(trim($this->input->post('region_id')));
		$status_id = $this->security->xss_clean(trim($this->input->post('status_id')));
		$territory = $this->security->xss_clean(trim($this->input->post('territory')));
		$district = $this->security->xss_clean(trim($this->input->post('district')));
		$unit_office = $this->security->xss_clean(trim($this->input->post('unit_office')));
		$limit = $this->security->xss_clean(trim($this->input->post('limit')));
		$proposed_type = $this->security->xss_clean(trim($this->input->post('proposed_type')));

		$where='j0.sts=1';
		if($status_id==1){
			$col_name='e_dt';
		}else if($status_id==2){
			$col_name='stc_dt';
		}else if($status_id==3){
			$col_name='rec_dt';
		}else if($status_id==4){
			$col_name='return_dt_rm';
		}else if($status_id==5){
			$col_name='reject_dt_rm';
		}else if($status_id==6){
			$col_name='ack_dt';
		}else if($status_id==7){
			$col_name='hold_dt';
		}else if($status_id==8){
			$col_name='q_dt';
		}else if($status_id==9){
			$col_name='ho_r_dt';
		}else if($status_id==10){
			$col_name='sth_dt';
		}else if($status_id==11){
			$col_name='holm_r_dt';
		}else if($status_id==12){
			$col_name='ho_decline_dt';
		}else if($status_id==13){
			$col_name='v_dt';
		}else if($status_id==14){
			$col_name='legal_notice_s_dt';
		}else {
			$col_name='e_dt';
		}
		if($ToDate != '' && $FromDate!=''){
          $where .=' and DATE(j0.'.$col_name.') between "'.implode('-',array_reverse(explode('/',(string) $FromDate))).'" 
               and "'.implode('-',array_reverse(explode('/',(string) $ToDate))).'"  '; 
        }
        /*if($appToDate != '' && $appFromDate!=''){
          $where .=' and DATE(j0.rec_dt) between '.$this->db->escape($appFromDate).' 
               and '.$this->db->escape($appToDate);  
        }*/
        if($proposed_type!=''){
        	$where .=' and j0.proposed_type='.$this->db->escape($proposed_type); 
        }
        if ($region_id != 0) {
            $where .=' and j0.region='.$this->db->escape($region_id); 
        }
        if ($territory != '') {
            $where .=' and j0.territory='.$this->db->escape($territory); 
        }
        if ($district != '') {
            $where .=' and j0.district='.$this->db->escape($district); 
        }
        if ($unit_office != '') {
            $where .=' and j0.unit_office='.$this->db->escape($unit_office); 
        }
        if ($status_id != 0) {
            $where .=' and j0.legal_notice_sts='.$this->db->escape($status_id); 
        }
        
		$this->db
			->select("j0.*,j0.legal_notice_sts as sts,j15.name as legal_notice_sts,CONCAT(j13.name,' (',j13.code,')') as branch_sol,br.adress_field,br.br_counter,br.adress,
				j1.name as region_name,j2.name as territory_name,j3.name as district_name,
				j4.name as unit_office_name,j26.name as lawyer_name,
				IF(g.guarantor_type='', '', t.name) as type_name,
				j6.name as subject_name,j7.name as loan_segment,
				CONCAT(j8.name,' (',j8.pin,')') as e_by,
				CONCAT(j9.name,' (',j9.pin,')') as stc_by,
				CONCAT(j10.name,' (',j10.pin,')') as rec_by,
				CONCAT(j14.name,' (',j14.pin,')') as r_by,
				CONCAT(j16.name,' (',j16.pin,')') as reject_by_rm,
				CONCAT(j17.name,' (',j17.pin,')') as ack_by,
				CONCAT(j18.name,' (',j18.pin,')') as hold_by,
				CONCAT(j19.name,' (',j19.pin,')') as sth_by,
				CONCAT(j20.name,' (',j20.pin,')') as q_by,
				CONCAT(j21.name,' (',j21.pin,')') as ho_r_by,
				CONCAT(j22.name,' (',j22.pin,')') as v_by,
				CONCAT(j23.name,' (',j23.pin,')') as holm_r_by,
				CONCAT(j24.name,' (',j24.pin,')') as ho_decline_by,
				CONCAT(j25.name,' (',j25.pin,')') as l_sent_by,
				IF(DATE_FORMAT(j0.call_up_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.call_up_dt,'%Y-%m-%d'),'') AS call_up_dt,
				IF(DATE_FORMAT(j0.e_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.e_dt,'%Y-%m-%d'),'') AS e_dt,r.name as req_type,
				IF(DATE_FORMAT(j0.stc_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.stc_dt,'%Y-%m-%d'),'') AS stc_dt,
				IF(DATE_FORMAT(j0.return_dt_rm,'%d%m%Y') != 0,DATE_FORMAT(j0.return_dt_rm,'%Y-%m-%d'),'') AS r_dt,
				IF(DATE_FORMAT(j0.reject_dt_rm,'%d%m%Y') != 0,DATE_FORMAT(j0.reject_dt_rm,'%Y-%m-%d'),'') AS reject_dt_rm,
				IF(DATE_FORMAT(j0.ack_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.ack_dt,'%Y-%m-%d'),'') AS ack_dt,
				IF(DATE_FORMAT(j0.hold_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.hold_dt,'%Y-%m-%d'),'') AS hold_dt,
				IF(DATE_FORMAT(j0.sth_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.sth_dt,'%Y-%m-%d'),'') AS sth_dt,
				IF(DATE_FORMAT(j0.q_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.q_dt,'%Y-%m-%d'),'') AS q_dt,
				IF(DATE_FORMAT(j0.ho_r_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.ho_r_dt,'%Y-%m-%d'),'') AS ho_r_dt,
				IF(DATE_FORMAT(j0.v_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.v_dt,'%Y-%m-%d'),'') AS v_dt,
				IF(DATE_FORMAT(j0.holm_r_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.holm_r_dt,'%Y-%m-%d'),'') AS holm_r_dt,
				IF(DATE_FORMAT(j0.ho_decline_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.ho_decline_dt,'%Y-%m-%d'),'') AS ho_decline_dt,
				IF(DATE_FORMAT(j0.legal_notice_s_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.legal_notice_s_dt,'%Y-%m-%d'),'') AS legal_notice_s_dt,
				IF(DATE_FORMAT(j0.rec_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.rec_dt,'%Y-%m-%d'),'') AS rec_dt", FALSE)
			->from('legal_notice as j0')
			->join('ln_address_by_br_serial as br', 'j0.id=br.ln_id', 'left')
			->join('legal_notice_guarantor as g','g.id=br.guarantor_id', 'left')
			->join("ref_guar_type as t", "g.guarantor_type=t.code", "left OUTER")
			->join('ref_req_type as r', 'j0.req_type=r.id', 'left')
			->join("ref_region as j1", "j0.region=j1.id", "left")
			->join("ref_territory as j2", "j0.territory=j2.id", "left")
			->join("ref_district as j3", "j0.district=j3.id", "left")
			->join("ref_unit_office as j4", "j0.unit_office=j4.id", "left")
			->join("ref_subject_type as j6", "j0.sub_type=j6.id", "left")
			->join("ref_loan_segment as j7", "j0.loan_segment=j7.code", "left")
			->join("users_info as j8", "j0.e_by=j8.id", "left")
			->join("users_info as j9", "j0.stc_by=j9.id", "left")
			->join("users_info as j10", "j0.rec_by=j10.id", "left")
			->join("users_info as j14", "j0.return_by_rm=j14.id", "left")
			->join("ref_branch_sol as j13", "j0.branch_sol=j13.code", "left")
			->join("ref_status as j15", "j0.legal_notice_sts=j15.id", "left")
			->join("users_info as j16", "j0.reject_by_rm=j16.id", "left")
			->join("users_info as j17", "j0.ack_by=j17.id", "left")
			->join("users_info as j18", "j0.hold_by=j18.id", "left")
			->join("users_info as j19", "j0.sth_by=j19.id", "left")
			->join("users_info as j20", "j0.q_by=j20.id", "left")
			->join("users_info as j21", "j0.ho_r_by=j21.id", "left")
			->join("users_info as j22", "j0.v_by=j22.id", "left")
			->join("users_info as j23", "j0.holm_r_by=j23.id", "left")
			->join("users_info as j24", "j0.ho_decline_by=j24.id", "left")
			->join("users_info as j25", "j0.legal_notice_s_by=j25.id", "left")
			->join("ref_lawyer as j26", "j0.lawyer=j26.id", "left")
			->where($where,NULL,FALSE);
			$this->db->order_by('j0.id','desc');
			if($limit!='all'){
    			$this->db->limit($limit);
    		}

			$query = $this->db->get()->result_array();
			
			return  $query;
			
			//return  $this->db->get()->result();
			
	}

}
?>