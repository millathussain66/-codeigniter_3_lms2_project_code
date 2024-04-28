
<div id="content">
<?
$option='UPR';

require_once('menu.php')?>
	<div style="width:60%;margin:auto; clear:both">
		<div id="error" style="width:30%;height:20px; float:right; display:none"></div>
	</div>
    <div  style=" width:80%; margin:auto; clear:both;padding-top: 20px;">
       <form class="form" id="form" method="post" action="#" >
       			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?
				$str="Select * from USERS_INFO_CONFIG where ID=1";
				$qry=$this->db->query($str);
				$row=$qry->row();

			?>
            <table  align="center" width="100%" border="0">
				<tr style="height:30px">
                	<td style="text-align:right" width="38%"><strong>Password Validity Period in days:</strong></td>
					<td width="40%" style="background-color: #E6F2FF; padding-left:10px"><input name="Password_validity_period" type="text" onkeypress="return numbersonly44(this,event,true)" id="Password_validity_period" value="<?=$row->PASSWORD_VALIDITY_PERIOD?>"  class="text-input" />
					</td>
					<td ><input type="button" value="Update" id="sendButton_pvp" onClick="click_button('pvp')" class="btn-small btn-small-normal enabledElem" /> <span id="loading_pvp" style="display:none"><img src="<?=BASE_URL_CSS?>images/loader.gif" align="bottom"></span></td>
				</tr>
                <tr style="background-color: #E4E4E4; padding-left:10px"><td colspan="3">&nbsp;</td></tr>
                <tr style="height:30px">
                	<td style="text-align:right"><strong>Password Length:</strong></td>
					<td style="background-color: #E6F2FF; padding-left:10px">
					Minimum: <input name="pass_min_length" type="text" onkeypress="return numbersonly44(this,event,true)" id="pass_min_length" value="<?=$row->PASSWORD_MIN_LENGTH?>" size="3"  class="text-input" />&nbsp;&nbsp;&nbsp;
					Maximum: <input name="pass_max_length" type="text" onkeypress="return numbersonly44(this,event,true)" id="pass_max_length" value="<?=$row->PASSWORD_MAX_LENGTH?>"  size="3"  class="text-input" />
					</td>
					<td ><input type="button" value="Update" id="sendButton_pl" onClick="click_button('pl')" class="btn-small btn-small-normal enabledElem" /> <span id="loading_pl" style="display:none"><img src="<?=BASE_URL_CSS?>images/loader.gif" align="bottom"></span></td>
               	</tr>
				<tr style="background-color: #E4E4E4"><td colspan="3">&nbsp;</td></tr>
				<tr style="height:30px">
					<td style="text-align:right"><strong>Default Password Type:</strong></td>
					<td style="background-color: #E6F2FF; padding-left:10px">
						<input name="default_password_type" <? if($row->DEFAULT_PASSWORD_TYPE=='User ID'){echo 'checked';}?>  type="radio" id="User_ID" value="User ID" />&nbsp;&nbsp;
						User ID 
						<input name="default_password_type" <? if($row->DEFAULT_PASSWORD_TYPE=='Dot'){echo 'checked';}?> type="radio" id="Dot" value="Dot" />&nbsp;&nbsp;
						Dot 
						<input name="default_password_type" <? if($row->DEFAULT_PASSWORD_TYPE=='Random'){echo 'checked';}?> type="radio" id="Random" value="Random" />
						Random 
					</td>
					<td ><input type="button" value="Update" id="sendButton_dpt" onClick="click_button('dpt')" class="btn-small btn-small-normal enabledElem" /> <span id="loading_dpt" style="display:none"><img src="<?=BASE_URL_CSS?>images/loader.gif" align="bottom"></span></td>
				</tr>
				<tr style="background-color: #E4E4E4"><td colspan="3">&nbsp;</td></tr>
				<tr style="height:30px">
					<td style="text-align:right"><strong>User ID Length:</strong></td>
					<td style="background-color: #E6F2FF; padding-left:10px">
					Minimum: <input name="user_id_min_length" type="text" onkeypress="return numbersonly44(this,event,true)" id="user_id_min_length" value="<?=$row->USER_ID_MIN_LENGTH?>" size="3"  class="text-input" />&nbsp;&nbsp;&nbsp;
					Maximum: <input name="user_id_max_length" type="text" onkeypress="return numbersonly44(this,event,true)" id="user_id_max_length" value="<?=$row->USER_ID_MAX_LENGTH?>"  size="3"  class="text-input" />

					</td>
					<td ><input type="button" value="Update" id="sendButton_uil" onClick="click_button('uil')" class="btn-small btn-small-normal enabledElem" /> <span id="loading_uil" style="display:none"><img src="<?=BASE_URL_CSS?>images/loader.gif" align="bottom"></span></td>
				</tr>
				<tr><td colspan="3" style="text-align: left"><br></td></tr>
			</table>
            <input name="btn_type" type="hidden" id="btn_type" value=""  />
        </form>

    </div>
 <script>
 	var csrf_token='';
	function click_button(val) {
		$("#btn_type").val(val);
		if(frm_validatiiion(val)==true)
		{
			$("#sendButton_"+val).hide();
			$("#loading_"+val).show();
			$("#error").stop(true, true);
			var postdata = jQuery('#form').serialize(); 

			$.ajax({
					type: "POST",
					cache: false,
					url: "<?=base_url()?>index.php/settings/index_update",
					data : postdata,
					datatype: "json",
					success: function(response){
						if(response!='OK')
						{								
							$("#sendButton_"+val).show();
							$("#loading_"+val).hide();
							alert(response)
							return false
						}
						$("#error").show();
						$("#error").fadeOut(12500);
						$("#error").html('<img align="absmiddle" src="<?=base_url()?>setting/images/drag.png" border="0" /> &nbsp;Successfully Updated');	
						$("#sendButton_"+val).show();
						$("#loading_"+val).hide();			
					}
				});	
		
			return false
		}
	}


	 function frm_validatiiion(val)
	 {
		if(val=='pvp')
		{
			 if($("#Password_validity_period").val()=='' || $("#Password_validity_period").val().length<=0)
			 {
				 alert("Please enter valid period");
				 $("#Password_validity_period").focus();
				 return false;
			 }
		}

		if(val=='pl')
		{
			 if($("#pass_min_length").val()=='' || $("#pass_min_length").val().length<=0)
			 {
				 alert("Please enter valid Password Minimum Length");
				 $("#pass_min_length").focus();
				 return false;
			 }
			 if($("#pass_max_length").val()=='' || $("#pass_max_length").val().length<=0)
			 {
				 alert("Please enter valid Password Maximum Length");
				 $("#pass_max_length").focus();
				 return false;
			 }
		}

		if(val=='uil')
		{
			 if($("#user_id_min_length").val()=='' || $("#user_id_min_length").val().length<=0)
			 {
				 alert("Please enter valid User ID Minimum Length");
				 $("#user_id_min_length").focus();
				 return false;
			 }
			 if($("#user_id_max_length").val()=='' || $("#user_id_max_length").val().length<=0)
			 {
				 alert("Please enter valid User ID Maximum Length");
				 $("#user_id_max_length").focus();
				 return false;
			 }
		}

		return true;
	 }
 </script>

</div>

