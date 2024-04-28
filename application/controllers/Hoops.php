<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hoops extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Hoops_model', '', TRUE);
		$this->load->model('Cma_process_model', '', TRUE);
		$this->load->model('Cma_ho_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat)
	{
		$data = array(
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'req_type' => $this->user_model->get_parameter_data('ref_req_type','id','data_status = 1'),
			'loan_segment' => $this->user_model->get_parameter_data('ref_loan_segment','id','data_status = 1'),

			'pages'=> 'hoops/pages/grid',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function jari_view ($menu_group,$menu_cat)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'hoops/pages/jari_grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}

	function grid()
	{
		$this->load->model('Hoops_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Hoops_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function get_dropdown_data()
    {
    	$csrf_token = $this->security->get_csrf_hash();
    	$legal_region = $this->input->post('legal_region');
    	$link_id='227';
		$legal_user=$this->User_info_model->get_checker_data($link_id,'1,2',"FIND_IN_SET(".$legal_region.",legal_region)");
        $condition=" AND region = ".$this->db->escape($legal_region);
    	$table='ref_legal_district';
    	$legal_district=$this->User_model->get_parameter_data($table,'name',"data_status = '1' ".$condition." ");
        $jTableResult = array();
        if ($legal_user != null) {
            $jTableResult['status'] = "success";
            $jTableResult['legal_user'] = $legal_user;
            $jTableResult['legal_district'] = $legal_district;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['legal_user'] = array();
            $jTableResult['legal_district'] = array();
        }
        $jTableResult['csrf_token'] = $csrf_token;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }
	function fileprocessing($id=NULL,$editrow=NULL,$proposed_type=NULL)
	{
		$this->Common_model->delete_tempfile();
		$link_id='227';
		if ($proposed_type==1) {
			$type='Loan';
		}else{$type='Card';}
		$result = $this->Cma_process_model->get_recommend_info($id);
		if ($result->proposed_type=='Loan') {
			$facility_info = $this->Cma_ho_model->get_facility($id);
		}
		else{
			$facility_info = $this->Cma_ho_model->get_card_facility($id);
		}
		
		$checker_info = $this->User_info_model->get_checker_data($link_id,'2',"FIND_IN_SET(".$result->legal_region.",legal_region)");
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'id' => $id,
				   'checker_info' => $checker_info,
				   'facility_info' => $facility_info,
				   'proposed_type' => $type,
				   'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
				   'pages'=> 'hoops/pages/file_processing_form',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('hoops/form_layout',$data);
	}
	function generate_statement($menu_group, $menu_cat)
	{
		$dropdown_list = array(
                'hoops/generate_statement' => 'Generate Statement',
               'hoops/upload_recovery' => 'Upload Recovery',
               'hoops/update_recovery' => 'Delete Recovery Batch'
			);
		$dropdown_select = 'hoops/generate_statement';
		$result = array();
		$data = array(
                'menu_group' => $menu_group,
                'menu_cat' => $menu_cat,
                'dropdown_list' => $dropdown_list,
                'dropdown_select' => $dropdown_select,
                'result' => $result,
                'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
                'pages' => 'hoops/pages/statement_view',
                'option' => 'generate_statement'
            );
            $this->load->view('grid_layout',$data);
	}
	function upload_recovery($menu_group, $menu_cat)
	{
		$dropdown_list = array(
                'hoops/generate_statement' => 'Generate Statement',
               'hoops/upload_recovery' => 'Upload Recovery',
               'hoops/update_recovery' => 'Delete Recovery Batch'
			);
		$dropdown_select = 'hoops/upload_recovery';
		$result = array();
		$data = array(
                'menu_group' => $menu_group,
                'menu_cat' => $menu_cat,
                'dropdown_list' => $dropdown_list,
                'dropdown_select' => $dropdown_select,
                'result' => $result,
                'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
                'pages' => 'hoops/pages/statement_view',
                'option' => 'upload_recovery'
            );
            $this->load->view('grid_layout',$data);
	}
	function update_recovery($menu_group, $menu_cat)
	{
		$dropdown_list = array(
                'hoops/generate_statement' => 'Generate Statement',
               'hoops/upload_recovery' => 'Upload Recovery',
               'hoops/update_recovery' => 'Delete Recovery Batch'
			);
		$dropdown_select = 'hoops/update_recovery';
		$result = array();
		$data = array(
                'menu_group' => $menu_group,
                'menu_cat' => $menu_cat,
                'dropdown_list' => $dropdown_list,
                'dropdown_select' => $dropdown_select,
                'result' => $result,
                'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
                'pages' => 'hoops/pages/statement_view',
                'option' => 'update_recovery'
            );
            $this->load->view('grid_layout',$data);
	}
	function load_statement_by_id_loan()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$dt_from = implode('-',explode('/',$this->input->post('dt_from')));
		$dt_to = implode('-',explode('/',$this->input->post('dt_to')));
		$str = '';
		$liv_dev = config_item('statement_liv_dev');
		$write_off_sts = 0;
		$mbs_ac = '';
		$type='';
		$int_rate = 0;
		$glob_sts = 0;
		$data_status = 1;
		$glob_ac = '';
		$mbs_results = array();
		$str="SELECT  j0.int_rate,j0.ac_number
		                 FROM cma_facility j0
		                 WHERE j0.id=".$this->db->escape($id)." LIMIT 1";
		$application_data=$this->db->query($str)->row();
		$loan_ac = $application_data->ac_number;
		$int_rate = $application_data->int_rate;
		$this->Common_model->delete_statement_data_by_ac($loan_ac);
		$data_status=1;
		if ($data_status==1) 
		{
			$mbs_ac = $this->Common_model->get_mbs_ac($loan_ac,$liv_dev);
			if ($mbs_ac!='') {
				$mbs_results = $this->Common_model->get_mbs_stmt($mbs_ac,date("d-M-Y",strtotime($dt_from)),date("d-M-Y",strtotime($dt_to)),$liv_dev);
			}
			$data=array();
			$word = "WRITEOFF";//For Check Write off done 
			if (!empty($mbs_results)) 
			{
				for ($i=1; $i <=count($mbs_results) ; $i++) { 
					if ($mbs_results[$i]['atotransdate']!='') {
						//$dd=explode("-",trim($mbs_results[$i]['atotransdate']));
					    //$d=$dd[2].'-'.$dd[0].'-'.$dd[1];
					    $d = $mbs_results[$i]['atotransdate'];
						if ($mbs_results[$i]['dr']!='' && $mbs_results[$i]['dr']>0) {
							$withdraw = $mbs_results[$i]['dr'];
							$deposit = 0.00;
							$type = 'w';
						}else
						{
							$deposit = $mbs_results[$i]['cr'];
							$withdraw = 0.00;
							$type = 'd';
						}
						$array = array(
				            'date'=>$d,
				            'glob_sts'=>$glob_sts,
				            'particulars'=>$mbs_results[$i]['part'],
				            'withdraw_amount'=>$withdraw,
				            'deposit_amount'=>$deposit,
				            'Session_Id'=> $this->session->userdata['ast_user']['user_id'],
				            'source' => 'mbs',
				            'type' => $type,
				            'w_off_sts' => $write_off_sts
				            );
						$array['loan_ac'] = $loan_ac;
						 array_push($data,$array);
					}
				}
				$this->db->insert_batch('statement_data', $data);
			}
			$xcrv_results = $this->Common_model->get_xcrv_stmt($loan_ac,date("d-M-Y",strtotime($dt_from)),date("d-M-Y",strtotime($dt_to)),$liv_dev);
			if (!empty($xcrv_results)) 
			{
				$data=array();
				$word = "WRITEOFF";//For Check Write off done 
				for ($i=1; $i <=count($xcrv_results) ; $i++) { 
					if ($xcrv_results[$i]['VALUE_DATE']!='') {
						$dd=explode("-",trim($xcrv_results[$i]['VALUE_DATE']));
				    	$d=$dd[2].'-'.$dd[1].'-'.$dd[0];
						if ($xcrv_results[$i]['WITHDRAW']!='' && $xcrv_results[$i]['WITHDRAW']>0) {
							$withdraw = $xcrv_results[$i]['WITHDRAW'];
							$deposit = 0.00;
							$type = 'w';
						}else
						{
							$deposit = $xcrv_results[$i]['DEPOSIT'];
							$withdraw = 0.00;
							$type = 'd';
						}
						$array = array(
				            'glob_sts'=>$glob_sts,
				            'date'=>$d,
				            'particulars'=>$xcrv_results[$i]['TRAN_PARTICULAR'],
				            'withdraw_amount'=>$withdraw,
				            'deposit_amount'=>$deposit,
				            'Session_Id'=> $this->session->userdata['ast_user']['user_id'],
				            'source' => 'xcrv',
				            'type' => $type,
				            'w_off_sts' => $write_off_sts
				            );
						$array['loan_ac'] = $loan_ac;
					}
				}
				$this->db->insert_batch('statement_data', $data);
			}
			$str='ok';
		}
		else
		{
			$str = 'Sorry No Data found !!';
		}

		$var =array(
		"str"=>$str,
		"id"=>$id,
		"int_rate"=>$int_rate,
		"csrf_token"=>$csrf_token
		);
		echo json_encode($var);
	}
	function load_statement_by_id_card()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$str = '';
		$liv_dev = config_item('statement_liv_dev');
		$write_off_sts = 0;
		$mbs_ac = '';
		$type='';
		$int_rate = 0;
		$glob_sts = 0;
		$data_status = 1;
		$glob_ac = '';
		$mbs_results = array();
		$str="SELECT  j0.card_no,j0.org_card_no
		                 FROM sub_card_data j0
		                 WHERE j0.id=".$this->db->escape($id)." LIMIT 1";
		$application_data=$this->db->query($str)->row();
		$loan_ac = $application_data->card_no;
		$org_card_no = $application_data->org_card_no;
		$this->Common_model->delete_statement_data_by_ac($org_card_no);//Delete statement Data
		$data_status=1;
		if ($data_status==1) 
		{
			$loan_ac=$this->Common_model->stringEncryption('decrypt',$org_card_no);
			$results = $this->Common_model->get_card_stmt($loan_ac,date("d-M-Y"),date("d-M-Y"),$liv_dev);
			$data=array();
			$word = "WRITEOFF";//For Check Write off done 
			if (!empty($results)) 
			{
				for ($i=0; $i <count($results); $i++) 
				{ 
					$dd=substr($results[$i]->MTH_STMT_DATE,0,4).'-'.substr($results[$i]->MTH_STMT_DATE,4,2).'-'.substr($results[$i]->MTH_STMT_DATE,6,2);
					$array = array(
			            'glob_sts'=>$glob_sts,
			            'date'=>$dd,
			            'particulars'=>"Card Statement",
			            'withdraw_amount'=>$results[$i]->DEBIT,
			            'deposit_amount'=>$results[$i]->CREDITS,
			            'credit_limit'=>$results[$i]->CREDIT_LIMIT,
			            'opening_belance'=>$results[$i]->OPENING_BALANCE,
			            'current_belance'=>$results[$i]->CURRENT_BALANCE,
			            'mtd_debit'=>$results[$i]->MTD_DEBIT,
			            'mtd_credit'=>$results[$i]->MTD_CREDIT,
			            'mth_age_cd'=>$results[$i]->MTH_AGE_CD,
			            'mth_dunn_cd'=>$results[$i]->MTH_DUNN_CD,
			            'mth_retchq_cnt'=>$results[$i]->MTH_RETCHQ_CNT,
			            'mth_close_bl'=>$results[$i]->MTH_CLOSE_BAL,
			            'mth_late_ind'=>$results[$i]->MTH_LATE_IND,
			            'mth_revolve_ind'=>$results[$i]->MTH_REVOLVE_IND,
			            'Session_Id'=> $this->session->userdata['ast_user']['user_id'],
			            'source' => 'card_pro',
			            'type' => $type,
			            'w_off_sts' => $write_off_sts
			            );
					$array['loan_ac'] = $this->Common_model->stringEncryption('encrypt',$loan_ac);
					 array_push($data,$array);
				}
				$this->db->insert_batch('statement_data', $data);
				$str='ok';
			}
			$str='ok';
			// else
			// {
			// 	$str = 'Sorry No Data found !!';
			// }
			
		}
		else
		{
			$str = 'Sorry No Data found !!';
		}

		$var =array(
		"str"=>$str,
		"id"=>$id,
		"int_rate"=>$int_rate,
		"csrf_token"=>$csrf_token
		);
		echo json_encode($var);
	}
	function load_statement()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$proposed_type = $this->input->post('proposed_type');
		$req_type = $this->input->post('req_type');
		$dt_from = implode('-',explode('/',$this->input->post('dt_from')));
		$dt_to = implode('-',explode('/',$this->input->post('dt_to')));
		$str = '';
		$cma_id = '';
		$liv_dev = config_item('statement_liv_dev');
		$write_off_sts = 0;
		$mbs_ac = '';
		$type='';
		$int_rate = 0;
		$glob_sts = 0;
		$data_status = 1;
		$glob_ac = '';
		$sep_word = "INTEREST SEP";
		$write_off_sts = 0;
		$write_off_date = '';
		$mbs_results = array();
		if ($proposed_type == 'Loan') { //Get Loan Ac Data
			$loan_ac = $this->input->post('loan_ac');
		}
		else //Get Card Data
		{
			$loan_ac = $this->Common_model->stringEncryption('encrypt',$_POST['hidden_loan_ac']);
		}
		// For Global Account Statement Generate
		if(isset($_POST['int_rate_available']) && $_POST['int_rate_available']==1 && $proposed_type == 'Loan')
		{
			$glob_sts=1;
			$glob_ac = $loan_ac;
			$int_rate = $_POST['int_rate'];
			$this->Common_model->delete_statement_data_by_ac($loan_ac);//Delete Global statement Data
		}
		else //For system cma data
		{
			$account_data = $this->Hoops_model->get_cma_data($proposed_type,$req_type,$loan_ac);
			//Checking for no data
			if (!empty($account_data)) {
				$cma_id = $account_data->id;
				$this->Common_model->delete_statement_data($cma_id);//Delete Global statement Data
			}
			else 
			{
				if($proposed_type == 'Loan') //For card no need to check int rate 
				{
					$data_status = 0;
				}
				else
				{
					$glob_ac = $loan_ac;
					$this->Common_model->delete_statement_data_by_ac($loan_ac);//Delete Global statement Data
					$glob_sts=1;//Global status for card data
				}
				
			}
			
		}
		if ($data_status==1) 
		{
			$write_off_data = $this->Common_model->get_write_off_data($loan_ac,$liv_dev);
			if(!empty($write_off_data))
			{
				if($write_off_data['IS_WRITEOFF']=='Yes')
				{
					$write_off_sts = 1;
					$write_off_date = implode('-',array_reverse(explode('-',trim($write_off_data['WRITEOFF_DATE']))));
				}
			}
			if ($proposed_type=='Loan') { //For Loan
				$mbs_ac = $this->Common_model->get_mbs_ac($loan_ac,$liv_dev);
				if ($mbs_ac!='') {
					$mbs_results = $this->Common_model->get_mbs_stmt($mbs_ac,date("d-M-Y",strtotime($dt_from)),date("d-M-Y",strtotime($dt_to)),$liv_dev);
				}
				$data=array();
				$only_recovery_sts=0;
				if (!empty($mbs_results)) 
				{
					for ($i=1; $i <=count($mbs_results) ; $i++) { 
						if ($mbs_results[$i]['atotransdate']!='') {
							$d = $mbs_results[$i]['atotransdate'];
							//After write off or Interest SEP only recovery will get
							if($only_recovery_sts==1)
							{
								if ($mbs_results[$i]['dr']!='' && $mbs_results[$i]['dr']>0) {
									continue;
								}

							}
							//////////// End /////////////
							if ($mbs_results[$i]['dr']!='' && $mbs_results[$i]['dr']>0) {
								$withdraw = $mbs_results[$i]['dr'];
								$deposit = 0.00;
								$type = 'w';
							}else
							{
								$deposit = $mbs_results[$i]['cr'];
								$withdraw = 0.00;
								$type = 'd';
							}
							//skipping INTEREST SEP ROW
							if(strpos(strtoupper($mbs_results[$i]['part']), $sep_word) !== false){
							    $only_recovery_sts=1;
							    continue;
							}
							//skipping 0 belance write off row
							if(abs($withdraw)<=0 && abs($deposit)<=0)
							{
								continue;
							}
							//Skipping write-off row
							if($write_off_sts==1 && $write_off_date==$d)
							{
								$only_recovery_sts=1;
								continue;
							}
							$array = array(
					            'date'=>$d,//$mbs_results[$i]['atotransdate'],
					            'glob_sts'=>$glob_sts,
					            'particulars'=>$mbs_results[$i]['part'],
					            'withdraw_amount'=>$withdraw,
					            'deposit_amount'=>$deposit,
					            'Session_Id'=> $this->session->userdata['ast_user']['user_id'],
					            'source' => 'mbs',
					            'type' => $type,
					            'w_off_sts' => $write_off_sts
					            );
							if ($glob_sts==1) { //Checking cma data have or not for this loan ac
								$array['loan_ac'] = $loan_ac;
							}else
							{
								$array['cma_id'] = $cma_id;
							}
							 array_push($data,$array);
						}
					}
					$this->db->insert_batch('statement_data', $data);
				}
				$xcrv_results = $this->Common_model->get_xcrv_stmt($loan_ac,date("d-M-Y",strtotime($dt_from)),date("d-M-Y",strtotime($dt_to)),$liv_dev);
				if (!empty($xcrv_results)) 
				{
					$data=array();
					$only_recovery_sts=0;
					for ($i=1; $i <=count($xcrv_results) ; $i++) { 
						if ($xcrv_results[$i]['VALUE_DATE']!='') {
							$dd=explode("-",trim($xcrv_results[$i]['VALUE_DATE']));
					    	$d=$dd[2].'-'.$dd[1].'-'.$dd[0];
					    	//After write off or Interest SEP only recovery will get
							if($only_recovery_sts==1)
							{
								if ($xcrv_results[$i]['WITHDRAW']!='' && $xcrv_results[$i]['WITHDRAW']>0) {
									continue;
								}

							}
							//////////// End /////////////
							if ($xcrv_results[$i]['WITHDRAW']!='' && $xcrv_results[$i]['WITHDRAW']>0) {
								$withdraw = $xcrv_results[$i]['WITHDRAW'];
								$deposit = 0.00;
								$type = 'w';
							}else
							{
								$deposit = $xcrv_results[$i]['DEPOSIT'];
								$withdraw = 0.00;
								$type = 'd';
							}
							//skipping INTEREST SEP ROW
							if(strpos(strtoupper($xcrv_results[$i]['TRAN_PARTICULAR']), $sep_word) !== false){
							    $only_recovery_sts=1;
							    continue;
							}
							//skipping 0 belance write off row
							if(abs($withdraw)<=0 && abs($deposit)<=0)
							{
								continue;
							}
							//Skipping write-off row
							if($write_off_sts==1 && $write_off_date==$d)
							{
								$only_recovery_sts=1;
								continue;
							}
							$array = array(
					            'glob_sts'=>$glob_sts,
					            'date'=>$d,
					            'particulars'=>$xcrv_results[$i]['TRAN_PARTICULAR'],
					            'withdraw_amount'=>$withdraw,
					            'deposit_amount'=>$deposit,
					            'Session_Id'=> $this->session->userdata['ast_user']['user_id'],
					            'source' => 'xcrv',
					            'type' => $type,
					            'w_off_sts' => $write_off_sts
					            );
							if ($glob_sts==1) { //Checking cma data have or not for this loan ac
								$array['loan_ac'] = $loan_ac;
							}else
							{
								$array['cma_id'] = $cma_id;
							}
							 array_push($data,$array);
						}
					}
					$this->db->insert_batch('statement_data', $data);
				}
			}
			else{ // For Card
				$loan_ac=$this->Common_model->stringEncryption('decrypt',$loan_ac);
				$results = $this->Common_model->get_card_stmt($loan_ac,date("d-M-Y",strtotime($dt_from)),date("d-M-Y",strtotime($dt_to)),$liv_dev);
				$data=array();
				if (!empty($results)) 
				{
					for ($i=0; $i <count($results); $i++) 
					{ 
						$dd=substr($results[$i]->MTH_STMT_DATE,0,4).'-'.substr($results[$i]->MTH_STMT_DATE,4,2).'-'.substr($results[$i]->MTH_STMT_DATE,6,2);
						$array = array(
				            'glob_sts'=>$glob_sts,
				            'date'=>$dd,
				            'particulars'=>"Card Statement",
				            'withdraw_amount'=>$results[$i]->DEBIT,
				            'deposit_amount'=>$results[$i]->CREDITS,
				            'credit_limit'=>$results[$i]->CREDIT_LIMIT,
				            'opening_belance'=>$results[$i]->OPENING_BALANCE,
				            'current_belance'=>$results[$i]->CURRENT_BALANCE,
				            'mtd_debit'=>$results[$i]->MTD_DEBIT,
				            'mtd_credit'=>$results[$i]->MTD_CREDIT,
				            'mth_age_cd'=>$results[$i]->MTH_AGE_CD,
				            'mth_dunn_cd'=>$results[$i]->MTH_DUNN_CD,
				            'mth_retchq_cnt'=>$results[$i]->MTH_RETCHQ_CNT,
				            'mth_close_bl'=>$results[$i]->MTH_CLOSE_BAL,
				            'mth_late_ind'=>$results[$i]->MTH_LATE_IND,
				            'mth_revolve_ind'=>$results[$i]->MTH_REVOLVE_IND,
				            'Session_Id'=> $this->session->userdata['ast_user']['user_id'],
				            'source' => 'card_pro',
				            'type' => $type,
				            'w_off_sts' => $write_off_sts
				            );
						if ($glob_sts==1) { //Checking cma data have or not for this loan ac
							$array['loan_ac'] = $this->Common_model->stringEncryption('encrypt',$loan_ac);
						}else
						{
							$array['cma_id'] = $cma_id;
						}
						 array_push($data,$array);
					}
					$this->db->insert_batch('statement_data', $data);
				}
			}
			$str='ok';
		}
		else
		{
			$str = 'Sorry No Data found !!';
		}

		$var =array(
		"str"=>$str,
		"cma_id"=>$cma_id,
		"glob_ac"=>$glob_ac,
		"glob_sts"=>$glob_sts,
		"int_rate"=>$int_rate,
		"csrf_token"=>$csrf_token
		);
		echo json_encode($var);
	}
	function add_months($months, DateTime $dateObject) 
    {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }
    function endCycle($d1, $months)
    {
        $date = new DateTime($d1);

        // call second function to add the months
        $newDate = $date->add($this->add_months($months, $date));

        // goes back 1 day from date, remove if you want same day of month
        //$newDate->sub(new DateInterval('P1D')); 

        //formats final date to Y-m-d form
        $dateReturned = $newDate->format('Y-m-d'); 

        return $dateReturned;
    }
    function load_jari_statement()
    {
    	$loop_break_counter = 0;
    	$file_name_new="generated_statement_".$this->session->userdata['ast_user']['user_id'].'.xls';
    	//Delete old generated statement
    	if (file_exists($file_name_new)) {
        	unlink($file_name_new);		
        }
    	include('./application/Classes/PHPExcel/Calculation/Financial.php');
		$cals = new PHPExcel_Calculation_Financial();
		require_once('./application/Classes/PHPExcel.php'); 
	    $objPHPExcel = new PHPExcel();
	    $csrf_token=$this->security->get_csrf_hash();
	    $sep_word = "INTEREST SEP";
	    $dt_to = implode('-',explode('/',$this->input->post('dt_to')));
		$dt_from = implode('-',explode('/',$this->input->post('dt_from')));
		$loan_ac = $this->input->post('loan_ac');
		$hidden_loan_ac = $this->input->post('hidden_loan_ac');
		$int_rate = $this->input->post('int_rate');
		$outstanding_bl = $this->input->post('outstanding_bl');
		$l_dt_from = implode('-',explode('/',$this->input->post('l_dt_from')));
		$l_dt_to = implode('-',explode('/',$this->input->post('l_dt_to')));
		$total_legal_cost = $this->input->post('total_legal_cost');
		$str='';
		$count=0;
		$new_month_extra_days_sts = 0;
		$total_recovery=0;
		$last_txrn_date_stored='';
		$covid_month_exced_sts=0;
		//Calling Service For Jari Recovery Data and store
		$liv_dev = config_item('statement_liv_dev');
		$str_where="";
		$write_off_date = '';
		$write_off_sts = 0;
		if($this->input->post('proposed_type')=='Loan')
		{
			$loan_ac = $this->input->post('loan_ac');
			$str_where.= "c.loan_ac='".$loan_ac."'";
		}
		else
		{
			$loan_ac = $this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'));//for Card number
			$str_where.= "c.org_loan_ac='".$loan_ac."'";
		}
		$this->Common_model->delete_jari_statement_data_by_ac($loan_ac);//Deleteting previous data
		if($this->input->post('proposed_type')=='Loan')
		{
			$write_off_data = $this->Common_model->get_write_off_data($this->input->post('loan_ac'),$liv_dev);
			if(!empty($write_off_data))
			{
				if($write_off_data['IS_WRITEOFF']=='Yes')
				{
					$write_off_sts = 1;
					$write_off_date = implode('-',array_reverse(explode('-',trim($write_off_data['WRITEOFF_DATE']))));
				}
			}
			$mbs_ac = $this->Common_model->get_mbs_ac($loan_ac,$liv_dev);
			if ($mbs_ac!='') {
				$mbs_results = $this->Common_model->get_mbs_stmt($mbs_ac,date("d-M-Y",strtotime($dt_from)),date("d-M-Y",strtotime($dt_to)),$liv_dev);
			}
			$data=array();
			$only_recovery_sts=0;
			if (!empty($mbs_results)) 
			{
				for ($i=1; $i <=count($mbs_results) ; $i++) { 
					if ($mbs_results[$i]['atotransdate']!='') {
						$d=$mbs_results[$i]['atotransdate'];
						//After write off or Interest SEP only recovery will get
						if($only_recovery_sts==1)
						{
							if ($mbs_results[$i]['dr']!='' && $mbs_results[$i]['dr']>0) {
								continue;
							}

						}
						//////////// End /////////////
						if ($mbs_results[$i]['dr']!='' && $mbs_results[$i]['dr']>0) {
							$withdraw = $mbs_results[$i]['dr'];
							$deposit = 0.00;
							$type = 'w';
						}else
						{
							$deposit = $mbs_results[$i]['cr'];
							$withdraw = 0.00;
							$type = 'd';
						}
						//skipping INTEREST SEP ROW
						if(strpos(strtoupper($mbs_results[$i]['part']), $sep_word) !== false){
						    $only_recovery_sts=1;
						    continue;
						}
						//skipping 0 belance write off row
						if(abs($withdraw)<=0 && abs($deposit)<=0)
						{
							continue;
						}
						//Skipping write-off row
						if($write_off_sts==1 && $write_off_date==$d)
						{
							$only_recovery_sts=1;
							continue;
						}
						if ($mbs_results[$i]['cr']!='' && $mbs_results[$i]['cr']>0) {
							$withdraw = $mbs_results[$i]['cr'];
							$array = array(
					            'date'=>$d,
					            'amount'=>$withdraw,
					            'narration'=>$mbs_results[$i]['part'],
					            'loan_ac'=>$loan_ac,
					            'Session_Id'=> $this->session->userdata['ast_user']['user_id']
				            );
				            array_push($data,$array);
						}
					}
				}
				$this->db->insert_batch('jari_recovery_data_cbs', $data);
			}
			if ($write_off_sts==0) //checking writeoff done or not
			{ 
				$xcrv_results = $this->Common_model->get_xcrv_stmt($loan_ac,date("d-M-Y",strtotime($dt_from)),date("d-M-Y",strtotime($dt_to)),$liv_dev);
				if (!empty($xcrv_results)) 
				{
					$only_recovery_sts=0;
					for ($i=1; $i <=count($xcrv_results) ; $i++) { 
						if ($xcrv_results[$i]['VALUE_DATE']!='') {
							$dd=explode("-",trim($xcrv_results[$i]['VALUE_DATE']));
					    	$d=$dd[2].'-'.$dd[1].'-'.$dd[0];
							//After write off or Interest SEP only recovery will get
							if($only_recovery_sts==1)
							{
								if ($xcrv_results[$i]['WITHDRAW']!='' && $xcrv_results[$i]['WITHDRAW']>0) {
									continue;
								}

							}
							//////////// End /////////////
							if ($xcrv_results[$i]['WITHDRAW']!='' && $xcrv_results[$i]['WITHDRAW']>0) {
								$withdraw = $xcrv_results[$i]['WITHDRAW'];
								$deposit = 0.00;
								$type = 'w';
							}else
							{
								$deposit = $xcrv_results[$i]['DEPOSIT'];
								$withdraw = 0.00;
								$type = 'd';
							}
							//skipping INTEREST SEP ROW
							if(strpos(strtoupper($xcrv_results[$i]['TRAN_PARTICULAR']), $sep_word) !== false){
							    $only_recovery_sts=1;
							    continue;
							}
							//skipping 0 belance write off row
							if(abs($withdraw)<=0 && abs($deposit)<=0)
							{
								continue;
							}
							//Skipping write-off row
							if($write_off_sts==1 && $write_off_date==$d)
							{
								$only_recovery_sts=1;
								continue;
							}
							if ($xcrv_results[$i]['DEPOSIT']!='' && $xcrv_results[$i]['DEPOSIT']>0) {
								$withdraw = $xcrv_results[$i]['DEPOSIT'];
								$array = array(
						            'date'=>$d,
						            'amount'=>$withdraw,
						            'narration'=>$xcrv_results[$i]['TRAN_PARTICULAR'],
						            'loan_ac'=>$loan_ac,
						            'Session_Id'=> $this->session->userdata['ast_user']['user_id']
					            );
					            array_push($data,$array);
							}
						}
					}
					
					$this->db->insert_batch('jari_recovery_data_cbs', $data);
				}
			}
		}
		//Header Initiate
		$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" id="grid_table_div" class="grid_table_div">
			<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<thead style="">
				<th width="10%" style="font-weight: bold;text-align:center">Date</th>
				<th width="45%" style="font-weight: bold;text-align:left">Narration</th>
				<th width="15%" style="font-weight: bold;text-align:left">Withdraw</th>
				<th width="15%" style="font-weight: bold;text-align:left">Deposit</th>
				<th width="15%" style="font-weight: bold;text-align:left">Belance</th>
			</thead>
			<tbody id="table_tbody">';
		$objWorkSheet = $objPHPExcel->createSheet(0);
		$objPHPExcel->setActiveSheetIndex(0);
	        $styleArray_border = array(
	              'borders' => array(
	                  'allborders' => array(
	                      'style' => PHPExcel_Style_Border::BORDER_THIN
	                  )
	              )
	          ); 
	        
		    $rowNumber = 1;
		    $rowNumber++;
		    $rowNumber++;
		    $objWorkSheet->getColumnDimension('A')->setWidth(10); 
		    $objWorkSheet->getColumnDimension('B')->setWidth(35);
		    $objWorkSheet->getColumnDimension('C')->setWidth(25);
		    $objWorkSheet->getColumnDimension('D')->setWidth(20);
		    $objWorkSheet->getColumnDimension('E')->setWidth(30);
		    $objWorkSheet->getColumnDimension('F')->setWidth(25);
		    $objWorkSheet->getColumnDimension('G')->setWidth(15);
		    $objWorkSheet->getColumnDimension('H')->setWidth(25);
		    $objWorkSheet->getColumnDimension('I')->setWidth(15);
		    $objWorkSheet->getColumnDimension('J')->setWidth(33);
		    $headings1 = array('Account No : '.$loan_ac);
	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objWorkSheet->mergeCells('A'.$rowNumber.':B'.$rowNumber);  
	        $objWorkSheet->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setSize(10);
	        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('C'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;
	        $headings1 = array('STATEMENT OF ACCOUNT FOR THE PERIOD OF '.date("d-M-y",strtotime($dt_from)).' To '.date("d-M-y",strtotime($dt_to)).'');
	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objWorkSheet->mergeCells('A'.$rowNumber.':E'.$rowNumber); 
	        $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->getFont()->setSize(16);
	        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('A'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;
	        $rowNumber++;  
	        $headings4 = array('DATE','PARTICULARS','WITHDRAW',
	          'DEPOSIT','BALANCE');
	        $objWorkSheet->fromArray(array($headings4),NULL,'A'.$rowNumber);
	        $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->getFont()->setBold(true); 
	        $objWorkSheet->getStyle('A'.$rowNumber.':A'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F28A8C')));
	        $objWorkSheet->getStyle('A10:E'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++; 
	    
	    
		$cma_row = $this->db->query("SELECT c.loan_ac,c.ac_name,c.outstanding_bl_dt
			FROM cma as c 
			WHERE ".$str_where." ORDER BY c.id DESC LIMIT 1")->row();
		if(!empty($cma_row))
		{
			$ac_name = $cma_row->ac_name;
			$outstanding_dt = $cma_row->outstanding_bl_dt;
		}else{$ac_name = '';$outstanding_dt ='';}
		if($this->input->post('int_type')=='Simple') //For simple interest
		{
			$date = $dt_to; /// To Date For Statement
			$total_interest=0;
			while (1) 
			{
				$loop_break_counter++;
				if($loop_break_counter>200) //breaking the loop when error non stopping looop
				{
					break;
				}
				$count++;
				//For The First Row
				if($count==1)
				{
					$belance=$outstanding_bl;
		         	$principal_amount = $belance;
		         	$cur_date = date("d-M-y",strtotime($dt_from));
		         	$prev_belance=$belance;
		        	//For HTML VIEW
		        	$str.='<tr>
	                  <td align="center">'.$cur_date.'</td>
	                  <td align="left">Outstanding Amount</td>
	                  <td align="left">'.number_format($outstanding_bl,2,'.',',').'</td>
	                  <td align="left">0.00</td>
	                  <td align="left">'.number_format($belance,2,'.',',').'</td>
	              </tr>';
	              $objWorkSheet->fromArray(array(
		            $cur_date,
		            'Outstanding Amount',
		            number_format($outstanding_bl,2,'.',','),
		            '0.00',
		            number_format($belance,2,'.',','),
		            ),NULL,'A'.$rowNumber);
		          $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->getAlignment()->setWrapText(true);
		          $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray_border); 
				  $rowNumber++;
				}
				else
				{
					$new_date = $this->endCycle($dt_from, 1);
					$cur_date=explode("-",$new_date);
				 	$from_date=explode("-",$date);
				 	if ($new_date > implode('-',array_reverse(explode('-',$date)))) {
						
						if($new_month_extra_days_sts == 1) //Calculation Extra days of new month interest
						{
							$interest=round(($int_rate/360)/100,10);
							$date_diff2= $cals->get_date_diff(implode('-',array_reverse(explode('-',$date))),$dt_from,'-');//initiliaze the extra days
							$show_date = date('Y-m-d', strtotime($dt_from. ' + '.$date_diff2.' days'));
							$interest_amount = ($interest*$prev_belance*$date_diff2);
							$total_interest=$total_interest+$interest_amount;
							$belance = $prev_belance+$interest_amount;
							$str.='<tr>
			                  <td align="center">'.date("d-M-y",strtotime($show_date)).'</td>
			                  <td align="left">Interest</td>
			                  <td align="left">'.number_format($interest_amount,2,'.',',').'</td>
			                  <td align="left">0.00</td>
			                  <td align="left">'.number_format($belance,2,'.',',').'</td>
			              </tr>';
			               $objWorkSheet->fromArray(array(
				            date("d-M-y",strtotime($show_date)),
				            'Interest',
				            number_format($interest_amount,2,'.',','),
				            '0.00',
				            number_format($belance,2,'.',','),
				            ),NULL,'A'.$rowNumber);
				          $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->getAlignment()->setWrapText(true);
				          $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray_border); 
				          $rowNumber++;
			              $prev_belance=$belance;
						  $dt_from=$new_date;
						}

						break;

					}
					$final_month = $this->endCycle($new_date, 1);
					$interest=round(($int_rate/360)/100,10);
					if ($final_month > implode('-',array_reverse(explode('-',$date)))) { //initiliaze the last month
						$date_diff2= $cals->get_date_diff(implode('-',array_reverse(explode('-',$date))),$dt_from,'-');//initiliaze the extra days
						$show_date = date('Y-m-d', strtotime($dt_from. ' + '.$date_diff2.' days'));
						$str1=explode('-',$show_date);//Extra Date Calculated Month
						$str2=explode('-',$new_date); //New Date Month
						if($str1[1]>$str2[1])
						{
							$new_month_extra_days_sts = 1;
						}
						if($date_diff2>0 && $new_month_extra_days_sts ==0) //Calculating with extra days interest
						{
							$interest_amount = ($interest*$prev_belance*$date_diff2);
						}
						else //normal month wise calculation
						{
							$show_date = $new_date;
							$date_diff= $cals->get_date_diff($new_date,$dt_from,'-');
							$interest_amount = ($interest*$prev_belance*$date_diff);
						}
						
					}
					else //normal month wise calculation
					{
						$show_date = $new_date;
						$date_diff= $cals->get_date_diff($new_date,$dt_from,'-');
						$interest_amount = ($interest*$prev_belance*$date_diff);
					}
					$total_interest=$total_interest+$interest_amount;
					$belance = $prev_belance+$interest_amount;
					$str.='<tr>
	                  <td align="center">'.date("d-M-y",strtotime($show_date)).'</td>
	                  <td align="left">Interest</td>
	                  <td align="left">'.number_format($interest_amount,2,'.',',').'</td>
	                  <td align="left">0.00</td>
	                  <td align="left">'.number_format($belance,2,'.',',').'</td>
	              </tr>';
	               $objWorkSheet->fromArray(array(
		            date("d-M-y",strtotime($show_date)),
		            'Interest',
		            number_format($interest_amount,2,'.',','),
		            '0.00',
		            number_format($belance,2,'.',','),
		            ),NULL,'A'.$rowNumber);
		          $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->getAlignment()->setWrapText(true);
		          $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray_border); 
		          $rowNumber++;
	              $prev_belance=$belance;
				  $dt_from=$new_date;
				}
				
			}
		    
		}
		else //For Compound interest
		{
			$date = $dt_to; /// To Date For Statement
			$total_interest=0;
			while (1) 
			{
				$loop_break_counter++;
				if($loop_break_counter>200) //breaking the loop when error non stopping looop
				{
					break;
				}
				$count++;
				//For The First Row
				if($count==1)
				{
					$belance=$outstanding_bl;
		         	$principal_amount = $belance;
		         	$cur_date = date("d-M-y",strtotime($dt_from));
		         	$prev_belance=$belance;
		        	//For HTML VIEW
		        	$str.='<tr>
	                  <td align="center">'.$cur_date.'</td>
	                  <td align="left">Outstanding Amount</td>
	                  <td align="left">'.number_format($outstanding_bl,2,'.',',').'</td>
	                  <td align="left">0.00</td>
	                  <td align="left">'.number_format($belance,2,'.',',').'</td>
	              </tr>';
	              $objWorkSheet->fromArray(array(
		            $cur_date,
		            'Outstanding Amount',
		            number_format($outstanding_bl,2,'.',','),
		            '0.00',
		            number_format($belance,2,'.',','),
		            ),NULL,'A'.$rowNumber);
		          $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->getAlignment()->setWrapText(true);
		          $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray_border); 
				  $rowNumber++;
				}
				else
				{
					$new_date = $this->endCycle($dt_from, 1);
					$cur_date=explode("-",$new_date);
				 	$from_date=explode("-",$date);
				 	if ($new_date > implode('-',array_reverse(explode('-',$date)))) {
						if($new_month_extra_days_sts == 1) //Calculation Extra days of new month interest
						{
							$interest=round(($int_rate/360)/100,10);
							$date_diff2= $cals->get_date_diff(implode('-',array_reverse(explode('-',$date))),$dt_from,'-');//initiliaze the extra days
							$show_date = date('Y-m-d', strtotime($dt_from. ' + '.$date_diff2.' days'));
							$interest_amount = ($interest*$prev_belance*$date_diff2);
							$total_interest=$total_interest+$interest_amount;
							$belance = $prev_belance+$interest_amount;
			              $prev_belance=$belance;
						  $dt_from=$new_date;
						}
						break;
					}
					$final_month = $this->endCycle($new_date, 1);
					$interest=round(($int_rate/360)/100,10);
					if ($final_month > implode('-',array_reverse(explode('-',$date)))) { //initiliaze the last month
						$date_diff2= $cals->get_date_diff(implode('-',array_reverse(explode('-',$date))),$dt_from,'-');//initiliaze the extra days
						$str1=explode('-',$show_date);//Extra Date Calculated Month
						$str2=explode('-',$new_date); //New Date Month
						if($str1[1]>$str2[1])
						{
							$new_month_extra_days_sts = 1;
						}
						if($date_diff2>0 && $new_month_extra_days_sts ==0) //Calculating with extra days interest
						{
							$interest_amount = ($interest*$prev_belance*$date_diff2);
						}
						else //normal month wise calculation
						{
							$show_date = $new_date;
							$date_diff= $cals->get_date_diff($new_date,$dt_from,'-');
							$interest_amount = ($interest*$prev_belance*$date_diff);
						}
						
					}
					else //normal month wise calculation
					{
						$show_date = $new_date;
						$date_diff= $cals->get_date_diff($new_date,$dt_from,'-');
						$interest_amount = ($interest*$prev_belance*$date_diff);
					}
					$belance = $prev_belance+$interest_amount;
					$total_interest=$total_interest+$interest_amount;

	              	$prev_belance=$belance;
				 	$dt_from=$new_date;
				}
				
			}
			$str.='<tr>
                  <td align="center">'.date("d-M-y",strtotime($new_date)).'</td>
                  <td align="left">Interest</td>
                  <td align="left">'.number_format($total_interest,2,'.',',').'</td>
                  <td align="left">0.00</td>
                  <td align="left">'.number_format($belance,2,'.',',').'</td>
              </tr>';
               $objWorkSheet->fromArray(array(
	            date("d-M-y",strtotime($new_date)),
	            'Interest',
	            number_format($total_interest,2,'.',','),
	            '0.00',
	            number_format($belance,2,'.',','),
	            ),NULL,'A'.$rowNumber);
	          $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->getAlignment()->setWrapText(true);
	          $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray_border); 
	          $rowNumber++;
		}
		if($this->input->post('proposed_type')=='Loan')
		{
			$org_loan_ac = '';
		}
		else
		{
			$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'));//for Card number
		}
		$data = array('int_type'   => $this->input->post('int_type'),  
	                'proposed_type'   => $this->input->post('proposed_type'),
	                'loan_ac'   => $this->input->post('loan_ac'),
	                'ac_name'   => $ac_name,
	                'total_l_cost'   => $total_legal_cost,
	                'org_loan_ac'   => $org_loan_ac,
	                'total_interest'   => $total_interest,
	                'int_rate'   => $this->input->post('int_rate'),
	                'outstanding'   => $this->input->post('outstanding_bl'),
	                'final_amount'   => $belance,
	                'total_paid'   => $total_recovery,
	                'outstanding_dt'   => $outstanding_dt,
	                'date_from'   => implode('-',array_reverse(explode('/',$this->input->post('dt_from')))),
	                'date_to'   => implode('-',array_reverse(explode('/',$this->input->post('dt_to')))),
	                'l_dt_from'   => implode('-',array_reverse(explode('/',$this->input->post('l_dt_from')))),
	                'l_dt_to'   => implode('-',array_reverse(explode('/',$this->input->post('l_dt_to'))))
	     ); 
	     $str_where = "1";
        if ($this->input->post('proposed_type')=='Loan') {
            $str_where.= " AND s.loan_ac='".$this->input->post('loan_ac')."'";
        }else if($this->input->post('proposed_type')=='Card')
        {
            $str_where.= " AND s.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
        }
        $sql_str=" SELECT s.*
            FROM jari_statement as s
            WHERE $str_where AND s.sts<>0 AND s.outstanding=".$this->db->escape($this->input->post('outstanding_bl'))." ORDER BY s.id ASC LIMIT 1";
            $query=$this->db->query($sql_str);
            $result = $query->row();  
        $jari_id='';
        if(!empty($result)) //Update the old data
        {
        	$this->db->where('id', $result->id);
            $this->db->update('jari_statement', $data);
            $jari_id=$result->id;
        }else //Insert the new data
        {
        	$this->db->insert('jari_statement', $data);
        	$jari_id=$this->db->insert_id();;
        }
		$objWorkSheet->setTitle('Statement Summery'); 
	    $file_name_new="generated_statement_".$this->session->userdata['ast_user']['user_id'].'.xls';
	    require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        $objWriter->save(str_replace(__file__,'temp_upload_file/'.$file_name_new,__file__));
		$new_file_path=$file_name_new;
		$var =array(
		"str"=>$str,
		"jari_id"=>$jari_id,
		"csrf_token"=>$csrf_token,
		"new_file_path"=>$new_file_path
		);
		echo json_encode($var);
    }
    function download_certificate($id=NULL)
    {
    	if($id!=NULL)
    	{
    		$sql_str=" SELECT s.*,DATE_FORMAT(s.date_to,'%d.%m.%Y') as date_to,
    		DATE_FORMAT(s.outstanding_dt,'%d.%m.%Y') as outstanding_dt,
    		DATE_FORMAT(s.date_from,'%d.%m.%Y') as date_from,
    		DATE_FORMAT(s.l_dt_from,'%d.%m.%Y') as l_dt_from,
    		DATE_FORMAT(s.l_dt_to,'%d.%m.%Y') as l_dt_to
	            FROM jari_statement as s
	            WHERE s.id=".$this->db->escape($id)." AND s.sts<>0 ORDER BY s.id ASC LIMIT 1";
	            $query=$this->db->query($sql_str);
	            $details = $query->row();
	        $final_amount = ($details->outstanding+$details->total_interest+$details->total_l_cost)-$details->total_paid;
	        $ref = 'BBL/HO/LAD /'.date('Y').'/AO/';
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
			
			$template = 'tbs/loan_LN/jari_belance.docx';
			$filename =	'JARI_CERTIFICATE.docx';

			$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
			$counter=0;
			$data_b[]= array(
				'ref'=>$ref,
				'date'=>date('M-d-Y'),
				'ac_name'=>$details->ac_name,
				'loan_ac'=>$details->loan_ac,
				'on_date'=>$details->outstanding_dt,
				'outstanding_date'=>$details->outstanding_dt,
				'outstanding'=>$details->outstanding,
				'int_rate'=>$details->int_rate,
				'int_dt_from'=>$details->date_from,
				'int_dt_to'=>$details->date_to,
				'total_int'=>$details->total_interest,
				'legal_cost_from'=>$details->l_dt_from,
				'legal_cost_to'=>$details->l_dt_to,
				'total_legal_cost'=>$details->total_l_cost,
				'paid_from'=>$details->date_from,
				'paid_to'=>$details->date_to,
				'total_paid_amount'=>$details->total_paid,
				'final_amount'=>$final_amount,
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
    }
    function generate_xl_by_id_loan()
	{
		include('./application/Classes/PHPExcel/Calculation/Financial.php');
		$cals = new PHPExcel_Calculation_Financial();
		require_once('./application/Classes/PHPExcel.php'); 
	    $objPHPExcel = new PHPExcel();
	    $csrf_token=$this->security->get_csrf_hash();
		$str='';
		$new_file_path='';
		$prev_file_path = '';
		$libality_statement = '';
		$prev_libality_statement='';
		$dt_to = implode('-',explode('/',$this->input->post('dt_to')));
		$dt_from = implode('-',explode('/',$this->input->post('dt_from')));
		$id = $this->input->post('id');
		$loan_ac = '';
		$ac_name = '';
		$principal_amount = 0;
		$total_interest = 0;
		$amount_paid = 0;
		$pinal_charge = 0;
		$row = array();
		$this->load->library('WebService');
		$ws = new WebService();
		$row = $this->Hoops_model->get_loan_data($id);
		$loan_ac = $row->loan_ac;
		$ac_name = $row->ac_name;
		$int_rate = $row->int_rate;
		$cif = $row->cif;
		$address = $row->address;
		$sch_desc = $row->sch_desc;
		$statement_data = $this->Hoops_model->get_generated_statement_data_by_ac($loan_ac);
		$write_off_sts = 0;
		$final_dt = '';
		$final_belance = '';
		$bb_rate = 9;
		$bb_rate_year = '2020';
		$bb_rate_month = '04';
		$bb_rate_date = '2020-04-01';
		$final_dt = '';
		$final_belance = 0;
		$last_txrn_date_stored='';
		$covid_month_exced_sts=0;
		$new_month_extra_days_sts = 0;
		$loop_break_counter = 0;
		$bb_fixed_rate_calc_sts = 0;
		$principal_amount = 0;
		$total_interest = 0;
		$total_witdraw = 0;
		$total_deposit = 0;
		$amount_paid = 0;
		$pinal_charge = 0;
		//Excel Header Initiate
		$objWorkSheet = $objPHPExcel->createSheet(0);
		$objPHPExcel->setActiveSheetIndex(0);
	        $styleArray_border = array(
	              'borders' => array(
	                  'allborders' => array(
	                      'style' => PHPExcel_Style_Border::BORDER_THIN
	                  )
	              )
	          ); 


	        
		    $rowNumber = 1;
		    $rowNumber++;
		    $rowNumber++;
		    $objWorkSheet->getColumnDimension('A')->setWidth(10); 
		    $objWorkSheet->getColumnDimension('B')->setWidth(35);
		    $objWorkSheet->getColumnDimension('C')->setWidth(25);
		    $objWorkSheet->getColumnDimension('D')->setWidth(20);
		    $objWorkSheet->getColumnDimension('E')->setWidth(30);
		    $objWorkSheet->getColumnDimension('F')->setWidth(25);
		    $objWorkSheet->getColumnDimension('G')->setWidth(15);
		    $objWorkSheet->getColumnDimension('H')->setWidth(25);
		    $objWorkSheet->getColumnDimension('I')->setWidth(15);
		    $objWorkSheet->getColumnDimension('J')->setWidth(33);
		    $headings1 = array($ac_name,'','','Customer ID :',$cif);

	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objWorkSheet->mergeCells('E'.$rowNumber.':F'.$rowNumber); 
	        $objWorkSheet->mergeCells('A'.$rowNumber.':C'.$rowNumber); 
	        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getFont()->setSize(12);
			$objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getFont()->setBold(true);
			$objWorkSheet->getStyle('D'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);

	        $objWorkSheet->getStyle('E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objWorkSheet->getStyle('D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;
		    $headings1 = array('','','','Account No :',''.$loan_ac);

	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);


	        $objWorkSheet->mergeCells('E'.$rowNumber.':F'.$rowNumber);  
	        $objWorkSheet->getStyle('E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
	        $objWorkSheet->getStyle('D'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);
	        $objWorkSheet->getStyle('D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	        $objPHPExcel->getActiveSheet()->setCellValueExplicit(('E'.$rowNumber), $loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
	        $rowNumber++;
		    
	        $headings1 = array($address,'','','A/C Type :',$sch_desc);

	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
			$objWorkSheet->mergeCells('A'.$rowNumber.':C'.$rowNumber);  


	        $objWorkSheet->mergeCells('E'.$rowNumber.':F'.$rowNumber); 

			// 

	        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getFont()->setSize(12);


	        $objWorkSheet->getStyle('E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objWorkSheet->getStyle('D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
	        $objWorkSheet->getStyle('D'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;


			$headings1 = array('','','','Currency :','BDT');

	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);

	        $objWorkSheet->mergeCells('E'.$rowNumber.':F'.$rowNumber);  

	        $objWorkSheet->getStyle('E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objWorkSheet->getStyle('D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
	        $objWorkSheet->getStyle('D'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;
	        $headings1 = array('STATEMENT OF ACCOUNT FOR THE PERIOD OF '.date("d-M-y",strtotime($dt_from)).' To '.date("d-M-y",strtotime($dt_to)).'');
		        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objWorkSheet->mergeCells('A'.$rowNumber.':F'.$rowNumber); 
		        $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(12);
		        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		        $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
		        $objWorkSheet->getStyle('A'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;  
	        $headings4 = array('DATE','PARTICULARS','INST NO.','WITHDRAW','DEPOSIT','BALANCE');
	        $objWorkSheet->fromArray(array($headings4),NULL,'A'.$rowNumber);
	        $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $objWorkSheet->getStyle('A'.$rowNumber.':A'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);

	        $objWorkSheet->getStyle('A10:F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++; 
	        $rowNumber++; 
			$loan_belance=0;
			$over_belance=0;
			$belance=0;
			$total_int_belance=0;
			$count=1;
			$prev_belance=0;
			$last_date_mbs='';
			if (!empty($statement_data)) 
			{
				foreach($statement_data as $DealRow2)
		        {
		         if ($count==1) //For first row
		         {
		         	$belance=$DealRow2->withdraw_amount;
		         	$principal_amount = $belance;
		         	$over_belance = round(($belance*3),2);
		         	$total_int_belance+=round($belance,2);
		         }
		         else
		         {
		         	if ($DealRow2->withdraw_amount>0) //For interest add
		         	{
		         		$belance = $prev_belance+$DealRow2->withdraw_amount;
		         		$total_int_belance+=$DealRow2->withdraw_amount;
		         		$total_interest=$total_interest+$DealRow2->withdraw_amount;
		         	}
		         	if ($DealRow2->deposit_amount>0) //For Deposit Remove
		         	{
		         		$belance = $prev_belance-$DealRow2->deposit_amount;
		         		$amount_paid=$amount_paid+$DealRow2->deposit_amount;
		         	}
		         	
		         }
		         $date = date("d-M-y",strtotime($DealRow2->date));
	              $objWorkSheet->fromArray(array(
		            $date,
		            $DealRow2->particulars,
		            '',
		            ($DealRow2->withdraw_amount>0)?number_format($DealRow2->withdraw_amount,2,'.',','):'',
		            ($DealRow2->deposit_amount>0)?number_format($DealRow2->deposit_amount,2,'.',','):'',
		            '-'.number_format($belance,2,'.',','),
		            ),NULL,'A'.$rowNumber);
		          $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);


				  $objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				  $objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				  $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


		          $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border); 
		          $rowNumber++;
	              $count++;
	              $prev_belance=$belance;
	              if ($DealRow2->type=='w') { //Taking only interest date
	              	$last_date_mbs=$DealRow2->date;
	              }
	              //Checking writeoff done or not
	              if ($DealRow2->w_off_sts==1) {
	              	$write_off_sts = 1;
	              }
		        }
		        $last_day_mbs = $last_date_mbs;
			}
	        else
	        {
	        	$write_off_sts = 1;
	        }
	        
			
			$date = $dt_to; /// To Date For Statement
			
			if ($write_off_sts == 0) 
			{
				while (1) 
				{
					$new_date = $this->endCycle($last_day_mbs, 1);
					$cur_date=explode("-",$new_date);
					if($last_txrn_date_stored!='' && $covid_month_exced_sts==1) //when last txrn date stored on bellow condition of bb fixed rate calculation
					{
						$new_date = $this->endCycle($last_txrn_date_stored, 1);
						$last_day_mbs = date('Y-m-d', strtotime($last_day_mbs. ' + 1 days'));//Adding one extra day for april month bb rate calculation
						$cur_date = explode("-",$new_date);
						$covid_month_exced_sts=0;
					}
					//if ($cur_date[0]>=$bb_rate_year && $cur_date[1]>=$bb_rate_month && $last_txrn_date_stored=='') { //when new month is equal to bb int fixed calculation
					if ($new_date>=$bb_rate_date && $last_txrn_date_stored=='') { //when new month is equal to bb int fixed calculation
						$last_txrn_date_stored=$last_day_mbs;
						$new_date = date("Y-m-t", strtotime($last_day_mbs));
						$cur_date=explode("-",$new_date);
						$covid_month_exced_sts=1;
					}
				 	$from_date=explode("-",$date);
				 	if ($new_date > implode('-',array_reverse(explode('-',$date)))) {
				 		if($new_month_extra_days_sts == 1) //Calculating new month extra days interest
				 		{
				 			if($bb_fixed_rate_calc_sts==1)
							{
								$interest=($bb_rate/360)/100;//For BB Fixed Interest Rate calculation
							}else
							{
								$interest=($int_rate/360)/100;
							}
				 			$date_diff2= $cals->get_date_diff(implode('-',array_reverse(explode('-',$date))),$last_day_mbs,'-');//initiliaze the extra days
				 			$show_date = date('Y-m-d', strtotime($last_day_mbs. ' + '.$date_diff2.' days'));
							$interest_amount = ($interest*$prev_belance*$date_diff2);
							$total_int_belance+=$interest_amount;
							$belance = $prev_belance+$interest_amount;
							if ($total_int_belance<=$over_belance) {
								$total_witdraw = $total_witdraw+$interest_amount;
								$total_interest=$total_interest+$interest_amount;
					               $objWorkSheet->fromArray(array(
						            date("d-M-y",strtotime($show_date)),
						            $loan_ac.'-Normal Int',
						            '',
						            number_format($interest_amount,2,'.',','),
						            '',
						            '-'.number_format($belance,2,'.',','),
						            ),NULL,'A'.$rowNumber);
						          $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
						          $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border); 
								  
				  				  $objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				  					$objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				  				  $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


						          $rowNumber++;
					              $prev_belance=$belance;
							}else
							{
					              $objWorkSheet->fromArray(array(
						            date("d-M-y",strtotime($show_date)),
						            $view_loan_ac.'-Normal Int',
						            '',
						            '',
						            '',
						            '-'.number_format($prev_belance,2,'.',','),
						            ),NULL,'A'.$rowNumber);
						          $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
						          $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border); 
								  
				  				$objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				  				$objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				  				$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


						     	$rowNumber++;
							}
							$last_day_mbs=$new_date;
							$final_dt = date("Y-m-d",strtotime($new_date));
							$final_belance = round($belance,2);
				 		}
						break;
					}
					$recovery_data = $this->Hoops_model->get_recovery_data($loan_ac,$cur_date[0],$cur_date[1]);
					if (!empty($recovery_data)) 
					{
						foreach ($recovery_data as $key) 
						{
							$belance = $prev_belance-$key->amount;
							$amount_paid=$amount_paid+$key->amount;
				              $objWorkSheet->fromArray(array(
					            date("d-M-y",strtotime($key->trans_date)),
					            $key->narration,
					            '',
					            '',
					            ($key->amount>0)?number_format($key->amount,2,'.',','):'',
						        '-'.number_format($belance,2,'.',','),
					            ),NULL,'A'.$rowNumber);
					          $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->getAlignment()->setWrapText(true);
					          $objWorkSheet->getStyle('A'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray_border); 
					          $rowNumber++;
				            $prev_belance=$belance;
						}
					}
					if ($new_date>=$bb_rate_date && $bb_fixed_rate_calc_sts==0) {
							$bb_fixed_rate_calc_sts = 1;
						}
						if($bb_fixed_rate_calc_sts==1)
						{
							$interest=($bb_rate/360)/100;//For BB Fixed Interest Rate calculation
						}else
						{
							$interest=($int_rate/360)/100;
						}
						$final_month = $this->endCycle($new_date, 1);
						if ($final_month > implode('-',array_reverse(explode('-',$date)))) { //initiliaze the last month
							$date_diff2= $cals->get_date_diff(implode('-',array_reverse(explode('-',$date))),$last_day_mbs,'-');//initiliaze the extra days
							$show_date = date('Y-m-d', strtotime($last_day_mbs. ' + '.$date_diff2.' days'));
							$str1=explode('-',$show_date);//Extra Date Calculated Month
							$str2=explode('-',$new_date); //New Date Month
							if($str1[1]>$str2[1])
							{
								$new_month_extra_days_sts = 1;
							}
							if($date_diff2>0 && $new_month_extra_days_sts ==0) //Calculating with extra days interest
							{
								
								$interest_amount = ($interest*$prev_belance*$date_diff2);
							}
							else //normal month wise calculation
							{
								$show_date = $new_date;
								$date_diff= $cals->get_date_diff($new_date,$last_day_mbs,'-');
								$interest_amount = ($interest*$prev_belance*$date_diff);
							}
						}
						else //normal month wise calculation
						{
							$show_date = $new_date;
							$date_diff= $cals->get_date_diff($new_date,$last_day_mbs,'-');
							$interest_amount = ($interest*$prev_belance*$date_diff);
						}
						
						$total_int_belance+=$interest_amount;
						$belance = $prev_belance+$interest_amount;
						if ($total_int_belance<=$over_belance) {

							$total_witdraw = $total_witdraw+$interest_amount;
							$total_interest=$total_interest+$interest_amount;
				               $objWorkSheet->fromArray(array(
					            date("d-M-y",strtotime($show_date)),
					            $loan_ac.'-Normal Int',
					            '',
					            ($interest_amount>0)?number_format($interest_amount,2,'.',','):'',
					            '',
					            '-'.number_format($belance,2,'.',','),
					            ),NULL,'A'.$rowNumber);
					          $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
					          $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border); 
							  
					  $objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					  $objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					  $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


					          $rowNumber++;
				              $prev_belance=$belance;
						}else
						{
				              $objWorkSheet->fromArray(array(
					            date("d-M-y",strtotime($show_date)),
					            $view_loan_ac.'-Normal Int',
					            '',
					            '',
					            '',
					            '-'.number_format($prev_belance,2,'.',','),
					            ),NULL,'A'.$rowNumber);
					          $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
					          $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border); 
							  
					  $objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					  $objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					  $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


					          $rowNumber++;
						}
						$last_day_mbs=$new_date;
						$final_dt = date("Y-m-d",strtotime($new_date));
						$final_belance = round($belance,2);

				}
			}
			$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border); 
			$headings4 = array('','','',number_format($total_witdraw,2,'.',','),number_format($total_deposit,2,'.',','),number_format($final_belance,2,'.',','));
			$objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objWorkSheet->fromArray(array($headings4),NULL,'A'.$rowNumber);
			$objWorkSheet->mergeCells('A'.$rowNumber.':C'.$rowNumber);  
			//$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(14);
			$rowNumber++; 
			$headings4 = array('This is a computer-generated statement and does not require any signature. ','','','','','');
			$objWorkSheet->fromArray(array($headings4),NULL,'A'.$rowNumber);
			$objWorkSheet->mergeCells('A'.$rowNumber.':F'.$rowNumber);  

			$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$rowNumber++; 
			$headings4 = array('**** END OF STATEMENT ****','','','','','');
			$objWorkSheet->fromArray(array($headings4),NULL,'A'.$rowNumber);
			$objWorkSheet->mergeCells('A'.$rowNumber.':F'.$rowNumber);  
			$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(14);

			$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
			$rowNumber++; 
		    $objWorkSheet->setTitle('Statement Summery'); 

		    
		    $file_name_new="generated_statement_".$this->session->userdata['ast_user']['user_id'].'_'.time().'.xls';
		    require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        $objWriter->save(str_replace(__file__,'temp_upload_file/'.$file_name_new,__file__));
	        $data = array('Session_Id'   => $this->session->userdata['ast_user']['user_id'],  
		                'module_name'   => 'statement',
		                'Orginal_file_name'   => '',
		                'data_field_name'   => 'generated_statement',
		                'New_file_name'   => $file_name_new
		     );    
		    $this->db->insert('temp_upload_file', $data);      
		    $new_file_path=$file_name_new;
		$var =array(
		"csrf_token"=>$csrf_token,
		"new_file_path"=>$new_file_path,
		"final_belance"=>$final_belance,
		"final_dt"=>$final_dt
		);
		echo json_encode($var);
	}
	function generate_xl_by_id_card()
	{
		include('./application/Classes/PHPExcel/Calculation/Financial.php');
		$cals = new PHPExcel_Calculation_Financial();
		require_once('./application/Classes/PHPExcel.php'); 
	    $objPHPExcel = new PHPExcel();
	    $csrf_token=$this->security->get_csrf_hash();
		$str='';
		$new_file_path='';
		$prev_file_path = '';
		$libality_statement = '';
		$prev_libality_statement='';
		$id = $this->input->post('id');

		$loan_ac = '';
		$ac_name = '';
		$row = $this->Hoops_model->get_card_data($id);
		$loan_ac = $row->loan_ac;
		$view_loan_ac = $row->card_no;
		$ac_name = $row->card_name;
		$principal_amount = 0;
		$total_interest = 0;
		$amount_paid = 0;
		$pinal_charge = 0;
		$row = array();
		$this->load->library('WebService');
		$ws = new WebService();
		$statement_data = $this->Hoops_model->get_generated_statement_data_by_ac($loan_ac);
		$write_off_sts = 0;
		$final_dt = '';
		$final_belance = '';
		$bb_rate = 9;
		$bb_rate_year = '2020';
		$bb_rate_month = '04';
		$final_dt = '';
		$final_belance = 0;
		//Excel Header Initiate
		$objWorkSheet = $objPHPExcel->createSheet(0);
		$objPHPExcel->setActiveSheetIndex(0);
	        $styleArray_border = array(
	              'borders' => array(
	                  'allborders' => array(
	                      'style' => PHPExcel_Style_Border::BORDER_THIN
	                  )
	              )
	          ); 
	        
		    $rowNumber = 1;
		    $rowNumber++;
		    $rowNumber++;
		    $objWorkSheet->getColumnDimension('A')->setWidth(10); 
		    $objWorkSheet->getColumnDimension('B')->setWidth(10);
		    $objWorkSheet->getColumnDimension('C')->setWidth(10);
		    $objWorkSheet->getColumnDimension('D')->setWidth(10);
		    $objWorkSheet->getColumnDimension('E')->setWidth(10);
		    $objWorkSheet->getColumnDimension('F')->setWidth(10);
		    $objWorkSheet->getColumnDimension('G')->setWidth(15);
		    $objWorkSheet->getColumnDimension('H')->setWidth(15);
		    $objWorkSheet->getColumnDimension('I')->setWidth(10);
		    $objWorkSheet->getColumnDimension('J')->setWidth(10);
		    $headings1 = array('Card No : '.$view_loan_ac);
	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objWorkSheet->mergeCells('A'.$rowNumber.':C'.$rowNumber);  
	        $objWorkSheet->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setSize(10);
	        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('C'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;
		    
	        $headings1 = array('Account Name : '.$ac_name);
	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objWorkSheet->mergeCells('A'.$rowNumber.':D'.$rowNumber);  
	        $objWorkSheet->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setSize(10);
	        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('C'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;
	        
	        $headings1 = array('Currency : BDT');
	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objWorkSheet->mergeCells('A'.$rowNumber.':B'.$rowNumber);  
	        $objWorkSheet->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setSize(10);
	        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('C'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;
	        $rowNumber++;
	        $headings1 = array('STATEMENT OF ACCOUNT FOR THE PERIOD OF '.date("d-M-y").' To '.date("d-M-y").'');
	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objWorkSheet->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
	        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(16);
	        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('A'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;
	        $rowNumber++;  
	      	$headings4 = array('-Mth-','-LPay-','-Rv-','-Age-','-Dun-','-RChq-','Closing Balance','Minimum Paymentt','Debits','Credits');
	        $objWorkSheet->fromArray(array($headings4),NULL,'A'.$rowNumber);
	        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true); 
	        $objWorkSheet->getStyle('A'.$rowNumber.':A'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('J'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'b0b6bb')));
	        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++; 
			if (!empty($statement_data)) {
					foreach($statement_data as $DealRow2)
			        {
			        	$date = date("d-M-y",strtotime($DealRow2->date));
			        	$final_dt = date("Y-m-d",strtotime($date));
						$final_belance = round($DealRow2->mth_close_bl,2);
			              $objWorkSheet->fromArray(array(
				            $date,
				            $DealRow2->mth_late_ind,
				            $DealRow2->mth_revolve_ind,
				            $DealRow2->mth_age_cd,
				            $DealRow2->mth_dunn_cd,
				            $DealRow2->mth_retchq_cnt,
				            $DealRow2->mth_close_bl,
				            '0.00',
				            number_format($DealRow2->mtd_debit,2,'.',','),
				            number_format($DealRow2->mtd_credit,2,'.',','),
				            ),NULL,'A'.$rowNumber);
				          $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
				          $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border); 
				          $rowNumber++;
			        }
			        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border); 
				}

		    //$objPHPExcel->setActiveSheetIndex(0);
		    $objWorkSheet->setTitle('Statement Summery'); 

		    
		    $file_name_new="generated_statement_".$this->session->userdata['ast_user']['user_id'].'_'.time().'.xls';
		    require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        $objWriter->save(str_replace(__file__,'temp_upload_file/'.$file_name_new,__file__));
	        $data = array('Session_Id'   => $this->session->userdata['ast_user']['user_id'],  
		                'module_name'   => 'statement',
		                'Orginal_file_name'   => '',
		                'data_field_name'   => 'generated_statement',
		                'New_file_name'   => $file_name_new
		     );    
		    $this->db->insert('temp_upload_file', $data);      
		    $new_file_path=$file_name_new;

		    $objPHPExcel = new PHPExcel();
		$var =array(
		"csrf_token"=>$csrf_token,
		"new_file_path"=>$new_file_path,
		"final_belance"=>$final_belance,
		"final_dt"=>$final_dt
		);
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
	function generate_xl_html()
	{
		include('./application/Classes/PHPExcel/Calculation/Financial.php');
		$cals = new PHPExcel_Calculation_Financial();
		require_once('./application/Classes/PHPExcel.php'); 
	    $objPHPExcel = new PHPExcel();
		$str='';
		$new_file_path='';
		$prev_file_path = '';
		$libality_statement = '';
		$prev_libality_statement='';
		$liv_dev = config_item('statement_liv_dev');
		$proposed_type = $this->input->post('proposed_type');

		$dt_to = implode('-',explode('/',$this->input->post('dt_to')));
		$dt_from = implode('-',explode('/',$this->input->post('dt_from')));
		$glob_sts = $this->input->post('glob_sts');
		$glob_ac = $this->input->post('glob_ac');
		$csrf_token=$this->security->get_csrf_hash();
		$cma_id = $this->input->post('id');
		$view_loan_ac = $this->input->post('loan_ac');
		$req_type_id = $this->input->post('req_type');
		$loan_ac = '';
		$req_type = '';
		$ac_name = '';
		$cif = '';
		$address = '';
		$last_txrn_date_stored='';
		$principal_amount = 0;
		$total_interest = 0;
		$total_witdraw = 0;
		$total_deposit = 0;
		$amount_paid = 0;
		$pinal_charge = 0;
		$covid_month_exced_sts=0;
		$new_month_extra_days_sts = 0;
		$loop_break_counter = 0;
		$bb_fixed_rate_calc_sts = 0;
		$last_txrn_date = '';
		$last_int_txrn_date = '';
		$statement_start_date='';
		$statement_end_date=$dt_to;
		$row = array();
		$this->load->library('WebService');
		$ws = new WebService();
		$break_down_int_amount = 0;
		$break_down_int_date_from = '';
		$break_down_int_date_to = '';

	// ==========================================================
			// Form API Call //
			$basic_card_no = '100';
			$opening_balance = '100';
			$MTD_debits = '100';
			$credit_limit = '100';
			$MTD_credits = '100'; // Monthly Total Credits
			$minimum_payment = '100';
			$total_minimum_payment = '100';
			$current_due_minimum_payment = '100';
	// ==========================================================

	
		if ($glob_sts==0) //For System data
		{
			$row = $this->Hoops_model->get_generated_statement_file($cma_id);
			$loan_ac = $row->org_loan_ac;
			$ac_name = $row->ac_name;
			$sch_desc = $row->sch_desc;
			$int_rate = $row->int_rate;
			$int_rate = $row->int_rate;
			$address = $row->address;
			$statement_data = $this->Hoops_model->get_generated_statement_data($cma_id);
			if ($proposed_type == 'Loan') {
				$last_txrn_date = $this->Hoops_model->get_last_txrn_date_by_id($cma_id);
				$statement_start_date = $this->Hoops_model->get_first_txrn_date_by_id($cma_id);
				$last_txrn_date = $this->endCycle($last_txrn_date, 1);//incresing last txrnd data to 1 month
			}
			else
			{
				$last_txrn_date ='';
				$statement_start_date ='';
			}
			if($proposed_type=='Loan')
			{
				$last_int_txrn_date = $this->Hoops_model->get_last_int_txrn_date_by_id($cma_id);
			}
			
		}else
		{
			$int_rate = $this->input->post('int_rate');
			if ($proposed_type == 'Loan') { //Get Loan Ac Data
				$loan_ac = $glob_ac;
				//api call for global account name
				$api_config3=$this->Common_model->get_api_config_data('CBS Middleware','Loan Details');
				$cif = substr($loan_ac,5,8);
				if ($api_config3->active_sts==1) {
					$results = $ws->call_service('GetLoanDetalsByCif',$api_config3->dev_live,$api_config3->api_url,$api_config3->user_id,$api_config3->channel_id,$api_config3->password,$cif,$loan_ac);
				}
				$corp_id=array();
				if (!empty($results))
				{
					for ($i=1; $i <=count($results); $i++) 
					{
						if ($results[$i]['accountNumber']==$loan_ac) {
							if (is_object($results[$i]['accountHolderName'])) {
								$ac_name = $results[$i]['accountHolderName'][0];
								$sch_desc = $results[$i]['schmDesc'][0];

							}else
							{
								$ac_name = $results[$i]['accountHolderName'];
								$sch_desc = $results[$i]['schmDesc'];
							}
							$corp_id=$results[$i]['corp_id'];
							break;
						}
					}
					$api_config4=$this->Common_model->get_api_config_data('CBS','n/a');
					if ($corp_id[0]!='') 
					{
						$results3 = $ws->call_service('GetGuarantorFatherInfocorporateByCif',$api_config4->dev_live,$api_config4->api_url,$api_config4->user_id,$api_config4->channel_id,$api_config4->password,$cif);
					}
					else//For Retails Account
					{
						$results3 = $ws->call_service('GetGuarantorFatherInfoByCif',$api_config4->dev_live,$api_config4->api_url,$api_config4->user_id,$api_config4->channel_id,$api_config4->password,$cif);
					}
					//$present_address=ucwords(strtolower($results3[1]['present_address1'][0].$results3[1]['present_address2'][0].$results3[1]['present_address3'][0].' '.$this->get_city_country($results3[1]['present_address_city'][0],'ref_city')));
					//$address=ucwords(strtolower($results3[1]['parmanent_address1'][0].$results3[1]['parmanent_address2'][0].$results3[1]['parmanent_address3'][0].' '.$this->get_city_country($results3[1]['parmanent_address_city'][0],'ref_city')));
					$address=ucwords(strtolower($results3[1]['business_address1'][0].$results3[1]['business_address2'][0].$results3[1]['business_address3'][0].' '.$this->get_city_country($results3[1]['business_address_city'][0],'ref_city')));
				}
			}
			else //Get Card Data
			{
				$loan_ac = $glob_ac;
				//api call for global account name
				$api_config=$this->Common_model->get_api_config_data('Card Pro Sys DB','cardpro');
				if ($api_config->active_sts==1) {
					$results = $this->Common_model->get_card_data('GetCustomerInfoByCardNo',$this->Common_model->stringEncryption('decrypt',$loan_ac),$api_config->dev_live);
				}
				if ($results['Message']=='ok') 
				{
					$ac_name = $results['CARDHOLDER_NAME'];
				}
			}
			$statement_data = $this->Hoops_model->get_generated_statement_data_by_ac($loan_ac);
			$last_txrn_date = $this->Hoops_model->get_last_txrn_date_by_ac($loan_ac);
			$statement_start_date = $this->Hoops_model->get_first_txrn_date_by_ac($loan_ac);
			$last_txrn_date = $this->endCycle($last_txrn_date, 1);//incresing last txrnd data to 1 month
			if ($proposed_type == 'Loan')
			{
				$last_int_txrn_date = $this->Hoops_model->get_last_int_txrn_date_by_ac($loan_ac);
			}
			
		}
		$write_off_sts = 0;
		$write_off_date = '';
		$final_dt = '';
		$final_belance = '';
		$bb_rate = $this->input->post('bb_rate');
		if($bb_rate=='' || $bb_rate<=0)
		{
			$bb_rate = $int_rate;
		}
		$bb_rate_year = '2020';
		$bb_rate_month = '04';
		$bb_rate_date = '2020-04-01';
		//Excel Header Initiate
		$objWorkSheet = $objPHPExcel->createSheet(0);
		$objPHPExcel->setActiveSheetIndex(0);
	        $styleArray_border = array(
	              'borders' => array(
	                  'allborders' => array(
	                      'style' => PHPExcel_Style_Border::BORDER_THIN
	                  )
	              )
	          ); 
	        
		    $rowNumber = 1;
		 

		if($proposed_type=='Loan')
		{
			if(strlen($view_loan_ac)==16)
			{
				$cif = substr($view_loan_ac,5,8);
			}
			else if(strlen($view_loan_ac)==13)
			{
				$cif = substr($view_loan_ac,1,8);
			}
			else
			{
				$cif = "";
			}
		}else{
		   $rowNumber++;
		    $rowNumber++;
		}


				if ($proposed_type=='Loan') {


					$styleArray_text_color = [
						'font' => [
							'color' => [
								'rgb' => '585858', // Replace with your desired color code
							],
						],
					];


					$headings1 = array($ac_name,'','','Customer ID :',$cif);
					$objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
					$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(false);
					$objWorkSheet->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleArray_text_color);

					$objWorkSheet->getStyle('E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$objWorkSheet->getStyle('D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

					$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
					$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);
					$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);


					$rowNumber++;

				}else{

					$objWorkSheet->getColumnDimension('A')->setWidth(15); 
					$objWorkSheet->getColumnDimension('B')->setWidth(15);
					$objWorkSheet->getColumnDimension('C')->setWidth(15);
					$objWorkSheet->getColumnDimension('D')->setWidth(15);
					$objWorkSheet->getColumnDimension('E')->setWidth(15);
					$objWorkSheet->getColumnDimension('F')->setWidth(15);
					$objWorkSheet->getColumnDimension('G')->setWidth(15);
					$objWorkSheet->getColumnDimension('H')->setWidth(25);
					$objWorkSheet->getColumnDimension('I')->setWidth(15);
					$objWorkSheet->getColumnDimension('J')->setWidth(15);



					$headings1 = array('Basic Card','',$basic_card_no,'','Opening Balance','',$opening_balance,'','MTD Debits',$MTD_debits);
					$objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
					$objWorkSheet->mergeCells('A'.$rowNumber.':B'.$rowNumber); 
					$objWorkSheet->mergeCells('C'.$rowNumber.':D'.$rowNumber); 
					$objWorkSheet->mergeCells('E'.$rowNumber.':F'.$rowNumber); 
					$objWorkSheet->mergeCells('G'.$rowNumber.':H'.$rowNumber); 
					$objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setSize(12);
					$objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setBold(true);
					$objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(12);
					$objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
					$objWorkSheet->getStyle('I'.$rowNumber.':I'.$rowNumber)->getFont()->setSize(12);
					$objWorkSheet->getStyle('I'.$rowNumber.':I'.$rowNumber)->getFont()->setBold(true);
					$objWorkSheet->getStyle('E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$objWorkSheet->getStyle('D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					$objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
					$objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
					$rowNumber++;

					$headings1 = array('Credit Limit','',$credit_limit,'','MTD Credits','',$MTD_credits,'','Past Due Minimum Payment',$minimum_payment);
					$objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
					$objWorkSheet->mergeCells('A'.$rowNumber.':B'.$rowNumber); 
					$objWorkSheet->mergeCells('C'.$rowNumber.':D'.$rowNumber); 
					$objWorkSheet->mergeCells('E'.$rowNumber.':F'.$rowNumber); 
					$objWorkSheet->mergeCells('G'.$rowNumber.':H'.$rowNumber); 
					$objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setSize(12);
					$objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setBold(true);
					$objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(12);
					$objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
					$objWorkSheet->getStyle('I'.$rowNumber.':I'.$rowNumber)->getFont()->setSize(12);
					$objWorkSheet->getStyle('I'.$rowNumber.':I'.$rowNumber)->getFont()->setBold(true);
					$objWorkSheet->getStyle('E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$objWorkSheet->getStyle('D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					$objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
					$objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
					$rowNumber++;


					$headings1 = array('Total Minimum Payment','',$total_minimum_payment,'','Current Due Minimum Payment','',$current_due_minimum_payment,'','','');
					$objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
					$objWorkSheet->mergeCells('A'.$rowNumber.':B'.$rowNumber); 
					$objWorkSheet->mergeCells('C'.$rowNumber.':D'.$rowNumber); 
					$objWorkSheet->mergeCells('E'.$rowNumber.':F'.$rowNumber); 
					$objWorkSheet->mergeCells('G'.$rowNumber.':H'.$rowNumber); 
					$objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setSize(12);
					$objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getFont()->setBold(true);
					$objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(12);
					$objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
					$objWorkSheet->getStyle('I'.$rowNumber.':I'.$rowNumber)->getFont()->setSize(12);
					$objWorkSheet->getStyle('I'.$rowNumber.':I'.$rowNumber)->getFont()->setBold(true);
					$objWorkSheet->getStyle('E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$objWorkSheet->getStyle('D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					$objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
					$objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
					$rowNumber++;
					$headings1 = array('','','','','','','','','','');
					$objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
					$objWorkSheet->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
					$rowNumber++;

				}

		    if ($proposed_type=='Loan') {

	        	$objWorkSheet->getColumnDimension('A')->setWidth(15); 
			    $objWorkSheet->getColumnDimension('B')->setWidth(6);
			    $objWorkSheet->getColumnDimension('C')->setWidth(20);
			    $objWorkSheet->getColumnDimension('D')->setWidth(15);
			    $objWorkSheet->getColumnDimension('E')->setWidth(15);
			    $objWorkSheet->getColumnDimension('F')->setWidth(15);
			    $headings1 = array('','','','Account No :',''.$view_loan_ac);
		        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objWorkSheet->mergeCells('E'.$rowNumber.':F'.$rowNumber);  
		        $objWorkSheet->getStyle('E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);

		        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
		        $objWorkSheet->getStyle('D'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);

				$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);

		        $objWorkSheet->getStyle('D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		        $objPHPExcel->getActiveSheet()->setCellValueExplicit(('E'.$rowNumber), $view_loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
		        $rowNumber++;
	        }else
	        {

	        }
		    
			if ($proposed_type=='Loan') {


			$styleArray_text_color = [
				'font' => [
					'color' => [
						'rgb' => '585858', // Replace with your desired color code
					],
				],
			];

			$objWorkSheet->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleArray_text_color);

			$headings1 = array($address,'','','A/C Type :',$sch_desc);

	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
			$objWorkSheet->mergeCells('A'.$rowNumber.':C'.$rowNumber);  
	        $objWorkSheet->mergeCells('E'.$rowNumber.':F'.$rowNumber); 
	        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getFont()->setSize(12);
	        $objWorkSheet->getStyle('E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objWorkSheet->getStyle('D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
	        
			$objWorkSheet->getStyle('D'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);

			$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);

	        $rowNumber++;

			$headings1 = array('','','','Currency :','BDT');
	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        // $objWorkSheet->mergeCells('E'.$rowNumber.':F'.$rowNumber);  
			$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);
	        $objWorkSheet->getStyle('E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objWorkSheet->getStyle('D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true);
	        $objWorkSheet->getStyle('D'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);
	   

			}



	       
	        if ($proposed_type=='Loan') {
				$rowNumber++;
	        	$headings1 = array('STATEMENT OF ACCOUNT FOR THE PERIOD OF '.date("d-M-y",strtotime($statement_start_date)).' To '.date("d-M-y",strtotime($dt_to)).'');
		        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objWorkSheet->mergeCells('A'.$rowNumber.':F'.$rowNumber); 
		        $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);
		        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		        $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
		        $objWorkSheet->getStyle('A'.$rowNumber)->getFont()->setBold(true);
				$rowNumber++;

	        }else
	        {
	

	        }
	   
	        if ($proposed_type=='Loan') {  //For Loan
				$rowNumber++;

              	$headings4 = array('DATE','PARTICULARS','INST NO.','WITHDRAW','DEPOSIT','BALANCE');
		        $objWorkSheet->fromArray(array($headings4),NULL,'A'.$rowNumber);
		        $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		     	$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);
			    $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objWorkSheet->getStyle('A'.$rowNumber.':A'.$rowNumber)->getAlignment()->setWrapText(true);
		        $objWorkSheet->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);

		        // $objWorkSheet->getStyle('A10:F'.$rowNumber)->applyFromArray($styleArray_border);
		        $rowNumber++; 
	        }
	        else
	        {
	
				$headings4 = array('-Mth-','-LPay-','-Rv-','-Age-','-Dun-','-RChq-','Closing Balance','Minimum Paymentt','Debits','Credits');

		        $objWorkSheet->fromArray(array($headings4),NULL,'A'.$rowNumber);
		        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true); 
		        $objWorkSheet->getStyle('A'.$rowNumber.':A'.$rowNumber)->getAlignment()->setWrapText(true);
		        $objWorkSheet->getStyle('J'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
		        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'b0b6bb')));
		        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
		        $rowNumber++; 
	        }


		
		if (!empty($row) && !empty($row->generated_statement)) {
			$prev_file_path = $row->generated_statement;
			$prev_libality_statement = $row->libality_statement;
		}
			if ($proposed_type=='Loan') { //For Loan Data
				$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" id="grid_table_div" class="grid_table_div">

				
				<table id="result_table" border="0" style="margin-left:10px;width:99%;font-size:13px;border-collapse:collapse;width:98%;">
				<tr>
					<td colspan="3" style="font-weight: bold;text-align:left">'.$ac_name.'</td>
					<td style="font-weight: bold;text-align:left">Customer ID </td>
					<td colspan="3" style="font-weight: bold;text-align:left">: '.$cif.'</td>
				</tr>
				<tr>
					<td colspan="3" style="font-weight: bold;text-align:left"></td>
					<td style="font-weight: bold;text-align:left">Account No  </td>
					<td colspan="3" style="font-weight: bold;text-align:left">: '.$view_loan_ac.'</td>
				</tr>
				<tr>
					<td colspan="3" style="font-weight: bold;text-align:left">'.$address.'</td>
					<td style="font-weight: bold;text-align:left">A/C Type  </td>
					<td colspan="3" style="font-weight: bold;text-align:left">: '.$sch_desc.'</td>
				</tr>
				<tr>
					<td colspan="3" style="font-weight: bold;text-align:left"></td>
					<td style="font-weight: bold;text-align:left">Currency  </td>
					<td colspan="3" style="font-weight: bold;text-align:left">: BDT</td>
				</tr>
				<tr>
					<td colspan="6" style="font-weight: bold;text-align:left">STATEMENT OF ACCOUNT FOR THE PERIOD OF '.date("d-M-y",strtotime($statement_start_date)).' To '.date("d-M-y",strtotime($dt_to)).'</td>
				</tr>
				<tr>
					<td colspan="6" style="font-weight: bold;text-align:center">&nbsp;</td>
				</tr>
				<tr style="border:0px solid black">
					<td width="10%" style="font-weight: bold;text-align:center;border:0px solid black">Date</td>
					<td width="40%" style="font-weight: bold;text-align:center;border:0px solid black">Particulars</td>
					<td width="10%" style="font-weight: bold;text-align:center;border:0px solid black">INST NO.</td>
					<td width="15%" style="font-weight: bold;text-align:center;border:0px solid black">Withdraw</td>
					<td width="10%" style="font-weight: bold;text-align:center;border:0px solid black">Deposit</td>
					<td width="15%" style="font-weight: bold;text-align:center;border:0px solid black">Belance</td>
				</tr>
				<tbody id="table_tbody">';
			}else //For Card Data
			{



				$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" id="grid_table_div" class="grid_table_div">
				<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">



				<thead style="">
					<tr>
						<td colspan="2" style="font-weight: bold;text-align:left"> Basic Card: </td>
						<td colspan="2" style="text-align:left">'.$basic_card_no.'</td>
					
						<td colspan="2" style="font-weight: bold;text-align:left">Opening Balance</td>
						<td colspan="2" style="text-align:left">'.$opening_balance.'</td>

						<td colspan="1" style="font-weight: bold;text-align:left">MTD Debits</td>
						<td colspan="1" style="text-align:left">'.$MTD_debits.'</td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight: bold;text-align:left">Credit Limit</td>
						<td colspan="2" style="text-align:left">'.$credit_limit.'</td>
						<td colspan="2" style="font-weight: bold;text-align:left">MTD Credits</td>
						<td colspan="2" style="text-align:left">'.$MTD_credits.'</td>
						<td colspan="1" style="font-weight: bold;text-align:left">Past Due Minimum Payment</td>
						<td colspan="1" style="text-align:left">'.$minimum_payment.'</td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight: bold;text-align:left">Total Minimum Payment</td>
						<td colspan="2" style="text-align:left"> '.$total_minimum_payment.' </td>
						<td colspan="2" style="font-weight: bold;text-align:left">Current Due Minimum Payment</td>
						<td colspan="2" style="text-align:left">'.$current_due_minimum_payment.'</td>
						<td colspan="1" style="font-weight: bold;text-align:left"></td>
						<td colspan="1" style="text-align:left"></td>
					</tr>
			
					<tr>
						<td colspan="10" style="font-weight: bold;text-align:center">&nbsp;</td>
					</tr>
	
				</thead>



				<thead style="color: #0066a0;">
					<th width="10%" style="font-weight: bold;text-align:center">-Mth-</th>
					<th width="10%" style="font-weight: bold;text-align:left">-LPay-</th>
					<th width="10%" style="font-weight: bold;text-align:left">-Rv-</th>
					<th width="10%" style="font-weight: bold;text-align:left">-Age-</th>
					<th width="10%" style="font-weight: bold;text-align:left">-Dun-</th>
					<th width="10%" style="font-weight: bold;text-align:left">-RChq-</th>
					<th width="10%" style="font-weight: bold;text-align:left">Closing Balance</th>
					<th width="10%" style="font-weight: bold;text-align:left">Minimum Payment</th>
					<th width="10%" style="font-weight: bold;text-align:left">Debits</th>
					<th width="10%" style="font-weight: bold;text-align:left">Credits</th>
				</thead>



				<tbody id="table_tbody">';
			}
			if ($proposed_type=='Loan') 
			{
				$loan_belance=0;
				$over_belance=0;
				$belance=0;
				$total_int_belance=0;
				$count=1;
				$prev_belance=0;
				$last_date_mbs='';
				if (!empty($statement_data)) 
				{
					foreach($statement_data as $DealRow2)
			        {
			         if($DealRow2->withdraw_amount<=0 && $DealRow2->deposit_amount<=0)
			         {
			         	continue;
			         }
			         if ($count==1) //For first row
			         {
			         	$belance=$DealRow2->withdraw_amount;
			         	$principal_amount = $belance;
			         	$over_belance = round(($belance*3),2);
			         	$total_int_belance+=round($belance,2);
			         }
			         else
			         {
			         	if ($DealRow2->withdraw_amount>0) //For interest add
			         	{
			         		$belance = $prev_belance+$DealRow2->withdraw_amount;
			         		$total_int_belance+=$DealRow2->withdraw_amount;
			         		$total_interest=$total_interest+$DealRow2->withdraw_amount;
			         	}
			         	if ($DealRow2->deposit_amount>0) //For Deposit Remove
			         	{
			         		$belance = $prev_belance-$DealRow2->deposit_amount;
			         		$amount_paid=$amount_paid+$DealRow2->deposit_amount;
			         	}
			         	
			         }
			         $withdraw_amount = ($DealRow2->withdraw_amount>0)?number_format($DealRow2->withdraw_amount,2,'.',','):"";
			         $deposit_amount = ($DealRow2->deposit_amount>0)?number_format($DealRow2->deposit_amount,2,'.',','):"";
			          $total_witdraw = $total_witdraw+$DealRow2->withdraw_amount;
			          $total_deposit = $total_deposit+$DealRow2->deposit_amount;
			          if ($count==1)
			          {
			          	$statement_start_date=$DealRow2->date;
			          }
					  
			          $date = date("d-M-y",strtotime($DealRow2->date));
			        	//For HTML VIEW
			        	$str.='<tr style="border:0px solid black">
		                  <td align="center" style="border:0px solid black">'.$date.'</td>

		                  <td align="left" style="border:0px solid black">'.$DealRow2->particulars.'</td>

		                  <td align="center" style="border:0px solid black"></td>

		                  <td align="right" style="border:0px solid black">'.$withdraw_amount.'</td>
		                  <td align="right" style="border:0px solid black">'.$deposit_amount.'</td>
		                  <td align="right" style="border:0px solid black">'.number_format($belance,2,'.',',').'</td>
		              </tr>';
		              $objWorkSheet->fromArray(array(
			            $date,
			            $DealRow2->particulars,
						'',
			            ($DealRow2->withdraw_amount>0)?number_format($DealRow2->withdraw_amount,2,'.',','):'',
			            ($DealRow2->deposit_amount>0)?number_format($DealRow2->deposit_amount,2,'.',','):'',
			            '-'.number_format($belance,2,'.',','),


			            ),NULL,'A'.$rowNumber);

			          $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(false);
					 $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);



					  $objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					  $objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					  $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


			        //   $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border); 
			          $rowNumber++;



		              $count++;
		              $prev_belance=$belance;
		              if ($DealRow2->type=='w') { //Taking only interest date
		              	$last_date_mbs=$DealRow2->date;
		              }
			        }
			        $last_day_mbs = $last_date_mbs;
				}
				$date = $dt_to; /// To Date For Statement
				while (1) 
				{
					$break_down_int_amount = 0;
					$break_down_int_date_from = '';
					$break_down_int_date_to = '';
					$loop_break_counter++;
					if($loop_break_counter>1000) //Breaking the unstopped error looop
					{
						break;
					}

					$new_date = $this->endCycle($last_day_mbs, 1);//for normally increse 1 month
					$cur_date=explode("-",$new_date);
					//getting Interest Amount
					if ($new_date>=$bb_rate_date && $bb_fixed_rate_calc_sts==0) {
						$bb_fixed_rate_calc_sts = 1;
					}
					if($bb_fixed_rate_calc_sts==1)
					{
						$interest=($bb_rate/360)/100;//For BB Fixed Interest Rate calculation
					}else
					{
						$interest=($int_rate/360)/100;
					}
					if($last_txrn_date_stored!='' && $covid_month_exced_sts==1) //when last txrn date stored on bellow condition of bb fixed rate calculation
					{
						$new_date = $this->endCycle($last_txrn_date_stored, 1);
						$last_day_mbs = date('Y-m-d', strtotime($last_day_mbs. ' + 1 days'));//Adding one extra day for april month bb rate calculation
						$cur_date = explode("-",$new_date);
						$covid_month_exced_sts=0;
					}
					//if ($cur_date[0]>=$bb_rate_year && $cur_date[1]>=$bb_rate_month && $last_txrn_date_stored=='') { //when new month is equal to bb int fixed calculation
					if ($new_date>=$bb_rate_date && $last_txrn_date_stored=='' && $last_day_mbs<$bb_rate_date) { //when new month is equal to bb int fixed calculation
						$last_txrn_date_stored=$last_day_mbs;
						$new_date = date("Y-m-t", strtotime($last_day_mbs));
						$cur_date=explode("-",$new_date);
						$covid_month_exced_sts=1;
					}
					
				 	$from_date=explode("-",$date);


				 	//inserting recovery data which was comes from xcrv api.
					$last_txrn_date_array = explode("-",$last_txrn_date);
					if($new_date<=$last_txrn_date)
					{
						if ($glob_sts==0) //For System data
						{
							$recovery_data = $this->Hoops_model->get_xcrv_recovery_data_by_id($cma_id,$last_day_mbs,$new_date,$last_int_txrn_date,$loop_break_counter);
						}
						else
						{
							$recovery_data = $this->Hoops_model->get_xcrv_recovery_data_by_ac($loan_ac,$last_day_mbs,$new_date,$last_int_txrn_date,$loop_break_counter);
						}
						
						if (!empty($recovery_data)) 
						{
							$break_down_int_amount = 0;
							$break_down_int_date_from = $last_day_mbs;
							foreach ($recovery_data as $key) 
							{
								//calculating breakdonw interest amount //////////
								$break_down_int_date_to = $key->date;
								$date_diff_breakdown_recovery= $cals->get_date_diff($break_down_int_date_to,$break_down_int_date_from,'-');
								$break_down_int_amount+=($interest*$prev_belance*$date_diff_breakdown_recovery);
								$break_down_int_date_from = $key->date;
								////////////// End ////////////////////
								$belance = $prev_belance-$key->deposit_amount;
								$amount_paid=$amount_paid+$key->deposit_amount;
								$total_deposit = $total_deposit+$key->deposit_amount;
								$str.='<tr style="border:0px solid black">
					                  <td align="center" style="border:0px solid black">'.date("d-M-y",strtotime($key->date)).'</td>
					                  <td align="left" style="border:0px solid black">'.$key->particulars.'</td>
						              <td align="center" style="border:0px solid black"></td>
					                  <td align="right" style="border:0px solid black"></td>
					                  <td align="right" style="border:0px solid black">'.number_format($key->deposit_amount,2,'.',',').'</td>
					                  <td align="right" style="border:0px solid black">'.number_format($belance,2,'.',',').'</td>
					              </tr>';
					              $objWorkSheet->fromArray(array(
							            date("d-M-y",strtotime($key->date)),
							            $key->particulars,
							            '',
							            '',
							            ($key->deposit_amount>0)?number_format($key->deposit_amount,2,'.',','):'',
							            '-'.number_format($belance,2,'.',','),
						            ),NULL,'A'.$rowNumber);
						     

									$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(false);
									$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);



								  
							  		$objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
							  		$objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
							  		$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


						          $rowNumber++;
					            $prev_belance=$belance;
							}
						}
						else
						{
							$break_down_int_amount = 0;
							$break_down_int_date_from = '';
							$break_down_int_date_to = '';
						}
					}
					$recovery_data = $this->Hoops_model->get_recovery_data($loan_ac,$last_day_mbs,$new_date,$loop_break_counter);
					if (!empty($recovery_data)) 
					{
						if($break_down_int_amount == 0)
						{
							$break_down_int_date_from = $last_day_mbs;
						}
						foreach ($recovery_data as $key) 
						{
							//calculating breakdonw interest amount //////////
								$break_down_int_date_to = $key->trans_date;
								$date_diff_breakdown_recovery= $cals->get_date_diff($break_down_int_date_to,$break_down_int_date_from,'-');
								$break_down_int_amount+=($interest*$prev_belance*$date_diff_breakdown_recovery);
								$break_down_int_date_from = $key->trans_date;
							////////////// End ////////////////////
							$belance = $prev_belance-$key->amount;
							$amount_paid=$amount_paid+$key->amount;
							$total_deposit = $total_deposit+$key->amount;
							$str.='<tr style="border:0px solid black">
				                  <td align="center" style="border:0px solid black">'.date("d-M-y",strtotime($key->trans_date)).'</td>
				                  <td align="left" style="border:0px solid black">'.$key->narration.'</td>
					              <td align="center" style="border:0px solid black"></td>
				                  <td align="right" style="border:0px solid black"></td>
				                  <td align="right" style="border:0px solid black">'.number_format($key->amount,2,'.',',').'</td>
				                  <td align="right" style="border:0px solid black">'.number_format($belance,2,'.',',').'</td>
				              </tr>';
				              $objWorkSheet->fromArray(array(
						            date("d-M-y",strtotime($key->trans_date)),
						            $key->narration,
						            '',
						            '',
						            ($key->amount>0)?number_format($key->amount,2,'.',','):'',
						            '-'.number_format($belance,2,'.',','),
					            ),NULL,'A'.$rowNumber);
					        		$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(false);
									$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);

							  
						  		$objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						  		$objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						  		$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


					          $rowNumber++;
				            $prev_belance=$belance;
						}
					}


				 	if ($new_date > implode('-',array_reverse(explode('-',$date)))) {
				 		if($new_month_extra_days_sts == 1 || $loop_break_counter==1) //Calculating new month extra days interest
				 		{
				 			if($bb_fixed_rate_calc_sts==1)
							{
								$interest=($bb_rate/360)/100;//For BB Fixed Interest Rate calculation
							}else
							{
								$interest=($int_rate/360)/100;
							}
							
				 			$date_diff2= $cals->get_date_diff(implode('-',array_reverse(explode('-',$date))),$last_day_mbs,'-');//initiliaze the extra days
				 			$show_date = date('Y-m-d', strtotime($last_day_mbs. ' + '.$date_diff2.' days'));
							$interest_amount = ($interest*$prev_belance*$date_diff2);

							//Checkin if any breakdonw intereset amount calculated for Recovery on upper condition
							if($break_down_int_amount>0)
							{
								$date_diff_breakdown_recovery= $cals->get_date_diff($show_date,$break_down_int_date_from,'-');
								$break_down_int_amount+=($interest*$prev_belance*$date_diff_breakdown_recovery);
								$interest_amount = $break_down_int_amount;
								$break_down_int_amount = 0;
								$break_down_int_date_from = '';
								$break_down_int_date_to = '';
							}
							/////////////

							$total_int_belance+=$interest_amount;
							if ($total_int_belance<=$over_belance) {
							$belance = $prev_belance+$interest_amount;
								$total_witdraw = $total_witdraw+$interest_amount;
								$total_interest=$total_interest+$interest_amount;
								$str.='<tr style="border:0px solid black">
					                  <td align="center" style="border:0px solid black">'.date("d-M-y",strtotime($show_date)).'</td>
					                  <td align="left" style="border:0px solid black">'.$view_loan_ac.'-Normal Int</td>
					                  <td align="center" style="border:0px solid black"></td>
					                  <td align="right" style="border:0px solid black">'.number_format($interest_amount,2,'.',',').'</td>
					                  <td align="right" style="border:0px solid black"></td>
					                  <td align="right" style="border:0px solid black">'.number_format($belance,2,'.',',').'</td>
					              </tr>';
					               $objWorkSheet->fromArray(array(
						            date("d-M-y",strtotime($show_date)),
						            $view_loan_ac.'-Normal Int',
						            '',
						            number_format($interest_amount,2,'.',','),
						            '',
						            '-'.number_format($belance,2,'.',','),
						            ),NULL,'A'.$rowNumber);
						     		$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(false);
									$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);

				  				  $objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				  					$objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				  				  $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


						          $rowNumber++;
					              $prev_belance=$belance;
							}else
							{
								$str.='<tr style="border:0px solid black">
					                  <td align="center" style="border:0px solid black">'.date("d-M-y",strtotime($show_date)).'</td>
					                  <td align="left" style="border:0px solid black">'.$view_loan_ac.'-Normal Int'.'</td>
					                  <td align="center" style="border:0px solid black"></td>
					                  <td align="right" style="border:0px solid black"></td>
					                  <td align="right" style="border:0px solid black"></td>
					                  <td align="right" style="border:0px solid black">'.number_format($prev_belance,2,'.',',').'</td>
					              </tr>';
					              $objWorkSheet->fromArray(array(
						            date("d-M-y",strtotime($show_date)),
						            $view_loan_ac.'-Normal Int',
						            '',
						            '',
						            '',
						            '-'.number_format($prev_belance,2,'.',','),
						            ),NULL,'A'.$rowNumber);
						    		$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(false);
									$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);

				  				$objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				  				$objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				  				$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


						     	$rowNumber++;
							}
							$last_day_mbs=$new_date;
							$final_dt = date("Y-m-d",strtotime($new_date));
							$final_belance = round($belance,2);
				 		}
				 		$final_belance = round($belance,2);
						break;
					}

					//$date_diff= $cals->get_date_diff($new_date,$last_day_mbs,'-');
					//if ($cur_date[0]>=$bb_rate_year && $cur_date[1]>=$bb_rate_month) {
					
					$final_month = $this->endCycle($new_date, 1);
					if ($final_month > implode('-',array_reverse(explode('-',$date)))) { //initiliaze the last month
						$date_diff2= $cals->get_date_diff(implode('-',array_reverse(explode('-',$date))),$last_day_mbs,'-');//initiliaze the extra days
						$show_date = date('Y-m-d', strtotime($last_day_mbs. ' + '.$date_diff2.' days'));
						$str1=explode('-',$show_date);//Extra Date Calculated Month
						$str2=explode('-',$new_date); //New Date Month
						if($str1[2]>$str2[2])
						{
							$new_month_extra_days_sts = 1;
						}
						if($date_diff2>0 && $new_month_extra_days_sts ==0) //Calculating with extra days interest
						{
							
							$interest_amount = ($interest*$prev_belance*$date_diff2);
						}
						else //normal month wise calculation
						{
							$show_date = $new_date;
							$date_diff= $cals->get_date_diff($new_date,$last_day_mbs,'-');
							$interest_amount = ($interest*$prev_belance*$date_diff);
						}
					}
					else //normal month wise calculation
					{
						if ($new_date>=$bb_rate_date && $bb_fixed_rate_calc_sts==0) {
							$interest=($bb_rate/360)/100;//For BB Fixed Interest Rate calculation
						}
						else
						{
							$interest=($int_rate/360)/100;
						}
						$show_date = $new_date;
						$date_diff= $cals->get_date_diff($new_date,$last_day_mbs,'-');
						$interest_amount = ($interest*$prev_belance*$date_diff);
					}
					//Checkin if any breakdonw intereset amount calculated for Recovery on upper condition
					if($break_down_int_amount>0)
					{
						$date_diff_breakdown_recovery= $cals->get_date_diff($show_date,$break_down_int_date_from,'-');
						$break_down_int_amount+=($interest*$prev_belance*$date_diff_breakdown_recovery);
						$interest_amount = $break_down_int_amount;
						$break_down_int_amount = 0;
						$break_down_int_date_from = '';
						$break_down_int_date_to = '';
					}
					/////////////
					$total_int_belance+=$interest_amount;
					
					if ($total_int_belance<=$over_belance) {
						$belance = $prev_belance+$interest_amount;
						$total_witdraw = $total_witdraw+$interest_amount;
						$total_interest=$total_interest+$interest_amount;
						$str.='<tr style="border:0px solid black">
			                  <td align="center" style="border:0px solid black">'.date("d-M-y",strtotime($show_date)).'</td>
			                  <td align="left" style="border:0px solid black">'.$view_loan_ac.'-Normal Int</td>
					          <td align="center" style="border:0px solid black"></td>
			                  <td align="right" style="border:0px solid black">'.number_format($interest_amount,2,'.',',').'</td>
			                  <td align="right" style="border:0px solid black"></td>
			                  <td align="right" style="border:0px solid black">'.number_format($belance,2,'.',',').'</td>
			              </tr>';
			               $objWorkSheet->fromArray(array(
				            date("d-M-y",strtotime($show_date)),
				            $view_loan_ac.'-Normal Int',
				            '',
				            ($interest_amount>0)?number_format($interest_amount,2,'.',','):'',
				            '',
				            '-'.number_format($belance,2,'.',','),
				            ),NULL,'A'.$rowNumber);
				    		$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(false);
									$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);

				  $objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				  $objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				  $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


				          $rowNumber++;
			              $prev_belance=$belance;
					}else
					{
						$str.='<tr style="border:0px solid black">
			                  <td align="center" style="border:0px solid black">'.date("d-M-y",strtotime($show_date)).'</td>
			                  <td align="left" style="border:0px solid black">'.$view_loan_ac.'-Normal Int'.'</td>
					          <td align="center" style="border:0px solid black"></td>
			                  <td align="right" style="border:0px solid black"></td>
			                  <td align="right" style="border:0px solid black"></td>
			                  <td align="right" style="border:0px solid black">'.number_format($prev_belance,2,'.',',').'</td>
			              </tr>';
			              $objWorkSheet->fromArray(array(
				            date("d-M-y",strtotime($show_date)),
				            $view_loan_ac.'-Normal Int',
				            '',
				            '',
				            '',
				            '-'.number_format($prev_belance,2,'.',','),
				            ),NULL,'A'.$rowNumber);
				    		$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(false);
									$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);

				  $objWorkSheet->getStyle('A'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				  $objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				  $objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


				          $rowNumber++;
					}
					$last_day_mbs=$new_date;
					$final_dt = date("Y-m-d",strtotime($new_date));
					$final_belance = round($belance,2);

				}


				$styleArray_border_only_top = array(
					'borders' => array(
						'top' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				); 

				$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(false);
				$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);

				$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray_border_only_top); 

				$headings4 = array('','','',number_format($total_witdraw,2,'.',','),number_format($total_deposit,2,'.',','),number_format($final_belance,2,'.',','));
				$objWorkSheet->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$objWorkSheet->fromArray(array($headings4),NULL,'A'.$rowNumber);
				$objWorkSheet->mergeCells('A'.$rowNumber.':C'.$rowNumber);  
				//$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(14);
				$str.='<tr style="border-top:1px solid black">
					<td colspan="3" style="font-weight: bold;text-align:center">&nbsp;</td>
					<td  style="text-align:right;border:0px solid black">'.number_format($total_witdraw,2,'.',',').'</td>
					<td  style="text-align:right;border:0px solid black">'.number_format($total_deposit,2,'.',',').'</td>
					<td  style="text-align:right;border:0px solid black">'.number_format($final_belance,2,'.',',').'</td>
				</tr>';
				$str.='<tr style="border:0px solid black">
					<td colspan="6" style="font-weight: bold;text-align:center;border:0px solid black">**** END OF STATEMENT ****</td>
				</tr>';
				$rowNumber++; 
				

				$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$rowNumber++; 
				$headings4 = array('**** END OF STATEMENT ****','','','','','');
				$objWorkSheet->fromArray(array($headings4),NULL,'A'.$rowNumber);
				$objWorkSheet->mergeCells('A'.$rowNumber.':F'.$rowNumber);  


				$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(false);
				$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(10);



				$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objWorkSheet->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$rowNumber++; 




			}
			else
			{
				if (!empty($statement_data)) {
					foreach($statement_data as $DealRow2)
			        {
			        	$date = date("d-M-y",strtotime($DealRow2->date));
			        	$final_dt = date("Y-m-d",strtotime($date));
						$final_belance = round($DealRow2->mth_close_bl,2);
			        	$str.='<tr>
			                  <td align="center">'.$date.'</td>
			                  <td align="left">'.$DealRow2->mth_late_ind.'</td>
			                  <td align="left">'.$DealRow2->mth_revolve_ind.'</td>
			                  <td align="left">'.$DealRow2->mth_age_cd.'</td>
			                  <td align="left">'.$DealRow2->mth_dunn_cd.'</td>
			                  <td align="left">'.$DealRow2->mth_retchq_cnt.'</td>
			                  <td align="left">'.$DealRow2->mth_close_bl.'</td>
			                  <td align="left">0.00</td>
			                  <td align="left">'.number_format($DealRow2->mtd_debit,2,'.',',').'</td>
			                  <td align="left">'.number_format($DealRow2->mtd_credit,2,'.',',').'</td>
			              </tr>';
			              $objWorkSheet->fromArray(array(
				            $date,
				            $DealRow2->mth_late_ind,
				            $DealRow2->mth_revolve_ind,
				            $DealRow2->mth_age_cd,
				            $DealRow2->mth_dunn_cd,
				            $DealRow2->mth_retchq_cnt,
				            $DealRow2->mth_close_bl,
				            '0.00',
				            number_format($DealRow2->mtd_debit,2,'.',','),
				            number_format($DealRow2->mtd_credit,2,'.',','),
				            ),NULL,'A'.$rowNumber);
				          $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setWrapText(true);
				          $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border); 
				          $rowNumber++;
			        }
			        $objWorkSheet->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border); 
				}
			}

		    //$objPHPExcel->setActiveSheetIndex(0);
		    $objWorkSheet->setTitle('Statement Summery'); 

		    
		    $file_name_new="generated_statement_".$this->session->userdata['ast_user']['user_id'].'_'.time().'.xls';
		    require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        $objWriter->save(str_replace(__file__,'temp_upload_file/'.$file_name_new,__file__));
	        $data = array('Session_Id'   => $this->session->userdata['ast_user']['user_id'],  
		                'module_name'   => 'statement',
		                'Orginal_file_name'   => '',
		                'data_field_name'   => 'generated_statement',
		                'New_file_name'   => $file_name_new
		     );    
		    $this->db->insert('temp_upload_file', $data);      
		    $new_file_path=$file_name_new;

		    $objPHPExcel = new PHPExcel();
		    //For Libality Description
		    $objWorkSheet = $objPHPExcel->createSheet(0);
		    $rowNumber=1;
			$objPHPExcel->setActiveSheetIndex(0);
			$rowNumber++;
		    $rowNumber++;
		    if ($proposed_type=='Loan') {
	        	$objWorkSheet->getColumnDimension('A')->setWidth(10); 
			    $objWorkSheet->getColumnDimension('B')->setWidth(35);
			    $objWorkSheet->getColumnDimension('C')->setWidth(25);
			    $objWorkSheet->getColumnDimension('D')->setWidth(20);
			    $objWorkSheet->getColumnDimension('E')->setWidth(30);
			    $objWorkSheet->getColumnDimension('F')->setWidth(25);
			    $objWorkSheet->getColumnDimension('G')->setWidth(15);
			    $objWorkSheet->getColumnDimension('H')->setWidth(25);
			    $objWorkSheet->getColumnDimension('I')->setWidth(15);
			    $objWorkSheet->getColumnDimension('J')->setWidth(33);
			    $headings1 = array('Account No : '.$view_loan_ac);
		        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objWorkSheet->mergeCells('A'.$rowNumber.':B'.$rowNumber);  
		        $objWorkSheet->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setSize(10);
		        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objWorkSheet->getStyle('C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objWorkSheet->getStyle('C'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
		        $objWorkSheet->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);
		        $rowNumber++;
	        }else
	        {
	        	$objWorkSheet->getColumnDimension('A')->setWidth(10); 
			    $objWorkSheet->getColumnDimension('B')->setWidth(35);
			    $objWorkSheet->getColumnDimension('C')->setWidth(25);
			    $objWorkSheet->getColumnDimension('D')->setWidth(10);
			    $objWorkSheet->getColumnDimension('E')->setWidth(10);
			    $objWorkSheet->getColumnDimension('F')->setWidth(10);
			    $objWorkSheet->getColumnDimension('G')->setWidth(15);
			    $objWorkSheet->getColumnDimension('H')->setWidth(15);
			    $objWorkSheet->getColumnDimension('I')->setWidth(10);
			    $objWorkSheet->getColumnDimension('J')->setWidth(10);
			    $headings1 = array('Card No : '.$view_loan_ac);
		        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objWorkSheet->mergeCells('A'.$rowNumber.':C'.$rowNumber);  
		        $objWorkSheet->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setSize(10);
		        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objWorkSheet->getStyle('C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objWorkSheet->getStyle('C'.$rowNumber.':D'.$rowNumber)->getAlignment()->setWrapText(true);
		        $objWorkSheet->getStyle('A'.$rowNumber.':D'.$rowNumber)->getFont()->setBold(true);
		        $rowNumber++;
	        }
		    
	        $headings1 = array('Account Name : '.$ac_name);
	        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objWorkSheet->mergeCells('A'.$rowNumber.':C'.$rowNumber);  
	        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getFont()->setSize(10);
	        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('C'.$rowNumber.':C'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;
	        if ($proposed_type=='Loan') {
	        	$headings1 = array('Libality STATEMENT OF ACCOUNT FOR THE PERIOD OF '.date("d-M-y",strtotime($dt_from)).' To '.date("d-M-y",strtotime($dt_to)).'');
		        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objWorkSheet->mergeCells('A'.$rowNumber.':C'.$rowNumber); 
		        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getFont()->setSize(16);
		        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getAlignment()->setWrapText(true);
		        $objWorkSheet->getStyle('A'.$rowNumber)->getFont()->setBold(true);
	        }else
	        {
	        	$headings1 = array('Libality STATEMENT OF ACCOUNT FOR THE PERIOD OF '.date("d-M-y",strtotime($dt_from)).' To '.date("d-M-y",strtotime($dt_to)).'');
		        $objWorkSheet->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objWorkSheet->mergeCells('A'.$rowNumber.':C'.$rowNumber); 
		        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getFont()->setSize(16);
		        $objWorkSheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getAlignment()->setWrapText(true);
		        $objWorkSheet->getStyle('A'.$rowNumber)->getFont()->setBold(true);
	        }
	        $rowNumber++;
	        $rowNumber++;
	        $headings4 = array('SL','Description of the Facility','Amount in BDT');
	        $objWorkSheet->fromArray(array($headings4),NULL,'A'.$rowNumber);
	        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getFont()->setBold(true); 
	        $objWorkSheet->getStyle('A'.$rowNumber.':A'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('C'.$rowNumber.':C'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F28A8C')));
	        $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	      $objWorkSheet->fromArray(array(
	            1,
	            'Principal Amount',
	            number_format($principal_amount,2,'.',',')
	            ),NULL,'A'.$rowNumber);
	          $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getAlignment()->setWrapText(true);
	          $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleArray_border); 
	          $rowNumber++;
          $objWorkSheet->fromArray(array(
            2,
            'Interest Accrued',
            number_format($total_interest,2,'.',',')
            ),NULL,'A'.$rowNumber);
          $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getAlignment()->setWrapText(true);
          $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleArray_border); 
          $rowNumber++;
         $objWorkSheet->fromArray(array(
            3,
            'Amount paid by Borrower',
            number_format($amount_paid,2,'.',',')
            ),NULL,'A'.$rowNumber);
          $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getAlignment()->setWrapText(true);
          $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleArray_border); 
          $rowNumber++;
        $objWorkSheet->fromArray(array(
            4,
            'Penal Charge',
            number_format($pinal_charge,2,'.',',')
            ),NULL,'A'.$rowNumber);
          $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getAlignment()->setWrapText(true);
          $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleArray_border); 
          $rowNumber++;
         $objWorkSheet->fromArray(array(
            'Present Outstanding As On Statement Date',
            '',
            number_format(($principal_amount+$total_interest+$pinal_charge)-$amount_paid,2,'.',',')
            ),NULL,'A'.$rowNumber);
          $objWorkSheet->mergeCells('A'.$rowNumber.':B'.$rowNumber);  
          $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->getAlignment()->setWrapText(true);
          $objWorkSheet->getStyle('A'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleArray_border); 
          $rowNumber++;

		$objWorkSheet->setTitle('Libality Statement'); 
		$file_name_new="libality_statement_".$this->session->userdata['ast_user']['user_id'].'_'.time().'.xls';
	    require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        $objWriter->save(str_replace(__file__,'temp_upload_file/'.$file_name_new,__file__));
        $data = array('Session_Id'   => $this->session->userdata['ast_user']['user_id'],  
	                'module_name'   => 'statement',
	                'Orginal_file_name'   => '',
	                'data_field_name'   => 'libality_statement',
	                'New_file_name'   => $file_name_new
	     );    
	    $this->db->insert('temp_upload_file', $data); 
		$str.='</tbody></table></div>';
		//$new_str = date("d-M-y",strtotime($statement_start_date)).' To '.date("d-M-y",strtotime($statement_end_date));
		//str_replace("(########)",$new_str,$str);

		$libality_statement = $file_name_new;
		$var =array(
		"str"=>$str,
		"csrf_token"=>$csrf_token,
		"new_file_path"=>$new_file_path,
		"prev_libality_statement"=>$prev_libality_statement,
		"libality_statement"=>$libality_statement,
		"prev_file_path"=>$prev_file_path,
		"final_dt"=>$final_dt,
		"glob_sts"=>$glob_sts,
		"final_belance"=>$final_belance
		);
		echo json_encode($var);
	}
	function load_recovery()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$r_dt_from = $this->input->post('r_dt_from');
		$r_dt_to = $this->input->post('r_dt_to');
		$str = '';
		$data = $this->Hoops_model->get_recovery_data_by_batch($r_dt_from,$r_dt_to);
		$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<thead>
				<th width="5%" style="font-weight: bold;text-align:center">D</th>
				<th width="5%" style="font-weight: bold;text-align:center">P</th>
				<th width="40%" style="font-weight: bold;text-align:left">Batch No</th>
				<th width="25%" style="font-weight: bold;text-align:left">Recovery Upload Date</th>
				<th width="25%" style="font-weight: bold;text-align:left">Recovery Upload By</th>
			</thead>
			<tbody id="table_tbody">';
		if (!empty($data)) {
			//Select Recovery data
			foreach ($data as $key) 
			{
				$str.='<tr>
                  <td align="center"><img src="'.base_url().'images/delete-New.png" onclick="delete_action('.$key->batch_no.')" style="margin-top: 5px;cursor:pointer;"></td>
                  <td align="center"><img src="'.base_url().'images/view_detail.png" onclick="preview_recovery('.$key->batch_no.')" style="margin-top: 5px;cursor:pointer;"></td>
                  <td align="left">'.$key->batch_no.'</td>
                  <td align="left">'.$key->e_dt.'</td>
                  <td align="left">'.$key->e_by.'</td>
              </tr>';
			}
		}
		else
		{
			$str.='<tr style="vertical-align:top;" ><td colspan="5" align="center" style="color: #AA0000">Sorry No Data !!</td></tr>';
		}
		$str.='</tbody></table></div>';


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
			$id = $this->Hoops_model->delete_action();
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
			else{$row=$this->Hoops_model->get_add_action_data($id);}
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
	function bulk_operation()
	{
		$data = array( 	
		   'pages'=> 'hoops/pages/bulk_operation',		   
		   );
		$this->load->view('hoops/form_layout',$data);
	}
	function file_validation_old()
	{
	   $this->load->helper('form');
       $csrf_token=$this->security->get_csrf_hash();     
	   $str='';       
       $destination_path = getcwd().DIRECTORY_SEPARATOR;
       //Removing Previous File
       $path = $destination_path.'/cma_file/file_processing_exl_file/temp_excel_file_'.$this->session->userdata['ast_user']['user_id'].'.xlsx';
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
       $target_path = $destination_path.'/cma_file/file_processing_exl_file/' .$file_name_new;
        
	    if(@move_uploaded_file($_FILES['bulk_file']['tmp_name'], $target_path)) {
	      $result = 1;
	    } 
	    if ($result==1) 
	    {
	    	$total_error_rows=0;
	    	$count=0;
	    	$error_message_loan_ac='';
	    	$error_message_user='';
	    	$error_message_dt='';
	    	$error_message_amnt='';
	    	$account_number_array=array();
	    	$ac_type='';
	    	$type_error='';
	    	$error_message_req_type='';
	    	$req_type_array = array('1','2','3','4');
	    	$req_type = '';



			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="5%" style="font-weight: bold;text-align:center">SL</th>
					<th width="5%" style="font-weight: bold;text-align:left">Type</th>
					<th width="10%" style="font-weight: bold;text-align:left">Requisition Type</th>
					<th width="20%" style="font-weight: bold;text-align:left">Loan A/C</th>
					<th width="20%" style="font-weight: bold;text-align:left">User Pin</th>
					<th width="40%" style="font-weight: bold;text-align:left">Error</th>
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
						$ac_type='';
						for($j=1;$j<=count($sheetData[$i]);$j++)
						{	
						 if($i>1)//Skip the first row
						 {
						 	
						 	if ($k=='A') {
								$ac_type = $sheetData[$i][$k];
							}
							if($k=='B')
						 	{
						 		$req_type = $sheetData[$i][$k];
								if (in_array($sheetData[$i][$k], $req_type_array))
  								{
									$error_message_req_type='';
								}else
								{
									$error_message_req_type='Invalid Requisition Type';
								}
						 	}
							if ($k=='C')//Loan Account Error Checking 
							{
								if ($ac_type=='loan') 
								{
									$data=$this->Hoops_model->get_data_by_loan_ac($sheetData[$i][$k],'Loan',$req_type);
								}
								else if($ac_type=='card')
								{
									$data=$this->Hoops_model->get_data_by_loan_ac($sheetData[$i][$k],'Card',$req_type);
								}
								else
								{
									$data=array();
									$type_error='Invalid A/C Type';
								}
								
								if (empty($data)) {
									$error_message_loan_ac='Loan AC Not Found';
								}
								else
								{
									if(in_array($sheetData[$i][$k], $account_number_array))
									{
										$error_message_loan_ac='Duplicate Loan AC';
									}
									else if ($data->cma_sts<59) {
										$error_message_loan_ac='File yet to come in HOOPS';
										array_push($account_number_array,$sheetData[$i][$k]);
									}
									else if($data->cma_sts>59)
									{
										$error_message_loan_ac='File already delivered';
										array_push($account_number_array,$sheetData[$i][$k]);
									}
									else
									{
										array_push($account_number_array,$sheetData[$i][$k]);
										$error_message_loan_ac='';
									}
									if ($data->generated_statement=='') 
									{
										$error_message_loan_ac='Statement Not Generated Yet';
									}
								}
							}
							
							if ($error_message_loan_ac=='') 
							{
								if ($k=='D')//User Error Checking 
								{
									$data2=$this->Hoops_model->get_data_by_pin($sheetData[$i][$k],$data->legal_region);
									if (empty($data2)) {
										$error_message_user='User Not Matched';
									}
									else
									{
										$error_message_user='';
									}
								}
							}
							$str.='<td align="left">'.$sheetData[$i][$k].'<input type="hidden" name="'.$k.'_'.$count.'" id="'.$k.'_'.$count.'" value="'.$sheetData[$i][$k].'"></td>';
							
						 }
						 $k++;
						 if ($k=='E') {
						 		break;
						 	}	
						}

						if ($i>1) 
						{
							if ($type_error!='') {
								$str.='<td align="left"><strong><span style="color:red">'.$type_error.'</span></strong><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="0"><input type="hidden" id="event_id_'.$count.'" name="user_id_'.$count.'" value="0"></td>';
								$total_error_rows++;
							}
							else if ($error_message_loan_ac!='') {
								$str.='<td align="left"><strong><span style="color:red">'.$error_message_loan_ac.'</span></strong><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="0"><input type="hidden" id="event_id_'.$count.'" name="user_id_'.$count.'" value="0"></td>';
								$total_error_rows++;
							}
							else if($error_message_user!='')
							{
								$str.='<td align="left"><strong><span style="color:red">'.$error_message_user.'</span></strong><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="0"><input type="hidden" id="event_id_'.$count.'" name="user_id_'.$count.'" value="0"></td>';
								$total_error_rows++;
							}
							else if($error_message_dt!='')
							{
								$str.='<td align="left"><strong><span style="color:red">'.$error_message_dt.'</span></strong><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="0"><input type="hidden" id="event_id_'.$count.'" name="user_id_'.$count.'" value="0"></td>';
								$total_error_rows++;
							}
							else if($error_message_amnt!='')
							{
								$str.='<td align="left"><strong><span style="color:red">'.$error_message_amnt.'</span></strong><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="0"><input type="hidden" id="event_id_'.$count.'" name="user_id_'.$count.'" value="0"></td>';
								$total_error_rows++;
							}
							else
							{
								$str.='<td align="left"><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="'.$data->id.'"><input type="hidden" id="user_id_'.$count.'" name="user_id_'.$count.'" value="'.$data2->id.'"></td>';
							}
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
	function file_validation()
	{
	   $this->load->helper('form');
       $csrf_token=$this->security->get_csrf_hash();     
	   $str='';       
       $destination_path = getcwd().DIRECTORY_SEPARATOR;
       //Removing Previous File
       $path = $destination_path.'/cma_file/file_processing_exl_file/temp_excel_file_'.$this->session->userdata['ast_user']['user_id'].'.xlsx';
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
       $target_path = $destination_path.'/cma_file/file_processing_exl_file/' .$file_name_new;
        
	    if(@move_uploaded_file($_FILES['bulk_file']['tmp_name'], $target_path)) {
	      $result = 1;
	    } 
	    if ($result==1) 
	    {
	    	$total_error_rows=0;
	    	$count=0;
	    	$error_message_loan_ac='';
	    	$error_message_user='';
	    	$error_message_dt='';
	    	$error_message_amnt='';
	    	$error_message_req_type='';
	    	$account_number_array=array();
	    	$st_belance_dt='';
	    	$st_belance='';
	    	$req_type = '';
	    	$ac_type='';
	    	$type_error='';

			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="5%" style="font-weight: bold;text-align:center">SL</th>
					<th width="5%" style="font-weight: bold;text-align:left">Type</th>
					<th width="5%" style="font-weight: bold;text-align:left">Req Type</th>
					<th width="15%" style="font-weight: bold;text-align:left">Loan A/C</th>
					<th width="15%" style="font-weight: bold;text-align:left">User Pin</th>
					<th width="10%" style="font-weight: bold;text-align:left">Belance Date</th>
					<th width="10%" style="font-weight: bold;text-align:left">Belance</th>
					<th width="40%" style="font-weight: bold;text-align:left">Error</th>
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
						$ac_type='';
						for($j=1;$j<=count($sheetData[$i]);$j++)
						{	
						 if($i>1)//Skip the first row
						 {
							if ($k=='E') 
							{
								if (PHPExcel_Shared_Date::isDateTime($objPHPExcel->getActiveSheet()->getCell($k.$i))==true)
								{
									$d=PHPExcel_Style_NumberFormat::toFormattedString(trim($sheetData[$i][$k]),'YYYY-MM-DD' );
								}
								else if(strlen(trim($sheetData[$i][$k]))==10 && count(explode("/",trim($sheetData[$i][$k])))==3){	
								$dd=explode("/",trim($sheetData[$i][$k]));
								$d=$dd[2].'-'.$dd[1].'-'.$dd[0];
									
								}else{
									
									$d=trim($sheetData[$i][$k]);
								}
								$str.='<td align="left">'.$d.'<input type="hidden" name="'.$k.'_'.$count.'" id="'.$k.'_'.$count.'" value="'.$d.'"></td>';
								if (strlen($d)==10 && count(explode("-",$d))==3) {
									$error_message_dt='';
									$st_belance_dt=$d;
								}else{$error_message_dt='Invalid Date Format';}
								
							}
							else
							{
								if ($k=='A') {
									$ac_type = $sheetData[$i][$k];
								}
								if ($k=='B') {
									$req_type = $sheetData[$i][$k];
									$row = $this->db->query("SELECT c.*
									FROM ref_req_type as c 
									WHERE c.data_status=1 AND c.name='".$req_type."' ORDER BY c.id ASC LIMIT 1")->row();
									if (!empty($row))
	  								{
										$error_message_req_type='';
										$req_type = $row->id;
									}else
									{
										$error_message_req_type='Invalid Requisition Type';
									}
								}
								if ($k=='C')//Loan Account Error Checking 
								{
									if ($ac_type=='Loan') 
									{
										$data=$this->Hoops_model->get_data_by_loan_ac($sheetData[$i][$k],'Loan',$req_type);
									}
									else if($ac_type=='Card')
									{
										$data=$this->Hoops_model->get_data_by_loan_ac($sheetData[$i][$k],'Card',$req_type);
									}
									else
									{
										$data=array();
										$type_error='Invalid A/C Type';
									}
									
									if (empty($data)) {
										$error_message_loan_ac='Loan AC Not Found';
									}
									else
									{
										// if(in_array($sheetData[$i][$k], $account_number_array))
										// {
										// 	$error_message_loan_ac='Duplicate Loan AC';
										// }
										$duplicate_check=0;
										if(!empty($account_number_array))
										{
											for ($l=0; $l <count($account_number_array) ; $l++) { 
												$final_str = explode("####",$account_number_array[$l]);
												$loan_str = $final_str[0];//loan ac
												$req_type_str = $final_str[1];//req type
												$act_type_str = $final_str[2];//type
												if($loan_str==$sheetData[$i][$k] && $req_type_str==$req_type && $act_type_str==$ac_type)
												{
													$error_message_loan_ac='Duplicate Loan AC';
													$duplicate_check=1;
													break;
												}
											}
										}
										if($duplicate_check==0)
										{
											if ($data->cma_sts<59) {
												$error_message_loan_ac='File yet to come in HOOPS';
												array_push($account_number_array,$sheetData[$i][$k]);
											}
											else if($data->cma_sts>60)
											{
												$error_message_loan_ac='File already delivered';
												array_push($account_number_array,$sheetData[$i][$k]);
											}
											else
											{
												//$account_number_array[$req_type_name] = $sheetData[$i][$k];
												array_push($account_number_array,$sheetData[$i][$k].'####'.$req_type.'####'.$ac_type);
												$error_message_loan_ac='';
											}
										}
									}
								}
								if ($k=='F') {
									if (is_numeric($sheetData[$i][$k])) {
										$error_message_amnt='';
										$st_belance=$sheetData[$i][$k];
									}else{$error_message_amnt='Invalid Amount';}
								}
								if ($error_message_loan_ac=='') 
								{
									if ($k=='D')//User Error Checking 
									{
										$data2=$this->Hoops_model->get_data_by_pin($sheetData[$i][$k],$data->legal_region);
										if (empty($data2)) {
											$error_message_user='User Not Matched';
										}
										else
										{
											$error_message_user='';
										}
									}
								}
								if($k=='G')
								{
									break;
								}
								$str.='<td align="left">'.$sheetData[$i][$k].'<input type="hidden" name="'.$k.'_'.$count.'" id="'.$k.'_'.$count.'" value="'.$sheetData[$i][$k].'"></td>';

							}

						 }
						 $k++;	
						}

						if ($i>1) 
						{
							if ($type_error!='') {
								$str.='<td align="left"><strong><span style="color:red">'.$type_error.'</span></strong><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="0"><input type="hidden" id="event_id_'.$count.'" name="user_id_'.$count.'" value="0"></td>';
								$total_error_rows++;
							}
							else if($error_message_req_type!='')
							{
								$str.='<td align="left"><strong><span style="color:red">'.$error_message_req_type.'</span></strong><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="0"><input type="hidden" id="event_id_'.$count.'" name="user_id_'.$count.'" value="0"></td>';
								$total_error_rows++;
							}
							else if ($error_message_loan_ac!='') {
								$str.='<td align="left"><strong><span style="color:red">'.$error_message_loan_ac.'</span></strong><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="0"><input type="hidden" id="event_id_'.$count.'" name="user_id_'.$count.'" value="0"></td>';
								$total_error_rows++;
							}
							else if($error_message_user!='')
							{
								$str.='<td align="left"><strong><span style="color:red">'.$error_message_user.'</span></strong><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="0"><input type="hidden" id="event_id_'.$count.'" name="user_id_'.$count.'" value="0"></td>';
								$total_error_rows++;
							}
							else if($error_message_dt!='')
							{
								$str.='<td align="left"><strong><span style="color:red">'.$error_message_dt.'</span></strong><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="0"><input type="hidden" id="event_id_'.$count.'" name="user_id_'.$count.'" value="0"></td>';
								$total_error_rows++;
							}
							else if($error_message_amnt!='')
							{
								$str.='<td align="left"><strong><span style="color:red">'.$error_message_amnt.'</span></strong><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="0"><input type="hidden" id="event_id_'.$count.'" name="user_id_'.$count.'" value="0"></td>';
								$total_error_rows++;
							}
							else
							{
								$str.='<td align="left"><input type="hidden" id="event_id_'.$count.'" name="event_id_'.$count.'" value="'.$data->id.'"><input type="hidden" id="user_id_'.$count.'" name="user_id_'.$count.'" value="'.$data2->id.'"><input type="hidden" id="st_belance_'.$count.'" name="st_belance_'.$count.'" value="'.$st_belance.'"><input type="hidden" id="st_belance_dt_'.$count.'" name="st_belance_dt_'.$count.'" value="'.$st_belance_dt.'"></td>';
							}
							//End Row
							$str.='</tr>';
						}
						
					}
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
	function recovery_upload()
	{
	   $this->load->helper('form');
       $csrf_token=$this->security->get_csrf_hash();     
	   $str='';       
       $destination_path = getcwd().DIRECTORY_SEPARATOR;
       //Removing Previous File
       $path = $destination_path.'/cma_file/recovery_file/temp_recovery_file_'.$this->session->userdata['ast_user']['user_id'].'.xlsx';
       if (file_exists($path)) {
       	unlink($path);
       }
       $result = 0;
       $size1=basename($_FILES['recovery_file']['size']);
       $size=$size1/1048576;
       $filename = stripslashes($_FILES['recovery_file']['name']);
       $i = strrpos($filename,".");
       $l = strlen($filename) - $i;
       $extension = substr($filename,$i+1,$l);             
       $extension = strtolower($extension);                   
       $file_name_new='temp_recovery_file_'.$this->session->userdata['ast_user']['user_id'].'.'.$extension;
       //$New_file_name=$this->input->ip_address().'__'.$subcat.'__'.$this->session->userdata("user_hms").'__'.time().'.pdf';
       $target_path = $destination_path.'/cma_file/recovery_file/' .$file_name_new;
        
	    if(@move_uploaded_file($_FILES['recovery_file']['tmp_name'], $target_path)) {
	      $result = 1;
	    } 
	    if ($result==1) 
	    {
	    	$count=0;
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="5%" style="font-weight: bold;text-align:center">SL</th>
					<th width="5%" style="font-weight: bold;text-align:left">Type</th>
					<th width="30%" style="font-weight: bold;text-align:left">Loan A/C</th>
					<th width="30%" style="font-weight: bold;text-align:left">Amount</th>
					<th width="30%" style="font-weight: bold;text-align:left">Tran.  Date</th>
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
						$ac_type='';
						for($j=1;$j<=count($sheetData[$i]);$j++)
						{	
						 if($i>1)//Skip the first row
						 {
							if ($k=='D') 
							{
								if (PHPExcel_Shared_Date::isDateTime($objPHPExcel->getActiveSheet()->getCell($k.$i))==true)
								{
									$d=PHPExcel_Style_NumberFormat::toFormattedString(trim($sheetData[$i][$k]),'YYYY-MM-DD' );
								}
								else if(strlen(trim($sheetData[$i][$k]))==10 && count(explode("/",trim($sheetData[$i][$k])))==3){	
								$dd=explode("/",trim($sheetData[$i][$k]));
								$d=$dd[2].'-'.$dd[1].'-'.$dd[0];
									
								}else{
									
									$d=trim($sheetData[$i][$k]);
								}
								$str.='<td align="left">'.$d.'<input type="hidden" name="'.$k.'_'.$count.'" id="'.$k.'_'.$count.'" value="'.$d.'"></td>';
								if (strlen($d)==10 && count(explode("-",$d))==3) {
									$error_message_dt='';
								}else{$error_message_dt='Invalid Date Format';}
								break;
							}
							else
							{
								if ($k=='A') {
									$ac_type = $sheetData[$i][$k];
								}
								if ($k=='B')//Loan Account Error Checking 
								{
									if ($ac_type=='loan' || $ac_type=='card') 
									{
										$type_error='';
									}
									else
									{
										$type_error='Invalid A/C Type';
									}
								}
								if ($k=='C') {
									if (is_numeric($sheetData[$i][$k])) {
										$error_message_amnt='';
									}else{$error_message_amnt='Invalid Amount';}
								}
								$str.='<td align="left">'.$sheetData[$i][$k].'<input type="hidden" name="'.$k.'_'.$count.'" id="'.$k.'_'.$count.'" value="'.$sheetData[$i][$k].'"></td>';
							}
						 }
						 $k++;	
						 if ($k=='E') {
						 	break;
						 }
						}

						if ($i>1) 
						{
							//End Row
							$str.='</tr>';
						}
						
					}
					break;
				}	
			}
			$str.='<input type="hidden" name="total_row" id="total_row" value="'.$count.'">';
			$str.='<input type="hidden" name="selected_row" id="selected_row" value="'.$count.'">';
			$str.='</tbody></table></div>';
			$Message='OK';
	    }
	    else
	    {
	    	$Message='NotOk';
	    	$str.='<input type="hidden" name="total_row" id="total_row" value="0">';
	    }
		$var =array(
		"str"=>$str,
		"Message"=>$Message,
		"csrf_token"=>$csrf_token
		);
		echo json_encode($var);
	}
	function templete_file_download()
	{
		$filepath=base_url().'cma_file/file_processing_exl_file/templete/Templete.xlsx';
    	//$file_name='Templete.xlsx';
    	header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($filepath) . "\""); 
		readfile($filepath);
	}
	function recovery_details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$sah=$this->Hoops_model->get_recovery_details_by_batch($this->input->post('batch'));
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
	function details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str='';
		if (isset($_POST['operation'])) {
			$operation = $this->input->post('operation');
		}else{$operation ="";}
			if ($this->input->post('id') != ""){
				$details=$this->Cma_process_model->get_recommend_info($this->input->post('id'));
	    		$guarantor_info= $this->Cma_process_model->get_guarantor_info('edit',$this->input->post('id'));    	
	    	}
	    	else{$details=array();}
	    	if (!empty($details)) 
	    	{
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
	    			$call_up_file='<img id="file_preview" onclick="popup(\''.base_url().'legal_notice_file/call_up_file/'.$details->call_up_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$call_up_file="";}

	    		if ($details->remarks_file!='') {
	    			$remarks_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/remarks_file/'.$details->remarks_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$remarks_file="";}

	    		if ($details->ln_scan_copy!='') {
	    			$ln_scan_copy='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/ln_scan_copy/'.$details->ln_scan_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$ln_scan_copy="";}

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
							<td width="50%" align="left"><strong>Borrower Name:</strong>'.$details->brrower_name.'</td>
							
							<td width="50%" align="left"><strong>Initiate Date Time:</strong>'.$details->e_dt.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Loan Segment (Portfolio) :</strong>'.$details->loan_segment.'</td>
							<td width="50%" align="left"><strong>Call Up File:</strong>'.$call_up_file.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Chq Expiry Date:</strong>'.$details->chq_expiry_date.'</td>
							<td width="50%" align="left"><strong>Last Payment Date:</strong>'.$details->last_payment_date.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Current DPD:</strong>'.$details->current_dpd.'DPD</td>
							<td width="50%" align="left"><strong>Legal Region:</strong>'.$details->legal_region_name.'</td>
						</tr>';

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
						</tr>';
				if ($details->uploaded_statement!='' || $details->generated_statement!='') 
				{
					$str.='<tr>
								<td width="50%" align="left"><strong>Statement File:</strong>'.$statement_file.'</td>
								<td width="50%" align="left"><strong>LN Sent Date (Legal):</strong>'.$details->ln_sent_date.'</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Valid Date (Legal):</strong>'.$details->ln_val_dt.'</td>
								<td width="50%" align="left"><strong>Selected Lawyer (Legal):</strong>'.$details->lawyer_legal.'</td>
							</tr>';
				}

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
	    	$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	}

	
}
?>
