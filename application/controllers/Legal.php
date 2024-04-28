<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Legal extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Legal_model', '', TRUE);
		$this->load->model('Cma_ho_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('Auction_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'legal/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function grid()
	{
		$this->load->model('Legal_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Legal_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);



		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function delete_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Legal_model->delete_action();
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
			else if($this->input->post("type")=='delete'){$row[]='';	}
			else{$row=$this->Legal_model->get_add_action_data_auction($id);}
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
	function response($id=NULL,$editrow=NULL,$cma_id=NULL)
	{
		$this->Common_model->delete_tempfile();
		$result = $this->Cma_process_model->get_recommend_info($cma_id);
		$condition="AND legal_sent_sts='1'";
	    $doc_files = $this->Cma_process_model->get_cma_doc_files($cma_id,$condition);
		$data = array(
					 'option' => '',
					 'cma_id'=>$cma_id,
					 'id'=>$id,
			 		 'doc_files' => $doc_files,
					 'edit_row'=>$editrow,
					 'cma_guarantor' => $this->Cma_process_model->get_guarantor_info('edit',$cma_id),
					 'lawyer'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
					 'facility_info' => $this->Cma_ho_model->get_facility($cma_id),
					 'cma_mortgage' => $this->Auction_model->get_mortgage_info_by_cma($cma_id),
			 	     'cma_mortgage_security' => $this->Auction_model->get_mortgage_security($cma_id),
					 'result'=>$result,
					 'pages'=> 'legal/pages/response_form'
					 );
		$this->load->view('auction/form_layout',$data);
	}
}

?>