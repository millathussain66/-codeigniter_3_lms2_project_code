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

    #active {
        background: #93CDDD !important;
        font-weight: bold;
    }
</style>
<style type="text/css">
    .button {
        background-color: #4CAF50;
        /* Green */
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

    .button6 {
        background-color: #555555;
        /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        ;
        border-radius: 12px;
    }

    .button1 {
        background-color: #555555;
        /* Green */
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        ;
        border-radius: 12px;
    }

    .button_delete {
        background-color: #00ffff;
        /* Green */
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

    .button3 {
        background-color: #4CAF50;
        color: black;
    }

    table {
        border-collapse: collapse;
    }

    table#preview_table td {
        border: 1px solid #c7c7c7;
    }

    table.preview_table2 td,
    table.preview_table2 th {
        border: 1px solid #c7c7c7;
        word-wrap: break-word;
        padding: 5px;
    }

    .button4 {
        background-color: #00ffff;
        color: black;
    }

    .button3,
    .button4:hover {
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
    .text-input {
        height: 23px;
        width: 350px;
    }


    .required {
        vertical-align: baseline;
        color: red;
        font-size: 10px;
    }

    #details {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    b {
        font-size: 14px;
    }


    #details td,
    #details th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #details th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #4CAF50;
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
    }

    #gurantor_table td {
        border: 1px solid rgba(0, 0, 0, .20);
    }

    .back_image {
        background-image: url(<?= base_url() ?>images/login_images/back_1.jpg);
        background-repeat: no-repeat;
        background-color: transparent;
        background-size: auto;
        _background-size: 1108px 763px;
        background-position: -18px 104%;
    }

    #search_area {
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }

    #back_area {
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }

    #grid_search:hover {
        background: #29cdff !important;
    }

    #back:hover {
        background: #29cdff !important;
    }

    .jqx-tabs-header {
        border-color: #93CDDD !important;
        background: #93CDDD !important;
    }


    
    /* for search Button */
    .search {
        width: 96%;
        position: relative;
        display: flex;
    }

    .searchTerm {
        width: 100%;
        border: 3px solid #00B4CC;
        border-right: none;
        padding: 5px;
        height: 2rem;
        outline: none;
        color: #9DBFAF;

    }

    .searchTerm:focus {
        color: #00B4CC;
    }

    .searchButton {
        width: 111px;
        height: 36px;
        border: 1px solid #00B4CC;
        background: #00B4CC;
        text-align: center;
        color: #fff;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        font-size: 20px;
        margin-left: 1rem;
    }

    .wrap {
   
        padding: 0rem;
/*        width: 69rem;*/
     
    }
    #search_field_input {
    	border-radius: 126px;
        color: #000;
    }

    #jqxTabsTab0 {
        padding: 1rem;
        font-weight: 600;
        font-family: arial;
        border-radius: 1rem;
        border-color: #80808069;
        background: #d1d5d5;
    }

    #jqxTabsTab1 {
        padding: 1rem;
        font-weight: 600;
        font-family: arial;
        border-radius: 1rem;
        border-color: #80808069;


    }

    #xl_search #xl_button_design {
        border: 1px solid #53a0a0;
        padding: 10px;
        border-radius: 8px;
    }

    .searchbutton {
        margin-left: 11px;
        margin-top: 7px;
        background-color: rgb(255, 255, 255);
        color: rgb(0, 0, 0);
        border-radius: 20px !important;
        height: 52px;
        width: 147px;
        font-family: serif;
        border: 2px solid rgb(41, 205, 255);
        padding: 10px;
        font-weight: 500;
        font-size: 24px;
    }

    .search {
        border: 2px solid #53a0a0;
        padding: 9px 17px;
        border-radius: 11px;
    }

    #search_field_input {
        border-radius: 126px;
        color: #808080a8;
        border: 1px solid #53a0a0;
        margin-top: 8px;
        text-align: center;
        font-size: 43px;
        font-weight: 500;
        font-family: serif;
        height: 46px;
    }

</style>

<?php
$region = $this->user_model->get_parameter_data('ref_legal_region', 'name', "data_status = '1'");
$territory = $this->user_model->get_parameter_data('ref_territory', 'name', "data_status = '1'");
$unit_office = $this->user_model->get_parameter_data('ref_unit_office', 'name', "data_status = '1'");
$district = $this->user_model->get_parameter_data('ref_district', 'name', "data_status = '1'");
$loan_segment = $this->user_model->get_parameter_data('ref_loan_segment', 'name', "data_status = '1'");
?>
<script type="text/javascript">
    var theme = getDemoTheme();
    var proposed_type = ["Loan", "Card"];
    var limit = ["100", "500", "1000", "All"];
    var req_type = [<? $i = 1;
                    foreach ($req_type as $row) {
                        if ($i != 1) {
                            echo ',';
                        }
                        echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                        $i++;
                    } ?>];


    jQuery(document).ready(function() {

        
        jQuery("#search_field_input").focus();


        var ww = jQuery(window).width();
        var hh = jQuery(window).height();
        ww = ww - 240;
        hh = hh - 310;
        jQuery("#main_div").width(ww);
        jQuery("#main_div").height(hh);
        var ww2 = jQuery(window).width();
        ww2 = ww2 - 242;
        jQuery("#search_tab_div").width(ww2);
        var region = [<? $i = 1;
                        foreach ($region as $row) {
                            if ($i != 1) {
                                echo ',';
                            }
                            echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                            $i++;
                        } ?>];
        jQuery("#region").jqxComboBox({
            theme: theme,
            promptText: "Select Region",
            source: region,
            width: 150,
            height: 25
        });
        jQuery("#limit").jqxComboBox({
            theme: theme,
            promptText: "Limit",
            source: limit,
            width: 150,
            height: 25
        });
        var territory = [<? $i = 1;
                            foreach ($territory as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
        jQuery("#territory").jqxComboBox({
            theme: theme,
            promptText: "Select territory",
            source: territory,
            width: 150,
            height: 25
        });
        var district = [<? $i = 1;
                        foreach ($district as $row) {
                            if ($i != 1) {
                                echo ',';
                            }
                            echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                            $i++;
                        } ?>];
        jQuery("#district").jqxComboBox({
            theme: theme,
            promptText: "Select district",
            source: district,
            width: 150,
            height: 25
        });
        var unit_office = [<? $i = 1;
                            foreach ($unit_office as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
        jQuery("#unit_office").jqxComboBox({
            theme: theme,
            promptText: "Select unit office",
            source: unit_office,
            width: 150,
            height: 25
        });
        var loan_segment = [<? $i = 1;
                            foreach ($loan_segment as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->code . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
        jQuery("#loan_segment").jqxComboBox({
            theme: theme,
            promptText: "Select loan segment",
            source: loan_segment,
            width: 100,
            height: 25
        });
        jQuery('#region,#loan_segment,#territory,#district,#unit_office').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        jQuery("#limit").jqxComboBox('val', '100');


        jQuery("#req_type").jqxComboBox({
            theme: theme,
            autoOpen: false,
            autoDropDownHeight: false,
            dropDownHeight: 100,
            promptText: "Type Of Case",
            source: req_type,
            width: 150,
            height: 25
        });
        jQuery("#proposed_type").jqxComboBox({
            theme: theme,
            width: 150,
            autoOpen: false,
            autoDropDownHeight: false,
            promptText: "Proposed Type",
            source: proposed_type,
            height: 25
        });
        jQuery('#proposed_type').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
        change_caption();
        jQuery('#proposed_type').bind('change', function(event) {
            jQuery("#loan_ac").val('');
            jQuery("#hidden_loan_ac").val('');
            change_caption();
        });


        // Jqx tab second tab function start    Grid Show
        var initWidgets = function(tab) {
            switch (tab) {
                case 0:

                    break;
                case 1:
                    //initGrid();
                    break;
            }
        }
        jQuery('#jqxTabs').jqxTabs({
            width: '99%',
            initTabContent: initWidgets
        });
        jQuery('#jqxTabs').bind('selected', function(event) {
            clear_form();
        });
        jQuery('#jqxTabs').jqxTabs('select', 1);
        <? if (VIEW != 1) { ?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
        <? } ?>
        var win_h = jQuery(window).height() - 345;
        <?php if ($this->session->userdata['ast_user']['user_department_id'] == '2') { ?>
            jQuery("#loan_segment").jqxComboBox('val', 'S');
            jQuery('#loan_segment').jqxComboBox({
                disabled: true
            });
        <? } else if ($this->session->userdata['ast_user']['user_department_id'] == '3') { ?>
            jQuery("#loan_segment").jqxComboBox('val', 'R');
            jQuery('#loan_segment').jqxComboBox({
                disabled: true
            });
        <? } else if ($this->session->userdata['ast_user']['user_department_id'] == '7') { ?>
            jQuery("#loan_segment").jqxComboBox('val', 'C');
            jQuery('#loan_segment').jqxComboBox({
                disabled: true
            });
        <? } else if ($this->session->userdata['ast_user']['user_department_id'] == '6') { ?>
            jQuery("#loan_segment").jqxComboBox('val', 'S');
            jQuery('#loan_segment').jqxComboBox({
                disabled: true
            });
        <? } ?>
        searchsuit();



        jQuery("#show_search_field_btn_show").click(function(){
            jQuery(".search_table_row").show();
            jQuery("#show_search_field_btn_show").hide();
            jQuery("#show_search_field_btn_hide").show();

            var ww = jQuery(window).width();
            var hh = jQuery(window).height();
            ww = ww - 220;
            hh = hh - 420;
            jQuery("#main_div").width(ww);
            jQuery("#main_div").height(hh);

        });

        jQuery("#show_search_field_btn_hide").click(function(){
            jQuery(".search_table_row").hide();
            jQuery("#show_search_field_btn_hide").hide();
            jQuery("#show_search_field_btn_show").show();

            var ww = jQuery(window).width();
            var hh = jQuery(window).height();
            ww = ww - 240;
            hh = hh - 330;
            jQuery("#main_div").width(ww);
            jQuery("#main_div").height(hh);

        });
    });

    function searchsuit() // customer search 
    {
        var loan_ac = jQuery('#loan_ac').val();
        var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
        var proposed_type = jQuery('#proposed_type').val();
        if (item != null && loan_ac == '') {
            alert('please provide Loan/Card Number');
            jQuery('#loan_ac').focuse();
            return false;
        } else if (item == null && loan_ac != '') {
            alert('please select proposed type');
            jQuery("#proposed_type input").focus();
            return false;
        } else {
            jQuery("#grid_loading").show();
            jQuery("#grid_search").hide();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            var postData = jQuery('#form').serialize() + "&" + csrfName + "=" + csrfHash;
            jQuery.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: "<?= base_url() ?>index.php/case_details_ho/get_case_details_result/",
                data: postData,
                datatype: "html",
                success: function(response) {
                    var data = response.split("####");
                    jQuery('.txt_csrfname').val(data[1]);
                    jQuery("#grid_loading").hide();
                    jQuery("#grid_search").show();
                    jQuery('#list_body').html(data[0]);
                }
            });
        }
    }

    function details(id) {
        var val = id;
        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?= base_url() ?>case_details_ho/get_case_details_info",
            data: {
                [csrfName]: csrfHash,
                id: val
            },
            datatype: "json",
            async: false,
            success: function(response) {

                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if (json.Message == 'ok') {
                    jQuery('#jqxTabs').jqxTabs('select', 0);
                    jQuery('#details_view').html(json.str);
                } else {
                    alert("No Data Found");
                    jQuery('#details_view').html('');
                }
            }
        });

    }

    function clear_form() {
        jQuery('#details_view').html('');
    }

    function mask(str, textbox) {
        var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
        if (item != null) {
            if (item.value == 'Card') {
                if (!str.includes("*") && str.length == 16) //For one time value paste
                {
                    var length = str.length;
                    var first_6 = str.slice(0, 6);
                    var mid = '******';
                    var last_6 = str.slice(12, 16);
                    var final_str = first_6 + mid + last_6;
                    textbox.value = final_str
                    jQuery("#hidden_loan_ac").val(str);
                } else //For single value enter
                {
                    //For New value
                    var orginal_loan_ac = jQuery("#hidden_loan_ac").val();
                    if (orginal_loan_ac.length < str.length) {
                        var index = str.length - 1;
                        var new_val = str.slice(index);
                        orginal_loan_ac += new_val;
                        //alert(orginal_loan_ac);
                        jQuery("#hidden_loan_ac").val(orginal_loan_ac);
                    }
                    //For delete key
                    else {
                        var len = str.length;
                        var new_val = orginal_loan_ac.slice(0, len);
                        jQuery("#hidden_loan_ac").val(new_val);
                    }
                    //For First 6 key
                    if (str.length <= 6) {
                        textbox.value = str
                    }
                    //for the last 4 key
                    else if (str.length >= 13) {
                        textbox.value = str
                    }
                    //For the middle 4 key
                    else {
                        var length = str.length;
                        var first_6 = str.slice(0, 6);
                        var mid = (str.length - 6);
                        var final_str = first_6;
                        for (var i = 1; i <= mid; i++) {
                            final_str += '*';
                        }
                        textbox.value = final_str
                    }

                    if (str.length == 16) //wrong input check
                    {
                        var letter_Count = 0;
                        var letter = '*';
                        for (var position = 0; position < str.length; position++) {
                            if (str.charAt(position) == letter) {
                                letter_Count += 1;
                            }
                        }
                        if (letter_Count < 6 || jQuery("#hidden_loan_ac").val().length != 16) {
                            textbox.value = '';
                            jQuery("#hidden_loan_ac").val('');
                            alert('Wrong way to input Card No please try again');
                        }
                    }
                }
            }
        }

    }

    function change_caption() {
        if (jQuery("#proposed_type").val() == '') {
            document.getElementById("loan_ac").disabled = true;
            jQuery("#l_or_c_no").html('');
        } else {
            document.getElementById("loan_ac").disabled = false;
            var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
            if (item.value == 'Loan') {
                jQuery("#l_or_c_no").html('Loan ');
            } else if (item.value == 'Card') {
                jQuery("#l_or_c_no").html('Card');
            }
        }

    }

    function change_dropdown(operation, edit = null) {
        var id = '';
        //check for add Region action
        if (edit == null) {
            id = jQuery("#" + operation).val();
        } else {
            id = edit;
        }
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            url: '<?php echo base_url(); ?>index.php/user_info/get_dropdown_data',
            async: false,
            type: "post",
            data: {
                [csrfName]: csrfHash,
                id: id,
                operation: operation
            },
            datatype: "json",
            success: function(response) {
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                var str = '';
                var theme = getDemoTheme();
                if (operation == 'region') {
                    //alert('str');
                    var territory = [];
                    jQuery.each(json['row_info'], function(key, obj) {
                        territory.push({
                            value: obj.id,
                            label: obj.name
                        });
                        //alert(obj.name);
                    });
                    jQuery("#territory").jqxComboBox({
                        theme: theme,
                        autoDropDownHeight: false,
                        promptText: "Select territory",
                        source: territory,
                        width: 150,
                        height: 25
                    });
                    //For edit action
                    if (edit != null) {
                        //alert('success');
                        jQuery("#territory").jqxComboBox('val', '<?= (isset($result->territory) && $result->territory != 0) ? $result->territory : '' ?>');
                    }
                }
                if (operation == 'territory') {
                    var district = [];
                    jQuery.each(json['row_info'], function(key, obj) {
                        district.push({
                            value: obj.id,
                            label: obj.name
                        });
                    });
                    jQuery("#district").jqxComboBox({
                        theme: theme,
                        autoDropDownHeight: false,
                        promptText: "Select District",
                        source: district,
                        width: 150,
                        height: 25
                    });
                    //For edit action
                    if (edit != null) {
                        jQuery("#district").jqxComboBox('val', '<?= (isset($result->district) && $result->district != 0) ? $result->district : '' ?>');
                    }
                }
                if (operation == 'district') {
                    var unit_office = [];
                    jQuery.each(json['row_info'], function(key, obj) {
                        unit_office.push({
                            value: obj.id,
                            label: obj.name
                        });
                    });
                    jQuery("#unit_office").jqxComboBox({
                        theme: theme,
                        autoDropDownHeight: false,
                        promptText: "Select Unit Office",
                        source: unit_office,
                        width: 150,
                        height: 25
                    });
                    //For edit action
                    if (edit != null) {
                        jQuery("#unit_office").jqxComboBox('val', '<?= (isset($result->unit_office) && $result->unit_office != 0) ? $result->unit_office : '' ?>');
                    }
                }

            },
            error: function(model, xhr, options) {
                alert('failed');
            },
        });

        return false;
    }

</script>
<div id="container">
    <div id="body">
        <table class="">
            <tr id="widgetsNavigationTree">
                <td valign="top" align="left" class='navigation'>
                    <!---- Left Side Menu Start ------>
                    <?php $this->load->view('case_details_ho/pages/left_side_nav'); ?>
                    <!----====== Left Side Menu End==========----->

                </td>
                <td valign="top" id="demos" class='rc-all content'>
                    <div id="preloader">
                        <div id="loding"></div>
                    </div>
                    <div>
                        <div id='jqxTabs'>
                            <ul>

                                <li style="margin-left: 30px;">Details Form</li>
                                <li>Account Wise Case Details</li>
                            </ul>
                            <!---==== First Tab Start ==========----->
                            <div style="overflow: hidden;" class="back_image">
                                <div style="padding: 10px;">
                                    <div id="suit_form_div" style="">
                                        <div id="suit_form_area">
                                            <span id="details_view"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!---==== Second Tab Start ==========----->
                            <div style="overflow: hidden;" class="back_image">
                                <div id="search_area">
                                    <form method="POST" name="form" id="form" style="margin:0px;" action="<?php echo base_url('legal_file_process/make_xl'); ?>">
                                        <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                                        <div style="padding: 6px;width:100%;border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                            <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />


                                            <div class="wrap" id="search_tab_div">
                                                <div class="search">
                                                    <table>
                                                        <tr>
                                                            <td style="text-align:right;width:9%"><strong>LIMIT</strong></td>
                                                            <td style="width:15%">
                                                                <div style="padding-left:1.8%" id="limit" name="limit"></div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <input  type="text" class="searchTerm" name="search_field_input" id="search_field_input" placeholder="Search" autofocus>
                                                    <input type='button' class="searchbutton" id='grid_search' name='grid_search' value='Search' onclick="searchsuit()"/>
                                                    <span id="grid_loading" style="display:none"><img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                                    <button type='submit' formtarget="_blank" name='xl_search' id="xl_search" value='Search' style="width:58px;border: none;background: transparent"><img id="xl_button_design" src="<?= base_url() ?>images/icon_xls.gif" width="20px" height="20px"></button>
                                                    <button type='button' id="show_search_field_btn_show" style="width:32px;border: none;background: transparent;cursor:pointer"><img src="<?= base_url() ?>images/add_plus.png" width="33px" height="33px"></button>
                                                    <button type='button' id="show_search_field_btn_hide" style="display:none;width:32px;border: none;background: transparent;cursor:pointer"><img src="<?= base_url() ?>images/minus.png" width="33px" height="33px"></button>
                                                 </div>
                                            </div>



                                            <table id="deal_body" class="search_table_row" style="display:none;width:90%">
                                                <tr>
                                                    <td style="text-align:right;width:10%"><strong>Case Type</strong> </td>
                                                    <td style="width:5%">
                                                        <div style="padding-left:1.8%" id="req_type" name="req_type"></div>
                                                    </td>

                                                    <td style="text-align:right;width:10%"><strong>Propsed Type</strong> </td>
                                                    <td style="width:5%">
                                                        <div style="padding-left:1.8%" id="proposed_type" name="proposed_type"></div>
                                                    </td>

                                                    <td style="text-align:right;width:9%"><strong><span id="l_or_c_no"></span> No.</strong></td>
                                                    <td style="width:15%"><input name="loan_ac" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac" value="" onKeyUp="javascript:return mask(this.value,this);" /></td>

                                                    <td style="text-align:right;width:10%"><strong>CIF</strong> </td>
                                                    <td style="width:5%"><input name="cif" tabindex="" type="text" class="" style="width:150px" id="cif" value="" /></td>


                   
                                                
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right;width:10%"><strong>Region</strong> </td>
                                                    <td style="width:5%">
                                                        <div style="padding-left:1.8%" id="region" name="region"></div>
                                                    </td>

                                                    <td style="text-align:right;width:10%"><strong>Territory</strong> </td>
                                                    <td style="width:5%">
                                                        <div style="padding-left:1.8%" id="territory" name="territory"></div>
                                                    </td>

                                                    <td style="text-align:right;width:9%"><strong>District</strong> </td>
                                                    <td style="width:15%">
                                                        <div style="padding-left:1.8%" id="district" name="district"></div>
                                                    </td>

                                                    <td style="text-align:right;width:10%"><strong>Unit</strong> </td>
                                                    <td style="width:5%">
                                                        <div style="padding-left:1.8%" id="unit_office" name="unit_office"></div>
                                                    </td>

                                         
                                                </tr>
                                                <tr>
                                                    <td style="text-align:left;width:10%" colspan="2"><strong>Filing From&nbsp;</strong><input type="text" name="filling_dt_from" placeholder="dd/mm/yyyy" style="width:100px;" id="filling_dt_from" value="">
                                                        <script type="text/javascript" charset="utf-8">
                                                            datePicker("filling_dt_from");
                                                        </script>
                                                    </td>

                                                    <td style="text-align:left;width:10%" colspan="2"><strong>TO &nbsp;</strong><input type="text" name="filling_dt_to" placeholder="dd/mm/yyyy" style="width:100px;" id="filling_dt_to" value="">
                                                        <script type="text/javascript" charset="utf-8">
                                                            datePicker("filling_dt_to");
                                                        </script>
                                                    </td>
                                    
                                                    <td style="text-align:right;width:10%"><strong>Case No.</strong> </td>
                                                    <td style="width:5%"><input name="case_number" tabindex="" type="text" class="" style="width:150px" id="case_number" value="" /></td>



                                                      <td style="text-align:right;width:5%"><strong>Protfolio</strong> </td>
                                                        <td style="width:8%;text-align: left;">
                                                            <div style="padding-left:1.8%" id="loan_segment" name="loan_segment"></div>
                                                        </td>

                                                </tr>
                                            </table>
                                        </div>
                                        <div id="searchTable"></div>
                                    </form>
                                </div>
                                <div id="main_div" style="overflow:scroll;min-width: 1000px;min-height: 100px;">
                                    <table class="" table border="1" id="facility_table">
                                        <thead>
                                            <tr>
                                                <td style="font-weight: bold;text-align:center">P</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Proposed Type</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">A/C Number</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Name of Enterprise</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">3 Type of Case</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Type Of Case</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Prev Filling Date</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Date</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Number</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Claim Amount</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Date Before Previous Date</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Step Before Previous Step</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Date</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status On The Previous Date</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Activities Taken On The Previous Date</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Next Date</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Status on the Next date</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Remarks on Case Status on the Previous date</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Filling Plaintiff</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Plaintiff</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Dealings officer</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Case Dealings officer Phone</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Lawyer's Name</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Previous Name Of The Court</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Present Name Of The Court</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">District</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Territory</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Portfolio</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Region</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Final Status (Running/ Settled)</td>
                                                <td style="font-weight: bold;text-align:center;word-wrap: break-word;">Legal Cost</td>
                                            </tr>
                                        </thead>
                                        <tbody id="list_body">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>