<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Holiday extends CI_Controller {

	function __construct()
    {
        parent::__construct();	
		
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');		
		$this->load->model('Holiday_model', '', TRUE);
	}
	
	function view ($menu_group,$menu_cat)
	{		
		$data = array( 	
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'holiday/pages/grid',			   			   
				   	'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function grid()
	{		
		$this->load->model('Holiday_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;
		
		$result=$this->Holiday_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
				
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],		   
		   'Rows' => $result['Rows']
		);		
		echo json_encode($data);		
	}
		
	function from($add_edit='add',$id=NULL,$year=NULL)
	{
		$result=$this->Holiday_model->get_info($id,$year);
		
		$cName=$this->Holiday_model->get_info_country($id);
		
		$date = '';
		
		if(is_object($result)){
			$year = $result->years;
			$date = $result->dates;
		}

		if($year == ''){
			$year = date('Y');
		}
		if($date == ''){
			$date = '01/01/1900';
		}
			
		$data = array( 	
				   'option' => '',
				   'add_edit' => $add_edit, 
				   'Year' => $year,
				   'Date' => implode("','", explode(',', $date)),
				   'datevalue' => $date,
				   'id' => $id,
				   'cName' => $cName,
				   'pages'=> 'holiday/pages/form'
				   );
		$this->load->view('holiday/pages/form',$data);
	}
	
		
	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		$text='';
		if($this->session->userdata['ast_user']['login_status'])
		{
			$this->Holiday_model->add_edit_action($add_edit,$edit_id);
			
		}
		else{
			$text="Session out, login required";
		}	
		
		$Message='';
		if($text==''){
			$Message='OK';
			
		}else{
			$Message=$text;	
		}
		
		$var =array();  
		$var['Message']=$Message;
		$var['csrf_token']=$this->security->get_csrf_hash();
		echo json_encode($var);
	}
	
	
}
?>