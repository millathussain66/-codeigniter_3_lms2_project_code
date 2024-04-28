<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Legal_notice_ho extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Legal_notice_ho_model', '', TRUE);
		$this->load->model('Legal_notice_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'legal_notice_ho/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}

	function grid()
	{
		$this->load->model('Legal_notice_ho_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Legal_notice_ho_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function search_grid(){
		$result=$this->Legal_notice_ho_model->get_grid_data(0, '', '', 200, 0);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function bulk_operation($operation=NULL)
	{
		$operation_name='';
		$pages = 'legal_notice_ho/pages/bulk_operation';
		if ($operation=='ack') 
		{
			$operation_name='Acknowledgement';
		}
		if ($operation=='sta') 
		{
			$operation_name='Send To Approver';
		}
		if ($operation=='apv') 
		{
			$operation_name='Approve';
		}
		if ($operation=='lns') 
		{
			$operation_name='Legal Notice Sent';
		}
		if ($operation=='download') 
		{
			$operation_name='Bulk Legal Notice Download';
			$pages = 'legal_notice_ho/pages/bulk_download';
		}
		$region = $this->user_model->get_parameter_data('ref_region','name',"data_status = '1'");
		$territory = array();
		$unit_office = $this->user_model->get_parameter_data('ref_unit_office','name',"data_status = '1'");
		$district = $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'");
		$loan_segment = $this->user_model->get_parameter_data('ref_loan_segment','name',"data_status = '1'");
		$data = array( 	
			   'region' => $region,
			   'territory' => $territory,
			   'unit_office' => $unit_office,
			   'district' => $district,
			   'loan_segment' => $loan_segment,
			   'operation' => $operation,
			   'operation_name' => $operation_name,
			   'pages'=> $pages,		   
			   );
		$this->load->view('legal_notice_ho/form_layout',$data);
	}
	function load_bulk_data()
	{
		$this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
	    $grid_data=$this->Legal_notice_ho_model->get_bulk_data();
	    $operation= $this->input->post('operation');
	    if ($operation=='sta') 
	    {
	    	$link_id=175;
	    	$lawyer=$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1');
	    	$checker=$this->User_info_model->get_checker_data($link_id,'11');
	    }else{
	    	$lawyer=array();
	    	$checker=array();
	    }
		$str='';
		$str.='<div style="margin-top:10px;overflow-x:hidden;height:350px" class="grid_table_div">
		<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<thead>
				<th width="2%"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></th>
				<th width="3%"  style="font-weight: bold;text-align:center">P</th>
				<th width="10%" style="font-weight: bold;text-align:left">Serial</th>
				<th width="10%" style="font-weight: bold;text-align:left">Protfolio</th>
				<th width="15%" style="font-weight: bold;text-align:left">Loan A/C or Card No</th>
				<th width="10%" style="font-weight: bold;text-align:left">Region</th>
				<th width="10%" style="font-weight: bold;text-align:left">Territory</th>
				<th width="10%" style="font-weight: bold;text-align:left">District</th>
				<th width="10%" style="font-weight: bold;text-align:left">Unit Office</th>
				<th width="10%" style="font-weight: bold;text-align:left">Rec By</th>
				<th width="10%" style="font-weight: bold;text-align:left">Rec Date Time</th>
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
				if ($data->download_sts==1) {
					$style_color='bgcolor="#FFD700"';
				}else
				{
					$style_color='';
				}
				$str.='<tr '.$style_color.'>';
				$str.='<td align="center"><input type="checkbox" name="chkBoxSelect'.$i.'" id="chkBoxSelect'.$i.'" onClick="CheckChanged_2(this,\''.$i.'\')" value="chk"/><input type="hidden" name="event_delete_'.$i.'" id="event_delete_'.$i.'" value="1"><input type="hidden" name="event_id_'.$i.'" id="event_id_'.$i.'" value="'.$data->id.'"><input type="hidden" name="event_type_'.$i.'" id="event_type_'.$i.'" value="'.$data->proposed_type.'"></td>';
				$str.='<td align="center"><div style="text-align:center; cursor:pointer" onclick="details('.$data->id.',\'details\')" ><img align="center" src="'.base_url().'images/view_detail.png"></div></td>';
				$str.='<td align="left">'.$data->sl_no.'</td>';
				$str.='<td align="left">'.$data->loan_segment.'</td>';
				$str.='<td align="left">'.$data->loan_ac.'</td>';
				$str.='<td align="left">'.$data->region_name.'</td>';
				$str.='<td align="left">'.$data->territory_name.'</td>';
				$str.='<td align="left">'.$data->district_name.'</td>';
				$str.='<td align="left">'.$data->unit_office_name.'</td>';
				$str.='<td align="left">'.$data->rec_by.'</td>';
				$str.='<td align="left">'.$data->rec_dt.'</td>';
				$str.='</tr>';
				$i++;
			}
			$str.='<input type="hidden" name="event_counter" id="event_counter" value="'.($i-1).'">';
			$str.='</tbody></table></div>';
			$str.='<table class="result_table" border="0" style="margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			<tbody>';
			if ($operation=='sta') 
			{
				$str.='<tr>';
				$str.='<td width="10%" style="font-weight: bold;text-align:right">Select lawyer<span style="color:red">*</span></td>';
				$str.='<td width="10%" align="center"><div id="lawyer" name="lawyer" style="padding-left: 3px;margin: 0 auto;" tabindex="1"></div></td>';
				$str.='<td width="10%" align="center"></td>';
				$str.='<td width="10%" style="font-weight: bold;text-align:right">Select HOLM<span style="color:red">*</span></td>';
				$str.='<td width="10%" align="center"><div id="holm" name="holm" style="padding-left: 3px;margin: 0 auto;" tabindex="2"></div></td>';
				$str.='<td width="10%" align="center"></td>';
				$str.='</tr>';
			}
			$str.='<tr id="total_selection_row"><td style="font-weight: bold;text-align:center" colspan="6">Total Selected : <span id="selected_value">0</span></td></tr>';
		    $str.='</tbody></table>';
		}
		$var =array(
				"str"=>$str,
				"lawyer"=>$lawyer,
				"checker"=>$checker,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	function edit_facility($id=NULL,$proposed_type=NULL,$editrow=NULL)
	{
		if ($proposed_type==1) {
			$type='Loan';
		}else{$type='Card';}
		$result = $this->Legal_notice_ho_model->get_recommend_info($id);
		if ($type=='Loan') {
			$facility_info = $this->Legal_notice_ho_model->get_facility($id);
		}
		else{
			$facility_info = $this->Legal_notice_ho_model->get_edit_card_facility($id);
		}
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'facility_info' => $facility_info,
				   'legal_notice_guarantor' => $this->Legal_notice_model->get_guarantor_info('add',$id),
				   'lawyer'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
				   'facility_name'=>$this->User_model->get_parameter_data('ref_facility_name','name','data_status = 1'),
				   'cl'=>$this->User_model->get_parameter_data('ref_cl','name','data_status = 1'),
				   'id' => $id,
				   'proposed_type' => $type,
				   'pages'=> 'legal_notice_ho/pages/edit_facility_form',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('legal_notice_ho/form_layout',$data);
	}
	function fromcheck($id=NULL,$editrow=NULL,$proposed_type=NULL)
	{
		$link_id=175;
		if ($proposed_type==1) {
			$type='Loan';
		}else{$type='Card';}
		$result = $this->Legal_notice_ho_model->get_recommend_info($id);
		if ($type=='Loan') {
			$facility_info = $this->Legal_notice_ho_model->get_facility($id);
		}
		else{
			$facility_info = $this->Legal_notice_ho_model->get_card_facility($id);
		}
		$pre_ln_data = $this->Legal_notice_model->get_pre_ln_data_by_id($result->pre_ln_id);
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'facility_info' => $facility_info,
				   'pre_ln_data' => $pre_ln_data,
				   'checker_info' => $this->User_info_model->get_checker_data($link_id,'11'),
				   'legal_notice_guarantor' => $this->Legal_notice_model->get_guarantor_info('add',$id),
				   'lawyer'=>$this->User_model->get_parameter_data('ref_lawyer','name','data_status = 1'),
				   'facility_name'=>$this->User_model->get_parameter_data('ref_facility_name','name','data_status = 1'),
				   'id' => $id,
				   'proposed_type' => $type,
				   'pages'=> 'legal_notice_ho/pages/form_check',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('legal_notice_ho/form_layout',$data);
	}
	function formverify($id=NULL,$editrow=NULL,$proposed_type=NULL)
	{
		if ($proposed_type==1) {
			$type='Loan';
		}else{$type='Card';}
		$result = $this->Legal_notice_ho_model->get_recommend_info($id);
		if ($type=='Loan') {
			$facility_info = $this->Legal_notice_ho_model->get_facility($id);
		}
		else{
			$facility_info = $this->Legal_notice_ho_model->get_card_facility($id);
		}
		$pre_ln_data = $this->Legal_notice_model->get_pre_ln_data_by_id($result->pre_ln_id);
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'pre_ln_data' => $pre_ln_data,
				   'facility_info' => $facility_info,
				   'legal_notice_guarantor' => $this->Legal_notice_model->get_guarantor_info('add',$id),
				   'facility_name'=>$this->User_model->get_parameter_data('ref_facility_name','name','data_status = 1'),
				   'id' => $id,
				   'proposed_type' => $type,
				   'pages'=> 'legal_notice_ho/pages/form_verify',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('legal_notice_ho/form_layout',$data);
	}
	function ln_upload($id=NULL,$editrow=NULL,$proposed_type=NULL)
	{
		$this->Common_model->delete_tempfile();
		if ($proposed_type==1) {
			$type='Loan';
		}else{$type='Card';}
		$result = $this->Legal_notice_ho_model->get_recommend_info($id);
		if ($type=='Loan') {
			$facility_info = $this->Legal_notice_ho_model->get_facility($id);
		}
		else{
			$facility_info = $this->Legal_notice_ho_model->get_card_facility($id);
		}
		$data = array( 	
				   'option' => '',
				   'result' => $result,
				   'facility_info' => $facility_info,
				   'legal_notice_guarantor' => $this->Legal_notice_model->get_guarantor_info('add',$id),
				   'facility_name'=>$this->User_model->get_parameter_data('ref_facility_name','name','data_status = 1'),
				   'id' => $id,
				   'proposed_type' => $type,
				   'pages'=> 'legal_notice_ho/pages/upload',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('legal_notice_ho/form_layout',$data);
	}
	function upload_file()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Legal_notice_ho_model->upload_file();
		}
		else{
			$text[]="Session out, login required";
		}

		$Message='';
		if ($id!='00') {
			if(count($text)<=0){
			$Message='OK';
			$row=$this->Legal_notice_ho_model->get_add_action_data($id);
			}else{
				for($i=0; $i<count($text); $i++)
				{
					if($i>0){$Message.=',';}
					$Message.=$text[$i];				
				}	
				$row[]='';	
			}
		}
		else{$Message='Failed';}
		$var['csrf_token']=$csrf_token;
		$var['Message']=$Message;
		$var['row_info']=$row;
		$var['id']=$id;
		echo json_encode($var);
	}
	function update_file_download($id)
	{
		$download_id=$this->security->xss_clean($id);
		$result = $this->Legal_notice_ho_model->get_recommend_info($download_id);
		$file_url = 'legal_notice_file/updated_file/'.$result->updated_file;
		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
		readfile($file_url); 
	}
	function download_pdf($id=NULL,$proposed_type=NULL)
	{
		$data = array( 'id'=>$id,'proposed_type'=>$proposed_type,'bulk'=>0 );
		$this->load->view('legal_notice_ho/pages/legal_notice_pdf',$data);
		
	}
	function bulk_download_pdf($ids)
	{
		$data = array( 'id'=>$ids,'proposed_type'=>'','bulk'=>1 );
		$this->load->view('legal_notice_ho/pages/legal_notice_pdf',$data);
		
	}
	function download($download_id=0,$download_type=0)
	{
		if($download_id==0 && $download_type==0)
		{
			$download_id=$this->input->post('download_id'); 
			$download_type=$this->input->post('download_type');
		}
		$download_id=$this->security->xss_clean($download_id);
		$update_sl_sts = 0;
		$init = 0;
		$download_history_data = array(
			'ln_id' => $download_id,
			'd_by' => $this->session->userdata['ast_user']['user_id'],
			'd_dt' => date('Y-m-d H:i:s')
		);
		$this->db->insert('legal_notice_download_history', $download_history_data);
		//For Card
		if ($download_type=='Card') 
		{
			$br_address=array();
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
			
			$result = $this->Legal_notice_ho_model->get_word_card_data($download_id);

			//For Word Serial Number
			if ($result[0]['ln_serial']=='') {
				$new_sl_no=$this->user_model->get_word_serial(count($result[0]['guarntor']));
				$update_sl_sts = 1;
				$init = $new_sl_no;

			}else
			{
				$str = explode("-",$result[0]['ln_serial']);
				$new_sl_no = $str[0];
			}
			//$new_sl_no=1;
			// exit;
			$Q1 = $this->db->query("SELECT ln_address FROM project_info WHERE id='1'");
			$in_address = $Q1->result();
			
			

			$template = 'tbs/loan_LN/Legal_notice_Card_template.docx';
			$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
			
			$addr_type[]='Present Address';
			$addr_type[]='Parmanent Address';
			$addr_type[]='Business Address';
			
			$data_b = array();
			$counter=0;
			for($i=0;$i<count($result[0]['guarntor']);$i++){				
				
				for($j=0;$j<3;$j++){
					$counter++;
					$index = $i*3+$j;
										
					if($j==0){
						$address=$result[0]['guarntor'][$i]['present_address'];
						$address_field = 'present address';
					}elseif($j==1){
						$address=$result[0]['guarntor'][$i]['permanent_address'];
						$address_field = 'parmanent address';
					}elseif($j==2){
						$address=$result[0]['guarntor'][$i]['business_address'];
						$address_field = 'business address';
					}
					
					if($address==''){
						continue;
					}
					$array = array(
							'guarantor_id'=>$result[0]['guarntor'][$i]['id'],
							'ln_id'=>$download_id,
				            'br_counter'=>$new_sl_no,
				            'adress_field'=>$address_field,
				            'adress'=>$address
				    );
				    array_push($br_address,$array);
					$address_type=$addr_type[$i];
					
					if(strlen($address)>100){
						$address = wordwrap($address,100,"\n");
					}else{
						$address = $address."\n";
					}
					if(strlen($result[0]['chamber'])>100){
						$chamber = wordwrap($result[0]['chamber'],100,"\n");
					}else{
						$chamber = $result[0]['chamber']."\n";
					}
					if(strlen($in_address[0]->ln_address)>100){
						$bank_address = wordwrap($in_address[0]->ln_address,100,"\n");
					}else{
						$bank_address = $in_address[0]->ln_address."\n";
					}
					
					$data_b[$index] = array(
						'sl_number'=>$result[0]['sl_no'],
						'pre_sl'=>$new_sl_no,
						'date'=>$result[0]['ln_v_dt'],//date('d-M-Y'), 
						'loan_ac'=>$result[0]['loan_ac'],//$this->Common_model->stringEncryption('decrypt',$result[0]['org_loan_ac']),
						'customer_id'=>$result[0]['customer_id'],
						'ac_name'=>$result[0]['ac_name'],
						'father_name'=>$result[0]['guarntor'][$i]['father_name'],//$result[0]['father_name'],
						'lawyer_name'=>$result[0]['name'],
						'designation'=>$result[0]['designation'],
						'chamber'=>$chamber,
						'court_name'=>$result[0]['court_name'],
						'signature'=>$result[0]['signature']!=''?'ref_tables_files/'.$result[0]['signature']:'ref_tables_files/nosig.png',
						'outstanding_amount'=>number_format(abs($result[0]['outstanding_bl']),2,'.',','),
						'outstanding_date'=>$result[0]['outstanding_bl_dt'],//date('d-M-y'),
						'tm_name'=>$result[0]['tm_name'],
						'mobile_number'=>$result[0]['mobile_number'],
						'card_iss_date'=>$result[0]['card_iss_date'],
						'card_exp_date'=>$result[0]['card_exp_date'],
						'card_limit'=>number_format(abs($result[0]['card_limit']),2,'.',','),
						'address'=>preg_replace('/\s+/', ' ',$address),
						'addr_type'=>$address_type
					);	
					$new_sl_no++;					
				}
			}
			if ($update_sl_sts==1) {
				$update_sl = $init.'-'.($new_sl_no-1);
				$legal_notice_data['ln_serial'] = $update_sl;
				$legal_notice_data['download_sts'] = 1;
				$this->db->where('id', $download_id);
				$this->db->update('legal_notice', $legal_notice_data);
				$new_sl_no=$this->user_model->update_word_serial($new_sl_no-$init);

				$this->db->insert_batch('ln_address_by_br_serial', $br_address);
			}
			$TBS->MergeBlock('b', $data_b);
			$save_as='';
			$path='tbs/loan_LN_rslt/';
			$filename =	'Legal_notice_Card_template.docx';
			$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
			//$output_file_name =$path.$filename;
			//$TBS->Show(OPENTBS_FILE, $output_file_name);
			
			$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.

			exit;
		}
		//For loan
		else
		{
			$br_address=array();
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
			

			// A recordset for merging tables
			$result = $this->Legal_notice_ho_model->get_word_data($download_id);
			//For Word Serial Number
			if ($result[0]['ln_serial']=='') {
				$new_sl_no=$this->user_model->get_word_serial(count($result[0]['guarntor']));
				$update_sl_sts = 1;
				$init = $new_sl_no;
				// echo $new_sl_no;
				// exit;
			}else
			{
				$str = explode("-",$result[0]['ln_serial']);
				$new_sl_no = $str[0];
			}
			$Q1 = $this->db->query("SELECT ln_address FROM project_info WHERE id='1'");
			$in_address = $Q1->result();
			$cc_gurantor='';
			foreach($result[0]['guarntor'] as $key=>$gurantorc){
				if($key==0){
					$cc_gurantor = $gurantorc['guarantor_name'];
				}else{
					$cc_gurantor = $cc_gurantor.', '.$gurantorc['guarantor_name'];
				}
				
			}
			

			$template = 'tbs/loan_LN/LN_Borrower_template.docx';
			$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
			$chamber='';
			
			$data_b = array();
			$data = array();
			$brrower_name='';
			$counter=0;
			for($i=0;$i<count($result[0]['guarntor']);$i++){
				if($result[0]['guarntor'][$i]['guarantor_type']=='M'){
					$brrower_name=$result[0]['guarntor'][$i]['guarantor_name'];
				}
				for($j=0;$j<3;$j++){
					$index = $i*3+$j;
					$counter++;			
					if($j==0){
						$address=$result[0]['guarntor'][$i]['present_address'];
						$address_field = 'present address';
					}elseif($j==1){
						$address=$result[0]['guarntor'][$i]['permanent_address'];
						$address_field = 'parmanent address';
					}elseif($j==2){
						$address=$result[0]['guarntor'][$i]['business_address'];
						$address_field = 'business address';
					}
					
					if(ltrim($address," ")==''){
						continue;
					}
					
					$array = array(
							'guarantor_id'=>$result[0]['guarntor'][$i]['id'],
							'ln_id'=>$download_id,
				            'br_counter'=>$new_sl_no,
				            'adress_field'=>$address_field,
				            'adress'=>$address
				    );
				    array_push($br_address,$array);

					if(strlen($address)>100){
						$address = wordwrap($address,100,"\n");
					}else{
						$address = $address."\n";
					}
					if(strlen($result[0]['chamber'])>100){
						$chamber = wordwrap($result[0]['chamber'],100,"\n");
					}else{
						$chamber = $result[0]['chamber']."\n";
					}
					if(strlen($in_address[0]->ln_address)>100){
						$bank_address = wordwrap($in_address[0]->ln_address,100,"\n");
					}else{
						$bank_address = $in_address[0]->ln_address."\n";
					}
					
					$dis_amount_A=explode(",",$result[0]['facility_loan'][0]['disbursed_amount']);
					$disbursed_amount=0;
					for($e=0; $e<count($dis_amount_A); $e++){
						if($e==0){$disbursed_amount=number_format(abs($dis_amount_A[$e]));}
						else{ $disbursed_amount.=', '.number_format(abs($dis_amount_A[$e]));}
					}
					
					
					if($result[0]['guarntor'][$i]['guarantor_type']=='M'){
						
						$data_b[$index] = array(
							'pre_sl'=>$new_sl_no,
							'sl_number'=>$result[0]['sl_no'],
							'date'=>$result[0]['ln_v_dt'],//date('d-M-Y'), 
							'ac_no'=>$result[0]['loan_ac'],
							'ac_name'=>$result[0]['ac_name'],
							'brrower_name'=>$brrower_name,//$result[0]['brrower_name'],
							'father_name'=>$result[0]['guarntor'][$i]['father_name'],//$result[0]['father_name'],
							'lawyer_name'=>$result[0]['name'],
							'designation'=>$result[0]['designation'],
							'chamber'=>$chamber,
							'court_name'=>$result[0]['court_name'],
							'signature'=>$result[0]['signature']!=''?'ref_tables_files/'.$result[0]['signature']:'ref_tables_files/nosig.png',
							'l_ac_numbers'=>$result[0]['facility_loan'][0]['l_ac_numbers'], 
							'sch_desc'=>$result[0]['facility_loan'][0]['sch_desc_s'],
							'disbursement_amount'=>$disbursed_amount,
							'disbursement_dt'=>$result[0]['facility_loan'][0]['disbursement_date'],				    
							'l_ac_names'=>$result[0]['facility_loan'][0]['l_ac_names'],				    
							'outstanding_amount'=>number_format(abs($result[0]['facility_loan'][0]['outstanding_bl'])),
							'outstanding_date'=>$result[0]['facility_loan'][0]['outstanding_bl_dt'],
							'tm_name'=>$result[0]['tm_name'],
							'tm_mobile'=>$result[0]['mobile_number'],
							'cc_guarrantor_name'=>$cc_gurantor,
							'bank_address'=>$bank_address,
							'present_address'=>$address
						);						
						
					}else{
					
						$data[$index]=array(
							'pre_sl'=>$new_sl_no,
							'sl_number'=>$result[0]['sl_no'],
							'date'=>$result[0]['ln_v_dt'],//date('d-M-Y'), 
							'ac_no'=>$result[0]['loan_ac'],
							'ac_name'=>$result[0]['ac_name'],
							'brrower_name'=>$brrower_name,
							'father_name'=>$result[0]['guarntor'][$i]['father_name'],
							//'present_address'=>$result[0]['guarntor'][$i]['present_address'],
							'present_address'=>$address,
							'lawyer_name'=>$result[0]['name'],
							'designation'=>$result[0]['designation'],
							'chamber'=>$chamber,
							'court_name'=>$result[0]['court_name'],
							'signature'=>$result[0]['signature']!=''?'ref_tables_files/'.$result[0]['signature']:'ref_tables_files/nosig.png',
							'loan_ac_numbers'=>$result[0]['facility_loan'][0]['l_ac_numbers'], 
							'sch_desc'=>$result[0]['facility_loan'][0]['sch_desc_s'],
							'disbursement_amount'=>$disbursed_amount,
							'disbursement_dt'=>$result[0]['facility_loan'][0]['disbursement_date'],
							'l_ac_names'=>$result[0]['facility_loan'][0]['l_ac_names'],
							'outstanding_amount'=>number_format(abs($result[0]['facility_loan'][0]['outstanding_bl'])),
							'outstanding_date'=>$result[0]['facility_loan'][0]['outstanding_bl_dt'],
							'tm_name'=>$result[0]['tm_name'],
							'tm_mobile'=>$result[0]['mobile_number'],
							'guarrantor_name'=>$result[0]['guarntor'][$i]['guarantor_name'],
							'bank_address'=>$in_address[0]->ln_address
							);
					    
					}
					$new_sl_no++;	
				}
			}
			if ($update_sl_sts==1) {
				$update_sl = $init.'-'.($new_sl_no-1);
				$legal_notice_data['ln_serial'] = $update_sl;
				$legal_notice_data['download_sts'] = 1;
				$this->db->where('id', $download_id);
				$this->db->update('legal_notice', $legal_notice_data);
				$new_sl_no=$this->user_model->update_word_serial($new_sl_no-$init);

				$this->db->insert_batch('ln_address_by_br_serial', $br_address);
			}
			//exit;
			$TBS->MergeBlock('b', $data_b);
			$TBS->MergeBlock('d', $data);
			
			$save_as='';
			$path='tbs/loan_LN_rslt/';
			$filename =	'LN_Borrower_template.docx';
			$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
			//$output_file_name =$path.$filename;
			//$TBS->Show(OPENTBS_FILE, $output_file_name);
			
			$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				
			/*if(file_exists($output_file_name))
			{
			  header('Content-Disposition: attachment; filename=' . $filename);  
			  readfile($output_file_name); 
			}
			else
			{
			  echo 'File does not exists on given path';
			}*/

			exit;
			

		}
		
		
	}
	function bulk_download____backup__2022_04_28($ids)
	{
		$str2 = explode("_",$ids);
		$download_ids=$str2[1]; 
		$download_type=$str2[0]; 
		$final_counter = 0;
		$data_b = array();
		$data = array();
		for ($k=0; $k<count($str2); $k++) { 
			if($k==0) //For skiping the type
			{
				continue;
			}
			$download_id=$str2[$k]; 
			$update_sl_sts = 0;
			$init = 0;
			//For Card
			if ($download_type=='Card') 
			{
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
				
				$result = $this->Legal_notice_ho_model->get_word_card_data($download_id);

				//For Word Serial Number
				if ($result[0]['ln_serial']=='') {
					$new_sl_no=$this->user_model->get_word_serial(count($result[0]['guarntor']));
					$update_sl_sts = 1;
					$init = $new_sl_no;

				}else
				{
					$str = explode("-",$result[0]['ln_serial']);
					$new_sl_no = $str[0];
				}
				//$new_sl_no=1;
				// exit;
				$Q1 = $this->db->query("SELECT ln_address FROM project_info WHERE id='1'");
				$in_address = $Q1->result();
				
				

				$template = 'tbs/loan_LN/Legal_notice_Card_template.docx';
				$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
				
				$addr_type[]='Present Address';
				$addr_type[]='Parmanent Address';
				$addr_type[]='Business Address';
				
				$counter=0;
				for($i=0;$i<count($result[0]['guarntor']);$i++){				
					
					for($j=0;$j<3;$j++){
						$counter++;
						$index = $i*3+$j+$final_counter;
						echo $index;			
						if($j==0){
							$address=$result[0]['guarntor'][$i]['present_address'];
						}elseif($j==1){
							$address=$result[0]['guarntor'][$i]['permanent_address'];
						}elseif($j==2){
							$address=$result[0]['guarntor'][$i]['business_address'];
						}
						
						if(ltrim($address," ")==''){
							continue;
						}
						$address_type=$addr_type[$i];
						
						if(strlen($address)>100){
							$address = wordwrap($address,100,"\n");
						}else{
							$address = $address."\n";
						}
						if(strlen($result[0]['chamber'])>100){
							$chamber = wordwrap($result[0]['chamber'],100,"\n");
						}else{
							$chamber = $result[0]['chamber']."\n";
						}
						if(strlen($in_address[0]->ln_address)>100){
							$bank_address = wordwrap($in_address[0]->ln_address,100,"\n");
						}else{
							$bank_address = $in_address[0]->ln_address."\n";
						}
						
						$data_b[$index] = array(
							'pre_sl'=>$new_sl_no,
							'sl_number'=>$result[0]['sl_no'],
							'date'=>date('d-M-Y'), 
							'loan_ac'=>$result[0]['loan_ac'],//$this->Common_model->stringEncryption('decrypt',$result[0]['org_loan_ac']),
							'customer_id'=>$result[0]['customer_id'],
							'ac_name'=>$result[0]['ac_name'],
							'father_name'=>$result[0]['guarntor'][$i]['father_name'],//$result[0]['father_name'],
							'lawyer_name'=>$result[0]['name'],
							'designation'=>$result[0]['designation'],
							'chamber'=>$chamber,
							'court_name'=>$result[0]['court_name'],
							'signature'=>$result[0]['signature']!=''?'ref_tables_files/'.$result[0]['signature']:'ref_tables_files/nosig.png',
							'outstanding_amount'=>number_format(abs($result[0]['outstanding_bl']),2,'.',','),
							'outstanding_date'=>date('d-M-y'),
							'tm_name'=>$result[0]['tm_name'],
							'mobile_number'=>$result[0]['mobile_number'],
							'card_iss_date'=>$result[0]['card_iss_date'],
							'card_exp_date'=>$result[0]['card_exp_date'],
							'card_limit'=>number_format(abs($result[0]['card_limit']),2,'.',','),
							'address'=>preg_replace('/\s+/', ' ',$address),
							'addr_type'=>$address_type
						);	
						$new_sl_no++;					
					}
				}
				if ($update_sl_sts==1) {
					$update_sl = $init.'-'.($new_sl_no-1);
					$legal_notice_data['ln_serial'] = $update_sl;
					$this->db->where('id', $download_id);
					$this->db->update('legal_notice', $legal_notice_data);
					$new_sl_no=$this->user_model->update_word_serial($new_sl_no-$init);
				}
			}
			//For loan
			else
			{
				
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
				

				// A recordset for merging tables
				$result = $this->Legal_notice_ho_model->get_word_data($download_id);
				//For Word Serial Number
				if ($result[0]['ln_serial']=='') {
					$new_sl_no=$this->user_model->get_word_serial(count($result[0]['guarntor']));
					$update_sl_sts = 1;
					$init = $new_sl_no;
					// echo $new_sl_no;
					// exit;
				}else
				{
					$str = explode("-",$result[0]['ln_serial']);
					$new_sl_no = $str[0];
				}
				$Q1 = $this->db->query("SELECT ln_address FROM project_info WHERE id='1'");
				$in_address = $Q1->result();
				$cc_gurantor='';
				foreach($result[0]['guarntor'] as $key=>$gurantorc){
					if($key==0){
						$cc_gurantor = $gurantorc['guarantor_name'];
					}else{
						$cc_gurantor = $cc_gurantor.', '.$gurantorc['guarantor_name'];
					}
					
				}
				

				$template = 'tbs/loan_LN/LN_Borrower_template.docx';
				$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
				$chamber='';
				
				
				$brrower_name='';
				$counter=0;
				for($i=0;$i<count($result[0]['guarntor']);$i++){
					if($result[0]['guarntor'][$i]['guarantor_type']=='M'){
						$brrower_name=$result[0]['guarntor'][$i]['guarantor_name'];
					}
					for($j=0;$j<3;$j++){
						$index = $i*3+$j+$final_counter;
						$counter++;			
						if($j==0){
							$address=$result[0]['guarntor'][$i]['present_address'];
						}elseif($j==1){
							$address=$result[0]['guarntor'][$i]['permanent_address'];
						}elseif($j==2){
							$address=$result[0]['guarntor'][$i]['business_address'];
						}
						
						if(ltrim($address," ")==''){
							continue;
						}
						
						
						if(strlen($address)>100){
							$address = wordwrap($address,100,"\n");
						}else{
							$address = $address."\n";
						}
						if(strlen($result[0]['chamber'])>100){
							$chamber = wordwrap($result[0]['chamber'],100,"\n");
						}else{
							$chamber = $result[0]['chamber']."\n";
						}
						if(strlen($in_address[0]->ln_address)>100){
							$bank_address = wordwrap($in_address[0]->ln_address,100,"\n");
						}else{
							$bank_address = $in_address[0]->ln_address."\n";
						}
						
						$dis_amount_A=explode(",",$result[0]['facility_loan'][0]['disbursed_amount']);
						$disbursed_amount=0;
						for($e=0; $e<count($dis_amount_A); $e++){
							if($e==0){$disbursed_amount=number_format(abs($dis_amount_A[$e]));}
							else{ $disbursed_amount.=', '.number_format(abs($dis_amount_A[$e]));}
						}
						
						
						if($result[0]['guarntor'][$i]['guarantor_type']=='M'){
							
							$data_b[$index] = array(
								'pre_sl'=>$new_sl_no,
								'sl_number'=>$result[0]['sl_no'],
								'date'=>date('d-M-Y'), 
								'ac_no'=>$result[0]['loan_ac'],
								'ac_name'=>$result[0]['ac_name'],
								'brrower_name'=>$brrower_name,//$result[0]['brrower_name'],
								'father_name'=>$result[0]['guarntor'][$i]['father_name'],//$result[0]['father_name'],
								'lawyer_name'=>$result[0]['name'],
								'designation'=>$result[0]['designation'],
								'chamber'=>$chamber,
								'court_name'=>$result[0]['court_name'],
								'signature'=>$result[0]['signature']!=''?'ref_tables_files/'.$result[0]['signature']:'ref_tables_files/nosig.png',
								'l_ac_numbers'=>$result[0]['facility_loan'][0]['l_ac_numbers'], 
								'sch_desc'=>$result[0]['facility_loan'][0]['sch_desc_s'],
								'disbursement_amount'=>$disbursed_amount,
								'disbursement_dt'=>$result[0]['facility_loan'][0]['disbursement_date'],				    
								'l_ac_names'=>$result[0]['facility_loan'][0]['l_ac_names'],				    
								'outstanding_amount'=>number_format(abs($result[0]['facility_loan'][0]['outstanding_bl'])),
								'outstanding_date'=>$result[0]['facility_loan'][0]['outstanding_bl_dt'],
								'tm_name'=>$result[0]['tm_name'],
								'tm_mobile'=>$result[0]['mobile_number'],
								'cc_guarrantor_name'=>$cc_gurantor,
								'bank_address'=>$bank_address,
								'present_address'=>$address
							);						
							
						}else{
						
							$data[$index]=array(
								'pre_sl'=>$new_sl_no,
								'sl_number'=>$result[0]['sl_no'],
								'date'=>date('d-M-Y'), 
								'ac_no'=>$result[0]['loan_ac'],
								'ac_name'=>$result[0]['ac_name'],
								'brrower_name'=>$brrower_name,
								'father_name'=>$result[0]['guarntor'][$i]['father_name'],
								//'present_address'=>$result[0]['guarntor'][$i]['present_address'],
								'present_address'=>$address,
								'lawyer_name'=>$result[0]['name'],
								'designation'=>$result[0]['designation'],
								'chamber'=>$chamber,
								'court_name'=>$result[0]['court_name'],
								'signature'=>$result[0]['signature']!=''?'ref_tables_files/'.$result[0]['signature']:'ref_tables_files/nosig.png',
								'loan_ac_numbers'=>$result[0]['facility_loan'][0]['l_ac_numbers'], 
								'sch_desc'=>$result[0]['facility_loan'][0]['sch_desc_s'],
								'disbursement_amount'=>$disbursed_amount,
								'disbursement_dt'=>$result[0]['facility_loan'][0]['disbursement_date'],
								'l_ac_names'=>$result[0]['facility_loan'][0]['l_ac_names'],
								'outstanding_amount'=>number_format(abs($result[0]['facility_loan'][0]['outstanding_bl'])),
								'outstanding_date'=>$result[0]['facility_loan'][0]['outstanding_bl_dt'],
								'tm_name'=>$result[0]['tm_name'],
								'tm_mobile'=>$result[0]['mobile_number'],
								'guarrantor_name'=>$result[0]['guarntor'][$i]['guarantor_name'],
								'bank_address'=>$in_address[0]->ln_address
								);
						    
						}
						$new_sl_no++;	
					}
				}
				
				if ($update_sl_sts==1) {
					$update_sl = $init.'-'.($new_sl_no-1);
					$legal_notice_data['ln_serial'] = $update_sl;
					$this->db->where('id', $download_id);
					$this->db->update('legal_notice', $legal_notice_data);
					$new_sl_no=$this->user_model->update_word_serial($new_sl_no-$init);
				}
			}
			$final_counter=$index+1;
			
		}
		if ($download_type=='Card') {
			$TBS->MergeBlock('b', $data_b);
			$save_as='';
			$path='tbs/loan_LN_rslt/';
			$filename =	'Legal_notice_Card_template.docx';
			$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
			//$output_file_name =$path.$filename;
			//$TBS->Show(OPENTBS_FILE, $output_file_name);
			
			$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.

			exit;
		}else
		{
			$TBS->MergeBlock('b', $data_b);
			$TBS->MergeBlock('d', $data);
			
			$save_as='';
			$path='tbs/loan_LN_rslt/';
			$filename =	'LN_Borrower_template.docx';
			$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
			//$output_file_name =$path.$filename;
			//$TBS->Show(OPENTBS_FILE, $output_file_name);
			
			$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				
			/*if(file_exists($output_file_name))
			{
			  header('Content-Disposition: attachment; filename=' . $filename);  
			  readfile($output_file_name); 
			}
			else
			{
			  echo 'File does not exists on given path';
			}*/

			exit;
		}
		
	}
	function bulk_download($ids)
	{
		$str2 = explode("_",$ids);
		$download_ids=$str2[1]; 
		$download_type=$str2[0]; 
		$final_counter = 0;
		$data_b = array();
		$index = 0;
		$index2=0;
		$total_guarantor=0;
		$total_borrower = 0;
		for ($k=0; $k<count($str2); $k++) { 
			$index2=0;
			$data = array();
			if($k==0) //For skiping the type
			{
				continue;
			}
			$download_id=$str2[$k]; 
			$update_sl_sts = 0;
			$init = 0;
			$download_history_data = array(
				'ln_id' => $download_id,
				'd_by' => $this->session->userdata['ast_user']['user_id'],
				'd_dt' => date('Y-m-d H:i:s')
			);
			$this->db->insert('legal_notice_download_history', $download_history_data);
			//For Card
			if ($download_type=='Card') 
			{
				$br_address=array();
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
				
				$result = $this->Legal_notice_ho_model->get_word_card_data($download_id);

				//For Word Serial Number
				if ($result[0]['ln_serial']=='') {
					$new_sl_no=$this->user_model->get_word_serial(count($result[0]['guarntor']));
					$update_sl_sts = 1;
					$init = $new_sl_no;

				}else
				{
					$str = explode("-",$result[0]['ln_serial']);
					$new_sl_no = $str[0];
				}
				//$new_sl_no=1;
				// exit;
				$Q1 = $this->db->query("SELECT ln_address FROM project_info WHERE id='1'");
				$in_address = $Q1->result();
				
				

				$template = 'tbs/loan_LN/Legal_notice_Card_template.docx';
				$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
				
				$addr_type[]='Present Address';
				$addr_type[]='Parmanent Address';
				$addr_type[]='Business Address';
				
				$counter=0;
				for($i=0;$i<count($result[0]['guarntor']);$i++){				
					
					for($j=0;$j<3;$j++){
						$counter++;
						$index = $i*3+$j+$final_counter;
						echo $index;			
						if($j==0){
							$address=$result[0]['guarntor'][$i]['present_address'];
							$address_field = 'present address';
						}elseif($j==1){
							$address=$result[0]['guarntor'][$i]['permanent_address'];
							$address_field = 'parmanent address';
						}elseif($j==2){
							$address=$result[0]['guarntor'][$i]['business_address'];
							$address_field = 'business address';
						}
						
						if(ltrim($address," ")==''){
							continue;
						}
						$array = array(
							'guarantor_id'=>$result[0]['guarntor'][$i]['id'],
							'ln_id'=>$download_id,
				            'br_counter'=>$new_sl_no,
				            'adress_field'=>$address_field,
				            'adress'=>$address
				    );
				    array_push($br_address,$array);
						$address_type=$addr_type[$i];
						
						if(strlen($address)>100){
							$address = wordwrap($address,100,"\n");
						}else{
							$address = $address."\n";
						}
						if(strlen($result[0]['chamber'])>100){
							$chamber = wordwrap($result[0]['chamber'],100,"\n");
						}else{
							$chamber = $result[0]['chamber']."\n";
						}
						if(strlen($in_address[0]->ln_address)>100){
							$bank_address = wordwrap($in_address[0]->ln_address,100,"\n");
						}else{
							$bank_address = $in_address[0]->ln_address."\n";
						}
						
						$data_b[$index] = array(
							'pre_sl'=>$new_sl_no,
							'sl_number'=>$result[0]['sl_no'],
							'date'=>$result[0]['ln_v_dt'],//date('d-M-Y'), 
							'loan_ac'=>$result[0]['loan_ac'],//$this->Common_model->stringEncryption('decrypt',$result[0]['org_loan_ac']),
							'customer_id'=>$result[0]['customer_id'],
							'ac_name'=>$result[0]['ac_name'],
							'father_name'=>$result[0]['guarntor'][$i]['father_name'],//$result[0]['father_name'],
							'lawyer_name'=>$result[0]['name'],
							'designation'=>$result[0]['designation'],
							'chamber'=>$chamber,
							'court_name'=>$result[0]['court_name'],
							'signature'=>$result[0]['signature']!=''?'ref_tables_files/'.$result[0]['signature']:'ref_tables_files/nosig.png',
							'outstanding_amount'=>number_format(abs($result[0]['outstanding_bl']),2,'.',','),
							'outstanding_date'=>$result[0]['outstanding_bl_dt'],//date('d-M-y'),
							'tm_name'=>$result[0]['tm_name'],
							'mobile_number'=>$result[0]['mobile_number'],
							'card_iss_date'=>$result[0]['card_iss_date'],
							'card_exp_date'=>$result[0]['card_exp_date'],
							'card_limit'=>number_format(abs($result[0]['card_limit']),2,'.',','),
							'address'=>preg_replace('/\s+/', ' ',$address),
							'addr_type'=>$address_type
						);	
						$new_sl_no++;					
					}
				}
				if ($update_sl_sts==1) {
					$update_sl = $init.'-'.($new_sl_no-1);
					$legal_notice_data['ln_serial'] = $update_sl;
					$legal_notice_data['download_sts'] = 1;
					$this->db->where('id', $download_id);
					$this->db->update('legal_notice', $legal_notice_data);
					$new_sl_no=$this->user_model->update_word_serial($new_sl_no-$init);

					$this->db->insert_batch('ln_address_by_br_serial', $br_address);
				}
			}
			//For loan
			else
			{
				$br_address=array();
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
				
				$template = 'tbs/loan_LN/LN_Borrower_template_bulk.docx';
				$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
				// A recordset for merging tables
				$result = $this->Legal_notice_ho_model->get_word_data($download_id);
				//For Word Serial Number
				if ($result[0]['ln_serial']=='') {
					$new_sl_no=$this->user_model->get_word_serial(count($result[0]['guarntor']));
					$update_sl_sts = 1;
					$init = $new_sl_no;
					// echo $new_sl_no;
					// exit;
				}else
				{
					$str = explode("-",$result[0]['ln_serial']);
					$new_sl_no = $str[0];
				}
				$Q1 = $this->db->query("SELECT ln_address FROM project_info WHERE id='1'");
				$in_address = $Q1->result();
				$cc_gurantor='';
				foreach($result[0]['guarntor'] as $key=>$gurantorc){
					if($key==0){
						$cc_gurantor = $gurantorc['guarantor_name'];
					}else{
						$cc_gurantor = $cc_gurantor.', '.$gurantorc['guarantor_name'];
					}
					
				}
				
				$chamber='';
				
				
				$brrower_name='';
				$counter=0;
				for($i=0;$i<count($result[0]['guarntor']);$i++){
					if($result[0]['guarntor'][$i]['guarantor_type']=='M'){
						$total_borrower++;
						$brrower_name=$result[0]['guarntor'][$i]['guarantor_name'];
					}else
					{
						$total_guarantor++;
					}
					for($j=0;$j<3;$j++){
						//$index = $i*3+$j+$final_counter;

						$counter++;			
						if($j==0){
							$address=$result[0]['guarntor'][$i]['present_address'];
							$address_field = 'present address';
						}elseif($j==1){
							$address=$result[0]['guarntor'][$i]['permanent_address'];
							$address_field = 'parmanent address';
						}elseif($j==2){
							$address=$result[0]['guarntor'][$i]['business_address'];
							$address_field = 'business address';
						}
						
						if(ltrim($address," ")==''){
							continue;
						}
						
						$array = array(
								'guarantor_id'=>$result[0]['guarntor'][$i]['id'],
								'ln_id'=>$download_id,
					            'br_counter'=>$new_sl_no,
					            'adress_field'=>$address_field,
					            'adress'=>$address
					    );
					    array_push($br_address,$array);
						if(strlen($address)>100){
							$address = wordwrap($address,100,"\n");
						}else{
							$address = $address."\n";
						}
						if(strlen($result[0]['chamber'])>100){
							$chamber = wordwrap($result[0]['chamber'],100,"\n");
						}else{
							$chamber = $result[0]['chamber']."\n";
						}
						if(strlen($in_address[0]->ln_address)>100){
							$bank_address = wordwrap($in_address[0]->ln_address,100,"\n");
						}else{
							$bank_address = $in_address[0]->ln_address."\n";
						}
						
						$dis_amount_A=explode(",",$result[0]['facility_loan'][0]['disbursed_amount']);
						$disbursed_amount=0;
						for($e=0; $e<count($dis_amount_A); $e++){
							if($e==0){$disbursed_amount=number_format(abs($dis_amount_A[$e]));}
							else{ $disbursed_amount.=', '.number_format(abs($dis_amount_A[$e]));}
						}
						
						
						if($result[0]['guarntor'][$i]['guarantor_type']=='M'){
							
							
							$data_b[$index] = array(
								'pre_sl'=>$new_sl_no,
								'sl_number'=>$result[0]['sl_no'],
								'date'=>$result[0]['ln_v_dt'],//date('d-M-Y'), 
								'ac_no'=>$result[0]['loan_ac'],
								'ac_name'=>$result[0]['ac_name'],
								'brrower_name'=>$brrower_name,//$result[0]['brrower_name'],
								'father_name'=>$result[0]['guarntor'][$i]['father_name'],//$result[0]['father_name'],
								'lawyer_name'=>$result[0]['name'],
								'designation'=>$result[0]['designation'],
								'chamber'=>$chamber,
								'court_name'=>$result[0]['court_name'],
								'signature'=>$result[0]['signature']!=''?'ref_tables_files/'.$result[0]['signature']:'ref_tables_files/nosig.png',
								'l_ac_numbers'=>$result[0]['facility_loan'][0]['l_ac_numbers'], 
								'sch_desc'=>$result[0]['facility_loan'][0]['sch_desc_s'],
								'disbursement_amount'=>$disbursed_amount,
								'disbursement_dt'=>$result[0]['facility_loan'][0]['disbursement_date'],				    
								'l_ac_names'=>$result[0]['facility_loan'][0]['l_ac_names'],				    
								'outstanding_amount'=>number_format(abs($result[0]['facility_loan'][0]['outstanding_bl'])),
								'outstanding_date'=>$result[0]['facility_loan'][0]['outstanding_bl_dt'],
								'tm_name'=>$result[0]['tm_name'],
								'tm_mobile'=>$result[0]['mobile_number'],
								'cc_guarrantor_name'=>$cc_gurantor,
								'bank_address'=>$bank_address,
								'present_address'=>$address,
								'd' => array()
							);	
							$index++;					
							
						}else{
							
							$data[$index2]=array(
								'pre_sl'=>$new_sl_no,
								'sl_number'=>$result[0]['sl_no'],
								'date'=>$result[0]['ln_v_dt'],//date('d-M-Y'), 
								'ac_no'=>$result[0]['loan_ac'],
								'ac_name'=>$result[0]['ac_name'],
								'brrower_name'=>$brrower_name,
								'father_name'=>$result[0]['guarntor'][$i]['father_name'],
								//'present_address'=>$result[0]['guarntor'][$i]['present_address'],
								'present_address'=>$address,
								'lawyer_name'=>$result[0]['name'],
								'designation'=>$result[0]['designation'],
								'chamber'=>$chamber,
								'court_name'=>$result[0]['court_name'],
								'signature'=>$result[0]['signature']!=''?'ref_tables_files/'.$result[0]['signature']:'ref_tables_files/nosig.png',
								'loan_ac_numbers'=>$result[0]['facility_loan'][0]['l_ac_numbers'], 
								'sch_desc'=>$result[0]['facility_loan'][0]['sch_desc_s'],
								'disbursement_amount'=>$disbursed_amount,
								'disbursement_dt'=>$result[0]['facility_loan'][0]['disbursement_date'],
								'l_ac_names'=>$result[0]['facility_loan'][0]['l_ac_names'],
								'outstanding_amount'=>number_format(abs($result[0]['facility_loan'][0]['outstanding_bl'])),
								'outstanding_date'=>$result[0]['facility_loan'][0]['outstanding_bl_dt'],
								'tm_name'=>$result[0]['tm_name'],
								'tm_mobile'=>$result[0]['mobile_number'],
								'guarrantor_name'=>$result[0]['guarntor'][$i]['guarantor_name'],
								'bank_address'=>$in_address[0]->ln_address
								);
							$index2++;
						    
						}
						$new_sl_no++;	
					}
				}

				array_push($data_b[$index-1]['d'],...$data);
				
				if ($update_sl_sts==1) {
					$update_sl = $init.'-'.($new_sl_no-1);
					$legal_notice_data['ln_serial'] = $update_sl;
					$legal_notice_data['download_sts'] = 1;
					$this->db->where('id', $download_id);
					$this->db->update('legal_notice', $legal_notice_data);
					$new_sl_no=$this->user_model->update_word_serial($new_sl_no-$init);

					$this->db->insert_batch('ln_address_by_br_serial', $br_address);
				}
			}
			$final_counter=$index+1;
		}
		/*echo "<pre>";
		print_r($data_b);
		exit;*/
		if ($download_type=='Card') {
			$TBS->MergeBlock('b', $data_b);
			$save_as='';
			$path='tbs/loan_LN_rslt/';
			$filename =	'Legal_notice_Card_template.docx';
			$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
			//$output_file_name =$path.$filename;
			//$TBS->Show(OPENTBS_FILE, $output_file_name);
			
			$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.

			exit;
		}else
		{
			$c[]=array(
				'total_owner' => $total_borrower,
				'total_guarantor' => $total_guarantor,
			);
			$TBS->MergeBlock('b', $data_b);
			$TBS->MergeBlock('c', $c);
			//$TBS->MergeBlock('d', $data);
			
			$save_as='';
			$path='tbs/loan_LN_rslt/';
			$filename =	'LN_Borrower_template.docx';
			$filename = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $filename);
			//$output_file_name =$path.$filename;
			//$TBS->Show(OPENTBS_FILE, $output_file_name);
			
			$TBS->Show(OPENTBS_DOWNLOAD, $filename); // Also merges all [onshow] automatic fields.
				
			/*if(file_exists($output_file_name))
			{
			  header('Content-Disposition: attachment; filename=' . $filename);  
			  readfile($output_file_name); 
			}
			else
			{
			  echo 'File does not exists on given path';
			}*/

			exit;
		}
		
	}
	function convertNumber($num = false)
	{
	    $num = str_replace(array(',', ''), '' , trim($num));
	    if(! $num) {
	        return false;
	    }
	    $num = (int) $num;
	    $words = array();
	    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
	        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
	    );
	    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
	    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
	        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
	        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
	    );
	    $num_length = strlen($num);
	    $levels = (int) (($num_length + 2) / 3);
	    $max_length = $levels * 3;
	    $num = substr('00' . $num, -$max_length);
	    $num_levels = str_split($num, 3);
	    for ($i = 0; $i < count($num_levels); $i++) {
	        $levels--;
	        $hundreds = (int) ($num_levels[$i] / 100);
	        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : '' ) . ' ' : '');
	        $tens = (int) ($num_levels[$i] % 100);
	        $singles = '';
	        if ( $tens < 20 ) {
	            $tens = ($tens ? ' and ' . $list1[$tens] . ' ' : '' );
	        } elseif ($tens >= 20) {
	            $tens = (int)($tens / 10);
	            $tens = ' and ' . $list2[$tens] . ' ';
	            $singles = (int) ($num_levels[$i] % 10);
	            $singles = ' ' . $list1[$singles] . ' ';
	        }
	        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
	    } //end for loop
	    $commas = count($words);
	    if ($commas > 1) {
	        $commas = $commas - 1;
	    }
	    $words = implode(' ',  $words);
	    $words = preg_replace('/^\s\b(and)/', '', $words );
	    $words = trim($words);
	    $words = ucfirst($words);
	    $words = $words;
	    return $words;
	}
	function bulk_acktion()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Legal_notice_ho_model->bulk_acktion();
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
	function delete_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		//Lodaing facility for loan
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Legal_notice_ho_model->delete_action();
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
			else if(isset($_POST['typebulk'])){$row[]='';}
			else{$row=$this->Legal_notice_ho_model->get_add_action_data($id);}
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
	function update_facility()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Legal_notice_ho_model->update_facility();
		}
		else{
			$text[]="Session out, login required";
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Legal_notice_ho_model->get_add_action_data($id);
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
	function details()
	{

		$csrf_token=$this->security->get_csrf_hash();
			if ($this->input->post('id') != ""){
				//$details=$this->Legal_notice_ho_model->get_ptp_info($this->input->post('id'));
				$details=array();
				$var =array(
								"details"=>$details,
								"csrf_token"=>$csrf_token
								);
				echo json_encode($var);
	    	}
	}
	function verify() {
        //$result=$this->Legal_notice_ho_model->verify_ptp($this->input->post('ptp_id'));
        $result=1;
        $jTableResult = array();
        if ($result == 1) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $result;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }
    function get_mortgage($add_edit=NULL)
    {
    	$csrf_token=$this->security->get_csrf_hash();
    	$text=array();
		$row[]='';
		if ($this->session->userdata['ast_user']['login_status'])
		{
			$cif=$this->input->post('cif');
			//$facility_info = $this->Legal_notice_ho_model->get_facility_info();
			$mortgage_details = $this->dump_mortgage();
    		$security = $this->dump_mortgage_securities();
			
		}
		else
		{
			$text[]="Session out, login required";
		}
    	$Message='';
		if(empty($mortgage_details) || empty($security))
		{
			$Message='Sorry No Data Found';
		}
		else
		{

			$Message='OK';
		}
		$var =array();
		$var['Message']=$Message;
		$var['mortgage_details']=$mortgage_details;
		$var['security_details']=$security;
		$var['csrf_token']=$csrf_token;
		echo json_encode($var);
    }


}
?>
