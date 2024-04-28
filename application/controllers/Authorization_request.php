<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authorization_request extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Authorization_request_model', '', TRUE);
		$this->load->model('Authorization_ho_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('Legal_file_process_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{
		$this->Common_model->delete_tempfile();
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'plaintiff' => $this->User_model->get_parameter_data('users_info','name','data_status = 1  AND admin_status<>2 AND legal_district<>0 AND legal_district!="" AND legal_district IS NOT NULL AND block_status = 0'),
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'court' => $this->User_model->get_parameter_data('ref_court','name','data_status = 1'),
					'pages'=> 'authorization_request/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function grid()
	{
		$this->load->model('Authorization_request_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Authorization_request_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function form($add_edit,$suit_file_id=NULL,$cma_id=NULL,$edit_id=NULL)
	{
		$details=array();
		$plaintiff = array();
		$lawyer = array();
		$suit_file_info = $this->Authorization_ho_model->get_suit_filling_details_by_id($suit_file_id);
		if ($add_edit=='edit') {
			$result = $this->Authorization_request_model->get_add_action_data($edit_id);
			$expense_data = $this->Authorization_request_model->get_expense_data($edit_id);
		}else{
			$result = array();
			$expense_data = array();
			
		}
		$data = array( 	
				   'option' => '',
				   'suit_file_info' => $suit_file_info,
				   'result' => $result,
				   'add_edit' => $add_edit,
				   'suit_file_id' => $suit_file_id,
				   'expense_data' => $expense_data,
				   'cma_id' => $cma_id,
				   'edit_id' => $edit_id,
				   'district' => $this->User_model->get_parameter_data('ref_district','name','data_status = 1'),
				   'change_type' => $this->User_model->get_parameter_data('ref_change_type','name','sts = 1 AND id<>4'),
				   'plaintiff' => $plaintiff,
				   'lawyer' => $lawyer,
				   'court' => $this->User_model->get_parameter_data('ref_court','name','data_status = 1'),
				   'expense_type' => $this->User_model->get_parameter_data('ref_expense_type','name','data_status = 1'),
				   'pages'=> 'authorization_request/pages/add_form'		   
				   );
		$this->load->view('authorization_request/form_layout',$data);
	}
	function get_city_country($code=NULL,$table_name=NULL)
	{
		if($code!=NULL && $table_name!=NULL)
		{
			$city_country=$this->Common_model->get_city_country($code,$table_name);
			if (!empty($city_country)) {
				return $city_country->name;
			}else{return '';}
		}else{return '';}

	}
	function get_filing_info()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$suit_id = $this->input->post('id');
		$current_address = '';
		$borrower_name = '';
		$check=0;
		$corp_id='';
		$suit_info =$this->Legal_file_process_model->get_case_details_info($suit_id);
		if (!empty($suit_info)) {
			$Message='ok';
			if(empty($suit_info->current_address))//calling web service for propritor address  and borrower name
			{
				$this->load->library('WebService');
				$ws = new WebService();
				if($suit_info->proposed_type=='Loan')
				{
					$loan_ac = $suit_info->loan_ac;
					$cif =substr($loan_ac,5,8);
					$api_config3=$this->Common_model->get_api_config_data('CBS Middleware','Loan Details');
					if ($api_config3->active_sts==1) {
						$results = $ws->call_service('GetLoanDetalsByCif',$api_config3->dev_live,$api_config3->api_url,$api_config3->user_id,$api_config3->channel_id,$api_config3->password,$cif,$loan_ac);
						if (!empty($results)) {
							for ($i=1; $i <=count($results); $i++) 
							{ 
								if ($results[$i]['accountNumber']==$loan_ac) {
									$check=1;
									$corp_id=$results[$i]['corp_id'];
									$api_config4=$this->Common_model->get_api_config_data('CBS','n/a');
									if ($api_config4->active_sts==1) {
										//For Corporate Account
										if ($corp_id[0]!='') 
										{
											//$results3 = $ws->call_service('GetGuarantorFatherInfocorporateByCif',$api_config4->dev_live,$api_config4->api_url,$api_config4->user_id,$api_config4->channel_id,$api_config4->password,$cif);
											$results3 = $ws->call_service('GetBorrowerDetailsByCif',$api_config4->dev_live,$api_config4->api_url,$api_config4->user_id,$api_config4->channel_id,$api_config4->password,$cif);
											$borrower_name = $results3[1]['nameproprietor'][0];
										}
										else//For Retails Account
										{
											$results3 = $ws->call_service('GetGuarantorFatherInfoByCif',$api_config4->dev_live,$api_config4->api_url,$api_config4->user_id,$api_config4->channel_id,$api_config4->password,$cif);
										}
										$current_address=ucwords(strtolower($results3[1]['present_address1'][0].$results3[1]['present_address2'][0].$results3[1]['present_address3'][0].' '.$this->get_city_country($results3[1]['present_address_city'][0],'ref_city')));
							
									}
									break;
								}
							}
						}
					}
					
				}
				else
				{
					$loan_ac = $this->Common_model->stringEncryption('decrypt',$suit_info->org_loan_ac);
					$api_config=$this->Common_model->get_api_config_data('Card Pro Sys DB','cardpro');
					if ($api_config->active_sts==1) {
						$results = $this->Common_model->get_card_data('GetCustomerInfoByCardNo',$loan_ac,$api_config->dev_live);
						if ($results['Message']=='ok') 
						{
							$current_address = $results['HOME_ADDR1'].','.$results['HOME_ADDR2'].','.$results['HOME_ADDR3'].','.$results['HOME_ADDR4'].','.$results['HOME_ADDR5'];
						}
					}
				}
			}
		}
		else{
			$Message='No Data';
		}
		$authorization_type =$this->User_model->get_parameter_data('ref_authorization_type','name','data_status = 1 AND req_type="'.$suit_info->req_type.'"');

		$var['csrf_token']=$csrf_token;
		$var['suit_info']=$suit_info;
		$var['current_address']=$current_address;
		$var['borrower_name']=$borrower_name;
		$var['authorization_type']=$authorization_type;
		$var['Message']=$Message;
		echo json_encode($var);
	}
	function get_edit_info()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$result =$this->Authorization_request_model->get_add_action_data($id);
		$suit_info =$this->Legal_file_process_model->get_case_details_info($result->suit_file_id);
		if (!empty($suit_info)) {
			$Message='ok';
		}
		else{
			$Message='No Data';
		}
		$authorization_type =$this->User_model->get_parameter_data('ref_authorization_type','name','data_status = 1 AND req_type="'.$suit_info->req_type.'"');

		$var['csrf_token']=$csrf_token;
		$var['suit_info']=$suit_info;
		$var['result']=$result;
		$var['authorization_type']=$authorization_type;
		$var['Message']=$Message;
		echo json_encode($var);
	}
	function get_dropdown_data()
    {
    	$csrf_token = $this->security->get_csrf_hash();
    	$district = $this->input->post('district');
    	$dropdown_name = $this->input->post('dropdown_name');
		$sah=$this->Authorization_request_model->get_dropdown_data($district,$dropdown_name);
        $jTableResult = array();
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
    function get_close_flag()
    {
    	$this->Common_model->delete_tempfile();
    	$csrf_token=$this->security->get_csrf_hash();
    	$close_flag = '';
		$suit_row = $this->db->query("SELECT c.proposed_type,c.cif,c.loan_ac,c.org_loan_ac
			FROM suit_filling_info as c 
			LEFT OUTER JOIN cma cm on(cm.id=c.cma_id)
			WHERE c.id=".$this->db->escape($_POST['suit_id'])." LIMIT 1")->row();
		if ($suit_row->proposed_type=='Loan') {
			$loan_ac= $suit_row->loan_ac;
		}else
		{
			$loan_ac= $this->Common_model->stringEncryption('decrypt',$suit_row->org_loan_ac);
		}
		$api_config3=$this->Common_model->get_api_config_data('CBS Middleware','Loan Details');
		if ($api_config3->active_sts==1) {
			$this->load->library('WebService');
			$ws = new WebService();
			$cif = substr($loan_ac,5,8);
			//Call service for Yflag status
				$service_result = $ws->call_service('GetLoanDetalsByCif',$api_config3->dev_live,$api_config3->api_url,$api_config3->user_id,$api_config3->channel_id,$api_config3->password,$cif,$loan_ac);
			if (!empty($service_result)) {
				for ($i=1; $i <=count($service_result); $i++) 
				{
					if ($service_result[$i]['accountNumber']==$loan_ac) {
						$close_flag = $service_result[$i]['acctClsStatus'];
					}
				}
			}
		}
		$var['csrf_token']=$csrf_token;
		$var['close_flag']=$close_flag;
		echo json_encode($var);
    }
    function get_activities()
    {
    	$csrf_token = $this->security->get_csrf_hash();
    	$type = $this->input->post('type');
    	$req_type = $this->input->post('req_type');
    	if($type==1 && $req_type==1)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ni','name','data_status = 1');
		}
		else if($type==1 && $req_type==2)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara','name','data_status = 1');
		}
		else if($type==1 && ($req_type==3 || $req_type==4)) //For Legal Notice And Others Case
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ni','name','data_status = 1');
		}
		else if($type==2)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_paper_bill_activities','name','data_status = 1');
		}
		else if($type==3)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_staff_conv_activities','name','data_status = 1');
		}
		else if($type==4)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_court_fee_activities','name','data_status = 1');
		}
		else if($type==5)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_court_entertainment_activities','name','data_status = 1');
		}
		else if($type==6)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_others_cost_activities','name','data_status = 1');
		}
        $jTableResult = array();
        if (!empty($expense_activities)) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $expense_activities;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['csrf_token'] = $csrf_token;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }
	function get_peramater_name($table,$where=NULL,$change_type=NULL)
	{
		$data = $this->User_model->get_parameter_name($table,$where,$change_type);
		return $data;
	}
	function formverify($id=NULL,$editrow=NULL,$event_id=NULL,$type=NULL)
	{
		$details=array();
		$change_data=array();
		$close_flag = '';
		$result = $this->Authorization_request_model->get_add_action_data($id);
		$details = $this->Authorization_request_model->get_details($id);
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'details' => $details,
				   'event_name' => 'suit_file',
				   'id' => $result->auth_id,
				   'event_id' => $id,
				   'type' => $type,
				   'pages'=> 'authorization_request/pages/form_verify',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('authorization_request/form_layout',$data);
	}
	function details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$type = $this->input->post('type');
		$id = $this->input->post('id');
		$details = $this->Authorization_request_model->get_details($this->input->post('id'));
		$prev_str = '';
		$new_str = '';
    	if (!empty($details)) 
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
						
					</tr>
					';
				if($details->authorization_type==6 || $details->authorization_type==12)
				{
					if ($details->y_flag_approval_file!='' && $details->y_flag_approval_file!=NULL) {
		                $y_flag_approval_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/y_flag_approval_file/'.$details->y_flag_approval_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
		            }else{$y_flag_approval_file="";}
					$str .='<tr>
							<td width="50%" align="left"><strong>Close Flag:</strong>'.$details->y_flag.'</td>
							<td width="50%" align="left"><strong>Approval File:</strong>'.$y_flag_approval_file.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Approver Name:</strong>'.$details->approver_name.'</td>
							<td width="50%" align="left"><strong>Approver Pin:</strong>'.$details->approver_pin.'</td>
							
						</tr>';
				}
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
						<td width="50%" align="left"><strong>Entry By:</strong>'.$details->e_by.'</td>
						<td width="50%" align="left"><strong>Entry Date Time:</strong>'.$details->e_dt.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Update By:</strong>'.$details->u_by.'</td>
						<td width="50%" align="left"><strong>Update Date Time:</strong>'.$details->u_dt.'</td>
					</tr>
					';
			$str.='</tbody>
				</table>';
				
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
			$id = $this->Authorization_request_model->delete_action();
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
			else{$row=$this->Authorization_request_model->get_add_action_data($id);}
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
	function give_authorization()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Authorization_request_model->give_authorization();
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
	function add_edit()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Authorization_request_model->add_edit();
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
		$sah=$this->Authorization_request_model->get_r_history($this->input->post('id'),$this->input->post('life_cycle'));
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
	function search_suit()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str_where = "c.sts<>0";//AND c.suit_sts=75
		if (trim($this->input->post('proposed_type')) != '') {
			if (trim($this->input->post('proposed_type'))=='Loan') {
				$str_where.= " AND c.loan_ac=".$this->db->escape(trim($this->input->post('loan_ac')));
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
	function bulk_operation($operation=NULL)
	{
		$operation_name='';
		if ($operation=='apv') 
		{
			$operation_name='Approve';
		}
		if ($operation=='sfa') 
		{
			$operation_name='Send For Approval';
		}
		$data = array( 	
			   'operation' => $operation,
			   'operation_name' => $operation_name,
			   'pages'=> 'authorization_request/pages/bulk_operation',		   
			   );
		$this->load->view('authorization_request/form_layout',$data);
	}
	function load_bulk_data()
	{
		$this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
	    if($this->input->post('operation')=='apv')
	    {
	    	$grid_data=$this->Authorization_request_model->get_bulk_data($this->input->post('operation'));
	    }
	    if($this->input->post('operation')=='sfa')
	    {
	    	$grid_data=$this->Authorization_request_model->get_bulk_data_sfa($this->input->post('operation'));
	    }
	    $operation= $this->input->post('operation');
		$str='';
		if($operation=='apv')
		{
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input style="margin-left:7px" type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="25%" style="font-weight: bold;text-align:left">Type</th>
					<th width="30%" style="font-weight: bold;text-align:left">Send For Authorization By</th>
					<th width="30%" style="font-weight: bold;text-align:left">Send For Authorization Date</th>
				</thead>
				<tbody>';	
		}
		if($operation=='sfa')
		{
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input style="margin-left:7px" type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="25%" style="font-weight: bold;text-align:left">Type</th>
					<th width="30%" style="font-weight: bold;text-align:left">Entry By</th>
					<th width="30%" style="font-weight: bold;text-align:left">Entry Date</th>
				</thead>
				<tbody>';
		}
	
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
				if($operation=='apv')
				{
					$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\','.$data->authorization_type.','.$data->event_id.')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
				}
				if($operation=='sfa')
				{
					$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details_sfa('.$data->id.',\'details\','.$data->authorization_type.','.$data->event_id.')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
				}
				$str.='<td align="left">'.$data->type.'</td>';
				$str.='<td align="left">'.$data->sfa_by.'</td>';
				$str.='<td align="left">'.$data->sfa_dt.'</td>';
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
			$id = $this->Authorization_request_model->bulk_acktion();
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
	function bulk_request()
	{
		$data = array( 	
		   'pages'=> 'authorization_request/pages/bulk_request',		   
		   );
		$this->load->view('authorization_request/form_layout',$data);
	}
	function templete ()
	{		
		$file='cma_file/authorization_request_exl_file/templete/Templete.xlsx';
    	//$file='cma_file/template_'.$department.'.xlsx';
		
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Expires: 0');
		header('Cache-Control: application/vnd.ms-excel');
		//header('Cache-Control: must-revalidate');  // for csv
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		flush();
		readfile($file);
		exit;
		
		
	}
	function file_validation()
	{
	   $this->load->helper('form');
       $csrf_token=$this->security->get_csrf_hash();     
	   $str='';       
       $destination_path = getcwd().DIRECTORY_SEPARATOR;
       //Removing Previous File
       $path = $destination_path.'/cma_file/authorization_request_exl_file/temp_excel_file_'.$this->session->userdata['ast_user']['user_id'].'.xlsx';
       if (file_exists($path)) {
       	unlink($path);
       }
       
       $result = 0;
       $size1=basename($_FILES['bulk_file']['size']);
       $size=$size1/1048576;
       $filename = stripslashes($_FILES['bulk_file']['name']);
       $i = strrpos($filename,".");
       $l = strlen($filename) - $i;
       $extension = substr($filename,$i+1,$l);             
       $extension = strtolower($extension);                    
       $file_name_new='temp_excel_file_'.$this->session->userdata['ast_user']['user_id'].'.'.$extension;
       //$New_file_name=$this->input->ip_address().'__'.$subcat.'__'.$this->session->userdata("user_hms").'__'.time().'.pdf';
       $target_path = $destination_path.'/cma_file/authorization_request_exl_file/' .$file_name_new;
        
	    if(@move_uploaded_file($_FILES['bulk_file']['tmp_name'], $target_path)) {
	      $result = 1;
	    } 
	    if ($result==1) 
	    {
	    	$total_error_rows=0;
	    	$count=0;
	    	$error_message_loan_ac='';
	    	$error_message_user='';
	    	$error_message_user2='';
	    	$account_number_array=array();
	    	$case_number='';
	    	$suit_id = '';
	    	$error_message_req_type='';
	    	$error_message_proposed_type='';
	    	$error_message_case_number='';
	    	$error_message_auth_type='';
	    	$error_message_case_requisition_type='';
	    	$auth_type='';
	    	$auth_type_id='';
	    	$req_type_id = '';
	    	$case_number = '';
	    	$suit_id = '';
	    	$proposed_type_array = array('Loan','Card');
	    	//$req_type_array = array('1','2','3','4','5','7','8','9','10','11','13');
	    	$req_type = '';
	    	$loan_ac = '';


			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="5%" style="font-weight: bold;text-align:center">SL</th>
					<th width="5%" style="font-weight: bold;text-align:left">Proposed Type</th>
					<th width="10%" style="font-weight: bold;text-align:left">Account</th>
					<th width="10%" style="font-weight: bold;text-align:left">Case Type</th>
					<th width="10%" style="font-weight: bold;text-align:left">Auth. Type</th>
					<th width="10%" style="font-weight: bold;text-align:left">Case Number</th>
					<th width="10%" style="font-weight: bold;text-align:left">Prev Rep.</th>
					<th width="10%" style="font-weight: bold;text-align:left">Present Rep.</th>
					<th width="10%" style="font-weight: bold;text-align:left">Address</th>
					<th width="10%" style="font-weight: bold;text-align:left">Borrower Name</th>
					<th width="20%" style="font-weight: bold;text-align:left">Error</th>
				</thead>
				<tbody id="table_tbody">';
	    	include('./application/Classes/PHPExcel.php');
			include('./application/Classes/PHPExcel/Calculation/Financial.php');
			include './application/Classes/PHPExcel/IOFactory.php';
				


			$inputFileName = $target_path;
			$inputFileType = 'Excel2007';
			/**  Create a new Reader of the type defined in $inputFileType  **/
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			/**  Load $inputFileName to a PHPExcel Object  **/
			$objPHPExcel = $objReader->load($inputFileName);
			//echo '<hr />';
			//echo 'Reading the number of Worksheets in the WorkBook<br />';
			/**  Use the PHPExcel object's getSheetCount() method to get a count of the number of WorkSheets in the WorkBook  */
			$sheetCount = $objPHPExcel->getSheetCount();
			//echo 'There ',(($sheetCount == 1) ? 'is' : 'are'),' ',$sheetCount,' WorkSheet',(($sheetCount == 1) ? '' : 's'),' in the WorkBook<br /><br />';
			//echo 'Reading the names of Worksheets in the WorkBook<br />';
			/**  Use the PHPExcel object's getSheetNames() method to get an array listing the names/titles of the WorkSheets in the WorkBook  */

			$sheetNames = $objPHPExcel->getSheetNames();
			foreach($sheetNames as $sheetIndex => $sheetName) {
				//echo 'WorkSheet #',$sheetIndex,' is named "',$sheetName,'"<br />';
				$objPHPExcel->setActiveSheetIndexByName($sheetName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,false,false,true);
				//Only for first sheet
				if ($sheetIndex==0) 
				{
					for($i=1;$i<=count($sheetData);$i++)
					{
						
						$k='A';
						if ($i>1) 
						{
							$count++;
							$str.='<tr id="row_'.$count.'">';
							$str.='<td align="center">'.$count.'</td>';
						}
						$case_number='';
						for($j=1;$j<=count($sheetData[$i]);$j++)
						{	
						 if($i>1)//Skip the first row
						 {
						 	if($k=='A')
						 	{
						 		$proposed_type = $sheetData[$i][$k];
								if (in_array($sheetData[$i][$k], $proposed_type_array))
  								{
									$error_message_proposed_type='';
								}else
								{
									$error_message_proposed_type='Invalid Proposed Type';
								}
						 	}
						 	if($k=='B')
						 	{
						 		$loan_ac = $sheetData[$i][$k];
						 	}
						 	if($k=='C')
						 	{
						 		$requisition_type = $sheetData[$i][$k];
								$str_where = "c.data_status<>0 AND c.name='".$requisition_type."'";
								$row = $this->db->query("SELECT  c.id
								FROM ref_req_type as c 
								WHERE ".$str_where." LIMIT 1")->row();
								if(!empty($row))
								{
									$req_type_id = $row->id;
									$error_message_case_requisition_type='';
								}
								else
								{
									$error_message_case_requisition_type='Invalid requisition Type';
									$req_type_id = '';
								}
						 	}
						 	if($k=='D')
						 	{
						 		$auth_type = $sheetData[$i][$k];
								$str_where = "c.data_status=1 AND c.name='".$auth_type."' AND c.req_type='".$req_type_id."'";
								$row = $this->db->query("SELECT  c.id
								FROM ref_authorization_type as c 
								WHERE ".$str_where." LIMIT 1")->row();
								if(!empty($row))
								{
									$auth_type_id = $row->id;
									$error_message_auth_type='';
								}
								else
								{
									$error_message_auth_type='Invalid Authorization Type';
									$auth_type_id = '';
								}
						 	}
						 	if ($k=='E') {
								$case_number = $sheetData[$i][$k];
								if(!empty($case_number))
								{

									$str_where = "c.sts<>0 AND c.case_number='".$case_number."' AND c.req_type='".$req_type_id."'";
									if ($proposed_type=='Loan') {
						                $str_where.= " AND c.loan_ac='".$loan_ac."'";
						            }else if($proposed_type=='Card')
						            {
						                $str_where.= " AND c.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$loan_ac)."'";
						            }
						            else
						            {
						            	$str_where.= " AND c.loan_ac='00000'";
						            }
									$suit_row = $this->db->query("SELECT  c.id
									FROM suit_filling_info as c 
									WHERE ".$str_where." LIMIT 1")->row();
									if(!empty($suit_row))
									{
										$suit_id = $suit_row->id;
									}
									else
									{
										$suit_id='';
										$error_message_case_number='Case Number Not Found';
									}
								}
								else
								{
									$error_message_case_number='Case Number Not Found';
								}
							}
							if ($k=='F')//User Error Checking 
							{
								$data2=$this->Authorization_request_model->get_data_by_pin($sheetData[$i][$k]);
								if (empty($data2)) {
									$user_id2 = '';
									$error_message_user2='Prev Representive Not Matched';
								}
								else
								{
									$user_id2 = $data2->id;
									$error_message_user2='';
								}
							}
							if ($k=='G')//User Error Checking 
							{
								$data2=$this->Authorization_request_model->get_data_by_pin($sheetData[$i][$k]);
								if (empty($data2)) {
									$user_id = '';
									$error_message_user='Present Representive Not Matched';
								}
								else
								{
									$user_id = $data2->id;
									$error_message_user='';
								}
							}
							if ($k=='H')//User Error Checking 
							{
								$address = $sheetData[$i][$k];
							}
							if ($k=='I')//User Error Checking 
							{
								$borrower_name = $sheetData[$i][$k];
							}
							$str.='<td align="left" style="word-wrap: break-word;">'.$sheetData[$i][$k].'<input type="hidden" name="'.$k.'_'.$count.'" id="'.$k.'_'.$count.'" value="'.$sheetData[$i][$k].'"></td>';
							
						 }
						 $k++;
						 if ($k=='J') {
						 		break;
						 	}	
						}
						if ($i>1) 
						{
							$str.='<td align="left">';
							if ($error_message_proposed_type!='') {
								$str.='<strong><span style="color:red">'.$error_message_proposed_type.'</span></strong><br>';
								$total_error_rows++;
							}
							if ($error_message_case_requisition_type!='') {
								$str.='<strong><span style="color:red">'.$error_message_case_requisition_type.'</span></strong><br>';
								$total_error_rows++;
							}
							if ($error_message_auth_type!='') {
								$str.='<strong><span style="color:red">'.$error_message_auth_type.'</span></strong><br>';
								$total_error_rows++;
							}
							if ($error_message_case_number!='') {
								$str.='<strong><span style="color:red">'.$error_message_case_number.'</span></strong><br>';
								$total_error_rows++;
							}
							if($error_message_user!='')
							{
								$str.='<strong><span style="color:red">'.$error_message_user.'</span></strong><br>';
								$total_error_rows++;
							}
							if($error_message_user2!='')
							{
								$str.='<strong><span style="color:red">'.$error_message_user2.'</span></strong><br>';
								$total_error_rows++;
							}
							$str.='<input type="hidden" name="borrower_name_'.$count.'" id="borrower_name_'.$count.'" value="'.$borrower_name.'">';
							$str.='<input type="hidden" name="address_'.$count.'" id="address_'.$count.'" value="'.$address.'">';
							$str.='<input type="hidden" name="user_id_'.$count.'" id="user_id_'.$count.'" value="'.$user_id.'">';
							$str.='<input type="hidden" name="user_id2_'.$count.'" id="user_id2_'.$count.'" value="'.$user_id2.'">';
							$str.='<input type="hidden" name="auth_type_id_'.$count.'" id="auth_type_id_'.$count.'" value="'.$auth_type_id.'">';
							$str.='<input type="hidden" name="event_id_'.$count.'" id="event_id_'.$count.'" value="'.$suit_id.'"></td>';
							//End Row
							$str.='</tr>';
						}
						
					}
					break;
				}else{
					break;
				}	
			}
			$str.='<input type="hidden" name="total_row" id="total_row" value="'.$count.'">';
			$str.='<input type="hidden" name="selected_row" id="selected_row" value="'.$count.'">';
			$str.='</tbody></table></div>';

			if ($total_error_rows>0) 
			{
				$str.='<table class="result_table" id="total_result_table" border="0" style="dsiplay:inline;margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<tbody>';
				$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="7"><input type="hidden" name="total_number_of_error" id="total_number_of_error" value="'.$total_error_rows.'"><strong><span style="color:red">Total Error : <span id="error_number">'.$total_error_rows.'<span></span></strong></td></tr>';
				$str.='</tbody></table>';
			}
			else
			{
				$str.='<input type="hidden" name="total_number_of_error" id="total_number_of_error" value="'.$total_error_rows.'">';
			}
			$Message='OK';
	    }
	    else
	    {
	    	$Message='NotOk';
	    	$str.='<input type="hidden" name="total_row" id="total_row" value="0">';
	    	$str.='<input type="hidden" name="selected_row" id="selected_row" value="0">';
	    	$str.='<input type="hidden" name="total_number_of_error" id="total_number_of_error" value="0">';
	    }
		$var =array(
		"str"=>$str,
		"Message"=>$Message,
		"csrf_token"=>$csrf_token
		);
		echo json_encode($var);
	}
}
?>
