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
$option='SIT'; 
?>
  <script language="javascript" type="text/javascript">
 function view2() {
    window.open('<?=BASE_URL?>user_search','_blank','resizable=no,status=no,location=no,toolbar=no,menubar=no,width=1300,height=600,top=0,left=300'); 
    return false;
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

                    <tr style="background-color: #E4E4E4; height:35px; text-align:center"><td colspan="3"><strong>Global</strong></td></tr>
                    <tr style="height:30px">
                        <td style="text-align:right" width="38%"><strong> Session Idle Time in Minutes:</strong></td>
                        <td width="40%" style="background-color: #E6F2FF; padding-left:10px"><input name="global_si_time" type="text" onkeypress="return numbersonly44(this,event,true)" id="global_si_time" value="<?=$row->global_session_time?>"  class="text-input" />
                        </td>
                        <td ><input type="button" value="Update" id="sendButton_gsit" onClick="click_button('gsit')" class="btn-small btn-small-normal enabledElem" /> <span id="loading_gsit" style="display:none"><img src="<?=BASE_URL_CSS?>images/loader.gif" align="bottom"></span></td>
                    </tr>

                    <tr style="background-color:white"><td colspan="3">&nbsp;</td></tr>

                    <tr style="background-color: #E4E4E4; height:35px; text-align:center"><td colspan="3"><strong>Individual User ID</strong></td></tr>
                    <tr style="height:30px">
                        <td style="text-align:right"><strong>User ID:</strong></td>
                        <td style="background-color: #E6F2FF; padding-left:10px" >
                       <input name="User_Id_4_isit" type="text" id="User_Id_4_isit" value="" size="15"  class="text-input" /><a onClick="view2()" href="#" style="text-decoration: none !important;" >&nbsp;<img style="vertical-align: top;" src="<?=BASE_URL_CSS?>images/user-search.png" > </a>
                       </td>
                        <td rowspan="2"><input type="button" value="Update" id="sendButton_isit" onClick="click_button('isit')" class="btn-small btn-small-normal enabledElem" /> <span id="loading_isit" style="display:none"><img src="<?=BASE_URL_CSS?>images/loader.gif" align="bottom"></span></td>
                    </tr>
                    <tr style="height:30px">
                        <td style="text-align:right"><strong>Session Idle Time in Minutes:</strong></td>
                        <td style="background-color: #E6F2FF; padding-left:10px">
                        <input name="user_id_isit" type="text" onkeypress="return numbersonly44(this,event,true)" id="user_id_isit" value="" size="15"  class="text-input" /></td>

                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: left"><br></td>
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
					url: "<?=base_url()?>settings/sit_update",
					
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