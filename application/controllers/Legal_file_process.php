<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Legal_file_process extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Legal_file_process_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('Cma_process_model', '', TRUE);
		$this->load->model('Cma_ho_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
		$this->load->model('Legal_status_expense_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{
		$this->Common_model->delete_tempfile();
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'ln_status' => $this->User_model->get_parameter_data('ref_ln_status','name','data_status = 1'),
					'branch' => $this->User_model->get_parameter_data('ref_branch_sol','name','data_status = 1'),					'bank' => $this->User_model->get_parameter_data('ref_bank','name','data_status = 1'),
					'pages'=> 'legal_file_process/pages/case_management_grid',
					'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function suit_file_view ($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{
		$cma_id=NULL;
		if (isset($_POST['grid_cma_id'])) {
			$cma_id = $_POST['grid_cma_id'];
		}
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'grid_cma_id'=> $cma_id,
					'sys_config'=> $this->User_info_model->upr_config_row(),
					'menu_links'=> $menu_links,
					'case_sts' => $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'pages'=> 'legal_file_process/pages/suit_file_grid',
					'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function recase_file_view($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
					'case_sts' => $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
					'sys_config'=> $this->User_info_model->upr_config_row(),
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'pages'=> 'legal_file_process/pages/recase_grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function case_details_view($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'pages'=> 'legal_file_process/pages/case_details_grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function get_case_details_result()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$result =$this->Legal_file_process_model->get_all_cases();
		$merged_amount_array = array();
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
	function make_xl()
	{
		$str_where = "1";

		if (isset($_POST['search_field_input'])) {
            if (trim($this->input->post('search_field_input')) != '') {

                $str_where .= " AND s.loan_ac LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.org_loan_ac LIKE'%" .$this->Common_model->stringEncryption('encrypt',$this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.cif LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.case_number LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.territory LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
                $str_where .= " OR s.case_claim_amount LIKE'%" . trim($this->input->post('search_field_input')) . "%'";
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
            array_push($condition_array,"s.legal_region IN(".$this->session->userdata['ast_user']['legal_region'].")");
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
        if ($_POST['proposed_type']!='') {
            if ($_POST['proposed_type']=='Loan') {
                $str_where.= " AND s.loan_ac='".$_POST['loan_ac']."'";
            }else if($_POST['proposed_type']=='Card')
            {
                $str_where.= " AND s.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$_POST['hidden_loan_ac'])."'";
            }
        }
        if ($_POST['req_type']!='' && $_POST['req_type']!=0) {
            $str_where.= " AND s.req_type=".$this->db->escape($_POST['req_type']);
        }
        if ($_POST['region']!='' && $_POST['region']!=0) {
            $str_where.= " AND s.legal_region=".$this->db->escape($_POST['region']);
        }
        if ($_POST['territory']!='' && $_POST['territory']!=0) {
            $str_where.= " AND s.territory=".$this->db->escape($_POST['territory']);
        }
        if ($_POST['district']!='' && $_POST['district']!=0) {
            $str_where.= " AND s.district=".$this->db->escape($_POST['district']);
        }
        if ($_POST['unit_office']!='' && $_POST['unit_office']!=0) {
            $str_where.= " AND s.unit_office=".$this->db->escape($_POST['unit_office']);
        }
        if ($_POST['loan_segment']!='' && $_POST['loan_segment']!=0) {
            $str_where.= " AND s.loan_segment=".$this->db->escape($_POST['loan_segment']);
        }
        if($_POST['case_number']!='')
        {
            $str_where.= " AND s.case_number=".$this->db->escape($_POST['case_number']);
        }
        if($_POST['cif']!='')
        {
            $str_where.= " AND s.cif=".$this->db->escape($_POST['cif']);
        }
        $limit="";
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
        { $str_where.= " and s.filling_date=".$this->db->escape($filling_dt_from); }
        if( $next_date!='0')
        { $str_where.= " and s.next_date='".$next_date."'"; }
        if( $filling_dt_from!='0' && $filling_dt_to!='0')
        { $str_where.= " and s.filling_date between ".$this->db->escape($filling_dt_from)." and ".$this->db->escape($filling_dt_to);}

    
        $str=" SELECT s.id,s.remarks,s.org_loan_ac,s.prev_filling_date,s.sts,s.merged_with,fr.name as final_remarks,s.remarks_prev_date,s.proposed_type,s.case_number,s.loan_ac,s.ac_name,r.name as requisition_name,IF(s.case_name IS NOT NULL,cn.name,r.type_of_case) as case_name,
        DATE_FORMAT(s.filling_date,'%d-%b-%y') AS filling_date,s.case_claim_amount,IF(s.next_dt_sts=1,DATE_FORMAT(s.next_date,'%d-%b-%y'),s.next_date) AS next_date,IF(s.next_dt_sts=1,ns.name,'') AS next_date_sts,
        DATE_FORMAT(s.prev_date,'%d-%b-%y') AS prev_date,DATE_FORMAT(s.last_date,'%d-%b-%y') AS last_date,last.name as last_step,cs.name as case_sts_prev_dt,d.name as district,IF(s.req_type=2,sca.name,scn.name) as act_prev_date,
        lr.name as legal_region,ls.name as loan_segment,s.remarks_next_date,IF(s.re_case_sts=1,co.total_cost,(IF(co.total_cost IS NOT NULL,co.total_cost,0)+IF(co3.total_cost IS NOT NULL,co3.total_cost,0)+IF(co2.total_cost IS NOT NULL,co2.total_cost,0))) as total_legal_cost,
        CONCAT(fp.name,' (',fp.pin,')')as filling_plaintiff,CONCAT(pp.name,' (',pp.pin,')')as present_plaintiff,ter.name as territory,
        CONCAT(cd.name,' (',cd.pin,')')as case_deal_officer,l.name as lawyer_name,prec.name as prev_court_name,presc.name as prest_court_name
            FROM suit_filling_info as s
            LEFT OUTER JOIN cma c ON (c.id=s.cma_id)
            LEFT OUTER JOIN ref_req_type r ON (r.id=s.req_type)
            LEFT OUTER JOIN ref_case_name cn ON (cn.id=s.case_name)
            LEFT OUTER JOIN ref_case_sts last ON (last.id=s.last_step)
            LEFT OUTER JOIN ref_case_sts cs ON (cs.id=s.case_sts_prev_dt)
            LEFT OUTER JOIN ref_case_sts ns ON (ns.id=s.case_sts_next_dt)
            LEFT OUTER JOIN ref_legal_district d ON (d.id=s.district)
            LEFT OUTER JOIN ref_legal_region lr ON (lr.id=s.legal_region)
            LEFT OUTER JOIN ref_final_remarks fr ON (fr.id=s.final_remarks)
            LEFT OUTER JOIN ref_loan_segment ls ON (ls.code=s.loan_segment)
            LEFT OUTER JOIN users_info fp ON (fp.id=s.filling_plaintiff)
            LEFT OUTER JOIN users_info pp ON (pp.id=s.present_plaintiff)
            LEFT OUTER JOIN users_info cd ON (cd.id=s.case_deal_officer)
            LEFT OUTER JOIN ref_lawyer l ON (l.id=s.prest_lawyer_name)
            LEFT OUTER JOIN ref_court prec ON (prec.id=s.prev_court_name)
            LEFT OUTER JOIN ref_court presc ON (presc.id=s.prest_court_name)
            LEFT OUTER JOIN ref_territory ter ON (ter.id=s.territory)
            LEFT OUTER JOIN ref_schedule_charges_ni as scn on (s.act_prev_date=scn.id AND s.req_type=1)
            LEFT OUTER JOIN ref_schedule_charges_ara as sca on (s.act_prev_date=sca.id AND s.req_type=2)
            LEFT OUTER JOIN(
                SELECT cost.case_number,cost.loan_ac,cost.district,cost.org_loan_ac,SUM(cost.amount) AS total_cost
                 FROM (SELECT c1.case_number,c1.loan_ac,c1.district,c1.org_loan_ac,c1.legal_cost AS amount
                    FROM legal_cost c1
                    UNION ALL 
                    SELECT c.case_number,c.loan_ac,c.district,c.org_loan_ac,c.amount
                    FROM cost_details c) cost 
                 GROUP BY cost.case_number,cost.district,cost.loan_ac,cost.org_loan_ac
            )co ON(co.case_number=s.case_number AND s.district=co.district AND s.loan_ac=co.loan_ac AND s.org_loan_ac=co.org_loan_ac)
            -- for legal notice bill
            LEFT OUTER JOIN( 
                SELECT cost.loan_ac,cost.req_type,cost.org_loan_ac,SUM(cost.amount) AS total_cost 
                FROM (
                    SELECT c.case_number,c.req_type,c.loan_ac,c.district,c.org_loan_ac,c.amount
                    FROM cost_details c
                    WHERE c.activities_id=1 AND c.vendor_type=1
                    ) cost 
                GROUP BY cost.loan_ac,cost.org_loan_ac,cost.req_type
            )co2 ON(s.loan_ac=co2.loan_ac AND s.org_loan_ac=co2.org_loan_ac AND s.req_type=co2.req_type)
            -- for Court Fee bill
            LEFT OUTER JOIN( 
                SELECT cost.loan_ac,cost.req_type,cost.org_loan_ac,SUM(cost.amount) AS total_cost 
                FROM (
                    SELECT c.case_number,c.req_type,c.loan_ac,c.district,c.org_loan_ac,c.amount
                    FROM cost_details c
                    WHERE c.activities_id=1 AND c.vendor_type=4 AND (c.case_number IS NULL OR c.case_number='')
                    ) cost 
                GROUP BY cost.loan_ac,cost.org_loan_ac,cost.req_type
            )co3 ON(s.loan_ac=co3.loan_ac AND s.org_loan_ac=co3.org_loan_ac AND s.req_type=co3.req_type)
            -- LEFT OUTER JOIN(
            --     SELECT f.cma_id,GROUP_CONCAT(IF(c.loan_ac<>f.ac_number,f.ac_number,NULL)  ORDER BY f.id ASC SEPARATOR ', ' ) AS other_ac
            --     FROM cma_facility f
            --     LEFT OUTER JOIN cma c ON(f.cma_id=c.id) 
            --     WHERE f.sts<>0 
            --     GROUP BY f.cma_id
            -- )oth_ac ON(c.id=oth_ac.cma_id)
            WHERE $str_where AND (s.sts=1 OR (s.sts=0 AND s.merged_sts=1)) AND (s.suit_sts=75 OR s.suit_sts=76 OR s.suit_sts=81)   ORDER BY s.id ASC $limit";
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
	        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(20);

			$rowNumber = 1;
			$headings1 = array('Case Details Report');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getFont()->setSize(16);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	       	$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;

	        $rowNumber++;  
	        $headings4 = array('Proposed Type','A/C Number','A/C Name',
	    		'3 Type of case',
	        	'Type Of Case','Prev Filling Date','Filling Date','Case Number',
	        'Case Claim Amount','Date Before Previous Date','Step Before Previous Step','Previous Date','Case Status On The Previous Date','Activities Taken On The Previous Date',
	        'Next Date','Case Status on the Next date','Remarks on Case Status on the Previous date',
	        'Filling Plaintiff','Present Plaintiff','Case Dealings  officer','Lawyer\'s Name',
	        'Previous Name Of The Court','Present Name Of The Court','District','Territory','Remarks','Protfolio','Legal Region','Final Remarks','Legal Cost');//,strtotime($dealdate)));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getFont()->setBold(true);	
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F28A8C')));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;   
	        $sl = 0;
	        $total_legal_cost = 0;
	        foreach($result as $key)
			{
				if($key->sts==0)//when case was merged
				{
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
				if($key->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
                  {
                    $loan_ac = $this->Common_model->stringEncryption('decrypt',$key->org_loan_ac);
                  }
                  else
                  {
                    $loan_ac = $key->loan_ac;
                  }
				$sl++;
				$objPHPExcel->getActiveSheet()->fromArray(array(
					$key->proposed_type,
					$loan_ac,
					$key->ac_name,
					$key->requisition_name,
					$key->case_name,
					$key->prev_filling_date,
					$key->filling_date,
					$key->case_number,
					$key->case_claim_amount,
					$key->last_date,
					$key->last_step,
					$key->prev_date,
					$key->case_sts_prev_dt,
					$key->act_prev_date,
					$key->next_date,
					$key->next_date_sts,
					$key->remarks_prev_date,
					$key->filling_plaintiff,
					$key->present_plaintiff,
					$key->case_deal_officer,
					$key->lawyer_name,
					$key->prev_court_name,
					$key->prest_court_name,
					$key->district,
					$key->territory,
					$key->remarks,
					$key->loan_segment,
					$key->legal_region,
					$key->final_remarks,
					$total_legal_cost
					),NULL,'A'.$rowNumber);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AD'.$rowNumber)->applyFromArray($styleArray_border);
				$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
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
	function case_management_grid()
	{
		$this->load->model('Legal_file_process_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Legal_file_process_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function suit_file_grid()
	{
		$this->load->model('Legal_file_process_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Legal_file_process_model->get_suit_file_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function recase_file_grid()
	{
		$this->load->model('Legal_file_process_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Legal_file_process_model->get_recase_file_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function search_ac()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str_where = "c.sts<>0";
		if (check_group('2')) //For Legal Maker
        {
            $str_where.=" and c.legal_user='".$this->session->userdata['ast_user']['user_id']."'";
        }
		if (trim($this->input->post('proposed_type')) != '') {
			if (trim($this->input->post('proposed_type'))=='Loan') {
				$str_where.= " AND c.loan_ac='".trim($this->input->post('loan_ac'))."'";
			}else
			{
				$str_where.= " AND c.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
			}
		}
		if (trim($this->input->post('req_type')) != '') {
			$str_where.= " AND c.req_type=".$this->db->escape(trim($this->input->post('req_type')));
		}
		$suit_row = $this->db->query("SELECT sub.* FROM(
			SELECT r.name as req_type,c.cma_sts,A.total_auth,c.id,c.loan_ac,c.ac_name,IF(c.ln_val_dt<='". date("Y-m-d") . "', '1', '0') as ln_exp_sts
			FROM cma as c 
			LEFT OUTER JOIN ref_req_type r on(c.req_type=r.id)
			LEFT OUTER JOIN (
				SELECT a.event_id,COUNT(a.id) AS total_auth FROM authorization AS a WHERE (a.authorization_type=8 OR a.authorization_type=1) AND a.event_name='cma' AND a.sts=1 AND a.auth_sts=67 GROUP BY a.event_id
			)A on(c.id=A.event_id)
			WHERE ".$str_where."
			)sub WHERE (sub.ln_exp_sts=1 AND sub.cma_sts=67) OR (sub.total_auth>0 AND sub.cma_sts!=64 AND sub.cma_sts!=65 AND sub.cma_sts!=75)")->result();
		$str_html="";
		$str_html.="<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>Select</strong></td>
			<td style='width:15%;border:1px solid #a0a0a0'><strong>Case Type</strong></td>
			<td style='width:27%;border:1px solid #a0a0a0'><strong>Loan AC</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>AC Name</strong></td>";
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
				</tr>";
				$sl++;
			}
			$str_html.="<input type='hidden' id='suitCount' value='".count($suit_row)."' />
				<tr><td colspan='5'></td></tr>
				<tr><td colspan='5' align='center'><button type='button' class='buttonStyle' style='background-color: rgb(24, 88, 145); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' onclick='load_filing_info()' id='next_button'>Next</button><span id=\"next_loading\" style=\"display:none\">Please wait... <img src=\"".base_url()."images/loader.gif\" align=\"bottom\"></span></td></tr>
			</table>";
		}
		else
		{
			$str_html.="<tr><td colspan='5' align='center'>No Result Found !!!</td></tr>";
		}
		echo $str_html."####".$csrf_token;
	}
	function search_recase_suit()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str_where = "c.sts<>0 AND (c.suit_sts=75 || c.suit_sts=76)";
		if (trim($this->input->post('proposed_type')) != '') {
			if (trim($this->input->post('proposed_type'))=='Loan') {
				$str_where.= " AND c.loan_ac='".trim($this->input->post('loan_ac'))."'";
			}else
			{
				$str_where.= " AND c.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac'))."'";
			}
		}
		if (trim($this->input->post('req_type')) != '') {
			$str_where.= " AND c.req_type=".$this->db->escape(trim($this->input->post('req_type')));
		}
		$suit_row = $this->db->query("SELECT r.name as req_type,c.final_remarks as final_remarks_id,fr.name as final_remarks,c.case_number,c.id,c.loan_ac,c.ac_name
			FROM suit_filling_info as c 
			LEFT OUTER JOIN ref_final_remarks fr on(fr.id=c.final_remarks)
			LEFT OUTER JOIN ref_req_type r on(c.req_type=r.id)
			WHERE ".$str_where."")->result();
		$str_html="";
		$str_html.="<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>Select</strong></td>
			<td style='width:15%;border:1px solid #a0a0a0'><strong>Case Type</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>Loan AC</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>AC Name</strong></td>
			<td style='width:10%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>
			<td style='width:10%;border:1px solid #a0a0a0'><strong>Final Remarks</strong></td>";

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
				<td style='border:1px solid #a0a0a0'><input type='hidden' id='case_close_sts_".$row->id."' name='case_close_sts_".$row->id."' value='".$row->final_remarks_id."'>".$row->final_remarks."</td>
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
	function get_filing_info_edit()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$package_info = array();
		$package_sts = 0;
		$row_info =$this->Legal_file_process_model->get_add_action_data_suit($id);
		$expense = $this->Legal_file_process_model->get_expenese_info($id);
		if (!empty($row_info)) {
			$Message='ok';
			$package_info = $this->db->query("SELECT h.*,h.id as history_id,c.id as package_id,c.case_number,c.loan_ac,IF(c.disbursed_amount IS NULL,0,c.disbursed_amount) as disbursed_amount,c.package_amount,l.name as lawyer_name
			FROM package_select_history as h 
			LEFT OUTER JOIN lawyer_package_bill_setup c on(h.package_id=c.id)
			LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
			WHERE h.event_id='".$row_info->id."' AND h.event_table_name='suit_filling_info' LIMIT 1")->row();
			if(!empty($package_info))
			{
				$package_sts = 1;
			}
		}
		else{
			$Message='No Data';
		}
		$case_name =$this->User_model->get_parameter_data('ref_case_name','name','data_status = 1 AND req_type="'.$row_info->req_type.'"');
		$plaintiff =$this->User_model->get_parameter_data('users_info','name','data_status = 1  AND admin_status<>2 AND (FIND_IN_SET(1,user_group_id) OR FIND_IN_SET(2,user_group_id)) AND block_status = 0');
		$case_sts =$this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1');
		$lawyer = $this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1 and district="'.$row_info->district.'"');
		$court =$this->User_model->get_parameter_data('ref_court','name','data_status = 1 AND district="'.$row_info->district.'"');
		$expense_type = $this->User_model->get_parameter_data('ref_expense_type','name','data_status = 1  AND id=1');
		$vendor = $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1');
		$district = $this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1');
		if($row_info->req_type==2)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara','name','data_status = 1  AND apv_sts<>1');
			
		}
		else
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ni','name','data_status = 1 AND apv_sts<>1');
		}
		$court_activities = $this->User_model->get_parameter_data('ref_court_fee_activities','name','data_status = 1');
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row_info;
		$var['case_name']=$case_name;
		$var['plaintiff']=$plaintiff;
		$var['case_sts']=$case_sts;
		$var['lawyer']=$lawyer;
		$var['vendor']=$vendor;
		$var['court']=$court;
		$var['district']=$district;
		$var['expense_activities']=$expense_activities;
		$var['court_activities']=$court_activities;
		$var['Message']=$Message;
		$var['expense']=$expense;
		$var['expense_type']=$expense_type;
		$var['package_info']=$package_info;
		$var['package_sts']=$package_sts;
		echo json_encode($var);
	}
	function get_recase_info_edit()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$package_info = array();
		$package_sts = 0;
		$certified_copy_bill_sts = 0;
		$row_info =$this->Legal_file_process_model->get_add_action_data_recase($id);
		$suit_info =$this->Legal_file_process_model->get_suit_info($row_info->pre_suit_id);
		$expense = $this->Legal_file_process_model->get_expenese_info($id);
		if (!empty($row_info)) {
			$Message='ok';
			$package_info = $this->db->query("SELECT h.*,h.id as history_id,c.id as package_id,c.case_number,c.loan_ac,IF(c.disbursed_amount IS NULL,0,c.disbursed_amount) as disbursed_amount,c.package_amount,l.name as lawyer_name
			FROM package_select_history as h 
			LEFT OUTER JOIN lawyer_package_bill_setup c on(h.package_id=c.id)
			LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
			WHERE h.event_id='".$row_info->id."' AND h.event_table_name='suit_filling_info' LIMIT 1")->row();
			if(!empty($package_info))
			{
				$package_sts = 1;
			}

			$bill_info = $this->db->query("SELECT c.id
			FROM cost_details as c 
			WHERE c.suit_id=$row_info->pre_suit_id AND c.module_name='suit_file' AND c.main_table_name='suit_filling_info' AND (c.activities_id=12 or c.activities_id=13 or c.activities_id=31) LIMIT 1")->row();
			if(!empty($bill_info))
			{
				$certified_copy_bill_sts = 1;
			}
			else if($row_info->legal_region==2)
			{
				$certified_copy_bill_sts = 1;
			}
		}
		else{
			$Message='No Data';
		}
		$case_name =$this->User_model->get_parameter_data('ref_case_name','name','data_status = 1 AND req_type="'.$row_info->req_type.'"');
		$plaintiff =$this->User_model->get_parameter_data('users_info','name','data_status = 1  AND admin_status<>2 AND (FIND_IN_SET(1,user_group_id) OR FIND_IN_SET(2,user_group_id)) AND block_status = 0 AND (FIND_IN_SET("'.$row_info->district.'",legal_district) OR id="'.$suit_info->case_deal_officer.'")');
		$case_sts =$this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1');
		$lawyer = $this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1 and district="'.$row_info->district.'"');
		$court =$this->User_model->get_parameter_data('ref_court','name','data_status = 1 AND district="'.$row_info->district.'"');
		$expense_type = $this->User_model->get_parameter_data('ref_expense_type','name','data_status = 1  AND id=1');
		$vendor = $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1');
		$district = $this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1');
		if($row_info->req_type==2)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara','name','data_status = 1 AND aurtho_jari_sts=1 AND apv_sts<>1');
			
		}
		else
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ni','name','data_status = 1 AND apv_sts<>1');
		}
		$court_activities = $this->User_model->get_parameter_data('ref_court_fee_activities','name','data_status = 1');
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row_info;
		$var['case_name']=$case_name;
		$var['suit_info']=$suit_info;
		$var['plaintiff']=$plaintiff;
		$var['case_sts']=$case_sts;
		$var['lawyer']=$lawyer;
		$var['vendor']=$vendor;
		$var['court']=$court;
		$var['district']=$district;
		$var['expense_activities']=$expense_activities;
		$var['court_activities']=$court_activities;
		$var['Message']=$Message;
		$var['expense']=$expense;
		$var['expense_type']=$expense_type;
		$var['package_info']=$package_info;
		$var['package_sts']=$package_sts;
		$var['certified_copy_bill_sts']=$certified_copy_bill_sts;
		echo json_encode($var);
	}
	function get_filing_info()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$package_info = array();
		$package_sts = 0;
		$cma_id = $this->input->post('id');
		$cma_info =$this->Legal_file_process_model->get_cma_info($cma_id);
		if (!empty($cma_info)) {
			$Message='ok';
			$str_where = "c.sts<>0 AND c.disbursed_sts=0 AND c.v_sts=13 AND c.package_type=1";
			if ($cma_info->proposed_type=='Loan') {
				$str_where.= " AND c.loan_ac='".$cma_info->loan_ac."'";
			}else
			{
				$str_where.= " AND c.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$cma_info->loan_ac)."'";
			}
			$str_where.= " AND c.req_type=".$this->db->escape($cma_info->req_type);
			$str_where.= " AND c.lawyer=".$this->db->escape($cma_info->lawyer);
			$package_info = $this->db->query("SELECT c.*,IF(c.disbursed_amount IS NULL,0,c.disbursed_amount) as disbursed_amount,l.name as lawyer_name
			FROM lawyer_package_bill_setup as c 
			LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
			WHERE ".$str_where." LIMIT 1")->row();
			if(!empty($package_info))
			{
				$package_sts = 1;
			}
		}
		else{
			$Message='No Data';
		}
		$case_name =$this->User_model->get_parameter_data('ref_case_name','name','data_status = 1 AND req_type="'.$cma_info->req_type.'"');
		$plaintiff =$this->User_model->get_parameter_data('users_info','name','data_status = 1  AND admin_status<>2 AND (FIND_IN_SET(1,user_group_id) OR FIND_IN_SET(2,user_group_id)) AND block_status = 0');
		$case_sts =$this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1');
		$lawyer = $this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1 and district="'.$cma_info->case_fill_dist.'"');
		$court =$this->User_model->get_parameter_data('ref_court','name','data_status = 1 AND district="'.$cma_info->case_fill_dist.'"');
		$expense_type = $this->User_model->get_parameter_data('ref_expense_type','name','data_status = 1  AND id=1');
		$vendor = $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1');
		$district = $this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1');
		if($cma_info->req_type==2)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara','name','data_status = 1   AND apv_sts<>1');
			
		}
		else
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ni','name','data_status = 1  AND apv_sts<>1');
		}
		$case_prefix = $this->User_model->get_prefix_name('ref_req_type','name','data_status = 1 AND id="'.$cma_info->req_type.'"')->case_prefix;
		$court_activities = $this->User_model->get_parameter_data('ref_court_fee_activities','name','data_status = 1');
		$var['csrf_token']=$csrf_token;
		$var['cma_info']=$cma_info;
		$var['case_prefix']=$case_prefix;
		$var['case_name']=$case_name;
		$var['plaintiff']=$plaintiff;
		$var['case_sts']=$case_sts;
		$var['lawyer']=$lawyer;
		$var['vendor']=$vendor;
		$var['court']=$court;
		$var['district']=$district;
		$var['expense_activities']=$expense_activities;
		$var['court_activities']=$court_activities;
		$var['Message']=$Message;
		$var['expense_type']=$expense_type;
		$var['package_info']=$package_info;
		$var['package_sts']=$package_sts;
		echo json_encode($var);
	}
	function get_case_prefix()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$act_id = $this->input->post('act_id');
		$case_prefix = $this->User_model->get_prefix_name('ref_case_name','name','data_status = 1 AND id="'.$act_id.'"')->case_prefix;
		$var['csrf_token']=$csrf_token;
		$var['case_prefix']=$case_prefix;
		echo json_encode($var);
	}
	function get_recase_filing_info()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$suit_id = $this->input->post('id');
		$package_info = array();
		$package_sts = 0;
		$certified_copy_bill_sts = 0;
		$suit_info =$this->Legal_file_process_model->get_suit_info($suit_id);
		if (!empty($suit_info)) {
			$Message='ok';
			$str_where = "c.sts<>0 AND c.disbursed_sts=0 AND c.v_sts=13 AND c.package_type=1";
			if ($suit_info->proposed_type=='Loan') {
				$str_where.= " AND c.loan_ac='".$suit_info->loan_ac."'";
			}else
			{
				$str_where.= " AND c.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$suit_info->loan_ac)."'";
			}
			$str_where.= " AND c.req_type=".$this->db->escape($suit_info->req_type);
			$str_where.= " AND c.lawyer=".$this->db->escape($suit_info->prest_lawyer_name);
			$package_info = $this->db->query("SELECT c.*,IF(c.disbursed_amount IS NULL,0,c.disbursed_amount) as disbursed_amount,l.name as lawyer_name
			FROM lawyer_package_bill_setup as c 
			LEFT OUTER JOIN ref_lawyer l on(l.id=c.lawyer)
			WHERE ".$str_where." LIMIT 1")->row();
			if(!empty($package_info))
			{
				$package_sts = 1;
			}
			else if($suit_info->legal_region==2)
			{
				$certified_copy_bill_sts = 1;
			}

			$bill_info = $this->db->query("SELECT c.id
			FROM cost_details as c 
			WHERE c.suit_id=$suit_id AND c.module_name='suit_file' AND c.main_table_name='suit_filling_info' AND (c.activities_id=12 or c.activities_id=13 or c.activities_id=31) LIMIT 1")->row();
			if(!empty($bill_info))
			{
				$certified_copy_bill_sts = 1;
			}
		}
		else{
			$Message='No Data';
		}
		$case_name =$this->User_model->get_parameter_data('ref_case_name','name','data_status = 1 AND req_type="'.$suit_info->req_type.'"');
		$plaintiff =$this->User_model->get_parameter_data('users_info','name','data_status = 1  AND admin_status<>2 AND (FIND_IN_SET(1,user_group_id) OR FIND_IN_SET(2,user_group_id)) AND block_status = 0 and (FIND_IN_SET("'.$suit_info->district.'",legal_district) OR id="'.$suit_info->case_deal_officer.'")');
		$case_sts =$this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1');
		$lawyer = $this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1 and district="'.$suit_info->district.'"');
		$court =$this->User_model->get_parameter_data('ref_court','name','data_status = 1 AND district="'.$suit_info->district.'"');
		$expense_type = $this->User_model->get_parameter_data('ref_expense_type','name','data_status = 1 AND id=1');
		$vendor = $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1');
		$district = $this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1');
		if($suit_info->req_type==2)
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ara','name','data_status = 1 AND aurtho_jari_sts=1 AND apv_sts<>1');
			
		}
		else
		{
			$expense_activities = $this->User_model->get_parameter_data('ref_schedule_charges_ni','name','data_status = 1  AND apv_sts<>1');
		}
		$court_activities = $this->User_model->get_parameter_data('ref_court_fee_activities','name','data_status = 1');
		$var['csrf_token']=$csrf_token;
		$var['suit_info']=$suit_info;
		$var['case_name']=$case_name;
		$var['plaintiff']=$plaintiff;
		$var['case_sts']=$case_sts;
		$var['lawyer']=$lawyer;
		$var['vendor']=$vendor;
		$var['court']=$court;
		$var['district']=$district;
		$var['expense_activities']=$expense_activities;
		$var['court_activities']=$court_activities;
		$var['Message']=$Message;
		$var['expense_type']=$expense_type;
		$var['package_info']=$package_info;
		$var['package_sts']=$package_sts;
		$var['certified_copy_bill_sts']=$certified_copy_bill_sts;
		echo json_encode($var);
	}
	function statement_download($type,$file_url=NULL)
	{
		if ($type=='uploaded') {
			$file_url = 'cma_file/uploaded_statement/'.$file_url;
		}else if($type=='generated')
		{
			$file_url = 'cma_file/generated_statement/'.$file_url;
		}else{
			$file_url='';
		}
		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
		readfile($file_url); 
	}
	function fileprocessing($id=NULL,$editrow=NULL,$proposed_type=NULL)
	{
		$link_id='227';
		if ($proposed_type==1) {
			$type='Loan';
		}else{$type='Card';}
		$result = $this->Cma_process_model->get_recommend_info($id);
		if ($type=='Loan') {
			$facility_info = $this->Cma_ho_model->get_facility($id);
		}
		else{
			$facility_info = $this->Cma_ho_model->get_card_facility($id);
		}
		$bidder_info = $this->Cma_ho_model->get_bidder($id);
		$doc_files = $this->Cma_process_model->get_cma_doc_files($id);
		$checker_info = $this->User_info_model->get_checker_data($link_id,'',"FIND_IN_SET(".$result->legal_region.",legal_region)");
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'doc_files' => $doc_files,
				   'facility_info' => $facility_info,
				   'bidder_info' => $bidder_info,
				   'cma_guarantor' => $this->Cma_process_model->get_guarantor_info('edit',$id),
				   'facility_name'=>$this->User_model->get_parameter_data('ref_facility_name','name','data_status = 1'),
				   'id' => $id,
				   'checker_info' => $checker_info,
				   'proposed_type' => $type,
				   'pages'=> 'legal_file_process/pages/file_processing_form',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('legal_file_process/form_layout',$data);
	}
	function delete_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Legal_file_process_model->delete_action();
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
			else if($id=='limitcrossed')
			{
				$Message='Sorry! Package Bill Limit Crossed Please Try Again.';
				$row[]='';	
			}
			else if($id=='Bill exists')
			{
				$Message='Bill exists! Delete Bill First.';
				$row[]='';	
			}
			else if($id=='Status Exists')
			{
				$Message='Case Status Data exists! Delete Status First.';
				$row[]='';	
			}
			else if($id=='ln bill exists!')
			{
				$Message='Bill Already Updated!';
				$row[]='';	
			}
			else if($id=='99999')
			{
				$Message='99999';
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
		$this->Common_model->delete_tempfile();
		$var['csrf_token']=$csrf_token;
		$var['Message']=$Message;
		$var['row_info']=$row;
		$var['id']=$id;
		echo json_encode($var);
	}
	function delete_action_recase()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Legal_file_process_model->delete_action_recase();
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
			else if($id=='limitcrossed')
			{
				$Message='Sorry! Package Bill Limit Crossed Please Try Again.';
				$row[]='';	
			}
			else if($id=='bill taken')
			{
				$Message='Unable to take action due to bill alreday selected on other end';
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
	function add_edit_suit_filling()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			if($_POST['edit_after_verify_sts']==0)
			{
				$id = $this->Legal_file_process_model->add_edit_suit_filling();
			}
			else
			{
				$id = $this->Legal_file_process_model->add_edit_suit_filling_after_verify();
			}
			
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
	function add_edit_recase_filling()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			if($_POST['edit_after_verify_sts']==0)
			{
				$id = $this->Legal_file_process_model->add_edit_recase_filling();
			}
			else
			{
				$id = $this->Legal_file_process_model->add_edit_recase_filling_after_verify();
			}
			
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
	function cma_and_suit_details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str='';
		$expense = array();
		if (isset($_POST['operation'])) {
			$operation = $this->input->post('operation');
		}else{$operation ="";}
			if ($this->input->post('cma_id') != ""){
				$details=$this->Cma_process_model->get_recommend_info($this->input->post('cma_id'));
	    		$guarantor_info= $this->Cma_process_model->get_guarantor_info('edit',$this->input->post('cma_id'));    	
	    		$suit_file_details = $this->Legal_file_process_model->get_suit_filling_details_by_cmaid_all($this->input->post('cma_id'));
	    	}
	    	else{$details=array();$suit_file_details=array();}

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

	    		if ($details->final_ln!='') {
	    			$final_ln='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/ln_scan_copy/'.$details->final_ln.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$final_ln="";}

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

				$str.='
						<tr>
							<td width="50%" align="left"><strong>File Deliver By:</strong>'.$details->deliver_by.'</td>
							<td width="50%" align="left"><strong>File Deliver Date Time:</strong>'.$details->deliver_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Legal Ack By:</strong>'.$details->legal_ack_by.'</td>
							<td width="50%" align="left"><strong>Legal Ack Date Time:</strong>'.$details->legal_ack_dt.'</td>
						</tr>';
				if ($details->sts==84) 
				{
					$str.='<tr>
								<td width="50%" align="left"><strong>File Reassign By:</strong>'.$details->reassign_by.'</td>
								<td width="50%" align="left"><strong>Reassigned Legal User:</strong>'.$details->reassigned_legal_user.'</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>File Reassign Date Time:</strong>'.$details->ln_val_dt.'</td>
								<td width="50%" align="left"><strong>File Reassign Reason:</strong>'.$details->reassign_reason.'</td>
							</tr>';
				}
				if ($details->uploaded_statement!='' || $details->generated_statement!='') 
				{
					$str.='<tr>
								<td width="50%" align="left"><strong>Statement File:</strong>'.$statement_file.'</td>
								<td width="50%" align="left"><strong>LN Sent Date (Legal):</strong>'.$details->ln_sent_date.'</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Valid Date (Legal):</strong>'.$details->ln_val_dt.'</td>
								<td width="50%" align="left"><strong>Selected Lawyer (Legal):</strong>'.$details->lawyer_legal.'</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Scan Copy (Legal):</strong>'.$final_ln.'</td>
								<td width="50%" align="left"></td>
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
	    	if (!empty($suit_file_details)) 
	    	{
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
	    	if ($this->input->post('operation')=='reassign') {
	    		$link_id='227';
	    		$legal_user = $this->User_info_model->get_checker_data($link_id,'2',"FIND_IN_SET(".$details->legal_region.",legal_region)");
	    	}else{
	    		$legal_user = array();
	    	}
	    	
	    	$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token,
					"legal_user"=>$legal_user
					);
			echo json_encode($var);
	}
	function details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str='';
		$expense = array();
		$suit_file_details=array();
		if (isset($_POST['operation'])) {
			$operation = $this->input->post('operation');
		}else{$operation ="";}
			if ($this->input->post('cma_id') != ""){
				$details=$this->Cma_process_model->get_recommend_info($this->input->post('cma_id'));
	    		$guarantor_info= $this->Cma_process_model->get_guarantor_info('edit',$this->input->post('cma_id'));    	
	    		
	    	}
	    	else{$details=array();}
	    	$suit_file_details = $this->Legal_file_process_model->get_suit_file_details($this->input->post('id'));
	    	$package_info = $this->Legal_file_process_model->get_package_details($this->input->post('id'),$suit_file_details->req_type);
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

	    		if ($details->final_ln!='') {
	    			$final_ln='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/ln_scan_copy/'.$details->final_ln.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$final_ln="";}

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

				$str.='
						<tr>
							<td width="50%" align="left"><strong>File Deliver By:</strong>'.$details->deliver_by.'</td>
							<td width="50%" align="left"><strong>File Deliver Date Time:</strong>'.$details->deliver_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Legal Ack By:</strong>'.$details->legal_ack_by.'</td>
							<td width="50%" align="left"><strong>Legal Ack Date Time:</strong>'.$details->legal_ack_dt.'</td>
						</tr>';
				if ($details->sts==84) 
				{
					$str.='<tr>
								<td width="50%" align="left"><strong>File Reassign By:</strong>'.$details->reassign_by.'</td>
								<td width="50%" align="left"><strong>Reassigned Legal User:</strong>'.$details->reassigned_legal_user.'</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>File Reassign Date Time:</strong>'.$details->ln_val_dt.'</td>
								<td width="50%" align="left"><strong>File Reassign Reason:</strong>'.$details->reassign_reason.'</td>
							</tr>';
				}
				if ($details->uploaded_statement!='' || $details->generated_statement!='') 
				{
					$str.='<tr>
								<td width="50%" align="left"><strong>Statement File:</strong>'.$statement_file.'</td>
								<td width="50%" align="left"><strong>LN Sent Date (Legal):</strong>'.$details->ln_sent_date.'</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Valid Date (Legal):</strong>'.$details->ln_val_dt.'</td>
								<td width="50%" align="left"><strong>Selected Lawyer (Legal):</strong>'.$details->lawyer_legal.'</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Scan Copy (Legal):</strong>'.$final_ln.'</td>
								<td width="50%" align="left"></td>
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
	    	if (!empty($suit_file_details)) 
	    	{
	    		if ($suit_file_details->arji_copy!='') {
	    			$arji_copy='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/arji_copy/'.$suit_file_details->arji_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$arji_copy="";}
	    		$expense = $this->Legal_file_process_model->get_expense_details($suit_file_details->id,$suit_file_details->req_type);
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
							<td width="50%" align="left"><strong>Judge Name:</strong>'.$suit_file_details->judge_name.'</td>
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
	    	if (!empty($package_info)) 
	    	{
	    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Package Bill Info</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Lawyer Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Loan AC</td>
							<td width="10%" style="font-weight: bold;text-align:left">Case Number</td>
							<td width="10%" style="font-weight: bold;text-align:left">Remaining Package Amount</td>
							<td width="10%" style="font-weight: bold;text-align:left">Activities</td>
							<td width="10%" style="font-weight: bold;text-align:left">Amount</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
					$str.='<tr>';
						$str.='<td align="center">'.$package_info->lawyer_name.'</td>';
						$str.='<td align="left">'.$package_info->loan_ac.'</td>';
						$str.='<td align="left">'.$package_info->case_number.'</td>';
						$str.='<td align="left">'.number_format($package_info->package_amount-$package_info->disbursed_amount,2).'</td>';
						$str.='<td align="left">'.$package_info->activities_name.'</td>';
						$str.='<td align="left">'.$package_info->amount.'</td>';
					$str.='</tr>';

				$str.='</tbody>
					</table>
				</div>';

	    	}
	    	if ($this->input->post('operation')=='reassign_file') {
	    		$link_id='226';
	    		$legal_user = $this->User_info_model->get_checker_data($link_id,'2');
	    	}else{
	    		$legal_user = array();
	    	}
	    	
	    	$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token,
					"legal_user"=>$legal_user
					);
			echo json_encode($var);
	}
	function suit_file_details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str='';
		$expense = array();
		$suit_file_details=$this->Legal_file_process_model->get_suit_file_details($this->input->post('id'));
	    	if (!empty($suit_file_details)) 
	    	{
	    		$expense = $this->Legal_file_process_model->get_expense_details($suit_file_details->id,$suit_file_details->req_type);
	    		if ($suit_file_details->proposed_type=='Loan') 
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
	    		$str .='<table style="width: 100%;" id="preview_table">
					<thead></thead>
					<tbody id="details_body">
						
						<tr>
							<td width="50%" align="left"><strong>'.$nam_tag.':</strong>'.$suit_file_details->ac_name.'</td>
							<td width="50%" align="left"><strong>'.$no_tag.'No.:</strong> '.$suit_file_details->loan_ac.'</td>
							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Case Number:</strong>'.$suit_file_details->case_number.'</td>
							<td width="50%" align="left"><strong>Suit File Entry By:</strong>'.$suit_file_details->e_by.'</td>
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
							<td width="50%" align="left"><strong>Present Lawyer Name:</strong>'.$suit_file_details->prest_lawyer_name.'</td>

						</tr>
						<tr>
							
							<td width="50%" align="left"><strong>Present Court Name:</strong>'.$suit_file_details->prest_court_name.'</td>
							<td width="50%" align="left"></td>
							
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
	    	$var =array(
	    			"str"=>$str,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
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
	function recase_file_details()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$str='';
		$expense = array();
		$details=$this->Cma_process_model->get_recommend_info($this->input->post('cma_id'));
	    $guarantor_info= $this->Cma_process_model->get_guarantor_info('edit',$this->input->post('cma_id'));    	
		$suit_file_details=$this->Legal_file_process_model->get_suit_file_details($this->input->post('id'));
    	$package_info = $this->Legal_file_process_model->get_package_details($this->input->post('id'),$suit_file_details->req_type);
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

	    		if ($details->final_ln!='') {
	    			$final_ln='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/ln_scan_copy/'.$details->final_ln.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	    		}else{$final_ln="";}

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

				$str.='
						<tr>
							<td width="50%" align="left"><strong>File Deliver By:</strong>'.$details->deliver_by.'</td>
							<td width="50%" align="left"><strong>File Deliver Date Time:</strong>'.$details->deliver_dt.'</td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Legal Ack By:</strong>'.$details->legal_ack_by.'</td>
							<td width="50%" align="left"><strong>Legal Ack Date Time:</strong>'.$details->legal_ack_dt.'</td>
						</tr>';
				if ($details->sts==84) 
				{
					$str.='<tr>
								<td width="50%" align="left"><strong>File Reassign By:</strong>'.$details->reassign_by.'</td>
								<td width="50%" align="left"><strong>Reassigned Legal User:</strong>'.$details->reassigned_legal_user.'</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>File Reassign Date Time:</strong>'.$details->ln_val_dt.'</td>
								<td width="50%" align="left"><strong>File Reassign Reason:</strong>'.$details->reassign_reason.'</td>
							</tr>';
				}
				if ($details->uploaded_statement!='' || $details->generated_statement!='') 
				{
					$str.='<tr>
								<td width="50%" align="left"><strong>Statement File:</strong>'.$statement_file.'</td>
								<td width="50%" align="left"><strong>LN Sent Date (Legal):</strong>'.$details->ln_sent_date.'</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Valid Date (Legal):</strong>'.$details->ln_val_dt.'</td>
								<td width="50%" align="left"><strong>Selected Lawyer (Legal):</strong>'.$details->lawyer_legal.'</td>
							</tr>
							<tr>
								<td width="50%" align="left"><strong>LN Scan Copy (Legal):</strong>'.$final_ln.'</td>
								<td width="50%" align="left"></td>
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
    	if (!empty($suit_file_details)) 
    	{
    		$expense = $this->Legal_file_process_model->get_expense_details($suit_file_details->id,$suit_file_details->req_type);
    		if ($suit_file_details->proposed_type=='Loan') 
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
    		if($suit_file_details->merge_case_sts==1)
    		{
    			$merge_sts = 'Yes';
    			$merge_style='style="color:red"';
    		}else{$merge_sts = 'No';$merge_style='';}
    		if($suit_file_details->both_case_sts==0)
    		{
    			$running_sts = 'No';
    			$run_style='style="color:red"';
    		}else{$running_sts = 'Yes';$run_style='';}
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead>
					<tr>
						<td colspan="2" style="font-size:20px;font-weight:bold;text-align:center">Suit File Info</td>
					</tr>
					</thead>
				<tbody id="details_body">
					
					<tr>
						<td width="50%" align="left"><strong>'.$nam_tag.':</strong>'.$suit_file_details->ac_name.'</td>
						<td width="50%" align="left"><strong>'.$no_tag.'No.:</strong> '.$suit_file_details->loan_ac.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Case Name:</strong>'.$suit_file_details->case_name.'</td>
						<td width="50%" align="left"><strong>Case Number:</strong>'.$suit_file_details->case_number.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Prev Date:</strong> '.$suit_file_details->prev_date.'</td>
						<td width="50%" align="left"><strong>Prev Case Sts:</strong>'.$suit_file_details->case_sts_prev_dt.'</td>

					</tr>
					<tr>
						<td width="50%" align="left"><strong>Next Date:</strong> '.$suit_file_details->next_date.'</td>
						<td width="50%" align="left"><strong>Next Case Status:</strong>'.$suit_file_details->case_sts_next_dt.'</td>

					</tr>
					<tr>
						<td width="50%" align="left"><strong>Remarks:</strong>'.$suit_file_details->remarks_next_date.'</td>
						<td width="50%" align="left"><strong>Filling Plaintiff:</strong>'.$suit_file_details->filling_plaintiff.'</td>

					</tr>
					<tr>
						<td width="50%" align="left"><strong>Filling Date:</strong>'.$suit_file_details->filling_date.'</td>
						<td width="50%" align="left"><strong>Suit File Entry Date:</strong>'.$suit_file_details->e_dt.'</td>

					</tr>
					<tr>
						<td width="50%" align="left" '.$run_style.'><strong>Both Case Running:</strong>'.$running_sts.'</td>
						<td width="50%" align="left" '.$merge_style.'><strong>Merge With Previous Case:</strong>'.$merge_sts.'</td>

					</tr>
					<tr>
						<td width="50%" align="left"><strong>Present Lawyer Name:</strong>'.$suit_file_details->prest_lawyer_name.'</td>
						<td width="50%" align="left"><strong>Present Court Name:</strong>'.$suit_file_details->prest_court_name.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Case Claim Amount:</strong>'.$suit_file_details->case_claim_amount.'</td>
						<td width="50%" align="left"><strong>Suit File Entry By:</strong>'.$suit_file_details->e_by.'</td>
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
    	if (!empty($package_info)) 
	    	{
	    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Package Bill Info</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Lawyer Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Loan AC</td>
							<td width="10%" style="font-weight: bold;text-align:left">Case Number</td>
							<td width="10%" style="font-weight: bold;text-align:left">Remaining Package Amount</td>
							<td width="10%" style="font-weight: bold;text-align:left">Activities</td>
							<td width="10%" style="font-weight: bold;text-align:left">Amount</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">';
					$str.='<tr>';
						$str.='<td align="center">'.$package_info->lawyer_name.'</td>';
						$str.='<td align="left">'.$package_info->loan_ac.'</td>';
						$str.='<td align="left">'.$package_info->case_number.'</td>';
						$str.='<td align="left">'.number_format($package_info->package_amount-$package_info->disbursed_amount,2).'</td>';
						$str.='<td align="left">'.$package_info->activities_name.'</td>';
						$str.='<td align="left">'.$package_info->amount.'</td>';
					$str.='</tr>';

				$str.='</tbody>
					</table>
				</div>';

	    	}
    	if ($this->input->post('operation')=='reassign_file') {
	    		$link_id='226';
	    		$legal_user = $this->User_info_model->get_checker_data($link_id,'2');
	    	}else{
	    		$legal_user = array();
	    	}
    	$var =array(
    			"str"=>$str,
    			"legal_user"=>$legal_user,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function bulk_operation_recase($operation=NULL)
	{
		$operation_name='';
		if ($operation=='confirm') 
		{
			$operation_name='Bulk Confirm';
		}
        if(check_group(1) || check_group(2))
        {
            $region_data = $this->user_model->get_parameter_data('ref_legal_region', 'id', 'data_status = 1 AND id IN('.$this->session->userdata['ast_user']['legal_region'].')');
        }
        else
        {
            $region_data = $this->user_model->get_parameter_data('ref_legal_region', 'id', 'data_status = 1');
        }
		$data = array( 	
			   'legal_region' =>$region_data,
			   'operation' => $operation,
			   'operation_name' => $operation_name,
			   'pages'=> 'legal_file_process/pages/bulk_operation_recase',		   
			   );
		$this->load->view('legal_file_process/form_layout',$data);
	}
	function bulk_operation($operation=NULL)
	{
		$operation_name='';
		if ($operation=='blk_lawyer') 
		{
			$operation_name='File Assign To Lawyer';
		}
		if ($operation=='blk_rf') 
		{
			$operation_name='Reasign File';
		}
		if ($operation=='blk_ack') 
		{
			$operation_name='Acknowledgement File';
		}
		if ($operation=='blk_rf_approve') 
		{
			$operation_name='Reassign File Approval';
		}
		$region = $this->user_model->get_parameter_data('ref_legal_region','name',"data_status = '1'");
		$territory = $this->user_model->get_parameter_data('ref_territory','name',"data_status = '1'");
		$unit_office = $this->user_model->get_parameter_data('ref_unit_office','name',"data_status = '1'");
		$district = array();
		$loan_segment = $this->user_model->get_parameter_data('ref_loan_segment','name',"data_status = '1'");
		$req_type = $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'");
		$data = array( 	
			   'region' => $region,
			   'territory' => $territory,
			   'unit_office' => $unit_office,
			   'district' => $district,
			   'loan_segment' => $loan_segment,
			   'req_type' => $req_type,
			   'operation' => $operation,
			   'branch' => $this->User_model->get_parameter_data('ref_branch_sol','name','data_status = 1'),
			   'bank' => $this->User_model->get_parameter_data('ref_bank','name','data_status = 1'),
			   'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
			   'lawyer'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
			   'operation_name' => $operation_name,
			   'pages'=> 'legal_file_process/pages/bulk_operation',		   
			   );
		$this->load->view('legal_file_process/form_layout',$data);
	}
	function bulk_operation_suit_file($operation=NULL)
	{
		$operation_name='';
		if ($operation=='blk_rf_main' || $operation=='blk_rf_recase') 
		{
			$operation_name='Reasign File';
		}
		if ($operation=='blk_rf_approve_main' || $operation=='blk_rf_approve_recase') 
		{
			$operation_name='Reasign File Approve';
		}
        if(check_group(1) || check_group(2))
        {
            $region_data = $this->user_model->get_parameter_data('ref_legal_region', 'id', 'data_status = 1 AND id IN('.$this->session->userdata['ast_user']['legal_region'].')');
        }
        else
        {
            $region_data = $this->user_model->get_parameter_data('ref_legal_region', 'id', 'data_status = 1');
        }
		$req_type = $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'");
		$data = array( 	
			   'legal_region' =>$region_data,
			   'operation' => $operation,
			   'operation_name' => $operation_name,
			   'pages'=> 'legal_file_process/pages/bulk_operation_file',		   
		);
		$this->load->view('legal_file_process/form_layout',$data);
	}
	function bulk_acktion()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Legal_file_process_model->bulk_acktion();
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
	function bulk_acktion_recase()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Legal_file_process_model->bulk_acktion_recase();
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
			else if($id=='limitcrossed')
			{
				$Message='Sorry! Package Bill Limit Crossed Please Try Again.';
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
	function bulk_acktion_file()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Legal_file_process_model->bulk_acktion_file();
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
	function load_bulk_data()
	{
		$this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
	    $grid_data=$this->Legal_file_process_model->get_bulk_data();
	    $operation= $this->input->post('operation');
	  
		$str='';
		$counter = 0;
		if($operation=='blk_lawyer')
		{
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="5%" style="font-weight: bold;text-align:left">Serial</th>
					<th width="10%" style="font-weight: bold;text-align:left">Req Type</th>
					<th width="15%" style="font-weight: bold;text-align:left">Loan A/C or Card No</th>
					<th width="15%" style="font-weight: bold;text-align:left">A/C Name</th>
					<th width="10%" style="font-weight: bold;text-align:left">Court Fee</th>
					<th width="10%" style="font-weight: bold;text-align:left">Procurement</th>
					<th width="10%" style="font-weight: bold;text-align:left">Branch</th>
					<th width="10%" style="font-weight: bold;text-align:left">Bank</th>
					<th width="10%" style="font-weight: bold;text-align:left">Dishonore Dt</th>
					<th width="10%" style="font-weight: bold;text-align:left">Chq Number</th>
					<th width="10%" style="font-weight: bold;text-align:left">Chq Amount</th>
				</thead>
				<tbody>';	
		}
		else
		{
			$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="5%" style="font-weight: bold;text-align:left">Serial</th>
					<th width="10%" style="font-weight: bold;text-align:left">Protfolio</th>
					<th width="10%" style="font-weight: bold;text-align:left">Req Type</th>
					<th width="15%" style="font-weight: bold;text-align:left">Loan A/C or Card No</th>
					<th width="15%" style="font-weight: bold;text-align:left">A/C Name</th>
					<th width="10%" style="font-weight: bold;text-align:left">Region</th>
					<th width="10%" style="font-weight: bold;text-align:left">Territory</th>
					<th width="10%" style="font-weight: bold;text-align:left">District</th>
					<th width="10%" style="font-weight: bold;text-align:left">Unit Office</th>
					<th width="10%" style="font-weight: bold;text-align:left">Rec By</th>
					<th width="10%" style="font-weight: bold;text-align:left">Rec Date Time</th>
				</thead>
				<tbody>';	
		}
		
	
		if(count($grid_data)<=0)
		{
			$str.='<tr><td colspan="13" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
			$str.='<input type="hidden" name="event_counter" id="event_counter" value="0">';
			$str.='</tbody></table></div>';
		}
		else{
			$i=1;
			foreach ($grid_data as $data) {
				if($operation=='blk_lawyer')
				{
					$counter++;
					if($data->req_type==2)//Court Fee Calculation only for ARA
					{
						$pre_court_fee_data = $this->db->query("SELECT c.*
						FROM cost_details as c 
						WHERE c.vendor_type=4 AND c.main_table_name='cma' AND c.main_table_id='".$data->id."' ORDER BY c.id DESC LIMIT 1" )->row();
		    			$pre_set_data = $this->User_info_model->upr_config_row();
						$procurement = $pre_set_data->procurement;
						$fixed_court_fee = $pre_set_data->fixed_court_fee;

						//Court Fee Calculation
						$court_fee_25 = (($data->st_belance/100)*2.5);
	                    $court_fee_15 = (($court_fee_25/100)*15);
	                    $actual_cost = ($court_fee_25+$court_fee_15);
	                    if ($actual_cost>$fixed_court_fee)
	                    {
	                        $actual_cost = $fixed_court_fee;
	                    }
	                    $court_fee = ($actual_cost+$procurement);
					}
                    $str.='<tr>';
					$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="hidden_req_type_'.$i.'" id="hidden_req_type_'.$i.'" value="'.$data->req_type.'"><input type="hidden" name="event_id_'.$i.'" id="event_id_'.$i.'" value="'.$data->id.'"><input type="hidden" name="pre_legal_user_'.$i.'" id="pre_legal_user_'.$i.'" value="'.$data->legal_user.'"></td>';
					$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
					$str.='<td align="left">'.$data->sl_no.'</td>';
					$str.='<td align="left">'.$data->requisition_name.'</td>';
					$str.='<td align="left">'.$data->loan_ac.'</td>';
					$str.='<td align="left">'.$data->ac_name.'</td>';
					if($data->req_type==2)
					{
						if(empty($pre_court_fee_data) || ($pre_court_fee_data->bill_id!='' && $pre_court_fee_data->bill_id!=0 && $pre_court_fee_data->bill_id!=NULL))
						{
							$str.='<td align="left"><input name="new_court_fee_sts_'.$i.'" id="new_court_fee_sts_'.$i.'" value="1" type="hidden"><input style="float:left;width:100px" name="court_fee_amount_'.$i.'" type="text" id="court_fee_amount_'.$i.'" value="'.$court_fee.'" onkeypress="return numbersonly(event)" class="text-input-big" /></td>';
							$str.='<td align="left"><input style="float:left;width:100px" name="procument_cost_'.$i.'" type="text" id="procument_cost_'.$i.'" value="'.$procurement.'" class="text-input-big" onkeypress="return numbersonly(event)" onKeyUp="javascript:return add_procurment(this.value,'.$court_fee.','.$procurement.','.$i.');"/></td>';
						}
						else
						{
							$str.='<td align="left" colspan="2"><input name="new_court_fee_sts_'.$i.'" id="new_court_fee_sts_'.$i.'" value="0" type="hidden"><input name="court_fee_id_'.$i.'" id="court_fee_id_'.$i.'" value="'.$pre_court_fee_data->id.'" type="hidden"><span style="float:left"><strong>Court Fee already Added It will be Replace by New lawyer!</strong></span><input style="float:left;width:100px" name="court_fee_amount_'.$i.'" type="hidden" id="court_fee_amount_'.$i.'" value="0" onkeypress="return numbersonly(event)" class="text-input-big" /></td>';
						}
						$str.='<td align="left"></td>';
						$str.='<td align="left"></td>';
						$str.='<td align="left"></td>';
						$str.='<td align="left"></td>';
						$str.='<td align="left"></td>';
					}
					else
					{
						$str.='<td align="left" colspan="2"><input name="new_court_fee_sts_'.$i.'" id="new_court_fee_sts_'.$i.'" value="0" type="hidden"><input name="court_fee_id_'.$i.'" id="court_fee_id_'.$i.'" value="0" type="hidden"><span style="float:left"><strong>No Court Fee For this type of case</strong></span><input style="float:left;width:100px" name="court_fee_amount_'.$i.'" type="hidden" id="court_fee_amount_'.$i.'" value="0" onkeypress="return numbersonly(event)" class="text-input-big" /></td>';
						$str.='<td align="left"><div style="float:left" id="branch_'.$i.'" name="branch_'.$i.'" style="padding-left: 3px"></div></td>';
						$str.='<td align="left"><div style="float:left" id="bank_'.$i.'" name="bank_'.$i.'" style="padding-left: 3px"></div></td>';
						$str.='<td align="left"><input type="text" name="dishonor_dt_'.$i.'" placeholder="dd/mm/yyyy" style="width:100px;float:left" id="dishonor_dt_'.$i.'" value="" ></td>';
						$str.='<td align="left"><input type="text" name="chq_number_'.$i.'" placeholder="" style="width:100px;float:left" id="chq_number_'.$i.'" value="" ></td>';
						$str.='<td align="left"><input type="text" name="chq_amount_'.$i.'" placeholder="" style="width:100px;float:left" id="chq_amount_'.$i.'" value="" ></td>';
					}
					$str.='</tr>';
				}
				else
				{
					$str.='<tr>';
					$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="event_id_'.$i.'" id="event_id_'.$i.'" value="'.$data->id.'"><input type="hidden" name="pre_legal_user_'.$i.'" id="pre_legal_user_'.$i.'" value="'.$data->legal_user.'"></td>';
					$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
					$str.='<td align="left">'.$data->sl_no.'</td>';
					$str.='<td align="left">'.$data->loan_segment.'</td>';
					$str.='<td align="left">'.$data->requisition_name.'</td>';
					$str.='<td align="left">'.$data->loan_ac.'</td>';
					$str.='<td align="left">'.$data->ac_name.'</td>';
					$str.='<td align="left">'.$data->region_name.'</td>';
					$str.='<td align="left">'.$data->territory_name.'</td>';
					$str.='<td align="left">'.$data->district_name.'</td>';
					$str.='<td align="left">'.$data->unit_office_name.'</td>';
					$str.='<td align="left">'.$data->rec_by.'</td>';
					$str.='<td align="left">'.$data->rec_dt.'</td>';
					$str.='</tr>';
				}
				
				$i++;
			}
			$str.='<input type="hidden" name="event_counter" id="event_counter" value="'.($i-1).'">';
			$str.='</tbody></table></div>';
			$str.='<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<tbody>';
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="12">Total Selected : <span id="selected_value">0</span></td></tr>';
		    $str.='</tbody></table>';
		}
		$var =array(
				"counter"=>$counter,
				"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function load_bulk_data_file()
	{
		$this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
	    $grid_data=array();
	    $operation= $this->input->post('operation_name');
	    if($operation=='blk_rf_main' || $operation=='blk_rf_recase')
	    {
	    	$grid_data=$this->Legal_file_process_model->load_bulk_data_file($operation);
	    }
	    if($operation=='blk_rf_approve_main' || $operation=='blk_rf_approve_recase')
	    {
	    	$grid_data=$this->Legal_file_process_model->load_bulk_data_file($operation);
	    }
		$str='';
		$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="10%" style="font-weight: bold;text-align:left">Req Type</th>
					<th width="15%" style="font-weight: bold;text-align:left">Loan A/C or Card No</th>
					<th width="10%" style="font-weight: bold;text-align:left">Protfolio</th>
					<th width="10%" style="font-weight: bold;text-align:left">Case Number</th>
					<th width="10%" style="font-weight: bold;text-align:left">Region</th>
					<th width="10%" style="font-weight: bold;text-align:left">Territory</th>
					<th width="10%" style="font-weight: bold;text-align:left">District</th>
					<th width="10%" style="font-weight: bold;text-align:left">Entry By</th>
					<th width="10%" style="font-weight: bold;text-align:left">Entry Date Time</th>
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
				$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$data->id.'"></td>';
				$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
				$str.='<td align="left">'.$data->request_type_name.'</td>';
				$str.='<td align="left">'.$data->loan_ac.'</td>';
				$str.='<td align="left">'.$data->loan_segment.'</td>';
				$str.='<td align="left">'.$data->case_number.'</td>';
				$str.='<td align="left">'.$data->region_name.'</td>';
				$str.='<td align="left">'.$data->territory_name.'</td>';
				$str.='<td align="left">'.$data->district_name.'</td>';
				$str.='<td align="left">'.$data->e_by.'</td>';
				$str.='<td align="left">'.$data->e_dt.'</td>';
				$str.='</tr>';				
				$i++;
			}
			$str.='<input type="hidden" name="event_counter" id="event_counter" value="'.($i-1).'">';
			$str.='</tbody></table></div>';
			$str.='<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<tbody>';
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="12">Total Selected : <span id="selected_value">0</span></td></tr>';
		    $str.='</tbody></table>';
		}
		$var =array(
				"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function load_bulk_data_recase()
	{
		$this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
	    $grid_data=$this->Legal_file_process_model->get_bulk_data_recase();
	    $operation= $this->input->post('operation');
	  
		$str='';
		$counter = 0;
		$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
			<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
				<thead>
					<th width="2%"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
					<th width="3%"  style="font-weight: bold;text-align:center">P</th>
					<th width="5%" style="font-weight: bold;text-align:left">Status</th>
					<th width="10%" style="font-weight: bold;text-align:left">Req Type</th>
					<th width="15%" style="font-weight: bold;text-align:left">Loan A/C or Card No</th>
					<th width="10%" style="font-weight: bold;text-align:left">Protfolio</th>
					<th width="10%" style="font-weight: bold;text-align:left">Case Number</th>
					<th width="10%" style="font-weight: bold;text-align:left">Region</th>
					<th width="10%" style="font-weight: bold;text-align:left">Territory</th>
					<th width="10%" style="font-weight: bold;text-align:left">District</th>
					<th width="10%" style="font-weight: bold;text-align:left">Entry By</th>
					<th width="10%" style="font-weight: bold;text-align:left">Entry Date Time</th>
				</thead>
				<tbody>';
		
	
		if(count($grid_data)<=0)
		{
			$str.='<tr><td colspan="12" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
			$str.='<input type="hidden" name="event_counter" id="event_counter" value="0">';
			$str.='</tbody></table></div>';
		}
		else{
			$i=1;
			foreach ($grid_data as $data) {
				$str.='<tr>';
				$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$data->id.'"></td>';
				$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
				$str.='<td align="left">'.$data->status.'</td>';
				$str.='<td align="left">'.$data->request_type_name.'</td>';
				$str.='<td align="left">'.$data->loan_ac.'</td>';
				$str.='<td align="left">'.$data->loan_segment.'</td>';
				$str.='<td align="left">'.$data->case_number.'</td>';
				$str.='<td align="left">'.$data->region_name.'</td>';
				$str.='<td align="left">'.$data->territory_name.'</td>';
				$str.='<td align="left">'.$data->district_name.'</td>';
				$str.='<td align="left">'.$data->e_by.'</td>';
				$str.='<td align="left">'.$data->e_dt.'</td>';
				$str.='</tr>';				
				$i++;
			}
			$str.='<input type="hidden" name="event_counter" id="event_counter" value="'.($i-1).'">';
			$str.='</tbody></table></div>';
			$str.='<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<tbody>';
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="12">Total Selected : <span id="selected_value">0</span></td></tr>';
		    $str.='</tbody></table>';
		}
		$var =array(
				"counter"=>$counter,
				"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_lawyer_email_phone()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$row=$this->Legal_file_process_model->get_lawyer_email_phone($this->input->post('id'));
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row;
		echo json_encode($var);
	}
	function calculate_court_fee()
	{
		$court_fee = 0;
		$case_claim_amount = $_POST['case_claim_amount'];
		$pre_set_data = $this->User_info_model->upr_config_row();
		$procurement = $pre_set_data->procurement;
		$fixed_court_fee = $pre_set_data->fixed_court_fee;

		//Court Fee Calculation
		$court_fee_25 = (($case_claim_amount/100)*2.5);
        $court_fee_15 = (($court_fee_25/100)*15);
        $actual_cost = ($court_fee_25+$court_fee_15);
        if ($actual_cost>$fixed_court_fee)
        {
            $actual_cost = $fixed_court_fee;
        }
        $court_fee = ($actual_cost+$procurement);
        
        $csrf_token=$this->security->get_csrf_hash();
		$var['csrf_token']=$csrf_token;
		$var['court_fee']=number_format($court_fee,2, '.', '');
		echo json_encode($var);
	}
	function get_add_input_data()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$row=$this->Legal_file_process_model->get_total_address($this->input->post('id'));
		$result=$this->Cma_process_model->get_add_action_data($this->input->post('id'));
		//Generating Legal Notice cost
		$district_array =array(3);
		if (in_array($result->case_fill_dist,$district_array))//Checking district is in dhaka
	  	{
	  		$field_name = "amount_in_dhaka";
	  	}else{
	  		$field_name = "amount_out_dhaka";
	  	}
		if($result->req_type==2)
		{
			$ln_cost = $this->Cma_process_model->get_ln_cost_amount('ref_schedule_charges_ara',$field_name,1);
			
		}
		else
		{
			$ln_cost = $this->Cma_process_model->get_ln_cost_amount('ref_schedule_charges_ni',$field_name,1);
		}
        $single_ln_cost = $ln_cost->amount;
        $lawyer_info=$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1 AND district="'.$result->case_fill_dist.'"');
		$var['csrf_token']=$csrf_token;
		$var['single_ln_cost']=$single_ln_cost;
		$var['total_address']=$row->total;
		$var['result']=$result;
		$var['lawyer_info']=$lawyer_info;
		echo json_encode($var);
	}
	function r_history()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$sah=$this->Legal_file_process_model->get_r_history($this->input->post('id'),$this->input->post('life_cycle'));
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
}
?>
