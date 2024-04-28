<div id="content">
<?
$option='default_pass';

require_once('menu.php');?>

    <div style="width:100%;margin:auto; clear:both">
		<div id="error" style="width:25%;height:20px; float:right; display:none"></div>
	</div>
    <div style=" width:95%; margin:auto;clear:both;padding-top:13px;">
       <form id="form" method="post" action="" >
       <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div>
                <div id="error" style="margin: 10px; padding:0 80px 0 80px; float: right;  height:20px; display:none " align="center"></div>
                <br><br><br><br>
            </div>
            <? 
				$str="Select * from users_info_config where id=1";
				$row=$this->db->query($str)->row();
			?>
            <table  align="center" width="100%">
                    <tr>
                        <td style="text-align:right" width="50%">Password Validity Period:</td>
                        <td><input name="password_validity_period" type="text" onkeypress="return numbersonly44(this,event,true)" id="password_validity_period" value="<?=$row->password_validity_period?>"  class="text-input" />
                        
                        </td>
                    </tr>
                    <tr style="display: none;">
                        <td style="text-align:right" width="50%">Default Password:</td>
                        <td><input name="default_password" type="text"  id="default_password" value="<?=$row->default_password?>"  class="text-input" />
                        <input name="btn_type" type="hidden" id="btn_type" value="default_password"  />
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right" width="50%">Password Length:</td>
                        <td><strong>Min: </strong><input name="password_min_length" type="text"  id="password_min_length" value="<?=$row->password_min_length?>"  class="text-input" style="width:50px" />
                        &nbsp; &nbsp; &nbsp;
                        <strong>Max: </strong><input name="password_max_length" type="text"  id="password_max_length" value="<?=$row->password_max_length?>"  class="text-input" style="width:50px" />
                        
                        </td>
                    </tr>
                    
                     <tr>
                        <td style="text-align:right" width="50%">User ID Length:</td>
                        <td><strong>Min: </strong><input name="user_id_min_length" type="text"  id="user_id_min_length" value="<?=$row->user_id_min_length?>"  class="text-input" style="width:50px" />
                         &nbsp; &nbsp; &nbsp;
                        <strong>Max: </strong><input name="user_id_max_length" type="text"  id="user_id_max_length" value="<?=$row->user_id_max_length?>"  class="text-input" style="width:50px" />
                        
                        </td>
                    </tr>
                    
                    <tr>
                    	<td>&nbsp;</td>
                        <td style="text-align: left"><br><input type="button" value="Update" id="sendButton" class="btn-small btn-small-normal enabledElem" /> <span id="loading" style="display:none">Please wait... <img src="<?=BASE_URL_CSS?>images/loader.gif" alt="loading" align="bottom"></span></td>
                    </tr>
                </table>
        </form>
       
    </div>
 <script>
 $(document).ready(function() {
	 $("#sendButton").click(
		function() {
			if(frm_validatiiion()==true)
			{
				$("#sendButton").hide();
				$("#loading").show();
				
				var postdata = jQuery('#form').serialize(); 
				$.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>settings/sit_update",						
						data : postdata,
						datatype: "json",
						success: function(response){
							if(response!='OK')
							{
								$("#sendButton").show();
								$("#loading").hide();
								
								return false
							}
							$("#error").show();
							$("#error").fadeOut(11500);
							$("#error").html('<img align="absmiddle" src="<?=BASE_URL_CSS?>images/drag.png" border="0" /> &nbsp;Successfully Updated');
							//$("#error").html('Successfully Updated');
							$("#error").fadeOut('slow');	
							$("#sendButton").show();
							$("#loading").hide();			
						}
					});	
			
				return false
			}
		});
 }); 
 
 function frm_validatiiion() 
 {
	 if($("#password_validity_period").val()=='' || $("#password_validity_period").val().length<=0)
	 {
		 alert("Please enter valid period");
		 $("#password_validity_period").focus();
		 return false;
	 }	
	 if($("#default_password").val()=='' || $("#default_password").val().length<=0)
	 {
		 alert("Please enter valid default password");
		 $("#default_password").focus();
		 return false;
	 }	 
	 return true;
 }
 </script>   
    
    
</div>
    
<? require_once('footer.php')?>