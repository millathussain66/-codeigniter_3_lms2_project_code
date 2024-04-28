<?php
class Ref_data_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	}
	
	function get_grid_data($ref_name,$filterscount,$sortdatafield,$sortorder,$limit=NULL, $offset=NULL)
	{
	   	$i=0;
		
	   	if (isset($filterscount) && $filterscount > 0)
		{		
			$where = "(j0.data_status !='0' AND ";
			
			$tmpdatafield = "";
			$tmpfilteroperator = "";
			for ($i=0; $i < $filterscount; $i++)
			{
				// get the filter's value.
				$filtervalue = $this->input->get('filtervalue'.$i);
				// get the filter's condition.
				$filtercondition = $this->input->get('filtercondition'.$i);
				// get the filter's column.
				$filterdatafield = $this->input->get('filterdatafield'.$i);
				// get the filter's operator.
				$filteroperator = $this->input->get('filteroperator'.$i);
				
				
				//$data_field_name_part = trim(str_replace(range(0,9),'',$filterdatafield));
				$data_field_name_part = trim(str_replace(range('a','z'),'',$filterdatafield));
				preg_match_all('!\d+!', $filterdatafield, $matches);
				$count = implode('', $matches[0]);
				//print_r($matches[0]);
				//if($count==''){$count=0;}
				$qqq = $this->db->query("SELECT reference_field_type_id FROM reference_field_list WHERE reference_table_name='".$ref_name."'
				AND reference_field_name='".$data_field_name_part."' AND data_status =1")->row();
				if(is_object($qqq)){}else{$qqq=array();}

				if($data_field_name_part=='grpName')
				{
					$filterdatafield="j$count.name";
				}

				elseif(count($qqq) > 0 && $qqq->reference_field_type_id == 2)
				{
					$filterdatafield="j$count.name";
				}
				elseif($filterdatafield=='optionvalue')
				{
					$filterdatafield='j0.every_approval';
				}
				else
				{
					$filterdatafield='j0.'.$filterdatafield;
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
		}else{$where="j0.data_status !='0'";}
		
		$qqq2 = $this->db->query("SELECT reference_field_type_id FROM reference_field_list WHERE reference_table_name='".$ref_name."'
				AND reference_field_name='".$sortdatafield."' AND data_status =1")->row();
		
		if ($sortorder == '')
		{
			$sortdatafield="j0.id";
			$sortorder = "asc";				
		}
		
		elseif ($sortdatafield == 'grpname$count')
		{
			$sortdatafield="j$count.name";				
		}
		
		$str_variable = "";
		$str_join = "";
		
		$tab_data_result = $this->get_field_by_ref_name($ref_name);
		$count=1;
		foreach($tab_data_result as $tabrow)
		{
			if($tabrow->reference_input_type_id == 5)
			{
				$str_variable.=", GROUP_CONCAT(DISTINCT j".$count.".name) AS grpname".$count."";
				$str_join.="LEFT OUTER JOIN ".$tabrow->reference_name." AS j".$count." ON(FIND_IN_SET( j".$count.".id , j0.".$tabrow->reference_field_name." ))";
			}
			else if($tabrow->reference_input_type_id  == 2)
			{
				$str_variable.=", j".$count.".name AS ".$tabrow->reference_field_name."".$count."";
				$str_join.="LEFT OUTER JOIN ".$tabrow->reference_name." AS j".$count." ON(j".$count.".id=j0.".$tabrow->reference_field_name." )";

			}
            else if($tabrow->reference_input_type_id == 4)
			{
				$str_variable.=", IF(".$tabrow->reference_field_name."=1,'Yes','No') AS optionvalue";
			}

			//echo $tabrow->field_type."<br>" ;

			$count++;
		}
		
		$sql = 	"SELECT SQL_CALC_FOUND_ROWS j0.* ".$str_variable." 
		FROM ".$ref_name." AS j0 ".$str_join." 
		WHERE ".$where."  GROUP BY j0.id order by ".$sortdatafield." ".$sortorder;		

		//echo $sql; exit;

        if($limit !=NULL){
          $sql .=" LIMIT ".$limit;
        }
		if($offset != NULL){
			$sql .=" OFFSET ".$offset;
		}

		$q = $this->db->query($sql);
       
	    
	    //echo $this->db->last_query();
		//exit;

		$query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');

		
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
				$file_name_new='user_'.$this->session->userdata['ast_user']['user_id'].'_'.time().'_'.rand().'.'.$extension;								
			}
			if($file_name_new!='' && $image==true)
			{
				if(($file_Size >0))
				{
						$copied = copy($_FILES[$input_name]['tmp_name'], 'ref_tables_files/'.$file_name_new);
						//if($_POST['hidden_'.$input_name]!=''){unlink("user_profile_images/".$_POST['hidden_'.$input_name]);}				
				}
				else{ 
						$text[]="Unknown Attached documents (AF) Extention";
				}
			}
		return  $file_name_new;
	}

	function add_edit_action($add_edit=NULL,$ref_id=NULL)
	{
		$edit_id = $this->input->post('id');
		if($ref_id!='')
		{
			$tab_name = $this->Ref_data_model->get_table_name($ref_id);
			$result = $this->Ref_data_model->get_field_info($ref_id);

			// echo '<pre>'; print_r($result); exit;

			 foreach($result as $field)
			 {
				if($field->reference_input_type_id == 3)
				{
					$field_value = trim(preg_replace("/\r|\n|\r\n|\r\r/", " ", $this->input->post($field->reference_field_name)));
				}
				else if($field->reference_input_type_id == 5)
				{
					$temp = (array) $this->input->post($field->reference_field_name);
					$field_value = implode(",",$temp);
				}
				else if($field->reference_input_type_id == 7)
				{
					$picture='';
					if(isset($_FILES[$field->reference_field_name]['name']))
					{				
						$picture = $this->file_upload($field->reference_field_name,'');																		
					}
					else
					{
						if (isset($_POST['hidden_'.$field->reference_field_name])) {
							$picture = $_POST['hidden_'.$field->reference_field_name];
						}
						else
						{
							$picture='';	
						}
					}
					$field_value = $picture;
				}
				else
				{
                    if($field->reference_field_type_id == "4")
                    {
                        $field_value =  date('Y-m-d',strtotime(str_replace('/','-',$this->input->post($field->reference_field_name))));
                    }
					else 
					{ 
						$field_value =  preg_replace('/\s+/', ' ', trim($this->input->post($field->reference_field_name)));//$this->input->post($field->reference_field_name); 
					}
				}

				if($field->reference_unique_status=="1")
				{
			 		$num_rows = $this->Ref_data_model->duplicate_name($field->reference_field_name,$field_value,$edit_id,$tab_name);
					if($num_rows>0)
					{
						return "Duplicate ".$field->reference_field_caption;
					}
			 			
			 	}

			 	$data[$field->reference_field_name] = $field_value;

			 }

		}

		if($add_edit=="add")
		{
			//echo '<pre>'; print_r($data); exit;
			$data['e_by']=$this->session->userdata['ast_user']['user_id'];
			$data['entry_datetime']=date('Y-m-d H:i:s');
			$this->db->insert($tab_name, $data);
			$insert_idss = $this->db->insert_id();
			$edit_id = $insert_idss;
			$data2 = $this->user_model->user_activities(39,'',$edit_id,'ref tables','Add Ref Data','',$this->session->userdata['ast_user']['user_id'],'');
		}
		if($add_edit=="edit")
		{
			//echo '<pre>'; print_r($data); exit;
			$data['last_modified_by']=$this->session->userdata['ast_user']['user_id'];
			$data['last_modified_datetime']=date('Y-m-d H:i:s');
			$this->db->where('id', $edit_id);
			$this->db->update($tab_name, $data);
			
			$data2 = $this->user_model->user_activities(35,'',$edit_id,'ref tables','Edit Ref Data','',$this->session->userdata['ast_user']['user_id'],'');
		}

		return $edit_id;
	}

	function get_add_action_data($ref_id,$id)
	{
		$tab_name = $this->Ref_data_model->get_table_name($ref_id);
		$tab_data_result = $this->get_field_by_ref_name($tab_name);
		$str_variable = "";
		$str_join = "";

		$count=1;
		foreach($tab_data_result as $tabrow)
		{
			if($tabrow->reference_input_type_id == 2)
			{
				$str_variable.=", j".$count.".name AS ".$tabrow->reference_field_name.$count."";
				$str_join.="LEFT OUTER JOIN ".$tabrow->reference_name."  j".$count." ON(j".$count.".id=j0.".$tabrow->reference_field_name." )";
			}
			/*elseif($tabrow->reference_input_type_id == 4)
			{
				$str_variable.=", IF(".$tabrow->reference_field_name."=1,'Yes','No') AS optionvalue";
			}*/
			$count++;
		}


		$result = $this->db->query("SELECT j0.* ".$str_variable." FROM ".$tab_name." j0 ".$str_join."
		WHERE j0.data_status !='0' AND j0.id = ".$id);
		return  $result->row();
	}

	function delete_action(){
		$ary=explode(',',$this->input->post('deleteEventId'));
		$tab_name = $this->Ref_data_model->get_table_name($this->input->post('tab_id'));
		for($k=0; $k<count($ary); $k++)
		{
			if($this->input->post('type')=='delete'){
				$data = array('data_status' => 0,'delete_by'=> $this->session->userdata['ast_user']['user_id']);
				$this->db->set('delete_datetime',date('Y-m-d H:i:s'));
				$this->db->where('id', $ary[$k]);
				$this->db->update($tab_name, $data);
				$data2 = $this->user_model->user_activities(15,'',$ary[$k],'ref tables','Delete Ref Data','',$this->session->userdata['ast_user']['user_id'],'');
				return $ary[$k];
			}
		}
		
	}

	function get_row_data($ref_id=NULL,$editrow=NULL)
	{
   		$tab_name = $this->Ref_data_model->get_table_name($ref_id);
   		$query = $this->db->get_where($tab_name,array('ID'=>$editrow));
   		$result = $query->row_array();

	   	return $result;
	}

	function get_field_info($ref_id)
	{
		if($ref_id!=''){
			$tab_name = $this->Ref_data_model->get_table_name($ref_id);
		 	$query = $this->db->order_by('SORT_ORDER','ASC')->get_where('reference_field_list', array('reference_table_name' => $tab_name));
			//echo $this->db->last_query();
			return $query->result();
			
		}else{return array();}
	}

	function get_field_by_ref_name($tab_name)
	{
		if($tab_name!=''){

		 	$query = $this->db->get_where('reference_field_list', array('reference_table_name' => $tab_name));
			return $query->result();
		}else{return array();}
	}

	function get_table_name($ref_id)
	{
		$q1 = $this->db->query("SELECT * FROM reference_list WHERE id = ".$ref_id." and data_status=1 ");
		$r1 = $q1->result();
		return $r1[0]->reference_table_name;
	}
	function get_ref_data_by_name($ref_name)
	{
		$q1 = $this->db->query("SELECT * FROM reference_list WHERE reference_table_name = '".$ref_name."' and data_status=1 and add_from_others_sts=1 LIMIT 1");
		$r1 = $q1->row();
		return $r1;
	}

	function get_ref_table_data($list_ref_name)
	{
		$this->db->order_by('name');
		$this->db->where('data_status', '1');
		//$this->db->limit(300);
		$query = $this->db->get($list_ref_name);
		//echo $this->db->last_query();exit;
		return $query->result();
	}

	function duplicate_name($field,$val,$edit_id=NULL,$tab_name=NULL)
	{
		$where= $field."='".$val."' AND data_status ='1'";
		if($edit_id!=''){$where.=" AND id!='".$edit_id."' AND data_status ='1'";}
		$this->db->where($where, NULL, FALSE);
		$this->db->from($tab_name);
		$q=$this->db->get();
		//echo $this->db->last_query();
		return $q->num_rows();
	}

	function checkDuplicate($tab_name=NULL,$value=NULL,$field_name=NULL,$editid=NULL)
	{
		$where="";
		if($editid != ''){$where = " AND id<> ".$editid."";}
		$q=$this->db->query("SELECT * FROM ".$tab_name." WHERE ".$field_name." = '".urldecode($value)."' AND data_status ='1' ".$where."");
		//echo $this->db->last_query();
		return $q->num_rows();
	}
	function get_ref_table_right($ref_name,$operation)
	{
		
		$str = "SELECT j1.reference_name,j0.id FROM reference_list j1 
				LEFT JOIN users_right_ref_table j0 ON(j1.id=j0.reference_table_id)
				WHERE j0.data_status=1  AND j0.operation='".$operation."' AND j0.user_info_id='".$this->session->userdata['ast_user']['user_id']."' AND j1.reference_table_name='".$ref_name."'";
		$query=$this->db->query($str);
		 $result=$query->row();	
		 
		 return $result;
	}
	function get_parameter_name($ref_id)
	{
		$q1 = $this->db->query("SELECT * FROM reference_list WHERE id = ".$ref_id." and data_status=1 ");
		$r1 = $q1->result();
		return $r1[0]->reference_name;
	}
	function get_input_type($table_name, $column_name)
	{
		$this->db->where('reference_table_name', $table_name);
		$this->db->where('reference_field_name', $column_name);
		$this->db->from('reference_field_list');
		return $this->db->get()->row();
	}
	function get_join_data_by_column_value($table_name, $required_column_name, $check_column_name, $check_column_value)
	{
		$sql = "SELECT GROUP_CONCAT($required_column_name) as colvalues FROM $table_name WHERE $check_column_name IN ($check_column_value)";
		// echo $sql.'<br/>'; exit;
		$row = $this->db->query($sql)->row();
		//return $row->$required_column_name;
		return $row->colvalues;
	}
}
?>