<body style="height:98%">
<style type="text/css">
	form{
		font:16px Calibri, Helvetic, sans-serif;
	}
	fieldset { padding: 1em;
			border:1px solid #b6b6b6;
			font:16px Calibri, Helvetic, sans-serif;
			border-radius: 5px;
			}

	legend {
	  padding: 0.2em 0.5em;
	  border:1px solid #9a9a9a;
	  border-radius: 5px;
	  font-size:90%;
	  color: #000 !important;
	  font-weight: bold;
	  text-align:left;
	  }
</style>

<?php
$CI =& get_instance();
$CI->load->model('User_model', '', TRUE);
$CI->load->model('Users_group_model', '', TRUE);
$CI->load->model('User_info_model', '', TRUE);
?>

<script type="text/javascript">
	jQuery(document).ready(function() {
		var csrf_token='';
		<? if($editrow!='' && $data!=''){ ?>
			var data = [<?=$data?>];
			var group_counter = jQuery('#group_counter').val();
			for(var i=1;i<=group_counter;i++){
				var categ_counter = jQuery('#group'+i+'categ_counter').val();
				for(var j=1;j<=categ_counter;j++){
					var input_counter = jQuery('#group'+i+'categ'+j+'input_counter').val();
					for(var k=1;k<=input_counter;k++){
						if(jQuery.inArray(parseInt(jQuery('#group'+i+'categ'+j+'id'+k).val()),data)<0){
							jQuery('#group'+i+'categ'+j+'input'+k).prop('checked', false);
						} else {
							jQuery('#group'+i+'categ'+j+'input'+k).prop('checked', true);
						}
					}
				}
			}
			check_all_fields();

		<? } ?>
			jQuery('#set-default').click(function(){
			if(this.checked) {
				var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
				var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
				jQuery.ajax({
				  url: '<?=base_url()?>user_info/get_working_group_rights/<?=$GROUP_ID?>',
				  type: 'POST',
				  dataType: 'json',
				  async:false,
				  data: {[csrfName]: csrfHash,GROUP_ID: '<?=$GROUP_ID?>'},
				  success: function(datas, textStatus, xhr) {
					//var obj = jQuery.parseJSON(data);
					//console.log(data.SYS_USER_RIGHTID);
					jQuery('.txt_csrfname').val(datas.csrf_token);
					var data = datas.result;//jQuery.parseJSON(datas.result);
					var SYS_USER_RIGHTID = data.sys_user_rightId.split(',');
					var MENU_OPERATION = data.menu_operation.split(',');
					
					var group_counter = jQuery('#group_counter').val();
					for(var i=1;i<=group_counter;i++){
						var categ_counter = jQuery('#group'+i+'categ_counter').val();
						for(var j=1;j<=categ_counter;j++){
							var input_counter = jQuery('#group'+i+'categ'+j+'input_counter').val();
							for(var k=1;k<=input_counter;k++){
								if(jQuery.inArray(jQuery('#group'+i+'categ'+j+'id'+k).val(),SYS_USER_RIGHTID)<0){
									jQuery('#group'+i+'categ'+j+'input'+k).prop('checked', false);
								} else {
									jQuery('#group'+i+'categ'+j+'input'+k).prop('checked', true);
								}
								
							}
						}
					}
					
					check_all_fields();
					
					
					
					
					
					
				  },
				  error: function(xhr, textStatus, errorThrown) {
					//called when there is an error
					alert('Error Occurred')
				  }
				});

			}
		});
		jQuery("#btnSavePurchaseEntry").click(function() {

				jQuery("#btnSavePurchaseEntry").hide();
				jQuery("#loading").show();
				var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
				var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
				var postdata = jQuery('#form').serialize();
				jQuery.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>user_info/set_right_update/<?=$wg_Id?>",
						data : postdata,
						datatype: "json",
						success: function(response){
							//alert(response);
							var json = jQuery.parseJSON(response);
							jQuery('.txt_csrfname').val(json.csrf_token);
							window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
							if(json.Message!='OK')
							{
								jQuery("#btnSavePurchaseEntry").show();
								jQuery("#loading").hide();
								alert(json.Message);
								return false
							}else{

								window.parent.jQuery("#jqxgrid").jqxGrid('clearselection');
								window.parent.jQuery("#error").show();
								window.parent.jQuery("#error").fadeOut(11500);
								jQuery("#loading").hide();
								window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
								window.top.EOL.messageBoard.close();
							}
						}
					});

				return false

		});
	  jQuery('#check-all').click(function(){
		if(this.checked) {
			jQuery(".group").prop('checked', true);
			var group_counter = jQuery('#group_counter').val();
			//alert('group_counter'+group_counter);
			for(var i=1;i<=group_counter;i++){
				jQuery(".group"+i+"categ").prop('checked', true);
				var categ_counter = jQuery('#group'+i+'categ_counter').val();
				//alert('categ_counter'+categ_counter);
				for(var j=1;j<=categ_counter;j++){
					jQuery(".group"+i+"categ"+j+"input").prop('checked', true);
				}
			}
		} else {
			 jQuery(".group").prop('checked', false);
			var group_counter = jQuery('#group_counter').val();
			//alert('group_counter'+group_counter);
			for(var i=1;i<=group_counter;i++){
				jQuery(".group"+i+"categ").prop('checked', false);
				var categ_counter = jQuery('#group'+i+'categ_counter').val();
				//alert('categ_counter'+categ_counter);
				for(var j=1;j<=categ_counter;j++){
					jQuery(".group"+i+"categ"+j+"input").prop('checked', false);
				}
			}
		}

	  });

	  jQuery(".group").change(function() {
			if(this.checked) {
				jQuery("."+this.id+"categ").prop('checked', true);
				var categ_counter = jQuery('#'+this.id+'categ_counter').val();
				//alert('categ_counter'+categ_counter);
				for(var j=1;j<=categ_counter;j++){
					jQuery("."+this.id+"categ"+j+"input").prop('checked', true);
				}
			} else {
				jQuery("."+this.id+"categ").prop('checked', false);
				var categ_counter = jQuery('#'+this.id+'categ_counter').val();
				//alert('categ_counter'+categ_counter);
				for(var j=1;j<=categ_counter;j++){
					jQuery("."+this.id+"categ"+j+"input").prop('checked', false);
				}
			}
			check_all_fields();
		});
		var group_counter = jQuery('#group_counter').val();
		//alert('group_counter'+group_counter);
		for(var i=1;i<=group_counter;i++){
			jQuery(".group"+i+"categ").change(function() {
				if(this.checked) {
						jQuery("."+this.id+"input").prop('checked', true);
				} else {
					jQuery("."+this.id+"input").prop('checked', false);
				}
				check_all_fields();
			});
			var categ_counter = jQuery('#group'+i+'categ_counter').val();
			//alert('categ_counter'+categ_counter);
			for(var j=1;j<=categ_counter;j++){
				jQuery(".group"+i+"categ"+j+"input").change(function() {
					//var parent = jQuery(this).attr('class').replace('input', '');
					//if(this.checked) {
						check_all_fields();
					//} else {
						//jQuery("#"+parent).prop('checked', false);
					//}
				});
			}
		}
		check_all_fields();
});

	function check_all_fields()
	{
		var group_flag = 0;
		var group_counter = jQuery('#group_counter').val();
		for(var i=1;i<=group_counter;i++){
			var categ_flag = 0;
			var categ_counter = jQuery('#group'+i+'categ_counter').val();
			//alert('categ_counter'+categ_counter);
			for(var j=1;j<=categ_counter;j++){
				var input_flag = 0;
				var input_counter = jQuery('#group'+i+'categ'+j+'input_counter').val();
				for(var k=1;k<=input_counter;k++){
					if(jQuery('#group'+i+'categ'+j+'input'+k).prop('checked')==false) {
						input_flag = 1;
						jQuery('#group'+i+'categ'+j+'value'+k).val('0');
					} else {
						jQuery('#group'+i+'categ'+j+'value'+k).val('1');
					}
				}
				if(input_flag){
					jQuery('#group'+i+'categ'+j).prop('checked', false);
					categ_flag = 1;
				} else {
					jQuery('#group'+i+'categ'+j).prop('checked', true);
				}
			}
			if(categ_flag){
					jQuery('#group'+i).prop('checked', false);
					group_flag = 1;
			} else {
				jQuery('#group'+i).prop('checked', true);
			}
		}
		if(group_flag){
			jQuery('#check-all').prop('checked', false);
		} else {
			jQuery('#check-all').prop('checked', true);
		}
	}
</script>
	<form method="post" action="#" style="margin: 30px;" id="form">
		<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		<table width="99%" style="border:1px solid #acacac;background: #e7e7e7;border-radius: 0px;" cellspacing="0" cellpadding="5">
			<tr>
				<td style="text-align: left;" width="49%"><input type="checkbox" id="check-all" ><strong>Select All </strong>&nbsp;<input type="checkbox" id="set-default" ><strong>Set Default Rights(<?=$GROUP_NAME?>)</strong>
				</td>
				<td style="text-align: right;" width="49%"><strong><?=$name?> (<?=$employee_ID?>)</strong></td>
			</tr>
		</table><br />
		<?php
			$GROUP_ID = 0;
			$CATEG_ID = 0;
			$i=$j=$k=1;
			foreach($result as $row)
			{
				if($GROUP_ID != $row['group_id'])
				{
					if($GROUP_ID)
					{  if($k<5){ echo '<td width="'.((4-($k-1))*25).'%">&nbsp;</td>';}?>
								<input type="hidden" name="group<?=$i?>categ<?=$j?>input_counter" id="group<?=$i?>categ<?=$j?>input_counter" value="<?=$k-1?>" />
							</tr></table></fieldset>
							<input type="hidden" name="group<?=$i?>categ_counter" id="group<?=$i?>categ_counter" value="<?=$j?>" />
						</fieldset><br />
					<? $i++;$CATEG_ID = 0;
					} ?>
					<fieldset style="background-color:#F8F8F8 !important; width: 97%;border:1px solid #b6b6b6;">
							<legend style="background-color:#c6c6c6 !important;"><input type="checkbox" name="group<?=$i?>" id="group<?=$i?>" class="group" /><?=$row['group_name']?></legend>
				<? $j=1;
				}
				if($CATEG_ID != $row['categ_id'])
				{
					if($CATEG_ID)
					{
						if($k<5) {echo '<td width="'.((4-($k-1))*25).'%">&nbsp;</td>';}?>
							<input type="hidden" name="group<?=$i?>categ<?=$j?>input_counter" id="group<?=$i?>categ<?=$j?>input_counter" value="<?=$k-1?>" />
						</tr></table></fieldset><br />
					<?  $j++;
					} ?>
					<fieldset style="background-color:#FCFCFC !important;border:1px solid #c6c6c6;">
						<legend style="background-color:#eeeeee !important;"><input type="checkbox" name="group<?=$i?>categ<?=$j?>" id="group<?=$i?>categ<?=$j?>" class="group<?=$i?>categ" /><?=$row['categ_name']?></legend>
						<? $k=1; echo '<table width="100%"><tr>';
				}   ?>
						<td width="25%"><input type="checkbox" name="group<?=$i?>categ<?=$j?>input<?=$k?>" id="group<?=$i?>categ<?=$j?>input<?=$k?>" class="group<?=$i?>categ<?=$j?>input"  /><?=$row['right_name']?>
							<input type="hidden" name="group<?=$i?>categ<?=$j?>id<?=$k?>" id="group<?=$i?>categ<?=$j?>id<?=$k?>" value="<?=$row['id']?>" />
						
							
						<?php 
						$link_details=$CI->User_info_model->system_link_list_details($this->session->userdata['ast_user']['user_id'],$row['id']);?>
						<input type="hidden" name="group<?=$i?>categ<?=$j?>id<?=$k?>details_id" id="group<?=$i?>categ<?=$j?>id<?=$k?>details_id" value="<?=$link_details->link_details_id?>" />
						<input type="hidden" name="group<?=$i?>categ<?=$j?>id<?=$k?>details_link" id="group<?=$i?>categ<?=$j?>id<?=$k?>details_link" value="<?=$link_details->link_details_url?>" />	
						</td>
			<?php
				
					if($k!=1 && $k%4==0){ echo '</tr><tr>'; }
					$k++;
					$GROUP_ID = $row['group_id'];
					$CATEG_ID = $row['categ_id'];
				}
				if($k<5) echo '<td width="'.((4-($k-1))*25).'%">&nbsp;</td>';
			?>
			<input type="hidden" name="group<?=$i?>categ<?=$j?>input_counter" id="group<?=$i?>categ<?=$j?>input_counter" value="<?=$k-1?>" />
			</tr></table></fieldset>
			<input type="hidden" name="group<?=$i?>categ_counter" id="group<?=$i?>categ_counter" value="<?=$j?>" />
		</fieldset><br />
		<input type="hidden" name="group_counter" id="group_counter" value="<?=$i?>" />
		<div align="center">

        <button id="btnSavePurchaseEntry" type="button"  name="btnSavePurchaseEntry" value="Save"  style="border: 0; background: transparent;text-align:left;">
      		<img src="<?=base_url()?>images/btn-save.png" alt="Save"  />
        </button>
        <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
	</form>
