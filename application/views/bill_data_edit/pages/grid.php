<script type="text/javascript" src="<?= base_url() ?>js/jquery.ajaxupload.js"></script>
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
        background-position: -18px 89%;
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
</style>


<?php if ($operation == 'bill_data_edit/view') { ?>

    <script type="text/javascript">
        function edit_lawyer_bill_edit(id, index = null, option = null) {
            jQuery("#jqxgrid").jqxGrid('clearselection');
            EOL.messageBoard.open('<?= base_url() ?>Bill_data_edit/from/' + id + '/' + index + '/' + option, (jQuery(window).width() - 150), jQuery(window).height(), 'yes');
            return false;

        }



        var theme = getDemoTheme();

        var proposed_type = ["Loan", "Card"];


        var legal_region = [<? $i = 1;
                            foreach ($legal_region as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
        var case_sts_grid = [<? $i = 1;
                                foreach ($case_sts as $row) {
                                    if ($i != 1) {
                                        echo ',';
                                    }
                                    echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                    $i++;
                                } ?>];
        var req_type = [<? $i = 1;
                        foreach ($lawyer as $row) {
                            if ($i != 1) {
                                echo ',';
                            }
                            echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                            $i++;
                        } ?>];






        jQuery(document).ready(function() {
            var theme = 'classic';
            var legal_district = [];
            var court = [];



            jQuery("#req_type_grid").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                dropDownHeight: 100,
                promptText: "lawyer Name",
                source: req_type,
                width: 250,
                height: 30
            });


            jQuery("#proposed_type_grid").jqxComboBox({
                theme: theme,
                width: 100,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Proposed Type",
                source: proposed_type,
                height: 25
            });


            jQuery('#proposed_type_grid,#req_type_grid').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });

            jQuery("#proposed_type_grid").jqxComboBox('val', 'Loan');
            change_caption_grid();


            jQuery('#proposed_type_grid').bind('change', function(event) {
                jQuery("#loan_ac_grid").val('');
                jQuery("#hidden_loan_ac_grid").val('');
                change_caption_grid();
            });


            var initGrid = function() {
                var source = {
                    datatype: "json",
                    datafields: [{
                            name: 'id',
                            type: 'int'
                        },
                        {
                            name: 'lawyer_name',
                            type: 'string'
                        },
                        {
                            name: 'proposed_type',
                            type: 'string'
                        },
                        {
                            name: 'loan_ac',
                            type: 'string'
                        },
                        {
                            name: 'cif',
                            type: 'string'
                        },
                        {
                            name: 'ac_name',
                            type: 'string'
                        },
                        {
                            name: 'region',
                            type: 'string'
                        },
                        {
                            name: 'district',
                            type: 'string'
                        },
                        {
                            name: 'amount',
                            type: 'string'
                        },
                        {
                            name: 'txrn_dt',
                            type: 'string'
                        },
                        {
                            name: 'case_number',
                            type: 'string'
                        },

                    ],
                    addrow: function(rowid, rowdata, position, commit) {
                        commit(true);
                    },
                    deleterow: function(rowid, commit) {
                        commit(true);
                    },
                    updaterow: function(rowid, newdata, commit) {
                        commit(true);
                    },
                    url: '<?= base_url() ?>index.php/bill_data_edit/grid',
                    cache: false,
                    filter: function() {
                        // update the grid and send a request to the server.
                        jQuery("#jqxgrid").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function() {
                        // update the grid and send a request to the server.
                        jQuery("#jqxgrid").jqxGrid('updatebounddata', 'sort');
                    },
                    root: 'Rows',
                    beforeprocessing: function(data) {
                        if (data != null) {
                            //alert(data[0].TotalRows)
                            source.totalrecords = data[0].TotalRows;
                        }
                    }

                };

                var dataadapter = new jQuery.jqx.dataAdapter(source, {
                    loadError: function(xhr, status, error) {
                        alert(error);
                    },
                    formatData: function(data) {
                        var proposed_type = jQuery.trim(jQuery('input[name=proposed_type_grid]').val());
                        var req_type = jQuery.trim(jQuery('#req_type_grid').val());
                        var loan_ac = jQuery.trim(jQuery('#loan_ac_grid').val());
                        var hidden_loan_ac = jQuery.trim(jQuery('#hidden_loan_ac_grid').val());
                        var case_number = jQuery.trim(jQuery('#case_number_grid').val());


                        var txrn_dt_from = jQuery.trim(jQuery('#txrn_dt_from').val());
						var txrn_dt_to = jQuery.trim(jQuery('#txrn_dt_to').val());

                        jQuery.extend(data, {
                            proposed_type: proposed_type,
                            req_type: req_type,
                            loan_ac: loan_ac,
                            hidden_loan_ac: hidden_loan_ac,
                            case_number: case_number,
                            txrn_dt_from: txrn_dt_from,
                            txrn_dt_to: txrn_dt_to,

                        });
                        return data;
                    }
                });


                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function(row, datafield, columntype) {
                    var checked = jQuery('#jqxgrid').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                        return false;
                    };
                };

                var win_h = jQuery(window).height() - 320;
                jQuery("#jqxgrid").jqxGrid({
                    width: '99%',
                    height: win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    rowdetails: false,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj) {
                        return obj.data;
                    },

                    columns: [{
                            text: 'Id',
                            datafield: 'id',
                            hidden: true,
                            editable: false,
                            width: '4%'
                        },
                        <? if (EDIT == 1) { ?> {
                                text: 'E',
                                datafield: 'lawyer_bill_edit',
                                editable: false,
                                align: 'center',
                                sortable: false,
                                menu: false,
                                width: 35,
                                cellsrenderer: function(row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit_lawyer_bill_edit(' + dataRecord.id + ',' + editrow + ',\'lawyer_bill\')" ><img align="center" src="<?= base_url() ?>images/edit-new.png"></div>';
                                }
                            },
                        <? } ?> {
                            text: 'P',
                            menu: false,
                            datafield: 'Preview',
                            align: 'center',
                            editable: false,
                            sortable: false,
                            width: '2%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'details\',' + editrow + ',' + dataRecord.cma_id + ')" ><img align="center" src="<?= base_url() ?>images/view_detail.png"></div>';

                            }
                        },


                        {
                            text: 'Proposed Type',
                            datafield: 'proposed_type',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',


                        },


                        {
                            text: 'Loan A/C',
                            datafield: 'loan_ac',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Amount',
                            datafield: 'amount',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Transition Date',
                            datafield: 'txrn_dt',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Case Number',
                            datafield: 'case_number',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },


                        {
                            text: 'Lawyer Name',
                            datafield: 'lawyer_name',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },

                        {
                            text: 'CIF',
                            datafield: 'cif',
                            editable: false,
                            width: '15%',
                            align: 'left',

                        },
                        {
                            text: 'A/C Name',
                            datafield: 'ac_name',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Region',
                            datafield: 'region',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'District',
                            datafield: 'district',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },

                    ],
                });
            };
            // Jqx tab second tab function start    Grid Show
            var initWidgets = function(tab) {
                switch (tab) {
                    case 0:
                        initGrid();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({
                width: '99%',
                initTabContent: initWidgets
            });
            jQuery('#jqxTabs').bind('selected', function(event) {
                jQuery('#suit_file_form').jqxValidator('hide');
                if (event.args.item == 1) {
                    //clear_form();
                    jQuery('#jqxTabs').jqxTabs('disableAt', 0);
                }
            });
            jQuery('#jqxTabs').jqxTabs('select', 1);
            //End check box update 
            jQuery("#details").jqxWindow({
                theme: theme,
                width: '75%',
                height: '90%',
                resizable: false,
                isModal: true,
                autoOpen: false,
                cancelButton: jQuery("#codeOK")
            });
            jQuery('#details').on('close', function(event) {
                jQuery('#action_form').jqxValidator('hide');
            });
        });


        function change_caption_grid() {
            if (jQuery("#proposed_type_grid").val() == '') {
                document.getElementById("loan_ac_grid").disabled = true;
                jQuery("#l_or_c_no_grid").html('Loan A/C or Card');
            } else {
                document.getElementById("loan_ac_grid").disabled = false;
                var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
                if (item.value == 'Loan') {
                    jQuery("#l_or_c_no_grid").html('Loan A/C ');
                } else if (item.value == 'Card') {
                    jQuery("#l_or_c_no_grid").html('Card');
                }
            }

        }

        function change_dropdown(operation, edit = null) {
            var id = '';
            //check for add Region action
            if (edit == null && operation != 'legal_district_case_deal_officer' && operation != 'court') {
                id = jQuery("#" + operation).val();
            } else if (operation == 'court') {
                id = jQuery("#new_legal_district").val();
            } else if (operation == 'legal_district_case_deal_officer') {
                id = jQuery("#legal_district").val();
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
                    //console.log(json['row_info']);
                    var csrf_tokena = json.csrf_token;
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str = '';
                    var theme = getDemoTheme();
                    if (operation == 'legal_region') {
                        var legal_district = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#legal_district").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Legal District",
                            source: legal_district,
                            width: 215,
                            height: 25
                        });
                    }
                    if (operation == 'court') {
                        var court = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            court.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#court").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Select Court",
                            source: court,
                            width: 215,
                            height: 25
                        });
                    }
                    if (operation == 'legal_district_case_deal_officer') {
                        var case_deal_officer = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            case_deal_officer.push({
                                value: obj.id,
                                label: obj.name + '(' + obj.pin + ')'
                            });
                            //alert(obj.name);
                        });
                        jQuery("#case_deal_officer").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Case Deal Officer",
                            source: case_deal_officer,
                            width: 215,
                            height: 25
                        });
                    }

                },
                error: function(model, xhr, options) {
                    alert('failed');
                },
            });

            return false;
        }

        function search_data() {
            jQuery("#jqxgrid").jqxGrid('updatebounddata');
            return;

        }

        function mask_grid(str, textbox) {
            var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
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
                        jQuery("#hidden_loan_ac_grid").val(str);
                    } else //For single value enter
                    {
                        //For New value
                        var orginal_loan_ac = jQuery("#hidden_loan_ac_grid").val();
                        if (orginal_loan_ac.length < str.length) {
                            var index = str.length - 1;
                            var new_val = str.slice(index);
                            orginal_loan_ac += new_val;
                            //alert(orginal_loan_ac);
                            jQuery("#hidden_loan_ac_grid").val(orginal_loan_ac);
                        }
                        //For delete key
                        else {
                            var len = str.length;
                            var new_val = orginal_loan_ac.slice(0, len);
                            jQuery("#hidden_loan_ac_grid").val(new_val);
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
                            if (letter_Count < 6 || jQuery("#hidden_loan_ac_grid").val().length != 16) {
                                textbox.value = '';
                                jQuery("#hidden_loan_ac_grid").val('');
                                alert('Wrong way to input Card No please try again');
                            }
                        }
                    }
                }
            }

        }


        function details(id, operation, indx, cma_id, proposed_type, sec_sts) {
            jQuery('#deleteEventId').val(id);
            jQuery('#type').val(operation);

            if (operation == 'details') {
                jQuery("#header_title").html('Lawyer Bill Details');
                jQuery('#sendtochecker_row').hide();
                jQuery('#delete_row').hide();
                jQuery('#close_btn_row').show();
                jQuery('#lawyer_notification_row').hide();
                jQuery('#authorization_row').hide();
                jQuery('#confirm_row').hide();
                jQuery('#reassign_row').hide();
                jQuery('#closeaccount_row').hide();
                jQuery('#next_date_row').hide();
                jQuery('#reassign_row').hide();
                jQuery('#reassign_approval_row').hide();
                jQuery('#putup_row').hide();
                jQuery('#putup_approval_row').hide();
            }
            jQuery('#loading_preview').show();
            jQuery('#loading_p').show();
            jQuery('#details_table').hide();
            jQuery("#details").jqxWindow('open');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?= base_url() ?>Bill_data_edit/lawyer_bill_details",
                data: {
                    [csrfName]: csrfHash,
                    id: id,
                },
                datatype: "json",
                success: function(response) {
                    //alert(response);
                    var json = jQuery.parseJSON(response);

                    jQuery('.txt_csrfname').val(json.csrf_token);

                    document.getElementById("details").style.visibility = 'visible';
                    jQuery("#main_body").html(json['str']);
                    jQuery('#loading_preview').hide();
                    jQuery('#loading_p').hide();
                    jQuery('#details_table').show();
                    jQuery("#details").jqxWindow('open');


                }
            });
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

        function clear_form() {}

        function get_user_data_region_wise() {
            var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
            if (item != null) {
                var legal_region = item.value;
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery.ajax({
                    url: '<?= base_url() ?>index.php/hoops/get_dropdown_data',
                    async: false,
                    type: "post",
                    data: {
                        [csrfName]: csrfHash,
                        legal_region: legal_region
                    },
                    datatype: "json",
                    success: function(response) {
                        var json = jQuery.parseJSON(response);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        var str = '';
                        var theme = getDemoTheme();
                        var legal_user = [];
                        jQuery.each(json['legal_user'], function(key, obj) {
                            legal_user.push({
                                value: obj.id,
                                label: obj.name + ' (' + obj.pin + ')'
                            });
                            //alert(obj.name);
                        });
                        jQuery("#legal_user").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select legal user",
                            source: legal_user,
                            width: 215,
                            height: 25
                        });
                        jQuery('#legal_user').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                        });
                        var legal_district = [];
                        jQuery.each(json['legal_district'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#new_legal_district").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select District",
                            source: legal_district,
                            width: 215,
                            height: 25
                        });
                        jQuery('#new_legal_district').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                        });

                    },
                    error: function(model, xhr, options) {
                        alert('failed');
                    },
                });
            } else {
                jQuery("#legal_user").jqxComboBox('clearSelection');
                jQuery("input[name='legal_user']").val('');
            }
        }
    </script>
    <div id="container">
        <div id="body">
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('bill_data_edit/pages/left_side_nav'); ?>
                        <!----====== Left Side Menu End==========----->

                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                            <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Data Grid</li>
                                </ul>

                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 0.5%;width:98%;height:78px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">




                                        <input type="hidden" id="hidden_loan_ac_grid" value="" name="hidden_loan_ac_grid">
                                        <table id="deal_body" style="display:block;width:100%">
                                            <tr>
                                                <td style="text-align:left;width:12%"><strong>Lawyer Name&nbsp;&nbsp;</strong> </td>

                                                <td>
                                                    <div style="padding-left:1.8%" id="req_type_grid" name="req_type_grid"></div>
                                                </td>

                                                <td style="text-align:right;width:9%"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                                <td style="width:10%">
                                                    <div style="padding-left:1.8%" id="proposed_type_grid" name="proposed_type_grid"></div>
                                                </td>
                                                <td style="text-align:right;width:8%"><strong><span id="l_or_c_no_grid"></span> No.</strong></td>
                                                <td style="width:10%"><input name="loan_ac_grid" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac_grid" value="" onKeyUp="javascript:return mask_grid(this.value,this);" /></td>
                                                <td style="text-align:right;width:7%"><strong>Case No.&nbsp;&nbsp;</strong> </td>
                                                <td style="width:10%"><input name="case_number_grid" tabindex="" type="text" class="" maxlength="" size="" style="width:150px" id="case_number_grid" value="" onKeyUp="" /></td>
                                                <td style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                    <span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                                </td>
                                            </tr>

                                            <tr>


                                            <td style="text-align:right;width:5%"><strong>Txrn Date&nbsp;&nbsp;</strong> </td>
                                            <td style="width:30%"><input id="txrn_dt_from" name="txrn_dt_from" style="width:40%" /><script type="text/javascript">datePicker("txrn_dt_from");</script>
                                            <strong>To</strong> <input id="txrn_dt_to" name="txrn_dt_to" style="width:40%" /><script type="text/javascript" >datePicker("txrn_dt_to");</script>
                                            </td>

                                            </tr>
                                        </table>




                                    </div>
                                    <div style="border:none;" id="jqxgrid"></div>
                                    <div style="float:left;padding-top: 5px;">
                                        <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">

                                        <?php if (EDIT == 1) { ?> 
                                            <strong>E = </strong>Edit,&nbsp;
                                        <?php }?>
                                            <strong>P = </strong> Preview&nbsp;

                                        </div> <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div id="details" style="visibility:hidden;">
        <div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>
        <form method="POST" name="action_form" id="action_form" style="margin:0px;">
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <input name="cif" id="cif" value="" type="hidden">
            <input name="pre_legal_user" id="pre_legal_user" value="" type="hidden">
            <input name="sec_sts" id="sec_sts" value="" type="hidden">
            <input name="proposed_type" id="proposed_type" value="" type="hidden">
            <div id="loading_preview" style="text-align:center">
                <span id="loading_p" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
            </div>
            <div style="" id="details_table">
                &nbsp;&nbsp;&nbsp;<img onClick="printpage('preview_table','gurantor_table','suit_file','facility_card','proposed_type_d')" style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?= base_url() ?>old_assets/images/Print.png" alt="print-preview" />
                <span id="main_body"></span>
                <br>
                <div id="preview_table"></div>
                <div id="gurantor_table"></div>
                <div id="facility_card"></div>
                <div id="proposed_type_d"></div>
                <div id="close_btn_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <input type="button" class="button6" id="codeOK" value="Close" />
                </div>
            </div>
        </form>
    </div>

<?php } else if ($operation == 'bill_data_edit/court_fee') { ?>


    <script type="text/javascript">
        function edit_lawyer_bill_edit(id, index = null, option = null) {
            jQuery("#jqxgrid").jqxGrid('clearselection');
            EOL.messageBoard.open('<?= base_url() ?>Bill_data_edit/from/' + id + '/' + index + '/' + option, (jQuery(window).width() - 150), jQuery(window).height(), 'yes');
            return false;

        }



        var theme = getDemoTheme();

        var proposed_type = ["Loan", "Card"];


        var legal_region = [<? $i = 1;
                            foreach ($legal_region as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
        var case_sts_grid = [<? $i = 1;
                                foreach ($case_sts as $row) {
                                    if ($i != 1) {
                                        echo ',';
                                    }
                                    echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                    $i++;
                                } ?>];
        var req_type = [<? $i = 1;
                        foreach ($lawyer as $row) {
                            if ($i != 1) {
                                echo ',';
                            }
                            echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                            $i++;
                        } ?>];






        jQuery(document).ready(function() {
            var theme = 'classic';
            var legal_district = [];
            var court = [];



            jQuery("#req_type_grid").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                dropDownHeight: 100,
                promptText: "lawyer Name",
                source: req_type,
                width: 150,
                height: 30
            });


            jQuery("#proposed_type_grid").jqxComboBox({
                theme: theme,
                width: 100,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Proposed Type",
                source: proposed_type,
                height: 25
            });


            jQuery('#proposed_type_grid,#req_type_grid').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });

            jQuery("#proposed_type_grid").jqxComboBox('val', 'Loan');
            change_caption_grid();


            jQuery('#proposed_type_grid').bind('change', function(event) {
                jQuery("#loan_ac_grid").val('');
                jQuery("#hidden_loan_ac_grid").val('');
                change_caption_grid();
            });


            var initGrid = function() {
                var source = {
                    datatype: "json",
                    datafields: [{
                            name: 'id',
                            type: 'int'
                        },
                        {
                            name: 'lawyer_name',
                            type: 'string'
                        },
                        {
                            name: 'proposed_type',
                            type: 'string'
                        },
                        {
                            name: 'loan_ac',
                            type: 'string'
                        },
                        {
                            name: 'cif',
                            type: 'string'
                        },
                        {
                            name: 'ac_name',
                            type: 'string'
                        },
                        {
                            name: 'region',
                            type: 'string'
                        },
                        {
                            name: 'district',
                            type: 'string'
                        },
                        {
                            name: 'amount',
                            type: 'string'
                        },
                        {
                            name: 'txrn_dt',
                            type: 'string'
                        },
                        {
                            name: 'case_number',
                            type: 'string'
                        },

                    ],
                    addrow: function(rowid, rowdata, position, commit) {
                        commit(true);
                    },
                    deleterow: function(rowid, commit) {
                        commit(true);
                    },
                    updaterow: function(rowid, newdata, commit) {
                        commit(true);
                    },
                    url: '<?= base_url() ?>index.php/bill_data_edit/grid_court',
                    cache: false,
                    filter: function() {
                        // update the grid and send a request to the server.
                        jQuery("#jqxgrid").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function() {
                        // update the grid and send a request to the server.
                        jQuery("#jqxgrid").jqxGrid('updatebounddata', 'sort');
                    },
                    root: 'Rows',
                    beforeprocessing: function(data) {
                        if (data != null) {
                            //alert(data[0].TotalRows)
                            source.totalrecords = data[0].TotalRows;
                        }
                    }

                };

                var dataadapter = new jQuery.jqx.dataAdapter(source, {
                    loadError: function(xhr, status, error) {
                        alert(error);
                    },
                    formatData: function(data) {
                        var proposed_type = jQuery.trim(jQuery('input[name=proposed_type_grid]').val());
                        var req_type = jQuery.trim(jQuery('#req_type_grid').val());
                        var loan_ac = jQuery.trim(jQuery('#loan_ac_grid').val());
                        var hidden_loan_ac = jQuery.trim(jQuery('#hidden_loan_ac_grid').val());
                        var case_number = jQuery.trim(jQuery('#case_number_grid').val());
                        var txrn_dt_from = jQuery.trim(jQuery('#txrn_dt_from').val());
						var txrn_dt_to = jQuery.trim(jQuery('#txrn_dt_to').val());

                        jQuery.extend(data, {
                            proposed_type: proposed_type,
                            req_type: req_type,
                            loan_ac: loan_ac,
                            hidden_loan_ac: hidden_loan_ac,
                            case_number: case_number,
                            txrn_dt_from: txrn_dt_from,
                            txrn_dt_to: txrn_dt_to,

                        });
                        return data;
                    }
                });


                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function(row, datafield, columntype) {
                    var checked = jQuery('#jqxgrid').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                        return false;
                    };
                };

                var win_h = jQuery(window).height() - 320;
                jQuery("#jqxgrid").jqxGrid({
                    width: '99%',
                    height: win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    rowdetails: false,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj) {
                        return obj.data;
                    },

                    columns: [{
                            text: 'Id',
                            datafield: 'id',
                            hidden: true,
                            editable: false,
                            width: '4%'
                        },
                        <? if (EDITCOURTFEE == 1) { ?> {
                                text: 'E',
                                datafield: 'lawyer_bill_edit',
                                editable: false,
                                align: 'center',
                                sortable: false,
                                menu: false,
                                width: 35,
                                cellsrenderer: function(row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit_lawyer_bill_edit(' + dataRecord.id + ',' + editrow + ',\'court_fee\')" ><img align="center" src="<?= base_url() ?>images/edit-new.png"></div>';
                                }
                            },
                        <? } ?> {
                            text: 'P',
                            menu: false,
                            datafield: 'Preview',
                            align: 'center',
                            editable: false,
                            sortable: false,
                            width: '2%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'details\',' + editrow + ',' + dataRecord.cma_id + ')" ><img align="center" src="<?= base_url() ?>images/view_detail.png"></div>';

                            }
                        },


                        {
                            text: 'Proposed Type',
                            datafield: 'proposed_type',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',


                        },


                        {
                            text: 'Loan A/C',
                            datafield: 'loan_ac',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Amount',
                            datafield: 'amount',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Transition Date',
                            datafield: 'txrn_dt',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Case Number',
                            datafield: 'case_number',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },


                        {
                            text: 'Lawyer Name',
                            datafield: 'lawyer_name',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },

                        {
                            text: 'CIF',
                            datafield: 'cif',
                            editable: false,
                            width: '15%',
                            align: 'left',

                        },
                        {
                            text: 'A/C Name',
                            datafield: 'ac_name',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Region',
                            datafield: 'region',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'District',
                            datafield: 'district',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },

                    ],
                });
            };
            // Jqx tab second tab function start    Grid Show
            var initWidgets = function(tab) {
                switch (tab) {
                    case 0:
                        initGrid();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({
                width: '99%',
                initTabContent: initWidgets
            });
            jQuery('#jqxTabs').bind('selected', function(event) {
                jQuery('#suit_file_form').jqxValidator('hide');
                if (event.args.item == 1) {
                    //clear_form();
                    jQuery('#jqxTabs').jqxTabs('disableAt', 0);
                }
            });
            jQuery('#jqxTabs').jqxTabs('select', 1);
            //End check box update 
            jQuery("#details").jqxWindow({
                theme: theme,
                width: '75%',
                height: '90%',
                resizable: false,
                isModal: true,
                autoOpen: false,
                cancelButton: jQuery("#codeOK")
            });
            jQuery('#details').on('close', function(event) {
                jQuery('#action_form').jqxValidator('hide');
            });
        });


        function change_caption_grid() {
            if (jQuery("#proposed_type_grid").val() == '') {
                document.getElementById("loan_ac_grid").disabled = true;
                jQuery("#l_or_c_no_grid").html('Loan A/C or Card');
            } else {
                document.getElementById("loan_ac_grid").disabled = false;
                var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
                if (item.value == 'Loan') {
                    jQuery("#l_or_c_no_grid").html('Loan A/C ');
                } else if (item.value == 'Card') {
                    jQuery("#l_or_c_no_grid").html('Card');
                }
            }

        }

        function change_dropdown(operation, edit = null) {
            var id = '';
            //check for add Region action
            if (edit == null && operation != 'legal_district_case_deal_officer' && operation != 'court') {
                id = jQuery("#" + operation).val();
            } else if (operation == 'court') {
                id = jQuery("#new_legal_district").val();
            } else if (operation == 'legal_district_case_deal_officer') {
                id = jQuery("#legal_district").val();
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
                    //console.log(json['row_info']);
                    var csrf_tokena = json.csrf_token;
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str = '';
                    var theme = getDemoTheme();
                    if (operation == 'legal_region') {
                        var legal_district = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#legal_district").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Legal District",
                            source: legal_district,
                            width: 215,
                            height: 25
                        });
                    }
                    if (operation == 'court') {
                        var court = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            court.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#court").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Select Court",
                            source: court,
                            width: 215,
                            height: 25
                        });
                    }
                    if (operation == 'legal_district_case_deal_officer') {
                        var case_deal_officer = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            case_deal_officer.push({
                                value: obj.id,
                                label: obj.name + '(' + obj.pin + ')'
                            });
                            //alert(obj.name);
                        });
                        jQuery("#case_deal_officer").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Case Deal Officer",
                            source: case_deal_officer,
                            width: 215,
                            height: 25
                        });
                    }

                },
                error: function(model, xhr, options) {
                    alert('failed');
                },
            });

            return false;
        }

        function search_data() {
            jQuery("#jqxgrid").jqxGrid('updatebounddata');
            return;

        }

        function mask_grid(str, textbox) {
            var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
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
                        jQuery("#hidden_loan_ac_grid").val(str);
                    } else //For single value enter
                    {
                        //For New value
                        var orginal_loan_ac = jQuery("#hidden_loan_ac_grid").val();
                        if (orginal_loan_ac.length < str.length) {
                            var index = str.length - 1;
                            var new_val = str.slice(index);
                            orginal_loan_ac += new_val;
                            //alert(orginal_loan_ac);
                            jQuery("#hidden_loan_ac_grid").val(orginal_loan_ac);
                        }
                        //For delete key
                        else {
                            var len = str.length;
                            var new_val = orginal_loan_ac.slice(0, len);
                            jQuery("#hidden_loan_ac_grid").val(new_val);
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
                            if (letter_Count < 6 || jQuery("#hidden_loan_ac_grid").val().length != 16) {
                                textbox.value = '';
                                jQuery("#hidden_loan_ac_grid").val('');
                                alert('Wrong way to input Card No please try again');
                            }
                        }
                    }
                }
            }

        }


        function details(id, operation, indx, cma_id, proposed_type, sec_sts) {
            jQuery('#deleteEventId').val(id);
            jQuery('#type').val(operation);

            if (operation == 'details') {
                jQuery("#header_title").html('Lawyer Bill Details');
                jQuery('#sendtochecker_row').hide();
                jQuery('#delete_row').hide();
                jQuery('#close_btn_row').show();
                jQuery('#lawyer_notification_row').hide();
                jQuery('#authorization_row').hide();
                jQuery('#confirm_row').hide();
                jQuery('#reassign_row').hide();
                jQuery('#closeaccount_row').hide();
                jQuery('#next_date_row').hide();
                jQuery('#reassign_row').hide();
                jQuery('#reassign_approval_row').hide();
                jQuery('#putup_row').hide();
                jQuery('#putup_approval_row').hide();
            }
            jQuery('#loading_preview').show();
            jQuery('#loading_p').show();
            jQuery('#details_table').hide();
            jQuery("#details").jqxWindow('open');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?= base_url() ?>Bill_data_edit/lawyer_bill_details",
                data: {
                    [csrfName]: csrfHash,
                    id: id,
                },
                datatype: "json",
                success: function(response) {
                    //alert(response);
                    var json = jQuery.parseJSON(response);

                    jQuery('.txt_csrfname').val(json.csrf_token);

                    document.getElementById("details").style.visibility = 'visible';
                    jQuery("#main_body").html(json['str']);
                    jQuery('#loading_preview').hide();
                    jQuery('#loading_p').hide();
                    jQuery('#details_table').show();
                    jQuery("#details").jqxWindow('open');


                }
            });
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

        function clear_form() {}

        function get_user_data_region_wise() {
            var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
            if (item != null) {
                var legal_region = item.value;
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery.ajax({
                    url: '<?= base_url() ?>index.php/hoops/get_dropdown_data',
                    async: false,
                    type: "post",
                    data: {
                        [csrfName]: csrfHash,
                        legal_region: legal_region
                    },
                    datatype: "json",
                    success: function(response) {
                        var json = jQuery.parseJSON(response);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        var str = '';
                        var theme = getDemoTheme();
                        var legal_user = [];
                        jQuery.each(json['legal_user'], function(key, obj) {
                            legal_user.push({
                                value: obj.id,
                                label: obj.name + ' (' + obj.pin + ')'
                            });
                            //alert(obj.name);
                        });
                        jQuery("#legal_user").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select legal user",
                            source: legal_user,
                            width: 215,
                            height: 25
                        });
                        jQuery('#legal_user').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                        });
                        var legal_district = [];
                        jQuery.each(json['legal_district'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#new_legal_district").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select District",
                            source: legal_district,
                            width: 215,
                            height: 25
                        });
                        jQuery('#new_legal_district').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                        });

                    },
                    error: function(model, xhr, options) {
                        alert('failed');
                    },
                });
            } else {
                jQuery("#legal_user").jqxComboBox('clearSelection');
                jQuery("input[name='legal_user']").val('');
            }
        }
    </script>
    <div id="container">
        <div id="body">
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('bill_data_edit/pages/left_side_nav'); ?>
                        <!----====== Left Side Menu End==========----->

                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                            <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Data Grid</li>
                                </ul>

                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 0.5%;width:98%;height:79px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">

                                        <input type="hidden" id="hidden_loan_ac_grid" value="" name="hidden_loan_ac_grid">
                                        <table id="deal_body" style="display:block;width:100%">
                                            <tr>
                                                <td style="text-align:left;width:9%"><strong>Lawyer Name&nbsp;&nbsp;</strong> </td>

                                                <td style="width:10%">
                                                    <div style="padding-left:1.8%" id="req_type_grid" name="req_type_grid"></div>
                                                </td>

                                                <td style="text-align:right;width:9%"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                                <td style="width:10%">
                                                    <div style="padding-left:1.8%" id="proposed_type_grid" name="proposed_type_grid"></div>
                                                </td>
                                                <td style="text-align:right;width:8%"><strong><span id="l_or_c_no_grid"></span> No.</strong></td>
                                                <td style="width:10%"><input name="loan_ac_grid" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac_grid" value="" onKeyUp="javascript:return mask_grid(this.value,this);" /></td>
                                                <td style="text-align:right;width:7%"><strong>Case No.&nbsp;&nbsp;</strong> </td>
                                                <td style="width:10%"><input name="case_number_grid" tabindex="" type="text" class="" maxlength="" size="" style="width:150px" id="case_number_grid" value="" onKeyUp="" /></td>
                                                <td style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                    <span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                                </td>
                                            </tr>



                                            <tr>
                                                    <td style="text-align:right;width:5%"><strong>Txrn Date&nbsp;&nbsp;</strong> </td>
                                                    <td style="width:30%"><input id="txrn_dt_from" name="txrn_dt_from" style="width:40%" /><script type="text/javascript">datePicker("txrn_dt_from");</script>
                                                    <strong>To</strong> <input id="txrn_dt_to" name="txrn_dt_to" style="width:40%" /><script type="text/javascript" >datePicker("txrn_dt_to");</script>
                                                    </td>
                                            </tr>
                                        </table>




                                    </div>
                                    <div style="border:none;" id="jqxgrid"></div>
                                    <div style="float:left;padding-top: 5px;">
                                        <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">

                                        <?php if(EDITCOURTFEE == 1){?>
                                            <strong>E = </strong>Edit,&nbsp;
                                        <?php }?>

                                            <strong>P = </strong> Preview&nbsp;

                                        </div> <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div id="details" style="visibility:hidden;">
        <div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>
        <form method="POST" name="action_form" id="action_form" style="margin:0px;">
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <input name="cif" id="cif" value="" type="hidden">
            <input name="pre_legal_user" id="pre_legal_user" value="" type="hidden">
            <input name="sec_sts" id="sec_sts" value="" type="hidden">
            <input name="proposed_type" id="proposed_type" value="" type="hidden">
            <div id="loading_preview" style="text-align:center">
                <span id="loading_p" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
            </div>
            <div style="" id="details_table">
                &nbsp;&nbsp;&nbsp;<img onClick="printpage('preview_table','gurantor_table','suit_file','facility_card','proposed_type_d')" style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?= base_url() ?>old_assets/images/Print.png" alt="print-preview" />
                <span id="main_body"></span>
                <br>
                <div id="preview_table"></div>
                <div id="gurantor_table"></div>
                <div id="facility_card"></div>
                <div id="proposed_type_d"></div>
                <div id="close_btn_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <input type="button" class="button6" id="codeOK" value="Close" />
                </div>
            </div>
        </form>
    </div>

<?php } else if ($operation == 'bill_data_edit/paper_vendor') { ?>

    <script type="text/javascript">
        function edit_lawyer_bill_edit(id, index = null, option = null) {
            jQuery("#jqxgrid").jqxGrid('clearselection');
            EOL.messageBoard.open('<?= base_url() ?>Bill_data_edit/from/' + id + '/' + index + '/' + option, (jQuery(window).width() - 150), jQuery(window).height(), 'yes');
            return false;

        }



        var theme = getDemoTheme();

        var proposed_type = ["Loan", "Card"];


        var legal_region = [<? $i = 1;
                            foreach ($legal_region as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
        var case_sts_grid = [<? $i = 1;
                                foreach ($case_sts as $row) {
                                    if ($i != 1) {
                                        echo ',';
                                    }
                                    echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                    $i++;
                                } ?>];


        var vendor_type = ["Vendor", "Staff"];

        var paper_vendor = [<? $i = 1;
                            foreach ($paper_vendor as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
        var staff = [<? $i = 1;
                        foreach ($staff as $row) {
                            if ($i != 1) {
                                echo ',';
                            }
                            echo '{value:"' . $row->id . '", label:"' . $row->name . '(' . $row->pin . ')' . '"}';
                            $i++;
                        } ?>];




        jQuery(document).ready(function() {
            var theme = 'classic';
            var legal_district = [];
            var court = [];




            jQuery("#proposed_type_grid").jqxComboBox({
                theme: theme,
                width: 180,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Proposed Type",
                source: proposed_type,
                height: 25
            });

            jQuery("#vendor_type_grid").jqxComboBox({
                theme: theme,
                width: 180,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Type",
                source: vendor_type,
                height: 25
            });


            jQuery("#paper_vendor_grid").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select Paper Vendor",
                source: paper_vendor,
                width: 180,
                height: 25
            });


            jQuery("#staff_grid").jqxComboBox({
                theme: theme,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Select Staff",
                source: staff,
                width: 180,
                height: 25
            });



            jQuery('#proposed_type_grid,#req_type_grid,paper_vendor_grid').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });

            jQuery("#proposed_type_grid").jqxComboBox('val', 'Loan');
            change_caption_grid();


            jQuery('#proposed_type_grid').bind('change', function(event) {
                jQuery("#loan_ac_grid").val('');
                jQuery("#hidden_loan_ac_grid").val('');
                change_caption_grid();
            });


            var initGrid = function() {
                var source = {
                    datatype: "json",
                    datafields: [{
                            name: 'id',
                            type: 'int'
                        },
                        {
                            name: 'vendor_name_search',
                            type: 'string'
                        },
                        {
                            name: 'proposed_type',
                            type: 'string'
                        },
                        {
                            name: 'loan_ac',
                            type: 'string'
                        },
                        {
                            name: 'cif',
                            type: 'string'
                        },
                        {
                            name: 'ac_name',
                            type: 'string'
                        },
                        {
                            name: 'region',
                            type: 'string'
                        },
                        {
                            name: 'district',
                            type: 'string'
                        },
                        {
                            name: 'amount',
                            type: 'string'
                        },
                        {
                            name: 'txrn_dt',
                            type: 'string'
                        },
                        {
                            name: 'case_number',
                            type: 'string'
                        },

                    ],
                    addrow: function(rowid, rowdata, position, commit) {
                        commit(true);
                    },
                    deleterow: function(rowid, commit) {
                        commit(true);
                    },
                    updaterow: function(rowid, newdata, commit) {
                        commit(true);
                    },
                    url: '<?= base_url() ?>index.php/bill_data_edit/grid_paper_vendor',
                    cache: false,
                    filter: function() {
                        // update the grid and send a request to the server.
                        jQuery("#jqxgrid").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function() {
                        // update the grid and send a request to the server.
                        jQuery("#jqxgrid").jqxGrid('updatebounddata', 'sort');
                    },
                    root: 'Rows',
                    beforeprocessing: function(data) {
                        if (data != null) {
                            //alert(data[0].TotalRows)
                            source.totalrecords = data[0].TotalRows;
                        }
                    }

                };

                var dataadapter = new jQuery.jqx.dataAdapter(source, {
                    loadError: function(xhr, status, error) {
                        alert(error);
                    },
                    formatData: function(data) {



                        var vendor_type = jQuery.trim(jQuery('input[name=vendor_type_grid]').val());
                        var paper_vendor = jQuery.trim(jQuery('#paper_vendor_grid').val());
                        var staff = jQuery.trim(jQuery('#staff_grid').val());


                        var proposed_type = jQuery.trim(jQuery('input[name=proposed_type_grid]').val());
                        var loan_ac = jQuery.trim(jQuery('#loan_ac_grid').val());
                        var hidden_loan_ac = jQuery.trim(jQuery('#hidden_loan_ac_grid').val());
                        var case_number = jQuery.trim(jQuery('#case_number_grid').val());


                        var txrn_dt_from = jQuery.trim(jQuery('#txrn_dt_from').val());
						var txrn_dt_to = jQuery.trim(jQuery('#txrn_dt_to').val());


                        jQuery.extend(data, {

                            vendor_type: vendor_type,
                            paper_vendor: paper_vendor,
                            staff: staff,

                            proposed_type: proposed_type,
                            loan_ac: loan_ac,
                            hidden_loan_ac: hidden_loan_ac,
                            case_number: case_number,

                            txrn_dt_from: txrn_dt_from,
                            txrn_dt_to: txrn_dt_to,


                        });
                        return data;
                    }
                });


                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function(row, datafield, columntype) {
                    var checked = jQuery('#jqxgrid').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                        return false;
                    };
                };

                var win_h = jQuery(window).height() - 320;
                jQuery("#jqxgrid").jqxGrid({
                    width: '99%',
                    height: win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    rowdetails: false,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj) {
                        return obj.data;
                    },

                    columns: [{
                            text: 'Id',
                            datafield: 'id',
                            hidden: true,
                            editable: false,
                            width: '4%'
                        },
                        <? if (EDITPAPERVENDOR == 1) { ?> {
                                text: 'E',
                                datafield: 'lawyer_bill_edit',
                                editable: false,
                                align: 'center',
                                sortable: false,
                                menu: false,
                                width: 35,
                                cellsrenderer: function(row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit_lawyer_bill_edit(' + dataRecord.id + ',' + editrow + ',\'paper_bill\')" ><img align="center" src="<?= base_url() ?>images/edit-new.png"></div>';
                                }
                            },
                        <? } ?> {
                            text: 'P',
                            menu: false,
                            datafield: 'Preview',
                            align: 'center',
                            editable: false,
                            sortable: false,
                            width: '2%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'details\',' + editrow + ',' + dataRecord.cma_id + ')" ><img align="center" src="<?= base_url() ?>images/view_detail.png"></div>';

                            }
                        },


                        {
                            text: 'Proposed Type',
                            datafield: 'proposed_type',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',


                        },


                        {
                            text: 'Loan A/C',
                            datafield: 'loan_ac',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Amount',
                            datafield: 'amount',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Transition Date',
                            datafield: 'txrn_dt',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Case Number',
                            datafield: 'case_number',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },


                        {
                            text: 'Vendor Name',
                            datafield: 'vendor_name_search',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },

                        {
                            text: 'CIF',
                            datafield: 'cif',
                            editable: false,
                            width: '15%',
                            align: 'left',

                        },
                        {
                            text: 'A/C Name',
                            datafield: 'ac_name',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Region',
                            datafield: 'region',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'District',
                            datafield: 'district',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },

                    ],
                });
            };
            // Jqx tab second tab function start    Grid Show
            var initWidgets = function(tab) {
                switch (tab) {
                    case 0:
                        initGrid();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({
                width: '99%',
                initTabContent: initWidgets
            });
            jQuery('#jqxTabs').bind('selected', function(event) {
                jQuery('#suit_file_form').jqxValidator('hide');
                if (event.args.item == 1) {
                    //clear_form();
                    jQuery('#jqxTabs').jqxTabs('disableAt', 0);
                }
            });
            jQuery('#jqxTabs').jqxTabs('select', 1);
            //End check box update 
            jQuery("#details").jqxWindow({
                theme: theme,
                width: '75%',
                height: '90%',
                resizable: false,
                isModal: true,
                autoOpen: false,
                cancelButton: jQuery("#codeOK")
            });
            jQuery('#details').on('close', function(event) {
                jQuery('#action_form').jqxValidator('hide');
            });
        });


        function change_caption_grid() {
            if (jQuery("#proposed_type_grid").val() == '') {
                document.getElementById("loan_ac_grid").disabled = true;
                jQuery("#l_or_c_no_grid").html('Loan A/C or Card');
            } else {
                document.getElementById("loan_ac_grid").disabled = false;
                var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
                if (item.value == 'Loan') {
                    jQuery("#l_or_c_no_grid").html('Loan A/C ');
                } else if (item.value == 'Card') {
                    jQuery("#l_or_c_no_grid").html('Card');
                }
            }

        }

        function change_dropdown(operation, edit = null) {
            var id = '';
            //check for add Region action
            if (edit == null && operation != 'legal_district_case_deal_officer' && operation != 'court') {
                id = jQuery("#" + operation).val();
            } else if (operation == 'court') {
                id = jQuery("#new_legal_district").val();
            } else if (operation == 'legal_district_case_deal_officer') {
                id = jQuery("#legal_district").val();
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
                    //console.log(json['row_info']);
                    var csrf_tokena = json.csrf_token;
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    var str = '';
                    var theme = getDemoTheme();
                    if (operation == 'legal_region') {
                        var legal_district = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#legal_district").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Legal District",
                            source: legal_district,
                            width: 215,
                            height: 25
                        });
                    }
                    if (operation == 'court') {
                        var court = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            court.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#court").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Select Court",
                            source: court,
                            width: 215,
                            height: 25
                        });
                    }
                    if (operation == 'legal_district_case_deal_officer') {
                        var case_deal_officer = [];
                        jQuery.each(json['row_info'], function(key, obj) {
                            case_deal_officer.push({
                                value: obj.id,
                                label: obj.name + '(' + obj.pin + ')'
                            });
                            //alert(obj.name);
                        });
                        jQuery("#case_deal_officer").jqxComboBox({
                            theme: theme,
                            autoDropDownHeight: false,
                            promptText: "Case Deal Officer",
                            source: case_deal_officer,
                            width: 215,
                            height: 25
                        });
                    }

                },
                error: function(model, xhr, options) {
                    alert('failed');
                },
            });

            return false;
        }

        function search_data() {
            jQuery("#jqxgrid").jqxGrid('updatebounddata');
            return;

        }

        function mask_grid(str, textbox) {
            var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
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
                        jQuery("#hidden_loan_ac_grid").val(str);
                    } else //For single value enter
                    {
                        //For New value
                        var orginal_loan_ac = jQuery("#hidden_loan_ac_grid").val();
                        if (orginal_loan_ac.length < str.length) {
                            var index = str.length - 1;
                            var new_val = str.slice(index);
                            orginal_loan_ac += new_val;
                            //alert(orginal_loan_ac);
                            jQuery("#hidden_loan_ac_grid").val(orginal_loan_ac);
                        }
                        //For delete key
                        else {
                            var len = str.length;
                            var new_val = orginal_loan_ac.slice(0, len);
                            jQuery("#hidden_loan_ac_grid").val(new_val);
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
                            if (letter_Count < 6 || jQuery("#hidden_loan_ac_grid").val().length != 16) {
                                textbox.value = '';
                                jQuery("#hidden_loan_ac_grid").val('');
                                alert('Wrong way to input Card No please try again');
                            }
                        }
                    }
                }
            }

        }


        function details(id, operation, indx, cma_id, proposed_type, sec_sts) {
            jQuery('#deleteEventId').val(id);
            jQuery('#type').val(operation);

            if (operation == 'details') {
                jQuery("#header_title").html('Lawyer Bill Details');
                jQuery('#sendtochecker_row').hide();
                jQuery('#delete_row').hide();
                jQuery('#close_btn_row').show();
                jQuery('#lawyer_notification_row').hide();
                jQuery('#authorization_row').hide();
                jQuery('#confirm_row').hide();
                jQuery('#reassign_row').hide();
                jQuery('#closeaccount_row').hide();
                jQuery('#next_date_row').hide();
                jQuery('#reassign_row').hide();
                jQuery('#reassign_approval_row').hide();
                jQuery('#putup_row').hide();
                jQuery('#putup_approval_row').hide();
            }
            jQuery('#loading_preview').show();
            jQuery('#loading_p').show();
            jQuery('#details_table').hide();
            jQuery("#details").jqxWindow('open');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?= base_url() ?>Bill_data_edit/lawyer_bill_details",
                data: {
                    [csrfName]: csrfHash,
                    id: id,
                },
                datatype: "json",
                success: function(response) {
                    //alert(response);
                    var json = jQuery.parseJSON(response);

                    jQuery('.txt_csrfname').val(json.csrf_token);

                    document.getElementById("details").style.visibility = 'visible';
                    jQuery("#main_body").html(json['str']);
                    jQuery('#loading_preview').hide();
                    jQuery('#loading_p').hide();
                    jQuery('#details_table').show();
                    jQuery("#details").jqxWindow('open');


                }
            });
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

        function clear_form() {}

        function get_user_data_region_wise() {
            var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
            if (item != null) {
                var legal_region = item.value;
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery.ajax({
                    url: '<?= base_url() ?>index.php/hoops/get_dropdown_data',
                    async: false,
                    type: "post",
                    data: {
                        [csrfName]: csrfHash,
                        legal_region: legal_region
                    },
                    datatype: "json",
                    success: function(response) {
                        var json = jQuery.parseJSON(response);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        var str = '';
                        var theme = getDemoTheme();
                        var legal_user = [];
                        jQuery.each(json['legal_user'], function(key, obj) {
                            legal_user.push({
                                value: obj.id,
                                label: obj.name + ' (' + obj.pin + ')'
                            });
                            //alert(obj.name);
                        });
                        jQuery("#legal_user").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select legal user",
                            source: legal_user,
                            width: 215,
                            height: 25
                        });
                        jQuery('#legal_user').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                        });
                        var legal_district = [];
                        jQuery.each(json['legal_district'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#new_legal_district").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select District",
                            source: legal_district,
                            width: 215,
                            height: 25
                        });
                        jQuery('#new_legal_district').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                        });

                    },
                    error: function(model, xhr, options) {
                        alert('failed');
                    },
                });
            } else {
                jQuery("#legal_user").jqxComboBox('clearSelection');
                jQuery("input[name='legal_user']").val('');
            }
        }

        function change_vendor_type_grid() {
            var type = jQuery("#vendor_type_grid").jqxComboBox('getSelectedItem');
            if (type != null) {
                jQuery("#paper_vendor_grid").jqxComboBox('clearSelection');
                jQuery("input[name='paper_vendor_grid']").val('');
                if (type.value == 'Vendor') {
                    jQuery("#paper_vendor_grid").show();
                    jQuery("#staff_grid").hide();
                } else {
                    jQuery("#paper_vendor_grid").hide();
                    jQuery("#staff_grid").show();
                }
            }
        }
    </script>
    <div id="container">
        <div id="body">
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('bill_data_edit/pages/left_side_nav'); ?>
                        <!----====== Left Side Menu End==========----->

                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                            <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Data Grid</li>
                                </ul>

                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 0.5%;width:98%;height:84px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">

                                        <input type="hidden" id="hidden_loan_ac_grid" value="" name="hidden_loan_ac_grid">
                                        <table id="deal_body" style="display:block;width:100%">

                                            <tr>
                                                <td style="text-align:right;width:9%"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                                <td style="width:10%">
                                                    <div style="padding-left:1.8%" id="proposed_type_grid" name="proposed_type_grid"></div>
                                                </td>
                                                <td style="text-align:right;width:8%"><strong><span id="l_or_c_no_grid"></span> No.</strong></td>
                                                <td style="width:10%"><input name="loan_ac_grid" tabindex="" type="text" class="" maxlength="16" size="16" style="width:180px" id="loan_ac_grid" value="" onKeyUp="javascript:return mask_grid(this.value,this);" /></td>
                                                <td style="text-align:right;width:7%"><strong>Case No.&nbsp;&nbsp;</strong> </td>
                                                <td style="width:10%"><input name="case_number_grid" tabindex="" type="text" class="" maxlength="" size="" style="width:180px" id="case_number_grid" value="" onKeyUp="" /></td>
                                                <td style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                    <span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:right;width:15%"><strong>Vendor Type&nbsp;&nbsp;</strong> </td>

                                                <td style="width:10%">
                                                    <div id="vendor_type_grid" tabindex="3" onchange="change_vendor_type_grid()" name="vendor_type_grid" style="padding-left: 3px;float:left"></div>
                                                </td>

                                                <td style="text-align:right;width:8%"><strong>Vendor </strong></td>

                                                <td style="width:10%">
                                                    <div id="paper_vendor_grid" tabindex="3" name="paper_vendor_grid" style="padding-left: 3px;float:left"></div>
                                                    <div id="staff_grid" tabindex="3" name="staff_grid" style="padding-left: 3px;display:none;float:left"></div>
                                                </td>


                                                <td style="text-align:right;width:5%"><strong>Txrn Date&nbsp;&nbsp;</strong> </td>
                            <td style="width:30%"><input id="txrn_dt_from" name="txrn_dt_from" style="width:40%" /><script type="text/javascript">datePicker("txrn_dt_from");</script>
                            <strong>To</strong> <input id="txrn_dt_to" name="txrn_dt_to" style="width:40%" /><script type="text/javascript" >datePicker("txrn_dt_to");</script>
                            </td>

                                            </tr>
                                        </table>
                                    </div>
                                    <div style="border:none;" id="jqxgrid"></div>
                                    <div style="float:left;padding-top: 5px;">
                                        <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">

                                        <?php if (EDITPAPERVENDOR == 1) { ?>
                                            <strong>E = </strong>Edit,&nbsp;
                                        <?php } ?>
                                            <strong>P = </strong> Preview&nbsp;

                                        </div> <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div id="details" style="visibility:hidden;">
        <div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>
        <form method="POST" name="action_form" id="action_form" style="margin:0px;">
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <input name="cif" id="cif" value="" type="hidden">
            <input name="pre_legal_user" id="pre_legal_user" value="" type="hidden">
            <input name="sec_sts" id="sec_sts" value="" type="hidden">
            <input name="proposed_type" id="proposed_type" value="" type="hidden">
            <div id="loading_preview" style="text-align:center">
                <span id="loading_p" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
            </div>
            <div style="" id="details_table">
                &nbsp;&nbsp;&nbsp;<img onClick="printpage('preview_table','gurantor_table','suit_file','facility_card','proposed_type_d')" style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?= base_url() ?>old_assets/images/Print.png" alt="print-preview" />
                <span id="main_body"></span>
                <br>
                <div id="preview_table"></div>
                <div id="gurantor_table"></div>
                <div id="facility_card"></div>
                <div id="proposed_type_d"></div>
                <div id="close_btn_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <input type="button" class="button6" id="codeOK" value="Close" />
                </div>
            </div>
        </form>
    </div>



<?php } else if ($operation == 'bill_data_edit/staff_conveyance') {?>
    <script type="text/javascript">
        function edit_lawyer_bill_edit(id, index = null, option = null) {
            jQuery("#jqxgrid").jqxGrid('clearselection');
            EOL.messageBoard.open('<?= base_url() ?>Bill_data_edit/staff_conveyance_form/' + id + '/' + index + '/' + option, (jQuery(window).width() - 150), jQuery(window).height(), 'yes');
            return false;

        }

        var theme = getDemoTheme();

        var proposed_type = ["Loan", "Card"];


        var legal_region = [<? $i = 1;
                            foreach ($legal_region as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
        var case_sts_grid = [<? $i = 1;
                                foreach ($case_sts as $row) {
                                    if ($i != 1) {
                                        echo ',';
                                    }
                                    echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                    $i++;
                                } ?>];


var staff_grid_conv = [<? $i = 1;
                        foreach ($staff_grid_conv as $row) {
                            if ($i != 1) {
                                echo ',';
                            }
                            echo '{value:"' . $row->id . '", label:"' . $row->name ."($row->pin)".'"}';
                            $i++;
                        } ?>];








        jQuery(document).ready(function() {
            var theme = 'classic';
            var legal_district = [];
            var court = [];



            jQuery("#staff_grid_conv").jqxComboBox({
                theme: theme,
                width: 180,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Staff",
                source: staff_grid_conv,
                height: 25
            });


            jQuery("#proposed_type_grid").jqxComboBox({
                theme: theme,
                width: 180,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Proposed Type",
                source: proposed_type,
                height: 25
            });

            jQuery("#proposed_type_grid").jqxComboBox('val', 'Loan');
            change_caption_grid();

            jQuery('#proposed_type_grid').bind('change', function(event) {
                jQuery("#loan_ac_grid").val('');
                jQuery("#hidden_loan_ac_grid").val('');
                change_caption_grid();
            });




        
            jQuery('#req_type_grid,paper_vendor_grid,#staff_grid_conv').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });

  

            var initGrid = function() {
                var source = {
                    datatype: "json",
                    datafields: [{
                            name: 'id',
                            type: 'int'
                        },
                        {
                            name: 'vendor_name_search',
                            type: 'string'
                        },
                        {
                            name: 'proposed_type',
                            type: 'string'
                        },
                        {
                            name: 'loan_ac',
                            type: 'string'
                        },
                        {
                            name: 'cif',
                            type: 'string'
                        },
                        {
                            name: 'ac_name',
                            type: 'string'
                        },
                        {
                            name: 'region',
                            type: 'string'
                        },
                        {
                            name: 'district',
                            type: 'string'
                        },
                        {
                            name: 'amount',
                            type: 'string'
                        },
                        {
                            name: 'txrn_dt',
                            type: 'string'
                        },
                        {
                            name: 'case_number',
                            type: 'string'
                        },

                    ],
                    addrow: function(rowid, rowdata, position, commit) {
                        commit(true);
                    },
                    deleterow: function(rowid, commit) {
                        commit(true);
                    },
                    updaterow: function(rowid, newdata, commit) {
                        commit(true);
                    },
                    url: '<?= base_url() ?>index.php/bill_data_edit/staff_conveyance_grid',
                    cache: false,
                    filter: function() {
                        // update the grid and send a request to the server.
                        jQuery("#jqxgrid").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function() {
                        // update the grid and send a request to the server.
                        jQuery("#jqxgrid").jqxGrid('updatebounddata', 'sort');
                    },
                    root: 'Rows',
                    beforeprocessing: function(data) {
                        if (data != null) {
                            //alert(data[0].TotalRows)
                            source.totalrecords = data[0].TotalRows;
                        }
                    }

                };

                var dataadapter = new jQuery.jqx.dataAdapter(source, {
                    loadError: function(xhr, status, error) {
                        alert(error);
                    },
                    formatData: function(data) {

                        var staff_grid_conv = jQuery.trim(jQuery('input[name=staff_grid_conv]').val());
                        var case_number = jQuery.trim(jQuery('#case_number_grid').val());

                        var proposed_type = jQuery.trim(jQuery('input[name=proposed_type_grid]').val());

                        var loan_ac = jQuery.trim(jQuery('#loan_ac_grid').val());
                        var hidden_loan_ac = jQuery.trim(jQuery('#hidden_loan_ac_grid').val());

                        jQuery.extend(data, {
                            staff_grid_conv: staff_grid_conv,
                            case_number: case_number,
                            proposed_type: proposed_type,
                            loan_ac: loan_ac,
                            hidden_loan_ac: hidden_loan_ac,
                        });
                        return data;
                    }
                });


                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function(row, datafield, columntype) {
                    var checked = jQuery('#jqxgrid').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                        return false;
                    };
                };

                var win_h = jQuery(window).height() - 320;
                jQuery("#jqxgrid").jqxGrid({
                    width: '99%',
                    height: win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    rowdetails: false,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj) {
                        return obj.data;
                    },

                    columns: [{
                            text: 'Id',
                            datafield: 'id',
                            hidden: true,
                            editable: false,
                            width: '4%'
                        },
                        <? if (EDITSTAFF == 1) { ?> {
                                text: 'E',
                                datafield: 'lawyer_bill_edit',
                                editable: false,
                                align: 'center',
                                sortable: false,
                                menu: false,
                                width: 35,
                                cellsrenderer: function(row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit_lawyer_bill_edit(' + dataRecord.id + ',' + editrow + ',\'staff_conveyance\')" ><img align="center" src="<?= base_url() ?>images/edit-new.png"></div>';
                                }
                            },
                        <? } ?> {
                            text: 'P',
                            menu: false,
                            datafield: 'Preview',
                            align: 'center',
                            editable: false,
                            sortable: false,
                            width: '2%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'details\',' + editrow + ',' + dataRecord.cma_id + ')" ><img align="center" src="<?= base_url() ?>images/view_detail.png"></div>';

                            }
                        },


                        {
                            text: 'Proposed Type',
                            datafield: 'proposed_type',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',


                        },


                        {
                            text: 'Loan A/C',
                            datafield: 'loan_ac',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Amount',
                            datafield: 'amount',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Transition Date',
                            datafield: 'txrn_dt',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Case Number',
                            datafield: 'case_number',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },


                        {
                            text: 'Vendor Name',
                            datafield: 'vendor_name_search',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },

                        {
                            text: 'CIF',
                            datafield: 'cif',
                            editable: false,
                            width: '15%',
                            align: 'left',

                        },
                        {
                            text: 'A/C Name',
                            datafield: 'ac_name',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Region',
                            datafield: 'region',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'District',
                            datafield: 'district',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },

                    ],
                });
            };
            // Jqx tab second tab function start    Grid Show
            var initWidgets = function(tab) {
                switch (tab) {
                    case 0:
                        initGrid();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({
                width: '99%',
                initTabContent: initWidgets
            });
            jQuery('#jqxTabs').bind('selected', function(event) {
                jQuery('#suit_file_form').jqxValidator('hide');
                if (event.args.item == 1) {
                    //clear_form();
                    jQuery('#jqxTabs').jqxTabs('disableAt', 0);
                }
            });
            jQuery('#jqxTabs').jqxTabs('select', 1);
            //End check box update 
            jQuery("#details").jqxWindow({
                theme: theme,
                width: '75%',
                height: '90%',
                resizable: false,
                isModal: true,
                autoOpen: false,
                cancelButton: jQuery("#codeOK")
            });
            jQuery('#details').on('close', function(event) {
                jQuery('#action_form').jqxValidator('hide');
            });
        });


        function change_caption_grid() {
            if (jQuery("#proposed_type_grid").val() == '') {
                document.getElementById("loan_ac_grid").disabled = true;
                jQuery("#l_or_c_no_grid").html('Loan A/C or Card');
            } else {
                document.getElementById("loan_ac_grid").disabled = false;
                var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
                if (item.value == 'Loan') {
                    jQuery("#l_or_c_no_grid").html('Loan A/C ');
                } else if (item.value == 'Card') {
                    jQuery("#l_or_c_no_grid").html('Card');
                }
            }

        }

        function mask_grid(str, textbox) {
            var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
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
                        jQuery("#hidden_loan_ac_grid").val(str);
                    } else //For single value enter
                    {
                        //For New value
                        var orginal_loan_ac = jQuery("#hidden_loan_ac_grid").val();
                        if (orginal_loan_ac.length < str.length) {
                            var index = str.length - 1;
                            var new_val = str.slice(index);
                            orginal_loan_ac += new_val;
                            //alert(orginal_loan_ac);
                            jQuery("#hidden_loan_ac_grid").val(orginal_loan_ac);
                        }
                        //For delete key
                        else {
                            var len = str.length;
                            var new_val = orginal_loan_ac.slice(0, len);
                            jQuery("#hidden_loan_ac_grid").val(new_val);
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
                            if (letter_Count < 6 || jQuery("#hidden_loan_ac_grid").val().length != 16) {
                                textbox.value = '';
                                jQuery("#hidden_loan_ac_grid").val('');
                                alert('Wrong way to input Card No please try again');
                            }
                        }
                    }
                }
            }

        }

        function search_data() {
            jQuery("#jqxgrid").jqxGrid('updatebounddata');
            return;

        }
        function details(id, operation, indx, cma_id, proposed_type, sec_sts) {
            jQuery('#deleteEventId').val(id);
            jQuery('#type').val(operation);

            if (operation == 'details') {
                jQuery("#header_title").html('Lawyer Bill Details');
                jQuery('#sendtochecker_row').hide();
                jQuery('#delete_row').hide();
                jQuery('#close_btn_row').show();
                jQuery('#lawyer_notification_row').hide();
                jQuery('#authorization_row').hide();
                jQuery('#confirm_row').hide();
                jQuery('#reassign_row').hide();
                jQuery('#closeaccount_row').hide();
                jQuery('#next_date_row').hide();
                jQuery('#reassign_row').hide();
                jQuery('#reassign_approval_row').hide();
                jQuery('#putup_row').hide();
                jQuery('#putup_approval_row').hide();
            }
            jQuery('#loading_preview').show();
            jQuery('#loading_p').show();
            jQuery('#details_table').hide();
            jQuery("#details").jqxWindow('open');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?= base_url() ?>Bill_data_edit/lawyer_bill_details",
                data: {
                    [csrfName]: csrfHash,
                    id: id,
                },
                datatype: "json",
                success: function(response) {
                    //alert(response);
                    var json = jQuery.parseJSON(response);

                    jQuery('.txt_csrfname').val(json.csrf_token);

                    document.getElementById("details").style.visibility = 'visible';
                    jQuery("#main_body").html(json['str']);
                    jQuery('#loading_preview').hide();
                    jQuery('#loading_p').hide();
                    jQuery('#details_table').show();
                    jQuery("#details").jqxWindow('open');


                }
            });
        }
        function get_user_data_region_wise() {
            var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
            if (item != null) {
                var legal_region = item.value;
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery.ajax({
                    url: '<?= base_url() ?>index.php/hoops/get_dropdown_data',
                    async: false,
                    type: "post",
                    data: {
                        [csrfName]: csrfHash,
                        legal_region: legal_region
                    },
                    datatype: "json",
                    success: function(response) {
                        var json = jQuery.parseJSON(response);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        var str = '';
                        var theme = getDemoTheme();
                        var legal_user = [];
                        jQuery.each(json['legal_user'], function(key, obj) {
                            legal_user.push({
                                value: obj.id,
                                label: obj.name + ' (' + obj.pin + ')'
                            });
                            //alert(obj.name);
                        });
                        jQuery("#legal_user").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select legal user",
                            source: legal_user,
                            width: 215,
                            height: 25
                        });
                        jQuery('#legal_user').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                        });
                        var legal_district = [];
                        jQuery.each(json['legal_district'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#new_legal_district").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select District",
                            source: legal_district,
                            width: 215,
                            height: 25
                        });
                        jQuery('#new_legal_district').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                        });

                    },
                    error: function(model, xhr, options) {
                        alert('failed');
                    },
                });
            } else {
                jQuery("#legal_user").jqxComboBox('clearSelection');
                jQuery("input[name='legal_user']").val('');
            }
        }
        function change_vendor_type_grid() {
            var type = jQuery("#vendor_type_grid").jqxComboBox('getSelectedItem');
            if (type != null) {
                jQuery("#paper_vendor_grid").jqxComboBox('clearSelection');
                jQuery("input[name='paper_vendor_grid']").val('');
                if (type.value == 'Vendor') {
                    jQuery("#paper_vendor_grid").show();
                    jQuery("#staff_grid").hide();
                } else {
                    jQuery("#paper_vendor_grid").hide();
                    jQuery("#staff_grid").show();
                }
            }
        }
    </script>
    <div id="container">
        <div id="body">
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('bill_data_edit/pages/left_side_nav'); ?>
                        <!----====== Left Side Menu End==========----->

                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                            <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Data Grid</li>
                                </ul>

                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 0.5%;width:98%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">

                                        <input type="hidden" id="hidden_loan_ac_grid" value="" name="hidden_loan_ac_grid">
                                        <table id="deal_body" style="display:block;width:100%">

                                            <tr>

                                            <td style="text-align:right;width:5%"><strong>Staff &nbsp;&nbsp;</strong> </td>
                                                <td style="width:7%">
                                                    <div style="padding-left:1.8%" id="staff_grid_conv" name="staff_grid_conv"></div>
                                            </td>

                                            <td style="text-align:right;width:7%"><strong>Case No.&nbsp;&nbsp;</strong> </td>
                                            <td style="width:10%"><input name="case_number_grid" tabindex="" type="text" class="" maxlength="" size="" style="width:180px" id="case_number_grid" value="" onKeyUp="" /></td>



                                            
                                            <td style="text-align:right;width:9%"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                                <td style="width:10%">
                                                    <div style="padding-left:1.8%" id="proposed_type_grid" name="proposed_type_grid"></div>
                                                </td>
                                                <td style="text-align:right;width:8%"><strong><span id="l_or_c_no_grid"></span> No.</strong></td>
                                                <td style="width:10%"><input name="loan_ac_grid" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac_grid" value="" onKeyUp="javascript:return mask_grid(this.value,this);" /></td>



                                            <td style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                <span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                            </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div style="border:none;" id="jqxgrid"></div>
                                    <div style="float:left;padding-top: 5px;">
                                        <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">

                                        <?php if (EDITSTAFF == 1) { ?> 
                                            <strong>E = </strong>Edit,&nbsp;
                                        <?php } ?>
                                            <strong>P = </strong> Preview&nbsp;
                                        </div> <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div id="details" style="visibility:hidden;">
        <div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>
        <form method="POST" name="action_form" id="action_form" style="margin:0px;">
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <input name="cif" id="cif" value="" type="hidden">
            <input name="pre_legal_user" id="pre_legal_user" value="" type="hidden">
            <input name="sec_sts" id="sec_sts" value="" type="hidden">
            <input name="proposed_type" id="proposed_type" value="" type="hidden">
            <div id="loading_preview" style="text-align:center">
                <span id="loading_p" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
            </div>
            <div style="" id="details_table">
                &nbsp;&nbsp;&nbsp;<img onClick="printpage('preview_table','gurantor_table','suit_file','facility_card','proposed_type_d')" style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?= base_url() ?>old_assets/images/Print.png" alt="print-preview" />
                <span id="main_body"></span>
                <br>
                <div id="preview_table"></div>
                <div id="gurantor_table"></div>
                <div id="facility_card"></div>
                <div id="proposed_type_d"></div>
                <div id="close_btn_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <input type="button" class="button6" id="codeOK" value="Close" />
                </div>
            </div>
        </form>
    </div>





<?php } else if ($operation == 'bill_data_edit/court_entertainment') { ?>


    <script type="text/javascript">





        function edit_lawyer_bill_edit(id, index = null, option = null) {
            jQuery("#jqxgrid").jqxGrid('clearselection');
            EOL.messageBoard.open('<?= base_url() ?>Bill_data_edit/court_entertainment_form/' + id + '/' + index + '/' + option, (jQuery(window).width() - 150), jQuery(window).height(), 'yes');
            return false;

        }

        var theme = getDemoTheme();
        var proposed_type = ["Loan", "Card"];

        var legal_region = [<? $i = 1;
                            foreach ($legal_region as $row) {
                                if ($i != 1) {
                                    echo ',';
                                }
                                echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                $i++;
                            } ?>];
        var case_sts_grid = [<? $i = 1;
                                foreach ($case_sts as $row) {
                                    if ($i != 1) {
                                        echo ',';
                                    }
                                    echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                    $i++;
                                } ?>];

                var staff_grid_conv = [<? $i = 1;
                        foreach ($staff_grid_conv as $row) {
                            if ($i != 1) {
                                echo ',';
                            }
                            echo '{value:"' . $row->id . '", label:"' . $row->name ."($row->pin)".'"}';
                            $i++;
                        } ?>];





        jQuery(document).ready(function() {
            var theme = 'classic';
            var legal_district = [];
            var court = [];



            jQuery("#staff_grid_conv").jqxComboBox({
                theme: theme,
                width: 180,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Staff",
                source: staff_grid_conv,
                height: 25
            });


            
            jQuery("#proposed_type_grid").jqxComboBox({
                theme: theme,
                width: 180,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Proposed Type",
                source: proposed_type,
                height: 25
            });

                                    
            jQuery("#proposed_type_grid").jqxComboBox('val', 'Loan');
            change_caption_grid();

            jQuery('#proposed_type_grid').bind('change', function(event) {
                jQuery("#loan_ac_grid").val('');
                jQuery("#hidden_loan_ac_grid").val('');
                change_caption_grid();
            });
        
            jQuery('#req_type_grid,paper_vendor_grid,#staff_grid_conv').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });

  

            var initGrid = function() {
                var source = {
                    datatype: "json",
                    datafields: [{
                            name: 'id',
                            type: 'int'
                        },
                        {
                            name: 'vendor_name_search',
                            type: 'string'
                        },
                        {
                            name: 'proposed_type',
                            type: 'string'
                        },
                        {
                            name: 'loan_ac',
                            type: 'string'
                        },
                        {
                            name: 'cif',
                            type: 'string'
                        },
                        {
                            name: 'ac_name',
                            type: 'string'
                        },
                        {
                            name: 'region',
                            type: 'string'
                        },
                        {
                            name: 'district',
                            type: 'string'
                        },
                        {
                            name: 'amount',
                            type: 'string'
                        },
                        {
                            name: 'txrn_dt',
                            type: 'string'
                        },
                        {
                            name: 'case_number',
                            type: 'string'
                        },

                    ],
                    addrow: function(rowid, rowdata, position, commit) {
                        commit(true);
                    },
                    deleterow: function(rowid, commit) {
                        commit(true);
                    },
                    updaterow: function(rowid, newdata, commit) {
                        commit(true);
                    },
                    url: '<?= base_url() ?>index.php/bill_data_edit/court_entertainment_grid',
                    cache: false,
                    filter: function() {
                        // update the grid and send a request to the server.
                        jQuery("#jqxgrid").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function() {
                        // update the grid and send a request to the server.
                        jQuery("#jqxgrid").jqxGrid('updatebounddata', 'sort');
                    },
                    root: 'Rows',
                    beforeprocessing: function(data) {
                        if (data != null) {
                            //alert(data[0].TotalRows)
                            source.totalrecords = data[0].TotalRows;
                        }
                    }

                };

                var dataadapter = new jQuery.jqx.dataAdapter(source, {
                    loadError: function(xhr, status, error) {
                        alert(error);
                    },
                    formatData: function(data) {



                        var staff_grid_conv = jQuery.trim(jQuery('input[name=staff_grid_conv]').val());
                        var case_number = jQuery.trim(jQuery('#case_number_grid').val());

                        
                        var proposed_type = jQuery.trim(jQuery('input[name=proposed_type_grid]').val());

                        var loan_ac = jQuery.trim(jQuery('#loan_ac_grid').val());
                        var hidden_loan_ac = jQuery.trim(jQuery('#hidden_loan_ac_grid').val());


                        var txrn_dt_from = jQuery.trim(jQuery('#txrn_dt_from').val());
						var txrn_dt_to = jQuery.trim(jQuery('#txrn_dt_to').val());



                        jQuery.extend(data, {
                            staff_grid_conv: staff_grid_conv,
                            case_number: case_number,
                            proposed_type: proposed_type,
                            loan_ac: loan_ac,
                            hidden_loan_ac: hidden_loan_ac,
                            txrn_dt_from: txrn_dt_from,
                        txrn_dt_to: txrn_dt_to,
                        });
                        return data;
                    }
                });


                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function(row, datafield, columntype) {
                    var checked = jQuery('#jqxgrid').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                        return false;
                    };
                };

                var win_h = jQuery(window).height() - 320;
                jQuery("#jqxgrid").jqxGrid({
                    width: '99%',
                    height: win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    rowdetails: false,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj) {
                        return obj.data;
                    },

                    columns: [{
                            text: 'Id',
                            datafield: 'id',
                            hidden: true,
                            editable: false,
                            width: '4%'
                        },
                        <? if (EDITCOURT_ENT == 1) { ?> {
                                text: 'E',
                                datafield: 'lawyer_bill_edit',
                                editable: false,
                                align: 'center',
                                sortable: false,
                                menu: false,
                                width: 35,
                                cellsrenderer: function(row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit_lawyer_bill_edit(' + dataRecord.id + ',' + editrow + ',\'court_entertainment\')" ><img align="center" src="<?= base_url() ?>images/edit-new.png"></div>';
                                }
                            },
                        <? } ?> {
                            text: 'P',
                            menu: false,
                            datafield: 'Preview',
                            align: 'center',
                            editable: false,
                            sortable: false,
                            width: '2%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'details\',' + editrow + ',' + dataRecord.cma_id + ')" ><img align="center" src="<?= base_url() ?>images/view_detail.png"></div>';

                            }
                        },


                        {
                            text: 'Proposed Type',
                            datafield: 'proposed_type',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',


                        },


                        {
                            text: 'Loan A/C',
                            datafield: 'loan_ac',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Amount',
                            datafield: 'amount',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Transition Date',
                            datafield: 'txrn_dt',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Case Number',
                            datafield: 'case_number',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },


                        {
                            text: 'Vendor Name',
                            datafield: 'vendor_name_search',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },

                        {
                            text: 'CIF',
                            datafield: 'cif',
                            editable: false,
                            width: '15%',
                            align: 'left',

                        },
                        {
                            text: 'A/C Name',
                            datafield: 'ac_name',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Region',
                            datafield: 'region',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'District',
                            datafield: 'district',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },

                    ],
                });
            };
            // Jqx tab second tab function start    Grid Show
            var initWidgets = function(tab) {
                switch (tab) {
                    case 0:
                        initGrid();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({
                width: '99%',
                initTabContent: initWidgets
            });
            jQuery('#jqxTabs').bind('selected', function(event) {
                jQuery('#suit_file_form').jqxValidator('hide');
                if (event.args.item == 1) {
                    //clear_form();
                    jQuery('#jqxTabs').jqxTabs('disableAt', 0);
                }
            });
            jQuery('#jqxTabs').jqxTabs('select', 1);
            //End check box update 
            jQuery("#details").jqxWindow({
                theme: theme,
                width: '75%',
                height: '90%',
                resizable: false,
                isModal: true,
                autoOpen: false,
                cancelButton: jQuery("#codeOK")
            });
            jQuery('#details').on('close', function(event) {
                jQuery('#action_form').jqxValidator('hide');
            });
        });



        function change_caption_grid() {
            if (jQuery("#proposed_type_grid").val() == '') {
                document.getElementById("loan_ac_grid").disabled = true;
                jQuery("#l_or_c_no_grid").html('Loan A/C or Card');
            } else {
                document.getElementById("loan_ac_grid").disabled = false;
                var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
                if (item.value == 'Loan') {
                    jQuery("#l_or_c_no_grid").html('Loan A/C ');
                } else if (item.value == 'Card') {
                    jQuery("#l_or_c_no_grid").html('Card');
                }
            }

        }
    
            function mask_grid(str, textbox) {
                var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
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
                            jQuery("#hidden_loan_ac_grid").val(str);
                        } else //For single value enter
                        {
                            //For New value
                            var orginal_loan_ac = jQuery("#hidden_loan_ac_grid").val();
                            if (orginal_loan_ac.length < str.length) {
                                var index = str.length - 1;
                                var new_val = str.slice(index);
                                orginal_loan_ac += new_val;
                                //alert(orginal_loan_ac);
                                jQuery("#hidden_loan_ac_grid").val(orginal_loan_ac);
                            }
                            //For delete key
                            else {
                                var len = str.length;
                                var new_val = orginal_loan_ac.slice(0, len);
                                jQuery("#hidden_loan_ac_grid").val(new_val);
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
                                if (letter_Count < 6 || jQuery("#hidden_loan_ac_grid").val().length != 16) {
                                    textbox.value = '';
                                    jQuery("#hidden_loan_ac_grid").val('');
                                    alert('Wrong way to input Card No please try again');
                                }
                            }
                        }
                    }
                }
    
            }


        function search_data() {
            jQuery("#jqxgrid").jqxGrid('updatebounddata');
            return;

        }
        function details(id, operation, indx, cma_id, proposed_type, sec_sts) {
            jQuery('#deleteEventId').val(id);
            jQuery('#type').val(operation);

            if (operation == 'details') {
                jQuery("#header_title").html('Lawyer Bill Details');
                jQuery('#sendtochecker_row').hide();
                jQuery('#delete_row').hide();
                jQuery('#close_btn_row').show();
                jQuery('#lawyer_notification_row').hide();
                jQuery('#authorization_row').hide();
                jQuery('#confirm_row').hide();
                jQuery('#reassign_row').hide();
                jQuery('#closeaccount_row').hide();
                jQuery('#next_date_row').hide();
                jQuery('#reassign_row').hide();
                jQuery('#reassign_approval_row').hide();
                jQuery('#putup_row').hide();
                jQuery('#putup_approval_row').hide();
            }
            jQuery('#loading_preview').show();
            jQuery('#loading_p').show();
            jQuery('#details_table').hide();
            jQuery("#details").jqxWindow('open');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?= base_url() ?>Bill_data_edit/lawyer_bill_details",
                data: {
                    [csrfName]: csrfHash,
                    id: id,
                },
                datatype: "json",
                success: function(response) {
                    //alert(response);
                    var json = jQuery.parseJSON(response);

                    jQuery('.txt_csrfname').val(json.csrf_token);

                    document.getElementById("details").style.visibility = 'visible';
                    jQuery("#main_body").html(json['str']);
                    jQuery('#loading_preview').hide();
                    jQuery('#loading_p').hide();
                    jQuery('#details_table').show();
                    jQuery("#details").jqxWindow('open');


                }
            });
        }
        function get_user_data_region_wise() {
            var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
            if (item != null) {
                var legal_region = item.value;
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery.ajax({
                    url: '<?= base_url() ?>index.php/hoops/get_dropdown_data',
                    async: false,
                    type: "post",
                    data: {
                        [csrfName]: csrfHash,
                        legal_region: legal_region
                    },
                    datatype: "json",
                    success: function(response) {
                        var json = jQuery.parseJSON(response);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        var str = '';
                        var theme = getDemoTheme();
                        var legal_user = [];
                        jQuery.each(json['legal_user'], function(key, obj) {
                            legal_user.push({
                                value: obj.id,
                                label: obj.name + ' (' + obj.pin + ')'
                            });
                            //alert(obj.name);
                        });
                        jQuery("#legal_user").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select legal user",
                            source: legal_user,
                            width: 215,
                            height: 25
                        });
                        jQuery('#legal_user').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                        });
                        var legal_district = [];
                        jQuery.each(json['legal_district'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#new_legal_district").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select District",
                            source: legal_district,
                            width: 215,
                            height: 25
                        });
                        jQuery('#new_legal_district').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                        });

                    },
                    error: function(model, xhr, options) {
                        alert('failed');
                    },
                });
            } else {
                jQuery("#legal_user").jqxComboBox('clearSelection');
                jQuery("input[name='legal_user']").val('');
            }
        }
        function change_vendor_type_grid() {
            var type = jQuery("#vendor_type_grid").jqxComboBox('getSelectedItem');
            if (type != null) {
                jQuery("#paper_vendor_grid").jqxComboBox('clearSelection');
                jQuery("input[name='paper_vendor_grid']").val('');
                if (type.value == 'Vendor') {
                    jQuery("#paper_vendor_grid").show();
                    jQuery("#staff_grid").hide();
                } else {
                    jQuery("#paper_vendor_grid").hide();
                    jQuery("#staff_grid").show();
                }
            }
        }
    </script>
    <div id="container">
        <div id="body">
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('bill_data_edit/pages/left_side_nav'); ?>
                        <!----====== Left Side Menu End==========----->

                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                            <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Data Grid</li>
                                </ul>

                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 0.5%;width:98%;height:100px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">

                                        <input type="hidden" id="hidden_loan_ac_grid" value="" name="hidden_loan_ac_grid">
                                        <table id="deal_body" style="display:block;width:100%">

                                            <tr>

                                            <td style="text-align:right;width:5%"><strong>Staff &nbsp;&nbsp;</strong> </td>
                                                <td style="width:7%">
                                                    <div style="padding-left:1.8%" id="staff_grid_conv" name="staff_grid_conv"></div>
                                            </td>

                                            <td style="text-align:right;width:7%"><strong>Case No.&nbsp;&nbsp;</strong> </td>
                                            <td style="width:10%"><input name="case_number_grid" tabindex="" type="text" class="" maxlength="" size="" style="width:180px" id="case_number_grid" value="" onKeyUp="" /></td>



                                                                                        
            <td style="text-align:right;width:9%"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
            <td style="width:10%">
                <div style="padding-left:1.8%" id="proposed_type_grid" name="proposed_type_grid"></div>
            </td>
            <td style="text-align:right;width:8%"><strong><span id="l_or_c_no_grid"></span> No.</strong></td>
            <td style="width:10%"><input name="loan_ac_grid" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac_grid" value="" onKeyUp="javascript:return mask_grid(this.value,this);" /></td>




                                            <td style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                <span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                            </td>
                                            </tr>

                                            
                     <tr>
                            <td style="text-align:right;width:17%"><strong>Txrn Date&nbsp;&nbsp;</strong> </td>
                            <td style="width:30%"><input id="txrn_dt_from" name="txrn_dt_from" style="width:40%" /><script type="text/javascript">datePicker("txrn_dt_from");</script>
                            <strong>To</strong> <input id="txrn_dt_to" name="txrn_dt_to" style="width:40%" /><script type="text/javascript" >datePicker("txrn_dt_to");</script>
                            </td>
                    </tr>


                                        </table>
                                    </div>
                                    <div style="border:none;" id="jqxgrid"></div>
                                    <div style="float:left;padding-top: 5px;">
                                        <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">

                                        <?php if (EDITCOURT_ENT == 1) { ?> 
                                            <strong>E = </strong>Edit,&nbsp;
                                        <?php } ?>
                                            <strong>P = </strong> Preview&nbsp;
                                        </div> <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div id="details" style="visibility:hidden;">
        <div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>
        <form method="POST" name="action_form" id="action_form" style="margin:0px;">
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <input name="cif" id="cif" value="" type="hidden">
            <input name="pre_legal_user" id="pre_legal_user" value="" type="hidden">
            <input name="sec_sts" id="sec_sts" value="" type="hidden">
            <input name="proposed_type" id="proposed_type" value="" type="hidden">
            <div id="loading_preview" style="text-align:center">
                <span id="loading_p" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
            </div>
            <div style="" id="details_table">
                &nbsp;&nbsp;&nbsp;<img onClick="printpage('preview_table','gurantor_table','suit_file','facility_card','proposed_type_d')" style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?= base_url() ?>old_assets/images/Print.png" alt="print-preview" />
                <span id="main_body"></span>
                <br>
                <div id="preview_table"></div>
                <div id="gurantor_table"></div>
                <div id="facility_card"></div>
                <div id="proposed_type_d"></div>
                <div id="close_btn_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <input type="button" class="button6" id="codeOK" value="Close" />
                </div>
            </div>
        </form>
    </div>


<?php } else if ($operation == 'bill_data_edit/others'){ ?>




    
    <script type="text/javascript">


        function edit_lawyer_bill_edit(id, index = null, option = null) {
            jQuery("#jqxgrid").jqxGrid('clearselection');
            EOL.messageBoard.open('<?= base_url() ?>Bill_data_edit/others_form/' + id + '/' + index + '/' + option, (jQuery(window).width() - 150), jQuery(window).height(), 'yes');
            return false;

        }

        var activities_grid = [<? $i = 1;
                                    foreach ($activities_grid as $row) {
                                        if ($i != 1) {
                                            echo ',';
                                        }
                                        echo '{value:"' . $row->id . '", label:"' . $row->name . '"}';
                                        $i++;
                                    } ?>];



        var theme = getDemoTheme();

        jQuery(document).ready(function() {
            var theme = 'classic';


            jQuery("#activities_grid").jqxComboBox({
                theme: theme,
                width: 180,
                autoOpen: false,
                autoDropDownHeight: false,
                promptText: "Activities",
                source: activities_grid,
                height: 25
            });


            // activities_grid

            var initGrid = function() {
                var source = {
                    datatype: "json",
                    datafields: [{
                            name: 'id',
                            type: 'int'
                        },
                        {
                            name: 'vendor_name_search',
                            type: 'string'
                        },
                        {
                            name: 'proposed_type',
                            type: 'string'
                        },
                        {
                            name: 'loan_ac',
                            type: 'string'
                        },
                        {
                            name: 'cif',
                            type: 'string'
                        },
                        {
                            name: 'ac_name',
                            type: 'string'
                        },
                        {
                            name: 'region',
                            type: 'string'
                        },
                        {
                            name: 'district',
                            type: 'string'
                        },
                        {
                            name: 'amount',
                            type: 'string'
                        },
                        {
                            name: 'txrn_dt',
                            type: 'string'
                        },
                        {
                            name: 'case_number',
                            type: 'string'
                        },

                    ],
                    addrow: function(rowid, rowdata, position, commit) {
                        commit(true);
                    },
                    deleterow: function(rowid, commit) {
                        commit(true);
                    },
                    updaterow: function(rowid, newdata, commit) {
                        commit(true);
                    },
                    url: '<?= base_url() ?>index.php/bill_data_edit/others_grid',
                    cache: false,
                    filter: function() {
                        // update the grid and send a request to the server.
                        jQuery("#jqxgrid").jqxGrid('updatebounddata', 'filter');
                    },
                    sort: function() {
                        // update the grid and send a request to the server.
                        jQuery("#jqxgrid").jqxGrid('updatebounddata', 'sort');
                    },
                    root: 'Rows',
                    beforeprocessing: function(data) {
                        if (data != null) {
                            //alert(data[0].TotalRows)
                            source.totalrecords = data[0].TotalRows;
                        }
                    }

                };

                var dataadapter = new jQuery.jqx.dataAdapter(source, {
                    loadError: function(xhr, status, error) {
                        alert(error);
                    },
                    formatData: function(data) {

                        var vendor_name = jQuery.trim(jQuery('input[name=vendor_name]').val());
                        var activities_grid = jQuery.trim(jQuery('#activities_grid').val());
                        var txrn_dt_from = jQuery.trim(jQuery('#txrn_dt_from').val());
						var txrn_dt_to = jQuery.trim(jQuery('#txrn_dt_to').val());


                        jQuery.extend(data, {
                            vendor_name: vendor_name,
                            activities_grid: activities_grid,
                            txrn_dt_from: txrn_dt_from,
                            txrn_dt_to: txrn_dt_to,
                        });
                        return data;
                    }
                });


                var columnCheckBox = null;
                var updatingCheckState = false;
                // initialize jqxGrid. Disable the built-in selection.
                var celledit = function(row, datafield, columntype) {
                    var checked = jQuery('#jqxgrid').jqxGrid('getcellvalue', row, "available");
                    if (checked == false) {
                        return false;
                    };
                };

                var win_h = jQuery(window).height() - 320;
                jQuery("#jqxgrid").jqxGrid({
                    width: '99%',
                    height: win_h,
                    source: dataadapter,
                    theme: theme,
                    filterable: true,
                    sortable: true,
                    pageable: true,
                    virtualmode: true,
                    editable: true,
                    rowdetails: false,
                    enablebrowserselection: true,
                    selectionmode: 'none',
                    rendergridrows: function(obj) {
                        return obj.data;
                    },

                    columns: [{
                            text: 'Id',
                            datafield: 'id',
                            hidden: true,
                            editable: false,
                            width: '4%'
                        },
                        <? if (OTHERSEDIT == 1) { ?> {
                                text: 'E',
                                datafield: 'lawyer_bill_edit',
                                editable: false,
                                align: 'center',
                                sortable: false,
                                menu: false,
                                width: 35,
                                cellsrenderer: function(row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit_lawyer_bill_edit(' + dataRecord.id + ',' + editrow + ',\'others\')" ><img align="center" src="<?= base_url() ?>images/edit-new.png"></div>';
                                }
                            },
                        <? } ?> {
                            text: 'P',
                            menu: false,
                            datafield: 'Preview',
                            align: 'center',
                            editable: false,
                            sortable: false,
                            width: '2%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details(' + dataRecord.id + ',\'details\',' + editrow + ',' + dataRecord.cma_id + ')" ><img align="center" src="<?= base_url() ?>images/view_detail.png"></div>';

                            }
                        },


                        {
                            text: 'Proposed Type',
                            datafield: 'proposed_type',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',


                        },


                        {
                            text: 'Loan A/C',
                            datafield: 'loan_ac',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Amount',
                            datafield: 'amount',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Transition Date',
                            datafield: 'txrn_dt',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Case Number',
                            datafield: 'case_number',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },


                        {
                            text: 'Vendor Name',
                            datafield: 'vendor_name_search',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },

                        {
                            text: 'CIF',
                            datafield: 'cif',
                            editable: false,
                            width: '15%',
                            align: 'left',

                        },
                        {
                            text: 'A/C Name',
                            datafield: 'ac_name',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'Region',
                            datafield: 'region',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },
                        {
                            text: 'District',
                            datafield: 'district',
                            editable: false,
                            width: '15%',
                            align: 'left',
                            cellsalign: 'left',

                        },

                    ],
                });
            };
            // Jqx tab second tab function start    Grid Show
            var initWidgets = function(tab) {
                switch (tab) {
                    case 0:
                        initGrid();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({
                width: '99%',
                initTabContent: initWidgets
            });
            jQuery('#jqxTabs').bind('selected', function(event) {
                jQuery('#suit_file_form').jqxValidator('hide');
                if (event.args.item == 1) {
                    //clear_form();
                    jQuery('#jqxTabs').jqxTabs('disableAt', 0);
                }
            });
            jQuery('#jqxTabs').jqxTabs('select', 1);
            //End check box update 
            jQuery("#details").jqxWindow({
                theme: theme,
                width: '75%',
                height: '90%',
                resizable: false,
                isModal: true,
                autoOpen: false,
                cancelButton: jQuery("#codeOK")
            });
            jQuery('#details').on('close', function(event) {
                jQuery('#action_form').jqxValidator('hide');
            });
        });




        function search_data() {
            jQuery("#jqxgrid").jqxGrid('updatebounddata');
            return;

        }
        function details(id, operation, indx, cma_id, proposed_type, sec_sts) {
            jQuery('#deleteEventId').val(id);
            jQuery('#type').val(operation);

            if (operation == 'details') {
                jQuery("#header_title").html('Lawyer Bill Details');
                jQuery('#sendtochecker_row').hide();
                jQuery('#delete_row').hide();
                jQuery('#close_btn_row').show();
                jQuery('#lawyer_notification_row').hide();
                jQuery('#authorization_row').hide();
                jQuery('#confirm_row').hide();
                jQuery('#reassign_row').hide();
                jQuery('#closeaccount_row').hide();
                jQuery('#next_date_row').hide();
                jQuery('#reassign_row').hide();
                jQuery('#reassign_approval_row').hide();
                jQuery('#putup_row').hide();
                jQuery('#putup_approval_row').hide();
            }
            jQuery('#loading_preview').show();
            jQuery('#loading_p').show();
            jQuery('#details_table').hide();
            jQuery("#details").jqxWindow('open');
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                url: "<?= base_url() ?>Bill_data_edit/lawyer_bill_details",
                data: {
                    [csrfName]: csrfHash,
                    id: id,
                },
                datatype: "json",
                success: function(response) {
                    //alert(response);
                    var json = jQuery.parseJSON(response);

                    jQuery('.txt_csrfname').val(json.csrf_token);

                    document.getElementById("details").style.visibility = 'visible';
                    jQuery("#main_body").html(json['str']);
                    jQuery('#loading_preview').hide();
                    jQuery('#loading_p').hide();
                    jQuery('#details_table').show();
                    jQuery("#details").jqxWindow('open');


                }
            });
        }
        function get_user_data_region_wise() {
            var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
            if (item != null) {
                var legal_region = item.value;
                var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
                jQuery.ajax({
                    url: '<?= base_url() ?>index.php/hoops/get_dropdown_data',
                    async: false,
                    type: "post",
                    data: {
                        [csrfName]: csrfHash,
                        legal_region: legal_region
                    },
                    datatype: "json",
                    success: function(response) {
                        var json = jQuery.parseJSON(response);
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        var str = '';
                        var theme = getDemoTheme();
                        var legal_user = [];
                        jQuery.each(json['legal_user'], function(key, obj) {
                            legal_user.push({
                                value: obj.id,
                                label: obj.name + ' (' + obj.pin + ')'
                            });
                            //alert(obj.name);
                        });
                        jQuery("#legal_user").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select legal user",
                            source: legal_user,
                            width: 215,
                            height: 25
                        });
                        jQuery('#legal_user').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                        });
                        var legal_district = [];
                        jQuery.each(json['legal_district'], function(key, obj) {
                            legal_district.push({
                                value: obj.id,
                                label: obj.name
                            });
                            //alert(obj.name);
                        });
                        jQuery("#new_legal_district").jqxComboBox({
                            theme: theme,
                            autoOpen: false,
                            autoDropDownHeight: false,
                            promptText: "Select District",
                            source: legal_district,
                            width: 215,
                            height: 25
                        });
                        jQuery('#new_legal_district').focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                        });

                    },
                    error: function(model, xhr, options) {
                        alert('failed');
                    },
                });
            } else {
                jQuery("#legal_user").jqxComboBox('clearSelection');
                jQuery("input[name='legal_user']").val('');
            }
        }
        function change_vendor_type_grid() {
            var type = jQuery("#vendor_type_grid").jqxComboBox('getSelectedItem');
            if (type != null) {
                jQuery("#paper_vendor_grid").jqxComboBox('clearSelection');
                jQuery("input[name='paper_vendor_grid']").val('');
                if (type.value == 'Vendor') {
                    jQuery("#paper_vendor_grid").show();
                    jQuery("#staff_grid").hide();
                } else {
                    jQuery("#paper_vendor_grid").hide();
                    jQuery("#staff_grid").show();
                }
            }
        }
    </script>
    <div id="container">
        <div id="body">
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('bill_data_edit/pages/left_side_nav'); ?>
                        <!----====== Left Side Menu End==========----->

                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                            <div id="loding"></div>
                        </div>
                        <div>
                            <div id='jqxTabs'>
                                <ul>
                                    <li style="margin-left: 30px;">Data Grid</li>
                                </ul>

                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="padding: 0.5%;width:98%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">

                                        <input type="hidden" id="hidden_loan_ac_grid" value="" name="hidden_loan_ac_grid">
                                        <table id="deal_body" style="display:block;width:100%">

                                            <tr>

                                            <td style="text-align:right;width:9%"><strong>Vendor Name&nbsp;&nbsp;</strong> </td>
                                            <td style="width:10%"><input name="vendor_name" tabindex="" type="text" class="" maxlength="" size="" style="width:180px" id="vendor_name" value="" onKeyUp="" /></td>


                                            <td style="text-align:right;width:10%"><strong>Activities Name&nbsp;&nbsp;</strong> </td>
                                            <td style="width:10%"><div id="activities_grid" name="activities_grid"></div></td>


                                            <td style="text-align:right;width:7%"><strong>Txrn Date&nbsp;&nbsp;</strong> </td>
                                            <td style="width:30%"><input id="txrn_dt_from" name="txrn_dt_from" style="width:40%" /><script type="text/javascript">datePicker("txrn_dt_from");</script>
                                            <strong>To</strong> <input id="txrn_dt_to" name="txrn_dt_to" style="width:40%" /><script type="text/javascript" >datePicker("txrn_dt_to");</script>
                                            </td>




                                            <td style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                <span id="grid_loading" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
                                            </td>
                                        </tr>
                                        </table>
                                    </div>
                                    <div style="border:none;" id="jqxgrid"></div>
                                    <div style="float:left;padding-top: 5px;">
                                        <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">

                                        <?php if (OTHERSEDIT == 1) { ?> 
                                            <strong>E = </strong>Edit,&nbsp;
                                        <?php } ?>
                                            <strong>P = </strong> Preview&nbsp;
                                        </div> <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div id="details" style="visibility:hidden;">
        <div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>
        <form method="POST" name="action_form" id="action_form" style="margin:0px;">
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <input name="cif" id="cif" value="" type="hidden">
            <input name="pre_legal_user" id="pre_legal_user" value="" type="hidden">
            <input name="sec_sts" id="sec_sts" value="" type="hidden">
            <input name="proposed_type" id="proposed_type" value="" type="hidden">
            <div id="loading_preview" style="text-align:center">
                <span id="loading_p" style="display:none">Please wait... <img src="<?= base_url() ?>images/loader.gif" align="bottom"></span>
            </div>
            <div style="" id="details_table">
                &nbsp;&nbsp;&nbsp;<img onClick="printpage('preview_table','gurantor_table','suit_file','facility_card','proposed_type_d')" style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?= base_url() ?>old_assets/images/Print.png" alt="print-preview" />
                <span id="main_body"></span>
                <br>
                <div id="preview_table"></div>
                <div id="gurantor_table"></div>
                <div id="facility_card"></div>
                <div id="proposed_type_d"></div>
                <div id="close_btn_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <input type="button" class="button6" id="codeOK" value="Close" />
                </div>
            </div>
        </form>
    </div>






<?php } ?>