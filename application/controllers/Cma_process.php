<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cma_process extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Cma_process_model', '', TRUE);
		$this->load->model('Cma_ho_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('Legal_file_process_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat)
	{
		$link_id=138;
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'cma_process/pages/grid',
					'checker_info' => $this->User_info_model->get_checker_data($link_id,'3,4,12,13,14,15'),
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}

	function grid()
	{
		$this->load->model('Cma_process_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Cma_process_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function bulk_operation($operation=NULL)
	{
		$operation_name='';
		if ($operation=='recommend') 
		{
			$operation_name='Recommend';
		}
		$region = $this->user_model->get_parameter_data('ref_region','name',"data_status = '1'");
		$req_type = $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'");
		$territory = array();
		$unit_office = $this->user_model->get_parameter_data('ref_unit_office','name',"data_status = '1'");
		$district = $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'");
		$loan_segment = $this->user_model->get_parameter_data('ref_loan_segment','name',"data_status = '1'");
		$data = array( 	
			   'region' => $region,
			   'req_type' => $req_type,
			   'territory' => $territory,
			   'unit_office' => $unit_office,
			   'district' => $district,
			   'loan_segment' => $loan_segment,
			   'operation' => $operation,
			   'operation_name' => $operation_name,
			   'pages'=> 'cma_process/pages/bulk_operation',		   
			   );
		$this->load->view('cma_process/form_layout',$data);
	}
	function load_bulk_data()
	{
		$this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
	    $grid_data=$this->Cma_process_model->get_bulk_data();
	    $operation= $this->input->post('operation');
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
				<th width="10%" style="font-weight: bold;text-align:left">Initiate By</th>
				<th width="10%" style="font-weight: bold;text-align:left">Initate Date Time</th>
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
				$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="event_id_'.$i.'" id="event_id_'.$i.'" value="'.$data->id.'"><input type="hidden" name="case_type_'.$i.'" id="case_type_'.$i.'" value="'.$data->req_type.'"><input type="hidden" name="security_sts_'.$i.'" id="security_sts_'.$i.'" value="'.$data->sec_sts.'"></td>';
				$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
				$str.='<td align="left">'.$data->sl_no.'</td>';
				$str.='<td align="left">'.$data->loan_segment.'</td>';
				$str.='<td align="left">'.$data->loan_ac.'</td>';
				$str.='<td align="left">'.$data->region_name.'</td>';
				$str.='<td align="left">'.$data->territory_name.'</td>';
				$str.='<td align="left">'.$data->district_name.'</td>';
				$str.='<td align="left">'.$data->unit_office_name.'</td>';
				$str.='<td align="left">'.$data->e_by.'</td>';
				$str.='<td align="left">'.$data->e_dt.'</td>';
				$str.='</tr>';
				$i++;
			}
			$str.='<input type="hidden" name="event_counter" id="event_counter" value="'.($i-1).'">';
			$str.='</tbody></table></div>';
			$str.='<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<tbody>';
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="3">Total Selected : <span id="selected_value">0</span></td></tr>';
		    $str.='</tbody></table>';
		}
		$var =array(
				"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function from($add_edit='add',$id=NULL,$editrow=NULL,$proposed_type=NULL,$operation=NULL)
	{

		$acLength = $this->Common_model->getAcLength();
		$acPartStr = json_encode(explode(",", $acLength));

		if(check_group(4))
		{
			$region_data = $this->user_model->get_parameter_data('ref_region', 'id', 'data_status = 1 AND id IN('.$this->session->userdata['ast_user']['recovery_region'].')');
			$district_list = $this->User_model->get_parameter_data('ref_district', 'name', 'data_status = 1 AND id IN('.$this->session->userdata['ast_user']['recovery_district'].')');
			$territory_list = $this->User_model->get_parameter_data('ref_territory', 'name', "data_status = '1' AND id IN(".$this->session->userdata['ast_user']['recovery_territory'].")");
			$unit_office_list = $this->User_model->get_parameter_data('ref_unit_office', 'name', "data_status = '1' AND id IN(".$this->session->userdata['ast_user']['recovery_unit_office'].")");
		}
		else
		{
			$region_data = $this->user_model->get_parameter_data('ref_region', 'id', 'data_status = 1');
			$district_list = $this->User_model->get_parameter_data('ref_district', 'name', 'data_status = 1');
			$territory_list = $this->User_model->get_parameter_data('ref_territory', 'name', "data_status = '1'");
			$unit_office_list = $this->User_model->get_parameter_data('ref_unit_office', 'name', "data_status = '1'");
		}
		$this->Common_model->delete_tempfile();
		if ($add_edit=='edit' && $proposed_type==2) {
			$card_facility = $this->Cma_process_model->get_card_facility($id);
		}
		else{$card_facility=array();}
		if ($add_edit=='edit' && $proposed_type==1) {
			$facility_info = $this->Cma_process_model->get_facility_info($add_edit,$id);
		}
		else if($add_edit=='edit' && $proposed_type==2)
		{
			$facility_info = $this->Cma_process_model->get_facility_info_card($id);
		}else{$facility_info=array();}
		$this->load->model('Cma_process_model', '', TRUE);
		$result = $this->Cma_process_model->get_info($add_edit,$id);
		if ($add_edit=='edit') {
			$doc_files = $this->Cma_process_model->get_cma_doc_files($result->id);
		}else{$doc_files=array();}
		$data = array(
					 'option' => '',
					 'add_edit' => $add_edit,
					 'operation' => $operation,
					 'result' => $result,
					 'doc_files' => $doc_files,
					 'card_facility' => $card_facility,
					 'facility_info' => $facility_info,
					 'cma_document'=>$this->User_model->get_parameter_data('ref_cma_document','name','data_status = 1'),
					 'cl'=>$this->User_model->get_parameter_data('ref_cl','name','data_status = 1'),
					 'cma_guarantor' => $this->Cma_process_model->get_guarantor_info($add_edit,$id),
					 'legal_notice_facility' => $this->Cma_process_model->get_facility_info($add_edit,$id),
					 'id' => $id,
					 'pre_auc_sts'=>$this->User_model->get_parameter_data('ref_pre_auc_sts','name','data_status = 1'),
					 'disposal_sts'=>$this->User_model->get_parameter_data('ref_disposal_sts','name','data_status = 1'),
					 'sec_sts'=>$this->User_model->get_parameter_data('ref_sec_sts','name','data_status = 1'),
					 'case_sts'=>$this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
					 'busi_sts'=>$this->User_model->get_parameter_data('ref_busi_sts','name','data_status = 1'),
					 'borr_sts'=>$this->User_model->get_parameter_data('ref_borr_sts','name','data_status = 1'),
					 'case_logic'=>$this->User_model->get_parameter_data('ref_case_logic','name','data_status = 1'),
					 'recovery_am'=>$this->User_model->get_parameter_data('users_info','name','data_status = 1 AND FIND_IN_SET(3,user_group_id)'),
					 'chq_sts'=>$this->User_model->get_parameter_data('ref_chq_sts','name','data_status = 1'),
					 'branch_sol'=>$this->User_model->get_parameter_data('ref_branch_sol','name','data_status = 1'),
					 'summon_address'=>$this->User_model->get_parameter_data('ref_summon_address','name','data_status = 1'),
					 'facility_name'=>$this->User_model->get_parameter_data('ref_facility_name','name','data_status = 1'),
					 'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					 'unit_office'=>$this->User_model->get_parameter_data('ref_unit_office','name','data_status = 1'),
					 'region_data' => $region_data,
					 'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
					 'district_list' => $district_list,
					 'territory_list' => $territory_list,
				   	 'unit_office_list' => $unit_office_list,
					 'guar_occ'=>$this->User_model->get_parameter_data('ref_guar_occ','name','data_status = 1'),
					 'guar_sts'=>$this->User_model->get_parameter_data('ref_guar_sts','name','data_status = 1'),
					 'guar_type'=>$this->User_model->get_parameter_data('ref_guar_type','name','data_status = 1'),
					 'sub_type'=>$this->User_model->get_parameter_data('ref_subject_type','name','data_status = 1'),
					 'loan_segment'=>$this->User_model->get_parameter_data('ref_loan_segment','name','data_status = 1'),
					 'lawyer'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
					 'pages'=> 'cma_process/pages/form',
					 'editrow' => $editrow,
					 'acLength' => $acPartStr
					 );
		$this->load->view('cma_process/form_layout',$data);
	}
	function fromrecommend($id=NULL,$editrow=NULL,$sec_sts=NULL,$proposed_type=NULL,$case_type=NULL)
	{
		//echo $sec_sts;exit;
		$result = $this->Cma_process_model->get_recommend_info($id);
		if ($proposed_type==1) {
			$facility_info = $this->Cma_process_model->get_facility_info('edit',$id);
		}
		else if($proposed_type==2)
		{
			$facility_info = $this->Cma_process_model->get_facility_info_card($id);
		}else{$facility_info=array();}
		$doc_files = $this->Cma_process_model->get_cma_doc_files($id);
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'doc_files' => $doc_files,
				   'facility_info' => $facility_info,
				   'id' => $id,
				   'proposed_type' => $proposed_type,
				   'sec_sts' => $sec_sts,
				   'case_type' => $case_type,
				   'cma_guarantor' => $this->Cma_process_model->get_guarantor_info('add',$id),
				   'pages'=> 'cma_process/pages/form_recommend',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('user_info/form_layout',$data);
	}

	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Cma_process_model->add_edit_action($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";
		}

		$Message='';
		if($id=='taken')
		{
			$text[]="Action Already Taken!!!!";
		}
		if ($id!='00') {
			if(count($text)<=0){
			$Message='OK';
			$row=$this->Cma_process_model->get_add_action_data($id);
			}else{
				for($i=0; $i<count($text); $i++)
				{
					if($i>0){$Message.=',';}
					$Message.=$text[$i];				
				}	
				$row[]='';	
			}
		}
		else{$Message='Failed';}
		$var['csrf_token']=$csrf_token;
		$var['Message']=$Message;
		$var['row_info']=$row;
		$var['id']=$id;
		echo json_encode($var);
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
	function get_cif()
	{
		$loan_ac=$_POST['ac'];
		$cif=$_POST['cif'];
		//Get pre cma data
		$pre_cma_data = $this->Cma_process_model->get_pre_cma_data($loan_ac,$_POST['type']);
		if (empty($pre_cma_data))
		{
			$pre_cma_data='';
		}
		$csrf_token=$this->security->get_csrf_hash();
		$this->load->library('WebService');
		$facility_info=array();
		$results=array();
		$sub_card_data_result = array();
		$sub_card_data = array();
		$ws = new WebService();
		$details=array();
		if ($_POST['type']=='Card') {
			$api_config=$this->Common_model->get_api_config_data('Card Pro Sys DB','cardpro');
			if ($api_config->active_sts==1) {
				$results = $this->Common_model->get_card_data('GetCustomerInfoByCardNo',$loan_ac,$api_config->dev_live);
				if ($results['Message']=='ok') 
				{
					$Message='ok';
					//For Sub Card Data
					$sub_card_data_result = $this->Common_model->get_sub_card_data('GetCustomerSubInfoByCardNo',$loan_ac,$api_config->dev_live);
					if(!empty($sub_card_data_result['row_info']) && $sub_card_data_result['Message']=='ok')
					{
						$sub_card_data = $sub_card_data_result['row_info'];
					}
					$api_config2=$this->Common_model->get_api_config_data('CBS Middleware','Loan Details');
					if ($api_config2->active_sts==1) {
						$facility_info=$ws->call_service('GetFacilityDetailsByCifAndLoanAc',$api_config2->dev_live,$api_config2->api_url,$api_config2->user_id,$api_config2->channel_id,$api_config2->password,$loan_ac,$results['CIF_NO']);
					}
					else{$facility_info=array();}
				}
				else
				{
					$Message='notok';
				}
			}
			else
			{
				$Message='notactive';
			}
			 $var =array(
    			"Message" => $Message,
    			"results" => $results,
    			"sub_card_data" => $sub_card_data,
    			"facility_info" => $facility_info,
				"csrf_token"=>$csrf_token,
				"pre_cma_data"=>$pre_cma_data,
				"facility_info" =>$facility_info
				);
		}
		else
		{
			$check=0;
			$schema_type='';
			$ac_name='';
			$sol = '';
			$mobileNo='';
			$father_name='';
			$mother_name='';
			$spouse_name='';
			$loan_segment='';
			$business_type='';
			$present_address='';
			$parmanent_address='';
			$business_address='';
			$borrower_name='';
			$corp_id='';
			$guar_info=array();
			$facility_info=array();
			$api_config3=$this->Common_model->get_api_config_data('CBS Middleware','Loan Details');
			if ($api_config3->active_sts==1) {
				$results = $ws->call_service('GetLoanDetalsByCif',$api_config3->dev_live,$api_config3->api_url,$api_config3->user_id,$api_config3->channel_id,$api_config3->password,$cif,$loan_ac);
				$api_config7=$this->Common_model->get_api_config_data('CBS Middleware','Loan Details');
				if (!empty($results)) {
					for ($i=1; $i <=count($results); $i++) 
					{ 
						//Get Facility info for all account
						if ($api_config7->active_sts==1) {
							$facility_info[$i]['facilit_type']=$results[$i]['loanType'];
							$facility_info[$i]['dis_date']=$results[$i]['dis_date'];
							$facility_info[$i]['lastAnyTrnDate']=$results[$i]['lastAnyTrnDate'];
							$facility_info[$i]['dis_amt']=$results[$i]['dis_amt'];
							$facility_info[$i]['schmDesc']=$results[$i]['schmDesc'];
							$facility_info[$i]['ac_name']=$results[$i]['accountHolderName'];
							$facility_info[$i]['details']=$ws->call_service('GetFacilityDetailsByCifAndLoanAc',$api_config7->dev_live,$api_config7->api_url,$api_config7->user_id,$api_config7->channel_id,$api_config7->password,$results[$i]['accountNumber'],$cif);
						}
						else
						{
							$facility_info=array();
						}
						//Checking account number matching or not
						if ($results[$i]['accountNumber']==$loan_ac) {
							$check=1;
							$schema_type=$results[$i]['schemeType'];
							$ac_name=$results[$i]['accountHolderName'];
							$sol = $results[$i]['sol'];
							$mobileNo=$results[$i]['mobileNo'];
							$corp_id=$results[$i]['corp_id'];
							$Message='ok';
							$api_config4=$this->Common_model->get_api_config_data('CBS','n/a');
							if ($api_config4->active_sts==1) {
								//For Corporate Account
								if ($corp_id[0]!='') 
								{
									$results3 = $ws->call_service('GetGuarantorFatherInfocorporateByCif',$api_config4->dev_live,$api_config4->api_url,$api_config4->user_id,$api_config4->channel_id,$api_config4->password,$cif);
									$borrower_results3 = $ws->call_service('GetBorrowerDetailsByCif',$api_config4->dev_live,$api_config4->api_url,$api_config4->user_id,$api_config4->channel_id,$api_config4->password,$cif);
									$borrower_name = $borrower_results3[1]['nameproprietor'][0];
								}
								else//For Retails Account
								{
									$results3 = $ws->call_service('GetGuarantorFatherInfoByCif',$api_config4->dev_live,$api_config4->api_url,$api_config4->user_id,$api_config4->channel_id,$api_config4->password,$cif);
								}
								$father_name=$results3[1]['father_name'][0];
								$mother_name=$results3[1]['mother_name'][0];
								$spouse_name=$results3[1]['spouse_name'][0];
								$business_type=$results3[1]['cust_type'][0];
								$loan_segment=$results[$i]['accountCifType'][0];
								$present_address=ucwords(strtolower($results3[1]['present_address1'][0].$results3[1]['present_address2'][0].$results3[1]['present_address3'][0].' '.$this->get_city_country($results3[1]['present_address_city'][0],'ref_city')));
								$parmanent_address=ucwords(strtolower($results3[1]['parmanent_address1'][0].$results3[1]['parmanent_address2'][0].$results3[1]['parmanent_address3'][0].' '.$this->get_city_country($results3[1]['parmanent_address_city'][0],'ref_city')));
								$business_address=ucwords(strtolower($results3[1]['business_address1'][0].$results3[1]['business_address2'][0].$results3[1]['business_address3'][0].' '.$this->get_city_country($results3[1]['business_address_city'][0],'ref_city')));
							}
						}
					}
					if ($check==1) 
					{
						//Get Guarantor Info
						$api_config5=$this->Common_model->get_api_config_data('CBS','n/a');
						if ($api_config5->active_sts==1) {
							$results2 = $ws->call_service('GetGurantorDetailsByLoanAC',$api_config5->dev_live,$api_config5->api_url,$api_config5->user_id,$api_config5->channel_id,$api_config5->password,$loan_ac,$schema_type[0]);
						}else{$results2=array();}
						if (!empty($results2)) 
						{
							for ($i=1; $i <=count($results2); $i++) { 
								$guar_info[$i]['type']=$results2[$i]['type'];
								$guar_info[$i]['ac_no']=$results2[$i]['cust_id'];
								$guar_info[$i]['name']=$results2[$i]['name'];
							}
							//Get Guarantor father name mother name
							$api_config6=$this->Common_model->get_api_config_data('CBS','n/a');
							if ($api_config6->active_sts==1) {
								for ($i=1; $i <=count($guar_info) ; $i++) { 
									$results4 = $ws->call_service('GetGuarantorFatherInfoByCif',$api_config6->dev_live,$api_config6->api_url,$api_config6->user_id,$api_config6->channel_id,$api_config6->password,$guar_info[$i]['ac_no']);
									if ($guar_info[$i]['type']=='M' && $corp_id[0]!='') {
										$guar_info[$i]['name']=$borrower_name;
										$guar_info[$i]['present_address']=$present_address;
										$guar_info[$i]['permanent_address']=$parmanent_address;
										$guar_info[$i]['business_address']=$business_address;
										$guar_info[$i]['father_name']=$father_name;
										$guar_info[$i]['mother_name']=$mother_name;
										$guar_info[$i]['Occupation']='';

									}
									else
									{
										$guar_info[$i]['father_name']=$results4[1]['father_name'][0];
										$guar_info[$i]['mother_name']=$results4[1]['mother_name'][0];
										$guar_info[$i]['Occupation']=$results4[1]['Occupation'][0];
										$guar_info[$i]['present_address']=ucwords(strtolower($results4[1]['present_address1'][0].$results4[1]['present_address2'][0].' '.$this->get_city_country($results4[1]['present_address_city'][0],'ref_city')));
										$guar_info[$i]['permanent_address']=ucwords(strtolower($results4[1]['parmanent_address1'][0].$results4[1]['parmanent_address2'][0].' '.$this->get_city_country($results4[1]['parmanent_address_city'][0],'ref_city')));
										$guar_info[$i]['business_address']=ucwords(strtolower($results4[1]['business_address1'][0].$results4[1]['business_address2'][0].' '.$this->get_city_country($results4[1]['business_address_city'][0],'ref_city')));
									}
								}
							}else{
								$guar_info[$i]['father_name']='';
								$guar_info[$i]['mother_name']='';
								$guar_info[$i]['Occupation']='';
								$guar_info[$i]['present_address']='';
								$guar_info[$i]['permanent_address']='';
								$guar_info[$i]['business_address']='';
							}
							
						}
						else{
							
						}
						
					}
					else
					{
						$Message='ACnotMatched';
					}
				}else{
					$Message='NoData';
				}
			}else{$Message='NoData';}
			
			$var =array(
			'Message'=>$Message,
			'mobileNo'=>$mobileNo,
			'ac_name'=>$ac_name,
				'sol' => $sol,
			'loan_segment'=>$loan_segment,
			'business_type'=>$business_type,
			'borrower_name'=>$borrower_name,
			'father_name'=>$father_name,
			'mother_name'=>$mother_name,
			'spouse_name'=>$spouse_name,
			'present_address'=>$present_address,
			'parmanent_address'=>$parmanent_address,
			'business_address'=>$business_address,
			'guar_details'=>$guar_info,
			"details"=>$details,
			"pre_cma_data"=>$pre_cma_data,
			"csrf_token"=>$csrf_token,
			"facility_info" =>$facility_info
			);
		}
	   
		echo json_encode($var);
	}
	function delete_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Cma_process_model->delete_action();
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
			else{$row=$this->Cma_process_model->get_add_action_data($id);}
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
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$str='';
		$lawyer_info=array();
		$suit_file_details = array();
		$expense = array();
    	$court_fee_row = array();
    	$court_fee_amount = "";
    	$court_fee_id = "";
    	$case_claim_amount = "";
		if (isset($_POST['operation'])) {
			$operation = $this->input->post('operation');
		}else{$operation ="";}
			if ($this->input->post('id') != ""){
				$details=$this->Cma_process_model->get_recommend_info($this->input->post('id'));
	    		$guarantor_info= $this->Cma_process_model->get_guarantor_info('edit',$this->input->post('id'));    	
	    		if ($details->proposed_type=='Loan') 
	    		{
	    			$facility_info = $this->Cma_ho_model->get_facility($this->input->post('id'));
					$mortgage_info = $this->Cma_ho_model->get_mortgage($this->input->post('id'));
					$security_info = $this->Cma_ho_model->get_security($this->input->post('id'));
					$bidder_info = $this->Cma_ho_model->get_bidder($this->input->post('id'));
				}
				else{
					$mortgage_info=array();
					$security_info=array();
					$bidder_info=array();
					$facility_info = $this->Cma_ho_model->get_card_facility($this->input->post('id'));
				}
				if ($this->input->post('territory')!='' && $this->input->post('region')!='') 
				{
					$checker_info=$this->user_model->get_checker_info($this->input->post('territory'),$this->input->post('region'));
				}
				else if(isset($_POST['hoopschecker']) && $_POST['hoopschecker']==1) // For Hoops Chekcer Info
				{
					$link_id=230;
					$checker_info = $this->User_info_model->get_checker_data($link_id,'18');
				}
				else{$checker_info=array();}
	    	}
	    	else{$details=array();}
	    	if ($operation!="" && $operation=='editcourtfee') {
	    		$court_fee_row = $this->Cma_process_model->get_court_fee_details($this->input->post('id'));
	    		if(!empty($court_fee_row))
	    		{
	    			$court_fee_amount = $court_fee_row->amount;
	    			$court_fee_id = $court_fee_row->id;
	    		}
	    	}
	    	if ($operation!="" && $operation=='legal') {
	    		$condition="AND legal_sent_sts='1'";
	    		$doc_files = $this->Cma_process_model->get_cma_doc_files($this->input->post('id'),$condition);
	    	}
	    	else
	    	{
	    		$doc_files = $this->Cma_process_model->get_cma_doc_files($this->input->post('id'));
	    	}
	    	if (!empty($details)) 
	    	{

    			$case_claim_amount = $details->st_belance;
	    		$suit_file_details = $this->Legal_file_process_model->get_suit_filling_details_by_cmaid_all($this->input->post('id'));
	    		if ($details->proposed_type=='Loan') 
	    		{
	    			$no_tag="Loan A/C";
	    			$guar_tag="Borrower/Guarantor/Company Director/Owner";
	    			$nam_tag="Loan A/C Name";
	    		}
	    		else
	    		{
	    			$no_tag="Card";
	    			$guar_tag="Borrower/Reference";
	    			$nam_tag="Name on Card";
	    		}
	    		if ($details->spouse_name!='') {
	    			$spouse_name=$details->spouse_name;
	    		}else{$spouse_name="N/A";}
	    		if ($details->mother_name!='') {
	    			$mother_name=$details->mother_name;
	    		}else{$mother_name="N/A";}
	    		if ($details->call_up_file!='') {
	    			$call_up_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/call_up_file/'.$details->call_up_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$call_up_file="";}

	    		if ($details->remarks_file!='') {
	    			$remarks_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/remarks_file/'.$details->remarks_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$remarks_file="";}

	    		if ($details->senction_letter!='') {
	    			$senction_letter='<br/><strong> Senction Letter :</strong> <img id="file_preview" onclick="popup(\''.base_url().'cma_file/senction_letter/'.$details->senction_letter.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$senction_letter="";}

	    		if ($details->ln_scan_copy!='') {
	    			$ln_scan_copy='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/ln_scan_copy/'.$details->ln_scan_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$ln_scan_copy="";}

	    		if ($details->auction_sts==33) {
	    			$current_auct_sts="Completed";
	    		}else{$current_auct_sts="";}

	    		if ($details->uploaded_statement!='') {
	    			$statement_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/uploaded_statement/'.$details->uploaded_statement.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}
	    		else if($details->generated_statement!='')
	    		{
	    			$statement_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/generated_statement/'.$details->generated_statement.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}
	    		else{$statement_file="";}

	    		$str .='<table style="width: 100%;" id="preview_table">
					<thead></thead>
					<tbody id="details_body">
	    				<tr>
							<td width="50%" align="left"><strong>SL No.:</strong>'.$details->sl_no.'</td>
							<td width="50%" align="left"><strong>Territory:</strong>'.$details->territory_name.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Requisition Type:</strong>'.$details->req_type.'</td>
							<td width="50%" align="left"><strong>District:</strong>'.$details->district_name.'</td>
							

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Proposed Type:</strong>'.$details->proposed_type.'</td>
							<td width="50%" align="left"><strong>Unit Office:</strong>'.$details->unit_office_name.'</td>
							

						</tr>
						<tr>
							<td width="50%" align="left"><strong>'.$no_tag.'No.:</strong> '.$details->loan_ac.'</td>
							<td width="50%" align="left"><strong>More A/C No.:</strong>'.$details->more_acc_number.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>CIF:</strong>'.$details->cif.'</td>
							<td width="50%" align="left"><strong>Loan Sanction Date:</strong>'.$details->loan_sanction_dt.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Branch SOL:</strong>'.$details->branch_sol.'</td>
							<td width="50%" align="left"><strong>Status:</strong>'.$details->cma_sts.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>'.$nam_tag.':</strong>'.$details->ac_name.'</td>
							<td width="50%" align="left"><strong>Initiate By:</strong>'.$details->e_by.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Previous CMA Approval Type:</strong>'.$details->pre_cma_app_type.'</td>
							<td width="50%" align="left"><strong>Previous CMA Approval Date:</strong>'.$details->pre_cma_app_dt.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Previous Case Status:</strong>'.$details->pre_case_sts.'</td>
							<td width="50%" align="left"><strong>Previous Case Type:</strong>'.$details->pre_case_type.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Disposal Status:</strong>'.$details->disposal_sts.'</td>
							<td width="50%" align="left"><strong>Customer Contact:</strong>'.$details->mobile_no.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Borrower Name:</strong>'.$details->brrower_name.'</td>
							
							<td width="50%" align="left"><strong>Initiate Date Time:</strong>'.$details->e_dt.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Business Type:</strong>'.$details->subject_name.'</td>
							
							<td width="50%" align="left"><strong>STC By:</strong> '.$details->stc_by.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Spouse Name :</strong> '.$spouse_name.'</td>
							
							<td width="50%" align="left"><strong>STC Date Time:</strong>'.$details->stc_dt.'</td>

							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Mother Name :</strong>'.$mother_name.'</td>
							
							<td width="50%" align="left"><strong>Recommended By:</strong>'.$details->rec_by.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Loan Segment (Portfolio) :</strong>'.$details->loan_segment.'</td>
							
							<td width="50%" align="left"><strong>Recommend Date Time:</strong>'.$details->rec_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Current/Updated Address:</strong>'.$details->current_address.'</td>
							
							<td width="50%" align="left"><strong>HO Acknowledge By:</strong>'.$details->ack_by.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Hoops Hold By:</strong>'.$details->hoops_hold_by.'</td>
							
							<td width="50%" align="left"><strong>Hoops Hold Reason:</strong>'.$details->hoops_hold_reason.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Region:</strong>'.$details->region_name.'</td>
							
							<td width="50%" align="left"><strong>HO Acknowledge Date Time:</strong>'.$details->ack_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Call Up Date:</strong>'.$details->call_up_serv_dt.'</td>
							
							<td width="50%" align="left"><strong>Send To HOLM By:</strong>'.$details->sth_by.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Call Up File:</strong>'.$call_up_file.'</td>
							
							<td width="50%" align="left"><strong>Send To HOLM Date Time:</strong>'.$details->sth_dt.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Chq Expiry Date:</strong>'.$details->chq_expiry_date.'</td>
							
							<td width="50%" align="left"><strong>Verify By:</strong>'.$details->v_by.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Last Payment Date:</strong>'.$details->last_payment_date.'</td>
							
							<td width="50%" align="left"><strong>Verify Date Time:</strong>'.$details->v_dt.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Last Payment Amount:</strong>'.$details->last_payment_amount.'</td>
							
							<td width="50%" align="left"><strong>Auction Complete By:</strong>'.$details->auction_complete_by.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case File District:</strong>'.$details->case_file_district.'</td>
							<td width="50%" align="left"><strong>Case Claim Amount:</strong>'.$details->st_belance.'</td>
							

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Remarks:</strong>'.$details->remarks.$remarks_file.'</td>
							
							<td width="50%" align="left"><strong>Auction Complete Date:</strong>'.$details->auction_complete_dt.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Previous Auction Sts:</strong>'.$details->pre_auc_sts.'</td>
							
							<td width="50%" align="left"><strong>Hold Reason:</strong>'.$details->hold_reason.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Current Auction Sts:</strong>'.$current_auct_sts.'</td>
							
							<td width="50%" align="left"><strong>Previous Case Filling Date:</strong>'.$details->pre_case_fill_dt.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Current DPD:</strong>'.$details->current_dpd.'DPD</td>
							<td width="50%" align="left"><strong>Legal Region:</strong>'.$details->legal_region_name.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Disposal remarks:</strong>'.$details->disposal_remarks.'</td>
							<td width="50%" align="left"><strong>Judgment Summary:</strong>'.$details->judgement_summery.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Business Status:</strong>'.$details->busi_sts.'</td>
							<td width="50%" align="left"><strong>Security Status:</strong>'.$details->sec_sts.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Borrower Status:</strong>'.$details->borr_sts.'</td>
							<td width="50%" align="left"><strong>Interest Rate (As per Sanction):</strong>'.$details->int_rate.$senction_letter.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Logic for ARA Case:</strong>'.$details->case_logic.'</td>
							<td width="50%" align="left"><strong>Chq. Status:</strong>'.$details->chq_sts.'</td>
						</tr>';
				if ($details->proposed_type=='Loan' && $details->sec_sts_id==1 && $details->requisition!=1) 
				{
					if ($details->auction_sign_memo!='' && $details->auction_sign_memo!=NULL) {
		                $auction_sign_memo='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/auction_sign_memo/'.$details->auction_sign_memo.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
		            }else{$auction_sign_memo="";}
					$str.='<tr>
							<td width="50%" align="left"><strong>Auc Ack By:</strong>'.$details->auc_ack_by.'</td>
							<td width="50%" align="left"><strong>Auc Ack Date Time:</strong>'.$details->auc_ack_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Auc Stc By:</strong>'.$details->auc_stc_by.'</td>
							<td width="50%" align="left"><strong>Auc Stc Date Time:</strong>'.$details->auc_stc_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Auc Verify By:</strong>'.$details->auc_v_by.'</td>
							<td width="50%" align="left"><strong>Auc Verify Date Time:</strong>'.$details->auction_v_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Auc STL By:</strong>'.$details->auc_st_l_by.'</td>
							<td width="50%" align="left"><strong>Auc STL Date Time:</strong>'.$details->auc_st_l_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Legal Response By:</strong>'.$details->legal_response_by.'</td>
							<td width="50%" align="left"><strong>Legal Response Date Time:</strong>'.$details->legal_response_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Lawyer:</strong>'.$details->lawyer_name.'</td>
							<td width="50%" align="left"><strong>LN Scan Copy:</strong>'.$ln_scan_copy.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>LN Serve Date:</strong>'.$details->ln_serve_dt_format.'</td>
							<td width="50%" align="left"><strong>LN Expiry Date:</strong>'.$details->ln_expiry_dt_format.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>LN Cost(Auction):</strong>'.$details->ln_cost.'</td>
							<td width="50%" align="left"><strong>Bill Type:</strong>Legal Notice</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Paper Vendor:</strong>'.$details->paper_vendor.'</td>
							<td width="50%" align="left"><strong>Paper Name:</strong>'.$details->paper_name.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Paper Date:</strong>'.$details->paper_date.'</td>
							<td width="50%" align="left"><strong>Auction Date:</strong>'.$details->auction_date.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Auction Time:</strong>'.$details->auction_time.'</td>
							<td width="50%" align="left"><strong>Auction Address:</strong>'.$details->auction_address.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Auction Status:</strong>'.$details->auction_team_auction_sts.'</td>
							<td width="50%" align="left"><strong>Auction Status Update By:</strong>'.$details->auction_status_update_by.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Auction Status Date Time:</strong>'.$details->auc_sts_update_dt.'</td>
							<td width="50%" align="left"></td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Auction Complete By:</strong>'.$details->auc_comp_by.'</td>
							<td width="50%" align="left"><strong>Auction Complete Date Time:</strong>'.$details->auction_complete_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Auction Sign Memo:</strong>'.$auction_sign_memo.'</td>
							<td width="50%" align="left"><strong>Auction Complete Remarks:</strong>'.$details->complete_remarks.'</td>
						</tr>';
				}

				$str.='<tr>
							<td width="50%" align="left"><strong>Send To HOOPS By:</strong>'.$details->sthoops_by.'</td>
							<td width="50%" align="left"><strong>Send To HOOPS Date Time:</strong>'.$details->sthoops_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>File Deliver By:</strong>'.$details->deliver_by.'</td>
							<td width="50%" align="left"><strong>File Deliver Date Time:</strong>'.$details->deliver_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>File Deliver To:</strong>'.$details->file_deliver_to.'</td>
							<td width="50%" align="left"></td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Legal Ack By:</strong>'.$details->legal_ack_by.'</td>
							<td width="50%" align="left"><strong>Legal Ack Date Time:</strong>'.$details->legal_ack_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Account Close By:</strong>'.$details->account_close_by.'</td>
							<td width="50%" align="left"><strong>Account Close Date Time:</strong>'.$details->account_close_dt.'</td>
						</tr>';
				$str.='<tr>
						<td width="50%" align="left"><strong>Statement File:</strong>'.$statement_file.'</td>
						<td width="50%" align="left"><strong>LN Sent Date (Legal):</strong>'.$details->ln_sent_date.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>LN Valid Date (Legal):</strong>'.$details->ln_val_dt.'</td>
						<td width="50%" align="left"><strong>Selected Lawyer (Legal):</strong>'.$details->lawyer_legal.'</td>
					</tr>';

				$str.='</tbody>
					</table>';
					
	    	}
	    	if (!empty($guarantor_info)) 
	    	{
	    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">'.$guar_tag.'</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Type</td>
							<td width="10%" style="font-weight: bold;text-align:left">Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Father Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Present Address</td>
							<td width="10%" style="font-weight: bold;text-align:left">Permanent Address</td>
							<td width="10%" style="font-weight: bold;text-align:left">Business Address</td>
							<td width="10%" style="font-weight: bold;text-align:center">Status</td>
							<td width="10%" style="font-weight: bold;text-align:center">Occupation</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
					foreach ($guarantor_info as $key) 
					{
						$str.='<tr>';
							$str.='<td align="center">'.$key->type_name.'</td>';
							$str.='<td align="left">'.$key->guarantor_name.'</td>';
							$str.='<td align="left">'.$key->father_name.'</td>';
							$str.='<td align="left">'.$key->present_address.'</td>';
							$str.='<td align="left">'.$key->permanent_address.'</td>';
							$str.='<td align="left">'.$key->business_address.'</td>';
							$str.='<td align="center">'.$key->guar_sts_name.'</td>';
							$str.='<td align="center">'.$key->occ_sts_name.'</td>';
						$str.='</tr>';
					}

				$str.='</tbody>
					</table>
				</div>';

	    	}
	    	if (!empty($facility_info)) 
	    	{
	    		if ($details->proposed_type=='Loan') 
	    		{
	    			$str.='<br/><div id="facility_for_loan" style="background-color:#eaeaea;padding:10px;margin:0 0px;overflow:scroll;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
					<table border="1" id="facility_table" style="border-color:#c0c0c0;width:127%;margin:20px" >
					<thead>
						<tr>
							<td width="5%" style="font-weight: bold;text-align:center">Faci lity Type</td>
							<td width="5%" style="font-weight: bold;text-align:center">A/C Number</td>
							<td width="5%" style="font-weight: bold;text-align:center">A/C Name</td>
							<td width="7%" style="font-weight: bold;text-align:center">Balance</td>
							<td width="7%" style="font-weight: bold;text-align:center">Balance Date</td>
							<td width="5%" style="font-weight: bold;text-align:center">Sch Desc.</td>
							<td width="5%" style="font-weight: bold;text-align:center">Int. Rate</td>
							<td width="5%" style="font-weight: bold;text-align:center">Disbur sement Date</td>
							<td width="7%" style="font-weight: bold;text-align:center">Disbur sed Amount</td>
							<td width="7%" style="font-weight: bold;text-align:center">Expire Date</td>
							<td width="7%" style="font-weight: bold;text-align:center">Tenour</td>
							<td width="7%" style="font-weight: bold;text-align:center">Payable</td>
							<td width="7%" style="font-weight: bold;text-align:center">Repayment</td>
							<td width="7%" style="font-weight: bold;text-align:center">Outst anding Balance</td>
							<td width="7%" style="font-weight: bold;text-align:center">Outst anding Balance Date</td>
							<td width="7%" style="font-weight: bold;text-align:center">Overdue Balance</td>
							<td width="7%" style="font-weight: bold;text-align:center">Overdue BL Date</td>
							<td width="7%" style="font-weight: bold;text-align:center">Call -up Date</td>
							<td width="7%" style="font-weight: bold;text-align:center">Write - off Date</td>
							<td width="7%" style="font-weight: bold;text-align:center">Write - off Amount</td>
							<td width="7%" style="font-weight: bold;text-align:center">Recovery After Write -off</td>
							<td width="7%" style="font-weight: bold;text-align:center">CL(BB)</td>
							<td width="7%" style="font-weight: bold;text-align:center">CL(BBL)</td>
						</tr>
					</thead>
					<tbody id="facility_info_loan">';
					foreach ($facility_info as $key) 
					{
						$str.='<tr>';
							$str.='<td align="left">'.$key->facility_type_name.'</td>';
							$str.='<td align="left">'.$key->ac_number.'</td>';
							$str.='<td align="left">'.$key->ac_name.'</td>';
							$str.='<td align="left">'.$key->belance.'</td>';
							$str.='<td align="left">'.$key->belance_dt.'</td>';
							$str.='<td align="left">'.$key->sch_desc.'</td>';
							$str.='<td align="left">'.$key->int_rate.'</td>';
							$str.='<td align="left">'.$key->disbursement_date.'</td>';
							$str.='<td align="left">'.$key->disbursed_amount.'</td>';
							$str.='<td align="left">'.$key->expire_date.'</td>';
							$str.='<td align="left">'.$key->loan_tenor.'</td>';
							$str.='<td align="left">'.$key->payble.'</td>';
							$str.='<td align="left">'.$key->repayment.'</td>';
							$str.='<td align="left">'.$key->outstanding_bl.'</td>';
							$str.='<td align="left">'.$key->outstanding_bl_dt.'</td>';
							$str.='<td align="left">'.$key->overdue_bl.'</td>';
							$str.='<td align="left">'.$key->overdue_bl_dt.'</td>';
							$str.='<td align="left">'.$key->call_up_dt.'</td>';
							$str.='<td align="left">'.$key->write_off_dt.'</td>';
							$str.='<td align="left">'.$key->write_off_amount.'</td>';
							$str.='<td align="left">'.$key->recovery_after_Wf.'</td>';
							$str.='<td align="left">'.$key->cl_bb.'</td>';
							$str.='<td align="left">'.$key->cl_bbl.'</td>';
						$str.='</tr>';
					}
					$str.='</tbody>
						</table>
					</div>';

	    		}
	    		else
	    		{
	    			$str.='<br/><div id="facility_for_card" style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
						<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Details</span>
						<table border="1" id="facility_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
						<thead>
							<tr>
								<td width="10%" style="font-weight: bold;text-align:center">Card Type</td>
								<td width="15%" style="font-weight: bold;text-align:center">Card No</td>
								<td width="15%" style="font-weight: bold;text-align:center">Card Holder Name</td>
								<td width="12%" style="font-weight: bold;text-align:center">Card Issue Date</td>
								<td width="12%" style="font-weight: bold;text-align:center">Card Exp Date</td>
								<td width="12%" style="font-weight: bold;text-align:center">Card Limit</td>
								<td width="12%" style="font-weight: bold;text-align:center">Outstanding Balance</td>
								<td width="12%" style="font-weight: bold;text-align:center">Outstanding BL DT</td>
								<td width="12%" style="font-weight: bold;text-align:center">CL BB</td>
								<td width="12%" style="font-weight: bold;text-align:center">CL BBL</td>
							</tr>
						</thead>
						<tbody id="facility_info_card">';
					foreach ($facility_info as $key) 
					{
						$str.='<tr>';
							$str.='<td align="center">'.$key->card_type.'</td>';
							$str.='<td align="center">'.$key->card_no.'</td>';
							$str.='<td align="center">'.$key->card_name.'</td>';
							$str.='<td align="center">'.$key->card_issue_dt.'</td>';
							$str.='<td align="center">'.$key->card_exp_dt.'</td>';
							$str.='<td align="center">'.$key->card_limit.'</td>';
							$str.='<td align="center">'.$key->outstanding_bl.'</td>';
							$str.='<td align="center">'.$key->outstanding_bl_dt.'</td>';
						if($key->card_type=='Basic')
						{
							$str.='<td align="center">'.$details->cl_bb_card.'</td>';
							$str.='<td align="center">'.$details->cl_bbl_card.'</td>';
						}
						else
						{
							$str.='<td align="center">&nbsp;</td>';
							$str.='<td align="center">&nbsp;</td>';
						}
						$str.='</tr>';
					}
					$str.='<tr>';
					$str.='<td style="font-weight: bold;text-align:right" colspan="6">Total Outstanding : </td>';
					$str.='<td style="font-weight: bold;text-align:center">'.$details->outstanding_bl.'</td>';
					$str.='<td style="font-weight: bold;text-align:center"></td>';
					$str.='</tr>';
					$str.='</tbody>
						</table>
					</div>';
	    		}
	    	}
	    	if (!empty($doc_files)) 
	    	{
	    		$str.='<br/><div id="doc_file_div" style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Secured Document Files</span>
					<table border="1" id="doc_file_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="70%" style="font-weight: bold;text-align:left">Document Title</td>
							<td width="30%" style="font-weight: bold;text-align:center">File</td>
						</tr>
					</thead>
					<tbody id="doc_file_body">';
					foreach ($doc_files as $key) 
					{
						$str.='<tr>';
							$str.='<td align="left">'.$key->org_document_name.'</td>';
							if ($key->file_name!='') {
								$str.='<td align="center"><img id="file_preview" onclick="popup(\''.base_url().'cma_file/document_file/'.$key->file_name.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png"></td>';
							}
							else
							{
								$str.='<td align="center"></td>';
							}
							
						$str.='</tr>';
					}
				$str.='</tbody>
						</table>
					</div>';
	    	}
	    	if (!empty($mortgage_info)) 
	    	{
	    		$i=1;
	    		$str.='<br/><div id="mortgage_div" style="background-color:#eaeaea;padding:10px;margin-top:10px;overflow:scroll;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Mortgage Info</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:140%;margin:20px" >
					<thead>
						<tr>
							<td style="font-weight: bold;text-align:center">Schedule Name</td>
							<td style="font-weight: bold;text-align:center">Schedule Description</td>
							<td style="font-weight: bold;text-align:center">Deed Number</td>
							<td style="font-weight: bold;text-align:center">Mortgage Date</td>
							<td style="font-weight: bold;text-align:center">Valuator Name</td>
							<td style="font-weight: bold;text-align:center">Valuator Date</td>
							<td style="font-weight: bold;text-align:center">Valuator MV</td>
							<td style="font-weight: bold;text-align:center">Valuator FSV</td>
							<td style="font-weight: bold;text-align:center">Re-Valuator Name</td>
							<td style="font-weight: bold;text-align:center">Re-Valuator Date</td>
							<td style="font-weight: bold;text-align:center">Re-Valuator MV</td>
							<td style="font-weight: bold;text-align:center">Re-Valuator FSV</td>
							<td style="font-weight: bold;text-align:center">Gov’t Mouza Rate</td>
							<td style="font-weight: bold;text-align:center">Total Land Area</td>
							<td style="font-weight: bold;text-align:center">Butted and bounded by</td>
						</tr>
					</thead>
					<tbody id="mortgage_body">';
					foreach ($mortgage_info as $key) 
					{
						$str.='<tr>';
							$str.='<td align="center">'.$key->mort_schedule_name.'<input type="hidden" name="mort_name_'.$i.'" id="mort_name_'.$i.'" value="'.$key->mort_schedule_name.'"></td>';
							$str.='<td align="center">'.$key->mort_schedule_desc.'</td>';
							$str.='<td align="center">'.$key->deed_number.'<input type="hidden" name="deed_number_'.$i.'" id="deed_number_'.$i.'" value="'.$key->deed_number.'"></td>';
							$str.='<td align="center">'.$key->mortgage_date.'</td>';
							$str.='<td align="center">'.$key->valuator_name.'</td>';
							$str.='<td align="center">'.$key->valuator_date.'</td>';
							$str.='<td align="center">'.$key->valuator_mv.'</td>';
							$str.='<td align="center">'.$key->valuator_fsv.'</td>';
							$str.='<td align="center">'.$key->re_valuator_name.'</td>';
							$str.='<td align="center">'.$key->re_valuator_date.'</td>';
							$str.='<td align="center">'.$key->re_valuator_mv.'</td>';
							$str.='<td align="center">'.$key->re_valuator_fsv.'</td>';
							$str.='<td align="center">'.$key->gov_mouza_rate.'</td>';
							$str.='<td align="center">'.$key->land_area.'</td>';
							$str.='<td align="center">'.$key->bounded_by.'</td>';
						$str.='</tr>';
						$i++;
					}
				$str.='<input type="hidden" name="mortgage_counter_preview" id="mortgage_counter_preview" value="'.($i-1).'">';
				$str.='</tbody>
						</table>
					</div>';
	    	}else{$str.='<input type="hidden" name="mortgage_counter_preview" id="mortgage_counter_preview" value="0">';}
	    	if (!empty($security_info)) 
	    	{
	    		$i=1;
	    		$str.='<br/><div id="security_div" style="background-color:#eaeaea;padding:10px;overflow:scroll;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Security Info</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:150%;margin:20px" >
					<thead>
						<tr>
							<td style="font-weight: bold;text-align:center">Deed Number</td>
							<td style="font-weight: bold;text-align:center">Reg. Date</td>
							<td style="font-weight: bold;text-align:center">Deed Type</td>
							<td style="font-weight: bold;text-align:center">District</td>
							<td style="font-weight: bold;text-align:center">Thana</td>
							<td style="font-weight: bold;text-align:center">Sub Reg Office</td>
							<td style="font-weight: bold;text-align:center">Mouza</td>
							<td style="font-weight: bold;text-align:center">Land Area</td>
							<td style="font-weight: bold;text-align:center">Plot Number</td>
							<td style="font-weight: bold;text-align:center">Holding number</td>
							<td style="font-weight: bold;text-align:center">Jote No.</td>
							<td style="font-weight: bold;text-align:center">CS Khatian no.</td>
							<td style="font-weight: bold;text-align:center">SA/PS Khatian no.</td>
							<td style="font-weight: bold;text-align:center">RS /MRR Khatian no.</td>
							<td style="font-weight: bold;text-align:center">BS/DP/ROR Khatian no.</td>
							<td style="font-weight: bold;text-align:center">City Jorip Khatian no.</td>
							<td style="font-weight: bold;text-align:center">Mutation Khatian no.</td>
							<td style="font-weight: bold;text-align:center">CS Dag no.</td>
							<td style="font-weight: bold;text-align:center">SA Dag no.</td>
							<td style="font-weight: bold;text-align:center">RS Dag no.</td>
							<td style="font-weight: bold;text-align:center">BS/DP Dag no.</td>
							<td style="font-weight: bold;text-align:center">City Jorip Dag no.</td>
						</tr>
					</thead>
					<tbody id="security_body">';
					foreach ($security_info as $key) 
					{
						$str.='<tr>';
							$str.='<td align="center">'.$key->title_deed_number.'</td>';
							$str.='<td align="center">'.$key->reg_date.'</td>';
							$str.='<td align="center">'.$key->deed_type.'</td>';
							$str.='<td align="center">'.$key->district.'</td>';
							$str.='<td align="center">'.$key->thana.'</td>';
							$str.='<td align="center">'.$key->sub_reg_office.'</td>';
							$str.='<td align="center">'.$key->mouza.'</td>';
							$str.='<td align="center">'.$key->land_area.'</td>';
							$str.='<td align="center">'.$key->plot_number.'</td>';
							$str.='<td align="center">'.$key->holding_number.'</td>';
							$str.='<td align="center">'.$key->jote_no.'</td>';
							$str.='<td align="center">'.$key->cs_khatian_no.'</td>';
							$str.='<td align="center">'.$key->sa_khatian_no.'</td>';
							$str.='<td align="center">'.$key->rs_khatian_no.'</td>';
							$str.='<td align="center">'.$key->bs_dp_khatian_no.'</td>';
							$str.='<td align="center">'.$key->city_jorip_khatian_no.'</td>';
							$str.='<td align="center">'.$key->mutation_khatian_no.'</td>';
							$str.='<td align="center">'.$key->cs_dag_no.'</td>';
							$str.='<td align="center">'.$key->sa_dag_no.'</td>';
							$str.='<td align="center">'.$key->rs_dag_no.'</td>';
							$str.='<td align="center">'.$key->bs_dp_dag_no.'</td>';
							$str.='<td align="center">'.$key->city_jorip_dag_no.'</td>';
						$str.='</tr>';
						$i++;
					}
				$str.='<input type="hidden" name="security_counter_preview" id="security_counter_preview" value="'.($i-1).'">';
				$str.='</tbody>
						</table>
					</div>';
	    	}else{$str.='<input type="hidden" name="security_counter_preview" id="security_counter_preview" value="0">';}
	    	if (!empty($bidder_info)) 
	    	{
	    		if ($operation!="" && $operation=='auctionsts') {
	    			$str.='<br/><div id="bidder_div" style="background-color:#eaeaea;padding:10px;margin-top:10px;overflow:scroll;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Bidder Info</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td style="font-weight: bold;text-align:center"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></td>
							<td style="font-weight: bold;text-align:center">Bidder Name</td>
							<td style="font-weight: bold;text-align:center">Bidder Details</td>
							<td style="font-weight: bold;text-align:center">Bidder Rank</td>
							<td style="font-weight: bold;text-align:center">Selection</td>
							<td style="font-weight: bold;text-align:center">Pay Order No</td>
							<td style="font-weight: bold;text-align:center">Pay order date</td>
							<td style="font-weight: bold;text-align:center">Pay Order Amount</td>
							<td style="font-weight: bold;text-align:center">Bid Amount</td>
							<td style="font-weight: bold;text-align:center">Rs Plot No</td>
							<td style="font-weight: bold;text-align:center">Remarks</td>
						</tr>
					</thead>
					<tbody id="bidder_body">';
					$i=1;
					foreach ($bidder_info as $key) 
					{
						if ($key->selected=='1') {
							$selected="Selected";
						}else{$selected="";}
						$str.='<tr>';
							$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="bidder_info_delete_'.$i.'" id="bidder_info_delete_'.$i.'" value="1"><input type="hidden" name="bidder_id_'.$i.'" id="bidder_id_'.$i.'" value="'.$key->id.'"></td>';
							$str.='<td align="center">'.$key->bidder_name.'</td>';
							$str.='<td align="center">'.$key->bidder_details.'</td>';
							$str.='<td align="center">'.$key->bidder_rank.'</td>';
							$str.='<td align="center">'.$selected.'</td>';
							$str.='<td align="center">'.$key->pay_order_no.'</td>';
							$str.='<td align="center">'.$key->pay_order_date.'</td>';
							$str.='<td align="center">'.$key->pay_order_amount.'</td>';
							$str.='<td align="center">'.$key->bid_amount.'</td>';
							$str.='<td align="center">'.$key->r_s_plot_no.'</td>';
							$str.='<td align="center">'.$key->remarks.'</td>';
						$str.='</tr>';
						$i++;
					}
	    		}
	    		else
	    		{
	    			$str.='<br/><div id="bidder_div" style="background-color:#eaeaea;padding:10px;margin-top:10px;overflow:scroll;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Bidder Info</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td style="font-weight: bold;text-align:center">Bidder Name</td>
							<td style="font-weight: bold;text-align:center">Bidder Details</td>
							<td style="font-weight: bold;text-align:center">Bidder Rank</td>
							<td style="font-weight: bold;text-align:center">Selection</td>
							<td style="font-weight: bold;text-align:center">Pay Order No</td>
							<td style="font-weight: bold;text-align:center">Pay order date</td>
							<td style="font-weight: bold;text-align:center">Pay Order Amount</td>
							<td style="font-weight: bold;text-align:center">Bid Amount</td>
							<td style="font-weight: bold;text-align:center">Rs Plot No</td>
							<td style="font-weight: bold;text-align:center">Remarks</td>
						</tr>
					</thead>
					<tbody id="bidder_body">';
					$i=1;
					foreach ($bidder_info as $key) 
					{
						if ($key->selected=='1') {
							$selected="Selected";
						}else{$selected="";}
						$str.='<tr>';
							$str.='<td align="center">'.$key->bidder_name.'</td>';
							$str.='<td align="center">'.$key->bidder_details.'</td>';
							$str.='<td align="center">'.$key->bidder_rank.'</td>';
							$str.='<td align="center">'.$selected.'</td>';
							$str.='<td align="center">'.$key->pay_order_no.'</td>';
							$str.='<td align="center">'.$key->pay_order_date.'</td>';
							$str.='<td align="center">'.$key->pay_order_amount.'</td>';
							$str.='<td align="center">'.$key->bid_amount.'</td>';
							$str.='<td align="center">'.$key->r_s_plot_no.'</td>';
							$str.='<td align="center">'.$key->remarks.'</td>';
						$str.='</tr>';
						$i++;
					}
	    		}
	    		$str.='<input type="hidden" name="bidder_info_counter" id="bidder_info_counter" value="'.($i-1).'">';
				$str.='</tbody>
						</table>
					</div>';
	    	}
	    	if (!empty($suit_file_details)) 
	    	{
	    		$expense = $this->Legal_file_process_model->get_expense_details($suit_file_details->id,$details->requisition);
	    		if ($suit_file_details->arji_copy!='') {
	    			$arji_copy='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/arji_copy/'.$suit_file_details->arji_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$arji_copy="";}
	    		$expense = $this->Legal_file_process_model->get_expense_details($suit_file_details->id,$details->requisition);
	    		$str.='<br/>';
	    		$str .='<table style="width: 100%;" id="preview_table" class="suit_file">
					<thead>
					<tr>
						<td colspan="2" style="font-size:20px;font-weight:bold;text-align:center">Suit File Info</td>
					</tr>
					</thead>
					<tbody id="details_body" id="suit_file">
	    				<tr>
							<td width="50%" align="left"><strong>Case Name:</strong>'.$suit_file_details->case_name.'</td>
							<td width="50%" align="left"><strong>Case Number:</strong>'.$suit_file_details->case_number.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Claim Amount:</strong>'.$suit_file_details->case_claim_amount.'</td>
							<td width="50%" align="left"><strong>Previous Date:</strong>'.$suit_file_details->prev_date.'</td>
							

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Status Previous Date:</strong>'.$suit_file_details->case_sts_prev_dt.'</td>
							<td width="50%" align="left"><strong>Activities Previous Date:</strong>'.$suit_file_details->act_prev_date.'</td>
							

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Next Date:</strong> '.$suit_file_details->next_date.'</td>
							<td width="50%" align="left"><strong>Case Status Next Date:</strong>'.$suit_file_details->case_sts_next_dt.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Remarks Next Date:</strong>'.$suit_file_details->remarks_next_date.'</td>
							<td width="50%" align="left"><strong>Filling Plaintiff:</strong>'.$suit_file_details->filling_plaintiff.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Filling Date:</strong>'.$suit_file_details->filling_date.'</td>
							<td width="50%" align="left"><strong>Suit File Entry Date:</strong>'.$suit_file_details->e_dt.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Deal Officer:</strong>'.$suit_file_details->case_deal_officer.'</td>
							<td width="50%" align="left"><strong>Previous Lawyer Name:</strong>'.$suit_file_details->prev_lawyer_name.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Present Lawyer Name:</strong>'.$suit_file_details->prest_lawyer_name.'</td>
							
							<td width="50%" align="left"><strong>Previous Court Name:</strong>'.$suit_file_details->prev_court_name.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Present Court Name:</strong>'.$suit_file_details->prest_court_name.'</td>
							<td width="50%" align="left"><strong>Suit File Entry By:</strong>'.$suit_file_details->e_by.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Arji Copy:</strong>'.$arji_copy.'</td>
							<td width="50%" align="left"></td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Judge Name:</strong>'.$suit_file_details->judge_name.'</td>
							<td width="50%" align="left"><strong>Judge Phone:</strong>'.$suit_file_details->judge_phone.'</td>
						</tr>';
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
							<td width="10%" style="font-weight: bold;text-align:center">Expense Type</td>
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
						$str.='<tr>';
							$str.='<td align="center">'.$key->expense_type_name.'</td>';
							$str.='<td align="left">'.$key->vendor_name.'</td>';
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
	    	if (isset($_POST['operation']) && $this->input->post('operation')=='reassign') {
	    		$link_id='227';
	    		$legal_user = $this->User_info_model->get_checker_data($link_id,'2',"FIND_IN_SET(".$details->legal_region.",legal_region)");
	    	}else{
	    		$legal_user = array();
	    	}
	    	//For Court Fee generation when lawyer select
	    	if (isset($_POST['operation']) && $this->input->post('operation')=='sendnotificationlawyer') {
	    		$cma_data = $this->db->query("SELECT c.id,c.st_belance,c.total_final_ln,c.req_type,c.case_fill_dist
				FROM cma as c 
				WHERE c.id=".$this->db->escape($this->input->post('id'))." LIMIT 1")->row();
	    		if(!empty($cma_data) && $cma_data->req_type==2)
	    		{
	    			$pre_court_fee_data = $this->db->query("SELECT c.*
					FROM cost_details as c 
					WHERE c.vendor_type=4 AND c.main_table_name='cma' AND c.main_table_id=".$this->db->escape($this->input->post('id'))." ORDER BY c.id DESC LIMIT 1 " )->row();
	    			$pre_set_data = $this->User_info_model->upr_config_row();
					$procurement = $pre_set_data->procurement;
					$fixed_court_fee = $pre_set_data->fixed_court_fee;

					//Court Fee Calculation
					$court_fee_25 = (($cma_data->st_belance/100)*2.5);
                    $court_fee_15 = (($court_fee_25/100)*15);
                    $actual_cost = ($court_fee_25+$court_fee_15);
                    if ($actual_cost>$fixed_court_fee)
                    {
                        $actual_cost = $fixed_court_fee;
                    }
                    $court_fee = ($actual_cost+$procurement);
                    if(empty($pre_court_fee_data))
                    {
                    	$pre_court_fee_data = 0;
                    }
	    		}
	    		else
	    		{
	    			$pre_court_fee_data = 0;
	    			$court_fee = 0;
		    		$procurement = 0;
	    		}
				$lawyer_info=$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1 AND district="'.$cma_data->case_fill_dist.'"');

	    	}else{
	    		$pre_court_fee_data = 0;
	    		$court_fee = 0;
	    		$procurement = 0;
	    	}
	    	$var =array(
	    			"pre_court_fee_data"=>$pre_court_fee_data,
	    			"procurement"=>$procurement,
	    			"lawyer_info"=>$lawyer_info,
	    			"court_fee"=>$court_fee,
	    			"legal_user"=>$legal_user,
	    			"str"=>$str,
	    			"case_claim_amount"=>$case_claim_amount,
	    			"court_fee_amount"=>$court_fee_amount,
	    			"court_fee_id"=>$court_fee_id,
					"checker_info"=>$checker_info,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	}
	function r_history()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$sah=$this->Cma_process_model->get_r_history($this->input->post('id'),$this->input->post('life_cycle'));
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
	function bulk_acktion()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Cma_process_model->bulk_acktion();
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

}
