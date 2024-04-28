<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Case_file_rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Case_file_rt_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('User_model', '', TRUE);
	}

	// Start View
	function view ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'case_file_rt';
		}
		$data = array(
			'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1 AND id IN(1,2,3)'),
			'final_remarks'=>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1 AND id IN(1,2,3)'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'case_file_rt/pages/grid',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function iss_rt($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
			    $operation = 'iss_rt';
				$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'operation'=> $operation,
					'sub_menue'=> $sub_menue,
					'pages'=> 'case_file_rt/pages/iss_rt',
			   		'per_page' => $this->config->item('per_pagess')
				   );
				$this->load->view('grid_layout',$data);
	}
	function warrant_report($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
			    $operation = 'warrant_report';
				$data = array(
					'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1 AND id IN(1,2,3)'),
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'operation'=> $operation,
					'sub_menue'=> $sub_menue,
					'pages'=> 'case_file_rt/pages/warrant_report',
			   		'per_page' => $this->config->item('per_pagess')
				   );
				$this->load->view('grid_layout',$data);
	}
	function apv_bill_mony_recovery_rt($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
			    $operation = 'apv_bill_mony_recovery_rt';
				$data = array(
					'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1 AND id IN(1,2,3)'),
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'operation'=> $operation,
					'sub_menue'=> $sub_menue,
					'pages'=> 'case_file_rt/pages/apv_bill_mony_recovery_rt',
			   		'per_page' => $this->config->item('per_pagess')
				   );
				$this->load->view('grid_layout',$data);
	}

	function waiting_fr_jr_case_rt ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'waiting_fr_jr_case_rt';
		}
		$data = array(
			'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1 AND id IN(1,2,3)'),
			'final_remarks'=>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1 AND id IN(1,2,3)'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'case_file_rt/pages/waiting_fr_jr_case_rt',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function case_sts_up_rt ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'case_sts_up_rt';
		}
		$data = array(
			'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1 AND id IN(1,2,3)'),
			'final_remarks'=>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1 AND id IN(1,2,3)'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'case_file_rt/pages/case_sts_up_rt',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function first_legal_notice_report ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'first_legal_notice_report';
		}
		$data = array(
			'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1 AND id IN(1,2,3)'),
			'final_remarks'=>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1 AND id IN(1,2,3)'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'case_file_rt/pages/first_legal_notice_report',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function cma_apv__decline_rt ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'cma_apv__decline_rt';
		}
		$data = array(
			'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1 AND id IN(1,2,3)'),
			'final_remarks'=>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1 AND id IN(1,2,3)'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'case_file_rt/pages/cma_apv__decline_rt',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function deliver_rt ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'deliver_rt';
		}
		$data = array(
			'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1 AND id IN(1,2,3)'),
			'final_remarks'=>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1 AND id IN(1,2,3)'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'case_file_rt/pages/deliver_rt',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function after_fill_recovery_rt ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'after_fill_recovery_rt';
		}
		$data = array(
			'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1 AND id IN(1,2,3)'),
			'final_remarks'=>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1 AND id IN(1,2,3)'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'case_file_rt/pages/after_fill_recovery_rt',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function case_aga_bank_rt ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'case_aga_bank_rt';
		}
		$data = array(
			'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1 AND id IN(1,2,3)'),
			'final_remarks'=>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1 AND id IN(1,2,3)'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'case_file_rt/pages/case_aga_bank_rt',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function legal_cost_rt ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'legal_cost_rt';
		}
		$data = array(
			'final_remarks'=>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1 AND id IN(1,2,3)'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'case_file_rt/pages/legal_cost_rt',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function high_court_rt ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'high_court_rt';
		}
		$data = array(
			'final_remarks'=>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1 AND id IN(1,2,3)'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'case_file_rt/pages/high_court_rt',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}

	function case_report_of_month_rt ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'case_report_of_month_rt';
		}
		$data = array(
			'final_remarks'=>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1 AND id IN(1,2,3)'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'case_file_rt/pages/case_report_of_month_rt',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
    function auth_rt ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'auth_rt';
		}
		$data = array(

			'authorization_type'=>$this->User_model->get_parameter_data('ref_authorization_type','name','data_status = 1'),
			
			'final_remarks'=>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1 AND id IN(1,2,3)'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'case_file_rt/pages/auth_rt',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
   // End View

	// ================================================================================================
	// ================================================================================================
	// ================================================================================================

   //Search Data Start

	function get_case_filling_result()
	{
				$csrf_token=$this->security->get_csrf_hash();
				$str_where = "1";
		        if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
		            if($_POST['report_category']==1)
		            {
		            	$str_where.= " AND s.legal_region=".$this->db->escape($_POST['report_category_dropdown']);
		            }
		            else if($_POST['report_category']==3)
		       		{
		       			$str_where.= " AND s.loan_segment=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==4)
		       		{
		       			$str_where.= " AND s.case_deal_officer=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==5)
		       		{
		       			$str_where.= " AND s.district=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==6)
		       		{
		       			$str_where.= " AND s.territory=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		        }
		        if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		        {
		        	$all = explode(",",$_POST['report_category_dropdown_multi']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='s.legal_region= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='s.legal_region= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND s.legal_region= '.$all[0];
			        }
		        }
		        
		        if($_POST['req_type']!='')
		        {
		        	$all = explode(",",$_POST['req_type']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='s.req_type= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='s.req_type= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND s.req_type= '.$all[0];
			        }
		        }
		        if($_POST['final_remarks']!='')
		        {
		        	$all = explode(",",$_POST['final_remarks']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='s.final_remarks= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='s.final_remarks= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND s.final_remarks= '.$all[0];
			        }
		        }

		        if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		        {
		        	if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
		        	if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			        if( $from_year!='0' && $to_year=='0')
			        { $str_where.= " and YEAR(s.filling_date)=".$this->db->escape($from_year); }
			        
			        if( $from_year!='0' && $to_year!='0')
			        { $str_where.= " and YEAR(s.filling_date) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);}
		        }
		        else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		        {
		        	if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			        else{$filling_dt_from='0';}
			        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			        else{$filling_dt_to='0';}

			        if( $filling_dt_from!='0' && $filling_dt_to=='0')
			        { $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
			        
			        if( $filling_dt_from!='0' && $filling_dt_to!='0')
			        { $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}
		        }

		        

		    
		        $str=" SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
		        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
		        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
		        lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,
		        CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
		        CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
		            FROM suit_filling_info as s
		            LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
		            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
		            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
		            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
		            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
		            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
		            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
		            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
		            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
		            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
		            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
		            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
		            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
		            LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
		            LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
		            LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
		            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
		            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
		            WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) ORDER BY s.id ASC";
		            $query=$this->db->query($str);
		            $result = $query->result();

				$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
		                <thead>
		                    <tr>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">A/C Number</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name of Enterprise</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Date</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Activities Taken On The Previous Date</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Next Date</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status on the Next date</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Remarks on Case Status on the Previous date</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Plaintiff</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Plaintiff</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Dealings  officer</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Lawyer\'s Name</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Name Of The Court</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Name Of The Court</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Portfolio</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
		                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Status (Running/ Settled)</td>
		                    </tr>
		                </thead>
		                <tbody id="">';
				if(!empty($result))
				{
					$sl=0;
					foreach ($result as $key) 
					{
						
						$str.='<tr>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_claim_amount.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->act_prev_date.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date_sts.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->remarks_prev_date.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_plaintiff.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->present_plaintiff.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_deal_officer.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_court_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->prest_court_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->legal_region.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
		                </tr>';
					}
					
				}
				else
				{
					$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
				}
				$str.='</tbody>
		            </table>';
				$var =array(
		    			"str"=>$str,
						"csrf_token"=>$csrf_token
						);
				echo json_encode($var);
	}

	function get_iss_report_result()
		{
			$csrf_token=$this->security->get_csrf_hash();
			
			$str='';
			$str2='';
			$str3='';
			$str_where = "1";


			if ($_POST['report_type']!='') {
					if($_POST['report_type']==2){
						$final_remarks=1;

					}else if($_POST['report_type']==3){

						$final_remarks=2;

					}else if($_POST['report_type']==4){
						$final_remarks=1;
					}else{
						$final_remarks='1 or 2';
					}
		        }else{
					$final_remarks='1 or 2';
				}




		        if ($_POST['reporting_period']!='') {

		        }

		        // Reporting Time

   			if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		        {
		        	if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
		        	if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			        if( $from_year!='0' && $to_year=='0')
			        { $str_where.= " and YEAR(s.filling_date)=".$this->db->escape($from_year); }
			        
			        if( $from_year!='0' && $to_year!='0')
			        { $str_where.= " and YEAR(s.filling_date) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);}
		        }
		    else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		        {
		        	if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			        else{$filling_dt_from='0';}
			        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			        else{$filling_dt_to='0';}

			        if( $filling_dt_from!='0' && $filling_dt_to=='0')
			        { $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
			        
			        if( $filling_dt_from!='0' && $filling_dt_to!='0')
			        { $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}
		        }

		        // Reporting Time

                $str=" SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
		        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
		        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
		        lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date, rbs.name as branch_sol ,
		        CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
		        CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
		            FROM suit_filling_info as s
		            LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
		            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
		            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
		            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
		            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
		            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
		            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
		            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
		            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
		            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
		            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
		            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
		            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
		            LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
		            LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
		            LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
		            LEFT OUTER JOIN ref_branch_sol rbs ON (rbs.code=s.branch_sol)


		            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
		            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
		            WHERE $str_where AND (s.final_remarks=$final_remarks) AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) ORDER BY s.id ASC";
		            $query=$this->db->query($str);
		            $result = $query->result();




			 if ($_POST['report_type']=='2') {

				$str='<div> <h1 style="padding-left: 1px;">Running Case List </h1> </div> </div>
				<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">SL</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan Account No</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">SOL</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name Of Enterprise</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filing Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Recovery</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Protfolio</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Remarks</td>
	                    </tr>
	                </thead>
	                <tbody id="">';

			if(!empty($result))
			{
				   $counter=0;                                                                                 
				foreach ($result as $key) 
				{
					$counter=$counter+1;

					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$counter. '</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac. '</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->branch_sol. '</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name. '</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key->case_claim_amount.'</td>
		                <td style="text-align:center;word-wrap: break-word;"></td>

		                <td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
	                	  </tr>';
				}
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody></table>';
	    }else if($_POST['report_type']=='4'){
		  $str='<div> <h1 style="padding-left: 1px;">Filling Case List</h1></div>
				<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">SL</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan Account No</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">SOL</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name Of Enterprise</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filing Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Cost</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Protfolio</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Remarks</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				$counter=0;                                                                                 
				foreach ($result as $key2) 
				{
					$counter=$counter+1;
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$counter. '</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key2->loan_ac. '</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key2->branch_sol. '</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key2->ac_name. '</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key2->case_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key2->requisition_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key2->filling_date.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key2->case_number.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key2->case_claim_amount.'</td>
		                <td style="text-align:center;word-wrap: break-word;"></td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key2->prev_date.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key2->case_sts_prev_dt.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key2->district.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key2->territory.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key2->loan_segment.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key2->final_remarks.'</td>
	                	</tr>';
				}
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
	     $str.='</tbody></table>';


	    }else if($_POST['report_type']=='3'){

			$str='<div> <h1 style="padding-left: 1px;">Settled Case List </h1></div>
				<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">SL</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan Account No</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">SOL</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name Of Enterprise</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filing Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Recovery</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Protfolio</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Remarks</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
		if(!empty($result))
			{
				$counter=0;                                                                                 
				foreach ($result as $key3) 
				{
					$counter=$counter+1;
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$counter. '</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key3->loan_ac. '</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key3->branch_sol. '</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key3->ac_name. '</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key3->case_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key3->requisition_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key3->filling_date.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key3->case_number.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key3->case_claim_amount.'</td>
		                <td style="text-align:center;word-wrap: break-word;"></td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key3->prev_date.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key3->case_sts_prev_dt.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key3->district.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key3->territory.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key3->loan_segment.'</td>
		                <td style="text-align:center;word-wrap: break-word;">'.$key3->final_remarks.'</td>
	                	</tr>';
				}
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
	    }else if($_POST['report_type']=='1'){


			

			$str='<div> <h1 style="padding-left: 1px;">Running Case List </h1> </div> </div>
			<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
				<thead>
					<tr>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">SL</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan Account No</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">SOL</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name Of Enterprise</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filing Date</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Recovery</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Protfolio</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Remarks</td>
					</tr>
				</thead>
				<tbody id="">';
		
		if(!empty($result))
		{
			   $counter=0;                                                                                 
			foreach ($result as $key) 
			{
				$counter=$counter+1;
		
				$str.='<tr>
					<td style="text-align:center;word-wrap: break-word;">'.$counter. '</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac. '</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->branch_sol. '</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->ac_name. '</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->case_claim_amount.'</td>
					<td style="text-align:center;word-wrap: break-word;"></td>
		
					<td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
					  </tr>';
			}
		}
		else
		{
			$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
		}
		$str.='</tbody></table>';
		
		$str2='<div> <h1 style="padding-left: 1px;">Filling Case List</h1></div>
			<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
				<thead>
					<tr>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">SL</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan Account No</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">SOL</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name Of Enterprise</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filing Date</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Cost</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Protfolio</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Remarks</td>
					</tr>
				</thead>
				<tbody id="">';
		if(!empty($result))
		{
			$counter=0;                                                                                 
			foreach ($result as $key2) 
			{
				$counter=$counter+1;
				$str2.='<tr>
					<td style="text-align:center;word-wrap: break-word;">'.$counter. '</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->loan_ac. '</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->branch_sol. '</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->ac_name. '</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->case_name.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->requisition_name.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->filling_date.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->case_number.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->case_claim_amount.'</td>
					<td style="text-align:center;word-wrap: break-word;"></td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->prev_date.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->case_sts_prev_dt.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->district.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->territory.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->loan_segment.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key2->final_remarks.'</td>
					</tr>';
			}
		}
		else
		{
			$str2.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
		}
		$str2.='</tbody></table>';
		
		
		
		$str3='<div> <h1 style="padding-left: 1px;">Settled Case List </h1></div>
			<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
				<thead>
					<tr>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">SL</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan Account No</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">SOL</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name Of Enterprise</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filing Date</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Recovery</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Protfolio</td>
						<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Remarks</td>
					</tr>
				</thead>
				<tbody id="">';
		if(!empty($result))
		{
			$counter=0;                                                                                 
			foreach ($result as $key3) 
			{
				$counter=$counter+1;
				$str3.='<tr>
					<td style="text-align:center;word-wrap: break-word;">'.$counter. '</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->loan_ac. '</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->branch_sol. '</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->ac_name. '</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->case_name.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->requisition_name.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->filling_date.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->case_number.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->case_claim_amount.'</td>
					<td style="text-align:center;word-wrap: break-word;"></td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->prev_date.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->case_sts_prev_dt.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->district.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->territory.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->loan_segment.'</td>
					<td style="text-align:center;word-wrap: break-word;">'.$key3->final_remarks.'</td>
					</tr>';
			}
		}
		else
		{
			$str3.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
		}



		}


			$var =array(
	    			"str"=>$str,
	    			"str2"=>$str2,
	    			"str3"=>$str3,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
		}



	function get_warrant_report_result()
	 {

			$csrf_token=$this->security->get_csrf_hash();
			$str_where = "1";
			if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
				if($_POST['report_category']==1)
				{
					$str_where.= " AND s.legal_region=".$this->db->escape($_POST['report_category_dropdown']);
				}
				else if($_POST['report_category']==3)
				   {
					   $str_where.= " AND s.loan_segment=".$this->db->escape($_POST['report_category_dropdown']);
				}
				else if($_POST['report_category']==4)
				   {
					   $str_where.= " AND s.case_deal_officer=".$this->db->escape($_POST['report_category_dropdown']);
				}
				else if($_POST['report_category']==5)
				   {
					   $str_where.= " AND s.district=".$this->db->escape($_POST['report_category_dropdown']);
				}
				else if($_POST['report_category']==6)
				   {
					   $str_where.= " AND s.territory=".$this->db->escape($_POST['report_category_dropdown']);
				}
			}
			if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
			{
				$all = explode(",",$_POST['report_category_dropdown_multi']);
				if (count($all)>1) //For multiple month
				{
					$str_where.=' AND (';
					for ($i=0; $i < count($all); $i++) 
					{ 
					   if($i==count($all)-1)//For last condition
					   {
						$str_where.='s.legal_region= '.$all[$i];
					   }
					   else //For others condition
					   {
						$str_where.='s.legal_region= '.$all[$i].' OR ';
					   }
					}
					$str_where.=')';
				}
				else //For singel month
				{
					$str_where.=' AND s.legal_region= '.$all[0];
				}
			}
			
			if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
			{
				if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
				if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

				if( $from_year!='0' && $to_year=='0')
				{ $str_where.= " and YEAR(s.filling_date)=".$this->db->escape($from_year); }
				
				if( $from_year!='0' && $to_year!='0')
				{ $str_where.= " and YEAR(s.filling_date) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);}
			}
			else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
			{
				if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
				if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
				if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
				else{$filling_dt_from='0';}
				if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
				else{$filling_dt_to='0';}

				if( $filling_dt_from!='0' && $filling_dt_to=='0')
				{ $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
				
				if( $filling_dt_from!='0' && $filling_dt_to!='0')
				{ $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}
			}

			
			$str=" SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
			DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
			DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
			lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,
			CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
			CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
				FROM suit_filling_info as s
				LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
				LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
				LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
				LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
				LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
				LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
				LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
				LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
				LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
				LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
				LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
				LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
				LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
				LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
				LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
				LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
				LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
				LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
				WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) ORDER BY s.id ASC";
				$query=$this->db->query($str);
				$result = $query->result();


			 
			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">A/C Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name of Enterprise</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Activities Taken On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Next Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status on the Next date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Remarks on Case Status on the Previous date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Dealings  officer</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Lawyer\'s Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Portfolio</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Status (Running/ Settled)</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				$sl=0;
				foreach ($result as $key) 
				{
					
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_claim_amount.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->act_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date_sts.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->remarks_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->present_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_deal_officer.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prest_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->legal_region.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
	                </tr>';
				}
				
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody>
	            </table>';
			$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
		}



	 function get_apv_bill_mony_recovery_rt_result(){



		$csrf_token=$this->security->get_csrf_hash();
		$str_where = "1";
		if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
			if($_POST['report_category']==1)
			{
				$str_where.= " AND s.legal_region=".$this->db->escape($_POST['report_category_dropdown']);
			}
			else if($_POST['report_category']==3)
			   {
				   $str_where.= " AND s.loan_segment=".$this->db->escape($_POST['report_category_dropdown']);
			}
			else if($_POST['report_category']==4)
			   {
				   $str_where.= " AND s.case_deal_officer=".$this->db->escape($_POST['report_category_dropdown']);
			}
			else if($_POST['report_category']==5)
			   {
				   $str_where.= " AND s.district=".$this->db->escape($_POST['report_category_dropdown']);
			}
			else if($_POST['report_category']==6)
			   {
				   $str_where.= " AND s.territory=".$this->db->escape($_POST['report_category_dropdown']);
			}
		}
		if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		{
			$all = explode(",",$_POST['report_category_dropdown_multi']);
			if (count($all)>1) //For multiple month
			{
				$str_where.=' AND (';
				for ($i=0; $i < count($all); $i++) 
				{ 
				   if($i==count($all)-1)//For last condition
				   {
					$str_where.='s.legal_region= '.$all[$i];
				   }
				   else //For others condition
				   {
					$str_where.='s.legal_region= '.$all[$i].' OR ';
				   }
				}
				$str_where.=')';
			}
			else //For singel month
			{
				$str_where.=' AND s.legal_region= '.$all[0];
			}
		}
		
		if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		{
			if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
			if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			if( $from_year!='0' && $to_year=='0')
			{ $str_where.= " and YEAR(s.filling_date)=".$this->db->escape($from_year); }
			
			if( $from_year!='0' && $to_year!='0')
			{ $str_where.= " and YEAR(s.filling_date) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);}
		}
		else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		{
			if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			else{$filling_dt_from='0';}
			if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			else{$filling_dt_to='0';}

			if( $filling_dt_from!='0' && $filling_dt_to=='0')
			{ $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
			
			if( $filling_dt_from!='0' && $filling_dt_to!='0')
			{ $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}
		}

		
		$str=" SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
		DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
		DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
		lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,
		CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
		CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
			FROM suit_filling_info as s
			LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
			LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
			LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
			LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
			LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
			LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
			LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
			LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
			LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
			LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
			LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
			LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
			LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
			LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
			LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
			LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
			LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
			LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
			WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) ORDER BY s.id ASC";
			$query=$this->db->query($str);
			$result = $query->result();

			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">A/C Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name of Enterprise</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Activities Taken On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Next Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status on the Next date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Remarks on Case Status on the Previous date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Dealings  officer</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Lawyer\'s Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Portfolio</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Status (Running/ Settled)</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				$sl=0;
				foreach ($result as $key) 
				{
					
						$str.='<tr>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_claim_amount.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->act_prev_date.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date_sts.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->remarks_prev_date.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_plaintiff.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->present_plaintiff.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_deal_officer.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_court_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->prest_court_name.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->legal_region.'</td>
		                    <td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
				</tr>';
				}
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody>
	            </table>';
			$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	 }

     function get_waiting_fr_jr_case_result(){


		$csrf_token=$this->security->get_csrf_hash();
		$str_where = "1";
		if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
		
			if($_POST['report_category']==1)
			   {
				   $str_where.= " AND s.loan_segment=".$this->db->escape($_POST['report_category_dropdown']);
			}
			else if($_POST['report_category']==2)
			   {
				   $str_where.= " AND s.case_deal_officer=".$this->db->escape($_POST['report_category_dropdown']);
			}
		
		}
		if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		{
			$all = explode(",",$_POST['report_category_dropdown_multi']);
			if (count($all)>1) //For multiple month
			{
				$str_where.=' AND (';
				for ($i=0; $i < count($all); $i++) 
				{ 
				   if($i==count($all)-1)//For last condition
				   {
					$str_where.='s.legal_region= '.$all[$i];
				   }
				   else //For others condition
				   {
					$str_where.='s.legal_region= '.$all[$i].' OR ';
				   }
				}
				$str_where.=')';
			}
			else //For singel month
			{
				$str_where.=' AND s.legal_region= '.$all[0];
			}
		}
		

		else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		{
			if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			else{$filling_dt_from='0';}
			if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			else{$filling_dt_to='0';}

			if( $filling_dt_from!='0' && $filling_dt_to=='0')
			{ $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
			
			if( $filling_dt_from!='0' && $filling_dt_to!='0')
			{ $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}
		}

	
		$str=" SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
		DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
		DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
		lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,
		CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
		CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
			FROM suit_filling_info as s
			LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
			LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
			LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
			LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
			LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
			LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
			LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
			LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
			LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
			LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
			LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
			LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
			LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
			LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
			LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
			LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
			LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
			LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
			WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) ORDER BY s.id ASC";
			$query=$this->db->query($str);
			$result = $query->result();

			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">A/C Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name of Enterprise</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Activities Taken On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Next Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status on the Next date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Remarks on Case Status on the Previous date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Dealings  officer</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Lawyer\'s Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Portfolio</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Status (Running/ Settled)</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				$sl=0;
				foreach ($result as $key) 
				{
					
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_claim_amount.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->act_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date_sts.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->remarks_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->present_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_deal_officer.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prest_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->legal_region.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
	                </tr>';
				}
				
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody>
	            </table>';
			$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	 }


	 function get_case_sts_up_result()
	 {
				$csrf_token=$this->security->get_csrf_hash();
				$str_where = "1";
				if ($_POST['report_type']!='' && isset($_POST['report_type_dropdown']) && $_POST['report_type_dropdown']!='') {
		   
					if($_POST['report_type']==3)
					{
						$str_where.= " AND s.legal_region=".$this->db->escape($_POST['report_type_dropdown']);
					}
					else if($_POST['report_type']==4)
					   {
						   $str_where.= " AND s.district=".$this->db->escape($_POST['report_type_dropdown']);
					}
					else if($_POST['report_type']==5)
					   {
						   $str_where.= " AND s.territory=".$this->db->escape($_POST['report_type_dropdown']);
					}
				}

				if($_POST['report_type']!='' && isset($_POST['report_type_dropdown_multi']) && $_POST['report_type_dropdown_multi']!='')
		        {
		        	$all = explode(",",$_POST['report_type_dropdown_multi']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='s.legal_region= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='s.legal_region= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND s.legal_region= '.$all[0];
			        }
		        }


		        if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
		   
		          if($_POST['report_category']==1)
		       		{
		       			$str_where.= " AND s.loan_segment=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==2)
		       		{
		       			$str_where.= " AND s.territory=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		        }
		        if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		        {
		        	$all = explode(",",$_POST['report_category_dropdown_multi']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='s.legal_region= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='s.legal_region= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND s.legal_region= '.$all[0];
			        }
		        }


		        if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		        {
		        	if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
		        	if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			        if( $from_year!='0' && $to_year=='0')
			        { $str_where.= " and YEAR(s.filling_date)=".$this->db->escape($from_year); }
			        
			        if( $from_year!='0' && $to_year!='0')
			        { $str_where.= " and YEAR(s.filling_date) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);}
		        }
		        else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		        {
		        	if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			        else{$filling_dt_from='0';}
			        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			        else{$filling_dt_to='0';}

			        if( $filling_dt_from!='0' && $filling_dt_to=='0')
			        { $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
			        
			        if( $filling_dt_from!='0' && $filling_dt_to!='0')
			        { $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}
		        }

		        

		    
		        $str=" SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
		        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
		        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
		        lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,
		        CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
		        CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
		            FROM suit_filling_info as s
		            LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
		            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
		            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
		            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
		            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
		            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
		            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
		            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
		            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
		            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
		            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
		            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
		            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
		            LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
		            LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
		            LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
		            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
		            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
		            WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) ORDER BY s.id ASC";
		            $query=$this->db->query($str);
		            $result = $query->result();



			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">A/C Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name of Enterprise</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Activities Taken On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Next Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status on the Next date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Remarks on Case Status on the Previous date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Dealings  officer</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Lawyer\'s Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Portfolio</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Status (Running/ Settled)</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				$sl=0;
				foreach ($result as $key) 
				{
					
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_claim_amount.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->act_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date_sts.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->remarks_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->present_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_deal_officer.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prest_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->legal_region.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
	                </tr>';
				}
				
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody>
	            </table>';
			$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	 	



	 }

	 function get_first_legal_notice_result()
	 {




		$csrf_token=$this->security->get_csrf_hash();

		 $str_where = "1";

		if ($_POST['report_category_segment']!='' && isset($_POST['report_category_segment_dropdown']) && $_POST['report_category_segment_dropdown']!='') {

			if($_POST['report_category_segment']==1)
			{
				$str_where.= " AND ln.region=".$this->db->escape($_POST['report_category_segment_dropdown']);
			}
			else if($_POST['report_category_segment']==4)
			{
				$str_where.= " AND ln.district=".$this->db->escape($_POST['report_category_segment_dropdown']);
		 	}
		 	else if($_POST['report_category_segment']==6)
			{
				$str_where.= " AND ln.territory=".$this->db->escape($_POST['report_category_segment_dropdown']);
		 }

		}


		if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		{
			if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
			if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			if( $from_year!='0' && $to_year=='0')
			{
			  $str_where.= " and YEAR(ln.e_dt)=".$this->db->escape($from_year); 

			}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){
			  $str_where.= " and YEAR(ln.legal_notice_s_dt)=".$this->db->escape($from_year); 
			}
			
			if( $from_year!='0' && $to_year!='0')
			{ 
				$str_where.= " and YEAR(ln.e_dt) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);

			}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

				$str_where.= " and YEAR(ln.legal_notice_s_dt) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);

			}


		}
		else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		{
			if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			else{$filling_dt_from='0';}
			if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			else{$filling_dt_to='0';}

			if( $filling_dt_from!='0' && $filling_dt_to=='0')
			{
				 $str_where.= " and ln.e_dt=".$this->db->escape($filling_dt_from);

			}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

				$str_where.= " and ln.legal_notice_s_dt=".$this->db->escape($filling_dt_from);
			}
			if( $filling_dt_from!='0' && $filling_dt_to!='0')
			{ 
				$str_where.= " and ln.e_dt between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);

			}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

				$str_where.= " and ln.e_dt legal_notice_s_dt ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);

			}
		}


		$query_submit=" SELECT 	ln.proposed_type,ln.loan_ac,ln.cif,ln.ac_name,bs.name as branch_sol,st.name as sub_type,ln.spouse_name,ln.mother_name,lss.name as loan_segment,ln.current_address,r.name as region_name,t.name as territory,law.name as lawyer,uo.name as unit_office,d.name as district
		FROM legal_notice as ln
		LEFT OUTER JOIN ref_region r ON (r.id=ln.region)
		LEFT OUTER JOIN ref_subject_type st ON (st.id=ln.sub_type)
		LEFT OUTER JOIN ref_territory t ON (t.id=ln.territory)
		LEFT OUTER JOIN ref_district d ON (d.id=ln.district)
		LEFT OUTER JOIN ref_branch_sol bs ON (bs.id=ln.branch_sol)
		LEFT OUTER JOIN ref_unit_office uo ON (uo.id=ln.unit_office)
		LEFT OUTER JOIN ref_lawyer law ON (law.id=ln.lawyer)
		LEFT OUTER JOIN ref_loan_segment lss ON (lss.id=ln.loan_segment)
		WHERE $str_where AND ln.sts=1  ORDER BY ln.id ASC";
		$query_data = $this->db->query($query_submit);
		$result = $query_data->result();
			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">A/C Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">CIF</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan A/C Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Business Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Spouse Name </td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Mother Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan Segment (Portfolio)</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Branch</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Unit Office</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Lawyer Name</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				$sl=0;
				foreach ($result as $key) 
				{
					$str.='<tr>
						   <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
					       <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
					       <td style="text-align:center;word-wrap: break-word;">'.$key->cif.'</td>
					       <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
					       <td style="text-align:center;word-wrap: break-word;">'.$key->sub_type.'</td>
					       <td style="text-align:center;word-wrap: break-word;">'.$key->spouse_name.'</td>
					       <td style="text-align:center;word-wrap: break-word;">'.$key->mother_name.'</td>
					       <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
					       <td style="text-align:center;word-wrap: break-word;">'.$key->region_name.'</td>
					       <td style="text-align:center;word-wrap: break-word;">'.$key->branch_sol.'</td>
					       <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
					       <td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
					       <td style="text-align:center;word-wrap: break-word;">'.$key->unit_office.'</td>
						   <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer.'</td>
	                </tr>';
				}
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody>
	            </table>';
			$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);

		echo json_encode($var);

	
	 }
 	 function cma_apv__decline_result()
	 {

	 		   $csrf_token=$this->security->get_csrf_hash();
				$str_where = "1";

		        if ($_POST['report_category_segment']!='' && isset($_POST['report_category_segment_dropdown']) && $_POST['report_category_segment_dropdown']!='') {
		            if($_POST['report_category_segment']==1)
		            {
		            	$str_where.= " AND j0.legal_region=".$this->db->escape($_POST['report_category_segment_dropdown']);
		            }
		            else if($_POST['report_category_segment']==3)
		       		{
		       			$str_where.= " AND j0.loan_segment=".$this->db->escape($_POST['report_category_segment_dropdown']);
		        	}
		            else if($_POST['report_category_segment']==4)
		       		{
		       			$str_where.= " AND j0.case_deal_officer=".$this->db->escape($_POST['report_category_segment_dropdown']);
		        	}
		            else if($_POST['report_category_segment']==5)
		       		{
		       			$str_where.= " AND j0.district=".$this->db->escape($_POST['report_category_segment_dropdown']);
		        	}
		            else if($_POST['report_category_segment']==6)
		       		{
		       			$str_where.= " AND j0.territory=".$this->db->escape($_POST['report_category_segment_dropdown']);
		        	}
		        }
		        if($_POST['report_category_segment']!='' && isset($_POST['report_category_segment_dropdown_multi']) && $_POST['report_category_segment_dropdown_multi']!='')
		        {
		        	$all = explode(",",$_POST['report_category_segment_dropdown_multi']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='j0.legal_region= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='j0.legal_region= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND j0.legal_region= '.$all[0];
			        }
		        }


				// Report Catagory


				if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
					if($_POST['report_category_segment']==2)
					{
						$str_where.= " AND j0.case_deal_officer=".$this->db->escape($_POST['report_category_dropdown']);
				 }
		        }

				if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		        {
		        	$all = explode(",",$_POST['report_category_dropdown_multi']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='j0.legal_region= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='j0.legal_region= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND j0.legal_region= '.$all[0];
			        }
		        }

				// Report Catagory

		        if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		        {
		        	if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
		        	if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			        if( $from_year!='0' && $to_year=='0')
			        { 
						$str_where.= " and YEAR(j0.e_dt)=".$this->db->escape($from_year);

					 }

					//  Search Data New Logic
					else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){
						$str_where.= " and j0.cma_sts IN(60,104)"; 
						$str_where.= " and YEAR(j0.deliver_dt)=".$this->db->escape($from_year); 
					}
					else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
						$str_where.= " and j0.cma_sts IN(5,12,91)"; 
					}
					//  Search Data New Logic


			        
			        if( $from_year!='0' && $to_year!='0')
			        { 
						$str_where.= " and YEAR(j0.e_dt) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);
					
					}
					//  Search Data New Logic

					else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){
						$str_where.= " and j0.cma_sts IN(60,104)"; 
						$str_where.= " and YEAR(j0.deliver_dt) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);
					}
					else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
						$str_where.= " and j0.cma_sts IN(5,12,91)"; 
					}
					//  Search Data New Logic


		        }
		        else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		        {
		        	if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			        else{$filling_dt_from='0';}
			        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			        else{$filling_dt_to='0';}

			        if( $filling_dt_from!='0' && $filling_dt_to=='0')
			        {
						 $str_where.= " and j0.e_dt=".$this->db->escape($filling_dt_from);

					}
					
					//  Search Data New Logic

					else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){
						$str_where.= " and j0.cma_sts IN(60,104)"; 
						$str_where.= " and j0.deliver_dt=".$this->db->escape($filling_dt_from);
					}
					else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
						$str_where.= " and j0.cma_sts IN(5,12,91)"; 
					}
			        
					//  Search Data New Logic



			        if( $filling_dt_from!='0' && $filling_dt_to!='0')
			        {
						$str_where.= " and j0.e_dt between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);
					}
					
					//  Search Data New Logic

					else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){
						$str_where.= " and j0.cma_sts IN(60,104)"; 
						$str_where.= " and j0.deliver_dt between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);
					}
					else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
						$str_where.= " and j0.cma_sts IN(5,12,91)"; 
					}
					//  Search Data New Logic




		        }


		           $str="SELECT
				   j0.sl_no,
				   j2.name as territory_name,
				   j3.name as req_type,
				   j4.name as district,
				   j0.proposed_type,
				   j0.cif,
				   j0.loan_ac,
				   j0.more_acc_number,
				   j5.name as unit_office_name,
				   DATE_FORMAT(j0.loan_sanction_dt,'%d-%b-%y %h:%i %p') AS loan_sanction_dt,
				   j6.name as branch_sol,
				   j0.ac_name,
				   j7.name as pre_case_type,
				   j8.name as sub_type,
				   j0.mother_name,
				   j9.name as loan_segment,
				   j10.name as region,
				   j0.last_payment_amount,
				   j11.name as case_fill_dist,
				   j0.st_belance,
				   j0.current_dpd,
				   j12.name as legal_region,
				   j13.name as borr_sts
				   FROM cma as j0
				   LEFT OUTER JOIN ref_territory j2 ON (j2.id=j0.territory)
				   LEFT OUTER JOIN ref_req_type j3 ON (j3.id=j0.req_type)
				   LEFT OUTER JOIN ref_district j4 ON (j4.id=j0.district)
				   LEFT OUTER JOIN ref_unit_office j5 ON (j5.id=j0.unit_office)
				   LEFT OUTER JOIN ref_branch_sol j6 ON (j6.code=j0.branch_sol)
				   LEFT OUTER JOIN ref_req_type j7 ON (j7.id=j0.pre_case_type)
				   LEFT OUTER JOIN ref_subject_type j8 ON (j8.id=j0.sub_type)
				   LEFT OUTER JOIN ref_loan_segment j9 ON (j9.code=j0.loan_segment)
				   LEFT OUTER JOIN ref_region j10 ON (j10.id=j0.region)
				   LEFT OUTER JOIN ref_legal_district j11 ON (j11.id=j0.case_fill_dist)
				   LEFT OUTER JOIN ref_legal_region j12 ON (j12.id=j0.legal_region)
				   LEFT OUTER JOIN ref_borr_sts j13 ON (j13.id=j0.borr_sts)


					WHERE $str_where AND j0.sts=1  ORDER BY j0.id ASC";
		            $query=$this->db->query($str);
		            $result = $query->result();

			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">SL No</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Requisition Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Unit Office</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan A/CNo</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">More A/C No</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">CIF</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan Sanction Date</td>
							<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Branch SOL</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan A/C Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Case Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Business Type 	</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Mother Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan Segment (Portfolio) </td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Last Payment Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case File District </td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Current DPD </td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Borrower Status</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				foreach ($result as $serial=>$key) 
				{
					$serial+=1;
					
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->sl_no.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->territory_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->req_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->unit_office_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->more_acc_number.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->cif.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_sanction_dt.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->branch_sol.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->pre_case_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->sub_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->mother_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->region.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->last_payment_amount.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_fill_dist.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->st_belance.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->current_dpd.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->legal_region.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->borr_sts.'</td>
	             
	                </tr>';
				}
				
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody>
	            </table>';
			$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	 	
	 }

	 function deliver_rt_result()
	 {

	 		   $csrf_token=$this->security->get_csrf_hash();
				$str_where = "1";

		        if ($_POST['report_category_segment']!='' && isset($_POST['report_category_segment_dropdown']) && $_POST['report_category_segment_dropdown']!='') {
		            if($_POST['report_category_segment']==1)
		            {
		            	$str_where.= " AND j0.legal_region=".$this->db->escape($_POST['report_category_segment_dropdown']);
		            }
		            else if($_POST['report_category_segment']==3)
		       		{
		       			$str_where.= " AND j0.loan_segment=".$this->db->escape($_POST['report_category_segment_dropdown']);
		        	}
		            else if($_POST['report_category_segment']==4)
		       		{
		       			$str_where.= " AND j0.case_deal_officer=".$this->db->escape($_POST['report_category_segment_dropdown']);
		        	}
		            else if($_POST['report_category_segment']==5)
		       		{
		       			$str_where.= " AND j0.district=".$this->db->escape($_POST['report_category_segment_dropdown']);
		        	}
		            else if($_POST['report_category_segment']==6)
		       		{
		       			$str_where.= " AND j0.territory=".$this->db->escape($_POST['report_category_segment_dropdown']);
		        	}
		        }
		        if($_POST['report_category_segment']!='' && isset($_POST['report_category_segment_dropdown_multi']) && $_POST['report_category_segment_dropdown_multi']!='')
		        {
		        	$all = explode(",",$_POST['report_category_segment_dropdown_multi']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='j0.legal_region= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='j0.legal_region= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND j0.legal_region= '.$all[0];
			        }
		        }


				// Report Catagory


				if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
					if($_POST['report_category_segment']==2)
					{
						$str_where.= " AND j0.case_deal_officer=".$this->db->escape($_POST['report_category_dropdown']);
				 }
		        }

				if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		        {
		        	$all = explode(",",$_POST['report_category_dropdown_multi']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='j0.legal_region= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='j0.legal_region= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND j0.legal_region= '.$all[0];
			        }
		        }

				// Report Catagory

		        if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		        {
		        	if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
		        	if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			        if( $from_year!='0' && $to_year=='0')
			        { 
						$str_where.= " and YEAR(j0.e_dt)=".$this->db->escape($from_year);

					 }

					//  Search Data New Logic
					else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

						$str_where.= " and j0.cma_sts IN(60,104)"; 
					}
					else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){

						$str_where.= " and j0.cma_sts IN(59)"; 

					}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==3){

						$str_where.= " and j0.cma_sts > 59"; 

					}
					//  Search Data New Logic


			        
			        if( $from_year!='0' && $to_year!='0')
			        { 
						$str_where.= " and YEAR(j0.e_dt) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);
					
					}
						//  Search Data New Logic
					else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

						$str_where.= " and j0.cma_sts IN(60,104)"; 
					}
					else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
						
						$str_where.= " and j0.cma_sts IN(59)"; 

					}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==3){

						$str_where.= " and j0.cma_sts > 59"; 

					}
					//  Search Data New Logic

		        }
		        else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		        {
		        	if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			        else{$filling_dt_from='0';}
			        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			        else{$filling_dt_to='0';}

			        if( $filling_dt_from!='0' && $filling_dt_to=='0')
			        {
						 $str_where.= " and j0.e_dt=".$this->db->escape($filling_dt_from);

					}
					
						//  Search Data New Logic
						else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

							$str_where.= " and j0.cma_sts IN(60,104)"; 
						}
						else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
							
							$str_where.= " and j0.cma_sts IN(59)"; 
	
						}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==3){
	
							$str_where.= " and j0.cma_sts > 59"; 
	
						}
						//  Search Data New Logic

			        if( $filling_dt_from!='0' && $filling_dt_to!='0')
			        {
						$str_where.= " and j0.e_dt between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);
					}
					
						//  Search Data New Logic
						else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

							$str_where.= " and j0.cma_sts IN(60,104)"; 
						}
						else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
							
							$str_where.= " and j0.cma_sts IN(59)"; 
	
						}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==3){
	
							$str_where.= " and j0.cma_sts < 59"; 
	
						}
						//  Search Data New Logic
		        }


		           $str="SELECT
				   j0.sl_no,
				   j2.name as territory_name,
				   j3.name as req_type,
				   j4.name as district,
				   j0.proposed_type,
				   j0.cif,
				   j0.loan_ac,
				   j0.more_acc_number,
				   j5.name as unit_office_name,
				   DATE_FORMAT(j0.loan_sanction_dt,'%d-%b-%y %h:%i %p') AS loan_sanction_dt,
				   j6.name as branch_sol,
				   j0.ac_name,
				   j7.name as pre_case_type,
				   j8.name as sub_type,
				   j0.mother_name,
				   j9.name as loan_segment,
				   j10.name as region,
				   j0.last_payment_amount,
				   j11.name as case_fill_dist,
				   j0.st_belance,
				   j0.current_dpd,
				   j12.name as legal_region,
				   j13.name as borr_sts
				   FROM cma as j0
				   LEFT OUTER JOIN ref_territory j2 ON (j2.id=j0.territory)
				   LEFT OUTER JOIN ref_req_type j3 ON (j3.id=j0.req_type)
				   LEFT OUTER JOIN ref_district j4 ON (j4.id=j0.district)
				   LEFT OUTER JOIN ref_unit_office j5 ON (j5.id=j0.unit_office)
				   LEFT OUTER JOIN ref_branch_sol j6 ON (j6.code=j0.branch_sol)
				   LEFT OUTER JOIN ref_req_type j7 ON (j7.id=j0.pre_case_type)
				   LEFT OUTER JOIN ref_subject_type j8 ON (j8.id=j0.sub_type)
				   LEFT OUTER JOIN ref_loan_segment j9 ON (j9.code=j0.loan_segment)
				   LEFT OUTER JOIN ref_region j10 ON (j10.id=j0.region)
				   LEFT OUTER JOIN ref_legal_district j11 ON (j11.id=j0.case_fill_dist)
				   LEFT OUTER JOIN ref_legal_region j12 ON (j12.id=j0.legal_region)
				   LEFT OUTER JOIN ref_borr_sts j13 ON (j13.id=j0.borr_sts)


					WHERE $str_where AND j0.sts=1  ORDER BY j0.id ASC";
		            $query=$this->db->query($str);
		            $result = $query->result();

			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">SL No</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Requisition Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Unit Office</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan A/CNo</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">More A/C No</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">CIF</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan Sanction Date</td>
							<td style="font-weight: bold;text-align:center;word-wrap: break-word;">Branch SOL</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan A/C Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Case Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Business Type 	</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Mother Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Loan Segment (Portfolio) </td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Last Payment Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case File District </td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Current DPD </td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Borrower Status</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				foreach ($result as $serial=>$key) 
				{
					$serial+=1;
					
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->sl_no.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->territory_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->req_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->unit_office_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->more_acc_number.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->cif.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_sanction_dt.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->branch_sol.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->pre_case_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->sub_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->mother_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->region.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->last_payment_amount.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_fill_dist.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->st_belance.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->current_dpd.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->legal_region.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->borr_sts.'</td>
	             
	                </tr>';
				}
				
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody>
	            </table>';
			$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	 	
	 }




function after_fill_recovery_rt_result()
	 {
	 	
  $csrf_token=$this->security->get_csrf_hash();
			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">A/C Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name of Enterprise</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Activities Taken On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Next Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status on the Next date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Remarks on Case Status on the Previous date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Dealings  officer</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Lawyer\'s Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Portfolio</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Status (Running/ Settled)</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				$sl=0;
				foreach ($result as $key) 
				{
					
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_claim_amount.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->act_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date_sts.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->remarks_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->present_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_deal_officer.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prest_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->legal_region.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
	                </tr>';
				}
				
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody>
	            </table>';
			$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	 	


	 }





function case_aga_bank_result()
	 {
	 	
       $csrf_token=$this->security->get_csrf_hash();
			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">A/C Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name of Enterprise</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Activities Taken On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Next Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status on the Next date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Remarks on Case Status on the Previous date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Dealings  officer</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Lawyer\'s Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Portfolio</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Status (Running/ Settled)</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				$sl=0;
				foreach ($result as $key) 
				{
					
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_claim_amount.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->act_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date_sts.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->remarks_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->present_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_deal_officer.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prest_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->legal_region.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
	                </tr>';
				}
				
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody>
	            </table>';
			$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	 	


	 }


function case_report_of_month_result()
	 {
	 	
  			$csrf_token=$this->security->get_csrf_hash();
			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">A/C Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name of Enterprise</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Activities Taken On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Next Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status on the Next date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Remarks on Case Status on the Previous date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Dealings  officer</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Lawyer\'s Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Portfolio</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Status (Running/ Settled)</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				$sl=0;
				foreach ($result as $key) 
				{
					
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_claim_amount.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->act_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date_sts.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->remarks_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->present_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_deal_officer.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prest_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->legal_region.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
	                </tr>';
				}
				
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody>
	            </table>';
			$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	 	
	 }



function auth_rt_form_result()
	 {
	 	
  			$csrf_token=$this->security->get_csrf_hash();
			$str='<table class="" table border="1" id="facility_table" style="border-color:#c0c0c0;" >
	                <thead>
	                    <tr>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">A/C Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name of Enterprise</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Activities Taken On The Previous Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Next Date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status on the Next date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Remarks on Case Status on the Previous date</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Plaintiff</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Dealings  officer</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Lawyer\'s Name</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Name Of The Court</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Portfolio</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
	                        <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Status (Running/ Settled)</td>
	                    </tr>
	                </thead>
	                <tbody id="">';
			if(!empty($result))
			{
				$sl=0;
				foreach ($result as $key) 
				{
					
					$str.='<tr>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_claim_amount.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->act_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date_sts.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->remarks_prev_date.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->present_plaintiff.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_deal_officer.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->prest_court_name.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->legal_region.'</td>
	                    <td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
	                </tr>';
				}
				
			}
			else
			{
				$str.="<tr><td colspan='25' align='center'>No Data Found!!!</td></tr>";
			}
			$str.='</tbody>
	            </table>';
			$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	 	
	 }









	// End Search Data 
	// ====================================================================
	// All Excel Function Here 
	 public function case_file_rt_xl()
	 {
			$csrf_token=$this->security->get_csrf_hash();
				$str_where = "1";
		        if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
		            if($_POST['report_category']==1)
		            {
		            	$str_where.= " AND s.legal_region=".$this->db->escape($_POST['report_category_dropdown']);
		            }
		            else if($_POST['report_category']==3)
		       		{
		       			$str_where.= " AND s.loan_segment=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==4)
		       		{
		       			$str_where.= " AND s.case_deal_officer=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==5)
		       		{
		       			$str_where.= " AND s.district=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==6)
		       		{
		       			$str_where.= " AND s.territory=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		        }
		        if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		        {
		        	$all = explode(",",$_POST['report_category_dropdown_multi']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='s.legal_region= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='s.legal_region= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND s.legal_region= '.$all[0];
			        }
		        }
		        
		        if($_POST['req_type']!='')
		        {
		        	$all = explode(",",$_POST['req_type']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='s.req_type= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='s.req_type= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND s.req_type= '.$all[0];
			        }
		        }
		        if($_POST['final_remarks']!='')
		        {
		        	$all = explode(",",$_POST['final_remarks']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='s.final_remarks= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='s.final_remarks= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND s.final_remarks= '.$all[0];
			        }
		        }

		        if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		        {
		        	if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
		        	if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			        if( $from_year!='0' && $to_year=='0')
			        { $str_where.= " and YEAR(s.filling_date)=".$this->db->escape($from_year); }
			        
			        if( $from_year!='0' && $to_year!='0')
			        { $str_where.= " and YEAR(s.filling_date) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);}
		        }
		        else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		        {
		        	if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			        else{$filling_dt_from='0';}
			        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			        else{$filling_dt_to='0';}

			        if( $filling_dt_from!='0' && $filling_dt_to=='0')
			        { $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
			        
			        if( $filling_dt_from!='0' && $filling_dt_to!='0')
			        { $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}
		        }

		        $str=" SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
		        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
		        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
		        lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,
		        CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
		        CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
		            FROM suit_filling_info as s
		            LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
		            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
		            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
		            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
		            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
		            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
		            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
		            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
		            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
		            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
		            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
		            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
		            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
		            LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
		            LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
		            LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
		            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
		            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
		            WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) ORDER BY s.id ASC";
		            $query=$this->db->query($str);
		            $result = $query->result();


			        require_once('./application/Classes/PHPExcel.php');
			        $objPHPExcel = new PHPExcel();
			        $objPHPExcel->setActiveSheetIndex(0);
			        $styleArray_border = array(
			            'borders' => array(
			                'allborders' => array(
			                    'style' => PHPExcel_Style_Border::BORDER_THIN
			                )
			            )
			        );

		$headings4 = array(
            'Serial', 'Proposed Type', 'A/C Number', 'Name of Enterprise', '3 Type of Case','Type Of Case', 'Filling Date',
             'Case Number', 'Case Claim Amount', 'Previous Date', 'Case Status On The Previous Date', 'Activities Taken On The Previous Date', 'Next Date', 'Case Status on the Next date', 'Remarks on Case Status on the Previous date', ' Filling Plaintiff', 'Present Plaintiff', 'Case Dealings officer', 'Lawyer Name', ' Previous Name Of The Court', 'Present Name Of The Court', 'District','Territory','Portfolio','Legal Region','Final Status (Running/ Settled)'
        );



        $te = 'A';
        for ($i = 0; $i < count($headings4); $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($te)->setWidth(20);
            $te++;
        }
        $te--;
        $rowNumber = 1;
        $headings1 = array('Case Filing Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':' . $te . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);
        $rowNumber++;

        $rowNumber++;

        // echo count($headings4);
        //exit;
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'eee4e3')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 1;
		foreach ($result as $key_serial => $key) {

            $objPHPExcel->getActiveSheet()->fromArray(array(
                		   $key_serial + 1,
                           $key->proposed_type,
		                   $key->loan_ac,
		                   $key->ac_name,
		                   $key->requisition_name,
		                   $key->case_name,
		                   $key->filling_date,
		                   $key->case_number,
		                   $key->case_claim_amount,
		                   $key->prev_date,
		                   $key->case_sts_prev_dt,
		                   $key->act_prev_date,
		                   $key->next_date,
		                   $key->next_date_sts,
		                   $key->remarks_prev_date,
		                   $key->filling_plaintiff,
		                   $key->present_plaintiff,
		                   $key->case_deal_officer,
		                   $key->lawyer_name,
		                   $key->prev_court_name,
		                   $key->prest_court_name,
		                   $key->district,
		                   $key->territory,
		                   $key->loan_segment,
		                   $key->legal_region,
		                   $key->final_remarks,

            ), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('C' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
            $rowNumber++;
        }


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Case Filing Report');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="Case_Filing_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
	 	
	 }

	 public function iss_rt_xl()
	 {

				$str='';
				$str_where = "1";
					if ($_POST['report_type']!='') {

				
						 if($_POST['report_type']==2){
							$final_remarks=1;
	
						}else if($_POST['report_type']==3){
	
							$final_remarks=2;
	
						}else if($_POST['report_type']==4){
							$final_remarks=1;
						}else{
							$final_remarks='1 or 2';
						}

					}
					if ($_POST['reporting_period']!='') {
	
					}
	
					// Reporting Time
	
				   if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
					{
						if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
						if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}
	
						if( $from_year!='0' && $to_year=='0')
						{ $str_where.= " and YEAR(s.filling_date)=".$this->db->escape($from_year); }
						
						if( $from_year!='0' && $to_year!='0')
						{ $str_where.= " and YEAR(s.filling_date) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);}
					}
				 	else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
					{
						if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
						if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
						if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
						else{$filling_dt_from='0';}
						if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
						else{$filling_dt_to='0';}
	
						if( $filling_dt_from!='0' && $filling_dt_to=='0')
						{ $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
						
						if( $filling_dt_from!='0' && $filling_dt_to!='0')
						{ $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}
					}
	
					// Reporting Time
	
					$str=" SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
					DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
					DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
					lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date, rbs.name as branch_sol ,
					CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
					CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
						FROM suit_filling_info as s
						LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
						LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
						LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
						LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
						LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
						LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
						LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
						LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
						LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
						LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
						LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
						LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
						LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
						LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
						LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
						LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
						LEFT OUTER JOIN ref_branch_sol rbs ON (rbs.code=s.branch_sol)
	
	
						LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
						LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
						WHERE $str_where AND (s.final_remarks=$final_remarks) AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) ORDER BY s.id ASC";
						$query=$this->db->query($str);
						$result = $query->result();
		
						require_once('./application/Classes/PHPExcel.php');
						$objPHPExcel = new PHPExcel();
						$objPHPExcel->setActiveSheetIndex(0);
						$styleArray_border = array(
							'borders' => array(
								'allborders' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
								)
							)
						);



			if ($_POST['report_type']=='1') {

			}else if ($_POST['report_type']=='2') {

			}else if ($_POST['report_type']=='3') {

			}if ($_POST['report_type']=='4') {

			}


		$headings4 = array(
            'Serial', 'Proposed Type', 'A/C Number', 'Name of Enterprise', '3 Type of Case','Type Of Case', 'Filling Date',
             'Case Number', 'Case Claim Amount', 'Previous Date', 'Case Status On The Previous Date', 'Activities Taken On The Previous Date', 'Next Date', 'Case Status on the Next date', 'Remarks on Case Status on the Previous date', ' Filling Plaintiff', 'Present Plaintiff', 'Case Dealings officer', 'Lawyer Name', ' Previous Name Of The Court', 'Present Name Of The Court', 'District','Territory','Portfolio','Legal Region','Final Status (Running/ Settled)'
        );



        $te = 'A';
        for ($i = 0; $i < count($headings4); $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($te)->setWidth(20);
            $te++;
        }
        $te--;
        $rowNumber = 1;
        $headings1 = array('ISS Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':' . $te . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);
        $rowNumber++;

        $rowNumber++;

        // echo count($headings4);
        //exit;
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'eee4e3')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 1;
		foreach ($result as $key_serial => $key) {

            $objPHPExcel->getActiveSheet()->fromArray(array(
                		   $key_serial + 1,
                           $key->proposed_type,
		                   $key->loan_ac,
		                   $key->ac_name,
		                   $key->requisition_name,
		                   $key->case_name,
		                   $key->filling_date,
		                   $key->case_number,
		                   $key->case_claim_amount,
		                   $key->prev_date,
		                   $key->case_sts_prev_dt,
		                   $key->act_prev_date,
		                   $key->next_date,
		                   $key->next_date_sts,
		                   $key->remarks_prev_date,
		                   $key->filling_plaintiff,
		                   $key->present_plaintiff,
		                   $key->case_deal_officer,
		                   $key->lawyer_name,
		                   $key->prev_court_name,
		                   $key->prest_court_name,
		                   $key->district,
		                   $key->territory,
		                   $key->loan_segment,
		                   $key->legal_region,
		                   $key->final_remarks,

            ), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('C' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
            $rowNumber++;
        }


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('ISS Report');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="iss_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();


		

		


	 }

	 public function warrant_report_xl()
	 {
			$csrf_token=$this->security->get_csrf_hash();
				$str_where = "1";
		        if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
		            if($_POST['report_category']==1)
		            {
		            	$str_where.= " AND s.legal_region=".$this->db->escape($_POST['report_category_dropdown']);
		            }
		            else if($_POST['report_category']==3)
		       		{
		       			$str_where.= " AND s.loan_segment=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==4)
		       		{
		       			$str_where.= " AND s.case_deal_officer=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==5)
		       		{
		       			$str_where.= " AND s.district=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==6)
		       		{
		       			$str_where.= " AND s.territory=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		        }
		        if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		        {
		        	$all = explode(",",$_POST['report_category_dropdown_multi']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='s.legal_region= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='s.legal_region= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND s.legal_region= '.$all[0];
			        }
		        }


		        if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		        {
		        	if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
		        	if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			        if( $from_year!='0' && $to_year=='0')
			        { $str_where.= " and YEAR(s.filling_date)=".$this->db->escape($from_year); }
			        
			        if( $from_year!='0' && $to_year!='0')
			        { $str_where.= " and YEAR(s.filling_date) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);}
		        }
		        else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		        {
		        	if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			        else{$filling_dt_from='0';}
			        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			        else{$filling_dt_to='0';}

			        if( $filling_dt_from!='0' && $filling_dt_to=='0')
			        { $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
			        
			        if( $filling_dt_from!='0' && $filling_dt_to!='0')
			        { $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}
		        }

		        $str=" SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
		        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
		        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
		        lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,
		        CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
		        CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
		            FROM suit_filling_info as s
		            LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
		            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
		            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
		            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
		            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
		            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
		            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
		            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
		            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
		            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
		            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
		            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
		            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
		            LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
		            LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
		            LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
		            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
		            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
		            WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) ORDER BY s.id ASC";
		            $query=$this->db->query($str);
		            $result = $query->result();


			        require_once('./application/Classes/PHPExcel.php');
			        $objPHPExcel = new PHPExcel();
			        $objPHPExcel->setActiveSheetIndex(0);
			        $styleArray_border = array(
			            'borders' => array(
			                'allborders' => array(
			                    'style' => PHPExcel_Style_Border::BORDER_THIN
			                )
			            )
			        );

		$headings4 = array(
            'Serial', 'Proposed Type', 'A/C Number', 'Name of Enterprise', '3 Type of Case','Type Of Case', 'Filling Date',
             'Case Number', 'Case Claim Amount', 'Previous Date', 'Case Status On The Previous Date', 'Activities Taken On The Previous Date', 'Next Date', 'Case Status on the Next date', 'Remarks on Case Status on the Previous date', ' Filling Plaintiff', 'Present Plaintiff', 'Case Dealings officer', 'Lawyer Name', ' Previous Name Of The Court', 'Present Name Of The Court', 'District','Territory','Portfolio','Legal Region','Final Status (Running/ Settled)'
        );



        $te = 'A';
        for ($i = 0; $i < count($headings4); $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($te)->setWidth(20);
            $te++;
        }
        $te--;
        $rowNumber = 1;
        $headings1 = array('Warrant Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':' . $te . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);
        $rowNumber++;

        $rowNumber++;

        // echo count($headings4);
        //exit;
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'eee4e3')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 1;
		foreach ($result as $key_serial => $key) {

            $objPHPExcel->getActiveSheet()->fromArray(array(
                		   $key_serial + 1,
                           $key->proposed_type,
		                   $key->loan_ac,
		                   $key->ac_name,
		                   $key->requisition_name,
		                   $key->case_name,
		                   $key->filling_date,
		                   $key->case_number,
		                   $key->case_claim_amount,
		                   $key->prev_date,
		                   $key->case_sts_prev_dt,
		                   $key->act_prev_date,
		                   $key->next_date,
		                   $key->next_date_sts,
		                   $key->remarks_prev_date,
		                   $key->filling_plaintiff,
		                   $key->present_plaintiff,
		                   $key->case_deal_officer,
		                   $key->lawyer_name,
		                   $key->prev_court_name,
		                   $key->prest_court_name,
		                   $key->district,
		                   $key->territory,
		                   $key->loan_segment,
		                   $key->legal_region,
		                   $key->final_remarks,

            ), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('C' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
            $rowNumber++;
        }


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Warrant Report');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="Warrant_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
	 	
	 }

	 public function warrant_apv_bill_mony_recovery_xl()
	 {
			$csrf_token=$this->security->get_csrf_hash();
				$str_where = "1";
		        if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
		            if($_POST['report_category']==1)
		            {
		            	$str_where.= " AND s.legal_region=".$this->db->escape($_POST['report_category_dropdown']);
		            }
		            else if($_POST['report_category']==3)
		       		{
		       			$str_where.= " AND s.loan_segment=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==4)
		       		{
		       			$str_where.= " AND s.case_deal_officer=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==5)
		       		{
		       			$str_where.= " AND s.district=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==6)
		       		{
		       			$str_where.= " AND s.territory=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		        }
		        if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		        {
		        	$all = explode(",",$_POST['report_category_dropdown_multi']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='s.legal_region= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='s.legal_region= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND s.legal_region= '.$all[0];
			        }
		        }


		        if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		        {
		        	if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
		        	if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			        if( $from_year!='0' && $to_year=='0')
			        { $str_where.= " and YEAR(s.filling_date)=".$this->db->escape($from_year); }
			        
			        if( $from_year!='0' && $to_year!='0')
			        { $str_where.= " and YEAR(s.filling_date) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);}
		        }
		        else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		        {
		        	if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			        else{$filling_dt_from='0';}
			        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			        else{$filling_dt_to='0';}

			        if( $filling_dt_from!='0' && $filling_dt_to=='0')
			        { $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
			        
			        if( $filling_dt_from!='0' && $filling_dt_to!='0')
			        { $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}
		        }

		        $str=" SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
		        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
		        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
		        lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,
		        CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
		        CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
		            FROM suit_filling_info as s
		            LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
		            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
		            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
		            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
		            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
		            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
		            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
		            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
		            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
		            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
		            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
		            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
		            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
		            LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
		            LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
		            LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
		            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
		            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
		            WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) ORDER BY s.id ASC";
		            $query=$this->db->query($str);
		            $result = $query->result();


			        require_once('./application/Classes/PHPExcel.php');
			        $objPHPExcel = new PHPExcel();
			        $objPHPExcel->setActiveSheetIndex(0);
			        $styleArray_border = array(
			            'borders' => array(
			                'allborders' => array(
			                    'style' => PHPExcel_Style_Border::BORDER_THIN
			                )
			            )
			        );

		$headings4 = array(
            'Serial', 'Proposed Type', 'A/C Number', 'Name of Enterprise', '3 Type of Case','Type Of Case', 'Filling Date',
             'Case Number', 'Case Claim Amount', 'Previous Date', 'Case Status On The Previous Date', 'Activities Taken On The Previous Date', 'Next Date', 'Case Status on the Next date', 'Remarks on Case Status on the Previous date', ' Filling Plaintiff', 'Present Plaintiff', 'Case Dealings officer', 'Lawyer Name', ' Previous Name Of The Court', 'Present Name Of The Court', 'District','Territory','Portfolio','Legal Region','Final Status (Running/ Settled)'
        );



        $te = 'A';
        for ($i = 0; $i < count($headings4); $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($te)->setWidth(20);
            $te++;
        }
        $te--;
        $rowNumber = 1;
        $headings1 = array('Warrant Appeal Bill Money Recovery Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':' . $te . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);
        $rowNumber++;

        $rowNumber++;

        // echo count($headings4);
        //exit;
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'eee4e3')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 1;
		foreach ($result as $key_serial => $key) {

            $objPHPExcel->getActiveSheet()->fromArray(array(
                		   $key_serial + 1,
                           $key->proposed_type,
		                   $key->loan_ac,
		                   $key->ac_name,
		                   $key->requisition_name,
		                   $key->case_name,
		                   $key->filling_date,
		                   $key->case_number,
		                   $key->case_claim_amount,
		                   $key->prev_date,
		                   $key->case_sts_prev_dt,
		                   $key->act_prev_date,
		                   $key->next_date,
		                   $key->next_date_sts,
		                   $key->remarks_prev_date,
		                   $key->filling_plaintiff,
		                   $key->present_plaintiff,
		                   $key->case_deal_officer,
		                   $key->lawyer_name,
		                   $key->prev_court_name,
		                   $key->prest_court_name,
		                   $key->district,
		                   $key->territory,
		                   $key->loan_segment,
		                   $key->legal_region,
		                   $key->final_remarks,

            ), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('C' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
            $rowNumber++;
        }


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Warrant Recovery Report');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="Warrant_Recovery_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
	 	
	 }
	 public function waiting_fr_jr_case_rt_xl()
	 {
			$csrf_token=$this->security->get_csrf_hash();
				$str_where = "1";
		        if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
		         
		           if($_POST['report_category']==1)
		       		{
		       			$str_where.= " AND s.loan_segment=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		            else if($_POST['report_category']==2)
		       		{
		       			$str_where.= " AND s.case_deal_officer=".$this->db->escape($_POST['report_category_dropdown']);
		        	}
		        
		        }
		        if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		        {
		        	$all = explode(",",$_POST['report_category_dropdown_multi']);
			        if (count($all)>1) //For multiple month
			        {
			            $str_where.=' AND (';
			            for ($i=0; $i < count($all); $i++) 
			            { 
			               if($i==count($all)-1)//For last condition
			               {
			                $str_where.='s.legal_region= '.$all[$i];
			               }
			               else //For others condition
			               {
			                $str_where.='s.legal_region= '.$all[$i].' OR ';
			               }
			            }
			            $str_where.=')';
			        }
			        else //For singel month
			        {
			            $str_where.=' AND s.legal_region= '.$all[0];
			        }
		        }


		        if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		        {
		        	if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
		        	if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			        if( $from_year!='0' && $to_year=='0')
			        { $str_where.= " and YEAR(s.filling_date)=".$this->db->escape($from_year); }
			        
			        if( $from_year!='0' && $to_year!='0')
			        { $str_where.= " and YEAR(s.filling_date) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);}
		        }
		        else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		        {
		        	if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			        else{$filling_dt_from='0';}
			        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			        else{$filling_dt_to='0';}

			        if( $filling_dt_from!='0' && $filling_dt_to=='0')
			        { $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
			        
			        if( $filling_dt_from!='0' && $filling_dt_to!='0')
			        { $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}
		        }

		        $str=" SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
		        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
		        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
		        lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,
		        CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
		        CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
		            FROM suit_filling_info as s
		            LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
		            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
		            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
		            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
		            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
		            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
		            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
		            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
		            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
		            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
		            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
		            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
		            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
		            LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
		            LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
		            LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
		            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
		            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
		            WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) ORDER BY s.id ASC";
		            $query=$this->db->query($str);
		            $result = $query->result();


			        require_once('./application/Classes/PHPExcel.php');
			        $objPHPExcel = new PHPExcel();
			        $objPHPExcel->setActiveSheetIndex(0);
			        $styleArray_border = array(
			            'borders' => array(
			                'allborders' => array(
			                    'style' => PHPExcel_Style_Border::BORDER_THIN
			                )
			            )
			        );

		$headings4 = array(
            'Serial', 'Proposed Type', 'A/C Number', 'Name of Enterprise', '3 Type of Case','Type Of Case', 'Filling Date',
             'Case Number', 'Case Claim Amount', 'Previous Date', 'Case Status On The Previous Date', 'Activities Taken On The Previous Date', 'Next Date', 'Case Status on the Next date', 'Remarks on Case Status on the Previous date', ' Filling Plaintiff', 'Present Plaintiff', 'Case Dealings officer', 'Lawyer Name', ' Previous Name Of The Court', 'Present Name Of The Court', 'District','Territory','Portfolio','Legal Region','Final Status (Running/ Settled)'
        );



        $te = 'A';
        for ($i = 0; $i < count($headings4); $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($te)->setWidth(20);
            $te++;
        }
        $te--;
        $rowNumber = 1;
        $headings1 = array('Waiting For Jari Case Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':' . $te . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);
        $rowNumber++;

        $rowNumber++;

        // echo count($headings4);
        //exit;
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'eee4e3')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 1;
		foreach ($result as $key_serial => $key) {

            $objPHPExcel->getActiveSheet()->fromArray(array(
                		   $key_serial + 1,
                           $key->proposed_type,
		                   $key->loan_ac,
		                   $key->ac_name,
		                   $key->requisition_name,
		                   $key->case_name,
		                   $key->filling_date,
		                   $key->case_number,
		                   $key->case_claim_amount,
		                   $key->prev_date,
		                   $key->case_sts_prev_dt,
		                   $key->act_prev_date,
		                   $key->next_date,
		                   $key->next_date_sts,
		                   $key->remarks_prev_date,
		                   $key->filling_plaintiff,
		                   $key->present_plaintiff,
		                   $key->case_deal_officer,
		                   $key->lawyer_name,
		                   $key->prev_court_name,
		                   $key->prest_court_name,
		                   $key->district,
		                   $key->territory,
		                   $key->loan_segment,
		                   $key->legal_region,
		                   $key->final_remarks,

            ), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('C' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
            $rowNumber++;
        }


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Waiting Jari Case Report');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="Waiting_Jari_Case_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
	 	
	 }

	 public function case_sts_up_rt_xl()
	 {
		$csrf_token=$this->security->get_csrf_hash();
		$str_where = "1";
		if ($_POST['report_type']!='' && isset($_POST['report_type_dropdown']) && $_POST['report_type_dropdown']!='') {
   
			if($_POST['report_type']==3)
			{
				$str_where.= " AND s.legal_region=".$this->db->escape($_POST['report_type_dropdown']);
			}
			else if($_POST['report_type']==4)
			   {
				   $str_where.= " AND s.district=".$this->db->escape($_POST['report_type_dropdown']);
			}
			else if($_POST['report_type']==5)
			   {
				   $str_where.= " AND s.territory=".$this->db->escape($_POST['report_type_dropdown']);
			}
		}

		if($_POST['report_type']!='' && isset($_POST['report_type_dropdown_multi']) && $_POST['report_type_dropdown_multi']!='')
		{
			$all = explode(",",$_POST['report_type_dropdown_multi']);
			if (count($all)>1) //For multiple month
			{
				$str_where.=' AND (';
				for ($i=0; $i < count($all); $i++) 
				{ 
				   if($i==count($all)-1)//For last condition
				   {
					$str_where.='s.legal_region= '.$all[$i];
				   }
				   else //For others condition
				   {
					$str_where.='s.legal_region= '.$all[$i].' OR ';
				   }
				}
				$str_where.=')';
			}
			else //For singel month
			{
				$str_where.=' AND s.legal_region= '.$all[0];
			}
		}


		if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
   
		  if($_POST['report_category']==1)
			   {
				   $str_where.= " AND s.loan_segment=".$this->db->escape($_POST['report_category_dropdown']);
			}
			else if($_POST['report_category']==2)
			   {
				   $str_where.= " AND s.territory=".$this->db->escape($_POST['report_category_dropdown']);
			}
		}
		if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		{
			$all = explode(",",$_POST['report_category_dropdown_multi']);
			if (count($all)>1) //For multiple month
			{
				$str_where.=' AND (';
				for ($i=0; $i < count($all); $i++) 
				{ 
				   if($i==count($all)-1)//For last condition
				   {
					$str_where.='s.legal_region= '.$all[$i];
				   }
				   else //For others condition
				   {
					$str_where.='s.legal_region= '.$all[$i].' OR ';
				   }
				}
				$str_where.=')';
			}
			else //For singel month
			{
				$str_where.=' AND s.legal_region= '.$all[0];
			}
		}


		if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		{
			if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
			if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			if( $from_year!='0' && $to_year=='0')
			{ $str_where.= " and YEAR(s.filling_date)=".$this->db->escape($from_year); }
			
			if( $from_year!='0' && $to_year!='0')
			{ $str_where.= " and YEAR(s.filling_date) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);}
		}
		else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		{
			if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			else{$filling_dt_from='0';}
			if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			else{$filling_dt_to='0';}

			if( $filling_dt_from!='0' && $filling_dt_to=='0')
			{ $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
			
			if( $filling_dt_from!='0' && $filling_dt_to!='0')
			{ $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}
		}

		$str=" SELECT s.id,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
		DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d/%m/%Y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
		DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
		lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,
		CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
		CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
			FROM suit_filling_info as s
			LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
			LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
			LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
			LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
			LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
			LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
			LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.region)
			LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
			LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
			LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
			LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
			LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
			LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
			LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
			LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
			LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
			LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
			LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
			WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) ORDER BY s.id ASC";
			$query=$this->db->query($str);
			$result = $query->result();
			        require_once('./application/Classes/PHPExcel.php');
			        $objPHPExcel = new PHPExcel();
			        $objPHPExcel->setActiveSheetIndex(0);
			        $styleArray_border = array(
			            'borders' => array(
			                'allborders' => array(
			                    'style' => PHPExcel_Style_Border::BORDER_THIN
			                )
			            )
			        );

		$headings4 = array(
            'Serial', 'Proposed Type', 'A/C Number', 'Name of Enterprise', '3 Type of Case','Type Of Case', 'Filling Date',
             'Case Number', 'Case Claim Amount', 'Previous Date', 'Case Status On The Previous Date', 'Activities Taken On The Previous Date', 'Next Date', 'Case Status on the Next date', 'Remarks on Case Status on the Previous date', ' Filling Plaintiff', 'Present Plaintiff', 'Case Dealings officer', 'Lawyer Name', ' Previous Name Of The Court', 'Present Name Of The Court', 'District','Territory','Portfolio','Legal Region','Final Status (Running/ Settled)'
        );



        $te = 'A';
        for ($i = 0; $i < count($headings4); $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($te)->setWidth(20);
            $te++;
        }
        $te--;
        $rowNumber = 1;
        $headings1 = array('Case Status Update Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':' . $te . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);
        $rowNumber++;

        $rowNumber++;

        // echo count($headings4);
        //exit;
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'eee4e3')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 1;
		foreach ($result as $key_serial => $key) {

            $objPHPExcel->getActiveSheet()->fromArray(array(
                		   $key_serial + 1,
                           $key->proposed_type,
		                   $key->loan_ac,
		                   $key->ac_name,
		                   $key->requisition_name,
		                   $key->case_name,
		                   $key->filling_date,
		                   $key->case_number,
		                   $key->case_claim_amount,
		                   $key->prev_date,
		                   $key->case_sts_prev_dt,
		                   $key->act_prev_date,
		                   $key->next_date,
		                   $key->next_date_sts,
		                   $key->remarks_prev_date,
		                   $key->filling_plaintiff,
		                   $key->present_plaintiff,
		                   $key->case_deal_officer,
		                   $key->lawyer_name,
		                   $key->prev_court_name,
		                   $key->prest_court_name,
		                   $key->district,
		                   $key->territory,
		                   $key->loan_segment,
		                   $key->legal_region,
		                   $key->final_remarks,

            ), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('C' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
            $rowNumber++;
        }


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Case Status Report');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="Case_Status_Update_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
	 	
	 }
	 public function first_legal_notice_report_xl()
	 {

		$csrf_token=$this->security->get_csrf_hash();

		 $str_where = "1";

		if ($_POST['report_category_segment']!='' && isset($_POST['report_category_segment_dropdown']) && $_POST['report_category_segment_dropdown']!='') {

			if($_POST['report_category_segment']==1)
			{
				$str_where.= " AND ln.region=".$this->db->escape($_POST['report_category_segment_dropdown']);
			}
			else if($_POST['report_category_segment']==4)
			{
				$str_where.= " AND ln.district=".$this->db->escape($_POST['report_category_segment_dropdown']);
		 	}
		 	else if($_POST['report_category_segment']==6)
			{
				$str_where.= " AND ln.territory=".$this->db->escape($_POST['report_category_segment_dropdown']);
		 }

		}


		if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		{
			if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
			if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			if( $from_year!='0' && $to_year=='0')
			{
			  $str_where.= " and YEAR(ln.e_dt)=".$this->db->escape($from_year); 

			}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){
			  $str_where.= " and YEAR(ln.legal_notice_s_dt)=".$this->db->escape($from_year); 
			}
			
			if( $from_year!='0' && $to_year!='0')
			{ 
				$str_where.= " and YEAR(ln.e_dt) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);

			}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

				$str_where.= " and YEAR(ln.legal_notice_s_dt) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);

			}


		}
		else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		{
			if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			else{$filling_dt_from='0';}
			if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			else{$filling_dt_to='0';}

			if( $filling_dt_from!='0' && $filling_dt_to=='0')
			{
				 $str_where.= " and ln.e_dt=".$this->db->escape($filling_dt_from);

			}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

				$str_where.= " and ln.legal_notice_s_dt=".$this->db->escape($filling_dt_from);
			}
			if( $filling_dt_from!='0' && $filling_dt_to!='0')
			{ 
				$str_where.= " and ln.e_dt between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);

			}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

				$str_where.= " and ln.e_dt legal_notice_s_dt ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);

			}
		}


		$query_submit=" SELECT 	ln.proposed_type,ln.loan_ac,ln.cif,ln.ac_name,bs.name as branch_sol,st.name as sub_type,ln.spouse_name,ln.mother_name,lss.name as loan_segment,ln.current_address,r.name as region_name,t.name as territory,law.name as lawyer,uo.name as unit_office,d.name as district
		FROM legal_notice as ln
		LEFT OUTER JOIN ref_region r ON (r.id=ln.region)
		LEFT OUTER JOIN ref_subject_type st ON (st.id=ln.sub_type)
		LEFT OUTER JOIN ref_territory t ON (t.id=ln.territory)
		LEFT OUTER JOIN ref_district d ON (d.id=ln.district)
		LEFT OUTER JOIN ref_branch_sol bs ON (bs.id=ln.branch_sol)
		LEFT OUTER JOIN ref_unit_office uo ON (uo.id=ln.unit_office)
		LEFT OUTER JOIN ref_lawyer law ON (law.id=ln.lawyer)
		LEFT OUTER JOIN ref_loan_segment lss ON (lss.id=ln.loan_segment)
		WHERE $str_where AND ln.sts=1  ORDER BY ln.id ASC";
		$query_data = $this->db->query($query_submit);
		$result = $query_data->result();

			        require_once('./application/Classes/PHPExcel.php');
			        $objPHPExcel = new PHPExcel();
			        $objPHPExcel->setActiveSheetIndex(0);
			        $styleArray_border = array(
			            'borders' => array(
			                'allborders' => array(
			                    'style' => PHPExcel_Style_Border::BORDER_THIN
			                )
			            )
			        );

		$headings4 = array(
           'Proposed Type', 'A/C Number', 'CIF', 'Loan A/C Name','Business Type', 'Spouse Name ',
             'Mother Name', 'Loan Segment (Portfolio)', 'Region', 'Branch', 'District', 'Territory', 'Unit Office', 'Lawyer Name',
        );



        $te = 'A';
        for ($i = 0; $i < count($headings4); $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($te)->setWidth(20);
            $te++;
        }
        $te--;
        $rowNumber = 1;
        $headings1 = array('1st Legal Notice Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':' . $te . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);
        $rowNumber++;

        $rowNumber++;

        // echo count($headings4);
        //exit;
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'eee4e3')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 1;
		foreach ($result as $key_serial => $key) {

            $objPHPExcel->getActiveSheet()->fromArray(array(
                           $key->proposed_type,
		                   $key->loan_ac,
		                   $key->cif,
		                   $key->ac_name,
		                   $key->sub_type,
		                   $key->spouse_name,
		                   $key->mother_name,
		                   $key->loan_segment,
		                   $key->region_name,
		                   $key->branch_sol,
		                   $key->district,
		                   $key->territory,
		                   $key->unit_office,
		                   $key->lawyer,


            ), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('B' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
            $rowNumber++;
        }


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('1st Legal Notice');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="1st_Legal_Notice.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();
	 	
	 }


	//  cma_apv__decline_xl

	public function cma_apv__decline_xl()
	{

		$csrf_token=$this->security->get_csrf_hash();
		$str_where = "1";

		if ($_POST['report_category_segment']!='' && isset($_POST['report_category_segment_dropdown']) && $_POST['report_category_segment_dropdown']!='') {
			if($_POST['report_category_segment']==1)
			{
				$str_where.= " AND j0.legal_region=".$this->db->escape($_POST['report_category_segment_dropdown']);
			}
			else if($_POST['report_category_segment']==3)
			   {
				   $str_where.= " AND j0.loan_segment=".$this->db->escape($_POST['report_category_segment_dropdown']);
			}
			else if($_POST['report_category_segment']==4)
			   {
				   $str_where.= " AND j0.case_deal_officer=".$this->db->escape($_POST['report_category_segment_dropdown']);
			}
			else if($_POST['report_category_segment']==5)
			   {
				   $str_where.= " AND j0.district=".$this->db->escape($_POST['report_category_segment_dropdown']);
			}
			else if($_POST['report_category_segment']==6)
			   {
				   $str_where.= " AND j0.territory=".$this->db->escape($_POST['report_category_segment_dropdown']);
			}
		}
		if($_POST['report_category_segment']!='' && isset($_POST['report_category_segment_dropdown_multi']) && $_POST['report_category_segment_dropdown_multi']!='')
		{
			$all = explode(",",$_POST['report_category_segment_dropdown_multi']);
			if (count($all)>1) //For multiple month
			{
				$str_where.=' AND (';
				for ($i=0; $i < count($all); $i++) 
				{ 
				   if($i==count($all)-1)//For last condition
				   {
					$str_where.='j0.legal_region= '.$all[$i];
				   }
				   else //For others condition
				   {
					$str_where.='j0.legal_region= '.$all[$i].' OR ';
				   }
				}
				$str_where.=')';
			}
			else //For singel month
			{
				$str_where.=' AND j0.legal_region= '.$all[0];
			}
		}


		// Report Catagory


		if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
			if($_POST['report_category_segment']==2)
			{
				$str_where.= " AND j0.case_deal_officer=".$this->db->escape($_POST['report_category_dropdown']);
		 }
		}

		if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		{
			$all = explode(",",$_POST['report_category_dropdown_multi']);
			if (count($all)>1) //For multiple month
			{
				$str_where.=' AND (';
				for ($i=0; $i < count($all); $i++) 
				{ 
				   if($i==count($all)-1)//For last condition
				   {
					$str_where.='j0.legal_region= '.$all[$i];
				   }
				   else //For others condition
				   {
					$str_where.='j0.legal_region= '.$all[$i].' OR ';
				   }
				}
				$str_where.=')';
			}
			else //For singel month
			{
				$str_where.=' AND j0.legal_region= '.$all[0];
			}
		}

		// Report Catagory

		if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		{
			if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
			if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			if( $from_year!='0' && $to_year=='0')
			{ 
				$str_where.= " and YEAR(j0.e_dt)=".$this->db->escape($from_year);

			 }

			//  Search Data New Logic
			else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){
				$str_where.= " and j0.cma_sts IN(60,104)"; 
				$str_where.= " and YEAR(j0.deliver_dt)=".$this->db->escape($from_year); 
			}
			else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
				$str_where.= " and j0.cma_sts IN(5,12,91)"; 
			}
			//  Search Data New Logic


			
			if( $from_year!='0' && $to_year!='0')
			{ 
				$str_where.= " and YEAR(j0.e_dt) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);
			
			}
			//  Search Data New Logic

			else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){
				$str_where.= " and j0.cma_sts IN(60,104)"; 
				$str_where.= " and YEAR(j0.deliver_dt) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);
			}
			else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
				$str_where.= " and j0.cma_sts IN(5,12,91)"; 
			}
			//  Search Data New Logic


		}
		else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		{
			if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			else{$filling_dt_from='0';}
			if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			else{$filling_dt_to='0';}

			if( $filling_dt_from!='0' && $filling_dt_to=='0')
			{
				 $str_where.= " and j0.e_dt=".$this->db->escape($filling_dt_from);

			}
			
			//  Search Data New Logic

			else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){
				$str_where.= " and j0.cma_sts IN(60,104)"; 
				$str_where.= " and j0.deliver_dt=".$this->db->escape($filling_dt_from);
			}
			else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
				$str_where.= " and j0.cma_sts IN(5,12,91)"; 
			}
			
			//  Search Data New Logic



			if( $filling_dt_from!='0' && $filling_dt_to!='0')
			{
				$str_where.= " and j0.e_dt between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);
			}
			
			//  Search Data New Logic

			else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){
				$str_where.= " and j0.cma_sts IN(60,104)"; 
				$str_where.= " and j0.deliver_dt between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);
			}
			else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
				$str_where.= " and j0.cma_sts IN(5,12,91)"; 
			}
			//  Search Data New Logic




		}


		   $str="SELECT
		   j0.sl_no,
		   j2.name as territory_name,
		   j3.name as req_type,
		   j4.name as district,
		   j0.proposed_type,
		   j0.cif,
		   j0.loan_ac,
		   j0.more_acc_number,
		   j5.name as unit_office_name,
		   DATE_FORMAT(j0.loan_sanction_dt,'%d-%b-%y %h:%i %p') AS loan_sanction_dt,
		   j6.name as branch_sol,
		   j0.ac_name,
		   j7.name as pre_case_type,
		   j8.name as sub_type,
		   j0.mother_name,
		   j9.name as loan_segment,
		   j10.name as region,
		   j0.last_payment_amount,
		   j11.name as case_fill_dist,
		   j0.st_belance,
		   j0.current_dpd,
		   j12.name as legal_region,
		   j13.name as borr_sts
		   FROM cma as j0
		   LEFT OUTER JOIN ref_territory j2 ON (j2.id=j0.territory)
		   LEFT OUTER JOIN ref_req_type j3 ON (j3.id=j0.req_type)
		   LEFT OUTER JOIN ref_district j4 ON (j4.id=j0.district)
		   LEFT OUTER JOIN ref_unit_office j5 ON (j5.id=j0.unit_office)
		   LEFT OUTER JOIN ref_branch_sol j6 ON (j6.code=j0.branch_sol)
		   LEFT OUTER JOIN ref_req_type j7 ON (j7.id=j0.pre_case_type)
		   LEFT OUTER JOIN ref_subject_type j8 ON (j8.id=j0.sub_type)
		   LEFT OUTER JOIN ref_loan_segment j9 ON (j9.code=j0.loan_segment)
		   LEFT OUTER JOIN ref_region j10 ON (j10.id=j0.region)
		   LEFT OUTER JOIN ref_legal_district j11 ON (j11.id=j0.case_fill_dist)
		   LEFT OUTER JOIN ref_legal_region j12 ON (j12.id=j0.legal_region)
		   LEFT OUTER JOIN ref_borr_sts j13 ON (j13.id=j0.borr_sts)
		   WHERE $str_where AND j0.sts=1  ORDER BY j0.id ASC";
		   $query=$this->db->query($str);
		   $result = $query->result();

			        require_once('./application/Classes/PHPExcel.php');
			        $objPHPExcel = new PHPExcel();
			        $objPHPExcel->setActiveSheetIndex(0);
			        $styleArray_border = array(
			            'borders' => array(
			                'allborders' => array(
			                    'style' => PHPExcel_Style_Border::BORDER_THIN
			                )
			            )
			        );

		$headings4 = array(
           'SL No',
           'Territory',
           'Requisition Type',
           'District',
           'Proposed Type',
           'Unit Office<',
           'Loan A/C No',
           'More A/C No',
           'CIF',
           'Loan Sanction Date',
           'Branch SOL',
           'Loan A/C Name',
           'Previous Case Type',
           'Business Type',
           'Mother Name',
           'Loan Segment (Portfolio) ',
           'Region',
           'Last Payment Amount',
           'Case File District',
           'Case Claim Amount',
           'Current DPD ',
           'Legal Region',
           'Borrower Status',
        );



        $te = 'A';
        for ($i = 0; $i < count($headings4); $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($te)->setWidth(20);
            $te++;
        }
        $te--;
        $rowNumber = 1;
        $headings1 = array('CMA Approved & Decline Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':' . $te . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);
        $rowNumber++;

        $rowNumber++;

        // echo count($headings4);
        //exit;
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'eee4e3')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 1;
		foreach ($result as $key_serial => $key) {

            $objPHPExcel->getActiveSheet()->fromArray(array(
                           $key->sl_no,
                           $key->territory_name,
                           $key->req_type,
                           $key->district,
                           $key->proposed_type,
                           $key->unit_office_name,
                           $key->loan_ac,
                           $key->more_acc_number,
                           $key->cif,
                           $key->loan_sanction_dt,
                           $key->branch_sol,
                           $key->ac_name,
                           $key->pre_case_type,
                           $key->sub_type,
                           $key->mother_name,
                           $key->loan_segment,
                           $key->region,
                           $key->last_payment_amount,
                           $key->case_fill_dist,
                           $key->st_belance,
                           $key->current_dpd,
                           $key->legal_region,
                           $key->borr_sts,
                    
            ), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('B' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);

            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('G' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
            $rowNumber++;
        }


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('CMA Approved Decline');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="CMA_Approved_Decline_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();



		
	}



	public function deliver_rt_xl()
	{

		$csrf_token=$this->security->get_csrf_hash();
		$str_where = "1";

		if ($_POST['report_category_segment']!='' && isset($_POST['report_category_segment_dropdown']) && $_POST['report_category_segment_dropdown']!='') {
			if($_POST['report_category_segment']==1)
			{
				$str_where.= " AND j0.legal_region=".$this->db->escape($_POST['report_category_segment_dropdown']);
			}
			else if($_POST['report_category_segment']==3)
			   {
				   $str_where.= " AND j0.loan_segment=".$this->db->escape($_POST['report_category_segment_dropdown']);
			}
			else if($_POST['report_category_segment']==4)
			   {
				   $str_where.= " AND j0.case_deal_officer=".$this->db->escape($_POST['report_category_segment_dropdown']);
			}
			else if($_POST['report_category_segment']==5)
			   {
				   $str_where.= " AND j0.district=".$this->db->escape($_POST['report_category_segment_dropdown']);
			}
			else if($_POST['report_category_segment']==6)
			   {
				   $str_where.= " AND j0.territory=".$this->db->escape($_POST['report_category_segment_dropdown']);
			}
		}
		if($_POST['report_category_segment']!='' && isset($_POST['report_category_segment_dropdown_multi']) && $_POST['report_category_segment_dropdown_multi']!='')
		{
			$all = explode(",",$_POST['report_category_segment_dropdown_multi']);
			if (count($all)>1) //For multiple month
			{
				$str_where.=' AND (';
				for ($i=0; $i < count($all); $i++) 
				{ 
				   if($i==count($all)-1)//For last condition
				   {
					$str_where.='j0.legal_region= '.$all[$i];
				   }
				   else //For others condition
				   {
					$str_where.='j0.legal_region= '.$all[$i].' OR ';
				   }
				}
				$str_where.=')';
			}
			else //For singel month
			{
				$str_where.=' AND j0.legal_region= '.$all[0];
			}
		}


		// Report Catagory


		if ($_POST['report_category']!='' && isset($_POST['report_category_dropdown']) && $_POST['report_category_dropdown']!='') {
			if($_POST['report_category_segment']==2)
			{
				$str_where.= " AND j0.case_deal_officer=".$this->db->escape($_POST['report_category_dropdown']);
		 }
		}

		if($_POST['report_category']!='' && isset($_POST['report_category_dropdown_multi']) && $_POST['report_category_dropdown_multi']!='')
		{
			$all = explode(",",$_POST['report_category_dropdown_multi']);
			if (count($all)>1) //For multiple month
			{
				$str_where.=' AND (';
				for ($i=0; $i < count($all); $i++) 
				{ 
				   if($i==count($all)-1)//For last condition
				   {
					$str_where.='j0.legal_region= '.$all[$i];
				   }
				   else //For others condition
				   {
					$str_where.='j0.legal_region= '.$all[$i].' OR ';
				   }
				}
				$str_where.=')';
			}
			else //For singel month
			{
				$str_where.=' AND j0.legal_region= '.$all[0];
			}
		}

		// Report Catagory

		if($_POST['reporting_time']!='' && isset($_POST['reporting_time']) && $_POST['reporting_time']==2)
		{
			if($this->input->post("from_year") != '' && $this->input->post("from_year") != 0){$from_year= $this->input->post("from_year");} else{$from_year = '0';}
			if($this->input->post("to_year") != '' && $this->input->post("to_year") != 0){$to_year= $this->input->post("to_year");} else{$to_year = '0';}

			if( $from_year!='0' && $to_year=='0')
			{ 
				$str_where.= " and YEAR(j0.e_dt)=".$this->db->escape($from_year);

			 }

			//  Search Data New Logic
			else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

				$str_where.= " and j0.cma_sts IN(60,104)"; 
			}
			else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){

				$str_where.= " and j0.cma_sts IN(59)"; 

			}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==3){

				$str_where.= " and j0.cma_sts > 59"; 

			}
			//  Search Data New Logic


			
			if( $from_year!='0' && $to_year!='0')
			{ 
				$str_where.= " and YEAR(j0.e_dt) between ".$this->db->escape($from_year)." and ".$this->db->escape($to_year);
			
			}
				//  Search Data New Logic
			else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

				$str_where.= " and j0.cma_sts IN(60,104)"; 
			}
			else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
				
				$str_where.= " and j0.cma_sts IN(59)"; 

			}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==3){

				$str_where.= " and j0.cma_sts > 59"; 

			}
			//  Search Data New Logic

		}
		else if($_POST['reporting_time']!=''  && isset($_POST['reporting_time']) && $_POST['reporting_time']==1)
		{
			if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
			if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
			if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
			else{$filling_dt_from='0';}
			if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
			else{$filling_dt_to='0';}

			if( $filling_dt_from!='0' && $filling_dt_to=='0')
			{
				 $str_where.= " and j0.e_dt=".$this->db->escape($filling_dt_from);

			}
			
				//  Search Data New Logic
				else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

					$str_where.= " and j0.cma_sts IN(60,104)"; 
				}
				else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
					
					$str_where.= " and j0.cma_sts IN(59)"; 

				}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==3){

					$str_where.= " and j0.cma_sts > 59"; 

				}
				//  Search Data New Logic

			if( $filling_dt_from!='0' && $filling_dt_to!='0')
			{
				$str_where.= " and j0.e_dt between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);
			}
			
				//  Search Data New Logic
				else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==1){

					$str_where.= " and j0.cma_sts IN(60,104)"; 
				}
				else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==2){
					
					$str_where.= " and j0.cma_sts IN(59)"; 

				}else if($_POST['present_status']!='' && isset($_POST['present_status']) && $_POST['present_status']==3){

					$str_where.= " and j0.cma_sts < 59"; 

				}
				//  Search Data New Logic
		}


		   $str="SELECT
		   j0.sl_no,
		   j2.name as territory_name,
		   j3.name as req_type,
		   j4.name as district,
		   j0.proposed_type,
		   j0.cif,
		   j0.loan_ac,
		   j0.more_acc_number,
		   j5.name as unit_office_name,
		   DATE_FORMAT(j0.loan_sanction_dt,'%d-%b-%y %h:%i %p') AS loan_sanction_dt,
		   j6.name as branch_sol,
		   j0.ac_name,
		   j7.name as pre_case_type,
		   j8.name as sub_type,
		   j0.mother_name,
		   j9.name as loan_segment,
		   j10.name as region,
		   j0.last_payment_amount,
		   j11.name as case_fill_dist,
		   j0.st_belance,
		   j0.current_dpd,
		   j12.name as legal_region,
		   j13.name as borr_sts
		   FROM cma as j0
		   LEFT OUTER JOIN ref_territory j2 ON (j2.id=j0.territory)
		   LEFT OUTER JOIN ref_req_type j3 ON (j3.id=j0.req_type)
		   LEFT OUTER JOIN ref_district j4 ON (j4.id=j0.district)
		   LEFT OUTER JOIN ref_unit_office j5 ON (j5.id=j0.unit_office)
		   LEFT OUTER JOIN ref_branch_sol j6 ON (j6.code=j0.branch_sol)
		   LEFT OUTER JOIN ref_req_type j7 ON (j7.id=j0.pre_case_type)
		   LEFT OUTER JOIN ref_subject_type j8 ON (j8.id=j0.sub_type)
		   LEFT OUTER JOIN ref_loan_segment j9 ON (j9.code=j0.loan_segment)
		   LEFT OUTER JOIN ref_region j10 ON (j10.id=j0.region)
		   LEFT OUTER JOIN ref_legal_district j11 ON (j11.id=j0.case_fill_dist)
		   LEFT OUTER JOIN ref_legal_region j12 ON (j12.id=j0.legal_region)
		   LEFT OUTER JOIN ref_borr_sts j13 ON (j13.id=j0.borr_sts)


			WHERE $str_where AND j0.sts=1  ORDER BY j0.id ASC";
			$query=$this->db->query($str);
			$result = $query->result();


			        require_once('./application/Classes/PHPExcel.php');
			        $objPHPExcel = new PHPExcel();
			        $objPHPExcel->setActiveSheetIndex(0);
			        $styleArray_border = array(
			            'borders' => array(
			                'allborders' => array(
			                    'style' => PHPExcel_Style_Border::BORDER_THIN
			                )
			            )
			        );

		$headings4 = array(
           'SL No',
           'Territory',
           'Requisition Type',
           'District',
           'Proposed Type',
           'Unit Office<',
           'Loan A/C No',
           'More A/C No',
           'CIF',
           'Loan Sanction Date',
           'Branch SOL',
           'Loan A/C Name',
           'Previous Case Type',
           'Business Type',
           'Mother Name',
           'Loan Segment (Portfolio) ',
           'Region',
           'Last Payment Amount',
           'Case File District',
           'Case Claim Amount',
           'Current DPD ',
           'Legal Region',
           'Borrower Status',
        );



        $te = 'A';
        for ($i = 0; $i < count($headings4); $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($te)->setWidth(20);
            $te++;
        }
        $te--;
        $rowNumber = 1;
        $headings1 = array('File & Cheque Delivered Report');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowNumber . ':' . $te . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber)->getFont()->setBold(true);
        $rowNumber++;

        $rowNumber++;

        // echo count($headings4);
        //exit;
        $objPHPExcel->getActiveSheet()->fromArray(array($headings4), NULL, 'A' . $rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':A' . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'eee4e3')));
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
        $rowNumber++;
        $sl = 1;
		foreach ($result as $key_serial => $key) {

            $objPHPExcel->getActiveSheet()->fromArray(array(
                           $key->sl_no,
                           $key->territory_name,
                           $key->req_type,
                           $key->district,
                           $key->proposed_type,
                           $key->unit_office_name,
                           $key->loan_ac,
                           $key->more_acc_number,
                           $key->cif,
                           $key->loan_sanction_dt,
                           $key->branch_sol,
                           $key->ac_name,
                           $key->pre_case_type,
                           $key->sub_type,
                           $key->mother_name,
                           $key->loan_segment,
                           $key->region,
                           $key->last_payment_amount,
                           $key->case_fill_dist,
                           $key->st_belance,
                           $key->current_dpd,
                           $key->legal_region,
                           $key->borr_sts,
                    
            ), NULL, 'A' . $rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowNumber . ':' . $te . $rowNumber)->applyFromArray($styleArray_border);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('B' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);

            $objPHPExcel->getActiveSheet()->setCellValueExplicit(('G' . $rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
            $rowNumber++;
        }


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('File Cheque Delivered');
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); //Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="File_Cheque_Delivered_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        $objWriter->save('php://output');
        exit();



		
	}


}