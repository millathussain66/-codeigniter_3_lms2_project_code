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
            
        var proposed_type = [{value:'Loan', label:'Loan'},{value:'Card', label:'Card'}];
        var type = [{value:'Pending', label:'Pending'},{value:'Executed', label:'Executed'}];
        var portfolio = [<? $i=1; foreach($loan_segment as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}'; $i++;}?>];
        var req_type = [<? $i=1; foreach($req_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>]; 

        jQuery("#proposed_type").jqxComboBox({theme: theme,autoOpen: false,autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, width: 150, height: 21,});
        jQuery("#portfolio").jqxComboBox({theme: theme,autoOpen: false,autoDropDownHeight: false, promptText: "Portfolio", source: portfolio, width: 150, height: 21});
        jQuery("#req_type").jqxComboBox({theme: theme,autoOpen: false,autoDropDownHeight: false, promptText: "Requisition Type", source: req_type, width: 150, height: 21});
        jQuery("#current_status").jqxComboBox({theme: theme,autoOpen: false,autoDropDownHeight: false, promptText: "Status", source: type, width: 150, height: 21});
        

        jQuery('#proposed_type,#portfolio,#current_status,#req_type').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });

        //jQuery("#proposed_type").jqxComboBox('val','Loan');
        change_caption();
        jQuery('#proposed_type').bind('change', function (event) {
            jQuery("#loan_ac").val('');
            jQuery("#hidden_loan_ac").val('');
            change_caption();       
        });

            jQuery("#closeaccount").click(function () {
	            if(jQuery("#close_account_remarks").val()=='')
	            {
	                alert('Please Give Remarks');
	                jQuery("#close_account_remarks").focus();
	                return false; 
	            }
	            if(confirm("Are you sure you want to Close this account"))
	            {
	                jQuery("#closeaccount").hide();
	                jQuery("#closeaccount_cancel").hide();
	                jQuery("#closeaccount_loading").show();
	                call_ajax_submit();
	            }
	         });
			<? if(ADD==1){?>
           jQuery("#sendButton").jqxButton({template:"primary",width:"170"});
			<?}?>
            var source =
            {
           datatype: "json",
           datafields: [
					{ name: 'id', type: 'int'},
					{ name: 'checker_id', type: 'int'},
					{ name: 'holm_checker_id', type: 'int'},
					{ name: 'hoops_user', type: 'int'},
					{ name: 'sts', type: 'string'},
					{ name: 'sl_no', type: 'string'},
					{ name: 'loan_ac', type: 'string'},
					{ name: 'cif', type: 'string'},
					{ name: 'branch_sol', type: 'string'},
					{ name: 'ac_name', type: 'string'},
					{ name: 'status', type: 'string'},
					{ name: 'request_type_name', type: 'string'},
					{ name: 'ho_return_reason', type: 'string'},
					{ name: 'ho_decline_reason', type: 'string'},
					{ name: 'region_name', type: 'string'},
					{ name: 'territory_name', type: 'string'},
					{ name: 'district_name', type: 'string'},
					{ name: 'unit_office_name', type: 'string'},
					{ name: 'other_ac', type: 'string'},
					{ name: 'cma_sts', type: 'int'},
					{ name: 'proposed_type', type: 'string'},
					{ name: 'loan_segment', type: 'string'},
					{ name: 'sec_sts', type: 'int'},
					{ name: 'ack_by', type: 'int'},
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
					{ name: 'legal_ack_dt', type: 'string'},
					{ name: 'legal_ack_by', type: 'string'},
					{ name: 'deliver_by', type: 'string'},
					{ name: 'deliver_dt', type: 'string'},
					{ name: 'cl_bbl', type: 'string'},
					{ name: 'branch', type: 'string'},
					{ name: 'int_rate', type: 'string'},
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
			  	url: '<?=base_url()?>index.php/hoops/grid',
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
						if(data[0].TotalRows>0){
							jQuery('#xl_btn').show();
						}else{
							jQuery('#xl_btn').hide();
						}
					}
				}

            };

		    var dataadapter = new jQuery.jqx.dataAdapter(source, {
					loadError: function(xhr, status, error)
					{						
						alert(error);
					},
					formatData: function (data) {
	                    var proposed_type = jQuery.trim(jQuery('input[name=proposed_type]').val());
	                    var loan_ac = jQuery.trim(jQuery('#loan_ac').val());
	                    var hidden_loan_ac = jQuery.trim(jQuery('#hidden_loan_ac').val());
	                    var portfolio = jQuery.trim(jQuery('input[name=portfolio]').val());
	                    var req_type = jQuery.trim(jQuery('input[name=req_type]').val());
	                    var type = jQuery.trim(jQuery('input[name=current_status]').val());
	                    jQuery.extend(data, {
	                            proposed_type : proposed_type,
	                            loan_ac : loan_ac,
	                            hidden_loan_ac : hidden_loan_ac,
	                            portfolio : portfolio,
	                            req_type : req_type,
	                            type : type,
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
						<? if(FILEPROCESSING==1){?>
						  { text: 'FD', datafield: 'fileprocessing', editable: false,align:'center', sortable: false, menu: false, width: 45,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if (dataRecord.proposed_type=='Loan')
								{
								var type=1;
								}else{var type=2}
								if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.hoops_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.cma_sts == 59 || dataRecord.cma_sts == 60 || dataRecord.cma_sts == 104 || dataRecord.cma_sts == 101))
								{
									return '<div style="text-align:center;margin-top: 2px; cursor:pointer" onclick="fileprocessing('+dataRecord.id+','+editrow+','+type+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
							 	}
							 	else if(dataRecord.cma_sts == 61)
							 	{
							 		return '<div style=" margin-top: 7px; text-align:center">D</div>';
							 	}
							 	else{
		                      			return '<div style=" margin-top: 7px; text-align:center"></div>';
		                      	}
	                      	}
		                  },
					  <? }?>
					  <? if(CLOSEACCOUNT==1){?>
                          { text: 'Account Close', datafield: 'closeaccount', editable: false,align:'center', sortable: false, menu: false, width: '8%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.hoops_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.cma_sts == 59 || dataRecord.cma_sts == 60  || dataRecord.cma_sts == 104 || dataRecord.cma_sts == 101)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'closeaccount\','+editrow+')" ><img align="center" src="<?=base_url()?>images/cancel.png"></div>';
                                }
                                else{
                                    return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
					  	{ text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
				  			cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details('+dataRecord.id+',\'details\','+editrow+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

							  }
					  	},
					  	{ text: 'Status', datafield: 'status',editable: false, width: '25%', align:'left',cellsalign:'left'},
					  	{ text: 'Serial', datafield: 'sl_no',editable: false, width: '8%', align:'left',cellsalign:'left'},
					  	{ text: 'Protfolio', datafield: 'loan_segment',editable: false, width: '8%', align:'left',cellsalign:'left'},
					  	{ text: 'Loan A/C or Card No.', datafield: 'loan_ac', editable: false,align:'center',cellsalign:'center', sortable: true, menu: true, width: '11%',
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
	                      		var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\')"><span>'+dataRecord.loan_ac+'</span></a></div>';
		                      	
	                      	}
		                  },
					  	{ text: 'A/C Name or Name on Card', datafield: 'ac_name',editable: false, width: '15%', align:'left',cellsalign:'left'},
					  	{ text: 'CL', datafield: 'cl_bbl',editable: false, width: '5%', align:'left',cellsalign:'left'},
					  	{ text: 'Branch', datafield: 'branch',editable: false, width: '15%', align:'left',cellsalign:'left'},
					  	{ text: 'Int. Rate', datafield: 'int_rate',editable: false, width: '5%', align:'left',cellsalign:'left'},
					  	{ text: 'Other Ac', datafield: 'other_ac',editable: false, width: '35%', align:'left',cellsalign:'left',sortable: false, menu: false,},
					  	{ text: 'Region', datafield: 'region_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'Territory', datafield: 'territory_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'District', datafield: 'district_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'Unit Office', datafield: 'unit_office_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
						{ text: 'Requisition', datafield: 'request_type_name',editable: false, width: '8%', align:'left',cellsalign:'left'},
						{ text: 'Initiate By', datafield: 'e_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Initiate Date Time', datafield: 'e_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'Reject/Return Reason', datafield: 'ho_return_reason', editable: false,align:'left',cellsalign:'left', sortable: true, menu: true, width: '15%',
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if (dataRecord.ho_return_reason!=null)
								 {
								 	return '<div style=" margin-top: 7px;margin-left: 7px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+')"><span>'+dataRecord.ho_return_reason+'</span></a></div>';
								 }
								 else if(dataRecord.ho_decline_reason!=null){
								 	return '<div style=" margin-top: 7px;margin-left: 7px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+')"><span>'+dataRecord.ho_decline_reason+'</span></a></div>';
								 }
								 else{return '<div style=" margin-top: 5px;text-align:center"></div>';}
		                      	
	                      	}
		                  },
		                { text: 'Send To Legal By', datafield: 'deliver_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Send To Legal Date and Time', datafield: 'deliver_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'Legal Acknowledge By', datafield: 'legal_ack_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Legal Acknowledge Date and Time', datafield: 'legal_ack_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
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
			//End check box update 
			jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#sendtohoopscancel,#closeaccount_cancel") });
			jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
  });
	var count=0; var maxrow = 0; var displayrow= 0; inc = 0; decr = 0;
	function clearCount() { count=0; maxrow = 0;displayrow= 0;}
	function search_data(){
		jQuery("#jqxgrid").jqxGrid('updatebounddata');
		return;

	}
	function mask(str,textbox){
	    var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
	    if (item!=null)
	    {
	        if (item.value=='Card') 
	        {
	            if (!str.includes("*") && str.length==16)//For one time value paste
	            {
	                var length=str.length;
	                var first_6= str.slice(0, 6);
	                var mid='******';
	                var last_6=str.slice(12, 16);
	                var final_str=first_6+mid+last_6;
	                textbox.value = final_str
	                jQuery("#hidden_loan_ac").val(str);
	            }
	            else//For single value enter
	            {
	                //For New value
	                var orginal_loan_ac=jQuery("#hidden_loan_ac").val();
	                if (orginal_loan_ac.length<str.length) 
	                {
	                    var index = str.length-1;
	                    var new_val=str.slice(index);
	                    orginal_loan_ac+=new_val;
	                    //alert(orginal_loan_ac);
	                    jQuery("#hidden_loan_ac").val(orginal_loan_ac);
	                }
	                //For delete key
	                else{
	                    var len=str.length;
	                    var new_val=orginal_loan_ac.slice(0,len);
	                    jQuery("#hidden_loan_ac").val(new_val);
	                }
	                //For First 6 key
	                if (str.length<=6)
	                {
	                    textbox.value = str
	                }
	                //for the last 4 key
	                else if(str.length>=13)
	                {
	                    textbox.value = str
	                }
	                //For the middle 4 key
	                else{
	                    var length=str.length;
	                    var first_6= str.slice(0, 6);
	                    var mid=(str.length-6);
	                    var final_str=first_6;
	                    for (var i = 1; i <= mid; i++) {
	                        final_str+='*';
	                    }
	                    textbox.value = final_str
	                }

	                if(str.length==16)//wrong input check
	                {
	                    var letter_Count = 0;
	                    var letter = '*';
	                     for (var position = 0; position < str.length; position++) 
	                     {
	                        if (str.charAt(position) == letter) 
	                        {
	                           letter_Count += 1;
	                        }
	                      }
	                      if (letter_Count<6 || jQuery("#hidden_loan_ac").val().length!=16) 
	                      {
	                        textbox.value = '';
	                        jQuery("#hidden_loan_ac").val('');
	                        alert('Wrong way to input Card No please try again');
	                      }
	                }
	            }
	        }
	    }
	    
	}
	function change_caption(){   
	    if (jQuery("#proposed_type").val()=='') 
	    {
	        document.getElementById("loan_ac").disabled = true;
	        jQuery("#l_or_c_no").html('Loan A/C or Card');
	    }
	    else
	    {
	        document.getElementById("loan_ac").disabled = false;
	        var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
	        if (item.value=='Loan') {
	            jQuery("#l_or_c_no").html('Loan A/C ');
	        }
	        else if(item.value=='Card'){
	            jQuery("#l_or_c_no").html('Card');
	        }
	    }
	    
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
	function fileprocessing(id,indx,proposed_type,sec_sts)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/hoops/fileprocessing/'+id+'/'+indx+'/'+proposed_type+'/'+sec_sts, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function call_ajax_submit()
	{
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = jQuery('#action_form').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: '<?=base_url()?>index.php/hoops/delete_action/',
				data : postData,
				datatype: "json",
				success: function(response){
                  ///console.log(response);
					var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
                        if (jQuery("#type").val()=='closeaccount')
                        {
                            jQuery("#closeaccount").show();
                            jQuery("#closeaccount_cancel").show();
                            jQuery("#closeaccount_loading").hide();
                        }
						if(json.Message!='OK')
						{
							jQuery('#details').jqxWindow('close');
							alert(json.Message);
							return false;
						}else{
						var row = {};
						row["id"] = json['row_info'].id;
						row["sl_no"] = json['row_info'].sl_no;
						row["loan_ac"] = json['row_info'].loan_ac;
						row["ac_name"] = json['row_info'].ac_name;

						var msz='';

						jQuery("#jqxgrid").jqxGrid('updatebounddata');
						jQuery("#error").show();
						jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});								
						jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz);	
						jQuery('#details').jqxWindow('close');
					}
				}
			});

	}
	function details(id,operation,indx,cif,proposed_type,sec_sts)
	{
		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery('#cif').val(cif);
		jQuery('#sec_sts').val(sec_sts);
		jQuery('#verifyIndexId').val(indx);
		if (operation=='details') 
		{
			jQuery("#header_title").html('CMA Details');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').show();
			jQuery('#sendtohoops_row').hide();
            jQuery('#closeaccount_row').hide();
		}
		else if (operation=='acknowledgement') 
		{
			jQuery("#header_title").html('Acknowledge CMA');
			jQuery('#sendtochecker_row').show();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#sendtohoops_row').hide();
            jQuery('#closeaccount_row').hide();
		}
		else if(operation=='sendtohoops')
		{
			jQuery("#header_title").html('Send To HOOPS CMA');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#sendtohoops_row').show();
            jQuery('#closeaccount_row').hide();
		}
		else if(operation=='closeaccount')
		{
			jQuery("#header_title").html('Close/Settle Account');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#sendtohoops_row').hide();
            jQuery('#closeaccount_row').show();
            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'close_account_file\')"/>';
            html+='<input type="hidden" id="hidden_close_account_file_select" name="hidden_close_account_file_select" value="0">';
            html+='<span id="hidden_close_account_file">';
            jQuery('#close_account_file').html(html);
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
			url: "<?=base_url()?>hoops/details",
			data : {[csrfName]: csrfHash,id: id},
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
	function decline_action()
	{
		jQuery("#decline_check").val(1);
		jQuery('#decline_part').css("display", "block");

	}
	function xl_download(){
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = jQuery('#daily_report_search').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: '<?=base_url()?>index.php/hoops_rt/mk_xl_all_report',
			data : postData,
			datatype: "json",
			success: function(data){
              ///console.log(response);
				var json = jQuery.parseJSON(data);
				jQuery('.txt_csrfname').val(json.csrf_token);
				var a = jQuery("<a>");
			    jQuery("body").append(a);
			    a.attr("download","Hoops_All_Report.xls");
			    a.attr("href",json.file);
			    a[0].click();
			    a.remove();
			}
		});

		
	}
	function CustomerPickList(module_name=null,data_field_name=null) {
        if(jQuery("#hidden_final_ln_value").val()!='')
        {
            if (jQuery("#file_delete_value_"+data_field_name).val()==0) 
            {
                alert('Please Delete Previous file for new upload');
                return false;
            }
        }
        newwindow=window.open("<?=base_url()?>index.php/home/ajaxFileUpload/"+module_name+'/'+data_field_name,"Upload","width=550,height=350,resizable=0,scrollbars=0,location=no,menubar=no,toolbar=no,minimizable=no,status=no,top=140,left=340"); 
        if (window.focus) {newwindow.focus()}
        return false; 
    }
	</script>
	<div id="container" style="">
	<div id="body"  >
		<div  style="display:block; height:auto">
            <form method="POST" name="form" id="daily_report_search"  style="margin:0px;" action="<?=base_url()?>index.php/hoops_rt/daily_report/<?=$menu_group?>/<?=$menu_cat?>">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
               <div style="padding: 0.5%;width:98%;height:22px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                    <table id="deal_body" style="display:block;width:100%">
                        <tr>
                        	<td style="width: 100px;"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                            <td ><div style="" id="proposed_type" name="proposed_type"></div></td>
                            <td style="width: 80px;text-align: right;"><strong><span id="l_or_c_no"></span>&nbsp;&nbsp;</strong> </td>
                            <td><input type="text" disabled id="loan_ac" name="loan_ac" maxlength="16" size="16" style="width:150px" onKeyUp="javascript:return mask(this.value,this);" /></td>

                            <td style="width: 100px;text-align: right;"><strong>Portfolio&nbsp;&nbsp;</strong> </td>
                            <td ><div style="" id="portfolio" name="portfolio"></div></td>
                            <td style="width: 100px;text-align: right;"><strong>Req. Type&nbsp;&nbsp;</strong> </td>
                            <td ><div style="" id="req_type" name="req_type"></div></td>
                            <td style="width: 100px;text-align: right;"><strong>Status&nbsp;&nbsp;</strong> </td>
                            <td ><div style="" id="current_status" name="current_status"></div></td>
                            <td  style="width: 50px;text-align: right;"><input name="post_sts" id="post_sts" onclick="search_data(),clearCount()" class="crmbutton small create"  value="Search" type="button">
                            </td>
                            <td style="width: 50px;text-align: right;display: none;" id="xl_btn" valign="top">
                                <button type="button" formtarget="_blank" name="xlsts" title="Legal Notice" onclick="xl_download()"><img width="20px" height="20px" align="center" src="<?=base_url()?>images/icon_xls.gif"></button>
                            </td>
                            
                        </tr>
                    </table>
              </div>
              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>

            </form>
        </div>
		<div  style="display:block; min-height:350px; height:auto">
		<form method="POST" name="form" id="form"  style="margin:0px;">
		<div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
		<div id="jqxgrid" style="width:100%;min-height:320px;height:auto;"></div>
		

		<div style="float:left;padding-top: 5px;padding-left:0px;">
		  <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
		    <? if(FILEPROCESSING==1 && (check_group(18) || $this->session->userdata['ast_user']['user_system_admin_sts']=='2')){?>
			<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
		    href="<?=base_url()?>index.php/hoops/bulk_operation" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK FD" id="sendButton" /></a>
		    <? }?> &nbsp;&nbsp;
		    <strong>P = </strong> Preview,&nbsp;
		    <strong>FD = </strong>File Deliver&nbsp;
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
    		<input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
    		<input name="type" id="type" value="" type="hidden">
    		<input name="cif" id="cif" value="" type="hidden">
    		<input name="sec_sts" id="sec_sts" value="" type="hidden">
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
				<div id="closeaccount_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: 300px;margin-top: 0px;">
                            <tr>
                                <td>Attachment<span style="color: green;"> (If Any)</span></td>
                                <td>
                                    <span id="close_account_file"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Remarks<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="close_account_remarks" id="close_account_remarks" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttondelete" id="closeaccount" value="Close" />
                                    <input type="button" class="buttonclose" id="closeaccount_cancel" onclick="close()" value="Cancel" />
                                    <span id="closeaccount_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
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
    <div id="deleteMessageDialogContent"  style="display:none">
      <div class="hd"><h2 class="conf">Are you sure you want to Acknowledge?</h2></div>
      <form method="POST" name="deleteMessageform" id="deleteMessageform"  style="margin:0px;">
        <input name="deleteEventId2" id="deleteEventId2" value="" type="hidden">
        <input name="typebulk" id="typebulk" value="bulk" type="hidden">
        <input name="cif2" id="cif2" value="" type="hidden">
        <input name="action" value="DeleteMessage" type="hidden">
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