<? require_once('common.php')?>
<? require_once('header.php')?>
<? require_once('header_body.php')?>

<div id="content"> 
<? 
$option='op_r';

require_once('menu.php')?>
    <div style="width:100%;margin:auto; clear:both">
		<div id="error" style="width:25%;height:20px; float:right; display:none"></div>
	</div>
    <div  style=" width:95%; margin:auto;clear:both">
       <form class="form" id="form" method="post" action="" >
	   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?
            $where = ' WHERE 1 ';
            $activities_list = '';
            if(count($_POST)>0)
            {
                if (isset($_POST['activities_list']) && $_POST['activities_list'] != '') {
                    $where .= " and ac_h.sts_by='" . $_POST['activities_list'] . "' ";
                    $activities_list = $_POST['activities_list'];
                }

                if (isset($_POST['dt_from']) && $_POST['dt_from'] != '' && $_POST['dt_to'] == '') {
                    $dat_from_ary = explode("/", $_POST['dt_from']);
                    $where .= " and DATE(ac_h.sts_date)='" . $dat_from_ary[2] . "-" . $dat_from_ary[1] . "-" . $dat_from_ary[0] . "' ";
                }
                if (isset($_POST['dt_from']) && $_POST['dt_from'] != '' && $_POST['dt_to'] != '') {
                    $dat_from_ary = explode("/", $_POST['dt_from']);
                    $dat_to_ary = explode("/", $_POST['dt_to']);
                    $where .= " AND (DATE(ac_h.sts_date) >='" . $dat_from_ary[2] . "-" . $dat_from_ary[1] . "-" . $dat_from_ary[0] . "' AND DATE(ac_h.sts_date)<='" . $dat_to_ary[2] . "-" . $dat_to_ary[1] . "-" . $dat_to_ary[0] . "' ) ";
                }

                $str = "SELECT u." . USER_ID_NAME . " as userId, u." . USER_NAME . " as userName, ac_h.*, b.status
                FROM bill_status_history ac_h
                LEFT OUTER JOIN " . USER_TB_NAME . " u ON (ac_h.sts_by=u." . USER_ID . ")
                LEFT OUTER JOIN ref_bill_status b ON (ac_h.bill_status=b.bill_sts)
                ".$where." order by ac_h.sts_date DESC";
                $qry = mysql_query($str);
            }
			?>
            <table  align="center" border="1" style="border-collapse:collapse; width:650px" cellpadding="2" cellspacing="1">
                <tr style="background-color: #E4E4E4; text-align:left">
                    <td style="text-align:right"><strong>User:</strong></td>
                    <td  width="30%">
                        <select name="activities_list" id="activities_list" style="width:95%">
                        <option value="">ALL</option>
                        <?
                        $str_act="Select u.".USER_ID." as Id, u.".USER_ID_NAME." as userId,u.".USER_NAME." as userName
                        from ".USER_TB_NAME." u where u.".USER_TB_STS_NAME."=1 order by u.".USER_NAME." ASC";
                        $qry_act=mysql_query($str_act);
                        while($row_act=mysql_fetch_array($qry_act))
                        {
                            if($activities_list==$row_act['Id']){ $selected="selected";}else{$selected="";}
                            echo '<option '.$selected.' value="'.$row_act['Id'].'">'.$row_act['userName'].'('.$row_act['userId'].')</option>';
                        }
                        ?>
                    </select></td>
                    <td  style="text-align:right"><strong>Date:</strong></td>
                    <td ><input name="dt_from" type="text" id="dt_from" value="<?=isset($_POST['dt_from'])?$_POST['dt_from']:''?>"  maxlength="10" size="9" />
                        <script type="text/javascript" charset="utf-8">datePicker ("dt_from");</script>
                        &nbsp;&nbsp;To: <input name="dt_to" type="text" id="dt_to" value="<?=isset($_POST['dt_to'])?$_POST['dt_to']:''?>"  maxlength="10" size="9" />
                        <script type="text/javascript" charset="utf-8">datePicker ("dt_to");</script>
                    </td>
                    <td style="text-align:center"><input type="button" value="Show" id="sendButton_IP_MAP" onClick="click_button()" class="btn-small btn-small-normal enabledElem" /> <span id="loading_IP_MAP" style="display:none"><img src="<?=BASE_URL?>images/loader.gif" align="bottom"></span></td>
                </tr>
            </table>
               <br/>
           <table  align="center" width="100%" border="1" style="border-collapse:collapse" cellpadding="2" cellspacing="1">
                <tr style="background-color: #E4E4E4; height:35px; text-align:left; font-weight:bold">
                    <td width="3%">SL</td>
                    <td width="8%">User ID</td>
                    <td width="25%">Name</td>
                    <td width="12%">IP</td>
                    <td width="17%">Bill Status</td>
                    <td width="17%">Comments</td>
                    <td width="17%">Operation Date</td>
                </tr>
               <? $counter=1;
               if(count($_POST)>0)
               {
                   while ($row = mysql_fetch_array($qry)) {
                       ?>
                       <tr class="hoverrow" style="font-size:8pt">
                           <td style="text-align:left"><?= $counter ?></td>
                           <td style="text-align:left"><?= $row['userId'] ?></td>
                           <td style="text-align:left"><?= $row['userName'] ?></td>
                           <td style="text-align:left"><?= $row['ip'] ?></td>
                           <td style="text-align:left"><?= $row['status'] ?></td>
                           <td style="text-align:left"><?= $row['comments'] ?></td>
                           <td style="text-align:left"><?= date('d-M-Y, h:i:s a', strtotime($row['sts_date'])) ?></td>
                       </tr>
                       <? $counter++;
                   }
               }?>
                <? if(count($_POST)>0 && mysql_num_rows($qry)<=0){?>
                <tr>
                    <td colspan="7" style="text-align: center">No Results Found</td>
                </tr>
                <?
                }?>
            </table>
            <input name="counter" type="hidden" id="counter" value="<?=$counter?>"  />
            <input name="btn_type" type="hidden" id="btn_type" value="IP_MAP"  />
        </form>
    </div>

    <script>

	function click_button() 
	{		
		if(frm_validatiiion()==true)
		{
			$("#loading_IP_MAP").show();
			$("#form").submit();	
		}
	 }

	 function frm_validatiiion() 
	 {
         if($("#dt_from").val()=='')
         {
             alert('enter date range!');
             $("#dt_from").focus();
             return false;

         }
		if($("#dt_from").val()!='')
		{
			if(isDate($("#dt_from").val())==false){
				$("#dt_from").focus();
				return false;	
			}
	 	}
         if($("#dt_to").val()=='')
         {
             alert('enter date range!');
             $("#dt_to").focus();
             return false;

         }
		if($("#dt_to").val()!='')
		{
			if(isDate($("#dt_to").val())==false){
				$("#dt_to").focus();
				return false;	
			}
	 	}
						
		return true;		
	 }
 </script>   
    
    
</div>
    
<? require_once('footer.php')?>