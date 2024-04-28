<body style="height:96%">
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
	table.preview_table2 td, table.preview_table2 th{
		border: 1px solid #c7c7c7;
		word-wrap:break-word;
		padding:5px;
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

	.custtable th {
		background: #DFDFDF;  
		font-weight: bold;
		padding-left:5px;
		padding-right:5px;
		text-align: left;
	}
	table {
		border-collapse: collapse;
		table-layout: fixed;
	}
table#preview_table td {
		border: 1px solid #c7c7c7;
		word-wrap:break-word
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
</style>

<script>
    jQuery(document).ready(function () {
    	var theme = getDemoTheme();
        var valuator = [<? $i=1; foreach($valuator as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var revaluator = [<? $i=1; foreach($revaluator as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        // Create a jqxComboBox
        
        jQuery("#valuatorname").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Valuator Name", source: valuator, width: 250, height: 25});
        jQuery("#revaluatorname").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Re-Valuator Name", source: revaluator, width: 250, height: 25});
   
        
        jQuery('#valuatorname,#revaluatorname').focusout(function() {
           //alert(jQuery(this).attr('id'));
            commbobox_check(jQuery(this).attr('id'));
        });
        <? if($add_edit=='edit'){ ?>
        	jQuery("#valuatorname").jqxComboBox('val', '<?=isset($results[0]->valuator_name) && $results[0]->valuator_name!=0?$results[0]->valuator_name:''?>');
        	jQuery("#revaluatorname").jqxComboBox('val', '<?=isset($results[0]->re_valuator_name) && $results[0]->re_valuator_name!=0?$results[0]->re_valuator_name:''?>');
        <? } ?>
        jQuery("#in_req_button").click(function () {
            var validationResult = function (isValid) {
				if (isValid ) {
					call_ajax_submit();
				}
			}
			jQuery('#form').jqxValidator('validate', validationResult);
   		 });

        jQuery('#form').jqxValidator({
			rules: [
				// { input: '#valuatorname', message: 'required!', action: 'blur,change', rule: function (input) {			
				// 	if(input.val() != ''){
				// 		var item = jQuery("#valuatorname").jqxComboBox('getSelectedItem');
				// 		if(item != null){jQuery("input[name='valuatorname']").val(item.value);}
				// 		return true;				
				// 	}else{
				// 		jQuery("#valuatorname input").focus();
				// 		return false;
				// 	}
				// 	}  
				// },
				{ input: '#mortgageshedulename', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
					if(jQuery("#mortgageshedulename").val()==''){
						jQuery("#mortgageshedulename").focus();
						return false;
					}else{
						return true;
					}
					}
				},
				{ input: '#mortgageschedule', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
					if(jQuery("#mortgageschedule").val()==''){
						jQuery("#mortgageschedule").focus();
						return false;
					}else{
						return true;
					}
					}
				},
				{ input: '#deednumber', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
					if(jQuery("#deednumber").val()==''){
						jQuery("#deednumber").focus();
						return false;
					}else{
						return true;
					}
					}
				},
				/*{ input: '#mortgagedate', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
					if(jQuery("#mortgagedate").val()==''){
						jQuery("#mortgagedate").focus();
						return false;
					}else{
						return true;
					}
					}
				},
				{ input: '#valuatordate', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
					if(jQuery("#valuatordate").val()==''){
						jQuery("#valuatordate").focus();
						return false;
					}else{
						return true;
					}
					}
				},
				{ input: '#valuatorfsv', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
					if(jQuery("#valuatorfsv").val()==''){
						jQuery("#valuatorfsv").focus();
						return false;
					}else{
						return true;
					}
					}
				},
				{ input: '#valuatormv', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
					if(jQuery("#valuatormv").val()==''){
						jQuery("#valuatormv").focus();
						return false;
					}else{
						return true;
					}
					}
				},
				{ input: '#mouzarate', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
					if(jQuery("#mouzarate").val()==''){
						jQuery("#mouzarate").focus();
						return false;
					}else{
						return true;
					}
					}
				},
				{ input: '#landarea', message: 'required!', action: 'keyup, blur,change', rule: function(input,commit){
					if(jQuery("#landarea").val()==''){
						jQuery("#landarea").focus();
						return false;
					}else{
						return true;
					}
					}
				},*/
			
			]
		});
    });
	function call_ajax_submit(){
		jQuery("#in_req_button").hide();
		jQuery("#loading").show();
		
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postdata = jQuery('#form').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>auction/mortgage_add_edit/<?=$add_edit?>/<?=$edit_id?>",
			data : postdata,
			datatype: "json",
			success: function(response){
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
				if(json.Message!='OK')
				{
					jQuery("#in_req_button").show();
					jQuery("#loading").hide();
					alert(json.Message);
					return false;
				}
				else
				{
					jQuery("#in_req_button").show();
					jQuery("#loading").hide();
					window.parent.jQuery("#error").show();
					window.parent.jQuery("#error").fadeOut(11500);
					window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');							
					window.parent.location = "<?=base_url()?>index.php/auction/from/<?=$add_edit?>/<?=$id?>/<?=$cma_id?>";
					window.parent.EOL.messageBoard.close();
				}
				
			}
		});
	}
</script>
<body style="font-family:calibri">
<div  style=" width:100%; margin:auto">
<div class="formHeader" style="height:30px;background-color:#185891;font-size:22px;padding:5px 0 0 10px;color:white"><?php echo $add_edit=='add'?'Add New Mortgage':'Edit Mortgage'; ?></div>
   <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
   <form class="form" id="form" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="cma_id" id="cma_id" value="<?php echo $cma_id; ?>" />
        <table class="register-table" width="100%;margin:auto">
        	<tr>
        		<td width="50%">
        			<table style="width: 100%;">
        				<tr>
        					<td width="40%"><strong>Mortgaged Schedule Name</strong> <span style="color:#FF0000">*</span></td>
							<td width="60%"><input name="mortgageshedulename" tabindex="1" style="width:250px" type="text" id="mortgageshedulename" maxlength="200" value="<?php if(isset($results[0])){echo $results[0]->mort_schedule_name; }?>"  class="text-input-big" style="text-transform:capitalize" /></td>
        				</tr>
        				<tr>
							<td><strong>Description of Schedule</strong> <span style="color:#FF0000">*</span></td>
							<td><textarea id="mortgageschedule" tabindex="2" style="width:250px" name="mortgageschedule" cols="40"><?php if(isset($results[0])){echo $results[0]->mort_schedule_desc; }?></textarea></td>
						</tr>
						<tr>
							<td><strong>Mortgage Deed Number</strong> <span style="color:#FF0000">*</span></td>
							<td><input name="deednumber" tabindex="3" style="width:250px" type="text" id="deednumber" maxlength="200" value="<?php if(isset($results[0])){echo $results[0]->deed_number; }?>"  class="text-input-big" style="text-transform:capitalize" /></td>
						</tr>
						<tr>
							<td><strong>Mortgage Date</strong> </td>
							<td><input type="text" tabindex="4" style="width:250px" name="mortgagedate" placeholder="dd/mm/yyyy"  id="mortgagedate" value="<?=isset($results[0])?date_format(date_create($results[0]->mortgage_date),"d/m/Y"):''?>" ><script type="text/javascript" charset="utf-8">datePicker ("mortgagedate");</script></td>
						</tr>
						<tr>
							<td><strong>Valuator/Surveyor Name </strong> </td>
							<td><div id="valuatorname" tabindex="5" name="valuatorname" style="padding-left: 3px" tabindex="9"></div></td>
						</tr>
						<tr id="region_row" >
							<td><strong>Valuator Date</strong> </td>
							<td><input type="text" tabindex="6" style="width:250px" name="valuatordate" placeholder="dd/mm/yyyy"  id="valuatordate" value="<?=isset($results[0])?date_format(date_create((string)$results[0]->valuator_date),"d/m/Y"):''?>" ><script type="text/javascript" charset="utf-8">datePicker ("valuatordate");</script></td>
						</tr>
						<tr id="region_row" >
							<td><strong>Valuator MV</strong> </td>
							<td><input name="valuatormv" tabindex="7" style="width:250px" type="text" id="valuatormv" value="<?php if(isset($results[0])){echo $results[0]->valuator_mv; }?>"  class="text-input-big" /></td>
						</tr>
						<tr id="territory_row">
							<td><strong>Valuator FSV</strong></td>
							<td> <input name="valuatorfsv" tabindex="8" style="width:250px" type="text" id="valuatorfsv" value="<?php if(isset($results[0])){echo $results[0]->valuator_fsv; }?>"  class="text-input-big" /></td>
						</tr>
        			</table>
        		</td>
        		<td width="50%">
        			<table style="width: 100%;">
        				<tr id="district_row">
							<td><strong>Re-Valuator/Surveyor Name </strong></td>
							<td><div id="revaluatorname" tabindex="9" name="revaluatorname" style="padding-left: 3px" tabindex="9"></div></td>
						</tr>
						<tr id="unit_office_row">
							<td><strong>Re-Valuator Date</strong></td>
							<td><input type="text" tabindex="10" style="width:250px" name="revaluatordate" placeholder="dd/mm/yyyy"  id="revaluatordate" value="<?=isset($results[0])?date_format(date_create((string)$results[0]->re_valuator_date),"d/m/Y"):''?>" ><script type="text/javascript" charset="utf-8">datePicker ("revaluatordate");</script></td>
						</tr>
						<tr>
							<td><strong>Re-Valuator MV</strong> </td>
							<td> <input name="revaluemv" tabindex="11" style="width:250px" type="text" id="revaluemv" value="<?php if(isset($results[0])){echo $results[0]->re_valuator_mv; }?>"  class="text-input-big" /></td>
						</tr>
						<tr>
		                    <td><strong>Re-Valuator FSV</strong></td>
		                    <td><input name="revaluefsv" tabindex="12" style="width:250px" type="text" id="revaluefsv" value="<?php if(isset($results[0])){echo $results[0]->re_valuator_fsv; }?>" class="text-input-big" /></td>
						</tr>
						<tr>
							<td><strong>Gov’t Mouza Rate</strong> </td>
							<td> <input name="mouzarate" tabindex="13" style="width:250px" type="text" id="mouzarate" value="<?php if(isset($results[0])){echo $results[0]->gov_mouza_rate; }?>"  class="text-input-big" /></td>
						</tr>
						<tr>
							<td><strong>Total Land Area (in decimals)</strong> </td>
							<td> <input name="landarea" tabindex="14" style="width:250px" type="text" id="landarea" value="<?php if(isset($results[0])){echo $results[0]->land_area; }?>"  class="text-input-big" /></td>
						</tr>
						<tr>
		                    <td><strong>Butted and bounded by (N,S, E W)</strong></td>
		                    <td> <textarea id="boundedby" tabindex="15" style="width:250px" name="boundedby" cols="40"><?php if(isset($results[0])){echo $results[0]->bounded_by; }?></textarea></td>
		                </tr>
        			</table>
        		</td>
        	</tr>
			<tr>
				<td colspan="2" style="text-align: center;"><br><input type="button" value="Save" id="in_req_button" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;"/> <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></td>
			</tr>

		</table>
    </form>
</div>
</body>
  
