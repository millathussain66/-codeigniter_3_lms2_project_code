<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Case_against_bank extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Case_against_bank_model', '', TRUE);
		$this->load->model('Legal_file_process_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
		$this->load->model('Appeal_bail_money_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat,$menu_link=null,$submenu=null)
	{
		$add_edit='';$id="";
		$data = array(
			'add_edit' => $add_edit,
			'submenu' => $submenu,
			'menu_link' => $menu_link,
			'id' => $id,
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'request_from'=>$this->Appeal_bail_money_model->select_where('ref_expense_type','data_status=1 AND id IN (1,5)','name,id'),
			'district'=>$this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1'),
			'user_group'=>$this->Appeal_bail_money_model->select_where('user_group','data_status=1 AND id IN (1,2,3,4)','group_name,id'),
			'sys_config'=> $this->User_info_model->upr_config_row(),
			'expense_type' => $this->User_model->get_parameter_data('ref_expense_type','name','data_status = 1 AND id IN(1)'),
			'final_remarks' =>$this->User_model->get_parameter_data('ref_final_remarks','name','data_status = 1'),
			'case_sts' => $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
			'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status=1'),
            'case_type'=>$this->User_model->get_parameter_data('ref_case_type','name','data_status=1'),
            'suit_name'=>$this->User_model->get_parameter_data('ref_suit_name','name','data_status=1'),
	   		'per_page' => $this->config->item('per_pagess')
		   );
		if($submenu=='case_details'){
			$result =$this->Case_against_bank_model->get_all_cases();
			$data['result']=$result;
			$data['pages']='case_against_bank/pages/case_details_grid';
		}elseif($submenu=='case_status_update'){
			$data['pages']='case_against_bank/pages/case_status_update';
		}elseif($submenu=='billing'){
			$data['pages']='case_against_bank/pages/bill_grid';
		}else{
			$data['pages']='case_against_bank/pages/grid';
		}
		$this->load->view('grid_layout',$data);
	}
	function get_case_details_result()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$result =$this->Case_against_bank_model->get_all_cases();
		$str_html="";
		if(!empty($result))
		{
			$sl=0;
			foreach ($result as $key) 
			{
				$sl++;
				$str_html.='<tr>
                    <td style="text-align:center"><div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('.$key->id.')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>
                    <td style="text-align:center;word-wrap: break-word;">'.$sl.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->loan_ac.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->ac_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->requisition_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->filling_date.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_number.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->prev_date.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_prev_dt.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->next_date.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_sts_next_dt.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_history.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->case_deal_officer.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->lawyer_name.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->district.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->final_remarks.'</td>
                    <td style="text-align:center;word-wrap: break-word;">'.$key->total_legal_cost.'</td>
                </tr>';
			}
			
		}
		else
		{
			$str_html="<tr><td colspan='16' align='center'>No Data Found!!!</td></tr>";
		}
		echo $str_html."####".$csrf_token;
	}
	function get_case_details_info()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str='';
		$expense = array();
		$suit_file_details=$this->Case_against_bank_model->get_case_details_info($this->input->post('id'));
    	$expense = $this->Case_against_bank_model->get_all_expense_by_case($this->input->post('id'),$suit_file_details->req_type);
        $status_history = $this->Case_against_bank_model->get_case_status_history($this->input->post('id'));
        if (!empty($suit_file_details)) 
    	{
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
                                        <td width="40%" style="font-weight: bold;">Filling Plaintiff</td>
                                        <td width="60%" >'.$suit_file_details->filling_plaintiff.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Filling Plaintiff Pin</td>
                                        <td width="60%" >'.$suit_file_details->filling_plaintiff_pin.'</td>
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
                                        <td width="40%" style="font-weight: bold;">Previous Case Date</td>
                                        <td width="60%" >'.$suit_file_details->prev_date.'</td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Case Status</td>
                                        <td width="60%" >'.$suit_file_details->case_sts_prev_dt.'</td>
                                    </tr> 
                                               
                                </table>
                            </td>

                            <td width="50%" style="display:contents;">
                                <table style="width: 100%;">
                                     <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Date Activities</td>
                                        <td width="60%" ></td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Previous Date Case Status Remarks</td>
                                        <td width="60%" ></td>
                                    </tr>  
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Next Date</td>
                                        <td width="60%" ></td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">Next Case Status</td>
                                        <td width="60%" ></td>
                                    </tr> 
                                    <tr>
                                        <td width="40%" style="font-weight: bold;">District</td>
                                        <td width="60%" >'.$suit_file_details->district_name.'</td>
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
                        $total = 0;
                        $count=count($expense);
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
	function make_xl()
	{
		$str_where = "1";
        $limit="";



           if (isset($_POST['search_field_input'])) {
            if (trim($this->input->post('search_field_input')) != '') {
                $str_where .= " AND s.loan_ac LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.org_loan_ac LIKE'%" .$this->Common_model->stringEncryption('encrypt',$this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.case_name LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.case_number LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.territory LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.ac_name LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
            }
        }




        $condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $str_where .=" AND (";
        }
        if (check_group('1'))
        {
            array_push($condition_array,"s.district IN(".$this->session->userdata['ast_user']['legal_district'].")");
        }
        if (check_group('2'))
        {
            array_push($condition_array,"s.case_deal_officer='".$this->session->userdata['ast_user']['user_id']."'");
        }
        if(check_group('1') || check_group('2'))
        {
            $str_where .=implode(" OR ",$condition_array);
            $str_where .=") ";
        }
        if ($_POST['proposed_type']!='null' && $_POST['proposed_type']!=0 && $_POST['proposed_type']!='') {
            if ($_POST['proposed_type']=='Loan') {
                $str_where.= " AND s.loan_ac='".$_POST['loan_ac']."'";
            }else if($_POST['proposed_type']=='Card')
            {
                $str_where.= " AND s.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$_POST['hidden_loan_ac'])."'";
            }
        }
        if ($_POST['req_type']!='' && $_POST['req_type']!=0) {
            $str_where.= " AND s.req_type='".$_POST['req_type']."'";
        }
        if ($_POST['district']!='' && $_POST['district']!=0) {
            $str_where.= " AND s.district='".$_POST['district']."'";
        }
        if($_POST['case_number']!='')
        {
            $str_where.= " AND s.case_number='".$_POST['case_number']."'";
        }
        if(isset($_POST['limit']))
        {
            if (trim($this->input->post('limit')) != '' && trim($this->input->post('limit')) != 'All') {
                $limit.= " LIMIT ".trim($this->input->post('limit'));
            }
        }
        if($this->input->post("next_date") != ''){$next_date= $this->input->post("next_date");} else{$next_date = '0';}
        if($this->input->post("filling_dt_from") != ''){$filling_dt_from= $this->input->post("filling_dt_from");} else{$filling_dt_from = '0';}
        if($this->input->post("filling_dt_to") != ''){$filling_dt_to= $this->input->post("filling_dt_to");} else{$filling_dt_to = '0';}
        if($filling_dt_from != '0'){$filling_dt_from = implode('-',array_reverse(explode('/',$filling_dt_from))); }
        else{$filling_dt_from='0';}
        if($filling_dt_to != '0'){ $filling_dt_to= implode('-',array_reverse(explode('/',$filling_dt_to))); }
        else{$filling_dt_to='0';}

        if( $filling_dt_from!='0' && $filling_dt_to=='0')
        { $str_where.= " and s.filling_date='".$filling_dt_from."'"; }
        

        if( $next_date!='0')
        { $str_where.= " and s.next_date='".$next_date."'"; }

        if( $filling_dt_from!='0' && $filling_dt_to!='0')
        { $str_where.= " and s.filling_date between '".$filling_dt_from."' and '".$filling_dt_to."'";}
    
        $str=" SELECT s.id,fr.name as final_remarks,s.case_number,csn.name as case_sts_next_dt,s.loan_ac,s.ac_name,r.name as requisition_name,cn.name as case_name,
        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,l.name as lawyer_name,CONCAT(cd.name,'(',cd.pin,')') as case_deal_officer,
        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,cs.name as case_sts_prev_dt,d.name as district,
        IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d-%b-%y'),s.next_date) AS next_date,s.case_history,
        s.remarks,co.total_cost as total_legal_cost
            FROM case_against_bank as s
            LEFT OUTER JOIN ref_case_type r ON (r.id=s.req_type)
            LEFT OUTER JOIN ref_suit_name cn ON (cn.id=s.case_name)
            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
            LEFT OUTER JOIN ref_case_sts csn ON (csn.id=s.case_sts_next_dt)
            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
            LEFT OUTER JOIN(
                SELECT cost.case_number,cost.loan_ac,cost.district,cost.org_loan_ac,SUM(cost.amount) AS total_cost FROM cost_details cost GROUP BY cost.case_number,cost.district,cost.loan_ac,cost.org_loan_ac
            )co ON(co.case_number=s.case_number AND s.district=co.district AND s.loan_ac=co.loan_ac AND s.org_loan_ac=co.org_loan_ac)
            WHERE $str_where AND s.sts<>0 AND (s.suit_sts=51 OR s.suit_sts=76 OR s.suit_sts=81)   ORDER BY s.id ASC $limit";
            $query=$this->db->query($str);
            $result = $query->result();

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
	        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25);

			$rowNumber = 1;
			$headings1 = array('Case Details Report');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':P'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':P'.$rowNumber)->getFont()->setSize(16);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	       	$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':P'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;

	        $rowNumber++;  
	        $headings4 = array('Sl No','A/C Number','A/C Name',
	    		'3 Type of case',
	        	'Type Of Case','Filling Date','Case Number','Previous Date',
                'Case Status On The Previous','Next Date','Case Status Next Date','Background /Case history',
                'Dealing Officer','Lawyer',
                'District','Final Remarks','Legal Cost');//,strtotime($dealdate)));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':P'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':P'.$rowNumber)->getFont()->setBold(true);	
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':P'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F28A8C')));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;   
	        $sl = 0;
	        foreach($result as $key)
			{
				$sl++;
				$objPHPExcel->getActiveSheet()->fromArray(array(
					$sl,
					$key->loan_ac,
					$key->ac_name,
					$key->requisition_name,
					$key->case_name,
					$key->filling_date,
					$key->case_number,
					$key->prev_date,
					$key->case_sts_prev_dt,
                    $key->next_date,
                    $key->case_sts_next_dt,
                    $key->case_history,
                    $key->case_deal_officer,
                    $key->lawyer_name,
					$key->district,
					$key->final_remarks,
                    $key->total_legal_cost
					),NULL,'A'.$rowNumber);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':P'.$rowNumber)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':P'.$rowNumber)->applyFromArray($styleArray_border);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $key->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
                $rowNumber++;
			}
			

		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle('Case Details Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="case_details_report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}
	function grid()
	{
		$this->load->model('Case_against_bank_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Case_against_bank_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function bill_grid()
	{
		$this->load->model('Case_against_bank_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Case_against_bank_model->get_grid_data_bill($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function search_suit_for_status()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str_where = "c.sts<>0 AND c.suit_sts=51 AND c.final_remarks=1";
		if (trim($this->input->post('proposed_type')) != '') {
			if (trim($this->input->post('proposed_type'))=='Loan') {
				$str_where.= " AND c.loan_ac='".trim($this->input->post('loan_ac'))."'";
			}else
			{
				$str_where.= " AND c.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
			}
		}
		if (trim($this->input->post('req_type')) != '') {
			$str_where.= " AND c.req_type='".trim($this->input->post('req_type'))."'";
		}
		if (trim($this->input->post('case_number')) != '') {
			$str_where.= " AND c.case_number LIKE '%".trim($this->input->post('case_number'))."%'";
		}
        if (check_group('20'))
        {
            $str_where .=" AND c.case_deal_officer='".$this->session->userdata['ast_user']['user_id']."'";
        }
		$suit_row = $this->db->query("SELECT r.name as req_type,c.case_number,c.id,c.loan_ac,c.ac_name
			FROM case_against_bank as c 
			LEFT OUTER JOIN ref_case_type r on(c.req_type=r.id)
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
	function get_bill_info(){
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$rows = $this->Case_against_bank_model->get_add_action_data($id);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}
	function case_sts_grid()
	{
		$this->load->model('Case_against_bank_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Case_against_bank_model->get_grid_data_case_sts($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function get_filing_info()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$suit_id = $this->input->post('id');
		$suit_info =$this->Case_against_bank_model->get_suit_info($suit_id);
		if (!empty($suit_info)) {
			$Message='ok';
		}
		else{
			$Message='No Data';
		}
		$var['csrf_token']=$csrf_token;
		$var['suit_info']=$suit_info;
		$var['Message']=$Message;
		echo json_encode($var);
	}
	function get_filing_info_edit()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$suit_info =$this->Case_against_bank_model->get_add_action_data($id);
		if (!empty($suit_info)) {
			$Message='ok';
		}
		else{
			$Message='No Data';
		}
		$var['csrf_token']=$csrf_token;
		$var['suit_info']=$suit_info;
		$var['Message']=$Message;
		echo json_encode($var);
	}
	function search_ac()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str_where = "c.sts<>0 AND (c.suit_sts=75 OR c.suit_sts=76)";
		if (trim($this->input->post('proposed_type')) != '') {
			if (trim($this->input->post('proposed_type'))=='Loan') {
				$str_where.= " AND c.loan_ac='".trim($this->input->post('loan_ac'))."'";
			}else
			{
				$str_where.= " AND c.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
			}
		}
		if (trim($this->input->post('req_type')) != '') {
			$str_where.= " AND c.req_type='".trim($this->input->post('req_type'))."'";
		}
		if (trim($this->input->post('case_number')) != '') {
			$str_where.= " AND c.case_number='".trim($this->input->post('case_number'))."'";
		}
        if (trim($this->input->post('ac_name')) != '') {
            $str_where.= " AND c.ac_name LIKE'%".trim($this->input->post('ac_name'))."%'";
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
	function add_edit_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Case_against_bank_model->add_edit_action();
		}
		else{
			$text[]="Session out, login required";
		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Case_against_bank_model->get_add_action_data($id);
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

	function delete_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Case_against_bank_model->delete_action();
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
			else{$row=$this->Legal_file_process_model->get_add_action_data($id);}
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
		$sah=$this->Case_against_bank_model->get_r_history($this->input->post('id'),$this->input->post('life_cycle'));
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
	function r_history_case_sts()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$sah=$this->Case_against_bank_model->get_r_history($this->input->post('id'),$this->input->post('life_cycle'));
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
	function suit_file_details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str='';
		$expense = array();
		$suit_file_details=$this->Case_against_bank_model->get_suit_file_details($this->input->post('id'));
	    	if (!empty($suit_file_details)) 
	    	{
	    		if ($suit_file_details->proposed_type=='Loan') 
	    		{
	    			$no_tag="Loan A/C";
	    			$nam_tag="Loan A/C Name";
	    		}
	    		else
	    		{
	    			$no_tag="Card";
	    			$nam_tag="Name on Card";
	    		}
	    		$str .='<table style="width: 100%;" id="preview_table">
					<thead></thead>
					<tbody id="details_body">
						
						<tr>
							<td width="50%" align="left"><strong>Case Type:</strong>'.$suit_file_details->req_type.'</td>
							<td width="50%" align="left"><strong>Proposed Type:</strong> '.$suit_file_details->proposed_type.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>'.$nam_tag.':</strong>'.$suit_file_details->ac_name.'</td>
							<td width="50%" align="left"><strong>'.$no_tag.'No.:</strong> '.$suit_file_details->loan_ac.'</td>
							
						</tr>
                        <tr>
                            <td width="50%" align="left"><strong>Background /Case history:</strong>'.$suit_file_details->case_history.'</td>
                            <td width="50%" align="left"><strong>Complaint name:</strong> '.$suit_file_details->complaint_name.'</td>
                            
                        </tr>
						<tr>
							<td width="50%" align="left"><strong>Name Of Defendant/Accused:</strong>'.$suit_file_details->defendant_name.'</td>
							<td width="50%" align="left"><strong>Branch (SOL):</strong> '.$suit_file_details->branch_sol.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Filling Date:</strong>'.$suit_file_details->filling_date.'</td>
							<td width="50%" align="left"><strong>Case Number:</strong>'.$suit_file_details->case_number.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>District:</strong>'.$suit_file_details->district.'</td>
							<td width="50%" align="left"><strong>Background /Case history:</strong>'.$suit_file_details->case_history.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Name:</strong>'.$suit_file_details->case_name.'</td>
							<td width="50%" align="left"><strong>Case Section:</strong>'.$suit_file_details->case_section.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Current Case Status:</strong> '.$suit_file_details->case_sts.'</td>
							<td width="50%" align="left"><strong>Case Dealing Officer:</strong>'.$suit_file_details->filling_plaintiff.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Present Lawyer Name:</strong>'.$suit_file_details->prest_lawyer_name.'</td>
							<td width="50%" align="left"><strong>Present Name Of The Court:</strong>'.$suit_file_details->prest_court_name.'</td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Retail Branch (If any):</strong>'.$suit_file_details->retail_branch.'</td>
							<td width="50%" align="left"><strong>Remarks:</strong>'.$suit_file_details->remarks.'</td>

						</tr>';
						$str.='</tbody>
					</table>';
			}
	    	$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	}
	function verify($id=NULL,$editrow=NULL)
	{
		//echo $id;exit;
		$result=$this->Case_against_bank_model->get_suit_file_details($id);
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'id' => $id,
				   'pages'=> 'case_against_bank/pages/form_verify',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('user_info/form_layout',$data);
	}
	function add_edit_case_sts()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Case_against_bank_model->add_edit_case_sts();
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
	function get_add_info_case_sts()
	{
        $this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$details=array();
		$id = $this->input->post('id');
		$row_info =$this->Case_against_bank_model->get_add_action_data_suit($id);
		if (!empty($row_info)) {
			$Message='ok';
		}
		else{
			$Message='No Data';
		}
		$req_type = 1;//$row_info->req_type;
		$district = $row_info->district;
		$pre_case_sts = $this->Case_against_bank_model->get_pre_case_sts($id);
		$status_history = $this->Case_against_bank_model->get_case_status_history($id);
		$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_case_against_bank','name','data_status = 1');
		$lawyer =$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1 AND district="'.$row_info->district.'"');
        $court =$this->User_model->get_parameter_data('ref_court','name','data_status = 1 AND district="'.$row_info->district.'"');
		$district_list =$this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1');
		$plaintiff =array();//$this->User_model->get_parameter_data('users_info','name','data_status = 1  AND admin_status<>2 AND user_group_id IN(1,2) AND block_status = 0');
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row_info;
		$var['id']=$id;
		$var['req_type']=$req_type;
        $var['court']=$court;
		$var['lawyer']=$lawyer;
		$var['plaintiff']=$plaintiff;
		$var['district_list']=$district_list;
		$var['district']=$district;
		$var['expense_activities']=$expense_activities;
		$var['pre_case_sts']=$pre_case_sts;
		$var['Message']=$Message;
		$var['status_history']=$status_history;
		echo json_encode($var);
	}
	function get_edit_info_case_sts()
	{
        $this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$details=array();
		$id = $this->input->post('id');
		$expense_data = $this->Case_against_bank_model->get_expense_data($id);
		$result = $this->Case_against_bank_model->get_add_action_data_case_sts($id);
		$row_info =$this->Case_against_bank_model->get_add_action_data_suit($result->file_id);
		if (!empty($row_info)) {
			$Message='ok';
		}
		else{
			$Message='No Data';
		}
		$req_type = $row_info->req_type;
		$district = $row_info->district;
		$pre_case_sts = $this->Case_against_bank_model->get_pre_case_sts($result->file_id);
		$status_history = $this->Case_against_bank_model->get_case_status_history($result->file_id);
		$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_case_against_bank','name','data_status = 1');
		$lawyer =$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1 AND district="'.$row_info->district.'"');
        $court =$this->User_model->get_parameter_data('ref_court','name','data_status = 1 AND district="'.$row_info->district.'"');
		$district_list =$this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1');
		$plaintiff =array();//$this->User_model->get_parameter_data('users_info','name','data_status = 1  AND admin_status<>2 AND user_group_id IN(1,2) AND block_status = 0');
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row_info;
		$var['id']=$id;
		$var['req_type']=$req_type;
        $var['court']=$court;
		$var['lawyer']=$lawyer;
		$var['plaintiff']=$plaintiff;
		$var['district_list']=$district_list;
		$var['district']=$district;
		$var['result']=$result;
		$var['expense_data']=$expense_data;
		$var['expense_activities']=$expense_activities;
		$var['pre_case_sts']=$pre_case_sts;
		$var['Message']=$Message;
		$var['status_history']=$status_history;
		echo json_encode($var);
	}
	function delete_action_case_sts()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Case_against_bank_model->delete_action_case_sts();
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
			else{$row=$this->Case_against_bank_model->get_add_action_data_case_sts($id);}
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
	function details_case_sts()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Case_against_bank_model->get_details_case_sts($this->input->post('id'));
		$prev_str = '';
		$new_str = '';
		$expense = $this->Case_against_bank_model->get_expense_details($this->input->post('id'),$details->req_type);
		$status_history = $this->Case_against_bank_model->get_case_status_history($details->file_id);
		if ($details->back_case_status==1) {
			$style_color='style="color:red"';
		}else
		{
			$style_color='';
		}
		if ($details->new_lawyer_name!='') {
			$l_style='style="color:red"';
            if ($details->noc_file!='' && $details->noc_file!=NULL) {
                $noc_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/noc_file/'.$details->noc_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$noc_file="";}
		}else
		{
			$l_style='';
            $noc_file="";
		}
		if ($details->new_court_name!='') {
			$c_style='style="color:red"';
		}else
		{
			$c_style='';
		}
		if ($details->new_plaintiff_name!='') {
			$p_style='style="color:red"';
		}else
		{
			$p_style='';
		}
		if ($details->new_district_name!='') {
			$d_style='style="color:red"';
		}else
		{
			$d_style='';
		}
    	if (!empty($details)) 
    	{
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
    				<tr>
						<td width="50%" align="left"><strong>Loan AC.:</strong>'.$details->loan_ac.'</td>
						<td width="50%" align="left"><strong>AC Name:</strong>'.$details->ac_name.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Previous Case Status:</strong>'.$details->prev_case_sts.'</td>
						<td width="50%" align="left"><strong>New Case Date:</strong>'.$details->case_dt.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left" '.$style_color.'><strong>New Case Status:</strong>'.$details->case_sts.'</td>
						<td width="50%" align="left"><strong>Next Case Date:</strong>'.$details->next_case_dt.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Next Date Purpose:</strong>'.$details->next_date_purpose.'</td>
						<td width="50%" align="left"><strong>Remarks:</strong> '.$details->remarks.'</td>
					</tr>
					<tr>
						<td width="50%" align="left" '.$l_style.'><strong>New Lawyer:</strong>'.$details->new_lawyer_name.' NOC File:'.$noc_file.'</td>
						<td width="50%" align="left" '.$c_style.'><strong>Next Court:</strong>'.$details->new_court_name.'</td>
					</tr>
					<tr>
						<td width="50%" align="left" '.$p_style.'><strong>New Plaintiff:</strong>'.$details->new_plaintiff_name.'</td>
						<td width="50%" align="left" '.$d_style.'><strong>Next District:</strong>'.$details->new_district_name.'</td>
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
    	if (!empty($expense)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Expense Info</span>
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
                    if($key->proxy_sts==1)
                    {
                        $proxy_style='style="color:red"';
                        $text = '(Proxy)';
                    }
                    else
                    {
                        $proxy_style='"';
                        $text = '';
                    }
					$str.='<tr>';
						$str.='<td align="center">'.$key->expense_type_name.'</td>';
						$str.='<td align="left" '.$proxy_style.'>'.$key->vendor_name.' '.$text.'</td>';
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
    	if (!empty($status_history)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;overflow-x:hidden;height:250px">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Case Status History</span>
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
						$style_color='style="color:red"';
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
			</div>';

    	}
	    	
    	$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function bulk_operation($operation=NULL)
	{
		$operation_name='';
		if ($operation=='apv') 
		{
			$operation_name='Approve';
		}
		$data = array( 	
			   'operation' => $operation,
			   'operation_name' => $operation_name,
			   'pages'=> 'case_against_bank/pages/bulk_operation',		   
			   );
		$this->load->view('case_against_bank/form_layout',$data);
	}
	function load_bulk_data()
	{
		$this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
	    $grid_data=$this->Case_against_bank_model->get_bulk_data();
	    $operation= $this->input->post('operation');
		$str='';
		$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
		<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<thead>
				<th width="2%"><input style="margin-left:7px" type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
				<th width="3%"  style="font-weight: bold;text-align:center">P</th>
				<th width="15%" style="font-weight: bold;text-align:left">Loan AC</th>
				<th width="20%" style="font-weight: bold;text-align:left">AC Name</th>
				<th width="15%" style="font-weight: bold;text-align:left">Previous Case Status</th>
				<th width="15%" style="font-weight: bold;text-align:left">New Case Status</th>
				<th width="20%" style="font-weight: bold;text-align:left">Remarks</th>
			</thead>
			<tbody>';	
	
		if(count($grid_data)<=0)
		{
			$str.='<tr><td colspan="7" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
			$str.='<input type="hidden" name="event_counter" id="event_counter" value="0">';
			$str.='</tbody></table></div>';
		}
		else{
			$i=1;
			foreach ($grid_data as $data) {
				if ($data->back_case_status==1) {
					$style_color='style="color:red"';
				}else
				{
					$style_color='';
				}
				$str.='<tr>';
				$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$data->id.'"><input type="hidden" name="suit_file_id_'.$i.'" id="suit_file_id_'.$i.'" value="'.$data->file_id.'"></td>';
				$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
				$str.='<td align="left">'.$data->loan_ac.'</td>';
				$str.='<td align="left">'.$data->ac_name.'</td>';
				$str.='<td align="left">'.$data->prev_case_sts.'</td>';
				$str.='<td align="left" '.$style_color.' >'.$data->case_sts.'</td>';
				$str.='<td align="left">'.$data->remarks.'</td>';
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
			$id = $this->Case_against_bank_model->bulk_acktion();
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
?>
