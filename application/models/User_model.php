<?php
class User_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model', '', TRUE);
	}


	function login($userid,$password)
	{
		$this->db->select("users_info.*, date(users_info.password_expiry_date) AS password_expiry_dates,
				 ref_designation.name as dename,ref_department.name as dept_name", FALSE)
			->from("users_info")
			->join("ref_designation", 'users_info.designation_id=ref_designation.id','LEFT')
			->join("ref_department", 'users_info.department_id=ref_department.id','LEFT')
			->where(array('user_id' => $this->db->escape($userid),'password_log'=>$this->db->escape($password)), NULL, FALSE)
			->where(" (users_info.data_status='1' OR (users_info.data_status='0' and users_info.id='1') )  ", NULL, FALSE);

		$data = $this->db->get()->row();
		return $data;
	}
	function get_unique_serial($name)
	{
		$value=$this->db->query("SELECT sqn_req_serial_fn('".$name."') as item")->result();
			foreach ($value as $key) {
				return $key->item;
			}
	}
	function get_word_serial($final_sl)
	{
		$value=$this->db->query("SELECT ln_serial('".$final_sl."') as item")->result();
			foreach ($value as $key) {
				return $key->item;
			}
	}
	function update_word_serial($final_sl)
	{
		$value=$this->db->query("SELECT ln_serial_update('".$final_sl."') as item")->result();
			foreach ($value as $key) {
				return $key->item;
			}
	}
	function get_au_serial($final_sl)
	{
		$value=$this->db->query("SELECT au_serial('".$final_sl."') as item")->result();
			foreach ($value as $key) {
				return $key->item;
			}
	}
	function update_au_serial($final_sl)
	{
		$value=$this->db->query("SELECT au_serial_update('".$final_sl."') as item")->result();
			foreach ($value as $key) {
				return $key->item;
			}
	}
  function check_user_rights()
  {
    $q = $this->db->query("SELECT menu_link_id FROM users_right WHERE user_info_id=".$this->session->userdata['ast_user']['user_id']." AND data_status=1 ")->result();

    $arr_links = array();
    foreach($q as $row)
    {
      array_push($arr_links,$row->menu_link_id);
    }
    return $arr_links;
  }
  function get_dashboard_notification()
  {
  	$module_name = $_GET['module_name'];
  	$sql="";
  	if ($module_name!='') {
  		if ($module_name==1) { //1st legal notice notification
  			$recommender_group_array = array("3","4","12","13","14","15");
		    	$checker_group_array = array("11");
		    	$maker_array = array("4");
		    	$sql="";
		    	if (check_group_by_array($recommender_group_array))//1st legal notice notification for Recommender
		    	{
		    		$where2= "Date(l.ho_r_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";//return date
		   		$where3= "Date(l.ho_decline_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";//decline date
		    		$sql="SELECT l.id,'ln' as module_name,
		  		IF(l.legal_notice_sts=2,CONCAT('Need your Recommendation for 1st legal notice issue on this A/C-',l.loan_ac),IF(l.legal_notice_sts=9,CONCAT('1st Legal Notice return, A/C-',l.loan_ac,'(',l.ho_return_reason,')'),CONCAT('1st Legal Notice Rejected, A/C-',l.loan_ac,'(',l.ho_decline_reason,')'))) as type
		    		FROM legal_notice l
		    		WHERE l.sts<>0 AND ((l.legal_notice_sts=2 AND l.checker_id=".$this->session->userdata['ast_user']['user_id'].") OR (((l.legal_notice_sts=9 or l.legal_notice_sts=12) AND l.checker_id=".$this->session->userdata['ast_user']['user_id'].")))";
		    	}
		    	else if (check_group_by_array($checker_group_array))//1st legal notice notification for HOLM
		    	{
		    		$sql="SELECT l.id,'ln' as module_name,
		  		CONCAT('Need your Approval for 1st legal notice issue on this A/C-',l.loan_ac) as type
		    		FROM legal_notice l
		    		WHERE l.sts<>0 AND l.legal_notice_sts=10 AND l.holm_checker_id=".$this->session->userdata['ast_user']['user_id'];
		    	}
		    	else if (check_group_by_array($maker_array))//1st legal notice notification for Maker
		    	{
		   		$where= "Date(l.legal_notice_s_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";
		   		$where2= "Date(l.ho_r_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";//return date
		   		$where3= "Date(l.ho_decline_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";//decline date
		    		$sql="SELECT l.id,'' as cma_id,'ln' as module_name,
		  		IF(l.legal_notice_sts=9,CONCAT('1st Legal Notice return, A/C-',l.loan_ac,'(',l.ho_return_reason,')'),IF(l.legal_notice_sts=12,CONCAT('1st Legal Notice Rejected, A/C-',l.loan_ac,'(',l.ho_decline_reason,')'),CONCAT('1st Legal Notice sent on this A/C-',l.loan_ac,'Sending Date: ',DATE_FORMAT(l.legal_notice_s_dt,'%d-%b-%y')))) as type
		    		FROM legal_notice l
		    		WHERE l.sts<>0 AND ((".$where." AND l.legal_notice_sts=14 AND l.e_by=".$this->session->userdata['ast_user']['user_id'].") OR ((((l.cma_sts=9 AND ".$where2.") or (l.cma_sts=12 AND ".$where3.")) or (l.legal_notice_sts=12 AND ".$where3.")) AND l.e_by=".$this->session->userdata['ast_user']['user_id']."))";
		    	}
		    	
  		}
  		if ($module_name==2) {//Lawyer Bill Notification
  			if (check_group(11)) {//11for ho checker
  				$sql="SELECT l.id,'bill_summery_lawyer' as module_name,
		  		CONCAT('Need Approval on ',lw.name,' Professional Bill month of ',m_join.date_f) as type
		    		FROM bill_summery l
		    		LEFT OUTER JOIN ref_lawyer lw on(lw.id=l.vendor)
		    		LEFT OUTER JOIN (
	                        SELECT sub.bill_id,GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
	                        FROM (
	                        	SELECT bill_id,txrn_dt  
	                        	FROM cost_details WHERE bill_id IS NOT NULL GROUP BY bill_id,MONTH(txrn_dt)
	                        )sub GROUP BY sub.bill_id
	                  ) m_join on(l.id=m_join.bill_id) 
		    		WHERE l.bill_type=1 AND l.sts=26";
  			}
  			if (check_group(10)) {//10for ho checker
  				$sql="SELECT l.id,'bill_summery_lawyer' as module_name,
		  		CONCAT(lw.name,' Professional Bill month of ',m_join.date_f,' has been decline/return(',l.return_reason,')') as type
		    		FROM bill_summery l
		    		LEFT OUTER JOIN ref_lawyer lw on(lw.id=l.vendor)
		    		LEFT OUTER JOIN (
	                        SELECT sub.bill_id,GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
	                        FROM (
	                        	SELECT bill_id,txrn_dt  
	                        	FROM cost_details WHERE bill_id IS NOT NULL GROUP BY bill_id,MONTH(txrn_dt)
	                        )sub GROUP BY sub.bill_id
	                  ) m_join on(l.id=m_join.bill_id) 
		    		WHERE l.bill_type=1 AND l.sts=27 AND l.memo_e_by=".$this->session->userdata['ast_user']['user_id'];
  			}
  		}
  		if ($module_name==3) {//Paper Publication Bill
  			if (check_group(11)) {//11for ho checker
  				$sql="SELECT l.id,'bill_summery_paper' as module_name,
		  		CONCAT('Need Approval on Paper Publication Bill month of ',m_join.date_f) as type
		    		FROM bill_summery l
		    		LEFT OUTER JOIN (
	                        SELECT sub.bill_id,GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
	                        FROM (
	                        	SELECT bill_id,txrn_dt  
	                        	FROM cost_details WHERE bill_id IS NOT NULL GROUP BY bill_id,MONTH(txrn_dt)
	                        )sub GROUP BY sub.bill_id
	                  ) m_join on(l.id=m_join.bill_id) 
		    		WHERE l.bill_type=2 AND l.sts=26";
  			}
  			if (check_group(10)) {//10for ho checker
  				$sql="SELECT l.id,'bill_summery_paper' as module_name,
		  		CONCAT('Paper Publication Bill month of ',m_join.date_f,' has been decline/return(',l.return_reason,')') as type
		    		FROM bill_summery l
		    		LEFT OUTER JOIN (
	                        SELECT sub.bill_id,GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
	                        FROM (
	                        	SELECT bill_id,txrn_dt  
	                        	FROM cost_details WHERE bill_id IS NOT NULL GROUP BY bill_id,MONTH(txrn_dt)
	                        )sub GROUP BY sub.bill_id
	                  ) m_join on(l.id=m_join.bill_id) 
		    		WHERE l.bill_type=2 AND l.sts=27 AND l.memo_e_by=".$this->session->userdata['ast_user']['user_id'];
  			}
  		}
  		if ($module_name==4) { //AIT & VAT HO notification
  			$start_dt=date('Y-m-d');
				$sql="SELECT a.id,'ait_vat' as module_name,
					IF(a.stc_sts=70,CONCAT(IF(a.request_from=1,l.name,p.name),' Application copy received from ',IF(a.request_from=1,l.name,p.name),' for ',c.name),CONCAT(c.name,' certificate has been uploaded in favor of ',IF(a.request_from=1,l.name,p.name))) as type
					 FROM ait_vat a
					 LEFT JOIN ref_lawyer l ON l.id=a.vendor_id AND a.request_from=1
					 LEFT JOIN ref_paper_vendor p ON p.id=a.vendor_id AND a.request_from=2
					 LEFT JOIN ref_certificate_type c ON c.id = a.certificate_type
					 WHERE DATE_FORMAT(a.ack_head_dt,'%Y-%m-%d')=CURRENT_DATE() AND a.stc_sts IN (70,96) AND a.sts<>0 AND a.e_by=".$this->session->userdata['ast_user']['user_id'];
  		}
  		if ($module_name==5) { //CMA notification
  			$recommender_group_array = array("3","4","12","13","14","15");
		    	$checker_group_array = array("11");
		    	$maker_array = array("4");
		    	$sql="";
		    	if (check_group_by_array($recommender_group_array))//CMA notification for Recommender
		    	{
		    		$where2= "Date(l.ho_r_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";//return date
		   		$where3= "Date(l.ho_decline_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";//decline date
		    		$sql="SELECT l.id,'cma' as module_name,
		  		IF(l.cma_sts=2,CONCAT('Need your Recommendation for CMA on this A/C-',l.loan_ac),IF(l.cma_sts=9,CONCAT('CMA return, A/C-',l.loan_ac,'(',l.ho_return_reason,')'),CONCAT('CMA Rejected, A/C-',l.loan_ac,'(',l.ho_decline_reason,')'))) as type
		    		FROM cma l
		    		WHERE l.sts<>0 AND ((l.cma_sts=2 AND l.checker_id=".$this->session->userdata['ast_user']['user_id'].") OR ((((l.cma_sts=9 AND ".$where2.") or (l.cma_sts=12 AND ".$where3.")) AND l.checker_id=".$this->session->userdata['ast_user']['user_id'].")))";
		    	}
		    	else if (check_group_by_array($checker_group_array))//CMA notification for HOLM
		    	{
		    		$sql="SELECT l.id,'cma' as module_name,
		  		CONCAT('Need your Approval for CMA on this A/C-',l.loan_ac) as type
		    		FROM cma l
		    		WHERE l.sts<>0 AND l.cma_sts=10 AND l.holm_checker_id=".$this->session->userdata['ast_user']['user_id'];
		    	}
		    	else if (check_group_by_array($maker_array))//CMA notification for Maker
		    	{
		   		$where= "Date(l.v_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";
		   		$where2= "Date(l.ho_r_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";//return date
		   		$where3= "Date(l.ho_decline_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";//decline date
		    		$sql="SELECT l.id,'cma' as module_name,
		  		IF(l.cma_sts=9,CONCAT('CMA Return, A/C-',l.loan_ac,'(',l.ho_return_reason,')'),IF(l.cma_sts=12,CONCAT('CMA Rejected, A/C-',l.loan_ac,'(',l.ho_decline_reason,')'),CONCAT('CMA Approved on this A/C-',l.loan_ac,'Approval Date: ',DATE_FORMAT(l.v_dt,'%d-%b-%y')))) as type
		    		FROM cma l
		    		WHERE l.sts<>0 AND ((".$where." AND l.cma_sts=59 AND l.e_by=".$this->session->userdata['ast_user']['user_id'].") OR (((l.cma_sts=9 AND ".$where2.") or (l.cma_sts=12 AND ".$where3.")) AND l.e_by=".$this->session->userdata['ast_user']['user_id']."))";
		    	}
		    	else if (check_group(10))//CMA notification for ho Maker
		    	{
		   		$where= "Date(l.v_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";
		   		$where2= "Date(l.ho_r_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";//return date
		   		$where3= "Date(l.ho_decline_dt) between '".date('Y-m-d')."' and '".date('Y-m-d')."'";//decline date
		    		$sql="SELECT l.id,'cma' as module_name,
		  		IF(l.cma_sts=9,CONCAT('CMA Return, A/C-',l.loan_ac,'(',l.ho_return_reason,')'),IF(l.cma_sts=12,CONCAT('CMA Rejected, A/C-',l.loan_ac,'(',l.ho_decline_reason,')'),CONCAT('CMA Approved on this A/C-',l.loan_ac,'Approval Date: ',DATE_FORMAT(l.v_dt,'%d-%b-%y')))) as type
		    		FROM cma l
		    		WHERE l.sts<>0 AND ((".$where." AND l.cma_sts=59 AND l.sth_by=".$this->session->userdata['ast_user']['user_id'].") OR (l.cma_sts=12 AND ".$where3." AND l.sth_by=".$this->session->userdata['ast_user']['user_id']."))";
		    	}
		    	
  		}
  		if ($module_name==6) { //Case Status notification
  			$start_dt=date('Y-m-d');
  			$date = strtotime($start_dt);
	      $date = date("l", $date);
	      $date = strtolower($date);
		   	$str_where = "b.sts=1 AND b.suit_sts=75 AND b.next_dt_sts<>0 AND b.case_deal_officer=".$this->session->userdata['ast_user']['user_id'];
		    $str_where.= " AND DATEDIFF(b.next_date,'".$start_dt."')<=5 AND  DATEDIFF(b.next_date,'".$start_dt."')>=0";
		  	
				$sql = "SELECT 'case_status' as module_name,
				b.id,CONCAT('Next Day legal step(',DATE_FORMAT(b.next_date,'%d-%b-%y'),') AC-',b.loan_ac,' Case no-',b.case_number) AS type
				FROM suit_filling_info b
				WHERE $str_where";

				if($date == "tuesday" || $date == "sunday") {
					$sql.=" 
					UNION ALL 
					SELECT 'case_status' as module_name,
					b.id,CONCAT(' Next Date update which on is (yet to fix) AC-',b.loan_ac,' Case no-',b.case_number) AS type
					FROM suit_filling_info b
					WHERE b.sts=1 AND b.suit_sts=75 AND b.next_dt_sts=0";
				}
		    	
  		}
  		if ($module_name==7) { //Court Fee Adjustment notification
		    	$checker_group_array = array("10");
		    	$sql="";
		    	if (check_group_by_array($checker_group_array))//CMA notification for Recommender
		    	{
		    		$sql="SELECT l.id,'court_fee_adjustment' as module_name,
		  		CONCAT('Need Court Fee adjustment from the A/C-',c.loan_ac,' in favor of ',lw.name) as type
		    		FROM court_fee_adjustment l
		    		LEFT OUTER JOIN cost_details c on(c.id=l.adjustment_bill_id)
		    		LEFT OUTER JOIN ref_lawyer lw on(lw.id=l.lawyer_id)
		    		WHERE l.sts<>0 AND l.v_sts=93";
		    	}
		    	
  		}
  		if ($module_name==8) { //Court Fee Return notification
		    	$checker_group_array = array("4");
		    	$sql="";
		    	if (check_group_by_array($checker_group_array))//CMA notification for Recommender
		    	{
		    		$sql="SELECT l.id,'court_fee_return' as module_name,
		  		CONCAT('Need Court Fee return from the A/C-',l.loan_ac,' in favor of ',lw.name) as type
		    		FROM court_fee_return l
		    		LEFT OUTER JOIN ref_lawyer lw on(lw.id=l.lawyer)
		    		WHERE l.sts<>0 AND l.v_sts=93";
		    	}
		    	
  		}
  		if ($module_name==9) { //Staff Conveyence notification
		    	$checker_group_array = array("10");
		    	$sql="";
		    	if (check_group_by_array($checker_group_array))//CMA notification for Recommender
		    	{
		    		$sql="SELECT l.id,'staff_conv_data' as module_name,
		  		CONCAT('Convinced bill submit from ',u.name,'(',u.pin,')') as type
		    		FROM staff_conv_data l
		    		LEFT OUTER JOIN users_info u on(l.staff_id=u.id)
		    		WHERE l.sts<>0 AND l.v_sts=38";
		    	}
		    	
  		}
  		if ($module_name==10) { //Authorization notification
		    	$checker_group_array = array("10");
		    	$sql="";
		    	if (check_group_by_array($checker_group_array))//CMA notification for Recommender
		    	{
		    		$sql="SELECT l.id,'authorization' as module_name,
		  		CONCAT('Need Authorization copy for ',at.name) as type
		    		FROM authorization l
		    		LEFT OUTER JOIN ref_authorization_type at on(at.id=l.authorization_type)
		    		WHERE l.sts<>0 AND l.auth_sts=66";
		    	}
		    	
  		}
  		if ($module_name==11) { //Case Management notification
		    	$checker_group_array = array("10");
		    	$sql="";
		    	if (check_group_by_array($checker_group_array))//CMA notification for Recommender
		    	{
		    		$sql="SELECT l.id,'case_management' as module_name,
		  		CONCAT('After acknowledged by the legal officer AC-',l.loan_ac) as type
		    		FROM cma l
		    		WHERE l.sts<>0 AND l.cma_sts=61 AND l.hoops_user=".$this->session->userdata['ast_user']['user_id'];
		    	}
		    	
  		}
  		if ($module_name==12) { //Warrent of Arrest notification
	    		$sql="SELECT a.id,GROUP_CONCAT(g.guarantor_name) AS guarantor,a.ps_name,ab.name AS motivation,s.loan_ac,'warrent_arrest' as module_name,
						IF(a.v_sts=38,CONCAT(GROUP_CONCAT(g.guarantor_name),' was Borrower/Guarantor against  A/C-',s.loan_ac,' waranet executed by ',ab.name,' under ',a.ps_name), 'WA Process, Execution and others documents uploaded') AS type
						FROM file_executed_data a
						LEFT JOIN file_executed_by b ON b.executed_id=a.id
						LEFT JOIN ref_arrested_by ab ON ab.id=a.arrested_by
						LEFT JOIN suit_filling_info s ON s.id=a.file_id
						LEFT JOIN cma_guarantor g ON g.id=b.who_executed AND g.sts<>0
						WHERE a.sts <>0 AND a.status=1
						GROUP BY a.id";
		    	
  		}
  		if ($module_name==13) { //Appeal Bail Money notification 
	    		$sql="SELECT a.id,'appeal_bail_money' AS module_name,CONCAT('Appeal & Bail Money recovery from the  A/C-',s.loan_ac) AS type 
					FROM appeal_deposit_withdraw a
					LEFT JOIN suit_filling_info s ON s.id=a.suit_id
					WHERE a.sts<>0 AND a.v_sts IN (39,38,37,90) ";
  		}
  		if ($module_name==14) { //Appeal Bail Money notification 
	    		$sql="SELECT s.id,s.case_no,h.id AS hst,h.next_date AS d,'hc_case_sts' AS module_name,
						CONCAT('Next Day legal step list before the day at 3.00 pm. Case Number:',s.case_no) AS type
						FROM hc_matter s
						JOIN hc_matter_hst h ON h.hc_matter_id=s.id AND h.v_sts=38 AND h.sts<>0 
						AND DATE_FORMAT(h.next_date,'%Y-%m-%d')=DATE_FORMAT(NOW() + INTERVAL 1 DAY,'%Y-%m-%d') 
						GROUP BY h.hc_matter_id ORDER BY h.id DESC";
  		}
  		if($sql!='')
	    	{
	    		return $this->db->query($sql)->result();
	    	}
	    	else
	    	{
	    		return array();
	    	}
  	}
  	else{
  		return array();
  	}
  }
  function get_notification_data____()
  {
  	$start_dt=date('Y-m-d');
    $next_dt=date('Y-m-d', strtotime('+3 days'));
    $Search_Query= "Date(j0.ln_expiry_dt) between '".$start_dt."' and '".$next_dt."'";
    $Search_Query2= "Date(j0.auction_date) between '".$start_dt."' and '".$next_dt."'";
  	$sql = "SELECT j0.loan_ac,c.sl_no,j0.id,j0.cma_id,
  	DATE_FORMAT(j0.ln_expiry_dt,'%d-%b-%y') AS ln_expiry_dt,
  	DATE_FORMAT(j0.auction_date,'%d-%b-%y') AS auction_date,
  	IF(j0.auction_date IS NULL, 'LN Expiry', 'Auction Date') as type
    FROM cma_auction j0
    LEFT OUTER JOIN cma c on(c.id=j0.cma_id)
    WHERE 1 AND (".$Search_Query." AND j0.auction_sts='42') OR (".$Search_Query2." AND j0.auction_sts='43')";
    return $this->db->query($sql)->result();
  }
  function get_notification_data()
  {
  	$start_dt=date('Y-m-d');
    $Search_Query= "Date(j0.notification_start_date)<='".$start_dt."'";
  	$sql = "SELECT j0.id,j0.notification_subject as notification_type,j0.url,j0.main_table_name,j0.table_id,
  	IF(YEAR(j0.notification_end_date)='0000' OR j0.notification_end_date IS NULL,DATE_FORMAT(j0.notification_start_date,'%d-%b-%y'),DATE_FORMAT(j0.notification_end_date,'%d-%b-%y')) AS notification_date
    FROM notification_history j0
    WHERE 1 AND (j0.notification_seen_dt IS NULL OR (j0.notification_seen_dt IS NOT NULL AND Date(j0.notification_seen_dt)!='".$start_dt."')) AND (YEAR(j0.notification_end_date)='0000' OR j0.notification_end_date IS NULL OR Date(j0.notification_end_date)>='".$start_dt."') AND (j0.notification_to='".$this->session->userdata['ast_user']['user_id']."' OR (j0.notification_to='all' AND j0.notify_group IN(".$this->session->userdata['ast_user']['user_work_group_id']."))) AND ".$Search_Query."";
    return $this->db->query($sql)->result();
  }
  function delete_notification()
  {
  	$start_dt=date('Y-m-d');
  	$id = $this->input->post('id');
  	$str="SELECT s.*
			FROM notification_history s
			WHERE s.id='".$id."'";
    $ex_data=$this->db->query($str)->row();
  	if($ex_data->notification_end_date=='0000-00-00' || $ex_data->notification_end_date=='' || $ex_data->notification_end_date==$start_dt)
  	{
  		$application_data = $this->db->query("SELECT * FROM notification_history where id='".$id."'")->result();
  		foreach ($application_data as $key => $value) {
              $data=array();
              foreach($value as $keyIn => $value2) {
                  if($keyIn=='id')
                  {
                      continue;
                  }
                  else if($keyIn=='notification_seen_by')
                  {
                  	$data[$keyIn] = $this->session->userdata['ast_user']['user_id'];
                  }
                  else if($keyIn=='notification_seen_dt')
                  {
                  	$data[$keyIn] = date('Y-m-d H:i:s');
                  }
                  else if($keyIn=='notification_received_by')
                  {
                  	$data[$keyIn] = $this->session->userdata['ast_user']['user_id'];
                  }
                  else if($keyIn=='notification_received_date')
                  {
                  	$data[$keyIn] = date('Y-m-d H:i:s');
                  }
                  else
                  {
                      $data[$keyIn] = $value2;
                  }
                  
              }
              $this->db->insert('notification_history_deleted', $data);
      }
  		$str="DELETE 
               FROM notification_history j0
           WHERE j0.id= '".$id."'";
      $application_data=$this->db->query($str);
  	}
  	else
  	{
  		$data = array(
  			'notification_seen_by' => $this->session->userdata['ast_user']['user_id'],
				'notification_seen_dt' => date('Y-m-d H:i:s')
			);
			$this->db->where('id',$id);
    	$this->db->update('notification_history', $data);
  	}
    return 1;
  }
  function get_upcoming_case_sts()
  {
  	$start_dt=date('Y-m-d');
    	$next_dt=date('Y-m-d', strtotime('+5 days'));
    	$str_where = "b.sts=1 AND b.suit_sts=75 AND b.next_dt_sts<>0";
    	$str_where.= " AND DATEDIFF(b.next_date,'".$start_dt."')<=5 AND  DATEDIFF(b.next_date,'".$start_dt."')>=0";
  	
	$sql = "SELECT
				b.id,b.cma_id,b.loan_ac,b.ac_name,b.case_number,DATE_FORMAT(b.next_date,'%d-%b-%y') AS next_date,
				CONCAT(u.name,' (',u.pin,')')as current_plaintiff,cs.name as current_case_sts
				FROM suit_filling_info b 
				LEFT OUTER JOIN users_info u on(b.filling_plaintiff=u.id)
				LEFT OUTER JOIN ref_case_sts cs on(b.case_sts_prev_dt=cs.id)
				WHERE $str_where";
    	return $this->db->query($sql)->result();
  }
  function get_enum_data($table,$column)
	{
		$str_query = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$table."' AND COLUMN_NAME ='".$column."'";
		$query=$this->db->query($str_query);
		$row =$query->result();
		$aaa = $row[0]->COLUMN_TYPE;
		$str_enum = substr($aaa,5,-1);
		$str_withoutcote = str_replace("'", "", $str_enum);
		$enumList = explode(",", $str_withoutcote);
		return $enumList;
	}
	function get_api_config_data($table,$where){
        $this->db
            ->select('*')
            ->from($table)
            ->where($where);
            return  $this->db->get()->result();
    }
    function get_product_details($operation)
    {
    	$str_where="";
    	if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.v_dt) = ".$this->db->escape($this->security->xss_clean($_POST['year']));
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.v_dt) = ".$this->db->escape($this->security->xss_clean($_POST['month']));
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region=".$this->db->escape($this->security->xss_clean($_POST['region']));
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district=".$this->db->escape($this->security->xss_clean($_POST['district']));
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment=".$this->db->escape($this->security->xss_clean($_POST['loan_segment']));
      }
    	if ($operation=='Initiated_ln')
    	{
    		$sql = "SELECT b.id,b.sl_no,b.ac_name,b.loan_ac,r.name as region_name,t.name as territory_name
			FROM legal_notice b 
			LEFT OUTER JOIN ref_region r on(b.region=r.id)
			LEFT OUTER JOIN ref_territory t on(b.territory=t.id)
			WHERE b.sts=1 AND b.legal_notice_sts<>12 AND b.legal_notice_sts<>5 $str_where";
			$query=$this->db->query($sql)->result();
			return $query;
    	}
    	if ($operation=='Legal Notice Send_ln')
    	{
    		$sql = "SELECT b.id,b.sl_no,b.ac_name,b.loan_ac,r.name as region_name,t.name as territory_name
			FROM legal_notice b 
			LEFT OUTER JOIN ref_region r on(b.region=r.id)
			LEFT OUTER JOIN ref_territory t on(b.territory=t.id)
			WHERE b.sts=1 AND b.migration_sts<>1 AND b.legal_notice_sts=14 AND b.legal_notice_sts<>12 AND b.legal_notice_sts<>5 $str_where";
			$query=$this->db->query($sql)->result();
			return $query;
    	}
    	if ($operation=='Legal Notice UnSend_ln')
    	{
    		$sql = "SELECT b.id,b.sl_no,b.ac_name,b.loan_ac,r.name as region_name,t.name as territory_name
			FROM legal_notice b 
			LEFT OUTER JOIN ref_region r on(b.region=r.id)
			LEFT OUTER JOIN ref_territory t on(b.territory=t.id)
			WHERE b.sts=1 AND b.migration_sts<>1 AND b.legal_notice_sts<>14 AND b.legal_notice_sts<>12 AND b.legal_notice_sts<>5 $str_where";
			$query=$this->db->query($sql)->result();
			return $query;
    	}
    	if ($operation=='ARA_cma')
    	{
    		$sql = "SELECT b.id,b.sl_no,b.ac_name,b.loan_ac,r.name as region_name,t.name as territory_name
			FROM cma b 
			LEFT OUTER JOIN ref_region r on(b.region=r.id)
			LEFT OUTER JOIN ref_territory t on(b.territory=t.id)
			WHERE b.sts=1 AND b.v_by IS NOT NULL AND b.req_type=2 AND b.cma_sts<>12 AND b.cma_sts<>5 $str_where";
			$query=$this->db->query($sql)->result();
			return $query;
    	}
    	if ($operation=='NI ACT_cma')
    	{
    		$sql = "SELECT b.id,b.sl_no,b.ac_name,b.loan_ac,r.name as region_name,t.name as territory_name
			FROM cma b 
			LEFT OUTER JOIN ref_region r on(b.region=r.id)
			LEFT OUTER JOIN ref_territory t on(b.territory=t.id)
			WHERE b.sts=1 AND b.v_by IS NOT NULL AND b.migration_sts<>1 AND b.req_type=1 AND b.cma_sts<>12 AND b.cma_sts<>5 $str_where";
			$query=$this->db->query($sql)->result();
			return $query;
    	}
    	if ($operation=='Others_cma')
    	{
    		$sql = "SELECT b.id,b.sl_no,b.ac_name,b.loan_ac,r.name as region_name,t.name as territory_name
			FROM cma b 
			LEFT OUTER JOIN ref_region r on(b.region=r.id)
			LEFT OUTER JOIN ref_territory t on(b.territory=t.id)
			WHERE b.sts=1 AND b.v_by IS NOT NULL AND b.migration_sts<>1 AND (b.req_type=3 OR b.req_type=4) AND b.cma_sts<>12 AND b.cma_sts<>5 $str_where";
			$query=$this->db->query($sql)->result();
			return $query;
    	}
    	if ($operation=='Total_cma')
    	{
    		$sql = "SELECT b.id,b.sl_no,b.ac_name,b.loan_ac,r.name as region_name,t.name as territory_name
			FROM cma b 
			LEFT OUTER JOIN ref_region r on(b.region=r.id)
			LEFT OUTER JOIN ref_territory t on(b.territory=t.id)
			WHERE b.sts=1 AND b.v_by IS NOT NULL AND b.migration_sts<>1 AND b.cma_sts<>12 AND b.cma_sts<>5 $str_where";
			$query=$this->db->query($sql)->result();
			return $query;
    	}
    	if ($operation=='Initiated_cma_init')
    	{
    		$sql = "SELECT b.id,b.sl_no,b.ac_name,b.loan_ac,r.name as region_name,t.name as territory_name
			FROM cma b 
			LEFT OUTER JOIN ref_region r on(b.region=r.id)
			LEFT OUTER JOIN ref_territory t on(b.territory=t.id)
			WHERE b.sts=1 AND b.migration_sts<>1 $str_where";
			$query=$this->db->query($sql)->result();
			return $query;
    	}
    	if ($operation=='Decline_cma_init')
    	{
    		$sql = "SELECT b.id,b.sl_no,b.ac_name,b.loan_ac,r.name as region_name,t.name as territory_name
			FROM cma b 
			LEFT OUTER JOIN ref_region r on(b.region=r.id)
			LEFT OUTER JOIN ref_territory t on(b.territory=t.id)
			WHERE b.sts=1 AND b.migration_sts<>1 AND (b.cma_sts=5 OR b.cma_sts=12) $str_where";
			$query=$this->db->query($sql)->result();
			return $query;
    	}
    	if ($operation=='Approval_cma_init')
    	{
    		$sql = "SELECT b.id,b.sl_no,b.ac_name,b.loan_ac,r.name as region_name,t.name as territory_name
			FROM cma b 
			LEFT OUTER JOIN ref_region r on(b.region=r.id)
			LEFT OUTER JOIN ref_territory t on(b.territory=t.id)
			WHERE b.sts=1 AND b.migration_sts<>1 AND b.v_by IS NOT NULL $str_where";
			$query=$this->db->query($sql)->result();
			return $query;
    	}
    	if ($operation=='Approval_auction')
    	{
    		$sql = "SELECT b.id,b.sl_no,b.ac_name,b.loan_ac,r.name as region_name,t.name as territory_name
			FROM cma_auction c 
			LEFT OUTER JOIN cma b on(c.cma_id=b.id)
			LEFT OUTER JOIN ref_region r on(b.region=r.id)
			LEFT OUTER JOIN ref_territory t on(b.territory=t.id)
			WHERE c.auction_sts=33 AND b.migration_sts<>1 AND b.cma_sts>=13 AND b.sts=1  AND b.cma_sts<>12 AND b.cma_sts<>5 $str_where";
			$query=$this->db->query($sql)->result();
			return $query;
    	}
    	if ($operation=='Auction Complete_auction')
    	{
    		$sql = "SELECT b.id,b.sl_no,b.ac_name,b.loan_ac,r.name as region_name,t.name as territory_name
			FROM cma_auction c 
			LEFT OUTER JOIN cma b on(c.cma_id=b.id)
			LEFT OUTER JOIN ref_region r on(b.region=r.id)
			LEFT OUTER JOIN ref_territory t on(b.territory=t.id)
			WHERE c.auction_sts=33 AND b.migration_sts<>1 AND b.sts=1  AND b.cma_sts<>12 AND b.cma_sts<>5 $str_where";
			$query=$this->db->query($sql)->result();
			return $query;
    	}
    }
    function get_legal_notice_deshboard()
    {
    	$str_where="b.sts=1 AND b.legal_notice_sts<>12 AND b.legal_notice_sts<>5 AND b.migration_sts<>1";
    	if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.e_dt) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.e_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
		COUNT(b.id) AS inite, 
		SUM(IF(b.legal_notice_sts=14, 1,0)) AS ln_sent,
		SUM(IF(b.legal_notice_sts<>14, 1,0)) AS ln_unsent
		FROM legal_notice b 
		WHERE $str_where";
		$query=$this->db->query($sql)->result();
		return $query;
    }
    function get_total_ln_data()
    {
    	$str_where = "b.sts=1 AND b.legal_notice_sts<>12 AND b.legal_notice_sts<>5 AND b.migration_sts<>1";
			if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND (YEAR(b.legal_notice_s_dt) = '".$this->security->xss_clean($_POST['year'])."' OR YEAR(b.v_dt) = '".$this->security->xss_clean($_POST['year'])."')";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND (MONTH(b.legal_notice_s_dt) = '".$this->security->xss_clean($_POST['month'])."' OR MONTH(b.v_dt) = '".$this->security->xss_clean($_POST['month'])."')";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
				SUM(IF(b.legal_notice_sts=14 OR b.legal_notice_sts=13, 1,0)) AS total_ln
				FROM legal_notice b 
				WHERE $str_where";
				$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_total_cma_data()
    {
    	$str_where = "b.sts=1 AND b.cma_sts<>12 AND b.cma_sts<>5";
			if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.v_dt) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.v_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
				SUM(IF(b.v_by IS NOT NULL AND b.v_dt IS NOT NULL, 1,0)) AS total_cma
				FROM cma b 
				WHERE $str_where";
				$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_live_case_data($year=NULL,$month=NULL,$district=NULL,$region=NULL,$loan_segment=NULL)
    {
    	$str_where = "s.suit_sts=75 AND s.sts<>0 AND c.req_type IN(1,2) AND s.cma_id IS NOT NULL AND s.cma_id<>0 AND s.cma_id<>''";
			if($year!=NULL && $year!='' && $year!=0)
      {
            $str_where.= " AND YEAR(c.sthoops_dt) = '".$this->security->xss_clean($year)."'";
      }
      if($month!=NULL && $month!='' && $month!=0)
      {
            $str_where.= " AND MONTH(c.sthoops_dt) = '".$this->security->xss_clean($month)."'";
      }
      if($region!=NULL && $region!='' && $region!=0)
      {
            $str_where.= " AND s.region='".$this->security->xss_clean($region)."'";
      }
      if($district!=NULL && $district!='' && $district!=0)
      {
            $str_where.= " AND s.district='".$this->security->xss_clean($district)."'";
      }
      if($loan_segment!=NULL && $loan_segment!='')
      {
            $str_where.= " AND s.loan_segment='".$this->security->xss_clean($loan_segment)."'";
      }
    	$sql = "
		SELECT c.sl_no,s.proposed_type,s.loan_ac,rq.name as req_type_name,s.ac_name,r.name as region,t.name as territory,d.name as district,s.case_number,s.cma_id,s.id
		FROM suit_filling_info s 
		LEFT OUTER JOIN cma c on(s.cma_id=c.id)
		LEFT OUTER JOIN ref_region r on(c.region=r.id) 
		LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.id) 
		LEFT OUTER JOIN ref_territory t on(c.territory=t.id) 
		LEFT OUTER JOIN ref_district d on(c.district=d.id) 
		WHERE $str_where";
		$query=$this->db->query($sql)->result();
		return $query;
    }
    function get_total_insru_deliverd()
    {
    	$str_where = "b.sts=1 AND b.cma_sts<>12 AND b.cma_sts<>5 AND b.hoops_user IS NOT NULL AND b.cma_sts<>76 AND b.req_type IN(1,2)";
	if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.sthoops_dt) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.sthoops_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
				SUM(IF(b.req_type=2 AND b.legal_user IS NOT NULL, 1,0)) AS total_file_deliverd,
				SUM(IF(b.req_type=1 AND b.legal_user IS NOT NULL, 1,0)) AS total_instru_deliverd,
				SUM(IF(b.req_type=1 AND b.legal_ack_by IS NOT NULL AND s.total IS NULL, 1,0)) AS total_instru_filling,
				SUM(IF(b.req_type=2 AND b.legal_ack_by IS NOT NULL AND s.total IS NULL, 1,0)) AS total_deleverd_filling,
				SUM(IF(b.req_type = 2 AND s2.total IS NOT NULL, s2.total, 0)) AS total_deleverd_live_case,
				SUM(IF(b.req_type = 1 AND s2.total IS NOT NULL, s2.total, 0)) AS total_instru_live_case
				FROM cma b 
				LEFT OUTER JOIN (
					SELECT s.id,s.cma_id,COUNT(s.id) AS total FROM suit_filling_info s  WHERE (s.suit_sts=75 OR s.suit_sts=76) AND s.sts<>0 GROUP BY s.cma_id
				)s on(s.cma_id=b.id)
				LEFT OUTER JOIN (
					SELECT s.id,s.cma_id,COUNT(s.id) AS total FROM suit_filling_info s  WHERE s.suit_sts=75 AND s.final_remarks=1 AND s.sts<>0 GROUP BY s.cma_id
				)s2 on(s2.cma_id=b.id)
				WHERE $str_where";
				$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_pending_cma_data($year=NULL,$month=NULL,$district=NULL,$region=NULL,$loan_segment=NULL)
    {
    	$str_where = "b.sts=1 AND b.cma_sts<>12 AND s.total IS NULL AND b.cma_sts<>5 AND b.legal_ack_by IS NOT NULL AND b.hoops_user IS NOT NULL AND b.cma_sts<>76 AND b.req_type IN(1,2)";
	if($year!=NULL && $year!='' && $year!=0)
      {
            $str_where.= " AND YEAR(b.sthoops_dt) = '".$this->security->xss_clean($year)."'";
      }
      if($month!=NULL && $month!='' && $month!=0)
      {
            $str_where.= " AND MONTH(b.sthoops_dt) = '".$this->security->xss_clean($month)."'";
      }
      if($region!=NULL && $region!='' && $region!=0)
      {
             $str_where.= " AND b.region='".$this->security->xss_clean($region)."'";
      }
      if($district!=NULL && $district!='' && $district!=0)
      {
             $str_where.= " AND b.district='".$this->security->xss_clean($district)."'";
      }
      if($loan_segment!=NULL && $loan_segment!='')
      {
             $str_where.= " AND b.loan_segment='".$this->security->xss_clean($loan_segment)."'";
      }
    	$sql = "SELECT
				b.sl_no,b.proposed_type,rq.name as req_type_name,b.id,b.loan_ac,b.brrower_name,b.ac_name,r.name as region,t.name as territory,d.name as district
				FROM cma b 
				LEFT OUTER JOIN ref_region r on(b.region=r.id) 
				LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
				LEFT OUTER JOIN ref_territory t on(b.territory=t.id) 
				LEFT OUTER JOIN ref_district d on(b.district=d.id) 
				LEFT OUTER JOIN (
					SELECT s.id,s.cma_id,COUNT(s.id) AS total FROM suit_filling_info s  WHERE (s.suit_sts=75 OR s.suit_sts=76) AND s.sts<>0 GROUP BY s.cma_id
				)s on(s.cma_id=b.id)
				WHERE $str_where AND s.total IS NULL";
				$query=$this->db->query($sql)->result();
		return $query;
    }
    function get_cma_data_verified($year=NULL,$month=NULL,$district=NULL,$region=NULL,$loan_segment=NULL)
    {
    	$str_where = "b.sts=1 AND b.cma_sts<>12 AND b.cma_sts<>5 AND b.hoops_user IS NOT NULL AND b.legal_user IS NOT NULL AND b.cma_sts<>76 AND b.req_type IN(1,2)";
	if($year!=NULL && $year!='' && $year!=0)
      {
            $str_where.= " AND YEAR(b.sthoops_dt) = '".$this->security->xss_clean($year)."'";
      }
      if($month!=NULL && $month!='' && $month!=0)
      {
            $str_where.= " AND MONTH(b.sthoops_dt) = '".$this->security->xss_clean($month)."'";
      }
      if($region!=NULL && $region!='' && $region!=0)
      {
             $str_where.= " AND b.region='".$this->security->xss_clean($region)."'";
      }
      if($district!=NULL && $district!='' && $district!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($district)."'";
      }
      if($loan_segment!=NULL && $loan_segment!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($loan_segment)."'";
      }
    	$sql = "SELECT b.sl_no,b.proposed_type,rq.name as req_type_name,b.id,b.loan_ac,b.brrower_name,b.ac_name,r.name as region,t.name as territory,d.name as district
				FROM cma b 
				LEFT OUTER JOIN ref_region r on(b.region=r.id) 
				LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
				LEFT OUTER JOIN ref_territory t on(b.territory=t.id) 
				LEFT OUTER JOIN ref_district d on(b.district=d.id) 
				WHERE $str_where";
				$query=$this->db->query($sql)->result();
		return $query;
    }
    function get_total_auction_data()
    {
    	$str_where = "b.auction_sts=33";
			if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.auction_complete_dt) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.auction_complete_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND c.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
				COUNT(b.id) AS total_auction
				FROM cma_auction b 
				LEFT OUTER JOIN cma c on(b.cma_id=c.id)
				WHERE $str_where";
				$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_total_case_against_bank()
    {
    	$str_where = "b.suit_sts=51 and b.sts<>0 and b.final_remarks=1";
			if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.v_dt) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.v_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
    	$sql = "SELECT
				COUNT(b.id) AS total_case
				FROM case_against_bank b 
				WHERE $str_where";
				$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_case_against_bank_data_type_wise()
    {
    	$str_where = "b.suit_sts=51 and b.sts<>0 and b.final_remarks=1";
			if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.v_dt) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.v_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
    	$sql = "SELECT
				SUM(IF(b.req_type=1, 1,0)) AS total_civil, 
				SUM(IF(b.req_type=2, 1,0)) AS total_criminal 
				FROM case_against_bank b 
				WHERE $str_where";
				$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_total_legal_cost()
    {
    	$str_where = "b.court_fee_return_sts=0";
			if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.txrn_dt) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.txrn_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
				SUM(b.amount) AS total_cost
				FROM cost_details b 
				WHERE $str_where";
				$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_bill_details($type,$year=NULL,$month=NULL,$district=NULL,$region=NULL,$loan_segment=NULL)
    {
    	if($type=='Court Ent.')
    	{
    		$str_where = "b.main_table_name<>'legal_notice' AND b.court_fee_return_sts=0 AND b.vendor_type=5";
    		$join = "LEFT OUTER JOIN ref_court_entertainment_activities as ac on (b.activities_id=ac.id)
    		LEFT OUTER JOIN court_entertainment_data v1 on (b.vendor_type=5 AND v1.id=b.main_table_id AND b.main_table_name='court_entertainment_data')";
    		$select = "ac.name as act_name, 'Court Entertainment' as bill_type,v1.staff_pin as vendor_name";
    	}
    	else if($type=='Staff Con.')
    	{
    		$str_where = "b.main_table_name<>'legal_notice' AND b.court_fee_return_sts=0 AND b.vendor_type=3";
    		$join = "LEFT OUTER JOIN ref_staff_conv_activities as ac on (b.activities_id=ac.id)
    		LEFT OUTER JOIN users_info as v2 on (b.vendor_id=v2.id and b.vendor_type=3)";
    		$select = "ac.name as act_name, 'Staff Conveyence' as bill_type,v2.name as vendor_name";
    	}
    	else if($type=='Vendor Bill')
    	{
    		$str_where = "b.main_table_name<>'legal_notice' AND b.court_fee_return_sts=0 AND b.vendor_type=2";
    		$join = "LEFT OUTER JOIN ref_paper_bill_activities as co on (b.activities_id=co.id AND b.main_table_name='expenses')
    		LEFT OUTER JOIN ref_paper_vendor as v3 on (b.vendor_id=v3.id and b.vendor_type=2)";
    		$select = "co.name as act_name, 'Paper Bill' as bill_type,v3.name as vendor_name";
    	}
    	else if($type=='Lawyer Bill')
    	{
    		$str_where = "b.main_table_name<>'legal_notice' AND b.court_fee_return_sts=0 AND b.vendor_type=1";
    		$join = "LEFT OUTER JOIN ref_schedule_charges_ara as ar on (b.activities_id=ar.id and b.req_type=2 AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (b.activities_id=ni.id and b.req_type<>2 AND b.req_type IS NOT NULL AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (b.activities_id=hc.id AND (b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (b.activities_id=ca.id AND b.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (b.activities_id=la.id AND b.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_lawyer as v4 on (b.vendor_id=v4.id and b.vendor_type=1)";
    		$select = "v4.name as vendor_name,IF(b.activities_id=0,b.description,IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter',hc.name,IF(b.main_table_name='case_against_bank',ca.name,IF(b.main_table_name='legal_affairs',la.name,IF(b.req_type=2,ar.name,ni.name))))) as act_name, 'Lawyer Bill' as bill_type";
    	}
    	else if($type=='Court Fees')
    	{
    		$str_where = "b.main_table_name<>'legal_notice' AND b.court_fee_return_sts=0 AND b.vendor_type=4";
    		$join = "LEFT OUTER JOIN ref_court_fee_activities as co on (b.activities_id=co.id AND b.main_table_name='cma')
    		LEFT OUTER JOIN ref_lawyer as v5 on (b.vendor_id=v5.id and b.vendor_type=4)";
    		$select = "co.name as act_name, 'Court Fee' as bill_type,v5.name as vendor_name";
    	}
    	else
    	{
    		$str_where = "b.main_table_name<>'legal_notice' AND b.court_fee_return_sts=0";
    		$join = "LEFT OUTER JOIN ref_schedule_charges_ara as ar on (b.vendor_type=1 AND b.activities_id=ar.id and b.req_type=2 AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (b.vendor_type=1 AND b.activities_id=ni.id and b.req_type<>2 AND b.req_type IS NOT NULL AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (b.vendor_type=1 AND b.activities_id=hc.id AND (b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (b.vendor_type=1 AND b.activities_id=ca.id AND b.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (b.vendor_type=1 AND b.activities_id=la.id AND b.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_court_fee_activities as co on (b.vendor_type=4 AND b.activities_id=co.id AND b.main_table_name='cma')
            LEFT OUTER JOIN ref_paper_bill_activities as pa on (b.vendor_type=2 AND b.activities_id=pa.id AND b.main_table_name='expenses')
            LEFT OUTER JOIN ref_staff_conv_activities as sc on (b.vendor_type=3 AND b.activities_id=sc.id)
            LEFT OUTER JOIN ref_court_entertainment_activities as ce on (b.vendor_type=5 AND b.activities_id=ce.id)
            LEFT OUTER JOIN ref_others_cost_activities as oa on (b.vendor_type=6 AND b.activities_id=oa.id AND b.main_table_name='expenses')
            LEFT OUTER JOIN court_entertainment_data v1 on (b.vendor_type=5 AND v1.id=b.main_table_id AND b.main_table_name='court_entertainment_data')
		LEFT OUTER JOIN users_info as v2 on (b.vendor_id=v2.id and b.vendor_type=3)
		LEFT OUTER JOIN ref_paper_vendor as v3 on (b.vendor_id=v3.id and b.vendor_type=2)
		LEFT OUTER JOIN ref_lawyer as v4 on (b.vendor_id=v4.id and b.vendor_type=1)
		LEFT OUTER JOIN ref_lawyer as v5 on (b.vendor_id=v5.id and b.vendor_type=4)";
    		$select = "IF(b.vendor_type=1,v4.name,IF(b.vendor_type=2,v3.name,IF(b.vendor_type=3,v2.name,IF(b.vendor_type=4,v5.name,IF(vendor_type=5,v1.staff_pin,b.vendor_name))))) as vendor_name,IF(b.vendor_type=4,co.name,IF(b.vendor_type=2,pa.name,IF(b.vendor_type=3,sc.name,IF(b.vendor_type=5,ce.name,IF(b.vendor_type=6,oa.name,IF(b.activities_id=0,b.description,IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter',hc.name,IF(b.main_table_name='case_against_bank',ca.name,IF(b.main_table_name='legal_affairs',la.name,IF(b.req_type=2,ar.name,ni.name)))))))))) as act_name,IF(b.vendor_type=1,'Lawyer Bill',IF(b.vendor_type=2,'Paper Bill',IF(b.vendor_type=3,'Staff Conveyence',IF(b.vendor_type=4,'Court Fee',IF(b.vendor_type=5,'Court Entertainment','Others Bill'))))) as bill_type";
    	}
    	
    	if($year!=NULL && $year!='' && $year!=0)
      {
            $str_where.= " AND YEAR(bill.stf_dt) = '".$this->security->xss_clean($year)."'";
      }
      if($month!=NULL && $month!='' && $month!=0)
      {
            $str_where.= " AND MONTH(bill.stf_dt) = '".$this->security->xss_clean($month)."'";
      }
      if($region!=NULL && $region!='' && $region!=0)
      {
             $str_where.= " AND b.region='".$this->security->xss_clean($region)."'";
      }
      if($district!=NULL && $district!='' && $district!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($district)."'";
      }
      if($loan_segment!=NULL && $loan_segment!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($loan_segment)."'";
      }
    	$sql = "SELECT
				b.amount,b.expense_remarks,b.loan_ac,b.ac_name,
				IF(b.activities_id=1 AND b.vendor_type=1,CONCAT(rq.name,' Legal Notice'),b.case_number) as case_number,
				d.name as district,DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,$select
				FROM cost_details b
				$join
				LEFT OUTER JOIN bill_summery as bill on (b.bill_id=bill.id)
				LEFT OUTER JOIN ref_req_type as rq on (b.req_type=rq.id)
				LEFT OUTER JOIN ref_district d on(b.district=d.id) 
				WHERE $str_where AND (b.memo_sts=70)";
				$query=$this->db->query($sql)->result();
		return $query;
    }
    function get_type_wise_legal_cost()
    {
    	$str_where = "b.main_table_name<>'legal_notice' AND b.court_fee_return_sts=0 AND (b.memo_sts=70)";
			if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(bill.stf_dt) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(bill.stf_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }

      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
				SUM(b.amount) AS total_cost,
				SUM(IF(b.vendor_type=5, b.amount,0)) AS total_court_enter, 
				SUM(IF(b.vendor_type=3, b.amount,0)) AS total_staff_conv, 
				SUM(IF(b.vendor_type=2, b.amount,0)) AS total_vendor_bill, 
				SUM(IF(b.vendor_type=1, b.amount,0)) AS total_lawyer_bill, 
				SUM(IF(b.vendor_type=4, b.amount,0)) AS total_court_fee
				FROM cost_details b 
				LEFT OUTER JOIN bill_summery bill on(bill.id=b.bill_id)
				WHERE $str_where";
				$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_req_type_wise_legal_cost()
    {
    	$str_where = "b.main_table_name<>'legal_notice' AND b.court_fee_return_sts=0";
	if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.txrn_dt) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.txrn_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }

      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
				SUM(IF(b.req_type=1, b.amount,0)) AS total_ni_act, 
				SUM(IF(b.req_type=2, b.amount,0)) AS total_ara, 
				SUM(IF(b.req_type<>2 AND b.req_type<>1, b.amount,0)) AS total_others
				FROM cost_details b 
				WHERE $str_where";
				$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_total_case_by_case_type()
    {
    	$str_where = "b.sts=1 AND b.suit_sts=75 AND b.final_remarks=1";
			if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.filling_date) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.filling_date) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
				SUM(IF(b.sts=1, 1,0)) AS total, 
				SUM(IF(b.req_type=1, 1,0)) AS ni_act,
				SUM(IF(b.req_type=2, 1,0)) AS ara,
				SUM(IF(b.req_type=3 OR b.req_type=4, 1,0)) AS others
				FROM suit_filling_info b 
				WHERE $str_where";
				$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_total_case_by_case_type_disposal()
    {
    	$str_where = "b.sts=1 AND b.suit_sts=76 AND b.final_remarks=2";
			if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.filling_date) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.filling_date) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
				SUM(IF(b.sts=1, 1,0)) AS total, 
				SUM(IF(b.req_type=1, 1,0)) AS ni_act,
				SUM(IF(b.req_type=2, 1,0)) AS ara,
				SUM(IF(b.req_type=3 OR b.req_type=4, 1,0)) AS others
				FROM suit_filling_info b 
				WHERE $str_where";
				$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_ara_filing_data_disposal($type,$year=NULL,$month=NULL,$district=NULL,$region=NULL,$loan_segment=NULL)
    {
    	if($type=='ara')
    	{
    		$str_where = "b.sts=1 AND b.suit_sts=76 AND b.req_type=2 AND b.final_remarks=2";
    	}
    	else if($type=='ni act')
    	{
    		$str_where = "b.sts=1 AND b.suit_sts=76 AND b.req_type=1 AND b.final_remarks=2";
    	}
    	else if($type=='others')
    	{
    		$str_where = "b.sts=1 AND b.suit_sts=76 AND b.req_type IN(3,4) AND b.final_remarks=2";
    	}
    	else
    	{
    		$str_where = "b.sts=1 AND b.suit_sts=76 AND b.final_remarks=2";
    	}
    	if($year!=NULL && $year!='' && $year!=0)
      {
            $str_where.= " AND YEAR(b.e_dt) = '".$this->security->xss_clean($year)."'";
      }
      if($month!=NULL && $month!='' && $month!=0)
      {
            $str_where.= " AND MONTH(b.e_dt) = '".$this->security->xss_clean($month)."'";
      }
      if($region!=NULL && $region!='' && $region!=0)
      {
             $str_where.= " AND b.region='".$this->security->xss_clean($region)."'";
      }
      if($district!=NULL && $district!='' && $district!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($district)."'";
      }
      if($loan_segment!=NULL && $loan_segment!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($loan_segment)."'";
      }
    	$sql = "SELECT
				b.proposed_type,b.cma_id,b.id,b.case_number,rq.name as req_type_name,b.loan_ac,b.ac_name,r.name as region,t.name as territory,d.name as district
				FROM suit_filling_info b 
				LEFT OUTER JOIN ref_legal_region r on(b.legal_region=r.id) 
				LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
				LEFT OUTER JOIN ref_territory t on(b.territory=t.id) 
				LEFT OUTER JOIN ref_legal_district d on(b.district=d.id) 
				WHERE $str_where";
				$query=$this->db->query($sql)->result();
		return $query;
    }
    function get_ara_filing_data($type,$year=NULL,$month=NULL,$district=NULL,$region=NULL,$loan_segment=NULL)
    {
    	if($type=='ARA')
    	{
    		$str_where = "b.sts=1 AND b.suit_sts=75 AND b.req_type=2 AND b.final_remarks=1";
    	}
    	else if($type=='NI ACT')
    	{
    		$str_where = "b.sts=1 AND b.suit_sts=75 AND b.req_type=1 AND b.final_remarks=1";
    	}
    	else if($type=='Others')
    	{
    		$str_where = "b.sts=1 AND b.suit_sts=75 AND b.req_type IN(3,4) AND b.final_remarks=1";
    	}
    	else if($type=='Total')
    	{
    		$str_where = "b.sts=1 AND b.suit_sts=75 AND b.final_remarks=1";
    	}
    	else
    	{
    		$str_where = "b.sts=1 AND b.suit_sts=75 AND b.final_remarks=1";
    	}
    	
	if($year!=NULL && $year!='' && $year!=0)
      {
            $str_where.= " AND YEAR(b.e_dt) = '".$this->security->xss_clean($year)."'";
      }
      if($month!=NULL && $month!='' && $month!=0)
      {
            $str_where.= " AND MONTH(b.e_dt) = '".$this->security->xss_clean($month)."'";
      }
      if($region!=NULL && $region!='' && $region!=0)
      {
             $str_where.= " AND b.region='".$this->security->xss_clean($region)."'";
      }
      if($district!=NULL && $district!='' && $district!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($district)."'";
      }
      if($loan_segment!=NULL && $loan_segment!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($loan_segment)."'";
      }
    	$sql = "SELECT
				b.proposed_type,b.cma_id,b.id,b.case_number,rq.name as req_type_name,b.loan_ac,b.ac_name,r.name as region,t.name as territory,d.name as district
				FROM suit_filling_info b 
				LEFT OUTER JOIN ref_legal_region r on(b.legal_region=r.id) 
				LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
				LEFT OUTER JOIN ref_territory t on(b.territory=t.id) 
				LEFT OUTER JOIN ref_legal_district d on(b.district=d.id) 
				WHERE $str_where";
				$query=$this->db->query($sql)->result();
		return $query;
    }
    function get_case_status_data()
    {
    	$str_where = "b.sts=1 AND b.suit_sts=75 AND b.final_remarks=1";
    	$select = "";
    	if (check_group('1')) //For Recovery Maker
			{
				$str_where .=" AND b.legal_region IN(".$this->session->userdata['ast_user']['legal_region'].")";
			}
		    	else if (check_group('2')) //For Recovery Maker
			{
				$str_where .=" AND b.case_deal_officer='".$this->session->userdata['ast_user']['user_id']."'";
			}
			if (check_group('3') || check_group('4')) //For Recovery Maker Checker
		  {
		      $str_where .=" AND b.territory IN(".$this->session->userdata['ast_user']['recovery_territory'].")";
		  }
	
    	if($_POST['date']=='')
    	{
    		$date = date("Y-m-d");
	      $select = "SUM(IF(b.next_date!='' AND final_remarks=1 AND b.next_date!='Yet To Fix' AND b.next_date<='".$date."', 1,0)) AS total_pending, 
	      SUM(IF((b.next_date='' OR b.next_date='Yet To Fix') AND b.not_available_sts=0 AND b.case_sts_prev_dt NOT IN(3,15,7,4), 1,0)) AS total_yet_to_fix,
	      SUM(IF(b.not_available_sts=1 AND b.case_sts_prev_dt NOT IN(3,15,7,4), 1,0)) AS total_not_available,
				SUM(IF(date_format(b.last_case_sts_update_dt,'%Y-%m-%d')='".$date."', 1,0)) AS total_updated";
    	}
    	else
    	{
    		$date = date("Y-m-d",strtotime($_POST['date']));
    		$select = "SUM(IF(b.next_date!='' AND final_remarks=1 AND b.next_date!='Yet To Fix' AND b.next_date<='".$this->security->xss_clean($date)."', 1,0)) AS total_pending, 
	      SUM(IF((b.next_date='' OR b.next_date='Yet To Fix') AND b.not_available_sts=0 AND b.case_sts_prev_dt NOT IN(3,15,7,4), 1,0)) AS total_yet_to_fix,
	      SUM(IF(b.not_available_sts=1 AND b.case_sts_prev_dt NOT IN(3,15,7,4), 1,0)) AS total_not_available,
				SUM(IF(b.last_case_sts_update_dt='".$this->security->xss_clean($date)."', 1,0)) AS total_updated";
    	}
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region=".$this->db->escape($this->security->xss_clean($_POST['region']));
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district=".$this->db->escape($this->security->xss_clean($_POST['district']));
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment=".$this->db->escape($this->security->xss_clean($_POST['loan_segment']));
      }
    	$sql = "SELECT
				$select
				FROM suit_filling_info b 
				WHERE $str_where";
				$query=$this->db->query($sql)->row();
		return $query;
    }
    function check_hiliday($date)
    {
    	$year = date('Y');
    	$sql = "SELECT
			b.id
			FROM holidays b 
			WHERE b.country_id=5 AND YEAR(b.holiy_dt)='".$year."' AND b.sts<>0";
			$query=$this->db->query($sql)->result();
	if(!empty($query))
	{
		$date_format = implode('-',array_reverse(explode('/',$date)));
    		$sql = "SELECT
			b.id
			FROM holidays b 
			WHERE b.country_id=5 AND b.holiy_dt='".$date_format."' AND b.sts<>0 LIMIT 1";
			$query2=$this->db->query($sql)->row();
		if(!empty($query2))
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}
	else
	{
		return 2;
	}
	return $query;
    }
    function get_pending_status_data($type)
    {
    	
    	$str_where = "b.sts=1 AND b.suit_sts=75 AND final_remarks=1";
    	if (check_group('1')) //For Legal Checker
			{
				$str_where .=" AND b.legal_region IN(".$this->session->userdata['ast_user']['legal_region'].")";
			}
		    	else if (check_group('2')) //For Legal Maker
			{
				$str_where .=" AND b.case_deal_officer='".$this->session->userdata['ast_user']['user_id']."'";
			}
	
	// if($_POST['year']!='' && $_POST['year']!=0)
 //      {
 //      	$year = $_POST['year'];
 //      }
 //      else
 //      {
 //      	$year = date('Y');
 //      }
 //      if($_POST['month']!='' && $_POST['month']!=0)
 //      {
 //      	$month = $_POST['month'];
 //      }
 //      else
 //      {
 //      	$month = date('m');
 //      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.legal_region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
      if($type=='Status Update')
    	{
    		if($_POST['date']=='')
    		{
    			$date = date("Y-m-d");
    			$str_where.= " AND date_format(b.last_case_sts_update_dt,'%Y-%m-%d')='".$this->security->xss_clean($date)."'";
    		}
    		else
    		{
    			if (check_group('3') || check_group('4')) //For Recovery Maker Checker
					{
						$str_where .=" AND b.territory IN(".$this->session->userdata['ast_user']['recovery_territory'].")";
					}
    			$date = date("Y-m-d",strtotime($_POST['date']));
    			$str_where.= " AND date_format(b.last_case_sts_update_dt,'%Y-%m-%d')='".$this->security->xss_clean($date)."'";
    		}
    		
    	}
    	else if($type=='Yet To Fix')
    	{
    		$str_where.= " AND b.next_dt_sts=0 AND b.not_available_sts=0 AND b.next_date!='' AND b.case_sts_prev_dt NOT IN(3,15,7,4)";
    	}
    	else if($type=='Not Available')
    	{
    		$str_where.= " AND b.next_dt_sts=0 AND b.not_available_sts=1 AND b.next_date!='' AND b.case_sts_prev_dt NOT IN(3,15,7,4)";
    	}
    	else
    	{	
    		if($_POST['date']=='')
    		{
    			$date = date("Y-m-d");
    			$str_where.= " AND b.next_date!='' AND final_remarks=1 AND b.next_date!='Yet To Fix' AND b.next_date<='".$this->security->xss_clean($date)."'";
    		}
    		else
    		{
    			$date = date("Y-m-d",strtotime($_POST['date']));
    			$str_where.= " AND b.next_date!='' AND b.next_date='".$this->security->xss_clean($date)."'";
    		}
    		

    	}
    	$sql = "SELECT
				b.id,c.name as court_name,DATE_FORMAT(b.last_date,'%d-%b-%y') AS last_date,last.name as last_step,b.remarks_next_date,r.name as region,t.name as territory,
				DATE_FORMAT(b.prev_date,'%d-%b-%y') as prev_date,
				cd.name as current_plaintiff,l.name as lawyer,cs.name as present_case_sts,cs2.name as case_sts_prev_dt,d.name as district,b.loan_ac,b.ac_name,b.case_number,IF(b.next_dt_sts=1,DATE_FORMAT(b.next_date,'%d-%b-%y'),b.next_date) AS next_date
				FROM suit_filling_info b 
				LEFT OUTER JOIN ref_case_sts cs on(b.case_sts_next_dt=cs.id)
        LEFT OUTER JOIN ref_case_sts last ON (last.id=b.last_step)
				LEFT OUTER JOIN ref_case_sts cs2 on(b.case_sts_prev_dt=cs2.id)
				LEFT OUTER JOIN ref_legal_district d on(b.district=d.id) 
				LEFT OUTER JOIN ref_legal_region r on(b.legal_region=r.id)
				LEFT OUTER JOIN ref_territory t on(b.territory=t.id)  
				LEFT OUTER JOIN ref_court c on(b.prest_court_name=c.id)
				LEFT OUTER JOIN ref_lawyer l on(b.prest_lawyer_name=l.id)
				LEFT OUTER JOIN users_info cd on(b.case_deal_officer=cd.id)
				WHERE $str_where";
				$query=$this->db->query($sql)->result();
		return $query;
    }
    function get_appeal_bail_money_details($operation,$year=NULL,$month=NULL,$district=NULL,$region=NULL,$loan_segment=NULL)
    {
    	$str_where = "";
    	if($year!=NULL && $year!='' && $year!=0)
      {
            $str_where.= " AND YEAR(a.v_dt) = '".$this->security->xss_clean($year)."'";
      }
      if($month!=NULL && $month!='' && $month!=0)
      {
            $str_where.= " AND MONTH(a.v_dt) = '".$this->security->xss_clean($month)."'";
      }
      if($region!=NULL && $region!='' && $region!=0)
      {
             $str_where.= " AND s.region='".$this->security->xss_clean($region)."'";
      }
      if($district!=NULL && $district!='' && $district!=0)
      {
            $str_where.= " AND s.district='".$this->security->xss_clean($district)."'";
      }
      if($loan_segment!=NULL && $loan_segment!='')
      {
            $str_where.= " AND s.loan_segment='".$this->security->xss_clean($loan_segment)."'";
      }

	
      if($operation=='Bail Money')
      {
      	$str_where.= " AND a.appeal_bail_type=2";
      }
      if($operation=='Appeal Money')
      {
      	$str_where.= " AND a.appeal_bail_type=1";
      }
    	$sql = "SELECT a.id,a.deposit_amt,ty.name AS appeal_bail_type,DATE_FORMAT(a.deposit_date,'%d/%m/%Y') AS deposit_date,a.arrested,
		s.loan_ac,s.ac_name,s.case_number,r.name AS region,t.name AS territory,d.name AS district
		FROM appeal_deposit a
		LEFT JOIN suit_filling_info AS s ON s.id=a.suit_id
		LEFT JOIN ref_appeal_bail_type AS ty ON ty.id=a.appeal_bail_type
		LEFT JOIN ref_region AS r ON r.id=s.region
		LEFT JOIN ref_territory AS t ON t.id=s.territory
		LEFT JOIN ref_district AS d ON d.id=s.district
		WHERE a.sts<>0 AND a.v_sts NOT IN(15,35,37,39)
		$str_where";
		$query=$this->db->query($sql)->result();
		return $query;
    }
    function get_appeal_bail_money_data()
    {
    	$str_where = "";
	if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(a.v_dt) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(a.v_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND s.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND s.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND s.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT t1.appeal_money,t2.bail_money 
		FROM (SELECT SUM(deposit_amt) AS appeal_money FROM appeal_deposit a
		LEFT JOIN suit_filling_info AS s ON s.id=a.suit_id
		WHERE a.sts<>0 AND a.v_sts NOT IN(15,35,37,39) AND a.appeal_bail_type=1
		$str_where
		GROUP BY a.appeal_bail_type) AS t1,
		(SELECT SUM(deposit_amt) AS bail_money FROM appeal_deposit a
		LEFT JOIN suit_filling_info AS s ON s.id=a.suit_id
		WHERE a.sts<>0 AND a.v_sts NOT IN(15,35,37,39) AND a.appeal_bail_type=2
		$str_where
		GROUP BY a.appeal_bail_type) AS t2";
		$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_recovery_deposit_amt_data()
    {
	$res_ni = $this->db->query('SELECT SUM(deposit_amt) AS ni_money FROM appeal_deposit a
	LEFT JOIN suit_filling_info AS s ON s.id=a.suit_id
	WHERE a.sts<>0 AND a.v_sts IN(77) AND s.req_type=1
	GROUP BY s.req_type')->row();
	$res_ara = $this->db->query('SELECT SUM(deposit_amt) AS ara_money FROM appeal_deposit a
	LEFT JOIN suit_filling_info AS s ON s.id=a.suit_id
	WHERE a.sts<>0 AND a.v_sts IN(77) AND s.req_type=2
	GROUP BY s.req_type')->row();
	$res_others = $this->db->query('SELECT SUM(deposit_amt) AS others_money FROM appeal_deposit a
	LEFT JOIN suit_filling_info AS s ON s.id=a.suit_id
	WHERE a.sts<>0 AND a.v_sts IN(77) AND s.req_type=3
	GROUP BY s.req_type')->row();

	$query = array(
		'ni_money'=>(isset($res_ni->ni_money)?$res_ni->ni_money:0),
		'ara_money'=>(isset($res_ara->ara_money)?$res_ara->ara_money:0),
		'others_money'=>(isset($res_others->others_money)?$res_others->others_money:0)
	);
	return $query;
    }
    function get_warrent_arrest_data()
    {
    	$str_where = "";
    	$str_where2 = "";
	if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(s.filling_date) = '".$this->security->xss_clean($_POST['year'])."'";
            $str_where2.= " AND YEAR(f.e_dt) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(s.filling_date) = '".$this->security->xss_clean($_POST['month'])."'";
            $str_where2.= " AND MONTH(f.e_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND s.region='".$this->security->xss_clean($_POST['region'])."'";
            $str_where2.= " AND s.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND s.district='".$this->security->xss_clean($_POST['district'])."'";
            $str_where2.= " AND s.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND s.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
            $str_where2.= " AND s.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT t1.total_pending,t2.total_executed FROM
		(SELECT COUNT(s.id) AS total_pending FROM suit_filling_info s
		LEFT JOIN file_executed_data AS f ON f.file_id=s.id
		WHERE s.sts=1 AND ((s.case_sts_prev_dt=15 AND s.req_type=1) OR (s.case_name =4 AND s.req_type =2 AND s.case_sts_prev_dt=29))
		AND (f.v_sts IS NULL OR f.v_sts IN (35,37,39,15))
		$str_where) AS t1 ,
		(SELECT COUNT(f.id) AS total_executed FROM file_executed_data f
		LEFT JOIN suit_filling_info AS s ON s.id=f.file_id
		WHERE f.sts<>0 AND f.status=1 AND f.v_sts=38
		$str_where2) AS t2";
		$query=$this->db->query($sql)->row();
		return $query;
    }
    function get_warrent_details($operation,$year=NULL,$month=NULL,$district=NULL,$region=NULL,$loan_segment=NULL)
    {
    	$str_where2 = "";

    	if($year!=NULL && $year!='' && $year!=0 && $operation=='Pending Warrant')
      {
            $str_where2.= " AND YEAR(f.e_dt) = '".$this->security->xss_clean($year)."'";
      }
      if($month!=NULL && $month!='' && $month!=0 && $operation=='Pending Warrant')
      {
            $str_where2.= " AND MONTH(f.e_dt) = '".$this->security->xss_clean($month)."'";
      }
      if($year!=NULL && $year!='' && $year!=0 && $operation=='Warrant Execution')
      {
            $str_where2.= " AND YEAR(f.v_dt) = '".$this->security->xss_clean($year)."'";
      }
      if($month!=NULL && $month!='' && $month!=0 && $operation=='Warrant Execution')
      {
            $str_where2.= " AND MONTH(f.v_dt) = '".$this->security->xss_clean($month)."'";
      }

      if($region!=NULL && $region!='' && $region!=0)
      {
             $str_where2.= " AND s.region='".$this->security->xss_clean($region)."'";
      }
      if($district!=NULL && $district!='' && $district!=0)
      {
            $str_where2.= " AND s.district='".$this->security->xss_clean($district)."'";
      }
      if($loan_segment!=NULL && $loan_segment!='')
      {
            $str_where2.= " AND s.loan_segment='".$this->security->xss_clean($loan_segment)."'";
      }

      if($operation=='Pending Warrant')
      {
      	$str_where2.= " AND (f.v_sts IS NULL OR f.v_sts IN (35,37,39))";
      }
      else
      {
      	$str_where2.= " AND f.v_sts=38";
      }
    	$sql = "SELECT f.id,s.`loan_ac`,s.`ac_name`,s.`case_number`,s.`case_claim_amount`,
		nw.name AS nature_wa,ab.`name` AS arrested_by,ds.name AS wa_status,ec.name AS executed_criterea,r.name AS region,t.name AS territory,d.name AS district
		FROM suit_filling_info s
		LEFT JOIN file_executed_data AS f  ON f.file_id=s.id
		LEFT JOIN ref_region AS r ON r.id=s.region
		LEFT JOIN ref_territory AS t ON t.id=s.territory
		LEFT JOIN ref_district AS d ON d.id=s.district
		LEFT JOIN ref_nature_warrent_arrest AS nw ON nw.id=f.`nature_wa`
		LEFT JOIN ref_arrested_by AS ab ON ab.id=f.`arrested_by`
		LEFT JOIN ref_disposal_sts AS ds ON ds.id=f.`wa_status`
		LEFT JOIN ref_execution_criteria AS ec ON ec.id=f.`executed_criterea`
		WHERE f.sts<>0 AND f.status=1 $str_where2";
		$query=$this->db->query($sql)->result();
		return $query;
    }
    function get_cma_deshboard($year=null)
    {
    	$str_where = "b.sts=1 AND b.cma_sts<>12 AND b.cma_sts<>5 AND b.v_by IS NOT NULL AND b.v_dt IS NOT NULL";
    	if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.v_dt) = '".$this->security->xss_clean($_POST['year'])."'";
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.v_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
		COUNT(b.id) AS total, 
		SUM(IF(b.req_type=1, 1,0)) AS ni_act,
		SUM(IF(b.req_type=2, 1,0)) AS ara,
		SUM(IF(b.req_type=3 OR b.req_type=4, 1,0)) AS others
		FROM cma b 
		WHERE $str_where";
		$query=$this->db->query($sql)->result();
		return $query;
    }
    function get_cma_deshboard_init($year=null)
    {
    	$str_where = "b.sts=1 AND b.migration_sts<>1";
    	if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(b.v_dt) = '".$this->security->xss_clean($_POST['year'])."'";
            $year = $_POST['year'];
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(b.v_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND b.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND b.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND b.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
		SUM(IF(b.cma_sts=5 OR b.cma_sts=12, 1,0)) AS decs,
		SUM(IF(b.v_by IS NOT NULL, 1,0)) AS app,
		SUM(IF(b.sts=1, 1,0)) AS init
		FROM cma b 
		WHERE $str_where";
		$query=$this->db->query($sql)->result();
		return $query;
    }
    function get_auction_deshboard($year=null)
    {
    	$str_where = "c.sts=1 AND c.migration_sts<>1  AND c.cma_sts<>12 AND c.cma_sts<>5";
    	if($_POST['year']!='' && $_POST['year']!=0)
      {
            $str_where.= " AND YEAR(c.e_dt) = '".$this->security->xss_clean($_POST['year'])."'";
            $year = $_POST['year'];
      }
      else
      {
      	$year = date('Y');
      }
      if($_POST['month']!='' && $_POST['month']!=0)
      {
            $str_where.= " AND MONTH(c.e_dt) = '".$this->security->xss_clean($_POST['month'])."'";
      }
      if($_POST['region']!='' && $_POST['region']!=0)
      {
            $str_where.= " AND c.region='".$this->security->xss_clean($_POST['region'])."'";
      }
      if($_POST['district']!='' && $_POST['district']!=0)
      {
            $str_where.= " AND c.district='".$this->security->xss_clean($_POST['district'])."'";
      }
      if($_POST['loan_segment']!='')
      {
            $str_where.= " AND c.loan_segment='".$this->security->xss_clean($_POST['loan_segment'])."'";
      }
    	$sql = "SELECT
		SUM(IF(b.auction_sts=33 AND YEAR(b.auction_complete_dt)=".$this->db->escape($year).", 1,0)) AS complete, 
		SUM(IF(b.auction_sts=33 AND c.cma_sts>=13 AND YEAR(c.v_dt)=".$this->db->escape($year).", 1,0)) AS approved
		FROM cma_auction b
		LEFT OUTER JOIN cma c on(b.cma_id=c.id)
		WHERE $str_where";
		$query=$this->db->query($sql)->result();
		return $query;
    }
  // CMA verification pending------------------------------
	function get_cma_verify_pending()
	{
	$where2="a.sts = '1'";
	if (check_group('4')) //For Recovery Maker
	{
		$where2 .="AND a.unit_office in(".$this->session->userdata['ast_user']['recovery_unit_office'].")";
	}
	else if(check_group('3'))//Recovery Checker
	{
		$where2 .="AND a.territory IN(".$this->session->userdata['ast_user']['recovery_territory'].")";
	}
    $sql = "SELECT a.loan_ac,a.sl_no,a.id,a.cif,a.proposed_type,s.name as sts,r.name as req_type,b.name as branch_sol
    FROM cma a
    LEFT OUTER JOIN ref_req_type r on(r.id=a.req_type)
    LEFT OUTER JOIN ref_branch_sol b on(b.code=a.branch_sol)
    LEFT OUTER JOIN ref_status s on(s.id=a.cma_sts)
    WHERE ".$where2." and a.cma_sts!='13'";
    $query=$this->db->query($sql)->result();
		$str="";

		$str.='<table class="dashBoardTable" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td class="tabHead" style="height:25px;background-color:#3771CC;color:white" colspan="6" align="center" nowrap="nowrap">
				<strong>CMA Pending Approval</strong></td>
			</tr>
			<tr class="headerrow">
		<td width="5%" style="background-color:#40404a;color:white"><b>SL</b></td>
        <td width="15%" style="background-color:#40404a;color:white"><b>Loan AC</b></td>
        <td width="20%" style="background-color:#40404a;color:white"><b>CIF</b></td>
		<td width="20%" style="background-color:#40404a;color:white"><b>Proposed Type</b></td>
        <td width="20%" style="background-color:#40404a;color:white"><b>Req. Type</b></td>
        <td width="20%" style="background-color:#40404a;color:white"><b>Status</b></td>
			</tr>
		</table>
		<div class="MatrixLayer" style="width:99.8%">
		<table border="1" style="border-collapse:collapse;border-color:#C7C7C7" cellpadding="2" cellspacing="0" width="100%">
		<tbody style="text-align:center">';
		    $count = 1;
		    foreach ($query as $row) {
		      $str.='<tr class="innerRow">
		      <td width="5%">'.$row->sl_no.'</td>
		      <td width="15%"><a href="#" style="color:#4F5155" onclick="return r_history('.$row->id.',\'cma\')">'.$row->loan_ac.'</a></td>
		      <td width="20%">'.$row->cif.'</td>
		      <td width="20%">'.$row->proposed_type.'</td>
		      <td width="20%">'.$row->req_type.'</td>
		      <td width="20%">'.$row->sts.'</td>
		      </tr>';
		      $count++;
		    }

    $str.='</tbody></table></div>';


		return $str;
	}
	// 1st Legal notice verification pending------------------------------
	function get_legal_notice_verify_pending()
	{
	$where2="a.sts = '1'";
	if (check_group('4')) //For Recovery Maker
	{
		$where2 .="AND a.unit_office in(".$this->session->userdata['ast_user']['recovery_unit_office'].")";
	}
	else if(check_group('3'))//Recovery Checker
	{
		$where2 .="AND a.territory IN(".$this->session->userdata['ast_user']['recovery_territory'].")";
	}
    $sql = "SELECT a.loan_ac,a.ac_name,a.sl_no,a.id,a.cif,a.proposed_type,s.name as sts,r.name as req_type,b.name as branch_sol
    FROM legal_notice a
    LEFT OUTER JOIN ref_req_type r on(r.id=a.req_type)
    LEFT OUTER JOIN ref_branch_sol b on(b.code=a.branch_sol)
    LEFT OUTER JOIN ref_status s on(s.id=a.legal_notice_sts)
    WHERE ".$where2." and a.legal_notice_sts<='13'";
    $query=$this->db->query($sql)->result();
		$str="";

		$str.='<table class="dashBoardTable" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td class="tabHead" style="height:25px;background-color:#3771CC;color:white" colspan="6" align="center" nowrap="nowrap">
				<strong>1st Legal Notice Pending Approval</strong></td>
			</tr>
			<tr class="headerrow">
		<td width="5%" style="background-color:#40404a;color:white"><b>SL</b></td>
        <td width="15%" style="background-color:#40404a;color:white"><b>Loan AC</b></td>
        <td width="20%" style="background-color:#40404a;color:white"><b>AC Name</b></td>
        <td width="20%" style="background-color:#40404a;color:white"><b>CIF</b></td>
		<td width="20%" style="background-color:#40404a;color:white"><b>Proposed Type</b></td>
        <td width="20%" style="background-color:#40404a;color:white"><b>Status</b></td>
			</tr>
		</table>
		<div class="MatrixLayer" style="width:99.8%">
		<table border="1" style="border-collapse:collapse;border-color:#C7C7C7" cellpadding="2" cellspacing="0" width="100%">
		<tbody style="text-align:center">';
		    $count = 1;
		    foreach ($query as $row) {
		      $str.='<tr class="innerRow">
		      <td width="5%">'.$row->sl_no.'</td>
		      <td width="15%"><a href="#" style="color:#4F5155" onclick="return r_history('.$row->id.',\'legal_notice\')">'.$row->loan_ac.'</a></td>
		      <td width="20%">'.$row->ac_name.'</td>
		      <td width="20%">'.$row->cif.'</td>
		      <td width="20%">'.$row->proposed_type.'</td>
		      <td width="20%">'.$row->sts.'</td>
		      </tr>';
		      $count++;
		    }

    $str.='</tbody></table></div>';


		return $str;
	}


	function getLastInsertId_12($table_name)
	{
		$sql="SELECT MAX(ID) AS NEXTID FROM ".$table_name." ";
		$query=$this->db->query($sql)->row();
		return $query->NEXTID;
	}
	function get_expense_amount($act_id,$district,$req_type)
	{
		if ($req_type==1) {
			$table_name = "ref_schedule_charges_ni";
		}
		else if ($req_type==2) {
			$table_name = "ref_schedule_charges_ara";
		}
		else{
			$table_name = "ref_schedule_charges_ni";
		}
		$district_array =array(3);
		if (in_array($district,$district_array))
  	{
  		$select = "a.amount_in_dhaka as amount";
  	}else{
  		$select = "a.amount_out_dhaka as amount";
  	}
		$sql="SELECT $select FROM $table_name a WHERE a.id='".$act_id."'";
		$query=$this->db->query($sql)->row();
		return $query;
	}
	function get_parameter_name_data_operation_zone($table,$where=NULL)
	{
	     $this->db->select('*',FALSE);
		 $this->db->from($table);
		 if(!empty($where)) $this->db->where($where, NULL, FALSE);
		 $q=$this->db->get();
		 return $q->row();
	}
	function get_parameter_name($table,$where=NULL)
	{
	   $this->db->select('j0.name,j0.pin,f.name as desig,j0.email_address',FALSE);
		 $this->db->from($table." j0");
		 $this->db->join('ref_functional_designation as f', 'j0.functional_designation_id=f.id', 'left');
		 if(!empty($where)) $this->db->where($where, NULL, FALSE);
		 $this->db->limit(1);
		 $q=$this->db->get();
		 return $q->row();
	}

	function get_user_actual_id($userid)
	{
		$this->db
			->select("users_info.*, date(users_info.password_expiry_date) as password_expiry_dates  ", FALSE)
			->from('users_info')
			->where(array('user_id' => $userid));
		$data = $this->db->get()->row();
		return $data;
	}
	
	function old_pass_check($insert_id,$pass)
	{
		$str = "select * from users_info where data_status='1' and id='".$insert_id."' and password_log='".$pass."'";
		$query=$this->db->query($str);
		// echo $this->db->last_query();
		return $query->num_rows();
	}
	
	function check_user_deleted_or_not($id)
	{
		$sql="SELECT data_status from users_info where user_id='".$id."' LIMIT 1";
		$query=$this->db->query($sql);
		return $query->row()->DATA_STATUS;
	}

	function get_link_group($user_id)
	{
		$this->db->query('SET @@group_concat_max_len = 204800');
		$str = "SELECT
				  slg.id,
				  slg.sort_order,
				  slg.menu_name AS name,
				  slg.has_child,
				  slg.url_prefix,
				  GROUP_CONCAT(
					sub1.menu_cate_id
					ORDER BY sub1.s_order ASC SEPARATOR '#'
				  ) AS sub1_slc_ids,
				  GROUP_CONCAT(
					sub1.slc_Name
					ORDER BY sub1.s_order ASC SEPARATOR '#'
				  ) AS sub1_slc_names,
				  GROUP_CONCAT(
					sub1.nav_sts
					ORDER BY sub1.s_order ASC SEPARATOR '#'
				  ) AS sub1_grid_nav_sts,
				  GROUP_CONCAT(
					sub1.slc_has_child
					ORDER BY sub1.s_order ASC SEPARATOR '#'
				  ) AS sub1_slc_has_childs,
				  GROUP_CONCAT(
					sub1.slc_url_prefix
					ORDER BY sub1.s_order ASC SEPARATOR '#'
				  ) AS sub1_slc_url_prefixs,
				  GROUP_CONCAT(
					sub1.sl_ids
					ORDER BY sub1.s_order ASC SEPARATOR '#'
				  ) AS sub1_sl_ids,
				  GROUP_CONCAT(
					sub1.sl_operations
					ORDER BY sub1.s_order ASC SEPARATOR '#'
				  ) AS sub1_sl_operations,
				  GROUP_CONCAT(
					sub1.sl_url_prefixs
					ORDER BY sub1.s_order ASC SEPARATOR '#'
				  ) AS sub1_sl_url_prefixs,
				  GROUP_CONCAT(
					sub1.sl_names
					ORDER BY sub1.s_order ASC SEPARATOR '#'
				  ) AS sub1_sl_names,
				  GROUP_CONCAT(
					sub1.sl_orders
					ORDER BY sub1.s_order ASC SEPARATOR '#'
				  ) AS sub1_sl_orders
				FROM
				  (SELECT
					slc.menu_group_id,
					slc.sort_order AS s_order,
					sl.menu_cate_id,
					slc.menu_cate_name AS slc_Name,
					slc.grid_nav_sts AS nav_sts,
					slc.url_prefix AS slc_url_prefix,
					slc.has_child AS slc_has_child,
					GROUP_CONCAT(
					  sl.id
					  ORDER BY sl.id ASC SEPARATOR '|'
					) AS sl_ids,
					GROUP_CONCAT(
					  sl.menu_operation
					  ORDER BY sl.id ASC SEPARATOR '|'
					) AS sl_operations,
					GROUP_CONCAT(
					  sl.url_prefix
					  ORDER BY sl.id ASC SEPARATOR '|'
					) AS sl_url_prefixs,
					GROUP_CONCAT(
					  sl.menu_link_name
					  ORDER BY sl.id ASC SEPARATOR '|'
					) AS sl_names,
					GROUP_CONCAT(
					  sl.SORT_ORDER
					  ORDER BY sl.id ASC SEPARATOR '|'
					) AS sl_orders
				  FROM
					users_right ur
					LEFT JOIN menu_link sl
					  ON ur.menu_link_id = sl.id
					LEFT JOIN menu_category slc
					  ON sl.menu_cate_id = slc.ID
				  WHERE ur.user_info_id = '".$user_id."'
					AND sl.data_status = '1'
					AND slc.data_status = '1'
				  GROUP BY sl.menu_cate_id,
					slc.menu_group_id,
					slc.sort_order,
					slc.menu_cate_name,
					slc.url_prefix,
					slc.has_child
				  ORDER BY slc.sort_order) sub1
				  LEFT OUTER JOIN menu_group slg
					ON sub1.menu_group_id = slg.id
				WHERE slg.data_status = '1'
				GROUP BY slg.id,
				  slg.menu_name,
				  slg.has_child,
				  slg.url_prefix,
				  slg.sort_order
				ORDER BY slg.sort_order";

		$data = $this->db->query($str);
		return $data->result();
	}
	function get_checker_info($territory,$region) // get data for edit
	{
		if($territory!='' && $region!=''){
			$str="SELECT g.id,g.user_group_id,g.recovery_makers,
			CONCAT(g.name, ' (', g.pin, ')') AS NAME FROM users_info g WHERE g.verify_status = '0' 
			AND g.block_status = '0'
			AND g.admin_status <> '2'
			AND ((FIND_IN_SET(".$territory.",g.recovery_territory) AND FIND_IN_SET(3,g.user_group_id) AND FIND_IN_SET(".$region.",g.recovery_region)) OR  (FIND_IN_SET(".$region.",g.recovery_region) AND FIND_IN_SET(17,g.user_group_id)))
			ORDER BY g.user_group_id ASC ";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function get_parameter_data($table,$orderby,$where=NULL)
	{
	//echo $table;
	     $this->db->select('*',FALSE);
		 $this->db->from($table);
		 if(!empty($where)) $this->db->where($where);
		 $this->db->order_by($orderby);
		 $q=$this->db->get();
		 // if($table=='par_user_group'){
		 // echo $this->db->last_query();exit;
		 // }
		 return $q->result();
	}
	function get_prefix_name($table,$orderby,$where=NULL)
	{
	//echo $table;
	     $this->db->select('*',FALSE);
		 $this->db->from($table);
		 if(!empty($where)) $this->db->where($where);
		 $this->db->order_by($orderby);
		 $q=$this->db->get();
		 // if($table=='par_user_group'){
		 // echo $this->db->last_query();exit;
		 // }
		 return $q->row();
	}
	function get_parameter_name_data($table,$where=NULL)
	{
	     $this->db->select('*',FALSE);
		 $this->db->from($table);
		 if(!empty($where)) $this->db->where($where, NULL, FALSE);
		 $q=$this->db->get();
		 foreach($q->result() as $row)
		 {
		 	$name=$row->name;
		 }
		 return $name;
	}
    function clean_input_search_data($value)
    {
        $temp = preg_replace("/[^a-zA-Z0-9 -]+/", "", $value );
        return trim($temp);
    }
	function get_serial($table,$field,$condition)// common funtion with delay to get serial number from table
	{
		// sleep for random seconds
		$max = 1;
		$min = 0.015;
		$time = $min + mt_rand() / mt_getrandmax() * ($max - $min);
		sleep($time);
		// wake up !

		$this->db->select("MAX(".$field.") as SL",FALSE);
		$this->db->from($table);
		if(!empty($condition)) $this->db->where($condition,NULL,FALSE);
		$q=$this->db->get();
		$result = $q->result();

		isset($result[0]->SL)?($serial = $result[0]->SL+1):($serial=1);
		return $serial;
	}
	function getLastInsertId($table_name)
	{
		$sql="SELECT MAX(ID) AS NEXTID FROM ".strtolower($table_name)." WHERE e_by=".$this->session->userdata['ast_user']['user_id'];
		$query=$this->db->query($sql)->row();
		return $query->NEXTID;
	}
	function getLastInsertId2($table_name)
	{
		$sql="SELECT MAX(ID) AS NEXTID FROM ".$table_name." WHERE UPLOAD_BY=".$this->session->userdata['ast_user']['user_id'];
		$query=$this->db->query($sql)->row();
		return $query->NEXTID;
	}
	function get_client_info()
	{
		$str = "select * from project_info limit 1 ";
		$query=$this->db->query($str);
		return $query->row();
	}
	function dtf($date,$expect_sign)
	{
		if($expect_sign=='-'){$org_sign='/';}else{$org_sign='-';}
		if(!empty($date)){
			$var=explode($org_sign,$date);
			if(count($var)==3){
				return $var[2].$expect_sign.$var[1].$expect_sign.$var[0];
			}
		}
	 }
	 
	 function encrypt($input = NULL, $status = null)
    {
				if($status == 1){
            return sha1($input);
        }else{
           return hash('sha256', $input);
        }  
		
    }
	
	function checkEncrypt($notEncripted = NULL, $encripted = NULL, $status = null)
    {
        if($status == 1){
            return (sha1($notEncripted) === $encripted);
        }else{
            return (hash('sha256', $notEncripted) === $encripted);
        }        
    }
	
	function send_email($fromEmail,$fromName, $toemail, $ccemail,$subject,$message,$attachment=NULL,$attach_path=NULL)
	{
		if(config_item('email_on_off')=='off')
		{
			$m= "Sent";	
			return $m;
		}
		$fromEmail="";
		date_default_timezone_set('Etc/UTC');

		//require_once 'PHPMailer/PHPMailerAutoload.php';

		require_once'PHPMailer/src/PHPMailer.php';
		require_once'PHPMailer/src/SMTP.php';
		require_once'PHPMailer/src/Exception.php';
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		$mail->isSMTP();
		//$mail->SMTPDebug = 2;
		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->SMTPOptions = array(
			'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
			);
		$mail->SMTPAuth = false;
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		//$mail->Debugoutput = 'html';
		//Set an alternative reply-to address
		//$mail->addReplyTo('replyto@example.com', 'First Last');
		//Set who the message is to be sent to

		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';

		$toA=explode(",", (string)$toemail);
		for($i=0; $i<count($toA);$i++)
		{
			$mail->addAddress($toA[$i], '');
		}

		if($ccemail!='' && strlen($ccemail)>5){
			$ccA=explode(",", $ccemail);
			for($i=0; $i<count($ccA);$i++)
			{
				$mail->AddCC($ccA[$i], '');
			}
		}

		$mail->setFrom($fromEmail, $fromName);
		$mail->Subject = $subject;
		$mail->msgHTML($message);
		if($attachment!=NULL){
			$mail->AddAttachment( $attach_path.$attachment );
		}
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
		$history_data = array(
        'status'=> $m,
        'send_by'=> (isset($this->session->userdata['ast_user']['user_id']))?$this->session->userdata['ast_user']['user_id']:'',
        'send_dt'=>date('Y-m-d H:i:s'),
        'received_by'=> $toemail,
        'email'=> $toemail,
        'message'=> $message,
        'received_dt'=>date('Y-m-d H:i:s')
        );
    $this->db->insert('mail_history', $history_data);
		//echo $m;
		//exit;
		return $m;


	 }

	 function send_sms($message,$mobile,$product_type,$event_id,$received_by)
	 {
	 		if(config_item('sms_on_off')=='off')
			{
				$ss= "failed";	
				return $ss;
			}
	 		$this->load->library('WebService');
      $ws = new WebService();
      $ss='';
      $history_data = array(
          'product_type' => $product_type,
          'product_id'=> $event_id, 
          'send_by'=> $this->session->userdata['ast_user']['user_id'],
          'send_dt'=>date('Y-m-d H:i:s'),
          'received_by'=> $received_by,
          'mobile'=> $mobile,
          'message'=> $message,
          'received_dt'=>date('Y-m-d H:i:s')
          );
      $this->db->insert('sms_history', $history_data);
      $insert_idss = $this->db->insert_id();
      $api_config2=$this->Common_model->get_api_config_data('CBS Middleware','Loan Details');
      if ($api_config2->active_sts==1) {
          $result=$ws->call_service('SendSms',$api_config2->dev_live,$api_config2->api_url,$api_config2->user_id,$api_config2->channel_id,$api_config2->password,$mobile,$message,$insert_idss);
          if(!empty($result) && isset($result['message']))
          {
              if($result['message'][0]=='000')
              {
                  $ss='success';
              }
              else
              {
                  $ss='failed';
              }
              $history_data = array('status'=> $ss);
              $this->db->where('id', $insert_idss);
							$this->db->update('sms_history', $history_data);
          }
        }
      return $ss;
	 }
	
	function coma2($amout,$len2)
	{
		$out2r=$amout;
		$out22r='';
		$len2h=$len2;
		for($i=1; $i<$len2; $i=$i+2)
		{
			$outNext='';
			$out22r=substr($out2r, $len2h-2).','.$out22r;
			$outNext=substr($out2r, 0, $len2h-2);
			if(strlen($outNext)<=2){
			 $out22r=$outNext.','.$out22r;
			 break;
			}
			$len2h=strlen($outNext);
			$out2r=$outNext;

		}
		return $out22r;
	}
	function comma($amout)
	{
		$minSign='';
		$len3=0;
		if($amout<0){
			$removeminus=str_replace("-","",$amout);
			$amout=$removeminus;
			$minSign='-';
		}
		$removeDot=explode(".",$amout);
		if (count($removeDot)==1){$amountf=$amout; $spart='00';}else{$amountf=$removeDot[0]; $spart=$removeDot[1];}

		$len3=strlen($amountf);
		if($len3 > 3)
		{
			$out3=substr($amountf, $len3-3);
			$out2=substr($amountf, 0, $len3-3);
			$len2=strlen($out2);
			$out2r=$out2;

			if($len2 > 2){
				$out22=$this->coma2($out2,$len2);
				$result=$out22.$out3.'.'.$spart;
			}
			else{
			$result=$out2.','.$out3.'.'.$spart;
			}
		}
		else
		{
		$result=$removeDot[0].'.'.$spart;
		}
		return $minSign.$result;
	}
	function commausd($val)
	{
		if($val!=''){return number_format($val,2,'.',',');}
	}
	function get_user_segment($uid)
	{
		$this->db
			->select("j1.id,j1.name", FALSE)
			->from('usr_user_segment as j0')
			->join('par_product_segment as j1', 'j0.segment_id=j1.id', 'left')
			->where('j0.user_id', $uid)
			->where('j1.sts', 1)
			->order_by('j1.name');
		 return $this->db->get()->result();
	}

    function user_activities($ac_id,$section_name=NULL,$row_id=NULL,$table=NULL,$des=NULL,$oprs_reason=NULL,$user=0,$log_id=0)
    {
    	if($user==0 && $log_id==0){
    		$user= $this->session->userdata['ast_user']['user_id'];
    		$log_id= $this->session->userdata['ast_user']['user_full_id'];
    	}
    	$ip=$this->input->ip_address();

	   	if($ip == '0.0.0.0')
		  {
			     $ip = $_SERVER['REMOTE_ADDR'];
	    }

		$data = array(
				'activities_id' => $ac_id,
				'activities_by' => $user,
				'activities_datetime' => date("Y-m-d H:i:s"),
				'ip_address' => $ip,
				'operate_user_id' => $log_id,
				'table_row_id' => $row_id,
				'table_name' => $table,
				'section_name' => $section_name,
				'description_activities' => $des,
				'oprs_reason' => $oprs_reason,
			);

		$query= $this->db->insert('user_activities_history',$data);
    }
    function user_activities_bill($ac_id,$section_name=NULL,$row_id=NULL,$table=NULL,$des=NULL,$oprs_reason=NULL,$user=0,$log_id=0)
    {
    	if($user==0 && $log_id==0){
    		$user= $this->session->userdata['ast_user']['user_id'];
    		$log_id= $this->session->userdata['ast_user']['user_full_id'];
    	}
    	$ip=$this->input->ip_address();

	   	if($ip == '0.0.0.0')
		  {
			     $ip = $_SERVER['REMOTE_ADDR'];
	    }

		$data = array(
				'activities_id' => $ac_id,
				'activities_by' => $user,
				'activities_datetime' => date("Y-m-d H:i:s"),
				'ip_address' => $ip,
				'operate_user_id' => $log_id,
				'table_row_id' => $row_id,
				'table_name' => $table,
				'section_name' => $section_name,
				'description_activities' => $des,
				'oprs_reason' => $oprs_reason,
			);

		$query= $this->db->insert('user_activities_bill',$data);
    }
    function cost_details($datafiled)
    {
        $fields=array(
        	"module_name","ln_cost_select_sts","ln_per_cost","ln_total_qty",
        	"vendor_id","activities_id","vendor_name","main_table_name", 
        	"main_table_id","sub_table_name", "sub_table_id","vendor_type",
        	"vendor_ac_no","txrn_dt","amount","qty","vat","tax",
        	"net_payment","description",
        	"proposed_type",
        	"loan_ac",
        	"cif",
        	"org_loan_ac",
        	"ac_name",
        	"case_number",
        	"req_type",
        	"loan_segment",
        	"region",
        	"territory",
        	"district",
        	"vendor_pin",
        	"suit_id",
        	"court_id",
        	"proxy_sts",
        	"proxy_against",
        	"expense_remarks",
        	"paper_id",
        	"cma_id",
        	"tin",
        	"bin",
        	"mousak",
        	"paper_scan_copy",
        	"paper_expense_approval_file",
        	"paper_bill_vendor_type",
        	"duplicate_bill_with_proxy",
        	"movement_details",
            "move_of_transfortaion",
            "particulars",
            "place",
            "description_of_journey",
            "journey_time",
            "journey_metar",
            "reached_time",
            "reached_metar",
            "purpose",
            "from",
            "time_out",
            "to",
            "time_in",
            "mode",
            "breakdown_bill",
            "to_date",
            "from_date",
            "package_id",
        );
        $table_data=array();
        foreach ($datafiled as $key => $value) {
            if (in_array($key, $fields))
            {
                $table_data[$key] = $value;
            }
        }
        $query= $this->db->insert('cost_details',$table_data);
        return true;
    }
    function cost_details_legal_notice($datafiled)
    {
        $fields=array(
        	"module_name","ln_cost_select_sts","ln_per_cost","ln_total_qty",
        	"vendor_id","activities_id","vendor_name","main_table_name", 
        	"main_table_id","sub_table_name", "sub_table_id","vendor_type",
        	"vendor_ac_no","txrn_dt","amount","qty","vat","tax",
        	"net_payment","description",
        	"proposed_type",
        	"loan_ac",
        	"cif",
        	"org_loan_ac",
        	"ac_name",
        	"case_number",
        	"req_type",
        	"loan_segment",
        	"region",
        	"territory",
        	"district",
        	"vendor_pin",
        	"suit_id",
        	"court_id",
        	"proxy_sts",
        	"proxy_against",
        	"expense_remarks",
        	"paper_id",
        	"cma_id",
        	"tin",
        	"bin",
        	"mousak",
        	"paper_scan_copy",
        	"paper_expense_approval_file",
        	"paper_bill_vendor_type",
        	"duplicate_bill_with_proxy",
        	"movement_details",
            "move_of_transfortaion",
            "particulars",
            "place",
            "description_of_journey",
            "journey_time",
            "journey_metar",
            "reached_time",
            "reached_metar",
            "purpose",
            "from",
            "time_out",
            "to",
            "time_in",
            "mode",
            "breakdown_bill",
            "to_date",
            "from_date",
            "package_id",
        );
        $table_data=array();
        foreach ($datafiled as $key => $value) {
            if (in_array($key, $fields))
            {
                $table_data[$key] = $value;
            }
        }
        $query= $this->db->insert('legal_notice_cost_details',$table_data);
        return true;
    }
    function get_sl_no()
	{
		$prffix='';
		$maxlength=0;
		$counter=1;
		$temp=0;
		$maxc=$this->random_sleep();
 		$max_counter=1;
		$str = "SELECT MAX(SL_COUNTER) as max_counter FROM OUTWARD_INFO
				where DATA_STATUS=1   ";

		$temp=$this->db->query($str)->row()->MAX_COUNTER;
		if($temp==0 || is_null($temp)){
			$max_counter=$counter;
		}else{
			$max_counter=$this->db->query($str)->row()->MAX_COUNTER+1;
		}
		$MaxrefNo=str_pad($max_counter,6,'0',STR_PAD_LEFT).'/'.strtoupper(date('Y'));
		$str = "SELECT * FROM OUTWARD_INFO
				where REMITTANCE_NO='".$MaxrefNo."' AND DATA_STATUS=1 ";
		$no=$this->db->query($str)->num_rows();

		if($no>0){ $this->get_sl_no();}

		$ref[0]=$max_counter;
		$ref[1]=$MaxrefNo;
		return $ref;

	}

	function getMAxRef($table=NULL,$id=NULL,$field=NULL,$branch=NULL)
	{

		$refno1='';
		$refno2='';
		$str1 = "select * from AUTO_REF_NO where ID='$id' and DATA_STATUS='1'";
		$query=$this->db->query($str1);
		foreach( $query->result() as $row){
				$prffix=$row->REF_PREFIX;
				$maxlength=$row->REF_LEN;
			}
		$MaxrefNo=0;

		 $str = "SELECT MAX(SUBSTR($field,".$maxlength.")) AS MAXNUM FROM $table
				WHERE LENGTH($field)=(SELECT MAX(LENGTH($field)) FROM $table where $field LIKE '".$prffix.date('Y')."/%')
				AND $field LIKE '".$prffix.date('Y')."/%' ".$branch;
		$query=$this->db->query($str);

		foreach($query->result() as $row1)
			{
				$MaxrefNo=$row1->MAXNUM;
			}
			$MaxrefNo=$MaxrefNo+1;
			$refno2=$prffix.str_pad($MaxrefNo,4,"0",STR_PAD_LEFT).'/'.date('y');
			$refno1=$prffix.date('Y').'/'.$MaxrefNo;
			return  $refno1.'::::'.$refno2;

	}

function get_inward_counting_no($table=NULL,$field_counter=NULL,$field=NULL,$e_dt=NULL)
	{
		$prffix='INWARD';
		$maxlength=0;
		$counter=1;
		$temp=0;
		$maxc=$this->random_sleep();
 		$max_counter=1;
		$str = "SELECT MAX($field_counter) as max_counter FROM $table
				where DATA_STATUS=1";

		$temp=$this->db->query($str)->row()->MAX_COUNTER;
		if($temp==0 || is_null($temp)){
			$max_counter=$counter;
		}else{

			$max_counter=$this->db->query($str)->row()->MAX_COUNTER+1;
		}
		$MaxrefNo=strtoupper($prffix.''.date('y').''.str_pad($max_counter,5,'0',STR_PAD_LEFT));
		$str = "SELECT * FROM $table
				where $field='".$MaxrefNo."' AND DATA_STATUS=1 ";
		$no=$this->db->query($str)->num_rows();
//echo 'MaxrefNo :'.$MaxrefNo.'max_counter:'.$max_counter.'num row: '.$no;exit;
		if($no>0){ $this->get_inward_counting_no($table,$field_counter,$field,$e_dt);}

		$ref[0]=$max_counter;
		$ref[1]=$MaxrefNo;
		return $ref;

	}
	function get_auto_refno($table=NULL,$field_counter=NULL,$field=NULL,$e_dt=NULL,$ref_type=NULL,$cat=NULL,$sub_cat='0')
	{
		$prffix='';
		$maxlength=0;
		$counter=1;
		$temp=0;
		$str1 = "select * from AUTO_REF_NO where id='".$ref_type."' AND  ROWNUM <= 1";
		$query=$this->db->query($str1);
		 foreach( $query->result() as $row){
		 		$prffix=$row->REF_PREFIX;
		// 		$counter=$row->counter;
		 	}

		$maxc=$this->random_sleep();
 		$max_counter=1;
		$str = "SELECT MAX($field_counter) as max_counter FROM $table
				where ENTITY_CAT_ID='".$cat."' AND ENTITY_SUB_CAT_ID='".$sub_cat."'   ";

		$temp=$this->db->query($str)->row()->MAX_COUNTER;
		// echo is_null($temp);
		if($temp==0 || is_null($temp)){
			// echo "sasas";
			$max_counter=$counter;
		}else{

			$max_counter=$this->db->query($str)->row()->MAX_COUNTER+1;
		}

		 // echo $max_counter;exit;
		$MaxrefNo=strtoupper($prffix.'-'.date('Y').'-'.$max_counter);


		$str = "SELECT * FROM $table
				where $field='".$MaxrefNo."' AND DATA_STATUS=1 ";
		$no=$this->db->query($str)->num_rows();


		if($no>0){ $this->get_auto_refno($table,$field_counter,$field,$e_dt,$ref_type,$cat,$sub_cat);}

		$ref[0]=$max_counter;
		$ref[1]=$MaxrefNo;

		// print_r($ref);exit;
		return $ref;

	}
	function random_sleep()
	{
		$max = 1;
		$min = 0.015;
		$time = $min + mt_rand() / mt_getrandmax() * ($max - $min);
		sleep($time);
	}
	function convert_number($number)
	{
		if (($number < 0) || ($number > 99999999999999))
		{
			return "$number";
		}

		$Co = floor($number / 10000000);  /* Crore (giga) */
		$number -= $Co * 10000000;

		$Gn = floor($number / 1000000);
		//    $number -= $Gn * 1000000;

		$lukn = floor($number / 100000);  //luk (giga)
		$number -= $lukn * 100000;

		$kn = floor($number / 1000);     /* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);      /* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);       /* Tens (deca) */
		$n = $number % 10;               /* Ones */

		$res = "";

		if ($Co)
		{
			$res .= $this->convert_number($Co) . " Crore";
		}

		if ($lukn)
		{
			$res .= (empty($res) ? "" : " ") .
				$this->convert_number($lukn) . " Lac";
		}

		if ($kn)
		{
			$res .= (empty($res) ? "" : " ") .
				$this->convert_number($kn) . " Thousand";
		}

		if ($Hn)
		{
			$res .= (empty($res) ? "" : " ") .
				$this->convert_number($Hn) . " Hundred";
		}

		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven",
		"Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen");

		$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty" , "Ninety");

		if ($Dn || $n)
		{
			if (!empty($res))
			{
				$res .= " ";
			}

			if ($Dn < 2)
			{
				$res .= $ones[$Dn * 10 + $n];
			}
			else
			{
				$res .= $tens[$Dn];

				if ($n)
				{
					$res .= "-" . $ones[$n];
				}
			}
		}

		if (empty($res))
		{
			$res = "zero";
		}

		return $res;
	}
	function convet_TK($amountcon)
	{
		$NO_A=explode(".",$amountcon);
		if (count($NO_A)==1){$part1=$NO_A[0]; $part2='0';}else{$part1=$NO_A[0]; $part2=$NO_A[1];}
		if ($this->convert_number($part2)=="zero")
		{
			return ' '.$this->convert_number($part1).' only';
		}
		else
		{
			return ' '.$this->convert_number($part1).' and Paisa '.$this->convert_number($part2).' only';
		}
	}
	function log_history_entry($table_names=NULL,$id_ref=NULL,$des=NULL)
	{
		$ip = $this->input->ip_address();
		$data = array(
				'activities_by' => isset($this->session->userdata['ast_user']['user_id'])?$this->session->userdata['ast_user']['user_id']:NULL
				,'activities_dt' => date('Y-m-d, H:i:s')
				,'ip' => $ip
				,'table_names' => $table_names
				,'id_ref_no  ' => $id_ref
				,'description' => $des

			);
			//print_r($data);exit;
		$this->db->insert('app_activities', $data);
		$insert_idss= $this->db->insert_id();


			return $insert_idss;

	}
	function getdateformat_for_db($date=NULL)
	{
	    if(!empty($date)){
	    $var="";
	     $var=explode('/',$date);
		if(count($var)==3){
				$returndate=$var[2]."-".$var[1]."-".$var[0];
		 		return $returndate;
		   }
		 else{
		       $var=explode('-',$date);
			    if(count($var)>0){return $date;}

		     }
		}

	 }

	function format_date($date,$expect_sign)
	{
		if (strpos($date,'-') !== false) {
    		$org_sign='-';
		}
		else if (strpos($date,'/') !== false) {
    		$org_sign='/';
		}
		else if (strpos($date,'.') !== false) {
    		$org_sign='.';
		}
		else
			$org_sign='-';

		$months = array (1=>'JAN',2=>'FEB',3=>'MAR',4=>'APR',5=>'MAY',6=>'JUN',7=>'JUL',8=>'AUG',9=>'SEP',10=>'OCT',11=>'NOV',12=>'DEC');

		//if($expect_sign=='-'){$org_sign='-';}else{$org_sign='/';}
			if(!empty($date)){
			$var=explode($org_sign,$date);
			if(count($var)==3){
				//echo $var[2].$expect_sign.$var[1].$expect_sign.$var[0];exit;

				return $var[0].$expect_sign.$months[(int)$var[1]].$expect_sign.substr($var[2], -2);
			}
			else if(count($var)==2){
				//echo $var[0];exit;
				return $var[0].$expect_sign.$months[(int)$var[1]];
			}else if(count($var)==1){
				//echo $var[0];exit;
				return $var[0];
			}
		}
	}
	function load_total_lock()
	{
		$user_branch=$this->session->userdata['ast_user']['user_branch_id'];
		$str = "SELECT ID FROM LC_INFO WHERE DATA_STATUS='1' ";


		if(check_group('2')){
			$str .= " AND QUEUE_GROUP_ID=2 ";
		}else if(check_group('3')){
			$str .= " AND QUEUE_GROUP_ID=3 ";
		}else if(check_group('4')){
			$str .= " AND QUEUE_GROUP_ID=4 ";
		}else if(check_group('5')){
			$str .= " AND QUEUE_GROUP_ID=5 ";
		}else if(check_group('1')){
			$str .= " AND QUEUE_GROUP_ID=1 ";
		}

		$str .= "AND ASSIGN_OR_LOCK_STATUS=0 ";
		$query=$this->db->query($str);
		return $query->result();
	}

	function load_total_self_queue()
	{

		$user_full_id=$this->session->userdata['ast_user']['user_id'];

		$str = "SELECT ID FROM LC_INFO WHERE DATA_STATUS='1' ";
		$str .= " AND (ASSIGN_OR_LOCK_STATUS=1 OR ASSIGN_OR_LOCK_STATUS=2)  AND (LOCK_USER_INFO_ID='".$user_full_id."' ) ";
		if(check_group('2')){
			$str .= " AND QUEUE_GROUP_ID=2 ";
		}else if(check_group('3')){
			$str .= " AND QUEUE_GROUP_ID=3 ";
		}else if(check_group('4')){
			$str .= " AND QUEUE_GROUP_ID=4 ";
		}else if(check_group('5')){
			$str .= " AND QUEUE_GROUP_ID=5 ";
		}else if(check_group('1')){
			$str .= " AND QUEUE_GROUP_ID=1 ";
		}

		$query=$this->db->query($str);
		return $query->result();
	}

	function load_total_assign()
	{
		$user_branch=$this->session->userdata['ast_user']['user_branch_id'];

		$str = "SELECT ID FROM LC_INFO WHERE DATA_STATUS='1'  ";
		//$str .=" AND USER_BRANCH_ID=".$user_branch;
		if(check_group('3')){
			$str .= "AND ASSIGN_OR_LOCK_STATUS=0 AND REJECT_OR_ACCEPT_STATUS=2 AND QUEUE_GROUP_ID=2 ";
		}else if(check_group('4')){
			$str .= "AND ASSIGN_OR_LOCK_STATUS=0 AND (QUEUE_GROUP_ID=2 OR QUEUE_GROUP_ID=3) ";
		}else if(check_group('5')){
			$str .= "AND ASSIGN_OR_LOCK_STATUS=0 AND (QUEUE_GROUP_ID=2 OR QUEUE_GROUP_ID=3 OR QUEUE_GROUP_ID=4) ";
		}else if(check_group('1')){
			$str .= "AND ASSIGN_OR_LOCK_STATUS=0 AND (QUEUE_GROUP_ID=2 OR QUEUE_GROUP_ID=3 OR QUEUE_GROUP_ID=4) ";
		}
		//echo $str;exit;
		$query=$this->db->query($str);
		return $query->result();
	}
	function load_total_user()
	{
		$str = "SELECT ID FROM USERS_INFO WHERE DATA_STATUS='1'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function load_total_user_group()
	{
		$str = "SELECT ID FROM USER_GROUP WHERE DATA_STATUS='1'";
		$query=$this->db->query($str);
		return $query->result();
	}
	function load_total_status($status_id)
	{
		$str = "SELECT ID FROM LC_INFO WHERE DATA_STATUS='1' AND LC_ACTIVITY_STATUS=".$status_id;
		$query=$this->db->query($str);
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	function load_total_issuance_waiting()
	{
		$str = "SELECT ID,BANK_REPLY_ID FROM LC_INFO WHERE DATA_STATUS='1' AND LC_ISSUANCE_STATUS=0 AND BANK_REPLY_ID IS NOT NULL";
		$query=$this->db->query($str);
		return $query->result();
	}
	function load_total_billentry_waiting()
	{
		$str = "SELECT ID,BANK_REPLY_ID FROM LC_INFO WHERE DATA_STATUS='1'AND BANK_REPLY_ID IS NOT NULL  AND PAYMENT_STATUS IS NULL ";
		$query=$this->db->query($str);
		return $query->result();
	}

	function get_account_list_service($CB_NUMBER=NULL)
	{
		$arr_info=array();
		$soapClient = new SoapClient("https://services.thecitybank.com:9773/cApps/services/CBLWebServices?wsdl");
		$auth = new stdClass();

		$auth->cbsCustomerID    = $CB_NUMBER;
		$auth->password      	= 'Rrss146';
		$auth->username      	= 'rrss';

		$auth2 = new StdClass();
		$auth2->request = $auth;
		$value = $soapClient->getCASAAccountsSummary($auth2);
		if(is_object($value->return)){
			if($value->return->responseCode=='100'){
				$result=$value->return->responseData;
				$arr_length=count($result);
				if($arr_length>1){

						$i=0;
						foreach($result as $value){
								$arr_info[$i]['ACCOUNT_NUMBER']=$value->accountNumber;
								$i++;
								if($i>=$arr_length){
									break;
								}
						}
				}
				else{
					$var=array();
					$var['ACCOUNT_NUMBER']=$result->accountNumber;
					$arr_info[0]['ACCOUNT_NUMBER']=$var['ACCOUNT_NUMBER'];
				}

			}
		}
		return $arr_info;
	}
	 function get_loan_account_list_service($CB_NUMBER=NULL)
	{
		$arr_info=array();
		$soapClient = new SoapClient("https://services.thecitybank.com:9773/cApps/services/CBLWebServices?wsdl");
		$auth = new stdClass();

		$auth->cbsCustomerID    = $CB_NUMBER;
		$auth->password      	= 'Rrss146';
		$auth->username      	= 'rrss';

		$auth2 = new StdClass();
		$auth2->request = $auth;
		$value = $soapClient->getLoanAccountsSummary($auth2);
		if(is_object($value->return)){
			if($value->return->responseCode=='100'){
				$result=$value->return->responseData;
				$arr_length=count($result);

				if($arr_length>1){
						$i=0;
						foreach($result as $value){
								$arr_info[$i]['ACCOUNT_NUMBER']=$value->accountNumber;
								$i++;
								if($i>=$arr_length){
									break;
								}
						}
				}
				else{
					$var=array();
					$var['ACCOUNT_NUMBER']=$result->accountNumber;
					$arr_info[0]['ACCOUNT_NUMBER']=$var['ACCOUNT_NUMBER'];
				}

			}
		}
		return $arr_info;
	}

	function get_exchange_rate_code($table=NULL,$cur1=NULL,$cur2=NULL)
	{
		$sql="SELECT L.* FROM ".$table." L
				left outer join REF_CURRENCY_LIST C on(L.CURRENCY1=C.ID)
				left outer join REF_CURRENCY_LIST C2 on(L.CURRENCY2=C2.ID)
				WHERE C.NAME='".$cur1."' AND C2.NAME='".$cur2."' AND L.DATA_STATUS='1'";
			return $this->db->query($sql)->result();
		//	echo $this->db->last_query();exit;
	}
	function get_account_info_service($account=NULL)
	{
		//$arr_info=array('ACCOUNT_NAME'=>'','ACCOUNT_ADDRESS'=>'','ACCOUNT_PHONE'=>'','CUSTOMER_TYPE'=>'','REALIZATION_CURRENCY_ID'=>'','SOL_BRANCH_ID'=>'','ACCOUNT_BALANCE'=>'');
		$arr_info=array();
		//$sql="SELECT ACCOUNT_NAME,ACCOUNT_ADDRESS,ACCOUNT_PHONE,SCHEMA_CODE,REALIZATION_CURRENCY_ID,ACCOUNT_BRANCH_ID,ACCOUNT_BALANCE FROM TEMP_ACCOUNT_LIST WHERE ACCOUNT_NUMBER='".$account."'";
		$sql="SELECT ACCOUNT_NAME,ACCOUNT_ADDRESS,ACCOUNT_PHONE,REALIZATION_CURRENCY_ID,ACCOUNT_BRANCH_ID,ACCOUNT_BALANCE FROM TEMP_ACCOUNT_LIST WHERE ACCOUNT_NUMBER='".$account."'";
		$q=$this->db->query($sql);
		$num=$q->num_rows();
		if($num>0){
			$arr_info['ACCOUNT_NAME']=$q->row()->ACCOUNT_NAME;
			$arr_info['ACCOUNT_ADDRESS']=$q->row()->ACCOUNT_ADDRESS;
			$arr_info['ACCOUNT_PHONE']=$q->row()->ACCOUNT_PHONE;
			//$arr_info['SCHEMA_CODE']=$q->row()->SCHEMA_CODE;
			$arr_info['REALIZATION_CURRENCY']=$q->row()->REALIZATION_CURRENCY_ID;
			$arr_info['SOL_BRANCH_ID']=$q->row()->ACCOUNT_BRANCH_ID;
			$arr_info['ACCOUNT_BALANCE']=$q->row()->ACCOUNT_BALANCE;
		}
		return $arr_info;
	}

	function get_transaction_check_service($tranDate=NULL,$idNumber=NULL,$accountNumber=NULL)
	{
		//$arr_info=array('ACCOUNT_NAME'=>'','ACCOUNT_ADDRESS'=>'','ACCOUNT_PHONE'=>'','CUSTOMER_TYPE'=>'','REALIZATION_CURRENCY_ID'=>'','SOL_BRANCH_ID'=>'','ACCOUNT_BALANCE'=>'');
		$arr_info=array();
		$responseCode='';
		$soapClient = new SoapClient("https://services.thecitybank.com:9773/cApps/services/CBLWebServices?wsdl");


		$auth = new stdClass();
		$auth->username      	= 'rrss';
		$auth->password      	= 'Rrss146';
		$auth->tranDate    = $tranDate;
		$auth->idNumber    = $idNumber;
		$auth->accountNumber    = $accountNumber;

		$auth2 = new StdClass();
		$auth2->request = $auth;
		$value = $soapClient->CBSTransactionStatus($auth2);
		if(is_object($value->return)){
			if($value->return->responseCode=='100'){
				$responseCode ==100;
			}
			if($value->return->responseCode=='101'){
				$responseCode=101;
			}

		}

		return $responseCode;

	}
	function swift_send_service_org($id=NULL)
	{
		$str="SELECT T1.*,T3.NAME CURRENCY
				FROM OUTWARD_INFO T1
				LEFT OUTER JOIN REF_CURRENCY_LIST T3 ON(T3.ID = T1.CURRENCY_ID)
				WHERE T1.ID=".$this->input->post('id');

		$row=$this->db->query($str)->row();
		if($row->REMARKS1 !=''){
			$len_remarks1= strlen($row->REMARKS1);
			if($len_remarks1 >= 1 && $len_remarks1 <=35){
				$R1=substr($row->REMARKS1, 0, 35);
			}
			if($len_remarks1 >= 1 && $len_remarks1 <=70){
				$R1=substr($row->REMARKS1, 0, 35);
				$R2=substr($row->REMARKS1, -($len_remarks1-35));
			}
		}else{
			$R1='';
			$R2='';
		}
		if($row->REMARKS2 !=''){
			$len_remarks2= strlen($row->REMARKS2);
			if($len_remarks2 >= 1 && $len_remarks2 <=35){
				$R3=substr($row->REMARKS2, 0, 35);
			}
			if($len_remarks2 >= 1 && $len_remarks2 <=70){
				$R3=substr($row->REMARKS2, 0, 35);
				$R4=substr($row->REMARKS2, -($len_remarks2-35));
			}

		}else{
			$R3='';
			$R4='';
		}
		if($row->SENDER_TO_RECEIVER !=''){
			$len= strlen($row->SENDER_TO_RECEIVER);

			if($len >= 1 && $len <=35){
				$SENDER_TO_RECEIVER_1=substr($row->SENDER_TO_RECEIVER, 0, 35);
				$SENDER_TO_RECEIVER_2='';
				/*$SENDER_TO_RECEIVER_3='';
				$SENDER_TO_RECEIVER_4='';
				$SENDER_TO_RECEIVER_5='';
				$SENDER_TO_RECEIVER_6='';*/
			}
			else if($len >= 1 && $len <=70){
				$SENDER_TO_RECEIVER_1=substr($row->SENDER_TO_RECEIVER, 0, 35);
				$SENDER_TO_RECEIVER_2=substr($row->SENDER_TO_RECEIVER, -($len-35));
			/*$SENDER_TO_RECEIVER_3='';
				$SENDER_TO_RECEIVER_4='';
				$SENDER_TO_RECEIVER_5='';
				$SENDER_TO_RECEIVER_6='';*/
			}
			/*else if($len >= 1 && $len <=105){
				$SENDER_TO_RECEIVER_1=substr($row->SENDER_TO_RECEIVER, 0, 35);
				$SENDER_TO_RECEIVER_2=substr($row->SENDER_TO_RECEIVER, 36,70);
				$SENDER_TO_RECEIVER_3=substr($row->SENDER_TO_RECEIVER, -($len-70));

				$SENDER_TO_RECEIVER_4='';
				$SENDER_TO_RECEIVER_5='';
				$SENDER_TO_RECEIVER_6='';
			}
			else if($len >= 1 && $len <=140){
				$SENDER_TO_RECEIVER_1=substr($row->SENDER_TO_RECEIVER, 0, 35);
				$SENDER_TO_RECEIVER_2=substr($row->SENDER_TO_RECEIVER, 36,70);
				$SENDER_TO_RECEIVER_3=substr($row->SENDER_TO_RECEIVER, 71,105);
				$SENDER_TO_RECEIVER_4=substr($row->SENDER_TO_RECEIVER, -($len-105));
				$SENDER_TO_RECEIVER_5='';
				$SENDER_TO_RECEIVER_6='';
			}
			else if($len >= 1 && $len <=175){
				$SENDER_TO_RECEIVER_1=substr($row->SENDER_TO_RECEIVER, 0, 35);
				$SENDER_TO_RECEIVER_2=substr($row->SENDER_TO_RECEIVER, 36,70);
				$SENDER_TO_RECEIVER_3=substr($row->SENDER_TO_RECEIVER, 71,105);
				$SENDER_TO_RECEIVER_4=substr($row->SENDER_TO_RECEIVER, 106,140);
				$SENDER_TO_RECEIVER_5=substr($row->SENDER_TO_RECEIVER, -($len-140));

				$SENDER_TO_RECEIVER_6='';
			}

			else if($len >= 1 && $len <=210){
				$SENDER_TO_RECEIVER_1=substr($row->SENDER_TO_RECEIVER, 0, 35);
				$SENDER_TO_RECEIVER_2=substr($row->SENDER_TO_RECEIVER, 36,70);
				$SENDER_TO_RECEIVER_3=substr($row->SENDER_TO_RECEIVER, 71,105);
				$SENDER_TO_RECEIVER_4=substr($row->SENDER_TO_RECEIVER, 106,140);
				$SENDER_TO_RECEIVER_5=substr($row->SENDER_TO_RECEIVER, 141,176);
				$SENDER_TO_RECEIVER_6=substr($row->SENDER_TO_RECEIVER, -($len-176));
			}*/
			//$R6=substr($row->SENDER_TO_RECEIVER, -35);

		}else{
			$SENDER_TO_RECEIVER_1='';
			$SENDER_TO_RECEIVER_2='';
			/*$SENDER_TO_RECEIVER_3='';
			$SENDER_TO_RECEIVER_4='';
			$SENDER_TO_RECEIVER_5='';
			$SENDER_TO_RECEIVER_6='';*/
		}

		if($row->OUTSIDE_CHARGE_ID==1){
			$OUTSIDE_CHARGE_ID='OUR';
		}
		else if($row->OUTSIDE_CHARGE_ID==2){
			$OUTSIDE_CHARGE_ID='BEN';
		}
		else if($row->OUTSIDE_CHARGE_ID==3){
			$OUTSIDE_CHARGE_ID='SHA';
		}else{
			$OUTSIDE_CHARGE_ID='';
		}

		if($row->SWIFT_OR_CODE_STATUS==1){
			$SWIFT_NUMBER=$row->SWIFT_CODE_NUMBER;
			$CODE_NUMBER='';
		}else if($row->SWIFT_OR_CODE_STATUS==0) {
			$SWIFT_NUMBER='';
			$CODE_NUMBER=$row->SWIFT_CODE_NUMBER;
		}else{
			$SWIFT_NUMBER='';
			$CODE_NUMBER='';
		}

		$name1=substr($row->RECEIVER_NAME, 0, 8);
		$name2=substr($row->RECEIVER_NAME, 8, 8);
		$name3=substr($row->RECEIVER_NAME, 16, 8);
		$name4=substr($row->RECEIVER_NAME, 24, 8);

		$address1=substr($row->ACCOUNT_ADDRESS, 0, 45);
		$address2=substr($row->ACCOUNT_ADDRESS, 45, 45);
		$address3=substr($row->ACCOUNT_ADDRESS, 90, 45);

		$val_date = date('ymd', strtotime($row->VALUE_DATE));


		$arr_info = array();
		$soapClient = new SoapClient("https://webservices.thecitybank.com:8088/cApps/services/XmmServices?wsdl");
		$auth = new stdClass();

		$auth->userName      	= 'rrss';
		$auth->password      	= 'Rrss146';

		$auth->transactionNo    = $row->REFERENCE_NUMBER;
		$auth->receiver      	= 'SCBLINBB';
		$auth->branchCode      	= '10006';
		$auth->userId      		= '20121300';
		$auth->receiveDate      = date('d/m/Y');

		$auth->messageType      = 'MT103';


		$auth->field20_1    = $row->REFERENCE_NUMBER;
		$auth->field23B_1    = 'CRED';
		$auth->field32A_1    = $val_date;
		$auth->field32A_2    = $row->CURRENCY;
		$auth->field32A_3    = $row->REMITTANCE_AMOUNT;
		$auth->field33B_1    = $row->CURRENCY;
		$auth->field33B_2    = $row->REMITTANCE_AMOUNT;
		$auth->field50K_1    = $row->REALIZATION_ACCOUNT;
		$auth->field50K_21    = strtoupper($row->ACCOUNT_NAME);
		$auth->field50K_22    = strtoupper($address1);
		$auth->field50K_23    = strtoupper($address2);
		$auth->field50K_24    = strtoupper($address3);
		$auth->field52AD_2    = '';
		$auth->field52A_3    = '';
		$auth->field52D_3    = '';
		$auth->field56AD_2    = '';
		$auth->field56A_3    = strtoupper($row->INTERMEDIARY_INSTITUTION);
		$auth->field56D_3    = '';
		$auth->field57AD_2    = strtoupper($row->SWIFT_CODE_DETAILS);
		$auth->field57A_3    = strtoupper($SWIFT_NUMBER);
		$auth->field57D_3    = strtoupper($CODE_NUMBER);
		$auth->field59_24    = strtoupper($name4);
		$auth->field59_21    = strtoupper($name1);
		$auth->field59_22    = strtoupper($name2);
		$auth->field59_23    = strtoupper($name3);
		$auth->field59_1    = $row->RECEIVER_ACCOUNT_NO;
		$auth->field70_1    = strtoupper($R1);
		$auth->field70_2    = strtoupper($R2);
		$auth->field70_3    = strtoupper($R3);
		$auth->field70_4    = strtoupper($R4);
		$auth->field72_1A    = strtoupper($SENDER_TO_RECEIVER_1);
		$auth->field72_1B     = strtoupper($SENDER_TO_RECEIVER_2);
		//$auth->field72_1C    = $SENDER_TO_RECEIVER_3;
		//$auth->field72_1D     = $SENDER_TO_RECEIVER_4;
		//$auth->field72_1E    = $SENDER_TO_RECEIVER_5;
		//$auth->field72_1F     = $SENDER_TO_RECEIVER_6;
		$auth->field71_1     = $OUTSIDE_CHARGE_ID;




		$auth2 = new StdClass();
		$auth2->request = $auth;
		$value = $soapClient->serviceDeliveryMT103($auth2);
		if(is_object($value->return)){
			if($value->return->responseCode=='100'){
				$arr_info['responseCode']=$value->return->responseCode;
				$arr_info['Message']=$value->return->responseMessage;
				$arr_info['transactionRefNumber']=$value->return->transactionRefNumber;
			}
			if($value->return->responseCode=='110'){
				$arr_info['responseCode']=$value->return->responseCode;
				$arr_info['Message']=$value->return->responseMessage;
				$arr_info['transactionRefNumber']=$value->return->transactionRefNumber;
			}

		}
		return $arr_info;
	}

	function swift_send_service($id=NULL)
	{
		$str="SELECT T1.*,T3.NAME CURRENCY
				FROM OUTWARD_INFO T1
				LEFT OUTER JOIN REF_CURRENCY_LIST T3 ON(T3.ID = T1.CURRENCY_ID)
				WHERE T1.ID=".$this->input->post('id');

		$row=$this->db->query($str)->row();
		if($row->REMARKS1 !=''){
			$len_remarks1= strlen($row->REMARKS1);
			if($len_remarks1 >= 1 && $len_remarks1 <=35){
				$R1=substr($row->REMARKS1, 0, 35);
			}
			if($len_remarks1 >= 1 && $len_remarks1 <=70){
				$R1=substr($row->REMARKS1, 0, 35);
				$R2=substr($row->REMARKS1, -($len_remarks1-35));
			}
		}else{
			$R1='';
			$R2='';
		}
		if($row->REMARKS2 !=''){
			$len_remarks2= strlen($row->REMARKS2);
			if($len_remarks2 >= 1 && $len_remarks2 <=35){
				$R3=substr($row->REMARKS2, 0, 35);
			}
			if($len_remarks2 >= 1 && $len_remarks2 <=70){
				$R3=substr($row->REMARKS2, 0, 35);
				$R4=substr($row->REMARKS2, -($len_remarks2-35));
			}

		}else{
			$R3='';
			$R4='';
		}
		if($row->SENDER_TO_RECEIVER !=''){
			$len= strlen($row->SENDER_TO_RECEIVER);

			if($len >= 1 && $len <=35){
				$SENDER_TO_RECEIVER_1=substr($row->SENDER_TO_RECEIVER, 0, 35);
				$SENDER_TO_RECEIVER_2='';
				/*$SENDER_TO_RECEIVER_3='';
				$SENDER_TO_RECEIVER_4='';
				$SENDER_TO_RECEIVER_5='';
				$SENDER_TO_RECEIVER_6='';*/
			}
			else if($len >= 1 && $len <=70){
				$SENDER_TO_RECEIVER_1=substr($row->SENDER_TO_RECEIVER, 0, 35);
				$SENDER_TO_RECEIVER_2=substr($row->SENDER_TO_RECEIVER, -($len-35));
			/*$SENDER_TO_RECEIVER_3='';
				$SENDER_TO_RECEIVER_4='';
				$SENDER_TO_RECEIVER_5='';
				$SENDER_TO_RECEIVER_6='';*/
			}
			/*else if($len >= 1 && $len <=105){
				$SENDER_TO_RECEIVER_1=substr($row->SENDER_TO_RECEIVER, 0, 35);
				$SENDER_TO_RECEIVER_2=substr($row->SENDER_TO_RECEIVER, 36,70);
				$SENDER_TO_RECEIVER_3=substr($row->SENDER_TO_RECEIVER, -($len-70));

				$SENDER_TO_RECEIVER_4='';
				$SENDER_TO_RECEIVER_5='';
				$SENDER_TO_RECEIVER_6='';
			}
			else if($len >= 1 && $len <=140){
				$SENDER_TO_RECEIVER_1=substr($row->SENDER_TO_RECEIVER, 0, 35);
				$SENDER_TO_RECEIVER_2=substr($row->SENDER_TO_RECEIVER, 36,70);
				$SENDER_TO_RECEIVER_3=substr($row->SENDER_TO_RECEIVER, 71,105);
				$SENDER_TO_RECEIVER_4=substr($row->SENDER_TO_RECEIVER, -($len-105));
				$SENDER_TO_RECEIVER_5='';
				$SENDER_TO_RECEIVER_6='';
			}
			else if($len >= 1 && $len <=175){
				$SENDER_TO_RECEIVER_1=substr($row->SENDER_TO_RECEIVER, 0, 35);
				$SENDER_TO_RECEIVER_2=substr($row->SENDER_TO_RECEIVER, 36,70);
				$SENDER_TO_RECEIVER_3=substr($row->SENDER_TO_RECEIVER, 71,105);
				$SENDER_TO_RECEIVER_4=substr($row->SENDER_TO_RECEIVER, 106,140);
				$SENDER_TO_RECEIVER_5=substr($row->SENDER_TO_RECEIVER, -($len-140));

				$SENDER_TO_RECEIVER_6='';
			}

			else if($len >= 1 && $len <=210){
				$SENDER_TO_RECEIVER_1=substr($row->SENDER_TO_RECEIVER, 0, 35);
				$SENDER_TO_RECEIVER_2=substr($row->SENDER_TO_RECEIVER, 36,70);
				$SENDER_TO_RECEIVER_3=substr($row->SENDER_TO_RECEIVER, 71,105);
				$SENDER_TO_RECEIVER_4=substr($row->SENDER_TO_RECEIVER, 106,140);
				$SENDER_TO_RECEIVER_5=substr($row->SENDER_TO_RECEIVER, 141,176);
				$SENDER_TO_RECEIVER_6=substr($row->SENDER_TO_RECEIVER, -($len-176));
			}*/
			//$R6=substr($row->SENDER_TO_RECEIVER, -35);

		}else{
			$SENDER_TO_RECEIVER_1='';
			$SENDER_TO_RECEIVER_2='';
			/*$SENDER_TO_RECEIVER_3='';
			$SENDER_TO_RECEIVER_4='';
			$SENDER_TO_RECEIVER_5='';
			$SENDER_TO_RECEIVER_6='';*/
		}

		if($row->OUTSIDE_CHARGE_ID==1){
			$OUTSIDE_CHARGE_ID='OUR';
		}
		else if($row->OUTSIDE_CHARGE_ID==2){
			$OUTSIDE_CHARGE_ID='BEN';
		}
		else if($row->OUTSIDE_CHARGE_ID==3){
			$OUTSIDE_CHARGE_ID='SHA';
		}else{
			$OUTSIDE_CHARGE_ID='';
		}

		if($row->SWIFT_OR_CODE_STATUS==1){
			$SWIFT_NUMBER=$row->SWIFT_CODE_NUMBER;
			$CODE_NUMBER='';
		}else if($row->SWIFT_OR_CODE_STATUS==0) {
			$SWIFT_NUMBER='';
			$CODE_NUMBER=$row->SWIFT_CODE_NUMBER;
		}else{
			$SWIFT_NUMBER='';
			$CODE_NUMBER='';
		}

		$name1=substr($row->RECEIVER_NAME, 0, 8);
		$name2=substr($row->RECEIVER_NAME, 8, 8);
		$name3=substr($row->RECEIVER_NAME, 16, 8);
		$name4=substr($row->RECEIVER_NAME, 24, 8);

		$address1=substr($row->ACCOUNT_ADDRESS, 0, 45);
		$address2=substr($row->ACCOUNT_ADDRESS, 45, 45);
		$address3=substr($row->ACCOUNT_ADDRESS, 90, 45);

		$val_date = date('ymd', strtotime($row->VALUE_DATE));


		$arr_info = array();


		$soapUrl = "https://webservices.thecitybank.com:8088/cApps/services/XmmServices?wsdl"; // asmx URL of WSDL

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:axis="http://ws.apache.org/axis2" xmlns:xsd="http://request/xsd">
						<soapenv:Header/>
						<soapenv:Body>
						<axis:serviceDeliveryMT103>
						<!--Optional:-->
						<axis:request>
						<!--Optional:-->
						<xsd:branchCode>10006</xsd:branchCode>
						<!--Optional:-->
						<xsd:businessUnit>RRSS</xsd:businessUnit>
						<!--Optional:-->
						<xsd:field20_1>'.$row->REFERENCE_NUMBER.'</xsd:field20_1>
						<!--Optional:-->
						<xsd:field23B_1>CRED</xsd:field23B_1>
						<!--Optional:-->
						<xsd:field32A_1>'.$val_date.'</xsd:field32A_1>
						<!--Optional:-->
						<xsd:field32A_2>'.$row->CURRENCY.'</xsd:field32A_2>
						<!--Optional:-->
						<xsd:field32A_3>'.$row->REMITTANCE_AMOUNT.'</xsd:field32A_3>
						<!--Optional:-->
						<xsd:field33B_1>'.$row->CURRENCY.'</xsd:field33B_1>
						<!--Optional:-->
						<xsd:field33B_2>'.$row->REMITTANCE_AMOUNT.'</xsd:field33B_2>
						<!--Optional:-->
						<xsd:field50K_1>'.$row->REALIZATION_ACCOUNT.'</xsd:field50K_1>
						<!--Optional:-->
						<xsd:field50K_21>'.strtoupper($row->ACCOUNT_NAME).'</xsd:field50K_21>
						<!--Optional:-->
						<xsd:field50K_22>'.strtoupper($address1).'</xsd:field50K_22>
						<!--Optional:-->
						<xsd:field50K_23>'.strtoupper($address2).'</xsd:field50K_23>
						<!--Optional:-->
						<xsd:field50K_24>'.strtoupper($address3).'</xsd:field50K_24>
						<!--Optional:-->
						<xsd:field52AD_2></xsd:field52AD_2>
						<!--Optional:-->
						<xsd:field52A_3></xsd:field52A_3>
						<!--Optional:-->
						<xsd:field52D_3></xsd:field52D_3>
						<!--Optional:-->
						<xsd:field56AD_2></xsd:field56AD_2>
						<!--Optional:-->
						<xsd:field56A_3>'.strtoupper($row->INTERMEDIARY_INSTITUTION).'</xsd:field56A_3>
						<!--Optional:-->
						<xsd:field56D_3></xsd:field56D_3>
						<!--Optional:-->
						<xsd:field57AD_2>'.strtoupper($row->SWIFT_CODE_DETAILS).'</xsd:field57AD_2>
						<!--Optional:-->
						<xsd:field57A_3>'.strtoupper($SWIFT_NUMBER).'</xsd:field57A_3>
						<!--Optional:-->
						<xsd:field57D_3>'.strtoupper($SWIFT_NUMBER).'</xsd:field57D_3>
						<!--Optional:-->
						<xsd:field59_1>'.$row->RECEIVER_ACCOUNT_NO.'</xsd:field59_1>
						<!--Optional:-->
						<xsd:field59_21>'.strtoupper($name1).'</xsd:field59_21>
						<!--Optional:-->
						<xsd:field59_22>'.strtoupper($name2).'</xsd:field59_22>
						<!--Optional:-->
						<xsd:field59_23>'.strtoupper($name3).'</xsd:field59_23>
						<!--Optional:-->
						<xsd:field59_24>'.strtoupper($name4).'</xsd:field59_24>
						<!--Optional:-->
						<xsd:field70_1>'.strtoupper($R1).'</xsd:field70_1>
						<!--Optional:-->
						<xsd:field70_2>'.strtoupper($R2).'</xsd:field70_2>
						<!--Optional:-->
						<xsd:field70_3>'.strtoupper($R3).'</xsd:field70_3>
						<!--Optional:-->
						<xsd:field70_4>'.strtoupper($R4).'</xsd:field70_4>
						<!--Optional:-->
						<xsd:field71_1>'.$OUTSIDE_CHARGE_ID.'</xsd:field71_1>
						<!--Optional:-->
						<xsd:field72_1A>'.strtoupper($SENDER_TO_RECEIVER_1).'</xsd:field72_1A>
						<!--Optional:-->
						<xsd:field72_1B>'.strtoupper($SENDER_TO_RECEIVER_2).'</xsd:field72_1B>
						<!--Optional:-->
						<xsd:messageType>MT103</xsd:messageType>
						<!--Optional:-->
						<xsd:password>Rrss146</xsd:password>
						<!--Optional:-->
						<xsd:receiveDate>'.date('d/m/Y').'</xsd:receiveDate>
						<!--Optional:-->
						<xsd:receiver>SCBLINBB</xsd:receiver>
						<!--Optional:-->
						<xsd:transactionNo>'.$row->REFERENCE_NUMBER.'</xsd:transactionNo>
						<!--Optional:-->
						<xsd:userId>20121300</xsd:userId>
						<!--Optional:-->
						<xsd:userName>rrss</xsd:userName>
						</axis:request>
						</axis:serviceDeliveryMT103>
						</soapenv:Body>
						</soapenv:Envelope>';   // data from the form, e.g. some ID number

           $headers = array(
                        "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "SOAPAction: http://connecting.website.com/WSDL_Service/GetPrice",
                        "Content-length: ".strlen($xml_post_string),
                    ); //SOAPAction: your op URL

            $url = $soapUrl;

            // PHP cURL  for https connection with auth
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           // curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
           // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // converting
            $response = curl_exec($ch);

            curl_close($ch);
			 // converting
          $response1 = str_replace("<soap:Body>","",$response);
          $response2 = str_replace("</soap:Body>","",$response1);
		  $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
			//echo $response;
			// exit;
		    $xml = new SimpleXMLElement($response);
			$responseCode = $xml->xpath('//ax27responseCode')[0];
			$responseMessage = $xml->xpath('//ax27responseMessage')[0];
			$transactionRefNumber = $xml->xpath('//ax27transactionRefNumber')[0];

		//if(is_object($value->return)){
			if($responseCode=='100'){
				$arr_info['responseCode']=$responseCode;
				$arr_info['Message']=$responseMessage;
				$arr_info['transactionRefNumber']=$transactionRefNumber;
			}
			if($responseCode=='110'){
				$arr_info['responseCode']=$responseCode;
				$arr_info['Message']=$responseMessage;
				$arr_info['transactionRefNumber']=$transactionRefNumber;
			}

		//}
		return $arr_info;
	}
	function xml2array($xmlstring) {
        $xml = simplexml_load_string($xmlstring);
$json = json_encode($xml);
$array = json_decode($json,TRUE);
return $array;
    }

	function check_swift_send_service_org($id=NULL) {
		$arr_info=array();
		$str="SELECT T1.*,T3.NAME CURRENCY
				FROM OUTWARD_INFO T1
				LEFT OUTER JOIN REF_CURRENCY_LIST T3 ON(T3.ID = T1.CURRENCY_ID)
				WHERE T1.ID=".$id;
		$row=$this->db->query($str)->row();

		$soapClient = new SoapClient("https://webservices.thecitybank.com:8088/cApps/services/XmmServices?wsdl");
		$auth = new stdClass();
		$auth->password      	= 'Rrss146';
		$auth->userName      	= 'rrss';
		$auth->transactionNo    = $row->REFERENCE_NUMBER;

		$auth2 = new StdClass();
		$auth2->request = $auth;
		$value = $soapClient->getSDMT103MessageStatus($auth2);
		if(is_object($value->return)){
			//print_r($value->return);exit;
			 if($value->return->responseCode=='100'){
			 	$arr_info['messageStatus']=$value->return->messageStatus;
				$arr_info['responseCode']=$value->return->responseCode;
				$arr_info['responseMessage']=$value->return->responseMessage;
			 }
		}

		return $arr_info;
	}

	function check_swift_send_service($id=NULL) {
		$arr_info=array();
		$str="SELECT T1.*,T3.NAME CURRENCY
				FROM OUTWARD_INFO T1
				LEFT OUTER JOIN REF_CURRENCY_LIST T3 ON(T3.ID = T1.CURRENCY_ID)
				WHERE T1.ID=".$id;
		$row=$this->db->query($str)->row();



		$soapUrl = "https://webservices.thecitybank.com:8088/cApps/services/XmmServices?wsdl"; // asmx URL of WSDL

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:axis="http://ws.apache.org/axis2" xmlns:xsd="http://request/xsd">
			   <soapenv:Header/>
			   <soapenv:Body>
			      <axis:getSDMT103MessageStatus>
			         <!--Optional:-->
			         <axis:request>
			            <!--Optional:-->
			            <xsd:password>Rrss146</xsd:password>
			            <!--Optional:-->
			            <xsd:transactionNo>'.$row->REFERENCE_NUMBER.'</xsd:transactionNo>
			            <!--Optional:-->
			            <xsd:userName>rrss</xsd:userName>
			         </axis:request>
			      </axis:getSDMT103MessageStatus>
			   </soapenv:Body>
			</soapenv:Envelope>';   // data from the form, e.g. some ID number

           $headers = array(
                        "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "SOAPAction: http://connecting.website.com/WSDL_Service/GetPrice",
                        "Content-length: ".strlen($xml_post_string),
                    ); //SOAPAction: your op URL

            $url = $soapUrl;

            // PHP cURL  for https connection with auth
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           // curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
           // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // converting
            $response = curl_exec($ch);
            curl_close($ch);
			 // converting
           $response1 = str_replace("<soap:Body>","",$response);
           $response2 = str_replace("</soap:Body>","",$response1);

		   $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
		    $xml = new SimpleXMLElement($response);
			$responseCode = $xml->xpath('//ax27responseCode')[0];
			$responseMessage = $xml->xpath('//ax27responseMessage')[0];
			$messageStatus = true;


		//if(is_object($value->return)){
			//print_r($value->return);exit;
			if($responseCode=='100'){
			 	$arr_info['messageStatus']=$messageStatus;
				$arr_info['responseCode']=$responseCode;
				$arr_info['responseMessage']=$responseMessage;
			}
		//}

		return $arr_info;
	}

	function get_account_info_service11($account=NULL)
	{
		//$arr_info=array('ACCOUNT_NAME'=>'','ACCOUNT_ADDRESS'=>'','ACCOUNT_PHONE'=>'','CUSTOMER_TYPE'=>'','REALIZATION_CURRENCY_ID'=>'','SOL_BRANCH_ID'=>'','ACCOUNT_BALANCE'=>'');
		$arr_info=array();
		$soapClient = new SoapClient("https://services.thecitybank.com:9773/cApps/services/CBLWebServices?wsdl");
		$auth = new stdClass();

		$auth->username      	= 'rrss';
		$auth->password      	= 'Rrss146';
		$auth->accountNumber    = $account;

		$auth2 = new StdClass();
		$auth2->request = $auth;
		$value = $soapClient->getAccountDetails($auth2);
		if(is_object($value->return)){
			if($value->return->responseCode=='100'){
				$arr_info['ACCOUNT_NAME']=$value->return->responseData->accountName;
				$arr_info['ACCOUNT_ADDRESS']=$value->return->responseData->address;
				$arr_info['ACCOUNT_PHONE']=$value->return->responseData->contactNumber;
			//	$arr_info['SCHEMA_CODE']=$value->return->responseData->acctType;
				$arr_info['REALIZATION_CURRENCY']=$value->return->responseData->currencyCode;
				$arr_info['SOL_BRANCH_ID']=$value->return->responseData->solId;
				$arr_info['ACCOUNT_BALANCE']=$value->return->responseData->balance;
			}
		}

		return $arr_info;
	}
	function get_exchange_rate11($cur1=NULL,$cur2=NULL,$rate_code='MID')
	{
		if($cur1==$cur2){
			return 1.00;
		}else{
			$alter_currency=0;$fcy_to_fcy=0;$temp='';$MID_RATE=0.0000;
			if($cur2=='BDT'){
				$rate_code='TOS';
			}else if($cur1=='BDT'){
				$rate_code='TCB';
			}else if($cur1!='BDT' && $cur2!='BDT' ){
				$rate_code=='MID';
				$RATE1=0.00;$RATE2=0.00;
				if($cur2=='USD'){
					$rate_code='MID';
				}else if($cur1=='USD'){
					$alter_currency=1;
					$temp=$cur1;
					$cur1=$cur2;
					$cur2=$temp;
					$rate_code='MID';
				}else{
					$fcy_to_fcy=1;
					//convert cur1 to USD using MID RATE
					if($cur1!='USD'){

						$fixed_cur = 'USD';
						$var_cur = $cur1;
						$MID_RATE=$this->get_rate_info_service($fixed_cur,$var_cur,$rate_code);

						if($MID_RATE !=0){
							$RATE1=$MID_RATE;
							if($cur1=='JPY'){
								$RATE1=(1/$RATE1);
							}
						}else{
							$RATE1=0.00;
						}
					}else{
						$RATE1=0.00;
					}
					//convert cur2 to USD using MID RATE
					if($cur2!='USD'){

						$fixed_cur = 'USD';
						$var_cur = $cur2;
						$MID_RATE=$this->get_rate_info_service($fixed_cur,$var_cur,$rate_code);

						if($MID_RATE !=0){
							$RATE2=$MID_RATE;
							if($cur2=='JPY'){
								$RATE2=(1/$RATE2);
							}
						}else{
							$RATE2=0.00;
						}
					}else{
						$RATE2=0.00;
					}
					$MID_RATE=$RATE1/$RATE2;
					$MID_RATE=number_format($MID_RATE, 4);
				  }
				}
				if($fcy_to_fcy==0){
					$fixed_cur = $cur1;
					$var_cur = $cur2;
					$MID_RATE=$this->get_rate_info_service($fixed_cur,$var_cur,$rate_code);

					if($MID_RATE !=0){
						$MID_RATE=$MID_RATE;
						if($rate_code=='TCB'){
							$MID_RATE=(1/$MID_RATE);
						}
						if($alter_currency==1){
							$MID_RATE=(1/$MID_RATE);
						}
						$MID_RATE=number_format($MID_RATE, 4);
					}
					else{
						$MID_RATE= 0;
					}
				}

			 return $MID_RATE;

			}

	}
	function get_rate_info_service($fixed_cur=NULL,$var_cur=NULL,$rate_code='MID')
	{
		//$MID_RATE=0;
		$MID_RATE=100;
		/*$soapClient = new SoapClient("https://services.thecitybank.com:9773/cApps/services/CBLWebServices?wsdl");
		$auth = new stdClass();

		$auth->username      	= 'rrss';
		$auth->password      	= 'Rrss146';

		$auth->fixedCurrency    = $fixed_cur;
		$auth->rateCode    = $rate_code;
		$auth->varCurrency    = $var_cur;

		 $auth2 = new StdClass();
		 $auth2->request = $auth;
		 $value = $soapClient->getFinacleRate($auth2);
		 if(is_object($value->return)){
		 	if($value->return->responseCode=='100'){
		 		$MID_RATE=$value->return->rate;
		 	}
		 }*/

		return $MID_RATE;
	}
	//////

	function make_ttum_info($id=NULL,$table=NULL)
	{

		$sql="select RPAD(T.ACCOUNT_NUMBER,16,' ') || RPAD(C.NAME,3,' ') || RPAD(T.SERVICE_OUTLET,8,' ') || T.DR_CR_STATUS ||
			LPAD((case when T.REF_STS=0 then TO_CHAR(T.REFERENCE_AMOUNT) else ' ' end),17,' ') ||
			RPAD(T.ACC_PARTICULARS,30,' ') || RPAD(T.REPORT_CODE,5,' ') ||
			LPAD((case when T.REF_STS=1 then TO_CHAR(T.REFERENCE_AMOUNT) else ' ' end),76,' ') || RPAD(RC.NAME,3,' ') ||
			RPAD((case when T.CODE is null then ' ' else TO_CHAR(T.CODE) end),5,' ') ||
			LPAD((case when T.RATE is null then ' ' else TO_CHAR(T.RATE) end),15,' ') ||
			RPAD(to_char(T.ENTRY_DATETIME,'DD-MM-YYYY'),10,' ') || LPAD(T.REMARKS,412,' ') as TTUM
			from ACOUNTING_TREATMENT T
			left outer join REF_CURRENCY_LIST C on(C.ID=T.CURRENCY_ID)
			left outer join REF_CURRENCY_LIST RC on(RC.ID=T.REFERENCE_CURRENCY)
			 where T.INFO_TABLE_NAME='".$table."' AND T.INFO_ID='".$id."' order by ACCOUNTING_HEAD_ID ASC,DR_CR_STATUS DESC";
			// echo ($sql);exit;
		$q=$this->db->query($sql);

		return $q->result();
	}
	function get_link_right_check_test($user_id,$controller,$url)
	{
		// echo $user_id.':::'.$controller.':::'.$url;exit;
		$str = "SELECT u.* FROM USERS_RIGHT_DETAILS u WHERE u.MENU_LINK_ID IN(
				SELECT j0.ID FROM MENU_LINK j0 WHERE j0.DATA_STATUS = 1
  				AND  SUBSTR(j0.URL_PREFIX,1,INSTR(j0.URL_PREFIX,'/')-1) = '".$controller."' AND j0.DATA_STATUS = 1 )
  				AND u.DATA_STATUS=1 AND u.USER_INFO_ID='".$user_id."' AND u.URL_PROFIX='".$url."'";
		//echo $str;exit;
		$q=$this->db->query($str);

		return $q->result();

	}
	function check_status($id,$table) {
        $r = $this->db->get_where($table, array('id' => $id, 'data_status' => 1));
        $num = $r->num_rows();
        return $num;
    }

     function get_lc_refno($table=NULL,$field_counter=NULL,$field=NULL,$ins_type=NULL)
	{

		$prffix=$ins_type;
		$maxlength=0;
		$counter=1;
		$temp=0;
		$maxc=$this->random_sleep();
 		$max_counter=1;
		$str = "SELECT MAX($field_counter) as max_counter FROM $table
				where DATA_STATUS=1   ";

		$temp=$this->db->query($str)->row()->MAX_COUNTER;
		if($temp==0 || is_null($temp)){
			$max_counter=$counter;
		}else{

			$max_counter=$this->db->query($str)->row()->MAX_COUNTER+1;
		}
		$MaxrefNo=strtoupper(date('Y').'-'.$prffix.'-'.str_pad($max_counter,5,'0',STR_PAD_LEFT));
		$str = "SELECT * FROM $table
				where $field='".$MaxrefNo."' AND DATA_STATUS=1 ";
		$no=$this->db->query($str)->num_rows();

		if($no>0){ $this->get_lc_refno($table,$field_counter,$field,$ins_type);}

		$ref[0]=$max_counter;
		$ref[1]=$MaxrefNo;
		return $ref;

	}


	// 360 degree 
	function get_recommend_info() // get data for edit
	{		
		$where ='j0.sts <>0 ';
		if($_POST['loan_ac']!=''){
			$loan_ac = $this->security->xss_clean($_POST['loan_ac']);
			$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$this->input->post('loan_ac')); 
			$ac_name = $this->security->xss_clean($_POST['loan_ac']);
			$where .=" AND (j0.loan_ac='".$loan_ac."' OR j0.org_loan_ac='".$org_loan_ac."' OR j0.ac_name LIKE '%".$ac_name."%')";
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
			DATE_FORMAT(j0.call_up_dt,'%d-%b-%y %h:%i %p') AS call_up_dt,
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
			DATE_FORMAT(j0.call_up_dt,'%d-%b-%y %h:%i %p') AS call_up_dt,
			DATE_FORMAT(j0.legal_notice_s_dt,'%d-%b-%y %h:%i %p') AS legal_notice_s_dt,
			DATE_FORMAT(j0.rec_dt,'%d-%b-%y %h:%i %p') AS rec_dt", FALSE)
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
		->where($where ,NULL,FALSE)
		->limit(1);
		return  $this->db->get()->row();
		
	}

	function get_suit_info() // get data for edit
	{		
		$where ='b.sts<>0';
		if($_POST['loan_ac']!=''){
			$loan_ac = $this->security->xss_clean($_POST['loan_ac']);
			$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$this->input->post('loan_ac')); 
			$ac_name = $this->security->xss_clean($_POST['loan_ac']);
			$where .=" AND (b.loan_ac='".$loan_ac."' OR b.org_loan_ac='".$org_loan_ac."' OR b.ac_name LIKE '%".$ac_name."%')";
		}
		$this->db
      ->select('b.id,b.arji_copy,b.judge_name,b.both_case_sts,b.merge_case_sts,b.proposed_type,b.req_type,b.case_number,b.case_claim_amount,j0.name as case_name,b.case_deal_officer as case_deal_officer_id,
              b.prest_lawyer_name as prest_lawyer_id,b.prest_court_name as prest_court_id,
              DATE_FORMAT(b.prev_date,"%d-%b-%y") AS prev_date,j1.name as case_sts_prev_dt,
              IF(b.req_type=2,sca.name,scn.name) as act_prev_date,IF(b.next_dt_sts=1,DATE_FORMAT(b.next_date,"%d-%b-%y"),b.next_date) AS next_date,
              j3.name as case_sts_next_dt,b.remarks_next_date,CONCAT(j4.name," (",j4.user_id,")") as filling_plaintiff,
              DATE_FORMAT(b.filling_date,"%d-%b-%y") AS filling_date,
              CONCAT(j6.name," (",j6.user_id,")")as case_deal_officer,j7.name as prev_lawyer_name,
              j8.name as prest_lawyer_name,j9.name as prev_court_name,j10.name as prest_court_name,
              b.loan_ac,b.ac_name,CONCAT(j11.name," (",j11.user_id,")")as e_by,
              DATE_FORMAT(b.e_dt,"%d-%b-%y") AS e_dt', FALSE)
      ->from("suit_filling_info b")
      ->join('ref_case_name as j0', 'b.case_name=j0.id', 'left')
      ->join('ref_case_sts as j1', 'b.case_sts_prev_dt=j1.id', 'left')
      ->join('ref_schedule_charges_ara as sca', 'b.act_prev_date=sca.id AND b.req_type=2', 'left')
      ->join('ref_schedule_charges_ni as scn', 'b.act_prev_date=scn.id AND b.req_type=1', 'left')
      ->join('ref_case_sts as j3', 'b.case_sts_next_dt=j3.id', 'left')
      ->join('users_info as j4', 'b.filling_plaintiff=j4.id', 'left')
      ->join('users_info as j6', 'b.case_deal_officer=j6.id', 'left')
      ->join('ref_lawyer as j7', 'b.prev_lawyer_name=j7.id', 'left')
      ->join('ref_lawyer as j8', 'b.prest_lawyer_name=j8.id', 'left')
      ->join('ref_court as j9', 'b.prev_court_name=j9.id', 'left')
      ->join('ref_court as j10', 'b.prest_court_name=j10.id', 'left')
      ->join('users_info as j11', 'b.e_by=j11.id', 'left')
      ->where($where)
      ->limit(1);
		return  $this->db->get()->row();
		
	}
	
	function get_cma_recommend_info() // get data for edit
	{
		$where ='j0.sts <>0 ';
		if($_POST['loan_ac']!=''){
			$loan_ac = $this->security->xss_clean($_POST['loan_ac']);
			$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$this->input->post('loan_ac')); 
			$ac_name = $this->security->xss_clean($_POST['loan_ac']);
			$where .=" AND (j0.loan_ac='".$loan_ac."' OR j0.org_loan_ac='".$org_loan_ac."' OR j0.ac_name LIKE '%".$ac_name."%')";
		}
		$this->db
		->select("j0.*,a.complete_remarks,a.auction_sign_memo,j0.lawyer as lawyer_id,j0.sec_sts as sec_sts_id,a.auction_date,a.paper_date,a.auction_time,a.auction_address,a.paper_remarks,a.paper_name,a.paper_vendor,a.lawyer,a.ln_serve_dt,a.ln_expiry_dt,a.ln_scan_copy,a.legal_checker_id,auc.name as pre_auc_sts,a.auction_sts,j0.cma_sts as sts,j15.name as cma_sts,CONCAT(j13.name,' (',j13.code,')') as branch_sol,
			j1.name as region_name,j2.name as territory_name,j3.name as district_name,
			j29.name as busi_sts,j30.name as borr_sts,j31.name as case_logic,j32.name as chq_sts,
			j4.name as unit_office_name,r2.name as legal_region_name,j28.name as sec_sts,
			cs.name as pre_case_sts,j26.name as pre_case_type,j27.name as disposal_sts,
			j6.name as subject_name,j7.name as loan_segment,j8.name as e_by,
			j34.name as lawyer_name,DATE_FORMAT(a.ln_serve_dt,'%d-%b-%y') AS ln_serve_dt_format,
			DATE_FORMAT(a.ln_expiry_dt,'%d-%b-%y') AS ln_expiry_dt_format,j38.name as paper_vendor,
			j46.name as lawyer_legal,j0.req_type as requisition,
			j39.name as paper_name,j47.name as case_file_district,j50.name as final_ln_status,
			CONCAT(j33.name,' (',j33.pin,')') as st_auch_by,
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
			CONCAT(j35.name,' (',j35.pin,')') as auc_stc_by,
			CONCAT(j36.name,' (',j36.pin,')') as auc_v_by,
			CONCAT(j37.name,' (',j37.pin,')') as legal_response_by,
			CONCAT(j25.name,' (',j25.pin,')') as auction_complete_by,
			CONCAT(j40.name,' (',j40.pin,')') as auc_ack_by,
			CONCAT(j41.name,' (',j41.pin,')') as auc_st_l_by,
			CONCAT(j42.name,' (',j42.pin,')') as auc_comp_by,
			CONCAT(j43.name,' (',j43.pin,')') as sthoops_by,
			CONCAT(j44.name,' (',j44.pin,')') as deliver_by,
			CONCAT(j45.name,' (',j45.pin,')') as legal_ack_by,
			CONCAT(j48.name,' (',j48.pin,')') as reassigned_legal_user,
			CONCAT(j49.name,' (',j49.pin,')') as reassign_by,
			DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,r.name as req_type,
			DATE_FORMAT(j0.loan_sanction_dt,'%d-%b-%y') AS loan_sanction_dt,
			DATE_FORMAT(j0.stc_dt,'%d-%b-%y %h:%i %p') AS stc_dt,
			DATE_FORMAT(a.stc_dt,'%d-%b-%y %h:%i %p') AS st_auch_dt,
			DATE_FORMAT(j0.pre_cma_app_dt,'%d-%b-%y') AS pre_cma_app_dt,
			DATE_FORMAT(j0.pre_case_fill_dt,'%d-%b-%y') AS pre_case_fill_dt,
			DATE_FORMAT(j0.last_payment_date,'%d-%b-%y') AS last_payment_date,
			DATE_FORMAT(j0.call_up_serv_dt,'%d-%b-%y') AS call_up_serv_dt,
			DATE_FORMAT(j0.return_dt_rm,'%d-%b-%y %h:%i %p') AS r_dt,
			DATE_FORMAT(j0.reject_dt_rm,'%d-%b-%y %h:%i %p') AS reject_dt_rm,
			DATE_FORMAT(j0.ack_dt,'%d-%b-%y %h:%i %p') AS ack_dt,
			DATE_FORMAT(j0.hold_dt,'%d-%b-%y %h:%i %p') AS hold_dt,
			DATE_FORMAT(j0.chq_expiry_date,'%d-%b-%y') AS chq_expiry_date,
			DATE_FORMAT(j0.sth_dt,'%d-%b-%y %h:%i %p') AS sth_dt,
			DATE_FORMAT(j0.q_dt,'%d-%b-%y %h:%i %p') AS q_dt,
			DATE_FORMAT(j0.ho_r_dt,'%d-%b-%y %h:%i %p') AS ho_r_dt,
			DATE_FORMAT(j0.v_dt,'%d-%b-%y %h:%i %p') AS v_dt,
			DATE_FORMAT(a.ack_dt,'%d-%b-%y %h:%i %p') AS auction_complete_dt,
			DATE_FORMAT(j0.holm_r_dt,'%d-%b-%y %h:%i %p') AS holm_r_dt,
			DATE_FORMAT(j0.ho_decline_dt,'%d-%b-%y %h:%i %p') AS ho_decline_dt,
			DATE_FORMAT(a.stc_dt,'%d-%b-%y %h:%i %p') AS auc_stc_dt,
			DATE_FORMAT(a.legal_response_dt,'%d-%b-%y %h:%i %p') AS legal_response_dt,
			DATE_FORMAT(a.auction_v_dt,'%d-%b-%y %h:%i %p') AS auction_v_dt,
			DATE_FORMAT(a.paper_date,'%d-%b-%y') AS paper_date,
			DATE_FORMAT(a.auction_date,'%d-%b-%y') AS auction_date,
			DATE_FORMAT(a.ack_dt,'%d-%b-%y %h:%i %p') AS auc_ack_dt,
			DATE_FORMAT(a.auc_st_l_dt,'%d-%b-%y %h:%i %p') AS auc_st_l_dt,
			DATE_FORMAT(j0.sthoops_dt,'%d-%b-%y %h:%i %p') AS sthoops_dt,
			DATE_FORMAT(j0.deliver_dt,'%d-%b-%y %h:%i %p') AS deliver_dt,
			DATE_FORMAT(a.auction_complete_dt,'%d-%b-%y %h:%i %p') AS auction_complete_dt,
			TIME_FORMAT(a.auction_time,'%h:%i %p') AS auction_time,
			DATE_FORMAT(j0.legal_ack_dt,'%d-%b-%y %h:%i %p') AS legal_ack_dt,
			DATE_FORMAT(j0.ln_sent_date,'%d-%b-%y %h:%i %p') AS ln_sent_date,
			DATE_FORMAT(j0.ln_val_dt,'%d-%b-%y %h:%i %p') AS ln_val_dt,
			DATE_FORMAT(j0.legal_reassign_dt,'%d-%b-%y %h:%i %p') AS legal_reassign_dt", FALSE)
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
		->join("ref_case_sts as cs", "j0.pre_case_sts=cs.id", "left")
		->join("ref_req_type as j26", "j0.pre_case_type=j26.id", "left")
		->join("ref_disposal_sts as j27", "j0.disposal_sts=j27.id", "left")
		->join("ref_sec_sts as j28", "j0.sec_sts=j28.id", "left")
		->join("ref_busi_sts as j29", "j0.busi_sts=j29.id", "left")
		->join("ref_borr_sts as j30", "j0.borr_sts=j30.id", "left")
		->join("ref_case_logic as j31", "j0.case_logic=j31.id", "left")
		->join("ref_chq_sts as j32", "j0.chq_sts=j32.id", "left")
		->join("users_info as j33", "a.stc_by=j33.id", "left")
		->join("ref_lawyer as j34", "a.lawyer=j34.id", "left")
		->join("users_info as j35", "a.stc_by=j35.id", "left")
		->join("users_info as j36", "a.auction_v_by=j36.id", "left")
		->join("users_info as j37", "a.legal_response_by=j37.id", "left")
		->join("ref_paper_vendor as j38", "a.paper_vendor=j38.id", "left")
		->join("ref_paper as j39", "a.paper_name=j39.id", "left")
		->join("users_info as j40", "a.ack_by=j40.id", "left")
		->join("users_info as j41", "a.auc_st_l_by=j41.id", "left")
		->join("users_info as j42", "a.auction_complete_by=j42.id", "left")
		->join("users_info as j43", "j0.sthoops_by=j43.id", "left")
		->join("users_info as j44", "j0.deliver_by=j44.id", "left")
		->join("users_info as j45", "j0.legal_ack_by=j45.id", "left")
		->join("ref_lawyer as j46", "j0.lawyer=j46.id", "left")
		->join("ref_district as j47", "j0.case_fill_dist=j47.id", "left")
		->join("users_info as j48", "j0.temp_legal_user=j48.id", "left")
		->join("users_info as j49", "j0.legal_reassign_by=j49.id", "left")
		->join("ref_ln_status as j50", "j0.ln_status=j50.id", "left")
		->where($where,NULL,FALSE)
		->limit(1);
		return  $this->db->get()->row();
		
	}
	function get_total_hc_running_case(){
		$str_where = "sts<>0 AND v_sts=38 AND final_sts =1 ";
		if($_POST['year']!='' && $_POST['year']!=0)
	      {
	            $str_where.= " AND YEAR(v_dt) = '".$_POST['year']."'";
	      }
	      if($_POST['month']!='' && $_POST['month']!=0)
	      {
	            $str_where.= " AND MONTH(v_dt) = '".$_POST['month']."'";
	      }
	      if($_POST['region']!='' && $_POST['region']!=0)
	      {
	            $str_where.= " AND region='".$_POST['region']."'";
	      }
	      if($_POST['district']!='' && $_POST['district']!=0)
	      {
	            $str_where.= " AND name_dist='".$_POST['district']."'";
	      }

	      if($_POST['loan_segment']!='')
	      {
	            $str_where.= " AND portfolio='".$_POST['loan_segment']."'";
	      }
		$query = $this->db->query("SELECT * FROM hc_matter WHERE ".$str_where);
		return $query->num_rows();
	}
	function get_total_hc_running_case_ad(){
		$str_where = "sts<>0 AND v_sts=38 AND final_sts =1 ";
		if($_POST['year']!='' && $_POST['year']!=0)
	      {
	            $str_where.= " AND YEAR(v_dt) = '".$_POST['year']."'";
	      }
	      if($_POST['month']!='' && $_POST['month']!=0)
	      {
	            $str_where.= " AND MONTH(v_dt) = '".$_POST['month']."'";
	      }
	      if($_POST['region']!='' && $_POST['region']!=0)
	      {
	            $str_where.= " AND region='".$_POST['region']."'";
	      }
	      if($_POST['district']!='' && $_POST['district']!=0)
	      {
	            $str_where.= " AND name_dist='".$_POST['district']."'";
	      }

	      if($_POST['loan_segment']!='')
	      {
	            $str_where.= " AND portfolio='".$_POST['loan_segment']."'";
	      }
		$query = $this->db->query("SELECT * FROM hc_matter_ad WHERE ".$str_where);
		return $query->num_rows();
	}
}
?>