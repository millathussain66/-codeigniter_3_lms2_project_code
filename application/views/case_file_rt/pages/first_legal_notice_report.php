<style>
    table,
    td {
        padding: 5px;
        margin: 0px;
        border-spacing: 0px;
        border-collapse: collapse;
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

    .buttonSend:hover {
        background-color: #008CBA;
        color: white;
    }

    .navigationTitle {
        -webkit-border-top-right-radius: 4px;
        -webkit-border-top-left-radius: 4px;
        -moz-border-top-right-radius: 4px;
        -moz-border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
        font-family: Verdana, Arial, sans-serif;
        font-style: normal;
        text-shadow: 0 1px 1px #FFFFFF;
        font-size: 12px;
        text-align: left;
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, 0.02)));
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
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
        font-family: Verdana, Arial, sans-serif;
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
        font-family: Verdana, Arial, sans-serif;
        font-style: normal;
        font-size: 12px;
        font-weight: bold;
    }

    .navigationItemContent,
    .navigationItemContentParent {
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

    .navigationItemContent:hover,
    .navigationItemContentParent:hover,
    .navigationItemContentParent:hover,
    .navigationItemContentParent:hover {
        cursor: pointer;
        padding-left: 28px !important;
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, 0.02)));
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background-color: #fdfdfd;
        color: #00a2e8;
        text-shadow: none;
    }

    .navigationItemContentParent:hover,
    .navigationItemContentParent:hover {
        padding-left: 22px !important;
    }

    .navigationItemContentParentExpanded:hover,
    .navigationItemContentParentExpanded:hover {
        padding-left: 18px !important;
    }

    .navigationItemContent a:link,
    .navigationItemContentParent a:link {
        font-family: Verdana, Arial, sans-serif;
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
    }

    .navigationItemContent a:visited,
    .navigationItemContentParent a:visited {
        font-size: 12px;
        margin-left: 3px;
        color: inherit;
        text-decoration: none;
    }

    .navigationItemContent a:hover,
    .navigationItemContentParent a:hover {
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
        -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
        -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
        padding: 0px;
        border-color: transparent;
        border-color: rgba(233, 233, 233, 1);
        background: transparent;
        background: rgba(255, 255, 255, 1);
        background: transparent\9;
        *background: transparent;
        *border-color: transparent;
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
        -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
        -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
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
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, 0.02)));
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background-color: #fdfdfd;
    }

    .topNavigation-item,
    .demoLink {
        font-family: Verdana, Arial, sans-serif;
        font-style: normal;
        text-align: left;
        vertical-align: middle;
        margin-left: 10px;
        margin-right: 10px;
        font-size: 12px;
        padding: 12px 10px 12px 5px;
        text-shadow: 0 1px 0 #FFFFFF;
    }

    .topNavigation-item a,
    .demoLink {
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

    .topNavigation-item a:hover,
    .demoLink:hover {
        color: #00a2e8;
        text-shadow: none;
    }

    .demoLink {
        float: none;
        margin: 0px;
        padding: 0px;
    }

    .topNavigation-item img {}


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
        font-family: Verdana, Arial, sans-serif;
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
        font-family: Verdana, Arial, sans-serif;
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
        background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, 0.02)));
        background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.02) 100%);
        background-color: #fdfdfd;
        -moz-box-shadow: inset 1px -1px 0 #fff, 0 2px 2px rgba(0, 0, 0, 0.05);
        -webkit-box-shadow: inset 1px -1px 0 #fff, 0 2px 2px rgba(0, 0, 0, 0.05);
        box-shadow: inset 1px -1px 0 #fff, 0 2px 2px rgba(0, 0, 0, 0.05);
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
        font-family: Verdana, Arial, Helvetica, sans-serif;
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
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        line-height: 16px;
        width: 100%;
    }

    . .navigatorOuterTable {
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

    .navigatorInnerTable,
    .navigatorTable {
        width: 100%;
        table-layout: fixed;
        margin: 0px;
        border-collapse: collapse;
        padding: 0px;
        border: none;
    }

    #loading-overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        display: none;
        align-items: center;
        background-color: #000;
        z-index: 999;
        opacity: 0.5;
    }

    .loading-icon {
        position: absolute;
        border-top: 2px solid #fff;
        border-right: 2px solid #fff;
        border-bottom: 2px solid #fff;
        border-left: 2px solid #767676;
        border-radius: 25px;
        width: 25px;
        height: 25px;
        margin: 0 auto;
        position: absolute;
        left: 50%;
        margin-left: -20px;
        top: 50%;
        margin-top: -20px;
        z-index: 4;
        -webkit-animation: spin 1s linear infinite;
        -moz-animation: spin 1s linear infinite;
        animation: spin 1s linear infinite;
    }

    @-moz-keyframes spin {
        100% {
            -moz-transform: rotate(360deg);
        }
    }

    @-webkit-keyframes spin {
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    #active {
        background-color: #e7e7e7 !important;
    }

    .back_image {
        background-image: url(<?= base_url() ?>images/login_images/back_1.jpg);
        background-repeat: no-repeat;
        background-color: transparent;
        background-size: auto;
        _background-size: 1108px 763px;
        background-position: -18px 89%;
    }

    .addmore {
        background-image: url(<?= base_url() ?>images/addmore_grn.png);
        /*background-size: 20px 20px;*/
        background-repeat: no-repeat;
        border: 0;
        width: 18px;
        height: 18px;
        background-color: transparent;
        cursor: pointer;
    }

    #back_area {
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }

    #report_generate:hover {
        background: #29cdff !important;
    }
</style>
<!-- For Case File Report -->
<?php if ($operation == 'first_legal_notice_report') : ?>
    <?php
    $report_category_segment = array();
    $report_category_segment['1'] = 'Region Wise';
    $report_category_segment['5'] = 'District Wise';
    $report_category_segment['6'] = 'Territory Wise';

    $report_category = array();

    $report_category['1'] = 'Region Wise (Multi)';
    $report_category['2'] = 'Dealing Officer Wise';
    $report_category['3'] = 'Year Wise';


    $reporting_period = array();

    $reporting_period['1'] = 'Monthly';
    $reporting_period['2'] = 'Quarterly';
    $reporting_period['3'] = 'Half-Yearly';
    $reporting_period['4'] = 'Yearly';
    $reporting_period['5'] = 'Year Vs Year';
    $reporting_period['6'] = 'Region Vs Resion';


    $reporting_time = array();
    $reporting_time['1'] = 'From-To Date';
    $reporting_time['2'] = 'Year To Year';



    $present_status = array();

    $present_status['1'] = 'Legal Notice Sending';
    $present_status['2'] = 'Legal Notice Pending';




    ?>
    <script type="text/javascript">
        var theme = getDemoTheme();


        var report_category_segment = [<? $i = 1;
                                        foreach ($report_category_segment as $key => $row) {
                                            if ($i != 1) {
                                                echo ',';
                                            }
                                            echo '{value:"' . $key . '", label:"' . $row . '"}';
                                            $i++;
                                        } ?>];


        var report_category = [<? $i = 1;
                                foreach ($report_category as $key => $row) {
                                    if ($i != 1) {
                                        echo ',';
                                    }
                                    echo '{value:"' . $key . '", label:"' . $row . '"}';
                                    $i++;
                                } ?>];

        var reporting_period = [<? $i = 1;
                                foreach ($reporting_period as $key => $row) {
                                    if ($i != 1) {
                                        echo ',';
                                    }
                                    echo '{value:"' . $key . '", label:"' . $row . '"}';
                                    $i++;
                                } ?>];

        var reporting_time = [<? $i = 1;
                                foreach ($reporting_time as $key => $row) {
                                    if ($i != 1) {
                                        echo ',';
                                    }
                                    echo '{value:"' . $key . '", label:"' . $row . '"}';
                                    $i++;
                                } ?>];

        var present_status = [<? $i = 1;
                                foreach ($present_status as $key => $row) {
                                    if ($i != 1) {
                                        echo ',';
                                    }
                                    echo '{value:"' . $key . '", label:"' . $row . '"}';
                                    $i++;
                                } ?>];





        var start = 1990;
        let date = new Date().getFullYear();
        var year = [];
        for (var i = date; i >= start; i--) {
            year.push({
                value: i,
                label: i
            });
        }
        jQuery(document).ready(function() {
            jQuery("#from_year").jqxDropDownList({
                theme: theme,
                autoDropDownHeight: false,
                dropDownHeight: 100,
                promptText: "From",
                source: year,
                width: 65,
                height: 25
            });
            jQuery("#to_year").jqxDropDownList({
                theme: theme,
                autoDropDownHeight: false,
                dropDownHeight: 100,
                promptText: "To",
                source: year,
                width: 65,
                height: 25
            });


            jQuery("#from_year_cat").jqxDropDownList({
                theme: theme,
                autoDropDownHeight: false,
                dropDownHeight: 100,
                promptText: "From",
                source: year,
                width: 65,
                height: 25
            });
            jQuery("#to_year_cat").jqxDropDownList({
                theme: theme,
                autoDropDownHeight: false,
                dropDownHeight: 100,
                promptText: "To",
                source: year,
                width: 65,
                height: 25
            });

            jQuery("#report_category_segment").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Report Segment",
                source: report_category_segment,
                width: 150,
                height: 25
            });
            jQuery("#report_category").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Report Catagory",
                source: report_category,
                width: 150,
                height: 25
            });
            jQuery("#reporting_time").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Reporting Time",
                source: reporting_time,
                width: 150,
                height: 25
            });


            jQuery("#reporting_period").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Reporting Period",
                source: reporting_period,
                width: 150,
                height: 25
            });



            jQuery("#present_status").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Present Status",
                source: present_status,
                width: 150,
                height: 25
            });

            jQuery('#report_category_segment').bind('change', function(event) {
                change_report_category_sagment_dropdown();
            });

            jQuery('#report_category').bind('change', function(event) {
                change_report_category_dropdown();
            });
        });



        function change_report_category_dropdown() {

            var id = '';
            var table_name = '';
            var item = jQuery("#report_category").jqxComboBox('getSelectedItem');


            if (item.value == 3) {
                jQuery("#from_year_cat").show();
                jQuery("#to_year_cat").show();
            }


            if (item != null) {
                if (item.value == 1) {
                    table_name = 'ref_loan_segment';
                    jQuery("#from_year_cat").hide();
                    jQuery("#to_year_cat").hide();
                } else if (item.value == 2) {
                    table_name = 'users_info';
                    jQuery("#from_year_cat").hide();
                    jQuery("#to_year_cat").hide();
                } else {
                    jQuery("#report_category_dropdown").hide();
                    jQuery("#report_category_dropdown_multi").hide();
                    return;
                }
            } else {
                jQuery("#report_category_dropdown").hide();
                jQuery("#report_category_dropdown_multi").hide();
                return;
            }



            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                url: '<?php echo base_url(); ?>index.php/user_info/get_report_dropdown_data',
                async: false,
                type: "post",
                data: {
                    [csrfName]: csrfHash,
                    table_name: table_name
                },
                datatype: "json",
                success: function(response) {
                    var json = jQuery.parseJSON(response);

                    var csrf_tokena = json.csrf_token;
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str = '';
                    var theme = getDemoTheme();
                    var drop_down_data = [];

                    if (table_name == 'users_info') {
                        jQuery.each(json['row_info'], function(key, obj) {
                            drop_down_data.push({
                                value: obj.id,
                                label: obj.name + '(' + obj.pin + ')'
                            });
                        });
                    } else if (table_name == 'ref_loan_segment') {
                        jQuery.each(json['row_info'], function(key, obj) {
                            drop_down_data.push({
                                value: obj.code,
                                label: obj.name
                            });
                        });
                    } else {
                        jQuery.each(json['row_info'], function(key, obj) {
                            drop_down_data.push({
                                value: obj.id,
                                label: obj.name
                            });
                        });
                    }
                    if (item.value == 2) {
                        jQuery("#report_category_dropdown_multi").jqxDropDownList({
                            theme: theme,
                            checkboxes: true,
                            autoDropDownHeight: false,
                            promptText: "Select",
                            filterable: true,
                            searchMode: 'containsignorecase',
                            source: drop_down_data,
                            width: 150,
                            height: 25
                        });
                        jQuery("#report_category_dropdown_multi").show();
                        jQuery("#report_category_dropdown").hide();
                    } else {
                        jQuery("#report_category_dropdown").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select",
                            source: drop_down_data,
                            width: 150,
                            height: 25
                        });
                        jQuery("#report_category_dropdown").show();
                        jQuery("#report_category_dropdown_multi").hide();
                    }


                },
                error: function(model, xhr, options) {
                    alert('failed');
                    jQuery("#report_category_dropdown").hide();
                    jQuery("#report_category_dropdown_multi").hide();
                },
            });
            return false;
        }



        function change_report_category_sagment_dropdown() {
            var id = '';
            var table_name = '';
            var item = jQuery("#report_category_segment").jqxComboBox('getSelectedItem');
            if (item != null) {
                if (item.value == 1) {
                    table_name = 'ref_legal_region';
                } else if (item.value == 2) {
                    table_name = 'ref_legal_region';
                } else if (item.value == 3) {
                    table_name = 'ref_loan_segment';
                } else if (item.value == 4) {
                    table_name = 'users_info';
                } else if (item.value == 5) {
                    table_name = 'ref_legal_district';
                } else if (item.value == 6) {
                    table_name = 'ref_territory';
                } else {
                    jQuery("#report_category_segment_dropdown").hide();
                    jQuery("#report_category_sefment_dropdown_multi").hide();
                    return;
                }

            } else {
                jQuery("#report_category_segment_dropdown").hide();
                jQuery("#report_category_sefment_dropdown_multi").hide();
                return;
            }

            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                url: '<?php echo base_url(); ?>index.php/user_info/get_report_dropdown_data',
                async: false,
                type: "post",
                data: {
                    [csrfName]: csrfHash,
                    table_name: table_name
                },
                datatype: "json",
                success: function(response) {
                    var json = jQuery.parseJSON(response);
                    //console.log(json['row_info']);
                    var csrf_tokena = json.csrf_token;
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str = '';
                    var theme = getDemoTheme();
                    var drop_down_data = [];
                    if (table_name == 'users_info') {
                        jQuery.each(json['row_info'], function(key, obj) {
                            drop_down_data.push({
                                value: obj.id,
                                label: obj.name + '(' + obj.pin + ')'
                            });
                        });
                    } else if (table_name == 'ref_loan_segment') {
                        jQuery.each(json['row_info'], function(key, obj) {
                            drop_down_data.push({
                                value: obj.code,
                                label: obj.name
                            });
                        });
                    } else {
                        jQuery.each(json['row_info'], function(key, obj) {
                            drop_down_data.push({
                                value: obj.id,
                                label: obj.name
                            });
                        });
                    }
                    if (item.value == 2) {
                        jQuery("#report_category_sefment_dropdown_multi").jqxDropDownList({
                            theme: theme,
                            checkboxes: true,
                            autoDropDownHeight: false,
                            promptText: "Select",
                            filterable: true,
                            searchMode: 'containsignorecase',
                            source: drop_down_data,
                            width: 150,
                            height: 25
                        });
                        jQuery("#report_category_sefment_dropdown_multi").show();
                        jQuery("#report_category_segment_dropdown").hide();
                    } else {
                        jQuery("#report_category_segment_dropdown").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select",
                            source: drop_down_data,
                            width: 150,
                            height: 25
                        });
                        jQuery("#report_category_segment_dropdown").show();
                        jQuery("#report_category_sefment_dropdown_multi").hide();
                    }


                },
                error: function(model, xhr, options) {
                    alert('failed');
                    jQuery("#report_category_segment_dropdown").hide();
                    jQuery("#report_category_sefment_dropdown_multi").hide();
                },
            });

            return false;
        }

        function search_data() {
            var postdata = jQuery('#first_legal_notice_report_form').serialize();
            jQuery("#report_result").html('');
            jQuery("#report_generate").hide();
            jQuery("#grid_loading").show();

            jQuery.ajax({
                url: '<?php echo base_url(); ?>index.php/case_file_rt/get_first_legal_notice_result',
                async: false,
                type: "post",
                data: postdata,
                datatype: "json",
                success: function(response) {
                    jQuery("#report_generate").show();
                    jQuery("#grid_loading").hide();
                    var json = jQuery.parseJSON(response);
                    var csrf_tokena = json.csrf_token;
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    jQuery("#report_result").append(json.str);
                    var total_row = json.str;
                    var rowCount = jQuery('#facility_table>tbody >tr').length;
                    if (rowCount > 1) {
                        jQuery('#xl_button_row').show();
                    } else {
                        jQuery('#xl_button_row').hide();

                    }
                },
                error: function(model, xhr, options) {
                    alert('failed');
                    jQuery("#report_generate").show();
                    jQuery("#grid_loading").hide();
                    jQuery("#report_result").append('');
                },
            });
        }

        function set_report_time_dropdown() {
            var id = '';
            var table_name = '';
            var item = jQuery("#reporting_time").jqxComboBox('getSelectedItem');
            if (item != null) {
                if (item.value == 2) {
                    jQuery("#from_year").show();
                    jQuery("#to_year").show();
                    jQuery("#filling_dt_from").hide();
                    jQuery("#filling_dt_to").hide();
                } else if (item.value == 1) {
                    jQuery("#filling_dt_from").show();
                    jQuery("#filling_dt_to").show();
                    jQuery("#from_year").hide();
                    jQuery("#to_year").hide();
                } else {
                    jQuery("#filling_dt_from").hide();
                    jQuery("#filling_dt_to").hide();
                    jQuery("#from_year").hide();
                    jQuery("#to_year").hide();
                    return;
                }

            } else {
                jQuery("#from_year").hide();
                jQuery("#filling_dt_from").hide();
                jQuery("#filling_dt_to").hide();
                jQuery("#to_year").hide();
                return;
            }
        }
    </script>
    <div id="container">
        <div id="body">
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('case_file_rt/pages/left_side_nav', $operation); ?>
                        <!----====== Left Side Menu End==========----->

                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                            <div id="loding"></div>
                        </div>
                        <div>
                            <div style="overflow: hidden;">
                                <div style="padding: 10px;" class="back_image">
                                    <form class="form" name="first_legal_notice_report_form" id="first_legal_notice_report_form" method="post" action="<?= base_url() ?>Case_file_rt/first_legal_notice_report_xl" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <table style="width:100%;" id="tab1Table">
                                            <tbody>
                                                <tr>


                                                    <td style="vertical-align: top;">
                                                        <div style="float:left" id="report_category_segment" name="report_category_segment" style="padding-left: 3px"></div><br>
                                                        <div style="float:left;display:none" id="report_category_segment_dropdown" name="report_category_segment_dropdown" style="padding-left: 3px"></div>
                                                        <div style="float:left;display:none" id="report_category_sefment_dropdown_multi" name="report_category_sefment_dropdown_multi" style="padding-left: 3px"></div>
                                                    </td>

                                                    <td style="vertical-align: top;">
                                                        <div style="float:left" id="report_category" name="report_category" style="padding-left: 3px"></div><br>
                                                        <div style="float:left;display:none" id="report_category_dropdown" name="report_category_dropdown" style="padding-left: 3px"></div>
                                                        <div style="float:left;display:none" id="report_category_dropdown_multi" name="report_category_dropdown_multi" style="padding-left: 3px"></div>

                                                        <div style="float:left;display:none;" id="from_year_cat" name="from_year_cat" style="padding-left: 3px"></div>
                                                        <div style="margin-left: 15px;float:left;display:none;" id="to_year_cat" name="to_year_cat" style="padding-left: 3px"></div>

                                                    </td>


                                                    <td style="vertical-align: top;">
                                                        <div style="float:left" id="reporting_period" name="reporting_period" style="padding-left: 3px"></div>
                                                    </td>



                                                    <td style="vertical-align: top;">
                                                        <div style="float:left" id="reporting_time" onchange="set_report_time_dropdown()" name="reporting_time" style="padding-left: 3px"></div><br>
                                                        <div style="float:left;display: none;" id="from_year" name="from_year" style="padding-left: 3px"></div>
                                                        <div style="margin-left: 15px;float:left;display: none;" id="to_year" name="to_year" style="padding-left: 3px"></div>
                                                        <input type="text" name="filling_dt_from" placeholder="From Date" style="display: none;width:65px;" id="filling_dt_from" value="">
                                                        <script type="text/javascript" charset="utf-8">
                                                            datePicker("filling_dt_from");
                                                        </script>
                                                        <input type="text" name="filling_dt_to" placeholder="To Date" style="display: none;width:71px;" id="filling_dt_to" value="">
                                                        <script type="text/javascript" charset="utf-8">
                                                            datePicker("filling_dt_to");
                                                        </script>
                                                    </td>




                                                    <td style="vertical-align: top;">
                                                        <div style="float:left" id="present_status" name="present_status" style="padding-left: 3px"></div>
                                                    </td>



                                                    <td style="vertical-align: top;">
                                                        <input type='button' class="buttonStyle" id='report_generate' name='report_generate' value='Generate Report' onclick="search_data()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:140px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" />
                                                        <span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                                    </td>
                                                    <td style="vertical-align: top; display:none;" id="xl_button_row">
                                                        <button type="submit" formtarget="_blank" name="xlsts" title="Report"><img width="27px" style="cursor: pointer;" align="center" src="<?= base_url() ?>images/xl_logo_.png"></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                    <div id="report_result" style="width:1100px;height:380px;overflow:auto;">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

<?php endif ?>