<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Auction extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Auction_model', '', TRUE);
		$this->load->model('Cma_ho_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
	}

	function view($menu_group, $menu_cat) {
		$data = array(
			'menu_group' => $menu_group,
			'menu_cat' => $menu_cat,
			'pages' => 'auction/pages/grid',
			'auc_sts' => $this->User_model->get_parameter_data('ref_auc_sts', 'name', 'data_status = 1'),
			'paper_vendor' => $this->User_model->get_parameter_data('ref_paper_vendor', 'name', 'data_status = 1'),
			'per_page' => $this->config->item('per_pagess'),
		);
		$this->load->view('grid_layout', $data);
	}
	function bidder_notification()
	{
		$str = "SELECT  j0.bid_amount
                         FROM cma_auction_bidder j0
                     WHERE j0.notification_sts=0 AND j0.sts=1 AND DATE_FORMAT(j0.notification_date,'%Y-%m-%d')<='".date('Y-m-d')."'";

        $application_data = $this->db->query($str)->result();
	}
	function grid() {
		$this->load->model('Auction_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Auction_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'), $pagesize, $start);

		$data[] = array(
			'TotalRows' => $result['TotalRows'],
			'Rows' => $result['Rows'],
		);
		echo json_encode($data);
	}
	function delete_action() {
		$csrf_token = $this->security->get_csrf_hash();
		$text = array();
		if ($this->session->userdata['ast_user']['login_status']) {
			$id = $this->Auction_model->delete_action();
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
			} else if ($this->input->post("type") == 'delete') {$row[] = '';} else { $row = $this->Auction_model->get_add_action_data_auction($id);}
		} else {
			for ($i = 0; $i < count($text); $i++) {
				if ($i > 0) {$Message .= ',';}
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
	function from($add_edit = 'add', $id= NULL, $cma_id= NULL, $editrow = NULL) {
		$result = $this->Cma_process_model->get_recommend_info($cma_id);
		$doc_files = $this->Cma_process_model->get_cma_doc_files($cma_id);
		$result2 = $this->Auction_model->get_info($id);
		$data = array(
			'option' => '',
			'add_edit' => $add_edit,
			'result' => $result,
			'result2' => $result2,
			'cmaid' => $cma_id,
			'id' => $id,
			'doc_files' => $doc_files,
			'cma_guarantor' => $this->Cma_process_model->get_guarantor_info('edit', $cma_id),
			'facility_info' => $this->Cma_ho_model->get_facility($cma_id),
			'cma_mortgage' => $this->Auction_model->get_mortgage_info_by_cma($cma_id),
			'cma_mortgage_security' => $this->Auction_model->get_mortgage_security($cma_id),
			//'request_source' => $this->User_model->get_parameter_data('ref_request_source', 'name', 'data_status = 1'),
			'paper' => $this->User_model->get_parameter_data('ref_paper', 'name', 'data_status = 1'),
			'paper_vendor' => $this->User_model->get_parameter_data('ref_paper_vendor', 'name', 'data_status = 1'),
			'pages' => 'auction/pages/form',
			'editrow' => $editrow,
		);
		$this->load->view('auction/form_layout', $data);
	}
	function mortgage($id, $cma_id, $add_edit, $edit_id = Null) {
		$data = array(
			'option' => '',
			'cma_id' => $cma_id,
			'id' => $id,
			'add_edit' => $add_edit,
			'edit_id' => $edit_id,
			'valuator' => $this->User_model->get_parameter_data('ref_valuator', 'name', 'data_status = 1'),
			'revaluator' => $this->User_model->get_parameter_data('ref_revaluator', 'name', 'data_status = 1'),
			'results' => $this->Auction_model->get_where('cma_facility_mortgage', array('id' => $edit_id)),
			'pages' => 'auction/pages/mortgage',
		);
		$this->load->view('auction/form_layout', $data);
	}
	function auction_verify($id = NULL, $editrow = NULL, $cma_id = NULL) {
		$result = $this->Cma_process_model->get_recommend_info($cma_id);
		$doc_files = $this->Cma_process_model->get_cma_doc_files($cma_id);
		$data = array(
			'option' => '',
			'cma_id' => $cma_id,
			'id' => $id,
			'doc_files' => $doc_files,
			'edit_row' => $editrow,
			'cma_guarantor' => $this->Cma_process_model->get_guarantor_info('edit', $cma_id),
			'facility_info' => $this->Cma_ho_model->get_facility($cma_id),
			'cma_mortgage' => $this->Auction_model->get_mortgage_info_by_cma($cma_id),
			'cma_mortgage_security' => $this->Auction_model->get_mortgage_security($cma_id),
			'result' => $result,
			'pages' => 'auction/pages/auction_verify_form',
		);
		$this->load->view('auction/form_layout', $data);
	}
	function sendtolegal($id = NULL, $editrow = NULL, $cma_id = NULL, $legal_region = NULL) {
		$link_id = 222;
		$result = $this->Cma_process_model->get_recommend_info($cma_id);
		$doc_files = $this->Cma_process_model->get_cma_doc_files($cma_id);
		$data = array(
			'option' => '',
			'cma_id' => $cma_id,
			'id' => $id,
			'doc_files' => $doc_files,
			'edit_row' => $editrow,
			'result' => $result,
			'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
			'cma_guarantor' => $this->Cma_process_model->get_guarantor_info('edit', $cma_id),
			'checker_info' => $this->User_info_model->get_checker_data($link_id, '', "FIND_IN_SET(".$legal_region.",legal_region)"),
			'facility_info' => $this->Cma_ho_model->get_facility($cma_id),
			'cma_mortgage' => $this->Auction_model->get_mortgage_info_by_cma($cma_id),
			'cma_mortgage_security' => $this->Auction_model->get_mortgage_security($cma_id),
			'pages' => 'auction/pages/sendtolegal',
		);
		$this->load->view('auction/form_layout', $data);
	}
	function update_bidder($id = NULL, $editrow = NULL, $cma_id = NULL) {
		$result = $this->Cma_process_model->get_recommend_info($cma_id);
		$doc_files = $this->Cma_process_model->get_cma_doc_files($cma_id);
		$result3 = $this->Auction_model->get_bidder_details($cma_id);
		$data = array(
			'option' => '',
			'cma_id' => $cma_id,
			'id' => $id,
			'edit_row' => $editrow,
			'result' => $result,
			'result3' => $result3,
			'doc_files' => $doc_files,
			'cma_guarantor' => $this->Cma_process_model->get_guarantor_info('edit', $cma_id),
			'facility_info' => $this->Cma_ho_model->get_facility($cma_id),
			'cma_mortgage' => $this->Auction_model->get_mortgage_info_by_cma($cma_id),
			'cma_mortgage_security' => $this->Auction_model->get_mortgage_security($cma_id),
			'bidder_rank' => $this->User_model->get_parameter_data('ref_bidder_rank', 'name', 'data_status = 1'),
			'schedule' => $this->User_model->get_parameter_data('cma_facility_mortgage', 'id', 'sts = 1 AND cma_id=' . $cma_id . ''),
			'pages' => 'auction/pages/bidder_info',
		);
		$this->load->view('auction/form_layout', $data);
	}
	function paper_info($id = NULL, $editrow = NULL, $cma_id = NULL) {
		$result = $this->Cma_process_model->get_recommend_info($cma_id);
		$condition = "AND legal_sent_sts='1'";
		$doc_files = $this->Cma_process_model->get_cma_doc_files($cma_id, $condition);
		$data = array(
			'option' => '',
			'cma_id' => $cma_id,
			'id' => $id,
			'edit_row' => $editrow,
			'result' => $result,
			'doc_files' => $doc_files,
			'cma_guarantor' => $this->Cma_process_model->get_guarantor_info('edit', $cma_id),
			'facility_info' => $this->Cma_ho_model->get_facility($cma_id),
			'cma_mortgage' => $this->Auction_model->get_mortgage_info_by_cma($cma_id),
			'cma_mortgage_security' => $this->Auction_model->get_mortgage_security($cma_id),
			'paper' => $this->User_model->get_parameter_data('ref_paper', 'name', 'data_status = 1'),
			'paper_vendor' => $this->User_model->get_parameter_data('ref_paper_vendor', 'name', 'data_status = 1'),
			'pages' => 'auction/pages/paper_info',
		);
		$this->load->view('auction/form_layout', $data);
	}
	function get_vendor_info(){
		$csrf_token = $this->security->get_csrf_hash();
		$details = $this->Auction_model->get_vendor_info($this->input->post('id'));
		$var = array(
			"str" => $details,
			"csrf_token" => $csrf_token,
		);
		echo json_encode($var);
	}
	function vendor_notify_send(){
		$csrf_token = $this->security->get_csrf_hash();
		$response = $this->Auction_model->vendor_notify_send();
		$var['csrf_token'] = $csrf_token;
		$var['Message'] = $response;
		echo json_encode($var);
	}
	function memo_add($edit_id = NULL) {
		$csrf_token = $this->security->get_csrf_hash();
		$row = '';

		$text = array();
		if ($this->session->userdata['ast_user']['login_status']) {
			$id = $this->Auction_model->add_memo($edit_id);
		} else {
			$text[] = "Session out, login required";
		}

		$Message = '';
		if ($id != '00') {
			if (count($text) <= 0) {
				$Message = 'OK';
				$row = $this->Auction_model->get_add_action_data($id);
			} else {
				for ($i = 0; $i < count($text); $i++) {
					if ($i > 0) {$Message .= ',';}
					$Message .= $text[$i];
				}
				$row[] = '';
			}
		} else { $Message = 'Failed';}
		$var['csrf_token'] = $csrf_token;
		$var['Message'] = $Message;
		$var['row_info'] = $row;
		$var['id'] = $id;
		echo json_encode($var);
	}
	function mortgage_security_details() {
		$csrf_token = $this->security->get_csrf_hash();
		$str = '';
		if ($this->input->post('id') != "" && $this->input->post('type') == 'mortgage') {
			$details = $this->Auction_model->get_mortgage_info($this->input->post('id'));
			if (!empty($details)) {
				$str .= '<tr>
							<td width="50%" align="left"><strong>Mortgaged Schedule Name:</strong>' . $details->mort_schedule_name . '</td>
							<td width="50%" align="left"><strong>Re-Valuator/Surveyor Name:</strong>' . $details->re_valuator_name . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Description of the Schedule:</strong>' . $details->mort_schedule_desc . '</td>
							<td width="50%" align="left"><strong>Re-Valuator Date:</strong>' . $details->re_valuator_date . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Mortgage Deed Number:</strong>' . $details->deed_number . '</td>
							<td width="50%" align="left"><strong>Re-Valuator MV:</strong>' . $details->re_valuator_mv . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Mortgage Date:</strong>' . $details->mortgage_date . '</td>
							<td width="50%" align="left"><strong>Re-Valuator FSV:</strong>' . $details->re_valuator_fsv . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Valuator/Surveyor Name:</strong>' . $details->valuator_name . '</td>
							<td width="50%" align="left"><strong>Gov’t Mouza Rate:</strong>' . $details->gov_mouza_rate . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Valuator Date:</strong>' . $details->valuator_date . '</td>
							<td width="50%" align="left"><strong>Total Land Area (in decimals):</strong>' . $details->land_area . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Valuator MV:</strong>' . $details->valuator_mv . '</td>
							<td width="50%" align="left"><strong>Butted and bounded by (N,S, E W):</strong>' . $details->bounded_by . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Valuator FSV:</strong>' . $details->valuator_fsv . '</td>
							<td width="50%" align="left"></td>
						</tr>';
			} else {
				$str .= '
						<tr>
							<td width="100%" align="center" colspan="2"><strong>Sorry No Data</strong></td>
						</tr>
					';
			}

		} else {
			$details = $this->Auction_model->get_security_info($this->input->post('id'));
			if (!empty($details)) {
				$str .= '
						<tr>
							<td width="50%" align="left"><strong>Title deed number:</strong>' . $details->title_deed_number . '</td>
							<td width="50%" align="left"><strong>RS /MRR Khatian no.:</strong>' . $details->rs_khatian_no . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Date of registration:</strong>' . $details->reg_date . '</td>
							<td width="50%" align="left"><strong>BS/DP/ROR Khatian no.:</strong>' . $details->bs_dp_khatian_no . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Type of Deed:</strong>' . $details->deed_type . '</td>
							<td width="50%" align="left"><strong>City Jorip Khatian no.:</strong>' . $details->city_jorip_khatian_no . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>District:</strong>' . $details->district . '</td>
							<td width="50%" align="left"><strong>Mutation Khatian no.:</strong>' . $details->mutation_khatian_no . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Thana/Police Station:</strong>' . $details->thana . '</td>
							<td width="50%" align="left"><strong>CS Dag no.:</strong>' . $details->cs_dag_no . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>TSub-registry Office:</strong>' . $details->sub_reg_office . '</td>
							<td width="50%" align="left"><strong>SA Dag no.:</strong>' . $details->sa_dag_no . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Mouza:</strong>' . $details->mouza . '</td>
							<td width="50%" align="left"><strong>RS Dag no.:</strong>' . $details->rs_dag_no . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Land Area:</strong>' . $details->land_area . '</td>
							<td width="50%" align="left"><strong>BS/DP Dag no.:</strong>' . $details->bs_dp_dag_no . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Plot Number:</strong>' . $details->plot_number . '</td>
							<td width="50%" align="left"><strong>City Jorip Dag no.:</strong>' . $details->city_jorip_dag_no . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Holding number:</strong>' . $details->holding_number . '</td>
							<td width="50%" align="left"><strong>Jote  No.:</strong>' . $details->jote_no . '</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>CS Khatian no.:</strong>' . $details->cs_khatian_no . '</td>
							<td width="50%" align="left"><strong>SA/PS Khatian no.:</strong>' . $details->sa_khatian_no . '</td>
						</tr>
						';
			} else {
				$str .= '
							<tr>
								<td width="100%" align="center" colspan="2"><strong>Sorry No Data</strong></td>
							</tr>
						';
			}
		}
		$var = array(
			"str" => $str,
			"csrf_token" => $csrf_token,
		);
		echo json_encode($var);
	}
	function get_dropdown_data() {
		$csrf_token = $this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$condition = " AND district = " . $id . "";

		$r_office = $this->User_model->get_parameter_data('csms_ref_sro_office_name', 'name', "sts = '1' " . $condition . " ");
		$thana = $this->User_model->get_parameter_data('csms_ref_thana', 'name', "sts = '1' " . $condition . " ");
		$mouza = $this->User_model->get_parameter_data('csms_ref_mouza', 'name', "sts = '1' " . $condition . " ");
		$jTableResult = array();
		if ($r_office != null) {
			$jTableResult['r_office'] = $r_office;
		} else {
			$jTableResult['r_office'] = array();
		}
		if ($thana != null) {
			$jTableResult['thana'] = $thana;
		} else {
			$jTableResult['thana'] = array();
		}
		if ($mouza != null) {
			$jTableResult['mouza'] = $mouza;
		} else {
			$jTableResult['mouza'] = array();
		}
		$jTableResult['csrf_token'] = $csrf_token;
		// $jTableResult['sql'] = $id;
		echo json_encode($jTableResult);
	}
	function mortsecurity($cma_id, $id, $add_edit, $mortgage_id = NULL, $edit_id = NULL) {
		$data = array(
			'option' => '',
			'cma_id' => $cma_id,
			'id' => $id,
			'add_edit' => $add_edit,
			'edit_id' => $edit_id,
			'mortgage_id' => $mortgage_id,
			'results' => $this->Auction_model->get_where('cma_facility_mortgage_security', array('id' => $edit_id)),
			'district' => $this->User_model->get_parameter_data('csms_ref_districts', 'name', 'sts = 1'),
			'typedeed' => $this->User_model->get_parameter_data('csms_ref_type_of_deed', 'name', 'sts = 1'),
			'pages' => 'auction/pages/sequerity',
		);
		$this->load->view('auction/form_layout', $data);
	}
	function mort() {
		$this->load->model('Auction_model', '', TRUE);

		$result = $this->Auction_model->get_data('cma_facility_mortgage');

		echo json_encode($result);
	}
	function paper_notice_add($auction_id = NULL) {
		$csrf_token = $this->security->get_csrf_hash();
		$row = '';

		$text = array();
		if ($this->session->userdata['ast_user']['login_status']) {
			$id = $this->Auction_model->add_paper_notice($auction_id);
		} else {
			$text[] = "Session out, login required";
		}

		$Message = '';
		if ($id != '00') {
			if (count($text) <= 0) {
				$Message = 'OK';
				$row = $this->Auction_model->get_add_action_data($id);
			} else {
				for ($i = 0; $i < count($text); $i++) {
					if ($i > 0) {$Message .= ',';}
					$Message .= $text[$i];
				}
				$row[] = '';
			}
		} else { $Message = 'Failed';}
		$var['csrf_token'] = $csrf_token;
		$var['Message'] = $Message;
		$var['row_info'] = $row;
		$var['id'] = $id;
		echo json_encode($var);
	}
	function mortgage_add_edit($add_edit = NULL, $edit_id = NULL) {
		$csrf_token = $this->security->get_csrf_hash();
		$row = '';

		$text = array();
		if ($this->session->userdata['ast_user']['login_status']) {
			$id = $this->Auction_model->mortgage_add_edit($add_edit, $edit_id);
		} else {
			$text[] = "Session out, login required";
		}

		$Message = '';
		if ($id != '00') {
			if (count($text) <= 0) {
				$Message = 'OK';
				$row = $this->Auction_model->get_add_action_data($id);
			} else {
				for ($i = 0; $i < count($text); $i++) {
					if ($i > 0) {$Message .= ',';}
					$Message .= $text[$i];
				}
				$row[] = '';
			}
		} else { $Message = 'Failed';}
		$var['csrf_token'] = $csrf_token;
		$var['Message'] = $Message;
		$var['row_info'] = $row;
		$var['id'] = $id;
		echo json_encode($var);
	}
	function security_add_edit($add_edit = NULL, $edit_id = NULL) {
		$csrf_token = $this->security->get_csrf_hash();
		$row = '';

		$text = array();
		if ($this->session->userdata['ast_user']['login_status']) {
			$id = $this->Auction_model->security_add_edit($add_edit, $edit_id);
		} else {
			$text[] = "Session out, login required";
		}

		$Message = '';
		if ($id != '00') {
			if (count($text) <= 0) {
				$Message = 'OK';
				$row = $this->Auction_model->get_add_action_security_data($id);
			} else {
				for ($i = 0; $i < count($text); $i++) {
					if ($i > 0) {$Message .= ',';}
					$Message .= $text[$i];
				}
				$row[] = '';
			}
		} else { $Message = 'Failed';}
		$var['csrf_token'] = $csrf_token;
		$var['Message'] = $Message;
		$var['row_info'] = $row;
		$var['id'] = $id;
		echo json_encode($var);
	}
	function paper_notice($id = null, $row = null, $cma_id = null) {

		if (isset($_POST['paper'])) {
			$type = $this->input->post('type');
			$token = $this->input->post('token');
			$paper = $this->input->post('paper');
			$where = array('id' => $token);
			$updata = array();
			if ($type == '12_3') {
				$updata = array('paper_notice_12_3' => $paper);
			} elseif ($type == '12_5') {
				$updata = array('paper_notice_12_5' => $paper);
			} elseif ($type == '33_5') {
				$updata = array('paper_notice_33_5' => $paper);
			} elseif ($type == '33_7') {
				$updata = array('paper_notice_33_7' => $paper);
			}
			$this->db->where($where);
			$this->db->update('cma_auction', $updata);
		}

		$paper_notice = $this->input->get('paper_notice');
		$id = $this->input->get('verifyEventId');
		$editrow = $this->input->get('verifyIndexId');
		$cma_id = $this->input->get('verify_cmaId');
		$Q1 = $this->db->query("SELECT project_client_logo FROM project_info WHERE id='1'");
		$proinfo = $Q1->result();
		$row = $this->Auction_model->get_info($id);

		$details = $this->Cma_process_model->get_recommend_info($cma_id);
		$guarantor_info = $this->Auction_model->get_m_guarantor_info($cma_id);
		$guarantor_g = $this->Auction_model->get_g_guarantor_info($cma_id);
		$facility_info = $this->Auction_model->get_facility($cma_id);
		$mortgage_info = $this->Cma_ho_model->get_mortgage($cma_id);
		$security_info = $this->Auction_model->get_security($cma_id);
		if (!empty($facility_info)) {
			$loan_amount = $facility_info[0]->t_amount;
		} else {
			$loan_amount = 0;
		}
		if (!empty($mortgage_info)) {
			$totalshedule = count($mortgage_info);
			$shedulerow = round(count($mortgage_info) / 2);
		} else {
			$totalshedule = 0;
			$shedulerow = 0;
		}
		if (!empty($guarantor_info)) {
			$father_name = $guarantor_info[0]->father_name;
			$present_address = $guarantor_info[0]->present_address;
		} else {
			$father_name = '';
			$present_address = '';
		}

		$papernotice = '';
		if ($paper_notice == '12_3') {
			if ($row->paper_notice_12_3 == '') {
				$borrower_name = $details->brrower_name;
				$loan_ac_name = $details->ac_name;
				$loan_ac_father_name = $father_name;
				$parmanent_address = $present_address;
				$today_date = date("d.m.Y");
				$amount = $loan_amount;
				$kothay_amount = convert_number_bangla($loan_amount);

				$last_install_date = '17.07.2021';

				//$acc_name='&Dagger;gvt BmnvK';
				$reg_date = '23.04.2019';
				$dolilno = '4064/19';
				$dolilno2 = '4065/19';
				$shedule = '';
				if ($shedulerow > 0) {
					for ($i = 0; $i < $shedulerow; $i++) {
						$j = $i * 2;

						$shedule .= '<tr>
						<td>
							<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
								<tbody>
									<tr>
										<td style="text-align: center;">
											<span style="font-family:times new roman,times,serif;"><span style="font-size:12px;"><strong><u>' . $mortgage_info[$j]->mort_schedule_name . '</u></strong></span></span></td>
									</tr>
									<tr>
										<td style="text-align: justify;">
											<span style="font-family:times new roman,times,serif;"><span style="font-size:12px;">' . $mortgage_info[$j]->mort_schedule_desc . '</span></span></td>
									</tr>
								</tbody>
							</table>
						</td>';
						if ($totalshedule < $j) {
							$shedule .= '<td>
							<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
								<tbody>
									<tr>
										<td style="text-align: center;">
											<span style="font-family:times new roman,times,serif;"><span style="font-size:12px;"><strong><u>' . $mortgage_info[$j + 1]->mort_schedule_desc . '</u></strong></span></span></td>
									</tr>
									<tr>
										<td style="text-align: justify;">
											<span style="font-family:times new roman,times,serif;"><span style="font-size:12px;">' . $mortgage_info[$j + 1]->mort_schedule_desc . '</span></span></td>
									</tr>
								</tbody>
							</table>
						</td>';
						}
						$shedule .= '</tr>';
					}
				}

				$dor_date = '16-08-2021';
				$mobile = '01714-084917, 01714-084503';
				$html = '<table border="1" cellpadding="10" cellspacing="0" style="width: 100%">
					<tbody>
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
									<tbody>
										<tr>
											<td style="text-align: center;">
												<span style="font-family:sutonnymj;"><em><span style="font-size:14px;"><strong>e&ordf;&uml;vK e&uml;vsK wjwg&Dagger;UW</strong></span></em></span></td>
										</tr>
									</tbody>
								</table>
								<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
									<tbody>
										<tr>
											<td style="text-align: center;">
												<span style="font-family:sutonnymj;"><em><strong>&Dagger;nW Awdm, AwbK UvIqvi, 220/we, &dagger;ZRMvuI wjsK &dagger;ivW, XvKv-1208</strong></em></span></td>
										</tr>
									</tbody>
								</table>
								<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
									<tbody>
										<tr>
											<td style="text-align: center;">
												<span style="font-family:sutonnymj;"><u>e&Uuml;Kx m&curren;&uacute;w&Euml;i wbjvg we&micro;&Dagger;qi we&Aacute;w&szlig;| A_&copy;FY Av`vjZ AvBb 2003 Gi 12(3) aviv Abymv&Dagger;i</u></span></td>
										</tr>
									</tbody>
								</table>
								<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
									<tbody>
										<tr>
											<td style="text-align: justify;">
												<span style="font-family:sutonnymj;"><span style="font-size:12px;">GZ&Oslash;viv me&copy;mvavib&Dagger;K Rvbv&Dagger;bv hvB&Dagger;Z&Dagger;Q &dagger;h, <span style="font-family:times new roman,times,serif;"><strong>' . $borrower_name . '</strong> represented by its Managing Director ' . $loan_ac_name . ', Son of ' . $loan_ac_father_name . ', Address: ' . $parmanent_address . '</span> Gi wbKU e&ordf;&uml;vK e&uml;vsK wjwg&Dagger;UW Gi <span style="font-family:times new roman,times,serif;">Loan </span>eve` MZ ' . $today_date . ' Bs ZvwiL ch&copy;&scaron;&Iacute; &nbsp;' . $amount . ' (K_vqt ' . $kothay_amount . ' gv&Icirc;) cvIbv iwnqv&Dagger;Q| D&sup3; FY M&Ouml;wnZvi FY cwi&Dagger;kv&Dagger;ai wb&eth;qZv &macr;^i&fnof;c ' . $loan_ac_name . ' I Abb&uml; Zvnv&Dagger;`i wbg&oelig; Zdwmj ewY&copy;Z &macr;&rsquo;vei m&curren;&uacute;w&Euml; &dagger;iwRw&oacute;&ordf;K&hellip;Z weMZ ' . $reg_date . ' Zvwi&Dagger;L e&Uuml;Kx `wjj bs ' . $dolilno . ' Gi gva&uml;&Dagger;g e&ordf;&uml;vK e&uml;vsK wjt, Gi wbKU `vqe&times; ivwLqv&Dagger;Qb Ges GKB Zvwi&Dagger;L m&curren;&uacute;vw`Z I &dagger;iwRw&oacute;&ordf;K&hellip;Z ' . $dolilno2 . ' bs Avg-&Dagger;gv&sup3;vibvgv `wj&Dagger;ji gva&uml;&Dagger;g e&Uuml;Kx m&curren;&uacute;w&Euml; we&micro;&Dagger;qi &para;gZv c&Ouml;`vb Kwiqv&Dagger;Qb| FY eve` cvIbv UvKv D&sup3; FY M&Ouml;nxZv cwi&Dagger;kva Kwi&Dagger;Z e&uml;_&copy; nIqvq e&ordf;&uml;vK e&uml;vsK wjt cvIbv Av`v&Dagger;qi wbwg&Dagger;&Euml; D&sup3; e&Uuml;Kx `wjj I Avg-&Dagger;gv&sup3;vibvgv e&Dagger;j Zdwmj ewY&copy;Z e&Uuml;Kx &macr;&rsquo;vei m&curren;&uacute;w&Euml; wbjv&Dagger;gi gva&uml;&Dagger;g we&micro;&Dagger;qi Rb&uml; wbg&oelig; ewY&copy;Z k&Dagger;Z&copy; mxj&Dagger;gvniK&hellip;Z `ic&Icirc; Avnevb Kwi&Dagger;Z&Dagger;Q|</span></span></td>
										</tr>
										<tr>
											<td style="text-align: center;">
												<span style="font-size:14px;"><span style="font-family:times new roman,times,serif;"><strong><u>Schedule of Mortgage Properties</u></strong></span></span></td>
										</tr>
									</tbody>
								</table>
								<table border="1" cellpadding="5" cellspacing="0" style="width: 100%">
									<tbody>
										' . $shedule . '
									</tbody>
								</table>
								<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
									<tbody>
										<tr>
											<td>
												<span style="font-family:sutonnymj;"><span style="font-size:12px;"><strong><u>wbjv&Dagger;gi kZ&copy;vejxt</u></strong></span></span></td>
										</tr>
										<tr>
											<td style="text-align: justify;">
												<span style="font-family:sutonnymj;"><span style="font-size:12px;">1) c&Ouml;&Dagger;Z&uml;K `ic&Icirc; `i`vZvi wbR&macr;^ c&uml;v&Dagger;W ev mv`v KvM&Dagger;R &macr;&uacute;&oacute; A&yuml;&Dagger;i wbjvg &dagger;&micro;Zvi bvg, wVKvbv, &dagger;Uwj&Dagger;dvb b&curren;^i (hw`&nbsp; _v&Dagger;K) c&Ouml;`&Euml; `i A&yuml;&Dagger;i I K_vq wjwLqv Ges `ic&Icirc; mxj &dagger;gvniK&bdquo;Z Lv&Dagger;g Ges Lv&Dagger;gi Dci &macr;&uacute;&oacute; A&yuml;&Dagger;i m&curren;&uacute;w&Euml; &micro;&Dagger;qi `ic&Icirc; wjwLqv `vwLj Kwi&Dagger;Z nB&Dagger;e| 2) `ic&Icirc; AvMvgx ' . $dor_date . ' Bs ZvwiL &dagger;ejv 3.00 NwUKvi g&Dagger;a&uml; wbg&oelig; ewY&copy;Z wVKvbvq iw&yuml;Z `ic&Icirc; ev&Dagger;&middot; mivmwi ev &dagger;iwRw&oacute;&ordf; WvK&Dagger;hv&Dagger;M Rgv w`&Dagger;Z nB&Dagger;e|3) c&Ouml;&Dagger;Z&uml;K `i`vZv, D&Oslash;&bdquo;Z `i Abya&Yuml;&copy; 10,00,000/-(`k j&yuml;) UvKv nB&Dagger;j Dnvi 20%, D&Oslash;&bdquo;Z `i 10,00,000/-(`k j&yuml;) UvKv A&Dagger;c&yuml;v AwaK nB&Dagger;j Ges Abya&Yuml;&copy; 50,00,000/- (c&Acirc;vk j&yuml;) UvKv nB&Dagger;j Dnvi 15% Ges D&times;&bdquo;Z `i 50,00,000/- (c&Acirc;vk j&yuml;) UvKv A&Dagger;c&yuml;v AwaK nB&Dagger;j Dnvi 10% Gi mgcwigvb UvKvi, RvgvbZ &macr;^iyc, e&uml;vsK W&ordf;vdU ev &dagger;c-AW&copy;vi 2 bs k&Dagger;Z&copy; D&Dagger;j&oslash;wLZ wVKvbvq e&ordf;&uml;vK e&uml;vsK wj: Gi AbyK~&Dagger;j `ic&Dagger;&Icirc;i mwnZ `vwLj Kwi&Dagger;eb|4) Abya&Yuml;&copy; 10,00,000/-(`k j&yuml;) UvKvi D&times;&hellip;Z `i M&bdquo;nxZ nBevi cieZx&copy; &nbsp;30 (w&Icirc;k) w`e&Dagger;mi g&Dagger;a&uml;, 10,00,000/-(`k j&yuml;) UvKv A&Dagger;c&yuml;v AwaK Ges Abya&Yuml;&copy; 50,00,000/- (c&Acirc;vk j&yuml;) UvKvi D&times;&hellip;Z `i M&bdquo;nxZ nBevi cieZx&copy; 60 (lvU) w`e&Dagger;mi g&Dagger;a&uml; Ges 50,00,000/- (c&Acirc;vk j&yuml;) UvKvi AwaK D&times;&hellip;Z `i M&bdquo;nxZ nBevi cieZx&copy; 90 (be&Yuml;B) w`e&Dagger;mi g&Dagger;a&uml;, `i`vZv mgy`q g~j&uml; cwi&Dagger;kva Kwi&Dagger;eb Ges Zvnv Kwi&Dagger;Z e&uml;_&copy; nB&Dagger;j e&uml;vsK Rvgvb&dagger;Zi UvKv ev&Dagger;Rqv&szlig; Kwi&Dagger;eb|5) `ic&Dagger;&Icirc; c&Ouml;`&Euml; g~j&uml; A&macr;^vfvweK Kg/Ach&copy;v&szlig; c&Ouml;wZqgvb nB&Dagger;j Ges Kg RvgvbZ c&Ouml;`vbKvix wKsev &Icirc;&aelig;wUc~Y&copy; `ic&Icirc; mivmwi evwZj ewjqv Mb&uml; nB&Dagger;e|6) Dc&Dagger;i ewY&copy;Z (3) I (4) Gi Aax&Dagger;b c&Ouml;_g m&Dagger;ev&copy;&rdquo;P `i`vZvi RvgvbZ ev&Dagger;Rqv&szlig; nB&Dagger;j e&uml;vsK B&rdquo;Qv Kwi&Dagger;j w&Oslash;Zxq m&Dagger;e&copy;v&rdquo;P `i`vZv&Dagger;K m&curren;&uacute;w&Euml; &micro;&Dagger;q Avn&Yuml;vb Kwi&Dagger;Z cvwi&Dagger;eb|7) wbjv&Dagger;g Ask M&Ouml;nY B&rdquo;QzK e&uml;w&sup3;MY we&macr;&Iacute;vwiZ Z_&uml; Rvwbevi Rb&uml; Ges wbjv&Dagger;g AskM&Ouml;n&Dagger;bi c~&Dagger;e&copy; e&Uuml;Kx m&curren;&uacute;w&Euml; m&curren;&uacute;wK&copy;Z hveZxq `wjjvw` ch&copy;&Dagger;e&yuml;Y Kivi Rb&uml; e&uml;vs&Dagger;Ki D&sup3; wVKvbvq Awdm PjvKvjxb mg&Dagger;q &dagger;hvMv&Dagger;hvM Kwi&Dagger;Z cvwi&Dagger;eb|8) &dagger;Kvb Kvib `k&copy;v&Dagger;bv e&uml;wZ&Dagger;i&Dagger;K n&macr;&Iacute;v&scaron;&Iacute;i `wjj m&curren;&uacute;v`b&nbsp; nIqvi c~e&copy; ch&copy;&scaron;&Iacute; `ic&Icirc; evwZj Kwievi AwaKvi&nbsp; e&ordf;&uml;vK e&uml;vsK wj: msi&yuml;Y K&Dagger;i| Av`vj&Dagger;Zi &dagger;Kvb Av&Dagger;`k A_ev iv&Dagger;qi Kvi&Dagger;b `ic&Icirc; evwZj Kivi &dagger;&yuml;&Dagger;&Icirc; mdj `i`vZv&Dagger;K &iuml;aygv&Icirc; Zvunv&Dagger;`i RgvK&bdquo;Z UvKv &dagger;diZ &dagger;`Iqv nB&Dagger;e| `ic&Icirc; M&bdquo;nxZ nq bvB Ggb `ic&Icirc; `vZv&Dagger;`i&Dagger;K Zvunv&Dagger;`i Rvgvb&Dagger;Zi UvKv h_vkxN&ordf; m&curren;&cent;e (1g I 2q m&Dagger;e&copy;v&rdquo;P `i`vZv e&uml;wZ&Dagger;i&Dagger;K) &dagger;diZ &dagger;`Iqv nB&Dagger;e| 9) `i`vZvMY ev Zvunv&Dagger;`i c&Ouml;wZwbwaMY (hw` Dcw&macr;&rsquo;Z _v&Dagger;Kb) Gi m&curren;&sect;y&Dagger;L AvMvgx ' . $dor_date . ' Bs Zvwi&Dagger;L we&Dagger;Kj 3.00 NwUKvq 2 bs k&Dagger;Z&copy; D&Dagger;j&oslash;wLZ e&ordf;&uml;vK e&uml;vsK wj: Gi Awd&Dagger;m `ic&Icirc; ev&middot; &dagger;Lvjv nB&Dagger;e| 10) mdj `i`vZv&Dagger;K Zdwm&Dagger;j ewY&copy;Z m&curren;&uacute;w&Euml; n&macr;&Iacute;v&scaron;&Iacute;i ms&micro;v&scaron;&Iacute; &dagger;iwR&Dagger;&oacute;&ordf;kb LiP, n&macr;&Iacute;v&scaron;&Iacute;i wd, &oacute;&uml;v&curren;&uacute; wWDwU, Drm Ki(c&Ouml;&Dagger;hvR&uml; &dagger;&yuml;&Dagger;&Icirc;), Ab&uml;vb&uml; LiP, `wjj wbe&Uuml;b ms&micro;v&scaron;&Iacute; hveZxq LiP Ges Dnvi Dci &dagger;Kvb cvIbv ev `vex _vwK&Dagger;j Zvnv enb Kwi&Dagger;Z nB&Dagger;e| &dagger;iwR&Dagger;&oacute;&ordf;kb LiP mn ewY&copy;Z mKj Li&Dagger;Pi wel&Dagger;q &dagger;Kvb Amv`ycvq Aej&curren;^b Kwi&Dagger;j Dnvi D&trade;&cent;zZ `vq-`vwqZ&iexcl; mswk&oslash;&oacute; wbjvg &dagger;&micro;Zv&Dagger;K enb Kwi&Dagger;Z nB&Dagger;e| e&ordf;&uml;vK e&uml;vsK KZ&hellip;&copy;c&yuml; &dagger;Kvbfv&Dagger;e `vqx _vwK&Dagger;e bv| 11) ewY&copy;Z m&curren;&uacute;w&Euml;i Dci &dagger;Kvb miKvix, Avav miKvix, &macr;^vqZ&iexcl;kvwmZ c&Ouml;wZ&ocirc;v&Dagger;bi, wewmK, wmwU K&Dagger;c&copy;v&Dagger;ikb, Iqvmv, wcwWwe, M&uml;vm mieivn c&Ouml;wZ&ocirc;vb Db&oelig;&amp;qb Ki BZ&uml;vw` mn Ab&uml; &Dagger;h &dagger;Kvb cvIbv`v&Dagger;ii cvIbv ev `vex _vwK&Dagger;j Zv cwi&Dagger;kv&Dagger;ai &dagger;Kvb `vq-&Oslash;vwqZ&iexcl; e&ordf;&uml;vK e&uml;vsK wjwg&Dagger;UW Gi Dci eZ&copy;vB&Dagger;e bv| D&sup3; LiP `ic&Icirc; `vZv/&Dagger;&micro;Zv enb Kwi&Dagger;eb| 12) mdj `i`vZv&Dagger;K A_&copy;FY Av`vjZ AvBb-2003 Gi 12(5) aviv &dagger;gvZv&Dagger;eK m&curren;&uacute;w&Euml; `Lj c&Ouml;`v&Dagger;bi wel&Dagger;q mn&Dagger;hvwMZv Kiv nB&Dagger;e|</span></span></td>
										</tr>
										<tr>
											<td>
												<span style="font-family:sutonnymj;"><span style="font-size:12px;"><strong>`ic&Icirc; `vwL&Dagger;ji wVKvbvt</strong>&nbsp; wjM&uml;vj G&Ucirc; wi&Dagger;Kvfvix wWwfkb, &dagger;mcvj c&oslash;vwUbvg UvIqvi, &Dagger;j&Dagger;fj-3, 247-248, exi D&Euml;g gxi kIKZ Avjx moK, &dagger;ZRMvuI wk&iacute; GjvKv, XvKv-1208|&nbsp; &Dagger;dvb bs- ' . $mobile . '|</span></span></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>';
				$mort_data = array('paper_notice_12_3' => $html);
				$this->db->where('id', $id);
				$this->db->update('cma_auction', $mort_data);
			}
			$row = $this->Auction_model->get_info($id);
			$papernotice = $row->paper_notice_12_3;
		}else if ($paper_notice == '12_5') {
			if ($row->paper_notice_12_5 == '') {
				$borrower_name = $details->brrower_name;
				$loan_ac_name = $details->ac_name;
				$loan_ac = $details->loan_ac;
				$mobile_no = $details->mobile_no;
				$loan_ac_father_name = $father_name;
				$parmanent_address = $present_address;
				$today_date = date("d.m.Y");
				$year = date("Y");
				$month = (int)date("m");
				$amount = $loan_amount;
				$kothay_amount = convert_number_bangla($loan_amount);
				$g_name='';$g_address="";
				if(!empty($guarantor_g)){
					$g_name=$guarantor_g[0]->guarantor_name;
					$g_address=$guarantor_g[0]->present_address;
				}
				$month_name_bn = array('Rvbyqvwi','&Dagger;de&ordf;&aelig;qvwi','gvP&copy;','Gwc&Ouml;j','&Dagger;g','Ryb','RyjvB','AvM&divide;','&Dagger;m&Dagger;&THORN;&curren;^i','A&Dagger;&plusmn;vei','b&Dagger;f&curren;^i','wW&Dagger;m&curren;^i');

				//$acc_name='&Dagger;gvt BmnvK';
				$shedule = '';
				if (!empty($mortgage_info)) {
					foreach($mortgage_info as $val){
						$shedule .= '<tr>
							<td style="text-align: center;">
								<div>
									<span style="font-size:12px;"><span style="font-family:times new roman,times,serif;"><strong><u>SCHEDULE-'.$val->mort_schedule_name.'</u></strong></span></span></div>
							</td>
						</tr>
						<tr>
							<td>
								<div style="text-align: justify;">
									<span style="font-size:12px;"><span style="font-family:times new roman,times,serif;">'.$val->mort_schedule_desc.'</span></span></div>
							</td>
						</tr>';
					}
				}

				$html = '<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
					<tbody>
						<tr>
							<td>
								<div>
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">m~~&Icirc; bs t weweGj/&Dagger;nW Awdm/wjM&uml;vj G&Ucirc; wi&Dagger;Kvfvix&nbsp; wWwfkb/'.$month_name_bn[$month].'/'.$year.'-5081</span></span></div>
							</td>
						</tr>
					</tbody>
				</table>
				<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
					<tbody>
						<tr>
							<td style="text-align: center;">
								<div style="text-align: left;">
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">ZvwiL t '.$today_date.' Bs</span></span></div>
							</td>
						</tr>
					</tbody>
				</table>
				<div>
					&nbsp;</div>
				<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
					<tbody>
						<tr>
							<td style="text-align: center;">
								<div style="text-align: left;">
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">gvbbxq,</span></span></div>
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:12px;"><span style="font-family:sutonnymj;">&Dagger;Rjv g&uml;vwR&Dagger;&divide;&ordf;U g&Dagger;nv`q,</span></span></td>
						</tr>
						<tr>
							<td>
								<span style="font-size:12px;"><span style="font-family:sutonnymj;">XvKv &dagger;Rjv, XvKv|</span></span></td>
						</tr>
						<tr>
							<td style="text-align: justify;">
								<span style="font-size:12px;"><span style="font-family:sutonnymj;">welqt A_&copy;FY Av`vjZ AvBb-2003 Gi 12(5) aviv &dagger;gvZv&Dagger;eK e&Uuml;KxK&hellip;Z m&curren;&uacute;w&Euml;i `Lj n&macr;&Iacute;v&scaron;&Iacute;i c&Ouml;m&Dagger;&frac12;| FY wnmv&Dagger;ei bvgt &Dagger;gmvm&copy; Pvqbv G&rsaquo;Uvic&Ouml;vBR, FY wnmve bst '.$loan_ac.'|</span></span></td>
						</tr>
						<tr>
							<td>
								<span style="font-size:12px;"><span style="font-family:sutonnymj;">Rbve,</span></span></td>
						</tr>
						<tr>
							<td style="text-align: justify;">
								<span style="font-size:12px;"><span style="font-family:sutonnymj;">mwebq webxZ wb&Dagger;e`b GB &dagger;h, e&ordf;vK e&uml;vsK wjt AwbK UvIqvi, 220/we, &dagger;ZRMvuI wjsK &dagger;ivW, &dagger;ZRMvuI wk&iacute; GjvKv, XvKv-1208, Dnv evsjv&Dagger;`k e&uml;vs&Dagger;Ki Zdwmjfy&sup3; GKwU evwbwR&uml;K e&uml;vsK| GB e&uml;vsK &dagger;_&Dagger;K Rbve <span style="font-family:times new roman,times,serif;font-size:12px;">'.$borrower_name.'</span>, &Dagger;c&Ouml;vc&Ouml;vBUit <span style="font-family:times new roman,times,serif;font-size:12px;">'.$loan_ac_name.'</span>, wVKvbv-<span style="font-family:times new roman,times,serif;font-size:12px;">'.$parmanent_address.'</span>| Zuvnvi wb&curren;&oelig; Zdwmjfy&sup3; m&curren;&uacute;w&Euml; e&Uuml;K c&Ouml;`vb c~e&copy;K FY M&Ouml;nY K&Dagger;ib| wK&scaron;&lsquo; cwiZv&Dagger;ci welq GB &dagger;h, M&bdquo;nxZ F&Dagger;Yi UvKv &dagger;diZ bv &dagger;`Iqvi Kvi&Dagger;Y e&uml;vs&Dagger;Ki wbKU P~ov&scaron;&Iacute; FY &dagger;Ljvwc wn&Dagger;m&Dagger;e wPw&yacute;Z n&Dagger;q&Dagger;Qb| Ae&Dagger;k&Dagger;l e&ordf;&uml;vK e&uml;vsK A_&copy;FY Av`vjZ AvBb-2003 Gi 12(3) aviv &dagger;gvZv&Dagger;eK e&Uuml;KxK&hellip;Z m&curren;&uacute;w&Euml; wbjv&Dagger;gi gva&uml;&Dagger;g we&micro;q Kwiqv c&Ouml;`&Euml; F&Dagger;Yi UvKv mg&scaron;^q Kivi D&Dagger;`&uml;vM M&ordf;nY Kwi&Dagger;Z&Dagger;Q| GgZve&macr;&rsquo;vq eZ&copy;gv&Dagger;b e&Uuml;Kx m&curren;&uacute;w&Euml; cwi`k&copy;Y, &dagger;fvM-`Lj Kwi&Dagger;Z &dagger;M&Dagger;j c&Ouml;wZc&Dagger;&para;i &Oslash;viv kvw&scaron;Z f&Dagger;&frac12;i KviY D&trade;&cent;e nIqvi AvksKv _vKvq c&Ouml;kvmwbK mnvqZv cvIqvi Rb&uml; we&Dagger;klfv&Dagger;e Aby&Dagger;iva KiwQ|</span></span></td>
						</tr>
						<tr>
							<td style="text-align: center;">
								<div>
									<span style="font-family:times new roman,times,serif;"><span style="font-size:12px;"><strong><u>SCHEDULE OF THE PROPERTIES</u></strong></span></span></div>
							</td>
						</tr>
						'.$shedule.'
						<tr>
							<td style="text-align: justify;">
								<span style="font-size:12px;"><span style="font-family:sutonnymj;">AZGe, webxZ c&Ouml;v_&copy;bv GB &dagger;h, e&uml;vs&Dagger;Ki wbKU e&Uuml;KK&hellip;Z m&curren;&uacute;w&Euml; A_&copy;FY Av`vjZ AvBb 2003 Gi 12(5) aviv &dagger;gvZv&Dagger;eK e&uml;vsK &dagger;K `Lj eySvBqv &dagger;`Iqvi c&Ouml;&Dagger;qvRbxq e&uml;e&macr;&rsquo;v M&Ouml;nY Kwi&Dagger;Z &dagger;hb g&Dagger;nv`&Dagger;qi Av&Aacute;v nq|</span></span></td>
						</tr>
						<tr>
							<td>
								<div>
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">webxZ wb&Dagger;e`K,</span></span></div>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">e&ordf;&uml;vK e&uml;vsK wjwg&Dagger;UW Gi c&Dagger;&para;,</span></span></div>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp;</td>
						</tr>
						<tr>
							<td>
								_______________________</td>
						</tr>
						<tr>
							<td>
								<div>
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">gyn.IqvjxDj AvIqvj Lvb</span></span></div>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">Gg.we.G (Xv.we.), Gj. Gj.we</span></span></div>
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:12px;"><span style="font-family:sutonnymj;">&Dagger;nW Ae G&uml;v&Dagger;mU wjKzBwWkb BDwbU</span></span></td>
						</tr>
						<tr>
							<td>
								<div>
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">wjM&uml;vj G&Ucirc; wi&Dagger;Kvfvix wWwfkb</span></span></div>
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-size:12px;"><span style="font-family:sutonnymj;">e&ordf;&uml;vK e&uml;vsK wjt, c&Ouml;avb Kvh&copy;vjq, XvKv |</span></span></td>
						</tr>
						<tr>
							<td>
								<div>
									&nbsp;</div>
							</td>
						</tr>
						<tr>
							<td>
								<strong><span style="font-size:12px;"><span style="font-family:sutonnymj;"><u>mshyw&sup3;t </u></span></span></strong></td>
						</tr>
						<tr>
							<td>
								<span style="font-size:12px;"><span style="font-family:sutonnymj;">1) FY g&Auml;yix/Aby&Dagger;gv`b c&Dagger;&Icirc;i Kwc| </span></span></td>
						</tr>
						<tr>
							<td>
								<div>
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">2) &Dagger;iwRw&oacute;&ordf;K&hellip;Z e&Uuml;Kx `wjj Ges Avg-&Dagger;gv&sup3;vibvgv Gi Kwc|</span></span></div>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<strong><span style="font-size:12px;"><span style="font-family:sutonnymj;"><u>Abywjwct</u></span></span></strong></div>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">1) cywjk mycvi g&Dagger;nv`q- XvKv|</span></span></div>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">2) fvic&Ouml;v&szlig; Kg&copy;KZ&copy;v- &Dagger;KivYxM&Auml; _vbv|</span></span></div>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">3) fvic&Ouml;v&szlig; Kg&copy;KZ&copy;v- mvfvi _vbv|</span></span></div>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">4) Rbve <span style="font-family:times new roman,times,serif;font-size:12px;">'.$borrower_name.'</span>, &Dagger;c&Ouml;vc&Ouml;vBUit <span style="font-family:times new roman,times,serif;font-size:12px;">'.$loan_ac_name.'</span>, wVKvbv-<span style="font-family:times new roman,times,serif;font-size:12px;">'.$parmanent_address.'</span>|</span></span></div>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<span style="font-size:12px;"><span style="font-family:sutonnymj;">5) F&Dagger;Yi Rvwgb`vit Rbve <span style="font-family:times new roman,times,serif;font-size:12px;">'.$g_name.'</span>, wVKvbv- <span style="font-family:times new roman,times,serif;font-size:12px;">'.$g_address.'</span>|</span></span></div>
							</td>
						</tr>
					</tbody>
				</table>';
				$mort_data = array('paper_notice_12_5' => $html);
				$this->db->where('id', $id);
				$this->db->update('cma_auction', $mort_data);
			}
			$row = $this->Auction_model->get_info($id);
			$papernotice = $row->paper_notice_12_5;
		} elseif ($paper_notice == '33_5') {
			if ($row->paper_notice_33_5 == '') {
				$borrower_name = $details->brrower_name;
				$loan_ac_name = $details->ac_name;
				$loan_ac_father_name = $father_name;
				$parmanent_address = $present_address;
				$today_date = date("d.m.Y");
				$amount = $loan_amount;
				$kothay_amount = convert_number_bangla($loan_amount);
				$auction_no = '22/2018';
				$reg_date = '05-12-2012';
				$dolil_no = '19782';
				$reg_no = '19783';
				$dor_date = '16-08-2021';
				$mobile = '01714-084917, 01714-084503';
				$total_land = 'Total Land 07.00+22.00 = 29.00 decimal land as owned by Mst. Afroza Parvin (Mala).';

				$cleint_name = 'Mr. ' . $loan_ac_name . ', Son of Late ' . $loan_ac_father_name . ', Proprietor-&nbsp; ' . $parmanent_address;
				$amount = $auction_no . ' bs A_&copy;Rvix gvgjvi <strike>' . $amount . '</strike> (K_vqt ' . $kothay_amount . ' gv&Icirc;)';
				$mortgage = '';
				$a = 'a';
				if (!empty($mortgage_info)) {
					foreach ($mortgage_info as $key => $val) {
						$mortgage .= '<tr>
								<td>
									<div style="margin-left: 40px;">
										<span style="font-size:11px;"><span style="font-family:times new roman,times,serif;">' . $a . ')&nbsp; ' . $val->mort_schedule_desc . '</span></span></div>
								</td>
							</tr>';
						$a++;
					}}
				$mortgage .= '<tr>
								<td>
									<div style="margin-left: 40px;">
										<span style="font-size:11px;"><span style="font-family:times new roman,times,serif;"><strong><span style="font-size:9px;"><span style="font-family:times new roman,times,serif;"><strong>' . $total_land . '</strong></span></span></strong></span></span></div>
								</td>
							</tr>';

				$html = '<div>
						<div>
							<table border="1" cellpadding="10" cellspacing="0" style="width: 100%">
								<tbody>
									<tr>
										<td>
											<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
												<tbody>
													<tr>
														<td style="text-align: center;">
															<span style="font-size:18px;"><span style="font-family:sutonnymj;"><strong>e&ordf;&uml;vK e&uml;vsK wjwg&Dagger;UW</strong></span></span></td>
													</tr>
													<tr>
														<td style="text-align: center;">
															<span style="font-size:13px;"><span style="font-family:sutonnymj;"><strong><strong>&Dagger;nW Awdm, AwbK UvIqvi,220/we, &dagger;ZRMvuI wjsK &dagger;ivW, XvKv-1208</strong></strong></span></span></td>
													</tr>
													<tr>
														<td style="text-align: center;">
															<span style="font-size:15px;"><span style="font-family:sutonnymj;"><strong><strong><strike><u>hyM&yen; &dagger;Rjv RR I A_&copy;FY 1g Av`vjZ, iscyi</u></strike><u> KZ&copy;&bdquo;K c&Ouml;`&Euml; A_&copy;FY Av`vjZ AvBb 2003 Gi 33(5) Dcavivi mvwU&copy;wd&Dagger;KU g~&Dagger;j e&Uuml;Kx m&curren;&uacute;w&Euml;i wbjvg we&micro;&Dagger;qi we&Aacute;w&szlig;|</u></strong></strong></span></span></td>
													</tr>
													<tr>
														<td style="text-align: justify;">
															<span style="font-size:11px;"><span style="font-family:sutonnymj;">GZ&Oslash;viv me&copy;mvavib&Dagger;K Rvbv&Dagger;bv hvB&Dagger;Z&Dagger;Q &dagger;h, <span style="font-family:times new roman,times,serif;">' . $cleint_name . '</span>. Gi wbKU e&ordf;&uml;vK e&uml;vsK wjwg&Dagger;UW Gi &nbsp;F&Dagger;Yi e&Dagger;Kqv eve` ' . $amount . ' UvKv Zrmn my` I LiPvi Acwi&Dagger;kvaxZ `vex Av`v&Dagger;qi wbwg&Dagger;&Euml; wbg&oelig; Zdwmj ewY&copy;Z e&Uuml;Kx &macr;&rsquo;vei m&curren;&uacute;w&Euml; &nbsp;wbjv&Dagger;gi gva&uml;&Dagger;g we&micro;&Dagger;qi Rb&uml; wbg&oelig; ewY&copy;Z k&Dagger;Z&copy; mxj&Dagger;gvniK&hellip;Z `ic&Icirc; Avnevb Kwi&Dagger;Z&Dagger;Q| Zdwmj ewY&copy;Z m&curren;&uacute;w&Euml; weMZ ' . $reg_date . ' Zvwi&Dagger;L &Dagger;iwRw&oacute;&ordf;K&hellip;Z e&Uuml;Kx `wjj bs ' . $dolil_no . ' Gi gva&uml;&Dagger;g e&ordf;&uml;vK e&uml;vsK wjt, Gi wbKU `vqe&times; ivLv nq Ges GKB Zvwi&Dagger;L m&curren;&uacute;vw`Z I &dagger;iwRw&oacute;&ordf;K&hellip;Z ' . $reg_no . ' bs Avg-&Dagger;gv&sup3;vibvgv `wj&Dagger;ji gva&uml;&Dagger;g e&Uuml;Kx m&curren;&uacute;w&Euml; we&micro;&Dagger;qi &para;gZv c&Ouml;`vb &nbsp;Kiv nq|</span></span></td>
													</tr>
													<tr>
														<td style="text-align: center;">
															<span style="font-size:11px;"><span style="font-family:times new roman,times,serif;"><strong><u>SCHEDULE OF THE MORTGAGED PROPERTEY</u></strong></span></span></td>
													</tr>
													' . $mortgage . '
													<tr>
														<td>
															<span style="font-size:13px;"><span style="font-family:sutonnymj;"><strong><strong><u>wbjv&Dagger;gi kZ&copy;vejxt</u></strong></strong></span></span></td>
													</tr>
													<tr>
														<td style="text-align: justify;">
															<span style="font-size:11px;"><span style="font-family:sutonnymj;">1) c&Ouml;&Dagger;Z&uml;K `ic&Icirc; `i`vZvi wbR&macr;^ c&uml;v&Dagger;W ev mv`v KvM&Dagger;R &macr;&uacute;&oacute; A&yuml;&Dagger;i wbjvg &dagger;&micro;Zvi bvg, wVKvbv, &dagger;Uwj&Dagger;dvb b&curren;^i (hw`&nbsp; _v&Dagger;K) c&Ouml;`&Euml; `i A&yuml;&Dagger;i I K_vq wjwLqv Ges `ic&Icirc; mxj &dagger;gvniK&bdquo;Z Lv&Dagger;g Ges Lv&Dagger;gi Dci &macr;&uacute;&oacute; A&yuml;&Dagger;i m&curren;&uacute;w&Euml; &micro;&Dagger;qi `ic&Icirc; wjwLqv `vwLj Kwi&Dagger;Z nB&Dagger;e| 2) `ic&Icirc; AvMvgx&nbsp; ' . $dor_date . ' Bs ZvwiL &dagger;ejv 3.00 NwUKvi g&Dagger;a&uml; wbg&oelig; ewY&copy;Z wVKvbvq iw&yuml;Z `ic&Icirc; ev&Dagger;&middot; mivmwi ev &dagger;iwRw&oacute;&ordf; WvK&Dagger;hv&Dagger;M Rgv w`&Dagger;Z nB&Dagger;e|3) c&Ouml;&Dagger;Z&uml;K `i`vZv, D&Oslash;&bdquo;Z `i Abya&Yuml;&copy; 10,00,000/-(`k j&yuml;) UvKv nB&Dagger;j Dnvi 20%, D&Oslash;&bdquo;Z `i 10,00,000/-(`k j&yuml;) UvKv A&Dagger;c&yuml;v AwaK nB&Dagger;j Ges Abya&Yuml;&copy; 50,00,000/- (c&Acirc;vk j&yuml;) UvKv nB&Dagger;j Dnvi 15% Ges D&times;&bdquo;Z `i 50,00,000/- (c&Acirc;vk j&yuml;) UvKv A&Dagger;c&yuml;v AwaK nB&Dagger;j Dnvi 10% Gi mgcwigvb UvKvi, RvgvbZ &macr;^iyc, e&uml;vsK W&ordf;vdU ev &dagger;c-AW&copy;vi 2 bs k&Dagger;Z&copy; D&Dagger;j&oslash;wLZ wVKvbvq e&ordf;&uml;vK e&uml;vsK wj: Gi AbyK~&Dagger;j `ic&Dagger;&Icirc;i mwnZ `vwLj Kwi&Dagger;eb| 4) Abya&Yuml;&copy; 10,00,000/-(`k j&yuml;) UvKvi D&times;&hellip;Z `i M&bdquo;nxZ nBevi cieZx&copy; 30 (w&Icirc;k) w`e&Dagger;mi g&Dagger;a&uml;, 10,00,000/-(`k j&yuml;) UvKv A&Dagger;c&yuml;v AwaK Ges Abya&Yuml;&copy; 50,00,000/- (c&Acirc;vk j&yuml;) UvKvi D&times;&hellip;Z `i M&bdquo;nxZ nBevi cieZx&copy; 60 (lvU) w`e&Dagger;mi g&Dagger;a&uml; Ges 50,00,000/- (c&Acirc;vk j&yuml;) UvKvi AwaK D&times;&hellip;Z `i M&bdquo;nxZ nBevi cieZx&copy; 90 (be&Yuml;B) w`e&Dagger;mi g&Dagger;a&uml;, `i`vZv mgy`q g~j&uml; cwi&Dagger;kva Kwi&Dagger;eb Ges Zvnv Kwi&Dagger;Z e&uml;_&copy; nB&Dagger;j e&uml;vsK Rvgvb&dagger;Zi UvKv ev&Dagger;Rqv&szlig; Kwi&Dagger;eb|5) `ic&Dagger;&Icirc; c&Ouml;`&Euml; g~j&uml; A&macr;^vfvweK Kg/Ach&copy;v&szlig; c&Ouml;wZqgvb nB&Dagger;j Ges Kg RvgvbZ c&Ouml;`vbKvix wKsev &Icirc;&aelig;wUc~Y&copy; `ic&Icirc; mivmwi evwZj ewjqv Mb&uml; nB&Dagger;e|6) Dc&Dagger;i ewY&copy;Z (3) I (4) Gi Aax&Dagger;b c&Ouml;_g m&Dagger;ev&copy;&rdquo;P `i`vZvi RvgvbZ ev&Dagger;Rqv&szlig; nB&Dagger;j e&uml;vsK B&rdquo;Qv Kwi&Dagger;j w&Oslash;Zxq m&Dagger;e&copy;v&rdquo;P `i`vZv&Dagger;K m&curren;&uacute;w&Euml; &micro;&Dagger;q Avn&Yuml;vb Kwi&Dagger;Z cvwi&Dagger;eb|7) wbjv&Dagger;g Ask M&Ouml;nY B&rdquo;QzK e&uml;w&sup3;MY we&macr;&Iacute;vwiZ Z_&uml; Rvwbevi Rb&uml; Ges wbjv&Dagger;g AskM&Ouml;n&Dagger;bi c~&Dagger;e&copy; e&Uuml;Kx m&curren;&uacute;w&Euml; m&curren;&uacute;wK&copy;Z hveZxq `wjjvw` ch&copy;&Dagger;e&yuml;Y Kivi Rb&uml; e&uml;vs&Dagger;Ki D&sup3; wVKvbvq Awdm PjvKvjxb mg&Dagger;q &dagger;hvMv&Dagger;hvM Kwi&Dagger;Z cvwi&Dagger;eb|8) &dagger;Kvb Kvib `k&copy;v&Dagger;bv e&uml;wZ&Dagger;i&Dagger;K n&macr;&Iacute;v&scaron;&Iacute;i `wjj m&curren;&uacute;v`b&nbsp; nIqvi c~e&copy; ch&copy;&scaron;&Iacute; `ic&Icirc; evwZj Kwievi AwaKvi&nbsp; e&ordf;&uml;vK e&uml;vsK wj: msi&yuml;Y K&Dagger;i| Av`vj&Dagger;Zi &dagger;Kvb Av&Dagger;`k A_ev iv&Dagger;qi Kvi&Dagger;b `ic&Icirc; evwZj Kivi &dagger;&yuml;&Dagger;&Icirc; mdj `i`vZv&Dagger;K &iuml;aygv&Icirc; Zvunv&Dagger;`i RgvK&bdquo;Z UvKv &dagger;diZ &dagger;`Iqv nB&Dagger;e| `ic&Icirc; M&bdquo;nxZ nq bvB Ggb `ic&Icirc; `vZv&Dagger;`i&Dagger;K Zvunv&Dagger;`i Rvgvb&Dagger;Zi UvKv h_vkxN&ordf; m&curren;&cent;e (1g I 2q m&Dagger;e&copy;v&rdquo;P `i`vZv e&uml;wZ&Dagger;i&Dagger;K) &dagger;diZ &dagger;`Iqv nB&Dagger;e| 9) `i`vZvMY ev Zvunv&Dagger;`i c&Ouml;wZwbwaMY (hw` Dcw&macr;&rsquo;Z _v&Dagger;Kb) Gi m&curren;&sect;y&Dagger;L AvMvgx&nbsp; ' . $dor_date . ' Bs Zvwi&Dagger;L we&Dagger;Kj 3.00 NwUKvq 2 bs k&Dagger;Z&copy; D&Dagger;j&oslash;wLZ e&ordf;&uml;vK e&uml;vsK wj: Gi Awd&Dagger;m `ic&Icirc; ev&middot; &dagger;Lvjv nB&Dagger;e| 10) mdj `i`vZv&Dagger;K Zdwm&Dagger;j ewY&copy;Z m&curren;&uacute;w&Euml; n&macr;&Iacute;v&scaron;&Iacute;i ms&micro;v&scaron;&Iacute; &dagger;iwR&Dagger;&oacute;&ordf;kb LiP, n&macr;&Iacute;v&scaron;&Iacute;i wd, &oacute;&uml;v&curren;&uacute; wWDwU, Drm Ki(c&Ouml;&Dagger;hvR&uml; &dagger;&yuml;&Dagger;&Icirc;), Ab&uml;vb&uml; LiP, `wjj wbe&Uuml;b ms&micro;v&scaron;&Iacute; hveZxq LiP Ges Dnvi Dci &dagger;Kvb cvIbv ev `vex _vwK&Dagger;j Zvnv enb Kwi&Dagger;Z nB&Dagger;e| &dagger;iwR&Dagger;&oacute;&ordf;kb LiP mn ewY&copy;Z mKj Li&Dagger;Pi wel&Dagger;q &dagger;Kvb Amv`ycvq Aej&curren;^b Kwi&Dagger;j Dnvi D&trade;&cent;zZ `vq-`vwqZ&iexcl; mswk&oslash;&oacute; wbjvg &dagger;&micro;Zv&Dagger;K enb Kwi&Dagger;Z nB&Dagger;e| e&ordf;&uml;vK e&uml;vsK KZ&hellip;&copy;c&yuml; &dagger;Kvbfv&Dagger;e `vqx _vwK&Dagger;e bv| 11) ewY&copy;Z m&curren;&uacute;w&Euml;i Dci &dagger;Kvb miKvix, Avav miKvix, &macr;^vqZ&iexcl;kvwmZ c&Ouml;wZ&ocirc;v&Dagger;bi, wewmK, wmwU K&Dagger;c&copy;v&Dagger;ikb, Iqvmv, wcwWwe, M&uml;vm mieivn c&Ouml;wZ&ocirc;vb Db&oelig;&amp;qb Ki BZ&uml;vw` mn Ab&uml; &Dagger;h &dagger;Kvb cvIbv`v&Dagger;ii cvIbv ev `vex _vwK&Dagger;j Zv cwi&Dagger;kv&Dagger;ai &dagger;Kvb `vq-&Oslash;vwqZ&iexcl; e&ordf;&uml;vK e&uml;vsK wjwg&Dagger;UW Gi Dci eZ&copy;vB&Dagger;e bv| D&sup3; LiP `ic&Icirc; `vZv/&Dagger;&micro;Zv enb Kwi&Dagger;eb| 12) mdj `i`vZv&Dagger;K A_&copy;FY Av`vjZ AvBb-2003 Gi 12(5) aviv &dagger;gvZv&Dagger;eK m&curren;&uacute;w&Euml; `Lj c&Ouml;`v&Dagger;bi wel&Dagger;q mn&Dagger;hvwMZv Kiv nB&Dagger;e|</span></span></td>
													</tr>
													<tr>
														<td>
															<span style="font-size:11px;"><span style="font-family:sutonnymj;"><strong>`ic&Icirc; `vwL&Dagger;ji wVKvbvt&nbsp; </strong>wjM&uml;vj G&Ucirc; wi&Dagger;Kvfvix wWwfkb, &Dagger;mcvj c&oslash;vwUbvg UvIqvi, &Dagger;j&Dagger;fj-4, 247-248, exi D&Euml;g gxi kIKZ Avjx moK, &dagger;ZRMvuI wk&iacute; GjvKv, XvKv-1208| &Dagger;dvb bs- ' . $mobile . '|</span></span></td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>';
				$mort_data = array('paper_notice_33_5' => $html);
				$this->db->where('id', $id);
				$this->db->update('cma_auction', $mort_data);
			}
			$row = $this->Auction_model->get_info($id);
			$papernotice = $row->paper_notice_33_5;
		} elseif ($paper_notice == '33_7') {
			if ($row->paper_notice_33_7 == '') {

				$adalot = '&Dagger;Rjv RR c&Ouml;_g Av`vjZ Ges A_&copy;FY Av`vjZ, bxjdvgvix';
				$mokadomano = '05/2011';
				$district_name = 'bxjdvgvix';
				$moja_name = "nv&Dagger;ovqv";
				$jlno = '35 (cyivZb), 43 (bZzb)';
				$description = '';
				if (!empty($security_info)) {
					foreach ($security_info as $key => $val) {
						$description .= '<tr>
								<td>
									<span style="font-family:sutonnymj;">Gm. G.-' . $val->sa_khat . '</span></td>
								<td>
									<span style="font-family:sutonnymj;">' . $val->sa_dag . '</span></td>';
						if ($key == 0) {
							$description .= '<td colspan="1" rowspan="4" style="text-align: center;">
									<span style="font-family:sutonnymj;"><strong>&Dagger;gvU Rwgi cwigvb = 0.82 GKi|</strong></span></td>';
						}
						$description .= '</tr>
							<tr>
								<td>
									<span style="font-family:sutonnymj;">LvwiR-1108</span></td>
								<td>
									<span style="font-family:sutonnymj;">3067</span></td>
							</tr>
							<tr>
								<td>
									<span style="font-family:sutonnymj;">nvj-1511, 1438</span></td>
								<td>
									<span style="font-family:sutonnymj;">3063</span></td>
							</tr>
							<tr>
								<td>
									<span style="font-family:sutonnymj;">bvgRvix-' . $val->namjari . '</span></td>
								<td>
									<span style="font-family:sutonnymj;">' . $val->namjari . '</span></td>
							</tr>';
					}
				}
				$dor_date = '05-04-2021';
				$mobile = '01714084503';
				$logo = base_url('setting/assets/images/' . $proinfo[0]->project_client_logo);
				$html = '<table border="1" cellpadding="10" cellspacing="0" style="width: 100%">
					<tbody>
						<tr>
							<td>
								<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
									<tbody>
										<tr>
											<td>
												<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
													<tbody>
														<tr>
															<td rowspan="2" style="width: 30%;">
																<img alt="bbl_logo" src="' . $logo . '" height="30" width="100"/></td>
															<td>
																<span style="font-size:16px;"><span style="font-family:sutonnymj;"><strong>e&ordf;&uml;vK e&uml;vsK wjwg&Dagger;U&Dagger;Wi gvwjKvbvaxb</strong></span></span></td>
														</tr>
														<tr>
															<td>
																<span style="font-size:12px;"><span style="font-family:sutonnymj;"><strong>&macr;&rsquo;vei m&curren;&uacute;w&Euml;i wbjvg we&micro;q we&Aacute;w&szlig;</strong></span></span></td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td style="text-align: justify;">
												<span style="font-size:10px;"><span style="font-family:sutonnymj;">GZ&Oslash;viv me&copy;mvavib&Dagger;K Rvbv&Dagger;bv hvB&Dagger;Z&Dagger;Q &Dagger;h, we&Aacute; hyM&yen; ' . $adalot . ', KZ&hellip;&copy;K A_&copy;Rvix &Dagger;gvK&Iuml;gv bs- ' . $mokadomano . ' G c&Ouml;`&Euml; 33(7) avivi gvwjKvbv mvwU&copy;wd&Dagger;KU &Dagger;gvZv&Dagger;eK, <strong>e&ordf;&uml;vK e&uml;vs&Dagger;Ki bv&Dagger;g m&curren;&uacute;vw`Z I &Dagger;iwRw&oacute;&ordf;K&hellip;Z `wjj g~&Dagger;j gvwjKvbvi wfw&Euml;&Dagger;Z </strong>wb&curren;&oelig; Zdwmj ewY&copy;Z &macr;&rsquo;vei m&curren;&uacute;w&Euml; e&ordf;&uml;vK e&uml;vsK wjwg&Dagger;U&Dagger;Wi <strong>&Ograve;&Dagger;evW&copy; Ae wW&Dagger;i&plusmn;im&Oacute;</strong> Gi Aby&Dagger;gv`b &macr;^v&Dagger;c&Dagger;&yuml; wbjv&Dagger;gi gva&uml;&Dagger;g we&micro;&Dagger;qi Rb&uml; AvM&Ouml;nx wbjvg &dagger;&micro;ZvM&Dagger;Yi wbKU n&Dagger;Z wbg&oelig; ewY&copy;Z k&Dagger;Z&copy; mxj&Dagger;gvniK&hellip;Z `ic&Icirc; Avnevb Kiv hvB&Dagger;Z&Dagger;Q|</span></span></td>
										</tr>
										<tr>
											<td style="text-align: center;">
												<span style="font-size:12px;"><span style="font-family:sutonnymj;"><strong><u>m&curren;&uacute;w&Euml;i Zdmxj weeiY</u></strong></span></span></td>
										</tr>
										<tr>
											<td>
												<span style="font-size:10px;"><span style="font-family:sutonnymj;">&Dagger;Rjv I _vbvt ' . $district_name . ', &Dagger;g&Scaron;Rvt ' . $moja_name . ', &Dagger;R. Gj bs- ' . $jlno . '</span></span></td>
										</tr>
										<tr>
											<td><table border="1" cellpadding="1" cellspacing="0" style="width: 100%">
													<tbody>
														<tr>
															<td>
																<div style="text-align: center;">
																	<span style="font-size:10px;"><span style="font-family:sutonnymj;"><strong>LwZqvb bs</strong></span></span></div>
															</td>
															<td style="text-align: center;">
																<span style="font-size:10px;"><span style="font-family:sutonnymj;"><strong>`vM bs/&Dagger;nvw&igrave;s bs</strong></span></span></td>
															<td style="text-align: center;">
																<span style="font-size:10px;"><span style="font-family:sutonnymj;"><strong>Rwgi cwigvb</strong></span></span></td>
														</tr>
												' . $description . '
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td>
												<span style="font-size:11px;"><span style="font-family:sutonnymj;"><strong><u>wbjv&Dagger;gi kZ&copy;vejxt</u></strong></span></span></td>
										</tr>
										<tr>
											<td style="text-align: justify;">
												<span style="font-size:10px;"><span style="font-family:sutonnymj;">1) c&Ouml;&Dagger;Z&uml;K `ic&Icirc; `i`vZvi wbR&macr;^ c&uml;v&Dagger;W ev mv`v KvM&Dagger;R &macr;&uacute;&oacute; A&yuml;&Dagger;i wbjvg &dagger;&micro;Zvi bvg, wVKvbv, &dagger;Uwj&Dagger;dvb b&curren;^i (hw`&nbsp; _v&Dagger;K) c&Ouml;`&Euml; `i A&yuml;&Dagger;i I K_vq wjwLqv Ges `ic&Icirc; mxj &dagger;gvniK&bdquo;Z Lv&Dagger;g Ges Lv&Dagger;gi Dci &macr;&uacute;&oacute; A&yuml;&Dagger;i m&curren;&uacute;w&Euml; &micro;&Dagger;qi `ic&Icirc; wjwLqv `vwLj Kwi&Dagger;Z nB&Dagger;e| 2) `ic&Icirc; AvMvgx ' . $dor_date . ' Bs ZvwiL &dagger;ejv 3.00 NwUKvi g&Dagger;a&uml; wbg&oelig; ewY&copy;Z wVKvbvq iw&yuml;Z `ic&Icirc; ev&Dagger;&middot; mivmwi ev &dagger;iwRw&oacute;&ordf; WvK&Dagger;hv&Dagger;M Rgv w`&Dagger;Z nB&Dagger;e| 3) c&Ouml;&Dagger;Z&uml;K `i`vZv, D&Oslash;&bdquo;Z `i Abya&Yuml;&copy; 10,00,000/-(`k j&yuml;) UvKv nB&Dagger;j Dnvi 20%, D&Oslash;&bdquo;Z `i 10,00,000/-(`k j&yuml;) UvKv A&Dagger;c&yuml;v AwaK nB&Dagger;j Ges Abya&Yuml;&copy; 50,00,000/- (c&Acirc;vk j&yuml;) UvKv nB&Dagger;j Dnvi 15% Ges D&times;&bdquo;Z `i 50,00,000/- (c&Acirc;vk j&yuml;) UvKv A&Dagger;c&yuml;v AwaK nB&Dagger;j Dnvi 10% Gi mgcwigvb UvKvi, RvgvbZ &macr;^iyc, e&uml;vsK W&ordf;vdU ev &dagger;c-AW&copy;vi 2 bs k&Dagger;Z&copy; D&Dagger;j&oslash;wLZ wVKvbvq e&ordf;&uml;vK e&uml;vsK wj: Gi AbyK~&Dagger;j `ic&Dagger;&Icirc;i mwnZ `vwLj Kwi&Dagger;eb| 4) Abya&Yuml;&copy; 10,00,000/-(`k j&yuml;) UvKvi D&times;&hellip;Z `i M&bdquo;nxZ nBevi cieZx&copy; 30 (w&Icirc;k) w`e&Dagger;mi g&Dagger;a&uml;, 10,00,000/-(`k j&yuml;) UvKv A&Dagger;c&yuml;v AwaK Ges Abya&Yuml;&copy; 50,00,000/- (c&Acirc;vk j&yuml;) UvKvi D&times;&hellip;Z `i M&bdquo;nxZ nBevi cieZx&copy; 60 (lvU) w`e&Dagger;mi g&Dagger;a&uml; Ges 50,00,000/- (c&Acirc;vk j&yuml;) UvKvi AwaK D&times;&hellip;Z `i M&bdquo;nxZ nBevi cieZx&copy; 90 (be&Yuml;B) w`e&Dagger;mi g&Dagger;a&uml;, `i`vZv mgy`q g~j&uml; cwi&Dagger;kva Kwi&Dagger;eb Ges Zvnv Kwi&Dagger;Z e&uml;_&copy; nB&Dagger;j e&uml;vsK Rvgvb&dagger;Zi UvKv ev&Dagger;Rqv&szlig; Kwi&Dagger;eb| 5) `ic&Dagger;&Icirc; c&Ouml;`&Euml; g~j&uml; A&macr;^vfvweK Kg/Ach&copy;v&szlig; c&Ouml;wZqgvb nB&Dagger;j Ges Kg RvgvbZ c&Ouml;`vbKvix wKsev &Icirc;&aelig;wUc~Y&copy; `ic&Icirc; mivmwi evwZj ewjqv Mb&uml; nB&Dagger;e| 6) Dc&Dagger;i ewY&copy;Z (3) I (4) Gi Aax&Dagger;b c&Ouml;_g m&Dagger;ev&copy;&rdquo;P `i`vZvi RvgvbZ ev&Dagger;Rqv&szlig; nB&Dagger;j e&uml;vsK B&rdquo;Qv Kwi&Dagger;j w&Oslash;Zxq m&Dagger;e&copy;v&rdquo;P `i`vZv&Dagger;K m&curren;&uacute;w&Euml; &micro;&Dagger;q Avn&Yuml;vb Kwi&Dagger;Z cvwi&Dagger;eb| 7) wbjv&Dagger;g Ask M&Ouml;nY B&rdquo;QzK e&uml;w&sup3;MY we&macr;&Iacute;vwiZ Z_&uml; Rvwbevi Rb&uml; Ges wbjv&Dagger;g AskM&Ouml;n&Dagger;bi c~&Dagger;e&copy; e&Uuml;Kx m&curren;&uacute;w&Euml; m&curren;&uacute;wK&copy;Z hveZxq `wjjvw` ch&copy;&Dagger;e&yuml;Y Kivi Rb&uml; e&uml;vs&Dagger;Ki D&sup3; wVKvbvq Awdm PjvKvjxb mg&Dagger;q &dagger;hvMv&Dagger;hvM Kwi&Dagger;Z cvwi&Dagger;eb| 8) &dagger;Kvb Kvib `k&copy;v&Dagger;bv e&uml;wZ&Dagger;i&Dagger;K &dagger;h &dagger;Kvb ev mKj `ic&Icirc; evwZj Kwievi AwaKvi&nbsp; e&ordf;&uml;vK e&uml;vsK wjt msi&yuml;Y K&Dagger;i| M&bdquo;nxZ nq bvB Ggb `ic&Icirc; `vZv&Dagger;`i&Dagger;K Zvunv&Dagger;`i Rvgvb&Dagger;Zi UvKv h_vkxN&ordf; m&curren;&cent;e (1g I 2q m&Dagger;e&copy;v&rdquo;P `i`vZv e&uml;wZ&Dagger;i&Dagger;K) &dagger;diZ &dagger;`Iqv nB&Dagger;e| 9) `i`vZvMY ev Zvunv&Dagger;`i c&Ouml;wZwbwaMY (hw` Dcw&macr;&rsquo;Z _v&Dagger;Kb) Gi m&curren;&sect;y&Dagger;L AvMvgx ' . $dor_date . ' Bs Zvwi&Dagger;L we&Dagger;Kj 3.00 NwUKvq 2 bs k&Dagger;Z&copy; D&Dagger;j&oslash;wLZ e&ordf;&uml;vK e&uml;vsK wj: Gi Awd&Dagger;m `ic&Icirc; ev&middot; &dagger;Lvjv nB&Dagger;e| K&hellip;ZKvh&copy; `i`vZv&Dagger;K `wjj m&curren;&uacute;v`&Dagger;bi hveZxq `vwqZ&iexcl; Ges&nbsp; m&curren;&uacute;w&Euml;i &dagger;iwR&Dagger;&divide;&ordf;kb ms&micro;v&scaron;&Iacute; hveZxq LiP mn U&uml;v&middot; I Ab&uml;vb&uml; LiPvw` enb Kwi&Dagger;Z nB&Dagger;e| `wjj m&curren;&uacute;v`&Dagger;bi ci &dagger;Kvb Awf&Dagger;hvM M&Ouml;nb&Dagger;hvM&uml; nB&Dagger;e bv|</span></span></td>
										</tr>
										<tr>
											<td>
												<span style="font-size:10px;"><span style="font-family:sutonnymj;"><u>`ic&Icirc; `vwL&Dagger;ji wVKvbvt</u> &nbsp;wjM&uml;vj G&uml;v&Ucirc; wiKfvix&nbsp; wWwfkb, &Dagger;mcvj c&oslash;vwUbvg UvIqvi, 4_&copy; Zjv, 247-248, exi D&Euml;g gxi kIKZ Avjx moK, &dagger;ZRMvuI wk&iacute; GjvKv, XvKv-1208| &Dagger;dvb bs- ' . $mobile . '|</span></span></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>';
				$mort_data = array('paper_notice_33_7' => $html);
				$this->db->where('id', $id);
				$this->db->update('cma_auction', $mort_data);
			}
			$row = $this->Auction_model->get_info($id);
			$papernotice = $row->paper_notice_33_7;
		}

		$data = array(
			'option' => '',
			'cma_id' => $cma_id,
			'id' => $id,
			'edit_row' => $editrow,
			'type' => $paper_notice,
			'result' => $papernotice,
			'pages' => 'auction/pages/paper_notice',
		);
		$this->load->view('auction/form_layout', $data);

	}
	public function paperpdf($id, $type) {
		$str = "SELECT * FROM cma_auction WHERE id= $id";
		$query = $this->db->query($str);
		$res = $query->result();
		$Q1 = $this->db->query("SELECT project_client_logo FROM project_info WHERE id='1'");
		$proinfo = $Q1->result();
		require_once './application/tcpdf_6_3_5/tcpdf.php';
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		// remove default header
		$pdf->setPrintHeader(false);
		//$pdf->setPrintFooter(false);
		//$pdf->SetAuthor('Nicola Asuni');
		//$pdf->SetTitle('LEGAL NOTICE');
		//$pdf->SetSubject('(Registered with A/D)');
		//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
		//$pdf->setFooterData(array(0,64,0), array(0,64,128));

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$pdf->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$pdf->SetFont('times', '', 11, '', true);

		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage('P', 'A4');

		// convert TTF font to TCPDF format and store it on the fonts folder
		$fontname = TCPDF_FONTS::addTTFfont('css/SutonnyMJ-Regular.ttf', 'sutonnymj', '', 96);
		$pdf->SetFont($fontname, '', 15, '', false);
		$pdf->SetFont('times', '', 11, '', true);
		if ($type == '12_3') {
			$html = $res[0]->paper_notice_12_3;
		}elseif ($type == '12_5') {
			$html = $res[0]->paper_notice_12_5;
		} elseif ($type == '33_5') {
			$html = $res[0]->paper_notice_33_5;
		} elseif ($type == '33_7') {
			$html = $res[0]->paper_notice_33_7;

			$logo = base_url('setting/assets/images/' . $proinfo[0]->project_client_logo);
			$html = str_replace('<img alt="bbl_logo" src="' . $logo . '" width="100" height="30"/>', '<img alt="bbl_logo" src="setting/assets/images/' . $proinfo[0]->project_client_logo . '" width="100" height="30"/>', $html);
		}
		
		//echo '<pre>';
		//echo $html;
		//echo '</pre>';
		//exit;
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->Output('paper_notice.pdf', 'I');

	}

	public function memo_auction($id) {
		include_once 'tbs/clas/tbs_class.php'; // Load the TinyButStrong template engine
		include_once 'tbs/clas/tbs_plugin_opentbs.php'; // Load the OpenTBS plugin

		// prevent from a PHP configuration problem when using mktime() and date()
		if (version_compare(PHP_VERSION, '5.1.0') >= 0) {
			if (ini_get('date.timezone') == '') {
				date_default_timezone_set('UTC');
			}
		}

		// Initialize the TBS instance
		$TBS = new clsTinyButStrong; // new instance of TBS
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

		// A recordset for merging tables
		$result = $this->Auction_model->get_word_data($id);
		$Q1 = $this->db->query("SELECT ln_address FROM project_info WHERE id='1'");
		$in_address = $Q1->result();

		/*echo "<pre>";
			print_r($result);
			echo "</pre>";
			exit;*/

		$template = 'tbs/loan_LN/Auction_Memo.docx';
		$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

		$arr = array(array('sl_number' => array('gn' => '524'), 'date' => date('M d, Y')), array('sl_number' => '00001', 'date' => date('M d, Y')), array('sl_number' => '00002', 'date' => date('M d, Y')));

		foreach ($result[0]['guarntor'] as $val) {
			if ($val['type_name'] == 'Borrower') {
				$result[0]['baddress'] = $val['present_address'];
			}
		}
		$disamount = 0;
		$payamount = 0;
		$repayamount = 0;
		$outamount = 0;
		foreach ($result[0]['facility_loan'] as $faci) {
			$disamount += $faci['disbursed_amount'];
			$payamount += $faci['payble'];
			$repayamount += $faci['repayment'];
			$outamount += $faci['outstanding_bl'];
		}

		$result[0]['today'] = date('M d, Y');
		$result[0]['disamount'] = $disamount;
		$result[0]['payamount'] = $payamount;
		$result[0]['repayamount'] = $repayamount;
		$result[0]['outamount'] = $outamount;

		$mv = 0;
		$fsv = 0;
		$remv = 0;
		$refsv = 0;
		foreach ($result[0]['mortgage'] as $mort) {
			$mv += $mort['valuator_mv'];
			$fsv += $mort['valuator_fsv'];
			$remv += $mort['re_valuator_mv'];
			$refsv += $mort['re_valuator_fsv'];
		}

		$result[0]['mv'] = $mv;
		$result[0]['fsv'] = $fsv;
		$result[0]['remv'] = $remv;
		$result[0]['refsv'] = $refsv;

		foreach ($result[0]['bidder'] as $ky => $bid) {
			$result[0]['bidder'][$ky]['serial'] = $ky + 1;
		}

		$TBS->MergeBlock('a', $result);
		$TBS->MergeBlock('b', $result[0]['facility_loan']);
		$TBS->MergeBlock('t,m', $result[0]['mortgage']);
		$TBS->MergeBlock('c', $result[0]['bidder']);
		$TBS->MergeBlock('d', $result[0]['mortgage']);

		$save_as = '';
		$path = 'tbs/loan_LN_rslt/';
		$filename = 'Auction_Memo.docx';
		$filename = str_replace('.', '_' . date('Y-m-d') . $save_as . '.', $filename);
		//$output_file_name =$path.$filename;
		//$TBS->Show(OPENTBS_FILE, $output_file_name);

		$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.

		/*if(file_exists($output_file_name))
			{
			  header('Content-Disposition: attachment; filename=' . $filename);
			  readfile($output_file_name);
			}
			else
			{
			  echo 'File does not exists on given path';
			}*/

		exit;

	}
	public function auction_memo($val = null, $cma_id = null) {
		if (isset($_POST['paper'])) {
			$token = $this->input->post('token');
			$paper = $this->input->post('paper');
			$where = array('id' => $token);
			$updata = array('auction_memo' => $paper);
			$this->db->where($where);
			$this->db->update('cma_auction', $updata);
		}

		$row = $this->Auction_model->get_info($val);
		$auc_val = $val;
		if ($row->auction_memo == '') {
			$result = $this->Auction_model->get_word_data($cma_id);

			$Q1 = $this->db->query("SELECT ln_address,project_client_logo FROM project_info WHERE id='1'");
			$in_address = $Q1->result();
			// echo '<pre>';
			// print_r($in_address[0]->project_client_logo);
			// echo '</pre>';
			// exit;
			$logo = $in_address[0]->project_client_logo;
			$sl_no = $result[0]['sl_no'];
			$brrower_name = $result[0]['brrower_name'];
			$loan_ac = $result[0]['loan_ac'];
			$all_ac = $result[0]['all_ac'];
			$out_bl = $result[0]['out_bl'];
			$out_bl_dt = $result[0]['out_bl_dt'];

			$present_address = '';
			foreach ($result[0]['guarntor'] as $val) {
				if ($val['type_name'] == 'Borrower') {
					$present_address = $val['present_address'];
				}
			}
			$facility_details = '';
			$disbursed_amount = 0;
			$payble = 0;
			$repayment = 0;
			$outstanding_bl = 0;
			foreach ($result[0]['facility_loan'] as $key => $val) {
				$facility_details .= '<tr>
								<td style="text-align: center;">
									' . $val['ac_number'] . '</td>
								<td style="text-align: center;">
									' . $val['disbursement_date'] . '</td>
								<td style="text-align: center;">
									' . $val['expire_date'] . '</td>
								<td style="text-align: center;">
									' . $val['disbursed_amount'] . '</td>
								<td style="text-align: center;">
									' . $val['payble'] . '</td>
								<td>
									' . $val['repayment'] . '</td>
								<td style="text-align: center;">
									' . $val['outstanding_bl'] . '</td>
								<td style="text-align: center;">
									' . $val['cl_bb'] . '</td>
							</tr>
							';
				$disbursed_amount += $val['disbursed_amount'];
				$payble += $val['payble'];
				$repayment += $val['repayment'];
				$outstanding_bl += $val['outstanding_bl'];
			}
			$facility_details .= '<tr>
				<td colspan="3" style="text-align: right;">
					<strong>Total in BDT=</strong></td>
				<td style="text-align: center;">
					' . $disbursed_amount . '</td>
				<td style="text-align: center;">
					' . $payble . '</td>
				<td style="text-align: center;">
					' . $repayment . '</td>
				<td style="text-align: center;">
					' . $outstanding_bl . '</td>
				<td>
					&nbsp;</td>
			</tr>';

			$valuation_details = '';
			$mv = 0;
			$fsv = 0;
			$remv = 0;
			$refsv = 0;
			foreach ($result[0]['mortgage'] as $key => $val) {
				if ($key == 0) {
					$valuation_details .= '<tr>
										<td rowspan="2" style="text-align: center;">
											<strong>Description of the Mortgaged Schedule</strong></td>
										<td colspan="2" style="text-align: center;">
											<div>
												<strong>Valuator Name :&nbsp; ' . $val['valuator_name'] . ',</strong></div>
											<div>
												<strong>Date : ' . $val['valuator_date'] . '</strong></div>
										</td>
										<td colspan="2" style="text-align: center;">
											<div align="center">
												<strong>Re-Valuator: ' . $val['re_valuator_name'] . ',</strong></div>
											<strong>Date : ' . $val['re_valuator_date'] . '</strong></td>
										<td rowspan="2" style="text-align: center;">
											<div>
												<strong>Gov&#39;t Mouza Rate</strong></div>
										</td>
										<td rowspan="2" style="text-align: center;">
											<p align="center">
												<strong>Auction Amount</strong></p>
										</td>
									</tr>
									<tr>
										<td style="text-align: center;">
											<strong>MV</strong></td>
										<td style="text-align: center;">
											<strong>FSV </strong></td>
										<td style="text-align: center;">
											<strong>MV</strong></td>
										<td style="text-align: center;">
											<strong>FSV </strong></td>
									</tr>';
				}
				$valuation_details .= '<tr>
										<td style="text-align: center;">
											<strong><u>' . $val['mort_schedule_name'] . ':</u> ' . $val['mort_schedule_desc'] . '</strong></td>
										<td style="text-align: center;">
											<strong>' . $val['valuator_mv'] . '</strong></td>
										<td style="text-align: center;">
											<strong>' . $val['valuator_fsv'] . '</strong></td>
										<td style="text-align: center;">
											<strong>' . $val['re_valuator_mv'] . '</strong></td>
										<td style="text-align: center;">
											<strong>' . $val['re_valuator_fsv'] . '</strong></td>
										<td style="text-align: center;">
											<strong>' . $val['gov_mouza_rate'] . '</strong></td>
										<td style="text-align: center;">
											<strong>25,002,500</strong></td>
									</tr>
									';
				$mv += $val['valuator_mv'];
				$fsv += $val['valuator_fsv'];
				$remv += $val['re_valuator_mv'];
				$refsv += $val['re_valuator_fsv'];
			}
			$valuation_details .= '<tr>
										<td style="text-align: right;">
											<strong>In Total=</strong></td>
										<td style="text-align: center;">
											<strong>' . $mv . '</strong></td>
										<td style="text-align: center;">
											<strong>' . $fsv . '</strong></td>
										<td style="text-align: center;">
											<strong>' . $remv . '</strong></td>
										<td style="text-align: center;">
											<strong>' . $refsv . '</strong></td>
										<td style="text-align: center;">
											&nbsp;</td>
										<td style="text-align: center;">
											&nbsp;</td>
									</tr>';

			$bidder = '';
			foreach ($result[0]['bidder'] as $key => $val) {
				$i = $key + 1;
				$bidder .= '<tr>
							<td style="text-align: center;">
								' . $i . '</td>
							<td style="text-align: center;">
								' . $val['bidder_name'] . '</td>
							<td style="text-align: center;">
								' . $val['pay_order_no'] . ' dated ' . $val['pay_order_date'] . '</td>
							<td style="text-align: center;">
								' . $val['pay_order_amount'] . '</td>
							<td style="text-align: center;">
								' . $val['bid_amount'] . '</td>
							<td style="text-align: center;">
								' . $val['remarks'] . '</td>
						</tr>';

			}
			$mort_she = '';
			foreach ($result[0]['mortgage'] as $key => $val) {
				$mort_she .= '<tr>
										<td style="padding:5px;text-align:justify;">
											<strong><u>' . $val['mort_schedule_name'] . ':</u> ' . $val['mort_schedule_desc'] . '</strong></td>
									</tr>';
			}

			$html = '<div>
					<img alt="logo" height="30" src="' . base_url('setting/assets/images/' . $logo) . '" width="200" />
					<div>
					&nbsp;</div>
				<div>
					<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;border-top:1px solid #000;border-bottom:1px solid #000;">
						<tbody>
							<tr>
								<td>
									Ref</td>
								<td>
									:BBL/HO/LRD/LM/July/2021-' . $sl_no . '</td>
								<td rowspan="6" style="vertical-align: top;padding-right:5px;">
									<table align="right" border="0" cellpadding="0" cellspacing="0" style="width: 100%;border:1px solid #000;">
										<tbody>
											<tr>
												<td>
													<div>
													<span style="font-size:11px;"><strong>Credit Grading:</strong> <strong>DF</strong></span></div>
													<div>
														<span style="font-size:11px;"><strong>RM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : SAM-Small,</strong> <strong>Central</strong></span>
													</div>

												</td>
											</tr>
										</tbody>
									</table>
									<br />
									<p>
										&nbsp;</p>
								</td>
							</tr>
							<tr>
								<td>
									Date</td>
								<td>
									:' . date("M d, Y") . '</td>
							</tr>
							<tr>
								<td>
									Executed by</td>
								<td>
									:Auction Committee</td>
							</tr>
							<tr>
								<td>
									Subject</td>
								<td>
									:Approval for Auction Memo of A/C- &quot; ' . $brrower_name . '&quot;</td>
							</tr>
							<tr>
								<td>
									A/C</td>
								<td>
									:' . $loan_ac . '</td>
							</tr>
							<tr>
								<td>
									Address</td>
								<td>
									:' . $present_address . '</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div>
					<div>
						<strong><u>Overview:</u></strong></div>
					<div>
						<div style="text-align: justify;">
							Proprietor of &ldquo;' . $brrower_name . '&rdquo; borrowed loans from BRAC Bank PLC. under SME Small Business Segment; overdraft loan A/c No-' . $all_ac . ' facility renawal an amount of BDT. ' . $out_bl . ' sanctioned on dated: ' . $out_bl_dt . ' to meet the working capital requirments of his business. Due to nonpayment the account became overdue and classified.</div>
						<div style="text-align: justify;">
							Mentioned that, the Proprietor Sheak Md. Rahamat Ullah has&nbsp;died on 20.04.2020 leaving behind successors. As successors-in-Interest and guarantors of the loans successors are come forward to adjust the loans but at this moment this is beyond their capacity and there is no other option to adjust the liability except sale the mortgage property from their end as well as from Banks end. Subsequently Bank take initiative for auction sale of the registered mortgaged property. The loan details are as under:</div>
						<div>
							&nbsp;</div>
						<div>
							<div>
								<strong><u>Present Facilities Details:</u></strong></div>
						</div>
					</div>
				</div>
				<div>
					<table align="center" border="1" cellpadding="0" cellspacing="0" style="width: 100%;border-collapse: collapse;">
						<tbody>
							<tr>
								<td style="text-align: center;">
									<strong>A/C Number</strong></td>
								<td style="text-align: center;">
									<strong>Disbursement Date</strong></td>
								<td style="text-align: center;">
									<strong>Expire Date</strong></td>
								<td style="text-align: center;">
									<strong>Disbursed Amount</strong></td>
								<td style="text-align: center;">
									<strong>Payable</strong></td>
								<td style="text-align: center;">
									<strong>Repayment</strong></td>
								<td style="text-align: center;">
									<strong>Outstanding Balance as on</strong></td>
								<td style="text-align: center;">
									<strong>CL</strong></td>
							</tr>
							' . $facility_details . '
						</tbody>
					</table>
					<div>
						<div>
							&nbsp;</div>
						<div>
							<strong><u>Auction Details:</u></strong></div>
						<div style="text-align:justify;">
							Upon receiving request from concern SAM department Legal &amp; Recovery Division undertook an auction of the mortgaged properties of the defaulted borrower A/C: M/S. Al-Amin Enterprise under section 12(3) of Arthao Rin Adalath Ain-2003 on dated: 29<sup>th</sup> June 2021 at Sepal Platimum Tower (4<sup>th</sup> Floor), 220/B Gulshan, Tejgaon Link Road, and Dhaka-1208 at 03.00 PM.</div>
						<div>
							&nbsp;</div>
						<div>
							<div>
								<strong>The Mortgaged schedule, Valuation and Bid details are as under:</strong></div>
							<div>
								<strong><u>Schedule &amp; Valuation Details:</u></strong></div>
							<table align="center" border="1" cellpadding="0" cellspacing="0" style="width: 100%;border-collapse: collapse;">
								<tbody>
								' . $valuation_details . '
								</tbody>
							</table>
							<div>
								&nbsp;</div>
							<div>
								<strong><u>Bid Details:</u></strong></div>
							<div>
								<div style="text-align:justify;">
									In the above mentioned auction 03 (three) bidders were participated for purchasing of 4.80 decimals land and Building situated within Mouza- Jurain, District-Dhaka, Police Station- Kadamtoli under Schedule-A of the registered mortgage deed.</div>
								<div>
									<table border="1" cellpadding="0" cellspacing="0" style="width: 100%;border-collapse: collapse;">
										<tbody>
											<tr>
												<td style="text-align: center;">
													<strong>SL</strong></td>
												<td style="text-align: center;">
													<strong>Name</strong></td>
												<td style="text-align: center;">
													<strong>Pay Order No &amp; Date</strong></td>
												<td style="text-align: center;">
													<strong>Pay Order Amount (in total)</strong></td>
												<td style="text-align: center;">
													<strong>Bid Amount</strong></td>
												<td style="text-align: center;">
													<strong>Remarks</strong></td>
											</tr>
											' . $bidder . '
										</tbody>
									</table>
									<div>
										<strong><u>Disclosure:</u></strong></div>
									<div>
										<ol style="list-style-type:lower-alpha;">
											<li>
												<p style="text-align: justify;">
													It is to be noted that, Jorip O Paridarshan Company had been evaluated mortgage property on 12 Dec 2019 during the loan disbursement period of which Market Value of land and building under schedule-A (bidder dropped bid) was BDT. 40,457,197 &amp; Forced Sale Value was BDT. 30,400,000 (Survey Report enclosed).However, prior to auction proceedure, we have re-evaluated the mortgaged property which was conducted by Jorip O Paridarshan Company Limited on 20<sup>th</sup> Oct 2020 (Survey Report enclosed) and as per their report the present Market Value of land and building under schedule-A (bidder dropped bid) is BDT. 4,043,000 &amp; Forced Sale Value is BDT. 3,190,000.</p>
											</li>
											<li>
												<p style="text-align: justify;">
													It is pertinent to mention here that in this auction we have been offered in total BDT. 25,002,500 from the highest bidders which is more than present market value.</p>
											</li>
											<li>
												<p style="text-align: justify;">
													Present Gov&#39;t Mouza Rate of the auctioned property stands for 4.80 decimals land and Building situated within Mouza- Jurain, District-Dhaka, Police Station- Kadamtoli under schedule-A @BDT. 24,333,874 (Mouza rate attached) whereas highest bidder dropped his bid for the land BDT. 25,002,500 which price already covered Gov&#39;t Mouza Rate of the scheduled land. So we can sold out the property in this auction process. Mentioned that, if we sold out the property in this auction process registration fees will be determined at Gov&#39;t Mouza Value/Auction amount, which is higher.</p>
											</li>
											<li>
												<p style="text-align: justify;">
													Noted that, no bidder was participated for the rest portion of properties under Schedule-B and Schedule-C(I) &amp; C(II) of registered mortgage deed.</p>
											</li>
										</ol>
									</div>
								</div>
							</div>
						</div>
						<div>
							<strong><u>Justification for Finalizing BID:</u></strong></div>
						<div>
							<div style="margin-left: 13.5pt;text-align: justify;">
								The Auction Committee agreed to accept the highest bids for the mortgage properties unanimously. The reasons are as follows:</div>
							<ol style="list-style-type:lower-alpha;">
								<li>
									<p style="text-align: justify;">
									Presently no other alternative way to recover said NPL amount from this borrower (successors-in-Interest) and others parties of this loan.</p></li>
								<li>
									<p style="text-align: justify;">No other opportunity to full/partial set off the liability except selling of the mortgage property.</p></li>
								<li>
									<p style="text-align: justify;">Family Guarantor &amp; Third Party Guarantors are not co-operative to pay off the loan but they assist to sale the mortgage property.</p></li>
								<li>
									<p style="text-align: justify;">Considering valuation report, we like to accept the highest bidder quoted price as his bid amount is actually higher than the present market value of the properties as per valuation report of Jorip.</p></li>
								<li>
									<p style="text-align: justify;">
										Highest bid amount is more than the present Gov&#39;t Mouza Value.</p>
								</li>
								<li>
									<p style="text-align: justify;">
										BBL have another opportunity to sell the rest portion of properties under Schedule-B and Schedule-C(I) &amp; C(II) of registered mortgage deed, to set off the remaining liability with the borrower.</p>
								</li>
							</ol>
						</div>
						<div>
							<strong><u>Proposal for approval:</u></strong><br />
							<div style="margin-left: 4.5pt;text-align: justify;">
								After depositing of auction amount (sales proceed of mortgage property measuring 4.80 decimals land and Building under schedule-A) security will be released partially from the secured portion of the loan. Thereafter, BBL will take necessary steps to sell rest of the mortgage properties upon availability of buyer. Later, the best effort to continue for recovery of the rest amount will be by initiation legal action under Artha Rin Adalat Ain-2003 against guarantors (if needed).</div>
							<div style="margin-left: 4.5pt;text-align: justify;">
								Considering the above facts, we are submitting this memo for approval to the Auction Committee to accept the bid of Md. Jobiullah Gong as purchaser for the property under Schedule-A of the registered mortgage deed, 4.80 decimals land and Building situated within Mouza- Jurain, District-Dhaka, Police Station- Kadamtoli.</div>
							<div style="margin-left: 4.5pt;">
								&nbsp;</div>
							<div style="margin-left: 4.5pt;">
								<strong>Auction Committee has accepted the auction bid of highest bidder Md. Jobiullah Gong.</strong></div>
							<div style="margin-left: 4.5pt;">
								&nbsp;</div>
							<div style="margin-left: 4.5pt;">
								<strong><u>Steps to be taken after approval of the Auction Committee:</u></strong></div>
							<div style="margin-left: 4.5pt;">
								<ol style="list-style-type:lower-alpha;">
									<li>
										<p style="text-align:justify;">
										Provide Auction Acceptance Letter to the highest bidder. Description</p></li>
									<li><p style="text-align:justify;">
										Sent back all bidders&#39; pay order, except highest bidder.</p></li>
									<li><p style="text-align:justify;">
										Legal &amp; Recovery Division to complete the registration formalities in favor of highest bidders after full payment.</p></li>
									<li><p style="text-align:justify;">
										Concern wing of CAD will take initiative for un-tagging collateral value of this auction property partially from the system of BBL.</p></li>
									<li><p style="text-align:justify;">
										After adjustment of the bid amount with the liabilities of the borrower Legal &amp; Recovery Division will take necessary steps to sell rest of the mortgage property (on condition of availability of potential buyers) and later will file case under Artha Rin Ain-2003 for recovering the rest of the NPL amount. (If Needed).</p></li>
								</ol>
							</div>
							<div style="margin-left: 4.5pt;">
								&nbsp;</div>
						</div>
						<div>
							<p>
								Placed for your kind Approval.</p>
							<table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
								<tbody>
									<tr>
										<td>
											<div>
												&nbsp;</div>
											<div>
												&nbsp;</div>
											<div>
												&nbsp;</div>
											<div>
												&nbsp;</div>
											<div>
												&nbsp;</div>
											<div style="border-top:1px solid #000;">
												Muhd. Waliul A. Khan</div>
											<div>
												Unit Head- Asset Liquidation Unit</div>
											<div>
												PIN : 10631</div>
										</td>
										<td rowspan="3" style="width: 20%;">
											&nbsp;</td>
										<td>
											<div align="left">
												&nbsp;</div>
											<div align="left">
												&nbsp;</div>
											<div align="left">
												&nbsp;</div>
											<div align="left">
												&nbsp;</div>
											<div align="left">
												&nbsp;</div>
											<div style="border-top:1px solid #000;">
												Biplab Kumar Biswas<br />
												Head of Underwriting,</div>
											<div>
												Small Business, PIN : 10147</div>
										</td>
									</tr>
									<tr>
										<td>
												<div>
													&nbsp;</div>
												<div>
													&nbsp;</div>
												<div>
													&nbsp;</div>
												<div>
													&nbsp;</div>
												<div>
													&nbsp;</div>
												<div style="border-top:1px solid #000;">
													Lt Col Mahdi N Shahir, BP(Retd)</div>

											<div>
												Head of SAM-SME</div>
											<div>
												PIN : 26564</div>
										</td>
										<td>
											<div>
												&nbsp;</div>
											<div>
												&nbsp;</div>
											<div>
												&nbsp;</div>
											<div>
												&nbsp;</div>
											<div>
												&nbsp;</div>
											<div style="border-top:1px solid #000;">
												Brig Gen Tushar Kanti (Retd.)</div>
											<div>
												Head of GSS and Procurement</div>
											<div>
												PIN : 24600</div>
										</td>
									</tr>
									<tr>
										<td>
												<div>
													&nbsp;</div>
												<div>
													&nbsp;</div>
												<div>
													&nbsp;</div>
												<div>
													&nbsp;</div>
												<div>
													&nbsp;</div>
												<div style="border-top:1px solid #000;">
													Syed Abdul Momen</div>
											<div>
												Head of SME</div>
											<div>
												PIN : 1441</div>
										</td>
										<td>
											<div>
												&nbsp;</div>
											<div>
												&nbsp;</div>
											<div>
												&nbsp;</div>
											<div>
												&nbsp;</div>
											<div>
												&nbsp;</div>
											<div style="border-top:1px solid #000;">
												Rasheed Ahmed</div>
											<div>
												Head of Legal &amp; Recovery</div>
											<div>
												PIN : 3979</div>
										</td>
									</tr>
								</tbody>
							</table>
							<div style="text-align: center;">
								&nbsp;</div>
							<div style="text-align: center;">
								<span style="font-size:16px;"><strong><u>SCHEDULE OF THE MORTGAGE PROPERTIES</u></strong></span></div>
							<div style="text-align: center;">
								&nbsp;</div>
						</div>
						<div>
							<table border="1" cellpadding="0" cellspacing="0" style="width: 100%;border-collapse: collapse;">
								<tbody>
									' . $mort_she . '
								</tbody>
							</table>
							<div>
								&nbsp;</div>
							<div>
								<strong><u>Enclosure:</u></strong></div>
						</div>
						<div>
							<ol>
								<li>
									Bid Application.</li>
								<li>
									Copy of Auction Notice.</li>
								<li>
									Copy of Mouza Rate.</li>
								<li>
									Valuation Reports.</li>
								<li>
									Sanction Letter.</li>
								<li>
									Photocopy of Deed of Mortgage &amp; Power of Attorney.</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			';

			$auctonmemo = array('auction_memo' => $html);
			$this->db->where('id', $auc_val);
			$this->db->update('cma_auction', $auctonmemo);
		}
		$row = $this->Auction_model->get_info($auc_val);
		$data = array(
			'option' => '',
			'cma_id' => $cma_id,
			'id' => $auc_val,
			//'edit_row' => $editrow,
			'result' => $row->auction_memo,
			'pages' => 'auction/pages/paper_memo',
		);
		$this->load->view('auction/form_layout', $data);

	}
	public function auction_memo_pdf($id) {
		$str = "SELECT * FROM cma_auction WHERE id= $id";
		$query = $this->db->query($str);
		$res = $query->result();
		$Q1 = $this->db->query("SELECT project_client_logo FROM project_info WHERE id='1'");
		$proinfo = $Q1->result();
		require_once './application/tcpdf_6_3_5/tcpdf.php';
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		// remove default header
		$pdf->setPrintHeader(false);
		//$pdf->setPrintFooter(false);
		//$pdf->SetAuthor('Nicola Asuni');
		//$pdf->SetTitle('LEGAL NOTICE');
		//$pdf->SetSubject('(Registered with A/D)');
		//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
		//$pdf->setFooterData(array(0,64,0), array(0,64,128));

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$pdf->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$pdf->SetFont('times', '', 11, '', true);

		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage('P', 'A4');

		// convert TTF font to TCPDF format and store it on the fonts folder
		//$fontname = TCPDF_FONTS::addTTFfont('css/SutonnyMJ-Regular.ttf', 'sutonnymj', '', 96);
		//$pdf->SetFont($fontname, '', 15, '', false);
		//$pdf->SetFont('times', '', 11, '', true);
		$html = $res[0]->auction_memo;

		$logo = base_url('setting/assets/images/' . $proinfo[0]->project_client_logo);
		$html = str_replace('<img alt="logo" src="' . $logo . '" width="200" height="30"/>', '<img alt="bl_logo" src="setting/assets/images/' . $proinfo[0]->project_client_logo . '" width="200" height="30"/>', $html);

		/*
			echo '<pre>';
				print_r($html);
				echo '</pre>';
				exit;*/
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->Output('paper_notice.pdf', 'I');
	}
}

?>