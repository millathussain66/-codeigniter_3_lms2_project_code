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
	var migration_type = [
		{value:"1",label:"1st Legal Notice"},
		{value:"2",label:"CMA Approval"},
		{value:"3",label:"Master Case"},
		{value:"4",label:"Lawyer Bill Info"},
		{value:"5",label:"Paper Publication Bill"},
		{value:"6",label:"High Court Data"},
		{value:"7",label:"Legal Cost"},
		{value:"8",label:"Master Case File With Cost"},
		{value:"9",label:"Final Legal Notice Cost"},
		{value:"10",label:"Auction Cost"}
	];
	jQuery(document).ready(function () {
		var theme = getDemoTheme();
		jQuery("#migration_type").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Migration Type", source: migration_type, width: 200, height: 25});
		jQuery('#sendButton').jqxButton({template:"success", width: 130, height: 40, theme: theme });
		jQuery('#migration_type').bind('change', function (event) {
				jQuery("#load_button").show();
				jQuery("#grid_loading").hide();
				jQuery('#error_msg').hide();
				jQuery('#success_msg').hide();
				jQuery("#submit_button_table").hide();
				jQuery('#error_msg').html('');
				jQuery('#success_msg').html('');
				jQuery('#migration_type_hidden').val('');
             var item = jQuery("#migration_type").jqxComboBox('getSelectedItem');
             var html="";
             if(item!=null)
             {
                
                if(item.value==8)
                {
                	var action = '<?=base_url()?>data_migration/file_validation_suit_file_with_legal_cost';
                	document.getElementById("form").action = action;
                	html = 'Templete (Case): <a id="inXLadfc" style="margin-left:10px;text-align:center;cursor:pointer;" href="<?=base_url()?>data_migration/download_template/case" target="_blank" ><img align="center" src="<?=base_url()?>images/download_icon.png"></a>&nbsp;&nbsp;Templete (Cost): <a id="inXLadfc" style="margin-left:10px;text-align:center;cursor:pointer;" href="<?=base_url()?>data_migration/download_template/cost" target="_blank" ><img align="center" src="<?=base_url()?>images/download_icon.png"></a>';
                	jQuery('#download_template').html(html);
                	jQuery('#file_upload_td').hide();
                	jQuery('#file_upload_td2').show();
                }
                else
                {
                	var action = '<?=base_url()?>data_migration/file_validation';
                	document.getElementById("form").action = action;
                	html = 'Download Templete : <a id="inXLadfc" style="margin-left:10px;text-align:center;cursor:pointer;" href="<?=base_url()?>data_migration/download_template/'+item.value+'" target="_blank" ><img align="center" src="<?=base_url()?>images/download_icon.png"></a>';
                	jQuery('#download_template').html(html);
                	jQuery('#file_upload_td').show();
                	jQuery('#file_upload_td2').hide();
                }
             }
             else
             {
             	 var action = '';
                document.getElementById("form").action = action;
             	 jQuery('#file_upload_td').show();
                jQuery('#file_upload_td2').hide();
                html = '';
                jQuery('#download_template').html(html);
             }
        });

	});
	function fileValidation(name){
		//alert(name);
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
	function take_action()
	{
		if (row_validation())
		{
			var message='';
			jQuery("#reason_message_body").hide();
			jQuery("#type").val('save');
			jQuery("#message").html('Saved');
			jQuery("#button_tag").html('Save');
			jQuery("#email_notification").val('save');
			jQuery("#success_message").val('Saved');
			$('sendToCheckerMessageDialogConfirm').style.display = 'inline';
			$('sendToCheckerMessageDialogCancel').style.display = 'inline';
			$('loadingReturn').style.display = 'none';
			sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'sendToCheckerMessageDialog' });
			
			sendToCheckerMessageDialog.show();
		}
	}
	function call_ajax_submit()
	{
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = $('result_form').toQueryString()+"&"+csrfName+"="+csrfHash;
		$('sendToCheckerMessageDialogConfirm').style.display = 'none';
		$('sendToCheckerMessageDialogCancel').style.display = 'none';
		$('loadingReturn').style.display = 'inline';
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
						$('sendToCheckerMessageDialogConfirm').style.display = 'inline';
						$('sendToCheckerMessageDialogCancel').style.display = 'inline';
						$('loadingReturn').style.display = 'none';
						sendToCheckerMessageDialog.hide();
						jQuery('#error_msg').show();
						jQuery('#success_msg').hide();
						jQuery("#submit_button_table").hide();
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
	function close_window()
	{
		sendToCheckerMessageDialog.hide();
	}
	function row_validation()
	{
		var row_count=0;
		for (var i = 1; i <=jQuery("#total_row").val(); i++) 
		{
			if (jQuery("#event_id_"+i).val()=='0') //Checking error row
			{
				alert('Sorry You have an error on Sl number ('+i+')');
				return false;
			}
		}
		if (jQuery("#selected_row").val()=='0') //Checking Total available row
		{
			alert('Sorry There is no data For Submit');
			return false;
		}
		return true;
	}
	function delete_row(row)
	{
		if (row=='all') //igonring all error
		{
			var count=0;
			for (var i = 1; i <=jQuery("#total_row").val(); i++) 
			{
				var total_selected_row = jQuery("#selected_row").val();
				if (jQuery("#event_id_"+i).val()=='0') //Ignoring Error Row
				{
					jQuery("#event_id_"+i).val('ignored');
					jQuery("#selected_row").val(total_selected_row-1);
					jQuery('#row_' + i).hide();
					count++;
				}
			}
			//Decrimenting Total Error 
			var total_number_of_error=jQuery("#total_number_of_error").val();
			jQuery('#error_number').html(total_number_of_error-count);
			jQuery("#total_number_of_error").val(total_number_of_error-count);
			jQuery("#total_result_table").hide();

			if (jQuery("#selected_row").val()=='0') ///Checking Available Row 
			{
				var html='<tr>';
				html+='<td style="font-weight: bold;text-align:center" colspan="7">Sorry No Data!!</td>';
				html+='</tr>';
				jQuery('#table_tbody').append(html);
			}
		}
		else
		{
			var total_selected_row = jQuery("#selected_row").val();
			jQuery("#selected_row").val(total_selected_row-1);
			if (jQuery("#event_id_"+row).val()=='0') //Decrementing Total Error Row
			{
				var total_number_of_error=jQuery("#total_number_of_error").val();
				jQuery('#error_number').html(total_number_of_error-1);
				jQuery("#total_number_of_error").val(total_number_of_error-1);
			}
			jQuery("#event_id_"+row).val('ignored'); // Igonoring error row
			jQuery('#row_' + row).hide();
			if (jQuery("#total_number_of_error").val()=='0') //Checking Available error row
			{
				jQuery("#total_result_table").hide();
			}

			if (jQuery("#selected_row").val()=='0') ///Checking Available Row 
			{
				var html='<tr>';
				html+='<td style="font-weight: bold;text-align:center" colspan="7">Sorry No Data!!</td>';
				html+='</tr>';
				jQuery('#table_tbody').append(html);
			}
			
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
	.bar {
	  padding: 10px;
	  margin: 10px;
	  color: #333;
	  background: #fafafa;
	  border: 1px solid #ccc;
	  text-align: center;
	}

	/* (B) THE VARIATIONS */
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
</style>
<body style="font-family:calibri">    
	<div style="height:30px;background-color:#185891;font-size:22px;padding:5px 0 0 10px;color:white">
		Data Migration
	</div>	
	
	<div  id="username_error_show" style="color:#FF0000; font-weight:bold; text-align:center"></div>
	<div align="left">	
	
		<form class="form" id="form" name="form"  method="post" action="" enctype="multipart/form-data">
			<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<br/>
			<div style="margin-left:10px;padding: 0.5%;width:98%;height:65px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
					<table id="deal_body" style="display:block;width:100%">
						<tr>
							<td style="text-align:left;width:8%">
								<strong>Migration Type</strong>
							</td>
							<td style="text-align:left;width:8%">
								<div id="migration_type" name="migration_type" style="padding-left: 3px" tabindex="2"></div>
							</td>
							<td  style="text-align:left;width:35%;padding-left:15px" id="file_upload_td">
							<strong>Select File : <span style="color:green">(Only CSV Allowed)&nbsp;</span></strong><input type="file" name="bulk_file" id="bulk_file" onchange="fileValidation('bulk_file')">
							</td>
							<td  style="text-align:left;width:35%;display:none;padding-left:15px" id="file_upload_td2">
							<strong>Select File(Case) : <span style="color:green">(Only CSV Allowed)&nbsp;</span></strong><input type="file" name="case_file" id="case_file" onchange="fileValidation('case_file')"><br>
							<strong>Select File(Cost) : <span style="color:green">(Only CSV Allowed)&nbsp;</span></strong><input type="file" name="cost_file" id="cost_file" onchange="fileValidation('cost_file')">
							</td>
							<td style="width:7%">
								<input type="button" value="Load" id="load_button" class="buttonclose" style="width:70px !important;height:25px" />
								<span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
							</td>
							<td id="templete_td" style="text-align:left;width:30%">
							  <span id="download_template"></span>
							</td>
						</tr>
					</table>
			  </div>
		</form>
		<form class="form" id="result_form" name="result_form"  method="post" action="" enctype="">
			  <input name="migration_type_hidden" id="migration_type_hidden" value="" type="hidden">
			  <div class="bar error" id="error_msg" style="display:none"></div>
			  <div class="bar success" id="success_msg" style="display:none"></div>
		</form>

			<table id="submit_button_table"  align="center" style="font-size:15px !important;margin-bottom:20px !important;display:none" border="0" cellspacing="0" cellpadding="2">
			  <tr align="center"><td style="border:0px; vertical-align:top;">		
				<br/>
				&nbsp;&nbsp;&nbsp;
				<input type="button" value="Save" id="sendButton" onclick="take_action()" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
				<span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><br/>
				<br/>
				</td>
			  </tr>
			</table>
	</div>

	<div id="sendToCheckerMessageDialogContent"  style="display:none;">
	    <div class="hd" ><h2 class="conf" style="margin-top:0px">Take Action (<span id="message"></span>)?</h2></div>
	    <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform"  style="margin-top:0px;">
	       <input name="type" id="type" value="" type="hidden">	
	       <input name="success_message" id="success_message" value="" type="hidden">		
	        <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_submit()"><span id="button_tag"></span></a> 
	        <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a> 
	        <span id="loadingReturn" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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
				if(json.error_message!='OK')
				{
					jQuery("#load_button").show();
					jQuery("#grid_loading").hide();
					jQuery('#error_msg').show();
					jQuery('#success_msg').hide();
					jQuery("#submit_button_table").hide();
					jQuery('#error_msg').html(json.error_message);
					return false;
				}
				else
				{
					jQuery('#success_msg').show();
					jQuery('#success_msg').html('Total ('+json.total_records+') Record\'s Ready To Save. Please Click on the Save Button.');
					jQuery('#error_msg').hide();
					jQuery("#submit_button_table").show();
					jQuery("#load_button").show();
					jQuery("#grid_loading").hide();
				}
							
			}  
		}; 
	jQuery("#form").ajaxForm(options);
	jQuery("#load_button").click(	function() {
		var item = jQuery("#migration_type").jqxComboBox('getSelectedItem');
		if(item==null)
		{
			jQuery("#migration_type input").focus();
			alert('Please Select Migration Type');
			return false;
		}
		else
		{
			if(item.value==8)
			{
				if (jQuery("#case_file").val()=='' && jQuery("#cost_file").val()=='') 
				{
					alert('Please Select A file');
					return false;
				}
				jQuery("#load_button").hide();
				jQuery("#grid_loading").show();
				jQuery("#form").submit();
			}
			else
			{
				if (jQuery("#bulk_file").val()=='') 
				{
					alert('Please Select A file');
					return false;
				}
				jQuery("#load_button").hide();
				jQuery("#grid_loading").show();
				jQuery("#form").submit();
			}
		}
				
	});
    </script>