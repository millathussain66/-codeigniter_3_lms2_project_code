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
		var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		var vendor = [<? $i=1; foreach($vendor as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		jQuery(document).ready(function () {

		var theme = getDemoTheme();
		jQuery('#in_req_button').jqxButton({template:"default",width:"120"});
		
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
		
		
		jQuery('#certificate_type,#request_from,#v_name').focusout(function() {
           //alert(jQuery(this).attr('id'));
            commbobox_check(jQuery(this).attr('id'));
        });
        <? if($add_edit=='edit'){?>
			jQuery("#certificate_type").jqxComboBox('val', '<?=(isset($result->certificate_type) && $result->certificate_type!=0)?$result->certificate_type:''?>');
			jQuery("#request_from").jqxComboBox('val', '<?=(isset($result->request_from) && $result->request_from!=0)?$result->request_from:''?>');
			<?php if($result->request_from==1 || $result->request_from==2){ ?>
				jQuery("#v_name").jqxComboBox('val', '<?=(isset($result->vendor_id) && $result->vendor_id!=0)?$result->vendor_id:''?>');
			<?php }else{?>
				jQuery("#oth_name").val('<?=(isset($result->vendor_id) && $result->vendor_name!='')?$result->vendor_name:''?>');
			<?php } ?>
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
			{ input: '#v_name', message: 'Required!', action: 'blur, change', rule: function (input) {
					
					var item2 = jQuery("#request_from").jqxComboBox('getSelectedItem');
					if(item2!=null)
					{
						if (item2.value==1 || item2.value==2) {
								if(input.val() != '')
								{
									var item = jQuery("#v_name").jqxComboBox('getSelectedItem');
									if(item != null){jQuery("input[name='v_name']").val(item.value);}
									return true;
								}
								return false;
						}
						else{
							return true;
						}
					}
					else
					{
						return true;
					}
				}
			},
			{ input: '#oth_name', message: 'Required!', action: 'blur, change', rule: function (input) {
					
					var item2 = jQuery("#request_from").jqxComboBox('getSelectedItem');
					if(item2!=null)
					{
						if (item2.value>2) {
								if(input.val() != '')
								{
									return true;
								}
								return false;
						}
						else{
							return true;
						}
					}
					else
					{
						return true;
					}
				}
			},
			
			]
		});
		jQuery('#ait_vat_form').jqxValidator({ onError: function () { validToggle = 0;} });
		jQuery('#ait_vat_form').jqxValidator({ onSuccess: function () { validToggle = 1;} });
		 
	});
	
	function change_dropdown(){

		var theme = getDemoTheme();
		var item = jQuery("#request_from").jqxComboBox('getSelectedItem');
		//alert(item.value)
		if (item!=null)
		{
			if (item.value==1)
			{
				jQuery("#label_name").html('Lawyer ');
				jQuery("#oth_name").hide();
				jQuery("#oth_name").val('');
				jQuery("#v_name").show();
				jQuery("#v_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
				jQuery('#v_name').focusout(function() {
		            commbobox_check(jQuery(this).attr('id'));
		        });
			}else if(item.value==2){
				jQuery("#label_name").html('Vendor ');
				jQuery("#oth_name").hide();
				jQuery("#oth_name").val('');
				jQuery("#v_name").show();
				jQuery("#v_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Vendor", source: vendor, width: 250, height: 25});
				jQuery('#v_name').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
			}else if(item.value==3){
				jQuery("#label_name").html('Stuff ');
				jQuery("#v_name").hide();
				jQuery("#v_name").jqxComboBox('clearSelection');
				jQuery("#v_name").val('');
				jQuery("#oth_name").show();
			}else{
				jQuery("#label_name").html('');
				jQuery("#v_name").hide();
				jQuery("#v_name").jqxComboBox('clearSelection');
				jQuery("#v_name").val('');
				jQuery("#oth_name").show();
			}
		}else{
			jQuery("#v_name").jqxComboBox('clearSelection');
			jQuery("#v_name").val('');
			jQuery("#oth_name").val('');
		}
	}
</script>

<body style="height:94%;">
	<div  style=" width:99.8%; margin:auto">
	<div class="form" ><div class="formHeader" style="background-color:#185891;">AIT & VAT Info</div></div>
    	<div style="width:96%;margin: auto;paddding: 10px;">
	       <form class="form" name="ait_vat_form" id="ait_vat_form" method="post" action="<?=base_url()?>index.php/ait_vat/add_edit_action/<?=$add_edit?>/<?=$id?>" enctype="multipart/form-data">
			<?=form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash())?>
	    	<input type="hidden" id="add_edit" value="<?=$add_edit?>" name="add_edit">
		       <table style="width:100%;margin-top:20px" id="tab1Table">
					<tbody>
						<tr>
							<td colspan="2">
								
										<table style="width: 100%;">
										<tr>
											<td width="20%" style="font-weight: bold;">Certificate Type:<span style="color:red">*</span> </td>
											<td width="30%" ><div id="certificate_type" name="certificate_type" style="padding-left: 3px"></div></td>
											<td width="20%" style="font-weight: bold;"></td>
											<td width="30%" ></td>
										</tr>
										<tr>
											<td width="20%" style="font-weight: bold;">Request From:<span style="color:red">*</span> </td>
											<td width="30%" ><div id="request_from" name="request_from" onchange="change_dropdown()" style="padding-left: 3px"></div></td>
											<td width="20%" style="font-weight: bold;"> </td>
											<td width="30%" ></td>
										</tr>
										<tr>
											<td width="20%" style="font-weight: bold;"><span id="label_name"></span>Name:<span style="color:red">*</span> </td>
											<td width="30%" ><div id="v_name" name="v_name" style="padding-left: 3px"></div><input name="oth_name" type="text" class="" style="width:250px" id="oth_name" value="<?=isset($result->vendor_name)?$result->vendor_name:''?>"/></td>
											<td width="20%" style="font-weight: bold;"></td>
											<td width="30%" ></td>
										</tr>
										<tr>
											<td width="20%" style="font-weight: bold;">Remarks:</td>
											<td width="30%" ><textarea name="remarks" class="text-input-big" id="remarks" style="height:40px !important;width:250px"><?=isset($result->remarks)?$result->remarks:''?></textarea></td>
											<td width="20%" style="font-weight: bold;"></td>
											<td style="text-align: left;">
											</td>
										</tr>
										<tr>
											<td width="20%"></td>
											<td width="30%">
												<input type="button" value="Save" id="in_req_button" class="" style="margin:10px 25px 10px 10px;" /> <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
											</td>
											<td width="20%"></td>
											<td width="30%"></td>
										</tr>																	
									</table>
								
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
				//console.log(response.responseText);
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
					
					window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
					
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

				if (isValid) {
					//alert('ddd')
					jQuery("#in_req_button").hide();
					jQuery("#in_req_loading").show();
					jQuery("#ait_vat_form").submit();
				}
			}
			jQuery('#ait_vat_form').jqxValidator('validate', validationResult);		
		});
</script>
