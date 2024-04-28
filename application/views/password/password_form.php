<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">
<link rel="icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">
<noscript> 	JavaScript should be enable in your browser !!</noscript>
<title>Litigation Management System</title>
<link rel="shortcut icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">
<link rel="icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">
<script type="text/javascript" src="<?=base_url()?>home/get_file/xyzzzsdsbbbjsjq36"></script>
<script type="text/javascript" src="<?=base_url()?>home/get_file/xyzzzsdsbbbjsjqvmin"></script>
<script type="text/javascript">
var csrf_tokens='';
	jQuery(document).ready(function () {
		jQuery("#iform").show();
		jQuery("#imsg").hide();
		var theme = 'classic';
		jQuery('#msgArea').empty();
		jQuery('#pass').empty();
		jQuery('#confpass').empty();
		

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

		/*// initialize validator.
		jQuery('#form').jqxValidator({
			rules: [
			{ input: '#msgArea', message: 'Old Password is required!', action: 'keyup, blur', rule: 'required' },
			{ input: '#msgArea', message: 'Wrong Old Password !', action: 'keyup, focus', rule: function (input, commit) {
				// call commit with false, when you are doing server validation and you want to display a validation error on this field.
					if(input.val()==''){
						commit(true);
						return true
					}
					if(csrf_tokens==''){
							csrf_tokens='<?php echo $this->security->get_csrf_hash(); ?>';
							
						}
					jQuery.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>home/old_pass_check",
						data : {'<?php echo $this->security->get_csrf_token_name(); ?>':csrf_tokens,val: input.val()},
						datatype: "json",
						success: function(response){
							var json = jQuery.parseJSON(response);
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
							input.after('<span style="color:#CC5500">&nbsp;&nbsp;password strength is low.</span>');
						}else if(input.val().length > <?=$sys_config->password_min_length?> && input.val().length < <?=($sys_config->password_min_length+3)?>){
							input.parent().find('span').remove();
							input.after('<span style="color:#FFA500">&nbsp;&nbsp;password strength is Medium.</span>');
						}else{
							input.parent().find('span').remove();
							input.after('<span style="color:#009925">&nbsp;&nbsp;password strength is Strong.</span>');
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
			{ input: '#confpass', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
			{ input: '#confpass', message: 'Passwords doesn\'t match!', action: 'keyup, focus', rule: function (input, commit) {
				// call commit with false, when you are doing server validation and you want to display a validation error on this field.
				if (input.val() === jQuery('#pass').val()) {
					return true;
				}
					return false;
				}
			}



			]
		});*/
		jQuery("#pass").keyup(function () {
			var d =jQuery("#pass").val();
			jQuery('#error_d').html(validatePassword(d));
		});
		// validate form.
		jQuery("#sendButton").click(function () {
			//var validationResult = function (isValid) {
				//if (isValid) {
					//jQuery("#form").submit();
					call_ajax_submit();
				//}
			//}
			//jQuery('#form').jqxValidator('validate', validationResult);
		});

		jQuery("#msgArea").focus();

	});
	function validatePassword(p) {
		return true;
	    //var p = document.getElementById('newPassword').value,
	        errors = [];
	    if (p.length < <?=$sys_config->password_min_length?>) {
	        errors.push("Your password must be at least <?=$sys_config->password_min_length?> characters"); 
	    }
	    if (p.search(/[A-Z]/i) < 0) {
	        errors.push("Your password must contain at least one capital letter.");
	    }
	    if (p.search(/[a-z]/i) < 0) {
	        errors.push("Your password must contain at least one small letter.");
	    }
	    if (p.search(/[0-9]/) < 0) {
	        errors.push("Your password must contain at least one digit."); 
	    }
	    if (errors.length > 0) {
	        //alert();
	        return errors.join("\n");
	    }
	    return true;
	}

	function call_ajax_submit()
	{
		jQuery("#sendButton").hide();
		jQuery("#loading").show();
			if(csrf_tokens==''){
							csrf_tokens='<?php echo $this->security->get_csrf_hash(); ?>';
							
						}
		var postdata = jQuery('#form').serialize();
		jQuery.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>home/change_ajax_login/<?=$alert?>",
						data : postdata,
						datatype: "json",
						success: function(response){
							var json = jQuery.parseJSON(response);
							jQuery('.txt_csrfname').val(json.csrf_token);
							if(json.Message=='OK')
							{

								jQuery("#msgArea").val('');
								jQuery("#form").hide();
								jQuery("#imsg").show();;

							}
							else
							{
								jQuery("#error_cp").show();
								jQuery("#error_cp").fadeOut(11500);
								jQuery("#error_cp").html('&nbsp;'+json.Message);
								jQuery("#sendButton").show();
								jQuery("#loading").hide();
								return false;

							}

						}
					});
	}
    </script>



<style type="text/css">

#user_id-error, #user_password-error
{
	font-size: 15px !important;
	color: red !important;
	font-weight:bold !important;
	margin-left: 0px !important;
}
	body
		{
		/* Radiel gradient defined by its center*/
			background-image: url("<?=base_url()?>home/get_file/xyzzzsdsbbbjpgr");
			background-repeat: no-repeat;
			background-size: cover; 
			height: 100vh;
			width: auto;
			padding: 0;
			margin: 0;
		}		

		input[type=text], input[type=password], input[type=email] {
			width: 100%;
			padding: 10px 15px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
			border-radius: 3px;
		}

		/* Set a style for all buttons */
		.submitBtn {
			background: #f8ccf4; /* Old browsers */
			background: -moz-linear-gradient(left,  #f8ccf4 0%, #064da3 100%); /* FF3.6-15 */
			background: -webkit-linear-gradient(left,  #f8ccf4 0%,#064da3 100%); /* Chrome10-25,Safari5.1-6 */
			background: linear-gradient(to right,  #f8ccf4 0%,#064da3 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f8ccf4', endColorstr='#064da3',GradientType=1 ); /* IE6-9 */
			color: white;
			font-size: 16px;
			font-weight: bold;
			padding: 14px 20px;
			margin: 15px 0 8px;
			border: none;
			border-radius:25px;
			cursor: pointer;
			width: 100%;
		}

		/* Add a hover effect for buttons */
		.submitBtn:hover {

		}

		/* Extra style for the cancel button (red) */
		.cancelbtn {
		  width: auto;
		  padding: 10px 18px;
		  background-color: #f44336;
		}

		/* Center the avatar image inside this container */
		.imgcontainer {
		  text-align: center;
		  padding: 0;
		}

		/* Add padding to containers */
		.container {
		  padding: 16px;
		}

		/* The "Forgot password" text */
		span.psw {
		  float: right;
		  padding-top: 16px;
		}

		.outer {
		  display: table;
		  position: relative;
		  top: 0;
		  left: 0;
		  height: 80%;
		  width: 100%;
		}

		.middle {
		  display: table-cell;
		  vertical-align: middle;
		}

		.inner {
		  padding: 15px;width: 400px;margin-left: auto;margin-right: auto;
		}
		#real {background-color: #ffffff;padding: 20px;border-radius: 10px;width:400px;height:370px;}
		.flex-container {
			display: flex;
		}

		.flex-child {
			flex: 1;
			padding: 10px;
		}  
		
		.header {height: 50px;padding:10px;background-color: #ffffff;text-align: center;font-size:36px;color:#0B1562;}
		.footer {height: 35px;padding:5px 10px;background-color: #A1A1A1;left:0;bottom:0;position: fixed;width: 100%;}

		/*.flex-child:second-child {
			margin-right: 20px;
		}*/ 
</style>
</head>
<body>

<div class="header">
	<img style="position: absolute;top:7px;left: 10px;" src="<?=base_url()?>home/get_file/xyzzzsdsbbbpngclient" />
	Litigation Management  System	
</div>
<div class="outer">
	<div class="middle">
		<div class="inner">
			<div id="real">
				<h2 align="center">Change Password</h2>
                 <div id="error_cp"></div>
				<form class="form" id="form" method="post" action="#" autocomplete="off">
		  		<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				  <div class="container">
					<label for="msgArea"><b>Old Password</b></label>
					<input type="password" placeholder="Old Password" name="msgArea" id="msgArea" autocomplete="off" maxlength="20">

					<label for="pass"><b>New Password</b></label><span id="error_d"></span>
					<input type="password" placeholder="New Password" name="pass" id="pass" maxlength="20" autocomplete="off">

					<label for="confpass"><b>Confirm New password</b></label>
					<input type="password" placeholder="Confirm New password" name="confpass" id="confpass" maxlength="20" autocomplete="off">
					<button class="submitBtn" id="sendButton" type="button">Update</button><span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
				  </div>
				</form>
                <div id="imsg">
                 <table class="register-table">
                    <tr><td>&nbsp;</td></tr>
                    <tr><td colspan="2" align="center">Your password has been changed, please go to the link. <a href="<?=base_url()?>">Login</a></td></tr>
                    <tr><td>&nbsp;</td></tr>
                </table>
                </div>
			</div>	
		
		</div>
	</div>
</div>
<div class="footer flex-container">
	<div class="flex-child" style="font-size: 13px;font-weight: bold;">LMS v.1.0.1</div>
	<div class="flex-child" style="font-size: 13px;font-weight: bold;text-align: right;margin-right: 30px">Developed by <a style="color: #0226FB; text-decoration: none;" href="https://www.mmtvbd.com/" target="_blank">MicroMac</a></div>
</div>
</body>
</html>
