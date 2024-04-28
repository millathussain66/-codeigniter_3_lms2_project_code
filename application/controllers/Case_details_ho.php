<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Case_details_ho extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Legal_file_process_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('Legal_status_expense_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'pages'=> 'case_details_ho/pages/case_details_grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function get_case_details_result()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$result =$this->Legal_file_process_model->get_all_cases();
		$str_html="";
		$total_legal_cost = 0;
		if(!empty($result))
		{
			$sl=0;
			foreach ($result as $key) 
			{
				if($key->sts==0)//when case was merged
				{
					//$merged_amount_array[$key->merged_with] = $key->total_legal_cost;
                    if(isset($merged_amount_array[$key->id]))
                    {
                        //$total_legal_cost = $key->total_legal_cost+$merged_amount_array[$key->id];
                        $merged_amount_array[$key->merged_with] = $key->total_legal_cost+$merged_amount_array[$key->id];
                    }
                    else
                    {
                        $merged_amount_array[$key->merged_with] = $key->total_legal_cost;
                    }
                    continue;
				}
				if(isset($merged_amount_array[$key->id]))
				{
					$total_legal_cost = $key->total_legal_cost+$merged_amount_array[$key->id];
				}
				else
				{
					$total_legal_cost = $key->total_legal_cost;
				}
                $loan_ac = $key->loan_ac;
				$sl++;
				$str_html.='<tr>
                    <td style="text-align:center"><div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('.$key->id.')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->proposed_type.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$loan_ac.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_filling_date.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_claim_amount.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->last_date.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->last_step.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->act_prev_date.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date_sts.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->remarks_prev_date.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_plaintiff.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->present_plaintiff.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_deal_officer.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_deal_officer_phone.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_court_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->prest_court_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->territory.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_segment.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->legal_region.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$total_legal_cost.'</td>
                </tr>';
			}
			
		}
		else
		{
			$str_html="<tr><td colspan='17' align='center'>No Data Found!!!</td></tr>";
		}
		echo $str_html."####".$csrf_token;
	}
	function get_case_details_info()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str='';
		$expense = array();
		$suit_file_details=$this->Legal_file_process_model->get_case_details_info($this->input->post('id'));
    	$expense = $this->Legal_file_process_model->get_all_expense_by_case($this->input->post('id'),$suit_file_details->req_type,$suit_file_details->cma_id);
		$status_history = $this->Legal_status_expense_model->get_case_status_history($this->input->post('id'));
    	if (!empty($suit_file_details)) 
    	{
            //Final Legal Notice Copy
            $legal_notice_copy = $this->db->query("SELECT c.final_ln
            FROM cma as c 
            WHERE c.id='".$suit_file_details->cma_id."' LIMIT 1")->row();
            if (!empty($legal_notice_copy) && $legal_notice_copy->final_ln!='') {
                $final_ln='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/ln_scan_copy/'.$legal_notice_copy->final_ln.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$final_ln="";}

            //judgement copy
            $judgement_copy = $this->db->query("SELECT c.optional_attachment
            FROM change_request as c 
            WHERE c.sts<>0 AND c.case_sts=15 AND c.change_type=1 AND c.sts=51 AND c.suit_file_id='".$this->input->post('id')."' LIMIT 1")->row();
            if (!empty($judgement_copy) && $judgement_copy->optional_attachment!='') {
                $judgement_attachment='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/optional_attachment/'.$judgement_copy->optional_attachment.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$judgement_attachment="";}

            //Warrent copy
            $warrent_copy = $this->db->query("SELECT c.optional_attachment
            FROM change_request as c 
            WHERE c.sts<>0 AND c.case_sts=29 AND c.change_type=1 AND c.sts=51 AND c.suit_file_id='".$this->input->post('id')."' LIMIT 1")->row();
            if (!empty($warrent_copy) && $warrent_copy->optional_attachment!='') {
                $warrent_attachment='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/optional_attachment/'.$warrent_copy->optional_attachment.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$warrent_attachment="";}

            if ($suit_file_details->arji_copy!='') {
                $arji_copy='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/arji_copy/'.$suit_file_details->arji_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$arji_copy="";}
    		$Message='ok';
    		$str .='<table style="width: 100%;">
				<thead></thead>
				<tbody id="details_body">
                        <tr>
                            <td width="50%">
                                <table style="width: 100%;">
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">AC No./Card No.</td>
                                        <td width="60%" >'.$suit_file_details->loan_ac.'</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Account Name</td>
                                        <td width="60%" >'.$suit_file_details->ac_name.'</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Type Of Case</td>
                                        <td width="60%" >'.$suit_file_details->case_type.'</td>
                                    </tr>
                                     <tr>
                                        <td width="40%" style="font-weight: bold;">Type Of Case Name</td>
                                        <td width="60%" >'.$suit_file_details->case_name.'</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Filling Date</td>
                                        <td width="60%" >'.$suit_file_details->filling_date.'</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Case Number</td>
                                        <td width="60%" >'.$suit_file_details->case_number.'</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Case Claim Amount</td>
                                        <td width="60%" >'.$suit_file_details->case_claim_amount.'</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Outstanding Amount</td>
                                        <td width="60%" >'.$suit_file_details->outstanding_bl.'</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Filling Plaintiff</td>
                                        <td width="60%" >'.$suit_file_details->filling_plaintiff.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Filling Plaintiff Pin</td>
                                        <td width="60%" >'.$suit_file_details->filling_plaintiff_pin.'</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Case Dealing Officer</td>
                                        <td width="60%" >'.$suit_file_details->case_deal_officer.'</td>
                                    </tr>     
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Case Dealing Officer Pin</td>
                                        <td width="60%" >'.$suit_file_details->case_deal_officer_pin.'</td>
                                    </tr>   
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Dealing Officer Cell No.</td>
                                        <td width="60%" >'.$suit_file_details->case_deal_officer_phone.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Lawyer\'s Name</td>
                                        <td width="60%" >'.$suit_file_details->lawyer_name.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Court Name</td>
                                        <td width="60%" >'.$suit_file_details->prev_court_name.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Present Court Name</td>
                                        <td width="60%" >'.$suit_file_details->prest_court_name.'</td>
                                    </tr>     

                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Arji Copy</td>
                                        <td width="60%" >'.$arji_copy.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Legal Notice Copy</td>
                                        <td width="60%" >'.$final_ln.'</td>
                                    </tr>             
                                </table>
                            </td>

                            <td width="50%">
                                <table style="width: 100%;">
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Case Date</td>
                                        <td width="60%" >'.$suit_file_details->prev_date.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Case Status</td>
                                        <td width="60%" >'.$suit_file_details->case_sts_prev_dt.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Date Activities</td>
                                        <td width="60%" >'.$suit_file_details->act_prev_date.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Date Case Status Remarks</td>
                                        <td width="60%" >'.$suit_file_details->remarks_prev_date.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Next Date</td>
                                        <td width="60%" >'.$suit_file_details->next_date.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Next Case Status</td>
                                        <td width="60%" >'.$suit_file_details->next_date_case_sts.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Recovery AM</td>
                                        <td width="60%" >'.$suit_file_details->recovery_am.'</td>
                                    </tr>
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Unit Office</td>
                                        <td width="60%" >'.$suit_file_details->unit_office_name.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Recovery Territory</td>
                                        <td width="60%" >'.$suit_file_details->territory_name.'</td>
                                    </tr>    
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">District</td>
                                        <td width="60%" >'.$suit_file_details->district_name.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Legal Region</td>
                                        <td width="60%" >'.$suit_file_details->legal_region_name.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Protfolio</td>
                                        <td width="60%" >'.$suit_file_details->loan_segment.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Account Closing Date</td>
                                        <td width="60%" >'.$suit_file_details->ac_close_dt.'</td>
                                    </tr>  
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Final Case Status</td>
                                        <td width="60%" >'.$suit_file_details->final_case_sts.'</td>
                                    </tr>  
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Remarks</td>
                                        <td width="60%" >'.$suit_file_details->final_remarks.'</td>
                                    </tr>   
                                    
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Judgement Copy</td>
                                        <td width="60%" >'.$judgement_attachment.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Warrent Copy</td>
                                        <td width="60%" >'.$warrent_attachment.'</td>
                                    </tr>        
                                </table>
                            </td>
                        </tr>
                    </tbody>';
            $str.='</table>';

	        if (!empty($status_history)) 
	    	{
	    		$count=count($status_history);
	    		$height = $count>4?'height:250px':'';
	    		$str.='<br/><div>
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Case Status History</span>
					<div style="overflow-x:hidden;'.$height.'">
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Prev Case Status</td>
							<td width="10%" style="font-weight: bold;text-align:center">New Case Status</td>
							<td width="15%" style="font-weight: bold;text-align:center">Change By</td>
							<td width="15%" style="font-weight: bold;text-align:center">Change Date</td>
							<td width="15%" style="font-weight: bold;text-align:center">Next Case Date</td>
							<td width="15%" style="font-weight: bold;text-align:center">Next Date Purpose</td>
							<td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
					foreach ($status_history as $key) 
					{
						if ($key->back_case_status==1) {
							$style_color='style="color:red;"';
						}else
						{
							$style_color='';
						}
						$str.='<tr>';
							$str.='<td align="center">'.$key->prev_case_sts.'</td>';
							$str.='<td align="center" '.$style_color.'>'.$key->present_case_sts.'</td>';
							$str.='<td align="center">'.$key->e_by.'</td>';
							$str.='<td align="center">'.$key->e_dt.'</td>';
							$str.='<td align="center">'.$key->next_case_dt.'</td>';
							$str.='<td align="center">'.$key->next_dt_purpose.'</td>';
							$str.='<td align="center">'.$key->remarks.'</td>';
						$str.='</tr>';
					}

				$str.='</tbody>
					</table>
					</div>
				</div>';

	    	}
	    	if (!empty($expense)) 
	    	{
	    		$count=count($expense);
	    		$total = 0;
	    		$height = $count>4?'height:250px':'';
	    		$str.='<br/><div>
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Expense Info</span>
					<div style="overflow-x:hidden;'.$height.'">
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Vendor Type</td>
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
						$total = $total+$key->amount;
						$str.='<tr>';
							$str.='<td align="center">'.$key->expense_type_name.'</td>';
							$str.='<td align="left">'.$key->vendor_name.'</td>';
							$str.='<td align="left">'.$key->activities_name.'</td>';
							$str.='<td align="left">'.$key->activities_date.'</td>';
							$str.='<td align="left">'.$key->amount.'</td>';
							$str.='<td align="left">'.$key->expense_remarks.'</td>';
						$str.='</tr>';
					}
					$str.='<tr>';
							$str.='<td align="center" colspan="4">Total</td>';
							$str.='<td align="left">'.$total.'</td>';
							$str.='<td align="center"></td>';
					$str.='</tr>';
				$str.='</tbody>
					</table>
					</div>
				</div>';

	    	}
		}
		else
		{

		$Message='No Data';
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
