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
		
		var document_type = [<? $i=1; foreach($document_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		
		jQuery('.text-input').addClass('jqx-input');
		jQuery('.text-input').addClass('jqx-rc-all');
		if (theme.length > 0) {
			jQuery('.text-input').addClass('jqx-input-' + theme);
			jQuery('.text-input').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input').addClass('jqx-rc-all-' + theme);
		}
		
		//Combobox
		jQuery("#document_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Certificate Type", source: document_type, width: 250, height: 25});
		
		jQuery('#document_type').focusout(function() {
           //alert(jQuery(this).attr('id'));
            commbobox_check(jQuery(this).attr('id'));
        });
        <? if($add_edit=='edit'){?>
			jQuery("#document_type").jqxComboBox('val', '<?=(isset($result->document_type) && $result->document_type!=0)?$result->document_type:''?>');
		<? } ?>

		<? if($add_edit=='edit'){ ?>
			jQuery("#doc_file").change(function(){
				if(jQuery("#file_change_sts").val()=='0'){
					if(confirm('Are you sure to replace previous file?')){			
						jQuery("#file_change_sts").val('1');	
						jQuery("#file_preview").hide();	
					} else {
						jQuery("#doc_file").val('');
						return false;
					}
				}
			});
		<? } ?>
        // initialize validator.
        validToggle = 0;
		jQuery('#doc_file_upload_form').jqxValidator({
			rules: [
			{ input: '#document_type', message: 'Required!', action: 'blur, change', rule: function (input) {
					if(input.val() != '')
					{
						var item = jQuery("#document_type").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='document_type']").val(item.value);}
						return true;
					}
					return false;
				}
			},
			{ input: '#doc_name', message: 'Required!', action: 'blur, change', rule: function (input) {
					if(input.val() != '')
					{
						return true;
					}
					return false;
				}
			}	
			,
			{ input: '#doc_file', message: 'Required!', action: 'blur, change', rule: function (input) {
				
					if(jQuery("#hidden_doc_file").val()!='' )
					{
						return true;
					}
					else if(input.val() != '' &&  jQuery("#hidden_doc_file").val()==''  )
					{
						return true;
					}
					return false;
				}
			}			
			]
		});
		jQuery('#doc_file_upload_form').jqxValidator({ onError: function () { validToggle = 0;} });
		jQuery('#doc_file_upload_form').jqxValidator({ onSuccess: function () { validToggle = 1;} });
		 
	});
	function certificate_file_validation()
	{
		<? if($add_edit=='add'){ ?>
			if (jQuery("#doc_name").val()=='') 
			{
				alert('Doc Name Needed!!');
				return false;
			}
			else if (jQuery("#doc_name").val()=='') 
			{
				alert('Doc Name Needed!!');
				return false;
			}
			else if (jQuery("#doc_file").val()=='') 
			{
				alert('Doc file Needed!!');
				return false;
			}
			else{
				return true;
			}
		<? } ?>
		<? if($add_edit=='edit'){ ?>
			if (jQuery("#hidden_doc_file").val()=='' && jQuery("#file_change_sts").val()==0) 
			{
				alert('Doc File Needed!!');
				return false;
			}
			else if (jQuery("#doc_name").val()=='') 
			{
				alert('Doc Name Needed!!');
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
	<div class="form" ><div class="formHeader" style="background-color:#185891;">Document Upload</div></div>
    	<div style="width:96%;margin: auto;paddding: 10px;">
	       <form class="form" name="doc_file_upload_form" id="doc_file_upload_form" method="post" action="<?=base_url()?>index.php/doc_upload/add_edit_action/<?=$add_edit?>/<?=$id?>" enctype="multipart/form-data">
			<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	    	<input type="hidden" id="add_edit" value="<?=$add_edit?>" name="add_edit">
		       <table style="width:100%" id="tab1Table">
					<tbody>
						<tr>
							<td colspan="2">
								<table style="width: 100%;">
										<tr>
											<td width="20%" style="font-weight: bold;">Document Type:<span style="color:red">*</span> </td>
											<td width="30%" ><div id="document_type" name="document_type" style="padding-left: 3px"></div></td>
											<td width="20%" style="font-weight: bold;">Doc File:<span style="color:red">*</span> </td>
											<td style="text-align: left;">
											<? if($add_edit =='edit' && $result->doc_file!=''){ ?>
				                                            
			                                    	<img id="file_preview" onclick="popup('<?=base_url()?>doc_files/<?=$result->doc_file?>')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png">
			                                    	
			                                    &nbsp; &nbsp; &nbsp; &nbsp;
			                                <? } /*<img onclick="aof_delete(<?=$id?>)" src="<?=base_url()?>images/delete.png" alt="Delete" title="Delete">*/?>
											<input type="file" id="doc_file" name="doc_file">
											<input type="hidden" id="hidden_doc_file" name="hidden_doc_file" value="<? if($add_edit =='edit'){ echo $result->doc_file; } ?>" />
			                                <input type="hidden" id="file_change_sts" name="file_change_sts" value="0">
											</td>
										</tr>
										<tr>
                                        	<td width="20%" style="font-weight: bold;">Document Name:<span style="color:red">*</span> </td>
											<td width="30%" ><input type="text" style="width:248px" id="doc_name" name="doc_name"  value="<?=isset($result->document_name)?$result->document_name:''?>"></td>
											<td width="20%" style="font-weight: bold;">Remarks:</td>
											<td width="30%" ><textarea name="remarks" class="text-input-big" id="remarks" style="height:40px !important;width:250px"><?=isset($result->remarks)?$result->remarks:''?></textarea></td>
										</tr>
																													
									</table>
							</td>
						</tr>
						

					</tbody>
				</table>
				<div style="text-align:center;">
					<input type="button" value="Save" id="in_req_button" class=""  /> <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
				</div>
				
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
				var json = jQuery.parseJSON(response.responseText); 
				window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
				jQuery('.txt_csrfname').val(json.csrf_token);
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
					row["e_dt"] = json['row_info'].e_dt;
					row["doc_type"] = json['row_info'].doc_type;
					row["doc_file"] = json['row_info'].doc_file;
					row["remarks"] = json['row_info'].remarks;
					window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
					jQuery("#msgArea").val('');
					window.parent.jQuery("#error").show();
					window.parent.jQuery("#error").fadeOut(11500);
					window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');							
					window.top.EOL.messageBoard.close();
				}
							
			}  
		}; 
		jQuery("#doc_file_upload_form").ajaxForm(options);
		jQuery("#in_req_button").click(	function() {
			var validationResult = function (isValid) {
				if (isValid && certificate_file_validation()==true) {
					jQuery("#in_req_button").hide();
					jQuery("#in_req_loading").show();
					jQuery("#doc_file_upload_form").submit();
				}
			}
			jQuery('#doc_file_upload_form').jqxValidator('validate', validationResult);		
		});
</script>
