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
.button1 {
  background-color: #555555; /* Green */
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;;
  border-radius: 12px;
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
table.preview_table2 td, table.preview_table2 th{
		border: 1px solid #c7c7c7;
		word-wrap:break-word;
		padding:5px;
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
	.buttonclose {
	   background-color: white; 
	  color: black; 
	  border: 2px solid #555555;
	  border-radius: 12px;
	  padding: 10px 15px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  margin: 4px 2px;
	  transition-duration: 0.4s;
	  cursor: pointer;
	}
	.buttonclose:hover {
	  background-color: #555555;
	  color: white;
	}
	.wrapper {
    text-align: center;
	}

	.button {
	    position: absolute;
	    top: 50%;
	}
	#gurantor_table {
        border-collapse: collapse;
	    }
	    #gurantor_table td {
	        border: 1px solid rgba(0,0,0,.20); 
	    }
	</style>

<div id="container">
	<div id="body"  >
    <!--Customization Start-->
	<script type="text/javascript">
		var csrf_tokens='';
    var idd = 0; var indxx = 0;

	   jQuery(document).ready(function($) {
	   		jQuery("#sendtochecker").click(function () {
	  		jQuery("#sendtochecker").hide();
			jQuery("#SendTocheckercancel").hide();
			jQuery("#sendtochecker_loading").show();
	  		call_ajax_submit();
   		 });
	      // prepare the data
	       //var theme = 'energyblue';
            var theme = 'classic';
			
            var source =
            {
           datatype: "json",
           datafields: [
					{ name: 'id', type: 'int'},
					{ name: 'cma_id', type: 'int'},
					{ name: 'checker_id', type: 'int'},
					{ name: 'legal_ack_by', type: 'int'},
					{ name: 'legal_checker_id', type: 'int'},
					{ name: 'status', type: 'string'},
					{ name: 'loan_ac', type: 'string'},
					{ name: 'cif', type: 'string'},
					{ name: 'auction_sts', type: 'int'},
					{ name: 'ack_by', type: 'int'},
					{ name: 'memo_h_by', type: 'int'},
					{ name: 'paper_h_by', type: 'int'},
					{ name: 'region_name', type: 'string'},
					{ name: 'territory_name', type: 'string'},
					{ name: 'district_name', type: 'string'},
					{ name: 'unit_office_name', type: 'string'},
					{ name: 'serial', type: 'string'},
					{ name: 'ac_name', type: 'string'},
					{ name: 'e_by', type: 'string'},
					{ name: 'e_dt', type: 'string'},
					{ name: 'stc_by', type: 'string'},
					{ name: 'stc_dt', type: 'string'},
					{ name: 'rec_by', type: 'string'},
					{ name: 'rec_dt', type: 'string'},
					{ name: 'sth_by', type: 'string'},
					{ name: 'sth_dt', type: 'string'},
					{ name: 'v_by', type: 'string'},
					{ name: 'v_dt', type: 'string'},
					{ name: 'ln_expiry_dt', type: 'string'},
					{ name: 'ln_serve_dt', type: 'string'},
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
			  	url: '<?=base_url()?>index.php/legal/grid',
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
						{ text: 'CMA Id', datafield: 'cma_id', hidden:true,  editable: false,  width: '4%' },
					  	<? if(ACKOWLEDGMENTREQUEST==1){?>
						  { text: 'ACK', datafield: 'AcknowledgementRequest', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_checker_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.auction_sts == 17){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'acknowledgement\','+editrow+','+dataRecord.cma_id+','+dataRecord.loan_ac+','+dataRecord.cif+')" ><img align="center" src="<?=base_url()?>images/favorites.png"></div>';
							 	}
							 	else if(dataRecord.auction_sts==40)
							 	{
							 		return '<div style=" margin-top: 8px;text-align:center">ACK</div>';
							 	}
							 	else {
		                      			return '<div style=" margin-top: 8px;text-align:center"></div>';
		                      	}
	                      	}
		                  },
						<? }?>
						{ text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
				  			cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'details\','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

							}
					  	},
					  	<?php if(RESPONSE==1){ ?>
						{ text: 'RS', menu: false, datafield: 'legalresponse', align:'center', editable: false, sortable: false, width: '2%',
					  	cellsrenderer: function (row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if(<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_ack_by && dataRecord.auction_sts == 40){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="response('+dataRecord.id+','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
								}
								else if(dataRecord.auction_sts == 42)
								{
									return '<div style=" margin-top: 8px;text-align:center">RS</div>';
								}
								else{
									return '<div style=" margin-top: 8px;text-align:center"></div>';
								}
							}
						  },
					  	<?php } ?>
						{ text: 'Status', datafield: 'status',editable: false, width: '21%', align:'left',cellsalign:'left'},
						{ text: 'LN Serving Dt', datafield: 'ln_serve_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'LN Expiry Dt', datafield: 'ln_expiry_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'Serial', datafield: 'serial',editable: false, width: '12%', align:'left',cellsalign:'left'},
						{ text: 'Loan A/C or Card No.', datafield: 'loan_ac', editable: false,align:'center',cellsalign:'center', sortable: true, menu: true, width: '11%',
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
	                      		var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.cma_id+',\'life_cycle\')"><span>'+dataRecord.loan_ac+'</span></a></div>';
		                      	
	                      	}
		                  },
		                 { text: 'A/C Name or Name on Card', datafield: 'ac_name',editable: false, width: '15%', align:'left',cellsalign:'left'},
					  	{ text: 'Region', datafield: 'region_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'Territory', datafield: 'territory_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'District', datafield: 'district_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'Unit Office', datafield: 'unit_office_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'Initiate By', datafield: 'e_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Initiate Date Time', datafield: 'e_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						 { text: 'STC By', datafield: 'stc_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'STC Date Time', datafield: 'stc_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'REC By', datafield: 'rec_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'REC Date and Time ', datafield: 'rec_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'Send To HOLM By', datafield: 'sth_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Send To HOLM Date and Time', datafield: 'sth_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'Verify By', datafield: 'v_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Verify Date and Time', datafield: 'v_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						 ],
					ready: function () {
	                    var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
	                     $('#jqxgrid').jqxGrid({ pagesizeoptions: ['25', '100','200']});
	                }
            });
			jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#deletecancel") });
			jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
			jQuery('#details').on('close', function (event) {
			    jQuery('#action_form').jqxValidator('hide');
			});
  	});
	function response(val,indx,cma_id)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/legal/response/'+val+'/'+indx+'/'+cma_id, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function details(id,operation,indx,cma_id,loan_ac,cif)
	{
		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery('#verifyIndexId').val(indx);
		jQuery('#cma_id').val(cma_id);
		jQuery('#loan_ac').val(loan_ac);
		jQuery('#cif').val(cif);
		if (operation=='details') 
		{
			jQuery("#header_title").html('CMA Details');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').show();
		}
		else if (operation=='acknowledgement') 
		{
			jQuery("#header_title").html('Acknowledgement CMA');
			jQuery('#sendtochecker_row').show();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
		}
		jQuery('#loading_preview').show();
		jQuery('#loading_p').show();
		jQuery('#details_table').hide();
		jQuery("#details").jqxWindow('open');
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>cma_process/details",
			data : {[csrfName]: csrfHash,id: cma_id,operation:'legal'},
			datatype: "json",
			success: function(response){
			//alert(response);
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
					if(json.str)
					{
						document.getElementById("details").style.visibility='visible';
						jQuery("#main_body").html(json['str']);
							jQuery('#loading_preview').hide();
							jQuery('#loading_p').hide();
							jQuery('#details_table').show();
							jQuery("#details").jqxWindow('open');
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
				url: '<?=base_url()?>index.php/legal/delete_action/',
				data : postData,
				datatype: "json",
				success: function(response){
					var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
						if(json.Message!='OK')
						{								
							jQuery("#sendtochecker").show();
							jQuery("#SendTocheckercancel").show();
							jQuery("#sendtochecker_loading").hide();
							alert(json.Message);
							return false;
						}else{

						jQuery("#sendtochecker").show();
						jQuery("#SendTocheckercancel").show();
						jQuery("#sendtochecker_loading").hide();
						var row = {};
						row["id"] = json['row_info'].id;
						row["sl_no"] = json['row_info'].sl_no;
						row["loan_ac"] = json['row_info'].loan_ac;
						row["ac_name"] = json['row_info'].ac_name;

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
						//if($('comments_sts').value=='0'){msz=' comments send';}
						window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
						jQuery("#error").show();
						jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});								
						jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz);	
						jQuery('#details').jqxWindow('close');
					}
				}
			});

	}
	function r_history (id,life_cycle=null) {
		if (life_cycle=='life_cycle') 
		{
			jQuery("#r_heading").html('Life Cycle');
		}
		else
		{
			jQuery("#r_heading").html('Decline/Return Reason History');
		}
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>cma_process/r_history",
			data : {[csrfName]: csrfHash,id: id,life_cycle:life_cycle},
			datatype: "json",
			success: function(response){
			//alert(response);
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
					if(json['row_info'])
					{
						document.getElementById("r_history").style.visibility='visible';
						var html='';
						jQuery.each(json['row_info'],function(key,obj){
							html+='<tr>';
								html+='<td align="left">'+obj.oprs_sts+'</td>';
								html+='<td align="left">'+obj.r_by+'</td>';
								html+='<td align="center">'+obj.oprs_dt+'</td>';
								html+='<td align="left">'+obj.oprs_descriptions+'</td>';
								if (obj.oprs_reason!=null)
								{
									html+='<td align="left">'+obj.oprs_reason+'</td>';
								}else{html+='<td align="left"></td>';}
							html+='</tr>';
						});
						jQuery("#r_history_details").html(html);
						jQuery("#r_history").jqxWindow('open');
					}
					else {
						alert("Something went wrong, please refresh the page.")
					}

			}
		});
	}
	function close_window()
	{
		sendToCheckerMessageDialog.hide();
		document.getElementById('download_form').submit();
	}
	</script>

  <div id="jqxgrid" style="margin: 10px auto;"></div>
	<div style="float:left;padding-top: 5px;padding-left:5px;">
  	<div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
	&nbsp;
    <!-- <strong>D = </strong> Delete,&nbsp; -->
    <strong>P = </strong> Preview,&nbsp;
   <!--  <strong>E = </strong> Edit,&nbsp; -->
    <strong>ACK = </strong> Acknowledgement&nbsp;
   <!--  <strong>VP = </strong> Verify Paper Notice,&nbsp;
    <strong>MP = </strong> Prepare Memo,&nbsp;
    <strong>VM = </strong> Verify Memo,&nbsp;
    <strong>USB  = </strong> Update Selected Bidder,&nbsp;
	 <strong>AN = </strong> Auction Notice,&nbsp; -->
    </div> <br/>
	</div>
<style>
* { padding:0px; margin:0px; }
</style>
<!-- Modal for product details -->
	<div id="details" style="visibility:hidden;">
    <div><strong><label id="header_title"></label></strong></div>
		<form method="POST" name="action_form" id="action_form"  style="margin:0px;">
			<input name="deleteEventId" id="deleteEventId" value="" type="hidden">
    		<input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
    		<input name="type" id="type" value="" type="hidden">
    		<input name="cma_id" id="cma_id" value="" type="hidden">
    		<input name="loan_ac" id="loan_ac" value="" type="hidden">
    		<input name="cif" id="cif" value="" type="hidden">
			<div id="loading_preview" style="text-align:center">
				<span id="loading_p" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
			</div>
			<div style="" id="details_table">
			&nbsp;&nbsp;&nbsp;<img  onClick="printpage('preview_table','gurantor_table','facility_table','facility_card','proposed_type_d')"   style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?=base_url()?>old_assets/images/Print.png" alt="print-preview"  />
				<span id="main_body"></span>
				<br>
				<div id="preview_table"></div>
				<div id="gurantor_table"></div>
				<div id="facility_table"></div>
				<div id="facility_card"></div>
				<div id="proposed_type_d"></div>
				<div id="sendtochecker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
				    </br></br>
			      	<input type="button" class="buttonsendtochecker" id="sendtochecker" value="ACK" />
			      	<input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel" />
			    	<span id="sendtochecker_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
			    </div>
				<!-- <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
			     	<strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
			     	<textarea name="comments" id="comments" style="width:370px;"></textarea>
				    </br></br>
				    <input type="button" class="buttondelete" id="delete_button" value="Delete" />
				    <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel" />
			    	<span id="delete_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
			    </div> -->
			    <div id="close_btn_row" style="text-align:center;margin-bottom:30px;width:100%;">
			    	<input type="button" align="center" class="button1" id="codeOK" value="Close" />
			    </div>
			</div>
		</form>
	</div>
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

<div id="sendToCheckerMessageDialogContent"  style="display:none">
      <div class=""><h2 class="conf" style="margin-top:0px">Select copy to <span id="message"></span></h2></div>
      <form method="POST" target="_blank" name="download_form" id="download_form"  style="margin:0px;" method="POST" action="<?=base_url()?>index.php/legal/download" enctype="multipart/form-data">
        <input name="sendToCheckerEventId" id="sendToCheckerEventId" value="" type="hidden">
        <input name="download_id" id="download_id" value="" type="hidden">
        <input name="operation_type" id="operation_type" value="" type="hidden">
        <input name="download_type"  id="download_type" value="" type="hidden">
      	<div class="bd" id="card_div">
          <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
          <div class="instrText" style="margin-bottom: 20px"></div>
          <div style="margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
          	<label>
          		<input type="radio" checked  name="notice_type" id="notice_type" value="33_5"> 33(5)-Auction Notice
          	</label>
          	</br>
          	<label>
          		<input type="radio"  name="notice_type" id="notice_type" value="33_7"> 33(7)-Auction Notice
          	</label>
          	</br>
          	<label>
          		<input type="radio"  name="notice_type" id="notice_type" value="12_3"> 12(3)-Auction Notice
          	</label>
          	
          </div>
        </div>
       
        <a class="btn-small btn-small-normal" id="download_confirm" type="submit" onclick="close_window();"><span id="button_tag"></span></a> 
        <a class="btn-small btn-small-secondary" id="download_cancel"><span>Cancel</span></a> 
        <span id="loading_download" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </form>
    </div>


     <script>
	function printpage(print_area,gurantor_table,facility_table,facility_card,type)
	{			 	
		var pp = window.open();
		var tt=document.getElementById(print_area).innerHTML;
		var ptype =document.getElementById(type).innerHTML;
		var loan_card_g="Guarantor/Company/Director/Owner";
		if(ptype=='Card'){
			var loan_card_g="Borrower/Reference";
		}
		pp.document.writeln('<HTML><HEAD><title></title>')
		pp.document.writeln('<style>.gurantor,.facility{width:100%; text-align:center; font-weight:bold;font-size:9pt;}.gurantor tr td,.facility tr td{border:1px solid #000;} </style>');
		
		pp.document.writeln('<style type="text/css"  media="print">	#PRINT, #CLOSE, #mssgg {visibility:hidden;}</style><base target="_self"></HEAD>');
		
		pp.document.writeln('<body  style="font-family:Verdana;font-size:8pt;" bottomMargin="20" leftMargin="50" topMargin="20" rightMargin="30">');
		
		pp.document.writeln('<table style="width:100%; text-align:center; font-weight:bold;font-size:9pt;"><tr><td><img ID="PRINT" alt="Print" src="<?=base_url()?>old_assets/images/Print.png" onclick="javascript:location.reload(true);window.print();">&nbsp;<img ID="CLOSE" alt="CLOSE" src="<?=base_url()?>old_assets/images/close.png" onclick="window.close();"><br /><span style="font-weight:normal; color:green; font-size:8pt;" ID="mssgg" >Print in Portrait Page</span></td></tr><tr><td>');
		pp.document.writeln('<table style="width:100%; text-align:center; font-weight:bold;font-size:9pt;" cellpadding="3" cellspacing="0" >');
		pp.document.writeln(document.getElementById(print_area).innerHTML);
		pp.document.writeln('</table></td></tr><tr>');
		pp.document.writeln('<td style="text-align:center; font-weight:bold;font-size:20px;">'+loan_card_g+'</td>');
		pp.document.writeln('</tr><tr><td><table style="width:100% !important"  class="gurantor" cellspacing="0" cellspadding="0">');
		pp.document.writeln(document.getElementById(gurantor_table).innerHTML);
		pp.document.writeln('</table></td></tr><tr><td style="height:20px;"></td></tr><tr>');
		pp.document.writeln('<td style="text-align:center; font-weight:bold;font-size:20px;">Facility Info</td>');
		pp.document.writeln('</tr><tr><td><table style="width:100% !important" class="facility" cellspacing="0" cellspadding="0">');
		if(ptype=='Card'){
			pp.document.writeln(document.getElementById(facility_card).innerHTML);
		}else{
			pp.document.writeln(document.getElementById(facility_table).innerHTML);
		}
		
		//pp.document.writeln('</td></tr>');
		pp.document.writeln('</table></td></tr>');
		
		pp.document.writeln('</body></HTML>');			
		//window.print();
	}
</script>