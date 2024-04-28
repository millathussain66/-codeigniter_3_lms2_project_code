<div id="content">
<?
$option='UPR';

?>
	<div style="width:60%;margin:auto; clear:both">
		<div id="error" style="width:30%;height:20px; float:right; display:none"></div>
	</div>
    <div  style=" width:100%;  clear:both;padding-top:13px;">
       <form id="form" method="post" action="#" style="width:1115px !important;" >
	   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
         <?
				$limit=" limit 0 ";
				$where=" where u.data_status=1 ";
				$USER_NAME='';
				$WORKING_GROUP='';
				$USER_DEPARTMENT='';
				
				if(isset($_POST['WORKING_GROUP']) && $_POST['WORKING_GROUP']!='')
				{
					$where.=" and u.user_group_id='".$_POST['WORKING_GROUP']."' ";
					$WORKING_GROUP=$_POST['WORKING_GROUP'];
				}
				if(isset($_POST['USER_DEPARTMENT']) && $_POST['USER_DEPARTMENT']!='')
				{
					$where.=" and u.department_id='".$_POST['USER_DEPARTMENT']."' ";
					$WORKING_GROUP=$_POST['USER_DEPARTMENT'];
				}
				
				if(isset($_POST['USER_NAME']) && $_POST['USER_NAME']!='')
				{

					$where.=" and u.name LIKE '%" .$_POST['USER_NAME'] ."%'   ";
					$USER_NAME=$_POST['USER_NAME'];
				}
				if(count($_POST)>0)
				{
					$limit=" ";
				}

				 $str="SELECT u.user_id as USERID,u.name as USERNAME, j1.group_name as GROUP_NAME,
			                        u.picture as USER_PICTURE,
			                         d.name AS DESIGNATION_NAME,
			                         dept.name AS DEPARTMENT_NAME,
				case when  u.lock_status = 1 then
	             'Lockout' else
	             case when  u.block_status = 1 then  'Inactive' else  'Active' end end
              	as Sts
				FROM users_info u
				LEFT JOIN user_group j1
			        ON (u.user_group_id = j1.id)
			    
			   LEFT JOIN ref_designation d
			         ON (u.designation_id = d.id)
			   LEFT JOIN ref_department dept
			         ON (u.department_id = dept.id)
				  ".$where."

				 order by u.name ASC ";
				//echo $str;exit;
				 $qry=$this->db->query($str);
			?>
            <table    border="0" style="border: 1px solid #C0C0C0;margin-top: 10px;width:100%;">

				<tr style="line-height:38px;border: 1px solid black;padding-top: 10px;" >
                	<td style="text-align:right" width="7%"><strong>Name:</strong></td>
					<td  style=" padding-left:4px"><input name="USER_NAME" type="text"  id="USER_NAME" value="<?=$USER_NAME?>"  class="text-input" /></td>

					<td style="text-align:right" width="35%"><strong>Working Group:</strong></td>
					<td style=" padding-left:4px">

					<select name="WORKING_GROUP" id="WORKING_GROUP" style="width: 160px;">
						<option value="">ALL</option>
						<?
						$str_act="SELECT * FROM user_group ORDER BY group_name";
						$qry_act=$this->db->query($str_act);
						foreach($qry_act->result_array() as $row_act)
							{
							if($WORKING_GROUP==$row_act['id']){ $selected="selected";}else{$selected="";}
						echo '<option '.$selected.' value="'.$row_act['id'].'">'.$row_act['group_name'].'</option>';
						}
						?>
					</select>
					</td>

					<td style="text-align:right" width="25%"><strong>Department:</strong></td>
					<td  style=" padding-left:4px">

					<select name="USER_DEPARTMENT" id="USER_DEPARTMENT" style="width: 150px;">
						<option value="">ALL</option>
						<?
						$str_act="SELECT * FROM ref_department ORDER BY name";
						$qry_act=$this->db->query($str_act);
						foreach($qry_act->result_array() as $row_act)
						{
							if($USER_DEPARTMENT==$row_act['id']){ $selected="selected";}else{$selected="";}
						echo '<option '.$selected.' value="'.$row_act['id'].'">'.$row_act['name'].'</option>';
						}
						?>
					</select>
					</td>

					



					<td ><input type="button" style="height:30px;" value="Search" id="sendButton_pvp" onClick="click_button('us')" class="btn-small btn-small-normal enabledElem" /> <span id="loading_pvp" style="display:none"><img src="<?=BASE_URL_CSS?>images/loader.gif" align="bottom"></span></td>
				</tr>


			</table>
			<br>
			<div style="width:100%;height:420px;overflow:auto;">
			 <table  align="center" width="95%" border="1" style="border-collapse:collapse" cellpadding="2" cellspacing="1">
                    <tr style="background-color: #E4E4E4; height:35px; text-align:center; font-weight:bold">
                    	<td width="4%">SL</td>
                        
                        <td>Name</td>
                        <td width="9%">Employee ID</td>
                        <td>Designation</td>
                        <td>Department</td>
                        <td>Working Group</td>
                    </tr>
				<? $counter=1;
				    foreach($qry->result_array() as $row)
				   { ?>
                    <tr class="hoverrow" style="font-size:8pt">
                    	<td style="text-align:center;" ><?=$counter?></td>
                       
                        <td style="text-align:center;"><?=isset($row['USERNAME'])?$row['USERNAME']:''?></td>
                        <td style="text-align:center;"><?=isset($row['USERID'])?$row['USERID']:''?></td>
                        <td style="text-align:center;"><?=isset($row['DESIGNATION_NAME'])?$row['DESIGNATION_NAME']:''?></td>
                        <td style="text-align:center;"><?=isset($row['DEPARTMENT_NAME'])?$row['DEPARTMENT_NAME']:''?></td>
                        <td style="text-align:center;"><?=isset($row['GROUP_NAME'])?$row['GROUP_NAME']:''?></td>
                    </tr>
                <? $counter++;}?>

                    <? if(count($_POST)>0 && $qry->num_rows()<=0){?>
                    <tr>
                        <td colspan="7" style="text-align: center">No Results Found</td>
                    </tr>
                    <? }?>
                </table>
			</div>
            <input name="btn_type" type="hidden" id="btn_type" value=""  />
        </form>

    </div>
  <script language="javascript" type="text/javascript">

function click_button()
	{
		if(frm_validatiiion()==true)
		{
			$("#loading_IP_MAP").show();
			$("#form").submit();
		}
	 }


	 function frm_validatiiion(val)
	 {
	 	return true;
	 }

 </script>

</div>
