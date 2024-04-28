<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bill_data_edit extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Bill_data_edit_model', '', TRUE);
		$this->load->model('Common_model', '', TRUE);
		$this->load->model('User_info_model', '', TRUE);
		$this->load->model('Legal_file_process_model', '', TRUE);
		$this->load->model('Bill_ho_model', '', TRUE);

        
	}


	// FOR LAWER BILL 
	function view ($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{

		$operation = 'bill_data_edit/view';
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'operation'=>$operation,
					'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
					'lawyer' => $this->user_model->get_parameter_data('ref_lawyer','id','data_status = 1'),
					'vendor' => $this->user_model->get_parameter_data('ref_paper_vendor','id','data_status = 1'),
					'case_sts' => $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
					'sys_config'=> $this->User_info_model->upr_config_row(),
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'pages'=> 'bill_data_edit/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_data_edit_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function from($id=NULL,$editrow=NULL,$option=NULL)
	{
        $result = $this->Bill_data_edit_model->get_edit_info($id);
		$data = array(
					 'id' => $id,
                     'option'=>$option,
                     'result'=>$result,
                     'staff' => $this->user_model->get_parameter_data('users_info','id','data_status = 1'),
                     'vendor' => $this->user_model->get_parameter_data('ref_paper_vendor','id','data_status = 1'),
                     'lawyer' => $this->user_model->get_parameter_data('ref_lawyer','id','data_status = 1'),
                     'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1'),
                     'district' => $this->user_model->get_parameter_data('ref_legal_district','id','data_status = 1'),
					 'pages'=> 'bill_data_edit/pages/form',
					 'editrow' => $editrow,
					 );
		$this->load->view('bill_data_edit/form_layout',$data);
	}
    function edit_action()
    {

        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
		$Message = '';

        if ($this->session->userdata['ast_user']['login_status']) {
            $id = $this->Bill_data_edit_model->edit_action();

			if ($id==404) {
				$Message = 'NotOK';
			} else {
				  $Message = 'OK';
			}
		}
		else {
            $text[] = "Session out, login required";
        }
		
        $var['csrf_token'] = $csrf_token;
        $var['Message'] = $Message;
        $var['id'] = $id;
        echo json_encode($var);
    }
    function edit_action_lawyer_bill()
    {

        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
		$Message = '';

        if ($this->session->userdata['ast_user']['login_status']) {
            $id = $this->Bill_data_edit_model->edit_action_lawyer_bill();

			if ($id==404) {
				$Message = 'NotOK';
			} else {
				  $Message = 'OK';
			}
		}
		else {
            $text[] = "Session out, login required";
        }
		
        $var['csrf_token'] = $csrf_token;
        $var['Message'] = $Message;
        $var['id'] = $id;
        echo json_encode($var);
    }
    function edit_action_paper()
    {

        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
		$Message = '';

        if ($this->session->userdata['ast_user']['login_status']) {
            $id = $this->Bill_data_edit_model->edit_action_paper();

			if ($id==404) {
				$Message = 'NotOK';
			} else {
				  $Message = 'OK';
			}
		}
		else {
            $text[] = "Session out, login required";
        }
		
        $var['csrf_token'] = $csrf_token;
        $var['Message'] = $Message;
        $var['id'] = $id;
        echo json_encode($var);
    }
    function lawyer_bill_details()
	{
		$this->Common_model->delete_tempfile();
		$csrf_token=$this->security->get_csrf_hash();
		$str = '';
		$id = $this->input->post('id');
		$details = $this->Bill_data_edit_model->get_lawyer_bill_details($id);


    	if (!empty($details)) 
    	{
    		$str .='<table style="width: 100%;" id="preview_table">
				<thead></thead>
				<tbody id="details_body">

            <tr>
                <td width="50%" align="left"><strong>Case No :</strong>'.$details->case_number.'</td>
                <td width="50%" align="left"><strong>Legal Region:</strong>'.$details->region.'</td>
            </tr>
            <tr>
                <td width="50%" align="left"><strong>Legal District:</strong>'.$details->district.'</td>
                <td width="50%" align="left"><strong>Bill Amount:</strong>'.$details->amount.'</td>
            </tr>
            <tr>
                <td width="50%" align="left"><strong>Transition Date:</strong>'.$details->txrn_dt.'</td>
                <td width="50%" align="left"><strong>Update Date:</strong>'.$details->u_dt.'</td>
            </tr>

            <tr>
                <td width="50%" align="left"><strong> Lawyer Name:</strong>'.$details->lawyer_name.'</td>
                <td width="50%" align="left"><strong>Proposed Type:</strong>'.$details->proposed_type.'</td>
            </tr>

            <tr>
                <td width="50%" align="left"><strong>   Loan A/C :</strong>'.$details->loan_ac.'</td>
				<td width="50%" align="left"><strong> CIF:</strong>'.$details->cif.'</td>

            </tr>

            <tr>
                <td width="50%" align="left"><strong> A/C Name:</strong>'.$details->ac_name.'</td>
            </tr>

           

           


					';
			$str.='</tbody>
				</table>';
				
    	}




    	$var =array(
    			"str"=>$str,
				"csrf_token"=>$csrf_token
				);
		echo json_encode($var);
	}
	// FOR COURT FEE

	function court_fee ($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{

		$operation = 'bill_data_edit/court_fee';
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'operation'=>$operation,
					'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
					'lawyer' => $this->user_model->get_parameter_data('ref_lawyer','id','data_status = 1'),
					'case_sts' => $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
					'sys_config'=> $this->User_info_model->upr_config_row(),
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'pages'=> 'bill_data_edit/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function grid_court()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_data_edit_model->get_grid_data_grid_court($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}

	function edit_action_curt()
    {

        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
		$Message = '';

        if ($this->session->userdata['ast_user']['login_status']) {
            $id = $this->Bill_data_edit_model->edit_action_curt();

			if ($id==404) {
				$Message = 'NotOK';
			} else {
				  $Message = 'OK';
			}
		}
		else {
            $text[] = "Session out, login required";
        }
		
        $var['csrf_token'] = $csrf_token;
        $var['Message'] = $Message;
        $var['id'] = $id;
        echo json_encode($var);
    }

	// Paper Vendor 

	function paper_vendor ($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{

		$operation = 'bill_data_edit/paper_vendor';
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'operation'=>$operation,
					'paper_vendor' => $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
					'staff' => $this->Bill_data_edit_model->get_staff(),
					'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
					'lawyer' => $this->user_model->get_parameter_data('ref_lawyer','id','data_status = 1'),
					'case_sts' => $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
					'sys_config'=> $this->User_info_model->upr_config_row(),
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'pages'=> 'bill_data_edit/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function grid_paper_vendor()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_data_edit_model->get_grid_data_paper_vendor($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}

	// staff_conveyance
	
	function staff_conveyance($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{

		$operation = 'bill_data_edit/staff_conveyance';
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'operation'=>$operation,
					'paper_vendor' => $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
					'staff_grid_conv' => $this->User_model->get_parameter_data('users_info','name','data_status = 1'),
					'staff' => $this->Bill_data_edit_model->get_staff(),
					'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
					'lawyer' => $this->user_model->get_parameter_data('ref_lawyer','id','data_status = 1'),
					'case_sts' => $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
					'sys_config'=> $this->User_info_model->upr_config_row(),
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'pages'=> 'bill_data_edit/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function staff_conveyance_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_data_edit_model->staff_conveyance_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}

	function staff_conveyance_form($id=NULL,$editrow=NULL,$option=NULL)
	{
        $result = $this->Bill_data_edit_model->get_edit_info_staff_conveyance($id);
		$data = array(
					 'id' => $id,
                     'option'=>$option,
                     'result'=>$result,
                     'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1'),
                     'district' => $this->user_model->get_parameter_data('ref_legal_district','id','data_status = 1'),
					 'pages'=> 'bill_data_edit/pages/form',
					 'editrow' => $editrow,
					 );
		$this->load->view('bill_data_edit/form_layout',$data);
	}
    function edit_action_staff_conveyance()
    {

        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
		$Message = '';

        if ($this->session->userdata['ast_user']['login_status']) {
            $id = $this->Bill_data_edit_model->edit_action_staff_conveyance();

			if ($id==404) {
				$Message = 'NotOK';
			} else {
				  $Message = 'OK';
			}
		}
		else {
            $text[] = "Session out, login required";
        }
		
        $var['csrf_token'] = $csrf_token;
        $var['Message'] = $Message;
        $var['id'] = $id;
        echo json_encode($var);
    }

	//  Court Entertainment

	function court_entertainment($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{

		$operation = 'bill_data_edit/court_entertainment';
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'operation'=>$operation,
					'paper_vendor' => $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
					'staff_grid_conv' => $this->User_model->get_parameter_data('users_info','name','data_status = 1'),
					'staff' => $this->Bill_data_edit_model->get_staff(),
					'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
					'lawyer' => $this->user_model->get_parameter_data('ref_lawyer','id','data_status = 1'),
					'case_sts' => $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
					'sys_config'=> $this->User_info_model->upr_config_row(),
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'pages'=> 'bill_data_edit/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function court_entertainment_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_data_edit_model->court_entertainment_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function court_entertainment_form($id=NULL,$editrow=NULL,$option=NULL)
	{
        $result = $this->Bill_data_edit_model->get_edit_info_court_entertainment($id);



		$expense_activities = $this->User_model->get_parameter_data('ref_court_entertainment_activities','id','data_status = 1');

		$data = array(
					 'id' => $id,
                     'option'=>$option,
                     'result'=>$result,
                     'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1'),
                     'district' => $this->user_model->get_parameter_data('ref_legal_district','id','data_status = 1'),
					 'expense_activities'=>$expense_activities,
					 'pages'=> 'bill_data_edit/pages/form',
					 'editrow' => $editrow,
					 );
		$this->load->view('bill_data_edit/form_layout',$data);
	}
    function edit_action_court_entertainment()
    {

        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
		$Message = '';

        if ($this->session->userdata['ast_user']['login_status']) {
            $id = $this->Bill_data_edit_model->edit_action_court_entertainment();

			if ($id==404) {
				$Message = 'NotOK';
			} else {
				  $Message = 'OK';
			}
		}
		else {
            $text[] = "Session out, login required";
        }
		
        $var['csrf_token'] = $csrf_token;
        $var['Message'] = $Message;
        $var['id'] = $id;
        echo json_encode($var);
    }
	
    //  Others

	function others($menu_group,$menu_cat,$menu_links,$submenu=NULL)
	{


		$activities_grid = $this->User_model->get_parameter_data('ref_court_entertainment_activities','id','');


		$operation = 'bill_data_edit/others';
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'submenu'=> $submenu,
					'menu_links'=> $menu_links,
					'operation'=>$operation,
					'activities_grid' =>$activities_grid,
					'paper_vendor' => $this->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1'),
					'staff_grid_conv' => $this->User_model->get_parameter_data('users_info','name','data_status = 1'),
					'staff' => $this->Bill_data_edit_model->get_staff(),
					'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1 AND id in(1,2,3,4)'),
					'lawyer' => $this->user_model->get_parameter_data('ref_lawyer','id','data_status = 1'),
					'case_sts' => $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1'),
					'sys_config'=> $this->User_info_model->upr_config_row(),
					'req_type' => $this->User_model->get_parameter_data('ref_req_type','name','data_status = 1'),
					'pages'=> 'bill_data_edit/pages/grid',
			   		'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}
	function others_grid()
	{
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Bill_data_edit_model->others_grid($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);
		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}
	function others_form($id=NULL,$editrow=NULL,$option=NULL)
	{

        $result = $this->Bill_data_edit_model->get_edit_info_others($id);
		$expense_activities = $this->User_model->get_parameter_data('ref_court_entertainment_activities','id','');

		$data = array(
					 'id' => $id,
                     'option'=>$option,
                     'result'=>$result,
                         'legal_region' => $this->user_model->get_parameter_data('ref_legal_region','id','data_status = 1'),
                     'district' => $this->user_model->get_parameter_data('ref_legal_district','id','data_status = 1'),
					 'expense_activities'=>$expense_activities,
					 'pages'=> 'bill_data_edit/pages/form',
					 'editrow' => $editrow,
					 );
		$this->load->view('bill_data_edit/form_layout',$data);
	}
    function edit_action_others()
    {

        $csrf_token = $this->security->get_csrf_hash();
        $text = array();
		$Message = '';

        if ($this->session->userdata['ast_user']['login_status']) {
            $id = $this->Bill_data_edit_model->edit_action_others();

			if ($id==404) {
				$Message = 'NotOK';
			} else {
				  $Message = 'OK';
			}
		}
		else {
            $text[] = "Session out, login required";
        }
		
        $var['csrf_token'] = $csrf_token;
        $var['Message'] = $Message;
        $var['id'] = $id;
        echo json_encode($var);
    }


}
?>
