<style type="text/css">
    #details {
     font-family: Arial, Helvetica, sans-serif;
     border-collapse: collapse;
     width: 100%;
   }
</style>
<script language="javascript" type="text/javascript">
    var proposed_type = ["Loan", "Card"];
    var int_type = ["Simple", "Compound"];
    jQuery().ready(function() {
        jQuery("#loan_ac").val('');
        jQuery("#hidden_loan_ac").val('');
        var theme = getDemoTheme();
        jQuery("#proposed_type").jqxComboBox({theme: theme, width: 100, autoOpen: false, autoDropDownHeight: false, promptText: "Select Proposed Type", source: proposed_type, height: 25});
        jQuery("#int_type").jqxComboBox({theme: theme, width: 80, autoOpen: false, autoDropDownHeight: false, promptText: "Int. Type", source: int_type, height: 25});
        jQuery('#proposed_type,#int_type').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
        jQuery("#proposed_type").jqxComboBox('val','Loan');
        change_caption();
        jQuery('#proposed_type').bind('change', function (event) {
            jQuery("#loan_ac").val('');
            jQuery("#hidden_loan_ac").val('');
            change_caption();       
        });
        jQuery("#generate").click(function () {
            jQuery("#statement_data").html('');
            document.getElementById('statement_xl').innerHTML = '';
            //jQuery("#loader_td").hide();
            jQuery("#xl_td").hide();
            jQuery("#st_loaded").hide();
            jQuery("#stg_loaded").hide();
            var validationResult = function (isValid) {
                if (isValid) {
                    jQuery("#generate").hide();
                    jQuery("#grid_loading").show();
                    load_statement();
                }
            }
            jQuery('#form').jqxValidator('validate', validationResult);
         });
        jQuery('#form').jqxValidator({
                rules: [
                    { input: '#proposed_type', message: 'required!', action: 'blur,change', rule: function (input) {                    
                    if(input.val() != '')
                    {
                        var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='proposed_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#proposed_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#loan_ac', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#loan_ac").val()=='')
                    {
                        jQuery("#loan_ac").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                    
                }
                },
                { input: '#loan_ac', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabaticwithstar('loan_ac'))
                        {
                            jQuery("#loan_ac").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#loan_ac', message: 'must be 16 digits', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length<16 || input.val().length>16)
                        {
                            jQuery("#loan_ac").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#int_type', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#int_type").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='int_type']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#int_type input").focus();
                        return false;
                    }
                }  
                },
                { input: '#int_rate', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#int_rate").val()=='')
                    {
                        jQuery("#int_rate").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#int_rate', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                   if(input.val() != '')
                   {
                      if(!checknumber_alphabatic('int_rate'))
                      {
                         jQuery("#int_rate").focus();
                         return false;

                      }
                   }
                   return true;

                } },
                { input: '#outstanding_bl', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#outstanding_bl").val()=='')
                    {
                        jQuery("#outstanding_bl").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#outstanding_bl', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                   if(input.val() != '')
                   {
                      if(!checknumber_alphabatic('outstanding_bl'))
                      {
                         jQuery("#outstanding_bl").focus();
                         return false;

                      }
                   }
                   return true;

                } },
                { input: '#total_legal_cost', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#total_legal_cost").val()=='')
                    {
                        jQuery("#total_legal_cost").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#total_legal_cost', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                   if(input.val() != '')
                   {
                      if(!checknumber_alphabatic('total_legal_cost'))
                      {
                         jQuery("#total_legal_cost").focus();
                         return false;

                      }
                   }
                   return true;

                } },
                { input: '#dt_from', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#dt_from").val()=='')
                    {
                        jQuery("#dt_from").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#dt_from', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                    if (!input.val()) {
                        return true;
                    }
                    if(validate_date(input.val()))
                    {
                        return true;
                    }else {
                        jQuery("#dt_from").focus();
                        return false;
                    }
                } },
                { input: '#l_dt_from', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#l_dt_from").val()=='')
                    {
                        jQuery("#l_dt_from").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#l_dt_from', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                    if (!input.val()) {
                        return true;
                    }
                    if(validate_date(input.val()))
                    {
                        return true;
                    }else {
                        jQuery("#l_dt_from").focus();
                        return false;
                    }
                } },
                // {input: '#dt_from', message: 'Advance date not allow!', action: 'change', rule: function(input) {
                //         if(input.val()!=""){return validateDate(input.val(),'advance');}else{return true;}
                //     }
                // },
                { input: '#dt_to', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#dt_to").val()=='')
                    {
                        jQuery("#dt_to").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#dt_to', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                    if (!input.val()) {
                        return true;
                    }
                    if(validate_date(input.val()))
                    {
                        return true;
                    }else {
                        jQuery("#dt_to").focus();
                        return false;
                    }
                } },
                // {input: '#dt_to', message: 'Advance date not allow!', action: 'change', rule: function(input) {
                //         if(input.val()!=""){return validateDate(input.val(),'advance');}else{return true;}
                //     }
                // },
                { input: '#dt_to', message: 'Old Date Not allowed !', action: 'change', rule: function(input,commit){  
                        if(input.val()!="") { return expiry_dt_validation('dt_from','dt_to'); } else{return true;}
                  }
                },
                { input: '#l_dt_to', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#l_dt_to").val()=='')
                    {
                        jQuery("#l_dt_to").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#l_dt_to', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                    if (!input.val()) {
                        return true;
                    }
                    if(validate_date(input.val()))
                    {
                        return true;
                    }else {
                        jQuery("#l_dt_to").focus();
                        return false;
                    }
                } },
                { input: '#l_dt_to', message: 'Old Date Not allowed !', action: 'change', rule: function(input,commit){  
                        if(input.val()!="") { return expiry_dt_validation('l_dt_from','l_dt_to'); } else{return true;}
                  }
                }
                
                ]
            });
    });
    function expiry_dt_validation(from_dt_field,to_dt_field){
        date1=jQuery("#"+from_dt_field).val();
           
        var str_subsdt = date1.split("/")
        var subsdt = str_subsdt[1]+"/"+str_subsdt[0]+"/"+str_subsdt[2];
        var subdt = new Date(subsdt);

        date2=jQuery("#"+to_dt_field).val();
       
        var str_subsdt2 = date2.split("/")
        var subsdt2 = str_subsdt2[1]+"/"+str_subsdt2[0]+"/"+str_subsdt2[2];
        var subdt2 = new Date(subsdt2);

        if(Date.parse(subdt) > Date.parse(subdt2)){
        return false;
        }

        return true;
    }
    function change_caption()
    {   
        if (jQuery("#proposed_type").val()=='') 
        {
            document.getElementById("loan_ac").disabled = true;
            jQuery("#l_or_c_no").html('Loan/Card');
            jQuery("#int_rate_tr").show();
        }
        else
        {
            document.getElementById("loan_ac").disabled = false;
            var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
            if (item.value=='Loan') {
                jQuery("#l_or_c_no").html('Loan A/C ');
                jQuery("#int_rate_tr").show();
            }
            else if(item.value=='Card'){
                jQuery("#l_or_c_no").html('Card');
                jQuery("#int_rate_tr").hide();
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
    function load_statement()
    {
        jQuery("#statement_data").html('');
        document.getElementById('statement_xl').innerHTML = '';
        jQuery("#save").hide();
        jQuery("#deleteEventId").val('');
        jQuery("#prev_statement").val('');
        jQuery("#jari_id").val('');
        var postData = jQuery('#form').serialize();
        jQuery("#st_loading").show();
        //jQuery("#loader_td").show();
        jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: '<?=base_url()?>index.php/hoops/load_jari_statement/',
                data : postData,
                datatype: "json",
                success: function(response){
                  ///console.log(response);
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str='';
                    if(json.str!='')
                    {
                        jQuery("#st_loading").hide();
                        jQuery("#st_loaded").show();

                        jQuery("#generate").show();
                        jQuery("#grid_loading").hide();

                        jQuery("#statement_data").html(json.str);
                        jQuery("#xl_td").show();
                        jQuery("#jari_id").val(json.jari_id);
                        str = '&nbsp;&nbsp;&nbsp;<strong>Jari Statement&nbsp;&nbsp;</strong><img id="new_statement_img" onclick="popup(\'<?=base_url()?>temp_upload_file/'+json.new_file_path+'\')" style="cursor:pointer;text-align:center" height="18" src="<?=base_url()?>images/icon_xls.gif">';
                        document.getElementById('statement_xl').innerHTML = str;
                        str2 = '&nbsp;&nbsp;&nbsp;<strong>Jari Certificate&nbsp;&nbsp;</strong><a id="inXLadfc" style="cursor:pointer;" href="<?=base_url()?>hoops/download_certificate/'+json.jari_id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/word_icon.gif" style="width:20px;margin-top:-15px"></a>';
                        document.getElementById('statement_certificate').innerHTML = str2;
                    }
                    else
                    {

                        alert(json.str);
                        //jQuery("#loader_td").hide();
                        jQuery("#jari_id").val('');
                        jQuery("#st_loading").hide();
                        jQuery("#st_loaded").show();
                        jQuery("#generate").show();
                        jQuery("#grid_loading").hide();
                    }
                }
            });

    }
    function call_ajax_submit()
    {
        if (jQuery('#deleteEventId').val() == '') {
            alert('Sorry There is no statement!');
            return false;
        }
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var postData = $('sendToCheckerMessageform').toQueryString()+"&"+csrfName+"="+csrfHash;
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
                        }else{
                        sendToCheckerMessageDialog.hide();
                        $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                        $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                        $('loadingReturn').style.display = 'none';
                        jQuery("#save").hide();
                        jQuery("#error").show();
                        jQuery("#error").fadeOut(11500);
                        jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+jQuery("#success_message").val());
                    }
                }
            });

    }
    function delete_action(type) {
        var message='';
        if (type=='save_statement') 
        {
            jQuery("#type").val(type);
            jQuery("#message").html('Save');
            jQuery("#button_tag").html('Save');
            jQuery("#success_message").val('Saved');
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
</script>
<style type="text/css">
    .back_image{
        background-image:url(<?=base_url()?>images/login_images/back_1.jpg);
        background-repeat: no-repeat;
        background-color:transparent;
        background-size: auto;
        _background-size: 1108px 763px;
        background-position: -18px 89%;
    }
    th{border-color: #ccc;}
    #search_area{
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }
</style>

<div id="container" style="">
    <div id="body"  >
        <div  style="display:block; height:auto" id="search_area">
            <form method="POST" name="form" id="form"  style="margin:0px;" action="">
            <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
            <input type="hidden" id="jari_id" value="" name="jari_id">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
               <div style="padding: 0.5%;width:98%;height:65px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                    <table id="deal_body" style="display:block;width:100%">
                        <tr>
                            <td style="text-align:right;width:5%"><strong>Int. Type&nbsp;&nbsp;</strong> </td>
                            <td style="width:8%">
                                 <div style="padding-left:1.8%" id="int_type" name="int_type"></div>
                            </td>
                            <td style="text-align:right;width:8%"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                            <td style="width:10%">
                                 <div style="padding-left:1.8%" id="proposed_type" name="proposed_type"></div>
                            </td>
                            <td style="text-align:right;width:8%"><strong><span id="l_or_c_no"></span> No.</strong> </td>
                            <td style="width:10%"><input name="loan_ac" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac" value="" onKeyUp="javascript:return mask(this.value,this);"/></td>
                            <td style="text-align:right;width:3%"><strong>Int.rate&nbsp;&nbsp;</strong></td>
                            <td style="width:10%">
                                <input name="int_rate" tabindex="" type="text" class="" style="width:100px" id="int_rate" value=""/>
                            </td>
                            <td style="text-align:right;width:3%"><strong>Out.Amount&nbsp;&nbsp;</strong></td>
                            <td style="width:10%">
                                <input name="outstanding_bl" tabindex="" type="text" class="" style="width:100px" id="outstanding_bl" value=""/>
                            </td>
                            <td style="text-align:left;width:6%"><strong>Date From&nbsp;&nbsp;</strong> </td>
                            <td style="width:8%"><input id="dt_from" name="dt_from"  style="width:80%" /><script type="text/javascript">datePicker_without_advance("dt_from");</script></td>
                            <td style="text-align:left;width:1%"><strong>To </td>
                            <td style="width:8%"><input id="dt_to" name="dt_to"  style="width:80%" /><script type="text/javascript">datePicker_without_advance("dt_to");</script></td>
                            <td  style="text-align:right;width:5%">
                                <input name="generate" id="generate" class="crmbutton small create"  value="Generate" type="button">
                                <div style="text-align:center"><span id="grid_loading" style="display:none"><img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                            </td>
                        </tr>
                    </table>
                    <table id="statement_body" style="width:100%">
                        <tr>
                            <td id="loader_td" style="text-align:left;width:24%;">
                                <strong>Legal Cost From&nbsp;&nbsp;</strong>
                                <input id="l_dt_from" name="l_dt_from"  style="width:100px" /><script type="text/javascript">datePicker_without_advance("l_dt_from");</script>&nbsp;&nbsp;
                                <strong>To&nbsp;&nbsp;</strong>
                                <input id="l_dt_to" name="l_dt_to"  style="width:100px" /><script type="text/javascript">datePicker_without_advance("l_dt_to");</script>&nbsp;&nbsp;
                                <strong>Total Legal Cost&nbsp;&nbsp;</strong>
                                <input name="total_legal_cost" tabindex="" type="text" class="" style="width:100px" id="total_legal_cost" value=""/>&nbsp;&nbsp;
                                <span id="st_loading" style="display:none">Loading Statement&nbsp;&nbsp;&nbsp;<img src="<?=base_url()?>images/progress.gif" align="bottom" style="width:auto;height:15px"></span>
                                <span id="st_loaded" style="display:none">Statement Loaded&nbsp;&nbsp;&nbsp;<img src="<?=base_url()?>images/publish_g.png" align="bottom" ></span>
                                <span id="stg_loading" style="display:none">Generating Statement&nbsp;&nbsp;&nbsp;<img src="<?=base_url()?>images/progress.gif" align="bottom" style="width:auto;height:15px"></span>
                                <span id="stg_loaded" style="display:none">Statement Generated&nbsp;&nbsp;&nbsp;<img src="<?=base_url()?>images/publish_g.png" align="bottom" ></span>
                            </td>
                            <td id="xl_td" style="width:20%;display:none;">
                             <span id="statement_xl"></span>&nbsp;&nbsp;&nbsp;
                             <span id="statement_certificate"></span>&nbsp;&nbsp;&nbsp;
                             </td>
                        </tr>
                    </table>
              </div>
            </form>
        </div>
    </div>
</div>
<div class="back_image">
    <span id="statement_data"></span>
</div>


<div id="sendToCheckerMessageDialogContent"  style="display:none;">
        <div class="hd" ><h2 class="conf" style="margin-top:0px">Previous Data will be replace Do you want to <span id="message"></span>?</h2></div>
        <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform"  style="margin-top:0px;">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
           <input name="type" id="type" value="" type="hidden"> 
           <input name="prev_statement" id="prev_statement" value="" type="hidden"> 
           <input name="prev_lib_statement" id="prev_lib_statement" value="" type="hidden"> 
           <input name="success_message" id="success_message" value="" type="hidden">           
            <input type="hidden" id="deleteEventId" name="deleteEventId" value="" />
            <input name="final_dt" id="final_dt" value="" type="hidden"> 
            <input name="final_belance" id="final_belance" value="" type="hidden"> 
            <div class="bd">
              <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
              <div class="instrText" style="margin-bottom: 20px"></div>
            </div>
            <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_submit()"><span id="button_tag"></span></a> 
            <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a> 
            <span id="loadingReturn" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </form>
    </div>
    <script type="text/javascript">
        function printpage(print_area)
        {               
            var pp = window.open();
            pp.document.writeln('<table style="width:100%; text-align:center; font-weight:bold;font-size:9pt;"><tr><td><img ID="PRINT" alt="Print" src="<?=base_url()?>old_assets/images/Print.png" onclick="javascript:location.reload(true);window.print();">&nbsp;<img ID="CLOSE" alt="CLOSE" src="<?=base_url()?>old_assets/images/close.png" onclick="window.close();"><br /><span style="font-weight:normal; color:green; font-size:8pt;" ID="mssgg" >Print in Portrait Page</span></td></tr><tr><td>');
            pp.document.writeln(document.getElementById(print_area).innerHTML);
        }
    </script>
