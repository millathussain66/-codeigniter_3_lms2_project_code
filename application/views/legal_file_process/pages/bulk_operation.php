<script type="text/javascript" src="<?=base_url()?>js/jquery.ajaxupload.js"></script>
<style type="text/css">
	.button1 {
	  background-color: #555555; /* Green */
	  border: none;
	  color: white;
	  padding: 10px 20px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;;
	  border-radius: 12px;
	}
	.grid_table_div { overflow: auto; height: 100px; }
	.grid_table_div thead th { position: sticky; top: 0; z-index: 1; border: 1px solid #ccc;}
</style>
<script type="text/javascript">
	var csrf_token='';
	var branch = [<? $i=1; foreach($branch as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.' ('.$row->code.')"}'; $i++;}?>];
    var bank = [<? $i=1; foreach($bank as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
	jQuery(document).ready(function () {
		var theme = getDemoTheme();
		var n_type = ['Email','SMS','BOTH'];
		var legal_user = [];
		var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		
		
		jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Legal Region", source: legal_region, width: 215, height: 25});
		jQuery("#legal_user").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Legal User", source: legal_user, width: 215, height: 25});
		jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
		jQuery("#notification_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Notification Type", source: n_type, width: 250, height: 25});
	
		jQuery('#notification_type,#legal_region,#lawyer,#legal_user').focusout(function() {
           //alert(jQuery(this).attr('id'));
            commbobox_check(jQuery(this).attr('id'));
        });
		jQuery('#region').bind('change', function (event) {
			change_dropdown('legal_region');		
		});
	   	jQuery('#territory').bind('change', function (event) {
				change_dropdown('territory');		
		});
	   	jQuery('#district').bind('change', function (event) {
				change_dropdown('district');		
		});
		jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK") });
		jQuery('#sendButton').jqxButton({template:"success", width: 120, height: 40, theme: theme });
		<?php if ($operation=='blk_rf_approve'): ?>
			jQuery('#sendToMakerButton').jqxButton({ template:"warning",width: 120, height: 40, theme: theme });
		<?php endif ?>
		var region = [<? $i=1; foreach($region as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
		jQuery("#region").jqxComboBox({theme: theme, promptText: "Select Region", source: region, width: '97%', height: 21});
		var territory = [<? $i=1; foreach($territory as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
		jQuery("#territory").jqxComboBox({theme: theme, promptText: "Select territory", source: territory, width: '97%', height: 21});
		var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
		jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '97%', height: 21});
		var unit_office = [<? $i=1; foreach($unit_office as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
		jQuery("#unit_office").jqxComboBox({theme: theme, promptText: "Select unit office", source: unit_office, width: '97%', height: 21});
		var loan_segment = [<? $i=1; foreach($loan_segment as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}';$i++;}?>];
		jQuery("#loan_segment").jqxComboBox({theme: theme, promptText: "Select loan segment", source: loan_segment, width: '97%', height: 21});
		var req_type = [<? $i=1; foreach($req_type as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
		jQuery("#req_type").jqxComboBox({theme: theme, promptText: "Requistion type", source: req_type, width: '97%', height: 21});
		jQuery('#branch,#bank,#req_type,#region,#loan_segment,#territory,#district,#unit_office').focusout(function() {
	        commbobox_check(jQuery(this).attr('id'));
	    });
	    jQuery('#notification_type').bind('change', function (event) {
	        	jQuery('#form').jqxValidator('hide')
	        	var item = jQuery("#notification_type").jqxComboBox('getSelectedItem');
				if (item!=null) {
					if (item.value=='Email') 
					{
						jQuery("#mobile_input").hide();
						jQuery("#email_input").show();
						jQuery('#action_form').jqxValidator('hide');
					}	
					else if(item.value=='SMS')
					{
						jQuery("#mobile_input").show();
						jQuery("#email_input").hide();
						jQuery('#action_form').jqxValidator('hide');
					}
					else
					{
						jQuery("#email_input").show();
						jQuery("#mobile_input").show();
						jQuery('#action_form').jqxValidator('hide');
					}
				}
				else
				{
					jQuery("#mobile_input").hide();
					jQuery("#email_input").hide();
					jQuery('#action_form').jqxValidator('hide');
				}
			});
	    jQuery('#lawyer').bind('change', function (event) {
	        	jQuery("#email_address").val('');
	        	jQuery("#mobile").val('');
	        	var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
				if (item!=null) {
					get_lawyer_email_phone(item.value);
				}
			});
	});
	function get_lawyer_email_phone(id)
	{
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			async:false,
			url: "<?=base_url()?>legal_file_process/get_lawyer_email_phone",
			data : {[csrfName]: csrfHash,id: id},
			datatype: "json",
			success: function(response){
			//alert(response);
				var json = jQuery.parseJSON(response);

				jQuery('.txt_csrfname').val(json.csrf_token);
					if(json['row_info'])
					{
						jQuery("#email_address").val(json['row_info']['email']);
	        			jQuery("#mobile").val(json['row_info']['mobile']);
					}
					else {
						alert("Something went wrong, please refresh the page.")
					}

			}
		});
	}
	function change_dropdown(operation,edit=null)
	{
		var id='';
		//check for add Region action
		if (edit==null && operation!='legal_region') 
		{
			id = jQuery("#"+operation).val();
		}
		else if(operation=='legal_region')
		{
			id = jQuery("#region").val();
		}
		else
		{
			id=edit;
		}
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
        url: '<?php echo base_url(); ?>index.php/user_info/get_dropdown_data',
        async:false,
        type: "post",
        data: { [csrfName]: csrfHash,id : id,operation:operation},
        datatype: "json",
        success: function(response){
        	var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
					var str='';
					var theme = getDemoTheme();
					if (operation=='legal_region') 
					{
						var district = [];
						jQuery.each(json['row_info'],function(key,obj){
							district.push({ value: obj.id, label: obj.name });
						});
						jQuery("#district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select District", source: district, width: '97%', height: 21});
						//For edit action
						if (edit!=null) 
						{
							jQuery("#district").jqxComboBox('val', '<?=(isset($result->district) && $result->district!=0)?$result->district:''?>');
						}
					}

            },
            error:   function(model, xhr, options){
                alert('failed');
            },
        	});

			return false;
	}
	function search_data()
	{
		jQuery("#grid_search").hide();
		jQuery("#grid_loading").show();
		var theme = getDemoTheme();
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postdata = jQuery('#form').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: "<?=base_url()?>index.php/legal_file_process/load_bulk_data/",
				data : postdata,
				datatype: "json",
				success: function(response){
						var json = jQuery.parseJSON(response);
						jQuery('.txt_csrfname').val(json.csrf_token);
						jQuery('#result_table').html(json.str);
						<?php if ($operation=='blk_lawyer'): ?>
							var counter = json.counter;
							for (var i = 1; i <=counter; i++) 
							{
								if(jQuery("#hidden_req_type_"+i).val()==1)
								{
									jQuery("#branch_"+i).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Branch", source: branch, width: '90%', height: 25});
        							jQuery("#bank_"+i).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Bank", source: bank, width: '90%', height: 25});
									datePicker('dishonor_dt_'+i);
								}
							}
							jQuery("#lawyer_notification_row").show();
						<?php endif ?>
						<?php if ($operation=='blk_rf'): ?>
							jQuery("#rf_row").show();
						<?php endif ?>
						if (jQuery("#event_counter").val()!=0)
						{
							jQuery("#submit_button_table").show();
						}else{jQuery("#submit_button_table").hide();}
						jQuery("#grid_search").show();
						jQuery("#grid_loading").hide();
					
				}
			});
	}
	function CheckAll_2(checkAllBox)							
	{							
		var ChkState=checkAllBox.checked;
		var number=jQuery("#event_counter").val();
		var counter=0;
		if (ChkState==true) 
		{
			for(var i=1; i<=number; i++){				
				jQuery("#event_delete_"+i).val(0);
				document.getElementById("chkBoxSelect"+i).checked=ChkState;
				counter++;							
			}
		}	
		else{
			for(var i=1; i<=number; i++){				
				jQuery("#event_delete_"+i).val(1);
				document.getElementById("chkBoxSelect"+i).checked=ChkState;							
			}
			counter=0;
		}	
		jQuery('#selected_value').html(counter);									
	}	
	function CheckChanged_2(checkAllBox,counter)
	{
		var ChkState=checkAllBox.checked;
		if (ChkState==true) 
		{
			jQuery("#event_delete_"+counter).val(0);
		}
		else
		{
			jQuery("#event_delete_"+counter).val(1);
		}
		var number=jQuery("#event_counter").val();
		var checkco=0;
		for(var i=1; i<=number; i++){														
			if(document.getElementById("chkBoxSelect"+i).checked==true){
			checkco++;	
			}											
		}
		if (number==checkco){
		document.getElementById("checkAll").checked=true;
		}else{
		document.getElementById("checkAll").checked=false;
		}
		jQuery('#selected_value').html(checkco);	   								
	}
	function details(id,operation,indx,territory=null,region=null)
	{
		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery('#verifyIndexId').val(indx);
		if (operation=='details') 
		{
			jQuery("#header_title").html('CMA Details');
			jQuery('#close_btn_row').show();
		}
		jQuery('#loading_preview').show();
		jQuery('#loading_p').show();
		jQuery('#details_table').hide();
		jQuery("#details").jqxWindow('open');
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>cma_process/details",
			data : {[csrfName]: csrfHash,id: id,
			territory:territory,region:region
			},
			datatype: "json",
			success: function(response){
			//alert(response);
				var json = jQuery.parseJSON(response);

				jQuery('.txt_csrfname').val(json.csrf_token);
					if(json.str)
					{
						document.getElementById("details").style.visibility='visible';

						jQuery("#main_body").html(json['str']);
						jQuery('#loading_preview').hide();
						jQuery('#loading_p').hide();
						jQuery('#details_table').show();
						jQuery("#details").jqxWindow('open');
					}
					else {
						alert("Something went wrong, please refresh the page.")
					}

			}
		});
	}
	function checknumber_alphabaticDot(element_id){

			var field = document.getElementById(element_id);//alert(field.value);
			//var alphaExp = /^[0-9a-zA-Z-]+$/;
			var alphaExp = /^[0-9.]+$/;
			if(field.value.match(alphaExp)){
				return true;
			}
			else{
				//field.value="";
				field.focus();
				return false;
			}

	}
	function row_validation()
	{
		var theme = getDemoTheme();
		var counter=0;
		var total_row = jQuery('#event_counter').val();
		//alert(total_row);
		var check=0;
		for(var i=1; i<=total_row; i++)
		{
			if(document.getElementById("chkBoxSelect"+i).checked==true)
			{
				check++;
				if((jQuery("#court_fee_amount_"+i).val()=='' || jQuery("#court_fee_amount_"+i).val()<=0) && jQuery("#new_court_fee_sts_"+i).val()==1)
                {
                	alert('Court Fee Amount Required');
                    jQuery("#court_fee_amount_"+i).focus();
                    return false;
                }
                if(jQuery("#court_fee_amount_"+i).val() != '' && jQuery("#new_court_fee_sts_"+i).val()==1)
                {
                    if(!checknumber_alphabaticDot('court_fee_amount_'+i))
                    {
                    	alert('Court Fee Amount Only Numeric Required');
                        jQuery("#court_fee_amount_"+i).focus();
                        return false;

                    }
                }
                if(jQuery("#hidden_req_type_"+i).val() ==1)
                {
                	var item = jQuery("#branch_"+i).jqxComboBox('getSelectedItem');
                	var item2 = jQuery("#bank_"+i).jqxComboBox('getSelectedItem');
                	if (!item)
	                {
	                    alert('Branch Required');
	                    jQuery('#branch_'+i+' input').focus();
	                    return false;
	                }
	                if (!item2)
	                {
	                    alert('Bank Required');
	                    jQuery('#bank_'+i+' input').focus();
	                    return false;
	                }
	                if(jQuery.trim(jQuery('#dishonor_dt_'+i).val())=='')
                    {
                        alert('Dishonor Date Required');
                        jQuery('#dishonor_dt_'+i).focus();
                        return false;
                    }
	                if(jQuery.trim(jQuery('#chq_number_'+i).val())=='')
                    {
                        alert('Chq Number Required');
                        jQuery('#chq_number_'+i).focus();
                        return false;
                    }
                    if(jQuery.trim(jQuery('#chq_amount_'+i).val())=='')
                    {
                        alert('Chq Amount Required');
                        jQuery('#chq_amount_'+i).focus();
                        return false;
                    }
                    if(jQuery.trim(jQuery('#chq_amount_'+i).val())!='')
	                {
	                    if(!checknumber_alphabatic('chq_amount_'+i))
	                    {
	                        alert('Amount Only Numeric');
	                        jQuery('#chq_amount_'+i).focus();
	                        return false;
	                    }
	                }
                }
			}
		}
		if (check<1)
		{
		 	alert('Please, select at least one Data !!');
		 	return false;
		}
		if (jQuery("#operation").val()=='blk_lawyer')
		{
			rules2 = [
				{ input: '#lawyer', message: 'required!', action: 'blur, change', rule: function (input) {
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
				},
				{ input: '#notification_type', message: 'required!', action: 'blur, change', rule: function (input) {
						if(input.val() != '')
						{
							var item = jQuery("#notification_type").jqxComboBox('getSelectedItem');
							if(item != null){jQuery("input[name='notification_type']").val(item.value);}
							return true;
						}
						else
						{
							jQuery("#notification_type input").focus();
							return false;
						}
					}
				},
				{ input: '#mobile', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
					if (jQuery("#notification_type").val() != '') 
					{
						var item = jQuery("#notification_type").jqxComboBox('getSelectedItem');
						if (item.value=='SMS' || item.value=='BOTH') 
						{
							if(jQuery("#mobile").val()=='')
							{
								jQuery("#mobile").focus();
								return false;
							}
							else
							{
								return true;
							}
						}
						else
						{
							return true;
						}
					}
					else
					{
						return true;
					}
					
				}
				},
				{ input: '#email_address', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
						if (jQuery("#notification_type").val() != '') 
						{
							var item = jQuery("#notification_type").jqxComboBox('getSelectedItem');
							if (item.value=='Email' || item.value=='BOTH') 
							{
								if(jQuery("#email_address").val()=='')
								{
									jQuery("#email_address").focus();
									return false;
								}
								else
								{
									return true;
								}
							}
							else
							{
								return true;
							}
						}
						else
						{
							return true;
						}
						
					}
				},
				{ input: '#email_address', message: 'invalid e-mail', action: 'keyup', rule: 'email' }
            ];
            jQuery('#form').jqxValidator({
			        rules: rules2, theme: theme
		    });
		    if (jQuery('#form').jqxValidator('validate')) 
		    {
		    	return true;
		    }
		    else
		    {
		    	return false;
		    }
			
		}
		if (jQuery("#operation").val()=='blk_rf')
		{
			rules2 = [
				{ input: '#legal_user', message: 'required!', action: 'blur, change', rule: function (input) {
						if(input.val() != '')
						{
							var item = jQuery("#legal_user").jqxComboBox('getSelectedItem');
							if(item != null){jQuery("input[name='legal_user']").val(item.value);}
							return true;
						}
						else
						{
							jQuery("#lawyer input").focus();
							return false;
						}
					}
				},
				{ input: '#comments', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
						if(jQuery("#comments").val()=='')
						{
							jQuery("#comments").focus();
							return false;
						}
						else
						{
							return true;
						}
					}
					},

					{ input: '#comments', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
					 {
					 	if(input.val() != '')
						{
							if(input.val().length>250)
							{
								jQuery("#comments").focus();
							 	return false;

							}
						}
						return true;

					} },
            ];
            jQuery('#form').jqxValidator({
			        rules: rules2, theme: theme
		    });
		    if (jQuery('#form').jqxValidator('validate')) 
		    {
		    	return true;
		    }
		    else
		    {
		    	return false;
		    }
			
		}
		return true;
	}
	function call_ajax_submit()
	{
		if (jQuery('#reason').val() == '' && jQuery('#operation').val()=='blk_rf_reject') {
    		alert('The reason field is required!');
    		jQuery('#reason').focus();
    		return false;
    	}
    	jQuery("#return_reason").val(jQuery('#reason').val());
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = $('form').toQueryString()+"&"+csrfName+"="+csrfHash;
		$('sendToCheckerMessageDialogConfirm').style.display = 'none';
		$('sendToCheckerMessageDialogCancel').style.display = 'none';
		$('loadingReturn').style.display = 'inline';
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: '<?=base_url()?>index.php/legal_file_process/bulk_acktion/',
			data : postData,
			datatype: "json",
			success: function(response){
              ///console.log(response);
				var json = jQuery.parseJSON(response);
				window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
				jQuery('.txt_csrfname').val(json.csrf_token);
					if(json.Message!='OK')
					{								
						alert(json.Message);
						//window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
						window.top.EOL.messageBoard.close();
					}else{

					window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
					window.parent.jQuery("#error").show();
					window.parent.jQuery("#error").fadeOut(11500);
					window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+jQuery("#success_message").val());	
                    //window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');										
					window.top.EOL.messageBoard.close();
				}
			}
		});

	}
	function delete_action(operation=null) {
		var message='';
		if (row_validation()!=false) 
		{
			if (operation=='blk_rf_reject') 
			{
				jQuery("#reason_message_body").show();
				jQuery("#operation").val(operation);
			}
			else if (operation=='blk_rf_approve') 
			{
				jQuery("#reason_message_body").hide();
				jQuery("#operation").val(operation);
			}
			else
			{
				jQuery("#reason_message_body").hide();
			}
			jQuery("#return_reason").val('');
			jQuery("#message").html('<?=$operation_name;?>');
			jQuery("#button_tag").html('Send');
			jQuery("#success_message").val('<?=$operation_name;?>');

			$('sendToCheckerMessageDialogConfirm').style.display = 'inline';
			$('sendToCheckerMessageDialogCancel').style.display = 'inline';
			$('loadingReturn').style.display = 'none';
			sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'sendToCheckerMessageDialog' });
			
			sendToCheckerMessageDialog.show();
		}
		
	}
	function close_window()
	{
		sendToCheckerMessageDialog.hide();
	}
	function add_procurment(cost,actual_cost,original_procurement,counter)
    {
        var total_court_fee = ((actual_cost-parseInt(original_procurement))+parseInt(cost));
        jQuery('#court_fee_amount_'+counter).val(total_court_fee);
    }
	function get_user_data_region_wise(){
      var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
      if (item!=null)
      {
          var legal_region = item.value;
          var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
          var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
          jQuery.ajax({
          url: '<?=base_url()?>index.php/hoops/get_dropdown_data',
          async:false,
          type: "post",
         data: { [csrfName]: csrfHash,legal_region : legal_region},
          datatype: "json",
          success: function(response){
              var json = jQuery.parseJSON(response);
              jQuery('.txt_csrfname').val(json.csrf_token);
              var str='';
              var theme = getDemoTheme();
                  var legal_user = [];
                   jQuery.each(json['legal_user'],function(key,obj){
                       legal_user.push({ value: obj.id, label: obj.name+' ('+obj.pin+')' });
                       //alert(obj.name);
                   });
                   jQuery("#legal_user").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select legal user", source: legal_user, width: 215, height: 25});
                   jQuery('#legal_user').focusout(function() {
                      commbobox_check(jQuery(this).attr('id'));
                  });

              },
              error:   function(model, xhr, options){
                  alert('failed');
              },
              });
      }
      else
      {
          jQuery("#legal_user").jqxComboBox('clearSelection');
          jQuery("#legal_user").val('');
      }
   }
    </script>

<style>

 .custtable table{
		color: #333;
		font-family: Helvetica, Arial, sans-serif;
		width: 640px;
		border-collapse:
		collapse; border-spacing: 0;
		margin-top:15px;
		table-layout: fixed;
	 }

	.custtable td, .custtable th {
		border: 1px solid #ccc; 
		height: 25px;
		transition: all 0.3s; 
	 }
	 table {
		border-collapse: collapse;
		table-layout: fixed;
	}
	table#preview_table td {
		border: 1px solid #c7c7c7;
		word-wrap:break-word;
		padding: 8px;
	}
	.custtable th {
		background: #DFDFDF;  
		font-weight: bold;
		padding-left:5px;
		padding-right:5px;
		text-align: left;
	}
	table.preview_table2 td, table.preview_table2 th{
		border: 1px solid #c7c7c7;
		word-wrap:break-word;
		padding:5px;
	}
	.custtable td {
		background: #FAFAFA;
		padding-left:5px;
		padding-right:5px;
		text-align: left;
		word-wrap:break-word
	}
	.custtable tr:nth-child(even) td { background: #F1F1F1; }  
	.custtable tr:nth-child(odd) td { background: #FEFEFE; } 
	.custtable tr:hover{ background: #666; color: #000; } 
	#gurantor_table {
        border-collapse: collapse;
	    }
	    #gurantor_table td {
	        border: 1px solid rgba(0,0,0,.20); 
	    }
</style>
<body style="font-family:calibri">    
	<div style="height:30px;background-color:#185891;font-size:22px;padding:5px 0 0 10px;color:white">
		Bulk <?=$operation_name;?>
	</div>	
	
	<div  id="username_error_show" style="color:#FF0000; font-weight:bold; text-align:center"></div>
	<div align="left">	
	<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<form class="form" id="form" name="form"  method="post" action="<?=base_url()?>cma_ho/upload_file" enctype="multipart/form-data">
			<input type="hidden" id="return_reason" name="return_reason" value="" />
			<input type="hidden" id="operation" name="operation" value="<?=$operation;?>" />
			<br/>
			<div style="margin-left:10px;padding: 0.5%;width:98%;height:65px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
					<table id="deal_body" style="display:block;width:100%">
						<tr>
							<td style="text-align:right;width:5%"><strong>Region&nbsp;&nbsp;</strong> </td>
							<td style="width:12%"><div style="padding-left:1.8%" id="region" name="region"></div></td>
							<td style="text-align:right;width:5%"><strong>Territory&nbsp;&nbsp;</strong> </td>
							<td style="width:12%"><div style="padding-left:1.8%" id="territory" name="territory"></div></td>
							<td style="text-align:right;width:5%"><strong>District&nbsp;&nbsp;</strong> </td>
							<td style="width:12%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
							<td style="text-align:right;width:7%"><strong>Unit Ofice&nbsp;&nbsp;</strong> </td>
							<td style="width:12%"><div style="padding-left:1.8%" id="unit_office" name="unit_office"></div></td>
							<td style="text-align:right;width:5%"><strong>Rec Date&nbsp;&nbsp;</strong> </td>
							<td style="width:40%"><input id="rec_dt_from" name="rec_dt_from" style="width:40%" /><script type="text/javascript">datePicker("rec_dt_from");</script>
							<strong>To</strong> <input id="rec_dt_to" name="rec_dt_to" style="width:40%" /><script type="text/javascript" >datePicker("rec_dt_to");</script>
							</td>
							<td  style="text-align:right;width:7%"><input type='button' class="buttonclose" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
							<span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
							</td>
						</tr>
						<tr>
							<td style="text-align:right;width:5%"><strong>Protfolio&nbsp;&nbsp;</strong> </td>
							<td style="width:12%"><div style="padding-left:1.8%" id="loan_segment" name="loan_segment"></div></td>
							<td style="text-align:right;width:5%"><strong>Req Type&nbsp;&nbsp;</strong> </td>
							<td style="width:12%"><div style="padding-left:1.8%" id="req_type" name="req_type"></div></td>
						</tr>
					</table>
			  </div>


			  <span id="result_table"></span>
			  <table id="lawyer_notification_row" class="result_table" border="0" style="display: none;margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			  	<tr>
			  		<td colspan="12">
			  				<div id="" style="text-align:center;font-family:calibri;font-size:15px;">
							<div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
									<table style="margin-left: 315px;margin-top: 0px;">
										<tr>
											<td>Select Lawyer:<span style="color: red;">*</span></td>
											<td><div style="float:left" id="lawyer" name="lawyer" style="padding-left: 3px"></div></td>
										</tr>
										<tr>
											<td>Select Notification Type:<span style="color: red;">*</span></td>
											<td><div style="float:left" id="notification_type" name="notification_type" style="padding-left: 3px"></div></td>
										</tr>
										<tr style="display:none" id="email_input">
											<td>Lawyer Email:<span style="color: red">*</span></td>
											<td><input style="float:left;width:150px" name="email_address" type="text" id="email_address" value="" class="text-input-big" /></td>
										</tr>
										<tr style="display:none" id="mobile_input">
											<td>Lawyer Mobile:<span style="color: red;">*</span></td>
											<td><input style="float:left;width:150px" name="mobile" type="text" id="mobile" value="" class="text-input-big" /></td>
										</tr>
									</table>
							    </div>
							</div>
			  		</td>
			  	</tr>
			  </table>
			  <table id="rf_row" class="result_table" border="0" style="display: none;margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			  	<tr>
			  		<td colspan="12">
			  				<div id="" style="text-align:center;font-family:calibri;font-size:15px;">
							<div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
									<table style="margin-left: 315px;margin-top: 0px;">
										<tr>
											<td>Select Legal Region:<span style="color: red;">*</span></td>
											<td><div id="legal_region" name="legal_region" style="padding-left: 3px" onchange="get_user_data_region_wise()"></div></td>
										</tr>
										<tr>
											<td>Select Legal User:<span style="color: red;">*</span></td>
											<td><div style="float:left" id="legal_user" name="legal_user" style="padding-left: 3px"></div></td>
										</tr>
										<tr>
											<td>Reassign Reason:<span style="color: red;">*</span></td>
											<td><textarea name="comments" id="comments" style="width:225px;float:left"></textarea></td>
										</tr>
									</table>
							    </div>
							</div>
			  		</td>
			  	</tr>
			  </table>
			<table id="submit_button_table"  align="center" style="font-size:15px !important;margin-bottom:20px !important;display:none" border="0" cellspacing="0" cellpadding="2">
			  <tr align="center"><td style="border:0px; vertical-align:top;">		
				<br/>
				&nbsp;&nbsp;&nbsp;
				<?php if ($operation=='blk_rf_approve'): ?>
					<input type="button" value="Approve" id="sendButton" onclick="delete_action('blk_rf_approve')" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
					<input type="button" value="Reject" id="sendToMakerButton" onclick="delete_action('blk_rf_reject')" class="btn-small btn-small-normal enabledElem" style="display: inline;;cursor:pointer;font-size:16px;" />
				<?php else: ?>
					<input type="button" value="Send" id="sendButton" onclick="delete_action()" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
				<?php endif ?>
				<span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><br/>
				<br/>
				</td>
			  </tr>
			</table>
		</form>
	</div>

	<!-- Modal for product details -->
	<div id="details" style="visibility:hidden;">
    <div><strong><label id="header_title"></label></strong></div>
		<form method="POST" name="action_form" id="action_form"  style="margin:0px;">
			<input name="deleteEventId" id="deleteEventId" value="" type="hidden">
    		<input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
    		<input name="type" id="type" value="" type="hidden">
			<div id="loading_preview" style="text-align:center">
				<span id="loading_p" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
			</div>
			<div style="" id="details_table">
				<span id="main_body"></span>
				<br>
			    <div id="close_btn_row" style="text-align:center;margin-bottom:30px;width:100%;">
			    	<input type="button" align="center" class="button1" id="codeOK" value="Close" />
			    </div>
			</div>
		</form>
	</div>

	<div id="sendToCheckerMessageDialogContent"  style="display:none;">
	    <div class="hd" ><h2 class="conf" style="margin-top:0px">Take Action (<span id="message"></span>)?</h2></div>
	    <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform"  style="margin-top:0px;">
	        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	       <input name="type" id="type" value="" type="hidden">	
	       <input name="success_message" id="success_message" value="" type="hidden">
	       <div class="bd">
	          <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
	          <div class="instrText" style="margin-bottom: 20px"></div>
	          <div class="instrText" style="margin-bottom: 20px" id="reason_message_body">
	          	Reason<span style="color: red;">*</span> <br><textarea name="reason" id="reason" cols="50"></textarea><br><br>
	          	<!-- Notify By:&nbsp;&nbsp;
              	<label>
              		<input type="checkbox" name="email_notification" id="email_notification" value=""> Email
              	</label> -->
	          </div>
	        </div>		
	        <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_submit()"><span id="button_tag"></span></a> 
	        <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a> 
	        <span id="loadingReturn" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </form>
    </div>