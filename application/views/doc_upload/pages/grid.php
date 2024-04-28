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

	   jQuery(document).ready(function($) {
	      // prepare the data
	       //var theme = 'energyblue';
            var theme = 'classic';
			<? if(ADD==1){?>
           jQuery("#sendButton").jqxButton({template:"primary",width:"120"});
			<? }?>
            var source =
            {
           datatype: "json",
           datafields: [
					{ name: 'id', type: 'int'},
					{ name: 'e_dt', type: 'string'},
					{ name: 'doc_type', type: 'string'},
					{ name: 'document_name', type: 'string'},
					{ name: 'doc_file', type: 'string'},
					{ name: 'remarks', type: 'string'},
					{ name: 'v_sts', type: 'int'},
					{ name: 'e_by', type: 'int'},
					{ name: 'e_name', type: 'string'}
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
			  	url: '<?=base_url()?>index.php/doc_upload/grid',
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
					},
					formatData: function (data) {
						var doc_type = jQuery.trim(jQuery('input[name=doc_type]').val());
						var document_name = jQuery.trim(jQuery('input[name=document_name]').val());
              jQuery.extend(data, {
                  doc_type : doc_type,
                  document_name : document_name
              });
              return data;
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
            var win_h=jQuery( window ).height()-300;
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
						{ text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
						{ text: 'sts', datafield: 'sts',hidden:true },
					  	{ text: 'v_sts', datafield: 'v_sts',hidden:true },	
						{ text: 'e_by', datafield: 'e_by',hidden:true },				  
 						<? if(DELETE==1){?>
					  	{ text: 'D', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%',
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if(<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by && dataRecord.v_sts == '0')
						 	{
						 		return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="delete_record_message('+dataRecord.id+',\'delete\','+editrow+','+dataRecord.sts+');" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
						 	}
						 	else {
	                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">V</div>';
	                      	}

							}
						  },
            			<?php } if(EDIT==1){ ?>
						{ text: 'E', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
					  	cellsrenderer: function (row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if(<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by && dataRecord.v_sts == '0'){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="editt('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
								}
								else
								{
									return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">V</div>';
								}
							}
						  },
					  <?php } ?>
					  
					  <? if(VERIFY==1){?>
					  { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
                      	cellsrenderer: function(row) {
                      		editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if(<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by && dataRecord.v_sts == '0'){
								return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="delete_record_message('+dataRecord.id+',\'verify\','+editrow+','+dataRecord.sts+');" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
						 	}
						 	else if(dataRecord.v_sts == '0'){
								return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
						 	}
						 	else {
	                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">V</div>';
	                      	}
	                      	
                      	}
	                  },
					  <? }?>
					  	
					  	{ text: 'Document Type', datafield: 'doc_type',editable: false, width: '20%',align: 'left',},
						{ text: 'Document Name', datafield: 'document_name',editable: false, width: '20%',align: 'left',},
						{ text: 'Entry By', datafield: 'e_name',editable: false, width: '20%',align: 'left',},
						{ text: 'Entry date', datafield: 'e_dt',editable: false, width: '10%',align: 'left',},
					  	{ text: 'Doc File', editable: false, datafield: 'doc_file', filterable: false,sortable: false, menu: false, width: 100, align: 'center', cellsalign: 'center',
						  	cellsrenderer: function (row){
						  		var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', row);	
						  		if (dataRecord.doc_file!='') 
						  		{
						  			return ' <a href="<?=base_url()?>doc_files/'+dataRecord.doc_file+'" download="'+dataRecord.doc_file+'"> <div style=" margin-top: 5px; cursor:pointer;text-align:center" ><img src="<?=base_url()?>images/download_icon.png"></div></a>'
						  		}
						  		else
						  		{
						  			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
						  		}
						  	}
						  },
						{ text: 'Remarks', datafield: 'remarks',editable: false, width: '15%',align: 'left', },
						 ]
            });
			jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 700, height:250, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK") });
			var document_type = [<? $i=1; foreach($document_type as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
			jQuery("#doc_type").jqxComboBox({theme: theme, promptText: "Select Type", source: document_type, width: '97%', height: 21});

  });
	function search_data(){
		jQuery("#jqxgrid").jqxGrid('updatebounddata');
		return;
	}
	function editt(val,indx)
	{

		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>doc_upload/from/edit/'+val+'/'+indx, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
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
			jQuery('#message').html('Delete this Document?');
		}
		//For sendtochecker
		else if(go_for=='sendtochecker')
		{
			jQuery('#sendtocheckerdiv').css("display", "block");
			jQuery('#deletediv').css("display", "none");
			jQuery('#message').html('Send this Document To Checker?');
		}
		else
		{
			jQuery('#sendtocheckerdiv').css("display", "none");
			jQuery('#deletediv').css("display", "none");
			jQuery('#message').html('Verify This Document?');
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
	function delete_records()
	{
		//For Delete Action
		if (jQuery('#type').val()=='delete') 
		{
			if (jQuery('#comments').val()=='') 
			{
				$('deleteMessageErrorMsg').innerHTML = 'Please Put Delete Reason';
				$('deleteMessageErrorMsg').style.display = 'block';
				jQuery('#comments').focus();
				return;
			}
		}
		//For SendTochecker Action
		else if(jQuery('#type').val()=='sendtochecker')
		{
			if (jQuery('#checker_to_notify').val() == '' || jQuery('#checker_to_notify').val() == 0 || jQuery('#checker_to_notify').val() == null || jQuery('#checker_to_notify').val() == 'undefined') {
	    		alert('The checker to notify field is required!');
	    		jQuery('#checker_to_notify').focus();
	    		return;
	    	}
		}
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = jQuery('#delete_form').serialize()+"&"+csrfName+"="+csrfHash;
		
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: '<?=base_url()?>index.php/doc_upload/delete_action/',
				data : postData,
				datatype: "json",
				success: function(response){
                  ///console.log(response);
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
						var msz='';
						window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
						jQuery("#error").show();
						jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});								
						jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz);	
						deleteMessageDialog.hide();
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
	<div style="padding: 0.5%;width:98%;height:30px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
					<table id="deal_body" style="display:block;width:100%">
						<tr>
							<td style="text-align:right;width:10%"><strong>Document Type&nbsp;&nbsp;</strong> </td>
							<td style="width:15%"><div style="padding-left:1.8%" id="doc_type" name="doc_type"></div></td>
							<td style="text-align:right;width:10%"><strong>Document Name&nbsp;&nbsp;</strong> </td>
							<td style="width:15%"><input type="text" name="document_name" id="document_name" placeholder="Document Name"></td>
							<td style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px;height:25px" /></td>
							<td style="width:15%"></td>
							<td style="text-align:right;width:5%"></td>
							<td style="width:15%"></td>
							<td style="text-align:right;width:7%"></td>
							<td style="width:15%"></td>
							<td style="text-align:right;width:5%"></td>
							<td style="width:30%">
							</td>
							<td  style="text-align:right;width:5%">
							</td>
						</tr>
					</table>
			  </div>
			  <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
  <div id="jqxgrid" style="margin: 10px auto;"></div>
	<div style="float:left;padding-top: 5px;padding-left:5px;">
  <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
	<? if(ADD==1){?>
		<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
		    href="<?=base_url()?>index.php/doc_upload/from/add" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:40px;width:120px;"  value="Doc Upload" id="sendButton" /></a>
	
    <? }?> &nbsp;&nbsp;&nbsp;&nbsp;
    <strong>D = </strong> Delete,&nbsp;
    <strong>E = </strong> Edit,&nbsp;
    <strong>V = </strong> Verify&nbsp;
    </div> <br/>
	</div>
<style>
* { padding:0px; margin:0px; }
</style>
<!-- Model For Delete Message -->
<div id="deleteMessageDialogContent"  style="display:none">
  <div class="hd"><h2 class="conf">Are you sure you want to <span id="message"></span></h2></div>
  <form method="POST" name="delete_form" id="delete_form"  style="margin:0px;">
    <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
    <input name="type" id="type" value="" type="hidden">
    <input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
    <input name="sts" id="sts" value="" type="hidden">
    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
     <div class="bd" id="deletediv">
     	<span id="comments_part">Delete Reason:
	    	 <input name="comments" id="comments" type="text" style="width:370px; background-color:#CCC">
	    </span>
     </div>
     <div class="bd" id="sendtocheckerdiv">
      <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
      <div class="instrText" style="margin-bottom: 20px"></div>
      <div style="margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
      	Loan A/C:&nbsp;<span><strong id="">1110000</strong></span></br>
      	A/C Name:&nbsp;<span><strong id="">Enayet</strong></span><br/>
      	AM Name:&nbsp;<span><strong id="">Enayet</strong></span><br/>
      	Type of Requisition :&nbsp;<span><strong id="">NI Act-138</strong></span><br/>
      	Select Checker To Notify: <span style="color: red;">*</span> 
      	<select name="checker_to_notify" id="checker_to_notify">
      		<option value="" selected="">Select a Checker</option>
          		<option value="1">Admin</option>
          		<option value="2">Enayet</option>
          		<option value="3">Ha-Mim</option>
      	</select><br>
      	Notify By:&nbsp;&nbsp;
      	<label>
      		<input type="checkbox" checked="checked" name="email_notification" id="email_notification" value="email"> Email
      	</label>
      	&nbsp;&nbsp;&nbsp;
      	<label>
      		<input type="checkbox" name="sms_notification" id="sms_notification" value="sms"> SMS
      	</label>
      </div>
    </div>
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

<!-- Modal for product details -->
	<div id="details" style="visibility:hidden;">
    <div style="padding-left: 17px"><strong>CMA Details</strong></div>
		<div style="">
			<table style="width: 100%;" id="preview_table">
				<tbody>
					<tr>
						<td width="50%" align="left"><strong>Loan A/C :</strong> <label name="ac" id="ac"></label></td>
						<td width="50%" align="left"><strong>A/C Name:</strong> <label name="ac_name" id="ac_name"></label></td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>AM Name :</strong> <label name="am_name" id="am_name"></label></td>
						<td width="50%" align="left"><strong>Type of Requisition :</strong> <label name="req_type" id="req_type"></label></td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Remarks :</strong> <label name="remarks" id="remarks"></label></td>
						<td width="50%" align="left"><strong>Initiate By :</strong> <label name="iniate_by" id="iniate_by"></label></td>
					</tr>
					<tr>
						<td width="50%" align="left"><strong>Initiate Date Time :</strong> <label name="iniate_date" id="iniate_date"></label></td>
						<td width="50%" align="left"><strong>Reject Reason :</strong> <label name="rr_reson" id="rr_reson"></label></td>
					</tr>
				</tbody>
				
			</table>
			<br>
			<div align="center">
            	<input type="button" id="codeOK" value="Close" />
               
            </div>
		</div>
	</div>