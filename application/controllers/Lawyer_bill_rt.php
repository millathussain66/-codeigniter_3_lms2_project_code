<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lawyer_bill_rt extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('lawyer_bill_rt_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('User_model', '', TRUE);
	}

	// View
	function view ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		if ($operation==NULL) {
			$operation = 'lawyer_bill_rt';
		}
		$data = array(
		
		    'lawyer_name'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
		    'region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1'),
		    'district'=>$this->User_model->get_parameter_data('ref_district','name','data_status = 1'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'lawyer_bill_rt/pages/grid',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function lawyer_bill_summery ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		$operation = 'lawyer_bill_summery';
		$data = array(
		    'lawyer_name'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
		    'region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1'),
		    'district'=>$this->User_model->get_parameter_data('ref_district','name','data_status = 1'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'lawyer_bill_rt/pages/lawyer_bill_summery',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function ac_wise_publication_bill ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		$operation = 'ac_wise_publication_bill';
		$data = array(
		    'lawyer_name'=>$this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
		    'region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1'),
		    'district'=>$this->User_model->get_parameter_data('ref_district','name','data_status = 1'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'lawyer_bill_rt/pages/ac_wise_publication_bill',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}
	function paper_publication_summery ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		$operation = 'paper_publication_summery';
		$data = array(
		    'lawyer_name'=>$this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
		    'region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1'),
		    'district'=>$this->User_model->get_parameter_data('ref_district','name','data_status = 1'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'lawyer_bill_rt/pages/paper_publication_summery',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}

  	function region_wise_report ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		$operation = 'region_wise_report';
		$data = array(
		    'region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1 AND id IN(1,2,3,4)'),
		    'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'lawyer_bill_rt/pages/region_wise_report',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}

	function particular_activitie_wise_report ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		$operation = 'particular_activitie_wise_report';
		$data = array(
		    'lawyer_name'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
		    'region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1'),
		    'district'=>$this->User_model->get_parameter_data('ref_district','name','data_status = 1'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'lawyer_bill_rt/pages/particular_activitie_wise_report',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}





  	function particular_activities ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		$operation = 'particular_activities';
		$data = array(
		    'lawyer_name'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
		    'region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1'),
		    'district'=>$this->User_model->get_parameter_data('ref_district','name','data_status = 1'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'lawyer_bill_rt/pages/particular_activities',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}





  	function at_a_galance_report ($menu_group,$menu_cat,$sub_menue=NULL,$operation=NULL)
	{
		$operation = 'at_a_galance_report';
		$data = array(
		    'lawyer_name'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
		    'region'=>$this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1'),
		    'district'=>$this->User_model->get_parameter_data('ref_district','name','data_status = 1'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'operation'=> $operation,
			'sub_menue'=> $sub_menue,
			'pages'=> 'lawyer_bill_rt/pages/at_a_galance_report',
	   		'per_page' => $this->config->item('per_pagess')
		   );
		$this->load->view('grid_layout',$data);
	}








	public function lawyer_bill_rt_result()
	{
		  $csrf_token=$this->security->get_csrf_hash();
		  $result = $this->lawyer_bill_rt_model->get_ac_wise_lawyer_bill();
		  $str='';
			$str.='<div style="margin-top:10px;height:350px" id="grid_table_div" class="grid_table_div">
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="3%" style="font-weight: bold;text-align:center">Loan A/c</th>
						<th width="15%" style="font-weight: bold;text-align:center">Loan A/c Name</th>
						<th width="10%" style="font-weight: bold;text-align:center">Type of Case</th>
						<th width="15%" style="font-weight: bold;text-align:center">Case No</th>
						<th width="15%" style="font-weight: bold;text-align:center">Lawyer Name</th>
						<th width="15%" style="font-weight: bold;text-align:center">Date of Bill</th>
						<th width="15%" style="font-weight: bold;text-align:center">Bill Month</th>
						<th width="15%" style="font-weight: bold;text-align:center">Activities</th>
						<th width="15%" style="font-weight: bold;text-align:center">Amount</th>
						<th width="15%" style="font-weight: bold;text-align:center">Region</th>
						<th width="15%" style="font-weight: bold;text-align:center">Segment</th>
						<th width="15%" style="font-weight: bold;text-align:center">Processing Month</th>
					</thead>
					<tbody id="table_tbody">';
				if(!empty($result))
				{
					foreach ($result as $key) 
	                {
	                    $str.='<tr>';
	                        $str.='<td align="center">'.$key->loan_ac.'</td>';
	                        $str.='<td align="left">'.$key->ac_name.'</td>';
	                        $str.='<td align="left">'.$key->type_of_case.'</td>';
	                        $str.='<td align="left">'.$key->case_number.'</td>';
	                        $str.='<td align="left">'.$key->vendor_name.'</td>';
	                        $str.='<td align="left">'.$key->txrn_dt.'</td>';
	                        $str.='<td align="left">'.$key->bill_month.'</td>';
	                        $str.='<td align="center">'.$key->act_name.'</td>';
	                        $str.='<td align="center">'.number_format($key->amount).'</td>';
	                        $str.='<td align="center">'.$key->legal_region_name.'</td>';
	                        $str.='<td align="center">'.$key->segment_name.'</td>';
	                        $str.='<td align="center">'.$key->checking_month.'</td>';
	                    $str.='</tr>';
	                }
				}					
				else
				{
					$str.="<tr><td colspan='8' align='center'>No Data Found!!!</td></tr>";
				}

		        $str.='</tbody></table></div>';

				$var =array(
			    			"str"=>$str,
							"csrf_token"=>$csrf_token
							);
					echo json_encode($var);
	}
	public function lawyer_bill_summery_result()
	{
		$result = $this->lawyer_bill_rt_model->get_lawyer_bill_summery_result();
		  $csrf_token=$this->security->get_csrf_hash();
		  $str='';
			$str.='<div style="margin-top:10px;height:350px" id="grid_table_div" class="grid_table_div">
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="15%" style="font-weight: bold;text-align:center">Submittion Date to FIN</th>
						<th width="10%" style="font-weight: bold;text-align:center">Dispitch No</th>
						<th width="15%" style="font-weight: bold;text-align:center">Lawyer\'s Oracol Reff. Number</th>
						<th width="15%" style="font-weight: bold;text-align:center">Lawyer\'s TIN Number</th>
						<th width="10%" style="font-weight: bold;text-align:center">Name of lawyers</th>
						<th width="15%" style="font-weight: bold;text-align:center">Lawyer\'s Account No.</th>
						<th width="15%" style="font-weight: bold;text-align:center">Bank name</th>
						<th width="15%" style="font-weight: bold;text-align:center">Bill amount</th>
						<th width="15%" style="font-weight: bold;text-align:center">Region</th>
					</thead>
					<tbody id="table_tbody">';

					if(!empty($result))
				{
					foreach ($result as $key) 
	                {
	                    $str.='<tr>';
	                        $str.='<td align="center">'.$key->submittiondate.'</td>';
	                        $str.='<td align="left">'.$key->dispitch_no.'</td>';
	                        $str.='<td align="left">'.$key->lawyer_oracol.'</td>';
	                        $str.='<td align="left">'.$key->tin_number.'</td>';
	                        $str.='<td align="left">'.$key->name_of_lawyers.'</td>';
	                        $str.='<td align="left">'.$key->bank_ac.'</td>';
	                        $str.='<td align="left">'.$key->bank_name.'</td>';
	                        $str.='<td align="center">'.$key->bill_amount.'</td>';
	                        $str.='<td align="center">'.$key->legal_region_name.'</td>';
	                    $str.='</tr>';
	                }
				}					
				else
				{
					$str.="<tr><td colspan='9' align='center'>No Data Found!!!</td></tr>";
				}

		        $str.='</tbody></table></div>';

				$var =array(
			    			"str"=>$str,
							"csrf_token"=>$csrf_token
							);
					echo json_encode($var);
	}
	public function ac_wise_publication_form_result()
	{
		  $csrf_token=$this->security->get_csrf_hash();
		  $result = $this->lawyer_bill_rt_model->get_ac_wise_publication_bill();
		  $str='';
			$str.='<div style="margin-top:10px;height:350px" id="grid_table_div" class="grid_table_div">
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="15%" style="font-weight: bold;text-align:center">Account No</th>
						<th width="15%" style="font-weight: bold;text-align:center">Account Name</th>
						<th width="15%" style="font-weight: bold;text-align:center">Type Of Case</th>
						<th width="10%" style="font-weight: bold;text-align:center">Case Number</th>
						<th width="15%" style="font-weight: bold;text-align:center">Paper Publication Amt.</th>
						<th width="15%" style="font-weight: bold;text-align:center">Publication Date</th>
						<th width="15%" style="font-weight: bold;text-align:center">No of Paper</th>
						<th width="15%" style="font-weight: bold;text-align:center">Name of Paper</th>
						<th width="15%" style="font-weight: bold;text-align:center">Vendor Name</th>
						<th width="15%" style="font-weight: bold;text-align:center">District</th>
						<th width="15%" style="font-weight: bold;text-align:center">Region</th>
						<th width="15%" style="font-weight: bold;text-align:center">Business-SME/Retail</th>
					</thead>
					<tbody id="table_tbody">';

				if(!empty($result))
				{
					foreach ($result as $key) 
	                {
	                    $str.='<tr>';
	                        $str.='<td align="center">'.$key->loan_ac.'</td>';
	                        $str.='<td align="left">'.$key->ac_name.'</td>';
	                        $str.='<td align="left">'.$key->type_of_case.'</td>';
	                        $str.='<td align="left">'.$key->case_number.'</td>';
	                        $str.='<td align="left">'.$key->publication_amount.'</td>';
	                        $str.='<td align="left">'.$key->publication_date.'</td>';
	                        $str.='<td align="left">'.$key->number_of_paper.'</td>';
	                        $str.='<td align="center">'.$key->paper_name.'</td>';
	                        $str.='<td align="center">'.$key->vendor_name.'</td>';
	                        $str.='<td align="center">'.$key->district_name.'</td>';
	                        $str.='<td align="center">'.$key->legal_region_name.'</td>';
	                        $str.='<td align="center">'.$key->segment_name.'</td>';
	                    $str.='</tr>';
	                }
				}					
				else
				{
					$str.="<tr><td colspan='12' align='center'>No Data Found!!!</td></tr>";
				}

		        $str.='</tbody></table></div>';
				$var =array(
			    			"str"=>$str,
							"csrf_token"=>$csrf_token
							);
					echo json_encode($var);
	}
	public function paper_publication_summery_result()
	{
		  $csrf_token=$this->security->get_csrf_hash();
		  $result = $this->lawyer_bill_rt_model->get_paper_bill_summery_result();
		  $str='';
			$str.='<div style="margin-top:10px;height:350px" id="grid_table_div" class="grid_table_div">
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="15%" style="font-weight: bold;text-align:center">Submittion Date to FIN</th>
						<th width="15%" style="font-weight: bold;text-align:center">Reff. Number</th>
						<th width="15%" style="font-weight: bold;text-align:center">TIN Number</th>
						<th width="10%" style="font-weight: bold;text-align:center">Name of Vendor</th>
						<th width="15%" style="font-weight: bold;text-align:center">Account No.</th>
						<th width="15%" style="font-weight: bold;text-align:center">Bank name</th>
						<th width="15%" style="font-weight: bold;text-align:center">Bill amount</th>
						<th width="15%" style="font-weight: bold;text-align:center">Region</th>
					</thead>
					<tbody id="table_tbody">';

				if(!empty($result))
				{
					foreach ($result as $key) 
	                {
	                    $str.='<tr>';
	                        $str.='<tr>';
	                        $str.='<td align="center">'.$key->submittiondate.'</td>';
	                        $str.='<td align="left">'.$key->lawyer_oracol.'</td>';
	                        $str.='<td align="left">'.$key->tin_number.'</td>';
	                        $str.='<td align="left">'.$key->vendor_name.'</td>';
	                        $str.='<td align="left">'.$key->bank_ac.'</td>';
	                        $str.='<td align="left">'.$key->bank_name.'</td>';
	                        $str.='<td align="center">'.$key->bill_amount.'</td>';
	                        $str.='<td align="center">'.$key->legal_region_name.'</td>';
	                    $str.='</tr>';
	                    $str.='</tr>';
	                }
				}					
				else
				{
					$str.="<tr><td colspan='8' align='center'>No Data Found!!!</td></tr>";
				}

		        $str.='</tbody></table></div>';

				$var =array(
			    			"str"=>$str,
							"csrf_token"=>$csrf_token
							);
					echo json_encode($var);
	}

 	public function particular_activitie_wise_result()
	{
		  $csrf_token=$this->security->get_csrf_hash();
		  $str='';
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" id="grid_table_div" class="grid_table_div">
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="3%" style="font-weight: bold;text-align:center">SL</th>
						<th width="15%" style="font-weight: bold;text-align:center">Vendor Name</th>
						<th width="10%" style="font-weight: bold;text-align:center">Account No.</th>
						<th width="15%" style="font-weight: bold;text-align:center">Account Name</th>
						<th width="15%" style="font-weight: bold;text-align:center">Case No.</th>
						<th width="10%" style="font-weight: bold;text-align:center">Date of legal steps</th>
						<th width="15%" style="font-weight: bold;text-align:center">Purpose/Activities</th>
						<th width="15%" style="font-weight: bold;text-align:center">Amount</th>
					</thead>
					<tbody id="table_tbody">';

					$str.='
					<td style="text-align:center">1</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
				
					';
				// $str.="<tr><td colspan='8' align='center'>No Data Found!!!</td></tr>";

			        $str.='</tbody></table></div>';

				$var =array(
			    			"str"=>$str,
							"csrf_token"=>$csrf_token
							);
					echo json_encode($var);
	}


	public function particular_activities_result()
	{
		  $csrf_token=$this->security->get_csrf_hash();
		  $str='';
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" id="grid_table_div" class="grid_table_div">
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="3%" style="font-weight: bold;text-align:center">SL</th>
						<th width="15%" style="font-weight: bold;text-align:center">Vendor Name</th>
						<th width="10%" style="font-weight: bold;text-align:center">Account No.</th>
						<th width="15%" style="font-weight: bold;text-align:center">Account Name</th>
						<th width="15%" style="font-weight: bold;text-align:center">Case No.</th>
						<th width="10%" style="font-weight: bold;text-align:center">Date of legal steps</th>
						<th width="15%" style="font-weight: bold;text-align:center">Purpose/Activities</th>
						<th width="15%" style="font-weight: bold;text-align:center">Amount</th>
					</thead>
					<tbody id="table_tbody">';

					$str.='
					<td style="text-align:center">1</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
				
					';
				// $str.="<tr><td colspan='8' align='center'>No Data Found!!!</td></tr>";

			        $str.='</tbody></table></div>';

				$var =array(
			    			"str"=>$str,
							"csrf_token"=>$csrf_token
							);
					echo json_encode($var);
	}
	public function at_a_galance_report_result()
	{
		  $csrf_token=$this->security->get_csrf_hash();
		  $str='';
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" id="grid_table_div" class="grid_table_div">
					<table class="result_table" id="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
					<thead style="">
						<th width="3%" style="font-weight: bold;text-align:center">SL</th>
						<th width="15%" style="font-weight: bold;text-align:center">Vendor Name</th>
						<th width="10%" style="font-weight: bold;text-align:center">Account No.</th>
						<th width="15%" style="font-weight: bold;text-align:center">Account Name</th>
						<th width="15%" style="font-weight: bold;text-align:center">Case No.</th>
						<th width="10%" style="font-weight: bold;text-align:center">Date of legal steps</th>
						<th width="15%" style="font-weight: bold;text-align:center">Purpose/Activities</th>
						<th width="15%" style="font-weight: bold;text-align:center">Amount</th>
					</thead>
					<tbody id="table_tbody">';

					$str.='
					<td style="text-align:center">1</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
					<td style="text-align:center">Dammy</td>
				
					';
				// $str.="<tr><td colspan='8' align='center'>No Data Found!!!</td></tr>";

			        $str.='</tbody></table></div>';

				$var =array(
			    			"str"=>$str,
							"csrf_token"=>$csrf_token
							);
					echo json_encode($var);
	}
// ==========  XL ============
	public function remove_specal_character($data)
	{
		if(empty($data) || count($data)<=0)
		{
			return array();
		}
		$new_array = array();
		for ($i=0; $i < count($data); $i++) { 
			array_push($new_array, rtrim(str_replace("&","and",$data[$i])));
		}
		return $new_array;
	}
	public function lawyer_bill_rt_xl()
	{

		include_once('tbs/clas/tbs_class.php'); 
		include_once('tbs/clas/tbs_plugin_opentbs.php'); 
		// Data From Database 
		$header_act_array = array();
		$result = $this->lawyer_bill_rt_model->get_ac_wise_lawyer_bill_xl();
		foreach($result as $key)
		{
			if($key->act_name!='')
			{
				$breaked_array = explode(",",$key->act_name);
				if(count($breaked_array)>1)
				{
					for ($i=0; $i < count($breaked_array); $i++) { 
						if (!in_array($breaked_array[$i], $header_act_array))
						{
							array_push($header_act_array, rtrim(str_replace("&","and",$breaked_array[$i])));
						}
					}
				}
				else
				{
					if (!in_array($breaked_array[0], $header_act_array))
					{
						array_push($header_act_array, rtrim(str_replace("&","and",$breaked_array[0])));
					}
				}
			}

		}
		
		$data=array();

		foreach ($result as $key) {
			$temp_data=array(
              'loan_ac'=> $key->loan_ac,
              'ac_name'=> $key->ac_name,
              'type_of_case'=> $key->type_of_case,
              'case_number'=> $key->case_number,
              'vendor_name'=> $key->vendor_name,
              'txrn_dt'=> $key->txrn_dt,
              'bill_month'=> $key->bill_month,
              'segment_name'=> $key->segment_name,
              'legal_region_name'=> $key->legal_region_name,
              'checking_month'=> $key->checking_month,
              'grand_total'=> $key->grand_total
            );
            if($key->act_name!='')
			{
				$breaked_array_amount = explode(",",$key->amount);
				$breaked_array_act = explode(",",$key->act_name);
				$breaked_array_act = $this->remove_specal_character($breaked_array_act);
				if(count($breaked_array_act)>1)
				{
					for ($i=0; $i <count($header_act_array) ; $i++) {
						$key = array_search($header_act_array[$i], $breaked_array_act);
						if($key>=0)
						{
							$temp_data['act_'.$header_act_array[$i]] = $breaked_array_amount[$key];
						}
						else
						{
							$temp_data['act_'.$header_act_array[$i]] = '-';
						}
					}
				}
				else
				{
					for ($i=0; $i <count($header_act_array) ; $i++) {
						if(rtrim(str_replace("&","and",$breaked_array_act[0]))==$header_act_array[$i])
						{
							$temp_data['act_'.$header_act_array[$i]] = $breaked_array_amount[0];
						}
						else
						{
							$temp_data['act_'.$header_act_array[$i]] = '-';
						}
					}
				}
			}
			else
			{
				for ($i=0; $i <count($header_act_array) ; $i++) { 
					$temp_data['act_'.$header_act_array[$i]] = '-';
				}
			}
			array_push($data, $temp_data);
		}
		// echo "<pre>";
		// print_r($header_act_array);
		// exit;
		// Data From Database 
		$TBS = new clsTinyButStrong; 
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 
		//$TBS->SetOption('noerr', true);
		// $TBS->PlugIn(OPENTBS_SELECT_SHEET, "Acc wise Lawyers bill"); 
		$template = 'Lawyer_Bill_Report_Template/acc_wise_Lawyer_bill.xlsx';
		$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
		$TBS->MergeBlock('dc1,dc2', $header_act_array);
		$TBS->MergeBlock('a', $data);
		$save_as='';
		$path='tbs/loan_LN_rslt/';
		$filename =	'acc_wise_Lawyer_bill.xlsx';
		$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
		$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
		exit;
	}
	public function lawyer_bill_summery_xl()
	{

			include_once('tbs/clas/tbs_class.php'); 
			include_once('tbs/clas/tbs_plugin_opentbs.php');
            $result = $this->lawyer_bill_rt_model->get_lawyer_bill_summery_result();
			$TBS = new clsTinyButStrong; 
			$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 
			$data=array();

			foreach ($result as $key) {
				$total_deduction=0;
				$total_ac_cor=0;
				$total_ac_ret=0;
				$total_ac_sm=0;

				$total_am_cor=0;
				$total_am_ret=0;
				$total_am_sm=0;
				$total_account = 0;

				$protfolio_wise_account_array = ($key->protfolio_wise_account!='')?explode("###",$key->protfolio_wise_account):array();
				$protfolio_wise_discount_array = ($key->protfolio_wise_discount!='')?explode("###",$key->protfolio_wise_discount):array();
				$protfolio_wise_amount_array = ($key->protfolio_wise_amount!='')?explode("###",$key->protfolio_wise_amount):array();
				
				
				if(count($protfolio_wise_account_array)>0)
				{
					for ($i=0; $i < count($protfolio_wise_account_array); $i++) { 
						$sub = explode("_",$protfolio_wise_account_array[$i]);
						if($sub[0]=='R')
						{
							$total_ac_ret+=$sub[1];
							$total_account+=$sub[1];
						}
						if($sub[0]=='C')
						{
							$total_ac_cor+=$sub[1];
							$total_account+=$sub[1];
						}
						if($sub[0]=='S')
						{
							$total_ac_sm+=$sub[1];
							$total_account+=$sub[1];
						}
					}
				}
				if(count($protfolio_wise_amount_array)>0)
				{
					for ($i=0; $i < count($protfolio_wise_amount_array); $i++) { 
						$sub = explode("_",$protfolio_wise_amount_array[$i]);
						if($sub[0]=='R')
						{
							$total_am_ret+=$sub[1];
						}
						if($sub[0]=='C')
						{
							$total_am_cor+=$sub[1];
						}
						if($sub[0]=='S')
						{
							$total_am_sm+=$sub[1];
						}
					}
				}
				if(count($protfolio_wise_discount_array)>0)
				{
					for ($i=0; $i < count($protfolio_wise_discount_array); $i++) { 
						$sub = explode("_",$protfolio_wise_discount_array[$i]);
						$total_deduction+=$sub[1];
					}
				}
				
				$data[]=array(
	              'received_date_from_field'=> $key->received_date_from_field,
	              'submittiondate'=> $key->submittiondate,
	              'lawyers_bill_paid'=> $key->lawyers_bill_paid,
	              'dispitch_no'=> $key->dispitch_no,
	              'lawyer_oracol'=> $key->lawyer_oracol,
	              'tin_number'=> $key->tin_number,
	              'bin_number'=> $key->bin_number,
	              'name_of_lawyers'=> $key->name_of_lawyers,
	              'sme'=> ($total_am_sm>0)?$total_am_sm:'-',
	              'retail'=> ($total_am_ret>0)?$total_am_ret:'-',
	              'corporate'=> ($total_am_cor>0)?$total_am_cor:'-',
	              'bill_amount'=> $key->bill_amount,
	              'bill_for_month'=> $key->bill_months,
	              'acc_no'=> $key->bank_ac,
	              'bank_name'=> $key->bank_name,
	              'lawyer_total'=> ($total_account>0)?$total_account:'-',
	              'accouct_per_lawyer'=> ($total_ac_sm>0)?$total_ac_sm:'-',
	              'ac_retail'=> ($total_ac_ret>0)?$total_ac_ret:'-',
	              'ac_cor'=> ($total_ac_cor>0)?$total_ac_cor:'-',
	              'region'=> $key->legal_region_name,
	              'ded_amount'=> ($total_deduction>0)?$total_deduction:'-'
	            );
			}
			$template = 'Lawyer_Bill_Report_Template/lawyer_bill_summery.xlsx';
			$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
			$TBS->MergeBlock('a', $data);
			$save_as='';
			$path='tbs/loan_LN_rslt/';
			$filename =	'lawyer_bill_summery.xlsx';
			$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
			$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
			exit;
	}
	public function ac_wise_publication_xl()
	{

			include_once('tbs/clas/tbs_class.php'); 
			include_once('tbs/clas/tbs_plugin_opentbs.php');
			
			$TBS = new clsTinyButStrong; 
			$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 
			$result = $this->lawyer_bill_rt_model->get_ac_wise_publication_bill();
			$template = 'Lawyer_Bill_Report_Template/Publication/acc_wise_publication_bill.xlsx';
			$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
			$TBS->MergeBlock('a', $result);
			$save_as='';
			$path='tbs/loan_LN_rslt/';
			$filename =	'acc_wise_publication_bill.xlsx';
			$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
			$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
			exit;
	}
	public function paper_publication_summery_lx()
	{

			include_once('tbs/clas/tbs_class.php'); 
			include_once('tbs/clas/tbs_plugin_opentbs.php');
    		$result = $this->lawyer_bill_rt_model->get_paper_bill_summery_result();

			$TBS = new clsTinyButStrong; 
			$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 

			$template = 'Lawyer_Bill_Report_Template/Publication/paper_publication_summery.xlsx';
			$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
			$data=array();

			foreach ($result as $key) {
				$total_deduction=0;
				$total_ac_cor=0;
				$total_ac_ret=0;
				$total_ac_sm=0;

				$total_am_cor=0;
				$total_am_ret=0;
				$total_am_sm=0;
				$total_account = 0;

				$protfolio_wise_account_array = ($key->protfolio_wise_account!='')?explode("###",$key->protfolio_wise_account):array();
				$protfolio_wise_discount_array = ($key->protfolio_wise_discount!='')?explode("###",$key->protfolio_wise_discount):array();
				$protfolio_wise_amount_array = ($key->protfolio_wise_amount!='')?explode("###",$key->protfolio_wise_amount):array();
				
				
				if(count($protfolio_wise_account_array)>0)
				{
					for ($i=0; $i < count($protfolio_wise_account_array); $i++) { 
						$sub = explode("_",$protfolio_wise_account_array[$i]);
						if($sub[0]=='R')
						{
							$total_ac_ret+=$sub[1];
							$total_account+=$sub[1];
						}
						if($sub[0]=='C')
						{
							$total_ac_cor+=$sub[1];
							$total_account+=$sub[1];
						}
						if($sub[0]=='S')
						{
							$total_ac_sm+=$sub[1];
							$total_account+=$sub[1];
						}
					}
				}
				if(count($protfolio_wise_amount_array)>0)
				{
					for ($i=0; $i < count($protfolio_wise_amount_array); $i++) { 
						$sub = explode("_",$protfolio_wise_amount_array[$i]);
						if($sub[0]=='R')
						{
							$total_am_ret+=$sub[1];
						}
						if($sub[0]=='C')
						{
							$total_am_cor+=$sub[1];
						}
						if($sub[0]=='S')
						{
							$total_am_sm+=$sub[1];
						}
					}
				}
				if(count($protfolio_wise_discount_array)>0)
				{
					for ($i=0; $i < count($protfolio_wise_discount_array); $i++) { 
						$sub = explode("_",$protfolio_wise_discount_array[$i]);
						$total_deduction+=$sub[1];
					}
				}
				
				$data[]=array(
	              'received_date_from_field'=> $key->received_date_from_field,
	              'submittiondate'=> $key->submittiondate,
	              'lawyers_bill_paid'=> $key->lawyers_bill_paid,
	              'lawyer_oracol'=> $key->lawyer_oracol,
	              'tin_number'=> $key->tin_number,
	              'bin_number'=> $key->bin_number,
	              'vendor_name'=> $key->vendor_name,
	              'vendor_type'=> $key->vendor_type,
	              'district_name'=> $key->district_name,
	              'sme'=> ($total_am_sm>0)?$total_am_sm:'-',
	              'retail'=> ($total_am_ret>0)?$total_am_ret:'-',
	              'corporate'=> ($total_am_cor>0)?$total_am_cor:'-',
	              'bill_amount'=> $key->bill_amount,
	              'bill_for_month'=> $key->bill_months,
	              'acc_no'=> $key->bank_ac,
	              'bank_name'=> $key->bank_name,
	              'lawyer_total'=> ($total_account>0)?$total_account:'-',
	              'accouct_per_lawyer'=> ($total_ac_sm>0)?$total_ac_sm:'-',
	              'ac_retail'=> ($total_ac_ret>0)?$total_ac_ret:'-',
	              'ac_cor'=> ($total_ac_cor>0)?$total_ac_cor:'-',
	              'region'=> $key->legal_region_name,
	              'initiator_am'=> $key->initiator_am
	            );
			}

			$TBS->MergeBlock('a', $data);

			$save_as='';
			$path='tbs/loan_LN_rslt/';
			$filename =	'paper_publication_summery.xlsx';
			$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
			$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
			exit;
	}
	public function region_wise_report_xl()
	{
			include_once('tbs/clas/tbs_class.php'); 
			include_once('tbs/clas/tbs_plugin_opentbs.php');
			$result1 = $this->lawyer_bill_rt_model->get_region_wise_result1();
			$TBS = new clsTinyButStrong; 
			$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 

			$template = 'Lawyer_Bill_Report_Template/region_wise_report.xlsx';
			$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
			
			$TBS->MergeBlock('a', $result1);
			$TBS->MergeBlock('b', $result1);

			$save_as='';
			$path='tbs/loan_LN_rslt/';
			$filename =	'Region_wise_Report.xlsx';
			$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
			$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
			exit;
	}
	public function particular_activities_xl()
	{

			include_once('tbs/clas/tbs_class.php'); 
			include_once('tbs/clas/tbs_plugin_opentbs.php');
     		$result1 = $this->lawyer_bill_rt_model->get_particular_activities_result();

			$TBS = new clsTinyButStrong; 
			$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 
			$year=date('Y');
			if (trim($this->input->post('from_year')) != '') {
                $year=$this->input->post('from_year');
            }
			$prev_year = $year-1;
			$result2[]=array(
				'year'=> $year,
              	'prev_year'=> $prev_year,
			);
			$template = 'Lawyer_Bill_Report_Template/particulers_activities.xlsx';
			$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
			
			$TBS->MergeBlock('a', $result1);
			$TBS->MergeBlock('b', $result2);

			$save_as='';
			$path='tbs/loan_LN_rslt/';
			$filename =	'particulers_activities.xlsx';
			$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
			$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
			exit;
	}
	function excel_test()
	{
		require_once('./application/Classes/PhpXlsxGenerator.php'); 
		//require_once 'PhpXlsxGenerator.php';
		// Excel file name for download 
		$fileName = "lawyer-data_" . date('Y-m-d') . ".xlsx"; 
		 
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
			'Send To Finance Date'
		); 
		 
		// Fetch records from database and store in an array 
		$result_lawyer_all = $this->lawyer_bill_rt_model->get_galance_report_lawyer_bill_all();
		if(count($result_lawyer_all) > 0){ 
		    foreach($result_lawyer_all as $key)
		    {
		    	$lineData = array(
		    		$key->loan_ac,
                    $key->ac_name,
                    $key->vendor_code,
                    $key->vendor_name,                   
                    $key->type_of_case,                   
                    $key->case_number,                   
                    $key->act_name,                   
                    $key->txrn_dt,                   
                    $key->amount,                   
                    $key->bill_month,                   
                    $key->bill_payment_date,                   
                    $key->court_type,                   
                    $key->territory_name,                   
                    $key->district_name,                   
                    $key->legal_region_name,                   
                    $key->segment_name,                   
                    $key->stf_dt,
		    	);  
		        $excelData[] = $lineData; 
		    }
		} 
		 
		// Export data to excel and download as xlsx file 
		$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
		$xlsx->downloadAs($fileName); 
		 
		exit; 
	}
	public function at_a_galance_report_xl()
	{
		$year=date('Y');
		if (trim($this->input->post('from_year')) != '') {
            $year=$this->input->post('from_year');
        }
        //Summery Result
        $year_string = 'Jan\''.$year.' to Dec\''.$year;

        if(isset($_POST['Lawyer']))
        {
        	require_once('./application/Classes/PhpXlsxGenerator.php'); 
			//require_once 'PhpXlsxGenerator.php';
			// Excel file name for download 
			$fileName = "lawyer-data_" . date('Y-m-d') . ".xlsx"; 
			 
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
				'Send To Finance Date'
			); 
			 
			// Fetch records from database and store in an array 
			$result_lawyer_all = $this->lawyer_bill_rt_model->get_galance_report_lawyer_bill_all();
			if(count($result_lawyer_all) > 0){ 
			    foreach($result_lawyer_all as $key)
			    {
			      if($key->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
		          {
		            $loan_ac = $this->Common_model->stringEncryption('decrypt',$key->org_loan_ac);
		          }
		          else
		          {
		            $loan_ac = $key->loan_ac;
		          }
			    	$lineData = array(
			    		$loan_ac,
	                    $key->ac_name,
	                    $key->vendor_code,
	                    $key->vendor_name,                   
	                    $key->type_of_case,                   
	                    $key->case_number,                   
	                    $key->act_name,                   
	                    $key->txrn_dt,                   
	                    $key->amount,                   
	                    $key->bill_month,                   
	                    $key->bill_payment_date,                   
	                    $key->court_type,                   
	                    $key->territory_name,                   
	                    $key->district_name,                   
	                    $key->legal_region_name,                   
	                    $key->segment_name,                   
	                    $key->stf_dt,
			    	);  
			        $excelData[] = $lineData; 
			    }
			} 
			 
			// Export data to excel and download as xlsx file 
			$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
			$xlsx->downloadAs($fileName); 
			 
			exit; 
        	$result_lawyer_all = $this->lawyer_bill_rt_model->get_galance_report_lawyer_bill_all_csv();
	        $out_file=time();
			$date=date("Y_m_d");
			$files = glob("./csv_rtgs/*.csv"); 
			if($files){
				foreach($files as $file ){
			 		unlink($file);
			 	} 
			}
			$data='';
			$count=0;
			foreach($result_lawyer_all as $rows)
			{
				$count++;
			 	$row = array(
                    '0'=>$this->escapeCsvValue($rows->loan_ac),
                    '1'=>$this->escapeCsvValue($rows->ac_name),
                    '2'=>$this->escapeCsvValue($rows->vendor_code),
                    '3'=>$this->escapeCsvValue($rows->vendor_name),                   
                    '4'=>$this->escapeCsvValue($rows->type_of_case),                   
                    '5'=>$this->escapeCsvValue($rows->case_number),                   
                    '6'=>$this->escapeCsvValue($rows->act_name),                   
                    '7'=>$this->escapeCsvValue($rows->txrn_dt),                   
                    '8'=>$this->escapeCsvValue($rows->amount),                   
                    '9'=>$this->escapeCsvValue($rows->bill_month),                   
                    '10'=>$this->escapeCsvValue($rows->bill_payment_date),                   
                    '11'=>$this->escapeCsvValue($rows->court_type),                   
                    '12'=>$this->escapeCsvValue($rows->territory_name),                   
                    '13'=>$this->escapeCsvValue($rows->district_name),                   
                    '14'=>$this->escapeCsvValue($rows->legal_region_name),                   
                    '15'=>$this->escapeCsvValue($rows->segment_name),                   
                    '16'=>$this->escapeCsvValue($rows->stf_dt),                   
                );

                $data .= join(',', $row)."\n"; // Create a new row of data and append it to the last row
                $row = '';
			}			
			
			$filename='./csv_report/'.$out_file.'_'.$date.'.csv';						
			$fd = fopen ($filename, "w"); 
			fputs($fd, $data);
			fclose($fd);
		
			$this->download($filename); 
			exit;

        	// include_once('tbs/clas/tbs_class.php'); 
			// include_once('tbs/clas/tbs_plugin_opentbs.php');
			// $TBS = new clsTinyButStrong; 
			// $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 
			// $template = 'Lawyer_Bill_Report_Template/lawyer_bill_details.xlsx';
			// $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
        	// $result_lawyer_all = $this->lawyer_bill_rt_model->get_galance_report_lawyer_bill_all();
			// $TBS->PlugIn(OPENTBS_SELECT_SHEET,"Lawyer Bill Data");
			// $TBS->MergeBlock('l_details', $result_lawyer_all);
        }
        else
        {
        	
			$result_cma = $this->lawyer_bill_rt_model->get_galance_report_cma_tbs();
			$result_legal_notice = $this->lawyer_bill_rt_model->get_galance_report_legal_notice_tbs();
			$result_lawyer_bill = $this->lawyer_bill_rt_model->get_galance_report_lawyer_bill_data_tbs();
			$result_paper_bill = $this->lawyer_bill_rt_model->get_galance_report_paper_bill_data_tbs();
			$result_court_fee = $this->lawyer_bill_rt_model->get_galance_report_court_fee_tbs();
			$result_court_enter = $this->lawyer_bill_rt_model->get_galance_report_court_enter_tbs();
			$result_staff = $this->lawyer_bill_rt_model->get_galance_report_court_staff_all();
			$result_instru = $this->lawyer_bill_rt_model->get_galance_report_instru_tbs();


			//Details // 

			
			$result_paper_all = $this->make_unmasked_array($this->lawyer_bill_rt_model->get_galance_report_paper_bill_all());
			$result_court_fee_all = $this->make_unmasked_array($this->lawyer_bill_rt_model->get_galance_report_court_fee_all());
			$result_cma_all = $this->make_unmasked_array($this->lawyer_bill_rt_model->get_galance_report_cma_all());
			$result_fln_all = $this->make_unmasked_array($this->lawyer_bill_rt_model->get_galance_report_ln_all());
			$result_ce_all = $this->make_unmasked_array($this->lawyer_bill_rt_model->get_galance_report_court_enter_all());
			$result_sc_all = $this->make_unmasked_array($this->lawyer_bill_rt_model->get_galance_report_staff_conv_all());
			$result_id_all = $this->make_unmasked_array($this->lawyer_bill_rt_model->get_galance_report_cma_instu_all());


			include_once('tbs/clas/tbs_class.php'); 
			include_once('tbs/clas/tbs_plugin_opentbs.php');
			$TBS = new clsTinyButStrong; 
			$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 
			$template = 'Lawyer_Bill_Report_Template/galance_report.xlsx';
			$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
			$TBS->PlugIn(OPENTBS_SELECT_SHEET,"Bill Summary Report");
			$summary_heading[]= array('h' => $year_string);
			$TBS->MergeBlock('summery', $summary_heading);
			$TBS->MergeBlock('a', $result_cma);
			$TBS->MergeBlock('b', $result_legal_notice);
			$TBS->MergeBlock('c', $result_lawyer_bill);
			$TBS->MergeBlock('d', $result_paper_bill);
			$TBS->MergeBlock('e', $result_court_fee);
			$TBS->MergeBlock('f', $result_court_enter);
			$TBS->MergeBlock('g', $result_staff);
			$TBS->MergeBlock('h', $result_instru);

			
			$TBS->PlugIn(OPENTBS_SELECT_SHEET,"Publication Bill Data");
			$TBS->MergeBlock('p_details', $result_paper_all);
			$TBS->PlugIn(OPENTBS_SELECT_SHEET,"Court Fees Data");
			$TBS->MergeBlock('cf_details', $result_court_fee_all);
			$TBS->PlugIn(OPENTBS_SELECT_SHEET,"CMA Approved Data");
			$TBS->MergeBlock('cma_details', $result_cma_all);
			$TBS->PlugIn(OPENTBS_SELECT_SHEET,"Legal Notice Data");
			$TBS->MergeBlock('fln_details', $result_fln_all);
			$TBS->PlugIn(OPENTBS_SELECT_SHEET,"Court Entertainment Data");
			$TBS->MergeBlock('ce_details', $result_ce_all);
			$TBS->PlugIn(OPENTBS_SELECT_SHEET,"Staff Convance Data");
			$TBS->MergeBlock('sc_details', $result_sc_all);
			$TBS->PlugIn(OPENTBS_SELECT_SHEET,"Instrument Delivered Data");
			$TBS->MergeBlock('id_details', $result_id_all);
        }



		$save_as='';
		$path='tbs/loan_LN_rslt/';
		$filename =	'Galance_report.xlsx';
		$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
		$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
		exit;

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
	function escapeCsvValue($value) {
		$value = str_replace('"', '""', $value); // First off escape all " and make them ""
		if(preg_match('/,/', $value) or preg_match("/\n/", $value) or preg_match('/"/', $value)) { // Check if I have any commas or new lines
			return '"'.$value.'"'; // If I have new lines or commas escape them
		} else {
			return $value; // If no new lines or commas just return the value
		}
	}
	function download($filename)
	{
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: 0");
		header('Content-Disposition: attachment; filename="'.basename($filename).'"');
		header('Content-Length: ' . filesize($filename));
		header('Pragma: public');

		//Clear system output buffer
		flush();

		//Read the size of the file
		readfile($filename);

		//Terminate from the script
		die();
	}
	public function at_a_galance_report_xl_phpexcel()
	{
		$year=date('Y');
		if (trim($this->input->post('from_year')) != '') {
            $year=$this->input->post('from_year');
        }
        $year_string = 'Jan\''.$year.' to Dec\''.$year;

		$result_cma = $this->lawyer_bill_rt_model->get_galance_report_cma();
		$result_instru = $this->lawyer_bill_rt_model->get_galance_report_instru();
		$result1 = $this->lawyer_bill_rt_model->get_galance_report_lawyer_bill_data();
		$result_court_fee = $this->lawyer_bill_rt_model->get_galance_report_court_fee();
		$result_court_enter = $this->lawyer_bill_rt_model->get_galance_report_court_enter();
		$result_court_staff = $this->lawyer_bill_rt_model->get_galance_report_court_staff();

		$result2 = $this->lawyer_bill_rt_model->get_galance_report_legal_notice();
		
		$result3 = $this->lawyer_bill_rt_model->get_galance_report_paper_bill_data();

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
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
        $styleThinBlackBorderOutline = array(
		'borders' => array(														
				'top'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'right'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				),
				'left'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)	,
				'bottom'     => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)													
			),
		);
        $color_style = array(
                'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb'=>'C2D69A'),
                )
                
        );
        $color_style2 = array(
                'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb'=>'538ed5'),
                )
                
        );
        $color_styleall = array(
                'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb'=>'f8cbad'),
                )
                
        );
        $color_stylecma = array(
                'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb'=>'66FFFF'),
                )
                
        );
        $color_style3 = array(
                'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb'=>'fac090'),
                )
                
        );
        $color_style4 = array(
                'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb'=>'b2a1c7'),
                )
                
        );
        $rowNumber = 1;
        $headings1 = array('Jan\''.$year.' to Dec\''.$year);
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':P'.$rowNumber); 
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->applyFromArray($color_style);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$rowNumber++;
		$headings1 = array('SL','Particulars','','January','February','March','April','May','Jun','July','Aug','Sep','Oct','Nov','Dec','Grand Total');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber); 
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':P'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_style2);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$rowNumber++;

		for ($i=1; $i <=12 ; $i++) { 
            ${'total_' . $i} = 0;
        }
		$counter=1;
		foreach($result_cma as $key)
		{
			$row_total=0;
			if($counter==1)
			{
				$headings1 = array('1','Case Merit Analysis',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+3));
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+3));
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_stylecma);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($color_stylecma);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($color_stylecma);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);

				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			else
			{
				$headings1 = array('','',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_stylecma);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			$counter++;
		}
		$counter=1;
		foreach($result2 as $key)
		{
			$row_total=0;
			
			if($counter==1)
			{
				$headings1 = array('2','1st Legal Notice Processing',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+7));
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+7));
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        if($key->header=='1')
		        {
		        	$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_style4);
		        }
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($color_style4);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($color_style4);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			else
			{
				$headings1 = array('','',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        if($key->header=='1')
		        {
		        	$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_style3);
		        }
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			$counter++;
		}
		$counter=1;
		foreach($result1 as $key)
		{
			$row_total=0;
			if($counter==1)
			{
				$headings1 = array('3','Lawyer\'s Bill',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+7));
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+7));
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        if($key->header=='1')
		        {
		        	$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_style3);
		        }
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($color_style3);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($color_style3);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);

				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			else
			{
				$headings1 = array('','',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        if($key->header=='1')
		        {
		        	$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_style3);
		        }
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			$counter++;
		}
		$counter=1;
		foreach($result3 as $key)
		{
			$row_total=0;
			if($counter==1)
			{
				$headings1 = array('4','Paper Publication',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+7));
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+7));
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        if($key->header=='1')
		        {
		        	$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_style3);
		        }
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($color_style);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($color_style);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			else
			{
				$headings1 = array('','',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        if($key->header=='1')
		        {
		        	$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_style3);
		        }
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			$counter++;
		}
		$counter=1;
		foreach($result_court_fee as $key)
		{
			$row_total=0;
			if($counter==1)
			{
				$headings1 = array('5','Court Fees',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+7));
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+7));
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        if($key->header=='1')
		        {
		        	$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_stylecma);
		        }
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($color_stylecma);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($color_stylecma);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			else
			{
				$headings1 = array('','',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        if($key->header=='1')
		        {
		        	$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_stylecma);
		        }
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			$counter++;
		}
		$counter=1;
		foreach($result_court_enter as $key)
		{
			$row_total=0;
			if($counter==1)
			{
				$headings1 = array('6','Court Entertainment',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+7));
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+7));
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        if($key->header=='1')
		        {
		        	$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_stylecma);
		        }
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($color_stylecma);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($color_stylecma);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			else
			{
				$headings1 = array('','',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        if($key->header=='1')
		        {
		        	$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_stylecma);
		        }
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			$counter++;
		}
		$counter=1;
		foreach($result_court_staff as $key)
		{
			$row_total=0;
			if($counter==1)
			{
				$headings1 = array('7','Staff Convance',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+1));
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+1));
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        if($key->header=='1')
		        {
		        	$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_style3);
		        }
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($color_style3);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($color_style3);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			else
			{
				$headings1 = array('','',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        if($key->header=='1')
		        {
		        	$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_style3);
		        }
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			$counter++;
		}
		$counter=1;
		foreach($result_instru as $key)
		{
			$row_total=0;
			if($counter==1)
			{
				$headings1 = array('8','Instrument Delivered ',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':A'.($rowNumber+3));
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':B'.($rowNumber+3));
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_stylecma);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($color_stylecma);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($color_stylecma);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);

				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			else
			{
				$headings1 = array('','',$key->type);
				for ($i=1; $i <=12 ; $i++) {
					$month = 'count_'.$i; 
					$row_total+=$key->$month;
					array_push($headings1,$key->$month);
					if($key->type=='Total Amount')
					{
						${'total_' . $i}+=$key->$month;
					}
				}
				array_push($headings1,$row_total);
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':P'.$rowNumber)->applyFromArray($color_stylecma);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;
			}
			$counter++;
		}
		
		$rowNumber++;


		$objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Bill Summary Report'); 

        $objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet()->setTitle('Lawyer Bill Data'); 
		$rowNumber=1;
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
		$rowNumber++;
		$headings1 = array('SL','Account Number','Account Name',
			'Lawyer/Vendor Oracal Ref. Number','Lawyer/Vendor Name',
			'Type of Case','Case Number','Activities Name','Activities date',
			'Bill Amount','Bill Month','Bill Payment Date','Court Type (High/Lower Court)',
			'Territory','District','Region','Portfolio','Send To Finance Date');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->applyFromArray($color_styleall);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('Q'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('R'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$rowNumber++;
		$result_lawyer_all = $this->lawyer_bill_rt_model->get_galance_report_lawyer_bill_all();
        $sl=0;
        $loop_counter=0;
	    $active_sheet=0;
        foreach ($result_lawyer_all as $key) 
        {
        	$sl++;
        	$loop_counter++;
        	if($key->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
	          {
	            $loan_ac = $this->Common_model->stringEncryption('decrypt',$key->org_loan_ac);
	          }
	          else
	          {
	            $loan_ac = $key->loan_ac;
	          }
	        if($loop_counter>100000) //create new sheet
	        {
	        	$loop_counter=0;
    			$active_sheet++;
	        	$objPHPExcel->createSheet();
				$objPHPExcel->setActiveSheetIndex($active_sheet);
				$objPHPExcel->getActiveSheet()->setTitle('Lawyer Bill Data'); 

				$rowNumber=1;
				$rowNumber++;
				$headings1 = array('SL','Account Number','Account Name',
					'Lawyer/Vendor Oracal Ref. Number','Lawyer/Vendor Name',
					'Type of Case','Case Number','Activities Name','Activities date',
					'Bill Amount','Bill Month','Bill Payment Date','Court Type (High/Lower Court)',
					'Territory','District','Region','Portfolio','Send To Finance Date');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->applyFromArray($color_styleall);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('Q'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$objPHPExcel->getActiveSheet()->getStyle('R'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
				$rowNumber++;

	        }
        	$objPHPExcel->getActiveSheet()->fromArray(array(
				$sl,
				$loan_ac,
				$key->ac_name,
				$key->vendor_code,
				$key->vendor_name,
				$key->type_of_case,
				$key->case_number,
				$key->act_name,
				$key->txrn_dt,
				$key->amount,
				$key->bill_month,
				$key->bill_payment_date,
				$key->court_type,
				$key->territory_name,
				$key->district_name,
				$key->legal_region_name,
				$key->segment_name,
				$key->stf_dt,
				),NULL,'A'.$rowNumber);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
			$rowNumber++;
        }



        $objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(2);
		$objPHPExcel->getActiveSheet()->setTitle('Publication Bill Data'); 
		$rowNumber=1;
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
		$rowNumber++;
		$headings1 = array('SL','Account Number','Account Name',
			'Lawyer/Vendor Oracal Ref. Number','Lawyer/Vendor Name',
			'Type of Case','Case Number','Activities Name','Activities date',
			'Bill Amount','Bill Month','Bill Payment Date','Court Type (High/Lower Court)',
			'Territory','District','Region','Portfolio','NPS Name','NPS Pub. Date','NPS Pub. Section','Send To Finance Date');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($color_styleall);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('Q'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('R'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('S'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('T'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('U'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$rowNumber++;
		$result_lawyer_all = $this->lawyer_bill_rt_model->get_galance_report_paper_bill_all();
        $sl=0;
        foreach ($result_lawyer_all as $key) 
        {
        	$sl++;
        	if($key->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
	          {
	            $loan_ac = $this->Common_model->stringEncryption('decrypt',$key->org_loan_ac);
	          }
	          else
	          {
	            $loan_ac = $key->loan_ac;
	          }
        	$objPHPExcel->getActiveSheet()->fromArray(array(
				$sl,
				$loan_ac,
				$key->ac_name,
				$key->vendor_code,
				$key->vendor_name,
				$key->type_of_case,
				$key->case_number,
				$key->act_name,
				$key->txrn_dt,
				$key->amount,
				$key->bill_month,
				$key->bill_year,
				$key->bill_payment_date,
				$key->court_type,
				$key->territory_name,
				$key->district_name,
				$key->legal_region_name,
				$key->segment_name,
				$key->paper_name,
				$key->txrn_dt,
				'',
				$key->stf_dt,
				),NULL,'A'.$rowNumber);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':U'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
			$rowNumber++;
        }


        $objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(3);
		$objPHPExcel->getActiveSheet()->setTitle('Court Fees Data'); 
		$rowNumber=1;
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
		$rowNumber++;
		$headings1 = array('SL','Account Number','Account Name',
			'Lawyer/Vendor Oracal Ref. Number','Lawyer/Vendor Name',
			'Court Fees Amount','Bill Month','Bill Year','Bill Payment Date',
			'Territory','District','Region','Portfolio','Send To Finance Date');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($color_styleall);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$rowNumber++;
		$result_lawyer_all = $this->lawyer_bill_rt_model->get_galance_report_court_fee_all();
        $sl=0;
        foreach ($result_lawyer_all as $key) 
        {
        	$sl++;
        	if($key->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
	          {
	            $loan_ac = $this->Common_model->stringEncryption('decrypt',$key->org_loan_ac);
	          }
	          else
	          {
	            $loan_ac = $key->loan_ac;
	          }
        	$objPHPExcel->getActiveSheet()->fromArray(array(
				$sl,
				$loan_ac,
				$key->ac_name,
				$key->vendor_code,
				$key->vendor_name,
				$key->amount,
				$key->bill_month,
				$key->bill_year,
				$key->bill_payment_date,
				$key->territory_name,
				$key->district_name,
				$key->legal_region_name,
				$key->segment_name,
				$key->stf_dt,
				),NULL,'A'.$rowNumber);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
			$rowNumber++;
        }


        $objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(4);
		$objPHPExcel->getActiveSheet()->setTitle('CMA Approved Data'); 
		$rowNumber=1;
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
		$rowNumber++;
		$headings1 = array('SL','Account Number','Account Name',
			'Type of Case','Initiate Date',
			'Recommend  Date','Approved Date','Approved Month','Approved Year',
			'Territory','District','Region','Portfolio');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':M'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':M'.$rowNumber)->applyFromArray($color_styleall);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$rowNumber++;
		$result_lawyer_all = $this->lawyer_bill_rt_model->get_galance_report_cma_all();
        $sl=0;
        foreach ($result_lawyer_all as $key) 
        {
        	$sl++;
        	if($key->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
	          {
	            $loan_ac = $this->Common_model->stringEncryption('decrypt',$key->org_loan_ac);
	          }
	          else
	          {
	            $loan_ac = $key->loan_ac;
	          }
        	$objPHPExcel->getActiveSheet()->fromArray(array(
				$sl,
				$loan_ac,
				$key->ac_name,
				$key->type_of_case,
				$key->initiate_date,
				$key->recommend_date,
				$key->approve_date,
				$key->approve_month,
				$key->approve_year,
				$key->territory_name,
				$key->district_name,
				$key->legal_region_name,
				$key->segment_name,
				),NULL,'A'.$rowNumber);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':M'.$rowNumber)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
			$rowNumber++;
        }


        $objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(5);
		$objPHPExcel->getActiveSheet()->setTitle('1st Legal Notice Data'); 
		$rowNumber=1;
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
		$rowNumber++;
		$headings1 = array('SL','Account Number','Account Name',
			'Lawyer/Vendor Oracal Ref. Number','Lawyer/Vendor Name',
			'Activities Name','Legal Notice Sending date','Legal Notice Sending Month',
			'Legal Notice Sending Year','Bill Amount',
			'Territory','District','Region','Portfolio','No of Copy');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->applyFromArray($color_styleall);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$rowNumber++;
		$result_lawyer_all = $this->lawyer_bill_rt_model->get_galance_report_ln_all();
        $sl=0;
        foreach ($result_lawyer_all as $key) 
        {
        	$sl++;
        	if($key->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
	          {
	            $loan_ac = $this->Common_model->stringEncryption('decrypt',$key->org_loan_ac);
	          }
	          else
	          {
	            $loan_ac = $key->loan_ac;
	          }
        	$objPHPExcel->getActiveSheet()->fromArray(array(
				$sl,
				$loan_ac,
				$key->ac_name,
				$key->vendor_code,
				$key->vendor_name,
				$key->description,
				$key->legal_notice_s_dt,
				$key->send_month,
				$key->send_year,
				$key->amount,
				$key->territory_name,
				$key->district_name,
				$key->legal_region_name,
				$key->segment_name,
				$key->qty,
				),NULL,'A'.$rowNumber);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
			$rowNumber++;
        }


        $objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(6);
		$objPHPExcel->getActiveSheet()->setTitle('Court Entertainment Data'); 
		$rowNumber=1;
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
		$rowNumber++;
		$headings1 = array('SL','Account Number','Account Name',
			'Case Dealing Officer Name','Case Dealing Officer PIN',
			'Type of Case','Case Number','Activities/ Purpose Name',
			'Activities date','Bill Amount','Bill Month','Bill Year','Bill Payment Date','Court Type (High/Lower Court)',
			'Territory','District','Region','Portfolio','Send To Finance Date');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':S'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':S'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':S'.$rowNumber)->applyFromArray($color_styleall);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('Q'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('R'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('S'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$rowNumber++;
		$result_lawyer_all = $this->lawyer_bill_rt_model->get_galance_report_court_enter_all();
        $sl=0;
        foreach ($result_lawyer_all as $key) 
        {
        	$sl++;
        	if($key->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
	          {
	            $loan_ac = $this->Common_model->stringEncryption('decrypt',$key->org_loan_ac);
	          }
	          else
	          {
	            $loan_ac = $key->loan_ac;
	          }
        	$objPHPExcel->getActiveSheet()->fromArray(array(
				$sl,
				$loan_ac,
				$key->ac_name,
				$key->vendor_name,
				$key->vendor_code,
				$key->type_of_case,
				$key->case_number,
				$key->activities_name,
				$key->txrn_dt,
				$key->amount,
				$key->bill_month,
				$key->bill_year,
				$key->bill_payment_date,
				'Lower Court',
				$key->territory_name,
				$key->district_name,
				$key->legal_region_name,
				$key->segment_name,
				$key->stf_dt,
				),NULL,'A'.$rowNumber);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':S'.$rowNumber)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':S'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
			$rowNumber++;
        }


        $objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(7);
		$objPHPExcel->getActiveSheet()->setTitle('Staff Convance Data'); 
		$rowNumber=1;
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
		$rowNumber++;
		$headings1 = array('SL','Account Number','Account Name',
			'Case Dealing Officer Name','Case Dealing Officer PIN',
			'Activities/ Purpose Name',
			'Activities date','Bill Amount','Bill Month','Bill Year','Bill Payment Date',
			'District','Region','Send To Finance Date');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($color_styleall);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$rowNumber++;
		$result_lawyer_all = $this->lawyer_bill_rt_model->get_galance_report_staff_conv_all();
        $sl=0;
        foreach ($result_lawyer_all as $key) 
        {
        	$sl++;
        	if($key->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
	          {
	            $loan_ac = $this->Common_model->stringEncryption('decrypt',$key->org_loan_ac);
	          }
	          else
	          {
	            $loan_ac = $key->loan_ac;
	          }
        	$objPHPExcel->getActiveSheet()->fromArray(array(
				$sl,
				$loan_ac,
				$key->ac_name,
				$key->vendor_name,
				$key->vendor_code,
				$key->activities_name,
				$key->txrn_dt,
				$key->amount,
				$key->bill_month,
				$key->bill_year,
				$key->bill_payment_date,
				$key->district_name,
				$key->legal_region_name,
				$key->stf_dt
				),NULL,'A'.$rowNumber);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
			$rowNumber++;
        }


        $objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(8);
		$objPHPExcel->getActiveSheet()->setTitle('Instrument Delivered Data'); 
		$rowNumber=1;
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
		$rowNumber++;
		$headings1 = array('SL','Account Number','Account Name','CMA Approved Date',
			'Type of Case','Claim Balance','Banalce Date','Instrument Delivered date',
			'Instrument Acknowledge Date','Instrument Acknowledge Case Dealing Officer Name',
			'Case Dealing Officer PIN','Delivered Year','Territory',
			'Recovery District','Recovery Region','Legal District','Legal Region','Portfolio');
        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->applyFromArray($color_styleall);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('N'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('O'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('Q'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$objPHPExcel->getActiveSheet()->getStyle('R'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
		$rowNumber++;
		$result_lawyer_all = $this->lawyer_bill_rt_model->get_galance_report_cma_instu_all();
        $sl=0;
        foreach ($result_lawyer_all as $key) 
        {
        	$sl++;
        	if($key->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
	          {
	            $loan_ac = $this->Common_model->stringEncryption('decrypt',$key->org_loan_ac);
	          }
	          else
	          {
	            $loan_ac = $key->loan_ac;
	          }
        	$objPHPExcel->getActiveSheet()->fromArray(array(
				$sl,
				$loan_ac,
				$key->ac_name,
				$key->approve_date,
				$key->type_of_case,
				$key->st_belance,
				$key->st_belance_dt,
				$key->deliver_dt,
				$key->legal_ack_dt,
				$key->ack_by,
				$key->ack_pin,
				$key->deliver_year,
				$key->territory_name,
				$key->recovery_district,
				$key->recovery_region_name,
				$key->district_name,
				$key->legal_region_name,
				$key->segment_name,
				),NULL,'A'.$rowNumber);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':R'.$rowNumber)->applyFromArray($styleThinBlackBorderOutline);
			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
			$rowNumber++;
        }
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="bill_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}

	public function tbs_dynamic_column_practice()
	{
		include_once('tbs/clas/tbs_class.php'); 
		include_once('tbs/clas/tbs_plugin_opentbs.php'); 
		// Data From Database 
		$TBS = new clsTinyButStrong; 
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 

		// $TBS->PlugIn(OPENTBS_SELECT_SHEET, "Acc wise Lawyers bill"); 
		$template = 'Lawyer_Bill_Report_Template/dynamic_column.xlsx';
		$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
		$data = array();
		$cl_array = array("Misc & Expense","ddd","dddt");
		$data[] = array('loan_ac'=>'Sandra','ac_name'=>'Hill','email_Misc & Expense'=>'sh@tbs.com',  'email_ddd'=>'sandra@tbs.com',  'email_dddt'=>'s.hill@tbs.com','date'=>'a-a-a'); 
		$data[] = array('loan_ac'=>'Sandra1','ac_name'=>'Hill','email_Misc & Expense'=>'sh@tbs.com',  'email_ddd'=>'sandra@tbs.com',  'email_dddt'=>'s.hill@tbs.com','date'=>'b-b-b'); 
		$data[] = array('loan_ac'=>'Sandra2','ac_name'=>'Hill','email_Misc & Expense'=>'sh@tbs.com',  'email_ddd'=>'sandra@tbs.com',  'email_dddt'=>'s.hill@tbs.com','date'=>'c-c-c'); 
		$TBS->MergeBlock('dc1,dc2', $cl_array);
		$TBS->MergeBlock('a', $data); 
		$save_as='';
		$path='tbs/loan_LN_rslt/';
		$filename =	'acc_wise_Lawyer_bill.xlsx';
		$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
		echo $TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT);
		exit;
		$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
		exit;
	}
}