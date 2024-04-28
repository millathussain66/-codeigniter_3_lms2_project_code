<?php
class Cma_rt_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	}
	function get_daily_report_data()
	{

		$ToDate = trim($this->input->post('ToDate')); 
		$FromDate = trim($this->input->post('FromDate')); 
		$appFromDate = trim($this->input->post('appFromDate')); 
		$appToDate = trim($this->input->post('appToDate')); 
		$region_id = trim($this->input->post('region_id'));
		$status_id = trim($this->input->post('status_id'));
		$territory = trim($this->input->post('territory'));
		$district = trim($this->input->post('district'));
		$unit_office = trim($this->input->post('unit_office'));
		$proposed_type = trim($this->input->post('proposed_type'));
		$limit = trim($this->input->post('limit'));

		$where='j0.sts=1';
		if($ToDate != '' && $FromDate!=''){
          $where .=' and DATE(j0.e_dt) between "'.implode('-',array_reverse(explode('/',$FromDate))).'" 
               and "'.implode('-',array_reverse(explode('/',$ToDate))).'"  '; 
        }
        if($appFromDate != '' && $appToDate!=''){
          $where .=' and DATE(j0.rec_dt) between "'.implode('-',array_reverse(explode('/',$appFromDate))).'" 
               and "'.implode('-',array_reverse(explode('/',$appToDate))).'"  '; 
        }
        if($proposed_type!=''){
        	$where .=" and j0.proposed_type=".$this->db->escape($proposed_type); 
        }
        if ($region_id != '0') {
            $where .=' and j0.region='.$this->db->escape($region_id); 
        }
        if ($status_id != '0') {
            $where .=' and j0.cma_sts='.$this->db->escape($status_id); 
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
        
		$this->db
			->select("j0.*,j0.cma_sts as sts,j15.name as cma_sts,CONCAT(j13.name,' (',j13.code,')') as branch_sol,
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
			->join("ref_loan_segment as j7", "j0.loan_segment=j7.code", "left")
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
			->where($where,NULL,FALSE);
			$this->db->order_by('j0.id','desc');
			if($limit!='All'){
				$this->db->limit($limit); 
			}
    		
		return  $this->db->get()->result();
		
	}
	function get_xl_daily_report_data(){
		$ToDate = implode('-',array_reverse(explode('/',trim($this->input->post('ToDate'))))); 
		$FromDate = implode('-',array_reverse(explode('/',trim($this->input->post('FromDate'))))); 
		$appFromDate = implode('-',array_reverse(explode('/',trim($this->input->post('appFromDate'))))); 
		$appToDate = implode('-',array_reverse(explode('/',trim($this->input->post('appToDate'))))); 
		$region_id = trim($this->input->post('region_id'));
		$status_id = trim($this->input->post('status_id'));
		$territory = trim($this->input->post('territory'));
		$district = trim($this->input->post('district'));
		$unit_office = trim($this->input->post('unit_office'));
		$limit = trim($this->input->post('limit'));
		$proposed_type = trim($this->input->post('proposed_type'));

		$where='j0.sts=1';
		if($ToDate != '' && $FromDate!=''){
          $where .=' and DATE(j0.e_dt) between '.$this->db->escape($FromDate).' 
               and '.$this->db->escape($ToDate); 
        }
        if($appFromDate != '' && $appToDate!=''){
          $where .=' and DATE(j0.rec_dt) between '.$this->db->escape($appFromDate).' 
               and '.$this->db->escape($appToDate); 
        }
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
            $where .=' and j0.cma_sts='.$this->db->escape($status_id); 
        }
        
		$this->db
			->select("j0.*,auc.name as pre_auc_sts,a.auction_sts,j0.cma_sts as sts,j15.name as cma_sts,CONCAT(j13.name,' (',j13.code,')') as branch_sol,
				j1.name as region_name,j2.name as territory_name,j3.name as district_name,
				j4.name as unit_office_name,r2.name as legal_region_name,
				j6.name as subject_name,j7.name as loan_segment,j8.name as e_by,
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
				CONCAT(j25.name,' (',j25.pin,')') as auction_complete_by,
				IF(DATE_FORMAT(j0.e_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.e_dt,'%Y-%m-%d'),'') AS e_dt,r.name as req_type,
				IF(DATE_FORMAT(j0.loan_sanction_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.loan_sanction_dt,'%Y-%m-%d'),'') AS loan_sanction_dt,
				IF(DATE_FORMAT(j0.stc_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.stc_dt,'%Y-%m-%d'),'') AS stc_dt,
				IF(DATE_FORMAT(j0.pre_case_fill_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.pre_case_fill_dt,'%Y-%m-%d'),'') AS pre_case_fill_dt,
				IF(DATE_FORMAT(j0.last_payment_date,'%d%m%Y') != 0,DATE_FORMAT(j0.last_payment_date,'%Y-%m-%d'),'') AS last_payment_date,
				IF(DATE_FORMAT(j0.call_up_serv_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.call_up_serv_dt,'%Y-%m-%d'),'') AS call_up_serv_dt,
				IF(DATE_FORMAT(j0.return_dt_rm,'%d%m%Y') != 0,DATE_FORMAT(j0.return_dt_rm,'%Y-%m-%d'),'') AS r_dt,
				IF(DATE_FORMAT(j0.reject_dt_rm,'%d%m%Y') != 0,DATE_FORMAT(j0.reject_dt_rm,'%Y-%m-%d'),'') AS reject_dt_rm,
				IF(DATE_FORMAT(j0.ack_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.ack_dt,'%Y-%m-%d'),'') AS ack_dt,
				IF(DATE_FORMAT(j0.hold_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.hold_dt,'%Y-%m-%d'),'') AS hold_dt,
				IF(DATE_FORMAT(j0.chq_expiry_date,'%d%m%Y') != 0,DATE_FORMAT(j0.chq_expiry_date,'%Y-%m-%d'),'') AS chq_expiry_date,
				IF(DATE_FORMAT(j0.sth_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.sth_dt,'%Y-%m-%d'),'') AS sth_dt,
				IF(DATE_FORMAT(j0.q_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.q_dt,'%Y-%m-%d'),'') AS q_dt,
				IF(DATE_FORMAT(j0.ho_r_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.ho_r_dt,'%Y-%m-%d'),'') AS ho_r_dt,
				IF(DATE_FORMAT(j0.v_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.v_dt,'%Y-%m-%d'),'') AS v_dt,
				IF(DATE_FORMAT(j0.call_up_serv_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.call_up_serv_dt,'%Y-%m-%d'),'') AS call_up_serv_dt,
				IF(DATE_FORMAT(j0.ack_dt,'%d%m%Y') != 0,DATE_FORMAT(a.ack_dt,'%Y-%m-%d'),'') AS auction_complete_dt,
				IF(DATE_FORMAT(j0.holm_r_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.holm_r_dt,'%Y-%m-%d'),'') AS holm_r_dt,
				IF(DATE_FORMAT(j0.ho_decline_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.ho_decline_dt,'%Y-%m-%d'),'') AS ho_decline_dt,
				IF(DATE_FORMAT(j0.rec_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.rec_dt,'%Y-%m-%d'),'') AS rec_dt", FALSE)
			->from('cma as j0')
			->join('ref_auc_sts as auc', 'j0.pre_auc_sts=auc.id', 'left')
			->join('cma_auction as a', 'j0.id=a.cma_id', 'left')
			->join("users_info as j25", "a.ack_by=j25.id", "left")
			->join('ref_req_type as r', 'j0.req_type=r.id', 'left')
			->join("ref_region as j1", "j0.region=j1.id", "left")
			->join("ref_region as r2", "j0.legal_region=r2.id", "left")
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
			->where($where,NULL,FALSE);
			$this->db->order_by('j0.id','desc');
    		if($limit!='All'){
				$this->db->limit($limit); 
			}
			$query = $this->db->get()->result_array();



			foreach($query as $i=>$product) {
				$this->db->select("g.*,IF(g.guar_sts='', ' ', s.name) as guar_sts_name,
			IF(g.guarantor_type='', ' ', t.name) as type_name,
			IF(g.occ_sts='', ' ', o.name) as occ_sts_name");
				$this->db->from('cma_guarantor as g');
				$this->db->join("ref_guar_type as t", "g.guarantor_type=t.code", "left OUTER");
				$this->db->join("ref_guar_sts as s", "g.guar_sts=s.id", "left OUTER");
				$this->db->join("ref_guar_occ as o", "g.occ_sts=o.code", "left OUTER");
				$this->db->where('g.cma_id', $product['id']);
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
					IF(DATE_FORMAT(f0.disbursement_date,'%d%m%Y') != 0,date_format(f0.disbursement_date,'%Y-%m-%d'),'') as disbursement_date,
					IF(DATE_FORMAT(f0.write_off_dt,'%d%m%Y') != 0,date_format(f0.write_off_dt,'%Y-%m-%d'),'') as write_off_dt");
					$this->db->from('cma_facility as f0');
					$this->db->join("ref_facility_name as f1", "f0.facility_type=f1.code", "left OUTER");
					$this->db->where('f0.cma_id', $product['id']);
					$this->db->where('f0.sts', '1');
					$this->db->where('f0.section_type', 'loan');
					
			   		$images_query = $this->db->get()->result_array();
			   		$query[$i]['facility_loan'] = $images_query;

				}
				
			}
		return  $query;
	}

}
?>