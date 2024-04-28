<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lawyer_wise_rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
    $this->load->model('User_model', '', TRUE);
    $this->load->model('Lawyer_wise_rt_model', '', TRUE);
	}

	function view($menu_group, $menu_cat){
		$data = array(
            'menu_group' => $menu_group,
            'menu_cat' => $menu_cat,
            'region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1'),
            'pages' => 'lawyer_wise_rt/pages/grid',
            'option' => 'daily_report'
        );
        $this->load->view('grid_layout',$data);

	}	


	function daily_report(){
      $csrf_token=$this->security->get_csrf_hash();
			$result = $this->Lawyer_wise_rt_model->get_summery_data();
      $str_html="";
      if(!empty($result))
      {
          $sl=0;
          foreach ($result as $key) 
          {
              $str_html.='<tr>
              <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer_name.'</td>
              <td style="text-align:center;word-wrap: break-word;">'.$key->total_assigned_file.'</td>
              <td style="text-align:center;word-wrap: break-word;">'.$key->case_filing_completed.'</td>
              <td style="text-align:center;word-wrap: break-word;">'.$key->case_filing_pending.'</td>
              <td style="text-align:center;word-wrap: break-word;">'.$key->disposed_suit.'</td>
              <td style="text-align:center;word-wrap: break-word;">'.$key->court_fee_disbursed.'</td>
              <td style="text-align:center;word-wrap: break-word;">'.$key->unused_court_fee.'</td>
              <td style="text-align:center;word-wrap: break-word;">'.$key->pending_prof_bill.'</td>
              <td style="text-align:center;word-wrap: break-word;">'.$key->disbursed_prof_bill.'</td>
              <td style="text-align:center;word-wrap: break-word;">'.$key->running_suit.'</td>
          </tr>';
          }
      }
      $var['csrf_token']=$csrf_token;
      $var['str_html']=$str_html;
      echo json_encode($var);

	}
  function make_unmasked_array($data_array)
  {
    if(count($data_array)<=0)
    {
      return array();
    }
    $final_data=array();
    foreach ($data_array as $key => $value) {
          $data=array();
          foreach($value as $keyIn => $value2) {
              if($keyIn=='loan_ac')
              {
                  if($value->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
                {
                  $loan_ac = $this->Common_model->stringEncryption('decrypt',$value->org_loan_ac);
                }
                else
                {
                  $loan_ac = $value->loan_ac;
                }
                  $data['loan_ac'] = $loan_ac;
              }
              else
              {
                  $data[$keyIn] = $value2;
              }
              
          }
          $final_data[] = $data;
      }
      return $final_data;
  }
  function daily_report_xl(){
      ///Account wise dump data
      if(isset($_POST['ac_wise_dump']))
      {
        
  
        //when single lawyer selected
        if($_POST['lawyer_name']!='')
        {
          $disbursed_court_fee_result = $this->make_unmasked_array($this->Lawyer_wise_rt_model->get_disbursed_court_fee());
          $unused_court_fee_result = $this->make_unmasked_array($this->Lawyer_wise_rt_model->get_unused_court_fee());
          $cma_data = $this->make_unmasked_array($this->Lawyer_wise_rt_model->get_cma_data());
          $suit_data = $this->make_unmasked_array($this->Lawyer_wise_rt_model->get_suit_data());
          $pending_lawyer_bill = $this->make_unmasked_array($this->Lawyer_wise_rt_model->get_pending_lawyer_bill());
          $disbursed_lawyer_bill = $this->make_unmasked_array($this->Lawyer_wise_rt_model->get_disbursed_lawyer_bill());
          include_once('tbs/clas/tbs_class.php');
          include_once('tbs/clas/tbs_plugin_opentbs.php');
          $result = $this->Lawyer_wise_rt_model->get_summery_data();
          $TBS = new clsTinyButStrong;
          $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

          $template = 'tbs/lwcl/details_data.xlsx';
          $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
          $TBS->PlugIn(OPENTBS_SELECT_SHEET,"Court Fee Data Disburesd");
          $TBS->MergeBlock('cf_details', $disbursed_court_fee_result);
          $TBS->PlugIn(OPENTBS_SELECT_SHEET,"Court Fee Data Unused");
          $TBS->MergeBlock('cfu_details', $unused_court_fee_result);
          $TBS->PlugIn(OPENTBS_SELECT_SHEET,"CMA Data");
          $TBS->MergeBlock('cma_details', $cma_data);
          $TBS->PlugIn(OPENTBS_SELECT_SHEET,"Suit Data");
          $TBS->MergeBlock('suit_details', $suit_data);
          $TBS->PlugIn(OPENTBS_SELECT_SHEET,"Pending Bill");
          $TBS->MergeBlock('pending_bill', $pending_lawyer_bill);
          $TBS->PlugIn(OPENTBS_SELECT_SHEET,"Disbursed Bill");
          $TBS->MergeBlock('disbursed_bill', $disbursed_lawyer_bill);

          $filename = 'lawyer_wise_case_list.xlsx';
          $TBS->Show(OPENTBS_DOWNLOAD, $filename);
          exit();
        }
        else //when all lawyer selected and sheet selected
        {
          $sheet_name = $_POST['report_sheet'];
          if($sheet_name=='1')//Court Fee Data Disburesd
          {
            $disbursed_court_fee_result = $this->make_unmasked_array($this->Lawyer_wise_rt_model->get_disbursed_court_fee());
            $this->make_shhet_wise_data($sheet_name,$disbursed_court_fee_result);
          }
          else if($sheet_name=='2')//Court Fee Data Unused
          {
            $unused_court_fee_result = $this->make_unmasked_array($this->Lawyer_wise_rt_model->get_unused_court_fee());
            $this->make_shhet_wise_data($sheet_name,$unused_court_fee_result);
          }
          else if($sheet_name=='3')//CMA Data
          {
            $cma_data = $this->make_unmasked_array($this->Lawyer_wise_rt_model->get_cma_data());
            $this->make_shhet_wise_data($sheet_name,$cma_data);
          }
          else if($sheet_name=='4')//Suit Data
          {
            $suit_data = $this->make_unmasked_array($this->Lawyer_wise_rt_model->get_suit_data());
            $this->make_shhet_wise_data($sheet_name,$suit_data);
          }
          else if($sheet_name=='5')//Pending Bill
          {
            $pending_lawyer_bill = $this->make_unmasked_array($this->Lawyer_wise_rt_model->get_pending_lawyer_bill());
            $this->make_shhet_wise_data($sheet_name,$pending_lawyer_bill);
          }
          else if($sheet_name=='6')//Disbursed Bill
          {
            $disbursed_lawyer_bill = $this->make_unmasked_array($this->Lawyer_wise_rt_model->get_disbursed_lawyer_bill());
            $this->make_shhet_wise_data($sheet_name,$disbursed_lawyer_bill);
          }
          
        }

      }
      // Summery Data
      if(isset($_POST['xl_search']))
      {

        include_once('tbs/clas/tbs_class.php');
        include_once('tbs/clas/tbs_plugin_opentbs.php');
        $result = $this->Lawyer_wise_rt_model->get_summery_data();
        $TBS = new clsTinyButStrong;
        $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
        if($_POST['year']!='')
        {
          $year_search = $_POST['year'];
        }
        else
        {
          $year_search = 'ALL';
        }
        if($_POST['legal_region']!='')
        {
          $region_name_search = $this->db->query("SELECT GROUP_CONCAT(r.name) as name
            FROM ref_legal_region r
            WHERE id IN(".$_POST['legal_region'].") LIMIT 1")->row()->name;
        }
        else
        {
          $region_name_search = 'ALL';
        }
        if($_POST['district']!='')
        {
          $district_name_search = $this->db->query("SELECT GROUP_CONCAT(r.name) as name
            FROM ref_legal_district r
            WHERE id IN(".$_POST['district'].") LIMIT 1")->row()->name;
        }
        else
        {
          $district_name_search = 'ALL';
        }
        if($_POST['lawyer_name']!='')
        {
          $lawyer_name_search = $this->db->query("SELECT GROUP_CONCAT(r.name) as name
            FROM ref_lawyer r
            WHERE id IN(".$_POST['lawyer_name'].") LIMIT 1")->row()->name;
        }
        else
        {
          $lawyer_name_search = 'ALL';
        }
        $data = array(
            array(
              'year_search'=>$year_search,
              'region_name_search'=>$region_name_search,
              'district_name_search'=>$district_name_search,
              'lawyer_name_search'=>$lawyer_name_search,
            )
        );
        $template = 'tbs/lwcl/lawyer_wise_case_list.xlsx';
        $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);

        $TBS->MergeBlock('a', $result);
        $TBS->MergeBlock('b', $data);

        $filename = 'lawyer_wise_case_list.xlsx';
        $TBS->Show(OPENTBS_DOWNLOAD, $filename);
        exit();

      }
      echo "Invalid submission!!!!";
      exit;
  }
  function make_shhet_wise_data($sheet_name,$result_data)
  {
    require_once('./application/Classes/PhpXlsxGenerator.php'); 
    $fileName = "lawyer-data_" . date('Y-m-d') . ".xlsx"; 
    if($sheet_name=='1')//Court Fee Data Disburesd
    {
      // Define column names 
      $excelData[] = array(
        'Account Number',
        'Account Name',
        'Lawyer/Vendor Oracal Ref. Number',
        'Lawyer/Vendor Name',
        'Court Fees Amount',
        'Bill Month',
        'Bill Year',
        'Bill Payment Date',
        'Territory',
        'District',
        'Region',
        'Portfolio',
        'Send To Finance Date'
      );
      for($i=0;$i<count($result_data);$i++)
      {
        $lineData = array(
          $result_data[$i]['loan_ac'],
          $result_data[$i]['ac_name'],
          $result_data[$i]['vendor_code'],
          $result_data[$i]['vendor_name'],                   
          $result_data[$i]['amount'],                   
          $result_data[$i]['bill_month'],                   
          $result_data[$i]['bill_year'],                   
          $result_data[$i]['bill_payment_date'],                   
          $result_data[$i]['territory_name'],                   
          $result_data[$i]['district_name'],                   
          $result_data[$i]['legal_region_name'],                   
          $result_data[$i]['segment_name'],                   
          $result_data[$i]['stf_dt']
        );  
        $excelData[] = $lineData; 
      }

      $xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
      $xlsx->downloadAs($fileName); 
       
      exit;  

    }
    else if($sheet_name=='2')//Court Fee Data Unused
    {
      // Define column names 
      $excelData[] = array(
        'Account Number',
        'Account Name',
        'Lawyer/Vendor Oracal Ref. Number',
        'Lawyer/Vendor Name',
        'Court Fees Amount',
        'Bill Month',
        'Bill Year',
        'Bill Payment Date',
        'Territory',
        'District',
        'Region',
        'Portfolio',
        'Send To Finance Date'
      );
      for($i=0;$i<count($result_data);$i++)
      {
        $lineData = array(
          $result_data[$i]['loan_ac'],
          $result_data[$i]['ac_name'],
          $result_data[$i]['vendor_code'],
          $result_data[$i]['vendor_name'],                   
          $result_data[$i]['amount'],                   
          $result_data[$i]['bill_month'],                   
          $result_data[$i]['bill_year'],                   
          $result_data[$i]['bill_payment_date'],                   
          $result_data[$i]['territory_name'],                   
          $result_data[$i]['district_name'],                   
          $result_data[$i]['legal_region_name'],                   
          $result_data[$i]['segment_name'],                   
          $result_data[$i]['stf_dt']
        );  
        $excelData[] = $lineData; 
      }

      $xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
      $xlsx->downloadAs($fileName); 
       
      exit;  

    }
    else if($sheet_name=='3')//CMA Data
    {
      // Define column names 
      $excelData[] = array(
        'Account Number',
        'Account Name',
        'Type of Case',
        'Initiate Date',
        'Recommend  Date',
        'Approved Date',
        'Approved Month',
        'Approved Year',
        'Territory',
        'District',
        'Region',
        'Portfolio',
        'Case Filling Status'
      );
      for($i=0;$i<count($result_data);$i++)
      {
        $lineData = array(
          $result_data[$i]['loan_ac'],
          $result_data[$i]['ac_name'],
          $result_data[$i]['type_of_case'],
          $result_data[$i]['initiate_date'],                   
          $result_data[$i]['recommend_date'],                   
          $result_data[$i]['approve_date'],                   
          $result_data[$i]['approve_month'],                   
          $result_data[$i]['approve_year'],                   
          $result_data[$i]['territory_name'],                   
          $result_data[$i]['district_name'],                   
          $result_data[$i]['legal_region_name'],               
          $result_data[$i]['segment_name'],                   
          $result_data[$i]['case_file_sts']
        );  
        $excelData[] = $lineData; 
      }

      $xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
      $xlsx->downloadAs($fileName); 
       
      exit;  

    }
    else if($sheet_name=='4')//Suit Data
    {
      // Define column names 
      $excelData[] = array(
        'Account Number',
        'Account Name',
        'Type of Case',
        'Filling Date',
        'Case Number',
        'Case Claim Amount',
        'Previous Date',
        'Case Status On The Previous Date',
        'Next Date',
        'Filling Plaintiff',
        'Case Dealings officer',
        'Lawyer\'s Name',
        'Region',
        'District',
        'Final Status (Running/ Settled)',
        'Migration Status'
      );
      for($i=0;$i<count($result_data);$i++)
      {
        $lineData = array(
          $result_data[$i]['loan_ac'],
          $result_data[$i]['ac_name'],
          $result_data[$i]['case_type'],
          $result_data[$i]['filling_date'],                   
          $result_data[$i]['case_number'],                   
          $result_data[$i]['case_claim_amount'],                   
          $result_data[$i]['prev_date'],                   
          $result_data[$i]['case_sts_prev_date'],                   
          $result_data[$i]['next_date'],                   
          $result_data[$i]['filling_plaintiff'],                   
          $result_data[$i]['case_deal_officer'],                   
          $result_data[$i]['lawyer_name'],                   
          $result_data[$i]['region'],
          $result_data[$i]['district'],
          $result_data[$i]['final_remarks'],
          $result_data[$i]['migration_sts']
        );  
        $excelData[] = $lineData; 
      }

      $xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
      $xlsx->downloadAs($fileName); 
       
      exit;  

    }
    else if($sheet_name=='5')//Pending Bill
    {
      // Define column names 
      $excelData[] = array(
        'Account Number',
        'Account Name',
        'Lawyer/Vendor Oracal Ref. Number',
        'Lawyer/Vendor Name',
        'Type of Case',
        'Case Number',
        'Activities Name',
        'Activities date',
        'Bill Amount',
        'Bill Month',
        'Bill Payment Date',
        'Court Type (High/Lower Court)',
        'Territory',
        'District',
        'Region',
        'Portfolio',
        'Send To Finance Date',
      );
      for($i=0;$i<count($result_data);$i++)
      {
        $lineData = array(
          $result_data[$i]['loan_ac'],
          $result_data[$i]['ac_name'],
          $result_data[$i]['vendor_code'],
          $result_data[$i]['vendor_name'],                   
          $result_data[$i]['type_of_case'],                   
          $result_data[$i]['case_number'],                   
          $result_data[$i]['act_name'],                   
          $result_data[$i]['txrn_dt'],                   
          $result_data[$i]['amount'],                   
          $result_data[$i]['bill_month'],                   
          $result_data[$i]['bill_payment_date'],                   
          $result_data[$i]['court_type'],                   
          $result_data[$i]['territory_name'],
          $result_data[$i]['district_name'],
          $result_data[$i]['legal_region_name'],
          $result_data[$i]['segment_name'],
          $result_data[$i]['stf_dt']
        );  
        $excelData[] = $lineData; 
      }

      $xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
      $xlsx->downloadAs($fileName); 
       
      exit;  

    }
    else if($sheet_name=='6')//Disbursed Bill
    {
      // Define column names 
      $excelData[] = array(
        'Account Number',
        'Account Name',
        'Lawyer/Vendor Oracal Ref. Number',
        'Lawyer/Vendor Name',
        'Type of Case',
        'Case Number',
        'Activities Name',
        'Activities date',
        'Bill Amount',
        'Bill Month',
        'Bill Payment Date',
        'Court Type (High/Lower Court)',
        'Territory',
        'District',
        'Region',
        'Portfolio',
        'Send To Finance Date',
      );
      for($i=0;$i<count($result_data);$i++)
      {
        $lineData = array(
          $result_data[$i]['loan_ac'],
          $result_data[$i]['ac_name'],
          $result_data[$i]['vendor_code'],
          $result_data[$i]['vendor_name'],                   
          $result_data[$i]['type_of_case'],                   
          $result_data[$i]['case_number'],                   
          $result_data[$i]['act_name'],                   
          $result_data[$i]['txrn_dt'],                   
          $result_data[$i]['amount'],                   
          $result_data[$i]['bill_month'],                   
          $result_data[$i]['bill_payment_date'],                   
          $result_data[$i]['court_type'],                   
          $result_data[$i]['territory_name'],
          $result_data[$i]['district_name'],
          $result_data[$i]['legal_region_name'],
          $result_data[$i]['segment_name'],
          $result_data[$i]['stf_dt']
        );  
        $excelData[] = $lineData; 
      }

      $xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
      $xlsx->downloadAs($fileName); 
       
      exit;  

    }

  }
	
}
?>