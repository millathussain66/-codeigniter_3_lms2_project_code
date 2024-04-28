<?php
class Data_migration_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
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
				
					
				if($filterdatafield=='module_name')
				{
					$filterdatafield='j1.module_name';
				}	
				else if($filterdatafield=='total_rows')
				{
					$filterdatafield='j1.total_rows';
				}			
				else if($filterdatafield=='e_dt')
				{
					//$filterdatafield='b.e_dt';
					$filterdatafield = "DATE_FORMAT(j1.e_dt,'%d-%b-%y %h:%i %p')";
				}			
				else{$filterdatafield='j1.'.$filterdatafield;}
				
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
				if($filterdatafield =='e_by')
				{
					$where .= " (j2.name LIKE '%".$filtervalue."%' OR j2.user_id LIKE '%".$filtervalue."%') ";
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
				// build the "WHERE" clause depending on the filter's condition, value and datafield.
				
								
				if ($i == $filterscount - 1)
				{
					$where .= ")";
				}
				$tmpfilteroperator = $filteroperator;
				$tmpdatafield = $filterdatafield;	
						
			}
			// build the query.			
		}
		else{$where=array();}
		
		
		
		if ($sortorder == '')
		{
			$sortdatafield="j1.id";
			$sortorder = "ASC";				
		}
				
		$this->db
			->select("SQL_CALC_FOUND_ROWS j1.*,DATE_FORMAT(j1.e_dt,'%d-%b-%y %h:%i %p') AS e_dt,CONCAT(j2.name,' (',j2.user_id,')')as e_by", FALSE)
			->from('data_migration_history as j1')
			->join('users_info as j2', 'j1.e_by=j2.id', 'left')
			->where("j1.sts>0", NULL, FALSE)
			->where($where)
			->order_by($sortdatafield,$sortorder)
			->limit($limit, $offset);
		$q=$this->db->get();
		
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
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}
	function error_mesage($row_counter,$code,$perameter,$field_name=NULL,$mandatory_sts=NULL,$list_field_value=NULL,$user_name=NULL)
	{
		$row_counter=$row_counter+1;//For show the excat row location with header
		if($code==1)
		{
			if($perameter=='' || !($perameter=='Loan' || $perameter=='Card'))
			{
				return "Wrong Proposed Type row number at($row_counter)";
			}
		}
		if($code==2 && !empty($perameter) && $perameter!='Yet To Fix')//Date Fromat Check
		{
			if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$perameter)) {
			    return "Invalid Date Format $field_name row number at($row_counter)";
			}
		}
		if($code==2 && empty($perameter) && $mandatory_sts==1)
		{
			return "$field_name Required row number at($row_counter)";
		}
		if($code==3 && !empty($perameter))//Loan Account Validation
		{
			if (strlen($perameter)!=16 && $mandatory_sts=='Card') {
			    return "Invalid $field_name row number at($row_counter)";
			}
			else if ($mandatory_sts=='Loan') {
				$acLength = $this->Common_model->getAcLength();
				$acLength_arr = explode(",",$acLength);
				if (!in_array(strlen($perameter), $acLength_arr))
				{
					return "Invalid $field_name row number at($row_counter)";
				}
			}
		}
		if($code==3 && empty($perameter))
		{
			return "$field_name Required row number at($row_counter)";
		}
		if($code==4 && empty($perameter) && $mandatory_sts==1)//when list field mandatory and data not matched with perameter
		{
			return "Invalid $field_name row number at($row_counter)";
		}
		else if($code==4 && empty($perameter) && $mandatory_sts==0 && $list_field_value!=NULL)//when list field not mandatory but user fill the list value and it not matched with perameter
		{
			return "Invalid $field_name row number at($row_counter)";
		}
		if($code==5 && empty($perameter))
		{
			return "$field_name Required row number at($row_counter)";
		}

		if($code==6 && !is_numeric($perameter))
		{
			return "Invalid $field_name row number at($row_counter)";
		}
		if($code==7 && !empty($perameter)) //Duplicate case number check for suit file
		{
			$row = $this->db->query("SELECT s.id FROM suit_filling_info s WHERE s.sts<>0  AND s.case_number='".$perameter."'")->result();
			if(!empty($row))
			{
				return "Duplicate $field_name row number at($row_counter)";
			}
		}
		if($code==8)
		{
			if($perameter=='' || !($perameter=='New' || $perameter=='Recase'))
			{
				return "Wrong High Court Matter Type row number at($row_counter)";
			}
		}
		if($code==9 && !empty($perameter)) //Duplicate case number check for High Court file
		{
			$row = $this->db->query("SELECT s.id FROM hc_matter s WHERE s.sts<>0  AND s.case_no='".$perameter."'")->result();
			if(!empty($row))
			{
				return "Duplicate $field_name row number at($row_counter)";
			}
		}
		if($code==10)
		{
			if($perameter=='' || !($perameter=='Yes' || $perameter=='No'))
			{
				return "Wrong Account Closing Input row number at($row_counter)";
			}
		}
		if($code==12 && empty($perameter) && $mandatory_sts==1 && (empty($user_name) || empty($list_field_value))) //Checking User Exist Or Not
		{
			return "Please Provide proper $field_name row number at($row_counter)";
		}
		else if($code==12 && empty($perameter) && $mandatory_sts==1 && !empty($user_name)) //Creating New User For LMS
		{
			return "CREATE";
		}
		else if($code==12 && empty($perameter) && $mandatory_sts==0 && (!empty($user_name) || !empty($list_field_value))) //Creating New User For LMS
		{
			return "CREATE";
		}
		if($code==13)
		{
			if($perameter=='' || !($perameter=='Court Fee' || $perameter=='Lawyer Bill'))
			{
				return "Wrong Cost Type row number at($row_counter)";
			}
		}
		if($code==14 && empty($perameter)) 
		{
			return "Division Not Matched, $field_name row number at($row_counter)";
			
		}
		if($code==15 && empty($perameter)) 
		{
			return "Division and Case Category Not Matched, $field_name row number at($row_counter)";
			
		}
		return "";
	}
	function create_user($pin,$name)
	{
		$pass = 'LMS@123456';
		$pass2 = $this->User_model->encrypt($pass); 
		$data = array(
					'user_id' => 'DM'.$pin,
					'pin' => $pin,
					'name' => $name,
					'password_log' => $pass2,
					'lock_status' => 1,
				);
		$data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
		$data['entry_datetime'] = date('Y-m-d H:i:s');
		$data['verify_status'] = 1;
		$this->db->insert('users_info', $data);
		$insert_idss = $this->db->insert_id();
		return $insert_idss;
	}
	function update_court_district_name()
	{
		$str="UPDATE ref_court r,ref_legal_district d
				SET r.district_name=d.name WHERE r.district=d.id";
		$this->db->query($str);		
		$str = "UPDATE ref_lawyer r,ref_legal_district d
				SET r.district_name=d.name WHERE r.district=d.id";
		$this->db->query($str);	

		$str = "UPDATE ref_lawyer r,ref_legal_region d
				SET r.region_name=d.name WHERE r.region=d.id";
		$this->db->query($str);	
	}
	function searchforpin($pin,$array)
	{
		foreach($array as $key=>$val)
		{
			if(strtoupper($val['pin']) === strtoupper($pin))
			{
				return $pin;
			}
		}
		return "";
	}
	function add_edit_action($add_edit=NULL,$edit_id=NULL)
	{	
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = true; // off display of db error
		$this->db->trans_begin(); // transaction start
		$error_mesage = array();
		$this->update_court_district_name();//updating district name in court refference table
		$migration_type = $this->input->post('migration_type_hidden');
		$row_counter=0;
		$suit_data_migration_sts=0;
		$dm_user_array = array();
		if($migration_type!=8)
		{
			//For moving the file to another folder
			$from = FCPATH.'temp_upload_file/dm_file_'.$this->session->userdata['ast_user']['user_id'].'_'.$migration_type.'.csv';
			$new_name = 'dm_file_'.$this->session->userdata['ast_user']['user_id'].'_'.$migration_type.time().'.csv';
			$to = FCPATH.'dm_files/'.$new_name;
		}
		if($migration_type==1)//For 1st Legal Notice
		{
			$counter = 0;
			$str="SELECT COUNT(session_id) AS total FROM data_migration_ln WHERE session_id='".$this->session->userdata['ast_user']['user_id']."'";
			$total_rows = $this->db->query($str)->row();
			if(!empty($total_rows) && $total_rows->total>0)
			{
				$array = array(
		            'total_rows'=>$total_rows->total,
		            'e_by'=>$this->session->userdata['ast_user']['user_id'],
		            'e_dt'=>date('Y-m-d H:i:s'),
		            'module_name'=>'1st Legal Notice Data Migration',
		            'file_name'=>$new_name
		        );
		        $this->db->insert('data_migration_history', $array);
				$insert_idss = $this->db->insert_id();
				$limit_counter = $total_rows->total;
				$ini_limit=300;
				// for ($i=0; $i <=$limit_counter ; $i++) { 
					
				// }
				$row = $this->db->query("SELECT c.*,c.account_number as loan_ac,l.code as loan_segment_code
					FROM data_migration_ln as c 
					LEFT OUTER JOIN ref_loan_segment l on(c.protfolio_name=l.name AND l.data_status=1)
					WHERE c.session_id='".$this->session->userdata['ast_user']['user_id']."' ORDER BY c.id ASC")->result();
					//$i=($i-1)+$ini_limit;//set the new limit +300
					$data=array();
					if(!empty($row))
					{
						foreach ($row as $key) 
						{
							$row_counter++;
							$counter++;
							if($counter>=100)
							{
								$this->db->insert_batch('legal_notice', $data);
								$data=array();
								$counter=0;
							}
							$check = $this->error_mesage($row_counter,1,$key->proposed_type);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,2,$key->ln_sending_dt,'ln sending date',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,3,$key->account_number,'Loan AC Number',$key->proposed_type);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->loan_segment_code,'Loan Segment',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}

							if(!empty($error_mesage))
							{
								$this->db->trans_rollback();
								$this->db->db_debug = $db_debug;
								return $error_mesage;		
							}
							if($key->proposed_type=='Loan')
							{
								$loan_ac = $key->loan_ac;
								$org_loan_ac = "";
								if(strlen($loan_ac)==16)
								{
									$cif = substr($loan_ac,5,8);
								}
								else if(strlen($loan_ac)==13)
								{
									$cif = substr($loan_ac,1,8);
								}
								else
								{
									$cif = "";
								}
							}
							else
							{
								$loan_ac = substr($key->loan_ac,0,6).'******'.substr($key->loan_ac,12,16);
								$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$key->loan_ac);
								$cif = "";
							}
							$array = array(
					           'proposed_type' =>$key->proposed_type,
					           'loan_ac' =>$loan_ac,
					           'cif' =>$cif,
					           'org_loan_ac' =>$org_loan_ac,
					           'ac_name' =>$key->account_name,
					           'legal_notice_s_dt' =>$key->ln_sending_dt,
					           'loan_segment' =>$key->loan_segment_code,
					           'remarks' =>$key->remarks,
					           'legal_notice_sts' =>14,
					           'life_cycle' =>2,
					           'migration_sts' =>1,
					           'migration_id' =>$insert_idss,
					        );
							array_push($data,$array);
						}

						$this->db->insert_batch('legal_notice', $data);
					}
			}
			
		}
		else if($migration_type==2)//For CMA Approval
		{
			$counter = 0;
			$str="SELECT COUNT(session_id) AS total FROM data_migration_cma WHERE session_id='".$this->session->userdata['ast_user']['user_id']."'";
			$total_rows = $this->db->query($str)->row();
			if(!empty($total_rows) && $total_rows->total>0)
			{
				$array = array(
		            'total_rows'=>$total_rows->total,
		            'e_by'=>$this->session->userdata['ast_user']['user_id'],
		            'e_dt'=>date('Y-m-d H:i:s'),
		            'module_name'=>'CMA Approval Data Migration',
		            'file_name'=>$new_name
		        );
		        $this->db->insert('data_migration_history', $array);
				$insert_idss = $this->db->insert_id();
				$limit_counter = $total_rows->total;
				$ini_limit=300;
				// for ($i=0; $i <=$limit_counter ; $i++) { 
					
				// }
				$row = $this->db->query("SELECT c.*,l.code as loan_segment_code,rq.id as req_type_id,
							s.id as security_sts_id,cl.id as cl_id,t.id as territory_id,r.id as region_id,
							d.id as district_id
						FROM data_migration_cma as c 
						LEFT OUTER JOIN ref_loan_segment l on(c.protfolio=l.name AND l.data_status=1)
						LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.name AND rq.data_status=1)
						LEFT OUTER JOIN ref_sec_sts s on(c.security_sts=s.name AND s.data_status=1)
						LEFT OUTER JOIN ref_cl cl on(c.cl=cl.name AND cl.data_status=1)
						LEFT OUTER JOIN ref_territory t on(c.territory=t.name AND t.data_status=1)
						LEFT OUTER JOIN ref_region r on(c.region=r.name AND r.data_status=1)
						LEFT OUTER JOIN ref_district d on(c.district=d.name AND d.data_status=1)
						WHERE c.session_id='".$this->session->userdata['ast_user']['user_id']."' ORDER BY c.id ASC")->result();
						//$i=($i-1)+$ini_limit;//set the new limit +300
						$data=array();
						if(!empty($row))
						{
							foreach ($row as $key) 
							{
								$row_counter++;
								$counter++;
								if($counter>=100)
								{
									$this->db->insert_batch('cma', $data);
									$data=array();
									$counter=0;
								}
								$check = $this->error_mesage($row_counter,1,$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								
								$check = $this->error_mesage($row_counter,3,$key->loan_ac,'Loan AC Number',$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->req_type_id,'Requisition Type',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->security_sts_id,'Security Status',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,2,$key->approve_dt,'Approval Date',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->cl_id,'CL',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->territory_id,'Territory',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->district_id,'District',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->region_id,'Region',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->loan_segment_code,'Loan Segment',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}

								if(!empty($error_mesage))
								{
									$this->db->trans_rollback();
									$this->db->db_debug = $db_debug;
									return $error_mesage;		
								}
								if($key->proposed_type=='Loan')
								{
									$loan_ac = $key->loan_ac;
									$org_loan_ac = "";
									if(strlen($loan_ac)==16)
									{
										$cif = substr($loan_ac,5,8);
									}
									else if(strlen($loan_ac)==13)
									{
										$cif = substr($loan_ac,1,8);
									}
									else
									{
										$cif = "";
									}
								}
								else
								{
									$loan_ac = substr($key->loan_ac,0,6).'******'.substr($key->loan_ac,12,16);
									$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$key->loan_ac);
									$cif = "";
								}
								$array = array(
						           'proposed_type' =>$key->proposed_type,
						           'loan_ac' =>$loan_ac,
						           'cif' =>$cif,
						           'org_loan_ac' =>$org_loan_ac,
						           'ac_name' =>$key->ac_name,
						           'req_type' =>$key->req_type_id,
						           'sec_sts' =>$key->security_sts_id,
						           'v_dt' =>$key->approve_dt,
						           'cl_bbl' =>$key->cl_id,
						           'territory' =>$key->territory_id,
						           'district' =>$key->district_id,
						           'region' =>$key->region_id,
						           'loan_segment' =>$key->loan_segment_code,
						           'cma_sts' =>59,
						           'life_cycle' =>2,
						           'migration_sts' =>1,
						           'migration_id' =>$insert_idss,
						        );
								array_push($data,$array);
							}

							$this->db->insert_batch('cma', $data);
						}
			}
			
		}
		else if($migration_type==3)//For Case File Data Migration
		{
			$counter = 0;
			$str="SELECT COUNT(session_id) AS total FROM data_migration_case_file WHERE session_id='".$this->session->userdata['ast_user']['user_id']."'";
			$total_rows = $this->db->query($str)->row();
			if(!empty($total_rows) && $total_rows->total>0)
			{
				$array = array(
		            'total_rows'=>$total_rows->total,
		            'e_by'=>$this->session->userdata['ast_user']['user_id'],
		            'e_dt'=>date('Y-m-d H:i:s'),
		            'module_name'=>'Case File Data Migration',
		            'file_name'=>$new_name
		        );
		        $this->db->insert('data_migration_history', $array);
				$insert_idss = $this->db->insert_id();
				$limit_counter = $total_rows->total;
				$ini_limit=300;
				// for ($i=0; $i <=$limit_counter ; $i++) { 
					
				// }
				$row = $this->db->query("SELECT c.*,l.code as loan_segment_code,rq.id as req_type_id,
						t.id as territory_id,r.id as region_id,csp.id as case_sts_prev_dt_id,IF(c.req_type='ARA-2003',aca.id,acn.id) as act_prev_dt_id,
						csn.id as case_sts_next_dt_id,pf.id as filling_plaintiff_id,
						prf.id as present_plaintiff_id,cdo.id as case_deal_officer_id,
						lw.id as lawyer_id,pc.id as prev_court_id,prc.id as present_court_name,
						d.id as district_id,cn.id as case_name_id,fr.id as final_remarks_id
					FROM data_migration_case_file as c 
					LEFT OUTER JOIN ref_loan_segment l on(c.protfolio=l.name AND l.data_status=1)
					LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.name AND rq.data_status=1)
					LEFT OUTER JOIN ref_case_name cn on(c.case_name=cn.name AND cn.data_status=1)
					LEFT OUTER JOIN ref_case_sts csp on(c.case_sts_prev_dt=csp.name AND csp.data_status=1)
					LEFT OUTER JOIN ref_schedule_charges_ara aca on(c.act_prev_dt=aca.name AND aca.data_status=1 AND c.req_type='ARA-2003' AND (aca.aurtho_jari_sts=0 OR aca.aurtho_jari_sts IS NULL))
					LEFT OUTER JOIN ref_schedule_charges_ni acn on(acn.apv_sts<>1 AND c.act_prev_dt=acn.name AND acn.data_status=1 AND c.req_type!='ARA-2003')
					LEFT OUTER JOIN ref_case_sts csn on(c.case_sts_next_dt=csn.name AND csn.data_status=1)
					LEFT OUTER JOIN ref_territory t on(c.territory=t.name AND t.data_status=1)
					LEFT OUTER JOIN ref_legal_region r on(c.region=r.name AND r.data_status=1)
					LEFT OUTER JOIN ref_legal_district d on(c.district=d.name AND d.data_status=1)
					LEFT OUTER JOIN users_info pf on(c.filling_plaintiff=pf.pin AND pf.data_status=1)
					LEFT OUTER JOIN users_info prf on(c.present_plaintiff=prf.pin AND prf.data_status=1)
					LEFT OUTER JOIN users_info cdo on(c.case_deal_officer=cdo.pin AND cdo.data_status=1)
					LEFT OUTER JOIN ref_lawyer lw on(c.lawyer_name=lw.name AND c.region=lw.region_name AND lw.data_status=1)
					LEFT OUTER JOIN ref_court pc on(c.prev_court=pc.name AND c.district=pc.district_name AND pc.data_status=1)
					LEFT OUTER JOIN ref_court prc on(c.present_court=prc.name AND c.district=prc.district_name AND prc.data_status=1)
					LEFT OUTER JOIN ref_final_remarks fr on(c.final_status=fr.name AND fr.data_status=1)
					WHERE c.session_id='".$this->session->userdata['ast_user']['user_id']."' ORDER BY c.id ASC")->result();
					//$i=($i-1)+$ini_limit;//set the new limit +300
					$data=array();
					if(!empty($row))
					{
						foreach ($row as $key) 
						{
							$row_counter++;
							$counter++;
							if($counter>=100)
							{
								$this->db->insert_batch('suit_filling_info', $data);
								$data=array();
								$counter=0;
							}
							$check = $this->error_mesage($row_counter,1,$key->proposed_type);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							
							$check = $this->error_mesage($row_counter,3,$key->loan_ac,'Loan AC Number',$key->proposed_type);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->req_type_id,'Requisition Type');
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->case_name_id,'Case Name',0,$key->case_name);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,2,$key->filling_date,'Filling Date',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,5,$key->case_number,'Case Number');
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,5,$key->case_claim_amount,'Case Claim Amount');
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,6,$key->case_claim_amount,'Case Claim Amount');
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,2,$key->previous_dt,'Previous Date',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->case_sts_prev_dt_id,'Case Status Previous Date',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->act_prev_dt_id,'Activities Previous Date',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,2,$key->next_dt,'Next Date',0);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->case_sts_next_dt_id,'Case Status Next Date',0,$key->case_sts_next_dt);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,12,$key->filling_plaintiff_id,'Filling Plaintiff',1,$key->filling_plaintiff,$key->filling_plaintiff_name);
							if($check!='' && $check=='CREATE')
							{
								$pass = 'LMS@123456';
								$pass2 = $this->User_model->encrypt($pass); 
								$user_data = array(
											'user_id' => 'DM'.$key->filling_plaintiff,
											'pin' => $key->filling_plaintiff,
											'name' => $key->filling_plaintiff_name,
											'password_log' => $pass2,
											'lock_status' => 1,
										);
								$user_data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
								$user_data['entry_datetime'] = date('Y-m-d H:i:s');
								$user_data['verify_status'] = 1;
								if(empty($dm_user_array))
								{
									array_push($dm_user_array,$user_data);
								}
								else if ($this->searchforpin($key->filling_plaintiff,$dm_user_array)=='') {
									array_push($dm_user_array,$user_data);
								}
								$filling_plaintiff_id = '';
							}
							else if($check!='')
							{
								array_push($error_mesage,$check);
							}
							else
							{
								$filling_plaintiff_id = $key->filling_plaintiff_id;
							}
							$check = $this->error_mesage($row_counter,12,$key->present_plaintiff_id,'Present Plaintiff',1,$key->present_plaintiff,$key->present_plaintiff_name);
							if($check!='' && $check=='CREATE')
							{
								$pass = 'LMS@123456';
								$pass2 = $this->User_model->encrypt($pass); 
								$user_data = array(
											'user_id' => 'DM'.$key->present_plaintiff,
											'pin' => $key->present_plaintiff,
											'name' => $key->present_plaintiff_name,
											'password_log' => $pass2,
											'lock_status' => 1,
										);
								$user_data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
								$user_data['entry_datetime'] = date('Y-m-d H:i:s');
								$user_data['verify_status'] = 1;
								if(empty($dm_user_array))
								{
									array_push($dm_user_array,$user_data);
								}
								else if ($this->searchforpin($key->present_plaintiff,$dm_user_array)=='') {
									array_push($dm_user_array,$user_data);
								}
								$present_plaintiff_id = '';
							}
							else if($check!='')
							{
								array_push($error_mesage,$check);
							}
							else
							{
								$present_plaintiff_id = $key->present_plaintiff_id;
							}
							$check = $this->error_mesage($row_counter,12,$key->case_deal_officer_id,'Case Deal Officer',1,$key->case_deal_officer,$key->case_deal_officer_name);
							if($check!='' && $check=='CREATE')
							{
								$pass = 'LMS@123456';
								$pass2 = $this->User_model->encrypt($pass); 
								$user_data = array(
											'user_id' => 'DM'.$key->case_deal_officer,
											'pin' => $key->case_deal_officer,
											'name' => $key->case_deal_officer_name,
											'password_log' => $pass2,
											'lock_status' => 1,
										);
								$user_data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
								$user_data['entry_datetime'] = date('Y-m-d H:i:s');
								$user_data['verify_status'] = 1;
								if(empty($dm_user_array))
								{
									array_push($dm_user_array,$user_data);
								}
								else if ($this->searchforpin($key->case_deal_officer,$dm_user_array)=='') {
									array_push($dm_user_array,$user_data);
								}
								$case_deal_officer_id = '';
							}
							else if($check!='')
							{
								array_push($error_mesage,$check);
							}
							else
							{
								$case_deal_officer_id = $key->case_deal_officer_id;
							}
							$check = $this->error_mesage($row_counter,4,$key->lawyer_id,'Lawyer Name',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->prev_court_id,'Previous Court',0,$key->prev_court);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->present_court_name,'Present Court',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->territory_id,'Territory',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->district_id,'District',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->region_id,'Region',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->loan_segment_code,'Loan Segment',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->final_remarks_id,'Final Status',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}

							if(!empty($error_mesage))
							{
								$this->db->trans_rollback();
								$this->db->db_debug = $db_debug;
								return $error_mesage;		
							}
							if($key->proposed_type=='Loan')
							{
								$loan_ac = $key->loan_ac;
								$org_loan_ac = "";
								if(strlen($loan_ac)==16)
								{
									$cif = substr($loan_ac,5,8);
								}
								else if(strlen($loan_ac)==13)
								{
									$cif = substr($loan_ac,1,8);
								}
								else
								{
									$cif = "";
								}
							}
							else
							{
								$loan_ac = substr($key->loan_ac,0,6).'******'.substr($key->loan_ac,12,16);
								$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$key->loan_ac);
								$cif = "";
							}
							if($key->final_remarks_id==1)
							{
								$suit_sts = 75;
							}
							else
							{
								$suit_sts = 76;
							}
							if($key->next_dt=='Yet To Fix')
							{
								$next_dt_sts = 0;
							}
							else
							{
								$next_dt_sts = 1;
							}
							$array = array(
					           'proposed_type' =>$key->proposed_type,
					           'loan_ac' =>$loan_ac,
					           'cif' =>$cif,
					           'org_loan_ac' =>$org_loan_ac,
					           'ac_name' =>$key->ac_name,
					           'req_type' =>$key->req_type_id,
					           'case_name' =>$key->case_name_id,
					           'prev_filling_date' =>$key->prev_filling_date,
					           'filling_date' =>$key->filling_date,
					           'case_number' =>$key->case_number,
					           'case_claim_amount' =>$key->case_claim_amount,
					           'prev_date' =>$key->previous_dt,
					           'initial_case_sts_dt' =>$key->previous_dt,
					           'case_sts_prev_dt' =>$key->case_sts_prev_dt_id,
					           'initial_case_sts' =>$key->case_sts_prev_dt_id,
					           'act_prev_date' =>$key->act_prev_dt_id,
					           'next_dt_sts' =>$next_dt_sts,
					           'next_date' =>$key->next_dt,
					           'case_sts_next_dt' =>$key->case_sts_next_dt_id,
					           'remarks_prev_date' =>$key->remarks_prev_dt,
					           'initial_case_sts_remarks' =>$key->remarks_prev_dt,
					           //'prev_plaintiff' =>$filling_plaintiff_id,
					           'filling_plaintiff' =>$filling_plaintiff_id,
					           'filling_plaintiff_pin' =>$key->filling_plaintiff,
					           'present_plaintiff' =>$present_plaintiff_id,
					           'present_plaintiff_pin' =>$key->filling_plaintiff,
					           'case_deal_officer' =>$case_deal_officer_id,
					           'case_deal_officer_pin' =>$key->case_deal_officer,
					           'prest_lawyer_name' =>$key->lawyer_id,
					           'prev_court_name' =>$key->prev_court_id,
					           'prest_court_name' =>$key->present_court_name,
					           'district' =>$key->district_id,
					           'cma_district' =>$key->district_id,
					           'region' =>$key->region_id,
					           'legal_region' =>$key->region_id,
					           'territory' =>$key->territory_id,
					           'loan_segment' =>$key->loan_segment_code,
					           'final_remarks' =>$key->final_remarks_id,
					           'suit_sts' =>$suit_sts,
					           'remarks' =>$key->remarks,
					           'migration_sts' =>1,
					           'migration_id' =>$insert_idss,
					        );
							array_push($data,$array);
						}
						$this->db->insert_batch('suit_filling_info', $data);
						if(!empty($dm_user_array))
						{
							$this->db->insert_batch('users_info', $dm_user_array);
							$this->db->query("UPDATE suit_filling_info s,users_info u SET s.filling_plaintiff=u.id WHERE s.filling_plaintiff_pin=u.pin AND (s.filling_plaintiff='' OR s.filling_plaintiff IS NULL)");
							$this->db->query("UPDATE suit_filling_info s,users_info u SET s.present_plaintiff=u.id WHERE s.present_plaintiff_pin=u.pin AND (s.present_plaintiff='' OR s.present_plaintiff IS NULL)");
							$this->db->query("UPDATE suit_filling_info s,users_info u SET s.case_deal_officer=u.id WHERE s.case_deal_officer_pin=u.pin AND (s.case_deal_officer='' OR s.case_deal_officer IS NULL)");
						}
					}
			}
			
		}
		else if($migration_type==4)//For Lawyer Bill Data
		{
			$counter = 0;
			$str="SELECT COUNT(session_id) AS total FROM data_migration_lawyer_bill WHERE session_id='".$this->session->userdata['ast_user']['user_id']."'";
			$total_rows = $this->db->query($str)->row();
			if(!empty($total_rows) && $total_rows->total>0)
			{
				$array = array(
		            'total_rows'=>$total_rows->total,
		            'e_by'=>$this->session->userdata['ast_user']['user_id'],
		            'e_dt'=>date('Y-m-d H:i:s'),
		            'module_name'=>'Lawyer Bill Data Migration',
		            'file_name'=>$new_name
		        );
		        $this->db->insert('data_migration_history', $array);
				$insert_idss = $this->db->insert_id();
				$limit_counter = $total_rows->total;
				$ini_limit=300;
				// for ($i=0; $i <=$limit_counter ; $i++) { 
					
				// }
				$row = $this->db->query("SELECT c.*,rq.id as req_type_id_sub,l.id as lawyer_id,d.id as unit_id,
					r.id as region_id,IF(c.req_type_id=2,sc2.id,IF(c.req_type_id=1,sc.id,'')) as activities_id
					FROM data_migration_lawyer_bill as c 
					LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.name AND rq.data_status=1)
					LEFT OUTER JOIN ref_schedule_charges_ni sc on(sc.apv_sts<>1 AND c.activities_name=sc.name AND sc.data_status=1 AND c.req_type_id=1)
					LEFT OUTER JOIN ref_schedule_charges_ara sc2 on(c.activities_name=sc2.name AND sc2.data_status=1 AND c.req_type_id=2)
					LEFT OUTER JOIN ref_region r on(c.region=r.name AND r.data_status=1)
					LEFT OUTER JOIN ref_lawyer l on(c.lawyer_name=l.name AND l.data_status=1)
					LEFT OUTER JOIN ref_unit_office d on(c.unit=d.name AND d.data_status=1)
					WHERE c.session_id='".$this->session->userdata['ast_user']['user_id']."' ORDER BY c.id ASC")->result();
					//$i=($i-1)+$ini_limit;//set the new limit +300
					$data=array();
					if(!empty($row))
					{
						foreach ($row as $key) 
						{
							$row_counter++;
							$counter++;
							if($counter>=100)
							{
								$this->db->insert_batch('cost_details', $data);
								$data=array();
								$counter=0;
							}
							$check = $this->error_mesage($row_counter,1,$key->proposed_type);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							
							$check = $this->error_mesage($row_counter,3,$key->loan_ac,'Loan AC Number',$key->proposed_type);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->req_type_id_sub,'Requisition Type',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->lawyer_id,'Lawyer Name',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,2,$key->date_of_bill,'Bill Date',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->unit_id,'Unit',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->region_id,'Region',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->activities_id,'Activities',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,5,$key->amount,'Amount');
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,6,$key->amount,'Amount');
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,5,$key->case_number,'Case Number');
							if($check!='')
							{
								array_push($error_mesage,$check);
							}

							if(!empty($error_mesage))
							{
								$this->db->trans_rollback();
								$this->db->db_debug = $db_debug;
								return $error_mesage;		
							}
							if($key->proposed_type=='Loan')
							{
								$loan_ac = $key->loan_ac;
								$org_loan_ac = "";
								if(strlen($loan_ac)==16)
								{
									$cif = substr($loan_ac,5,8);
								}
								else if(strlen($loan_ac)==13)
								{
									$cif = substr($loan_ac,1,8);
								}
								else
								{
									$cif = "";
								}
							}
							else
							{
								$loan_ac = substr($key->loan_ac,0,6).'******'.substr($key->loan_ac,12,16);
								$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$key->loan_ac);
								$cif = "";
							}
							$array = array(
					           'proposed_type' =>$key->proposed_type,
					           'loan_ac' =>$loan_ac,
					           'cif' =>$cif,
					           'org_loan_ac' =>$org_loan_ac,
					           'ac_name' =>$key->ac_name,
					           'case_number' =>$key->case_number,
					           'req_type' =>$key->req_type_id_sub,
					           'region' =>$key->region_id,
					           'unit' =>$key->unit_id,
					           'vendor_id' =>$key->lawyer_id,
					           'activities_id' =>$key->activities_id,
					           'txrn_dt' =>$key->date_of_bill,
					           'amount' =>$key->amount,
					           'vendor_type' =>1,
					           'memo_sts' =>88,
					           'migration_sts' =>1,
					           'migration_id' =>$insert_idss,
					        );
							array_push($data,$array);
						}

						$this->db->insert_batch('cost_details', $data);
					}
			}
			
		}
		else if($migration_type==5)//For Paper Bill Data
		{
			$array = array(
	            'total_rows'=>$total_rows->total,
	            'e_by'=>$this->session->userdata['ast_user']['user_id'],
	            'e_dt'=>date('Y-m-d H:i:s'),
	            'module_name'=>'Paper Bill Data Migration',
		        'file_name'=>$new_name
	        );
	        $this->db->insert('data_migration_history', $array);
			$insert_idss = $this->db->insert_id();
			$counter = 0;
			$str="SELECT COUNT(session_id) AS total FROM data_migration_paper_bill WHERE session_id='".$this->session->userdata['ast_user']['user_id']."'";
			$total_rows = $this->db->query($str)->row();
			if(!empty($total_rows) && $total_rows->total>0)
			{
				$limit_counter = $total_rows->total;
				$ini_limit=300;
				// for ($i=0; $i <=$limit_counter ; $i++) { 
					
				// }
				$row = $this->db->query("SELECT c.*,rq.id as req_type_id_sub,ls.code as loan_segment_code,
					r.id as region_id,d.id as district_id,pv.id as paper_vendor_id,pn.id as paper_id
					FROM data_migration_paper_bill as c 
					LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.name AND rq.data_status=1)
					LEFT OUTER JOIN ref_region r on(c.region=r.name AND r.data_status=1)
					LEFT OUTER JOIN ref_district d on(c.district=d.name AND d.data_status=1)
					LEFT OUTER JOIN ref_paper_vendor pv on(c.vendor_name=pv.name AND pv.data_status=1)
					LEFT OUTER JOIN ref_paper pn on(c.paper_name=pn.name AND pn.data_status=1)
					LEFT OUTER JOIN ref_loan_segment ls on(c.loan_segment=ls.name AND ls.data_status=1)
					WHERE c.session_id='".$this->session->userdata['ast_user']['user_id']."' ORDER BY c.id ASC")->result();
					//$i=($i-1)+$ini_limit;//set the new limit +300
					$data=array();
					if(!empty($row))
					{
						foreach ($row as $key) 
						{
							$row_counter++;
							$counter++;
							if($counter>=100)
							{
								$this->db->insert_batch('cost_details', $data);
								$data=array();
								$counter=0;
							}
							$check = $this->error_mesage($row_counter,1,$key->proposed_type);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							
							$check = $this->error_mesage($row_counter,3,$key->loan_ac,'Loan AC Number',$key->proposed_type);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->req_type_id_sub,'Requisition Type',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->paper_vendor_id,'Paper Vendor',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->paper_id,'Paper Name',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,2,$key->publication_date,'Publication Date',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->region_id,'Region',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->district_id,'District',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,4,$key->loan_segment_code,'Loan Segment',1);
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,5,$key->publication_amount,'Publication Amount');
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,6,$key->publication_amount,'Publication Amount');
							if($check!='')
							{
								array_push($error_mesage,$check);
							}
							$check = $this->error_mesage($row_counter,5,$key->case_number,'Case Number');
							if($check!='')
							{
								array_push($error_mesage,$check);
							}

							if(!empty($error_mesage))
							{
								$this->db->trans_rollback();
								$this->db->db_debug = $db_debug;
								return $error_mesage;		
							}
							if($key->proposed_type=='Loan')
							{
								$loan_ac = $key->loan_ac;
								$org_loan_ac = "";
								if(strlen($loan_ac)==16)
								{
									$cif = substr($loan_ac,5,8);
								}
								else if(strlen($loan_ac)==13)
								{
									$cif = substr($loan_ac,1,8);
								}
								else
								{
									$cif = "";
								}
							}
							else
							{
								$loan_ac = substr($key->loan_ac,0,6).'******'.substr($key->loan_ac,12,16);
								$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$key->loan_ac);
								$cif = "";
							}
							$array = array(
					           'proposed_type' =>$key->proposed_type,
					           'loan_ac' =>$loan_ac,
					           'cif' =>$cif,
					           'org_loan_ac' =>$org_loan_ac,
					           'ac_name' =>$key->ac_name,
					           'case_number' =>$key->case_number,
					           'req_type' =>$key->req_type_id_sub,
					           'region' =>$key->region_id,
					           'district' =>$key->district_id,
					           'loan_segment' =>$key->loan_segment_code,
					           'vendor_id' => $key->paper_vendor_id,
					           'paper_id' => $key->paper_id,
					           'txrn_dt' =>$key->publication_date,
					           'amount' =>$key->publication_amount,
					           'vendor_type' =>2,
					           'paper_bill_vendor_type' => 'Vendor',
					           'memo_sts' =>88,
					           'migration_sts' =>1,
					           'migration_id' =>$insert_idss,
					        );
							array_push($data,$array);
						}

						$this->db->insert_batch('cost_details', $data);
					}
			}
		}
		else if($migration_type==6)//For High Court Data
		{
			$counter = 0;
			$str="SELECT COUNT(session_id) AS total FROM data_migration_high_court WHERE session_id='".$this->session->userdata['ast_user']['user_id']."'";
			$total_rows = $this->db->query($str)->row();
			if(!empty($total_rows) && $total_rows->total>0)
			{
				$array = array(
		            'total_rows'=>$total_rows->total,
		            'e_by'=>$this->session->userdata['ast_user']['user_id'],
		            'e_dt'=>date('Y-m-d H:i:s'),
		            'module_name'=>'High Court Data Migration',
		            'file_name'=>$new_name
		        );
		        $this->db->insert('data_migration_history', $array);
				$insert_idss = $this->db->insert_id();
				$limit_counter = $total_rows->total;
				$ini_limit=300;
				// for ($i=0; $i <=$limit_counter ; $i++) { 
					
				// }
				$row = $this->db->query("SELECT c.*,dv.id as division_id, cat.id as case_category_id, ct.id as case_type_id,ls.code as loan_segment_code,
						d.id as district_id,b.id as bench_id,adm.id as deposit_money_id,
						ldo.id as lower_court_dealing_officer_id,do.id as dealing_officer_id,cs.id as case_sts_id
						FROM data_migration_high_court as c 
						LEFT OUTER JOIN ref_hc_division dv on(c.division=dv.name AND dv.data_status=1)
						LEFT OUTER JOIN ref_hc_case_category cat on(c.case_category=cat.name AND cat.data_status=1 AND dv.id=cat.hc_division)
						LEFT OUTER JOIN ref_hc_case_type ct on(c.case_type=ct.name AND ct.data_status=1 AND dv.id=ct.hc_division AND cat.id=ct.hc_category)
						LEFT OUTER JOIN ref_hc_case_status cs on(c.last_status=cs.name AND cs.data_status=1)
						LEFT OUTER JOIN ref_legal_district d on(c.district=d.name AND d.data_status=1)
						LEFT OUTER JOIN ref_hc_bench b on(c.bench_name=b.name AND c.bench_number=b.bench_number AND b.data_status=1 AND c.bench_name!='')
						LEFT OUTER JOIN ref_loan_segment ls on(c.protfolio=ls.name AND ls.data_status=1)
						LEFT OUTER JOIN users_info do on(c.dealing_officer_pin=do.pin AND do.data_status=1)
						LEFT OUTER JOIN users_info ldo on(c.lower_court_dealing_officer_pin=ldo.pin AND ldo.data_status=1)
						LEFT OUTER JOIN ref_appeal_deposit_money adm on(c.deposit_money=adm.name AND adm.data_status=1)
						WHERE c.session_id='".$this->session->userdata['ast_user']['user_id']."' ORDER BY c.id ASC")->result();
						//$i=($i-1)+$ini_limit;//set the new limit +300
					
						$data=array();
						$history=array();
						$status=array();
						$unique = $insert_idss.time();
						if(!empty($row))
						{
							foreach ($row as $k=> $key) 
							{
								$row_counter++;
								$check = $this->error_mesage($row_counter,5,$key->division_id,'Division');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,14,$key->case_category_id,'Case Category');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,8,$key->hc_matter_type,'High Court Matter Type');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,1,$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								
								
								$check = $this->error_mesage($row_counter,5,$key->ac_name,'Loan AC Name');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->loan_segment_code,'Loan Segment',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,15,$key->case_type_id,'Case Type',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,5,$key->case_no,'Case No');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								// $check = $this->error_mesage($row_counter,9,$key->case_no,'Case No');
								// if($check!='')
								// {
								// 	array_push($error_mesage,$check);
								// }
								$check = $this->error_mesage($row_counter,5,$key->case_claim_amount,'Case Claim Amount');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,6,$key->case_claim_amount,'Case Claim Amount');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,2,$key->filling_date,'Filling Date',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->district_id,'District',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,5,$key->last_activities,'Last Activities');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->case_sts_id,'Last Status',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,5,$key->present_cause_of_action,'Present Cause Of Action');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								if($key->bench_name!=''){
									$check = $this->error_mesage($row_counter,4,$key->bench_id,'Bench Name',1);
									if($check!='')
									{
										array_push($error_mesage,$check);
									}
								}
								
								$check = $this->error_mesage($row_counter,10,$key->closing,'Account closing');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}

								$check = $this->error_mesage($row_counter,12,$key->dealing_officer_id,'Dealing Officer',1,$key->dealing_officer_pin,$key->dealing_officer);
								if($check!='' && $check=='CREATE')
								{
									$pass = 'LMS@123456';
									$pass2 = $this->User_model->encrypt($pass); 
									$user_data = array(
												'user_id' => 'DM'.$key->dealing_officer_pin,
												'pin' => $key->dealing_officer_pin,
												'name' => $key->dealing_officer,
												'password_log' => $pass2,
												'lock_status' => 1,
											);
									$user_data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
									$user_data['entry_datetime'] = date('Y-m-d H:i:s');
									$user_data['verify_status'] = 1;
									if(empty($dm_user_array))
									{
										array_push($dm_user_array,$user_data);
									}
									else if ($this->searchforpin($key->dealing_officer_pin,$dm_user_array)=='') {
										array_push($dm_user_array,$user_data);
									}
									$dealing_officer_id = '';
								}
								else if($check!='')
								{
									array_push($error_mesage,$check);
								}
								else
								{
									$dealing_officer_id = $key->dealing_officer_id;
								}

								//echo $key->lower_court_dealing_officer_pin;

								if($key->lower_court_dealing_officer_pin!='' && $key->lower_court_dealing_officer_pin!='0'){
									$check = $this->error_mesage($row_counter,12,$key->lower_court_dealing_officer_id,'Lower Court Dealing Officer',0,$key->lower_court_dealing_officer_pin,$key->lower_court_dealing_officer);
									if($check!='' && $check=='CREATE')
									{
										$pass = 'LMS@123456';
										$pass2 = $this->User_model->encrypt($pass); 
										$user_data = array(
													'user_id' => 'DM'.$key->lower_court_dealing_officer_pin,
													'pin' => $key->lower_court_dealing_officer_pin,
													'name' => $key->lower_court_dealing_officer,
													'password_log' => $pass2,
													'lock_status' => 1,
												);
										$user_data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
										$user_data['entry_datetime'] = date('Y-m-d H:i:s');
										$user_data['verify_status'] = 1;
										if(empty($dm_user_array))
										{
											array_push($dm_user_array,$user_data);
										}
										else if ($this->searchforpin($key->lower_court_dealing_officer_pin,$dm_user_array)=='') {
											array_push($dm_user_array,$user_data);
										}
										$lower_court_dealing_officer_id = '';
									}
									else if($check!='')
									{
										array_push($error_mesage,$check);
									}
									else
									{
										$lower_court_dealing_officer_id = $key->lower_court_dealing_officer_id;
									}
								}

								$check = $this->error_mesage($row_counter,4,$key->deposit_money_id,'50% Deposit Money',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,2,$key->request_recieve_date,'Request Receive Date',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								if(!empty($error_mesage))
								{
									$this->db->trans_rollback();
									$this->db->db_debug = $db_debug;
									return $error_mesage;		
								}
								if($key->proposed_type=='Loan')
								{
									$loan_ac = $key->loan_ac;
									$org_loan_ac = "";
								}
								else
								{
									$loan_ac = substr($key->loan_ac,0,6).'******'.substr($key->loan_ac,12,16);
									$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$key->loan_ac);
								}
								if($key->closing=='Yes')
								{
									$closing = 1;
								}
								else
								{
									$closing = 2;
								}
								$array = array(
						           'proposed_type' =>$key->proposed_type,
						           'hc_matter_type' =>$key->hc_matter_type,
						           'hc_division' =>$key->division_id,
						           'case_category' =>$key->case_category_id,
						           'ac_number' =>$loan_ac,
						           'org_ac_number' =>$org_loan_ac,
						           'ac_name' =>$key->ac_name,
						           'portfolio' =>$key->loan_segment_code,
						           'case_type' =>$key->case_type_id,
						           'case_no' =>$key->case_no,
						           'case_claim' =>$key->case_claim_amount,
						           'name_dist' =>$key->district_id,
						           'filing_date' =>$key->filling_date,
						           'last_act' => $key->last_activities,
						           'present_status' => $key->case_sts_id,
						           'present_cause_action' => $key->present_cause_of_action,
						           'hc_bench' =>$key->bench_id,
						           'remarks' =>$key->remarks,
						           'ac_closing_status' =>$closing,
						           'hc_dealing_officer' =>$dealing_officer_id,
						           'hc_dealing_officer_pin' =>$key->dealing_officer_pin,
						           'deposit_am_50' =>$key->deposit_money_id,
						           'file_receive_date' =>$key->request_recieve_date,
						           'verify' =>38,
						           'v_sts' =>38,
						           'sts' => 1,
						           'final_sts' =>1,
						           'migration_sts' =>1,
						           'migration_id' =>$insert_idss,
						           'unique_id' =>$unique.$k,
						        );
						        if($key->lower_court_dealing_officer_pin!='' && $key->lower_court_dealing_officer_pin!='0'){
						        	$array['lower_dealing_officer']=$lower_court_dealing_officer_id;
						        	$array['lower_dealing_officer_pin']=$key->lower_court_dealing_officer_pin;
						        	$array['lower_dealing_officer_str']=NULL;
						        }else{
						        	$array['lower_dealing_officer_str']=$key->lower_court_dealing_officer;
						        	$array['lower_dealing_officer']=NULL;
						        	$array['lower_dealing_officer_pin']=NULL;
						        }
						        //$this->db->insert('hc_matter', $array);
						        //echo $this->db->last_query();exit;
						        //$hc_id = $this->db->insert_id();
						        	//'hc_matter_id'=>$hc_id,
						        $hst = array(
						        	'present_status'=>$key->case_sts_id,
						        	'last_act'=>$key->last_activities,
						        	'hc_bench'=>$key->bench_id,
						        	'final_sts' =>1,
						        	'v_sts'=>38,
						        	'sts'=>1,
						        	'migration_sts' =>1,
						           	'migration_id' =>$insert_idss,
						           	'unique_id' =>$unique.$k,
						        );
						        $status_arr = array(
						        	'migration_sts' =>1,
						           	'migration_id' =>$insert_idss,
						           	'unique_id' =>$unique.$k,
						        );
						        //$this->db->insert('hc_matter_hst', $hst);
						        //$this->db->insert('hc_matter_status', array('hc_matter_id'=>$hc_id));
								array_push($data,$array);
								array_push($history,$hst);
								array_push($status,$status_arr);
							}
							$this->db->insert_batch('hc_matter', $data);
							$this->db->insert_batch('hc_matter_hst', $history);
							$this->db->insert_batch('hc_matter_status', $status);

							$this->db->query("UPDATE hc_matter_hst s,hc_matter m SET s.hc_matter_id=m.id WHERE s.migration_id=m.migration_id AND s.unique_id=m.unique_id");
							$this->db->query("UPDATE hc_matter_status s,hc_matter m SET s.hc_matter_id=m.id WHERE s.migration_id=m.migration_id AND s.unique_id=m.unique_id");
							if(!empty($dm_user_array))
							{
								$this->db->insert_batch('users_info', $dm_user_array);
								$this->db->query("UPDATE hc_matter s,users_info u SET s.hc_dealing_officer=u.id WHERE s.hc_dealing_officer_pin=u.pin AND (s.hc_dealing_officer='' OR s.hc_dealing_officer IS NULL)");
								$this->db->query("UPDATE hc_matter s,users_info u SET s.lower_dealing_officer=u.id WHERE s.lower_dealing_officer_pin=u.pin AND (s.lower_dealing_officer='' OR s.lower_dealing_officer IS NULL)");
							}
							
						}
			}
		}
		else if($migration_type==7)//For Legal Cost Data Migration
		{
			$counter = 0;
			$str="SELECT COUNT(session_id) AS total FROM data_migration_legal_cost WHERE session_id='".$this->session->userdata['ast_user']['user_id']."'";
			$total_rows = $this->db->query($str)->row();
			if(!empty($total_rows) && $total_rows->total>0)
			{
				$array = array(
		            'total_rows'=>$total_rows->total,
		            'e_by'=>$this->session->userdata['ast_user']['user_id'],
		            'e_dt'=>date('Y-m-d H:i:s'),
		            'module_name'=>'Legal Cost Data Migration',
		            'file_name'=>$new_name
		        );
		        $this->db->insert('data_migration_history', $array);
				$insert_idss = $this->db->insert_id();
				$limit_counter = $total_rows->total;
				$ini_limit=300;
				// for ($i=0; $i <=$limit_counter ; $i++) { 
					
				// }
				$row = $this->db->query("SELECT c.*,l.code as loan_segment_code,rq.id as req_type_id,
							r.id as region_id,csp.id as case_sts_prev_dt_id,
							d.id as district_id
						FROM data_migration_legal_cost as c 
						LEFT OUTER JOIN ref_loan_segment l on(c.protfolio=l.name AND l.data_status=1)
						LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.name AND rq.data_status=1)
						LEFT OUTER JOIN ref_case_sts csp on(c.previous_case_sts=csp.name AND csp.data_status=1)
						LEFT OUTER JOIN ref_legal_region r on(c.region=r.name AND r.data_status=1)
						LEFT OUTER JOIN ref_legal_district d on(c.district=d.name AND d.data_status=1)
						WHERE c.session_id='".$this->session->userdata['ast_user']['user_id']."' ORDER BY c.id ASC")->result();
				
						//$i=($i-1)+$ini_limit;//set the new limit +300
						$data=array();
						if(!empty($row))
						{
							foreach ($row as $key) 
							{
								$row_counter++;
								$counter++;
								if($counter>=100)
								{
									$this->db->insert_batch('legal_cost', $data);
									$data=array();
									$counter=0;
								}
								$check = $this->error_mesage($row_counter,1,$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								
								$check = $this->error_mesage($row_counter,3,$key->loan_ac,'Loan AC Number',$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->req_type_id,'Requisition Type');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,2,$key->filling_date,'Filling Date',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,5,$key->case_number,'Case Number');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,5,$key->case_claim_amount,'Case Claim Amount');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,6,$key->case_claim_amount,'Case Claim Amount');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,5,$key->legal_cost,'Legal Cost');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,6,$key->legal_cost,'Legal Cost');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,2,$key->previous_date,'Previous Date',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->case_sts_prev_dt_id,'Case Status Previous Date',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->district_id,'District',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->region_id,'Region',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->loan_segment_code,'Loan Segment',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}

								if(!empty($error_mesage))
								{
									$this->db->trans_rollback();
									$this->db->db_debug = $db_debug;
									return $error_mesage;		
								}
								if($key->proposed_type=='Loan')
								{
									$loan_ac = $key->loan_ac;
									$org_loan_ac = "";
									if(strlen($loan_ac)==16)
									{
										$cif = substr($loan_ac,5,8);
									}
									else if(strlen($loan_ac)==13)
									{
										$cif = substr($loan_ac,1,8);
									}
									else
									{
										$cif = "";
									}
								}
								else
								{
									$loan_ac = substr($key->loan_ac,0,6).'******'.substr($key->loan_ac,12,16);
									$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$key->loan_ac);
									$cif = "";
								}
								$array = array(
						           'proposed_type' =>$key->proposed_type,
						           'loan_ac' =>$loan_ac,
						           'cif' =>$cif,
						           'org_loan_ac' =>$org_loan_ac,
						           'ac_name' =>$key->ac_name,
						           'req_type' =>$key->req_type_id,
						           'filling_date' =>$key->filling_date,
						           'case_number' =>$key->case_number,
						           'case_claim_amount' =>$key->case_claim_amount,
						           'previous_date' =>$key->previous_date,
						           'previous_case_sts' =>$key->case_sts_prev_dt_id,
						           'district' =>$key->district_id,
						           'region' =>$key->region_id,
						           'loan_segment' =>$key->loan_segment_code,
						           'legal_cost' =>$key->legal_cost,
						           'migration_id' =>$insert_idss,
						           'activities' =>$key->activities,
						        );
								array_push($data,$array);
							}

							$this->db->insert_batch('legal_cost', $data);
						}
			}
		}
		else if($migration_type==9)//For Final LN Cost Data Migration
		{
			$counter = 0;
			$str="SELECT COUNT(session_id) AS total FROM data_migration_final_ln_cost WHERE session_id='".$this->session->userdata['ast_user']['user_id']."'";
			$total_rows = $this->db->query($str)->row();
			if(!empty($total_rows) && $total_rows->total>0)
			{
				$array = array(
		            'total_rows'=>$total_rows->total,
		            'e_by'=>$this->session->userdata['ast_user']['user_id'],
		            'e_dt'=>date('Y-m-d H:i:s'),
		            'module_name'=>'Final LN Cost Data Migration',
		            'file_name'=>$new_name
		        );
		        $this->db->insert('data_migration_history', $array);
				$insert_idss = $this->db->insert_id();
				$row = $this->db->query("SELECT c.*,ls.code as loan_segment_code,rq.id as req_type_id_sub,l.id as lawyer_id,d.id as district_id,
						r.id as region_id,IF(c.req_type_id=2,sc2.id,sc.id) as activities_id
						FROM data_migration_final_ln_cost as c 
						LEFT OUTER JOIN ref_loan_segment ls on(c.loan_segment=ls.name AND ls.data_status=1)
						LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.name AND rq.data_status=1)
						LEFT OUTER JOIN ref_schedule_charges_ni sc on(sc.apv_sts<>1 AND c.activities_name=sc.name AND sc.data_status=1 AND c.req_type_id IN(1,3,4,5) AND c.cost_type='Lawyer Bill' AND sc.id=1)
						LEFT OUTER JOIN ref_schedule_charges_ara sc2 on(c.activities_name=sc2.name AND sc2.data_status=1 AND c.req_type_id=2 AND c.cost_type='Lawyer Bill' AND sc2.id=1)
						LEFT OUTER JOIN ref_legal_region r on(c.region=r.name AND r.data_status=1)
						LEFT OUTER JOIN ref_lawyer l on(c.lawyer_name=l.name AND l.data_status=1 AND l.district_name=c.unit)
						LEFT OUTER JOIN ref_legal_district d on(c.unit=d.name AND d.data_status=1)
						WHERE c.session_id='".$this->session->userdata['ast_user']['user_id']."' ORDER BY c.id ASC")->result();
						$data=array();
						if(!empty($row))
						{
							foreach ($row as $key) 
							{
								$row_counter++;
								$counter++;
								if($counter>=100)
								{
									$this->db->insert_batch('cost_details', $data);
									$data=array();
									$counter=0;
								}
								$check = $this->error_mesage($row_counter,1,$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								
								$check = $this->error_mesage($row_counter,3,$key->loan_ac,'Loan AC Number(Cost Data)',$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->req_type_id_sub,'Requisition Type(Cost Data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->lawyer_id,'Lawyer Name(Cost Data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,2,$key->date_of_bill,'Bill Date(Cost Data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->district_id,'District(Cost Data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->region_id,'Region(Cost Data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->activities_id,'Activities(Cost Data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,5,$key->amount,'Amount(Cost Data)');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,6,$key->amount,'Amount(Cost Data)');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,13,$key->cost_type,'Cost Type',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->loan_segment_code,'Loan Segment',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$str_where=" AND s.txrn_dt='".$key->date_of_bill."'";
								if($key->proposed_type=='Loan')
								{
									$str_where.=' AND s.loan_ac="'.$key->loan_ac.'"';
								}
								else
								{
									$str_where.=' AND s.org_loan_ac="'.$this->Common_model->stringEncryption('encrypt',$key->loan_ac).'"';
								}
								$row = $this->db->query("SELECT s.id FROM cost_details s WHERE s.vendor_type=1 AND s.activities_id=1 AND s.vendor_id='".$key->lawyer_id."' AND s.district='".$key->district_id."' AND s.req_type='".$key->req_type_id_sub."' AND s.proposed_type='".$key->proposed_type."' ".$str_where."")->row();
								if(!empty($row))
								{
									array_push($error_mesage,"Cost Data Already Exists($row_counter)");
								}
								if(!empty($error_mesage))
								{
									$this->db->trans_rollback();
									$this->db->db_debug = $db_debug;
									return $error_mesage;		
								}
								if($key->proposed_type=='Loan')
								{
									$loan_ac = $key->loan_ac;
									$org_loan_ac = "";
									if(strlen($loan_ac)==16)
									{
										$cif = substr($loan_ac,5,8);
									}
									else if(strlen($loan_ac)==13)
									{
										$cif = substr($loan_ac,1,8);
									}
									else
									{
										$cif = "";
									}
								}
								else
								{
									$loan_ac = substr($key->loan_ac,0,6).'******'.substr($key->loan_ac,12,16);
									$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$key->loan_ac);
									$cif = "";
								}
								if($key->cost_type=='Court Fee')
								{
									$vendor_type = 4;
								}
								else
								{
									$vendor_type = 1;
								}
								$array = array(
								   'module_name' =>'suit_file',
								   'main_table_name' =>'suit_filling_info',
						           'proposed_type' =>$key->proposed_type,
						           'loan_ac' =>$loan_ac,
						           'cif' =>$cif,
						           'org_loan_ac' =>$org_loan_ac,
						           'ac_name' =>$key->ac_name,
						           'req_type' =>$key->req_type_id_sub,
						           'region' =>$key->region_id,
						           'district' =>$key->district_id,
						           'vendor_id' =>$key->lawyer_id,
						           'activities_id' =>$key->activities_id,
						           'expense_remarks' =>$key->remarks,
						           'loan_segment' =>$key->loan_segment_code,
						           'txrn_dt' =>$key->date_of_bill,
						           'amount' =>$key->amount,
						           'vendor_type' =>$vendor_type,
						           'migration_sts' =>1,
						           'migration_id' =>$insert_idss,
						        );
								array_push($data,$array);
							}

							$this->db->insert_batch('cost_details', $data);
						}
			}
		}
		else if($migration_type==8)//For Case File with cost data Migration
		{
			$counter = 0;
			$str="SELECT COUNT(session_id) AS total FROM data_migration_case_file_new WHERE session_id='".$this->session->userdata['ast_user']['user_id']."'";
			$total_rows = $this->db->query($str)->row();
			if(!empty($total_rows) && $total_rows->total>0)
			{
				$from = FCPATH.'temp_upload_file/dm_file_case_'.$this->session->userdata['ast_user']['user_id'].'_'.$migration_type.'.csv';
				$new_name = 'dm_file_case_'.$this->session->userdata['ast_user']['user_id'].'_'.$migration_type.time().'.csv';
				$to = FCPATH.'dm_files/'.$new_name;

				$suit_data_migration_sts=1;
				$array = array(
		            'total_rows'=>$total_rows->total,
		            'e_by'=>$this->session->userdata['ast_user']['user_id'],
		            'e_dt'=>date('Y-m-d H:i:s'),
		            'module_name'=>'Case File Data Migration',
		            'file_name'=>$new_name
		        );
		        $this->db->insert('data_migration_history', $array);
				$insert_idss = $this->db->insert_id();
				$limit_counter = $total_rows->total;
				$ini_limit=300;
				// for ($i=0; $i <=$limit_counter ; $i++) { 
					
				// }
				$row = $this->db->query("SELECT c.*,l.code as loan_segment_code,rq.id as req_type_id,
							t.id as territory_id,r.id as region_id,csp.id as case_sts_prev_dt_id,IF(c.req_type='ARA-2003',aca.id,acn.id) as act_prev_dt_id,
							csn.id as case_sts_next_dt_id,pf.id as filling_plaintiff_id,
							prf.id as present_plaintiff_id,cdo.id as case_deal_officer_id,
							lw.id as lawyer_id,pc.id as prev_court_id,prc.id as present_court_name,
							d.id as district_id,cn.id as case_name_id,fr.id as final_remarks_id
						FROM data_migration_case_file_new as c 
						LEFT OUTER JOIN ref_loan_segment l on(c.protfolio=l.name AND l.data_status=1)
						LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.name AND rq.data_status=1)
						LEFT OUTER JOIN ref_case_name cn on(c.case_name=cn.name AND cn.data_status=1)
						LEFT OUTER JOIN ref_case_sts csp on(c.case_sts_prev_dt=csp.name AND csp.data_status=1)
						LEFT OUTER JOIN ref_schedule_charges_ara aca on(c.act_prev_dt=aca.name AND aca.data_status=1 AND c.req_type='ARA-2003' AND (aca.aurtho_jari_sts=0 OR aca.aurtho_jari_sts IS NULL))
						LEFT OUTER JOIN ref_schedule_charges_ni acn on(acn.apv_sts<>1 AND c.act_prev_dt=acn.name AND acn.data_status=1 AND c.req_type!='ARA-2003')
						LEFT OUTER JOIN ref_case_sts csn on(c.case_sts_next_dt=csn.name AND csn.data_status=1)
						LEFT OUTER JOIN ref_territory t on(c.territory=t.name AND t.data_status=1)
						LEFT OUTER JOIN ref_legal_region r on(c.region=r.name AND r.data_status=1)
						LEFT OUTER JOIN ref_legal_district d on(c.district=d.name AND d.data_status=1)
						LEFT OUTER JOIN users_info pf on(c.filling_plaintiff=pf.pin AND pf.data_status=1)
						LEFT OUTER JOIN users_info prf on(c.present_plaintiff=prf.pin AND prf.data_status=1)
						LEFT OUTER JOIN users_info cdo on(c.case_deal_officer=cdo.pin AND cdo.data_status=1)
						LEFT OUTER JOIN ref_lawyer lw on(c.lawyer_name=lw.name AND c.region=lw.region_name AND lw.data_status=1)
						LEFT OUTER JOIN ref_court pc on(c.prev_court=pc.name AND c.district=pc.district_name AND pc.data_status=1)
						LEFT OUTER JOIN ref_court prc on(c.present_court=prc.name AND c.district=prc.district_name AND prc.data_status=1)
						LEFT OUTER JOIN ref_final_remarks fr on(c.final_status=fr.name AND fr.data_status=1)
						WHERE c.session_id='".$this->session->userdata['ast_user']['user_id']."' ORDER BY c.id ASC")->result();
						//$i=($i-1)+$ini_limit;//set the new limit +300
						$data=array();
						if(!empty($row))
						{
							foreach ($row as $key) 
							{
								$row_counter++;
								$counter++;
								if($counter>=100)
								{
									$this->db->insert_batch('suit_filling_info', $data);
									$data=array();
									$counter=0;
								}
								$check = $this->error_mesage($row_counter,1,$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								
								$check = $this->error_mesage($row_counter,3,$key->loan_ac,'Loan AC Number(case data)',$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->req_type_id,'Requisition Type(case data)');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->case_name_id,'Case Name(case data)',0,$key->case_name);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,2,$key->filling_date,'Filling Date(case data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,5,$key->case_number,'Case Number(case data)');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,5,$key->case_claim_amount,'Case Claim Amount(case data)');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,6,$key->case_claim_amount,'Case Claim Amount(case data)');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,2,$key->previous_dt,'Previous Date(case data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->case_sts_prev_dt_id,'Case Status Previous Date(case data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->act_prev_dt_id,'Activities Previous Date(case data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,2,$key->next_dt,'Next Date(case data)',0);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->case_sts_next_dt_id,'Case Status Next Date(case data)',0,$key->case_sts_next_dt);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,12,$key->filling_plaintiff_id,'Filling Plaintiff(case data)',1,$key->filling_plaintiff,$key->filling_plaintiff_name);
								if($check!='' && $check=='CREATE')
								{
									$pass = 'LMS@123456';
									$pass2 = $this->User_model->encrypt($pass); 
									$user_data = array(
												'user_id' => 'DM'.$key->filling_plaintiff,
												'pin' => $key->filling_plaintiff,
												'name' => $key->filling_plaintiff_name,
												'password_log' => $pass2,
												'lock_status' => 1,
											);
									$user_data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
									$user_data['entry_datetime'] = date('Y-m-d H:i:s');
									$user_data['verify_status'] = 1;
									if(empty($dm_user_array))
									{
										array_push($dm_user_array,$user_data);
									}
									else if ($this->searchforpin($key->filling_plaintiff,$dm_user_array)=='') {
										array_push($dm_user_array,$user_data);
									}
									$filling_plaintiff_id = '';
								}
								else if($check!='')
								{
									array_push($error_mesage,$check);
								}
								else
								{
									$filling_plaintiff_id = $key->filling_plaintiff_id;
								}
								$check = $this->error_mesage($row_counter,12,$key->present_plaintiff_id,'Present Plaintiff(case data)',1,$key->present_plaintiff,$key->present_plaintiff_name);
								if($check!='' && $check=='CREATE')
								{
									$pass = 'LMS@123456';
									$pass2 = $this->User_model->encrypt($pass); 
									$user_data = array(
												'user_id' => 'DM'.$key->present_plaintiff,
												'pin' => $key->present_plaintiff,
												'name' => $key->present_plaintiff_name,
												'password_log' => $pass2,
												'lock_status' => 1,
											);
									$user_data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
									$user_data['entry_datetime'] = date('Y-m-d H:i:s');
									$user_data['verify_status'] = 1;
									if(empty($dm_user_array))
									{
										array_push($dm_user_array,$user_data);
									}
									else if ($this->searchforpin($key->present_plaintiff,$dm_user_array)=='') {
										array_push($dm_user_array,$user_data);
									}
									$present_plaintiff_id = '';
								}
								else if($check!='')
								{
									array_push($error_mesage,$check);
								}
								else
								{
									$present_plaintiff_id = $key->present_plaintiff_id;
								}
								$check = $this->error_mesage($row_counter,12,$key->case_deal_officer_id,'Case Deal Officer(case data)',1,$key->case_deal_officer,$key->case_deal_officer_name);
								if($check!='' && $check=='CREATE')
								{
									$pass = 'LMS@123456';
									$pass2 = $this->User_model->encrypt($pass); 
									$user_data = array(
												'user_id' => 'DM'.$key->case_deal_officer,
												'pin' => $key->case_deal_officer,
												'name' => $key->case_deal_officer_name,
												'password_log' => $pass2,
												'lock_status' => 1,
											);
									$user_data['entry_by'] = $this->session->userdata['ast_user']['user_id'];
									$user_data['entry_datetime'] = date('Y-m-d H:i:s');
									$user_data['verify_status'] = 1;
									if(empty($dm_user_array))
									{
										array_push($dm_user_array,$user_data);
									}
									else if ($this->searchforpin($key->case_deal_officer,$dm_user_array)=='') {
										array_push($dm_user_array,$user_data);
									}
									$case_deal_officer_id = '';
								}
								else if($check!='')
								{
									array_push($error_mesage,$check);
								}
								else
								{
									$case_deal_officer_id = $key->case_deal_officer_id;
								}
								$check = $this->error_mesage($row_counter,4,$key->lawyer_id,'Lawyer Name(case data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->prev_court_id,'Previous Court(case data)',0,$key->prev_court);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->present_court_name,'Present Court(case data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->territory_id,'Territory(case data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->district_id,'District(case data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->region_id,'Region(case data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->loan_segment_code,'Loan Segment(case data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->final_remarks_id,'Final Status(case data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}

								if(!empty($error_mesage))
								{
									$this->db->trans_rollback();
									$this->db->db_debug = $db_debug;
									return $error_mesage;		
								}
								if($key->proposed_type=='Loan')
								{
									$loan_ac = $key->loan_ac;
									$org_loan_ac = "";
									if(strlen($loan_ac)==16)
									{
										$cif = substr($loan_ac,5,8);
									}
									else if(strlen($loan_ac)==13)
									{
										$cif = substr($loan_ac,1,8);
									}
									else
									{
										$cif = "";
									}
								}
								else
								{
									$loan_ac = substr($key->loan_ac,0,6).'******'.substr($key->loan_ac,12,16);
									$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$key->loan_ac);
									$cif = "";
								}
								if($key->final_remarks_id==1)
								{
									$suit_sts = 75;
								}
								else
								{
									$suit_sts = 76;
								}

								if($key->next_dt=='Yet To Fix')
								{
									$next_dt_sts = 0;
								}
								else
								{
									$next_dt_sts = 1;
								}
								$array = array(
						           'proposed_type' =>$key->proposed_type,
						           'loan_ac' =>$loan_ac,
						           'cif' =>$cif,
						           'org_loan_ac' =>$org_loan_ac,
						           'ac_name' =>$key->ac_name,
						           'req_type' =>$key->req_type_id,
						           'case_name' =>$key->case_name_id,
						           'prev_filling_date' =>$key->prev_filling_date,
						           'filling_date' =>$key->filling_date,
						           'case_number' =>$key->case_number,
						           'case_claim_amount' =>$key->case_claim_amount,
						           'prev_date' =>$key->previous_dt,
						           'case_sts_prev_dt' =>$key->case_sts_prev_dt_id,
						           'act_prev_date' =>$key->act_prev_dt_id,
						           'next_dt_sts' =>$next_dt_sts,
						           'next_date' =>$key->next_dt,
						           'case_sts_next_dt' =>$key->case_sts_next_dt_id,
						           'remarks_prev_date' =>$key->remarks_prev_dt,
						           //'prev_plaintiff' =>$filling_plaintiff_id,
						           'filling_plaintiff' =>$filling_plaintiff_id,
						           'filling_plaintiff_pin' =>$key->filling_plaintiff,
						           'present_plaintiff' =>$present_plaintiff_id,
						           'present_plaintiff_pin' =>$key->filling_plaintiff,
						           'case_deal_officer' =>$case_deal_officer_id,
						           'case_deal_officer_pin' =>$key->case_deal_officer,
						           'prest_lawyer_name' =>$key->lawyer_id,
						           'prev_court_name' =>$key->prev_court_id,
						           'prest_court_name' =>$key->present_court_name,
						           'district' =>$key->district_id,
						           'cma_district' =>$key->district_id,
						           'region' =>$key->region_id,
						           'legal_region' =>$key->region_id,
						           'territory' =>$key->territory_id,
						           'loan_segment' =>$key->loan_segment_code,
						           'final_remarks' =>$key->final_remarks_id,
						           'suit_sts' =>$suit_sts,
					           		'remarks' =>$key->remarks,
						           'migration_sts' =>1,
						           'migration_id' =>$insert_idss,
						        );
								array_push($data,$array);
							}

							$this->db->insert_batch('suit_filling_info', $data);
							if(!empty($dm_user_array))
							{
								$this->db->insert_batch('users_info', $dm_user_array);
								$this->db->query("UPDATE suit_filling_info s,users_info u SET s.filling_plaintiff=u.id WHERE s.filling_plaintiff_pin=u.pin AND (s.filling_plaintiff='' OR s.filling_plaintiff IS NULL)");
								$this->db->query("UPDATE suit_filling_info s,users_info u SET s.present_plaintiff=u.id WHERE s.present_plaintiff_pin=u.pin AND (s.present_plaintiff='' OR s.present_plaintiff IS NULL)");
								$this->db->query("UPDATE suit_filling_info s,users_info u SET s.case_deal_officer=u.id WHERE s.case_deal_officer_pin=u.pin AND (s.case_deal_officer='' OR s.case_deal_officer IS NULL)");
							}
						}
				if (file_exists($from)) {
					rename($from, $to);
				}
			}
			$this->db->trans_commit();
			$this->db->trans_begin();
			$error_mesage = array();

			//For Cost Data Migration
			$counter = 0;
			$row_counter = 0;
			$str="SELECT COUNT(session_id) AS total FROM data_migration_case_file_cost WHERE session_id='".$this->session->userdata['ast_user']['user_id']."'";
			$total_rows = $this->db->query($str)->row();
			if(!empty($total_rows) && $total_rows->total>0)
			{
				$from = FCPATH.'temp_upload_file/dm_file_cost_'.$this->session->userdata['ast_user']['user_id'].'_'.$migration_type.'.csv';
				$new_name = 'dm_file_cost_'.$this->session->userdata['ast_user']['user_id'].'_'.$migration_type.time().'.csv';
				$to = FCPATH.'dm_files/'.$new_name;
				$array = array(
		            'total_rows'=>$total_rows->total,
		            'e_by'=>$this->session->userdata['ast_user']['user_id'],
		            'e_dt'=>date('Y-m-d H:i:s'),
		            'module_name'=>'Cost Data Migration For Case File',
		            'file_name'=>$new_name
		        );
		        $this->db->insert('data_migration_history', $array);
				$insert_idss = $this->db->insert_id();
				$limit_counter = $total_rows->total;
				$ini_limit=300;
				// for ($i=0; $i <=$limit_counter ; $i++) { 
					
				// }
				$row = $this->db->query("SELECT c.*,rq.id as req_type_id_sub,l.id as lawyer_id,d.id as district_id,
						r.id as region_id,IF(c.cost_type='Court Fee',sc3.id,IF(c.req_type_id=2,sc2.id,IF(c.req_type_id=1 or c.req_type_id=3,sc.id,''))) as activities_id
						FROM data_migration_case_file_cost as c 
						LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.name AND rq.data_status=1)
						LEFT OUTER JOIN ref_schedule_charges_ni sc on(sc.apv_sts<>1 AND c.activities_name=sc.name AND sc.data_status=1 AND (c.req_type_id=1 OR c.req_type_id=3) AND c.cost_type='Lawyer Bill')
						LEFT OUTER JOIN ref_schedule_charges_ara sc2 on(c.activities_name=sc2.name AND sc2.data_status=1 AND c.req_type_id=2 AND c.cost_type='Lawyer Bill' AND (sc2.aurtho_jari_sts=0 OR sc2.aurtho_jari_sts IS NULL))
						LEFT OUTER JOIN ref_court_fee_activities sc3 on(c.activities_name=sc3.name AND sc3.data_status=1  AND c.cost_type='Court Fee')
						LEFT OUTER JOIN ref_legal_region r on(c.region=r.name AND r.data_status=1)
						LEFT OUTER JOIN ref_lawyer l on(c.lawyer_name=l.name AND l.data_status=1 AND l.district_name=c.unit)
						LEFT OUTER JOIN ref_legal_district d on(c.unit=d.name AND d.data_status=1)
						WHERE c.session_id='".$this->session->userdata['ast_user']['user_id']."' ORDER BY c.id ASC")->result();
						$data=array();
						if(!empty($row))
						{
							foreach ($row as $key) 
							{
								$row_counter++;
								$counter++;
								if($counter>=100)
								{
									$this->db->insert_batch('cost_details', $data);
									$data=array();
									$counter=0;
								}
								$check = $this->error_mesage($row_counter,1,$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								
								$check = $this->error_mesage($row_counter,3,$key->loan_ac,'Loan AC Number(Cost Data)',$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->req_type_id_sub,'Requisition Type(Cost Data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->lawyer_id,'Lawyer Name(Cost Data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,2,$key->date_of_bill,'Bill Date(Cost Data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->district_id,'District(Cost Data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->region_id,'Region(Cost Data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->activities_id,'Activities(Cost Data)',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,5,$key->amount,'Amount(Cost Data)');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,6,$key->amount,'Amount(Cost Data)');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,5,$key->case_number,'Case Number(Cost Data)');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								else
								{
									$str_where="";
									if($key->proposed_type=='Loan')
									{
										$str_where.=' AND s.loan_ac="'.$key->loan_ac.'"';
									}
									else
									{
										$str_where.=' AND s.org_loan_ac="'.$this->Common_model->stringEncryption('encrypt',$key->loan_ac).'"';
									}
									$row = $this->db->query("SELECT s.id,s.loan_segment FROM suit_filling_info s WHERE s.sts<>0  AND s.case_number='".$key->case_number."' AND s.district='".$key->district_id."' AND s.req_type='".$key->req_type_id_sub."' AND s.proposed_type='".$key->proposed_type."' ".$str_where." LIMIT 1")->row();
									if(!empty($row))
									{
										$suit_id = $row->id;
										$loan_segment = $row->loan_segment;
									}
									else
									{
										array_push($error_mesage,"Case Number not matched at row number($row_counter) For Cost Data");
										$loan_segment = '';
									}
								}
								$check = $this->error_mesage($row_counter,13,$key->cost_type,'Cost Type',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								if(!empty($error_mesage))
								{
									if($suit_data_migration_sts==1)//when both suit data and cost data migrate
									{
										array_push($error_mesage," But Case File Data Migrated Successfully.Please Migrate Cost Data Again");
									}
									$this->db->trans_rollback();
									$this->db->db_debug = $db_debug;
									return $error_mesage;		
								}
								if($key->proposed_type=='Loan')
								{
									$loan_ac = $key->loan_ac;
									$org_loan_ac = "";
									if(strlen($loan_ac)==16)
									{
										$cif = substr($loan_ac,5,8);
									}
									else if(strlen($loan_ac)==13)
									{
										$cif = substr($loan_ac,1,8);
									}
									else
									{
										$cif = "";
									}
								}
								else
								{
									$loan_ac = substr($key->loan_ac,0,6).'******'.substr($key->loan_ac,12,16);
									$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$key->loan_ac);
									$cif = "";
								}
								if($key->cost_type=='Court Fee')
								{
									$vendor_type = 4;
								}
								else
								{
									$vendor_type = 1;
								}
								$array = array(
								   'module_name' =>'suit_file',
								   'main_table_name' =>'suit_filling_info',
								   'suit_id' =>$suit_id,
						           'proposed_type' =>$key->proposed_type,
						           'loan_ac' =>$loan_ac,
						           'cif' =>$cif,
						           'org_loan_ac' =>$org_loan_ac,
						           'ac_name' =>$key->ac_name,
						           'case_number' =>$key->case_number,
						           'req_type' =>$key->req_type_id_sub,
						           'region' =>$key->region_id,
						           'district' =>$key->district_id,
						           'vendor_id' =>$key->lawyer_id,
						           'activities_id' =>$key->activities_id,
						           'loan_segment' =>$loan_segment,
						           'txrn_dt' =>$key->date_of_bill,
						           'amount' =>$key->amount,
						           'vendor_type' =>$vendor_type,
						           'migration_sts' =>1,
						           'migration_id' =>$insert_idss,
						        );
								array_push($data,$array);
							}

							$this->db->insert_batch('cost_details', $data);
						}
				if (file_exists($from)) {
					rename($from, $to);
				}
				
			}
			

		}
		else if($migration_type==10)//For Auction Cost Data Migration
		{
			$counter = 0;
			$str="SELECT COUNT(session_id) AS total FROM data_migration_vendor_cost WHERE session_id='".$this->session->userdata['ast_user']['user_id']."'";
			$total_rows = $this->db->query($str)->row();
			if(!empty($total_rows) && $total_rows->total>0)
			{
				$array = array(
		            'total_rows'=>$total_rows->total,
		            'e_by'=>$this->session->userdata['ast_user']['user_id'],
		            'e_dt'=>date('Y-m-d H:i:s'),
		            'module_name'=>'Auction Cost Data Migration',
		            'file_name'=>$new_name
		        );
		        $this->db->insert('data_migration_history', $array);
				$insert_idss = $this->db->insert_id();
				$row = $this->db->query("SELECT c.*,ls.code as loan_segment_code,rq.id as req_type_id_sub,pv.id as vendor_id,p.id as paper_id,d.id as district_id,
						r.id as region_id,sc.id as activities_id
						FROM data_migration_vendor_cost as c 
						LEFT OUTER JOIN ref_loan_segment ls on(c.protfolio=ls.name AND ls.data_status=1)
						LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.name AND rq.data_status=1)
						LEFT OUTER JOIN ref_paper_bill_activities sc on(c.activities=sc.name AND sc.data_status=1)
						LEFT OUTER JOIN ref_legal_region r on(c.region=r.name AND r.data_status=1)
						LEFT OUTER JOIN ref_paper_vendor pv on(c.vendor_name=pv.name AND pv.data_status=1 AND c.vendor_type='Vendor')
						LEFT OUTER JOIN ref_paper p on(c.paper_name=p.name AND p.data_status=1)
						LEFT OUTER JOIN ref_legal_district d on(c.district=d.name AND d.data_status=1)
						WHERE c.session_id='".$this->session->userdata['ast_user']['user_id']."' ORDER BY c.id ASC")->result();
						$data=array();
						if(!empty($row))
						{
							foreach ($row as $key) 
							{
								$row_counter++;
								$counter++;
								if($counter>=100)
								{
									$this->db->insert_batch('vendor_cost', $data);
									$data=array();
									$counter=0;
								}
								$check = $this->error_mesage($row_counter,1,$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								
								$check = $this->error_mesage($row_counter,3,$key->loan_ac,'Loan AC Number',$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->req_type_id_sub,'Requisition Type',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								if(!($key->vendor_type=='Vendor' || $key->vendor_type=='Staff'))
								{
									array_push($error_mesage,'Invalid Vendor Type AT ('.$row_counter.')');
								}
								if($key->vendor_type=='Vendor')
								{
									$check = $this->error_mesage($row_counter,4,$key->vendor_id,'Vendor Name',1);
									if($check!='')
									{
										array_push($error_mesage,$check);
									}
								}
								$check = $this->error_mesage($row_counter,4,$key->paper_id,'Invalid Paper',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,2,$key->activities_date,'Activities Date',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->district_id,'District',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->region_id,'Region',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->activities_id,'Activities',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,5,$key->legal_cost,'Amount');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,6,$key->legal_cost,'Amount');
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->loan_segment_code,'Loan Segment',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$str_where="";
								if($key->proposed_type=='Loan')
								{
									$str_where.=' AND s.loan_ac="'.$key->loan_ac.'"';
								}
								else
								{
									$str_where.=' AND s.org_loan_ac="'.$this->Common_model->stringEncryption('encrypt',$key->loan_ac).'"';
								}
								
								if(!empty($error_mesage))
								{
									$this->db->trans_rollback();
									$this->db->db_debug = $db_debug;
									return $error_mesage;		
								}
								if($key->proposed_type=='Loan')
								{
									$loan_ac = $key->loan_ac;
									$org_loan_ac = "";
									if(strlen($loan_ac)==16)
									{
										$cif = substr($loan_ac,5,8);
									}
									else if(strlen($loan_ac)==13)
									{
										$cif = substr($loan_ac,1,8);
									}
									else
									{
										$cif = "";
									}
								}
								else
								{
									$loan_ac = substr($key->loan_ac,0,6).'******'.substr($key->loan_ac,12,16);
									$org_loan_ac = $this->Common_model->stringEncryption('encrypt',$key->loan_ac);
									$cif = "";
								}
								
								if($key->vendor_type=='Staff')
								{
									$vendor_name=$key->vendor_name;
								}
								else
								{
									$vendor_name="";
								}
								$array = array(
						           'proposed_type' =>$key->proposed_type,
						           'loan_ac' =>$loan_ac,
						           'cif' =>$cif,
						           'org_loan_ac' =>$org_loan_ac,
						           'ac_name' =>$key->ac_name,
						           'req_type' =>$key->req_type_id_sub,
						           'activities_date' =>$key->activities_date,
						           'case_number' =>$key->case_number,
						           'vendor_type' =>$key->vendor_type,
						           'vendor_id' =>$key->vendor_id,
						           'staff' =>$vendor_name,
						           'paper_name' =>$key->paper_id,
						           'region' =>$key->region_id,
						           'district' =>$key->district_id,
						           'protfolio' =>$key->loan_segment_code,
						           'legal_cost' =>$key->legal_cost,
						           'activities' =>$key->activities_id,
						           'bill_type' =>$key->bill_type,
						           'tin' =>$key->tin,
						           'bin' =>$key->bin,
						           'mousak' =>$key->mousak,
						           'bank_account' =>$key->bank_account,
						           'migration_id' =>$insert_idss,
						        );
								array_push($data,$array);
							}

							$this->db->insert_batch('vendor_cost', $data);
						}
			}
		}
		else if($migration_type=='bulk_reassing_file')//For bulk reassing file
		{
			$counter = 0;
			$str="SELECT COUNT(session_id) AS total FROM bulk_reassing_file_data WHERE session_id='".$this->session->userdata['ast_user']['user_id']."'";
			$total_rows = $this->db->query($str)->row();
			if(!empty($total_rows) && $total_rows->total>0)
			{
				$row = $this->db->query("SELECT c.*,rq.id as req_type_id_sub,d.id as district_id,dn.id as new_district_id,
						lr.id as region_id,pc.id as court_id,pf.id as deal_officer_id,lw.id lawyer_id,pc.id as court_id
						FROM bulk_reassing_file_data as c 
						LEFT OUTER JOIN ref_req_type rq on(c.req_type=rq.name AND rq.data_status=1)
						LEFT OUTER JOIN ref_legal_district d on(c.district=d.name AND d.data_status=1)
						LEFT OUTER JOIN ref_legal_district dn on(c.new_district_name=dn.name AND dn.data_status=1)
						LEFT OUTER JOIN ref_legal_region lr on(c.region=lr.name AND lr.data_status=1)
						LEFT OUTER JOIN ref_lawyer lw on(c.lawyer_name=lw.name AND c.region=lw.region_name AND lw.data_status=1)
						LEFT OUTER JOIN ref_court pc on(c.court_name=pc.name AND c.new_district_name=pc.district_name AND pc.data_status=1)
						LEFT OUTER JOIN users_info pf on(c.deal_officer=pf.pin AND pf.data_status=1)
						WHERE c.session_id='".$this->session->userdata['ast_user']['user_id']."' ORDER BY c.id ASC")->result();
						$data=array();
						if(!empty($row))
						{
							foreach ($row as $key) 
							{
								$row_counter++;
								$counter++;
								$check = $this->error_mesage($row_counter,1,$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								
								$check = $this->error_mesage($row_counter,3,$key->loan_ac,'Loan AC Number',$key->proposed_type);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->req_type_id_sub,'Requisition Type',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->district_id,'District',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->region_id,'Region',1);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->lawyer_id,'Lawyer',0,$key->lawyer_name);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->new_district_id,'New District',0,$key->new_district_name);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->court_id,'Court',0,$key->court_name);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$check = $this->error_mesage($row_counter,4,$key->deal_officer_id,'Case Deal Officer',0,$key->deal_officer);
								if($check!='')
								{
									array_push($error_mesage,$check);
								}
								$str_where="";
								if($key->proposed_type=='Loan')
								{
									$str_where.=' AND s.loan_ac="'.$key->loan_ac.'"';
								}
								else
								{
									$str_where.=' AND s.org_loan_ac="'.$this->Common_model->stringEncryption('encrypt',$key->loan_ac).'"';
								}
								$row = $this->db->query("SELECT s.id FROM suit_filling_info s WHERE s.sts<>0  AND s.case_number='".$key->case_number."' AND s.district='".$key->district_id."' AND s.req_type='".$key->req_type_id_sub."' AND s.proposed_type='".$key->proposed_type."' ".$str_where." LIMIT 1")->row();
								$suit_id=0;
								if(!empty($row))
								{
									$suit_id = $row->id;
								}
								else
								{
									$case_error = "Case Number not matched at row number(".($row_counter+1).")";
									array_push($error_mesage,$case_error);
								}
								if($key->deal_officer=='' && $key->lawyer_name=='' && $key->court_name=='')
								{
									$case_error = "please provide at least one change perameter at row number(".($row_counter+1).")";
									array_push($error_mesage,$case_error);
								}
								
								if(!empty($error_mesage))
								{
									$this->db->trans_rollback();
									$this->db->db_debug = $db_debug;
									return $error_mesage;		
								}
								
								$array = array(
						           'suit_id' =>$suit_id,
						           'deal_officer_id' =>$key->deal_officer_id,
						           'lawyer_id' =>$key->lawyer_id,
						           'court_id' =>$key->court_id
						        );
								array_push($data,$array);
							}
							for ($i=0; $i < count($data); $i++) { 
								$history_data = array('suit_id' => $data[$i]['suit_id'],'e_by'=> $this->session->userdata['ast_user']['user_id'], 'e_dt'=>date('Y-m-d H:i:s'));
					            $suit_data = $this->db->query("SELECT s.id,s.case_deal_officer,s.prest_court_name,s.prest_lawyer_name FROM suit_filling_info s WHERE s.id='".$data[$i]['suit_id']."' LIMIT 1")->row();
					            if(!empty($suit_data))
					            {
					            	if($data[$i]['deal_officer_id']!='')//when deal officer changed
						            {
						            	$history_data['pre_legal_user'] = $suit_data->case_deal_officer;
						                $history_data['prest_legal_user'] = $data[$i]['deal_officer_id'];
						            }
						            if($data[$i]['court_id']!='')//When Court Name Changed
						            {
						                $history_data['pre_court'] = $suit_data->prest_court_name;
						                $history_data['present_court'] = $data[$i]['court_id'];
						            }
						            if($data[$i]['lawyer_id']!='')//When Lawyer Name Changed
						            {
						                $history_data['pre_lawyer'] = $suit_data->prest_lawyer_name;
						                $history_data['present_lawyer'] = $data[$i]['lawyer_id'];
						            }
					            }
					            
					            $this->db->insert('cma_legal_user_change_history', $history_data);
					            $insert_idss = $this->db->insert_id();

					            $updated_suit_data = array('change_history_id' => $insert_idss,'suit_sts' => 84,'reassign_by'=> $this->session->userdata['ast_user']['user_id'], 'reassign_dt'=>date('Y-m-d H:i:s'));
					            if($data[$i]['deal_officer_id']!='')//when deal officer changed
					            {
					                $updated_suit_data['temp_deal_officer'] = $data[$i]['deal_officer_id'];
					            }
					            if($data[$i]['court_id']!='')//when Court changed
					            {
					                $updated_suit_data['temp_court'] = $data[$i]['court_id'];
					            }
					            if($data[$i]['lawyer_id']!='')//when Lawyer changed
					            {
					                $updated_suit_data['temp_lawyer'] = $data[$i]['lawyer_id'];
					            }
					            $this->db->where('id', $data[$i]['suit_id']);
					            $this->db->update('suit_filling_info', $updated_suit_data);
							}
						}
			}
		}
		if ($this->db->trans_status() === FALSE)
		{
			array_push($error_mesage,"Failed");
			$this->db->trans_rollback();
			return $error_mesage;
		}
		else
		{
			if($migration_type!=8)
			{
				rename($from, $to);
			}
			$this->db->trans_commit();
			return array();
		}
	}
	
	
	
}
?>