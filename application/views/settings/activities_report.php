

<div id="content">
<?
$option='Act_r';

require_once('menu.php');?>
  <script language="javascript" type="text/javascript">
  function view2() {
            window.open('<?=BASE_URL?>user_search','_blank','resizable=no,status=no,location=no,toolbar=no,menubar=no,width=1300,height=600,top=0,left=300'); 
            return false;
         }
 </script>
	<div style="width:60%;margin:auto; clear:both">
		<div id="error" style="width:30%;height:20px; float:right; display:none"></div>
	</div>
    <div  style=" width:95%; margin:auto;clear:both;padding-top:13px;">
       <form id="form" method="post" action="" >
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?
				$limit=" limit 0 ";
				$where=" ac_h.activities_id IS NOT NULL ";
				$activities_list='';
				if(isset($_POST['activities_list']) && $_POST['activities_list']!='')
				{
					$where.=" and ac_h.activities_id='".$_POST['activities_list']."' ";
					$activities_list=$_POST['activities_list'];
				}
				if(isset($_POST['user_id']) && trim($_POST['user_id'])!='')
				{
					$where.=" and u.".USER_ID_NAME."='".trim($_POST['user_id'])."' ";
				}

				if(isset($_POST['dt_from']) && $_POST['dt_from']!='' && $_POST['dt_to']=='')
				{					
					$where.=" AND DATE(ac_h.activities_datetime) = '".date('Y-m-d',strtotime(str_replace('/','-',$_POST['dt_from'])))."'";
				}
				if(isset($_POST['dt_from']) && $_POST['dt_from']!='' && $_POST['dt_to']!='')
				{
					$dat_from_ary=explode("/",$_POST['dt_from']);
					$dat_to_ary=explode("/",$_POST['dt_to']);
					
					$where.=" AND DATE(ac_h.activities_datetime) >='".date('Y-m-d',strtotime(str_replace('/','-',$_POST['dt_from'])))."' AND DATE(ac_h.activities_datetime) <= '".date('Y-m-d',strtotime(str_replace('/','-',$_POST['dt_to'])))."' ";
				}

				if(count($_POST)>0)
				{
					$limit=" ";
				}
				if($where!=""){
					$cont="WHERE";
				}else{
					$cont="";
				}
				$str="SELECT act.name AS actName,u.".USER_ID_NAME." as userId,u.".USER_NAME." as userName,  ac_h.*
					FROM user_activities_history ac_h
					LEFT OUTER JOIN ref_status act ON (ac_h.activities_id=act.id)
					LEFT OUTER JOIN ".USER_TB_NAME." u ON (ac_h.activities_by=u.".USER_ID.") ".$cont." ".$where;
				$str .="ORDER BY ac_h.activities_datetime DESC ".$limit;
				$qry=$this->db->query($str);

			?>
			<table  border="1" style="border-collapse:collapse; width:90%" cellpadding="2" cellspacing="1">
				<tr style="background-color: #E4E4E4; text-align:left">
					<td style="text-align:right"><strong>Activities:</strong></td>
					<td style="width:30%;">
					<select name="activities_list" id="activities_list" style="width:95%">
						<option value="">ALL</option>
						<?
						$str_act="SELECT * FROM ref_status where data_status=1 ORDER BY name ";
						 $qry_act=$this->db->query($str_act);
						 foreach($qry_act->result_array() as $row_act)
                            {
								if($activities_list==$row_act['id']){ $selected="selected";}else{$selected="";}
								echo '<option '.$selected.' value="'.$row_act['id'].'">'.$row_act['name'].'</option>';   
                            }
						
						?>
					</select></td>
					<td style="text-align:right"><strong>User ID:</strong></td>
				<td ><input name="user_id" type="text" id="user_id" value="<?=isset($_POST['user_id'])?$_POST['user_id']:''?>"  maxlength="15" size="15" /><a onClick="view2()" href="#" style="text-decoration: none !important;" >&nbsp;<img style="vertical-align: top;" src="<?=BASE_URL_CSS?>images/user-search.png" > </a></td>
					<td  style="text-align:right"><strong>Date:</strong></td>
					<td ><input name="dt_from" type="text" id="dt_from" value="<?=isset($_POST['dt_from'])?$_POST['dt_from']:''?>"  maxlength="10" size="10" /><script type="text/javascript" charset="utf-8">datePicker ("dt_from");</script></td>
					<td ><input name="dt_to" type="text" id="dt_to" value="<?=isset($_POST['dt_to'])?$_POST['dt_to']:''?>"  maxlength="10" size="10" />
				<script type="text/javascript" charset="utf-8">datePicker ("dt_to");</script>
				</td>
					<td  style="text-align:center"><input type="button" value="Show" id="sendButton_IP_MAP" onClick="click_button('us')" class="btn-small btn-small-normal enabledElem" /> <span id="loading_IP_MAP" style="display:none"><img src="<?=BASE_URL_CSS?>images/loader.gif" align="bottom"></span>
					</td>
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
            	<a href="<?=base_url('index.php/settings/xl_activities_report/'.$activities_list)?>/<?=isset($_POST['user_id'])?$_POST['user_id']:0?>/<?=$FromDate?>/<?=$ToDate?>" style="text-align:center;cursor:pointer;" target="_blank" ><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></a>
            	</td>
        		<?php } ?>
        
			</tr>
			
			</table>
			<br>
			<div style="width:100%;height:320px;overflow:auto;">
				<table  align="center" width="100%" border="1" style="border-collapse:collapse" cellpadding="2" cellspacing="1">
				<tr style="background-color: #E4E4E4; height:35px; text-align:left; font-weight:bold">
					<td width="3%">SL</td>
					<td width="20%">Activities</td>
					<td width="19%">Activities Date & Time</td>
					<td width="10%">IP</td>
					<td width="8%">User ID</td>
					<td width="20%">Name</td>
					<td width="22%">Description</td>
				</tr>
			   <? $counter=1;
					
				  // echo '<pre>'; print_r($qry->result_array());
				  foreach($qry->result_array() as $row)
				   {

				   		$description = $row['description_activities'];
						
						if($row['oprs_reason']!='')
						{
							$description .=' ('.$row['oprs_reason'].')';
						}
			   ?>
				<tr class="hoverrow" style="font-size:8pt">
					<td style="text-align:left" ><?=$counter?></td>
					<td style="text-align:left"><?=$row['actName']?></td>
					<td style="text-align:left"><?=date('d-M-Y h:i:s A',strtotime($row['activities_datetime']))?></td>
					<td style="text-align:left"><?=$row['ip_address']?></td>
					<td style="text-align:left"><?=$row['userId']?></td>
					<td style="text-align:left"><?=$row['userName']?></td>
					<td style="text-align:left"><?=$description?></td>
				</tr>
			<? $counter++;} ?>


				<?
				if(count($_POST)>0 && $qry->num_rows()<=0){?>
				<tr><td colspan="7" style="text-align: center">No Results Found</td></tr>
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

	 	if ($("#dt_from").val()=='' && $("#dt_to").val()=='' && $("#user_id").val()=='')
	 	{
	 		alert('Please Give at least one Parameter');
	 		return false;
	 	}
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
