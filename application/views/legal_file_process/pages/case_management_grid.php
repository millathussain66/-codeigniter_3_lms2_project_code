
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
   background-color:#e7e7e7 !important;
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
        #active{
   background: #93CDDD!important;
   font-weight: bold;
}
.back_image{
        background-image:url(<?=base_url()?>images/login_images/back_1.jpg);
        background-repeat: no-repeat;
        background-color:transparent;
        background-size: auto;
        _background-size: 1108px 763px;
        background-position: -18px 89%;
    }
    </style>
    <script type="text/javascript">
            var theme = getDemoTheme();
            var lawyer = [];
            var branch = [<? $i=1; foreach($branch as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.' ('.$row->code.')"}'; $i++;}?>];
            var bank = [<? $i=1; foreach($bank as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var ln_status = [<? $i=1; foreach($ln_status as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            jQuery(document).ready(function () {
            jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
            jQuery("#branch").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Branch", source: branch, width: 250, height: 25});
            jQuery("#bank").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Bank", source: bank, width: 250, height: 25});
            jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Legal Region", source: legal_region, width: 215, height: 25});
            jQuery("#ad_lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25,disabled:true});
            jQuery("#ln_status").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Legal Notice Status", source: ln_status, width: 250, height: 25});
            jQuery('#sendButton').jqxButton({template:"success", width: 130, height: 40, theme: theme });
            var theme = 'classic';
            //For Additional input form
            jQuery('#deliver_form').jqxValidator({
                rules: [
                    { input: '#ad_lawyer', message: 'required!', action: 'blur,change', rule: function (input) {                   
                        if(input.val() != '')
                        {
                            var item = jQuery("#ad_lawyer").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='ad_lawyer']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#ad_lawyer input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#ln_status', message: 'required!', action: 'blur,change', rule: function (input) {                    
                        if(input.val() != '')
                        {
                            var item = jQuery("#ln_status").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='ln_status']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#ln_status input").focus();
                            return false;
                        }
                    }  
                    },
                    { input: '#ln_sent_date', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                        if(jQuery("#ln_sent_date").val()=='')
                        {
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                    }
                    },
                    { input: '#ln_sent_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                        if (!input.val()) {
                            return true;
                        }
                        if(validate_date(input.val()))
                        {
                            return true;
                        }else {
                            return false;
                        }
                    } },
                    // { input: '#ln_sent_date', message: 'Old Date Not allowed !', action: 'change', rule: function(input,commit){  
                    //         if(input.val()!="") { return validateDate(input.val()); } else{return true;}
                    //   }
                    // },
                    { input: '#ln_val_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                        if(jQuery("#ln_val_dt").val()=='')
                        {
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                    }
                    },
                    { input: '#ln_val_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
                        if (!input.val()) {
                            return true;
                        }
                        if(validate_date(input.val()))
                        {
                            return true;
                        }else {
                            return false;
                        }
                    } },
              //       { input: '#ln_val_dt', message: 'Old Date Not allowed !', action: 'change', rule: function(input,commit){  
              //               if(input.val()!="") { return validateDate(input.val()); } else{return true;}
              //         }
              // },
              { input: '#total_final_ln', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                        if(jQuery("#total_final_ln").val()=='')
                        {
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                    }
                    },
                    { input: '#total_final_ln', message: 'Numbers only', action: 'keyup, blur, change', rule: function (input, commit)
                     {
                        if(input.val() != '')
                        {
                            if(!checknumber_only('total_final_ln'))
                            {
                                jQuery("#total_final_ln").focus();
                                return false;

                            }
                        }
                        return true;

                    } },
                    { input: '#total_ln_cost', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        if(jQuery("#total_ln_cost").val()=='' || jQuery("#total_ln_cost").val()<=0)
                            {
                                jQuery("#total_ln_cost").focus();
                                return false;
                            }
                            else
                            {
                                return true;
                            }
                            
                        }
                    },
                    { input: '#total_ln_cost', message: 'Number is required!', action: 'keyup, blur', rule: function(input,commit){
                            if(input.val() != '' && jQuery("#new_court_fee_sts").val()==1)
                            {
                                if(!checknumber_alphabaticDot('total_ln_cost'))
                                {
                                    jQuery("#total_ln_cost").focus();
                                    return false;

                                }
                            }
                            return true;
                        }
                    },
                ]
                });
                jQuery("#sendButton").click(function () 
                {
                    var validationResult = function (isValid) {
                        if (isValid) {
                            if ((jQuery("#hidden_final_ln_select").val()=='0' && jQuery('#ln_select_add_edit').val()=='add') || (jQuery("#hidden_final_ln_select").val()=='0' && jQuery("#file_delete_value_final_ln").val()=='1' && jQuery('#ln_select_add_edit').val()=='edit')) 
                            {
                                alert('Please Select Final Legal notice copy');
                                return false;
                            }
                            delete_action('save');
                        }
                        else{return;}
                    }
                    jQuery('#deliver_form').jqxValidator('validate', validationResult);
                });
            <? if(ADD==1){?>
           jQuery("#sendButton").jqxButton({template:"primary",width:"170"});
            <?}?>
            var n_type = ['Email','SMS','BOTH'];
            jQuery("#notification_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Notification Type", source: n_type, width: 250, height: 25});
        
            jQuery('#notification_type,#legal_region,#lawyer,#bank,#branch').focusout(function() {
               //alert(jQuery(this).attr('id'));
                commbobox_check(jQuery(this).attr('id'));
            });
            jQuery('#notification_type').bind('change', function (event) {
                var item = jQuery("#notification_type").jqxComboBox('getSelectedItem');
                if (item!=null) {
                    if (item.value=='Email') 
                    {
                        jQuery("#mobile_input").hide();
                        jQuery("#email_input").show();
                        jQuery('#action_form').jqxValidator('hide');
                    }   
                    else if(item.value=='SMS')
                    {
                        jQuery("#mobile_input").show();
                        jQuery("#email_input").hide();
                        jQuery('#action_form').jqxValidator('hide');
                    }
                    else
                    {
                        jQuery("#email_input").show();
                        jQuery("#mobile_input").show();
                        jQuery('#action_form').jqxValidator('hide');
                    }
                }
                else
                {
                    jQuery("#mobile_input").hide();
                    jQuery("#email_input").hide();
                    jQuery('#action_form').jqxValidator('hide');
                }
            });
             jQuery('#lawyer').bind('change', function (event) {
                jQuery("#email_address").val('');
                jQuery("#mobile").val('');
                var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
                if (item!=null) {
                    get_lawyer_email_phone(item.value);
                }
            });
            // Jqx tab second tab function start    Grid Show
            var initWidgets = function (tab) {
                switch (tab) {
                    case 0:
                        jQuery('#jqxTabs').jqxTabs('disableAt', 1);
                        break;
                    case 1:
                        //initGrid2();
                        break;
                }
            }
            jQuery('#jqxTabs').jqxTabs({ width: '99%',  initTabContent: initWidgets });
            jQuery('#jqxTabs').bind('selected', function (event) {
               if(event.args.item==0)
               {
                jQuery('#jqxTabs').jqxTabs('disableAt', 1);
                jQuery('#deliver_form').jqxValidator('hide');
               }
            });
            jQuery('#jqxTabs').jqxTabs('select', 0);
            jQuery('#jqxTabs').jqxTabs('disableAt', 1);

            var source =
            {
           datatype: "json",
           datafields: [
                    { name: 'id', type: 'int'},
                    { name: 'legal_user', type: 'int'},
                    { name: 'checker_id', type: 'int'},
                    { name: 'holm_checker_id', type: 'int'},
                    { name: 'sts', type: 'string'},
                    { name: 'sl_no', type: 'string'},
                    { name: 'loan_ac', type: 'string'},
                    { name: 'cif', type: 'string'},
                    { name: 'branch_sol', type: 'string'},
                    { name: 'ac_name', type: 'string'},
                    { name: 'status', type: 'string'},
                    { name: 'request_type_name', type: 'string'},
                    { name: 'ho_return_reason', type: 'string'},
                    { name: 'ho_decline_reason', type: 'string'},
                    { name: 'region_name', type: 'string'},
                    { name: 'territory_name', type: 'string'},
                    { name: 'district_name', type: 'string'},
                    { name: 'unit_office_name', type: 'string'},
                    { name: 'cma_sts', type: 'int'},
                    { name: 'proposed_type', type: 'string'},
                    { name: 'loan_segment', type: 'string'},
                    { name: 'sec_sts', type: 'int'},
                    { name: 'req_type', type: 'int'},
                    { name: 'lawyer', type: 'int'},
                    { name: 'ln_status', type: 'int'},
                    { name: 'ack_by', type: 'int'},
                    { name: 'district', type: 'int'},
                    { name: 'ln_exp_sts', type: 'int'},
                    { name: 'total_auth', type: 'int'},
                    { name: 'e_by', type: 'string'},
                    { name: 'e_dt', type: 'string'},
                    { name: 'stc_by', type: 'string'},
                    { name: 'stc_dt', type: 'string'},
                    { name: 'rec_by', type: 'string'},
                    { name: 'rec_dt', type: 'string'},
                    { name: 'sth_by', type: 'string'},
                    { name: 'sth_dt', type: 'string'},
                    { name: 'v_by', type: 'string'},
                    { name: 'v_dt', type: 'string'},
                    { name: 'final_ln', type: 'string'},
                    { name: 'uploaded_statement', type: 'string'},
                    { name: 'generated_statement', type: 'string'},
                    { name: 'reassign_sts', type: 'int'},
                    { name: 'reassign_status', type: 'string'},
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
                url: '<?=base_url()?>index.php/legal_file_process/case_management_grid',
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
            var win_h=jQuery( window ).height()-320;
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
                        { text: 'lawyer', datafield: 'lawyer',hidden:true },
                        { text: 'ln_status', datafield: 'ln_status',hidden:true },
                        { text: 'final_ln', datafield: 'final_ln',hidden:true },
                        <? if(ACKOWLEDGMENTREQUEST==1){?>
                          { text: 'ACK', datafield: 'AcknowledgementRequest', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.cma_sts == 60 || dataRecord.cma_sts == 104 || dataRecord.cma_sts==87)){
                                    if (dataRecord.proposed_type=='Loan')
                                    {
                                    var type=1;
                                    }else{var type=2}
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'acknowledgement\','+editrow+','+dataRecord.cif+','+type+','+dataRecord.sec_sts+')" ><img align="center" src="<?=base_url()?>images/favorites.png"></div>';
                                }
                                else {
                                        return '<div style=" margin-top: 7px;text-align:center">ACK</div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(REASSIGN==1){?>
                          { text: 'RF', datafield: 'reassign', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2' || check_group_javascript(11) || check_group_javascript(10)) && (dataRecord.cma_sts ==61 || dataRecord.cma_sts==62 || dataRecord.cma_sts==63 || dataRecord.cma_sts==67 || dataRecord.cma_sts==69 || dataRecord.cma_sts==64)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'reassign\','+editrow+','+dataRecord.legal_user+')" ><img align="center" src="<?=base_url()?>images/assign.jpg"></div>';
                                }
                                else{
                                    return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(APPROVEREASSIGN==1){?>
                          { text: 'AR', datafield: 'approvereassign', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if((check_group_javascript(1) || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.cma_sts == 84 ){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'approve_reassign\','+editrow+','+dataRecord.legal_user+')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                }
                                else{
                                    return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(ACKOWLEDGMENTREQUEST==1){?>
                          { text: 'STM', datafield: 'statement', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.cma_sts >= 61){
                                    if (dataRecord.uploaded_statement!='')
                                    {
                                        return '<div style=" margin-top: 2px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/legal_file_process/statement_download/uploaded/'+dataRecord.uploaded_statement+'" target="_blank" ><img align="center" src="<?=base_url()?>images/download_002.png"></a></div>';
                                    }
                                    else{
                                        return '<div style=" margin-top: 2px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/legal_file_process/statement_download/generated/'+dataRecord.generated_statement+'" target="_blank" ><img align="center" src="<?=base_url()?>images/download_002.png"></a></div>';
                                    }
                                }
                                else {
                                        return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(LAWYERNOTIFICATIONSENT==1){?>
                          { text: 'SNL', datafield: 'lawyernotificationsent', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                //(dataRecord.cma_sts == 62 && dataRecord.total_auth>0)
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2' || check_group_javascript(11) || check_group_javascript(10)) && (dataRecord.cma_sts == 63 || dataRecord.cma_sts == 61 || dataRecord.cma_sts == 69 || dataRecord.cma_sts == 67 || dataRecord.cma_sts == 62) ){

                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'sendnotificationlawyer\','+editrow+','+dataRecord.req_type+')" ><img align="center" src="<?=base_url()?>images/request.png"></div>';
                                }
                                else{
                                    return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(ADDITIONALINPUT==1){?>
                          { text: 'ADI', datafield: 'additionalinput', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if (dataRecord.proposed_type=='Loan')
                                {
                                var type=1;
                                }else{var type=2}
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2' || check_group_javascript(11) || check_group_javascript(10)) && (dataRecord.cma_sts == 63 || dataRecord.cma_sts == 69 || dataRecord.cma_sts == 62)){

                                    return '<div style="text-align:center;margin-top: 2px; cursor:pointer" onclick="additionalinput('+dataRecord.id+','+editrow+','+type+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                }
                                else {
                                        return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SENDFORAUTHORIZATION==1){?>
                          { text: 'SFA', datafield: 'sendforauthorization', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                //if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.ln_exp_sts==1 && (dataRecord.cma_sts ==62 || dataRecord.cma_sts==69) && dataRecord.district!=4){
                                //&& dataRecord.ln_exp_sts==1
                                //if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.total_auth<1  && (dataRecord.cma_sts == 63 || dataRecord.cma_sts ==62 || dataRecord.cma_sts==69)){
                                //&& dataRecord.ln_exp_sts==1
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.total_auth<1  && (dataRecord.cma_sts == 63 || dataRecord.cma_sts ==62 || dataRecord.cma_sts==69) && dataRecord.ln_exp_sts==1){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'sendforauthorization\','+editrow+')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else{
                                    return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(EDIT==1){?>
                          { text: 'EC', datafield: 'edit', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2' || check_group_javascript(10) || check_group_javascript(11) || check_group_javascript(18)) && dataRecord.cma_sts!=64 && dataRecord.cma_sts!=65 && dataRecord.cma_sts!=75){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'editcourtfee\','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                }
                                else{
                                    return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(DOWNLOAD==1){?>
                          { text: 'AM', datafield: 'authorizationmemo', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                //if((dataRecord.cma_sts == 65 || dataRecord.cma_sts == 67 || dataRecord.cma_sts == 64 || dataRecord.cma_sts == 75) && (dataRecord.req_type==1 || dataRecord.req_type==2) && dataRecord.district!=4){
                                if((dataRecord.cma_sts == 65 || dataRecord.cma_sts == 67 || dataRecord.cma_sts == 64 || dataRecord.cma_sts == 75 || dataRecord.total_auth>0) && (dataRecord.req_type==1 || dataRecord.req_type==2)){
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/authorization_ho/download/0/'+dataRecord.id+'/1" target="_blank" ><img align="center" src="<?=base_url()?>images/word_icon.gif"></a></div>';
                                }
                                else {
                                        return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(SUITFILLING==1){?>
                          { text: 'SF', datafield: 'suitfilling', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                //if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && ((dataRecord.cma_sts==62 && dataRecord.district==4) || dataRecord.cma_sts ==67) && dataRecord.ln_exp_sts==1){
                                    //&& (dataRecord.cma_sts ==67 && dataRecord.ln_exp_sts==1)
                                //if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && ((dataRecord.total_auth>0 && dataRecord.cma_sts!=64 && dataRecord.cma_sts!=65 && dataRecord.cma_sts!=75) || dataRecord.cma_sts ==67)){
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && ((dataRecord.total_auth>0 && dataRecord.cma_sts!=64 && dataRecord.cma_sts!=65 && dataRecord.cma_sts!=75) || (dataRecord.cma_sts ==67 && dataRecord.ln_exp_sts==1))){
                                    return '<div style="text-align:center;margin-top: 2px; cursor:pointer" onclick="suitfillinginput('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                }
                                else{
                                    return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        { text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                            cellsrenderer: function (row) {
                            editrow = row;
                            var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                            return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details('+dataRecord.id+',\'details\','+editrow+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                              }
                        },
                        <? if(CLOSEACCOUNT==1){?>
                          { text: 'Account Close', datafield: 'closeaccount', editable: false,align:'center', sortable: false, menu: false, width: '10%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.legal_user || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.cma_sts ==61 || dataRecord.cma_sts==62 || dataRecord.cma_sts==63 || dataRecord.cma_sts==67 || dataRecord.cma_sts==69)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'closeaccount\','+editrow+','+dataRecord.legal_user+')" ><img align="center" src="<?=base_url()?>images/cancel.png"></div>';
                                }
                                else{
                                    return '<div style=" margin-top: 7px;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        { text: 'Status', datafield: 'status',editable: false, width: '30%', align:'left',cellsalign:'left'},
                        { text: 'Protfolio', datafield: 'loan_segment',editable: false, width: '8%', align:'left',cellsalign:'left'},
                        { text: 'Serial', datafield: 'sl_no',editable: false, width: '8%', align:'left',cellsalign:'left'},
                        { text: 'Loan A/C or Card No.', datafield: 'loan_ac', editable: false,align:'center',cellsalign:'center', sortable: true, menu: true, width: '13%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\')"><span>'+dataRecord.loan_ac+'</span></a></div>';
                                
                            }
                          },
                        { text: 'A/C Name or Name on Card', datafield: 'ac_name',editable: false, width: '15%', align:'left',cellsalign:'left'},
                        { text: 'Region', datafield: 'region_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'Territory', datafield: 'territory_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'District', datafield: 'district_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'Unit Office', datafield: 'unit_office_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                        { text: 'Requisition', datafield: 'request_type_name',editable: false, width: '8%', align:'left',cellsalign:'left'},
                        { text: 'Initiate By', datafield: 'e_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
                        { text: 'Initiate Date Time', datafield: 'e_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
                        { text: 'Reject/Return Reason', datafield: 'ho_return_reason', editable: false,align:'left',cellsalign:'left', sortable: true, menu: true, width: '15%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if (dataRecord.ho_return_reason!=null)
                                 {
                                    return '<div style=" margin-top: 7px;margin-left: 7px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+')"><span>'+dataRecord.ho_return_reason+'</span></a></div>';
                                 }
                                 else if(dataRecord.ho_decline_reason!=null){
                                    return '<div style=" margin-top: 7px;margin-left: 7px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+')"><span>'+dataRecord.ho_decline_reason+'</span></a></div>';
                                 }
                                 else{return '<div style=" margin-top: 5px;text-align:center"></div>';}
                                
                            }
                          },
                        { text: 'STC By', datafield: 'stc_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
                        { text: 'STC Date Time', datafield: 'stc_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
                        { text: 'REC By', datafield: 'rec_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
                        { text: 'REC Date and Time ', datafield: 'rec_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
                        { text: 'Send To HOLM By', datafield: 'sth_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
                        { text: 'Send To HOLM Date and Time', datafield: 'sth_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
                        { text: 'Verify By', datafield: 'v_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
                        { text: 'Verify Date and Time', datafield: 'v_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
                         ],
            });
            //End check box update 
            jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#sendnotificationcancel,#authorization_cancel,#confirm_cancel,#reassigncancel,#closeaccount_cancel,#reassign_approval_cancel,#editcourtfeecancel") });
            jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
            jQuery('#details').on('close', function (event) {
                jQuery('#action_form').jqxValidator('hide');
            });
        });
    function get_lawyer_email_phone(id)
    {
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>legal_file_process/get_lawyer_email_phone",
            data : {[csrfName]: csrfHash,id: id},
            datatype: "json",
            success: function(response){
            //alert(response);
                var json = jQuery.parseJSON(response);

                jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json['row_info'])
                    {
                        jQuery("#email_address").val(json['row_info']['email']);
                        jQuery("#mobile").val(json['row_info']['mobile']);
                    }
                    else {
                        alert("Something went wrong, please refresh the page.")
                    }

            }
        });
    }
    function date_formater(str)
    {
        //var str_1=str.split("T");
        if (str=='' || str==undefined || str==null) 
        {
            return '';
        }
        else
        {
            var str_2=str.split("-");
            var final_str=str_2[2]+'/'+str_2[1]+'/'+str_2[0];
            return final_str;
        }
    }
    function additionalinput(id,editrow,proposed_type)
    {
        jQuery('#ln_scan_copy').html('');
        jQuery('#lawyer_ack_copy').html('');
        jQuery("#ad_deleteEventId").val('');
        jQuery("#ln_val_dt").val('');
        jQuery("#ln_sent_date").val('');
        jQuery("#total_final_ln").val('');
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>legal_file_process/get_add_input_data",
            data : {[csrfName]: csrfHash,id: id},
            datatype: "json",
            success: function(response){
            //alert(response);
                var json = jQuery.parseJSON(response);

                jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json['result'])
                    {
                        var lawyer = [];
                        jQuery.each(json['lawyer_info'],function(key,obj){
                            lawyer.push({ value: obj.id, label: obj.name });
                        });
                        jQuery("#ad_lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25,disabled:true});
                        jQuery("#ad_lawyer").jqxComboBox('val', json['result']['lawyer']);
                        jQuery("#ln_status").jqxComboBox('val', json['result']['ln_status']);
                        jQuery("#ad_deleteEventId").val(id);
                        jQuery("#ln_val_dt").val(date_formater(json['result']['ln_val_dt']));
                        jQuery("#ln_sent_date").val(date_formater(json['result']['ln_sent_date']));
                        var total_ln = 0;
                        if(json['result']['total_final_ln']!='' && json['result']['total_final_ln']!=null)
                        {
                            jQuery("#total_final_ln").val(json['result']['total_final_ln']);
                            total_ln = json['result']['total_final_ln'];
                        }
                        else
                        {
                            jQuery("#total_final_ln").val(json['total_address']);
                            total_ln = json['total_address'];
                        }
                        //Calculate Total ln cost
                        var total_ln_cost = (parseInt(json['single_ln_cost'])*parseInt(total_ln));
                        jQuery("#per_ln_cost").val(json['single_ln_cost']);
                        jQuery("#total_ln_cost").val(total_ln_cost);
                        var ln_cal_text = '('+json['single_ln_cost']+'*'+total_ln+')';
                        jQuery("#ln_cal_text").html(ln_cal_text);
                        jQuery("#total_ln_cost_remarks").html(ln_cal_text);
                        ///////////////
                        var ln_copy = json['result']['final_ln'];
                        var ack_copy = json['result']['lawyer_ack_copy'];
                        var html = '';
                        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'final_ln\')"/>';
                        html+='<input type="hidden" id="hidden_final_ln_select" name="hidden_final_ln_select" value="0">';
                        if(ln_copy!='' && ln_copy!=null)
                        {
                            html +='<span id="hidden_final_ln"><img id="file_preview_final_ln" onclick="popup(\'<?=base_url()?>cma_file/ln_scan_copy/'+ln_copy+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                            html +='<input type="hidden" id="hidden_final_ln_value" name="hidden_final_ln_value" value="'+ln_copy+'">';
                            html +='<img id="file_delete_final_ln" onclick="file_delete(\'final_ln\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                            html +='<input type="hidden" id="file_delete_value_final_ln" name="file_delete_value_final_ln" value="0">';
                            html+='<span id="hidden_final_ln"></span><input type="hidden" id="ln_select_add_edit" name="ln_select_add_edit" value="edit">';
                        }
                        else
                        {
                            html+='<span id="hidden_final_ln"></span><input type="hidden" id="ln_select_add_edit" name="ln_select_add_edit" value="add">';
                        }
                        
                        jQuery('#ln_scan_copy').html(html);
                        var html = '';
                        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'lawyer_ack_copy\')"/>';
                        html+='<input type="hidden" id="hidden_lawyer_ack_copy_select" name="hidden_lawyer_ack_copy_select" value="0">';
                        if(ack_copy!='' && ack_copy!=null)
                        {
                            html +='<span id="hidden_lawyer_ack_copy"><img id="file_preview_lawyer_ack_copy" onclick="popup(\'<?=base_url()?>cma_file/lawyer_ack_copy/'+ack_copy+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                            html +='<input type="hidden" id="hidden_lawyer_ack_copy_value" name="hidden_lawyer_ack_copy_value" value="'+ack_copy+'">';
                            html +='<img id="file_delete_lawyer_ack_copy" onclick="file_delete(\'lawyer_ack_copy\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                            html +='<input type="hidden" id="file_delete_value_lawyer_ack_copy" name="file_delete_value_lawyer_ack_copy" value="0">';
                        }
                        else
                        {
                            html+='<span id="hidden_lawyer_ack_copy">';
                        }
                        html+='<span id="hidden_lawyer_ack_copy">';
                        jQuery('#lawyer_ack_copy').html(html);
                        jQuery('#jqxTabs').jqxTabs('enableAt', 1);
                        jQuery('#jqxTabs').jqxTabs('select', 1);
                    }
                    else {
                        alert("Something went wrong, please refresh the page.")
                    }

            }
        });
       
    }
    function suitfillinginput(id,indx)
    {
        jQuery('#grid_cma_id').val(id);
        document.getElementById("suit_form").submit(); 
        //window.location.href = "<?=base_url()?>index.php/legal_file_process/suit_file_view/<?=$menu_group?>/<?=$menu_cat?>/"+id;
    }
    function r_history (id,life_cycle=null) {
        if (life_cycle=='life_cycle') 
        {
            jQuery("#r_heading").html('Life Cycle');
        }
        else
        {
            jQuery("#r_heading").html('Decline/Return Reason History');
        }
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?=base_url()?>cma_process/r_history",
            data : {[csrfName]: csrfHash,id: id,life_cycle:life_cycle},
            datatype: "json",
            success: function(response){
            //alert(response);
                var json = jQuery.parseJSON(response);

                jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json['row_info'])
                    {
                        document.getElementById("r_history").style.visibility='visible';
                        var html='';
                        jQuery.each(json['row_info'],function(key,obj){
                            html+='<tr>';
                                html+='<td align="left">'+obj.oprs_sts+'</td>';
                                html+='<td align="left">'+obj.r_by+'</td>';
                                html+='<td align="center">'+obj.oprs_dt+'</td>';
                                html+='<td align="left">'+obj.oprs_descriptions+'</td>';
                                if (obj.oprs_reason!=null)
                                {
                                    html+='<td align="left">'+obj.oprs_reason+'</td>';
                                }else{html+='<td align="left"></td>';}
                            html+='</tr>';
                        });
                        jQuery("#r_history_details").html(html);
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
                url: '<?=base_url()?>index.php/legal_file_process/delete_action/',
                data : postData,
                datatype: "json",
                success: function(response){
                  ///console.log(response);
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if (jQuery("#type").val()=='acknowledgement')
                        {
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#sendtochecker_loading").hide();
                        }
                        if (jQuery("#type").val()=='sendnotificationlawyer')
                        {
                            jQuery("#sendnotification").show();
                            jQuery("#sendnotificationcancel").show();
                            jQuery("#sendnotification_loading").hide();
                        }
                        if (jQuery("#type").val()=='sendforauthorization')
                        {
                            jQuery("#authorization").show();
                            jQuery("#authorization_cancel").show();
                            jQuery("#authorization_loading").hide();
                        }
                        if (jQuery("#type").val()=='confirm')
                        {
                            jQuery("#confirm").show();
                            jQuery("#confirm_cancel").show();
                            jQuery("#confirm_loading").hide();
                        }
                        if (jQuery("#type").val()=='reassign')
                        {
                            jQuery("#reassign").show();
                            jQuery("#reassigncancel").show();
                            jQuery("#reassign_loading").hide();
                        }
                        if (jQuery("#type").val()=='closeaccount')
                        {
                            jQuery("#closeaccount").show();
                            jQuery("#closeaccount_cancel").show();
                            jQuery("#closeaccount_loading").hide();
                        }
                        if (jQuery("#type").val()=='reject_reassign_approval')
                        {
                            jQuery("#reject_reason_row").hide();
                            jQuery("#reject_reason").val('');
                            jQuery("#reject").show();
                            jQuery("#reassign_approval").show();
                            jQuery("#reassign_approval_cancel").show();
                            jQuery("#reassign_approval_loading").hide();
                        }
                        if (jQuery("#type").val()=='reassign_approval')
                        {
                            jQuery("#reject_reason_row").hide();
                            jQuery("#reject_reason").val('');
                            jQuery("#reject").show();
                            jQuery("#reassign_approval").show();
                            jQuery("#reassign_approval_cancel").show();
                            jQuery("#reassign_approval_loading").hide();
                        }
                        if(json.Message!='OK')
                        {
                            if(json.Message=='99999')
                            {
                                jQuery('#details').jqxWindow('close');
                                $('sendToCheckerMessageDialogCancel2').style.display = 'inline';
                                sendToCheckerMessageDialog2 = new EOL.dialog($('sendToCheckerMessageDialogContent2'), {
                                    position: 'fixed',
                                    modal: true,
                                    width: 470,
                                    close: true,
                                    id: 'sendToCheckerMessageDialog2'
                                });
                                sendToCheckerMessageDialog2.show();
                                return false;
                            }
                            else
                            {
                                jQuery('#details').jqxWindow('close');
                                alert(json.Message);
                                return false;
                            }
                        }else{
                        var row = {};
                        row["id"] = json['row_info'].id;
                        row["sl_no"] = json['row_info'].sl_no;
                        row["loan_ac"] = json['row_info'].loan_ac;
                        row["ac_name"] = json['row_info'].ac_name;

                        var msz='';

                        jQuery("#jqxgrid").jqxGrid('updatebounddata');
                        jQuery("#error").show();
                        jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                        jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                        jQuery('#details').jqxWindow('close');
                    }
                }
            });

    }
    function add_procurment(cost,actual_cost,original_procurement)
    {
        var total_court_fee = ((actual_cost-parseInt(original_procurement))+parseInt(cost));
        jQuery('#court_fee_amount').val(total_court_fee.toFixed(2));
    }
    function calculate_total_ln_cost()
    {
        var total_ln = jQuery('#total_final_ln').val();
        var per_ln_cost = jQuery('#per_ln_cost').val();
        var total_ln_cost = (parseInt(total_ln)*parseInt(per_ln_cost));
        jQuery('#total_ln_cost').val(total_ln_cost);
        var ln_cal_text = '('+per_ln_cost+'*'+total_ln+')';
        jQuery("#ln_cal_text").html(ln_cal_text);
        jQuery("#total_ln_cost_remarks").html(ln_cal_text);
    }
    function details(id,operation,indx,cif,proposed_type,sec_sts)
    {
        jQuery("#reject_reason_row").hide();
        jQuery("#reject_reason").val('');
        jQuery("#close_account_remarks").val('');
        jQuery("#comments").val('');
        jQuery("#lawyer").jqxComboBox('clearSelection');
        jQuery("#notification_type").jqxComboBox('clearSelection');
        jQuery("input[name='lawyer']").val('');
        jQuery("input[name='notification_type']").val('');
        jQuery("#mobile").val('');
        jQuery("#email_address").val('');
        jQuery('#deleteEventId').val(id);
        jQuery('#type').val(operation);
        jQuery('#cif').val(cif);
        jQuery('#pre_legal_user').val(cif);
        jQuery('#sec_sts').val(sec_sts);
        if (proposed_type==1) 
        {
            var type='Loan';
        }else{var type='Card';}
        jQuery('#proposed_type').val(type);
        jQuery('#verifyIndexId').val(indx);
        jQuery('#hidden_req_type').val(cif);
        jQuery('#pre_court_fee').val("");
        jQuery('#pre_case_claim_amount').val("");
        jQuery('#pre_court_fee_id').val("");
        jQuery('#court_fee').val("");
        jQuery('#case_claim_amount').val("");
        jQuery('#editcourtfee_reason').val("");
        if (operation=='details') 
        {
            jQuery("#header_title").html('CMA Details');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').show();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#reassign_approval_row').hide();
            jQuery('#editcourtfee_row').hide();
        }
        else if (operation=='acknowledgement') 
        {
            jQuery("#header_title").html('Acknowledge CMA');
            jQuery('#sendtochecker_row').show();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#reassign_approval_row').hide();
            jQuery('#editcourtfee_row').hide();
        }
        else if(operation=='sendnotificationlawyer')
        {
            jQuery("#header_title").html('Send Notification To Lawyer');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').show();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#reassign_approval_row').hide();
            jQuery('#editcourtfee_row').hide();
            if(cif==1) //For Ni Act
            {
                jQuery('#branch_row').show();
                jQuery('#bank_row').show();
                jQuery('#dishonor_row').show();
                jQuery('#chq_number_row').show();
                jQuery('#chq_amount_row').show();
            }
            else
            {
                jQuery('#branch_row').hide();
                jQuery('#bank_row').hide();
                jQuery('#dishonor_row').hide();
                jQuery('#chq_number_row').hide();
                jQuery('#chq_amount_row').hide();
            }
        }
        else if(operation=='sendforauthorization')
        {
            jQuery("#header_title").html('Send For Authorization');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').show();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#reassign_approval_row').hide();
            jQuery('#editcourtfee_row').hide();
        }
        else if(operation=='confirm')
        {
            jQuery("#header_title").html('Confirm Suit File');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').show();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#reassign_approval_row').hide();
            jQuery('#editcourtfee_row').hide();
        }
        else if(operation=='reassign')
        {
            jQuery("#header_title").html('Reassign Legal User');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').show();
            jQuery('#closeaccount_row').hide();
            jQuery('#reassign_approval_row').hide();
            jQuery('#editcourtfee_row').hide();
        }
        else if(operation=='closeaccount')
        {
            jQuery("#header_title").html('Close/Settle Account');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').show();
            jQuery('#reassign_approval_row').hide();
            var html = '';
            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'close_account_file\')"/>';
            html+='<input type="hidden" id="hidden_close_account_file_select" name="hidden_close_account_file_select" value="0">';
            html+='<span id="hidden_close_account_file">';
            jQuery('#close_account_file').html(html);
            jQuery('#editcourtfee_row').hide();
        }
        else if(operation=='approve_reassign')
        {
            jQuery("#header_title").html('Reassign Approval');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#reassign_approval_row').show();
            jQuery('#editcourtfee_row').hide();
        }
        else if(operation=='editcourtfee')
        {
            jQuery("#header_title").html('Edit Court Fee & Case Claim Amount');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#reassign_approval_row').hide();
            jQuery('#editcourtfee_row').show();
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
            url: "<?=base_url()?>cma_process/details",
            data : {[csrfName]: csrfHash,id: id,
            territory:'',region:'',operation:operation
            },
            datatype: "json",
            success: function(response){
            //alert(response);
                var json = jQuery.parseJSON(response);

                jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json.str)
                    {
                        document.getElementById("details").style.visibility='visible';
                        jQuery("#main_body").html(json['str']);
                        jQuery('#loading_preview').hide();
                        jQuery('#loading_p').hide();
                        jQuery('#details_table').show();
                        jQuery("#details").jqxWindow('open');
                        if (operation=='editcourtfee')
                        {
                            if(json.court_fee_amount!='' && json.court_fee_id!='')
                            {
                                jQuery('#pre_court_fee').val(json.court_fee_amount);
                                jQuery('#pre_court_fee_id').val(json.court_fee_id);
                                jQuery('#court_fee').val(json.court_fee_amount);
                                jQuery('#court_fee_edit_row').show();
                            }
                            else
                            {
                                jQuery('#court_fee_edit_row').hide();
                            }
                            jQuery('#case_claim_amount').val(json.case_claim_amount);
                            jQuery('#pre_case_claim_amount').val(json.case_claim_amount);
                        }
                        if (operation=='reassign')
                        {
                            var theme = getDemoTheme();
                                var legal_user = [];
                                if (json['legal_user'].length>0)
                                {
                                    jQuery.each(json['legal_user'],function(key,obj){
                                        legal_user.push({ value: obj.id, label: obj.name+' ('+obj.pin+')' });
                                        //alert(obj.name);
                                    });
                                }
                                jQuery("#legal_user").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Legal User", source: legal_user, width: 215, height: 25});
                                jQuery('#legal_user').focusout(function() {
                                commbobox_check(jQuery(this).attr('id'));
                            });
                        }
                        if(operation=='sendnotificationlawyer'){
                            var lawyer = [];
                            jQuery.each(json['lawyer_info'],function(key,obj){
                                lawyer.push({ value: obj.id, label: obj.name });
                            });
                            jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
                        }
                        if(operation=='sendnotificationlawyer' && json.court_fee>0)
                        {
                            
                            jQuery("#court_fee_row").show();
                            //bill id condition for when previous lawyer bill disbursed and new lawyer assing then court fee will be generate again for the new lawyer
                            if(json.pre_court_fee_data==0 || (json.pre_court_fee_data.bill_id!='' && json.pre_court_fee_data.bill_id!=0 && json.pre_court_fee_data.bill_id!=null)) //Previously added court fee check
                            {
                                var html = '';
                                html+='<input name="new_court_fee_sts" id="new_court_fee_sts" value="1" type="hidden"><input name="court_fee_id" id="court_fee_id" value="0" type="hidden"><input style="float:left;width:100px" name="court_fee_amount" type="text" id="court_fee_amount" value="'+json.court_fee.toFixed(2)+'" onkeypress="return numbersonly(event)" class="text-input-big" />&nbsp;<span style="float:left"><strong>procurement:</strong></span>';
                                html+='<input style="float:left;width:100px" name="procument_cost" type="text" id="procument_cost" value="'+json.procurement+'" class="text-input-big" onkeypress="return numbersonly(event)" onKeyUp="javascript:return add_procurment(this.value,'+json.court_fee+','+json.procurement+');"/>';
                                jQuery("#court_fee_amount_body").html(html);
                            }
                            else
                            {
                                var html = '';
                                html+='<input name="new_court_fee_sts" id="new_court_fee_sts" value="0" type="hidden"><input name="court_fee_id" id="court_fee_id" value="'+json.pre_court_fee_data.id+'" type="hidden"><span style="float:left"><strong>Court Fee already Added It will be Replace by this lawyer!</strong></span><input style="float:left;width:100px" name="court_fee_amount" type="hidden" id="court_fee_amount" value="0" onkeypress="return numbersonly(event)" class="text-input-big" />';
                                jQuery("#court_fee_amount_body").html(html);
                                
                            }
                            
                        }
                        else
                        {
                            var html = '';
                            html+='<input name="new_court_fee_sts" id="new_court_fee_sts" value="0" type="hidden"><input name="court_fee_id" id="court_fee_id" value="0" type="hidden"><input style="float:left;width:100px" name="court_fee_amount" type="hidden" id="court_fee_amount" value="0" onkeypress="return numbersonly(event)" class="text-input-big" />';
                            jQuery("#court_fee_amount_body").html(html);
                            jQuery("#court_fee_row").hide();
                        }
                    }
                    else {
                        alert("Something went wrong, please refresh the page.")
                    }

            }
        });
    }
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }
    function close_window2() {
        sendToCheckerMessageDialog2.hide();
        return false;
    }
    function decline_action()
    {
        jQuery("#decline_check").val(1);
        jQuery('#decline_part').css("display", "block");

    }

    function get_user_data_region_wise(){
      var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
      if (item!=null)
      {
          var legal_region = item.value;
          var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
          var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
          jQuery.ajax({
          url: '<?=base_url()?>index.php/hoops/get_dropdown_data',
          async:false,
          type: "post",
         data: { [csrfName]: csrfHash,legal_region : legal_region},
          datatype: "json",
          success: function(response){
              var json = jQuery.parseJSON(response);
              jQuery('.txt_csrfname').val(json.csrf_token);
              var str='';
              var theme = getDemoTheme();
                  var legal_user = [];
                   jQuery.each(json['legal_user'],function(key,obj){
                       legal_user.push({ value: obj.id, label: obj.name+' ('+obj.pin+')' });
                       //alert(obj.name);
                   });
                   jQuery("#legal_user").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select legal user", source: legal_user, width: 215, height: 25});
                   jQuery('#legal_user').focusout(function() {
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
          jQuery("#legal_user").jqxComboBox('clearSelection');
          jQuery("input[name='legal_user']").val('');
      }
   }
   function CustomerPickList(module_name=null,data_field_name=null) {
        if(jQuery("#hidden_final_ln_value").val()!='')
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
    function delete_action(type) {
        var message='';
        if (type=='save') 
        {
            jQuery("#reason_message_body").hide();
            jQuery("#ad_type").val(type);
            jQuery("#message").html('Save');
            jQuery("#button_tag").html('Save');
            jQuery("#email_notification").val(type);
            jQuery("#success_message").val('Save');
        }
        $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
        $('sendToCheckerMessageDialogCancel').style.display = 'inline';
        $('loadingReturn').style.display = 'none';
        sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent'), {position: 'fixed', modal:true, width:470, close:true, id: 'sendToCheckerMessageDialog' });
        
        sendToCheckerMessageDialog.show();
    }
    function close_window()
    {
        sendToCheckerMessageDialog.hide();
    }
    function close_window_statement()
    {
        loadStatementDialog.hide();
    }
    function call_ajax_ad_submit()
    {
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var postData = $('deliver_form').toQueryString()+"&"+csrfName+"="+csrfHash;
        $('sendToCheckerMessageDialogConfirm').style.display = 'none';
        $('sendToCheckerMessageDialogCancel').style.display = 'none';
        $('loadingReturn').style.display = 'inline';
        jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?=base_url()?>index.php/legal_file_process/delete_action/',
                data : postData,
                datatype: "json",
                success: function(response){
                  ///console.log(response);
                    var json = jQuery.parseJSON(response);
                    window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if(json.Message!='OK')
                        {                               
                            alert(json.Message);
                            //window.parent.jQuery("#jqxgrid").jqxGrid('updatebounddata');
                            $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                            $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                            $('loadingReturn').style.display = 'none';
                            sendToCheckerMessageDialog.hide();
                        }else{
                        jQuery("#jqxgrid").jqxGrid('updatebounddata');
                        jQuery("#error").show();
                        jQuery("#error").fadeOut(11500);
                        jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+jQuery("#success_message").val());  
                        $('sendToCheckerMessageDialogConfirm').style.display = 'inline';
                        $('sendToCheckerMessageDialogCancel').style.display = 'inline';
                        $('loadingReturn').style.display = 'none';
                        sendToCheckerMessageDialog.hide();
                        jQuery('#jqxTabs').jqxTabs('select', 0);
                        jQuery('#jqxTabs').jqxTabs('disableAt', 1);
                    }
                }
            });

    }
    function get_court_fee()
    {
        var case_claim_amount = jQuery("#case_claim_amount").val();
        if(isNaN(case_claim_amount)){
            return false;
        }
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>legal_file_process/calculate_court_fee",
            data : {[csrfName]: csrfHash,case_claim_amount: case_claim_amount},
            datatype: "json",
            success: function(response){
            //alert(response);
                var json = jQuery.parseJSON(response);

                jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json['court_fee'])
                    {
                        jQuery("#court_fee").val(json['court_fee']);
                    }
                    else {
                        alert("Something went wrong, please refresh the page.")
                    }

            }
        });
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
                                	<li style="margin-left: 30px;">Data Grid</li>
                                    <li >Form</li>
                                </ul>
                                <!---==== First Tab Start ==========----->
                                <div style="overflow: hidden;">
                                    <div style="border:none;" id="jqxgrid"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <? if(ACKOWLEDGMENTREQUEST==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                        href="<?=base_url()?>index.php/legal_file_process/bulk_operation/blk_ack" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:180px;"  value="Bulk Acknowledgement" /></a>
                                     <? }?>&nbsp;&nbsp;
                                    <? if(LAWYERNOTIFICATIONSENT==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                        href="<?=base_url()?>index.php/legal_file_process/bulk_operation/blk_lawyer" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:200px;"  value="Bulk File assign to lawyer" /></a>
                                     <? }?>&nbsp;&nbsp;
                                     <? if(REASSIGN==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                        href="<?=base_url()?>index.php/legal_file_process/bulk_operation/blk_rf" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:80px;"  value="Bulk RF" /></a>
                                     <? }?>&nbsp;&nbsp;
                                     <? if(APPROVEREASSIGN==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                        href="<?=base_url()?>index.php/legal_file_process/bulk_operation/blk_rf_approve" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:120px;"  value="Bulk RF Approve" /></a>
                                     <? }?>
                                    <div style="font-family: Calibri; margin: 10px 0 -10px 5px;font-size:14px;color:#0000cc">
                                        <strong>P = </strong> Preview,&nbsp;
                                        <strong>ACK = </strong>Acknowledgement,&nbsp;
                                        <strong>RF = </strong>Reassign File,&nbsp;
                                        <strong>AR = </strong>Approve Reassign,&nbsp;
                                        <strong>STM = </strong>Statement Download,&nbsp;
                                        <strong>ADI = </strong>Additional Input,&nbsp;
                                        <strong>SNL = </strong>Send Notification To Lawyer,&nbsp;
                                        <strong>SF = </strong>Suit Filling,&nbsp;
                                        <strong>SFA = </strong>Send For Authorization,&nbsp;
                                        <strong>EC = </strong>Edit Court Fee & Case Claim Amount,&nbsp;
                                        <strong>SFC = </strong>Suit File Confirm,&nbsp;
                                        <strong>AM = </strong>Authorization Memo&nbsp;
                                    </div> <br/>
                                    </div>
                                </div>
                                
                                <!---==== Second Tab Start ==========----->
                                <div style="overflow: hidden;" class="back_image">
                                    <div style="padding: 10px;">
                                    <form class="form" name="deliver_form" id="deliver_form" method="post" action="" enctype="multipart/form-data">
                                        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        <input name="ad_type" id="ad_type" value="" type="hidden">
                                        <input type="hidden" id="ad_deleteEventId" name="ad_deleteEventId" value="" />
                                        <table style="width:100%;" id="tab1Table" >
                                            <tbody>
                                                <tr>
                                                    <td width="100%">
                                                    <table style="width: 100%;float:left" border="0">
                                                        <tr>
                                                            <td width="25%" style="border:0px"><strong>Selected Lawyer</strong> <span style="color:#FF0000">*</span></td>
                                                            <td width="75%" style="border:0px"><div id="ad_lawyer" tabindex="1" name="ad_lawyer" style="padding-left: 3px"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%" style="border:0px"><strong>Legal Notice Sent Date</strong> <span style="color:#FF0000">*</span></td>
                                                            <td width="75%" style="border:0px"><input type="text" tabindex="2" style="width:250px" name="ln_sent_date" placeholder="dd/mm/yyyy"  id="ln_sent_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("ln_sent_date");</script></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%" style="border:0px"><strong>Legal Notice Validity Date</strong> <span style="color:#FF0000">*</span></td>
                                                            <td width="75%" style="border:0px"><input type="text" tabindex="3" style="width:250px" name="ln_val_dt" placeholder="dd/mm/yyyy"  id="ln_val_dt" value="" ><script type="text/javascript" charset="utf-8">datePicker ("ln_val_dt");</script></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%" style="border:0px"><strong>Legal Notice Status</strong> <span style="color:#FF0000">*</span></td>
                                                            <td width="75%" style="border:0px"><div id="ln_status" tabindex="4" name="ln_status" style="padding-left: 3px"></div></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%" style="border:0px"><strong>Final Legal Notice Scan Copy<span style="color:#FF0000">*</span></strong></td>
                                                            <td width="75%" style="border:0px">
                                                                
                                                                <span id="ln_scan_copy"></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="20%" style="border:0px"><strong>Total Legal Notice Sent</strong> <span style="color:#FF0000">*</span></td>
                                                            <td width="80%" style="border:0px"><input type="text" tabindex="5" id="total_final_ln" name="total_final_ln" style="width:250px" value="" onkeypress="return numbersonly(event)" onKeyUp="javascript:return calculate_total_ln_cost();"></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="20%" style="border:0px"><strong>Total Legal Notice Cost <span id="ln_cal_text"></span></strong> <span style="color:#FF0000">*</span></td>
                                                            <td width="80%" style="border:0px"><input type="hidden"  id="per_ln_cost" name="per_ln_cost" style="width:250px" value=""><input type="text"  id="total_ln_cost" name="total_ln_cost" style="width:250px" value="" onkeypress="return numbersonly(event)"></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="20%" style="border:0px"><strong>Total Legal Notice Cost Remarks</strong></td>
                                                            <td width="80%" style="border:0px"><textarea name="total_ln_cost_remarks" id="total_ln_cost_remarks" style="width:250px;"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%" style="border:0px"><strong>Lawyer Acknowledgement letter</strong></td>
                                                            <td width="75%" style="border:0px">
                                                                
                                                                <span id="lawyer_ack_copy"></span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table  align="center" style="width: 100%;font-size:15px !important;margin-bottom:0px !important" border="0" cellspacing="0" cellpadding="2">
                                          <tr align="center"><td style="border:0px; vertical-align:top;text-align: center;">       
                                            <br/>
                                                &nbsp;&nbsp;&nbsp;
                                                <input type="button" value="Save" id="sendButton" class="btn-small btn-small-normal enabledElem" style="display: inline;cursor:pointer;font-size:16px;" />&nbsp;&nbsp;
                                                <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span><br/>
                                               
                                            </td>
                                          </tr>
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
    <form method="POST" name="suit_form" id="suit_form"   action="<?=base_url()?>index.php/legal_file_process/suit_file_view/<?=$menu_group?>/<?=$menu_cat?>/<?=$menu_links?>/suit_file" style="margin:0px;">
        <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <input name="grid_cma_id" id="grid_cma_id" value="" type="hidden">
    </form>
<!-- Modal for product details -->
    <div id="details" style="visibility:hidden;">
    <div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>
        <form method="POST" name="action_form" id="action_form"  style="margin:0px;" action="<?=base_url()?>index.php/legal_file_process/delete_action" enctype="multipart/form-data">
            <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <input name="cif" id="cif" value="" type="hidden">
            <input name="pre_legal_user" id="pre_legal_user" value="" type="hidden">
            <input name="sec_sts" id="sec_sts" value="" type="hidden">
            <input name="pre_court_fee" id="pre_court_fee" value="" type="hidden">
            <input name="pre_case_claim_amount" id="pre_case_claim_amount" value="" type="hidden">
            <input name="pre_court_fee_id" id="pre_court_fee_id" value="" type="hidden">
            <input name="proposed_type" id="proposed_type" value="" type="hidden">
            <input name="hidden_req_type" id="hidden_req_type" value="" type="hidden">
            <div id="loading_preview" style="text-align:center">
                <span id="loading_p" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
            </div>
            <div style="" id="details_table">
            &nbsp;&nbsp;&nbsp;<img  onClick="printpage('preview_table','gurantor_table','suit_file','facility_card','proposed_type_d')"   style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?=base_url()?>old_assets/images/Print.png" alt="print-preview"  />
                <span id="main_body"></span>
                <br>
                <div id="preview_table"></div>
                <div id="gurantor_table"></div>
                <div id="facility_card"></div>
                <div id="proposed_type_d"></div>
                <div id="close_btn_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <input type="button" class="button6" id="codeOK" value="Close" />
                </div>
                <div id="sendtochecker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                        <input type="button" class="buttonsendtochecker" id="sendtochecker" value="ACK" />
                        <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel" />
                        <span id="sendtochecker_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                    </div>
                </div>
                <div id="lawyer_notification_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: 230px;margin-top: 0px;">
                            <tr>
                                <td>Lawyer:<span style="color: red">*</span></td>
                                <td><div style="float:left" id="lawyer" name="lawyer" style="padding-left: 3px"></div></td>
                            </tr>
                            <tr id="branch_row">
                                <td>Branch:<span style="color: green">*</span></td>
                                <td><div style="float:left" id="branch" name="branch" style="padding-left: 3px"></div></td>
                            </tr>
                            <tr id="bank_row">
                                <td>Bank:<span style="color: red">*</span></td>
                                <td><div style="float:left" id="bank" name="bank" style="padding-left: 3px"></div></td>
                            </tr>
                            <tr id="dishonor_row">
                                <td>Dishonor Date:<span style="color: red">*</span></td>
                                <td><input type="text" name="dishonor_dt" placeholder="dd/mm/yyyy" style="width:245px;float:left" id="dishonor_dt" value="" ><script type="text/javascript" charset="utf-8">datePicker ("dishonor_dt");</script></td>
                            </tr>
                            <tr id="chq_number_row">
                                <td>Chq. Number:<span style="color: red">*</span></td>
                                <td><input type="text" name="chq_number" placeholder="" style="width:245px;float:left" id="chq_number" value="" ></td>
                            </tr>
                            <tr id="chq_amount_row">
                                <td>Chq. Amount:<span style="color: red">*</span></td>
                                <td><input type="text" name="chq_amount" placeholder="" style="width:245px;float:left" id="chq_amount" value="" ></td>
                            </tr>
                            <tr>
                                <td>Select Notification Type:<span style="color: red;">*</span></td>
                                <td><div style="float:left" id="notification_type" name="notification_type" style="padding-left: 3px"></div></td>
                            </tr>
                            <tr style="display:none" id="email_input">
                                <td>Lawyer Email:<span style="color: red;">*</span></td>
                                <td><input style="float:left;width:150px" name="email_address" type="text" id="email_address" value="" class="text-input-big" /></td>
                            </tr>
                            <tr style="display:none" id="mobile_input">
                                <td>Lawyer Mobile:<span style="color: red">*</span></td>
                                <td><input style="float:left;width:150px" name="mobile" type="text" id="mobile" value="" class="text-input-big" /></td>
                            </tr>
                            <tr id="court_fee_row">
                                <td>Court Fee Amount:<span style="color: red">*</span></td>
                                <td><span id="court_fee_amount_body"></span></td>
                            </tr>
                        </table>
                        <div style="clear:both"></div>
                        <div style="margin-top:20px">
                            <input type="button" class="buttonsendtochecker" id="sendnotification" value="Send" />
                            <input type="button" class="buttonclose" id="sendnotificationcancel" onclick="close()" value="Cancel" />
                            <span id="sendnotification_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                        </div>
                    </div>
                </div>
                <div id="reassign_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: 310px;margin-top: 0px;">
                            <tr>
                                <td>Legal Region:</td>
                                <td><div id="legal_region" name="legal_region" style="padding-left: 3px" onchange="get_user_data_region_wise()"></div></td>
                            </tr>
                            <tr>
                                <td>Legal User:<span style="color: red;">*</span></td>
                                <td><div style="float:left" id="legal_user" name="legal_user" style="padding-left: 3px"></div></td>
                            </tr>
                            <tr>
                                <td>Reassign Reason:<span style="color: red;">*</span></td>
                                <td><textarea name="comments" id="comments" style="width:370px;"></textarea></td>
                            </tr>
                        </table>
                        <div style="clear:both"></div>

                        <div style="margin-top:20px">
                            <input type="button" class="buttonsendtochecker" id="reassign" value="Confirm" />
                            <input type="button" class="buttonclose" id="reassigncancel" onclick="close()" value="Cancel" />
                            <span id="reassign_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                        </div>
                    </div>
                </div>
                <div id="authorization_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                        <input type="button" class="buttonsendtochecker" id="authorization" value="Send" />
                        <input type="button" class="buttonclose" id="authorization_cancel" onclick="close()" value="Cancel" />
                        <span id="authorization_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                    </div>
                </div>
                <div id="confirm_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                        <input type="button" class="buttonsendtochecker" id="confirm" value="Confirm" />
                        <input type="button" class="buttonclose" id="confirm_cancel" onclick="close()" value="Cancel" />
                        <span id="confirm_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                    </div>
                </div>
                <div id="closeaccount_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: 300px;margin-top: 0px;">
                            <tr>
                                <td>Attachment<span style="color: green;"> (If Any)</span></td>
                                <td>
                                    <span id="close_account_file"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Remarks<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="close_account_remarks" id="close_account_remarks" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttondelete" id="closeaccount" value="Close" />
                                    <input type="button" class="buttonclose" id="closeaccount_cancel" onclick="close()" value="Cancel" />
                                    <span id="closeaccount_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="reassign_approval_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                        <div id="reject_reason_row" style="display:none">
                            <strong style="vertical-align:top">Reject Reason<span style="color: red;">*</span></strong>
                            <textarea name="reject_reason" id="reject_reason" style="width:370px;"></textarea>
                            </br></br>
                        </div>
                        <input type="button" class="buttondelete" id="reject" value="Reject"/>
                        <input type="button" class="buttonsendtochecker" id="reassign_approval" value="Approve" />
                        <input type="button" class="buttonclose" id="reassign_approval_cancel" onclick="close()" value="Cancel" />
                        <span id="reassign_approval_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                    </div>
                </div>
                <div id="editcourtfee_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: 310px;margin-top: 0px;">
                            <tr id="court_fee_edit_row">
                                <td>Court Fee:<span style="color: red;">*</span></td>
                                <td><input type="text" name="court_fee" id="court_fee" value="" style="width:250px;"></td>
                            </tr>
                            <tr>
                                <td>Case Claim Amount:<span style="color: red;">*</span></td>
                                <td><input type="text" name="case_claim_amount" id="case_claim_amount" value="" onblur="get_court_fee()" style="width:250px;"></td>
                            </tr>
                            <tr>
                                <td>Reason:<span style="color: red;">*</span></td>
                                <td><textarea name="editcourtfee_reason" id="editcourtfee_reason" style="width:250px;"></textarea></td>
                            </tr>
                        </table>
                        <div style="clear:both"></div>
                        <div style="margin-top:20px">
                            <input type="button" class="buttonsendtochecker" id="editcourtfee" value="Save" />
                            <input type="button" class="buttonclose" id="editcourtfeecancel" onclick="close()" value="Cancel" />
                            <span id="editcourtfee_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
    <div id="deleteMessageDialogContent"  style="display:none">
      <div class="hd"><h2 class="conf">Are you sure you want to Acknowledge?</h2></div>
      <form method="POST" name="deleteMessageform" id="deleteMessageform"  style="margin:0px;">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <input name="deleteEventId2" id="deleteEventId2" value="" type="hidden">
        <input name="typebulk" id="typebulk" value="bulk" type="hidden">
        <input name="cif2" id="cif2" value="" type="hidden">
        <input name="action" value="DeleteMessage" type="hidden">
        <div class="bd">
          <div class="inlineError" id="deleteMessageErrorMsg" style="display:none"></div>
          <div class="instrText" style="margin-bottom: 20px">
           This action is permanent.
          </div>
        </div>
        <a class="btn-small btn-small-normal" id="deleteMessageDialogConfirm"><span>Yes</span></a> 
        <a class="btn-small btn-small-secondary" id="deleteMessageDialogCancel"><span>Cancel</span></a> 
        <span id="loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </form>
    </div>
    <div id="sendToCheckerMessageDialogContent"  style="display:none;">
        <div class="hd"><h2 class="conf" style="margin-top:0px">Do you want to <span id="message"></span>?</h2></div>
        <form method="POST" name="sendToCheckerMessageform" id="sendToCheckerMessageform"  style="margin:0px;">
           <input name="success_message" id="success_message" value="" type="hidden">
            <div class="bd">
              <div class="inlineError" id="sendToCheckerMessageErrorMsg" style="display:none"></div>
              <div class="instrText" style="margin-bottom: 20px"></div>
              <div class="instrText" style="margin-bottom: 20px" id="reason_message_body">
                <span id="reason_message"></span>: <span style="color: red;">*</span> <br><textarea name="reason" id="reason" cols="50"></textarea><br><br>
                <!-- Notify By:&nbsp;&nbsp;
                <label>
                    <input type="checkbox" name="email_notification" id="email_notification" value=""> Email
                </label> -->
                    &nbsp;&nbsp;&nbsp;
              </div>
            </div>
            <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm" onclick="call_ajax_ad_submit()"><span id="button_tag"></span></a> 
            <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel" onclick="close_window()"><span>Cancel</span></a> 
            <span id="loadingReturn" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
        </form>
    </div>
    <div id="sendToCheckerMessageDialogContent2" style="display:none;">
        <form method="POST" name="sendToCheckerMessageform2" id="sendToCheckerMessageform2" style="margin-top:0px;">
            <div class="hd">
                <h2 class="conf" style="margin-top:0px;color:#330707">পূর্ববর্তী উকিলের নামে কোর্ট ফি ইতিমধ্যেই বিতরণ করা হয়েছে।আগের আইনজীবীর কাছ থেকে কোর্ট ফি সফলভাবে ফিরিয়া পাত্তয়ার পর নতুন আইনজীবীর নাম নির্বাচন করতে পারবেন এবং নতুন আইনজীবীর নামে কোর্ট ফি বরাদ্দ হবে।</h2>
            </div>
            <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogCancel2" onclick="close_window2()"><span>Cancel</span></a>
        </form>
    </div>
    <script type="text/javascript">
var theme = getDemoTheme();
    rules= [
            { input: '#lawyer', message: 'required!', action: 'blur, change', rule: function (input) {
                        if(input.val() != '')
                        {
                            var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='lawyer']").val(item.value);}
                            return true;
                        }
                        else
                        {
                            jQuery("#lawyer input").focus();
                            return false;
                        }
                    }
                },
                { input: '#branch', message: 'required!', action: 'blur, change', rule: function (input) {
                        var item = jQuery("#bank").jqxComboBox('getSelectedItem');
                        if(jQuery("#hidden_req_type").val()==1 && item!=null && item.value==6)
                        {
                            if(input.val() != '')
                            {
                                var item = jQuery("#branch").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='branch']").val(item.value);}
                                return true;
                            }
                            else
                            {
                                jQuery("#branch input").focus();
                                return false;
                            }
                        }
                        else
                        {
                            return true;
                        }
                    }
                },
                { input: '#bank', message: 'required!', action: 'blur, change', rule: function (input) {
                        if(jQuery("#hidden_req_type").val()==1)
                        {
                            if(input.val() != '')
                            {
                                var item = jQuery("#bank").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='bank']").val(item.value);}
                                return true;
                            }
                            else
                            {
                                jQuery("#bank input").focus();
                                return false;
                            }
                        }
                        else
                        {
                            return true;
                        }
                    }
                },
                { input: '#chq_number', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        if(jQuery("#hidden_req_type").val()==1)
                        {
                            if(jQuery("#chq_number").val()=='')
                            {
                                jQuery("#chq_number").focus();
                                return false;
                            }
                            else
                            {
                                return true;
                            }
                        }
                        else
                        {
                            return true;
                        }
                        
                    }
                },
                { input: '#chq_amount', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        if(jQuery("#hidden_req_type").val()==1)
                        {
                            if(jQuery("#chq_amount").val()=='')
                            {
                                jQuery("#chq_amount").focus();
                                return false;
                            }
                            else
                            {
                                return true;
                            }
                        }
                        else
                        {
                            return true;
                        }
                        
                    }
                },
                { input: '#chq_amount', message: 'Number is required!', action: 'keyup, blur', rule: function(input,commit){
                        if(jQuery("#hidden_req_type").val()==1)
                        {
                            if(input.val() != '')
                            {
                                if(!checknumber_alphabaticDot('chq_amount'))
                                {
                                    jQuery("#chq_amount").focus();
                                    return false;

                                }
                                else
                                {
                                    return true;
                                }
                            }
                            else
                            {
                                return true;
                            }
                        }
                        else
                        {
                            return true;
                        }
                        
                    }
                },
                { input: '#notification_type', message: 'required!', action: 'blur, change', rule: function (input) {
                        if(input.val() != '')
                        {
                            var item = jQuery("#notification_type").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='notification_type']").val(item.value);}
                            return true;
                        }
                        else
                        {
                            jQuery("#notification_type input").focus();
                            return false;
                        }
                    }
                },
                { input: '#court_fee_amount', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        if((jQuery("#court_fee_amount").val()=='' || jQuery("#court_fee_amount").val()<=0) && jQuery("#new_court_fee_sts").val()==1)
                        {
                            jQuery("#court_fee_amount").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                        
                    }
                },
                { input: '#court_fee_amount', message: 'Number is required!', action: 'keyup, blur', rule: function(input,commit){
                        if(input.val() != '' && jQuery("#new_court_fee_sts").val()==1)
                        {
                            if(!checknumber_alphabaticDot('court_fee_amount'))
                            {
                                jQuery("#court_fee_amount").focus();
                                return false;

                            }
                            else
                            {
                                return true;
                            }
                        }
                        return true;
                    }
                },
                { input: '#dishonor_dt', message: 'required', action: 'keyup, blur, change', rule: function (input, commit){
                    if(jQuery("#hidden_req_type").val()==1)
                    {
                        if (input.val()!='') {
                            return true;
                        }
                        else {
                            return false;
                        }
                    }
                    else
                    {
                        return true;
                    }
                } 
                },
                { input: '#dishonor_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
            { input: '#mobile', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if (jQuery("#notification_type").val() != '') 
                    {
                        var item = jQuery("#notification_type").jqxComboBox('getSelectedItem');
                        if (item.value=='SMS' || item.value=='BOTH') 
                        {
                            if(jQuery("#mobile").val()=='')
                            {
                                jQuery("#mobile").focus();
                                return false;
                            }
                            else
                            {
                                return true;
                            }
                        }
                        else
                        {
                            return true;
                        }
                    }
                    else
                    {
                        return true;
                    }
                    
                }
            },
            { input: '#email_address', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if (jQuery("#notification_type").val() != '') 
                    {
                        var item = jQuery("#notification_type").jqxComboBox('getSelectedItem');
                        if (item.value=='Email' || item.value=='BOTH') 
                        {
                            if(jQuery("#email_address").val()=='')
                            {
                                jQuery("#email_address").focus();
                                return false;
                            }
                            else
                            {
                                return true;
                            }
                        }
                        else
                        {
                            return true;
                        }
                    }
                    else
                    {
                        return true;
                    }
                    
                }
            },
            { input: '#email_address', message: 'invalid e-mail', action: 'keyup', rule: 'email' }
            
            ];
    var options = { 
            complete: function(response) 
            {
                var json = jQuery.parseJSON(response.responseText); 
                window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if (jQuery("#type").val()=='acknowledgement')
                {
                    jQuery("#sendtochecker").show();
                    jQuery("#SendTocheckercancel").show();
                    jQuery("#sendtochecker_loading").hide();
                }
                if (jQuery("#type").val()=='sendnotificationlawyer')
                {
                    jQuery("#sendnotification").show();
                    jQuery("#sendnotificationcancel").show();
                    jQuery("#sendnotification_loading").hide();
                }
                if (jQuery("#type").val()=='sendforauthorization')
                {
                    jQuery("#authorization").show();
                    jQuery("#authorization_cancel").show();
                    jQuery("#authorization_loading").hide();
                }
                if (jQuery("#type").val()=='confirm')
                {
                    jQuery("#confirm").show();
                    jQuery("#confirm_cancel").show();
                    jQuery("#confirm_loading").hide();
                }
                if (jQuery("#type").val()=='reassign')
                {
                    jQuery("#reassign").show();
                    jQuery("#reassigncancel").show();
                    jQuery("#reassign_loading").hide();
                }
                if (jQuery("#type").val()=='closeaccount')
                {
                    jQuery("#closeaccount").show();
                    jQuery("#closeaccount_cancel").show();
                    jQuery("#closeaccount_loading").hide();
                }
                if (jQuery("#type").val()=='reject_reassign_approval')
                {
                    jQuery("#reject_reason_row").hide();
                    jQuery("#reject_reason").val('');
                    jQuery("#reject").show();
                    jQuery("#reassign_approval").show();
                    jQuery("#reassign_approval_cancel").show();
                    jQuery("#reassign_approval_loading").hide();
                }
                if (jQuery("#type").val()=='reassign_approval')
                {
                    jQuery("#reject_reason_row").hide();
                    jQuery("#reject_reason").val('');
                    jQuery("#reject").show();
                    jQuery("#reassign_approval").show();
                    jQuery("#reassign_approval_cancel").show();
                    jQuery("#reassign_approval_loading").hide();
                }
                if (jQuery("#type").val()=='editcourtfee')
                {
                    jQuery("#editcourtfee").show();
                    jQuery("#editcourtfeecancel").show();
                    jQuery("#editcourtfee_loading").hide();
                }
                if(json.Message!='OK')
                {
                    if(json.Message=='99999')
                    {
                        jQuery('#details').jqxWindow('close');
                        $('sendToCheckerMessageDialogCancel2').style.display = 'inline';
                        sendToCheckerMessageDialog2 = new EOL.dialog($('sendToCheckerMessageDialogContent2'), {
                            position: 'fixed',
                            modal: true,
                            width: 470,
                            close: true,
                            id: 'sendToCheckerMessageDialog2'
                        });
                        sendToCheckerMessageDialog2.show();
                        return false;
                    }
                    else
                    {
                        jQuery('#details').jqxWindow('close');
                        alert(json.Message);
                        return false;
                    }
                }else{
                var row = {};
                row["id"] = json['row_info'].id;
                row["sl_no"] = json['row_info'].sl_no;
                row["loan_ac"] = json['row_info'].loan_ac;
                row["ac_name"] = json['row_info'].ac_name;

                var msz='';

                jQuery("#jqxgrid").jqxGrid('updatebounddata');
                jQuery("#error").show();
                jQuery("#error").fadeIn(100, function(){jQuery("#error").fadeOut(11500);});                             
                jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully '+$('type').value+msz); 
                jQuery('#details').jqxWindow('close');
            }
                            
            }  
        }; 
        jQuery("#action_form").ajaxForm(options);
        jQuery("#closeaccount").click(function () {
            if(jQuery("#close_account_remarks").val()=='')
            {
                alert('Please Give Remarks');
                jQuery("#close_account_remarks").focus();
                return false; 
            }
            if(confirm("Are you sure you want to Close this account"))
            {
                jQuery("#closeaccount").hide();
                jQuery("#closeaccount_cancel").hide();
                jQuery("#closeaccount_loading").show();
                jQuery("#action_form").submit();
            }
         });
        jQuery("#sendtochecker").click(function () {
                jQuery("#sendtochecker").hide();
                jQuery("#SendTocheckercancel").hide();
                jQuery("#sendtochecker_loading").show();
                jQuery("#action_form").submit();
             });
            jQuery("#authorization").click(function () {
                jQuery("#authorization").hide();
                jQuery("#authorization_cancel").hide();
                jQuery("#authorization_loading").show();
                jQuery("#action_form").submit();
             });
            jQuery("#confirm").click(function () {
                jQuery("#confirm").hide();
                jQuery("#confirm_cancel").hide();
                jQuery("#confirm_loading").show();
                jQuery("#action_form").submit();
             });
            jQuery("#reject").click(function () {
                jQuery("#reject_reason_row").show();
                jQuery('#type').val('reject_reassign_approval');
                if(jQuery("#reject_reason").val()=='')
                {
                   alert('Please Give Reject Reason');
                    jQuery("#reject_reason").focus();
                    return false; 
                }
                else
                {
                    jQuery("#reject").hide();
                    jQuery("#reassign_approval").hide();
                    jQuery("#reassign_approval_cancel").hide();
                    jQuery("#reassign_approval_loading").show();
                    jQuery("#action_form").submit();
                }
             });
            jQuery("#reassign_approval").click(function () {
                    jQuery('#type').val('reassign_approval');
                    jQuery("#reject").hide();
                    jQuery("#reassign_approval").hide();
                    jQuery("#reassign_approval_cancel").hide();
                    jQuery("#reassign_approval_loading").show();
                    jQuery("#action_form").submit();
             });
            jQuery("#reassign").click(function () {
                if(jQuery("#comments").val()=='')
                {
                   alert('Please Give Reassign Reason');
                    jQuery("#comments").focus();
                    return false; 
                }
                var item = jQuery("#legal_user").jqxComboBox('getSelectedItem');
                if (item!=null)
                {
                    jQuery("#reassign").hide();
                    jQuery("#reassigncancel").hide();
                    jQuery("#reassign_loading").show();
                    jQuery("#action_form").submit();
                }
                else
                {
                    alert('Please Select Legal User');
                    jQuery("#legal_user input").focus();
                    return false;
                }
                
             });
            jQuery("#sendnotification").click(function () {
                jQuery('#action_form').jqxValidator({
                        rules: rules, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#sendnotification").hide();
                        jQuery("#sendnotificationcancel").hide();
                        jQuery("#sendnotification_loading").show();
                        jQuery("#action_form").submit();
                    }
                }
                jQuery('#action_form').jqxValidator('validate', validationResult);
             });
            var rules2=[
                { input: '#court_fee', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#court_fee").val()=='' && jQuery("#pre_court_fee_id").val()!='')
                    {
                        jQuery("#court_fee").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#court_fee', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                   if(input.val() != '')
                   {
                      if(!checknumber_alphabatic('court_fee'))
                      {
                         jQuery("#court_fee").focus();
                         return false;

                      }
                      
                   }
                   return true;

                } },
                { input: '#case_claim_amount', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#case_claim_amount").val()=='')
                    {
                        jQuery("#case_claim_amount").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#case_claim_amount', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                   if(input.val() != '')
                   {
                      if(!checknumber_alphabatic('case_claim_amount'))
                      {
                         jQuery("#case_claim_amount").focus();
                         return false;

                      }
                      
                   }
                   return true;

                } },
                { input: '#editcourtfee_reason', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    if(jQuery("#editcourtfee_reason").val()=='')
                    {
                        jQuery("#editcourtfee_reason").focus();
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#editcourtfee_reason', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>250)
                        {
                            jQuery("#editcourtfee_reason").focus();
                            return false;

                        }
                    }
                    return true;

                } },
            ];
            jQuery("#editcourtfee").click(function () {
                jQuery('#action_form').jqxValidator({
                        rules: rules2, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#editcourtfee").hide();
                        jQuery("#editcourtfeecancel").hide();
                        jQuery("#editcourtfee_loading").show();
                        jQuery("#action_form").submit();
                    }
                }
                jQuery('#action_form').jqxValidator('validate', validationResult);
             });
</script>