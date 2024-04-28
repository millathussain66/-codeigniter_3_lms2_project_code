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
    span.login-text {
	    font-size: 15px;
	    display:table;
	    margin-left: auto;
	    margin-right: 110px;
	}
    .tablescroll #headerTable td{ border:none;}
		.headSpan {
			float:left;font-weight:bold; font-size:9pt;cursor:pointer;
		}
		#gurantor_table {
        border-collapse: collapse;
	    }
	    #gurantor_table th {
	    	word-wrap:break-word;
	        border: 1px solid rgba(0,0,0,.20); 
	    }
	    #gurantor_table td {
	    	word-wrap:break-word;
	        border: 1px solid rgba(0,0,0,.20); 
	    }

    </style>

	<!--   styling Ends:  -->
    <script type="text/javascript">
		var plaintiff = [];
		var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		var lawyer = [];
		var court = [<? $i=1; foreach($court as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		var expense_type = [<? $i=1; foreach($expense_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		var change_type = [<? $i=1; foreach($change_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

		jQuery(document).ready(function () {
		var theme = getDemoTheme();
		jQuery('#sendButton').jqxButton({template:"default",width:"150"});
		jQuery('.text-input').addClass('jqx-input');
		jQuery('.text-input').addClass('jqx-rc-all');
		if (theme.length > 0) {
			jQuery('.text-input').addClass('jqx-input-' + theme);
			jQuery('.text-input').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input').addClass('jqx-rc-all-' + theme);
		}

		//Combobox
		jQuery("#district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 250, height: 25});
		jQuery("#change_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Change Type", source: change_type, width: 250, height: 25});
		
		
		
		jQuery('#new_court,#new_lawyer,#new_dealing_officer,#district').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
		jQuery("#sendButton").click(function () 
		{
		    var validationResult = function (isValid) {
				if (isValid) {
					jQuery("#sendButton").hide();
					jQuery("#send_loading").show();
					call_ajax_submit();
				}
				else{return;}
			}
			jQuery('#request_form').jqxValidator('validate', validationResult);
		});
        jQuery('#request_form').jqxValidator({
			rules: [
		            { input: '#change_type', message: 'required!', action: 'blur,change', rule: function (input) {					
						if(input.val() != '')
						{
							var item = jQuery("#change_type").jqxComboBox('getSelectedItem');
							if(item != null){jQuery("input[name='change_type']").val(item.value);}
							return true;				
						}
						else
						{
							jQuery("#change_type input").focus();
							return false;
						}
					}  
					},
					{ input: '#change_date', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
						if(jQuery("#change_date").val()=='')
						{
							return false;
						}
						else
						{
							return true;
						}
					}
					},
					{ input: '#change_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
					{ input: '#district', message: 'required!', action: 'blur,change', rule: function (input) {					
						var item = jQuery("#change_type").jqxComboBox('getSelectedItem');
						if (item!=null)
						{
							if (item.value==2 || item.value==3)
							{
								if(input.val() != '')
								{
									var item2 = jQuery("#district").jqxComboBox('getSelectedItem');
									if(item2 != null){jQuery("input[name='district']").val(item2.value);}
									return true;		
								}
								else
								{
									jQuery("#district input").focus();
									return false;
								}
							}
							else
							{
								return true;
							}
						}
						else{
							return true;
						}
					}  
					},
					{ input: '#new_data', message: 'required!', action: 'blur,change', rule: function (input) {					
						var item = jQuery("#change_type").jqxComboBox('getSelectedItem');
						if (item!=null)
						{
							if(input.val() != '')
							{
								var item = jQuery("#new_data").jqxComboBox('getSelectedItem');
								if(item != null){jQuery("input[name='new_data']").val(item.value);}
								return true;				
							}
							else
							{
								jQuery("#new_data input").focus();
								return false;
							}
						}
						else{
							return true;
						}
					}  
					},
					{ input: '#new_case_no', message: 'required!', action: 'blur,change', rule: function (input) {					
						var item = jQuery("#change_type").jqxComboBox('getSelectedItem');
						if (item!=null)
						{
							if (item.value==1)
							{
								if(input.val() != '')
								{
									return true;				
								}
								else
								{
									jQuery("#new_case_no").focus();
									return false;
								}
							}
							else
							{
								return true;
							}
						}
						else{
							return true;
						}
					}  
					}
				]
		});
		<? if($add_edit=='edit'){?>
			jQuery("#change_type").jqxComboBox('val', '<?=(isset($result->change_type) && $result->change_type!=0)?$result->change_type:''?>');
			<? if($result->change_type==1){?>
				jQuery("#new_data").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court", source: court, width: 250, height: 25});
				jQuery('#new_data').focusout(function() {
		            commbobox_check(jQuery(this).attr('id'));
		        });
		        jQuery("#new_data").jqxComboBox('val', '<?=(isset($result->new_item) && $result->new_item!=0)?$result->new_item:''?>');
				jQuery("#new_case_no").show();
			<? } ?>

			<? if($result->change_type==2){?>
						jQuery("#district").jqxComboBox('val', '<?=(isset($result->district) && $result->district!=0)?$result->district:''?>');
						get_dropdown_data();
		         jQuery("#new_data").jqxComboBox('val', '<?=(isset($result->new_item) && $result->new_item!=0)?$result->new_item:''?>');
			<? } ?>
			<? if($result->change_type==3){?>
						jQuery("#district").jqxComboBox('val', '<?=(isset($result->district) && $result->district!=0)?$result->district:''?>');
						get_dropdown_data();
		        jQuery("#new_data").jqxComboBox('val', '<?=(isset($result->new_item) && $result->new_item!=0)?$result->new_item:''?>');
			<? } ?>
		<? } ?>
 
	});
	function change_dropdown()
	{
		var theme = getDemoTheme();
		jQuery('#request_form').jqxValidator('hide');
		jQuery("#prev_data_view").html('');
		jQuery("#prev_data").val('');
		var item = jQuery("#change_type").jqxComboBox('getSelectedItem');
		jQuery("#district").hide();
		jQuery("#district").jqxComboBox('clearSelection');
		jQuery("#district").val('');
		if (item!=null)
		{
			if (item.value==1)
			{
				jQuery("#prev_data_view").append('<?=$suit_file_info->prest_court_name?>');
				jQuery("#prev_data").val('<?=$suit_file_info->prest_court_id?>');
				jQuery("#new_data").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court", source: court, width: 250, height: 25});
				jQuery('#new_data').focusout(function() {
		            commbobox_check(jQuery(this).attr('id'));
		        });
		        jQuery("#new_case_no").show();
			}
			else if(item.value==2)
			{
				jQuery("#prev_data_view").append('<?=$suit_file_info->prest_lawyer_name?>');
				jQuery("#prev_data").val('<?=$suit_file_info->prest_lawyer_id?>');
				jQuery("#district").show();
				jQuery("#new_data").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
				jQuery('#new_data').focusout(function() {
		            commbobox_check(jQuery(this).attr('id'));
		        });
		        jQuery("#new_case_no").hide();
			}
			else if(item.value==3)
			{
				jQuery("#prev_data_view").append('<?=$suit_file_info->case_deal_officer?>');
				jQuery("#prev_data").val('<?=$suit_file_info->case_deal_officer_id?>');
				jQuery("#district").show();
				jQuery("#new_data").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Dealing Officer", source: plaintiff, width: 250, height: 25});
				jQuery('#new_data').focusout(function() {
		            commbobox_check(jQuery(this).attr('id'));
		        });
		        jQuery("#new_case_no").hide();
			}
		}
	}
	function get_dropdown_data()
	{
		var item = jQuery("#district").jqxComboBox('getSelectedItem');
		var item2 = jQuery("#change_type").jqxComboBox('getSelectedItem');
		var dropdown_name = '';
		if (item!=null && item2!=null)
		{
			var district = item.value;
			if(item2.value==3)
			{
				dropdown_name = 'd_officer';
			}
			else if(item2.value==2)
			{
				dropdown_name = 'lawyer';
			}
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
						if (dropdown_name=='d_officer')
						{
							var dealing_officer = [];
							jQuery.each(json['row_info'],function(key,obj){
								dealing_officer.push({ value: obj.id, label: obj.name+' ('+obj.pin+')' });
								//alert(obj.name);
							});
							jQuery("#new_data").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Dealing Officer", source: dealing_officer, width: 250, height: 25});
							jQuery('#new_data').focusout(function() {
				            commbobox_check(jQuery(this).attr('id'));
				        });
						}
						else if(dropdown_name=='lawyer')
						{
							var lawyer = [];
							jQuery.each(json['row_info'],function(key,obj){
								lawyer.push({ value: obj.id, label: obj.name+' ('+obj.code+')' });
								//alert(obj.name);
							});
							jQuery("#new_data").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
							jQuery('#new_data').focusout(function() {
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
			jQuery("#new_data").jqxComboBox('clearSelection');
			jQuery("#new_data").val('');
		}
	}
	function call_ajax_submit()
	{
		var postData = jQuery('#request_form').serialize();
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: '<?=base_url()?>index.php/authorization_request/add_edit',
				data : postData,
				datatype: "json",
				success: function(response){
                  ///console.log(response);
					var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
						if(json.Message!='OK')
						{	
							jQuery("#sendButton").show();
							jQuery("#send_loading").hide();		
							alert(json.Message);					
							return false;
						}else{
						window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
						jQuery("#msgArea").val('');
						window.parent.jQuery("#error").show();
						window.parent.jQuery("#error").fadeOut(11500);
						window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');							
						window.top.EOL.messageBoard.close();
					}
				}
			});

	}
    </script>

<body style="height:94%;">
	<div  style=" width:99.8%; margin:auto">
	<div class="form" ><div class="formHeader" style="background-color:#185891;">Request Info</div></div>

    <div style="width:96%;margin: auto;paddding: 10px;">
    	<div id="loading-overlay">
		    <div class="loading-icon"></div>
		</div>  
       <form class="form" name="request_form" id="request_form" method="post" action="" enctype="">
		<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	      <input type="hidden" name="suit_file_id" value="<?=$suit_file_id?>"/>
	      <input type="hidden" name="cma_id" value="<?=$cma_id?>"/>
	      <input type="hidden" name="add_edit" id="add_edit" value="<?=$add_edit?>">
	      <input type="hidden" name="edit_id" id="edit_id" value="<?=isset($edit_id)?$edit_id:''?>">
	       <table style="width:100%;margin-top:20px" id="tab1Table" >
				<tbody>
					<tr>
						<td colspan="2">
								<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
									<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Change Request Data</span>
									<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
										<thead>
											<tr>
												<td width="20%" style="font-weight: bold;text-align:center">Change Type<span style="color:red">*</span></td>
												<td width="20%" style="font-weight: bold;text-align:center">Previous<span style="color:red">*</span></td>
												<td width="20%" style="font-weight: bold;text-align:center">New<span style="color:red">*</span></td>
												<td width="20%" style="font-weight: bold;text-align:center">Change Date<span style="color:red">*</span></td>
												<td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
											</tr>
										</thead>
										<tbody id="expense_body">
											<tr id="expense_1">
													<td>
		                        						<div id="change_type" name="change_type" style="padding-left: 3px;margin-left:5px" onchange="change_dropdown()"></div>
													</td>
													<td>
														<strong id="prev_data_view"></strong>
		                        						<input name="prev_data" type="hidden" class="" style="width:90%" id="prev_data" />
													</td>
													<td>
														<div id="district" name="district" style="padding-left: 3px;margin-left:5px;display:none" onchange="get_dropdown_data()"></div>
														<div id="new_data" name="new_data" style="padding-left: 3px;margin-left:5px" onchange=""></div>
														<input id="new_case_no" name="new_case_no" type="text" class="" style="margin-left:5px;width:250px;color:black;display:none" placeholder="New Case No" value="<?=isset($result->new_case_no)?$result->new_case_no:''?>" />
													</td>
													<td><input type="text" name="change_date" tabindex="11" placeholder="dd/mm/yyyy" style="width:250px;" id="change_date" value="<?=isset($result->change_date)?date_format(date_create($result->change_date),"d/m/Y"):''?>" ><script type="text/javascript" charset="utf-8">datePicker ("change_date");</script></td>
													<td><textarea name="remarks" class="text-input-big" id="remarks" style="height:40px !important;width:90%"><?=isset($result->change_reason)?$result->change_reason:''?></textarea></td>
											</tr>
										</tbody>
									</table>
								</div>
							</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center;">
							<br/>
							<input type="button" value="Update" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;" id="sendButton"/> <span id="send_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
							<br/><br/><br/>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</body>