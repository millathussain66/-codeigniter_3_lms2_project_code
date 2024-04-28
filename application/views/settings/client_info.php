

<div id="content">
<?
$option='client';

require_once('menu.php')?>
    <div style="width:100%;margin:auto; clear:both">
		<div id="error" style="width:25%;height:20px; float:right; display:none"></div>
	</div>
    <div  style=" width:95%; margin:auto;clear:both">
       <form id="form" method="post" action="#" enctype="multipart/form-data">
       	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?
				$str="SELECT * FROM project_info where id=1";
				$qry=$this->db->query($str);
				$row=$qry->row();
			?>
			<input type="hidden" name="p_logo" id="p_logo" value="0" />
			<input type="hidden" name="c_logo" id="c_logo" value="0" />
			<input type="hidden" name="file_p" id="file_p" value="<? if(isset($row->PROJECT_LOGO)){echo $row->PROJECT_LOGO;}else{echo "";}?>" />
			<input type="hidden" name="file_c" id="file_c" value="<? if(isset($row->PROJECT_CLIENT_LOGO)){echo $row->PROJECT_CLIENT_LOGO;}else{echo "";}?>" />

            <table  align="center" width="100%" border="0">
				<tr style="background-color: #E4E4E4; height:35px; text-align:center">
					<td colspan="4"><strong>Client Information</strong></td>
				</tr>
				 <tr style="height:30px">
					<td style="text-align:right;width:15%"><strong>Project Title:</strong></td>
					<td style="background-color: #E6F2FF; padding-left:1%;width:34%" >
					<input name="PROJECT_TITLE" type="text" id="PROJECT_TITLE" value="<?=isset($row->project_title)?$row->project_title:''?>" size="48"  class="text-input" />
					</td>

					<td style="text-align:right;width:15%"><strong>Project Logo:</strong></td>
					<td style="background-color: #E6F2FF; padding-left:1%;width:34%">
					<!--<input type="file" name="PROJECT_LOGO" id="PROJECT_LOGO"  style="width:291px;height:26px;font-size:13px;border:1px solid #c2c2bc;" accept=""/>-->
					<? if(isset($row->project_logo)){?><a href="<?=BASE_URL_IMAGE?>images/<?=$row->project_logo ?>" target="_blank"> <img style="vertical-align: top;" src="<?=BASE_URL_IMAGE?>images/PreviewIcon.png" > </a> <? } ?>
					</td>
				</tr>
                <tr style="height:30px">
					<td style="text-align:right;width:15%"><strong>Client Name:</strong></td>
					<td style="background-color: #E6F2FF; padding-left:1%;width:34%" >
					<input name="PROJECT_CLIENT_NAME" type="text" id="PROJECT_CLIENT_NAME" value="<?=isset($row->project_client_name)?$row->project_client_name:''?>" size="48"  class="text-input" />
					</td>
					<td style="text-align:right"><strong>Client Address:</strong></td>
					<td style="background-color: #E6F2FF; padding-left:1%">
					<textarea name="PROJECT_CLIENT_ADDRESS" type="text" id="PROJECT_CLIENT_ADDRESS" style="width:96%" ><?=isset($row->project_client_address)?$row->project_client_address:''?></textarea>
					</td>
				</tr>
				<tr style="height:30px">
					<td style="text-align:right;width:15%"><strong>Client Logo:</strong></td>
					<td style="background-color: #E6F2FF; padding-left:1%;width:34%" >
					<!--<input type="file" name="PROJECT_CLIENT_LOGO" id="PROJECT_CLIENT_LOGO"  style="width:292px;height:26px;font-size:13px;border:1px solid #c2c2bc;" accept=""/>-->

					<? if(isset($row->project_client_logo)){?><a href="<?=BASE_URL_IMAGE?>images/<?=$row->project_client_logo ?>" target="_blank"> <img style="vertical-align: top;" src="<?=BASE_URL_IMAGE?>images/PreviewIcon.png" > </a><? } ?>

					</td>
					<td style="text-align:right"><strong>Project Version:</strong></td>
					<td style="background-color: #E6F2FF; padding-left:1%">
					<input name="PROJECT_VERSION" type="text" id="PROJECT_VERSION" value="<?=isset($row->project_version)?$row->project_version:''?>" size="48"  class="text-input" />
					</td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: center"><br/><br/>
						<input type="button" value="Update" id="sendButton_client" onClick="click_button('client')" class="btn-small btn-small-normal enabledElem" />
						<span id="loading_client" style="display:none">
						<img src="<?=BASE_URL_IMAGE?>images/loader.gif" align="bottom"></span>
					</td>
					<td colspan="3" style="text-align: left"><br></td>
				</tr>
			</table>
            <input name="btn_type" type="hidden" id="btn_type" value=""  />
			<input name="count" type="hidden" id="count" value="<?=$row->id?>"  />
        </form>

    </div>
 <script>
$('#PROJECT_LOGO').bind('change', function() {
 			var size=this.files[0].size/1024/1024;
 			//alert(size+'-1.00')
 			if(size>=2.00){
 				alert('File Size too Large!!!! Only 2MB allowed !!')

 				$('#PROJECT_LOGO').val('');
 				 $("#p_logo").val('0');
 			}else{
 				$("#p_logo").val('1');
 			}
          //  alert('This file size is: ' + this.files[0].size/1024/1024 + "MB");

        });
$('#PROJECT_CLIENT_LOGO').bind('change', function() {
 			var size=this.files[0].size/1024/1024;
 			//alert(size+'-1.00')
 			if(size>=2.00){
 				alert('File Size too Large!!!! Only 2MB allowed !!')

 				$('#PROJECT_CLIENT_LOGO').val('');
 				 $("#c_logo").val('0');
 			}else{
 				$("#c_logo").val('1');
 			}
          //  alert('This file size is: ' + this.files[0].size/1024/1024 + "MB");

        });
	function click_button(val)
	{
		$("#btn_type").val(val);
		if(frm_validatiiion(val)==true)
		{
			$("#sendButton_"+val).hide();
			$("#loading_"+val).show();
			$("#error").stop(true, true);

			var formData = new FormData($('#form')[0]);
			$.ajax({
					type: "POST",
					cache: false,
					url: "<?=base_url()?>settings/client_update",
					data : formData,
					datatype: "json",
					contentType: false,
    				processData: false,
					success: function(response){
						if(response!='OK')
						{
							$("#sendButton_"+val).show();
							$("#loading_"+val).hide();
							//alert(response);
							if(val=='client')
							{
								$("#client_name").focus();
							}
							return false
						}
						$("#error").show();
						$("#error").fadeOut(12500);
						$("#error").html('<img align="absmiddle" src="<?=BASE_URL_CSS?>images/drag.png" border="0" /> &nbsp;Successfully Updated');
						$("#sendButton_client").show();
						$("#loading_client").hide();
					}
				});

			return false
		}
	}


	 function frm_validatiiion(val)
	 {
		if(val=='gsit')
		{
			 if($("#global_si_time").val()=='' || $("#global_si_time").val()==0 || $("#global_si_time").val().length<=0)
			 {
				 alert("Please enter valid Global Session Idle Time");
				 $("#global_si_time").focus();
				 return false;
			 }
		}

		if(val=='isit')
		{
			 if($("#User_Id_4_isit").val()=='' || $("#User_Id_4_isit").val()==0 || $("#User_Id_4_isit").val().length<=0)
			 {
				 alert("Please enter valid User ID");
				 $("#User_Id_4_isit").focus();
				 return false;
			 }

			 if($("#user_id_isit").val()=='' || $("#user_id_isit").val()==0 || $("#user_id_isit").val().length<=0)
			 {
				 alert("Please enter valid Individual Session Idle Time");
				 $("#user_id_isit").focus();
				 return false;
			 }
		}
		 return true;

	 }
 </script>


</div>
