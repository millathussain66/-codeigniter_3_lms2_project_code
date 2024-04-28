<div id="container">
	<div id="body"  >
    <!--Customization Start-->
	<script type="text/javascript">
		var csrf_token='';
         jQuery(document).ready(function($) {
            // prepare the data
             //var theme = 'energyblue';
            var theme = 'classic';
			<? if(ADD==1){?>
           //jQuery("#sendButton").jqxButton({template:"primary",width:"130"});
			<?}?>
            var source =
            {
                 datatype: "json",
                 datafields: [
					 { name: 'id', type: 'int'},
					 { name: 'reference_name', type: 'string'},
					 { name: 'reference_remarks', type: 'string'},
					 { name: 'data_status', type: 'string'}
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
			    url: '<?=base_url()?>index.php/ref/grid',
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
				beforeprocessing: function(data)
				{
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
				}
			);
		    var win_h=jQuery( window ).height()-240;
            jQuery("#jqxgrid").jqxGrid(
            {
                width:'99%',
				height:win_h,
			    source: dataadapter,
                theme: theme,
				filterable: true,
				sortable: true,
				//autoheight: true,
				pageable: true,
				virtualmode: true,
				editable: true,
				enablehover: true,
                enablebrowserselection: true,
                selectionmode: 'none',
				rendergridrows: function(obj)
				{
					 return obj.data;
				},

			    columns: [
                      { text: 'id', datafield: 'id',hidden:true },
					  { text: 'sts', datafield: 'data_status',hidden:true },
					  <? if(DELETE==1){?>
					 { text: 'D', menu: false, datafield: 'delete', align:'center', editable: false, sortable: false, width: 30,
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							return '<div style="text-align:center;  cursor:pointer" onclick="delete_records('+dataRecord.id+');" ><img align="center" src="<?=base_url()?>images/del.png"></div>';
						  }
					  },
					  <?}?>
					  <? if(EDIT==1){?>
					  { text: 'Edit', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '3%',
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;  cursor:pointer" onclick="editt('+dataRecord.id+','+editrow+','+dataRecord.data_status+')" ><img align="center" src="<?=base_url()?>images/edit.png"></div>';

						  }
					  },
					  <? }?>
					  { text: 'Reference Name', datafield: 'reference_name',  editable: false,  width: '30%' },
					  { text: 'Remarks', datafield: 'reference_remarks',  editable: false,  width: '67%' }
                  ]
            });

        });


		function delete_records(val)
		{
			if(confirm('Do you really want to delete this selected Reference?'))
			{
				var check = 0;
				var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
				var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
				jQuery.ajax({
					type: "POST",
					cache: false,
					url: "<?=base_url()?>index.php/ref/delete_action/"+val,
					data : {[csrfName]: csrfHash,},
					datatype: "text",
					async: false,
					success: function(result){
						var fields = result.split(':::');

						 check = fields[0];
						jQuery('.txt_csrfname').val(fields[1]);
                        if(check == 1)
						{
							jQuery('#jqxgrid').jqxGrid('updatebounddata');
							jQuery("#error").show();
							jQuery("#error").fadeOut(11500);
							jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Deleted');
						}
						else
						{
							jQuery('#jqxgrid').jqxGrid('updatebounddata');
							jQuery("#error").show();
							jQuery("#error").fadeOut(11500);
							jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Could not deleted!');

							return false;
						}
						//check = result;
					}
				});
				
			}
			else
			{
				return false;
			}

		}
		function editt(val,indx)
		{
			jQuery("#jqxgrid").jqxGrid('clearselection');
			EOL.messageBoard.open('<?=base_url()?>index.php/ref/from/edit/'+val+'/'+indx, (jQuery(window).width()-70), jQuery(window).height(), 'yes');
			return false;
		}
		function addEntry(val,indx)
		{
			jQuery("#jqxgrid").jqxGrid('clearselection');
			EOL.messageBoard.open('<?=base_url()?>index.php/ref/entryfrom/'+val+'/'+indx, (jQuery(window).width()-70), jQuery(window).height(), 'yes');
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
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
			jQuery.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>index.php/ref/delete_action/",
						data : {[csrfName]: csrfHash,'deleteEventId': $('deleteEventId').value, 'type': $('type').value, 'comments_sts':$('comments_sts').value, 'comments':$('comments').value,'sts':$('sts').value,'d_serial':$('d_serial').value},

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
								row["FontofficeComent"] = json['row_info'].FontofficeComent;
								row["BackOfficeComments"] = json['row_info'].BackOfficeComments;
								row["verify_sts"] = json['row_info'].verify_sts;
								row["sts"] = json['row_info'].sts;

								jQuery("#jqxgrid").jqxGrid('clearselection');

								if($('type').value!='delete')
								{
									jQuery.each(row, function(key,val){
										jQuery("#jqxgrid").jqxGrid('setcellvalue',$('verifyIndexId').value, key, row[key]);
									});
								}else{
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

    </script>

    <div id="jqxgrid" style="margin: 10px auto;"></div>
	<div style="float:left;">
	<? if(ADD==1){?>
	<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
    href="<?=base_url()?>index.php/ref/from/add" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:40px;width:120px;font-weight:bold"  value="New Reference" id="sendButton" /></a>
    <? }?>
	</div>
  <!-- Delete information-->
<style>
* { padding:0px; margin:0px; }
</style>
        <div id="deleteMessageDialogContent"  style="display:none">
        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
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