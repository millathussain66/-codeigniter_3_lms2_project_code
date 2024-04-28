<?php
class Wa_rt_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
	}

	function execution_rt(){
		$where = "e.sts=1 AND e.v_sts=38";

		if(trim($this->input->post('case_type')) != '')
		{ $where.= " AND s.req_type='".trim($this->input->post('case_type'))."'"; }

		if(trim($this->input->post('s_case_number')) != '')
		{ $where.= " AND s.case_number='".trim($this->input->post('s_case_number'))."'"; }
		if(trim($this->input->post('s_proposed_type')) != '')
		{ $where.= " AND s.proposed_type='".trim($this->input->post('s_proposed_type'))."'"; }
		if($this->input->post('s_account')!=''){
			if($this->input->post('s_proposed_type')=='Card'){
		    	$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->post('hidden_loan_ac')));

		    	$where.= " AND s.org_loan_ac='".$card."'"; 
		    }else{
		    	$where.= " AND s.loan_ac='".trim($this->input->post('s_account'))."'";
		    }
		}

		$sql = "SELECT e.*,IF(e.status = 1, 'Pending', 'Setteled') AS fsts, s.id AS suit_id, s.proposed_type,s.loan_ac,s.org_loan_ac,s.ac_name,s.case_number,s.case_claim_amount,rq.name AS req_type,ls.name AS loan_segment,rg.name AS region,tr.name AS territory,ds.name AS district,n.name AS case_n,a.name AS arrested_by,w.name AS na_wa,d.name AS disposal_sts ,ge.guarantor_name,eb.executed_dt,eb.remarks,
			IF(tor.executor IS NULL,tor.executor_pin,u.pin) AS pin,
  			IF(tor.executor IS NULL,tor.executor_name,u.name) AS executor_name
		FROM
		file_executed_data e 
  		LEFT JOIN suit_filling_info s ON s.id = e.file_id
  		LEFT JOIN ref_case_name n ON n.id = s.case_name 
  		LEFT JOIN ref_arrested_by a ON a.id = e.arrested_by 
  		LEFT JOIN ref_nature_warrent_arrest w ON w.id = e.nature_wa 
  		LEFT JOIN file_executed_by AS eb ON eb.executed_id=e.id 
  		LEFT JOIN cma_guarantor AS ge ON ge.id = eb.who_executed
  		LEFT JOIN file_executor AS tor ON tor.executed_id=e.id
  		LEFT JOIN users_info AS u ON u.id = tor.executor
  		LEFT JOIN ref_disposal_sts d ON d.id = e.wa_status 
  		LEFT JOIN ref_req_type AS rq ON rq.id = s.req_type
  		LEFT JOIN ref_loan_segment AS ls ON ls.code = s.loan_segment
  		LEFT JOIN ref_region AS rg ON rg.id = s.region
  		LEFT JOIN ref_territory AS tr ON tr.id= s.territory
  		LEFT JOIN ref_district AS ds ON ds.id=s.district
		WHERE ".$where;

		// for group concat
		/*LEFT JOIN ( SELECT GROUP_CONCAT(ge.guarantor_name SEPARATOR ',') AS gname,eb.executed_id FROM file_executed_by AS eb  
			LEFT JOIN cma_guarantor AS ge ON ge.id = eb.who_executed
			GROUP BY eb.executed_id
  		) AS ddd ON ddd.executed_id = e.id
  		
  		LEFT JOIN ( SELECT 
  			GROUP_CONCAT(IF(tor.executor IS NULL,tor.executor_pin,u.pin) SEPARATOR ',') AS pins,
  			GROUP_CONCAT(IF(tor.executor IS NULL,tor.executor_name,u.name) SEPARATOR ',') AS executor_name, tor.executed_id 
			FROM file_executor AS tor  
			LEFT JOIN users_info AS u ON u.id = tor.executor
			GROUP BY tor.executed_id
		  ) AS j0 ON j0.executed_id = e.id*/

		$q=$this->db->query($sql);
		$suit_row = $q->result();
		/*echo '<pre>';
		print_r($suit_row);
		echo '</pre>';*/
		return $suit_row;
	}

	function execution_incentive_rt(){
		$where = "e.sts=1 AND e.v_sts=38";
		if(trim($this->input->post('case_type')) != '')
		{ $where.= " AND s.req_type='".trim($this->input->post('case_type'))."'"; }
	
		if(trim($this->input->post('s_case_number')) != '')
		{ $where.= " AND s.case_number='".trim($this->input->post('s_case_number'))."'"; }
		if(trim($this->input->post('s_proposed_type')) != '')
		{ $where.= " AND s.proposed_type='".trim($this->input->post('s_proposed_type'))."'"; }
		if($this->input->post('s_account')!=''){
			if($this->input->post('s_proposed_type')=='Card'){
		    	$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->post('hidden_loan_ac')));

		    	$where.= " AND s.org_loan_ac='".$card."'"; 
		    }else{
		    	$where.= " AND s.loan_ac='".trim($this->input->post('s_account'))."'";
		    }
		}
		
		$sql = "SELECT e.*,IF(e.status = 1, 'Pending', 'Setteled') AS fsts,DATE_FORMAT(s.filling_date,'%d-%m-%Y') as filling_date, s.id AS suit_id, s.proposed_type,s.loan_ac,s.org_loan_ac,s.ac_name,s.case_number,s.case_claim_amount,rq.name AS req_type,ls.name AS loan_segment,rg.name AS region,tr.name AS territory,ds.name AS district,n.name AS case_n,a.name AS arrested_by,w.name AS na_wa,d.name AS disposal_sts ,ddd.gname,v.name as v_name,eby.name as e_name,ext.num_tor,ext.amount
			
		FROM
		file_executed_data e 
  		LEFT JOIN suit_filling_info s ON s.id = e.file_id
  		LEFT JOIN ref_case_name n ON n.id = s.case_name 
  		LEFT JOIN ref_arrested_by a ON a.id = e.arrested_by 
  		LEFT JOIN ref_nature_warrent_arrest w ON w.id = e.nature_wa 
  		LEFT JOIN ( SELECT GROUP_CONCAT(ge.guarantor_name SEPARATOR ',') AS gname,eb.executed_id FROM file_executed_by AS eb  
			LEFT JOIN cma_guarantor AS ge ON ge.id = eb.who_executed
			GROUP BY eb.executed_id
  		) AS ddd ON ddd.executed_id = e.id
  		LEFT JOIN (SELECT COUNT(et.executed_id) AS num_tor,sum(et.amount) as amount,et.executed_id FROM file_executor et GROUP BY et.executed_id
  		) AS ext ON ext.executed_id = e.id
  		LEFT JOIN ref_disposal_sts d ON d.id = e.wa_status 
  		LEFT JOIN ref_req_type AS rq ON rq.id = s.req_type
  		LEFT JOIN ref_loan_segment AS ls ON ls.code = s.loan_segment
  		LEFT JOIN ref_region AS rg ON rg.id = s.region
  		LEFT JOIN ref_territory AS tr ON tr.id= s.territory
  		LEFT JOIN ref_district AS ds ON ds.id=s.district
  		LEFT JOIN users_info AS v ON v.id=e.v_by
  		LEFT JOIN users_info AS eby ON eby.id=e.e_by
		WHERE ".$where;

		// for group concat
		/*LEFT JOIN ( SELECT GROUP_CONCAT(ge.guarantor_name SEPARATOR ',') AS gname,eb.executed_id FROM file_executed_by AS eb  
			LEFT JOIN cma_guarantor AS ge ON ge.id = eb.who_executed
			GROUP BY eb.executed_id
  		) AS ddd ON ddd.executed_id = e.id
  		
  		LEFT JOIN ( SELECT 
  			GROUP_CONCAT(IF(tor.executor IS NULL,tor.executor_pin,u.pin) SEPARATOR ',') AS pins,
  			GROUP_CONCAT(IF(tor.executor IS NULL,tor.executor_name,u.name) SEPARATOR ',') AS executor_name, tor.executed_id 
			FROM file_executor AS tor  
			LEFT JOIN users_info AS u ON u.id = tor.executor
			GROUP BY tor.executed_id
		  ) AS j0 ON j0.executed_id = e.id*/

		$q=$this->db->query($sql);
		$result = $q->result_array();
		$count_max_executor=1;
		foreach($result as $key=>$value){
			if($value['num_tor']>$count_max_executor){
				$count_max_executor=$value['num_tor'];
			}
			
		}

		foreach($result as $key=>$value){
			$this->db->select("IF(tor.executor IS NULL,tor.executor_pin,u.pin) AS pin,
  			IF(tor.executor IS NULL,tor.executor_name,u.name) AS executor_name,ug.group_name,tor.amount");
			$this->db->from('file_executor as tor');
			$this->db->join("users_info as u", "u.id = tor.executor", "left");
			$this->db->join("user_group as ug", "ug.id = tor.executor_type", "left");
			$this->db->where('tor.executed_id', $value['id']);
			$this->db->where('tor.sts', '1');
			
	   		$executor = $this->db->get()->result();
	   		$result[$key]['executor'] = $executor;
	   		$result[$key]['executor_max'] = $count_max_executor;
		}

		//
		
		/*echo '<pre>';
		print_r($result);
		echo '</pre>';*/
		return $result;
	}


	function month_region_rt($region,$na_wa,$month){
		//$month = $this->input->post('quarter');
		$year = $this->input->post('year');
		$sql = "SELECT 
		ex.file_id,ex.id,ex.nature_wa,ex.arrested_by,eb.who_executed,DATE_FORMAT(eb.executed_dt,'%m') AS m,
		s.region, COUNT(ex.id) AS total
		FROM `file_executed_data` AS ex
		LEFT JOIN `file_executed_by` AS eb ON ex.id = eb.`executed_id`
		LEFT JOIN suit_filling_info AS s ON s.id = ex.`file_id`
		WHERE ex.v_sts=38 AND ex.sts = 1 AND DATE_FORMAT(eb.`executed_dt`,'%Y') = ".$year." 
		AND DATE_FORMAT(eb.`executed_dt`,'%m') =".$month." AND ex.nature_wa=".$na_wa."
		AND s.region=".$region."
		GROUP BY ex.`nature_wa`,s.`region`,DATE_FORMAT(eb.`executed_dt`,'%m')";

		$q=$this->db->query($sql);
		$suit_row = $q->row();
		/*echo '<pre>';
		print_r($suit_row);
		echo '</pre>';*/
		return $suit_row;
	}

	function month_type_rt(){
		
		$sql = "SELECT GROUP_CONCAT( DISTINCT DATE_FORMAT(f.v_dt,'%M')) AS months,GROUP_CONCAT( DISTINCT DATE_FORMAT(f.v_dt,'%m')) AS m_code,
			GROUP_CONCAT( DISTINCT f.nature_wa) AS nat_id,
			GROUP_CONCAT( DISTINCT n.name) AS nature_wa,
			COUNT(CASE f.nature_wa WHEN 1 THEN DATE_FORMAT(f.v_dt,'%m') ELSE NULL END) AS total1,
			COUNT(CASE f.nature_wa WHEN 2 THEN DATE_FORMAT(f.v_dt,'%m') ELSE NULL END) AS total2,
			COUNT(CASE f.nature_wa WHEN 3 THEN DATE_FORMAT(f.v_dt,'%m') ELSE NULL END) AS total3
			FROM file_executed_data f
			LEFT JOIN ref_nature_warrent_arrest AS n ON n.id =f.nature_wa
			WHERE f.sts=1 AND f.v_sts=38 AND DATE_FORMAT(f.v_dt,'%m') IN (".$this->input->post('quarter').") AND DATE_FORMAT(f.v_dt,'%Y')='".$this->input->post('year')."'
			GROUP BY DATE_FORMAT(f.v_dt,'%m')
			ORDER BY m_code ASC";

		$q=$this->db->query($sql);
		$suit_row = $q->result();
		/*echo '<pre>';
		print_r($suit_row);
		echo '</pre>';*/
		return $suit_row;
	}


	function master_case_rt(){
		$where = "";
		if(trim($this->input->post('s_case_number')) != '')
		{ $where.= " AND s.case_number='".trim($this->input->post('s_case_number'))."'"; }
		if(trim($this->input->post('s_account')) != '')
		{ $where.= " AND s.loan_ac='".trim($this->input->post('s_account'))."'"; }
		$sql = "SELECT s.id, s.`loan_ac`,s.`proposed_type`,s.`ac_name`,cn.name AS case_name,
			s.`filling_date`,s.`case_number`,s.`case_claim_amount`,s.`prev_date`,cs.name AS case_sts_prev_dt,
			ca.name AS act_prev_date,s.`next_date`,cp.name AS case_sts_next_dt,u.name AS filling_plaintiff,u.pin AS filling_plaintiff_pin
			,u.`mobile_number` AS plaintiff_mobile,
			s.remarks_prev_date,df.`name` AS case_deal_officer, df.pin AS case_deal_officer_pin,df.`mobile_number` AS deal_mobile_number,
			l.name AS lawyer_name,nc.name AS present_court_name, pc.name AS prev_court_name,d.name AS district,
			uo.name AS unit_office,t.name AS territory,s.`final_remarks`,ls.name AS loan_segment,rg.name AS legal_region,
			ra.name AS recovery_am,DATE_FORMAT(s.`ac_close_dt`,'%Y') AS close_year,req.name AS type_case,s.customer_id,s.more_acc_number
			,IF(exd.`v_by` IS NOT NULL,ddd.executed_dt,'') AS executed_dt,IF(exd.`v_by` IS NOT NULL,'Yes','No') AS wa_exe,
			nw.name AS wa_v_by,IF(ad.deposit_amt IS NOT NULL,'Yes','No') AS deposit_amt,
			IF(ad.deposit_date IS NOT NULL,DATE_FORMAT(ad.deposit_date,'%d-%m-%y'),'') AS deposit_date, 
			IF(ad.`w_by` IS NOT NULL,'Yes','No') AS w_by,IF(ad.`w_dt` IS NOT NULL,DATE_FORMAT(ad.`w_dt`,'%d-%m-%y'),'') AS w_dt
			FROM `suit_filling_info` AS s
			LEFT JOIN `ref_case_name` AS cn ON cn.id=s.`case_name`
			LEFT JOIN `ref_case_sts` AS cs ON cs.id=s.`case_sts_prev_dt`
			LEFT JOIN `ref_case_sts` AS ca ON ca.id=s.`act_prev_date`
			LEFT JOIN `ref_case_sts` AS cp ON cp.id=s.`case_sts_next_dt`
			LEFT JOIN `users_info` AS u ON u.id = s.`filling_plaintiff`
			LEFT JOIN `users_info` AS df ON df.id = s.`case_deal_officer`
			LEFT JOIN `ref_lawyer` AS l ON l.id = s.`prest_lawyer_name`
			LEFT JOIN `ref_court` AS nc ON nc.id = s.`prest_court_name`
			LEFT JOIN `ref_court` AS pc ON pc.id = s.`prev_court_name`
			LEFT JOIN `ref_district` AS d ON d.id=s.`district`
			LEFT JOIN `ref_unit_office` AS uo ON uo.id = s.`unit_office`
			LEFT JOIN `ref_territory` AS t ON t.id =s.`territory`
			LEFT JOIN `ref_loan_segment` AS ls ON ls.code = s.loan_segment
			LEFT JOIN `ref_region` AS rg ON rg.id = s.`legal_region`
			LEFT JOIN `users_info` AS ra ON ra.id = s.`recovery_am`
			LEFT JOIN `ref_req_type` AS req ON req.id = s.`req_type`
			LEFT JOIN `file_executed_data` AS exd ON exd.`file_id` = s.`id`
			LEFT JOIN `users_info` AS nw ON nw.id = exd.`v_by`
			LEFT JOIN `appeal_deposit` AS ad ON ad.suit_id = s.id
			LEFT JOIN ( SELECT GROUP_CONCAT(eb.executed_dt SEPARATOR ',') AS executed_dt,eb.executed_id FROM file_executed_by AS eb  
				GROUP BY eb.executed_id
	  		) AS ddd ON ddd.executed_id = exd.id
			WHERE s.sts<>0 ".$where;


		$q=$this->db->query($sql);
		$suit_row = $q->result();
		/*echo '<pre>';
		print_r($suit_row);
		echo '</pre>';*/
		return $suit_row;
	}




}