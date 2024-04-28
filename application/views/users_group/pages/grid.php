<div id="container">
	<div id="body"  >
    <!--Customization Start-->
	<script type="text/javascript">
         jQuery(document).ready(function () {
            // prepare the data
            var csrf_token = '';
             //var theme = 'energyblue';
            var theme = 'classic';
           <? if(ADD==1){?>
              //jQuery("#sendButton").jqxButton({template:"primary",width:"120"});
			<?}?>

            var source =
            {
                 datatype: "json",
                 datafields: [
					 { name: 'id', type: 'int'},
					 { name: 'group_name', type: 'string'},
					 { name: 'group_code', type: 'string'},
					 { name: 'remarks', type: 'string'}

                ],
				addrow: function (rowid, rowdata, position, commit) {
                    // synchronize with the server - send insert command
                    // call commit with parameter true if the synchronization with the server is successful
                    //and with parameter false if the synchronization failed.
                    // you can pass additional argument to the commit callback which represents the new ID if it is generated from a DB.
                    commit(true);
                },
                deleterow: function (rowid, commit) {
                    // synchronize with the server - send delete command
                    // call commit with parameter true if the synchronization with the server is successful
                    //and with parameter false if the synchronization failed.
                    commit(true);
                },
                updaterow: function (rowid, newdata, commit) {
                    // synchronize with the server - send update command
                    // call commit with parameter true if the synchronization with the server is successful
                    // and with parameter false if the synchronization failed.
                    commit(true);
                },
			    url: '<?=base_url()?>index.php/users_group/grid',
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



			var columnCheckBox = null;
            var updatingCheckState = false;
            // initialize jqxGrid. Disable the built-in selection.
            var celledit = function (row, datafield, columntype) {
                var checked = jQuery('#jqxgrid').jqxGrid('getcellvalue', row, "available");
                if (checked == false) {
                    return false;
                };
            };
            var win_h=jQuery( window ).height()-240;
            // initialize jqxGrid
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
				selectionmode: 'none',
				rendergridrows: function(obj)
				{
					 return obj.data;
				},

			    columns: [
                      { text: 'id', datafield: 'id',hidden:true,  editable: false,  width: '4%' },
					  <? if(DELETE==1){?>
					  	{ text: 'D', menu: false,columntype: 'number',sortable: false, width: 30, align:'center', cellsalign:'center',
						  	cellsrenderer: function (row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);

							 		return '<div style="text-align:center;  cursor:pointer" onclick="delete_action('+editrow+','+dataRecord.id+')" ><img align="center" src="<?=base_url()?>images/delete.png"></div>';

							  }
						  },
					  <? }	if(EDIT==1){?>
					  { text: 'E', menu: false, datafield: 'Edit', columntype: 'number',  sortable: false, width: 30, align:'center', cellsalign:'center',
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						 return '<div style="margin-left: 10px; margin-top: 5px; cursor:pointer" onclick="editt('+dataRecord.id+','+editrow+')" ><img src="<?=base_url()?>images/edit.png"></div>';
						  }
					  },
					   <? }?>
					   <? if(SETRIGHT==1){?>
					  { text: 'R', menu: false, datafield: 'Rights',columntype: 'number',  sortable: false, width: 30, align:'center', cellsalign:'center',
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;  cursor:pointer" onclick="right('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/User_Privilege.png"></div>';
						  }
					  },
					  <? }?>
					 

					  { text:'Group Name', datafield: 'group_name',  editable: false,  width: '24%' },
					  { text:'Group Code', datafield: 'group_code',  editable: false,  width: '20%' },
                      { text:'Remarks', datafield: 'remarks', editable: false, },

                  ]
            });

			//End check box start

            // select or unselect rows when the checkbox is checked or unchecked.

			//End check box update

        });
		function delete_action(row,val){

			jQuery("#val").val(val);
			jQuery("#row").val(row);
			if (!deleteMessageDialog) {

				initDeleteMessageDialog();
			}
			deleteMessageDialog.show();
			return false;
		}

		function right(id,indx)
		{
			// alert(indx)
			jQuery("#jqxgrid").jqxGrid('clearselection');
			EOL.messageBoard.open('<?=base_url()?>index.php/users_group/set_right/'+id+'/'+indx, (jQuery(window).width()-70), jQuery(window).height(), 'yes');
			return false;
		}

		function editt(val,indx)
		{
			jQuery("#jqxgrid").jqxGrid('clearselection');
			EOL.messageBoard.open('<?=base_url()?>index.php/users_group/from/edit/'+val+'/'+indx, (jQuery(window).width()-70), jQuery(window).height(), 'yes');
			return false;
		}

		/* message delete */
		var deleteMessageDialog;

		function initDeleteMessageDialog(val,row) {

			// Define various event handlers for Dialog
			var handleCancel = function() {
				this.hide();
			};
		  var handleDeleteMessageSuccess = function(req) {
			var response = eval('(' + req + ')');
			jQuery('.txt_csrfname').val(response.csrf_token);
			if( response.status == 'success') {
				deleteMessageDialog.hide();
				//reload results
				jQuery("#jqxgrid").jqxGrid('updatebounddata');
			} else {
				$('deleteMessageErrorMsg').innerHTML = response.errorMsgs[0];
				$('deleteMessageErrorMsg').style.display = '';
			}
		  };
		  var handleDeleteMessageFailure = function(o) {
				showInfoDialog( 'deleteMessagefailuretitle', 'deleteMessagefailurebody', 'WARN' );
		  };

		  var handleSubmit = function() {
		  	var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		  	var val=jQuery("#val").val();
			var request =  new Request({	url: '<?=base_url()?>index.php/users_group/delete_action',
											method: 'post',
											data: {[csrfName]: csrfHash,id:val},
											onSuccess: function(req) {handleDeleteMessageSuccess(req);},
											onFailure: function(req) {handleDeleteMessageFailure(req);}
										});
			request.send();
			$('deleteMessageDialogConfirm').style.display = 'none';
			$('deleteMessageDialogCancel').style.display = 'none';
			$('loading').style.display = '';

		  };

			deleteMessageDialog = new EOL.dialog($('deleteMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'deleteMessageDialog' });

			deleteMessageDialog.afterShow = function() {
				$$('#deleteMessageDialog #deleteMessageDialogConfirm').addEvent('click',handleSubmit);
				$$('#deleteMessageDialog #deleteMessageDialogCancel').addEvent('click',function() {deleteMessageDialog.hide();});
			};

			deleteMessageDialog.show();
		}

		function reloadCuragreementMessages()
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

    </script>

    <div id="jqxgrid"  style="margin: 10px auto"></div>
    <div style="float:left;padding-top: 5px;padding-left:5px;">
    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
    	<? if(ADD==1){?>
    	<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;" 
	    href="<?=base_url()?>index.php/users_group/from/add" title=""><input type="button" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:40px;width:120px;font-weight:bold"  value="Add Group" id="sendButton" /></a>
	    <? }?>&nbsp;&nbsp;&nbsp;&nbsp;
        <strong>D = </strong> Disable,&nbsp;
    	<strong>E = </strong> Edit,&nbsp;
    	<strong>R = </strong> Set Group Privilege&nbsp;
    </div> <br/>
    
	
	</div>

  <!-- Delete information-->
<style>
* { padding:0px; margin:0px; }
</style>
     <input type="hidden" id="val" name="val" value="" />
     <input type="hidden" id="row" name="row" value="" />

        <div id="deleteMessageDialogContent"  style="display:none">
          <div class="hd"><h2 class="conf">Are you sure you want to Disable this Group?</h2></div>
          <form method="POST" name="deleteMessageform" id="deleteMessageform"  style="margin:0px;">
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="action" value="DeleteMessage" type="hidden">
            <input name="type"  id="type" value="delete" type="hidden">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
          	<div class="bd">
              <div class="inlineError" id="deleteMessageErrorMsg" style="display:none"></div>
              <div class="instrText" style="margin-bottom: 20px">
               This action is permanent.
              </div>
            </div>
            <a class="btn-small btn-small-normal" id="deleteMessageDialogConfirm"><span>Yes</span></a>
            <a class="btn-small btn-small-secondary" id="deleteMessageDialogCancel"><span>Cancel</span></a>
            <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
            </form>
        </div>


		<!-- Delete information-->

	 <!--Customization End-->
	</div>
</div>