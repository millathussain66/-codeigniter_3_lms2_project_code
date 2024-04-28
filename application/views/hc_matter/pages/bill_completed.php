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
       var valid_rule =[];

    jQuery(document).ready(function () {


        /*jQuery("#arrested").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: arrested, width: 250, height: 25});
       
        jQuery('#arrested').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });*/

        //jQuery('#sendtochecker').jqxButton({template:"success", width: 120, height: 40, theme: theme });

        
        jQuery("#addel").click( function() {
            //console.log(valid_rule)
            jQuery('#table').jqxValidator({
                rules:valid_rule
            });
        });
        // Add edit form validation
        /*jQuery('#action_form').jqxValidator({
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
            
            
            { input: '#case_number', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#case_number").val()=='')
                    {
                        jQuery("#case_number").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                    
                }
            },
            { input: '#ac_number', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#ac_number").val()=='')
                    {
                        jQuery("#ac_number").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                    
                }
            },
            { input: '#ac_name', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#ac_name").val()=='')
                    {
                        jQuery("#ac_name").focus();
                        return false;
                    }
                    else
                    {
                        return true;
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
        });*/
       
        // Jqx tab second tab function start    Grid Show
        var initGrid2 = function () {
            var source ={
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'int'},
                    { name: 'cma_id', type: 'int'},
                    { name: 'suit_id', type: 'int'},
                    { name: 'memo_sts', type: 'int'},
                    { name: 'loan_ac', type: 'string'},
                    { name: 'ac_name', type: 'string'},
                    { name: 'case_number', type: 'string'},
                    { name: 'deposit_amt', type: 'string'},
                    { name: 'deposit_dt', type: 'string'},
                    { name: 'depo_dt', type: 'string'},
                    { name: 'arrested', type: 'string'},
                    { name: 'bill_sts', type: 'string'},
                    { name: 'expense_name', type: 'string'},
                    { name: 'activities', type: 'string'},
                    { name: 'district_name', type: 'string'},
                    { name: 'vendor_name', type: 'string'},
                    { name: 'activities_date', type: 'string'},
                    { name: 'amount', type: 'string'},
                    { name: 'remarks', type: 'string'},
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
                url: '<?=base_url()?>index.php/appeal_bail_money/bill_completed_grid',
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
                   
                    { text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);

                        return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                          }
                    },

                    { text: 'Billing Status', datafield: 'bill_sts',editable: false, width: '10%'},
                    { text: 'Expenses Type', datafield: 'expense_name',editable: false, width: '13%'},
                    { text: 'Vendor Name', datafield: 'vendor_name',editable: false, width: '13%'},
                    { text: 'District', datafield: 'district_name',editable: false, width: '13%'},
                    { text: 'Activities', datafield: 'activities',editable: false, width: '13%'},
                    { text: 'Activities Date', datafield: 'activities_date',editable: false, width: '13%'},
                    { text: 'Amount', datafield: 'amount',editable: false, width: '13%'},
                    { text: 'Remarks', datafield: 'remarks',editable: false, width: '13%'},
                    { text: 'Case Number', datafield: 'case_number',editable: false, width: '13%'},
                    { text: 'Deposited Amount', datafield: 'deposit_amt',editable: false, width: '13%'},
                    { text: 'Deposite Date No', datafield: 'deposit_dt',editable: false, width: '13%'},
                    { text: 'Arrested', datafield: 'arrested',editable: false, width: '13%'},
                    
                ],
                        
            });
                
            jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:550, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel,#verifycancel") });
            jQuery('#details').on('close', function (event) {
                jQuery('#delete_convence').jqxValidator('hide');
                
            });
            //End check box start 
            //End check box start 
            /*jQuery("#jqxGrid2").on('cellbeginedit', function (event) {
                var column = event.args.datafield;
                var row = event.args.rowindex;
                var value = event.args.value;
                var rowindexes = jQuery('#jqxGrid2').jqxGrid('getselectedrowindexes');
            });*/
            // select or unselect rows when the checkbox is checked or unchecked.
            /*jQuery("#jqxGrid2").on('cellendedit', function (event) {
                var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', event.args.rowindex);
                if(dataRecord.stc_sts!=6){                 
                    alertMSG('applicationverifydelete');
                    jQuery("#jqxGrid2").jqxGrid('setcellvalue', event.args.rowindex, 'available', false);
                    jQuery("#jqxGrid2").jqxGrid('unselectrow', event.args.rowindex)
                }else{
                    if (event.args.value) {
                        jQuery("#jqxGrid2").jqxGrid('selectrow', event.args.rowindex);
                    }
                    else {
                        jQuery("#jqxGrid2").jqxGrid('unselectrow', event.args.rowindex);
                    }
                }
            });*/
            //End check box update 
            //jQuery("#stf").jqxButton({ theme: theme });
        }
        // jQuery("#jqxNavigationBar").css('visibility', 'visible');
        //jQuery("#jqxNavigationBar").jqxNavigationBar({ width: 300, expandMode: 'multiple', expandedIndexes: [2, 3], theme: 'arctic' });
        
        // jqx tab init
        var initWidgets = function (tab) {
            switch (tab) {
                case 0:
                    initGrid2();
                    break;
                /*case 1:
                    
                    break;*/
            }
        }
        //document.getElementById("jqxTabs").style.minHeight = "280px";
        jQuery('#jqxTabs').jqxTabs({ width: '99%', initTabContent: initWidgets });
        
        jQuery('#jqxTabs').bind('selected', function (event) {

            if(event.args.item==0){
                clear_form();
                //jQuery('#jqxTabs').jqxTabs('disableAt', 1);
            }
            jQuery('#action_form').jqxValidator('hide');
            //clear_form();
        });
        //jQuery('#jqxTabs').jqxTabs('disableAt', 1);

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
                if (isValid) {
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
            
                //jQuery("#sendtochecker").hide();
                jQuery("#verify_button").hide();
                jQuery("#verifycancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
            
         });
       
    });
var count=0; var maxrow = 0; var displayrow= 0; inc = 0; decr = 0;
function clearCount() { count=0; maxrow = 0;displayrow= 0;}
function search_data(){
    jQuery("#jqxGrid2").jqxGrid('updatebounddata');
    return;

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
                    jQuery('#jqxTabs').jqxTabs('select', 1);
                    
                }else{
                    jQuery("#in_req_button").show();
                    jQuery("#in_req_loading").hide();
                }
                alert(json.Message);
                return false;
            }
            var msg='';
            if(edit_row>0){
                msg='Updated';
            }else{
                msg="Saved";
            }
            clear_form();
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
            clear_form();
            
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
                }else if ($('type').value=='withdrawn') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_loading").hide();
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
                }else if ($('type').value=='withdrawn') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_loading").hide();
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
    jQuery('#jqxTabs').jqxTabs('select', 0);
    jQuery("#add_button").hide();
    jQuery("#up_button").show();
    jQuery("#in_up_button").show();
    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
    console.log(dataRecord['cma_id']);
    var cma_id = dataRecord['cma_id'];
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    /*jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>Warrant_arrest/get_guarrentor_info/"+cma_id,
        data : {[csrfName]: csrfHash},
        datatype: "json",
        async:false,
        success: function(response){
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;
            //console.log(rows);
            jQuery("#executed_counter").val(rows.length);
            var html = "";
            rows.forEach(function(row,index) {
                var g_type = '';
                if(row.guarantor_type=='M'){
                    g_type="Owner";
                }else{
                    g_type="Guarantor";
                }
                html +='<tr><td><input type="checkbox" name="check_'+index+'" id="check_'+index+'" value="'+row.id+'"></td><td width="50%">'+row.guarantor_name+' ('+g_type+')<input type="hidden" name="gid_'+index+'" id="gid_'+index+'" value="'+row.id+'"></td><td><input type="text" name="executed_date_'+index+'" placeholder="dd/mm/yyyy" style="width:250px;" id="executed_date_'+index+'" value="" ></td><td><input type="text" name="remarks_'+index+'" placeholder="Remarks" style="width:250px;" id="remarks_'+index+'" ></td></tr>';
                datePicker ("executed_date_"+index);
            });
            jQuery("#executed").html(html);
            
        }
    });*/
    //jQuery('#jqxTabs').jqxTabs('enableAt', 1);
    
    jQuery("#cma_id").val(dataRecord['cma_id']);
    jQuery("#edit_row").val(dataRecord['id']);
    jQuery("#add_edit").val('edit');
    jQuery('#ac_number').val(dataRecord['loan_ac']);
    jQuery('#ac_name').val(dataRecord['ac_name']);
    jQuery('#suit_id').val(dataRecord['suit_id']);
    jQuery('#case_number').val(dataRecord['case_number']);
    jQuery('#deposited_amount').val(dataRecord['deposit_amt']);
    jQuery('#deposite_date').val(dataRecord['depo_dt']);
    jQuery('#arrested').jqxComboBox('clearSelection');
    jQuery('#arrested').jqxComboBox('val',dataRecord['arrested']);
    
}
function clear_form(){
    jQuery("#cma_id").val('');
    jQuery("#edit_row").val('');
    jQuery("#add_edit").val('add');
    jQuery('#ac_number').val('');
    jQuery('#ac_name').val('');
    jQuery('#suit_id').val('');
    jQuery('#case_number').val('');
    jQuery('#deposited_amount').val('');
    jQuery('#deposite_date').val('');
    jQuery('#arrested').jqxComboBox('clearSelection');
    jQuery("#add_button").show();
    jQuery("#up_button").hide();
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
        jQuery("#delete_row").show();
    }else if(operation=='withdrawn'){

        jQuery("#deleteEventId").val('');
        jQuery("#d_suit_id").val(dataRecord.suit_id);
        jQuery("#verifyid").val(id);
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#delete_row").hide();
        jQuery("#verify_row").show();
    }
    else{
        jQuery("#deleteEventId").val('');
        jQuery("#verifyid").val('');
        jQuery("#delete_row").hide();
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
        url: "<?=base_url()?>appeal_bail_money/get_billing_details/"+id,
        data : {[csrfName]: csrfHash},
        datatype: "json",
        async:false,
        success: function(response){
            var ds=response.split('####');
            jQuery('.txt_csrfname').val(ds[1]);
            /*var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;*/
           // console.log(ds[0]);
            jQuery('#previewtable').html(ds[0]);
        }
    });


    document.getElementById("details").style.display='block';
    jQuery("#details").jqxWindow('open');
}


function load_case(){
    var case_number = jQuery('#case_number').val();
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
                jQuery('#ac_number').val(rows.loan_ac);
                jQuery('#ac_name').val(rows.ac_name);
                jQuery('#cma_id').val(rows.cma_id);
                jQuery('#suit_id').val(rows.id);
            }
        }
    });
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
                    <div id="dddd">
                    <div id='jqxTabs'>
                        <ul>
                            <li style="margin-left: 30px;">Data Grid</li>
                            <!-- <li>Form</li> -->
                        </ul>
                        <!---==== First Tab Start ==========----->
                        <div style="overflow: hidden;">
                           
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
                            </form> -->
                            <br>
                            <div style="border:none;" id="jqxGrid2"></div>
                            <div style="float:left;padding-top: 5px;margin-left: 5px;margin-bottom: 20px;">
                            <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                            

                                 &nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>W = </strong> Withdrawn,&nbsp;
                                <strong>P = </strong> Preview&nbsp;
                               
                            </div>
                            </div>
                        </div>
                        <!---==== Second Tab Start ==========----->
                        <!-- <div style="overflow: hidden;_overflow-y: scroll;">
                            <div style="padding: 10px;">
                            <form class="form" name="action_form" id="action_form" method="post" action="" enctype="multipart/form-data">
                                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <input type="hidden" id="add_edit" value="add" name="add_edit">
                                <input type="hidden" id="edit_row" value="" name="edit_row">
                                <input type="hidden" id="cma_id" value="" name="cma_id">
                                <input type="hidden" id="suit_id" value="" name="suit_id">
                                <table style="width: 60%;">
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Case Number<span style="color:red">*</span> </td>
                                        <td width="25%" ><input name="case_number" type="text" class="" style="width:250px" id="case_number" value="" placeholder="Case Number" /><button type="button" onclick="load_case()">Load</button></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Account Number<span style="color:red">*</span> </td>
                                        <td width="30%" ><input name="ac_number" type="text" class="" style="width:250px" id="ac_number" placeholder="Account Number" /></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Account Name<span style="color:red">*</span> </td>
                                        <td width="30%" ><input name="ac_name" type="text" class="" style="width:250px" id="ac_name" placeholder="Account Name" /></td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Deposited Amount<span style="color:red">*</span> </td>
                                        <td width="30%" ><input name="deposited_amount" type="text" class="" style="width:250px" id="deposited_amount" value="" placeholder="Deposited Amount" /></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Date<span style="color:red">*</span> </td>
                                        <td width="30%" ><input name="deposite_date" type="text" class="" style="width:250px" id="deposite_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker ("deposite_date");</script></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Arrested?<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="arrested" name="arrested" style="padding-left: 3px"></div></td>
                                    </tr>
                                    
                                   
                                    <? if(ADD==1){?>
                                    <tr id="add_button" >
                                        <td colspan="4" style="text-align: center;">
                                            <br/>
                                            <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_req_button"/> 
                                            <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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
                            
                        </div> -->
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
        <div id="verify_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
            <br><br>
            <input type="button" class="buttonSend" id="verify_button" value="Send">
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