<?php
class Lawyer_bill_rt_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	}
    function get_ac_wise_lawyer_bill_xl()
    {
        $result = array();
        $str_where = "b.memo_sts IN(70) AND b.vendor_type IN(1,4)";
            $join = "LEFT OUTER JOIN ref_schedule_charges_ara as ar on (b.vendor_type=1 AND b.activities_id=ar.id and b.req_type=2 AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (b.vendor_type=1 AND b.activities_id=ni.id and b.req_type<>2 AND b.req_type IS NOT NULL AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (b.vendor_type=1 AND b.activities_id=hc.id AND (b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (b.vendor_type=1 AND b.activities_id=ca.id AND b.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (b.vendor_type=1 AND b.activities_id=la.id AND b.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_court_fee_activities as co on (b.vendor_type=4 AND b.activities_id=co.id AND (b.main_table_name='cma' or b.main_table_name='suit_filling_info'))
            LEFT OUTER JOIN ref_lawyer as v4 on (b.vendor_id=v4.id and b.vendor_type=1)
            LEFT OUTER JOIN ref_lawyer as v5 on (b.vendor_id=v5.id and b.vendor_type=4)";
            $select = "IF(b.vendor_type=1,v4.name,IF(b.vendor_type=4,v5.name,b.vendor_name)) as vendor_name,IF(b.vendor_type=4,co.name,IF(b.vendor_type=2,'News paper Publication',IF(b.activities_id=0,b.description,IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter',hc.name,IF(b.main_table_name='case_against_bank',ca.name,IF(b.main_table_name='legal_affairs',la.name,IF(b.req_type=2,ar.name,ni.name))))))) as act_name";
        if(isset($_POST))
        {
            if (trim($this->input->post('proposed_type')) != '') {
                if($this->input->post('loan_ac')!='')
                {
                    if (trim($this->input->post('proposed_type'))=='Loan') {
                        $str_where.= " AND b.loan_ac='".trim($this->input->post('loan_ac'))."'";
                    }else
                    {
                        $str_where.= " AND b.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
                    }
                }
            }
            if (trim($this->input->post('lawyer_name')) != '') {
                $str_where.= " AND b.vendor_id=".$this->db->escape(trim($this->input->post('lawyer_name')));
            }
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND b.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('district')) != '') {
                $str_where.= " AND b.district=".$this->db->escape(trim($this->input->post('district')));
            }
            if (trim($this->input->post('from_year'))!= '' && trim($this->input->post('to_year'))!= '') {
                $str_where.=" AND YEAR(b.txrn_dt) >= '".$this->input->post('from_year')."' AND YEAR(b.txrn_dt) <= '".$this->input->post('to_year')."'";
            }
        }
        $sql = "SELECT s1.loan_ac,s1.ac_name,GROUP_CONCAT(s1.act_name) as act_name,s1.type_of_case,
        s1.case_number,s1.vendor_name,s1.txrn_dt,s1.bill_month,SUM(s1.amount) as grand_total,
        GROUP_CONCAT(s1.amount) as amount,s1.segment_name,s1.legal_region_name,s1.checking_month
        FROM(
        SELECT sub.loan_ac,sub.ac_name,IF(sub.act_name='' OR sub.act_name IS NULL,'No Activities',sub.act_name) as act_name,sub.type_of_case,
        sub.case_number,sub.vendor_name,sub.txrn_dt,sub.bill_month,
        SUM(sub.amount) as amount,sub.segment_name,sub.legal_region_name,sub.checking_month
        FROM(
                SELECT
                b.amount,DATE_FORMAT(b.txrn_dt,'%b-%Y') as bill_month,
                rq.name as type_of_case,
                b.loan_ac,b.ac_name,
                lr.name as legal_region_name,
                ls.name as segment_name,
                DATE_FORMAT(bs.memo_e_dt,'%d-%b-%Y') as checking_date,
                DATE_FORMAT(bs.memo_e_dt,'%b-%Y') as checking_month,
                IF(b.activities_id=1 AND b.vendor_type=1,'Legal Notice',b.case_number) AS case_number,
                DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,
                $select
                FROM cost_details b
                LEFT OUTER JOIN bill_summery bs ON (bs.id=b.bill_id) 
                LEFT OUTER JOIN cma cm ON (cm.id=b.main_table_id and b.main_table_name='cma') 
                LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
                LEFT OUTER JOIN ref_legal_region lr on(b.region=lr.id) 
                LEFT OUTER JOIN ref_loan_segment ls on(b.loan_segment=ls.code) 
                $join
                WHERE $str_where)sub GROUP BY sub.loan_ac,sub.act_name)s1 GROUP BY s1.loan_ac";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_ac_wise_lawyer_bill()
    {
        $result = array();
        $str_where = "b.memo_sts IN(70) AND b.vendor_type IN(1,4)";
            $join = "LEFT OUTER JOIN ref_schedule_charges_ara as ar on (b.vendor_type=1 AND b.activities_id=ar.id and b.req_type=2 AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (b.vendor_type=1 AND b.activities_id=ni.id and b.req_type<>2 AND b.req_type IS NOT NULL AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (b.vendor_type=1 AND b.activities_id=hc.id AND (b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (b.vendor_type=1 AND b.activities_id=ca.id AND b.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (b.vendor_type=1 AND b.activities_id=la.id AND b.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_court_fee_activities as co on (b.vendor_type=4 AND b.activities_id=co.id AND (b.main_table_name='cma' or b.main_table_name='suit_filling_info'))
            LEFT OUTER JOIN ref_lawyer as v4 on (b.vendor_id=v4.id and b.vendor_type=1)
            LEFT OUTER JOIN ref_lawyer as v5 on (b.vendor_id=v5.id and b.vendor_type=4)";
            $select = "IF(b.vendor_type=1,v4.name,IF(b.vendor_type=4,v5.name,b.vendor_name)) as vendor_name,IF(b.vendor_type=4,co.name,IF(b.vendor_type=2,'News paper Publication',IF(b.activities_id=0,b.description,IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter',hc.name,IF(b.main_table_name='case_against_bank',ca.name,IF(b.main_table_name='legal_affairs',la.name,IF(b.req_type=2,ar.name,ni.name))))))) as act_name";
        if(isset($_POST))
        {
            if (trim($this->input->post('proposed_type')) != '') {
                if($this->input->post('loan_ac')!='')
                {
                    if (trim($this->input->post('proposed_type'))=='Loan') {
                        $str_where.= " AND b.loan_ac='".trim($this->input->post('loan_ac'))."'";
                    }else
                    {
                        $str_where.= " AND b.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
                    }
                }
            }
            if (trim($this->input->post('lawyer_name')) != '') {
                $str_where.= " AND b.vendor_id=".$this->db->escape(trim($this->input->post('lawyer_name')));
            }
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND b.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('district')) != '') {
                $str_where.= " AND b.district=".$this->db->escape(trim($this->input->post('district')));
            }
            if (trim($this->input->post('from_year'))!= '' && trim($this->input->post('to_year'))!= '') {
                $str_where.=" AND YEAR(b.txrn_dt) >= '".$this->input->post('from_year')."' AND YEAR(b.txrn_dt) <= '".$this->input->post('to_year')."'";
            }
        }
        $sql = "SELECT sub.loan_ac,sub.ac_name,IF(sub.act_name='' OR sub.act_name IS NULL,'No Activities',sub.act_name) as act_name,sub.type_of_case,
        sub.case_number,sub.vendor_name,sub.txrn_dt,sub.bill_month,
        SUM(sub.amount) as amount,sub.segment_name,sub.legal_region_name,sub.checking_month
        FROM(
                SELECT
                b.amount,DATE_FORMAT(b.txrn_dt,'%b-%Y') as bill_month,
                rq.name as type_of_case,
                b.loan_ac,b.ac_name,
                lr.name as legal_region_name,
                ls.name as segment_name,
                DATE_FORMAT(bs.memo_e_dt,'%d-%b-%Y') as checking_date,
                DATE_FORMAT(bs.memo_e_dt,'%b-%Y') as checking_month,
                IF(b.activities_id=1 AND b.vendor_type=1,'Legal Notice',b.case_number) AS case_number,
                DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,
                $select
                FROM cost_details b
                LEFT OUTER JOIN bill_summery bs ON (bs.id=b.bill_id) 
                LEFT OUTER JOIN cma cm ON (cm.id=b.main_table_id and b.main_table_name='cma') 
                LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
                LEFT OUTER JOIN ref_legal_region lr on(b.region=lr.id) 
                LEFT OUTER JOIN ref_loan_segment ls on(b.loan_segment=ls.code) 
                $join
                WHERE $str_where)sub GROUP BY sub.loan_ac,sub.act_name";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_ac_wise_publication_bill()
    {
        $result = array();
        $str_where = "b.memo_sts IN(70) AND b.vendor_type IN(2)";
        if(isset($_POST))
        {
            if (trim($this->input->post('proposed_type')) != '') {
                if($this->input->post('loan_ac')!='')
                {
                    if (trim($this->input->post('proposed_type'))=='Loan') {
                        $str_where.= " AND b.loan_ac='".trim($this->input->post('loan_ac'))."'";
                    }else
                    {
                        $str_where.= " AND b.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
                    }
                }
            }
            if (trim($this->input->post('lawyer_name')) != '') {
                $str_where.= " AND b.vendor_id=".$this->db->escape(trim($this->input->post('lawyer_name')));
            }
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND b.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('district')) != '') {
                $str_where.= " AND b.district=".$this->db->escape(trim($this->input->post('district')));
            }
            if (trim($this->input->post('from_year'))!= '' && trim($this->input->post('to_year'))!= '') {
                $str_where.=" AND YEAR(b.txrn_dt) >= '".$this->input->post('from_year')."' AND YEAR(b.txrn_dt) <= '".$this->input->post('to_year')."'";
            }
        }
        $sql = "SELECT
                b.loan_ac,b.ac_name,
                rq.name as type_of_case,
                b.case_number AS case_number,
                SUM(b.amount) as publication_amount,
                GROUP_CONCAT(DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') SEPARATOR '/') as publication_date,
                count(*) as number_of_paper,
                GROUP_CONCAT(p.name SEPARATOR '/') as paper_name,
                GROUP_CONCAT(DISTINCT (IF(b.paper_bill_vendor_type='Vendor',pv.name,CONCAT(pvu.name,'(',pvu.pin,')'))) SEPARATOR '/') as vendor_name,
                ld.name as district_name,
                lr.name as legal_region_name,
                ls.name as segment_name
                FROM cost_details b
                LEFT OUTER JOIN bill_summery bs ON (bs.id=b.bill_id)  
                LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
                LEFT OUTER JOIN ref_loan_segment ls on(b.loan_segment=ls.code) 
                LEFT OUTER JOIN ref_legal_region lr on(b.region=lr.id) 
                LEFT OUTER JOIN ref_legal_district ld on(b.district=ld.id) 
                LEFT OUTER JOIN ref_paper p on(b.paper_id=p.id) 
                LEFT OUTER JOIN ref_paper_vendor pv on(b.vendor_id=pv.id AND b.paper_bill_vendor_type='Vendor') 
                LEFT OUTER JOIN users_info pvu on(b.vendor_id=pvu.id AND b.paper_bill_vendor_type='Staff') 
                WHERE $str_where GROUP BY b.loan_ac,b.case_number";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_lawyer_bill_summery_result()
    {
        $result = array();
        $str_where = "b.memo_sts IN(70) AND b.vendor_type IN(1,4)";
        if (trim($this->input->post('proposed_type')) != '') {
            if($this->input->post('loan_ac')!='')
            {
                if (trim($this->input->post('proposed_type'))=='Loan') {
                    $str_where.= " AND b.loan_ac='".trim($this->input->post('loan_ac'))."'";
                }else
                {
                    $str_where.= " AND b.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
                }
            }
        }
        if (trim($this->input->post('lawyer_name')) != '') {
            $str_where.= " AND b.vendor_id=".$this->db->escape(trim($this->input->post('lawyer_name')));
        }
        if (trim($this->input->post('region')) != '') {
            $str_where.= " AND b.region=".$this->db->escape(trim($this->input->post('region')));
        }
        if (trim($this->input->post('district')) != '') {
            $str_where.= " AND b.district=".$this->db->escape(trim($this->input->post('district')));
        }
        if (trim($this->input->post('from_year'))!= '' && trim($this->input->post('to_year'))!= '') {
            $str_where.=" AND YEAR(b.txrn_dt) >= '".$this->input->post('from_year')."' AND YEAR(b.txrn_dt) <= '".$this->input->post('to_year')."'";
        }
        $sql = "SELECT
                DATE_FORMAT(bs.received_dt,'%d-%b-%Y') as received_date_from_field,
                DATE_FORMAT(bs.stf_dt,'%d-%b-%Y') as submittiondate,
                DATE_FORMAT(bs.v_dt,'%d-%b-%Y') as lawyers_bill_paid,
                bs.dispatch_no as dispitch_no,
                lr.code as lawyer_oracol,
                r.name as legal_region_name,
                lr.tin_number as tin_number,
                lr.bin_number as bin_number,
                lr.name as name_of_lawyers,
                bs.protfolio_wise_account,
                bs.protfolio_wise_discount,
                bs.protfolio_wise_amount,
                bs.bill_amount,
                bs.bill_months,
                bs.bank_ac,
                bnk.name as bank_name
                FROM cost_details b
                LEFT OUTER JOIN bill_summery bs ON (bs.id=b.bill_id)
                LEFT OUTER JOIN ref_bank bnk on(bs.bank=bnk.id) 
                LEFT OUTER JOIN ref_lawyer lr on(bs.vendor=lr.id) 
                LEFT OUTER JOIN ref_legal_region r on(b.region=r.id) 
                WHERE $str_where GROUP BY b.bill_id";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_paper_bill_summery_result()
    {
        $result = array();
        $str_where = "b.memo_sts IN(70) AND b.vendor_type IN(2)";
        if (trim($this->input->post('proposed_type')) != '') {
            if($this->input->post('loan_ac')!='')
            {
                if (trim($this->input->post('proposed_type'))=='Loan') {
                    $str_where.= " AND b.loan_ac='".trim($this->input->post('loan_ac'))."'";
                }else
                {
                    $str_where.= " AND b.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
                }
            }
        }
        if (trim($this->input->post('lawyer_name')) != '') {
            $str_where.= " AND b.vendor_id=".$this->db->escape(trim($this->input->post('lawyer_name')));
        }
        if (trim($this->input->post('region')) != '') {
            $str_where.= " AND b.region=".$this->db->escape(trim($this->input->post('region')));
        }
        if (trim($this->input->post('district')) != '') {
            $str_where.= " AND b.district=".$this->db->escape(trim($this->input->post('district')));
        }
        if (trim($this->input->post('from_year'))!= '' && trim($this->input->post('to_year'))!= '') {
            $str_where.=" AND YEAR(b.txrn_dt) >= '".$this->input->post('from_year')."' AND YEAR(b.txrn_dt) <= '".$this->input->post('to_year')."'";
        }
        $sql = "SELECT
                DATE_FORMAT(bs.received_dt,'%d-%b-%Y') as received_date_from_field,
                DATE_FORMAT(bs.stf_dt,'%d-%b-%Y') as submittiondate,
                DATE_FORMAT(bs.v_dt,'%d-%b-%Y') as lawyers_bill_paid,
                bs.dispatch_no as dispitch_no,
                IF(bs.vendor_type='Vendor',lr.name,CONCAT(vu.name,'(',vu.pin,')')) as vendor_name,
                IF(bs.vendor_type='Vendor',lr.code,vu.pin) as lawyer_oracol,
                IF(bs.vendor_type='Vendor',lr.tin,'') as tin_number,
                IF(bs.vendor_type='Vendor',lr.bin,'') as bin_number,
                bs.vendor_type,
                ld.name as district_name,
                r.name as legal_region_name,
                lr.name as name_of_lawyers,
                bs.protfolio_wise_account,
                bs.protfolio_wise_discount,
                bs.protfolio_wise_amount,
                bs.bill_amount,
                bs.bill_months,
                bs.bank_ac,
                CONCAT(e.name,'(',e.pin,')') as initiator_am,
                bnk.name as bank_name
                FROM cost_details b
                LEFT OUTER JOIN bill_summery bs ON (bs.id=b.bill_id)
                LEFT OUTER JOIN ref_bank bnk on(bs.bank=bnk.id) 
                LEFT OUTER JOIN ref_paper_vendor lr on(bs.vendor=lr.id AND bs.vendor_type='Vendor') 
                LEFT OUTER JOIN users_info vu on(bs.vendor=vu.id AND bs.vendor_type='Staff') 
                LEFT OUTER JOIN users_info e on(bs.memo_e_by=e.id) 
                LEFT OUTER JOIN ref_legal_region r on(b.region=r.id) 
                LEFT OUTER JOIN ref_legal_district ld on(b.district=ld.id) 
                WHERE $str_where GROUP BY b.bill_id";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_region_wise_result1()
    {
        $result = array();
        $year=date('Y');
        $str_where = "b.memo_sts IN(70) AND b.vendor_type IN(1,4)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND b.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(b.txrn_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $sql = "SELECT
                '".$year."' as year,
                MONTHNAME(b.txrn_dt) as month,
                count(*) as total_account,
                SUM(IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount)) as total_amount,
                SUM(IF(b.loan_segment='C',1,0)) as no_of_acount_corp,
                SUM(IF(b.loan_segment='R',1,0)) as no_of_acount_ret,
                SUM(IF(b.loan_segment='S',1,0)) as no_of_acount_sme,
                SUM(IF(b.loan_segment='C',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as total_amount_corp,
                SUM(IF(b.loan_segment='S',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as total_amount_sme,
                SUM(IF(b.loan_segment='R',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as total_amount_ret,
                SUM(IF(b.region=1 AND b.loan_segment='C',1,0)) as no_of_acount_central_corp,
                SUM(IF(b.region=1 AND b.loan_segment='S',1,0)) as no_of_acount_central_sme,
                SUM(IF(b.region=1 AND b.loan_segment='R',1,0)) as no_of_acount_central_ret,
                SUM(IF(b.region=1,1,0)) as no_of_acount_central,
                SUM(IF(b.region=1 AND b.loan_segment='C',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_central_corp,
                SUM(IF(b.region=1 AND b.loan_segment='S',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_central_sme,
                SUM(IF(b.region=1 AND b.loan_segment='R',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_central_ret,
                SUM(IF(b.region=1,IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_central,
                SUM(IF(b.region=2 AND b.loan_segment='C',1,0)) as no_of_acount_east_corp,
                SUM(IF(b.region=2 AND b.loan_segment='S',1,0)) as no_of_acount_east_sme,
                SUM(IF(b.region=2 AND b.loan_segment='R',1,0)) as no_of_acount_east_ret,
                SUM(IF(b.region=2,1,0)) as no_of_acount_east,
                SUM(IF(b.region=2 AND b.loan_segment='C',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_east_corp,
                SUM(IF(b.region=2 AND b.loan_segment='S',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_east_sme,
                SUM(IF(b.region=2 AND b.loan_segment='R',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_east_ret,
                SUM(IF(b.region=2,IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_east,
                SUM(IF(b.region=3 AND b.loan_segment='C',1,0)) as no_of_acount_south_corp,
                SUM(IF(b.region=3 AND b.loan_segment='S',1,0)) as no_of_acount_south_sme,
                SUM(IF(b.region=3 AND b.loan_segment='R',1,0)) as no_of_acount_south_ret,
                SUM(IF(b.region=3,1,0)) as no_of_acount_south,
                SUM(IF(b.region=3 AND b.loan_segment='C',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_south_corp,
                SUM(IF(b.region=3 AND b.loan_segment='S',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_south_sme,
                SUM(IF(b.region=3 AND b.loan_segment='R',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_south_ret,
                SUM(IF(b.region=3,IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_south,
                SUM(IF(b.region=4 AND b.loan_segment='C',1,0)) as no_of_acount_north_corp,
                SUM(IF(b.region=4 AND b.loan_segment='S',1,0)) as no_of_acount_north_sme,
                SUM(IF(b.region=4 AND b.loan_segment='R',1,0)) as no_of_acount_north_ret,
                SUM(IF(b.region=4,1,0)) as no_of_acount_north,
                SUM(IF(b.region=4 AND b.loan_segment='C',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_north_corp,
                SUM(IF(b.region=4 AND b.loan_segment='S',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_north_sme,
                SUM(IF(b.region=4 AND b.loan_segment='R',IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_north_ret,
                SUM(IF(b.region=4,IF(b.discount_amount IS NOT NULL AND b.discount_amount>0,(b.amount-b.discount_amount),b.amount),0)) as no_of_amount_north
                FROM cost_details b
                WHERE $str_where GROUP BY MONTH(b.txrn_dt) ORDER BY MONTH(b.txrn_dt)";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_particular_activities_result()
    {
        $result = array();
        $year=date('Y');
        $str_where = "b.memo_sts IN(70) AND b.vendor_type IN(1,4)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND b.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(b.txrn_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $str_where = "b.memo_sts IN(70) AND b.vendor_type IN(1,4)";
            $join = "LEFT OUTER JOIN ref_schedule_charges_ara as ar on (b.vendor_type=1 AND b.activities_id=ar.id and b.req_type=2 AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (b.vendor_type=1 AND b.activities_id=ni.id and b.req_type<>2 AND b.req_type IS NOT NULL AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (b.vendor_type=1 AND b.activities_id=hc.id AND (b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (b.vendor_type=1 AND b.activities_id=ca.id AND b.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (b.vendor_type=1 AND b.activities_id=la.id AND b.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_court_fee_activities as co on (b.vendor_type=4 AND b.activities_id=co.id AND (b.main_table_name='cma' or b.main_table_name='suit_filling_info'))";
            $select = "IF(b.vendor_type=4,co.name,IF(b.vendor_type=2,'News paper Publication',IF(b.activities_id=0,b.description,IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter',hc.name,IF(b.main_table_name='case_against_bank',ca.name,IF(b.main_table_name='legal_affairs',la.name,IF(b.req_type=2,ar.name,ni.name))))))) as act_name";
        $prev_year = $year-1;
        $sql = "SELECT sub.*,
            SUM(IF(sub.region=1 AND YEAR(sub.txrn_dt)='".$year."',sub.amount,0)) as central, 
            SUM(IF(sub.region=2 AND YEAR(sub.txrn_dt)='".$year."',sub.amount,0)) as east, 
            SUM(IF(sub.region=4 AND YEAR(sub.txrn_dt)='".$year."',sub.amount,0)) as north, 
            SUM(IF(sub.region=3 AND YEAR(sub.txrn_dt)='".$year."',sub.amount,0)) as south,
            SUM(IF(sub.region IN(1,2,3,4) AND YEAR(sub.txrn_dt)='".$year."',sub.amount,0)) as total_current, 
            SUM(IF(sub.region IN(1,2,3,4) AND YEAR(sub.txrn_dt)=$prev_year,sub.amount,0)) as total_prev,
            (SUM(IF(sub.region IN(1,2,3,4) AND YEAR(sub.txrn_dt)='".$year."',sub.amount,0))-SUM(IF(sub.region IN(1,2,3,4) AND YEAR(sub.txrn_dt)=$prev_year,sub.amount,0))) as increase_decrease
            FROM
                (SELECT
                b.region,
                b.amount,
                b.txrn_dt,
                $select
                FROM cost_details b
                $join
            WHERE $str_where AND (YEAR(b.txrn_dt)=$year OR YEAR(b.txrn_dt)=$prev_year)
        )sub GROUP BY sub.act_name";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_lawyer_bill_data()
    {
        $result = array();
        $year=date('Y');
        $str_where = "sub.memo_sts IN(70) AND sub.vendor_type IN(1)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        $select_amount='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.stf_dt)=$j,b.counter,0)) AS '$filed_name1'";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.amount,0)) AS '$filed_name2'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.stf_dt)=$j,b.counter,0)) AS '$filed_name1',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.amount,0)) AS '$filed_name2',";
           }
        }
        $sql = "SELECT
                '1' as header,
                'SME' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='S'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='S'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Retail' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='R'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='R'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Corporate' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='C'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='C'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Total Amount' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND (sub.loan_segment='C' OR sub.loan_segment='S' OR sub.loan_segment='R'  OR sub.loan_segment IS NULL OR sub.loan_segment='')
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Total A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND (sub.loan_segment='C' OR sub.loan_segment='S' OR sub.loan_segment='R'  OR sub.loan_segment IS NULL OR sub.loan_segment='')
                    GROUP BY sub.loan_ac
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_lawyer_bill_data_tbs()
    {
        $result = array();
        $year=date('Y');
        $str_where = "sub.memo_sts IN(70) AND sub.vendor_type IN(1)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        $select_amount='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
            $filed_name1 = 's_'.$j;
            $filed_name2 = 'r_'.$j;
            $filed_name3 = 'c_'.$j;
            $filed_name4 = 'tcoppy_'.$j;
            $filed_name11 = 'ts_'.$j;
            $filed_name12 = 'tr_'.$j;
            $filed_name13 = 'tc_'.$j;
            $filed_name14 = 'tac_'.$j;
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='S',b.counter,0)) AS '$filed_name11',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='S',b.amount,0)) AS '$filed_name1',";

            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='R',b.counter,0)) AS '$filed_name12',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='R',b.amount,0)) AS '$filed_name2',";

            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='C',b.counter,0)) AS '$filed_name13',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='C',b.amount,0)) AS '$filed_name3',";

            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'  OR b.loan_segment IS NULL OR b.loan_segment=''),b.counter,0)) AS '$filed_name14',";
            
           if($j==12)
           {
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'  OR b.loan_segment IS NULL OR b.loan_segment=''),b.amount,0)) AS '$filed_name4'";
           }
           else
           {
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'  OR b.loan_segment IS NULL OR b.loan_segment=''),b.amount,0)) AS '$filed_name4',";
           }
        }
        $sql = "SELECT
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,sub.loan_segment,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."'
                    GROUP BY sub.loan_ac,sub.loan_segment,MONTH(bill.stf_dt)
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_court_fee()
    {
        $result = array();
        $year=date('Y');
        $str_where = "sub.memo_sts IN(70) AND sub.vendor_type IN(4)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        $select_amount='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.stf_dt)=$j,b.counter,0)) AS '$filed_name1'";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.amount,0)) AS '$filed_name2'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.stf_dt)=$j,b.counter,0)) AS '$filed_name1',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.amount,0)) AS '$filed_name2',";
           }
        }
        $sql = "SELECT
                '1' as header,
                'SME' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='S'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='S'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Retail' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='R'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='R'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Corporate' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='C'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='C'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Total Amount' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND (sub.loan_segment='C' OR sub.loan_segment='S' OR sub.loan_segment='R' OR sub.loan_segment IS NULL OR sub.loan_segment='')
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Total A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND (sub.loan_segment='C' OR sub.loan_segment='S' OR sub.loan_segment='R' OR sub.loan_segment IS NULL OR sub.loan_segment='')
                    GROUP BY sub.loan_ac
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_court_fee_tbs()
    {
        $result = array();
        $year=date('Y');
        $str_where = "sub.memo_sts IN(70) AND sub.vendor_type IN(4)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        $select_amount='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
            $filed_name1 = 's_'.$j;
            $filed_name2 = 'r_'.$j;
            $filed_name3 = 'c_'.$j;
            $filed_name4 = 'tcoppy_'.$j;
            $filed_name11 = 'ts_'.$j;
            $filed_name12 = 'tr_'.$j;
            $filed_name13 = 'tc_'.$j;
            $filed_name14 = 'tac_'.$j;
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='S',b.counter,0)) AS '$filed_name11',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='S',b.amount,0)) AS '$filed_name1',";

            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='R',b.counter,0)) AS '$filed_name12',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='R',b.amount,0)) AS '$filed_name2',";

            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='C',b.counter,0)) AS '$filed_name13',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='C',b.amount,0)) AS '$filed_name3',";

            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'  OR b.loan_segment IS NULL OR b.loan_segment=''),b.counter,0)) AS '$filed_name14',";
            
           if($j==12)
           {
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'  OR b.loan_segment IS NULL OR b.loan_segment=''),b.amount,0)) AS '$filed_name4'";
           }
           else
           {
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'  OR b.loan_segment IS NULL OR b.loan_segment=''),b.amount,0)) AS '$filed_name4',";
           }
        }
        $sql = "SELECT
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,sub.loan_segment,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."'
                    GROUP BY sub.loan_ac,sub.loan_segment,MONTH(bill.stf_dt)
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_court_enter()
    {
        $result = array();
        $year=date('Y');
        $str_where = "sub.memo_sts IN(70) AND sub.vendor_type IN(5)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        $select_amount='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.stf_dt)=$j,b.counter,0)) AS '$filed_name1'";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.amount,0)) AS '$filed_name2'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.stf_dt)=$j,b.counter,0)) AS '$filed_name1',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.amount,0)) AS '$filed_name2',";
           }
        }
        $sql = "SELECT
                '1' as header,
                'SME' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='S'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='S'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Retail' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='R'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='R'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Corporate' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='C'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='C'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Total Amount' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND (sub.loan_segment='C' OR sub.loan_segment='S' OR sub.loan_segment='R' OR sub.loan_segment IS NULL)
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Total A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND (sub.loan_segment='C' OR sub.loan_segment='S' OR sub.loan_segment='R' OR sub.loan_segment IS NULL)
                    GROUP BY sub.loan_ac
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_court_enter_tbs()
    {
        $result = array();
        $year=date('Y');
        $str_where = "sub.memo_sts IN(70) AND sub.vendor_type IN(5)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        $select_amount='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
            $filed_name1 = 's_'.$j;
            $filed_name2 = 'r_'.$j;
            $filed_name3 = 'c_'.$j;
            $filed_name4 = 'tcoppy_'.$j;
            $filed_name11 = 'ts_'.$j;
            $filed_name12 = 'tr_'.$j;
            $filed_name13 = 'tc_'.$j;
            $filed_name14 = 'tac_'.$j;
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='S',b.counter,0)) AS '$filed_name11',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='S',b.amount,0)) AS '$filed_name1',";

            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='R',b.counter,0)) AS '$filed_name12',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='R',b.amount,0)) AS '$filed_name2',";

            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='C',b.counter,0)) AS '$filed_name13',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='C',b.amount,0)) AS '$filed_name3',";

            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'  OR b.loan_segment IS NULL OR b.loan_segment=''),b.counter,0)) AS '$filed_name14',";
            
           if($j==12)
           {
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'  OR b.loan_segment IS NULL OR b.loan_segment=''),b.amount,0)) AS '$filed_name4'";
           }
           else
           {
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'  OR b.loan_segment IS NULL OR b.loan_segment=''),b.amount,0)) AS '$filed_name4',";
           }
        }
        $sql = "SELECT
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,sub.loan_segment,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."'
                    GROUP BY sub.loan_ac,sub.loan_segment,MONTH(bill.stf_dt)
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_court_staff()
    {
        $result = array();
        $year=date('Y');
        $str_where = "sub.memo_sts IN(70) AND sub.vendor_type IN(3)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        $select_amount='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.stf_dt)=$j,b.counter,0)) AS '$filed_name1'";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.amount,0)) AS '$filed_name2'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.stf_dt)=$j,b.counter,0)) AS '$filed_name1',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.amount,0)) AS '$filed_name2',";
           }
        }
        $sql = "SELECT
                '1' as header,
                'Total Amount' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Total A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."'
                    GROUP BY sub.loan_ac
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_court_staff_all()
    {
        $result = array();
        $year=date('Y');
        $str_where = "sub.memo_sts IN(70) AND sub.vendor_type IN(3)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        $select_amount='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
            $filed_name1 = 'staff_'.$j;
            $filed_name2 = 'tstaff_'.$j;
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.counter,0)) AS '$filed_name2',";
           if($j==12)
           {
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.amount,0)) AS '$filed_name1'";
           }
           else
           {
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.amount,0)) AS '$filed_name1',";
           }
        }
        $sql = "SELECT
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,sub.loan_segment,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."'
                    GROUP BY sub.loan_ac,MONTH(bill.stf_dt)
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_legal_notice()
    {
        $result = array();
        $year=date('Y');
        $str_where = "1 AND sub.ln_cost_select_sts=1";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(sub.txrn_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        $select_amount='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.txrn_dt)=$j,b.counter,0)) AS '$filed_name1'";
            $select_amount.=" SUM(IF(MONTH(b.txrn_dt)=$j,b.qty,0)) AS '$filed_name2'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.txrn_dt)=$j,b.counter,0)) AS '$filed_name1',";
            $select_amount.=" SUM(IF(MONTH(b.txrn_dt)=$j,b.qty,0)) AS '$filed_name2',";
           }
        }
        $sql = "SELECT
                '1' as header,
                'SME' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,SUM(sub.qty) as qty,SUM(1) as counter
                    FROM legal_notice_cost_details sub
                    WHERE $str_where AND YEAR(sub.txrn_dt)='".$year."' AND loan_segment='S'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,SUM(sub.qty) as qty,SUM(1) as counter
                    FROM legal_notice_cost_details sub
                    WHERE $str_where AND YEAR(sub.txrn_dt)='".$year."' AND loan_segment='S'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Retail' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,SUM(sub.qty) as qty,SUM(1) as counter
                    FROM legal_notice_cost_details sub
                    WHERE $str_where AND YEAR(sub.txrn_dt)='".$year."' AND loan_segment='S'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,SUM(sub.qty) as qty,SUM(1) as counter
                    FROM legal_notice_cost_details sub
                    WHERE $str_where AND YEAR(sub.txrn_dt)='".$year."' AND loan_segment='R'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Corporate' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,SUM(sub.qty) as qty,SUM(1) as counter
                    FROM legal_notice_cost_details sub
                    WHERE $str_where AND YEAR(sub.txrn_dt)='".$year."' AND loan_segment='C'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,SUM(sub.qty) as qty,SUM(1) as counter
                    FROM legal_notice_cost_details sub
                    WHERE $str_where AND YEAR(sub.txrn_dt)='".$year."' AND loan_segment='C'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Total No of Copy' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,SUM(sub.qty) as qty,SUM(1) as counter
                    FROM legal_notice_cost_details sub
                    WHERE $str_where AND YEAR(sub.txrn_dt)='".$year."' AND (loan_segment='C' OR loan_segment='S' OR loan_segment='R')
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'Total A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,SUM(sub.qty) as qty,SUM(1) as counter
                    FROM legal_notice_cost_details sub
                    WHERE $str_where AND YEAR(sub.txrn_dt)='".$year."' AND (loan_segment='C' OR loan_segment='S' OR loan_segment='R')
                    GROUP BY sub.loan_ac
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_legal_notice_tbs()
    {
        $result = array();
        $year=date('Y');
        $str_where = "1 AND sub.ln_cost_select_sts=1";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(sub.txrn_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        $select_amount='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
            $filed_name1 = 's_'.$j;
            $filed_name2 = 'r_'.$j;
            $filed_name3 = 'c_'.$j;
            $filed_name4 = 'tcoppy_'.$j;
            $filed_name11 = 'ts_'.$j;
            $filed_name12 = 'tr_'.$j;
            $filed_name13 = 'tc_'.$j;
            $filed_name14 = 'tac_'.$j;
            $select_amount.=" SUM(IF(MONTH(b.txrn_dt)=$j AND b.loan_segment='S',b.counter,0)) AS '$filed_name11',";
            $select_amount.=" SUM(IF(MONTH(b.txrn_dt)=$j AND b.loan_segment='S',b.qty,0)) AS '$filed_name1',";

            $select_amount.=" SUM(IF(MONTH(b.txrn_dt)=$j AND b.loan_segment='R',b.counter,0)) AS '$filed_name12',";
            $select_amount.=" SUM(IF(MONTH(b.txrn_dt)=$j AND b.loan_segment='R',b.qty,0)) AS '$filed_name2',";

            $select_amount.=" SUM(IF(MONTH(b.txrn_dt)=$j AND b.loan_segment='C',b.counter,0)) AS '$filed_name13',";
            $select_amount.=" SUM(IF(MONTH(b.txrn_dt)=$j AND b.loan_segment='C',b.qty,0)) AS '$filed_name3',";
            $select_amount.=" SUM(IF(MONTH(b.txrn_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'),b.counter,0)) AS '$filed_name14',";
            
           if($j==12)
           {
            $select_amount.=" SUM(IF(MONTH(b.txrn_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'),b.qty,0)) AS '$filed_name4'";
           }
           else
           {
            $select_amount.=" SUM(IF(MONTH(b.txrn_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'),b.qty,0)) AS '$filed_name4',";
           }
        }
        $sql = "SELECT
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,sub.loan_segment,SUM(sub.qty) as qty,SUM(1) as counter
                    FROM legal_notice_cost_details sub
                    WHERE $str_where AND YEAR(sub.txrn_dt)='".$year."'
                    GROUP BY sub.loan_ac,sub.loan_segment
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_cma()
    {
        $result = array();
        $year=date('Y');
        $str_where = "1";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(sub.v_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.v_dt)=$j,b.counter,0)) AS '$filed_name1'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.v_dt)=$j,b.counter,0)) AS '$filed_name1',";
            }
        }
        $sql = "SELECT
                '1' as header,
                'SME' as type,
                $select_count
                FROM(
                    SELECT sub.v_dt,1 as counter
                    FROM cma sub
                    WHERE $str_where AND YEAR(sub.v_dt)=$year AND loan_segment='S' AND sts<>0 AND v_by IS NOT NULL AND v_dt IS NOT NULL
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Retail' as type,
                $select_count
                FROM(
                    SELECT sub.v_dt,1 as counter
                    FROM cma sub
                    WHERE $str_where AND YEAR(sub.v_dt)=$year AND loan_segment='R' AND sts<>0 AND v_by IS NOT NULL AND v_dt IS NOT NULL
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Corporate' as type,
                $select_count
                FROM(
                    SELECT sub.v_dt,1 as counter
                    FROM cma sub
                    WHERE $str_where AND YEAR(sub.v_dt)=$year AND loan_segment='C' AND sts<>0 AND v_by IS NOT NULL AND v_dt IS NOT NULL
                ) b
                UNION ALL 
                SELECT
                '1' as header,
                'Total A/c' as type,
                $select_count
                FROM(
                    SELECT sub.v_dt,1 as counter
                    FROM cma sub
                    WHERE $str_where AND YEAR(sub.v_dt)=$year AND (loan_segment='C' OR loan_segment='S' OR loan_segment='R') AND sts<>0 AND v_by IS NOT NULL AND v_dt IS NOT NULL
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_cma_tbs()
    {
        $result = array();
        $year=date('Y');
        $str_where = "1";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(sub.v_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
                $filed_name1 = 's_'.$j;
                $filed_name2 = 'r_'.$j;
                $filed_name3 = 'c_'.$j;
                $filed_name4 = 't_'.$j;
                $select_count.=" SUM(IF(MONTH(b.v_dt)=$j AND b.loan_segment='S',b.counter,0)) AS '$filed_name1',";
                $select_count.=" SUM(IF(MONTH(b.v_dt)=$j AND b.loan_segment='R',b.counter,0)) AS '$filed_name2',";
                $select_count.=" SUM(IF(MONTH(b.v_dt)=$j AND b.loan_segment='C',b.counter,0)) AS '$filed_name3',";
                $select_count.=" SUM(IF(MONTH(b.v_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'),b.counter,0)) AS '$filed_name4'";
           }
           else
           {
                $filed_name1 = 's_'.$j;
                $filed_name2 = 'r_'.$j;
                $filed_name3 = 'c_'.$j;
                $filed_name4 = 't_'.$j;
                $select_count.=" SUM(IF(MONTH(b.v_dt)=$j AND b.loan_segment='S',b.counter,0)) AS '$filed_name1',";
                $select_count.=" SUM(IF(MONTH(b.v_dt)=$j AND b.loan_segment='R',b.counter,0)) AS '$filed_name2',";
                $select_count.=" SUM(IF(MONTH(b.v_dt)=$j AND b.loan_segment='C',b.counter,0)) AS '$filed_name3',";
                $select_count.=" SUM(IF(MONTH(b.v_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'),b.counter,0)) AS '$filed_name4',";
           }
        }
        $sql = "SELECT
                $select_count
                FROM(
                    SELECT sub.v_dt,sub.loan_segment,1 as counter
                    FROM cma sub
                    WHERE $str_where AND YEAR(sub.v_dt)=$year AND sts<>0 AND v_by IS NOT NULL AND v_dt IS NOT NULL
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_instru()
    {
        $result = array();
        $year=date('Y');
        $str_where = "1";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(sub.deliver_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.deliver_dt)=$j,b.counter,0)) AS '$filed_name1'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.deliver_dt)=$j,b.counter,0)) AS '$filed_name1',";
            }
        }
        $sql = "SELECT
                '1' as header,
                'SME' as type,
                $select_count
                FROM(
                    SELECT sub.deliver_dt,1 as counter
                    FROM cma sub
                    WHERE $str_where AND YEAR(sub.deliver_dt)=$year AND loan_segment='S' AND sts<>0 AND deliver_by IS NOT NULL AND deliver_dt IS NOT NULL
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Retail' as type,
                $select_count
                FROM(
                    SELECT sub.deliver_dt,1 as counter
                    FROM cma sub
                    WHERE $str_where AND YEAR(sub.deliver_dt)=$year AND loan_segment='R' AND sts<>0 AND deliver_by IS NOT NULL AND deliver_dt IS NOT NULL
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Corporate' as type,
                $select_count
                FROM(
                    SELECT sub.deliver_dt,1 as counter
                    FROM cma sub
                    WHERE $str_where AND YEAR(sub.deliver_dt)=$year AND loan_segment='C' AND sts<>0 AND deliver_by IS NOT NULL AND deliver_dt IS NOT NULL
                ) b
                UNION ALL 
                SELECT
                '1' as header,
                'Total A/c' as type,
                $select_count
                FROM(
                    SELECT sub.deliver_dt,1 as counter
                    FROM cma sub
                    WHERE $str_where AND YEAR(sub.deliver_dt)=$year AND (loan_segment='C' OR loan_segment='S' OR loan_segment='R') AND sts<>0 AND deliver_by IS NOT NULL AND deliver_dt IS NOT NULL
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_instru_tbs()
    {
        $result = array();
        $year=date('Y');
        $str_where = "1";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(sub.deliver_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 's_'.$j;
            $filed_name2 = 'r_'.$j;
            $filed_name3 = 'c_'.$j;
            $filed_name4 = 't_'.$j;
            $select_count.=" SUM(IF(MONTH(b.deliver_dt)=$j AND b.loan_segment='S',b.counter,0)) AS '$filed_name1',";
            $select_count.=" SUM(IF(MONTH(b.deliver_dt)=$j AND b.loan_segment='R',b.counter,0)) AS '$filed_name2',";
            $select_count.=" SUM(IF(MONTH(b.deliver_dt)=$j AND b.loan_segment='C',b.counter,0)) AS '$filed_name3',";
            $select_count.=" SUM(IF(MONTH(b.deliver_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'),b.counter,0)) AS '$filed_name4'";
           }
           else
           {
            $filed_name1 = 's_'.$j;
            $filed_name2 = 'r_'.$j;
            $filed_name3 = 'c_'.$j;
            $filed_name4 = 't_'.$j;
            $select_count.=" SUM(IF(MONTH(b.deliver_dt)=$j AND b.loan_segment='S',b.counter,0)) AS '$filed_name1',";
            $select_count.=" SUM(IF(MONTH(b.deliver_dt)=$j AND b.loan_segment='R',b.counter,0)) AS '$filed_name2',";
            $select_count.=" SUM(IF(MONTH(b.deliver_dt)=$j AND b.loan_segment='C',b.counter,0)) AS '$filed_name3',";
            $select_count.=" SUM(IF(MONTH(b.deliver_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'),b.counter,0)) AS '$filed_name4',";
            }
        }
        $sql = "SELECT
                '1' as header,
                'SME' as type,
                $select_count
                FROM(
                    SELECT sub.deliver_dt,sub.loan_segment,1 as counter
                    FROM cma sub
                    WHERE $str_where AND YEAR(sub.deliver_dt)=$year AND sts<>0 AND deliver_by IS NOT NULL AND deliver_dt IS NOT NULL
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_galance_report_paper_bill_data()
    {
        $result = array();
        $year=date('Y');
        $str_where = "sub.memo_sts IN(70) AND sub.vendor_type IN(2)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        $select_amount='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
           if($j==12)
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.stf_dt)=$j,b.counter,0)) AS '$filed_name1'";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.amount,0)) AS '$filed_name2'";
           }
           else
           {
            $filed_name1 = 'count_'.$j;
            $filed_name2 = 'count_'.$j;
            $select_count.=" SUM(IF(MONTH(b.stf_dt)=$j,b.counter,0)) AS '$filed_name1',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j,b.amount,0)) AS '$filed_name2',";
           }
        }
        $sql = "SELECT
                '1' as header,
                'SME' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='S'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='S'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Retail' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='R'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='R'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Corporate' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='C'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL 
                SELECT
                '2' as header,
                'No of A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND sub.loan_segment='C'
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Total Amount' as type,
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND (sub.loan_segment='C' OR sub.loan_segment='S' OR sub.loan_segment='R' OR sub.loan_segment IS NULL OR sub.loan_segment='')
                    GROUP BY sub.loan_ac
                ) b
                UNION ALL
                SELECT
                '1' as header,
                'Total A/c' as type,
                $select_count
                FROM(
                    SELECT sub.txrn_dt,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."' AND (sub.loan_segment='C' OR sub.loan_segment='S' OR sub.loan_segment='R' OR sub.loan_segment IS NULL OR sub.loan_segment='')
                    GROUP BY sub.loan_ac
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }

    function get_galance_report_paper_bill_data_tbs()
    {
        $result = array();
        $year=date('Y');
        $str_where = "sub.memo_sts IN(70) AND sub.vendor_type IN(2)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND sub.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $select_count='';
        $select_amount='';
        for ($j=1; $j <=12 ; $j++) { //for month loop
            $filed_name1 = 's_'.$j;
            $filed_name2 = 'r_'.$j;
            $filed_name3 = 'c_'.$j;
            $filed_name4 = 'tcoppy_'.$j;
            $filed_name11 = 'ts_'.$j;
            $filed_name12 = 'tr_'.$j;
            $filed_name13 = 'tc_'.$j;
            $filed_name14 = 'tac_'.$j;
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='S',b.counter,0)) AS '$filed_name11',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='S',b.amount,0)) AS '$filed_name1',";

            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='R',b.counter,0)) AS '$filed_name12',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='R',b.amount,0)) AS '$filed_name2',";

            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='C',b.counter,0)) AS '$filed_name13',";
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND b.loan_segment='C',b.amount,0)) AS '$filed_name3',";

            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'  OR b.loan_segment IS NULL OR b.loan_segment=''),b.counter,0)) AS '$filed_name14',";
            
           if($j==12)
           {
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'  OR b.loan_segment IS NULL OR b.loan_segment=''),b.amount,0)) AS '$filed_name4'";
           }
           else
           {
            $select_amount.=" SUM(IF(MONTH(b.stf_dt)=$j AND (b.loan_segment='C' OR b.loan_segment='S' OR b.loan_segment='R'  OR b.loan_segment IS NULL OR b.loan_segment=''),b.amount,0)) AS '$filed_name4',";
           }
        }
        $sql = "SELECT
                $select_amount
                FROM(
                    SELECT sub.txrn_dt,sub.loan_segment,bill.stf_dt,SUM(sub.amount) as amount,SUM(1) as counter
                    FROM cost_details sub
                    LEFT OUTER JOIN bill_summery bill ON(bill.id=sub.bill_id)
                    WHERE $str_where AND YEAR(bill.stf_dt)='".$year."'
                    GROUP BY sub.loan_ac,sub.loan_segment,MONTH(bill.stf_dt)
                ) b";
        $q=$this->db->query($sql);
        return $q->result();
    }

    function get_galance_report_lawyer_bill_all_csv()
    {
        $result = array();
        $str_where = "c.memo_sts IN(70) AND c.vendor_type IN(1)";
            $join = "LEFT OUTER JOIN ref_schedule_charges_ara as ar on (b.vendor_type=1 AND b.activities_id=ar.id and b.req_type=2 AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (b.vendor_type=1 AND b.activities_id=ni.id and b.req_type<>2 AND b.req_type IS NOT NULL AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (b.vendor_type=1 AND b.activities_id=hc.id AND (b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter' OR b.main_table_name='hc_matter_hst'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (b.vendor_type=1 AND b.activities_id=ca.id AND b.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (b.vendor_type=1 AND b.activities_id=la.id AND b.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_court_fee_activities as co on (b.vendor_type=4 AND b.activities_id=co.id AND (b.main_table_name='cma' or b.main_table_name='suit_filling_info'))
            LEFT OUTER JOIN ref_lawyer as v4 on (b.vendor_id=v4.id and b.vendor_type=1)
            LEFT OUTER JOIN ref_lawyer as v5 on (b.vendor_id=v5.id and b.vendor_type=4)";
            $select = "IF(b.vendor_type=1,v4.name,IF(b.vendor_type=4,v5.name,b.vendor_name)) as vendor_name,IF(b.vendor_type=1,v4.code,IF(b.vendor_type=4,v5.code,'')) as vendor_code,IF(b.vendor_type=4,co.name,IF(b.vendor_type=2,'News paper Publication',IF(b.activities_id=0,b.description,IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter',hc.name,IF(b.main_table_name='case_against_bank',ca.name,IF(b.main_table_name='legal_affairs',la.name,IF(b.req_type=2,ar.name,ni.name))))))) as act_name";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND c.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $sql = "SELECT 
                'Amount' as amount,
                'Proposed Type' as proposed_type,
                '' as org_loan_ac,
                'Bill Month' as bill_month,
                'Type Of Case' as type_of_case,
                'Loan AC' as loan_ac,
                'AC Name' as ac_name,
                'Region Name' as legal_region_name,
                'Loan Segment' as segment_name,
                'Send To Finanace Date' as stf_dt,
                'Bill Year' as bill_year,
                'Bill Payment Date' as bill_payment_date,
                'Case Number' AS case_number,
                'Activities Date' as txrn_dt,
                'District Name' as district_name,
                'Territory' as territory_name,
                'Court Type' as court_type,
                'Vendor Name' as vendor_name,
                'Vendor Code' as vendor_code,
                'Activities Name' as act_name
                UNION ALL
                SELECT
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

    function get_galance_report_lawyer_bill_all()
    {
        $result = array();
        $str_where = "c.memo_sts IN(70) AND c.vendor_type IN(1)";
            $join = "LEFT OUTER JOIN ref_schedule_charges_ara as ar on (b.vendor_type=1 AND b.activities_id=ar.id and b.req_type=2 AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_schedule_charges_ni as ni on (b.vendor_type=1 AND b.activities_id=ni.id and b.req_type<>2 AND b.req_type IS NOT NULL AND (b.main_table_name='suit_filling_info' OR b.main_table_name='cma' OR b.main_table_name='appeal_deposit'))
            LEFT OUTER JOIN ref_hc_activities as hc on (b.vendor_type=1 AND b.activities_id=hc.id AND (b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter' OR b.main_table_name='hc_matter_hst'))
            LEFT OUTER JOIN ref_schedule_charges_case_against_bank as ca on (b.vendor_type=1 AND b.activities_id=ca.id AND b.main_table_name='case_against_bank')
            LEFT OUTER JOIN ref_schedule_charges_legal_affairs as la on (b.vendor_type=1 AND b.activities_id=la.id AND b.main_table_name='legal_affairs')
            LEFT OUTER JOIN ref_court_fee_activities as co on (b.vendor_type=4 AND b.activities_id=co.id AND (b.main_table_name='cma' or b.main_table_name='suit_filling_info'))
            LEFT OUTER JOIN ref_lawyer as v4 on (b.vendor_id=v4.id and b.vendor_type=1)
            LEFT OUTER JOIN ref_lawyer as v5 on (b.vendor_id=v5.id and b.vendor_type=4)";
            $select = "IF(b.vendor_type=1,v4.name,IF(b.vendor_type=4,v5.name,b.vendor_name)) as vendor_name,IF(b.vendor_type=1,v4.code,IF(b.vendor_type=4,v5.code,'')) as vendor_code,IF(b.vendor_type=4,co.name,IF(b.vendor_type=2,'News paper Publication',IF(b.activities_id=0,b.description,IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter',hc.name,IF(b.main_table_name='case_against_bank',ca.name,IF(b.main_table_name='legal_affairs',la.name,IF(b.req_type=2,ar.name,ni.name))))))) as act_name";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND c.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
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
    function get_galance_report_court_fee_all()
    {
        $result = array();
        $str_where = "c.memo_sts IN(70) AND c.vendor_type IN(4)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND c.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
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
    function get_galance_report_paper_bill_all()
    {
        $result = array();
        $str_where = "c.memo_sts IN(70) AND c.vendor_type IN(2)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND c.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
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
                b.case_number AS case_number,
                DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,
                dr.name as district_name,
                pa.name as act_name,
                p.name as paper_name,
                tr.name as territory_name,
                IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter' OR b.main_table_name='hc_matter_hst','High Court','Lower Court') as court_type,
                IF(b.paper_bill_vendor_type='Vendor',pn.name,pn2.name) as vendor_name,
                IF(b.paper_bill_vendor_type='Vendor',pn.code,pn2.pin) as vendor_code
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
                     c.vendor_id,
                     c.paper_bill_vendor_type,
                     c.paper_id
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
                LEFT OUTER JOIN ref_paper_bill_activities pa on(b.activities_id=pa.id) 
                LEFT OUTER JOIN ref_paper_vendor pn ON (pn.id=b.vendor_id AND b.paper_bill_vendor_type='Vendor')
                LEFT OUTER JOIN users_info pn2 ON (pn2.id=b.vendor_id AND b.paper_bill_vendor_type='Staff')
                LEFT OUTER JOIN ref_paper p ON (p.id=b.paper_id)";
        $q=$this->db->query($sql);
        return $q->result();
    }

    function get_galance_report_cma_all()
    {
        $result = array();
        $str_where = "c.sts<>0 AND c.v_by IS NOT NULL AND c.v_dt IS NOT NULL";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND c.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(c.v_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
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
                tr.name as territory_name
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

    function get_galance_report_ln_all()
    {
        $result = array();
        $str_where = "1 AND c.ln_cost_select_sts=1";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND c.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(c.txrn_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $sql = "SELECT
                b.proposed_type,
                b.org_loan_ac,
                b.loan_ac,b.ac_name,
                lr.name as legal_region_name,
                ls.name as segment_name,
                DATE_FORMAT(c.legal_notice_s_dt,'%d-%b-%Y') AS legal_notice_s_dt,
                DATE_FORMAT(c.legal_notice_s_dt,'%M') AS send_month,
                DATE_FORMAT(c.legal_notice_s_dt,'%Y') AS send_year,
                dr.name as district_name,
                tr.name as territory_name,
                l.name as vendor_name,
                b.amount,
                b.description,
                b.qty,
                l.code as vendor_code
                FROM (
                    SELECT * FROM legal_notice_cost_details c where $str_where
                ) b
                LEFT OUTER JOIN ref_req_type rq ON(b.req_type=rq.id) 
                LEFT OUTER JOIN legal_notice c ON(b.main_table_id=c.id)
                LEFT OUTER JOIN ref_region lr ON(b.region=lr.id) 
                LEFT OUTER JOIN ref_district dr ON(b.district=dr.id) 
                LEFT OUTER JOIN ref_territory tr ON(b.territory=tr.id) 
                LEFT OUTER JOIN ref_loan_segment ls ON(b.loan_segment=ls.code) 
                LEFT OUTER JOIN ref_lawyer l ON(b.vendor_id=l.id)";
        $q=$this->db->query($sql);
        return $q->result();
    }


    function get_galance_report_court_enter_all()
    {
        $result = array();
        $str_where = "c.memo_sts IN(70) AND c.vendor_type IN(5)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND c.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
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
                ac.name as activities_name,
                DATE_FORMAT(bs.stf_dt,'%d-%b-%Y') as stf_dt,
                DATE_FORMAT(bs.memo_e_dt,'%Y') as bill_year,
                DATE_FORMAT(bs.memo_e_dt,'%d-%b-%Y') as bill_payment_date,
                IF(b.activities_id=1 AND b.vendor_type=1,'Legal Notice',b.case_number) AS case_number,
                DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,
                dr.name as district_name,
                tr.name as territory_name,
                IF(b.main_table_name='hc_matter_ad' OR b.main_table_name='hc_matter' OR b.main_table_name='hc_matter_hst','High Court','Lower Court') as court_type,
                l.name as vendor_name,
                l.pin as vendor_code
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
                LEFT OUTER JOIN ref_court_entertainment_activities ac on(b.activities_id=ac.id) 
                LEFT OUTER JOIN users_info l on(b.vendor_id=l.id) ";
        $q=$this->db->query($sql);
        return $q->result();
    }

    function get_galance_report_staff_conv_all()
    {
        $result = array();
        $str_where = "c.memo_sts IN(70) AND c.vendor_type IN(3)";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND c.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(bill.stf_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $sql = "SELECT
                b.amount,
                b.proposed_type,
                b.org_loan_ac,
                DATE_FORMAT(b.txrn_dt,'%b-%Y') as bill_month,
                b.loan_ac,b.ac_name,
                lr.name as legal_region_name,
                ac.name as activities_name,
                DATE_FORMAT(bs.stf_dt,'%d-%b-%Y') as stf_dt,
                DATE_FORMAT(bs.memo_e_dt,'%Y') as bill_year,
                DATE_FORMAT(bs.memo_e_dt,'%d-%b-%Y') as bill_payment_date,
                DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,
                dr.name as district_name,
                l.name as vendor_name,
                l.pin as vendor_code
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
                LEFT OUTER JOIN ref_legal_region lr on(b.region=lr.id) 
                LEFT OUTER JOIN ref_legal_district dr on(b.district=dr.id) 
                LEFT OUTER JOIN ref_staff_conv_activities ac on(b.activities_id=ac.id) 
                LEFT OUTER JOIN users_info l on(b.vendor_id=l.id)";
        $q=$this->db->query($sql);
        return $q->result();
    }

    function get_galance_report_cma_instu_all()
    {
        $result = array();
        $str_where = "c.sts<>0 AND c.v_by IS NOT NULL AND c.v_dt IS NOT NULL AND c.deliver_by IS NOT NULL AND c.deliver_dt IS NOT NULL";
        if(isset($_POST))
        {
            if (trim($this->input->post('region')) != '') {
                $str_where.= " AND c.region=".$this->db->escape(trim($this->input->post('region')));
            }
            if (trim($this->input->post('from_year')) != '') {
                $str_where.= " AND YEAR(c.deliver_dt)=".$this->db->escape(trim($this->input->post('from_year')));
                $year=$this->input->post('from_year');
            }
        }
        $sql = "SELECT
                b.proposed_type,
                b.org_loan_ac,
                rq.name as type_of_case,
                b.loan_ac,b.ac_name,
                lr.name as legal_region_name,
                ls.name as segment_name,
                b.st_belance,
                DATE_FORMAT(b.v_dt,'%d-%b-%Y') as approve_date,
                DATE_FORMAT(b.st_belance_dt,'%d-%b-%Y') as st_belance_dt,
                DATE_FORMAT(b.deliver_dt,'%d-%b-%Y') as deliver_dt,
                DATE_FORMAT(b.deliver_dt,'%Y') as deliver_year,
                DATE_FORMAT(b.legal_ack_dt,'%d-%b-%Y') as legal_ack_dt,
                DATE_FORMAT(b.v_dt,'%M') as approve_month,
                DATE_FORMAT(b.v_dt,'%Y') as approve_year,
                dr.name as district_name,
                u.name as ack_by,
                rdr.name as recovery_district,
                rlr.name as recovery_region_name,
                u.pin as ack_pin,
                tr.name as territory_name
                FROM (
                    SELECT * FROM cma c where $str_where
                ) b
                LEFT OUTER JOIN ref_req_type rq on(b.req_type=rq.id) 
                LEFT OUTER JOIN ref_legal_region lr on(b.legal_region=lr.id) 
                LEFT OUTER JOIN ref_region rlr on(b.region=rlr.id) 
                LEFT OUTER JOIN ref_legal_district dr on(b.case_fill_dist=dr.id) 
                LEFT OUTER JOIN ref_district rdr on(b.district=rdr.id) 
                LEFT OUTER JOIN ref_territory tr on(b.territory=tr.id) 
                LEFT OUTER JOIN ref_loan_segment ls on(b.loan_segment=ls.code) 
                LEFT OUTER JOIN users_info u on(b.legal_ack_by=u.id)";
        $q=$this->db->query($sql);
        return $q->result();
    }
}