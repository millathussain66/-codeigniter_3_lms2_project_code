<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_info extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('User_info_model', '', TRUE);
		$this->load->model('Users_group_model', '', TRUE);
		$this->load->model('User_model', '', TRUE);
	}

	function view ($menu_group=NULL,$menu_cat=NULL)
	{
		$link_id=212;
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'sys_config'=> $this->User_info_model->upr_config_row(),
					'pages'=> 'user_info/pages/grid',
					'checker_info' => $this->User_info_model->get_checker_data($link_id),
				   	'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	 function sendToChecker($send_to) {		
	  $csrf_token = $this->security->get_csrf_hash();
		$send_to=$this->security->xss_clean($send_to);		
		par_check('notnull_int', $send_to);		
		$sendToCheckerIndexId=$this->security->xss_clean($this->input->post('sendToCheckerIndexId'));
        $id=$this->User_info_model->sendToChecker($send_to);
        $sah=$this->User_info_model->get_initial_action_data_by_employee_id($sendToCheckerIndexId);
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
    function get_dropdown_data_for_user_module()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $id = $this->input->post('id');
        $operation = $this->input->post('operation');
        if ($operation=='recovery_region') 
        {
            $condition=" AND region IN(".$id.")";
            $table='ref_territory';
        }
        if ($operation=='legal_region') 
        {
            $condition=" AND region IN(".$id.")";
            $table='ref_legal_district';
        }
        if($operation=='territory')
        {
            $condition=" AND territory IN(".$id.")";
            $table='ref_district';
        }

        if($operation=='recovery_district')
        {
            $condition=" AND district IN(".$id.")";
            $table='ref_unit_office';
        }

        if($operation=='court')
        {
            $condition=" AND district IN(".$id.")";
            $table='ref_court';
        }
        
        $sah=$this->User_model->get_parameter_data($table,'name',"data_status = '1' ".$condition." ");
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
    function get_dropdown_data()
    {
    	$csrf_token = $this->security->get_csrf_hash();
    	$id = $this->input->post('id');
    	$operation = $this->input->post('operation');
    	if ($operation=='region') 
    	{
    		$condition=" AND region  IN(".$id.")";
    		$table='ref_territory';
    	}
    	if ($operation=='legal_region' || $operation=='legal_region_grid') 
    	{
    		$condition=" AND region  IN(".$id.")";
    		$table='ref_legal_district';
    	}
    	if ($operation=='legal_district_lawyer' || $operation=='legal_district_lawyer_grid') //get legal district wise lawyer
    	{
    		$condition=" AND district  IN(".$id.")";
    		$table='ref_lawyer';
    	}
    	if ($operation=='legal_district_case_deal_officer') //get legal district wise case deal officer
    	{
    		$condition=" AND admin_status<>2 AND (FIND_IN_SET(1,user_group_id) OR FIND_IN_SET(2,user_group_id)) AND block_status = 0 AND FIND_IN_SET(".$this->db->escape($id).",legal_district)";
    		$table='users_info';
    	}
    	if($operation=='territory')
    	{
    		$condition=" AND territory IN(".$id.")";
    		$table='ref_district';
    	}

    	if($operation=='district')
    	{
    		$condition=" AND district IN(".$id.")";
    		$table='ref_unit_office';
    	}

    	if($operation=='court')
    	{
    		$condition=" AND district IN(".$id.")";
    		$table='ref_court';
    	}
    	
		$sah=$this->User_model->get_parameter_data($table,'name',"data_status = '1' ".$condition." ");
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
    function get_dropdown_data_ln_cma()
    {
        $csrf_token = $this->security->get_csrf_hash();
        $id = $this->input->post('id');
        $operation = $this->input->post('operation');
        if ($operation=='region') 
        {
            $condition=" AND region IN(".$id.")";
            if(check_group(4))
            {
                $condition.=' AND id IN('.$this->session->userdata['ast_user']['recovery_territory'].')';
            }
            $table='ref_territory';
        }
        if($operation=='territory')
        {
            $condition=" AND territory IN(".$id.")";
            if(check_group(4))
            {
                $condition.=' AND id IN('.$this->session->userdata['ast_user']['recovery_district'].')';
            }
            $table='ref_district';
        }
        if ($operation=='legal_region' || $operation=='legal_region_grid') 
        {
            $condition=" AND region  IN(".$id.")";
            $table='ref_legal_district';
        }
        if($operation=='district')
        {
            $condition=" AND district IN(".$id.")";
            if(check_group(4))
            {
                $condition.=' AND id IN('.$this->session->userdata['ast_user']['recovery_unit_office'].')';
            }
            $table='ref_unit_office';
        }

        if($operation=='court')
        {
            $condition=" AND district IN(".$id.")";
            $table='ref_court';
        }
        
        $sah=$this->User_model->get_parameter_data($table,'name',"data_status = '1' ".$condition." ");
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
    function get_report_dropdown_data()
    {
    	$csrf_token = $this->security->get_csrf_hash();
    	$table_name = $this->input->post('table_name');
  		$condition = "";
  		if($table_name=='users_info')
  		{
  			$condition = "data_status = '1' AND verify_status = '0' AND block_status = '0' AND users_info.admin_status <> '2'";
  		}
  		else
  		{
  			$condition = "data_status = '1'";
  		}
		$sah=$this->User_model->get_parameter_data($table_name,'name',$condition." ");
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
    function get_case_name()
    {
    	$csrf_token = $this->security->get_csrf_hash();
    	$req_type = $this->input->post('req_type');
    	$operation = $this->input->post('operation');
    	$table='ref_case_name';
    	
		$sah=$this->User_model->get_parameter_data($table,'name',"data_status = '1' AND req_type='".$req_type."' ");
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
    function get_recovery_makers()
    {
    	$csrf_token = $this->security->get_csrf_hash();
    	$territory = $this->input->post('territory');
        $sah = null;
        if($territory!='')
        {
            $territory_where = multi_selected_query_maker($territory,'recovery_territory');
            $sah=$this->User_model->get_parameter_data('users_info','name',"data_status = '1' AND verify_status = '0' AND block_status = '0' AND admin_status <> '2' $territory_where AND FIND_IN_SET(4,user_group_id)");
        }
		
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
    function get_legal_makers()
    {
    	$csrf_token = $this->security->get_csrf_hash();
    	$legal_region = $this->input->post('legal_region');
        $sah = null;
        if($legal_region!='')
        {
            $region_where = multi_selected_query_maker($legal_region,'legal_region');

            $sah=$this->User_model->get_parameter_data('users_info','name',"data_status = '1' AND verify_status = '0' AND block_status = '0' AND admin_status <> '2' $region_where AND FIND_IN_SET(2,user_group_id)");
        }
        
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
    function check_status_closing()
    {
    	$csrf_token = $this->security->get_csrf_hash();
    	$id = $this->input->post('id');
    	$req_type = $this->input->post('req_type');
    	$str="SELECT s.*
            FROM ref_case_sts as s
            WHERE s.data_status<>0 AND s.id=$id AND FIND_IN_SET('".$req_type."',settled_for) LIMIT 1";
            $query=$this->db->query($str);
        $sah=$query->row();
        $jTableResult = array();
        if (!empty($sah)) {
            $jTableResult['status'] = "success";
            $jTableResult['row_info'] = 1;
        } else {
            $jTableResult['status'] = "";
            $jTableResult['row_info'] = 0;
        }
        $jTableResult['csrf_token'] = $csrf_token;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }
	function grid()
	{
		$this->load->model('User_info_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;
		$result=$this->User_info_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function detail() {
        $str = '';
        $str2 = '';
        $result1='';
        $table='users_info';
        $csrf_token=$this->security->get_csrf_hash();
		$id=$this->security->xss_clean($this->input->post('id'));
        $r = $this->User_model->check_status($id,$table);
        if ($r == 0) {
            $str2 .='<div align="center" ><h1 style="color:#ff0000;" >Sorry !!! </h1> <br> <h2>Entry Already Deleted... </h2></div>';
            echo $str2;
            die();
        }
        $result = $this->User_info_model->get_add_action_data($id);
        $group_result = $this->User_info_model->get_multiselectdata('user_group',$result->user_group_id,'group_name');
        $recovery_region_result = $this->User_info_model->get_multiselectdata('ref_region',$result->recovery_region,'name');
        $recovery_territory_result = $this->User_info_model->get_multiselectdata('ref_territory',$result->recovery_territory,'name');
        $recovery_unit_office_result = $this->User_info_model->get_multiselectdata('ref_unit_office',$result->recovery_unit_office,'name');
        $recovery_district_result = $this->User_info_model->get_multiselectdata('ref_district',$result->recovery_district,'name');
        $legal_district_result = $this->User_info_model->get_multiselectdata('ref_legal_district',$result->legal_district,'name');
        $legal_region_result = $this->User_info_model->get_multiselectdata('ref_legal_region',$result->legal_region,'name');
        $recovery_makers_result = $this->User_info_model->get_multiselectdata('users_info',$result->recovery_makers,'name');
        $legal_makers_result = $this->User_info_model->get_multiselectdata('users_info',$result->legal_makers,'name');
        

        $str .='
                <div align="center" style="color:#000000;">
                
                <table cellspacing="0" align="center" cellpadding="5"  border="1" class="preview_table" style="">';

        $str .='<tr style="height:19px;">
                    <td style="width:19%;" class="info_view"><strong>User ID</strong></td>
                    <td style="width:35%;" class="info_view">' . $result->user_id . '</td>
					<td  class="info_view"><strong>Designation</strong></td>
                    <td class="info_view">'.$result->designation_name.'</td>
                </tr>
				<tr style="height:19px;">
                    <td style="width:19%;" class="info_view"><strong>PIN</strong></td>
                    <td style="width:35%;" class="info_view">' . $result->pin . '</td>
					<td  class="info_view"><strong>&nbsp;</strong></td>
                    <td class="info_view">&nbsp;</td>
                </tr>
                <tr style="height:19px;">
					<td style="width:22%;" class="info_view"><strong>Name</strong></td>
                    <td style="" class="info_view">'.$result->name . '</td>
                   <td  class="info_view"><strong>Phone</strong></td>
                    <td class="info_view">'.$result->mobile_number.' </td>
                </tr>
                <tr style="height:19px;">
					<td style="width:22%;" class="info_view"><strong>User Group</strong></td>
                    <td style="" class="info_view">';
            if(is_object($group_result)){$str.=$group_result->multi_name;}
            $str.=' </td>
                    <td  class="info_view" valign="top"><strong>Location</strong></td>
                    <td class="info_view">'.$result->location . '</td>
                </tr>
                <tr style="height:19px;">
                    <td  class="info_view"><strong>Recovery Region</strong></td>
                    <td style="" class="info_view">';
            if(is_object($recovery_region_result)){$str.=$recovery_region_result->multi_name;}
            $str.=' </td>
                    <td  class="info_view"><strong>Create by</strong></td>
                    <td class="info_view">'.$result->entry_by.' </td>
                </tr>
                <tr style="height:19px;">
                    <td  class="info_view"><strong>Recovery Territory</strong></td>
                    <td style="" class="info_view">';
            if(is_object($recovery_territory_result)){$str.=$recovery_territory_result->multi_name;}
            $str.=' </td>
                    <td  class="info_view"><strong>Created Date Time</strong></td>
                    <td class="info_view">'.$result->e_dt.' </td>
                </tr>
                 <tr style="height:19px;">
                    <td  class="info_view"><strong>Recovery Destrict</strong></td>
                    <td style="" class="info_view">';
            if(is_object($recovery_district_result)){$str.=$recovery_district_result->multi_name;}
            $str.=' </td>
                    <td  class="info_view"><strong>Last Modified by</strong></td>
                    <td class="info_view">'.$result->last_modified_by.' </td>
                </tr>
                 <tr style="height:19px;">
                    <td  class="info_view"><strong>Recovery Unit Office</strong></td>
                    <td style="" class="info_view">';
            if(is_object($recovery_unit_office_result)){$str.=$recovery_unit_office_result->multi_name;}
            $str.=' </td>
                    <td  class="info_view"><strong>Last Modified Date Time</strong></td>
                    <td class="info_view">'.$result->u_dt.' </td>
                </tr>
                <tr style="height:19px;">
                    <td  class="info_view"><strong>Department</strong></td>
                    <td class="info_view">'.$result->department_name.'</td>
                    <td  class="info_view"><strong>Last Activate By</strong></td>
                    <td class="info_view">'.$result->unblock_by.' </td>
                </tr>
                <tr style="height:19px;">
                    <td  class="info_view"><strong>Email</strong></td>
                    <td class="info_view">' . $result->email_address . '</td>
                    <td  class="info_view"><strong>Last Activate Date Time</strong></td>
                    <td class="info_view">'.$result->ac_dt.' </td>
                </tr>
                <tr style="height:19px;">
                    <td  class="info_view"><strong>Legal Region</strong></td>
                    <td style="" class="info_view">';
            if(is_object($legal_region_result)){$str.=$legal_region_result->multi_name;}
            $str.=' </td>
                    <td  class="info_view"><strong>Legal District</strong></td>
                    <td style="" class="info_view">';
            if(is_object($legal_district_result)){$str.=$legal_district_result->multi_name;}
            $str.=' </td>
                </tr>
                <tr style="height:19px;">
                    <td  class="info_view"><strong>Recovery Makers</strong></td>
                    <td style="" class="info_view">';
            if(is_object($recovery_makers_result)){$str.=$recovery_makers_result->multi_name;}
            $str.=' </td>
                    <td  class="info_view"><strong>Legal Makers</strong></td>
                    <td style="" class="info_view">';
            if(is_object($legal_makers_result)){$str.=$legal_makers_result->multi_name;}
            $str.=' </td>
                </tr>';
               
              
           

        $str .='</table></div><br/>';
         
        $str.='<div align="center"><input type="button" id="close" value="Close" onclick="close_view()"/></div>';
        
       // echo $str;
        echo  $str.':::'.$csrf_token;
        // $this->load->view("booking_management/pages/test");
    }
	
	function from($add_edit='add',$id=NULL,$editrow=NULL)
	{		
		$id=$this->security->xss_clean($id);
		par_check('int',$id);
		
		
			
		$result=$this->User_info_model->get_info($add_edit,$id);
		$branch_condition="";
		$grp_condition="";
		$admin_sts='';
		if($add_edit=='edit'){
			$admin_sts=$this->User_info_model->get_admin_sts($id);
		}
		if($this->session->userdata['ast_user']['user_system_admin_sts']!=2 || $admin_sts!=2)
		{
			$grp_condition=" AND group_name != 'Super Admin'  ";

		}else{
			$grp_condition=" AND group_name != ' '  ";
		}
		//echo $grp_condition
		$data = array(
				   'option' => '',
				   'add_edit' => $add_edit,
				   'sys_config'=> $this->User_info_model->upr_config_row(),
				   'region_data' => $this->user_model->get_parameter_data('ref_region','id','data_status = 1'),
				   'legal_region_data' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1'),
				   'working_group_list' => $this->User_model->get_parameter_data('user_group','group_name',"data_status = '1' ".$grp_condition." "),
				   'territory_list' => $this->User_model->get_parameter_data('ref_territory','name',"data_status = '1'"),
				   'district_list' => $this->User_model->get_parameter_data('ref_district','name',"data_status = '1'"),
				   'unit_office_list' => $this->User_model->get_parameter_data('ref_unit_office','name',"data_status = '1'"),
				   'designation_list'	=> $this->User_model->get_parameter_data('ref_designation','name',"data_status = '1'"),
				   'fun_designation_list'	=> $this->User_model->get_parameter_data('ref_functional_designation','name',"data_status = '1'"),
				   'department_list'	=> $this->User_model->get_parameter_data('ref_department','name',"data_status = '1'"),
				   'free_field_3_list'	=> $this->User_model->get_parameter_data('ref_user_free_field_3','name',"data_status = '1'"),
				   'free_field_4_list'	=> $this->User_model->get_parameter_data('ref_user_free_field_4','name',"data_status = '1'"),
				   'result' => $result,
				   'id' => $id,
				   'pages'=> 'user_info/pages/form',
				   'editrow' => $editrow
				   );
		$this->load->view('user_info/form_layout',$data);
	}

	function set_default_group_rights($d_v=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$msg=$this->User_info_model->set_default_group_rights($this->input->post('id'),$this->input->post('gid'));
		$jTableResult = array();
		$jTableResult['status'] = $msg;
		$jTableResult['errorMsgs'] = $msg;
		$jTableResult['csrf_token'] = $csrf_token;
		echo json_encode($jTableResult);
	}
	function ref_table_right_details($groupId=NULL,$menu_operation=NULL)
	{
		$data=array();
		$csrf_token=$this->security->get_csrf_hash();
		$data = array(
			'csrf_token'=>$csrf_token
		);
		$result=$this->Users_group_model->ref_table_right_details($groupId,$menu_operation);
		
		echo json_encode($result);
	}
	function service_table_right_details($groupId=NULL,$menu_operation=NULL)
	{
		$data=array();
		$csrf_token=$this->security->get_csrf_hash();
		$data = array(
			'csrf_token'=>$csrf_token
		);
		$result=$this->Users_group_model->service_table_right_details($groupId,$menu_operation);
		
		echo json_encode($result);
	}
	function maintenance_table_right_details($groupId=NULL,$menu_operation=NULL)
	{
		$data=array();
		$csrf_token=$this->security->get_csrf_hash();
		$data = array(
			'csrf_token'=>$csrf_token
		);
		$result=$this->Users_group_model->maintenance_table_right_details($groupId,$menu_operation);
		
		$data['result'] = $result;
		echo json_encode($data);
	}
	function get_working_group_rights($Id=NULL)
	{
		$data=array();
		$csrf_token=$this->security->get_csrf_hash();
		$data = array(
			'csrf_token'=>$csrf_token
		);
		$result=$this->User_info_model->get_working_group_rights($Id);
		
		$data['result'] = $result;
		echo json_encode($data);
	}
	function fromverify($id=NULL,$editrow=NULL,$v_sts=NULL)
	{
		$result = $this->User_info_model->get_verify_action_data($id,$v_sts);
		$add_edit="verify";
		$branch_condition="";
		$grp_condition="";
		$admin_sts='';
		if($add_edit=='verify'){
			$admin_sts=$this->User_info_model->get_admin_sts($id);
		}
		
		if($this->session->userdata['ast_user']['user_system_admin_sts']!=2 || $admin_sts!=2)
		{
			$grp_condition=" AND group_name != 'Super Admin'  ";

		}else{
			$grp_condition=" AND group_name != ' '  ";
		}
		$data = array( 	
				   'option' => '',
				   'add_edit' => 'verify',
				   'upr_config'=> $this->User_info_model->upr_config_row(),
				   'working_group_list' => $this->User_model->get_parameter_data('user_group','group_name',"data_status = '1' ".$grp_condition." "),
				   'branch_list' => $this->User_model->get_parameter_data('ref_branch_sol','name',"data_status = '1' ".$branch_condition." "),
				   'designation_list'	=> $this->User_model->get_parameter_data('ref_designation','name',"data_status = '1'"),
				   'fun_designation_list'	=> $this->User_model->get_parameter_data('ref_functional_designation','name',"data_status = '1'"),
				   'department_list'	=> $this->User_model->get_parameter_data('ref_department','name',"data_status = '1'"),
				   //'unit_list'	=> $this->User_model->get_parameter_data('ref_unit','NAME',"DATA_STATUS = '1'"),
				   'free_field_3_list'	=> $this->User_model->get_parameter_data('ref_user_free_field_3','name',"data_status = '1'"),
				   'free_field_4_list'	=> $this->User_model->get_parameter_data('ref_user_free_field_4','name',"data_status = '1'"),
				   'result' => $result,
				   'id' => $id,
				   'v_sts' => $v_sts,
				   'pages'=> 'user_info/pages/form_verify',
				   'edit_row' => $editrow			   
				   );
		$this->load->view('user_info/form_layout',$data);
	}

	function set_right($Id=NULL,$group_id=NULL,$editrow=NULL)
	{
		$employee_ID = '';
		$name = '';
		$user_info = $this->User_info_model->get_user_info($Id);
		if($user_info!='')
		{
			$employee_ID = $user_info->user_id;
			$name = $user_info->name;
		}
		
		$group_name = '';
		
		$wg_info = $this->User_info_model->get_working_group_info("",$group_id);
		
		if(!empty($wg_info))
		{
			$group_name = $wg_info->group_name;
		}
		
		$data='';
		$data=$this->User_info_model->get_user_info_rights($Id);

		$data = array(
			   'wg_Id' => $Id,
			   'GROUP_ID' => $group_id,
			   'GROUP_NAME' => $group_name,
			   'employee_ID' => $employee_ID,
			   'name' => $name,
			   'editrow' => $editrow,
			   'data' => $data,
			   'result'=> $this->User_info_model->system_link_list(),
			   'pages'=> 'user_info/pages/right'
		  );
		$this->load->view('user_info/form_layout',$data);
	}

	function set_right_update($eid)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text=array();
		if ($this->session->userdata['ast_user']['login_status'])
		{
			$id=$this->User_info_model->set_right_update($eid);
		}
		else{
			$text[]="Session out, login required";
		}

		$Message='';
		if(count($text)<=0){
			$Message='OK';
			$row=$this->User_info_model->get_add_action_data($eid);
		}else{
			for($i=0; $i<count($text); $i++)
			{
				if($i>0){$Message.=',';}
				$Message.=$text[$i];
			}
			$row[]='';
		}

		$var =array();
		$var['Message']=$Message;
		$var['row_info']=$row;
		$var['csrf_token']=$csrf_token;
		echo json_encode($var);
	}


	function duplicate_field($field_name=NULL,$add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$var = array(
				"csrf_token"=>$csrf_token
			);
		if ($this->input->post('val') != ""){

			$num_row=$this->User_info_model->duplicate_name($field_name,$this->input->post('val'),$edit_id);
			$var["Status"]=$num_row>0?'duplicate':'ok';
    	}
        echo json_encode($var);
	}

	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$add_edit=$this->security->xss_clean($add_edit);
		$edit_id=$this->security->xss_clean($edit_id);
		$text = array();
		if($this->session->userdata['ast_user']['login_status'])
		{
			$id = $this->User_info_model->add_edit_action($add_edit,$edit_id);
		}
		else{
			$text[]="Session out, login required";
		}

		$Message = '';
		$row[] = '';
		if(count($text)<=0)
		{
			if($id!='00')
			{
				$Message = 'OK';
				$row = $this->User_info_model->get_add_action_data($id);
			}else{
				$Message = 'Something went wrong!';
			}
			
		}else{
			for($i=0; $i<count($text); $i++)
			{
				if($i>0){$Message.=',';}
				$Message.=$text[$i];
			}
			$row[]='';
		}

		$var =array();
		$var['Message']=$Message;
		$var['row_info']=$row;
		$var['csrf_token']=$csrf_token;
		echo json_encode($var);
	}

	function reset_pass()
	{
		$csrf_token=$this->security->get_csrf_hash();
		$verifyEventId=$this->security->xss_clean($this->input->post('verifyEventId'));
		$jTableResult = array(
							"csrf_token"=>$csrf_token
						);
						
		$b=$this->User_info_model->reset_pass();
		if($b!='00'){
			$jTableResult['row_info']=$this->User_info_model->get_add_action_data($verifyEventId);
			$jTableResult['Message'] = "OK";
		}else{
			$jTableResult['Message'] = "Something is wrong!";
		}
		echo json_encode($jTableResult);
	}

	function delete_action($d_v=NULL)
	{
		$id=$this->User_info_model->delete_action();
		$csrf_token=$this->security->get_csrf_hash();
		$jTableResult = array();
		$jTableResult['status'] = "success";
		$jTableResult['csrf_token'] = $csrf_token;
		echo json_encode($jTableResult);
	}
	function return_action($d_v=NULL)
	{
		$id=$this->User_info_model->return_action();
		$csrf_token=$this->security->get_csrf_hash();
		//exit;
		$jTableResult = array();
		$jTableResult['Message'] = "OK";
		$jTableResult['csrf_token'] = $csrf_token;
		echo json_encode($jTableResult);
	}
	function reject_action($d_v=NULL)
	{
		$id=$this->User_info_model->reject_action();
		$jTableResult = array();
		$jTableResult['Message'] = "OK";
		$csrf_token=$this->security->get_csrf_hash();
		$jTableResult['csrf_token'] = $csrf_token;
		echo json_encode($jTableResult);
	}
	function change_pass($menu_group=1,$menu_cat=NULL)
	{
		if ($this->session->userdata['ast_user']['login_status'])
		{
			$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'sys_config'=> $this->User_info_model->upr_config_row(),
				    'pages'=> 'user_info/pages/change_pass'
			  );
			$this->load->view('grid_layout',$data);
		}
		else{
			redirect('/home');
		}
	}

	function old_pass_check()
	{
		
		$user_id=$this->session->userdata['ast_user']['user_id'];
		$pass=$this->security->xss_clean($this->input->post('val'));
		$pass2 = $this->User_model->encrypt($pass); 
		
		$b=$this->User_model->old_pass_check($user_id,$pass2);

		$jTableResult = array();
		$jTableResult['Status'] = $b>0?"OK":"Internal Server Error";
		$csrf_token=$this->security->get_csrf_hash();
		$jTableResult['csrf_token'] = $csrf_token;
		echo json_encode($jTableResult);
	}
	
	function reset_userid_check()
	{
		$b=$this->User_info_model->reset_userid_check($this->input->post('val'));

		$jTableResult = array();
		$jTableResult['Status'] = $b>0?"ok":"Internal Server Error";

		echo json_encode($jTableResult);
	}
	
   function immediate_pervious_4_password($id,$pass2)
   {	 
		$str = "select * from user_password_change_history where user_id='" . $id . "' order by change_datetime DESC LIMIT 4 ";
            
            $query = $this
                ->db
                ->query($str);
            $count = 0;
            foreach ($query->result() as $row)
            {

                if ($row->password == $pass2)
                {
                    $count++;
                }
            }
           
		return $count;
	 
 	}
	
	function change_pass_action()
	{
		$csrf_token=$this->security->get_csrf_hash();
		if ($this->session->userdata['ast_user']['login_status'])
        {		
			$old_pass=$this->security->xss_clean($this->input->post('employee_ID'));
			$old_pass2 = $this->User_model->encrypt($old_pass);  
			
			$pass=$this->security->xss_clean($this->input->post('pass'));
			$pass2 = $this->User_model->encrypt($pass); 
			
			if ($this
				->User_info_model
				->old_pass_check($this
				->session
				->userdata['ast_user']['user_id'], $old_pass2) > 0)
			{
	
			   $b=$this->immediate_pervious_4_password( $this->session->userdata['ast_user']['user_id'],$pass2);
				if($b!=0)
				{					
						$msg = "System must not allow users to reuse immediate pervious 4 passwords.";
				}else{
						$sql = 'INSERT INTO user_password_change_history (user_id,change_by,change_datetime,password)  ';
						$sql .= "VALUES ('" . $this->session->userdata['ast_user']['user_id'] . "','" . $this->session->userdata['ast_user']['user_id'] . "','" . date("Y-m-d H:i:s") . "','" .$pass2 . "') ";
						$query = $this
							->db
							->query($sql);
						
						$data2 = $this
								->User_model
								->user_activities(52, '', $this->session->userdata['ast_user']['user_id'], 'users_info', 'Change Password (login)','', $this->session->userdata['ast_user']['user_id'], $this->session->userdata['ast_user']['user_full_id']);
						 $sys_config = $this
								->User_info_model
								->upr_config_row();
							$data = array(
								'password_change_status' => '1',
								'password_log' => $pass2,
								'password_expiry_date' => $sys_config->expiry_dt,
								'password_change_datetime' =>date("Y-m-d H:i:s")
							);
						
						$this->db->where('id', $this->session->userdata['ast_user']['user_id']);
						$this->db->update('users_info', $data);
		
					   $msg = "OK";
					   $this->session->sess_destroy();
					
				}
			}else{
				 $msg = "Wrong Old Password";
			}
			   
	
			$jTableResult = array();
			$jTableResult['Message'] = $msg;
			$jTableResult['csrf_token'] = $csrf_token;
			echo json_encode($jTableResult);
		}
        else
        {
            redirect("/home/index/");
        }
		
	}
	function reset_password()
	{
		
		if ($this->session->userdata['ast_user']['login_status'])
        {		
			$userid=$this->security->xss_clean($this->input->post('userid')); 
			$id=$this->security->xss_clean($this->input->post('id')); 
			
			$pass=$this->security->xss_clean($this->input->post('pass'));
			$pass2 = $this->User_model->encrypt($pass); 
			
			if ($this->User_info_model->resetpass_userid_check($userid) > 0)
			{
				$sql = 'INSERT INTO user_password_change_history (user_id,change_by,change_datetime,password)  ';
				$sql .= "VALUES ('" . $id . "','" . $this->session->userdata['ast_user']['user_id'] . "','" . date("Y-m-d H:i:s") . "','" .$pass2 . "') ";
				$query = $this
					->db
					->query($sql);
				
				$data2 = $this
						->User_model
						->user_activities(57, '',$id, 'users_info', 'Reset Password ','', $this->session->userdata['ast_user']['user_id'],$userid);
				 $sys_config = $this
						->User_info_model
						->upr_config_row();
					$data = array(
						//'password_change_status' => '1',
						'password_log' => $pass2,
						'password_expiry_date' => $sys_config->expiry_dt,
						'password_change_datetime' =>date("Y-m-d H:i:s")
					);
				
				$this->db->where('id', $id);
				$res = $this->db->update('users_info', $data);
				if($res){
					$msg = "OK";
				}
			   	else{
			   		$msg = "Not OK";
			   	}
			   //$this->session->sess_destroy();
					
				
			}else{
				 $msg = "Password does't change at this time!";
			}
			   
	
			$jTableResult = array();
			$jTableResult['Message'] = $msg;
			echo json_encode($jTableResult);
		}
        else
        {
            redirect("/home/index/");
        }
		
	}

	function listactivity()
	{
			
		$ip = $this->input->ip_address();
		$Status='';
		$Expire=$this->session->userdata['ast_user']['SESSION_idle_time']*60;
		if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($Expire))) {
			$Status=3;
		}

	   	if($ip == '0.0.0.0')
		{
			$ip = $_SERVER['REMOTE_ADDR'];
	    }

		if($this->input->get('User_Id')!='')
		{
			$User_Id=$this->input->get('User_Id');
		}else{
			$User_Id=0;
		}
		

		$sql = $this->db->query("UPDATE user_log_history SET last_activities = '".date('Y-m-d H:i:s')."' WHERE user_id = ".$this->db->escape($User_Id)." AND logout_status = 0 ORDER BY id DESC LIMIT 1");
		
	
 		$q1 = $this->db->query("SELECT * FROM users_info WHERE id = ".$this->db->escape($User_Id)." AND password_change_status=0 LIMIT 1");
		$q1_result = $q1->result();

		$q = $this->db->query("SELECT * FROM user_log_history WHERE user_id = ".$this->db->escape($User_Id)." AND logout_status=0 AND ip_address = '".$ip."' AND logout_status = 0 LIMIT 1");
		$q_result = $q->result();

		if ($Status=='') {
			if(empty($q1_result))
			{
				if(empty($q_result))
				{
					$this->logout($ip);
					$Status = 2;
				}
				else
				{
					if($this->session->userdata['ast_user']['login_status'])
					{
						$Status = 1;
					} else {
						$Status = 2;
					}
				}
			}else{
				$Status=1;
			}
		}
		echo $Status."::".$this->security->get_csrf_hash();
	}
	
	function logout($ip)
	{
		$sql = ("UPDATE user_log_history SET last_activities = '".date('Y-m-d H:i:s')."', logout_status=1 WHERE user_id = '".$this->session->userdata['ast_user']['user_id']."' AND  ip_address='".$ip."' order by ID DESC LIMIT 1");
		$this->db->query($sql);

		if (isset($_SERVER['HTTP_COOKIE'])) 
		{
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) 
			{
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, '', time()-1000);
				setcookie($name, '', time()-1000, '/');
			}
		}
		$past = time() - 3600;
		foreach ( $_COOKIE as $key => $value )
		{
			setcookie( $key, $value, $past, '/' );
		}

		redirect("/home/index/");
	}



}
?>