<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_group extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Menu_group_model', '', TRUE);
		// $this->load->library("security");
	}

	function view ($menu_group,$menu_cat)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'menu_group/pages/grid',
				   	'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function grid()
	{
		$this->load->model('Menu_group_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result=$this->Menu_group_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
		// print_r($result);exit;
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}

	function from($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$result=$this->Menu_group_model->get_menu_group_info($add_edit,$id);

		$data = array(
				   'option' => '',
				   'add_edit' => $add_edit,
				   'result' => $result,
				   'id' => $id,
				   'pages'=> 'menu_group/pages/form',
				   'editrow' => $editrow
				   );
		//print_r($result);
		$this->load->view('menu_group/form_layout',$data);
	}
	function duplicate_name($field_name=NULL,$add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		if ($this->input->post('val') != ""){
			$num_row=$this->Menu_group_model->duplicate_name($field_name,$this->input->post('val'),$edit_id);
			$var =
			array(
				"csrf_token"=>$csrf_token,
				"Message"=>"",
				"Status"=>$num_row>0?'duplicate':'ok'
			);
			echo json_encode($var);
    	}
	}
	function duplicate_code($add_edit=NULL,$edit_id=NULL)
	{
		if ($this->input->post('val') != ""){
			$num_row=$this->Menu_group_model->duplicate_code($this->input->post('val'),$add_edit,$edit_id);
			$var =
			array(
				"Message"=>"",
				"Status"=>$num_row>0?'duplicate':'ok'
			);
			echo json_encode($var);
    	}
	}

	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		sleep(1);
		
		$id=$this->Menu_group_model->add_edit_action($add_edit,$edit_id);
		if($id!='00'){
				$Message='OK';
				
			}else{
				$Message='Something went wrong!';
			}
		$var =array();
		$var['Message']=$Message;
		$var['Status']=$id;
		echo json_encode($var);
	}
	
	function delete_action($d_v=NULL)
	{
		sleep(1);
		
		$csrf_token = $this->security->get_csrf_hash();
		$jTableResult = array(
				"csrf_token"=>$csrf_token
			);
			
		$isExistsArr = $this->Menu_group_model->check_menu_cat_exists($this->input->post('id'));
		//echo '<pre>'; print_r($isExistsArr); // exit;
		
		$isExists = 0;
		
		if(!empty($isExistsArr))
		{
			$isExists = 1;
			$jTableResult['status'] = "error";
			$jTableResult['errorMsgs'] = "You can not delete this menu group because ".count($isExistsArr)." menu cat(s) exists in this menu group.";
		}
		else
		{
			$isExists = 0;
			$id = $this->Menu_group_model->delete_action();
			//$id = 0;
			if($id != 0)
			{
				$jTableResult['status'] = "success";
				$jTableResult['errorMsgs'] = 0;
			}
			else
			{
				$jTableResult['status'] = "error";
				$jTableResult['errorMsgs'] = "Something is wrong";		
			}
		}
		echo json_encode($jTableResult);
	}
}
?>