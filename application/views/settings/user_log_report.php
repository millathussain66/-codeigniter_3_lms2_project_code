<div id="content">
<?
$option='log_r';

require_once('menu.php');?>
    <div style="width:100%;margin:auto; clear:both">
		<div id="error" style="width:25%;height:20px; float:right; display:none"></div>
	</div>
    <div style=" width:95%; margin:auto;clear:both;padding-top:13px;">
       <form id="form" method="post" action="" >
	   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?
				$limit=" limit 0 ";
				$where=' where 1=1 ';
				$activities_list='';

				if(isset($_POST['activities_list']) && trim($_POST['activities_list'])!='')
				{
					$where.=" and ac_h.".USER_ID_NAME."='".trim($_POST['activities_list'])."' ";
					$activities_list=$_POST['activities_list'];
				}

				if(isset($_POST['dt_from']) && $_POST['dt_from']!='' && $_POST['dt_to']=='')
				{
					$dat_from_ary=explode("/",$_POST['dt_from']);
					$where.=" AND DATE(ac_h.login_datetime) = '".date('Y-m-d',strtotime(str_replace('/','-',$_POST['dt_from'])))."'";
				}
				if(isset($_POST['dt_from']) && $_POST['dt_from']!='' && $_POST['dt_to']!='')
				{
					$dat_from_ary=explode("/",$_POST['dt_from']);
					$dat_to_ary=explode("/",$_POST['dt_to']);
					$where.=" AND DATE(ac_h.login_datetime) >='".date('Y-m-d',strtotime(str_replace('/','-',$_POST['dt_from'])))."' AND DATE(ac_h.LOGIN_DATETIME) <= '".date('Y-m-d',strtotime(str_replace('/','-',$_POST['dt_to'])))."' ";
				}

				if(count($_POST)>0)
				{
					$limit=" ";
				}

				$str=" SELECT u.".USER_ID_NAME." as userId,u.".USER_NAME." as userName,  ac_h.*,
						ac_h.last_activities as last_activities_1,
						ac_h.login_datetime as login_datetime_1
						FROM user_log_history ac_h
						LEFT OUTER JOIN ".USER_TB_NAME." u ON ac_h.user_id=u.".USER_ID." ".$where." order by ac_h.login_datetime DESC ".$limit;
				///echo $str; //exit;
				$qry=$this->db->query($str);

			?>
            		<table   border="1" style="border-collapse:collapse; width:98%" cellpadding="2" cellspacing="1">
                    <tr style="background-color: #E4E4E4; text-align:left">
                    	<td style="text-align:right"><strong>User:</strong></td>
                        <td  width="30%">
                        	<select name="activities_list" id="activities_list" style="width:95%">
                        	<option value="">ALL</option>
							<?
                            $str_act="Select u.".USER_ID." as Id, u.".USER_ID_NAME." as userId,u.".USER_NAME." as userName
									from ".USER_TB_NAME." u where u.".USER_TB_STS_NAME."=1 order by u.".USER_NAME." ASC";
                           $qry_act=$this->db->query($str_act);
                            foreach($qry_act->result_array() as $row_act)
							{
								if($activities_list==$row_act['Id']){ $selected="selected";}else{$selected="";}
                            	echo '<option '.$selected.' value="'.$row_act['Id'].'">'.$row_act['userName'].' ('.$row_act['userId'].')</option>';
                            }
                            ?>
                        </select></td>
                        <td  style="text-align:right"><strong>Date:</strong></td>
					<td ><input name="dt_from" type="text" id="dt_from" value="<?=isset($_POST['dt_from'])?$_POST['dt_from']:''?>"  maxlength="10" size="10" /><script type="text/javascript" charset="utf-8">datePicker ("dt_from");</script></td>
					<td ><input name="dt_to" type="text" id="dt_to" value="<?=isset($_POST['dt_to'])?$_POST['dt_to']:''?>"  maxlength="10" size="10" />
						<script type="text/javascript" charset="utf-8">datePicker ("dt_to");</script>
						</td>
                        <td style="text-align:center"><input type="button" value="Show" id="sendButton_IP_MAP" onClick="click_button('IP_MAP')" class="btn-small btn-small-normal enabledElem" /> <span id="loading_IP_MAP" style="display:none"><img src="<?=BASE_URL_CSS?>images/loader.gif" align="bottom"></span></td>
                        <?php if (count($qry->result_array()) >0) {
							$FromDate = isset($_POST['dt_from'])?$_POST['dt_from']!=''?$_POST['dt_from']:0:0;
							$ToDate=isset($_POST['dt_to'])?$_POST['dt_to']!=''?$_POST['dt_to']:0:0;
							$activities_list=$activities_list!=''?$activities_list:0;
							$FromDate=str_replace('/','-',$FromDate);
							$ToDate=str_replace('/','-',$ToDate);
							$FromDate = implode('-',array_reverse(explode('-',$FromDate)));
        			$ToDate = implode('-',array_reverse(explode('-',$ToDate)));

						 ?>
							<td>
            	<a href="<?=base_url('index.php/settings/xl_user_log_report/'.$activities_list)?>/<?=isset($_POST['user_id'])?$_POST['user_id']:0?>/<?=$FromDate?>/<?=$ToDate?>" style="text-align:center;cursor:pointer;" target="_blank" ><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></a>
            	</td>
        		<?php } ?>
                    </tr>
                   </table>
                   <br>
					<div style="width:100%;height:320px;overflow:auto;">
                   <table  align="center" width="100%" border="1" style="border-collapse:collapse" cellpadding="2" cellspacing="1">
                    <tr style="background-color: #E4E4E4; height:35px; text-align:left; font-weight:bold">
                    	<td width="3%">SL</td>
                        <td width="8%">User ID</td>
                        <td width="25%">Name</td>
                        <td width="12%">IP</td>
                        <td width="17%">Login Date Time</td>
                        <td width="17%">logout Date Time</td>
                        <td width="10%">Duration</td>
                        <td width="8%" style="text-align:center">Logout Status</td>
                    </tr>
                   <? $counter=1;
				    //echo '<pre>'; print_r($qry->result_array());
				    foreach($qry->result_array() as $row)
						{
				   	$datetime1 = new DateTime($row['login_datetime_1']);
					$datetime2 = new DateTime($row['last_activities_1']);
					$interval = $datetime1->diff($datetime2);
				   	?>
                    <tr class="hoverrow" style="font-size:8pt">
                    	<td style="text-align:left" ><?=$counter?></td>
                        <td style="text-align:left"><?=$row['userId']?></td>
                        <td style="text-align:left"><?=$row['userName']?></td>
                        <td style="text-align:left"><?=$row['ip_address']?></td>
                        <td style="text-align:left"><?=$row['login_datetime_1']?></td>
                        <td style="text-align:left"><?=$row['last_activities_1']?></td>
                        <td style="text-align:left"><? echo $interval->format('%h')." Hours ".$interval->format('%i')." Minutes"; ?></td>
                        <td style="text-align:center"><? if($row['logout_status']=='1'){echo 'Yes';}else{echo 'No';}?></td>
                    </tr>
                <? $counter++;}?>

                    <? if(count($_POST)>0 && $qry->num_rows()<=0){?>
                    <tr>
                        <td colspan="8" style="text-align: center">No Results Found</td>
                    </tr>
                    <?
					}?>
                </table>
				</div>
                <input name="counter" type="hidden" id="counter" value="<?=$counter?>"  />
                <input name="btn_type" type="hidden" id="btn_type" value=""  />
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

		if($("#dt_from").val()!='')
		{
			if(isDate($("#dt_from").val())==false){
				$("#dt_from").focus();
				return false;
			}
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