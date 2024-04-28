<?php
class Common_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	function push_notification_data($subject,$url,$main_table_name,$table_id,$start_date,$end_date=NULL,$checker=NULL,$update_check=NULL,$group_id=NULL)
	{
		$notification_data2 = array(
	            	'notification_subject' => $subject,
	            	'url' => $url,
	                'main_table_name' => $main_table_name,
	                'table_id' => $table_id,
	                'notification_start_date'=> $start_date,
	                'notification_end_date'=> $end_date,
	                'notification_to'=> $checker,
	                'notify_group'=> $group_id
                );
		if($update_check==NULL || $update_check=='0' || $update_check=='' || $update_check==0)
		{
			$this->db->insert('notification_history', $notification_data2);
		}
		else
		{
			$exist_data = $this->db->query("SELECT id FROM notification_history where main_table_name='".$main_table_name."' AND table_id='".$table_id."' ")->row();
			if(!empty($exist_data))
			{
				$this->db->where('id', $exist_data->id);
				$this->db->update('notification_history', $notification_data2);
			}
			else
			{
				$this->db->insert('notification_history', $notification_data2);
			}
			
		}
		return true;
	}
	function get_mbs_ac($loan_ac, $liv_dev)
	{
		$mbs_ac = '';
		if ($liv_dev == 'liv') {
			$secound_db = $this->load->database('oracle2', TRUE);
			$sql = "select ACCT_NUM,NEW_ACCT_NUM from SYSTEM.old_acct_map where NEW_ACCT_NUM='" . $loan_ac . "'";

			$data = $secound_db->query($sql);
			$result = $data->result();
			if (!empty($result)) {
				foreach ($result as $key) {
					$mbs_ac = $key->ACCT_NUM;
				}
			}
			return $mbs_ac;
		} else {
			$mbs_ac = '150180000013';
			return $mbs_ac;
		}
	}
	function get_card_stmt($loan_ac, $from_dt, $to_dt, $liv_dev)
	{
		$result = array();

		if ($liv_dev == 'liv') {
			$secound_db = $this->load->database('oracle', TRUE);
			$exist2 = $secound_db->query("SELECT
			    cardholder_no,individual_acctno,fin_acctno,credit_limit,opening_balance,current_balance,last_payment_date,last_payment_amt,current_MIN_PMT,
			    MTD_DEBIT,MTD_CREDIT,mth_stmt_date,mth_late_ind,mth_revolve_ind,mth_age_cd,mth_dunn_cd,mth_retchq_cnt,
			    mth_close_bal,last_month_min_due,debit,credits
			FROM
			    (
			        SELECT   --a.CB_CARDHOLDER_NO,
			            concat(concat(substr(cb_cardholder_no, 1, 6), '******'), substr(cb_cardholder_no, 13, 4)) cardholder_no,
			            a.cb_individual_acctno  individual_acctno,
			            c.cb_fin_acctno fin_acctno,
			            cb_line_limit     credit_limit,
			            b.cb_last_payment_date last_payment_date,
			            b.cb_last_payment_amt last_payment_amt,
			            b.CB_MIN_PMT current_MIN_PMT,
			            b.CB_MTD_TOT_CHRG_AMT MTD_DEBIT,
			            b.CB_MTD_PMT+CB_MTD_CR_ADJUST MTD_CREDIT,
			            c.cb_mth_stmt_date mth_stmt_date,
			            c.cb_mth_late_ind mth_late_ind,
			            c.cb_mth_revolve_ind mth_revolve_ind,
			            c.cb_mth_age_cd mth_age_cd,
			            c.cb_mth_dunn_cd mth_dunn_cd,
			            c.cb_mth_retchq_cnt mth_retchq_cnt,
			            c.cb_mth_close_bal mth_close_bal,
			            c.cb_mth_min_pmt last_month_min_due,
			            CB_UNBILL_CHARGE current_balance,
			            c.cb_mth_charge   debit,
			            ( c.cb_mth_payment + c.cb_mth_cr_adj ) credits,
			            b.CB_LAST_ACTUAL_STMT_DATE LAST_ACTUAL_STMT_DATE
			        FROM
			            cardpro.cp_finhst   c,
			            cardpro.cp_crdtbl   a,
			            cardpro.cp_fintbl   b,
			            cardpro.cp_indacc   d
			        WHERE
			            a.cb_cardholder_no = '" . $loan_ac . "'
			            AND b.cb_individual_acctno = a.cb_individual_acctno
			            AND cb_basic_supp_ind = 'B'
			            AND d.cb_individual_acctno = a.cb_individual_acctno
			            AND b.cb_fin_acctno = c.cb_fin_acctno
			        ORDER BY
			            cb_mth_stmt_date
			    ) Y
			    
			    left join 
			    (select cb_fin_acctno ,cb_mth_close_bal opening_balance,cb_mth_stmt_date  from cardpro.cp_finhst )X on  
			                   X.cb_mth_stmt_date=Y.LAST_ACTUAL_STMT_DATE 
			                   and Y.fin_acctno = X.cb_fin_acctno");
			$data = $exist2->result();
			if (!empty($data)) {
				return $data;
			} else {
				return array();
			}
		} else {
			// $result[10] = array(
			// 	'MTH_STMT_DATE' => '20051227',
			// 	'CREDIT_LIMIT' => '20051227',
			// 	'OPENING_BALANCE' => '20051227',
			// 	'CURRENT_BALANCE' => '20051227',
			// 	'MTD_DEBIT' => '20051227',
			// 	'MTD_CREDIT' => '20051227',
			// 	'MTH_AGE_CD' => '0',
			// 	'MTH_DUNN_CD' => '0',
			// 	'MTH_RETCHQ_CNT' => '0',
			// 	'MTH_CLOSE_BAL' => '0',
			//           'DEBIT' => '200000',
			//           'CREDITS' => '0',
			//           'MTH_LATE_IND' => '0',
			//           'MTH_REVOLVE_IND' => '0',
			// );
			return $result;
		}
	}
	function get_mbs_stmt($loan_ac, $from_dt, $to_dt, $liv_dev)
	{
		$result = array();
		$i = 0;
		if ($liv_dev == 'liv') {
			$server = config_item('mbs_server'); //"10.5.6.75,1433";
			$pass = config_item('mbs_pass'); //'Lm$MLb##2022';
			$frist_4_str = substr($loan_ac, 0, 4);
			if ($frist_4_str == 0000) {
				$coninfo = array("Database" => "MLB_HO", "UID" => "LMS_MLB", "PWD" => $pass);
			} else {
				$coninfo = array("Database" => "PROTO", "UID" => "LMS_MLB", "PWD" => $pass);
			}

			$conn = sqlsrv_connect($server, $coninfo);
			if ($conn) {
				sqlsrv_query($conn, 'SET NOCOUNT ON');
				$val1 = $loan_ac; //     '150180023807';
				$val2 = $from_dt; //'01-Jan-2000';
				$val3 = $to_dt; //'31-Dec-2009';
				sqlsrv_configure('WarningsReturnAsErrors', 0);
				$sql = "{call SP_Statement_Voucher(?,?,?)}";
				$pms = array(
					array($val1, SQLSRV_PARAM_IN),
					array($val2, SQLSRV_PARAM_IN),
					array($val3, SQLSRV_PARAM_IN)
				);
				if ($stmt = sqlsrv_prepare($conn, $sql, $pms)) {
					if (sqlsrv_execute($stmt) === false) {
						return array();
					} else {
						while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
							if (empty($row)) {
								break;
							}
							$i++;
							$ab = "";
							//$ab = new DateTime($row['atotransdate']->date);
							if (is_object($row['atotransdate'])) {
								$ab = $row['atotransdate']->format('Y-m-d');
							}
							//$bc = $ab->format('Y-m-d');
							$result[$i] = array(
								'atotransdate' => $ab,
								'part' => $row['part'],
								'dr' => str_replace(',', '', $row['dr']),
								'cr' => str_replace(',', '', $row['cr'])
							);
						}
						return $result;
					}
				} else {
					return array();
				}
			} else {
				return array();
			}
		} else //For Dev mode
		{
			$result[1] = array(
				'atotransdate' => '2018-05-27',
				'part' => 'SME CLD to Rojoni Hosiary of Pabna thr PBL File# 24178',
				'dr' => '200000',
				'cr' => '0'
			);

			$result[2] = array(
				'atotransdate' => '2018-12-31',
				'part' => 'Interest',
				'dr' => '666.67',
				'cr' => '0'
			);
			$result[3] = array(
				'atotransdate' => '2019-01-25',
				'part' => 'Ins Paid By Rojoni Hosiary 90363687 of Pabna thr PBL',
				'dr' => '0',
				'cr' => '13400'
			);
			$result[4] = array(
				'atotransdate' => '2019-01-31',
				'part' => 'Interest',
				'dr' => '4084.58',
				'cr' => '0'
			);
			$result[5] = array(
				'atotransdate' => '2019-02-27',
				'part' => 'Ins paid by Rojoni Hosiary 150190363687 of Pabna thr PBL(Rls.dt.26-02-06)',
				'dr' => '0',
				'cr' => '13400'
			);
			$result[6] = array(
				'atotransdate' => '2019-02-28',
				'part' => 'Interest',
				'dr' => '3554.02',
				'cr' => '0'
			);
			return $result;
		}
	}
	function get_xcrv_stmt($loan_ac, $from_dt, $to_dt, $liv_dev)
	{
		$result = array();
		$i = 0;
		if ($liv_dev == 'liv') {
			$tns2 = config_item('xcrv_conn_string'); //"(DESCRIPTION =(ADDRESS_LIST =(ADDRESS =(PROTOCOL = TCP)(HOST = 10.5.24.45)(PORT = 1522)))(CONNECT_DATA =(SERVICE_NAME = FINBRAC)(SERVER = DEDICATED)))";

			$conn = oci_connect(config_item('xcrv_user'), config_item('xcrv_pass'), $tns2);

			if (!$conn) {
				return array();
			} else {
				$stmt = "DECLARE 
				  P_ACCOUNTNO VARCHAR2(200);
				  P_FROMDATE DATE;
				  P_TODATE DATE;
				  P_DETAILS SYS_REFCURSOR;

				BEGIN 
				  P_ACCOUNTNO := '" . $loan_ac . "';
				  P_FROMDATE := '" . $from_dt . "';
				  P_TODATE := '" . $to_dt . "';
				 

				  CUSTOM.XCRV360V2.SP_FINSTATEMENT_VD ( P_ACCOUNTNO, P_FROMDATE, P_TODATE, P_DETAILS );

				  :rc0_P_DETAILS := P_DETAILS;

				END;";
				$s = oci_parse($conn, $stmt);
				$rc = oci_new_cursor($conn);

				oci_bind_by_name($s, ':rc0_P_DETAILS', $rc, -1, OCI_B_CURSOR);
				oci_execute($s);
				oci_execute($rc);
				while ($row = oci_fetch_array($rc)) {
					$i++;
					if (array_key_exists("VALUE_DATE", $row)) {
						$result[$i] = array(
							'VALUE_DATE' => $row[1], //0 equal to VALUE_DATE
							'TRAN_PARTICULAR' => $row[2], //1 equal to Tran_particular
							'WITHDRAW' => str_replace(',', '', (string)$row[4]), //3 withdraw
							'DEPOSIT' => str_replace(',', '', (string)$row[5]) //4 Deposit
						);
					}
				}
				return $result;
				oci_free_statement($s);
				oci_free_statement($rc);
				oci_close($conn);
			}
		} else //For dev mode
		{
			$result[1] = array(
				'VALUE_DATE' => '31-5-2019',
				'TRAN_PARTICULAR' => 'Ins Paid By150190363687Rojoni Hosiary of Pabna thr PBL',
				'WITHDRAW' => '3343.79',
				'DEPOSIT' => '0'
			);
			$result[2] = array(
				'VALUE_DATE' => '31-5-2019',
				'TRAN_PARTICULAR' => 'Interest',
				'WITHDRAW' => '3343.79',
				'DEPOSIT' => '0'
			);
			$result[3] = array(
				'VALUE_DATE' => '30-6-2019',
				'TRAN_PARTICULAR' => 'Interest',
				'WITHDRAW' => '3293.12',
				'DEPOSIT' => '0'
			);
			$result[4] = array(
				'VALUE_DATE' => '31-7-2019',
				'TRAN_PARTICULAR' => 'Interest',
				'WITHDRAW' => '3470.95',
				'DEPOSIT' => '0'
			);
			$result[5] = array(
				'VALUE_DATE' => '31-8-2019',
				'TRAN_PARTICULAR' => 'Interest',
				'WITHDRAW' => '3542.68',
				'DEPOSIT' => '0'
			);
			$result[6] = array(
				'VALUE_DATE' => '30-9-2019',
				'TRAN_PARTICULAR' => 'Interest',
				'WITHDRAW' => '3499.25',
				'DEPOSIT' => '0'
			);
			$result[7] = array(
				'VALUE_DATE' => '12-10-2019',
				'TRAN_PARTICULAR' => 'Ins paid by 150190363687 Rojoni Hosiary of Pabna thr pbl',
				'WITHDRAW' => '0',
				'DEPOSIT' => '1000'
			);
			$result[8] = array(
				'VALUE_DATE' => '31-10-2019',
				'TRAN_PARTICULAR' => 'Interest',
				'WITHDRAW' => '3674.88',
				'DEPOSIT' => '0'
			);
			$result[9] = array(
				'VALUE_DATE' => '12-11-2019',
				'TRAN_PARTICULAR' => 'Interest',
				'WITHDRAW' => '3622.74',
				'DEPOSIT' => '0'
			);
			return $result;
		}
	}
	function get_write_off_data($loan_ac, $liv_dev)
	{
		$result = array();
		$i = 0;
		if ($liv_dev == 'liv') {
			$tns2 = config_item('xcrv_conn_string'); //"(DESCRIPTION =(ADDRESS_LIST =(ADDRESS =(PROTOCOL = TCP)(HOST = 10.5.24.45)(PORT = 1522)))(CONNECT_DATA =(SERVICE_NAME = FINBRAC)(SERVER = DEDICATED)))";

			$conn = oci_connect(config_item('xcrv_user'), config_item('xcrv_pass'), $tns2);

			if (!$conn) {
				return array();
			} else {
					$stmt ="select gam.foracid, case when (select count(1) from CUSTOM.LOANS_WOFF_MASTER where entity_id = foracid) = 1 then 'Yes'
				        else 
				       case when (select count(1) from tbaadm.lam where lam.acid = gam.acid and chrge_off_flg = 'Y') = 1 then 'Yes' else 'No' end 
				       end is_writeoff,
				       case when (select count(1) from CUSTOM.LOANS_WOFF_MASTER where entity_id = foracid) = 1 then 
				                (select WOFF_DATE from CUSTOM.LOANS_WOFF_MASTER where entity_id = foracid)
				        else 
				       case when (select count(1) from tbaadm.lam where lam.acid = gam.acid and chrge_off_flg = 'Y') = 1 then  
				                (select CHRGE_OFF_DATE from tbaadm.cot where cot.acid = gam.acid)
				       else null end 
				       end writeoff_date,
				       INTEREST_CALC_UPTO_DATE_DR last_interest_run_date_dr,
				       eab.tran_date_bal balasoffdate       
						from TBAADM.GAM
						left join tbaadm.eit on eit.entity_id = gam.acid
						left join tbaadm.eab on gam.acid=eab.acid and eab.end_eod_date>=eit.INTEREST_CALC_UPTO_DATE_DR and eab.eod_date<=eit.INTEREST_CALC_UPTO_DATE_DR
						where foracid = '".$loan_ac."'";
				$s = oci_parse($conn,$stmt);
				$rc = oci_execute($s);

				$nrow = oci_fetch_all($s, $row, 0, -1, OCI_FETCHSTATEMENT_BY_ROW+OCI_RETURN_NULLS);
				foreach($row as $key=>$value)
				{
					if(!empty($value))
					{
						return $value;
					}
				}
			}
		} else //For dev mode
		{
			$result= array(
				'IS_WRITEOFF' => 'Yes',
				'WRITEOFF_DATE' => '15-10-2005',
				'LAST_INTEREST_RUN_DATE_DR' => '23-01-2011',
				'BALASOFFDATE' => '150000'
			);
			return $result;
		}
	}
	function get_file_name($module_name, $data_field_name, $upload_path)
	{
		$str = "select * from temp_upload_file where module_name='$module_name' and data_field_name='$data_field_name' and Session_Id='" . $this->session->userdata['ast_user']['user_id'] . "'";
		//$query=$this->db->query($str);
		$result = $this->db->query($str)->row();
		if ($result != '') {
			if (!empty($result)) {
				copy(FCPATH . 'temp_upload_file/' . $result->New_file_name, FCPATH . $upload_path . $result->New_file_name);
				return $result->New_file_name;
			} else {
				return "";
			}
		} else {
			return "";
		}
	}
	function add_expense($event_id, $module_name, $prev_proxy_id = NULL)
	{
		$last_activities = 0;
		for ($i = 1; $i <= $_POST['expense_counter']; $i++) {
			$expense_data = array(
				'event_id' => $event_id,
				'module_name' => $module_name,
				'district' => $this->security->xss_clean($this->input->post('district_' . $i)),
				'expense_type' => $this->security->xss_clean($this->input->post('expense_type_' . $i)),
				'activities_name' => $this->security->xss_clean($this->input->post('activities_name_' . $i)),
				'activities_date' => implode('-', array_reverse(explode('/', $this->input->post('activities_date_' . $i)))),
				'procurement' => $this->security->xss_clean($this->input->post('p_cost_' . $i)),
				'amount' => $this->security->xss_clean($this->input->post('amount_' . $i)),
				'remarks' => $this->security->xss_clean($this->input->post('remarks_' . $i))
			);
			if (isset($_POST['package_delete_' . $i]) && $this->input->post('package_delete_' . $i) == 0) {
				$expense_data['package_select_sts'] = 1;
			} else {
				$expense_data['package_select_sts'] = 0;
			}
			if ($this->input->post('expense_type_' . $i) == 1 || $this->input->post('expense_type_' . $i) == 2 || $this->input->post('expense_type_' . $i) == 3 || $this->input->post('expense_type_' . $i) == 4 || $this->input->post('expense_type_' . $i) == 5) {
				$expense_data['vendor_id'] = $this->security->xss_clean($this->input->post('vendor_id_' . $i));
				$expense_data['vendor_name'] = '';
				//Proxy Lawyer Check
				if ($prev_proxy_id != NULL && $this->security->xss_clean($this->input->post('vendor_id_' . $i)) != $prev_proxy_id) {
					$expense_data['proxy_sts'] = 1;
					$expense_data['proxy_against'] = $prev_proxy_id;
				} else {
					$expense_data['proxy_sts'] = 0;
					$expense_data['proxy_against'] = 0;
				}
			} else {
				$expense_data['vendor_name'] = $this->security->xss_clean($this->input->post('vendor_name_' . $i));
				$expense_data['vendor_id'] = '';
			}
			if ($_POST['expense_delete_' . $i] != 1) {
				$this->db->insert('expenses', $expense_data);
				$last_activities = $this->security->xss_clean($this->input->post('activities_name_' . $i));
			}
			$insert_idss2 = $this->db->insert_id();
		}
		if ($last_activities != 0 && $module_name == 'Suit File') //For suit file last activities update
		{
			$suit_data = array('act_prev_date' => $last_activities);
			$this->db->where('id', $event_id);
			$this->db->update('suit_filling_info', $suit_data);
		}
		return true;
	}
	function edit_expense($event_id, $module_name, $prev_proxy_id = NULL)
	{
		$last_activities = 0;
		for ($i = 1; $i <= $_POST['expense_counter']; $i++) {
			$expense_data = array(
				'event_id' => $event_id,
				'module_name' => $module_name,
				'district' => $this->security->xss_clean($this->input->post('district_' . $i)),
				'expense_type' => $this->security->xss_clean($this->input->post('expense_type_' . $i)),
				'activities_name' => $this->security->xss_clean($this->input->post('activities_name_' . $i)),
				'activities_date' => implode('-', array_reverse(explode('/', $this->input->post('activities_date_' . $i)))),
				'procurement' => $this->security->xss_clean($this->input->post('p_cost_' . $i)),
				'amount' => $this->security->xss_clean($this->input->post('amount_' . $i)),
				'remarks' => $this->security->xss_clean($this->input->post('remarks_' . $i))
			);
			$cost_data = array(
				'vendor_type' => $this->security->xss_clean($this->input->post('expense_type_' . $i)),
				'activities_id' => $this->security->xss_clean($this->input->post('activities_name_' . $i)),
				'txrn_dt' => implode('-', array_reverse(explode('/', $this->input->post('activities_date_' . $i)))),
				'amount' => $this->security->xss_clean($this->input->post('amount_' . $i)),
				'expense_remarks' => $this->security->xss_clean($this->input->post('remarks_' . $i))
			);
			if (isset($_POST['package_delete_' . $i]) && $this->input->post('package_delete_' . $i) == 0) {
				$expense_data['package_select_sts'] = 1;
			} else {
				$expense_data['package_select_sts'] = 0;
			}
			if ($this->input->post('expense_type_' . $i) == 1 || $this->input->post('expense_type_' . $i) == 2 || $this->input->post('expense_type_' . $i) == 3 || $this->input->post('expense_type_' . $i) == 4 || $this->input->post('expense_type_' . $i) == 5) {
				$expense_data['vendor_id'] = $this->security->xss_clean($this->input->post('vendor_id_' . $i));
				$expense_data['vendor_name'] = '';
				$cost_data['vendor_id'] = $this->security->xss_clean($this->input->post('vendor_id_' . $i));
				$cost_data['vendor_name'] = '';
				//Proxy Lawyer Check
				if ($prev_proxy_id != NULL && $this->security->xss_clean($this->input->post('vendor_id_' . $i)) != $prev_proxy_id) {
					$expense_data['proxy_sts'] = 1;
					$expense_data['proxy_against'] = $prev_proxy_id;

					$cost_data['proxy_sts'] = 1;
					$cost_data['proxy_against'] = $prev_proxy_id;
				} else {
					$expense_data['proxy_sts'] = 0;
					$expense_data['proxy_against'] = 0;

					$cost_data['proxy_sts'] = 0;
					$cost_data['proxy_against'] = 0;
				}
			} else {
				$expense_data['vendor_name'] = $this->security->xss_clean($this->input->post('vendor_name_' . $i));
				$expense_data['vendor_id'] = '';

				$cost_data['vendor_name'] = $this->security->xss_clean($this->input->post('vendor_name_' . $i));
				$cost_data['vendor_id'] = '';
			}
			// For skip The new deleted row
			if ($_POST['expense_edit_' . $i] == 0 && $_POST['expense_delete_' . $i] == 1) {
				continue;
			}
			//For Delete the old row
			if ($_POST['expense_edit_' . $i] != 0 && $_POST['expense_delete_' . $i] == 1) {
				$expense_data = array('sts' => 0);
				$this->db->where('id', $_POST['expense_edit_' . $i]);
				$this->db->update('expenses', $expense_data);

				//Delete Cost Data when user delete after verify
				$str = "SELECT  j0.*
                             FROM cost_details j0
                         WHERE j0.sub_table_name='expenses' AND j0.sub_table_id= '" . $_POST['expense_edit_' . $i] . "'";
				$application_data = $this->db->query($str)->result();
				if (!empty($application_data)) {
					foreach ($application_data as $key => $value) {
						$data = array();
						foreach ($value as $keyIn => $value2) {
							if ($keyIn == 'id') {
								$data['org_id'] = $value2;
							} else {
								$data[$keyIn] = $value2;
							}
						}
						$data['d_by'] = $this->session->userdata['ast_user']['user_id'];
						$data['d_dt'] = date('Y-m-d H:i:s');
						$data['d_reason'] = 'Deleted when edit expense after verify';
						$this->db->insert('cost_details_deleted', $data);
					}
					$str = "DELETE 
                             FROM cost_details j0
                         WHERE j0.sub_table_name='expenses' AND j0.sub_table_id= '" . $_POST['expense_edit_' . $i] . "'";
					$application_data = $this->db->query($str);
				}
			}
			//For update the old row
			else if ($_POST['expense_edit_' . $i] != 0 && $_POST['expense_delete_' . $i] != 1) {
				$this->db->where('id', $_POST['expense_edit_' . $i]);
				$this->db->update('expenses', $expense_data);
				$last_activities = $this->security->xss_clean($this->input->post('activities_name_' . $i));
				//udating cost data when user edit data after verify
				$str = "SELECT  j0.*
                             FROM cost_details j0
                         WHERE j0.sub_table_name='expenses' AND j0.sub_table_id= '" . $_POST['expense_edit_' . $i] . "' LIMIT 1";
				$application_data = $this->db->query($str)->row();
				if (!empty($application_data)) {
					$this->db->where('id', $application_data->id);
					$this->db->update('cost_details', $cost_data);
				}
			}
			//For insert the new row
			else if ($_POST['expense_edit_' . $i] == 0 && $_POST['expense_delete_' . $i] == 0) {
				$this->db->insert('expenses', $expense_data);
				$last_activities = $this->security->xss_clean($this->input->post('activities_name_' . $i));
			}
		}
		if ($last_activities != 0 && $module_name == 'Suit File') //For suit file last activities update
		{
			$suit_data = array('act_prev_date' => $last_activities);
			$this->db->where('id', $event_id);
			$this->db->update('suit_filling_info', $suit_data);
		}
	}
	function getMAxRef($table = NULL, $field = NULL, $vendor_type = NULL)
	{
		$prffix = '';
		$maxlength = 9; //max length = (prefix value's +1)
		$MaxrefNo = 0;

		$str = "SELECT MAX(SUBSTRING($field," . $maxlength . ")) AS maxnum FROM $table 
				WHERE LENGTH($field)=(SELECT MAX(LENGTH($field)) FROM $table where $field LIKE '" . date('dmY') . "%') 
				AND $field LIKE '" . date('dmY') . "%' AND bill_type=" . $vendor_type . " AND sts<>0";
		$query = $this->db->query($str);

		foreach ($query->result() as $row1) {
			$MaxrefNo = $row1->maxnum;
		}
		$MaxrefNo = $MaxrefNo + 1;
		$MaxrefNo = date('dmY') . str_pad($MaxrefNo, 5, '0', STR_PAD_LEFT);
		return  $MaxrefNo;
	}
	function remove_file($Id = NULL)
	{
		$str = "Delete from temp_upload_file where Id ='" . $Id . "' and State='1'";
		$query = $this->db->query($str);
	}
	function ajaxloadfile($sessionid = NULL, $module_name = NULL, $data_field_name = NULL)
	{
		$str = "select * from temp_upload_file where Session_Id ='" . $sessionid . "' and module_name='" . $module_name . "' and data_field_name='" . $data_field_name . "' and State='1' order by Id asc";
		$query = $this->db->query($str);
		return $query->result();
	}
	function delete_statement_data($cma_id)
	{
		$str = "delete from statement_data where cma_id='" . $cma_id . "' ";
		$query = $this->db->query($str);
	}
	function delete_statement_data_by_ac($loan_ac)
	{
		$str = "delete from statement_data where loan_ac='" . $loan_ac . "'";
		$query = $this->db->query($str);
	}
	function delete_jari_statement_data_by_ac($loan_ac)
	{
		$str = "delete from jari_recovery_data_cbs where loan_ac='" . $loan_ac . "'";
		$query = $this->db->query($str);
	}
	function delete_tempfile()
	{
		$str = "select * from temp_upload_file where Session_Id='" . $this->session->userdata['ast_user']['user_id'] . "'";
		$query = $this->db->query($str);

		foreach ($query->result() as $row) {
			$path = "./temp_upload_file/" . $row->New_file_name;
			//chmod($path, 0777);
			if (file_exists($path)) {
				unlink($path);
			}
		}
		$str = "delete from temp_upload_file where Session_Id='" . $this->session->userdata['ast_user']['user_id'] . "' ";
		$query = $this->db->query($str);
	}
	function get_api_config_data($service_name, $api_name)
	{
		$str = "SELECT  j0.*
		FROM api_config j0
		WHERE j0.sts = '1' AND j0.api_type='" . $service_name . "' AND j0.api_name='" . $api_name . "' LIMIT 1";
		return $this->db->query($str)->row();
	}
	function get_narration_data()
	{
		$str = "SELECT  j0.*
		FROM ref_recovery_narration j0
		LIMIT 1";
		return $this->db->query($str)->row();
	}
	function get_pre_action_data($table_name, $id, $sts, $sts_field) // get data for edit
	{
		if ($id != '') {
			$str = " SELECT *
			FROM " . $table_name . " as f
			WHERE f.id = " . $id . "  AND f." . $sts_field . " IN(" . $sts . ") ORDER BY f.id ASC";
			$query = $this->db->query($str);
			return $query->result();
		} else {
			return NULL;
		}
	}
	function get_city_country($code, $table_name)
	{
		$this->db
			->select("b.*", FALSE)
			->from("" . $table_name . " b")
			->where("b.data_status='1' and b.code='" . $code . "'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function stringEncryption($action, $string)
	{
		$output = false;

		$encrypt_method = 'AES-256-CBC';                // Default
		$secret_key = 'Some#Random_Key!';               // Change the key!
		$secret_iv = '!IV@_$2';  // Change the init vector!

		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		if ($action == 'encrypt') {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if ($action == 'decrypt') {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}

		return $output;
	}
	function get_card_data($method, $par_1, $live_dev)
	{
		if ($method == 'GetCustomerInfoByCardNo' && $live_dev == 'liv') {
			$secound_db = $this->load->database('oracle', TRUE);

			$exist2 = $secound_db->query("SELECT X.CB_FIN_ACCTNO,
				  CB_CIF_NO  CIF_NO,
				  CB_INDIVIDUAL_ACCTNO INDIVIDUAL_ACCTNO,
				  X.cb_cardholder_no CARDHOLDER_NO,
				  --concat(concat(substr(LT_CARDHDR_NO,1,6),'******'),substr(LT_CARDHDR_NO,13,4))  CARDHOLDER_NO
				  cb_idno Customer_id,
				  CB_BASIC_SUPP_IND  BASIC_SUPPLE_IND,
				  CARD_TYPE,
				  CARD_BRAND,
				  PRODCT_GROUP,
				  PR_DESC Product_DESC,
				   CURR_CODE,
				  CB_STATUS_CD STATUS_CD,
				  cb_plastic_Cd plastic_Cd,
				  CB_BILL_CYCLE BILL_CYCLE,
				  CB_TITLE TITLE,
				  CB_CARDHOLDER_NAME CARDHOLDER_NAME,
				  FATHER_NAME,
				  nid,
				  cb_mother_name mother_name,
				  CB_SPOUSE_NAME SPOUSE_NAME,
				  cb_mobile_no mobile_no,
				  CREDIT_LIMIT,
				  OUTSTD_BAL,
				  cb_DOB  DOB,
				  cb_email email,
				  CB_EMAIL2  EMAIL2,
				  CB_EMAIL3  EMAIL3,
				  CB_SEX  gender,
				  CB_NATIONALITY NATIONALITY,
				  -----Home address---
				  CB_HOME_ADDR1  HOME_ADDR1,
				  CB_HOME_ADDR2 HOME_ADDR2,
				  CB_HOME_ADDR3 HOME_ADDR3,
				  CB_HOME_ADDR4  HOME_ADDR4,
				  CB_HOME_ADDR5  HOME_ADDR5,
				  CB_HOME_CITY  HOME_CITY,
				  CB_HOME_STATE HOME_STATE,
				  CB_HOME_CNTRY_CD HOME_CNTRY_CD,
				 CB_HOME_POSTCODE HOME_POSTCODE,
				 CB_HOME_PHONE HOME_PHONE,
				 CB_HOME_OWNERSHIP HOME_OWNERSHIP,
				 CB_HOUSE_TYPE HOUSE_TYPE,
				 ------company address------------
				 CB_CO_ADDR1 CO_ADDR1,
				 CB_CO_ADDR2 CO_ADDR2,
				 CB_CO_ADDR3 CO_ADDR3,
				 CB_CO_ADDR4 CO_ADDR4,
				 CB_CO_ADDR5 CO_ADDR5,
				 CB_CO_CITY CO_CITY,
				 CB_CO_STATE CO_STATE,
				 CB_CO_CNTRY_CD CO_CNTRY_CD,
				 CB_CO_POSTCODE CO_POSTCODE,
				 CB_CO_PHONE CO_PHONE,
				 CB_CO_FAXNO CO_FAXNO,
				 CB_CO_DESGN CO_DESGN,
				 ------------parmanent address---------------
				 CB_ALT1_BILL_ADDR1 ALT1_BILL_ADDR1,
				 CB_ALT1_BILL_ADDR2 ALT1_BILL_ADDR2,
				 CB_ALT1_BILL_ADDR3 ALT1_BILL_ADDR3,
				 CB_ALT1_BILL_ADDR4 ALT1_BILL_ADDR4,
				 CB_ALT1_BILL_ADDR5 ALT1_BILL_ADDR5,
				 CB_ALT1_BILL_CITY ALT1_BILL_CITY,
				 CB_ALT1_BILL_STATE ALT1_BILL_STATE,
				 CB_ALT1_BILL_CNTRY_CD ALT1_BILL_CNTRY_CD,
				 CB_ALT1_BILL_ADDR_POSTCODE ALT1_BILL_ADDR_POSTCODE,
				 ---------need to confirm from operation team what type of data keep below fields.----------------------
				 CB_ALT2_BILL_ADDR1 ALT2_BILL_ADDR1,
				 CB_ALT2_BILL_ADDR2 ALT2_BILL_ADDR2,
				 CB_ALT2_BILL_ADDR3 ALT2_BILL_ADDR3,
				 CB_ALT2_BILL_ADDR4 ALT2_BILL_ADDR4,
				 CB_ALT2_BILL_ADDR5 ALT2_BILL_ADDR5,
				 CB_ALT2_BILL_CITY ALT2_BILL_CITY,
				 CB_ALT2_BILL_STATE ALT2_BILL_STATE,
				 CB_ALT2_BILL_CNTRY_CD ALT2_BILL_CNTRY_CD,
				 CB_ALT2_BILL_ADDR_POSTCODE ALT2_BILL_ADDR_POSTCODE,
				  --reference information:  --reference information:
				   CB_REL_NAME   REL_NAME,
				   CB_REL_NRIC   REL_NRIC,
				   CB_REL_DOB   REL_DOB,
				   CB_REL_SEX   REL_SEX,
				   CB_REL_RELATION_TO_CH   REL_RELATION_TO_CH,
				   CB_REL_DESGN   REL_DESGN,
				   CB_REL_ADDR1   REL_ADDR1,
				   CB_REL_ADDR2   REL_ADDR2,
				   CB_REL_ADDR3   REL_ADDR3,
				   CB_REL_ADDR4   REL_ADDR4,
				   CB_REL_ADDR5   REL_ADDR5,
				   CB_REL_CITY   REL_CITY,
				   CB_REL_TELNO   REL_TELNO,
				   
				  CARD_DELIVERY_ADDR,
				  mailing_Address,
				  CB_LEGAL_ADDR_CD,
				  ISSUING_BRANCH_ID,
				   CREATION_DATE,
				   EXPIRY_DATE
				FROM
				  (SELECT C.CB_FIN_ACCTNO,
				C.CB_INDIVIDUAL_ACCTNO,
				    CB_CIF_NO,
				    cb_cardholder_no,
				    cb_idno,
				    CB_BASIC_SUPP_IND,
				    CB_PRD_CATEGORY CARD_TYPE,
				    CB_STATUS_CD,
				    cb_plastic_Cd,
				    CB_BILL_CYCLE,
				    CB_TITLE,
				    CB_CARDHOLDER_NAME,
				    CB_ADL_FIELD_NAME01 FATHER_NAME,
				    CB_ADL_FIELD_NAME02 nid,
				    cb_mother_name,
				    CB_SPOUSE_NAME,
				    cb_mobile_no,
				    CB_LINE_LIMIT CREDIT_LIMIT,
				    cb_DOB,
				    cb_email,
				    CB_EMAIL2,
				    CB_EMAIL3,
				    CB_SEX,
				    CB_NATIONALITY,
				    CB_CURMTH_PAYDUE_DATE CURMTH_PAYDUE_DATE,
				    CB_HOME_ADDR1,
				    CB_HOME_ADDR2,
				    CB_HOME_ADDR3,
				    CB_HOME_ADDR4,
				    CB_HOME_ADDR5,
				    CB_HOME_CITY,
				    CB_HOME_STATE,
				    CB_HOME_CNTRY_CD,
				    CB_HOME_POSTCODE,
				    CB_HOME_PHONE,
				    CB_HOME_OWNERSHIP,
				    CB_HOUSE_TYPE,
				    CB_CO_ADDR1,
				    CB_CO_ADDR2,
				    CB_CO_ADDR3,
				    CB_CO_ADDR4,
				    CB_CO_ADDR5,
				    CB_CO_CITY,
				    CB_CO_STATE,
				    CB_CO_CNTRY_CD,
				    CB_CO_POSTCODE,
				    CB_CO_PHONE,
				    CB_CO_FAXNO,
				    CB_CO_DESGN,
				    CB_ALT1_BILL_ADDR1,
				    CB_ALT1_BILL_ADDR2,
				    CB_ALT1_BILL_ADDR3,
				    CB_ALT1_BILL_ADDR4,
				    CB_ALT1_BILL_ADDR5,
				    CB_ALT1_BILL_CITY,
				    CB_ALT1_BILL_STATE,
				    CB_ALT1_BILL_CNTRY_CD,
				    CB_ALT1_BILL_ADDR_POSTCODE,
				    CB_ALT2_BILL_ADDR1,
				    CB_ALT2_BILL_ADDR2,
				    CB_ALT2_BILL_ADDR3,
				    CB_ALT2_BILL_ADDR4,
				    CB_ALT2_BILL_ADDR5,
				    CB_ALT2_BILL_CITY,
				    CB_ALT2_BILL_STATE,
				    CB_ALT2_BILL_CNTRY_CD,
				    CB_ALT2_BILL_ADDR_POSTCODE,
				    --reference information:
				    CB_REL_NAME,
				    CB_REL_NRIC,
				    CB_REL_DOB,
				    CB_REL_SEX,
				    CB_REL_RELATION_TO_CH,
				    CB_REL_DESGN,
				    CB_REL_ADDR1,
				    CB_REL_ADDR2,
				    CB_REL_ADDR3,
				    CB_REL_ADDR4,
				    CB_REL_ADDR5,
				    CB_REL_CITY,
				    CB_REL_TELNO,
				    CB_CARD_DELIVERY_ADDR CARD_DELIVERY_ADDR,
				    CB_BILL_ADDR_CD mailing_Address,
				    CB_LEGAL_ADDR_CD,
				    PR_CARD_BRAND CARD_BRAND,
				    E.PR_PRODCT_GROUP PRODCT_GROUP,
				    PR_DESC,
				    PR_BILL_CURR_CODE CURR_CODE,
				    CB_CENTRE_CD ISSUING_BRANCH_ID,
				    CB_APPLCATION_DATE CREATION_DATE,
				    CB_EXPIRY_CCYYMM EXPIRY_DATE
				  FROM cardpro.cp_crdtbl G,
				    cardpro.cp_csttbl a ,
				    cardpro.cp_cstadl b ,
				    cardpro.cp_indacc C,
				    CARDPRO.CP_FINTBL D,
				    cardpro.cp_prodct E,
				    cardpro.cp_prdgrp F
				  WHERE cb_idno         =a.cb_customer_idno
				  AND b.cb_customer_idno=a.cb_customer_idno
				  AND cb_cardholder_no  =cb_ind_Cardholder_no
				  AND D.CB_FIN_ACCTNO   =C.CB_FIN_ACCTNO
				  and E.PR_PRODCT_GROUP=F.PR_PRODCT_GROUP
				  and G.CB_CARD_PRDCT_GROUP=E.PR_PRODCT_GROUP
				  --AND ( (CB_cardholder_no =RPAD(#cardNo1, 19, ' ')) or (cb_idno =RPAD(#cb_idno1, 25, ' ') ) )
				 and   (CB_cardholder_no =RPAD('" . $par_1 . "', 19, ' '))

				  )X

				LEFT JOIN
				  (select CB_FIN_ACCTNO,sum(CB_OUTSTD_BAL) OUTSTD_BAL from  CARDPRO.CP_INDACC P  --@BOSDB_LINK P
				   group by CB_FIN_ACCTNO
				  )B
				ON B.CB_FIN_ACCTNO=X.CB_FIN_ACCTNO")->row();



			//print_r($exist2 );

			if (is_object($exist2)) {
				$var['CB_FIN_ACCTNO'] = $exist2->CB_FIN_ACCTNO;
				$var['CIF_NO'] = preg_replace("/\s+/", "", $exist2->CIF_NO);
				$var['INDIVIDUAL_ACCTNO'] = $exist2->INDIVIDUAL_ACCTNO;
				$var['CARDHOLDER_NO'] = $exist2->CARDHOLDER_NO;
				$var['CUSTOMER_ID'] = $exist2->CUSTOMER_ID;  //substr($exist2->DOB,0,10); 1989-10-24
				$var['BASIC_SUPPLE_IND'] = $exist2->BASIC_SUPPLE_IND;
				$var['CARD_TYPE'] = $exist2->CARD_TYPE;
				$var['CARD_BRAND'] = $exist2->CARD_BRAND;
				$var['PRODCT_GROUP'] = $exist2->PRODCT_GROUP;
				$var['PRODUCT_DESC'] = $exist2->PRODUCT_DESC;
				$var['CURR_CODE'] = $exist2->CURR_CODE;

				$var['STATUS_CD'] = $exist2->STATUS_CD;
				$var['PLASTIC_CD'] = $exist2->PLASTIC_CD;
				$var['BILL_CYCLE'] = $exist2->BILL_CYCLE;
				$var['TITLE'] = $exist2->TITLE;
				$var['CARDHOLDER_NAME'] = ucwords(strtolower($exist2->CARDHOLDER_NAME));
				$var['FATHER_NAME'] = ucwords(strtolower($exist2->FATHER_NAME));
				$var['NID'] = $exist2->NID;
				$var['MOTHER_NAME'] = ucwords(strtolower($exist2->MOTHER_NAME));
				$var['SPOUSE_NAME'] = ucwords(strtolower($exist2->SPOUSE_NAME));
				$var['MOBILE_NO'] = $exist2->MOBILE_NO;
				$var['CREDIT_LIMIT'] = $exist2->CREDIT_LIMIT;
				$var['OUTSTD_BAL'] = $exist2->OUTSTD_BAL;
				$var['DOB'] = $exist2->DOB;
				$var['EMAIL'] = $exist2->EMAIL;
				$var['EMAIL2'] = $exist2->EMAIL2;
				$var['EMAIL3'] = $exist2->EMAIL3;
				$var['GENDER'] = $exist2->GENDER;
				$var['NATIONALITY'] = $exist2->NATIONALITY;
				$var['HOME_ADDR1'] = ucwords(strtolower($exist2->HOME_ADDR1));
				$var['HOME_ADDR2'] = ucwords(strtolower($exist2->HOME_ADDR2));
				$var['HOME_ADDR3'] = ucwords(strtolower($exist2->HOME_ADDR3));
				$var['HOME_ADDR4'] = ucwords(strtolower($exist2->HOME_ADDR4));
				$var['HOME_ADDR5'] = ucwords(strtolower($exist2->HOME_ADDR5));
				$var['HOME_CITY'] = ucwords(strtolower($exist2->HOME_CITY));
				$var['HOME_STATE'] = ucwords(strtolower($exist2->HOME_STATE));
				$var['HOME_CNTRY_CD'] = ucwords(strtolower($exist2->HOME_CNTRY_CD));
				$var['CO_ADDR1'] = ucwords(strtolower($exist2->CO_ADDR1));
				$var['CO_ADDR2'] = ucwords(strtolower($exist2->CO_ADDR2));
				$var['CO_ADDR3'] = ucwords(strtolower($exist2->CO_ADDR3));
				$var['CO_ADDR4'] = ucwords(strtolower($exist2->CO_ADDR4));
				$var['CO_ADDR5'] = ucwords(strtolower($exist2->CO_ADDR5));
				$var['CO_CITY'] = ucwords(strtolower($exist2->CO_CITY));
				$var['CO_STATE'] = ucwords(strtolower($exist2->CO_STATE));
				$var['ALT1_BILL_ADDR1'] = ucwords(strtolower($exist2->ALT1_BILL_ADDR1));
				$var['ALT1_BILL_ADDR2'] = ucwords(strtolower($exist2->ALT1_BILL_ADDR2));
				$var['ALT1_BILL_ADDR3'] = ucwords(strtolower($exist2->ALT1_BILL_ADDR3));
				$var['ALT1_BILL_ADDR4'] = ucwords(strtolower($exist2->ALT1_BILL_ADDR4));
				$var['ALT1_BILL_ADDR5'] = ucwords(strtolower($exist2->ALT1_BILL_ADDR5));
				$var['ALT1_BILL_CITY'] = ucwords(strtolower($exist2->ALT1_BILL_CITY));
				$var['ALT1_BILL_STATE'] = ucwords(strtolower($exist2->ALT1_BILL_STATE));
				$var['CREATION_DATE'] = $exist2->CREATION_DATE;
				$year = substr($exist2->EXPIRY_DATE, 0, 4);
				$month = substr($exist2->EXPIRY_DATE, 4, 6);
				$date = $year . '-' . $month . '-' . '01';
				$format_dt = (explode("-", date("Y-m-t", strtotime($date))));
				$var['EXPIRY_DATE'] = $format_dt[0] . $format_dt[1] . $format_dt[2];
				$var['REL_NAME'] = ucwords(strtolower($exist2->REL_NAME));
				$var['REL_ADDR1'] = ucwords(strtolower($exist2->REL_ADDR1));
				$var['ISSUING_BRANCH_ID'] = preg_replace("/\s+/", "", $exist2->ISSUING_BRANCH_ID);
				$var['OUTSTD_BAL_DT'] = date("Ymd");
				$Message = 'ok';
			} else {
				$Message = 'Invalid Service Response:';
			}


			$var['Message'] = $Message;
			return $var;
		}
		if ($method == 'GetCustomerInfoByCardNo' && $live_dev == 'dev') {
			$var['CB_FIN_ACCTNO'] = '00000000000000243102';
			$var['CIF_NO'] = '02909790';
			$var['INDIVIDUAL_ACCTNO'] = '00000000000000148090';
			$var['CARDHOLDER_NO'] = '4321470000688936';
			$var['CUSTOMER_ID'] = '64001512700200';
			$var['BASIC_SUPPLE_IND'] = 'B';
			$var['CARD_TYPE'] = 'CONV';
			$var['CARD_BRAND'] = 'V';
			$var['PRODCT_GROUP'] = '1301';
			$var['PRODUCT_DESC'] = 'GOLD CREDIT CARD- STAFF';
			$var['CURR_CODE'] = '50';
			$var['STATUS_CD'] = '';
			$var['PLASTIC_CD'] = '';
			$var['BILL_CYCLE'] = '10';
			$var['TITLE'] = 'MR';
			$var['CARDHOLDER_NAME'] = ucwords(strtolower('SHAH MD. NAZMUS SHAKIB'));
			$var['FATHER_NAME'] = ucwords(strtolower('TAIBUR RAHMAN'));
			$var['NID'] = '19916919115000302 ';
			$var['MOTHER_NAME'] = ucwords(strtolower('UMME SALMA MOSA NAZMA SHIRIN'));
			$var['SPOUSE_NAME'] = '';
			$var['MOBILE_NO'] = '+8801787669336';
			$var['CREDIT_LIMIT'] = '100000 ';
			$var['OUTSTD_BAL'] = '-1222262983.82 ';
			$var['DOB'] = '19911125 ';
			$var['EMAIL'] = 'bbluba2020@gmail.com';
			$var['EMAIL2'] = '';
			$var['EMAIL3'] = '';
			$var['GENDER'] = 'M ';
			$var['NATIONALITY'] = 'BD';
			$var['HOME_ADDR1'] = ucwords(strtolower('93/1, GOLARTAK, MIRPUR-1'));
			$var['HOME_ADDR2'] = ucwords(strtolower('DHAKA'));
			$var['HOME_ADDR3'] = '';
			$var['HOME_ADDR4'] = '';
			$var['HOME_ADDR5'] = '';
			$var['HOME_CITY'] = ucwords(strtolower('DHAKA '));
			$var['HOME_STATE'] = ucwords(strtolower('DHAKA'));
			$var['HOME_CNTRY_CD'] = 'BD ';
			$var['HOME_POSTCODE'] = '';
			$var['HOME_PHONE'] = '';
			$var['HOME_OWNERSHIP'] = '';
			$var['HOUSE_TYPE'] = '';
			$var['CO_ADDR1'] = ucwords(strtolower('HOUSE#115, ROAD#5, BLOCK#B'));
			$var['CO_ADDR2'] = ucwords(strtolower('NIKETON SOCIETY,P.S.-GULSHAN '));
			$var['CO_ADDR3'] = 'DHAKA';
			$var['CO_ADDR4'] = '';
			$var['CO_ADDR5'] = '';
			$var['CO_CITY'] = 'DHAKA ';
			$var['CO_STATE'] = 'DHAKA ';
			$var['CO_CNTRY_CD'] = 'BD ';
			$var['CO_POSTCODE'] = '';
			$var['CO_PHONE'] = '';
			$var['CO_FAXNO'] = '';
			$var['CO_DESGN'] = 'ANALYST,APPLICATION MANAGMENT SERVICE';
			$var['ALT1_BILL_ADDR1'] = ucwords(strtolower('VILL-SATERBARIA '));
			$var['ALT1_BILL_ADDR2'] = ucwords(strtolower('P.O.-KARICHMARIA, P.S-SINGRA NATORE'));
			$var['ALT1_BILL_ADDR3'] = ucwords(strtolower('RAJSHAHI '));
			$var['ALT1_BILL_ADDR4'] = '';
			$var['ALT1_BILL_ADDR5'] = '';
			$var['ALT1_BILL_CITY'] = 'RAJSHAHI ';
			$var['ALT1_BILL_STATE'] = 'RAJSHAHI';
			$var['ALT1_BILL_CNTRY_CD'] = 'BD ';
			$var['ALT1_BILL_ADDR_POSTCODE'] = '';
			$var['ALT2_BILL_ADDR1'] = '';
			$var['ALT2_BILL_ADDR2'] = '';
			$var['ALT2_BILL_ADDR3'] = '';
			$var['ALT2_BILL_ADDR4'] = '';
			$var['ALT2_BILL_ADDR5'] = '';
			$var['ALT2_BILL_CITY'] = '';
			$var['ALT2_BILL_STATE'] = '';
			$var['ALT2_BILL_CNTRY_CD'] = 'BD ';
			$var['ALT2_BILL_ADDR_POSTCODE'] = '';
			$var['REL_NAME'] = ucwords(strtolower('RUKSAT HOSSAIN '));
			$var['REL_NRIC'] = '';
			$var['REL_DOB'] = '';
			$var['REL_SEX'] = 'M ';
			$var['REL_RELATION_TO_CH'] = '';
			$var['REL_DESGN'] = '';
			$var['REL_ADDR1'] = ucwords(strtolower('H#11,R#3,MOHAMMADPUR,DHAKA '));
			$var['REL_ADDR2'] = '';
			$var['REL_ADDR3'] = '01729295995';
			$var['REL_ADDR4'] = '';
			$var['REL_ADDR5'] = '';
			$var['REL_CITY'] = 'DHAKA ';
			$var['REL_TELNO'] = '';
			$var['CARD_DELIVERY_ADDR'] = 'C ';
			$var['MAILING_ADDRESS'] = 'C ';
			$var['CB_LEGAL_ADDR_CD'] = 'H ';
			$var['ISSUING_BRANCH_ID'] = '9099';
			$var['CREATION_DATE'] = '20150507 ';
			$var['EXPIRY_DATE'] = '20250507';
			$var['OUTSTD_BAL_DT'] = date("Ymd");
			$Message = 'ok';


			$var['Message'] = $Message;
			return $var;
		}
	}
	function get_sub_card_data($method, $par_1, $live_dev)
	{
		if ($method == 'GetCustomerSubInfoByCardNo' && $live_dev == 'liv') {
			$secound_db = $this->load->database('oracle', TRUE);

			$exist2 = $secound_db->query("SELECT CB_FIN_ACCTNO,
					  CB_CIF_NO  CIF_NO,
					  CB_INDIVIDUAL_ACCTNO INDIVIDUAL_ACCTNO,
					  X.cb_cardholder_no CARDHOLDER_NO,
					  --concat(concat(substr(LT_CARDHDR_NO,1,6),'******'),substr(LT_CARDHDR_NO,13,4))  CARDHOLDER_NO
					  cb_idno Customer_id,
	                  CB_BASIC_CARDHOLDER_NO BASIC_CARDHOLDER_NO,
					  CB_BASIC_SUPP_IND  BASIC_SUPPLE_IND,
					  CARD_TYPE,
					  CARD_BRAND,
					  PRODCT_GROUP,
					  PR_DESC Product_DESC,
					   CURR_CODE,
					  CB_STATUS_CD STATUS_CD,
					  cb_plastic_Cd plastic_Cd,
					  CB_BILL_CYCLE BILL_CYCLE,
					  CB_TITLE TITLE,
					  CB_CARDHOLDER_NAME CARDHOLDER_NAME,
					  FATHER_NAME,
					  nid,
					  cb_mother_name mother_name,
					  CB_SPOUSE_NAME SPOUSE_NAME,
					  cb_mobile_no mobile_no,
					  CB_LINE_LIMIT CREDIT_LIMIT,
					  OUTSTD_BAL,
					  cb_DOB  DOB,
					  cb_email email,
					  CB_EMAIL2  EMAIL2,
					  CB_EMAIL3  EMAIL3,
					  CB_SEX  gender,
					  CB_NATIONALITY NATIONALITY,
					  -----Home address---
					  CB_HOME_ADDR1  HOME_ADDR1,
					  CB_HOME_ADDR2 HOME_ADDR2,
					  CB_HOME_ADDR3 HOME_ADDR3,
					  CB_HOME_ADDR4  HOME_ADDR4,
					  CB_HOME_ADDR5  HOME_ADDR5,
					  CB_HOME_CITY  HOME_CITY,
					  CB_HOME_STATE HOME_STATE,
					  CB_HOME_CNTRY_CD HOME_CNTRY_CD,
					 CB_HOME_POSTCODE HOME_POSTCODE,
					 CB_HOME_PHONE HOME_PHONE,
					 CB_HOME_OWNERSHIP HOME_OWNERSHIP,
					 CB_HOUSE_TYPE HOUSE_TYPE,
					 ------company address------------
					 CB_CO_ADDR1 CO_ADDR1,
					 CB_CO_ADDR2 CO_ADDR2,
					 CB_CO_ADDR3 CO_ADDR3,
					 CB_CO_ADDR4 CO_ADDR4,
					 CB_CO_ADDR5 CO_ADDR5,
					 CB_CO_CITY CO_CITY,
					 CB_CO_STATE CO_STATE,
					 CB_CO_CNTRY_CD CO_CNTRY_CD,
					 CB_CO_POSTCODE CO_POSTCODE,
					 CB_CO_PHONE CO_PHONE,
					 CB_CO_FAXNO CO_FAXNO,
					 CB_CO_DESGN CO_DESGN,
					 ------------parmanent address---------------
					 CB_ALT1_BILL_ADDR1 ALT1_BILL_ADDR1,
					 CB_ALT1_BILL_ADDR2 ALT1_BILL_ADDR2,
					 CB_ALT1_BILL_ADDR3 ALT1_BILL_ADDR3,
					 CB_ALT1_BILL_ADDR4 ALT1_BILL_ADDR4,
					 CB_ALT1_BILL_ADDR5 ALT1_BILL_ADDR5,
					 CB_ALT1_BILL_CITY ALT1_BILL_CITY,
					 CB_ALT1_BILL_STATE ALT1_BILL_STATE,
					 CB_ALT1_BILL_CNTRY_CD ALT1_BILL_CNTRY_CD,
					 CB_ALT1_BILL_ADDR_POSTCODE ALT1_BILL_ADDR_POSTCODE,
					 ---------need to confirm from operation team what type of data keep below fields.----------------------
					 CB_ALT2_BILL_ADDR1 ALT2_BILL_ADDR1,
					 CB_ALT2_BILL_ADDR2 ALT2_BILL_ADDR2,
					 CB_ALT2_BILL_ADDR3 ALT2_BILL_ADDR3,
					 CB_ALT2_BILL_ADDR4 ALT2_BILL_ADDR4,
					 CB_ALT2_BILL_ADDR5 ALT2_BILL_ADDR5,
					 CB_ALT2_BILL_CITY ALT2_BILL_CITY,
					 CB_ALT2_BILL_STATE ALT2_BILL_STATE,
					 CB_ALT2_BILL_CNTRY_CD ALT2_BILL_CNTRY_CD,
					 CB_ALT2_BILL_ADDR_POSTCODE ALT2_BILL_ADDR_POSTCODE,
					  --reference information:  --reference information:
					   CB_REL_NAME   REL_NAME,
					   CB_REL_NRIC   REL_NRIC,
					   CB_REL_DOB   REL_DOB,
					   CB_REL_SEX   REL_SEX,
					   CB_REL_RELATION_TO_CH   REL_RELATION_TO_CH,
					   CB_REL_DESGN   REL_DESGN,
					   CB_REL_ADDR1   REL_ADDR1,
					   CB_REL_ADDR2   REL_ADDR2,
					   CB_REL_ADDR3   REL_ADDR3,
					   CB_REL_ADDR4   REL_ADDR4,
					   CB_REL_ADDR5   REL_ADDR5,
					   CB_REL_CITY   REL_CITY,
					   CB_REL_TELNO   REL_TELNO,
					   
					  CARD_DELIVERY_ADDR,
					  mailing_Address,
					  CB_LEGAL_ADDR_CD,
					  ISSUING_BRANCH_ID,
					   CREATION_DATE,
					   EXPIRY_DATE
					FROM
					  (SELECT C.CB_FIN_ACCTNO,
					G.CB_INDIVIDUAL_ACCTNO,
					    CB_CIF_NO,
					    cb_cardholder_no,
					    cb_idno,
	                    CB_BASIC_CARDHOLDER_NO,
					    CB_BASIC_SUPP_IND,
					    CB_PRD_CATEGORY CARD_TYPE,
					    CB_STATUS_CD,
					    cb_plastic_Cd,
					    CB_BILL_CYCLE,
					    CB_TITLE,
					    CB_CARDHOLDER_NAME,
					    CB_ADL_FIELD_NAME01 FATHER_NAME,
					    CB_ADL_FIELD_NAME02 nid,
					    cb_mother_name,
					    CB_SPOUSE_NAME,
					    cb_mobile_no,
					    --CB_LINE_LIMIT CREDIT_LIMIT,
					    cb_DOB,
					    cb_email,
					    CB_EMAIL2,
					    CB_EMAIL3,
					    CB_SEX,
					    CB_NATIONALITY,
					    --CB_CURMTH_PAYDUE_DATE CURMTH_PAYDUE_DATE,
					    CB_HOME_ADDR1,
					    CB_HOME_ADDR2,
					    CB_HOME_ADDR3,
					    CB_HOME_ADDR4,
					    CB_HOME_ADDR5,
					    CB_HOME_CITY,
					    CB_HOME_STATE,
					    CB_HOME_CNTRY_CD,
					    CB_HOME_POSTCODE,
					    CB_HOME_PHONE,
					    CB_HOME_OWNERSHIP,
					    CB_HOUSE_TYPE,
					    CB_CO_ADDR1,
					    CB_CO_ADDR2,
					    CB_CO_ADDR3,
					    CB_CO_ADDR4,
					    CB_CO_ADDR5,
					    CB_CO_CITY,
					    CB_CO_STATE,
					    CB_CO_CNTRY_CD,
					    CB_CO_POSTCODE,
					    CB_CO_PHONE,
					    CB_CO_FAXNO,
					    CB_CO_DESGN,
					    CB_ALT1_BILL_ADDR1,
					    CB_ALT1_BILL_ADDR2,
					    CB_ALT1_BILL_ADDR3,
					    CB_ALT1_BILL_ADDR4,
					    CB_ALT1_BILL_ADDR5,
					    CB_ALT1_BILL_CITY,
					    CB_ALT1_BILL_STATE,
					    CB_ALT1_BILL_CNTRY_CD,
					    CB_ALT1_BILL_ADDR_POSTCODE,
					    CB_ALT2_BILL_ADDR1,
					    CB_ALT2_BILL_ADDR2,
					    CB_ALT2_BILL_ADDR3,
					    CB_ALT2_BILL_ADDR4,
					    CB_ALT2_BILL_ADDR5,
					    CB_ALT2_BILL_CITY,
					    CB_ALT2_BILL_STATE,
					    CB_ALT2_BILL_CNTRY_CD,
					    CB_ALT2_BILL_ADDR_POSTCODE,
					    --reference information:
					    CB_REL_NAME,
					    CB_REL_NRIC,
					    CB_REL_DOB,
					    CB_REL_SEX,
					    CB_REL_RELATION_TO_CH,
					    CB_REL_DESGN,
					    CB_REL_ADDR1,
					    CB_REL_ADDR2,
					    CB_REL_ADDR3,
					    CB_REL_ADDR4,
					    CB_REL_ADDR5,
					    CB_REL_CITY,
					    CB_REL_TELNO,
					    CB_CARD_DELIVERY_ADDR CARD_DELIVERY_ADDR,
					    CB_BILL_ADDR_CD mailing_Address,
					    CB_LEGAL_ADDR_CD,
					    PR_CARD_BRAND CARD_BRAND,
					    E.PR_PRODCT_GROUP PRODCT_GROUP,
					    PR_DESC,
					    PR_BILL_CURR_CODE CURR_CODE,
					    CB_CENTRE_CD ISSUING_BRANCH_ID,
					    CB_APPLCATION_DATE CREATION_DATE,
					    CB_EXPIRY_CCYYMM EXPIRY_DATE,
	                    CB_OUTSTD_BAL OUTSTD_BAL,CB_LINE_LIMIT ,CB_CURMTH_PAYDUE_DATE CURMTH_PAYDUE_DATE
					  FROM cardpro.cp_crdtbl G,
					    cardpro.cp_csttbl a ,
					    cardpro.cp_cstadl b ,
					    cardpro.cp_indacc C,
					    CARDPRO.CP_FINTBL D,
					    cardpro.cp_prodct E,
					    cardpro.cp_prdgrp F
					  WHERE cb_idno         =a.cb_customer_idno
					  AND b.cb_customer_idno=a.cb_customer_idno
					  AND cb_cardholder_no  =cb_ind_Cardholder_no
					  AND D.CB_FIN_ACCTNO   =C.CB_FIN_ACCTNO
					  and E.PR_PRODCT_GROUP=F.PR_PRODCT_GROUP
					  and G.CB_CARD_PRDCT_GROUP=E.PR_PRODCT_GROUP
					  and  CB_BASIC_CUSTOMER_IDNO in (select CB_BASIC_CUSTOMER_IDNO from cardpro.cp_crdtbl  
	                        where ( (CB_cardholder_no =RPAD('" . $par_1 . "', 19, ' ')) or (cb_idno =RPAD('', 25, ' ') ) )) 
	              
					  )X ORDER BY BASIC_SUPPLE_IND ASC")->result();
			if (!empty($exist2)) {
				$var['row_info'] = $exist2;
				$Message = 'ok';
			} else {
				$Message = 'Invalid Service Response:';
			}
			$var['Message'] = $Message;
			return $var;
		}
		if ($method == 'GetCustomerSubInfoByCardNo' && $live_dev == 'dev') {
			$obj[0] = (object) array(
				'CB_FIN_ACCTNO' => ' 00000000000000551753',
				'CIF_NO' => ' 03531077',
				'INDIVIDUAL_ACCTNO' => ' 00000000000000374126',
				'CARDHOLDER_NO' => ' 5488950214164697',
				'CUSTOMER_ID' => ' 18502225600210',
				'BASIC_CARDHOLDER_NO' => '1111111111111111',
				'BASIC_SUPPLE_IND' => ' B',
				'CARD_TYPE' => ' CONV',
				'CARD_BRAND' => ' M',
				'PRODCT_GROUP' => ' 1850',
				'PRODUCT_DESC' => ' MASTERCARD MILLENNIAL CREDIT CARD',
				'CURR_CODE' => ' 50',
				'STATUS_CD' => '  ',
				'PLASTIC_CD' => ' U',
				'BILL_CYCLE' => ' 23',
				'TITLE' => ' MR',
				'CARDHOLDER_NAME' => ' MD NUR JAMAL',
				'FATHER_NAME' => ' MD ANOWAR RAHMAN',
				'NID' => ' 19917311519000047',
				'MOTHER_NAME' => ' MST NURINA',
				'SPOUSE_NAME' => ' ',
				'MOBILE_NO' => ' 01744604869',
				'CREDIT_LIMIT' => ' 500000',
				'OUTSTD_BAL' => ' 1725',
				'DOB' => ' 19911212',
				'EMAIL' => ' ISLAMNURJAMAL191@GMAIL.COM',
				'EMAIL2' => '',
				'EMAIL3' => '',
				'GENDER' => ' M',
				'NATIONALITY' => ' BD',
				'HOME_ADDR1' => ' C/O SULTAN UDDIN GF',
				'HOME_ADDR2' => ' BEGUN BARI AREA,POKEWYA WEST KHONDO',
				'HOME_ADDR3' => ' SREEPUR POWROSOVA',
				'HOME_ADDR4' => ' GAZIPUR',
				'HOME_ADDR5' => '',
				'HOME_CITY' => ' DHAKA ',
				'HOME_STATE' => ' DHAKA',
				'HOME_CNTRY_CD' => ' BD',
				'HOME_POSTCODE' => ' ',
				'HOME_PHONE' => ' ',
				'HOME_OWNERSHIP' => ' R',
				'HOUSE_TYPE' => ' ',
				'CO_ADDR1' => ' GAZIPUR DEPOT',
				'CO_ADDR2' => ' ZISKA PHARMA LTD CHABAGAN ',
				'CO_ADDR3' => ' JOYDEBPUR ',
				'CO_ADDR4' => ' GAZIPUR ',
				'CO_ADDR5' => '   ',
				'CO_CITY' => ' DHAKA ',
				'CO_STATE' => ' DHAKA ',
				'CO_CNTRY_CD' => ' BD',
				'CO_POSTCODE' => '  ',
				'CO_PHONE' => ' ',
				'CO_FAXNO' => ' ',
				'CO_DESGN' => ' AREA MANAGER,SALES',
				'ALT1_BILL_ADDR1' => ' NIJ VOGHDABURI CHILAHATI   ',
				'ALT1_BILL_ADDR2' => ' W-4, DOMAR ',
				'ALT1_BILL_ADDR3' => ' NILPHAMARI  ',
				'ALT1_BILL_ADDR4' => '   ',
				'ALT1_BILL_ADDR5' => '  ',
				'ALT1_BILL_CITY' => ' RANGPUR',
				'ALT1_BILL_STATE' => ' RANGPUR ',
				'ALT1_BILL_CNTRY_CD' => ' BD',
				'ALT1_BILL_ADDR_POSTCODE' => ' ',
				'ALT2_BILL_ADDR1' => ' 9099 ',
				'ALT2_BILL_ADDR2' => ' ',
				'ALT2_BILL_ADDR3' => ' ',
				'ALT2_BILL_ADDR4' => ' ',
				'ALT2_BILL_ADDR5' => ' ',
				'ALT2_BILL_CITY' => '  ',
				'ALT2_BILL_STATE' => ' ',
				'ALT2_BILL_CNTRY_CD' => ' BD',
				'ALT2_BILL_ADDR_POSTCODE' => '    ',
				'REL_NAME' => ' KHAIRUL ',
				'REL_NRIC' => '   ',
				'REL_DOB' => ' 0  ',
				'REL_SEX' => ' M',
				'REL_RELATION_TO_CH' => ' R',
				'REL_DESGN' => '     ',
				'REL_ADDR1' => ' ZISKA PHARMA LTD ',
				'REL_ADDR2' => '          ',
				'REL_ADDR3' => ' 01313359905 ',
				'REL_ADDR4' => '     ',
				'REL_ADDR5' => '     ',
				'REL_CITY' => ' DHAKA ',
				'REL_TELNO' => '    ',
				'CARD_DELIVERY_ADDR' => ' C',
				'MAILING_ADDRESS' => ' C',
				'CB_LEGAL_ADDR_CD' => ' H',
				'ISSUING_BRANCH_ID' => ' 1202 ',
				'CREATION_DATE' => ' 20220914',
				'EXPIRY_DATE' => ' 202709'
			);



			$obj[1] = (object) array(
				'CB_FIN_ACCTNO' => ' 00000000000000551753',
				'CIF_NO' => ' 03531077',
				'INDIVIDUAL_ACCTNO' => ' 00000000000000374126',
				'CARDHOLDER_NO' => ' 5488950210504425',
				'CUSTOMER_ID' => ' 18502225600210',
				'BASIC_CARDHOLDER_NO' => '1111111111111111',
				'BASIC_SUPPLE_IND' => ' S',
				'CARD_TYPE' => ' CONV',
				'CARD_BRAND' => ' M',
				'PRODCT_GROUP' => ' 1850',
				'PRODUCT_DESC' => ' MASTERCARD MILLENNIAL CREDIT CARD',
				'CURR_CODE' => ' 50',
				'STATUS_CD' => '  ',
				'PLASTIC_CD' => ' U',
				'BILL_CYCLE' => ' 23',
				'TITLE' => ' MR',
				'CARDHOLDER_NAME' => ' MD NUR JAMAL',
				'FATHER_NAME' => ' MD ANOWAR RAHMAN',
				'NID' => ' 19917311519000047',
				'MOTHER_NAME' => ' MST NURINA',
				'SPOUSE_NAME' => ' ',
				'MOBILE_NO' => ' 01744604869',
				'CREDIT_LIMIT' => ' 500000',
				'OUTSTD_BAL' => ' 1725',
				'DOB' => ' 19911212',
				'EMAIL' => ' ISLAMNURJAMAL191@GMAIL.COM',
				'EMAIL2' => '',
				'EMAIL3' => '',
				'GENDER' => ' M',
				'NATIONALITY' => ' BD',
				'HOME_ADDR1' => ' C/O SULTAN UDDIN GF',
				'HOME_ADDR2' => ' BEGUN BARI AREA,POKEWYA WEST KHONDO',
				'HOME_ADDR3' => ' SREEPUR POWROSOVA',
				'HOME_ADDR4' => ' GAZIPUR',
				'HOME_ADDR5' => '',
				'HOME_CITY' => ' DHAKA ',
				'HOME_STATE' => ' DHAKA',
				'HOME_CNTRY_CD' => ' BD',
				'HOME_POSTCODE' => ' ',
				'HOME_PHONE' => ' ',
				'HOME_OWNERSHIP' => ' R',
				'HOUSE_TYPE' => ' ',
				'CO_ADDR1' => ' GAZIPUR DEPOT',
				'CO_ADDR2' => ' ZISKA PHARMA LTD CHABAGAN ',
				'CO_ADDR3' => ' JOYDEBPUR ',
				'CO_ADDR4' => ' GAZIPUR ',
				'CO_ADDR5' => '   ',
				'CO_CITY' => ' DHAKA ',
				'CO_STATE' => ' DHAKA ',
				'CO_CNTRY_CD' => ' BD',
				'CO_POSTCODE' => '  ',
				'CO_PHONE' => ' ',
				'CO_FAXNO' => ' ',
				'CO_DESGN' => ' AREA MANAGER,SALES',
				'ALT1_BILL_ADDR1' => ' NIJ VOGHDABURI CHILAHATI   ',
				'ALT1_BILL_ADDR2' => ' W-4, DOMAR ',
				'ALT1_BILL_ADDR3' => ' NILPHAMARI  ',
				'ALT1_BILL_ADDR4' => '   ',
				'ALT1_BILL_ADDR5' => '  ',
				'ALT1_BILL_CITY' => ' RANGPUR',
				'ALT1_BILL_STATE' => ' RANGPUR ',
				'ALT1_BILL_CNTRY_CD' => ' BD',
				'ALT1_BILL_ADDR_POSTCODE' => ' ',
				'ALT2_BILL_ADDR1' => ' 9099 ',
				'ALT2_BILL_ADDR2' => ' ',
				'ALT2_BILL_ADDR3' => ' ',
				'ALT2_BILL_ADDR4' => ' ',
				'ALT2_BILL_ADDR5' => ' ',
				'ALT2_BILL_CITY' => '  ',
				'ALT2_BILL_STATE' => ' ',
				'ALT2_BILL_CNTRY_CD' => ' BD',
				'ALT2_BILL_ADDR_POSTCODE' => '    ',
				'REL_NAME' => ' KHAIRUL ',
				'REL_NRIC' => '   ',
				'REL_DOB' => ' 0  ',
				'REL_SEX' => ' M',
				'REL_RELATION_TO_CH' => ' R',
				'REL_DESGN' => '     ',
				'REL_ADDR1' => ' ZISKA PHARMA LTD ',
				'REL_ADDR2' => '          ',
				'REL_ADDR3' => ' 01313359905 ',
				'REL_ADDR4' => '     ',
				'REL_ADDR5' => '     ',
				'REL_CITY' => ' DHAKA ',
				'REL_TELNO' => '    ',
				'CARD_DELIVERY_ADDR' => ' C',
				'MAILING_ADDRESS' => ' C',
				'CB_LEGAL_ADDR_CD' => ' H',
				'ISSUING_BRANCH_ID' => ' 1202 ',
				'CREATION_DATE' => ' 20220914',
				'EXPIRY_DATE' => ' 202709'
			);

			$Message = 'ok';

			$var['row_info'] = $obj;
			$var['Message'] = $Message;
			return $var;
		}
	}
	function client_info()
	{
		$this->db
			->select("* ", FALSE)
			->from('b2_client_info')
			->where("sts='1' and zone_id='" . $this->session->userdata['user']['user_zone_id'] . "'", NULL, FALSE);
		$data = $this->db->get()->row();
		return $data;
	}
	function bbank_info()
	{
		$this->db
			->select("* ", FALSE)
			->from('b2_binfo')
			->where("sts='1' and zone_id='" . $this->session->userdata['user']['user_zone_id'] . "'", NULL, FALSE);
		$data = $this->db->get()->row();
		return $data;
	}
	function spcategory_info($id = 0)
	{
		$this->db
			->select("* ", FALSE)
			->from('b2_sp_category')
			->where("sts='1' and id='" . $id . "'", NULL, FALSE);
		$data = $this->db->get()->row();
		return $data;
	}
	function get_user_stock($workas = NULL, $stocktype = NULL, $prefix = 'sb')
	{
		$query = " and " . $prefix . ".zone_id='" . $this->session->userdata['user']['user_zone_id'] . "' ";

		if ($stocktype == 'Zone') {
			$query .= " and " . $prefix . ".transfer_sts='0'";
		} elseif ($workas == 'Branch' && $stocktype == 'Self') {
			$query .= " and " . $prefix . ".transfer_branch_id='" . $this->session->userdata['user']['user_branch_id'] . "' and " . $prefix . ".transfer_sts='1'";
		} elseif ($workas == 'Branch' && $stocktype == 'Sub-Zone') {
			$query .= " and " . $prefix . ".transfer_branch_id='" . $this->session->userdata['user']['user_sub_zone_br_id'] . "' and " . $prefix . ".transfer_sts='1'";
		}

		return $query;
	}
	function get_parameter_data_combo($table, $select = NULL, $orderby = NULL, $where = NULL, $keyfield = NULL, $valuefield = NULL, $fristrow = 1, $fkeyfield = NULL, $fvaluefield = NULL)
	{
		$this->db->select($select, FALSE);
		$this->db->from($table);
		if (!empty($where)) $this->db->where($where, NULL, FALSE);
		$this->db->order_by($orderby);
		$q = $this->db->get();
		$option = array();
		if ($fristrow == 1) {
			$option[$fkeyfield] = $fvaluefield;
		}
		foreach ($q->result() as $row) {
			$option[$row->$keyfield] = $row->$valuefield;
		}
		return $option;
	}
	function get_parameter_data_combo_arr($table, $select = NULL, $orderby = NULL, $where = NULL)
	{
		$this->db->select($select, FALSE);
		$this->db->from($table);
		if (!empty($where)) $this->db->where($where, NULL, FALSE);
		$this->db->order_by($orderby);
		$q = $this->db->get();

		return $q->result();
	}
	function getdateformat($date = NULL)
	{
		if (!empty($date)) {
			$var = "";
			$var = explode('/', $date);
			if (count($var) == 3) {
				$returndate = $var[2] . "-" . $var[1] . "-" . $var[0];
				return $returndate;
			} else {
				$var = explode('-', $date);
				if (count($var) > 0) {
					return $date;
				}
			}
		}
	}

	function getMAxRef_stock_______($table = NULL, $catid = NULL, $typeid = NULL, $field = NULL)
	{
		$prffix = '';
		$maxlength = 0;
		$str1 = "select * from b2_referencenumberformat where ref_type='$typeid' and 
		cat_id='" . $catid . "' and sts='1' and zone_id='" . $this->session->userdata['user']['user_zone_id'] . "' limit 1";
		$query = $this->db->query($str1);
		foreach ($query->result() as $row) {
			$prffix = $row->ref_prefix;
			$maxlength = $row->max_len;
		}
		$MaxrefNo = 0;

		$str = "SELECT MAX(SUBSTRING($field," . $maxlength . ")) AS maxnum FROM $table 
				WHERE LENGTH($field)=(SELECT MAX(LENGTH($field)) FROM $table where $field LIKE '" . $prffix . date('Y/') . "%' and StockId='" . $this->session->userdata['user']['user_zone_id'] . "') 
				AND $field LIKE '" . $prffix . date('Y/') . "%' and StockId='" . $this->session->userdata['user']['user_zone_id'] . "'";
		$query = $this->db->query($str);

		foreach ($query->result() as $row1) {
			$MaxrefNo = $row1->maxnum;
		}
		$MaxrefNo = $MaxrefNo + 1;
		$MaxrefNo = $prffix . date('Y/') . str_pad($MaxrefNo, 4, 0, STR_PAD_LEFT);
		return  $MaxrefNo;
	}

	function getMAxRef_stock($table = NULL, $catid = NULL, $typeid = NULL, $field = NULL)
	{
		$prffix = '';
		$maxlength = 0;
		$str1 = "select * from b2_referencenumberformat where ref_type='$typeid' and 
		cat_id='" . $catid . "' and sts='1' and zone_id='" . $this->session->userdata['user']['user_zone_id'] . "' limit 1";
		$query = $this->db->query($str1);
		foreach ($query->result() as $row) {
			$prffix = $row->ref_prefix;
			$maxlength = $row->max_len;
		}
		$MaxrefNo = 0;

		$str = "SELECT MAX(SUBSTRING($field," . $maxlength . ",4)) AS maxnum FROM $table 
				WHERE LENGTH($field)=(SELECT MAX(LENGTH($field)) FROM $table where $field LIKE '" . $prffix . "%" . date('Y') . "' and StockId='" . $this->session->userdata['user']['user_zone_id'] . "') 
				AND $field LIKE '" . $prffix . "%" . date('Y') . "' and StockId='" . $this->session->userdata['user']['user_zone_id'] . "'";
		$query = $this->db->query($str);

		foreach ($query->result() as $row1) {
			$MaxrefNo = $row1->maxnum;
		}
		$MaxrefNo = $MaxrefNo + 1;
		if ($MaxrefNo < 10) {
			$MaxrefNo = '00' . $MaxrefNo;
		} else if ($MaxrefNo < 100) {
			$MaxrefNo = '0' . $MaxrefNo;
		}
		$MaxrefNo = $prffix . $MaxrefNo . date('/Y');
		// echo $MaxrefNo; exit;
		return  $MaxrefNo;
	}

	function getMAxRef_dupplicate_issue($table = NULL, $catid = NULL, $typeid = NULL, $field = NULL)
	{
		$prffix = '';
		$maxlength = 0;
		$str1 = "select * from b2_referencenumberformat where ref_type='$typeid' and 
		cat_id='" . $catid . "' and sts='1' and zone_id='" . $this->session->userdata['user']['user_zone_id'] . "' limit 1";
		$query = $this->db->query($str1);
		foreach ($query->result() as $row) {
			$prffix = $row->ref_prefix;
			$maxlength = $row->max_len;
		}
		$MaxrefNo = 0;

		$str = "SELECT MAX(SUBSTRING($field," . $maxlength . ",3)) AS maxnum FROM $table 
				WHERE LENGTH($field)=(SELECT MAX(LENGTH($field)) FROM $table where $field LIKE '" . $prffix . "%" . date('Y') . "' and zone_id='" . $this->session->userdata['user']['user_zone_id'] . "') 
				AND $field LIKE '" . $prffix . "%" . date('Y') . "' and zone_id='" . $this->session->userdata['user']['user_zone_id'] . "'";
		$query = $this->db->query($str);

		foreach ($query->result() as $row1) {
			$MaxrefNo = $row1->maxnum;
		}
		$MaxrefNo = $MaxrefNo + 1;
		if ($MaxrefNo < 10) {
			$MaxrefNo = '00' . $MaxrefNo;
		} else if ($MaxrefNo < 100) {
			$MaxrefNo = '0' . $MaxrefNo;
		}
		$MaxrefNo = $prffix . $MaxrefNo . date('/Y');
		// echo $MaxrefNo; exit;
		return  $MaxrefNo;
	}

	function getMAxRef_purchase_certificate($table = NULL, $catid = NULL, $typeid = NULL, $field = NULL, $requested_branch_id = 0)
	{
		$prffix = '';
		$maxlength = 0;
		$str1 = "select * from b2_referencenumberformat where ref_type='$typeid' and 
		cat_id='" . $catid . "' and sts='1' and zone_id='" . $this->session->userdata['user']['user_zone_id'] . "' limit 1";
		$query = $this->db->query($str1);
		foreach ($query->result() as $row) {
			$prffix = $row->ref_prefix;
			$maxlength = $row->max_len;
		}
		$MaxrefNo = 0;


		$str = "SELECT MAX(SUBSTRING($field," . $maxlength . ",3)) AS maxnum FROM $table 
				WHERE LENGTH($field)=(SELECT MAX(LENGTH($field)) FROM $table where $field LIKE '" . $prffix . "%" . date('Y') . "' and StockId='" . $this->session->userdata['user']['user_zone_id'] . "') 
				AND $field LIKE '" . $prffix . "%" . date('Y') . "' and StockId='" . $this->session->userdata['user']['user_zone_id'] . "'";
		$query = $this->db->query($str);

		foreach ($query->result() as $row1) {
			$MaxrefNo = $row1->maxnum;
		}
		$MaxrefNo = $MaxrefNo + 1;
		if ($MaxrefNo < 10) {
			$MaxrefNo = '00' . $MaxrefNo;
		} else if ($MaxrefNo < 100) {
			$MaxrefNo = '0' . $MaxrefNo;
		}
		$MaxrefNo = $prffix . $MaxrefNo . date('/Y');
		// echo $MaxrefNo; exit;
		return  $MaxrefNo;
	}

	function getMAxRefStockRequisition($table = NULL, $catid = NULL, $typeid = NULL, $field = NULL)
	{
		$prffix = '';
		$maxlength = 0;
		$str1 = "select * from b2_referencenumberformat where ref_type='$typeid' and 
		cat_id='$catid' and sts='1' and zone_id='" . $this->session->userdata['user']['user_zone_id'] . "' limit 1";
		$query = $this->db->query($str1);
		foreach ($query->result() as $row) {
			$prffix = $row->ref_prefix;
			$maxlength = $row->max_len;
		}
		$MaxrefNo = 0;

		$str = "SELECT MAX(SUBSTRING($field," . $maxlength . ",3)) AS maxnum FROM $table 
				WHERE LENGTH($field)=(SELECT MAX(LENGTH($field)) FROM $table where $field LIKE '" . $prffix . "%" . date('Y') . "' and zone_id='" . $this->session->userdata['user']['user_zone_id'] . "') 
				AND $field LIKE '" . $prffix . "%" . date('Y') . "' and zone_id='" . $this->session->userdata['user']['user_zone_id'] . "'";
		$query = $this->db->query($str);

		foreach ($query->result() as $row1) {
			$MaxrefNo = $row1->maxnum;
		}
		$MaxrefNo = $MaxrefNo + 1;
		if ($MaxrefNo < 10) {
			$MaxrefNo = '00' . $MaxrefNo;
		} else if ($MaxrefNo < 100) {
			$MaxrefNo = '0' . $MaxrefNo;
		}
		$MaxrefNo = $prffix . $MaxrefNo . date('/Y');
		// echo $MaxrefNo; exit;
		return  $MaxrefNo;
	}

	function get_where_data($table_name, $where)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($where);
		$res = $this->db->get();
		$result = $res->result();
		return $result;
	}
	function get_row_data($table_name, $where)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($where);
		$res = $this->db->get();
		$result = $res->row();
		return $result;
	}

	function getAcLength()
	{

		$this->db->select("loan_ac_length", false)
			->limit(1);
		$result = $this->db->get('project_info')->row();
		if ($result->loan_ac_length) {
			return $result->loan_ac_length;
		} else {
			return "13,16";
		}
	}
}
