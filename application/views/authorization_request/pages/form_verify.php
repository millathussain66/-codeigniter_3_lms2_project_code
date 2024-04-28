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
		word-wrap:break-word
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
	table#guarantor_info td {
		border: 1px solid #c7c7c7;
		word-wrap:break-word
	}
    </style>

		<!--   styling Ends:  -->
<script type="text/javascript">
	var csrf_token='';
	jQuery(document).ready(function () {
		
		var theme = getDemoTheme();
		jQuery("#r_history").jqxWindow({ theme: theme,  width: '50%', height:'50%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
		jQuery('#sendButton').jqxButton({template:"success", width: 130, height: 40, theme: theme });		
		jQuery('#sendToMakerButton').jqxButton({ template:"danger",width: 120, height: 40, theme: theme });
		jQuery('#holdButton').jqxButton({ template:"warning",width: 120, height: 40, theme: theme });
		// validate form.
	
	});
	function delete_action(type) {
		var message='';
		if (type=='approve') 
		{
			jQuery("#reason_message_body").hide();
			jQuery("#type").val(type);
			jQuery("#message").html('Approve');
			jQuery("#button_tag").html('Approve');
			jQuery("#email_notification").val(type);
			jQuery("#success_message").val('Approve');
		}
		if (type=='return') 
		{
			jQuery("#reason_message_body").show();
			jQuery("#type").val(type);
			jQuery("#message").html('Return');
			jQuery("#button_tag").html('Return');
			jQuery("#reason_message").html('Return Reason');
			jQuery("#email_notification").val(type);
			jQuery("#success_message").val('Returned');
		}
		if (type=='hold') 
		{
			jQuery("#reason_message_body").show();
			jQuery("#type").val(type);
			jQuery("#message").html('Hold');
			jQuery("#button_tag").html('Hold');
			jQuery("#reason_message").html('Hold Reason');
			jQuery("#email_notification").val(type);
			jQuery("#success_message").val('Hold');
		}
		$('sendToCheckerMessageDialogConfirm').style.display = 'inline';
		$('sendToCheckerMessageDialogCancel').style.display = 'inline';
		$('loadingReturn').style.display = 'none';
		sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'sendToCheckerMessageDialog' });
		
		sendToCheckerMessageDialog.show();
	}
	function close_window()
	{
		sendToCheckerMessageDialog.hide();
	}
	function call_ajax_submit()
	{
		if (jQuery('#reason').val() == '' && jQuery('#type').val() != 'approve') {
    		alert('Reason field is required!');
    		jQuery('#reason').focus();
    		return false;
    	}
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = $('sendToCheckerMessageform').toQueryString()+"&"+csrfName+"="+csrfHash;
		$('sendToCheckerMessageDialogConfirm').style.display = 'none';
		$('sendToCheckerMessageDialogCancel').style.display = 'none';
		$('loadingReturn').style.display = 'inline';
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: '<?=base_url()?>index.php/authorization_request/give_authorization/',
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
	function r_history (id) {
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>cma_process/r_history",
			data : {[csrfName]: csrfHash,id: id},
			datatype: "json",
			success: function(response){
			//alert(response);
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
					if(json['row_info'])
					{
						document.getElementById("r_history").style.visibility='visible';
						var html='';
						jQuery.each(json['row_info'],function(key,obj){
							html+='<tr>';
								html+='<td align="left">'+obj.oprs_sts+'</td>';
								html+='<td align="left">'+obj.r_by+'</td>';
								html+='<td align="center">'+obj.oprs_dt+'</td>';
								html+='<td align="left">'+obj.oprs_descriptions+'</td>';
								if (obj.oprs_reason!=null)
								{
									html+='<td align="left">'+obj.oprs_reason+'</td>';
								}else{html+='<td align="left"></td>';}
							html+='</tr>';
						});
						jQuery("#r_history_details").html(html);
						jQuery("#r_history").jqxWindow('open');
					}
					else {
						alert("Something went wrong, please refresh the page.")
					}

			}
		});
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
		word-wrap:break-word
	}
	.custtable th {
		background: #DFDFDF;  
		font-weight: bold;
		padding-left:5px;
		padding-right:5px;
		text-align: left;
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
	table.preview_table2 td, table.preview_table2 th{
		border: 1px solid #c7c7c7;
		word-wrap:break-word;
		padding:5px;
	}
</style>
<body style="font-family:calibri">    
	<div style="height:30px;background-color:#185891;font-size:22px;padding:5px 0 0 10px;color:white">
	Authorize Request
	</div>	
	
    <div style="width:96%;margin: auto;paddding: 10px;">
    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    	<form class="form" name="authorization_form" id="authorization_form" method="post" action="#">
	    	<table class="custtable" border="0" style="margin-left:10px;margin-top:10px;width:99%; font-size:15px;border-collapse:collapse">
				<?php if ($event_name=='suit_file'): ?>
					<tr>
						<td style="width:12%"><strong>Authorization Type</strong></td>
						<td style="width:30%"><?=$details->authorization_type_name;?></td>
						<td style="width:12%"><strong>Case Name</strong></td>
						<td style="width:30%"><?=$details->case_name;?></td>
					</tr>
					<tr>
						<td style="width:12%"><strong>Loan AC.</strong></td>
						<td style="width:30%"><?=$details->loan_ac;?></td>
						<td style="width:12%"><strong>AC Name</strong></td>
						<td style="width:30%"><?=$details->ac_name;?></td>
					</tr>
					<?php if ($details->authorization_type==6 || $details->authorization_type==12): ?>
						<tr>
							<td style="width:12%"><strong>AC. Close Flag</strong></td>
							<td style="width:30%"><?=$details->y_flag;?></td>
							<td style="width:12%"><strong>Approval File</strong></td>
							<td style="width:30%">
								<?php if ($details->y_flag_approval_file!=''): ?>
								<img id="file_preview" onclick="popup('<?=base_url()?>cma_file/y_flag_approval_file/<?=$details->y_flag_approval_file?>')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png">
							<?php endif ?>
							</td>
						</tr>
						<tr>
							<td style="width:12%"><strong>Approver Pin</strong></td>
							<td style="width:30%"><?=$details->approver_pin;?></td>
							<td style="width:12%">Approver Name</td>
							<td style="width:30%"><?=$details->approver_name;?></td>
						</tr>
					<?php endif ?>
					
					<tr>
						<td style="width:12%"><strong>Case Number</strong></td>
						<td style="width:30%"><?=$details->case_number;?></td>
						<td style="width:12%"><strong>Borrower Name</strong></td>
						<td style="width:30%"><?=$details->brrower_name;?></td>
					</tr>
					<tr>
						<td style="width:12%"><strong>Propaitor Address</strong></td>
						<td style="width:30%"><?=$details->current_address;?></td>
						<td style="width:12%"><strong>Type Of Case</strong></td>
						<td style="width:30%"><?=$details->req_type;?></td>
					</tr>
					<tr>
						<td style="width:12%"><strong>Present Representive</strong></td>
						<td style="width:30%"><?=$details->filling_plaintiff;?></td>
						<td style="width:12%"><strong>New Representive</strong></td>
						<td style="width:30%"><?=$details->new_representive;?></td>
					</tr>
					<tr>
						<td style="width:12%"><strong>Send For Authorization By</strong></td>
						<td style="width:30%"><?=$details->e_by;?></td>
						<td style="width:12%"><strong>Send For Authorization Date</strong></td>
						<td style="width:30%"><?=$details->e_dt;?></td>
					</tr>
				<?php endif ?>
		</table>
		<table  align="center" style="font-size:15px !important;margin-bottom:20px !important" border="0" cellspacing="0" cellpadding="2">
		  <tr align="center"><td style="border:0px; vertical-align:top;">		
			<br/>
			<br/>
				&nbsp;&nbsp;&nbsp;
				<input type="button" value="Approve" id="sendButton" onclick="delete_action('approve')" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
				<input type="button" value="Return" id="sendToMakerButton" onclick="delete_action('return')" class="btn-small btn-small-normal enabledElem" style="display: inline;;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
				<input type="button" value="Hold" id="holdButton" onclick="delete_action('hold')" class="btn-small btn-small-normal enabledElem" style="display: inline;;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
				<span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><br/>
				</br></br></br>
			</td>
		  </tr>
		</table>
		</form>
	</div>
	<div id="sendToCheckerMessageDialogContent"  style="display:none;">
	    <div class="hd"><h2 class="conf" style="margin-top:0px">Do you want to <span id="message"></span>?</h2></div>
	    <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform"  style="margin:0px;">
	       <input name="type" id="type" value="" type="hidden">	
	       <input name="success_message" id="success_message" value="" type="hidden">		
			<input type="hidden" id="deleteEventId" name="deleteEventId" value="<?=$id;?>" />
			<input type="hidden" id="EventId" name="EventId" value="<?=$event_id;?>" />
			<input type="hidden" id="event_name" name="event_name" value="<?=$event_name;?>" />
			<input type="hidden" id="operation_type" name="operation_type" value="<?=$type;?>" />
	      	<div class="bd">
	          <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
	          <div class="instrText" style="margin-bottom: 20px"></div>
	          <div class="instrText" style="margin-bottom: 20px" id="reason_message_body">
	          	<span id="reason_message"></span>: <span style="color: red;">*</span> <br><textarea name="reason" id="reason" cols="50"></textarea><br><br>
	          	<!-- Notify By:&nbsp;&nbsp;
              	<label>
              		<input type="checkbox" name="email_notification" id="email_notification" value=""> Email
              	</label> -->
			      	&nbsp;&nbsp;&nbsp;
	          </div>
	        </div>
	        <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_submit()"><span id="button_tag"></span></a> 
	        <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a> 
	        <span id="loadingReturn" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </form>
    </div>
	<div id="r_history" style="visibility:hidden;">
    <div style="padding-left: 17px"><strong>Return/Reject History</strong></div>
		<div style="" id="details_table">
			<table style="width: 100%;" class="preview_table2">
				<thead>
					<th width="20%" align="left"><strong>Status</strong></th>
					<th width="20%" align="left"><strong>User</strong></th>
					<td width="20%" align="center"><strong>Date and Time</strong></td>
					<td width="20%" align="left"><strong>Description</strong></td>
					<td width="20%" align="left"><strong>Reason</strong></td>
				</thead>
				<tbody id="r_history_details">
					
				</tbody>
				<tfoot>
					<tr>
						<td colspan="5" align="center"></br></br><input type="button" class="button1" id="r_ok" value="Close" /></td>
					</tr>
				</tfoot>
			</table>
			<br>
		</div>
	</div>