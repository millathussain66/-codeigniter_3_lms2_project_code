<?php
class Doc_upload_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', '', TRUE);
	}



	function get_grid_data($filterscount,$sortdatafield,$sortorder,$limit, $offset)
	{
	   	$i=0;
	   	$where2 = "b.sts!='0'";
	   	if($this->input->get('doc_type')!='') 
		{$where2.=" AND b.document_type = ".$this->db->escape(trim($this->input->get('doc_type')));}

		if($this->input->get('document_name')!='') 
		{$where2.=" AND b.document_name LIKE '%".trim($this->input->get('document_name'))."%'";}

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

        	if($filterdatafield=='e_dt')
				{
					$filterdatafield='b.e_dt';
				}
				else if($filterdatafield=='doc_type')
				{
					$filterdatafield='c.name';
				}
				else if($filterdatafield=='e_name')
				{
					$filterdatafield='u.name';
				}
				else if($filterdatafield=='remarks')
				{
					$filterdatafield='b.remarks';
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

				if ($i == $filterscount - 1)
				{
					$where .= ")";

				}

				$tmpfilteroperator = $filteroperator;
				$tmpdatafield = $filterdatafield;

			}
			// build the query.
		}else{$where=array();}
		//if($where=='' || count($where)<=0){	
		// if($where=='' ){			
		// 	$where_initi.=" and date(b.e_dt)='".date('Y-m-d')."' ";
		// }
		
		if ($sortorder == '')
		{
			$sortdatafield="b.id";
			$sortorder = "DESC";				
		}
		//concat(u.name ,u.user_id)
    $this->db
    ->select('SQL_CALC_FOUND_ROWS b.*,DATE(b.e_dt) as e_dt,c.name as doc_type,concat(u.name) as e_name', FALSE)
			->from("document_upload b")
			->join('ref_document_type as c', 'b.document_type=c.id', 'left')
			->join('users_info as u', 'b.e_by=u.id', 'left')
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
				$file_name_new='Doc_Files_'.$this->session->userdata['ast_user']['user_id'].'_'.rand().'.'.$extension;								
			}
			if($file_name_new!='' && $image==true)
			{
				if(($file_Size >0))
				{
						$copied = copy($_FILES[$input_name]['tmp_name'], 'doc_files/'.$file_name_new);
						if($_POST['hidden_'.$input_name]!=''){unlink("doc_files/".$_POST['hidden_'.$input_name]);}				
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
			->select("b.*,,DATE(b.e_dt) as e_dt,c.name as doc_type", FALSE)
			->from("document_upload b")
			->join('ref_document_type as c', 'b.document_type=c.id', 'left')
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
	    if(isset($_FILES['doc_file']['name']))
		{				
			$doc_file = $this->file_upload('doc_file',$this->input->post('doc_file'));																		
		}
		else
		{
			$doc_file = $_POST['hidden_doc_file'];
		}
	    //Document Data
	    $doc_upload_data = array(
			'document_type' =>$this->security->xss_clean( $this->input->post('document_type')),
			'document_name' =>$this->security->xss_clean( $this->input->post('doc_name')),
			'doc_file' =>$doc_file,
			'remarks' =>$this->security->xss_clean( $this->input->post('remarks')),

		);
		if($add_edit=="add")
		{
			$doc_upload_data['e_by'] = $this->session->userdata['ast_user']['user_id'];
			$doc_upload_data['e_dt'] = date('Y-m-d H:i:s');
			$this->db->insert('document_upload', $doc_upload_data);
			$insert_idss = $this->db->insert_id();
			$data2 = $this->user_model->user_activities(39,'',$insert_idss,'document_upload','Add Document('.$insert_idss.')','', $this->session->userdata['ast_user']['user_id'], $this->security->xss_clean( $this->input->post('doc_name')));
		    
		}
		else
		{
	  		$doc_upload_data['u_by'] = $this->session->userdata['ast_user']['user_id'];
			$doc_upload_data['u_dt'] = date('Y-m-d H:i:s');
			$this->db->where('id', $edit_id);
			$this->db->update('document_upload', $doc_upload_data);
	  		$insert_idss = $edit_id;

	        $data2 = $this->user_model->user_activities(35,'',$insert_idss,'document_upload','Edit Document('.$insert_idss.')','', $this->session->userdata['ast_user']['user_id'], $this->security->xss_clean( $this->input->post('doc_name')));
			
		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return 00;
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
			->from('document_upload as j0')
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
			$data = array('d_reason'=>trim($_POST['comments']),	'sts' => 0, 'd_by'=> $this->session->userdata['ast_user']['user_id'], 'd_dt'=>date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('document_upload', $data);
			$data2 = $this->user_model->user_activities(15,'',$this->input->post('deleteEventId'),'document_upload','Delete Document('.$this->input->post('deleteEventId').')',trim($_POST['comments']), $this->session->userdata['ast_user']['user_id'], '');
			
		}
		if($this->input->post('type')=='sendtochecker'){
			$data = array('stc_sts' => 1, 'stc_by'=> $this->session->userdata['ast_user']['user_id'], 'stc_dt'=>date('Y-m-d H:i:s'),'checker_id' => $this->input->post('checker_to_notify'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('document_upload', $data);
			$data2 = $this->user_model->user_activities(37,'',$this->input->post('deleteEventId'),'document_upload','Sentochecker Document('.$this->input->post('deleteEventId').')','', $this->session->userdata['ast_user']['user_id'], '');
		}
		if($this->input->post('type')=='verify'){
			$data = array('v_sts' => 1, 'v_by'=> $this->session->userdata['ast_user']['user_id'], 'v_dt'=>date('Y-m-d H:i:s'));
			$this->db->where('id', $_POST['deleteEventId']);
			$this->db->update('document_upload', $data);
			$data2 = $this->user_model->user_activities(38,'',$this->input->post('deleteEventId'),'document_upload','Verify Document('.$this->input->post('deleteEventId').')','', $this->session->userdata['ast_user']['user_id'], '');
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
