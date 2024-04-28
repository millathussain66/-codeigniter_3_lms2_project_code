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
	.button3 {
	  background-color: #4CAF50;
	  color: black;
	}
	table {
			border-collapse: collapse;
		}
	table#preview_table td {
			border: 1px solid #c7c7c7;
			word-wrap:break-word
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
	     overflow:hidden;
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
        word-wrap:break-word;
	    }
	    #gurantor_table td {
	        border: 1px solid rgba(0,0,0,.20); 
	        word-wrap:break-word;
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
$package_type = $this->user_model->get_parameter_data('ref_package_type','name',"data_status = '1'");
$loan_segment = $this->user_model->get_parameter_data('ref_loan_segment','name',"data_status = '1'");
$req_type = $this->user_model->get_parameter_data('ref_req_type','name',"data_status = '1'");

?>
<div id="container">
	<div id="body"  >
    <!--Customization Start-->
	<script type="text/javascript">
		var csrf_tokens='';
		var theme = 'classic';
	   jQuery(document).ready(function($) {
	      var rules1=[
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
            ];
          var rules2=[
                { input: '#new_amount', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
					if(jQuery("#new_amount").val()=='')
					{
						jQuery("#new_amount").focus();
						return false;
					}
					else
					{
						return true;
					}
				}
				},
				{ input: '#new_amount', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit)
		         {
		           if(input.val() != '')
		           {
		              if(!checknumber_alphabatic('new_amount'))
		              {
		                 jQuery("#new_amount").focus();
		                 return false;

		              }
		              
		           }
		           return true;

		        } },
		        { input: '#new_amount', message: 'New Amount Must be Bigger!!', action: 'keyup, blur, change', rule: function (input, commit)
		         {
		           if(input.val() != '')
		           {
		           		//alert(parseFloat(jQuery("#new_amount").val()).toFixed(2));
		           		//alert(parseFloat(jQuery("#pre_package_amount").val()).toFixed(2));
		              if(parseFloat(jQuery("#new_amount").val())<parseFloat(jQuery("#pre_package_amount").val()))
		              {
		                 jQuery("#new_amount").focus();
		                 return false;

		              }
		           }
		           return true;

		        } },
				{ input: '#enhance_comments', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
				 {
				 	if(input.val() != '')
					{
						if(input.val().length>250)
						{
							jQuery("#enhance_comments").focus();
						 	return false;

						}
					}
					return true;

				} },
            ];
            var theme = 'classic';
            jQuery("#delete_button").click(function () {
            	jQuery('#action_form').jqxValidator({
                        rules: rules1, theme: theme
                });
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
            jQuery("#enhance").click(function () {
            	jQuery('#action_form').jqxValidator({
                        rules: rules2, theme: theme
                });
	            var validationResult = function (isValid) {
					if (isValid) {
						jQuery("#enhance").hide();
						jQuery("#enhancecancel").hide();
						jQuery("#enhance_loading").show();
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
            jQuery("#enableenhance").click(function () {
				jQuery("#enableenhance").hide();
				jQuery("#enableenhancecancel").hide();
				jQuery("#enableenhance_loading").show();
	    		call_ajax_submit();
	   		 });
            jQuery('#action_form').jqxValidator({
				rules: [
					
				
				]
			});
			var source =
            {
           datatype: "json",
           datafields: [
					{ name: 'id', type: 'int'},
					{ name: 'sts', type: 'string'},
					{ name: 'loan_ac', type: 'string'},
					{ name: 'e_by', type: 'string'},
					{ name: 'e_dt', type: 'string'},
					{ name: 'status', type: 'string'},
					{ name: 'req_type', type: 'string'},
					{ name: 'proposed_type', type: 'string'},
					{ name: 'loan_segment', type: 'string'},
					{ name: 'stc_by', type: 'string'},
					{ name: 'stc_dt', type: 'string'},
					{ name: 'v_by', type: 'string'},
					{ name: 'v_dt', type: 'string'},
					{ name: 'package_type', type: 'int'},
					{ name: 'v_sts', type: 'int'},
					{ name: 'package_type_name', type: 'string'},
					{ name: 'e_by_id', type: 'int'}
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
			  	url: '<?=base_url()?>index.php/lawyer_package_bill/grid',
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
						var proposed_type = jQuery.trim(jQuery('input[name=proposed_type_grid]').val());
						var loan_segment = jQuery.trim(jQuery('#loan_segment').val());
						var package_type = jQuery.trim(jQuery('#package_type').val());
						var loan_ac = jQuery.trim(jQuery('#loan_ac_grid').val());
	                    var hidden_loan_ac = jQuery.trim(jQuery('#hidden_loan_ac_grid').val());
	                    var case_number = jQuery.trim(jQuery('#case_number_grid').val());
						if(csrf_tokens=='')
						{
								csrf_tokens='<?php echo $this->security->get_csrf_hash(); ?>';
						}
	                    jQuery.extend(data, {
                            proposed_type : proposed_type,
                            loan_ac : loan_ac,
                            hidden_loan_ac : hidden_loan_ac,
	                        loan_segment : loan_segment,
	                        package_type : package_type,
	                        case_number : case_number,
	                        csrf_tokens : csrf_tokens

	                    });
	                    return data;
	                }
				}
			);
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
				pagesize: 50,
				enablehover: true,
        		enablebrowserselection: true,
        		selectionmode: 'none',
				rendergridrows: function(obj)
				{
					 return obj.data;
				},

			    columns: [
						{ text: 'Id', datafield: 'id',hidden:true,  editable: false,  width: '4%' },
						{ text: 'STS', datafield: 'v_sts',hidden:true,  editable: false,  width: '4%' },
 						<? if(DELETE==1){?>
					  	{ text: 'D', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%',
					  	cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.v_sts == 1 || dataRecord.v_sts == 35 || dataRecord.v_sts == 11)){
								return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'delete\','+editrow+')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
						 	}
						 	else {
	                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
	                      	}

							}
						  },
						<?php } ?>
						{ text: 'DTL', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '3%',
				  			cellsrenderer: function (row) {
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
						 		return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'details\','+editrow+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';
							 }
					  	},
            			<?php if(EDIT==1){ ?>
						{ text: 'E', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
					  	cellsrenderer: function (row) {
								editrow = row;
								var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.v_sts == 1 || dataRecord.v_sts == 35 || dataRecord.v_sts == 11)){
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
					  { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
                      	cellsrenderer: function(row) {
                      		editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.v_sts == 1 || dataRecord.v_sts == 35 || dataRecord.v_sts == 11)){
								return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'sendtochecker\','+editrow+')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
						 	}
						 	else if(dataRecord.v_sts == 2){
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
							if((dataRecord.v_sts == 10 || dataRecord.v_sts == 98 || dataRecord.v_sts == 100)){
								return '<div style="margin-top: 5px;text-align:center; cursor:pointer" onclick="verify('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
						 	}
						 	else {
	                      			return '<div style=" margin-top: 7px;text-align:center"></div>';
	                      	}
	                      	
                      	}
	                  },
					  <? }?>
					  <? if(ENHANCEENABLE==1){?>
					  { text: 'EE', datafield: 'enableenhance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                      	cellsrenderer: function(row) {
                      		editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if(dataRecord.v_sts == 13){
								return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'enableenhance\','+editrow+')" ><img align="center" src="<?=base_url()?>images/unlock.png"></div>';
						 	}
	                      	else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                      	}
	                  },
					  <? }?>
					  <? if(ENHANCE==1){?>
					  { text: 'E', datafield: 'enhance', editable: false,align:'center', sortable: false, menu: false, width: 35,
                      	cellsrenderer: function(row) {
                      		editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
							if(dataRecord.v_sts == 99){
								return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'enhance\','+editrow+')" ><img align="center" src="<?=base_url()?>images/expand.png"></div>';
						 	}
	                      	else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                      	}
	                  },
					  <? }?>
					  	{ text: 'Status', datafield: 'status',editable: false, width: '25%', align:'left',cellsalign:'left'},
					  	{ text: 'Package Type', datafield: 'package_type_name',editable: false, width: '15%', align:'left',cellsalign:'left'},
					  	{ text: 'Req Type', datafield: 'req_type',editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'Portfolio', datafield: 'loan_segment',editable: false, width: '10%', align:'left',cellsalign:'left'},
					  	{ text: 'Loan A/C or Card No.', datafield: 'loan_ac', editable: false,align:'center',cellsalign:'center', sortable: true, menu: true, width: '11%',
	                      	cellsrenderer: function(row) {
	                      		editrow = row;
	                      		var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
								return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\')"><span>'+dataRecord.loan_ac+'</span></a></div>';
		                      	
	                      	}
		                  },
						{ text: 'Initiate By', datafield: 'e_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Initiate Date Time', datafield: 'e_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
	                  	{ text: 'STC By', datafield: 'stc_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'STC Date Time', datafield: 'stc_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						{ text: 'Verify By', datafield: 'v_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
						{ text: 'Verify Date and Time', datafield: 'v_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
						 ],
					ready: function () {
	                    var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
	                     $('#jqxgrid').jqxGrid({ pagesizeoptions: ['25', '100','200']});
	                }
            });
			jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#deletecancel,#enableenhancecancel,#enhancecancel") });
			jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
			jQuery('#details').on('close', function (event) {
			    jQuery('#action_form').jqxValidator('hide');
			});
			var proposed_type = ["Loan", "Card"];
			jQuery("#proposed_type_grid").jqxComboBox({theme: theme, width: 100, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
			var loan_segment = [<? $i=1; foreach($loan_segment as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}';$i++;}?>];
			jQuery("#loan_segment").jqxComboBox({theme: theme, promptText: "Select loan segment", source: loan_segment, width: '97%', height: 25});
			var package_type = [<? $i=1; foreach($package_type as $row){  if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}';$i++;}?>];
			jQuery("#package_type").jqxComboBox({theme: theme, promptText: "Select package Type", source: package_type, width: '97%', height: 25});
			jQuery('#loan_segment,#package_type,#proposed_type_grid').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
            change_caption_grid();
			jQuery('#proposed_type_grid').bind('change', function (event) {
                jQuery("#loan_ac_grid").val('');
                jQuery("#hidden_loan_ac_grid").val('');
                change_caption_grid();       
            });

  });
	
	function change_caption_grid()
    {   
        if (jQuery("#proposed_type_grid").val()=='') 
        {
            document.getElementById("loan_ac_grid").disabled = true;
            jQuery("#l_or_c_no_grid").html('Loan A/C or Card');
        }
        else
        {
            document.getElementById("loan_ac_grid").disabled = false;
            var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
            if (item.value=='Loan') {
                jQuery("#l_or_c_no_grid").html('Loan A/C ');
            }
            else if(item.value=='Card'){
                jQuery("#l_or_c_no_grid").html('Card');
            }
        }
        
    }
    function CustomerPickList(module_name=null,data_field_name=null) {
        newwindow=window.open("<?=base_url()?>index.php/home/ajaxFileUpload/"+module_name+'/'+data_field_name,"Upload","width=550,height=350,resizable=0,scrollbars=0,location=no,menubar=no,toolbar=no,minimizable=no,status=no,top=140,left=340"); 
        if (window.focus) {newwindow.focus()}
        return false; 
    }
	function reloadCuragreementMessages()
	{
		window.location.reload();
	}
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
			url: "<?=base_url()?>lawyer_package_bill/r_history",
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
	function verify(id,indx)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/lawyer_package_bill/formverify/'+id+'/'+indx, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function editt(val,indx)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>lawyer_package_bill/from/edit/'+val+'/'+indx, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
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
				url: '<?=base_url()?>index.php/lawyer_package_bill/delete_action/',
				data : postData,
				datatype: "json",
				success: function(response){
                  ///console.log(response);
					var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
						if ($('type').value=='delete') 
						{
							jQuery("#delete_button").show();
							jQuery("#deletecancel").show();
							jQuery("#delete_loading").hide();
							jQuery('#details').jqxWindow('close');
						}
						else if($('type').value=='enableenhance') 
						{
							jQuery("#enableenhance").show();
							jQuery("#enableenhancecancel").show();
							jQuery("#enableenhance_loading").hide();
							jQuery('#details').jqxWindow('close');
						}
						else if($('type').value=='enhance') 
						{
							jQuery("#enhance").show();
							jQuery("#enhancecancel").show();
							jQuery("#enhance_loading").hide();
							jQuery('#details').jqxWindow('close');
						}
						else
						{
							jQuery("#sendtochecker").show();
							jQuery("#SendTocheckercancel").show();
							jQuery("#sendtochecker_loading").hide();
							jQuery('#details').jqxWindow('close');
						}
						if(json.Message!='OK')
						{								
							alert(json.Message);
							return false;
						}else{
						var msz='';
						jQuery("#error").show();
						jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});								
						jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz);	
						jQuery('#details').jqxWindow('close');
						jQuery("#jqxgrid").jqxGrid('updatebounddata');
						
					}
				}
			});

	}
	function details(id,operation,indx,territory=null,region=null)
	{
		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery('#verifyIndexId').val(indx);
		jQuery('#pre_amount_show').html('');
		jQuery('#pre_package_amount').val('');
		jQuery('#enhance_comments').val('');
		jQuery('#new_amount').val('');
		if (operation=='details') 
		{
			jQuery("#header_title").html('Package Details');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').show();
			jQuery('#enableenhance_row').hide();
			jQuery('#enhance_row').hide();
		}
		else if (operation=='delete') 
		{
			jQuery('#comments').val('');
			jQuery("#header_title").html('Delete Package');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').show();
			jQuery('#close_btn_row').hide();
			jQuery('#enableenhance_row').hide();
			jQuery('#enhance_row').hide();
		}
		else if (operation=='sendtochecker') 
		{
			jQuery("#header_title").html('Send to Checker Package');
			jQuery('#sendtochecker_row').show();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#enableenhance_row').hide();
			jQuery('#enhance_row').hide();
		}
		else if (operation=='enableenhance') 
		{
			jQuery("#header_title").html('Enable Enhancement');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#enableenhance_row').show();
			jQuery('#enhance_row').hide();
		}
		else if (operation=='enhance') 
		{
			jQuery("#header_title").html('Enhance Package Amount');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
			jQuery('#enableenhance_row').hide();
			jQuery('#enhance_row').show();
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
			url: "<?=base_url()?>lawyer_package_bill/details",
			data : {[csrfName]: csrfHash,id: id,
			territory:territory,region:region
			},
			datatype: "json",
			success: function(response){
			//alert(response);
				var json = jQuery.parseJSON(response);

				jQuery('.txt_csrfname').val(json['csrf_token']);
					if(json.str)
					{
						document.getElementById("details").style.visibility='visible';
						if(operation=='enhance')
						{
							var html = '';
	                        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'package\',\'package_approval_file\')"/>';
	                        html+='<input type="hidden" id="hidden_package_approval_file_select" name="hidden_package_approval_file_select" value="0">';
	                        html+='<span id="hidden_package_approval_file">';
	                        jQuery('#package_approval_file').html(html);
	                        var amount = parseFloat(json.amount);
							jQuery('#pre_amount_show').html(amount.toFixed(2));
							jQuery('#pre_package_amount').val(amount.toFixed(2));
							
						}
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
	</script>
  <div id="container" style="">
	<div id="body"  >
		<div  style="display:block; min-height:340px; height:auto">
			<form method="POST" name="form" id="form"  style="margin:0px;">
			   <div style="padding: 0.5%;width:98%;height:45px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
					<input type="hidden" id="hidden_loan_ac_grid" value="" name="hidden_loan_ac_grid">
					<table id="deal_body" style="display:block;width:100%">
						<tr>
							<td style="text-align:right;width:5%"><strong>Portfolio&nbsp;&nbsp;</strong> </td>
							<td style="width:15%"><div style="padding-left:1.8%" id="loan_segment" name="loan_segment"></div></td>
							<td style="text-align:left;width:8%"><strong>Package Type&nbsp;&nbsp;</strong> </td>
							<td style="width:15%"><div style="padding-left:1.8%" id="package_type" name="package_type"></div></td>
							<td style="text-align:right;width:12%"><strong>Propsed Type&nbsp;&nbsp;</strong> </td>
                            <td style="width:5%"><div style="padding-left:1.8%" id="proposed_type_grid" name="proposed_type_grid"></div></td>
                            <td style="text-align:right;width:11%"><strong><span id="l_or_c_no_grid"></span> No.</strong></td>
                            <td style="width:15%"><input name="loan_ac_grid" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac_grid" value="" onKeyUp="javascript:return mask_grid(this.value,this);"/></td>
                            <td style="text-align:right;width:5%"><strong>Case No.</strong></td>
                            <td style="width:10%"><input name="case_number_grid" tabindex="" type="text" class="" maxlength="" size="" style="width:150px" id="case_number_grid" value="" onKeyUp=""/></td>
							<td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
							</td>
						</tr>
					</table>
			  </div>
			  <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
			  <div id="jqxgrid" style="width:100%;min-height:320px;height:auto;margin-top:5px"></div>
		

			<div style="float:left;padding-top: 5px;">
		  	<div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
			<? if(ADD==1){?>
			<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
		    href="<?=base_url()?>index.php/lawyer_package_bill/from/add" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:40px;width:100px;"  value="Initiate" id="sendButton" /></a>
		    <? }?> &nbsp;&nbsp;
		    <strong>D = </strong> Delete,&nbsp;
		    <strong>DTL = </strong> Detail,&nbsp;
		    <strong>E = </strong> Edit,&nbsp;
		    <strong>STC = </strong> Send to Checker,&nbsp;
		    <strong>E = </strong> Enhance,&nbsp;
		    <strong>EE = </strong> Enable Enhance,&nbsp;
		    <strong>V = </strong> Verify&nbsp;
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
    <div><strong><label id="header_title"></label></strong></div>
		<form method="POST" name="action_form" id="action_form"  style="margin:0px;">
			<input name="deleteEventId" id="deleteEventId" value="" type="hidden">
    		<input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
    		<input name="pre_package_amount" id="pre_package_amount" value="" type="hidden">
    		<input name="type" id="type" value="" type="hidden">
			<div id="loading_preview" style="text-align:center">
				<span id="loading_p" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
			</div>
			<div style="" id="details_table">
			&nbsp;&nbsp;&nbsp;<img  onClick="printpage('preview_table','gurantor_table','facility_table','facility_card','proposed_type_d')" style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?=base_url()?>old_assets/images/Print.png" alt="print-preview"  />
				<span id="main_body"></span>
				<br>
				<div id="preview_table"></div>
				<div id="gurantor_table"></div>
				<div id="facility_table"></div>
				<div id="facility_card"></div>
				<div id="proposed_type_d"></div>
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
			    <div id="close_btn_row" style="text-align:center;margin-bottom:30px;width:100%;">
			    	<input type="button" align="center" class="button1" id="codeOK" value="Close" />
			    </div>
			    <div id="enableenhance_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
			      	<input type="button" class="buttonsendtochecker" id="enableenhance" value="Enable" />
			      	<input type="button" class="buttonclose" id="enableenhancecancel" onclick="close()" value="Cancel" />
			    	<span id="enableenhance_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
			    </div>
			    <div id="enhance_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr>
                                <td>Previous Amouont:</td>
                                <td><strong><span id="pre_amount_show"></span></strong></td>
                            </tr>
                            <tr>
                                <td>New Amount:<span style="color: red;">*</span></td>
                                <td><input name="new_amount" tabindex="2" type="text" class="" style="width:250px" id="new_amount" value=""/></td>
                            </tr>
                            <tr id="attachment_row">
                                <td>Attachment (If Any):</td>
                                <td>
                                    <span id="package_approval_file"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Enhance Reason:</td>
                                <td><textarea name="enhance_comments" id="enhance_comments" style="width:250px;"></textarea></td>
                            </tr>
                        </table>
                        <div style="clear:both"></div>

                        <div style="margin-top:20px">
                            <input type="button" class="buttonsendtochecker" id="enhance" value="Confirm" />
                            <input type="button" class="buttonclose" id="enhancecancel" onclick="close()" value="Cancel" />
                            <span id="enhance_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                        </div>
                    </div>
                </div>
			</div>
		</form>
	</div>
	<div id="r_history" style="visibility:hidden;">
    <div><strong><span id="r_heading"></span></strong></div>
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
		pp.document.writeln('</tr><tr><td><table class="gurantor" cellspacing="0" cellspadding="0">');
		pp.document.writeln(document.getElementById(gurantor_table).innerHTML);
		pp.document.writeln('</table></td></tr><tr><td style="height:20px;"></td></tr><tr>');
		pp.document.writeln('<td style="text-align:center; font-weight:bold;font-size:20px;">Facility Info</td>');
		pp.document.writeln('</tr><tr><td><table class="facility" cellspacing="0" cellspadding="0">');
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