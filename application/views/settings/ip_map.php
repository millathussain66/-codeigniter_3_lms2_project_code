<? require_once('common.php')?>
<? require_once('header.php')?>
<? require_once('header_body.php')?>

<div id="content"> 
<? 
$option='IP_MAP'; 

require_once('menu.php')?>

    <div style="width:100%;margin:auto; clear:both">
		<div id="error" style="width:25%;height:20px; float:right; display:none"></div>
	</div>
    <div  style=" width:95%; margin:auto;clear:both">
       <form class="form" id="form" method="post" action="#" style="font-size: 13px; font-family: Verdana; width: 700px;">
            
            <? 
				$str="Select ".BRANCH_ID.",".BRANCH_NAME.", ".BRANCH_TB_NAME." where ".BRANCH_STS."=1 order by ".BRANCH_NAME." ASC";
				$qry=mysql_query($str);
			?>		
            	<table  align="center" width="90%" border="0" style="border-collapse:collapse" cellpadding="2" cellspacing="1">
                    
                    <tr style="background-color: #E4E4E4; height:35px; text-align:center"><td colspan="3"><strong>IP 3rd Octet vs Branch Location Mapping</strong></td></tr>
                    <tr style="background-color: #E4E4E4; height:35px; text-align:center">
                    	<td width="10%">SL</td>
                        <td width="40%">Branch Name</td>
                        <td>3rd Octet (Multiple input separated by comma)</td>
                    </tr>
            </table>
            	 <div  style="height:270px; overflow:auto">	
                    <table  align="center" width="90%" border="1" style="border-collapse:collapse" cellpadding="2" cellspacing="1">
                    
                   
                   <? $counter=1;
				   while($row=mysql_fetch_array($qry))
				   {?>
                    <tr style="height:30px">
                    	<td style="text-align:right" ><?=$counter?>
                        	<input name="brn_id<?=$counter?>" type="hidden" id="brn_id<?=$counter?>" value="<?=$row[BRANCH_ID]?>"  /></td>
                        <td style="text-align:right" ><?=$row[BRANCH_NAME]?></td>
                        <td style="background-color: #E6F2FF; padding-left:10px"><input name="IP_3octet<?=$counter?>" type="text" onkeypress="return numbersonly(this,event,true)" id="IP_3octet<?=$counter?>" value="<?=$row['IP_3octet']?>"  class="text-input" />
                        </td>
                    </tr>
                <? $counter++;}?>
                  
                </table>
                 </div>
                 <table  align="center" width="90%" border="0" style="border-collapse:collapse" cellpadding="2" cellspacing="1">                    
                    <tr style="background-color:white"><td colspan="3">&nbsp;</td></tr>
                    
                    <tr style="background-color: #E4E4E4; height:35px; text-align:center"><td colspan="3"><input type="button" value="Update" id="sendButton_IP_MAP" onClick="click_button('IP_MAP')" class="btn-small btn-small-normal enabledElem" /> <span id="loading_IP_MAP" style="display:none"><img src="<?=BASE_URL?>images/loader.gif" align="bottom"></span></td></tr>
            </table>
                <input name="counter" type="hidden" id="counter" value="<?=$counter?>"  />
                <input name="btn_type" type="hidden" id="btn_type" value="IP_MAP"  />
        </form>
       
    </div>
 <script>

	function click_button(val) 
	{		
		if(frm_validatiiion(val)==true)
		{
			$("#sendButton_"+val).hide();
			$("#loading_"+val).show();
			$("#error").stop(true, true);
			var postdata = jQuery('#form').serialize(); 
			$.ajax({
					type: "POST",
					cache: false,
					url: "<?=BASE_URL?>update_functions.php",
					data : postdata,
					datatype: "json",
					success: function(response){
						if(response!='OK')
						{								
							$("#sendButton_"+val).show();
							$("#loading_"+val).hide();
							alert(response);
							return false
						}
						$("#error").show();
						$("#error").fadeOut(12500);
						$("#error").html('<img align="absmiddle" src="<?=BASE_URL?>images/drag.png" border="0" /> &nbsp;Successfully Updated');	
						$("#sendButton_"+val).show();
						$("#loading_"+val).hide();			
					}
				});	
		
			return false
		}
	 }
	
 
	 function frm_validatiiion(val) 
	 {
		var counter=0;
		for( var i=1; i<$("#counter").val(); i++)
		{
			 if($("#IP_3octet"+i).val()!='')
			 {
				 counter++;				 
				 if($("#IP_3octet"+i).val().length>3)
				 {
					var split_ary=$("#IP_3octet"+i).val().split(",");
					for(var j=0; j<split_ary.length; j++)
					{
						if(split_ary[j].length>3 || split_ary[j]=='')
				 		{	
							 alert("Please enter valid 3rd Octet");
							 $("#IP_3octet"+i).focus();
							 return false;
						}
					}
				 }
			 }
		}
		if(counter==0){
			 alert("Please enter at least one valid 3rd Octet");
			 $("#IP_3octet1").focus();
			 return false;
		}		
		return true;		
	 }
 </script>   
    
    
</div>
    
<? require_once('footer.php')?>