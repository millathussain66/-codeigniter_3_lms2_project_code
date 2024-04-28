<?php
class Bb_rt_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	}
	function get_statement_result($branch)
	{
		$month =  date('m');
    	$present_month = (int)$month;
    	//For The Present Quarter Segemnt
		$str="SELECT q.* FROM ref_quarter q
			WHERE FIND_IN_SET($present_month, q.value) LIMIT 1";
        $query=$this->db->query($str);
        $present_quarter = $query->row();

        $present_quarter_months = $present_quarter->value;
        $present_quarter_segment = $present_quarter->segment;

        //For Previous Quarter Segment
        $previous_quarter_segement = ($present_quarter_segment-1);

        if($previous_quarter_segement<0)
        {
        	$previous_quarter_segement = 4;
        }

        $str="SELECT q.* FROM ref_quarter q
			WHERE q.segment='".$previous_quarter_segement."' LIMIT 1";
        $query=$this->db->query($str);
        $previous_quarter = $query->row();
        $previous_quarter_months = $previous_quarter->value;

        $str="SELECT sub3.*,sub4.* FROM
				(
					SELECT '1' AS join_indecator,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$previous_quarter_months.") THEN sub.case_claim_amount ELSE 0 END) AS ni_last_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$previous_quarter_months.") THEN sub.counter ELSE 0 END) AS ni_last_total,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") THEN sub.case_claim_amount ELSE 0 END) AS ni_present_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") THEN sub.counter ELSE 0 END) AS ni_present_total,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(".$present_quarter_months.") AND sub.final_remarks=2 THEN sub.case_claim_amount ELSE 0 END) AS ni_settled_amount,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(".$present_quarter_months.") AND sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS ni_settled_total,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") AND sub.final_remarks=1 THEN sub.case_claim_amount ELSE 0 END) AS ni_unsettled_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") AND sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS ni_unsettled_total
					FROM
					(
					SELECT s.*,'1' AS counter FROM suit_filling_info s
					WHERE s.sts<>0 AND s.req_type=1 AND s.branch_sol='".$branch."'
					)sub GROUP BY sub.req_type

				)sub3
				LEFT OUTER JOIN (
					SELECT '1' AS join_indecator,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$previous_quarter_months.") THEN sub.case_claim_amount ELSE 0 END) AS ara_last_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$previous_quarter_months.") THEN sub.counter ELSE 0 END) AS ara_last_total,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") THEN sub.case_claim_amount ELSE 0 END) AS ara_present_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") THEN sub.counter ELSE 0 END) AS ara_present_total,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(".$present_quarter_months.") AND sub.final_remarks=2 THEN sub.case_claim_amount ELSE 0 END) AS ara_settled_amount,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(".$present_quarter_months.") AND sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS ara_settled_total,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") AND sub.final_remarks=1 THEN sub.case_claim_amount ELSE 0 END) AS ara_unsettled_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") AND sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS ara_unsettled_total
					FROM
					(
					SELECT s.*,'1' AS counter FROM suit_filling_info s
					WHERE s.sts<>0 AND s.req_type=2 AND s.branch_sol='".$branch."'
					)sub GROUP BY sub.req_type
				)sub4 ON(sub3.join_indecator=sub4.join_indecator)";
        $query=$this->db->query($str);
        return $query->row();
		
	}
	function get_statement_result_court($branch)
	{
        $str="SELECT c.*,sub4.* FROM ref_court c
				LEFT OUTER JOIN (
				SELECT sub3.* FROM
				(
					SELECT
					SUM(sub.case_claim_amount) AS total_amount,sub.prest_court_name,
					SUM(sub.counter) AS total_counter,
					SUM(CASE WHEN sub.final_remarks=2 THEN sub.case_claim_amount ELSE 0 END) AS settled_amount,
					SUM(CASE WHEN sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS settled_total,
					SUM(CASE WHEN sub.final_remarks=1 THEN sub.case_claim_amount ELSE 0 END) AS unsettled_amount,
					SUM(CASE WHEN sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS unsettled_total
					FROM
					(
					SELECT s.*,'1' AS counter FROM suit_filling_info s
					WHERE s.sts<>0 AND s.branch_sol='".$branch."'
					)sub GROUP BY sub.prest_court_name

				)sub3

				)sub4 ON(sub4.prest_court_name=c.id)
				WHERE c.data_status<>0";
        $query=$this->db->query($str);
        return $query->result();
		
	}
	function get_statement_result_classified($branch)
	{
		$month =  date('m');
    	$present_month = (int)$month;
    	//For The Present Quarter Segemnt
		$str="SELECT q.* FROM ref_quarter q
			WHERE FIND_IN_SET($present_month, q.value) LIMIT 1";
        $query=$this->db->query($str);
        $present_quarter = $query->row();

        $present_quarter_months = $present_quarter->value;
        $present_quarter_segment = $present_quarter->segment;

        //For Previous Quarter Segment
        $previous_quarter_segement = ($present_quarter_segment-1);

        if($previous_quarter_segement<0)
        {
        	$previous_quarter_segement = 4;
        }

        $str="SELECT q.* FROM ref_quarter q
			WHERE q.segment='".$previous_quarter_segement."' LIMIT 1";
        $query=$this->db->query($str);
        $previous_quarter = $query->row();
        $previous_quarter_months = $previous_quarter->value;


        $str="SELECT l.name,sub3.* FROM ref_loan_segment l
				LEFT OUTER JOIN (
					SELECT sub.loan_segment,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(".$previous_quarter_months.") AND sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS pre_unsettled_total,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") AND sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS prest_settled_total,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") AND sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS prest_unsettled_total
					FROM
					(
						SELECT s.*,'1' AS counter FROM suit_filling_info s
						WHERE s.sts<>0  AND s.branch_sol='".$branch."'
					)sub GROUP BY sub.loan_segment

				)sub3 ON (l.code=sub3.loan_segment)
				WHERE l.data_status<>0";
        $query=$this->db->query($str);
        return $query->result();
		
	}
	function get_case_filed_quarterly($quarter_id)
	{
    	//For The Quarter Segemnt
		$str="SELECT q.* FROM ref_quarter q
			WHERE q.id='".$quarter_id."' LIMIT 1";
        $query=$this->db->query($str);
        $present_quarter = $query->row();

        $present_quarter_months = $present_quarter->value;

        $str="SELECT 
				c.name AS court_name,
				GROUP_CONCAT(sub4.loan_segment  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS loan_segment, 
				GROUP_CONCAT(sub4.no_case_filed  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS no_case_filed,
				GROUP_CONCAT(sub4.no_case_claim_amount  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS no_case_claim_amount,
				GROUP_CONCAT(sub4.no_of_setteled  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS no_of_setteled,
				GROUP_CONCAT(sub4.no_of_setteled_amount  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS no_of_setteled_amount,
				GROUP_CONCAT(sub4.no_of_case_running  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS no_of_case_running,
				GROUP_CONCAT(sub4.no_of_case_running_amount  ORDER BY sub4.prest_court_name ASC SEPARATOR '##' ) AS no_of_case_running_amount,
				SUM(sub4.no_case_filed) AS total_no_case_filed,
				SUM(sub4.no_case_claim_amount) AS total_no_case_claim_amount,
				SUM(sub4.no_of_setteled) AS total_no_of_setteled,
				SUM(sub4.no_of_setteled_amount) AS total_no_of_setteled_amount,
				SUM(sub4.no_of_case_running) AS total_no_of_case_running,
				SUM(sub4.no_of_case_running_amount) AS total_no_of_case_running_amount
				FROM
				(
					SELECT ls.name AS loan_segment,sub.prest_court_name,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") THEN sub.counter ELSE 0 END) AS no_case_filed,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") THEN sub.case_claim_amount ELSE 0 END) AS no_case_claim_amount,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(".$present_quarter_months.") AND sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS no_of_setteled,
					SUM(CASE WHEN MONTH(sub.ac_close_dt) IN(".$present_quarter_months.") AND sub.final_remarks=2 THEN sub.case_claim_amount ELSE 0 END) AS no_of_setteled_amount,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") AND sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS no_of_case_running,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") AND sub.final_remarks=1 THEN sub.case_claim_amount ELSE 0 END) AS no_of_case_running_amount
					FROM
					(
						SELECT s.*,'1' AS counter FROM suit_filling_info s
						WHERE s.sts<>0  
					)sub
					LEFT OUTER JOIN ref_loan_segment ls ON(ls.code=sub.loan_segment)
					GROUP BY sub.loan_segment,sub.prest_court_name,ls.name ORDER BY ls.name
				)sub4 
				LEFT OUTER JOIN ref_court c ON(sub4.prest_court_name=c.id)
				GROUP BY sub4.prest_court_name,c.name";
        $query=$this->db->query($str);
        return $query->result();
		
	}
	function get_internal_report($year)
	{
        $str="SELECT 
				sub2.month_name,
				GROUP_CONCAT(sub2.req_type  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS req_type,
				GROUP_CONCAT(sub2.no_of_setteled  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS no_of_setteled,
				GROUP_CONCAT(sub2.no_of_unsetteled  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS no_of_unsetteled,
				GROUP_CONCAT(sub2.no_case_filed  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS no_case_filed,
				GROUP_CONCAT(sub2.no_case_claim_amount  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS no_case_claim_amount,
				GROUP_CONCAT(sub2.recovery_amount  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS recovery_amount,
				GROUP_CONCAT(sub2.total_recovered  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS total_recovered,
				GROUP_CONCAT(sub2.no_case_claim_amount_settled  ORDER BY sub2.req_type ASC SEPARATOR '##' ) AS no_case_claim_amount_settled
				FROM
				(
				SELECT
				sub.req_type,
				sub.mon,
				SUM(CASE WHEN sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS no_of_setteled,
				SUM(CASE WHEN sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS no_of_unsetteled,
				SUM(sub.counter) AS no_case_filed,sub.month_name,
				SUM(sub.case_claim_amount) AS no_case_claim_amount,
				SUM(CASE WHEN sub.deposit_amount IS NOT NULL THEN sub.deposit_amount ELSE 0 END) AS recovery_amount,
				SUM(CASE WHEN sub.deposit_amount IS NOT NULL THEN sub.counter ELSE 0 END) AS total_recovered,
				SUM(CASE WHEN sub.final_remarks=2 THEN sub.case_claim_amount ELSE 0 END) AS no_case_claim_amount_settled
					FROM
					(
						SELECT s.req_type,s.final_remarks,appeal.deposit_amount,s.ac_close_dt,s.case_claim_amount,'1' AS counter,
						DATE_FORMAT(s.e_dt,'%M') AS month_name,
						DATE_FORMAT(s.e_dt,'%m') AS mon
						FROM suit_filling_info s
						LEFT OUTER JOIN (
							SELECT SUM(a.deposit_amt) AS deposit_amount ,a.suit_id
							FROM appeal_deposit a
							WHERE a.sts<>0 AND a.v_sts=38
							GROUP BY a.suit_id
						)appeal ON(s.id=appeal.suit_id)
						WHERE s.sts<>0 AND YEAR(s.e_dt)='".$year."'
						ORDER BY s.e_dt ASC
					)sub
				GROUP BY sub.req_type,sub.month_name,sub.mon

				)sub2 GROUP BY sub2.mon,sub2.month_name ORDER BY sub2.mon ASC";
        $query=$this->db->query($str);
        return $query->result();
		
	}
	function get_case_filed_quarterly_seg($quarter_id)
	{
    	//For The Quarter Segemnt
		$str="SELECT q.* FROM ref_quarter q
			WHERE q.id='".$quarter_id."' LIMIT 1";
        $query=$this->db->query($str);
        $present_quarter = $query->row();

        $present_quarter_months = $present_quarter->value;
		$str="SELECT ls.name,sub2.* FROM ref_loan_segment ls
				LEFT OUTER JOIN (

					SELECT sub.loan_segment,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") THEN sub.counter ELSE 0 END) AS no_case_filed_prest,
					SUM(CASE WHEN MONTH(sub.e_dt) IN(".$present_quarter_months.") THEN sub.case_claim_amount ELSE 0 END) AS no_case_claim_amount_prest,
					SUM(sub.counter) AS no_case_filed,
					SUM(sub.case_claim_amount) AS no_case_claim_amount,
					SUM(CASE WHEN sub.final_remarks=2 THEN sub.counter ELSE 0 END) AS no_of_setteled,
					SUM(CASE WHEN sub.final_remarks=2 THEN sub.case_claim_amount ELSE 0 END) AS no_of_setteled_amount,
					SUM(CASE WHEN sub.final_remarks=1 THEN sub.counter ELSE 0 END) AS no_of_case_running,
					SUM(CASE WHEN sub.final_remarks=1 THEN sub.case_claim_amount ELSE 0 END) AS no_of_case_running_amount
					FROM
					(
						SELECT s.*,'1' AS counter FROM suit_filling_info s
						WHERE s.sts<>0  
					)sub
					GROUP BY sub.loan_segment

				)sub2 ON(ls.code=sub2.loan_segment)
				WHERE ls.data_status<>0";
        $query=$this->db->query($str);
        return $query->result();
		
	}

}
?>