<script type="text/javascript" src="<?= base_url() ?>js/jquery.ajaxupload.js"></script>
<!--  styling starts: -->
<style type="text/css">
	#cto_data_table {
		border-collapse: collapse;
	}

	#cto_data_table,
	#cto_data_table th,
	#cto_data_table td {
		border-color: #c7c7c7;
	}

	.text-input-medium {
		width: 250px;
	}

	.addmore {
		background-image: url(<?= base_url() ?>images/addmore_grn.png);
		/*background-size: 20px 20px;*/
		background-repeat: no-repeat;
		border: 0;
		width: 18px;
		height: 18px;
		background-color: transparent;
		cursor: pointer;
	}

	.del {
		background-image: url(<?= base_url() ?>images/del.png);
		background-repeat: no-repeat;
		border: 0;
		width: 18px;
		height: 18px;
		background-color: transparent;
		cursor: pointer;
	}

	.edit {
		background-image: url(<?= base_url() ?>images/edit.png);
		background-repeat: no-repeat;
		border: 0;
		width: 18px;
		height: 18px;
		background-color: transparent;
		cursor: pointer;
	}

	#tab1Table td,
	#tab3Table td,
	#tab2Table td {
		vertical-align: top;
	}

	table#addressTable {
		border-collapse: collapse;
	}

	table#addressTable,
	#addressTable th,
	#addressTable td {
		border: 1px solid #c7c7c7;
	}

	table#addressTablet {
		border-collapse: collapse;
	}

	table#addressTablet,
	#addressTablet th,
	#addressTablet td {
		border: 1px solid #c7c7c7;
	}

	table#facility_info td {
		border: 1px solid #c7c7c7;
		text-align: center;
	}

	table#loanTable {
		border-collapse: collapse;
	}

	table#loanTable,
	#loanTable th,
	#loanTable td {
		border: 1px solid #c7c7c7;
	}

	table#loanTable_detail {
		border-collapse: collapse;
	}

	table#guarantor_info td {
		border: 1px solid #c7c7c7;
		text-align: center;
	}

	table#loanTable_detail,
	#loanTable_detail th,
	#loanTable_detail td {
		border: 1px solid #c7c7c7;
	}

	#loanTable_detail th,
	#loanTable_detail td {
		text-align: center;
	}

	#addressTable th,
	#addressTable td {
		text-align: center;
	}

	#addressTablet th,
	#addressTablet td {
		text-align: center;
	}

	#loanTable th,
	#loanTable td {
		text-align: center;
	}

	table#owner_addressTable {
		border-collapse: collapse;
	}

	table#owner_addressTable,
	#owner_addressTable th,
	#owner_addressTable td {
		border: 1px solid #c7c7c7;
	}

	#owner_addressTable th,
	#owner_addressTable td {
		text-align: center;
	}

	table#owner_addressTablet {
		border-collapse: collapse;
	}

	table#owner_addressTablet,
	#owner_addressTablet th,
	#owner_addressTablet td {
		border: 1px solid #c7c7c7;
	}

	#owner_addressTablet th,
	#owner_addressTablet td {
		text-align: center;
	}

	#ownerTable {
		border-collapse: collapse;
	}

	#ownerTable,
	#ownerTable th,
	#ownerTable td {
		border-color: #c7c7c7;
	}

	.hint {

		color: red;
	}

	.section {
		padding: 5px;
	}

	#hintWrapper {
		float: left;
		margin: 10px;
	}

	.jqx-window-modal {
		height: 625px !important;
	}

	.nextButton {
		float: right;
		margin: 10px;
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}

	.backButton {
		float: left;
		margin: 10px;
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}

	#sectionButtonsWrapper {
		float: right;
	}

	#basketButtonsWrapper {
		float: right;

	}

	#selectedProductsButtonsWrapper {
		float: right;

	}

	#ownerSave,
	#addmoreOwner {
		width: 100px;
		height: 30px;
		font-weight: bold;
		font-family: arial;
	}

	.dateSpan {
		font-weight: normal;
		font-size: 12px;
		color: #808080;
	}

	span.login-text {
		font-size: 15px;
		display: table;
		margin-left: auto;
		margin-right: 110px;
	}

	.tablescroll #headerTable td {
		border: none;
	}

	.headSpan {
		float: left;
		font-weight: bold;
		font-size: 9pt;
		cursor: pointer;
	}

	#gurantor_table {
		border-collapse: collapse;
	}

	#gurantor_table th {
		word-wrap: break-word;
		border: 1px solid rgba(0, 0, 0, .20);
	}

	#gurantor_table td {
		word-wrap: break-word;
		border: 1px solid rgba(0, 0, 0, .20);
	}
</style>

<!--   styling Ends:  -->

<script type="text/javascript">
	//   	window.onload = () => {
	//  const myInput = document.getElementById('loan_ac');
	//  myInput.onpaste = e => e.preventDefault();
	// }
	var csrf_tokens = '';
	var guar_sts = [<? $i = 1;
					foreach ($guar_sts as $row) {
						if ($i != 1) {
							echo ',';
						}
						echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
						$i++;
					} ?>];
	var guar_type = [<? $i = 1;
						foreach ($guar_type as $row) {
							if ($i != 1) {
								echo ',';
							}
							echo '{value:"' . $row->code . '", label:"' . $row->name . '"}';
							$i++;
						} ?>];
	var occ_sts = [<? $i = 1;
					foreach ($guar_occ as $row) {
						if ($i != 1) {
							echo ',';
						}
						echo '{value:"' . $row->code . '", label:"' . $row->name . '"}';
						$i++;
					} ?>];
	var cl = [<? $i = 1;
				foreach ($cl as $row) {
					if ($i != 1) {
						echo ',';
					}
					echo '{value:"' . $row->name . '", label:"' . $row->name . '"}';
					$i++;
				} ?>];
	//var facility_name = [<? $i = 1;
							foreach ($facility_name as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];
	var proposed_type = ["Loan", "Card"];

	jQuery(document).ready(function() {
		var theme = getDemoTheme();
		jQuery('#in_req_button').jqxButton({
			template: "default",
			width: "150"
		});

		var req_type = [<? $i = 1;
						foreach ($req_type as $row) {
							if ($i != 1) {
								echo ',';
							}
							echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
							$i++;
						} ?>];
		var loan_segment = [<? $i = 1;
							foreach ($loan_segment as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->code . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];
		var sub_type = [<? $i = 1;
						foreach ($sub_type as $row) {
							if ($i != 1) {
								echo ',';
							}
							echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
							$i++;
						} ?>];
		var region_data = [<? $i = 1;
							foreach ($region_data as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];
		var branch_sol = [<? $i = 1;
							foreach ($branch_sol as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->code . '", label:"' . $row->name . ' (' . $row->code . ')"}';
								$i++;
							} ?>];

		jQuery('.text-input').addClass('jqx-input');
		jQuery('.text-input').addClass('jqx-rc-all');
		if (theme.length > 0) {
			jQuery('.text-input').addClass('jqx-input-' + theme);
			jQuery('.text-input').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input').addClass('jqx-rc-all-' + theme);
		}
		//Checkbox
		jQuery("#more_acc").jqxCheckBox({
			width: 22,
			theme: theme <?= $add_edit == 'edit' ? (($result->more_acc_available == '1') ? ',checked:true' : ',checked:false') : ',checked:false' ?>
		});

		<? if ($add_edit == 'edit') { ?>
			//For more account available input field
			<? if ($result->more_acc_available == '1') { ?>
				document.getElementById("more_acc_number").disabled = false;
			<? } ?>
			document.getElementById("loan_ac").disabled = true;
		<? } ?>

		//Combobox
		var district = [<? $i = 1;
							foreach ($district_list as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];
			jQuery("#district").jqxComboBox({
				theme: theme,
				autoOpen: false,
				autoDropDownHeight: false,
				promptText: "Select District",
				source: district,
				width: 250,
				height: 25
			});
			var territory = [<? $i = 1;
								foreach ($territory_list as $row) {
									if ($i != 1) {
										echo ',';
									}
									echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
									$i++;
								} ?>];
			jQuery("#territory").jqxComboBox({
				theme: theme,
				autoDropDownHeight: false,
				promptText: "Select Territory",
				source: territory,
				width: 250,
				height: 25
			});
			var unit_office = [<? $i = 1;
								foreach ($unit_office_list as $row) {
									if ($i != 1) {
										echo ',';
									}
									echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
									$i++;
								} ?>];
			jQuery("#unit_office").jqxComboBox({
				theme: theme,
				autoDropDownHeight: false,
				promptText: "Select Unit Office",
				source: unit_office,
				width: 250,
				height: 25
			});
		jQuery("#branch_sol").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Branch SOL",
			source: branch_sol,
			width: 250,
			height: 25
		});
		jQuery("#region").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Select Region",
			source: region_data,
			width: 250,
			height: 25
		});
		//jQuery("#req_type").jqxComboBox({theme: theme, width: 250, autoDropDownHeight: false, promptText: "Select Requisition Type", source: req_type, height: 25});
		jQuery("#proposed_type").jqxComboBox({
			theme: theme,
			width: 250,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Select Proposed Type",
			source: proposed_type,
			height: 25
		});
		jQuery("#loan_segment").jqxComboBox({
			theme: theme,
			width: 250,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Loan Segement",
			source: loan_segment,
			height: 25
		});
		jQuery("#sub_type").jqxComboBox({
			theme: theme,
			width: 250,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Business Type",
			source: sub_type,
			height: 25
		});
		jQuery("#guar_sts_1").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Stauts",
			source: guar_sts,
			width: 100,
			height: 25
		});
		jQuery("#occ_sts_1").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Occupation",
			source: occ_sts,
			width: 140,
			height: 25
		});
		jQuery("#guarantor_type_1").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Type",
			source: guar_type,
			width: 100,
			height: 25
		});
		var district = [<? $i = 1;
						foreach ($district_list as $row) {
							if ($i != 1) {
								echo ',';
							}
							echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
							$i++;
						} ?>];
		jQuery("#district").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Select District",
			source: district,
			width: 250,
			height: 25
		});
		var unit_office = [<? $i = 1;
							foreach ($unit_office_list as $row) {
								if ($i != 1) {
									echo ',';
								}
								echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
								$i++;
							} ?>];
		jQuery("#unit_office").jqxComboBox({
			theme: theme,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Select Unit Office",
			source: unit_office,
			width: 250,
			height: 25,
			disabled: false
		});

		<? if ($add_edit == 'add') { ?>
			jQuery("#proposed_type").jqxComboBox('val', 'Loan');
			change_caption();
			//change_dropdown('region', <?= $this->session->userdata['ast_user']['recovery_region'] ?>);
		<? } ?>

		jQuery('#branch_sol,#guar_sts_1,#occ_sts_1,#guarantor_type_1,#region,#district,#territory,#unit_office,#proposed_type,#loan_segment,#sub_type').focusout(function() {
			//alert(jQuery(this).attr('id'));
			commbobox_check(jQuery(this).attr('id'));
		});
		<? if ($add_edit == 'edit') { ?>
			jQuery("#region").jqxComboBox('val', '<?= (isset($result->region) && $result->region != 0) ? $result->region : '' ?>');
			change_dropdown('region', <?= (isset($result->region) && $result->region != 0) ? $result->region : '' ?>);
			change_dropdown('territory',<?= (isset($result->territory) && $result->territory != 0) ? $result->territory : '' ?>);
			change_dropdown('district',<?= (isset($result->district) && $result->district != 0) ? $result->district : '' ?>);
			jQuery("#branch_sol").jqxComboBox('val', '<?= (isset($result->branch_sol) && $result->branch_sol != 0) ? $result->branch_sol : '' ?>');
			jQuery("#territory").jqxComboBox('val', '<?= (isset($result->territory) && $result->territory != 0) ? $result->territory : '' ?>');
			jQuery("#district").jqxComboBox('val', '<?= (isset($result->district) && $result->district != 0) ? $result->district : '' ?>');
			jQuery("#unit_office").jqxComboBox('val', '<?= (isset($result->unit_office) && $result->unit_office != 0) ? $result->unit_office : '' ?>');
			//jQuery("#req_type").jqxComboBox('val', '<?= isset($result->req_type) && $result->req_type != 0 ? $result->req_type : '' ?>');
			jQuery("#proposed_type").jqxComboBox('val', '<?= (isset($result->proposed_type) && $result->proposed_type != '') ? $result->proposed_type : '' ?>');
			change_caption('<?= (isset($result->proposed_type) && $result->proposed_type != 0) ? $result->proposed_type : '' ?>');
			jQuery("#sub_type").jqxComboBox('val', '<?= (isset($result->sub_type) && $result->sub_type != 0) ? $result->sub_type : '' ?>');
			jQuery("#loan_segment").jqxComboBox('val', '<?= (isset($result->loan_segment) && $result->loan_segment != '') ? $result->loan_segment : '' ?>');
			jQuery("#unit_office").jqxComboBox('val', '<?= (isset($result->unit_office) && $result->unit_office != 0) ? $result->unit_office : '' ?>');
			jQuery("#proposed_type").jqxComboBox('disabled', true);
			<? if ($result->sub_type == '3') { ?>
				jQuery('#spfm').show();
			<? } ?>
			<? if ($result->proposed_type == 'Card') { ?>
				jQuery('#card_facility_row').show();
				jQuery('#card_row_for_facility').show();
			<? } ?>
			<? if ($result->proposed_type == 'Loan') { ?>
				jQuery('#loan_facility_row').show();
			<? } ?>
		<? } ?>
		jQuery("#more_acc").bind('change', function(event) {
			var checked = event.args.checked;
			if (checked == true) {
				jQuery("#more_acc_available").val(1);
				document.getElementById("more_acc_number").disabled = false;
			} else {
				document.getElementById("more_acc_number").disabled = true;
				jQuery("#more_acc_available").val(0);
				jQuery("#more_acc_number").val('');
			}
		});
		jQuery('#region').bind('change', function(event) {
			change_dropdown('region');
		});
		jQuery('#territory').bind('change', function (event) {
			change_dropdown('territory');		
		});
		jQuery('#district').bind('change', function (event) {
			change_dropdown('district');		
		});

		jQuery('#proposed_type').bind('change', function(event) {
			jQuery("#loan_ac").val('');
			jQuery("#hidden_loan_ac").val('');
			jQuery("#card_facility_row").hide();
			jQuery('#legal_notice_form').jqxValidator('hide');
			change_caption();
		});
		jQuery('#sub_type').bind('change', function(event) {
			var item = jQuery("#sub_type").jqxComboBox('getSelectedItem');
			if (item.label == 'Personal') {
				jQuery('#spfm').show();
			} else {
				jQuery('#spfm').hide();
				jQuery('#mother_name').val('');
				jQuery('#spouse_name').val('');
			}
			jQuery('#legal_notice_form').jqxValidator('hide');
		});
		jQuery('#req_type input').focus();
	});

	function api_date_format(str) {
		if (str == '' || str == undefined) {
			return '';
		} else {
			var str_1 = str.split("T");
			var str_2 = str_1[0].split("-");
			var final_str = str_2[2] + '/' + str_2[1] + '/' + str_2[0];
			return final_str;
		}
	}

	function api_date_format_x_time(str) {
		//var str_1=str.split("T");
		if (str == '' || str == undefined) {
			return '';
		} else {
			var str_2 = str.split("-");
			var final_str = str_2[0] + '/' + str_2[1] + '/' + str_2[2];
			return final_str;
		}
	}

	function card_date_format(str) {
		if (str == '' || str == undefined) {
			return '';
		} else {
			var year = str.slice(0, 4);
			var month = str.slice(4, 6);
			var day = str.slice(6, 8);
			var final_dt = day + '/' + month + '/' + year;
			return final_dt;
		}
	}

	function card_exp_date_format(str) {
		if (str == '' || str == undefined) {
			return '';
		} else {
			var year = str.slice(0, 4);
			var month = str.slice(4, 6);
			var day = '01';
			var final_dt = day + '/' + month + '/' + year;
			return final_dt;
		}
	}

	function card_number_masker(str) {
		if (str == '' || str == undefined) {
			return '';
		} else {
			var leg1 = str.slice(0, 6);
			var leg3 = str.slice(12, 16);
			var leg2 = '******';
			var final_leg = leg1 + leg2 + leg3;
			return final_leg;
		}
	}

	function facility_validation() {
		//For loan facility validation
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
		if (item.value == 'Loan') {
			var counter = 0;
			var total_row = jQuery('#facility_info_counter').val();
			//alert(total_row);
			var check = 0;
			var base_facility_check = 0;
			for (var i = 1; i <= total_row; i++) {
				if (document.getElementById("chkBoxSelect" + i).checked == true) {
					check++;
				}

				if (document.getElementById("chkBoxSelect" + i).checked == true && jQuery('#base_facility_' + i).val() == 1) {
					base_facility_check++;
				}
			}
			for (i = 1; i <= total_row; i++) {
				if (jQuery('#facility_info_delete_' + i).val() == 0) {
					if (jQuery.trim(jQuery('#disbursement_date_' + i).val()) == '') {
						alert('Disbursement Date Required');
						jQuery('#disbursement_date_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#expire_date_' + i).val()) == '') {
						alert('Expire Date Required');
						jQuery('#expire_date_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#disbursed_amount_' + i).val()) == '') {
						alert('Disbursed Amount Required');
						jQuery('#disbursed_amount_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#outstanding_bl_' + i).val()) == '') {
						alert('Outstanding Balance Required');
						jQuery('#outstanding_bl_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#outstanding_bl_dt_' + i).val()) == '') {
						alert('Outstanding Bl Date Required');
						jQuery('#outstanding_bl_dt_' + i).focus();
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
			if (check < 1 || base_facility_check < 1) {
				alert('Select your required account from facility info!!');
				return false;
			}
		} else {
			var item = jQuery("#cl_bb_card").jqxComboBox('getSelectedItem');
			//alert(item.value);
			if (!item) {
				alert('CL BB Required');
				jQuery('#cl_bb_card input').focus();
				return false;
			}
			var item2 = jQuery("#cl_bbl_card").jqxComboBox('getSelectedItem');
			//alert(item.value);
			if (!item2) {
				alert('CL BBL Required');
				jQuery('#cl_bbl_card input').focus();
				return false;
			}
		}
		return true;
	}

	function add_more_facility() {

		var theme = getDemoTheme();
		var counter = jQuery('#facility_info_counter').val();

		var new_counter = parseInt(counter) + 1;
		html_string = '';

		html_string += '<tr id="facility_info_' + new_counter + '">';
		html_string += '<td>';
		html_string += '<input type="hidden" id="facility_info_edit_' + new_counter + '" name="facility_info_edit_' + new_counter + '" value="0">';
		html_string += '<input type="hidden" id="facility_info_delete_' + new_counter + '" name="facility_info_delete_' + new_counter + '" value="0">';
		html_string += '<input type="hidden" id="api_new_' + new_counter + '" name="api_new_' + new_counter + '" value="0">';
		html_string += '<input type="checkbox" name="chkBoxSelect' + new_counter + '" checked="checked" id="chkBoxSelect' + new_counter + '" onClick="CheckChanged_2(this,' + new_counter + ')" value="chk"/>';
		html_string += '</td>';
		html_string += '<td><div id="facility_type_' + new_counter + '" name="facility_type_' + new_counter + '" style="padding-left: 3px" ></div></td>';
		html_string += '<td><input name="ac_number_' + new_counter + '" type="text" class="" style="width:90%" id="ac_number_' + new_counter + '" /></td>';
		html_string += '<td><input name="disbursement_date_' + new_counter + '" type="text" class="" style="width:90%" id="disbursement_date_' + new_counter + '" /></td>';
		html_string += '<td><input name="expire_date_' + new_counter + '" type="text" class="" style="width:90%" id="expire_date_' + new_counter + '" /></td>';
		html_string += '<td><input name="disbursed_amount_' + new_counter + '" type="text" class="" style="width:90%" id="disbursed_amount_' + new_counter + '" /></td>';
		html_string += '<td><input name="due_installments_' + new_counter + '" type="text" class="" style="width:90%" id="due_installments_' + new_counter + '" /></td>';
		html_string += '<td><input name="payble_' + new_counter + '" type="text" class="" style="width:90%" id="payble_' + new_counter + '" /></td>';
		html_string += '<td><input name="repayment_' + new_counter + '" type="text" class="" style="width:90%" id="repayment_' + new_counter + '" /></td>';
		html_string += '<td><input name="outstanding_bl_' + new_counter + '" type="text" class="" style="width:90%" id="outstanding_bl_' + new_counter + '" /></td>';
		html_string += '<td><input name="outstanding_bl_dt_' + new_counter + '" type="text" class="" style="width:90%" id="outstanding_bl_dt_' + new_counter + '" /></td>';
		html_string += '<td><input name="overdue_bl_' + new_counter + '" type="text" class="" style="width:90%" id="overdue_bl_' + new_counter + '" /></td>';
		html_string += '<td><input name="overdue_bl_dt_' + new_counter + '" type="text" class="" style="width:90%" id="overdue_bl_dt_' + new_counter + '" /></td>';
		html_string += '<td><input name="call_up_dt_' + new_counter + '" type="text" class="" style="width:90%" id="call_up_dt_' + new_counter + '" /></td>';
		html_string += '<td><input name="cl_' + new_counter + '" type="text" class="" style="width:90%" id="cl_' + new_counter + '" /></td>';
		html_string += '</tr>';

		jQuery('#facility_info_' + counter).after(html_string);
		jQuery('#facility_info_counter').val(new_counter);

		jQuery('#facility_type_' + new_counter).jqxComboBox({
			theme: theme,
			width: 80,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Facility",
			source: facility_name,
			height: 25
		});
		jQuery('#facility_type_' + new_counter).focusout(function() {
			commbobox_check(jQuery(this).attr('id'));
		});
		datePicker('disbursement_date_' + new_counter);
		datePicker('expire_date_' + new_counter);
		datePicker('outstanding_bl_dt_' + new_counter);
		datePicker('overdue_bl_dt_' + new_counter);
		datePicker('call_up_dt_' + new_counter);

	}

	function CheckAll_2(checkAllBox) {
		var ChkState = checkAllBox.checked;
		var number = jQuery("#facility_info_counter").val();

		if (ChkState == true) {
			for (var i = 1; i <= number; i++) {
				jQuery("#facility_info_delete_" + i).val(0);
				document.getElementById("chkBoxSelect" + i).checked = ChkState;
			}
		} else {
			for (var i = 1; i <= number; i++) {
				jQuery("#facility_info_delete_" + i).val(1);
				document.getElementById("chkBoxSelect" + i).checked = ChkState;
			}
		}
	}

	function CheckChanged_2(checkAllBox, counter) {
		var ChkState = checkAllBox.checked;
		if (ChkState == true) {
			jQuery("#facility_info_delete_" + counter).val(0);
		} else {
			jQuery("#facility_info_delete_" + counter).val(1);
		}
		var number = jQuery("#facility_info_counter").val();
		var checkco = 0;
		for (var i = 1; i <= number; i++) {
			if (document.getElementById("chkBoxSelect" + i).checked == true) {
				checkco++;
			}
		}
		if (number == checkco) {
			document.getElementById("checkAll").checked = true;
		} else {
			document.getElementById("checkAll").checked = false;
		}
	}

	var acLength = <?php echo $acLength; ?>;

	function validate_api_call() {
		jQuery('#legal_notice_form').jqxValidator('hide');
		var theme = getDemoTheme();
		var rules = [];
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');

		if (item.value == 'Loan') {
			rules.push({
					input: '#proposed_type',
					message: 'required!',
					action: 'blur,change',
					rule: function(input) {
						if (input.val() != '') {
							var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
							if (item != null) {
								jQuery("input[name='proposed_type']").val(item.value);
							}
							return true;
						} else {
							jQuery("#proposed_type input").focus();
							return false;
						}
					}
				}, {
					input: '#loan_ac',
					message: 'required!',
					action: 'keyup, blur',
					rule: function(input, commit) {
						if (jQuery("#loan_ac").val() == '') {
							jQuery("#loan_ac").focus();
							return false;
						} else {
							return true;
						}

					}
				}, 
				// {
				// 	input: '#loan_ac',
				// 	message: 'only numeric',
				// 	action: 'keyup, blur, change',
				// 	rule: function(input, commit) {
				// 		if (input.val() != '') {
				// 			if (!checknumber_alphabaticwithstar('loan_ac')) {
				// 				jQuery("#loan_ac").focus();
				// 				return false;

				// 			}
				// 		}
				// 		return true;

				// 	}
				// },

				{
					input: '#loan_ac',
					message: 'must be ' + acLength.join(" or ") + " Digits",
					action: 'keyup, blur, change',
					rule: function(input, commit) {
						if (input.val() != '') {

							if (jQuery.inArray(String(input.val().length), acLength) != -1) {
								return true;
							} else {
								return false;
							}



						}
						return true;

					}
				}, {
					input: '#cif',
					message: 'required!',
					action: 'keyup, blur',
					rule: function(input, commit) {
						if (jQuery("#cif").val() == '') {
							jQuery("#cif").focus();
							return false;
						} else {
							return true;
						}
					}
				}, {
					input: '#cif',
					message: 'must be 8 characters',
					action: 'keyup, blur, change',
					rule: function(input, commit) {
						if (input.val() != '') {
							if (input.val().length > 8 || input.val().length < 8) {
								jQuery("#cif").focus();
								return false;

							}
						}
						return true;

					}
				}
			);
		} else {
			rules.push({
				input: '#proposed_type',
				message: 'required!',
				action: 'blur,change',
				rule: function(input) {
					if (input.val() != '') {
						var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='proposed_type']").val(item.value);
						}
						return true;
					} else {
						jQuery("#proposed_type input").focus();
						return false;
					}
				}
			}, {
				input: '#loan_ac',
				message: 'required!',
				action: 'keyup, blur',
				rule: function(input, commit) {
					if (jQuery("#loan_ac").val() == '') {
						jQuery("#loan_ac").focus();
						return false;
					} else {
						return true;
					}

				}
			}, 
			// {
			// 	input: '#loan_ac',
			// 	message: 'only numeric',
			// 	action: 'keyup, blur, change',
			// 	rule: function(input, commit) {
			// 		if (input.val() != '') {
			// 			if (!checknumber_alphabaticwithstar('loan_ac')) {
			// 				jQuery("#loan_ac").focus();
			// 				return false;

			// 			}
			// 		}
			// 		return true;

			// 	}
			// }, 
			{
				input: '#loan_ac',
				message: 'must be 16 digits',
				action: 'keyup, blur, change',
				rule: function(input, commit) {
					if (input.val() != '') {
						if (input.val().length < 16 || input.val().length > 16) {
							jQuery("#loan_ac").focus();
							return false;

						}
					}
					return true;

				}
			});
		}
		jQuery('#legal_notice_form').jqxValidator({
			rules: rules,
			theme: theme
		});
		var validationResult = function(isValid) {
			if (isValid) {
				call_api();
			}
		}
		jQuery('#legal_notice_form').jqxValidator('validate', validationResult);
	}

	function ucwords(str, force) {
		str = force ? str.toLowerCase() : str;
		return str.replace(/(\b)([a-zA-Z])/g,
			function(firstLetter) {
				return firstLetter.toUpperCase();
			});
	}

	function capitialize(field) {
		const mySentence = jQuery('#' + field).val();
		const words = mySentence.split(" ");

		for (let i = 0; i < words.length; i++) {
			words[i] = words[i].substr(0, 1).toUpperCase() + words[i].substr(1).toLowerCase();
		}
		jQuery('#' + field).val(words.join(" "));
	}

	function call_api() {
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
		var type = item.value;
		<? if ($add_edit == 'edit') { ?>
			return;
		<? } ?>
		//Set empty of all condition field
		jQuery('#facility_info_counter').val(0);
		jQuery('#loan_facility_info_body').html('');
		jQuery("#loan_facility_row").hide();
		jQuery("#card_facility_row").hide();
		jQuery("#card_row_for_facility").hide();
		jQuery('#card_row_for_facility_body').html('');
		jQuery("#card_iss_date").val('');
		jQuery("#brrower_name").val('');
		jQuery("#card_exp_date").val('');
		jQuery("#card_limit").val('');
		jQuery("#outstanding_bl").val('');
		jQuery("#card_facility_body").html('');
		jQuery('#card_facility_counter').val(0);
		jQuery("#spfm").hide();
		jQuery("#spouse_name").val('');
		jQuery("#mother_name").val('');
		jQuery("#show_customer_id").html('');
		if (type == 'Loan') {
			var loan_ac = jQuery('#loan_ac').val();
			var cif = jQuery('#cif').val();
		}
		if (type == 'Card') {
			var loan_ac = jQuery('#hidden_loan_ac').val();
			var cif = jQuery('#cif').val();
		}
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?= base_url() ?>legal_notice/get_cif",
			data: {
				[csrfName]: csrfHash,
				type: type,
				ac: loan_ac,
				cif: cif
			},
			datatype: "json",
			beforeSend: function() {
				jQuery("#loading-overlay").show();
			},
			success: function(response) {
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
				if (json.pre_ln_data != '') {
					jQuery("#pre_ln_dt_l").html(json.pre_ln_data.dt_fromat);
					jQuery("#pre_ln_by").html(json.pre_ln_data.pre_ln_by);
					jQuery("#pre_ln_dt").val(json.pre_ln_data.e_dt);
					jQuery("#pre_ln_id").val(json.pre_ln_data.id);
					if (json.pre_ln_data.legal_notice_sts == 14) {
						var word = '<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?= base_url() ?>index.php/legal_notice_ho/download_pdf/' + json.pre_ln_data.id + '/' + json.pre_ln_data.proposed_type + '" target="_blank" ><img width="20px" height="20px" align="center" src="<?= base_url() ?>images/pdf_icon.gif"></a>';
					} else {
						var word = 'Legal Notice Generated';
					}
					jQuery("#pre_ln_file").html(word);
				} else {
					jQuery("#pre_ln_dt_l").html('Not Found');
					jQuery("#pre_ln_by").html('Not Found');
					jQuery("#pre_ln_dt").val('');
					jQuery("#pre_ln_id").val('');
					jQuery("#pre_ln_file").html('Not Found');
				}
				var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
				var type = item.value;
				if (type == 'Card') {
					if (json.Message == 'ok') {
						jQuery("#hidden_loan_ac").val(loan_ac);
						jQuery("#cif").val(json.results['CIF_NO']);
						jQuery("#ac_name").val(name_filter(json.results['CARDHOLDER_NAME']));
						jQuery("#hidden_customer_id").val(json.results['CUSTOMER_ID']);
						jQuery("#show_customer_id").html(json.results['CUSTOMER_ID']);
						var present_address = address_filter(address_trim_end(json.results['HOME_ADDR1']) + ',' + address_trim_end(json.results['HOME_ADDR2']) + ',' + address_trim_end(json.results['HOME_ADDR3']) + ',' + address_trim_end(json.results['HOME_ADDR4']) + ',' + address_trim_end(json.results['HOME_ADDR5']));
						var parmanent_address = address_filter(address_trim_end(json.results['ALT1_BILL_ADDR1']) + ',' + address_trim_end(json.results['ALT1_BILL_ADDR2']) + ',' + address_trim_end(json.results['ALT1_BILL_ADDR3']) + ',' + address_trim_end(json.results['ALT1_BILL_ADDR4']) + ',' + address_trim_end(json.results['ALT1_BILL_ADDR5']));
						var business_address = address_filter(address_trim_end(json.results['CO_ADDR1']) + ',' + address_trim_end(json.results['CO_ADDR2']) + ',' + address_trim_end(json.results['CO_ADDR3']) + ',' + address_trim_end(json.results['CO_ADDR4']) + ',' + address_trim_end(json.results['CO_ADDR5']));
						jQuery('#branch_sol').jqxComboBox('val', json.results['ISSUING_BRANCH_ID'].replace(/\s\s+/g, ' '));
						jQuery("#card_iss_date").val(card_date_format(json.results['CREATION_DATE']));
						jQuery("#card_exp_date").val(card_date_format(json.results['EXPIRY_DATE']));
						jQuery("#outstanding_bl_dt").val(card_date_format(json.results['OUTSTD_BAL_DT']));
						jQuery("#card_limit").val(json.results['CREDIT_LIMIT']);
						jQuery("#outstanding_bl").val(json.results['OUTSTD_BAL']);
						if (typeof json['sub_card_data'] === 'object' && json['sub_card_data'] != null) {
							var size = Object.keys(json['sub_card_data']).length;
						} else {
							var siz = 0;
						}
						html_string = '';
						var sub_card_counter = 0;
						var card_type = '';
						var out_bl_dt = '';
						if (size > 0) {
							jQuery.each(json['sub_card_data'], function(key, obj) {
								if (obj.BASIC_CARDHOLDER_NO.replaceAll(' ', '') == loan_ac) //Skipping other cards
								{
									var card_type = '';
									var card_no = '';
									var org_card_no = '';
									var card_exp_date = '';
									sub_card_counter++;
									if (obj.BASIC_SUPPLE_IND.replaceAll(' ', '') == 'B') {
										card_type = 'Basic';
									} else {
										card_type = 'Sup';
									}
									var card_no = card_number_masker(obj.CARDHOLDER_NO.replaceAll(' ', '')); //masking orginal card no
									var org_card_no = obj.CARDHOLDER_NO.replaceAll(' ', '');
									card_exp_date = card_exp_date_format(obj.EXPIRY_DATE.replaceAll(' ', ''));
									var today = new Date();
									out_bl_dt = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
									html_string += '<tr>';
									html_string += '<td style="text-align:center">' + card_type + '<input type="hidden" id="card_type_' + sub_card_counter + '" value="' + card_type + '" name="card_type_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + card_no + '<input type="hidden" id="org_card_no_' + sub_card_counter + '" value="' + org_card_no + '" name="org_card_no_' + sub_card_counter + '"><input type="hidden" id="card_no_' + sub_card_counter + '" value="' + card_no + '" name="card_no_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + name_filter(obj.CARDHOLDER_NAME) + '<input type="hidden" id="card_name_' + sub_card_counter + '" value="' + name_filter(obj.CARDHOLDER_NAME) + '" name="card_name_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + card_date_format(obj.CREATION_DATE.replaceAll(' ', '')) + '<input type="hidden" id="card_issue_dt_' + sub_card_counter + '" value="' + card_date_format(obj.CREATION_DATE.replaceAll(' ', '')) + '" name="card_issue_dt_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + card_exp_date + '<input type="hidden" id="card_exp_dt_' + sub_card_counter + '" value="' + card_exp_date + '" name="card_exp_dt_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + obj.CREDIT_LIMIT + '<input type="hidden" id="card_limit_' + sub_card_counter + '" value="' + obj.CREDIT_LIMIT + '" name="card_limit_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + obj.OUTSTD_BAL + '<input type="hidden" id="outstanding_bl_' + sub_card_counter + '" value="' + obj.OUTSTD_BAL + '" name="outstanding_bl_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center">' + out_bl_dt + '<input type="hidden" id="outstanding_bl_dt_' + sub_card_counter + '" value="' + out_bl_dt + '" name="outstanding_bl_dt_' + sub_card_counter + '"></td>';
									html_string += '<td style="text-align:center"><div id="cl_bb_card" name="cl_bb_card" style="padding-left: 3px" ></div></td>';
									html_string += '<td style="text-align:center"><div id="cl_bbl_card" name="cl_bbl_card" style="padding-left: 3px" ></div></td>';
									html_string += '</tr>';
								}

							});
							html_string += '<tr>';
							html_string += '<td style="font-weight: bold;text-align:right" colspan="6">Total Outstanding :</td>';
							html_string += '<td style="font-weight: bold;text-align:center">' + json.results['OUTSTD_BAL'] + '</td>';
							html_string += '</tr>';

						}
						//Card facility info
						html_string += '<input type="hidden" id="sub_card_counter" value="' + sub_card_counter + '" name="sub_card_counter">';
						jQuery('#card_row_for_facility_body').html(html_string);
						jQuery('#cl_bb_card').jqxComboBox({
							theme: theme,
							width: 100,
							autoOpen: false,
							autoDropDownHeight: false,
							promptText: "CL BB",
							source: cl,
							height: 25
						});
						jQuery('#cl_bb_card').focusout(function() {
							commbobox_check(jQuery(this).attr('id'));
						});
						jQuery('#cl_bbl_card').jqxComboBox({
							theme: theme,
							width: 100,
							autoOpen: false,
							autoDropDownHeight: false,
							promptText: "CL BBL",
							source: cl,
							height: 25
						});
						jQuery('#cl_bbl_card').focusout(function() {
							commbobox_check(jQuery(this).attr('id'));
						});
						jQuery("#card_row_for_facility").show();
						jQuery("#sub_type").val(3);
						//Guarantor info
						jQuery('#guarantor_info_body').html('');
						var new_counter = 1;
						html_string = '';
						for (var i = 1; i <= 1; i++) {
							if (i == 1) //For borrower info
							{
								html_string += '<tr id="guarantor_info_' + new_counter + '">';
								html_string += '<td>';
								html_string += '<input type="hidden" id="guarantor_info_edit_' + new_counter + '" name="guarantor_info_edit_' + new_counter + '" value="0">';
								html_string += '<input type="hidden" id="guarantor_info_delete_' + new_counter + '" name="guarantor_info_delete_' + new_counter + '" value="0">';
								html_string += '<input type="hidden" id="same_address_permission_' + new_counter + '" name="same_address_permission_' + new_counter + '" value="">';
								html_string += '<input type="hidden" id="ac_no_' + new_counter + '" name="ac_no_' + new_counter + '" value="' + json.results['CIF_NO'] + '">';
								html_string += '</td>';
								html_string += '<td><div id="guarantor_type_' + new_counter + '" name="guarantor_type_' + new_counter + '" style="padding-left: 3px" ></div></td>';
								html_string += '<td><input name="guarantor_name_' + new_counter + '" onblur="capitialize(\'guarantor_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="guarantor_name_' + new_counter + '" value="' + name_filter(json.results['CARDHOLDER_NAME']) + '"/></td>';
								html_string += '<td><input name="father_name_' + new_counter + '" onblur="capitialize(\'father_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="father_name_' + new_counter + '" value="' + name_filter(json.results['FATHER_NAME']) + '"/></td>';
								html_string += '<td><textarea name="present_address_' + new_counter + '" onblur="capitialize(\'present_address_' + new_counter + '\')" class="text-input-big" id="present_address_' + new_counter + '" style="height:40px !important;width:90%">' + present_address + '</textarea></td>';
								html_string += '<td><textarea name="permanent_address_' + new_counter + '" onblur="capitialize(\'permanent_address_' + new_counter + '\')" class="text-input-big" id="permanent_address_' + new_counter + '" style="height:40px !important;width:90%">' + parmanent_address + '</textarea></td>';
								html_string += '<td><textarea name="business_address_' + new_counter + '" onblur="capitialize(\'business_address_' + new_counter + '\')" class="text-input-big" id="business_address_' + new_counter + '" style="height:40px !important;width:90%">' + business_address + '</textarea></td>';
								html_string += '<td><div id="guar_sts_' + new_counter + '" name="guar_sts_' + new_counter + '" style="padding-left: 3px"></div></td>';
								html_string += '<td><div id="occ_sts_' + new_counter + '" name="occ_sts_' + new_counter + '" style="padding-left: 3px"></div></td>';
								html_string += '</tr>';
								jQuery('#guarantor_info_body').html(html_string);
								jQuery('#guarantor_type_' + new_counter).jqxComboBox({
									theme: theme,
									width: 100,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Type",
									source: guar_type,
									height: 25
								});
								jQuery('#guarantor_type_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								jQuery('#guarantor_type_' + new_counter).jqxComboBox('val', 'M');
								jQuery('#guar_sts_' + new_counter).jqxComboBox({
									theme: theme,
									width: 100,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Status",
									source: guar_sts,
									height: 25
								});
								jQuery('#guar_sts_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								jQuery('#occ_sts_' + new_counter).jqxComboBox({
									theme: theme,
									width: 140,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Occupation",
									source: occ_sts,
									height: 25
								});
								jQuery('#occ_sts_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
							}
							// else //For Refference info
							// {
							// 	html_string = '';
							// 	html_string += '<tr id="guarantor_info_'+new_counter+'">';
							// 	html_string += '<td>';
							// 	html_string += '<input type="hidden" id="guarantor_info_edit_'+new_counter+'" name="guarantor_info_edit_'+new_counter+'" value="0">';
							// 	html_string += '<input type="hidden" id="guarantor_info_delete_'+new_counter+'" name="guarantor_info_delete_'+new_counter+'" value="0">';
							// 	html_string += '<input type="hidden" id="ac_no_'+new_counter+'" name="ac_no_'+new_counter+'" value="">';
							// 	html_string += '</td>';
							// 	html_string += '<td><div id="guarantor_type_'+new_counter+'" name="guarantor_type_'+new_counter+'" style="padding-left: 3px" ></div></td>';
							// 	html_string += '<td><input name="guarantor_name_'+new_counter+'" onblur="capitialize(\'guarantor_name_'+new_counter+'\')" type="text" class="" style="width:90%" id="guarantor_name_'+new_counter+'" value="'+json.results['REL_NAME']+'"/></td>';
							// 	html_string += '<td><input name="father_name_'+new_counter+'" onblur="capitialize(\'father_name_'+new_counter+'\')" type="text" class="" style="width:90%" id="father_name_'+new_counter+'" value=""/></td>';
							// 	html_string += '<td><textarea name="present_address_'+new_counter+'" onblur="capitialize(\'present_address_'+new_counter+'\')" class="text-input-big" id="present_address_'+new_counter+'" style="height:40px !important;width:90%">'+json.results['REL_ADDR1']+'</textarea></td>';
							// 	html_string += '<td><textarea name="permanent_address_'+new_counter+'" onblur="capitialize(\'permanent_address_'+new_counter+'\')" class="text-input-big" id="permanent_address_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
							// 	html_string += '<td><textarea name="business_address_'+new_counter+'" onblur="capitialize(\'business_address_'+new_counter+'\')" class="text-input-big" id="business_address_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
							// 	html_string += '<td><div id="guar_sts_'+new_counter+'" name="guar_sts_'+new_counter+'" style="padding-left: 3px"></div></td>';
							// 	html_string += '<td><div id="occ_sts_'+new_counter+'" name="occ_sts_'+new_counter+'" style="padding-left: 3px"></div></td>';
							// 	html_string += '</tr>';

							// 	jQuery('#guarantor_info_' +(new_counter-1)).after(html_string);
							// 	jQuery('#guarantor_type_'+new_counter).jqxComboBox({theme: theme, width: 100, autoOpen: false, autoDropDownHeight: false, promptText: "Type", source: guar_type, height: 25});
							// 	jQuery('#guarantor_type_'+new_counter).focusout(function() {
							// 				commbobox_check(jQuery(this).attr('id'));
							// 	});
							// 	jQuery('#guarantor_type_'+new_counter).jqxComboBox('val','R');
							// 	jQuery('#guar_sts_'+new_counter).jqxComboBox({theme: theme, width: 100, autoOpen: false, autoDropDownHeight: false, promptText: "Status", source: guar_sts, height: 25});
							// 	jQuery('#guar_sts_'+new_counter).focusout(function() {
							// 				commbobox_check(jQuery(this).attr('id'));
							// 	});
							// 	jQuery('#occ_sts_'+new_counter).jqxComboBox({theme: theme, width: 140, autoOpen: false, autoDropDownHeight: false, promptText: "Occupation", source: occ_sts, height: 25});
							// 	jQuery('#occ_sts_'+new_counter).focusout(function() {
							// 				commbobox_check(jQuery(this).attr('id'));
							// 	});
							// 	jQuery('#guarantor_info_counter').val(new_counter);
							// }
							new_counter++;
						}
						jQuery("#loan_segment").jqxComboBox('val', 'R');
						if (json.results['MOTHER_NAME'] != '') {
							jQuery("#spfm").show();
							jQuery("#mother_name").val(name_filter(json.results['MOTHER_NAME'].trimEnd()));
							jQuery("#spouse_name").val(name_filter(json.results['SPOUSE_NAME'].trimEnd()));
						}
						if (typeof json['facility_info'] === 'object' && json['facility_info'] != null) {
							var size = Object.keys(json['facility_info']).length;
						} else {
							var siz = 0;
						}
						if (size > 0) {
							var html = '';
							jQuery("#card_facility_body").html('');

							for (var i = 1; i <= size; i++) {
								var counter = i;
								var disbursement_date = api_date_format(json['facility_info'][i]['loanOpeningDate'][0]);
								var expire_date = api_date_format(json['facility_info'][i]['loanOpeningDate'][0]);
								html += '<tr>';
								html += '<td align="center"><input type="hidden" id="ac_number_' + counter + '" value="' + json['facility_info'][i]['accountNumber'][0] + '" name="ac_number_' + counter + '">' + json['facility_info'][i]['accountNumber'][0] + '</td>';
								html += '<td align="center"><input type="hidden" id="disbursement_date_' + counter + '" value="' + disbursement_date + '" name="disbursement_date_' + counter + '">' + disbursement_date + '</td>';
								html += '<td align="center"><input type="hidden" id="expire_date_' + counter + '" value="' + expire_date + '" name="expire_date_' + counter + '">' + expire_date + '</td>';
								html += '<td align="center"><input type="hidden" id="disbursed_amount_' + counter + '" value="' + json['facility_info'][i]['installmentAmount'][0] + '" name="disbursed_amount_' + counter + '">' + json['facility_info'][i]['installmentAmount'][0] + '</td>';
								html += '</tr>';
							}
							jQuery("#card_facility_body").html(html);
							jQuery('#card_facility_counter').val(counter);
							jQuery("#card_facility_row").show();
							jQuery("#loan_facility_row").hide();
						} else {
							jQuery("#card_facility_row").hide();
							jQuery("#loan_facility_row").hide();
						}
						jQuery("#loading-overlay").hide();
					} else {
						jQuery("#hidden_loan_ac").val('');
						jQuery("#hidden_customer_id").val('');
						jQuery("#loan_ac").val('');
						jQuery("#loading-overlay").hide();
						alert("No Data Please try again..")
					}

				} else {
					if (json.Message == 'ok') {
						if (json.loan_segment) {
							var loan_segment = obj_cleaner_for_api_data(json.loan_segment);

						} else {
							var loan_segment = '';
						}
						if (json.mother_name) {
							var mother_name = obj_cleaner_for_api_data(json.mother_name);

						} else {
							var mother_name = '';
						}
						if (json.spouse_name) {
							var spouse_name = obj_cleaner_for_api_data(json.spouse_name);

						} else {
							var spouse_name = '';
						}
						if (loan_segment == 'R') {
							jQuery("#sub_type").val(3);
							jQuery("#spfm").show();
							jQuery("#mother_name").val(mother_name);
							jQuery("#spouse_name").val(spouse_name);
						}
						if (json.business_type) {
							var business_type = obj_cleaner_for_api_data(json.business_type);

						} else {
							var business_type = '';
						}

						if (loan_segment != 'R') {
							if (json.borrower_name) {
								var borrower_name = obj_cleaner_for_api_data(json.borrower_name);

							} else {
								var borrower_name = '';
							}
							jQuery("#brrower_name").val(borrower_name); //Set borrower name for Cor
							document.getElementById('borrower_name_div').style.display = '';
							if (business_type != '' && business_type == 'PROP') {
								jQuery("#sub_type").val(1); //compant
							} else if (business_type != '') {
								jQuery("#sub_type").val(2); //propotorship
							}
							jQuery("#spfm").hide();
						}
						jQuery("#loan_segment").jqxComboBox('val', loan_segment);
						//Guarantor Details
						if (typeof json['guar_details'] === 'object' && json['guar_details'] != null) {
							var size = Object.keys(json['guar_details']).length;
						} else {
							var siz = 0;
						}

						if (size > 0) {
							jQuery('#guarantor_info_body').html('');
							var theme = getDemoTheme();
							var counter = 0;
							for (var i = 1; i <= size; i++) {
								//console.log(json['guar_details'][i]['ac_no']);
								var new_counter = i;
								if (json['guar_details'][i]['type']) {
									var type = obj_cleaner_for_api_data(json['guar_details'][i]['type']);

								} else {
									var type = '';
								}
								if (json['guar_details'][i]['name']) {
									var name = name_filter(obj_cleaner_for_api_data(json['guar_details'][i]['name']));

								} else {
									var name = '';
								}
								if (json['guar_details'][i]['ac_no']) {
									var ac_no = obj_cleaner_for_api_data(json['guar_details'][i]['ac_no']);

								} else {
									var ac_no = '';
								}
								if (json['guar_details'][i]['father_name']) {
									var father_name = name_filter(obj_cleaner_for_api_data(json['guar_details'][i]['father_name']));

								} else {
									var father_name = '';
								}
								if (json['guar_details'][i]['present_address']) {
									var present_address = address_filter(obj_cleaner_for_api_data(json['guar_details'][i]['present_address']));

								} else {
									var present_address = '';
								}
								if (json['guar_details'][i]['permanent_address']) {
									var permanent_address = address_filter(obj_cleaner_for_api_data(json['guar_details'][i]['permanent_address']));

								} else {
									var permanent_address = '';
								}
								if (json['guar_details'][i]['business_address']) {
									var business_address = address_filter(obj_cleaner_for_api_data(json['guar_details'][i]['business_address']));

								} else {
									var business_address = '';
								}
								if (json['guar_details'][i]['Occupation']) {
									var Occupation = obj_cleaner_for_api_data(json['guar_details'][i]['Occupation']);

								} else {
									var Occupation = '';
								}
								html_string = '';
								html_string += '<tr id="guarantor_info_' + new_counter + '">';
								html_string += '<td>';
								html_string += '<input type="hidden" id="guarantor_info_edit_' + new_counter + '" name="guarantor_info_edit_' + new_counter + '" value="0">';
								html_string += '<input type="hidden" id="guarantor_info_delete_' + new_counter + '" name="guarantor_info_delete_' + new_counter + '" value="0">';
								html_string += '<input type="hidden" id="same_address_permission_' + new_counter + '" name="same_address_permission_' + new_counter + '" value="">';
								html_string += '<input type="hidden" id="ac_no_' + new_counter + '" name="ac_no_' + new_counter + '" value="' + ac_no + '">';
								if (i > 1) {
									html_string += '<img src="<?= base_url() ?>images/delete-New.png" onclick="delete_row_guarantor(' + new_counter + ')" style="margin-top: 5px;" style="cursor:pointer;">';
								}
								html_string += '</td>';
								html_string += '<td><div id="guarantor_type_' + new_counter + '" name="guarantor_type_' + new_counter + '" style="padding-left: 3px;" ></div></td>';
								html_string += '<td><input name="guarantor_name_' + new_counter + '" onblur="capitialize(\'guarantor_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="guarantor_name_' + new_counter + '" value="' + name + '"/></td>';
								html_string += '<td><input name="father_name_' + new_counter + '" onblur="capitialize(\'father_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="father_name_' + new_counter + '" value="' + father_name + '"/></td>';
								html_string += '<td><textarea name="present_address_' + new_counter + '" onblur="capitialize(\'present_address_' + new_counter + '\')" class="text-input-big" id="present_address_' + new_counter + '" style="height:40px !important;width:90%">' + present_address.replace(/\s\s+/g, ' ') + '</textarea></td>';
								html_string += '<td><textarea name="permanent_address_' + new_counter + '" onblur="capitialize(\'permanent_address_' + new_counter + '\')" class="text-input-big" id="permanent_address_' + new_counter + '" style="height:40px !important;width:90%">' + permanent_address.replace(/\s\s+/g, ' ') + '</textarea></td>';
								html_string += '<td><textarea name="business_address_' + new_counter + '" onblur="capitialize(\'business_address_' + new_counter + '\')" class="text-input-big" id="business_address_' + new_counter + '" style="height:40px !important;width:90%">' + business_address.replace(/\s\s+/g, ' ') + '</textarea></td>';
								html_string += '<td><div id="guar_sts_' + new_counter + '" name="guar_sts_' + new_counter + '" style="padding-left: 3px;"></div></td>';
								html_string += '<td><div id="occ_sts_' + new_counter + '" name="occ_sts_' + new_counter + '" style="padding-left: 3px;"></div></td>';
								html_string += '</tr>';
								if (i == 1) {
									//alert(html_string);
									jQuery('#guarantor_info_body').html(html_string);
									counter++;
								} else {
									jQuery('#guarantor_info_' + counter).after(html_string);
									counter++;
								}
								jQuery('#guarantor_info_counter').val(new_counter);

								jQuery('#guarantor_type_' + new_counter).jqxComboBox({
									theme: theme,
									width: 100,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Type",
									source: guar_type,
									height: 25
								});
								jQuery('#guarantor_type_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								jQuery('#guarantor_type_' + new_counter).jqxComboBox('val', type);
								jQuery('#guar_sts_' + new_counter).jqxComboBox({
									theme: theme,
									width: 100,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Status",
									source: guar_sts,
									height: 25
								});
								jQuery('#guar_sts_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								jQuery('#occ_sts_' + new_counter).jqxComboBox({
									theme: theme,
									width: 140,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "Occupation",
									source: occ_sts,
									height: 25
								});
								jQuery('#occ_sts_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								jQuery('#occ_sts_' + new_counter).jqxComboBox('val', Occupation);
							}
						}
						if (json.ac_name) {
							var ac_name = obj_cleaner_for_api_data(json.ac_name);

						} else {
							var ac_name = '';
						}
						if (json.sol) {
							var sol = obj_cleaner_for_api_data(json.sol);

						} else {
							var sol = '';
						}
						jQuery("#branch_sol").jqxComboBox('selectItem', sol);
						if (json.mobileNo) {
							var mobileNo = obj_cleaner_for_api_data(json.mobileNo);

						} else {
							var mobileNo = '';
						}
						jQuery("#ac_name").val(ac_name);
						if (loan_segment == 'R') {
							jQuery("#brrower_name").val(ac_name);
						}
						jQuery("#mobile_no").val(mobileNo);
						//Facility Details
						var size = Object.keys(json['facility_info']).length;
						var counter = 0;
						if (size > 0) {

							jQuery('#loan_facility_info_body').html('');
							for (var i = 1; i <= size; i++) {
								var html_string = '';
								var facility_type = obj_cleaner_for_api_data(json['facility_info'][i]['facilit_type']);
								//console.log(json['facility_info'][i]['ac_name']);
								if (json['facility_info'][i]['ac_name']) {
									var ac_name = obj_cleaner_for_api_data(json['facility_info'][i]['ac_name']);

								} else {
									var ac_name = '';
								}
								//console.log(ac_name);
								//var ac_name=json['facility_info'][i]['ac_name'][0];
								var sch_desc = obj_cleaner_for_api_data(json['facility_info'][i]['schmDesc']);
								var dis_amt = obj_cleaner_for_api_data(json['facility_info'][i]['dis_amt']);
								var dis_date = api_date_format_x_time(obj_cleaner_for_api_data(json['facility_info'][i]['dis_date']));
								var lastAnyTrnDate = api_date_format_x_time(obj_cleaner_for_api_data(json['facility_info'][i]['lastAnyTrnDate']));
								var size2 = Object.keys(json['facility_info'][i]['details']).length;
								for (var j = 1; j <= size2; j++) {
									var ac_number = obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['accountNumber']);
									//var loanOpeningDate = api_date_format(json['facility_info'][i]['details'][j]['loanOpeningDate'][0]);
									var expiryDate = api_date_format(obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['expiryDate']));
									var totalLimit = obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['totalLimit']);
									if (json['facility_info'][i]['details'][j]['numberOfRemainingInstallments']) {
										var numberOfRemainingInstallments = obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['numberOfRemainingInstallments']);

									} else {
										var numberOfRemainingInstallments = '';
									}
									if (json['facility_info'][i]['details'][j]['oustandingAmount']) {
										var oustandingAmount = obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['oustandingAmount']);

									} else {
										var oustandingAmount = '';
									}
									if (json['facility_info'][i]['details'][j]['overdueAmount']) {
										var overdueAmount = obj_cleaner_for_api_data(json['facility_info'][i]['details'][j]['overdueAmount']);

									} else {
										var overdueAmount = '';
									}
									if (numberOfRemainingInstallments == undefined) {
										numberOfRemainingInstallments = '';
									}
									if (expiryDate == undefined) {
										expiryDate = '';
									}
									if (oustandingAmount == undefined) {
										oustandingAmount = '';
									}
									if (overdueAmount == undefined) {
										overdueAmount = '';
									}
									//var numberOfRemainingInstallments = json['facility_info'][i]['details'][j]['numberOfRemainingInstallments'][0];
									//var remainingInterestAmount = json['facility_info'][i]['details'][j]['remainingInterestAmount'][0];
									//var oustandingAmount = json['facility_info'][i]['details'][j]['oustandingAmount'][0];
									//var overdueAmount = json['facility_info'][i]['details'][j]['overdueAmount'][0];
								}
								var new_counter = i;
								html_string += '<tr id="facility_info_' + new_counter + '">';
								html_string += '<td>';
								if (loan_ac == ac_number) //Checking the main loan acoount
								{
									html_string += '<input type="hidden" id="base_facility_' + new_counter + '" name="base_facility_' + new_counter + '" value="1">';
								} else {
									html_string += '<input type="hidden" id="base_facility_' + new_counter + '" name="base_facility_' + new_counter + '" value="0">';
								}
								html_string += '<input type="hidden" id="facility_info_edit_' + new_counter + '" name="facility_info_edit_' + new_counter + '" value="0">';
								html_string += '<input type="hidden" id="facility_info_delete_' + new_counter + '" name="facility_info_delete_' + new_counter + '" value="1">';
								html_string += '<input type="hidden" id="api_new_' + new_counter + '" name="api_new_' + new_counter + '" value="0">';
								//checked="checked"
								html_string += '<input type="checkbox" name="chkBoxSelect' + new_counter + '"  id="chkBoxSelect' + new_counter + '" onClick="CheckChanged_2(this,' + new_counter + ')" value="chk"/>';
								html_string += '</td>';
								html_string += '<td style="text-align:center"><input name="facility_type_' + new_counter + '" type="hidden" class="" style="width:90%" id="facility_type_' + new_counter + '" value="' + facility_type + '"/>' + facility_type + '</td>';
								html_string += '<td style="text-align:center"><input name="ac_number_' + new_counter + '" type="hidden" class="" style="width:90%" id="ac_number_' + new_counter + '" value="' + ac_number + '"/>' + ac_number + '</td>';
								html_string += '<td style="text-align:center"><input name="ac_name_' + new_counter + '" type="hidden" class="" style="width:90%" id="ac_name_' + new_counter + '" value="' + ac_name + '"/>' + ac_name + '</td>';
								html_string += '<td style="text-align:center"><input name="sch_desc_' + new_counter + '" type="hidden" class="" style="width:90%" id="sch_desc_' + new_counter + '" value="' + sch_desc + '"/>' + sch_desc + '</td>';
								html_string += '<td style="text-align:center"><input name="disbursement_date_' + new_counter + '" type="text" class="" style="width:90%" id="disbursement_date_' + new_counter + '" value="' + dis_date + '" /></td>';
								html_string += '<td style="text-align:center"><input name="disbursed_amount_' + new_counter + '" type="text" class="" style="width:90%" id="disbursed_amount_' + new_counter + '" value="' + dis_amt + '"/></td>';
								html_string += '<td style="text-align:center"><input name="expire_date_' + new_counter + '" type="text" class="" style="width:90%" id="expire_date_' + new_counter + '" value="' + expiryDate + '" /></td>';
								html_string += '<td style="text-align:center"><input name="due_installments_' + new_counter + '" type="text" class="" style="width:90%" id="due_installments_' + new_counter + '" value="' + numberOfRemainingInstallments + '"/></td>';
								html_string += '<td style="text-align:center"><input name="payble_' + new_counter + '" type="text" class="" style="width:90%" id="payble_' + new_counter + '" value=""/></td>';
								html_string += '<td style="text-align:center"><input name="repayment_' + new_counter + '" type="text" class="" style="width:90%" id="repayment_' + new_counter + '" value=""/></td>';
								html_string += '<td style="text-align:center"><input name="outstanding_bl_' + new_counter + '" type="text" class="" style="width:90%" id="outstanding_bl_' + new_counter + '" value="' + oustandingAmount + '"/></td>';
								html_string += '<td style="text-align:center"><input name="outstanding_bl_dt_' + new_counter + '" type="text" class="" style="width:90%" id="outstanding_bl_dt_' + new_counter + '" value="' + lastAnyTrnDate + '"/></td>';
								html_string += '<td style="text-align:center"><input name="overdue_bl_' + new_counter + '" type="text" class="" style="width:90%" id="overdue_bl_' + new_counter + '" value="' + overdueAmount + '"/></td>';
								html_string += '<td style="text-align:center"><input name="overdue_bl_dt_' + new_counter + '" type="text" class="" style="width:90%" id="overdue_bl_dt_' + new_counter + '" value=""/></td>';
								html_string += '<td style="text-align:center"><input name="call_up_dt_' + new_counter + '" type="text" class="" style="width:90%" id="call_up_dt_' + new_counter + '" value=""/></td>';
								html_string += '<td style="text-align:center"><div id="cl_bb_' + new_counter + '" name="cl_bb_' + new_counter + '" style="padding-left: 3px;"></div></td>';
								html_string += '<td style="text-align:center"><div id="cl_bbl_' + new_counter + '" name="cl_bbl_' + new_counter + '" style="padding-left: 3px;"></div></td>';
								html_string += '</tr>';
								if (i == 1) {
									//alert(html_string);
									jQuery('#loan_facility_info_body').html(html_string);
									counter++;
								} else {
									//alert(html_string);
									jQuery('#facility_info_' + counter).after(html_string);
									counter++;
								}
								jQuery('#cl_bb_' + new_counter).jqxComboBox({
									theme: theme,
									width: 60,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "CL",
									source: cl,
									height: 25
								});
								jQuery('#cl_bbl_' + new_counter).jqxComboBox({
									theme: theme,
									width: 60,
									autoOpen: false,
									autoDropDownHeight: false,
									promptText: "CL",
									source: cl,
									height: 25
								});
								jQuery('#cl_bb_' + new_counter + ',#cl_bbl_' + new_counter).focusout(function() {
									commbobox_check(jQuery(this).attr('id'));
								});
								datePicker('disbursement_date_' + new_counter);
								datePicker('expire_date_' + new_counter);
								datePicker('outstanding_bl_dt_' + new_counter);
								datePicker('overdue_bl_dt_' + new_counter);
								datePicker('call_up_dt_' + new_counter);

								html_string = '';
							}
							jQuery('#facility_info_counter').val(new_counter);
							jQuery("#card_facility_row").hide();
							jQuery("#loan_facility_row").show();
						} else {
							jQuery("#card_facility_row").hide();
							jQuery("#loan_facility_row").show();
							jQuery('#loan_facility_info_body').html('');
							jQuery('#facility_info_counter').val(0);
						}
						jQuery("#loading-overlay").hide();
					} else {
						jQuery('#facility_info_counter').val(0);
						jQuery('#loan_facility_info_body').html('');
						jQuery("#loading-overlay").hide();
						alert("No Data Please try again..")
					}
				}
			}
		});
	}

	function change_dropdown(operation, edit = null) {
		var id = '';
		//check for add Region action
		if (edit == null) {
			id = jQuery("#" + operation).val();
		} else {
			id = edit;
		}
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			url: '<?php echo base_url(); ?>index.php/user_info/get_dropdown_data_ln_cma',
			async: false,
			type: "post",
			data: {
				[csrfName]: csrfHash,
				id: id,
				operation: operation
			},
			datatype: "json",
			success: function(response) {
				var json = jQuery.parseJSON(response);
				//console.log(json['row_info']);
				jQuery('.txt_csrfname').val(json.csrf_token);
				var str = '';
				var theme = getDemoTheme();
				if (operation == 'region') {
					//alert('str');
					var territory = [];
					jQuery.each(json['row_info'], function(key, obj) {
						territory.push({
							value: obj.id,
							label: obj.name
						});
						//alert(obj.name);
					});
					jQuery("#territory").jqxComboBox({
						theme: theme,
						autoDropDownHeight: false,
						promptText: "Select territory",
						source: territory,
						width: 250,
						height: 25
					});
					//For edit action
					if (edit != null) {
						//alert('success');
						jQuery("#territory").jqxComboBox('val', '<?= (isset($result->territory) && $result->territory != 0) ? $result->territory : '' ?>');
					}
				}
				if (operation == 'territory') {
					var district = [];
					jQuery.each(json['row_info'], function(key, obj) {
						district.push({
							value: obj.id,
							label: obj.name
						});
					});
					jQuery("#district").jqxComboBox({
						theme: theme,
						autoDropDownHeight: false,
						promptText: "Select District",
						source: district,
						width: 250,
						height: 25
					});
					//For edit action
					if (edit != null) {
						jQuery("#district").jqxComboBox('val', '<?= (isset($result->district) && $result->district != 0) ? $result->district : '' ?>');
					}
				}
				if (operation == 'district') {
					var unit_office = [];
					jQuery.each(json['row_info'], function(key, obj) {
						unit_office.push({
							value: obj.id,
							label: obj.name
						});

					});
					jQuery("#unit_office").jqxComboBox({
						theme: theme,
						autoDropDownHeight: false,
						promptText: "Select Unit Office",
						source: unit_office,
						width: 250,
						height: 25
					});
					//For edit action
					if (edit != null) {
						jQuery("#unit_office").jqxComboBox('val', '<?= (isset($result->unit_office) && $result->unit_office != 0) ? $result->unit_office : '' ?>');
					}
				}

			},
			error: function(model, xhr, options) {
				alert('failed');
			},
		});

		return false;
	}

	function add_more_owner() {
		var theme = getDemoTheme();
		<? if ($add_edit == 'add') { ?>
			var counter = jQuery('#guarantor_info_counter').val();
		<? } ?>
		<? if ($add_edit == 'edit') { ?>
			var counter = jQuery('#guarantor_info_counter_edit').val();
		<? } ?>
		var new_counter = parseInt(counter) + 1;
		html_string = '';

		html_string += '<tr id="guarantor_info_' + new_counter + '">';
		html_string += '<td>';
		html_string += '<input type="hidden" id="guarantor_info_edit_' + new_counter + '" name="guarantor_info_edit_' + new_counter + '" value="0">';
		html_string += '<input type="hidden" id="guarantor_info_delete_' + new_counter + '" name="guarantor_info_delete_' + new_counter + '" value="0">';
		html_string += '<input type="hidden" id="same_address_permission_' + new_counter + '" name="same_address_permission_' + new_counter + '" value="">';
		html_string += '<input type="hidden" id="ac_no_' + new_counter + '" name="ac_no_' + new_counter + '" value="">';
		html_string += '<img src="<?= base_url() ?>images/delete-New.png" onclick="delete_row_guarantor(' + new_counter + ')" style="margin-top: 5px;cursor:pointer;">';
		html_string += '</td>';
		html_string += '<td><div id="guarantor_type_' + new_counter + '" name="guarantor_type_' + new_counter + '" style="padding-left: 3px;" ></div></td>';
		html_string += '<td><input name="guarantor_name_' + new_counter + '" onblur="capitialize(\'guarantor_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="guarantor_name_' + new_counter + '" /></td>';
		html_string += '<td><input name="father_name_' + new_counter + '" onblur="capitialize(\'father_name_' + new_counter + '\')" type="text" class="" style="width:90%" id="father_name_' + new_counter + '" /></td>';
		html_string += '<td><textarea name="present_address_' + new_counter + '" onblur="capitialize(\'present_address_' + new_counter + '\')" class="text-input-big" id="present_address_' + new_counter + '" style="height:40px !important;width:90%"></textarea></td>';
		html_string += '<td><textarea name="permanent_address_' + new_counter + '" onblur="capitialize(\'permanent_address_' + new_counter + '\')" class="text-input-big" id="permanent_address_' + new_counter + '" style="height:40px !important;width:90%"></textarea></td>';
		html_string += '<td><textarea name="business_address_' + new_counter + '" onblur="capitialize(\'business_address_' + new_counter + '\')" class="text-input-big" id="business_address_' + new_counter + '" style="height:40px !important;width:90%"></textarea></td>';
		html_string += '<td><div id="guar_sts_' + new_counter + '" name="guar_sts_' + new_counter + '" style="padding-left: 3px;"></div></td>';
		html_string += '<td><div id="occ_sts_' + new_counter + '" name="occ_sts_' + new_counter + '" style="padding-left: 3px;"></div></td>';
		html_string += '</tr>';

		jQuery('#guarantor_info_' + counter).after(html_string);
		<? if ($add_edit == 'add') { ?>
			jQuery('#guarantor_info_counter').val(new_counter);
		<? } ?>
		<? if ($add_edit == 'edit') { ?>
			jQuery('#guarantor_info_counter_edit').val(new_counter);
		<? } ?>

		jQuery('#guarantor_type_' + new_counter).jqxComboBox({
			theme: theme,
			width: 100,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Type",
			source: guar_type,
			height: 25
		});
		jQuery('#guarantor_type_' + new_counter).focusout(function() {
			commbobox_check(jQuery(this).attr('id'));
		});
		jQuery('#guar_sts_' + new_counter).jqxComboBox({
			theme: theme,
			width: 100,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Status",
			source: guar_sts,
			height: 25
		});
		jQuery('#guar_sts_' + new_counter).focusout(function() {
			commbobox_check(jQuery(this).attr('id'));
		});
		jQuery('#occ_sts_' + new_counter).jqxComboBox({
			theme: theme,
			width: 140,
			autoOpen: false,
			autoDropDownHeight: false,
			promptText: "Occupation",
			source: occ_sts,
			height: 25
		});
		jQuery('#occ_sts_' + new_counter).focusout(function() {
			commbobox_check(jQuery(this).attr('id'));
		});

	}

	function delete_row_guarantor(row_id) {
		jQuery('#guarantor_info_' + row_id).hide();
		jQuery('#guarantor_info_delete_' + row_id).val(1);
	}

	function owner_validation() {
		if (jQuery("#more_acc_available").val() != 0) {
			if (jQuery("#more_acc_number").val().length < 16) {
				alert('Account number must be 16 Digit');
				jQuery("#more_acc_number").focus();
				return false;
			} else if (jQuery("#more_acc_number").val().length > 16) {
				var myArr = jQuery("#more_acc_number").val().split(",");
				//alert(myArr);
				if (myArr.length == 0) {
					alert('Account number must be Comma Separated');
					jQuery("#more_acc_number").focus();
					return false;
				} else {
					for (var i = 0; i < myArr.length; i++) {
						var acc = myArr[i];
						if (acc.length < 16 || acc.length > 16) {
							alert('Account number must be 16 Digits');
							jQuery("#more_acc_number").focus();
							return false;
						}
					}
				}
			}
		}
		var counter = 0;
		<? if ($add_edit == 'add') { ?>
			var total_row = jQuery('#guarantor_info_counter').val();
		<? } ?>
		<? if ($add_edit == 'edit') { ?>
			var total_row = jQuery('#guarantor_info_counter_edit').val();
		<? } ?>
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
		//for loan owner validation
		var borrower_check = 0;
		if (item.value == 'Loan') {
			for (i = 1; i <= total_row; i++) {
				if (jQuery('#guarantor_info_delete_' + i).val() == 0) {
					var item = jQuery("#guarantor_type_" + i).jqxComboBox('getSelectedItem');
					var item2 = jQuery("#guar_sts_" + i).jqxComboBox('getSelectedItem');
					var item3 = jQuery("#occ_sts_" + i).jqxComboBox('getSelectedItem');
					//alert(item.value);
					if (!item) {
						alert('Guarantor Type Required');
						jQuery('#guarantor_type_' + i + ' input').focus();
						return false;
					} else {
						if (item.value == 'M') {
							borrower_check = 1;
						}
					}
					if (jQuery.trim(jQuery('#guarantor_name_' + i).val()) == '') {
						alert('Guarantor Name Required');
						jQuery('#guarantor_name_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#present_address_' + i).val()) == '') {
						alert('Present Address Required');
						jQuery('#present_address_' + i).focus();
						return false;
					}
					if (jQuery.trim(jQuery('#present_address_' + i).val()) == jQuery.trim(jQuery('#permanent_address_' + i).val()) && jQuery("#same_address_permission_" + i).val() == '') {
						return show_confrimation_pop_up('Continue', i);
					}
					if (!item2) {
						alert('Guarantor Sts Required');
						jQuery('#guar_sts_' + i + ' input').focus();
						//jQuery('#guar_sts_'+i).focus();
						return false;
					}
					if (!item3) {
						alert('Guarantor Occupation  Required');
						jQuery('#occ_sts_' + i + ' input').focus();
						//jQuery('#occ_sts_'+i).focus();
						return false;
					}
				}
			}
			if (borrower_check == 0) {
				alert('Borrower Needed');
				return false;
			};
		}
		//For Card owner validation
		else {
			for (i = 1; i <= total_row; i++) {
				if (jQuery('#guarantor_info_delete_' + i).val() == 0) {
					var item = jQuery("#guarantor_type_" + i).jqxComboBox('getSelectedItem');
					if (!item) {
						alert('Guarantor Type Required');
						//jQuery('#guarantor_type_'+i).focus();
						jQuery('#guarantor_type_' + i + ' input').focus();
						return false;
					} else {
						if (item.value == 'M') {
							borrower_check = 1;
						}
					}
					if (jQuery.trim(jQuery('#guarantor_name_' + i).val()) == '') {
						alert('Guarantor Name Required');
						jQuery('#guarantor_name_' + i).focus();
						return false;
					}
				}
			}
			if (borrower_check == 0) {
				alert('Borrower Needed');
				return false;
			};
		}

		return true;
	}

	function change_caption() {
		jQuery("#show_customer_id").html('<?= isset($result->customer_id) ? $result->customer_id : '' ?>');
		if (jQuery("#proposed_type").val() == '') {
			document.getElementById("loan_ac").disabled = true;
			jQuery("#l_or_c_name").html('Loan A/C Name or Name on Card');
			jQuery("#l_or_c_no").html('Loan A/C or Card');
			document.getElementById('borrower_name_div').style.display = '';
			jQuery("#guar_tag").html('');
			document.getElementById('customer_id_row').style.display = 'none';

		} else {
			document.getElementById("loan_ac").disabled = false;
			var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
			if (item.value == 'Loan') {
				jQuery("#l_or_c_name").html('Loan A/C Name');
				jQuery("#l_or_c_no").html('Loan A/C ');
				document.getElementById('borrower_name_div').style.display = '';
				jQuery("#guar_tag").html('Borrower/Guarantor/Company Director/Owner');
				document.getElementById('customer_id_row').style.display = 'none';
			} else if (item.value == 'Card') {
				document.getElementById('borrower_name_div').style.display = 'none';
				jQuery("#l_or_c_name").html('Name on Card');
				jQuery("#l_or_c_no").html('Card');
				jQuery("#guar_tag").html('Borrower/Reference');
				document.getElementById('customer_id_row').style.display = '';
			}
		}
		<? if ($add_edit == 'edit') { ?>
			document.getElementById("loan_ac").disabled = true;
		<? } ?>

	}

	function change_brunch() {
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');

		if (item.value == 'Loan') {
			if (jQuery("#loan_ac").val().length == 16) {
				var c_no = jQuery("#loan_ac").val().slice(0, 4);
				var cif = jQuery("#loan_ac").val().slice(5, 13);
				jQuery("#branch_sol").jqxComboBox('selectItem', c_no);
				jQuery("#cif").val(cif);
			}
			else if (jQuery("#loan_ac").val().length == 13) {
				var cif = jQuery("#loan_ac").val().slice(1, 9);
				jQuery("#cif").val(cif);
			}
		}

	}

	function mask(str, textbox) {
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
		if (item.value == 'Card') {
			if (!str.includes("*") && str.length == 16) //For one time value paste
			{
				var length = str.length;
				var first_6 = str.slice(0, 6);
				var mid = '******';
				var last_6 = str.slice(12, 16);
				var final_str = first_6 + mid + last_6;
				textbox.value = final_str
				jQuery("#hidden_loan_ac").val(str);
			} else //For single value enter
			{
				//For New value
				var orginal_loan_ac = jQuery("#hidden_loan_ac").val();
				if (orginal_loan_ac.length < str.length) {
					var index = str.length - 1;
					var new_val = str.slice(index);
					orginal_loan_ac += new_val;
					jQuery("#hidden_loan_ac").val(orginal_loan_ac);
				}
				//For delete key
				else {
					var len = str.length;
					var new_val = orginal_loan_ac.slice(0, len);
					jQuery("#hidden_loan_ac").val(new_val);
				}
				//For First 6 key
				if (str.length <= 6) {
					textbox.value = str
				}
				//for the last 4 key
				else if (str.length >= 13) {
					textbox.value = str
				}
				//For the middle 4 key
				else {
					var length = str.length;
					var first_6 = str.slice(0, 6);
					var mid = (str.length - 6);
					var final_str = first_6;
					for (var i = 1; i <= mid; i++) {
						final_str += '*';
					}
					textbox.value = final_str
				}

				if (str.length == 16) //wrong input check
				{
					var letter_Count = 0;
					var letter = '*';
					for (var position = 0; position < str.length; position++) {
						if (str.charAt(position) == letter) {
							letter_Count += 1;
						}
					}
					if (letter_Count < 6 || jQuery("#hidden_loan_ac").val().length != 16) {
						textbox.value = '';
						jQuery("#hidden_loan_ac").val('');
						alert('Wrong way to input Card No please try again');
					}
				}
			}
		}

	}

	function file_delete(id) {
		if (confirm('Are you sure to Delete previous file?')) {
			jQuery("#file_preview_" + id).hide();
			jQuery("#file_delete_" + id).hide();
			jQuery("#file_delete_value_" + id).val(1);
		}
	}

	function CustomerPickList(module_name = null, data_field_name = null) {
		<? if ($add_edit == 'edit') { ?>
			if (jQuery("#file_delete_value_" + data_field_name).val() == 0) {
				alert('Please Delete Previous file for new upload');
				return false;
			}
		<? } ?>
		newwindow = window.open("<?= base_url() ?>index.php/home/ajaxFileUpload/" + module_name + '/' + data_field_name, "Upload", "width=550,height=350,resizable=0,scrollbars=0,location=no,menubar=no,toolbar=no,minimizable=no,status=no,top=140,left=340");
		if (window.focus) {
			newwindow.focus()
		}
		return false;
	}

	function show_confrimation_pop_up(operation, index) {
		jQuery("#message").html(operation);
		jQuery("#index").val(index);
		//jQuery("#button_tag").html(operation);
		jQuery("#button_tag").html('OK');
		$('sendToCheckerMessageDialogConfirm').style.display = 'inline';
		$('sendToCheckerMessageDialogCancel').style.display = 'inline';
		$('loadingReturn').style.display = 'none';
		sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {
			position: 'fixed',
			modal: true,
			width: 470,
			close: true,
			id: 'sendToCheckerMessageDialog'
		});
		sendToCheckerMessageDialog.show();
	}

	function give_permission() {
		sendToCheckerMessageDialog.hide();
		var index = jQuery("#index").val();
		//jQuery("#same_address_permission_"+index).val(1);
		jQuery("#same_address_permission_" + index).val('');
		//return true;
		jQuery('#permanent_address_' + index).focus();
		return false;
	}

	function close_window() {
		sendToCheckerMessageDialog.hide();
		var index = jQuery("#index").val();
		jQuery("#same_address_permission_" + index).val('');
		jQuery('#permanent_address_' + index).focus();
		return false;
	}
</script>

<body style="height:94%;">
	<div style="width:100%;margin:0;">
		<div class="form">
			<div class="formHeader" style="background-color:#185891;">1st Legal Notice</div>
		</div>

		<div style="width:96%;margin: auto;paddding: 10px;">
			<div id="loading-overlay">
				<div class="loading-icon"></div>
			</div>
			<form class="form" name="legal_notice_form" id="legal_notice_form" method="post" action="<?= base_url() ?>legal_notice/add_edit_action/<?= $add_edit ?>/<?= $id ?>" enctype="multipart/form-data">
				<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<input type="hidden" id="add_edit" value="<?= $add_edit ?>" name="add_edit">
				<input type="hidden" id="operation" value="<?= $operation ?>" name="operation">
				<input name="life_cycle" type="hidden" id="life_cycle" value="<?= isset($result->life_cycle) ? $result->life_cycle : '0' ?>" class="text-input" />
				<input name="more_acc_available" type="hidden" id="more_acc_available" value="<?= isset($result->more_acc_available) ? $result->more_acc_available : '0' ?>" class="text-input" />
				<input name="sl_no_edit" type="hidden" id="sl_no_edit" value="<?= isset($result->sl_no) ? $result->sl_no : '' ?>" class="text-input" />
				<input type="hidden" id="card_iss_date" value="" name="card_iss_date">
				<input type="hidden" id="card_exp_date" value="" name="card_exp_date">
				<input type="hidden" id="outstanding_bl_dt" value="" name="outstanding_bl_dt">
				<input type="hidden" id="card_limit" value="" name="card_limit">
				<input type="hidden" id="outstanding_bl" value="" name="outstanding_bl">
				<input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
				<input type="hidden" id="hidden_customer_id" value="" name="hidden_customer_id">
				<table style="width:100%;margin-top:20px" id="tab1Table">
					<tbody>
						<tr>
							<td width="50%">
								<table style="width: 100%;">
									<tr>
										<td width="40%" style="font-weight: bold;">Proposed Type<span style="color:red">*</span> </td>
										<td width="60%">
											<div id="proposed_type" name="proposed_type" style="padding-left: 3px" tabindex="1"></div>
										</td>

									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;"><span id="l_or_c_no"></span> No.<span style="color:red">*</span> </td>
										<td width="60%">
											<?php if ($add_edit == 'add') : ?>
												<input name="loan_ac" tabindex="2" type="text" class="" size="16" style="width:195px" id="loan_ac" value="<?= isset($result->loan_ac) ? $result->loan_ac : '' ?>" onKeyUp="javascript:return mask(this.value,this);" onblur="change_brunch()" />
												<input type="button" value="Load" id="load_button" class="buttonclose" style="width:50px !important;height:25px" onclick="validate_api_call()" />
											<?php else : ?>
												<input name="loan_ac" tabindex="2" type="text" class="" maxlength="16" size="16" style="width:250px" id="loan_ac" value="<?= isset($result->loan_ac) ? $result->loan_ac : '' ?>" />
											<?php endif ?>
										</td>
									</tr>
									<tr id="customer_id_row" style="display: none;">
										<td width="40%" style="font-weight: bold;">Customer ID</td>
										<td width="60%"><strong><span id="show_customer_id"></span></strong></td>

									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">CIF<span style="color:red">*</span> </td>
										<td width="60%"><input name="cif" type="text" maxlength="8" size="8" tabindex="3" class="" style="width:250px" id="cif" value="<?= isset($result->cif) ? $result->cif : '' ?>" /></td>

									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Branch (SOL)<span style="color:red">*</span> </td>
										<td width="60%">
											<div id="branch_sol" name="branch_sol" style="padding-left: 3px" tabindex="4"></div>
										</td>
									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;"><span id="l_or_c_name"></span><span style="color:red">*</span> </td>
										<td width="60%"><input name="ac_name" tabindex="5" type="text" class="" style="width:250px" id="ac_name" value="<?= isset($result->ac_name) ? $result->ac_name : '' ?>" /></td>
									</tr>
									<tr id="borrower_name_div">
										<td width="40%" style="font-weight: bold;">Borrower's Name<span style="color:red">*</span></td>
										<td width="60%"><input name="brrower_name" tabindex="6" type="text" class="" onblur="capitialize('brrower_name')" style="width:250px" id="brrower_name" value="<?= isset($result->brrower_name) ? $result->brrower_name : '' ?>" /></td>
									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Business Type<span style="color:red">*</span> </td>
										<td width="60%">
											<div id="sub_type" name="sub_type" style="padding-left: 3px" tabindex="7"></div>
											<div style="background-color:#eaeaea;padding:10px;width:233px;display:none" id="spfm">
												Spouse Name<br /><input name="spouse_name" onblur="capitialize('spouse_name')" tabindex="8" type="text" class="" style="width:225px" id="spouse_name" value="<?= isset($result->spouse_name) ? $result->spouse_name : '' ?>" /><br />
												Mother Name<span style="color:red">*</span><br /><input name="mother_name" onblur="capitialize('mother_name')" tabindex="9" type="text" class="" style="width:225px" id="mother_name" value="<?= isset($result->mother_name) ? $result->mother_name : '' ?>" />
											</div>
										</td>
									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Loan Segment (Portfolio)<span style="color:red">*</span> </td>
										<td width="60%">
											<div id="loan_segment" name="loan_segment" style="padding-left: 3px" tabindex="10"></div>
										</td>
									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Current/updated Address</td>
										<td width="60%"><textarea name="current_address" tabindex="11" class="text-input-big" id="current_address" style="height:40px !important;width:250px" onblur="capitialize('current_address')"><?= isset($result->current_address) ? $result->current_address : '' ?></textarea></td>

									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Previous 1st legal Notice By</td>
										<td width="60%">
											<label id="pre_ln_by" style="color:red">
												<?php if ($add_edit == 'edit') : ?>
													<?= isset($pre_ln_data->pre_ln_by) ? $pre_ln_data->pre_ln_by : 'Not Found' ?>
												<?php endif ?>
											</label>
										</td>
									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Previous 1st legal Notice Date</td>
										<td width="60%">
											<label id="pre_ln_dt_l" style="color:red">
												<?php if ($add_edit == 'edit') : ?>
													<?= isset($result->pre_ln_dt) && $result->pre_ln_dt != '0000-00-00 00:00:00' ? $result->pre_ln_dt : 'Not Found' ?>
												<?php endif ?>
											</label>
											<input name="pre_ln_dt" tabindex="12" type="hidden" class="" style="width:250px" id="pre_ln_dt" value="<?= isset($result->pre_ln_dt) ? $result->pre_ln_dt : '' ?>" />
										</td>
									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Previous 1st Legal Notice</td>
										<td width="60%">
											<label id="pre_ln_file">
												<?php if ($add_edit == 'edit' && !empty($pre_ln_data)) : ?>
													<?php if ($pre_ln_data->legal_notice_sts == 14) : ?>
														<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?= base_url() ?>index.php/legal_notice_ho/download_pdf/<?= $result->pre_ln_id ?>/<?= $pre_ln_data->proposed_type ?>" target="_blank"><img width="20px" height="20px" align="center" src="<?= base_url() ?>images/pdf_icon.gif"></a>
													<?php else : ?>
														Legal Notice Generated
													<?php endif ?>
												<?php else : ?>
													Not Found
												<?php endif ?>
											</label>
											<input type="hidden" tabindex="13" name="pre_ln_id" style="width:225px;margin-left:4px" id="pre_ln_id" value="<?= isset($result->pre_ln_id) ? $result->pre_ln_id : '' ?>">
										</td>
									</tr>
								</table>
							</td>

							<td width="50%">
								<table style="width: 100%;">
									<tr>
										<td width="40%" style="font-weight: bold;">Region<span style="color:red">*</span> </td>
										<td width="60%">
											<div id="region" tabindex="14" name="region" style="padding-left: 3px"></div>
										</td>

									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Territory<span style="color:red">*</span> </td>
										<td width="60%">
											<div id="territory" tabindex="15" name="territory" style="padding-left: 3px"></div>
										</td>

									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">District<span style="color:red">*</span> </td>
										<td width="60%">
											<div id="district" tabindex="16" name="district" style="padding-left: 3px"></div>
										</td>

									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Unit Office<span style="color:red">*</span> </td>
										<td width="60%">
											<div id="unit_office" tabindex="17" name="unit_office" style="padding-left: 3px"></div>
										</td>

									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">More Account</td>
										<td width="60%">
											<div name="more_acc" tabindex="18" id="more_acc" style="float:left; margin: 3px 0px 0 0;"></div><input name="more_acc_number" tabindex="19" style="width:228px" type="text" class="" id="more_acc_number" value="<?= isset($result->more_acc_number) ? $result->more_acc_number : '' ?>" disabled /><br /><span style="color:green;" class="login-text">(Comma Separated)</span>
										</td>
									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Remarks<span style="color:green">(Required For Re-Initiate)</span></td>
										<td width="60%">
											<textarea name="remarks" class="text-input-big" tabindex="20" id="remarks" style="height:40px !important;width:250px"><?= isset($result->remarks) ? $result->remarks : '' ?></textarea>
										</td>
									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Customer Contact Number</td>
										<td width="60%"><input name="mobile_no" tabindex="21" maxlength="11" size="11" type="text" class="" style="width:250px" id="mobile_no" value="<?= isset($result->mobile_no) ? $result->mobile_no : '' ?>" /></td>
									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Call-Up Date<span style="color:red">*</span></td>
										<td><input type="text" name="call_up_dt" tabindex="22" placeholder="dd/mm/yyyy" style="width:250px;" id="call_up_dt" value="<?= isset($result->call_up_dt) && $result->call_up_dt != '0000-00-00 00:00:00' ? date_format(date_create($result->call_up_dt), "d/m/Y") : '' ?>">
											<script type="text/javascript" charset="utf-8">
												datePicker("call_up_dt");
											</script>
										</td>
									</tr>
									<tr>
										<td width="40%" style="font-weight: bold;">Call-Up File</td>
										<td>
											<img style="cursor:pointer" src="<?= base_url() ?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList('ln','call_up_file')" />
											<input type="hidden" id="hidden_call_up_file_select" name="hidden_call_up_file_select" value="0">
											<? if ($add_edit == 'edit' && $result->call_up_file != '') { ?>

												<span id="hidden_call_up_file"><img id="file_preview_call_up_file" onclick="popup('<?= base_url() ?>legal_notice_file/call_up_file/<?= $result->call_up_file ?>')" style=" cursor:pointer;text-align:center" height="18" src="<?= base_url() ?>old_assets/images/print-preview.png"></span>
												<input type="hidden" id="hidden_call_up_file_value" name="hidden_call_up_file_value" value="<?= $result->call_up_file ?>">
												<img id="file_delete_call_up_file" onclick="file_delete('call_up_file')" src="<?= base_url() ?>images/delete-New.png" style=" cursor:pointer;" alt="Delete" title="Delete">
												<input type="hidden" id="file_delete_value_call_up_file" name="file_delete_value_call_up_file" value="0">
											<? } else { ?>
												<span id="hidden_call_up_file"></span>
											<? } ?>
										</td>
									</tr>
								</table>
							</td>

						</tr>
						<tr id="card_facility_row" style="display:none">
							<td colspan="2">
								<fieldset>
									<legend style="font-weight: bold; color: #4197c7;background-color:white">Facility Info For This CIF</legend>
									<div id="repo_width" style="overflow:auto; height:100px; border:1px solid #FF0000;width:100%;overflow:scroll">
										<table border="1" id="gurantor_table" cellspacing="0" cellpadding="2" style="width:100%;">
											<thead>
												<td width="25%" style="font-weight: bold;text-align:center">A/C Number</td>
												<td width="25%" style="font-weight: bold;text-align:center">Disbursement Date</td>
												<td width="25%" style="font-weight: bold;text-align:center">Expire Date</td>
												<td width="25%" style="font-weight: bold;text-align:center">Disbursed Amount</td>
											</thead>
											<tbody id="card_facility_body" style="overflow:auto; min-height::50px; height:auto;">
												<?php if ($add_edit == 'edit') : ?>
													<?php $cot = 1;
													foreach ($card_facility as $key) : ?>
														<tr>
															<td align="center"><?= $key->ac_number; ?></td>
															<td align="center"><?= $key->disbursement_date; ?></td>
															<td align="center"><?= $key->expire_date; ?></td>
															<td align="center"><?= $key->disbursed_amount; ?></td>
														</tr>
													<?php $cot++;
													endforeach ?>
												<?php endif ?>
											</tbody>
											<input type="hidden" id="card_facility_counter" name="card_facility_counter" value="0">
										</table>
									</div>
		</div>
		</fieldset>
		</td>
		</tr>
		<tr>
			<?php if ($add_edit == 'add') : ?>
				<td colspan="2">
					<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
						<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag"></span>
						<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px">
							<thead>
								<input type="hidden" name="guarantor_info_counter" id="guarantor_info_counter" value="1">
								<tr>
									<td width="2%" style="font-weight: bold;text-align:center">D</td>
									<td width="5%" style="font-weight: bold;text-align:center">Type<span style="color:red">*</span></td>
									<td width="13%" style="font-weight: bold;text-align:center">Name<span style="color:red">*</span></td>
									<td width="12%" style="font-weight: bold;text-align:center">Father's Name</td>
									<td width="15%" style="font-weight: bold;text-align:center">Present Address<span style="color:red">*</span></td>
									<td width="15%" style="font-weight: bold;text-align:center">Permanent Address<!-- <span style="color:red">*</span> --></td>
									<td width="15%" style="font-weight: bold;text-align:center">Business Address</td>
									<td width="10%" style="font-weight: bold;text-align:center">Status<span style="color:red">*</span></td>
									<td width="13%" style="font-weight: bold;text-align:center">Occupation<span style="color:red">*</span></td>
								</tr>
							</thead>
							<tbody id="guarantor_info_body">
								<tr id="guarantor_info_1">
									<td></td>
									<td>
										<input type="hidden" id="guarantor_info_delete_1" name="guarantor_info_delete_1" value="0">
										<input type="hidden" id="guarantor_info_edit_1" name="guarantor_info_edit_1" value="0">
										<input type="hidden" id="same_address_permission_1" name="same_address_permission_1" value="">
										<div id="guarantor_type_1" name="guarantor_type_1" style="padding-left: 3px;margin-left:5px"></div>
									</td>
									<td><input name="guarantor_name_1" onblur="capitialize('guarantor_name_1')" type="text" class="" style="width:90%" id="guarantor_name_1" /></td>
									<td><input name="father_name_1" onblur="capitialize('father_name_1')" type="text" class="" style="width:90%" id="father_name_1" /></td>
									<td><textarea name="present_address_1" onblur="capitialize('present_address_1')" class="text-input-big" id="present_address_1" style="height:40px !important;width:90%"></textarea></td>
									<td><textarea name="permanent_address_1" onblur="capitialize('permanent_address_1')" class="text-input-big" id="permanent_address_1" style="height:40px !important;width:90%"></textarea></td>
									<td><textarea name="business_address_1" onblur="capitialize('business_address_1')" class="text-input-big" id="business_address_1" style="height:40px !important;width:90%"></textarea></td>
									<td>
										<div id="guar_sts_1" name="guar_sts_1" style="padding-left: 3px;margin-left:5px"></div>
									</td>
									<td>
										<div id="occ_sts_1" name="occ_sts_1" style="padding-left: 3px;margin-left:5px"></div>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr id="add_guarantor_row">
									<td colspan="9" style="text-align: right">
										Add More <input tabindex="" type="button" title="Add More" onClick="add_more_owner()" class="addmore"><br>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</td>
			<?php else : ?>
				<td colspan="2">
					<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
						<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;" id="guar_tag"></span>
						<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px">
							<tbody>
								<input type="hidden" name="guarantor_info_counter" id="guarantor_info_counter" value="1">
								<tr>
									<td width="2%" style="font-weight: bold;text-align:center">D</td>
									<td width="5%" style="font-weight: bold;text-align:center">Type<span style="color:red">*</span></td>
									<td width="13%" style="font-weight: bold;text-align:center">Name<span style="color:red">*</span></td>
									<td width="12%" style="font-weight: bold;text-align:center">Father Name</td>
									<td width="15%" style="font-weight: bold;text-align:center">Present Address<span style="color:red">*</span></td>
									<td width="15%" style="font-weight: bold;text-align:center">Permanent Address<!-- <span style="color:red">*</span> --></td>
									<td width="15%" style="font-weight: bold;text-align:center">Business Address</td>
									<td width="10%" style="font-weight: bold;text-align:center">Status<span style="color:red">*</span></td>
									<td width="13%" style="font-weight: bold;text-align:center">Occupation<span style="color:red">*</span></td>
								</tr>
								<?php $cot = 1;
								foreach ($legal_notice_guarantor as $key) : ?>

									<tr id="guarantor_info_<?= $cot; ?>">
										<?php if ($cot > 1) : ?>
											<td align="left">
												<img src="<?= base_url() ?>images/delete-New.png" alt="Delete" onclick="delete_row_guarantor(<?= $cot ?>)" style="cursor:pointer;">
											</td>
										<?php else : ?>
											<td align="left">
											</td>
										<?php endif ?>
										<td>
											<input type="hidden" name="guarantor_info_edit_<?= $cot ?>" id="guarantor_info_edit_<?= $cot ?>" value="<?= isset($key->id) ? $key->id : '' ?>" style="width:100px" />
											<input type="hidden" name="guarantor_info_delete_<?= $cot ?>" id="guarantor_info_delete_<?= $cot ?>" value="0" style="width:100px" />
											<input type="hidden" id="same_address_permission_<?= $cot ?>" name="same_address_permission_<?= $cot ?>" value="">
											<div id="guarantor_type_<?= $cot; ?>" name="guarantor_type_<?= $cot; ?>" style="padding-left: 3px;"></div>
											<script>
												var theme = getDemoTheme();
												jQuery("#guarantor_type_<?= $cot; ?>").jqxComboBox({
													theme: theme,
													width: 100,
													autoOpen: false,
													autoDropDownHeight: false,
													promptText: "Guarantor Type",
													source: guar_type,
													height: 25
												});
												jQuery("#guarantor_type_<?= $cot; ?>").jqxComboBox('val', '<?= (isset($key->guarantor_type) && $key->guarantor_type != '') ? $key->guarantor_type : '' ?>');
												jQuery('#guarantor_type_<?= $cot; ?>').focusout(function() {
													commbobox_check(jQuery(this).attr('id'));
												});
											</script>
										</td>
										<td><input name="guarantor_name_<?= $cot; ?>" onblur="capitialize('guarantor_name_<?= $cot; ?>')" type="text" class="" style="width:90%" id="guarantor_name_<?= $cot; ?>" value="<?= isset($key->guarantor_name) ? $key->guarantor_name : '' ?>" /></td>
										<td><input name="father_name_<?= $cot; ?>" onblur="capitialize('father_name_<?= $cot; ?>')" type="text" class="" style="width:90%" id="father_name_<?= $cot; ?>" value="<?= isset($key->father_name) ? $key->father_name : '' ?>" /></td>
										<td><textarea name="present_address_<?= $cot; ?>" onblur="capitialize('present_address_<?= $cot; ?>')" class="text-input-big" id="present_address_<?= $cot; ?>" style="height:40px !important;width:90%"><?= isset($key->present_address) ? $key->present_address : '' ?></textarea></td>
										<td><textarea name="permanent_address_<?= $cot; ?>" onblur="capitialize('permanent_address_<?= $cot; ?>')" class="text-input-big" id="permanent_address_<?= $cot; ?>" style="height:40px !important;width:90%"><?= isset($key->permanent_address) ? $key->permanent_address : '' ?></textarea></td>
										<td><textarea name="business_address_<?= $cot; ?>" onblur="capitialize('business_address_<?= $cot; ?>')" class="text-input-big" id="business_address_<?= $cot; ?>" style="height:40px !important;width:90%"><?= isset($key->business_address) ? $key->business_address : '' ?></textarea></td>
										<td>
											<div id="guar_sts_<?= $cot; ?>" name="guar_sts_<?= $cot; ?>" style="padding-left: 3px;"></div>
											<script>
												var theme = getDemoTheme();
												jQuery("#guar_sts_<?= $cot; ?>").jqxComboBox({
													theme: theme,
													width: 100,
													autoOpen: false,
													autoDropDownHeight: false,
													promptText: "Guarantor Sts",
													source: guar_sts,
													height: 25
												});
												jQuery("#guar_sts_<?= $cot; ?>").jqxComboBox('val', '<?= (isset($key->guar_sts) && $key->guar_sts != 0) ? $key->guar_sts : '' ?>');
												jQuery('#guar_sts_<?= $cot; ?>').focusout(function() {
													commbobox_check(jQuery(this).attr('id'));
												});
											</script>
										</td>
										<td>
											<div id="occ_sts_<?= $cot; ?>" name="occ_sts_<?= $cot; ?>" style="padding-left: 3px;"></div>
											<script>
												var theme = getDemoTheme();
												jQuery("#occ_sts_<?= $cot; ?>").jqxComboBox({
													theme: theme,
													width: 140,
													autoOpen: false,
													autoDropDownHeight: false,
													promptText: "Guarantor Occupation",
													source: occ_sts,
													height: 25
												});
												jQuery("#occ_sts_<?= $cot; ?>").jqxComboBox('val', '<?= (isset($key->occ_sts) && $key->occ_sts != '') ? $key->occ_sts : '' ?>');
												jQuery('#occ_sts_<?= $cot; ?>').focusout(function() {
													commbobox_check(jQuery(this).attr('id'));
												});
											</script>
										</td>
									</tr>
								<?php $cot++;
								endforeach ?>
								<input type="hidden" name="guarantor_info_counter_edit" id="guarantor_info_counter_edit" value="<?= $cot - 1 ?>">
							</tbody>
							<tfoot>
								<tr id="add_guarantor_row">
									<td colspan="9" style="text-align: right">
										Add More <input tabindex="" type="button" title="Add More" onClick="add_more_owner()" class="addmore"><br>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</td>
			<?php endif ?>
		</tr>
		<tr id="loan_facility_row" style="display:none">
			<?php if ($add_edit == 'add') : ?>
				<td colspan="2">
					<div style="background-color:#eaeaea;padding:10px;margin:0 0px;overflow:scroll;padding-top:20px;">
						<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
						<table border="1" id="gurantor_table" style="border-color:#c0c0c0;width:127%;margin:20px">
							<thead>
								<tr>
									<td width="2%" style="font-weight: bold;text-align:center"><input type="checkbox" name="checkAll" id="checkAll" onClick="CheckAll_2(this)" /></td>
									<td width="5%" style="font-weight: bold;text-align:center">Facility Type<span style="color:red">*</span></td>
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
							<tbody id="loan_facility_info_body">

							</tbody>
							<input type="hidden" name="facility_info_counter" id="facility_info_counter" value="0">
							<!-- <tfoot>
		                    				<tr id="add_facility_row">
		                    					<td colspan="15" style="text-align: right">
		                    						Add More <input tabindex="" type="button" title="Add More" onClick="add_more_facility()" class="addmore"><br>
		                    					</td>
		                    				</tr>
		                    			</tfoot> -->
						</table>
					</div>
				</td>
			<?php else : ?>
				<?php if ($result->proposed_type=='Loan'): ?>
					<td colspan="2">
						<div style="background-color:#eaeaea;padding:10px;margin:0 0px;overflow:scroll;padding-top:20px;">
							<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
							<table border="1" id="gurantor_table" style="border-color:#c0c0c0;width:127%;margin:20px">
								<thead>
									<tr>
										<td width="2%" style="font-weight: bold;text-align:center"><input type="checkbox" name="checkAll" id="checkAll" checked="checked" onClick="CheckAll_2(this)" /></td>
										<td width="5%" style="font-weight: bold;text-align:center">Facility Type<span style="color:red">*</span></td>
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
								<tbody id="loan_facility_info_body">
									<?php $cot = 1;
									foreach ($facility_info as $key) : ?>
										<tr id="facility_info_<?= $cot; ?>">
											<?php if ($key->ac_number == $result->loan_ac) : ?>
												<input type="hidden" id="base_facility_<?= $cot; ?>" name="base_facility_<?= $cot; ?>" value="1">
											<?php else : ?>
												<input type="hidden" id="base_facility_<?= $cot; ?>" name="base_facility_<?= $cot; ?>" value="0">
											<?php endif ?>
											<input type="hidden" id="facility_info_delete_<?= $cot; ?>" name="facility_info_delete_<?= $cot; ?>" value="0">
											<input type="hidden" id="facility_info_edit_<?= $cot; ?>" name="facility_info_edit_<?= $cot; ?>" value="<?= $key->id; ?>">
											<input type="hidden" id="api_new_<?= $cot; ?>" name="api_new_<?= $cot; ?>" value="<?= $key->api_new; ?>">

											<td style="text-align:center">
												<input type="checkbox" name="chkBoxSelect<?= $cot; ?>" checked="checked" id="chkBoxSelect<?= $cot; ?>" onClick="CheckChanged_2(this,<?= $cot; ?>)" value="chk" />
											</td>
											<td style="text-align:center">
												<?= isset($key->facility_type) ? $key->facility_type : '' ?>
											</td>
											<td style="text-align:center"><?= isset($key->ac_number) ? $key->ac_number : '' ?></td>
											<td style="text-align:center"><?= isset($key->ac_name) ? $key->ac_name : '' ?></td>
											<td style="text-align:center"><?= isset($key->sch_desc) ? $key->sch_desc : '' ?></td>
											<td style="text-align:center">
												<input class="text" name="disbursement_date_<?= $cot; ?>" id="disbursement_date_<?= $cot; ?>" value="<?= isset($key->disbursement_date) ? date_format(date_create($key->disbursement_date), "d/m/Y") : '' ?>" type="text" style="width:90%" />
												<script>
													datePicker("disbursement_date_<?= $cot; ?>");
												</script>
											</td>
											<td style="text-align:center"><input name="disbursed_amount_<?= $cot; ?>" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="disbursed_amount_<?= $cot; ?>" value="<?= isset($key->disbursed_amount) ? $key->disbursed_amount : '' ?>" /></td>
											<td style="text-align:center">
												<input class="text" name="expire_date_<?= $cot; ?>" id="expire_date_<?= $cot; ?>" value="<?= isset($key->expire_date) ? date_format(date_create($key->expire_date), "d/m/Y") : '' ?>" type="text" style="width:90%" />
												<script>
													datePicker("expire_date_<?= $cot; ?>");
												</script>
											</td>
											<td><input name="due_installments_<?= $cot; ?>" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="due_installments_<?= $cot; ?>" value="<?= isset($key->due_installments) ? $key->due_installments : '' ?>" /></td>
											<td><input name="payble_<?= $cot; ?>" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="payble_<?= $cot; ?>" value="<?= isset($key->payble) ? $key->payble : '' ?>" /></td>
											<td><input name="repayment_<?= $cot; ?>" type="text" class="" onKeyPress="return numbersonly(this,event,true)" style="width:90%" id="repayment_<?= $cot; ?>" value="<?= isset($key->repayment) ? $key->repayment : '' ?>" /></td>
											<td><input name="outstanding_bl_<?= $cot; ?>" type="text" onKeyPress="return numbersonly(this,event,true)" class="" style="width:90%" id="outstanding_bl_<?= $cot; ?>" value="<?= isset($key->outstanding_bl) ? $key->outstanding_bl : '' ?>" /></td>
											<td>
												<input class="text" name="outstanding_bl_dt_<?= $cot; ?>" id="outstanding_bl_dt_<?= $cot; ?>" value="<?= isset($key->outstanding_bl_dt) ? date_format(date_create($key->outstanding_bl_dt), "d/m/Y") : '' ?>" type="text" style="width:90%" />
												<script>
													datePicker("outstanding_bl_dt_<?= $cot; ?>");
												</script>
											</td>
											<td><input name="overdue_bl_<?= $cot; ?>" type="text" onKeyPress="return numbersonly(this,event,true)" class="" style="width:90%" id="overdue_bl_<?= $cot; ?>" value="<?= isset($key->overdue_bl) ? $key->overdue_bl : '' ?>" /></td>
											<td>
												<input class="text" name="overdue_bl_dt_<?= $cot; ?>" id="overdue_bl_dt_<?= $cot; ?>" value="<?= isset($key->overdue_bl_dt) ? date_format(date_create($key->overdue_bl_dt), "d/m/Y") : '' ?>" type="text" style="width:90%" />
												<script>
													datePicker("overdue_bl_dt_<?= $cot; ?>");
												</script>
											</td>
											<td>
												<input class="text" name="call_up_dt_<?= $cot; ?>" id="call_up_dt_<?= $cot; ?>" value="<?= isset($key->call_up_dt) ? date_format(date_create($key->call_up_dt), "d/m/Y") : '' ?>" type="text" style="width:90%" />
												<script>
													datePicker("call_up_dt_<?= $cot; ?>");
												</script>
											</td>
											<td>
												<div id="cl_bb_<?= $cot; ?>" name="cl_bb_<?= $cot; ?>" style="padding-left: 3px;"></div>
												<script>
													var theme = getDemoTheme();
													jQuery("#cl_bb_<?= $cot; ?>").jqxComboBox({
														theme: theme,
														width: 60,
														autoOpen: false,
														autoDropDownHeight: false,
														promptText: "Cl",
														source: cl,
														height: 25
													});
													jQuery("#cl_bb_<?= $cot; ?>").jqxComboBox('val', '<?= isset($key->cl_bb) ? $key->cl_bb : '' ?>');
													jQuery('#cl_bb_<?= $cot; ?>').focusout(function() {
														commbobox_check(jQuery(this).attr('id'));
													});
												</script>
											</td>
											<td>
												<div id="cl_bbl_<?= $cot; ?>" name="cl_bbl_<?= $cot; ?>" style="padding-left: 3px;"></div>
												<script>
													var theme = getDemoTheme();
													jQuery("#cl_bbl_<?= $cot; ?>").jqxComboBox({
														theme: theme,
														width: 60,
														autoOpen: false,
														autoDropDownHeight: false,
														promptText: "Cl",
														source: cl,
														height: 25
													});
													jQuery("#cl_bbl_<?= $cot; ?>").jqxComboBox('val', '<?= isset($key->cl_bbl) ? $key->cl_bbl : '' ?>');
													jQuery('#cl_bbl_<?= $cot; ?>').focusout(function() {
														commbobox_check(jQuery(this).attr('id'));
													});
												</script>
											</td>
										</tr>
									<?php $cot++;
									endforeach ?>
									<input type="hidden" name="facility_info_counter" id="facility_info_counter" value="<?= $cot - 1 ?>">
								</tbody>
							</table>
						</div>
					</td>
				<?php endif ?>
			<?php endif ?>
		</tr>
		<tr id="card_row_for_facility" style="display:none">
			<?php if ($add_edit == 'add') : ?>
				<td colspan="2">
					<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
						<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
						<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px">
							<thead>
								<tr>
									<td width="10%" style="font-weight: bold;text-align:center">Card Type</td>
									<td width="15%" style="font-weight: bold;text-align:center">Card No</td>
									<td width="15%" style="font-weight: bold;text-align:center">Card Holder Name</td>
									<td width="12%" style="font-weight: bold;text-align:center">Card Issue Date</td>
									<td width="12%" style="font-weight: bold;text-align:center">Card Exp Date</td>
									<td width="12%" style="font-weight: bold;text-align:center">Card Limit</td>
									<td width="12%" style="font-weight: bold;text-align:center">Outstanding Balance</td>
									<td width="12%" style="font-weight: bold;text-align:center">Outstanding BL DT</td>
									<td width="12%" style="font-weight: bold;text-align:center">CL BB<span style="color:red">*</span></td>
									<td width="12%" style="font-weight: bold;text-align:center">CL BBL<span style="color:red">*</span></td>
								</tr>
							</thead>
							<tbody id="card_row_for_facility_body">

							</tbody>
						</table>
					</div>
				</td>
			<?php else : ?>
				<?php if ($result->proposed_type=='Card'): ?>
					<td colspan="2">
						<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
							<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Facility Info</span>
							<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px">
								<thead>
									<tr>
										<td width="10%" style="font-weight: bold;text-align:center">Card Type</td>
										<td width="15%" style="font-weight: bold;text-align:center">Card No</td>
										<td width="15%" style="font-weight: bold;text-align:center">Card Holder Name</td>
										<td width="12%" style="font-weight: bold;text-align:center">Card Issue Date</td>
										<td width="12%" style="font-weight: bold;text-align:center">Card Exp Date</td>
										<td width="12%" style="font-weight: bold;text-align:center">Card Limit</td>
										<td width="12%" style="font-weight: bold;text-align:center">Outstanding Balance</td>
										<td width="12%" style="font-weight: bold;text-align:center">Outstanding BL DT</td>
										<td width="12%" style="font-weight: bold;text-align:center">CL BB<span style="color:red">*</span></td>
										<td width="12%" style="font-weight: bold;text-align:center">CL BBL<span style="color:red">*</span></td>
									</tr>
								</thead>
								<tbody id="loan_facility_info_body">
									<?php foreach ($facility_info as $key) : ?>
										<tr>
											<td style="text-align:center"><?= $key->card_type ?></td>
											<td style="text-align:center"><?= $key->card_no ?></td>
											<td style="text-align:center"><?= $key->card_name ?></td>
											<td style="text-align:center"><?= isset($key->card_issue_dt) ? date_format(date_create($key->card_issue_dt), "d/m/Y") : '' ?></td>
											<td style="text-align:center"><?= isset($key->card_exp_dt) ? date_format(date_create($key->card_exp_dt), "d/m/Y") : '' ?></td>
											<td style="text-align:center"><?= $key->card_limit ?></td>
											<td style="text-align:center"><?= $key->outstanding_bl ?></td>
											<td style="text-align:center"><?= isset($key->outstanding_bl_dt) ? date_format(date_create($key->outstanding_bl_dt), "d/m/Y") : '' ?></td>
											<td>
												<div id="cl_bb_card" name="cl_bb_card" style="padding-left: 3px;"></div>
												<script>
													var theme = getDemoTheme();
													jQuery("#cl_bb_card").jqxComboBox({
														theme: theme,
														width: 60,
														autoOpen: false,
														autoDropDownHeight: false,
														promptText: "Cl BB",
														source: cl,
														height: 25
													});
													jQuery("#cl_bb_card").jqxComboBox('val', '<?= isset($result->cl_bb_card) ? $result->cl_bb_card : '' ?>');
													jQuery('#cl_bb_card').focusout(function() {
														commbobox_check(jQuery(this).attr('id'));
													});
												</script>
											</td>
											<td>
												<div id="cl_bbl_card" name="cl_bbl_card" style="padding-left: 3px;"></div>
												<script>
													var theme = getDemoTheme();
													jQuery("#cl_bbl_card").jqxComboBox({
														theme: theme,
														width: 60,
														autoOpen: false,
														autoDropDownHeight: false,
														promptText: "Cl BBL",
														source: cl,
														height: 25
													});
													jQuery("#cl_bbl_card").jqxComboBox('val', '<?= isset($result->cl_bbl_card) ? $result->cl_bbl_card : '' ?>');
													jQuery('#cl_bbl_card').focusout(function() {
														commbobox_check(jQuery(this).attr('id'));
													});
												</script>
											</td>
										</tr>
									<?php endforeach ?>
									<tr>
										<td style="font-weight: bold;text-align:right" colspan="6">Total Outstanding :</td>
										<td style="font-weight: bold;text-align:center"><?= isset($result->outstanding_bl) ? $result->outstanding_bl : '' ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				<?php endif ?>
			<?php endif ?>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<br />
				<input type="button" value="<? if ($add_edit == 'add') {
												echo "Initiate Request";
											} else {
												echo "Update Request";
											} ?>" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;" id="in_req_button" /> <span id="in_req_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
				<br /><br /><br />
			</td>
		</tr>
		</tbody>
		</table>
		</form>
	</div>
</body>
<script type="text/javascript">
	var theme = getDemoTheme();
	rules = [{
			input: '#proposed_type',
			message: 'required!',
			action: 'blur,change',
			rule: function(input) {
				if (input.val() != '') {
					var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
					if (item != null) {
						jQuery("input[name='proposed_type']").val(item.value);
					}
					return true;
				} else {
					jQuery("#proposed_type input").focus();
					return false;
				}
			}
		},
		{
			input: '#loan_ac',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {
				if (jQuery("#loan_ac").val() == '') {
					jQuery("#loan_ac").focus();
					return false;
				} else {
					return true;
				}

			}
		},
		// {
		// 	input: '#loan_ac',
		// 	message: 'only numeric',
		// 	action: 'keyup, blur, change',
		// 	rule: function(input, commit) {
		// 		if (input.val() != '') {
		// 			if (!checknumber_alphabaticwithstar('loan_ac')) {
		// 				jQuery("#loan_ac").focus();
		// 				return false;

		// 			}
		// 		}
		// 		return true;

		// 	}
		// },
		{
			input: '#loan_ac',
			message: 'must be 16 digits',
			action: 'keyup, blur, change',
			rule: function(input, commit) {
				var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
				if(item!=null)
				{
					if (input.val() != '' && item.value=='Card') {
						if (input.val().length < 16 || input.val().length > 16) {
							jQuery("#loan_ac").focus();
							return false;

						}
					}
				}
				return true;

			}
		},
		{
			input: '#loan_ac',
			message: 'must be ' + acLength.join(" or ") + " Digits",
			action: 'keyup, blur, change',
			rule: function(input, commit) {
				var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
				if(item!=null)
				{
					if (input.val() != '' && item.value=='Loan') {

						if (jQuery.inArray(String(input.val().length), acLength) != -1) {
							return true;
						} else {
							return false;
						}



					}
				}
				return true;

			}
		},
		{
			input: '#cif',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {
				if (jQuery("#cif").val() == '') {
					jQuery("#cif").focus();
					return false;
				} else {
					return true;
				}
			}
		},
		{
			input: '#cif',
			message: 'must be 8 characters',
			action: 'keyup, blur, change',
			rule: function(input, commit) {
				if (input.val() != '') {
					if (input.val().length > 8 || input.val().length < 8) {
						jQuery("#cif").focus();
						return false;

					}
				}
				return true;

			}
		},
		{
			input: '#branch_sol',
			message: 'required!',
			action: 'blur,change',
			rule: function(input) {
				if (input.val() != '') {
					var item = jQuery("#branch_sol").jqxComboBox('getSelectedItem');
					if (item != null) {
						jQuery("input[name='branch_sol']").val(item.value);
						return true;
					} else {
						jQuery("#branch_sol input").focus();
						return false;
					}
				} else {
					jQuery("#branch_sol input").focus();
					return false;
				}
			}
		},
		{
			input: '#ac_name',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {
				if (jQuery("#ac_name").val() == '') {
					jQuery("#ac_name").focus();
					return false;
				} else {
					return true;
				}
			}
		},
		{
			input: '#brrower_name',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {
				var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
				if (jQuery("#brrower_name").val() == '' && item.value == 'Loan') {
					jQuery("#brrower_name").focus();
					return false;
				} else {
					return true;
				}
			}
		},
		// { input: '#ac_name', message: 'only Alphabetic (A – Z)', action: 'keyup, blur, change', rule: function (input, commit)
		//  {
		//  	if(input.val() != '')
		// 	{
		// 		if(!allLetter('ac_name'))
		// 		{
		// 			jQuery("#ac_name").focus();
		// 		 	return false;

		// 		}
		// 	}
		// 	return true;

		// } },
		{
			input: '#sub_type',
			message: 'required!',
			action: 'blur,change',
			rule: function(input) {
				if (input.val() != '') {
					var item = jQuery("#sub_type").jqxComboBox('getSelectedItem');
					if (item != null) {
						jQuery("input[name='sub_type']").val(item.value);
					}
					return true;
				} else {
					jQuery("#sub_type input").focus();
					return false;
				}
			}
		},
		// { input: '#spouse_name', message: 'only Alphabetic (A – Z)', action: 'keyup, blur, change', rule: function (input, commit)
		//  {
		//  	if(input.val() != '')
		// 	{
		// 		if(!allLetter('spouse_name'))
		// 		{
		// 			jQuery("#spouse_name").focus();
		// 		 	return false;

		// 		}
		// 	}
		// 	return true;

		// } },
		{
			input: '#mother_name',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {
				if (jQuery("#sub_type").val() != '') {
					var item = jQuery("#sub_type").jqxComboBox('getSelectedItem');
					if (item.label == 'Personal') {
						if (jQuery("#mother_name").val() == '') {
							jQuery("#mother_name").focus();
							return false;
						} else {
							return true;
						}
					} else {
						return true;
					}
				} else {
					return true;
				}

			}
		},
		// { input: '#mother_name', message: 'only Alphabetic (A – Z)', action: 'keyup, blur, change', rule: function (input, commit)
		//  {
		//  	if(input.val() != '')
		// 	{
		// 		if(!allLetter('mother_name'))
		// 		{
		// 			jQuery("#mother_name").focus();
		// 		 	return false;

		// 		}
		// 	}
		// 	return true;

		// } },
		{
			input: '#loan_segment',
			message: 'required!',
			action: 'blur,change',
			rule: function(input) {
				if (input.val() != '') {
					var item = jQuery("#loan_segment").jqxComboBox('getSelectedItem');
					if (item != null) {
						jQuery("input[name='loan_segment']").val(item.value);
					}
					return true;
				} else {
					jQuery("#loan_segment input").focus();
					return false;
				}
			}
		},
		{
			input: '#current_address',
			message: 'more than 250 characters',
			action: 'keyup, blur, change',
			rule: function(input, commit) {
				if (input.val() != '') {
					if (input.val().length > 250) {
						jQuery("#current_address").focus();
						return false;

					}
				}
				return true;

			}
		},
		{
			input: '#region',
			message: 'required!',
			action: 'blur, change',
			rule: function(input) {
				if (input.val() != '') {
					var item = jQuery("#region").jqxComboBox('getSelectedItem');
					if (item != null) {
						jQuery("input[name='region']").val(item.value);
					}
					return true;
				} else {
					jQuery("#region input").focus();
					return false;
				}
			}
		},
		{
			input: '#territory',
			message: 'required!',
			action: 'blur, change',
			rule: function(input) {
				if (input.val() != '') {
					var item = jQuery("#territory").jqxComboBox('getSelectedItem');
					if (item != null) {
						jQuery("input[name='territory']").val(item.value);
					}
					return true;
				} else {
					jQuery("#territory input").focus();
					return false;
				}
			}
		},

		{
			input: '#district',
			message: 'required!',
			action: 'blur, change',
			rule: function(input) {
				if (input.val() != '') {
					var item = jQuery("#district").jqxComboBox('getSelectedItem');
					if (item != null) {
						jQuery("input[name='district']").val(item.value);
					}
					return true;
				} else {
					jQuery("#district input").focus();
					return false;
				}
			}
		},
		{
			input: '#unit_office',
			message: 'required!',
			action: 'blur,change',
			rule: function(input) {
				if (input.val() != '') {
					var item = jQuery("#unit_office").jqxComboBox('getSelectedItem');
					if (item != null) {
						jQuery("input[name='unit_office']").val(item.value);
					}
					return true;
				} else {
					jQuery("#unit_office input").focus();
					return false;
				}
			}
		},
		{
			input: '#more_acc_number',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {
				if (jQuery("#more_acc_available").val() != 0) {
					if (jQuery("#more_acc_number").val() == '') {
						jQuery("#more_acc_number").focus();
						return false;
					} else {
						return true;
					}
				} else {
					return true;
				}

			}
		},
		// { input: '#mobile_no', message: 'invalid Phone', action: 'keyup, blur', rule: 'number' },
		// { input: '#mobile_no', message: 'must be 11 digits', action: 'keyup, blur, change', rule: function (input, commit)
		//  {
		//  	if(input.val() != '')
		// 	{
		// 		if(input.val().length<11 || input.val().length>11)
		// 		{
		// 			jQuery("#mobile_no").focus();
		// 		 	return false;

		// 		}
		// 	}
		// 	return true;

		// } },
		// { input: '#mobile_no', message: 'invalid', action: 'keyup, blur, change', rule: function (input, commit)
		//  {
		//  	if(input.val() != '')
		// 	{
		// 		if(input.val().startsWith("011") || input.val().startsWith("013") || input.val().startsWith("014") || input.val().startsWith("015") || input.val().startsWith("016") || input.val().startsWith("017") || input.val().startsWith("018") || input.val().startsWith("019"))
		// 		{
		// 			return true;


		// 		}
		// 		else
		// 		{
		// 			jQuery("#mobile_no").focus();
		// 		 	return false;
		// 		}
		// 	}
		// 	return true;

		// } },
		{
			input: '#call_up_dt',
			message: 'required!',
			action: 'keyup, blur, change',
			rule: function(input, commit) {
				if (jQuery("#call_up_dt").val() == '') {
					jQuery("#call_up_dt").focus();
					return false;
				} else {
					return true;
				}
			}
		},
		{
			input: '#call_up_dt',
			message: 'Invalid',
			action: 'keyup, blur, change',
			rule: function(input, commit) {
				if (!input.val()) {
					return true;
				}
				if (validate_date(input.val())) {
					return true;
				} else {
					jQuery("#call_up_dt").focus();
					return false;
				}
			}
		},
		{
			input: '#guarantor_type_1',
			message: 'required!',
			action: 'blur, change',
			rule: function(input) {
				if (input.val() != '') {
					var item = jQuery("#guarantor_type_1").jqxComboBox('getSelectedItem');
					if (item != null) {
						jQuery("input[name='guarantor_type_1']").val(item.value);
					}
					return true;
				} else {
					jQuery("#guarantor_type_1 input").focus();
					return false;
				}
			}
		},
		{
			input: '#guarantor_name_1',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {
				if (jQuery("#guarantor_name_1").val() == '') {
					jQuery("#guarantor_name_1").focus();
					return false;
				} else {
					return true;
				}
			}
		},
		{
			input: '#guarantor_name_1',
			message: 'more than 50 characters',
			action: 'keyup, blur, change',
			rule: function(input, commit) {
				if (input.val() != '') {
					if (input.val().length > 50) {
						jQuery("#guarantor_name_1").focus();
						return false;

					}
				}
				return true;

			}
		},
		{
			input: '#father_name_1',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {
				var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
				if (item.value == 'Loan') {
					if (jQuery("#father_name_1").val() == '') {
						jQuery("#father_name_1").focus();
						return false;
					} else {
						return true;
					}
				}
				return true;

			}
		},
		{
			input: '#father_name_1',
			message: 'more than 50 characters',
			action: 'keyup, blur, change',
			rule: function(input, commit) {
				var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
				if (item.value == 'Loan') {
					if (input.val() != '') {
						if (input.val().length > 50) {
							jQuery("#father_name_1").focus();
							return false;

						}
					}
					return true;
				}
				return true;

			}
		},
		{
			input: '#present_address_1',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {
				if (jQuery("#present_address_1").val() == '') {
					jQuery("#present_address_1").focus();
					return false;
				} else {
					return true;
				}
			}
		},
		{
			input: '#present_address_1',
			message: 'more than 200 characters',
			action: 'keyup, blur, change',
			rule: function(input, commit) {
				if (input.val() != '') {
					if (input.val().length > 200) {
						jQuery("#present_address_1").focus();
						return false;

					}
				}
				return true;

			}
		},
		{
			input: '#guar_sts_1',
			message: 'required!',
			action: 'blur, change',
			rule: function(input) {
				var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
				if (item.value == 'Loan') {
					if (input.val() != '') {
						var item = jQuery("#guar_sts_1").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='guar_sts_1']").val(item.value);
						}
						return true;
					} else {
						jQuery("#guar_sts_1 input").focus();
						return false;
					}
				}
				return true;

			}
		},
		{
			input: '#occ_sts_1',
			message: 'required!',
			action: 'blur, change',
			rule: function(input) {
				var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
				if (item.value == 'Loan') {
					if (input.val() != '') {
						var item = jQuery("#occ_sts_1").jqxComboBox('getSelectedItem');
						if (item != null) {
							jQuery("input[name='occ_sts_1']").val(item.value);
						}
						return true;
					} else {
						jQuery("#occ_sts_1 input").focus();
						return false;
					}
				}
				return true;
			}
		},
		{
			input: '#remarks',
			message: 'required!',
			action: 'keyup, blur',
			rule: function(input, commit) {
				if (jQuery("#remarks").val() == '' && jQuery("#pre_ln_id").val() != '') {
					jQuery("#remarks").focus();
					return false;
				} else {
					return true;
				}
			}
		},

	];

	function popup(url) {
		var winl = (screen.width - 900) / 2;
		var wint = 40;
		newwindow = window.open(url, 'name', 'height=600, width=900,top=' + wint + ', toolbar=no,status=no,scrollbars=yes,resizable=yes,menubar=no,location=no,direction=no,left=' + winl);
		if (window.focus) {
			newwindow.focus()
		}
		return false;
	}
	var options = {
		complete: function(response) {
			var json = jQuery.parseJSON(response.responseText);
			window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
			jQuery('.txt_csrfname').val(json.csrf_token);
			if (json.Message != 'OK') {
				jQuery("#in_req_button").show();
				jQuery("#in_req_loading").hide();
				alert(json.Message);
				return false;
			} else {
				var row = {};
				//console.log(json['row_info']);
				row["id"] = json['row_info'].id;
				row["legal_notice_sts"] = json['row_info'].sts;
				row["status"] = json['row_info'].legal_notice_sts;
				row["sl_no"] = json['row_info'].sl_no;
				row["loan_ac"] = json['row_info'].loan_ac;
				row["ac_name"] = json['row_info'].ac_name;
				row["e_by"] = json['row_info'].e_by;
				row["e_dt"] = json['row_info'].e_dt;
				row["return_reason_rm"] = json['row_info'].return_reason_rm;
				row["stc_by"] = json['row_info'].stc_by;
				row["stc_dt"] = json['row_info'].stc_dt;
				row["rec_by"] = json['row_info'].rec_by;
				row["rec_dt"] = json['row_info'].rec_dt;
				//console.log(row);
				// window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');

				// window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
				// <? if ($add_edit == 'add') { ?>
				// //alert(json['row_info'].loan_ac);
				// var paginginformation = window.parent.jQuery("#jqxgrid").jqxGrid('getpaginginformation');
				// var insert_index=paginginformation.pagenum*paginginformation.pagesize;
				// var commit = window.parent.jQuery("#jqxgrid").jqxGrid('addrow', null, row,insert_index);
				// window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', insert_index);
				// <? } else { ?>
				// jQuery.each(row, function(key,val){
				// 	window.parent.jQuery("#jqxgrid").jqxGrid('setcellvalue', <?= $editrow ?>, key, row[key]);
				// });
				// window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', <?= $editrow ?>);
				// <? } ?>
				// window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
				//window.parent.clearCount();
				//window.parent.search_data();
				window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
				jQuery("#msgArea").val('');
				window.parent.jQuery("#error").show();
				window.parent.jQuery("#error").fadeOut(11500);
				window.parent.jQuery("#error").html('<img align="absmiddle" src="' + baseurl + 'images/drag.png" border="0" /> &nbsp;Successfully Saved');
				window.top.EOL.messageBoard.close();
			}

		}
	};
	jQuery("#legal_notice_form").ajaxForm(options);
	jQuery("#in_req_button").click(function() {
		jQuery('#legal_notice_form').jqxValidator({
			rules: rules,
			theme: theme
		});
		var validationResult = function(isValid) {
			if (isValid && owner_validation() == true && facility_validation() == true) {
				jQuery("#in_req_button").hide();
				jQuery("#in_req_loading").show();
				jQuery("#legal_notice_form").submit();
			}
		}
		jQuery('#legal_notice_form').jqxValidator('validate', validationResult);
	});
</script>

<div id="sendToCheckerMessageDialogContent" style="display:none;">
	<form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform" style="margin-top:0px;">
		<input type="hidden" name="operation" id="operation" value="">
		<input type="hidden" name="index" id="index" value="">
		<input type="hidden" name="permission" id="permission" value="">
		<div class="hd">
			<h2 class="conf" style="margin-top:0px;color:#330707">(Without remove duplicate address cannot initiate legal notice (Remove Permanent Address)/ ডুপ্লিকেট ঠিকানা অপসারণ না করলে আইনি নোটিশ শুরু করা যাবে না (Remove Permanent Address).</h2>
		</div>
		<a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="give_permission()"><span id="button_tag"></span></a>
		<a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a>
		<span id="loadingReturn" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
	</form>
</div>