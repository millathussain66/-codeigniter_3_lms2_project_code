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
.buttonhold {
   background-color: white; 
  color: black; 
  border: 2px solid yellow;
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
.buttonhold:hover {
  background-color: yellow;
  color: black;
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
    	var idd = 0; var indxx = 0;
    	var paper_vendor = [<? $i=1; foreach($paper_vendor as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
	   jQuery(document).ready(function($) {
	   	jQuery("#paper_vendor").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Vendor", source: paper_vendor, width: 215, height: 25});
	   		jQuery('#paper_vendor').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
	   		rules2 = [
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

				} }
            ];
            rules_hold = [
				{ input: '#hold_reason', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
					if(jQuery("#hold_reason").val()=='')
					{
						jQuery("#hold_reason").focus();
						return false;
					}
					else
					{
						return true;
					}
				}
				},

				{ input: '#hold_reason', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
				 {
				 	if(input.val() != '')
					{
						if(input.val().length>250)
						{
							jQuery("#hold_reason").focus();
						 	return false;

						}
					}
					return true;

				} }
            ];
            rules3 = [
				{ input: '#complete_remarks', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
					if(jQuery("#complete_remarks").val()=='')
					{
						jQuery("#complete_remarks").focus();
						return false;
					}
					else
					{
						return true;
					}
				}
				},

				{ input: '#complete_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
				 {
				 	if(input.val() != '')
					{
						if(input.val().length>250)
						{
							jQuery("#complete_remarks").focus();
						 	return false;

						}
					}
					return true;

				} }
            ];

            rules4 = [
            	{ input: '#paper_vendor', message: 'required!', action: 'blur,change', rule: function (input) {                   
                    if(input.val() != '')
                    {
                        var item = jQuery("#paper_vendor").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='paper_vendor']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#paper_vendor input").focus();
                        return false;
                    }
                }  
                },
				{ input: '#email', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
					if(jQuery("#email").val()=='')
					{
						jQuery("#email").focus();
						return false;
					}
					else
					{
						return true;
					}
				}
				},
				{ input: '#email', message: 'invalid!', action: 'keyup, blur', rule: function(input,commit){
					if(jQuery("#email").val()!='')
					{
						var email = jQuery('#email').val();
						var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/;
			            //var re = /\S+@\S+\.\S+/;
			            let arr = email.split(",");
			            let check = true;
			            arr.each(function(item,index){
			                //console.log(item);
			                if(item===''){
			                    check = false;
			                }else{
			                    check = re.test(item);
			                }
			                
			            });
			            if(!check){
			        		jQuery('#email').focus();
			            	return false;
			            }else{
			            	return true;
			            }
					}
					else
					{
						return true;
					}
				}
				}
            ];
	   		jQuery("#sendtochecker").click(function () {
	   			if (jQuery('#mortgage_counter_preview').val()<1)
				{
					alert('Please,Give At Least One Mortgage !!');
				 	return false;
				}
				else
				{
					for (var i = 1; i <=jQuery('#mortgage_counter_preview').val(); i++) {
						if (jQuery('#mort_name_'+i).val()=='')
						{
							alert('Please Give Schedule Name for this Deed number('+jQuery('#deed_number_'+i).val()+')')
							return false;
						}
					}
				}
				if (jQuery('#security_counter_preview').val()<1)
				{
					alert('Please,Give At Least One Security !!');
				 	return false;
				}
		  		jQuery("#sendtochecker").hide();
				jQuery("#SendTocheckercancel").hide();
				jQuery("#sendtochecker_loading").show();
		  		call_ajax_submit();
	   		 });
	   		jQuery("#acknowledgement").click(function () {
	   			jQuery('#type').val('acknowledgement');
                jQuery('#hold_return_row').hide();
                jQuery('#action_form').jqxValidator('hide');
		  		jQuery("#acknowledgement").hide();
		  		jQuery("#return_button").hide();
		  		jQuery("#hold_button").hide();
				jQuery("#Acknowledgementcancel").hide();
				jQuery("#acknowledgement_loading").show();
		  		call_ajax_submit();
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
	   		jQuery("#vendornotify").click(function () {
          		jQuery('#action_form').jqxValidator({
			        rules: rules4, theme: theme
			    });
	    		var validationResult = function (isValid) {
					if (isValid) {
						jQuery("#vendornotify").hide();
						jQuery("#vendornotifycancel").hide();
						jQuery("#vendornotify_loading").show();
				  		call_ajax_submit();
					}
				}
				jQuery('#action_form').jqxValidator('validate', validationResult);
		  		
	   		 });
	   		jQuery("#hold").click(function () {
          		jQuery('#action_form').jqxValidator({
			        rules: rules_hold, theme: theme
			    });
	    		var validationResult = function (isValid) {
					if (isValid) {
						jQuery("#hold").hide();
						jQuery("#holdcancel").hide();
						jQuery("#hold_loading").show();
				  		call_ajax_submit();
					}
				}
				jQuery('#action_form').jqxValidator('validate', validationResult);
		  		
	   		 });
	   		jQuery("#auctionconfirm").click(function () {
	   		if ((jQuery("#hidden_auction_sign_memo_select").val()=='0' && jQuery('#memo_select_add_edit').val()=='add') || (jQuery("#hidden_auction_sign_memo_select").val()=='0' && jQuery("#file_delete_value_auction_sign_memo").val()=='1' && jQuery('#memo_select_add_edit').val()=='edit')) 
	          {
	              if(jQuery("#bidder_info_counter").val()!=undefined)
	              {
	              	alert('Please Upload Sing Memo');
	              	return false;
	              }
	          }
          jQuery('#action_form').jqxValidator({
			        rules: rules3, theme: theme
			    });
	    		var validationResult = function (isValid) {
					if (isValid) {
						jQuery("#auctionconfirm").hide();
					jQuery("#auctionconfirmcancel").hide();
					jQuery("#auctionconfirm_loading").show();
			  		call_ajax_submit();
					}
				}
				jQuery('#action_form').jqxValidator('validate', validationResult);
		  		
	   		 });
	   		jQuery("#auctionsts").click(function () {
	    	if (jQuery('#auction_status').val() == '' || jQuery('#auction_status').val() == 0 || jQuery('#auction_status').val() == null || jQuery('#auction_status').val() == 'undefined') {
	    		alert('Auction Status required!');
	    		jQuery('#auction_status').focus();
	    		return;
	    	}
	    	else
	    	{
	    		jQuery('#action_form').jqxValidator({
			        rules: rules2, theme: theme
			    });
	    		var validationResult = function (isValid) {
					if (isValid && bidder_validation()!=false) {
						jQuery("#auctionsts").hide();
						jQuery("#auctionstscancel").hide();
						jQuery("#auctionsts_loading").show();
			    		call_ajax_submit();
					}
				}
				jQuery('#action_form').jqxValidator('validate', validationResult);

	    	}
   		 });

	   	jQuery("#sendmailbtn").click(function () {
	   		var email = jQuery('#email').val();
	   		if(email!=''){
	   		var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/;
            //var re = /\S+@\S+\.\S+/;
            let arr = email.split(",");
            let check = true;
            arr.each(function(item,index){
                //console.log(item);
                if(item===''){
                    check = false;
                }else{
                    check = re.test(item);
                }
                
            });
            if(check){
            	jQuery("#sendmailbtn").hide();
                jQuery("#sendmailCancel").hide();
                jQuery("#sendmailloading").show();
            	vendor_notify_send();
            }else{
            	alert('Email is invalid!');
        		jQuery('#email').focus();
            }
        	}else{
        		alert('Email field is required!');
        		jQuery('#email').focus();
        	}
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
					{ name: 'exp_sts', type: 'int'},
					{ name: 'auc_dt_sts', type: 'int'},
					{ name: 'checker_id', type: 'int'},
					{ name: 'legal_region', type: 'int'},
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
					{ name: 'req_type', type: 'int'},
					{ name: 'ln_expiry_dt', type: 'string'},
					{ name: 'ln_serve_dt', type: 'string'},
					{ name: 'auction_date', type: 'string'},
					{ name: 'serve_ln_sts', type: 'int'},
					{ name: 'paper_vendor', type: 'int'},
					{ name: 'legal_response_by', type: 'string'},
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
			  	url: '<?=base_url()?>index.php/auction/grid',
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
								if(dataRecord.auction_sts == 24){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'acknowledgement\','+editrow+','+dataRecord.cma_id+','+dataRecord.loan_ac+','+dataRecord.cif+')" ><img align="center" src="<?=base_url()?>images/favorites.png"></div>';
							 	}
							 	else {
		                      			return '<div style=" margin-top: 8px;text-align:center">ACK</div>';
		                      	}
	                      	}
		                  },
						<? }?>
						<? if(HOLD==1){?>
                          { text: 'H', datafield: 'hold', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.auction_sts != 33 && dataRecord.auction_sts != 76){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'hold\','+editrow+','+dataRecord.cma_id+','+dataRecord.loan_ac+','+dataRecord.cif+')" ><img align="center" src="<?=base_url()?>images/pending.png"></div>';
                                }
                                else{
                                    return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
						<?php if (EDIT == 1) {?>
						{ text: 'E', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
					  	cellsrenderer: function (row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if(<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by && (dataRecord.auction_sts == 16 || dataRecord.auction_sts == 44)){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="editt('+dataRecord.id+','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
								}
								else{
									return '<div style=" margin-top: 5px;text-align:center"></div>';
								}
							}
						  },
					  	<?php }?>
					  	<? if(SENDTOCHECKER==1){?>
						  { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.auction_sts == 16 || dataRecord.auction_sts == 44)){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'sendtochecker\','+editrow+','+dataRecord.cma_id+','+dataRecord.loan_ac+','+dataRecord.cif+')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
							 	}
							 	else if(dataRecord.auction_sts == 58){
		                      			return '<div style=" margin-top: 8px;text-align:center">S</div>';
		                      	}
		                      	else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
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
					  	<?php if (AUCTIONVERIFY == 1) {?>
						{ text: 'VA', menu: false, datafield: 'auctionverify', align:'center', editable: false, sortable: false, width: '2%',
					  	cellsrenderer: function (row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if(dataRecord.auction_sts == 58){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="verify('+dataRecord.id+','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
								}
								else if(dataRecord.auction_sts == 41)
								{
									return '<div style=" margin-top: 8px;text-align:center">V</div>';
								}
								else{
									return '<div style=" margin-top: 8px;text-align:center"></div>';
								}
							}
						  },
					  	<?php }?>
					  	<?php if (SENDTOLEGAL == 1) {?>
						{ text: 'STL', menu: false, datafield: 'memoprepare', align:'center', editable: false, sortable: false, width: '3%',
					  	cellsrenderer: function (row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if(<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by && (dataRecord.auction_sts == 41 || dataRecord.auction_sts == 17 || dataRecord.auction_sts == 40) ){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="sendtolegal('+dataRecord.id+','+editrow+','+dataRecord.cma_id+','+dataRecord.legal_region+')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
								}
								else{
									return '<div style=" margin-top: 8px;text-align:center"></div>';
								}
							}
						  },
					  	<?php }?>
					  	<?php if (PAPERNOTICE == 1) {?>
					  		{ text: 'PN', datafield: 'auctionnotice', editable: false,align:'center',cellsalign:'center', sortable: false, menu: false, width: '2%',
		     				cellsrenderer: function(row) {
		                      		editrow = row;
								 	var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
									 if (dataRecord.auction_sts>=42 || dataRecord.serve_ln_sts==1)
									 {
									 	return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="paper_notice('+dataRecord.id+','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/out.png"></div>';
									 }

		        				}
			                },
					  	<?php }?>
					  	<?php if (LAWYERNOTIFICATIONSENT == 1) {?>
					  		{ text: 'VN', datafield: 'vendornotify', editable: false,align:'center',cellsalign:'center', sortable: false, menu: false, width: '2%',
		     				cellsrenderer: function(row) {
		                      		editrow = row;
								 	var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								 	if(<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by && ((dataRecord.auction_sts == 42 && dataRecord.exp_sts==1) || (dataRecord.serve_ln_sts==1 && dataRecord.auction_sts == 41))){
										return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'vendornotify\','+editrow+','+dataRecord.cma_id+','+dataRecord.loan_ac+','+dataRecord.cif+')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
									}
		        				}
			                },
					  	<?php }?>
					  	<?php if (PAPERINFO == 1) {?>
						{ text: 'PI', menu: false, datafield: 'verifymemo', align:'center', editable: false, sortable: false, width: '2%',
					  	cellsrenderer: function (row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if(<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by && ((dataRecord.auction_sts == 42 && dataRecord.exp_sts==1) || (dataRecord.serve_ln_sts==1 && dataRecord.auction_sts == 41))){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="paper_info('+dataRecord.id+','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
								}
								else{
									return '<div style=" margin-top: 8px;text-align:center"></div>';
								}
							}
						  },
					  	<?php }?>
					  	<?php if (UPDATEBIDDERINFO == 1) {?>
						{ text: 'UB', menu: false, datafield: 'updatebidder', align:'center', editable: false, sortable: false, width: '2%',
					  	cellsrenderer: function (row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if(<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by && dataRecord.auction_sts == 43 && dataRecord.auc_dt_sts==1){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="updatebidder('+dataRecord.id+','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
								}
								else if(dataRecord.auction_sts == 18)
								{
									return '<div style=" margin-top: 8px;text-align:center">UB</div>';
								}
								else{
									return '<div style=" margin-top: 8px;text-align:center"></div>';
								}
							}
						  },
					  	<?php }?>
					  	<?php if (AUCTIONMEMO == 1) {?>
					  		{ text: 'AM', datafield: 'auctionmemo', editable: false,align:'center',cellsalign:'center', sortable: false, menu: false, width: '2%',
		     				cellsrenderer: function(row) {
		                      		editrow = row;
								 	var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
									 //return '<div style=" margin-top: 5px;text-align:center"><a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?php //echo base_url(); ?>auction/memo_auction/'+dataRecord.cma_id+'" target="_blank"><img src="<?php //echo base_url(); ?>images/word_icon.gif" align="middle"></a></div>';
									 return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="paper_memo('+dataRecord.id+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/out.png"></div>';

		        				}
			                },
					  	<?php }?>
					  	<? if(AUCTIONSTS==1){?>
						  { text: 'AS', datafield: 'auctionsts', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								// if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.auction_sts == 18){
								// 	return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'auctionsts\','+editrow+','+dataRecord.cma_id+','+dataRecord.loan_ac+','+dataRecord.cif+')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
							 // 	}
		      //                 	else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
		      					if(dataRecord.auction_sts != 33 && dataRecord.auction_sts != 76 && ((dataRecord.legal_response_by!='' && dataRecord.legal_response_by!=null) || dataRecord.serve_ln_sts==1)){
		      						return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'auctionsts\','+editrow+','+dataRecord.cma_id+','+dataRecord.loan_ac+','+dataRecord.cif+')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
	                      		}
	                      	}
		                  },
					  <? }?>
					  <? if(AUCTIONCONFIRM==1){?>
						  { text: 'AC', datafield: 'auctionconfirm', editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								//if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.auction_sts == 83 && dataRecord.req_type!=5){
								if(dataRecord.req_type!=5 && dataRecord.auction_sts != 33 && dataRecord.auction_sts != 76 && ((dataRecord.legal_response_by!='' && dataRecord.legal_response_by!=null) || dataRecord.serve_ln_sts==1)){
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'auctionconfirm\','+editrow+','+dataRecord.cma_id+','+dataRecord.loan_ac+','+dataRecord.cif+')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
							 	}
		                      	else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
	                      	}
		                  },
					  <? }?>
					  <? if(CLOSEACCOUNT==1){?>
                          { text: 'Account Close', datafield: 'closeaccount', editable: false,align:'center', sortable: false, menu: false, width: '8%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.auction_sts != 33 && dataRecord.auction_sts != 76){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'closeaccount\','+editrow+','+dataRecord.cma_id+','+dataRecord.loan_ac+','+dataRecord.cif+')" ><img align="center" src="<?=base_url()?>images/cancel.png"></div>';
                                }
                                else{
                                    return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
						{ text: 'Status', datafield: 'status',editable: false, width: '17%', align:'left',cellsalign:'left'},
						{ text: 'Serial', datafield: 'serial',editable: false, width: '8%', align:'left',cellsalign:'left'},
						{ text: 'Loan A/C or Card No.', datafield: 'loan_ac', editable: false,align:'center',cellsalign:'center', sortable: true, menu: true, width: '11%',
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
	                      		var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.cma_id+',\'life_cycle\')"><span>'+dataRecord.loan_ac+'</span></a></div>';

	                      	}
		                  },
		                 { text: 'A/C Name or Name on Card', datafield: 'ac_name',editable: false, width: '15%', align:'left',cellsalign:'left'},
						{ text: 'LN Serve Dt', datafield: 'ln_serve_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'LN Expiry Dt', datafield: 'ln_expiry_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'Auction Date', datafield: 'auction_date',editable: false, width: '12%' , align:'center',cellsalign:'center'},
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
			jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#deletecancel,#auctionstscancel,#Acknowledgementcancel,#auctionconfirmcancel,#vendornotifycancel,#closeaccount_cancel,#holdcancel") });
			jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
			jQuery('#details').on('close', function (event) {
			    jQuery('#action_form').jqxValidator('hide');
			});
			jQuery("#sendmail").jqxWindow({ theme: theme,  width: '55%', height:'80%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#sendmailCancel") });
  	});
	function CustomerPickList(module_name=null,data_field_name=null) {
        if(jQuery("#add_edit").val()=='edit')
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
    function file_delete(id)
    {
        if(confirm('Are you sure to Delete previous file?')){   
            jQuery("#file_preview_"+id).hide(); 
            jQuery("#file_delete_"+id).hide();  
            jQuery("#file_delete_value_"+id).val(1);    
        }
    }
	function bidder_validation()
	{
		var counter=0;
		if(jQuery('#bidder_info_counter').val()!=undefined)//when there is no bidder
		{
			var total_row = jQuery('#bidder_info_counter').val();
		
			var check=0;
			for(var i=1; i<=total_row; i++)
			{
				if(document.getElementById("chkBoxSelect"+i).checked==true)
				{
					check++;
				}
			}
			if (check<1)
			{
			 	alert('Please, select at least one Bidder !!');
			 	return false;
			}
		}
		return true;
	}
	function verify(val,indx,cma_id)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/auction/auction_verify/'+val+'/'+indx+'/'+cma_id, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function sendtolegal(val,indx,cma_id,legal_region)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/auction/sendtolegal/'+val+'/'+indx+'/'+cma_id+'/'+legal_region, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function updatebidder(val,indx,cma_id)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/auction/update_bidder/'+val+'/'+indx+'/'+cma_id, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function paper_info(val,indx,cma_id)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/auction/paper_info/'+val+'/'+indx+'/'+cma_id, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function editt(val,indx,cma_id)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>auction/from/edit/'+val+'/'+cma_id+'/'+indx, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function CheckAll_2(checkAllBox)
	{
		var ChkState=checkAllBox.checked;
		var number=jQuery("#bidder_info_counter").val();

		if (ChkState==true)
		{
			for(var i=1; i<=number; i++){
				jQuery("#bidder_info_delete_"+i).val(0);
				document.getElementById("chkBoxSelect"+i).checked=ChkState;
			}
		}
		else{
			for(var i=1; i<=number; i++){
				jQuery("#bidder_info_delete_"+i).val(1);
				document.getElementById("chkBoxSelect"+i).checked=ChkState;
			}
		}
	}
	function CheckChanged_2(checkAllBox,counter)
	{
		var ChkState=checkAllBox.checked;
		if (ChkState==true)
		{
			jQuery("#bidder_info_delete_"+counter).val(0);
		}
		else
		{
			jQuery("#bidder_info_delete_"+counter).val(1);
		}
		var number=jQuery("#bidder_info_counter").val();
		var checkco=0;
		for(var i=1; i<=number; i++){
			if(document.getElementById("chkBoxSelect"+i).checked==true){
			checkco++;
			}
		}
		if (number==checkco){
		document.getElementById("checkAll").checked=true;
		}else{
		document.getElementById("checkAll").checked=false;
		}
	}
	function details(id,operation,indx,cma_id,loan_ac,cif)
	{
		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery('#verifyIndexId').val(indx);
		jQuery('#cma_id').val(cma_id);
		jQuery('#loan_ac').val(loan_ac);
		jQuery('#cif').val(cif);
		jQuery('#auction_status').val('');
		jQuery('#hold_return_row').hide();
		jQuery('#hold_return_reason').val('');
		if (operation=='details')
		{
			jQuery("#header_title").html('CMA Details');
			jQuery('#sendtochecker_row').hide();
			jQuery('#sts_row').hide();
			jQuery('#acknowledgement_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').show();
			jQuery('#auction_confirm_row').hide();
			jQuery('#vendor_notify_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#hold_row').hide();
		}
		else if (operation=='acknowledgement')
		{
			jQuery("#header_title").html('Acknowledgement Auction');
			jQuery('#sendtochecker_row').hide();
			jQuery('#acknowledgement_row').show();
			jQuery('#sts_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#auction_confirm_row').hide();
			jQuery('#vendor_notify_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#hold_row').hide();
		}
		else if (operation=='sendtochecker')
		{
			jQuery("#header_title").html('SendToChecker Auction');
			jQuery('#sendtochecker_row').show();
			jQuery('#acknowledgement_row').hide();
			jQuery('#sts_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#auction_confirm_row').hide();
			jQuery('#vendor_notify_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#hold_row').hide();
		}
		else if (operation=='auctionsts')
		{
			jQuery("#header_title").html('SendToChecker Auction');
			jQuery('#sendtochecker_row').hide();
			jQuery('#acknowledgement_row').hide();
			jQuery('#sts_row').show();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#comments').val('');
			jQuery('#auction_confirm_row').hide();
			jQuery('#vendor_notify_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#hold_row').hide();
		}
		else if (operation=='auctionconfirm')
		{
			jQuery("#header_title").html('Confirm Auction');
			jQuery('#sendtochecker_row').hide();
			jQuery('#acknowledgement_row').hide();
			jQuery('#sts_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#comments').val('');
			jQuery('#auction_confirm_row').show();
			jQuery('#vendor_notify_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#hold_row').hide();
		}
		else if (operation=='vendornotify')
		{
			jQuery("#header_title").html('Notify Vendor');
			jQuery('#sendtochecker_row').hide();
			jQuery('#acknowledgement_row').hide();
			jQuery('#sts_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#comments').val('');
			jQuery('#auction_confirm_row').hide();
			jQuery('#vendor_notify_row').show();
            jQuery('#closeaccount_row').hide();
            jQuery('#hold_row').hide();
		}
		else if (operation=='hold')
		{
			jQuery("#header_title").html('Hold Auction');
			jQuery('#sendtochecker_row').hide();
			jQuery('#acknowledgement_row').hide();
			jQuery('#sts_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#comments').val('');
			jQuery('#auction_confirm_row').hide();
			jQuery('#vendor_notify_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#hold_row').show();
		}
		else if (operation=='closeaccount')
		{
			jQuery("#header_title").html('Close/Settle Account');
			jQuery('#sendtochecker_row').hide();
			jQuery('#acknowledgement_row').hide();
			jQuery('#sts_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#comments').val('');
			jQuery('#auction_confirm_row').hide();
			jQuery('#vendor_notify_row').hide();
            jQuery('#closeaccount_row').show();
            jQuery('#hold_row').hide();
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
			url: "<?=base_url()?>cma_process/details",
			data : {[csrfName]: csrfHash,id: cma_id,operation:operation},
			datatype: "json",
			success: function(response){
			//alert(response);
				var json = jQuery.parseJSON(response);

				jQuery('.txt_csrfname').val(json.csrf_token);
					if(json.str)
					{
						var html = '';
			            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'auction_sign_memo\')"/>';
			            html+='<input type="hidden" id="hidden_auction_sign_memo_select" name="hidden_auction_sign_memo_select" value="0">';
			            html+='<span id="hidden_auction_sign_memo"></span><input type="hidden" id="memo_select_add_edit" name="memo_select_add_edit" value="add">';
			            jQuery('#auction_sign_memo').html(html);
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
				url: '<?=base_url()?>index.php/auction/delete_action/',
				data : postData,
				datatype: "json",
				success: function(response){
					var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
						var type= jQuery("#type").val();
						if (type=='sendtochecker')
						{
							jQuery("#sendtochecker").show();
							jQuery("#SendTocheckercancel").show();
							jQuery("#sendtochecker_loading").hide();
						}
						if (type=='acknowledgement' || type=='return_to_maker' || type=='hold_auction')
						{
							jQuery("#acknowledgement").show();
							jQuery("#return_button").show();
							jQuery("#hold_button").show();
							jQuery("#Acknowledgementcancel").show();
							jQuery("#acknowledgement_loading").hide();
						}
						if (type=='auctionsts')
						{
							jQuery("#auctionsts").show();
							jQuery("#auctionstscancel").show();
							jQuery("#auctionsts_loading").hide();
						}
						if (type=='auctionconfirm')
						{
							jQuery("#auctionconfirm").show();
							jQuery("#auctionconfirmcancel").show();
							jQuery("#auctionconfirm_loading").hide();
						}
						if (type=='vendornotify')
						{
							jQuery("#vendornotify").show();
							jQuery("#vendornotifycancel").show();
							jQuery("#vendornotify_loading").hide();
						}
						if (type=='hold')
						{
							jQuery("#hold").show();
							jQuery("#holdcancel").show();
							jQuery("#hold_loading").hide();
						}
						if (jQuery("#type").val()=='closeaccount')
                        {
                            jQuery("#closeaccount").show();
                            jQuery("#closeaccount_cancel").show();
                            jQuery("#closeaccount_loading").hide();
                        }

						if(json.Message!='OK')
						{
							alert(json.Message);
							return false;
						}else{
						var msz='';
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
	function vendor_notify(id){
		
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>auction/get_vendor_info",
			data : {[csrfName]: csrfHash,id: id},
			datatype: "json",
			success: function(response){
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
				
				jQuery('#vendor').html(json.str.vendor_name);
				jQuery('#paper_name').html(json.str.p_name);
				jQuery('#paper_date').html(json.str.paper_date);
				jQuery('#auction_date').html(json.str.auction_date);
				jQuery('#auction_time').html(json.str.auction_time);
				jQuery('#auction_address').html(json.str.auction_address);
				jQuery('#remarks').html(json.str.paper_remarks);
				jQuery('#email').val(json.str.email);
				jQuery('#auction_id').val(json.str.id);
				jQuery('#vendor_id').val(json.str.paper_vendor);
				jQuery('#paper_id').val(json.str.paper_name);
				jQuery('#vendor_name').val(json.str.vendor_name);
				document.getElementById("sendmail").style.visibility='visible';
				jQuery("#sendmail").jqxWindow('open');
					
			}
		});
	}
	function vendor_notify_send(){
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = jQuery('#sendmailform').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: '<?=base_url()?>index.php/auction/vendor_notify_send/',
			data : postData,
			datatype: "json",
			success: function(response){
				var json = jQuery.parseJSON(response);
				jQuery('.txt_csrfname').val(json.csrf_token);
				jQuery("#sendmailbtn").show();
                jQuery("#sendmailCancel").show();
                jQuery("#sendmailloading").hide();
				jQuery('#sendmail').jqxWindow('close');
                
			}
		});
	}
	var verifyMessageDialog='';
	function paper_notice(id,index,cma_id)
		{
			$('verifyMessageErrorMsg').style.display = 'none';
			$('verifyMessageDialogConfirm').style.display = '';
			$('verifyMessageDialogCancel').style.display = '';
			$('loadingVerify').style.display = 'none';

				$('verifyEventId').value = id;
				$('verifyIndexId').value = index;
				$('verify_cmaId').value = cma_id;
				$('conf_msg').innerHTML='Please choose a format.';
				$('verifyMessageDialogConfirm').style.display = '';
				$('verifyMessageDialogCancel').style.display = '';
				$('loadingVerify').style.display = 'none';
			verifyMessageDialog = new EOL.dialog($('verifyMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'verifyMessageDialog' });
			verifyMessageDialog.afterShow = function() {
				$$('#verifyMessageDialog #verifyMessageDialogConfirm').addEvent('click',open_ck_editor);
				$$('#verifyMessageDialog #verifyMessageDialogCancel').addEvent('click',function() {verifyMessageDialog.hide();});
			};

			verifyMessageDialog.show();
		}
	function open_ck_editor()
	{
		if (!jQuery("input[name='paper_notice']:checked").val() ) {
    		//alert('The checker to notify field is required!');
    		jQuery('#message_ck_editor').html("<span style='color:red;'>Field required</span>");
    		return false;
    	}
		var postdata_rs = jQuery('#verifyMessageform').serialize();
		//console.log(postdata_rs);
		verifyMessageDialog.hide();
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/auction/paper_notice?'+postdata_rs, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function paper_memo(val,cma_id)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>auction/auction_memo/'+val+'/'+cma_id, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function return_hold(type)
    {
        jQuery('#action_form').jqxValidator('hide');
        var  rules1= [ //Rules for return/reject
            { input: '#hold_return_reason', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#hold_return_reason").val()=='')
                {
                    jQuery("#hold_return_reason").focus();
                    return false;
                }
                else
                {
                    return true;
                }
            }
            },

            { input: '#hold_return_reason', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
             {
                if(input.val() != '')
                {
                    if(input.val().length>250)
                    {
                        jQuery("#hold_return_reason").focus();
                        return false;

                    }
                }
                return true;

            } },
        ];
        jQuery('#type').val(type);
        jQuery('#hold_return_row').show();
        jQuery('#action_form').jqxValidator({
                rules: rules1, theme: theme
        });
        var validationResult = function (isValid) {
            if (isValid) {
                jQuery("#acknowledgement").hide();
                jQuery("#return_button").hide();
                jQuery("#hold_button").hide();
                jQuery("#Acknowledgementcancel").hide();
                jQuery("#acknowledgement_loading").show();
                call_ajax_submit();
            }
        }
        jQuery('#action_form').jqxValidator('validate', validationResult);
    }
	</script>

  <div id="jqxgrid" style="margin: 10px auto;"></div>
	<div style="float:left;padding-top: 5px;padding-left:5px;">
  	<div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
	&nbsp;
    <strong>P = </strong> Preview,&nbsp;
    <strong>E = </strong> Edit,&nbsp;
    <strong>ACK = </strong> Acknowledgement,&nbsp;
    <strong>H = </strong> Hold,&nbsp;
    <strong>STC = </strong>Send To Auction checker,&nbsp;
    <strong>VA = </strong> Verify Auction,&nbsp;
    <strong>STL  = </strong>Send To Legal,&nbsp;
	<strong>PI = </strong>Paper Info,&nbsp;
	<strong>UB = </strong>Update Bidder Info,&nbsp;
	<strong>AS = </strong>Auction Status,&nbsp;
	<strong>PN = </strong>Paper Notice,&nbsp;
	<strong>AM = </strong>Auction Memo,&nbsp;
	<strong>AC = </strong>Auction Confirm,&nbsp;
	<strong>VN = </strong>Vendor Notify&nbsp;
    </div><br/>
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
			      	<input type="button" class="buttonsendtochecker" id="sendtochecker" value="Send" />
			      	<input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel" />
			    	<span id="sendtochecker_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
			    </div>
			    <div id="acknowledgement_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
			      	<table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                        <tr id="hold_return_row" style="display:none">
                            <td><strong>Return Reason<span style="color: red;">*</span></strong></td>
                            <td>
                                <textarea name="hold_return_reason" id="hold_return_reason" style="width:225px;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="buttonsendtochecker" id="acknowledgement" value="ACK" />
						      	<input type="button" class="buttondelete" id="return_button" value="Return" onclick="return_hold('return_to_maker')"/>
						      	<input type="button" class="buttonclose" id="Acknowledgementcancel" onclick="close()" value="Cancel" />
						    	<span id="acknowledgement_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                            </td>
                        </tr>
                    </table>
			    </div>
			    <div id="auction_confirm_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
			      	<table style="margin-left: 260px;margin-top: 0px;">
	                  <tr>
	                      <td>Sign Memo:<span style="color: red;">*</span></td>
	                      <td>
	                          <span id="auction_sign_memo"></span>
	                      </td>
	                  </tr>
	                  <tr>
	                      <td>Remarks :<span style="color: red;">*</span> </td>
	                      <td>
	                          <textarea name="complete_remarks" id="complete_remarks" style="width:370px;"></textarea>
	                      </td>
	                  </tr>
	                  <tr>
	                      <td colspan="2">
	                          <input type="button" class="buttonsendtochecker" id="auctionconfirm" value="Confirm" />
								<input type="button" class="buttonclose" id="auctionconfirmcancel" onclick="close()" value="Cancel" />
								<span id="auctionconfirm_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
	                      </td>
	                  </tr>
	              </table>
			    </div>
			    <div id="sts_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
				   Auction Status: <span style="color: red;">*</span>
			      	<select name="auction_status" id="auction_status">
			      			<option value="">Select auction Status</option>
	              		<?php $count = 0; ?>
					      		<?php foreach ($auc_sts as $key): ?>
					      			<?php $count++; ?>
					          		<option value="<?=$key->id?>" <?php if ($count == 1) echo "selected"; ?> ><?=$key->name?></option>
					      		<?php endforeach; ?>
	              	</select><br>
	              	<strong style="vertical-align:top">Auction Remarks<span style="color: red;">*</span></strong>
			     	<textarea name="comments" id="comments" style="width:370px;"></textarea>
			     	</br></br>
			      	<input type="button" class="buttonsendtochecker" id="auctionsts" value="Save" />
			      	<input type="button" class="buttonclose" id="auctionstscancel" onclick="close()" value="Cancel" />
			    	<span id="auctionsts_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
			    </div>
			    <div id="vendor_notify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
			      	<table style="margin-left: 260px;margin-top: 0px;">
	                  <tr>
	                      <td>Select Vendor:<span style="color: red;">*</span></td>
	                      <td>
	                          <div id="paper_vendor" name="paper_vendor" style="padding-left: 3px"></div>
	                      </td>
	                  </tr>
	                  <tr>
	                      <td>Email :<span style="color: red;">*</span> </td>
	                      <td>
	                          <input type="text" name="email" style="width: 210px;" id="email" placeholder="Enter Email">
							  <p style="font-size: 12px;margin-bottom: 0px;">Multiple Email separate by Comma(,)</p>
	                      </td>
	                  </tr>
	                  <tr>
	                      <td colspan="2">
	                        <input type="button" class="buttonsendtochecker" id="vendornotify" value="Send" />
							<input type="button" class="buttonclose" id="vendornotifycancel" onclick="close()" value="Cancel" />
							<span id="vendornotify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
	                      </td>
	                  </tr>
	              </table>
			    </div>
			    <div id="close_btn_row" style="text-align:center;margin-bottom:30px;width:100%;">
			    	<input type="button" align="center" class="button1" id="codeOK" value="Close" />
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
                <div id="hold_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: 300px;margin-top: 0px;">
                            <tr>
                                <td>Hold Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="hold_reason" id="hold_reason" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttondelete" id="hold" value="Hold" />
                                    <input type="button" class="buttonclose" id="holdcancel" onclick="close()" value="Cancel" />
                                    <span id="hold_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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

<div id="sendToCheckerMessageDialogContent"  style="display:none">
      <div class=""><h2 class="conf" style="margin-top:0px">Select copy to <span id="message"></span></h2></div>
      <form method="POST" target="_blank" name="download_form" id="download_form"  style="margin:0px;" method="POST" action="<?=base_url()?>index.php/auction/download" enctype="multipart/form-data">
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



<div id="verifyMessageDialogContent"  style="display:none">
          <div class="hd"><h3 class="conf" id="conf_msg"></h3></div>
          <form method="POST" name="verifyMessageform" id="verifyMessageform"  style="margin:0px;">
            <input name="verifyEventId" id="verifyEventId" value="" type="hidden">
         	<input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
            <input name="verify_cmaId" id="verify_cmaId" value="" type="hidden">
          	<div class="bd">
              <div class="inlineError" id="verifyMessageErrorMsg" style="display:none">Remarks Required</div>
            </div>
            <div id="not_for_unlock" style="margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
  			<table>
  				<tr>
  					<td></td>
  					<td><div id="message_ck_editor" style="_height:25px;"></div></td>
  				</tr>
  				<tr>
  					<td><input type="radio" name="paper_notice" id="paper_notice" value="12_3"> </td>
  					<td><label for="paper_notice">&nbsp; 12(3)-Auction Notice</label></td>
  				</tr>
  				<tr>
  					<td><input type="radio" name="paper_notice" id="paper_notice4" value="12_5"> </td>
  					<td><label for="paper_notice4">&nbsp; 12(5)-Auction Notice</label></td>
  				</tr>
  				<tr>
  					<td><input type="radio" name="paper_notice" id="paper_notice2" value="33_5"> </td>
  					<td><label for="paper_notice2">&nbsp; 33(5)- Auction Notice</label></td>
  				</tr>
  				<tr>
  					<td><input type="radio" name="paper_notice" id="paper_notice3" value="33_7"> </td>
  					<td><label for="paper_notice3">&nbsp; 33(7)-Auction Notice</label></td>
  				</tr>
  			</table>

          </div>
          <br>
            <a class="btn-small btn-small-normal" id="verifyMessageDialogConfirm"><span>Go</span></a>
            <a class="btn-small btn-small-secondary" id="verifyMessageDialogCancel"><span>Cancel</span></a>
            <span id="loadingVerify" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
            </form>
</div>

<div id="sendmail"  style="visibility:hidden;">
	<div><strong><label id="header_title">Paper Info</label></strong></div>
	<form method="POST" name="sendmailform" id="sendmailform"  style="margin:0px;">
	<input name="auction_id" id="auction_id" value="" type="hidden">
	<input name="vendor_id" id="vendor_id" value="" type="hidden">
	<input name="paper_id" id="paper_id" value="" type="hidden">
	<input name="vendor_name" id="vendor_name" value="" type="hidden">
		<div class="bd">
	  <div class="inlineError" id="sendmailMessageErrorMsg" style="display:none">Remarks Required</div>
	</div>
	<div id="not_for_unlock" style="margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
		<table border="1" style="width: 100%;">
			<tr>
				<td> Paper Vendor</td>
				<td id="vendor"></td>
			</tr>
			<tr>
				<td> Paper Name</td>
				<td id="paper_name"></td>
			</tr>
			<tr>
				<td> Paper Date</td>
				<td id="paper_date"></td>
			</tr>
			<tr>
				<td> Auction Date</td>
				<td id="auction_date"></td>
			</tr>
			<tr>
				<td> Auction Time</td>
				<td id="auction_time"></td>
			</tr>
			<tr>
				<td> Auction Address</td>
				<td id="auction_address"></td>
			</tr>
			<tr>
				<td> Remarks</td>
				<td id="remarks"></td>
			</tr>

		</table>
		<table style="margin-top: 5px;">
			<tr>
				<td style="width: 20%;">Email:</td>
				<td>
					<input type="text" name="email" style="width: 300px;" id="email" placeholder="Enter Email">
					<p style="font-size: 12px;margin-bottom: 0px;">Multiple Email separate by Comma(,)</p>
				</td>
			</tr>
		</table>
		
	</div>
	<div style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
		<input type="button" class="buttonsendtochecker" id="sendmailbtn" value="Send" />
	  	<input type="button" class="buttonclose" id="sendmailCancel" onclick="close()" value="Cancel" />
		<span id="sendmailloading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
	</div>
	</form>
</div> 