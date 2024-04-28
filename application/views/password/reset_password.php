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
		//jQuery('#msgArea').empty();
		jQuery('#email').empty();

		var theme = 'classic';
		

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
			//{ input: '#msgArea', message: 'User ID is required!', action: 'keyup, blur', rule: 'required' },

			//{ input: '#email', message: 'Email is required!', action: 'keyup, blur', rule: 'required' },
			//{ input: '#email', message: 'invalid e-mail', action: 'keyup', rule: 'email' },

			]
		});*/

		// validate form.
		jQuery("#sendButton").click(function () {
			/*var validationResult = function (isValid) {
				if (isValid) {
					//jQuery("#form").submit();
					if(IsEmail(jQuery('#email').val())==true)
					{
						call_ajax_submit();
					}else{
						jQuery('#error').show();
						jQuery('#error').html('In-valid Email');						
					}
				}
			}
			jQuery('#form').jqxValidator('validate', validationResult);*/
			if(IsEmail(jQuery('#email').val())==true)
			{
				jQuery('#error_disp').html('');
				call_ajax_submit();
			}else{
				jQuery('#error_disp').html('In-valid Email');						
			}
		});

		jQuery("#email").focus();

	});


	 function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }

	function call_ajax_submit()
	{
		//alert(2);
		jQuery("#sendButton").hide();
		jQuery("#loading").show();

		var postdata = jQuery('#form').serialize();
		
		
		jQuery.ajax({
						type: "POST",
						cache: false,
						async:false,
						url: "<?=base_url()?>home/reset_ajax_login/",
						data : postdata,
						datatype: "json",
						success: function(response){
							var json = jQuery.parseJSON(response);
							jQuery('.txt_csrfname').val(json.csrf_token);

							if(json.Message=='OK')
							{
								jQuery("#form").hide();
								jQuery("#imsg").show();

							}
							else
							{
								jQuery('#error_disp').html(json.Message);
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

		.reflection
		{
			_background-image: url("<?=base_url()?>home/get_file/xyzzzsdsbbbpngrefl");
			background-repeat: no-repeat;
			opacity:0.3;
			width:442px;height:105px;
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
		  _display: table-cell;
		  _vertical-align: middle;
		}

		.inner {
		  padding: 15px;width: 400px;margin-left: auto;margin-right: auto;
		}
		#real {background-color: #ffffff;padding: 20px;border-radius: 10px;width:400px;height:270px;position: absolute;top: 20%;}
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
				<h2 align="center">Forgot Password</h2>
				<form class="form" id="form" method="post" action="#" autocomplete="off">
		  		<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				  <div class="container">
				  	<div id="error_disp" style="color:red; font-weight:bold;height: 15px;" align="center"></div>
					<label for="email"><b>Email</b></label>
					<input type="email" placeholder="Email" name="email" id="email" required="" autocomplete="off" maxlength="50">
                    <br><span style="font-size: 9px;">Please provide your account email  to retrieve your password.</span>
					<button class="submitBtn" id="sendButton" type="button">RESET</button>
					<span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
				  </div>
				</form>
                <div id="imsg">
                 <table class="register-table" >
                    <tr><td>&nbsp;</td></tr>
                    <tr><td colspan="2" align="center">A link has been sent to your email, please check. <a href="<?=base_url()?>">Login</a></td></tr>
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
