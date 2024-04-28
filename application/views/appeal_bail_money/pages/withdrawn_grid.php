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
       var valid_rule =[];
       var proposed_type =['Loan','Card'];

       var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
       var vendor = [<? $i=1; foreach($vendor as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var expense_activities = [];
        var expense_type = [<? $i=1; foreach($request_from as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var staff = [];


    jQuery(document).ready(function () {

        jQuery("#s_proposed_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, width: 150, height: 25});

         //jQuery("#arrested").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: arrested, width: 250, height: 25});
        jQuery("#expense_type_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: expense_type, width: 180, height: 25});
        jQuery("#district_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 215, height: 25});

        jQuery('#expense_type_1,district_1,#s_proposed_type').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });

        jQuery("#s_proposed_type").jqxComboBox('val','Loan');
        change_caption();
        jQuery('#s_proposed_type').bind('change', function (event) {
            jQuery("#s_account").val('');
            jQuery("#hidden_loan_ac").val('');
            change_caption();       
        });

        
        jQuery("#addel").click( function() {
            //console.log(valid_rule)
            jQuery('#table').jqxValidator({
                rules:valid_rule
            });
        });
        // Add edit form validation
        jQuery('#action_form').jqxValidator({
            rules: [
            { input: '#withdraw_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                    }
                    else {
                        return false;
                    }
                } 
                },
            { input: '#withdraw_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                },]
        });
       
        // Jqx tab second tab function start    Grid Show
        var initGrid2 = function () {
            var source ={
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'int'},
                    { name: 'cma_id', type: 'int'},
                    { name: 'req_type', type: 'int'},
                    { name: 'suit_id', type: 'int'},
                    { name: 'life_cycle', type: 'int'},
                    { name: 'loan_ac', type: 'string'},
                    { name: 'ac_name', type: 'string'},
                    { name: 'withdraw_dt', type: 'string'},
                    { name: 'case_number', type: 'string'},
                    { name: 'deposit_amt', type: 'string'},
                    { name: 'deposit_percent', type: 'string'},
                    { name: 'deposit_dt', type: 'string'},
                    { name: 'depo_dt', type: 'string'},
                    { name: 'arrested', type: 'string'},
                    { name: 'status_name', type: 'string'},
                    { name: 'verify_s', type: 'string'},
                    { name: 'total_row', type: 'string'},
                    { name: 'summary_id', type: 'string'},
                    { name: 'appeal_id', type: 'string'},
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
                url: '<?=base_url()?>index.php/appeal_bail_money/withdrawn_pending_grid',
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
                    //var territory = jQuery.trim(jQuery('input[name=territory]').val());
                    
                    var s_case_number = jQuery.trim(jQuery('#s_case_number').val());
                    var s_name = jQuery.trim(jQuery('#s_name').val());
                    var s_account = jQuery.trim(jQuery('#s_account').val());
                    jQuery.extend(data, {
                            case_number : s_case_number,
                            ac_name : s_name,
                            account : s_account,
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
            var win_h=jQuery( window ).height()-350;
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
                    { text: 'suit_id', datafield: 'suit_id',hidden:true },
                    { text: 'depo_dt', datafield: 'depo_dt',hidden:true },
                    { text: 'v_sts', datafield: 'v_sts',hidden:true },
                    { text: 'sts', datafield: 'sts',hidden:true },
                    { text: 'summary_id', datafield: 'summary_id',hidden:true },
                    { text: 'req_type', datafield: 'req_type',hidden:true },
                   
                    <? if(WITHDRAWN==1){?>
                        { text: 'W', menu: false, datafield: 'Auth', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                            if(dataRecord.v_sts == 38 && dataRecord.life_cycle==2){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="loaddeposit('+dataRecord.suit_id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                            }else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                    <?php } ?>
                     
                   
                    { text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        //console.log(dataRecord);
                        return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="withdraw_details('+dataRecord.suit_id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                          }
                    },
                    { text: 'Account Name', datafield: 'ac_name',editable: false, width: '13%'},
                    { text: 'Account', datafield: 'loan_ac',editable: false, width: '13%'},
                    { text: 'Case Number', datafield: 'case_number',editable: false, width: '13%'},
                    { text: 'Deposited Amount', datafield: 'deposit_amt',editable: false, width: '13%'},
                    { text: 'Deposited Percent', datafield: 'deposit_percent',editable: false, width: '13%'},
                    { text: 'Deposite Date No', datafield: 'deposit_dt',editable: false, width: '13%'},
                    { text: 'Arrested', datafield: 'arrested',editable: false, width: '7%'},
                    { text: 'Widthdraw Date', datafield: 'withdraw_dt',editable: false, width: '13%'},
                    { text: 'Status', datafield: 'status_name',editable: false, width: '25%'},
                    
                ],
                        
            });
                
            jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:550, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#SendTocheckercancel,#verifycancel,#sendtocheckercancel,#verify_cancel") });
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

        // Jqx tab second tab function start    Grid Show
        var initGrid3 = function () {
            var source ={
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'int'},
                    { name: 'cma_id', type: 'int'},
                    { name: 'req_type', type: 'int'},
                    { name: 'suit_id', type: 'int'},
                    { name: 'life_cycle', type: 'int'},
                    { name: 'loan_ac', type: 'string'},
                    { name: 'ac_name', type: 'string'},
                    { name: 'withdraw_date', type: 'string'},
                    { name: 'case_number', type: 'string'},
                    //{ name: 'deposit_amt', type: 'string'},
                    //{ name: 'deposit_percent', type: 'string'},
                    //{ name: 'deposit_dt', type: 'string'},
                    //{ name: 'depo_dt', type: 'string'},
                    //{ name: 'arrested', type: 'string'},
                    { name: 'status_name', type: 'string'},
                    { name: 'verify_s', type: 'string'},
                    { name: 'total_row', type: 'string'},
                    { name: 'summary_id', type: 'string'},
                    { name: 'appeal_id', type: 'string'},
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
                url: '<?=base_url()?>index.php/appeal_bail_money/withdrawn_grid',
                cache: false,
                filter: function()
                {
                    // update the grid and send a request to the server.
                    jQuery("#jqxGrid3").jqxGrid('updatebounddata', 'filter');
                },
                sort: function()
                {
                    // update the grid and send a request to the server.
                    jQuery("#jqxGrid3").jqxGrid('updatebounddata', 'sort');
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
                    //var territory = jQuery.trim(jQuery('input[name=territory]').val());
                    
                    var s_case_number = jQuery.trim(jQuery('#s_case_number').val());
                    var s_name = jQuery.trim(jQuery('#s_name').val());
                    var s_account = jQuery.trim(jQuery('#s_account').val());
                    jQuery.extend(data, {
                            case_number : s_case_number,
                            ac_name : s_name,
                            account : s_account,
                    });
                    return data;
                }
            });
            var columnCheckBox = null;
            var updatingCheckState = false;
            // initialize jqxGrid. Disable the built-in selection.
            var celledit = function (row, datafield, columntype) {
                var checked = jQuery('#jqxGrid3').jqxGrid('getcellvalue', row, "available");
                if (checked == false) {
                  return false;
                };
            };
            var win_h=jQuery( window ).height()-350;
            jQuery("#jqxGrid3").jqxGrid({
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
                    { text: 'suit_id', datafield: 'suit_id',hidden:true },
                    { text: 'depo_dt', datafield: 'depo_dt',hidden:true },
                    { text: 'v_sts', datafield: 'v_sts',hidden:true },
                    { text: 'sts', datafield: 'sts',hidden:true },
                    { text: 'summary_id', datafield: 'summary_id',hidden:true },
                    { text: 'req_type', datafield: 'req_type',hidden:true },
                   
                    
                     <? if(EDIT==1){?>
                        { text: 'E', menu: false, datafield: 'edit', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid3").jqxGrid('getrowdata', editrow);
                            //console.log(dataRecord);
                            if(dataRecord.v_sts == 35|| dataRecord.v_sts == 39 || dataRecord.v_sts == 90){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                            }else {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                            }

                            }
                          },
                    <?php } ?>
                    <?php if(SENDTOCHECKER==1){ ?>
                    { text: 'STC', menu: false, datafield: 'sendtochecker', align:'center', editable: false, sortable: false, width: '4%', cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid3").jqxGrid('getrowdata', editrow);
                        if(dataRecord.v_sts == 35 || dataRecord.v_sts == 39 || dataRecord.v_sts == 90){
                            
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'sendtochecker\')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                        }else if(dataRecord.v_sts == 37){
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">S</div>';
                        }else{
                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                        }
                        }
                    },
                    <?php } ?>
                    <? if(VERIFY==1){?>
                        { text: 'V', menu: false, datafield: 'Verify', align:'center', editable: false, sortable: false, width: '2%',
                        cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxGrid3").jqxGrid('getrowdata', editrow);

                            if(dataRecord.v_sts == 37){
                                return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'withdrawn\')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
                            }
                            else if(dataRecord.v_sts == 77){
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
                        var dataRecord = jQuery("#jqxGrid3").jqxGrid('getrowdata', editrow);

                        return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+','+editrow+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                          }
                    },
                    { text: 'Account Name', datafield: 'ac_name',editable: false, width: '13%'},
                    { text: 'Account', datafield: 'loan_ac',editable: false, width: '13%'},
                    { text: 'Case Number', datafield: 'case_number',editable: false, width: '13%'},
                    //{ text: 'Deposited Amount', datafield: 'deposit_amt',editable: false, width: '13%'},
                    //{ text: 'Deposited Percent', datafield: 'deposit_percent',editable: false, width: '13%'},
                    //{ text: 'Deposite Date No', datafield: 'deposit_dt',editable: false, width: '13%'},
                    //{ text: 'Arrested', datafield: 'arrested',editable: false, width: '7%'},
                    { text: 'Widthdraw Date', datafield: 'withdraw_date',editable: false, width: '13%'},
                    { text: 'Status', datafield: 'status_name',editable: false, width: '25%'},
                    
                ],
                        
            });
                
            jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:550, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#SendTocheckercancel,#verifycancel,#sendtocheckercancel,#verify_cancel") });
            jQuery('#details').on('close', function (event) {
                jQuery('#delete_convence').jqxValidator('hide');
                
            });
            
        }
        // jQuery("#jqxNavigationBar").css('visibility', 'visible');
        //jQuery("#jqxNavigationBar").jqxNavigationBar({ width: 300, expandMode: 'multiple', expandedIndexes: [2, 3], theme: 'arctic' });
        
        // jqx tab init
        var initWidgets = function (tab) {
            switch (tab) {
                case 0:
                    initGrid2();
                    jQuery('#jqxTabs').jqxTabs('disableAt', 2);
                    break;
                case 1:
                    initGrid3();
                    break;
                case 2:
                    
                    break;
            }
        }
        //document.getElementById("jqxTabs").style.minHeight = "280px";
        jQuery('#jqxTabs').jqxTabs({ width: '99%', initTabContent: initWidgets });
        
        jQuery('#jqxTabs').bind('selected', function (event) {

            if(event.args.item==0){
                jQuery('#jqxTabs').jqxTabs('disableAt', 2);
                clear_form();
                jQuery("#jqxGrid2").jqxGrid('updatebounddata');
            }
            if(event.args.item==1){
                jQuery('#jqxTabs').jqxTabs('disableAt', 2);
                clear_form();
                jQuery("#jqxGrid3").jqxGrid('updatebounddata');
            }
            
            jQuery('#action_form').jqxValidator('hide');
            //clear_form();
        });
        jQuery('#jqxTabs').jqxTabs('disableAt', 2);

        // Add Form Submit
        jQuery("#in_req_button").click( function() {
            var checkboxes = document.getElementsByClassName('child');
            var required =false;var amt= true;
            jQuery.each( checkboxes, function( i, val ) {
                if(val.checked==true){
                    required = true;
                }
            });
            if(required==false){
                alert('Please Select a Deposit Amount!');
                return false;
            }
            var validationResult = function (isValid) {
            if (isValid &&  expense_validation()==true) {
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
            var checkboxes = document.getElementsByClassName('child');
            var required =false;var amt= true;
            jQuery.each( checkboxes, function( i, val ) {
                if(val.checked==true){
                    required = true;
                }
            });
            if(required==false){
                alert('Please Select a Deposit Amount!');
                return false;
            }
            var validationResult = function (isValid) {
            if (isValid &&  expense_validation()==true) {
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

        /*jQuery("#verify_button").click(function () {
            
                //jQuery("#sendtochecker").hide();
                jQuery("#verify_button").hide();
                jQuery("#verifycancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
            
        });*/
        jQuery("#sendtochecker_button").click(function () {
            
                jQuery("#sendtochecker_button").hide();
                jQuery("#sendtocheckercancel").hide();
                jQuery("#sendtochecker_loading").show();
                delete_submit();
            
         });
        jQuery("#verify_button").click( function() {
            jQuery('#type').val('withdrawn');
            jQuery("#verify_return_row").hide();
            jQuery("#verify_return").hide();
            jQuery("#verify_reject").hide();
            jQuery("#verify_button").hide();
            jQuery("#verify_cancel").hide();
            jQuery("#verify_loading").show();
            delete_submit();
            //return false; 
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
                jQuery("#verify_cancel").hide();
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
                jQuery("#verify_cancel").hide();
                jQuery("#verify_loading").show();
                delete_submit();
            }
        });
       
    });
var count=0; var maxrow = 0; var displayrow= 0; inc = 0; decr = 0;
function clearCount() { count=0; maxrow = 0;displayrow= 0;}
function search_data(){
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
        url: "<?=base_url()?>appeal_bail_money/add_edit_withdraw_action/"+add_edit+"/"+edit_row,
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
                jQuery("#jqxGrid3").jqxGrid('updatebounddata');
            }else{
                jQuery("#in_req_button").show();
                jQuery("#in_req_loading").hide();
                jQuery('#jqxTabs').jqxTabs('select', 0);
                jQuery("#jqxGrid2").jqxGrid('updatebounddata');
            }
            
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
        url: '<?=base_url()?>index.php/appeal_bail_money/withdraw_delete_action/',
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
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    alert(json.Message);
                }else if ($('type').value=='verify_reject') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    
                }else if ($('type').value=='verify_return') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
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
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    
                }else if ($('type').value=='verify_reject') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                    
                }else if ($('type').value=='verify_return') 
                {
                    jQuery("#verify_button").show();
                    jQuery("#verify_return_row").hide();
                    jQuery("#verify_return").show();
                    jQuery("#verify_reject").show();
                    jQuery("#verify_cancel").show();
                    jQuery("#verify_loading").hide();
                    jQuery("#return_reason_verify").val('');
                    jQuery('#details').jqxWindow('close');
                }
                else
                {
                    jQuery("#sendtochecker_button").show();
                    jQuery("#sendtocheckercancel").show();
                    jQuery("#sendtochecker_loading").hide();
                }
                var msz='';
                jQuery("#error").show();
                jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                jQuery('#details').jqxWindow('close');
                jQuery("#jqxGrid3").jqxGrid('updatebounddata');
                        
            }
        }
    });
}

function edit(id,editrow){

    clear_form();
    jQuery('#jqxTabs').jqxTabs('enableAt', 2);
    jQuery('#jqxTabs').jqxTabs('select', 2);
    jQuery("#add_button").hide();
    jQuery("#up_button").show();
    jQuery("#in_up_button").show();
    jQuery('#search_area').hide();
    jQuery('#add_form').show();
    jQuery('#add_edit').val('edit');
    var dataRecord = jQuery("#jqxGrid3").jqxGrid('getrowdata', editrow);
    //console.log(dataRecord);
    var suit_id = dataRecord.suit_id;
    //var id = dataRecord['id'];
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>appeal_bail_money/get_deposit_file_edit_info",
        data : {[csrfName]: csrfHash,suit_id:suit_id,id:id},
        datatype: "json",
        async:false,
        success: function(response){
            var res = response.split('####');
            var json = jQuery.parseJSON(res[0]);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;
            //console.log(rows);
            jQuery('#load_depo').html(res[1]);
            jQuery("#executed_counter").val(rows.length);
            jQuery('#req_type').val(rows.req_type);
            //jQuery('#cma_district').val(rows.district);
            jQuery('#withdraw_date').val(rows.withdraw_date);
            
            rows.bill.forEach(function(row,index) {
                //console.log(row);
                var theme = getDemoTheme();
                if(index>0){
                var counter = jQuery('#expense_counter').val();
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
                    html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" ></td>';
                    html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
                     html_string += '<td><span id="appeal_bail_bill_copy_'+new_counter+'"></span></td>';
                    html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
                    html_string += '</tr>';

                jQuery('#expense_' + counter).after(html_string);
                jQuery('#expense_counter').val(new_counter);
                
                jQuery('#expense_type_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Vendor Type", source: expense_type, height: 25});
                jQuery('#expense_type_'+new_counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 220, autoOpen: false, autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, height: 25});
                jQuery('#activities_name_'+new_counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                jQuery('#district_'+new_counter).jqxComboBox({theme: theme, width: 215, autoOpen: false, autoDropDownHeight: false, promptText: "Select District", source: district, height: 25});
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
                jQuery("#district_"+num).jqxComboBox('val',row.district);
                jQuery("#vendor_id_"+num).jqxComboBox('val',row.vendor_id);
                jQuery("#activities_name_"+num).jqxComboBox('val',row.activities_name);
                jQuery('#activities_date_'+num).val(row.activities_date);
                jQuery('#amount_'+num).val(row.amount);
                jQuery('#remarks_'+num).val(row.remarks);
                jQuery('#expense_edit_'+num).val(row.id);
                //console.log(row.appeal_bail_bill_copy);
                var appeal_bail_bill_copy = row.appeal_bail_bill_copy;
                var html = '';
                html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'appeal_bail_bill_copy_'+num+'\')"/>';
                html+='<input type="hidden" id="hidden_appeal_bail_bill_copy_'+num+'_select" name="hidden_appeal_bail_bill_copy_'+num+'_select" value="0">';
                if(appeal_bail_bill_copy!='' && appeal_bail_bill_copy!=null)
                {
                    html +='<span id="hidden_appeal_bail_bill_copy_'+num+'"><img id="file_preview_appeal_bail_bill_copy_'+num+'" onclick="popup(\'<?=base_url()?>cma_file/appeal_bail_bill_copy/'+appeal_bail_bill_copy+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                    html +='<input type="hidden" id="hidden_appeal_bail_bill_copy_'+num+'_value" name="hidden_appeal_bail_bill_copy_'+num+'_value" value="'+appeal_bail_bill_copy+'">';
                    html +='<img id="file_delete_appeal_bail_bill_copy_'+num+'" onclick="file_delete(\'appeal_bail_bill_copy_'+num+'\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                    html +='<input type="hidden" id="file_delete_value_appeal_bail_bill_copy_'+num+'" name="file_delete_value_appeal_bail_bill_copy_'+num+'" value="0">';
                }
                else
                {
                    html+='<span id="hidden_appeal_bail_bill_copy_'+num+'">';
                }
                html+='<span id="hidden_appeal_bail_bill_copy_'+num+'">';
                jQuery('#appeal_bail_bill_copy_'+num).html(html);
                
            });
            
            jQuery('#editrow').val(rows.id);
            jQuery('#suit_id').val(rows.suit_id);

            jQuery('#edit_row').val(rows.id);
            jQuery('#add_edit').val('edit');

        }
    });
    //jQuery('#jqxTabs').jqxTabs('enableAt', 1);
    
    
}
function clear_form(){
    //jQuery("#cma_id").val('');
    jQuery("#edit_row").val('');
    jQuery("#add_edit").val('add');
    jQuery('#ac_number').val('');
    jQuery('#withdraw_date').val('');
    jQuery('#ac_name').val('');
    jQuery('#suit_id').val('');
    jQuery('#case_number').val('');
    jQuery('#remarks_1').val('');
    jQuery('#activities_date_1').val('');
    jQuery('#district_1').jqxComboBox('clearSelection');
    jQuery('input[name="district_1"]').val('');
    jQuery('#expense_type_1').jqxComboBox('clearSelection');
    jQuery('input[name="expense_type_1"]').val('');
    jQuery('#vendor_id_1').jqxComboBox('clearSelection');
    jQuery('input[name="vendor_id_1"]').val('');
    jQuery('#vendor_name_1').jqxComboBox('clearSelection');
    jQuery('input[name="vendor_name_1"]').val('');
    jQuery('#activities_name_1').jqxComboBox('clearSelection');
    jQuery('input[name="activities_name_1"]').val('');
    
    jQuery("#add_button").show();
    jQuery("#up_button").hide();
    jQuery('#expense_counter').val(1);
    jQuery('#expense_body').children().slice(1).remove();
}
function loaddeposit(id,editrow){
    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);

    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>appeal_bail_money/get_deposit_file_info",
        data : {[csrfName]: csrfHash,id:id},
        datatype: "json",
        async:false,
        success: function(response){
           var ds=response.split('####');
           // var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(ds[1]);
            //console.log(json);
            var rows = ds[0];
            if(rows!=null){
            //jQuery('#edit_row').val(rows.id);
                jQuery('#add_edit').val('add');
                jQuery('#req_type').val(dataRecord.req_type);
                jQuery('#jqxTabs').jqxTabs('enableAt', 2);
                jQuery('#jqxTabs').jqxTabs('select', 2);
                jQuery('#load_depo').html(rows);
                //console.log(rows);
            
                //jQuery('#editrow').val(rows.id);
                jQuery('#suit_id').val(id);
                jQuery("#expense_type_1").jqxComboBox('val',1);
                //jQuery("#vendor_id_1").jqxComboBox('val',rows.prest_lawyer_name);
                var html = '';
                html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'appeal_bail_bill_copy_1\')"/>';
                html+='<input type="hidden" id="hidden_appeal_bail_bill_copy_1_select" name="hidden_appeal_bail_bill_copy_1_select" value="0">';
                html+='<span id="hidden_appeal_bail_bill_copy_1">';
                jQuery('#appeal_bail_bill_copy_1').html(html);

                
            }else{
                alert("No Data Found");
            }

        }
    });

}
function withdraw_details (id,editrow,operation) {

    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
    //console.log(dataRecord);
    if(operation=='delete'){
        jQuery("#deleteEventId").val(id);
        jQuery("#d_suit_id").val(dataRecord.suit_id);
        jQuery("#verifyid").val('');
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#verify_row").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtochecker_row").hide();
        jQuery("#delete_row").show();
    }else if(operation=='sendtochecker'){
        
        jQuery("#deleteEventId").val(id);
        jQuery("#d_suit_id").val(dataRecord.suit_id);
        jQuery("#verifyid").val('');
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#verify_row").hide();
        jQuery("#delete_row").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtochecker_row").show();
    }else if(operation=='withdrawn'){

        jQuery("#deleteEventId").val('');
        jQuery("#d_suit_id").val(dataRecord.suit_id);
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
        url: "<?=base_url()?>appeal_bail_money/get_details_withdraw_pending/",
        data : {[csrfName]: csrfHash,id:id},
        datatype: "json",
        async:false,
        success: function(response){
            var json = jQuery.parseJSON(response);

            jQuery('.txt_csrfname').val(json['csrf_token']);
            jQuery('#previewtable').html(json['str']);
        }
    });
    

    document.getElementById("details").style.display='block';
    jQuery("#details").jqxWindow('open');
}
function details (id,editrow,operation) {

    var dataRecord = jQuery("#jqxGrid3").jqxGrid('getrowdata', editrow);
    //console.log(dataRecord);
    if(operation=='delete'){
        jQuery("#deleteEventId").val(id);
        jQuery("#d_suit_id").val(dataRecord.suit_id);
        jQuery("#verifyid").val('');
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#verify_row").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtochecker_row").hide();
        jQuery("#delete_row").show();
    }else if(operation=='sendtochecker'){
        
        jQuery("#deleteEventId").val(id);
        jQuery("#d_suit_id").val(dataRecord.suit_id);
        jQuery("#verifyid").val('');
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#verify_row").hide();
        jQuery("#delete_row").hide();
        jQuery("#verify_row").hide();
        jQuery("#sendtochecker_row").show();
    }else if(operation=='withdrawn'){

        jQuery("#deleteEventId").val('');
        jQuery("#d_suit_id").val(dataRecord.suit_id);
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
        url: "<?=base_url()?>appeal_bail_money/get_details_withdraw",
        data : {[csrfName]: csrfHash,id:id},
        datatype: "json",
        async:false,
        success: function(response){
            //var ds=response.split('####');
            //jQuery('.txt_csrfname').val(ds[1]);
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.str;
           // console.log(ds[0]);
           jQuery('#previewtable').html(json.str);
            //jQuery('#previewtable').html(ds[0]);
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
// Only One Checkbox Select At a time
function onlyOne(checkbox) {
    jQuery("#parent").change(function() {
        jQuery(".child").prop("checked", this.checked);
    });

    jQuery('.child').change(function() {
        if (jQuery('.child:checked').length == jQuery('.child').length) {
          jQuery('#parent').prop('checked', true);
        } else {
          jQuery('#parent').prop('checked', false);
        }
    });

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
                        if(req_type==1 && obj.apv_sts==1){
                            expense_activities.push({ value: obj.id, label: obj.name });
                        }
                        if(req_type==2 && obj.apv_sts==1){
                            expense_activities.push({ value: obj.id, label: obj.name });
                        }
                        if(type==5){
                            expense_activities.push({ value: obj.id, label: obj.name });
                        }
                        
                    });
                }
                jQuery("#activities_name_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, width: 180, height: 25});
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
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 215, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                jQuery('#appeal_bail_bill_copy_'+counter+'').show();
                get_expense_activities(item.value,counter,req_type);
                select_lawyer(counter);
            }else if(item.value==4)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 180, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                get_expense_activities(item.value,counter,req_type);
                select_lawyer(counter);
            }else if(item.value==2)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Vendor", source: vendor, width: 215, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                get_expense_activities(item.value,counter,req_type);
                un_select_lawyer(counter);
            }else if(item.value==3)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#district_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 215, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                get_expense_activities(item.value,counter,req_type);
                un_select_lawyer(counter);
            }
            else if(item.value==5)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#district_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 215, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                jQuery('#appeal_bail_bill_copy_'+counter+'').hide();
                get_expense_activities(item.value,counter,req_type);
                un_select_lawyer(counter);
            }
            else{
                jQuery("#vendor_id_"+counter).hide();
                jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
                jQuery("#vendor_id_"+counter).val('');
                document.getElementById('vendor_name_'+counter).style.display = 'block';
                get_expense_activities(item.value,counter,req_type);
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
                        jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 215, height: 25});
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
            html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" ></td>';
            html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
            html_string += '<td><span id="appeal_bail_bill_copy_'+new_counter+'"></span></td>';
            html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
            html_string += '</tr>';

        jQuery('#expense_' + counter).after(html_string);
        jQuery('#expense_counter').val(new_counter);
        
        jQuery('#expense_type_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Vendor Type", source: expense_type, height: 25});
        jQuery('#expense_type_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, height: 25});
        jQuery('#activities_name_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#district_'+new_counter).jqxComboBox({theme: theme, width: 215, autoOpen: false, autoDropDownHeight: false, promptText: "Select District", source: district, height: 25});
        jQuery('#district_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        datePicker('activities_date_'+new_counter);
        var stringhtml = '';
        stringhtml+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'appeal_bail_bill_copy_'+new_counter+'\')"/>';
        stringhtml+='<input type="hidden" id="hidden_appeal_bail_bill_copy_'+new_counter+'_select" name="hidden_appeal_bail_bill_copy_'+new_counter+'_select" value="0">';
        stringhtml+='<span id="hidden_appeal_bail_bill_copy_'+new_counter+'">';
        jQuery('#appeal_bail_bill_copy_'+new_counter+'').html(stringhtml);
        
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
        var cma_district = jQuery('#cma_district').val();
        var req_type = jQuery('#req_type').val();
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
                url: '<?=base_url()?>index.php/Home/get_expense_amount',
                async:false,
                type: "post",
                data: { [csrfName]: csrfHash,cma_district : cma_district,act_id:act_id,req_type:req_type},
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
                            <li style="margin-left: 30px;">Pending Grid</li>
                            <li >Withdraw Grid</li>
                            <li>Form</li>
                        </ul>
                        <!---==== First Tab Start ==========----->
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
                                            <td ><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data(),clearCount()" style="width:58px" />
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
                        
                                 &nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>W = </strong> Withdrawn,&nbsp;
                                <strong>P = </strong> Preview,&nbsp;
                                <strong>STC = </strong> Send to Checker,&nbsp;
                                <strong>V = </strong> Verify&nbsp;
                               
                            </div>
                            </div>
                        </div>
                        <!---==== Second Tab Start ==========----->
                        <div style="overflow: hidden;">
                           
                            <!-- <form method="POST" name="form" id="form"  style="margin:0px;">
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
                                            <td ><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data(),clearCount()" style="width:58px" />
                                            </td>
                                        </tr>
                                    </table>
                              </div>
                              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                            </form> -->
                            <br>
                            <div style="border:none;" id="jqxGrid3"></div>
                            <div style="float:left;padding-top: 5px;margin-left: 5px;margin-bottom: 20px;">
                            <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                        
                                 &nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>W = </strong> Withdrawn,&nbsp;
                                <strong>P = </strong> Preview,&nbsp;
                                <strong>STC = </strong> Send to Checker,&nbsp;
                                <strong>V = </strong> Verify&nbsp;
                               
                            </div>
                            </div>
                        </div>
                        <!---==== Thard Tab Start ==========----->
                        <div style="overflow: hidden;_overflow-y: scroll;">
                            <div style="padding: 10px;">
                            <form class="form" name="action_form" id="action_form" method="post" action="<?=base_url()?>appeal_bail_money/add_edit_withdraw_action" enctype="multipart/form-data">
                                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <input type="hidden" id="add_edit" value="add" name="add_edit">
                                <input type="hidden" id="edit_row" value="" name="edit_row">
                                
                                <input type="hidden" id="suit_id" value="" name="suit_id">
                                <div id="load_depo">
                                    
                                </div>

                                <table style="width: 100%;">
                                    
                                    <tr>
                                        <td style="width: 20%;">Withdraw Date:</td>
                                        <td style="width: 20%;"><input type="text" name="withdraw_date" tabindex="11" placeholder="dd/mm/yyyy" style="width:150px;" id="withdraw_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("withdraw_date");</script></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="4" width="100%">
                                            <table style="width: 100%;" border="1" id="table">
                                                
                                                <thead>
                                                <tr style="background-color: #d9f0ff;">
                                                    <td colspan="8"><b>Billing Info</b></td>
                                                </tr>
                                                <input type="hidden" name="expense_counter" id="expense_counter" value="1">
                                                <input type="hidden" name="req_type" id="req_type" value="">
                                                <input type="hidden" name="cma_district" id="cma_district" value="">
                                                <tr>
                                                    <td width="4%" style="font-weight: bold;text-align:center">D</td>
                                                    <td width="15%" style="font-weight: bold;text-align:center">Expense Type<span style="color:red">*</span></td>
                                                    <td width="15%" style="font-weight: bold;text-align:center">Vendor Name<span style="color:red">*</span></td>
                                                    <td width="15%" style="font-weight: bold;text-align:center">Activities Name<span style="color:red">*</span></td>
                                                    <td width="10%" style="font-weight: bold;text-align:center">Activities Date<span style="color:red">*</span></td>
                                                    <td width="10%" style="font-weight: bold;text-align:center">Total Amount<span style="color:red">*</span></td>
                                                    <td width="5%" style="font-weight: bold;text-align:center">File Upload</td>
                                                    <td width="22%" style="font-weight: bold;text-align:center">Remarks</td>
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
                                                            <td>
                                                                <div id="district_1" name="district_1" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data(1)"></div>
                                                                <div id="vendor_id_1" name="vendor_id_1" style="padding-left: 3px;margin-left:5px;display:none;width:90%"></div>
                                                                <input name="vendor_name_1" type="text" class="" style="width:98%" id="vendor_name_1" />
                                                            </td>
                                                            <td><div id="activities_name_1" name="activities_name_1" style="padding-left: 3px;margin-left:5px;width:90%" onchange="get_expense_amount('activities_name_1',1)"></div></td>
                                                            <td><input type="text" name="activities_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_1" value="" ><script type="text/javascript" charset="utf-8">datePicker ("activities_date_1");</script></td>
                                                            <td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>
                                                            <td><span id="appeal_bail_bill_copy_1"></span></td>
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
        <!-- <div id="verify_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
            <br><br>
            <input type="button" class="buttonSend" id="verify_button" value="Verify">
            <input type="button" class="buttonclose" id="verifycancel" onclick="close()" value="Cancel">
            <span id="verify_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
            
        </div> -->

         <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
            <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                <table style="margin-left: 370px;margin-top: 0px;">
                    <tr id="verify_return_row" style="display:none">
                        <td>Reason<span style="color: red;">*</span></td>
                        <td>
                            <textarea name="return_reason_verify" id="return_reason_verify" style="width:225px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="button" class="buttonSend" id="verify_button" value="Approve">
                            <input type="button" class="buttondelete" id="verify_return" value="Return"/>
                            <!-- <input type="button" class="buttondelete" id="verify_reject" value="Reject"/> -->
                            <input type="button" class="buttonclose" id="verify_cancel" onclick="close()" value="Cancel">
                            <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                        </td>
                    </tr>
                </table>
            </div>
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
    rules= [{ input: '#withdraw_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                    }
                    else {
                        return false;
                    }
                } 
                },
            { input: '#withdraw_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                    /*jQuery('#add_form').hide();
                    jQuery('#search_area').show();
                    jQuery('#s_account').val('');
                    jQuery('#s_case_number').val('');
                    jQuery('#searchTable').html('');
                    jQuery("#msgArea").val('');
                    jQuery("#error").show();*/
                    jQuery("#error").fadeOut(11500);
                    jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
                    //reload();
                    
                }
                            
            }  
        }; 
        jQuery("#action_form").ajaxForm(options);
        jQuery("#sendButton").click( function() {
            var checkboxes = document.getElementsByClassName('child');
            var required =false;var amt= true;
            jQuery.each( checkboxes, function( i, val ) {
                if(val.checked==true){
                    required = true;
                }
            });
            if(required==false){
                alert('Please Select a Deposit Amount!');
                return false;
            }

            jQuery('#action_form').jqxValidator({
                    rules: rules, theme: theme
            });
           
                /*if (jQuery("#hidden_appeal_bail_scan_copy_select").val()==0) {
                    alert('Please Upload Appeal Bail Scan Copy File');
                    return false;
                }*/
                var validationResult = function (isValid) {
                    if (isValid && expense_validation()==true) {
                        jQuery("#sendButton").hide();
                        jQuery("#send_loading").show();
                        jQuery("#action_form").submit();
                    }
                    else{return;}
                }
                jQuery('#action_form').jqxValidator('validate', validationResult);     
        });
</script>