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


</style>

<script type="text/javascript">
        
    </script>
    <script type="text/javascript">
        var theme = 'classic';
        var csrf_tokens='';
        var arrested_by = [<? $i=1; foreach($arrested_by as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var execution_criteria = [<? $i=1; foreach($execution_criteria as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var nature_warrent = [<? $i=1; foreach($nature_warrent as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var wa_status = [<? $i=1; foreach($disposal_sts as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        var type = [<? $i=1; foreach($executor_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->group_name.'"}'; $i++;}?>,{value:"0", label:"Others"}];
      // var type= [{value:"2", label:"Recovery"},{value:"1", label:"Legal"}];

       var valid_rule =[];
       var proposed_type =['Loan','Card'];

    jQuery(document).ready(function () {

        jQuery("#arrested_by").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Nature of Warrant of Arrest", source: arrested_by, width:250, height: 25});
        jQuery("#criteria").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Execution Criteria", source: execution_criteria, width: 250, height: 25});
        jQuery("#s_proposed_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, width: 100, height: 25});
        jQuery("#s_arrested_by").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Nature of Warrant Arrest", source: arrested_by, width: 150, height: 25});
        jQuery("#nature_wa").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Arrested By", source: nature_warrent, width: 250, height: 25});
        jQuery("#wa_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Arrested By", source: wa_status, width: 250, height: 25});
        //jQuery("#executor_type_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: type, width: 250, height: 25});
       
        jQuery('#nature_wa,#arrested_by,#wa_status,#s_arrested_by,#s_proposed_type,#criteria').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });

        //jQuery('#sendtochecker').jqxButton({template:"success", width: 120, height: 40, theme: theme });
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
        
            { input: '#nature_wa', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#nature_wa").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='nature_wa']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#nature_wa input").focus();
                            return false;
                        }
                }
            },
            
            { input: '#arrested_by', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#arrested_by").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='arrested_by']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#arrested_by input").focus();
                            return false;
                        }
                }
            },
            { input: '#wa_status', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#wa_status").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='wa_status']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#wa_status input").focus();
                            return false;
                        }
                }
            },
            
            { input: '#criteria', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#criteria").val()=='')
                    {
                        jQuery("#criteria").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                    
                }
            },
            /*{ input: '#executor_type_1', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#executor_type_1").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='executor_type_1']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#executor_type_1 input").focus();
                            return false;
                        }
                }
            },
            { input: '#amount_1', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#amount_1").val()=='')
                    {
                        jQuery("#amount_1").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                    
                }
            },

            
            { input: '#amount_1', message: 'Number is required!', action: 'keyup, blur', rule: function(input,commit){
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabaticDot('amount_1'))
                        {
                            jQuery("#amount_1").focus();
                            return false;

                        }
                    }
                    return true;
                }
            },
            { input: '#name_1', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                if (input.val()!='') {
                    return true;
                }
                else {
                    return false;
                }
            } 
            },
            { input: '#pin_1', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                if (input.val()!='') {
                    return true;
                }else {
                    return false;
                }
            } 
            },*/
            ]
        });
       
        // Jqx tab second tab function start    Grid Show
        var initGrid2 = function () {
            var source ={
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'int'},
                    { name: 'cma_id', type: 'int'},
                    { name: 'v_sts', type: 'int'},
                    { name: 'status', type: 'int'},
                    { name: 'suit_id', type: 'int'},
                    { name: 'case_name', type: 'int'},
                    { name: 'legal_region', type: 'int'},
                    { name: 'sl_no', type: 'string'},
                    { name: 'proposed_type', type: 'string'},
                    { name: 'loan_ac', type: 'string'},
                    { name: 'ac_name', type: 'string'},
                    { name: 'case_n', type: 'string'},
                    { name: 'case_number', type: 'string'},
                    { name: 'case_claim_amount', type: 'string'},
                    { name: 'owner_name', type: 'string'},
                    { name: 'owner_type', type: 'string'},
                    { name: 'arrested_by', type: 'string'},
                    { name: 'na_wa', type: 'string'},
                    { name: 'disposal_sts', type: 'string'},
                    { name: 'executed_criterea_name', type: 'string'},
                    { name: 'fsts', type: 'string'},
                    { name: 'sts', type: 'sts'},       
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
                url: '<?=base_url()?>index.php/warrant_arrest/executed_grid',
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
                    var s_arrested_by = jQuery.trim(jQuery('input[name=s_arrested_by]').val());
                    var s_proposed_type = jQuery.trim(jQuery('input[name=s_proposed_type]').val());
                    var hidden_loan_ac = jQuery.trim(jQuery('#hidden_loan_ac').val());
                    var s_serial_no = jQuery.trim(jQuery('#s_serial_no').val());
                    var s_case_number = jQuery.trim(jQuery('#s_case_number').val());
                    var s_account = jQuery.trim(jQuery('#s_account').val());
                    jQuery.extend(data, {
                            serial_no : s_serial_no,
                            case_number : s_case_number,
                            s_arrested_by : s_arrested_by,
                            account : s_account,
                            proposed_type : s_proposed_type,
                            hidden_loan_ac : hidden_loan_ac,
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
            var win_h=jQuery( window ).height()-320;
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
                    { text: 'status', datafield: 'status',hidden:true },
                    { text: 'case_name', datafield: 'case_name',hidden:true },
                    { text: 'legal_region', datafield: 'legal_region',hidden:true },
                    { text: 'owner_type', datafield: 'owner_type',hidden:true },
                    { text: 'sts', datafield: 'sts',hidden:true },
                    
                    <?php if(EDIT==1){ ?>
                    { text: 'E', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%', cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        if(dataRecord.v_sts == 38){
                            
                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                        }else
                        {
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

                    { text: 'Status', datafield: 'fsts',editable: false, width: '13%'},
                    { text: 'Account Name', datafield: 'ac_name',editable: false, width: '13%'},
                    { text: 'Account', datafield: 'loan_ac',editable: false, width: '13%'},
                    { text: 'Type', datafield: 'proposed_type',editable: false, width: '7%'},
                    { text: 'CMA Serial No', datafield: 'sl_no',editable: false, width: '13%'},
                    { text: 'Case name', datafield: 'case_n',editable: false, width: '13%'},
                    { text: 'Case Number', datafield: 'case_number',editable: false, width: '10%'},
                    { text: 'Amount', datafield: 'case_claim_amount',editable: false, width: '13%'},
                    { text: 'Borrower Name', datafield: 'owner_name',editable: false, width: '13%'},
                    
                ],
                        
            });
                
            jQuery("#details").jqxWindow({ theme: theme, maxWidth: '100%', maxHeight: '100%', width: 1000, height:550, resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok,#deletecancel,#SendTocheckercancel") });
            jQuery('#details').on('close', function (event) {
                //jQuery('#delete_convence').jqxValidator('hide');
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
            //alert('sdfsdf')
            //validate(valid_rule)
            //alert(document.getElementById('setteled').checked);
            if(!document.getElementById('setteled').checked){
                var total_file  = jQuery('#file_counter').val();
                var error_arr ='';
                for(let i=1;i<=total_file;i++){
                    if(jQuery("#del_row_"+i+"").val()==0){
                    if (jQuery("#hidden_wa_scan_copy_"+i+"_select").val()==0) {
                        error_arr +=i+', ';
                    }
                    }
                }
                if(error_arr!=''){
                    alert('Please Upload W/A Attested Scan Copy File');
                    return false;
                }
            
            var validationResult = function (isValid) {
                validate(valid_rule);
                //console.log(valid_rule);
                if (isValid && validate(valid_rule)==true && executed_validation()==true) {
                    //alert('ddd')
                    jQuery("#in_req_button").hide();
                    jQuery("#in_req_loading").show();
                    //jQuery("#legal_notice_form").submit();
                    call_ajax_submit();
                }
            }
            jQuery('#action_form').jqxValidator('validate', validationResult);    
            }else{
                var nawa = jQuery('#nature_wa').jqxComboBox('getSelectedItem');
                if(nawa==null){
                    alert('Nature of Warrant field is required!');
                    jQuery('#nature_wa').focuse();
                }else{
                    //alert(nawa.value);
                    jQuery("#in_req_button").hide();
                    jQuery("#in_req_loading").show();
                    call_ajax_submit();
                }
                
            }    
        });
        // Update Edit Form Submit
        jQuery("#in_up_button").click( function() {
           if(!document.getElementById('setteled').checked){ 
                
                var total_file  = jQuery('#file_counter').val();
                var error_arr ='';
                for(let i=1;i<=total_file;i++){

                    if(jQuery("#del_row_"+i+"").val()==0){

                        if (jQuery("#file_delete_value_wa_scan_copy_"+i+"").val()==1 && jQuery("#hidden_wa_scan_copy_"+i+"_select").val()==0) {
                            error_arr +=i+', ';
                        }
                        
                        if(jQuery("#hidden_wa_scan_copy_"+i+"_select").val()==0 && jQuery("#edit_file_row_"+i+"").val()==0){
                             error_arr +=i+', ';
                        }
                        if(jQuery("#file_delete_value_wa_scan_copy_"+i+"").val()==undefined && jQuery("#hidden_wa_scan_copy_"+i+"_select").val()==0){
                             error_arr +=i+', ';
                        }
                    }
                }
                if(error_arr!=''){
                    alert('Please Upload W/A Attested Scan Copy File');
                    return false;
                }
            validate(valid_rule);
            var validationResult = function (isValid) {
                if (isValid && validate(valid_rule)==true && executed_validation()==true) {
                    jQuery("#in_up_button").hide();
                    jQuery("#in_up_loading").show();
                    //jQuery("#legal_notice_form").submit();
                    call_ajax_submit();
                }
            }
            jQuery('#action_form').jqxValidator('validate', validationResult);     
            }else{
                var nawa = jQuery('#nature_wa').jqxComboBox('getSelectedItem');
                if(nawa==null){
                    alert('Nature of Warrant field is required!');
                    jQuery('#nature_wa').focuse();
                }else{
                    //alert(nawa.value);
                    jQuery("#in_up_button").hide();
                    jQuery("#in_up_loading").show();
                    call_ajax_submit();
                }
                
            }   
        });
        // Delete Form Validation 
        /*jQuery('#delete_convence').jqxValidator({
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
        });*/
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
           // jQuery('#delete_convence').jqxValidator('validate', validationResult);
         });

        // Send to checaker Ajax Call
        jQuery("#sendtochecker").click(function () {
            // if (jQuery('#checker_to_notify').val() == '' || jQuery('#checker_to_notify').val() == 0 || jQuery('#checker_to_notify').val() == null || jQuery('#checker_to_notify').val() == 'undefined') {
            //     alert('The checker to notify field is required!');
            //     jQuery('#checker_to_notify').focus();
            //     return;
            // }
            // else
            // {
                jQuery("#sendtochecker").hide();
                jQuery("#SendTocheckercancel").hide();
                jQuery("#checker_loading").show();
                delete_submit();
            //}
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
        url: "<?=base_url()?>warrant_arrest/add_edit_action/"+add_edit+"/"+edit_row,
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
                //up_button
                jQuery("#in_up_loading").hide();
                jQuery("#in_up_button").show();
            }else{
                jQuery("#in_req_button").show();
                jQuery("#in_req_loading").hide();
            }
            jQuery("#jqxGrid2").jqxGrid('updatebounddata');
            clear_form();
            jQuery('#jqxTabs').jqxTabs('disableAt', 1);
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
        url: '<?=base_url()?>index.php/expenses/delete_action/',
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
function get_dropdown_data(){
    var item = jQuery("#district").jqxComboBox('getSelectedItem');
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
                    jQuery("#staff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 250, height: 25});
                    jQuery('#staff').focusout(function() {
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
        jQuery("#staff").jqxComboBox('clearSelection');
        jQuery("#staff").val('');
    }
}
function edit(id,editrow,edit='edit'){
    clear_form();
    //jQuery('#search_area').hide();
    //jQuery('#add_form').show();
    jQuery('#jqxTabs').jqxTabs('enableAt', 1);
    jQuery('#jqxTabs').jqxTabs('select', 1);
   
    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
    
    jQuery('#add_button').hide();
    jQuery('#up_button').show();
    if( dataRecord['setteled_sts']==2){
        document.getElementById("setteled").checked = true;
    }else{
        document.getElementById("setteled").checked = false;
    }
        
    setteled_check('setteled');
    //console.log(edit);
    var cma_id = dataRecord['cma_id'];
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    valid_rule.forEach(function(item,index) {
        valid_rule.splice(index, valid_rule.length);
    });
    
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>Warrant_arrest/get_executed_row_edit/"+id,
        data : {[csrfName]: csrfHash},
        datatype: "json",
        async:false,
        success: function(response){
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;
            //console.log(rows);
            
            jQuery("#executed_counter").val(rows.length);
            jQuery("#executed").empty();
            var ehtml = "";var i=1;
            rows[0].executed.forEach(function(row,ind) {
                var g_type = '';var index = i;
                if(row.guarantor_type=='M'){
                    g_type="Borrower";
                }else{
                    g_type="Guarantor/Owner";
                }
                //console.log(row.executed_dt);
                if(row.who_executed==0){
                    jQuery('#check_0').attr('checked',true);
                    jQuery('#check_0').val(row.who_executed);
                    jQuery('#executed_date_0').val(row.executed_dt.replace(/-/g, "/"));
                    jQuery('#remarks_0').val(row.remarks);
                    jQuery('#gid_0').val(row.who_executed);
                    jQuery('#tedid_0').val(row.id);
                }else{

                    ehtml +='<tr><td><input type="checkbox" name="check_'+index+'" checked id="check_'+index+'" value="'+row.who_executed+'"></td><td width="50%">'+row.guarantor_name+' ('+g_type+')<input type="hidden" name="gid_'+index+'" id="gid_'+index+'" value="'+row.who_executed+'"><input type="hidden" name="tedid_'+index+'" id="tedid_'+index+'" value="'+row.id+'"></td><td><input type="text" name="executed_date_'+index+'" placeholder="dd/mm/yyyy" style="width:250px;" id="executed_date_'+index+'" value="'+row.executed_dt.replace(/-/g, "/")+'" ></td><td><input type="text" name="remarks_'+index+'" placeholder="Remarks" value="'+row.remarks+'" style="width:250px;" id="remarks_'+index+'" ></td></tr>';
                    datePicker ("executed_date_"+index);
                    i++;
                }
            });
            jQuery("#executed").append(ehtml);

            var html = "";var j=i;
            rows[0].guarantor.forEach(function(row,index) {
                var g_type = '';index+=i;
                if(row.guarantor_type=='M'){
                    g_type="Borrower";
                }else{
                    g_type="Guarantor/Owner";
                }
                html +='<tr><td><input type="checkbox" name="check_'+index+'" id="check_'+index+'" value="'+row.id+'"></td><td width="50%">'+row.guarantor_name+' ('+g_type+')<input type="hidden" name="gid_'+index+'" id="gid_'+index+'" value="'+row.id+'"><input type="hidden" name="tedid_'+index+'" id="tedid_'+index+'" value="0"></td><td><input type="text" name="executed_date_'+index+'" placeholder="dd/mm/yyyy" style="width:250px;" id="executed_date_'+index+'" value="" ></td><td><input type="text" name="remarks_'+index+'" placeholder="Remarks" style="width:250px;" id="remarks_'+index+'" ></td></tr>';
                datePicker ("executed_date_"+index);
                j++;
            });
            jQuery("#executed").append(html);
            jQuery("#executed_counter").val(j);
            jQuery("#eexecuted").empty();
            jQuery("#wa_files").empty();
            var torhtml = "";var i=0;
            rows[0].executor.forEach(function(row,index) {
                var theme = 'classic';
                //var counter = jQuery('#executor_counter').val();
                var counter = i;
                //console.log(index)
                var disable = '';
                if(row.paid_sts == 'paid'){
                    disable='readonly';
                }
                html_string = '';
                var new_counter = parseInt(counter) + 1;
                
                    html_string += '<tr id="executor_row_'+new_counter+'">';
                    html_string += '<td>';
                    html_string += '<input type="hidden" id="executor_info_edit_'+new_counter+'" name="executor_info_edit_'+new_counter+'" value="0">';
                    html_string += '<input type="hidden" id="executor_info_delete_'+new_counter+'" name="executor_info_delete_'+new_counter+'" value="0">';
                    if(new_counter>1 && disable==''){
                    html_string += '<img src="<?=base_url()?>images/delete-New.png" id="addel" onclick="delete_row_executor('+new_counter+')" style="margin-top: 5px;" style="cursor:pointer;">';
                    }
                    html_string += '</td>';
                    html_string += '<td><input type="text" '+disable+' name="pin_'+new_counter+'" id="pin_'+new_counter+'" placeholder="Pin" style="width:95%;" onchange="get_user_name('+new_counter+')"><input type="hidden" name="user_id_'+new_counter+'" id="user_id_'+new_counter+'" value="0"></td>';
                    html_string += '<td><input type="text" '+disable+' style="width:95%;" id="name_'+new_counter+'" name="name_'+new_counter+'" placeholder="Name"></td>';
                    html_string += '<td><div id="executor_type_'+new_counter+'" name="executor_type_'+new_counter+'" ></div></td>';
                    html_string += '<td><input type="text" style="width:95%;" '+disable+' id="amount_'+new_counter+'" name="amount_'+new_counter+'" placeholder="Amount"></td>';
                    html_string += '<td><input type="text" '+disable+' style="width:95%;" id="pariculars_'+new_counter+'" name="pariculars_'+new_counter+'" placeholder="Remarks"></td>';
                    html_string += '</tr>';

                //jQuery('#executor_row_' + counter).after(html_string);
                jQuery('#eexecuted').append(html_string);
                
                jQuery('#executor_counter').val(new_counter);
                
                jQuery('#executor_type_'+new_counter).jqxComboBox({theme: theme, width: 150, autoOpen: false, autoDropDownHeight: false, promptText: "Select Type", source: type, height: 25});
                jQuery('#executor_type_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
                });
                jQuery('#executor_type_'+new_counter).jqxComboBox('clearSelection');
                jQuery('#executor_type_'+new_counter).jqxComboBox('val',row.executor_type);
                if(row.paid_sts=='paid'){
                    jQuery('#executor_type_'+new_counter).jqxComboBox({'disabled':true});
                }
                jQuery('#pin_'+new_counter).val(row.pin);
                jQuery('#executor_info_edit_'+new_counter).val(row.id);
                jQuery('#user_id_'+new_counter).val(row.executor);
                jQuery('#name_'+new_counter).val(row.u_name);
                jQuery('#amount_'+new_counter).val(row.amount);
                jQuery('#pariculars_'+new_counter).val(row.pariculars);
                valid_rule.push({key:new_counter, input: '#executor_type_'+new_counter, message: 'required!', action: 'blur,change', rule: function(input,commit){
                                if(input.val() != '')
                                    {
                                        var item = jQuery("#executor_type_"+new_counter).jqxComboBox('getSelectedItem');
                                        if(item != null){jQuery("input[name='executor_type_"+new_counter+"']").val(item.value);}
                                        return true;                
                                    }
                                    else
                                    {
                                        jQuery("#executor_type_"+new_counter+" input").focus();
                                        return false;
                                    }
                            }
                        },{ key:new_counter,input: '#pin_'+new_counter, message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                                if(jQuery("#pin_"+new_counter).val()=='')
                                {
                                    var item = jQuery("#executor_type_"+new_counter).jqxComboBox('getSelectedItem');
                                    if(item!=null){
                                        if(item.value==0){
                                            return true;
                                        }else{
                                           jQuery("#pin_"+new_counter).focus();
                                            return false; 
                                        }
                                    }else{
                                        return true;
                                    }
                                }
                                else
                                {
                                    return true;
                                }
                                
                            }
                        },
                        { key:new_counter, input: '#amount_'+new_counter, message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                                if(jQuery("#amount_"+new_counter).val()=='')
                                {
                                    jQuery("#amount_"+new_counter).focus();
                                    return false;
                                }
                                else
                                {
                                    return true;
                                }
                                
                            }
                        },
                        { key:new_counter, input: '#amount_'+new_counter, message: 'Number is required!', action: 'keyup, blur', rule: function(input,commit){
                                if(input.val() != '')
                                {
                                    if(!checknumber_alphabaticDot('amount_'+new_counter))
                                    {
                                        jQuery("#amount_"+new_counter).focus();
                                        return false;

                                    }
                                }
                                return true;
                            }
                        },
                        { key:new_counter, input: '#name_'+new_counter, message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                            if (input.val()!='') {
                                return true;
                            }
                            else {
                                return false;
                            }
                        } 
                });
                i++;
                //console.log(new_counter)
            });
            //jQuery("#eexecuted").html(html_string);
            //jQuery('#executor_counter').val(rows[0].executor.length);

            jQuery("#loan_ac_ds").html(rows[0].loan_ac);
            jQuery("#loan_ac_na").html(rows[0].ac_name);
            jQuery("#case_num").html(rows[0].case_number);
            jQuery("#arrested_by").jqxComboBox('val',rows[0].arrested_by);
            jQuery("#nature_wa").jqxComboBox('val',rows[0].nature_wa);
            jQuery("#wa_status").jqxComboBox('val',rows[0].wa_status);
            //jQuery("#executor_type_1").jqxComboBox('val',rows[0].arrested_by);
            jQuery("#criteria").jqxComboBox('val',rows[0].executed_criterea);
            jQuery("#cma_id").val(rows[0].cma_id);
            //jQuery("#executor_counter").val(rows[0].executor.length);
            jQuery("#add_edit").val('edit');
            jQuery("#suit_id").val(rows[0].file_id);
            jQuery("#edit_row").val(id);
            jQuery('#load_rule').click();
            var i=0;
            rows[0].wa_files.forEach(function(row,index) {
                var theme = 'classic';
                var counter = i;
                //console.log(counter);
                var new_counter = parseInt(counter) + 1;
                html_string = '<tr id="files_row_'+new_counter+'"><td><span id="wa_scan_copy_'+new_counter+'"></span></td><td><input type="hidden" name="del_row_'+new_counter+'" id="del_row_'+new_counter+'" value="0"><input type="hidden" name="edit_file_row_'+new_counter+'" id="edit_file_row_'+new_counter+'" value="'+row.id+'">';
                    if(i>0){
                        html_string += '<img onclick="delete_file_row('+new_counter+')" src="<?php echo base_url('images/del.png'); ?>">';
                    }
                    html_string += '</td></tr>';

                jQuery('#wa_files').append(html_string);
                var html = '';
                html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'wa_scan_copy_'+new_counter+'\')"/>';
                html+='<input type="hidden" id="hidden_wa_scan_copy_'+new_counter+'_select" name="hidden_wa_scan_copy_'+new_counter+'_select" value="0">';

                if(row.wa_scan_copy!='' && row.wa_scan_copy!=null)
                {
                    html +='<span id="hidden_wa_scan_copy_'+new_counter+'"><img id="file_preview_wa_scan_copy_'+new_counter+'" onclick="popup(\'<?=base_url()?>cma_file/wa_scan_copy/'+row.wa_scan_copy+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                    html +='<input type="hidden" id="hidden_wa_scan_copy_'+new_counter+'_value" name="hidden_wa_scan_copy_'+new_counter+'_value" value="'+row.wa_scan_copy+'">';
                    html +='<img id="file_delete_wa_scan_copy_'+new_counter+'" onclick="file_delete(\'wa_scan_copy_'+new_counter+'\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                    html +='<input type="hidden" id="file_delete_value_wa_scan_copy_'+new_counter+'" name="file_delete_value_wa_scan_copy_'+new_counter+'" value="0">';
                }
                else
                {
                    html+='<span id="hidden_wa_scan_copy_'+new_counter+'">';
                }
                jQuery('#wa_scan_copy_'+new_counter+'').html(html);
                jQuery('#file_counter').val(new_counter);
                i++;
            });

            
        }
    });
    
    
}
function clear_form(){
    jQuery("#executed").html('');
    jQuery("#cma_id").val('');
    jQuery("#executor_counter").val(1);
    jQuery("#add_edit").val('add');
    jQuery("#suit_id").val('');
    jQuery("#loan_ac_ds").html();
    jQuery("#loan_ac_na").html();
    jQuery("#case_num").html();
    jQuery("#edit_row").val('');
    jQuery("#arrested_by").jqxComboBox('clearSelection');
    jQuery("#nature_wa").jqxComboBox('clearSelection');
    jQuery("#wa_status").jqxComboBox('clearSelection');
    jQuery("#criteria").jqxComboBox('clearSelection');
}


function details (id,editrow,operation) {
    var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
    //console.log(dataRecord);
    if(operation=='verify'){

        jQuery("#deleteEventId").val(id);
        jQuery("#verifyid").val('');
        jQuery("#type").val(operation);
        jQuery("#preview").hide();
        jQuery("#verify_row").show();
    }else{
        jQuery("#deleteEventId").val('');
        jQuery("#verifyid").val('');
        jQuery("#verify_row").hide();
        jQuery("#preview").show();
    }
    var cma_id = dataRecord['cma_id'];
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>Warrant_arrest/get_details/"+id,
        data : {[csrfName]: csrfHash},
        datatype: "json",
        async:false,
        success: function(response){
            var ds=response.split('####');
            jQuery('.txt_csrfname').val(ds[1]);
            /*var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;*/
            console.log(ds[0]);
            jQuery('#previewtable').html(ds[0]);
        }
    });
    
    //console.log(dataRecord);
    jQuery("#r_heading").html('Warrant Of Arrest');

   /* jQuery("#p_serial_no").html(dataRecord['sl_no']);
    jQuery("#p_account_name").html(dataRecord['ac_name']);
    jQuery("#p_account").html(dataRecord['loan_ac']);
    jQuery("#p_owner_name").html(dataRecord['owner_name']);
    jQuery("#p_type").html(dataRecord['proposed_type']);
    jQuery("#p_case_name").html(dataRecord['case_n']);
    jQuery("#p_case_number").html(dataRecord['case_number']);
    jQuery("#p_amount").html(dataRecord['case_claim_amount']);*/

    document.getElementById("details").style.display='block';
    jQuery("#details").jqxWindow('open');
}
function add_more_files(){
    jQuery('#action_form').jqxValidator('hide');
    jQuery('#table').jqxValidator('hide');
    var theme = 'classic';
    var counter = jQuery('#file_counter').val();
    //console.log(counter);
    var new_counter = parseInt(counter) + 1;
    html_string = '<tr id="files_row_'+new_counter+'"><td><span id="wa_scan_copy_'+new_counter+'"></span></td><td><input type="hidden" name="del_row_'+new_counter+'" id="del_row_'+new_counter+'" value="0"><input type="hidden" name="edit_file_row_'+new_counter+'" id="edit_file_row_'+new_counter+'" value="0"><img onclick="delete_file_row('+new_counter+')" src="<?php echo base_url('images/del.png'); ?>"></td></tr>';

    jQuery('#files_row_' + counter).after(html_string);
    var html = '';
    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'wa_scan_copy_'+new_counter+'\')"/>';
    html+='<input type="hidden" id="hidden_wa_scan_copy_'+new_counter+'_select" name="hidden_wa_scan_copy_'+new_counter+'_select" value="0">';
    html+='<span id="hidden_wa_scan_copy_'+new_counter+'">';
    jQuery('#wa_scan_copy_'+new_counter+'').html(html);
    jQuery('#file_counter').val(new_counter);
}
function delete_file_row(row_id){
    jQuery('#action_form').jqxValidator('hide');
    jQuery('#table').jqxValidator('hide');
    jQuery('#files_row_' + row_id).hide();
    jQuery('#del_row_' + row_id).val(1);
}
function add_more_executor()
{
    jQuery('#action_form').jqxValidator('hide');
    jQuery('#table').jqxValidator('hide');
    var theme = 'classic';
    var counter = jQuery('#executor_counter').val();

    var new_counter = parseInt(counter) + 1;
    html_string = '';
        html_string += '<tr id="executor_row_'+new_counter+'">';
        html_string += '<td>';
        html_string += '<input type="hidden" id="executor_info_edit_'+new_counter+'" name="executor_info_edit_'+new_counter+'" value="0">';
        html_string += '<input type="hidden" id="executor_info_delete_'+new_counter+'" name="executor_info_delete_'+new_counter+'" value="0">';
        html_string += '<img src="<?=base_url()?>images/delete-New.png" id="addel" onclick="delete_row_executor('+new_counter+')" style="margin-top: 5px;" style="cursor:pointer;">';
        html_string += '</td>';
        
        html_string += '<td><input type="text" name="pin_'+new_counter+'" id="pin_'+new_counter+'" placeholder="Pin" style="width:95%;" onchange="get_user_name('+new_counter+')"><input type="hidden" name="user_id_'+new_counter+'" id="user_id_'+new_counter+'" value="0"></td>';
        html_string += '<td><input type="text" style="width:95%;" id="name_'+new_counter+'" name="name_'+new_counter+'" placeholder="Name"></td>';
        html_string += '<td><div id="executor_type_'+new_counter+'" name="executor_type_'+new_counter+'" ></div></td>';
        html_string += '<td><input type="text" style="width:95%;" id="amount_'+new_counter+'" name="amount_'+new_counter+'" placeholder="Amount"></td>';
        html_string += '<td><input type="text" style="width:95%;" id="pariculars_'+new_counter+'" name="pariculars_'+new_counter+'" placeholder="Remarks"></td>';
        html_string += '</tr>';

    jQuery('#executor_row_' + counter).after(html_string);
    
    jQuery('#executor_counter').val(new_counter);
    
    jQuery('#executor_type_'+new_counter).jqxComboBox({theme: theme, width: 150, autoOpen: false, autoDropDownHeight: false, promptText: "Select Type", source: type, height: 25});
    jQuery('#executor_type_'+new_counter).focusout(function() {
        commbobox_check(jQuery(this).attr('id'));
    });
    valid_rule.push({key:new_counter, input: '#executor_type_'+new_counter, message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#executor_type_"+new_counter).jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='executor_type_"+new_counter+"']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#executor_type_"+new_counter+" input").focus();
                            return false;
                        }
                }
            },{ key:new_counter,input: '#pin_'+new_counter, message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#pin_"+new_counter).val()=='')
                    {
                        var item = jQuery("#executor_type_"+new_counter).jqxComboBox('getSelectedItem');
                        if(item!=null){
                            if(item.value==0){
                                return true;
                            }else{
                               jQuery("#pin_"+new_counter).focus();
                                return false; 
                            }
                        }else{
                            return true;
                        }
                    }
                    else
                    {
                        return true;
                    }
                    
                }
            },
            { key:new_counter, input: '#amount_'+new_counter, message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#amount_"+new_counter).val()=='')
                    {
                        jQuery("#amount_"+new_counter).focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                    
                }
            },
            { key:new_counter, input: '#amount_'+new_counter, message: 'Number is required!', action: 'keyup, blur', rule: function(input,commit){
                    if(input.val() != '')
                    {
                        if(!checknumber_alphabaticDot('amount_'+new_counter))
                        {
                            jQuery("#amount_"+new_counter).focus();
                            return false;

                        }
                    }
                    return true;
                }
            },
            { key:new_counter, input: '#name_'+new_counter, message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                if (input.val()!='') {
                    return true;
                }
                else {
                    return false;
                }
            } 
    });
}
function validate(val){
    //console.log(val.length)
    jQuery('#table').jqxValidator({
        rules:val
    });
    var d=true;
    if(val.length>0){
        d=false;
    }
    var validationResult = function(isValid){
        if(isValid){
            d= true;
        }
    }
    jQuery('#table').jqxValidator('validate', validationResult); 
    
    return d;
}
function delete_row_executor (row_id) {
    jQuery('#action_form').jqxValidator('hide');
    jQuery('#table').jqxValidator('hide');
    jQuery('#executor_row_' + row_id).hide();

    jQuery('#executor_info_delete_' + row_id).val(1);
    //var index = parseInt(row_id)-2;
    valid_rule.forEach(function(item,index) {
        if(item.key==row_id){
            valid_rule.splice(index, 5);
        }
    });
    //valid_rule.splice(index, 1);
    //console.log(valid_rule)
}
function executor_validation()
{
    var counter=0;
    <? if($add_edit=='add'){?>
        var total_row = jQuery('#address_counter').val();
    <? } ?>
    <? if($add_edit=='edit'){?>
        var total_row = jQuery('#expense_counter_edit').val();
    <? } ?>
    //alert(total_row);
     for (i=1;i<=total_row;i++) 
     {
        if(jQuery('#address_info_delete_'+i).val()==0) 
        {
            var item = jQuery("#address_type_"+i).jqxComboBox('getSelectedItem');
            //alert(item.value);
            if(!item){
                alert('Address Type Required');
                jQuery('#address_type_'+i).focus();
                return false;
            } 
            if(jQuery.trim(jQuery('#address_details_'+i).val())=='')
            {
                alert('Address Details Required');
                jQuery('#address_details_'+i).focus();
                return false;
            }
            if(jQuery.trim(jQuery('#country_'+i).val())=='')
            {
                alert('Country Required');
                jQuery('#country_'+i).focus();
                return false;
            }
            if(jQuery.trim(jQuery('#district_'+i).val())=='')
            {
                alert('District Required');
                jQuery('#district_'+i).focus();
                return false;
            }
            for(j=1;j<i;j++){
                var oit = jQuery("#address_type_"+j).jqxComboBox('getSelectedItem');
                if(item.value == oit.value){
                    alert('Address Type Can not be Duplicate');
                    jQuery('#address_type_'+i).focus();
                    return false;
                }
            }
        } 
     }
     return true;
}

function executed_validation(){
    var total_row = jQuery('#executed_counter').val();
    var check =0;
    for (i=0;i<total_row;i++) 
     { 
        //check_
        var checkBox = document.getElementById("check_"+i);
        if(checkBox.checked == true){
            if(i==0){
                if(jQuery("#remarks_"+i).val().length==0){
                    alert('Remarks is Required!');
                    jQuery('#remarks_'+i).focus();
                    return false;
                }
            }
            if(jQuery("#executed_date_"+i).val()==''){
                alert('Date is Required');
                jQuery('#executed_date_'+i).focus();
                return false;
            }
            if(jQuery("#executed_date_"+i).val()!=''){
                if(validateDate(jQuery("#executed_date_"+i).val(),'advance')==false){
                    alert('Advance Date not allowed');
                    jQuery('#executed_date_'+i).focus();
                    return false;
                }
            }
            check=1;
        }
         
    }
    if(check==1){
        return true;
    }else{
        alert('Minimum 1 Executed checked is Required');
        return false;
    }
    
}
function get_user_name(id){
    var pin = jQuery('#pin_'+id).val();
    var csrfName = jQuery('.txt_csrfname').attr('name');
    var csrfHash = jQuery('.txt_csrfname').val();
    if(pin!=''){
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?=base_url()?>Warrant_arrest/get_user_name/"+pin,
            data : {[csrfName]: csrfHash},
            datatype: "json",
            async:false,
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                var rows = json.row_info;
                //console.log(rows);
                if(rows.length>0){
                    jQuery('#name_'+id).val(rows[0].name);
                    jQuery('#user_id_'+id).val(rows[0].id);
                    jQuery('#executor_type_'+id).jqxComboBox('clearSelection');
                    jQuery('#executor_type_'+id).jqxComboBox('val',rows[0].user_group_id);
                }else{
                    jQuery('#name_'+id).val('');
                    jQuery('#executor_type_'+id).jqxComboBox('clearSelection');
                    jQuery('#user_id_'+id).val(0);
                }
            }
        });
    }

}
function setteled_check(val){
    //alert(val.checked)
    jQuery('#action_form').jqxValidator('hide');
    jQuery('#table').jqxValidator('hide');
    var ddd = document.getElementById(val).checked;
    document.getElementById('criteria').disabled = ddd;
    jQuery("#arrested_by").jqxComboBox({ disabled: ddd });
    jQuery("#wa_status").jqxComboBox({ disabled: ddd });
    if(ddd){
        jQuery('#row_hide1').hide();
        jQuery('#row_hide2').hide();
    }else{
        jQuery('#row_hide1').show();
        jQuery('#row_hide2').show();
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
function file_delete(id){
    if(confirm('Are you sure to Delete previous file?')){   
        jQuery("#file_preview_"+id).hide(); 
        jQuery("#file_delete_"+id).hide();  
        jQuery("#file_delete_value_"+id).val(1);    
    }
}

</script>
<div id="container">
    <div id="body"  >
        <table class="">
            <tr id="widgetsNavigationTree">
                <td valign="top" align="left" class='navigation'>
                    <!---- Left Side Menu Start ------>
                    <?php $this->load->view('warrant_arrest/pages/left_side_nav'); ?>
                    <!----====== Left Side Menu End==========----->
                </td>
                <td valign="top" id="demos" class='rc-all content'>
                    <div id="preloader">
                      <div id="loding"></div>
                    </div>
                    <div id="footer_loader_body">
                    <div id='jqxTabs'>
                        <ul>
                            <li style="margin-left: 30px;">Data Grid</li>
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
                                            <td style="width: 80px"><strong><span id="l_or_c_no"></span>&nbsp;&nbsp;</strong> </td>
                                            <td><input type="text" id="s_account" name="s_account" maxlength="16" size="16" style="width:150px" onKeyUp="javascript:return mask(this.value,this);" /></td>
                                            
                                            <td><strong>Case Number&nbsp;&nbsp;</strong> </td>
                                            <td><input type="text" id="s_case_number" name="s_case_number" style="width:100%" /></td>
                                            <td><strong>Serial No.&nbsp;&nbsp;</strong> </td>
                                            <td><input type="text" id="s_serial_no" name="s_serial_no" style="width:100%" /></td>
                                            <td><strong>Arrested By&nbsp;&nbsp;</strong> </td>
                                            <td><div id="s_arrested_by" name="s_arrested_by"></div></td>
                                            <td><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data(),clearCount()" style="width:58px" />
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
                            <!---onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;" href="<?=base_url()?>index.php/legal_notice_ho/bulk_operation/ack"--->

                            </div>
                            </div>
                        </div>
                        <!---==== Second Tab Start ==========----->
                        <div style="overflow: hidden;_overflow-y: scroll;">
                            
                            <div style="padding: 10px;">
                            <form class="form" name="action_form" id="action_form" method="post" action="" enctype="multipart/form-data">
                                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <input type="hidden" id="add_edit" value="add" name="add_edit">
                                <input type="hidden" id="edit_row" value="" name="edit_row">
                                <input type="hidden" id="cma_id" value="" name="cma_id">
                                <input type="hidden" id="suit_id" value="" name="suit_id">
                                <table style="width: 100%;">
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Nature of W/A<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="nature_wa" name="nature_wa" style="padding-left: 3px"></div></td>
                                        <td width="50%" colspan="2" rowspan="5">
                                            <table border="1" cellpadding="5">
                                                <tr>
                                                    <td><b>Loan Account</b></td>
                                                    <td><b>Account Name</b></td>
                                                    <td><b>Case Number</b></td>
                                                </tr>
                                                <tr>
                                                    <td id="loan_ac_ds"></td>
                                                    <td id="loan_ac_na"></td>
                                                    <td id="case_num"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Settled </td>
                                        <td width="30%" ><input type="checkbox" onclick="setteled_check('setteled')" id="setteled" name="setteled" value="1"></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Arrested By<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="arrested_by" name="arrested_by" style="padding-left: 3px" ></div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">W/A Status<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="wa_status" name="wa_status" style="padding-left: 3px"></div></td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Execution Criteria<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="criteria" name="criteria" style="padding-left: 3px"></div></td>
                                    </tr>
                                     <tr>
                                        <td width="20%" style="font-weight: bold;">Police Station Sharok no</td>
                                        <td width="30%" ><input type="text" name="sharok_no" id="sharok_no" placeholder="Police Station Sharok No" style="width:250px;"></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Issue Date </td>
                                        <td width="30%" ><input type="text" name="issue_date" placeholder="dd/mm/yyyy" style="width:250px;" id="issue_date" ><script>datePicker ("issue_date")</script></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Police Station Name </td>
                                        <td width="30%" ><input type="text" name="ps_name" id="ps_name" placeholder="Police Station Name" style="width:250px;"></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">W/A Copy Attested<span style="color:red">*</span> </td>
                                        <td width="30%" >
                                            <table style="width: 100%;" id="file_up">
                                                <input type="hidden" name="file_counter" id="file_counter" value="1">
                                                <tbody id="wa_files">
                                                    
                                                </tbody>
                                                <tfooter>
                                                    <tr><td style="_text-align: right;"><input tabindex="" type="button" title="Add More File"  id="addel" onClick="add_more_files()" class="addmore"></td></tr>
                                                </tfooter>
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    <tr id="row_hide1">
                                        <td colspan="4" width="100%">
                                            <input type="hidden" name="executed_counter" id="executed_counter" value="">
                                            <table style="width: 100%;" border="1">
                                                <tr>
                                                    <td colspan="2"><b>Who Executed?</b></td>
                                                    <td>Date</td>
                                                    <td>Remarks</td>
                                                </tr>
                                                <tbody id="executed"></tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="check_0" id="check_0" value="0">
                                                            <input type="hidden" name="gid_0" id="gid_0" value="0">
                                                            <input type="hidden" name="tedid_0" id="tedid_0" value="0">
                                                        </td>
                                                        <td>Others</td>
                                                        <td><input type="text" name="executed_date_0" placeholder="dd/mm/yyyy" style="width:100px;" id="executed_date_0" ><script>datePicker ("executed_date_0");</script></td>
                                                        <td><input type="text" name="remarks_0" placeholder="Remarks" value="" style="width:98%" id="remarks_0" ></td>
                                                    </tr>
                                
                                                </tfoot>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr><td colspan="4"></td></tr>
                                    <tr><td colspan="4"></td></tr>
                                    <tr id="row_hide2">
                                        <td colspan="4" width="100%">
                                            <table style="width: 100%;" border="1" id="table">
                                                <input type="hidden" name="executor_counter" id="executor_counter" value="1">
                                                <thead>
                                                <tr style="background-color: #d9f0ff;">
                                                    <td colspan="6"><b>Executor</b></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Pin</td>
                                                    <td>Name</td>
                                                    <td>Type</td>
                                                    <td>Amount</td>
                                                    <td>Remarks</td>
                                                </tr>
                                                </thead>
                                                <tbody id="eexecuted">

                                                
                                                </tbody>
                                                <tfoot>
                                                <tr id="add_executor_row">
                                                    <td colspan="11" style="text-align: right">
                                                        Add More <input tabindex="" type="button" title="Add More"  id="addel" onClick="add_more_executor()" class="addmore"><br>
                                                        <span id="load_rule"></span>
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
                        </div>
                    </div>
                    </div>
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
        <div id="previewtable"></div>
        
        <div id="preview" class="wrapper">
            </br></br><input type="button" align="center" class="buttonclose" id="r_ok" value="Close" />
        </div>
        <!-- <div id="checker_row" style="text-align:center;margin-bottom:30px;width:100%;">
            
            <br><br>
            <input type="button" class="buttonSend" id="sendtochecker" value="Send">
            <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel">
            <span id="checker_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
        </div>
        <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
            
            <br><br>
            <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
            <textarea name="comments" id="comments" style="width:370px;"></textarea>
            
            <br><br>
            <input type="button" class="buttondelete" id="delete_button" value="Delete">
            <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel">
            <span id="delete_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
            
        </div> -->
        </form>
    </div>
</div>

