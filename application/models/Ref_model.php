<?php
class Ref_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	}

	function dropdownvaluewithoutselect($tablename=NULL,$field=NULL)
	{
		$arry=array();
		$str="Select ID,$field from $tablename where DATA_STATUS='1' order by SORT_ORDER asc";
		$query=$this->db->query($str);
		foreach($query->result() as $row){ $arry[$row->ID]=$row->$field;}
		return  $arry;
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
				
				$filterdatafield='j0.'.$filterdatafield;
				
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

		if ($sortorder == '')
		{
			$sortdatafield="j0.reference_name";
			$sortorder = "asc";
		}
		
		$this->db
			->select("SQL_CALC_FOUND_ROWS j0.id,j0.reference_name,j0.reference_remarks,j0.data_status,j0.reference_table_name ", FALSE)
			->from('reference_list AS j0')
			->where($where)
			->where("j0.data_status !='0'",NULL,FALSE)
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

	function insert_data($add_edit) // add  reference -------------------------------------
	{
		// $db_debug = $this->db->db_debug;
		// //$this->db->db_debug = false; // off display of db error
		 $this->db->trans_begin(); // transaction start

		$ustr="";
		$ref_insert_id="";
		if(isset($_POST) && count($_POST)>0)
	    {
		   $table='ref_'.str_replace(' ','_',strtolower(trim($this->input->post('name'))));
		   
		   $str="DROP TABLE IF EXISTS ".$table."";
		   $this->db->query($str);
		   
		   $this->db->query($str);
		   $tbl = array(
				'reference_table_name' => $table,
				'add_from_others_sts' => trim($this->input->post('add_from_others_sts')),
				'reference_name' => trim($this->input->post('name')),
				'reference_remarks' => $this->input->post('ref_remarks'),
				'e_by' => $this->session->userdata['ast_user']['user_id']
     		);
			
			$this->db->set('entry_datetime', date('Y-m-d H:i:s'));
			$this->db->insert('reference_list', $tbl);
			$ref_insert_id = $this->user_model->getLastInsertId('reference_list');
			
			for($i=1;$i<=4;$i++)
			{
				if($i==1){
					$m_opp='view';
					$m_link_name='View '.trim($this->input->post('name'));
					
				}else if($i==2){
					$m_opp='add';
					$m_link_name='Add '.trim($this->input->post('name'));
					
				}else if($i==3){
					$m_opp='edit';
					$m_link_name='Edit '.trim($this->input->post('name'));
					
				}else if($i==4){
					$m_opp='delete';
					$m_link_name='Delete '.trim($this->input->post('name'));
					
				}
				$tbl_right = array(
					'reference_table_id' => $ref_insert_id,
					'menu_operation' => $m_opp,
					'menu_link_name' => $m_link_name,
					'url_prefix' => 'ref/view',
					'sort_order' => $i,
					'e_by' => $this->session->userdata['ast_user']['user_id']
				);
				
				$this->db->set('entry_datetime',date('Y-m-d H:i:s'));
				$this->db->insert('reference_list_link_right', $tbl_right);				
			}
			
			//echo $this->db->last_query();exit;
			$str="CREATE TABLE $table (
				id INTEGER NOT NULL AUTO_INCREMENT, ";

			$hasunique=0;
			$uniq=" CREATE UNIQUE INDEX un_".$table." ON $table (  ";

			for($i=1;$i<= $_POST['counter'];$i++)
			{
				if(isset($_POST['length'.$i])){ $length = $this->chklength($_POST['length'.$i],$_POST['fieldtype'.$i]); }
				else { $length = NULL; }
				if($_POST['delete'.$i]==0)
				{
					if($i>1)
					{
				  		$str.=",";
				   	  	$ustr.=",";
				   	}
					if($length!='' && $_POST['fieldtype'.$i]!=4 && $_POST['fieldtype'.$i]!=7 && $_POST['fieldtype'.$i]!=8 && $_POST['fieldtype'.$i]!=9){ $l="  (".$length.")  "; }
					else {  $l=" ";}

					/**** for creating field na and value such as Varchar (250)******/
					if($_POST['fieldtype'.$i]==2 || $_POST['fieldtype'.$i]==5)
					{
					 	$fld=$this->datatype(2).' ('.$length.')';}else{$fld=$this->datatype($_POST['fieldtype'.$i]);
					}

				  	$inputcaption = str_replace(' ','_',strtolower(trim($this->input->post('inputcaption'.$i))));
				 	$str.=" ".$inputcaption." ".$fld." DEFAULT NULL";
				  	if(isset($_POST['Unique'.$i])==1)
					 {
					   $uniq.= "  ".$inputcaption." ,  ";
					   $hasunique=1;
					 }
				}
			}

			$uniq=rtrim($uniq , ' , ');
			$uniq.=" ) ";

			$str.=" , data_status INTEGER DEFAULT '1',
				    e_by INTEGER DEFAULT NULL,
			        entry_datetime DATETIME DEFAULT NULL,
					last_modified_by INTEGER DEFAULT NULL,
			        last_modified_datetime DATETIME DEFAULT NULL,
					delete_by INTEGER DEFAULT NULL,
			        delete_datetime DATETIME DEFAULT NULL,
					PRIMARY KEY  (id)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;";//Exception_Reason TEXT NULL,
			//echo '<pre>';echo $str;exit;
			 $this->db->query($str);
		
		}


		//if($hasunique==1)
		//{
		 //$this->db->query($uniq);
		//}

 		$this->db->query("delete from reference_field_list where REFERENCE_TABLE_NAME='".$table."'");
		$uniquelist="";
		for($i=1;$i<= $_POST['counter'];$i++)
		{
		 	$mapcolumn="";
			$ismap=0;
			if($_POST['delete'.$i]==0)
			{
				$inputcaption = str_replace(' ','_',strtolower(trim($this->input->post('inputcaption'.$i))));
				$tdate='';
				if(isset($_POST['refer'.$i])){$refer=$_POST['refer'.$i];}else{$refer='';}
				if(isset($_POST['ref_value_field'.$i])){$ref_value_field=$_POST['ref_value_field'.$i];}else{$ref_value_field='';}
				if(isset($_POST['ref_show_field'.$i])){$ref_show_field=$_POST['ref_show_field'.$i];}else{$ref_show_field='';}
				if(isset($_POST['Unique'.$i])) {$uniquelist.=$_POST['inputcaption'.$i]."::::";}
				if($_POST['inputtype'.$i]==2)
				{
				  if(isset($_POST['ismap'.$i]))
				  {
					$mapcolumn=$_POST['codmap'.$i];
					$ismap=1;
				  }
				}
				else
				{
					$mapcolumn="";
					$ismap=0;
				}
				if(isset($_POST['length'.$i]))
				{	$length = $this->chklength($_POST['length'.$i],$_POST['fieldtype'.$i]); }
				else{ $length = NULL; }


				$data=array(
					'reference_table_name' =>  $table ,
					'reference_field_name' => strtolower($inputcaption),
					'reference_field_caption' => ucwords(strtolower($this->input->post('inputcaption'.$i))),
					'reference_input_type_id' => $_POST['inputtype'.$i],
					'reference_name' => $refer,
					'reference_list_show_field_name' => $ref_show_field,
					'reference_list_value_field_nam' => $ref_value_field,
					'reference_field_type_id'  => $_POST['fieldtype'.$i],
					'reference_input_length'  => $length ,
					'reference_mandatory_status' => isset($_POST['mandatory'.$i]),
					'reference_unique_status' => isset($_POST['Unique'.$i]),
					'sort_order' => $this->input->post('inputorder'.$i),
					'reference_alignment' => $_POST['align'.$i]
				);

				$str=$this->db->insert_string('reference_field_list',$data);
				$query=$this->db->query($str);
				//echo $this->db->last_query(); //exit;
			}
		}
		//echo $ref_insert_id;exit;

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			
			return 1;
		}
		else {
			$this->db->trans_commit();
			
			return $ref_insert_id;
		 }

	}
	function update_data($id=NULL) // edit reference ***************************************
	{
		// $db_debug = $this->db->db_debug;
		// $this->db->db_debug = false; // off display of db error
		// $this->db->trans_begin(); // transaction start

		if(isset($_POST) && count($_POST)>0)
	    {
			$this->db->query("UPDATE reference_list SET reference_name = '".trim($this->input->post('name'))."',add_from_others_sts = '".trim($this->input->post('add_from_others_sts'))."', reference_remarks  = '".trim($this->input->post('ref_remarks'))."' WHERE id=".$id."");

			$this->db->query("DELETE FROM reference_list_link_right WHERE reference_table_id=".$id." AND right_status=0");
			
			for($i=1;$i<=4;$i++)
			{
				if($i==1){
					$m_opp='view';
					$m_link_name='View '.trim($this->input->post('name'));
					
				}else if($i==2){
					$m_opp='add';
					$m_link_name='Add '.trim($this->input->post('name'));
					
				}else if($i==3){
					$m_opp='edit';
					$m_link_name='Edit '.trim($this->input->post('name'));
					
				}else if($i==4){
					$m_opp='delete';
					$m_link_name='Delete '.trim($this->input->post('name'));
					
				}
				$tbl_right = array(
					'reference_table_id' => $id,
					'menu_operation' => $m_opp,
					'menu_link_name' => $m_link_name,
					'url_prefix' => 'ref/view',
					'sort_order' => $i,
					'e_by' => $this->session->userdata['ast_user']['user_id']
				);
				$this->db->set('entry_datetime',date('Y-m-d H:i:s'));
				$this->db->insert('reference_list_link_right', $tbl_right);
				
			}	
			
			$table= $this->get_ref_name_by_id($id);

            for($i=1;$i<=$_POST['counter'];$i++)
		     {
			   if($_POST['delete'.$i]==0 && $_POST['edittem'.$i]==0) // to add new column
			   {
					if(isset($_POST['length'.$i]))
					{
						$length = $this->chklength($_POST['length'.$i],$_POST['fieldtype'.$i]);
					}
					else { $length = NULL; }

					$inputcaption = str_replace(' ','_',strtoupper(trim($this->input->post('inputcaption'.$i))));

					if($length!='' && $_POST['fieldtype'.$i]!=4 && $_POST['fieldtype'.$i]!=7 && $_POST['fieldtype'.$i]!=8 && $_POST['fieldtype'.$i]!=9){$l="  (".$length.")  ";}
					else{  $l=" ";}

					if($_POST['fieldtype'.$i]==2 || $_POST['fieldtype'.$i]==5)
					{$fld=$this->datatype(2).' ('.$length.')';}else{$fld=$this->datatype($_POST['fieldtype'.$i]);}

					$mendatory = "DEFAULT NULL";

					if(isset($_POST['mandatory'.$i])==1)
					{
						$mendatory = "NOT NULL";
					}

					$this->db->query("ALTER TABLE $table ADD ".strtolower($inputcaption)."  ".$fld." ".$mendatory."");

					if(isset($_POST['Unique'.$i])==1)
					{
						//$this->db->query("ALTER TABLE $table ADD UNIQUE INDEX UN_".$table." ($inputcaption)");
					}

					if(isset($_POST['refer'.$i])){$refer=$_POST['refer'.$i];}else{$refer='';}
					if(isset($_POST['ref_value_field'.$i]))
					{$ref_value_field=$_POST['ref_value_field'.$i];}else{$ref_value_field='';}
					if(isset($_POST['ref_show_field'.$i]))
					{$ref_show_field=$_POST['ref_show_field'.$i];}else{$ref_show_field='';}

					$data=array(
							 'reference_table_name' =>  $table,
							 'reference_field_name' => strtolower($inputcaption),
							 'reference_field_caption'=> ucwords(strtolower($this->input->post('inputcaption'.$i))),
							 'reference_input_type_id' => $_POST['inputtype'.$i],
							 'reference_name' => $refer,
							 'reference_list_show_field_name' => $ref_show_field,
							 'reference_list_value_field_nam' => $ref_value_field,
							 'reference_field_type_id' => $_POST['fieldtype'.$i],
							 'reference_input_length' => $length,
							 'reference_mandatory_status' => isset($_POST['mandatory'.$i]),
							 'reference_unique_status' => isset($_POST['Unique'.$i]),
							 'sort_order' => $this->input->post('inputorder'.$i),
							 'reference_alignment' => $_POST['align'.$i]
							 );

					$str=$this->db->insert_string('reference_field_list',$data);
					$query=$this->db->query($str);
				}

				elseif($_POST['delete'.$i]==0 && $_POST['edittem'.$i]==1)// to edit existing
				{
					$data=array(
							 'reference_table_name' =>  $table ,
							 'reference_field_caption'=> ucwords(strtolower($this->input->post('inputcaption'.$i))),
							 'sort_order' => $this->input->post('inputorder'.$i),
							 'reference_alignment' => $_POST['align'.$i]
							 );

					$this->db->where('reference_table_name', $table);
					$this->db->where('id', $this->input->post('dropta'.$i));
					$this->db->update('reference_field_list', $data);
				}
			 }
		 }

		// if ($this->db->trans_status() === FALSE)
		// {
		// 	$this->db->trans_rollback();
		// 	$this->db->db_debug = $db_debug;
		// 	return false;
		// }
		// else {
		// 	$this->db->trans_commit();
		// 	$this->db->db_debug = $db_debug;
			return $id;
		// }
	}

	function get_add_action_data($id) // get data to show in grid
	{
		$str=" SELECT j0.id, j0.reference_name,j0.reference_remarks,j0.data_status
			   FROM reference_list j0
			   WHERE j0.data_status = '1'  AND j0.id= ".$id." LIMIT 1";
		$q=$this->db->query($str);
		return  $q->row();
	}

	function delete_action($refid)
	{
		// $db_debug = $this->db->db_debug;
		// $this->db->db_debug = false; // off display of db error
		// $this->db->trans_begin(); // transaction start

		$sel = $this->db->query("SELECT * FROM reference_list WHERE id=".$refid)->row();
		$this->db->where('id', $refid);
  		$this->db->delete('reference_list');
		
		$this->db->where('reference_table_id', $refid);
		$this->db->where('right_status', 0);
  		$this->db->delete('reference_list_link_right');
        // echo $this->db->last_query();exit;
		 
  		$this->db->where('reference_table_name', $sel->reference_table_name);
  		$this->db->delete('reference_field_list');

  		$this->db->query("DROP TABLE ".$sel->reference_table_name);
  		//$this->db->query("DROP sequence SQ_".$sel->REFERENCE_TABLE_NAME);

		// if ($this->db->trans_status() === FALSE)
		// {
		// 	$this->db->trans_rollback();
		// 	$this->db->db_debug = $db_debug;
		// 	return 0;
		// }
		// else {
		// 	$this->db->trans_commit();
		// 	$this->db->db_debug = $db_debug;
			return 1;
		// }
	}


	function duplicate_name($field,$val,$edit_id=NULL)
	{
		$table_name = 'ref_'.str_replace(' ','_',strtolower($val));
		$where="data_status=1 AND (".$field."='".$val."' || reference_table_name= '".$table_name."')";
		if($edit_id!=''){$where.=" and id!='".$edit_id."'";}
		$this->db->where($where, NULL, FALSE);
		$this->db->from('reference_list');
		$q=$this->db->get();
		return $q->num_rows();
	}

	function checkDuplicate($fieldname=NULL,$ref_id=NULL)
	{
		$q=$this->db->query("SELECT t2.* FROM (SELECT * FROM reference_list WHERE ID = ".$ref_id.") t1
		LEFT OUTER JOIN reference_field_list t2 ON(t1.reference_table_name = t2.reference_table_name)
		WHERE t2.reference_field_caption = '".$fieldname."' AND t2.data_status =1");
		return $q->num_rows();
	}

	function get_info($add_edit,$id) // get data for edit
	{
		if($id!=''){
			$str=" SELECT * FROM reference_list  WHERE data_status = '1'  AND id= ".$id." LIMIT 1";
			$query=$this->db->query($str);
			return $query->row_array();
		}
		else{return NULL;}
	}

	function get_field_info($add_edit,$id) // get data for edit
	{
		if($id!='')
		{
			$query = $this->db->get_where('reference_field_list', array('reference_table_name' => $id));
			return $query->result();
		}
		else{return NULL;}
	}

	function get_ref_name_by_id($id)
	{
		$query = $this->db->get_where('reference_list', array('id' => $id));
		$row = $query->row_array();
		return $row["reference_table_name"];
	}

	function get_field_by_refid($ref_table_name) // get data for edit
	{
		$query = $this->db->query("SELECT r.*, f.input_type_name as fname, i.field_type_name as iname, r.reference_name as reftab FROM
		(SELECT * FROM reference_field_list WHERE reference_table_name='".$ref_table_name."' AND data_status ='1') r
		LEFT OUTER JOIN reference_input_type f ON(f.ID = r.reference_input_type_id)
		LEFT OUTER JOIN reference_field_type i ON(i.ID = r.reference_field_type_id)
		LEFT OUTER JOIN reference_list ref ON(ref.reference_table_name = r.reference_table_name)");
		return $query->result();

	}

	function get_ref_list()
	{
		if ($this->input->post('edit_ref')){

			$this->db->where('reference_table_name !=', $this->input->post('edit_ref'));
			$this->db->order_by('reference_name');
			$query = $this->db->get('reference_list');
		}
		else {
			$this->db->order_by('reference_name');
			$query = $this->db->get('reference_list');
		}
		return $query->result();
	}

	function list_value_show()
	{
		$this->db->where('reference_table_name', $this->input->post('list_ref_name'));
		$query = $this->db->get('reference_field_list');

		return $query->result();
	}

	function check_duplicate($table)
	{
		$this->db->where('reference_table_name', $table);
		$query = $this->db->get('reference_list');
		if($query->num_rows())
			return true;
		else
			return false;
	}

	function referencefield($ref=NULL)
	 {
		$str="select * from  reference_list where data_status=1 order by reference_name asc  ";
		$query=$this->db->query($str);
		return $query->result();
	 }

	 function reference_list_field($ref=NULL)
	 {
		$str="select * from  reference_field_list where reference_table_name='$ref' AND data_status=1";
		$query=$this->db->query($str);
		return $query->result();
	 }

	 function datatype($id=NULL)
	  {
	    $str="SELECT * FROM  reference_field_type  WHERE id='$id'";
	    $query=$this->db->query($str);
		foreach($query->result() as $row) { return  $row->field_type_name; };
	  }

	 function chklength($len=NULL,$type=NULL)
	 {
		if($len!='' && $type!=4)
		  {
		    $len=str_replace('.',',',$len);
			if(is_numeric($len)){return $len;}
		  	else   if(preg_match('/^[0-9]+,+[0-9]$/',$len) && $type==5){return $this->strreplacebycomma($len); }
			else{ return  99;}
		  }
	 }

	 function strreplace($str)
	 {
	   if(!empty($str))
	    {
		 $patt=array('~','@','','\'','"',':','#','$','%','^','&','*','(',')','{','}','[',']','|','\\',';','<','>','?','+','-','!','.',',');
		 $replace=array(' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ');
		 $pgr=str_replace($patt,$replace,$str);
		 $pgr=trim($pgr);
		 return  str_replace(' ','_', $pgr);

		}
	 }

	function strreplacebycomma($str)
	 {
	   if(!empty($str))
	    {
		 $patt=array('~','@','','\'','"',':','#','$','%','^','&','*','(',')','{','}','[',']','|','\\',';','<','>','?','+','-','!','.');
		 $replace=array(',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',',');
		 $cstr= str_replace($patt,$replace,trim($str));
		 $c=explode(',',$cstr);
		 if(count($c)!=1){return "20,4";}else{return $cstr; }
		}
	 }

	function redropfield($table=NULL,$id=NULL,$tfield=NULL)
	{
		$str = "delete from reference_field_list where id='$id'";
		$query=$this->db->query($str);

		$str = "ALTER TABLE ".$table." DROP COLUMN ".$tfield."";
		$query=$this->db->query($str);
	}


	function oracle_query_ex($str=NULL)
	{
		$dbh = oci_connect ($this->db->username, $this->db->password, $this->db->hostname);
		if (!$dbh)
		 {
		 die('Could not connect: ');
		 }
		$parse_result2 = oci_parse ($dbh, $str);
		oci_execute($parse_result2);
		oci_free_statement($parse_result2);
		oci_close($dbh);
	}


	function duplicate_reference($val,$edit_id=NULL)
	{
		$table_name = 'ref_'.str_replace(' ','_',strtolower($val));
		$where="data_status=1 AND (reference_name='".strtolower(trim($val))."' or reference_table_name= '".$table_name."')";
		if($edit_id!=''){$where.=" and id!='".$edit_id."'";}
		$this->db->where($where, NULL, FALSE);
		$this->db->from('reference_list');
		$q=$this->db->get();
		return $q->num_rows();
	}

}
?>