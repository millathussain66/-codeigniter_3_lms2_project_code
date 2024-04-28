<script type="text/javascript" src="<?=base_url()?>js/jquery.ajaxupload.js"></script>
<style type="text/css">
	.button {
	  background-color: #4CAF50; /* Green */
	  border: none;
	  color: white;
	  padding: 16px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  margin: 4px 2px;
	  transition-duration: 0.4s;
	  cursor: pointer;
	}
	.button1 {
	  background-color: #555555; /* Green */
	  border: none;
	  color: white;
	  padding: 5px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;;
	  border-radius: 12px;
	}
	.buttonsendtochecker {
		   background-color: white; 
		  color: black; 
		  border: 2px solid #008CBA;
		  border-radius: 12px;
		  padding: 10px 20px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 16px;
		  margin: 4px 2px;
		  transition-duration: 0.4s;
		  cursor: pointer;
		}
		.buttonsendtochecker:hover {
		  background-color: #008CBA;
		  color: white;
		}
	/* td:nth-child(2) {
	    padding-right: 20px;
	 }​  */
	#ext {
	        border-collapse: separate;
	        border-spacing: 0 15px;
	      }

	.button_delete {
	  background-color: #00ffff; /* Green */
	  border: none;
	  color: white;
	  padding: 5px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  margin: 4px 2px;
	  transition-duration: 0.4s;
	  cursor: pointer;
	}

	.button3 {
	  background-color: #4CAF50;
	  color: black;
	}
	table {
			border-collapse: collapse;
		}
	table#preview_table td {
			border: 1px solid #c7c7c7;
		}
	.button4 {
	  background-color: #00ffff;
	  color: black;
	}

	.button3,.button4:hover {
	  background-color: #f44336;
	  color: white;
	}
	.center {
	  margin: 0;
	  position: absolute;
	  top: 90%;
	  left: 50%;
	  -ms-transform: translate(-50%, -50%);
	  transform: translate(-50%, -50%);
	}
	/* .center {
	  margin: auto;
	  width: 20%;
	  padding: 10px;
	} */
       .text-input
        {
            height: 23px;
            width: 350px;
        }


		.required
		{
			vertical-align: baseline;
			color: red;
			font-size: 10px;
		}

    #details {
     font-family: Arial, Helvetica, sans-serif;
     border-collapse: collapse;
     width: 100%;
   }
    b {
       font-size: 14px;
    }


		#details td, #details th {
		  border: 1px solid #ddd;
		  padding: 8px;
		}
		#details  th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: center;
		  background-color: #4CAF50;
		  color: white;
		}
	</style>

<div id="container">
	<div id="body"  >
    <!--Customization Start-->
	<script type="text/javascript">
		var csrf_tokens='';
    var idd = 0; var indxx = 0;
    var email = '<?php foreach($user_list as $k=>$val){ if($k>0){echo ';';} echo $val->email_address;}?>';
	  jQuery(document).ready(function($) {
	   	
      // prepare the data
      //var theme = 'energyblue';
      var theme = 'classic';
			
			var initGrid = function () {
	    	var source =
	      {
          datatype: "json",
          datafields: [
					{ name: 'id', type: 'int'},
					{ name: 'checker_id', type: 'int'},
					{ name: 'sts', type: 'string'},
					{ name: 'request_date', type: 'string'},
					{ name: 'inform_date', type: 'string'},
					{ name: 'certificate_rec_dt', type: 'string'},
					{ name: 'certificate_sts', type: 'string'},
					{ name: 'certificate_file', type: 'string'},
					{ name: 'remarks', type: 'string'},
					{ name: 'v_sts', type: 'int'},
					{ name: 'stc_sts', type: 'int'},
					{ name: 'send_head_by', type: 'int'},
					{ name: 'send_head_dt', type: 'int'},
					{ name: 'status_name', type: 'string'},
					{ name: 'venlaw_name', type: 'string'},
					{ name: 'request_name', type: 'string'},
					{ name: 'certificate_name', type: 'string'},
					{ name: 'e_dt', type: 'string'},
					{ name: 'send_fi_dt', type: 'string'},
					{ name: 'receive_head_dt', type: 'string'},
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
			  	url: '<?=base_url()?>index.php/bill_ait/grid',
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
				});
			  var columnCheckBox = null;
        var updatingCheckState = false;
        // initialize jqxGrid. Disable the built-in selection.
        var celledit = function (row, datafield, columntype) {
          var checked = jQuery('#jqxgrid').jqxGrid('getcellvalue', row, "available");
          if (checked == false) {
            return false;
          };
        };
	      jQuery("#jqxgrid").jqxGrid({
	        width:'99%',
					height:305,
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
						{ text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
						{ text: 'sts', datafield: 'sts',hidden:true },
					  { text: 'v_sts', datafield: 'v_sts',hidden:true },
	 					<? if(ACKOWLEDGMENTREQUEST==1){?>
 						{ text: '',menu: false,  datafield: 'available', sortable: false, columntype: 'checkbox', width: 40,
						  renderer: function () {
							  return '<div style="margin-left: 10px; margin-top: 5px;"></div>';
						  },
						  rendered: function (element) {
							  jQuery(element).jqxCheckBox({ theme: theme, width: 16, height: 16, animationShowDelay: 0, animationHideDelay: 0 });
							  columnCheckBox = jQuery(element);
							  jQuery(element).on('change', function (event) {
								  var checked = event.args.checked;
								  if (checked == null || updatingCheckState) return;
								  var rowscount = jQuery("#jqxgrid").jqxGrid('getdatainformation').rowscount;
								  jQuery("#jqxgrid").jqxGrid('beginupdate');
								  if (checked) {
									  jQuery("#jqxgrid").jqxGrid('selectallrows');
								  }
								  else if (checked == false) {
									  jQuery("#jqxgrid").jqxGrid('clearselection');
								  }
								  for (var i = 0; i < rowscount; i++) {
									  jQuery("#jqxgrid").jqxGrid('setcellvalue', i, 'available', event.args.checked);
								  }
								  jQuery("#jqxgrid").jqxGrid('endupdate');
							  });
							  return true;
						  }
					  },
						<?php }  ?>
						
						{ text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
				  			cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'details\','+editrow+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

							  }
					  	},
					  	{ text: 'History', menu: false, datafield: 'history', align:'center', editable: false, sortable: false, width: '5%',
				  			cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="r_history('+dataRecord.id+')" ><img align="center" src="<?=base_url()?>images/history.png"></div>';

							  }
					  	},
					  	{ text: 'Certificate Type', datafield: 'certificate_name',editable: false, width: '10%'},
					  	{ text: 'Type', datafield: 'request_name',editable: false, width: '8%'},
					  	{ text: 'Name', datafield: 'venlaw_name',editable: false, width: '13%'},
					  	{ text: 'Current Status', datafield: 'status_name',editable: false, width: '13%'},
					  	{ text: 'Request date', datafield: 'e_dt',editable: false, width: '15%'},
					  	{ text: 'Inform to Finance team', datafield: 'send_fi_dt',editable: false, width: '13%'},
					  	{ text: 'Certificate Received', datafield: 'receive_head_dt',editable: false, width: '13%'},
					  	{ text: 'AIT & VAT File', editable: false, datafield: 'certificate_file', filterable: false,sortable: false, menu: false, width: 120, align: 'center', cellsalign: 'center',
					  	cellsrenderer: function (row){
					  		var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', row);	
					  		if (dataRecord.stc_sts==71) 
					  		{
					  			return ' <a href="<?=base_url()?>cma_file/bill_ait_vat/'+dataRecord.certificate_file+'" download="'+dataRecord.certificate_file+'"> <div style=" margin-top: 5px; cursor:pointer;text-align:center" ><img src="<?=base_url()?>images/download_icon.png"></div></a>'
					  		}
					  		else
					  		{
					  			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
					  		}
					  	}
					  },
						{ text: 'Remarks', datafield: 'remarks',editable: false, width: '15%' },
					]
        });
				//jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 700, height:250, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK") });

				//End check box start 
				jQuery("#jqxgrid").on('cellbeginedit', function (event) {
          var column = event.args.datafield;
          var row = event.args.rowindex;
          var value = event.args.value;
          var rowindexes = jQuery('#jqxgrid').jqxGrid('getselectedrowindexes');
        });
        // select or unselect rows when the checkbox is checked or unchecked.
        jQuery("#jqxgrid").on('cellendedit', function (event) {
          if (event.args.value) {
            jQuery("#jqxgrid").jqxGrid('selectrow', event.args.rowindex);
          }
          else {
            jQuery("#jqxgrid").jqxGrid('unselectrow', event.args.rowindex);
          }
          if (columnCheckBox) {
            var selectedRowsCount = jQuery("#jqxgrid").jqxGrid('getselectedrowindexes').length;
            var rowscount = jQuery("#jqxgrid").jqxGrid('getdatainformation').rowscount;
            updatingCheckState = true;
            if (selectedRowsCount == rowscount) {
                jQuery(columnCheckBox).jqxCheckBox('check')
            }
            else if (selectedRowsCount > 0) {
                jQuery(columnCheckBox).jqxCheckBox('indeterminate');
            }
            else {
                jQuery(columnCheckBox).jqxCheckBox('uncheck');
            }
            updatingCheckState = false;
          }
        });
				//End check box update 
				jQuery("#ack").jqxButton({ theme: theme });
			}
			var initGrid2 = function () {
				var source ={
		      datatype: "json",
		      datafields: [
						{ name: 'id', type: 'int'},
						{ name: 'checker_id', type: 'int'},
						{ name: 'sts', type: 'string'},
						{ name: 'request_date', type: 'string'},
						{ name: 'inform_date', type: 'string'},
						{ name: 'certificate_rec_dt', type: 'string'},
						{ name: 'certificate_sts', type: 'string'},
						{ name: 'certificate_file', type: 'string'},
						{ name: 'remarks', type: 'string'},
						{ name: 'v_sts', type: 'int'},
						{ name: 'stc_sts', type: 'int'},
						{ name: 'send_head_by', type: 'int'},
						{ name: 'send_head_dt', type: 'int'},
						{ name: 'status_name', type: 'string'},
						{ name: 'venlaw_name', type: 'string'},
						{ name: 'request_name', type: 'string'},
						{ name: 'certificate_name', type: 'string'},
						{ name: 'e_dt', type: 'string'},
						{ name: 'send_fi_dt', type: 'string'},
						{ name: 'receive_head_dt', type: 'string'},

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
					url: '<?=base_url()?>index.php/bill_ait/grid2',
					cache: false,
					filter: function()
					{
						// update the grid and send a request to the server.
						jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
					},
					sort: function()
					{
						// update the grid and send a request to the server.
						jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
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
          var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
          if (checked == false) {
              return false;
          };
      };
      jQuery("#jqxGrid2").jqxGrid(
      {
        width:'99%',
				height:305,
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
					{ text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
					{ text: 'sts', datafield: 'sts',hidden:true },
			  	{ text: 'v_sts', datafield: 'v_sts',hidden:true },
			  	{ text: 'stc_sts', datafield: 'stc_sts',hidden:true },
					<? if(SENDTOACKOWLEDGMENT==1){?>
					{ text: '',menu: false,  datafield: 'available', sortable: false, columntype: 'checkbox', width: 40,
					  renderer: function () {
						  return '<div style="margin-left: 10px; margin-top: 5px;"></div>';
					  },
					  rendered: function (element) {
					  
						  jQuery(element).jqxCheckBox({ theme: theme, width: 16, height: 16, animationShowDelay: 0, animationHideDelay: 0 });
						  columnCheckBox = jQuery(element);
						  jQuery(element).on('change', function (event) {
							  var checked = event.args.checked;
							  if (checked == null || updatingCheckState) return;
							  var rowscount = jQuery("#jqxGrid2").jqxGrid('getdatainformation').rowscount;
							  jQuery("#jqxGrid2").jqxGrid('beginupdate');
							  if (checked == false) {
								  jQuery("#jqxGrid2").jqxGrid('clearselection');
							  }
							  for (var i = 0; i < rowscount; i++) {
							  		
								var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', i);
								if(dataRecord.stc_sts=='6')
								{
								  jQuery("#jqxGrid2").jqxGrid('setcellvalue', i, 'available', event.args.checked);
								  jQuery("#jqxGrid2").jqxGrid('selectrow', i)
								 }
							  }
							  jQuery("#jqxGrid2").jqxGrid('endupdate');
						  });
						  return true;
					  }			
				  },
				  <?php } ?>
				  <? if(SENDTOACKOWLEDGMENT==1){?>
				  { text: 'STF', datafield: 'sendtofinance', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                  	cellsrenderer: function(row) {
	                  		editrow = row;
						var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
						if(dataRecord.stc_sts == '70'){
							return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">S</div>';
					 	}
					 	
	          }
	        },
				  <? }?>
				  <? if(CERTIFICATEUPLOAD==1){?>
				 	{ text: 'RF', datafield: 'received_file', editable: false,align:'center', sortable: false, menu: false, width: 35,
              	cellsrenderer: function(row) {
              		editrow = row;
						var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
						if(dataRecord.stc_sts == '70'){
							return '<div style="text-align:center;margin-top: 3px;  cursor:pointer" onclick="fileupload('+dataRecord.id+','+editrow+','+dataRecord.stc_sts+');" ><img align="center" src="<?=base_url()?>images/upload.png"></div>';
			 			}else if(dataRecord.stc_sts == '71' || dataRecord.stc_sts == '96'){
			 				return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">RF</div>';
			 			}
            }
          },
          <? }?>
          <? if(LAWYERNOTIFICATIONSENT==1){?>
				 	{ text: 'STL', datafield: 'sendlegal', editable: false,align:'center', sortable: false, menu: false, width: 35,
              	cellsrenderer: function(row) {
              		editrow = row;
						var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
						if(dataRecord.stc_sts == '71'){
							return '<div style="text-align:center;margin-top: 3px;  cursor:pointer" onclick="details('+dataRecord.id+',\'sendtolegal\','+editrow+')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
			 			}else if(dataRecord.stc_sts == '96'){
			 				return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">S</div>';
			 			}else{
			 				return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
			 			}
            }
          },
          <? }?>
			  	{ text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
				  			cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'details\','+editrow+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

							  }
					  	},
					  	{ text: 'History', menu: false, datafield: 'history', align:'center', editable: false, sortable: false, width: '5%',
				  			cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="r_history('+dataRecord.id+')" ><img align="center" src="<?=base_url()?>images/history.png"></div>';

							  }
					  	},
					  	{ text: 'AIT & VAT File', editable: false, datafield: 'certificate_file', filterable: false,sortable: false, menu: false, width: 120, align: 'center', cellsalign: 'center',
						  	cellsrenderer: function (row){
						  		var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', row);	
						  		if (dataRecord.stc_sts==71 || dataRecord.stc_sts==96) 
						  		{
						  			return ' <a href="<?=base_url()?>cma_file/bill_ait_vat/'+dataRecord.certificate_file+'" download="'+dataRecord.certificate_file+'"> <div style=" margin-top: 5px; cursor:pointer;text-align:center" ><img src="<?=base_url()?>images/download_icon.png"></div></a>'
						  		}
						  		else
						  		{
						  			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
						  		}
						  	}
						  },
					  	{ text: 'Certificate Type', datafield: 'certificate_name',editable: false, width: '10%'},
					  	{ text: 'Type', datafield: 'request_name',editable: false, width: '8%'},
					  	{ text: 'Name', datafield: 'venlaw_name',editable: false, width: '13%'},
					  	{ text: 'Current Status', datafield: 'status_name',editable: false, width: '15%'},
					  	{ text: 'Request date', datafield: 'e_dt',editable: false, width: '15%'},
					  	{ text: 'Inform to Finance team', datafield: 'send_fi_dt',editable: false, width: '13%'},
					  	{ text: 'Certificate Received', datafield: 'receive_head_dt',editable: false, width: '13%'},
					  	
					{ text: 'Remarks', datafield: 'remarks',editable: false, width: '15%' },
				],
					
	    });
				
			jQuery("#fileupload").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 500, height:200, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOKfile") });
			//End check box start 
			//End check box start 
			jQuery("#jqxGrid2").on('cellbeginedit', function (event) {
        var column = event.args.datafield;
        var row = event.args.rowindex;
        var value = event.args.value;
        var rowindexes = jQuery('#jqxGrid2').jqxGrid('getselectedrowindexes');
      });
      // select or unselect rows when the checkbox is checked or unchecked.
      jQuery("#jqxGrid2").on('cellendedit', function (event) {

    	 	var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', event.args.rowindex);
			  if(dataRecord.stc_sts!=6)
			  {			   		
					alertMSG('applicationverifydelete');
					jQuery("#jqxGrid2").jqxGrid('setcellvalue', event.args.rowindex, 'available', false);
					jQuery("#jqxGrid2").jqxGrid('unselectrow', event.args.rowindex)
			  }else{
					if (event.args.value) {
              jQuery("#jqxGrid2").jqxGrid('selectrow', event.args.rowindex);
          }
          else {
              jQuery("#jqxGrid2").jqxGrid('unselectrow', event.args.rowindex);
          }
				}

		                
        if (columnCheckBox) {

            var selectedRowsCount = jQuery("#jqxGrid2").jqxGrid('getselectedrowindexes').length;
            var rowscount = jQuery("#jqxGrid2").jqxGrid('getdatainformation').rowscount;
            updatingCheckState = true;
            if (selectedRowsCount == rowscount) {
                jQuery(columnCheckBox).jqxCheckBox('check')
            }
            else if (selectedRowsCount > 0) {
                jQuery(columnCheckBox).jqxCheckBox('indeterminate');
            }
            else {
                jQuery(columnCheckBox).jqxCheckBox('uncheck');
            }
            updatingCheckState = false;
        }
    	});
			//End check box update 
			jQuery("#stf").jqxButton({ theme: theme });
			}
			// init widgets.
      var initWidgets = function (tab) {
        switch (tab) {
            case 0:
                initGrid();
                break;
            case 1:
                initGrid2();
                break;
        }
      }

      $('#jqxTabs').jqxTabs({ width: '99%', height: 380,  initTabContent: initWidgets });

       if( localStorage.getItem('activeTab') == 'Send To Finance'){
				jQuery('#jqxTabs').jqxTabs('select', 1);
			}
	   	jQuery('#jqxTabs').bind('selected', function (event, ui) {
        var item = event.args.item;
        var title = jQuery('#jqxTabs').jqxTabs('getTitleAt', item);
        jQuery("#jqxgrid").jqxGrid('updatebounddata');
        jQuery("#jqxGrid2").jqxGrid('updatebounddata');
        if(title=='Send To Finance')
        {
          localStorage.setItem('activeTab', 'Send To Finance');
        }else{localStorage.setItem('activeTab', '');}

      });
      jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 700, height:400, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#deletecancel,#SendTocheckercancel") });
			jQuery("#r_history").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 700, height:350, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
			jQuery('#details').on('close', function (event) {
			    jQuery('#action_form').jqxValidator('hide');
			});


			jQuery("#sendtochecker").click(function () {
        jQuery("#sendtochecker").hide();
        jQuery("#SendTocheckercancel").hide();
        jQuery("#sendtochecker_loading").show();
        delete_submit();
      	
   		});

  	});

		
	function delete_record_message (objId,go_for,indx,sts) {
		jQuery('#deleteEventId').val(objId);
		jQuery('#verifyIndexId').val(indx);
		jQuery('#sts').val(sts);
		jQuery('#type').val(go_for);
		//alert(go_for);
		//For Delete Action
		if (go_for=='delete') 
		{
			//alert(go_for);
			jQuery('#sendtocheckerdiv').css("display", "none");
			jQuery('#deletediv').css("display", "block");
			jQuery('#comments').val('');
			jQuery('#message').html('Delete this Certificate?');
		}
		//For sendtochecker
		else if(go_for=='sendtochecker')
		{
			jQuery('#sendtocheckerdiv').css("display", "block");
			jQuery('#deletediv').css("display", "none");
			jQuery('#message').html('Head Office?');
		}
		else
		{
			jQuery('#sendtocheckerdiv').css("display", "none");
			jQuery('#deletediv').css("display", "none");
			jQuery('#message').html('Verify This Certificate?');
		}
		deleteMessageDialog = new EOL.dialog($('deleteMessageDialogContent'), {position: 'fixed', modal:true, width:570, close:true, id: 'deleteMessageDialog' });

		deleteMessageDialog.afterShow = function() {
			$$('#deleteMessageDialog #deleteMessageDialogConfirm').addEvent('click',delete_records);
			$$('#deleteMessageDialog #deleteMessageDialogCancel').addEvent('click',function() {deleteMessageDialog.hide();});
		};
		$('deleteMessageErrorMsg').innerHTML = '';
		$('deleteMessageErrorMsg').style.display = 'none';
		deleteMessageDialog.show();
	}

		/* message delete */
		var deleteMessageDialog;
		
	function initDeleteMessageDialog() {
		
			// Define various event handlers for Dialog
			var handleCancel = function() {
				this.hide();
			};
		  var handleDeleteMessageSuccess = function(req) {

			var response = eval('(' + req + ')');
			//console.log(response);
			jQuery('.txt_csrfname').val(response.csrf_token);
			if( response.Message == 'OK') {				
				deleteMessageDialog.hide();
				//reload results
				//reloadCurrentMessages();
				var msz='';var grid= response.grid;
						//if($('comments_sts').value=='0'){msz=' comments send';}
						jQuery("#"+grid).jqxGrid('updatebounddata');
						jQuery("#loading").hide();
						jQuery("#deleteMessageDialogConfirm").show();
						jQuery("#deleteMessageDialogCancel").show();
						jQuery("#error").show();
						jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});								
						jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz);	
						deleteMessageDialog.hide();
			} else {
				$('deleteMessageErrorMsg').innerHTML = response.errorMsgs[0];
				$('deleteMessageErrorMsg').style.display = '';
			}
		  };
		  var handleDeleteMessageFailure = function(o) {    	
				showInfoDialog( 'deleteMessagefailuretitle', 'deleteMessagefailurebody', 'WARN' );
		  };
		  
		  var handleSubmit = function() {
		  	var csrfName = jQuery('.txt_csrfname').attr('name');
			var csrfHash = jQuery('.txt_csrfname').val();
			var postData = $('deleteMessageform').toQueryString()+"&"+csrfName+"="+csrfHash;
			//alert(postData);
			var request =  new Request({	url: '<?=base_url()?>bill_ait/delete_action', 
											method: 'post',
											data: postData,
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

		
		function delete_records(objId,opera,grid)
		{

				if (!deleteMessageDialog) {

					initDeleteMessageDialog();
				}
				if(objId == 'bulk') {
					var selectedrowindexes = jQuery("#"+grid).jqxGrid('getselectedrowindexes');
					var selectedRowsCount = jQuery("#"+grid).jqxGrid('getselectedrowindexes').length;
					var rowscount = jQuery("#"+grid).jqxGrid('getdatainformation').rowscount;
					// begin update. Stops the Grid's rendering.
					jQuery("#"+grid).jqxGrid('beginupdate');
					
					selectedrowindexes.sort();
					var eventIds = '';
    				var first = true;
						// get the indexes of the selected rows.
						// delete the selected rows by using the 'deleterow' method of jqxGrid.
						for (var m = 0; m < selectedrowindexes.length; m++) {
							var selectedrowindex = selectedrowindexes[selectedrowindexes.length - m - 1];
							if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
												var id = jQuery("#"+grid).jqxGrid('getcellvalue', selectedrowindex, 'id');
													if(first) {
														first = false;
													}
													else {
														eventIds += ',';
													}
													eventIds += id;
								//jQuery("#jqxgrid").jqxGrid('deleterow', id);
							}
						}
						// end update. Resume the Grid's rendering.
						jQuery("#"+grid).jqxGrid('endupdate');
					
					if(!eventIds) {
						deleteMessageDialog.hide();
						showInfoDialog( 'SelctOnetitle', 'SelctOnebody', 'WARN' )
						//alert('Please select at least one message.');
						return;
					}
					if(grid=='jqxgrid'){
						jQuery("#he_title").html('Are you sure you want to acknowledgment?');
						jQuery("#email").val('');
						jQuery('#email_box').hide();
						jQuery("#email").val(email);
					}else{
						jQuery("#he_title").html('Are you sure you want send to Finanace?');
						jQuery('#email_box').show();
						jQuery("#email").val(email);
					}

					jQuery("#eventid").val(eventIds);					
					jQuery("#typec").val(opera);					
					jQuery("#grid").val(grid);									
				}else {
					jQuery("#deleteEventId").val(objId);	
				}
				resetDeleteMessageErrors();
    			deleteMessageDialog.show();
		}
function delete_submit(){
    var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
    var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
    var postData = jQuery('#action_form').serialize()+"&"+csrfName+"="+csrfHash;
    //console.log(postData);
    //return false
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: '<?=base_url()?>index.php/ait_vat/delete_action/',
        data : postData,
        datatype: "json",
        success: function(response){
            //console.log(response);
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            if(json.Message!='OK')
            {                               
                if ($('type').value=='sendtolegal') 
                {
                    jQuery("#sendtochecker").show();
                    jQuery("#SendTocheckercancel").show();
                    jQuery("#sendtochecker_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }
                else
                {
                    jQuery("#sendtochecker").show();
                    jQuery("#SendTocheckercancel").show();
                    jQuery("#checker_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }
                return false;
            }else{

                if($('type').value=='sendtolegal'){
                    
                    jQuery("#sendtochecker").show();
                    jQuery("#SendTocheckercancel").show();
                    jQuery("#sendtochecker_loading").hide();
                }
                else
                {
                    jQuery("#sendtochecker").show();
                    jQuery("#SendTocheckercancel").show();
                    jQuery("#checker_loading").hide();
                }
                var msz='';
                jQuery("#error").show();
                jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                jQuery('#details').jqxWindow('close');
                jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                        
            }
        }
    });
}
	function resetDeleteMessageErrors() {
			$('deleteMessageErrorMsg').innerHTML = '';
			$('deleteMessageErrorMsg').style.display = 'none';
		}
		function r_history (id) {
		jQuery("#r_heading").html('Life Cycle');
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>ait_vat/history",
			data : {[csrfName]: csrfHash,id: id},
			datatype: "json",
			success: function(response){
				//alert(response);
				var ret = response.split("####");
				jQuery('.txt_csrfname').val(ret[1]);
					if(ret[0])
					{
						document.getElementById("r_history").style.visibility='visible';
						jQuery("#r_history_details").html(ret[0]);
						jQuery("#r_history").jqxWindow('open');
					}
					else {
						alert("Something went wrong, please refresh the page.")
					}

			}
		});
	}
	
	function call_ajax_submit()
	{
		
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = jQuery('#action_form').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: '<?=base_url()?>index.php/ait_vat/delete_action/',
				data : postData,
				datatype: "json",
				success: function(response){
                  ///console.log(response);
					var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
						if(json.Message!='OK')
						{								
							if ($('type').value=='delete') 
							{
								jQuery("#delete_button").show();
								jQuery("#deletecancel").show();
								jQuery("#delete_loading").hide();
								jQuery('#details').jqxWindow('close');
								alert(json.Message);
							}
							else
							{
								jQuery("#sendtochecker").show();
								jQuery("#SendTocheckercancel").show();
								jQuery("#sendtochecker_loading").hide();
								jQuery('#details').jqxWindow('close');
								alert(json.Message);
							}
							return false;
						}else{

						if ($('type').value=='delete') 
						{
							jQuery("#delete_button").show();
							jQuery("#deletecancel").show();
							jQuery("#delete_loading").hide();
						}
						else
						{
							jQuery("#sendtochecker").show();
							jQuery("#SendTocheckercancel").show();
							jQuery("#sendtochecker_loading").hide();
						}
						var row = {};
						
						
						jQuery("#error").show();
						jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});								
						jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value);	
						jQuery('#details').jqxWindow('close');
						jQuery("#jqxgrid").jqxGrid('updatebounddata');
						
					}
				}
			});

	}
	function details(id,operation,index)
	{
		
		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery('#verifyIndexId').val(index);
		if(operation=='details'){
			jQuery("#header_title").html('AIT & VAT Certificate Details');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').show();
		}else if(operation=='delete'){
			jQuery("#header_title").html('AIT & VAT Certificate Delete');
			jQuery('#comments').val('');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').show();
			jQuery('#close_btn_row').hide();
		}else if (operation == 'sendtoho'){
			jQuery("#header_title").html('AIT & VAT Certificate Send To HO');
			jQuery('#sendtochecker_row').show();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
		}else if (operation == 'sendtolegal'){
			jQuery("#header_title").html('AIT & VAT Certificate Send To Legal');
			jQuery('#sendtochecker_row').show();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
		}else{

		}
		var csrfName = jQuery('.txt_csrfname').attr('name');
		var csrfHash = jQuery('.txt_csrfname').val();
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>ait_vat/details",
			data : {[csrfName]: csrfHash,id: id},
			datatype: "json",
			success: function(response){
				var json = jQuery.parseJSON(response);

				jQuery('.txt_csrfname').val(json['csrf_token']);
					if(json.str)
					{
						//console.log(json.str);
						document.getElementById("details").style.visibility='visible';
						jQuery("#priview").html(json.str);
						jQuery("#details").jqxWindow('open');
					}
					else {
						alert("Something went wrong, please refresh the page.")
					}

			}
		});
	}
		function decline_action()
		{
			jQuery("#decline_check").val(1);
			jQuery('#decline_part').css("display", "block");

		}
		function alertMSG(divids)
		{						
			alertmsginfo= new EOL.dialog($(divids), {position: 'fixed', modal:true, width:470, close:true});
			alertmsginfo.show();			
		}
		function fileupload(id,index,status){
			document.getElementById("fileupload").style.visibility='visible';
			jQuery("#rowid").val(id);	
			jQuery("#index").val(index);	
			jQuery("#status").val(status);
			jQuery("#fileupload").jqxWindow('open');
		}
		function fileValidation(name){
			//alert(name);
			var fileInput = document.getElementById(name);
	    var filePath = fileInput.value;
	    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i;
	    var fileSize = document.getElementById(name).files[0].size;
	    if(!allowedExtensions.exec(filePath)){
	        alert('Only jpg, jpeg, png, gif, pdf file is allowed');
	        fileInput.value = '';
	        return false;
	    }
	   	return true;
		}
		

	</script>
	<div id='jqxTabs'>
    <ul>
        <li style="margin-left: 30px;">Acknowledgement</li>
        <li>Send To Finance</li>
    </ul>
    <div style="overflow: hidden;">
        <div style="border:none;" id="jqxgrid">
        </div>
        <div style="float:left;padding-top: 5px;padding-left:5px;">
	  <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
		<? if(ADD==1){?>
			<input type="button" id="ack" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:125px;" name="delete" onclick="delete_records('bulk','acknowledgment','jqxgrid');" value="Acknowledgment" />
	    <? }?> 
    	<strong>P = </strong> Preview&nbsp;
	    </div> <br/>
		</div>
    </div>
    <div style="overflow: hidden;">
        <div style="border:none;" id="jqxGrid2"></div>
        <div style="float:left;padding-top: 5px;padding-left:5px;">
	  <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
		<? if(ADD==1){?>
		<input type="button" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:120px;" id="stf" name="delete" onclick="delete_records('bulk','Send to Finance','jqxGrid2');" value="Send to Finance" />
	    <? }?> 
	    <strong>STF = </strong> Send To Finance,&nbsp;
	    <strong>P = </strong> Preview,&nbsp;
	    <strong>RF = </strong> Receive File&nbsp;
	    </div> <br/>
		</div>
    </div>
  </div>
  <!--div id="jqxgrid" style="margin: 10px auto;"></div-->
	
<style>
* { padding:0px; margin:0px; }
</style>
<!-- Model For Delete Message -->
<div id="deleteMessageDialogContent"  style="display:none">
	<div class="hd"><h2 class="conf" id="he_title"></h2></div>
  <form method="POST" name="deleteMessageform" id="deleteMessageform"  style="margin:0px;">
    <input name="eventid" id="eventid" value="" type="hidden">
    <input name="action" value="DeleteMessage" type="hidden">
    <input name="typec"  id="typec" value="" type="hidden">
    <input name="grid"  id="grid" value="" type="hidden">
  	<div class="bd">
      <div class="inlineError" id="deleteMessageErrorMsg" style="display:none"></div>
      <div class="instrText" style="margin-bottom: 20px">
       This action is permanent.
       <div id="email_box">
       <br>
       <br>
       <label>Email: </label> <input type="text" name="email" style="width: 300px;" id="email" placeholder="Enter Email">
     		</div>
      </div>
    </div>
    <a class="btn-small btn-small-normal" id="deleteMessageDialogConfirm"><span>Yes</span></a> 
    <a class="btn-small btn-small-secondary" id="deleteMessageDialogCancel"><span>Cancel</span></a> 
    <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
  </form>
</div>

<div style="display: none; padding:0px; margin:0px;" id="SelctOnetitle">We're Sorry</div>
<div style="display: none;" id="SelctOnebody">Please select at least one Row.</div>
<div id="r_history" style="visibility:hidden;">
	<div style=""><strong><span id="r_heading"></span></strong></div>
	<div style="" id="details_table">
		<table style="width: 100%;" class="preview_table2">
			<thead>
				<th width="20%" align="left"><strong>Status</strong></th>
				<th width="20%" align="left"><strong>User</strong></th>
				<td width="20%" align="center"><strong>Date and Time</strong></td>
				<td width="20%" align="left"><strong>Description</strong></td>
				<td width="20%" align="left"><strong>Reason</strong></td>
			</thead>
			<tbody id="r_history_details">
				
			</tbody>
		</table>
		<div class="wrapper">
			</br></br><input type="button" align="center" class="button1" id="r_ok" value="Close" />
		</div>
	</div>
</div>

<!-- Modal for product details -->
	<div id="details" style="visibility:hidden;">
    <div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>
    	<form method="POST" name="action_form" id="action_form"  style="margin:0px;">
			<input name="deleteEventId" id="deleteEventId" value="" type="hidden">
    		<input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
    		<input name="type" id="type" value="" type="hidden">
		<div style="">
			<div id="priview"></div>
			<br>
			<div id="sendtochecker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
						<div >
		      	<input type="checkbox" name="sendmail" value="1" id="sendmail"> <label for="sendmail">Notify to Lawyer/Vendor</label>
		      	</div>
		      	<br>
		      	<input type="button" class="buttonsendtochecker" id="sendtochecker" value="Send to Legal" />
		      	<input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel" />
		    	<span id="sendtochecker_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
		    </div>

			<div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
		     	<strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
		     	<textarea name="comments" id="comments" style="width:370px;"></textarea>
			    </br></br>
			    <input type="button" class="buttondelete" id="delete_button" value="Delete" />
			    <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel" />
		    	<span id="delete_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
		    </div>
			</form>
			<div id="close_btn_row" style="text-align:center;margin-bottom:30px;width:100%;">
			    	<input type="button" align="center" class="button6" id="codeOK" value="Close" />
			    </div>
			
		</div>
	</div>
<div id="applicationverifydelete"  style="display:none">
	<div class="hd"><h2 class="conf">Already Send.</h2></div>
	<div style="text-align:center; margin:auto; width:30px"><a class="btn-small btn-small-normal" style="text-align:center"  onclick="alertmsginfo.hide()"><span>Ok</span></a></div> 
</div>	

<!-- Modal for product details -->
	<div id="fileupload" style="visibility:hidden;">
    <div style="padding-left: 17px"><strong>Finance History Upload</strong></div>
		<div style="">
			<form class="form" id="form" name="form"  method="post" action="<?=base_url()?>bill_ait/file_upload" enctype="multipart/form-data">
				<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<div style="margin: auto;">
					<br>
					<br>
					<table id="deal_body" style="display:block;width:100%">
						<tr>
							<td style="text-align:right;width:40%">
								<strong>Select File : </strong>
							</td>
							<td >
								<input style="margin-left: 10px;" type="file" name="file_upload" id="file_upload" onchange="fileValidation('file_upload')">
								<input name="rowid" id="rowid" value="" type="hidden">
						    <input name="index"  id="index" value="" type="hidden">
						    <input name="status"  id="status" value="" type="hidden">
							</td>
						</tr>
						<tr>
							<td></td>
							<td>

								
								<span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
							</td>
						</tr>
					</table>
			  </div>
			
			<br>
			<div align="center">
				<input type="button" class="buttonsendtochecker" value="Save" id="upload" />
      	<input type="button" id="codeOKfile" class="buttonclose" value="Close" />
         
      </div>
      </form>
		</div>
	</div>
<script>
	var options = { 
			complete: function(response) 
			{
				//console.log(response);
				//alert(response.responseText)
				jQuery("#file_upload").val('');
				var json = jQuery.parseJSON(response.responseText); 
				jQuery('.txt_csrfname').val(json.csrf_token);
				if(json.Message!='OK')
				{
					jQuery("#upload").show();
					jQuery("#grid_loading").hide();
					alert(json.Message);
					return false
				}
				
				jQuery("#jqxGrid2").jqxGrid('clearselection');
				jQuery("#jqxGrid2").jqxGrid('updatebounddata');
				jQuery("#upload").show();
				jQuery("#grid_loading").hide();
				jQuery("#error").show();
				jQuery("#error").fadeOut(11500);
				jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Uploaded');		
				jQuery("#fileupload").jqxWindow('close');	
				//window.top.EOL.messageBoard.close();
							
			}  
		}; 
		jQuery("#form").ajaxForm(options);

		jQuery("#upload").click(	function() {
			if(jQuery("#file_upload").val()!=''){
				jQuery("#upload").hide();
				jQuery("#grid_loading").show();
				jQuery("#form").submit();
			}else{
				alert('Please Select file');
				return false;
			}
			
				
		});
</script>