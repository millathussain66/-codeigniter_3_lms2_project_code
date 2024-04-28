<style type="text/css">
	#gurantor_table {
	border-collapse: collapse;
	}
	#gurantor_table td {
	    border: 1px solid rgba(0,0,0,.20); 
	}
	.addmore
	{
		background-image:url(<?=base_url()?>images/addmore_grn.png);
		/*background-size: 20px 20px;*/
		background-repeat: no-repeat;
		border:0;
		width:18px; height:18px;
		background-color:transparent;
		cursor:pointer;
	}
	
	.del
	{
		background-image:url(<?=base_url()?>images/del.png);
		background-repeat: no-repeat;
		border:0;
		width:18px; height:18px;
		background-color:transparent;
		cursor:pointer;
	}
</style>
<div id="content">
<?
$option='APC'; 
?>
  <script language="javascript" type="text/javascript">
  // var api_type = [<? $j=1; for($i=0; $i<count($api_type); $i++){ if($j!=1){echo ',';} echo '{value:"'.$api_type[$i].'", label:"'.$api_type[$i].'"}'; $j++;}?>];
  // var dev_live = [<? $j=1; for($i=0; $i<count($dev_live); $i++){ if($j!=1){echo ',';} echo '{value:"'.$dev_live[$i].'", label:"'.$dev_live[$i].'"}'; $j++;}?>];
  // 	console.log(api_type);
 function view2() {
    window.open('<?=BASE_URL?>user_search','_blank','resizable=no,status=no,location=no,toolbar=no,menubar=no,width=1300,height=600,top=0,left=300'); 
    return false;
}
function check_change(row)
{

}
function add_more_api()
{
	var counter = jQuery('#api_info_counter').val();
	var new_counter = parseInt(counter) + 1;
	html_string = '';

		html_string += '<tr id="api_info_'+new_counter+'">';
		html_string += '<td>';
		html_string += '<input type="hidden" id="api_info_edit_'+new_counter+'" name="api_info_edit_'+new_counter+'" value="0">';
		html_string += '<input type="hidden" id="api_info_delete_'+new_counter+'" name="api_info_delete_'+new_counter+'" value="0">';
		html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_api('+new_counter+')" style="margin-top: 5px;" style="cursor:pointer;">';
		html_string += '</td>';
		html_string += '<td><input type="checkbox" id="active_sts_'+new_counter+'" name="active_sts_'+new_counter+'" value="1" checked></td>';
		html_string += '<td>';
		html_string += '<select style="width:98%" name="dev_live_'+new_counter+'" id="dev_live_'+new_counter+'">';
		html_string += '<option value="">Select Dev/Live</option>';
		<?php
			 for ($i=0; $i <count($dev_live) ; $i++) 
			 {?>
				html_string += '<option value="<?=$dev_live[$i]?>"><?=$dev_live[$i]?></option>';
			<?}
		?>
		html_string += '</select>';
		html_string += '</td>';	
		html_string += '<td>';
		html_string += '<select style="width:98%" name="api_type_'+new_counter+'" id="api_type_'+new_counter+'">';
		html_string += '<option value="">Select Api Type</option>';
		<?php
			 for ($i=0; $i <count($api_type) ; $i++) 
			 {?>
				html_string += '<option value="<?=$api_type[$i]?>"><?=$api_type[$i]?></option>';
			<?}
		?>
		html_string += '</select>';
		html_string += '</td>';					
		html_string += '<td><input name="api_url_'+new_counter+'" type="text" class="" style="width:90%" id="api_url_'+new_counter+'" /></td>';
		html_string += '<td><input name="api_name_'+new_counter+'" type="text" class="" style="width:90%" id="api_name_'+new_counter+'" /></td>';
		html_string += '<td><input name="user_id_'+new_counter+'" type="text" class="" style="width:90%" id="user_id_'+new_counter+'" /></td>';
		html_string += '<td><input name="channel_id_'+new_counter+'" type="text" class="" style="width:90%" id="channel_id_'+new_counter+'" /></td>';
		html_string += '<td><input name="password_'+new_counter+'" type="text" class="" style="width:90%" id="password_'+new_counter+'" /></td>';
		html_string += '</tr>';

	jQuery('#api_info_' + counter).after(html_string);
	jQuery('#api_info_counter').val(new_counter);
	
}
function delete_row_api(row_id) {
	jQuery('#api_info_' + row_id).hide();
	jQuery('#api_info_delete_' + row_id).val(1);
}
 </script>
<? require_once('menu.php');?>
    <div style="width:60%;margin:auto; clear:both">
		<div id="error" style="width:30%;height:20px; float:right; display:none"></div>
	</div>
    <div  style=" width:95%; margin:auto;clear:both">
       <form id="form" method="post" action="#" >
	   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?
				$str="SELECT * FROM users_info_config where id=1";
				$qry=$this->db->query($str);
				$row=$qry->row();
			?>
            <table  align="center" width="100%" border="0">
                    <tr style="background-color: #E4E4E4; height:35px; text-align:center"><td colspan="3"><strong>Api Config</strong></td></tr>
                    <tr>
                    	<td colspan="3">
                    		<?php if (!empty($api)): ?>
								<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
									<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
										<input type="hidden" id="add_edit" name="add_edit" value="1">
										<tbody>
											<tr>
												<td width="2%" style="font-weight: bold;text-align:center">D</td>
												<td width="10%" style="font-weight: bold;text-align:center">Active Status<span style="color:red">*</span></td>
												<td width="10%" style="font-weight: bold;text-align:center">Dev/Live<span style="color:red">*</span></td>
												<td width="10%" style="font-weight: bold;text-align:center">Api Type<span style="color:red">*</span></td>
												<td width="20%" style="font-weight: bold;text-align:center">Api Url<span style="color:red">*</span></td>
												<td width="10%" style="font-weight: bold;text-align:center">Api/DB Name<span style="color:red">*</span></td>
												<td width="10%" style="font-weight: bold;text-align:center">User Id<span style="color:red">*</span></td>
												<td width="10%" style="font-weight: bold;text-align:center">Port/Channel Id<span style="color:red">*</span></td>
												<td width="10%" style="font-weight: bold;text-align:center">Password<span style="color:red">*</span></td>
											</tr>
											<?php $cot=1; foreach ($api as $key): ?>
												<tr id="api_info_<?=$cot;?>">
													<?php if ($cot>1): ?>
														<td align="left">
														<img src="<?=base_url()?>images/delete-New.png" alt="Delete" onclick="delete_row_api(<?=$cot?>)" style="cursor:pointer;">
														</td>
													<?php else: ?>
														<td align="left">
														</td>
													<?php endif ?>
													<td>
														<input type="checkbox" id="active_sts_<?=$cot;?>" name="active_sts_<?=$cot;?>" value="1" <?php if($key->active_sts==1){echo "checked";}?>>
													</td>
													<td>
														<input type="hidden" id="api_info_delete_<?=$cot;?>" name="api_info_delete_<?=$cot;?>" value="0">
														<input type="hidden" id="api_info_edit_<?=$cot;?>" name="api_info_edit_<?=$cot;?>" value="<?=isset($key->id)?$key->id:''?>">
		                        						<select style="width:98%" name="dev_live_<?=$cot;?>" id="dev_live_<?=$cot;?>">
												      	<option value="">Select Dev/Live</option>
												      		<?php 
												      			for ($i=0; $i <count($dev_live) ; $i++) 
												      			{ ?>
												      				<option value="<?=$dev_live[$i]?>" <?php if ($dev_live[$i] == $key->dev_live) echo "selected"; ?> ><?=$dev_live[$i]?></option>
												      			<?}
												      		 ?>
												      	</select>
													</td>
													<td>
													<select style="width:98%" name="api_type_<?=$cot;?>" id="api_type_<?=$cot;?>">
												      	<option value="">Select Api Type</option>
												      		<?php 
												      			for ($i=0; $i <count($api_type) ; $i++) 
												      			{ ?>
												      				<option value="<?=$api_type[$i]?>" <?php if ($api_type[$i] == $key->api_type) echo "selected"; ?> ><?=$api_type[$i]?></option>
												      			<?}
												      		 ?>
												      </select>
													</td>
													<td><input name="api_url_<?=$cot;?>" type="text" class="" style="width:90%" id="api_url_<?=$cot;?>" value="<?=isset($key->api_url)?$key->api_url:''?>"/></td>
													<td><input name="api_name_<?=$cot;?>" type="text" class="" style="width:90%" id="api_name_<?=$cot;?>" value="<?=isset($key->api_name)?$key->api_name:''?>"/></td>
													<td><input name="user_id_<?=$cot;?>" type="text" class="" style="width:90%" id="user_id_<?=$cot;?>" value="<?=isset($key->user_id)?$key->user_id:''?>"/></td>
													<td><input name="channel_id_<?=$cot;?>" type="text" class="" style="width:90%" id="channel_id_<?=$cot;?>" value="<?=isset($key->channel_id)?$key->channel_id:''?>"/></td>
													<td><input name="password_<?=$cot;?>" type="text" class="" style="width:90%" id="password_<?=$cot;?>" value="<?=isset($key->password)?$key->password:''?>"/></td>
												</tr>
											<?php $cot++; endforeach ?>
											<input type="hidden" name="api_info_counter" id="api_info_counter" value="<?=$cot-1?>">
										</tbody>
										<tfoot>
		                    				<tr id="add_guarantor_row">
		                    					<td colspan="11" style="text-align: right">
		                    						Add More <input tabindex="" type="button" title="Add More" onClick="add_more_api()" class="addmore"><br>
		                    					</td>
		                    				</tr>
		                    			</tfoot>
									</table>
								</div>
							<?php else: ?>
								<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
									<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
										<tbody>
											<input type="hidden" id="add_edit" name="add_edit" value="0">
											<input type="hidden" name="api_info_counter" id="api_info_counter" value="1">
											<tr>
												<td width="10%" style="font-weight: bold;text-align:center">Active Status<span style="color:red">*</span></td>
												<td width="10%" style="font-weight: bold;text-align:center">Dev/Live<span style="color:red">*</span></td>
												<td width="10%" style="font-weight: bold;text-align:center">Api Type<span style="color:red">*</span></td>
												<td width="20%" style="font-weight: bold;text-align:center">Api Url<span style="color:red">*</span></td>
												<td width="10%" style="font-weight: bold;text-align:center">Api Name<span style="color:red">*</span></td>
												<td width="10%" style="font-weight: bold;text-align:center">User Id<span style="color:red">*</span></td>
												<td width="10%" style="font-weight: bold;text-align:center">Channel Id<span style="color:red">*</span></td>
												<td width="10%" style="font-weight: bold;text-align:center">Password<span style="color:red">*</span></td>
											</tr>
											<tr id="api_info_1">
													<td></td>
													<td>
														<input type="checkbox" id="active_sts_1" name="active_sts_1" value="1" checked>
													</td>
													<td>
														<input type="hidden" id="api_info_delete_1" name="api_info_delete_1" value="0">
														<input type="hidden" id="api_info_edit_1" name="api_info_edit_1" value="0">
		                        						<select style="width:98%" name="dev_live_1" id="dev_live_1">
												      	<option value="">Select Dev/Live</option>
												      		<?php 
												      			for ($i=0; $i <count($dev_live) ; $i++) 
												      			{ ?>
												      				<option value="<?=$dev_live[$i]?>" ><?=$dev_live[$i]?></option>
												      			<?}
												      		 ?>
												      	</select>
													</td>
													<td>
													<select style="width:98%" name="api_type_1" id="api_type_1">
												      	<option value="">Select Api Type</option>
												      		<?php 
												      			for ($i=0; $i <count($api_type) ; $i++) 
												      			{ ?>
												      				<option value="<?=$api_type[$i]?>" ><?=$api_type[$i]?></option>
												      			<?}
												      		 ?>
												      </select>
													</td>
													<td><input name="api_url_1" type="text" class="" style="width:90%" id="api_url_1" /></td>
													<td><input name="api_name_1" type="text" class="" style="width:90%" id="api_name_1" /></td>
													<td><input name="user_id_1" type="text" class="" style="width:90%" id="user_id_1" /></td>
													<td><input name="channel_id_1" type="text" class="" style="width:90%" id="channel_id_1" /></td>
													<td><input name="password_1" type="text" class="" style="width:90%" id="password_1" /></td>
											</tr>
										</tbody>
										<tfoot>
		                    				<tr id="add_guarantor_row">
		                    					<td colspan="11" style="text-align: right">
		                    						Add More <input tabindex="" type="button" title="Add More" onClick="add_more_api()" class="addmore"><br>
		                    					</td>
		                    				</tr>
		                    			</tfoot>
									</table>
								</div>
							<?php endif ?>
                    	</td>
                    </tr>
                    <tr>
                    	<td colspan="3" style="text-align:center"><br/><input type="button" value="Update" id="sendButton_gsit" onClick="click_button('api')" class="btn-small btn-small-normal enabledElem" /> <span id="loading_gsit" style="display:none"><img src="<?=BASE_URL_CSS?>images/loader.gif" align="bottom"></span><br/><br/><br/></td>
                    </tr>
                </table><br/><br/><br/>
                <input name="btn_type" type="hidden" id="btn_type" value=""  />
        </form>

    </div>
 <script>

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
					url: "<?=base_url()?>settings/apc_update",
					
					data : postdata,
					datatype: "json",
					success: function(response){
						if(response!='OK')
						{
							$("#sendButton_"+val).show();
							$("#loading_"+val).hide();
							alert(response);
							if(val=='isit')
							{
								$("#User_Id_4_isit").focus();
							}
							return false
						}
						$("#error").show();
						$("#error").fadeOut(12500);
						$("#error").html('<img align="absmiddle" src="<?=BASE_URL_CSS?>images/drag.png" border="0" /> &nbsp;Successfully Updated');
						$("#sendButton_"+val).show();
						$("#loading_"+val).hide();
					}
				});

			return false
		}
	}


	 function frm_validatiiion(val)
	 {
		if (val=='api')
		{
			var total_row = jQuery('#api_info_counter').val();
			for (i=1;i<=total_row;i++) 
			 {
			 	if(jQuery('#api_info_delete_'+i).val()==0) 
			 	{
			 		if (jQuery('#dev_live_'+i).val() == '' || jQuery('#dev_live_'+i).val() == 0 || jQuery('#dev_live_'+i).val() == null || jQuery('#dev_live_'+i).val() == 'undefined') {
			    		alert('Dev/Live is required!');
			    		jQuery('#dev_live_'+i).focus();
			    		return;
			    	}
			    	if (jQuery('#api_type_'+i).val() == '' || jQuery('#api_type_'+i).val() == 0 || jQuery('#api_type_'+i).val() == null || jQuery('#api_type_'+i).val() == 'undefined') {
			    		alert('Api Type is required!');
			    		jQuery('#api_type_'+i).focus();
			    		return;
			    	}
					if(jQuery.trim(jQuery('#api_url_'+i).val())=='')
					{
						alert('Url Required');
						jQuery('#api_url_'+i).focus();
						return false;
					}
					if(jQuery.trim(jQuery('#api_name_'+i).val())=='')
					{
						alert('Api Name Required');
						jQuery('#api_name_'+i).focus();
						return false;
					}
					if(jQuery.trim(jQuery('#user_id_'+i).val())=='')
					{
						alert('User ID Required');
						jQuery('#user_id_'+i).focus();
						return false;
					}
					if(jQuery.trim(jQuery('#channel_id_'+i).val())=='')
					{
						alert('Channel ID Required');
						jQuery('#channel_id_'+i).focus();
						return false;
					}
					if(jQuery.trim(jQuery('#password_'+i).val())=='')
					{
						alert('Password Required');
						jQuery('#password_'+i).focus();
						return false;
					}
			 	} 
			 }
		}
		 return true;

	 }
 </script>
</div>