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
</style>
<script type="text/javascript">
	var csrf_token='';
	jQuery(document).ready(function () {
		jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
		var theme = getDemoTheme();
		jQuery('#sendButton').jqxButton({template:"success", width: 120, height: 40, theme: theme });
		jQuery('#decline_button').jqxButton({template:"danger", width: 120, height: 40, theme: theme });		
		jQuery('#sendToMakerButton').jqxButton({ template:"warning",width: 120, height: 40, theme: theme });
		
	});
	
	function delete_action(type) {
		var message='';
		if (type=='approve') 
		{
			jQuery("#reason_messge_body").hide();
			jQuery("#type").val(type);
			jQuery("#message").html('Approve');
			jQuery("#button_tag").html('Approve');
			jQuery("#email_notification").val(type);
			jQuery("#success_message").val('Approved');
		}
		if (type=='return') 
		{
			jQuery("#reason_messge_body").show();
			jQuery("#type").val(type);
			jQuery("#message").html('Return');
			jQuery("#button_tag").html('Return');
			jQuery("#reason_messagae").html('Return');
			jQuery("#email_notification").val(type);
			jQuery("#success_message").val('Returned');
		}
		if (type=='reject') 
		{
			jQuery("#reason_messge_body").show();
			jQuery("#type").val(type);
			jQuery("#message").html('Decline');
			jQuery("#button_tag").html('Decline');
			jQuery("#reason_messagae").html('Decline');
			jQuery("#email_notification").val(type);
			jQuery("#success_message").val('Rejected');
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
		if (jQuery('#reason').val() == '' && jQuery('#type').val()!='approve') {
    		alert('The reason field is required!');
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
				url: '<?=base_url()?>index.php/case_against_bank/delete_action/',
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
			url: "<?=base_url()?>legal_notice/r_history",
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
	function popup(url) {
		var winl = (screen.width - 900) / 2;
		var wint = 40;
		newwindow=window.open(url,'name','height=600, width=900,top='+wint+', toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left='+winl);
		if (window.focus) {newwindow.focus()}
		return false;
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
	Approve Case Against Bank
	</div>	
	
	<div  id="username_error_show" style="color:#FF0000; font-weight:bold; text-align:center"></div>
	<div align="left">	
		<form class="form" id="form" name="form"  method="post" action="#" enctype="multipart/form-data">
			 <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<table class="custtable" border="0" style="margin-left:10px;margin-top:10px;width:99%; font-size:15px;border-collapse:collapse">
				<tr>
					<td style="width:12%"><strong>Case Type:</strong></td>
					<td style="width:30%"><?=$result->req_type;?></td>
					<td style="width:12%"><strong>Proposed Type</strong></td>
					<td style="width:30%"><?=$result->proposed_type;?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>AC Name</strong></td>
					<td style="width:30%"><?=$result->ac_name;?></td>
					<td style="width:12%"><strong>Loan AC</strong></td>
					<td style="width:30%"><?=$result->loan_ac;?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Name Of Defendant/Accused</strong></td>
					<td style="width:30%"><?=$result->defendant_name;?></td>
					<td style="width:12%"><strong>Branch (SOL) </strong></td>
					<td style="width:30%"><?=$result->branch_sol;?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>District</strong></td>
					<td style="width:30%"><?=$result->district;?></td>
					<td style="width:12%"><strong>Background /Case history</strong></td>
					<td style="width:30%"><?=$result->case_history;?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Case Name</strong></td>
					<td style="width:30%"><?=$result->case_name;?></td>
					<td style="width:12%"><strong>Case Section. </strong></td>
					<td style="width:30%"><?=$result->case_section;?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Current Case Status</strong></td>
					<td style="width:30%"><?=$result->case_sts;?></td>
					<td style="width:12%"><strong>Filling Plaintiff </strong></td>
					<td style="width:30%"><?=$result->filling_plaintiff;?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Case Number</strong></td>
					<td style="width:30%"><?=$result->case_number;?></td>
					<td style="width:12%"><strong>Filling Date</strong></td>
					<td style="width:30%"><?=$result->filling_date?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Present Lawyer Name </strong></td>
					<td style="width:30%"><?=$result->prest_lawyer_name;?></td>
					<td style="width:12%"><strong>Present Name Of The Court</strong></td>
					<td style="width:30%"><?=$result->prest_court_name;?></td>
				</tr>
				<tr>
					<td style="width:12%"><strong>Retail Branch (If any)</strong></td>
					<td style="width:30%"><?=$result->retail_branch;?></td>
					<td style="width:12%"><strong>Remarks</strong></td>
					<td style="width:30%"><?=$result->remarks;?></td>
				</tr>
			</table>
			<table  align="center" style="font-size:15px !important;margin-bottom:20px !important" border="0" cellspacing="0" cellpadding="2">
			  <tr align="center"><td style="border:0px; vertical-align:top;">		
				<br/>
				&nbsp;&nbsp;&nbsp;
				<input type="button" value="Approve" id="sendButton" onclick="delete_action('approve')" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
				<input type="button" value="Decline" id="decline_button" onclick="delete_action('reject')" class="btn-small btn-small-normal enabledElem" style="display: inline;;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
				<input type="button" value="Return" id="sendToMakerButton" onclick="delete_action('return')" class="btn-small btn-small-normal enabledElem" style="display: inline;;cursor:pointer;font-size:16px;" /> <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><br/>
				<br/><br/>
				</td>
			  </tr>
			</table>
		</form>
	</div>
	<div id="sendToCheckerMessageDialogContent"  style="display:none;">
	    <div class="hd" ><h2 class="conf" style="margin-top:0px">Do you want to <span id="message"></span>?</h2></div>
	    <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform"  style="margin-top:0px;">
	       <input name="type" id="type" value="" type="hidden">	
	       <input name="success_message" id="success_message" value="" type="hidden">		
			<input type="hidden" id="deleteEventId" name="deleteEventId" value="<?=$result->id;?>" />
	      	<div class="bd">
	          <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
	          <div class="instrText" style="margin-bottom: 20px"></div>
	          <div class="instrText" style="margin-bottom: 20px" id="reason_messge_body">
	          	<span id="reason_messagae"></span> Reason <span style="color: red;">*</span> <br><textarea name="reason" id="reason" cols="50"></textarea><br><br>
	          	<!-- Notify By:&nbsp;&nbsp; -->
              	<!-- <label>
              		<input type="checkbox" name="email_notification" id="email_notification" value=""> Email
              	</label> -->
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
						<td colspan="5" align="center"><input type="button" class="button1" id="r_ok" value="Close" /></td>
					</tr>
				</tfoot>
			</table>
			<br>
		</div>
	</div>