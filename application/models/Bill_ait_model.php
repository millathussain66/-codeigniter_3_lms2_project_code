<?php
class Bill_ait_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
	}



	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;

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
					$filterdatafield='b.request_date';
				}
				else if($filterdatafield=='inform_date')
				{
					$filterdatafield='b.inform_date';
				}
				else if($filterdatafield=='certificate_rec_dt')
				{
					$filterdatafield='b.certificate_rec_dt';
				}
				else if($filterdatafield=='certificate_sts')
				{
					$filterdatafield='b.certificate_sts';
				}
				else if($filterdatafield=='remarks')
				{
					$filterdatafield='b.remarks';
				}else if($filterdatafield=='request_name')
				{
					$filterdatafield='e.name';
				}else if($filterdatafield=='certificate_name')
				{
					$filterdatafield='c.name';
				}else if($filterdatafield=='venlaw_name')
				{
					
				}else if($filterdatafield=='status_name')
				{
					$filterdatafield='s.name';
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
				}else{
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
    	DATE(b.certificate_sts) as certificate_sts,s.name as status_name
    	', FALSE)
			->from("ait_vat b")
			->join('ref_status s', 's.id=b.stc_sts', 'left')
			->join('ref_lawyer l', 'l.id=b.vendor_id', 'left')
			->join('ref_paper_vendor v', 'v.id=b.vendor_id', 'left')
			->join('ref_certificate_type c', 'c.id=b.certificate_type', 'left')
			->join('ref_expense_type e', 'e.id=b.request_from', 'left')
			->where("b.sts<>'0' and b.stc_sts=10".$where_initi, NULL, FALSE)
			->where($where)
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
	function get_grid2_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;

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
					$filterdatafield='b.request_date';
				}
				else if($filterdatafield=='inform_date')
				{
					$filterdatafield='b.inform_date';
				}
				else if($filterdatafield=='certificate_rec_dt')
				{
					$filterdatafield='b.certificate_rec_dt';
				}
				else if($filterdatafield=='certificate_sts')
				{
					$filterdatafield='b.certificate_sts';
				}else if($filterdatafield=='request_name')
				{
					$filterdatafield='e.name';
				}else if($filterdatafield=='certificate_name')
				{
					$filterdatafield='c.name';
				}
				else if($filterdatafield=='remarks')
				{
					$filterdatafield='b.remarks';
				}else if($filterdatafield=='status_name')
				{
					$filterdatafield='s.name';
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
				else if($filterdatafield=='venlaw_name')
				{
					
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
				}else{
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
    	DATE(b.certificate_sts) as certificate_sts,s.name as status_name
    	', FALSE)
			->from("ait_vat b")
			->join('ref_status s', 's.id=b.stc_sts', 'left')
			->join('ref_lawyer l', 'l.id=b.vendor_id', 'left')
			->join('ref_paper_vendor v', 'v.id=b.vendor_id', 'left')
			->join('ref_certificate_type c', 'c.id=b.certificate_type', 'left')
			->join('ref_expense_type e', 'e.id=b.request_from', 'left')
			->where_in('b.stc_sts', array(6,70,71,96))
			->where("b.sts<>'0'".$where_initi, NULL, FALSE)
			->where($where)
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
	    if(isset($_FILES['certificate_file']['name']))
		{				
			$certificate_file = $this->file_upload('certificate_file',$this->input->post('certificate_file'));																		
		}
		else
		{
			$certificate_file = $_POST['hidden_certificate_file'];
		}
	    //AIT & VAT Data
	    $ait_vat_data = array(
			'certificate_type' =>$this->security->xss_clean( $this->input->post('certificate_type')),
			'request_from' =>$this->security->xss_clean( $this->input->post('request_from')),
			'request_date' =>implode('-',array_reverse(explode('/',$this->input->post('request_date')))),
			'inform_date' =>implode('-',array_reverse(explode('/',$this->input->post('inform_date')))),
			'certificate_rec_dt' =>implode('-',array_reverse(explode('/',$this->input->post('certificate_rec_dt')))),
			'certificate_sts' =>implode('-',array_reverse(explode('/',$this->input->post('certificate_sts')))),
			'certificate_file' =>$certificate_file,
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),

		);
		if($add_edit=="add")
		{
			$ait_vat_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$ait_vat_data['e_dt'] = date('Y-m-d H:i:s');
			$this->db->insert('ait_vat', $ait_vat_data);
			$insert_idss = $this->db->insert_id();

		    $activities_id = $this->Ait_vat_model->activities_id("Add");
		    $activities_id = $activities_id[0]->id;
		    $description_activities = 'Add AIT & VAT Info - ';
		}
		else
		{
	  		$ait_vat_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$ait_vat_data['u_dt'] = date('Y-m-d H:i:s');
			$this->db->where('id', $edit_id);
			$this->db->update('ait_vat', $ait_vat_data);
	  		$insert_idss = $edit_id;

	        $activities_id = $this->Ait_vat_model->activities_id("Edit");
	        $activities_id = $activities_id[0]->id;
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
      		$this->User_model->user_activities($activities_id,$table_row_id,$table_name,$description_activities,$activities_by,$operate_user_id);
			// echo $insert_idss;
			// exit;
			return $insert_idss;
		}


	}
	function get_info($add_edit,$id) // get data for edit
	{
		if($id!=''){
			$this->db
			->select("j0.*", FALSE)
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
		$ary=explode(',',$this->input->post('eventid'));

		if($this->input->post('typec')=='delete'){
			$data = array('d_reason'=>trim($_POST['comments']),	'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['eventid']);
			$this->db->update('ait_vat', $data);
			$data2 = $this->user_model->user_activities_bill(6,$this->input->post('eventid'),'ait_vat','Delete AIT & VAT('.$this->input->post('eventid').')');
		}
		for($k=0; $k<count($ary); $k++)
		{
			if($this->input->post('typec')=='acknowledgment'){
				$data = array('stc_sts' => 6, 'ack_head_by'=> $this->session->userdata['ast_user']['user_id'], 'ack_head_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $ary[$k]);
				$this->db->update('ait_vat', $data);

				$str="SELECT  j0.id,j0.e_by,j0.vendor_id,j0.request_from,IF(j0.request_from=1,l.email,p.email) as vendor_email,IF(j0.request_from=1,l.mobile,p.mobile) as vendor_mobile,IF(j0.request_from=1,l.name,p.name) as vendor_name
                                 FROM ait_vat j0
                                LEFT OUTER JOIN ref_lawyer l on (l.id=j0.vendor_id AND j0.request_from=1)
                                LEFT OUTER JOIN ref_paper_vendor p on (p.id=j0.vendor_id AND j0.request_from=2)
                             WHERE j0.id= '".$ary[$k]."' LIMIT 1";
                             
                $bill_data=$this->db->query($str)->row();
                $subject="AIT/VAT certificate Received";
                //send mobile sms for lawyer professional bill
                if($bill_data->request_from==1 && $bill_data->vendor_mobile!='' && $bill_data->vendor_mobile!=NULL)
                {
                    $message = 'Lawyer’s Application copy received from '.$bill_data->vendor_name.' for AIT/VAT certificate purpose';
                    $sms = $this->user_model->send_sms($message,$bill_data->vendor_mobile,'ait_vat',$ary[$k],$bill_data->vendor_id);
                	$m=$this->User_model->send_email("", "", $bill_data->vendor_email,"", $subject,$message);
                }
                if($bill_data->request_from==2 && $bill_data->vendor_mobile!='' && $bill_data->vendor_mobile!=NULL)
                {
                    $message = 'Vendor Application copy received from '.$bill_data->vendor_name.' for AIT/VAT certificate purpose';
                    $sms = $this->user_model->send_sms($message,$bill_data->vendor_mobile,'ait_vat',$ary[$k],$bill_data->vendor_id);
                	$m=$this->User_model->send_email("", "", $bill_data->vendor_email,"", $subject,$message);
                }

				$this->User_model->user_activities_bill(6,'ait_vat',$ary[$k],'ait_vat','Acknowledgement By HO AIT & VAT('.$ary[$k].')');
				
				$subject = "Lawyer’s or Vendor Application copy received from Lawyer/Vendor for AIT/VAT certificate purpose.";
	        	$url=base_url()."ait_vat/details";
	        	$data2 = $this->Common_model->push_notification_data($subject,$url,'ait_vat',$ary[$k],date('Y-m-d'),'',$bill_data->e_by,'1');
			}
			if($this->input->post('typec')=='Send to Finance'){
				//print_r($this->input->post('email'));
				$data = array('stc_sts' => 70, 'send_fi_by'=> $this->session->userdata['ast_user']['user_id'], 'send_fi_dt'=>date('Y-m-d H:i:s'));
				$this->db->where('id', $ary[$k]);
				$this->db->update('ait_vat', $data);
				$subject='AIT & VAT Certificate';
				$message='Message';
				// Email Send
				//$m=$this->User_model->send_email("", "", $this->input->post('email'),"", $subject,$message);
				$this->User_model->user_activities_bill(70,'ait_vat',$ary[$k],'ait_vat','Send To Finance AIT & VAT('.$ary[$k].')');
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
			return $_POST['eventid'];
		}
	}

}
?>
