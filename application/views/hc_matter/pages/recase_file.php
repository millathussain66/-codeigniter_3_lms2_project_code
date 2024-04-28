<style>
   

    table, td {
        padding: 5px;
        margin: 0px;
        border-spacing: 0px;
        border-collapse: collapse;
    }
    .back_image{
        background-image:url(<?=base_url()?>images/login_images/back_1.jpg);
        background-repeat: no-repeat;
        background-color:transparent;
        background-size: auto;
        _background-size: 1108px 763px;
        background-position: -20px 108%;
    }
    .jqx-tabs-header{
        border-color: #93CDDD!important;
        background: #93CDDD!important;
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
        _text-shadow: 0 1px 0 #FFFFFF;
    }
    .navigationItem a{
        font-weight: bold!important;
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
            _border-top-color: #ccc;
            _border-left-color: #ccc;
            _color: #2e2e2e;
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
            _color: #00a2e8;
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

#search_area{
    box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
}
#grid_search:hover{
    background: #29cdff!important;
}
.buttonStyle:hover{
    _background: #ddd!important;
}
</style>


<script type="text/javascript">
    var theme = 'classic';
    var csrf_tokens='';

    // var type= [{value:"2", label:"Recovery"},{value:"1", label:"Legal"}];
    var arrested = [{value:"1", label:"Yes"},{value:"2", label:"No"},];

    var valid_rule =[];
    //var lawyer = [<?// $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    //var district = [<? //$i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var expense_activities = [];

    var loan_segment = [<? $i=1; foreach($loan_segment as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var hc_case_type = [<? $i=1; foreach($hc_case_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var hc_bench = [<? $i=1; foreach($hc_bench as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var dealing_officer = [<? $i=1; foreach($dealing_officer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
    var case_sts = [<? $i=1; foreach($case_sts as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
        


    jQuery(document).ready(function () {

        jQuery("#portfolio").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Portfolio", source: loan_segment, width: 250, height: 25});
        jQuery("#case_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Case Type", source: hc_case_type, width: 250, height: 25});

        jQuery("#ac_closing_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Status", source: arrested, width: 250, height: 25});
        jQuery("#hc_dealing_officer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select HC Dealing Officer", source: dealing_officer, width: 250, height: 25});
        jQuery("#lower_dealing_officer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lower Dealing Officer", source: dealing_officer, width: 250, height: 25});
        jQuery("#deposited_appeal_money").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Deposited Appeal Money", source: arrested, width: 250, height: 25});
        jQuery("#compromised").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Compromised", source: arrested, width: 250, height: 25});
        jQuery("#name_dist").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select DIST", source: district, width: 250, height: 25});
        jQuery("#present_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Present Status", source: case_sts, width: 250, height: 25});
        jQuery("#hc_bench").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select HC Bench", source: hc_bench, width: 250, height: 25});
        jQuery("#hc_lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select HC Lawyer", source: lawyer, width: 250, height: 25});
        jQuery("#am_withrawn_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Withdrawn Status", source: arrested, width: 250, height: 25});
        jQuery("#power_submit").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Power Submit", source: arrested, width: 250, height: 25});
        jQuery("#assigned_lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Assigned Lawyer", source: lawyer, width: 250, height: 25});
        

        
        //jQuery("#group_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Type", source: user_group, width: 250, height: 25});
       
        jQuery('#portfolio,#case_type,#ac_closing_status,#hc_dealing_officer,#lower_dealing_officer,#deposited_appeal_money,#compromised,#name_dist,#present_status,#hc_bench,#hc_lawyer,#am_withrawn_status,#power_submit,#assigned_lawyer').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });

        //jQuery('#sendtochecker').jqxButton({template:"success", width: 120, height: 40, theme: theme });

        
        
        // Add edit form validation
        jQuery('#action_form').jqxValidator({
            rules: [

            { input: '#account_no', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#account_no").val()=='')
                {
                    jQuery("#account_no").focus();
                    return false;
                }
                else
                {
                    return true;
                }    
            }
            },
            { input: '#account_no', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit){
                    if(input.val() != ''){
                        if(!checknumber_alphabaticwithstar('account_no'))
                        {
                            jQuery("#account_no").focus();
                            return false;

                        }
                    }
                    return true;

                } 
            },
            { input: '#account_no', message: 'must be 16 digits', action: 'keyup, blur, change', rule: function (input, commit)
             {
                if(input.val() != '')
                {
                    if(input.val().length<16 || input.val().length>16)
                    {
                        jQuery("#account_no").focus();
                        return false;

                    }
                }
                return true;

            } },
            { input: '#account_name', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#account_name").val()=='')
                {
                        jQuery("#account_name").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            },
            /*{ input: '#lcr_reminder', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#lcr_reminder").val()=='')
                {
                        jQuery("#lcr_reminder").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            },
            { input: '#lcr_send', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#lcr_send").val()=='')
                {
                        jQuery("#lcr_send").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            },
            { input: '#lcr_received', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#lcr_received").val()=='')
                {
                        jQuery("#lcr_received").focus();
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
                        jQuery("#present_casue_action").focus();
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
                            jQuery("#portfolio input").focus();
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
                            jQuery("#assigned_lawyer input").focus();
                            return false;
                        }
                }
            },*/
            { input: '#case_type', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#case_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='case_type']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#case_type input").focus();
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
                            jQuery("#name_dist input").focus();
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
                            jQuery("#present_status input").focus();
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
                            jQuery("#hc_bench input").focus();
                            return false;
                        }
                }
            },
            { input: '#hc_lawyer', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#hc_lawyer").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='hc_lawyer']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#hc_lawyer input").focus();
                            return false;
                        }
                }
            },
            { input: '#ac_closing_status', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#ac_closing_status").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='ac_closing_status']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#ac_closing_status input").focus();
                            return false;
                        }
                }
            },
            /*{ input: '#power_submit', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#power_submit").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='power_submit']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#power_submit input").focus();
                            return false;
                        }
                }
            },
            { input: '#hc_dealing_officer', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#hc_dealing_officer").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='hc_dealing_officer']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#hc_dealing_officer input").focus();
                            return false;
                        }
                }
            },*/
            /*{ input: '#lower_dealing_officer', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#lower_dealing_officer").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='lower_dealing_officer']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#lower_dealing_officer input").focus();
                            return false;
                        }
                }
            },*/
            /*{ input: '#deposited_appeal_money', message: 'required!', action: 'blur,change', rule: function(input,commit){
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
            },
            { input: '#compromised', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#compromised").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='compromised']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#compromised input").focus();
                            return false;
                        }
                }
            },
            { input: '#am_withrawn_status', message: 'required!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() != '')
                        {
                            var item = jQuery("#am_withrawn_status").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='am_withrawn_status']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#am_withrawn_status input").focus();
                            return false;
                        }
                }
            },
            */



            { input: '#case_no', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#case_no").val()=='')
                {
                        jQuery("#case_no").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            },
            { input: '#case_claim', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#case_claim").val()=='')
                {
                        jQuery("#case_claim").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            },
            { input: '#case_claim', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit){
                    if(input.val() != ''){
                        if(!checknumber_alphabaticDot('case_claim'))
                        {
                            jQuery("#case_claim").focus();
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
                            jQuery("#case_claim").focus();
                            return false;

                        }
                    }
                    return true;

                } 
            },
            
            /*{ input: '#amount_appeal_money', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                if(jQuery("#amount_appeal_money").val()=='')
                {
                        jQuery("#amount_appeal_money").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            },
            { input: '#amount_appeal_money', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit){
                    if(input.val() != ''){
                        if(!checknumber_alphabaticDot('amount_appeal_money'))
                        {
                            jQuery("#amount_appeal_money").focus();
                            return false;

                        }
                    }
                    return true;

                } 
            },
            { input: '#amount_appeal_money', message: 'Amount must be Greater-than 0', action: 'keyup, blur, change', rule: function (input, commit){
                    if(input.val() != '')
                    {
                        if(input.val()<1)
                        {
                            jQuery("#amount_appeal_money").focus();
                            return false;

                        }
                    }
                    return true;

                } 
            },*/
            




            { input: '#filing_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                        }
                        else {
                            return false;
                        }
                } 
            },
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
            { input: '#last_act_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                        }
                        else {
                            return false;
                        }
                } 
            },
            { input: '#last_act_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                    if(validateDate(input.val(),'advance'))
                    {
                        return true;
                    }else {
                        return false;
                    }
                } 
            },
            { input: '#lcr_send_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                        }
                        else {
                            return false;
                        }
                } 
            },
            { input: '#lcr_send_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
            { input: '#lcr_received_date', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                        }
                        else {
                            return false;
                        }
                } 
            },
            { input: '#lcr_received_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                    if(validateDate(input.val(),'advance'))
                    {
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
                    { name: 'hc_lawyer_name', type: 'string'},
                    { name: 'hc_type_name', type: 'string'},
                    { name: 'lawyer_name', type: 'string'},
                    { name: 'hc_officer', type: 'string'},
                    { name: 'lower_officer', type: 'string'},
                    { name: 'assigned_lawyer_name', type: 'string'},
                    { name: 'filing_date', type: 'string'},
                    { name: 'last_act_date', type: 'string'},
                    { name: 'file_receive_date', type: 'string'},
                    { name: 'lcr_send_date', type: 'string'},
                    { name: 'lcr_receive_date', type: 'string'},
                    { name: 'am_withdrawn_date', type: 'string'},
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
                url: '<?=base_url()?>index.php/hc_matter/recase_file_grid',
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
                            if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35){
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
                        if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35){
                            
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
                    { text: 'STC', menu: false, datafield: 'sendtochecker', align:'center', editable: false, sortable: false, width: '2%', cellsrenderer: function (row) {
                        editrow = row;
                        var dataRecord = jQuery("#jqxGrid2").jqxGrid('getrowdata', editrow);
                        if(dataRecord.v_sts == 39 || dataRecord.v_sts == 35){
                            
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

                    { text: 'HC Matter Type', datafield: 'hc_matter_type',editable: false, width: '13%'},
                    { text: 'Account Name', datafield: 'ac_name',editable: false, width: '13%'},
                    { text: 'Account', datafield: 'ac_number',editable: false, width: '13%'},
                    { text: 'Case Number', datafield: 'case_no',editable: false, width: '13%'},
                    { text: 'Case Claim', datafield: 'case_claim',editable: false, width: '13%'},
                    { text: 'Case Status', datafield: 'case_sts_name',editable: false, width: '13%'},
                    { text: 'Cause Action', datafield: 'present_cause_action',editable: false, width: '13%'},
                    { text: 'Filing Date', datafield: 'filing_date',editable: false, width: '13%'},
                    { text: 'Last Activity Date', datafield: 'last_act_date',editable: false, width: '13%'},
                    { text: 'Remarks', datafield: 'remarks',editable: false, width: '13%'},
                    { text: 'Account Closing Status', datafield: 'ac_closing_status',editable: false, width: '13%'},
                    { text: 'District Name', datafield: 'district_name',editable: false, width: '13%'},
                    { text: 'HC Bench', datafield: 'hc_bench_name',editable: false, width: '13%'},
                    { text: 'HC Lawyer', datafield: 'hc_lawyer_name',editable: false, width: '13%'},
                    
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
            
                jQuery("#verify_button").hide();
                jQuery("#verifycancel").hide();
                jQuery("#verify_row").show();
                delete_submit();
            
         });
        
        jQuery("#checker_button").click(function () {
            
                jQuery("#checker_button").hide();
                jQuery("#checkercancel").hide();
                jQuery("#checker_loading").show();
                delete_submit();
            
         });
       
    });

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
           
            jQuery('#s_account').val('');
            jQuery('#s_case_number').val('');
            jQuery('#searchTable').html('');
            
            
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
        url: '<?=base_url()?>index.php/hc_matter/delete_action/',
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
                    jQuery("#verify_button").show();
                    jQuery("#verifycancel").show();
                    jQuery("#verify_loading").hide();
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
    jQuery("#add_button").hide();
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
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var rows = json.row_info;
            console.log(rows);
            //return false;

            jQuery('#power_submit').jqxComboBox('clearSelection');
            jQuery('#power_submit').jqxComboBox('val',(rows.power_submit!=0?rows.power_submit:''));
            jQuery('#hc_dealing_officer').jqxComboBox('clearSelection');
            jQuery('#hc_dealing_officer').jqxComboBox('val',rows.hc_dealing_officer!=0?rows.hc_dealing_officer:'');
            jQuery('#portfolio').jqxComboBox('clearSelection');
            jQuery('#portfolio').jqxComboBox('val',rows.portfolio);
            jQuery('#lower_dealing_officer').jqxComboBox('clearSelection');
            jQuery('#lower_dealing_officer').jqxComboBox('val',rows.lower_dealing_officer!=0?rows.lower_dealing_officer:'');
            jQuery('#case_type').jqxComboBox('clearSelection');
            jQuery('#case_type').jqxComboBox('val',rows.case_type!=0?rows.case_type:'');
            jQuery('#deposited_appeal_money').jqxComboBox('clearSelection');
            jQuery('#deposited_appeal_money').jqxComboBox('val',rows.deposit_am_50!=0?rows.deposit_am_50:'');
            jQuery('#assigned_lawyer').jqxComboBox('clearSelection');
            jQuery('#assigned_lawyer').jqxComboBox('val',rows.assigned_lawyer!=0?rows.assigned_lawyer:'');
            jQuery('#compromised').jqxComboBox('clearSelection');
            jQuery('#compromised').jqxComboBox('val',rows.compromised_trial!=0?rows.compromised_trial:'');
            jQuery('#name_dist').jqxComboBox('clearSelection');
            jQuery('#name_dist').jqxComboBox('val',rows.name_dist!=0?rows.name_dist:'');
            jQuery('#present_status').jqxComboBox('clearSelection');
            jQuery('#present_status').jqxComboBox('val',rows.present_status!=0?rows.present_status:'');
            jQuery('#hc_bench').jqxComboBox('clearSelection');
            jQuery('#hc_bench').jqxComboBox('val',rows.hc_bench!=0?rows.hc_bench:'');
            jQuery('#hc_lawyer').jqxComboBox('clearSelection');
            jQuery('#hc_lawyer').jqxComboBox('val',rows.hc_lawyer!=0?rows.hc_lawyer:'');
            jQuery('#am_withrawn_status').jqxComboBox('clearSelection');
            jQuery('#am_withrawn_status').jqxComboBox('val',rows.am_withdrawn_status!=0?rows.am_withdrawn_status:'');
            jQuery('#ac_closing_status').jqxComboBox('clearSelection');
            jQuery('#ac_closing_status').jqxComboBox('val',rows.ac_closing_status!=0?rows.ac_closing_status:'');
            jQuery("#account_no").val(rows.ac_number);
            jQuery("#account_name").val(rows.ac_name);
            jQuery("#case_no").val(rows.case_no);
            jQuery("#file_receive_date").val(rows.file_receive_date);
            jQuery("#case_claim").val(rows.case_claim);
            jQuery("#filing_date").val(rows.filing_date);
            jQuery("#lcr_reminder").val(rows.lcr_reminder);
            jQuery("#lcr_send").val(rows.lcr_send!=0?rows.lcr_send:'');
            jQuery("#last_act_date").val(rows.last_act_date);
            jQuery("#lcr_send_date").val(rows.lcr_send_date);
            jQuery("#present_casue_action").val(rows.present_cause_action);
            jQuery("#lcr_received").val(rows.lcr_receive!=0?rows.lcr_receive:'');
            jQuery("#lcr_received_date").val(rows.lcr_receive_date);
            jQuery("#remarks").val(rows.remarks);
            jQuery("#withdrawn_date").val(rows.am_withdrawn_date);
            jQuery("#amount_appeal_money").val(rows.amount_am_money!=0?rows.amount_am_money:'');

            //jQuery('#cma_id').val(rows.cma_id);
            //jQuery('#suit_id').val(rows.suit_id);
            jQuery('#edit_row').val(rows.id);
           // jQuery("#expense_type_1").jqxComboBox('val',1);
            //jQuery("#vendor_id_1").jqxComboBox('val',rows.prest_lawyer_name);
            
        }
    });
    jQuery('#jqxTabs').jqxTabs('select', 0);
    
    
}
function clear_form(){
    jQuery('#power_submit').jqxComboBox('clearSelection');
    jQuery('#hc_dealing_officer').jqxComboBox('clearSelection');
    jQuery('#portfolio').jqxComboBox('clearSelection');
    jQuery('#lower_dealing_officer').jqxComboBox('clearSelection');
    jQuery('#case_type').jqxComboBox('clearSelection');
    jQuery('#deposited_appeal_money').jqxComboBox('clearSelection');
    jQuery('#assigned_lawyer').jqxComboBox('clearSelection');
    jQuery('#compromised').jqxComboBox('clearSelection');
    jQuery('#name_dist').jqxComboBox('clearSelection');
    jQuery('#present_status').jqxComboBox('clearSelection');
    jQuery('#hc_bench').jqxComboBox('clearSelection');
    jQuery('#hc_lawyer').jqxComboBox('clearSelection');
    jQuery('#am_withrawn_status').jqxComboBox('clearSelection');
    jQuery('#ac_closing_status').jqxComboBox('clearSelection');
    jQuery("#account_no").val('');
    jQuery("#account_name").val('');
    jQuery("#case_no").val('');
    jQuery("#file_receive_date").val('');
    jQuery("#case_claim").val('');
    jQuery("#filing_date").val('');
    jQuery("#lcr_reminder").val('');
    jQuery("#lcr_send").val('');
    jQuery("#last_act_date").val('');
    jQuery("#lcr_send_date").val('');
    jQuery("#present_casue_action").val('');
    jQuery("#lcr_received").val('');
    jQuery("#lcr_received_date").val('');
    jQuery("#remarks").val('');
    jQuery("#withdrawn_date").val('');
    jQuery("#amount_appeal_money").val('');
    jQuery("#edit_row").val('');
    jQuery("#add_edit").val('add');
    jQuery('#cma_id').val('');
    jQuery('#suit_id').val('');
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
   
    
    if(loan_ac=='' && case_number=='')
    {
        alert('Please provide at least one search parameter!!!');
    }
    else
    {
        jQuery("#grid_loading").show();
        //jQuery("#load").hide();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>index.php/warrant_arrest/search_case/",
            data : {[csrfName]: csrfHash,loan_ac: loan_ac, case_number:case_number},
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
    var checkboxes = document.getElementsByName('suit_id')
    checkboxes.forEach((item) => {
        //console.log(item)
        if (item !== checkbox) item.checked = false
    })
}

function loadsuit(){
    //alert('ddd')
    var checkboxes = document.getElementsByName('suit_id');
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
    jQuery.ajax({
        type: "POST",
        cache: false,
        url: "<?=base_url()?>appeal_bail_money/get_case_info",
        data : {[csrfName]: csrfHash,id:val},
        datatype: "json",
        async:false,
        success: function(response){
           
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
           // var arr=Object.entries(json.row_info);
            //console.log(json.row_info.case_number);
            //val,0,
            
            //var case_number = jQuery('#case_number').val();
            
            var rows = json.row_info;
            //console.log(rows);
            jQuery('#ac_number').val('');
            jQuery('#ac_name').val('');
            if(rows!=null){
                //alert(rows.loan_ac)

                jQuery('#loan_ac_ds').html(rows.loan_ac);
                jQuery('#loan_ac_na').html(rows.ac_name);
                jQuery('#case_num').html(rows.case_number);
                jQuery('#cma_id').val(rows.cma_id);
                jQuery('#req_type').val(rows.req_type);
                jQuery('#cma_district').val(rows.district);
                jQuery('#suit_id').val(rows.id);
                
                jQuery("#vendor_id_1").jqxComboBox('val',rows.prest_lawyer_name);
            }else{
                alert("No Data Found");
            }
        }
    });

}


function load_case(row_info){
    
    //var case_number = jQuery('#case_number').val();
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

</script>

<div id="container">
    <div id="body">
        <table class="">
            <tr id="widgetsNavigationTree">
                <td valign="top" align="left" class='navigation'>
                    <!---- Left Side Menu Start ------>
                    <?php $this->load->view('hc_matter/pages/left_side_nav'); ?>
                    <!----====== Left Side Menu End==========----->
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
                        <!---==== First Tab Start ==========----->
                        <div style="overflow: hidden;" class="back_image">
                           <!-- <div id="search_area">
                            <form method="POST" name="form" id="form"  style="margin:0px;">
                               <div style="padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                    <table id="deal_body" style="display:block;width:70%">
                                        <tr>
                                            <td style="text-align:right;width:10%"><strong>Case Number&nbsp;&nbsp;</strong> </td>
                                            <td style="width:10%"><input type="text" id="s_case_number" name="s_case_number" style="width:100%" /></td>
                                            <td style="text-align:right;width:5%"><strong>Account&nbsp;&nbsp;</strong> </td>
                                            <td style="width:15%"><input type="text" id="s_account" name="s_account" maxlength="16" style="width:100%" /></td>
                                            <td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" />
                                            </td>
                                        </tr>
                                    </table>
                              </div>
                              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                              <div id="searchTable"></div>
                            </form>
                            </div>
                            <br> -->
                           <div style="padding: 10px;">
                            <form class="form" name="action_form" id="action_form" method="post" action="" enctype="multipart/form-data">
                                <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                <input type="hidden" id="add_edit" value="add" name="add_edit">
                                <input type="hidden" id="edit_row" value="" name="edit_row">
                                <input type="hidden" id="cma_id" value="" name="cma_id">
                                <input type="hidden" id="suit_id" value="" name="suit_id">
                                <input type="hidden" id="hc_type" value="Recase" name="hc_type">
                                <table style="width: 100%;">
                                    
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">AC No<span style="color:red">*</span> </td>
                                        <td width="30%" ><input name="account_no" type="text" class="" style="width:250px" id="account_no" maxlength="16" value="" placeholder="Amount No" /></td>
                                       <td width="20%" style="font-weight: bold;">Power Submit </td>
                                        <td width="30%" ><div id="power_submit" name="power_submit" style="padding-left: 3px"></div></td> 
                                        
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">A/C NAME<span style="color:red">*</span> </td>
                                        <td width="30%" ><input name="account_name" type="text" class="" style="width:250px" id="account_name" value="" placeholder="Account Name" /></td>
                                        <td width="20%" style="font-weight: bold;">High Court Dealing officer </td>
                                        <td width="30%" ><div id="hc_dealing_officer" name="hc_dealing_officer" style="padding-left: 3px"></div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Portfolio<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="portfolio" name="portfolio" style="padding-left: 3px"></div></td>
                                        <td width="20%" style="font-weight: bold;">Lower Court Dealing officer</td>
                                        <td width="30%" ><div id="lower_dealing_officer" name="lower_dealing_officer" style="padding-left: 3px"></div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Case Types<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="case_type" name="case_type" style="padding-left: 3px"></div></td>
                                        <td width="20%" style="font-weight: bold;">50% Deposited Appeal money </td>
                                        <td width="30%" ><div id="deposited_appeal_money" name="deposited_appeal_money" style="padding-left: 3px"></div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">CASE NO<span style="color:red">*</span> </td>
                                        <td width="30%" ><input name="case_no" type="text" class="" style="width:250px" id="case_no" value="" placeholder="Case NO" /></td>
                                        <td width="20%" style="font-weight: bold;">File Receive Date </td>
                                        <td width="30%" ><input name="file_receive_date" type="text" class="" style="width:250px" id="file_receive_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker ("file_receive_date");</script></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Case Claim<span style="color:red">*</span> </td>
                                        <td width="30%" ><input name="case_claim" type="text" class="" style="width:250px" id="case_claim" value="" placeholder="Case Claim" /></td>
                                        <td width="20%" style="font-weight: bold;">Assigned Lawyer</td>
                                        <td width="30%" ><div id="assigned_lawyer" name="assigned_lawyer" style="padding-left: 3px"></div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Filing Date<span style="color:red">*</span> </td>
                                        <td width="30%" ><input name="filing_date" type="text" class="" style="width:250px" id="filing_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker_without_advance ("filing_date");</script></td>
                                        <td width="20%" style="font-weight: bold;">Compromised/Absentia Trial </td>
                                        <td width="30%" ><div id="compromised" name="compromised" style="padding-left: 3px"></div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">NAME OF DIST<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="name_dist" name="name_dist" style="padding-left: 3px"></div></td>
                                        <td width="20%" style="font-weight: bold;">LCR Reminder Send/Receive</td>
                                        <td width="30%" ><input name="lcr_reminder" type="text" class="" style="width:250px" id="lcr_reminder" value="" placeholder="LCR Reminder Send/Receive" /></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">Present Status<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="present_status" name="present_status" style="padding-left: 3px"></div></td>
                                        <td width="20%" style="font-weight: bold;">LCR Send </td>
                                        <td width="30%" ><input name="lcr_send" type="text" class="" style="width:250px" id="lcr_send" value="" placeholder="LCR Send" /></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">LAST ACTIVITIES DATE<span style="color:red">*</span> </td>
                                        <td width="30%" ><input name="last_act_date" type="text" class="" style="width:250px" id="last_act_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker ("last_act_date");</script></td>
                                        <td width="20%" style="font-weight: bold;">LCR Send Date</td>
                                        <td width="30%" ><input name="lcr_send_date" type="text" class="" style="width:250px" id="lcr_send_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker ("lcr_send_date");</script></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">PRESENT CAUSE OF ACTION<span style="color:red">*</span> </td>
                                        <td width="30%" ><textarea name="present_casue_action" type="text" class="" style="width:250px" id="present_casue_action" value="" placeholder="Present Cause Of Action" /></textarea></td>
                                        <td width="20%" style="font-weight: bold;">LCR Received</td>
                                        <td width="30%" ><input name="lcr_received" type="text" class="" style="width:250px" id="lcr_received" value="" placeholder="LCR Received" /></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">NAME OF HIGH COURT BENCH<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="hc_bench" name="hc_bench" style="padding-left: 3px"></div></td>
                                        <td width="20%" style="font-weight: bold;">LCR Received Date </td>
                                        <td width="30%" ><input name="lcr_received_date" type="text" class="" style="width:250px" id="lcr_received_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker ("lcr_received_date");</script></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">NAME OF HIGH COURT LAWYER<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="hc_lawyer" name="hc_lawyer" style="padding-left: 3px"></div></td>
                                        <td width="20%" style="font-weight: bold;">Appeal Money Withdraw Status</td>
                                        <td width="30%" ><div id="am_withrawn_status" name="am_withrawn_status" style="padding-left: 3px"></div></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">REMARKS</td>
                                        <td width="30%" ><textarea name="remarks" type="text" class="" style="width:250px" id="remarks" value="" placeholder="Remarks" /></textarea></td>
                                        <td width="20%" style="font-weight: bold;">Appeal Money Withdraw Date</td>
                                        <td width="30%" ><input name="withdrawn_date" type="text" class="" style="width:250px" id="withdrawn_date" value="" placeholder="dd/mm/yyyy" /><script>datePicker ("withdrawn_date");</script></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="font-weight: bold;">A/C Closing Status<span style="color:red">*</span> </td>
                                        <td width="30%" ><div id="ac_closing_status" name="ac_closing_status" style="padding-left: 3px"></div></td>

                                        <!-- <td width="20%" style="font-weight: bold;">Remarks </td>
                                        <td width="30%" ><input name="deposited_amount" type="text" class="" style="width:250px" id="deposited_amount" value="" placeholder="Deposited Amount" /></td> -->
                                        <td width="20%" style="font-weight: bold;">Amount Of Appeal Money </td>
                                        <td width="30%" ><input name="amount_appeal_money" type="text" class="" style="width:250px" id="amount_appeal_money" value="" placeholder="Amount Of Appeal Money" /></td>
                                    </tr>
                                   


                                    <? if(ADD==1){?>
                                    <tr id="add_button" >
                                        <td colspan="4" style="text-align: center;">
                                            <br/>
                                            <input type="button" value="Save" class="buttonStyle" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 2px solid #000;" id="in_req_button"/> 
                                            <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                            <br/><br/><br/>
                                        </td>
                                    </tr>
                                    <? } ?>
                                    <? if(EDIT==1){?>
                                    <tr id="up_button" style="display: none;">
                                        <td colspan="4" style="text-align: center;">
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
        <div id="verify_row" style="text-align:center;margin-bottom:30px;width:100%;">
                
            <br><br>
            <input type="button" class="buttonSend" id="verify_button" value="Verify">
            <input type="button" class="buttonclose" id="verifycancel" onclick="close()" value="Cancel">
            <span id="verify_loading" style="display:none">Please wait... <img src="<?= base_url()?>images/loader.gif" align="bottom"></span>
            
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
