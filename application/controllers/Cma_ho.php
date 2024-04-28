<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cma_ho extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Cma_ho_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('Cma_process_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'cma_ho/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}

	function grid()
	{
		$this->load->model('Cma_ho_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Cma_ho_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function edit_facility($id=NULL,$proposed_type=NULL,$editrow=NULL)
	{
		if ($proposed_type==1) {
			$type='Loan';
		}else{$type='Card';}
		$result = $this->Cma_process_model->get_recommend_info($id);
		if ($type=='Loan') {
			$facility_info = $this->Cma_ho_model->get_facility($id);
		}
		else{
			$facility_info = $this->Cma_ho_model->get_edit_card_facility($id);
		}
		$doc_files = $this->Cma_process_model->get_cma_doc_files($id);
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'doc_files' => $doc_files,
				   'facility_info' => $facility_info,
				   'cma_guarantor' => $this->Cma_process_model->get_guarantor_info('edit',$id),
				   'lawyer'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
				   'facility_name'=>$this->User_model->get_parameter_data('ref_facility_name','name','data_status = 1'),
				   'id' => $id,
				   'cl'=>$this->User_model->get_parameter_data('ref_cl','name','data_status = 1'),
				   'proposed_type' => $type,
				   'pages'=> 'cma_ho/pages/edit_facility_form',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('cma_ho/form_layout',$data);
	}
	function fromcheck($id=NULL,$editrow=NULL,$proposed_type=NULL,$sec_sts=NULL)
	{
		$link_id=179;
		if ($proposed_type==1) {
			$type='Loan';
		}else{$type='Card';}
		$result = $this->Cma_process_model->get_recommend_info($id);
		if ($type=='Loan') {
			$facility_info = $this->Cma_ho_model->get_facility($id);
		}
		else{
			$facility_info = $this->Cma_ho_model->get_card_facility($id);
		}
		$doc_files = $this->Cma_process_model->get_cma_doc_files($id);
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'doc_files' => $doc_files,
				   'facility_info' => $facility_info,
				   'checker_info' => $this->User_info_model->get_checker_data($link_id,'11'),
				   'cma_guarantor' => $this->Cma_process_model->get_guarantor_info('edit',$id),
				   'lawyer'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
				   'facility_name'=>$this->User_model->get_parameter_data('ref_facility_name','name','data_status = 1'),
				   'id' => $id,
				   'proposed_type' => $type,
				   'sec_sts' => $sec_sts,
				   'pages'=> 'cma_ho/pages/form_check',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('cma_ho/form_layout',$data);
	}
	function formverify($id=NULL,$editrow=NULL,$proposed_type=NULL)
	{
		if ($proposed_type==1) {
			$type='Loan';
		}else{$type='Card';}
		$result = $this->Cma_process_model->get_recommend_info($id);
		if ($type=='Loan') {
			$facility_info = $this->Cma_ho_model->get_facility($id);
		}
		else{
			$facility_info = $this->Cma_ho_model->get_card_facility($id);
		}
		$bidder_info = $this->Cma_ho_model->get_bidder($id);
		$doc_files = $this->Cma_process_model->get_cma_doc_files($id);
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'doc_files' => $doc_files,
				   'facility_info' => $facility_info,
				   'bidder_info' => $bidder_info,
				   'cma_guarantor' => $this->Cma_process_model->get_guarantor_info('edit',$id),
				   'facility_name'=>$this->User_model->get_parameter_data('ref_facility_name','name','data_status = 1'),
				   'id' => $id,
				   'proposed_type' => $type,
				   'pages'=> 'cma_ho/pages/form_verify',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('cma_ho/form_layout',$data);
	}
	function bulk_operation($operation=NULL)
	{
		$operation_name='';
		if ($operation=='ack') 
		{
			$operation_name='Acknowledgement';
		}
		if ($operation=='sta') 
		{
			$operation_name='Send To Approver';
		}
		if ($operation=='apv') 
		{
			$operation_name='Approve';
		}
		if ($operation=='sthoops') 
		{
			$operation_name='Send To HOOPS';
		}
		$region = $this->user_model->get_parameter_data('ref_legal_region','name',"data_status = '1'");
		$req_type = $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'");
		$territory = $this->user_model->get_parameter_data('ref_territory','name',"data_status = '1'");
		$unit_office = $this->user_model->get_parameter_data('ref_unit_office','name',"data_status = '1'");
		$district = $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'");
		$loan_segment = $this->user_model->get_parameter_data('ref_loan_segment','name',"data_status = '1'");
		$data = array( 	
			   'req_type' => $req_type,
			   'region' => $region,
			   'territory' => $territory,
			   'unit_office' => $unit_office,
			   'district' => $district,
			   'loan_segment' => $loan_segment,
			   'operation' => $operation,
			   'operation_name' => $operation_name,
			   'pages'=> 'cma_ho/pages/bulk_operation',		   
			   );
		$this->load->view('cma_ho/form_layout',$data);
	}
	function load_bulk_data()
	{
		$this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
	    $grid_data=$this->Cma_ho_model->get_bulk_data();
	    $operation= $this->input->post('operation');
	    if ($operation=='sta') 
	    {
	    	$link_id=175;
	    	$checker=$this->User_info_model->get_checker_data($link_id,'11');
	    }
	    else if ($operation=='sthoops') 
	    {
	    	$link_id=230;
			$checker = $this->User_info_model->get_checker_data($link_id,'18');
	    }
	    else{
	    	$checker=array();
	    }
		$str='';
		$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
		<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<thead>
				<th width="2%"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
				<th width="3%"  style="font-weight: bold;text-align:center">P</th>
				<th width="10%" style="font-weight: bold;text-align:left">Serial</th>
				<th width="10%" style="font-weight: bold;text-align:left">Protfolio</th>
				<th width="15%" style="font-weight: bold;text-align:left">Loan A/C or Card No</th>
				<th width="10%" style="font-weight: bold;text-align:left">Region</th>
				<th width="10%" style="font-weight: bold;text-align:left">Territory</th>
				<th width="10%" style="font-weight: bold;text-align:left">District</th>
				<th width="10%" style="font-weight: bold;text-align:left">Unit Office</th>
				<th width="10%" style="font-weight: bold;text-align:left">Rec By</th>
				<th width="10%" style="font-weight: bold;text-align:left">Rec Date Time</th>
			</thead>
			<tbody>';	
	
		if(count($grid_data)<=0)
		{
			$str.='<tr><td colspan="11" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
			$str.='<input type="hidden" name="event_counter" id="event_counter" value="0">';
			$str.='</tbody></table></div>';
		}
		else{
			$i=1;
			foreach ($grid_data as $data) {
				$str.='<tr>';
				$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="event_id_'.$i.'" id="event_id_'.$i.'" value="'.$data->id.'"></td>';
				$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
				$str.='<td align="left">'.$data->sl_no.'</td>';
				$str.='<td align="left">'.$data->loan_segment.'</td>';
				$str.='<td align="left">'.$data->loan_ac.'</td>';
				$str.='<td align="left">'.$data->region_name.'</td>';
				$str.='<td align="left">'.$data->territory_name.'</td>';
				$str.='<td align="left">'.$data->district_name.'</td>';
				$str.='<td align="left">'.$data->unit_office_name.'</td>';
				$str.='<td align="left">'.$data->rec_by.'</td>';
				$str.='<td align="left">'.$data->rec_dt.'</td>';
				$str.='</tr>';
				$i++;
			}
			$str.='<input type="hidden" name="event_counter" id="event_counter" value="'.($i-1).'">';
			$str.='</tbody></table></div>';
			$str.='<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<tbody>';
			if ($operation=='sta') 
			{
				$str.='<tr>';
				$str.='<td width="10%" style="font-weight: bold;text-align:right">Select HOLM<span style="color:red">*</span></td>';
				$str.='<td width="10%" align="center"><div id="holm" name="holm" style="padding-left: 3px;margin: 0 auto;" tabindex="2"></div></td>';
				$str.='<td width="10%" align="center"></td>';
				$str.='</tr>';
			}
			if ($operation=='sthoops') 
			{
				$str.='<tr>';
				$str.='<td width="10%" style="font-weight: bold;text-align:right">Select HOOPS<span style="color:red">*</span></td>';
				$str.='<td width="10%" align="center"><div id="hoops" name="hoops" style="padding-left: 3px;margin: 0 auto;" tabindex="2"></div></td>';
				$str.='<td width="10%" align="center"></td>';
				$str.='</tr>';
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="3">Total Selected : <span id="selected_value">0</span></td></tr>';
		    $str.='</tbody></table>';
		}
		$var =array(
				"str"=>$str,
				"checker"=>$checker,
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
			$id = $this->Cma_ho_model->bulk_acktion();
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
	function delete_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Cma_ho_model->delete_action();
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
			else if(isset($_POST['typebulk'])){$row[]='';}
			else{$row=$this->Cma_ho_model->get_add_action_data($id);}
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
	function update_facility()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Cma_ho_model->update_facility();
		}
		else{
			$text[]="Session out, login required";
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Cma_ho_model->get_add_action_data($id);
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
			if ($this->input->post('id') != ""){
				//$details=$this->Cma_ho_model->get_ptp_info($this->input->post('id'));
				$details=array();
				$var =array(
								"details"=>$details,
								"csrf_token"=>$csrf_token
								);
				echo json_encode($var);
	    	}
	}


}
?>
