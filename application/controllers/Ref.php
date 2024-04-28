<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('Ref_model', '', TRUE);
	}

	function view ($menu_group,$menu_cat)
	{
		$data = array(
					'menu_group'=> $menu_group,
					'menu_cat'=> $menu_cat,
					'pages'=> 'ref/pages/grid',
				   	'per_page' => $this->config->item('per_pagess')
				   );
		$this->load->view('grid_layout',$data);
	}

	function grid()
	{
		$this->load->model('Ref_model', '', TRUE);
		$pagenum = $this->input->get('pagenum');
		$pagesize = $this->input->get('pagesize');
		$start = $pagenum * $pagesize;

		$result = $this->Ref_model->get_grid_data($this->input->get('filterscount'), $this->input->get('sortdatafield'), $this->input->get('sortorder'),$pagesize, $start);

		$data[] = array(
		   'TotalRows' => $result['TotalRows'],
		   'Rows' => $result['Rows']
		);
		echo json_encode($data);
	}

	function from($add_edit,$id=NULL,$editrow=NULL)
	{
		if($add_edit!='add'){
			$result1 = $this->Ref_model->get_info($add_edit,$id);
			$ref_name = $this->Ref_model->get_ref_name_by_id($id);
			$result2 = $this->Ref_model->get_field_by_refid($ref_name);
		}
		else
		{
			$result1 = array();
			$result2 = array();
		}
		// echo "<pre>";
		// print_r($result1);
		// exit;
		$data = array(
				   'add_edit' => $add_edit,
				   'result' => $result1,
				   'result_fields' => $result2,
				   //'align' => $this->db->enum_select('ref_field_list','alignment'),
				   'align' => array('LEFT'=>'Left','RIGHT'=>'Right','CENTER'=>'Center'),
				   'fieldtype'=>$this->Ref_model->dropdownvaluewithoutselect('reference_field_type','field_type_name'),
				   'inputtype'=>$this->Ref_model->dropdownvaluewithoutselect('reference_input_type','input_type_name'),
				   'id' => $id,
				   'pages'=> 'ref/pages/form',
				   'editrow' => $editrow
				   );
		$this->load->view('ref/form_layout',$data);
	}

	function add_edit_action($add_edit=NULL,$edit_id=NULL) // insert or update form data
	{
		$csrf_token=$this->security->get_csrf_hash();
		$text=array();
		$row[]='';
		if ($this->session->userdata['ast_user']['login_status'])
		{
			if($add_edit=="add")
			{
				$table='ref_'.str_replace(' ','_',strtolower(trim($this->input->post('name'))));
				if($this->Ref_model->check_duplicate($table))
				{
					$var['Message']= "Duplicate Parameter Name";

					$var['row_info']="";
					echo json_encode($var);
					exit;
				}
				else
				{
					$id=$this->Ref_model->insert_data($add_edit);
					// echo $id;exit;
				}
			}
			else{ $id=$this->Ref_model->update_data($edit_id); }
		}
		else
		{
			$text[]="Session out, login required";
		}

		$Message='';
		if(count($text)<=0)
		{
			$Message='OK';
			if($id != 0)
			{
				$row=$this->Ref_model->get_add_action_data($id);
			}
			else
			{
				$Message='Sorry, Could not Save!!';
			}

		}
		else
		{
			for($i=0; $i<count($text); $i++)
			{
				if($i>0){$Message.=',';}
				$Message.=$text[$i];
			}
		}

		$var =array();
		$var['Message']=$Message;
		$var['csrf_token']=$csrf_token;
		$var['row_info']=$row;
		echo json_encode($var);
	}

	function delete_action($refid)
	{
		$a='';
		$csrf_token=$this->security->get_csrf_hash();
		if ($this->session->userdata['ast_user']['login_status'])
		{
			$id=$this->Ref_model->delete_action($refid);
			echo $id.':::'.$csrf_token;
		}else{
			echo $a.':::'.$csrf_token;
		}
	}

	function duplicate_field($field_name=NULL,$add_edit=NULL,$edit_id=NULL)
	{
		if ($this->input->post('val') != ""){
			$num_row=$this->Ref_model->duplicate_name($field_name,$this->input->post('val'),$edit_id);
			$var =
			array(
				"Message"=>"",
				"Status"=>$num_row>0?'duplicate':'ok'
			);
			echo json_encode($var);
    	}
	}

	function checkDuplicateFieldName($field_name=NULL,$refid=NULL)
	{
		if($field_name != '')
		{
			$num_row=$this->Ref_model->checkDuplicate($field_name,$refid);
		 	echo $num_row;
		}
		else { echo 0;}
	}

	function get_ref_list()
	{
		$result = NULL;
		$output = '<select style="width:50px;" id="list_ref_name'.$this->input->post('field').'" name="list_ref_name'.$this->input->post('field').'">';
	    $result = $this->Ref_model->get_ref_list();
	    foreach($result as $row) {
	    	$output .= '<option value="'.$row->ID.'">'.$row->reference_name.'</option>';
	    }
	    $output .= '</select>';
	    echo $output;
    }

    function list_value_show()
	{
    	$result = NULL;
		$output1 = '<select style="width:50px;" id="list_ref_show'.$this->input->post('field').'" name="list_ref_show'.$this->input->post('field').'">';
	    $query = $this->Ref_model->list_value_show();

	    foreach($query as $row){
	    	$output1 .= '<option value="'.$row->reference_field_name.'">'.$row->reference_field_caption.'</option>';
	    }

	    $output1 .= '</select>';
	    $output2 = '<select style="width:50px;" id="list_ref_value'.$this->input->post('field').'" name="list_ref_value'.$this->input->post('field').'">';

	   	foreach($query as $row){
	    	$output2 .= '<option value="'.$row->reference_field_name.'">'.$row->reference_field_caption.'</option>';
	    }

	    $output2 .= '</select>';

	    $var['list_show'] = $output1;
	    $var['list_value'] = $output2;
	    echo json_encode($var);
    }

	function dropfield($ref_id=NULL,$id=NULL,$tfield=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
	     $this->load->model('Ref_model', '', TRUE);
	     $ref_name = $this->Ref_model->get_ref_name_by_id($ref_id);
	     $this->Ref_model->redropfield($ref_name,$id,$tfield);
	     echo json_encode($csrf_token);
	}

	function getallref($i=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
	 	$this->load->model('Ref_model', '', TRUE);
		$reftype=$this->Ref_model->get_ref_list();
		$str="<select name=\"refer$i\"  id=\"refer$i\" onchange='clearfield($i)' style=\"width:90% !important;\" >";
		$str.="<option value='0'>Select</option>";
		foreach($reftype as $row)
		{
		  $str.="<option value='".$row->reference_table_name."'>".$row->reference_name."</option>";
		}
		$str.="</select>";
		echo $str.':::'.$csrf_token;
	}

	function getallreffield($ref_table_name=NULL,$i=NULL)
	{
		$csrf_token=$this->security->get_csrf_hash();
		$this->load->model('Ref_model', '', TRUE);

		$str="<select name=\"ref_value_field$i\"  id=\"ref_value_field$i\"  >";
			//<option value='0'>Select</option>
			$str.="<option value='id' selected>id</option>";

		$reftype1=$this->Ref_model->get_field_by_refid($ref_table_name);
		//foreach($reftype1 as $row)
		//{
		  //$str.="<option value='".$row->field_name."'>".$row->field_caption."</option>";

		//}

		$str.="</select>";
		$str2="<select name=\"ref_show_field$i\"  id=\"ref_show_field$i\"    >";
		$str2.="<option value='0'>Select</option>";
		$reftype1=$this->Ref_model->get_field_by_refid($ref_table_name);
		foreach($reftype1 as $row)
		{
		  $str2.="<option value='".$row->reference_field_name."'>".$row->reference_field_caption."</option>";
		}

		$str2.="</select>";
		$output["csrf_token"] = $csrf_token;
		$output["ref_value"] = $str;
		$output["ref_show"] = $str2;
		echo json_encode($output);
	}

	function popupwin($templatetable=NULL)
	{
		$this->load->model('reference_model', '', TRUE);
		$res=$this->reference_model->gettemplatebyname($templatetable);
		$data=array(
				   'result' =>$res,
				   'option' =>'popuptable',
				   'tablename'=>$templatetable,
					);

		$this->load->view('popup',$data);
	}

   function addmore($i) // add more row in add new reference
   {
	    $this->load->helper('form');
	    $csrf_token=$this->security->get_csrf_hash();
		$i=$i+1;
		$fieldtype=$this->Ref_model->dropdownvaluewithoutselect('reference_field_type','field_type_name');
		$inputtype=$this->Ref_model->dropdownvaluewithoutselect('reference_input_type','input_type_name');
		$align= array('LEFT'=>'Left','RIGHT'=>'Right','CENTER'=>'Center');
	   //$sessionvar=$this->Ref_model->dropdownvaluebyfield('session_variable','Value','Name');
	    $str="<tr id=\"tr$i\"  style=\"height:25px;\">
		<td class=\"dvtCellInfo\" align=\"left\">
		<input type=\"hidden\" name=\"delete$i\" id=\"delete$i\" value=\"0\" />
		<img src='".base_url()."images/del.png' alt=\"Delete\" onclick=\"deleterow($i)\" />
		</td>
     	<td   class=\"dvtCellInfo\" align=\"left\">
		<input type=\"text\" name=\"inputcaption$i\" id=\"inputcaption$i\"   class=\"detailedViewTextBox\"
		onBlur='alphaNumericOnly(\"inputcaption$i\")'  style=\"width:70px\"/></td>
		<td   class=\"dvtCellInfo\" align=\"left\">";
	 	$str.=form_dropdown("fieldtype$i",$fieldtype,0,"id=\"fieldtype$i\"  onchange=\"changlength($i)\" style=\"width:80px\" class=\"detailedViewTextBox\" ");
	 	$str.="</td>
		<td   class=\"dvtCellInfo\" align=\"center\">
		<input type=\"text\" name=\"length$i\" id=\"length$i\" disabled=\"disabled\" class=\"detailedViewTextBox\" onFocus=\"this.className='detailedViewTextBoxOn'\" onBlur=\"this.className='detailedViewTextBox';\" style=\"width:25px\"  maxlength=\"4\" />
		</td>
		<td  class=\"dvtCellInfo\" align=\"left\">";
		$str.=form_dropdown("inputtype$i",$inputtype,0,"id=\"inputtype$i\" onchange=\"checkselect($i)\" style=\"width:90px;\" class=\"detailedViewTextBox\" ");
		$str.="</td>
		<td><span id=\"refid$i\"></span></td>
		<td><span id=\"ref_value$i\"></span></td>
		<td><span id=\"ref_show$i\"></span></td>";
	   	$str.="<td   class=\"dvtCellInfo\" align=\"center\"><input type=\"checkbox\" id=\"mandatory$i\" name=\"mandatory$i\" /></td>
   		<td   class=\"dvtCellInfo\" align=\"center\"><input type=\"checkbox\" name=\"Unique$i\" id=\"Unique$i\"  /></td>
     	<td   class=\"dvtCellInfo\" align=\"Right\">
		<input type=\"text\" name=\"inputorder$i\" id=\"inputorder$i\"  onkeypress=\"return numbersonly(event)\" maxlength=\"3\" class=\"detailedViewTextBox\" onFocus=\"this.className='detailedViewTextBoxOn'\" onBlur=\"this.className='detailedViewTextBox';\"  style=\"width:20px\" />
		</td>
		<td  class=\"dvtCellInfo\" align=\"center\">";

	  	$str.=form_dropdown('align'.$i,$align,'Left','id="align'.$i.'"  style="width:60px;" class="detailedViewTextBox" ');
	  	$str.="</td></tr>";

	   	echo $str.':::'.$csrf_token;
	 }

	function editaddmore($i,$refid) // add more row in edit
	{
	  	$this->load->helper('form');
	  	$csrf_token=$this->security->get_csrf_hash();
		$i=$i+1;
		$fieldtype=$this->Ref_model->dropdownvaluewithoutselect('REFERENCE_FIELD_TYPE','FIELD_TYPE_NAME');
		$inputtype=$this->Ref_model->dropdownvaluewithoutselect('REFERENCE_INPUT_TYPE','INPUT_TYPE_NAME');
		$align= array('LEFT'=>'Left','RIGHT'=>'Right','CENTER'=>'Center');

	    $str="<tr id=\"tr$i\"  style=\"height:25px;\">
		<td class=\"dvtCellInfo\" align=\"left\">
		<img src='".base_url()."images/del.png' alt=\"Delete\" onclick=\"deleterow($i)\" />
		<input type=\"hidden\" name=\"delete$i\" id=\"delete$i\" value=\"0\" />
		<input type=\"hidden\" name=\"edittem$i\" id=\"edittem$i\" value=\"0\" />
		</td>
      	<td  class=\"dvtCellInfo\" align=\"left\">
		<input type=\"text\" name=\"inputcaption$i\" id=\"inputcaption$i\" onBlur='alphaNumericOnly(\"inputcaption$i\")' style=\"width:90%\"/></td>
		<td class=\"dvtCellInfo\" align=\"left\">";
	 	$str.=form_dropdown("fieldtype$i",$fieldtype,0,"id=\"fieldtype$i\" onchange=\"changlength($i)\"  style=\"width:100%;\" class=\"detailedViewTextBox\" ");

	 	$str.="</td>
		<td  class=\"dvtCellInfo\" align=\"center\">
		<input type=\"text\" name=\"length$i\" id=\"length$i\" disabled=\"disabled\" style=\"width:25px\"  maxlength=\"4\" />
		</td>
		<td  class=\"dvtCellInfo\" align=\"left\">";
		$str.=form_dropdown("inputtype$i",$inputtype,0,"id=\"inputtype$i\" onchange=\"checkselect($i)\" style=\"width:100%;\" ");
		$str.="</td>
		<td><span id=\"refid$i\" ></span></td>
		<td><span id=\"ref_value$i\"></span></td>
		<td><span id=\"ref_show$i\"></span></td>
		<td  class=\"dvtCellInfo\" align=\"center\"><input type=\"checkbox\" id=\"mandatory$i\" name=\"mandatory$i\" />
		</td>
		<td  class=\"dvtCellInfo\" align=\"center\"><input type=\"checkbox\" name=\"Unique$i\" id=\"Unique$i\"  /></td>
		<td  class=\"dvtCellInfo\" align=\"Right\">
		<input type=\"text\" name=\"inputorder$i\" id=\"inputorder$i\"  onkeypress=\"return numbersonly(event)\" maxlength=\"3\" style=\"width:20px\" />
		</td>
	 	<td  class=\"dvtCellInfo\" align=\"center\">";

		$str.=form_dropdown('align'.$i,$align,'Left','id="align'.$i.'" style="width:100%;" ');
		$str.="</td></tr>";

		echo $str.':::'.$csrf_token;
	}

	function duplicate_reference($add_edit=NULL,$edit_id=NULL)
	{
		if ($this->input->post('val') != "")
		{
			$csrf_token=$this->security->get_csrf_hash();
			$num_row=$this->Ref_model->duplicate_reference($this->input->post('val'),$edit_id);
			$var =
			array(
				"csrf_token"=>$csrf_token,
				"Message"=>"",
				"Status"=>$num_row>0?'duplicate':'ok'
			);
			echo json_encode($var);
    	}
	}
}
?>