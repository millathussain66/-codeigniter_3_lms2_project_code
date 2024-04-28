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
			if (jQuery('#auction_status').val() == '' || jQuery('#auction_status').val() == 0 || jQuery('#auction_status').val() == null || jQuery('#auction_status').val() == 'undefined') {
	    		alert('Auction Status required!');
	    		jQuery('#auction_status').focus();
	    		return;
	    	}
	    	else
	    	{
	    		jQuery("#sendtochecker").hide();
				jQuery("#SendTocheckercancel").hide();
				jQuery("#sendtochecker_loading").show();
	    		call_ajax_submit();
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
					{ name: 'checker_id', type: 'int'},
					{ name: 'status', type: 'string'},
					{ name: 'loan_ac', type: 'int'},
					{ name: 'cif', type: 'string'},
					{ name: 'cma_sts', type: 'int'},
					{ name: 'ack_by', type: 'int'},
					{ name: 'memo_h_by', type: 'int'},
					{ name: 'paper_h_by', type: 'int'},
					{ name: 'region_name', type: 'string'},
					{ name: 'territory_name', type: 'string'},
					{ name: 'district_name', type: 'string'},
					{ name: 'unit_office_name', type: 'string'},
					{ name: 'ac_name', type: 'string'},
					{ name: 'req_type', type: 'string'},
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
			  	url: '<?=base_url()?>index.php/suit_filling_legal/grid',
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
						{ text: 'CMA Id', datafield: 'cma_id', hidden:true,  editable: false,  width: '4%' },
					  	{ text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
				  			cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'details\','+editrow+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

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
						{ text: 'Requisition', datafield: 'req_type',editable: false, width: '8%', align:'left',cellsalign:'left'},
					  	{ text: 'Region', datafield: 'region_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'Territory', datafield: 'territory_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'District', datafield: 'district_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'Unit Office', datafield: 'unit_office_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
						 ]
            });
			jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#deletecancel") });
			jQuery("#r_history").jqxWindow({ theme: theme,  width: '60%', height:'50%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });

  	});
	function verify(val,indx,cma_id)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/suit_filling_legal/paper_notice_verify/'+val+'/'+indx+'/'+cma_id, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function memoprepare(val,indx,cma_id)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/suit_filling_legal/prepare_memo/'+val+'/'+indx+'/'+cma_id, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function updatebidder(val,indx,cma_id)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/suit_filling_legal/update_bidder/'+val+'/'+indx+'/'+cma_id, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function memoverify(val,indx,cma_id)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/suit_filling_legal/memo_verify/'+val+'/'+indx+'/'+cma_id, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function editt(val,indx,cma_id)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>suit_filling_legal/from/edit/'+val+'/'+cma_id+'/'+indx, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function details(id,operation,indx,cma_id,loan_ac)
	{
		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery('#verifyIndexId').val(indx);
		jQuery('#cma_id').val(cma_id);
		jQuery('#loan_ac').val(loan_ac);
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
		if(csrf_tokens=='')
		{
				csrf_tokens='<?php echo $this->security->get_csrf_hash(); ?>';
		}
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>suit_filling_legal/details",
			data : {'<?php echo $this->security->get_csrf_token_name(); ?>':csrf_tokens,id: id},
			datatype: "json",
			success: function(response){
			//alert(response);
				var json = jQuery.parseJSON(response);

				if(json.csrf_token=csrf_tokens){
						csrf_tokens=json.csrf_token;

					}else{
						window.location.replace('<?=base_url()?>index.php/home/logout');
					}
					if(json.details)
					{
						document.getElementById("details").style.visibility='visible';
						jQuery("#sa_d").html('');
						jQuery("#sl_no_d").html(json.details.sl_no);
						var myArr = json.details.summon_address.split(",");
						var counter = myArr.length-1;
						for (var i = 0; i <myArr.length; i++) {
							if (myArr[i]==1){jQuery("#sa_d").append('"Permanent Address"');}
							else if(myArr[i]==2){jQuery("#sa_d").append('"Present Address"');}
							else if(myArr[i]==3){jQuery("#sa_d").append('"Business Address"');}
							else if(myArr[i]==4){jQuery("#sa_d").append('"Current/Updated Address"');}
							if (i!=counter) {jQuery("#sa_d").append(',')}
						}
						
						jQuery("#region_d").html(json.details.region_name);
						jQuery("#territory_d").html(json.details.territory_name);
						jQuery("#district_d").html(json.details.district_name);
						jQuery("#unit_office_d").html(json.details.unit_office_name);
						jQuery("#req_type_d").html(json.details.req_type);
						jQuery("#proposed_type_d").html(json.details.proposed_type);
						if (json.details.proposed_type=='Loan') {jQuery("#l_or_c_no").html('Loan A/C ');}
						else if(json.details.proposed_type=='Card'){jQuery("#l_or_c_no").html('Card');}
						jQuery("#loan_ac_d").html(json.details.loan_ac);
						jQuery("#cif_d").html(json.details.cif);
						jQuery("#more_acc_d").html(json.details.more_acc_number);
						jQuery("#branch_sol_d").html(json.details.branch_sol);
						jQuery("#busi_type_d").html(json.details.subject_name);
						jQuery("#remarks_d").html(json.details.remarks);
						if (json.details.proposed_type=='Loan') {jQuery("#l_or_c_name").html('Loan A/C Name');jQuery("#l_or_c_no").html('Loan A/C ');}
						else if(json.details.proposed_type=='Card'){jQuery("#l_or_c_name").html('Name on Card');jQuery("#l_or_c_no").html('Card');}
						jQuery("#ac_name_d").html(json.details.ac_name);
						jQuery("#e_by_d").html(json.details.e_by);
						jQuery("#e_dt_d").html(json.details.e_dt);
						jQuery("#stc_by_d").html(json.details.stc_by);
						jQuery("#stc_dt_d").html(json.details.stc_dt);
						if (json.details.sts==3)
						{
							jQuery("#oprs_by").html('Recommended');
							jQuery("#oprs_dt").html('Recommended');
							jQuery("#rec_by_d").html(json.details.rec_by);
							jQuery("#rec_dt_d").html(json.details.rec_dt);
						}
						else if(json.details.sts==4)
						{
							jQuery("#oprs_by").html('Return');
							jQuery("#oprs_dt").html('Return');
							jQuery("#rec_by_d").html(json.details.r_by);
							jQuery("#rec_dt_d").html(json.details.r_dt);
						}
						else if(json.details.sts==5)
						{
							jQuery("#oprs_by").html('Rejected');
							jQuery("#oprs_dt").html('Rejected');
							jQuery("#rec_by_d").html(json.details.reject_by_rm);
							jQuery("#rec_dt_d").html(json.details.reject_dt_rm);
						}
						else if(json.details.sts==6)
						{
							jQuery("#oprs_by").html('Acknowledgement');
							jQuery("#oprs_dt").html('Acknowledgement');
							jQuery("#rec_by_d").html(json.details.ack_by);
							jQuery("#rec_dt_d").html(json.details.ack_dt);
						}
						else if(json.details.sts==7)
						{
							jQuery("#oprs_by").html('Hold');
							jQuery("#oprs_dt").html('Hold');
							jQuery("#rec_by_d").html(json.details.hold_by);
							jQuery("#rec_dt_d").html(json.details.hold_dt);
						}
						else if(json.details.sts==8)
						{
							jQuery("#oprs_by").html('Send Query');
							jQuery("#oprs_dt").html('Send Query');
							jQuery("#rec_by_d").html(json.details.q_by);
							jQuery("#rec_dt_d").html(json.details.q_dt);
						}
						else if(json.details.sts==9)
						{
							jQuery("#oprs_by").html('Return By HO Maker');
							jQuery("#oprs_dt").html('Return By HO Maker');
							jQuery("#rec_by_d").html(json.details.ho_r_by);
							jQuery("#rec_dt_d").html(json.details.ho_r_dt);
						}
						else if(json.details.sts==10 || json.details.sts==24 || json.details.sts==33)
						{
							jQuery("#oprs_by").html('Send To HO Checker');
							jQuery("#oprs_dt").html('Send To HO Checker');
							jQuery("#rec_by_d").html(json.details.sth_by);
							jQuery("#rec_dt_d").html(json.details.sth_dt);
						}
						else if(json.details.sts==11)
						{
							jQuery("#oprs_by").html('Return By HO Checker');
							jQuery("#oprs_dt").html('Return By HO Checker');
							jQuery("#rec_by_d").html(json.details.holm_r_by);
							jQuery("#rec_dt_d").html(json.details.holm_r_dt);
						}
						else if(json.details.sts==12)
						{
							jQuery("#oprs_by").html('Rejected By HO Checker');
							jQuery("#oprs_dt").html('Rejected By HO Checker');
							jQuery("#rec_by_d").html(json.details.ho_decline_by);
							jQuery("#rec_dt_d").html(json.details.ho_decline_dt);
						}
						else if(json.details.sts==13)
						{
							jQuery("#oprs_by").html('Approved By HO Checker');
							jQuery("#oprs_dt").html('Approved By HO Checker');
							jQuery("#rec_by_d").html(json.details.v_by);
							jQuery("#rec_dt_d").html(json.details.v_dt);
						}
						jQuery("#pre_add_d").html(json.details.present_address);
						jQuery("#per_add_d").html(json.details.parmanent_address);
						jQuery("#busi_add_d").html(json.details.business_address);
						jQuery("#cur_add_d").html(json.details.current_address);
						jQuery("#loan_seg_d").html(json.details.loan_segment);
						jQuery("#sts_d").html(json.details.auction_sts);
						if (json.details.sub_type==3) {
							jQuery("#father_name_d").html(json.details.father_name);
							jQuery("#mother_name_d").html(json.details.mother_name);
							if(json.details.spouse_name!='')
							{
								jQuery("#spouse_name_d").html(json.details.spouse_name);
							}
							else{jQuery("#spouse_name_d").html('N/A');}
							
						}
						else{jQuery("#father_name_d").html('N/A');
							jQuery("#mother_name_d").html('N/A');
							jQuery("#spouse_name_d").html('N/A');}
						if(json.details.return_by_rm!=null)
						{
							jQuery("#r_by").html(json.details.r_by);
						}
						else{jQuery("#r_by").html('');}
						if(json.details.return_by_rm!=null)
						{
							jQuery("#r_dt").html(json.details.r_dt);
						}
						else{jQuery("#r_dt").html('');}
						var html='';
						jQuery("#guarantor_info").html('');
						var counter=1;
						jQuery.each(json['guarantor_info'],function(key,obj){
							html+='<tr>';
								html+='<td align="center">'+obj.type_name+'</td>';
								html+='<td align="center">'+obj.guarantor_name+'</td>';
								html+='<td align="center">'+obj.father_name+'</td>';
								html+='<td align="center">'+obj.address+'</td>';
								html+='<td align="center">'+obj.guar_sts_name+'</td>';
								html+='<td align="center">'+obj.occ_sts_name+'</td>';
							html+='</tr>';
							counter++;
						});
						jQuery("#guarantor_info").html(html);
						jQuery('#loading_preview').show();
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
		var postData = jQuery('#action_form').serialize();
		if(csrf_token==''){
			csrf_token='<?php echo $this->security->get_csrf_hash(); ?>';
			
		}
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: '<?=base_url()?>index.php/suit_filling_legal/delete_action/',
				data : postData,
				datatype: "json",
				success: function(response){
					var json = jQuery.parseJSON(response);
					if(json.csrf_token=csrf_token){
							csrf_token=json.csrf_token;
							
						}else{
							window.location.replace('<?=base_url()?>index.php/home/logout');
						}
						if(json.Message!='OK')
						{								
							jQuery("#sendtochecker").show();
							jQuery("#SendTocheckercancel").show();
							jQuery("#sendtochecker_loading").hide();
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
		if(csrf_tokens=='')
		{
				csrf_tokens='<?php echo $this->security->get_csrf_hash(); ?>';
		}
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>suit_filling_legal/r_history",
			data : {'<?php echo $this->security->get_csrf_token_name(); ?>':csrf_tokens,id: id,life_cycle:life_cycle},
			datatype: "json",
			success: function(response){
			//alert(response);
				var json = jQuery.parseJSON(response);

				if(json.csrf_token=csrf_tokens){
						csrf_tokens=json.csrf_token;

					}else{
						window.location.replace('<?=base_url()?>index.php/home/logout');
					}
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
	
	</script>

  <div id="jqxgrid" style="margin: 10px auto;"></div>
	<div style="float:left;padding-top: 5px;padding-left:5px;">
  	<div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
	&nbsp;
    <strong>D = </strong> Delete,&nbsp;
    <strong>P = </strong> Preview,&nbsp;
    <strong>E = </strong> Edit,&nbsp;
    <strong>ACK = </strong> Acknowledge by HO,&nbsp;
    <strong>VP = </strong> Verify Paper Notice,&nbsp;
    <strong>MP = </strong> Prepare Memo,&nbsp;
    <strong>VM = </strong> Verify Memo,&nbsp;
    <strong>UB = </strong> Update Bidder,&nbsp;
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
    		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<div id="loading_preview" style="text-align:center">
				<span id="loading_p" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
			</div>
			<div style="" id="details_table">
				<table style="width: 100%;" id="preview_table">
					<tbody>
						<tr>
							<td width="50%" align="left"><strong>SL No.:</strong> <label name="sl_no_d" id="sl_no_d"></label></td>
							<td width="50%" align="left"><strong>Current/Updated Address:</strong> <label name="cur_add_d" id="cur_add_d"></label></td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Requisition Type:</strong> <label name="req_type_d" id="req_type_d"></label></td>
							<td width="50%" align="left"><strong>Summon Send To:</strong> <label name="sa_d" id="sa_d"></label></td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Proposed Type:</strong> <label name="proposed_type_d" id="proposed_type_d"></label></td>
							<td width="50%" align="left"><strong>Region:</strong> <label name="region_d" id="region_d"></label></td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong><span id="l_or_c_no"></span> No.:</strong> <label name="loan_ac_d" id="loan_ac_d"></label></td>
							<td width="50%" align="left"><strong>Territory:</strong> <label name="territory_d" id="territory_d"></label></td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>CIF:</strong> <label name="cif_d" id="cif_d"></label></td>
							<td width="50%" align="left"><strong>District:</strong> <label name="district_d" id="district_d"></label></td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Branch SOL:</strong> <label name="branch_sol_d" id="branch_sol_d"></label></td>
							<td width="50%" align="left"><strong>Unit Office:</strong> <label name="unit_office_d" id="unit_office_d"></label></td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong><span id="l_or_c_name"></span>:</strong> <label name="ac_name_d" id="ac_name_d"></label></td>
							<td width="50%" align="left"><strong>More A/C No.:</strong> <label name="more_acc_d" id="more_acc_d"></label></td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Business Type:</strong> <label name="busi_type_d" id="busi_type_d"></label></td>
							<td width="50%" align="left"><strong>Remarks:</strong> <label name="remarks_d" id="remarks_d"></label></td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Spouse Name :</strong> <label name="spouse_name_d" id="spouse_name_d"></label></td>
							<td width="50%" align="left"><strong>Initiate By:</strong> <label name="e_by_d" id="e_by_d"></label></td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Father Name :</strong> <label name="father_name_d" id="father_name_d"></label></td>
							<td width="50%" align="left"><strong>Initiate Date Time:</strong> <label name="e_dt_d" id="e_dt_d"></label></td>

							
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Mother Name :</strong> <label name="mother_name_d" id="mother_name_d"></label></td>
							<td width="50%" align="left"><strong>STC By:</strong> <label name="stc_by_d" id="stc_by_d"></label></td>

						</tr>
						<tr>
							<td width="50%" align="left"><strong>Loan Segment (Portfolio) :</strong> <label name="loan_seg_d" id="loan_seg_d"></label></td>
							<td width="50%" align="left"><strong>STC Date Time:</strong> <label name="stc_dt_d" id="stc_dt_d"></label></td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Permanent Address:</strong> <label name="per_add_d" id="per_add_d"></label></td>
							<td width="50%" align="left"><strong>Status:</strong> <label name="sts_d" id="sts_d"></label></td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Present Address:</strong> <label name="pre_add_d" id="pre_add_d"></label></td>
							<td width="50%" align="left"><strong><span id="oprs_by"></span> By:</strong> <label name="rec_by_d" id="rec_by_d"></label></td>
						</tr>
						<tr>
							<td width="50%" align="left"><strong>Business Address:</strong> <label name="busi_add_d" id="busi_add_d"></label></td>
							<td width="50%" align="left"><strong><span id="oprs_dt"></span> Date Time:</strong> <label name="rec_dt_d" id="rec_dt_d"></label></td>
						</tr>
					</tbody>
				</table><br/>
				<div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
					<span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Guarantor/Company/Director/Owner</span>
					<table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
					<thead>
						<tr>
							<td width="20%" style="font-weight: bold;text-align:center">Type</td>
							<td width="15%" style="font-weight: bold;text-align:center">Name</td>
							<td width="15%" style="font-weight: bold;text-align:center">Father Name</td>
							<td width="20%" style="font-weight: bold;text-align:center">Summon Address</td>
							<td width="15%" style="font-weight: bold;text-align:center">Status</td>
							<td width="15%" style="font-weight: bold;text-align:center">Occupation</td>
						</tr>
					</thead>
					<tbody id="guarantor_info">
						
					</tbody>
					</table>
				</div>
				<br>
				<div id="sendtochecker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
			      	Auction Status: <span style="color: red;">*</span> 
			      	<select name="auction_status" id="auction_status">
	              		<option value="">Select a Status</option>
	              		<option value="1">Auction Completed</option>
	              		<option value="2">Auction Not Yet Completed</option>
	              		<option value="3">Disputed Property</option>
	              	</select><br>
			      	<input type="button" class="buttonsendtochecker" id="sendtochecker" value="ACK" />
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

