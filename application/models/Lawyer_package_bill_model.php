<?php
class Lawyer_package_bill_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
	}



	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   $where2 = "b.sts!='0'";  $filterdatafield2 =' ';	

	    
		if($this->input->get('loan_segment')!='' && $this->input->get('loan_segment')!='') 
		{$where2.=" AND b.protfolio = '".trim($this->input->get('loan_segment'))."'";}
		
		if($this->input->get('package_type')!='' && $this->input->get('package_type')!='') 
		{$where2.=" AND b.package_type = '".trim($this->input->get('package_type'))."'";}
	   	if($this->input->get('proposed_type')!='') 
        {$where2.=" AND b.proposed_type = '".trim($this->input->get('proposed_type'))."'";}

        if($this->input->get('case_number')!='') 
        {$where2.=" AND b.case_number = '".trim($this->input->get('case_number'))."'";}

        if($this->input->get('loan_ac')!='' && $this->input->get('proposed_type')!='') 
        {
            if ($this->input->get('proposed_type')=='Loan') {
                $where2.= " AND b.loan_ac='".$this->input->get('loan_ac')."'";
            }else if($this->input->get('proposed_type')=='Card')
            {
                $where2.= " AND b.org_loan_ac='".$this->Common_model->stringEncryption('encrypt',$this->input->get('hidden_loan_ac'))."'";
            }
        }
	   	if (isset($filterscount) && $filterscount > 0)
		{
			$where = "(";

			$tmpdatafield = "";
			$tmpfilteroperator = "";
			for ($i=0; $i < $filterscount; $i++)
			{//$where2.="(".$this->input->get('filterdatafield'.$i)." like '%".$this->input->get('filtervalue'.$i)."%')";

				// get the filter's value.
				$filtervalue = $this->input->get('filtervalue'.$i);
				// get the filter's condition.
				$filtercondition = $this->input->get('filtercondition'.$i);
				// get the filter's column.
				$filterdatafield = $this->input->get('filterdatafield'.$i);
				// get the filter's operator.
				$filteroperator = $this->input->get('filteroperator'.$i);

        		if($filterdatafield=='loan_ac')
				{
					$filterdatafield='b.loan_ac';
				}
				else if($filterdatafield=='loan_segment')
				{
					$filterdatafield='s.name';
				}
				else if($filterdatafield=='proposed_type')
				{
					$filterdatafield='b.proposed_type';
				}
				else if($filterdatafield=='package_type_name')
				{
					$filterdatafield='j8.name';
				}
				else if($filterdatafield=='req_type')
				{
					$filterdatafield='j7.name';
				}
				else if($filterdatafield=='loan_segment')
				{
					$filterdatafield='s.name';
				}
				else if($filterdatafield=='e_dt')
				{
					//$filterdatafield='b.e_dt';
					$filterdatafield = "DATE_FORMAT(b.e_dt,'%d-%b-%y %h:%i %p')";
				}
				else if($filterdatafield=='v_dt')
				{
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(b.v_dt,'%d-%b-%y %h:%i %p')";
				}
				else if($filterdatafield=='status')
				{
					$filterdatafield='j6.name';
				}

				if ($tmpdatafield == "")
				{
					$tmpdatafield = $filterdatafield;
				}
				else if ($tmpdatafield <> $filterdatafield)
				{
					$where .= ")AND(";
				}
				else if ($tmpdatafield == $filterdatafield)
				{
					if ($tmpfilteroperator == 0)
					{
						$where .= " AND ";
					}
					else $where .= " OR ";
				}

				// build the "WHERE" clause depending on the filter's condition, value and datafield.
				if($filterdatafield =='e_by')
				{
					$where .= " (j2.name LIKE '%".$filtervalue."%' OR j2.user_id LIKE '%".$filtervalue."%') ";
				}
				else if($filterdatafield =='stc_by')
				{
					$where .= " (j4.name LIKE '%".$filtervalue."%' OR j4.user_id LIKE '%".$filtervalue."%') ";
				}
				else if($filterdatafield =='v_by')
				{
					$where .= " (j10.name LIKE '%".$filtervalue."%' OR j10.user_id LIKE '%".$filtervalue."%') ";
				}
				else{
					switch($filtercondition)
					{
						case "CONTAINS":
							$where .= " ".$filterdatafield . " LIKE '%" . $filtervalue ."%'";
							break;
						case "DOES_NOT_CONTAIN":
							$where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
							break;
						case "EQUAL":
							$where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
							break;
						case "NOT_EQUAL":
							$where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
							break;
						case "GREATER_THAN":
							$where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
							break;
						case "LESS_THAN":
							$where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
							break;
						case "GREATER_THAN_OR_EQUAL":
							$where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
							break;
						case "LESS_THAN_OR_EQUAL":
							$where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
							break;
						case "STARTS_WITH":
							$where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
							break;
						case "ENDS_WITH":
							$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
							break;
					}
				}

				if ($i == $filterscount - 1)
				{
					$where .= ")";

				}

				$tmpfilteroperator = $filteroperator;
				$tmpdatafield = $filterdatafield;

			}
			// build the query.
		}else{$where=array();}
		if ($sortorder == '')
		{
			$sortdatafield="b.id";
			$sortorder = "DESC";	
			
		}
	    $this->db
	    ->select('SQL_CALC_FOUND_ROWS b.id,j6.name as status,
	    	b.loan_ac,CONCAT(j2.name," (",j2.user_id,")")as e_by,
	    	DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,j8.name as package_type_name,
	    	CONCAT(j4.name," (",j4.user_id,")")as stc_by,
	    	CONCAT(j10.name," (",j10.user_id,")")as v_by,
	    	DATE_FORMAT(b.stc_dt,"%d-%b-%y %h:%i %p") AS stc_dt,
	    	DATE_FORMAT(b.v_dt,"%d-%b-%y %h:%i %p") AS v_dt,s.name as loan_segment,
	    	b.e_by as e_by_id,j7.name as req_type,b.proposed_type,b.v_sts,
	    	b.sts
	    	', FALSE)
				->from("lawyer_package_bill_setup b")
				->join('users_info as j2', 'b.e_by=j2.id', 'left')
				->join('users_info as j4', 'b.stc_by=j4.id', 'left')
				->join('ref_status as j6', 'b.v_sts=j6.id', 'left')
				->join('ref_req_type as j7', 'b.req_type=j7.id', 'left')
				->join('ref_package_type as j8', 'b.package_type=j8.id', 'left')
				->join('users_info as j10', 'b.v_by=j10.id', 'left')
				->join('ref_loan_segment as s', 'b.protfolio=s.code', 'left')
				->where($where)
				->where($where2)
				->order_by($sortdatafield,$sortorder)
				->limit($limit, $offset);
			$q=$this->db->get();

		$query = $this->db->query('SELECT FOUND_ROWS() AS Count');
		$objCount = $query->result_array();
		$result["TotalRows"] = $objCount[0]['Count'];

		if ($q->num_rows() > 0){
			$result["Rows"] = $q->result();
		} else {
			$result["Rows"] = array();
		}
		return $result;
	}
	function get_add_action_data($id)
	{
		$this->db
			->select("b.*", FALSE)
			->from("lawyer_package_bill_setup b")
			->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function get_file_name($field_name,$path)
	{
		//Deleteng old file when no new file selected
		if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='0') 
		{
			$delete_path = $path.$_POST['hidden_'.$field_name.'_value'];	
		    if (file_exists($delete_path)) {
		    	unlink($delete_path);	
		    }
            
            $file ="";
		}//Deleteng old file and new file selected
		else if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='1') 
		{
			$delete_path = $path.$_POST['hidden_'.$field_name.'_value'];	
		    if (file_exists($delete_path)) {
            	unlink($delete_path);	
		    }
            $file = $this->Common_model->get_file_name('package',$field_name,$path);
		}//Taking Old File
		else if (isset($_POST['hidden_'.$field_name.'_value']) && $_POST['hidden_'.$field_name.'_select']=='0') 
		{
			$file = $_POST['hidden_'.$field_name.'_value'];
		}//Taking Full New File
		else
		{
			$file = $this->Common_model->get_file_name('package',$field_name,$path);
		}
		return $file;
	}
	function add_edit_action($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start
        if($editrow==""){$editrow=0;}
	    
		$package_approval_file = $this->get_file_name('package_approval_file','package_approval_file/');
	    
	    $data = array(
			'proposed_type' =>$this->security->xss_clean( $this->input->post('proposed_type')),
			'req_type' =>$this->security->xss_clean( $this->input->post('req_type')),
			'package_type' =>$this->security->xss_clean( $this->input->post('package_type')),
			'lawyer' =>$this->security->xss_clean( $this->input->post('lawyer')),
			'case_number' =>$this->security->xss_clean( $this->input->post('case_number')),
			'protfolio' =>$this->security->xss_clean( $this->input->post('protfolio')),
			'package_amount' =>$this->security->xss_clean( $this->input->post('package_amount')),
			'protfolio' =>$this->security->xss_clean( $this->input->post('protfolio')),
			'package_approval_file' =>$package_approval_file
		);
	    //'subscription_date'=>implode('-',array_reverse(explode('/',$this->input->post('subscription_date')))),
		if($add_edit=="add")
		{
			if ($_POST['proposed_type']=='Card') 
			{
				$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$this->input->post('hidden_loan_ac')); 
				$data['customer_id'] = $this->security->xss_clean( $this->input->post('hidden_customer_id'));
			}
			else{$org_loan_ac='';}
			$data['loan_ac'] = $this->security->xss_clean($this->input->post('loan_ac'));
			$data['org_loan_ac'] = $org_loan_ac;
			$data['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$data['e_dt'] = date('Y-m-d H:i:s');
			$data['v_sts'] = 1;
			$this->db->insert('lawyer_package_bill_setup', $data);
			$insert_idss = $this->db->insert_id();
			if($insert_idss==0)
			{
				$this->db->trans_rollback();
				$this->db->db_debug = $db_debug;
				return '01';		
			}
			$data2 = $this->user_model->user_activities_bill(1,'lawyer_package',$insert_idss,'lawyer_package_bill_setup','Initiate Package Bill('.$insert_idss.')');
		}
		else
		{
	  		$data['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$data['u_dt'] = date('Y-m-d H:i:s');
			$data['v_sts'] = 35;
			$this->db->where('id', $edit_id);
			$this->db->update('lawyer_package_bill_setup', $data);
			$insert_idss = $edit_id;
			if($this->db->affected_rows()==0)
			{
				$this->db->trans_rollback();
				$this->db->db_debug = $db_debug;
				return '00';		
			}
	        $data2 = $this->user_model->user_activities_bill(35,'lawyer_package',$insert_idss,'lawyer_package_bill_setup','Update Package Bill('.$insert_idss.')');
		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return '03';
		}
		else
		{
			$this->db->trans_commit();
			return $insert_idss;
		}


	}
	function get_info($add_edit,$id) // get data for edit
	{
		if($id!=''){
			$this->db
			->select("j0.*", FALSE)
			->from('lawyer_package_bill_setup as j0')
			->where("j0.id='".$id."'",NULL,FALSE)
			->limit(1);
			return  $this->db->get()->row();
		}
		else{return NULL;}
	}
	function get_recommend_info($id) // get data for edit
	{
		if($id!=''){
			$this->db
			->select("j0.*,j0.v_sts as sts,j15.name as status,
				j26.name as lawyer_name,p.name as package_type_name,
				j7.name as loan_segment,
				CONCAT(j8.name,' (',j8.pin,')') as e_by,
				CONCAT(j3.name,' (',j3.pin,')') as enhance_by,
				CONCAT(j9.name,' (',j9.pin,')') as stc_by,
				CONCAT(j22.name,' (',j22.pin,')') as v_by,
				DATE_FORMAT(j0.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,
				r.name as req_type_name,
				DATE_FORMAT(j0.stc_dt,'%d-%b-%y %h:%i %p') AS stc_dt,
				DATE_FORMAT(j0.v_dt,'%d-%b-%y %h:%i %p') AS v_dt", FALSE)
			->from('lawyer_package_bill_setup as j0')
			->join('ref_req_type as r', 'j0.req_type=r.id', 'left')
			->join('ref_package_type as p', 'j0.package_type=p.id', 'left')
			->join("ref_loan_segment as j7", "j0.protfolio=j7.code", "left")
			->join("users_info as j8", "j0.e_by=j8.id", "left")
			->join("users_info as j9", "j0.stc_by=j9.id", "left")
			->join("ref_status as j15", "j0.v_sts=j15.id", "left")
			->join("users_info as j22", "j0.v_by=j22.id", "left")
			->join("users_info as j3", "j0.enhance_by=j3.id", "left")
			->join("ref_lawyer as j26", "j0.lawyer=j26.id", "left")
			->where("j0.id='".$id."'",NULL,FALSE)
			->limit(1);
			return  $this->db->get()->row();
		}
		else{return NULL;}
	}
	function get_r_history($id,$type=Null) // get data for edit
	{
		if($id!=''){
			if ($type=='life_cycle') {
				$where='';
			}
			else
			{
				$where="AND(r.activities_id=7 || r.activities_id=4 || r.activities_id=5 || r.activities_id=8 || r.activities_id=9 || r.activities_id=11 || r.activities_id=12)";
			}
			$str=" SELECT r.description_activities as oprs_descriptions,r.oprs_reason,s.name as oprs_sts,DATE_FORMAT(r.activities_datetime,'%d-%b-%y %h:%i %p') AS oprs_dt,CONCAT(u.name,' (',u.user_id,')') as r_by
			FROM user_activities_bill as r
			LEFT OUTER JOIN users_info u ON u.id=r.activities_by
			LEFT OUTER JOIN ref_status s ON s.id=r.activities_id
			WHERE r.table_row_id= ".$this->db->escape($id)." AND r.section_name='lawyer_package'  ".$where."  ORDER BY r.id ASC";
			$query=$this->db->query($str);
			return $query->result();
		}
		else{return NULL;}
	}
	function delete_action()
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start

		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('lawyer_package_bill_setup',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('d_reason'=>trim($_POST['comments']),	'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('lawyer_package_bill_setup', $data);
				$data2 = $this->user_model->user_activities_bill(15,'lawyer_package',$this->input->post('deleteEventId'),'lawyer_package_bill_setup','Delete Package('.$this->input->post('deleteEventId').')',$_POST['comments']);
			}
			
		}
		if($this->input->post('type')=='sendtochecker'){
			$pre_action_result=$this->Common_model->get_pre_action_data('lawyer_package_bill_setup',$_POST['deleteEventId'],2,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts' => '10', 'stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('lawyer_package_bill_setup', $data);
				$data2 = $this->user_model->user_activities_bill(10,'lawyer_package',$this->input->post('deleteEventId'),'lawyer_package_bill_setup','Send To Checker Package('.$this->input->post('deleteEventId').')');
			}
			
		}
		if($this->input->post('type')=='verify'){
			$pre_action_result=$this->Common_model->get_pre_action_data('lawyer_package_bill_setup',$_POST['deleteEventId'],'11,12,13','v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts' => 13,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('lawyer_package_bill_setup', $data);
				$data2 = $this->user_model->user_activities_bill(13,'lawyer_package',$this->input->post('deleteEventId'),'lawyer_package_bill_setup','Verify Package('.$this->input->post('deleteEventId').')');
			}
			
		}
		if($this->input->post('type')=='verify_enhance'){
			$pre_action_result=$this->Common_model->get_pre_action_data('lawyer_package_bill_setup',$_POST['deleteEventId'],'11,12,13','v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$str="SELECT  j0.v_sts,j0.inhanced_amount,j0.change_history_id
                             FROM lawyer_package_bill_setup j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                
            	$application_data=$this->db->query($str)->row();
				$data = array('v_sts' => 13,'disbursed_sts' => 0,'package_amount' => $application_data->inhanced_amount,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('lawyer_package_bill_setup', $data);

				$data = array('sts' =>13,'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
	            $this->db->where('id', $application_data->change_history_id);
	            $this->db->update('lawyer_package_enhance_history', $data);

				$data2 = $this->user_model->user_activities_bill(13,'lawyer_package',$this->input->post('deleteEventId'),'lawyer_package_bill_setup','Verify Package Enhancement('.$this->input->post('deleteEventId').')');
			}
			
		}
		if($this->input->post('type')=='reject'){
			$pre_action_result=$this->Common_model->get_pre_action_data('lawyer_package_bill_setup',$_POST['deleteEventId'],'11,12,13','v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts' => 12,'reject_reason'=>trim($_POST['reason']),'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('lawyer_package_bill_setup', $data);
				

				$data2 = $this->user_model->user_activities_bill(12,'lawyer_package',$this->input->post('deleteEventId'),'lawyer_package_bill_setup','Reject Package('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
			
		}
		if($this->input->post('type')=='reject_enhance'){
			$pre_action_result=$this->Common_model->get_pre_action_data('lawyer_package_bill_setup',$_POST['deleteEventId'],'11,12,13','v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$str="SELECT  j0.v_sts,j0.inhanced_amount,j0.change_history_id
                             FROM lawyer_package_bill_setup j0
                         WHERE j0.id= '".$this->input->post('deleteEventId')."' LIMIT 1";
                         
            	$application_data=$this->db->query($str)->row();

				$data = array('v_sts' => 13,'inhanced_amount' => '');
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('lawyer_package_bill_setup', $data);
				
				$data = array('sts' =>12,'reject_by'=> $this->session->userdata['ast_user']['user_id'], 'reject_dt'=>date('Y-m-d H:i:s'),'reject_reason'=>$_POST['reason']);
	            $this->db->where('id', $application_data->change_history_id);
	            $this->db->update('lawyer_package_enhance_history', $data);

				$data2 = $this->user_model->user_activities_bill(12,'lawyer_package',$this->input->post('deleteEventId'),'lawyer_package_bill_setup','Reject Package Enhancement('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
			
		}
		if($this->input->post('type')=='return'){
			$pre_action_result=$this->Common_model->get_pre_action_data('lawyer_package_bill_setup',$_POST['deleteEventId'],'11,12,13','v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts' => 11,'return_reason'=>trim($_POST['reason']),'return_by'=> $this->session->userdata['ast_user']['user_id'], 'return_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('lawyer_package_bill_setup', $data);
				
				$data2 = $this->user_model->user_activities_bill(11,'lawyer_package',$this->input->post('deleteEventId'),'lawyer_package_bill_setup','Return Package('.$this->input->post('deleteEventId').')',$_POST['reason']);
			}
		}
		if($this->input->post('type')=='enableenhance'){
			$pre_action_result=$this->Common_model->get_pre_action_data('lawyer_package_bill_setup',$_POST['deleteEventId'],99,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$data = array('v_sts' => '99', 'enhance_enable_by'=> $this->session->userdata['ast_user']['user_id'], 'enhance_enable_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('lawyer_package_bill_setup', $data);
				$data2 = $this->user_model->user_activities_bill(99,'lawyer_package',$this->input->post('deleteEventId'),'lawyer_package_bill_setup','Enabled Package for enhancement ('.$this->input->post('deleteEventId').')');
			}
			
		}
		if($this->input->post('type')=='enhance'){
			$pre_action_result=$this->Common_model->get_pre_action_data('lawyer_package_bill_setup',$_POST['deleteEventId'],100,'v_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
				$enhance_file = $this->get_file_name('package_approval_file','package_approval_file/');
				
				$data = array(
					'event_id' =>$_POST['deleteEventId'],
					'pre_amount' =>$_POST['pre_package_amount'],
					'new_amount' =>$_POST['new_amount'],
					'reason' =>$_POST['enhance_comments'],
					'file' =>$enhance_file,
					'e_by' =>$this->session->userdata['ast_user']['user_id'],
					'e_dt' =>date('Y-m-d H:i:s'),
					'sts' =>100
				);
				$this->db->insert('lawyer_package_enhance_history', $data);
				$insert_idss = $this->db->insert_id();
				$data = array('v_sts' => '100','change_history_id' => $insert_idss,'enhance_file' => $enhance_file,'inhanced_amount' => $_POST['new_amount'],'inhanced_amount' => $_POST['new_amount'],'enhance_reason' => $_POST['enhance_comments'], 'enhance_by'=> $this->session->userdata['ast_user']['user_id'], 'enhance_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $_POST['deleteEventId']);
				$this->db->update('lawyer_package_bill_setup', $data);
				$data2 = $this->user_model->user_activities_bill(100,'lawyer_package',$this->input->post('deleteEventId'),'lawyer_package_bill_setup','Enhance Package ('.$this->input->post('deleteEventId').')',$_POST['enhance_comments']);
			}
			
		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->db->db_debug = $db_debug;
			return 0;
		}
		else {
			$this->db->trans_commit();
			$this->db->db_debug = $db_debug;
			return $_POST['deleteEventId'];
		}
	}
}
?>
