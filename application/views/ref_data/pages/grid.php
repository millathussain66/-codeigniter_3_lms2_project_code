<?
$CI =& get_instance();
$CI->load->model('User_model', '', TRUE);
$CI->load->model('Ref_data_model', '', TRUE);
$ref_list = $CI->User_model->get_parameter_data('reference_list','reference_name',"data_status = '1'");



?>
<style>
* { padding:0px; margin:0px; }
#footer { position: absolute; !important;}
.ui-datepicker { z-index: 999999 !important; }
/*.jqx-grid-header{height: 50px !important;}*/
</style>
<script type="text/javascript">
var count=0; var maxrow = 0; var displayrow= 0; inc = 0; decr = 0; var arr_ref_list;//global variable
var csrf_token='';
 jQuery(document).ready(function($) {
 	// prepare the data
	 //var theme = 'energyblue';
      var theme = 'classic';
	// Create a jqxDropDownList

	var ref_list = [<? $i=1; foreach($ref_list as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->reference_name.'"}'; $i++;}?>];
	jQuery("#ref_id").jqxComboBox({theme: 'darkblue', promptText: "Select Reference", source: ref_list, width: 320, height: 23, searchMode: 'containsignorecase'});

	jQuery('#ref_id').focusout(function(){
		commbobox_check(jQuery(this).attr('id'));
	});

 //	jQuery("#sendButton2").jqxButton({template:"info", width:"120"});

	jQuery("#refOK").jqxButton({template:"primary",width:"80"});

<?php  
if($submit){ 
//echo '2l'; echo '<pre>'; print_r($ref_name); //exit;
 ?>
	jQuery("#ref_preview").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 800, height: 300, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#refOK") });
<? } ?>
	jQuery("#sendButton").attr('disabled','disabled');
	jQuery("#sendButton2").attr('disabled','disabled');
	
	jQuery('#ref_id').bind('change', function (event){
		if(jQuery(this).val()=='0' || jQuery(this).val()=='')
		{
			jQuery("#sendButton").attr('disabled','disabled');
			jQuery("#sendButton2").attr('disabled','disabled');
		}
		else{ jQuery("#sendButton").removeAttr('disabled'); jQuery("#sendButton2").removeAttr('disabled'); }
		jQuery('#resultdiv').hide();
    });

<?php 

 if($submit || $submit2 ){ ?>
	jQuery('#ref_id').jqxComboBox('val','<?=$ref_id?>');
	jQuery("#sendButton").removeAttr('disabled');
	jQuery("#sendButton2").removeAttr('disabled');
	jQuery('#resultdiv').show();

	var source =
		{
			 datatype: "json",
			 datafields: [
				<?=$datafield?>
			],
				addrow: function (rowid, rowdata, position, commit) {
                    commit(true);
                },
                deleterow: function (rowid, commit) {
                    commit(true);
                },
                updaterow: function (rowid, newdata, commit) {
                    commit(true);
                },
			    url: '<?=base_url()?>ref_data/grid/<?=$ref_name?>',
				cache: false,
				filter: function()
				{
					// update the grid and send a request to the server.
					jQuery("#jqxgrid").jqxGrid('updatebounddata', 'filter');
				},
				sort: function()
				{
					// update the grid and send a request to the server.
					jQuery("#jqxgrid").jqxGrid('updatebounddata', 'sort');
				},
				root: 'Rows',
				id: 'id',
				beforeprocessing: function(data)
				{
					//alert(data);
					if (data != null)
					{
						//alert(data[0].TotalRows)
						source.totalrecords = data[0].TotalRows;
					}
				}
		};
		var dataadapter = new jQuery.jqx.dataAdapter(source, {
				loadError: function(xhr, status, error)
				{
					alert(error);
				}
			});
		var win_h=jQuery( window ).height()-300;
		jQuery("#jqxgrid").jqxGrid(
			{
				width:'99%',
				height:win_h,
				source: dataadapter,
				theme: theme,
				filterable: true,
				sortable: true,
				pageable: true,
				virtualmode: true,
				editable: false,
				enablehover: true,
				enablebrowserselection: true,
				selectionmode: 'none',
				pagesize:10,
				rendergridrows: function(obj)
				{
					 return obj.data;
				},

    			columns: [
				  <?  if(DELETE==1){?>
				  { text: 'D', menu: false, datafield: 'delete', align:'center', editable: false, sortable: false, width: 30,
					cellsrenderer: function (row) {
						editrow = row;
						var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						return '<div style="text-align:center;  cursor:pointer" onclick="delete_records('+dataRecord.id+',\'delete\','+editrow+','+dataRecord.DATA_STATUS+');" ><img align="center" src="<?=base_url()?>images/del.png"></div>';
					  }
				  },
				  <? }?>
				  <?  if(EDIT==1){ ?>
				  { text: 'Edit', menu: false, datafield: 'Edit', columntype: 'number',  sortable: false, width: 40,
					cellsrenderer: function (row) {
						editrow = row;
						var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						//alert(rowid);
						return '<div style="text-align:center;  cursor:pointer" onclick="editt('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit.png"></div>';
					  }
				  },
				  <? }?>
				  { text: 'Preview', menu: true, datafield: 'preview', align:'center', cellsalign:'center', editable: false, sortable: true, width: 60,
						cellsrenderer: function (row) {
							return '<div style="text-align:center;  cursor:pointer" onclick="ref_preview('+row+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';
						 }
					  },
				  <?=$textfield?>

      			]
		});
		
		<? if($submit2){?>
			
			EOL.messageBoard.open('<?=base_url()?>index.php/ref_data/from/add/<?=$ref_id?>/0', (jQuery(window).width()-70), jQuery(window).height(), 'yes');
			
			
		<? } ?>

	<?php } else { ?>
		jQuery('#addButton').hide();
	<?php } ?> 
});
<?php if($submit){ ?>
	function ref_preview(row)
	{

			editrow = row;
			var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);

			<? foreach($fields as $row){ ?>
				jQuery("#<?=$row['field']?>_preview").text(dataRecord.<?=$row['field']?>);
			<? } ?>

			jQuery("#ref_preview").jqxWindow('open');

	}
<? }?>
function checkRef()
{
	var item = jQuery("#ref_id").jqxComboBox('getSelectedItem');

	if(item != null && jQuery("#ref_id").val() != '')
	{
		jQuery("input[name='ref_id']").val(item.value);

		if(item.value=='0' || item.value=='')
		{
			jQuery("#sendButton").attr('disabled','disabled');
			jQuery("#sendButton2").attr('disabled','disabled');
			jQuery("#errormsg").html('&nbsp;<b>Please select a reference!!!</b>');
			return false;
		}
		else
		{
			jQuery("#errormsg").html('');
			return true;
		}
	}
	else
	{
		jQuery("#sendButton").attr('disabled','disabled');
		jQuery("#sendButton2").attr('disabled','disabled');
		jQuery("#errormsg").html('&nbsp;<b>Please select a reference!!!</b>');
		return false;
	}
}

function editt(rowid,rowindex)
{
	jQuery("#jqxgrid").jqxGrid('clearselection');
	var item = jQuery("#ref_id").jqxComboBox('getSelectedItem');
	if(item != null){ refid = item.value; }
	EOL.messageBoard.open('<?=base_url()?>index.php/ref_data/from/edit/'+refid+'/0/'+rowid+'/'+rowindex, (jQuery(window).width()-70), jQuery(window).height(), 'yes');
	return false;
}
			/* message delete */
		var deleteMessageDialog;
		function initDeleteMessageDialog() {
			var handleCancel = function() {
				this.hide();
			};


		  var handleSubmit = function() {
			if($('comments_sts').value=='0' && $('comments').value=='')
			{
				alert('Please enter your comments');
				jQuery('#comments').focus();
				return false;
			}


			$('loading').style.display = '';
			$('deleteMessageDialogConfirm').style.display = 'none';
			$('deleteMessageDialogCancel').style.display = 'none';
			var item = jQuery("#ref_id").jqxComboBox('getSelectedItem');
			if(item != null){ refid = item.value; }
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
			jQuery.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>index.php/ref_data/delete_action/",
						data : {[csrfName]: csrfHash,'deleteEventId': $('deleteEventId').value, 'type': $('type').value, 'comments_sts':$('comments_sts').value, 'comments':$('comments').value,'sts':$('sts').value,'tab_id':refid},

						datatype: "json",
						success: function(response){
							//alert (response);
							var json = jQuery.parseJSON(response);
							jQuery('.txt_csrfname').val(json.csrf_token);
							if(json.Message!='OK')
							{
								$('deleteMessageDialogConfirm').style.display = '';
								$('deleteMessageDialogCancel').style.display = '';
								$('loading').style.display = 'none';
								alert(json.Message);
								return false;
							}else{

								var row = {};
								row["id"] = json['row_info'].id;
								row["sts"] = json['row_info'].sts;

								jQuery("#jqxgrid").jqxGrid('clearselection');

								if($('type').value!='delete')
								{
									jQuery.each(row, function(key,val){
										jQuery("#jqxgrid").jqxGrid('setcellvalue',$('verifyIndexId').value, key, row[key]);
									});
								}else{
									window.parent.jQuery('#jqxgrid').jqxGrid('updatebounddata');
									jQuery("#row"+$('verifyIndexId').value+"jqxgrid").hide();
								}

								var msz='';
								if($('comments_sts').value=='0'){msz=' comments send';}
								jQuery("#error").show();
								jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});
								jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz);
								deleteMessageDialog.hide();
							}

						}
			});

		  };

			deleteMessageDialog = new EOL.dialog($('deleteMessageDialogContent'), {position: 'fixed', modal:true, width:570, close:true, id: 'deleteMessageDialog' });

			deleteMessageDialog.afterShow = function() {
				$$('#deleteMessageDialog #deleteMessageDialogConfirm').addEvent('click',handleSubmit);
				$$('#deleteMessageDialog #deleteMessageDialogCancel').addEvent('click',function() {deleteMessageDialog.hide();});
			};
			deleteMessageDialog.show();
		}


		function delete_records(objId,go_for,indx,sts,d_serial)
		{
			$('deleteMessageDialogConfirm').style.display = '';
			$('deleteMessageDialogCancel').style.display = '';
			$('loading').style.display = 'none';

			document.getElementById("confirms").checked=true;
			change_value();

			jQuery('#comments').focus();
			if (!deleteMessageDialog) {
				initDeleteMessageDialog();
			}


		   if(go_for=='delete')
		   {
			  $('comments_part').hide();
		   }else{
			  $('comments_part').show();
			  $('comments').value='';
		   }

		   $('deleteEventId').value = objId;
		   $('verifyIndexId').value = indx;
		   $('d_serial').value = d_serial;
		   $('sts').value = sts;

			$('type').value = go_for;
			$('confirm_msgs').innerHTML=go_for;

			resetDeleteMessageErrors();
			deleteMessageDialog.show();
		}
		function reloadCurrentMessages()
		{
			window.location.reload();
		}

		//Reset the dialog fields

		function resetDeleteMessageDialog() {
			resetDeleteMessageErrors();
			$("deleteEventId").value = '';
		}

		//Reset the error messages on the dialog.

		function resetDeleteMessageErrors() {
			$('deleteMessageErrorMsg').innerHTML = '';
			$('deleteMessageErrorMsg').style.display = 'none';
		}
		function alertMSG(divids)
		{
			alertmsginfo= new EOL.dialog($(divids), {position: 'fixed', modal:true, width:470, close:true});
			alertmsginfo.show();
		}

		function change_value()
		{
			if(document.getElementById("confirms").checked==true){$('comments_sts').value = 1;}else{$('comments_sts').value =0; jQuery('#comments').focus();}

		}
		function downLoadExcel()
		{
			var item = jQuery("#ref_id").jqxComboBox('getSelectedItem');

			if(item != null)
			{
				jQuery("#ref_name").val(item.value);
				jQuery("form#excelform").submit();
			}
		}

</script>
<div id="container">
	<div id="body"  >
		<div  style="display:block; min-height:350px; height:auto">
          <form method="POST" name="form" id="form"  style="margin:0px;" onsubmit="return checkRef()" action="<?=base_url()?>index.php/ref_data/view/<?=$menu_group?>/<?=$menu_cat?>/<?=$VIEWID?>">
		  <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		  <div style="clear:both;padding: 1%;margin-top:5px;width:97%;height:25px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
			<table id="deal_body" style="display:block;width:100%">
				<tr>
					<td><strong>Reference &nbsp;&nbsp;</strong></td>
					<td><div class="text-input-big" id="ref_id" name="ref_id" ></div></td>
					<td>&nbsp;&nbsp;&nbsp;<input type='submit' name='submit' id="sendButton" class="buttonStyleBlue" value='Load Data' />
					</td>
                    <? if($submit){ ?>
                    <td>  <div title="Download Excel" style="cursor:pointer;float:left;margin-left:10px;">
					<a target="_blank" onclick="downLoadExcel()" id="export_excel"><img  src="<?=base_url()?>images/icon_xls.gif">
				  </div></td>
					<? } ?>
                    <td><span id="errormsg" style="color:#FF3333"></span></td>
				</tr>
			</table>
		  </div>

		  <div id="resultdiv" style="width:100%;min-height:300px;height:auto;"><div id="jqxgrid"></div></div>
			<? if(ADD==1){
						if($submit){
						 $opp='add';
					   	$ref_table_list=$CI->Ref_data_model->get_ref_table_right($ref_name,$opp);
					  
					  // $styleSend="display:none";
					   //if(!empty($ref_table_list)){?>
					   <? $styleSend=""; 
					   //} ?>
                    <td>&nbsp;<br/><input type='submit' name='submit2' id="sendButton2" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:40px;width:120px;font-weight:bold" class="buttonStyleAdd" value='Add Data' style="cursor:pointer;<?=$styleSend?>"/>
					</td>
                    <? }}?>
          </form>
        </div>
<?php if($submit){ ?>
	<form method="POST" name="excelform" id="excelform" action="<?=base_url()?>index.php/ref_data/download_excel"  style="margin:0px;">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>"/>
		<input type="hidden" name="ref_name" id="ref_name" value=""/>
</form>
	<div id="ref_preview">
        <div style="padding-left: 17px"><strong>Reference Data</strong></div>
		<div style="">
				<table class="custtable" style="margin:10px;width:98%;border-collapse:collapse" cellspacing="5" cellpadding="5">

                	<tbody>
                		<?php foreach($fields as $row){ ?>
	                		<tr>
	                			<td style="width:30%" valign="top"><strong><?=$row['caption']?></strong></td>
								<td style="width:70%"><div style="width:99%" id="<?=$row['field']?>_preview"></div></td>
							</tr>
						<? } ?>
					</tbody>
				</table>
				<div align="center"><input type="button" id="refOK" value="Close" style="cursor:pointer"/></div>
		</div>
	</div>
<? } ?>
<div id="deleteMessageDialogContent"  style="display:none">
          <div class="hd"><h2 class="conf">Are you sure you want to <span id="confirm_msgs"></span>?</h2></div>
          <form method="POST" name="deleteMessageform" id="deleteMessageform"  style="margin:0px;">
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
            <input name="sts" id="sts" value="" type="hidden">
            <input name="comments_sts" id="comments_sts" value="1" type="hidden">
            <input name="d_serial" id="d_serial" value="" type="hidden">

             <span id="comments_part">
             <input type="checkbox" onclick="change_value()" name="confirms" id="confirms" checked="checked" /> If Yes then check the checkbox and click on yes button else click on cancel button with comments:
             <input name="comments" id="comments" type="text" style="width:370px; background-color:#CCC">
             </span>


           	<div class="bd">
              <div class="inlineError" id="deleteMessageErrorMsg" style="display:none"></div>
              <div class="instrText" style="margin-bottom: 10px">
             &nbsp;
              </div>
            </div>

            <a class="btn-small btn-small-normal" id="deleteMessageDialogConfirm"><span>Yes</span></a>
            <a class="btn-small btn-small-secondary" id="deleteMessageDialogCancel"><span>Cancel</span></a>
            <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
            </form>
        </div>
	 	<!--Customization End-->
	</div>
</div>