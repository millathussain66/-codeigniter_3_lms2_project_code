<?php $this->load->view('hc_matter/pages/css'); ?>
<style>
    .newbuttonStyle:hover{
        background-color: #4329ff!important;
        color: #fff!important;
    }
</style>

<script type="text/javascript">
    var theme = 'classic';
    var csrf_tokens='';

    // var type= [{value:"2", label:"Recovery"},{value:"1", label:"Legal"}];
    var arrested = [{value:"1", label:"Yes"},{value:"2", label:"No"},];

    var valid_rule =[];
    var expense_activities = [];

    var loan_segment = [<? $i=1; foreach($loan_segment as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}'; $i++;}?>];
    var deposit_money = [<? $i=1; foreach($appeal_deposit_money as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var hc_division = [<? $i=1; foreach($hc_division as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    //var hc_case_category = [<?// $i=1; foreach($hc_case_category as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    //var hc_case_type = [<? //$i=1; foreach($hc_case_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var step_hc_case_status = [<? $i=1; foreach($hc_case_status as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var hc_case_category =[];
    var hc_case_type =[];


    var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var hc_bench = [<? $i=1; foreach($hc_bench as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.' ('.$row->bench_number.')"}'; $i++;}?>];
    //var hc_bench_number = [<? //$i=1; foreach($hc_bench_number as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var dealing_officer = [<? $i=1; foreach($dealing_officer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.' ('.$row->pin.')"}'; $i++;}?>];
    var hc_dealing_officer = [<? $i=1; foreach($hc_dealing_officer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.' ('.$row->pin.')"}'; $i++;}?>];
    var case_sts = [<? $i=1; foreach($case_sts as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var region = [<? $i=1; foreach($region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

    var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var vendor = [<? $i=1; foreach($paper_vendor as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var hc_activites = [<? $i=1; foreach($hc_activites as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var expense_activities = [];
    var expense_type = [<? $i=1; foreach($request_from as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var staff = [];
    var year = [<? $i=0; for($i;$i<20;$i++){ if($i!=0){echo ',';}$date = date('Y')-$i; echo '{value:"'.$date.'", label:"'.$date.'"}';}?>]; 
    var hc_case_status=[];
    var territory=[];
    var proposed_type =['Loan','Card'];
    //var limit =['5','100','All'];

    jQuery(document).ready(function () {

        jQuery("#expense_type_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: expense_type, width: 180, height: 25});
        jQuery("#district_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 200, height: 25});
        jQuery("#activities_name_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight:150, promptText: "Select Activities", source: hc_activites, width: 200, height: 25});

        jQuery("#s_proposed_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, width: 250, height: 25});
        //jQuery("#limit").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Limit", source: limit, width: 80, height: 25});

        jQuery("#portfolio").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Portfolio", source: loan_segment, width: 250, height: 25});

        jQuery("#proposed_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Proposed Type", source: proposed_type, width: 250, height: 25});
        
        jQuery("#hc_division").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Division", source: hc_division, width: 250, height: 25});
        jQuery("#case_category").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Category", source: hc_case_category, width: 250, height: 25});
        jQuery("#case_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Type", source: hc_case_type, width: 250, height: 25});

        jQuery("#s_hc_division").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Division", source: hc_division, width: 250, height: 25});
        jQuery("#s_case_category").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Category", source: hc_case_category, width: 250, height: 25});
        jQuery("#s_case_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Type", source: hc_case_type, width: 250, height: 25});

        jQuery("#ac_closing_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Status", source: arrested, width: 250, height: 25});
        jQuery("#hc_dealing_officer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Dealing Officer", source: hc_dealing_officer, width: 250, height: 25});
        jQuery("#lower_dealing_officer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lower Dealing Officer", source: dealing_officer, width: 250, height: 25});
        jQuery("#deposited_appeal_money").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Deposited Appeal Money", source: deposit_money, width: 250, height: 25});
        jQuery("#name_dist").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select DIST", source: district, width: 250, height: 25});
        jQuery("#present_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Present status", source: hc_case_status, width: 250, height: 25});
        jQuery("#next_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Next Status", source: step_hc_case_status, width: 250, height: 25});
        jQuery("#hc_bench").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Bench Name", source: hc_bench, width: 250, height: 25});
        //jQuery("#bench_number").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Bench Number", source: hc_bench_number, width: 250, height: 25});
        
        jQuery("#name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
        jQuery("#status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Status", source: arrested, width: 250, height: 25});

        jQuery("#region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: region, width: 250, height: 25});
        //jQuery("#territory").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Territory", source: territory, width: 250, height: 25});
        jQuery("#district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 250, height: 25});
        
        jQuery("#year").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Year", source: year, width: 250, height: 25});

        //jQuery("#group_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: user_group, width: 250, height: 25});

       jQuery("#next_dt_sts").jqxCheckBox({width: 22, theme: theme ,checked:true });

        jQuery('#case_type,#ac_closing_status,#hc_dealing_officer,#lower_dealing_officer,#deposited_appeal_money,#name_dist,#present_status,#next_status,#hc_bench,#status,#proposed_type,#region,#district,#s_proposed_type,#name,#hc_division,#case_category,#s_hc_division,#s_case_category,#s_case_type,#year,#portfolio,#expense_type_1,#district_1,#activities_name_1').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });

        //jQuery('#sendtochecker').jqxButton({template:"success", width: 120, height: 40, theme: theme });
        //jQuery("#limit").jqxComboBox('val','5');
        //jQuery("#s_proposed_type").jqxComboBox('val','Loan');
        s_change_caption();
        jQuery('#s_proposed_type').bind('change', function (event) {
            jQuery("#s_account").val('');
            jQuery("#s_hidden_loan_ac").val('');
            s_change_caption();       
        });

        jQuery("#proposed_type").jqxComboBox('val','Loan');
        change_caption();
        jQuery('#proposed_type').bind('change', function (event) {
            jQuery("#loan_ac").val('');
            jQuery("#hidden_loan_ac").val('');
            change_caption();       
        });

        jQuery('#region').bind('change', function (event) {
            change_dropdown('region');      
        });
        jQuery("#next_dt_sts").bind('change', function (event) {
            var checked = event.args.checked;
            if(checked==true){ 
                jQuery("#next_dt_sts_value").val(1); 
                jQuery("#next_date").val(''); 
                jQuery("#next_date").show();
                jQuery("#next_sts_text").html('');
                jQuery("#next_sts_text").hide();

                           
            }else{
                jQuery("#next_dt_sts_value").val(0); 
                jQuery("#next_date").val(''); 
                jQuery("#next_date").hide(); 
                jQuery("#next_sts_text").html('<strong><?=$sys_config->next_dt_text?></strong>'); 
                jQuery("#next_sts_text").show();
        }
        });

        var html = '';
        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'bill_copy_1\')"/>';
        html+='<input type="hidden" id="hidden_bill_copy_1_select" name="hidden_bill_copy_1_select" value="0">';
        html+='<span id="hidden_bill_copy_1">';
        jQuery('#bill_copy_1').html(html);

        //jQuery('#territory').bind('change', function (event) {
           // change_dropdown('territory');       
        //});
        
        //jQuery('#district').bind('change', function (event) {
            //change_dropdown('district');        
        //});

        var rule = [];
        jQuery('#present_status').bind('change', function (event) {
            rule=[];
            jQuery('#action_form').jqxValidator('hide');
            jQuery('#status_form').jqxValidator('hide');
            jQuery("#court_name").val('');
            jQuery("#lcr_memo_no").val('');
            jQuery("#memo_date").val('');
            jQuery("#gp_no").val('');
            jQuery("#gp_date").val('');
            jQuery("#wp_amount").val('');
            jQuery("#withdrawn_date").val('');
            jQuery("#sts_date").val('');
            jQuery("#name").val('');

            jQuery("#m_no").hide();
            jQuery("#m_dt").hide();
            jQuery("#g_no").hide();
            jQuery("#g_dt").hide();
            jQuery("#status_id").hide();
            jQuery("#status_date").hide();
            jQuery("#nameg").hide();
            jQuery("#w_amount").hide();
            jQuery("#w_date").hide();
            jQuery("#c_name").hide();

            jQuery("#status").jqxComboBox('clearSelection');
            var item = jQuery("#present_status").jqxComboBox('getSelectedItem');
            if (item!=null) {
                var rule1 = [];
                if(item.value==3){
                    jQuery("#status_id").show();
                    jQuery("#m_no").show();
                    jQuery("#m_dt").show();
                    jQuery("#g_no").show();
                    jQuery("#g_dt").show();
                    rule1 =[
                        { input: '#status', message: 'required!', action: 'blur,change', rule: function(input,commit){
                                if(input.val() != '')
                                    {
                                        var item = jQuery("#status").jqxComboBox('getSelectedItem');
                                        if(item != null){jQuery("input[name='status']").val(item.value);}
                                        return true;                
                                    }
                                    else
                                    {
                                        //jQuery("#portfolio input").focus();
                                        return false;
                                    }
                            }
                        },
                        { input: '#lcr_memo_no', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                                if(jQuery("#lcr_memo_no").val()=='')
                                {
                                    //jQuery("#account_no").focus();
                                    return false;
                                }
                                else
                                {
                                    return true;
                                }    
                            }
                        },
                        { input: '#memo_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                                if (input.val()!='') {
                                    return true;
                                }
                                else {
                                    return false;
                                }
                            } 
                        },
                        { input: '#memo_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                                if (!input.val()) {
                                    return true;
                                    }
                                    if(validate_date(input.val()))
                                    {
                                        return true;
                                    }else {
                                        return false;
                                    }
                                } 
                        },
                        { input: '#gp_no', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                                if(jQuery("#gp_no").val()=='')
                                {
                                    //jQuery("#account_no").focus();
                                    return false;
                                }
                                else
                                {
                                    return true;
                                }    
                            }
                        },
                        { input: '#gp_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                                if (input.val()!='') {
                                    return true;
                                    }
                                    else {
                                        return false;
                                    }
                            } 
                        },
                        { input: '#gp_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                            if (!input.val()) {
                                return true;
                                }
                                if(validate_date(input.val()))
                                {
                                    return true;
                                }else {
                                    return false;
                                }
                            } 
                        },
                    ];
                    rule = rule1;  
                }
                else if(item.value==4){
                    jQuery("#status_id").show();
                    jQuery("#status_date").show();
                    jQuery("#nameg").show();
                    rule1 =[
                        { input: '#status', message: 'required!', action: 'blur,change', rule: function(input,commit){
                                if(input.val() != '')
                                    {
                                        var item = jQuery("#status").jqxComboBox('getSelectedItem');
                                        if(item != null){jQuery("input[name='status']").val(item.value);}
                                        return true;                
                                    }
                                    else
                                    {
                                        //jQuery("#portfolio input").focus();
                                        return false;
                                    }
                            }
                        }, 
                        { input: '#name', message: 'required!', action: 'blur,change', rule: function(input,commit){
                                if(input.val() != '')
                                    {
                                        var item = jQuery("#name").jqxComboBox('getSelectedItem');
                                        if(item != null){jQuery("input[name='name']").val(item.value);}
                                        return true;                
                                    }
                                    else
                                    {
                                        //jQuery("#portfolio input").focus();
                                        return false;
                                    }
                            }
                        },
                        
                    ];
                    rule = rule1;
                }
                else if(item.value==8 || item.value==19){
                    jQuery("#status_id").show();
                    rule1 =[
                        { input: '#status', message: 'required!', action: 'blur,change', rule: function(input,commit){
                                if(input.val() != '')
                                    {
                                        var item = jQuery("#status").jqxComboBox('getSelectedItem');
                                        if(item != null){jQuery("input[name='status']").val(item.value);}
                                        return true;                
                                    }
                                    else
                                    {
                                        //jQuery("#portfolio input").focus();
                                        return false;
                                    }
                            }
                        },
                    ];
                    rule = rule1;
                }
                else if(item.value==11){
                    jQuery("#status_id").show();
                    jQuery("#status_date").show();
                    jQuery("#c_name").show();
                    rule1 =[
                        { input: '#status', message: 'required!', action: 'blur,change', rule: function(input,commit){
                                if(input.val() != '')
                                    {
                                        var item = jQuery("#status").jqxComboBox('getSelectedItem');
                                        if(item != null){jQuery("input[name='status']").val(item.value);}
                                        return true;                
                                    }
                                    else
                                    {
                                        //jQuery("#portfolio input").focus();
                                        return false;
                                    }
                            }
                        },
                        { input: '#court_name', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                                if(jQuery("#court_name").val()=='')
                                {
                                    //jQuery("#account_no").focus();
                                    return false;
                                }
                                else
                                {
                                    return true;
                                }    
                            }
                        },
                        
                    ];
                    rule = rule1;
                }
                else if(item.value==12){
                    jQuery("#m_no").show();
                    jQuery("#m_dt").show();
                    jQuery("#g_no").show();
                    jQuery("#g_dt").show();
                    rule1 =[
                        { input: '#lcr_memo_no', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                                if(jQuery("#lcr_memo_no").val()=='')
                                {
                                    //jQuery("#account_no").focus();
                                    return false;
                                }
                                else
                                {
                                    return true;
                                }    
                            }
                        },
                        { input: '#memo_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                                if (input.val()!='') {
                                    return true;
                                }
                                else {
                                    return false;
                                }
                            } 
                        },
                        { input: '#memo_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                                if (!input.val()) {
                                    return true;
                                    }
                                    if(validate_date(input.val()))
                                    {
                                        return true;
                                    }else {
                                        return false;
                                    }
                                } 
                        },
                        { input: '#gp_no', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                                if(jQuery("#gp_no").val()=='')
                                {
                                    //jQuery("#account_no").focus();
                                    return false;
                                }
                                else
                                {
                                    return true;
                                }    
                            }
                        },
                        { input: '#gp_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                                if (input.val()!='') {
                                    return true;
                                    }
                                    else {
                                        return false;
                                    }
                            } 
                        },
                        { input: '#gp_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                            if (!input.val()) {
                                return true;
                                }
                                if(validate_date(input.val()))
                                {
                                    return true;
                                }else {
                                    return false;
                                }
                            } 
                        },
                    ];
                    rule = rule1;
                }
                else if(item.value==13){
                    jQuery("#w_amount").show();
                    jQuery("#w_date").show();
                    rule1 =[
                        
                        { input: '#wp_amount', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                                if(jQuery("#wp_amount").val()=='')
                                {
                                    //jQuery("#account_no").focus();
                                    return false;
                                }
                                else
                                {
                                    return true;
                                }    
                            }
                        },
                        { input: '#withdrawn_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                                if (input.val()!='') {
                                    return true;
                                }
                                else {
                                    return false;
                                }
                            } 
                        },
                        { input: '#withdrawn_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                                if (!input.val()) {
                                    return true;
                                    }
                                    if(validate_date(input.val()))
                                    {
                                        return true;
                                    }else {
                                        return false;
                                    }
                                } 
                        },
                        
                    ];
                    rule = rule1;
                }
                else if(item.value==18){
                    jQuery("#status_date").show();
                    rule1 =[
                        { input: '#sts_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                                if (input.val()!='') {
                                    return true;
                                }
                                else {
                                    return false;
                                }
                            } 
                        },
                        { input: '#sts_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                                if (!input.val()) {
                                    return true;
                                    }
                                    if(validate_date(input.val()))
                                    {
                                        return true;
                                    }else {
                                        return false;
                                    }
                                } 
                        },
                        
                    ];
                    rule = rule1;
                }
                else
                {
                    jQuery("#status_id").show();
                     rule1 =[
                        { input: '#status', message: 'required!', action: 'blur,change', rule: function(input,commit){
                                if(input.val() != '')
                                    {
                                        var item = jQuery("#status").jqxComboBox('getSelectedItem');
                                        if(item != null){jQuery("input[name='status']").val(item.value);}
                                        return true;                
                                    }
                                    else
                                    {
                                        //jQuery("#portfolio input").focus();
                                        return false;
                                    }
                            }
                        },
                    ];
                    rule = rule1;
                }
            }
            else{
                jQuery("#status_id").hide();
                jQuery("#status_date").hide();
                jQuery("#nameg").hide();
            }
            jQuery('#click').click();
        });

        jQuery('#status').bind('change', function (event) {
            jQuery('#sts_date').val('');
            jQuery('#action_form').jqxValidator('hide');
            jQuery('#status_form').jqxValidator('hide');
            var item = jQuery("#status").jqxComboBox('getSelectedItem');
            if (item!=null) {
                //alert(item.value)
                if (item.value==1)
                {
                    var item = jQuery("#present_status").jqxComboBox('getSelectedItem');
                    if (item!=null) {
                        
                        if(item.value==3 || item.value==8 || item.value==19 || item.value>19){
                            jQuery("#status_date").hide();
                        }else{
                            jQuery("#status_date").show();
                            rule1 =[
                                { input: '#sts_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                                        if (input.val()!='') {
                                            return true;
                                        }
                                        else {
                                            return false;
                                        }
                                    } 
                                },
                                { input: '#sts_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                                        if (!input.val()) {
                                            return true;
                                            }
                                            if(validate_date(input.val()))
                                            {
                                                return true;
                                            }else {
                                                return false;
                                            }
                                        } 
                                },
                                
                            ];

                            rule = rule.concat(rule1);
                        }
                    }else{
                        jQuery("#status_date").hide();

                    }
                    //jQuery("#name").hide();
                }
                else
                {
                    rule.forEach(function(number,index) {
                        if(number.input=='#sts_date'){
                            rule.splice(index, 2);
                            //console.log(index);
                        }
                    });
                    jQuery("#status_date").hide();
                    //jQuery("#name").hide();
                }

            }
            else{
                //jQuery("#status_id").hide();
                jQuery("#status_date").hide();
                //jQuery("#name").hide();
            }
            jQuery('#click').click();
        });
        
        // Add edit form validation

        jQuery('#action_form').jqxValidator({
            focus: true,
            position: 'left',
            rules: [
            /*{ input: '#proposed_type', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='proposed_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                }
            },
            { input: '#loan_ac', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#loan_ac").val()=='')
                {
                    //jQuery("#account_no").focus();
                    return false;
                }
                else
                {
                    return true;
                }    
            }
            },
            { input: '#loan_ac', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit){
                    if(input.val() != ''){
                        if(!checknumber_alphabaticwithstar('loan_ac'))
                        {
                           // jQuery("#account_no").focus();
                            return false;

                        }
                    }
                    return true;

                } 
            },
            { input: '#loan_ac', message: 'must be 16 digits', action: 'keyup, blur, change', rule: function (input, commit)
             {
                if(input.val() != '')
                {
                    if(input.val().length<16 || input.val().length>16)
                    {
                        //jQuery("#account_no").focus();
                        return false;

                    }
                }
                return true;

            } },*/
            /*{ input: '#account_name', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#account_name").val()=='')
                {
                        //jQuery("#account_name").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            },*/
            /*{ input: '#case_claim', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#case_claim").val()=='')
                {
                        //jQuery("#account_name").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            },*/
            { input: '#present_casue_action', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#present_casue_action").val()=='')
                    {
                    return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            },
            { input: '#portfolio', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#portfolio").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='portfolio']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#portfolio input").focus();
                            return false;
                        }
                }
            },
            
            /*{ input: '#assigned_lawyer', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#assigned_lawyer").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='assigned_lawyer']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#assigned_lawyer input").focus();
                            return false;
                        }
                }
            },*/
            { input: '#hc_dealing_officer', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#hc_dealing_officer").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='hc_dealing_officer']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#hc_dealing_officer input").focus();
                            return false;
                        }
                }
            },
            { input: '#lower_dealing_officer', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    var division = jQuery("#hc_division").jqxComboBox('getSelectedItem');
                    if(jQuery("#hc_type").val()=='Recase' && division.value==1)
                    {
                        
                        if(input.val() != '' )
                        {
                        var item = jQuery("#lower_dealing_officer").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='lower_dealing_officer']").val(item.value);}
                        return true; 
                        }
                        else
                        {
                            //jQuery("#hc_dealing_officer input").focus();
                            return false;
                        }               
                    }
                    else
                    {
                        return true; 
                    }
                }
            },
            { input: '#hc_division', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#hc_division").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='hc_division']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#case_type input").focus();
                            return false;
                        }
                }
            },
            { input: '#case_category', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#case_category").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='case_category']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#case_type input").focus();
                            return false;
                        }
                }
            },
            { input: '#case_type', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#case_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='case_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#case_type input").focus();
                            return false;
                        }
                }
            },
            { input: '#name_dist', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#name_dist").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='name_dist']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#name_dist input").focus();
                            return false;
                        }
                }
            },
            { input: '#present_status', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#present_status").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='present_status']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#present_status input").focus();
                            return false;
                        }
                }
            },
            { input: '#hc_bench', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#hc_bench").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='hc_bench']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#hc_bench input").focus();
                            return false;
                        }
                }
            },
            /*{ input: '#bench_number', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#bench_number").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='bench_number']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#hc_bench input").focus();
                            return false;
                        }
                }
            },*/
            { input: '#ac_closing_status', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#ac_closing_status").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='ac_closing_status']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            //jQuery("#ac_closing_status input").focus();
                            return false;
                        }
                }
            },
           
            /*
            { input: '#deposited_appeal_money', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#deposited_appeal_money").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='deposited_appeal_money']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#deposited_appeal_money input").focus();
                            return false;
                        }
                }
            },*/
            

            { input: '#last_activities', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#last_activities").val()=='')
                {
                        //jQuery("#case_no").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            },

            { input: '#case_no', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#case_no").val()=='')
                {
                        //jQuery("#case_no").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            },
            { input: '#case_no', message: 'already exits!', action: 'change', rule: function(input,commit){
                    if(jQuery("#case_no").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        var case_no=jQuery("#case_no").val();
                        if(duplicate_check(case_no)==0){
                            return true;
                        }
                        return false;
                        
                    }
                }
            },
            { input: '#case_claim', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit){
                    if(input.val() != ''){
                        if(!checknumber_alphabaticDot('case_claim'))
                        {
                            //jQuery("#case_claim").focus();
                            return false;

                        }
                    }
                    return true;

                } 
            },
            { input: '#case_claim', message: 'Amount must be Greater-than 0', action: 'keyup, blur, change', rule: function (input, commit){
                    if(input.val() != '')
                    {
                        if(input.val()<1)
                        {
                            //jQuery("#case_claim").focus();
                            return false;

                        }
                    }
                    return true;

                } 
            },
            { input: '#next_date', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                if(jQuery("#next_date").val()=='' && jQuery("#next_dt_sts_value").val()==1)
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
            },
            { input: '#next_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                if (!input.val()) {
                    return true;
                }
                //if(validate_date(input.val()))
                if(validateDate(input.val(),'back_equal'))
                {
                    return true;
                }else {
                    return false;
                }
            } },
            
            /*{ input: '#filing_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                        }
                        else {
                            return false;
                        }
                } 
            },*/
            { input: '#filing_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                if (!input.val()) {
                    return true;
                    }
                    if(validateDate(input.val(),'advance'))
                    {
                        return true;
                    }else {
                        return false;
                    }
                } 
            },
            /*{ input: '#file_receive_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                        }
                        else {
                            return false;
                        }
                } 
            },
            { input: '#file_receive_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                if (!input.val()) {
                    return true;
                    }
                    if(validate_date(input.val()))
                    {
                        return true;
                    }else {
                        return false;
                    }
                } 
            },*/
            
        ]
        });
        
        jQuery('#click').click(function(){

            jQuery('#status_form').jqxValidator({
                focus: true,
                position: 'left',
                rules: rule, 
                theme: theme
            });
            //console.log(rule[0].input);
            //console.log(rule);
                
        });
        // Jqx tab second tab function start    Grid Show
        var initGrid2 = function () {
            var source ={
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'int'},
                    { name: 'hc_matter_type', type: 'string'},
                    { name: 'ac_number', type: 'string'},
                    { name: 'ac_name', type: 'string'},
                    { name: 'case_no', type: 'string'},
                    { name: 'case_sts_name', type: 'string'},
                    { name: 'case_claim', type: 'string'},
                    { name: 'present_cause_action', type: 'string'},
                    { name: 'remarks', type: 'string'},
                    { name: 'ac_closing_status', type: 'string'},
                    { name: 'district_name', type: 'string'},
                    { name: 'hc_bench_name', type: 'string'},
                    //{ name: 'bench_number', type: 'string'},
                    { name: 'division_name', type: 'string'},
                    { name: 'case_category_name', type: 'string'},
                    { name: 'hc_type_name', type: 'string'},
                    { name: 'lawyer_name', type: 'string'},
                    { name: 'hc_officer', type: 'string'},
                    { name: 'lower_officer', type: 'string'},
                    //{ name: 'assigned_lawyer_name', type: 'string'},
                    { name: 'filing_date', type: 'string'},
                    { name: 'last_act', type: 'string'},
                    { name: 'proposed_type', type: 'string'},
                    { name: 'file_receive_date', type: 'string'},
                    { name: 'status', type: 'string'},
                    { name: 'sts', type: 'sts'},        
                    { name: 'v_sts', type: 'sts'},        
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
                url: '<?=base_url()?>index.php/hc_matter/grid',
                cache: false,
                filter: function()
                {
                    // update the grid and send a request to the server.
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'filter');
                },
                sort: function()
                {
                    // update the grid and send a request to the server.
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata', 'sort');
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
                loadError: function(xhr, status, error){
                    alert(error);
                }
            });
            var columnCheckBox = null;
            var updatingCheckState = false;
            // initialize jqxGrid. Disable the built-in selection.
            var celledit = function (row, datafield, columntype) {
                var checked = jQuery('#jqxGrid2').jqxGrid('getcellvalue', row, "available");
                if (checked == false) {
                  return false;
                };
            };
            var win_h=jQuery( window ).height()-280;
            jQuery("#jqxGrid2").jqxGrid({
                width:'100%',
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
                rendergridrows: function(obj){
                    return obj.data;
                },
                columns: [

                    { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
                    { text: 'v_sts', datafield: 'v_sts',hidden:true },
                    { text: 'sts', datafield: 'sts',hidden:true },
                    <? if(DELETE==1){?>
                        { text: 'D', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'delete\')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
                            }
                            else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                    <?php } ?>
                    <?php if(EDIT==1){ ?>
                    { text: 'E', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%', cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                            
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                        }
                        else
                        {
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                        }
                        }
                    },
                    <?php } ?>
                    <?php if(SENDTOCHECKER==1){ ?>
                    { text: 'STC', menu: false, datafield: 'sendtochecker', align:'center', editable: false, sortable: false, width: '4%', cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35 || dataRecord.v_sts == 90){
                            
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                        }else if(dataRecord.v_sts == 37){
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">S</div>';
                        }
                        else
                        {
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                        }
                        }
                    },
                    <?php } ?>
                    <? if(VERIFY==1){?>
                        { text: 'V', menu: false, datafield: 'Verify', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 37){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'verify\')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
                            }else if(dataRecord.v_sts == 38){
                                 return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">V</div>';
                            }
                            else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                    <?php } ?>
                   
                    { text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);

                        return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                          }
                    },

                    { text: 'Status', datafield: 'status',editable: false, width: '10%'},
                    
                    { text: 'Division Name', datafield: 'division_name',editable: false, width: '15%'},                    { text: 'Case Category', datafield: 'case_category_name',editable: false, width: '15%'},
                    { text: 'Case Type', datafield: 'hc_type_name',editable: false, width: '10%'},
                    { text: 'Case Status', datafield: 'case_sts_name',editable: false, width: '20%'},
                    { text: 'Rule Number', datafield: 'case_no',editable: false, width: '13%'},
                    { text: 'Case Claim', datafield: 'case_claim',editable: false, width: '10%'},
                    { text: 'Proposed Type', datafield: 'proposed_type',editable: false, width: '10%'},
                    { text: 'Account Name', datafield: 'ac_name',editable: false, width: '13%'},
                    { text: 'Account', datafield: 'ac_number',editable: false, width: '13%'},
                    { text: 'Cause Action', datafield: 'present_cause_action',editable: false, width: '13%'},
                    { text: 'Filing Date', datafield: 'filing_date',editable: false, width: '10%'},
                    { text: 'Last Activities', datafield: 'last_act',editable: false, width: '13%'},
                    { text: 'Remarks', datafield: 'remarks',editable: false, width: '13%'},
                    { text: 'Account Closing Status', datafield: 'ac_closing_status',editable: false, width: '10%'},
                    { text: 'District Name', datafield: 'district_name',editable: false, width: '13%'},
                    { text: 'HC Bench', datafield: 'hc_bench_name',editable: false, width: '13%'},
                    //{ text: 'Bench Number', datafield: 'bench_number',editable: false, width: '13%'},
                    //{ text: 'HC Lawyer', datafield: 'assigned_lawyer_name',editable: false, width: '13%'},
                    
                ],
                        
            });
               
            jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:550, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#verifycancel,#checkercancel") });
            jQuery('#details').on('close', function (event) {
                jQuery('#delete_convence').jqxValidator('hide');
                
            });
           
        }
        
        // jqx tab init
        var initWidgets = function (tab) {
            switch (tab) {
                case 0:
                    break;
                case 1:
                    initGrid2();
                    break;
            }
        }
        //document.getElementById("jqxTabs").style.minHeight = "280px";
        jQuery('#jqxTabs').jqxTabs({ width: '99%', initTabContent: initWidgets });
        
        jQuery('#jqxTabs').bind('selected', function (event) {

            if(event.args.item==0){
                clear_form();
                reload();
                //jQuery('#jqxTabs').jqxTabs('disableAt', 1);
            }
            jQuery('#action_form').jqxValidator('hide');
            //clear_form();
        });
        <?php if(ADD!=1 && EDIT!=1 ){?>
        jQuery('#jqxTabs').jqxTabs('disableAt', 0);
        jQuery('#jqxTabs').jqxTabs('select', 1);
        <?php  } ?>
        // Add Form Submit
        jQuery("#in_req_button").click( function() {
            var sts_valid = jQuery('#status_form').jqxValidator('validate');
            var x=jQuery("#add_expense").is(":checked");

            var validationResult = function (isValid) {
                if (isValid && sts_valid==true) {
                    if(x==true){
                        if(expense_validation()==true){
                            jQuery("#in_req_button").hide();
                            jQuery("#in_req_loading").show();
                            //jQuery("#legal_notice_form").submit();
                            call_ajax_submit();
                        }
                    }else{
                        jQuery("#in_req_button").hide();
                        jQuery("#in_req_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
            }
            jQuery('#action_form').jqxValidator('validate', validationResult);        
        });
        // Update Edit Form Submit
        jQuery("#in_up_button").click( function() {
            var sts_valid = jQuery('#status_form').jqxValidator('validate');
            var x=jQuery("#add_expense").is(":checked");
            var validationResult = function (isValid) {
                if (isValid && sts_valid==true) {
                    if(x==true){
                        if(expense_validation()==true){
                        jQuery("#in_up_button").hide();
                        jQuery("#in_up_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                        }
                    }else{
                        jQuery("#in_up_button").hide();
                        jQuery("#in_up_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        call_ajax_submit();
                    }
                }
            }
            jQuery('#action_form').jqxValidator('validate', validationResult);        
        });
        // Delete Form Validation 
        jQuery('#delete_convence').jqxValidator({
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
        // Delete Ajax call
        jQuery("#delete_button").click(function () {
            
            var validationResult = function (isValid) {
                if (isValid) {
                    jQuery("#delete_button").hide();
                    jQuery("#deletecancel").hide();
                    jQuery("#delete_loading").show();
                    delete_submit();
                }
            }
            jQuery('#delete_convence').jqxValidator('validate', validationResult);
         });

        jQuery("#verify_button").click(function () {
                jQuery('#type').val('verify');
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verify_button").hide();
                jQuery("#verifycancel").hide();
                jQuery("#verify_row").show();
                jQuery("#verify_loading").show();
                delete_submit();
            
         });
        jQuery("#verify_reject").click(function () {
            jQuery("#verify_return_row").show();
            jQuery('#type').val('verify_reject');
            if(jQuery("#return_reason_verify").val()=='')
            {
               alert('Please Give Return Reason');
                jQuery("#return_reason_verify").focus();
                return false; 
            }
            else
            {
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verifycancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
            }
        });
        jQuery("#verify_return").click(function () {
            jQuery("#verify_return_row").show();
            jQuery('#type').val('verify_return');
            if(jQuery("#return_reason_verify").val()=='')
            {
               alert('Please Give Return Reason');
                jQuery("#return_reason_verify").focus();
                return false; 
            }
            else
            {
                jQuery("#verify_return_row").hide();
                jQuery("#verify_return").hide();
                jQuery("#verify_reject").hide();
                jQuery("#verifycancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
            }
        });
        jQuery("#checker_button").click(function () {
            
                jQuery("#checker_button").hide();
                jQuery("#checkercancel").hide();
                jQuery("#checker_loading").show();
                delete_submit();
            
         });
       
    });
function s_mask(str,textbox){
    var item = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
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
                jQuery("#s_hidden_loan_ac").val(str);
            }
            else//For single value enter
            {
                //For New value
                var orginal_loan_ac=jQuery("#s_hidden_loan_ac").val();
                if (orginal_loan_ac.length<str.length) 
                {
                    var index = str.length-1;
                    var new_val=str.slice(index);
                    orginal_loan_ac+=new_val;
                    //alert(orginal_loan_ac);
                    jQuery("#s_hidden_loan_ac").val(orginal_loan_ac);
                }
                //For delete key
                else{
                    var len=str.length;
                    var new_val=orginal_loan_ac.slice(0,len);
                    jQuery("#s_hidden_loan_ac").val(new_val);
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
                      if (letter_Count<6 || jQuery("#s_hidden_loan_ac").val().length!=16) 
                      {
                        textbox.value = '';
                        jQuery("#s_hidden_loan_ac").val('');
                        alert('Wrong way to input Card No please try again');
                      }
                }
            }
        }
    }
    
}
function s_change_caption(){   
    if (jQuery("#s_proposed_type").val()=='') 
    {
        document.getElementById("loan_ac").disabled = true;
        jQuery("#s_l_or_c_no").html('Loan A/C or Card');
    }
    else
    {
        document.getElementById("s_account").disabled = false;
        var item = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
        if (item.value=='Loan') {
            jQuery("#s_l_or_c_no").html('Loan A/C ');
        }
        else if(item.value=='Card'){
            jQuery("#s_l_or_c_no").html('Card');
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

function duplicate_check(case_no){
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    var editrow = jQuery('#edit_row').val();
    var rows=0;
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_matter/case_exit_check",
        data : {[csrfName]: csrfHash,case_no:case_no,editrow:editrow},
        datatype: "json",
        async:false,
        success: function(response){
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            rows = json.row_info;
            
        }
    });
    return rows;

}
function call_ajax_submit(){
    
    var postdata = jQuery('#action_form').serialize();
    var add_edit = jQuery("#add_edit").val();
    var edit_row = jQuery("#edit_row").val();
    
    //console.log(postdata);
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_matter/add_edit_action/"+add_edit+"/"+edit_row,
        data : postdata,
        datatype: "json",
        async:false,
        success: function(response){
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            //console.log(json);
            //csrf_tokens=json.csrf_token;
            if(json.Message!='OK')
            {
                if(add_edit=='edit'){
                    jQuery("#in_up_loading").hide();
                    jQuery("#in_up_button").show();
                    jQuery('#jqxTabs').jqxTabs('select', 1);
                    
                }else{
                    jQuery("#in_req_button").show();
                    jQuery("#in_req_loading").hide();
                }
                var err = json.Message.split(" ");
                if(err[1]!='out'){jQuery("#"+err[1]).focus();}
                alert(json.Message);
                
                return false;
            }
            var msg='';
            if(edit_row>0){
                msg='Updated';
            }else{
                msg="Saved";
            }
            
            jQuery("#error").show();
            jQuery("#error").fadeOut(11500);
            jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+msg);
            if(add_edit=='edit'){
                jQuery("#in_up_loading").hide();
                jQuery("#in_up_button").show();
                jQuery('#jqxTabs').jqxTabs('select', 1);
            }else{
                jQuery("#in_req_button").show();
                jQuery("#in_req_loading").hide();
            }
            jQuery("#jqxGrid2").jqxGrid('updatebounddata');
           
            jQuery('#s_account').val('');
            jQuery('#s_case_number').val('');
            jQuery('#searchTable').html('');
            reload();
            
        }
    });
}
function select_onchange(from_id,to_id,dropdown_name){
    var item='';
    if(dropdown_name=='division'){
        item = jQuery("#"+from_id).jqxComboBox('getSelectedItem');
    }else if(dropdown_name=='category'){
        item = jQuery("#"+from_id).jqxComboBox('getSelectedItem');
    }else if(dropdown_name=='type'){
        item = jQuery("#"+from_id).jqxComboBox('getSelectedItem');
    }
    
    if (item!=null)
    {
        var case_type = item.value;
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
        url: '<?=base_url()?>index.php/hc_matter/get_case_status',
        async:false,
        type: "post",
        data: { [csrfName]: csrfHash,case_type : case_type,dropdown_name:dropdown_name},
        datatype: "json",
        success: function(response){
           // console.log(response);
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var str='';
            var theme = getDemoTheme();
            if(dropdown_name=='division'){
                var category = [];
                jQuery.each(json['row_info'],function(key,obj){
                    category.push({ value: obj.id, label: obj.name });
                    //alert(obj.name);
                });
                //console.log(present_status);
                jQuery("#"+to_id).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Category", source: category, width: 250, height: 25});
                jQuery("#"+to_id).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
                });
            }else if(dropdown_name=='category'){
                var case_type = [];
                jQuery.each(json['row_info'],function(key,obj){
                    case_type.push({ value: obj.id, label: obj.name });
                    //alert(obj.name);
                });
                //console.log(present_status);
                jQuery("#"+to_id).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Type", source: case_type, width: 250, height: 25});
                jQuery("#"+to_id).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
                });
            }else if(dropdown_name=='type'){
                var present_status = [];
                jQuery.each(json['row_info'],function(key,obj){
                    present_status.push({ value: obj.id, label: obj.name });
                    //alert(obj.name);
                });
                //console.log(present_status);
                jQuery("#"+to_id).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Present status", source: present_status, width: 250, height: 25});
                jQuery("#"+to_id).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
                });
            }
            
        },
        error:   function(model, xhr, options){
            alert('failed');
        },
        });
    }
    else
    {
        jQuery("#present_status").jqxComboBox('clearSelection');
        jQuery("#present_status").val('');
    }
}

function get_case_status(){
    var item = jQuery("#case_type").jqxComboBox('getSelectedItem');
    if (item!=null)
    {
        var case_type = item.value;
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
        url: '<?=base_url()?>index.php/hc_matter/get_case_status',
        async:false,
        type: "post",
       data: { [csrfName]: csrfHash,case_type : case_type},
        datatype: "json",
        success: function(response){
           // console.log(response);
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var str='';
            var theme = getDemoTheme();
                    var present_status = [];
                    jQuery.each(json['row_info'],function(key,obj){
                        present_status.push({ value: obj.id, label: obj.name });
                        //alert(obj.name);
                    });
                    //console.log(present_status);
                    jQuery("#present_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Present status", source: present_status, width: 250, height: 25});
                    jQuery('#present_status').focusout(function() {
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
        jQuery("#present_status").jqxComboBox('clearSelection');
        jQuery("#present_status").val('');
    }
}

function delete_submit(){
    var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
    var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
    var postData = jQuery('#delete_convence').serialize()+"&"+csrfName+"="+csrfHash;
    //console.log(postData);
    //return false
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: '<?=base_url()?>index.php/hc_matter/delete_action/',
        data : postData,
        datatype: "json",
        success: function(response){

            var json = jQuery.parseJSON(response);
            //console.log(json);
            jQuery('.txt_csrfname').val(json.csrf_token);
            if(json.Message!='OK')
            {                               
                if ($('type').value=='delete') 
                {
                    jQuery("#delete_button").show();
                    jQuery("#deletecancel").show();
                    jQuery("#delete_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }else if ($('type').value=='verify') 
                {
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_button").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }else if ($('type').value=='verify_reject') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                    
                }else if ($('type').value=='verify_return') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }else if($('type').value=='sendtochecker')
                {
                    jQuery("#checker_button").show();
                    jQuery("#checkercancel").show();
                    jQuery("#checker_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }else
                {
                    jQuery("#sendtochecker").show();
                    jQuery("#SendTocheckercancel").show();
                    jQuery("#checker_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }
                return false;
            }else{

                if ($('type').value=='delete') 
                {
                    jQuery("#delete_button").show();
                    jQuery("#deletecancel").show();
                    jQuery("#delete_loading").hide();
                }else if ($('type').value=='verify') 
                {
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_button").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                }else if ($('type').value=='verify_reject') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    
                }else if ($('type').value=='verify_return') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                }else if ($('type').value=='sendtochecker') 
                {

                    jQuery("#checker_button").show();
                    jQuery("#checkercancel").show();
                    jQuery("#checker_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    
                }
                else
                {
                    jQuery("#sendtochecker").show();
                    jQuery("#SendTocheckercancel").show();
                    jQuery("#checker_loading").hide();
                }
                var msz='';
                jQuery("#error").show();
                jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                jQuery('#details').jqxWindow('close');
                jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                        
            }
        }
    });
}
function edit(id,editrow){
    clear_form();    
    jQuery('#jqxTabs').jqxTabs('select', 0);
    jQuery('#search_box').hide();
    jQuery("#add_button").hide();
    jQuery('#case_form').show();
    jQuery("#up_button").show();
    jQuery("#in_up_button").show();
    jQuery('#add_edit').val('edit');
    
    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
   // console.log(dataRecord);
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_matter/get_case_edit_info",
        data : {[csrfName]: csrfHash,id:id},
        datatype: "json",
        async:false,
        success: function(response){
            //console.log(response);
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;
            console.log(rows);
            var expense = json.expenses;
            //console.log(json.expenses);
            var sts_data = jQuery.parseJSON(rows.data_field);
            if(rows.hc_division==2){
                 jQuery('#proposed_tr').hide(); 
            }else{
               jQuery('#proposed_tr').show();   
            }
           
            jQuery('#hc_dealing_officer').jqxComboBox('clearSelection');
            jQuery('#hc_dealing_officer').jqxComboBox('val',rows.hc_dealing_officer!=0?rows.hc_dealing_officer:'');
            jQuery('#deposited_appeal_money').jqxComboBox('clearSelection');
            jQuery('#deposited_appeal_money').jqxComboBox('val',rows.deposit_am_50!=0?rows.deposit_am_50:'');
            jQuery('#portfolio').jqxComboBox('clearSelection');
            jQuery('#portfolio').jqxComboBox('val',rows.portfolio);
            jQuery('#proposed_type').jqxComboBox('clearSelection');
            jQuery('#proposed_type').jqxComboBox('val',rows.proposed_type);

            jQuery('#region').jqxComboBox('clearSelection');
            jQuery('#region').jqxComboBox('val',rows.region);
            //jQuery('#territory').jqxComboBox('clearSelection');
            //jQuery('#territory').jqxComboBox('val',rows.territory);
            jQuery('#district').jqxComboBox('clearSelection');
            jQuery('#district').jqxComboBox('val',rows.district);
            
            jQuery('#lower_dealing_officer').jqxComboBox('clearSelection');
            jQuery('#lower_dealing_officer').jqxComboBox('val',rows.lower_dealing_officer!=0?rows.lower_dealing_officer:'');
            //jQuery('#assigned_lawyer').jqxComboBox('clearSelection');
            //jQuery('#assigned_lawyer').jqxComboBox('val',rows.assigned_lawyer!=0?rows.assigned_lawyer:'');
            jQuery('#name_dist').jqxComboBox('clearSelection');
            jQuery('#name_dist').jqxComboBox('val',rows.name_dist!=0?rows.name_dist:'');
            jQuery('#hc_division').jqxComboBox('clearSelection');
            jQuery('#hc_division').jqxComboBox('val',rows.hc_division!=0?rows.hc_division:'');
            jQuery('#case_category').jqxComboBox('clearSelection');
            jQuery('#case_category').jqxComboBox('val',rows.case_category!=0?rows.case_category:'');
            jQuery('#case_type').jqxComboBox('clearSelection');
            jQuery('#case_type').jqxComboBox('val',rows.case_type!=0?rows.case_type:'');
            jQuery('#present_status').jqxComboBox('clearSelection');
            jQuery('#present_status').jqxComboBox('val',rows.present_status!=0?rows.present_status:'');
            jQuery('#hc_bench').jqxComboBox('clearSelection');
            jQuery('#hc_bench').jqxComboBox('val',rows.hc_bench!=0?rows.hc_bench:'');
            //jQuery('#bench_number').jqxComboBox('clearSelection');
            //jQuery('#bench_number').jqxComboBox('val',rows.bench_number!=0?rows.bench_number:'');
            jQuery('#ac_closing_status').jqxComboBox('clearSelection');
            jQuery('#ac_closing_status').jqxComboBox('val',rows.ac_closing_status!=0?rows.ac_closing_status:'');
            jQuery("#loan_ac").val(rows.ac_number);
            if(rows.proposed_type=='Card'){
                jQuery("#hidden_loan_ac").val(rows.org_ac_number);
            }
            jQuery("#req_type").val(rows.req_type);
            jQuery("#last_activities").val(rows.last_act);
            jQuery("#account_name").val(rows.ac_name);
            jQuery("#case_no").val(rows.case_no);
            jQuery("#file_receive_date").val(rows.file_receive_date);
            jQuery("#case_claim").val(rows.case_claim!=0?rows.case_claim:'');
            jQuery("#filing_date").val(rows.filing_date);
            jQuery("#last_act").val(rows.last_act);
            jQuery("#present_casue_action").val(rows.present_cause_action);
            jQuery("#remarks").val(rows.remarks);
            jQuery("#withdrawn_date").val(rows.am_withdrawn_date);
            jQuery("#amount_appeal_money").val(rows.amount_am_money!=0?rows.amount_am_money:'');

            if(rows.present_status==3){
                jQuery('#status').jqxComboBox('clearSelection');
                jQuery('#status').jqxComboBox('val',sts_data.sts_3_type!=0?sts_data.sts_3_type:'');
                jQuery("#lcr_memo_no").val(sts_data.sts_3_memo_no);
                jQuery("#memo_date").val(sts_data.sts_3_memo_dt);
                jQuery("#gp_no").val(sts_data.sts_3_gp_no);
                jQuery("#gp_date").val(sts_data.sts_3_gp_dt);
            }else if(rows.present_status==4){
                jQuery('#status').jqxComboBox('clearSelection');
                jQuery('#status').jqxComboBox('val',sts_data.sts_4_type!=0?sts_data.sts_4_type:'');
                jQuery('#name').jqxComboBox('clearSelection');
                jQuery('#name').jqxComboBox('val',sts_data.sts_4_name!=0?sts_data.sts_4_name:'');
                if(sts_data.sts_4_type==1){
                    jQuery("#sts_date").val(sts_data.sts_4_date);
                }
            }else if(rows.present_status==8){
                jQuery('#status').jqxComboBox('clearSelection');
                jQuery('#status').jqxComboBox('val',sts_data.sts_8_type!=0?sts_data.sts_8_type:'');
            }else if(rows.present_status==19){
                jQuery('#status').jqxComboBox('clearSelection');
                jQuery('#status').jqxComboBox('val',sts_data.sts_19_type!=0?sts_data.sts_19_type:'');
            }else if(rows.present_status==11){
                jQuery('#status').jqxComboBox('clearSelection');
                jQuery('#status').jqxComboBox('val',sts_data.sts_11_type!=0?sts_data.sts_11_type:'');
                jQuery("#court_name").val(sts_data.sts_11_cname);
                if(sts_data.sts_11_type==1){
                    jQuery("#sts_date").val(sts_data.sts_11_date);
                }
            }else if(rows.present_status==12){
                jQuery("#lcr_memo_no").val(sts_data.sts_12_memo_no);
                jQuery("#memo_date").val(sts_data.sts_12_memo_dt);
                jQuery("#gp_no").val(sts_data.sts_12_gp_no);
                jQuery("#gp_date").val(sts_data.sts_12_gp_dt);
            }else if(rows.present_status==13){
                jQuery("#wp_amount").val(sts_data.sts_13_amount);
                jQuery("#withdrawn_date").val(sts_data.sts_13_date);
            }else if(rows.present_status==18){
                jQuery("#sts_date").val(sts_data.sts_18_date);
            }else{
                jQuery('#status').jqxComboBox('clearSelection');
                if(rows.present_status>19){
                    var sid = 'sts_type';
                    var sdt = 'sts_date';
                    //alert(rows[sid]);
                    jQuery('#status').jqxComboBox('val',rows[sid]!=0?sts_data[sid]:'');
                    if(sts_data[sid]==1){
                        jQuery("#sts_date").val(sts_data[sdt]);
                    }
                }else{
                    var sid = 'sts_'+rows.present_status+'_type';
                    var sdt = 'sts_'+rows.present_status+'_date';
                    //alert(rows[sid]);
                    jQuery('#status').jqxComboBox('val',rows[sid]!=0?sts_data[sid]:'');
                    if(sts_data[sid]==1){
                        jQuery("#sts_date").val(sts_data[sdt]);
                    }
                }
                
            }

            if (rows.next_dt_sts==1)
            {
                jQuery('#next_dt_sts').jqxCheckBox({ checked:true }); 
                jQuery("#next_dt_sts_value").val(1); 
                jQuery('#next_date').val(rows.next_date);
                jQuery("#next_date").show();
                jQuery("#next_sts_text").html('');
                jQuery("#next_sts_text").hide();
            
            }else
            {
               jQuery('#next_dt_sts').jqxCheckBox({ checked:false }); 
               jQuery("#next_dt_sts_value").val(0); 
                jQuery("#next_date").val(''); 
                jQuery("#next_date").hide(); 
                jQuery("#next_sts_text").html('<strong><?=$sys_config->next_dt_text?></strong>'); 
                jQuery("#next_sts_text").show();
            }
            jQuery('#next_status').jqxComboBox('clearSelection');
            jQuery('#next_status').jqxComboBox('val',rows.next_status!=0?rows.next_status:'');
            jQuery('#year').jqxComboBox('clearSelection');
            jQuery('#year').jqxComboBox('val',rows.year!=0?rows.year:'');
            jQuery('#hc_id').val(rows.hist_id);
            jQuery('#hc_type').val(rows.hc_matter_type);
            jQuery('#edit_row').val(rows.id);

            // Expense
            //jQuery('#add_expense').checked;
            if(expense.length>0){
                jQuery('#add_expense').prop('checked', true);
            }else{
                jQuery('#add_expense').prop('checked', false);
            }
            expense.forEach(function(row,index) {
                //console.log(row);
                var theme = getDemoTheme();
                if(index>0){
                var counter = jQuery('#expense_counter').val();
                var new_counter = parseInt(counter) + 1;
                html_string = '';

                    html_string += '<tr id="expense_'+new_counter+'">';
                    html_string += '<td>';
                    html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="">';
                    html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                    html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                    html_string += '</td>';
                    html_string += '<td><div id="expense_type_'+new_counter+'" name="expense_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange="change_vendor(\'expense_type_'+new_counter+'\','+new_counter+')"></div></td>';
                    html_string += '<td><div id="district_'+new_counter+'" name="district_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data('+new_counter+')"></div><div id="vendor_id_'+new_counter+'" name="vendor_id_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none" ></div><input name="vendor_name_'+new_counter+'" type="text" class="" style="width:98%" id="vendor_name_'+new_counter+'" /></td>';
                    html_string += '<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" _onchange="get_expense_amount(\'activities_name_'+new_counter+'\','+new_counter+')"></div></td>';
                    html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:90%;" id="activities_date_'+new_counter+'" value="" ></td>';
                    html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
                    html_string += '<td><span id="bill_copy_'+new_counter+'"></span></td>';
                    html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
                    html_string += '</tr>';

                jQuery('#expense_' + counter).after(html_string);
                jQuery('#expense_counter').val(new_counter);
                
                jQuery('#expense_type_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Vendor Type", source: expense_type, height: 25});
                jQuery('#expense_type_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
                });
                jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 200, autoOpen: false, autoDropDownHeight: false,dropDownHeight:150, promptText: "Select Activity", source: hc_activites, height: 25});
                jQuery('#activities_name_'+new_counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                jQuery('#district_'+new_counter).jqxComboBox({theme: theme, width: 200, autoOpen: false, autoDropDownHeight: false, promptText: "Select District", source: district, height: 25});
                jQuery('#district_'+new_counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                datePicker('activities_date_'+new_counter);
                }
                var num = index+1;
                //get_expense_activities(type,counter,req_type)
                
                
                jQuery('#expense_type_'+num).jqxComboBox('clearSelection');
                jQuery('#district_'+num).jqxComboBox('clearSelection');
                jQuery('#vendor_id_'+num).jqxComboBox('clearSelection');
                jQuery('#activities_name_'+num).jqxComboBox('clearSelection');
                
                jQuery("#expense_type_"+num).jqxComboBox('val',row.expense_type);
                //change_vendor('expense_type_'+num,num);
                //get_dropdown_data(num);        
                if(row.expense_type==6){
                    vendor_name_3
                    jQuery('#vendor_name_'+num).val(row.vendor_name);
                }else{     
                    jQuery("#district_"+num).jqxComboBox('val',row.district);
                    jQuery("#vendor_id_"+num).jqxComboBox('val',row.vendor_id);
                }
                jQuery("#activities_name_"+num).jqxComboBox('val',row.activities_name);
                jQuery('#activities_date_'+num).val(row.activities_date);
                jQuery('#amount_'+num).val(row.amount);
                jQuery('#remarks_'+num).val(row.remarks);
                jQuery('#expense_edit_'+num).val(row.id);
                var appeal_bail_bill_copy=row.appeal_bail_bill_copy;
                var html = '';
                html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'bill_copy_'+num+'\')"/>';
                html+='<input type="hidden" id="hidden_bill_copy_'+num+'_select" name="hidden_bill_copy_'+num+'_select" value="0">';
                if(appeal_bail_bill_copy!='' && appeal_bail_bill_copy!=null)
                {
                    html +='<span id="hidden_bill_copy_'+num+'"><img id="file_preview_bill_copy_'+num+'" onclick="popup(\'<?=base_url()?>cma_file/bill_copy/'+appeal_bail_bill_copy+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                    html +='<input type="hidden" id="hidden_bill_copy_'+num+'_value" name="hidden_bill_copy_'+num+'_value" value="'+appeal_bail_bill_copy+'">';
                    html +='<img id="file_delete_bill_copy_'+num+'" onclick="file_delete(\'bill_copy_'+num+'\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                    html +='<input type="hidden" id="file_delete_value_bill_copy_'+num+'" name="file_delete_value_bill_copy_'+num+'" value="0">';
                }
                else
                {
                    html+='<span id="hidden_bill_copy_'+num+'">';
                }
                html+='<span id="hidden_bill_copy_'+num+'">';
                jQuery('#bill_copy_'+num).html(html);
                
            });
           
            
        }
    });
    jQuery('#jqxTabs').jqxTabs('select', 0);
}
function clear_form(){
    
    jQuery('#hc_dealing_officer').jqxComboBox('clearSelection');
    jQuery("input[name='hc_dealing_officer']").val('');
    jQuery('#portfolio').jqxComboBox('clearSelection');
    jQuery("input[name='portfolio']").val('');
    jQuery('#lower_dealing_officer').jqxComboBox('clearSelection');
    jQuery("input[name='lower_dealing_officer']").val('');
    jQuery('#hc_division').jqxComboBox('clearSelection');
    jQuery("input[name='hc_division']").val('');
    jQuery('#case_category').jqxComboBox('clearSelection');
    jQuery("input[name='case_category']").val('');
    jQuery('#case_type').jqxComboBox('clearSelection');
    jQuery("input[name='case_type']").val('');
    //jQuery('#assigned_lawyer').jqxComboBox('clearSelection');
    jQuery('#name_dist').jqxComboBox('clearSelection');
    jQuery("input[name='name_dist']").val('');
    jQuery('#present_status').jqxComboBox('clearSelection');
    jQuery("input[name='present_status']").val('');
    jQuery('#hc_bench').jqxComboBox('clearSelection');
    jQuery("input[name='hc_bench']").val('');
    //jQuery('#bench_number').jqxComboBox('clearSelection');
    //jQuery("input[name='bench_number']").val('');
    jQuery('#ac_closing_status').jqxComboBox('clearSelection');
    jQuery("input[name='ac_closing_status']").val('');
    jQuery('#status').jqxComboBox('clearSelection');
    jQuery("input[name='status']").val('');
    jQuery('#region').jqxComboBox('clearSelection');
    jQuery("input[name='region']").val('');
    //jQuery('#territory').jqxComboBox('clearSelection');
    //jQuery("input[name='territory']").val('');
    jQuery('#district').jqxComboBox('clearSelection');
    jQuery("input[name='district']").val('');
    jQuery('#proposed_type').jqxComboBox('clearSelection');
    jQuery("input[name='proposed_type']").val('');
    jQuery('#deposited_appeal_money').jqxComboBox('clearSelection');
    jQuery("input[name='deposited_appeal_money']").val('');
    jQuery('#name').jqxComboBox('clearSelection');
    jQuery("input[name='name']").val('');
    jQuery('#next_status').jqxComboBox('clearSelection');
    jQuery("input[name='next_status']").val('');
    jQuery("#year").val('');
    jQuery("#next_date").val('');
    jQuery("#next_dt_sts_value").val('1');
    jQuery("#req_type").val('');
    jQuery("#suit_id").val('');
    jQuery("#hidden_loan_ac").val('');
    jQuery("#loan_ac").val('');
    jQuery("#account_name").val('');
    jQuery("#case_no").val('');
    jQuery("#file_receive_date").val('');
    jQuery("#case_claim").val('');
    jQuery("#filing_date").val('');
    jQuery("#last_activities").val('');
    jQuery("#present_casue_action").val('');
    jQuery("#remarks").val('');
    jQuery("#amount_appeal_money").val('');
    jQuery("#sts_date").val('');
    jQuery("#court_name").val('');
    jQuery("#lcr_memo_no").val('');
    jQuery("#memo_date").val('');
    jQuery("#gp_no").val('');
    jQuery("#gp_date").val('');
    jQuery("#wp_amount").val('');
    jQuery("#withdrawn_date").val('');
    jQuery("#edit_row").val('');
    jQuery("#add_edit").val('add');
    jQuery('#hc_id').val('');
    jQuery('#hc_type').val('');
    jQuery("#add_button").show();
    jQuery("#up_button").hide();
    jQuery("#m_no").hide();
    jQuery("#m_dt").hide();
    jQuery("#g_no").hide();
    jQuery("#g_dt").hide();
    jQuery("#status_id").hide();
    jQuery("#status_date").hide();
    jQuery("#nameg").hide();
    jQuery("#w_amount").hide();
    jQuery("#w_date").hide();
    jQuery("#c_name").hide();
    jQuery('#case_form').hide();
    jQuery('#search_box').show();
    jQuery("#searchTable").hide();

    // expense
    jQuery("#expense_counter").val(1);
    jQuery('#expense_type_1').jqxComboBox('clearSelection');
    jQuery('#expense_type_1').jqxComboBox('val','');
    jQuery('#district_1').jqxComboBox('clearSelection');
    jQuery('#district_1').jqxComboBox('val','');
    jQuery('#vendor_id_1').jqxComboBox('clearSelection');
    jQuery('#vendor_id_1').jqxComboBox('val','');
    jQuery('#activities_name_1').jqxComboBox('clearSelection');
    jQuery('#activities_name_1').jqxComboBox('val','');
    jQuery('#activities_date_1').val('');
    jQuery('#amount_1').val('');
    jQuery('#remarks_1').val('');
    jQuery('#expense_edit_1').val('');
    jQuery("#vendor_name_1").val('');
    jQuery.ajax({
        type: "GET",
        cache: false,
        async:false,
        url: "<?=base_url()?>hc_matter/temp_file",
        datatype: "html",
        success: function(response){ 
            if(response=='success'){
                var html = '';
                html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'bill_copy_1\')"/>';
                html+='<input type="hidden" id="hidden_bill_copy_1_select" name="hidden_bill_copy_1_select" value="0">';
                html+='<span id="hidden_bill_copy_1">';
                jQuery('#bill_copy_1').html(html);
            }
        }
    });
    var node = document.getElementById('expense_body');
    for(let i=1;i<node.childElementCount;i++){
        node.removeChild(node.children[i]);
    }
    
}
function reload(){
    clear_form();
    jQuery('#action_form').jqxValidator('hide');
    jQuery('#s_hc_division').jqxComboBox('clearSelection');
    jQuery('#s_case_category').jqxComboBox('clearSelection');
    jQuery('#s_case_type').jqxComboBox('clearSelection');
    jQuery('#s_account').val('');
    jQuery('#s_case_number').val('');
    jQuery("#search_area").show();
    jQuery("#show_search").hide();
    jQuery("#back_area").hide();
}
function details (id,editrow,operation) {
    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
    //console.log(dataRecord);
    if(operation=='delete'){
        jQuery("#deleteEventId").val(id);
        jQuery("#verifyid").val('');
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtocheker_row").hide();
        jQuery("#delete_row").show();
    }else if(operation=='verify'){

        jQuery("#deleteEventId").val('');
        jQuery("#verifyid").val(id);
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#delete_row").hide();
        jQuery("#sendtocheker_row").hide();
        jQuery("#verify_row").show();
    }else if(operation=='sendtochecker'){

        jQuery("#deleteEventId").val('');
        jQuery("#verifyid").val(id);
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#delete_row").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtocheker_row").show();
    }
    else{
        jQuery("#deleteEventId").val('');
        jQuery("#verifyid").val('');
        jQuery("#delete_row").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtocheker_row").hide();
        jQuery("#preview").show();
    }
    
    //console.log(dataRecord);
    jQuery("#r_heading").html('HC Matter');

    var hc_matter_type = dataRecord['hc_matter_type'];
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_matter/get_details/"+id,
        data : {[csrfName]: csrfHash,hc_matter_type:hc_matter_type},
        datatype: "json",
        async:false,
        success: function(response){
            var ds=response.split('####');
            jQuery('.txt_csrfname').val(ds[1]);
            jQuery('#previewtable').html(ds[0]);
        }
    });
    
    document.getElementById("details").style.display='block';
    jQuery("#details").jqxWindow('open');
}

// 
function search_data(){
    var loan_ac = jQuery('#s_account').val();
    var case_number = jQuery('#s_case_number').val();
    var s_proposed_type = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
    var s_hc_division = jQuery("#s_hc_division").jqxComboBox('getSelectedItem');
    
    if(s_hc_division==null || (loan_ac=='' && case_number==''))
    {
        alert('Please provide at least one search parameter!!!');
        return false;
    }
    else
    {
        jQuery("#grid_loading").show();
        //jQuery("#load").hide();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var postdata = jQuery('#form').serialize();
        var url = 'search_case';
        if(s_hc_division.value==2){
            url = 'search_case_hc';
        }
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>index.php/hc_matter/"+url,
            data : postdata,
            datatype: "html",
            success: function(response){                
                jQuery("#grid_loading").hide();
                var data = response.split("####");
                jQuery('.txt_csrfname').val(data[1]);
                jQuery("#load_suit_loading").hide();
                jQuery("#search_area").hide();
                jQuery("#show_search").show();
                jQuery("#back_area").show();
                jQuery("#load").show();
                jQuery("#searchTable").show();
                jQuery('#searchTable').html(data[0]);

            }
        });
    }

}

// Only One Checkbox Select At a time
function onlyOne(checkbox) {
    //var id = document.getElementsByName('suit_id').value;
    //console.log(checkbox.value)
    var checkboxes = document.getElementsByName('case_id')
    checkboxes.forEach((item) => {
        //console.log(item)
        if (item !== checkbox) item.checked = false
    })
}

function loadsuit(type){
    //alert('ddd')
    var s_hc_division = jQuery("#s_hc_division").jqxComboBox('getSelectedItem');
    var checkboxes = document.getElementsByName('case_id');
    var val;var required = false;
    checkboxes.forEach((item) => {
        if(item.checked==true){
            val=item.value;
            required = true;
           //console.log(item.value) 
        }
        
    });
    if(required==false){
        alert('Please Select a Case Number!');
        return false;
    }

    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    var url = 'search_case_info';
    if(s_hc_division.value==2){
        url = 'get_hc_info_for_ad';
    }
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>hc_matter/"+url,
        data : {[csrfName]: csrfHash,id:val},
        datatype: "json",
        async:false,
        success: function(response){
           //console.log(response)
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            //var arr=Object.entries(json.row_info);
            //console.log(json.row_info.case_number);
            //val,0,
            
            var rows = json.row_info;
            //console.log(rows);
            jQuery('#ac_number').val('');
            jQuery('#ac_name').val('');
            if(rows!=null){
                //alert(rows.loan_ac)
                jQuery('#case_form').show();
                jQuery('#search_box').hide();
                
                if(s_hc_division.value==2){
                    jQuery('#proposed_tr').hide();
                    jQuery('#hc_type').val(type);
                    var division = jQuery("#s_hc_division").jqxComboBox('getSelectedItem');
                    jQuery('#hc_division').jqxComboBox('clearSelection');
                    jQuery('#hc_division').jqxComboBox('val',division.value);
                    jQuery('#hc_dealing_officer').jqxComboBox('clearSelection');
                    jQuery('#hc_dealing_officer').jqxComboBox('val',rows.hc_dealing_officer!=0?rows.hc_dealing_officer:'');
                    jQuery('#deposited_appeal_money').jqxComboBox('clearSelection');
                    jQuery('#deposited_appeal_money').jqxComboBox('val',rows.deposit_am_50!=0?rows.deposit_am_50:'');
                    //jQuery('#proposed_type').jqxComboBox('clearSelection');
                    //jQuery('#proposed_type').jqxComboBox('val',rows.proposed_type);
                    jQuery('#region').jqxComboBox('clearSelection');
                    jQuery('#region').jqxComboBox('val',rows.region);
                    //jQuery('#territory').jqxComboBox('clearSelection');
                    //jQuery('#territory').jqxComboBox('val',rows.territory);
                    jQuery('#district').jqxComboBox('clearSelection');
                    jQuery('#district').jqxComboBox('val',rows.district);

                    jQuery('#portfolio').jqxComboBox('clearSelection');
                    jQuery('#portfolio').jqxComboBox('val',rows.portfolio);
                    jQuery('#lower_dealing_officer').jqxComboBox('clearSelection');
                    jQuery('#lower_dealing_officer').jqxComboBox('val',rows.lower_dealing_officer!=0?rows.lower_dealing_officer:'');
                    jQuery('#case_type').jqxComboBox('clearSelection');
                    //jQuery('#case_type').jqxComboBox('val',rows.case_type!=0?rows.case_type:'');
                    //jQuery('#assigned_lawyer').jqxComboBox('clearSelection');
                    //jQuery('#assigned_lawyer').jqxComboBox('val',rows.assigned_lawyer!=0?rows.assigned_lawyer:'');
                    jQuery('#name_dist').jqxComboBox('clearSelection');
                    jQuery('#name_dist').jqxComboBox('val',rows.name_dist!=0?rows.name_dist:'');
                    jQuery('#present_status').jqxComboBox('clearSelection');
                    //jQuery('#present_status').jqxComboBox('val',rows.present_status!=0?rows.present_status:'');
                    jQuery('#hc_bench').jqxComboBox('clearSelection');
                    jQuery('#hc_bench').jqxComboBox('val',rows.hc_bench!=0?rows.hc_bench:'');
                    //jQuery('#bench_number').jqxComboBox('clearSelection');
                    //jQuery('#bench_number').jqxComboBox('val',rows.hc_bench!=0?rows.hc_bench:'');
                    jQuery('#ac_closing_status').jqxComboBox('clearSelection');
                    jQuery('#ac_closing_status').jqxComboBox('val',rows.ac_closing_status!=0?rows.ac_closing_status:'');
                    jQuery('#req_type').val(rows.req_type);
                    jQuery("#loan_ac").val(rows.ac_number);
                    jQuery("#last_activities").val(rows.last_act);
                    jQuery("#account_name").val(rows.ac_name);
                    jQuery("#case_no").val(rows.case_no);
                    jQuery("#file_receive_date").val(rows.file_receive_date);
                    jQuery("#case_claim").val(rows.case_claim!=0?rows.case_claim:'');
                    jQuery("#filing_date").val(rows.filing_date);
                    jQuery("#last_act").val(rows.last_act);
                    jQuery("#present_casue_action").val(rows.present_cause_action);
                    jQuery("#remarks").val(rows.remarks);
                    jQuery("#withdrawn_date").val(rows.am_withdrawn_date);
                    jQuery("#amount_appeal_money").val(rows.amount_am_money!=0?rows.amount_am_money:'');
                }else{
                    jQuery('#proposed_tr').show(); 
                    jQuery('#proposed_type').jqxComboBox('clearSelection');
                    jQuery('#proposed_type').jqxComboBox('val',rows.proposed_type);
                    jQuery('#portfolio').jqxComboBox('clearSelection');
                    jQuery('#portfolio').jqxComboBox('val',rows.loan_segment);
                    jQuery('#region').jqxComboBox('clearSelection');
                    jQuery('#region').jqxComboBox('val',rows.region);
                    //jQuery('#territory').jqxComboBox('clearSelection');
                    //jQuery('#territory').jqxComboBox('val',rows.territory);
                    jQuery('#district').jqxComboBox('clearSelection');
                    jQuery('#district').jqxComboBox('val',rows.district);
                    var division = jQuery("#s_hc_division").jqxComboBox('getSelectedItem');
                    jQuery('#hc_division').jqxComboBox('clearSelection');
                    jQuery('#hc_division').jqxComboBox('val',division.value);
                    jQuery('#req_type').val(rows.req_type);
                    jQuery('#hc_type').val(type);
                    jQuery('#loan_ac').val(rows.loan_ac);
                    jQuery('#hidden_loan_ac').val(rows.org_loan_ac);
                    jQuery('#suit_id').val(rows.id);
                    jQuery('#account_name').val(rows.ac_name);
                }
            }else{
                alert("No Data Found");
            }
        }
    });

}
function load_new(){
    clear_form();
    var division = jQuery('#s_hc_division').jqxComboBox('getSelectedItem');
    if(division==null)
    {
        alert('Please provide at least one search parameter!!!');
        return false;
    }else{
        if(division.value==2){
           jQuery('#proposed_tr').hide(); 
        }else{
            jQuery('#proposed_tr').show(); 
        }
        jQuery('#hc_type').val('New');
        var division = jQuery("#s_hc_division").jqxComboBox('getSelectedItem');
        jQuery('#hc_division').jqxComboBox('clearSelection');
        jQuery('#hc_division').jqxComboBox('val',division.value);
        jQuery('#case_form').show();
        jQuery('#search_box').hide();
    }
}
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
                //console.log(json['row_info']);
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
                    //jQuery("#territory").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select territory", source: territory, width: 250, height: 25});
                    //For edit action
                    if (edit!=null) 
                    {
                        //alert('success');
                        //jQuery("#territory").jqxComboBox('val', '<?=(isset($result->territory) && $result->territory!=0)?$result->territory:''?>');
                    }
                }
                /*if (operation=='territory') 
                {
                    var district = [];
                    jQuery.each(json['row_info'],function(key,obj){
                        district.push({ value: obj.id, label: obj.name });
                    });
                    jQuery("#district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select District", source: district, width: 250, height: 25});
                    //For edit action
                    if (edit!=null) 
                    {
                        jQuery("#district").jqxComboBox('val', '<?=(isset($result->district) && $result->district!=0)?$result->district:''?>');
                    }
                }*/
                if (operation=='district') 
                {
                    var unit_office = [];
                    jQuery.each(json['row_info'],function(key,obj){
                        unit_office.push({ value: obj.id, label: obj.name });
                    });
                    jQuery("#unit_office").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Unit Office", source: unit_office, width: 250, height: 25});
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
// Billing Information 
    function get_expense_activities(type,counter,req_type)
    {
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
        url: '<?=base_url()?>index.php/authorization_request/get_activities',
        async:false,
        type: "post",
        data: { [csrfName]: csrfHash,type : type,req_type:req_type},
        datatype: "json",
        success: function(response){
            var json = jQuery.parseJSON(response);
            //console.log(json)
            jQuery('.txt_csrfname').val(json.csrf_token);
            var str='';
            var theme = getDemoTheme();
                var expense_activities = [];
                if(json.status=='success')
                {
                    jQuery.each(json['row_info'],function(key,obj){
                        expense_activities.push({ value: obj.id, label: obj.name });
                    });
                }
                jQuery("#activities_name_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight:150, promptText: "Select Activity", source: hc_activites, width: 200, height: 25});
                    jQuery('#activities_name_'+counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
                });

            },
            error:   function(model, xhr, options){
                alert('failed');
            },
        });
    }
    function change_vendor(id,counter)
    {
        var theme = getDemoTheme();
        var item = jQuery("#"+id).jqxComboBox('getSelectedItem');
        jQuery("#district_"+counter).jqxComboBox('clearSelection');
        jQuery("#district_"+counter).val('');
        jQuery("#district_"+counter).hide();

        var req_type = jQuery("#req_type").val();
        if (item!=null)
        {
            if (item.value==1)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 200, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                //get_expense_activities(item.value,counter,req_type);
                select_lawyer(counter);
            }else if(item.value==4)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 200, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                //get_expense_activities(item.value,counter,req_type);
                select_lawyer(counter);
            }else if(item.value==2)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Vendor", source: vendor, width: 200, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                //get_expense_activities(item.value,counter,req_type);
                un_select_lawyer(counter);
            }else if(item.value==3)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#district_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 200, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                //get_expense_activities(item.value,counter,req_type);
                un_select_lawyer(counter);
            }
            else if(item.value==5)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#district_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 200, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                //get_expense_activities(item.value,counter,req_type);
                un_select_lawyer(counter);
            }
            else{
                jQuery("#vendor_id_"+counter).hide();
                jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
                jQuery("#vendor_id_"+counter).val('');
                document.getElementById('vendor_name_'+counter).style.display = 'block';
                //get_expense_activities(item.value,counter,req_type);
                un_select_lawyer(counter);
            }
            
        }else{
            jQuery("#vendor_id_"+counter).hide();
            jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
            jQuery("#vendor_id_"+counter).val('');
            document.getElementById('vendor_name_'+counter).style.display = 'block'
        }
    }
    function get_dropdown_data(counter)
    {
        var item = jQuery("#district_"+counter).jqxComboBox('getSelectedItem');
        if (item!=null)
        {
            dropdown_name = 'staff';
            var district = item.value;
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?=base_url()?>index.php/authorization_request/get_dropdown_data',
            async:false,
            type: "post",
           data: { [csrfName]: csrfHash,district : district,dropdown_name:dropdown_name},
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                var str='';
                var theme = getDemoTheme();
                    if (dropdown_name=='staff')
                    {
                        var staff = [];
                        jQuery.each(json['row_info'],function(key,obj){
                            staff.push({ value: obj.id, label: obj.name+' ('+obj.pin+')' });
                            //alert(obj.name);
                        });
                        jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 200, height: 25});
                        jQuery('#vendor_id_'+counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
                    });
                    }

                },
                error:   function(model, xhr, options){
                    alert('failed');
                },
                });
        }
        else
        {
            jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
            jQuery("#vendor_id_"+counter).val('');
        }
    }
    function add_more_expense()
    {
        var theme = getDemoTheme();
        var counter = jQuery('#expense_counter').val();
        var cma_district = jQuery('#cma_district').val();
        var req_type = jQuery('#req_type').val();
        var new_counter = parseInt(counter) + 1;
        html_string = '';

            html_string += '<tr id="expense_'+new_counter+'">';
            html_string += '<td>';
            html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
            html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
            html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
            html_string += '</td>';
            html_string += '<td><div id="expense_type_'+new_counter+'" name="expense_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange="change_vendor(\'expense_type_'+new_counter+'\','+new_counter+')"></div></td>';
            html_string += '<td><div id="district_'+new_counter+'" name="district_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data('+new_counter+')"></div><div id="vendor_id_'+new_counter+'" name="vendor_id_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none" ></div><input name="vendor_name_'+new_counter+'" type="text" class="" style="width:98%" id="vendor_name_'+new_counter+'" /></td>';
            html_string += '<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange="get_expense_amount(\'activities_name_'+new_counter+'\','+new_counter+')"></div></td>';
            html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:90%;" id="activities_date_'+new_counter+'" value="" ></td>';
            html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
            html_string += '<td><span id="bill_copy_'+new_counter+'"></span></td>';
            html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
            html_string += '</tr>';

        jQuery('#expense_' + counter).after(html_string);
        jQuery('#expense_counter').val(new_counter);
        
        jQuery('#expense_type_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Vendor Type", source: expense_type, height: 25});
        jQuery('#expense_type_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 200, autoOpen: false, autoDropDownHeight: false, dropDownHeight:150, promptText: "Select Activity", source: hc_activites, height: 25});
        jQuery('#activities_name_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#district_'+new_counter).jqxComboBox({theme: theme, width: 200, autoOpen: false, autoDropDownHeight: false, promptText: "Select District", source: district, height: 25});
        jQuery('#district_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        datePicker('activities_date_'+new_counter);
        var stringhtml = '';
        stringhtml+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'bill_copy_'+new_counter+'\')"/>';
        stringhtml+='<input type="hidden" id="hidden_bill_copy_'+new_counter+'_select" name="hidden_bill_copy_'+new_counter+'_select" value="0">';
        stringhtml+='<span id="hidden_bill_copy_'+new_counter+'">';
        jQuery('#bill_copy_'+new_counter+'').html(stringhtml);

        
    }
    function select_lawyer(new_counter)
    {
        jQuery("#vendor_id_"+new_counter).jqxComboBox('val', '<?=(isset($cma_data->lawyer) && $cma_data->lawyer!='')?$cma_data->lawyer:''?>');
        //jQuery('#vendor_id_'+new_counter).jqxComboBox({ disabled: true });
    }
    function un_select_lawyer(new_counter)
    {
        jQuery('#vendor_id_'+new_counter).jqxComboBox({ disabled: false });
    }
    function expense_validation()
    {
        var counter = jQuery('#expense_counter').val();
        for (i=1;i<=counter;i++) 
        {
            if(jQuery('#expense_delete_'+i).val()==0) 
            {
                var item = jQuery("#expense_type_"+i).jqxComboBox('getSelectedItem');
                var act = jQuery("#activities_name_"+i).jqxComboBox('getSelectedItem');
                if (!item)
                {
                    alert('Vendor Type Required');
                    jQuery('#expense_type_'+i+' input').focus();
                    return false;
                }
                else
                {
                    if (item.value==1 || item.value==2 || item.value==3 || item.value==4 || item.value==5)
                    {
                        var item2 = jQuery("#vendor_id_"+i).jqxComboBox('getSelectedItem');
                        if (!item2)
                        {
                            alert('Vendor Required');
                            jQuery('#vendor_id_'+i+' input').focus();
                            return false;
                        }
                    }
                    else
                    {
                        if(jQuery.trim(jQuery('#vendor_name_'+i).val())=='')
                        {
                            alert('Vendor Name Required');
                            jQuery('#vendor_name_'+i).focus();
                            return false;
                        }
                    }
                    
                }
                if (!act)
                {
                    alert('Activities Name Required');
                    jQuery('#activities_name_'+i+' input').focus();
                    return false;
                }
                if(jQuery.trim(jQuery('#activities_date_'+i).val())=='')
                {
                    alert('Activities Date Required');
                    jQuery('#activities_date_'+i).focus();
                    return false;
                }
                if(jQuery.trim(jQuery('#activities_date_'+i).val())!='')
                {
                    if(!validate_date(jQuery('#activities_date_'+i).val()))
                    {
                        alert('Activities Date Invalid');
                        jQuery('#activities_date_'+i).focus();
                        return false;
                    }
                }
                if(jQuery.trim(jQuery('#amount_'+i).val())=='')
                {
                    alert('Amount Required');
                    jQuery('#amount_'+i).focus();
                    return false;
                }
                if(jQuery.trim(jQuery('#amount_'+i).val())!='')
                {
                    if(!checknumber_alphabatic('amount_'+i))
                    {
                        alert('Amount Only Numeric');
                        jQuery('#amount_'+i).focus();
                        return false;
                    }
                }
                
            }
        }
        return true;
    }
    function delete_row_expense (row_id) {
        jQuery('#expense_' + row_id).hide();
        jQuery('#expense_delete_' + row_id).val(1);
    }
    function get_expense_amount(act_id,counter) 
    {
        var theme = getDemoTheme();
        //var cma_district = jQuery('#cma_district').val();
        //var req_type = jQuery('#req_type').val();
        var item2 = jQuery("#expense_type_"+counter).jqxComboBox('getSelectedItem');
        
        var item = jQuery("#"+act_id).jqxComboBox('getSelectedItem');
        if(item2!=null && item2.value==1)
        {
            if (item!=null)
            {
                var act_id = item.value;
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery.ajax({
                url: '<?=base_url()?>index.php/hc_matter/get_expense_amount',
                async:false,
                type: "post",
                data: { [csrfName]: csrfHash,act_id:act_id},
                datatype: "json",
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str='';
                    if(json.row_info['amount']>0){
                        jQuery('#amount_'+counter).val(json.row_info['amount']);
                    }else{
                        jQuery('#amount_'+counter).val(0);
                    }
                    },
                    error:   function(model, xhr, options){
                        alert('failed');
                    },
                    });
            }
        }
        else
        {
            jQuery('#amount_'+counter).val('');
        }
    }
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

</script>
<span id="click" ></span>
<div id="container">
    <div id="body">
        <table class="">
            <tr id="widgetsNavigationTree">
                <td valign="top" align="left" class='navigation'>
                    <!---- Left Side Menu Start ------>
                    <?php $this->load->view('hc_matter/pages/left_side_nav'); ?>
                    <!-- --====== Left Side Menu End==========--- -->
                </td>
                <td valign="top" id="demos" class='rc-all content'>
                    <div id="preloader">
                      <div id="camera"></div>
                    </div>
                    <div id="">
                    <div id='jqxTabs'>
                        <ul>
                            <li style="margin-left: 30px;">Form</li>
                            <li>Data Grid</li>
                        </ul>
                        <!---==== First Tab Start ==========--- -->
                        <div style="overflow: hidden;" >
                           <div id="search_box">
                           <div id="search_area">
                            <form method="POST" name="form" id="form"  style="margin:0px;">
                                <input type="hidden" id="s_hidden_loan_ac" value="" name="s_hidden_loan_ac">
                                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                               <div style="padding: 10px;width:100%;_height:80px; font-family: Calibri;font-size: 14px" id="search_div">
                                <center>
                                <table id="deal_body" style="_display:block;width:50%" >
                                    <tr>
                                        <td style="font-weight: bold;">Division</td>
                                        <td ><div id="s_hc_division" name="s_hc_division" style="padding-left: 3px" onchange="select_onchange('s_hc_division','s_case_category','division')"></div></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;">Case Category </td>
                                        <td ><div id="s_case_category" name="s_case_category" style="padding-left: 3px" onchange="select_onchange('s_case_category','s_case_type','category')"></div></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;">Case Types</td>
                                        <td ><div id="s_case_type" name="s_case_type" style="padding-left: 3px"></div></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                        <td><div id="s_proposed_type" name="s_proposed_type"></div></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px;"><strong><span id="s_l_or_c_no"></span>&nbsp;&nbsp;</strong> </td>
                                        <td><input name="s_account" tabindex="" type="text" class="" maxlength="16" size="16" style="width:250px" id="s_account" value="" onKeyUp="javascript:return s_mask(this.value,this);"/>
                                    </tr>
                                    <tr>
                                        <td><strong>Case Number&nbsp;&nbsp;</strong> </td>
                                        <td><input type="text" id="s_case_number" name="s_case_number" style="width:250px" /></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td> <input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="margin-left:20px;background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" /> <button type='button' class='newbuttonStyle' style='background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 2px solid #4329ff;' onclick='load_new()'>New</button></td>
                                    </tr>
                                    
                                </table>
                                </center>
                               </div>
                              
                              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                              
                            </form>
                            </div>
                            <br>
                            <div id="show_search" style="display:none;">
                            <div id="back_area" style="text-align: center;padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px;display:none;">
                                <input type='button' class="buttonStyle" id="back" name='' value='Back' onclick="reload()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;margin-top:10px" />
                            </div>
                            <div id="searchTable"></div>
                            </div>
                        </div>
                           <div style="padding: 10px;display: none;" id="case_form" class="back_image">
                            <div id="back_area" style="text-align: center;padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px;">
                                <input type='button' class="buttonStyle" id="back" name='' value='Back' onclick="reload()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;margin-top:10px" />
                            </div>
                            <br>
                            <form class="form" name="action_form" id="action_form" method="post" action="" enctype="multipart/form-data">
                                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <input type="hidden" id="add_edit" value="add" name="add_edit">
                                <input type="hidden" id="edit_row" value="" name="edit_row">
                                <input type="hidden" id="hc_id" value="" name="hc_id">
                                <input type="hidden" id="hc_type" value="" name="hc_type">
                                <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                                <input type="hidden" id="req_type" value="" name="req_type">
                                <input type="hidden" id="suit_id" value="" name="suit_id">
                                <input type="hidden" id="next_dt_sts_value" name="next_dt_sts_value" value="1">
                                <table style="width: 100%;">
                                    <tr>
                                        <td width="50%">
                                            <table style="width: 100%;">
                                                <tr id="proposed_tr">
                                                    <td style="font-weight: bold;">Proposed Type </td>
                                                    <td><div id="proposed_type" name="proposed_type" style="padding-left: 3px"></div></td>
                                                </tr>
                                                <tr>
                                                    <td  style="font-weight: bold;"><span id="l_or_c_no"></span> No.</td>
                                                    <td><input name="loan_ac" tabindex="" type="text" class="" maxlength="16" size="16" style="width:250px" id="loan_ac" value="" onKeyUp="javascript:return mask(this.value,this);"/></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">A/C NAME</td>
                                                    <td ><input name="account_name" type="text" class="" style="width:250px" id="account_name" value="" placeholder="Account Name" /></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">H. C. Mater number<span style="color:red">*</span> </td>
                                                    <td ><input name="case_no" type="text" class="" style="width:250px" id="case_no" value="" placeholder="H. C. Mater number" /></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">Portfolio<span style="color:red">*</span> </td>
                                                    <td ><div id="portfolio" name="portfolio" style="padding-left: 3px"></div></td>
                                                </tr>
                                                <tr>
                                                    <td  style="font-weight: bold;">Filing Date </td>
                                                    <td  ><input name="filing_date" type="text" class="" style="width:250px" id="filing_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker_without_advance ("filing_date");</script></td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">NAME OF DIST<span style="color:red">*</span> </td>
                                                    <td ><div id="name_dist" name="name_dist" style="padding-left: 3px"></div></td>
                                                    
                                                </tr>
                                                
                                                <tr>
                                                    <td style="font-weight: bold;">LAST ACTIVITIES <span style="color:red">*</span> </td>
                                                    <td ><textarea name="last_activities" type="text" class="" style="width:250px" id="last_activities" value="" placeholder="LAST ACTIVITIES" /></textarea></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">Subject matter/cause of action<span style="color:red">*</span> </td>
                                                    <td ><textarea name="present_casue_action" type="text" class="" style="width:250px" id="present_casue_action" value="" placeholder="Subject matter/cause of action" /></textarea></td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">Bench name<span style="color:red">*</span> </td>
                                                    <td ><div id="hc_bench" name="hc_bench" style="padding-left: 3px"></div></td>
                                                   
                                                </tr>
                                                <!-- <tr>
                                                    <td style="font-weight: bold;">Bench Number<span style="color:red">*</span> </td>
                                                    <td ><div name="bench_number" id="bench_number"></div></td>
                                                   
                                                </tr> -->
                                               <tr>
                                                    <td style="font-weight: bold;">Region</td>
                                                    <td ><div id="region" name="region" style="padding-left: 3px"></div></td>
                                                    
                                                </tr>
                                                <!-- <tr>
                                                    <td style="font-weight: bold;">Territory</td>
                                                    <td ><div id="territory" name="territory" style="padding-left: 3px"></div></td>
                                                    
                                                </tr> -->
                                                <tr>
                                                    <td style="font-weight: bold;">District</td>
                                                    <td ><div id="district" name="district" style="padding-left: 3px"></div></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">REMARKS</td>
                                                    <td ><textarea name="remarks" type="text" class="" style="width:250px" id="remarks" value="" placeholder="Remarks" /></textarea></td>
                                                   
                                                </tr>
                                                
                                                
                                            </table>
                                        </td>
                                        <td width="50%" style="display: contents;">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="font-weight: bold;">A/C Closing Status<span style="color:red">*</span> </td>
                                                    <td ><div id="ac_closing_status" name="ac_closing_status" style="padding-left: 3px"></div></td>

                                                </tr>
                                                
                                                <tr>
                                                    <td style="font-weight: bold;">Case Claim</td>
                                                    <td ><input name="case_claim" type="text" class="" style="width:250px" id="case_claim" value="" placeholder="Case Claim" /></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">Division<span style="color:red">*</span> </td>
                                                    <td ><div id="hc_division" name="hc_division" style="padding-left: 3px" onchange="select_onchange('hc_division','case_category','division')"></div></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">Case Category<span style="color:red">*</span> </td>
                                                    <td ><div id="case_category" name="case_category" style="padding-left: 3px" onchange="select_onchange('case_category','case_type','category')"></div></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">Case Types<span style="color:red">*</span> </td>
                                                    <td ><div id="case_type" name="case_type" style="padding-left: 3px" onchange="select_onchange('case_type','present_status','type')"></div></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">Present status<span style="color:red">*</span> </td>
                                                    <td ><div id="present_status" name="present_status" style="padding-left: 3px"></div></td>
                                                    
                                                </tr>
                                                <span id="status_form">
                                                <tr id="status_id" style="display:none;">
                                                    <td class="sub-field" style="font-weight: bold;">Status<span style="color:red">*</span> </td>
                                                    <td ><div id="status" name="status" style="padding-left: 3px"></div></td>
                                                    
                                                </tr>
                                                <tr id="status_date" style="display:none;">
                                                    <td  class="sub-field" style="font-weight: bold;">Date<span style="color:red">*</span></td>
                                                    <td  ><input name="sts_date" type="text" class="" style="width:250px" id="sts_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker ("sts_date");</script></td>
                                                </tr>
                                                <tr id="c_name" style="display:none;">
                                                    <td  class="sub-field" style="font-weight: bold;">Court Name<span style="color:red">*</span></td>
                                                    <td ><input name="court_name" type="text" class="" style="width:250px" id="court_name" value="" placeholder="Court Name" /></td>
                                                    
                                                </tr>
                                                <tr id="nameg" style="display:none;">
                                                    <td  class="sub-field" style="font-weight: bold;">Name<span style="color:red">*</span></td>
                                                    <td ><div id="name" name="name" style="padding-left: 3px"></div><!-- <input name="name" type="text" class="" style="width:250px" id="name" value="" placeholder="Name" /> --></td>
                                                    
                                                </tr>
                                                <tr id="m_no" style="display:none;">
                                                    <td  class="sub-field" style="font-weight: bold;">LCR Memo No<span style="color:red">*</span></td>
                                                    <td ><input name="lcr_memo_no" type="text" class="" style="width:250px" id="lcr_memo_no" value="" placeholder="LCR Memo No" /></td>
                                                    
                                                </tr>
                                                <tr id="m_dt" style="display:none;">
                                                    <td  class="sub-field" style="font-weight: bold;">Memo Date<span style="color:red">*</span></td>
                                                    <td  ><input name="memo_date" type="text" class="" style="width:250px" id="memo_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker ("memo_date");</script></td>
                                                </tr>
                                                <tr id="g_no" style="display:none;">
                                                    <td  class="sub-field" style="font-weight: bold;">GP No<span style="color:red">*</span></td>
                                                    <td ><input name="gp_no" type="text" class="" style="width:250px" id="gp_no" value="" placeholder="GP No" /></td>
                                                    
                                                </tr>
                                                <tr id="g_dt" style="display:none;">
                                                    <td  class="sub-field" style="font-weight: bold;">GP Date<span style="color:red">*</span></td>
                                                    <td  ><input name="gp_date" type="text" class="" style="width:250px" id="gp_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker ("gp_date");</script></td>
                                                </tr>
                                                <tr id="w_amount" style="display:none;">
                                                    <td  class="sub-field" style="font-weight: bold;">withdraw/pending-Amount<span style="color:red">*</span></td>
                                                    <td ><input name="wp_amount" type="text" class="" style="width:250px" id="wp_amount" value="" placeholder="withdraw/pending-Amount " /></td>
                                                    
                                                </tr>
                                                <tr id="w_date" style="display:none;">
                                                    <td  class="sub-field" style="font-weight: bold;">Withdraw Date<span style="color:red">*</span></td>
                                                    <td  ><input name="withdrawn_date" type="text" class="" style="width:250px" id="withdrawn_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker ("withdrawn_date");</script></td>
                                                </tr>
                                                </span>
                                                <tr>
                                                    <td width="40%" style="font-weight: bold;">Next Date<span style="color:red">*</span></td>
                                                    <td width="60%" >
                                                        <input type="text" name="next_date" tabindex="7" placeholder="dd/mm/yyyy" style="width:225px;" id="next_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("next_date");</script>
                                                        <span id="next_sts_text" style="display:none;margin-left:10px"></span>
                                                        <div name="next_dt_sts" tabindex="40" id="next_dt_sts" style="float:left; margin: 3px 0px 0 0;"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40%" style="font-weight: bold;">Next Case Status</td>
                                                    <td width="60%" ><div id="next_status" name="next_status" style="padding-left: 3px" tabindex="8"></div></td>
                                                </tr> 
                                                <tr>
                                                    <td style="font-weight: bold;">Year</td>
                                                    <td ><div id="year" name="year" style="padding-left: 3px"></div></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">Dealing Officer <span style="color:red">*</span></td>
                                                    <td ><div id="hc_dealing_officer" name="hc_dealing_officer" style="padding-left: 3px"></div></td>
                                                </tr>
                                                <tr>
                                                     <td style="font-weight: bold;">Lower Court Dealing officer <span style="color:blue">*</span></td>
                                                    <td ><div id="lower_dealing_officer" name="lower_dealing_officer" style="padding-left: 3px"></div></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td style="font-weight: bold;">Assigned Lawyer<span style="color:red">*</span></td>
                                                    <td><div id="assigned_lawyer" name="assigned_lawyer" style="padding-left: 3px"></div></td>
                                                </tr> -->
                                                <tr>
                                                    <td  style="font-weight: bold;">File Receiving Date </td>
                                                    <td  ><input name="file_receive_date" type="text" class="" style="width:250px" id="file_receive_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker ("file_receive_date");</script></td>
                                                </tr>
                                                <tr>
                                                    <td  style="font-weight: bold;">50% Deposited Appeal money </td>
                                                    <td><div id="deposited_appeal_money" name="deposited_appeal_money" style="padding-left: 3px"></div></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table style="width: 100%;" border="1" id="table">
                                                
                                                <thead>
                                                <tr style="background-color: #d9f0ff;">
                                                    <td colspan="7"><b>Expenses</b> <input type="checkbox" name="add_expense" id="add_expense" checked="" value="1"></td>
                                                </tr>
                                                <input type="hidden" name="expense_counter" id="expense_counter" value="1">
                                                <input type="hidden" name="req_type" id="req_type" value="">
                                                <input type="hidden" name="cma_district" id="cma_district" value="">
                                                 <input type="hidden" name="batch_no" id="batch_no" value="">
                                                <tr>
                                                    <td width="4%" style="font-weight: bold;text-align:center">D</td>
                                                    <td width="18%" style="font-weight: bold;text-align:center">Expense Type<span style="color:red">*</span></td>
                                                    <td width="20%" style="font-weight: bold;text-align:center">Vendor Name<span style="color:red">*</span></td>
                                                    <td width="20%" style="font-weight: bold;text-align:center">Activities Name<span style="color:red">*</span></td>
                                                    <td width="10%" style="font-weight: bold;text-align:center">Activities Date<span style="color:red">*</span></td>
                                                    <td width="10%" style="font-weight: bold;text-align:center">Total Amount<span style="color:red">*</span></td>
                                                    <td width="5%" style="font-weight: bold;text-align:center">File Upload</td>
                                                    <td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
                                                </tr>
                                                </thead>
                                                <tbody id="expense_body">
                                                    <tr id="expense_1">
                                                            <td></td>
                                                            <td>
                                                                <input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">
                                                                <input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">
                                                                <div id="expense_type_1" name="expense_type_1" style="padding-left: 3px;margin-left:5px" onchange="change_vendor('expense_type_1',1)"></div>
                                                            </td>
                                                            <td width="200">
                                                                <div id="district_1" name="district_1" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data(1)"></div>
                                                                <div id="vendor_id_1" name="vendor_id_1" style="padding-left: 3px;margin-left:5px;display:none;width:90%"></div>
                                                                <input name="vendor_name_1" type="text" class="" style="width:202px" id="vendor_name_1" />
                                                            </td>
                                                            <td><div id="activities_name_1" name="activities_name_1" style="padding-left: 3px;margin-left:5px;width:90%" onchange="get_expense_amount('activities_name_1',1)"></div></td>
                                                            <td><input type="text" name="activities_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:90%;" id="activities_date_1" value="" ><script type="text/javascript" charset="utf-8">datePicker ("activities_date_1");</script></td>
                                                            <td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>
                                                            <td><span id="bill_copy_1"></span></td>
                                                            <td><textarea name="remarks_1" class="text-input-big" id="remarks_1" style="height:40px !important;width:90%"></textarea></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr id="add_guarantor_row">
                                                        <td colspan="9" style="text-align: right">
                                                            Add More <input tabindex="" type="button" title="Add More" onClick="add_more_expense()" class="addmore"><br>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <? if(ADD==1){?>
                                    <tr id="add_button" >
                                        <td colspan="2" style="text-align: center;">
                                            <br/>
                                            <input type="button" value="Save" class="buttonStyle" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 2px solid #000;" id="in_req_button"/> 
                                            <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                            <br/><br/><br/>
                                        </td>
                                    </tr>
                                    <? } ?>
                                    <? if(EDIT==1){?>
                                    <tr id="up_button" style="display: none;">
                                        <td colspan="2" style="text-align: center;">
                                            <br/>
                                            <input type="button" value="Update" class="buttonStyle" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 2px solid #000;" id="in_up_button"/>
                                            <span id="in_up_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                            <br/><br/><br/>
                                        </td>
                                    </tr>
                                    <? } ?>
                                </table>
                            </form>
                            </div>
                        </div>
                        <!---==== Second Tab Start ==========----->
                        <div style="overflow: hidden;_overflow-y: scroll;">
                             <!-- <form method="POST" name="form" id="form"  style="margin:0px;">
                               <div style="padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                    <table id="deal_body" style="display:block;width:100%">
                                        <tr>
                                            <td style="text-align:right;width:5%"><strong>Case Number&nbsp;&nbsp;</strong> </td>
                                            <td style="width:10%"><input type="text" id="s_case_number" name="s_case_number" style="width:100%" /></td>
                                            
                                            <td style="text-align:right;width:5%"><strong>Account&nbsp;&nbsp;</strong> </td>
                                            <td style="width:15%"><input type="text" id="s_account" name="s_account" style="width:100%" /></td>
                                            <td style="text-align:right;width:5%"><strong>Name&nbsp;&nbsp;</strong> </td>
                                            <td style="width:10%"><input type="text" id="s_name" name="s_name" style="width:100%" /></td>
                                            <td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data(),clearCount()" style="width:58px" />
                                            </td>
                                        </tr>
                                    </table>
                              </div>
                              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                            </form>
                            <br> -->
                            <div style="border:none;" id="jqxGrid2"></div>
                            <div style="float:left;padding-top: 5px;margin-left: 5px;margin-bottom: 20px;">
                            <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                            
                                <strong>E = </strong> Edit,&nbsp;
                                <strong>D = </strong> Delete,&nbsp;
                                <strong>STC = </strong> Send to Checker,&nbsp;
                                <strong>V = </strong> Verify,&nbsp;
                                <strong>P = </strong> Preview&nbsp;
                               
                            </div>
                            </div>
                            
                        </div>
                    </div>
                    <div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="details" style="display:none;">
    <div style=""><strong><span id="r_heading"></span></strong></div>
    <div style="" id="details_table">
        <form class="form" name="delete_convence" id="delete_convence" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
        <input name="verifyid" id="verifyid" value="" type="hidden">
        <input name="type" id="type" value="" type="hidden">
        <input name="d_suit_id" id="d_suit_id" value="" type="hidden">
        <div id="previewtable"></div>
        <div id="preview" class="wrapper">
            </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
        </div>
        <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
            <br><br>
            <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
            <textarea name="comments" id="comments" style="width:370px;"></textarea>
            
            <br><br>
            <input type="button" class="buttondelete" id="delete_button" value="Delete">
            <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel">
            <span id="delete_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
            
        </div>
        <!-- <div id="verify_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
            <br><br>
            <input type="button" class="buttonSend" id="verify_button" value="Verify">
            <input type="button" class="buttonclose" id="verifycancel" onclick="close()" value="Cancel">
            <span id="verify_loading" style="display:none">Please wait... <img src="<?//= base_url()?>images/loader.gif" align="bottom"></span>
            
        </div> -->

        <div id="verify_row" style="text-align:center;margin-bottom:30px;width:100%;">
            <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                <table style="margin-left: 300px;margin-top: 0px;">
                    <tr id="verify_return_row" style="display:none">
                        <td>Reason<span style="color: red;">*</span></td>
                        <td>
                            <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="button" class="buttonSend" id="verify_button" value="Verify">
                            <input type="button" class="buttondelete" id="verify_return" value="Return"/>
                            <input type="button" class="buttondelete" id="verify_reject" value="Reject"/>
                            <input type="button" class="buttonclose" id="verifycancel" onclick="close()" value="Cancel">
                            <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="sendtocheker_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
            <br><br>
            <input type="button" class="buttonSend" id="checker_button" value="Send To Checker">
            <input type="button" class="buttonclose" id="checkercancel" onclick="close()" value="Cancel">
            <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
            
        </div>
        
        </form>
    </div>
</div>
