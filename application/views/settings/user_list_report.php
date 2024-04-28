<div id="content">
<?
$option='list_r';

require_once('menu.php')?>
    <div style="width:100%;margin:auto; clear:both">
		<div id="error" style="width:25%;height:20px; float:right; display:none"></div>
	</div>
    <div  style=" width:95%; margin:auto;clear:both;padding-top:13px;">
       <form id="form" method="post" action="" >
       	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?
				$limit=" limit 0 ";
				$where=" where u.".USER_TB_STS_NAME."=1 ";
				$activities_list='';
				$activities_list=$this->security->xss_clean(isset($_POST['activities_list'])?$this->security->xss_clean($_POST['activities_list']):'0');
				if($activities_list!='0')
				{
					if($activities_list=='1')
					{
						$where.=" and u.".USER_BLOCK_STS."='0' and u.".USER_LOCK_STS."='0' ";
					}
					else if($activities_list=='2')
					{
						$where.=" and u.".USER_BLOCK_STS."='1' ";
					}
					else if($activities_list=='3')
					{
						$where.=" and u.".USER_LOCK_STS."='1' ";
					}


					
				}


				if(count($_POST)>0)
				{
					$limit=" ";
				}

				 $str="SELECT u.id, u.".USER_ID_NAME." as userId,u.".USER_NAME." as userName,
				case when  u.lock_status = 1 then
	             'Lockout' else
	             case when  u.block_status = 1 then  'Inactive' else  'Active' end end
              	as Sts
				FROM ".USER_TB_NAME." u  ".$where."  order by u.".USER_ID_NAME." ASC ".$limit;
				//echo $str;exit;
				$qry=$this->db->query($str);
			?>
            <table   border="1" style="border-collapse:collapse; width:47%" cellpadding="2" cellspacing="1">

                    <tr style="background-color: #E4E4E4; text-align:left">
                    	<td style="text-align:right"><strong>Status:</strong></td>
                        <td>
							<select name="activities_list" id="activities_list" style="width:95%">
								<option <? if($activities_list=='0'){echo 'selected';}?> value="0">ALL</option>
								<option <? if($activities_list=='1'){echo 'selected';}?> value="1">Active</option>
								<option <? if($activities_list=='2'){echo 'selected';}?> value="2">Inactive/Block</option>
								<option <? if($activities_list=='3'){echo 'selected';}?> value="3">Lockout/Wrong Password</option>
							</select>
						</td>
                        <td style="text-align:center"><input type="button" value="Show" id="sendButton_IP_MAP" onClick="click_button()" class="btn-small btn-small-normal enabledElem" /> <span id="loading_IP_MAP" style="display:none"><img src="<?=BASE_URL_IMAGE?>images/loader.gif" align="bottom"></span></td>
                        <?php 
							
							$activities_list=$activities_list!=''?$activities_list:0;
							

						 ?>
							<td>
                            &nbsp;
                            <?php if(count($_POST)>0){?>
            	<a href="<?=base_url().'settings/xl_user_list_report/'.$activities_list?>" style="text-align:center;cursor:pointer;" target="_blank" ><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></a>
                			<? }?>
            	</td>
        		
                    </tr>

                   </table>
                   <br>
				   <div style="width:100%;height:320px;overflow:auto;">
                   <table  align="center" width="100%" border="1" style="border-collapse:collapse" cellpadding="2" cellspacing="1">
                    <tr style="background-color: #E4E4E4; height:35px; text-align:left; font-weight:bold">
                    	<td width="5%" align="center"/>SL</td>
                        <td width="10%">User ID</td>
                        <td width="30%">Name</td>
                        <td width="10%">Status</td>
                        <td width="20%">Updated Date</td>
                        <td width="25%">Description</td>
                    </tr>
                   <? $counter=1;
				    //echo '<pre>'; print_r($qry->result_array());
				    foreach($qry->result_array() as $row)
				   {
						$date_time=''; $Description='';
						if($row['Sts']!='Active'){
							if($row['Sts']=='Inactive'){$activities_id=49;}else{$activities_id=54;}
							$str_inr="select activities_datetime,description_activities from user_activities_history
							where activities_id=".$activities_id." and table_name='users_info' and table_row_id='".$row['id']."' LIMIT 1";
							if($qry_inr = $this->db->query($str_inr))
							{
								$obj = $qry_inr->row();
								if(is_object($obj)){
									$date_time=date('d-M-Y, h:i:s a',strtotime($obj->activities_datetime));
									$Description=$obj->description_activities;
								}
							}
						}
					?>
                    <tr class="hoverrow" style="font-size:8pt">
                    	<td style="text-align:center"><?=$counter?></td>
                        <td style="text-align:left"><?=$row['userId']?></td>
                        <td style="text-align:left"><?=$row['userName']?></td>
                        <td style="text-align:left"><?=$row['Sts']?></td>
                        <td style="text-align:left"><?=$date_time?></td>
                        <td style="text-align:left"><?=$Description?></td>
                    </tr>
                <? $counter++;}?>

                    <? if(count($_POST)>0 && $qry->num_rows()<=0){?>
                    <tr>
                        <td colspan="7" style="text-align: center">No Results Found</td>
                    </tr>
                    <? }?>
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

		return true;
	 }
 </script>

</div>

<? require_once('footer.php')?>