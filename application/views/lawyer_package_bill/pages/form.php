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
		var proposed_type = ["Loan", "Card"];

		jQuery(document).ready(function () {
		var theme = getDemoTheme();
		jQuery('#in_req_button').jqxButton({template:"default",width:"150"});
		
		var req_type = [<? $i=1; foreach($req_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		var loan_segment = [<? $i=1; foreach($loan_segment as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}'; $i++;}?>];
		var package_type = [<? $i=1; foreach($package_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		jQuery('.text-input').addClass('jqx-input');
		jQuery('.text-input').addClass('jqx-rc-all');
		if (theme.length > 0) {
			jQuery('.text-input').addClass('jqx-input-' + theme);
			jQuery('.text-input').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input').addClass('jqx-rc-all-' + theme);
		}

		//Combobox
		//jQuery("#req_type").jqxComboBox({theme: theme, width: 250, autoDropDownHeight: false, promptText: "Select Requisition Type", source: req_type, height: 25});
		jQuery("#proposed_type").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Proposed Type", source: proposed_type, height: 25});
		jQuery("#req_type").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Req Type", source: req_type, height: 25});
		jQuery("#lawyer").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, height: 25});
		jQuery("#package_type").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Select Package Type", source: package_type, height: 25});
		jQuery("#protfolio").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Loan Segement", source: loan_segment, height: 25});

		<? if($add_edit=='add'){?>
			jQuery("#proposed_type").jqxComboBox('val','Loan');
			change_caption();
		<? } ?>
		
		jQuery('#proposed_type,#protfolio,#req_type,#lawyer,#package_type').focusout(function() {
           //alert(jQuery(this).attr('id'));
            commbobox_check(jQuery(this).attr('id'));
        });
        <? if($add_edit=='edit'){?>
			jQuery("#proposed_type").jqxComboBox('val', '<?=(isset($result->proposed_type) && $result->proposed_type!='')?$result->proposed_type:''?>');
			change_caption(<?=(isset($result->proposed_type) && $result->proposed_type!=0)?$result->proposed_type:''?>);
			jQuery("#protfolio").jqxComboBox('val', '<?=(isset($result->protfolio) && $result->protfolio!='')?$result->protfolio:''?>');
			jQuery("#req_type").jqxComboBox('val', '<?=(isset($result->req_type) && $result->req_type!=0)?$result->req_type:''?>');
			jQuery("#package_type").jqxComboBox('val', '<?=(isset($result->package_type) && $result->package_type!=0)?$result->package_type:''?>');
			jQuery("#lawyer").jqxComboBox('val', '<?=(isset($result->lawyer) && $result->lawyer!=0)?$result->lawyer:''?>');
			<? } ?>
			jQuery('#proposed_type').bind('change', function (event) {
				jQuery("#loan_ac").val('');
				jQuery("#hidden_loan_ac").val('');
				jQuery("#card_facility_row").hide();
				jQuery('#lawyer_package_form').jqxValidator('hide');
				change_caption();		
			});
	});
	function change_caption()
	{	
		if (jQuery("#proposed_type").val()=='') 
		{
			document.getElementById("loan_ac").disabled = true;
			jQuery("#l_or_c_no").html('Loan A/C or Card');

		}
		else
		{
			document.getElementById("loan_ac").disabled = false;
			var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
			if (item.value=='Loan') {
				jQuery("#l_or_c_no").html('Loan A/C ');
			}
		}
		
	}
	function mask(str,textbox){
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
		if (item.value=='Card') 
		{
			if (!str.includes("*") && str.length==16)//For one time value paste
			{
				var length=str.length;
				var first_6= str.slice(0, 6);
				var mid='******';
				var last_6=str.slice(12, 16);
				var final_str=first_6+mid+last_6;
				textbox.value = final_str
				jQuery("#hidden_loan_ac").val(str);
			}
			else//For single value enter
			{
				//For New value
				var orginal_loan_ac=jQuery("#hidden_loan_ac").val();
				if (orginal_loan_ac.length<str.length) 
				{
					var index = str.length-1;
					var new_val=str.slice(index);
					orginal_loan_ac+=new_val;
					jQuery("#hidden_loan_ac").val(orginal_loan_ac);
				}
				//For delete key
				else{
					var len=str.length;
					var new_val=orginal_loan_ac.slice(0,len);
					jQuery("#hidden_loan_ac").val(new_val);
				}
				//For First 6 key
				if (str.length<=6)
				{
					textbox.value = str
				}
				//for the last 4 key
				else if(str.length>=13)
				{
					textbox.value = str
				}
				//For the middle 4 key
				else{
					var length=str.length;
					var first_6= str.slice(0, 6);
					var mid=(str.length-6);
					var final_str=first_6;
					for (var i = 1; i <= mid; i++) {
						final_str+='*';
					}
					textbox.value = final_str
				}

				if(str.length==16)//wrong input check
				{
					var letter_Count = 0;
					var letter = '*';
					 for (var position = 0; position < str.length; position++) 
					 {
					    if (str.charAt(position) == letter) 
					    {
					       letter_Count += 1;
					    }
					  }
					  if (letter_Count<6 || jQuery("#hidden_loan_ac").val().length!=16) 
					  {
					  	textbox.value = '';
						jQuery("#hidden_loan_ac").val('');
						alert('Wrong way to input Card No please try again');
					  }
				}
			}
		}
		
	}
	function file_delete(id)
	{
		if(confirm('Are you sure to Delete previous file?')){	
			jQuery("#file_preview_"+id).hide();	
			jQuery("#file_delete_"+id).hide();	
			jQuery("#file_delete_value_"+id).val(1);	
		}
	}
	function CustomerPickList(module_name=null,data_field_name=null) {
		<? if($add_edit=='edit'){?>
			if (jQuery("#file_delete_value_"+data_field_name).val()==0) 
			{
				alert('Please Delete Previous file for new upload');
				return false;
			}
		<? } ?>
		newwindow=window.open("<?=base_url()?>index.php/home/ajaxFileUpload/"+module_name+'/'+data_field_name,"Upload","width=550,height=350,resizable=0,scrollbars=0,location=no,menubar=no,toolbar=no,minimizable=no,status=no,top=140,left=340"); 
			if (window.focus) {newwindow.focus()}
							return false; 
	}
	function check_duplication(add_edit)
	{
		var check = 1;
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = jQuery('#lawyer_package_form').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
			type: "POST",
			cache: false,
			async:false,
			url: "<?=base_url()?>lawyer_package_bill/check_duplication",
			data : postData,
			datatype: "json",
			success: function(response){
			//alert(response);
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json['csrf_token']);
				if(json.success==1)
				{
					check = 1;
				}
				else
				{
					alert('Duplicate Entry please check');
					check = 0;
				}
			}
		});
		return check;
	}

</script>

<body style="height:94%;">
	<div  style=" width:99.8%; margin:auto">
	<div class="form" ><div class="formHeader" style="background-color:#185891;">Lawyer Package Bill</div></div>

    <div style="width:96%;margin: auto;paddding: 10px;">
    	<div id="loading-overlay">
		    <div class="loading-icon"></div>
		</div>  
       <form class="form" name="lawyer_package_form" id="lawyer_package_form" method="post" action="<?=base_url()?>lawyer_package_bill/add_edit_action/<?=$add_edit?>/<?=$id?>" enctype="multipart/form-data">
		<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    	<input type="hidden" id="add_edit" value="<?=$add_edit?>" name="add_edit">
    	<input type="hidden" id="editrow" value="<?=$id?>" name="editrow">
    	<input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
	       <table style="width:100%;margin-top:20px" id="tab1Table" >
				<tbody>
					<tr>
						<td width="50%">
							<table style="width: 100%;">
								<tr>
									<td width="40%" style="font-weight: bold;">Package Type<span style="color:red">*</span> </td>
									<td width="60%" ><div id="package_type" name="package_type" style="padding-left: 3px" tabindex="10"></div></td>
								</tr>	
								<tr>
									<td width="40%" style="font-weight: bold;">Lawyer<span style="color:red">*</span> </td>
									<td width="60%" ><div id="lawyer" name="lawyer" style="padding-left: 3px" tabindex="10"></div></td>
								</tr>
								<tr>
									<td width="40%" style="font-weight: bold;">Req Type<span style="color:red">*</span> </td>
									<td width="60%" ><div id="req_type" name="req_type" style="padding-left: 3px" tabindex="10"></div></td>
								</tr>	
								<tr>
									<td width="40%" style="font-weight: bold;">Loan Segment (Portfolio)</td>
									<td width="60%" ><div id="protfolio" name="protfolio" style="padding-left: 3px" tabindex="10"></div></td>
								</tr>	
								<tr>
									<td width="40%" style="font-weight: bold;">Proposed Type<span style="color:red">*</span> </td>
									<td width="60%" ><div id="proposed_type" name="proposed_type" style="padding-left: 3px" tabindex="1"></div></td>
									
								</tr>
								<tr>
									<td width="40%" style="font-weight: bold;"><span id="l_or_c_no"></span> No.<span style="color:red">*</span> </td>
									<td width="60%" >
									<input name="loan_ac" tabindex="2" onKeyUp="javascript:return mask(this.value,this);" type="text" class="" maxlength="16" size="16" style="width:250px" id="loan_ac" value="<?=isset($result->loan_ac)?$result->loan_ac:''?>"/>
									</td>
								</tr>	
								<tr>
									<td width="40%" style="font-weight: bold;">Case No.</td>
									<td width="60%" >
									<input name="case_number" tabindex="2" type="text" class="" maxlength="16" size="16" style="width:250px" id="case_number" value="<?=isset($result->case_number)?$result->case_number:''?>"/>
									</td>
								</tr>	
								<tr>
									<td width="40%" style="font-weight: bold;">Package Amount<span style="color:red">*</span> </td>
									<td width="60%" >
									<input name="package_amount" tabindex="2" type="text" class="" style="width:250px" id="package_amount" value="<?=isset($result->package_amount)?$result->package_amount:''?>"/>
									</td>
								</tr>	
								<tr>
									<td width="40%" style="font-weight: bold;">Approval File</td>
									<td>
										<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList('package','package_approval_file')"/>
		                  <input type="hidden" id="hidden_package_approval_file_select" name="hidden_package_approval_file_select" value="0">
										<? if($add_edit =='edit' && $result->package_approval_file!=''){ ?>                  
                          <span id="hidden_package_approval_file"><img id="file_preview_package_approval_file" onclick="popup('<?=base_url()?>package_approval_file/<?=$result->package_approval_file?>')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>
                 			<input type="hidden" id="hidden_package_approval_file_value" name="hidden_package_approval_file_value" value="<?=$result->package_approval_file?>">
                      	<img id="file_delete_package_approval_file" onclick="file_delete('package_approval_file')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">
                      	<input type="hidden" id="file_delete_value_package_approval_file" name="file_delete_value_package_approval_file" value="0">
                      	<input type="hidden" id="edit_without_file" name="edit_without_file" value="0">
                      <? }
                      else if($add_edit =='edit' && $result->package_approval_file=='')
                      {?>
                      	<span id="hidden_package_approval_file"></span>
                      	<input type="hidden" id="edit_without_file" name="edit_without_file" value="1">
                      <?}
                      else{ ?>
                      	<span id="hidden_package_approval_file"></span>
                      <? } ?>
									</td>
								</tr>	
								<tr>
									<td width="40%" style="font-weight: bold;">Remarks</td>
									<td width="60%" >
									<textarea name="remarks" class="text-input-big" tabindex="20" id="remarks" style="height:40px !important;width:250px"><?=isset($result->remarks)?$result->remarks:''?></textarea>
									</td>
								</tr>									
							</table>
						</td>

						<td width="50%">
							<table style="width: 100%;">
																
							</table>
						</td>

					</tr>
						<td colspan="2" style="text-align: center;">
							<br/>
							<input type="button" value="<? if($add_edit=='add'){echo "Initiate Request";}else{echo "Update Request";}?>" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;" id="in_req_button"/> <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
							<br/><br/><br/>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</body>
<script type="text/javascript">
	var theme = getDemoTheme();
	rules= [
				{ input: '#proposed_type', message: 'required!', action: 'blur,change', rule: function (input) {					
					if(input.val() != '')
					{
						var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='proposed_type']").val(item.value);}
						return true;				
					}
					else
					{
						jQuery("#proposed_type input").focus();
						return false;
					}
				}  
				},
				{ input: '#package_type', message: 'required!', action: 'blur,change', rule: function (input) {					
					if(input.val() != '')
					{
						var item = jQuery("#package_type").jqxComboBox('getSelectedItem');
						if(item != null){jQuery("input[name='package_type']").val(item.value);}
						return true;				
					}
					else
					{
						jQuery("#package_type input").focus();
						return false;
					}
				}  
				},
				{ input: '#loan_ac', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
					var item = jQuery("#package_type").jqxComboBox('getSelectedItem');
					if(item!=null && item.value==1)
					{
						if(jQuery("#loan_ac").val()=='')
						{
							jQuery("#loan_ac").focus();
							return false;
						}
						else
						{
							return true;
						}
					}
					return true;
				}
				},
				{ input: '#loan_ac', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
				 {

				 	if(input.val() != '')
					{
						if(!checknumber_alphabaticwithstar('loan_ac'))
						{
							jQuery("#loan_ac").focus();
						 	return false;

						}
					}
					return true;

				} },
				{ input: '#loan_ac', message: 'must be 16 digits', action: 'keyup, blur, change', rule: function (input, commit)
				 {
				 	if(input.val() != '')
					{
						if(input.val().length<16 || input.val().length>16)
						{
							jQuery("#loan_ac").focus();
						 	return false;

						}
					}
					return true;

				} },
				{ input: '#case_number', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
					var item = jQuery("#package_type").jqxComboBox('getSelectedItem');
					if(item!=null && item.value!=1)
					{
						if(jQuery("#case_number").val()=='')
						{
							jQuery("#case_number").focus();
							return false;
						}
						else
						{
							return true;
						}
					}
					return true;
				}
				},
				{ input: '#package_amount', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
            if(jQuery("#package_amount").val()=='')
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        },
        { input: '#package_amount', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit)
         {
           if(input.val() != '')
           {
              if(!checknumber_alphabatic('package_amount'))
              {
                 jQuery("#package_amount").focus();
                 return false;

              }
           }
           return true;

        } },
				{ input: '#protfolio', message: 'required!', action: 'blur,change', rule: function (input) {					
						var item = jQuery("#package_type").jqxComboBox('getSelectedItem');
						if(item!=null && item.value==1)
						{
							if(input.val() != '')
							{
								var item = jQuery("#protfolio").jqxComboBox('getSelectedItem');
								if(item != null){jQuery("input[name='protfolio']").val(item.value);}
								return true;				
							}
							else
							{
								jQuery("#protfolio input").focus();
								return false;
							}
						}
						return true;
					}  
				},
				{ input: '#req_type', message: 'required!', action: 'blur,change', rule: function (input) {					
						if(input.val() != '')
						{
							var item = jQuery("#req_type").jqxComboBox('getSelectedItem');
							if(item != null){jQuery("input[name='req_type']").val(item.value);}
							return true;				
						}
						else
						{
							jQuery("#req_type input").focus();
							return false;
						}
					}  
				},
				{ input: '#lawyer', message: 'required!', action: 'blur,change', rule: function (input) {					
						var item = jQuery("#package_type").jqxComboBox('getSelectedItem');
						if(item!=null && item.value!=4)
						{
							if(input.val() != '')
							{
								var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
								if(item != null){jQuery("input[name='lawyer']").val(item.value);}
								return true;				
							}
							else
							{
								jQuery("#lawyer input").focus();
								return false;
							}
						}
						else
						{
							return true;		
						}
					}  
				},
				{ input: '#remarks', message: 'Maximum Size 250', action: 'keyup, blur, change', rule: function (input, commit)
				 {
				 	if(input.val() != '')
					{
						if(input.val().length>250)
						{
							jQuery("#remarks").focus();
						 	return false;

						}
					}
					return true;

				} },
			
			];
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
					window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
					jQuery("#msgArea").val('');
					window.parent.jQuery("#error").show();
					window.parent.jQuery("#error").fadeOut(11500);
					window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');							
					window.top.EOL.messageBoard.close();
				}
							
			}  
		}; 
		jQuery("#lawyer_package_form").ajaxForm(options);
		jQuery("#in_req_button").click(	function() {
			jQuery('#lawyer_package_form').jqxValidator({
			        rules: rules, theme: theme
		    });
			var validationResult = function (isValid) {
				if (isValid && check_duplication('<?=$add_edit;?>')) {
					var item = jQuery("#package_type").jqxComboBox('getSelectedItem');
					<?php if ($add_edit=='add'): ?>
					if (jQuery("#hidden_package_approval_file_select").val()=='0' && item.value!=3) 
				 	{
				 		alert('Please Select Approval File');
				 		return false;
				 	}
				<?php endif ?>
				<?php if ($add_edit=='edit'): ?>
					if(jQuery("#edit_without_file").val()=='0')
					{
						if (jQuery("#hidden_package_approval_file_select").val()=='0' && jQuery("#file_delete_value_package_approval_file").val()=='1'  && item.value!=3) 
					 	{
					 		alert('Please Select Approval File');
					 		return false;
					 	}
					 	else if(jQuery("#hidden_package_approval_file_select").val()=='0' && jQuery("#hidden_package_approval_file_value").val()==''  && item.value!=3)
					 	{
					 		alert('Please Select Approval File');
					 		return false;
					 	}
					}
					else
					{
						if (jQuery("#hidden_package_approval_file_select").val()=='0' && item.value!=3) 
					 	{
					 		alert('Please Select Approval File');
					 		return false;
					 	}
					}
				<?php endif ?>
					jQuery("#in_req_button").hide();
					jQuery("#in_req_loading").show();
					jQuery("#lawyer_package_form").submit();
					
				}
			}
			jQuery('#lawyer_package_form').jqxValidator('validate', validationResult);		
		});
</script>