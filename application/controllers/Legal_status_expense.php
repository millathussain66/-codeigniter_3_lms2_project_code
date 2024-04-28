<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Legal_status_expense extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Legal_status_expense_model', '', TRUE);
		$this->load->model('Authorization_ho_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('Legal_file_process_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);

	}

	function view ($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{
		$module_name = "case_status";//Module Name for Suit File
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'module_name'=> $module_name,
					'menu_links'=> $menu_links,
					'sys_config'=> $this->User_info_model->upr_config_row(),
					'expense_type' => $this->User_model->get_parameter_data('ref_expense_type','name','data_status = 1 AND id IN(1)'),
					'final_remarks' =>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1'),
					'case_sts' => $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'pages'=> 'legal_status_expense/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function grid()
	{
		$this->load->model('Legal_status_expense_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Legal_status_expense_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function bulk_operation($operation=NULL)
	{
		$operation_name='';
		if ($operation=='apv') 
		{
			$operation_name='Approve';
		}
		$str_where="";
		if(check_group(1))
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
			   'pages'=> 'legal_status_expense/pages/bulk_operation',		   
			   );
		$this->load->view('legal_status_expense/form_layout',$data);
	}
	function load_bulk_data()
	{
		$this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
	    $grid_data=$this->Legal_status_expense_model->get_bulk_data();
	    $operation= $this->input->post('operation');
		$str='';
		$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
		<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<thead>
				<th width="2%"><input style="margin-left:7px" type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
				<th width="3%"  style="font-weight: bold;text-align:center">P</th>
				<th width="15%" style="font-weight: bold;text-align:left">Loan AC</th>
				<th width="20%" style="font-weight: bold;text-align:left">AC Name</th>
				<th width="15%" style="font-weight: bold;text-align:left">Previous Case Status</th>
				<th width="15%" style="font-weight: bold;text-align:left">New Case Status</th>
				<th width="20%" style="font-weight: bold;text-align:left">Remarks</th>
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
				if ($data->back_case_status==1) {
					$style_color='style="color:red"';
				}else
				{
					$style_color='';
				}
				$str.='<tr>';
				$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$data->id.'"><input type="hidden" name="suit_file_id_'.$i.'" id="suit_file_id_'.$i.'" value="'.$data->suit_file_id.'"></td>';
				$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
				$str.='<td align="left">'.$data->loan_ac.'</td>';
				$str.='<td align="left">'.$data->ac_name.'</td>';
				$str.='<td align="left">'.$data->prev_case_sts.'</td>';
				$str.='<td align="left" '.$style_color.' >'.$data->case_sts.'</td>';
				$str.='<td align="left">'.$data->remarks.'</td>';
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
			$id = $this->Legal_status_expense_model->bulk_acktion();
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
			else if($id=='limitcrossed')
			{
				$Message='Sorry! Package Bill Limit Crossed Please Try Again.';
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
	function search_suit()
	{
		$csrf_token=$this->security->get_csrf_hash();
		//$str_where = "c.sts<>0 AND c.suit_sts=75 AND c.final_remarks=1";
		//bellow condition will only open for some days as per prince bhai mail request
		$str_where = "c.sts<>0 AND ((c.suit_sts=75 AND c.final_remarks=1) OR (c.final_remarks=2 AND c.req_type=2 AND c.case_sts_prev_dt=15))";
		if (check_group('1'))
        {
            $str_where .=" AND c.legal_region IN(".$this->session->userdata['ast_user']['legal_region'].")";
        }
        else if (check_group('2'))
        {
            $str_where .=" AND c.case_deal_officer='".$this->session->userdata['ast_user']['user_id']."'";
        }
        if (trim($this->input->post('proposed_type')) != '') {
			$str_where.= " AND c.proposed_type=".$this->db->escape(trim($this->input->post('proposed_type')));
		}
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
		if (trim($this->input->post('case_number')) != '') {
			$str_where.= " AND c.case_number='".trim($this->input->post('case_number'))."'";
		}
		if (trim($this->input->post('search_dt')) != '') {
			$date = implode('-',array_reverse(explode('/',$this->input->post('search_dt'))));
    		$str_where.= " AND c.next_date='".$this->security->xss_clean($date)."'";
			//$str_where.= " AND c.case_number='".trim($this->input->post('case_number'))."'";
		}
		$suit_row = $this->db->query("SELECT r.name as req_type,c.case_number,c.id,c.loan_ac,c.ac_name
			FROM suit_filling_info as c 
			LEFT OUTER JOIN ref_req_type r on(c.req_type=r.id)
			WHERE ".$str_where."")->result();
		$str_html="";
		$str_html.="<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>Select</strong></td>
			<td style='width:15%;border:1px solid #a0a0a0'><strong>Case Type</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Loan AC</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>AC Name</strong></td>
			<td style='width:10%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>";

		if(count($suit_row)>0)
		{
			
			$sl =1;
			foreach($suit_row as $row)
			{
				$updated_row = $this->db->query("SELECT c.id
				FROM change_request as c
				WHERE c.sts<>0 AND c.sts<>91 AND Date(c.e_dt)='".date('Y-m-d')."' AND c.suit_file_id='".$row->id."' LIMIT 1")->row();
				if(!empty($updated_row))//Skiping when alreday updated this data for today
				{
					continue;
				}
				$str_html.="<tr>
				<td style='border:1px solid #a0a0a0;text-align:center'><input type='checkbox' name='suit_id' onclick='onlyOne(this)' value='".$row->id."' /></td>
				<td style='border:1px solid #a0a0a0'>".$row->req_type."
				<input type='hidden' id='id_".$sl."' value='".$row->id."' />
				<td style='border:1px solid #a0a0a0'>".$row->loan_ac."</td>
				<td style='border:1px solid #a0a0a0'>".$row->ac_name."</td>
				<td style='border:1px solid #a0a0a0'>".$row->case_number."</td>
				</tr>";
				$sl++;
			}
			$str_html.="<input type='hidden' id='suitCount' value='".count($suit_row)."' />
				<tr><td colspan='6'></td></tr>
				<tr><td colspan='6' align='center'><button type='button' class='buttonStyle' style='background-color: rgb(24, 88, 145); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' onclick='load_filing_info()' id='next_button'>Next</button><span id=\"next_loading\" style=\"display:none\">Please wait... <img src=\"".base_url()."images/loader.gif\" align=\"bottom\"></span></td></tr>
			</table>";
		}
		else
		{
			$str_html.="<tr><td colspan='6' align='center'>No Result Found !!!</td></tr>";
		}
		echo $str_html."####".$csrf_token;
	}
	function get_add_info()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$details=array();
		$package_info = array();
		$package_sts = 0;
		$id = $this->input->post('id');
		$row_info =$this->Legal_file_process_model->get_add_action_data_suit($id);
		if (!empty($row_info)) {
			$Message='ok';
			$str_where = "c.sts<>0 AND c.disbursed_sts=0 AND c.v_sts=13 AND c.package_type=1";
			if ($row_info->proposed_type=='Loan') {
				$str_where.= " AND c.loan_ac='".$row_info->loan_ac."'";
			}else
			{
				$str_where.= " AND c.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$row_info->loan_ac)."'";
			}
			$str_where.= " AND c.req_type=".$this->db->escape($row_info->req_type);
			$str_where.= " AND c.lawyer=".$this->db->escape($row_info->prest_lawyer_name);
			$package_info = $this->db->query("SELECT c.*,IF(c.disbursed_amount IS NULL,0,c.disbursed_amount) as disbursed_amount,l.name as lawyer_name
			FROM lawyer_package_bill_setup as c 
			LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
			WHERE ".$str_where." LIMIT 1")->row();
			if(!empty($package_info))
			{
				$package_sts = 1;
			}
		}
		else{
			$Message='No Data';
		}
		$req_type = $row_info->req_type;
		$district = $row_info->district;
		$pre_case_sts = $this->Legal_status_expense_model->get_pre_case_sts($id);
		$status_history = $this->Legal_status_expense_model->get_case_status_history($id);
		if($req_type==2 && $row_info->case_name==4)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara','name','data_status = 1 AND aurtho_jari_sts=1 AND id NOT IN(20,21,22) AND apv_sts<>1');
		}
		else if($req_type==2)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara','name','data_status = 1 AND (aurtho_jari_sts=0 OR aurtho_jari_sts IS NULL) AND id NOT IN(1,2,3,4) AND apv_sts<>1');
		}
		else
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ni','name','data_status = 1 AND id NOT IN(1,2,3)  AND apv_sts<>1');
		}
		$court =array();//$this->User_model->get_parameter_data('ref_court','name','data_status = 1 AND district="'.$row_info->district.'"');
		$lawyer =$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1 AND district="'.$row_info->district.'"');
		$district_list =$this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1');
		$plaintiff =array();//$this->User_model->get_parameter_data('users_info','name','data_status = 1  AND admin_status<>2 AND district<>0 AND district IS NOT NULL AND block_status = 0');
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row_info;
		$var['id']=$id;
		$var['req_type']=$req_type;
		$var['court']=$court;
		$var['lawyer']=$lawyer;
		$var['plaintiff']=$plaintiff;
		$var['district_list']=$district_list;
		$var['district']=$district;
		$var['expense_activities']=$expense_activities;
		$var['pre_case_sts']=$pre_case_sts;
		$var['Message']=$Message;
		$var['status_history']=$status_history;
		$var['package_info']=$package_info;
		$var['package_sts']=$package_sts;
		echo json_encode($var);
	}
	function check_duplicate_bill()
	{
		$success = 1;
		$activities_id = $this->input->post('activities_id');
		$lawyer = $this->input->post('lawyer');
		$suit_id = $this->input->post('suit_id');
		$activities_date = implode('-',array_reverse(explode('/',$this->input->post('date'))));
		$str_where = "c.module_name='suit_file' AND c.activities_id='".$activities_id."' AND c.suit_id='".$suit_id."' AND c.vendor_type=1 AND c.vendor_id='".$lawyer."' AND c.txrn_dt='".$activities_date."'";
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
			$success = 1;
		}
		$var['csrf_token']=$csrf_token;
		$var['success']=$success;
		echo json_encode($var);
	}
	function get_edit_info()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$details=array();
		$id = $this->input->post('id');
		$package_info = array();
		$package_sts = 0;
		$req_type ="";
		$district ="";
		$pre_case_sts =array();
		$status_history =array();
		$expense_activities =array();
		$court =array();//
		$lawyer =array();
		$district_list =array();
		$plaintiff =array();//
		$expense_data = $this->Legal_status_expense_model->get_expense_data($id);
		$result = $this->Legal_status_expense_model->get_add_action_data($id);
		$row_info =$this->Legal_file_process_model->get_add_action_data_suit($result->suit_file_id);
		if (!empty($row_info)) {
			$Message='ok';
			$package_info = $this->db->query("SELECT h.*,h.id as history_id,c.id as package_id,c.case_number,c.loan_ac,IF(c.disbursed_amount IS NULL,0,c.disbursed_amount) as disbursed_amount,c.package_amount,l.name as lawyer_name
			FROM package_select_history as h 
			LEFT OUTER JOIN lawyer_package_bill_setup c on(h.package_id=c.id)
			LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
			WHERE h.event_id='".$result->id."' AND h.event_table_name='change_request' LIMIT 1")->row();
			if(!empty($package_info))
			{
				$package_sts = 1;
			}

			$req_type = $row_info->req_type;
			$district = $row_info->district;
			$pre_case_sts = $this->Legal_status_expense_model->get_pre_case_sts($result->suit_file_id);
			$status_history = $this->Legal_status_expense_model->get_case_status_history($result->suit_file_id);
			if($req_type==2 && $row_info->case_name==4)
			{
				$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara','name','data_status = 1 AND aurtho_jari_sts=1 AND id NOT IN(20,21,22)  AND apv_sts<>1');
			}
			else if($req_type==2)
			{
				$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara','name','data_status = 1 AND (aurtho_jari_sts=0 OR aurtho_jari_sts IS NULL) AND id NOT IN(1,2,3,4)  AND apv_sts<>1');
			}
			else
			{
				$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ni','name','data_status = 1 AND id NOT IN(1,2,3)  AND apv_sts<>1');
			}
			$court =array();//$this->User_model->get_parameter_data('ref_court','name','data_status = 1 AND district="'.$row_info->district.'"');
			$lawyer =$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1 AND district="'.$row_info->district.'"');
			$district_list =$this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1');
			$plaintiff =array();//$this->User_model->get_parameter_data('users_info','name','data_status = 1  AND admin_status<>2 AND district<>0 AND district IS NOT NULL');
		}
		else{
			$Message='No Data';
		}
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row_info;
		$var['id']=$id;
		$var['req_type']=$req_type;
		$var['court']=$court;
		$var['lawyer']=$lawyer;
		$var['plaintiff']=$plaintiff;
		$var['district_list']=$district_list;
		$var['district']=$district;
		$var['result']=$result;
		$var['expense_data']=$expense_data;
		$var['expense_activities']=$expense_activities;
		$var['pre_case_sts']=$pre_case_sts;
		$var['Message']=$Message;
		$var['status_history']=$status_history;
		$var['package_info']=$package_info;
		$var['package_sts']=$package_sts;
		echo json_encode($var);
	}
	function get_peramater_name($table,$where=NULL)
	{
		$data = $this->User_model->get_parameter_name($table,$where);
		return $data->name;
	}
	function details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Legal_status_expense_model->get_details($this->input->post('id'));
		$prev_str = '';
		$new_str = '';
		$expense = $this->Legal_status_expense_model->get_expense_details($this->input->post('id'),$details->req_type);
		$package_info = $this->Legal_status_expense_model->get_package_details($this->input->post('id'),$details->req_type);
		$status_history = $this->Legal_status_expense_model->get_case_status_history($details->suit_file_id);
		if ($details->back_case_status==1) {
			$style_color='style="color:red"';
		}else
		{
			$style_color='';
		}
		if ($details->new_lawyer_name!='') {
			$l_style='style="color:red"';
			if ($details->noc_file!='' && $details->noc_file!=NULL) {
                $noc_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/noc_file/'.$details->noc_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$noc_file="";}
		}else
		{
			$l_style='';
			$noc_file="";
		}
		if ($details->new_court_name!='') {
			$c_style='style="color:red"';
		}else
		{
			$c_style='';
		}
		if ($details->new_plaintiff_name!='') {
			$p_style='style="color:red"';
		}else
		{
			$p_style='';
		}
		if ($details->new_district_name!='') {
			$d_style='style="color:red"';
		}else
		{
			$d_style='';
		}
		if ($details->optional_attachment!='' && $details->optional_attachment!=NULL) {
                $optional_attachment='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/optional_attachment/'.$details->optional_attachment.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$optional_attachment="";}
    	if (!empty($details)) 
    	{
    		if($details->case_sts_id==15)
    		{
    			$file_name = 'Judgment';
    		}
    		else if($details->case_sts_id==29)
    		{
    			$file_name = 'W/A';
    		}
    		else
    		{
    			$file_name = 'Attachment';
    		}
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
    				<tr>
						<td width="50%" align="left"><strong>Loan AC.:</strong>'.$details->loan_ac.'</td>
						<td width="50%" align="left"><strong>AC Name:</strong>'.$details->ac_name.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Case Number.:</strong>'.$details->case_number.'</td>
						<td width="50%" align="left"><strong>Req Type:</strong>'.$details->req_type_name.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Previous Case Status:</strong>'.$details->prev_case_sts.'</td>
						<td width="50%" align="left"><strong>Present Case Date:</strong>'.$details->case_dt.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left" '.$style_color.'><strong>Present Case Status:</strong>'.$details->case_sts.'</td>
						<td width="50%" align="left"><strong>Next Case Date:</strong>'.$details->next_case_dt.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Next Date Purpose:</strong>'.$details->next_date_purpose.'</td>
						<td width="50%" align="left"><strong>Remarks:</strong> '.$details->remarks.'</td>
					</tr>
					<tr>
						<td width="50%" align="left" '.$l_style.'><strong>New Lawyer:</strong>'.$details->new_lawyer_name.' NOC File:'.$noc_file.'</td>
						<td width="50%" align="left" '.$c_style.'><strong>New Court:</strong>'.$details->new_court_name.'</td>
					</tr>
					<tr>
						<td width="50%" align="left" '.$p_style.'><strong>New Plaintiff:</strong>'.$details->new_plaintiff_name.'</td>
						<td width="50%" align="left" '.$d_style.'><strong>New District:</strong>'.$details->new_district_name.'</td>
					</tr>';
					$str.='<tr>
						<td width="50%" align="left"><strong>Entry By:</strong>'.$details->e_by.'</td>
						<td width="50%" align="left"><strong>Entry Date Time:</strong>'.$details->e_dt.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Update By:</strong>'.$details->u_by.'</td>
						<td width="50%" align="left"><strong>Update Date Time:</strong>'.$details->u_dt.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Verify By:</strong>'.$details->v_by.'</td>
						<td width="50%" align="left"><strong>Verify Date Time:</strong>'.$details->v_dt.'</td>
					</tr>
					';
			if($details->case_sts_id==29 || $details->case_sts_id==15)
			{
				$str.='<tr>
						<td width="50%" align="left"><strong>'.$file_name.' Copy:</strong>'.$optional_attachment.'</td>
						<td width="50%" align="left"></td>
					</tr>
					';
			}
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($expense)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Expense Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Vendor Type</td>
						<td width="10%" style="font-weight: bold;text-align:left">Vendor Name</td>
						<td width="10%" style="font-weight: bold;text-align:left">Activities Name</td>
						<td width="10%" style="font-weight: bold;text-align:left">Activities Date</td>
						<td width="10%" style="font-weight: bold;text-align:left">Amount</td>
						<td width="10%" style="font-weight: bold;text-align:left">Remarks</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				foreach ($expense as $key) 
				{
					if($key->proxy_sts==1)
					{
						$proxy_style='style="color:red"';
						$text = '(Proxy)';
					}
					else
					{
						$proxy_style='"';
						$text = '';
					}
					$str.='<tr>';
						$str.='<td align="center">'.$key->expense_type_name.'</td>';
						$str.='<td align="left" '.$proxy_style.'>'.$key->vendor_name.' '.$text.'</td>';
						$str.='<td align="left">'.$key->activities_name.'</td>';
						$str.='<td align="left">'.$key->activities_date.'</td>';
						$str.='<td align="left">'.$key->amount.'</td>';
						$str.='<td align="left">'.$key->remarks.'</td>';
					$str.='</tr>';
				}

			$str.='</tbody>
				</table>
			</div>';

    	}
    	if (!empty($package_info)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Package Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Lawyer Name</td>
						<td width="10%" style="font-weight: bold;text-align:left">Loan AC</td>
						<td width="10%" style="font-weight: bold;text-align:left">Case Number</td>
						<td width="10%" style="font-weight: bold;text-align:left">Remaining Package Amount</td>
						<td width="10%" style="font-weight: bold;text-align:left">Activities</td>
						<td width="10%" style="font-weight: bold;text-align:left">Amount</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				$str.='<tr>';
					$str.='<td align="center">'.$package_info->lawyer_name.'</td>';
					$str.='<td align="left">'.$package_info->loan_ac.'</td>';
					$str.='<td align="left">'.$package_info->case_number.'</td>';
					$str.='<td align="left">'.number_format($package_info->package_amount-$package_info->disbursed_amount,2).'</td>';
					$str.='<td align="left">'.$package_info->activities_name.'</td>';
					$str.='<td align="left">'.$package_info->amount.'</td>';
				$str.='</tr>';

			$str.='</tbody>
				</table>
			</div>';

    	}
    	if (!empty($status_history)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;overflow-x:hidden;height:250px">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Case Status History</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Prev Case Status</td>
						<td width="10%" style="font-weight: bold;text-align:center">New Case Status</td>
						<td width="15%" style="font-weight: bold;text-align:center">Change By</td>
						<td width="15%" style="font-weight: bold;text-align:center">Change Date</td>
						<td width="15%" style="font-weight: bold;text-align:center">Next Case Date</td>
						<td width="15%" style="font-weight: bold;text-align:center">Next Date Purpose</td>
						<td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				foreach ($status_history as $key) 
				{
					if ($key->back_case_status==1) {
						$style_color='style="color:red"';
					}else
					{
						$style_color='';
					}
					$str.='<tr>';
						$str.='<td align="center">'.$key->prev_case_sts.'</td>';
						$str.='<td align="center" '.$style_color.'>'.$key->present_case_sts.'</td>';
						$str.='<td align="center">'.$key->e_by.'</td>';
						$str.='<td align="center">'.$key->e_dt.'</td>';
						$str.='<td align="center">'.$key->next_case_dt.'</td>';
						$str.='<td align="center">'.$key->next_dt_purpose.'</td>';
						$str.='<td align="center">'.$key->remarks.'</td>';
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
	function delete_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Legal_status_expense_model->delete_action();
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
			else if($id=='pending')
			{
				$Message='Sorry! You have to delete the last status of this case.';
				$row[]='';	
			}
			else if($id=='limitcrossed')
			{
				$Message='Sorry! Package Bill Limit Crossed Please Try Again.';
				$row[]='';	
			}
			else if($id==0)
			{
				$Message='Something went wrong';
				$row[]='';	
			}
			else if($this->input->post("type")=='delete' || $this->input->post("type")=='ho_delete'){$row[]='';	}
			else if(isset($_POST['typebulk'])){$row[]='';}
			else{$row=$this->Legal_status_expense_model->get_add_action_data($id);}
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
	function add_edit()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			if($_POST['edit_after_verify_sts']==0)
			{
				$id = $this->Legal_status_expense_model->add_edit();
			}
			else
			{
				$id = $this->Legal_status_expense_model->add_edit_after_verify();
			}
			
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
			}else if($id=='exist')
			{
				$Message='Sorry You Have already one pending request for this change!!';
				$row[]='';
			}else if($id=='updated')
			{
				$Message='Sorry You Have already updated this case status!!';
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
	function r_history()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$sah=$this->Legal_status_expense_model->get_r_history($this->input->post('id'),$this->input->post('life_cycle'));
        $jTableResult = array();
        $jTableResult['csrf_token'] = $csrf_token;
        if ($sah != null) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $sah;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['csrf_token'] = $csrf_token;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
	}
}
?>
