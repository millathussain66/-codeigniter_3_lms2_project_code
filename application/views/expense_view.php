
<?php 

$CI =& get_instance();
$vendor = $CI->User_model->get_parameter_data('ref_paper_vendor','name','data_status = 1');
$lawyer = $CI->User_model->get_parameter_data('ref_lawyer','name','data_status = 1');
$where = "";
if($module_name == 'case_status')
{
	$where = " AND id IN(1)";
}
//$expense_activities = $CI->User_model->get_parameter_data('ref_schedule_chages','name','data_status = 1 AND case_type="'.$req_type.'"');
$expense_type = $CI->User_model->get_parameter_data('ref_expense_type','name','data_status = 1'.$where);
$district = $CI->User_model->get_parameter_data('ref_district','name','data_status = 1');
 ?>
<script type="text/javascript">
	var vendor = [<? $i=1; foreach($vendor as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
	var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
	var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
	var expense_activities = [];
	var expense_type = [<? $i=1; foreach($expense_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
	var staff = [];
	jQuery(document).ready(function() {
		//for expenses
		var theme = getDemoTheme();
		// jQuery("#expense_type_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Vendor Type", source: expense_type, width: 180, height: 25});
		// jQuery("#activities_name_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, width: 220, height: 25});
		// jQuery("#district_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 215, height: 25});
		// jQuery('#activities_name_1,#expense_type_1').focusout(function() {
  //           commbobox_check(jQuery(this).attr('id'));
  //       });
     });
	function get_expense_activities(type,counter,req_type)
	{
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
        url: '<?=base_url()?>index.php/authorization_request/get_activities',
        async:false,
        type: "post",
        data: { [csrfName]: csrfHash,type : type,req_type:req_type},
        datatype: "json",
        success: function(response){
        	var json = jQuery.parseJSON(response);
			jQuery('.txt_csrfname').val(json.csrf_token);
			var str='';
			var theme = getDemoTheme();
				var expense_activities = [];
				if(json.status=='success')
				{
					jQuery.each(json['row_info'],function(key,obj){
						expense_activities.push({ value: obj.id, label: obj.name });
					});
				}
				jQuery("#activities_name_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, width: 220, height: 25});
					jQuery('#activities_name_'+counter).focusout(function() {
		            commbobox_check(jQuery(this).attr('id'));
		        });

            },
            error:   function(model, xhr, options){
                alert('failed');
            },
        });
	}
	function change_vendor(id,counter)
	{
		var theme = getDemoTheme();
		var item = jQuery("#"+id).jqxComboBox('getSelectedItem');
		jQuery("#district_"+counter).jqxComboBox('clearSelection');
		jQuery("#district_"+counter).val('');
		jQuery("#district_"+counter).hide();
		if (item!=null)
		{
			if (item.value==1)
			{
				jQuery("#vendor_id_"+counter).show();
				jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 215, height: 25});
				document.getElementById('vendor_name_'+counter).style.display = 'none';
				jQuery("#vendor_name_"+counter).val('');
				jQuery('#vendor_id_'+counter).focusout(function() {
							commbobox_check(jQuery(this).attr('id'));
				});
				get_expense_activities(item.value,counter,'<?=$req_type?>');
				select_lawyer(counter);
			}else if(item.value==4)
			{
				jQuery("#vendor_id_"+counter).show();
				jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 215, height: 25});
				document.getElementById('vendor_name_'+counter).style.display = 'none';
				jQuery("#vendor_name_"+counter).val('');
				jQuery('#vendor_id_'+counter).focusout(function() {
							commbobox_check(jQuery(this).attr('id'));
				});
				get_expense_activities(item.value,counter,'<?=$req_type?>');
				select_lawyer(counter);
			}else if(item.value==2)
			{
				jQuery("#vendor_id_"+counter).show();
				jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Vendor", source: vendor, width: 215, height: 25});
				document.getElementById('vendor_name_'+counter).style.display = 'none';
				jQuery("#vendor_name_"+counter).val('');
				jQuery('#vendor_id_'+counter).focusout(function() {
							commbobox_check(jQuery(this).attr('id'));
				});
				get_expense_activities(item.value,counter,'<?=$req_type?>');
				un_select_lawyer(counter);
			}else if(item.value==3)
			{
				jQuery("#vendor_id_"+counter).show();
				jQuery("#district_"+counter).show();
				jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 215, height: 25});
				document.getElementById('vendor_name_'+counter).style.display = 'none';
				jQuery("#vendor_name_"+counter).val('');
				jQuery('#vendor_id_'+counter).focusout(function() {
							commbobox_check(jQuery(this).attr('id'));
				});
				get_expense_activities(item.value,counter,'<?=$req_type?>');
				un_select_lawyer(counter);
			}
			else if(item.value==5)
			{
				jQuery("#vendor_id_"+counter).show();
				jQuery("#district_"+counter).show();
				jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 215, height: 25});
				document.getElementById('vendor_name_'+counter).style.display = 'none';
				jQuery("#vendor_name_"+counter).val('');
				jQuery('#vendor_id_'+counter).focusout(function() {
							commbobox_check(jQuery(this).attr('id'));
				});
				get_expense_activities(item.value,counter,'<?=$req_type?>');
				un_select_lawyer(counter);
			}
			else{
				jQuery("#vendor_id_"+counter).hide();
				jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
				jQuery("#vendor_id_"+counter).val('');
				document.getElementById('vendor_name_'+counter).style.display = 'block';
				get_expense_activities(item.value,counter,'<?=$req_type?>');
				un_select_lawyer(counter);
			}
			
		}else{
			jQuery("#vendor_id_"+counter).hide();
			jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
			jQuery("#vendor_id_"+counter).val('');
			document.getElementById('vendor_name_'+counter).style.display = 'block'
		}
	}
	function get_dropdown_data(counter)
	{
		var item = jQuery("#district_"+counter).jqxComboBox('getSelectedItem');
		if (item!=null)
		{
			dropdown_name = 'staff';
			var district = item.value;
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
			jQuery.ajax({
	        url: '<?=base_url()?>index.php/authorization_request/get_dropdown_data',
	        async:false,
	        type: "post",
	       data: { [csrfName]: csrfHash,district : district,dropdown_name:dropdown_name},
	        datatype: "json",
	        success: function(response){
	        	var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
				var str='';
				var theme = getDemoTheme();
					if (dropdown_name=='staff')
					{
						var staff = [];
						jQuery.each(json['row_info'],function(key,obj){
							staff.push({ value: obj.id, label: obj.name+' ('+obj.pin+')' });
							//alert(obj.name);
						});
						jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 215, height: 25});
						jQuery('#vendor_id_'+counter).focusout(function() {
			            commbobox_check(jQuery(this).attr('id'));
			        });
					}

	            },
	            error:   function(model, xhr, options){
	                alert('failed');
	            },
	        	});
		}
		else
		{
			jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
			jQuery("#vendor_id_"+counter).val('');
		}
	}
	function add_more_expense()
	{
		var theme = getDemoTheme();
		var counter = jQuery('#expense_counter').val();
		var new_counter = parseInt(counter) + 1;
		html_string = '';

			html_string += '<tr id="expense_'+new_counter+'">';
			html_string += '<td>';
			html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
			html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
			html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
			html_string += '</td>';
			html_string += '<td><div id="expense_type_'+new_counter+'" name="expense_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange="change_vendor(\'expense_type_'+new_counter+'\','+new_counter+')"></div></td>';
			html_string += '<td><div id="district_'+new_counter+'" name="district_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data('+new_counter+')"></div><div id="vendor_id_'+new_counter+'" name="vendor_id_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none" ></div><input name="vendor_name_'+new_counter+'" type="text" class="" style="width:98%" id="vendor_name_'+new_counter+'" /></td>';
			html_string += '<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange="get_expense_amount(\'activities_name_'+new_counter+'\',<?=$cma_district?>,'+new_counter+',<?=$req_type?>)"></div></td>';
			html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" ></td>';
			html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
			html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
			html_string += '</tr>';

		jQuery('#expense_' + counter).after(html_string);
		jQuery('#expense_counter').val(new_counter);
		
		jQuery('#expense_type_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Vendor Type", source: expense_type, height: 25});
		jQuery('#expense_type_'+new_counter).focusout(function() {
					commbobox_check(jQuery(this).attr('id'));
		});
		jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 220, autoOpen: false, autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, height: 25});
		jQuery('#activities_name_'+new_counter).focusout(function() {
					commbobox_check(jQuery(this).attr('id'));
		});
		jQuery('#district_'+new_counter).jqxComboBox({theme: theme, width: 215, autoOpen: false, autoDropDownHeight: false, promptText: "Select District", source: district, height: 25});
		jQuery('#district_'+new_counter).focusout(function() {
					commbobox_check(jQuery(this).attr('id'));
		});
		datePicker('activities_date_'+new_counter);
		
	}
	function select_lawyer(new_counter)
	{
		jQuery("#vendor_id_"+new_counter).jqxComboBox('val', '<?=(isset($cma_data->lawyer) && $cma_data->lawyer!='')?$cma_data->lawyer:''?>');
		//jQuery('#vendor_id_'+new_counter).jqxComboBox({ disabled: true });
	}
	function un_select_lawyer(new_counter)
	{
		jQuery('#vendor_id_'+new_counter).jqxComboBox({ disabled: false });
	}
	function expense_validation()
	{
		var counter = jQuery('#expense_counter').val();
		for (i=1;i<=counter;i++) 
		{
			if(jQuery('#expense_delete_'+i).val()==0) 
			{
				var item = jQuery("#expense_type_"+i).jqxComboBox('getSelectedItem');
				var act = jQuery("#activities_name_"+i).jqxComboBox('getSelectedItem');
				if (!item)
				{
					alert('Vendor Type Required');
					jQuery('#expense_type_'+i+' input').focus();
					return false;
				}
				else
				{
					if (item.value==1 || item.value==2 || item.value==3 || item.value==4 || item.value==5)
					{
						var item2 = jQuery("#vendor_id_"+i).jqxComboBox('getSelectedItem');
						if (!item2)
						{
							alert('Vendor Required');
							jQuery('#vendor_id_'+i+' input').focus();
							return false;
						}
					}
					else
					{
						if(jQuery.trim(jQuery('#vendor_name_'+i).val())=='')
						{
							alert('Vendor Name Required');
							jQuery('#vendor_name_'+i).focus();
							return false;
						}
					}
					
				}
				if (!act)
				{
					alert('Activities Name Required');
					jQuery('#activities_name_'+i+' input').focus();
					return false;
				}
				if(jQuery.trim(jQuery('#activities_date_'+i).val())=='')
				{
					alert('Activities Date Required');
					jQuery('#activities_date_'+i).focus();
					return false;
				}
				if(jQuery.trim(jQuery('#activities_date_'+i).val())!='')
				{
					if(!validate_date(jQuery('#activities_date_'+i).val()))
					{
						alert('Activities Date Invalid');
						jQuery('#activities_date_'+i).focus();
						return false;
					}
				}
				if(jQuery.trim(jQuery('#amount_'+i).val())=='')
				{
					alert('Amount Required');
					jQuery('#amount_'+i).focus();
					return false;
				}
				if(jQuery.trim(jQuery('#amount_'+i).val())!='')
				{
					if(!checknumber_alphabatic('amount_'+i))
					{
						alert('Amount Only Numeric');
						jQuery('#amount_'+i).focus();
						return false;
					}
				}
				
			}
		}
		return true;
	}
	function delete_row_expense (row_id) {
		jQuery('#expense_' + row_id).hide();
		jQuery('#expense_delete_' + row_id).val(1);
	}
	function get_expense_amount(act_id,cma_district,counter,req_type) 
	{
		var theme = getDemoTheme();
		var item2 = jQuery("#expense_type_"+counter).jqxComboBox('getSelectedItem');
		var item = jQuery("#"+act_id).jqxComboBox('getSelectedItem');
		if(item2!=null && item2.value==1)
		{
			if (item!=null)
			{
				var act_id = item.value;
				var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
				var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
				jQuery.ajax({
		        url: '<?=base_url()?>index.php/Home/get_expense_amount',
		        async:false,
		        type: "post",
		       	data: { [csrfName]: csrfHash,cma_district : cma_district,act_id:act_id,req_type:req_type},
		        datatype: "json",
		        success: function(response){
		        	var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
					var str='';
					if(json.row_info['amount']>0){
                        jQuery('#amount_'+counter).val(json.row_info['amount']);
                    }else{
                        jQuery('#amount_'+counter).val(0);
                    }
		            },
		            error:   function(model, xhr, options){
		                alert('failed');
		            },
		        	});
			}
		}
		else
		{
			jQuery('#amount_'+counter).val('');
		}
	}
</script>
<tr>
	<?php if ($add_edit=='add'): ?>
		<td colspan="2">
			<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Expenses</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<input type="hidden" name="expense_counter" id="expense_counter" value="1">
						<tr>
							<td width="2%" style="font-weight: bold;text-align:center">D</td>
							<td width="18%" style="font-weight: bold;text-align:center">Expense Type<span style="color:red">*</span></td>
							<td width="20%" style="font-weight: bold;text-align:center">Vendor Name<span style="color:red">*</span></td>
							<td width="20%" style="font-weight: bold;text-align:center">Activities Name<span style="color:red">*</span></td>
							<td width="10%" style="font-weight: bold;text-align:center">Activities Date<span style="color:red">*</span></td>
							<td width="10%" style="font-weight: bold;text-align:center">Total Amount<span style="color:red">*</span></td>
							<td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
						</tr>
					</thead>
					<tbody id="expense_body">
						<tr id="expense_1">
								<td></td>
								<td>
									<input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">
									<input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">
            						<div id="expense_type_1" name="expense_type_1" style="padding-left: 3px;margin-left:5px" onchange="change_vendor('expense_type_1',1)"></div>
								</td>
								<td>
									<div id="district_1" name="district_1" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data(1)"></div>
									<div id="vendor_id_1" name="vendor_id_1" style="padding-left: 3px;margin-left:5px;display:none;width:90%"></div>
            						<input name="vendor_name_1" type="text" class="" style="width:98%" id="vendor_name_1" />
								</td>
								<td><div id="activities_name_1" name="activities_name_1" style="padding-left: 3px;margin-left:5px;width:90%" onchange="get_expense_amount('activities_name_1',<?=$cma_district?>,1,<?=$req_type?>)"></div></td>
								<td><input type="text" name="activities_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_1" value="" ><script type="text/javascript" charset="utf-8">datePicker ("activities_date_1");</script></td>
								<td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>
								<td><textarea name="remarks_1" class="text-input-big" id="remarks_1" style="height:40px !important;width:90%"></textarea></td>
						</tr>
					</tbody>
					<?php if ($module_name!='suit_file'): ?>
						<tfoot>
	        				<tr id="add_guarantor_row">
	        					<td colspan="9" style="text-align: right">
	        						Add More <input tabindex="" type="button" title="Add More" onClick="add_more_expense()" class="addmore"><br>
	        					</td>
	        				</tr>
	        			</tfoot>
					<?php endif ?>
					
				</table>
			</div>
		</td>
	<?php else: ?>
		<td colspan="2">
			<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
				<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Expenses</span>
				<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						
						<tr>
							<td width="2%" style="font-weight: bold;text-align:center">D</td>
							<td width="18%" style="font-weight: bold;text-align:center">Expense Type<span style="color:red">*</span></td>
							<td width="20%" style="font-weight: bold;text-align:center">Vendor Name<span style="color:red">*</span></td>
							<td width="20%" style="font-weight: bold;text-align:center">Activities Name<span style="color:red">*</span></td>
							<td width="10%" style="font-weight: bold;text-align:center">Activities Date<span style="color:red">*</span></td>
							<td width="10%" style="font-weight: bold;text-align:center">Total Amount<span style="color:red">*</span></td>
							<td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
						</tr>
					</thead>
					<tbody id="expense_body">
						<?php $cot=1; foreach ($expense_data as $key): ?>
							<tr id="expense_<?=$cot?>">
									<?php if ($cot>1): ?>
										<td align="left">
										<img src="<?=base_url()?>images/delete-New.png" alt="Delete" id="delete_icon_<?=$cot?>" onclick="delete_row_expense(<?=$cot?>)" style="cursor:pointer;">
										</td>
									<?php else: ?>
										<td align="left">
										</td>
									<?php endif ?>
									<td>
										<input type="hidden" id="expense_delete_<?=$cot?>" name="expense_delete_<?=$cot?>" value="0">
										<input type="hidden" id="expense_edit_<?=$cot?>" name="expense_edit_<?=$cot?>" value="<?=isset($key->id)?$key->id:''?>">
                						<div id="expense_type_<?=$cot;?>" name="expense_type_<?=$cot?>" style="padding-left: 3px;margin-left:5px" onchange="change_vendor('expense_type_<?=$cot?>',<?=$cot?>)"></div>
									</td>
									<td>
										<div id="district_<?=$cot?>" name="district_<?=$cot?>" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data(<?=$cot?>)"></div>
										<div id="vendor_id_<?=$cot?>" name="vendor_id_<?=$cot?>" style="padding-left: 3px;margin-left:5px;display:none;width:90%"></div>
                						<input name="vendor_name_<?=$cot?>" type="text" class="" style="width:98%" id="vendor_name_<?=$cot?>" value="<?=isset($key->vendor_name)?$key->vendor_name:''?>"/>
									</td>
									<td><div id="activities_name_<?=$cot?>" name="activities_name_<?=$cot?>" style="padding-left: 3px;margin-left:5px;" ></div></td>
									<td><input type="text" name="activities_date_<?=$cot?>" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_<?=$cot?>" value="<?=isset($key->activities_date)?date_format(date_create($key->activities_date),"d/m/Y"):''?>" ><script type="text/javascript" charset="utf-8">datePicker ("activities_date_<?=$cot?>");</script></td>
									<td><input name="amount_<?=$cot?>" type="text" class="" style="width:90%" id="amount_<?=$cot?>" value="<?=isset($key->amount)?$key->amount:''?>" />
										<?php if ($key->procurement!=''): ?>
											<input type="text" name="p_cost_<?=$cot?>" tabindex="" placeholder="" style="width:90%;" id="p_cost_<?=$cot?>" value="<?=isset($key->procurement)?$key->procurement:''?>" onkeypress="return numbersonly(event)" onKeyUp="javascript:return add_procurment(this.value,<?=$cot?>);">
										<?php endif ?>
									</td>
									<td><textarea name="remarks_<?=$cot?>" class="text-input-big" id="remarks_<?=$cot?>" style="height:40px !important;width:90%"><?=isset($key->remarks)?$key->remarks:''?></textarea></td>
									<script>
									var theme = getDemoTheme();
										jQuery("#expense_type_<?=$cot;?>").jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Expense Type", source: expense_type, height: 25});
										jQuery("#expense_type_<?=$cot;?>").jqxComboBox('val', '<?=(isset($key->expense_type) && $key->expense_type!='')?$key->expense_type:''?>');
										jQuery('#expense_type_<?=$cot;?>').focusout(function() {
								            commbobox_check(jQuery(this).attr('id'));
								        });
								        //jQuery("#activities_name_<?=$cot;?>").jqxComboBox({theme: theme, width: 220, autoOpen: false, autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, height: 25});
										jQuery("#activities_name_<?=$cot;?>").jqxComboBox('val', '<?=(isset($key->activities_name) && $key->activities_name!='')?$key->activities_name:''?>');
										// jQuery('#activities_name_<?=$cot;?>').focusout(function() {
								  //           commbobox_check(jQuery(this).attr('id'));
								  //       });
								        jQuery("#district_<?=$cot;?>").jqxComboBox({theme: theme, width: 215, autoOpen: false, autoDropDownHeight: false, promptText: "Select District", source: district, height: 25});
								        <?php if ($key->expense_type==3 || $key->expense_type==5): ?>
											jQuery("#district_<?=$cot;?>").jqxComboBox('val', '<?=(isset($key->district) && $key->district!='')?$key->district:''?>');
											jQuery('#district_<?=$cot;?>').focusout(function() {
									            commbobox_check(jQuery(this).attr('id'));
									        });
									        
									        get_dropdown_data(<?=$cot?>);
								        <?php endif ?>
										jQuery("#vendor_id_<?=$cot;?>").jqxComboBox('val', '<?=(isset($key->vendor_id) && $key->vendor_id!='')?$key->vendor_id:''?>');
										//jQuery("#activities_name_<?=$cot;?>").setAttribute( "onchange", "get_expense_amount('activities_name_<?=$cot?>',<?=$cma_district?>,<?=$cot?>)" );
										//document.getElementById("activities_name_<?=$cot;?>").onchange = function() {get_expense_amount('activities_name_<?=$cot?>',<?=$cma_district?>,<?=$cot?>,<?=$req_type?>)};
									</script>
							</tr>
						<?php $cot++; endforeach ?>
						<input type="hidden" name="expense_counter" id="expense_counter" value="<?=$cot-1?>">
					</tbody>
					<?php if ($module_name!='suit_file'): ?>
						<tfoot>
	        				<tr id="add_guarantor_row">
	        					<td colspan="9" style="text-align: right">
	        						Add More <input tabindex="" type="button" title="Add More" onClick="add_more_expense()" class="addmore"><br>
	        					</td>
	        				</tr>
	        			</tfoot>
					<?php endif ?>
					
				</table>
			</div>
		</td>
	<?php endif ?>
</tr>