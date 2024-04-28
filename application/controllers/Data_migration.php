<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_migration extends CI_Controller {

	function __construct()
    {
        parent::__construct();	
		
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');		
		$this->load->model('Data_migration_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('User_model', '', TRUE);
	}
	
	function view ($menu_group,$menu_cat)
	{		
		$data = array( 	
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'data_migration/pages/grid',			   			   
				   	'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function grid()
	{		
		$this->load->model('Data_migration_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;
		
		$result=$this->Data_migration_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
				
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],		   
		   'Rows' => $result['Rows']
		);		
		echo json_encode($data);		
	}
	
	function file_validation_suit_file_with_legal_cost()
	{
		$migration_type = $this->input->post('migration_type');
	   $this->load->helper('form');
       $csrf_token=$this->security->get_csrf_hash();     
	   $str='';       
	   //For Case File Data Migration
       $destination_path = getcwd().DIRECTORY_SEPARATOR;
       $i=0;
		$error_message = "OK";
		$data=array();
		$data2=array();
		$total_counter = 0;
		$column_length = 30;
		$column_length2 = 12;
        $result = 0;
        //Deleting Old Data
        $table_name='data_migration_case_file_new';
		$str="TRUNCATE TABLE $table_name";
  		$query=$this->db->query($str);
  		$table_name='data_migration_case_file_cost';
		$str="TRUNCATE TABLE $table_name";
  		$query=$this->db->query($str);
       if(isset($_FILES['case_file']))
       {
       		//Removing Previous File
	       $path = $destination_path.'/temp_upload_file/dm_file_case_'.$this->session->userdata['ast_user']['user_id'].'_'.$migration_type.'.csv';
	       if (file_exists($path)) {
	       	unlink($path);
	       }
       	   $size1=basename($_FILES['case_file']['size']);
	       $size=$size1/1048576;
	       $filename = stripslashes($_FILES['case_file']['name']);
	       $i = strrpos($filename,".");
	       $l = strlen($filename) - $i;
	       $extension = substr($filename,$i+1,$l);             
	       $extension = strtolower($extension);                    
	       $file_name_new='dm_file_case_'.$this->session->userdata['ast_user']['user_id'].'_'.$migration_type.'.'.$extension;
	       //$New_file_name=$this->input->ip_address().'__'.$subcat.'__'.$this->session->userdata("user_hms").'__'.time().'.pdf';
	       $target_path = $destination_path.'/temp_upload_file/' .$file_name_new;
	        
		    if(@move_uploaded_file($_FILES['case_file']['tmp_name'], $target_path)) {
		      $result = 1;
		    } 
			$handle = fopen($target_path,"r");
			$row = fgetcsv($handle, 10000, ",");
			if(count($row)!=$column_length)
			{
				$error_message="Selected Case File does not contain required column!! please try again";
			}
			if($error_message=='OK')//When No Error
			{
				$i=1;
				while (($row = fgetcsv($handle, 10000, ",")) != FALSE) //get row vales of new case file
				{
					if($i!=0)//skip the first row
					{
						if(trim($row[0])=='')//skinping the empty rows
						{
							continue;
						}
						$total_counter++;
						$array = array(
				            'session_id'=>$this->session->userdata['ast_user']['user_id'],
				            'proposed_type'=>$row[0],
				            'loan_ac'=>$row[1],
				            'ac_name'=>$row[2],
				            'req_type'=>$row[3],
				            'case_name'=>$row[4],
				            'filling_date'=>$row[5],
				            'case_number'=>$row[6],
				            'case_claim_amount'=>trim(str_replace(",","",$row[7])),
				            'previous_dt'=>$row[8],
				            'case_sts_prev_dt'=>$row[9],
				            'act_prev_dt'=>$row[10],
				            'next_dt'=>$row[11],
				            'case_sts_next_dt'=>$row[12],
				            'remarks_prev_dt'=>$row[13],
				            'filling_plaintiff'=>$row[14],
				            'filling_plaintiff_name'=>$row[15],
				            'present_plaintiff'=>$row[16],
				            'present_plaintiff_name'=>$row[17],
				            'case_deal_officer'=>$row[18],
				            'case_deal_officer_name'=>$row[19],
				            'lawyer_name'=>$row[20],
				            'prev_court'=>$row[21],
				            'present_court'=>$row[22],
				            'district'=>$row[23],
				            'territory'=>$row[24],
				            'remarks'=>$row[25],
				            'protfolio'=>$row[26],
				            'region'=>$row[27],
				            'final_status'=>$row[28],
				            'prev_filling_date'=>$row[29],
				            );
						array_push($data,$array);
					}
					$i++;
				}
				$table_name='data_migration_case_file_new';
				$this->db->insert_batch($table_name, $data);
				
			}
       }
       if(isset($_FILES['cost_file']))
       {
       		//For Cost Data
			$path = $destination_path.'/temp_upload_file/dm_file_cost_'.$this->session->userdata['ast_user']['user_id'].'_'.$migration_type.'.csv';
	       if (file_exists($path)) {
	       	unlink($path);
	       }
	       $result = 0;
	       $size1=basename($_FILES['cost_file']['size']);
	       $size=$size1/1048576;
	       $filename = stripslashes($_FILES['cost_file']['name']);
	       $i = strrpos($filename,".");
	       $l = strlen($filename) - $i;
	       $extension = substr($filename,$i+1,$l);             
	       $extension = strtolower($extension);                    
	       $file_name_new='dm_file_cost_'.$this->session->userdata['ast_user']['user_id'].'_'.$migration_type.'.'.$extension;
	       //$New_file_name=$this->input->ip_address().'__'.$subcat.'__'.$this->session->userdata("user_hms").'__'.time().'.pdf';
	       $target_path = $destination_path.'/temp_upload_file/' .$file_name_new;
	        
		    if(@move_uploaded_file($_FILES['cost_file']['tmp_name'], $target_path)) {
		      $result = 1;
		    } 
			$handle2 = fopen($target_path,"r");
			$row2 = fgetcsv($handle2, 10000, ",");
			if(count($row2)!=$column_length2)
			{
				$error_message="Selected Cost File does not contain required column!! please try again";
			}
			if($error_message=='OK')
			{
				$i=1;
				while (($row = fgetcsv($handle2, 10000, ",")) != FALSE) //get row vales of new case file
				{
					if($i!=0)//skip the first row
					{
						if(trim($row[0])=='')//skinping the empty rows
						{
							continue;
						}
						$total_counter++;
						if($row[3]=='ARA-2003')
						{
							$req_type_id = 2;
						}
						else if($row[3]=='NI Act-138')
						{
							$req_type_id = 1;
						}
						else if($row[3]=='Others')
						{
							$req_type_id = 3;
						}
						else
						{
							$req_type_id = 0;
						}
						$array = array(
				            'session_id'=>$this->session->userdata['ast_user']['user_id'],
				            'proposed_type'=>$row[0],
				            'loan_ac'=>$row[1],
				            'ac_name'=>$row[2],
				            'req_type'=>$row[3],
				            'req_type_id'=>$req_type_id,
				            'case_number'=>$row[4],
				            'lawyer_name'=>$row[5],
				            'date_of_bill'=>$row[6],
				            'unit'=>$row[7],
				            'activities_name'=>$row[8],
				            'amount'=>trim(str_replace(",","",$row[9])),
				            'region'=>$row[10],
				            'cost_type'=>$row[11]
				            );
						array_push($data2,$array);
					}
					$i++;
				}
				$table_name='data_migration_case_file_cost';
				$this->db->insert_batch($table_name, $data2);
			}
       }
		$var =array(
		"migration_type"=>$migration_type,
		"total_records"=>$total_counter,
		"error_message"=>$error_message,
		"csrf_token"=>$csrf_token
		);
		echo json_encode($var);
	}
	function file_validation()
	{
	   $migration_type = $this->input->post('migration_type');
	   $this->load->helper('form');
       $csrf_token=$this->security->get_csrf_hash();     
	   $str='';       
       $destination_path = getcwd().DIRECTORY_SEPARATOR;
       //Removing Previous File
       $path = $destination_path.'/temp_upload_file/dm_file_'.$this->session->userdata['ast_user']['user_id'].'_'.$migration_type.'.csv';
       if (file_exists($path)) {
       	unlink($path);
       }
       
       $result = 0;
       $size1=basename($_FILES['bulk_file']['size']);
       $size=$size1/1048576;
       $filename = stripslashes($_FILES['bulk_file']['name']);
       $i = strrpos($filename,".");
       $l = strlen($filename) - $i;
       $extension = substr($filename,$i+1,$l);             
       $extension = strtolower($extension);                    
       $file_name_new='dm_file_'.$this->session->userdata['ast_user']['user_id'].'_'.$migration_type.'.'.$extension;
       //$New_file_name=$this->input->ip_address().'__'.$subcat.'__'.$this->session->userdata("user_hms").'__'.time().'.pdf';
       $target_path = $destination_path.'/temp_upload_file/' .$file_name_new;
        
	    if(@move_uploaded_file($_FILES['bulk_file']['tmp_name'], $target_path)) {
	      $result = 1;
	    } 
		$handle = fopen($target_path,"r");
		$table_name='';
		if($migration_type==1)//For 1st Legal Notice
		{
			$column_length = 6;
			$table_name='data_migration_ln';
		}
		else if($migration_type==2) //For CMA Approval
		{
			$column_length = 11;
			$table_name='data_migration_cma';
		}
		else if($migration_type==3)//For Suit File
		{
			$column_length = 30;
			$table_name='data_migration_case_file';
		}
		else if($migration_type==4)//For Lawyer Bill
		{
			$column_length = 11;
			$table_name='data_migration_lawyer_bill';
		}
		else if($migration_type==5)//For Paper Bill
		{
			$column_length = 12;
			$table_name='data_migration_paper_bill';
		}
		else if($migration_type==6)//For High Court Data
		{
			$column_length = 25;
			$table_name='data_migration_high_court';
		}
		else if($migration_type==7)//For Legal Cost
		{
			$column_length = 14;
			$table_name='data_migration_legal_cost';
		}
		else if($migration_type==9)//For Legal Cost
		{
			$column_length = 13;
			$table_name='data_migration_final_ln_cost';
		}
		else if($migration_type==10)//For Auction Cost
		{
			$column_length = 19;
			$table_name='data_migration_vendor_cost';
		}
		else if($migration_type=='bulk_reassing_file')//For bulk Reassing File
		{
			$column_length = 10;
			$table_name='bulk_reassing_file_data';
		}
		else
		{
			$column_length = 0;
		}
		$i=0;
		$error_message = "OK";
		$data=array();
		while (($row = fgetcsv($handle, 10000, ",")) != FALSE) //get row vales
		{
			if($i==0 && count($row)!=$column_length)
			{
				$error_message="Selected File does not contain required column!! please try again";
				break;
			}
			if($i!=0)//skip the first row
			{
				if(trim($row[0])=='')//skinping the empty rows
				{
					continue;
				}
				if($migration_type==1)//For 1st Legal Notice
				{
					$array = array(
			            'session_id'=>$this->session->userdata['ast_user']['user_id'],
			            'proposed_type'=>$row[0],
			            'account_number'=>$row[1],
			            'account_name'=>$row[2],
			            'ln_sending_dt'=>$row[3],
			            'protfolio_name'=>$row[4],
			            'remarks'=>$row[5],
			            );
					array_push($data,$array);
				}
				else if($migration_type==2)//For CMA Approval
				{
					$array = array(
			            'session_id'=>$this->session->userdata['ast_user']['user_id'],
			            'proposed_type'=>$row[0],
			            'loan_ac'=>$row[1],
			            'ac_name'=>$row[2],
			            'req_type'=>$row[3],
			            'security_sts'=>$row[4],
			            'approve_dt'=>$row[5],
			            'cl'=>$row[6],
			            'territory'=>$row[7],
			            'district'=>$row[8],
			            'region'=>$row[9],
			            'protfolio'=>$row[10],
			            );
					array_push($data,$array);
				}
				else if($migration_type==3)//For Case File Data Migration
				{
					$array = array(
			            'session_id'=>$this->session->userdata['ast_user']['user_id'],
			            'proposed_type'=>$row[0],
			            'loan_ac'=>$row[1],
			            'ac_name'=>$row[2],
			            'req_type'=>$row[3],
			            'case_name'=>$row[4],
			            'filling_date'=>$row[5],
			            'case_number'=>$row[6],
			            'case_claim_amount'=>trim(str_replace(",","",$row[7])," "),
			            'previous_dt'=>$row[8],
			            'case_sts_prev_dt'=>$row[9],
			            'act_prev_dt'=>$row[10],
			            'next_dt'=>$row[11],
			            'case_sts_next_dt'=>$row[12],
			            'remarks_prev_dt'=>$row[13],
			            'filling_plaintiff'=>$row[14],
			            'filling_plaintiff_name'=>$row[15],
			            'present_plaintiff'=>$row[16],
			            'present_plaintiff_name'=>$row[17],
			            'case_deal_officer'=>$row[18],
			            'case_deal_officer_name'=>$row[19],
			            'lawyer_name'=>$row[20],
			            'prev_court'=>$row[21],
			            'present_court'=>$row[22],
			            'district'=>$row[23],
			            'territory'=>$row[24],
			            'remarks'=>$row[25],
			            'protfolio'=>$row[26],
			            'region'=>$row[27],
			            'final_status'=>$row[28],
			            'prev_filling_date'=>$row[29],
			            );
					array_push($data,$array);
				}
				else if($migration_type==4)//For Lawyer Bill Data Migration
				{
					if($row[3]=='ARA-2003')
					{
						$req_type_id = 2;
					}
					else if($row[3]=='NI Act-138')
					{
						$req_type_id = 1;
					}
					else
					{
						$req_type_id = 0;
					}
					$array = array(
			            'session_id'=>$this->session->userdata['ast_user']['user_id'],
			            'proposed_type'=>$row[0],
			            'loan_ac'=>$row[1],
			            'ac_name'=>$row[2],
			            'req_type'=>$row[3],
			            'req_type_id'=>$req_type_id,
			            'case_number'=>$row[4],
			            'lawyer_name'=>$row[5],
			            'date_of_bill'=>$row[6],
			            'unit'=>$row[7],
			            'activities_name'=>$row[8],
			            'amount'=>trim(str_replace(",","",$row[9])," "),
			            'region'=>$row[10]
			            );
					array_push($data,$array);
				}
				else if($migration_type==5)//For Paper Bill Data Migration
				{
					$array = array(
			            'session_id'=>$this->session->userdata['ast_user']['user_id'],
			            'proposed_type'=>$row[0],
			            'loan_ac'=>$row[1],
			            'ac_name'=>$row[2],
			            'req_type'=>$row[3],
			            'case_number'=>$row[4],
			            'publication_amount'=>trim(str_replace(",","",$row[5])," "),
			            'publication_date'=>$row[6],
			            'paper_name'=>$row[7],
			            'vendor_name'=>$row[8],
			            'district'=>$row[9],
			            'region'=>$row[10],
			            'loan_segment'=>$row[11]
			            );
					array_push($data,$array);
				}
				else if($migration_type==6)//For Paper Bill Data Migration
				{
					$array = array(
			            'session_id'=>$this->session->userdata['ast_user']['user_id'],
			            'division'=>$row[0],
			            'case_category'=>$row[1],
			            'hc_matter_type'=>$row[2],
			            'proposed_type'=>$row[3],
			            'loan_ac'=>$row[4],
			            'ac_name'=>$row[5],
			            'protfolio'=>$row[6],
			            'case_type'=>$row[7],
			            'case_no'=>$row[8],
			            'case_claim_amount'=>trim(str_replace(",","",$row[9])," "),
			            'filling_date'=>$row[10],
			            'district'=>$row[11],
			            'last_activities'=>$row[12],
			            'last_status'=>$row[13],
			            'present_cause_of_action'=>$row[14],
			            'bench_name'=>$row[15],
			            'bench_number'=>$row[16],
			            'remarks'=>$row[17],
			            'closing'=>$row[18],
			            'dealing_officer_pin'=>$row[19],
			            'dealing_officer'=>$row[20],
			            'lower_court_dealing_officer_pin'=>$row[21],
			            'lower_court_dealing_officer'=>$row[22],
			            'deposit_money'=>$row[23],
			            'request_recieve_date'=>$row[24]
			            );
					array_push($data,$array);
				}
				else if($migration_type==7)//For Legal Cost Data Migration
				{
					$array = array(
			            'session_id'=>$this->session->userdata['ast_user']['user_id'],
			            'proposed_type'=>$row[0],
			            'loan_ac'=>$row[1],
			            'ac_name'=>$row[2],
			            'req_type'=>$row[3],
			            'filling_date'=>$row[4],
			            'case_number'=>trim($row[5]," "),
			            'case_claim_amount'=>trim(str_replace(",","",$row[6])," "),
			            'previous_date'=>$row[7],
			            'previous_case_sts'=>$row[8],
			            'district'=>$row[9],
			            'region'=>$row[10],
			            'protfolio'=>$row[11],
			            'legal_cost'=>trim(str_replace(",","",$row[12])," "),
			            'activities'=>$row[13],
			            );
					array_push($data,$array);
				}
				else if($migration_type==9)//For Final LN Cost Data Migration
				{
					if(trim($row[0])=='')//skinping the empty rows
					{
						continue;
					}
					if($row[3]=='ARA-2003')
					{
						$req_type_id = 2;
					}
					else if($row[3]=='NI Act-138')
					{
						$req_type_id = 1;
					}
					else if($row[3]=='Others')
					{
						$req_type_id = 3;
					}
					else
					{
						$req_type_id = 0;
					}
					$array = array(
			            'session_id'=>$this->session->userdata['ast_user']['user_id'],
			            'proposed_type'=>$row[0],
			            'loan_ac'=>$row[1],
			            'ac_name'=>$row[2],
			            'req_type'=>$row[3],
			            'req_type_id'=>$req_type_id,
			            'lawyer_name'=>$row[4],
			            'date_of_bill'=>$row[5],
			            'unit'=>$row[6],
			            'activities_name'=>$row[7],
			            'amount'=>trim(str_replace(",","",$row[8])," "),
			            'region'=>$row[9],
			            'cost_type'=>$row[10],
			            'loan_segment'=>$row[11],
			            'remarks'=>$row[12]
			            );
					array_push($data,$array);
				}
				else if($migration_type==10)//For Auction Cost Data Migration
				{
					if(trim($row[0])=='')//skinping the empty rows
					{
						continue;
					}
					$array = array(
			            'session_id'=>$this->session->userdata['ast_user']['user_id'],
			            'proposed_type'=>$row[0],
			            'loan_ac'=>$row[1],
			            'ac_name'=>$row[2],
			            'req_type'=>$row[3],
			            'activities_date'=>$row[4],
			            'case_number'=>$row[5],
			            'vendor_type'=>$row[6],
			            'vendor_name'=>$row[7],
			            'paper_name'=>$row[8],
			            'district'=>$row[9],
			            'region'=>$row[10],
			            'protfolio'=>$row[11],
			            'legal_cost'=>trim(str_replace(",","",$row[12])," "),
			            'activities'=>$row[13],
			            'bill_type'=>$row[14],
			            'tin'=>$row[15],
			            'bin'=>$row[16],
			            'mousak'=>$row[17],
			            'bank_account'=>$row[18]
			            );
					array_push($data,$array);
				}
				else if($migration_type=='bulk_reassing_file')//For Bulk Reassing File
				{
					if(trim($row[0])=='')//skinping the empty rows
					{
						continue;
					}
					$array = array(
			            'session_id'=>$this->session->userdata['ast_user']['user_id'],
			            'proposed_type'=>$row[0],
			            'loan_ac'=>$row[1],
			            'req_type'=>$row[2],
			            'case_number'=>$row[3],
			            'region'=>$row[4],
			            'district'=>$row[5],
			            'deal_officer'=>$row[6],
			            'new_district_name'=>$row[7],
			            'court_name'=>$row[8],
			            'lawyer_name'=>$row[9],
			            );
					array_push($data,$array);
				}
			}
			$i++;
		}
		if($error_message=='OK')//When No Error
		{
			$str="TRUNCATE TABLE $table_name";
	  		$query=$this->db->query($str);
			$this->db->insert_batch($table_name, $data);
		}
		$var =array(
		"migration_type"=>$migration_type,
		"total_records"=>$i-1,
		"error_message"=>$error_message,
		"csrf_token"=>$csrf_token
		);
		echo json_encode($var);
	}
	function download_template($module=NULL)
    {
        
		if($module=='bulk_reassing_file')//for bulk reassing file
		{
			$file='dm_format/'.$module.'.xlsx';
		}
		else
		{
			$file='dm_format/dm_format_'.$module.'.xlsx';
		}
		
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Expires: 0');
		header('Cache-Control: application/vnd.ms-excel');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		flush();
		readfile($file);
		exit;
    }	
	function from($add_edit='add',$id=NULL)
	{
		$data = array( 	
				   'add_edit' => $add_edit, 
				   'id' => $id,
				   'pages'=> 'data_migration/pages/form'
				   );
		$this->load->view('data_migration/form_layout',$data);
	}
	
		
	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		$text='';
		$Message='';
		if($this->session->userdata['ast_user']['login_status'])
		{
			$text = $this->Data_migration_model->add_edit_action($add_edit,$edit_id);
			if(count($text)<=0){
			$Message='OK';
			}else{
				for($i=0; $i<count($text); $i++)
				{
					if($i>0){$Message.=',';}
					$Message.=$text[$i];				
				}	
			}
		}
		else{
			$Message="Session out, login required";
		}	
		$var =array();  
		$var['Message']=$Message;
		$var['csrf_token']=$this->security->get_csrf_hash();
		echo json_encode($var);
	}
	
	
}
?>