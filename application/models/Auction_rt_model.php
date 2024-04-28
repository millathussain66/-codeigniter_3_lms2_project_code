<?php
class Auction_rt_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	}
	function get_daily_report_data()
	{
		$ToDate = trim((string) $this->input->post('ToDate')); 
		$FromDate = trim((string) $this->input->post('FromDate')); 
		$region_id = trim((string) $this->input->post('region_id'));
		$status_id = trim((string) $this->input->post('status_id'));
		$where='1';
		if($ToDate != '' && $FromDate!=''){
          $where .=' and DATE(j0.ack_dt) between '.$this->db->escape(implode('-',array_reverse(explode('/',$FromDate)))).' 
               and '.$this->db->escape(implode('-',array_reverse(explode('/',(string) $ToDate)))); 
        }
        if ($region_id != '0') {
            $where .=' and j0.region='.$this->db->escape($region_id).' '; 
        }
        if ($status_id != '0') {
            $where .=' and j0.auction_sts='.$this->db->escape($status_id).' '; 
        }
        if ($ToDate == '' || $FromDate=='') {
            return array();
        }
		$this->db
			->select("j0.*,c.sl_no,c.loan_ac,c.proposed_type,c.ac_name,j0.auction_sts as sts,j8.name as auction_sts,
				j1.name as region_name,j2.name as territory_name,j3.name as district_name,
				j4.name as unit_office_name,r.name as req_type,j9.name as paper_v_name,
				j7.name as loan_segment,", FALSE)
			->from('cma_auction as j0')
			->join('cma as c', 'j0.cma_id=c.id', 'left')
			->join('ref_req_type as r', 'c.req_type=r.id', 'left')
			->join("ref_region as j1", "j0.region=j1.id", "left")
			->join("ref_territory as j2", "j0.territory=j2.id", "left")
			->join("ref_district as j3", "j0.district=j3.id", "left")
			->join("ref_unit_office as j4", "j0.unit_office=j4.id", "left")
			->join("ref_loan_segment as j7", "c.loan_segment=j7.code", "left")
			->join("ref_status as j8", "j0.auction_sts=j8.id", "left")
			->join("ref_paper_vendor as j9", "j0.paper_vendor=j9.id", "left")
			->where($where,NULL,FALSE);
		return  $this->db->get()->result();
		
	}
	function get_xl_daily_report_data(){
		$ToDate = trim((string) $this->input->post('ToDate')); 
		$FromDate = trim((string) $this->input->post('FromDate')); 
		$appFromDate = trim((string) $this->input->post('appFromDate')); 
		$appToDate = trim((string) $this->input->post('appToDate')); 
		$region_id = trim((string) $this->input->post('region_id'));
		$status_id = trim((string) $this->input->post('status_id'));
		$territory = trim((string) $this->input->post('territory'));
		$district = trim((string) $this->input->post('district'));
		$unit_office = trim((string) $this->input->post('unit_office'));
		$limit = trim((string) $this->input->post('limit'));
		$proposed_type = trim((string) $this->input->post('proposed_type'));

		$where='1';
		if($ToDate != '' && $FromDate!=''){
          $where .=' and DATE(j0.ack_dt) between '.$this->db->escape(implode('-',array_reverse(explode('/',(string) $FromDate)))).' 
               and '.$this->db->escape(implode('-',array_reverse(explode('/',(string) $ToDate)))); 
        }
        if ($region_id != 0) {
            $where .=' and j0.region='.$this->db->escape($region_id).' '; 
        }
        if ($territory != '') {
            $where .=' and j0.territory='.$this->db->escape($territory).' '; 
        }
        if ($district != '') {
            $where .=' and j0.district='.$this->db->escape($district).' '; 
        }
        if ($unit_office != '') {
            $where .=' and j0.unit_office='.$this->db->escape($unit_office).' '; 
        }
        if ($status_id != 0) {
            $where .=' and j0.auction_sts='.$this->db->escape($status_id).' '; 
        }
		$this->db
			->select("
				j0.id,j0.cma_id,j0.loan_ac,j0.branch_sol,j0.region,j0.territory,j0.district,j0.unit_office,j0.paper_vendor,j0.paper_name,j0.paper_date,j0.auction_date,j0.auction_time,j0.auction_address,j0.paper_remarks,j0.legal_checker_id,j0.legal_ack_by,j0.legal_ack_dt,j0.lawyer,j0.ln_serve_dt,j0.ln_expiry_dt,j0.legal_response_by,j0.legal_response_dt,j0.auction_remarks,j0.auction_complete_by,j0.auction_complete_dt,j0.auction_sts,j0.loan_classification,j0.auction_team_remarks,j0.ack_dt,
				j1.sl_no as sl_no,j1.ac_name as loan_ac_name,j4.name as district_name,j5.name as unit_office_name,j2.name as region_name,j3.name as territory_name,j6.name as paper_vendor,j7.name as paper_name,j10.name as lawyer,j13.name as auction_sts,
				CONCAT(j8.name,' (',j8.pin,')') as legal_checker,
				CONCAT(j9.name,' (',j9.pin,')') as legal_ack_by,
				CONCAT(j11.name,' (',j11.pin,')') as legal_response_by,
				CONCAT(j12.name,' (',j12.pin,')') as auction_complete_by,
				IF(DATE_FORMAT(j0.paper_date,'%d%m%Y') != 0,DATE_FORMAT(j0.paper_date,'%Y-%m-%d'),'') AS paper_date,
				IF(DATE_FORMAT(j0.auction_date,'%d%m%Y') != 0,DATE_FORMAT(j0.auction_date,'%Y-%m-%d'),'') AS auction_date,
				IF(DATE_FORMAT(j0.legal_ack_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.legal_ack_dt,'%Y-%m-%d'),'') AS legal_ack_dt,
				IF(DATE_FORMAT(j0.ln_serve_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.ln_serve_dt,'%Y-%m-%d'),'') AS ln_serve_dt,
				IF(DATE_FORMAT(j0.ln_expiry_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.ln_expiry_dt,'%Y-%m-%d'),'') AS ln_expiry_dt,
				IF(DATE_FORMAT(j0.legal_response_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.legal_response_dt,'%Y-%m-%d'),'') AS legal_response_dt,
				IF(DATE_FORMAT(j0.auction_complete_dt,'%d%m%Y') != 0,DATE_FORMAT(j0.auction_complete_dt,'%Y-%m-%d'),'') AS auction_complete_dt,
				")
			->from('cma_auction as j0')
			->join('cma as j1', 'j1.id=j0.cma_id', 'left')
			->join('ref_region as j2', 'j2.id=j0.region', 'left')
			->join('ref_territory as j3', 'j3.id=j0.territory', 'left')
			->join('ref_district as j4', 'j4.id=j0.district', 'left')
			->join('ref_unit_office as j5', 'j5.id=j0.unit_office', 'left')
			->join('ref_paper_vendor as j6', 'j6.id=j0.paper_vendor', 'left')
			->join('ref_paper as j7', 'j7.id=j0.paper_name', 'left')
			->join("users_info as j8", "j0.legal_checker_id=j8.id", "left")
			->join("users_info as j9", "j0.legal_ack_by=j9.id", "left")
			->join("users_info as j11", "j0.legal_response_by=j11.id", "left")
			->join("users_info as j12", "j0.auction_complete_by=j12.id", "left")
			->join("ref_lawyer as j10", "j0.lawyer=j10.id", "left")
			->join("ref_status as j13", "j0.auction_sts=j13.id", "left")
			->where($where,NULL,FALSE);

			//$this->db->order_by('j0.id','desc');
    		$this->db->limit($limit);
			$query = $this->db->get()->result_array();



			foreach($query as $i=>$product) {
				$this->db->select("g.*,r.name as bidder_rank,IF(DATE_FORMAT(g.pay_order_date,'%d%m%Y') != 0,DATE_FORMAT(g.pay_order_date,'%Y-%m-%d'),'') AS pay_order_date,");
				$this->db->from('cma_auction_bidder as g');
				$this->db->join("ref_bidder_rank as r", "g.bidder_rank=r.id", "left OUTER");
				$this->db->where('g.cma_id', $product['cma_id']);
				$this->db->where('g.sts', '1');
				
		   		$images_query = $this->db->get()->result_array();
		   		$query[$i]['bidder'] = $images_query;
			}
			foreach($query as $i=>$product) {
				$this->db->select("m.*");
				$this->db->from('cma_facility_mortgage as m');
				$this->db->where('m.cma_id', $product['cma_id']);
				$this->db->where('m.sts', '1');
				
		   		$images_query = $this->db->get()->result_array();
		   		$query[$i]['mortgage'] = $images_query;
			}
			foreach($query as $i=>$product) {
				$this->db->select("s.*");
				$this->db->from('cma_facility_mortgage_security as s');
				$this->db->where('s.cma_id', $product['cma_id']);
				$this->db->where('s.sts', '1');
				
		   		$images_query = $this->db->get()->result_array();
		   		$query[$i]['mortgage_security'] = $images_query;
			}
			
		return  $query;
	}

}
?>