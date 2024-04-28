<? //echo '<pre>';print_r($result);//exit;?>
<?php $CI =& get_instance(); ?>
<script type="text/javascript">
	var csrf_tokens='';
	jQuery(document).ready(function () {
		
		var theme = getDemoTheme();
		jQuery('#sendButton').jqxButton({template:"success", width: 120, height: 40, theme: theme });
		jQuery('#rejectButton').jqxButton({template:"danger", width: 120, height: 40, theme: theme });
		<? if($v_sts==1 || $v_sts==2 || $v_sts==8) { ?>
		jQuery('#sendToMakerButton').jqxButton({ template:"warning",width: 120, height: 40, theme: theme });
		<? } ?>
		//jQuery('#sendButton, #rejectButton, #sendToMakerButton').css("cursor", "pointer");
			
		
		// validate form.
		jQuery("#sendButton").click(function () 
		{
		
			jQuery("#sendButton").hide();
			<? if($v_sts==1 || $v_sts==2 || $v_sts==8) { ?>
			jQuery("#sendToMakerButton").hide();
			<? } ?>
			jQuery("#rejectButton").hide();
			jQuery("#loading").show();
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
					
			var postdata = jQuery('#form').serialize()+"&"+csrfName+"="+csrfHash;
			jQuery.ajax({
				type: "POST",
				cache: false,
				url: "<?=base_url()?>user_info/reset_pass",
				data : {'verifyEventId': jQuery('#AccId').val(),'v_sts':jQuery("#v_sts").val(),'verify_type':'Approve', [csrfName]: csrfHash},
				datatype: "json",
				success: function(response){
					var json = jQuery.parseJSON(response);
					window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
					jQuery('.txt_csrfname').val(json.csrf_token);
					//alert(response);
					
					var row = {};  
					row["id"] = json.ids;
					row["zone_name"] = json.Zonename;
					//row["e_dt"] = json.appdate;
					row["grref"] = json.appref;
					row["re_ref"] = json.appref_no;
					row["verify_sts"] = json.verifysts;
					row["maker_name"] = json.maker_name;
					row["checker_name"] = json.checker_name;
					
					window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
											
					jQuery.each(row, function(key,val){
						window.parent.jQuery("#jqxgrid").jqxGrid('setcellvalue', <?=$edit_row?>, key, row[key]);							
					});
					window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', <?=$edit_row?>);							
				
					
					window.parent.jQuery("#error").show();
					window.parent.jQuery("#error").fadeOut(11500);
					window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Verified');	
                    window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');										
					window.top.EOL.messageBoard.close();	
                    
				}
			});	
		
		});

	

		

		jQuery('#jqxwindowrejectsms').jqxWindow({ autoOpen:false, width:700, minHeight: 455 });
		
	});
	
	function sendToMaker() {
		jQuery('#sendToCheckerIndexId').val(jQuery('#AccId').val());
		jQuery('#sendToCheckerEventId').val(<?=$edit_row?>);
		jQuery('#requisition_reference_for_return').text(jQuery('#Reference_no').val());
		var handleSendToCheckerMessageSuccess = function(req) {		  
			var response = eval('(' + req + ')');
			//console.log(response);
			window.parent.jQuery('.txt_csrfname').val(response.csrf_token);
			jQuery('.txt_csrfname').val(response.csrf_token);
			if( response.Message == 'OK') {
				window.parent.jQuery("#jqxgrid").jqxGrid('hiderow', <?=$edit_row?>);
				
				window.parent.jQuery("#error").show();
				window.parent.jQuery("#error").fadeOut(11500);
				window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Returned');
				sendToCheckerMessageDialog.hide();
				window.top.EOL.messageBoard.close();
			} else {
				$('sendToCheckerMessageErrorMsg').innerHTML = response.errorMsgs[0];
				$('sendToCheckerMessageErrorMsg').style.display = '';
			}
	    };
	    var handleSendToCheckerMessageFailure = function(o) {    	
			showInfoDialog( 'sendToCheckerMessagefailuretitle', 'sendToCheckerMessagefailurebody', 'WARN' );
		};
	  
	    var handleSubmit = function() {
	    	if (jQuery('#return_reason').val() == '') {
	    		alert('The return reason field is required!');
	    		jQuery('#return_reason').focus();
	    		return false;
	    	}
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
			var postData = $('sendToCheckerMessageform').toQueryString()+"&"+csrfName+"="+csrfHash;
			var request =  new Request({
				url: '<?=base_url()?>user_info/return_action', 
				method: 'post',
				data : {'deleteEventId': jQuery('#AccId').val(),
				'return_reason':jQuery('#return_reason').val(),
				'rType':'Return',
				'v_sts':jQuery("#v_sts").val(),
				'email_notification_for_return':jQuery("#email_notification_for_return").val(),
				[csrfName]: csrfHash,},
				onSuccess: function(req) {handleSendToCheckerMessageSuccess(req);},
				onFailure: function(req) {handleSendToCheckerMessageFailure(req);}
			});
			request.send();
			$('sendToCheckerMessageDialogConfirm').style.display = 'none';
			$('sendToCheckerMessageDialogCancel').style.display = 'none';
			$('loadingReturn').style.display = 'inline';
		};
		$('sendToCheckerMessageDialogConfirm').style.display = 'inline';
		$('sendToCheckerMessageDialogCancel').style.display = 'inline';
		$('loadingReturn').style.display = 'none';
		sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'sendToCheckerMessageDialog' });
		
		sendToCheckerMessageDialog.afterShow = function() {
			$$('#sendToCheckerMessageDialog #sendToCheckerMessageDialogConfirm').addEvent('click',handleSubmit);
			$$('#sendToCheckerMessageDialog #sendToCheckerMessageDialogCancel').addEvent('click',function() {sendToCheckerMessageDialog.hide();});
		};
		sendToCheckerMessageDialog.show();
	}

	function rejectApplication() {
		
		jQuery('#confirmationIndexId').val(jQuery('#AccId').val());
		jQuery('#confirmationEventId').val(<?=$edit_row?>);
		jQuery('#requisition_reference_for_reject').text(jQuery('#Reference_no').val());
		jQuery('#requisition_amount_for_reject').text(jQuery('#Amount').val());
		var handleConfirmationMessageSuccess = function(req) {	
         // alert(req);		
		 // console.log(req);
			var response = eval('(' + req + ')');
			//var response = req;
			// console.log(response);
			window.parent.jQuery('.txt_csrfname').val(response.csrf_token);
			jQuery('.txt_csrfname').val(response.csrf_token);
			if( response.Message == 'OK') {
				//alert(1);
				window.parent.jQuery("#jqxgrid").jqxGrid('hiderow', <?=$edit_row?>);
				
				window.parent.jQuery("#error").show();
				window.parent.jQuery("#error").fadeOut(11500);
				window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Rejected');
				confirmationMessageDialog.hide();
				window.top.EOL.messageBoard.close();
			} else {
				$('confirmationMessageErrorMsg').innerHTML = response.errorMsgs[0];
				$('confirmationMessageErrorMsg').style.display = '';
			}
	    };
	    var handleConfirmationMessageFailure = function(o) { 
	    	console.log(o);
			showInfoDialog( 'confirmationMessagefailuretitle', 'confirmationMessagefailurebody', 'WARN' );
		};
	  
	    var handleSubmit = function() {
	    	if (jQuery('#reject_reason').val() == '') {
	    		alert('The reject reason field is required!');
	    		jQuery('#reject_reason').focus();
	    		return false;
	    	}
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
			var postData = $('confirmationMessageform').toQueryString();
			var request =  new Request({
				url: '<?=base_url()?>user_info/reject_action', 
				method: 'post',
				data : {'deleteEventId': jQuery('#AccId').val(),
				'reject_reason':jQuery('#reject_reason').val(),
				'rType':'Reject',
				'v_sts':jQuery("#v_sts").val(),
				'email_notification_for_rejection':jQuery("#email_notification_for_rejection").val(),
				[csrfName]: csrfHash
				},
				onSuccess: function(req) {handleConfirmationMessageSuccess(req);},
				onFailure: function(req) {handleConfirmationMessageFailure(req);}
			});
			request.send();
			$('confirmationMessageDialogConfirm').style.display = 'none';
			$('confirmationMessageDialogCancel').style.display = 'none';
			$('loadingReject').style.display = 'inline';
		};
		$('confirmationMessageDialogConfirm').style.display = 'inline';
		$('confirmationMessageDialogCancel').style.display = 'inline';
		$('loadingReject').style.display = 'none';
		confirmationMessageDialog = new EOL.dialog($('confirmationMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'confirmationMessageDialog' });
		
		confirmationMessageDialog.afterShow = function() {
			$$('#confirmationMessageDialog #confirmationMessageDialogConfirm').addEvent('click',handleSubmit);
			$$('#confirmationMessageDialog #confirmationMessageDialogCancel').addEvent('click',function() {confirmationMessageDialog.hide();});
		};
		confirmationMessageDialog.show();
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
	 }

	.custtable td, .custtable th {
		border: 1px solid #ccc; 
		height: 25px;
		transition: all 0.3s; 
	 }

	.custtable th {
		background: #DFDFDF;  
		font-weight: bold;
		padding-left:5px;
		padding-right:5px;
		text-align: left;
		white-space:nowrap;
	}

	.custtable td {
		background: #FAFAFA;
		padding-left:5px;
		padding-right:5px;
		text-align: left;
		white-space:nowrap;
	}
	.custtable tr:nth-child(even) td { background: #F1F1F1; }  
	.custtable tr:nth-child(odd) td { background: #FEFEFE; } 
	.custtable tr:hover{ background: #666; color: #000; } 
</style>
<body style="font-family:calibri">    
	<div style="height:30px;background-color:#185891;font-size:22px;padding:5px 0 0 10px;color:white">
	Approve/Verify
	<?php 
	if($v_sts==1){
		echo "User Profile";
	}else if($v_sts==2 || $v_sts==8){
		echo "User Profile Modification";
	}else if($v_sts==3){
		echo "User Profile Deletion";
	}else if($v_sts==6){
		echo "User Profile Deactivation";
	}else if($v_sts==7 && $v_sts==5){
		echo "User Profile Activation";
	}else if($v_sts==4){
		echo "User Pasword Reset";
	}
	$group_result = $this->User_info_model->get_multiselectdata('user_group',$result->user_group_id,'group_name');
    $recovery_region_result = $this->User_info_model->get_multiselectdata('ref_region',$result->recovery_region,'name');
    $recovery_territory_result = $this->User_info_model->get_multiselectdata('ref_territory',$result->recovery_territory,'name');
    $recovery_unit_office_result = $this->User_info_model->get_multiselectdata('ref_unit_office',$result->recovery_unit_office,'name');
    $recovery_district_result = $this->User_info_model->get_multiselectdata('ref_district',$result->recovery_district,'name');
    $legal_district_result = $this->User_info_model->get_multiselectdata('ref_legal_district',$result->legal_district,'name');
    $legal_region_result = $this->User_info_model->get_multiselectdata('ref_legal_region',$result->legal_region,'name');
	?>
	</div>	
	
	<div  id="username_error_show" style="color:#FF0000; font-weight:bold; text-align:center"></div>
	<div align="left">	
		<form class="form" id="form" name="form"  method="post" action="#" enctype="multipart/form-data">
			<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<table class="custtable" border="0" style="margin-left:10px;margin-top:10px;width:99%; font-size:15px;border-collapse:collapse">
				<tr>
					<td style="width:12%"><strong>User ID</strong></td>
					<td style="width:30%"><?=$result->user_id;?></td>
                    <td><strong>Location</strong></td>
					<td><?=$result->location?></td>
					
					<td colspan ="4" rowspan="15" style="width:16%;text-align:center" valign="top">
                    <?php if ( $result->picture!=''): ?>
						<img src="<?=base_url()?>user_profile_images/<?=$result->picture;?>" style="margin:5px;border:solid 1px #c0c0c0" title="Image" alt="image" border="1">
                        <?php endif ?>
						<br/>
                           <?php if ($result->signature!=''): ?>
						<img src="<?=base_url()?>user_profile_images/<?=$result->signature;?>" style="margin:5px;border:solid 1px #c0c0c0" title="Signature" alt="Signature" border="1">
                          <?php endif ?>
					</td>
				</tr>
                <tr>
                	<td><strong>PIN</strong></td>
					<td><?=$result->pin?></td>
					<td><strong>Free Field 1</strong></td>
					<td><?=$result->free_field_1;?></td>
				</tr>
				<tr>
					<td><strong>User Group</strong></td>
					<td><?=(is_object($group_result))?$group_result->multi_name:''?></td>
					<td><strong>Free Field 2</strong></td>
					<td><?=$result->free_field_2;?></td>
				</tr>
				<tr>
					<td><strong>Name</strong></td>
					<td><?=$result->name;?></td>
					<td><strong>Create by</strong></td>
					<td><?=$result->entry_by;?></td>
				</tr>
				<tr>
					<td><strong>Recovery Region</strong></td>
					<td><?=(is_object($recovery_region_result))?$recovery_region_result->multi_name:''?></td>
					<td><strong>Created Date Time</strong></td>
					<td><?php if($result->entry_datetime!=null) { ?>
					<?=date('M j, Y h:i A', strtotime($result->entry_datetime));?>
					<?php } ?></td>
				</tr>
				<tr>
					<td><strong>Recovery Territory</strong></td>
					<td><?=(is_object($recovery_territory_result))?$recovery_territory_result->multi_name:''?></td>
					<td><strong>Last Modified by</strong></td>
					<td><?=$result->last_modified_by;?></td>
				</tr>
				<tr>
					<td><strong>Recovery District</strong></td>
					<td><?=(is_object($recovery_district_result))?$recovery_district_result->multi_name:''?></td>
					<td><strong>Last Modified Date Time</strong></td>
					<td><?php if($result->last_modified_datetime!=null) { ?>
					<?=date('M j, Y h:i A', strtotime($result->last_modified_datetime));?>
					<?php } ?></td>
				</tr>
				<tr>
					<td><strong>Recovery Unit Office</strong></td>
					<td><?=(is_object($recovery_unit_office_result))?$recovery_unit_office_result->multi_name:''?></td>
					<td><strong>Last Activate By</strong></td>
					<td><?=$result->unblock_by?></td>
				</tr>
				<tr>
					<td><strong>Legal Region</strong></td>
					<td><?=(is_object($legal_region_result))?$legal_region_result->multi_name:''?></td>
					<td><strong>Legal District</strong></td>
					<td><?=(is_object($legal_district_result))?$legal_district_result->multi_name:''?></td>
				</tr>
				<tr>
					<td><strong>Designation</strong></td>
					<td><?=$result->designation_name?></td>
					<td><strong>Last Activate Date Time</strong></td>
					<?php if($result->unblock_datetime!=null) { ?>
					<?=date('M j, Y h:i A', strtotime($result->unblock_datetime));?>
					<?php } ?>
				</tr>
				<tr>
					<td><strong>F. Designation</strong></td>
					<td><?=$result->designation_name;?></td>
					<td><strong>Last Activated</strong></td>
					<td><?=$result->unblock_by;?> 
					<?php if($result->unblock_datetime!=null) { ?>
					<?=date('M j, Y h:i A', strtotime($result->unblock_datetime));?>
					<?php } ?>
					</td>
				</tr>
				<tr>
					<td><strong>Role</strong></td>
					<td><?=isset($result->cbs_role)?$result->cbs_role:""?></td>
					<td><strong>Last Deactivated</strong></td>
					<td><?=$result->block_by;?> 
					<?php if($result->block_datetime!=null) { ?>
					<?=date('M j, Y h:i A', strtotime($result->block_datetime));?>
					<?php } ?>
					</td>
				</tr>
				<tr>
					<td><strong>Mobile Phone </strong></td>
					<td><?=$result->mobile_number;?></td>
					<td><strong>Privilege Last Setup By</strong></td>
					<td></td>
				</tr>
				<tr>
					<td><strong>Email</strong></td>
					<td><?=$result->email_address;?></td>
					<td><strong>Privilege Last Setup Date Time</strong></td>
					<td></td>
				</tr>
				<tr>
					<td><strong>Remarks</strong></td>
					<td><?=$result->remarks;?></td>
					<td><strong>Free Field 3</strong></td>
					<td><?=$result->free_field_3_name;?></td>
				</tr>
				<tr>
					<td><strong>Department</strong></td>
					<td><?=$result->department_name;?></td>
					<td><strong>Free Field 4</strong></td>
					<td><?=$result->free_field_4_name;?></td>
				</tr>
				
			</table>
			<table  align="left" style="font-size:15px !important;margin-bottom:20px !important" border="0" cellspacing="0" cellpadding="2">
			  <tr align="left"><td style="border:0px; vertical-align:top;">					
				<input type="hidden" id="AccId" name="AccId" value="<?=$result->ID;?>" />
				<input type="hidden" id="Reference_no" name="Reference_no" value="<?=$result->user_id;?>" />
				<input type="hidden" id="v_sts" name="v_sts" value="<?=$result->verify_status;?>" />
				<br/>
				&nbsp;&nbsp;&nbsp;
				<input type="button" value="Approve" id="sendButton" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
				<input type="button" value="Reject" id="rejectButton" onclick="rejectApplication()" class="btn-small btn-small-normal enabledElem" style="display: inline;;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
					<? if($v_sts==1 || $v_sts==2 || $v_sts==8) { ?>
				<input type="button" value="Return" id="sendToMakerButton" onclick="sendToMaker()" class="btn-small btn-small-normal enabledElem" style="display: inline;;cursor:pointer;font-size:16px;" />
					<? } ?>
					 <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><br/>
				</td>
			  </tr>
			</table>
		</form>
	</div>
	
	<div id="sendToCheckerMessageDialogContent"  style="display:none;">
	    <div class="hd"><h2 class="conf">Do you want to return this user?</h2></div>
	    <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform"  style="margin:0px;">
	        <input name="sendToCheckerEventId" id="sendToCheckerEventId" value="" type="hidden">
	        <input name="sendToCheckerIndexId" id="sendToCheckerIndexId" value="" type="hidden">
	        <input name="action" value="DeleteMessage" type="hidden">
	        <input name="type"  id="type" value="delete" type="hidden">
	      	<div class="bd">
	          <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
	          <div class="instrText" style="margin-bottom: 20px"></div>
	          <div class="instrText" style="margin-bottom: 20px">
	          	User ID: <span><strong id="requisition_reference_for_return"></strong></span><br><br>
	          	Return Reason: <span style="color: red;">*</span> <br><textarea name="return_reason" id="return_reason" cols="50"></textarea><br><br>
	          	<!-- Notify By:&nbsp;&nbsp; -->
              	<!-- <label>
              		<input type="checkbox"  name="email_notification_for_return" id="email_notification_for_return" value="email"> Email
              	</label> -->
              	
	          </div>
	        </div>
	        <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm"><span>Return</span></a> 
	        <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel"><span>Cancel</span></a> 
	        <span id="loadingReturn" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </form>
    </div>

    <div id="confirmationMessageDialogContent"  style="display:none">
	    <div class="hd"><h2 class="conf">Do you want to reject this user?</h2></div>
	    <form method="POST" name="confirmationMessageform" id="confirmationMessageform"  style="margin:0px;">
	        <input name="confirmationEventId" id="confirmationEventId" value="" type="hidden">
	        <input name="confirmationIndexId" id="confirmationIndexId" value="" type="hidden">
	        <input name="action" value="DeleteMessage" type="hidden">
	        <input name="type"  id="type" value="delete" type="hidden">
	      	<div class="bd">
	          <div class="inlineError" id="confirmationMessageErrorMsg" style="display:none"></div>
	          <div class="instrText" style="margin-bottom: 20px"></div>
	          <div class="instrText" style="margin-bottom: 20px">
	            User ID: <span><strong id="requisition_reference_for_reject"></strong></span><br><br>
	          	Reject Reason: <span style="color: red;">*</span> <br><textarea name="reject_reason" id="reject_reason" cols="50"></textarea><br><br>
	          	<!-- Notify By:&nbsp;&nbsp; -->
              	<!-- <label>
              		<input type="checkbox"  name="email_notification_for_rejection" id="email_notification_for_rejection" value="email"> Email
              	</label> -->
	          </div>
	        </div>
	        <a class="btn-small btn-small-normal" id="confirmationMessageDialogConfirm"><span>Reject</span></a> 
	        <a class="btn-small btn-small-secondary" id="confirmationMessageDialogCancel"><span>Cancel</span></a> 
	        <span id="loadingReject" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </form>
    </div>

    <div id='jqxwindowrejectsms'> 
	    <div id="windowHeader">
            <span id="modalHeading"></span>
	    </div>
	    <div>
			<div id="appcertHndovrd">
				<span id="cerhandspplcntinfoshort"></span>
				<div id="detailsTable"  style="padding-left: 10px; padding-bottom: 20px;"></div> 
			</div>
	    </div>
	</div>