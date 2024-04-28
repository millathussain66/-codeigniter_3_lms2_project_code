

<!--  styling starts: -->
<style type="text/css">
   #loading-overlay {
   position: absolute;
   width: 100%;
   height:100%;
   left: 0;
   top: 0;
   display: none;
   align-items: center;
   background-color: #000;
   z-index: 999;
   opacity: 0.5;
   }
   .loading-icon{ position:absolute;border-top:2px solid #fff;border-right:2px solid #fff;border-bottom:2px solid #fff;border-left:2px solid #767676;border-radius:25px;width:25px;height:25px;margin:0 auto;position:absolute;left:50%;margin-left:-20px;top:50%;margin-top:-20px;z-index:4;-webkit-animation:spin 1s linear infinite;-moz-animation:spin 1s linear infinite;animation:spin 1s linear infinite;}
   @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
   @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
   @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
   #cto_data_table {
   border-collapse: collapse;
   }
   #cto_data_table, #cto_data_table th, #cto_data_table td {
   border-color: #c7c7c7;
   }
   .text-input-medium{
   width: 250px;
   }
   .addmore
   {
   background-image:url(<?=base_url()?>images/addmore_grn.png);
   /*background-size: 20px 20px;*/
   background-repeat: no-repeat;
   border:0;
   width:18px; height:18px;
   background-color:transparent;
   cursor:pointer;
   }
   .del
   {
   background-image:url(<?=base_url()?>images/del.png);
   background-repeat: no-repeat;
   border:0;
   width:18px; height:18px;
   background-color:transparent;
   cursor:pointer;
   }
   .edit
   {
   background-image:url(<?=base_url()?>images/edit.png);
   background-repeat: no-repeat;
   border:0;
   width:18px; height:18px;
   background-color:transparent;
   cursor:pointer;
   }
   .nextButton
   {
   float: right;
   margin: 10px;
   width: 100px;
   height: 30px;
   font-weight: bold;
   font-family: arial;
   }
   .backButton
   {
   float: left;
   margin: 10px;
   width: 100px;
   height: 30px;
   font-weight: bold;
   font-family: arial;
   }
   #tab1Table td,#tab3Table td,#tab2Table td{
   vertical-align: top;
   }
   table#addressTable {
   border-collapse: collapse;
   }
   table#addressTable, #addressTable th, #addressTable td {
   border: 1px solid #c7c7c7;
   }
   table#addressTablet {
   border-collapse: collapse;
   }
   table#addressTablet, #addressTablet th, #addressTablet td {
   border: 1px solid #c7c7c7;
   }
   table#facility_info td {
   border: 1px solid #c7c7c7;
   text-align: center;
   }
   table#loanTable {
   border-collapse: collapse;
   }
   table#loanTable, #loanTable th, #loanTable td {
   border: 1px solid #c7c7c7;
   }
   table#loanTable_detail {
   border-collapse: collapse;
   }
   table#guarantor_info td {
   border: 1px solid #c7c7c7;
   text-align: center;
   word-wrap:break-word
   }
   table#loanTable_detail, #loanTable_detail th, #loanTable_detail td {
   border: 1px solid #c7c7c7;
   }
   #loanTable_detail th, #loanTable_detail td{
   text-align: center;
   }
   #addressTable th, #addressTable td{
   text-align: center;
   }
   #addressTablet th, #addressTablet td{
   text-align: center;
   }
   #loanTable th, #loanTable td{
   text-align: center;
   }
   table#owner_addressTable {
   border-collapse: collapse;
   }
   table#owner_addressTable, #owner_addressTable th, #owner_addressTable td {
   border: 1px solid #c7c7c7;
   }
   #owner_addressTable th, #owner_addressTable td{
   text-align: center;
   }
   table#owner_addressTablet {
   border-collapse: collapse;
   }
   table#owner_addressTablet, #owner_addressTablet th, #owner_addressTablet td {
   border: 1px solid #c7c7c7;
   }
   #owner_addressTablet th, #owner_addressTablet td{
   text-align: center;
   }
   #ownerTable {
   border-collapse: collapse;
   }
   #ownerTable, #ownerTable th, #ownerTable td {
   border-color: #c7c7c7;
   }
   .hint{
   color: red;
   }
   .section
   {
   padding: 5px;
   }
   #hintWrapper{
   float: left;
   margin: 10px;
   }
   .jqx-window-modal
   {
   height: 625px !important;
   }
   .nextButton
   {
   float: right;
   margin: 10px;
   width: 100px;
   height: 30px;
   font-weight: bold;
   font-family: arial;
   }
   .backButton
   {
   float: left;
   margin: 10px;
   width: 100px;
   height: 30px;
   font-weight: bold;
   font-family: arial;
   }
   #sectionButtonsWrapper
   {
   float: right;
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
   #basketButtonsWrapper
   {
   float: right;
   }
   #selectedProductsButtonsWrapper
   {
   float: right;
   }
   #ownerSave,#addmoreOwner{
   width: 100px;
   height: 30px;
   font-weight: bold;
   font-family: arial;
   }
   .dateSpan{
   font-weight: normal;
   font-size: 12px;
   color: #808080;
   }
   .tablescroll #headerTable td{ border:none;}
   .headSpan {
   float:left;font-weight:bold; font-size:9pt;cursor:pointer;
   }
   table#guarantor_info td {
   border: 1px solid #c7c7c7;
   word-wrap:break-word
   }
</style>
<!--   styling Ends:  -->
<script type="text/javascript">
   var csrf_token='';
   var checker_info = [<? $i=1; foreach($checker_info as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.' ('.$row->pin.')"}'; $i++;}?>];
   var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
   jQuery(document).ready(function () {
   	
   	var theme = getDemoTheme();
      jQuery('#holdButton').jqxButton({ template:"warning",width: 120, height: 40, theme: theme });
   	jQuery("#r_history").jqxWindow({ theme: theme,  width: '50%', height:'50%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
   	jQuery('#sendButton').jqxButton({template:"success", width: 130, height: 40, theme: theme });
   	jQuery("#legal_user").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Legal User", source: checker_info, width: 250, height: 25});
   	jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Legal Region", source: legal_region, width: 250, height: 25});
   	jQuery("#legal_region").jqxComboBox('val',<?=$result->legal_region?>);
      jQuery("#legal_user").jqxComboBox('val', '<?=(isset($result->legal_user) && $result->legal_user!=0)?$result->legal_user:''?>');
      jQuery('#legal_user,#legal_region').focusout(function() {
              commbobox_check(jQuery(this).attr('id'));
          });
          jQuery('#deliver_form').jqxValidator({
   		rules: [
   			{ input: '#legal_user', message: 'required!', action: 'blur,change', rule: function (input) {					
   				if(input.val() != '')
   				{
   					var item = jQuery("#legal_user").jqxComboBox('getSelectedItem');
   					if(item != null){jQuery("input[name='legal_user']").val(item.value);}
   					return true;				
   				}
   				else
   				{
   					jQuery("#legal_user input").focus();
   					return false;
   				}
   			}  
   			},
            { input: '#belance_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
               //if(jQuery("#hidden_uploaded_statement_select").val()!='0' && jQuery("#belance_dt").val()=='')
               if(input.val()=='')
               {
                  return false;
               }
               else
               {
                  return true;
               }
            }
            },
            { input: '#belance_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
               if (!input.val()) {
                  return true;
               }
               if(validate_date(input.val()))
               {
                  return true;
               }else {
                  return false;
               }
            } },
            // { input: '#belance_dt', message: 'Old Date Not allowed !', action: 'change', rule: function(input,commit){  
            //          if(input.val()!="") { return validateDate(input.val()); } else{return true;}
            //      }
            //    },
            { input: '#belance', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
               //if(jQuery("#hidden_uploaded_statement_select").val()!='0' && jQuery("#belance").val()=='')
               if(input.val()=='')
               {
                  jQuery("#belance").focus();
                  return false;
               }
               else
               {
                  return true;
               }
            }
            },
            { input: '#belance', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit)
             {
               if(input.val() != '')
               {
                  if(!checknumber_alphabatic('belance'))
                  {
                     jQuery("#belance").focus();
                     return false;

                  }
               }
               return true;

            } }
   		]
   		});
   		jQuery("#sendButton").click(function () 
   		{
   		    var validationResult = function (isValid) {
   				if (isValid && statement_validation()!=false) {
   					delete_action('deliver');
   				}
   				else{return;}
   			}
   			jQuery('#deliver_form').jqxValidator('validate', validationResult);
   		});
   });
   function delete_action(type) {
   	var message='';
   	if (type=='deliver') 
   	{
   		jQuery("#reason_message_body").hide();
   		jQuery("#type").val(type);
   		jQuery("#message").html('Deliver');
   		jQuery("#button_tag").html('Deliver');
   		jQuery("#email_notification").val(type);
   		jQuery("#success_message").val('Deliverd');
   	}
      if (type=='hold') 
      {
         jQuery("#reason_message_body").show();
         jQuery("#type").val(type);
         jQuery("#message").html('Hold');
         jQuery("#button_tag").html('Hold');
         jQuery("#reason_message").html('Hold Reason');
         jQuery("#email_notification").val(type);
         jQuery("#success_message").val('Hold');
      }
   	$('sendToCheckerMessageDialogConfirm').style.display = 'inline';
   	$('sendToCheckerMessageDialogCancel').style.display = 'inline';
   	$('loadingReturn').style.display = 'none';
   	sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'sendToCheckerMessageDialog' });
   	
   	sendToCheckerMessageDialog.show();
   }
   function close_window()
   {
   	sendToCheckerMessageDialog.hide();
   }
   function close_window_statement()
   {
   	loadStatementDialog.hide();
   }
   function call_ajax_submit()
   {
      if (jQuery('#reason').val() == '' && jQuery('#type').val()!='deliver') {
         alert('The reason field is required!');
         jQuery('#reason').focus();
         return false;
      }
      jQuery('#hold_reason').val(jQuery('#reason').val());
   	var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
   	var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
   	var postData = $('deliver_form').toQueryString()+"&"+csrfName+"="+csrfHash;
   	$('sendToCheckerMessageDialogConfirm').style.display = 'none';
   	$('sendToCheckerMessageDialogCancel').style.display = 'none';
   	$('loadingReturn').style.display = 'inline';
   	jQuery.ajax({
   			type: "POST",
   			cache: false,
   			url: '<?=base_url()?>index.php/hoops/delete_action/',
   			data : postData,
   			datatype: "json",
   			success: function(response){
                    ///console.log(response);
   				var json = jQuery.parseJSON(response);
   				window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
   				jQuery('.txt_csrfname').val(json.csrf_token);
   					if(json.Message!='OK')
   					{								
   						alert(json.Message);
   						//window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
   						window.top.EOL.messageBoard.close();
   					}else{
   
   					window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
   					window.parent.jQuery("#error").show();
   					window.parent.jQuery("#error").fadeOut(11500);
   					window.parent.jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+jQuery("#success_message").val());	
                       //window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');										
   					window.top.EOL.messageBoard.close();
   				}
   			}
   		});
   
   }
   function statement_validation ()
   {
      return true;
   	if (jQuery('#hidden_generated_file_value').val()=='' && jQuery('#hidden_uploaded_statement_select').val()=='0')
   	{
   		jQuery("#spnerrormsg").show();
   		jQuery('#spnerrormsg').css('color', 'red');
   		jQuery("#spnerrormsg").fadeOut(3000);
   		jQuery("#spnerrormsg").html("Please Generate or upload Statement");
   		return false;
   	}
   	else
   	{
   		return true;
   	}
   }
   function r_history (id) {
   	var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
   	var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
   	jQuery.ajax({
   		type: "POST",
   		cache: false,
   		url: "<?=base_url()?>cma_process/r_history",
   		data : {[csrfName]: csrfHash,id: id},
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
   function CustomerPickList(module_name=null,data_field_name=null) {
   	newwindow=window.open("<?=base_url()?>index.php/home/ajaxFileUpload/"+module_name+'/'+data_field_name,"Upload","width=550,height=350,resizable=0,scrollbars=0,location=no,menubar=no,toolbar=no,minimizable=no,status=no,top=140,left=340"); 
   		if (window.focus) {newwindow.focus()}
   		return false; 
   }
   function get_user_data_region_wise(){
      var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
      if (item!=null)
      {
          var legal_region = item.value;
          var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
          var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
          jQuery.ajax({
          url: '<?=base_url()?>index.php/hoops/get_dropdown_data',
          async:false,
          type: "post",
         data: { [csrfName]: csrfHash,legal_region : legal_region},
          datatype: "json",
          success: function(response){
              var json = jQuery.parseJSON(response);
              jQuery('.txt_csrfname').val(json.csrf_token);
              var str='';
              var theme = getDemoTheme();
                  var legal_user = [];
                   jQuery.each(json['legal_user'],function(key,obj){
                       legal_user.push({ value: obj.id, label: obj.name+' ('+obj.pin+')' });
                       //alert(obj.name);
                   });
                   jQuery("#legal_user").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select legal user", source: legal_user, width: 250, height: 25});
                   jQuery('#legal_user').focusout(function() {
                      commbobox_check(jQuery(this).attr('id'));
                  });

              },
              error:   function(model, xhr, options){
                  alert('failed');
              },
              });
      }
      else
      {
          jQuery("#legal_user").jqxComboBox('clearSelection');
          jQuery("#legal_user").val('');
      }
   }
   function date_formater(str)
    {
        //var str_1=str.split("T");
        if (str=='' || str==undefined) 
        {
            return '';
        }
        else
        {
            var str_2=str.split("-");
            var final_str=str_2[2]+'/'+str_2[1]+'/'+str_2[0];
            return final_str;
        }
    }
   function generate_statement_loan(id,main_sts)
   {
      if(jQuery("#date_from_"+id).val()=='')
      {
         alert("Date Range Required ");
         jQuery("#date_from_"+id).focus();
         return;
      }
      if(jQuery("#date_to_"+id).val()=='')
      {
         alert("Date Range Required ");
         jQuery("#date_to_"+id).focus();
         return;
      }
      jQuery("#generate_"+id).hide();
      jQuery("#st_loading_"+id).show();
      var dt_from = jQuery("#date_from_"+id).val();
      var dt_to = jQuery("#date_to_"+id).val();
      var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
      var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
      jQuery.ajax({
          type: "POST",
          cache: false,
          async:false,
          url: '<?=base_url()?>index.php/hoops/load_statement_by_id_loan/',
          data : {[csrfName]: csrfHash,dt_from:dt_from,dt_to:dt_to,id:id},
          datatype: "json",
          success: function(response){
            ///console.log(response);
              var json = jQuery.parseJSON(response);
              jQuery('.txt_csrfname').val(json.csrf_token);
              var str='';
              if(json.str=='ok')
              {
                  jQuery("#st_loading_"+id).hide();
                  jQuery("#st_loaded_"+id).show();
                  var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                  var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                  //Calling Another Ajax to load html and xl
                  jQuery("#stg_loading_"+id).show();
                  jQuery.ajax({
                  type: "POST",
                  cache: false,
                  async:false,
                  url: '<?=base_url()?>index.php/hoops/generate_xl_by_id_loan/',
                  data : {[csrfName]: csrfHash,
                      id:json.id,dt_from:dt_from,dt_to:dt_to,int_rate:json.int_rate
                  },
                  datatype: "json",
                  success: function(response){
                    ///console.log(response);
                      var json2 = jQuery.parseJSON(response);
                      jQuery('.txt_csrfname').val(json2.csrf_token);
                      var str='';
                      
                       jQuery("#stg_loading_"+id).hide();
                       jQuery("#stg_loaded_"+id).show();
                       if (json2.new_file_path!='') 
                       {
                        str += '&nbsp;&nbsp;<strong>AC Statement&nbsp;&nbsp;</strong><img id="new_statement_img" onclick="popup(\'<?=base_url()?>temp_upload_file/'+json2.new_file_path+'\')" style="cursor:pointer;text-align:center" height="18" src="<?=base_url()?>images/icon_xls.gif">';
                       }
                       document.getElementById('statement_xl_'+id).innerHTML = str;
                       if(main_sts==1) //For Main Account Statement File
                       {
                        var str2 = '<img id="file_preview_generated_statement" onclick="popup(\'<?=base_url()?>temp_upload_file/'+json2.new_file_path+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>images/icon_xls.gif">';
                        document.getElementById('hidden_generate_statement').innerHTML = str2;
                        jQuery("#hidden_generated_file_value").val(json2.new_file_path);
                        jQuery("#belance_dt").val(date_formater(json2.final_dt));
                        jQuery("#belance").val(json2.final_belance);
                       }
                    }
                  });
              }
              else
              {

                  alert('Filed');
                  jQuery("#st_loading_"+id).hide();
                  jQuery("#st_loaded_"+id).show();
                  jQuery("#generate_"+id).show();
              }
          }
      });
   }
   function generate_statement_card(id,main_sts)
   {
      jQuery("#generate_"+id).hide();
      jQuery("#st_loading_"+id).show();
      var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
      var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
      jQuery.ajax({
          type: "POST",
          cache: false,
          async:false,
          url: '<?=base_url()?>index.php/hoops/load_statement_by_id_card/',
          data : {[csrfName]: csrfHash,id:id},
          datatype: "json",
          success: function(response){
            ///console.log(response);
              var json = jQuery.parseJSON(response);
              jQuery('.txt_csrfname').val(json.csrf_token);
              var str='';
              if(json.str=='ok')
              {
                  jQuery("#st_loading_"+id).hide();
                  jQuery("#st_loaded_"+id).show();
                  var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                  var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                  //Calling Another Ajax to load html and xl
                  jQuery("#stg_loading_"+id).show();
                  jQuery.ajax({
                  type: "POST",
                  cache: false,
                  async:false,
                  url: '<?=base_url()?>index.php/hoops/generate_xl_by_id_card/',
                  data : {[csrfName]: csrfHash,
                      id:json.id
                  },
                  datatype: "json",
                  success: function(response){
                    ///console.log(response);
                      var json2 = jQuery.parseJSON(response);
                      jQuery('.txt_csrfname').val(json2.csrf_token);
                      var str='';
                      
                       jQuery("#stg_loading_"+id).hide();
                       jQuery("#stg_loaded_"+id).show();
                       if (json2.new_file_path!='') 
                       {
                        str += '&nbsp;&nbsp;<strong>AC Statement&nbsp;&nbsp;</strong><img id="new_statement_img" onclick="popup(\'<?=base_url()?>temp_upload_file/'+json2.new_file_path+'\')" style="cursor:pointer;text-align:center" height="18" src="<?=base_url()?>images/icon_xls.gif">';
                       }
                       document.getElementById('statement_xl_'+id).innerHTML = str;
                       if(main_sts==1) //For Main Account Statement File
                       {
                        var str2 = '<img id="file_preview_generated_statement" onclick="popup(\'<?=base_url()?>temp_upload_file/'+json2.new_file_path+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>images/icon_xls.gif">';
                        document.getElementById('hidden_generate_statement').innerHTML = str2;
                        jQuery("#hidden_generated_file_value").val(json2.new_file_path);
                       }
                    }
                  });
              }
              else
              {

                  alert('Filed');
                  jQuery("#st_loading_"+id).hide();
                  jQuery("#st_loaded_"+id).show();
                  jQuery("#generate_"+id).show();
              }
          }
      });
   }
</script>
<style>
   .custtable table{
   color: #333;
   font-family: Helvetica, Arial, sans-serif;
   width: 640px;
   border-collapse:
   collapse; border-spacing: 0;
   margin-top:15px;
   table-layout: fixed;
   }
   .custtable td, .custtable th {
   border: 1px solid #ccc; 
   height: 25px;
   transition: all 0.3s; 
   }
   table {
   border-collapse: collapse;
   table-layout: fixed;
   }
   table#preview_table td {
   border: 1px solid #c7c7c7;
   word-wrap:break-word
   }
   .custtable th {
   background: #DFDFDF;  
   font-weight: bold;
   padding-left:5px;
   padding-right:5px;
   text-align: left;
   }
   .custtable td {
   background: #FAFAFA;
   padding-left:5px;
   padding-right:5px;
   text-align: left;
   word-wrap:break-word
   }
   .custtable tr:nth-child(even) td { background: #F1F1F1; }  
   .custtable tr:nth-child(odd) td { background: #FEFEFE; } 
   .custtable tr:hover{ background: #666; color: #000; } 
   table.preview_table2 td, table.preview_table2 th{
   border: 1px solid #c7c7c7;
   word-wrap:break-word;
   padding:5px;
   }
   #loadStatementDialog-close{
   display: none
   }
</style>
<body style="font-family:calibri">
   <div style="height:30px;background-color:#185891;font-size:22px;padding:5px 0 0 10px;color:white">
      File Processing
   </div>
   <div style="width:96%;margin: auto;paddding: 10px;">
      <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
      <form class="form" name="deliver_form" id="deliver_form" method="post" action="#">
         <input type="hidden" id="deleteEventId" name="deleteEventId" value="<?=$result->id;?>" />
         <input name="type" id="type" value="" type="hidden">	
         <input name="hold_reason" id="hold_reason" value="" type="hidden">  
         <table class="custtable" border="0" style="margin-left:10px;margin-top:10px;width:99%; font-size:15px;border-collapse:collapse">
            <tr>
               <td style="width:12%"><strong>SL No.</strong></td>
               <td style="width:30%"><?=$result->sl_no;?></td>
               <td style="width:12%"><strong>Current/Updated Address</strong></td>
               <td style="width:30%"><?=$result->current_address;?></td>
            </tr>
            <tr>
               <td style="width:12%"><strong>Type of Requisition</strong></td>
               <td style="width:30%"><?=$result->req_type;?></td>
               <td style="width:12%"><strong>Region</strong></td>
               <td style="width:30%"><?=$result->region_name;?></td>
            </tr>
            <tr>
               <td style="width:12%"><strong>Proposed Type</strong></td>
               <td style="width:30%"><?=$result->proposed_type;?></td>
               <td style="width:12%"><strong>Territory </strong></td>
               <td style="width:30%"><?=$result->territory_name;?></td>
            </tr>
            <tr>
               <td style="width:12%"><strong><?if($result->proposed_type=='Loan'){echo "Loan A/C No.";}else{echo "Card No.";}?></strong></td>
               <td style="width:30%"><?=$result->loan_ac;?></td>
               <td style="width:12%"><strong>District</strong></td>
               <td style="width:30%"><?=$result->district_name;?></td>
            </tr>
            <tr>
               <td style="width:12%"><strong>CIF </strong></td>
               <td style="width:30%"><?=$result->cif;?></td>
               <td style="width:12%"><strong>Unit Office (code)</strong></td>
               <td style="width:30%"><?=$result->unit_office_name;?></td>
            </tr>
            <tr>
               <td style="width:12%"><strong><?if($result->proposed_type=='Loan'){echo "Loan A/C Name.";}else{echo "Name on Card";}?></strong></td>
               <td style="width:30%"><?=$result->ac_name;?></td>
               <td style="width:12%"><strong>Loan Sanction Date </strong></td>
               <td style="width:30%"><?=$result->loan_sanction_dt;?></td>
            </tr>
            <tr>
               <td style="width:12%"><strong>Borrower Name</strong></td>
               <td style="width:30%"><?=$result->brrower_name;?></td>
               <td style="width:12%"><strong>Initiate By</strong></td>
               <td style="width:30%"><?=$result->e_by;?></td>
            </tr>
            <tr>
               <td style="width:12%"><strong>Spouse Name</strong></td>
               <td style="width:30%"><?if($result->sub_type==3 && $result->spouse_name!=''){echo $result->spouse_name;}else{echo "N/A";}?></td>
               <td style="width:12%"><strong>Initiate Date Time</strong></td>
               <td style="width:30%"><?=$result->e_dt;?></td>
            </tr>
            <tr>
               <td style="width:12%"><strong>Chq Expiry Date</strong></td>
               <td style="width:30%"><?=$result->chq_expiry_date;?></td>
               <td style="width:12%"><strong>Call Up File</strong></td>
               <td style="width:30%">
                  <?php if ($result->call_up_file!=''): ?>
                  <img id="file_preview" onclick="popup('<?=base_url()?>cma_file/call_up_file/<?=$result->call_up_file?>')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png">
                  <?php endif ?>
               </td>
            </tr>
            <tr>
               <td style="width:12%"><strong>Last Payment Date</strong></td>
               <td style="width:30%"><?=$result->last_payment_date;?></td>
               <td style="width:12%">Legal Region</td>
               <td style="width:30%">
                  <?=$result->legal_region_name;?>
               </td>
            </tr>
            <?php if ($result->proposed_type=='Loan'): ?>
               <?php if (!empty($facility_info)): ?>
                  <tr>
                     <td colspan="4">
                        </br>
                        <div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
                           <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Generate Statement</span>
                           <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="table-layout: fixed;border-collapse: collapse;border-color:#c0c0c0;background-color:#eaeaea;width:97%;margin:20px" >
                              <tbody>
                                 <tr>
                                    <td width="100%">
                                       <table style="width: 90%;float:left" border="1">
                                          <tr>
                                             <td width="20%" style="text-align:center"><strong>Loan AC</strong></td>
                                             <td width="20%" style="text-align:center"><strong>AC Name</strong></td>
                                             <td width="10%" style="text-align:center"><strong>Int Rate</strong></td>
                                             <td width="10%" style="text-align:center"><strong>Date From</strong></td>
                                             <td width="10%" style="text-align:center"><strong>Date To</strong></td>
                                             <td width="30%" style="text-align:center">
                                                <strong>Generate</strong>
                                             </td>
                                          </tr>
                                          <?php $count=1; foreach ($facility_info as $key): ?>
                                          <?php if ($key->ac_number==$result->loan_ac): ?>
                                             <?php $main_ac = 1; ?>
                                          <?php else: ?>
                                             <?php $main_ac = 0; ?>
                                          <?php endif ?>
                                             <tr>
                                                <td style="text-align:center"><strong><?=$key->ac_number;?></strong></td>
                                                <td style="text-align:center"><strong><?=$key->ac_name;?></strong></td>
                                                <td style="text-align:center"><strong><?=$key->int_rate;?></strong></td>
                                                <td style="text-align:center"><input type="text" style="width:80px" name="date_from_<?=$key->id?>" placeholder="dd/mm/yyyy"  id="date_from_<?=$key->id?>" value="" ><script type="text/javascript" charset="utf-8">datePicker ("date_from_<?=$key->id?>");</script></td>
                                                <td style="text-align:center"><input type="text" style="width:80px" name="date_to_<?=$key->id?>" placeholder="dd/mm/yyyy"  id="date_to_<?=$key->id?>" value="" ><script type="text/javascript" charset="utf-8">datePicker ("date_to_<?=$key->id?>");</script></td>
                                                <td style="text-align:center">
                                                     <input name="generate" id="generate_<?=$key->id?>" onclick="generate_statement_loan(<?=$key->id?>,<?=$main_ac?>)" class="crmbutton small create"  value="Generate Statement" type="button">
                                                     <span id="st_loading_<?=$key->id?>" style="display:none">Loading Statement&nbsp;&nbsp;&nbsp;<img src="<?=base_url()?>images/progress.gif" align="bottom" style="width:auto;height:15px"></span>
                                                     <span id="st_loaded_<?=$key->id?>" style="display:none">Statement Loaded&nbsp;&nbsp;&nbsp;<img src="<?=base_url()?>images/publish_g.png" align="bottom" ></span></br>
                                                     <span id="stg_loading_<?=$key->id?>" style="display:none">Generating Statement&nbsp;&nbsp;&nbsp;<img src="<?=base_url()?>images/progress.gif" align="bottom" style="width:auto;height:15px"></span>
                                                     <span id="stg_loaded_<?=$key->id?>" style="display:none">Statement Generated&nbsp;&nbsp;&nbsp;<img src="<?=base_url()?>images/publish_g.png" align="bottom" ></span></br>
                                                      &nbsp;&nbsp;&nbsp;<span id="statement_xl_<?=$key->id?>"></span>
                                                      <!-- &nbsp;&nbsp;&nbsp;<input name="save" id="save_<?=$key->id?>" onclick="save_statement(<?=$key->id?>)" class="crmbutton small create"  value="Save Statement" type="button" style="display:none"> -->
                                                </td>
                                             </tr>
                                          <?php $count++; endforeach ?>
                                       </table>
                                       <table style="width: 10%;float:left" border="0">
                                          <tr>
                                             <td style="text-align:center"><strong>Libality Statement</strong></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="<?=$count-1?>" style="vertical-align: middle;text-align:center"><strong></strong></td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </td>
                  </tr>
               <?php endif ?>
            <?php endif ?>
            
            <?php if ($result->proposed_type=='Card'): ?>
               <?php if (!empty($facility_info)): ?>
                  <tr>
                     <td colspan="4">
                        </br>
                        <div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
                           <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Generate Statement</span>
                           <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="table-layout: fixed;border-collapse: collapse;border-color:#c0c0c0;background-color:#eaeaea;width:97%;margin:20px" >
                              <tbody>
                                 <tr>
                                    <td width="100%">
                                       <table style="width: 100%;float:left" border="1">
                                          <tr>
                                             <td width="20%" style="text-align:center"><strong>Card No</strong></td>
                                             <td width="20%" style="text-align:center"><strong>Card Type</strong></td>
                                             <td width="20%" style="text-align:center"><strong>Card Name</strong></td>
                                             <td width="30%" style="text-align:center">
                                                <strong>Generate</strong>
                                             </td>
                                          </tr>
                                          <?php $count=1; foreach ($facility_info as $key): ?>
                                          <?php if ($key->card_type=='Basic'): ?>
                                             <?php $main_ac = 1; ?>
                                          <?php else: ?>
                                             <?php $main_ac = 0; ?>
                                          <?php endif ?>
                                             <tr>
                                                <td style="text-align:center"><strong><?=$key->card_no;?></strong></td>
                                                <td style="text-align:center"><strong><?=$key->card_type;?></strong></td>
                                                <td style="text-align:center"><strong><?=$key->card_name;?></strong></td>
                                                <td style="text-align:center">
                                                     <input name="generate" id="generate_<?=$key->id?>" onclick="generate_statement_card(<?=$key->id?>,<?=$main_ac?>)" class="crmbutton small create"  value="Generate Statement" type="button">
                                                     <span id="st_loading_<?=$key->id?>" style="display:none">Loading Statement&nbsp;&nbsp;&nbsp;<img src="<?=base_url()?>images/progress.gif" align="bottom" style="width:auto;height:15px"></span>
                                                     <span id="st_loaded_<?=$key->id?>" style="display:none">Statement Loaded&nbsp;&nbsp;&nbsp;<img src="<?=base_url()?>images/publish_g.png" align="bottom" ></span></br>
                                                     <span id="stg_loading_<?=$key->id?>" style="display:none">Generating Statement&nbsp;&nbsp;&nbsp;<img src="<?=base_url()?>images/progress.gif" align="bottom" style="width:auto;height:15px"></span>
                                                     <span id="stg_loaded_<?=$key->id?>" style="display:none">Statement Generated&nbsp;&nbsp;&nbsp;<img src="<?=base_url()?>images/publish_g.png" align="bottom" ></span></br>
                                                      &nbsp;&nbsp;&nbsp;<span id="statement_xl_<?=$key->id?>"></span>
                                                      <!-- &nbsp;&nbsp;&nbsp;<input name="save" id="save_<?=$key->id?>" onclick="save_statement(<?=$key->id?>)" class="crmbutton small create"  value="Save Statement" type="button" style="display:none"> -->
                                                </td>
                                             </tr>
                                          <?php $count++; endforeach ?>
                                       </table>
                                       <!-- <table style="width: 10%;float:left" border="0">
                                          <tr>
                                             <td style="text-align:center"><strong>Libality Statement</strong></td>
                                          </tr>
                                          <tr>
                                             <td rowspan="<?=$count-1?>" style="vertical-align: middle;text-align:center"><strong>asdf</strong></td>
                                          </tr>
                                       </table> -->
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </td>
                  </tr>
               <?php endif ?>
            <?php endif ?>
            <tr>
               <td colspan="4">
                  </br>
                  <div style="background-color:#eaeaea;padding:10px;margin:0 0px;padding-top:20px;">
                     <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">File Delivary Info</span>
                     <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="table-layout: fixed;border-collapse: collapse;border-color:#c0c0c0;background-color:#eaeaea;width:97%;margin:20px" >
                        <tbody>
                           <tr>
                              <td width="100%">
                                 <table style="width: 50%;float:left" border="0">
                                    <tr>
                                       <td width="30%" style="border:0px"><strong>Legal Region</strong></td>
                                       <td width="70%" style="border:0px">
                                          <div id="legal_region" name="legal_region" tabindex="1" style="padding-left: 3px" onchange="get_user_data_region_wise()"></div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td width="30%" style="border:0px"><strong>Legal User</strong> <span style="color:#FF0000">*</span></td>
                                       <td width="70%" style="border:0px">
                                          <div id="legal_user" name="legal_user" tabindex="2" style="padding-left: 3px"></div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td width="20%" style="border:0px"><strong>Balance Date</strong> <span style="color:green">*</span></td>
                                       <td width="80%" style="border:0px"><input type="text" tabindex="3" style="width:250px" name="belance_dt" placeholder="dd/mm/yyyy"  id="belance_dt" value="<?=isset($result->st_belance_dt)?date_format(date_create($result->st_belance_dt),"d/m/Y"):''?>" ><script type="text/javascript" charset="utf-8">datePicker ("belance_dt");</script></td>
                                    </tr>
                                    <tr>
                                       <td width="20%" style="border:0px"><strong>Balance</strong> <span style="color:green">*</span></td>
                                       <td width="80%" style="border:0px"><input type="text" tabindex="4" style="width:250px" name="belance" id="belance" onKeyPress="return numbersonly(this,event,true)" value="<?=isset($result->st_belance)?$result->st_belance:''?>">
                                       </td>
                                    </tr>
                                 </table>
                                 <table style="width: 50%;float:left" border="0">
                                    <div style="height: 20px;text-align: center;"><span id="spnerrormsg" class="errormsg" style="color:green;display:none"></span></div>
                                    <tr>
                                       <td width="50%" style="border:0px"><strong>Generated Statement</strong></td>
                                       <td width="50%" style="border:0px">
                                          <? if($result->generated_statement!=''){ ?>
                                          <input type="hidden" id="hidden_generated_file_value" name="hidden_generated_file_value" value="1">
                                          <span id="hidden_generate_statement"><img id="file_preview_generated_statement" onclick="popup('<?=base_url()?>cma_file/generated_statement/<?=$result->generated_statement?>')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>images/icon_xls.gif"></span>
                                          <? }else{ ?>
                                          <span id="hidden_generate_statement"></span>
                                          <input type="hidden" id="hidden_generated_file_value" name="hidden_generated_file_value" value="">
                                          <? } ?>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td width="50%" style="border:0px"><strong>Upload Statement</strong></td>
                                       <td width="50%" style="border:0px">
                                          <img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList('statement','uploaded_statement')"/>
                                          <input type="hidden" id="hidden_uploaded_statement_select" name="hidden_uploaded_statement_select" value="0">
                                          <? if($result->uploaded_statement!=''){ ?>
                                          <span id="hidden_uploaded_statement"><img id="file_preview_uploaded_statement" onclick="popup('<?=base_url()?>cma_file/uploaded_statement/<?=$result->uploaded_statement?>')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>
                                          <input type="hidden" id="hidden_uploaded_statement_value" name="hidden_uploaded_statement_value" value="<?=$result->uploaded_statement?>">
                                          <img id="file_delete_uploaded_statement" onclick="file_delete('uploaded_statement')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">
                                          <input type="hidden" id="file_delete_value_uploaded_statement" name="file_delete_value_uploaded_statement" value="0">
                                          <? }else{ ?>
                                          <span id="hidden_uploaded_statement"></span>
                                          <? } ?>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </td>
            </tr>
         </table>
         <table  align="center" style="font-size:15px !important;margin-bottom:20px !important" border="0" cellspacing="0" cellpadding="2">
            <tr align="center">
               <td style="border:0px; vertical-align:top;">		
                  <br/>
                  <br/>
                  &nbsp;&nbsp;&nbsp;
                  <input type="button" value="Deliver" id="sendButton" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
                  <input type="button" value="Hold" id="holdButton" onclick="delete_action('hold')" class="btn-small btn-small-normal enabledElem" style="display: inline;;cursor:pointer;font-size:16px;" />
                  <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><br/>
                  </br></br></br>
               </td>
            </tr>
         </table>
      </form>
   </div>
   <div id="sendToCheckerMessageDialogContent"  style="display:none;">
      <div class="hd">
         <h2 class="conf" style="margin-top:0px">Do you want to <span id="message"></span>?</h2>
      </div>
      <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform"  style="margin:0px;">
         <input name="success_message" id="success_message" value="" type="hidden">
         <div class="bd" id="reason_message_body">
             <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
             <div class="instrText" style="margin-bottom: 20px"></div>
             <div class="instrText" style="margin-bottom: 20px">
               <span id="reason_message"></span>: <span style="color: red;">*</span> <br><textarea name="reason" id="reason" cols="50"></textarea><br><br>
               <!-- Notify By:&nbsp;&nbsp;
               <label>
                  <input type="checkbox" name="email_notification" id="email_notification" value=""> Email
               </label> -->
                  &nbsp;&nbsp;&nbsp;
             </div>
           </div>
         <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_submit()"><span id="button_tag"></span></a> 
         <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a> 
         <span id="loadingReturn" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
      </form>
   </div>
   <!-- For Load Statement -->
   <div id="loadStatementDialogContent"  style="display:none;">
      <div id="loading-overlay">
         <div class="loading-icon"></div>
      </div>
      <div class="hd">
         <h2 class="conf" style="margin:0px 0px"><span id="header_message"></span></h2>
         <span style="color:red;" class="login-text">(It Will Take Some Time)</span>
      </div>
      <form method="POST" name="loadStatementform" id="loadStatementform"  style="margin:0px;">
         <input name="loan_ac" id="loan_ac" value="<?=$result->loan_ac;?>" type="hidden">
         <input name="event_id" id="event_id" value="<?=$result->id;?>" type="hidden">
         <div class="bd">
            <div class="inlineError" id="loadStatementErrorMsg" style="display:none"></div>
            <div class="instrText" style="margin-bottom: 20px"></div>
         </div>
         <a class="btn-small btn-small-normal" id="loadStatementDialogConfirm" onclick="load_statement()">Load</a> 
         <a class="btn-small btn-small-secondary" id="loadStatementDialogCancel" onclick="close_window_statement()"><span>Cancel</span></a> 
         <span id="loadingstatement" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
      </form>
   </div>
   <div id="r_history" style="visibility:hidden;">
      <div style="padding-left: 17px"><strong>Return/Reject History</strong></div>
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
            <tfoot>
               <tr>
                  <td colspan="5" align="center"></br></br><input type="button" class="button1" id="r_ok" value="Close" /></td>
               </tr>
            </tfoot>
         </table>
         <br>
      </div>
   </div>

