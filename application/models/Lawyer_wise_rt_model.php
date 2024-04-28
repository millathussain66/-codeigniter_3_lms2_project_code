<?php
class Lawyer_wise_rt_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	}
    function get_summery_data()
    {
        $result = array();
        $str_where_cma = "";
        $str_where_suit = "";
        $str_where_cost = "";
        $final_where = "";
        if(isset($_POST))
        {
            if (trim($this->input->post('year')) != '') {
                $str_where_cma.= " AND YEAR(c.v_dt) IN(".$this->input->post('year').")";
                $str_where_suit.= " AND YEAR(s.filling_date) IN(".$this->input->post('year').")";
                $str_where_cost.= " AND YEAR(cd.txrn_dt) IN(".$this->input->post('year').")";
            }
            if (trim($this->input->post('legal_region')) != '') {
                $str_where_cma.= " AND c.legal_region IN(".$this->input->post('legal_region').")";
                $str_where_suit.= " AND s.legal_region IN(".$this->input->post('legal_region').")";
                $str_where_cost.= " AND cd.region IN(".$this->input->post('legal_region').")";
            }
            if (trim($this->input->post('district')) != '') {
                $str_where_cma.= " AND c.case_fill_dist IN(".$this->input->post('district').")";
                $str_where_suit.= " AND s.district IN(".$this->input->post('district').")";
                $str_where_cost.= " AND cd.district IN(".$this->input->post('district').")";
            }
            if (trim($this->input->post('lawyer_name')) != '') {
                $str_where_cma.= " AND c.lawyer IN(".$this->input->post('lawyer_name').")";
                $str_where_suit.= " AND s.prest_lawyer_name IN(".$this->input->post('lawyer_name').")";
                $str_where_cost.= " AND cd.vendor_id IN(".$this->input->post('lawyer_name').")";
                $final_where.= " AND l.id IN(".$this->input->post('lawyer_name').")";
            }
        }
        $sql = "SELECT l.name AS lawyer_name,sub5.*,(sub5.assigned_file_without_cma+sub5.total_assigned_cma) as total_assigned_file 
                FROM ref_lawyer l
                LEFT OUTER JOIN (
                    SELECT sub3.*,sub4.*
                    FROM(
                    SELECT sub.*,sub2.* 
                    FROM(
                        SELECT SUM(IF(s.migration_sts=0 AND s.cma_id<>0 AND s.cma_id IS NOT NULL,1,0)) AS assigned_file_by_cma,
                        SUM(IF(s.migration_sts=1,1,0)) AS assigned_file_without_cma,
                        SUM(IF(s.suit_sts=75 AND s.final_remarks=1,1,0)) AS running_suit,
                        SUM(IF(s.suit_sts=76 AND s.final_remarks=2,1,0)) AS disposed_suit,
                        s.prest_lawyer_name AS lawyer
                        FROM suit_filling_info s
                        WHERE s.sts<>0 AND s.suit_sts IN(75,76) $str_where_suit
                        GROUP BY s.prest_lawyer_name
                    )sub
                    LEFT OUTER JOIN (
                        SELECT SUM(1) AS total_assigned_cma,
                        SUM(IF(c.cma_sts IN(64,65,75,76),1,0)) case_filing_completed,
                        SUM(IF(c.cma_sts NOT IN(64,65,75,76),1,0)) case_filing_pending,
                        c.lawyer AS lawyer_id
                        FROM cma c
                        WHERE c.sts<>0 AND c.migration_sts=0 AND c.cma_sts NOT IN(12,5) AND c.lawyer IS NOT NULL AND c.lawyer<>0 AND c.lawyer!='' $str_where_cma
                        GROUP BY c.lawyer
                    )sub2 ON(sub2.lawyer_id=sub.lawyer)
                    )sub3
                    LEFT OUTER JOIN(
                        SELECT SUM(IF(cd.memo_sts IN(70,88) AND cd.vendor_type=4,cd.amount,0)) AS court_fee_disbursed,
                        SUM(IF(cd.memo_sts IN(70,88) AND cd.main_table_name='cma' AND cd.vendor_type=4 AND cd.migration_sts=0 
                        AND c.cma_sts NOT IN(64,65,75,76) AND c.sts<>0 AND c.cma_sts NOT IN(12,5),cd.amount,0)) AS unused_court_fee,
                        SUM(IF(cd.vendor_type=1 AND cd.memo_sts NOT IN(70,88),cd.amount,0)) AS pending_prof_bill,
                        SUM(IF(cd.vendor_type=1 AND cd.memo_sts IN(70,88),cd.amount,0)) AS disbursed_prof_bill,
                        cd.vendor_id AS vendor
                        FROM cost_details cd
                        LEFT OUTER JOIN cma c ON(c.id=cd.main_table_id AND cd.main_table_name='cma' AND c.lawyer=cd.vendor_id) 
                        WHERE cd.vendor_type IN(1,4) $str_where_cost
                        GROUP BY cd.vendor_id
                    )sub4 ON(sub4.vendor=sub3.lawyer)
                )sub5 ON(sub5.lawyer=l.id)
                WHERE l.data_status=1 $final_where";
        $q=$this->db->query($sql);
        return $q->result();
    }


    function get_disbursed_court_fee()
    {
        $result = array();
        $str_where= "c.memo_sts IN(70,88) AND c.vendor_type IN(4)";
        if(isset($_POST))
        {
            if (trim($this->input->post('year')) != '') {
                $str_where.= " AND YEAR(c.txrn_dt) IN(".$this->input->post('year').")";
            }
            if (trim($this->input->post('legal_region')) != '') {
                $str_where.= " AND c.region IN(".$this->input->post('legal_region').")";
            }
            if (trim($this->input->post('district')) != '') {
                $str_where.= " AND c.district IN(".$this->input->post('district').")";
            }
            if (trim($this->input->post('lawyer_name')) != '') {
                $str_where.= " AND c.vendor_id IN(".$this->input->post('lawyer_name').")";
            }
        }
        $sql = "SELECT
                b.amount,
                b.proposed_type,
                b.org_loan_ac,
                DATE_FORMAT(b.txrn_dt,'%b-%Y') as bill_month,
                rq.name as type_of_case,
                b.loan_ac,b.ac_name,
                lr.name as legal_region_name,
                ls.name as segment_name,
                DATE_FORMAT(bs.stf_dt,'%d-%b-%Y') as stf_dt,
                DATE_FORMAT(bs.memo_e_dt,'%Y') as bill_year,
                DATE_FORMAT(bs.memo_e_dt,'%d-%b-%Y') as bill_payment_date,
                IF(b.activities_id=1 AND b.vendor_type=1,'Legal Notice',b.case_number) AS case_number,
                DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,
                dr.name as district_name,
                tr.name as territory_name,
                IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter' OR b.main_table_name='hc_matter_hst','High Court','Lower Court') as court_type,
                l.name as vendor_name,
                l.code as vendor_code
                FROM (
                    SELECT c.amount,c.proposed_type,c.org_loan_ac,c.txrn_dt,
                     c.loan_ac,c.ac_name,c.activities_id,c.vendor_type,
                     c.case_number,c.main_table_name,
                     c.bill_id,
                    c.req_type,
                    c.region,
                    c.district,
                    c.territory,
                    c.loan_segment,
                    c.vendor_id 
                    FROM cost_details c 
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=c.bill_id)
                    where $str_where
                ) b
                LEFT OUTER JOIN bill_summery bs ON (bs.id=b.bill_id) 
                LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
                LEFT OUTER JOIN ref_legal_region lr on(b.region=lr.id) 
                LEFT OUTER JOIN ref_legal_district dr on(b.district=dr.id) 
                LEFT OUTER JOIN ref_territory tr on(b.territory=tr.id) 
                LEFT OUTER JOIN ref_loan_segment ls on(b.loan_segment=ls.code) 
                LEFT OUTER JOIN ref_lawyer l on(b.vendor_id=l.id)";
        $q=$this->db->query($sql);
        return $q->result();
    }

    function get_unused_court_fee()
    {
        $result = array();
        $str_where= "c.memo_sts IN(70,88) AND c.vendor_type IN(4) AND c.main_table_name='cma' AND c.migration_sts=0 
        AND j0.cma_sts NOT IN(64,65,75,76) AND j0.sts<>0 AND j0.cma_sts NOT IN(12,5)";
        if(isset($_POST))
        {
            if (trim($this->input->post('year')) != '') {
                $str_where.= " AND YEAR(c.txrn_dt) IN(".$this->input->post('year').")";
            }
            if (trim($this->input->post('legal_region')) != '') {
                $str_where.= " AND c.region IN(".$this->input->post('legal_region').")";
            }
            if (trim($this->input->post('district')) != '') {
                $str_where.= " AND c.district IN(".$this->input->post('district').")";
            }
            if (trim($this->input->post('lawyer_name')) != '') {
                $str_where.= " AND c.vendor_id IN(".$this->input->post('lawyer_name').")";
            }
        }
        $sql = "SELECT
                b.amount,
                b.proposed_type,
                b.org_loan_ac,
                DATE_FORMAT(b.txrn_dt,'%b-%Y') as bill_month,
                rq.name as type_of_case,
                b.loan_ac,b.ac_name,
                lr.name as legal_region_name,
                ls.name as segment_name,
                DATE_FORMAT(bs.stf_dt,'%d-%b-%Y') as stf_dt,
                DATE_FORMAT(bs.memo_e_dt,'%Y') as bill_year,
                DATE_FORMAT(bs.memo_e_dt,'%d-%b-%Y') as bill_payment_date,
                IF(b.activities_id=1 AND b.vendor_type=1,'Legal Notice',b.case_number) AS case_number,
                DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,
                dr.name as district_name,
                tr.name as territory_name,
                IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter' OR b.main_table_name='hc_matter_hst','High Court','Lower Court') as court_type,
                l.name as vendor_name,
                l.code as vendor_code
                FROM (
                    SELECT c.amount,c.proposed_type,c.org_loan_ac,c.txrn_dt,
                     c.loan_ac,c.ac_name,c.activities_id,c.vendor_type,
                     c.case_number,c.main_table_name,
                     c.bill_id,
                    c.req_type,
                    c.region,
                    c.district,
                    c.territory,
                    c.loan_segment,
                    c.vendor_id 
                    FROM cost_details c 
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=c.bill_id)
                    LEFT OUTER JOIN cma j0 ON(j0.id=c.main_table_id AND c.main_table_name='cma' AND j0.lawyer=c.vendor_id)
                    where $str_where
                ) b
                LEFT OUTER JOIN bill_summery bs ON (bs.id=b.bill_id) 
                LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
                LEFT OUTER JOIN ref_legal_region lr on(b.region=lr.id) 
                LEFT OUTER JOIN ref_legal_district dr on(b.district=dr.id) 
                LEFT OUTER JOIN ref_territory tr on(b.territory=tr.id) 
                LEFT OUTER JOIN ref_loan_segment ls on(b.loan_segment=ls.code) 
                LEFT OUTER JOIN ref_lawyer l on(b.vendor_id=l.id)";
        $q=$this->db->query($sql);
        return $q->result();
    }

    function get_cma_data()
    {
        $result = array();
        $str_where= "c.sts<>0 AND c.cma_sts NOT IN(12,5) AND c.lawyer IS NOT NULL AND c.lawyer<>0 AND c.lawyer!=''";
        if(isset($_POST))
        {
            if (trim($this->input->post('year')) != '') {
                $str_where.= " AND YEAR(c.v_dt) IN(".$this->input->post('year').")";
            }
            if (trim($this->input->post('legal_region')) != '') {
                $str_where.= " AND c.legal_region IN(".$this->input->post('legal_region').")";
            }
            if (trim($this->input->post('district')) != '') {
                $str_where.= " AND c.case_fill_dist IN(".$this->input->post('district').")";
            }
            if (trim($this->input->post('lawyer_name')) != '') {
                $str_where.= " AND c.lawyer IN(".$this->input->post('lawyer_name').")";
            }
        }
        $sql = "SELECT
                b.proposed_type,
                b.org_loan_ac,
                rq.name as type_of_case,
                b.loan_ac,b.ac_name,
                lr.name as legal_region_name,
                ls.name as segment_name,
                DATE_FORMAT(b.e_dt,'%d-%b-%Y') as initiate_date,
                DATE_FORMAT(b.v_dt,'%d-%b-%Y') as approve_date,
                DATE_FORMAT(b.rec_dt,'%d-%b-%Y') as recommend_date,
                DATE_FORMAT(b.v_dt,'%M') as approve_month,
                DATE_FORMAT(b.v_dt,'%Y') as approve_year,
                dr.name as district_name,
                tr.name as territory_name,
                IF(b.cma_sts IN(64,65,75,76),'Case Filling Completed','Yet To Filling') as case_file_sts
                FROM (
                    SELECT * FROM cma c where $str_where
                ) b
                LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
                LEFT OUTER JOIN ref_legal_region lr on(b.legal_region=lr.id) 
                LEFT OUTER JOIN ref_legal_district dr on(b.case_fill_dist=dr.id) 
                LEFT OUTER JOIN ref_territory tr on(b.territory=tr.id) 
                LEFT OUTER JOIN ref_loan_segment ls on(b.loan_segment=ls.code)";
        $q=$this->db->query($sql);
        return $q->result();
    }

    function get_suit_data()
    {
        $result = array();
        $str_where= "s.sts<>0 AND s.suit_sts IN(75,76)";
        if(isset($_POST))
        {
            if (trim($this->input->post('year')) != '') {
                $str_where.= " AND YEAR(s.filling_date) IN(".$this->input->post('year').")";
            }
            if (trim($this->input->post('legal_region')) != '') {
                $str_where.= " AND s.region IN(".$this->input->post('legal_region').")";
            }
            if (trim($this->input->post('district')) != '') {
                $str_where.= " AND s.district IN(".$this->input->post('district').")";
            }
            if (trim($this->input->post('lawyer_name')) != '') {
                $str_where.= " AND s.prest_lawyer_name IN(".$this->input->post('lawyer_name').")";
            }
        }
        $sql = "SELECT s.id,s.org_loan_ac,s.sts,fr.name as final_remarks,
                s.proposed_type,s.case_number,s.loan_ac,s.ac_name,
                r.name as case_type,
                DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,
                s.case_claim_amount,
                IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,
                IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
                DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,
                DATE_FORMAT(s.last_date,'%d-%b-%y') AS last_date,
                cs.name as case_sts_prev_date,d.name as district,
                lr.name as region,ls.name as loan_segment,
                CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,
                CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,
                ter.name as territory,
                IF(s.cma_id IS NOT NULL AND s.cma_id<>0,'Filed From CMA',IF(s.migration_sts=1,'Migrated','Not Migrated')) as migration_sts,
                CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,
                l.name as lawyer_name
            FROM suit_filling_info as s
            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.legal_region)
            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
            LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
            WHERE $str_where";
        $q=$this->db->query($sql);
        return $q->result();
    }

    function get_pending_lawyer_bill()
    {
        $result = array();
        $str_where = "c.memo_sts NOT IN(70,88) AND c.vendor_type IN(1)";
        if(isset($_POST))
        {
            if (trim($this->input->post('year')) != '') {
                $str_where.= " AND YEAR(c.txrn_dt) IN(".$this->input->post('year').")";
            }
            if (trim($this->input->post('legal_region')) != '') {
                $str_where.= " AND c.region IN(".$this->input->post('legal_region').")";
            }
            if (trim($this->input->post('district')) != '') {
                $str_where.= " AND c.district IN(".$this->input->post('district').")";
            }
            if (trim($this->input->post('lawyer_name')) != '') {
                $str_where.= " AND c.vendor_id IN(".$this->input->post('lawyer_name').")";
            }
        }

        $join = "LEFT OUTER JOIN ref_schedule_charges_ara as ar on (b.vendor_type=1 AND b.activities_id=ar.id and b.req_type=2 AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
        LEFT OUTER JOIN ref_schedule_charges_ni as ni on (b.vendor_type=1 AND b.activities_id=ni.id and b.req_type<>2 AND b.req_type IS NOT NULL AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
        LEFT OUTER JOIN ref_hc_activities as hc on (b.vendor_type=1 AND b.activities_id=hc.id AND (b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter' OR b.main_table_name='hc_matter_hst'))
        LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (b.vendor_type=1 AND b.activities_id=ca.id AND b.main_table_name='case_against_bank')
        LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (b.vendor_type=1 AND b.activities_id=la.id AND b.main_table_name='legal_affairs')
        LEFT OUTER JOIN ref_court_fee_activities as co on (b.vendor_type=4 AND b.activities_id=co.id AND (b.main_table_name='cma' or b.main_table_name='suit_filling_info'))
        LEFT OUTER JOIN ref_lawyer as v4 on (b.vendor_id=v4.id and b.vendor_type=1)
        LEFT OUTER JOIN ref_lawyer as v5 on (b.vendor_id=v5.id and b.vendor_type=4)";
        $select = "IF(b.vendor_type=1,v4.name,IF(b.vendor_type=4,v5.name,b.vendor_name)) as vendor_name,IF(b.vendor_type=1,v4.code,IF(b.vendor_type=4,v5.code,'')) as vendor_code,IF(b.vendor_type=4,co.name,IF(b.vendor_type=2,'News paper Publication',IF(b.activities_id=0,b.description,IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter',hc.name,IF(b.main_table_name='case_against_bank',ca.name,IF(b.main_table_name='legal_affairs',la.name,IF(b.req_type=2,ar.name,ni.name))))))) as act_name";
        $sql = "SELECT
                b.amount,
                b.proposed_type,
                b.org_loan_ac,
                DATE_FORMAT(b.txrn_dt,'%b-%Y') as bill_month,
                rq.name as type_of_case,
                b.loan_ac,b.ac_name,
                lr.name as legal_region_name,
                ls.name as segment_name,
                DATE_FORMAT(bs.stf_dt,'%d-%b-%Y') as stf_dt,
                DATE_FORMAT(bs.memo_e_dt,'%Y') as bill_year,
                DATE_FORMAT(bs.memo_e_dt,'%d-%b-%Y') as bill_payment_date,
                IF(b.activities_id=1 AND b.vendor_type=1,'Legal Notice',b.case_number) AS case_number,
                DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,
                dr.name as district_name,
                tr.name as territory_name,
                IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter' OR b.main_table_name='hc_matter_hst','High Court','Lower Court') as court_type,
                $select
                FROM (
                    SELECT c.amount,c.proposed_type,c.org_loan_ac,c.txrn_dt,
                     c.loan_ac,c.ac_name,c.vendor_type,
                     c.case_number,c.main_table_name,
                     c.bill_id,
                     c.req_type,
                     c.vendor_name,
                     c.description,
                     c.region,
                     c.district,
                     c.territory,
                     c.loan_segment,
                     c.activities_id,
                     c.vendor_id 
                    FROM cost_details c 
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=c.bill_id)
                    where $str_where
                ) b
                LEFT OUTER JOIN bill_summery bs ON (bs.id=b.bill_id) 
                LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
                LEFT OUTER JOIN ref_legal_region lr on(b.region=lr.id) 
                LEFT OUTER JOIN ref_legal_district dr on(b.district=dr.id) 
                LEFT OUTER JOIN ref_territory tr on(b.territory=tr.id) 
                LEFT OUTER JOIN ref_loan_segment ls on(b.loan_segment=ls.code) 
                $join";
        $q=$this->db->query($sql);
        return $q->result();
    }

    function get_disbursed_lawyer_bill()
    {
        $result = array();
        $str_where = "c.memo_sts IN(70,88) AND c.vendor_type IN(1)";
        if(isset($_POST))
        {
            if (trim($this->input->post('year')) != '') {
                $str_where.= " AND YEAR(c.txrn_dt) IN(".$this->input->post('year').")";
            }
            if (trim($this->input->post('legal_region')) != '') {
                $str_where.= " AND c.region IN(".$this->input->post('legal_region').")";
            }
            if (trim($this->input->post('district')) != '') {
                $str_where.= " AND c.district IN(".$this->input->post('district').")";
            }
            if (trim($this->input->post('lawyer_name')) != '') {
                $str_where.= " AND c.vendor_id IN(".$this->input->post('lawyer_name').")";
            }
        }

        $join = "LEFT OUTER JOIN ref_schedule_charges_ara as ar on (b.vendor_type=1 AND b.activities_id=ar.id and b.req_type=2 AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
        LEFT OUTER JOIN ref_schedule_charges_ni as ni on (b.vendor_type=1 AND b.activities_id=ni.id and b.req_type<>2 AND b.req_type IS NOT NULL AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
        LEFT OUTER JOIN ref_hc_activities as hc on (b.vendor_type=1 AND b.activities_id=hc.id AND (b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter' OR b.main_table_name='hc_matter_hst'))
        LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (b.vendor_type=1 AND b.activities_id=ca.id AND b.main_table_name='case_against_bank')
        LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (b.vendor_type=1 AND b.activities_id=la.id AND b.main_table_name='legal_affairs')
        LEFT OUTER JOIN ref_court_fee_activities as co on (b.vendor_type=4 AND b.activities_id=co.id AND (b.main_table_name='cma' or b.main_table_name='suit_filling_info'))
        LEFT OUTER JOIN ref_lawyer as v4 on (b.vendor_id=v4.id and b.vendor_type=1)
        LEFT OUTER JOIN ref_lawyer as v5 on (b.vendor_id=v5.id and b.vendor_type=4)";
        $select = "IF(b.vendor_type=1,v4.name,IF(b.vendor_type=4,v5.name,b.vendor_name)) as vendor_name,IF(b.vendor_type=1,v4.code,IF(b.vendor_type=4,v5.code,'')) as vendor_code,IF(b.vendor_type=4,co.name,IF(b.vendor_type=2,'News paper Publication',IF(b.activities_id=0,b.description,IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter',hc.name,IF(b.main_table_name='case_against_bank',ca.name,IF(b.main_table_name='legal_affairs',la.name,IF(b.req_type=2,ar.name,ni.name))))))) as act_name";
        $sql = "SELECT
                b.amount,
                b.proposed_type,
                b.org_loan_ac,
                DATE_FORMAT(b.txrn_dt,'%b-%Y') as bill_month,
                rq.name as type_of_case,
                b.loan_ac,b.ac_name,
                lr.name as legal_region_name,
                ls.name as segment_name,
                DATE_FORMAT(bs.stf_dt,'%d-%b-%Y') as stf_dt,
                DATE_FORMAT(bs.memo_e_dt,'%Y') as bill_year,
                DATE_FORMAT(bs.memo_e_dt,'%d-%b-%Y') as bill_payment_date,
                IF(b.activities_id=1 AND b.vendor_type=1,'Legal Notice',b.case_number) AS case_number,
                DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,
                dr.name as district_name,
                tr.name as territory_name,
                IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter' OR b.main_table_name='hc_matter_hst','High Court','Lower Court') as court_type,
                $select
                FROM (
                    SELECT c.amount,c.proposed_type,c.org_loan_ac,c.txrn_dt,
                     c.loan_ac,c.ac_name,c.vendor_type,
                     c.case_number,c.main_table_name,
                     c.bill_id,
                     c.req_type,
                     c.vendor_name,
                     c.description,
                     c.region,
                     c.district,
                     c.territory,
                     c.loan_segment,
                     c.activities_id,
                     c.vendor_id 
                    FROM cost_details c 
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=c.bill_id)
                    where $str_where
                ) b
                LEFT OUTER JOIN bill_summery bs ON (bs.id=b.bill_id) 
                LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
                LEFT OUTER JOIN ref_legal_region lr on(b.region=lr.id) 
                LEFT OUTER JOIN ref_legal_district dr on(b.district=dr.id) 
                LEFT OUTER JOIN ref_territory tr on(b.territory=tr.id) 
                LEFT OUTER JOIN ref_loan_segment ls on(b.loan_segment=ls.code) 
                $join";
        $q=$this->db->query($sql);
        return $q->result();
    }
}