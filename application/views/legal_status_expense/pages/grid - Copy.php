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
		var proposed_type = ["Loan", "Card"];
	   jQuery(document).ready(function($) {
	   		jQuery("#searchPopup").jqxWindow({
            theme: theme, maxWidth: '60%', maxHeight: '80%', width: 900, height: 550, resizable: false,  isModal: true, autoOpen: false
       		});
	       //var theme = 'energyblue';
	       jQuery("#proposed_type").jqxComboBox({theme: theme, width: 150, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
	       //var theme = 'energyblue';
	       jQuery('#proposed_type').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
	       jQuery("#proposed_type").jqxComboBox('val','Loan');
	       change_caption();
	        jQuery('#proposed_type').bind('change', function (event) {
	            jQuery("#loan_ac").val('');
	            jQuery("#hidden_loan_ac").val('');
	            change_caption();       
	        });
            var theme = 'classic';
            jQuery("#sendtochecker").click(function () {
				jQuery("#sendtochecker").hide();
				jQuery("#SendTocheckercancel").hide();
				jQuery("#sendtochecker_loading").show();
	    		call_ajax_submit();
	   		 });
            jQuery("#verify").click(function () {
				jQuery("#verify").hide();
				jQuery("#Verifycancel").hide();
				jQuery("#verify_loading").show();
	    		call_ajax_submit();
	   		 });
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
					{ name: 'sts', type: 'int'},
					{ name: 'cma_id', type: 'int'},
					{ name: 'suit_file_id', type: 'int'},
					{ name: 'status', type: 'string'},
					{ name: 'loan_ac', type: 'string'},
					{ name: 'ac_name', type: 'string'},
					{ name: 'e_by', type: 'string'},
					{ name: 'e_by_id', type: 'int'},
					{ name: 'e_dt', type: 'string'},
					{ name: 'u_by', type: 'string'},
					{ name: 'u_dt', type: 'string'}
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
			  	url: '<?=base_url()?>index.php/legal_status_expense/grid',
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
						<? if(DELETE==1){?>
						  { text: 'D', datafield: 'delete', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 35 || dataRecord.sts == 39 || dataRecord.sts==69)){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'delete\')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
							 	}
							 	else {
		                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
		                      	}
	                      	}
		                  },
						<? }?>
						<? if(EDIT==1){?>
						  { text: 'E', datafield: 'edit', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 35 || dataRecord.sts == 39 || dataRecord.sts==69)){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="editt('+dataRecord.id+','+dataRecord.cma_id+','+dataRecord.suit_file_id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
								}
								else
								{
									return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
								}
	                      	}
		                  },
						<? }?>
						<? if(SENDTOCHECKER==1){?>
						  { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 35 || dataRecord.sts == 39)){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'sendtochecker\','+editrow+')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
							 	}
							 	else if(dataRecord.sts == 37){
		                      			return '<div style=" margin-top: 8px;text-align:center">S</div>';
		                      	}
		                      	else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
	                      	}
		                  },
						<? }?>
						<? if(VERIFY==1){?>
						  { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if(dataRecord.sts==37){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'verify\','+dataRecord.suit_file_id+')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
							 	}
							 	else if(dataRecord.sts == 51){
		                      			return '<div style=" margin-top: 8px;text-align:center">V</div>';
		                      	}
		                      	else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
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
					  	{ text: 'Status', datafield: 'status',editable: false, width: '17%', align:'left',cellsalign:'left'},
					  	{ text: 'Loan A/C or Card No.', datafield: 'loan_ac', editable: false,align:'center',cellsalign:'center', sortable: true, menu: true, width: '11%',
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
	                      		var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\')"><span>'+dataRecord.loan_ac+'</span></a></div>';
		                      	
	                      	}
		                  },
					  	{ text: 'A/C Name or Name on Card', datafield: 'ac_name',editable: false, width: '15%', align:'left',cellsalign:'left'},
						{ text: 'Entry By', datafield: 'e_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Entry Date Time', datafield: 'e_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'Update By', datafield: 'u_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Update Date and Time', datafield: 'u_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						 ],
					ready: function () {
	                    var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
	                     $('#jqxgrid').jqxGrid({ pagesizeoptions: ['25', '100','200']});
	                }
            });
			//End check box update 
			jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#deletecancel,#Verifycancel") });
			jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
			jQuery('#details').on('close', function (event) {
			    jQuery('#action_form').jqxValidator('hide');
			});
  });
	var count=0; var maxrow = 0; var displayrow= 0; inc = 0; decr = 0;
	function clearCount() { count=0; maxrow = 0;displayrow= 0;}
	function search_data(){
		jQuery("#jqxgrid").jqxGrid('updatebounddata');
		return;

	}
	function change_caption()
    {   
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
	function editt(val,cma_id,suit_file_id)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>legal_status_expense/form/edit/'+suit_file_id+'/'+cma_id+'/'+val, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
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
			url: "<?=base_url()?>legal_status_expense/r_history",
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
	function call_ajax_submit()
	{
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = jQuery('#action_form').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: '<?=base_url()?>index.php/legal_status_expense/delete_action/',
				data : postData,
				datatype: "json",
				success: function(response){
                  ///console.log(response);
					var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
						if (jQuery("#type").val()=='delete')
						{
							jQuery("#delete_row").show();
							jQuery("#delete_button").show();
							jQuery("#deletecancel").show();
							jQuery("#delete_loading").hide();
						}
						if (jQuery("#type").val()=='sendtochecker')
						{
							jQuery("#sendtochecker").show();
							jQuery("#SendTocheckercancel").show();
							jQuery("#sendtochecker_loading").hide();
							jQuery("#delete_loading").hide();
						}
						if (jQuery("#type").val()=='verify')
						{
							jQuery("#verify").show();
							jQuery("#Verifycancel").show();
							jQuery("#verify_loading").hide();
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
	function details(id,operation,suit_file_id)
	{
		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery('#suit_file_id').val(suit_file_id);
		if (operation=='details') 
		{
			jQuery("#header_title").html('Request Details');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').show();
			jQuery('#verify_row').hide();
		}
		else if (operation=='delete') 
		{
			jQuery("#header_title").html('Delete Request');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').show();
			jQuery('#close_btn_row').hide();
			jQuery('#comments').val('');
			jQuery('#verify_row').hide();
		}
		else if (operation=='sendtochecker') 
		{
			jQuery("#header_title").html('Send To Checker');
			jQuery('#sendtochecker_row').show();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#verify_row').hide();
		}
		else if (operation=='verify') 
		{
			jQuery("#header_title").html('Approve Changes');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#verify_row').show();
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
			url: "<?=base_url()?>legal_status_expense/details",
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
	function open_search_modal()
	{
		// alert("hello");
		jQuery('#suitTable').html('');
		jQuery('#loan_ac').val('');
		jQuery('#case_number').val('');
		jQuery("#searchPopup").jqxWindow('open');
	}
	function checksuit(i)
	{


		var flag=0;
		for (var j = 1; j <=jQuery("#suitCount").val(); j++) 
		{
			if (i==j)
			{
				continue;
			}else{jQuery("#suit_"+j).prop("checked", false);}
		}
		if(jQuery("#suit_"+i).is(":checked") == true)
		{
			
			var id=jQuery('#suit_id_'+i).val();
			var loan_ac=jQuery('#loan_ac_'+i).val();
			var ac_name = jQuery('#ac_name_'+i).val();
			var cma_id = jQuery('#cma_id_'+i).val();
			var case_number = jQuery('#case_number_'+i).val();
			jQuery("#loadTbody").html('');
			jQuery("#loadTbody").append('<tr><td style="border:1px solid #a0a0a0">'+loan_ac+'</td><td style="border:1px solid #a0a0a0">'+ac_name+'</td><td style="border:1px solid #a0a0a0">'+case_number+'</td></tr>');
			
			var strLink = '<?=base_url()?>index.php/legal_status_expense/form/add/'+id+'/'+cma_id;
			jQuery('#load_suit').attr("href",strLink);
			var strLink2 ='close_popup();javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), "yes"); return false;';
			jQuery('#load_suit').attr("onclick",strLink2);	
			jQuery('#load_suit').css("display", "block");
			
		}
		

		
	}
	function close_popup()
	{
		jQuery("#loadTbody").html('');
		jQuery('#suitTable').html('');
		jQuery('#load_suit').css("display", "none");
		jQuery("#searchPopup").jqxWindow('close');
	}
	function searchsuit()// customer search 
	{
		var loan_ac = jQuery('#loan_ac').val();
		var case_number = jQuery('#case_number').val();
		var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
		var proposed_type=jQuery('#proposed_type').val();
		var hidden_loan_ac = jQuery('#hidden_loan_ac').val();
		if (item!=null && loan_ac=='')
		{
			alert('please provide Loan/Card Number');
			jQuery('#loan_ac').focuse();
			return false;
		}
		else if(item==null && loan_ac!='')
		{
			alert('please select proposed type');
			jQuery("#proposed_type input").focus();
			return false;
		}
		if(loan_ac=='' && case_number=='')
		{
			alert('Please provide at least one search parameter!!!');
			jQuery("#load_suit_loading").hide();
			jQuery("#load").show();
			//return false;
		}
		else
		{
			jQuery("#load_suit_loading").show();
			jQuery("#load").hide();
			var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
			var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
			jQuery.ajax({
				type: "POST",
				cache: false,
				async:false,
				url: "<?=base_url()?>index.php/legal_status_expense/search_suit/",
				data : {[csrfName]: csrfHash,proposed_type:proposed_type,loan_ac: loan_ac, case_number:case_number,hidden_loan_ac:hidden_loan_ac},
				datatype: "html",
				success: function(response){
					var data = response.split("####");
					jQuery('.txt_csrfname').val(data[1]);
					jQuery("#load_suit_loading").hide();
					jQuery("#load").show();
					jQuery('#suitTable').html(data[0]);

				}
			});
		}
	}
	function error()
	{
		alert('Please Select Suit');
	}
	</script>
	<div id="container" style="">
	<div id="body"  >
		<div  style="display:block; min-height:350px; height:auto">
			<form method="POST" name="form" id="form"  style="margin:0px;">
			  <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
			  <div id="jqxgrid" style="width:100%;min-height:320px;height:auto;"></div>
			<div style="float:left;padding-top: 5px;padding-left:0px;">
			  <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
			  	<? if(ADD==1){?>
					<input type="button" class="buttonStyle" onclick="open_search_modal()" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:160px;"  value="Authorization Request" id="sendButton" />
			    <? }?> &nbsp;&nbsp;
			    <? if(VERIFY==1){?>
			    	<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
				    href="<?=base_url()?>index.php/legal_status_expense/bulk_operation/apv" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
				<? }?>&nbsp;&nbsp;&nbsp;&nbsp;
			    <strong>D = </strong>Delete Request,&nbsp;
			    <strong>E = </strong>Edit Request,&nbsp;
			    <strong>P = </strong>Preview,&nbsp;
			    <strong>STC = </strong>Send To Checker,&nbsp;
			    <strong>V = </strong>Verify&nbsp;
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
    		<input name="suit_file_id" id="suit_file_id" value="" type="hidden">
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
				<div id="sendtochecker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
					<div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
				      	<input type="button" class="buttonsendtochecker" id="sendtochecker" value="Send" />
				      	<input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel" />
				    	<span id="sendtochecker_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
				    </div>
				</div>
				<div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
					<div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
				      	<input type="button" class="buttonsendtochecker" id="verify" value="Approve" />
				      	<input type="button" class="buttonclose" id="Verifycancel" onclick="close()" value="Cancel" />
				    	<span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
				    </div>
				</div>
				<div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
			     	<strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
			     	<textarea name="comments" id="comments" style="width:370px;"></textarea>
				    </br></br>
				    <input type="button" class="buttondelete" id="delete_button" value="Delete" />
				    <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel" />
			    	<span id="delete_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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

    <div id="searchPopup" >
	    <div style="padding-left: 17px"><strong>Search Suit File</strong></div>
	    <div style="overflow: auto;" >
			<form class="form" id="form" method="post" action="#">
			<input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
	        <table width="98%" style="margin:auto" cellpadding="3" cellspacing="0">
			<tbody>
				<tr>
					<td style="width:10%;border:1px solid #e8e8e8;text-align:center">Proposed Type</td>
					<td style="width:20%;border:1px solid #e8e8e8"><div style="padding-left:1.8%" id="proposed_type" name="proposed_type"></div></td>
					<td style="width:10%;border:1px solid #e8e8e8;text-align:center"><span id="l_or_c_no"></span> No.</td>
					<td style="width:20%;border:1px solid #e8e8e8"><input name="loan_ac" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac" value="" onKeyUp="javascript:return mask(this.value,this);"/></td>
					<td style="width:15%;border:1px solid #e8e8e8;text-align:center">Case Number</td>
					<td style="width:20%;border:1px solid #e8e8e8"><input class="text-input-small" type="text" id = "case_number" style="width: 98% !important;" /></td>
					<td>
					<img src="<?=base_url()?>images/search.png" title="Search Customer" id="load" onclick="searchsuit()" align="absmiddle" style="cursor:pointer"  /><span id="load_suit_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></td>
				</tr>
				
				<tr>
					<td colspan="8" align="center" >
						<div id="suitTable" style="height: 200px; overflow:auto; border:1px solid #d0d0d0"></div>
					</td>
				</tr>
				<tr>
					<td colspan="8" align="center">
						<div id="loadBox" style="height: 200px; overflow:auto; border:1px solid #d0d0d0; background-color:#f1f1f1">
							<table cellpadding='5' cellspacing='0' style='width:96%;border-collapse:collapse;' >
								<tr bgcolor='#e8e8e8' >
								<td style="width:20%;border:1px solid #a0a0a0"><strong>Loan AC</strong></td>
								<td style="width:30%;border:1px solid #a0a0a0"><strong>AC Name</strong></td>
								<td style="width:20%;border:1px solid #a0a0a0"><strong>Case Number</strong></td>
								</tr>
								<tbody id="loadTbody"></tbody>
								<tfoot id="loadTfoot">
									<tr>
										<td colspan='6' align='center'>
										<a id="load_suit" style="text-decoration:none" onclick="error()" href="#" title="Suit Info">
										<input class='buttonStyle' type='button' id='custSave' value='Load' /></a>
										<input type='hidden' id='custnames' />
										<input type='hidden' id='custids' />
										<input type='hidden' id='custfullids' />
										<input type='hidden' id='brnch' />
										<input type='hidden' id='liability' />
										<input type='hidden' id='grp' />
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</td>
				</tr>
	           </tbody>
        	</table>
		</form>
	</div>
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