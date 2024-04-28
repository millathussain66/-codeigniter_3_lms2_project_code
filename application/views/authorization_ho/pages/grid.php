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
	   jQuery(document).ready(function($) {
	       //var theme = 'energyblue';
            var theme = 'classic';
            jQuery("#sendtochecker").click(function () {
				jQuery("#sendtochecker").hide();
				jQuery("#SendTocheckercancel").hide();
				jQuery("#sendtochecker_loading").show();
	    		call_ajax_submit();
	   		 });
            jQuery("#sendtohoops").click(function () {
				jQuery("#sendtohoops").hide();
				jQuery("#sendtohoopscancel").hide();
				jQuery("#sendtohoops_loading").show();
	    		call_ajax_submit();
	   		 });
            var source =
            {
           datatype: "json",
           datafields: [
					{ name: 'id', type: 'int'},
					{ name: 'auth_sts', type: 'int'},
					{ name: 'event_id', type: 'int'},
					{ name: 'req_type', type: 'int'},
					{ name: 'change_type', type: 'int'},
					{ name: 'authorization_type', type: 'int'},
					{ name: 'type', type: 'string'},
					{ name: 'sfa_by', type: 'string'},
					{ name: 'sfa_dt', type: 'string'},
					{ name: 'auth_by', type: 'string'},
					{ name: 'auth_dt', type: 'string'},
					{ name: 'req_type_name', type: 'string'},
					{ name: 'status', type: 'string'},
					{ name: 'loan_ac', type: 'string'},
					{ name: 'ac_name', type: 'string'},
					{ name: 'event_name', type: 'string'}
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
			  	url: '<?=base_url()?>index.php/authorization_ho/grid',
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
			// set rows details.
            jQuery("#jqxgrid").bind('bindingcomplete', function (event) {
                if (event.target.id == "jqxgrid") {
                    jQuery("#jqxgrid").jqxGrid('beginupdate');
                    var datainformation = jQuery("#jqxgrid").jqxGrid('getdatainformation');
                    for (i = 0; i < datainformation.rowscount; i++) {
                        jQuery("#jqxgrid").jqxGrid('setrowdetails', i, "<div id='grid" + i + "' style='margin: 10px;'></div>", 200, true);
                    }
                    jQuery("#jqxgrid").jqxGrid('resumeupdate');
                }
            });
            var win_h=jQuery( window ).height()-240;
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
				editable: true,
				rowdetails: false,
				enablebrowserselection: true,
				selectionmode: 'none',
				rendergridrows: function(obj)
				{
					 return obj.data;
				},

			    columns: [
						{ text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
						<? if(APPROVEAUTHORIZATION==1){?>
						  { text: 'V', datafield: 'approveauthorization', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if(dataRecord.auth_sts == 67 || dataRecord.auth_sts == 78){
									return '<div style=" margin-top: 7px;text-align:center">V</div>';
									
							 	}
							 	else {
		                      			return '<div style="text-align:center;margin-top: 3px; cursor:pointer" onclick="verify('+dataRecord.id+','+editrow+','+dataRecord.event_id+','+dataRecord.authorization_type+')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
		                      	}
	                      	}
		                  },
						<? }?>
						<? if(DOWNLOAD==1){?>
						  { text: 'AM', datafield: 'authorizationmemo', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if((dataRecord.auth_sts == 67 || dataRecord.auth_sts == 78) && dataRecord.authorization_type!=3){
									return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/authorization_ho/download/'+dataRecord.id+'/'+dataRecord.event_id+'/'+dataRecord.authorization_type+'" target="_blank" ><img align="center" src="<?=base_url()?>images/word_icon.gif"></a></div>';
							 	}
							 	else {
		                      			return '<div style=" margin-top: 7px;text-align:center"></div>';
		                      	}
	                      	}
		                  },
						<? }?>
					  	{ text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
				  			cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details('+dataRecord.id+','+dataRecord.authorization_type+',\'details\','+dataRecord.event_id+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

							  }
					  	},
					  	{ text: 'Type', datafield: 'type',editable: false, width: '18%', align:'left',cellsalign:'left'},
					  	{ text: 'Status', datafield: 'status',editable: false, width: '17%', align:'left',cellsalign:'left'},
					  	{ text: 'Req Type', datafield: 'req_type_name',editable: false, width: '17%', align:'left',cellsalign:'left'},
					  	{ text: 'Loan AC', datafield: 'loan_ac',editable: false, width: '17%', align:'left',cellsalign:'left'},
					  	{ text: 'AC Name', datafield: 'ac_name',editable: false, width: '17%', align:'left',cellsalign:'left'},
					  	{ text: 'Send By', datafield: 'sfa_by',editable: false, width: '15%', align:'left',cellsalign:'left'},
					  	{ text: 'Send Date', datafield: 'sfa_dt',editable: false, width: '12%', align:'left',cellsalign:'left'},
					  	{ text: 'Authorized By', datafield: 'auth_by',editable: false, width: '15%', align:'left',cellsalign:'left'},
					  	{ text: 'Authorized Date', datafield: 'auth_dt',editable: false, width: '12%', align:'left',cellsalign:'left'}
						
						 ],
					ready: function () {
	                    var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
	                     $('#jqxgrid').jqxGrid({ pagesizeoptions: ['25', '100','200']});
	                }
            });
			//End check box update 
			jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#sendtohoopscancel,#sendnotificationcancel") });
  });
	var count=0; var maxrow = 0; var displayrow= 0; inc = 0; decr = 0;
	function clearCount() { count=0; maxrow = 0;displayrow= 0;}
	function search_data(){
		jQuery("#jqxgrid").jqxGrid('updatebounddata');
		return;

	}
	function verify(id,indx,event_id,type)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/authorization_ho/formverify/'+id+'/'+event_id+'/'+type, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function details(id,type,operation,event_id)
	{
		jQuery('#deleteEventId').val(id);
		jQuery('#EventId').val(event_id);
		jQuery('#type').val(type);
		if (operation=='details') 
		{
			jQuery("#header_title").html('Authorization Details');
			jQuery('#close_btn_row').show();
		}
		jQuery('#loading_preview').show();
		jQuery('#loading_p').show();
		jQuery('#details_table').hide();
		jQuery("#details").jqxWindow('open');
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = $('action_form').toQueryString()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
			type: "POST",
			cache: false,
			async:false,
			url: "<?=base_url()?>authorization_ho/details",
			data : postData,
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
	</script>
	<div id="container" style="">
	<div id="body"  >
		<div  style="display:block; min-height:350px; height:auto">
			<form method="POST" name="form" id="form"  style="margin:0px;">
			  <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
			  <div id="jqxgrid" style="width:100%;min-height:320px;height:auto;"></div>
			<div style="float:left;padding-top: 5px;padding-left:5px;">
			  <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
			  	 <? if(APPROVEAUTHORIZATION==1){?>
					<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
				    href="<?=base_url()?>index.php/authorization_ho/bulk_operation/apv" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
				 <? }?>&nbsp;&nbsp;
				 <? if(DOWNLOAD==1){?>
					<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
				    href="<?=base_url()?>index.php/authorization_ho/bulk_operation/download" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:120px;"  value="BULK Download" id="sendButton" /></a>
				 <? }?>&nbsp;&nbsp;
			    <strong>P = </strong> Preview,&nbsp;
			    <strong>V = </strong>Approve Authorization,&nbsp;
			    <strong>AM = </strong>Authorization Memo&nbsp;
			    </div> <br/>
				</div>
			</form>
		 </div>
	</div>
</div>
<style>
* { padding:0px; margin:0px; }
</style>
<!-- Modal for product details -->
	<div id="details" style="visibility:hidden;">
    <div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>
		<form method="POST" name="action_form" id="action_form"  style="margin:0px;">
			<input name="deleteEventId" id="deleteEventId" value="" type="hidden">
			<input name="EventId" id="EventId" value="" type="hidden">
    		<input name="type" id="type" value="" type="hidden">
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
				<div id="close_btn_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
					<input type="button" class="button6" id="codeOK" value="Close" />
				</div>
				
			</div>
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
		pp.document.writeln('</table></td></tr>');
		if(document.getElementById(gurantor_table).innerHTML != "") {
		pp.document.writeln('<tr><td style="text-align:center; font-weight:bold;font-size:20px;">'+loan_card_g+'</td></tr>');
		}

		pp.document.writeln('<tr><td><table style="width:100% !important"  class="gurantor" cellspacing="0" cellspadding="0">');
		pp.document.writeln(document.getElementById(gurantor_table).innerHTML);
		pp.document.writeln('</table></td></tr><tr><td style="height:20px;"></td></tr>');
		if(document.getElementById(facility_card).innerHTML != "" || document.getElementById(facility_table).innerHTML != "") {
		pp.document.writeln('<tr><td style="text-align:center; font-weight:bold;font-size:20px;">Facility Info</td></tr>');
		}
		pp.document.writeln('<tr><td><table style="width:100% !important" class="facility" cellspacing="0" cellspadding="0">');
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