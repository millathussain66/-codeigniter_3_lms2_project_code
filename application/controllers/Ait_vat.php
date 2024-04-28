<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ait_vat extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Ait_vat_model', '', TRUE);
	}
	function test2()
	{
		$str="SELECT  j0.id,j0.ln_serial,j0.proposed_type
	                     FROM legal_notice j0
	                     WHERE j0.ln_serial IS NOT NULL AND j0.ln_serial<>''";
	    $application_data=$this->db->query($str)->result();
	    $data=array();
	    foreach($application_data as $key)
	    {
	    	$main_serial = (explode("-",$key->ln_serial));
	    	$init = $main_serial[0];
	    	$limit = $main_serial[1];
	    	$counter = $limit-$init;
	    	$str="SELECT  j0.*
	                     FROM legal_notice_guarantor j0
	                     WHERE j0.legal_notice_id='".$key->id."' order by case when j0.guarantor_type = 'M' then 1 else 2 end ";
	    	$application_data2=$this->db->query($str)->result();
	 		$counter = $init-1;
	    	foreach ($application_data2 as $key2) 
	    	{
	    		if(ltrim($key2->present_address)!='' && !empty($key2->present_address)){
						$counter++;
						$array = array(
							'guarantor_id'=>$key2->id,
							'ln_id'=>$key->id,
				            'br_counter'=>$counter,
				            'adress_field'=>'present address',
				            'adress'=>$key2->present_address
				            );
						 array_push($data,$array);
					}
					if(ltrim($key2->permanent_address)!='' && !empty($key2->permanent_address)){
						$counter++;
						$array = array(
							'guarantor_id'=>$key2->id,
							'ln_id'=>$key->id,
				            'br_counter'=>$counter,
				            'adress_field'=>'parmanent address',
				            'adress'=>$key2->permanent_address
				            );
						 array_push($data,$array);
					}
					if(ltrim($key2->business_address)!='' && !empty($key2->business_address)){
						$counter++;
						$array = array(
							'guarantor_id'=>$key2->id,
							'ln_id'=>$key->id,
				            'br_counter'=>$counter,
				            'adress_field'=>'business address',
				            'adress'=>$key2->business_address
				            );
						 array_push($data,$array);
					}
	    	}
	    }
	    // echo "<pre>";
	    // print_r($data);
	    // echo "</pre>";
	    // exit;
	    $this->db->insert_batch('ln_address_by_br_serial', $data);
	}
	function test3()
	{
		$str="SELECT  j0.*
                     FROM cost_details j0
                 WHERE j0.main_table_name='hc_matter_ad' OR j0.main_table_name='hc_matter_hst' OR j0.main_table_name='hc_matter'";
        $application_data=$this->db->query($str)->result();
        //$final_data = array();
        if(!empty($application_data))
        {
            foreach ($application_data as $key) {
                if($key->proposed_type=='Loan' && $key->loan_ac!='' && $key->loan_ac!=NULL)
				{
					if(strlen($key->loan_ac)==16)
					{
						$cif = substr($key->loan_ac,5,8);
					}
					else if(strlen($key->loan_ac)==13)
					{
						$cif = substr($key->loan_ac,1,8);
					}
					else
					{
						$cif = "";
					}
				}
				else
				{
					$cif = "";
				}

				$bill_data = array('cif' => $cif);
	            $this->db->where('id', $key->id);
	            $this->db->update('cost_details', $bill_data);

            }
        }
	}
	function test4()
	{
		$str2 = "SELECT * FROM bill_summery b where b.sts<>0";
		$bill_details=$this->db->query($str2)->result();
		foreach($bill_details as $key)
		{
			$str="SELECT GROUP_CONCAT(CONCAT(DATE_FORMAT(sub.txrn_dt,'%M'),'\'',DATE_FORMAT(sub.txrn_dt,'%y')) ORDER BY  sub.txrn_dt ASC SEPARATOR '+') AS date_f 
                FROM (
                SELECT bill_id,txrn_dt  
                FROM cost_details WHERE bill_id='".$key->id."' GROUP BY MONTH(txrn_dt))sub GROUP BY sub.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $bill_month = "";
            if(!empty($result))
            {
                $bill_month = $result->date_f;
            }
            $bill_data = array('bill_months' => $bill_month);
            $this->db->where('id', $key->id);
            $this->db->update('bill_summery', $bill_data);
		}
		echo "success";
	}
	function test5()
	{
		$str2 = "SELECT * FROM bill_summery b where b.sts<>0";
		$bill_details=$this->db->query($str2)->result();
		foreach($bill_details as $key)
		{
			$str="SELECT 
			  GROUP_CONCAT(
			    sub2.account_counter 
			    ORDER BY sub2.loan_segment ASC SEPARATOR '###'
			  ) AS account_counter,
			  GROUP_CONCAT(
			    sub2.amount 
			    ORDER BY sub2.loan_segment ASC SEPARATOR '###'
			  ) AS amount,
			  GROUP_CONCAT(
			    sub2.discount_amount 
			    ORDER BY sub2.loan_segment ASC SEPARATOR '###'
			  ) AS discount_amount 
			FROM
			  (SELECT 
			    CONCAT(
		      sub.loan_segment,
		      '_',
		      SUM(sub.account_counter)
		    ) AS 'account_counter',
		    sub.loan_segment,
		    CONCAT(
		      sub.loan_segment,
		      '_',
		      SUM(sub.amount)
		    ) AS 'amount',
		    CONCAT(
		      sub.loan_segment,
		      '_',
		      SUM(sub.discount_amount)
		    ) AS 'discount_amount',
		    sub.bill_id 
		  FROM
		    (SELECT 
		      bill_id,
		      txrn_dt,
		      amount,
		      discount_amount,
		      '1' AS account_counter,
		      loan_segment 
		    FROM
		      cost_details 
		    WHERE bill_id = '".$key->id."' 
		    ) sub GROUP BY sub.loan_segment) sub2 GROUP BY sub2.bill_id";
            $query=$this->db->query($str);
            $result =  $query->row();
            $protfolio_wise_discount = "";
            $protfolio_wise_account = "";
            $protfolio_wise_amount = "";
            if(!empty($result))
            {
                $protfolio_wise_discount = $result->discount_amount;
                $protfolio_wise_account = $result->account_counter;
                $protfolio_wise_amount = $result->amount;
            }
            $bill_data = array('protfolio_wise_discount' => $protfolio_wise_discount,
        	'protfolio_wise_account' => $protfolio_wise_account,
        	'protfolio_wise_amount' => $protfolio_wise_amount);
            $this->db->where('id', $key->id);
            $this->db->update('bill_summery', $bill_data);
		}
		echo "success";
	}
	function view ($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{	
		$vendor=$lawyer=array();
		if(check_group(1)){
			$vendor=$this->User_model->get_parameter_data('ref_paper_vendor','name','data_status= 1 AND region IN('.$this->session->userdata['ast_user']['legal_region'].')');
			$lawyer=$this->User_model->get_parameter_data('ref_lawyer','name','data_status= 1 AND region IN('.$this->session->userdata['ast_user']['legal_region'].')');
		}
		if(check_group(2)){
			$vendor=$this->User_model->get_parameter_data('ref_paper_vendor','name','data_status= 1 AND region IN('.$this->session->userdata['ast_user']['legal_region'].') AND district IN ('.$this->session->userdata['ast_user']['legal_district'].')');
			$lawyer=$this->User_model->get_parameter_data('ref_lawyer','name','data_status= 1 AND region IN('.$this->session->userdata['ast_user']['legal_region'].') AND district IN ('.$this->session->userdata['ast_user']['legal_district'].')');
		}
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'vendor'=>$vendor,
					'lawyer'=>$lawyer,
					'certificate_type'=>$this->User_model->get_parameter_data('ref_certificate_type','name','data_status = 1'),
					'request_from'=>$this->User_model->get_parameter_data('ref_expense_type','name','data_status = 1 AND id IN (1,2)'),
					'pages'=> 'ait_vat/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}

	function grid()
	{
		$this->load->model('Ait_vat_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Ait_vat_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function from($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$this->load->model('Ait_vat_model', '', TRUE);
		$result = $this->Ait_vat_model->get_info($id);
		$data = array(
					 'option' => '',
					 'add_edit' => $add_edit,
					 'result' => $result,
					 'id' => $id,
					 'vendor'=>$this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
					 'lawyer'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
					 'certificate_type'=>$this->User_model->get_parameter_data('ref_certificate_type','name','data_status = 1'),
					 'request_from'=>$this->User_model->get_parameter_data('ref_expense_type','name','data_status = 1'),
					 'pages'=> 'ait_vat/pages/form',
					 'editrow' => $editrow
					 );
		$this->load->view('ait_vat/form_layout',$data);

	}
	
	function get_edit_info()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$row_info =$this->Ait_vat_model->get_info($id);
		if (!empty($row_info)) {
			$Message='ok';
		}
		else{
			$Message='No Data';
		}
		
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row_info;
		$var['Message']=$Message;
		
		echo json_encode($var);
	}
	function add_edit_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$add_edit = $_POST['add_edit'];
		$edit_id = $_POST['edit_id'];
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Ait_vat_model->add_edit_action($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";
		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Ait_vat_model->get_add_action_data($id);
		}else{
			for($i=0; $i<count($text); $i++)
			{
				if($i>0){$Message.=',';}
				$Message.=$text[$i];				
			}	
			$row[]='';	
		}
		$var['csrf_token']=$csrf_token;
		$var['Message']=$Message;
		$var['row_info']=$row;
		$var['id']=$id;
		echo json_encode($var);
	}

	function delete_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Ait_vat_model->delete_action();
		}
		else{
			$text[]="Session out, login required";
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			if($this->input->post("type")=='delete'){$row[]='';	}
			else{$row=$this->Ait_vat_model->get_add_action_data($id);}
		}else{
			for($i=0; $i<count($text); $i++)
			{
				if($i>0){$Message.=',';}
				$Message.=$text[$i];				
			}	
			$row[]='';	
		}
		$var['csrf_token']=$csrf_token;
		$var['Message']=$Message;
		$var['row_info']=$row;
		$var['id']=$id;
		echo json_encode($var);
	}

	function details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$preview="";
		if ($this->input->post('id') != ""){
			$details=$this->Ait_vat_model->details($this->input->post('id'));
			$preview = $this->preview($details);
    	}
    	$var = array(
			"str" => $preview,
			"csrf_token" => $csrf_token
		);
		echo json_encode($var);
	}
	function verify() {
        $result=1;
        $jTableResult = array();
        if ($result == 1) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $result;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }
    function history(){
    	$csrf_token=$this->security->get_csrf_hash();
		if ($this->input->post('id') != ""){
			$details=$this->Ait_vat_model->history($this->input->post('id'));
			$html = '';
			foreach($details as $key=>$val){
				$html.='<tr>
						<td>'.$val->status_name.'</td>
						<td>'.$val->user_name.' ('.$val->operate_user_id.')</td>
						<td>'.$val->activities_datetime.'</td>
						<td>'.$val->description_activities.'</td>
						<td>'.$val->oprs_reason.'</td>
					</tr>';
			}
			echo $html."####".$csrf_token;
		}
    }
    function preview($details){
    	$str='';
    	$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>Certificate Type:</strong> '.$details->certificate_name.'</td>
						<td width="50%" align="left"><strong>Request Date:</strong> '.$details->e_dt.'</td>
						
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Request Type:</strong> '.$details->request_name.'</td>
						<td width="50%" align="left"><strong>Inform To Finance:</strong> '.$details->send_fi_dt.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Name:</strong> '.$details->venlaw_name.'</td>
						<td width="50%" align="left"><strong>Certificate Received:</strong> '.$details->receive_head_dt.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Tin Number:</strong> '.$details->tin_number.'</td>
						<td width="50%" align="left"><strong>Bin Number:</strong> '.$details->bin_number.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Date From:</strong> '.$details->date_from.'</td>
						<td width="50%" align="left"><strong>Date To:</strong> '.$details->date_to.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Email:</strong> '.$details->email.'</td>
						<td width="50%" align="left"><strong>Phone Number:</strong> '.$details->phone_number.'</td>
						
					</tr>
					
					<tr>
						<td width="50%" align="left"><strong>Current Status:</strong> '.$details->status_name.'</td>
						<td width="50%" align="left"><strong>Remarks:</strong> '.$details->remarks.'</td>
						
					</tr>
					<tr>

						<td width="50%" align="left"><strong>Application File:</strong> <img id="file_preview_wa_scan_copy" onclick="popup(\''.base_url().'cma_file/bill_ait_vat/'.$details->app_file.'\')" style=" cursor:pointer;text-align:center" src="'.base_url().'old_assets/images/print-preview.png" height="18"></td>
						<td width="50%" align="left"></td>
					</tr>
					';
			$str.='</tbody>
				</table>';
				return $str;
    }

    function clear_file(){
    	$this->Common_model->delete_tempfile();
    }


}
?>
