<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_data extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Ref_data_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat,$VIEWID)
	{
		$csrf_token = $this->security->get_csrf_hash();
		
		$data = array(
			'menu_group'=> $menu_group,
			'menu_cat'=> $menu_cat,
			'VIEWID'=> $VIEWID,
			'pages'=> 'ref_data/pages/grid',
			'csrf_token'=> $csrf_token,
			'per_page' => $this->config->item('per_pagess'),

		);

		$data['submit'] = 0;
		$data['submit2'] = 0;

		if($this->input->post('submit') || $this->input->post('submit2'))
		{
			$tab_name = $this->Ref_data_model->get_table_name($this->input->post('ref_id'));
			$ref_fields = $this->Ref_data_model->get_field_by_ref_name($tab_name);
			$datafield = NULL;
			$textfield = NULL;
			$fields = array();
			$i=1;
			$datafield .="{ name: 'id', type: 'int'},";
			$textfield .=" { text: 'id', datafield: 'id', hidden:true },";
			foreach ($ref_fields as $row)
			{
				if($i!=1){
					$datafield .= ",";
					$textfield .= ",";
				}
				
				if($row->reference_input_type_id == 2)
				{

					$fields[] = array(
						'field' => $row->reference_field_name.$i,
						'caption' => $row->reference_field_caption
						);
					$datafield .=" { name: '".$row->reference_field_name."".$i."'}";
			 		$textfield .=" { text: '".$row->reference_field_caption."', menu: true,sortable: true, datafield: '".$row->reference_field_name."".$i."', minwidth:200  }";
				}
				else if($row->reference_input_type_id == 5)
				{

					$fields[] = array(
						'field' => "grpname".$i,
						'caption' => $row->reference_field_caption
						);
					$datafield .=" { name: 'grpname".$i."'}";
			 		$textfield .=" { text: '".$row->reference_field_caption."', menu: true,sortable: true, datafield: 'grpname".$i."', minwidth:200  }";
				}
				else
				{

					$fields[] = array(
						'field' => $row->reference_field_name,
						'caption' => $row->reference_field_caption
						);
					$datafield .=" { name: '".$row->reference_field_name."'}";
			 		$textfield .=" { text: '".$row->reference_field_caption."',menu: true,sortable: true,  datafield: '".$row->reference_field_name."', minwidth:300  }";
				}
				$i++;
			}

			$data['ref_name'] = $this->input->post('ref_name');
			$data['datafield'] = trim($datafield,',');
			$data['textfield'] = trim($textfield,',');
			$data['fields'] = $fields;
			$data['ref_name'] = $tab_name;
			$data['ref_id'] = $this->input->post('ref_id');

			if($this->input->post('submit'))
			{
				$data['submit'] = 1;
			}
			else
			{
				$data['submit'] = 1;
				$data['submit2'] = 1;
			}
		}
		else
		{
			$data['submit'] = 0;
			$data['submit2'] = 0;
		}
		// echo '<pre>'; print_r($data); 
		$this->load->view('grid_layout',$data);
	}

	function grid($ref_name)
	{
		$this->load->model('Ref_data_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		if($this->input->get('pagesize')){
			$pagesize = $this->input->get('pagesize');
		}else{
			$pagesize = $this->config->item('per_pagess');
		}
		$start = $pagenum * $pagesize;

		//$fields = $this->Ref_data_model->get_field_by_ref_name($ref_name);

		$result=$this->Ref_data_model->get_grid_data($ref_name,$this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);

		echo json_encode($data);
	}

	function from($add_edit='add',$ref_id=NULL,$op_from_others=NULL,$editrow=NULL,$rowindex=NULL)
	{
		$val= "";
		$rules = "";
		$html = "";
		$jqx = "";
		$row_data = array();
		
		if($editrow!='')
		{
			$row_data = $this->Ref_data_model->get_row_data($ref_id,$editrow);
			//echo '<pre>'; print_r($row_data);
			$html .= '<input type="hidden" value="'.$editrow.'" name="id">';
		}

		$q1 = $this->db->query("SELECT * FROM reference_list WHERE id = ".$this->db->escape($ref_id)." and data_status=1");
		$r1 = $q1->row();
		$html .= '<tr><td style="width:15%;">Reference</td><td>'.$r1->reference_name.'</td></tr>';
		$result =  $this->Ref_data_model->get_field_info($ref_id);
		//echo '<pre>'; print_r($result);
		foreach($result as $field)
		{
			$html .= '<tr><td>'.$field->reference_field_caption;
			if($field->reference_mandatory_status=="1")
			{
				$html .= ' <span style="color:#FF0000;font-size:16px;">*</span>';
			}
			$html .= '</td><td>';

			if($field->reference_input_type_id=="2")
			{
				
				$html .= '<div id="'.$field->reference_field_name.'" name="'.$field->reference_field_name.'" style="text-align:'.$field->reference_alignment.'"></div>';
				//echo $html;
				$jqx .= $this->getreffield($field->reference_field_name,$field->reference_name,$field->reference_list_value_field_nam,$field->reference_list_show_field_name);
				$jqx .= "jQuery('#".$field->reference_field_name."').jqxComboBox({theme: theme, promptText: '--Select--', source: list_".$field->reference_field_name.", width: 250, height: 23,searchMode:'containsignorecase',autoComplete:true});";

				//$jqx .= "jQuery('#".$field->reference_field_name."').focusout(function(){ commbobox_check(jQuery(this).attr('id')); });";


				if($editrow!='')
				{
					$val .= "jQuery('#".$field->reference_field_name."').val('";
						if($editrow!=''){ $val .= $row_data[$field->reference_field_name];}
					$val .="');";
				}
				if($field->reference_mandatory_status=="1")
				{

					$rules .= "{ input: '#".$field->reference_field_name."', message: 'Required!', action: 'keyup, blur, change', rule: function (input) {
						if(input.val() != '')
						{
							var item = jQuery('#".$field->reference_field_name."').jqxComboBox('getSelectedItem');
							if(item != null){return true;} else return false;
						}
						return false;
						}
					},";
				}
				//die();
             }
			else if($field->reference_input_type_id=="5")
			{
				if($editrow!=''){ $arr_selected = explode(',',$row_data[$field->reference_field_name]);}
				$value_name = $field->reference_list_value_field_nam;
				$show_name = $field->reference_list_show_field_name;
				$html .= '<select style="width:320px" id="'.$field->reference_field_name.'" name="'.$field->reference_field_name.'[]" multiple="multiple">';

				 $ref_table_data=$this->Ref_data_model->get_ref_table_data($field->reference_name);
				   foreach($ref_table_data as $row)
				   {
						$html .= '<option value="'.$row->$value_name.'"' ;
						if($editrow!=''){if(in_array($row->$value_name,$arr_selected))
						{$html .= ' selected="selected"';}} $html .= '>'.$row->$show_name.'</option>';

				   }
				  $html.='</select><script>jQuery("#'.$field->reference_field_name.'").multipleSelect();</script>';

				if($field->reference_mandatory_status=="1")
				{
					$rules .= "{ input: '#".$field->reference_field_name."', message: 'Required!', action: 'blur,change', rule:function(){ if(jQuery('.ms-choice span').html() == '' || jQuery('.ms-choice span').html() == '--Select--'){return false; } else return true; } },";
				}

				$jqx.='if(jQuery(".ms-choice span").html() == ""){ jQuery(".ms-choice span").html("--Select--"); }
				jQuery("#'.$field->reference_field_name.'").bind("change", function (event){
				if(jQuery(".ms-choice span").html() == ""){ jQuery(".ms-choice span").html("--Select--"); }
				});';
			}
			else if($field->reference_input_type_id == "4")
			{
				$html .= '<div id="'.$field->reference_field_name.'1" style="float:left;">Yes</div>
				<div id="'.$field->reference_field_name.'2" style="float:left">No</div><input id="'.$field->reference_field_name.'" name="'.$field->reference_field_name.'" type="hidden" value="1" />';

				$jqx .= "jQuery('#".$field->reference_field_name."1').jqxRadioButton({theme: theme, checked: true, width: 100, height: 25});
				jQuery('#".$field->reference_field_name."2').jqxRadioButton({theme: theme, width: 100, height: 25});
				jQuery('#".$field->reference_field_name."1').bind('checked', function (event){
					jQuery('#".$field->reference_field_name."').val('1');
				});
				jQuery('#".$field->reference_field_name."2').bind('checked', function (event){
					jQuery('#".$field->reference_field_name."').val('0');
				});";
				if($editrow!='')
				{
					if($row_data[$field->reference_field_name] == 1)
					{
						$val .= "jQuery('#".$field->reference_field_name."').val('1');
						jQuery('#".$field->reference_field_name."1').jqxRadioButton({checked: true});
						jQuery('#".$field->reference_field_name."2').jqxRadioButton({checked: false});";
					}
					else
					{
						$val .= "jQuery('#".$field->reference_field_name."').val('0');
						jQuery('#".$field->reference_field_name."1').jqxRadioButton({checked: false});
						jQuery('#".$field->reference_field_name."2').jqxRadioButton({checked: true});";
					}
				}
			}
			else if ($field->reference_input_type_id=="6")
			{
				
				
				$html .= "<input type='checkbox' name='".$field->reference_field_name."' id='" .$field->reference_field_name."' value='1' />";
				
				if($editrow!='')
				{
					
					
					if ($row_data[$field->reference_field_name] == 1 || strtoupper((string)$row_data[$field->reference_field_name]) == "TRUE")
                            {
                               $val .= "jQuery('#" .$field->reference_field_name."').prop('checked', true);";
                            }
                            else
                            {
                                $val .= "jQuery('#" .$field->reference_field_name. "').prop('checked', false);";
                            }
				}
			}
			else if($field->reference_input_type_id=="3")
			{
				$html.='<textarea " name="'.$field->reference_field_name.'" id="'.$field->reference_field_name.'" class="textarea-big" style="height:60px">';
				if($editrow!=''){ $html.=$row_data[$field->reference_field_name];}
				$html.='</textarea>';

				if($field->reference_mandatory_status=="1")
				{
					$rules .= "{ input: '#".$field->reference_field_name."', message: 'Required!', action: 'keyup, blur', rule: 'required' },";
				}
			}
			else if($field->reference_input_type_id=="7")
			{
				$html.='<input type="file" id="'.$field->reference_field_name.'" name="'.$field->reference_field_name.'">';
				$img_mname_old='';				
				if($editrow!=''){ $img_mname_old=$row_data[$field->reference_field_name]; }
				$html.='<input type="hidden" id="hidden_'.$field->reference_field_name.'" name="hidden_'.$field->reference_field_name.'" value="'.$img_mname_old.'" />';
				if($img_mname_old!=''){
					$html.='<img id="file_preview_picture" onclick="popup(\''.base_url().'ref_tables_files/'.$img_mname_old.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
				}
			
				if($field->reference_mandatory_status=="1")
				{
					$rules .= "{ input: '#".$field->reference_field_name."', message: 'Required!', action: 'keyup, blur', rule: 'required' },";
				}
			}
			else
			{
				
                        $html.= "<input type='text' class='text-input-big' value='";


                        if ($field->reference_field_type_id=="4")
                        {
                            $html.= $field->reference_field_name; //date format
                        }
                        else
                        {
                            if ($editrow!='')
                            {
                                $html.= $row_data[$field->reference_field_name];
                            }
                        }
                        $html.= "' ";
                        if ($field->reference_field_type_id == "5" || $field->reference_field_type_id == "8" || $field->reference_field_type_id == "9")
                        {
                            $html.= " onkeypress='return amountsonly(event, jQuery(this).val())' "; //decimal format
                            $rules .= " { input: '#".$field->reference_field_name."', message: 'Only decimal value !!', action: 'change, blur', rule: 'number' },";
                            if($field->reference_field_type_id == "9")
                            {
                                $rules .= " { input: '#".$field->reference_field_name."', message: 'Invalid ".$field->reference_field_caption." entered  !!', action: 'change, blur', rule: function (input) {if (input.val() != '') { if (parseFloat(input.val()) > 100) {return false;} else {return true;}} else {return true;}} },";
                            }

                        }
                        else
                        {
                            $html.= " maxlength='" .$field->reference_input_length. "' ";
                        }
                        $html.= " name='".$field->reference_field_name."' id='".$field->reference_field_name."' class='text-input-big jqx-input' style='text-align:".$field->reference_alignment."' >";
                        if ($field->reference_field_type_id == "4")
                        {
                            $jqx .= "setDatePicker('".$field->reference_field_name."');";
                            if ($editrow!='')
                            {
                                $val .= "jQuery('#".$field->reference_field_name."').datepicker('setDate', '".$row_data[$field->reference_field_name]."');";
                            }
                        }

                        if ($field->reference_mandatory_status == "1")
                        {
                            $rules .= "{ input: '#".$field->reference_field_name.
                                        "', message: 'Required!', action: 'keyup, blur', rule: 'required' },";
                        }
                        if ($field->reference_unique_status == "1")
                        {
                            $rules .= "{ input: '#".$field->reference_field_name.
                                        "', message: '".$field->reference_field_caption.
                                        " already exist in the database', action: 'blur', rule: function(input){ return checkDuplicate('".$field->reference_table_name."',input.val(),'" .$field->reference_field_name."','".
                                        $editrow."'); }},";
                        }
			}
				$html .= '</td></tr>';
		}

		$data = array(
				   'add_edit' => $add_edit,
				   'html' => $html,
				   'op_from_others' => $op_from_others,
				   'rules' => trim($rules,','),
				   'jqx' => $jqx,
				   'ref_id' => $ref_id,
				   'pages'=> 'ref_data/pages/form',
				   'editrow' => $editrow,
				   'rowindex' => $rowindex,
				   'val' => $val
				   );
		// echo '<pre>';print_r($data);exit;
		$this->load->view('ref_data/form_layout',$data);
	}
	function get_ref_data_form()
    {
        $csrf_token=$this->security->get_csrf_hash();
        $row_data = $this->Ref_data_model->get_ref_data_by_name($this->input->post('ref_table'));
        $Message = '';
        $html = "";
        $editrow='';
        $rules = "";
        $jqx ="";
        $ref_id = "";
        if(!empty($row_data))
        {
        	$Message = 'ok';
        	$ref_id = $row_data->id;
        	$q1 = $this->db->query("SELECT * FROM reference_list WHERE id = ".$this->db->escape($ref_id)." and data_status=1");
			$r1 = $q1->row();
			$html .= '<tr><td style="width:15%;">Reference</td><td>'.$r1->reference_name.'</td></tr>';
			$result =  $this->Ref_data_model->get_field_info($ref_id);
			//echo '<pre>'; print_r($result);
			foreach($result as $field)
			{
				$html .= '<tr><td>'.$field->reference_field_caption;
				if($field->reference_mandatory_status=="1")
				{
					$html .= ' <span style="color:#FF0000;font-size:16px;">*</span>';
				}
				$html .= '</td><td>';

				if($field->reference_input_type_id=="2")
				{
					
					$html .= '<div id="'.$field->reference_field_name.'" name="'.$field->reference_field_name.'" style="text-align:'.$field->reference_alignment.'"></div>';
					//echo $html;
					$jqx .= $this->getreffield($field->reference_field_name,$field->reference_name,$field->reference_list_value_field_nam,$field->reference_list_show_field_name);
					$jqx .= "jQuery('#".$field->reference_field_name."').jqxComboBox({theme: theme, promptText: '--Select--', source: list_".$field->reference_field_name.", width: 250, height: 23,searchMode:'containsignorecase',autoComplete:true});";

					//$jqx .= "jQuery('#".$field->reference_field_name."').focusout(function(){ commbobox_check(jQuery(this).attr('id')); });";


					if($editrow!='')
					{
						$val .= "jQuery('#".$field->reference_field_name."').val('";
							if($editrow!=''){ $val .= $row_data[$field->reference_field_name];}
						$val .="');";
					}
					if($field->reference_mandatory_status=="1")
					{

						$rules .= "{ input: '#".$field->reference_field_name."', message: 'Required!', action: 'keyup, blur, change', rule: function (input) {
							if(input.val() != '')
							{
								var item = jQuery('#".$field->reference_field_name."').jqxComboBox('getSelectedItem');
								if(item != null){return true;} else return false;
							}
							return false;
							}
						},";
					}
					//die();
	             }
				else if($field->reference_input_type_id=="5")
				{
					if($editrow!=''){ $arr_selected = explode(',',$row_data[$field->reference_field_name]);}
					$value_name = $field->reference_list_value_field_nam;
					$show_name = $field->reference_list_show_field_name;
					$html .= '<select style="width:320px" id="'.$field->reference_field_name.'" name="'.$field->reference_field_name.'[]" multiple="multiple">';

					 $ref_table_data=$this->Ref_data_model->get_ref_table_data($field->reference_name);
					   foreach($ref_table_data as $row)
					   {
							$html .= '<option value="'.$row->$value_name.'"' ;
							if($editrow!=''){if(in_array($row->$value_name,$arr_selected))
							{$html .= ' selected="selected"';}} $html .= '>'.$row->$show_name.'</option>';

					   }
					  $html.='</select><script>jQuery("#'.$field->reference_field_name.'").multipleSelect();</script>';

					if($field->reference_mandatory_status=="1")
					{
						$rules .= "{ input: '#".$field->reference_field_name."', message: 'Required!', action: 'blur,change', rule:function(){ if(jQuery('.ms-choice span').html() == '' || jQuery('.ms-choice span').html() == '--Select--'){return false; } else return true; } },";
					}

					$jqx.='if(jQuery(".ms-choice span").html() == ""){ jQuery(".ms-choice span").html("--Select--"); }
					jQuery("#'.$field->reference_field_name.'").bind("change", function (event){
					if(jQuery(".ms-choice span").html() == ""){ jQuery(".ms-choice span").html("--Select--"); }
					});';
				}
				else if($field->reference_input_type_id == "4")
				{
					$html .= '<div id="'.$field->reference_field_name.'1" style="float:left;">Yes</div>
					<div id="'.$field->reference_field_name.'2" style="float:left">No</div><input id="'.$field->reference_field_name.'" name="'.$field->reference_field_name.'" type="hidden" value="1" />';

					$jqx .= "jQuery('#".$field->reference_field_name."1').jqxRadioButton({theme: theme, checked: true, width: 100, height: 25});
					jQuery('#".$field->reference_field_name."2').jqxRadioButton({theme: theme, width: 100, height: 25});
					jQuery('#".$field->reference_field_name."1').bind('checked', function (event){
						jQuery('#".$field->reference_field_name."').val('1');
					});
					jQuery('#".$field->reference_field_name."2').bind('checked', function (event){
						jQuery('#".$field->reference_field_name."').val('0');
					});";
					if($editrow!='')
					{
						if($row_data[$field->reference_field_name] == 1)
						{
							$val .= "jQuery('#".$field->reference_field_name."').val('1');
							jQuery('#".$field->reference_field_name."1').jqxRadioButton({checked: true});
							jQuery('#".$field->reference_field_name."2').jqxRadioButton({checked: false});";
						}
						else
						{
							$val .= "jQuery('#".$field->reference_field_name."').val('0');
							jQuery('#".$field->reference_field_name."1').jqxRadioButton({checked: false});
							jQuery('#".$field->reference_field_name."2').jqxRadioButton({checked: true});";
						}
					}
				}
				else if ($field->reference_input_type_id=="6")
				{
					
					
					$html .= "<input type='checkbox' name='".$field->reference_field_name."' id='" .$field->reference_field_name."' value='1' />";
					
					if($editrow!='')
					{
						
						
						if ($row_data[$field->reference_field_name] == 1 || strtoupper((string)$row_data[$field->reference_field_name]) == "TRUE")
	                            {
	                               $val .= "jQuery('#" .$field->reference_field_name."').prop('checked', true);";
	                            }
	                            else
	                            {
	                                $val .= "jQuery('#" .$field->reference_field_name. "').prop('checked', false);";
	                            }
					}
				}
				else if($field->reference_input_type_id=="3")
				{
					$html.='<textarea " name="'.$field->reference_field_name.'" id="'.$field->reference_field_name.'" class="textarea-big" style="height:60px">';
					if($editrow!=''){ $html.=$row_data[$field->reference_field_name];}
					$html.='</textarea>';

					if($field->reference_mandatory_status=="1")
					{
						$rules .= "{ input: '#".$field->reference_field_name."', message: 'Required!', action: 'keyup, blur', rule: 'required' },";
					}
				}
				else if($field->reference_input_type_id=="7")
				{
					$html.='<input type="file" id="'.$field->reference_field_name.'" name="'.$field->reference_field_name.'">';
					$img_mname_old='';				
					if($editrow!=''){ $img_mname_old=$row_data[$field->reference_field_name]; }
					$html.='<input type="hidden" id="hidden_'.$field->reference_field_name.'" name="hidden_'.$field->reference_field_name.'" value="'.$img_mname_old.'" />';
					if($img_mname_old!=''){
						$html.='<img id="file_preview_picture" onclick="popup(\''.base_url().'ref_tables_files/'.$img_mname_old.'\')" style=" cursor:pointer;text-align:center" height="18" src="'.base_url().'old_assets/images/print-preview.png">';
					}
				
					if($field->reference_mandatory_status=="1")
					{
						$rules .= "{ input: '#".$field->reference_field_name."', message: 'Required!', action: 'keyup, blur', rule: 'required' },";
					}
				}
				else
				{
					
	                        $html.= "<input type='text' class='text-input-big' value='";


	                        if ($field->reference_field_type_id=="4")
	                        {
	                            $html.= $field->reference_field_name; //date format
	                        }
	                        else
	                        {
	                            if ($editrow!='')
	                            {
	                                $html.= $row_data[$field->reference_field_name];
	                            }
	                        }
	                        $html.= "' ";
	                        if ($field->reference_field_type_id == "5" || $field->reference_field_type_id == "8" || $field->reference_field_type_id == "9")
	                        {
	                            $html.= " onkeypress='return amountsonly(event, jQuery(this).val())' "; //decimal format
	                            $rules .= " { input: '#".$field->reference_field_name."', message: 'Only decimal value !!', action: 'change, blur', rule: 'number' },";
	                            if($field->reference_field_type_id == "9")
	                            {
	                                $rules .= " { input: '#".$field->reference_field_name."', message: 'Invalid ".$field->reference_field_caption." entered  !!', action: 'change, blur', rule: function (input) {if (input.val() != '') { if (parseFloat(input.val()) > 100) {return false;} else {return true;}} else {return true;}} },";
	                            }

	                        }
	                        else
	                        {
	                            $html.= " maxlength='" .$field->reference_input_length. "' ";
	                        }
	                        $html.= " name='".$field->reference_field_name."' id='".$field->reference_field_name."' class='text-input-big jqx-input' style='text-align:".$field->reference_alignment."' >";
	                        if ($field->reference_field_type_id == "4")
	                        {
	                            $jqx .= "setDatePicker('".$field->reference_field_name."');";
	                            if ($editrow!='')
	                            {
	                                $val .= "jQuery('#".$field->reference_field_name."').datepicker('setDate', '".$row_data[$field->reference_field_name]."');";
	                            }
	                        }

	                        if ($field->reference_mandatory_status == "1")
	                        {
	                            $rules .= "{ input: '#".$field->reference_field_name.
	                                        "', message: 'Required!', action: 'keyup, blur', rule: 'required' },";
	                        }
	                        if ($field->reference_unique_status == "1")
	                        {
	                            $rules .= "{ input: '#".$field->reference_field_name.
	                                        "', message: '".$field->reference_field_caption.
	                                        " already exist in the database', action: 'blur', rule: function(input){ return checkDuplicate('".$field->reference_table_name."',input.val(),'" .$field->reference_field_name."','".
	                                        $editrow."'); }},";
	                        }
				}
					$html .= '</td></tr>';
			}
        }
        else
        {
        	$Message = 'You Have No Access For This Operation!';
        }
        $jTableResult = array();
        $jTableResult['csrf_token'] = $csrf_token;
        $jTableResult['Message'] = $Message;
        $jTableResult['html'] = $html;
        $jTableResult['rules'] = $rules;
        $jTableResult['ref_id'] = $ref_id;
        $jTableResult['row_info'] = array();
        $jTableResult['errorMsgs'] = 0;
        // $jTableResult['sql'] = $id;
        echo json_encode($jTableResult);
    }

	function getreffield($field_name=NULL,$list_ref_name=NULL,$list_ref_value=NULL,$list_ref_show=NULL)
	{
	  $ref_table_data=$this->Ref_data_model->get_ref_table_data($list_ref_name);


	  $str = NULL;
	  $val_arr = NULL;
	  $jqx = NULL;
	  $i=1;
	   foreach($ref_table_data as $row)
	   {
			if($i!=1){
				$str .= ',';
				$val_arr .= ',';
			}
			$str .= '{value:"'.$row->$list_ref_value.'", label:"'.$row->$list_ref_show.'"}';
			$val_arr .= '"'.$row->$list_ref_show.'"';
			$i++;

	   }

	   $jqx .= "var list_".$field_name." = [".$str."];";

		return $jqx;
	}

	function add_edit_action($add_edit=NULL,$ref_id=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text=array();
		if ($this->session->userdata['ast_user']['login_status'])
		{
			$id=$this->Ref_data_model->add_edit_action($add_edit,$ref_id);
			if($add_edit=="add" && $id==0)
				$text[] = $id;
			else if($add_edit=="edit" && $this->input->post('id')!=$id)
				$text[] = $id;
			else ;
		}
		else{
			$text[]="Session out, login required";

		}
		$Message='';
		$fields = array();
		$field_types = array();
		if(count($text)<=0){
			$Message='OK';
			$row=$this->Ref_data_model->get_add_action_data($ref_id,$id);
			$result=$this->Ref_data_model->get_field_info($ref_id);
			$fields[0]='ID';
			$field_types[0]=0;
		 	foreach($result as $field){
		 		$fields[] = $field->reference_field_name;
				$field_types[] = $field->reference_input_type_id;
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
		$var['fields'] = $fields;
		$var['types'] = $field_types;
		echo json_encode($var);
	}

	function delete_action($d_v=NULL)
	{
			$csrf_token=$this->security->get_csrf_hash();

			$Message='OK';
			$row[]='';
			if ($this->session->userdata['ast_user']['login_status'])
			{
				$id=$this->Ref_data_model->delete_action();
				if($this->input->post("type")=='delete'){$row[]='';	}
				else{$row = $this->Ref_data_model->get_add_action_data($id);}
			}else{
				$Message='Session out, login required';
			}

				$var =array();
				$var['csrf_token']=$csrf_token;
				$var['Message']=$Message;
				$var['row_info']=$row;
				echo json_encode($var);
	}

	function duplicate_field($field_name=NULL,$tabname=NULL,$edit_id=NULL)
	{
		if ($this->input->post('val') != ""){
			$num_row=$this->Ref_data_model->duplicate_name($field_name,$this->input->post('val'),$edit_id,$tabname);
			$var =
			array(
				"Message"=>"",
				"Status"=>$num_row>0?'duplicate':'ok'
			);
			echo json_encode($var);
    	}
	}

	function get_ref_table_data($list_ref_name){
		$data =  $this->Ref_data_model->get_ref_table_data($list_ref_name);
		
		foreach ($data as $row) {
			$rows[] = array(
					'list_ref_value' => $row->REFERENCE_LIST_VALUE_FIELD_NAM,
					'list_ref_show' => $row->REFERENCE_LIST_SHOW_FIELD_NAME
					);
		}
		echo json_encode($rows);;
	}

	function checkDuplicateFieldName($tab_name=NULL,$value=NULL,$field_name=NULL,$editid=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$num_row=$this->Ref_data_model->checkDuplicate($tab_name,$value,$field_name,$editid);
	 	echo $num_row.':::'.$csrf_token;
	}
	public function download_excel()
    {
        error_reporting(0);

        $tab_name = $this->Ref_data_model->get_table_name($this->input->post('ref_name'));
        $ref_fields = $this->Ref_data_model->get_field_by_ref_name($tab_name);
        $ref_data = $this->Ref_data_model->get_ref_table_data($tab_name);
        $parameter_name = $this->Ref_data_model->get_parameter_name($this->input->post('ref_name'));

        if (!empty($ref_data)) 
		{
            $filename = $parameter_name.'_'.date('d_M_y h_i A').'.xlsx';

            $time = date('d-m-Y h:i A');

            require_once('./application/Classes/PHPExcel.php'); 
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $styleArray_border = ['borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]]];

            $rowNumber = 1;

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowNumber, $parameter_name.' Data');
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':O'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setSize(16)->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setBold(true);
            ++$rowNumber;

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowNumber, 'Generation Date & Time: '.$time);
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$rowNumber.':O'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getFont()->setSize(12);

            ++$rowNumber;
            ++$rowNumber;

            $headings2 = ['SL'];
            $valueArray = ['SL'];
            $column_data_array = array();
            $inital_column = 'A';
            foreach ($ref_fields as $row) {
                array_push($headings2, $row->reference_field_caption);
                array_push($valueArray, $row->reference_field_name);
            }

            $alphabetArray = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
            $alcou = count($headings2);

            $objPHPExcel->getActiveSheet()->fromArray([$headings2], null, 'A'.$rowNumber);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.$alphabetArray[$alcou - 1].$rowNumber)->getFont()->setSize(12)->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.$alphabetArray[$alcou - 1].$rowNumber)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.$alphabetArray[$alcou - 1].$rowNumber)->applyFromArray($styleArray_border);

            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('M'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            ++$rowNumber;

            $count = 0;
            $data = [];

			//echo '<pre>'; print_r($ref_data); exit;

            foreach ($ref_data as $key => $row2) 
			{
                $data = [];
                $column_data_array = array();
                $inital_column = 'A';
                for ($c = 0; $c < count($valueArray); ++$c)
				{
                    $value_name = $valueArray[$c];
                    if ($c == 0) 
					{
                        $data[$count][0] = $count + 1;
                        $column_value = $count + 1;
                    } 
					else 
					{
						$input_type_row = $this->Ref_data_model->get_input_type($tab_name, $value_name);

						// echo '<pre>'; print_r($input_type_row);

						if($input_type_row->reference_field_type_id == 1 || $input_type_row->reference_field_type_id == 3)
						{
							// echo '<pre>'; print_r($input_type_row); echo $row2->$value_name; // exit;

							if($input_type_row->reference_name != '' && $row2->$value_name != '')
							{
								$join_data = $this->Ref_data_model->get_join_data_by_column_value($input_type_row->reference_name, $input_type_row->reference_list_show_field_name, $input_type_row->reference_list_value_field_nam, $row2->$value_name);
								$data[$count][$c]  = $join_data;
								$column_value = $join_data;
							}
							else
							{
								$data[$count][$c] = $row2->$value_name;
								$column_value = $row2->$value_name;
							}
						}
						else
						{
							$data[$count][$c] = $row2->$value_name;
							$column_value = $row2->$value_name;
						}
                    }
                    $column_data_array[$inital_column] = $column_value;
                    $inital_column++;

                }
                ++$count;
                
                $objPHPExcel->getActiveSheet()->fromArray($data, null, 'A'.$rowNumber);

                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.$alphabetArray[$alcou - 1].$rowNumber)->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.$alphabetArray[$alcou - 1].$rowNumber)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.$alphabetArray[$alcou - 1].$rowNumber)->applyFromArray($styleArray_border);

                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$rowNumber.':I'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $objPHPExcel->getActiveSheet()->getStyle('K'.$rowNumber.':'.$alphabetArray[$alcou - 1].$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $objPHPExcel->getActiveSheet()->getStyle('J'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $objPHPExcel->getActiveSheet()->getStyle('L'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber.':'.$alphabetArray[$alcou - 1].$rowNumber)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                foreach ($column_data_array as $ss => $ss2) 
                {
                	$objPHPExcel->getActiveSheet()->setCellValueExplicit(($ss.$rowNumber), $ss2, PHPExcel_Cell_DataType::TYPE_STRING);
                }
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth('5');
                $sCou = 0;

                foreach (range('B', 'Z') as $elements) 
				{
                    ++$sCou;
                    if ($sCou < $alcou) 
					{
                        $objPHPExcel->getActiveSheet()->getColumnDimension($elements)->setWidth('30');
                    }
                }
                ++$rowNumber;
            }

            $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
            require_once './application/Classes/PHPExcel/IOFactory.php';
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//Excel2007
	        ob_clean();
	        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	        header("Content-type:   application/x-msexcel; charset=utf-8");
	        header('Content-Disposition: attachment;filename="case_details_report.xls"');
	        header("Expires: 0");
	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header("Cache-Control: private",false);
	        $objWriter->save('php://output');   
            exit();
        } else {
            echo 'No data found !!';
            exit();
        }
    }
}
?>