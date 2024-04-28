<style>
* { padding:0px; margin:0px; }
#footer { position: absolute; !important;}
.ui-datepicker { z-index: 999999 !important; }
/*.jqx-grid-header{height: 50px !important;}*/
</style>
<div >

	<div id="body"  >
    <!--Customization Start-->
	<script type="text/javascript">
         jQuery(document).ready(function($) {
            // prepare the data
            var csrf_token='';
            //var theme = 'energyblue';
            var theme = 'classic';
			<? if(ADD==1){?>
              //jQuery("#sendButton").jqxButton({template:"primary",width:"120"});
			  //jQuery("#sendButton").jqxButton({ theme: theme });		
			<?}?>
			
			
			
            var source =
            {
                 datatype: "json",

                 datafields: [
					 { name: 'id', type: 'int'},
					 { name: 'user_id', type: 'string'},
					 { name: 'pin', type: 'string'},
					 { name: 'name', type: 'string'},
					 { name: 'territory_name', type: 'string'},
					 { name: 'department_name', type: 'string'},
					 { name: 'mobile_number', type: 'string'},
					 { name: 'email_address', type: 'string'},
					 { name: 'lock_status', type: 'int'},
					 { name: 'block_status', type: 'int'},
					 { name: 'unblock_status', type: 'int'},
					 { name: 'verify_status', type: 'int'},
					 { name: 'send_to_checker', type: 'int'},
					 { name: 'data_status', type: 'int'},
					 { name: 'admin_status', type: 'int'},
					 { name: 'entry_by', type: 'int'},
					 { name: 'password_change_status', type: 'int'}, 
					 { name: 'user_group_id', type: 'string'}
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
			    url: '<?=base_url()?>user_info/grid',
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

			var cellsrenderer = function (row, column, value) {
				return '<div style="text-align: center; margin-top: 5px;">' + value + '</div>';
			}
			var columnsrenderer = function (value) {
				return '<div style="text-align: left; margin-top: 5px;margin-left:5px;">' + value + '</div>';
			}
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
				enablehover: true,
                enablebrowserselection: true,
                selectionmode: 'none',
				rendergridrows: function(obj)
				{
					 return obj.data;
				},

			    columns: [
                      { text: 'id', datafield: 'id',hidden:true,  editable: false,  width: '45' },
                      { text: 'lock_status', datafield: 'lock_status',hidden:true,  editable: false,  width: '45' },
                      { text: 'block_status', datafield: 'block_status',hidden:true,  editable: false,  width: '45' },
                      { text: 'unblock_status', datafield: 'unblock_status',hidden:true,  editable: false,  width: '45' },
					  { text: 'password_change_status', datafield: 'password_change_status',hidden:true,  editable: false,  width: '45' },
					  { text: 'send_to_checker', datafield: 'send_to_checker',hidden:true,  editable: false,  width: '45' },
					  { text: 'admin_status', datafield: 'admin_status',hidden:true,  editable: false,  width: '45' },
                      { text: 'data_status', datafield: 'data_status',hidden:true,  editable: false,  width: '45' },
					  { text: 'user_group_id', datafield: 'user_group_id',hidden:true,  editable: false,  width: '45' },
					  { text: 'entry_by', datafield: 'entry_by',hidden:true,  editable: false,  width: '45' },
                       <? if(DELETE==33333333331){?>
						  { text: 'D',datafield: 'admin_status', menu: false,renderer: columnsrenderer, columntype: 'number',sortable: false, width: 30,
						  	cellsrenderer: function (row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if(dataRecord.verify_status==0 && dataRecord.admin_status!=2){
							 		return '<div style="text-align:center;  cursor:pointer" onclick="Reset_pass('+editrow+','+dataRecord.id+',\''+dataRecord.user_id+'\',\'Delete Entry\')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
								}else{
									return '<div style="text-align:center;"  ></div>';
								}

							  }
						  },

					  <? }?>
					  { text: 'P', menu: false,renderer: columnsrenderer, sortable: false, width: 30,
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;  cursor:pointer" onclick="verify_delete_action('+dataRecord.id+','+editrow+',\'view\')"  ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';
						  }
					  },
					  <? if(EDIT==1){?>
					  { text: 'E', menu: false, datafield: 'Edit', renderer: columnsrenderer, columntype: 'number',   sortable: false, width: 30,
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							//alert(dataRecord.verify_status);
							if((dataRecord.verify_status==0 || dataRecord.verify_status==8) && ((dataRecord.admin_status!=2 && <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>!=2) || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>==2)  ){
								return '<div style="text-align:center;  cursor:pointer" onclick="editt('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
							}else{
									return '<div style="text-align:center;"  ></div>';
								}
						  }
					  },
					  <? }?>
					  <? if(SETRIGHT==1){?>
					  { text: 'SUP', menu: false, datafield: 'dddd', renderer: columnsrenderer, columntype: 'number',  sortable: false, width: 35,
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if(dataRecord.verify_status==0){
								return '<div style="text-align:center;  cursor:pointer" onclick="right('+dataRecord.id+','+dataRecord.user_group_id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/User-Privilege-New.png"></div>';
							}else{
									return '<div style="text-align:center;"  ></div>';
								}
						  }
					  },
					  <? }?>
					 
					  <? if(APPROVE==1){?>
					  { text: 'UL', renderer: columnsrenderer, datafield: 'UL', editable: false, sortable: false, menu: false, width: 30,
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							//alert(dataRecord.verify_status +'hh'+dataRecord.lock_status +'hh'+dataRecord.block_status);
						 	if(dataRecord.lock_status=='1' && dataRecord.verify_status=='0')
							{
								return '<div style="text-align:center;  cursor:pointer" onclick="Reset_pass('+editrow+','+dataRecord.id+',\''+dataRecord.user_id+'\',\'Unlock\')" ><img align="center" src="<?=base_url()?>images/unlock.png"></div>';
							}else{
								return '<div style="margin-left: 20px; margin-top: 5px;>&nbsp;</div>';
							}
						  }
					  },

					  <? }?>

					  <? if(BLOCK==1){?>
					  { text: 'DACT', renderer: columnsrenderer, datafield: 'DACT', editable: false, sortable: false, menu: false, width: 45,
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							
							if(dataRecord.id =='1'){
								return '<div style="margin-left: 20px; margin-top: 5px;>&nbsp;</div>';
							}
                             //alert(dataRecord.block_status +" "+dataRecord.verify_status);
							if(dataRecord.block_status=='1' && dataRecord.verify_status=='0' && dataRecord.password_change_status=='1' )
							{
								return '<div style="text-align:center; cursor:pointer" onclick="Reset_pass('+editrow+','+dataRecord.id+',\''+dataRecord.user_id+'\',\'UNBLOCK\')" ><img align="center" src="<?=base_url()?>images/deactivate.png"></div>';
							}else{
								return '<div style="margin-left: 20px; margin-top: 5px;>&nbsp;</div>';
							}
						  }
					  },
					  <? }?>
					   <? if(UNBLOCK==1){?>
					  { text: 'ACT', renderer: columnsrenderer, datafield: 'ACT', editable: false, sortable: false, menu: false, width: 45,
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if(dataRecord.id =='1'){
								return '<div style="margin-left: 20px; margin-top: 5px;>&nbsp;</div>';
							}
                          	 
							if(dataRecord.block_status=='0' && dataRecord.verify_status=='0'  && dataRecord.password_change_status=='1' )
							{
								return '<div style="text-align:center; cursor:pointer" onclick="Reset_pass('+editrow+','+dataRecord.id+',\''+dataRecord.user_id+'\',\'Block\')" ><img align="center" src="<?=base_url()?>images/activate-user.png"></div>';
							}else{
								return '<div style="margin-left: 20px; margin-top: 5px;>&nbsp;</div>';
							}
						  }
					  },
					  <? }?>
					  <? if(RESETPASS==1){?>
					  { text: 'RP', renderer: columnsrenderer, datafield: 'PRR', editable: false, sortable: false, menu: false, width: 45,
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if(dataRecord.id =='1'){
								return '<div style="margin-left: 20px; margin-top: 5px;>&nbsp;</div>';
							}
                          
							//if(dataRecord.password_change_status=='0' && dataRecord.verify_status=='0')
							if(dataRecord.verify_status=='0')
							{
								return '<div style="text-align:center; cursor:pointer" onclick="passwordreset('+editrow+','+dataRecord.id+',\''+dataRecord.user_id+'\',\'UNBLOCK\')" ><img align="center" src="<?=base_url()?>images/ResetPass.png"></div>';
							}else{
								return '<div style="margin-left: 20px; margin-top: 5px;>&nbsp;</div>';
							}
						  }
					  },
					  <? }?>

					<? if(SENDTOCHECKER==1){?>
					  	   { text: 'STA', renderer: columnsrenderer, datafield: 'ssss', editable: false, sortable: false, menu: false, width: 35,
                      	cellsrenderer: function(row) {
                      		var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', row);
                      		//alert(dataRecord.send_to_checker+" "+dataRecord.verify_status+" "+dataRecord.data_status);
	                      		if ((dataRecord.send_to_checker == null || dataRecord.send_to_checker == '0') && ( dataRecord.verify_status != '0' ) && dataRecord.data_status==1) {
		                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<img src="<?=base_url()?>images/forward.png" onclick=\'sendToChecker("'+row+'","'+dataRecord.user_id+'","'+dataRecord.name+'");\'></div>';
	                      		}  else {
	                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
	                      		}
	                      	
                      	}
	                  },
					   <? }?>
					    <? if(VERIFY==1){?>
					    { text: 'APV', menu: false, renderer: columnsrenderer, datafield: 'sts1', columntype: 'number',  sortable: true, width: 35, align: 'center', cellsalign: 'center',
					  	cellsrenderer: function (row) {							
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if(dataRecord.entry_by =='<?=$this->session->userdata['ast_user']['user_id']?>'){
								return '<div style="margin-left: 20px; margin-top: 5px;>&nbsp;</div>';
							}
													
						 	if(dataRecord.data_status==1 && dataRecord.send_to_checker=='1')
							{
								return '<div style="text-align:center; cursor:pointer" onclick="verify('+dataRecord.id+','+editrow+','+dataRecord.verify_status+')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
							}else{
								return '<div style="margin-left: 20px; margin-top: 5px;>&nbsp;</div>';
							}
						  }
					  },
					  <? }?> 
					  
					     {
                        text: 'Status',
						renderer: columnsrenderer,
                        datafield: 'verify_status',
						menu:false,
                        editable: false,
                        width: 230,
                        cellsrenderer: function (row) {
                            var editrow = row;
                            var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                            if (dataRecord.verify_status == '1') {
                                return '<div style="text-align:left;margin-left:5px;margin-top: 5px;">Create Approval Pending</div>';
                            } else if (dataRecord.verify_status == '2') {

                                return '<div style="text-align:left;margin-left:5px;margin-top: 5px;">Edit Approval Pending</div>';
                            } else if (dataRecord.verify_status == '3') {

                                return '<div style="text-align:left;margin-left:5px;margin-top: 5px;">Delete Approval Pending</div>';
                            }
							else if (dataRecord.verify_status == '4') {

                                return '<div style="text-align:left;margin-left:5px;margin-top: 5px;">Reset Password Approval Pending</div>';
                            } 
							else if (dataRecord.verify_status == '5') {

                                return '<div style="text-align:left;margin-left:5px;margin-top: 5px;">Unlock Approval Pending</div>';
                            }
							else if (dataRecord.verify_status == '6') {

                                return '<div style="text-align:left;margin-left:5px;margin-top: 5px;">Block Approval Pending</div>';
                            }
							else if (dataRecord.verify_status == '7') {

                                return '<div style="text-align:left;margin-left:5px;margin-top: 5px;">Unblock Approval Pending</div>';
                            }
							else if (dataRecord.verify_status == '8') {

                                return '<div style="text-align:left;margin-left:5px;margin-top: 5px;">Return by Approver</div>';
                            }
							else if (dataRecord.verify_status == '0') {

                                return '<div style="text-align:left;margin-left:5px;margin-top: 5px;">Verified</div>';
                            } else {
                                return '';
                            }
                        }
                    },
					  { text: 'User ID', datafield: 'user_id',  editable: false,  width: '110' },
					  { text: 'PIN', datafield: 'pin',  editable: false,  width: '80' },
                      { text: 'Name', datafield: 'name', editable: false, width: '200' },
                      { text: 'Territory Name', datafield: 'territory_name', editable: false, width: '170' },
                      { text: 'Department Name', datafield: 'department_name', editable: false, width: '170' },
					  { text: 'Phone', datafield: 'mobile_number', editable: false, width: '110' },
					  { text: 'Email', datafield: 'email_address', editable: false, width: '225' }
                  ]
            });

			jQuery('#jqxwindow').jqxWindow({theme:'energyblue',height: 500, width: 900,isModal: true, maxWidth: 1600, maxHeight: 800,autoOpen: false,cancelButton: jQuery('#cancelButton')});
			//End check box start

			//End check box update

        });


		function editt(val,indx)
		{
			jQuery("#jqxgrid").jqxGrid('clearselection');
			EOL.messageBoard.open('<?=base_url()?>user_info/from/edit/'+val+'/'+indx, (jQuery(window).width()-70), jQuery(window).height(), 'yes');
			return false;
		}
		
		function right(id,USER_GROUP_ID,indx)
		{
			jQuery("#jqxgrid").jqxGrid('clearselection');
			EOL.messageBoard.open('<?=base_url()?>user_info/set_right/'+id+'/'+USER_GROUP_ID+'/'+indx, (jQuery(window).width()-70), jQuery(window).height(), 'yes');
			return false;
		}
			function verify(cb_id,indx,v_sts)
		{
			jQuery("#jqxgrid").jqxGrid('clearselection');
			EOL.messageBoard.open('<?=base_url()?>user_info/fromverify/'+cb_id+'/'+indx+'/'+v_sts, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
			return false;
		}
		function verify_delete_action(val,row,type){

			
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
			 jQuery.ajax({
            url: '<?php echo base_url(); ?>user_info/detail',
            type: "post",
            data: { [csrfName]: csrfHash,id : val},
            datatype: 'html',
            success: function(response){
            	var fields = response.split(':::');

						var table = fields[0];
						jQuery('.txt_csrfname').val(fields[1]);
			            jQuery("#user_info").html(table);
			            jQuery('#jqxwindow').jqxWindow('open');
			            jQuery("#close").jqxButton({template:"default",width:"100"});
            },
            error:   function(model, xhr, options){
                alert('failed');
            },
        	});

			return false;
		}
			function close_view(){
				 jQuery('#jqxwindow').jqxWindow('close');
			}
			
		
		var verifyMessageDialog;
		function initVerifyMessageDialog() {
			// Define various event handlers for Dialog
			var handleCancel = function() {
				this.hide();
			};

		  	var handleSubmit = function() {
				//alert($('verify_type').value +jQuery('#act_dec_Remarks').val())
				if (jQuery('#act_dec_Remarks').val() == '' && jQuery('#verify_type').val()!='Unlock'){
		    		//alert('The checker to notify field is required!');
		    		jQuery('#verifyMessageErrorMsg').show();
		    		jQuery('#act_dec_Remarks').focus();
		    		return false;
		    	}
				jQuery('#verifyMessageErrorMsg').hide();
				var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
				var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
				var postdata_rs = jQuery('#verifyMessageform').serialize()+"&"+csrfName+"="+csrfHash;
				jQuery.ajax({
						type: "POST",
						cache: false,
						url: "<?=base_url()?>user_info/reset_pass",
						data : postdata_rs,
						datatype: "json",
						success: function(response){

							var json = jQuery.parseJSON(response);
							jQuery('.txt_csrfname').val(json.csrf_token);
							if(json.Message!='OK')
							{
								alert(json.Message)
								$('verifyMessageDialogConfirm').style.display = '';
								$('verifyMessageDialogCancel').style.display = '';
								$('loadingVerify').style.display = 'none';
								return false;
							}else{
							if(jQuery("#verify_type").val()=='Delete Entry'){
								verifyMessageDialog.hide();
								jQuery("#jqxgrid").jqxGrid('updatebounddata');
							}else{
									var row = {};
									row["id"] = json['row_info'].id;
									row["unblock_status"] = json['row_info'].unblock_status;
									row["block_status"] = json['row_info'].block_status;
									row["lock_status"] = json['row_info'].lock_status;
									row["verify_status"] = json['row_info'].verify_status;
									row["send_to_checker"] = json['row_info'].send_to_checker;
									row["data_status"] = json['row_info'].data_status; 
								    row["admin_status"] = json['row_info'].admin_status; 
									row["password_change_status"] = json['row_info'].password_change_status;

									//jQuery("#jqxgrid").jqxGrid('clearselection');
									jQuery.each(row, function(key,val){
									//	alert(key+" "+val);
										jQuery("#jqxgrid").jqxGrid('setcellvalue',$('verifyIndexId').value, key, row[key]);
										
									});
									jQuery("#jqxgrid").jqxGrid('updatebounddata');
									jQuery("#jqxgrid").jqxGrid('clearselection');
									jQuery("#jqxgrid").jqxGrid('selectrow', parseInt(jQuery('#verifyIndexId').val()));
									jQuery("#error").stop(true, true);
									jQuery("#error").show();
									jQuery("#error").fadeOut(11500);
									jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;'+jQuery("#verify_type").val()+' Successfully');
									verifyMessageDialog.hide();
								}

							}


						}
					});
					$('verifyMessageDialogConfirm').style.display = 'none';
					$('verifyMessageDialogCancel').style.display = 'none';
					$('loadingVerify').style.display = '';

		  };
			//alert(id)
			verifyMessageDialog = new EOL.dialog($('verifyMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'verifyMessageDialog' });
			verifyMessageDialog.afterShow = function() {
				$$('#verifyMessageDialog #verifyMessageDialogConfirm').addEvent('click',handleSubmit);
				$$('#verifyMessageDialog #verifyMessageDialogCancel').addEvent('click',function() {verifyMessageDialog.hide();});
			};
			verifyMessageDialog.show();
		}

		function Reset_pass(indx,id,EmplyId,type_txt)
		{
			$('verifyMessageErrorMsg').style.display = 'none';
			$('act_dec_Remarks').value ='';
			$('verifyMessageDialogConfirm').style.display = '';
			$('verifyMessageDialogCancel').style.display = '';
			$('loadingVerify').style.display = 'none';
			if (!verifyMessageDialog) {
				initVerifyMessageDialog();
			}
			if(id){
				$('verifyEventId').value = id;
				$('verifyIndexId').value = indx;
				$('verify_EmplyId').value = EmplyId;
				$('verify_type').value = type_txt;
				$('conf_msg').innerHTML='Are you sure you want to '+type_txt+' ?';
				$('verifyMessageDialogConfirm').style.display = '';
				$('verifyMessageDialogCancel').style.display = '';
				$('loadingVerify').style.display = 'none';
				if(type_txt=='Unlock'){
					$('not_for_unlock').style.display = 'none';
				}else{
					$('not_for_unlock').style.display = '';
				}
			}
			verifyMessageDialog.show();
		}


		/* message delete */

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
		
		function passwordreset(index, id,employee_ID){
			
			jQuery('#userid').val(employee_ID);
			jQuery('#id').val(id);
			jQuery('#index').text(index);
			
		    var handleSubmit = function() {
		    	if (jQuery('#pass').val() == '' || jQuery('#pass').val() == 0 || jQuery('#pass').val() == null || jQuery('#pass').val() == 'undefined') {
		    		//alert('The checker to notify field is required!');
		    		jQuery('#reset_message').html("<span style='color:red;'>Field required</span>");
		    		jQuery('#pass').focus();
		    		return false;
		    	}else if(jQuery('#pass').val().length < <?=$sys_config->password_min_length?> || jQuery('#pass').val().length > <?=$sys_config->password_max_length?>){

		    		jQuery('#reset_message').html("<span style='color:red;'>Your password must be between <?=$sys_config->password_min_length?> and <?=$sys_config->password_max_length?> digits!</span>");
		    		jQuery('#pass').focus();
		    		return false;
		    	}else if(jQuery('#pass').val().match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9]).{<?=$sys_config->password_min_length?>,<?=$sys_config->password_max_length?>}$/) == null){
		    		jQuery('#reset_message').html("<span style='color:red;'>Must contain 1 capital latter, 1 small latter, 1 numeric and 1 special character!</span>");
		    		jQuery('#pass').focus();
		    		return false;
		    	}
		    	var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			    var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
				var postData = jQuery('#resetpassform').serialize()+"&"+csrfName+"="+csrfHash;
				jQuery.ajax({
						type: "POST",
						cache: false,
						url: '<?=base_url()?>user_info/reset_password',
						data : postData,
						datatype: "json",
						success: function(response){
                          //console.log(response);
							var json = jQuery.parseJSON(response);
							jQuery('.txt_csrfname').val(json.csrf_token);
							 if(json.Message!='OK')
							{
								password_resetd.hide();
								jQuery("#error").show();
								jQuery("#error").fadeOut(11500);
								jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;'+json.Message);	
								window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
							}else{ 
								password_resetd.hide();
								jQuery("#error").show();
								jQuery("#error").fadeOut(11500);
								jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Change Password');	
								window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
								//$('loadingresetpass').style.display = 'none';
								//return true;

							}


						}
					});
				$('resetpassDialogConfirm').style.display = 'none';
				$('resetpassDialogCancel').style.display = 'none';
				$('loadingresetpass').style.display = 'inline';
				
			};
			$('resetpassDialogConfirm').style.display = 'inline';
			$('resetpassDialogCancel').style.display = 'inline';
			$('loadingresetpass').style.display = 'none';
			//jQuery('#email_notification').prop('checked', true);
			password_resetd = new EOL.dialog($('password_reset'), {position: 'fixed', modal:true, width:550, close:true, id: 'password_resetd' });
			
			password_resetd.afterShow = function() {
				$$('#password_resetd #resetpassDialogConfirm').addEvent('click',handleSubmit);
				$$('#password_resetd #resetpassDialogCancel').addEvent('click',function() {password_resetd.hide();});
			};
			password_resetd.show();
		}
		function sendToChecker(index, employee_ID, name) {
			jQuery('#sendToCheckerIndexId').val(employee_ID);
			jQuery('#sendToCheckerEventId').val(index);
			jQuery('#employee_ID').text(employee_ID);
			jQuery('#NAME').text(name);
			var handleSendToCheckerMessageSuccess = function(req) {		  
				var response = eval('(' + req + ')');
				// console.log(response);
				if( response.status == 'success') {
					var row = {};
					row["id"] = response['row_info'].id;
					row["v_sts"] = response['row_info'].v_sts;
				   row["send_to_checker"] = response['row_info'].send_to_checker;
					row["sts"] = response['row_info'].sts;
						
					jQuery("#jqxgrid").jqxGrid('clearselection');
					jQuery.each(row, function(key,val){
						//alert(key+" "+val);
						jQuery("#jqxgrid").jqxGrid('setcellvalue', jQuery('#sendToCheckerEventId').val(), key, row[key]);
					});
					sendToCheckerMessageDialog.hide();
					
					jQuery("#error").show();
					jQuery("#error").fadeOut(11500);
					jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Sent');	
					window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
					// jQuery('#eventWindow').jqxWindow('close');
				} else {
					$('sendToCheckerMessageErrorMsg').innerHTML = response.errorMsgs[0];
					$('sendToCheckerMessageErrorMsg').style.display = '';
				}
		    };
		    var handleSendToCheckerMessageFailure = function(o) {    	
				showInfoDialog( 'sendToCheckerMessagefailuretitle', 'sendToCheckerMessagefailurebody', 'WARN' );
			};
		  
		    var handleSubmit = function() {
		    	// if (jQuery('#checker_to_notify').val() == '' || jQuery('#checker_to_notify').val() == 0 || jQuery('#checker_to_notify').val() == null || jQuery('#checker_to_notify').val() == 'undefined') {
		    	// 	alert('The checker to notify field is required!');
		    	// 	jQuery('#checker_to_notify').focus();
		    	// 	return false;
		    	// }
		    	var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
				var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
				var postData = jQuery('#sendToCheckerMessageform').serialize()+"&"+csrfName+"="+csrfHash;
				var send_to_uri_segment = "<?php if (VERIFY == '1') {echo 'toMaker';} else {echo 'toMaker';} ?>";
				jQuery.ajax({
						type: "POST",
						cache: false,
						url: '<?=base_url()?>user_info/sendToChecker/' + send_to_uri_segment,
						data : postData,
						datatype: "json",
						success: function(response){
                         // console.log(response);
							var json = jQuery.parseJSON(response);
							jQuery('.txt_csrfname').val(json.csrf_token);
							if( json.status == 'success') {
								var row = {};
								row["id"] = json['row_info'].id;
								row["v_sts"] = json['row_info'].v_sts;
							   row["send_to_checker"] = json['row_info'].send_to_checker;
								row["sts"] = json['row_info'].sts;
									
								jQuery("#jqxgrid").jqxGrid('clearselection');
								jQuery.each(row, function(key,val){
									//alert(key+" "+val);
									jQuery("#jqxgrid").jqxGrid('setcellvalue', jQuery('#sendToCheckerEventId').val(), key, row[key]);
								});
								sendToCheckerMessageDialog.hide();
								
								jQuery("#error").show();
								jQuery("#error").fadeOut(11500);
								jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Sent');	
								window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
								// jQuery('#eventWindow').jqxWindow('close');
							} else {
								$('sendToCheckerMessageErrorMsg').innerHTML = response.errorMsgs[0];
								$('sendToCheckerMessageErrorMsg').style.display = '';
							}

							//}


						}
					});
				
				/* var request =  new Request({
					url: '<?=base_url()?>user_info/sendToChecker/' + send_to_uri_segment, 
					method: 'post',
					data: postData,
					datatype: "json",
					onSuccess: function(req) {handleSendToCheckerMessageSuccess(req);},
					onFailure: function(req) {handleSendToCheckerMessageFailure(req);}
				});
				request.send(); */
				$('sendToCheckerMessageDialogConfirm').style.display = 'none';
				$('sendToCheckerMessageDialogCancel').style.display = 'none';
				$('loadingSendToChecker').style.display = 'inline';
			};
			$('sendToCheckerMessageDialogConfirm').style.display = 'inline';
			$('sendToCheckerMessageDialogCancel').style.display = 'inline';
			$('loadingSendToChecker').style.display = 'none';
			//jQuery('#email_notification').prop('checked', true);
			sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {position: 'fixed', modal:true, width:500, close:true, id: 'sendToCheckerMessageDialog' });
			
			sendToCheckerMessageDialog.afterShow = function() {
				$$('#sendToCheckerMessageDialog #sendToCheckerMessageDialogConfirm').addEvent('click',handleSubmit);
				$$('#sendToCheckerMessageDialog #sendToCheckerMessageDialogCancel').addEvent('click',function() {sendToCheckerMessageDialog.hide();});
			};
			sendToCheckerMessageDialog.show();
		}

    </script>

    <div id="jqxgrid"  style=" margin: 10px auto"></div>
    <div style="float:left;padding-top: 5px;padding-left:5px;">
   <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
  <!--  	<strong>D = </strong> Delete,&nbsp;
    	<strong>E = </strong> Edit,&nbsp;
    	<strong>R = </strong> Set User Privilege,&nbsp;
    	<strong>RP = </strong> Reset Password,&nbsp;
    	<strong>UL = </strong> Unlock User,&nbsp;
    	<strong>B = </strong> Block User,&nbsp;
    	<strong>UB = </strong> UnBlock User&nbsp;
    	<strong>V = </strong> View User&nbsp;-->
        <? if(ADD==1){?>
	<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;" 
    href="<?=base_url()?>user_info/from/add" title=""><input type="button" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:40px;width:120px;font-weight:bold"  value="Create User" id="sendButton" /></a>
    <? }?>&nbsp;&nbsp;&nbsp;&nbsp;
		<strong>D = </strong> Delete,&nbsp;
		<strong>P = </strong> Preview,&nbsp;
    	<strong>E = </strong> Edit,&nbsp;
		<strong>SUP = </strong> Set User Privilege,&nbsp;
		<strong>RP = </strong> Reset Password,&nbsp;
    	<strong>DACT = </strong> Deactivate User,&nbsp;
    	<strong>ACT = </strong> Activate User,&nbsp;
		<strong>STA = </strong> Sent to Approver,&nbsp;
    	<strong>APV = </strong> Approve
    </div> <br/>
    
	
	</div>
   
  <!-- Delete information-->
<style>
* { padding:0px; margin:0px; }
</style>
        <div id="deleteMessageDialogContent"  style="display:none">
          <div class="hd"><h2 class="conf">Are you sure you want to delete these user info(s)?</h2></div>
          <form method="POST" name="deleteMessageform" id="deleteMessageform"  style="margin:0px;">
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="action" value="DeleteMessage" type="hidden">
            <input name="type"  id="type" value="delete" type="hidden">
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

        <div style="display: none; padding:0px; margin:0px;" id="SelctOnetitle">We're Sorry</div>
		<div style="display: none;" id="SelctOnebody">Please select at least one user info.</div>


		<!-- Delete information-->
    	<div id="verifyMessageDialogContent"  style="display:none">
          <div class="hd"><h3 class="conf" id="conf_msg"></h3></div>
          <form method="POST" name="verifyMessageform" id="verifyMessageform"  style="margin:0px;">
            <input name="verifyEventId" id="verifyEventId" value="" type="hidden">
            <input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
            <input name="verify_EmplyId" id="verify_EmplyId" value="" type="hidden">
            <input name="verify_type"  id="verify_type" value="" type="hidden">
          	<div class="bd">
              <div class="inlineError" id="verifyMessageErrorMsg" style="display:none">Remarks Required</div>
            </div>
            <div id="not_for_unlock" style="margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
  			<table>
  				<tr>
  					<td></td>
  					<td><div id="message" style="height:25px;"></div></td>
  				</tr>
  				<tr>
  					<td>Remarks<span style="color: red;">*</span>: </td>
  					<td>
  						<input type="text" id="act_dec_Remarks" name="act_dec_Remarks"  maxlength="150" >
  					</td>
  				</tr>
  			</table>          	 
          	
          </div>
          <br>
            <a class="btn-small btn-small-normal" id="verifyMessageDialogConfirm"><span>Yes</span></a>
            <a class="btn-small btn-small-secondary" id="verifyMessageDialogCancel"><span>Cancel</span></a>
            <span id="loadingVerify" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
            </form>
        </div>
	 	<!--Customization End-->
	</div>
</div>
<div id='jqxwindow'>
	<div id="windowHeader">
        <span>
            User Details
        </span>
    </div>
	<div style="">
		<div id="user_info" style="padding:10px;"></div>
	
	</div>
</div>

 <div id="sendToCheckerMessageDialogContent"  style="display:none">
      <div class=""><h2 class="conf">Do you want to send this user profile to approve?</h2></div>
      <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform"  style="margin:0px;">
        <input name="sendToCheckerEventId" id="sendToCheckerEventId" value="" type="hidden">
        <input name="sendToCheckerIndexId" id="sendToCheckerIndexId" value="" type="hidden">
        <input name="action" value="DeleteMessage" type="hidden">
        <input name="type"  id="type" value="delete" type="hidden">
      	<div class="bd">
          <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
          <div class="instrText" style="margin-bottom: 20px"></div>
          <div style="margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
          	User ID:&nbsp;<span><strong id="employee_ID"></strong></span></br>
          	User Name:&nbsp;<span><strong id="NAME"></strong></span><br/>
          	
           <div style="display:none">
            Select Checker To Notify: <span style="color: red;">*</span> 
          	<select name="checker_to_notify" id="checker_to_notify">
          		<option value="">Select a Checker</option>
          		<?php $count = 0; ?>
          		<?php foreach ($checker_info as $checker): ?>
          			<?php $count++; ?>
              		<option value="<?=$checker->id?>" <?php if ($count == 1) echo "selected"; ?> ><?=$checker->name.' ('.$checker->user_id.')'?></option>
          		<?php endforeach; ?>
          	</select><br>
          	Notify By:&nbsp;&nbsp;
          	<label>
          		<input type="checkbox"  name="email_notification" id="email_notification" value="email"> Email
          	</label>
            </div>
          	<!--&nbsp;&nbsp;&nbsp;
          	<label>
          		<input type="checkbox" name="sms_notification" id="sms_notification" value="sms"> SMS
          	</label>-->
          </div>
        </div>
        <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm"><span>Send</span></a> 
        <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel"><span>Cancel</span></a> 
        <span id="loadingSendToChecker" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </form>
    </div>

<div id="password_reset"  style="display:none">
      <div class=""><h2 class="conf">Do you want to reset password?</h2></div>
      <form method="POST" name="resetpassform" id="resetpassform"  style="margin:0px;">
        <input name="userid" id="userid" value="" type="hidden">
        <input name="index" id="index" value="" type="hidden">
        <input name="id" id="id" value="" type="hidden">
      	<div class="bd">
          <div class="inlineError" id="resetpassMessageErrorMsg" style="display:none"></div>
          <div class="instrText" style="margin-bottom: 20px"></div>
          <div style="margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
  			<table>
  				<tr>
  					<td></td>
  					<td><div id="reset_message" style="height:25px;"></div></td>
  				</tr>
  				<tr>
  					<td>Password<span style="color: red;">*</span>: </td>
  					<td>
  						<input type="password" id="pass" name="pass" autocomplete="off" maxlength="<?=$sys_config->password_max_length?>" >
  					</td>
  				</tr>
  			</table>
          	 
          	<br>
          </div>
        </div>
        <a class="btn-small btn-small-normal" id="resetpassDialogConfirm"><span>Send</span></a> 
        <a class="btn-small btn-small-secondary" id="resetpassDialogCancel"><span>Cancel</span></a> 
        <span id="loadingresetpass" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </form>
    </div>


