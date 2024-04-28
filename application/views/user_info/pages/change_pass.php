<body style="height:98%">
<script type="text/javascript">
	var csrf_tokens='';
	jQuery(document).ready(function () {
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

		// initialize validator.
		jQuery('#form').jqxValidator({
			rules: [
			{ input: '#employee_ID', message: 'Old Password is required!', action: 'keyup, blur', rule: 'required' },
			{ input: '#employee_ID', message: 'Wrong Old Password !', action: 'keyup, focus', rule: function (input, commit) {
				// call commit with false, when you are doing server validation and you want to display a validation error on this field.
					if(input.val()==''){
						commit(true);
						return true
					}
					else{
						var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
						var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
						jQuery.ajax({
						type: "POST",
						async:false,
						url: "<?=base_url()?>user_info/old_pass_check",
						//data : {val: input.val()},
						data : {[csrfName]: csrfHash,val: input.val()},
						datatype: "json",
						success: function(response){
							var json = jQuery.parseJSON(response);
								jQuery('.txt_csrfname').val(json.csrf_token);
								if(json.Status=='OK')
								{
									commit(true);
									return true;
								}
								else{
									commit(false);
									return false;

								}
						}
					});
						
					}
					

				}
			},

			{ input: '#pass', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
			{ input: '#pass', message: 'Your password must be between <?=$sys_config->password_min_length?> and <?=$sys_config->password_max_length?> digits!', action: 'keyup, blur', rule: 'length=<?=$sys_config->password_min_length?>,<?=$sys_config->password_max_length?>' },
			{ input: '#pass', message: 'Must contain 1 capital latter, 1 small latter, 1 numeric and no special character!', action: 'keyup, focus', rule: function (input, commit) {
					if(input.val()=='' || input.val().length<<?=$sys_config->password_min_length?> ){
						commit(true);
						return true
					}


					if(input.val().match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{<?=$sys_config->password_min_length?>,<?=$sys_config->password_max_length?>}$/))
					{
						if(input.val().length <= <?=$sys_config->password_min_length?>){
							input.parent().find('span').remove();
							input.after('<span>&nbsp;&nbsp;the password strength is low.</span>');
						}else if(input.val().length > <?=$sys_config->password_min_length?> && input.val().length < <?=($sys_config->password_min_length+3)?>){
							input.parent().find('span').remove();
							input.after('<span>&nbsp;&nbsp;the password strength is Medium.</span>');
						}else{
							input.parent().find('span').remove();
							input.after('<span>&nbsp;&nbsp;the password strength is Strong.</span>');
						}

						commit(true);
						return true;
					}
					else{
						commit(false);
						return false;
					}



				}
			},
			{ input: '#passwordConfirmInput', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
			{ input: '#passwordConfirmInput', message: 'Passwords doesn\'t match!', action: 'keyup, focus', rule: function (input, commit) {
				if (input.val() === jQuery('#pass').val()) {
					return true;
				}
					return false;
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

		// jQuery("#employee_ID").focus();

	});


	function call_ajax_submit()
	{
		jQuery("#sendButton").hide();
		jQuery("#loading").show();
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postdata = jQuery('#form').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
					type: "POST",
					cache: false,
					url: "<?=base_url()?>/user_info/change_pass_action",
					data : postdata,
					datatype: "json",
					success: function(response){
						var json = jQuery.parseJSON(response);
						window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
						if(json.Message!='OK')
						{
							jQuery("#sendButton").show();
							jQuery("#loading").hide();
							alert(json.Message);
							return false
						}else{

							jQuery("#error").show();
							jQuery("#error").fadeOut(21500);
							jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Password Changed');
							alert('Successfully Password Changed, Please login with a new password');
							jQuery("#sendButton").show();
							jQuery("#loading").hide();
							jQuery("#employee_ID").val('');
							jQuery("#pass").val('');
							jQuery("#pass").parent().find('span').remove();
							jQuery("#passwordConfirmInput").val('');
							
							window.location.href = "<?=base_url()?>/home/logout";

						}
					}
				});
	}
    </script>

    <div  style="width:90%; margin:auto">
	
       <form class="form" id="form" method="post" autocomplete="off" action="#" style="font-size: 13px; font-family: Verdana; width:60%;margin: 0 auto" >
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<div><h2 align="center">Change Password</h2></div>
			
            <table class="register-table">
				<tr>
					<td>Old Password </td>
					<td><input name="employee_ID" type="password" autocomplete="off" id="employee_ID" class="text-input-big" /></td>
				</tr>
				<tr>
					<td>Password </td>
					<td><input name="pass" type="password" autocomplete="off" id="pass" class="text-input-big" /></td>
				</tr>
				<tr>
					<td>Confirm Password </td>
					<td><input type="password" autocomplete="off" id="passwordConfirmInput" class="text-input-big" /></td>
				</tr>
                <tr>
					<td colspan="2" style="text-align: center"><br><input type="button" value="Save" id="sendButton" class="buttonStyle" /> <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></td>
				</tr>
                </table>

	       </form>
    </div>