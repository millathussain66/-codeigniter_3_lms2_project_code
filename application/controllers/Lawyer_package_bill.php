<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lawyer_package_bill extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Lawyer_package_bill_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat)
	{
		$link_id=172;
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'lawyer_package_bill/pages/grid',
					'checker_info' => $this->User_info_model->get_checker_data($link_id,'3,4,12,13,14,15'),
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}

	function grid()
	{
		$this->load->model('Lawyer_package_bill_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Lawyer_package_bill_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function search_grid(){
		$result=$this->Lawyer_package_bill_model->get_grid_data(0, '', '', 200, 0);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function from($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$this->Common_model->delete_tempfile();
		$this->load->model('Lawyer_package_bill_model', '', TRUE);
		$result = $this->Lawyer_package_bill_model->get_info($add_edit,$id);
		
		$data = array(
					 'option' => '',
					 'add_edit' => $add_edit,
					 'result' => $result,
					 'id' => $id,
					 'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					 'loan_segment'=>$this->User_model->get_parameter_data('ref_loan_segment','name','data_status = 1'),
					 'lawyer'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
					 'package_type'=>$this->User_model->get_parameter_data('ref_package_type','name','data_status = 1'),
					 'pages'=> 'lawyer_package_bill/pages/form',
					 'editrow' => $editrow
					 );
		$this->load->view('lawyer_package_bill/form_layout',$data);
	}
	function formverify($id=NULL,$editrow=NULL)
	{
		//echo $id;exit;
		$result = $this->Lawyer_package_bill_model->get_recommend_info($id);
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'id' => $id,
				   'pages'=> 'lawyer_package_bill/pages/form_verify',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('user_info/form_layout',$data);
	}
	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Lawyer_package_bill_model->add_edit_action($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";
		}

		$Message='';
		if ($id!='00') {
			if(count($text)<=0){
			$Message='OK';
			$row=$this->Lawyer_package_bill_model->get_recommend_info($id);
			}else{
				for($i=0; $i<count($text); $i++)
				{
					if($i>0){$Message.=',';}
					$Message.=$text[$i];				
				}	
				$row[]='';	
			}
		}
		else{$Message='Failed';}
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
			$id = $this->Lawyer_package_bill_model->delete_action();
		}
		else{
			$text[]="Session out, login required";
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			
			if($id=='taken')
			{
				$Message='Action Already Taken Plz Refresh';
				$row[]='';	
			}
			else if($id==0)
			{
				$Message='Something went wrong';
				$row[]='';	
			}
			else if($this->input->post("type")=='delete'){$row[]='';}
			else{$row=$this->Lawyer_package_bill_model->get_recommend_info($id);}
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
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$amount = 0;
		$str='';
			if ($this->input->post('id') != ""){
				$details=$this->Lawyer_package_bill_model->get_recommend_info($this->input->post('id'));
	    	}
	    	else{$details=array();}
	    	if (!empty($details)) 
	    	{
	    		if ($details->proposed_type=='Loan') 
	    		{
	    			$no_tag="Loan A/C";
	    			$nam_tag="Loan A/C Name";
	    		}
	    		else
	    		{
	    			$no_tag="Card";
	    			$nam_tag="Name on Card";
	    		}
	    		$amount = $details->package_amount;
	    		if ($details->package_approval_file!='') {
	    			$package_approval_file='<img id="file_preview" onclick="popup(\''.base_url().'package_approval_file/'.$details->package_approval_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$package_approval_file="";}
	    		$str .='<table style="width: 100%;" id="preview_table">
					<thead></thead>
					<tbody id="details_body">
						<tr>
							<td width="50%" align="left"><strong>Proposed Type:</strong>'.$details->proposed_type.'</td>
							<td width="50%" align="left"><strong>Remarks:</strong>'.$details->remarks.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>'.$no_tag.'No.:</strong> '.$details->loan_ac.'</td>
							<td width="50%" align="left"><strong>Status:</strong>'.$details->status.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Lawyer Name:</strong>'.$details->lawyer_name.'</td>
							<td width="50%" align="left"><strong>Req Type:</strong>'.$details->req_type_name.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Package Type:</strong>'.$details->package_type_name.'</td>
							<td width="50%" align="left"><strong>Approval File:</strong>'.$package_approval_file.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Number:</strong>'.$details->case_number.'</td>
							<td width="50%" align="left"><strong>Package Amount:</strong>'.$details->package_amount.'</td>
							
						</tr>
						<tr>
							
							<td width="50%" align="left"><strong>Initiate By:</strong>'.$details->e_by.'</td>
							<td width="50%" align="left"><strong>Initiate Date Time:</strong>'.$details->e_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Loan Segment (Portfolio) :</strong>'.$details->loan_segment.'</td>
							
							<td width="50%" align="left"><strong>STC Date Time:</strong>'.$details->stc_dt.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Verify By:</strong>'.$details->v_by.'</td>
							<td width="50%" align="left"><strong>Verify Date Time:</strong>'.$details->v_dt.'</td>
						</tr>';
						$str.='
					</tbody>
				</table>';
	    	}
	    	$var =array(
				"str"=>$str,
				"amount"=>$amount,
				"csrf_token"=>$csrf_token
				);
			echo json_encode($var);
	}
	function r_history()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$sah=$this->Lawyer_package_bill_model->get_r_history($this->input->post('id'),$this->input->post('life_cycle'));
        $jTableResult = array();
        $jTableResult['csrf_token'] = $csrf_token;
        if ($sah != null) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $sah;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
	}
	function check_duplication()
	{
		$success = 1;
		$str_where = "c.sts<>0 AND c.v_sts<>12";
		if (trim($this->input->post('proposed_type')) != '' && trim($this->input->post('loan_ac')) != '') {
			if (trim($this->input->post('proposed_type'))=='Loan') {
				$str_where.= " AND c.loan_ac='".trim($this->input->post('loan_ac'))."'";
			}else
			{
				$str_where.= " AND c.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
			}
		}
		if (trim($this->input->post('req_type')) != '') {
			$str_where.= " AND c.req_type=".$this->db->escape(trim($this->input->post('req_type')));
		}
		if (trim($this->input->post('package_type')) != 1) {
			if (trim($this->input->post('case_number')) != '') {
				$str_where.= " AND c.case_number='".trim($this->input->post('case_number'))."'";
			}
		}
		if (trim($this->input->post('package_type')) != '') {
			$str_where.= " AND c.package_type='".trim($this->input->post('package_type'))."'";
		}
		if (trim($this->input->post('lawyer')) != '') {
			$str_where.= " AND c.lawyer='".trim($this->input->post('lawyer'))."'";
		}
		if (trim($this->input->post('protfolio')) != '') {
			$str_where.= " AND c.protfolio='".trim($this->input->post('protfolio'))."'";
		}
		if(trim($this->input->post('add_edit')) == 'edit')
		{
			$str_where.= " AND c.id!='".trim($this->input->post('editrow'))."'";
		}
		$row = $this->db->query("SELECT c.id
			FROM lawyer_package_bill_setup as c 
			WHERE ".$str_where."")->result();

		$csrf_token=$this->security->get_csrf_hash();

		if(!empty($row))
		{
			$success = 0;
		}
		else
		{
			$success = 1;
		}
		$var['csrf_token']=$csrf_token;
		$var['success']=$success;
		echo json_encode($var);
	}
}
?>
