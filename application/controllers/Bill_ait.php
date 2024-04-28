<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bill_ait extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Bill_ait_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'bill_ait/pages/grid',
					'user_list'=>$this->user_model->get_parameter_data('users_info','id',"data_status = '1' AND FIND_IN_SET(19,user_group_id) AND block_status='0' AND verify_status='0' AND admin_status<>2"),
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}

	function grid()
	{
		$this->load->model('Bill_ait_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_ait_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function grid2()
	{
		$this->load->model('Bill_ait_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_ait_model->get_grid2_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function from($add_edit='add',$id=NULL,$editrow=NULL)
	{
		$this->load->model('Bill_ait_model', '', TRUE);
		$result = $this->Ait_vat_model->get_info($add_edit,$id);
		$data = array(
					 'option' => '',
					 'add_edit' => $add_edit,
					 'result' => $result,
					 'id' => $id,
					 'certificate_type'=>$this->User_model->get_parameter_data('ref_certificate_type','name','data_status = 1'),
					 'request_from'=>$this->User_model->get_parameter_data('ref_request_from','name','data_status = 1'),
					 'pages'=> 'ait_vat/pages/form',
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
			$id = $this->Ait_vat_model->add_edit_action($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";
		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Ait_vat_model->get_add_action_data($id);
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
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Bill_ait_model->delete_action();
		}
		else{
			$text[]="Session out, login required";
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
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
		$var['grid']=$this->input->post('grid');
		//$var['row_info']=$row;
		$var['id']=$id;
		echo json_encode($var);
	}

	function details()
	{

		$csrf_token=$this->security->get_csrf_hash();
			if ($this->input->post('id') != ""){
				//$details=$this->Ait_vat_model->get_ptp_info($this->input->post('id'));
				$details=array();
				$var =array(
								"details"=>$details,
								"csrf_token"=>$csrf_token
								);
				echo json_encode($var);
	    	}
	}
	function verify() {
        //$result=$this->Ait_vat_model->verify_ptp($this->input->post('ptp_id'));
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
    function file_upload(){
    	$csrf_token=$this->security->get_csrf_hash(); 
		$result = 0;
		$size1=basename($_FILES['file_upload']['size']);
		$size=$size1/1048576;
		$filename = stripslashes($_FILES['file_upload']['name']);
		$i = strrpos($filename,".");
		$l = strlen($filename) - $i;
		$extension = substr($filename,$i+1,$l);             
		$extension = strtolower($extension);                    
		$file_name_new='Ait_VAT_files_'.$this->session->userdata['ast_user']['user_id'].'_'.time().'.'.$extension;
		$destination_path = getcwd().DIRECTORY_SEPARATOR;
		//$New_file_name=$this->input->ip_address().'__'.$subcat.'__'.$this->session->userdata("user_hms").'__'.time().'.pdf';
		$target_path = $destination_path.'/cma_file/bill_ait_vat/' .$file_name_new;
		$Message='';
		if(move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_path)) {
			$where = array('id'=>$_POST['rowid']);
			$data = array('certificate_file'=>$file_name_new,'stc_sts'=>71,'receive_head_by'=>$this->session->userdata['ast_user']['user_id'],'receive_head_dt'=>date('Y-m-d H:i:s'));
			$this->db->where($where);
			$this->db->update('ait_vat', $data);

			$str="SELECT  j0.id,j0.vendor_id,CONCAT(u.name,'(',u.pin,')') as legal_officer,IF(j0.request_from=1,l.mobile,p.mobile) as vendor_mobile,IF(j0.request_from=1,l.name,p.name) as vendor_name
                                 FROM ait_vat j0
                                LEFT OUTER JOIN ref_lawyer l on (l.id=j0.vendor_id AND j0.request_from=1)
                                LEFT OUTER JOIN ref_paper_vendor p on (p.id=j0.vendor_id AND j0.request_from=2)
                                LEFT OUTER JOIN users_info u on (u.id=j0.e_by)
                             WHERE j0.id= '".$_POST['rowid']."' LIMIT 1";
                             
                $bill_data=$this->db->query($str)->row();
                $subject="AIT/VAT certificate Received";
                //send mobile sms for lawyer professional bill
                if($bill_data->vendor_mobile!='' && $bill_data->vendor_mobile!=NULL)
                {
                    $message = 'Please collect your AIT/VAT certificate from '.$bill_data->legal_officer;
                    $sms = $this->user_model->send_sms($message,$bill_data->vendor_mobile,'ait_vat',$_POST['rowid'],$bill_data->vendor_id);
                	$m=$this->User_model->send_email("", "", $bill_data->vendor_email,"", $subject,$message);
                }
                $str="SELECT  j0.e_by,IF(j0.request_from=1,l.name,p.name) as vendor_name
                				FROM ait_vat j0
                			 LEFT OUTER JOIN ref_lawyer l on (l.id=j0.vendor_id AND j0.request_from=1)
                                LEFT OUTER JOIN ref_paper_vendor p on (p.id=j0.vendor_id AND j0.request_from=2)
                             WHERE j0.id= '".$_POST['rowid']."' LIMIT 1";
                             
                $bill_data=$this->db->query($str)->row();
                $subject = "AIT/VAT certificate has been uploaded in favor of ".$bill_data->vendor_name;
	        	$url=base_url()."ait_vat/details";
	        	$data2 = $this->Common_model->push_notification_data($subject,$url,'ait_vat',$_POST['rowid'],date('Y-m-d'),'',$bill_data->e_by,'1');


			$this->User_model->user_activities_bill(71,'ait_vat',$this->input->post('rowid'),'ait_vat','Received File By Finance');
			$Message='OK';
		} 
		$var['csrf_token']=$csrf_token;
		$var['Message']=$Message;
		echo json_encode($var);
    }



}
?>
