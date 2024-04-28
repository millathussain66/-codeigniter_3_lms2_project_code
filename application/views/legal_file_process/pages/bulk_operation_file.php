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
	.info {
	  color: #204a8e;
	  background: #c9ddff;
	  border: 1px solid #4c699b;
	}
	.success {
	  color: #2b7515;
	  background: #ecffd6;
	  border: 1px solid #617c42;
	}
	.warn {
	  color: #756e15;
	  background: #fffbd1;
	  border: 1px solid #87803e;
	}
	.error {
	  color: #ba3939;
	  background: #ffe0e0;
	  border: 1px solid #a33a3a;
	}
	.grid_table_div { overflow: auto; height: 100px; }
	.grid_table_div thead th { position: sticky; top: 0; z-index: 1; border: 1px solid #ccc;}
</style>
<script type="text/javascript">
	var csrf_token='';
	jQuery(document).ready(function () {
		var theme = getDemoTheme();
		var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
		var case_deal_officer = [];
		var legal_district = [];
		var legal_user = [];
		var court = [];
		jQuery('#sendButton2').jqxButton({template:"success", width: 130, height: 40, theme: theme });
		jQuery("#case_deal_officer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Deal Officer", source: case_deal_officer, width: '98%', height: 25});
		jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Legal Region", source: legal_region, width: '98%', height: 25});
		jQuery("#legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Legal District", source: legal_district, width: '98%', height: 25});
		jQuery("#new_legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Legal District", source: legal_district, width: '98%', height: 25});
		jQuery("#court").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Legal Court", source: court, width: '98%', height: 25});
		jQuery("#legal_region_submit").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Legal Region", source: legal_region, width: '98%', height: 25});
		jQuery("#legal_user").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Legal User", source: legal_user, width: '98%', height: 25});
		<?php if ($operation=='blk_rf_approve_main' || $operation=='blk_rf_approve_recase'): ?>
			jQuery('#sendToMakerButton').jqxButton({ template:"warning",width: 120, height: 40, theme: theme });
		<?php endif ?>
		jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK") });
		jQuery('#sendButton').jqxButton({template:"success", width: 120, height: 40, theme: theme });
		jQuery('#legal_region').bind('change', function (event) {
			change_dropdown('legal_region');		
		});
		jQuery('#legal_district').bind('change', function (event) {
			change_dropdown('legal_district_case_deal_officer');		
		});
		jQuery('#new_legal_district').bind('change', function (event) {
			change_dropdown('court');		
		});
		<?php if (check_group('1')): ?>
			change_dropdown('legal_region',<?=$this->session->userdata['ast_user']['legal_region']?>);
		<?php endif ?>
	});
	function get_user_data_region_wise(){
      var item = jQuery("#legal_region_submit").jqxComboBox('getSelectedItem');
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
                   jQuery("#legal_user").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select legal user", source: legal_user, width: '98%', height: 25});
                   jQuery('#legal_user').focusout(function() {
                      commbobox_check(jQuery(this).attr('id'));
                  });

                   var legal_district = [];
                   jQuery.each(json['legal_district'],function(key,obj){
                       legal_district.push({ value: obj.id, label: obj.name });
                       //alert(obj.name);
                   });
                   jQuery("#new_legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: '98%', height: 25});
                   jQuery('#new_legal_district').focusout(function() {
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
          jQuery("input[name='legal_user']").val('');
      }
   }
	function change_dropdown(operation,edit=null)
	{
		var id='';
		//check for add Region action
		if (edit==null && operation!='legal_district_case_deal_officer' && operation!='court') 
		{
			id = jQuery("#"+operation).val();
		}
		else if(operation=='court')
		{
			id = jQuery("#new_legal_district").val();
		}
		else if(operation=='legal_district_case_deal_officer')
		{
			id = jQuery("#legal_district").val();
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
						//console.log(json['row_info']);
						var  csrf_tokena = json.csrf_token;
						jQuery('.txt_csrfname').val(json.csrf_token);
						var str='';
						var theme = getDemoTheme();
						if (operation=='legal_region') 
						{
							var legal_district = [];
							jQuery.each(json['row_info'],function(key,obj){
								legal_district.push({ value: obj.id, label: obj.name });
								//alert(obj.name);
							});
							jQuery("#legal_district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Legal District", source: legal_district, width: '98%', height: 25});
						}
						if (operation=='court') 
						{
							var court = [];
							jQuery.each(json['row_info'],function(key,obj){
								court.push({ value: obj.id, label: obj.name });
								//alert(obj.name);
							});
							jQuery("#court").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Court", source: court, width: '98%', height: 25});
						}
						if (operation=='legal_district_case_deal_officer') 
						{
							var case_deal_officer = [];
							jQuery.each(json['row_info'],function(key,obj){
								case_deal_officer.push({ value: obj.id, label: obj.name+'('+obj.pin+')' });
								//alert(obj.name);
							});
							jQuery("#case_deal_officer").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Case Deal Officer", source: case_deal_officer, width: '98%', height: 25});
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
		<?php if (!(check_group('10') || check_group('11') || check_group('18'))): ?>
			if (jQuery('#legal_region').val() == '') {
	    		alert('Region required!');
	    		jQuery('#legal_region').focus();
	    		return false;
	    	}
		<?php endif ?>
		jQuery("#grid_search").hide();
		jQuery("#grid_loading").show();
		
		var theme = getDemoTheme();
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postdata = jQuery('#form').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: "<?=base_url()?>index.php/legal_file_process/load_bulk_data_file/",
				data : postdata,
				datatype: "json",
				success: function(response){
						var json = jQuery.parseJSON(response);
						jQuery('.txt_csrfname').val(json.csrf_token);
						jQuery('#result_table').html(json.str);
						//For Bulk Send To approver
						<?php if ($operation=='blk_rf_main' || $operation=='blk_rf_recase'): ?>
							jQuery("#rf_row").show();
							jQuery("#load_button").show();
							jQuery("#grid_loading2").hide();
							jQuery('#error_msg').hide();
							jQuery('#success_msg').hide();
							jQuery("#submit_button_table2").hide();
							jQuery('#error_msg').html('');
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
	function details(id,operation)
	{
		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(type);
		jQuery('#event_id').val(event_id);
		if (operation=='details') 
		{
			jQuery("#header_title").html('Request Details');
			jQuery('#close_btn_row').show();
		}
		var url="";
		<?php if ($operation=='blk_rf_approve_main' || $operation=='blk_rf_main'): ?>
		 url = "<?=base_url()?>legal_file_process/details";
		<?php endif ?>
		<?php if ($operation=='blk_rf_approve_recase' || $operation=='blk_rf_recase'): ?>
		 url = "<?=base_url()?>legal_file_process/recase_file_details";
		<?php endif ?>
		jQuery('#loading_preview').show();
		jQuery('#loading_p').show();
		jQuery('#details_table').hide();
		jQuery("#details").jqxWindow('open');
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			async:false,
			url: url,
			data : {[csrfName]: csrfHash,id: id
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
			}
		}
		if (check<1)
		{
		 	alert('Please, select at least one Data !!');
		 	return false;
		}
		<?php if ($operation=='blk_rf_main' || $operation=='blk_rf_recase'): ?>
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
			{ input: '#reassign_reason', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
					if(jQuery("#reassign_reason").val()=='')
					{
						jQuery("#reassign_reason").focus();
						return false;
					}
					else
					{
						return true;
					}
				}
				},

				{ input: '#reassign_reason', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
				 {
				 	if(input.val() != '')
					{
						if(input.val().length>250)
						{
							jQuery("#reassign_reason").focus();
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
		<?php endif ?>
		return true;
	}
	function call_ajax_submit()
	{
		if (jQuery('#reason').val() == '' && jQuery('#operation').val()!='reassign' && jQuery('#operation').val()!='approve') {
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
			url: '<?=base_url()?>index.php/legal_file_process/bulk_acktion_file/',
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
	function call_ajax_submit_bulk()
	{
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = $('result_form').toQueryString()+"&"+csrfName+"="+csrfHash;
		$('sendToCheckerMessageDialogConfirm2').style.display = 'none';
		$('sendToCheckerMessageDialogCancel2').style.display = 'none';
		$('loadingReturn2').style.display = 'inline';
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: '<?=base_url()?>index.php/data_migration/add_edit_action/',
			data : postData,
			datatype: "json",
			success: function(response){
				var json = jQuery.parseJSON(response);
				window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
				jQuery('.txt_csrfname').val(json.csrf_token);
					if(json.Message!='OK')
					{								
						$('sendToCheckerMessageDialogConfirm2').style.display = 'inline';
						$('sendToCheckerMessageDialogCancel2').style.display = 'inline';
						$('loadingReturn2').style.display = 'none';
						sendToCheckerMessageDialog2.hide();
						jQuery('#error_msg').show();
						jQuery('#success_msg').hide();
						jQuery("#submit_button_table2").hide();
						jQuery('#error_msg').html(json.Message);
					}else{

					window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
					window.parent.jQuery("#error").show();
					window.parent.jQuery("#error").fadeOut(11500);
					window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+jQuery("#success_message").val());											
					window.top.EOL.messageBoard.close();
				}
			}
		});
		
	}
	function delete_action(type) {
		if(row_validation()==false)
    	{
    		return false;
    	}
		jQuery("#return_reason").val('');
		if (type=='reject') 
		{
			jQuery("#reason_message_body").show();
			jQuery("#type").val(type);
			jQuery("#operation").val(type);
			jQuery("#message").html('Reject');
			jQuery("#button_tag").html('Reject');
			jQuery("#reason_message").html('Reject Reason');
			jQuery("#email_notification").val(type);
			jQuery("#success_message").val('Rejected');
		}
		if (type=='reassign') 
		{
			jQuery("#reason_message_body").hide();
			jQuery("#type").val(type);
			jQuery("#operation").val(type);
			jQuery("#message").html('Reassign');
			jQuery("#button_tag").html('Send');
			jQuery("#email_notification").val(type);
			jQuery("#success_message").val('Reassigned');
		}
		if (type=='approve') 
		{
			jQuery("#reason_message_body").hide();
			jQuery("#type").val(type);
			jQuery("#operation").val(type);
			jQuery("#message").html('Approve');
			jQuery("#button_tag").html('Approve');
			jQuery("#email_notification").val(type);
			jQuery("#success_message").val('Approved');
		}
		$('sendToCheckerMessageDialogConfirm').style.display = 'inline';
		$('sendToCheckerMessageDialogCancel').style.display = 'inline';
		$('loadingReturn').style.display = 'none';
		sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'sendToCheckerMessageDialog' });
		
		sendToCheckerMessageDialog.show();
	}
	function take_action()
	{
		$('sendToCheckerMessageDialogConfirm2').style.display = 'inline';
		$('sendToCheckerMessageDialogCancel2').style.display = 'inline';
		$('loadingReturn2').style.display = 'none';
		sendToCheckerMessageDialog2 = new EOL.dialog($('sendToCheckerMessageDialogContent2'), {position: 'fixed', modal:true, width:470, close:true, id: 'sendToCheckerMessageDialog2' });
		
		sendToCheckerMessageDialog2.show();
	}
	function close_window()
	{
		sendToCheckerMessageDialog.hide();
	}
	function close_window_bulk()
	{
		sendToCheckerMessageDialog2.hide();
	}
	function fileValidation(name){
		var fileInput = document.getElementById(name);
	    var filePath = fileInput.value;
	    var allowedExtensions = /(\.csv)$/i;
	    var fileSize = document.getElementById(name).files[0].size;
	    if(!allowedExtensions.exec(filePath)){
	        alert('Only Csv file is allowed');
	        fileInput.value = '';
	        return false;
	    }
	   	return true;
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
		<form class="form" id="form" name="form"  method="post" action="<?=base_url()?>data_migration/file_validation" enctype="multipart/form-data">
			<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<input type="hidden" id="operation" name="operation" value="" />
			<input type="hidden" id="operation_name" name="operation_name" value="<?=$operation;?>" />
			<input type="hidden" id="return_reason" name="return_reason" value="" />
			<input type="hidden" name="migration_type" id="migration_type" value="bulk_reassing_file">
			<br/>
			<div style="margin-left:10px;padding: 0.5%;width:98%;height:65px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
					<table id="deal_body" style="display:block;width:100%">
						<tr>
							<td style="text-align:right;width:5%"><strong>Request Date From&nbsp;&nbsp;</strong> </td>
							<td style="width:8%"><input id="req_dt_from" name="req_dt_from" style="width:40%" /><script type="text/javascript">datePicker("req_dt_from");</script>
							<strong>To</strong> <input id="req_dt_to" name="req_dt_to" style="width:40%" /><script type="text/javascript" >datePicker("req_dt_to");</script>
							</td>
							<td style="text-align:right;width:5%"><strong>Legal Region&nbsp;&nbsp;</strong> </td>
							<td style="width:5%"><div id="legal_region" tabindex="28" name="legal_region" style="padding-left: 3px"></div></td>
							<td style="text-align:right;width:5%"><strong>Legal District&nbsp;&nbsp;</strong> </td>
							<td style="width:5%"><div id="legal_district" tabindex="28" name="legal_district" style="padding-left: 3px"></div></td>
							<td style="text-align:right;width:5%"><strong>Case Deal Officer&nbsp;&nbsp;</strong> </td>
							<td style="width:5%"><div id="case_deal_officer" tabindex="28" name="case_deal_officer" style="padding-left: 3px"></div></td>
							<td  style="text-align:left;width:7%"><input type='button' class="buttonclose" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
							<span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
							</td>
						</tr>
						<?php if ($operation=='blk_rf_main' || $operation=='blk_rf_recase'): ?>
							<tr>
								<td  style="text-align:left;padding-left:15px" colspan="4" id="file_upload_td">
									<strong>Select File : <span style="color:green">(Only CSV Allowed)&nbsp;</span></strong><input type="file" name="bulk_file" id="bulk_file" onchange="fileValidation('bulk_file')">
								</td>
								<td>
									<input type="button" value="Load" id="load_button" class="buttonclose" style="width:70px !important;height:25px" />
									<span id="grid_loading2" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
								</td>
								<td id="templete_td" colspan="4" style="text-align:left;width:30%">
								  Download Templete : <a id="inXLadfc" style="margin-left:10px;text-align:center;cursor:pointer;" href="<?=base_url()?>data_migration/download_template/bulk_reassing_file" target="_blank" ><img align="center" src="<?=base_url()?>images/download_icon.png"></a>
								</td>
							</tr>
						<?php endif ?>
					</table>
			  </div>


			  <span id="result_table"></span>
			  <table id="rf_row" class="result_table" border="0" style="display: none;margin-left:10px;width:99%;font-size:15px;border-collapse:collapse">
			  	<tr>
			  		<td colspan="12">
			  				<div id="" style="text-align:center;font-family:calibri;font-size:15px;">
							<div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
									<table style="margin-left: 315px;margin-top: 0px;">
										<tr>
											<td>Select Legal Region:<span style="color: red;">*</span></td>
											<td><div id="legal_region_submit" name="legal_region_submit" style="padding-left: 3px" onchange="get_user_data_region_wise()"></div></td>
										</tr>
										<tr>
											<td>Select Legal User:<span style="color: red;">*</span></td>
											<td><div style="float:left" id="legal_user" name="legal_user" style="padding-left: 3px"></div></td>
										</tr>
										<tr>
											<td>Legal District:</td>
											<td><div style="float:left" id="new_legal_district" name="new_legal_district" style="padding-left: 3px"></div></td>
										</tr>
										<tr>
											<td>New Court:</td>
											<td><div style="float:left" id="court" name="court" style="padding-left: 3px"></div></td>
										</tr>
										<tr>
											<td>Reassign Reason:<span style="color: red;">*</span></td>
											<td><textarea name="reassign_reason" id="reassign_reason" style="width:225px;float:left"></textarea></td>
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
					
					<?php if ($operation=='blk_rf_approve_main' || $operation=='blk_rf_approve_recase'): ?>
						<input type="button" value="Approve" id="sendButton" onclick="delete_action('approve')" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
						<input type="button" value="Reject" id="sendToMakerButton" onclick="delete_action('reject')" class="btn-small btn-small-normal enabledElem" style="display: inline;;cursor:pointer;font-size:16px;" />
					<?php else: ?>
						<input type="button" value="Submit" id="sendButton" onclick="delete_action('reassign')" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
					<?php endif ?>
					<span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><br/>
					<br/>
					</td>
				  </tr>
				</table>
		</form>

			<form class="form" id="result_form" name="result_form"  method="post" action="" enctype="">
				  <input name="migration_type_hidden" id="migration_type_hidden" value="" type="hidden">
				  <div class="bar error" id="error_msg" style="display:none;height: 27px;margin-left: 9px;margin-top: 10px;padding: 10px;align-content: center;text-align: center;"></div>
				  <div class="bar success" id="success_msg" style="display:none;height: 27px;margin-left: 9px;margin-top: 10px;padding: 10px;align-content: center;text-align: center;"></div>
			</form>

			<table id="submit_button_table2"  align="center" style="font-size:15px !important;margin-bottom:20px !important;display:none" border="0" cellspacing="0" cellpadding="2">
			  <tr align="center"><td style="border:0px; vertical-align:top;">		
				<br/>
				&nbsp;&nbsp;&nbsp;
				<input type="button" value="Save" id="sendButton2" onclick="take_action()" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
				<span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><br/>
				<br/>
				</td>
			  </tr>
			</table>
	</div>

	<!-- Modal for product details -->
	<div id="details" style="visibility:hidden;">
    <div><strong><label id="header_title"></label></strong></div>
		<form method="POST" name="action_form" id="action_form"  style="margin:0px;">
			<input name="deleteEventId" id="deleteEventId" value="" type="hidden">
    		<input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
    		<input name="type" id="type" value="" type="hidden">
    		<input name="event_id" id="event_id" value="" type="hidden">
    		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
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
	          	<span id="reason_message"></span><span style="color: red;">*</span> <br><textarea name="reason" id="reason" cols="50"></textarea><br><br>
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

  <div id="sendToCheckerMessageDialogContent2"  style="display:none;">
	    <div class="hd" ><h2 class="conf" style="margin-top:0px">Take Action Save ?</h2></div>
	    <form method="POST" name="sendToCheckerMessageform2" id="sendToCheckerMessageform2"  style="margin-top:0px;">
	        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	        <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm2" onclick="call_ajax_submit_bulk()">Save</a> 
	        <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel2" onclick="close_window_bulk()"><span>Cancel</span></a> 
	        <span id="loadingReturn2" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </form>
  </div>

  <script type="text/javascript">
    var options = { 
			complete: function(response) 
			{
				jQuery("#bulk_file").val('');
				jQuery("#case_file").val('');
				jQuery("#cost_file").val('');
				var json = jQuery.parseJSON(response.responseText); 
				jQuery('.txt_csrfname').val(json.csrf_token);
				jQuery('#migration_type_hidden').val(json.migration_type);
				jQuery('#result_table').html('');
				jQuery("#submit_button_table2").hide();
				jQuery("#submit_button_table").hide();
				jQuery("#rf_row").hide();
				if(json.error_message!='OK')
				{
					jQuery("#load_button").show();
					jQuery("#grid_loading2").hide();
					jQuery('#error_msg').show();
					jQuery('#success_msg').hide();
					jQuery("#submit_button_table2").hide();
					jQuery('#error_msg').html(json.error_message);
					return false;
				}
				else
				{
					jQuery('#success_msg').show();
					jQuery('#success_msg').html('Total ('+json.total_records+') Record\'s Ready To Save. Please Click on the Save Button.');
					jQuery('#error_msg').hide();
					jQuery("#submit_button_table2").show();
					jQuery("#load_button").show();
					jQuery("#grid_loading2").hide();
				}
							
			}  
		}; 
		jQuery("#form").ajaxForm(options);
		jQuery("#load_button").click(	function() {
		
		if (jQuery("#bulk_file").val()=='') 
		{
			alert('Please Select A file');
			return false;
		}
		jQuery("#load_button").hide();
		jQuery("#grid_loading2").show();
		jQuery("#form").submit();
				
	});
    </script>