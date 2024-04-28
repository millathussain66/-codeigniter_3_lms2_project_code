<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Warrant_arrest extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Warrant_arrest_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat,$menu_link=null,$submenu=null)
	{
		$add_edit='';$id="";
		$data = array(
			'add_edit' => $add_edit,
			'submenu' => $submenu,
			'menu_link' => $menu_link,
			'id' => $id,
			'arrested_by'=>$this->User_model->get_parameter_data('ref_arrested_by','name','data_status = 1'),
			'execution_criteria'=>$this->User_model->get_parameter_data('ref_execution_criteria','name','data_status = 1'),
			'nature_warrent'=>$this->User_model->get_parameter_data('ref_nature_warrent_arrest','name','data_status = 1'),
			'disposal_sts'=>$this->User_model->get_parameter_data('ref_disposal_sts','name','data_status = 1'),
			'executor_type'=>$this->User_model->get_parameter_data('user_group','group_name','data_status = 1'),
			//'executor_type'=>$this->Warrant_arrest_model->get_executor_type('user_group','id',array(1,2,3,4),'group_name,id'),
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			
	   		'per_page' => $this->config->item('per_pagess')
		   );
		if($submenu=='executed'){
			$data['pages']='warrant_arrest/pages/executed_grid';
		}elseif($submenu=='settled'){
			$data['pages']='warrant_arrest/pages/setteled_grid';
		}elseif($submenu=='pending_incentive'){
			$data['pages']='warrant_arrest/pages/pending_incentive';
		}elseif($submenu=='executed_incentive'){
			$data['pages']='warrant_arrest/pages/executed_incentive';
		}else{
			$data['pages']='warrant_arrest/pages/grid';
		}
		$this->load->view('grid_layout',$data);
	}

	function grid()
	{

		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Warrant_arrest_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
		
	}
	function executed_grid(){
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Warrant_arrest_model->get_executed_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function setteled_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Warrant_arrest_model->get_setteled_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function pending_incentive_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Warrant_arrest_model->get_pending_incentive_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function executed_incentive_grid(){
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Warrant_arrest_model->get_executed_incentive_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function from($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$this->load->model('Ait_vat_model', '', TRUE);
		$result = $this->Ait_vat_model->get_info($add_edit,$id);
		$data = array(
					 'option' => '',
					 'add_edit' => $add_edit,
					 'result' => $result,
					 'id' => $id,
					 'vendor'=>$this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
					 'lawyer'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
					 'certificate_type'=>$this->User_model->get_parameter_data('ref_certificate_type','name','data_status = 1'),
					 'request_from'=>$this->User_model->get_parameter_data('ref_expense_type','name','data_status = 1'),
					 'pages'=> 'warrant_arrest/pages/form',
					 'editrow' => $editrow
					 );
		$this->load->view('ait_vat/form_layout',$data);

	}
	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Warrant_arrest_model->add_edit_action($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";

		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
			//$row=$this->Warrant_arrest_model->get_add_action_data($id);
			$row=[];
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
	function delete_action(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Warrant_arrest_model->delete_action();
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
			else if($this->input->post("type")=='delete'){$row[]='';}
			else{$row[]=''; //$row=$this->Legal_notice_model->get_recommend_info($id);
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
	function incentive_delete_action(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Warrant_arrest_model->incentive_delete_action();
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
			else if($this->input->post("type")=='delete'){$row[]='';}
			else{$row[]=''; //$row=$this->Legal_notice_model->get_recommend_info($id);
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
	function get_guarrentor_info($cma_id){
		
		$csrf_token=$this->security->get_csrf_hash();
		$table = "cma_guarantor";
		$where = array('cma_id'=>$cma_id);
		$rows = $this->Warrant_arrest_model->get_guarrentor_ower_info($table,$where);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}
	function get_user_name($pin){
		
		$csrf_token=$this->security->get_csrf_hash();
		$table = "users_info";
		$where = array('pin'=>$pin);
		$rows = $this->Warrant_arrest_model->select_where($table,$where,'name,id,user_group_id');
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}
	function get_executed_row_details($id){
		$csrf_token=$this->security->get_csrf_hash();
		$rows = $this->Warrant_arrest_model->get_executed_row_details($id);
		
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}
	function get_executed_row_edit($id){
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$rows = $this->Warrant_arrest_model->get_executed_row_edit($id);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}

	function search_case()
	{
		$csrf_token=$this->security->get_csrf_hash();

		$where = "s.case_sts_prev_dt=29";
		//$where = "s.sts=75";

		if(trim($this->input->post('s_case_number')) != '')
		{ $where.= " AND s.case_number='".trim($this->input->post('s_case_number'))."'"; }
		if(trim($this->input->post('s_proposed_type')) != '')
		{ $where.= " AND s.proposed_type='".trim($this->input->post('s_proposed_type'))."'"; }
		if($this->input->post('s_account')!=''){
			if($this->input->post('s_proposed_type')=='Card'){
		    	$card=$this->Common_model->stringEncryption('encrypt',$this->security->xss_clean($this->input->post('hidden_loan_ac')));

		    	$where.= " AND s.org_loan_ac='".$card."'"; 
		    }else{
		    	$where.= " AND s.loan_ac='".trim($this->input->post('s_account'))."'";
		    }
		}
			$sql ="SELECT s.*,c.sl_no,c.proposed_type,c.loan_ac,c.ac_name,c.legal_region,n.name AS case_n,o.guarantor_name AS owner_name,o.guarantor_type AS owner_type 
					FROM suit_filling_info s 
					LEFT JOIN cma c ON c.id = s.cma_id 
					LEFT JOIN ref_case_name n ON n.id = s.case_name 
					LEFT JOIN cma_guarantor o ON o.cma_id = s.cma_id AND o.guarantor_type = 'M' 
				WHERE ".$where;
			$q=$this->db->query($sql);
			$suit_row = $q->result();
		$str_html="";
		if(count($suit_row)>0)
		{
			$str_html.="<br/><table cellpadding='5' cellspacing='0' style='width:96%;border-collapse: collapse;border-color:#c0c0c0;' >
			<tr bgcolor='#e8e8e8' ><td style='width:5%;border:1px solid #a0a0a0;text-align:center'><strong>Select</strong></td>
			<td style='width:15%;border:1px solid #a0a0a0'><strong>Case Number</strong></td>
			<td style='width:27%;border:1px solid #a0a0a0'><strong>Loan AC</strong></td>
			<td style='width:20%;border:1px solid #a0a0a0'><strong>AC Name</strong></td>";
			$sl =1;
			foreach($suit_row as $row)
			{

				$str_html.="<tr>
				<td style='border:1px solid #a0a0a0;text-align:center'><input type='checkbox' id='suit_' name='suit_id' onclick='onlyOne(this)' value='".$row->id."' /></td>
				<td style='border:1px solid #a0a0a0'>".$row->case_number."
				<input type='hidden' id='case_number_".$sl."' value='".$row->case_number."' />
				<input type='hidden' id='loan_ac_".$sl."' value='".$row->loan_ac."' />
				<input type='hidden' id='cma_id_".$sl."' value='".$row->cma_id."' />
				<input type='hidden' id='suit_id_".$sl."' value='".$row->id."' />
				<input type='hidden' id='ac_name_".$sl."' value='".$row->ac_name."' />
				<td style='border:1px solid #a0a0a0'>".$row->loan_ac."</td>
				<td style='border:1px solid #a0a0a0'>".$row->ac_name."</td>
				</tr>";
				$sl++;
			}
			$str_html.="<input type='hidden' id='suitCount' value='".count($suit_row)."' />
				<tr><td colspan='4'></td></tr>
				<tr><td colspan='4' align='center'><button type='button' class='buttonStyle' style='background-color: rgb(24, 88, 145); color: rgb(255, 255, 255); border-radius: 20px !important; height: 50px; width: 150px; font-family: sans-serif; font-size: 16px;' onclick='loadsuit()'>Next</button></td></tr>
			</table>";
		}
		else
		{
			$str_html.="No Result Found !!!";
		}
		echo $str_html."####".$csrf_token;
	}

	function get_suit_info($id){
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$this->db->select('s.*,c.sl_no,c.proposed_type,c.loan_ac,c.ac_name,c.legal_region,
    	n.name as case_n, o.guarantor_name as owner_name,o.guarantor_type as owner_type
    	', FALSE)
			->from("suit_filling_info s")
			->join('cma c', 'c.id=s.cma_id', 'left')
			->join('ref_case_name n', 'n.id=s.case_name', 'left')
			->join('cma_guarantor o', 'o.cma_id=s.cma_id AND o.guarantor_type="M"', 'left')
			->where(array('s.id'=>$id))
			->limit(1);
		$q=$this->db->get();
		$suit_row = $q->row();
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$suit_row;
		echo json_encode($var);
		//echo $suit_row."####".$csrf_token;
	}

	function get_details($id){

		$csrf_token=$this->security->get_csrf_hash();
		if($id!=''){
		$rows = $this->Warrant_arrest_model->get_details($id);
		}else{
			$rows='';
		}
		echo $rows.'####'.$csrf_token;
	}

	function executed_incentive_xl(){
		$result = $this->Warrant_arrest_model->executed_incentive_xl();
		//print_r($rows);

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
        
       
        //'Permanent Address','Present Address','Business Address',
        $rowNumber=1;
        $headings2 = array('Executor Name','Pin','Group Name','Account Name','Account Number','Proposed Type','Case Number','Amount','Particulars','Payment Status');


    	/*  
    	if(in_array('Loan A/C No.',$headings2)){
          $key = array_search ('Loan A/C No.', $headings2);
          $objPHPExcel->getActiveSheet()->getStyle(xl_col($key))->getNumberFormat()-> setFormatCode (PHPExcel_Style_NumberFormat :: FORMAT_NUMBER);
        }
        
    	*/
    	$objPHPExcel->getActiveSheet()->fromArray(array('WA Executed Incentive Report'),NULL,'A'.$rowNumber);
    	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':J'.$rowNumber); 
    	$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);

    	$rowNumber++;
        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->applyFromArray($styleArray_border);
        //$objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':AD'.$rowNumber); 
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFont()->setSize(10);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':AN'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':J'.$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':L'.$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FDE9D9')));
        
        $rowNumber++;
        $tem=0;
        $total=count($result);
       	foreach($result as $key=> $row){
       		$i= $key+1;
            $dataar=array(
            	$row->user_name,
				$row->pin,
				$row->group_name,
				$row->ac_name,
				$row->loan_ac,
				$row->proposed_type,
				$row->case_number,
				$row->amount,
				$row->pariculars,
				$row->paid_sts,
            );
	       $objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
	       $objPHPExcel->getActiveSheet()->setCellValueExplicit(('E'.$rowNumber), $row->loan_ac, PHPExcel_Cell_DataType::TYPE_STRING);
	        $rowNumber++;
            
        }

        //$d=$d+($tem*4);  
        $rowNumber++;
        $rowNumber--;
        $rowNumber--;
        $objPHPExcel->getActiveSheet()->getStyle('A1:J'.$rowNumber)->applyFromArray($styleArray_border); 


        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('WA Executed Incentive'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007

        ob_clean();

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="Warrant_Executed_Incentive_Report.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
	}

}