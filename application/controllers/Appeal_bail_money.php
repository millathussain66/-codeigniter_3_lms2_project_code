<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appeal_bail_money extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
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
			'appeal_bail_type'=>$this->Appeal_bail_money_model->select_where('ref_appeal_bail_type','data_status=1','name,id'),
			'vendor'=>$this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
			'lawyer'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
			'district'=>$this->User_model->get_parameter_data('ref_district','name','data_status = 1'),
			'user_group'=>$this->Appeal_bail_money_model->select_where('user_group','data_status=1 AND id IN (1,2,3,4)','group_name,id'),
	   		'per_page' => $this->config->item('per_pagess')
		   );
		if($submenu=='deposit'){
			$data['pages']='appeal_bail_money/pages/grid';
		}elseif($submenu=='withdrawn'){
			$data['pages']='appeal_bail_money/pages/withdrawn_grid';
		}elseif($submenu=='billing_pending'){
			$data['pages']='appeal_bail_money/pages/bill_pending';
		}elseif($submenu=='billing_completed'){
			$data['pages']='appeal_bail_money/pages/bill_completed';
		}elseif($submenu=='data_details'){
			if(isset($_POST['withdrawxl'])){
				$this->withdraw_xl();
			}else{
				$data['pages']='appeal_bail_money/pages/data_details';
			}
		}else{
			$data['pages']='appeal_bail_money/pages/pending';
		}
		$this->load->view('grid_layout',$data);
	}

	function grid()
	{

		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Appeal_bail_money_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
		
	}
	function pending_grid()
	{

		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Appeal_bail_money_model->get_pending_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
		
	}
	function withdrawn_grid(){
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Appeal_bail_money_model->withdrawn_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function withdrawn_pending_grid(){
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Appeal_bail_money_model->withdrawn_pending_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function bill_pending_grid(){
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Appeal_bail_money_model->bill_pending_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function bill_completed_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Appeal_bail_money_model->bill_completed_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

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
	function data_details_grid(){
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Appeal_bail_money_model->data_details_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

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
	function add_edit_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Appeal_bail_money_model->add_edit_action();
		}
		else{
			$text[]="Session out, login required";

		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
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
	function add_edit_withdraw_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$add_edit =$this->input->post('add_edit');
			$edit_id=$this->input->post('edit_row');
			$id = $this->Appeal_bail_money_model->add_edit_withdraw_action($add_edit,$edit_id);
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
			$id = $this->Appeal_bail_money_model->delete_action();
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
			else{$row[]='';
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
	function withdraw_delete_action(){
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Appeal_bail_money_model->withdraw_delete_action();
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
			else{$row[]=''; 
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
	
	function get_case_info(){
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$rows = $this->Appeal_bail_money_model->get_case_info($id);

		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}

	function ni_pending_deposit(){
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$rows = $this->Appeal_bail_money_model->ni_pending_deposit($id);

		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}
	function get_deposit_file_info(){
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$rows = $this->Appeal_bail_money_model->get_deposit_file_info($id);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		//echo json_encode($var);
		echo $rows.'####'.$csrf_token;
	}
	function get_case_edit_info(){
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$rows = $this->Appeal_bail_money_model->get_case_edit_info($id);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		echo json_encode($var);
	}
	function get_deposit_file_edit_info(){
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$id = $this->input->post('id');
		$rows = $this->Appeal_bail_money_model->get_deposit_file_edit_info($id);
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$rows;
		$result = $rows->appeal_deposit;
		$idarr = explode(',',$rows->appeal_id);
		$html='';
		$html .='<table style="width: 100%;" class="preview_table2"><tr>
            <th><input type="checkbox" onclick="onlyOne(this)" name="ddd" id="parent"></th>
            <th>Account Name</th>
            <th>Account Number</th>
            <th>Loan Type</th>
            <th>Case Number</th>
            <th>Appeal Bail Type</th>
            <th>Deposited Amount</th>
            <th>Deposit Percent</th>
            <th>Deposited Date</th>
            <th>Arrested</th>
            </tr>';
        foreach($result as $key=>$val){
        		$checked='';
        		if(in_array($val->id,$idarr)){$checked='checked';}
            $html.='<tr>
                <td><input type="checkbox" '.$checked.' onclick="onlyOne(this)" class="child" name="check[]" id="check" value="'.$val->id.'"></td>
                <td>'.$val->ac_name.'</td>
                <td>'.$val->loan_ac.'</td>
                <td>'.$val->proposed_type.'</td>
                <td>'.$val->case_number.'</td>
                <td>'.$val->appeal_bail_type_name.'</td>
                <td>'.$val->deposit_amt.'</td>
                <td>'.$val->deposit_percent.'</td>
                <td>'.$val->deposit_date.'</td>
                <td>'.$val->arrested.'</td>
                </tr>';
        }
        $html .='</html>';
		
		echo json_encode($var).'####'.$html;
	}
	function get_details_pending_apeal($id){
		$csrf_token=$this->security->get_csrf_hash();
		if($id!=''){
			//echo $id;
		$rows = $this->Appeal_bail_money_model->get_details_pending_apeal($id);
		}else{
			$rows='';
		}
		echo $rows.'####'.$csrf_token;
	}
	function get_details($id){

		$csrf_token=$this->security->get_csrf_hash();
		if($id!=''){
			//echo $id;
		$rows = $this->Appeal_bail_money_model->get_details($id);
		}else{
			$rows='';
		}
		echo $rows.'####'.$csrf_token;
	}
	function get_details_withdraw(){

		$id = $this->input->post('id');
		$csrf_token=$this->security->get_csrf_hash();
		if($id!=''){
		$rows = $this->Appeal_bail_money_model->get_details_withdraw($id);
		}else{
			$rows='';
		}
		$var = array(
			"str" => $rows,
			"csrf_token" => $csrf_token
		);
		echo json_encode($var);
		//echo $rows.'####'.$csrf_token;
	}
	function get_details_withdraw_pending($id){

		$csrf_token=$this->security->get_csrf_hash();
		if($id!=''){
			//echo $id;
		$rows = $this->Appeal_bail_money_model->get_details_withdraw_pending($id);
		}else{
			$rows='';
		}
		echo $rows.'####'.$csrf_token;
	}

	function get_billing_details($id){
		$csrf_token=$this->security->get_csrf_hash();
		if($id!=''){
			//echo $id;
		$rows = $this->Appeal_bail_money_model->get_billing_details($id);
		}else{
			$rows='';
		}
		echo $rows.'####'.$csrf_token;
	}

	function search_case()
	{
		$csrf_token=$this->security->get_csrf_hash();

		$where = "";

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
			$sql ="SELECT s.* FROM suit_filling_info as s WHERE s.req_type=2 AND s.case_name=4 AND s.case_sts_prev_dt=29 AND s.sts<>0 AND s.suit_sts IN (75,76) AND s.life_cycle <> 3 ".$where."
				UNION ALL
				SELECT s.* FROM suit_filling_info  AS s
				INNER JOIN (SELECT * FROM suit_filling_info WHERE req_type=2 AND case_name=4 AND sts<>0 ) AS f ON f.id=s.pre_suit_id
				WHERE s.req_type=2 AND s.case_name IN (5,6) AND s.case_sts_prev_dt=29 AND s.sts<>0 AND s.suit_sts IN (75,76) AND s.re_case_sts=1 AND s.deposit_sts <> 1 ".$where;
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
				<input type='hidden' id='wa_id_".$sl."' value='' />
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

	function withdraw_xl(){
    	$where='';
        $ToDate = trim($this->input->post('dateto')); 
        $FromDate = trim($this->input->post('datefrom')); 
        $result = $this->Appeal_bail_money_model->withdraw_xl();
                
        /*echo '<pre>';
        print_r($result);
        echo '</pre>';
        exit;*/
        $sn = 1;
         
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
        $headings2 = array('Loan A/c','A/C Name','Case Number','Type','Deposit Amount','Deposit Date','Withdraw Date','Arrested','Status');
        
        $colnum = count($headings2);
        if($colnum==0){
          $colnum=1;
        }
      

        $objPHPExcel->getActiveSheet()->fromArray($headings2,NULL,'A'.$rowNumber); 
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
        //$objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FFFF00')));
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $rowNumber++;
        $tem=0;
        $total=count($result);
              foreach($result as $row){
                $acnum = $row['loan_ac'];
                if($row['proposed_type']=='Card'){ 
                  $acnum =$this->Common_model->stringEncryption('decrypt',$row['org_loan_ac']);
                }
                $dataar=array(
                      $row['loan_ac'],
                      $row['ac_name'],
                      $row['case_number'],
                      $row['appeal_bail_type'],
                      $row['deposit_amt'],
                      $row['deposit_dt'],
                      $row['withdraw_dt'],
                      $row['arrested'],
                      $row['status_name']
                    );
                
                $objPHPExcel->getActiveSheet()->fromArray($dataar,NULL,'A'.$rowNumber);
                if(in_array('Loan A/c',$headings2)){
                  $key = array_search ('Loan A/c', $headings2);
                  $objPHPExcel->getActiveSheet()->setCellValueExplicit((xl_col($key).$rowNumber), $acnum, PHPExcel_Cell_DataType::TYPE_STRING);
                }
                
                $rowNumber++;

              }
                $rowNumber++;
                $rowNumber--;
                $rowNumber--;
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.xl_col($colnum-1).$rowNumber)->applyFromArray($styleArray_border);
        
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Withdraw Report'); 
        //include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'IOFactory.php');
        require_once './application/Classes/PHPExcel/IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
        ob_clean();
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-type:   application/x-msexcel; charset=utf-8");
        header('Content-Disposition: attachment;filename="withdraw_xl.xls"');
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        $objWriter->save('php://output');   
        exit();
  }
}