<?php
class Staff_conv_court_bill_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Cma_process_model', '', TRUE);
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

    function get_conveyence_other_cost_result()
    {
        $result = array();
        $str_where = "b.memo_sts IN(29,88,70) AND b.vendor_type IN(3)";
        if(isset($_POST))
        {
            if (trim($this->input->post('staff')) != '') {
                $str_where.= " AND b.vendor_id=".$this->db->escape(trim($this->input->post('staff')));
            }
            if (trim($this->input->post('legal_region')) != '') {
                $str_where.= " AND b.region=".$this->db->escape(trim($this->input->post('legal_region')));
            }

            if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
            if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
            if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
            else{$filling_dt_from='0';}
            if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
            else{$filling_dt_to='0';}

            if( $filling_dt_from!='0' && $filling_dt_to=='0')
            { $str_where.= " and b.txrn_dt='".$filling_dt_from."'"; }
            
            if( $filling_dt_from!='0' && $filling_dt_to!='0')
            { $str_where.= " and b.txrn_dt between '".$filling_dt_from."' and '".$filling_dt_to."'";}
        }
        $sql = "SELECT
                us.name as employee_name,us.pin as employee_pin,
                ld.name as district_name,lr.name as region_name,
                'Conveyance & Other\'s cost' as purpose,
                DATE_FORMAT(bs.received_dt,'%d-%b-%Y') as received_date_from_field,
                DATE_FORMAT(bs.stf_dt,'%d-%b-%Y') as stf_date,
                bs.bill_months,b.amount as bill_amount
                FROM cost_details b
                LEFT OUTER JOIN ref_legal_region lr on(b.region=lr.id) 
                LEFT OUTER JOIN ref_legal_district ld on(b.district=ld.id) 
                LEFT OUTER JOIN users_info us on(b.vendor_id=us.id) 
                LEFT OUTER JOIN bill_summery bs on(b.bill_id=bs.id) 
                WHERE $str_where";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_court_entertainment_cost_result()
    {
        $result = array();
        $str_where = "b.memo_sts IN(29,88,70) AND b.vendor_type IN(5)";
        if(isset($_POST))
        {
            if (trim($this->input->post('staff')) != '') {
                $str_where.= " AND b.vendor_id=".$this->db->escape(trim($this->input->post('staff')));
            }
            if (trim($this->input->post('legal_region')) != '') {
                $str_where.= " AND b.region=".$this->db->escape(trim($this->input->post('legal_region')));
            }

            if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
            if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
            if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
            else{$filling_dt_from='0';}
            if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
            else{$filling_dt_to='0';}

            if( $filling_dt_from!='0' && $filling_dt_to=='0')
            { $str_where.= " and b.txrn_dt='".$filling_dt_from."'"; }
            
            if( $filling_dt_from!='0' && $filling_dt_to!='0')
            { $str_where.= " and b.txrn_dt between '".$filling_dt_from."' and '".$filling_dt_to."'";}
        }
        $sql = "SELECT
                b.loan_ac,b.ac_name,
                b.case_number,ca.name as activities_name,
                us.name as employee_name,us.pin as employee_pin,
                ld.name as district_name,lr.name as region_name,
                'Court Entertainment ' as purpose,
                DATE_FORMAT(bs.received_dt,'%d-%b-%Y') as received_date_from_field,
                DATE_FORMAT(b.txrn_dt,'%d-%b-%Y') as txrn_dt,
                DATE_FORMAT(bs.stf_dt,'%d-%b-%Y') as stf_date,
                bs.bill_months,b.amount as bill_amount
                FROM cost_details b
                LEFT OUTER JOIN ref_court_entertainment_activities ca on(b.activities_id=ca.id) 
                LEFT OUTER JOIN ref_legal_region lr on(b.region=lr.id) 
                LEFT OUTER JOIN ref_legal_district ld on(b.district=ld.id) 
                LEFT OUTER JOIN users_info us on(b.vendor_id=us.id) 
                LEFT OUTER JOIN bill_summery bs on(b.bill_id=bs.id) 
                WHERE $str_where";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_type_wise_result()
    {
        $result = array();
        $str_where = "b.memo_sts IN(29,88,70) AND b.vendor_type IN(3,5)";
        if(isset($_POST))
        {
            if (trim($this->input->post('staff')) != '') {
                $str_where.= " AND b.vendor_id=".$this->db->escape(trim($this->input->post('staff')));
            }
            if (trim($this->input->post('legal_region')) != '') {
                $str_where.= " AND b.region=".$this->db->escape(trim($this->input->post('legal_region')));
            }

            if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
            if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
            if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
            else{$filling_dt_from='0';}
            if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
            else{$filling_dt_to='0';}

            if( $filling_dt_from!='0' && $filling_dt_to=='0')
            { $str_where.= " and b.txrn_dt='".$filling_dt_from."'"; }
            
            if( $filling_dt_from!='0' && $filling_dt_to!='0')
            { $str_where.= " and b.txrn_dt between '".$filling_dt_from."' and '".$filling_dt_to."'";}
        }
        $sql = "SELECT
                lr.name as region_name,
                SUM(IF(b.vendor_type=3,b.amount,0)) as staff_total,
                SUM(IF(b.vendor_type=5,b.amount,0)) as court_total,
                SUM(IF(b.vendor_type IN(3,5),b.amount,0)) as grand_total
                FROM cost_details b
                LEFT OUTER JOIN ref_legal_region lr on(b.region=lr.id) 
                WHERE $str_where GROUP BY b.region";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_type_wise_activities_result()
    {
        $result = array();
        $str_where = "b.memo_sts IN(29,88,70) AND b.vendor_type IN(5)";
        if(isset($_POST))
        {
            if (trim($this->input->post('staff')) != '') {
                $str_where.= " AND b.vendor_id=".$this->db->escape(trim($this->input->post('staff')));
            }
            if (trim($this->input->post('legal_region')) != '') {
                $str_where.= " AND b.region=".$this->db->escape(trim($this->input->post('legal_region')));
            }

            if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
            if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
            if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
            else{$filling_dt_from='0';}
            if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
            else{$filling_dt_to='0';}

            if( $filling_dt_from!='0' && $filling_dt_to=='0')
            { $str_where.= " and b.txrn_dt='".$filling_dt_from."'"; }
            
            if( $filling_dt_from!='0' && $filling_dt_to!='0')
            { $str_where.= " and b.txrn_dt between '".$filling_dt_from."' and '".$filling_dt_to."'";}
        }
        $sql = "SELECT
                lr.name as activities_name,
                SUM(b.amount) as grand_total
                FROM cost_details b
                LEFT OUTER JOIN ref_court_entertainment_activities lr on(b.activities_id=lr.id) 
                WHERE $str_where GROUP BY b.activities_id";
        $q=$this->db->query($sql);
        return $q->result();
    }
    function get_type_wise_activities_region_result()
    {
        $result = array();
        $str_where = "b.memo_sts IN(29,88,70) AND b.vendor_type IN(5)";
        if(isset($_POST))
        {
            if (trim($this->input->post('staff')) != '') {
                $str_where.= " AND b.vendor_id=".$this->db->escape(trim($this->input->post('staff')));
            }
            if (trim($this->input->post('legal_region')) != '') {
                $str_where.= " AND b.region=".$this->db->escape(trim($this->input->post('legal_region')));
            }

            if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
            if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
            if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
            else{$filling_dt_from='0';}
            if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
            else{$filling_dt_to='0';}

            if( $filling_dt_from!='0' && $filling_dt_to=='0')
            { $str_where.= " and b.txrn_dt='".$filling_dt_from."'"; }
            
            if( $filling_dt_from!='0' && $filling_dt_to!='0')
            { $str_where.= " and b.txrn_dt between '".$filling_dt_from."' and '".$filling_dt_to."'";}
        }
        $sql = "SELECT
                lr.name as region_name,
                b.region as region_id,
                ac.name as activities_name,
                SUM(b.amount) as grand_total
                FROM cost_details b
                LEFT OUTER JOIN ref_legal_region lr on(b.region=lr.id) 
                LEFT OUTER JOIN ref_court_entertainment_activities ac on(b.activities_id=ac.id) 
                WHERE $str_where GROUP BY b.region,b.activities_id";
        $q=$this->db->query($sql);
        return $q->result();
    }

}

?>