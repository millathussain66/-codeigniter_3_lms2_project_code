<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authorization_ho extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Authorization_ho_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('Cma_process_model', '', TRUE);
		$this->load->model('User_model', '', TRUE);
		$this->load->model('Authorization_request_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'authorization_ho/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function bulk_pdf()
	{
		$this->load->view('authorization_ho/pages/bulk_pdf');
	}
	function bulk_operation($operation=NULL)
	{
		$operation_name='';
		if ($operation=='apv') 
		{
			$operation_name='Approve';
		}
		if ($operation=='download') 
		{
			$operation_name='Download';
		}
		if($this->session->userdata['ast_user']['legal_region']!='')
        {
            $region_data = $this->user_model->get_parameter_data('ref_legal_region', 'id', 'data_status = 1 AND id IN('.$this->session->userdata['ast_user']['legal_region'].')');
        }
        else
        {
            $region_data = $this->user_model->get_parameter_data('ref_legal_region', 'id', 'data_status = 1');
        }
		$data = array( 	
			   'operation' => $operation,
			   'legal_region' =>$region_data,
			   'operation_name' => $operation_name,
			   'pages'=> 'authorization_ho/pages/bulk_operation',		   
			   );
		$this->load->view('authorization_ho/form_layout',$data);
	}
	function load_bulk_data()
	{
		$this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
	    $grid_data=$this->Authorization_ho_model->get_bulk_data();
	    $operation= $this->input->post('operation');
		$str='';
		$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
		<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<thead>
				<th width="2%"><input style="margin-left:7px" type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
				<th width="3%"  style="font-weight: bold;text-align:center">P</th>
				<th width="25%" style="font-weight: bold;text-align:left">Type</th>
				<th width="30%" style="font-weight: bold;text-align:left">Send For Authorization By</th>
				<th width="30%" style="font-weight: bold;text-align:left">Send For Authorization Date</th>
				<th width="30%" style="font-weight: bold;text-align:left">Approve Date</th>
			</thead>
			<tbody>';	
	
		if(count($grid_data)<=0)
		{
			$str.='<tr><td colspan="5" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
			$str.='<input type="hidden" name="event_counter" id="event_counter" value="0">';
			$str.='</tbody></table></div>';
		}
		else{
			$i=1;
			foreach ($grid_data as $data) {
				$str.='<tr>';
				$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$data->id.'"><input type="hidden" name="event_id_'.$i.'" id="event_id_'.$i.'" value="'.$data->event_id.'"><input type="hidden" name="operation_type_'.$i.'" id="operation_type_'.$i.'" value="'.$data->authorization_type.'"><input type="hidden" name="event_name_'.$i.'" id="event_name_'.$i.'" value="'.$data->event_name.'"></td>';
				$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\','.$data->authorization_type.','.$data->event_id.')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
				$str.='<td align="left">'.$data->type.'</td>';
				$str.='<td align="left">'.$data->sfa_by.'</td>';
				$str.='<td align="left">'.$data->sfa_dt.'</td>';
				$str.='<td align="left">'.$data->auth_dt.'</td>';
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
	function grid()
	{
		$this->load->model('Authorization_ho_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Authorization_ho_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function formverify($id=NULL,$event_id=NULL,$type=NULL,$editrow=NULL)
	{
		$details=array();
		$change_data=array();
		$close_flag = '';
		$result = $this->Authorization_ho_model->get_add_action_data($id);
		if ($type==3) {
			$details=$this->Authorization_ho_model->get_bail_money_details($event_id);
		}
		else
		{
			if($result->event_name=='cma')
			{
				$details = $this->Authorization_ho_model->get_details_cma_authorization($id,$event_id);
			}
			else
			{
				$details = $this->Authorization_ho_model->get_details_suit_authorization($id);
			}
		}
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'details' => $details,
				   'event_name' => $result->event_name,
				   'id' => $id,
				   'event_id' => $event_id,
				   'type' => $type,
				   'pages'=> 'authorization_ho/pages/form_verify',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('authorization_ho/form_layout',$data);
	}
	function delete_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Authorization_ho_model->delete_action();
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
			else{$row=$this->Authorization_ho_model->get_add_action_data($id);}
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
	function add_edit_suit_filling()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Authorization_ho_model->add_edit_suit_filling();
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
	function get_peramater_name($table,$where=NULL)
	{
		$data = $this->User_model->get_parameter_name($table,$where);
		return $data;
	}
	function details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$type = $this->input->post('type');
		$id = $this->input->post('deleteEventId');
		$event_id = $this->input->post('EventId');
		$result = $this->Authorization_ho_model->get_add_action_data($this->input->post('deleteEventId'));
		if ($type==3) {
			$details=$this->Authorization_ho_model->get_bail_money_details($event_id);
		}
		else
		{
			if($result->event_name=='cma')
			{
				$details = $this->Authorization_ho_model->get_details_cma_authorization($id,$event_id);
			}
			else
			{
				$details = $this->Authorization_ho_model->get_details_suit_authorization($id);
			}
			
		}
    	if (!empty($details) && $result->event_name=='cma') 
    	{
    		if ($details->final_ln!='') {
    			$final_ln='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/ln_scan_copy/'.$details->final_ln.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
    		}else{$final_ln="";}
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>Authorization Type:</strong>'.$result->type.'</td>
						<td width="50%" align="left"><strong>Status:</strong>'.$result->status.'</td>
						
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Loan AC.:</strong>'.$details->loan_ac.'</td>
						<td width="50%" align="left"><strong>AC Name:</strong>'.$details->ac_name.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Selected Lawyer:</strong>'.$details->lawyer.'</td>
						<td width="50%" align="left"><strong>Legal Notice Sent Date:</strong>'.$details->ln_sent_date.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Legal Notice Validity Date:</strong>'.$details->ln_val_dt.'</td>
						<td width="50%" align="left"><strong>Legal Notice Status:</strong>'.$details->ln_status.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Final Legal Notice: </strong>'.$final_ln.'</td>
						
						<td width="50%" align="left"><strong>Total Final LN:</strong> '.$details->total_final_ln.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Send For Authorization By:</strong>'.$result->sfa_by.'</td>
						<td width="50%" align="left"><strong>Send For Authorization Date:</strong>'.$result->sfa_dt.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Authorized By:</strong>'.$result->auth_by.'</td>
						<td width="50%" align="left"><strong>Authorized Date:</strong>'.$result->auth_dt.'</td>
					</tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($details) && $result->event_name=='suit_file') 
    	{
    		
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>Authorization Type:</strong>'.$details->authorization_type_name.'</td>
						<td width="50%" align="left"><strong>Case Name:</strong>'.$details->case_name.'</td>
						
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Loan AC.:</strong>'.$details->loan_ac.'</td>
						<td width="50%" align="left"><strong>AC Name:</strong>'.$details->ac_name.'</td>
						
					</tr>';
				$str .='<tr>
							<td width="50%" align="left"><strong>Case Number:</strong>'.$details->case_number.'</td>
							<td width="50%" align="left"><strong>Borrower Name:</strong> '.$details->brrower_name.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Propaitor Address:</strong>'.$details->current_address.'</td>
							<td width="50%" align="left"><strong>Type Of Case:</strong> '.$details->req_type.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Present Representive:</strong>'.$details->filling_plaintiff.'</td>
							<td width="50%" align="left"><strong>New Representive:</strong> '.$details->new_representive.'</td>
						</tr>';
				$str.='<tr>
						<td width="50%" align="left"><strong>Send For Authorization By:</strong>'.$details->sfa_by.'</td>
						<td width="50%" align="left"><strong>Send For Authorization Date Time:</strong>'.$details->sfa_dt.'</td>
					</tr>
					';
			$str.='</tbody>
				</table>';
				
    	}

    	if(!empty($details) && $type==3){

    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>Authorization Type:</strong>'.$result->type.'</td>
						<td width="50%" align="left"><strong>Status:</strong>'.$result->status.'</td>
						
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Loan AC.:</strong>'.$details->loan_ac.'</td>
						<td width="50%" align="left"><strong>AC Name:</strong>'.$details->ac_name.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Case Number:</strong>'.$details->case_number.'</td>
						<td width="50%" align="left"><strong>Arrested:</strong>'.$details->arrested.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Deposited Amount:</strong>'.$details->deposit_amt.'</td>
						<td width="50%" align="left"><strong>Deposit Date:</strong>'.$details->deposit_date.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Send For Authorization By:</strong>'.$result->sfa_by.'</td>
						<td width="50%" align="left"><strong>Send For Authorization Date:</strong>'.$result->sfa_dt.'</td>
						
					</tr>
					</tbody>
					</table>';
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
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Authorization_ho_model->bulk_acktion();
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
	function download($id=NULL,$event_id=NULL,$type=NULL)
	{
		if(empty($id) && $id!=0)
    	{
    		redirect('/e404');
    	}
		if($id==0)//when download request comes from case management grid
		{
			$event_name = 'cma';
		}
		else //when download request comes from authorization ho and authorization request grid
		{
			$str="SELECT  j0.event_name,j0.authorization_type
	             FROM authorization j0
	         WHERE j0.sts != '0'  AND j0.id= ".$this->db->escape($id)." LIMIT 1";
	        $change_data=$this->db->query($str)->row();
	        $event_name = $change_data->event_name;
		}
		
		//For CMA Suit File Authorization memo
		if ($event_name=='cma') 
		{
			$details=$this->Authorization_ho_model->get_details_cma_authorization($id,$event_id);
			if ($details->au_serial=='' && $details->au_serial==NULL) {
				$new_sl_no=$this->user_model->get_au_serial(1);
				$au_data['au_serial'] = $new_sl_no;
				$this->db->where('id', $id);
				$this->db->update('authorization', $au_data);
				$this->user_model->update_au_serial(1);
			}else
			{
				$new_sl_no = $details->au_serial;
			}
			$ref = 'BBL/HO/LMD /'.date('Y').'/'.$new_sl_no;
			include_once('tbs/clas/tbs_class.php'); // Load the TinyButStrong template engine
			include_once('tbs/clas/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin
			
			// prevent from a PHP configuration problem when using mktime() and date()
			if (version_compare(PHP_VERSION,'5.1.0')>=0) {
				if (ini_get('date.timezone')=='') {
					date_default_timezone_set('UTC');
				}
			}
			
			// Initialize the TBS instance
			$TBS = new clsTinyButStrong; // new instance of TBS
			$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin
			
			if (!empty($details)) {
				if($details->req_type==2) // For Aurtho Rin Authorization Memo
				{
					$template = 'tbs/authorization/filling_ara.docx';
					$filename =	'Filling_ARA_AUTHORIZATION.docx';
				}
				else
				{
					$template = 'tbs/authorization/filling_ni_act.docx';
					$filename =	'Filling_NIACT_AUTHORIZATION.docx';
				}
			}

			$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
			$counter=0;
			$data_b[]= array(
				'ref'=>$ref,
				'date'=>date('M-d-Y'),
				'plaintiff_name'=>$details->plaintiff_name,
				'plaintiff_pin'=>$details->plaintiff_pin,
				'plaintiff_designation'=>$details->functional_designation,
				'borrower_name'=>ucwords(strtolower($details->brrower_name)),
				'loan_ac'=>$details->loan_ac,
				'ac_name'=>ucwords(strtolower($details->ac_name)),
				'parmanent_address'=>ucwords(strtolower($details->current_address))
			);
			$TBS->MergeBlock('b', $data_b);
			$save_as='';
			$path='tbs/loan_LN_rslt/';
			$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
			//$output_file_name =$path.$filename;
			//$TBS->Show(OPENTBS_FILE, $output_file_name);
			
			$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
			
			exit;
		}
		if ($event_name=='suit_file') 
		{
			$details = $this->Authorization_ho_model->get_details_suit_authorization($id);
			if ($details->au_serial=='' && $details->au_serial==NULL) {
				//Get The New Serial
				$new_sl_no=$this->user_model->get_au_serial(1);
				//Update The New Serial in db
				$au_data['au_serial'] = $new_sl_no;
				$this->db->where('id', $id);
				$this->db->update('authorization', $au_data);
				//Update THe new serial in serial table also
				$this->user_model->update_au_serial(1);
			}else
			{
				$new_sl_no = $details->au_serial;
			}
			$ref = 'BBL/HO/LMD /'.date('Y').'/'.$new_sl_no;

			include_once('tbs/clas/tbs_class.php'); // Load the TinyButStrong template engine
			include_once('tbs/clas/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin
			
			// prevent from a PHP configuration problem when using mktime() and date()
			if (version_compare(PHP_VERSION,'5.1.0')>=0) {
				if (ini_get('date.timezone')=='') {
					date_default_timezone_set('UTC');
				}
			}
			
			// Initialize the TBS instance
			$TBS = new clsTinyButStrong; // new instance of TBS
			$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin
			
			if (!empty($details)) {
				/////////////For Filling Authorization Memo
				if($details->authorization_type==8 || $details->authorization_type==1)
				{
					if ($details->authorization_type==8) { //For Ni Act and others authorization Memo
						$template = 'tbs/authorization/filling_ni_act.docx';
						$filename =	'Filling_ARA_AUTHORIZATION.docx';
					}
					else if($details->authorization_type==1) // For Aurtho Rin Authorization Memo
					{
						$template = 'tbs/authorization/filling_ara.docx';
						$filename =	'Filling_NIACT_AUTHORIZATION.docx';
					}
					$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
					$counter=0;
					$data_b[]= array(
						'ref'=>$ref,
						'date'=>date('M-d-Y'),
						'plaintiff_name'=>$details->plaintiff_name,
						'plaintiff_pin'=>$details->plaintiff_pin,
						'plaintiff_designation'=>$details->functional_designation,
						'borrower_name'=>ucwords(strtolower($details->brrower_name)),
						'loan_ac'=>$details->loan_ac,
						'ac_name'=>ucwords(strtolower($details->ac_name)),
						'parmanent_address'=>ucwords(strtolower($details->current_address))
					);
					$TBS->MergeBlock('b', $data_b);
					$save_as='';
					$path='tbs/loan_LN_rslt/';
					$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
					//$output_file_name =$path.$filename;
					//$TBS->Show(OPENTBS_FILE, $output_file_name);
					
					$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.

				}
				if($details->authorization_type==2) //Filling Jari Format
				{
					$template = 'tbs/authorization/filling_jari.docx';
					$filename =	'Filling_Jari_AUTHORIZATION.docx';
					$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
					$counter=0;
					$data_b[]= array(
						'ref'=>$ref,
						'date'=>date('M-d-Y'),
						'plaintiff_name'=>$details->plaintiff_name,
						'case_number'=>$details->case_number,
						'plaintiff_pin'=>$details->plaintiff_pin,
						'plaintiff_designation'=>$details->functional_designation,
						'borrower_name'=>ucwords(strtolower($details->brrower_name)),
						'loan_ac'=>$details->loan_ac,
						'ac_name'=>ucwords(strtolower($details->ac_name)),
						'parmanent_address'=>ucwords(strtolower($details->current_address)),
						'case_number'=>$details->case_number,
					);
					$TBS->MergeBlock('b', $data_b);
					$save_as='';
					$path='tbs/loan_LN_rslt/';
					$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
					//$output_file_name =$path.$filename;
					//$TBS->Show(OPENTBS_FILE, $output_file_name);
					
					$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				}
				if($details->authorization_type==4) //Plaintiff ARA Format
				{
					$prev_name = $this->get_peramater_name('users_info',"j0.id=".$details->prev_item." AND j0.data_status=1");
					$new_name = $this->get_peramater_name('users_info',"j0.id=".$details->new_item." AND j0.data_status=1");
					$template = 'tbs/authorization/Plaintiff_ARA.docx';
					$filename =	'DEALING_OFFICER_ARA_AUTHORIZATION.docx';
					$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
					$counter=0;
					$data_b[]= array(
						'ref'=>$ref,
						'date'=>date('M-d-Y'),
						'new_plaintiff'=>$new_name->name,
						'new_plaintiff_pin'=>$new_name->pin,
						'new_plaintiff_deg'=>$new_name->desig,
						'court_name'=>$details->court_name,
						'case_no'=>$details->case_number,
						'borrower_name'=>ucwords(strtolower($details->brrower_name)),
						'ac_name'=>ucwords(strtolower($details->ac_name)),
						'address'=>ucwords(strtolower($details->current_address)),
						'present_plaintiff'=>$prev_name->name,
						'present_plaintiff_pin'=>$prev_name->pin,
						'present_plaintiff_deg'=>$prev_name->desig
					);
					$TBS->MergeBlock('b', $data_b);
					$save_as='';
					$path='tbs/loan_LN_rslt/';
					$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
					//$output_file_name =$path.$filename;
					//$TBS->Show(OPENTBS_FILE, $output_file_name);
					
					$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				}
				if($details->authorization_type==9) //Plaintiff NI ACT Format
				{
					$prev_name = $this->get_peramater_name('users_info',"j0.id=".$details->prev_item." AND j0.data_status=1");
					$new_name = $this->get_peramater_name('users_info',"j0.id=".$details->new_item." AND j0.data_status=1");
					$template = 'tbs/authorization/Plaintiff_NI.docx';
					$filename =	'DEALING_OFFICER_NI_AUTHORIZATION.docx';
					$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
					$counter=0;
					$data_b[]= array(
						'ref'=>$ref,
						'date'=>date('M-d-Y'),
						'new_plaintiff'=>$new_name->name,
						'new_plaintiff_pin'=>$new_name->pin,
						'new_plaintiff_deg'=>$new_name->desig,
						'court_name'=>$details->court_name,
						'case_no'=>$details->case_number,
						'borrower_name'=>ucwords(strtolower($details->brrower_name)),
						'ac_name'=>ucwords(strtolower($details->ac_name)),
						'address'=>ucwords(strtolower($details->current_address)),
						'present_plaintiff'=>$prev_name->name,
						'present_plaintiff_pin'=>$prev_name->pin,
						'present_plaintiff_deg'=>$prev_name->desig
					);
					$TBS->MergeBlock('b', $data_b);
					$save_as='';
					$path='tbs/loan_LN_rslt/';
					$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
					//$output_file_name =$path.$filename;
					//$TBS->Show(OPENTBS_FILE, $output_file_name);
					
					$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				}
				if($details->authorization_type==5) //ARA Witness Format
				{
					$template = 'tbs/authorization/ara_witness.docx';
					$filename =	'ARA_Witness_AUTHORIZATION.docx';
					$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
					$counter=0;
					$data_b[]= array(
						'ref'=>$ref,
						'date'=>date('M-d-Y'),
						'plaintiff_name'=>$details->plaintiff_name,
						'case_number'=>$details->case_number,
						'court_name'=>$details->court_name,
						'plaintiff_pin'=>$details->plaintiff_pin,
						'plaintiff_designation'=>$details->functional_designation,
						'borrower_name'=>ucwords(strtolower($details->brrower_name)),
						'loan_ac'=>$details->loan_ac,
						'ac_name'=>ucwords(strtolower($details->ac_name)),
						'parmanent_address'=>ucwords(strtolower($details->current_address))
					);
					$TBS->MergeBlock('b', $data_b);
					$save_as='';
					$path='tbs/loan_LN_rslt/';
					$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
					//$output_file_name =$path.$filename;
					//$TBS->Show(OPENTBS_FILE, $output_file_name);
					
					$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				}
				if($details->authorization_type==6) //ARA Withdraw Format
				{
					$template = 'tbs/authorization/withdraw_ara.docx';
					$filename =	'ARA_Withdraw_AUTHORIZATION.docx';
					$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
					$counter=0;
					$data_b[]= array(
						'ref'=>$ref,
						'date'=>date('M-d-Y'),
						'plaintiff_name'=>$details->plaintiff_name,
						'case_number'=>$details->case_number,
						'court_name'=>$details->court_name,
						'plaintiff_pin'=>$details->plaintiff_pin,
						'plaintiff_designation'=>$details->functional_designation,
						'borrower_name'=>ucwords(strtolower($details->brrower_name)),
						'loan_ac'=>$details->loan_ac,
						'ac_name'=>ucwords(strtolower($details->ac_name)),
						'parmanent_address'=>ucwords(strtolower($details->current_address))
					);
					$TBS->MergeBlock('b', $data_b);
					$save_as='';
					$path='tbs/loan_LN_rslt/';
					$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
					//$output_file_name =$path.$filename;
					//$TBS->Show(OPENTBS_FILE, $output_file_name);
					
					$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				}
				if($details->authorization_type==10) //NI ACT Witness Format
				{
					$template = 'tbs/authorization/witness_ni.docx';
					$filename =	'NI_Witness_AUTHORIZATION.docx';
					$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
					$counter=0;
					$data_b[]= array(
						'ref'=>$ref,
						'date'=>date('M-d-Y'),
						'plaintiff_name'=>$details->plaintiff_name,
						'case_number'=>$details->case_number,
						'court_name'=>$details->court_name,
						'plaintiff_pin'=>$details->plaintiff_pin,
						'plaintiff_designation'=>$details->functional_designation,
						'borrower_name'=>ucwords(strtolower($details->brrower_name)),
						'loan_ac'=>$details->loan_ac,
						'ac_name'=>ucwords(strtolower($details->ac_name)),
						'parmanent_address'=>ucwords(strtolower($details->current_address))
					);
					$TBS->MergeBlock('b', $data_b);
					$save_as='';
					$path='tbs/loan_LN_rslt/';
					$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
					//$output_file_name =$path.$filename;
					//$TBS->Show(OPENTBS_FILE, $output_file_name);
					
					$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				}
				if($details->authorization_type==11) //NI ACT Appear Appel Case Format
				{
					$template = 'tbs/authorization/appeal_case_appear_ni.docx';
					$filename =	'NI_Appear_in_appel_AUTHORIZATION.docx';
					$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
					$counter=0;
					$data_b[]= array(
						'ref'=>$ref,
						'date'=>date('M-d-Y'),
						'plaintiff_name'=>$details->plaintiff_name,
						'case_number'=>$details->case_number,
						'court_name'=>$details->court_name,
						'plaintiff_pin'=>$details->plaintiff_pin,
						'plaintiff_designation'=>$details->functional_designation,
						'borrower_name'=>ucwords(strtolower($details->brrower_name)),
						'loan_ac'=>$details->loan_ac,
						'ac_name'=>ucwords(strtolower($details->ac_name)),
						'parmanent_address'=>ucwords(strtolower($details->current_address))
					);
					$TBS->MergeBlock('b', $data_b);
					$save_as='';
					$path='tbs/loan_LN_rslt/';
					$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
					//$output_file_name =$path.$filename;
					//$TBS->Show(OPENTBS_FILE, $output_file_name);
					
					$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				}
				if($details->authorization_type==7) //ARA Appear Appel Case Format
				{
					$template = 'tbs/authorization/appeal_case_appear_ara.docx';
					$filename =	'ARA_Appear_in_appel_AUTHORIZATION.docx';
					$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
					$counter=0;
					$data_b[]= array(
						'ref'=>$ref,
						'date'=>date('M-d-Y'),
						'plaintiff_name'=>$details->plaintiff_name,
						'case_number'=>$details->case_number,
						'court_name'=>$details->court_name,
						'plaintiff_pin'=>$details->plaintiff_pin,
						'plaintiff_designation'=>$details->functional_designation,
						'borrower_name'=>ucwords(strtolower($details->brrower_name)),
						'loan_ac'=>$details->loan_ac,
						'ac_name'=>ucwords(strtolower($details->ac_name)),
						'parmanent_address'=>ucwords(strtolower($details->current_address))
					);
					$TBS->MergeBlock('b', $data_b);
					$save_as='';
					$path='tbs/loan_LN_rslt/';
					$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
					//$output_file_name =$path.$filename;
					//$TBS->Show(OPENTBS_FILE, $output_file_name);
					
					$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				}
				if($details->authorization_type==12) //NI ACT Withdraw Format
				{
					$template = 'tbs/authorization/withdraw_ni.docx';
					$filename =	'NI_Withdraw_AUTHORIZATION.docx';
					$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
					$counter=0;
					$data_b[]= array(
						'ref'=>$ref,
						'date'=>date('M-d-Y'),
						'plaintiff_name'=>$details->plaintiff_name,
						'case_number'=>$details->case_number,
						'court_name'=>$details->court_name,
						'plaintiff_pin'=>$details->plaintiff_pin,
						'plaintiff_designation'=>$details->functional_designation,
						'borrower_name'=>ucwords(strtolower($details->brrower_name)),
						'loan_ac'=>$details->loan_ac,
						'ac_name'=>ucwords(strtolower($details->ac_name)),
						'parmanent_address'=>ucwords(strtolower($details->current_address))
					);
					$TBS->MergeBlock('b', $data_b);
					$save_as='';
					$path='tbs/loan_LN_rslt/';
					$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
					//$output_file_name =$path.$filename;
					//$TBS->Show(OPENTBS_FILE, $output_file_name);
					
					$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				}
				if($details->authorization_type==13) //NI Appeal Withdraw Format
				{
					$template = 'tbs/authorization/appeal_withdraw_ni.docx';
					$filename =	'NI_Appeal_Withdraw_AUTHORIZATION.docx';
					$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
					$counter=0;
					$data_b[]= array(
						'ref'=>$ref,
						'date'=>date('M-d-Y'),
						'plaintiff_name'=>$details->plaintiff_name,
						'case_number'=>$details->case_number,
						'court_name'=>$details->court_name,
						'plaintiff_pin'=>$details->plaintiff_pin,
						'plaintiff_designation'=>$details->functional_designation,
						'borrower_name'=>ucwords(strtolower($details->brrower_name)),
						'loan_ac'=>$details->loan_ac,
						'ac_name'=>ucwords(strtolower($details->ac_name)),
						'parmanent_address'=>ucwords(strtolower($details->current_address))
					);
					$TBS->MergeBlock('b', $data_b);
					$save_as='';
					$path='tbs/loan_LN_rslt/';
					$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
					//$output_file_name =$path.$filename;
					//$TBS->Show(OPENTBS_FILE, $output_file_name);
					
					$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				}

				
			}

			exit;
		}
			
		
	}
	function bulk_download_pdf($ids)
	{
		$data = array( 'id'=>$ids,'bulk'=>1,'controller'=>$this );
		$this->load->view('authorization_ho/pages/bulk_pdf',$data);
		
	}
}
?>
