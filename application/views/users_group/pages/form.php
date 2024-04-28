<body style="height:98%">
<script type="text/javascript">
	jQuery(document).ready(function () {

		var theme = 'energyblue';
		var csrf_token='';
		jQuery("#sendButton").jqxButton({template:"default",width:"120"});
		jQuery('.text-input-small').addClass('jqx-input');
		jQuery('.text-input-small').addClass('jqx-rc-all');
		jQuery('.text-input-big').addClass('jqx-input');
		jQuery('.text-input-big').addClass('jqx-rc-all');
		if (theme.length > 0) {
			jQuery('.text-input-small').addClass('jqx-input-' + theme);
			jQuery('.text-input-small').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input-small').addClass('jqx-rc-all-' + theme);
			jQuery('.text-input-big').addClass('jqx-input-' + theme);
			jQuery('.text-input-big').addClass('jqx-widget-content-' + theme);
			jQuery('.text-input-big').addClass('jqx-rc-all-' + theme);
		}

		jQuery("#sendButton").jqxButton({template:"primary",width:"100"});
		jQuery('#form').jqxValidator({
			rules: [
			{ input: '#msgArea', message: 'Required', action: 'keyup, blur', rule: 'required' },
			{ input: '#msgArea', message: 'Number not accepted', action: 'keyup, blur', rule: 'notNumber' },
			{ input: '#msgArea', message: 'Duplicate', action: 'keyup, blur', rule: function (input, commit) {
				// call commit with false, when you are doing server validation and you want to display a validation error on this field.
					if(input.val()==''){
						commit(true);
						return true
					}
					var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
					var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
					jQuery.ajax({
						type: "POST",
						async:false,
						cache: false,
						url: "<?=base_url()?>index.php/users_group/duplicate_name/GROUP_NAME/<?=$add_edit?>/<?=$id?>",
						data : {[csrfName]: csrfHash,val: input.val()},
						datatype: "json",
						success: function(response){
							var json = jQuery.parseJSON(response);
							jQuery('.txt_csrfname').val(json.csrf_token);
							if(json.Status=='ok')
							{
								commit(true);
							}
							else{
								commit(false);

							}
						}
					});

				}
			}
			]
		});

		// validate form.
		jQuery("#sendButton").click(function () {
			var validationResult = function (isValid) {
				if (isValid) {
					call_ajax_submit();
				}
			}
			jQuery('#form').jqxValidator('validate', validationResult);
		});

		jQuery("#msgArea").focus();

	});


	function call_ajax_submit()
	{
		jQuery("#sendButton").hide();
		jQuery("#loading").show();

		var postdata = jQuery('#form').serialize();

		jQuery.ajax({
				type: "POST",
				cache: false,
				url: "<?=base_url()?>index.php/users_group/add_edit_action/<?=$add_edit?>/<?=$id?>",
				data : postdata,
				datatype: "json",
				success: function(response){
					var json = jQuery.parseJSON(response);
					window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
					jQuery('.txt_csrfname').val(json.csrf_token);
					var row = {};
					row["id"] = json.Status;
					row["group_name"] = jQuery("#msgArea").val();
					row["group_code"] = jQuery("#code").val();
					row["remarks"] = jQuery("#remarks").val();


					window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
					<? if($add_edit=='add'){?>
					var paginginformation = window.parent.jQuery("#jqxgrid").jqxGrid('getpaginginformation');
					var insert_index=paginginformation.pagenum*paginginformation.pagesize;
					var commit = window.parent.jQuery("#jqxgrid").jqxGrid('addrow', null, row,insert_index);
					window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', insert_index);
					<? }else{?>
					jQuery.each(row, function(key,val){
						window.parent.jQuery("#jqxgrid").jqxGrid('setcellvalue', <?=$editrow?>, key, row[key]);
					});
					window.parent.jQuery("#jqxgrid").jqxGrid('selectrow', <?=$editrow?>);
					<? }?>

					jQuery("#msgArea").val('');
					window.parent.jQuery("#error").show();
					window.parent.jQuery("#error").fadeOut(11500);
					window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
					window.top.EOL.messageBoard.close();
				}
			});
	}
    </script>

    <div  style=" width:99.9%; margin:auto">
       <form class="form" id="form" method="post" action="#">
       		<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
       		<div class="formHeader" style="background-color:#185891;">User Group Information </div>
	      		<table class="register-table">
                    <tr>
                        <td width="10%">Group Name <span style="color:#FF0000">*</span></td>
                        <td><input name="msgArea" type="text" id="msgArea" value="<?=isset($result->group_name)?$result->group_name:''?>"  class="text-input-big" /></td>
                    </tr>
                    <tr>
                        <td>Group Code</td>
                        <td><input name="code" type="text" id="code" value="<?=isset($result->group_code)?$result->group_code:''?>"  class="text-input-big" /></td>
                    </tr>
                    <tr>
                        <td>Remarks </td>
                        <td><textarea name="remarks" type="text" id="remarks" class="text-input-big" style="height:100px;" ><?=isset($result->remarks)?str_replace('\r','<br/>',$result->remarks):''?></textarea></td>
                    </tr>
                    <tr>
						<td>&nbsp;</td>
                        <td><br><input type="button" value="Save" id="sendButton" class="buttonStyle" /> <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></td>
                    </tr>
                </table>
        </form>

    </div>