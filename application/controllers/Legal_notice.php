<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Legal_notice extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Legal_notice_model', '', TRUE);
		$this->load->model('Legal_notice_ho_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
	}

	function view($menu_group, $menu_cat)
	{
		$link_id = 172;
		$data = array(
			'menu_group' => $menu_group,
			'menu_cat' => $menu_cat,
			'pages' => 'legal_notice/pages/grid',
			'checker_info' => $this->User_info_model->get_checker_data($link_id, '3,4,12,13,14,15'),
			'per_page' => $this->config->item('per_pagess')
		);
		$this->load->view('grid_layout', $data);
	}

	function grid()
	{
		$this->load->model('Legal_notice_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Legal_notice_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'), $pagesize, $start);

		$data[] = array(
			'TotalRows' => $result['TotalRows'],
			'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function search_grid()
	{
		$result = $this->Legal_notice_model->get_grid_data(0, '', '', 200, 0);

		$data[] = array(
			'TotalRows' => $result['TotalRows'],
			'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function from($add_edit = 'add', $id = NULL, $editrow = NULL, $proposed_type = NULL, $operation = NULL)
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
		if ($add_edit == 'edit' && $proposed_type == 2) {
			$card_facility = $this->Legal_notice_model->get_card_facility($id); //all Facility for this card
		} else {
			$card_facility = array();
		}
		if ($add_edit == 'edit' && $proposed_type == 1) {
			$facility_info = $this->Legal_notice_model->get_facility_info($add_edit, $id);
		} else if ($add_edit == 'edit' && $proposed_type == 2) {
			$facility_info = $this->Legal_notice_model->get_facility_info_card($id);
		} else {
			$facility_info = array();
		}
		$this->load->model('Legal_notice_model', '', TRUE);
		$result = $this->Legal_notice_model->get_info($add_edit, $id);
		if ($add_edit == 'edit') {
			$pre_ln_data = $this->Legal_notice_model->get_pre_ln_data_by_id($result->pre_ln_id);
		} else {
			$pre_ln_data = array();
		}
		$data = array(
			'option' => '',
			'add_edit' => $add_edit,
			'operation' => $operation,
			'result' => $result,
			'pre_ln_data' => $pre_ln_data,
			'card_facility' => $card_facility,
			'facility_info' => $facility_info,
			'legal_notice_guarantor' => $this->Legal_notice_model->get_guarantor_info($add_edit, $id),
			'legal_notice_facility' => $this->Legal_notice_model->get_facility_info($add_edit, $id),
			'id' => $id,
			'cl' => $this->User_model->get_parameter_data('ref_cl', 'name', 'data_status = 1'),
			'branch_sol' => $this->User_model->get_parameter_data('ref_branch_sol', 'name', 'data_status = 1'),
			'summon_address' => $this->User_model->get_parameter_data('ref_summon_address', 'name', 'data_status = 1'),
			'facility_name' => $this->User_model->get_parameter_data('ref_facility_name', 'name', 'data_status = 1'),
			'req_type' => $this->User_model->get_parameter_data('ref_req_type', 'name', 'data_status = 1'),
			'unit_office' => $this->User_model->get_parameter_data('ref_unit_office', 'name', 'data_status = 1'),
			'region_data' => $region_data,
			'district_list' => $district_list,
			'territory_list' => $territory_list,
			'unit_office_list' => $unit_office_list,
			'guar_occ' => $this->User_model->get_parameter_data('ref_guar_occ', 'name', 'data_status = 1'),
			'guar_sts' => $this->User_model->get_parameter_data('ref_guar_sts', 'name', 'data_status = 1'),
			'guar_type' => $this->User_model->get_parameter_data('ref_guar_type', 'name', 'data_status = 1'),
			'sub_type' => $this->User_model->get_parameter_data('ref_subject_type', 'name', 'data_status = 1'),
			'loan_segment' => $this->User_model->get_parameter_data('ref_loan_segment', 'name', 'data_status = 1'),
			'lawyer' => $this->User_model->get_parameter_data('ref_lawyer', 'name', 'data_status = 1'),
			'pages' => 'legal_notice/pages/form',
			'editrow' => $editrow,
			'acLength' => $acPartStr
		);
		$this->load->view('legal_notice/form_layout', $data);
	}
	function fromrecommend($id = NULL, $editrow = NULL, $proposed_type = NULL)
	{
		//echo $id;exit;
		$result = $this->Legal_notice_model->get_recommend_info($id);
		if ($proposed_type == 1) {
			$facility_info = $this->Legal_notice_model->get_facility_info('edit', $id);
		} else if ($proposed_type == 2) {
			$facility_info = $this->Legal_notice_model->get_facility_info_card($id);
		} else {
			$facility_info = array();
		}
		$pre_ln_data = $this->Legal_notice_model->get_pre_ln_data_by_id($result->pre_ln_id);
		$data = array(
			'option' => '',
			'result' => $result,
			'facility_info' => $facility_info,
			'pre_ln_data' => $pre_ln_data,
			'id' => $id,
			'proposed_type' => $proposed_type,
			'legal_notice_guarantor' => $this->Legal_notice_model->get_guarantor_info('add', $id),
			'pages' => 'legal_notice/pages/form_recommend',
			'edit_row' => $editrow
		);
		$this->load->view('user_info/form_layout', $data);
	}
	function add_edit_action($add_edit = NULL, $edit_id = NULL)
	{
		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		if ($this->session->userdata['ast_user']['login_status']) {
			$id = $this->Legal_notice_model->add_edit_action($add_edit, $edit_id);
		} else {
			$text[] = "Session out, login required";
		}

		$Message = '';
		if ($id != '00') {
			if (count($text) <= 0) {
				$Message = 'OK';
				$row = $this->Legal_notice_model->get_recommend_info($id);
			} else {
				for ($i = 0; $i < count($text); $i++) {
					if ($i > 0) {
						$Message .= ',';
					}
					$Message .= $text[$i];
				}
				$row[] = '';
			}
		} else {
			$Message = 'Failed';
		}
		$var['csrf_token'] = $csrf_token;
		$var['Message'] = $Message;
		$var['row_info'] = $row;
		$var['id'] = $id;
		echo json_encode($var);
	}
	function get_city_country($code = NULL, $table_name = NULL)
	{
		if ($code != NULL && $table_name != NULL) {
			$city_country = $this->Common_model->get_city_country($code, $table_name);
			if (!empty($city_country)) {
				return $city_country->name;
			} else {
				return '';
			}
		} else {
			return '';
		}
	}
	function get_card_sub_data()
	{
		$loan_ac = '22222222222222222';
		$api_config = $this->Common_model->get_api_config_data('Card Pro Sys DB', 'cardpro');
		$results = $this->Common_model->get_sub_card_data('GetCustomerSubInfoByCardNo', $loan_ac, $api_config->dev_live);
		// echo "<pre>";
		// print_r($results['row_info']);

		// $obj[0] = (object) array('st' => 'foo');
		// echo "<pre>";
		// print_r($obj);
		//exit;
		foreach ($results['row_info'] as $key) {
			echo $key->CB_FIN_ACCTNO;
		}
		//echo $results['row_info'][0]->CB_FIN_ACCTNO;
		exit;
	}
	function get_cif()
	{
		$loan_ac = $_POST['ac'];
		$cif = $_POST['cif'];
		//Get pre LN data
		$pre_ln_data = $this->Legal_notice_model->get_pre_ln_data($loan_ac, $_POST['type']);
		if (empty($pre_ln_data)) {
			$pre_ln_data = '';
		}
		$csrf_token = $this->security->get_csrf_hash();
		$this->load->library('WebService');
		$facility_info = array();
		$results = array();
		$sub_card_data_result = array();
		$sub_card_data = array();
		$ws = new WebService();
		if ($_POST['type'] == 'Card') {
			$api_config = $this->Common_model->get_api_config_data('Card Pro Sys DB', 'cardpro');
			if ($api_config->active_sts == 1) {
				$results = $this->Common_model->get_card_data('GetCustomerInfoByCardNo', $loan_ac, $api_config->dev_live);
				if ($results['Message'] == 'ok') {
					$Message = 'ok';
					//For Sub Card Data
					$sub_card_data_result = $this->Common_model->get_sub_card_data('GetCustomerSubInfoByCardNo', $loan_ac, $api_config->dev_live);
					if (!empty($sub_card_data_result['row_info']) && $sub_card_data_result['Message'] == 'ok') {
						$sub_card_data = $sub_card_data_result['row_info'];
					}
					$api_config2 = $this->Common_model->get_api_config_data('CBS Middleware', 'Loan Details');
					if ($api_config2->active_sts == 1) {
						$facility_info = $ws->call_service('GetFacilityDetailsByCifAndLoanAc', $api_config2->dev_live, $api_config2->api_url, $api_config2->user_id, $api_config2->channel_id, $api_config2->password, $loan_ac, $results['CIF_NO']);
					} else {
						$facility_info = array();
					}
				} else {
					$Message = 'notok';
				}
			} else {
				$Message = 'notactive';
			}
			$var = array(
				"Message" => $Message,
				"results" => $results,
				"facility_info" => $facility_info,
				"sub_card_data" => $sub_card_data,
				"csrf_token" => $csrf_token,
				"pre_ln_data" => $pre_ln_data,
				"facility_info" => $facility_info
			);
		} else {
			$check = 0;
			$schema_type = '';
			$ac_name = '';
			$sol = '';
			$mobileNo = '';
			$spouse_name = '';
			$father_name = '';
			$mother_name = '';
			$loan_segment = '';
			$business_type = '';
			$present_address = '';
			$parmanent_address = '';
			$business_address = '';
			$borrower_name = '';
			$corp_id = '';
			$guar_info = array();
			$facility_info = array();
			$api_config3 = $this->Common_model->get_api_config_data('CBS Middleware', 'Loan Details');
			if ($api_config3->active_sts == 1) {
				$results = $ws->call_service('GetLoanDetalsByCif', $api_config3->dev_live, $api_config3->api_url, $api_config3->user_id, $api_config3->channel_id, $api_config3->password, $cif, $loan_ac);
				$api_config7 = $this->Common_model->get_api_config_data('CBS Middleware', 'Loan Details');
				if (!empty($results)) {
					for ($i = 1; $i <= count($results); $i++) {
						//Get Facility info for all account
						if ($api_config7->active_sts == 1) {
							$facility_info[$i]['facilit_type'] = $results[$i]['loanType'];
							$facility_info[$i]['dis_date'] = $results[$i]['dis_date'];
							$facility_info[$i]['lastAnyTrnDate'] = $results[$i]['lastAnyTrnDate'];
							$facility_info[$i]['dis_amt'] = $results[$i]['dis_amt'];
							$facility_info[$i]['schmDesc'] = $results[$i]['schmDesc'];
							$facility_info[$i]['ac_name'] = $results[$i]['accountHolderName'];
							$facility_info[$i]['details'] = $ws->call_service('GetFacilityDetailsByCifAndLoanAc', $api_config7->dev_live, $api_config7->api_url, $api_config7->user_id, $api_config7->channel_id, $api_config7->password, $results[$i]['accountNumber'], $cif);
						} else {
							$facility_info = array();
						}
						//Checking account number matching or not
						if ($results[$i]['accountNumber'] == $loan_ac) {
							$check = 1;
							$schema_type = $results[$i]['schemeType'];
							$ac_name = $results[$i]['accountHolderName'];
							$sol = $results[$i]['sol'];
							$mobileNo = $results[$i]['mobileNo'];
							$corp_id = $results[$i]['corp_id'];
							$Message = 'ok';
							$api_config4 = $this->Common_model->get_api_config_data('CBS', 'n/a');
							if ($api_config4->active_sts == 1) {
								//For Corporate Account
								if ($corp_id[0] != '') {
									//$results3 = $ws->call_service('GetGuarantorFatherInfocorporateByCif',$api_config4->dev_live,$api_config4->api_url,$api_config4->user_id,$api_config4->channel_id,$api_config4->password,$cif);
									$results3 = $ws->call_service('GetBorrowerDetailsByCif', $api_config4->dev_live, $api_config4->api_url, $api_config4->user_id, $api_config4->channel_id, $api_config4->password, $cif);
									$borrower_name = $results3[1]['nameproprietor'][0];
								} else //For Retails Account
								{
									$results3 = $ws->call_service('GetGuarantorFatherInfoByCif', $api_config4->dev_live, $api_config4->api_url, $api_config4->user_id, $api_config4->channel_id, $api_config4->password, $cif);
								}

								$father_name = $results3[1]['father_name'][0];
								$mother_name = $results3[1]['mother_name'][0];
								$spouse_name = $results3[1]['spouse_name'][0];
								$business_type = $results3[1]['cust_type'][0];
								$loan_segment = $results[$i]['accountCifType'][0];
								$present_address = ucwords(strtolower($results3[1]['present_address1'][0] . $results3[1]['present_address2'][0] . $results3[1]['present_address3'][0] . ' ' . $this->get_city_country($results3[1]['present_address_city'][0], 'ref_city')));
								$parmanent_address = ucwords(strtolower($results3[1]['parmanent_address1'][0] . $results3[1]['parmanent_address2'][0] . $results3[1]['parmanent_address3'][0] . ' ' . $this->get_city_country($results3[1]['parmanent_address_city'][0], 'ref_city')));
								$business_address = ucwords(strtolower($results3[1]['business_address1'][0] . $results3[1]['business_address2'][0] . $results3[1]['business_address3'][0] . ' ' . $this->get_city_country($results3[1]['business_address_city'][0], 'ref_city')));
							}
						}
					}
					if ($check == 1) {
						//Get Guarantor Info
						$api_config5 = $this->Common_model->get_api_config_data('CBS', 'n/a');
						if ($api_config5->active_sts == 1) {
							$results2 = $ws->call_service('GetGurantorDetailsByLoanAC', $api_config5->dev_live, $api_config5->api_url, $api_config5->user_id, $api_config5->channel_id, $api_config5->password, $loan_ac, $schema_type[0]);
						} else {
							$results2 = array();
						}
						if (!empty($results2)) {
							for ($i = 1; $i <= count($results2); $i++) {
								$guar_info[$i]['type'] = $results2[$i]['type'];
								$guar_info[$i]['ac_no'] = $results2[$i]['cust_id'];
								$guar_info[$i]['name'] = $results2[$i]['name'];
							}
							//Get Guarantor father name mother name
							$api_config6 = $this->Common_model->get_api_config_data('CBS', 'n/a');
							if ($api_config6->active_sts == 1) {
								for ($i = 1; $i <= count($guar_info); $i++) {
									$results4 = $ws->call_service('GetGuarantorFatherInfoByCif', $api_config6->dev_live, $api_config6->api_url, $api_config6->user_id, $api_config6->channel_id, $api_config6->password, $guar_info[$i]['ac_no']);
									if ($guar_info[$i]['type'] == 'M' && $corp_id[0] != '') {
										$guar_info[$i]['name'] = $borrower_name;
										$guar_info[$i]['present_address'] = $present_address;
										$guar_info[$i]['permanent_address'] = $parmanent_address;
										$guar_info[$i]['business_address'] = $business_address;
										$guar_info[$i]['father_name'] = $father_name;
										$guar_info[$i]['mother_name'] = $mother_name;
										$guar_info[$i]['Occupation'] = '';
									} else {
										$guar_info[$i]['father_name'] = $results4[1]['father_name'][0];
										$guar_info[$i]['mother_name'] = $results4[1]['mother_name'][0];
										$guar_info[$i]['Occupation'] = $results4[1]['Occupation'][0];
										$guar_info[$i]['present_address'] = ucwords(strtolower($results4[1]['present_address1'][0] . $results4[1]['present_address2'][0] . ' ' . $this->get_city_country($results4[1]['present_address_city'][0], 'ref_city')));
										$guar_info[$i]['permanent_address'] = ucwords(strtolower($results4[1]['parmanent_address1'][0] . $results4[1]['parmanent_address2'][0] . ' ' . $this->get_city_country($results4[1]['parmanent_address_city'][0], 'ref_city')));
										$guar_info[$i]['business_address'] = ucwords(strtolower($results4[1]['business_address1'][0] . $results4[1]['business_address2'][0] . ' ' . $this->get_city_country($results4[1]['business_address_city'][0], 'ref_city')));
									}
								}
							} else {
								$guar_info[$i]['father_name'] = '';
								$guar_info[$i]['mother_name'] = '';
								$guar_info[$i]['Occupation'] = '';
								$guar_info[$i]['present_address'] = '';
								$guar_info[$i]['permanent_address'] = '';
								$guar_info[$i]['business_address'] = '';
							}
						} else {
						}
					} else {
						$Message = 'ACnotMatched';
					}
				} else {
					$Message = 'NoData';
				}
			} else {
				$Message = 'NoData';
			}
			$var = array(
				'Message' => $Message,
				'mobileNo' => $mobileNo,
				'ac_name' => $ac_name,
				'sol' => $sol,
				'loan_segment' => $loan_segment,
				'business_type' => $business_type,
				'father_name' => $father_name,
				'borrower_name' => $borrower_name,
				'mother_name' => $mother_name,
				'spouse_name' => $spouse_name,
				'present_address' => $present_address,
				'parmanent_address' => $parmanent_address,
				'business_address' => $business_address,
				'guar_details' => $guar_info,
				"csrf_token" => $csrf_token,
				"pre_ln_data" => $pre_ln_data,
				"facility_info" => $facility_info
			);
		}

		echo json_encode($var);
	}
	function delete_action()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		if ($this->session->userdata['ast_user']['login_status']) {
			$id = $this->Legal_notice_model->delete_action();
		} else {
			$text[] = "Session out, login required";
		}
		$Message = '';
		if (count($text) <= 0) {
			$Message = 'OK';

			if ($id == 'taken') {
				$Message = 'Action Already Taken Plz Refresh';
				$row[] = '';
			} else if ($id == 0) {
				$Message = 'Something went wrong';
				$row[] = '';
			} else if ($this->input->post("type") == 'delete') {
				$row[] = '';
			} else {
				$row = $this->Legal_notice_model->get_recommend_info($id);
			}
		} else {
			for ($i = 0; $i < count($text); $i++) {
				if ($i > 0) {
					$Message .= ',';
				}
				$Message .= $text[$i];
			}
			$row[] = '';
		}
		$var['csrf_token'] = $csrf_token;
		$var['Message'] = $Message;
		$var['row_info'] = $row;
		$var['id'] = $id;
		echo json_encode($var);
	}
	function details()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$str = '';
		$checker_info = array();
		if ($this->input->post('id') != "") {
			$details = $this->Legal_notice_model->get_recommend_info($this->input->post('id'));
			$guarantor_info = $this->Legal_notice_model->get_guarantor_info('edit', $this->input->post('id'));
			if ($details->proposed_type == 'Loan') {
				$facility_info = $this->Legal_notice_ho_model->get_facility($this->input->post('id'));
			} else {
				$facility_info = $this->Legal_notice_ho_model->get_card_facility($this->input->post('id'));
			}
			if ($this->input->post('territory') != '' && $this->input->post('region') != '') {
				$checker_info = $this->user_model->get_checker_info($this->input->post('territory'), $this->input->post('region'));
			} else {
				$checker_info = array();
			}
		} else {
			$details = array();
		}
		if (!empty($details)) {
			$pre_ln_data = $this->Legal_notice_model->get_pre_ln_data_by_id($details->pre_ln_id);
			if ($details->proposed_type == 'Loan') {
				$no_tag = "Loan A/C";
				$guar_tag = "Borrower/Guarantor/Company Director/Owner";
				$nam_tag = "Loan A/C Name";
			} else {
				$no_tag = "Card";
				$guar_tag = "Borrower/Reference";
				$nam_tag = "Name on Card";
			}
			if ($details->spouse_name != '') {
				$spouse_name = $details->spouse_name;
			} else {
				$spouse_name = "N/A";
			}
			if ($details->mother_name != '') {
				$mother_name = $details->mother_name;
			} else {
				$mother_name = "N/A";
			}
			if ($details->call_up_file != '') {
				$call_up_file = '<img id="file_preview" onclick="popup(\'' . base_url() . 'legal_notice_file/call_up_file/' . $details->call_up_file . '\')" style=" cursor:pointer;text-align:center" height="18" src="' . base_url() . 'old_assets/images/print-preview.png">';
			} else {
				$call_up_file = "";
			}
			$str .= '<table style="width: 100%;" id="preview_table">
					<thead></thead>
					<tbody id="details_body">
	    				<tr>
							<td width="50%" align="left"><strong>SL No.:</strong>' . $details->sl_no . '</td>
							<td width="50%" align="left"><strong>More A/C No.:</strong>' . $details->more_acc_number . '</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Proposed Type:</strong>' . $details->proposed_type . '</td>
							<td width="50%" align="left"><strong>Remarks:</strong>' . $details->remarks . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>' . $no_tag . 'No.:</strong> ' . $details->loan_ac . '</td>
							<td width="50%" align="left"><strong>Status:</strong>' . $details->legal_notice_sts . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>CIF:</strong>' . $details->cif . '</td>
							<td width="50%" align="left"><strong>Initiate By:</strong>' . $details->e_by . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Branch SOL:</strong>' . $details->branch_sol . '</td>
							<td width="50%" align="left"><strong>Initiate Date Time:</strong>' . $details->e_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>' . $nam_tag . ':</strong>' . $details->ac_name . '</td>
							<td width="50%" align="left"><strong>STC By:</strong>' . $details->stc_by . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Business Type:</strong>' . $details->subject_name . '</td>
							<td width="50%" align="left"><strong>STC Date Time:</strong>' . $details->stc_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Spouse Name :</strong>' . $spouse_name . '</td>
							<td width="50%" align="left"><strong>Recommended By:</strong>' . $details->rec_by . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Mother Name :</strong>' . $mother_name . '</td>
							<td width="50%" align="left"><strong>Recommend Date Time:</strong>' . $details->rec_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Loan Segment (Portfolio) :</strong>' . $details->loan_segment . '</td>
							<td width="50%" align="left"><strong>Acknowledge By:</strong>' . $details->ack_by . '</td>

							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Current/Updated Address:</strong>' . $details->current_address . '</td>
							<td width="50%" align="left"><strong>Acknowledge Date Time:</strong>' . $details->ack_dt . '</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Region:</strong>' . $details->region_name . '</td>
							<td width="50%" align="left"><strong>Send To HOLM By:</strong>' . $details->sth_by . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Territory:</strong>' . $details->territory_name . '</td>
							<td width="50%" align="left"><strong>Send To HOLM Date Time:</strong>' . $details->sth_dt . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>District:</strong>' . $details->district_name . '</td>
							<td width="50%" align="left"><strong>Verify By:</strong>' . $details->v_by . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Unit Office:</strong>' . $details->unit_office_name . '</td>
							<td width="50%" align="left"><strong>Verify Date Time:</strong>' . $details->v_dt . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Hold Reason:</strong>' . $details->hold_reason . '</td>
							<td width="50%" align="left"><strong>Customer Contact:</strong>' . $details->mobile_no . '</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Call up File:</strong>' . $call_up_file . '</td>
							<td width="50%" align="left"><strong>Legal Notice sent by:</strong>' . $details->l_sent_by . '</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Call up Date:</strong>' . $details->call_up_dt . '</td>
							<td width="50%" align="left"><strong>Legal Notice sent Date:</strong>' . $details->legal_notice_s_dt . '</td>
							
						</tr>';
			if (!empty($pre_ln_data)) {
				$str .= '<tr>
								<td width="50%" align="left"><strong>Pre LN By:</strong>' . $pre_ln_data->pre_ln_by . '</td>
								<td width="50%" align="left"><strong>Pre LN File:</strong><a id="inXLadfc" style="text-align:center;cursor:pointer;" href="' . base_url() . 'index.php/legal_notice_ho/download_pdf/' . $pre_ln_data->id . '/' . $pre_ln_data->proposed_type . '" target="_blank" >&nbsp;&nbsp;<img width="20px" height="20px" align="center" src="' . base_url() . 'images/pdf_icon.gif"></a></td>
							</tr>';
			}
			$str .= '<tr>
							
							<td width="50%" align="left"><strong>Lawyer Name:</strong>' . $details->lawyer_name . '</td>
							<td width="50%" align="left"></td>
						</tr>
					</tbody>
				</table>';
		}
		if (!empty($guarantor_info)) {
			$str .= '<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">' . $guar_tag . '</span>
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
			foreach ($guarantor_info as $key) {
				$str .= '<tr>';
				$str .= '<td align="center">' . $key->type_name . '</td>';
				$str .= '<td align="left">' . $key->guarantor_name . '</td>';
				$str .= '<td align="left">' . $key->father_name . '</td>';
				$str .= '<td align="left">' . $key->present_address . '</td>';
				$str .= '<td align="left">' . $key->permanent_address . '</td>';
				$str .= '<td align="left">' . $key->business_address . '</td>';
				$str .= '<td align="center">' . $key->guar_sts_name . '</td>';
				$str .= '<td align="center">' . $key->occ_sts_name . '</td>';
				$str .= '</tr>';
			}

			$str .= '</tbody>
					</table>
				</div>';
		}
		if (!empty($facility_info)) {
			if ($details->proposed_type == 'Loan') {
				$str .= '<br/><div id="facility_for_loan" style="background-color:#eaeaea;padding:10px;margin:0 0px;overflow:scroll;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
					<table border="1" id="facility_table" style="border-color:#c0c0c0;width:127%;margin:20px" >
					<thead>
						<tr>
							<td width="5%" style="font-weight: bold;text-align:center">Faci lity Type</td>
							<td width="5%" style="font-weight: bold;text-align:center">A/C Number</td>
							<td width="5%" style="font-weight: bold;text-align:center">A/C Name</td>
							<td width="5%" style="font-weight: bold;text-align:center">Sch Desc.</td>
							<td width="5%" style="font-weight: bold;text-align:center">Disbur sement Date</td>
							<td width="7%" style="font-weight: bold;text-align:center">Disbur sed Amount</td>
							<td width="7%" style="font-weight: bold;text-align:center">Expire Date</td>
							<td width="7%" style="font-weight: bold;text-align:center">Due install ments</td>
							<td width="7%" style="font-weight: bold;text-align:center">Payable</td>
							<td width="7%" style="font-weight: bold;text-align:center">Repayment</td>
							<td width="7%" style="font-weight: bold;text-align:center">Outst anding Balance</td>
							<td width="7%" style="font-weight: bold;text-align:center">Outst anding Balance Date</td>
							<td width="7%" style="font-weight: bold;text-align:center">Overdue Balance</td>
							<td width="7%" style="font-weight: bold;text-align:center">Overdue BL Date</td>
							<td width="7%" style="font-weight: bold;text-align:center">Call -up Date</td>
							<td width="7%" style="font-weight: bold;text-align:center">CL(BB)</td>
							<td width="7%" style="font-weight: bold;text-align:center">CL(BBL)</td>
						</tr>
					</thead>
					<tbody id="facility_info_loan">';
				foreach ($facility_info as $key) {
					$str .= '<tr>';
					$str .= '<td align="left">' . $key->facility_type_name . '</td>';
					$str .= '<td align="left">' . $key->ac_number . '</td>';
					$str .= '<td align="left">' . $key->ac_name . '</td>';
					$str .= '<td align="left">' . $key->sch_desc . '</td>';
					$str .= '<td align="left">' . $key->disbursement_date . '</td>';
					$str .= '<td align="left">' . $key->disbursed_amount . '</td>';
					$str .= '<td align="left">' . $key->expire_date . '</td>';
					$str .= '<td align="left">' . $key->due_installments . '</td>';
					$str .= '<td align="left">' . $key->payble . '</td>';
					$str .= '<td align="left">' . $key->repayment . '</td>';
					$str .= '<td align="left">' . $key->outstanding_bl . '</td>';
					$str .= '<td align="left">' . $key->outstanding_bl_dt . '</td>';
					$str .= '<td align="left">' . $key->overdue_bl . '</td>';
					$str .= '<td align="left">' . $key->overdue_bl_dt . '</td>';
					$str .= '<td align="left">' . $key->call_up_dt . '</td>';
					$str .= '<td align="left">' . $key->cl_bb . '</td>';
					$str .= '<td align="left">' . $key->cl_bbl . '</td>';
					$str .= '</tr>';
				}
				$str .= '</tbody>
						</table>
					</div>';
			} else {
				$str .= '<br/><div id="facility_for_card" style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
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
				foreach ($facility_info as $key) {
					$str .= '<tr>';
					$str .= '<td align="center">' . $key->card_type . '</td>';
					$str .= '<td align="center">' . $key->card_no . '</td>';
					$str .= '<td align="center">' . $key->card_name . '</td>';
					$str .= '<td align="center">' . $key->card_issue_dt . '</td>';
					$str .= '<td align="center">' . $key->card_exp_dt . '</td>';
					$str .= '<td align="center">' . $key->card_limit . '</td>';
					$str .= '<td align="center">' . $key->outstanding_bl . '</td>';
					$str .= '<td align="center">' . $key->outstanding_bl_dt . '</td>';
					if ($key->card_type == 'Basic') {
						$str .= '<td align="center">' . $details->cl_bb_card . '</td>';
						$str .= '<td align="center">' . $details->cl_bbl_card . '</td>';
					} else {
						$str .= '<td align="center">&nbsp;</td>';
						$str .= '<td align="center">&nbsp;</td>';
					}
					$str .= '</tr>';
				}
				$str .= '<tr>';
				$str .= '<td style="font-weight: bold;text-align:right" colspan="6">Total Outstanding : </td>';
				$str .= '<td style="font-weight: bold;text-align:center">' . $details->outstanding_bl . '</td>';
				$str .= '<td style="font-weight: bold;text-align:center"></td>';
				$str .= '</tr>';

				$str .= '</tbody>
						</table>
					</div>';
			}
		}
		$var = array(
			"str" => $str,
			"checker_info" => $checker_info,
			"csrf_token" => $csrf_token
		);
		echo json_encode($var);
	}
	function r_history()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$sah = $this->Legal_notice_model->get_r_history($this->input->post('id'), $this->input->post('life_cycle'));
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
		// $jTableResult['sql'] = $id;
		echo json_encode($jTableResult);
	}
	function bulk_operation($operation = NULL)
	{
		$operation_name = '';
		if ($operation == 'recommend') {
			$operation_name = 'Recommend';
		}
		$region = $this->user_model->get_parameter_data('ref_region', 'name', "data_status = '1'");
		$territory = array();
		$unit_office = $this->user_model->get_parameter_data('ref_unit_office', 'name', "data_status = '1'");
		$district = $this->user_model->get_parameter_data('ref_district', 'name', "data_status = '1'");
		$loan_segment = $this->user_model->get_parameter_data('ref_loan_segment', 'name', "data_status = '1'");
		$data = array(
			'region' => $region,
			'territory' => $territory,
			'unit_office' => $unit_office,
			'district' => $district,
			'loan_segment' => $loan_segment,
			'operation' => $operation,
			'operation_name' => $operation_name,
			'pages' => 'legal_notice/pages/bulk_operation',
		);
		$this->load->view('legal_notice/form_layout', $data);
	}
	function load_bulk_data()
	{
		$this->load->helper('form');
		$csrf_token = $this->security->get_csrf_hash();
		$grid_data = $this->Legal_notice_model->get_bulk_data();
		$operation = $this->input->post('operation');
		$str = '';
		$str .= '<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
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

		if (count($grid_data) <= 0) {
			$str .= '<tr><td colspan="11" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
			$str .= '<input type="hidden" name="event_counter" id="event_counter" value="0">';
			$str .= '</tbody></table></div>';
		} else {
			$i = 1;
			foreach ($grid_data as $data) {
				$str .= '<tr>';
				$str .= '<td align="center"><input type="checkbox" name="chkBoxSelect' . $i . '" id="chkBoxSelect' . $i . '" onClick="CheckChanged_2(this,\'' . $i . '\')" value="chk"/><input type="hidden" name="event_delete_' . $i . '" id="event_delete_' . $i . '" value="1"><input type="hidden" name="event_id_' . $i . '" id="event_id_' . $i . '" value="' . $data->id . '"></td>';
				$str .= '<td align="center"><div style="text-align:center; cursor:pointer" onclick="details(' . $data->id . ',\'details\')" ><img align="center" src="' . base_url() . 'images/view_detail.png"></div></td>';
				$str .= '<td align="left">' . $data->sl_no . '</td>';
				$str .= '<td align="left">' . $data->loan_segment . '</td>';
				$str .= '<td align="left">' . $data->loan_ac . '</td>';
				$str .= '<td align="left">' . $data->region_name . '</td>';
				$str .= '<td align="left">' . $data->territory_name . '</td>';
				$str .= '<td align="left">' . $data->district_name . '</td>';
				$str .= '<td align="left">' . $data->unit_office_name . '</td>';
				$str .= '<td align="left">' . $data->e_by . '</td>';
				$str .= '<td align="left">' . $data->e_dt . '</td>';
				$str .= '</tr>';
				$i++;
			}
			$str .= '<input type="hidden" name="event_counter" id="event_counter" value="' . ($i - 1) . '">';
			$str .= '</tbody></table></div>';
			$str .= '<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<tbody>';
			$str .= '<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="3">Total Selected : <span id="selected_value">0</span></td></tr>';
			$str .= '</tbody></table>';
		}
		$var = array(
			"str" => $str,
			"csrf_token" => $csrf_token
		);
		echo json_encode($var);
	}
	function bulk_acktion()
	{
		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if ($this->session->userdata['ast_user']['login_status']) {
			$id = $this->Legal_notice_model->bulk_acktion();
		} else {
			$text[] = "Session out, login required";
		}
		$Message = '';
		if (count($text) <= 0) {
			$Message = 'OK';
			if ($id == 'taken') {
				$Message = 'Action Already Taken Plz Refresh';
				$row[] = '';
			} else if ($id == 0) {
				$Message = 'Something went wrong';
				$row[] = '';
			} else if (isset($_POST['typebulk'])) {
				$row[] = '';
			} else {
				$row[] = '';
			}
		} else {
			for ($i = 0; $i < count($text); $i++) {
				if ($i > 0) {
					$Message .= ',';
				}
				$Message .= $text[$i];
			}
			$row[] = '';
		}
		$var['csrf_token'] = $csrf_token;
		$var['Message'] = $Message;
		$var['row_info'] = $row;
		$var['id'] = $id;
		echo json_encode($var);
	}
}
