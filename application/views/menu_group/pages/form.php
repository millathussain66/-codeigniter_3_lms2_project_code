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

		// initialize validator.
		jQuery('#form').jqxValidator({
			rules: [
			{ input: '#sort_name', message: 'Required', action: 'keyup, blur', rule: 'required' },
			{ input: '#menu_name', message: 'Required', action: 'keyup, blur', rule: 'required' },
			{ input: '#menu_name', message: 'Number not accepted', action: 'keyup, blur', rule: 'notNumber' },
			{ input: '#menu_name', message: 'Duplicate', action: 'keyup, blur', rule: function (input, commit) {
				// call commit with false, when you are doing server validation and you want to display a validation error on this field.
					if(input.val()==''){
						commit(true);
						return true
					}
					if(csrf_token == '')
					{
						csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';	
					}
					jQuery.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>index.php/Menu_group/duplicate_name/menu_name/<?=$add_edit?>/<?=$id?>",
						data : {'<?php echo $this->security->get_csrf_token_name(); ?>':csrf_token,val: input.val()},
						datatype: "json",
						success: function(response)
						{
							var json = jQuery.parseJSON(response);
							if(json.csrf_token == csrf_token)
							{
								csrf_token = json.csrf_token;
							}else{
								window.location.replace('<?=base_url()?>index.php/home/logout');
							}
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
			},
			{ input: '#url_prefix', message: 'Duplicate', action: 'keyup, blur', rule: function (input, commit) {
				// call commit with false, when you are doing server validation and you want to display a validation error on this field.
					if(input.val()==''){
						commit(true);
						return true
					}
					if(csrf_token == '')
					{
						csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';	
					}
					jQuery.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>index.php/Menu_group/duplicate_name/url_prefix/<?=$add_edit?>/<?=$id?>",
						data : {'<?php echo $this->security->get_csrf_token_name(); ?>':csrf_token,val: input.val()},
						datatype: "json",
						success: function(response)
						{
							var json = jQuery.parseJSON(response);
							if(json.csrf_token == csrf_token)
							{
								csrf_token = json.csrf_token;
							}else{
								window.location.replace('<?=base_url()?>index.php/home/logout');
							}
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
			},
			{ input: '#sort_order', message: 'Duplicate', action: 'keyup, blur', rule: function (input, commit) {
				// call commit with false, when you are doing server validation and you want to display a validation error on this field.
					if(input.val()==''){
						commit(true);
						return true
					}
					if(csrf_token == '')
					{
						csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';	
					}
					jQuery.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>index.php/Menu_group/duplicate_name/sort_order/<?=$add_edit?>/<?=$id?>",
						data : {'<?php echo $this->security->get_csrf_token_name(); ?>':csrf_token,val: input.val()},
						datatype: "json",
						success: function(response)
						{
							var json = jQuery.parseJSON(response);
							if(json.csrf_token == csrf_token)
							{
								csrf_token = json.csrf_token;
							}else{
								window.location.replace('<?=base_url()?>index.php/home/logout');
							}
							if(json.Status == 'ok')
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
				url: "<?=base_url()?>index.php/Menu_group/add_edit_action/<?=$add_edit?>/<?=$id?>",
				data : postdata,
				datatype: "json",
				success: function(response){
					var json = jQuery.parseJSON(response);
				
					var row = {};
					row["id"] = json.Status;
					row["sort_name"] = jQuery("#sort_name").val();
					row["menu_name"] = jQuery("#menu_name").val();
					row["url_prefix"] = jQuery("#url_prefix").val();
					row["sort_order"] = jQuery("#sort_order").val();
					row["has_child"] = jQuery("#has_child").val();


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
       		<div class="formHeader">Menu Group Information </div>
       			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	      		<table class="register-table">
					<tr>
                        <td width="10%">Short Name <span style="color:#FF0000">*</span></td>
                        <td><input name="sort_name" type="text" id="sort_name" value="<?=isset($result->sort_name)?$result->sort_name:''?>"  class="text-input-big" /></td>
                    </tr>
                    <tr>
                        <td width="10%">Menu Name <span style="color:#FF0000">*</span></td>
                        <td><input name="menu_name" type="text" id="menu_name" value="<?=isset($result->menu_name)?$result->menu_name:''?>"  class="text-input-big" /></td>
                    </tr>
                    <tr>
                        <td>URL Prefix</td>
                        <td><input name="url_prefix" type="text" id="url_prefix" value="<?=isset($result->url_prefix)?$result->url_prefix:''?>"  class="text-input-big" /></td>
                    </tr>
                    <tr>
                        <td>Sort Order <span style="color:#FF0000">*</span></td>
                       <td><input name="sort_order" type="text" id="sort_order" value="<?=isset($result->sort_order)?$result->sort_order:''?>"  class="text-input-big" /></td>
                    </tr>
					<tr>
                        <td>Has Child</td>
                       <td><input name="has_child" type="checkbox" id="has_child" value="1" <?php if(isset($result->has_child) && $result->has_child == "1") { echo "checked"; }?>/>Yes </td>
                    </tr>
                    <tr>
						<td>&nbsp;</td>
                        <td><br><input type="button" value="Save" id="sendButton" class="buttonStyle" /> <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></td>
                    </tr>
                </table>
        </form>

    </div>