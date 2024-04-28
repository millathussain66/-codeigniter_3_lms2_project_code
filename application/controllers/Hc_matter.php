<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hc_matter extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Hc_matter_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat,$menu_link=null,$submenu=null)
	{
		$add_edit='';$id="";
		$data = array(
			'add_edit' => $add_edit,
			'submenu' => $submenu,
			'menu_link' => $menu_link,
			'id' => $id,
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'sys_config'=> $this->User_info_model->upr_config_row(),
			'billing_month'=>$this->User_model->get_parameter_data('ref_billing_month','id','data_status = 1'),
			'region' => $this->user_model->get_parameter_data('ref_legal_region','name',"data_status = '1' AND id IN(".$this->session->userdata['ast_user']['legal_region'].")"),
			'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','name',"data_status = '1' "),
			'hc_case_category' => $this->user_model->get_parameter_data('ref_hc_case_category','name',"data_status = '1'"),
			'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
			'disposal_sts' => $this->User_model->get_parameter_data('ref_disposal_sts','name','data_status = 1'),
			'request_from'=>$this->Hc_matter_model->select_where('ref_expense_type','data_status=1 AND id IN (1)','name,id'),
			'paper_vendor' => $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
			'hc_activites' => $this->User_model->get_parameter_data('ref_hc_activities','name','data_status = 1'),
			'loan_segment'=>$this->User_model->get_parameter_data('ref_loan_segment','name','data_status=1'),
			'appeal_deposit_money'=>$this->User_model->get_parameter_data('ref_appeal_deposit_money','id','data_status=1'),
			'hc_division'=>$this->User_model->get_parameter_data('ref_hc_division','name','data_status=1'),
			'hc_case_type'=>$this->User_model->get_parameter_data('ref_hc_case_type','name','data_status=1'),
			'hc_case_status'=>$this->User_model->get_parameter_data('ref_hc_case_status','name','data_status=1'),
			'lawyer'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1 AND hc_status=1'),
			'case_sts'=>$this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
			'hc_bench'=>$this->User_model->get_parameter_data('ref_hc_bench','name,bench_number','data_status = 1'),
			'hc_bench_number'=>$this->User_model->get_parameter_data('ref_hc_bench_number','name','data_status = 1'),
			'dealing_officer'=>$this->User_model->get_parameter_data('users_info','name','data_status = 1 AND (FIND_IN_SET(1,user_group_id) OR FIND_IN_SET(2,user_group_id))'),
			'district'=>$this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1'),
			'hc_dealing_officer'=>$this->User_model->get_parameter_data('users_info','name','data_status = 1 AND (FIND_IN_SET(10,user_group_id) OR FIND_IN_SET(11,user_group_id))'),
			'user_group'=>$this->Hc_matter_model->select_where('user_group','data_status=1 AND id IN (1,2,3,4)','group_name,id'),
	   		'per_page' => $this->config->item('per_pagess')
		   );

		if($submenu=='case_details'){
			if(isset($_POST['mk_xl'])){
				$this->hc_case_deatails_xl();
			}else{
				//$data['result'] =$this->Hc_matter_model->hc_case_details();
				$data['pages']='hc_matter/pages/case_details';	
			}
		}elseif($submenu=='ad_case_details'){
			if(isset($_POST['mk_xl'])){
				$this->ad_case_deatails_xl();
			}else{
				//$data['result'] =$this->Hc_matter_model->ad_case_details();
				$data['pages']='hc_matter/pages/ad_case_details';	
			}
		}elseif($submenu=='ad_case_file'){
			$data['pages']='hc_matter/pages/ad_case_file';
		}elseif($submenu=='case_status_update'){
			$data['pages']='hc_matter/pages/case_status_update';
		}elseif($submenu=='ad_case_status_update'){
			$data['pages']='hc_matter/pages/ad_case_status_update';
		}elseif($submenu=='billing'){
			$data['pages']='hc_matter/pages/billing';
		}elseif($submenu=='ad_billing'){
			$data['pages']='hc_matter/pages/ad_billing';
		}elseif($submenu=='bill_expense'){
			$data['pages']='hc_matter/pages/bill_expense';
		}else{
			$data['pages']='hc_matter/pages/grid';
		}
		$this->load->view('grid_layout',$data);
	}

	function grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Hc_matter_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
		
	}
	function case_status_update_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Hc_matter_model->case_status_update_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
		
	}

	function ad_case_file_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Hc_matter_model->ad_case_file_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
		
	}
	function ad_case_status_update_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Hc_matter_model->ad_case_status_update_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
		
	}

	function hc_expencese_grid(){
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Hc_matter_model->hc_expencese_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
		//print_r($result);
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function ad_expencese_grid(){
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Hc_matter_model->ad_expencese_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
		//print_r($result);
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function executed_incentive_grid(){
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Warrant_arrest_model->get_executed_incentive_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

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
					 'pages'=> 'warrant_arrest/pages/form',
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
			$id = $this->Hc_matter_model->add_edit_action($add_edit,$edit_id);
			if($id>0){
				$text = array();
			}else{
				$text[]=$id;
			}
		}
		else{
			$text[]="Session out, login required";

		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=[];
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

	function expencese_action(){
		$csrf_token=$this->security->get_csrf_hash();
		$add_edit=$this->input->post('add_edit');
		$edit_id=$this->input->post('edit_row');
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Hc_matter_model->expenceses_action($add_edit,$edit_id);
			if($id>0){
				$text = array();
			}else{
				$text[]=$id;
			}
		}
		else{
			$text[]="Session out, login required";

		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=[];
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
			$id = $this->Hc_matter_model->delete_action();
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
			else{$row[]=''; 
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
	function status_delete_action(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Hc_matter_model->status_delete_action();
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
			else{$row[]='';
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
	function add_edit_case_status_update($add_edit,$edit_row=NULL){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Hc_matter_model->add_edit_case_status_update($add_edit,$edit_row);
			if($id>0){
				$text = array();
			}else{
				$text[]=$id;
			}
		}
		else{
			$text[]="Session out, login required";

		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=[];
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

	function get_case_info(){
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$rows = $this->Hc_matter_model->get_case_info($id);
		$history = $this->Hc_matter_model->get_case_history($id);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		$var['history']=$history;
		echo json_encode($var);
	}
	function get_case_edit_info(){
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$rows = $this->Hc_matter_model->get_case_edit_info($id);
		$module = 'HC Matter';
		if($rows->hc_division==2){
			$module='AD Matter';
		}
		$expense = $this->Hc_matter_model->get_case_expense_edit_info($id,$module);
		$rows->org_ac_number=$this->Common_model->stringEncryption('decrypt',$rows->org_ac_number);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		$var['expenses']=$expense;
		echo json_encode($var);
	}
	function get_hc_info_for_ad(){
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$rows = $this->Hc_matter_model->get_hc_info_for_ad($id);
		$rows->org_ac_number=$this->Common_model->stringEncryption('decrypt',$rows->org_ac_number);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}

	function get_details($id){

		$csrf_token=$this->security->get_csrf_hash();
		if($id!=''){
			//echo $id;
		$rows = $this->Hc_matter_model->get_details($id);
		}else{
			$rows='';
		}
		echo $rows.'####'.$csrf_token;
	}

	function get_billing_details($id){
		$csrf_token=$this->security->get_csrf_hash();
		if($id!=''){
			//echo $id;
		$rows = $this->Appeal_bail_money_model->get_billing_details($id);
		}else{
			$rows='';
		}
		echo $rows.'####'.$csrf_token;
	}


	function search_case()
	{
		$csrf_token=$this->security->get_csrf_hash();

		$where = "s.sts=1";
		//$where = "s.sts=75";
		
		if(trim((string)$this->input->post('s_case_number')) != '')
		{ $where.= " AND s.case_number LIKE '%".trim((string)$this->input->post('s_case_number'))."%'"; }
		if($this->input->post('s_proposed_type')!='')
		{ $where.= " AND s.proposed_type='".trim((string)$this->input->post('s_proposed_type'))."'"; }
		if($this->input->post('s_account')!=''){
			if($this->input->post('s_proposed_type')=='Card'){
		    	$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->post('s_hidden_loan_ac')));

		    	$where.= " AND s.org_loan_ac = '".$card."'"; 
		    }else{
		    	$where.= " AND s.loan_ac = '".trim((string)$this->input->post('s_account'))."'";
		    }
		}

			$this->db->select('s.*', FALSE)
			->from("suit_filling_info s")
			->where($where);
			if($this->input->post('limit')!='All'){
			$this->db->limit($this->input->post('limit'));
			}
			$q=$this->db->get();
			$suit_row = $q->result();
		
		$str_html="<div style='min-height:200px;position:relative;'>";
		if(count($suit_row)>0)
		{
			$str_html.="<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;margin-bottom:40px;' >
			<tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>Select</strong></td>
			<td style='width:15%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>
			<td style='width:27%;border:1px solid #a0a0a0'><strong>Loan AC</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>AC Name</strong></td>";
			$sl =1;
			foreach($suit_row as $row)
			{

				$str_html.="<tr>
				<td style='border:1px solid #a0a0a0;text-align:center'><input type='checkbox' id='suit_' name='case_id' onclick='onlyOne(this)' value='".$row->id."' /></td>
				<td style='border:1px solid #a0a0a0'>".$row->case_number."
				<input type='hidden' id='case_number_".$sl."' value='".$row->case_number."' />
				<input type='hidden' id='loan_ac_".$sl."' value='".$row->loan_ac."' />
				<input type='hidden' id='suit_id_".$sl."' value='".$row->id."' />
				<input type='hidden' id='ac_name_".$sl."' value='".$row->ac_name."' />
				<td style='border:1px solid #a0a0a0'>".$row->loan_ac."</td>
				<td style='border:1px solid #a0a0a0'>".$row->ac_name."</td>
				</tr>";
				$sl++;
			}
			$str_html.="<input type='hidden' id='suitCount' value='".count($suit_row)."' />
				<tr><td colspan='4'></td></tr>
				<tr><td colspan='4' align='center'><button type='button' class='buttonStyle' style='background-color: rgb(24, 88, 145); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' onclick='loadsuit(\"Recase\")'>Next</button>
					
				</td></tr>
			</table>";
			//<button type='button' class='buttonStyle' style='background-color: rgb(67, 145, 24); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' onclick='loadsuit(\"New\")'>New</button>
		}
		else
		{
			//$str_html.="<button type='button' class='buttonStyle' style='background-color: rgb(67, 145, 24); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;position:absolute;bottom:0;left:50%;' onclick='load_new()'>New</button>";
		}
		$str_html.='</div>';
		echo $str_html."####".$csrf_token;
	}
	function search_case_info(){
		$csrf_token=$this->security->get_csrf_hash();
		$where = "s.sts=1 AND s.id=".$this->input->post('id');
		$this->db->select('s.*', FALSE)
		->from("suit_filling_info s")
		->where($where);
		$q=$this->db->get();
		$rows = $q->row();
		$rows->org_loan_ac=$this->Common_model->stringEncryption('decrypt',$rows->org_loan_ac);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}

	function get_case_status(){
		$csrf_token = $this->security->get_csrf_hash();
    	$case_type = $this->input->post('case_type');
    	$dropdown_name = $this->input->post('dropdown_name');
		$sah=$this->Hc_matter_model->get_case_status($case_type,$dropdown_name);
        $jTableResult = array();
        if ($sah != null) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $sah;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['csrf_token'] = $csrf_token;
        echo json_encode($jTableResult);
	}
	function case_exit_check(){
		$csrf_token=$this->security->get_csrf_hash();

		$where = "s.sts=1 AND s.case_no='".$this->input->post('case_no')."'";
		if($this->input->post('editrow')!=''){
			$where.=' AND s.id NOT IN ('.$this->input->post('editrow').')';
		}
		$this->db->select('s.*', FALSE)
		->from("hc_matter s")
		->where($where);
		$q=$this->db->get();
		$rows = $q->num_rows();
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}
	// Case Status update for HCM

	function hc_search_case(){
		$csrf_token=$this->security->get_csrf_hash();

		$where = "s.sts=1 AND s.v_sts=38 AND s.verify IN (38,91)";
		//$where = "s.sts=75";

		if(trim((string)$this->input->post('s_case_number')) != '')
		{ $where.= " AND s.case_no='".trim((string)$this->input->post('s_case_number'))."'"; }
		if($this->input->post('s_proposed_type')!='')
		{ $where.= " AND s.proposed_type='".trim((string)$this->input->post('s_proposed_type'))."'"; }
		if($this->input->post('s_account')!=''){
			if($this->input->post('s_proposed_type')=='Card'){
		    	$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->post('s_hidden_loan_ac')));

		    	$where.= " AND s.org_ac_number = '".$card."'"; 
		    }else{
		    	$where.= " AND s.ac_number = '".trim((string)$this->input->post('s_account'))."'";
		    }
		}
		if(trim((string)$this->input->post('s_hc_division')) != '')
		{ $where.= " AND s.hc_division='".trim((string)$this->input->post('s_hc_division'))."'"; }
		if(trim((string)$this->input->post('s_case_category')) != '')
		{ $where.= " AND s.case_category='".trim((string)$this->input->post('s_case_category'))."'"; }
		if(trim((string)$this->input->post('s_case_type')) != '')
		{ $where.= " AND s.case_type='".trim((string)$this->input->post('s_case_type'))."'"; }

			$this->db->select('s.*', FALSE)
			->from("hc_matter s")
			->where($where);
			if($this->input->post('limit')!='All'){
			$this->db->limit($this->input->post('limit'));
			}
			$q=$this->db->get();
			$suit_row = $q->result();
		
		$str_html="<div style='min-height:200px;position:relative;'>";
		if(count($suit_row)>0)
		{
			$str_html.="<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>Select</strong></td>
			<td style='width:15%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>
			<td style='width:27%;border:1px solid #a0a0a0'><strong>Loan AC</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>AC Name</strong></td>";
			$sl =1;
			foreach($suit_row as $row)
			{

				$str_html.="<tr>
				<td style='border:1px solid #a0a0a0;text-align:center'><input type='checkbox' id='suit_' name='case_id' onclick='onlyOne(this)' value='".$row->id."' /></td>
				<td style='border:1px solid #a0a0a0'>".$row->case_no."
				<input type='hidden' id='case_number_".$sl."' value='".$row->case_no."' />
				<input type='hidden' id='loan_ac_".$sl."' value='".$row->ac_number."' />
				<input type='hidden' id='suit_id_".$sl."' value='".$row->id."' />
				<input type='hidden' id='ac_name_".$sl."' value='".$row->ac_name."' />
				<td style='border:1px solid #a0a0a0'>".$row->ac_number."</td>
				<td style='border:1px solid #a0a0a0'>".$row->ac_name."</td>
				</tr>";
				$sl++;
			}
			$str_html.="<input type='hidden' id='suitCount' value='".count($suit_row)."' />
				<tr><td colspan='4'></td></tr>
				<tr><td colspan='4' align='center'><button type='button' class='buttonStyle' style='background-color: rgb(24, 88, 145); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' onclick='loadsuit(\"Recase\")'>Next</button>
					
				</td></tr>
			</table>";
		}
		else
		{
			$str_html.="No Data Found";
		}
		$str_html.='</div>';
		echo $str_html."####".$csrf_token;
	}

	function hc_caseup_edit(){
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$history_id = $this->input->post('history_id');
		$rows = $this->Hc_matter_model->hc_caseup_edit($id,$history_id);
		$expense = $this->Hc_matter_model->get_case_expense_edit_info($id,'HC Matter',$history_id);
		$history = $this->Hc_matter_model->get_case_history($id);
		$var['history']=$history;
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		$var['expenses']=$expense;
		echo json_encode($var);
	}

	function get_expence_delete(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Hc_matter_model->get_expence_delete();
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

	// Appeal Division Case File

	function search_case_hc(){
		$csrf_token=$this->security->get_csrf_hash();

		$where = "s.sts=1";
		//$where = "s.sts=75";

		if(trim((string)$this->input->post('s_case_number')) != '')
		{ $where.= " AND s.case_no='".trim((string)$this->input->post('s_case_number'))."'"; }
		if($this->input->post('s_proposed_type')!='')
		{ $where.= " AND s.proposed_type='".trim((string)$this->input->post('s_proposed_type'))."'"; }
		if($this->input->post('s_account')!=''){
			if($this->input->post('s_proposed_type')=='Card'){
		    	$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->post('s_hidden_loan_ac')));

		    	$where.= " AND s.org_ac_number = '".$card."'"; 
		    }else{
		    	$where.= " AND s.ac_number = '".trim((string)$this->input->post('s_account'))."'";
		    }
		}
		if(trim((string)$this->input->post('s_case_category')) != '')
		{ $where.= " AND s.case_category='".trim((string)$this->input->post('s_case_category'))."'"; }
		if(trim((string)$this->input->post('s_case_type')) != '')
		{ $where.= " AND s.case_type='".trim((string)$this->input->post('s_case_type'))."'"; }

			$this->db->select('s.*', FALSE)
			->from("hc_matter s")
			->where($where);
			if($this->input->post('limit')!='All'){
			$this->db->limit($this->input->post('limit'));
			}
			$q=$this->db->get();
			$suit_row = $q->result();

		
		$str_html="<div style='min-height:200px;position:relative;'>";
		if(count($suit_row)>0)
		{
			$str_html.="<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>Select</strong></td>
			<td style='width:15%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>
			<td style='width:27%;border:1px solid #a0a0a0'><strong>Loan AC</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>AC Name</strong></td>";
			$sl =1;
			foreach($suit_row as $row)
			{

				$str_html.="<tr>
				<td style='border:1px solid #a0a0a0;text-align:center'><input type='checkbox' id='suit_' name='case_id' onclick='onlyOne(this)' value='".$row->id."' /></td>
				<td style='border:1px solid #a0a0a0'>".$row->case_no."
				<input type='hidden' id='case_number_".$sl."' value='".$row->case_no."' />
				<input type='hidden' id='loan_ac_".$sl."' value='".$row->ac_number."' />
				<input type='hidden' id='suit_id_".$sl."' value='".$row->id."' />
				<input type='hidden' id='ac_name_".$sl."' value='".$row->ac_name."' />
				<td style='border:1px solid #a0a0a0'>".$row->ac_number."</td>
				<td style='border:1px solid #a0a0a0'>".$row->ac_name."</td>
				</tr>";
				$sl++;
			}
			$str_html.="<input type='hidden' id='suitCount' value='".count($suit_row)."' />
				<tr><td colspan='4'></td></tr>
				<tr><td colspan='4' align='center'><button type='button' class='buttonStyle' style='background-color: rgb(24, 88, 145); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' onclick='loadsuit(\"Recase\")'>Next</button>
					
				</td></tr>
			</table>";
			//<button type='button' class='buttonStyle' style='background-color: rgb(67, 145, 24); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' onclick='loadsuit(\"New\")'>New</button>
		}
		else
		{
			//$str_html.="<button type='button' class='buttonStyle' style='background-color: rgb(67, 145, 24); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;position:absolute;bottom:0;left:50%;' onclick='load_new()'>New</button>";
		}
		$str_html.='</div>';
		echo $str_html."####".$csrf_token;
	}

	function search_case_info_hc(){
		$csrf_token=$this->security->get_csrf_hash();
		$where = "s.sts=1 AND s.id=".$this->input->post('id');
		$this->db->select('s.*', FALSE)
		->from("hc_matter s")
		->where($where);
		$q=$this->db->get();
		$rows = $q->row();
		$rows->org_loan_ac=$this->Common_model->stringEncryption('decrypt',$rows->org_loan_ac);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}

	function add_edit_action_ad($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Hc_matter_model->add_edit_action_ad($add_edit,$edit_id);
			if($id>0){
				$text = array();
			}else{
				$text[]=$id;
			}
		}
		else{
			$text[]="Session out, login required";

		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=[];
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

	function get_details_ad($id){

		$csrf_token=$this->security->get_csrf_hash();
		if($id!=''){
			//echo $id;
		$rows = $this->Hc_matter_model->get_details_ad($id);
		}else{
			$rows='';
		}
		echo $rows.'####'.$csrf_token;
	}
	function get_case_edit_info_ad(){
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$rows = $this->Hc_matter_model->get_case_edit_info_ad($id);
		$expense = $this->Hc_matter_model->get_case_expense_edit_info($id,'AD Matter');
		$rows->org_ac_number=$this->Common_model->stringEncryption('decrypt',$rows->org_ac_number);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		$var['expenses']=$expense;
		echo json_encode($var);
	}

	function delete_action_ad(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Hc_matter_model->delete_action_ad();
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

	function case_exit_check_ad(){
		$csrf_token=$this->security->get_csrf_hash();

		$where = "s.sts=1 AND s.case_no='".$this->input->post('case_no')."'";
		if($this->input->post('editrow')!=''){
			$where.=' AND s.id NOT IN ('.$this->input->post('editrow').')';
		}
		$this->db->select('s.*', FALSE)
		->from("hc_matter_ad s")
		->where($where);
		$q=$this->db->get();
		$rows = $q->num_rows();
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}

	// HC Billing 
	function get_expence_edit_info(){
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('batch_no');
		$rows = $this->Hc_matter_model->get_expence_edit_info($id);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}
	function get_expence_edit_info_ad(){
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('batch_no');
		$rows = $this->Hc_matter_model->get_expence_edit_info_ad($id);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}

	function get_expence_details(){
		$csrf_token=$this->security->get_csrf_hash();

		if($this->input->post('id')!=''){
			//echo $this->input->post('id');
		$rows = $this->Hc_matter_model->get_expence_details();
		}else{
			$rows='';
		}
		echo $rows.'####'.$csrf_token;
	}


	// Appeal Division Case Update Status

	function hc_search_case_ad(){
		$csrf_token=$this->security->get_csrf_hash();

		$where = "s.sts=1 AND s.v_sts=38 AND s.verify IN (38,91)";
		//$where = "s.sts=75";

		if(trim((string)$this->input->post('s_case_number')) != '')
		{ $where.= " AND s.case_no='".trim((string)$this->input->post('s_case_number'))."'"; }
		if(trim((string)$this->input->post('s_case_category')) != '')
		{ $where.= " AND s.case_category=".$this->db->escape(trim((string)$this->input->post('s_case_category'))); }
		if(trim((string)$this->input->post('s_case_type')) != '')
		{ $where.= " AND s.case_type=".$this->db->escape(trim((string)$this->input->post('s_case_type'))); }
		if(trim((string)$this->input->post('s_year')) != '')
		{ $where.= " AND s.year=".$this->db->escape(trim((string)$this->input->post('s_year'))); }
		if(trim((string)$this->input->post('s_lawyer')) != '')
		{ $where.= " AND s.assigned_lawyer=".$this->db->escape(trim((string)$this->input->post('s_lawyer'))); }
		
		if($this->input->post('s_proposed_type')!='')
		{ $where.= " AND s.proposed_type=".$this->db->escape(trim((string)$this->input->post('s_proposed_type'))); }
		if($this->input->post('s_account')!=''){
			if($this->input->post('s_proposed_type')=='Card'){
		    	$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->post('s_hidden_loan_ac')));

		    	$where.= " AND s.org_ac_number = '".$card."'"; 
		    }else{
		    	$where.= " AND s.ac_number = '".trim((string)$this->input->post('s_account'))."'";
		    }
		}


			$this->db->select('s.*', FALSE)
			->from("hc_matter_ad s")
			->where($where);
			if($this->input->post('limit')!='All'){
			$this->db->limit($this->input->post('limit'));
			}
			$q=$this->db->get();
			$suit_row = $q->result();
		
		$str_html="<div style='min-height:200px;position:relative;'>";
		if(count($suit_row)>0)
		{
			$str_html.="<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>Select</strong></td>
			<td style='width:15%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>
			<td style='width:27%;border:1px solid #a0a0a0'><strong>Loan AC</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>AC Name</strong></td>";
			$sl =1;
			foreach($suit_row as $row)
			{

				$str_html.="<tr>
				<td style='border:1px solid #a0a0a0;text-align:center'><input type='checkbox' id='suit_' name='case_id' onclick='onlyOne(this)' value='".$row->id."' /></td>
				<td style='border:1px solid #a0a0a0'>".$row->case_no."
				<input type='hidden' id='case_number_".$sl."' value='".$row->case_no."' />
				<input type='hidden' id='loan_ac_".$sl."' value='".$row->ac_number."' />
				<input type='hidden' id='suit_id_".$sl."' value='".$row->id."' />
				<input type='hidden' id='ac_name_".$sl."' value='".$row->ac_name."' />
				<td style='border:1px solid #a0a0a0'>".$row->ac_number."</td>
				<td style='border:1px solid #a0a0a0'>".$row->ac_name."</td>
				</tr>";
				$sl++;
			}
			$str_html.="<input type='hidden' id='suitCount' value='".count($suit_row)."' />
				<tr><td colspan='4'></td></tr>
				<tr><td colspan='4' align='center'><button type='button' class='buttonStyle' style='background-color: rgb(24, 88, 145); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' onclick='loadsuit(\"Recase\")'>Next</button>
					
				</td></tr>
			</table>";
		}
		else
		{
			$str_html.="No Data Found";
		}
		$str_html.='</div>';
		echo $str_html."####".$csrf_token;
	}

	function get_case_info_ad(){
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$rows = $this->Hc_matter_model->get_case_info_ad($id);
		$history = $this->Hc_matter_model->get_case_history_ad($id);
		$var['history']=$history;
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}

	function add_edit_case_status_update_ad($add_edit,$edit_row=null){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Hc_matter_model->add_edit_case_status_update_ad($add_edit,$edit_row);
			if($id>0){
				$text = array();
			}else{
				$text[]=$id;
			}
		}
		else{
			$text[]="Session out, login required";

		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=[];
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

	function hc_caseup_edit_ad(){
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$history_id = $this->input->post('history_id');
		$rows = $this->Hc_matter_model->hc_caseup_edit_ad($id,$history_id);
		$expense = $this->Hc_matter_model->get_case_expense_edit_info($id,'AD Matter',$history_id);
		$history = $this->Hc_matter_model->get_case_history_ad($id);
		$var['history']=$history;
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		$var['expenses']=$expense;
		echo json_encode($var);
	}

	function status_delete_action_ad(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Hc_matter_model->status_delete_action_ad();
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


	// Case Details Search

	function hc_case_deatails_xl()
    {

        $where='';
        $portfolio = trim((string)$this->input->post('portfolio')); 
        $case_type = trim((string)$this->input->post('case_type')); 
        $present_status = trim((string)$this->input->post('present_status')); 
        $case_number = trim((string)$this->input->post('case_number')); 
        $ac_no = trim((string)$this->input->post('ac_no')); 
        
        $result = $this->Hc_matter_model->hc_case_details_xl();
        $sn = 1;
        
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
        $rowNumber=1;
        $headings2 = array('SL No.','Division','Case Category','Case Types','CASE NO','A/C NO','A/C NAME','Case Claim','Appeal/Misc/Writ/Others filing Date','NAME OF DIST','Status','LAST ACTIVITIES DATE','PRESENT CAUSE OF ACTION','NAME OF HIGH COURT BENCH','NAME OF HIGH COURT LAWYER','REMARKS','Closing Status','Power Submit (Yes/No)','Dealing ofiicer','50% Deposited money (Yes/No)','File/Request Receive Date','Assigned Lawyer','Compromised','LCR Send','LCR Received','Appeal Money Withdraw Date','Amount Of Appeal Money');

       $cols = count($headings2)-1;
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->applyFromArray($styleArray_border);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        
        $rowNumber++;
        $tem=0;
        $total=count($result);
       	foreach($result as $key=> $row){
       		$i= $key+1;
            $dataar=array(
            	$i,
            	$row['division_name'],
            	$row['case_category_name'],
            	$row['hc_type_name'],
            	$row['case_no'],
            	$row['ac_number'],
            	$row['ac_name'],
            	$row['case_claim'],
            	$row['filing_date'],
            	$row['district_name'],
            	$row['case_sts_name'],
            	$row['last_act'],
            	$row['present_cause_action'],
            	$row['hc_bench_name'],
            	$row['assigned_lawyer_name'],
            	$row['remarks'],
            	$row['ac_closing_status'],
            	$row['power_submit'],
            	$row['hc_officer'],
            	$row['deposit_am_50'],
            	$row['file_receive_date'],
            	$row['assigned_lawyer_name'],
            	$row['compromised'],
            	$row['lcr_send_memo'],
            	$row['lcr_receive_memo'],
            	$row['withdrawn_date'],
            	$row['withdrawn_amt'],
            );
            
			$objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('F'.$rowNumber), $row['ac_number'], PHPExcel_Cell_DataType::TYPE_STRING);
            $rowNumber++;
            
        }
        //$d=$d+($tem*4);  
        $rowNumber++;
        $rowNumber--;
        $rowNumber--;
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.xl_col($cols).$rowNumber)->applyFromArray($styleArray_border); 


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('HC Matter Details'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_clean();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="hc_matter_details.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
    }

    function ad_case_deatails_xl()
    {

        $where='';
        $portfolio = trim((string)$this->input->post('portfolio')); 
        $case_type = trim((string)$this->input->post('case_type')); 
        $present_status = trim((string)$this->input->post('present_status')); 
        $case_number = trim((string)$this->input->post('case_number')); 
        $ac_no = trim((string)$this->input->post('ac_no')); 
        
        $result = $this->Hc_matter_model->ad_case_details_xl();
        $sn = 1;
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
        
        $rowNumber=1;
        $headings2 = array('SL No.','A/C NO','A/C NAME','Case Category','Case Types','CASE NO','Case Claim','Appeal/Misc/Writ/Others filing Date','NAME OF DIST','Status','LAST ACTIVITIES DATE','PRESENT CAUSE OF ACTION','NAME OF HIGH COURT BENCH','NAME OF HIGH COURT LAWYER','REMARKS','Closing Status','Power Submit (Yes/No)','Dealing ofiicer','50% Deposited money (Yes/No)','File/Request Receive Date','Assigned Lawyer','Compromised','LCR Send','LCR Received','Appeal Money Withdraw Date','Amount Of Appeal Money');

        $cols = count($headings2)-1;
        $objPHPExcel->getActiveSheet()->getStyle('B')->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_TEXT);

        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->applyFromArray($styleArray_border);
        
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($cols).$rowNumber)->getFont()->setBold(true);
       
        
        $rowNumber++;
        $tem=0;
        $total=count($result);
       	foreach($result as $key=> $row){
       		$i= $key+1;
            $dataar=array(
            	$i,
            	$row['ac_number'],
            	$row['ac_name'],
            	$row['case_category_name'],
            	$row['hc_type_name'],
            	$row['case_no'],
            	$row['case_claim'],
            	$row['filing_date'],
            	$row['district_name'],
            	$row['case_sts_name'],
            	$row['last_act'],
            	$row['present_cause_action'],
            	$row['hc_bench_name'],
            	$row['assigned_lawyer_name'],
            	$row['remarks'],
            	$row['ac_closing_status'],
            	$row['power_submit'],
            	$row['hc_officer'],
            	$row['deposit_am_50'],
            	$row['file_receive_date'],
            	$row['assigned_lawyer_name'],
            	$row['compromised'],
            	$row['lcr_send_memo'],
            	$row['lcr_receive_memo'],
            	$row['withdrawn_date'],
            	$row['withdrawn_amt'],
            );
            
			$objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $row['ac_number'], PHPExcel_Cell_DataType::TYPE_STRING);
            $rowNumber++;
            
        }

        //$d=$d+($tem*4);  
        $rowNumber++;
        $rowNumber--;
        $rowNumber--;
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.xl_col($cols).$rowNumber)->applyFromArray($styleArray_border); 

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('AD Matter Details'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_clean();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="ad_matter_details.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
    }

    function get_hc_case_details(){
    	$csrf_token=$this->security->get_csrf_hash();
		$row =$this->Hc_matter_model->hc_case_details();

		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row;
		echo json_encode($var);

    }
    function get_ad_case_details(){
    	$csrf_token=$this->security->get_csrf_hash();
		$row =$this->Hc_matter_model->ad_case_details();

		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row;
		echo json_encode($var);

    }
    function get_data_details_preview($id){
		$csrf_token=$this->security->get_csrf_hash();
		if($id!=''){
			$rows = $this->Hc_matter_model->get_data_details_preview($id);
		}else{
			$rows='';
		}
		echo $rows.'####'.$csrf_token;
	
    }
    function get_data_details_preview_ad($id){
		$csrf_token=$this->security->get_csrf_hash();
		if($id!=''){
			$rows = $this->Hc_matter_model->get_data_details_preview_ad($id);
		}else{
			$rows='';
		}
		echo $rows.'####'.$csrf_token;
	
    }

    function get_expense_amount()
    {
        $csrf_token=$this->security->get_csrf_hash();
        $sah=$this->Hc_matter_model->get_expense_amount($this->input->post('act_id'));//,$this->input->post('cma_district'),$this->input->post('req_type')
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
        echo json_encode($jTableResult);
    }
    function temp_file(){
    	$this->Common_model->delete_tempfile();
    	echo 'success';
    }


    // HC Bill Expenses 

    function get_expense_data_lawyer()
	{
		$vendor_id = $this->input->post('vendor');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Hc_matter_model->get_cost_details_lawyer($vendor_id,$bill_month);
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
	function lawyer_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Hc_matter_model->get_grid_data_lawyer($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function add_edit_lawyer_bill($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Hc_matter_model->add_edit_lawyer_bill($add_edit,$id,$editrow);
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

	function lawyer_bill_details()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Hc_matter_model->get_row_details_lawyer($id);
		$bill_details = $this->Hc_matter_model->get_lawyer_bill_details_by_id($id);
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

	function get_lawyer_edit_data()
	{
		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Hc_matter_model->get_add_action_data_lawyer($id);
		$bill_details = $this->Hc_matter_model->get_bill_details_lawyer($result->lawyer,$result->month,$result->year);
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

}