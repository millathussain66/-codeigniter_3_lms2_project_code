<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expenses extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Expenses_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		$this->Common_model->delete_tempfile();
		$expense_activities = array();
		$under_section = $this->User_model->get_parameter_data('ref_under_section','name','data_status = 1');
		$lawyer = array();
		$return_type = array();
		$staff = array();
		$lawyer = array();
		$staff_conv_type = array();
		$acLength = $this->Common_model->getAcLength();
		$acPartStr = json_encode(explode(",", $acLength));
		if ($operation==NULL) {
			$operation = 'lawyer_bill';
			$lawyer = $this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1');
		}
		else if ($operation=='lawyer_bill' || $operation=='court_fee' || $operation=='court_adjust') {
			$lawyer = $this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1');
		}
		else if($operation=='court_enter')
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_court_entertainment_activities','name','data_status = 1 AND apv_sts<>1');
		}else if($operation=='staff_con')
		{
			$staff_conv_type = $this->User_model->get_parameter_data('ref_staff_conv_type','id','data_status = 1');
			$expense_activities = $this->User_model->get_parameter_data('ref_staff_conv_activities','name','data_status = 1');
		}else if($operation=='paper_bill')
		{
			$staff = $this->Expenses_model->get_staff();
			$under_section = $this->User_model->get_parameter_data('ref_under_section','name','data_status = 1');
			$expense_activities = $this->User_model->get_parameter_data('ref_paper_bill_activities','name','data_status = 1');
		}else if($operation=='other')
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_others_cost_activities','name','data_status = 1');
		}
		else if($operation=='court_return')
		{
			$lawyer = $this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1');
			$return_type = $this->User_model->get_parameter_data('ref_return_type','name','data_status = 1');
		}
		$add_edit='';$id="";

		$data = array(
			'add_edit' => $add_edit,
			'under_section' => $under_section,
			'id' => $id,
			'functional_designation' => $this->User_model->get_parameter_data('ref_functional_designation','name','data_status = 1'),
			'employee_type'=>$this->User_model->get_parameter_data('ref_employee_type','name','data_status = 1'),
			'vendor'=>$this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'), 
			'district'=>$this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1 AND id IN('.$this->session->userdata["ast_user"]["legal_district"].')'),
			'billing_month'=>$this->User_model->get_parameter_data('ref_billing_month','id','data_status = 1'),
			'legal_region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1 AND id IN('.$this->session->userdata["ast_user"]["legal_region"].')'),
			'expense_activities'=>$expense_activities,
			'menu_group'=> $menu_group,
			'lawyer'=> $lawyer,
			'staff_conv_type'=> $staff_conv_type,
			'staff'=> $staff,
			'return_type'=> $return_type,
			'menu_cat'=> $menu_cat,
			'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
			'court' => $this->User_model->get_parameter_data('ref_court','name','data_status = 1'),
			'paper_vendor' => $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
			'paper' => $this->User_model->get_parameter_data('ref_paper','name','data_status = 1'),
			'acLength' => $acPartStr,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'expenses/pages/grid',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function get_case_number()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str_where = "c.sts<>0 AND (c.suit_sts=75 OR c.suit_sts=76)";
		if (trim($this->input->post('proposed_type')) != '') {
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
		$suit_row = $this->db->query("SELECT r.name as req_type,c.case_number,c.id,c.loan_ac,c.ac_name
			FROM suit_filling_info as c 
			LEFT OUTER JOIN ref_req_type r on(c.req_type=r.id)
			WHERE ".$str_where." ORDER BY c.id DESC LIMIT 1 ")->row();

		if(!empty($suit_row))
		{
			$Message='ok';
		}
		else
		{
			$Message='No Case Found!!';
		}
		$var['csrf_token']=$csrf_token;
		$var['suit_row']=$suit_row;
		$var['Message']=$Message;
		echo json_encode($var);
	}
	function check_duplication_paper_bill()
	{
		$success = 1;
		$paper = $this->input->post('paper');
		$account_type = $this->input->post('account_type');
		$add_edit = $this->input->post('add_edit');
		$cma_id = $this->input->post('cma_id');
		$suit_id = $this->input->post('suit_id');
		$edit_id = $this->input->post('edit_id');
		$case_number = $this->input->post('case_number');
		$publication_date = implode('-',array_reverse(explode('/',$this->input->post('date'))));
		$str_where = "c.vendor_type=2 AND c.paper_id='".$paper."' AND c.txrn_dt='".$publication_date."'";
		if($account_type==1)//for cma
		{
			$str_where.=" AND c.cma_id='".$cma_id."'";
		}
		if($account_type==2)// for suit data
		{
			$str_where.=" AND c.suit_id='".$case_number."'";
		}

		$row = $this->db->query("SELECT c.id
		FROM cost_details as c 
		WHERE ".$str_where."")->result();
		
		
		
		

		$csrf_token=$this->security->get_csrf_hash();

		if(!empty($row))
		{
			$success = 0;
		}
		else
		{
			//checking again on expenses table
			$str_where = "c.sts<>0 AND b.sts<>0 AND c.module_name='paper' AND c.paper_name='".$paper."' AND c.activities_date='".$publication_date."'";
			if($account_type==1)//for cma
			{
				$str_where.=" AND b.cma_id='".$cma_id."'";
			}
			if($account_type==2)// for suit data
			{
				$str_where.=" AND b.suit_id='".$case_number."'";
			}
			if($add_edit=='edit')
			{
				$str_where.=" AND c.id<>'".$edit_id."'";
			}
			$row = $this->db->query("SELECT c.id
				FROM expenses as c 
				LEFT OUTER JOIN paper_bill_data b on (b.id=c.event_id)
				WHERE ".$str_where."")->result();
			if(!empty($row))
			{
				$success = 0;
			}
			else
			{
				$success = 1;
			}
		}
		$var['csrf_token']=$csrf_token;
		$var['success']=$success;
		echo json_encode($var);
	}
	function lawyer_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Expenses_model->get_grid_data_lawyer($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function court_fee_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Expenses_model->get_grid_data_court_fee($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function court_adjust_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Expenses_model->get_grid_data_court_adjust($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function court_return_grid()
	{
		
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Expenses_model->get_grid_data_court_return($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
		
	}
	function staff_grid()
	{
		
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Expenses_model->get_grid_data_staff($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
		
	}
	function court_enter_grid()
	{
		
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Expenses_model->get_grid_data_court_enter($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
		
	}
	function paper_grid()
	{
		
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Expenses_model->get_grid_data_paper($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
		
	}
	function other_grid()
	{
		
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Expenses_model->get_grid_data_others($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
		
	}
	function from($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$this->load->model('Ait_vat_model', '', TRUE);
		$result = $this->Ait_vat_model->get_info($add_edit,$id);
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
	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->add_edit_action($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";

			  
		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Expenses_model->get_add_action_data($id);
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
	function add_edit_court_enter($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->add_edit_action_court_enter($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";

			  
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Expenses_model->get_add_action_data($id);
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
	function add_edit_staff_conv($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->add_edit_action_staff_conv($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";

			  
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Expenses_model->get_add_action_data($id);
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
	function get_edit_info_staff_conv()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$row_info =$this->Expenses_model->get_add_action_data_staff_conv($id);
		$expense = $this->Expenses_model->get_expenese_info_staff_conv($id);
		if (!empty($row_info)) {
			$Message='ok';
		}
		else{
			$Message='No Data';
		}
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row_info;
		$var['Message']=$Message;
		$var['expense']=$expense;
		echo json_encode($var);
	}
	function get_edit_info_court_enter()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$row_info =$this->Expenses_model->get_add_action_data_court_enter($id);
		$expense = $this->Expenses_model->get_expenese_info_court($id);
		if (!empty($row_info)) {
			$Message='ok';
		}
		else{
			$Message='No Data';
		}
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row_info;
		$var['Message']=$Message;
		$var['expense']=$expense;
		echo json_encode($var);
	}
	function get_edit_info_paper()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$row_info =$this->Expenses_model->get_add_action_data_paper($id);
		$expense = $this->Expenses_model->get_expenese_info_paper($id);
		if (!empty($row_info)) {
			$Message='ok';
		}
		else{
			$Message='No Data';
		}
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row_info;
		$var['Message']=$Message;
		$var['expense']=$expense;
		echo json_encode($var);
	}
	function add_edit_lawyer_bill($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->add_edit_lawyer_bill($add_edit,$id,$editrow);
		}
		else{
			$text[]="Session out, login required";
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			if($id=='00')
			{
				$Message='Something went wrong';
				$row[]='';	
			}
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
	function add_edit_court_fee($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->add_edit_court_fee($add_edit,$id,$editrow);
		}
		else{
			$text[]="Session out, login required";
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			if($id=='00')
			{
				$Message='Something went wrong';
				$row[]='';	
			}
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
	function add_edit_court_adjust($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->add_edit_court_adjust($add_edit,$id,$editrow);
		}
		else{
			$text[]="Session out, login required";
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			if($id=='00')
			{
				$Message='Something went wrong';
				$row[]='';	
			}
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
	function add_edit_paper($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->add_edit_action_paper($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";

			  
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Expenses_model->get_add_action_data($id);
			$this->Common_model->delete_tempfile();
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
	function add_edit_others($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->add_edit_action_others($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";

			  
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Expenses_model->get_add_action_data($id);
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
	function add_edit_court_fee_return($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->add_edit_court_fee_return($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";

			  
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Expenses_model->get_add_action_data($id);
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
	function delete_action(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->delete_action();
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
			else{$row[]=''; //$row=$this->Legal_notice_model->get_recommend_info($id);
			}
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
	function delete_action_lawyer_bill(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->delete_action_lawyer_bill();
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
			else{$row[]=''; //$row=$this->Legal_notice_model->get_recommend_info($id);
			}
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
	function delete_action_court_fee(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->delete_action_court_fee();
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
			else{$row[]=''; //$row=$this->Legal_notice_model->get_recommend_info($id);
			}
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
	function delete_action_court_enter(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->delete_action_court_enter();
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
			else{$row[]=''; //$row=$this->Legal_notice_model->get_recommend_info($id);
			}
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
	function delete_action_staff_conv(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->delete_action_staff_conv();
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
			else{$row[]=''; //$row=$this->Legal_notice_model->get_recommend_info($id);
			}
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
	function delete_action_court_return(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->delete_action_court_return();
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
			else{$row[]=''; //$row=$this->Legal_notice_model->get_recommend_info($id);
			}
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
	function delete_action_court_adjust(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->delete_action_court_adjust();
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
			else{$row[]=''; //$row=$this->Legal_notice_model->get_recommend_info($id);
			}
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
	function delete_action_paper(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->delete_action_paper();
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
			else{$row[]=''; //$row=$this->Legal_notice_model->get_recommend_info($id);
			}
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
	function get_expense_data_lawyer()
	{
		$vendor_id = $this->input->post('vendor');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Expenses_model->get_cost_details_lawyer($vendor_id,$bill_month);
		$str = '';
		if (!empty($result)) 
		{
			$sl = 1;
			foreach ($result as $key) 
			{
				if($key->proxy_sts==1)
				{
					$proxy_style='color:red';
					$text = '(Proxy)';
				}
				else
				{
					$proxy_style='"';
					$text = '';
				}
				$str.='<tr>
							<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="0"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center"'.$proxy_style.'>'.$key->vendor_name.' '.$text.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format($key->amount,2).'</td>
					</tr>';
				$sl++;
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="9">Total Selected Amount : <span id="selected_amount">0</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($result)."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="9">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_expense_data_court_fee()
	{
		$vendor_id = $this->input->post('vendor');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Expenses_model->get_cost_details_court_fee($vendor_id,$bill_month);
		$str = '';
		if (!empty($result)) 
		{
			$sl = 1;
			foreach ($result as $key) 
			{
				if($key->proxy_sts==1)
				{
					$proxy_style='color:red';
					$text = '(Proxy)';
				}
				else
				{
					$proxy_style='"';
					$text = '';
				}
				$str.='<tr>
							<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="0"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center"'.$proxy_style.'>'.$key->vendor_name.' '.$text.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format($key->amount,2).'</td>
					</tr>';
				$sl++;
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="9">Total Selected Amount : <span id="selected_amount">0</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($result)."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="9">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_expense_data_court_adjust()
	{
		$this->Common_model->delete_tempfile();
		$vendor_id = $this->input->post('vendor');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Expenses_model->get_cost_details_court_adjust($vendor_id,$bill_month);
		$str = '';
		if (!empty($result)) 
		{
			$sl = 1;
			foreach ($result as $key) 
			{
				$str.='<tr>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center"><div style="text-align:center; cursor:pointer" onclick="adjust(\''.$key->amount.'\',\''.$key->district_name.'\',\''.$key->vendor_name.'\',\''.$key->loan_ac.'\','.$key->id.','.$vendor_id.')" ><img align="center" src="'.base_url().'images/sendcib.png"></div></td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format($key->amount,2).'</td>
					</tr>';
				$sl++;
			}
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="9">Sorry No Data!!</td>
				</tr>';
		}
		$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_lawyer_edit_data()
	{
		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Expenses_model->get_add_action_data_lawyer($id);
		$bill_details = $this->Expenses_model->get_bill_details_lawyer($result->lawyer,$result->month,$result->year);
		$str = '';
		$checked="";
		$delete = 1;
		$desabled = "";

		if (!empty($bill_details)) 
		{
			$sl=1;$amount=0;$selected=0;
			foreach ($bill_details as $key) 
			{
				$desabled = "";
				$checked="";
				$bill_id = 0;
				if($key->legal_select_sts!=0)
				{
					
					if($key->legal_select_id==$id) //For This memo bill select
					{
						$checked="checked";
						$amount=$amount+$key->amount;
						$selected++;
						$delete = 0;
						$bill_id = $id;
					}
					else //For other's memo selectd bill
					{
						$desabled = "disabled";
						$delete = 1;
					}
					
				}else
				{
					$checked="";
					$delete = 1;
				}
				$str.='<tr>
							<td style="text-align:center"><input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" '.$checked.' /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="'.$bill_id.'"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format($key->amount,2).'</td>
					</tr>';
				$sl++;
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="9">Total Selected Amount : <span id="selected_amount">'.$amount.'</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($bill_details)."' />";
			$str.="<input type='hidden' id='bill_select' name='bill_select' value='".$selected."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="9">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"result"=>$result,
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_court_fee_edit_data()
	{
		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Expenses_model->get_add_action_data_lawyer($id);
		$bill_details = $this->Expenses_model->get_bill_details_court_fee($result->lawyer,$result->month,$result->year);
		$str = '';
		$checked="";
		$delete = 1;
		$desabled = "";

		if (!empty($bill_details)) 
		{
			$sl=1;$amount=0;$selected=0;
			foreach ($bill_details as $key) 
			{
				$desabled = "";
				$checked="";
				$bill_id = 0;
				if($key->legal_select_sts!=0)
				{
					
					if($key->legal_select_id==$id) //For This memo bill select
					{
						$checked="checked";
						$amount=$amount+$key->amount;
						$selected++;
						$delete = 0;
						$bill_id = $id;
					}
					else //For other's memo selectd bill
					{
						$desabled = "disabled";
						$delete = 1;
					}
					
				}else
				{
					$checked="";
					$delete = 1;
				}
				$str.='<tr>
							<td style="text-align:center"><input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" '.$checked.' /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="'.$bill_id.'"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format($key->amount,2).'</td>
					</tr>';
				$sl++;
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="9">Total Selected Amount : <span id="selected_amount">'.$amount.'</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($bill_details)."' />";
			$str.="<input type='hidden' id='bill_select' name='bill_select' value='".$selected."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="9">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"result"=>$result,
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_court_adjust_edit_data()
	{
		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Expenses_model->get_add_action_data_court_adjust($id);
		$var =array(
    			"result"=>$result,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function lawyer_bill_details()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Expenses_model->get_row_details_lawyer($id);
		$bill_details = $this->Expenses_model->get_lawyer_bill_details_by_id($id);
    	if (!empty($details)) 
    	{
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>Total Selected.:</strong>'.$details->total_selected.'</td>
						<td width="50%" align="left"><strong>Bill Type:</strong>Lawyer Bill</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Vendor:</strong>'.$details->vendor_name.'</td>
						<td width="50%" align="left"></td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Entry By:</strong>'.$details->e_by.'</td>
						<td width="50%" align="left"><strong>Entry Date:</strong>'.$details->e_dt.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Verify By:</strong>'.$details->v_by.'</td>
						<td width="50%" align="left"><strong>Verify Date:</strong>'.$details->v_dt.'</td>
					</tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($bill_details)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Vendor Name</td>
						<td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
						<td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
						<td width="15%" style="font-weight: bold;text-align:center">Case No.</td>
						<td width="10%" style="font-weight: bold;text-align:center">Date of legal steps</td>
						<td width="15%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
						<td width="15%" style="font-weight: bold;text-align:center">Amount</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				foreach ($bill_details as $key) 
				{
					$str.='<tr>';
						$str.='<td align="center">'.$key->vendor_name.'</td>';
						$str.='<td align="center">'.$key->loan_ac.'</td>';
						$str.='<td align="center">'.$key->ac_name.'</td>';
						$str.='<td align="center">'.$key->case_number.'</td>';
						$str.='<td align="center">'.$key->txrn_dt.'</td>';
						$str.='<td align="center">'.$key->activities_name.'</td>';
						$str.='<td align="center">'.number_format($key->amount,2).'</td>';
					$str.='</tr>';
				}

			$str.='</tbody>
				</table>
			</div>';

    	}
    	$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function court_fee_details()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Expenses_model->get_row_details_lawyer($id);
		$bill_details = $this->Expenses_model->get_court_fee_details_by_id($id);
    	if (!empty($details)) 
    	{
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>Total Selected.:</strong>'.$details->total_selected.'</td>
						<td width="50%" align="left"><strong>Bill Type:</strong>Court Fee</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Vendor:</strong>'.$details->vendor_name.'</td>
						<td width="50%" align="left"></td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Entry By:</strong>'.$details->e_by.'</td>
						<td width="50%" align="left"><strong>Entry Date:</strong>'.$details->e_dt.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Verify By:</strong>'.$details->v_by.'</td>
						<td width="50%" align="left"><strong>Verify Date:</strong>'.$details->v_dt.'</td>
					</tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($bill_details)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Vendor Name</td>
						<td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
						<td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
						<td width="15%" style="font-weight: bold;text-align:center">Case No.</td>
						<td width="10%" style="font-weight: bold;text-align:center">Date of legal steps</td>
						<td width="15%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
						<td width="15%" style="font-weight: bold;text-align:center">Amount</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				foreach ($bill_details as $key) 
				{
					$str.='<tr>';
						$str.='<td align="center">'.$key->vendor_name.'</td>';
						$str.='<td align="center">'.$key->loan_ac.'</td>';
						$str.='<td align="center">'.$key->ac_name.'</td>';
						$str.='<td align="center">'.$key->case_number.'</td>';
						$str.='<td align="center">'.$key->txrn_dt.'</td>';
						$str.='<td align="center">'.$key->activities_name.'</td>';
						$str.='<td align="center">'.number_format($key->amount,2).'</td>';
					$str.='</tr>';
				}

			$str.='</tbody>
				</table>
			</div>';

    	}
    	$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_loan_data()
    {
    	$csrf_token=$this->security->get_csrf_hash();
    	$text=array();
    	$row = array();
    	$Message = 'ok';
    	$str_where= "c.sts<>0 AND c.cma_sts NOT IN(5,12)";
		if (trim($this->input->post('proposed_type')) != '') {
			if (trim($this->input->post('proposed_type'))=='Loan') {
				$str_where.= " AND c.loan_ac='".trim($this->input->post('loan_ac'))."'";
			}else
			{
				$str_where.= " AND c.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
			}
		}
		if(trim($this->input->post('case_no')) != '')
		{ $str_where.= " AND s.case_number='".trim($this->input->post('case_no'))."'"; }


		$row = $this->db->query("SELECT s.prest_court_name,s.case_number,s.cma_id,c.loan_ac,c.ac_name,s.id FROM cma as c 
			LEFT OUTER JOIN suit_filling_info s on(c.id=s.cma_id)
			WHERE ".$str_where." LIMIT 1")->result();
		if (empty($row)) {
			$Message = 'Sorry No Data!!';
		}
		$court = $this->User_model->get_parameter_data('ref_court','name','data_status = 1');
		$var['row']=$row;
		$var['court']=$court;
		$var['Message']=$Message;
		$var['csrf_token']=$csrf_token;
		echo json_encode($var);
    }
    function get_court_fee_return_data()
    {
    	$this->Common_model->delete_tempfile();
    	$csrf_token=$this->security->get_csrf_hash();
    	$text=array();
    	$row = array();
    	$Message = 'ok';
    	
    		$str_where= "c.memo_sts=88 AND ((c.adjustment_sts IS NULL OR c.adjustment_sts = '' OR c.adjustment_sts = 0) OR (c.adjustment_sts=1 AND (c.fully_adjust_sts IS NULL OR c.fully_adjust_sts = '' OR c.fully_adjust_sts = 0) AND c.adjust_v_sts=13)) AND c.vendor_type=4 AND (c.court_fee_return_sts IS NULL OR c.court_fee_return_sts = '' OR c.court_fee_return_sts=0)";
			$str_where.= " AND c.loan_ac='".trim($this->input->post('loan_ac'))."'";
			$str_where.= " AND c.vendor_id=".$this->db->escape(trim($this->input->post('lawyer')));
			$row = $this->db->query("SELECT c.loan_ac,c.amount,c.ac_name,c.id,d.id as lawyer_district_id,d.name as district_name
			 FROM cost_details as c 
				LEFT OUTER JOIN ref_lawyer l on(c.vendor_id=l.id)
				LEFT OUTER JOIN ref_legal_district d on(l.district=d.id)
				WHERE ".$str_where."")->result();
		if (empty($row)) {
			$Message = 'Sorry No Data!!';
		}
		$var['row']=$row;
		$var['Message']=$Message;
		$var['csrf_token']=$csrf_token;
		echo json_encode($var);
    }
    function get_pending_court_fee()
    {
    	$csrf_token=$this->security->get_csrf_hash();
    	$text=array();
    	$row = array();
    	$Message = 'ok';
    	
    		if($this->input->post('add_edit')=='add')
    		{
    			$str_where= "(c.memo_sts=0 OR c.memo_sts IS NULL) AND ((c.adjustment_sts IS NULL OR c.adjustment_sts = '' OR c.adjustment_sts = 0) OR (c.adjustment_sts=1 AND (c.fully_adjust_sts IS NULL OR c.fully_adjust_sts = '' OR c.fully_adjust_sts = 0) AND c.adjust_v_sts=13)) AND c.vendor_type=4 AND (c.court_fee_return_sts IS NULL OR c.court_fee_return_sts = '' OR c.court_fee_return_sts=0)";
    		}
    		else
    		{
    			$str_where= "(c.memo_sts=0 OR c.memo_sts IS NULL) AND ((c.adjustment_sts IS NULL OR c.adjustment_sts = '' OR c.adjustment_sts = 0) OR (c.adjustment_sts=1 AND (c.fully_adjust_sts IS NULL OR c.fully_adjust_sts = '' OR c.fully_adjust_sts = 0) AND c.adjust_v_sts=13) OR (c.adjustment_sts=1 AND c.id='".$this->input->post('edit_id')."' AND c.adjust_v_sts IN(35,39))) AND c.vendor_type=4 AND (c.court_fee_return_sts IS NULL OR c.court_fee_return_sts = '' OR c.court_fee_return_sts=0)";
    		}
			$str_where.= " AND c.loan_ac='".trim($this->input->post('loan_ac'))."' AND c.vendor_id='".$this->input->post('lawyer')."'";
			$row = $this->db->query("SELECT c.amount,c.id
			 FROM cost_details as c 
				WHERE ".$str_where."")->result();
		if (empty($row)) {
			$Message = 'Sorry No Data!!';
		}
		$var['row']=$row;
		$var['Message']=$Message;
		$var['csrf_token']=$csrf_token;
		echo json_encode($var);
    }
    function get_edit_info_court_return()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$row_info =$this->Expenses_model->get_add_action_data_court_return($id);
		$lawyer_info =$this->Expenses_model->get_lawyer_info_by_lawyer_id($row_info->lawyer);
		if (!empty($row_info)) {
			$Message='ok';
		}
		else{
			$Message='No Data';
		}
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row_info;
		$var['lawyer_info']=$lawyer_info;
		$var['Message']=$Message;
		echo json_encode($var);
	}
    function get_loan_data_paper()
    {
    	$csrf_token=$this->security->get_csrf_hash();
    	$text=array();
    	$row = array();
    	$Message = 'ok';
    	if($_POST['account_type']==1)//Before Case Data Getting From CMA
    	{
    		$str_where= "c.sts<>0 AND c.cma_sts NOT IN(5,12)";
			if (trim($this->input->post('proposed_type')) != '') {
				if (trim($this->input->post('proposed_type'))=='Loan') {
					$str_where.= " AND c.loan_ac='".trim($this->input->post('loan_ac'))."'";
				}else
				{
					$str_where.= " AND c.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
				}

				if (trim($this->input->post('req_type'))!='') {
					$str_where.= " AND c.req_type=".$this->db->escape(trim($this->input->post('req_type')));
				}
			}
			$row = $this->db->query("SELECT c.loan_ac,c.case_fill_dist as district,d.name as district_name,c.ac_name,c.id FROM cma as c 
				LEFT OUTER JOIN ref_legal_district d on(c.case_fill_dist=d.id)
				WHERE ".$str_where." LIMIT 1")->result();
    	}
    	else//Before Case Data Getting From Suit File
    	{
    		$str_where= "c.sts<>0 AND (c.suit_sts=75 OR c.suit_sts=76)";
			if (trim($this->input->post('proposed_type')) != '') {
				if (trim($this->input->post('proposed_type'))=='Loan') {
					$str_where.= " AND c.loan_ac='".trim($this->input->post('loan_ac'))."'";
				}else
				{
					$str_where.= " AND c.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
				}

				if (trim($this->input->post('req_type'))!='') {
					$str_where.= " AND c.req_type=".$this->db->escape(trim($this->input->post('req_type')));
				}
			}
			$row = $this->db->query("SELECT c.loan_ac,c.district as district,d.name as district_name,c.ac_name,c.id,c.case_number FROM suit_filling_info as c 
				LEFT OUTER JOIN ref_legal_district d on(c.district=d.id)
				WHERE ".$str_where."")->result();
    	}
		if (empty($row)) {
			$Message = 'Sorry No Data!!';
		}
		$str_where= "j0.main_table_name='paper_bill_data'";
		if (trim($this->input->post('proposed_type')) != '') {
			if (trim($this->input->post('proposed_type'))=='Loan') {
				$str_where.= " AND j0.loan_ac='".trim($this->input->post('loan_ac'))."'";
			}else
			{
				$str_where.= " AND j0.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
			}

			if (trim($this->input->post('req_type'))!='') {
				$str_where.= " AND j0.req_type=".$this->db->escape(trim($this->input->post('req_type')));
			}
		}
		$str="SELECT  j0.*,p.name as paper_name,DATE_FORMAT(j0.txrn_dt,'%d-%b-%y') AS pre_pub_dt
                 FROM cost_details j0
                 LEFT OUTER JOIN ref_paper p on(p.id=j0.paper_id)
             WHERE ".$str_where." ORDER BY j0.id DESC LIMIT 1";

        $pre_publication_data=$this->db->query($str)->row();
        if(!empty($pre_publication_data))
        {
        	$pre_pub_date = $pre_publication_data->pre_pub_dt;
        	$pre_pub_dt_org = $pre_publication_data->txrn_dt;
        	$paper_scan_copy = $pre_publication_data->paper_scan_copy;
        	$paper_name = $pre_publication_data->paper_name;
        	$paper_id = $pre_publication_data->paper_id;
        	$pre_pub_id = $pre_publication_data->id;
        }
        else
        {
        	$pre_pub_date = '';
        	$paper_scan_copy = '';
        	$pre_pub_dt_org = '';
        	$paper_name = '';
        	$paper_id = '';
        	$pre_pub_id = '';
        }
		$var['row']=$row;
		$var['paper_name']=$paper_name;
		$var['pre_pub_id']=$pre_pub_id;
		$var['paper_id']=$paper_id;
		$var['pre_pub_dt_org']=$pre_pub_dt_org;
		$var['pre_pub_date']=$pre_pub_date;
		$var['paper_scan_copy']=$paper_scan_copy;
		$var['Message']=$Message;
		$var['csrf_token']=$csrf_token;
		echo json_encode($var);
    }
    function get_vendor_info()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$row=$this->Expenses_model->get_vendor_info($this->input->post('type'),$this->input->post('id'));
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row;
		echo json_encode($var);
	}
    function paper_bill_details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Expenses_model->get_row_details_paper($id);
		$expense = $this->Expenses_model->get_expenese_details_paper($id);
    	if (!empty($details)) 
    	{
            if ($details->pre_pub_copy!='' && $details->pre_pub_copy!=NULL) {
                $pre_pub_copy='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/paper_scan_copy/'.$details->pre_pub_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$pre_pub_copy="";}
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>Proposed Type.:</strong>'.$details->proposed_type.'</td>
						<td width="50%" align="left"><strong>Requisition Type:</strong>'.$details->req_type_name.'</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Loan Account:</strong>'.$details->loan_ac.'</td>
						<td width="50%" align="left"><strong>Account Name:</strong>'.$details->ac_name.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>District:</strong>'.$details->district_name.'</td>
						<td width="50%" align="left"><strong>Under Section:</strong>'.$details->under_section_name.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Case Number:</strong>'.$details->case_number.'</td>
						<td width="50%" align="left"><strong>Pre Publication Date Time:</strong>'.$details->pre_pub_dt.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Pre Publication Paper Name:</strong>'.$details->pre_paper_name.'</td>
						<td width="50%" align="left"><strong>Pre Publication File:</strong>'.$pre_pub_copy.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Entry By:</strong>'.$details->e_by.'</td>
						<td width="50%" align="left"><strong>Entry Date Time:</strong>'.$details->e_dt.'</td>
					</tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($expense)) 
    	{

    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Vendor</td>
                        <td width="15%" style="font-weight: bold;text-align:center">Bank Account No.</td>
                        <td width="15%" style="font-weight: bold;text-align:center">Tin Number</td>
                        <td width="10%" style="font-weight: bold;text-align:center">Bin Number</td>
                        <td width="15%" style="font-weight: bold;text-align:center">Musok(6.3) Number</td>
                        <td width="15%" style="font-weight: bold;text-align:center">Paper Name</td>
                        <td width="10%" style="font-weight: bold;text-align:center">Publication Date</td>
                        <td width="5%" style="font-weight: bold;text-align:center">Publication Copy</td>
                        <td width="5%" style="font-weight: bold;text-align:center">Approval Copy</td>
                        <td width="10%" style="font-weight: bold;text-align:center">Amount</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				$paper_scan_copy_sts = 1;
				foreach ($expense as $key) 
				{
					if ($key->paper_scan_copy!='' && $key->paper_scan_copy!=NULL) {
		                $paper_scan_copy='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/paper_scan_copy/'.$key->paper_scan_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
		            }else{$paper_scan_copy="";}
		            if ($key->paper_expense_approval_file!='' && $key->paper_expense_approval_file!=NULL) {
		                $paper_expense_approval_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/paper_expense_approval_file/'.$key->paper_expense_approval_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
		            }else{$paper_expense_approval_file="";$paper_scan_copy_sts = 0;}
					$str.='<tr>';
						$str.='<td align="center">'.$key->vendor_name.'</td>';
						$str.='<td align="center">'.$key->account_no.'</td>';
						$str.='<td align="center">'.$key->tin.'</td>';
						$str.='<td align="center">'.$key->bin.'</td>';
						$str.='<td align="center">'.$key->mousak.'</td>';
						$str.='<td align="center">'.$key->paper_name.'</td>';
						$str.='<td align="center">'.$key->activities_date.'</td>';
						$str.='<td align="center">'.$paper_scan_copy.'</td>';
						$str.='<td align="center">'.$paper_expense_approval_file.'</td>';
						$str.='<td align="center">'.number_format($key->amount,2).'</td>';
					$str.='</tr>';
				}

			$str.='</tbody>
				</table>
			</div>';

    	}
    	$var =array(
    			"str"=>$str,
    			"paper_scan_copy_sts"=>$paper_scan_copy_sts,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function court_return_details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Expenses_model->get_row_details_court_return($id);
		$return_type='';
		$remarks='';
		$return_amount='';
    	if (!empty($details)) 
    	{
    		$return_type=$details->return_type;
    		$return_amount=$details->return_amount;
    		$remarks=$details->remarks;
    		if ($details->court_fee_return_application!='' && $details->court_fee_return_application!=NULL) {
                $court_fee_return_application='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/court_fee_return_application/'.$details->court_fee_return_application.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$court_fee_return_application="";}
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>Loan AC.:</strong>'.$details->loan_ac.'</td>
						<td width="50%" align="left"><strong>AC Name:</strong>'.$details->ac_name.'</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Lawyer Name:</strong>'.$details->lawyer_name.'</td>
						<td width="50%" align="left"><strong>Lawyer District:</strong>'.$details->district_name.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Return Amount:</strong>'.$details->return_amount.'</td>
						<td width="50%" align="left"><strong>Lawyer Application Copy:</strong>'.$court_fee_return_application.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Case Claim Amount:</strong>'.$details->st_belance.'</td>
						<td width="50%" align="left"><strong>Return Type:</strong>'.$details->return_type_name.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Rmarks:</strong>'.$details->remarks.'</td>
						<td width="50%" align="left"></td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Entry By:</strong>'.$details->e_by.'</td>
						<td width="50%" align="left"><strong>Entry Date Time:</strong>'.$details->e_dt.'</td>
					</tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	$var =array(
    			"str"=>$str,
    			"remarks"=>$remarks,
    			"return_type"=>$return_type,
    			"return_amount"=>$return_amount,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function court_adjust_details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Expenses_model->get_row_details_court_adjust($id);
		$return_type='';
		$remarks='';
		$return_amount='';
    	if (!empty($details)) 
    	{
    		if ($details->lawyer_ack_copy!='' && $details->lawyer_ack_copy!=NULL) {
                $lawyer_ack_copy='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/lawyer_ack_copy/'.$details->lawyer_ack_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$lawyer_ack_copy="";}
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>Adjustment Reason:</strong>'.$details->adjustment_reason.'</td>
						<td width="50%" align="left"><strong>New Assign Account No:</strong>'.$details->new_loan_ac.'</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Adjustment Account No.:</strong>'.$details->adjusted_ac.'</td>
						<td width="50%" align="left"><strong>Lawyer Name:</strong>'.$details->lawyer_name.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Lawyer District:</strong>'.$details->district_name.'</td>
						<td width="50%" align="left"><strong>Lawyer Application Copy:</strong>'.$lawyer_ack_copy.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>New Account Court Fee:</strong>'.$details->adjustment_amount_with.'</td>
						<td width="50%" align="left"><strong>Adjustment Amount:</strong>'.$details->adjustment_amount_from.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Purchase Status:</strong>'.$details->purchase_status.'</td>
						<td width="50%" align="left"></td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Entry By:</strong>'.$details->e_by.'</td>
						<td width="50%" align="left"><strong>Entry Date Time:</strong>'.$details->e_dt.'</td>
					</tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	$var =array(
    			"str"=>$str,
    			"remarks"=>$remarks,
    			"return_type"=>$return_type,
    			"return_amount"=>$return_amount,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_court_enter_details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Expenses_model->get_row_details_court_enter($id);
		$expense = $this->Expenses_model->get_expenese_court_entertainment_details($id);
    	if (!empty($details)) 
    	{
    		if ($details->court_approval_file!='' && $details->court_approval_file!=NULL) {
                $court_approval_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/court_approval_file/'.$details->court_approval_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$court_approval_file="";}
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>Employee Type:</strong>'.$details->employee_type.'</td>
						<td width="50%" align="left"><strong>Billing Month:</strong>'.$details->billing_month.'</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Stff Pin:</strong>'.$details->staff_pin.'</td>
						<td width="50%" align="left"><strong>Account Number:</strong>'.$details->account_number.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Employee Name:</strong>'.$details->employee_name.'</td>
						<td width="50%" align="left"><strong>Legal Region:</strong>'.$details->legal_region.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Job Grade:</strong>'.$details->job_grade.'</td>
						<td width="50%" align="left"><strong>District.:</strong>'.$details->district.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Functional Designation:</strong>'.$details->functional_desig.'</td>
						<td width="50%" align="left"><strong>Base Office Name:</strong>'.$details->base_office_name.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Mobile Number:</strong>'.$details->mobile_no.'</td>
						<td width="50%" align="left"><strong>Court Approval Filde:</strong>'.$court_approval_file.'</td>
					</tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($expense)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Expense Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Proposed type</td>
                        <td width="15%" style="font-weight: bold;text-align:center">Account Number</td>
                        <td width="15%" style="font-weight: bold;text-align:center">Type Of Case</td>
                        <td width="10%" style="font-weight: bold;text-align:center">AC Name</td>
                        <td width="15%" style="font-weight: bold;text-align:center">Case Number</td>
                        <td width="15%" style="font-weight: bold;text-align:center">Particulars</td>
                        <td width="10%" style="font-weight: bold;text-align:center">Activities Name</td>
                        <td width="10%" style="font-weight: bold;text-align:center">Activities Date</td>
                        <td width="10%" style="font-weight: bold;text-align:center">Amount</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				foreach ($expense as $key) 
				{
					$str.='<tr>';
						$str.='<td align="center">'.$key->proposed_type.'</td>';
						$str.='<td align="center">'.$key->account_number.'</td>';
						$str.='<td align="center">'.$key->req_type.'</td>';
						$str.='<td align="center">'.$key->ac_name.'</td>';
						$str.='<td align="center">'.$key->case_number.'</td>';
						$str.='<td align="center">'.$key->remarks.'</td>';
						$str.='<td align="center">'.$key->activities_name.'</td>';
						$str.='<td align="center">'.$key->activities_date.'</td>';
						$str.='<td align="center">'.number_format($key->amount,2).'</td>';
					$str.='</tr>';
				}

			$str.='</tbody>
				</table>
			</div>';

    	}
    	$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_staff_conv_details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Expenses_model->get_row_details_staff_conv($id);
		$expense = $this->Expenses_model->get_expenese_details_staff_conv($id);
		$type="";
    	if (!empty($details)) 
    	{
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>Stff Pin:</strong>'.$details->staff_pin.'</td>
						<td width="50%" align="left"><strong>Billing Month:</strong>'.$details->billing_month.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Employee Name:</strong>'.$details->employee_name.'</td>
						<td width="50%" align="left"><strong>Legal Region:</strong>'.$details->legal_region.'</td>
						
					</tr>
					<tr><td width="50%" align="left"><strong>Functional Designation:</strong>'.$details->func_desig.'</td>
						<td width="50%" align="left"><strong>District.:</strong>'.$details->district.'</td>
					</tr>
					';
			$str.='</tbody>
				</table>';
			$type = $details->conv_type;
    	}
    	if (!empty($expense)) 
    	{
    		if($type==1)
    		{
    			$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Expense Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="20%" style="font-weight: bold;text-align:center">Date</td>
                        <td width="20%" style="font-weight: bold;text-align:center">Movement Details</td>
                        <td width="20%" style="font-weight: bold;text-align:center">Mode of Transportaion</td>
                        <td width="20%" style="font-weight: bold;text-align:center">Amount BDT</td>
                        <td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
    		}
    		else if($type==2)
    		{
    			$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Expense Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
	                    <td width="20%" style="font-weight: bold;text-align:center">Date</td>
	                    <td width="20%" style="font-weight: bold;text-align:center">Particulars</td>
	                    <td width="20%" style="font-weight: bold;text-align:center">Place</td>
	                    <td width="20%" style="font-weight: bold;text-align:center">Amount BDT</td>
	                    <td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
    		}
    		else if($type==3)
    		{
    			$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Expense Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
	                    <td width="15%" style="font-weight: bold;text-align:center">Date</td>
	                    <td width="15%" style="font-weight: bold;text-align:center">Description of Journey</td>
	                    <td width="10%" style="font-weight: bold;text-align:center">Journey Time</td>
	                    <td width="10%" style="font-weight: bold;text-align:center">Journey Metar</td>
	                    <td width="10%" style="font-weight: bold;text-align:center">Reached Metar</td>
	                    <td width="10%" style="font-weight: bold;text-align:center">Reached Time</td>
	                    <td width="15%" style="font-weight: bold;text-align:center">Amount BDT</td>
	                    <td width="15%" style="font-weight: bold;text-align:center">Remarks</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
    		}
    		else if($type==4)
    		{
    			$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Expense Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
	                    <td width="15%" style="font-weight: bold;text-align:center" rowspan="2">Date</td>
	                    <td width="10%" style="font-weight: bold;text-align:center" rowspan="2">Purpose</td>
	                    <td width="35%" style="font-weight: bold;text-align:center" colspan="4">Destination</td>
	                    <td width="10%" style="font-weight: bold;text-align:center" rowspan="2">Mode</td>
	                    <td width="10%" style="font-weight: bold;text-align:center" rowspan="2">Break Down Bill Amount</td>
	                    <td width="10%" style="font-weight: bold;text-align:center" rowspan="2">Amount BDT</td>
	                    <td width="10%" style="font-weight: bold;text-align:center" rowspan="2">Remarks</td>
					</tr>
					<tr>
	                    <td style="font-weight: bold;text-align:center">From</td>
	                    <td style="font-weight: bold;text-align:center">Time out</td>
	                    <td style="font-weight: bold;text-align:center">To</td>
	                    <td style="font-weight: bold;text-align:center">Time In</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
    		}
    		else if($type==5)
    		{
    			$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Expense Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
	                    <td width="20%" style="font-weight: bold;text-align:center">From Date</td>
	                    <td width="15%" style="font-weight: bold;text-align:center">To Date</td>
	                    <td width="20%" style="font-weight: bold;text-align:center">Particulars</td>
	                    <td width="15%" style="font-weight: bold;text-align:center">Place</td>
	                    <td width="15%" style="font-weight: bold;text-align:center">Amount BDT</td>
	                    <td width="15%" style="font-weight: bold;text-align:center">Remarks</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
    		}
    		else
    		{
    			$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Expense Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="20%" style="font-weight: bold;text-align:center">Date</td>
                        <td width="20%" style="font-weight: bold;text-align:center">Movement Details</td>
                        <td width="20%" style="font-weight: bold;text-align:center">Mode of Transportaion</td>
                        <td width="20%" style="font-weight: bold;text-align:center">Amount BDT</td>
                        <td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
    		}
				foreach ($expense as $key) 
				{
					if($type==1)
					{
						$str.='<tr>';
							$str.='<td align="center">'.$key->activities_date.'</td>';
							$str.='<td align="center">'.$key->movement_details.'</td>';
							$str.='<td align="center">'.$key->move_of_transfortaion.'</td>';
							$str.='<td align="center">'.number_format($key->amount,2).'</td>';
							$str.='<td align="center">'.$key->remarks.'</td>';
						$str.='</tr>';
					}
					else if($type==2)
					{
						$str.='<tr>';
							$str.='<td align="center">'.$key->activities_date.'</td>';
							$str.='<td align="center">'.$key->particulars.'</td>';
							$str.='<td align="center">'.$key->place.'</td>';
							$str.='<td align="center">'.number_format($key->amount,2).'</td>';
							$str.='<td align="center">'.$key->remarks.'</td>';
						$str.='</tr>';
					}
					else if($type==3)
					{
						$str.='<tr>';
							$str.='<td align="center">'.$key->activities_date.'</td>';
							$str.='<td align="center">'.$key->description_of_journey.'</td>';
							$str.='<td align="center">'.$key->journey_time.'</td>';
							$str.='<td align="center">'.$key->journey_metar.'</td>';
							$str.='<td align="center">'.$key->reached_metar.'</td>';
							$str.='<td align="center">'.$key->reached_time.'</td>';
							$str.='<td align="center">'.number_format($key->amount,2).'</td>';
							$str.='<td align="center">'.$key->remarks.'</td>';
						$str.='</tr>';
					}
					else if($type==4)
					{
						$str.='<tr>';
							$str.='<td align="center">'.$key->activities_date.'</td>';
							$str.='<td align="center">'.$key->purpose.'</td>';
							$str.='<td align="center">'.$key->from.'</td>';
							$str.='<td align="center">'.$key->time_out.'</td>';
							$str.='<td align="center">'.$key->to.'</td>';
							$str.='<td align="center">'.$key->time_in.'</td>';
							$str.='<td align="center">'.$key->mode.'</td>';
							$str.='<td align="center">'.$key->breakdown_bill.'</td>';
							$str.='<td align="center">'.number_format($key->amount,2).'</td>';
							$str.='<td align="center">'.$key->remarks.'</td>';
						$str.='</tr>';
					}
					else if($type==5)
					{
						$str.='<tr>';
							$str.='<td align="center">'.$key->from_date.'</td>';
							$str.='<td align="center">'.$key->to_date.'</td>';
							$str.='<td align="center">'.$key->particulars.'</td>';
							$str.='<td align="center">'.$key->place.'</td>';
							$str.='<td align="center">'.number_format($key->amount,2).'</td>';
							$str.='<td align="center">'.$key->remarks.'</td>';
						$str.='</tr>';
					}
					else
					{
						$str.='<tr>';
							$str.='<td align="center">'.$key->activities_date.'</td>';
							$str.='<td align="center">'.$key->movement_details.'</td>';
							$str.='<td align="center">'.$key->move_of_transfortaion.'</td>';
							$str.='<td align="center">'.number_format($key->amount,2).'</td>';
							$str.='<td align="center">'.$key->remarks.'</td>';
						$str.='</tr>';
					}
					
				}

			$str.='</tbody>
				</table>
			</div>';

    	}
    	$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function download_court_enter_reimbursment($id)
    {
    	$c_info = $this->user_model->get_client_info();
    	$details = $this->Expenses_model->get_row_details_court_enter($id);
		$expense = $this->Expenses_model->get_expenese_details_court($id);
    	$bank_name = 'BRAC Bank PLC.';
    	
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
	        $styleBorderOutlineTopButtom = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						),														
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineButtom = array(
				'borders' => array(											
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineTop = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleThinBlackBorderOutlineleft = array(
				'borders' => array(	
						'left'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)												
					),
				);
			$styleThinBlackBorderOutlineright = array(
				'borders' => array(	
						'right'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleNoneBorder = array(
				'borders' => array(	
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_NONE
						)											
					),
				);
			$styleArray = array(
		    	'font'  => array(
		        'bold'  => true,
		        'size' => 16,
		        'color' => array('rgb' => '808080')
		    ));
		    $styleArray2 = array(
		    	'font'  => array(
		        'bold'  => true,
		        'size' => 14,
		        'name'  => 'Verdana'
		    ));
			
	       // $value=$row->OurCar.' '.number_format($row->Amount,2,'.',',')."</br>".'deal with '.$row->cptyname.' at '.$row->Rate.'% rate';
		    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); 
		    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
		    //$objPHPExcel->getActiveSheet()->setShowGridlines(False);
		    // Excel Image insert 
		    $objDrawing = new PHPExcel_Worksheet_Drawing();
		    $objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$objDrawing->setPath('images/login_images/'.$c_info->project_client_logo);
			$objDrawing->setCoordinates('A2');
			$objDrawing->setHeight(300);
			$objDrawing->setWidth(200);
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
			//end

	    	$rowNumber = 1;
	        $rowNumber++; 
	        $headings4 = array('Reimbursement Requisition Form');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('D'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(16);
	        //$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray);

	        $rowNumber++; 
	        $rowNumber++; 
	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('PIN No',$details->staff_pin),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Billing Month',$details->billing_month),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));

	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('Name',$details->employee_name),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Mobile Number',$details->mobile_no),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));

	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('Designation',$details->func_desig),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Account Number',$details->account_number),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->setCellValueExplicit(('E'.$rowNumber), $details->account_number, PHPExcel_Cell_DataType::TYPE_STRING);
	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('Department',$details->employee_type),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Unit/Branch Name',$details->base_office_name),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	        $objPHPExcel->getActiveSheet()->getStyle('A5:F'.$rowNumber)->applyFromArray($styleArray_border);
		    $objPHPExcel->getActiveSheet()->getStyle('A5:A'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'EBF1DE')));
		    $objPHPExcel->getActiveSheet()->getStyle('D5:D'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'EBF1DE')));

	        $rowNumber++;
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->fromArray(array('Accounts Head'),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $headings9 = array('Particulars','Expended','Limit','Reimbursed');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings9),NULL,'C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 

		    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'EBF1DE')));

	        $rowNumber++;
	        $data = array('Local Conveyance','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Local Conveyance/Daily Court Allowance','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Motorcycle Allowance ( None_EMI)','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Travel- (Meeting/Training/Others) Accommodation/DA/TA/Conveyance/Others','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Court Entertainment','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $total = 0;
	        
	        foreach ($expense as $key) 
	        {
	        	$total = $total+$key->amount;
	        	$data = array($key->activities_name,'',$key->remarks,number_format($key->amount,2),'','');
	        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
		        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $rowNumber++;
	        }
	        $data = array('Business Promotion:','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Entertainment of Guest/Judge/Magistrate/Others','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Business Development','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Others (Specify):','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Repair & Maintenance','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Paper & Stationery','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Utility/Courier/Printing/Postage/Others','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $rowNumber++;
	        $amount_in_word = convert_number($total);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Total Taka: '.$amount_in_word,'','',number_format($total,2)),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
		    $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		    $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $data = array('','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('A10:F'.$rowNumber)->applyFromArray($styleArray_border);

	        $rowNumber++;
	        $rowNumber++;
	        $rowNumber++;
	        $rowNumber++;
	        $rowNumber++;
	        $authorize = array('Initiator signing Details','Legal checker signing details ','Recommended By:','Recommended By:','Approved By:');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        $authorize = array('Name: '.$details->e_by_name,'Name: '.$details->v_by_name,'Md. Sabbir Abedin','','Rasheed Ahmed');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        $authorize = array('PIN: '.$details->e_by_pin,'PIN: '.$details->v_by_pin,'PIN:4402','','PIN:3979');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        $authorize = array($details->e_by_desig,$details->v_by_desig.',Litigation Mgt.','Sr. Manager-Litigation Mgt, HO','','Head of Legal & Recovery');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        
		    $objPHPExcel->setActiveSheetIndex(0);
		    $objPHPExcel->getActiveSheet()->setTitle('Reimbursement New'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        ob_clean();
	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="Reimbursement.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output');   
	        exit();
    

    }
    function bulk_operation($operation=NULL)
	{
		$operation_name='';
		if ($operation=='lawyer_apv') 
		{
			$operation_name='Lawyer Bill Approve';
		}
		if ($operation=='court_fee_apv') 
		{
			$operation_name='Court Fee Approve';
		}
		if ($operation=='court_enter_apv') 
		{
			$operation_name='Court Entertainment Bill Approve';
		}
		if ($operation=='paper_apv') 
		{
			$operation_name='Paper Bill Approve';
		}
		if(check_group(1) || check_group(2))
        {
            $region_data = $this->user_model->get_parameter_data('ref_legal_region', 'id', 'data_status = 1 AND id IN('.$this->session->userdata['ast_user']['legal_region'].')');
        }
        else
        {
            $region_data = $this->user_model->get_parameter_data('ref_legal_region', 'id', 'data_status = 1');
        }
		$data = array( 	
			   'legal_region' =>$region_data,
			   'operation' => $operation,
			   'operation_name' => $operation_name,
			   'pages'=> 'expenses/pages/bulk_operation',		   
			   );
		$this->load->view('expenses/form_layout',$data);
	}
	function load_bulk_data()
	{
		$this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
	    $module_name= $this->input->post('module_name');
		$str='';
		$grid_data=array();
	    if($module_name=='lawyer_apv')
	    {
	    	$grid_data=$this->Expenses_model->get_bulk_data_lawyer();
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input style="margin-left:7px" type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="15%" style="font-weight: bold;text-align:left">Status</th>
					<th width="20%" style="font-weight: bold;text-align:left">Lawyer Name</th>
					<th width="15%" style="font-weight: bold;text-align:left">Total Selectio</th>
					<th width="15%" style="font-weight: bold;text-align:left">Create By</th>
					<th width="20%" style="font-weight: bold;text-align:left">Create Date</th>
				</thead>
				<tbody>';	
		
			if(count($grid_data)<=0)
			{
				$str.='<tr><td colspan="7" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
				$str.='<input type="hidden" name="event_counter" id="event_counter" value="0">';
				$str.='</tbody></table></div>';
			}
			else{
				$i=1;
				foreach ($grid_data as $data) {
					$str.='<tr>';
					$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$data->id.'"></td>';
					$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
					$str.='<td align="left">'.$data->status.'</td>';
					$str.='<td align="left">'.$data->lawyer_name.'</td>';
					$str.='<td align="left">'.$data->total_selected.'</td>';
					$str.='<td align="left">'.$data->e_by.'</td>';
					$str.='<td align="left">'.$data->e_dt.'</td>';
					$str.='</tr>';
					$i++;
				}
				$str.='<input type="hidden" name="event_counter" id="event_counter" value="'.($i-1).'">';
				$str.='</tbody></table></div>';
				$str.='<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<tbody>';
				$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="6">Total Selected : <span id="selected_value">0</span></td></tr>';
			    $str.='</tbody></table>';
			}
	    }
	    if($module_name=='court_fee_apv')
	    {
	    	$grid_data=$this->Expenses_model->get_bulk_data_court_fee();
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input style="margin-left:7px" type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="15%" style="font-weight: bold;text-align:left">Status</th>
					<th width="20%" style="font-weight: bold;text-align:left">Lawyer Name</th>
					<th width="15%" style="font-weight: bold;text-align:left">Total Selectio</th>
					<th width="15%" style="font-weight: bold;text-align:left">Create By</th>
					<th width="20%" style="font-weight: bold;text-align:left">Create Date</th>
				</thead>
				<tbody>';	
		
			if(count($grid_data)<=0)
			{
				$str.='<tr><td colspan="7" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
				$str.='<input type="hidden" name="event_counter" id="event_counter" value="0">';
				$str.='</tbody></table></div>';
			}
			else{
				$i=1;
				foreach ($grid_data as $data) {
					$str.='<tr>';
					$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$data->id.'"></td>';
					$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
					$str.='<td align="left">'.$data->status.'</td>';
					$str.='<td align="left">'.$data->lawyer_name.'</td>';
					$str.='<td align="left">'.$data->total_selected.'</td>';
					$str.='<td align="left">'.$data->e_by.'</td>';
					$str.='<td align="left">'.$data->e_dt.'</td>';
					$str.='</tr>';
					$i++;
				}
				$str.='<input type="hidden" name="event_counter" id="event_counter" value="'.($i-1).'">';
				$str.='</tbody></table></div>';
				$str.='<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<tbody>';
				$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="6">Total Selected : <span id="selected_value">0</span></td></tr>';
			    $str.='</tbody></table>';
			}
	    }
	    if($module_name=='court_enter_apv')
	    {
	    	$grid_data=$this->Expenses_model->get_bulk_data_court_enter();
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input style="margin-left:7px" type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="15%" style="font-weight: bold;text-align:left">Status</th>
					<th width="20%" style="font-weight: bold;text-align:left">Employee Type</th>
					<th width="15%" style="font-weight: bold;text-align:left">Staff Pin</th>
					<th width="15%" style="font-weight: bold;text-align:left">Employee Nam</th>
					<th width="20%" style="font-weight: bold;text-align:left">Create By</th>
				</thead>
				<tbody>';	
		
			if(count($grid_data)<=0)
			{
				$str.='<tr><td colspan="7" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
				$str.='<input type="hidden" name="event_counter" id="event_counter" value="0">';
				$str.='</tbody></table></div>';
			}
			else{
				$i=1;
				foreach ($grid_data as $data) {
					if (check_group($data->verifier_group_id)) {
						$str.='<tr>';
						$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$data->id.'"></td>';
						$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
						$str.='<td align="left">'.$data->status.'</td>';
						$str.='<td align="left">'.$data->employee_type.'</td>';
						$str.='<td align="left">'.$data->staff_pin.'</td>';
						$str.='<td align="left">'.$data->employee_name.'</td>';
						$str.='<td align="left">'.$data->e_dt.'</td>';
						$str.='</tr>';
						$i++;
					}
					
				}
				$str.='<input type="hidden" name="event_counter" id="event_counter" value="'.($i-1).'">';
				$str.='</tbody></table></div>';
				$str.='<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<tbody>';
				$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="6">Total Selected : <span id="selected_value">0</span></td></tr>';
			    $str.='</tbody></table>';
			}
	    }
	    if($module_name=='paper_apv')
	    {
	    	$grid_data=$this->Expenses_model->get_bulk_data_paper();
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input style="margin-left:7px" type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="15%" style="font-weight: bold;text-align:left">Status</th>
					<th width="20%" style="font-weight: bold;text-align:left">Proposed Type</th>
					<th width="15%" style="font-weight: bold;text-align:left">Loan AC</th>
					<th width="15%" style="font-weight: bold;text-align:left">Account Name</th>
					<th width="20%" style="font-weight: bold;text-align:left">Create By</th>
				</thead>
				<tbody>';	
		
			if(count($grid_data)<=0)
			{
				$str.='<tr><td colspan="7" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
				$str.='<input type="hidden" name="event_counter" id="event_counter" value="0">';
				$str.='</tbody></table></div>';
			}
			else{
				$i=1;
				foreach ($grid_data as $data) {
					if (check_group($data->verifier_group_id)) {
						$str.='<tr>';
						$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$data->id.'"></td>';
						$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
						$str.='<td align="left">'.$data->status.'</td>';
						$str.='<td align="left">'.$data->proposed_type.'</td>';
						$str.='<td align="left">'.$data->loan_ac.'</td>';
						$str.='<td align="left">'.$data->ac_name.'</td>';
						$str.='<td align="left">'.$data->e_dt.'</td>';
						$str.='</tr>';
						$i++;
					}
					
				}
				$str.='<input type="hidden" name="event_counter" id="event_counter" value="'.($i-1).'">';
				$str.='</tbody></table></div>';
				$str.='<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<tbody>';
				$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="6">Total Selected : <span id="selected_value">0</span></td></tr>';
			    $str.='</tbody></table>';
			}
	    }
		$var =array(
				"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function bulk_acktion()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Expenses_model->bulk_acktion();
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
			else if(isset($_POST['typebulk'])){$row[]='';}
			else{$row[]='';}
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
	function download_staff_memo($id)
    {
    	$c_info = $this->user_model->get_client_info();
    	$details = $this->Expenses_model->get_xl_details_staff_conv($id);
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
	       // $value=$row->OurCar.' '.number_format($row->Amount,2,'.',',')."</br>".'deal with '.$row->cptyname.' at '.$row->Rate.'% rate';
		    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12); 
		    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(15);
	    	$rowNumber = 1;
	        $headings4 = array('SL No.','Name','PIN','Bill Month',
	        'Region','District','BBL Salary Acount Number','Cell No.','Loc_Conv.[0000050630000010]',
	        'MTC_Allow[0000050630000010]','TA/DA/Accomodation(Official visit purposr)[0000050630000009]','TA/DA/Accomodation (Transfer Purpose) [0000050630000103]','Travelling [0000050630000130]',
	        'DA [0000050630000118]','Accommodation [0000050630000129]','Stationery[0000050630000120]','Photocopy[0000050630000120]',
	        'Courier[0000050630000005]','Miscelaneous[0000050630000077]','Cleaner[0000050630000037]','Security[0000050620000015]','Rep_maintance[0000050630000037]','Grand Total','Remarks');//,strtotime($dealdate)));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'C0C0C0')));
	        $objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '92CDDC')));
	        $objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber.':O'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F79646')));
	        $objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber.':S'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FFFF00')));
	        $objPHPExcel->getActiveSheet()->getStyle('T'.$rowNumber.':V'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FFFF99')));
	        $objPHPExcel->getActiveSheet()->getStyle('W'.$rowNumber.':W'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '99CCFF')));
	        $objPHPExcel->getActiveSheet()->getStyle('X'.$rowNumber.':X'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FABF8F')));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->applyFromArray($styleArray_border);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setWrapText(true);
	        $rowNumber++;  
	        $sn=0;
	        $amount = 0;
	        if (!empty($details)) 
	    	{
	    		$total1="";
	    		$total2="";
	    		$total3="";
	    		$total4="";
	    		$total5="";
	    		$total6="";
	    		$total7="";
	    		$total8="";
	    		$total9="";
	    		$total10="";
	    		$total11="";
	    		$total12="";
	    		$total13="";
	    		$total14="";
	    		$total15="";
	    		$total16="";
	    		foreach($details as $row)
	    		{
	    			$sn++;
	    			$amount = $amount+$row->amount;
				    if($row->conv_type==1)
				    {
				    	$total1=$total1+$row->amount;
				    }
				    else if($row->conv_type==3)
				    {
				    	$total3=$total3+$row->amount;
				    }
				    else if($row->conv_type==4)
				    {
				    	$total4=$total4+$row->amount;
				    }
				    else if($row->conv_type==5)
				    {
				    	$total5=$total5+$row->amount;
				    }
	    			$objPHPExcel->getActiveSheet()->fromArray(array(
                        $sn,
                        $row->staff_name,
                        $row->staff_pin,
                        $row->billing_month.'\''.$row->year,
                        $row->region,
                        $row->district_name,
                        $row->bank_ac,
                        $row->mobile_number,
                        ($row->conv_type==1)?$row->amount:'',
                        ($row->conv_type==3)?$row->amount:'',
                        '',
                        ($row->conv_type==2)?$row->amount:'',
                        ($row->conv_type==4)?$row->amount:'',
                        '',
                        ($row->conv_type==5)?$row->amount:'',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        $row->amount,
                        ''
                        ),NULL,'A'.$rowNumber);
	    			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('G'.$rowNumber), $row->account_number, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->applyFromArray($styleArray_border);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setWrapText(true);
			        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    
                    $rowNumber++;
	    		}
	    	}
	    	$headings1 = array('','GRAND  TOTAL: ','','','','','','',$total1,$total2,$total3,$total4,$total5,$total6,$total7,$total8,$total9,$total11,$total12,$total13,$total14,$total15,$amount,'');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':H'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'C0C0C0')));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
		    $objPHPExcel->setActiveSheetIndex(0);
		    $objPHPExcel->getActiveSheet()->setTitle('Staff Conveyence Memo'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        ob_clean();
	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="StaffConv.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output');   
	        exit();
    

    }
    function download_staff_reimbursment($id)
    {
    	$c_info = $this->user_model->get_client_info();
    	$details = $this->Expenses_model->get_row_details_staff_conv_for_memo($id);
		$bill_info = $this->Expenses_model->get_total_expenses_staff_conv($id);
    	$bank_name = 'BRAC Bank PLC.';
    	$total = 0;
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
	        $styleBorderOutlineTopButtom = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						),														
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineButtom = array(
				'borders' => array(											
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineTop = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleThinBlackBorderOutlineleft = array(
				'borders' => array(	
						'left'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)												
					),
				);
			$styleThinBlackBorderOutlineright = array(
				'borders' => array(	
						'right'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleNoneBorder = array(
				'borders' => array(	
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_NONE
						)											
					),
				);
			$styleArray = array(
		    	'font'  => array(
		        'bold'  => true,
		        'size' => 16,
		        'color' => array('rgb' => '808080')
		    ));
		    $styleArray2 = array(
		    	'font'  => array(
		        'bold'  => true,
		        'size' => 14,
		        'name'  => 'Verdana'
		    ));
			
	       // $value=$row->OurCar.' '.number_format($row->Amount,2,'.',',')."</br>".'deal with '.$row->cptyname.' at '.$row->Rate.'% rate';
		    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); 
		    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
		    //$objPHPExcel->getActiveSheet()->setShowGridlines(False);
		    // Excel Image insert 
		    $objDrawing = new PHPExcel_Worksheet_Drawing();
		    $objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$objDrawing->setPath('images/login_images/'.$c_info->project_client_logo);
			$objDrawing->setCoordinates('A2');
			$objDrawing->setHeight(300);
			$objDrawing->setWidth(200);
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
			//end

	    	$rowNumber = 1;
	        $rowNumber++; 
	        $headings4 = array('Reimbursement Requisition Form');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('D'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(16);
	        //$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray);

	        $rowNumber++; 
	        $rowNumber++; 
	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('PIN No',$details->staff_pin),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Billing Month',$details->billing_month),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));

	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('Name',$details->staff_name),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Mobile Number',$details->mobile_number),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));

	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('Designation',$details->functional_desig),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Account Number',$details->bank_ac),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->setCellValueExplicit(('E'.$rowNumber), $details->bank_ac, PHPExcel_Cell_DataType::TYPE_STRING);
	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('Department','BBL'),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Unit/Branch Name',''),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	        $objPHPExcel->getActiveSheet()->getStyle('A5:F'.$rowNumber)->applyFromArray($styleArray_border);
		    $objPHPExcel->getActiveSheet()->getStyle('A5:A'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'EBF1DE')));
		    $objPHPExcel->getActiveSheet()->getStyle('D5:D'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'EBF1DE')));

	        $rowNumber++;
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->fromArray(array('Accounts Head'),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $headings9 = array('Particulars','Expended','Limit','Reimbursed');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings9),NULL,'C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 

		    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'EBF1DE')));

	        $rowNumber++;
	        $local_conv = 0;
	        $others = 0;
	        foreach ($bill_info as $key) {
	        	$total = $total+$key->amount;
	        	if($key->conv_type==1)
	        	{
	        		$local_conv = $key->amount;
	        	}
	        	else if($key->conv_type==3)
	        	{
	        		$motor_cycle = $key->amount;
	        	}
	        	else
	        	{
	        		$others = $key->amount;
	        	}
	        }
	        $data = array('Local Conveyance/Daily Court Allowance','','',number_format($local_conv,2),'','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Motorcycle Allowance ( None_EMI)','','',number_format($motor_cycle,2),'','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Travel- (Meeting/Training/Others) Accommodation/DA/TA/Conveyance/Others','','',number_format($others,2),'','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $arrayName = array('Court Entertainment',
	        	'Business Promotion:',
	        	'Entertainment of Guest/Judge/Magistrate/Others',
	        	'Business Development',
	        	'Others (Specify):',
	        	'Repair & Maintenance',
	        	'Paper & Stationery',
	        	'Utility/Courier/Printing/Postage/Others',
	        	'Appeal/Bail Money Withdraw' );
	        for($i=0;$i<count($arrayName);$i++)
	        {
	        	$data = array($arrayName[$i],'','','','','');
	        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
		        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        // $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $rowNumber++;
	        }
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $rowNumber++;
	        $amount_in_word = convert_number($total);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Total Taka: '.$amount_in_word,'','',number_format($total,2)),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
		    $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		    $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $data = array('','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('A10:F'.$rowNumber)->applyFromArray($styleArray_border);

	        $rowNumber++;
	        $rowNumber++;
	        $rowNumber++;
	        $rowNumber++;
	        $rowNumber++;
	        $authorize = array('Initiator signing Details','Legal checker signing details ','Recommended By:','Recommended By:','Approved By:');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        $authorize = array('Name: '.$details->e_by_name,'Name: '.$details->v_by_name,'Md. Sabbir Abedin','','Rasheed Ahmed');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        $authorize = array('PIN: '.$details->e_by_pin,'PIN: '.$details->v_by_pin,'PIN:4402','','PIN:3979');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        $authorize = array($details->e_by_desig.',Litigation Mgt.',$details->v_by_desig.',Litigation Mgt.','Sr. Manager-Litigation Mgt, HO','','Head of Legal & Recovery');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        
		    $objPHPExcel->setActiveSheetIndex(0);
		    $objPHPExcel->getActiveSheet()->setTitle('Reimbursement New'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        ob_clean();
	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="Reimbursement.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output');   
	        exit();
    

    }
    function download_court_enter_topsheet($id)
    {
    	$c_info = $this->user_model->get_client_info();
    	$details = $this->Expenses_model->get_xl_details_court_enter($id);
    	$row_details = $this->Expenses_model->get_row_details_court_enter($id);
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
	       // $value=$row->OurCar.' '.number_format($row->Amount,2,'.',',')."</br>".'deal with '.$row->cptyname.' at '.$row->Rate.'% rate';
		    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12); 
		    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
	    	$rowNumber = 1;
	        $headings1 = array('Top Sheet of Court Entertainment of Litigation Management');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':M'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':M'.$rowNumber)->getFont()->setSize(16);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;
	        $headings4 = array('SL No.','Name','PIN','Functional Designation',
	        'Grade','Cell Number','Employee  Account Number','Case Account Details','Base Office','Region','Billing Month','Entertainment Bill','Remarks');//,strtotime($dealdate)));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':M'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':M'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FCD5B4')));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;  
	        $sn=0;
	        $amount = 0;
	        if (!empty($details)) 
	    	{
	    		foreach($details as $row)
	    		{
	    			$sn++;
	    			$amount = $amount+$row->amount;
				    
	    			$objPHPExcel->getActiveSheet()->fromArray(array(
                        $sn,
                        $row->vendor_name,
                        $row->vendor_pin,
                        $row->functional_desig,
                        $row->job_grade,
                        $row->mobile_no,
                        $row->account_number,
                        '',
                        $row->base_office_name,
                        $row->legal_region,
                        $row->billing_month,
                        $row->amount,
                        ''
                        ),NULL,'A'.$rowNumber);
	    			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('G'.$rowNumber), $row->account_number, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleArray_border);
                    //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':M'.$rowNumber)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING);
                    //$objPHPExcel->getActiveSheet()->setCellValueExplicit("G".$rowNumber, PHPExcel_Cell_DataType::TYPE_STRING);
                    
                    $rowNumber++;
	    		}
	    	}
	    	$headings1 = array('Total Selected Amount : '.$amount);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':M'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $rowNumber++;
	        $headings1 = array('Total Selected Amount : '.convert_number($amount));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':M'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $rowNumber++;
	        $rowNumber++;

	        $headings1 = array('Prepared By','','','Checked By','','','Approved By','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':C'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('D'.$rowNumber.':F'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':I'.$rowNumber); 
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $rowNumber++;
	        $headings1 = array($row_details->e_by_name.'('.$row_details->e_by_pin.')','','',$row_details->v_by_name.'('.$row_details->v_by_pin.')','','','Barrister Rasheed Ahmed (3979)','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':C'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('D'.$rowNumber.':F'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':I'.$rowNumber); 
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $rowNumber++;
	        $headings1 = array($row_details->e_by_desig,'','',$row_details->v_by_desig,'','','Head of Legal & Recovery Division','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':C'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('D'.$rowNumber.':F'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':I'.$rowNumber); 
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $rowNumber++;
	        $headings1 = array('Legal & Recovery  Division','','','Legal & Recovery  Division','','','Legal & Recovery  Division','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':C'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('D'.$rowNumber.':F'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':I'.$rowNumber); 
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $rowNumber++;
		    $objPHPExcel->setActiveSheetIndex(0);
		    $objPHPExcel->getActiveSheet()->setTitle('Court Entertainment Memo'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        ob_clean();
	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="CourtEntertainment.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output');   
	        exit();
    

    }
}