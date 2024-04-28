<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_suit_file extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Edit_suit_file_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
		$this->load->model('Legal_file_process_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
					'final_remarks' => $this->user_model->get_parameter_data('ref_final_remarks','id','data_status = 1'),
					'case_sts' => $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
					'sys_config'=> $this->User_info_model->upr_config_row(),
					
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'case_name' => $this->User_model->get_parameter_data('ref_case_name','name','data_status = 1'),

					// new
					'region' => $this->User_model->get_parameter_data('ref_region','name','data_status = 1'),
					'territory' => $this->User_model->get_parameter_data('ref_territory','name','data_status = 1'),
					'cma_district' => $this->User_model->get_parameter_data('ref_district','name','data_status = 1'),
					'loan_segment' => $this->User_model->get_parameter_data('ref_loan_segment','name','data_status = 1'),
					'district' => $this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1'),



					'pages'=> 'edit_suit_file/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Edit_suit_file_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function from($id=NULL,$editrow=NULL)
	{

		$data = array(
					 'option' => '',
					 'result' => $result,
					 'id' => $id,
					 'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
					 'case_sts' => $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
					 'pages'=> 'edit_suit_file/pages/form',
					 'editrow' => $editrow,
					 'acLength' => $acPartStr
					 );
		$this->load->view('edit_suit_file/form_layout',$data);
	}
	function get_filing_info_edit()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$row_info =$this->Legal_file_process_model->get_add_action_data_suit($id);
		if (!empty($row_info)) {
			$Message='ok';
		}
		else{
			$Message='No Data';
		}
		$plaintiff =$this->User_model->get_parameter_data('users_info','name','data_status = 1  AND admin_status<>2 AND block_status = 0');
		$case_sts =$this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1');
		$lawyer = $this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1');
		$court =$this->User_model->get_parameter_data('ref_court','name','data_status = 1');
		$district = $this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1');
		$court_activities = $this->User_model->get_parameter_data('ref_court_fee_activities','name','data_status = 1');
		$final_remarks = $this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1');
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row_info;
		$var['plaintiff']=$plaintiff;
		$var['case_sts']=$case_sts;
		$var['final_remarks']=$final_remarks;
		$var['lawyer']=$lawyer;
		$var['court']=$court;
		$var['district']=$district;
		$var['Message']=$Message;
		echo json_encode($var);
	}
	function add_edit_suit_filling()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Edit_suit_file_model->add_edit_suit_filling_after_verify();
			
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
}
?>
