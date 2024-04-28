<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cma_rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Cma_rt_model', '', TRUE);
    $this->load->model('User_model', '', TRUE);
    $this->load->model('Common_model', '', TRUE);
	}

	function view($menu_group, $menu_cat){

		$report_list = array(
      'cma_rt/daily_report' => 'Daily Report',
		);
		$report_select = 'cma_rt/daily_report';
		$result = array();
		$post_sts = 0;
		$ToDate=isset($_POST['ToDate'])?$_POST['ToDate']:'';
		$FromDate=isset($_POST['FromDate'])?$_POST['FromDate']:'';
        $appFromDate=isset($_POST['appFromDate'])?$_POST['appFromDate']:'';
        $appToDate=isset($_POST['appToDate'])?$_POST['appToDate']:'';
        $region_id=isset($_POST['region_id'])?$_POST['region_id']:0;
        $status_id=isset($_POST['status_id'])?$_POST['status_id']:0;
        $territory=isset($_POST['territory'])?$_POST['territory']:0;
        $district=isset($_POST['district'])?$_POST['district']:0;
        $unit_office=isset($_POST['unit_office'])?$_POST['unit_office']:0;
        $proposed_type=isset($_POST['proposed_type'])?$_POST['proposed_type']:0;
        $col_xl=isset($_POST['col_xl'])?$_POST['col_xl']:0;
        $limit=isset($_POST['limit'])?$_POST['limit']:100;
		$data = array(
                'menu_group' => $menu_group,
                'menu_cat' => $menu_cat,
                'report_select' => $report_select,
                'report_list' => $report_list,
                'result' => $result,
                'post_sts' => $post_sts,
                'FromDate' => $FromDate,
                'ToDate' => $ToDate,
                'appToDate' => $appToDate,
                'appFromDate' => $appFromDate,
                'region_id' => $region_id,
                'territory_id' => $territory,
                'district_id' => $district,
                'unit_office_id' => $unit_office,
                'status_id' => $status_id,
                'proposed_type' => $proposed_type,
                'col_xl' => $col_xl,
                'limit' => $limit,
                'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND (module_name="f_legal_notice" OR module_name="cma")'),
                'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
                'pages' => 'cma_rt/pages/grid',
                'option' => 'daily_report'
            );
            $this->load->view('grid_layout',$data);

	}	

	function daily_report($menu_group, $menu_cat){


		$report_list = array(
                'cma_rt/daily_report' => 'Daily Report',
            );
		$report_select = 'cma_rt/daily_report';
		$result = array();
    if(isset($_POST['xlsts'])){

      $this->mk_xl_daily_report();
    }else{
		$post_sts = isset($_POST['post_sts']) ? 1 : 0;
		$ToDate=isset($_POST['ToDate'])?$_POST['ToDate']:'';
		$FromDate=isset($_POST['FromDate'])?$_POST['FromDate']:'';
		if ($post_sts == 1) {
			$result = $this->Cma_rt_model->get_daily_report_data();
		}
        $appFromDate=isset($_POST['appFromDate'])?$_POST['appFromDate']:'';
    $appToDate=isset($_POST['appToDate'])?$_POST['appToDate']:'';
        $region_id=isset($_POST['region_id'])?$_POST['region_id']:0;
        $status_id=isset($_POST['status_id'])?$_POST['status_id']:0;
        $territory=isset($_POST['territory'])?$_POST['territory']:0;
        $district=isset($_POST['district'])?$_POST['district']:0;
        $unit_office=isset($_POST['unit_office'])?$_POST['unit_office']:0;
        $proposed_type=isset($_POST['proposed_type'])?$_POST['proposed_type']:'';
        $limit=isset($_POST['limit'])?$_POST['limit']:100;
        $col_xl=isset($_POST['col_xl'])?$_POST['col_xl']:0;
		  $data = array(
                'menu_group' => $menu_group,
                'menu_cat' => $menu_cat,
                'report_select' => $report_select,
                'report_list' => $report_list,
                'result' => $result,
                'post_sts' => $post_sts,
                'ToDate' => $ToDate,
                'FromDate' => $FromDate,
                'appToDate' => $appToDate,
                'appFromDate' => $appFromDate,
                'region_id' => $region_id,
                'territory_id' => $territory,
                'district_id' => $district,
                'unit_office_id' => $unit_office,
                'status_id' => $status_id,
                'proposed_type' => $proposed_type,
                'limit' => $limit,
                'col_xl' => $col_xl,
                'status' => $this->user_model->get_parameter_data('ref_status','id','data_status = 1 AND (module_name="f_legal_notice" OR module_name="cma")'),
                'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
                'pages' => 'cma_rt/pages/grid',
                'option' => 'daily_report'
            );
            $this->load->view('grid_layout',$data);
    }

	}
    
	function mk_xl_daily_report()
    {

      $where='';
      $ToDate = trim($this->input->post('ToDate')); 
      $FromDate = trim($this->input->post('FromDate')); 
      $appFromDate = trim($this->input->post('appFromDate')); 
      $appToDate = trim($this->input->post('appToDate')); 
      
      $result = $this->Cma_rt_model->get_xl_daily_report_data();
      $arr =$this->input->post('col_xl');
      //print_r($result);
      $sn = 1;
       // echo "<pre>";
       // print_r($result);
       // echo "</pre>";
       // die();



          include_once('tbs/clas/tbs_class.php');
          include_once('tbs/clas/tbs_plugin_opentbs.php');

         $TBS = new clsTinyButStrong; 
         $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 

      foreach ($result as $key => $val) {
            if($val['proposed_type']=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
          {
            $loan_ac = $this->Common_model->stringEncryption('decrypt',$val['org_loan_ac']);
          }
          else
          {
            $loan_ac = $val['loan_ac'];
          }
              $serial_number = $key + 1;
                    $data[] = array(
                        'sl_no' => $val['sl_no'],
                        'req_type' => $val['req_type'],
                        'proposed_type' => $val['proposed_type'],
                        'loan_ac' => $loan_ac,
                        'cif' => $val['cif'],
                        'branch_sol' => $val['branch_sol'],
                        'ac_name' => $val['ac_name'],
                        'subject_name' => $val['subject_name'],
                        'spouse_name' => $val['spouse_name'],
                        'mother_name' => $val['mother_name'],
                        'loan_segment' => $val['loan_segment'],
                        'current_address' => $val['current_address'],
                        'region_name' => $val['region_name'],
                        'territory_name' => $val['territory_name'],
                        'district_name' => $val['district_name'],
                        'unit_office_name' => $val['unit_office_name'],
                        'more_acc_number' => $val['more_acc_number'],
                        'remarks' => $val['remarks'],
                        'cma_sts' => $val['cma_sts'],

                        'e_by' => $val['e_by'],
                        'e_dt' => $val['e_dt'],

                        'stc_by' => $val['stc_by'],
                        'stc_dt' => $val['stc_dt'],

                        'rec_by' => $val['rec_by'],
                        'rec_dt' => $val['rec_dt'],

                   

                        'ack_by' => $val['ack_by'],
                        'ack_dt' => strtotime($val['ack_dt']),

                        'sth_by' => $val['sth_by'],
                        'sth_dt' => $val['sth_dt'],

                        'v_by' => $val['v_by'],
                        'v_dt' => $val['v_dt'],

                        'card_iss_date' => $val['card_iss_date'],
                        'card_exp_date' => $val['card_exp_date'],
                        'card_limit' => $val['card_limit'],
                        'outstanding_bl' => $val['outstanding_bl'],
                        'outstanding_bl_dt' => $val['outstanding_bl_dt'],
                        'last_payment_date' => $val['last_payment_date'],
                        'last_payment_amount' => $val['last_payment_amount'],
                        'pre_auc_sts' => $val['pre_auc_sts'],
                        'auction_sts' => $val['auction_sts'],
                        'current_dpd' => $val['current_dpd'],
                        'region_name' => $val['region_name'],
                        'loan_sanction_dt' => $val['loan_sanction_dt'],
                        'auction_complete_by' => $val['auction_complete_by'],
                        'auction_complete_dt' => $val['auction_complete_dt'],
                        'hold_reason' => $val['hold_reason'],
                        'pre_case_fill_dt' => $val['pre_case_fill_dt'],
                      );
     

               foreach($val['guarntor'] as $key2 => $val2){

                    $data2[] = array(
                          'serial_Number' => $val['sl_no'],
                          'type_name' => $val2['type_name'],
                          'guarantor_name' => $val2['guarantor_name'],
                          'father_name' => $val2['father_name'],

                          'present_address' => $val2['present_address'],
                          'permanent_address' => $val2['permanent_address'],
                          'business_address' => $val2['business_address'],
                          'guar_sts_name' => $val2['guar_sts_name'],
                          'occ_sts_name' => $val2['occ_sts_name'],
                         );
           

               }



              if($val['proposed_type']=='Loan'){

                  foreach($val['facility_loan'] as $key3 => $val3){
                        $data3[] = array(

                              'serial_Number_key'   => $val['sl_no'],
                              'facility_type'       => $val3['facility_type'],
                              'ac_number'           => $val3['ac_number'],
                              'ac_name'             => $val3['ac_name'],
                              'sch_desc'            => $val3['sch_desc'],
                              'disbursement_date'   => $val3['disbursement_date'],
                              'expire_date'         => $val3['expire_date'],
                              'disbursed_amount'    => $val3['disbursed_amount'],
                              'loan_tenor'          => $val3['loan_tenor'],
                              'due_installments'    => $val3['due_installments'],
                              'payble'              => $val3['payble'],
                              'repayment'           => $val3['repayment'],
                              'outstanding_bl'      => $val3['outstanding_bl'],
                              'outstanding_bl_dt'   => $val3['outstanding_bl_dt'],
                              'overdue_bl'          => $val3['overdue_bl'],
                              'overdue_bl_dt'       => $val3['overdue_bl_dt'],
                              'call_up_dt'          => $val3['call_up_dt'],
                              'write_off_dt'        => $val3['write_off_dt'],
                              'write_off_amount'    => $val3['write_off_amount'],
                              'recovery_after_Wf'   => $val3['recovery_after_Wf'],
                              'cl_bb'               => $val3['cl_bb'],
                              'cl_bbl'              => $val3['cl_bbl'],
                          );

              }

        }

            if($val['proposed_type']=='Card'){
                  foreach($val['facility_loan'] as $val4){

                        $data4[] = array(

                            'serial_card'       => $val['sl_no'],
                            'card_type'         => $val4['card_type'],
                            'card_no'           => $val4['card_no'],
                            'card_name'         => $val4['card_name'],
                            'card_issue_dt'     => $val4['card_issue_dt'],
                            'card_limit'        => $val4['card_limit'],
                            'outstanding_bl'    => $val4['outstanding_bl'],
                            'outstanding_bl_dt' => $val4['outstanding_bl_dt'],
                            'cl_bb_card'        => $val['cl_bb_card'],
                            'cl_bbl_card'       => $val['cl_bbl_card'],
                        );
                   
                  }

                }

                            
  
      }


        $template = 'cma_report_template/cma_template.xlsx';
        $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); 

        $TBS->PlugIn(OPENTBS_SELECT_SHEET, "Daily Report");
        $TBS->MergeBlock('a', $data);

        $TBS->PlugIn(OPENTBS_SELECT_SHEET, "Guarantor");
        $TBS->MergeBlock('b', $data2);

        $TBS->PlugIn(OPENTBS_SELECT_SHEET, "Loan Facility Details");
        $TBS->MergeBlock('c', $data3);

        $TBS->PlugIn(OPENTBS_SELECT_SHEET, "Card Facility Details");
        $TBS->MergeBlock('d', $data4);


        $filename = 'CMA_Daily_Report.xlsx';
        $output_file_name = str_replace('.', '_' . date('Y-m-d') . '.', $filename); //rename sheet
        $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
        exit();
        die();
    }




    function sumonaddress($str=null){
    $txt ='';
    $arr =explode(",",$str);
    $counter = count($arr)-1;
    for($i=0;$i<count($arr);$i++){
      if($arr[$i]==1){$txt.='"Permanent Address"';}
        elseif($arr[$i]==2){$txt.='"Present Address"';}
        elseif($arr[$i]==3){$txt.='"Business Address"';}
        elseif($arr[$i]==4){$txt.='"Current/Updated Address"';}
        if($i!=$counter){$txt.=',';}
    }
    return $txt;
  }
}
?>