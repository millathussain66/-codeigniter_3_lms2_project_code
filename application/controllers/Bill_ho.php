<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bill_ho extends CI_Controller {
	public $del_right;
	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Bill_ho_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
		$this->load->model('User_model', '', TRUE);
		$this->load->model('Expenses_model', '', TRUE);
		$this->del_right = $this->db->query("SELECT id FROM users_right WHERE user_info_id=".$this->session->userdata['ast_user']['user_id']." AND menu_link_id=374 AND data_status=1")->row();
	}

	function view ($menu_group=NULL,$menu_cat=NULL,$sub_menue=NULL,$operation=NULL)
	{
		$expense_activities = array();
		if ($operation==NULL) {
			$operation = 'court_fee';
		}
		$add_edit='';$id="";
		$status = $this->db->query("SELECT * FROM ref_status where id IN(25,26,27,28,29,30,88,89,70)")->result();
		$data = array(
					'add_edit' => $add_edit,
					'id' => $id,
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'operation'=> $operation,
					'tax_vat_text' => $this->User_model->get_parameter_data('ref_tax_vat_text','id','data_status = 1'),
					'billing_month' => $this->User_model->get_parameter_data('ref_billing_month','id','data_status = 1'),
					'approver_list' => $this->User_model->get_parameter_data('ref_approver_list','name','data_status = 1'),
					'employee_type' => $this->User_model->get_parameter_data('ref_employee_type','name','data_status = 1'),
					'sub_menue'=> $sub_menue,
					'status'=> $status,
					'staff' => $this->Expenses_model->get_staff(),
					'legal_am' => $this->User_info_model->get_user_data('2'),
					'legal_region' => $this->User_model->get_parameter_data('ref_legal_region','name','data_status = 1'),
					'bank' => $this->User_model->get_parameter_data('ref_bank','name','data_status = 1'),
				    'payment_type' => $this->User_model->get_parameter_data('ref_payment_type','name','data_status = 1'),
				    'lawyer' => $this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
				    'return_type' => $this->User_model->get_parameter_data('ref_return_type','name','data_status = 1'),
				    'paper_vendor' => $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
					'district'=>$this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1'),
					'pages'=> 'bill_ho/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function download_pdf_court_fee($id=NULL){
		if(empty($id))
    	{
    		redirect('/e404');
    	}
		$details = $this->Bill_ho_model->get_xl_details_court_fee($id);
		$data = array( 'id'=>$id,'proposed_type'=>'','bulk'=>0,'details'=>$details );
		$this->load->view('bill_ho/pages/download_pdf_court_fee',$data);
	}
	function download_court_fee_memo($id=NULL)
    {
    	if(empty($id))
    	{
    		redirect('/e404');
    	}
    	$c_info = $this->user_model->get_client_info();
    	$details = $this->Bill_ho_model->get_xl_details_court_fee($id);
    	$bill_dt = '';
    	$vendor_type = '';
    	$tax_vat_text = '';
    	$vendor_name = '';
    	$dispatch_no = '';
    	$bank_ac = '';
    	$tin = '';
    	$district = '';
    	$e_by_name = '';
    	$e_by_pin = '';
    	$e_fun_deg = '';
    	$v_by_name = '';
    	$v_by_pin = '';
    	$v_fun_deg = '';
    	$date_f = '';
    	$bank_name = 'BRAC Bank PLC.';
    	$branch_name = '';
    	$ref_no = '';
    	if (!empty($details)) 
    	{
    		foreach($details as $key)
    		{
    			$vendor_type = $key->vendor_type;
    			$vendor_name = $key->vendor_name;
    			$bill_dt = $key->txrn_dt;
    			$dispatch_no = $key->dispatch_no;
    			$bank_ac = $key->bank_ac;
    			$tin = $key->tin_number;
    			$district = $key->district;
    			$e_by_name = $key->e_by_name;
		    	$e_by_pin = $key->e_by_pin;
		    	$e_fun_deg = $key->e_fun_deg;
		    	$tax_vat_text = $key->tax_vat_text;
		    	$v_by_name = $key->v_by_name;
		    	$v_by_pin = $key->v_by_pin;
		    	$v_fun_deg = $key->v_fun_deg;
		    	$ref_no = $key->ref_no;
    			$date_f = $key->date_f;
    			if ($key->bank_name!='') {
    				$bank_name = $key->bank_name;
    			}
    			$branch_name = $key->branch_name;
    			break;
    		}
    	}
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
	        $styleBorderOutlineTopButtom = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						),														
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineButtom = array(
				'borders' => array(											
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineTop = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleThinBlackBorderOutlineleft = array(
				'borders' => array(	
						'left'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)												
					),
				);
			$styleThinBlackBorderOutlineright = array(
				'borders' => array(	
						'right'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleNoneBorder = array(
				'borders' => array(	
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_NONE
						)											
					),
				);
			$styleArray = array(
		    'font'  => array(
		        'bold'  => true,
		        'size' => 10,
		        'color' => array('rgb' => 'FF0000'),
		        'name'  => 'Verdana'
		    ));
		    $styleArray2 = array(
		    'font'  => array(
		        'bold'  => true,
		        'size' => 14,
		        'name'  => 'Verdana'
		    ));
			
	       // $value=$row->OurCar.' '.number_format((float)$row->Amount,2,'.',',')."</br>".'deal with '.$row->cptyname.' at '.$row->Rate.'% rate';
		    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12); 
		    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(3);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
		    $objPHPExcel->getActiveSheet()->setShowGridlines(False);
		    // Excel Image insert 
		    $objDrawing = new PHPExcel_Worksheet_Drawing();
		    $objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$objDrawing->setPath('images/login_images/'.$c_info->project_client_logo);
			$objDrawing->setCoordinates('B2');
			$objDrawing->setHeight(300);
			$objDrawing->setWidth(200);
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
			//end

	    	$rowNumber = 1;
	    	$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
	    	$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++; 
	        $headings4 = array('Payment Approval Note','','Dispatch No.',$dispatch_no);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'E'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber+1));
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray2);
	        $objPHPExcel->getActiveSheet()->setCellValueExplicit(('H'.$rowNumber), $dispatch_no, PHPExcel_Cell_DataType::TYPE_STRING);
	        $rowNumber++; 
	        $headings4 = array('','','TIN No.',$tin);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'E'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
	        $rowNumber++;
	        $headings4 = array('Date','',':',date_format(new DateTime($bill_dt),"d-M-Y"));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        // $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Name of Lawyer','',':',$vendor_name);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('WO/PO Ref','',':','As per DOA','',$district,'');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Vendor Ref  No','',':',$ref_no,'',$date_f);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Purpose','',':',$vendor_type.' Bill','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':G'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $no_of_account = 0;
	        $total_amount = 0;
	        if (!empty($details)) 
	    	{
	    		foreach($details as $key)
	    		{
	    			$no_of_account+=$key->account_counter;
	    			$total_amount+=($key->amount-$key->discount_amount);
	    			if ($key->loan_segment=='S') {
	    				$headings4 = array('LITIGATION MGT.-SME','',':','10371295',number_format((float)$key->amount-$key->discount_amount,2),$key->account_counter,'');
				        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
				        $rowNumber++;
	    			}
	    			else if($key->loan_segment=='R')
	    			{
	    				$headings4 = array('LITIGATION MGT.-RETAIL','',':','10371296',number_format((float)$key->amount-$key->discount_amount,2),$key->account_counter,'');
				        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
				        $rowNumber++;
	    			}
	    			else if($key->loan_segment=='C')
	    			{
	    				$headings4 = array('CRM-SAM-CORP','',':','10311260',number_format((float)$key->amount-$key->discount_amount,2),$key->account_counter,'');
				        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
				        $rowNumber++;
	    			}
	    			
	    		}
	    	}
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Total No. Of A/C\'s','',':',$no_of_account,'','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Invoice Value (In Figure)','',':',number_format((float)$total_amount,2),'','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $amount_in_word = convert_number($total_amount)." Taka";
		    if(is_float($total_amount))
		    {
		    	$float_amount = explode(".",$total_amount);
			    if(count($float_amount)>1 && $float_amount[1]>0)
			    {
			    	$amount_in_word.=" And Paisa ";
			    	$amount_in_word.=convert_number($float_amount[1]);
			    }
		    }
	        $headings4 = array('Invoice Value (In Words)','',':',$amount_in_word.' Only','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Payment Break up','',':','','Amount BDT','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('F'.$rowNumber.':G'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('','',':','WO/PO Value','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $headings4 = array('','',':','Bill/Invoice amount',number_format((float)$total_amount,2),'','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $headings4 = array('','',':','Advance/Paid up to date','-','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $headings4 = array('','',':','Remaining (A-B-C)','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array($tax_vat_text,'','','','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Please Credit this amount Against','','',$bank_ac,$vendor_name,'');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.($rowNumber+1));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $objPHPExcel->getActiveSheet()->setCellValueExplicit(('E'.$rowNumber), $bank_ac, PHPExcel_Cell_DataType::TYPE_STRING);
	        $rowNumber++;
	        $headings4 = array('','','',$bank_name,$branch_name,'');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Initiated by ','','','','','Verified By','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;
	        $headings4 = array($e_by_name.' (PIN:'.$e_by_pin.')','','','','',$v_by_name.' (PIN:'.$v_by_pin.')','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array($e_fun_deg,'','','','',$v_fun_deg,'');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Legal & Recovery  Division ','','','','','Legal & Recovery  Division','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('','','','Approved by','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;
	        $headings4 = array('','','','Rasheed Ahmed (PIN-3979)','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('','','','Head of Legal & Recovery Division','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('For Finance','','','GL Name : Court Fee Stamps','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray);
	        $rowNumber++;
	        $headings4 = array('','','','GL No: 0000050630000026','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray);
	        $rowNumber++;

	        $headings4 = array('','','','Particulars','Amount TK','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;

	        $headings4 = array('','','','Bill/Invoice (Inc. VAT)','_','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;

	        $headings4 = array('','','','VAT (%)','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray);
	        $rowNumber++;
	        $headings4 = array('','','','Bill/Invoice (Excl. VAT)','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;
	        $headings4 = array('','','','Advance Income Tax','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;
	        $headings4 = array('','','','Net Pay ','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Checked by','','','','','Approved by','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        //$rowNumber++;
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
		    $objPHPExcel->setActiveSheetIndex(0);
		    $objPHPExcel->getActiveSheet()->setTitle('Bill Memo'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        ob_clean();
	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="BillMemo.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output');   
	        exit();
    

    }
    function download_staff_memo($id)
    {
    	$c_info = $this->user_model->get_client_info();
    	$details = $this->Bill_ho_model->get_xl_details_staff_conv($id);
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
	       // $value=$row->OurCar.' '.number_format((float)$row->Amount,2,'.',',')."</br>".'deal with '.$row->cptyname.' at '.$row->Rate.'% rate';
		    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12); 
		    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(15);
	    	$rowNumber = 1;
	        $headings4 = array('SL No.','Name','PIN','Bill Month',
	        'Region','District','BBL Salary Acount Number','Cell No.','Loc_Conv.[0000050630000010]',
	        'MTC_Allow[0000050630000010]','TA/DA/Accomodation(Official visit purposr)[0000050630000009]','TA/DA/Accomodation (Transfer Purpose) [0000050630000103]','Travelling [0000050630000130]',
	        'DA [0000050630000118]','Accommodation [0000050630000129]','Stationery[0000050630000120]','Photocopy[0000050630000120]',
	        'Courier[0000050630000005]','Miscelaneous[0000050630000077]','Cleaner[0000050630000037]','Security[0000050620000015]','Rep_maintance[0000050630000037]','Grand Total','Remarks');//,strtotime($dealdate)));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':H'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'C0C0C0')));
	        $objPHPExcel->getActiveSheet()->getStyle('I'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '92CDDC')));
	        $objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber.':O'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F79646')));
	        $objPHPExcel->getActiveSheet()->getStyle('P'.$rowNumber.':S'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FFFF00')));
	        $objPHPExcel->getActiveSheet()->getStyle('T'.$rowNumber.':V'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FFFF99')));
	        $objPHPExcel->getActiveSheet()->getStyle('W'.$rowNumber.':W'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '99CCFF')));
	        $objPHPExcel->getActiveSheet()->getStyle('X'.$rowNumber.':X'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FABF8F')));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->applyFromArray($styleArray_border);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setWrapText(true);
	        $rowNumber++;  
	        $sn=0;
	        $amount = 0;
	        if (!empty($details)) 
	    	{
	    		$total1="";
	    		$total2="";
	    		$total3="";
	    		$total4="";
	    		$total5="";
	    		$total6="";
	    		$total7="";
	    		$total8="";
	    		$total9="";
	    		$total10="";
	    		$total11="";
	    		$total12="";
	    		$total13="";
	    		$total14="";
	    		$total15="";
	    		$total16="";
	    		foreach($details as $row)
	    		{
	    			$sn++;
	    			$amount = $amount+$row->amount;
				    if($row->conv_type==1)
				    {
				    	$total1=$total1+$row->amount;
				    }
				    else if($row->conv_type==3)
				    {
				    	$total3=$total3+$row->amount;
				    }
				    else if($row->conv_type==4)
				    {
				    	$total4=$total4+$row->amount;
				    }
				    else if($row->conv_type==5)
				    {
				    	$total5=$total5+$row->amount;
				    }
	    			$objPHPExcel->getActiveSheet()->fromArray(array(
                        $sn,
                        $row->staff_name,
                        $row->staff_pin,
                        $row->billing_month.'\''.$row->year,
                        $row->region,
                        $row->district_name,
                        $row->bank_ac,
                        $row->mobile_number,
                        ($row->conv_type==1)?$row->amount:'',
                        ($row->conv_type==3)?$row->amount:'',
                        '',
                        ($row->conv_type==2)?$row->amount:'',
                        ($row->conv_type==4)?$row->amount:'',
                        '',
                        ($row->conv_type==5)?$row->amount:'',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        $row->amount,
                        ''
                        ),NULL,'A'.$rowNumber);
	    			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('G'.$rowNumber), $row->account_number, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->applyFromArray($styleArray_border);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setWrapText(true);
			        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    
                    $rowNumber++;
	    		}
	    	}
	    	$headings1 = array('','GRAND  TOTAL: ','','','','','','',$total1,$total2,$total3,$total4,$total5,$total6,$total7,$total8,$total9,$total11,$total12,$total13,$total14,$total15,$amount,'');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':H'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'C0C0C0')));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
		    $objPHPExcel->setActiveSheetIndex(0);
		    $objPHPExcel->getActiveSheet()->setTitle('Staff Conveyence Memo'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        ob_clean();
	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="StaffConv.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output');   
	        exit();
    

    }
    function download_pdf_lawyer_bill($id){
		$details = $this->Bill_ho_model->get_xl_details_lawyer_bill($id);
		$data = array( 'id'=>$id,'proposed_type'=>'','bulk'=>0,'details'=>$details );
		$this->load->view('bill_ho/pages/download_pdf_lawyer_bill',$data);
	}
    function download_lawyer_bill_memo($id)
    {
    	$c_info = $this->user_model->get_client_info();
    	$details = $this->Bill_ho_model->get_xl_details_lawyer_bill($id);

    	$bill_dt = '';
    	$vendor_type = '';
    	$vendor_name = '';
    	$dispatch_no = '';
    	$bank_ac = '';
    	$tax_vat_text = '';
    	$tin = '';
    	$district = '';
    	$e_by_name = '';
    	$e_by_pin = '';
    	$e_fun_deg = '';
    	$v_by_name = '';
    	$v_by_pin = '';
    	$v_fun_deg = '';
    	$ref_no = '';
    	$bank_name = 'BRAC Bank PLC.';
    	$branch_name = '';
    	$date_f = '';


		$special_bill_sts = '';
		$memo_remarks = '';

    	if (!empty($details)) 
    	{
    		foreach($details as $key)
    		{
    			$vendor_type = $key->vendor_type;
    			$vendor_name = $key->vendor_name;
    			$bill_dt = $key->txrn_dt;
    			$dispatch_no = $key->dispatch_no;
    			$bank_ac = $key->bank_ac;
    			$district = $key->district;
    			$e_by_name = $key->e_by_name;
		    	$e_by_pin = $key->e_by_pin;
		    	$e_fun_deg = $key->e_fun_deg;
		    	$tin = $key->tin_number;
		    	$tax_vat_text = $key->tax_vat_text;
		    	$v_by_name = $key->v_by_name;
		    	$v_by_pin = $key->v_by_pin;
		    	$v_fun_deg = $key->v_fun_deg;
    			$ref_no = $key->ref_no;
    			$date_f = $key->date_f;
				$memo_remarks = $key->memo_remarks;
				$special_bill_sts = $key->special_bill_sts;
		

    			if ($key->bank_name!='') {
    				$bank_name = $key->bank_name;
    			}
    			$branch_name = $key->branch_name;
    			break;
    		}
    	}
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
	        $styleBorderOutlineTopButtom = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						),														
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineButtom = array(
				'borders' => array(											
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineTop = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleThinBlackBorderOutlineleft = array(
				'borders' => array(	
						'left'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)												
					),
				);
			$styleThinBlackBorderOutlineright = array(
				'borders' => array(	
						'right'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleNoneBorder = array(
				'borders' => array(	
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_NONE
						)											
					),
				);
			$styleArray = array(
		    'font'  => array(
		        'bold'  => true,
		        'size' => 10,
		        'color' => array('rgb' => 'FF0000'),
		        'name'  => 'Verdana'
		    ));
		    $styleArray2 = array(
		    'font'  => array(
		        'bold'  => true,
		        'size' => 14,
		        'name'  => 'Verdana'
		    ));
			
	       // $value=$row->OurCar.' '.number_format((float)$row->Amount,2,'.',',')."</br>".'deal with '.$row->cptyname.' at '.$row->Rate.'% rate';
		    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12); 
		    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(3);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
		    $objPHPExcel->getActiveSheet()->setShowGridlines(False);
		    // Excel Image insert 
		    $objDrawing = new PHPExcel_Worksheet_Drawing();
		    $objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$objDrawing->setPath('images/login_images/'.$c_info->project_client_logo);
			$objDrawing->setCoordinates('B2');
			$objDrawing->setHeight(300);
			$objDrawing->setWidth(200);
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
			//end

	    	$rowNumber = 1;
	    	$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
	    	$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++; 
	        $headings4 = array('Payment Approval Note','','Dispatch No.',$dispatch_no);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'E'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber+1));
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray2);
	        $objPHPExcel->getActiveSheet()->setCellValueExplicit(('H'.$rowNumber), $dispatch_no, PHPExcel_Cell_DataType::TYPE_STRING);
	        $rowNumber++; 
	        $headings4 = array('','','TIN No.',$tin);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'E'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
	        $rowNumber++;
	        $headings4 = array('Date','',':',date_format(new DateTime($bill_dt),"d-M-Y"));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        // $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Name of Lawyer','',':',$vendor_name);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('WO/PO Ref','',':','As per DOA','',$district,'');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Vendor Ref  No','',':',$ref_no,'',$date_f);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Purpose','',':',$vendor_type.' Bill','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':G'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $no_of_account = 0;
	        $total_amount = 0;
	        if (!empty($details)) 
	    	{
	    		foreach($details as $key)
	    		{
	    			$no_of_account+=$key->account_counter;
	    			$total_amount+=($key->amount-$key->discount_amount);
	    			if ($key->loan_segment=='S') {
	    				$headings4 = array('LITIGATION MGT.-SME','',':','10371295',number_format((float)$key->amount-$key->discount_amount,2),$key->account_counter,'');
				        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
				        $rowNumber++;
	    			}
	    			else if($key->loan_segment=='R')
	    			{
	    				$headings4 = array('LITIGATION MGT.-RETAIL','',':','10371296',number_format((float)$key->amount-$key->discount_amount,2),$key->account_counter,'');
				        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
				        $rowNumber++;
	    			}
	    			else if($key->loan_segment=='C')
	    			{
	    				$headings4 = array('CRM-SAM-CORP','',':','10311260',number_format((float)$key->amount-$key->discount_amount,2),$key->account_counter,'');
				        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
				        $rowNumber++;
	    			}
	    			
	    		}
	    	}
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Total No. Of A/C\'s','',':',$no_of_account,'','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Invoice Value (In Figure)','',':',number_format((float)$total_amount,2),'','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $amount_in_word = convert_number($total_amount)." Taka";
		    if(is_float($total_amount))
		    {
		    	$float_amount = explode(".",$total_amount);
			    if(count($float_amount)>1 && $float_amount[1]>0)
			    {
			    	$amount_in_word.=" And Paisa ";
			    	$amount_in_word.=convert_number($float_amount[1]);
			    }
		    }
	        $headings4 = array('Invoice Value (In Words)','',':',$amount_in_word.' Only','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Payment Break up','',':','','Amount BDT','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('F'.$rowNumber.':G'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('','',':','WO/PO Value','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $headings4 = array('','',':','Bill/Invoice amount',number_format((float)$total_amount,2),'','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $headings4 = array('','',':','Advance/Paid up to date','-','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $headings4 = array('','',':','Remaining (A-B-C)','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array($tax_vat_text,'','','','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Please Credit this amount Against','','',$bank_ac,$vendor_name,'');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.($rowNumber+1));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $objPHPExcel->getActiveSheet()->setCellValueExplicit(('E'.$rowNumber), $bank_ac, PHPExcel_Cell_DataType::TYPE_STRING);
	        $rowNumber++;
	        $headings4 = array('','','',$bank_name,$branch_name,'');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;



			// Add New Workd

			if($special_bill_sts==1){

				$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				$rowNumber++;
				$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				$rowNumber++;
				
				$headings4 = array('Note : '.$memo_remarks,'','','','','','');
				$objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
				$objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':H'.$rowNumber);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				$rowNumber++;
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				$rowNumber++;
			}







	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);


	        $rowNumber++;
	        $headings4 = array('Initiated by ','','','','','Verified By','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;



	        $headings4 = array('Krishna Gopal Kundu (PIN:25205)','','','','','Sabbir Abedin (PIN:4402)','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Officer,Litigation Management','','','','','Sr.Manager,Litigation Management','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Legal & Recovery  Division ','','','','','Legal & Recovery  Division','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;





			if($special_bill_sts==1){



				$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;





							
		        $headings4 = array('Supported By','','','','','Recommended By','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
		        $rowNumber++;

		        $headings4 = array('Mustafizur Rahman (PIN-26017)','','','','','Rasheed Ahmed (PIN-3979)','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('Head Of Litigation Management Department','','','','','Head of Legal & Recovery Division','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('Legal & Recovery Division','','','','','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;





				$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;





							
		        $headings4 = array('Recommended By','','','','','Recommended By','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
		        $rowNumber++;

		        $headings4 = array('Tareq Refat Ullah Khan (PIN-25344)','','','','','Syed Abdul Momen (PIN-1441)','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('DMD And Head Of corporate Banking Division','','','','','DMD And Head Of SME Banking','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('Legal & Recovery Division','','','','','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;

		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('','','','Approved by','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
		        $rowNumber++;
		        $headings4 = array('','','','Selim R.F. Hossain (PIN-23500)','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('','','','Managing Director & CEO','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;

			}
			else
			{
				$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('','','','Approved by','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
		        $rowNumber++;
		        $headings4 = array('','','','Rasheed Ahmed (PIN-3979)','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('','','','Head of Legal & Recovery Division','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
			}



	        
	        $headings4 = array('For Finance','','','GL Name : Legal Expense Loan Recovery','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray);
	        $rowNumber++;
	        $headings4 = array('','','','GL No : 630000027','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray);
	        $rowNumber++;

	        $headings4 = array('','','','Particulars','Amount TK','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;

	        $headings4 = array('','','','Bill/Invoice (Inc. VAT)','_','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;

	        $headings4 = array('','','','VAT (%)','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray);
	        $rowNumber++;
	        $headings4 = array('','','','Bill/Invoice (Excl. VAT)','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;
	        $headings4 = array('','','','Advance Income Tax','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;
	        $headings4 = array('','','','Net Pay ','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Checked by','','','','','Approved by','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        //$rowNumber++;
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
		    $objPHPExcel->setActiveSheetIndex(0);
	     
		    $objPHPExcel->getActiveSheet()->setTitle('Bill Memo'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        ob_clean();
	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="BillMemo.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output');   
	        exit();
    

    }
    function download_pdf_paper_bill($id){
		$details = $this->Bill_ho_model->get_xl_details_paper_bill($id);
		$data = array( 'id'=>$id,'proposed_type'=>'','bulk'=>0,'details'=>$details );
		$this->load->view('bill_ho/pages/download_pdf_paper_bill',$data);
	}
    function download_paper_bill_memo($id)
    {
    	$c_info = $this->user_model->get_client_info();
    	$details = $this->Bill_ho_model->get_xl_details_paper_bill($id);
    	$bill_dt = '';
    	$vendor_type = '';
    	$vendor_name = '';
    	$dispatch_no = '';
    	$bank_ac = '';
    	$tin = '';
    	$tax_vat_text = '';
    	$district = '';
    	$e_by_name = '';
    	$e_by_pin = '';
    	$e_fun_deg = '';
    	$v_by_name = '';
    	$v_by_pin = '';
    	$v_fun_deg = '';
    	$date_f = '';
    	$ref_no = '';
    	$bank_name = 'BRAC Bank PLC.';
    	$branch_name = '';


		$special_bill_sts = '';
		$memo_remarks = '';
    	if (!empty($details)) 
    	{
    		foreach($details as $key)
    		{
    			$vendor_type = $key->vendor_type;
    			$vendor_name = $key->vendor_name;
    			$bill_dt = $key->txrn_dt;
    			$dispatch_no = $key->dispatch_no;
    			$bank_ac = $key->bank_ac;
    			$district = $key->district_name;
    			$e_by_name = $key->e_by_name;
		    	$e_by_pin = $key->e_by_pin;
		    	$e_fun_deg = $key->e_fun_deg;
		    	$tax_vat_text = $key->tax_vat_text;
		    	$v_by_name = $key->v_by_name;
		    	$v_by_pin = $key->v_by_pin;
		    	$v_fun_deg = $key->v_fun_deg;
		    	$ref_no = $key->ref_no;
		    	$tin = $key->tin;
		    	$date_f = $key->date_f;
				$memo_remarks = $key->memo_remarks;
				$special_bill_sts = $key->special_bill_sts;
		
    			if ($key->bank_name!='') {
    				$bank_name = $key->bank_name;
    			}
    			$branch_name = $key->branch_name;
    			break;
    		}
    	}
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
	        $styleBorderOutlineTopButtom = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						),														
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineButtom = array(
				'borders' => array(											
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineTop = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleThinBlackBorderOutlineleft = array(
				'borders' => array(	
						'left'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)												
					),
				);
			$styleThinBlackBorderOutlineright = array(
				'borders' => array(	
						'right'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleNoneBorder = array(
				'borders' => array(	
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_NONE
						)											
					),
				);
			$styleArray = array(
		    'font'  => array(
		        'bold'  => true,
		        'size' => 10,
		        'color' => array('rgb' => 'FF0000'),
		        'name'  => 'Verdana'
		    ));
		    $styleArray2 = array(
		    'font'  => array(
		        'bold'  => true,
		        'size' => 14,
		        'name'  => 'Verdana'
		    ));
			
	       // $value=$row->OurCar.' '.number_format((float)$row->Amount,2,'.',',')."</br>".'deal with '.$row->cptyname.' at '.$row->Rate.'% rate';
		    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12); 
		    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(3);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
		    $objPHPExcel->getActiveSheet()->setShowGridlines(False);
		    // Excel Image insert 
		    $objDrawing = new PHPExcel_Worksheet_Drawing();
		    $objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$objDrawing->setPath('images/login_images/'.$c_info->project_client_logo);
			$objDrawing->setCoordinates('B2');
			$objDrawing->setHeight(300);
			$objDrawing->setWidth(200);
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
			//end

	    	$rowNumber = 1;
	    	$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
	    	$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++; 
	        $headings4 = array('Payment Approval Note','','Dispatch No.',$dispatch_no);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'E'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber+1));
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->setCellValueExplicit(('H'.$rowNumber), $dispatch_no, PHPExcel_Cell_DataType::TYPE_STRING);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray2);
	        $rowNumber++; 
	        $headings4 = array('','','TIN No.',$tin);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'E'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
	        $rowNumber++;
	        $headings4 = array('Date','',':',date_format(new DateTime($bill_dt),"d-M-Y"));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        // $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Name of Vendor','',':',$vendor_name);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('WO/PO Ref','',':','As per DOA','',$district,'');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Vendor Ref  No','',':',$ref_no,'',$date_f);
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Purpose','',':',$vendor_type.' Bill','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':G'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $no_of_account = 0;
	        $total_amount = 0;
	        if (!empty($details)) 
	    	{
	    		foreach($details as $key)
	    		{
	    			$no_of_account+=$key->account_counter;
	    			$total_amount+=($key->amount-$key->discount_amount);
	    			if ($key->loan_segment=='S') {
	    				$headings4 = array('LITIGATION MGT.-SME','',':','10371295',number_format((float)$key->amount-$key->discount_amount,2),$key->account_counter,'');
				        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
				        $rowNumber++;
	    			}
	    			else if($key->loan_segment=='R')
	    			{
	    				$headings4 = array('LITIGATION MGT.-RETAIL','',':','10371296',number_format((float)$key->amount-$key->discount_amount,2),$key->account_counter,'');
				        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
				        $rowNumber++;
	    			}
	    			else if($key->loan_segment=='C')
	    			{
	    				$headings4 = array('CRM-SAM-CORP','',':','10311260',number_format((float)$key->amount-$key->discount_amount,2),$key->account_counter,'');
				        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
				        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber)->applyFromArray($styleArray_border);
				    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
				        $rowNumber++;
	    			}
	    			
	    		}
	    	}
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Total No. Of A/C\'s','',':',$no_of_account,'','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Invoice Value (In Figure)','',':',number_format((float)$total_amount,2),'','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $amount_in_word = convert_number($total_amount)." Taka";
		    if(is_float($total_amount))
		    {
		    	$float_amount = explode(".",$total_amount);
			    if(count($float_amount)>1 && $float_amount[1]>0)
			    {
			    	$amount_in_word.=" And Paisa ";
			    	$amount_in_word.=convert_number($float_amount[1]);
			    }
		    }
	        $headings4 = array('Invoice Value (In Words)','',':',$amount_in_word.' Only','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Payment Break up','',':','','Amount BDT','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('F'.$rowNumber.':G'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('','',':','WO/PO Value','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $headings4 = array('','',':','Bill/Invoice amount',number_format((float)$total_amount,2),'','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $headings4 = array('','',':','Advance/Paid up to date','-','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $headings4 = array('','',':','Remaining (A-B-C)','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':C'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleArray_border);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('This payable amount is  subject to  AIT &  VAT  and  other deductions  (If applicable)','','','','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Please Credit this amount Against','','',$bank_ac,$vendor_name,'');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.($rowNumber+1));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $objPHPExcel->getActiveSheet()->setCellValueExplicit(('E'.$rowNumber), $bank_ac, PHPExcel_Cell_DataType::TYPE_STRING);
	        $rowNumber++;
	        $headings4 = array('','','',$bank_name,$branch_name,'');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;



			

			// Add New Workd

			if($special_bill_sts==1){

				$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				$rowNumber++;
				$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				$rowNumber++;
				
				$headings4 = array('Note : '.$memo_remarks,'','','','','','');
				$objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
				$objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':H'.$rowNumber);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				$rowNumber++;
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
				$rowNumber++;
			}








	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Initiated by ','','','','','Verified By','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;
	        $headings4 = array('Krishna Gopal Kundu (PIN:25205)','','','','','Sabbir Abedin (PIN:4402)','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Officer,Litigation Management','','','','','Sr.Manager,Litigation Management','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Legal & Recovery  Division ','','','','','Legal & Recovery  Division','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;



			

			if($special_bill_sts==1){



				$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;





							
		        $headings4 = array('Supported By','','','','','Recommended By','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
		        $rowNumber++;

		        $headings4 = array('Mustafizur Rahman (PIN-26017)','','','','','Rasheed Ahmed (PIN-3979)','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('Head Of Litigation Management Department','','','','','Head of Legal & Recovery Division','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('Legal & Recovery Division','','','','','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;





				$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;





							
		        $headings4 = array('Recommended By','','','','','Recommended By','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
		        $rowNumber++;

		        $headings4 = array('Tareq Refat Ullah Khan (PIN-25344)','','','','','Syed Abdul Momen (PIN-1441)','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('DMD And Head Of corporate Banking Division','','','','','DMD And Head Of SME Banking','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('Legal & Recovery Division','','','','','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;

		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('','','','Approved by','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
		        $rowNumber++;
		        $headings4 = array('','','','Selim R.F. Hossain (PIN-23500)','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('','','','Managing Director & CEO','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;

			}
			else
			{
				$objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('','','','Approved by','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
		        $rowNumber++;
		        $headings4 = array('','','','Rasheed Ahmed (PIN-3979)','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $headings4 = array('','','','Head of Legal & Recovery Division','','');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
		        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
		        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
		    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
		        $rowNumber++;
			}
	


	        $headings4 = array('For Finance','','','GL Name : Legal Notice Publication','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray);
	        $rowNumber++;
	        $headings4 = array('','','','GL No : 630000139','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray);
	        $rowNumber++;

	        $headings4 = array('','','','Particulars','Amount TK','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;

	        $headings4 = array('','','','Bill/Invoice (Inc. VAT)','_','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;

	        $headings4 = array('','','','VAT (%)','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->applyFromArray($styleArray);
	        $rowNumber++;
	        $headings4 = array('','','','Bill/Invoice (Excl. VAT)','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;
	        $headings4 = array('','','','Advance Income Tax','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $rowNumber++;
	        $headings4 = array('','','','Net Pay ','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	    	$objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getRowDimension($rowNumber)->setRowHeight(8);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	        $rowNumber++;
	        $headings4 = array('Checked by','','','','','Approved by','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'B'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('G'.$rowNumber.':H'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineleft);
	    	$objPHPExcel->getActiveSheet()->getStyle('H'.$rowNumber)->applyFromArray($styleThinBlackBorderOutlineright);
	    	$objPHPExcel->getActiveSheet()->getStyle('G'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':D'.$rowNumber)->applyFromArray($styleBorderOutlineTop);
	        //$rowNumber++;
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':H'.$rowNumber)->applyFromArray($styleBorderOutlineButtom);
		    $objPHPExcel->setActiveSheetIndex(0);
	       
		    $objPHPExcel->getActiveSheet()->setTitle('Bill Memo'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        ob_clean();
	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="BillMemo.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output');   
	        exit();
    

    }
    function download_court_enter_topsheet($id)
    {
    	$c_info = $this->user_model->get_client_info();
    	$details = $this->Bill_ho_model->get_xl_details_court_enter($id);
    	$row_details = $this->Bill_ho_model->get_row_details_court($id);
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
	        $styleArray_border2 = array(
              'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_MEDIUM
                  )
              )
          ); 
	        $styleArray_border3 = array(
              'borders' => array(
                  'top' => array(
                      'style' => PHPExcel_Style_Border::BORDER_MEDIUM
                  )
              )
          ); 
	        $styleArray_border4 = array(
              'borders' => array(
                  'left' => array(
                      'style' => PHPExcel_Style_Border::BORDER_MEDIUM
                  )
              )
          ); 
	        $styleArray_border5 = array(
              'borders' => array(
                  'right' => array(
                      'style' => PHPExcel_Style_Border::BORDER_MEDIUM
                  )
              )
          ); 
	        $styleArray_border6 = array(
              'borders' => array(
                  'bottom' => array(
                      'style' => PHPExcel_Style_Border::BORDER_MEDIUM
                  )
              )
          ); 
	        $objDrawing = new PHPExcel_Worksheet_Drawing();
		    $objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$objDrawing->setPath('images/login_images/'.$c_info->project_client_logo);
			$objDrawing->setCoordinates('A1');
			$objDrawing->setHeight(200);
			$objDrawing->setWidth(150);
			$objDrawing->setOffsetX(20);                            // set x position 
			$objDrawing->setOffsetY(5); 
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
		    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(8);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
	    	$rowNumber = 1;
	        $headings1 = array('Court Entertainment Bill of Litigation Management');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':L'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(16);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
	        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
	        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border5);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border2);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'C6E0B4')));
	        $rowNumber++;
	        $headings4 = array('SL No.','Name','PIN','Functional Designation',
	        'Grade','Cell Number','Account Number','Base Office','Region','Billing Month','Entertainment Bill','Remarks');//,strtotime($dealdate)));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border5);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FCD5B4')));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;  
	        $sn=0;
	        $amount = 0;
	        if (!empty($details)) 
	    	{
	    		foreach($details as $row)
	    		{
	    			$sn++;
	    			$amount = $amount+$row->amount;
				    
	    			$objPHPExcel->getActiveSheet()->fromArray(array(
                        $sn,
                        $row->vendor_name,
                        $row->vendor_pin,
                        $row->functional_desig,
                        $row->job_grade,
                        $row->mobile_no,
                        $row->account_number,
                        $row->base_office_name,
                        $row->legal_region,
                        $row->billing_month,
                        number_format((float)$row->amount,2),
                        ''
                        ),NULL,'A'.$rowNumber);
	    			$objPHPExcel->getActiveSheet()->setCellValueExplicit(('G'.$rowNumber), $row->account_number, PHPExcel_Cell_DataType::TYPE_STRING);
	        		$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border);
	        		$objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border5);
                   
                    $rowNumber++;
	    		}
	    	}
	    	$headings1 = array('Total Amount : ','','','','','','','','','',number_format((float)$amount,2));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setBold(true);
	        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border5);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	        $objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber.':K'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $rowNumber++;
	        $headings1 = array('Total Amount In word: : '.convert_number($amount));
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':L'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setBold(true);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border2);
	        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border5);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border5);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border5);
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border5);
	        $rowNumber++;

	        $headings1 = array('Prepared By','','','','','Checked By','','','Approved By','','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':E'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('F'.$rowNumber.':H'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('I'.$rowNumber.':L'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border3);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleArray_border4);
	        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border5);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setBold(true);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $rowNumber++;
	        $headings1 = array($row_details->memo_e_by,'','','','',$row_details->v_by,'','','Barrister Rasheed Ahmed (3979)','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':E'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('F'.$rowNumber.':H'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('I'.$rowNumber.':L'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleArray_border4);
	        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border5);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setBold(true);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $rowNumber++;
	        $headings1 = array($row_details->memo_e_desig,'','','','',$row_details->memo_v_desig,'','','Head of Legal & Recovery Division','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':E'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('F'.$rowNumber.':H'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('I'.$rowNumber.':L'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleArray_border4);
	        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border5);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setBold(true);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $rowNumber++;
	        $headings1 = array('Legal & Recovery  Division','','','','','Legal & Recovery  Division','','','Legal & Recovery  Division','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':E'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('F'.$rowNumber.':H'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->mergeCells('I'.$rowNumber.':L'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':A'.$rowNumber)->applyFromArray($styleArray_border4);
	        $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border5);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->applyFromArray($styleArray_border6);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setBold(true);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $rowNumber++;
		    $objPHPExcel->setActiveSheetIndex(0);
		    $objPHPExcel->getActiveSheet()->setTitle('Court Ent. Bill Memo-HO'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        ob_clean();
	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="CourtEntertainment.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output');   
	        exit();
    

    }
    function download_court_enter_memo($id)
    {
    	$c_info = $this->user_model->get_client_info();
    	$details = $this->Bill_ho_model->get_row_details_court($id);
		$expense = $this->Bill_ho_model->get_expenese_details_court($id);
    	$bank_name = 'BRAC Bank PLC.';
    	
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
	        $styleBorderOutlineTopButtom = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						),														
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineButtom = array(
				'borders' => array(											
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineTop = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleThinBlackBorderOutlineleft = array(
				'borders' => array(	
						'left'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)												
					),
				);
			$styleThinBlackBorderOutlineright = array(
				'borders' => array(	
						'right'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleNoneBorder = array(
				'borders' => array(	
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_NONE
						)											
					),
				);
			$styleArray = array(
		    	'font'  => array(
		        'bold'  => true,
		        'size' => 16,
		        'color' => array('rgb' => '808080')
		    ));
		    $styleArray2 = array(
		    	'font'  => array(
		        'bold'  => true,
		        'size' => 14,
		        'name'  => 'Verdana'
		    ));
			
	       // $value=$row->OurCar.' '.number_format((float)$row->Amount,2,'.',',')."</br>".'deal with '.$row->cptyname.' at '.$row->Rate.'% rate';
		    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); 
		    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
		    //$objPHPExcel->getActiveSheet()->setShowGridlines(False);
		    // Excel Image insert 
		    $objDrawing = new PHPExcel_Worksheet_Drawing();
		    $objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$objDrawing->setPath('images/login_images/'.$c_info->project_client_logo);
			$objDrawing->setCoordinates('A2');
			$objDrawing->setHeight(300);
			$objDrawing->setWidth(200);
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
			//end

	    	$rowNumber = 1;
	        $rowNumber++; 
	        $headings4 = array('Reimbursement Requisition Form');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('D'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(16);
	        //$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray);

	        $rowNumber++; 
	        $rowNumber++; 
	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('PIN No',$details->staff_pin),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Billing Month',$details->billing_month),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));

	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('Name',$details->employee_name),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Mobile Number',$details->mobile_no),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));

	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('Designation',$details->func_desig),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Account Number',$details->account_number),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->setCellValueExplicit(('E'.$rowNumber), $details->account_number, PHPExcel_Cell_DataType::TYPE_STRING);
	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('Department',$details->employee_type),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Unit/Branch Name',$details->base_office_name),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	        $objPHPExcel->getActiveSheet()->getStyle('A5:F'.$rowNumber)->applyFromArray($styleArray_border);
		    $objPHPExcel->getActiveSheet()->getStyle('A5:A'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'EBF1DE')));
		    $objPHPExcel->getActiveSheet()->getStyle('D5:D'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'EBF1DE')));

	        $rowNumber++;
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->fromArray(array('Accounts Head'),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $headings9 = array('Particulars','Expended','Limit','Reimbursed');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings9),NULL,'C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 

		    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'EBF1DE')));

	        $rowNumber++;
	        $data = array('Local Conveyance','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Local Conveyance/Daily Court Allowance','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Motorcycle Allowance ( None_EMI)','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Travel- (Meeting/Training/Others) Accommodation/DA/TA/Conveyance/Others','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Court Entertainment','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $total = 0;
	        
	        foreach ($expense as $key) 
	        {
	        	$total = $total+$key->amount;
	        	$data = array($key->activities_name,'',$key->remarks,number_format((float)$key->amount,2),'','');
	        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
		        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $rowNumber++;
	        }
	        $data = array('Business Promotion:','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Entertainment of Guest/Judge/Magistrate/Others','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Business Development','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Others (Specify):','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Repair & Maintenance','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Paper & Stationery','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Utility/Courier/Printing/Postage/Others','','','','','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $rowNumber++;
	        $amount_in_word = convert_number($total);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Total Taka: '.$amount_in_word,'','',number_format((float)$total,2)),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
		    $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		    $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $data = array('','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('A10:F'.$rowNumber)->applyFromArray($styleArray_border);

	        $rowNumber++;
	        $rowNumber++;
	        $rowNumber++;
	        $rowNumber++;
	        $rowNumber++;
	        $authorize = array('Initiator signing Details','Legal checker signing details ','Recommended By:','Recommended By:','Approved By:');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        $authorize = array('Name: '.$details->e_by_name,'Name: '.$details->v_by_name,'Md. Sabbir Abedin','','Rasheed Ahmed');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        $authorize = array('PIN: '.$details->e_by_pin,'PIN: '.$details->v_by_pin,'PIN:4402','','PIN:3979');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        $authorize = array($details->e_by_desig,$details->v_by_desig.',Litigation Mgt.','Sr. Manager-Litigation Mgt, HO','','Head of Legal & Recovery');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        
		    $objPHPExcel->setActiveSheetIndex(0);
		    $objPHPExcel->getActiveSheet()->setTitle('Reimbursement New'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        ob_clean();
	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="Reimbursement.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output');   
	        exit();
    

    }
	function get_am_data()
    {
    	$csrf_token = $this->security->get_csrf_hash();
    	$id = $this->input->post('id');
		$sah=$this->User_info_model->get_user_data('4'," users_info.id='".$id."'");
        $jTableResult = array();
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
    function court_return_grid()
	{
		$this->load->model('Bill_ho_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_ho_model->court_return_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function court_adjust_grid()
	{
		$this->load->model('Bill_ho_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_ho_model->court_adjust_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
    function staff_grid()
	{
		$this->load->model('Bill_ho_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_ho_model->get_grid_data_staff($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function court_grid()
	{
		$this->load->model('Bill_ho_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_ho_model->get_grid_data_court($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function lawyer_grid()
	{
		$this->load->model('Bill_ho_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_ho_model->get_grid_data_lawyer($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function lawyer_hc_grid()
	{
		$this->load->model('Bill_ho_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_ho_model->get_grid_data_lawyer_hc($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function court_fee_grid()
	{
		$this->load->model('Bill_ho_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_ho_model->get_grid_data_court_fee($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function paper_bill_grid()
	{
		$this->load->model('Bill_ho_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_ho_model->get_grid_data_paper_bill($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function other_bill_grid()
	{
		$this->load->model('Bill_ho_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_ho_model->get_grid_data_other_bill($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function form($add_edit,$edit_id=NULL,$editrow=NULL)
	{
		$details=array();
		$result = array();
		$bill_details=array();
		if ($add_edit=='edit') {
			$result = $this->Bill_ho_model->get_add_action_data($edit_id);
			$bill_details = $this->Bill_ho_model->get_bill_details($result->bill_type,$result->vendor,$result->vendor_name);
		}
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'bill_details' => $bill_details,
				   'add_edit' => $add_edit,
				   'edit_id' => $edit_id,
				   'legal_am' => $this->User_info_model->get_user_data('2'),
				   'approver_list' => $this->User_model->get_parameter_data('ref_approver_list','name','data_status = 1'),
				   'lawyer' => $this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
				   'vendor' => $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
				   'bank' => $this->User_model->get_parameter_data('ref_bank','name','data_status = 1'),
				   'payment_type' => $this->User_model->get_parameter_data('ref_payment_type','name','data_status = 1'),
				   'staff' => $this->Bill_ho_model->get_staff_data(),
				   'bill_type' => $this->User_model->get_parameter_data('ref_expense_type','name','data_status = 1'),
				   'pages'=> 'bill_ho/pages/form'		   
				   );
		$this->load->view('bill_ho/form_layout',$data);
	}
	function delete_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		$row[]='';
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Bill_ho_model->delete_action();
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
	function delete_action_court_return()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		$row[]='';
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Bill_ho_model->delete_action_court_return();
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
	function delete_action_court_adjust()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		$row[]='';
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Bill_ho_model->delete_action_court_adjust();
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
	function add_edit()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Bill_ho_model->add_edit();
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
	function add_edit_staff_bill($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Bill_ho_model->add_edit_staff_bill($add_edit,$id,$editrow);
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
	function add_edit_court_bill($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Bill_ho_model->add_edit_court_bill($add_edit,$id,$editrow);
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
	function add_edit_lawyer_bill($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Bill_ho_model->add_edit_lawyer_bill($add_edit,$id,$editrow);
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
	function add_edit_court_fee($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Bill_ho_model->add_edit_court_fee($add_edit,$id,$editrow);
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
	function add_edit_paper_bill($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Bill_ho_model->add_edit_paper_bill($add_edit,$id,$editrow);
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
	function add_edit_other_bill($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		$row=array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Bill_ho_model->add_edit_other_bill($add_edit,$id,$editrow);
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
	function get_peramater_name($table,$where=NULL)
	{
		$data = $this->User_model->get_parameter_name($table,$where);
		return $data->name;
	}
	function get_expense_data_staff_old()
	{
		$vendor_id = $this->input->post('vendor');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_cost_details_staff($vendor_id,$bill_month);
		$str = '';
		if (!empty($result)) 
		{
			$sl = 1;
			foreach ($result as $key) 
			{
				$str.='<tr>
							<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="0"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
					</tr>';
				$sl++;
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="6">Total Selected Amount : <span id="selected_amount">0</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($result)."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="6">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_expense_data_staff()
	{
		$vendor_id = $this->input->post('vendor');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_cost_details_staff($vendor_id,$bill_month);
		$str_html="";
		// <span onclick="show_info_pop_up('.$key->id.')"><img src="'.base_url('images/delete-New.png').'" alt="delete"></span>
		if (!empty($result)) 
		{
			$sl = 1;
			foreach ($result as $key) 
			{
				if($key->amount>0)
				{
					$str_html.='<tr>
							<td style="text-align:center;border:1px solid #a0a0a0;">
								<input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" />
								<input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1">
								<input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->event_id.'">
								<input type="hidden" name="event_amount_'.$key->event_id.'" id="event_amount_'.$key->event_id.'" value="'.$key->amount.'">
								<input type="hidden" name="event_memo_id_'.$key->event_id.'" id="event_memo_id_'.$key->event_id.'" value="'.$key->cost_ids.'">
								<input type="hidden" name="event_diduct_amount_'.$key->event_id.'" id="event_diduct_amount_'.$key->event_id.'" value="">
								<input type="hidden" name="event_diduct_remarks_'.$key->event_id.'" id="event_diduct_remarks_'.$key->event_id.'" value="">
								
							</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$sl.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->staff_pin.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->employee_name.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->conv_type_name.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;"><div style="text-align:center; cursor:pointer" onclick="bill_details('.$key->event_id.','.$key->conv_type.')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>
							<td style="text-align:center;border:1px solid #a0a0a0;"><span id="show_amount_'.$key->event_id.'">'.number_format((float)$key->amount,2).'</span></td>
						</tr>';
					$sl++;
				}
			}
			$str_html.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="7">Total Selected Amount : <span id="selected_amount">0</span></td></tr>';
			$str_html.="<input type='hidden' id='billcount' name='billcount' value='".($sl-1)."' />";
		}
		else
		{
			$str_html.='<tr>
						<td style="text-align:center" colspan="7">Sorry No Data!!</td>
				</tr>';
			$str_html.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"str"=>$str_html,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function download_staff_reimbursment($id)
    {
    	$c_info = $this->user_model->get_client_info();
    	$details = $this->Bill_ho_model->get_row_details_staff_conv($id);
		$bill_info = $this->Bill_ho_model->get_total_expenses_staff_conv($id);
    	$bank_name = 'BRAC Bank PLC.';
    	$total = 0;
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
	        $styleBorderOutlineTopButtom = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						),														
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineButtom = array(
				'borders' => array(											
						'bottom'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)													
					),
				);
	        $styleBorderOutlineTop = array(
				'borders' => array(														
						'top'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleThinBlackBorderOutlineleft = array(
				'borders' => array(	
						'left'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)												
					),
				);
			$styleThinBlackBorderOutlineright = array(
				'borders' => array(	
						'right'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)											
					),
				);
			$styleNoneBorder = array(
				'borders' => array(	
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_NONE
						)											
					),
				);
			$styleArray = array(
		    	'font'  => array(
		        'bold'  => true,
		        'size' => 16,
		        'color' => array('rgb' => '808080')
		    ));
		    $styleArray2 = array(
		    	'font'  => array(
		        'bold'  => true,
		        'size' => 14,
		        'name'  => 'Verdana'
		    ));
			
	       // $value=$row->OurCar.' '.number_format((float)$row->Amount,2,'.',',')."</br>".'deal with '.$row->cptyname.' at '.$row->Rate.'% rate';
		    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); 
		    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
		    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
		    //$objPHPExcel->getActiveSheet()->setShowGridlines(False);
		    // Excel Image insert 
		    $objDrawing = new PHPExcel_Worksheet_Drawing();
		    $objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$objDrawing->setPath('images/login_images/'.$c_info->project_client_logo);
			$objDrawing->setCoordinates('A2');
			$objDrawing->setHeight(300);
			$objDrawing->setWidth(200);
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
			//end

	    	$rowNumber = 1;
	        $rowNumber++; 
	        $headings4 = array('Reimbursement Requisition Form');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings4),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('D'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        //$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(16);
	        //$objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->applyFromArray($styleArray);

	        $rowNumber++; 
	        $rowNumber++; 
	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('PIN No',$details->staff_pin),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Billing Month',$details->billing_month),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));

	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('Name',$details->staff_name),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Mobile Number',$details->mobile_number),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));

	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('Designation',$details->functional_desig),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Account Number',$details->bank_ac),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->setCellValueExplicit(('E'.$rowNumber), $details->bank_ac, PHPExcel_Cell_DataType::TYPE_STRING);
	        $rowNumber++; 
	        $objPHPExcel->getActiveSheet()->fromArray(array('Department','BBL'),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('B'.$rowNumber.':C'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':B'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Unit/Branch Name',''),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	        $objPHPExcel->getActiveSheet()->getStyle('E'.$rowNumber.':E'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	        $objPHPExcel->getActiveSheet()->getStyle('A5:F'.$rowNumber)->applyFromArray($styleArray_border);
		    $objPHPExcel->getActiveSheet()->getStyle('A5:A'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'EBF1DE')));
		    $objPHPExcel->getActiveSheet()->getStyle('D5:D'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'EBF1DE')));

	        $rowNumber++;
	        $rowNumber++;
	        $objPHPExcel->getActiveSheet()->fromArray(array('Accounts Head'),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $headings9 = array('Particulars','Expended','Limit','Reimbursed');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings9),NULL,'C'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 

		    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'EBF1DE')));

	        $rowNumber++;
	        $local_conv = 0;
	        $others = 0;
	        foreach ($bill_info as $key) {
	        	$total = $total+$key->amount;
	        	if($key->conv_type==1)
	        	{
	        		$local_conv = $key->amount;
	        	}
	        	else if($key->conv_type==3)
	        	{
	        		$motor_cycle = $key->amount;
	        	}
	        	else
	        	{
	        		$others = $key->amount;
	        	}
	        }
	        $data = array('Local Conveyance/Daily Court Allowance','','',number_format((float)$local_conv,2),'','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Motorcycle Allowance ( None_EMI)','','',number_format((float)$motor_cycle,2),'','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $data = array('Travel- (Meeting/Training/Others) Accommodation/DA/TA/Conveyance/Others','','',number_format((float)$others,2),'','');
        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $rowNumber++;
	        $arrayName = array('Court Entertainment',
	        	'Business Promotion:',
	        	'Entertainment of Guest/Judge/Magistrate/Others',
	        	'Business Development',
	        	'Others (Specify):',
	        	'Repair & Maintenance',
	        	'Paper & Stationery',
	        	'Utility/Courier/Printing/Postage/Others',
	        	'Appeal/Bail Money Withdraw' );
	        for($i=0;$i<count($arrayName);$i++)
	        {
	        	$data = array($arrayName[$i],'','','','','');
	        	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
		        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		        // $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
		        $rowNumber++;
	        }
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
	        $rowNumber++;
	        $amount_in_word = convert_number($total);
	        $objPHPExcel->getActiveSheet()->fromArray(array('Total Taka: '.$amount_in_word,'','',number_format((float)$total,2)),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':B'.($rowNumber));
		    $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		    $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $data = array('','','');
	        $objPHPExcel->getActiveSheet()->fromArray(array($data),NULL,'D'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('D'.$rowNumber.':F'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setBold(true); 
	        $objPHPExcel->getActiveSheet()->getStyle('A10:F'.$rowNumber)->applyFromArray($styleArray_border);

	        $rowNumber++;
	        $rowNumber++;
	        $rowNumber++;
	        $rowNumber++;
	        $rowNumber++;
	        $authorize = array('Initiator signing Details','Legal checker signing details ','Recommended By:','Recommended By:','Approved By:');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        $authorize = array('Name: '.$details->e_by_name,'Name: '.$details->v_by_name,'Md. Sabbir Abedin','','Rasheed Ahmed');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        $authorize = array('PIN: '.$details->e_by_pin,'PIN: '.$details->v_by_pin,'PIN:4402','','PIN:3979');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        $authorize = array($details->e_by_desig.',Litigation Mgt.',$details->v_by_desig.',Litigation Mgt.','Sr. Manager-Litigation Mgt, HO','','Head of Legal & Recovery');
	        $objPHPExcel->getActiveSheet()->fromArray(array($authorize),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('E'.$rowNumber.':F'.($rowNumber));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':F'.$rowNumber)->getFont()->setSize(9);

	        $rowNumber++;
	        
		    $objPHPExcel->setActiveSheetIndex(0);
		    $objPHPExcel->getActiveSheet()->setTitle('Reimbursement New'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        ob_clean();
	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="Reimbursement.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output');   
	        exit();
    

    }
	function update_bill()
	{
		$id=$this->Bill_ho_model->update_bill();
	}
	function get_court_data_details($id)
	{
		$data=array(
		'result' => $this->Bill_ho_model->get_details_court_enter($id)
		);
		$this->load->view('bill_ho/pages/deal_details',$data);
	}
	function get_court_enter_all_bill()
	{
		$event_id = $this->input->post('event_id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_cost_details_by_court_enter_id($event_id);
		$var =array(
    			"result"=>$result,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_staff_conv_all_bill()
	{
		$event_id = $this->input->post('event_id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_cost_details_by_staff_conv_id($event_id);
		$var =array(
    			"result"=>$result,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_staff_conv_all_bill_edit()
	{
		$event_id = $this->input->post('event_id');
		$bill_id = $this->input->post('bill_id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_cost_details_by_staff_conv_id_edit($event_id,$bill_id);
		$var =array(
    			"result"=>$result,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_court_enter_all_bill_edit()
	{
		$event_id = $this->input->post('event_id');
		$bill_id = $this->input->post('bill_id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_cost_details_by_court_enter_id_edit($event_id,$bill_id);
		$var =array(
    			"result"=>$result,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_expense_data_court_old()
	{
		$staff_pin = $this->input->post('staff_pin');
		$bill_month = $this->input->post('bill_month');
		$employee_type = $this->input->post('employee_type');
		$legal_region = $this->input->post('legal_region');
		$legal_district = $this->input->post('legal_district');
		$year = $this->input->post('year');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_cost_details_court($employee_type,$bill_month,$staff_pin,$year);
		$str = '';
		$str_html="";
		$str_html.="";
		$month_result = $this->User_info_model->get_month_data($bill_month);
		$ops_month='';
		if(is_object($month_result)){$ops_month=$month_result->ops_month;}
		$emp_type_result = $this->User_info_model->get_emp_type_data($employee_type);
		$ops_emp_type='';
		if(is_object($emp_type_result)){$ops_emp_type=$emp_type_result->ops_emp_type;}
		$atts = array(
		  'width'      => '800',
		  'height'     => '600',
		  'scrollbars' => 'yes',
		  'status'     => 'yes',
		  'resizable'  => 'yes',
		  'screenx'    => '300',
		  'screeny'    => '50'
		);
		if (!empty($result)) 
		{

			$sl = 1;
			foreach ($result as $key) 
			{
				$str_html.='<tr>
							<td style="text-align:center;border:1px solid #a0a0a0;"><input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->event_id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="0"></td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$sl.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->staff_pin.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->employee_name.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->account_number.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->base_office_name.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->legal_region.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">';
							$str_html.= anchor_popup("bill_ho/get_court_data_details/".$key->event_id, '<img align="center" src="'.base_url().'images/view_detail.png">',$atts);
				$str_html.='</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->activities_name.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.number_format((float)$key->amount,2).'</td>
					</tr>';
				$sl++;
			}
			$str_html.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="10">Total Selected Amount : <span id="selected_amount">0</span></td></tr>';
			$str_html.="<input type='hidden' id='billcount' name='billcount' value='".count($result)."' />";
		}
		else
		{
			$str_html.='<tr>
						<td style="text-align:center" colspan="10">Sorry No Data!!</td>
				</tr>';
			$str_html.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"str"=>$str_html,
    			"ops_month"=>$ops_month,
    			"ops_emp_type"=>$ops_emp_type,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_expense_data_court()
	{
		$staff_pin = $this->input->post('staff_pin');
		$bill_month = $this->input->post('bill_month');
		$employee_type = $this->input->post('employee_type');
		$year = $this->input->post('year');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_cost_details_court($employee_type,$bill_month,$staff_pin,$year);
		$str = '';
		$str_html="";
		$str_html.="";
		$month_result = $this->User_info_model->get_month_data($bill_month);
		$ops_month='';
		if(is_object($month_result)){$ops_month=$month_result->ops_month;}
		$emp_type_result = $this->User_info_model->get_emp_type_data($employee_type);
		$ops_emp_type='';
		if(is_object($emp_type_result)){$ops_emp_type=$emp_type_result->ops_emp_type;}
		// $atts = array(
		//   'width'      => '100',
		//   'height'     => '600',
		//   'scrollbars' => 'yes',
		//   'status'     => 'yes',
		//   'resizable'  => 'yes',
		//   'screenx'    => '300',
		//   'screeny'    => '50'
		// );
		if (!empty($result)) 
		{

			$sl = 1;
			foreach ($result as $key) 
			{
				if($key->amount>0)
				{
					$str_html.='<tr>
							<td style="text-align:center;border:1px solid #a0a0a0;">
								<input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" />
								<input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1">
								<input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->event_id.'">
								<input type="hidden" name="event_amount_'.$key->event_id.'" id="event_amount_'.$key->event_id.'" value="'.$key->amount.'">
								<input type="hidden" name="event_memo_id_'.$key->event_id.'" id="event_memo_id_'.$key->event_id.'" value="'.$key->cost_ids.'">
								<input type="hidden" name="event_diduct_amount_'.$key->event_id.'" id="event_diduct_amount_'.$key->event_id.'" value="">
								<input type="hidden" name="event_diduct_remarks_'.$key->event_id.'" id="event_diduct_remarks_'.$key->event_id.'" value="">
							</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$sl.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->staff_pin.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->employee_name.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->account_number.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->base_office_name.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->legal_region.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;"><div style="text-align:center; cursor:pointer" onclick="bill_details('.$key->event_id.')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>
							<td style="text-align:center;border:1px solid #a0a0a0;"><span id="show_amount_'.$key->event_id.'">'.number_format((float)$key->amount,2).'</span></td>
						</tr>';
					$sl++;
				}
			}
			$str_html.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="10">Total Selected Amount : <span id="selected_amount">0</span></td></tr>';
			$str_html.="<input type='hidden' id='billcount' name='billcount' value='".($sl-1)."' />";
		}
		else
		{
			$str_html.='<tr>
						<td style="text-align:center" colspan="10">Sorry No Data!!</td>
				</tr>';
			$str_html.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"str"=>$str_html,
    			"ops_month"=>$ops_month,
    			"ops_emp_type"=>$ops_emp_type,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_expense_data_lawyer()
	{
		$vendor_id = $this->input->post('vendor');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_cost_details_lawyer($vendor_id,$bill_month);
		$proxy_result = $this->Bill_ho_model->get_cost_details_proxy_lawyer($vendor_id,$bill_month);
		$proxy_str='';
		if (!empty($proxy_result)) 
		{
			$sl = 1;
			foreach ($proxy_result as $key) 
			{
				$proxy_str.='<tr>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
					</tr>';
				$sl++;
			}
		}
		else
		{
			$proxy_str.='';
		}
		$str = '';
		$legal_bill_str='';
        $legal_bill_counter = 0;
		if (!empty($result)) 
		{
			$sl = 1;
			foreach ($result as $key) 
			{
				if($key->duplicate_bill_with_proxy==1)
				{
					$proxy_style='color:red';
				}
				else
				{
					$proxy_style='"';
				}
				if($key->selection_s_order==2)//Pending Bills
                {
                	$str.='<tr>
							<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.',\'pending\')" /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="0">';
					if(!empty($this->del_right)){
						$str.='<span onclick="show_info_pop_up('.$key->id.',\'D\')" style="cursor:pointer"><img src="'.base_url('images/delete-New.png').'" alt="delete"></span>';
						$str.='<span onclick="show_info_pop_up('.$key->id.',\'E\','.$key->amount.',\''.date("Y-m-d",strtotime($key->org_dt)).'\')" style="cursor:pointer"><img src="'.base_url('images/edit-new.png').'" alt="delete"></span>';
					}
						$str.='</td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center;'.$proxy_style.'">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" onkeypress="return numbersonly(event)" style="width:100px;" onchange="calculate_discount_amount('.$sl.')"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" style="width:100px;" ></td>
					</tr>';
                }
                else
                {
                	$legal_bill_counter++;
                	$legal_bill_str.='<tr>
							<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.',\'legal\')" /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="0">';
					if(!empty($this->del_right)){
						$legal_bill_str.='<span onclick="show_info_pop_up('.$key->id.',\'D\')" style="cursor:pointer"><img src="'.base_url('images/delete-New.png').'" alt="delete"></span>';
						$legal_bill_str.='<span onclick="show_info_pop_up('.$key->id.',\'E\','.$key->amount.',\''.date("Y-m-d",strtotime($key->org_dt)).'\')" style="cursor:pointer"><img src="'.base_url('images/edit-new.png').'" alt="delete"></span>';
					}
						$legal_bill_str.='</td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center;'.$proxy_style.'">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" style="width:100px;" ></td>
					</tr>';
                }
				
				$sl++;
			}
			if($legal_bill_counter==0)
            {
                $legal_bill_str.='<tr>
                        <td style="text-align:center" colspan="11">Sorry No Data!!</td>
                </tr>';
            }
            $legal_bill_str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="11">Total Selected Amount : <span id="selected_amount_legal">0</span></td></tr>';
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="11">Total Selected Amount : <span id="selected_amount">0</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($result)."' />";
			$str.="<input type='hidden' id='legal_bill_count' name='legal_bill_count' value='".$legal_bill_counter."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="11">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
				"legal_bill_str"=>$legal_bill_str,
    			"str"=>$str,
    			"proxy_str"=>$proxy_str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_expense_data_lawyer_hc()
	{
		$vendor_id = $this->input->post('vendor');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_cost_details_lawyer_hc($vendor_id,$bill_month);
		
		$str = '';
		$legal_bill_str='';
        $legal_bill_counter = 0;
		if (!empty($result)) 
		{
			$sl = 1;
			foreach ($result as $key) 
			{
				if($key->duplicate_bill_with_proxy==1)
				{
					$proxy_style='color:red';
				}
				else
				{
					$proxy_style='"';
				}
				if($key->selection_s_order==2)//Pending Bills
                {
                	$str.='<tr>
							<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.',\'pending\')" /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="0">';
					if(!empty($this->del_right)){
						$str.='<span onclick="show_info_pop_up('.$key->id.',\'D\')" style="cursor:pointer"><img src="'.base_url('images/delete-New.png').'" alt="delete"></span>';
						$str.='<span onclick="show_info_pop_up('.$key->id.',\'E\','.$key->amount.',\''.date("Y-m-d",strtotime($key->org_dt)).'\')" style="cursor:pointer"><img src="'.base_url('images/edit-new.png').'" alt="delete"></span>';
					}
						$str.='</td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center;'.$proxy_style.'">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" style="width:100px;"></td>
					</tr>';
                }
                else
                {
                	$legal_bill_counter++;
                	$legal_bill_str.='<tr>
							<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.',\'legal\')" /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="0">';
					if(!empty($this->del_right)){
						$legal_bill_str.='<span onclick="show_info_pop_up('.$key->id.',\'D\')" style="cursor:pointer"><img src="'.base_url('images/delete-New.png').'" alt="delete"></span>';
						$legal_bill_str.='<span onclick="show_info_pop_up('.$key->id.',\'E\','.$key->amount.',\''.date("Y-m-d",strtotime($key->org_dt)).'\')" style="cursor:pointer"><img src="'.base_url('images/edit-new.png').'" alt="delete"></span>';
					}
						$legal_bill_str.='</td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center;'.$proxy_style.'">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" style="width:100px;"></td>
					</tr>';
                }
				
				$sl++;
			}
			if($legal_bill_counter==0)
            {
                $legal_bill_str.='<tr>
                        <td style="text-align:center" colspan="11">Sorry No Data!!</td>
                </tr>';
            }
            $legal_bill_str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="11">Total Selected Amount : <span id="selected_amount_legal">0</span></td></tr>';
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="11">Total Selected Amount : <span id="selected_amount">0</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($result)."' />";
			$str.="<input type='hidden' id='legal_bill_count' name='legal_bill_count' value='".$legal_bill_counter."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="11">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
				"legal_bill_str"=>$legal_bill_str,
    			"str"=>$str,
    			"proxy_str"=>'',
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_expense_data_court_fee()
	{
		$vendor_id = $this->input->post('vendor');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_cost_details_court_fee($vendor_id,$bill_month);
		$str = '';
		$legal_bill_str='';
		$legal_bill_counter = 0;
		if (!empty($result)) 
		{
			$sl = 1;
			foreach ($result as $key) 
			{
				if($key->selection_s_order==2)//Pending Bills
				{
					$str.='<tr>
							<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.',\'pending\')" /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="0">';
					if(!empty($this->del_right)){
						$str.='<span onclick="show_info_pop_up('.$key->id.',\'D\')" style="cursor:pointer"><img src="'.base_url('images/delete-New.png').'" alt="delete"></span>';
						$str.='<span onclick="show_info_pop_up('.$key->id.',\'E\','.$key->amount.',\''.date("Y-m-d",strtotime($key->org_dt)).'\')" style="cursor:pointer"><img src="'.base_url('images/edit-new.png').'" alt="delete"></span>';
					}
						$str.='</td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->suit_value,2).'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" style="width:100px;"></td>
					</tr>';
				}
				else//Bill submited from legal
				{
					$legal_bill_counter++;
					$legal_bill_str.='<tr>
							<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.',\'legal\')" /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="0">';
					if(!empty($this->del_right)){
						$legal_bill_str.='<span onclick="show_info_pop_up('.$key->id.',\'D\')" style="cursor:pointer"><img src="'.base_url('images/delete-New.png').'" alt="delete"></span>';
						$legal_bill_str.='<span onclick="show_info_pop_up('.$key->id.',\'E\','.$key->amount.',\''.date("Y-m-d",strtotime($key->org_dt)).'\')" style="cursor:pointer"><img src="'.base_url('images/edit-new.png').'" alt="delete"></span>';
					}
						$legal_bill_str.='</td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->suit_value,2).'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" style="width:100px;"></td>
					</tr>';
				}
				$sl++;
			}
			if($legal_bill_counter==0)
			{
				$legal_bill_str.='<tr>
						<td style="text-align:center" colspan="12">Sorry No Data!!</td>
				</tr>';
			}
			$legal_bill_str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="11">Total Selected Amount : <span id="selected_amount_legal">0</span></td></tr>';
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="11">Total Selected Amount Pending Bill : <span id="selected_amount">0</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($result)."' />";
			$str.="<input type='hidden' id='legal_bill_count' name='legal_bill_count' value='".$legal_bill_counter."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="12">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"legal_bill_str"=>$legal_bill_str,
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_expense_data_paper_bill()
	{
		$vendor_id = $this->input->post('vendor');
		$vendor_type = $this->input->post('vendor_type');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$vendor_ac = '';
		$result = $this->Bill_ho_model->get_cost_details_paper_bill($vendor_type,$vendor_id,$bill_month);
		$str = '';
		$tin = '';
		$bin = '';
		$bank_name = '';
		$bank = '';
		$branch_name = '';
		if (!empty($result)) 
		{
			$sl = 1;
			foreach ($result as $key) 
			{
				$vendor_ac = $key->vendor_ac_no;
				$tin = $key->tin;
				$bin = $key->bin;
				$vendor_details = $this->Bill_ho_model->get_vendor_bank_details($key->vendor_id);
				if(!empty($vendor_details))
				{
					$bank_name = $vendor_details->bank_name;
					$bank = $vendor_details->bank;
					$branch_name = $vendor_details->branch_name;
				}
				else
				{
					$bank_name = '';
					$bank = '';
					$branch_name = '';
				}
				 if ($key->paper_scan_copy!='' && $key->paper_scan_copy!=NULL) {
	                $paper_scan_copy='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/paper_scan_copy/'.$key->paper_scan_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	            }else{$paper_scan_copy="";}
	            if ($key->paper_expense_approval_file!='' && $key->paper_expense_approval_file!=NULL) {
	                $paper_expense_approval_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/paper_expense_approval_file/'.$key->paper_expense_approval_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	            }else{$paper_expense_approval_file="";}
				$str.='<tr>
							<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="0">';
					if(!empty($this->del_right)){
						$str.='<span onclick="show_info_pop_up('.$key->id.',\'D\')" style="cursor:pointer"><img src="'.base_url('images/delete-New.png').'" alt="delete"></span>';
						$str.='<span onclick="show_info_pop_up('.$key->id.',\'E\','.$key->amount.',\''.date("Y-m-d",strtotime($key->org_dt)).'\')" style="cursor:pointer"><img src="'.base_url('images/edit-new.png').'" alt="delete"></span>';
					}
						$str.='</td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->paper_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$paper_scan_copy.'</td>
							<td style="text-align:center">'.$paper_expense_approval_file.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" style="width:100px;"></td>
					</tr>';
				$sl++;
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="11">Total Selected Amount : <span id="selected_amount">0</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($result)."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="11">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
				"vendor_ac"=>$vendor_ac,
    			"str"=>$str,
    			"tin"=>$tin,
    			"bin"=>$bin,
    			"bank_name"=>$bank_name,
    			"bank"=>$bank,
    			"branch_name"=>$branch_name,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_expense_data_other_bill()
	{
		$vendor_name = $this->input->post('vendor');
		$bill_month = $this->input->post('bill_month');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_cost_details_other_bill($vendor_name,$bill_month);
		$str = '';
		if (!empty($result)) 
		{
			$sl = 1;
			foreach ($result as $key) 
			{
				$str.='<tr>
							<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="1"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="0">';
					if(!empty($this->del_right)){
						$str.='<span onclick="show_info_pop_up('.$key->id.',\'D\')" style="cursor:pointer"><img src="'.base_url('images/delete-New.png').'" alt="delete"></span>';
						$str.='<span onclick="show_info_pop_up('.$key->id.',\'E\','.$key->amount.',\''.date("Y-m-d",strtotime($key->org_dt)).'\')" style="cursor:pointer"><img src="'.base_url('images/edit-new.png').'" alt="delete"></span>';
					}
						$str.='</td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
					</tr>';
				$sl++;
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="9">Total Selected Amount : <span id="selected_amount">0</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($result)."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="9">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_staff_exp_edit_data_old()
	{
		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_add_action_data_staff($id);
		$bill_details = $this->Bill_ho_model->get_bill_details_staff($result->vendor);
		$str = '';
		$checked="";
		$delete = 1;
		$desabled = "";

		if (!empty($bill_details)) 
		{
			$sl=1;$amount=0;$selected=0;
			foreach ($bill_details as $key) 
			{
				$desabled = "";
				$checked="";
				$bill_id = 0;
				if($key->memo_sts!=0)
				{
					
					if($key->bill_id==$id) //For This memo bill select
					{
						$checked="checked";
						$amount=$amount+$key->amount;
						$selected++;
						$delete = 0;
						$bill_id = $id;
					}
					else //For other's memo selectd bill
					{
						//continue;//skiping the other selected bill
						$desabled = "disabled";
						$delete = 1;
					}
					
				}else
				{
					$checked="";
					$delete = 1;
				}
				$str.='<tr>
							<td style="text-align:center"><input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" '.$checked.' /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="'.$bill_id.'"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
					</tr>';
				$sl++;
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="6">Total Selected Amount : <span id="selected_amount">'.$amount.'</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($bill_details)."' />";
			$str.="<input type='hidden' id='bill_select' name='bill_select' value='".$selected."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="6">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"result"=>$result,
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_staff_edit_data()
	{
		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_add_action_data_staff($id);
		$bill_details = $this->Bill_ho_model->get_bill_details_staff($result->vendor_id,$result->month,$result->year,$result->id);
		$str = '';
		$checked="";
		$delete = 1;
		$desabled = "";
		if (!empty($bill_details)) 
		{
			$sl=1;$amount=0;$selected=0;
			foreach ($bill_details as $key) 
			{
				$desabled = "";
				$checked="";
				$bill_id = 0;
				if($key->bill_amount>0)//When bill selected for this bill
				{
					$bill_amount = $key->bill_amount;
					$selected_ids = $key->cost_ids;
				}
				else
				{
					$bill_amount = $key->main_amount;
					$selected_ids = $key->cost_ids_un_selected;
				}
				$all_bill_id = explode(",",(string) $key->bill_ids);
				if (in_array($id, $all_bill_id)) //For This memo bill select
				{
					$checked="checked";
					$amount=$amount+$bill_amount;
					$selected++;
					$delete = 0;
					$bill_id = $id;
				}
				else
				{
					$checked="";
					$delete = 1;
				}

				if($bill_amount>0)
				{
					$str.='<tr>
							<td style="text-align:center;border:1px solid #a0a0a0;">
								<input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" '.$checked.' />
								<input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'">
								<input type="hidden" name="event_bill_id_'.$sl.'" id="event_bill_id_'.$sl.'" value="'.$bill_id.'">
								<input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->event_id.'">
								<input type="hidden" name="event_amount_'.$key->event_id.'" id="event_amount_'.$key->event_id.'" value="'.$bill_amount.'">
								<input type="hidden" name="event_memo_id_'.$key->event_id.'" id="event_memo_id_'.$key->event_id.'" value="'.$selected_ids.'">
								<input type="hidden" name="event_diduct_amount_'.$key->event_id.'" id="event_diduct_amount_'.$key->event_id.'" value="'.$key->diduction_amount.'">
								<input type="hidden" name="event_diduct_remarks_'.$key->event_id.'" id="event_diduct_remarks_'.$key->event_id.'" value="'.$key->diduction_remarks.'">
							</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$sl.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->staff_pin.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->employee_name.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->conv_type_name.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;"><div style="text-align:center; cursor:pointer" onclick="bill_details_edit('.$key->event_id.','.$bill_id.','.$key->conv_type.')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>
							<td style="text-align:center;border:1px solid #a0a0a0;"><span id="show_amount_'.$key->event_id.'">'.number_format((float)$bill_amount,2).'</span></td>
						</tr>';
					$sl++;
				}
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="10">Total Selected Amount : <span id="selected_amount">'.$amount.'</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".($sl-1)."' />";
			$str.="<input type='hidden' id='bill_select' name='bill_select' value='".$selected."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="10">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"result"=>$result,
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_court_edit_data()
	{
		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_add_action_data_court($id);
		$bill_details = $this->Bill_ho_model->get_bill_details_court($result->employee_type,$result->staff_pin,$result->month,$result->id);
		$str = '';
		$checked="";
		$delete = 1;
		$desabled = "";
		$month_result = $this->User_info_model->get_month_data($result->month);
		$ops_month='';
		if(is_object($month_result)){$ops_month=$month_result->ops_month;}
		$emp_type_result = $this->User_info_model->get_emp_type_data($result->employee_type);
		$ops_emp_type='';
		if(is_object($emp_type_result)){$ops_emp_type=$emp_type_result->ops_emp_type;}
		if (!empty($bill_details)) 
		{
			$sl=1;$amount=0;$selected=0;
			foreach ($bill_details as $key) 
			{
				$desabled = "";
				$checked="";
				$bill_id = 0;
				if($key->bill_amount>0)//When bill selected for this bill
				{
					$bill_amount = $key->bill_amount;
					$selected_ids = $key->cost_ids;
				}
				else
				{
					$bill_amount = $key->main_amount;
					$selected_ids = $key->cost_ids_un_selected;
				}
				$all_bill_id = explode(",",(string)$key->bill_ids);
				if (in_array($id, $all_bill_id)) //For This memo bill select
				{
					$checked="checked";
					$amount=$amount+$bill_amount;
					$selected++;
					$delete = 0;
					$bill_id = $id;
				}
				else
				{
					$checked="";
					$delete = 1;
				}

				if($bill_amount>0)
				{
					$str.='<tr>
							<td style="text-align:center;border:1px solid #a0a0a0;">
								<input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" '.$checked.' />
								<input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'">
								<input type="hidden" name="event_bill_id_'.$sl.'" id="event_bill_id_'.$sl.'" value="'.$bill_id.'">
								<input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->event_id.'">
								<input type="hidden" name="event_amount_'.$key->event_id.'" id="event_amount_'.$key->event_id.'" value="'.$bill_amount.'">
								<input type="hidden" name="event_memo_id_'.$key->event_id.'" id="event_memo_id_'.$key->event_id.'" value="'.$selected_ids.'">
								<input type="hidden" name="event_diduct_amount_'.$key->event_id.'" id="event_diduct_amount_'.$key->event_id.'" value="'.$key->diduction_amount.'">
								<input type="hidden" name="event_diduct_remarks_'.$key->event_id.'" id="event_diduct_remarks_'.$key->event_id.'" value="'.$key->diduction_remarks.'">
							</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$sl.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->staff_pin.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->employee_name.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->account_number.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->base_office_name.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;">'.$key->legal_region.'</td>
							<td style="text-align:center;border:1px solid #a0a0a0;"><div style="text-align:center; cursor:pointer" onclick="bill_details_edit('.$key->event_id.','.$bill_id.')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>
							<td style="text-align:center;border:1px solid #a0a0a0;"><span id="show_amount_'.$key->event_id.'">'.number_format((float)$bill_amount,2).'</span></td>
						</tr>';
					$sl++;
				}
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="10">Total Selected Amount : <span id="selected_amount">'.$amount.'</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".($sl-1)."' />";
			$str.="<input type='hidden' id='bill_select' name='bill_select' value='".$selected."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="10">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"result"=>$result,
    			"str"=>$str,
    			"ops_month"=>$ops_month,
    			"ops_emp_type"=>$ops_emp_type,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_lawyer_edit_data()
	{
		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_add_action_data_lawyer($id);
		$lawyer_info=$this->Bill_ho_model->get_lawyer_email_phone($result->vendor);
		$bill_details = $this->Bill_ho_model->get_bill_details_lawyer($result->vendor,$result->month,$result->year);
		$str = '';
		$checked="";
		$delete = 1;
		$desabled = "";
		$legal_bill_str='';
        $legal_bill_counter = 0;
		if (!empty($bill_details)) 
		{
			$sl=1;$amount=0;$selected=0;$legal_amount=0;
			foreach ($bill_details as $key) 
			{
				$desabled = "";
				$checked="";
				$bill_id = 0;
				if($key->duplicate_bill_with_proxy==1)
				{
					$proxy_style='color:red';
				}
				else
				{
					$proxy_style='"';
				}
				if($key->memo_sts!=0)
				{
					
					if($key->bill_id==$id) //For This memo bill select
					{
						$checked="checked";
						if($key->selection_s_order==2)//Pending Bills
                        {
                            $amount=$amount+$key->amount;
                        }
                        else
                        {
                            $legal_amount=$legal_amount+$key->amount;
                        }
						$selected++;
						$delete = 0;
						$bill_id = $id;
					}
					else //For other's memo selectd bill
					{
						$desabled = "disabled";
						$delete = 1;
					}
					
				}else
				{
					$checked="";
					$delete = 1;
				}
				$discount_amount = ($key->discount_amount>0)?$key->discount_amount:"";
				if($key->selection_s_order==2)//Pending Bills
                {
                	$str.='<tr>
							<td style="text-align:center"><input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.',\'pending\')" '.$checked.' /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="'.$bill_id.'"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center;'.$proxy_style.'">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')" value="'.$discount_amount.'"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" value="'.$key->discount_remarks.'" style="width:100px;"></td>
					</tr>';
                }
                else
                {
                    $legal_bill_counter++;
                    $legal_bill_str.='<tr>
							<td style="text-align:center"><input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.',\'legal\')" '.$checked.' /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="'.$bill_id.'"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')" value="'.$discount_amount.'"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" value="'.$key->discount_remarks.'" style="width:100px;"></td>
					</tr>';
                }
				
				$sl++;
			}
			if($legal_bill_counter==0)
            {
                $legal_bill_str.='<tr>
                        <td style="text-align:center" colspan="9">Sorry No Data!!</td>
                </tr>';
            }
            $legal_bill_str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="9">Total Selected Amount : <span id="selected_amount_legal">'.$legal_amount.'</span></td></tr>';
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="9">Total Selected Amount Pending Bill : <span id="selected_amount">'.$amount.'</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($bill_details)."' />";
			$str.="<input type='hidden' id='legal_bill_count' name='legal_bill_count' value='".$legal_bill_counter."' />";
			$str.="<input type='hidden' id='bill_select' name='bill_select' value='".$selected."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="9">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
				"lawyer_info"=>$lawyer_info,
				"legal_bill_str"=>$legal_bill_str,
    			"result"=>$result,
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_lawyer_edit_data_hc()
	{
		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_add_action_data_lawyer($id);
		$lawyer_info=$this->Bill_ho_model->get_lawyer_email_phone($result->vendor);
		$bill_details = $this->Bill_ho_model->get_bill_details_lawyer_hc($result->vendor,$result->month,$result->year);
		$str = '';
		$checked="";
		$delete = 1;
		$desabled = "";
		$legal_bill_str='';
        $legal_bill_counter = 0;
		if (!empty($bill_details)) 
		{
			$sl=1;$amount=0;$selected=0;$legal_amount=0;
			foreach ($bill_details as $key) 
			{
				$desabled = "";
				$checked="";
				$bill_id = 0;
				if($key->duplicate_bill_with_proxy==1)
				{
					$proxy_style='color:red';
				}
				else
				{
					$proxy_style='"';
				}
				if($key->memo_sts!=0)
				{
					
					if($key->bill_id==$id) //For This memo bill select
					{
						$checked="checked";
						if($key->selection_s_order==2)//Pending Bills
                        {
                            $amount=$amount+$key->amount;
                        }
                        else
                        {
                            $legal_amount=$legal_amount+$key->amount;
                        }
						$selected++;
						$delete = 0;
						$bill_id = $id;
					}
					else //For other's memo selectd bill
					{
						$desabled = "disabled";
						$delete = 1;
					}
					
				}else
				{
					$checked="";
					$delete = 1;
				}
				$discount_amount = ($key->discount_amount>0)?$key->discount_amount:"";
				if($key->selection_s_order==2)//Pending Bills
                {
                	$str.='<tr>
							<td style="text-align:center"><input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.',\'pending\')" '.$checked.' /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="'.$bill_id.'"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center;'.$proxy_style.'">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')" value="'.$discount_amount.'"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" value="'.$key->discount_remarks.'" style="width:100px;"></td>
					</tr>';
                }
                else
                {
                    $legal_bill_counter++;
                    $legal_bill_str.='<tr>
							<td style="text-align:center"><input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.',\'legal\')" '.$checked.' /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="'.$bill_id.'"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')" value="'.$discount_amount.'"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" value="'.$key->discount_remarks.'" style="width:100px;"></td>
					</tr>';
                }
				
				$sl++;
			}
			if($legal_bill_counter==0)
            {
                $legal_bill_str.='<tr>
                        <td style="text-align:center" colspan="11">Sorry No Data!!</td>
                </tr>';
            }
            $legal_bill_str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="11">Total Selected Amount : <span id="selected_amount_legal">'.$legal_amount.'</span></td></tr>';
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="11">Total Selected Amount Pending Bill : <span id="selected_amount">'.$amount.'</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($bill_details)."' />";
			$str.="<input type='hidden' id='legal_bill_count' name='legal_bill_count' value='".$legal_bill_counter."' />";
			$str.="<input type='hidden' id='bill_select' name='bill_select' value='".$selected."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="11">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
				"lawyer_info"=>$lawyer_info,
				"legal_bill_str"=>$legal_bill_str,
    			"result"=>$result,
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_court_fee_edit_data()
	{
		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_add_action_data_court_fee($id);
		$lawyer_info=$this->Bill_ho_model->get_lawyer_email_phone($result->vendor);
		$bill_details = $this->Bill_ho_model->get_bill_details_court_fee($result->vendor,$result->month,$result->year);
		$str = '';
		$checked="";
		$delete = 1;
		$desabled = "";
		$legal_bill_str='';
		$legal_bill_counter = 0;
		if (!empty($bill_details)) 
		{
			$sl=1;$amount=0;$selected=0;$legal_amount=0;
			foreach ($bill_details as $key) 
			{
				$desabled = "";
				$checked="";
				$bill_id = 0;
				if($key->memo_sts!=0)
				{
					
					if($key->bill_id==$id) //For This memo bill select
					{
						$checked="checked";
						if($key->selection_s_order==2)//Pending Bills
						{
							$amount=$amount+$key->amount;
						}
						else
						{
							$legal_amount=$legal_amount+$key->amount;
						}
						
						$selected++;
						$delete = 0;
						$bill_id = $id;
					}
					else //For other's memo selectd bill
					{
						$desabled = "disabled";
						$delete = 1;
					}
					
				}else
				{
					$checked="";
					$delete = 1;
				}
				$discount_amount = ($key->discount_amount>0)?$key->discount_amount:"";
				if($key->selection_s_order==2)//Pending Bills
				{
					$str.='<tr>
							<td style="text-align:center"><input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.',\'pending\')" '.$checked.' /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="'.$bill_id.'"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center">'.number_format((float)$key->suit_value,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')" value="'.$discount_amount.'"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" value="'.$key->discount_remarks.'" style="width:100px;"></td>
					</tr>';
				}
				else
				{
					$legal_bill_counter++;
					$legal_bill_str.='<tr>
							<td style="text-align:center"><input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.',\'legal\')" '.$checked.' /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="'.$bill_id.'"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center">'.number_format((float)$key->suit_value,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')" value="'.$discount_amount.'"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" value="'.$key->discount_remarks.'" style="width:100px;"></td>
					</tr>';
				}
				
				$sl++;
			}
			if($legal_bill_counter==0)
			{
				$legal_bill_str.='<tr>
						<td style="text-align:center" colspan="12">Sorry No Data!!</td>
				</tr>';
			}
			$legal_bill_str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="11">Total Selected Amount : <span id="selected_amount_legal">'.$legal_amount.'</span></td></tr>';
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="11">Total Selected Amount Pending Bill : <span id="selected_amount">'.$amount.'</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($bill_details)."' />";
			$str.="<input type='hidden' id='legal_bill_count' name='legal_bill_count' value='".$legal_bill_counter."' />";
			$str.="<input type='hidden' id='bill_select' name='bill_select' value='".$selected."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="12">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
				"lawyer_info"=>$lawyer_info,
				"legal_bill_str"=>$legal_bill_str,
    			"result"=>$result,
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_paper_bill_edit_data()
	{
		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_add_action_data_paper_bill($id);
		$vendor_details = $this->Bill_ho_model->get_vendor_bank_details($result->vendor_id);
		if(!empty($vendor_details))
		{
			$branch_name = $vendor_details->branch_name;
		}
		else
		{
			$branch_name = '';
		}
		$bill_details = $this->Bill_ho_model->get_bill_details_paper_bill($result->vendor,$result->vendor_type,$result->legal_region,$result->legal_district);
		$str = '';
		$checked="";
		$delete = 1;
		$desabled = "";

		if (!empty($bill_details)) 
		{
			$sl=1;$amount=0;$selected=0;
			foreach ($bill_details as $key) 
			{
				$tin = $key->tin;
				$bin = $key->bin;
				$desabled = "";
				$checked="";
				$bill_id = 0;
				if($key->memo_sts!=0)
				{
					
					if($key->bill_id==$id) //For This memo bill select
					{
						$checked="checked";
						$amount=$amount+$key->amount;
						$selected++;
						$delete = 0;
						$bill_id = $id;
					}
					else //For other's memo selectd bill
					{
						$desabled = "disabled";
						$delete = 1;
					}
					
				}else
				{
					$checked="";
					$delete = 1;
				}
				 if ($key->paper_scan_copy!='' && $key->paper_scan_copy!=NULL) {
	                $paper_scan_copy='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/paper_scan_copy/'.$key->paper_scan_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	            }else{$paper_scan_copy="";}

	            if ($key->paper_expense_approval_file!='' && $key->paper_expense_approval_file!=NULL) {
	                $paper_expense_approval_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/paper_expense_approval_file/'.$key->paper_expense_approval_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
	            }else{$paper_expense_approval_file="";}
	            $discount_amount = ($key->discount_amount>0)?$key->discount_amount:"";
				$str.='<tr>
							<td style="text-align:center"><input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" '.$checked.' /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="'.$bill_id.'"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->paper_name.'</td>
							<td style="text-align:center">'.$key->loan_ac.'</td>
							<td style="text-align:center">'.$key->case_number.'</td>
							<td style="text-align:center">'.$key->ac_name.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$paper_scan_copy.'</td>
							<td style="text-align:center">'.$paper_expense_approval_file.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
							<td style="text-align:center"><input type="text" name="discount_'.$sl.'" id="discount_'.$sl.'" style="width:100px;" onkeypress="return numbersonly(event)" onchange="calculate_discount_amount('.$sl.')" value="'.$discount_amount.'"></td>
							<td style="text-align:center"><input type="text" name="discount_remarks_'.$sl.'" id="discount_remarks_'.$sl.'" value="'.$key->discount_remarks.'" style="width:100px;"></td>
					</tr>';
				$sl++;
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="11">Total Selected Amount : <span id="selected_amount">'.$amount.'</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($bill_details)."' />";
			$str.="<input type='hidden' id='bill_select' name='bill_select' value='".$selected."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="11">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"result"=>$result,
    			"tin"=>$tin,
    			"bin"=>$bin,
    			"branch_name"=>$branch_name,
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function get_other_bill_edit_data()
	{
		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		$result = $this->Bill_ho_model->get_add_action_data_other_bill($id);
		$bill_details = $this->Bill_ho_model->get_bill_details_other_bill($result->vendor_name);
		$str = '';
		$checked="";
		$delete = 1;
		$desabled = "";

		if (!empty($bill_details)) 
		{
			$sl=1;$amount=0;$selected=0;
			foreach ($bill_details as $key) 
			{
				$desabled = "";
				$checked="";
				$bill_id = 0;
				if($key->memo_sts!=0)
				{
					
					if($key->bill_id==$id) //For This memo bill select
					{
						$checked="checked";
						$amount=$amount+$key->amount;
						$selected++;
						$delete = 0;
						$bill_id = $id;
					}
					else //For other's memo selectd bill
					{
						$desabled = "disabled";
						$delete = 1;
					}
					
				}else
				{
					$checked="";
					$delete = 1;
				}
				$str.='<tr>
							<td style="text-align:center"><input type="checkbox" '.$desabled.' name="chkBoxSelect'.$sl.'" id="chkBoxSelect'.$sl.'" onClick="CheckChanged_2(this,'.$sl.')" '.$checked.' /><input type="hidden" name="event_delete_'.$sl.'" id="event_delete_'.$sl.'" value="'.$delete.'"><input type="hidden" name="event_id_'.$sl.'" id="event_id_'.$sl.'" value="'.$key->id.'"><input type="hidden" name="event_amount_'.$sl.'" id="event_amount_'.$sl.'" value="'.$key->amount.'"><input type="hidden" name="event_memo_id_'.$sl.'" id="event_memo_id_'.$sl.'" value="'.$bill_id.'"></td>
							<td style="text-align:center">'.$sl.'</td>
							<td style="text-align:center">'.$key->vendor_name.'</td>
							<td style="text-align:center">'.$key->txrn_dt.'</td>
							<td style="text-align:center">'.$key->activities_name.'</td>
							<td style="text-align:center">'.number_format((float)$key->amount,2).'</td>
					</tr>';
				$sl++;
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="9">Total Selected Amount : <span id="selected_amount">'.$amount.'</span></td></tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='".count($bill_details)."' />";
			$str.="<input type='hidden' id='bill_select' name='bill_select' value='".$selected."' />";
		}
		else
		{
			$str.='<tr>
						<td style="text-align:center" colspan="9">Sorry No Data!!</td>
				</tr>';
			$str.="<input type='hidden' id='billcount' name='billcount' value='0' />";
		}
		$var =array(
    			"result"=>$result,
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function staff_bill_details_old()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Bill_ho_model->get_row_details_staff($id);
		$bill_details = $this->Bill_ho_model->get_staff_bill_details_by_id($id);
    	if (!empty($details)) 
    	{
    		if ($details->file_for_finance!='' && $details->file_for_finance!=NULL) {
                $file_for_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_for_finance/'.$details->file_for_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$file_for_finance="";}

            if ($details->file_from_finance!='' && $details->file_from_finance!=NULL) {
                $file_from_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_from_finance/'.$details->file_from_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$file_from_finance="";}
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>SL NO.:</strong>'.$details->sl_no.'</td>
						<td width="50%" align="left"><strong>Bill Type:</strong>Staff Conveyance</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Vendor:</strong>'.$details->vendor_name.'</td>
						<td width="50%" align="left"><strong>Bill Date:</strong>'.$details->bill_dt.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Received From field Recovery AM:</strong>'.$details->received_dt.'</td>
						<td width="50%" align="left"><strong>Tax Vat Text:</strong>'.$details->tax_vat_text.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Dispatch No.:</strong>'.$details->dispatch_no.'</td>
						<td width="50%" align="left"><strong>Bill Amount:</strong>'.number_format((float)$details->bill_amount,2).'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Discount Amount:</strong>'.number_format((float)$details->discount_amount,2).'</td>
						<td width="50%" align="left"><strong>Memo Remarks:</strong>'.$details->memo_remarks.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Entry By:</strong>'.$details->memo_e_by.'</td>
						<td width="50%" align="left"><strong>Memo Entry Date:</strong>'.$details->e_dt.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Verify By:</strong>'.$details->v_by.'</td>
						<td width="50%" align="left"><strong>Memo Verify Date:</strong>'.$details->v_dt.'</td>
					</tr>
					<tr>
                        
                        <td width="50%" align="left"><strong>Attachment For Finance:</strong>'.$file_for_finance.'</td>
                        <td width="50%" align="left"><strong>File Send To Finanace By:</strong>'.$details->stf_by.'</td>
                    </tr>
                    <tr>
						
						<td width="50%" align="left"><strong>File Send To Finanace Date Time:</strong>'.$details->stf_dt.'</td>
						<td width="50%" align="left"></td>
					</tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return File:</strong>'.$file_from_finance.'</td>
                        <td width="50%" align="left"><strong>File Return Reason:</strong>'.$details->finance_r_reason.'</td>
                    </tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return By:</strong>'.$details->finance_r_by.'</td>
                        <td width="50%" align="left"><strong>File Return Date Time:</strong>'.$details->finanace_r_dt.'</td>
                    </tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($bill_details)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="25%" style="font-weight: bold;text-align:center">Vendor Name</td>
						<td width="25%" style="font-weight: bold;text-align:center">Date of legal steps</td>
						<td width="25%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
						<td width="25%" style="font-weight: bold;text-align:center">Amount</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				foreach ($bill_details as $key) 
				{
					$str.='<tr>';
						$str.='<td align="center">'.$key->vendor_name.'</td>';
						$str.='<td align="center">'.$key->txrn_dt.'</td>';
						$str.='<td align="center">'.$key->activities_name.'</td>';
						$str.='<td align="center">'.number_format((float)$key->amount,2).'</td>';
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
	function staff_bill_details()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Bill_ho_model->get_row_details_staff($id);
		$bill_details = $this->Bill_ho_model->get_staff_bill_details_by_id($id);
    	if (!empty($details)) 
    	{
    		if ($details->file_for_finance!='' && $details->file_for_finance!=NULL) {
                $file_for_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_for_finance/'.$details->file_for_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$file_for_finance="";}

            if ($details->file_from_finance!='' && $details->file_from_finance!=NULL) {
                $file_from_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_from_finance/'.$details->file_from_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$file_from_finance="";}
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>SL NO.:</strong>'.$details->sl_no.'</td>
						<td width="50%" align="left"><strong>Bill Type:</strong>Staff Conveyence</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Dispatch No.:</strong>'.$details->dispatch_no.'</td>
						<td width="50%" align="left"><strong>Bill Amount:</strong>'.number_format((float)$details->bill_amount,2).'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Entry By:</strong>'.$details->memo_e_by.'</td>
						<td width="50%" align="left"><strong>Memo Entry Date:</strong>'.$details->e_dt.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Verify By:</strong>'.$details->v_by.'</td>
						<td width="50%" align="left"><strong>Memo Verify Date:</strong>'.$details->v_dt.'</td>
					</tr>
					<tr>
                        
                        <td width="50%" align="left"><strong>Attachment For Finance:</strong>'.$file_for_finance.'</td>
                        <td width="50%" align="left"><strong>File Send To Finanace By:</strong>'.$details->stf_by.'</td>
                    </tr>
                    <tr>
						
						<td width="50%" align="left"><strong>File Send To Finanace Date Time:</strong>'.$details->stf_dt.'</td>
						<td width="50%" align="left"></td>
					</tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return File:</strong>'.$file_from_finance.'</td>
                        <td width="50%" align="left"><strong>File Return Reason:</strong>'.$details->finance_r_reason.'</td>
                    </tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return By:</strong>'.$details->finance_r_by.'</td>
                        <td width="50%" align="left"><strong>File Return Date Time:</strong>'.$details->finanace_r_dt.'</td>
                    </tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($bill_details)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">SL</td>
						<td width="15%" style="font-weight: bold;text-align:center">Staff Pin</td>
						<td width="15%" style="font-weight: bold;text-align:center">Staff Name</td>
						<td width="15%" style="font-weight: bold;text-align:center">Conveyence Type</td>
						<td width="15%" style="font-weight: bold;text-align:center">Amount</td>
						<td width="15%" style="font-weight: bold;text-align:center">Diduction</td>
						<td width="15%" style="font-weight: bold;text-align:center">Diduction Remarks</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				$sl=0;
				$total = 0;
				foreach ($bill_details as $key) 
				{
					$total = $total+$key->amount;
					$sl++;
					$str.='<tr>';
						$str.='<td align="center">'.$sl.'</td>';
						$str.='<td align="center">'.$key->staff_pin.'</td>';
						$str.='<td align="center">'.$key->employee_name.'</td>';
						$str.='<td align="center">'.$key->conv_type_name.'</td>';
						$str.='<td align="center">'.number_format((float)$key->amount,2).'</td>';
						$str.='<td align="center">'.($key->diduction_amount>0?number_format((float)$key->diduction_amount,2):'').'</td>';
						$str.='<td align="center">'.$key->diduction_remarks.'</td>';
					$str.='</tr>';
				}
				$str.='<tr>';
						$str.='<td colspan="6" align="right">Total</td>';
						$str.='<td align="center">'.number_format((float)$total,2).'</td>';
				$str.='</tr>';
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
	function court_bill_details()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Bill_ho_model->get_row_details_court($id);
		$bill_details = $this->Bill_ho_model->get_court_bill_details_by_id($id);
    	if (!empty($details)) 
    	{
    		if ($details->file_for_finance!='' && $details->file_for_finance!=NULL) {
                $file_for_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_for_finance/'.$details->file_for_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$file_for_finance="";}

            if ($details->file_from_finance!='' && $details->file_from_finance!=NULL) {
                $file_from_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_from_finance/'.$details->file_from_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$file_from_finance="";}
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>SL NO.:</strong>'.$details->sl_no.'</td>
						<td width="50%" align="left"><strong>Bill Type:</strong>Court Entertainment</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Dispatch No.:</strong>'.$details->dispatch_no.'</td>
						<td width="50%" align="left"><strong>Bill Amount:</strong>'.number_format((float)$details->bill_amount,2).'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Entry By:</strong>'.$details->memo_e_by.'</td>
						<td width="50%" align="left"><strong>Memo Entry Date:</strong>'.$details->e_dt.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Verify By:</strong>'.$details->v_by.'</td>
						<td width="50%" align="left"><strong>Memo Verify Date:</strong>'.$details->v_dt.'</td>
					</tr>
					<tr>
                        
                        <td width="50%" align="left"><strong>Attachment For Finance:</strong>'.$file_for_finance.'</td>
                        <td width="50%" align="left"><strong>File Send To Finanace By:</strong>'.$details->stf_by.'</td>
                    </tr>
                    <tr>
						
						<td width="50%" align="left"><strong>File Send To Finanace Date Time:</strong>'.$details->stf_dt.'</td>
						<td width="50%" align="left"></td>
					</tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return File:</strong>'.$file_from_finance.'</td>
                        <td width="50%" align="left"><strong>File Return Reason:</strong>'.$details->finance_r_reason.'</td>
                    </tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return By:</strong>'.$details->finance_r_by.'</td>
                        <td width="50%" align="left"><strong>File Return Date Time:</strong>'.$details->finanace_r_dt.'</td>
                    </tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($bill_details)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Pin</td>
						<td width="10%" style="font-weight: bold;text-align:center">Employee Name</td>
						<td width="15%" style="font-weight: bold;text-align:center">Job Grade</td>
						<td width="10%" style="font-weight: bold;text-align:center">Functional Designation</td>
						<td width="10%" style="font-weight: bold;text-align:center">Region</td>
						<td width="10%" style="font-weight: bold;text-align:center">Amount</td>
						<td width="10%" style="font-weight: bold;text-align:center">Diduction</td>
						<td width="10%" style="font-weight: bold;text-align:center">Invoice Amount</td>
						<td width="10%" style="font-weight: bold;text-align:center">Diduction Remarks</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				$total_ded = 0;
				$total = 0;
				foreach ($bill_details as $key) 
				{
					$total = $total+$key->amount;
					$total_ded = $total_ded+($key->diduction_amount>0?(float)$key->diduction_amount:0);
					$str.='<tr>';
						$str.='<td align="center">'.$key->staff_pin.'</td>';
						$str.='<td align="center">'.$key->employee_name.'</td>';
						$str.='<td align="center">'.$key->job_grade.'</td>';
						$str.='<td align="center">'.$key->functional_desig.'</td>';
						$str.='<td align="center">'.$key->legal_region.'</td>';
						$str.='<td align="center">'.number_format((float)$key->amount,2).'</td>';
						$str.='<td align="center">'.($key->diduction_amount>0?number_format((float)$key->diduction_amount,2):'').'</td>';
						$str.='<td align="center">'.($key->diduction_amount>0?number_format((float)$key->amount-(float)$key->diduction_amount,2):'').'</td>';
						$str.='<td align="center">'.$key->diduction_remarks.'</td>';
					$str.='</tr>';
				}
				$str.='<tr>';
						$str.='<td colspan="5" align="right">Total</td>';
						$str.='<td align="center">'.number_format((float)$total,2).'</td>';
						$str.='<td align="center">'.number_format((float)$total_ded,2).'</td>';
						$str.='<td align="center">'.number_format((float)$total-(float)$total_ded,2).'</td>';
				$str.='</tr>';

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
	function lawyer_bill_details()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Bill_ho_model->get_row_details_lawyer($id);
		$bill_details = $this->Bill_ho_model->get_lawyer_bill_details_by_id($id);
    	if (!empty($details)) 
    	{
    		if ($details->file_for_finance!='' && $details->file_for_finance!=NULL) {
                $file_for_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_for_finance/'.$details->file_for_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$file_for_finance="";}

            if ($details->file_from_finance!='' && $details->file_from_finance!=NULL) {
                $file_from_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_from_finance/'.$details->file_from_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$file_from_finance="";}

    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>SL NO.:</strong>'.$details->sl_no.'</td>
						<td width="50%" align="left"><strong>Bill Type:</strong>Lawyer Bill</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Vendor:</strong>'.$details->vendor_name.'</td>
						<td width="50%" align="left"><strong>Bill Date:</strong>'.$details->bill_dt.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Received From field Recovery AM:</strong>'.$details->received_dt.'</td>
						<td width="50%" align="left"><strong>Tax Vat Text:</strong>'.$details->tax_vat_text.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Dispatch No.:</strong>'.$details->dispatch_no.'</td>
						<td width="50%" align="left"><strong>Bill Amount:</strong>'.number_format((float)$details->bill_amount,2).'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Discount Amount:</strong>'.number_format((float)$details->discount_amount,2).'</td>
						<td width="50%" align="left"><strong>Memo Remarks:</strong>'.$details->memo_remarks.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Entry By:</strong>'.$details->memo_e_by.'</td>
						<td width="50%" align="left"><strong>Memo Entry Date:</strong>'.$details->e_dt.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Verify By:</strong>'.$details->v_by.'</td>
						<td width="50%" align="left"><strong>Memo Verify Date:</strong>'.$details->v_dt.'</td>
					</tr>
					<tr>
                        
                        <td width="50%" align="left"><strong>Attachment For Finance:</strong>'.$file_for_finance.'</td>
                        <td width="50%" align="left"><strong>File Send To Finanace By:</strong>'.$details->stf_by.'</td>
                    </tr>
                    <tr>
						
						<td width="50%" align="left"><strong>File Send To Finanace Date Time:</strong>'.$details->stf_dt.'</td>
						<td width="50%" align="left"></td>
					</tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return File:</strong>'.$file_from_finance.'</td>
                        <td width="50%" align="left"><strong>File Return Reason:</strong>'.$details->finance_r_reason.'</td>
                    </tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return By:</strong>'.$details->finance_r_by.'</td>
                        <td width="50%" align="left"><strong>File Return Date Time:</strong>'.$details->finanace_r_dt.'</td>
                    </tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($bill_details)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Vendor Name</td>
						<td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
						<td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
						<td width="15%" style="font-weight: bold;text-align:center">Case No.</td>
						<td width="10%" style="font-weight: bold;text-align:center">Date of legal steps</td>
						<td width="10%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
						<td width="10%" style="font-weight: bold;text-align:center">Bill Amount</td>
						<td width="10%" style="font-weight: bold;text-align:center">Discount Amount</td>
						<td width="10%" style="font-weight: bold;text-align:center">Invoice Amount</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				$total = 0;
				$total_discount = 0;
				$total_invoice = 0;
				foreach ($bill_details as $key) 
				{
					$total = $total+$key->amount;
					$total_discount = $total_discount+$key->discount_amount;
					$total_invoice = $total_invoice+$key->invoice_amount;
					$str.='<tr>';
						$str.='<td align="center">'.$key->vendor_name.'</td>';
						$str.='<td align="center">'.$key->loan_ac.'</td>';
						$str.='<td align="center">'.$key->ac_name.'</td>';
						$str.='<td align="center">'.$key->case_number.'</td>';
						$str.='<td align="center">'.$key->txrn_dt.'</td>';
						$str.='<td align="center">'.$key->activities_name.'</td>';
						$str.='<td align="center">'.number_format((float)$key->amount,2).'</td>';
						$str.='<td align="center">'.number_format((float)$key->discount_amount,2).'</td>';
						$str.='<td align="center">'.number_format((float)$key->invoice_amount,2).'</td>';
					$str.='</tr>';
				}
				$str.='<tr>';
						$str.='<td colspan="6" align="right">Total</td>';
						$str.='<td align="center">'.number_format((float)$total,2).'</td>';
						$str.='<td align="center">'.number_format((float)$total_discount,2).'</td>';
						$str.='<td align="center">'.number_format((float)$total_invoice,2).'</td>';
				$str.='</tr>';

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
	function court_fee_details()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Bill_ho_model->get_row_details_court_fee($id);
		$bill_details = $this->Bill_ho_model->get_court_fee_details_by_id($id);
    	if (!empty($details)) 
    	{
    		if ($details->file_for_finance!='' && $details->file_for_finance!=NULL) {
    			$file_for_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_for_finance/'.$details->file_for_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
    		}else{$file_for_finance="";}

    		if ($details->file_from_finance!='' && $details->file_from_finance!=NULL) {
    			$file_from_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_from_finance/'.$details->file_from_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
    		}else{$file_from_finance="";}

    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>SL NO.:</strong>'.$details->sl_no.'</td>
						<td width="50%" align="left"><strong>Bill Type:</strong>Court Fee</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Vendor:</strong>'.$details->vendor_name.'</td>
						<td width="50%" align="left"><strong>Bill Date:</strong>'.$details->bill_dt.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Received From field Recovery AM:</strong>'.$details->received_dt.'</td>
						<td width="50%" align="left"><strong>Tax Vat Text:</strong>'.$details->tax_vat_text.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Dispatch No.:</strong>'.$details->dispatch_no.'</td>
						<td width="50%" align="left"><strong>Bill Amount:</strong>'.number_format((float)$details->bill_amount,2).'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Discount Amount:</strong>'.number_format((float)$details->discount_amount,2).'</td>
						<td width="50%" align="left"><strong>Memo Remarks:</strong>'.$details->memo_remarks.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Entry By:</strong>'.$details->memo_e_by.'</td>
						<td width="50%" align="left"><strong>Memo Entry Date:</strong>'.$details->e_dt.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Verify By:</strong>'.$details->v_by.'</td>
						<td width="50%" align="left"><strong>Memo Verify Date:</strong>'.$details->v_dt.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Attachment For Finance:</strong>'.$file_for_finance.'</td>
						<td width="50%" align="left"><strong>File Send To Finanace By:</strong>'.$details->stf_by.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>File Send To Finanace Date Time:</strong>'.$details->stf_dt.'</td>
						<td width="50%" align="left"></td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Finance Return File:</strong>'.$file_from_finance.'</td>
						<td width="50%" align="left"><strong>File Return Reason:</strong>'.$details->finance_r_reason.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Finance Return By:</strong>'.$details->finance_r_by.'</td>
						<td width="50%" align="left"><strong>File Return Date Time:</strong>'.$details->finanace_r_dt.'</td>
					</tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($bill_details)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Vendor Name</td>
						<td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
						<td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
						<td width="15%" style="font-weight: bold;text-align:center">Case No.</td>
						<td width="10%" style="font-weight: bold;text-align:center">Date of legal steps</td>
						<td width="10%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
						<td width="10%" style="font-weight: bold;text-align:center">Bill Amount</td>
						<td width="10%" style="font-weight: bold;text-align:center">Discount Amount</td>
						<td width="10%" style="font-weight: bold;text-align:center">Invoice Amount</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				$total = 0;
				$total_discount = 0;
				$total_invoice = 0;
				foreach ($bill_details as $key) 
				{
					$total = $total+$key->amount;
					$total_discount = $total_discount+$key->discount_amount;
					$total_invoice = $total_invoice+$key->invoice_amount;
					$str.='<tr>';
						$str.='<td align="center">'.$key->vendor_name.'</td>';
						$str.='<td align="center">'.$key->loan_ac.'</td>';
						$str.='<td align="center">'.$key->ac_name.'</td>';
						$str.='<td align="center">'.$key->case_number.'</td>';
						$str.='<td align="center">'.$key->txrn_dt.'</td>';
						$str.='<td align="center">'.$key->activities_name.'</td>';
						$str.='<td align="center">'.number_format((float)$key->amount,2).'</td>';
						$str.='<td align="center">'.number_format((float)$key->discount_amount,2).'</td>';
						$str.='<td align="center">'.number_format((float)$key->invoice_amount,2).'</td>';
					$str.='</tr>';
				}
				$str.='<tr>';
						$str.='<td colspan="6" align="right">Total</td>';
						$str.='<td align="center">'.number_format((float)$total,2).'</td>';
						$str.='<td align="center">'.number_format((float)$total_discount,2).'</td>';
						$str.='<td align="center">'.number_format((float)$total_invoice,2).'</td>';
				$str.='</tr>';

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
	function paper_bill_details()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Bill_ho_model->get_row_details_paper_bill($id);
		$bill_details = $this->Bill_ho_model->get_paper_bill_details_by_id($id);
    	if (!empty($details)) 
    	{
    		$dist_result = $this->User_info_model->get_dist_data($details->legal_district);
			$ops_dist='';
			if(is_object($dist_result)){$ops_dist=$dist_result->ops_dist;}
			
    		if ($details->file_for_finance!='' && $details->file_for_finance!=NULL) {
                $file_for_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_for_finance/'.$details->file_for_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$file_for_finance="";}

            if ($details->file_from_finance!='' && $details->file_from_finance!=NULL) {
                $file_from_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_from_finance/'.$details->file_from_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$file_from_finance="";}
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>SL NO.:</strong>'.$details->sl_no.'</td>
						<td width="50%" align="left"><strong>Bill Type:</strong>Paper Bill</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Vendor:</strong>'.$details->vendor_name.'</td>
						<td width="50%" align="left"><strong>Bill Date:</strong>'.$details->bill_dt.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Received From field Recovery AM:</strong>'.$details->received_dt.'</td>
						<td width="50%" align="left"><strong>Tax Vat Text:</strong>'.$details->tax_vat_text.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Dispatch No.:</strong>'.$details->dispatch_no.'</td>
						<td width="50%" align="left"><strong>Bill Amount:</strong>'.number_format((float)$details->bill_amount,2).'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Bill Month:</strong>'.$details->bill_months.'</td>
						<td width="50%" align="left"><strong>Legal Region:</strong>'.$details->legal_region_name.'</td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Legal District:</strong>'.$ops_dist.'</td>
						<td width="50%" align="left"><strong>Discount Amount:</strong>'.number_format((float)$details->discount_amount,2).'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Entry By:</strong>'.$details->memo_e_by.'</td>
						<td width="50%" align="left"><strong>Memo Remarks:</strong>'.$details->memo_remarks.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Verify By:</strong>'.$details->v_by.'</td>
						<td width="50%" align="left"><strong>Memo Entry Date:</strong>'.$details->e_dt.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Attachment For Finance:</strong>'.$file_for_finance.'</td>
						<td width="50%" align="left"><strong>Memo Verify Date:</strong>'.$details->v_dt.'</td>
					</tr>
					<tr>
                        <td width="50%" align="left"><strong>Finance Return File:</strong>'.$file_from_finance.'</td>
                        
                        <td width="50%" align="left"><strong>File Send To Finanace By:</strong>'.$details->stf_by.'</td>
                    </tr>
                    <tr>
						
						<td width="50%" align="left"><strong>File Send To Finanace Date Time:</strong>'.$details->stf_dt.'</td>
						<td width="50%" align="left"></td>
					</tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return By:</strong>'.$details->finance_r_by.'</td>
                        <td width="50%" align="left"><strong>File Return Reason:</strong>'.$details->finance_r_reason.'</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left"><strong>File Return Date Time:</strong>'.$details->finanace_r_dt.'</td>
                        <td width="50%" align="left"></td>
                    </tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($bill_details)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="10%" style="font-weight: bold;text-align:center">Paper Name</td>
						<td width="10%" style="font-weight: bold;text-align:center">Account No.</td>
						<td width="15%" style="font-weight: bold;text-align:center">Account Name</td>
						<td width="10%" style="font-weight: bold;text-align:center">Publication Date</td>
						<td width="10%" style="font-weight: bold;text-align:center">Publication Copy</td>
						<td width="10%" style="font-weight: bold;text-align:center">Approval Copy</td>
						<td width="10%" style="font-weight: bold;text-align:center">Bill Amount</td>
						<td width="10%" style="font-weight: bold;text-align:center">Discount Amount</td>
						<td width="10%" style="font-weight: bold;text-align:center">Invoice Amount</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				$total = 0;
				$total_discount = 0;
				$total_invoice = 0;
				foreach ($bill_details as $key) 
				{
					 if ($key->paper_scan_copy!='' && $key->paper_scan_copy!=NULL) {
		                $paper_scan_copy='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/paper_scan_copy/'.$key->paper_scan_copy.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
		            }else{$paper_scan_copy="";}
		             if ($key->paper_expense_approval_file!='' && $key->paper_expense_approval_file!=NULL) {
		                $paper_expense_approval_file='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/paper_expense_approval_file/'.$key->paper_expense_approval_file.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
		            }else{$paper_expense_approval_file="";}
		            $total = $total+$key->amount;
					$total_discount = $total_discount+$key->discount_amount;
					$total_invoice = $total_invoice+$key->invoice_amount;

					$str.='<tr>';
						$str.='<td align="center">'.$key->paper_name.'</td>';
						$str.='<td align="center">'.$key->loan_ac.'</td>';
						$str.='<td align="center">'.$key->ac_name.'</td>';
						$str.='<td align="center">'.$key->txrn_dt.'</td>';
						$str.='<td align="center">'.$paper_scan_copy.'</td>';
						$str.='<td align="center">'.$paper_expense_approval_file.'</td>';
						$str.='<td align="center">'.number_format((float)$key->amount,2).'</td>';
						$str.='<td align="center">'.number_format((float)$key->discount_amount,2).'</td>';
						$str.='<td align="center">'.number_format((float)$key->invoice_amount,2).'</td>';

					$str.='</tr>';
				}
				$str.='<tr>';
						$str.='<td colspan="6" align="right">Total</td>';
						$str.='<td align="center">'.number_format((float)$total,2).'</td>';
						$str.='<td align="center">'.number_format((float)$total_discount,2).'</td>';
						$str.='<td align="center">'.number_format((float)$total_invoice,2).'</td>';
				$str.='</tr>';

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
	function other_bill_details()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Bill_ho_model->get_row_details_other_bill($id);
		$bill_details = $this->Bill_ho_model->get_other_bill_details_by_id($id);
    	if (!empty($details)) 
    	{
    		if ($details->file_for_finance!='' && $details->file_for_finance!=NULL) {
                $file_for_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_for_finance/'.$details->file_for_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$file_for_finance="";}

            if ($details->file_from_finance!='' && $details->file_from_finance!=NULL) {
                $file_from_finance='<img id="file_preview" onclick="popup(\''.base_url().'cma_file/file_from_finance/'.$details->file_from_finance.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
            }else{$file_from_finance="";}
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">
					<tr>
						<td width="50%" align="left"><strong>SL NO.:</strong>'.$details->sl_no.'</td>
						<td width="50%" align="left"><strong>Bill Type:</strong>Paper Bill</td>
					</tr>
    				<tr>
						<td width="50%" align="left"><strong>Vendor:</strong>'.$details->vendor_name.'</td>
						<td width="50%" align="left"><strong>Bill Date:</strong>'.$details->bill_dt.'</td>
						
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Received From field Recovery AM:</strong>'.$details->received_dt.'</td>
						<td width="50%" align="left"><strong>Tax Vat Text:</strong>'.$details->tax_vat_text.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Dispatch No.:</strong>'.$details->dispatch_no.'</td>
						<td width="50%" align="left"><strong>Bill Amount:</strong>'.number_format((float)$details->bill_amount,2).'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Discount Amount:</strong>'.number_format((float)$details->discount_amount,2).'</td>
						<td width="50%" align="left"><strong>Memo Remarks:</strong>'.$details->memo_remarks.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Entry By:</strong>'.$details->memo_e_by.'</td>
						<td width="50%" align="left"><strong>Memo Entry Date:</strong>'.$details->e_dt.'</td>
					</tr>
					<tr>
						
						<td width="50%" align="left"><strong>Memo Verify By:</strong>'.$details->v_by.'</td>
						<td width="50%" align="left"><strong>Memo Verify Date:</strong>'.$details->v_dt.'</td>
					</tr>
					<tr>
                        
                        <td width="50%" align="left"><strong>Attachment For Finance:</strong>'.$file_for_finance.'</td>
                        <td width="50%" align="left"><strong>File Send To Finanace By:</strong>'.$details->stf_by.'</td>
                    </tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return File:</strong>'.$file_from_finance.'</td>
                        <td width="50%" align="left"><strong>File Return Reason:</strong>'.$details->finance_r_reason.'</td>
                    </tr>
                    <tr>
                        
                        <td width="50%" align="left"><strong>Finance Return By:</strong>'.$details->finance_r_by.'</td>
                        <td width="50%" align="left"><strong>File Return Date Time:</strong>'.$details->finanace_r_dt.'</td>
                    </tr>
					';
			$str.='</tbody>
				</table>';
				
    	}
    	if (!empty($bill_details)) 
    	{
    		$str.='<br/><div  style="background-color:#eaeaea;padding:10px;margin-top:10px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag">Bill Info</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
				<thead>
					<tr>
						<td width="25%" style="font-weight: bold;text-align:center">Vendor Name</td>
						<td width="25%" style="font-weight: bold;text-align:center">Date of legal steps</td>
						<td width="25%" style="font-weight: bold;text-align:center">Purpose/Activities</td>
						<td width="25%" style="font-weight: bold;text-align:center">Amount</td>
					</tr>
				</thead>
				<tbody id="guarantor_info">';
				$total = 0;
				foreach ($bill_details as $key) 
				{
					$total = $total+$key->amount;
					$str.='<tr>';
						$str.='<td align="center">'.$key->vendor_name.'</td>';
						$str.='<td align="center">'.$key->txrn_dt.'</td>';
						$str.='<td align="center">'.$key->activities_name.'</td>';
						$str.='<td align="center">'.number_format((float)$key->amount,2).'</td>';
					$str.='</tr>';
				}
				$str.='<tr>';
						$str.='<td colspan="3" align="right">Total</td>';
						$str.='<td align="center">'.number_format((float)$total,2).'</td>';
				$str.='</tr>';

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
	function formverify($id,$editrow=NULL)
	{
		$details = array();
		$details = $this->Bill_ho_model->get_row_details($id);
		$bill_details = $this->Bill_ho_model->get_bill_details_by_id($id);
		$data = array( 	
			   'option' => '',
			   'details' => $details,
			   'bill_details' => $bill_details,
			   'id' => $id,
			   'pages'=> 'bill_ho/pages/form_verify'		   
			 );
		$this->load->view('bill_ho/form_layout',$data);
	}
	function bills_delete_ho(){
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$reason = $this->input->post('delete_reason');
		$bill_details = $this->Bill_ho_model->bills_delete_ho($id,$reason);
		$var =array(
			"csrf_token"=>$csrf_token
			);
		echo json_encode($var);
	}
	function r_history()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$sah=$this->Bill_ho_model->get_r_history($this->input->post('id'),$this->input->post('life_cycle'),$this->input->post('bill_type'));
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
	function get_segment_wise_data($data_array,$segment_code)
	{
		if(!empty($data_array))
		{
			for ($i=0; $i < count($data_array); $i++) { 
				$str = explode("_",(string) $data_array[$i]);//exploding segment code from data
				if($str[0]==$segment_code)//checking the segment code
				{
					return $str[1];
				}
			}
		}
		else
		{
			return "";
		}
		return "";
	}
	function mk_xl_all_report(){
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
	    $result=array();
	    $result = $this->Bill_ho_model->get_all_report_data($_POST['report_type']);
	   
	        $rowNumber=1;
	        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(15);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.'X'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;
	        $headings1 = array('BILL INFORMATION');
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':X'.$rowNumber); 
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFont()->setSize(16);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	       	$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFont()->setBold(true);
	        $rowNumber++;
	        $rowNumber++;
	        $headings2 = array('SL No.','Dispatch No.','Status','Vendor Name','Tax Vat Text','Bill Amount','Bill Months','Discount Amount','LITIGATION MGT.-SME Total Account','LITIGATION MGT.-SME Total Amount','LITIGATION MGT.-SME Total Discount','LITIGATION MGT.-RETAIL Total Account','LITIGATION MGT.-RETAIL Total Amount','LITIGATION MGT.-RETAIL Total Discount','CRM-SAM-CORP Total Account','CRM-SAM-CORP Total Amount','CRM-SAM-CORP Total Discount','Memo Remarks','Region','District','Memo Entry By','Memo Entry Date','Memo Verify By','Memo Verify Date');
	        
	        $objPHPExcel->getActiveSheet()->fromArray(array($headings2),NULL,'A'.$rowNumber);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFont()->setBold(true);	
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber.':X'.$rowNumber)->getAlignment()->setWrapText(true);
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F28A8C')));
	        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->applyFromArray($styleArray_border);
	        $rowNumber++;   
	        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
	        $rowNumber++;
	        $report_type = $_POST['report_type'];
	        $loop_counter=0;
	        $active_sheet=0;
	        if(!empty($result))
	        {
	        	foreach($result as $row){
	        		$loop_counter++;
	      			
	      			$ac_arr = explode("###",(string) $row->protfolio_wise_account);
	      			$amount_arr = explode("###",(string) $row->protfolio_wise_amount);
	      			$damount_arr = explode("###",(string) $row->protfolio_wise_discount);
	      			$ops_dist='';
			        if($report_type=='paper_bill')
			        {
			        	$dist_result = $this->User_info_model->get_dist_data($row->legal_district);
						if(is_object($dist_result)){$ops_dist=str_replace("<br>",",",(string) $dist_result->ops_dist);}
			        }
			        else
			        {
			        	$ops_dist=$row->district_name;
			        }

			        if($loop_counter>100000) //create new sheet
			        {
			        	$loop_counter=0;
	        			$active_sheet++;
			        	$objPHPExcel->createSheet();
						$objPHPExcel->setActiveSheetIndex($active_sheet);
						$objPHPExcel->getActiveSheet()->setTitle('Bill Report'); 

						$rowNumber=1;
						$rowNumber++;
				        $headings1 = array('BILL INFORMATION');
				        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':X'.$rowNumber); 
				        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFont()->setSize(16);
				        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				       	$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setWrapText(true);
				        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFont()->setBold(true);
				        $rowNumber++;
				        $rowNumber++;
				        $headings2 = array('SL No.','Dispatch No.','Status','Vendor Name','Tax Vat Text','Bill Amount','Bill Months','Discount Amount','LITIGATION MGT.-SME Total Account','LITIGATION MGT.-SME Total Amount','LITIGATION MGT.-SME Total Discount','LITIGATION MGT.-RETAIL Total Account','LITIGATION MGT.-RETAIL Total Amount','LITIGATION MGT.-RETAIL Total Discount','CRM-SAM-CORP Total Account','CRM-SAM-CORP Total Amount','CRM-SAM-CORP Total Discount','Memo Remarks','Region','District','Memo Entry By','Memo Entry Date','Memo Verify By','Memo Verify Date');
				        
				        $objPHPExcel->getActiveSheet()->fromArray(array($headings2),NULL,'A'.$rowNumber);
				        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFont()->setBold(true);	
				        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setWrapText(true);
				        $objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber.':X'.$rowNumber)->getAlignment()->setWrapText(true);
				        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F28A8C')));
				        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->applyFromArray($styleArray_border);
				        $rowNumber++;   
				        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
				        $rowNumber++;

			        }
			      	$dataar = array(
			                  $row->sl_no,
			                  $row->dispatch_no,
			                  $row->status,
			                  $row->vendor_name,
			                  $row->tx_name,
			                  $row->bill_amount,
			                  $row->bill_months,
			                  $row->discount_amount,
			                  $this->get_segment_wise_data($ac_arr,'S'),
			                  $this->get_segment_wise_data($amount_arr,'S'),
			                  $this->get_segment_wise_data($damount_arr,'S'),
			                  $this->get_segment_wise_data($ac_arr,'R'),
			                  $this->get_segment_wise_data($amount_arr,'R'),
			                  $this->get_segment_wise_data($damount_arr,'R'),
			                  $this->get_segment_wise_data($ac_arr,'C'),
			                  $this->get_segment_wise_data($amount_arr,'C'),
			                  $this->get_segment_wise_data($damount_arr,'C'),
			                  $row->memo_remarks,
			                  $row->region_name,
			                  $ops_dist,
			                  $row->e_by,
			                  $row->e_dt,
			                  $row->v_by,
			                  $row->v_dt
			              );
			      	$objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
			      	$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getFont()->setSize(9);
				    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->applyFromArray($styleArray_border);
			      	$objPHPExcel->getActiveSheet()->setCellValueExplicit(('A'.$rowNumber), $row->sl_no, PHPExcel_Cell_DataType::TYPE_STRING);
			      	$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $row->dispatch_no, PHPExcel_Cell_DataType::TYPE_STRING);
			      	$rowNumber++;
			    }
	        }
	    $rowNumber++;
	    $rowNumber--;
	    $rowNumber--;
	    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':X'.$rowNumber)->applyFromArray($styleArray_border); 

	    $objPHPExcel->setActiveSheetIndex(0);
	        $objPHPExcel->getActiveSheet()->setTitle('Bill Report'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');//Excel2007

	        ob_start();

	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="Bill_report.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output'); 
	        $xlsData = ob_get_contents();
	        ob_end_clean();
	        //ob_clean();
	        $csrf_token = $this->security->get_csrf_hash();
	        $response =  array(
	            'op' => 'ok',
	            'csrf_token'=>$csrf_token,
	            'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
	        );

	        die(json_encode($response));
	}
	function mk_xl_all_report_both_all_and_account_wise(){
	   require_once('./application/Classes/PhpXlsxGenerator.php'); 
		//require_once 'PhpXlsxGenerator.php';
		// Excel file name for download 
		if(isset($_POST['ac_wise']))
		{
			$fileName = "bill-data_" . date('Y-m-d') . ".xlsx"; 
		    $result = $this->Bill_ho_model->get_all_report_data_ac_wise($_POST['report_type']);
		    // Define column names 
			$excelData[] = array(
				'SL No.',
				'Dispatch No.',
				'Status',
				'Vendor Name',
				'AC/Card No',
				'AC Name',
				'Activities Name',
				'Activities date',
				'Case Number',
				'Type Of Case',
				'Bill Amount',
				'Discount Amount',
				'Memo Remarks',
				'Region',
				'District',
				'Bill Month',
				'Sent to Finance Date',
				'Reference Number',
				'Memo Entry By',
				'Memo Entry Date',
				'Memo Verify By',
				'Memo Verify Date',
			); 
		        
			        
	        if(!empty($result))
	        {
	        	foreach($result as $row){
	        		$loop_counter++;
			        if($row->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
	                  {
	                    $loan_ac = $this->Common_model->stringEncryption('decrypt',$row->org_loan_ac);
	                  }
	                  else
	                  {
	                    $loan_ac = $row->loan_ac;
	                  }
	                $lineData = array(
	                	$row->sl_no,
	                	$row->dispatch_no,
	                	$row->status,
	                	$row->vendor_name,
			    		$loan_ac,
		                $row->ac_name,
		                $row->act_name,
		                $row->txrn_dt,
		                $row->case_number,
		                $row->type_of_case,
		                $row->bill_amount,
		                $row->discount_amount,                   
		                $row->memo_remarks,                   
		                $row->region_name,                   
		                $row->district_name,                   
		                $row->bill_months,                   
		                $row->stf_dt,                   
		                $row->vendor_ref_no,                   
		                $row->e_by,                   
		                $row->e_dt,                   
		                $row->v_by,                   
		                $row->v_dt
			    	);  
			        $excelData[] = $lineData; 
			    }
	        }
	        // Export data to excel and download as xlsx file 
			$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
			$xlsx->downloadAs($fileName); 
		}

		if(isset($_POST['all_bill']))
		{
			$fileName = "bill-data_" . date('Y-m-d') . ".xlsx"; 
		    $result = $this->Bill_ho_model->get_all_report_data($_POST['report_type']);
		    // Define column names 
			$excelData[] = array(
				'SL No.',
				'Dispatch No.',
				'Status',
				'Vendor Name',
				'Tax Vat Text',
				'Bill Amount',
				'Bill Months',
				'Discount Amount',
				'LITIGATION MGT.-SME Total Account',
				'LITIGATION MGT.-SME Total Amount',
				'LITIGATION MGT.-SME Total Discount',
				'LITIGATION MGT.-RETAIL Total Account',
				'LITIGATION MGT.-RETAIL Total Amount',
				'LITIGATION MGT.-RETAIL Total Discount',
				'CRM-SAM-CORP Total Account',
				'CRM-SAM-CORP Total Amount',
				'CRM-SAM-CORP Total Discount',
				'Memo Remarks',
				'Region',
				'District',
				'Memo Entry By',
				'Memo Entry Date',
				'Memo Verify By',
				'Memo Verify Date',
			); 
		        
			        
	        if(!empty($result))
	        {
	        	foreach($result as $row){
	      			$ac_arr = explode("###",(string) $row->protfolio_wise_account);
	      			$amount_arr = explode("###",(string) $row->protfolio_wise_amount);
	      			$damount_arr = explode("###",(string) $row->protfolio_wise_discount);
	      			$ops_dist='';
			        if($_POST['report_type']=='paper_bill')
			        {
			        	$dist_result = $this->User_info_model->get_dist_data($row->legal_district);
						if(is_object($dist_result)){$ops_dist=str_replace("<br>",",",(string) $dist_result->ops_dist);}
			        }
			        else
			        {
			        	$ops_dist=$row->district_name;
			        }

			      	$dataar = array(
			                  $row->sl_no,
			                  $row->dispatch_no,
			                  $row->status,
			                  $row->vendor_name,
			                  $row->tx_name,
			                  $row->bill_amount,
			                  $row->bill_months,
			                  $row->discount_amount,
			                  $this->get_segment_wise_data($ac_arr,'S'),
			                  $this->get_segment_wise_data($amount_arr,'S'),
			                  $this->get_segment_wise_data($damount_arr,'S'),
			                  $this->get_segment_wise_data($ac_arr,'R'),
			                  $this->get_segment_wise_data($amount_arr,'R'),
			                  $this->get_segment_wise_data($damount_arr,'R'),
			                  $this->get_segment_wise_data($ac_arr,'C'),
			                  $this->get_segment_wise_data($amount_arr,'C'),
			                  $this->get_segment_wise_data($damount_arr,'C'),
			                  $row->memo_remarks,
			                  $row->region_name,
			                  $ops_dist,
			                  $row->e_by,
			                  $row->e_dt,
			                  $row->v_by,
			                  $row->v_dt
			              );
			        $excelData[] = $dataar; 
			    }
	        }
	        // Export data to excel and download as xlsx file 
			$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
			$xlsx->downloadAs($fileName); 
		}	
		 
		exit; 
		
	}
	function mk_xl_all_report_ac_wise_old(){
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
	    $result=array();
	    $result = $this->Bill_ho_model->get_all_report_data_ac_wise($_POST['report_type']);
	   
	        $rowNumber=1;
	        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
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
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
	        
	        
			$headings1 = array('BILL INFORMATION');
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':V'.$rowNumber); 
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getFont()->setSize(16);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		       	$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getAlignment()->setWrapText(true);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getFont()->setBold(true);
		        $rowNumber++;
		        $rowNumber++;
		        $headings2 = array('SL No.','Dispatch No.','Status','Vendor Name','AC/Card No',
		        	'AC Name','Activities Name','Activities Date','Case Number','Type Of Case',
		        	'Bill Amount','Discount Amount','Memo Remarks','Region',
		        	'District','Bill Month','Sent to Finance Date','Reference Number',
		        	'Memo Entry By','Memo Entry Date','Memo Verify By','Memo Verify Date');
		        
		        $objPHPExcel->getActiveSheet()->fromArray(array($headings2),NULL,'A'.$rowNumber);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getFont()->setBold(true);	
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getAlignment()->setWrapText(true);
		        $objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber.':V'.$rowNumber)->getAlignment()->setWrapText(true);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F28A8C')));
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->applyFromArray($styleArray_border);
		        $rowNumber++;   
		        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
		        $rowNumber++;
		        $report_type = $_POST['report_type'];
		        $loop_counter=0;
	        	$active_sheet=0;
		        if(!empty($result))
		        {
		        	foreach($result as $row){
		        		$loop_counter++;
				        if($row->proposed_type=='Card' && $this->session->userdata['ast_user']['unmasked_card_access']==1)
		                  {
		                    $loan_ac = $this->Common_model->stringEncryption('decrypt',$row->org_loan_ac);
		                  }
		                  else
		                  {
		                    $loan_ac = $row->loan_ac;
		                  }
		                if($loop_counter>100000) //create new sheet
				        {
				        	$loop_counter=0;
		        			$active_sheet++;
				        	$objPHPExcel->createSheet();
							$objPHPExcel->setActiveSheetIndex($active_sheet);
							$objPHPExcel->getActiveSheet()->setTitle('Bill Report'); 

							$rowNumber=1;
							$headings1 = array('BILL INFORMATION');
					        $objPHPExcel->getActiveSheet()->fromArray(array($headings1),NULL,'A'.$rowNumber);
					        $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':V'.$rowNumber); 
					        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getFont()->setSize(16);
					        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					       	$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getAlignment()->setWrapText(true);
					        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getFont()->setBold(true);
					        $rowNumber++;
					        $rowNumber++;
					        $headings2 = array('SL No.','Dispatch No.','Status','Vendor Name','AC/Card No',
					        	'AC Name','Activities Name','Activities Date','Case Number','Type Of Case',
					        	'Bill Amount','Discount Amount','Memo Remarks','Region',
					        	'District','Bill Month','Sent to Finance Date','Reference Number',
					        	'Memo Entry By','Memo Entry Date','Memo Verify By','Memo Verify Date');
					        
					        $objPHPExcel->getActiveSheet()->fromArray(array($headings2),NULL,'A'.$rowNumber);
					        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getFont()->setBold(true);	
					        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getAlignment()->setWrapText(true);
					        $objPHPExcel->getActiveSheet()->getStyle('F'.$rowNumber.':V'.$rowNumber)->getAlignment()->setWrapText(true);
					        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'F28A8C')));
					        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->applyFromArray($styleArray_border);
					        $rowNumber++;   
					        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
					        $rowNumber++;

				        }
				      	$dataar = array(
				                  $row->sl_no,
				                  $row->dispatch_no,
				                  $row->status,
				                  $row->vendor_name,
				                  $loan_ac,
				                  $row->ac_name,
				                  $row->act_name,
				                  $row->txrn_dt,
				                  $row->case_number,
				                  $row->type_of_case,
				                  $row->bill_amount,
				                  $row->discount_amount,
				                  $row->memo_remarks,
				                  $row->region_name,
				                  $row->district_name,
				                  $row->bill_months,
				                  $row->stf_dt,
				                  $row->vendor_ref_no,
				                  $row->e_by,
				                  $row->e_dt,
				                  $row->v_by,
				                  $row->v_dt
				              );
				      	$objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
				      	$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getFont()->setSize(9);
					    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->applyFromArray($styleArray_border);
				      	$objPHPExcel->getActiveSheet()->setCellValueExplicit(('A'.$rowNumber), $row->sl_no, PHPExcel_Cell_DataType::TYPE_STRING);
				      	$objPHPExcel->getActiveSheet()->setCellValueExplicit(('B'.$rowNumber), $row->dispatch_no, PHPExcel_Cell_DataType::TYPE_STRING);
				      	$objPHPExcel->getActiveSheet()->setCellValueExplicit(('E'.$rowNumber), $loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
				      	$rowNumber++;
				    }
		        }
			    $rowNumber++;
			    $rowNumber--;
			    $rowNumber--;
			    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':V'.$rowNumber)->applyFromArray($styleArray_border); 
		    
	        
	    	$objPHPExcel->setActiveSheetIndex(0);
	        $objPHPExcel->getActiveSheet()->setTitle('Bill Report'); 
	        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
	        require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');//Excel2007

	        ob_start();

	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="Bill_report.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output'); 
	        $xlsData = ob_get_contents();
	        ob_end_clean();
	        //ob_clean();
	        $csrf_token = $this->security->get_csrf_hash();
	        $response =  array(
	            'op' => 'ok',
	            'csrf_token'=>$csrf_token,
	            'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
	        );

	        die(json_encode($response));
	}
	function bulk_operation($operation=NULL,$module_name=NULL)
	{
		$operation_name='';
		if ($operation=='apv' && $module_name=='lawyer_bill') 
		{
			$operation_name='Approve Lawyer Bill';
		}
		if ($operation=='apv' && $module_name=='court_fee') 
		{
			$operation_name='Approve Court Fee';
		}
		if ($operation=='apv' && $module_name=='lawyer_bill_hc') 
		{
			$operation_name='Approve Lawyer Bill HC';
		}
		if ($operation=='apv' && $module_name=='paper_bill') 
		{
			$operation_name='Approve Paper Bill';
		}
		if ($operation=='apv' && $module_name=='court_enter') 
		{
			$operation_name='Approve Court Entertainment Bill';
		}
		if($this->session->userdata['ast_user']['legal_region']!='')
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
			   'module_name' => $module_name,
			   'operation_name' => $operation_name,
			   'pages'=> 'bill_ho/pages/bulk_operation',		   
			   );
		$this->load->view('bill_ho/form_layout',$data);
	}

	function load_bulk_data()
	{
		$this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
	    $grid_data=$this->Bill_ho_model->get_bulk_data();
	    $operation= $this->input->post('operation');
		$str='';
		$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
		<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<thead>
				<th width="2%"><input style="margin-left:7px" type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
				<th width="3%"  style="font-weight: bold;text-align:center">P</th>
				<th width="15%" style="font-weight: bold;text-align:left">Vendor Name</th>
				<th width="20%" style="font-weight: bold;text-align:left">Bill Amount</th>
				<th width="15%" style="font-weight: bold;text-align:left">SL No.</th>
				<th width="15%" style="font-weight: bold;text-align:left">Despatch No.</th>
				<th width="20%" style="font-weight: bold;text-align:left">Remarks</th>
			</thead>
			<tbody>';	
	
		if($this->input->post('module_name')=='lawyer_bill' || $this->input->post('module_name')=='court_fee' ||  $this->input->post('module_name')=='lawyer_bill_hc')
		{
			if(count($grid_data)<=0)
			{
				$str.='<tr><td colspan="7" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
				$str.='<input type="hidden" name="event_counter" id="event_counter" value="0">';
				$str.='</tbody></table></div>';
			}
			else{
				$i=1;
				foreach ($grid_data as $data) {
					$str.='<tr>';
					$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$data->id.'"></td>';
					$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\',\''.$this->input->post('module_name').'\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
					$str.='<td align="left">'.$data->lawyer_name.'</td>';
					$str.='<td align="left">'.$data->bill_amount.'</td>';
					$str.='<td align="left">'.$data->sl_no.'</td>';
					$str.='<td align="left" >'.$data->dispatch_no.'</td>';
					$str.='<td align="left">'.$data->memo_remarks.'</td>';
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
		}
		else if($this->input->post('module_name')=='paper_bill')
		{
			if(count($grid_data)<=0)
			{
				$str.='<tr><td colspan="7" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
				$str.='<input type="hidden" name="event_counter" id="event_counter" value="0">';
				$str.='</tbody></table></div>';
			}
			else{
				$i=1;
				foreach ($grid_data as $data) {
					$str.='<tr>';
					$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$data->id.'"></td>';
					$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\',\''.$this->input->post('module_name').'\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
					$str.='<td align="left">'.$data->vendor_name.'</td>';
					$str.='<td align="left">'.$data->bill_amount.'</td>';
					$str.='<td align="left">'.$data->sl_no.'</td>';
					$str.='<td align="left" >'.$data->dispatch_no.'</td>';
					$str.='<td align="left">'.$data->memo_remarks.'</td>';
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
		}
		else if($this->input->post('module_name')=='court_enter')
		{
			if(count($grid_data)<=0)
			{
				$str.='<tr><td colspan="7" style="font-weight: bold;text-align:center">Sorry No Data!!</td></tr>';
				$str.='<input type="hidden" name="event_counter" id="event_counter" value="0">';
				$str.='</tbody></table></div>';
			}
			else{
				$i=1;
				foreach ($grid_data as $data) {
					$str.='<tr>';
					$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="id_'.$i.'" id="id_'.$i.'" value="'.$data->id.'"></td>';
					$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\',\''.$this->input->post('module_name').'\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
					$str.='<td align="left"></td>';
					$str.='<td align="left">'.$data->bill_amount.'</td>';
					$str.='<td align="left">'.$data->sl_no.'</td>';
					$str.='<td align="left" >'.$data->dispatch_no.'</td>';
					$str.='<td align="left">'.$data->memo_remarks.'</td>';
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
			$id = $this->Bill_ho_model->bulk_acktion();
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
