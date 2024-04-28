<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suit_filling_legal extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Suit_filling_legal_model', '', TRUE);
		$this->load->model('Cma_ho_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'suit_filling_legal/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function grid()
	{
		$this->load->model('Suit_filling_legal_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Suit_filling_legal_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);



		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function r_history()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$sah=$this->Suit_filling_legal_model->get_r_history($this->input->post('id'),$this->input->post('life_cycle'));
        $jTableResult = array();
        $jTableResult['csrf_token'] = $csrf_token;
        if ($sah != null) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = $sah;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = array();
        }
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
	}
	function delete_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->Suit_filling_legal_model->delete_action();
		}
		else{
			$text[]="Session out, login required";
		}
		$Message='';
		if(count($text)<=0){
			$Message='OK';
			if($this->input->post("type")=='delete'){$row[]='';	}
			else{$row=$this->Suit_filling_legal_model->get_add_action_data_auction($id);}
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
	function from($add_edit='add',$id=NULL,$cma_id=NULL,$editrow=NULL)
	{
		$result = $this->Cma_ho_model->get_recommend_info($cma_id);
		$result2 = $this->Suit_filling_legal_model->get_info($id);
		$data = array(
			 'option' => '',
			 'add_edit' => $add_edit,
			 'result' => $result,
			 'result2' => $result2,
			 'cmaid'=>$cma_id,
			 'id'=>$id,
			 //'cma_guarantor' => $this->Cma_ho_model->get_guarantor_info($add_edit,$id),
			 'facility_info' => $this->Cma_ho_model->get_facility($cma_id),
			 'cma_mortgage' => $this->Suit_filling_legal_model->get_where('cma_facility_mortgage',array('cma_id'=>$cma_id,'sts'=>1)),
			 'cma_mortgage_security' => $this->Suit_filling_legal_model->get_where('cma_facility_mortgage_security',array('cma_id'=>$cma_id,'sts'=>1)),
			 'facility_name'=>$this->User_model->get_parameter_data('ref_facility_name','name','data_status = 1'),
			 'req_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
			 'chq_sts'=>$this->User_model->get_parameter_data('ref_chq_sts','name','data_status = 1'),
			 //'recovery_am'=>$this->User_model->get_parameter_data('ref_recovery_am','name','data_status = 1'),
			 'request_source'=>$this->User_model->get_parameter_data('ref_request_source','name','data_status = 1'),
			 'unit_office'=>$this->User_model->get_parameter_data('ref_unit_office','name','data_status = 1'),
			 'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
			 'district_list' => $this->User_model->get_parameter_data('ref_branch_sol','name','data_status = 1'),
			 'territory_list' => $this->User_model->get_parameter_data('ref_territory','name',"data_status = '1'"),
		   	 'unit_office_list' => $this->User_model->get_parameter_data('ref_unit_office','name',"data_status = '1'"),
		   	 'paper'=>$this->User_model->get_parameter_data('ref_paper','name','data_status = 1'),
			 'paper_vendor'=>$this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
			 'case_logic'=>$this->User_model->get_parameter_data('ref_case_logic','name','data_status = 1'),
			 'request_type'=>$this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
			 'sec_sts'=>$this->User_model->get_parameter_data('ref_sec_sts','name','data_status = 1'),
			 'auc_sts'=>$this->User_model->get_parameter_data('ref_auc_sts','name','data_status = 1'),
			 'busi_sts'=>$this->User_model->get_parameter_data('ref_busi_sts','name','data_status = 1'),
			 'borr_sts'=>$this->User_model->get_parameter_data('ref_borr_sts','name','data_status = 1'),
			 'guar_occ'=>$this->User_model->get_parameter_data('ref_guar_occ','name','data_status = 1'),
			 'guar_sts'=>$this->User_model->get_parameter_data('ref_guar_sts','name','data_status = 1'),
			 'guar_type'=>$this->User_model->get_parameter_data('ref_guar_type','name','data_status = 1'),
			 'sub_type'=>$this->User_model->get_parameter_data('ref_subject_type','name','data_status = 1'),
			 'loan_segment'=>$this->User_model->get_parameter_data('ref_loan_segment','name','data_status = 1'),
			 'pages'=> 'suit_filling_legal/pages/form',
			 'editrow' => $editrow
			 );
		$this->load->view('suit_filling_legal/form_layout',$data);
	}
	function mortgage($cma_id,$id,$add_edit,$edit_id=Null)
	{
		$data = array(
					 'option' => '',
					 'cma_id'=>$cma_id,
					 'id'=>$id,
					 'add_edit'=>$add_edit,
					 'edit_id'=>$edit_id,
					 'results'=>$this->Suit_filling_legal_model->get_where('cma_facility_mortgage',array('id'=>$edit_id)),
					 'pages'=> 'suit_filling_legal/pages/mortgage'
					 );
		$this->load->view('suit_filling_legal/form_layout',$data);
	}
	function paper_notice_verify($id=NULL,$editrow=NULL,$cma_id=NULL)
	{
		$result = $this->Cma_ho_model->get_recommend_info($cma_id);
		$result2 = $this->Suit_filling_legal_model->get_paper_info($id);
		$data = array(
					 'option' => '',
					 'cma_id'=>$cma_id,
					 'id'=>$id,
					 'edit_row'=>$editrow,
					 'result'=>$result,
					 'result2'=>$result2,
					 'pages'=> 'suit_filling_legal/pages/paper_verify_form'
					 );
		$this->load->view('suit_filling_legal/form_layout',$data);
	}
	function prepare_memo($id=NULL,$editrow=NULL,$cma_id=NULL)
	{
		$result = $this->Cma_ho_model->get_recommend_info($cma_id);
		$result2 = $this->Suit_filling_legal_model->get_paper_info($id);
		$result3 = $this->Suit_filling_legal_model->get_memo_details($cma_id);
		$data = array(
				 'option' => '',
				 'cma_id'=>$cma_id,
				 'id'=>$id,
				 'edit_row'=>$editrow,
				 'result'=>$result,
				 'result2'=>$result2,
				 'result3'=>$result3,
				 'bidder_rank'=>$this->User_model->get_parameter_data('ref_bidder_rank','name','data_status = 1'),
				 'schedule'=>$this->User_model->get_parameter_data('cma_facility_mortgage','id','sts = 1 AND cma_id='.$cma_id.''),
				 'pages'=> 'suit_filling_legal/pages/memo_prepare'
				 );
		$this->load->view('suit_filling_legal/form_layout',$data);
	}
	function update_bidder($id=NULL,$editrow=NULL,$cma_id=NULL)
	{
		$result = $this->Cma_ho_model->get_recommend_info($cma_id);
		$result2 = $this->Suit_filling_legal_model->get_paper_info($id);
		$result3 = $this->Suit_filling_legal_model->get_memo_details($cma_id);
		$data = array(
				 'option' => '',
				 'cma_id'=>$cma_id,
				 'id'=>$id,
				 'edit_row'=>$editrow,
				 'result'=>$result,
				 'result2'=>$result2,
				 'result3'=>$result3,
				 'bidder'=>$this->User_model->get_parameter_data('cma_auction_bidder','id','sts = 1 AND cma_id='.$cma_id.''),
				 'pages'=> 'suit_filling_legal/pages/update_bidder'
				 );
		$this->load->view('suit_filling_legal/form_layout',$data);
	}
	function memo_verify($id=NULL,$editrow=NULL,$cma_id=NULL)
	{
		$result = $this->Cma_ho_model->get_recommend_info($cma_id);
		$result2 = $this->Suit_filling_legal_model->get_paper_info($id);
		$result3 = $this->Suit_filling_legal_model->get_memo_details($cma_id);
		$data = array(
				 'option' => '',
				 'cma_id'=>$cma_id,
				 'id'=>$id,
				 'edit_row'=>$editrow,
				 'result'=>$result,
				 'result2'=>$result2,
				 'result3'=>$result3,
				 'schedule'=>$this->User_model->get_parameter_data('cma_facility_mortgage','id','sts = 1 AND cma_id='.$cma_id.''),
				 'bidder_rank'=>$this->User_model->get_parameter_data('ref_bidder_rank','name','data_status = 1'),
				 'schedule'=>$this->User_model->get_parameter_data('cma_facility_mortgage','id','sts = 1 AND cma_id='.$cma_id.''),
				 'pages'=> 'suit_filling_legal/pages/memo_verify'
				 );
		$this->load->view('suit_filling_legal/form_layout',$data);
	}
	function memo_add($edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$row='';

		$text = array();
		if($this->session->userdata['ast_user']['login_status']){
			$id = $this->Suit_filling_legal_model->add_memo($edit_id);
		}else{
			$text[]="Session out, login required";
		}

		$Message='';
		if ($id!='00') {
			if(count($text)<=0){
			$Message='OK';
			$row=$this->Suit_filling_legal_model->get_add_action_data($id);
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
	function mortgage_security_details()
	{
		$csrf_token=$this->security->get_csrf_hash();
			if ($this->input->post('id') != "" && $this->input->post('type')=='mortgage'){
				$details=$this->Suit_filling_legal_model->get_mortgage_info($this->input->post('id'));
	    	}
	    	else{$details=$this->Suit_filling_legal_model->get_security_info($this->input->post('id'));}
	    	$var =array(
					"details"=>$details,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	}
	function details()
	{
		$csrf_token=$this->security->get_csrf_hash();
			if ($this->input->post('id') != ""){
				$details=$this->Suit_filling_legal_model->get_recommend_info($this->input->post('id'));
	    		$guarantor_info= $this->Suit_filling_legal_model->get_guarantor_info('edit',$this->input->post('id'));    	
	    	}
	    	else{$details=array();}
	    	$var =array(
					"details"=>$details,
					"guarantor_info"=>$guarantor_info,
					"csrf_token"=>$csrf_token
					);
			echo json_encode($var);
	}
	function mortsecurity($cma_id,$id,$add_edit,$mortgage_id=NULL,$edit_id=NULL)
	{
		$data = array(
			 'option' => '',
			 'cma_id'=>$cma_id,
			 'id'=>$id,
			 'add_edit'=>$add_edit,
			 'edit_id'=>$edit_id,
			 'mortgage_id'=>$mortgage_id,
			 'results'=>$this->Suit_filling_legal_model->get_where('cma_facility_mortgage_security',array('id'=>$edit_id)),
			 'district'=>$this->User_model->get_parameter_data('csms_ref_districts','name','sts = 1'),
			 'thana'=>$this->User_model->get_parameter_data('csms_ref_thana','name','sts = 1'),
			 'regoffice'=>$this->User_model->get_parameter_data('csms_ref_sro_office_name','name','sts = 1'),
			 'mouza'=>$this->User_model->get_parameter_data('csms_ref_mouza','name','sts = 1'),
			 'typedeed'=>$this->User_model->get_parameter_data('csms_ref_type_of_deed','name','sts = 1'),
			 'pages'=> 'suit_filling_legal/pages/sequerity'
			 );
		$this->load->view('suit_filling_legal/form_layout',$data);
	}
	function mort()
	{
		$this->load->model('Suit_filling_legal_model', '', TRUE);

		$result = $this->Suit_filling_legal_model->get_data('cma_facility_mortgage');

		echo json_encode($result);
	}
	function getdata()
	{
		echo '<pre>';print_r($_POST);exit;
		$cma_id = $this->input->post('cma_id');
		$auction_id = $this->input->post('auction_id');
		$auction_status = $this->input->post('auction_status');
		$accno = $this->input->post('accno');
		$csrf_token=$this->security->get_csrf_hash();
		$Message= "";
		$id=0;
		if($auction_status=='1'){
				$id = $this->Suit_filling_legal_model->auction_complete($cma_id,$auction_id);
		}else{
			if($this->session->userdata['ast_user']['login_status'])
			{
				$id = $this->Suit_filling_legal_model->add_edit_action($accno);
			}
			else{
				$Message="Session out, login required";
			}
		}
		$var['csrf_token']=$csrf_token;
		$var['Message']=$Message;
		$var['id']=$id;
		echo json_encode($var);
	}
	function paper_notice_add($auction_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$row='';

		$text = array();
		if($this->session->userdata['ast_user']['login_status']){
			$id = $this->Suit_filling_legal_model->add_paper_notice($auction_id);
		}else{
			$text[]="Session out, login required";
		}

		$Message='';
		if ($id!='00') {
			if(count($text)<=0){
			$Message='OK';
			$row=$this->Suit_filling_legal_model->get_add_action_data($id);
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
	function mortgage_add_edit($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$row='';

		$text = array();
		if($this->session->userdata['ast_user']['login_status']){
			$id = $this->Suit_filling_legal_model->mortgage_add_edit($add_edit,$edit_id);
		}else{
			$text[]="Session out, login required";
		}

		$Message='';
		if ($id!='00') {
			if(count($text)<=0){
			$Message='OK';
			$row=$this->Suit_filling_legal_model->get_add_action_data($id);
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
	function security_add_edit($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$row='';

		$text = array();
		if($this->session->userdata['ast_user']['login_status']){
			$id = $this->Suit_filling_legal_model->security_add_edit($add_edit,$edit_id);
		}else{
			$text[]="Session out, login required";
		}

		$Message='';
		if ($id!='00') {
			if(count($text)<=0){
			$Message='OK';
			$row=$this->Suit_filling_legal_model->get_add_action_security_data($id);
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

}

?>