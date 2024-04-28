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
    </style>

		<!--   styling Ends:  -->
<script type="text/javascript">
function popup(url) {
		var winl = (screen.width - 900) / 2;
		var wint = 40;
		newwindow=window.open(url,'name','height=600, width=900,top='+wint+', toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left='+winl);
		if (window.focus) {newwindow.focus()}
		return false;
	}
	var csrf_token='';
	var facility_name = [<? $i=1; foreach($facility_name as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}'; $i++;}?>];
	var cl = [<? $i=1; foreach($cl as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->name.'", label:"'.$row->name.'"}'; $i++;}?>];
	jQuery(document).ready(function () {
		
		var theme = getDemoTheme();
		jQuery("#r_history").jqxWindow({ theme: theme,  width: '50%', height:'50%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
		jQuery('#sendButton').jqxButton({template:"success", width: 130, height: 40, theme: theme });
		
		jQuery("#sendButton").click(function () 
		{
			if (facility_validation() != false)
			{
				jQuery("#sendButton").hide();
				jQuery("#loading").show();

				var postdata = jQuery('#legal_notice_form').serialize(); 
				
				jQuery.ajax({
					type: "POST",
					cache: false,
					url: "<?=base_url()?>index.php/legal_notice_ho/update_facility",
					data : postdata,
					datatype: "json",
					success: function(response){
						var json = jQuery.parseJSON(response);
						//alert(response);
						window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
						jQuery('.txt_csrfname').val(json.csrf_token);
						var row = {};  
						row["id"] = json['row_info'].id;
						row["loan_ac"] = json['row_info'].loan_ac;
						row["cif"] = json['row_info'].cif;
						row["branch_sol"] = json['row_info'].branch_sol;
						row["ac_name"] = json['row_info'].ac_name;
						
						// window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
												
						// jQuery.each(row, function(key,val){
						// 	window.parent.jQuery("#jqxgrid").jqxGrid('setcellvalue', <?=$edit_row?>, key, row[key]);							
						// });
						// window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', <?=$edit_row?>);							
					
						window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
						window.parent.jQuery("#error").show();
						window.parent.jQuery("#error").fadeOut(11500);
						window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');	
	                   // window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');										
						window.top.EOL.messageBoard.close();	
	                    
					}
				});
			}
		else{return;}
				
		
		});

	jQuery('#jqxwindowrejectsms').jqxWindow({ autoOpen:false, width:700, minHeight: 455 });
	
	});
	function facility_validation()
	{
		//For loan facility validation
		if (jQuery('#proposed_type').val()=='Loan') 
		{
			var counter=0;
			var total_row = jQuery('#facility_info_counter').val();
			//alert(total_row);
			var check=0;
			for(var i=1; i<=total_row; i++)
			{
				if(document.getElementById("chkBoxSelect"+i).checked==true)
				{
					check++;
				}
			}
			 for (i=1;i<=total_row;i++) 
			 {
			 	if(jQuery('#facility_info_delete_'+i).val()==0) 
			 	{ 
			 		var item = jQuery("#facility_type_"+i).jqxComboBox('getSelectedItem');
				 	//alert(item.value);
					if(!item){
						alert('Facility Type Required');
						jQuery('#facility_type_'+i+' input').focus();
						return false;
					} 
					if(jQuery.trim(jQuery('#disbursement_date_'+i).val())=='')
					{
						alert('Disbursement Date Required');
						jQuery('#disbursement_date_'+i).focus();
						return false;
					}
					if(jQuery.trim(jQuery('#expire_date_'+i).val())=='')
					{
						alert('Expire Date Required');
						jQuery('#expire_date_'+i).focus();
						return false;
					}
					if(jQuery.trim(jQuery('#disbursed_amount_'+i).val())=='')
					{
						alert('Disbursed Amount Required');
						jQuery('#disbursed_amount_'+i).focus();
						return false;
					}
					if(jQuery.trim(jQuery('#outstanding_bl_'+i).val())=='')
					{
						alert('Outstanding Balance Required');
						jQuery('#outstanding_bl_'+i).focus();
						return false;
					}
					if(jQuery.trim(jQuery('#outstanding_bl_dt_'+i).val())=='')
					{
						alert('Outstanding Bl Date Required');
						jQuery('#outstanding_bl_dt_'+i).focus();
						return false;
					}
					// if(jQuery.trim(jQuery('#overdue_bl_'+i).val())=='')
					// {
					// 	alert('Overdue Bl Required');
					// 	jQuery('#overdue_bl_'+i).focus();
					// 	return false;
					// }
					// if(jQuery.trim(jQuery('#overdue_bl_dt_'+i).val())=='')
					// {
					// 	alert('Overdue Bl Date Required');
					// 	jQuery('#overdue_bl_dt_'+i).focus();
					// 	return false;
					// }
			 	}
			 	
			 }
			 if (check<1)
			 {
			 	alert('Please, select at least one Facility row !!');
			 	return false;
			 }
		}
		//For Card facility validation
		else
		{
			if(jQuery.trim(jQuery('#card_iss_date').val())=='')
			{
				alert('Card Issue Date Required');
				jQuery('#card_iss_date').focus();
				return false;
			}
			if(jQuery.trim(jQuery('#card_exp_date').val())=='')
			{
				alert('Card Expire Date Required');
				jQuery('#card_exp_date').focus();
				return false;
			}
			if(jQuery.trim(jQuery('#card_limit').val())=='')
			{
				alert('Card Limit Required');
				jQuery('#card_limit').focus();
				return false;
			}
			if(jQuery.trim(jQuery('#outstanding_bl').val())=='')
			{
				alert('Outstanding Balance Required');
				jQuery('#outstanding_bl').focus();
				return false;
			}
			if(jQuery.trim(jQuery('#outstanding_bl_dt').val())=='')
			{
				alert('Outstanding Balance Date Required');
				jQuery('#outstanding_bl_dt').focus();
				return false;
			}
		 
		}
		return true;
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
	function add_more_facility()
	{

		var theme = getDemoTheme();
		var counter = jQuery('#facility_info_counter').val();

		var new_counter = parseInt(counter) + 1;
		html_string = '';

			html_string += '<tr id="facility_info_'+new_counter+'">';
			html_string += '<td>';
			html_string += '<input type="hidden" id="facility_info_edit_'+new_counter+'" name="facility_info_edit_'+new_counter+'" value="0">';
			html_string += '<input type="hidden" id="facility_info_delete_'+new_counter+'" name="facility_info_delete_'+new_counter+'" value="0">';
			html_string += '<input type="hidden" id="api_new_'+new_counter+'" name="api_new_'+new_counter+'" value="0">';
			html_string += '<input type="checkbox" name="chkBoxSelect'+new_counter+'" checked="checked" id="chkBoxSelect'+new_counter+'" onClick="CheckChanged_2(this,'+new_counter+')" value="chk"/>';
			html_string += '</td>';
			html_string += '<td><div id="facility_type_'+new_counter+'" name="facility_type_'+new_counter+'" style="padding-left: 3px" ></div></td>';
			html_string += '<td><input name="ac_number_'+new_counter+'" type="text" class="" style="width:90%" id="ac_number_'+new_counter+'" /></td>';
			html_string += '<td><input name="disbursement_date_'+new_counter+'" type="text" class="" style="width:90%" id="disbursement_date_'+new_counter+'" /></td>';
			html_string += '<td><input name="expire_date_'+new_counter+'" type="text" class="" style="width:90%" id="expire_date_'+new_counter+'" /></td>';
			html_string += '<td><input name="disbursed_amount_'+new_counter+'" type="text" class="" style="width:90%" id="disbursed_amount_'+new_counter+'" /></td>';
			html_string += '<td><input name="due_installments_'+new_counter+'" type="text" class="" style="width:90%" id="due_installments_'+new_counter+'" /></td>';
			html_string += '<td><input name="payble_'+new_counter+'" type="text" class="" style="width:90%" id="payble_'+new_counter+'" /></td>';
			html_string += '<td><input name="repayment_'+new_counter+'" type="text" class="" style="width:90%" id="repayment_'+new_counter+'" /></td>';
			html_string += '<td><input name="outstanding_bl_'+new_counter+'" type="text" class="" style="width:90%" id="outstanding_bl_'+new_counter+'" /></td>';
			html_string += '<td><input name="outstanding_bl_dt_'+new_counter+'" type="text" class="" style="width:90%" id="outstanding_bl_dt_'+new_counter+'" /></td>';
			html_string += '<td><input name="overdue_bl_'+new_counter+'" type="text" class="" style="width:90%" id="overdue_bl_'+new_counter+'" /></td>';
			html_string += '<td><input name="overdue_bl_dt_'+new_counter+'" type="text" class="" style="width:90%" id="overdue_bl_dt_'+new_counter+'" /></td>';
			html_string += '<td><input name="call_up_dt_'+new_counter+'" type="text" class="" style="width:90%" id="call_up_dt_'+new_counter+'" /></td>';
			html_string += '<td><input name="cl_'+new_counter+'" type="text" class="" style="width:90%" id="cl_'+new_counter+'" /></td>';
			html_string += '</tr>';

		jQuery('#facility_info_' + counter).after(html_string);
		jQuery('#facility_info_counter').val(new_counter);
		
		jQuery('#facility_type_'+new_counter).jqxComboBox({theme: theme, width: 80, autoOpen: false, autoDropDownHeight: false, promptText: "Facility", source: facility_name, height: 25});
		jQuery('#facility_type_'+new_counter).focusout(function() {
					commbobox_check(jQuery(this).attr('id'));
		});
		datePicker('disbursement_date_'+new_counter);
		datePicker('expire_date_'+new_counter);
		datePicker('outstanding_bl_dt_'+new_counter);
		datePicker('overdue_bl_dt_'+new_counter);
		datePicker('call_up_dt_'+new_counter);
		
	}
	function CheckAll_2(checkAllBox)							
	{							
		var ChkState=checkAllBox.checked;
		var number=jQuery("#facility_info_counter").val();
			
		if (ChkState==true) 
		{
			for(var i=1; i<=number; i++){				
				jQuery("#facility_info_delete_"+i).val(0);
				document.getElementById("chkBoxSelect"+i).checked=ChkState;							
			}
		}	
		else{
			for(var i=1; i<=number; i++){				
				jQuery("#facility_info_delete_"+i).val(1);
				document.getElementById("chkBoxSelect"+i).checked=ChkState;							
			}
		}										
	}	
	function CheckChanged_2(checkAllBox,counter)
	{
		var ChkState=checkAllBox.checked;
		if (ChkState==true) 
		{
			jQuery("#facility_info_delete_"+counter).val(0);
		}
		else
		{
			jQuery("#facility_info_delete_"+counter).val(1);
		}
		var number=jQuery("#facility_info_counter").val();
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
	}
    </script>

<style>
	table.preview_table2 td, table.preview_table2 th{
		border: 1px solid #c7c7c7;
		word-wrap:break-word;
		padding:5px;
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
<body style="font-family:calibri">    
	<div style="height:30px;background-color:#185891;font-size:22px;padding:5px 0 0 10px;color:white">
	Check 1st Legal Notice
	</div>	
	
    <div align="left">	
    	<form class="form" name="legal_notice_form" id="legal_notice_form" method="post" action="#">
		<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<input type="hidden" id="deleteEventId" name="deleteEventId" value="<?=$result->id;?>" />
		<input type="hidden" id="proposed_type" name="proposed_type" value="<?=$proposed_type;?>" />
    	<table class="custtable" border="0" style="margin-left:10px;margin-top:10px;width:99%; font-size:15px;border-collapse:collapse">
			<tr>
				<td style="width:12%"><strong>SL No.</strong></td>
				<td style="width:30%"><?=$result->sl_no;?></td>
				<td style="width:12%"><strong>Current/Updated Address</strong></td>
				<td style="width:30%"><?=$result->current_address;?></td>
			</tr>
			<tr>
				<td style="width:12%"><strong>Proposed Type</strong></td>
				<td style="width:30%"><?=$result->proposed_type;?></td>
				<td style="width:12%"><strong>Region</strong></td>
				<td style="width:30%"><?=$result->region_name;?></td>
			</tr>
			<tr>
				<td style="width:12%"><strong><?if($result->proposed_type=='Loan'){echo "Loan A/C No.";}else{echo "Card No.";}?></strong></td>
				<td style="width:30%"><?=$result->loan_ac;?></td>
				<td style="width:12%"><strong>Territory </strong></td>
				<td style="width:30%"><?=$result->territory_name;?></td>
			</tr>
			<tr>
				<td style="width:12%"><strong>CIF </strong></td>
				<td style="width:30%"><?=$result->cif;?></td>
				<td style="width:12%"><strong>District</strong></td>
				<td style="width:30%"><?=$result->district_name;?></td>
			</tr>
			<tr>
				<td style="width:12%"><strong>Branch SOL</strong></td>
				<td style="width:30%"><?=$result->branch_sol;?></td>
				<td style="width:12%"><strong>Unit Office (code)</strong></td>
				<td style="width:30%"><?=$result->unit_office_name;?></td>
			</tr>
			<tr>
				<td style="width:12%"><strong><?if($result->proposed_type=='Loan'){echo "Loan A/C Name.";}else{echo "Name on Card";}?></strong></td>
				<td style="width:30%"><?=$result->ac_name;?></td>
				<td style="width:12%"><strong>More A/C No. </strong></td>
				<td style="width:30%"><?=$result->more_acc_number;?></td>
			</tr>
			<tr>
				<td style="width:12%"><strong>Subject Type</strong></td>
				<td style="width:30%"><?=$result->subject_name;?></td>
				<td style="width:12%"><strong>Remarks </strong></td>
				<td style="width:30%"><?=$result->remarks;?></td>
			</tr>
			<tr>
				<td style="width:12%"><strong>Spouse Name</strong></td>
				<td style="width:30%"><?if($result->sub_type==3 && $result->spouse_name!=''){echo $result->spouse_name;}else{echo "N/A";}?></td>
				<td style="width:12%"><strong>Initiate By</strong></td>
				<td style="width:30%"><?=$result->e_by;?></td>
			</tr>
			<tr>
				<td style="width:12%"><strong>Mother Name</strong></td>
				<td style="width:30%"><?if($result->sub_type==3){echo $result->mother_name;}else{echo "N/A";}?></td>
				<td style="width:12%"><strong>Initiate Date Time</strong></td>
				<td style="width:30%"><?=$result->e_dt;?></td>
			</tr>
			<tr>
				<td style="width:12%"><strong>Loan Segment (Portfolio) </strong></td>
				<td style="width:30%"><?=$result->loan_segment;?></td>
				<td style="width:12%"><strong>STC By</strong></td>
				<td style="width:30%"><?=$result->stc_by;?></td>
			</tr>
			<tr>
				<td style="width:12%"><strong>Call up Date</strong></td>
				<td style="width:30%"><?=$result->call_up_dt;?></td>
				<td style="width:12%"><strong>STC Date TIme</strong></td>
				<td style="width:30%"><?=$result->stc_dt;?></td>
			</tr>
			<tr>
				<td style="width:12%"><strong>Call Up File</strong></td>
				<td style="width:30%">
					<?php if ($result->call_up_file!=''): ?>
						<img id="file_preview" onclick="popup('<?=base_url()?>legal_notice_file/call_up_file/<?=$result->call_up_file?>')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png">
					<?php endif ?>
				</td>
				<td style="width:12%"><strong>Return/Decline Message</strong></td>
				<td style="width:30%">
				<?php if ($result->return_reason_rm!=null): ?>
					<a href="#" style="color:black" onclick="return r_history(<?=$result->id;?>)"><span><?=$result->return_reason_rm;?></span></a>
				<?php endif ?>
				</td>
			</tr>
			<tr>
				<td style="width:12%"><strong>Recommended By</strong></td>
				<td style="width:30%"><?=$result->rec_by;?></td>
				<td style="width:12%"><strong>Recommended Dt</strong></td>
				<td style="width:30%"><?=$result->rec_dt;?></td>
			</tr>
			<?php if (!empty($legal_notice_guarantor)): ?>
			<tr>
				<td colspan="4" style="background: white;">
				</br>
					<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;"><?php if($result->proposed_type=='Loan'){echo "Borrower/Guarantor/Company Director/Owner";}else{echo "Borrower/Reference";}?></span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<tbody>
						<input type="hidden" name="guarantor_info_counter" id="guarantor_info_counter" value="1">
						<tr>
							<td width="10%" style="font-weight: bold;text-align:center">Type</td>
							<td width="10%" style="font-weight: bold;text-align:left">Name</td>
							<td width="10%" style="font-weight: bold;text-align:left">Father Name</td>
							<td width="15%" style="font-weight: bold;text-align:left">Present Address</td>
							<td width="15%" style="font-weight: bold;text-align:left">Permanent Address</td>
							<td width="15%" style="font-weight: bold;text-align:left">Business Address</td>
							<td width="10%" style="font-weight: bold;text-align:center">Status</td>
							<td width="15%" style="font-weight: bold;text-align:center">Occupation</td>
						</tr>
						<?php foreach ($legal_notice_guarantor as $key): ?>
							<tr>
								<td style="text-align:center"><?=$key->type_name?></td>
								<td style="text-align:left"><?=$key->guarantor_name?></td>
								<td style="text-align:left"><?=$key->father_name?></td>
								<td style="text-align:left"><?=$key->present_address?></td>
								<td style="text-align:left"><?=$key->permanent_address?></td>
								<td style="text-align:left"><?=$key->business_address?></td>
								<td style="text-align:center"><?=$key->guar_sts_name?></td>
								<td style="text-align:center"><?=$key->occ_sts_name?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
					</table>
				</div>
				</td>
			</tr>
			<?php endif ?>
			<tr>
			<!-- For Loan -->
			<?php if ($proposed_type=='Loan'): ?>
				<td colspan="4" style="background: white;">
					<br/>
					<div style="background-color:#eaeaea;padding:10px;margin:0 0px;overflow:scroll;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
					<table border="1" id="gurantor_table" style="border-color:#c0c0c0;width:127%;margin:20px" >
						<thead>
							<tr>
								<td width="2%" style="font-weight: bold;text-align:center"><input type="checkbox" name="checkAll" id="checkAll" checked="checked" onClick="CheckAll_2(this)" /></td>
								<td width="8%" style="font-weight: bold;text-align:center">Facility Type<span style="color:red">*</span></td>
								<td width="5%" style="font-weight: bold;text-align:center">A/C Number</td>
								<td width="5%" style="font-weight: bold;text-align:center">A/C Name</td>
								<td width="5%" style="font-weight: bold;text-align:center">Sch Desc.</td>
								<td width="5%" style="font-weight: bold;text-align:center">Disbursement Date<span style="color:red">*</span></td>
								<td width="7%" style="font-weight: bold;text-align:center">Disbursed Amount<span style="color:red">*</span></td>
								<td width="7%" style="font-weight: bold;text-align:center">Expire Date<span style="color:red">*</span></td>
								<td width="7%" style="font-weight: bold;text-align:center">Due install ments<span style="color:red">*</span></td>
								<td width="7%" style="font-weight: bold;text-align:center">Payable</td>
								<td width="7%" style="font-weight: bold;text-align:center">Repayment</td>
								<td width="7%" style="font-weight: bold;text-align:center">Outst anding Balance<span style="color:red">*</span></td>
								<td width="7%" style="font-weight: bold;text-align:center">Outst anding Balance Date<span style="color:red">*</span></td>
								<td width="7%" style="font-weight: bold;text-align:center">Overdue Balance</td>
								<td width="7%" style="font-weight: bold;text-align:center">Overdue BL Date</td>
								<td width="7%" style="font-weight: bold;text-align:center">Call -up Date</td>
								<td width="7%" style="font-weight: bold;text-align:center">CL(BB)</td>
								<td width="7%" style="font-weight: bold;text-align:center">CL(BBL)</td>
							</tr>
						</thead>
							<tbody id="facility_info_body">
								<?php if (!empty($facility_info)): ?>
									<?php $cot=1; foreach ($facility_info as $key): ?>
										<tr id="facility_info_<?=$cot;?>">
										<input type="hidden" id="facility_info_delete_<?=$cot;?>" name="facility_info_delete_<?=$cot;?>" value="0">
										<input type="hidden" id="facility_info_edit_<?=$cot;?>" name="facility_info_edit_<?=$cot;?>" value="<?=$key->id;?>">
										<input type="hidden" id="api_new_<?=$cot;?>" name="api_new_<?=$cot;?>" value="<?=$key->api_new;?>">
										
											<td>
												<input type="checkbox" name="chkBoxSelect<?=$cot;?>" checked="checked" id="chkBoxSelect<?=$cot;?>" onClick="CheckChanged_2(this,<?=$cot;?>)" value="chk"/>
											</td>
											<td>
	                    						<div id="facility_type_<?=$cot;?>" name="facility_type_<?=$cot;?>" style="padding-left: 3px;"></div>
												<script>
												var theme = getDemoTheme();
												jQuery("#facility_type_<?=$cot;?>").jqxComboBox({theme: theme, width: 80, autoOpen: false, autoDropDownHeight: false, promptText: "Facility", source: facility_name, height: 25});
												jQuery("#facility_type_<?=$cot;?>").jqxComboBox('val', '<?=isset($key->facility_type)?$key->facility_type:''?>');
												jQuery('#facility_type_<?=$cot;?>').focusout(function() {
										            commbobox_check(jQuery(this).attr('id'));
										        });
												</script>
											</td>
											<td style="text-align:center"><?=$key->ac_number?></td>
											<td style="text-align:center"><?=$key->ac_name?></td>
											<td style="text-align:center"><?=$key->sch_desc?></td>
											<td>
	                    						<input  class="text" name="disbursement_date_<?=$cot;?>" id="disbursement_date_<?=$cot;?>" value="<?=isset($key->disbursement_date)?date_format(date_create($key->disbursement_date),"d/m/Y"):''?>" type="text" style="width:90%"/>
												<script>
												datePicker("disbursement_date_<?=$cot;?>");
												</script>
											</td>
											<td><input name="disbursed_amount_<?=$cot;?>" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="disbursed_amount_<?=$cot;?>" value="<?=isset($key->disbursed_amount)?$key->disbursed_amount:''?>"/></td>
											<td>
	                    						<input  class="text" name="expire_date_<?=$cot;?>" id="expire_date_<?=$cot;?>" value="<?=isset($key->expire_date)?date_format(date_create($key->expire_date),"d/m/Y"):''?>" type="text" style="width:90%"/>
												<script>
												datePicker("expire_date_<?=$cot;?>");
												</script>
											</td>
											<td><input name="due_installments_<?=$cot;?>" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="due_installments_<?=$cot;?>" value="<?=isset($key->due_installments)?$key->due_installments:''?>"/></td>
											<td><input name="payble_<?=$cot;?>" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="payble_<?=$cot;?>" value="<?=isset($key->payble)?$key->payble:''?>"/></td>
											<td><input name="repayment_<?=$cot;?>" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="repayment_<?=$cot;?>" value="<?=isset($key->repayment)?$key->repayment:''?>"/></td>
											<td><input name="outstanding_bl_<?=$cot;?>" type="text" onKeyPress="return numbersonly(this,event,true)" class="" style="width:90%" id="outstanding_bl_<?=$cot;?>" value="<?=isset($key->outstanding_bl)?$key->outstanding_bl:''?>"/></td>
											<td>
	                    						<input  class="text" name="outstanding_bl_dt_<?=$cot;?>" id="outstanding_bl_dt_<?=$cot;?>" value="<?=isset($key->outstanding_bl_dt)?date_format(date_create($key->outstanding_bl_dt),"d/m/Y"):''?>" type="text" style="width:90%"/>
												<script>
												datePicker("outstanding_bl_dt_<?=$cot;?>");
												</script>
											</td>
											<td><input name="overdue_bl_<?=$cot;?>" type="text" onKeyPress="return numbersonly(this,event,true)" class="" style="width:90%" id="overdue_bl_<?=$cot;?>" value="<?=isset($key->overdue_bl)?$key->overdue_bl:''?>"/></td>
											<td>
	                    						<input  class="text" name="overdue_bl_dt_<?=$cot;?>" id="overdue_bl_dt_<?=$cot;?>" value="<?=isset($key->overdue_bl_dt)?date_format(date_create($key->overdue_bl_dt),"d/m/Y"):''?>" type="text" style="width:90%"/>
												<script>
												datePicker("overdue_bl_dt_<?=$cot;?>");
												</script>
											</td>
											<td>
	                    						<input  class="text" name="call_up_dt_<?=$cot;?>" id="call_up_dt_<?=$cot;?>" value="<?=isset($key->call_up_dt)?date_format(date_create($key->call_up_dt),"d/m/Y"):''?>" type="text" style="width:90%"/>
												<script>
												datePicker("call_up_dt_<?=$cot;?>");
												</script>
											</td>
											<td>
												<div id="cl_bb_<?=$cot;?>" name="cl_bb_<?=$cot;?>" style="padding-left: 3px;"></div>
												<script>
												var theme = getDemoTheme();
												jQuery("#cl_bb_<?=$cot;?>").jqxComboBox({theme: theme, width: 60, autoOpen: false, autoDropDownHeight: false, promptText: "Cl", source: cl, height: 25});
												jQuery("#cl_bb_<?=$cot;?>").jqxComboBox('val', '<?=isset($key->cl_bb)?$key->cl_bb:''?>');
												jQuery('#cl_bb_<?=$cot;?>').focusout(function() {
										            commbobox_check(jQuery(this).attr('id'));
										        });
												</script>
											</td>
											<td>
												<div id="cl_bbl_<?=$cot;?>" name="cl_bbl_<?=$cot;?>" style="padding-left: 3px;"></div>
												<script>
												var theme = getDemoTheme();
												jQuery("#cl_bbl_<?=$cot;?>").jqxComboBox({theme: theme, width: 60, autoOpen: false, autoDropDownHeight: false, promptText: "Cl", source: cl, height: 25});
												jQuery("#cl_bbl_<?=$cot;?>").jqxComboBox('val', '<?=isset($key->cl_bbl)?$key->cl_bbl:''?>');
												jQuery('#cl_bbl_<?=$cot;?>').focusout(function() {
										            commbobox_check(jQuery(this).attr('id'));
										        });
												</script>
											</td>
										</tr>
									<?php $cot++; endforeach ?>
									<input type="hidden" name="facility_info_counter" id="facility_info_counter" value="<?=$cot-1?>">
								<?php else: ?>
									<tr id="facility_info_1">
										<input type="hidden" id="facility_info_delete_1" name="facility_info_delete_1" value="0">
										<input type="hidden" id="facility_info_edit_1" name="facility_info_edit_1" value="">
										<input type="hidden" id="api_new_1" name="api_new_1" value="0">
										
											<td>
												<input type="checkbox" name="chkBoxSelect1" checked="checked" id="chkBoxSelect1" onClick="CheckChanged_2(this,1)" value="chk"/>
											</td>
											<td>
	                    						<div id="facility_type_1" name="facility_type_1" style="padding-left: 3px;"></div>
												<script>
												var theme = getDemoTheme();
												jQuery("#facility_type_1").jqxComboBox({theme: theme, width: 80, autoOpen: false, autoDropDownHeight: false, promptText: "Facility", source: facility_name, height: 25});
												jQuery('#facility_type_1').focusout(function() {
										            commbobox_check(jQuery(this).attr('id'));
										        });
												</script>
											</td>
											<td><input name="ac_number_1" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="ac_number_1" value=""/></td>
											<td>
	                    						<input  class="text" name="disbursement_date_1" id="disbursement_date_1" value="" type="text" style="width:90%"/>
												<script>
												datePicker("disbursement_date_1");
												</script>
											</td>
											<td>
	                    						<input  class="text" name="expire_date_1" id="expire_date_1" value="" type="text" style="width:90%"/>
												<script>
												datePicker("expire_date_1");
												</script>
											</td>
											<td><input name="disbursed_amount_1" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="disbursed_amount_1" value=""/></td>
											<td><input name="due_installments_1" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="due_installments_1" value=""/></td>
											<td><input name="payble_1" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="payble_1" value=""/></td>
											<td><input name="repayment_1" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="repayment_1" value=""/></td>
											<td><input name="outstanding_bl_1" type="text" onKeyPress="return numbersonly(this,event,true)" class="" style="width:90%" id="outstanding_bl_1" value=""/></td>
											<td>
	                    						<input  class="text" name="outstanding_bl_dt_1" id="outstanding_bl_dt_1" value="" type="text" style="width:90%"/>
												<script>
												datePicker("outstanding_bl_dt_1");
												</script>
											</td>
											<td><input name="overdue_bl_1" type="text" onKeyPress="return numbersonly(this,event,true)" class="" style="width:90%" id="overdue_bl_1" value=""/></td>
											<td>
	                    						<input  class="text" name="overdue_bl_dt_1" id="overdue_bl_dt_1" value="" type="text" style="width:90%"/>
												<script>
												datePicker("overdue_bl_dt_1");
												</script>
											</td>
											<td>
	                    						<input  class="text" name="call_up_dt_1" id="call_up_dt_1" value="" type="text" style="width:90%"/>
												<script>
												datePicker("call_up_dt_1");
												</script>
											</td>
											<td>
												<div id="cl_bb_1" name="cl_bb_1" style="padding-left: 3px;"></div>
												<script>
												var theme = getDemoTheme();
												jQuery("#cl_bb_1").jqxComboBox({theme: theme, width: 60, autoOpen: false, autoDropDownHeight: false, promptText: "Cl", source: cl, height: 25});
												jQuery('#cl_bb_1').focusout(function() {
										            commbobox_check(jQuery(this).attr('id'));
										        });
												</script>
											</td>
											<td>
												<div id="cl_bbl_1" name="cl_bbl_1" style="padding-left: 3px;"></div>
												<script>
												var theme = getDemoTheme();
												jQuery("#cl_bbl_1").jqxComboBox({theme: theme, width: 60, autoOpen: false, autoDropDownHeight: false, promptText: "Cl", source: cl, height: 25});
												jQuery('#cl_bbl_1').focusout(function() {
										            commbobox_check(jQuery(this).attr('id'));
										        });
												</script>
											</td>
										</tr>
										<input type="hidden" name="facility_info_counter" id="facility_info_counter" value="1">
								<?php endif ?>
							</tbody>
							<!-- <tfoot>
	        				<tr id="add_guarantor_row">
	        					<td colspan="15" style="text-align: right">
	        						Add More <input tabindex="" type="button" title="Add More" onClick="add_more_facility()" class="addmore"><br>
	        					</td>
	        				</tr>
	        				</tfoot> -->
						</table>
					</div>
				</td>
			<?php else: ?>
				<!-- FOR CARD -->
				<td colspan="4" style="background: white;">
					<br/>
					<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
						<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
							<thead style="background-color:#F1F1F1">
								<tr>
									<td width="20%" style="font-weight: bold;text-align:center">Card Issuing Date<span style="color:red">*</span></td>
									<td width="20%" style="font-weight: bold;text-align:center">Expire Date<span style="color:red">*</span></td>
									<td width="20%" style="font-weight: bold;text-align:center">Credit Limit<span style="color:red">*</span></td>
									<td width="20%" style="font-weight: bold;text-align:center">Outstanding Balance<span style="color:red">*</span></td>
									<td width="20%" style="font-weight: bold;text-align:center">Outstanding BL DT<span style="color:red">*</span></td>
								</tr>
							</thead>
							<tbody id="facility_info_body">
									<?php foreach ($facility_info as $key): ?>
									<tr id="facility_info">
										<td>
	                						<input  class="text" name="card_iss_date" id="card_iss_date" value="<?=isset($key->card_iss_date)?date_format(date_create($key->card_iss_date),"d/m/Y"):''?>" type="text" style="width:90%"/>
											<script>
											datePicker("card_iss_date");
											</script>
										</td>
										<td>
	                						<input  class="text" name="card_exp_date" id="card_exp_date" value="<?=isset($key->card_exp_date)?date_format(date_create($key->card_exp_date),"d/m/Y"):''?>" type="text" style="width:90%"/>
											<script>
											datePicker("card_exp_date");
											</script>
										</td>
										<td><input name="card_limit" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="card_limit" value="<?=isset($key->card_limit)?$key->card_limit:''?>"/></td>
										<td><input name="outstanding_bl" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="outstanding_bl" value="<?=isset($key->outstanding_bl)?$key->outstanding_bl:''?>"/></td>
										<td>
	                						<input  class="text" name="outstanding_bl_dt" id="outstanding_bl_dt" value="<?=isset($key->outstanding_bl_dt)?date_format(date_create($key->outstanding_bl_dt),"d/m/Y"):''?>" type="text" style="width:90%"/>
											<script>
											datePicker("outstanding_bl_dt");
											</script>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</td>
			<?php endif ?>
		</tr>
		<tr>
			<td colspan="4" style="background: white;text-align: center;">	
				<input type="hidden" id="deleteEventId" name="deleteEventId" value="<?=$result->id;?>" />
				<br/></br>
				&nbsp;&nbsp;&nbsp;
				<input type="button" value="Save" id="sendButton" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
				<span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><br/>
				</br></br></br>
			</td>
		</tr>
		</table>
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