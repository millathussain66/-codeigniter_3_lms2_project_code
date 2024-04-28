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

	.errormsg
	{
	    background-color: red !important;
	    color:white;
	}
	.successmsg
	{
	    background-color: green !important;
	    color:white;
	}
	</style>
<?
$region = $this->user_model->get_parameter_data('ref_region','name',"data_status = '1'");
$territory = array();
//$unit_office = $this->user_model->get_parameter_data('ref_unit_office','name',"data_status = '1'");
$district = $this->user_model->get_parameter_data('ref_district','name',"data_status = '1'");
$status = $this->user_model->get_parameter_data('ref_status','name',"data_status = '1' AND (module_name='f_legal_notice' or module_name='cma') AND id<>14");
$loan_segment = $this->user_model->get_parameter_data('ref_loan_segment','name',"data_status = '1'");
$cl_bbl = $this->user_model->get_parameter_data('ref_cl','name',"data_status = '1'");
$sorting = array(array('value' => 'b.region','name'=>'Region'),array('value' => 'b.territory','name'=>'Territory'),array('value' => 'b.district','name'=>'District'));
$ordering = array(array('value' => 'ASC','name'=>'ASC'),array('value' => 'DESC','name'=>'DESC'));
?>
<div id="container">
	<div id="body"  >
    <!--Customization Start-->
	<script type="text/javascript">
		var csrf_tokens='';
    var idd = 0; var indxx = 0;
    var proposed_type = ["Loan", "Card"];
	   jQuery(document).ready(function($) {
	   	jQuery('#region').bind('change', function (event) {
			change_dropdown('region');		
		});
	  //  	jQuery('#territory').bind('change', function (event) {
			// 	change_dropdown('territory');		
			// });
	  //  	jQuery('#district').bind('change', function (event) {
			// 	change_dropdown('district');		
			// });
	      // prepare the data
	       //var theme = 'energyblue';
            var theme = 'classic';
            jQuery("#sendtochecker").click(function () {
				jQuery("#sendtochecker").hide();
				jQuery("#SendTocheckercancel").hide();
				jQuery("#sendtochecker_loading").show();
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
            jQuery("#sendtohoops").click(function () {
            	if (jQuery('#checker_to_notify').val() == '' || jQuery('#checker_to_notify').val() == 0 || jQuery('#checker_to_notify').val() == null || jQuery('#checker_to_notify').val() == 'undefined') {
		    		alert('The Hoops checker is required!');
		    		jQuery('#checker_to_notify').focus();
		    		return;
		    	}
		    	else
		    	{
					jQuery("#sendtohoops").hide();
					jQuery("#sendtohoopscancel").hide();
					jQuery("#sendtohoops_loading").show();
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
					{ name: 'sts', type: 'string'},
					{ name: 'sl_no', type: 'string'},
					{ name: 'loan_ac', type: 'string'},
					{ name: 'cif', type: 'string'},
					{ name: 'branch_sol', type: 'string'},
					{ name: 'ac_name', type: 'string'},
					{ name: 'status', type: 'string'},
					{ name: 'request_type_name', type: 'string'},
					{ name: 'return_reason_rm', type: 'string'},
					{ name: 'reject_reason_rm', type: 'string'},
					{ name: 'ho_return_reason', type: 'string'},
					{ name: 'ho_decline_reason', type: 'string'},
					{ name: 'holm_r_reason', type: 'string'},
					{ name: 'region_name', type: 'string'},
					{ name: 'territory_name', type: 'string'},
					{ name: 'district_name', type: 'string'},
					{ name: 'case_file_district', type: 'string'},
					{ name: 'unit_office_name', type: 'string'},
					{ name: 'cma_sts', type: 'int'},
					{ name: 'proposed_type', type: 'string'},
					{ name: 'loan_segment', type: 'string'},
					{ name: 'sec_sts', type: 'int'},
					{ name: 'ack_by', type: 'int'},
					{ name: 'other_ac', type: 'string'},
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
					{ name: 'return_reason', type: 'string'},
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
			  	url: '<?=base_url()?>index.php/cma_ho/grid',
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
						var territory = jQuery.trim(jQuery('input[name=territory]').val());
						var district = jQuery.trim(jQuery('#district').val());
						// var unit_office = jQuery.trim(jQuery('#unit_office').val());
						var region = jQuery.trim(jQuery('#region').val());
						var rec_dt_from = jQuery.trim(jQuery('#rec_dt_from').val());
						var rec_dt_to = jQuery.trim(jQuery('#rec_dt_to').val());
						var status = jQuery.trim(jQuery('#status').val());
						var ack_dt_from = jQuery.trim(jQuery('#ack_dt_from').val());
						var ack_dt_to = jQuery.trim(jQuery('#ack_dt_to').val());
						var v_dt_from = jQuery.trim(jQuery('#v_dt_from').val());
						var v_dt_to = jQuery.trim(jQuery('#v_dt_to').val());
						var loan_segment = jQuery.trim(jQuery('#loan_segment').val());
						var cl_bbl = jQuery.trim(jQuery('#cl_bbl').val());
						var outst_range = jQuery.trim(jQuery('#outst_range').val());
						var loan_ac_grid = jQuery.trim(jQuery('#loan_ac_grid').val());
						var hidden_loan_ac_grid = jQuery.trim(jQuery('#hidden_loan_ac_grid').val());
						var proposed_type_grid = jQuery.trim(jQuery('#proposed_type_grid').val());
						// alert(status);
						// return;
						// unit_office : unit_office,
	                    jQuery.extend(data, {
	                        territory : territory,
	                        district : district,
	                        region : region,
	                        loan_ac_grid : loan_ac_grid,
	                        hidden_loan_ac_grid : hidden_loan_ac_grid,
	                        proposed_type_grid : proposed_type_grid,
	                        rec_dt_from : rec_dt_from,
	                        rec_dt_to : rec_dt_to,
	                        status : status,
	                        ack_dt_from : ack_dt_from,
	                        ack_dt_to : ack_dt_to,
	                        v_dt_from : v_dt_from,
	                        v_dt_to : v_dt_to,
	                        loan_segment : loan_segment,
	                        outst_range : outst_range,
	                        cl_bbl : cl_bbl,

	                    });
	                    return data;
	                }
				}
			);
			var cellclassname = function (row, columnfield, value, rowdata) 
			{
			    var editrow = row;
				var dataRecord = jQuery("#jqxgrid").jqxGrid("getrowdata", editrow);

				if(dataRecord.return_reason!="" && (dataRecord.cma_sts==11 || dataRecord.cma_sts==12))
				{
			       return "errormsg";
			    }
			    else if(dataRecord.return_reason!="" && (dataRecord.cma_sts==3 || dataRecord.cma_sts==10))
				{
			       return "successmsg";
			    }
			};
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
            var win_h=jQuery( window ).height()-300;
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
						{ text: 'Id', datafield: 'id',cellclassname:cellclassname,hidden:true,  editable: false,  width: '4%' },
						{ text: 'CMA STS', datafield: 'cma_sts',cellclassname:cellclassname,hidden:true,  editable: false,  width: '4%' },
						{ text: 'Reason', datafield: 'return_reason',cellclassname:cellclassname,hidden:true,  editable: false,  width: '4%' },
 						<? if(DELETE==1){?>
					  	{ text: 'D', menu: false, datafield: 'delete',cellclassname:cellclassname, align:'center', editable: false, sortable: false, width: '2%',
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'delete\','+editrow+')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';

							}
						  },
						<?php } ?>
 						<? if(ACKOWLEDGMENTREQUEST==1){?>
						  { text: 'ACK', datafield: 'AcknowledgementRequest',cellclassname:cellclassname, editable: false,align:'center', sortable: false, menu: false, width: 35,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if(dataRecord.cma_sts == 3 || dataRecord.cma_sts == 33){
									if (dataRecord.proposed_type=='Loan')
									{
									var type=1;
									}else{var type=2}
									return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'acknowledgement\','+editrow+','+dataRecord.cif+','+type+','+dataRecord.sec_sts+')" ><img align="center" src="<?=base_url()?>images/favorites.png"></div>';
							 	}
							 	else {
		                      			return '<div style=" margin-top: 7px;text-align:center">ACK</div>';
		                      	}
	                      	}
		                  },
						<? }?>
						<? if(EDIT==1){?>
						  { text: 'E', datafield: 'Edit',cellclassname:cellclassname, editable: false,align:'center', sortable: false, menu: false, width: 45,
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								//(<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && 
								if(dataRecord.cma_sts!=64 && dataRecord.cma_sts!=65 && dataRecord.cma_sts!=75)
								{
									if (dataRecord.proposed_type=='Loan')
									{
									var type=1;
									}else{var type=2;}
									return '<div style="text-align:center;margin-top: 2px; cursor:pointer" onclick="editt('+dataRecord.id+','+editrow+','+type+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
							 	}
							 	else if(<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by && dataRecord.cma_sts == 10)
							 	{
							 		return '<div style=" margin-top: 7px;text-align:center">E</div>';
							 	}
							 	else {
		                      		return '<div style=" margin-top: 7px; text-align:center"></div>';
		                      	}
	                      	}
		                  },
					  <? }?>
					  <? if(SENDTOCHECKER==1){?>
					  { text: 'STA', datafield: 'sendtochecker',cellclassname:cellclassname, editable: false,align:'center', sortable: false, menu: false, width: 45,
                      	cellsrenderer: function(row) {
                      		editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.cma_sts == 6 || dataRecord.cma_sts == 11 || dataRecord.cma_sts == 7 || dataRecord.cma_sts == 8)){
								if (dataRecord.proposed_type=='Loan')
								{
								var type=1;
								}else{var type=2}
								return '<div style="text-align:center;margin-top: 2px; cursor:pointer" onclick="check('+dataRecord.id+','+editrow+','+type+','+dataRecord.sec_sts+')" ><img align="center" src="<?=base_url()?>images/check_img.jpg"></div>';
						 	}
						 	else if(<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.ack_by && dataRecord.cma == 10)
						 	{
						 		return '<div style=" margin-top: 7px;text-align:center">STA</div>';
						 	}
						 	else {
	                      			return '<div style=" margin-top: 7px; text-align:center"></div>';
	                      	}
                      	}
	                  },
					  <? }?>
					  <? if(VERIFY==1){?>
					  { text: 'APV', datafield: 'verify',cellclassname:cellclassname, editable: false,align:'center', sortable: false, menu: false, width: 40,
                      	cellsrenderer: function(row) {
                      		editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.holm_checker_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') &&dataRecord.cma_sts == 10){
								if (dataRecord.proposed_type=='Loan')
								{
								var type=1;
								}else{var type=2}
								return '<div style="text-align:center;margin-top: 3px; cursor:pointer" onclick="verify('+dataRecord.id+','+editrow+','+type+')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
						 	}
						 	else if(dataRecord.cma_sts == 13)
						 	{
						 		return '<div style=" margin-top: 7px; text-align:center">APV</div>';
						 	}
						 	else {
	                      			return '<div style=" margin-top: 7px;text-align:center"></div>';
	                      	}
                      	}
	                  },
					  <? }?>
					  <? if(SENDTOHOOPS==1){?>
					  { text: 'STHO', datafield: 'sendtohoops',cellclassname:cellclassname, editable: false,align:'center', sortable: false, menu: false, width: 45,
                      	cellsrenderer: function(row) {
                      		editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if((check_group_javascript(10) || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.cma_sts == 13 || dataRecord.cma_sts==59 || dataRecord.cma_sts==104)){
								if (dataRecord.proposed_type=='Loan')
								{
								var type=1;
								}else{var type=2}
								return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'sendtohoops\','+editrow+','+dataRecord.cif+','+type+','+dataRecord.sec_sts+')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
						 	}
						 	else {
	                      			return '<div style=" margin-top: 7px;text-align:center"></div>';
	                      	}
                      	}
	                  },
					  <? }?>
					  	{ text: 'P', menu: false, datafield: 'Preview',cellclassname:cellclassname, align:'center', editable: false, sortable: false, width: '2%',
				  			cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						 	return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details('+dataRecord.id+',\'details\','+editrow+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

							  }
					  	},
					  	{ text: 'Status', datafield: 'status',cellclassname:cellclassname,editable: false, width: '17%', align:'left',cellsalign:'left'},
					  	{ text: 'Serial', datafield: 'sl_no',cellclassname:cellclassname,editable: false, width: '5%', align:'left',cellsalign:'left'},
					  	{ text: 'Protfolio', datafield: 'loan_segment',cellclassname:cellclassname,editable: false, width: '8%', align:'left',cellsalign:'left'},
					  	{ text: 'Requisition', datafield: 'request_type_name',cellclassname:cellclassname,editable: false, width: '8%', align:'left',cellsalign:'left'},
					  	{ text: 'Reject/Return Reason', datafield: 'ho_return_reason',cellclassname:cellclassname, editable: false,align:'left',cellsalign:'left', sortable: false, menu: false, width: '15%',
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								var reason_text = '';
								if((dataRecord.ho_decline_reason!=null || dataRecord.holm_r_reason!=null) && (dataRecord.cma_sts==3 || dataRecord.cma_sts==11 || dataRecord.cma_sts==12))
								{
									if (dataRecord.ho_decline_reason!=null) 
									{
										reason_text+='('+dataRecord.ho_decline_reason+')';
									}
									if (dataRecord.holm_r_reason!=null) 
									{
										reason_text+='('+dataRecord.holm_r_reason+')';
									}
								}
								return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+')"><span>'+reason_text+'</span></a></div>';
		                      	
	                      	}
		                  },
					  	{ text: 'Loan A/C or Card No.', datafield: 'loan_ac',cellclassname:cellclassname, editable: false,align:'center',cellsalign:'center', sortable: true, menu: true, width: '11%',
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
	                      		var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\')"><span>'+dataRecord.loan_ac+'</span></a></div>';
		                      	
	                      	}
		                  },
					  	{ text: 'A/C Name or Name on Card',cellclassname:cellclassname, datafield: 'ac_name',editable: false, width: '15%', align:'left',cellsalign:'left'},
					  	{ text: 'Other Ac', datafield: 'other_ac',cellclassname:cellclassname,editable: false, width: '35%', align:'left',cellsalign:'left',sortable: false, menu: false,},
					  	{ text: 'Region', datafield: 'region_name',cellclassname:cellclassname,editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'Territory', datafield: 'territory_name',cellclassname:cellclassname,editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'District', datafield: 'district_name',cellclassname:cellclassname,editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'Case File District', datafield: 'case_file_district',cellclassname:cellclassname,editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'Unit Office', datafield: 'unit_office_name',cellclassname:cellclassname,editable: false, width: '10%', align:'left',cellsalign:'left'},
						
						{ text: 'Initiate By', datafield: 'e_by',cellclassname:cellclassname,editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Initiate Date Time', datafield: 'e_dt',cellclassname:cellclassname,editable: false, width: '12%' , align:'center',cellsalign:'center'},
						
		                { text: 'STC By', datafield: 'stc_by',cellclassname:cellclassname,editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'STC Date Time', datafield: 'stc_dt',cellclassname:cellclassname,editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'REC By', datafield: 'rec_by',cellclassname:cellclassname,editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'REC Date and Time ', datafield: 'rec_dt',cellclassname:cellclassname,editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'Send To HOLM By', datafield: 'sth_by',cellclassname:cellclassname,editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Send To HOLM Date and Time', datafield: 'sth_dt',cellclassname:cellclassname,editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'Verify By', datafield: 'v_by',cellclassname:cellclassname,editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Verify Date and Time', datafield: 'v_dt',cellclassname:cellclassname,editable: false, width: '12%' , align:'center',cellsalign:'center'},
						 ],
					ready: function () {
	                    var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
	                     $('#jqxgrid').jqxGrid({ pagesizeoptions: ['25', '100','200']});
	                }
            });
			//End check box update 
			jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#sendtohoopscancel,#deletecancel") });
			jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
			jQuery('#details').on('close', function (event) {
			    jQuery('#action_form').jqxValidator('hide');
			});
			var region = [<? $i=1; foreach($region as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
			jQuery("#region").jqxComboBox({theme: theme, promptText: "Select Region", source: region, width: '97%', height: 21});
			var territory = [<? $i=1; foreach($territory as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
			jQuery("#territory").jqxComboBox({theme: theme, promptText: "Select territory", source: territory, width: '97%', height: 21});
			var district = [<? $i=1; foreach($district as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
			jQuery("#district").jqxComboBox({theme: theme, promptText: "Select district", source: district, width: '97%', height: 21});
			var status = [<? $i=1; foreach($status as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
			status.push({ value: '00', label: 'Migrated Data' });
			jQuery("#status").jqxComboBox({theme: theme, promptText: "Select Status", source: status, width: '97%', height: 21});
			var loan_segment = [<? $i=1; foreach($loan_segment as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}';$i++;}?>];
			jQuery("#loan_segment").jqxComboBox({theme: theme, promptText: "Select loan segment", source: loan_segment, width: '97%', height: 21});
			var cl_bbl = [<? $i=1; foreach($cl_bbl as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->name.'", label:"'.$row->name.'"}';$i++;}?>];
			jQuery("#cl_bbl").jqxComboBox({theme: theme, promptText: "Cl BBL", source: cl_bbl, width: '50%', height: 21});
			var outst_range = [
				{value:'0-50000',label:'0-50k'},
				{value:'50000-100000',label:'50k-1L'},
				{value:'100000-500000',label:'1L-5L'},
				{value:'500000-upper',label:'5L-Upper'},
			];
			jQuery("#proposed_type_grid").jqxComboBox({theme: theme, width: '90%', autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
			jQuery("#outst_range").jqxComboBox({theme: theme, promptText: "Outstanding", source: outst_range, width: '50%', height: 21});
			jQuery('#cl_bbl,#outst_range,#region,#loan_segment,#territory,#district,#status').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
            jQuery('#proposed_type_grid').bind('change', function (event) {
                jQuery("#loan_ac_grid").val('');
                jQuery("#hidden_loan_ac_grid").val('');
                change_caption_grid();       
            });
            change_caption_grid();   
  });
	function change_dropdown(operation,edit=null)
	{
		var id='';
		//check for add Region action
		if (edit==null) 
		{
			id = jQuery("#"+operation).val();
		}
		else
		{
			id=edit;
		}
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
        url: '<?php echo base_url(); ?>index.php/user_info/get_dropdown_data',
        async:false,
        type: "post",
        data: {[csrfName]: csrfHash,id : id,operation:operation},
        datatype: "json",
        success: function(response){
        	var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
					var str='';
					var theme = getDemoTheme();
					if (operation=='region') 
					{
						//alert('str');
						var territory = [];
						jQuery.each(json['row_info'],function(key,obj){
							territory.push({ value: obj.id, label: obj.name });
							//alert(obj.name);
						});
						jQuery("#territory").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select territory", source: territory, width: '97%', height: 21});
						//For edit action
						if (edit!=null) 
						{
							//alert('success');
							jQuery("#territory").jqxComboBox('val', '<?=(isset($result->territory) && $result->territory!=0)?$result->territory:''?>');
						}
					}
					if (operation=='territory') 
					{
						var district = [];
						jQuery.each(json['row_info'],function(key,obj){
							district.push({ value: obj.id, label: obj.name });
						});
						jQuery("#district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select District", source: district, width: '97%', height: 21});
						//For edit action
						if (edit!=null) 
						{
							jQuery("#district").jqxComboBox('val', '<?=(isset($result->district) && $result->district!=0)?$result->district:''?>');
						}
					}
					if (operation=='district') 
					{
						var unit_office = [];
						jQuery.each(json['row_info'],function(key,obj){
							unit_office.push({ value: obj.id, label: obj.name });
						});
						jQuery("#unit_office").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Unit Office", source: unit_office, width: '97%', height: 21});
						//For edit action
						if (edit!=null) 
						{
							jQuery("#unit_office").jqxComboBox('val', '<?=(isset($result->unit_office) && $result->unit_office!=0)?$result->unit_office:''?>');
						}
					}

            },
            error:   function(model, xhr, options){
                alert('failed');
            },
        	});

			return false;
	}
	var count=0; var maxrow = 0; var displayrow= 0; inc = 0; decr = 0;
	function clearCount() { count=0; maxrow = 0;displayrow= 0;}
	function search_data(){
		jQuery("#jqxgrid").jqxGrid('updatebounddata');
		return;

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
	function check(id,indx,proposed_type,sec_sts)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/cma_ho/fromcheck/'+id+'/'+indx+'/'+proposed_type+'/'+sec_sts, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function verify(id,indx,proposed_type)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/cma_ho/formverify/'+id+'/'+indx+'/'+proposed_type, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function editt(val,indx,proposed_type)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>cma_process/from/edit/'+val+'/'+indx+'/'+proposed_type+'/ho_update', (jQuery(window).width()-80), jQuery(window).height(), 'yes');
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
				url: '<?=base_url()?>index.php/cma_ho/delete_action/',
				data : postData,
				datatype: "json",
				success: function(response){
                  ///console.log(response);
					var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
						if (jQuery("#type").val()=='acknowledgement')
						{
							jQuery("#sendtochecker").show();
							jQuery("#SendTocheckercancel").show();
							jQuery("#sendtochecker_loading").hide();
						}
						else if(jQuery("#type").val()=='sendtohoops')
						{
							jQuery("#sendtohoops").show();
							jQuery("#sendtohoopscancel").show();
							jQuery("#sendtohoops_loading").hide();
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
		var hoopschecker = 0;
		if (proposed_type==1) 
		{
			var type='Loan';
		}else{var type='Card';}
		jQuery('#proposed_type').val(type);
		jQuery('#verifyIndexId').val(indx);
		if (operation=='details') 
		{
			jQuery("#header_title").html('CMA Details');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').show();
			jQuery('#sendtohoops_row').hide();
		}
		else if (operation=='delete') 
		{
			jQuery('#comments').val('');
			jQuery("#header_title").html('Delete CMA');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').show();
			jQuery('#close_btn_row').hide();
			jQuery('#sendtohoops_row').hide();
		}
		else if (operation=='acknowledgement') 
		{
			jQuery("#header_title").html('Acknowledge CMA');
			jQuery('#sendtochecker_row').show();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#sendtohoops_row').hide();
		}
		else if(operation=='sendtohoops')
		{
			jQuery("#header_title").html('Send To HOOPS CMA');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#sendtohoops_row').show();
			hoopschecker=1;
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
			data : {[csrfName]: csrfHash,id: id,hoopschecker:hoopschecker},
			datatype: "json",
			success: function(response){
			//alert(response);
				var json = jQuery.parseJSON(response);

				jQuery('.txt_csrfname').val(json.csrf_token);
				var html='<option value="0">Select Hoops User</option>';
				console.log(json['checker_info'])
				if (json['checker_info'].length>0) //For Hoops Checker Data
				{
					var i=1;
					jQuery.each(json['checker_info'],function(key,obj){
						if (i==1) 
						{
							html+='<option value="'+obj.id+'" selected>'+obj.name+'('+obj.pin+')</option>';
						}
						else
						{
							html+='<option value="'+obj.id+'" >'+obj.name+'('+obj.pin+')</option>';
						}
						i++;
					});
				}
				jQuery("#checker_to_notify").html(html);
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
	function mask_grid(str,textbox){
        var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
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
                    jQuery("#hidden_loan_ac_grid").val(str);
                }
                else//For single value enter
                {
                    //For New value
                    var orginal_loan_ac=jQuery("#hidden_loan_ac_grid").val();
                    if (orginal_loan_ac.length<str.length) 
                    {
                        var index = str.length-1;
                        var new_val=str.slice(index);
                        orginal_loan_ac+=new_val;
                        //alert(orginal_loan_ac);
                        jQuery("#hidden_loan_ac_grid").val(orginal_loan_ac);
                    }
                    //For delete key
                    else{
                        var len=str.length;
                        var new_val=orginal_loan_ac.slice(0,len);
                        jQuery("#hidden_loan_ac_grid").val(new_val);
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
                          if (letter_Count<6 || jQuery("#hidden_loan_ac_grid").val().length!=16) 
                          {
                            textbox.value = '';
                            jQuery("#hidden_loan_ac_grid").val('');
                            alert('Wrong way to input Card No please try again');
                          }
                    }
                }
            }
        }
        
    }
    function change_caption_grid()
    {   
        if (jQuery("#proposed_type_grid").val()=='') 
        {
            document.getElementById("loan_ac_grid").disabled = true;
        }
        else
        {
            document.getElementById("loan_ac_grid").disabled = false;
            var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
        }
        
    }
	</script>
	<div id="container" style="">
	<div id="body"  >
		<div  style="display:block; min-height:350px; height:auto">
			<form method="POST" name="form" id="form"  style="margin:0px;">
			   <div style="padding: 0.5%;width:98%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
					<table id="deal_body" style="display:block;width:100%">
						<input type="hidden" id="hidden_loan_ac_grid" value="" name="hidden_loan_ac_grid">
						<tr>
							<td style="text-align:right;width:5%"><strong>Region&nbsp;&nbsp;</strong> </td>
							<td style="width:15%"><div style="padding-left:1.8%" id="region" name="region"></div></td>
							<td style="text-align:right;width:5%"><strong>Territory&nbsp;&nbsp;</strong> </td>
							<td style="width:15%"><div style="padding-left:1.8%" id="territory" name="territory"></div></td>
							<td style="text-align:right;width:5%"><strong>District&nbsp;&nbsp;</strong> </td>
							<td style="width:15%"><div style="padding-left:1.8%" id="district" name="district"></div></td>
							<td style="text-align:left;width:7%">
								<div id="proposed_type_grid" name="proposed_type_grid"></div>
							</td>
							<td style="text-align:left;width:15%">
								<strong>AC/Card&nbsp;&nbsp;</strong>
								<input id="loan_ac_grid" name="loan_ac_grid" style="width:60%" maxlength="16" onKeyUp="javascript:return mask_grid(this.value,this);"/> </td>
							<td style="text-align:right;width:5%"><strong>Rec Date&nbsp;&nbsp;</strong> </td>
							<td style="width:30%"><input id="rec_dt_from" name="rec_dt_from" style="width:40%" /><script type="text/javascript">datePicker("rec_dt_from");</script>
							<strong>To</strong> <input id="rec_dt_to" name="rec_dt_to" style="width:40%" /><script type="text/javascript" >datePicker("rec_dt_to");</script>
							</td>
							<td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data(),clearCount()" style="width:58px" />
							</td>
						</tr>
						<tr>
							<td style="text-align:right;width:5%"><strong>Status&nbsp;&nbsp;</strong> </td>
							<td style="width:15%"><div style="padding-left:1.8%" id="status" name="status"></div></td>
							<td style="text-align:right;width:5%"><strong>ACK. Date&nbsp;&nbsp;</strong> </td>
							<td style="width:15%"><input id="ack_dt_from" name="ack_dt_from"  style="width:40%" /><script type="text/javascript">datePicker("ack_dt_from");</script>
							<strong>To</strong> <input id="ack_dt_to" name="ack_dt_to"  style="width:40%" /><script type="text/javascript" >datePicker("ack_dt_to");</script>
							</td>
							<td style="text-align:right;width:5%"><strong>APP. Date&nbsp;&nbsp;</strong> </td>
							<td style="width:15%"><input id="v_dt_from" name="v_dt_from"  style="width:40%" /><script type="text/javascript">datePicker("v_dt_from");</script>
							<strong>To</strong> <input id="v_dt_to" name="v_dt_to"  style="width:40%" /><script type="text/javascript" >datePicker("v_dt_to");</script>
							</td>
							<td style="text-align:right;width:5%"><strong>Protfolio&nbsp;&nbsp;</strong> </td>
							<td style="width:15%"><div style="padding-left:1.8%" id="loan_segment" name="loan_segment"></div></td>
							<td style="text-align:right;width:5%"><strong>CL BBL&nbsp;&nbsp;</strong> </td>
							<td style="width:15%"><div style="padding-left:1.8%;float:left" id="cl_bbl" name="cl_bbl"></div><div style="padding-left:1.8%;float:left" id="outst_range" name="outst_range"></div></td>
						</tr>
					</table>
			  </div>
			  <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
			  <div id="jqxgrid" style="margin-top:5px;width:100%;min-height:320px;height:auto;"></div>
		

			<div style="float:left;padding-top: 5px;padding-left:0px;">
			  <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
			    <? if(ACKOWLEDGMENTREQUEST==1){?>
				<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
			    href="<?=base_url()?>index.php/cma_ho/bulk_operation/ack" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK ACK" id="sendButton" /></a>
			    <? }?> &nbsp;&nbsp;
			    <? if(SENDTOCHECKER==1){?>
				<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
			    href="<?=base_url()?>index.php/cma_ho/bulk_operation/sta" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK STA" id="sendButton" /></a>
			    <? }?> &nbsp;&nbsp;
			    <? if(VERIFY==1){?>
				<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
			    href="<?=base_url()?>index.php/cma_ho/bulk_operation/apv" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
			    <? }?> &nbsp;&nbsp;
			    <? if(SENDTOHOOPS==1 && (check_group(10) || $this->session->userdata['ast_user']['user_system_admin_sts']==2)){?>
				<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
			    href="<?=base_url()?>index.php/cma_ho/bulk_operation/sthoops" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK STHO" id="sendButton" /></a>
			    <? }?> &nbsp;&nbsp;
			    <strong>ACK = </strong> Acknowledgement,&nbsp;
			    <strong>E = </strong> Edit Facility,&nbsp;
			    <strong>STA (HO) = </strong> Send to Approver  (HOLM),&nbsp;
			    <strong>APV (HO) = </strong> Approve (HO),&nbsp;
			    <strong>STHO = </strong>Send To HOOPS&nbsp;
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
    		<input name="proposed_type" id="proposed_type" value="" type="hidden">
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
				      	<input type="button" class="buttonsendtochecker" id="sendtochecker" value="ACK" />
				      	<input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel" />
				    	<span id="sendtochecker_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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
				<div id="sendtohoops_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
					Select Hoops User: <span style="color: red;">*</span> 
					<select name="checker_to_notify" id="checker_to_notify">
			      	</select><!-- <br> -->
			      	<!-- Notify By:&nbsp;&nbsp;
			      	<label>
			      		<input type="checkbox" name="email_notification" id="email_notification" value="email"> Email
			      		<input type="checkbox" name="sms_notification" id="sms_notification" value="sms"> SMS
			      	</label> -->
			      	&nbsp;&nbsp;&nbsp;
					<div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
				      	<input type="button" class="buttonsendtochecker" id="sendtohoops" value="Send" />
				      	<input type="button" class="buttonclose" id="sendtohoopscancel" onclick="close()" value="Cancel" />
				    	<span id="sendtohoops_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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
    <div style="display: none; padding:0px; margin:0px;" id="SelctOnetitle">We're Sorry</div>
		<div style="display: none;" id="SelctOnebody">Please select at least one Data.</div>
    <div id="applicationverifydelete"  style="display:none">
      <div class="hd"><h2 class="conf">Data already Acknowledged.</h2></div>
	  <div style="text-align:center; margin:auto; width:30px"><a class="btn-small btn-small-normal" style="text-align:center"  onclick="alertmsginfo.hide()"><span>Ok</span></a></div> 
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