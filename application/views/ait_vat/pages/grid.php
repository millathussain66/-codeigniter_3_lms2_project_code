<script type="text/javascript" src="<?=base_url()?>js/jquery.ajaxupload.js"></script>

<style>
   

    table, td {
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
    #active{
       background: #93CDDD!important;
       font-weight: bold;
    }

    </style>
    <style type="text/css">
    .button {
      background-color: #4CAF50; /* Green */
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
      background-color: #555555; /* Green */
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;;
      border-radius: 12px;
    }
    .button1 {
      background-color: #555555; /* Green */
      border: none;
      color: white;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;;
      border-radius: 12px;
    }
    .button_delete {
      background-color: #00ffff; /* Green */
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
    table.preview_table2 td, table.preview_table2 th{
            border: 1px solid #c7c7c7;
            word-wrap:break-word;
            padding:5px;
        }
    .button4 {
      background-color: #00ffff;
      color: black;
    }

    .button3,.button4:hover {
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
       .text-input
        {
            height: 23px;
            width: 350px;
        }


        .required
        {
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


        #details td, #details th {
          border: 1px solid #ddd;
          padding: 8px;
        }
        #details  th {
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
            border: 1px solid rgba(0,0,0,.20); 
        }
        .back_image{
        background-image:url(<?=base_url()?>images/login_images/back_1.jpg);
        background-repeat: no-repeat;
        background-color:transparent;
        background-size: auto;
        _background-size: 1108px 763px;
        background-position: -18px 80%;
    }
    #search_area{
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }
    #back_area{
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }
    #grid_search:hover{
        background: #29cdff!important;
    }
    #back:hover{
        background: #29cdff!important;
    }
    .jqx-tabs-header{
        border-color: #93CDDD!important;
        background: #93CDDD!important;
    }
</style>
    <script type="text/javascript">
            var theme = getDemoTheme();
            var lawyer = [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
			var vendor = [<? $i=1; foreach($vendor as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var certificate_type = [<? $i=1; foreach($certificate_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
			var request_from = [<? $i=1; foreach($request_from as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

            jQuery(document).ready(function () {
            //Combobox
            //jQuery('#in_req_button').jqxButton({template:"default",width:"120"});
			jQuery("#certificate_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Certificate Type", source: certificate_type, width: 250, height: 25});
			jQuery("#request_from").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Request From", source: request_from, width: 250, height: 25});
            jQuery('#certificate_type,#request_from,#v_name').focusout(function() {
	           //alert(jQuery(this).attr('id'));
	            commbobox_check(jQuery(this).attr('id'));
	        });

            // attach file code
            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'app_file\')"/>';
            html+='<input type="hidden" id="hidden_app_file_select" name="hidden_app_file_select" value="0">';
            html+='<span id="hidden_app_file">';
            jQuery('#app_file').html(html);
            // end
	        
            jQuery("#request_from").jqxComboBox('val',1);

            jQuery("#v_name").on('change',function(){
                var item = jQuery("#v_name").jqxComboBox('getSelectedItem');
                var request_from = jQuery("#request_from").jqxComboBox('getSelectedItem');
                var add_edit = jQuery('#add_edit').val();
                if(add_edit=='add'){
                if(request_from.value==1){
                    var arr =  [<? $i=1; foreach($lawyer as $row){ if($i!=1){echo ',';} echo '{id:"'.$row->id.'", name:"'.$row->name.'", email:"'.$row->email.'", phone_number:"'.$row->mobile.'", tin_number:"'.$row->tin_number.'", bin_number:"'.$row->bin_number.'"}'; $i++;}?>];
                    //console.log(arr);
                    let obj = arr.find(o => o.id === item.value);
                    jQuery('#tin_number').val(obj.tin_number);
                    jQuery('#bin_number').val(obj.bin_number);
                    jQuery('#email').val(obj.email);
                    jQuery('#phone_number').val(obj.phone_number);
                }else if(request_from.value==2){
                    var arr =  [<? $i=1; foreach($vendor as $row){ if($i!=1){echo ',';} echo '{id:"'.$row->id.'", name:"'.$row->name.'", email:"'.$row->email.'", phone_number:"'.$row->mobile.'", tin_number:"'.$row->tin.'", bin_number:"'.$row->bin.'"}'; $i++;}?>];
                    //console.log(arr);
                    let obj = arr.find(o => o.id === item.value);
                    jQuery('#tin_number').val(obj.tin_number);
                    jQuery('#bin_number').val(obj.bin_number);
                    jQuery('#email').val(obj.email);
                    jQuery('#phone_number').val(obj.phone_number);
                }else{
                    jQuery('#tin_number').val('');
                    jQuery('#bin_number').val('');
                    jQuery('#email').val('');
                    jQuery('#phone_number').val('');
                }
                }
                jQuery('#ait_vat_form').jqxValidator('hide');
                
            });

            jQuery('#ait_vat_form').jqxValidator({
				rules: [
				{ input: '#certificate_type', message: 'Required!', action: 'blur, change', rule: function (input) {
						if(input.val() != '')
						{
							var item = jQuery("#certificate_type").jqxComboBox('getSelectedItem');
							if(item != null){jQuery("input[name='certificate_type']").val(item.value);}
							return true;
						}
						return false;
					}
				},
				{ input: '#request_from', message: 'Required!', action: 'blur, change', rule: function (input) {
						if(input.val() != '')
						{
							var item = jQuery("#request_from").jqxComboBox('getSelectedItem');
							if(item != null){jQuery("input[name='request_from']").val(item.value);}
							return true;
						}
						return false;
					}
				},
				{ input: '#v_name', message: 'Required!', action: 'blur, change', rule: function (input) {
						
						var item2 = jQuery("#request_from").jqxComboBox('getSelectedItem');
						if(item2!=null)
						{
							if (item2.value==1 || item2.value==2) {
									if(input.val() != '')
									{
										var item = jQuery("#v_name").jqxComboBox('getSelectedItem');
										if(item != null){jQuery("input[name='v_name']").val(item.value);}
										return true;
									}
									return false;
							}
							else{
								return true;
							}
						}
						else
						{
							return true;
						}
					}
				},
				{ input: '#oth_name', message: 'Required!', action: 'blur, change', rule: function (input) {
						
						var item2 = jQuery("#request_from").jqxComboBox('getSelectedItem');
						if(item2!=null)
						{
							if (item2.value>2) {
									if(input.val() != '')
									{
										return true;
									}
									return false;
							}
							else{
								return true;
							}
						}
						else
						{
							return true;
						}
					}
				},
                { input: '#tin_number', message: 'Required!', action: 'blur, change', rule: function (input) {
                        
                        if(input.val()!='')
                        {
                            return true;
                        }
                        else
                        {
                            return false;
                        }
                    }
                },
                // { input: '#bin_number', message: 'Required!', action: 'blur, change', rule: function (input) {
                //         if(input.val()!='')
                //         {
                //             return true;
                //         }
                //         else
                //         {
                //             return false;
                //         }
                //     }
                // },
                { input: '#FromDate', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                    }
                    else {
                        return false;
                    }
                } 
                },
                { input: '#FromDate', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
				{ input: '#ToDate', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                    }
                    else {
                        return false;
                    }
                } 
                },
                { input: '#ToDate', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#email', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if (input.val()!='') {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
                }, 
                { input: '#email', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                    //console.log(input.val().split(";"));
                    if (input.val()!='') {
                        var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/;
                        //var re = /\S+@\S+\.\S+/;
                        let arr = input.val().split(";");
                        let check = true;
                        arr.each(function(item,index){
                            //console.log(item);
                            if(item===''){
                                check = true;
                            }else{
                                check = re.test(item);
                            }
                            
                        });
                        return check;
    
                    }else {
                        return false;
                    }
                } 
                },
                { input: '#phone_number', message: 'Phone Number is 11 Digits!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() !=''){
                        valid_number = input.val().length;
                        if(valid_number==11){
                            return true;
                        }else{
                            jQuery("#phone_number").focus();
                            return false;
                        }
                    }else{
                        return true;
                    }
                    }
                },
                { input: '#phone_number', message: 'Invalid Phone Number!', action: 'blur,change', rule: function(input,commit){
                    if(input.val() !=''){
                        valid_number = input.val().match("(01[3-9]\\d{8})");
                        if(valid_number!=null){
                            return true;
                        }else{
                            jQuery("#phone_number").focus();
                            return false;
                        }
                    }else{
                        return true;
                    }
                    }
                },
				]
			});
            jQuery("#delete_button").click(function () {
	            var validationResult = function (isValid) {
					if (isValid) {
						jQuery("#delete_button").hide();
						jQuery("#deletecancel").hide();
						jQuery("#delete_loading").show();
						call_ajax_submit();
					}
				}
				jQuery('#action_form').jqxValidator('validate', validationResult);
	   		 });
            jQuery("#sendtochecker").click(function () {
	    		jQuery("#sendtochecker").hide();
				jQuery("#SendTocheckercancel").hide();
				jQuery("#sendtochecker_loading").show();
	    		call_ajax_submit();
		    	
	   		 });
            jQuery('#action_form').jqxValidator({
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

            var initGrid = function () {
                var source =
                {
                   datatype: "json",
                   datafields: [
                            { name: 'id', type: 'int'},
							{ name: 'checker_id', type: 'int'},
							{ name: 'sts', type: 'string'},
							{ name: 'request_date', type: 'string'},
							{ name: 'inform_date', type: 'string'},
                            { name: 'date_from', type: 'string'},
                            { name: 'date_to', type: 'string'},
                            { name: 'tin_number', type: 'string'},
                            { name: 'bin_number', type: 'string'},
                            { name: 'email', type: 'string'},
                            { name: 'phone_number', type: 'string'},
                            { name: 'remarks', type: 'string'},
                            { name: 'app_file', type: 'string'},
							{ name: 'certificate_rec_dt', type: 'string'},
							{ name: 'certificate_sts', type: 'string'},
							{ name: 'certificate_file', type: 'string'},
							{ name: 'remarks', type: 'string'},
							{ name: 'v_sts', type: 'int'},
							{ name: 'stc_sts', type: 'int'},
							{ name: 'send_head_by', type: 'int'},
							{ name: 'send_head_dt', type: 'int'},
							{ name: 'status_name', type: 'string'},
							{ name: 'venlaw_name', type: 'string'},
							{ name: 'request_name', type: 'string'},
							{ name: 'certificate_name', type: 'string'},
							{ name: 'e_dt', type: 'string'},
							{ name: 'send_fi_dt', type: 'string'},
							{ name: 'receive_head_dt', type: 'string'},
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
                        url: '<?=base_url()?>index.php/ait_vat/grid',
                        cache: false,
                        filter: function()
                        {
                            // update the grid and send a request to the server.
                            jQuery("#jqxgrid").jqxGrid('updatebounddata', 'filter');
                        },
                        sort: function()
                        {
                            // update the grid and send a request to the server.
                            jQuery("#jqxgrid").jqxGrid('updatebounddata', 'sort');
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
                            loadError: function(xhr, status, error)
                            {                       
                                alert(error);
                            }
                        }
                    );
                    var columnCheckBox = null;
                    var updatingCheckState = false;
                    // initialize jqxGrid. Disable the built-in selection.
                    var celledit = function (row, datafield, columntype) {
                        var checked = jQuery('#jqxgrid').jqxGrid('getcellvalue', row, "available");
                        if (checked == false) {
                            return false;
                        };
                    };
                    // set rows details.
                    jQuery("#jqxgrid").bind('bindingcomplete', function (event) {
                        if (event.target.id == "jqxgrid") {
                            jQuery("#jqxgrid").jqxGrid('beginupdate');
                            var datainformation = jQuery("#jqxgrid").jqxGrid('getdatainformation');
                            for (i = 0; i < datainformation.rowscount; i++) {
                                jQuery("#jqxgrid").jqxGrid('setrowdetails', i, "<div id='grid" + i + "' style='margin: 10px;'></div>", 200, true);
                            }
                            jQuery("#jqxgrid").jqxGrid('resumeupdate');
                        }
                    });
                    var win_h=jQuery( window ).height()-260;
                    jQuery("#jqxgrid").jqxGrid(
                    {
                        width:'99%',
                        height:win_h,
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
                        rendergridrows: function(obj)
                        {
                             return obj.data;
                        },

                        columns: [
                                { text: 'Id', datafield: 'id', hidden:true,  editable: false,  width: '4%' },
								{ text: 'sts', datafield: 'sts',hidden:true },
							  	{ text: 'v_sts', datafield: 'v_sts',hidden:true },
		 						<? if(DELETE==1){?>
							  	{ text: 'D', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%',
							  	cellsrenderer: function (row) {
									editrow = row;
									var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
									if((dataRecord.stc_sts == '39' || dataRecord.stc_sts == '35') && dataRecord.v_sts == '0'){
										return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'delete\','+editrow+')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
								 	}
								 	else {
			                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
			                      	}

									}
								  },
		            			<?php } if(EDIT==1){ ?>
								{ text: 'E', menu: false, datafield: 'Delete', align:'center', editable: false, sortable: false, width: '2%',
							  	cellsrenderer: function (row) {
										editrow = row;
										var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
										if((dataRecord.stc_sts == '39' || dataRecord.stc_sts == '35') && dataRecord.v_sts == '0'){
											return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="editt('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
										}
										else
										{
											return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
										}
									}
								  },
							  <?php } ?>
							  <? if(SENDTOCHECKER==1){?>
							  { text: 'STHO', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 55,
		                      	cellsrenderer: function(row) {
		                      		editrow = row;
									var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
									if(dataRecord.stc_sts == '39' || dataRecord.stc_sts == '35'){
										return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'sendtoho\','+editrow+');" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
								 	}
								 	else {
			                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">S</div>';
			                      	}
		                      	}
			                  },
							  <? }?>
							   <? if(SENDTOCHECKER==1){?>
							  { text: 'RF', datafield: 'received_file', editable: false,align:'center', sortable: false, menu: false, width: 35,
		                      	cellsrenderer: function(row) {
		                      		editrow = row;
									var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
									if(dataRecord.stc_sts == '96'){
										return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">RF</div>';
								 	}
								 	else{
			                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
			                      	}
		                      	}
			                  },
							  <? }?>
							 
							  	{ text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                                    cellsrenderer: function (row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'details\','+editrow+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                                      }
                                },
                                { text: 'History', menu: false, datafield: 'history', align:'center', editable: false, sortable: false, width: '5%',
                                    cellsrenderer: function (row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="r_history('+dataRecord.id+')" ><img align="center" src="<?=base_url()?>images/history.png"></div>';

                                      }
                                },
                                { text: 'Status', datafield: 'status_name',editable: false, width: '20%'},
                                { text: 'Application File', editable: false, datafield: 'app_file', filterable: false,sortable: false, menu: false, width: 120, align: 'center', cellsalign: 'center',
                                    cellsrenderer: function (row){
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', row); 
                                        if (dataRecord.app_file!='') 
                                        {
                                            return ' <a href="<?=base_url()?>cma_file/bill_ait_vat/'+dataRecord.app_file+'" download="'+dataRecord.app_file+'"> <div style=" margin-top: 5px; cursor:pointer;text-align:center" ><img src="<?=base_url()?>images/download_icon.png"></div></a>'
                                        }
                                        else
                                        {
                                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                        }
                                    }
                                  },
                                { text: 'AIT & VAT File', editable: false, datafield: 'certificate_file', filterable: false,sortable: false, menu: false, width: 120, align: 'center', cellsalign: 'center',
                                    cellsrenderer: function (row){
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', row); 
                                        if (dataRecord.stc_sts==96) 
                                        {
                                            return ' <a href="<?=base_url()?>cma_file/bill_ait_vat/'+dataRecord.certificate_file+'" download="'+dataRecord.certificate_file+'"> <div style=" margin-top: 5px; cursor:pointer;text-align:center" ><img src="<?=base_url()?>images/download_icon.png"></div></a>'
                                        }
                                        else
                                        {
                                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                        }
                                    }
                                  },
                                { text: 'Certificate Type', datafield: 'certificate_name',editable: false, width: '12%'},
                                { text: 'Type', datafield: 'request_name',editable: false, width: '12%'},
                                { text: 'Name', datafield: 'venlaw_name',editable: false, width: '30%'},
                                { text: 'Request date', datafield: 'e_dt',editable: false, width: '15%'},
                                { text: 'Date From', datafield: 'date_from',editable: false, width: '15%'},
                                { text: 'Date To', datafield: 'date_to',editable: false, width: '15%'},
                                { text: 'Tin Number', datafield: 'tin_number',editable: false, width: '15%'},
                                { text: 'Bin Number', datafield: 'bin_number',editable: false, width: '15%'},
                                { text: 'Email', datafield: 'email',editable: false, width: '15%'},
                                { text: 'Phone Number', datafield: 'phone_number',editable: false, width: '15%'},
                                { text: 'Inform to Finance team', datafield: 'send_fi_dt',editable: false, width: '15%'},
                                { text: 'Certificate Received', datafield: 'receive_head_dt',editable: false, width: '15%'},
                                
                                { text: 'Remarks', datafield: 'remarks',editable: false, width: '15%' },
                                 ],
                    });
            };
            // Jqx tab second tab function start    Grid Show
            var initWidgets = function (tab) {
                switch (tab) {
                    case 0:
                        
                        break;
                    case 1:
                        initGrid();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({ width: '99%',  initTabContent: initWidgets });
            jQuery('#jqxTabs').bind('selected', function (event) {
                if(event.args.item==0){
                    // attach temp file delete after add & edit
                    temp_file_delete();
                }
               jQuery('#ait_vat_form').jqxValidator('hide');
               reload();
               
            });
            jQuery('#jqxTabs').jqxTabs('select', 0);
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>
            //End check box update 
            jQuery("#details").jqxWindow({ theme: theme, width: '60%', height:'60%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#deletecancel,#SendTocheckercancel") });
			jQuery("#r_history").jqxWindow({ theme: theme, width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
			jQuery('#details').on('close', function (event) {
			    jQuery('#action_form').jqxValidator('hide');
			});
            jQuery("#in_req_button").click(function () {
                if (jQuery("#hidden_app_file_select").val()==0) {
                    alert('Please Upload Application File');
                    return false;
                }
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#in_req_button").hide();
                       jQuery("#in_req_loading").show();
                        save_data();
                    }
                }
                jQuery('#ait_vat_form').jqxValidator('validate', validationResult);
            });

            jQuery("#in_up_button").click( function() {
                if (jQuery("#file_delete_value_app_file").val()==1 && jQuery("#hidden_app_file_select").val()==0) {
                    alert('Please Upload Application File');
                    return false;
                }
                var validationResult = function (isValid) {
                    if (isValid ) {
                        jQuery("#in_up_button").hide();
                        jQuery("#in_up_loading").show();
                        //jQuery("#legal_notice_form").submit();
                        save_data();
                    }
                }
                jQuery('#ait_vat_form').jqxValidator('validate', validationResult);        
            });


        });
    function editt(id,index){
        jQuery('#jqxTabs').jqxTabs('select', 0);
        var val=id;
        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();
        jQuery("#add_button").hide();
        jQuery("#up_button").show();
        jQuery("#in_up_button").show();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?=base_url()?>ait_vat/get_edit_info",
            data : {[csrfName]: csrfHash,id:val},
            datatype: "json",
            async:false,
            success: function(response){
                var json = jQuery.parseJSON(response);
                //console.log(json);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if(json.Message=='ok'){
                    
                    jQuery('#add_edit').val('edit');
                    jQuery('#edit_id').val(json.row_info.id);
                    jQuery('#certificate_type').jqxComboBox('val', json.row_info.certificate_type);
                    jQuery('#request_from').jqxComboBox('val', json.row_info.request_from);
                    jQuery('#tin_number').val(json.row_info.tin_number);
                    jQuery('#bin_number').val(json.row_info.bin_number);
                    jQuery('#email').val(json.row_info.email);
                    jQuery('#phone_number').val(json.row_info.phone_number);
                    jQuery('#FromDate').val(json.row_info.date_from);
                    jQuery('#ToDate').val( json.row_info.date_to);
                    if(json.row_info.request_from==1 || json.row_info.request_from==2){ 
						jQuery("#v_name").jqxComboBox('val', json.row_info.vendor_id);
					}else{
						jQuery("#oth_name").val(json.row_info.vendor_name);
					} 
					jQuery("#remarks").val(json.row_info.remarks);

                    var app_file = json.row_info.app_file;
                    jQuery('#app_file').html('');
                    var html = '';
                    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'app_file\')"/>';
                    html+='<input type="hidden" id="hidden_app_file_select" name="hidden_app_file_select" value="0">';
                    if(app_file!='' && app_file!=null)
                    {
                        html +='<span id="hidden_app_file"><img id="file_preview_app_file" onclick="popup(\'<?=base_url()?>cma_file/bill_ait_vat/'+app_file+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                        html +='<input type="hidden" id="hidden_app_file_value" name="hidden_app_file_value" value="'+app_file+'">';
                        html +='<img id="file_delete_app_file" onclick="file_delete(\'app_file\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                        html +='<input type="hidden" id="file_delete_value_app_file" name="file_delete_value_app_file" value="0">';
                    }
                    else
                    {
                        html+='<span id="hidden_app_file">';
                    }
                    html+='<span id="hidden_app_file">';
                    jQuery('#app_file').html(html);
                }else{
                    alert("No Data Found");
                }
            }
        });

    }
    function clear_form() {
        jQuery("#certificate_type").jqxComboBox('clearSelection');
        jQuery("#certificate_type").val('');
        jQuery("#request_from").jqxComboBox('clearSelection');
        jQuery("#request_from").val('');
        jQuery("#v_name").jqxComboBox('clearSelection');
        jQuery("#v_name").val('');
        jQuery("#oth_name").val('');
        jQuery("#remarks").val('');
        jQuery('#tin_number').val('');
        jQuery('#bin_number').val('');
        jQuery('#FromDate').val('');
        jQuery('#ToDate').val('');
        jQuery('#email').val(''); 
        jQuery('#phone_number').val(''); 
    }
    function reload()
    {
        jQuery("#edit_id").val('');
        clear_form();
        jQuery('#add_edit').val('add');
        jQuery('#ait_vat_form').jqxValidator('hide');
    }
    function temp_file_delete(){
        jQuery.ajax({
            type: "GET",
            cache: false,
            url: '<?=base_url()?>index.php/ait_vat/clear_file/',
            datatype: "json",
            success: function(response){
                var html = '';
                html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'app_file\')"/>';
                html+='<input type="hidden" id="hidden_app_file_select" name="hidden_app_file_select" value="0">';
                html+='<span id="hidden_app_file">';
                jQuery('#app_file').html(html);
            }
        });
    }
	function r_history (id) {
		jQuery("#r_heading").html('Life Cycle');
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>ait_vat/history",
			data : {[csrfName]: csrfHash,id: id},
			datatype: "json",
			success: function(response){
				//alert(response);
				var ret = response.split("####");
				jQuery('.txt_csrfname').val(ret[1]);
					if(ret[0])
					{
						document.getElementById("r_history").style.visibility='visible';
						jQuery("#r_history_details").html(ret[0]);
						jQuery("#r_history").jqxWindow('open');
					}
					else {
						alert("Something went wrong, please refresh the page.")
					}

			}
		});
	}
	
	function call_ajax_submit()
	{
		
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = jQuery('#action_form').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: '<?=base_url()?>index.php/ait_vat/delete_action/',
				data : postData,
				datatype: "json",
				success: function(response){
                  ///console.log(response);
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
								jQuery("#sendtochecker_loading").hide();
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
							jQuery("#sendtochecker_loading").hide();
						}
						var row = {};
						
						
						jQuery("#error").show();
						jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});								
						jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value);	
						jQuery('#details').jqxWindow('close');
						jQuery("#jqxgrid").jqxGrid('updatebounddata');
						
					}
				}
			});

	}
	function details(id,operation,index)
	{
		
		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery('#verifyIndexId').val(index);
		if(operation=='details'){
			jQuery("#header_title").html('AIT & VAT Certificate Details');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').show();
		}else if(operation=='delete'){
			jQuery("#header_title").html('AIT & VAT Certificate Delete');
			jQuery('#comments').val('');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').show();
			jQuery('#close_btn_row').hide();
		}else if (operation == 'sendtoho'){
			jQuery("#header_title").html('AIT & VAT Certificate Send To HO');
			jQuery('#sendtochecker_row').show();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
		}else{

		}
		var csrfName = jQuery('.txt_csrfname').attr('name');
		var csrfHash = jQuery('.txt_csrfname').val();
		jQuery.ajax({
			type: "POST",
			cache: false,
			url: "<?=base_url()?>ait_vat/details",
			data : {[csrfName]: csrfHash,id: id},
			datatype: "json",
			success: function(response){
				//var json = jQuery.parseJSON(response);
				var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
					if(json['str']!='')
					{
						document.getElementById("details").style.visibility='visible';
						jQuery("#priview").html(json['str']);
						jQuery("#details").jqxWindow('open');
					}
					else {
						alert("Something went wrong, please refresh the page.")
					}

			}
		});
	}
	function decline_action()
	{
		jQuery("#decline_check").val(1);
		jQuery('#decline_part').css("display", "block");

	}
	function change_dropdown(){

		var theme = getDemoTheme();
		var item = jQuery("#request_from").jqxComboBox('getSelectedItem');
		//alert(item.value)
        jQuery('#tin_number').val('');
        jQuery('#bin_number').val('');
        jQuery('#email').val('');
        jQuery('#phone_number').val('');
		if (item!=null)
		{
			if (item.value==1)
			{
				jQuery("#label_name").html('Lawyer ');
				jQuery("#oth_name").hide();
				jQuery("#oth_name").val('');
				jQuery("#v_name").show();
				jQuery("#v_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
				jQuery('#v_name').focusout(function() {
		            commbobox_check(jQuery(this).attr('id'));
		        });
			}else if(item.value==2){
				jQuery("#label_name").html('Vendor ');
				jQuery("#oth_name").hide();
				jQuery("#oth_name").val('');
				jQuery("#v_name").show();
				jQuery("#v_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Vendor", source: vendor, width: 250, height: 25});
				jQuery('#v_name').focusout(function() {
            commbobox_check(jQuery(this).attr('id'));
        });
			}else if(item.value==3){
				jQuery("#label_name").html('Stuff ');
				jQuery("#v_name").hide();
				jQuery("#v_name").jqxComboBox('clearSelection');
				jQuery("#v_name").val('');
				jQuery("#oth_name").show();
			}else{
				jQuery("#label_name").html('');
				jQuery("#v_name").hide();
				jQuery("#v_name").jqxComboBox('clearSelection');
				jQuery("#v_name").val('');
				jQuery("#oth_name").show();
			}
		}else{
			jQuery("#v_name").jqxComboBox('clearSelection');
			jQuery("#v_name").val('');
			jQuery("#oth_name").val('');
		}
	}
	function save_data()
    {
        var postData = jQuery('#ait_vat_form').serialize();
        var add_edit = jQuery('#add_edit').val();
        jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?=base_url()?>index.php/ait_vat/add_edit_action/',
                data : postData,
                datatype: "json",
                success: function(response){
                  ///console.log(response);
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
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
                        }else{
                            var msg='';
                            if(add_edit=='edit'){
                                msg='Updated';
                            }else{
                                msg="Saved";
                            }

                            if(add_edit=='edit'){
                                jQuery("#in_up_button").show();
                                jQuery("#in_up_loading").hide();
                                jQuery('#jqxTabs').jqxTabs('select', 1);
                            }else{
                                jQuery("#in_req_button").show();
        					   	jQuery("#in_req_loading").hide();
                            }
                        jQuery("#jqxgrid").jqxGrid('updatebounddata');
                        jQuery("#msgArea").val('');
                        jQuery("#error").show();
                        jQuery("#error").fadeOut(11500);
                        jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+msg);
                        reload();
                        jQuery('#jqxTabs').jqxTabs('select', 1);
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
    <div id="container">
        <div id="body"  >
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                        <!---- Left Side Menu Start ------>
                        <?php $this->load->view('legal_file_process/pages/left_side_nav'); ?>
                        <!----====== Left Side Menu End==========----->
                        
                    </td>
                    <td valign="top" id="demos" class='rc-all content'>
                        <div id="preloader">
                          <div id="loding"></div>
                        </div>
                        <div >
                            <div id='jqxTabs'>
                                <ul>
                                	
                                    <li style="margin-left: 30px;">Form</li>
                                    <li >Data Grid</li>
                                </ul>
                                <!---==== First Tab Start ==========----->
                                <div style="overflow: hidden;" class="back_image">
                                    <div style="padding: 5px;">
                                        <div>
                                              <div id="suit_form_area">
                                                <form method="POST" name="ait_vat_form" id="ait_vat_form"  style="margin:0px;">
                                                    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                    <input type="hidden" id="edit_id" value="" name="edit_id" value="">
                                                    <input type="hidden" id="add_edit" value="add" name="add_edit" value="add">
                                                    <table style="width:100%;margin-top:20px" id="tab1Table" >
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2">
																	<table style="width: 100%;">
																		<tr>
																			<td width="20%" style="font-weight: bold;">Certificate Type:<span style="color:red">*</span> </td>
																			<td width="30%" ><div id="certificate_type" name="certificate_type" style="padding-left: 3px"></div></td>
																			<td width="20%" style="font-weight: bold;"></td>
																			<td width="30%" ></td>
																		</tr>
																		<tr>
																			<td width="20%" style="font-weight: bold;">Request From:<span style="color:red">*</span> </td>
																			<td width="30%" ><div id="request_from" name="request_from" onchange="change_dropdown()" style="padding-left: 3px"></div></td>
																			<td width="20%" style="font-weight: bold;"> </td>
																			<td width="30%" ></td>
																		</tr>
																		<tr>
																			<td width="20%" style="font-weight: bold;"><span id="label_name"></span>Name:<span style="color:red">*</span> </td>
																			<td width="30%" ><div id="v_name" name="v_name" style="padding-left: 3px"></div><input name="oth_name" type="text" class="" style="width:250px" id="oth_name" value=""/></td>
																			<td width="20%" style="font-weight: bold;"></td>
																			<td width="30%" ></td>
																		</tr>
                                                                        <tr>
                                                                            <td width="20%" style="font-weight: bold;">TIN Number :<span style="color:red">*</span> </td>
                                                                            <td width="30%" ><input type="text" name="tin_number" id="tin_number" placeholder="TIN Number" style="width: 250px;" readonly=""></td>
                                                                            <td width="20%" style="font-weight: bold;"></td>
                                                                            <td width="30%" ></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="20%" style="font-weight: bold;">BIN Number :</td>
                                                                            <td width="30%" ><input type="text" name="bin_number" id="bin_number" placeholder="BIN Number" style="width: 250px;" readonly=""></td>
                                                                            <td width="20%" style="font-weight: bold;"></td>
                                                                            <td width="30%" ></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="20%" style="font-weight: bold;"><span id="label_name"></span>Date:<span style="color:red">*</span></td>
                                                                            <td width="30%"><strong>From </strong> <input id="FromDate" name="FromDate" value="" style="width:85px"><script type="text/javascript">datePicker("FromDate");</script>
                                                                            <strong>To</strong> <input id="ToDate" name="ToDate" value="" style="width:85px"><script type="text/javascript">datePicker("ToDate");</script>
                                                                            </td>
                                                                            <td width="20%" style="font-weight: bold;"></td>
                                                                            <td width="30%" ></td>
                                                                        </tr>
																		
                                                                        <tr>
                                                                            <td width="20%" style="font-weight: bold;">Application File Upload:<span style="color:red">*</span></td>
                                                                            <td width="30%" ><span id="app_file">
                                                                            </span></td>
                                                                            <td width="20%" style="font-weight: bold;"></td>
                                                                            <td style="text-align: left;">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="20%" style="font-weight: bold;">Email<span style="color:red">*</span>:</td>
                                                                            <td width="30%" ><input type="text" name="email" id="email" style="width:250px" placeholder="Enter Email Address "><br>
                                                                                <span style="font-size: 10px;">Multiple Email separate by semicolon (;)</span></td>
                                                                            <td width="20%" style="font-weight: bold;"></td>
                                                                            <td style="text-align: left;">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="20%" style="font-weight: bold;">Phone Number:</td>
                                                                            <td width="30%" ><input type="text" name="phone_number" id="phone_number" placeholder="Phone Number" style="width: 250px;"></td>
                                                                            <td width="20%" style="font-weight: bold;"></td>
                                                                            <td style="text-align: left;">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="20%" style="font-weight: bold;">Remarks:</td>
                                                                            <td width="30%" ><textarea name="remarks" class="text-input-big" id="remarks" style="height:40px !important;width:250px"></textarea></td>
                                                                            <td width="20%" style="font-weight: bold;"></td>
                                                                            <td style="text-align: left;">
                                                                            </td>
                                                                        </tr>
                                                                        <? if(ADD==1){?>
																		<tr id="add_button">
																			<td width="20%"></td>
																			<td width="30%">
																				<input type="button" value="Save" id="in_req_button" class="" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:40px;width:100px;font-family: sans-serif;font-size: 16px;" /> <span id="in_req_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
																			</td>
																			<td width="20%"></td>
																			<td width="30%"></td>
																		</tr>
                                                                        <? } ?>	
                                                                        <? if(EDIT==1){?>
                                                                        <tr id="up_button" style="display: none;">                               
                                                                                <td width="20%"></td>
                                                                                <td width="30%">
                                                                                <input type="button" value="Update" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;" id="in_up_button"/>
                                                                                <span id="in_up_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                                                </td>
                                                                                <td width="20%"></td>
                                                                                <td width="30%"></td>
                                                                        </tr>
                                                                        <? } ?>																
																	</table>
																</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                              </div>
                                          </div>
                                    </div>
                                </div>
                                
                                
                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="border:none;" id="jqxgrid"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                        <strong>D = </strong> Delete,&nbsp;
									    <strong>E = </strong> Edit,&nbsp;
									    <strong>P = </strong> Preview,&nbsp;
									    <strong>RF = </strong> Receive File,&nbsp;
									    <strong>STHO = </strong> Send to HO&nbsp;
                                    </div> <br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
<div id="r_history" style="visibility:hidden;">
	<div style=""><strong><span id="r_heading"></span></strong></div>
	<div style="" id="details_table">
		<table style="width: 100%;" class="preview_table2">
			<thead>
				<th width="20%" align="left"><strong>Status</strong></th>
				<th width="20%" align="left"><strong>User</strong></th>
				<td width="20%" align="center"><strong>Date and Time</strong></td>
				<td width="20%" align="left"><strong>Description</strong></td>
				<td width="20%" align="left"><strong>Reason</strong></td>
			</thead>
			<tbody id="r_history_details">
				
			</tbody>
		</table>
		<div class="wrapper">
			</br></br><input type="button" align="center" class="button1" id="r_ok" value="Close" />
		</div>
	</div>
</div>

<!-- Modal for product details -->
	<div id="details" style="visibility:hidden;">
    <div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>
    	<form method="POST" name="action_form" id="action_form"  style="margin:0px;">
			<input name="deleteEventId" id="deleteEventId" value="" type="hidden">
    		<input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
    		<input name="type" id="type" value="" type="hidden">
		<div style="">
			<div id="priview"></div>
			<br>
			<div id="sendtochecker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
		      	
		      	<input type="button" class="buttonsendtochecker" id="sendtochecker" value="Send" />
		      	<input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel" />
		    	<span id="sendtochecker_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
		    </div>

			<div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
		     	<strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
		     	<textarea name="comments" id="comments" style="width:370px;"></textarea>
			    </br></br>
			    <input type="button" class="buttondelete" id="delete_button" value="Delete" />
			    <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel" />
		    	<span id="delete_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
		    </div>
			</form>
			<div id="close_btn_row" style="text-align:center;margin-bottom:30px;width:100%;">
			    	<input type="button" align="center" class="button6" id="codeOK" value="Close" />
			    </div>
			
		</div>
	</div>