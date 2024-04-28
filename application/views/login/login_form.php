<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">
<link rel="icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">
<noscript> 	JavaScript should be enable in your browser !!</noscript>
<title>Litigation Management System</title>
<meta http-equiv="refresh" content="300"> <!-- (content="60" = 60 seconds) -->
<link rel="shortcut icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">
<link rel="icon" href="<?=base_url()?>home/get_file/xyzzzsdsbbbpngfavi" type="image/x-icon">
<script type="text/javascript" src="<?=base_url()?>home/get_file/xyzzzsdsbbbjsjq36"></script>
<script type="text/javascript" src="<?=base_url()?>home/get_file/xyzzzsdsbbbjsjqvmin"></script>
<script type="text/javascript">

jQuery( document ).ready(function() {
	jQuery("#loginForm").validate({
	  errorPlacement: function(error, element) {
		error.insertBefore(element);
	  },
	  rules: {
		user_id: {
		  required: true
		},
		user_password: {
		  required: true
		}
	  },
	  messages: {
		user_id: {
		  required: " (User ID is required!)"
		},
		user_password: {
		  required: " (Password is required!)"
		}
	  },
	  submitHandler: function (form){
	     jQuery("form#loginForm")[0].submit();
	  }
	});

	<?php
		$msg = "";
		if($error > 0)
		{
			if($error == 404) { $msg = "Invalid User ID Or Password";}
			else if($error == 405) { $msg="User ID lockout, Please contract with administrator";}
			else if($error == 406) { $msg="User ID blocked, Please contract with administrator";}
			else if($error == 407) { $msg="Invalid User ID Or Password";}
	?>

			jQuery("#spnerrormsg").show();
			jQuery("#spnerrormsg").fadeOut(90000);
			jQuery("#spnerrormsg").html("<?=$msg?>");
	<?php } ?>

	//get_updated_token();
});
function get_updated_token(){
          var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
          var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
          jQuery.ajax({
          url: '<?=base_url()?>index.php/home/get_updated_token',
          async:false,
          type: "post",
          data: { [csrfName]: csrfHash,val : 1},
          datatype: "json",
          success: function(response){
          var json = jQuery.parseJSON(response);
          jQuery('.txt_csrfname').val(json.csrf_token);
          var str='';
          },
          error:   function(model, xhr, options){
              alert('failed');
          },
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
			background-image: url("<?=base_url()?>home/get_file/xyzzzsdsbbbpngrefl");
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
				<div class="imgcontainer">
					<img src="<?=base_url()?>home/get_file/xyzzzsdsbbbpnglogo" alt="LMS" style="height: 60px;width: auto;">
				</div>
				<div style="font-size:28px;color:#000000;text-align: center;">
					Sign In
				</div>
				<div style="height: 20px;text-align: center;"><span id="spnerrormsg" class="errormsg" style="color:red;display:none"></span></div>
				<form id="loginForm" method="post" action="<?=base_url()?>home/ajax_login/<?=$attempt?>" autocomplete="off">
		  		<input class="txt_csrfname" type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $csrf_token; ?>" />
				  <div class="container">
					<label for="uname"><b>User ID</b></label>
					<input type="text" placeholder="User ID" name="user_id" id="user_id">

					<label for="psw"><b>Password</b></label>
					<input type="password" placeholder="Enter Password" name="user_password" id="user_password" maxlength="20" autocomplete="off">
					
					<label  >
						<a href="<?=base_url()?>home/reset_pass/1/1" style="float:right;">Forgot password?</a>
					</label>

					<button class="submitBtn" type="submit">Login</button>
				  </div>
				</form>
			</div>
			<div class="reflection" id="ref">

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
