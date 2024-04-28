<script>
function openpass()
		{
			//jQuery("#jqxgrid").jqxGrid('clearselection');
			EOL.messageBoard.open('<?=base_url()?>index.php/home/change_pass/', (jQuery(window).width()-200), jQuery(window).height(), 'yes');
			return false;
		}
</script>
<style type="text/css">

	.form #pass, .form #msgArea, .form #zonelist {
		height: 24px;
		margin-top: 5px;
		margin-bottom: 5px;
		width: 242px;
	}
	.form #rememberme {
		margin-top: 5px;
		margin-bottom: 8px;
	}
	.prompt {
		margin-top: 10px; font-size: 10px;
	}
	div#zonelist {
		background-color:#ffffff;
	}
	#logindiv{
		height: 219px;
		font-size: 13px;
		font-family: Verdana;
		width:370px;
		margin:100px auto;
		border:thick #000066;
		border-radius: 25px;
		-webkit-border-radius : 25px;
		-moz-border-radius : 25px;
		/*background: -webkit-linear-gradient(#006cb7, #ffffff); // For Safari 5.1 to 6.0
	  	background: -o-linear-gradient(#006cb7, #ffffff); //For Opera 11.1 to 12.0
	  	background: -moz-linear-gradient(#006cb7, #ffffff); // For Firefox 3.6 to 15
	  	background: linear-gradient(#006cb7, #ffffff); //Standard syntax
		*/
	}
    </style>
<!--[if IE]>
<style type="text/css">
.button {
background-color:#5BA7E9;
}
</style>
<![endif]-->
<script type="text/javascript">
	jQuery(document).ready(function () {
		var theme = getDemoTheme();
		jQuery("#msgArea, #pass").addClass('jqx-input');
		if (theme != '') {
			jQuery("#msgArea, #pass").addClass('jqx-input-' + theme);
		}



		//jQuery("#rememberme").jqxCheckBox({ width: 130, theme: theme });
		jQuery("#loginButton").jqxButton({theme: theme});

		// add validation rules.
		jQuery('#form_login').jqxValidator({
			rules: [
					   { input: '#msgArea', message: 'User ID is required!', action: 'keyup, blur', rule: 'required' },
					   //{ input: '#msgArea', message: 'Your username must start with a letter!', action: 'keyup, blur', rule: 'startWithLetter' },
					   //{ input: '#msgArea', message: 'Your user ID must be between 7 and 8 digits!', action: 'keyup, blur', rule: 'length=7,8' },
					   { input: '#pass', message: 'Password is required!', action: 'keyup, blur', rule: 'required' }
					   //{ input: '#pass', message: 'Your password must be between 4 and 10 characters!', action: 'keyup, blur', rule: 'length=4,10' },
				   ]
				   , theme: theme
		});

		<?	if($error>0){
				if($error==404){ $msg="Invalid user id or password";}
				else if($error==405){ $msg="User id lockout, Please contract with administrator";}
				else if($error==406){ $msg="User id blocked, Please contract with administrator";}
				else if($error==407){ $msg="Password expired, Please contract with administrator";}
				else if($error==408){ $msg="Your Location Mismatch, Please contract with administrator";}
			?>
			jQuery("#error").show();
			jQuery("#error").fadeOut(90000);
			jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/invalid_icon.png" border="0" /> &nbsp;<?=$msg?>');
		<? }?>

	});

	function validationForm()
	{
		
		return jQuery('#form_login').jqxValidator('validate');
	}
</script>


	<div id="logindiv">
        <form class="form" id="form_login" action="<?=base_url()?>index.php/home/ajax_login/<?=$attempt?>"  method="post" style="width: 100%;text-align:center" onsubmit="return validationForm()">
          <div style="border: 1px solid #C0C0C0;height:250px;width:450px;">
	            <div style="text-align:center"><h2 style="color:#000099">Login <? //$this->input->ip_address()?></h2></div>
	            	<div>
	               		<label>&nbsp;&nbsp;&nbsp;<b>User ID :</b> </label><input type="text" id="msgArea" name="msgArea" value="<?=$u_id_slt?>" />
	            	</div>
	            	<div>
	              	    <label><b>Password :</b> </label><input type="password" id="pass" name="pass" />
	            	</div>
	            <div>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
	               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input id="loginButton" type="submit" class="button" value="Login" />
					
	            </div>
            <br><br>
          </div>

		</form>
		<br><br>
		<div align="center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forgot Password ? <a href="<?=base_url()?>index.php/home/reset_pass/" >Click Here</a></div>
	</div>
