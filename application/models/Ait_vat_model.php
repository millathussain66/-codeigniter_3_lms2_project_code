<?php
class Ait_vat_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
        $this->load->model('Common_model', '', TRUE);
	}



	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "b.sts<>'0'";

	   	$condition_array=array();
        if(check_group('1') || check_group('2'))
        {
            $where2 .=" AND (";
        }
        if (check_group('2')) //For Legal Maker
        {
        	array_push($condition_array,"b.e_by='".$this->session->userdata['ast_user']['user_id']."'");
        }
        if (check_group('1')) //For Legal Checker
        {
            array_push($condition_array,multi_selected_query_maker_2($this->session->userdata['ast_user']['legal_region'],'us.legal_region'));
        }
        if(check_group('1') || check_group('2'))
        {
        	$where2 .=implode(" OR ",$condition_array);
            $where2 .=") ";
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

        		if($filterdatafield=='request_date')
				{
					$filterdatafield = "DATE_FORMAT(b.request_date,'%d-%b-%y %h:%i %p')";
				}
				else if($filterdatafield=='receive_head_dt')
				{
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(b.receive_head_dt,'%d-%b-%y %h:%i %p')";
				}
				else if($filterdatafield=='send_fi_dt')
				{
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(b.send_fi_dt,'%d-%b-%y %h:%i %p')";
				}
				else if($filterdatafield=='e_dt')
				{
					//$filterdatafield='b.stc_dt';
					$filterdatafield = "DATE_FORMAT(b.e_dt,'%d-%b-%y %h:%i %p')";
				}
				else if($filterdatafield=='certificate_sts')
				{
					$filterdatafield='b.certificate_sts';
				}
				else if($filterdatafield=='request_name')
				{
					$filterdatafield='e.name';
				}else if($filterdatafield=='certificate_name')
				{
					$filterdatafield='c.name';
				}else if($filterdatafield=='remarks')
				{
					$filterdatafield='b.remarks';
				}
				else if($filterdatafield=='venlaw_name')
				{
					
				}else if($filterdatafield=='status_name')
				{
					$filterdatafield='s.name';
				}

				else{$filterdatafield='b.'.$filterdatafield;}

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
				if($filterdatafield =='venlaw_name')
				{
					$where .= " (b.vendor_name LIKE '%".$filtervalue."%' OR l.name LIKE '%".$filtervalue."%' OR v.name LIKE '%".$filtervalue."%') ";
				}
				else
				{
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
		$where_initi=''; 
		if($where=='' || count($where)<=0){			
			//$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		}
		
		if ($sortorder == '')
		{
			$sortdatafield="b.id";
			$sortorder = "DESC";				
		}
    	$this->db->select('SQL_CALC_FOUND_ROWS b.*,DATE_FORMAT(b.request_date,"%d-%b-%y %h:%i %p") AS request_date,if(b.request_from=1,l.name,if(b.request_from=2,v.name,b.vendor_name))as venlaw_name,c.name as certificate_name,e.name as request_name,
    	DATE_FORMAT(b.e_dt,"%d-%b-%y %h:%i %p") AS e_dt,
    	DATE_FORMAT(b.inform_date,"%d-%b-%y %h:%i %p") AS inform_date,
    	DATE_FORMAT(b.send_fi_dt,"%d-%b-%y %h:%i %p") AS send_fi_dt,
    	DATE_FORMAT(b.receive_head_dt,"%d-%b-%y %h:%i %p") AS receive_head_dt,
    	DATE_FORMAT(b.certificate_rec_dt,"%d-%b-%y %h:%i %p") AS certificate_rec_dt,
    	DATE(b.certificate_sts) as certificate_sts,s.name as status_name,
    	DATE_FORMAT(b.date_from,"%d-%m-%Y") AS date_from,
    	DATE_FORMAT(b.date_to,"%d-%m-%Y") AS date_to
    	', FALSE)
			->from("ait_vat b")
			->join('ref_status s', 's.id=b.stc_sts', 'left')
			->join('ref_lawyer l', 'l.id=b.vendor_id', 'left')
			->join('ref_paper_vendor v', 'v.id=b.vendor_id', 'left')
			->join('ref_certificate_type c', 'c.id=b.certificate_type', 'left')
			->join('users_info us', 'us.id=b.e_by', 'left')
			->join('ref_expense_type e', 'e.id=b.request_from', 'left')
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

	function activities_id($activity=NULL)
    {
	    $str = "SELECT a.id FROM user_activities_list a WHERE a.activities_name = '$activity'";
			$query=$this->db->query($str);
			return $query->result();

    }

 	function file_upload($input_name=NULL,$file=NULL)
	{
		
		$image = $_FILES[$input_name]['name'];
		$file_Size = $_FILES[$input_name]['size'];	
			if ($image)
			{	
				$filename = stripslashes($_FILES[$input_name]['name']);
				$i = strrpos($filename,".");
				if (!$i) {$text[]="Unknown Extention";}
				$l = strlen($filename) - $i;
				$extension = substr($filename,$i+1,$l);				
				$extension = strtolower($extension);					
				$file_name_new='Ait_VAT_files_'.$this->session->userdata['ast_user']['user_id'].'_'.rand().'.'.$extension;								
			}
			if($file_name_new!='' && $image==true)
			{
				if(($file_Size >0))
				{
						$copied = copy($_FILES[$input_name]['tmp_name'], 'ait_vat_files/'.$file_name_new);
						if($_POST['hidden_'.$input_name]!=''){unlink("ait_vat_files/".$_POST['hidden_'.$input_name]);}				
				}
				else{ 
						$text[]="Unknown Attached documents (AF) Extention";
				}
			}
		return  $file_name_new;
	}
	function get_add_action_data($id)
	{
		$this->db
			->select("b.*", FALSE)
			->from("ait_vat b")
			->where("b.sts='1' and b.id='".$id."'", NULL, FALSE)
			->limit(1);
		$data = $this->db->get()->row();
		//echo $this->db->last_query();
		return $data;
	}
	function add_edit_action($add_edit=NULL,$edit_id=NULL,$editrow=NULL)
	{
		$this->db->trans_begin();
        if($editrow==""){$editrow=0;}
	    $table_name = "ait_vat";
	    $table_row_id = $editrow+1;
	    $activities_datetime = date('Y-m-d H:i:s');
	    $activities_by = $this->session->userdata['ast_user']['user_id'];
	    $ip_address = $this->input->ip_address();
	    $operate_user_id = $this->session->userdata['ast_user']['user_full_id'];
	    $activities_id = "";
	    $description_activities = "";
	    
	    $app_file = $this->get_file_name('app_file','cma_file/bill_ait_vat/');

	    //AIT & VAT Data
	    $ait_vat_data = array(
			'certificate_type' =>$this->security->xss_clean( $this->input->post('certificate_type')),
			'request_from' =>$this->security->xss_clean( $this->input->post('request_from')),
			'vendor_id' =>$this->security->xss_clean( $this->input->post('v_name')),
			'vendor_name' =>$this->security->xss_clean( $this->input->post('oth_name')),
			'tin_number' =>$this->security->xss_clean( $this->input->post('tin_number')),
			'bin_number' =>$this->security->xss_clean( $this->input->post('bin_number')),
			'date_from' =>implode('-',array_reverse(explode('/',$this->input->post('FromDate')))),
			'date_to' =>implode('-',array_reverse(explode('/',$this->input->post('ToDate')))),
			'email' =>$this->security->xss_clean( $this->input->post('email')),
			'phone_number' =>$this->security->xss_clean( $this->input->post('phone_number')),
			'app_file' =>$app_file,

			//'request_date' =>implode('-',array_reverse(explode('/',$this->input->post('request_date')))),
			//'inform_date' =>implode('-',array_reverse(explode('/',$this->input->post('inform_date')))),
			//'certificate_rec_dt' =>implode('-',array_reverse(explode('/',$this->input->post('certificate_rec_dt')))),
			//'certificate_sts' =>implode('-',array_reverse(explode('/',$this->input->post('certificate_sts')))),
			//'certificate_file' =>$certificate_file,
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),

		);
		if($add_edit=="add")
		{
			$ait_vat_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$ait_vat_data['e_dt'] = date('Y-m-d H:i:s');
			$ait_vat_data['stc_sts'] = 39;
			$this->db->insert('ait_vat', $ait_vat_data);
			$insert_idss = $this->db->insert_id();

		    $activities_id = 39;
		    $description_activities = 'Add AIT & VAT Info - ';
		}
		else
		{
	  		$ait_vat_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$ait_vat_data['u_dt'] = date('Y-m-d H:i:s');
			$ait_vat_data['stc_sts'] = 35;
			$this->db->where('id', $edit_id);
			$this->db->update('ait_vat', $ait_vat_data);
	  		$insert_idss = $edit_id;

	        $activities_id = 35;
	        $description_activities = 'Edit AIT & VAT Info - ';

		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
		}
		else
		{
			$this->db->trans_commit();
      		$this->User_model->user_activities_bill($activities_id,'ait_vat',$insert_idss,$table_name,$description_activities);
			// echo $insert_idss;
			// exit;
			return $insert_idss;
		}


	}
	function get_info($id) // get data for edit
	{
		if($id!=''){
			$this->db
			->select("j0.*,date_format(j0.date_from,'%d/%m/%Y') as date_from, date_format(j0.date_to,'%d/%m/%Y') as date_to", FALSE)
			->from('ait_vat as j0')
			->where("j0.id='".$id."'",NULL,FALSE)
			->limit(1);
			return  $this->db->get()->row();
		}
		else{return NULL;}
	}
	function delete_action()
	{
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = false; // off display of db error
		$this->db->trans_begin(); // transaction start

		if($this->input->post('type')=='delete'){
			$pre_action_result=$this->Common_model->get_pre_action_data('ait_vat',$_POST['deleteEventId'],0,'sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
			$data = array('d_reason'=>trim($_POST['comments']),	'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('ait_vat', $data);
			$data2 = $this->user_model->user_activities_bill(6,'ait_vat',$this->input->post('deleteEventId'),'ait_vat','Delete AIT & VAT('.$this->input->post('deleteEventId').')');
			}
		}
		if($this->input->post('type')=='sendtoho'){
			$pre_action_result=$this->Common_model->get_pre_action_data('ait_vat',$_POST['deleteEventId'],10,'stc_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
			$data = array('stc_sts' => 10, 'send_head_by'=> $this->session->userdata['ast_user']['user_id'], 'send_head_dt'=>date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('ait_vat', $data);
			$this->User_model->user_activities_bill(10,'ait_vat',$this->input->post('deleteEventId'),'ait_vat','Sentochecker AIT & VAT('.$this->input->post('deleteEventId').')');
			}
		}
		if($this->input->post('type')=='sendtolegal'){
			$pre_action_result=$this->Common_model->get_pre_action_data('ait_vat',$_POST['deleteEventId'],96,'stc_sts');
			if (count($pre_action_result)>0) 
			{
				return 'taken';
			}
			else
			{
			if(isset($_POST['sendmail'])){
				$res = $this->db->query('select * from ait_vat where id='.$_POST['deleteEventId'].' AND sts<>0')->row();
				$email=implode(",",array_filter(explode(";",$res->email)));
				$attach_path='cma_file/bill_ait_vat/'.$res->certificate_file;
				$this->User_model->send_email('','', $email, '','AIT & VAT Certificate','AIT & VAT Certificate',$res->certificate_file,$attach_path);

			}

			$data = array('stc_sts' => 96, 'stl_by'=> $this->session->userdata['ast_user']['user_id'], 'stl_dt'=>date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('ait_vat', $data);
			$this->User_model->user_activities_bill(96,'ait_vat',$this->input->post('deleteEventId'),'ait_vat','Sentochecker AIT & VAT('.$this->input->post('deleteEventId').')');
			}
		}
		if($this->input->post('type')=='verify'){
			$data = array('v_sts' => 1, 'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('ait_vat', $data);
			$data2 = $this->user_model->user_activities_bill(7,$this->input->post('deleteEventId'),'ait_vat','Verify AIT & VAT('.$this->input->post('deleteEventId').')');
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
	function details($id){
		if($id!=''){
			$where = array('b.id'=>$id);
			$this->db->select('b.*,DATE(b.request_date) as request_date,if(b.request_from=1,l.name,if(b.request_from=2,v.name,b.vendor_name))as venlaw_name,c.name as certificate_name,e.name as request_name,
	    	DATE(b.inform_date) as inform_date,
    		DATE(b.send_fi_dt) as send_fi_dt,
    		DATE(b.receive_head_dt) as receive_head_dt,
	    	DATE(b.certificate_rec_dt) as certificate_rec_dt,
	    	DATE(b.certificate_sts) as certificate_sts,s.name as status_name,
	    	DATE_FORMAT(b.date_from,"%d-%m-%Y") AS date_from,
    		DATE_FORMAT(b.date_to,"%d-%m-%Y") AS date_to
	    	', FALSE)
				->from("ait_vat b")
				->join('ref_status s', 's.id=b.stc_sts', 'left')
				->join('ref_lawyer l', 'l.id=b.vendor_id', 'left')
				->join('ref_paper_vendor v', 'v.id=b.vendor_id', 'left')
				->join('ref_certificate_type c', 'c.id=b.certificate_type', 'left')
				->join('ref_expense_type e', 'e.id=b.request_from', 'left')
				->where($where)
				->limit(1);
			$q=$this->db->get();
			return $q->row();
		}else{
			return null;
		}
	}
	function history($id){
		if($id!=''){
			$where = array('b.table_row_id'=>$id,'b.table_name'=>'ait_vat');
			$this->db->select("b.*,s.name as status_name,u.name as user_name,
				DATE_FORMAT(b.activities_datetime,'%d-%b-%y %h:%i:%s') AS activities_datetime
	    	", FALSE)
				->from("user_activities_bill b")
				->join('ref_status s', 's.id=b.activities_id', 'left')
				->join('users_info u', 'u.id=b.activities_by', 'left')
				->where($where)
				->order_by('b.id','DESC');
			$q=$this->db->get();
			return $q->result();
		}else{
			return null;
		}
	}

	function get_file_name($field_name,$path)
    {

        //Deleteng old file when no new file selected
        if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='0') 
        {
            $delete_path = $path.$_POST['hidden_'.$field_name.'_value'];      
            //chmod($path, 0777);
            if(file_exists($delete_path)){
            unlink($delete_path);  
            } 
            $file ="";
        }//Deleteng old file and new file selected
        else if (isset($_POST['file_delete_value_'.$field_name]) && $_POST['file_delete_value_'.$field_name]=='1' && $_POST['hidden_'.$field_name.'_select']=='1') 
        {
            $delete_path = $path.$_POST['hidden_'.$field_name.'_value'];      
            //chmod($path, 0777);
            if(file_exists($delete_path)){
            	unlink($delete_path); 
            }              
            $file = $this->Common_model->get_file_name('cma',$field_name,$path);
        }//Taking Old File
        else if (isset($_POST['hidden_'.$field_name.'_value']) && $_POST['hidden_'.$field_name.'_select']=='0') 
        {
            $file = $_POST['hidden_'.$field_name.'_value'];
        }//Taking Full New File
        else
        {
            $file = $this->Common_model->get_file_name('cma',$field_name,$path);
        }
        return $file;
    }

}
?>
