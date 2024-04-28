<script type="text/javascript" src="<?=base_url()?>js/jquery.ajaxupload.js"></script>
<style>
   

    table, td {
        padding: 5px;
        margin: 0px;
        border-spacing: 0px;
        border-collapse: collapse;
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

    .buttonSend {
      background-color: white;
      color: black;
      border: 2px solid #207900;
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

    .buttonSend:hover {
      background-color: #207900;
      color: white;
    }

    .navigationTitle {
        -webkit-border-top-right-radius: 4px;
        -webkit-border-top-left-radius: 4px;
        -moz-border-top-right-radius: 4px;
        -moz-border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
        font-family: Verdana,Arial,sans-serif;
        font-style: normal;
        text-shadow: 0 1px 1px #FFFFFF;
        font-size: 12px;
        text-align: left;
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        background: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, rgba(0,0,0,0.02) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.02)));
        background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
        background: -o-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
        background: -ms-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
        background-color: #fdfdfd;
        color: #3F3F3F;
        border-bottom: 5px solid #00a2e8;
        border-top: 1px solid #e9e9e9;
        padding: 12px 5px 13px 14px;
        _margin-top: 28px;
    }

        .navigationTitle img {
            margin-right: 3px !important;
            margin-top: 1px;
        }

        .navigationTitle a:link {
            font-size: 12px;
            color: #3F3F3F;
            text-decoration: none;
        }

        .navigationTitle a:visited {
            font-size: 12px;
            color: #3F3F3F;
            text-decoration: none;
        }

        .navigationTitle a:hover {
            font-size: 12px;
            text-decoration: none;
            color: #3F3F3F;
        }




    .navigationItem {
        font-family: Verdana,Arial,sans-serif;
        font-style: normal;
        text-align: left;
        vertical-align: middle;
        color: #3F3F3F;
        font-size: 12px;
        font-weight: bold;
        text-shadow: 0 1px 0 #FFFFFF;
    }

        .navigationItem a:link {
            font-size: 12px;
            margin-left: 5px;
            color: #444444;
            text-decoration: none;
        }

        .navigationItem a:visited {
            font-size: 12px;
            margin-left: 3px;
            color: #444444;
            text-decoration: none;
        }

        .navigationItem a:hover {
            font-size: 12px;
            text-decoration: underline;
            border-top-color: #ccc;
            border-left-color: #ccc;
            color: #2e2e2e;
        }

    .navigationItem-expanded {
        font-family: Verdana,Arial,sans-serif;
        font-style: normal;
        font-size: 12px;
        font-weight: bold;
    }

    .navigationItemContent, .navigationItemContentParent {
        border: 0px;
        text-align: left;
        vertical-align: middle;
        padding: 9px 3px 9px 25px;
        list-style: none;
        border-bottom: 1px solid #e9e9e9;
        -moz-transition: all 0.3s ease-in-out, color 0.1s ease 0s;
        -webkit-transition: all 0.3s ease-in-out, color 0.1s ease 0s;
        transition: all 0.3s ease-in-out, color 0.1s ease 0s;
        color: #3F3F3F;
        background: #fff;
    }

        .navigationItemContent:last-child {
            border-bottom: none;
        }

        .navigationItemContent:hover, .navigationItemContentParent:hover,
        .navigationItemContentParent:hover, .navigationItemContentParent:hover {
            cursor: pointer;
            padding-left: 28px !important;
            background: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, rgba(0,0,0,0.02) 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.02)));
            background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
            background: -o-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
            background: -ms-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
            background-color: #fdfdfd;
            color: #00a2e8;
            text-shadow: none;
        }

        .navigationItemContentParent:hover, .navigationItemContentParent:hover {
            padding-left: 22px !important;
        }

    .navigationItemContentParentExpanded:hover, .navigationItemContentParentExpanded:hover {
        padding-left: 18px !important;
    }

    .navigationItemContent a:link, .navigationItemContentParent a:link {
        font-family: Verdana,Arial,sans-serif;
        font-style: normal;
        font-size: 12px;
        font-weight: normal;
        margin-left: auto;
        color: inherit;
        margin-right: auto;
        margin-top: 2px;
        margin-bottom: 0px;
        text-decoration: none;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -ms-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        display: block;
    }

    .navigationItemContent a:visited, .navigationItemContentParent a:visited {
        font-size: 12px;
        margin-left: 3px;
        color: inherit;
        text-decoration: none;
    }

    .navigationItemContent a:hover, .navigationItemContentParent a:hover {
        font-size: 12px;
        color: inherit;
    }

    .navigationItemContentParent {
        padding: 9px 3px 9px 18px;
    }

        .navigationItemContentParent img {
            position: relative;
            left: -7px;
            cursor: pointer;
        }

    .navigationItemContentParentExpanded {
        padding: 9px 3px 9px 14px;
    }

        .navigationItemContentParentExpanded img {
            left: -4px;
            top: -2px;
        }

    .navigationContent {
        padding-top: 0px;
        padding-left: 0px;
        padding-right: 0px;
        padding-bottom: 0px;
        margin: 0px;
    }

    .content {
        margin-right: 10px;
        _height: 950px;
        _max-height: 950px;
        padding: 10px;
        position: relative;
        padding-top: 3px;
        width: 100%;
    }

    .jqx-widget-jqxtabs {
        border: none;
    }

    .jqx-widget-header-jqxtabs {
        border: none;
        background: transparent;
    }

    .jqx-tabs-title-jqxtabs {
        color: #3F3F3F;
        font-weight: 300 !important;
        border: none;
        border-bottom: 5px solid transparent;
    }

    .jqx-tabs-title-selected-top-jqxtabs {
        color: #3F3F3F;
        border: none;
        background: transparent;
        border-bottom: 5px solid #00a2e8;
        -webkit-transition: color 0.3s ease 0s;
        -moz-transition: color 0.3s ease 0s;
        -ms-transition: color 0.3s ease 0s;
        -o-transition: color 0.3s ease 0s;
        transition: color 0.3s ease 0s;
    }
    .jqx-tabs-title-selected-top-jqxtabs:hover {
        color: #00a2e8;
    }
    .jqx-tabs-title-hover-top-jqxtabs {
        background: none;
        color: #00a2e8;
        border-color: transparent;
        -webkit-transition: color 0.3s ease 0s;
        -moz-transition: color 0.3s ease 0s;
        -ms-transition: color 0.3s ease 0s;
        -o-transition: color 0.3s ease 0s;
        transition: color 0.3s ease 0s;
        border-bottom: 5px solid transparent;
    }
    .jqx-tabs-title-hover-top-jqxtabs {
        color: #00a2e8;
    }

    .navigation {
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        top: 0px;
        max-width: 200px;
        width: 200px;
        min-width: 200px;
        top: 380px;
        outline: none;
        background: transparent;
        display: block;
        border: 1px solid #e9e9e9;
        border-top: none;
        border-bottom: none;
        height: 100%;
        -webkit-box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        -moz-box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        padding: 0px;
         border-color: transparent;
         border-color: rgba(233, 233, 233, 1);
         background: transparent;
         background: rgba(255, 255, 255, 1);
         background: transparent\9;
        *background: transparent;
        *border-color:transparent;
    }

    .demoContainer {
        width: 916px;
        top: 0px;
        left: 0px;
        padding: 8px;
        min-height: 1160px;
        vertical-align: top;
        margin-left: 0px;
        margin-top: 0px;
        margin-bottom: 0px;
        margin-right: 0px;
        display: block;
        background: #fff;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        border: 1px solid #e9e9e9;
        -webkit-box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        -moz-box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
    }

    .welcomeContent {
        font-size: 13px;
        font-family: Verdana;
        text-align: left;
        padding: 0px;
        margin: 20px;
        color: #3F3F3F;
    }

    .megamenu-ul li {
        margin: 5px;
        list-style: none;
    }

        .megamenu-ul li a:link {
            text-decoration: none;
        }

        .megamenu-ul li a:hover {
            text-decoration: underline;
        }

    .topNavigation {
        padding-top: 0px !important;
        margin-bottom: 10px;
        margin-left: auto;
        margin-right: auto;
        width: 1160px;
    }

    .topNavigation {
        background: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, rgba(0,0,0,0.02) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.02)));
        background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
        background: -o-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
        background: -ms-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
        background-color: #fdfdfd;
    }

    .topNavigation-item, .demoLink {
        font-family: Verdana,Arial,sans-serif;
        font-style: normal;
        text-align: left;
        vertical-align: middle;
        margin-left: 10px;
        margin-right: 10px;
        font-size: 12px;
        padding: 12px 10px 12px 5px;
        text-shadow: 0 1px 0 #FFFFFF;
    }

        .topNavigation-item a, .demoLink {
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -ms-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            color: #3F3F3F;
            text-decoration: none;
            float: left;
            margin-left: 4px;
        }

            .topNavigation-item a:hover, .demoLink:hover {
                color: #00a2e8;
                text-shadow: none;
            }

    .demoLink {
        float: none;
        margin: 0px;
        padding: 0px;
    }

    .topNavigation-item img {
    }


    .table-rc-all {
        -moz-border-radius: 6px;
        -webkit-border-radius: 6px;
        border-radius: 6px;
    }

    .navigationBar {
        margin: 0px auto;
        list-style: none;
        width: 1150px;
    }

        .navigationBar li {
            float: left;
            margin-right: 35px;
            display: list-item;
        }

    .widgetsNavigation {
        min-height: 268px;
    }

    .navigationBarActive-overlay {
        display: block;
        border-color: #cccccc transparent;
        border-style: solid;
        border-width: 0 7px 7px;
        margin: -7px 0 0 -7px;
        width: 0;
        position: relative;
        height: 0;
    }

    .navigationBarActive {
        display: block;
        border-color: #ffffff transparent;
        border-style: solid;
        border-width: 0 7px 7px;
        margin: -6px 0 0 -7px;
        width: 0;
        position: relative;
        height: 0;
    }

    .navigationBar a {
        font-family: Verdana,Arial,sans-serif;
        display: block;
        text-decoration: none;
        font-size: 14px;
        line-height: 40px;
        color: #000;
        text-shadow: 1px 1px 0 #fff;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -ms-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }

        .navigationBar a:hover {
            color: #00a2e8;
            text-shadow: none;
        }

    .navTableHeader {
        font-family: Verdana,Arial,sans-serif;
        display: block;
        font-size: 11px;
        color: #4e4e4e;
        text-shadow: 1px 1px 0 #FFF;
        margin-left: 15px;
        padding-left: 1px;
        padding-top: 10px;
        padding-bottom: 5px;
        border-bottom: 1px solid #eeeeee;
    }

    .navigationHeader {
        height: 40px;
        padding-top: 10px;
        background: #f3f5f7;
    }

    .navigationContainer {
        min-width: 960px;
        top: 0px;
        left: 0px;
        vertical-align: top;
        border-top: 1px solid #CCCCCC;
        border-bottom: 1px solid #CCCCCC;
        margin-left: 0px;
        margin-top: 0px;
        margin-bottom: 0px;
        margin-right: 0px;
        display: block;
        background: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, rgba(0,0,0,0.02) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.02)));
        background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
        background: -o-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
        background: -ms-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.02) 100%);
        background-color: #fdfdfd;
        -moz-box-shadow: inset 1px -1px 0 #fff, 0 2px 2px rgba(0,0,0,0.05);
        -webkit-box-shadow: inset 1px -1px 0 #fff, 0 2px 2px rgba(0,0,0,0.05);
        box-shadow: inset 1px -1px 0 #fff, 0 2px 2px rgba(0,0,0,0.05);
        border-bottom: 1px solid #ccc;
    }

    .navigatorInnerContainer {
        margin: 0px auto;
        width: 100%;
        max-height: 1050px;
        padding: 0px;
        border: 0px solid transparent;
    }

    .jqxDemoContainer {
        margin: 0px auto;
        width: 1160px;
        position: relative;
        margin-top: 5px;
    }



    .bottom {
        border-top: 1px solid #686868;
        width: 1150px;
        height: 100%;
        margin: 0 auto;
        color: #777777;
        font-family: Verdana,Arial,Helvetica,sans-serif;
        font-size: 12px;
        line-height: 16px;
        width: 100%;
        background: #1c1e24;
        overflow: hidden;
        padding-bottom: 5px;
    }

    .top {
        overflow: hidden;
        min-height: 60px;
        width: 1150px;
        height: 100%;
        margin: 0 auto;
        color: #777777;
        font-family: Verdana,Arial,Helvetica,sans-serif;
        font-size: 12px;
        line-height: 16px;
        width: 100%;
    }

    .

    .navigatorOuterTable {
        margin: 0 auto;
        table-layout: fixed;
        width: 100%;
        min-height: 100%;
        height: auto;
        height: 100%;
        border-collapse: collapse;
    }

        .navigatorOuterTable td:first-child {
            margin: 0px;
            border: none;
            padding: 0px;
        }

    .demoTabs {
        display: none;
    }

    .contentTable {
        table-layout: fixed;
        border-collapse: collapse;
        margin: 0px;
        padding: 0px;
    }

    .navigatorInnerTable, .navigatorTable {
        width: 100%;
        table-layout: fixed;
        margin: 0px;
        border-collapse: collapse;
        padding: 0px;
        border: none;
    }

#dddd{
  display: none;
}

#preloader {
  position: fixed;
  width: 100%;
  height: 100%;
  background: #fff;
  z-index: 999; /* makes sure it stays on top */
}
#demos #camera {
  width: 300px;
  height: 300px;
  position: absolute;
  left: 25%; /* centers the loading animation horizontally one the screen */
  _top: 50%; /* centers the loading animation vertically one the screen */
  background-image: url('<?php echo base_url('images/ajax-loader.gif'); ?>'); /* path to your loading animation */
  background-repeat: no-repeat;
  background-position: center;
  _margin: -150px 0 0 -150px /* is width and height divided by two */
  z-index: 999;
}

</style>


    <script type="text/javascript">
        var theme = 'classic';
        var csrf_tokens='';
        
      // var type= [{value:"2", label:"Recovery"},{value:"1", label:"Legal"}];
        var arrested = [{value:"Yes", label:"Yes"},{value:"No", label:"No"},];
        var appeal_bail_type = [<? $i=1; foreach($appeal_bail_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
       var valid_rule =[];
       
        var proposed_type =['Loan','Card'];

    jQuery(document).ready(function () {

        jQuery("#s_proposed_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, width: 150, height: 25});
        jQuery("#arrested").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: arrested, width: 250, height: 25});
        jQuery("#appeal_bail_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: appeal_bail_type, width: 250, height: 25});
        
        //jQuery("#group_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: user_group, width: 250, height: 25});
       
        jQuery('#arrested,#s_proposed_type,#appeal_bail_type').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });

        jQuery("#s_proposed_type").jqxComboBox('val','Loan');
        change_caption();
        jQuery('#s_proposed_type').bind('change', function (event) {
            jQuery("#s_account").val('');
            jQuery("#hidden_loan_ac").val('');
            change_caption();       
        });

        jQuery('#deposited_amount').bind('change',function(){
            var claim_amt = jQuery('#case_claim_amount').val();
            var deposited_amount = jQuery('#deposited_amount').val();
            var percent = (deposited_amount/claim_amt)*100;
            percent = percent.toFixed(2);
            jQuery('#percent').html(percent+'%');
            jQuery('#percent_deposit').val(percent);
        });
        
        // Add edit form validation
        jQuery('#action_form').jqxValidator({
            rules: [
        
            { input: '#arrested', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#arrested").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='arrested']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#arrested input").focus();
                            return false;
                        }
                }
            },
            { input: '#appeal_bail_type', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#appeal_bail_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='appeal_bail_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#appeal_bail_type input").focus();
                            return false;
                        }
                }
            },
            
             { input: '#deposite_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                    }
                    else {
                        return false;
                    }
                } 
                },
                { input: '#deposite_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
            
            { input: '#deposited_amount', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#deposited_amount").val()=='')
                    {
                        jQuery("#deposited_amount").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                    
                }
            },

            
            { input: '#deposited_amount', message: 'Number is required!', action: 'keyup, blur', rule: function(input,commit){
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabaticDot('deposited_amount'))
                        {
                            jQuery("#deposited_amount").focus();
                            return false;

                        }
                    }
                    return true;
                }
            },
            
            ]
        });
       
        // Jqx tab second tab function start    Grid Show
        var initGrid2 = function () {
            var source ={
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'int'},
                    { name: 'cma_id', type: 'int'},
                    { name: 'suit_id', type: 'int'},
                    { name: 'life_cycle', type: 'int'},
                    { name: 'loan_ac', type: 'string'},
                    { name: 'ac_name', type: 'string'},
                    { name: 'case_number', type: 'string'},
                    { name: 'deposit_amt', type: 'string'},
                    { name: 'deposit_dt', type: 'string'},
                    { name: 'depo_dt', type: 'string'},
                    { name: 'arrested', type: 'string'},
                    { name: 'appeal_bail_type_name', type: 'string'},
                    { name: 'case_claim_amount', type: 'string'},
                    { name: 'deposit_percent', type: 'string'},
                    { name: 'deposit_amount', type: 'string'},
                    { name: 'total_percent', type: 'string'},
                    { name: 'unverify', type: 'string'},
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
                url: '<?=base_url()?>index.php/appeal_bail_money/pending_grid',
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
                },
                formatData: function (data) {
                    
                    var s_case_number = jQuery.trim(jQuery('#s_case_number').val());
                    var s_name = jQuery.trim(jQuery('#s_name').val());
                    var s_account = jQuery.trim(jQuery('#s_account').val());
                    var item = jQuery('#s_proposed_type').jqxComboBox('getSelectedItem');
                    var proposed_type='';
                    if(item!=null){
                        proposed_type=item.value;
                    }
                    jQuery.extend(data, {
                            case_number : s_case_number,
                            ac_name : s_name,
                            account : s_account,
                            proposed_type : proposed_type,
                    });
                    return data;
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
                rendergridrows: function(obj){
                    return obj.data;
                },
                columns: [

                    { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
                    { text: 'cma_id', datafield: 'cma_id',hidden:true },
                    { text: 'suit_id', datafield: 'suit_id',hidden:true },
                    { text: 'depo_dt', datafield: 'depo_dt',hidden:true },
                    { text: 'v_sts', datafield: 'v_sts',hidden:true },
                    { text: 'sts', datafield: 'sts',hidden:true },
                    
                    <?php if(EDIT==1){ ?>
                    { text: 'E', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%', cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        //console.log(dataRecord.unverify);
                        if(dataRecord.unverify==0 ){

                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="loadsuit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
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
                    { text: 'Account Name', datafield: 'ac_name',editable: false, width: '13%'},
                    { text: 'Account', datafield: 'loan_ac',editable: false, width: '13%'},
                    { text: 'Case Number', datafield: 'case_number',editable: false, width: '13%'},
                    { text: 'Type', datafield: 'appeal_bail_type_name',editable: false, width: '13%'},
                    { text: 'Case Claim Amount', datafield: 'case_claim_amount',editable: false, width: '13%'},
                    { text: 'Total Deposite %', datafield: 'deposit_percent',editable: false, width: '13%'},
                    { text: 'Pending Deposite %', datafield: 'total_percent',editable: false, width: '13%'},
                    { text: 'Deposited Amount', datafield: 'deposit_amount',editable: false, width: '13%'},
                    { text: 'Deposite Date No', datafield: 'deposit_dt',editable: false, width: '13%'},
                    { text: 'Arrested', datafield: 'arrested',editable: false, width: '13%'},
                    
                ],
                        
            });
                
            jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:550, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#verifycancel,#sendtocheckercancel") });
            jQuery('#details').on('close', function (event) {
                jQuery('#delete_convence').jqxValidator('hide');
                
            });
            
        }
        
        // jqx tab init
        var initWidgets = function (tab) {
            switch (tab) {
                case 0:
                	initGrid2();
                    break;
                case 1:
                    
                    break;
            }
        }
        //document.getElementById("jqxTabs").style.minHeight = "280px";
        jQuery('#jqxTabs').jqxTabs({ width: '99%', initTabContent: initWidgets });
        
        jQuery('#jqxTabs').bind('selected', function (event) {

            if(event.args.item==0){
                clear_form();
                jQuery('#jqxTabs').jqxTabs('disableAt', 1);
            }
            jQuery('#action_form').jqxValidator('hide');
            //clear_form();
        });
        jQuery('#jqxTabs').jqxTabs('disableAt', 1);

        // Add Form Submit
        jQuery("#in_req_button").click( function() {
            var validationResult = function (isValid) {
                if (isValid) {
                    jQuery("#in_req_button").hide();
                    jQuery("#in_req_loading").show();
                    //jQuery("#legal_notice_form").submit();
                    call_ajax_submit();
                }
            }
            jQuery('#action_form').jqxValidator('validate', validationResult);        
        });
        // Update Edit Form Submit
        jQuery("#in_up_button").click( function() {
            
            var validationResult = function (isValid) {
                if (isValid ) {
                    jQuery("#in_up_button").hide();
                    jQuery("#in_up_loading").show();
                    //jQuery("#legal_notice_form").submit();
                    call_ajax_submit();
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
            
                jQuery("#sendtochecker").hide();
                jQuery("#verifycancel").hide();
                jQuery("#verify_row").show();
                delete_submit();
            
         });
        jQuery("#sendtochecker_button").click(function () {
            
                jQuery("#sendtochecker_button").hide();
                jQuery("#sendtocheckercancel").hide();
                jQuery("#sendtochecker_loading").show();
                delete_submit();
            
         });
       
    });
var count=0; var maxrow = 0; var displayrow= 0; inc = 0; decr = 0;
function clearCount() { count=0; maxrow = 0;displayrow= 0;}
function search_grid(){
    jQuery("#jqxGrid2").jqxGrid('updatebounddata');
    return;
}
function mask(str,textbox){
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
    if (jQuery("#s_proposed_type").val()=='') 
    {
        document.getElementById("s_account").disabled = true;
        jQuery("#l_or_c_no").html('Loan A/C or Card');
    }
    else
    {
        document.getElementById("s_account").disabled = false;
        var item = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
        if (item.value=='Loan') {
            jQuery("#l_or_c_no").html('Loan A/C ');
        }
        else if(item.value=='Card'){
            jQuery("#l_or_c_no").html('Card');
        }
    }
    
}

function call_ajax_submit(){
    
    var postdata = jQuery('#action_form').serialize();
    var add_edit = jQuery("#add_edit").val();
    var edit_row = jQuery("#edit_row").val();
    
    //console.log(postdata);
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>appeal_bail_money/add_edit_action/"+add_edit+"/"+edit_row,
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
                    jQuery('#jqxTabs').jqxTabs('select', 0);
                    
                }else{
                    jQuery("#in_req_button").show();
                    jQuery("#in_req_loading").hide();
                }
                alert(json.Message);
                jQuery('#add_form').hide();
                //jQuery('#search_area').show();
                return false;
            }
            var msg='';
            if(edit_row>0){
                msg='Updated';
            }else{
                msg="Saved";
            }
            jQuery('#jqxTabs').jqxTabs('select', 0);
            //clear_form();
            jQuery("#error").show();
            jQuery("#error").fadeOut(11500);
            jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+msg);
            if(add_edit=='edit'){
                jQuery("#in_up_loading").hide();
                jQuery("#in_up_button").show();
                
            }else{
                jQuery("#in_req_button").show();
                jQuery("#in_req_loading").hide();
            }
            jQuery("#jqxGrid2").jqxGrid('updatebounddata');
            jQuery('#add_form').hide();
            //jQuery('#search_area').show();
            jQuery('#s_account').val('');
            jQuery('#s_case_number').val('');
            jQuery('#searchTable').html('');
            jQuery('#jqxTabs').jqxTabs('select', 0);
            
        }
    });
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
        url: '<?=base_url()?>index.php/appeal_bail_money/delete_action/',
        data : postData,
        datatype: "json",
        success: function(response){
            //console.log(response);
            var json = jQuery.parseJSON(response);
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
                    jQuery("#verify_button").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }else if ($('type').value=='sendtochecker') 
                {
                    
                    jQuery("#sendtochecker_button").show();
                    jQuery("#sendtocheckercancel").show();
                    jQuery("#sendtochecker_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }
                else
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
                    jQuery("#verify_button").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_loading").hide();
                    jQuery('#details').jqxWindow('close');
                    
                }else if($('type').value=='sendtochecker'){
                    
                    jQuery("#sendtochecker_button").show();
                    jQuery("#sendtocheckercancel").show();
                    jQuery("#sendtochecker_loading").hide();
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
    jQuery("#add_button").hide();
    jQuery("#up_button").show();
    jQuery("#in_up_button").show();
    //jQuery('#search_area').hide();
    jQuery('#add_form').show();
    jQuery('#add_edit').val('edit');
    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
   // console.log(dataRecord);
    var suit_id = dataRecord['suit_id'];
    var id = dataRecord['id'];
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>appeal_bail_money/get_case_edit_info",
        data : {[csrfName]: csrfHash,suit_id:suit_id,id:id},
        datatype: "json",
        async:false,
        success: function(response){
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;
            //console.log(rows);
            //jQuery("#executed_counter").val(rows.length);
            var appeal_bail_scan_copy = rows.appeal_bail_scan_copy;
            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'appeal_bail_scan_copy\')"/>';
            html+='<input type="hidden" id="hidden_appeal_bail_scan_copy_select" name="hidden_appeal_bail_scan_copy_select" value="0">';
            if(appeal_bail_scan_copy!='' && appeal_bail_scan_copy!=null)
            {
                html +='<span id="hidden_appeal_bail_scan_copy"><img id="file_preview_appeal_bail_scan_copy" onclick="popup(\'<?=base_url()?>cma_file/appeal_bail_scan_copy/'+appeal_bail_scan_copy+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                html +='<input type="hidden" id="hidden_appeal_bail_scan_copy_value" name="hidden_appeal_bail_scan_copy_value" value="'+appeal_bail_scan_copy+'">';
                html +='<img id="file_delete_appeal_bail_scan_copy" onclick="file_delete(\'appeal_bail_scan_copy\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                html +='<input type="hidden" id="file_delete_value_appeal_bail_scan_copy" name="file_delete_value_appeal_bail_scan_copy" value="0">';
            }
            else
            {
                html+='<span id="hidden_appeal_bail_scan_copy">';
            }
            html+='<span id="hidden_appeal_bail_scan_copy">';
            jQuery('#appeal_bail_scan_copy').html(html);

            jQuery('#req_type').val(rows.req_type);
            jQuery('#cma_district').val(rows.district);
            
            jQuery('#deposited_amount').val(rows.deposit_amt);
            jQuery('#deposite_date').val(rows.deposit_date);
            jQuery('#arrested').jqxComboBox('clearSelection');
            jQuery('#arrested').jqxComboBox('val',rows.arrested);
            jQuery('#appeal_bail_type').jqxComboBox('clearSelection');
            jQuery('#appeal_bail_type').jqxComboBox('val',rows.appeal_bail_type);

            jQuery('#loan_ac_ds').html(rows.loan_ac);
            jQuery('#loan_ac_na').html(rows.ac_name);
            jQuery('#case_num').html(rows.case_number);
            //jQuery('#cma_id').val(rows.cma_id);
            jQuery('#suit_id').val(rows.suit_id);
            jQuery('#wa_id').val(rows.wa_id);
            jQuery('#edit_row').val(rows.id);

            jQuery('#card_loan_ac').val(rows.org_loan_ac);
            jQuery('#proposed_type').val(rows.proposed_type);
            jQuery('#propose').html(rows.proposed_type);
            jQuery('#loan_ac').val(rows.loan_ac);
            jQuery('#ac_name').val(rows.ac_name);
            jQuery('#req_type').val(rows.req_type);
            jQuery('#case_number').val(rows.case_number);
            jQuery('#region').val(rows.region);

        }
    });
    //jQuery('#jqxTabs').jqxTabs('enableAt', 1);
    
    
}
function clear_form(){
    //jQuery('#search_area').show();
    jQuery('#add_form').hide();
    jQuery("#cma_id").val('');
    jQuery("#edit_row").val('');
    jQuery("#add_edit").val('add');
    jQuery('#ac_number').val('');
    jQuery('#ac_name').val('');
    jQuery('#suit_id').val('');
    jQuery('#wa_id').val('');
    jQuery('#case_number').val('');

    jQuery('#card_loan_ac').val('');
    jQuery('#proposed_type').val('');
    jQuery('#propose').html('');
    jQuery('#loan_ac_ds').html('');
    jQuery('#loan_ac_na').html('');
    jQuery('#case_num').html('');
    jQuery('#loan_ac').val('');
    jQuery('#req_type').val('');
    jQuery('#region').val('');

    jQuery('#deposited_amount').val('');
    jQuery('#expense_counter').val(1);
    jQuery('#deposite_date').val('');
    jQuery('#arrested').jqxComboBox('clearSelection');
    jQuery("input[name='arrested']").val('');
    jQuery("#add_button").show();
    jQuery("#up_button").hide();
    jQuery('#expense_body').children().slice(1).remove();
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
        jQuery("#sendtochecker_row").hide();
        jQuery("#delete_row").show();
    }else if(operation=='sendtochecker'){
        
        jQuery("#deleteEventId").val(id);
        jQuery("#verifyid").val('');
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#delete_row").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtochecker_row").show();
    }else if(operation=='verify'){

        jQuery("#deleteEventId").val('');
        jQuery("#verifyid").val(id);
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#sendtochecker_row").hide();
        jQuery("#delete_row").hide();
        jQuery("#verify_row").show();
    }
    else{
        jQuery("#deleteEventId").val('');
        jQuery("#verifyid").val('');
        jQuery("#delete_row").hide();
        jQuery("#sendtochecker_row").hide();
        jQuery("#verify_row").hide();
        jQuery("#preview").show();
    }
    
    //console.log(dataRecord);
    jQuery("#r_heading").html('Appeal and Bail Deposit Money');

    var cma_id = dataRecord['cma_id'];
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>appeal_bail_money/get_details_pending_apeal/"+id,
        data : {[csrfName]: csrfHash},
        datatype: "json",
        async:false,
        success: function(response){
            //console.log(response);
            var ds=response.split('####');
            jQuery('.txt_csrfname').val(ds[1]);
            /*var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;*/
           // console.log(ds[0]);
            jQuery('#previewtable').html(ds[0]);
        }
    });
    
    /*jQuery("#d_suit_id").val(dataRecord['suit_id']);
    jQuery("#p_account_name").html(dataRecord['ac_name']);
    jQuery("#p_account").html(dataRecord['loan_ac']);
    jQuery("#p_case_number").html(dataRecord['case_number']);
    jQuery("#p_amount").html(dataRecord['deposit_amt']);
    jQuery("#p_date").html(dataRecord['deposit_dt']);
    jQuery("#p_arrested").html(dataRecord['arrested']);*/

    document.getElementById("details").style.display='block';
    jQuery("#details").jqxWindow('open');
}

// 
function search_data(){
    var loan_ac = jQuery('#s_account').val();
    var case_number = jQuery('#s_case_number').val();
    var s_proposed_type = jQuery("#s_proposed_type").jqxComboBox('getSelectedItem');
    
    if(s_proposed_type==null && loan_ac=='' && case_number=='')
    {
        alert('Please provide at least one search parameter!!!');
    }
    else
    {
        jQuery("#grid_loading").show();
        //jQuery("#load").hide();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var postdata = jQuery('#form').serialize();
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>index.php/appeal_bail_money/search_case/",
            data : postdata,
            datatype: "html",
            success: function(response){
                jQuery("#grid_loading").hide();
                var data = response.split("####");
                jQuery('.txt_csrfname').val(data[1]);
                jQuery("#load_suit_loading").hide();
                jQuery("#load").show();
                jQuery('#searchTable').html(data[0]);

            }
        });
    }

}

// Only One Checkbox Select At a time
function onlyOne(checkbox) {
    //var id = document.getElementsByName('suit_id').value;
    //console.log(checkbox.value)
    var checkboxes = document.getElementsByName('wa_id')
    checkboxes.forEach((item) => {
        //console.log(item)
        if (item !== checkbox) item.checked = false
    })
}

function loadsuit(id,editrow){
    //alert('ddd')
    clear_form();
    jQuery('#jqxTabs').jqxTabs('enableAt',1);
    jQuery('#jqxTabs').jqxTabs('select', 1);
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>appeal_bail_money/ni_pending_deposit",
        data : {[csrfName]: csrfHash,id:id},
        datatype: "json",
        async:false,
        success: function(response){
           
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            // var arr=Object.entries(json.row_info);
            //console.log(json.row_info.case_number);
            //val,0,
            
            //var case_number = jQuery('#case_number').val();
            //jQuery('#search_area').hide();
            jQuery('#add_form').show();
            var rows = json.row_info;
            //console.log(rows);
            jQuery('#ac_number').val('');
            jQuery('#ac_name').val('');
            if(rows!=null){
                //console.log(rows.org_loan_ac)
                /*if(rows.executed<4){
                    var diposit= rows.case_claim_amount/rows.executed;
                }else{*/
                    var deposit= rows.case_claim_amount*(rows.pending_perchent/100);
                //}
                var html = '';
                html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'appeal_bail_scan_copy\')"/>';
                html+='<input type="hidden" id="hidden_appeal_bail_scan_copy_select" name="hidden_appeal_bail_scan_copy_select" value="0">';
                html+='<span id="hidden_appeal_bail_scan_copy">';
                jQuery('#appeal_bail_scan_copy').html(html);

                jQuery('#appeal_bail_type').jqxComboBox('clearSelection');
            	jQuery('#appeal_bail_type').jqxComboBox('val',rows.appeal_bail_type);
                jQuery('#appeal_bail_type').jqxComboBox({ disabled: true });

                jQuery('#loan_ac_ds').html(rows.loan_ac);
                jQuery('#loan_ac_na').html(rows.ac_name);
                jQuery('#case_num').html(rows.case_number);
                jQuery('#propose').html(rows.proposed_type);
                jQuery('#cma_id').val(rows.cma_id);
                jQuery('#req_type').val(rows.req_type);
                jQuery('#cma_district').val(rows.district);
                jQuery('#suit_id').val(rows.id);
                //jQuery('#wa_id').val(rows.id);
                
                jQuery('#card_loan_ac').val(rows.org_loan_ac);
                jQuery('#proposed_type').val(rows.proposed_type);
                
                jQuery('#loan_ac').val(rows.loan_ac);
                jQuery('#ac_name').val(rows.ac_name);
                jQuery('#case_number').val(rows.case_number);
                jQuery('#region').val(rows.region);

                jQuery('#deposited_amount').val(deposit);
                jQuery('#case_claim_amount').val(rows.case_claim_amount);
                var percentage = (deposit/rows.case_claim_amount)*100;
                percentage = percentage.toFixed(2);
                jQuery('#percent').html(percentage+'%');
                jQuery('#percent_deposit').val(percentage);
                
            }else{
                alert("No Data Found");
            }
        }
    });

}

function load_case(row_info){
    
    //var case_number = jQuery('#case_number').val();
    //jQuery('#search_area').hide();
    jQuery('#add_form').show();
    var case_number = row_info.case_number;
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery('#action_form').jqxValidator('hide');
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>appeal_bail_money/get_case_info",
        data : {[csrfName]: csrfHash,case_number:case_number},
        datatype: "json",
        async:false,
        success: function(response){
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;
            //console.log(rows);
            jQuery('#ac_number').val('');
            jQuery('#ac_name').val('');
            if(rows!=null){
                //alert(rows.loan_ac)

                jQuery('#loan_ac_ds').html(rows.loan_ac);
                jQuery('#loan_ac_na').html(rows.ac_name);
                jQuery('#case_num').html(case_num);
                jQuery('#cma_id').val(rows.cma_id);
                jQuery('#suit_id').val(rows.id);
            }
        }
    });
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
function file_delete(id){
    if(confirm('Are you sure to Delete previous file?')){   
        jQuery("#file_preview_"+id).hide(); 
        jQuery("#file_delete_"+id).hide();  
        jQuery("#file_delete_value_"+id).val(1);    
    }
}
</script>
<script type="text/javascript">
 
    </script>
<div id="container">
    <div id="body">
        <table class="">
            <tr id="widgetsNavigationTree">
                <td valign="top" align="left" class='navigation'>
                    <!---- Left Side Menu Start ------>
                    <?php $this->load->view('appeal_bail_money/pages/left_side_nav'); ?>
                    <!----====== Left Side Menu End==========----->
                </td>
                <td valign="top" id="demos" class='rc-all content'>
                    <div id="preloader">
                      <div id="camera"></div>
                    </div>
                    <div id="">
                    <div id='jqxTabs'>
                        <ul>
                            <li style="margin-left: 30px;">Data Grid</li>
                            <li>Form</li>
                        </ul>
                        <div style="overflow: hidden;">
                             <form method="POST" name="form" id="form"  style="margin:0px;">
                                <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                               <div style="padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                    <table id="deal_body" style="display:block;width:100%">
                                        <tr>
                                            <td><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                            <td><div id="s_proposed_type" name="s_proposed_type"></div></td>
                                            <td style="width: 100px;"><strong><span id="l_or_c_no"></span>&nbsp;&nbsp;</strong> </td>
                                            <td><input name="s_account" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="s_account" value="" onKeyUp="javascript:return mask(this.value,this);"/>
                                            </td>

                                            <td ><strong>Case Number&nbsp;&nbsp;</strong> </td>
                                            <td><input type="text" id="s_case_number" name="s_case_number" style="width:100%" /></td>
                                            
                                            <td><strong>Account Name&nbsp;&nbsp;</strong> </td>
                                            <td><input type="text" id="s_name" name="s_name" style="width:100%" /></td>
                                            <td ><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_grid(),clearCount()" style="width:58px" />
                                            </td>
                                        </tr>
                                    </table>
                              </div>
                              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                            </form>
                            <br>
                            <div style="border:none;" id="jqxGrid2"></div>
                            <div style="float:left;padding-top: 5px;margin-left: 5px;margin-bottom: 20px;">
                            <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                            
                                <strong>E = </strong> Edit,&nbsp;
                                <strong>D = </strong> Delete,&nbsp;
                                <strong>S = </strong> Send to Checker,&nbsp;
                                <strong>V = </strong> Verify,&nbsp;
                                <strong>P = </strong> Preview&nbsp;
                               
                            </div>
                            </div>
                            
                        </div>
                    
                        <!---==== First Tab Start ==========----->
                        <div style="overflow: hidden;">
                            
                           <div id="add_form" style="padding: 10px;display: none;">
                            <form class="form" name="action_form" id="action_form" method="post" action="<?=base_url()?>index.php/appeal_bail_money/add_edit_action" enctype="multipart/form-data">
                                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <input type="hidden" id="add_edit" value="add" name="add_edit">
                                <input type="hidden" id="edit_row" value="" name="edit_row">
                                <input type="hidden" id="cma_id" value="" name="cma_id">
                                <input type="hidden" id="suit_id" value="" name="suit_id">
                                <input type="hidden" id="wa_id" value="" name="wa_id">
                                <input type="hidden" id="card_loan_ac" value="" name="card_loan_ac">
                                <input type="hidden" id="proposed_type" value="" name="proposed_type">
                                <input type="hidden" id="loan_ac" value="" name="loan_ac">
                                <input type="hidden" id="ac_name" value="" name="ac_name">
                                <input type="hidden" id="case_number" value="" name="case_number">
                                <input type="hidden" id="region" value="" name="region">
                                <input type="hidden" id="case_claim_amount" value="" name="case_claim_amount">
                                <table style="width: 100%;">
                                    
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Type<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="appeal_bail_type" name="appeal_bail_type"></div></td>
                                        <td width="50%" colspan="2" rowspan="4">
                                            <table border="1" cellpadding="5">
                                                <tr>
                                                    <td><b>Proposed Type</b></td>
                                                    <td><b>Loan Account</b></td>
                                                    <td><b>Account Name</b></td>
                                                    <td><b>Case Number</b></td>
                                                </tr>
                                                <tr>
                                                    <td id="propose"></td>
                                                    <td id="loan_ac_ds"></td>
                                                    <td id="loan_ac_na"></td>
                                                    <td id="case_num"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Deposited Amount<span style="color:red">*</span> </td>
                                        <td width="30%" ><input name="deposited_amount" type="text" class="" style="width:200px" id="deposited_amount" value="" placeholder="Deposited Amount" /><input type="hidden" name="percent_deposit" id="percent_deposit"><span id="percent"></span></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Date<span style="color:red">*</span> </td>
                                        <td width="30%" ><input name="deposite_date" type="text" class="" style="width:250px" id="deposite_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker ("deposite_date");</script></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Arrested?<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="arrested" name="arrested" style="padding-left: 3px"></div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Scan copy Upload: </td>
                                        <td width="30%" ><span id="appeal_bail_scan_copy"></span></td>
                                    </tr>
                                   
                                    <? if(ADD==1){?>
                                    <tr id="add_button" >
                                        <td colspan="4" style="text-align: center;">
                                            <br/>
                                            <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="sendButton"/> 
                                            <span id="send_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                            <br/><br/><br/>
                                        </td>
                                    </tr>
                                    <? } ?>
                                    <? if(EDIT==1){?>
                                    <tr id="up_button" style="display: none;">
                                        <td colspan="4" style="text-align: center;">
                                            <br/>
                                            <input type="button" value="Update" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_up_button"/>
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
        <div id="sendtochecker_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
            <!-- <br><br>
            <strong style="vertical-align:top">Remarks<span style="color: red;">*</span></strong>
            <textarea name="comments" id="comments" style="width:370px;"></textarea> -->
            
            <br><br>
            <input type="button" class="buttonSend" id="sendtochecker_button" value="Send To Checker">
            <input type="button" class="buttonclose" id="sendtocheckercancel" onclick="close()" value="Cancel">
            <span id="sendtochecker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
            
        </div>
        <div id="verify_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
            <br><br>
            <input type="button" class="buttonSend" id="verify_button" value="Verify">
            <input type="button" class="buttonclose" id="verifycancel" onclick="close()" value="Cancel">
            <span id="verify_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
            
        </div>
        
        </form>
    </div>
</div>
<script>

jQuery('#jqxGrid2').ready(function() {

    jQuery('#camera').fadeOut(); // will first fade out the loading animation 
    jQuery('#preloader').delay( 300 ).fadeOut( 'slow'); // will fade out the white DIV that covers the website. 
    jQuery('#dddd').css( { 'display': 'block' } );
    
});
</script>

<script type="text/javascript">
var theme = getDemoTheme();
    rules= [{ input: '#arrested', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#arrested").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='arrested']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#arrested input").focus();
                            return false;
                        }
                }
            },
            
             { input: '#deposite_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                    }
                    else {
                        return false;
                    }
                } 
                },
                { input: '#deposite_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
            
            { input: '#deposited_amount', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#deposited_amount").val()=='')
                    {
                        jQuery("#deposited_amount").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                    
                }
            },

            
            { input: '#deposited_amount', message: 'Number is required!', action: 'keyup, blur', rule: function(input,commit){
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabaticDot('deposited_amount'))
                        {
                            jQuery("#deposited_amount").focus();
                            return false;

                        }
                    }
                    return true;
                }
            },];
    var options = { 
            complete: function(response) 
            {
                //console.log(response);
                var json = jQuery.parseJSON(response.responseText); 
                window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if(json.Message!='OK')
                {   
                    jQuery("#sendButton").show();
                    jQuery("#send_loading").hide();     
                    alert(json.Message);                    
                    return false;
                }else{
                    jQuery("#sendButton").show();
                    jQuery("#send_loading").hide();
                    jQuery("#jqxGrid2").jqxGrid('updatebounddata');
                    jQuery('#jqxTabs').jqxTabs('select', 0);
                    jQuery('#add_form').hide();
                    //jQuery('#search_area').show();
                    jQuery('#s_account').val('');
                    jQuery('#s_case_number').val('');
                    jQuery('#searchTable').html('');
                    jQuery("#msgArea").val('');
                    jQuery("#error").show();
                    jQuery("#error").fadeOut(11500);
                    jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
                    //reload();
                    
                }
                            
            }  
        }; 
        jQuery("#action_form").ajaxForm(options);
        jQuery("#sendButton").click( function() {
            jQuery('#action_form').jqxValidator({
                    rules: rules, theme: theme
            });
           
                /*if (jQuery("#hidden_appeal_bail_scan_copy_select").val()==0) {
                    alert('Please Upload Appeal Bail Scan Copy File');
                    return false;
                }*/
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#sendButton").hide();
                        jQuery("#send_loading").show();
                        jQuery("#action_form").submit();
                    }
                    else{return;}
                }
                jQuery('#action_form').jqxValidator('validate', validationResult);     
        });
</script>