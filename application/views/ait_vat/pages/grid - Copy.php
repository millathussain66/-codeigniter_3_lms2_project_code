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
.button6 {
  background-color: #555555; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;;
  border-radius: 12px;
}
.center {
  margin: 0;
  position: absolute;
  top: 90%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
.buttondelete {
	   background-color: white; 
	  color: black; 
	  border: 2px solid #f44336;
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
	.buttondelete:hover {
	  background-color: #f44336;
	  color: white;
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

	   jQuery(document).ready(function($) {
	      // prepare the data
	       //var theme = 'energyblue';
            var theme = 'classic';
			
			jQuery("#delete_button").click(function () {
	            var validationResult = function (isValid) {
					if (isValid) {
						jQuery("#delete_button").hide();
						jQuery("#deletecancel").hide();
						jQuery("#delete_loading").show();
						call_ajax_submit();
					}
				}
				jQuery('#action_form').jqxValidator('validate', validationResult);
	   		 });
            jQuery("#sendtochecker").click(function () {
	    		jQuery("#sendtochecker").hide();
				jQuery("#SendTocheckercancel").hide();
				jQuery("#sendtochecker_loading").show();
	    		call_ajax_submit();
		    	
	   		 });
            jQuery('#action_form').jqxValidator({
				rules: [
					{ input: '#comments', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
						if(jQuery("#comments").val()=='')
						{
							jQuery("#comments").focus();
							return false;
						}
						else
						{
							return true;
						}
					}
					},

					{ input: '#comments', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
					 {
					 	if(input.val() != '')
						{
							if(input.val().length>250)
							{
								jQuery("#comments").focus();
							 	return false;

							}
						}
						return true;

					} },
				
				]
			});
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
			  	url: '<?=base_url()?>index.php/ait_vat/grid',
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
            jQuery("#jqxgrid").jqxGrid(
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
 						<? if(DELETE==1){?>
					  	{ text: 'D', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%',
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if((dataRecord.stc_sts == '39' || dataRecord.stc_sts == '35') && dataRecord.v_sts == '0'){
								return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'delete\','+editrow+')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
						 	}
						 	else {
	                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
	                      	}

							}
						  },
            			<?php } if(EDIT==1){ ?>
						{ text: 'E', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
					  	cellsrenderer: function (row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if((dataRecord.stc_sts == '39' || dataRecord.stc_sts == '35') && dataRecord.v_sts == '0'){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="editt('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
								}
								else
								{
									return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
								}
							}
						  },
					  <?php } ?>
					  <? if(SENDTOCHECKER==1){?>
					  { text: 'STHO', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 55,
                      	cellsrenderer: function(row) {
                      		editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if(dataRecord.stc_sts == '39' || dataRecord.stc_sts == '35'){
								return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'sendtoho\','+editrow+');" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
						 	}
						 	else {
	                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">S</div>';
	                      	}
                      	}
	                  },
					  <? }?>
					   <? if(SENDTOCHECKER==1){?>
					  { text: 'RF', datafield: 'received_file', editable: false,align:'center', sortable: false, menu: false, width: 35,
                      	cellsrenderer: function(row) {
                      		editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if(dataRecord.stc_sts == '71'){
								return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">RF</div>';
						 	}
						 	else{
	                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
	                      	}
                      	}
	                  },
					  <? }?>
					 
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
					  	{ text: 'Current Status', datafield: 'status_name',editable: false, width: '15%'},
					  	{ text: 'Request date', datafield: 'e_dt',editable: false, width: '15%'},
					  	{ text: 'Inform to Finance team', datafield: 'send_fi_dt',editable: false, width: '13%'},
					  	{ text: 'Certificate Received', datafield: 'receive_head_dt',editable: false, width: '13%'},
					  	{ text: 'AIT & VAT File', editable: false, datafield: 'certificate_file', filterable: false,sortable: false, menu: false, width: 120, align: 'center', cellsalign: 'center',
						  	cellsrenderer: function (row){
						  		var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', row);	
						  		if (dataRecord.stc_sts==71) 
						  		{
						  			return ' <a href="<?=base_url()?>ait_vat_files/'+dataRecord.certificate_file+'" download="'+dataRecord.certificate_file+'"> <div style=" margin-top: 5px; cursor:pointer;text-align:center" ><img src="<?=base_url()?>images/download_icon.png"></div></a>'
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
			jQuery("#details").jqxWindow({ theme: theme, width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#deletecancel,#SendTocheckercancel") });
			jQuery("#r_history").jqxWindow({ theme: theme, width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
			jQuery('#details').on('close', function (event) {
			    jQuery('#action_form').jqxValidator('hide');
			});


  });

	function editt(val,indx)
	{

		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>ait_vat/from/edit/'+val+'/'+indx, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
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
				//var json = jQuery.parseJSON(response);
				var ret = response.split("####");
				jQuery('.txt_csrfname').val(ret[1]);
					if(ret[0])
					{
						//console.log(ret[0]);
						document.getElementById("details").style.visibility='visible';
						jQuery("#priview").html(ret[0]);
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
	</script>

  <div id="jqxgrid" style="margin: 10px auto;"></div>
	<div style="float:left;padding-top: 5px;padding-left:5px;">
  <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
	<? if(ADD==1){?>

	<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
    href="<?=base_url()?>index.php/ait_vat/from/add" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:40px;width:120px;"  value="AIT & VAT" id="sendButton" /></a>
    <? }?> &nbsp;&nbsp;&nbsp;&nbsp;
    <strong>D = </strong> Delete,&nbsp;
    <strong>E = </strong> Edit,&nbsp;
    <strong>P = </strong> Preview,&nbsp;
    <strong>RF = </strong> Receive File,&nbsp;
    <strong>STHO = </strong> Send to HO&nbsp;
    </div> <br/>
	</div>
<style>
* { padding:0px; margin:0px; }
</style>

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
		      	
		      	<input type="button" class="buttonsendtochecker" id="sendtochecker" value="Send" />
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