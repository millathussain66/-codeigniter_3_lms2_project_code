<script type="text/javascript" src="<?=base_url()?>js/jquery.ajaxupload.js"></script>
 <!--  styling starts: -->
<style type="text/css">

	#cto_data_table {
		border-collapse: collapse;
	}

	#cto_data_table, #cto_data_table th, #cto_data_table td {
	    border-color: #c7c7c7;
	}
	.text-input-medium{
		width: 250px;
	}
    .addmore
	{
		background-image:url(<?=base_url()?>images/addmore_grn.png);
		/*background-size: 20px 20px;*/
		background-repeat: no-repeat;
		border:0;
		width:18px; height:18px;
		background-color:transparent;
		cursor:pointer;
	}
	
	.del
	{
		background-image:url(<?=base_url()?>images/del.png);
		background-repeat: no-repeat;
		border:0;
		width:18px; height:18px;
		background-color:transparent;
		cursor:pointer;
	}
	.edit
	{
		background-image:url(<?=base_url()?>images/edit.png);
		background-repeat: no-repeat;
		border:0;
		width:18px; height:18px;
		background-color:transparent;
		cursor:pointer;
	}
	.nextButton
	{
		float: right;
		margin: 10px;
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}
	.backButton
	{
		float: left;
		margin: 10px;
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}
	#tab1Table td,#tab3Table td,#tab2Table td{
		vertical-align: top;
	}
	table#addressTable {
		border-collapse: collapse;
	}

	table#addressTable, #addressTable th, #addressTable td {
	    border: 1px solid #c7c7c7;
	}

	table#addressTablet {
		border-collapse: collapse;
	}

	table#addressTablet, #addressTablet th, #addressTablet td {
	    border: 1px solid #c7c7c7;
	}

	table#facility_info td {
		border: 1px solid #c7c7c7;
		text-align: center;
	}

	table#loanTable {
		border-collapse: collapse;
	}

	table#loanTable, #loanTable th, #loanTable td {
	    border: 1px solid #c7c7c7;
	}
	table#loanTable_detail {
		border-collapse: collapse;
	}
	table#guarantor_info td {
		border: 1px solid #c7c7c7;
		text-align: center;
	}
	table#loanTable_detail, #loanTable_detail th, #loanTable_detail td {
	    border: 1px solid #c7c7c7;
	}
	#loanTable_detail th, #loanTable_detail td{
		text-align: center;
	}
	#addressTable th, #addressTable td{
		text-align: center;
	}
	#addressTablet th, #addressTablet td{
		text-align: center;
	}
	#loanTable th, #loanTable td{
		text-align: center;
	}
	table#owner_addressTable {
		border-collapse: collapse;
	}

	table#owner_addressTable, #owner_addressTable th, #owner_addressTable td {
	    border: 1px solid #c7c7c7;
	}
	#owner_addressTable th, #owner_addressTable td{
		text-align: center;
	}
	table#owner_addressTablet {
		border-collapse: collapse;
	}

	table#owner_addressTablet, #owner_addressTablet th, #owner_addressTablet td {
	    border: 1px solid #c7c7c7;
	}
	#owner_addressTablet th, #owner_addressTablet td{
		text-align: center;
	}
	#ownerTable {
		border-collapse: collapse;
	}

	#ownerTable, #ownerTable th, #ownerTable td {
	    border-color: #c7c7c7;
	}
	.hint{

		color: red;
	}
	.section
	{
		padding: 5px;
	}
	#hintWrapper{
		float: left;
		margin: 10px;
	}

	.jqx-window-modal
	{
		height: 625px !important;
	}

	.nextButton
	{
		float: right;
		margin: 10px;
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}
	.backButton
	{
		float: left;
		margin: 10px;
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}
	 #sectionButtonsWrapper
	{
		float: right;
	}

	#basketButtonsWrapper
	{
		float: right;

	}

	#selectedProductsButtonsWrapper
	{
		float: right;

	}
	#ownerSave,#addmoreOwner{
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}

    .dateSpan{
      font-weight: normal;
      font-size: 12px;
      color: #808080;
    }
    .tablescroll #headerTable td{ border:none;}
		.headSpan {
			float:left;font-weight:bold; font-size:9pt;cursor:pointer;
		}
    </style>

		<!--   styling Ends:  -->

    <script type="text/javascript">
		var csrf_tokens='';

		jQuery(document).ready(function () {

		var theme = getDemoTheme();
		jQuery('#in_req_button').jqxButton({template:"default",width:"150"});
		
		var certificate_type = [<? $i=1; foreach($certificate_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		var request_from = [<? $i=1; foreach($request_from as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		
		jQuery('.text-input').addClass('jqx-input');
		jQuery('.text-input').addClass('jqx-rc-all');
		if (theme.length > 0) {
			jQuery('.text-input').addClass('jqx-input-' + theme);
			jQuery('.text-input').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input').addClass('jqx-rc-all-' + theme);
		}
		
		//Combobox
		jQuery("#certificate_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Certificate Type", source: certificate_type, width: 250, height: 25});
		jQuery("#request_from").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Request From", source: request_from, width: 250, height: 25});
		
		jQuery('#certificate_type,#request_from').focusout(function() {
           //alert(jQuery(this).attr('id'));
            commbobox_check(jQuery(this).attr('id'));
        });
        <? if($add_edit=='edit'){?>
			jQuery("#certificate_type").jqxComboBox('val', '<?=(isset($result->certificate_type) && $result->certificate_type!=0)?$result->certificate_type:''?>');
			jQuery("#request_from").jqxComboBox('val', '<?=(isset($result->request_from) && $result->request_from!=0)?$result->request_from:''?>');
		<? } ?>

		<? if($add_edit=='edit'){ ?>
			jQuery("#certificate_file").change(function(){
				if(jQuery("#file_change_sts").val()=='0'){
					if(confirm('Are you sure to replace previous file?')){			
						jQuery("#file_change_sts").val('1');	
						jQuery("#file_preview").hide();	
					} else {
						jQuery("#certificate_file").val('');
						return false;
					}
				}
			});
		<? } ?>
        // initialize validator.
        validToggle = 0;
		jQuery('#ait_vat_form').jqxValidator({
			rules: [
			{ input: '#certificate_type', message: 'Required!', action: 'blur, change', rule: function (input) {
					if(input.val() != '')
					{
						var item = jQuery("#certificate_type").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='certificate_type']").val(item.value);}
						return true;
					}
					return false;
				}
			},
			{ input: '#request_from', message: 'Required!', action: 'blur, change', rule: function (input) {
					if(input.val() != '')
					{
						var item = jQuery("#request_from").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='request_from']").val(item.value);}
						return true;
					}
					return false;
				}
			},
			{ input: '#request_date', message: 'Required!', action: 'keyup, blur, change', rule: 'required' },
			{ input: '#request_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
				if (!input.val()) {
					return true;
				}
				if(validate_date(input.val()))
				{
					return true;
				}else {
					return false;
				}
			} },
			{ input: '#inform_date', message: 'Required!', action: 'keyup, blur, change', rule: 'required' },
			{ input: '#inform_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
				if (!input.val()) {
					return true;
				}
				if(validate_date(input.val()))
				{
					return true;
				}else {
					return false;
				}
			} },
			{ input: '#certificate_rec_dt', message: 'Required!', action: 'keyup, blur, change', rule: 'required' },
			{ input: '#certificate_rec_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
				if (!input.val()) {
					return true;
				}
				if(validate_date(input.val()))
				{
					return true;
				}else {
					return false;
				}
			} },
			{ input: '#certificate_sts', message: 'Required!', action: 'keyup, blur, change', rule: 'required' },
			{ input: '#certificate_sts', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
				if (!input.val()) {
					return true;
				}
				if(validate_date(input.val()))
				{
					return true;
				}else {
					return false;
				}
			} },
			
			]
		});
		jQuery('#ait_vat_form').jqxValidator({ onError: function () { validToggle = 0;} });
		jQuery('#ait_vat_form').jqxValidator({ onSuccess: function () { validToggle = 1;} });
		 
	});
	function certificate_file_validation()
	{
		<? if($add_edit=='add'){ ?>
			if (jQuery("#certificate_file").val()=='') 
			{
				alert('Certificate File Needed!!');
				return false;
			}
			else{
				return true;
			}
		<? } ?>
		<? if($add_edit=='edit'){ ?>
			if (jQuery("#hidden_certificate_file").val()=='' && jQuery("#file_change_sts").val()==0) 
			{
				alert('Certificate File Needed!!');
				return false;
			}
			else{
				return true;
			}
		<? } ?>
		
	}
    </script>

<body style="height:94%;">
	<div  style=" width:99.8%; margin:auto">
	<div class="form" ><div class="formHeader" >AIT & VAT( Region : <?=$this->session->userdata['ast_user']['region_name']?> & District : <?=$this->session->userdata['ast_user']['branch_name']?> ) </div></div>
    	<div style="width:96%;margin: auto;paddding: 10px;">
	       <form class="form" name="ait_vat_form" id="ait_vat_form" method="post" action="<?=base_url()?>index.php/ait_vat/add_edit_action/<?=$add_edit?>/<?=$id?>" enctype="multipart/form-data">
			<?=form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash())?>
	    	<input type="hidden" id="add_edit" value="<?=$add_edit?>" name="add_edit">
		       <table style="width:100%" id="tab1Table">
					<tbody>
						<tr>
							<td colspan="2">
								<fieldset>
									<legend style="font-weight: bold; color: #4197c7;background-color:white" align="left">AIT & VAT</legend>
										<table style="width: 100%;">
										<tr>
											<td width="20%" style="font-weight: bold;">Certificate Type:<span style="color:red">*</span> </td>
											<td width="30%" ><div id="certificate_type" name="certificate_type" style="padding-left: 3px"></div></td>
											<td width="20%" style="font-weight: bold;">Request From:<span style="color:red">*</span> </td>
											<td width="30%" ><div id="request_from" name="request_from" style="padding-left: 3px"></div></td>
										</tr>
										<tr>
											<td width="20%" style="font-weight: bold;">Request date:<span style="color:red">*</span> </td>
											<td width="30%" ><input type="text" name="request_date" style="width:250px" id="request_date" value="<?=isset($result->request_date)?date_format(date_create($result->request_date),"d/m/Y"):''?>"  class="text-input"><script type="text/javascript" charset="utf-8">datePicker ("request_date");</script></td>
											<td width="20%" style="font-weight: bold;">Inform to Finance team :<span style="color:red">*</span> </td>
											<td width="30%" ><input type="text" name="inform_date" style="width:250px" id="inform_date" value="<?=isset($result->inform_date)?date_format(date_create($result->inform_date),"d/m/Y"):''?>"  class="text-input"><script type="text/javascript" charset="utf-8">datePicker ("inform_date");</script></td>
										</tr>
										<tr>
											<td width="20%" style="font-weight: bold;">Certificate Received:<span style="color:red">*</span> </td>
											<td width="30%" ><input type="text" name="certificate_rec_dt" style="width:250px" id="certificate_rec_dt" value="<?=isset($result->certificate_rec_dt)?date_format(date_create($result->certificate_rec_dt),"d/m/Y"):''?>"  class="text-input"><script type="text/javascript" charset="utf-8">datePicker ("certificate_rec_dt");</script></td>
											<td width="20%" style="font-weight: bold;">AIT & VAT certificate  Status :<span style="color:red">*</span> </td>
											<td width="30%" ><input type="text" name="certificate_sts" style="width:250px" id="certificate_sts" value="<?=isset($result->certificate_sts)?date_format(date_create($result->certificate_sts),"d/m/Y"):''?>"  class="text-input"><script type="text/javascript" charset="utf-8">datePicker ("certificate_sts");</script></td>
										</tr>
										<tr>
											<td width="20%" style="font-weight: bold;">AIT & VAT certificate  File:<span style="color:red">*</span> </td>
											<td style="text-align: left;">
											<? if($add_edit =='edit' && $result->certificate_file!=''){ ?>
				                                            
			                                    	<img id="file_preview" onclick="popup('<?=base_url()?>ait_vat_files/<?=$result->certificate_file?>')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png">
			                                    	
			                                    &nbsp; &nbsp; &nbsp; &nbsp;
			                                <? } /*<img onclick="aof_delete(<?=$id?>)" src="<?=base_url()?>images/delete.png" alt="Delete" title="Delete">*/?>
											<input type="file" id="certificate_file" name="certificate_file">
											<input type="hidden" id="hidden_certificate_file" name="hidden_certificate_file" value="<? if($add_edit =='edit'){ echo $result->certificate_file; } ?>" />
			                                <input type="hidden" id="file_change_sts" name="file_change_sts" value="0">
											</td>
											<td width="20%" style="font-weight: bold;">Remarks:</td>
											<td width="30%" ><textarea name="remarks" class="text-input-big" id="remarks" style="height:40px !important;width:250px"><?=isset($result->remarks)?$result->remarks:''?></textarea></td>
										</tr>
																													
									</table>
								</fieldset>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align: center;">
								<input type="button" value="Save" id="in_req_button" class="nextButton" style="margin:10px 25px 10px 10px;" /> <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
							</td>
						</tr>

					</tbody>
				</table>
			</form>
	    </div>
	</div>
</body>
<script type="text/javascript">
	function popup(url) {
		var winl = (screen.width - 900) / 2;
		var wint = 40;
		newwindow=window.open(url,'name','height=600, width=900,top='+wint+', toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left='+winl);
		if (window.focus) {newwindow.focus()}
		return false;
	}
	var options = { 
			complete: function(response) 
			{
				console.log(response);
				var json = jQuery.parseJSON(response.responseText); 
				if(csrf_tokens==''){
					csrf_tokens='<?php echo $this->security->get_csrf_hash(); ?>';
				}
				if(json.csrf_token=csrf_tokens){
				csrf_tokens=json.csrf_token;
				// alert(json.id)
					}else{
						window.location.replace('<?=base_url()?>index.php/home/logout');
					}
				if(json.Message!='OK')
				{
					jQuery("#in_req_button").show();
					jQuery("#in_req_loading").hide();
					alert(json.Message);
					return false;
				}
				else
				{
					var row = {};  
	   				//console.log(json['row_info']);
					row["id"] = json['row_info'].id;
					row["sts"] = json['row_info'].sts;
					row["v_sts"] = json['row_info'].v_sts;
					row["stc_sts"] = json['row_info'].stc_sts;
					row["request_date"] = json['row_info'].request_date;
					row["inform_date"] = json['row_info'].inform_date;
					row["certificate_rec_dt"] = json['row_info'].certificate_rec_dt;
					row["certificate_file"] = json['row_info'].certificate_file;
					row["certificate_sts"] = json['row_info'].certificate_sts;
					row["remarks"] = json['row_info'].remarks;
					//console.log(row);
					//window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
					
					window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
					<? if($add_edit=='add'){?>
					//alert(json['row_info'].loan_ac);
					var paginginformation = window.parent.jQuery("#jqxgrid").jqxGrid('getpaginginformation');
					var insert_index=paginginformation.pagenum*paginginformation.pagesize;
					var commit = window.parent.jQuery("#jqxgrid").jqxGrid('addrow', null, row,insert_index);
					window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', insert_index);
					<? }else{?>
					jQuery.each(row, function(key,val){
						window.parent.jQuery("#jqxgrid").jqxGrid('setcellvalue', <?=$editrow?>, key, row[key]);
					});
					window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', <?=$editrow?>);
					<? }?>
					window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
					jQuery("#msgArea").val('');
					window.parent.jQuery("#error").show();
					window.parent.jQuery("#error").fadeOut(11500);
					window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');							
					window.top.EOL.messageBoard.close();
				}
							
			}  
		}; 
		jQuery("#ait_vat_form").ajaxForm(options);
		jQuery("#in_req_button").click(	function() {
			var validationResult = function (isValid) {
				if (isValid && certificate_file_validation()==true) {
					jQuery("#in_req_button").hide();
					jQuery("#in_req_loading").show();
					jQuery("#ait_vat_form").submit();
				}
			}
			jQuery('#ait_vat_form').jqxValidator('validate', validationResult);		
		});
</script>
