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
        background-position: -18px 89%;
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
            var proposed_type = ["Loan", "Card"];
            var req_type_id=0;
            var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var case_sts_grid = [<? $i=1; foreach($case_sts as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];

            var req_type = [<? $i=1; foreach($req_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var case_name = [<? $i=1; foreach($case_name as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];



            var final_remarks = [<? $i=1; foreach($final_remarks as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var region = [<? $i=1; foreach($region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            // var territory = [<?// $i=1; foreach($territory as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var cma_district = [];
          
            var territory =[];
            var loan_segment = [<? $i=1; foreach($loan_segment as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.'"}'; $i++;}?>];
            var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
          
          
          
          
          
          
            jQuery(document).ready(function () {
            var theme = 'classic';
            var legal_district = [];
            var court = [];
            jQuery("#req_type_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Type Of Case", source: req_type, width: 150, height: 30});


            jQuery("#type_of_case").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Type Of Case", source: req_type, width: 250, height: 25});

            jQuery("#type_of_case_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Case Name", source: case_name, width: 250, height: 25});



            jQuery("#proposed_type_grid").jqxComboBox({theme: theme, width: 100, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
            jQuery("#proposed_type").jqxComboBox({theme: theme, width: 150, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
             //var theme = 'energyblue';
             jQuery("#final_remarks").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Rmarks", source: final_remarks, width: 250, height: 25});
          
          
             jQuery("#region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Recovery Region", source: region, width: 250, height: 25});
             jQuery("#territory").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Territory", source: territory, width: 250, height: 25});
             jQuery("#cma_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: cma_district, width: 250, height: 25});
            jQuery("#loan_segment").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Portfolio", source: loan_segment, width: 250, height: 25});
            jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Region", source: legal_region, width: 250, height: 25});
            jQuery("#district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: 250, height: 25});

        
        
        
            jQuery("#next_dt_sts").jqxCheckBox({width: 22, theme: theme ,checked:true });
           jQuery('#proposed_type,#legal_region,#final_remarks,#proposed_type_grid,#req_type_grid,#next_date_sts_grid,#region,#territory,#cma_district,#loan_segment,#district').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
           //jQuery('#final_remarks').jqxComboBox({ disabled: true });
           jQuery("#proposed_type").jqxComboBox('val','Loan');
           jQuery("#proposed_type_grid").jqxComboBox('val','Loan');
            change_caption_grid();
            jQuery('#proposed_type_grid').bind('change', function (event) {
                jQuery("#loan_ac_grid").val('');
                jQuery("#hidden_loan_ac_grid").val('');
                change_caption_grid();       
            });

            // New Code Add On 8/29/2023
            jQuery('#region').bind('change', function (event) {
                change_dropdown('region');
            });

            jQuery('#territory').bind('change', function (event) {
                change_dropdown('territory');
            });


            jQuery('#legal_region').bind('change', function (event) {
                change_dropdown('legal_region');
            });

            // New Code Add On 8/29/2023



            jQuery('#case_sts_prev_dt').bind('change', function (event) {
                var item = jQuery("#case_sts_prev_dt").jqxComboBox('getSelectedItem');
                if (item!=null)
                {
                    set_final_remarks(item.value,req_type_id);
                }

            });
            jQuery("#next_dt_sts").bind('change', function (event) {
                var checked = event.args.checked;
                if(checked==true){ 
                    jQuery("#next_dt_sts_value").val(1); 
                    jQuery("#next_date").val(''); 
                    jQuery("#next_date").show();
                    jQuery("#next_sts_text").html('');
                    jQuery("#next_sts_text").hide();
                    jQuery("#not_available_row").hide();
                    jQuery("#not_available_sts_value").val(0); 

                               
                }else{
                    jQuery('#not_available_sts').jqxCheckBox({ checked:false }); 
                    jQuery("#not_available_sts_value").val(0); 
                    jQuery("#not_available_row").show();
                    jQuery("#next_dt_sts_value").val(0); 
                    jQuery("#next_date").val(''); 
                    jQuery("#next_date").hide(); 
                    jQuery("#next_sts_text").html('<strong><?=$sys_config->next_dt_text?></strong>'); 
                    jQuery("#next_sts_text").show();
            }
            });
            jQuery("#not_available_sts").bind('change', function (event) {
                var checked = event.args.checked;
                if(checked==true){ 
                    jQuery("#not_available_sts_value").val(1); 
                    jQuery("#not_available_text").html('<strong><?=$sys_config->not_available_text?></strong>'); 
                    jQuery("#not_available_text").show();
                               
                }else{
                    jQuery("#not_available_text").html('');
                    jQuery("#not_available_text").hide();
                    jQuery("#not_available_sts_value").val(0); 
            }
            });
            //For Additional input form
            jQuery("#sendButton").click(function () 
            {
                var validationResult = function (isValid) {
                    if (isValid) {
                        if (jQuery("#hidden_final_ln_select").val()=='0') 
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
            jQuery("#confirm").click(function () {
                jQuery("#confirm").hide();
                jQuery("#confirm_cancel").hide();
                jQuery("#confirm_loading").show();
                call_ajax_submit();
             });
            jQuery('#final_remarks').bind('change', function (event) {
                var item = jQuery("#final_remarks").jqxComboBox('getSelectedItem');
                if (item!=null && item.value==2)
                {
                    jQuery("#next_dt_row").hide();
                    jQuery("#next_sts_row").hide();
                    jQuery("#next_remarks_row").hide();
                    jQuery("#case_sts_next_dt").jqxComboBox('clearSelection');
                    jQuery("input[name='case_sts_next_dt']").val('');
                    jQuery("#next_date").val('');
                    jQuery("#remarks_next_date").val('');
                    jQuery("#next_dt_sts_value").val(1); 
                }
                else
                {
                    jQuery("#next_dt_row").show();
                    jQuery("#next_sts_row").show();
                    jQuery("#next_remarks_row").show();
                }
            });
            rules2=[
                { input: '#new_next_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                { input: '#next_date_sts_grid', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#next_date_sts_grid").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='next_date_sts_grid']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        if(jQuery("#new_next_date").val()!='')
                        {
                            jQuery("#next_date_sts_grid input").focus();
                            return false;
                        }
                        return true;
                    }
                }  
                },
            ];
            rules3=[
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
            ];
            rules5=[
                { input: '#putup_comments', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        if(jQuery("#putup_comments").val()=='')
                        {
                            jQuery("#putup_comments").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                    }
                    },

                    { input: '#putup_comments', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                     {
                        if(input.val() != '')
                        {
                            if(input.val().length>250)
                            {
                                jQuery("#putup_comments").focus();
                                return false;

                            }
                        }
                        return true;

                    } },
            ];
            jQuery("#reassign").click(function () {
                if(jQuery("#reassign_reason").val()=='')
                {
                   alert('Please Give Reassign Reason');
                    jQuery("#reassign_reason").focus();
                    return false; 
                }
                var item = jQuery("#legal_user").jqxComboBox('getSelectedItem');
                if (item!=null)
                {
                    jQuery("#reassign").hide();
                    jQuery("#reassigncancel").hide();
                    jQuery("#reassign_loading").show();
                    call_ajax_submit();
                }
                else
                {
                    alert('Please Select Legal User');
                    jQuery("#legal_user input").focus();
                    return false;
                }
                
             });
            jQuery("#reject").click(function () {
                jQuery("#reject_reason_row").show();
                jQuery('#type').val('reject_reassign_approval_file');
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
                    call_ajax_submit();
                }
             });
            jQuery("#reassign_approval").click(function () {
                    jQuery('#type').val('reassign_approval_file');
                    jQuery("#reject").hide();
                    jQuery("#reassign_approval").hide();
                    jQuery("#reassign_approval_cancel").hide();
                    jQuery("#reassign_approval_loading").show();
                    call_ajax_submit();
             });
            jQuery("#reject_putup").click(function () {
                jQuery("#reject_reason_row_putup").show();
                jQuery('#type').val('reject_putup_approval_file');
                if(jQuery("#reject_reason_putup").val()=='')
                {
                   alert('Please Give Reject Reason');
                    jQuery("#reject_reason_putup").focus();
                    return false; 
                }
                else
                {
                    jQuery("#reject_putup").hide();
                    jQuery("#putup_approval").hide();
                    jQuery("#putup_approval_cancel").hide();
                    jQuery("#putup_approval_loading").show();
                    call_ajax_submit();
                }
             });
            jQuery("#putup_approval").click(function () {
                    jQuery('#type').val('putup_approval_file');
                    jQuery("#reject_putup").hide();
                    jQuery("#putup_approval").hide();
                    jQuery("#putup_approval_cancel").hide();
                    jQuery("#putup_approval_loading").show();
                    call_ajax_submit();
             });
            jQuery("#updatenextdate").click(function () {
                jQuery('#action_form').jqxValidator({
                        rules: rules2, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#updatenextdate").hide();
                        jQuery("#nextdatecancel").hide();
                        jQuery("#nextdate_loading").show();
                        call_ajax_submit();
                    }
                }
                jQuery('#action_form').jqxValidator('validate', validationResult);
             });
            jQuery("#delete_button").click(function () {
                jQuery('#action_form').jqxValidator({
                        rules: rules3, theme: theme
                });
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

            jQuery("#putup_button").click(function () {
                jQuery('#action_form').jqxValidator({
                        rules: rules5, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#putup_button").hide();
                        jQuery("#putupcancel").hide();
                        jQuery("#putup_loading").show();
                        call_ajax_submit();
                    }
                }
                jQuery('#action_form').jqxValidator('validate', validationResult);
             });
            
            var initGrid = function () {
                var source =
                {
                   datatype: "json",
                   datafields: [
                            { name: 'id', type: 'int'},
                            { name: 'legal_user', type: 'int'},
                            { name: 'case_deal_officer', type: 'int'},
                            { name: 'cma_id', type: 'int'},
                            { name: 'sts', type: 'string'},
                            { name: 'loan_ac', type: 'string'},
                            { name: 'ac_name', type: 'string'},
                            { name: 'status', type: 'string'},
                            { name: 'request_type_name', type: 'string'},
                            { name: 'region_name', type: 'string'},
                            { name: 'territory_name', type: 'string'},
                            { name: 'district_name', type: 'string'},
                            { name: 'suit_sts', type: 'int'},
                            { name: 'proposed_type', type: 'string'},
                            { name: 'loan_segment', type: 'string'},
                            { name: 'case_number', type: 'string'},
                            { name: 'sec_sts', type: 'int'},
                            { name: 'district', type: 'int'},
                            { name: 'e_by_id', type: 'int'},
                            { name: 'e_by', type: 'string'},
                            { name: 'e_dt', type: 'string'}
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
                        url: '<?=base_url()?>index.php/edit_suit_file/grid',
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
                            },
                            formatData: function (data) {
                            var proposed_type = jQuery.trim(jQuery('input[name=proposed_type_grid]').val());
                            var req_type = jQuery.trim(jQuery('#req_type_grid').val());
                            var loan_ac = jQuery.trim(jQuery('#loan_ac_grid').val());
                            var hidden_loan_ac = jQuery.trim(jQuery('#hidden_loan_ac_grid').val());
                            var case_number = jQuery.trim(jQuery('#case_number_grid').val());
                            jQuery.extend(data, {
                                proposed_type : proposed_type,
                                req_type : req_type,
                                loan_ac : loan_ac,
                                hidden_loan_ac : hidden_loan_ac,
                                case_number : case_number

                            });
                            return data;
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
                                <? if(EDIT==1){?>
                                  { text: 'ESF', datafield: 'suitfileedit', editable: false,align:'center', sortable: false, menu: false, width: 35,
                                    cellsrenderer: function(row) {
                                        editrow = row;
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                        return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit_suit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                    }
                                  },
                                <? }?>
                                { text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                                    cellsrenderer: function (row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details('+dataRecord.id+',\'details\','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                                      }
                                },
                                { text: 'Status', datafield: 'status',editable: false, width: '30%', align:'left',cellsalign:'left'},
                                { text: 'Requisition', datafield: 'request_type_name',editable: false, width: '8%', align:'left',cellsalign:'left'},
                                { text: 'Protfolio', datafield: 'loan_segment',editable: false, width: '8%', align:'left',cellsalign:'left'},
                                { text: 'Loan A/C or Card No.', datafield: 'loan_ac', editable: false,align:'center',cellsalign:'center', sortable: true, menu: true, width: '13%',
                                    cellsrenderer: function(row) {
                                        editrow = row;
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                        return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\')"><span>'+dataRecord.loan_ac+'</span></a></div>';
                                        
                                    }
                                  },
                                { text: 'A/C Name or Name on Card', datafield: 'ac_name',editable: false, width: '15%', align:'left',cellsalign:'left'},
                                { text: 'Case Number', datafield: 'case_number',editable: false, width: '20%', align:'left',cellsalign:'left'},
                                { text: 'Region', datafield: 'region_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                                { text: 'Territory', datafield: 'territory_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                                { text: 'District', datafield: 'district_name',editable: false, width: '10%', align:'left',cellsalign:'left'},
                                { text: 'Initiate By', datafield: 'e_by',editable: false, width: '15%' , align:'left',cellsalign:'left'},
                                { text: 'Initiate Date Time', datafield: 'e_dt',editable: false, width: '12%' , align:'center',cellsalign:'center'},
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
               jQuery('#suit_file_form').jqxValidator('hide');
               if(event.args.item==1){
                //clear_form();
                    jQuery('#jqxTabs').jqxTabs('disableAt', 0);
                }
            });
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            //End check box update 
            jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#sendnotificationcancel,#authorization_cancel,#confirm_cancel,#reassigncancel,#closeaccount_cancel,#deletecancel,#nextdatecancel,#reassign_approval_cancel,#putupcancel,#putup_approval_cancel") });
            jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
            jQuery('#details').on('close', function (event) {
                jQuery('#action_form').jqxValidator('hide');
            });
        });


    function change_dropdown(operation,edit=null)
    {
        var id='';
        //check for add Region action
        if (edit==null && operation!='legal_district_case_deal_officer' && operation!='court') 
        {
            id = jQuery("#"+operation).val();
        }
        else if(operation=='court')
        {
            id = jQuery("#new_legal_district").val();
        }
        else if(operation=='legal_district_case_deal_officer')
        {
            id = jQuery("#legal_district").val();
        }
        else
        {
            id=edit;
        }
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
        url: '<?php echo base_url(); ?>index.php/user_info/get_dropdown_data',
        async:false,
        type: "post",
        data: { [csrfName]: csrfHash,id : id,operation:operation},
        datatype: "json",
        success: function(response){
                var json = jQuery.parseJSON(response);
                        //console.log(json['row_info']);
                        var  csrf_tokena = json.csrf_token;
                        jQuery('.txt_csrfname').val(json.csrf_token);
                        var str='';
                        var theme = getDemoTheme();
                        if (operation=='legal_region') 
                        {
                            var legal_district = [];
                            jQuery.each(json['row_info'],function(key,obj){
                                legal_district.push({ value: obj.id, label: obj.name });
                                //alert(obj.name);
                            });

                            jQuery("#district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: 250, height: 25});


                        }
                        if (operation=='court') 
                        {
                            var court = [];
                            jQuery.each(json['row_info'],function(key,obj){
                                court.push({ value: obj.id, label: obj.name });
                                //alert(obj.name);
                            });
                            jQuery("#court").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Select Court", source: court, width: 215, height: 25});
                        }
                        if (operation=='legal_district_case_deal_officer') 
                        {
                            var case_deal_officer = [];
                            jQuery.each(json['row_info'],function(key,obj){
                                case_deal_officer.push({ value: obj.id, label: obj.name+'('+obj.pin+')' });
                                //alert(obj.name);
                            });
                            jQuery("#case_deal_officer").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Case Deal Officer", source: case_deal_officer, width: 215, height: 25});
                     
                        }

                        if (operation=='region') 
                        {

                            var territory = [];
                            jQuery.each(json['row_info'],function(key,obj){
                                territory.push({ value: obj.id, label: obj.name });
                            });
                    
                            jQuery("#territory").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Territory", source: territory, width: 250, height: 25});
                        }

                        if (operation=='territory') 
                        {
                            var cma_district = [];
                            jQuery.each(json['row_info'],function(key,obj){
                                cma_district.push({ value: obj.id, label: obj.name });
                            });
                    
                            jQuery("#cma_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: cma_district, width: 250, height: 25});

                        }

            },
            error:   function(model, xhr, options){
                alert('failed');
            },
            });

            return false;
    }
    function search_data(){
        jQuery("#grid_search").hide();
        jQuery("#grid_loading").show();
        jQuery("#jqxgrid").jqxGrid('updatebounddata');
        jQuery("#grid_search").show();
        jQuery("#grid_loading").hide();
        return;

    }
    function mask_grid(str,textbox){
        var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
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
                    jQuery("#hidden_loan_ac_grid").val(str);
                }
                else//For single value enter
                {
                    //For New value
                    var orginal_loan_ac=jQuery("#hidden_loan_ac_grid").val();
                    if (orginal_loan_ac.length<str.length) 
                    {
                        var index = str.length-1;
                        var new_val=str.slice(index);
                        orginal_loan_ac+=new_val;
                        //alert(orginal_loan_ac);
                        jQuery("#hidden_loan_ac_grid").val(orginal_loan_ac);
                    }
                    //For delete key
                    else{
                        var len=str.length;
                        var new_val=orginal_loan_ac.slice(0,len);
                        jQuery("#hidden_loan_ac_grid").val(new_val);
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
                          if (letter_Count<6 || jQuery("#hidden_loan_ac_grid").val().length!=16) 
                          {
                            textbox.value = '';
                            jQuery("#hidden_loan_ac_grid").val('');
                            alert('Wrong way to input Card No please try again');
                          }
                    }
                }
            }
        }
        
    }
    function change_caption_grid()
    {   
        if (jQuery("#proposed_type_grid").val()=='') 
        {
            document.getElementById("loan_ac_grid").disabled = true;
            jQuery("#l_or_c_no_grid").html('Loan A/C or Card');
        }
        else
        {
            document.getElementById("loan_ac_grid").disabled = false;
            var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
            if (item.value=='Loan') {
                jQuery("#l_or_c_no_grid").html('Loan A/C ');
            }
            else if(item.value=='Card'){
                jQuery("#l_or_c_no_grid").html('Card');
            }
        }
        
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
            url: "<?=base_url()?>legal_file_process/r_history",
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
    function details(id,operation,indx,cma_id,proposed_type,sec_sts)
    {
        jQuery('#deleteEventId').val(id);
        jQuery('#type').val(operation);
        jQuery('#sec_sts').val(sec_sts);
        if (proposed_type==1) 
        {
            var type='Loan';
        }else{var type='Card';}
        jQuery('#proposed_type').val(type);
        jQuery('#verifyIndexId').val(indx);
        if (operation=='details') 
        {
            jQuery("#header_title").html('Suit File Details');
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
            url: "<?=base_url()?>legal_file_process/details",
            data : {[csrfName]: csrfHash,id: id,cma_id:cma_id,operation:operation},
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
                    }
                    else {
                        alert("Something went wrong, please refresh the page.")
                    }

            }
        });
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
    function mask(str,textbox){
        var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
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
    function error()
    {
        alert('Please Select Suit');
    }
    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('suit_id')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }
    function date_formater(str)
    {
        //var str_1=str.split("T");
        if (str=='' || str==undefined) 
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
    function edit_suit(id,index,ho_edit_sts=null){
        var val=id;
        jQuery('#next_button').hide();
        jQuery('#next_loading').show();
        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?=base_url()?>edit_suit_file/get_filing_info_edit",
            data : {[csrfName]: csrfHash,id:val},
            datatype: "json",
            async:false,
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if(json.Message=='ok'){
                    var html = '';
                    req_type_id = json.row_info.req_type;
                    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'arji_copy\')"/>';
                    html+='<input type="hidden" id="hidden_arji_copy_select" name="hidden_arji_copy_select" value="0">';
                    html+='<span id="hidden_arji_copy"></span><input type="hidden" id="arji_select_add_edit" name="arji_select_add_edit" value="add">';
                    jQuery('#arji_copy').html(html);
                    jQuery('#add_edit').val('edit');
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    jQuery('#search_area').hide();
                    jQuery('#suit_form_div').show();
                    var form_html = '';
                    var case_sts = [];
                    jQuery.each(json['case_sts'],function(key,obj){
                        case_sts.push({ value: obj.id, label: obj.name });
                    });
                    var plaintiff = [];
                    jQuery.each(json['plaintiff'],function(key,obj){
                        plaintiff.push({ value: obj.id, label: obj.name+' ('+obj.pin+')' });
                    });
                    var lawyer = [];
                    jQuery.each(json['lawyer'],function(key,obj){
                        lawyer.push({ value: obj.id, label: obj.name });
                    });
                    var court = [];
                    jQuery.each(json['court'],function(key,obj){
                        court.push({ value: obj.id, label: obj.name });
                    });
                    //jQuery("#case_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Name", source: case_name, width: 250, height: 25});
                    jQuery("#case_sts_prev_dt").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Status", source: case_sts, width: 250, height: 25});
                    jQuery("#case_sts_next_dt").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Status", source: case_sts, width: 250, height: 25});
                    jQuery("#filling_plaintiff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Filling Plaintiff", source: plaintiff, width: 250, height: 25});
                    jQuery("#case_deal_officer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Dealing Officer", source: plaintiff, width: 250, height: 25});
                    //jQuery("#prev_lawyer_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
                    jQuery("#prest_lawyer_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
                    //jQuery("#prev_court_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court", source: court, width: 250, height: 25});
                    jQuery("#prest_court_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court", source: court, width: 250, height: 25});
                    jQuery('#case_name,#case_sts_prev_dt,#case_sts_next_dt,#filling_plaintiff,#case_deal_officer,#prev_lawyer_name,#prest_lawyer_name,#prev_court_name,#prest_court_name').focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
                    });
                    //jQuery('#prev_lawyer_name').jqxComboBox('val', json.row_info.prev_lawyer_name);
                    jQuery('#prest_lawyer_name').jqxComboBox('val', json.row_info.prest_lawyer_name);
                    jQuery('#filling_plaintiff').jqxComboBox('val', json.row_info.filling_plaintiff);
                    jQuery('#case_deal_officer').jqxComboBox('val', json.row_info.case_deal_officer);
                    //jQuery('#case_name').jqxComboBox('val', json.row_info.case_name);
                    jQuery('#case_sts_prev_dt').jqxComboBox('val', json.row_info.case_sts_prev_dt);
                    jQuery('#case_sts_next_dt').jqxComboBox('val', json.row_info.case_sts_next_dt);
                    jQuery('#filling_plaintiff').jqxComboBox('val', json.row_info.filling_plaintiff);
                    //jQuery('#prev_court_name').jqxComboBox('val', json.row_info.prev_court_name);
                    jQuery('#prest_court_name').jqxComboBox('val', json.row_info.prest_court_name);
                    jQuery("#case_claim_amount").val(json.row_info.case_claim_amount);
                    jQuery("#judge_name").val(json.row_info.judge_name);
                    jQuery("#judge_phone").val(json.row_info.judge_phone);
                    jQuery("#loan_ac_show").html(json.row_info.loan_ac);
                    jQuery("#ac_name_show").html(json.row_info.ac_name);


        
                    jQuery("#hidden_cma_id").val(json.row_info.cma_id);
                    jQuery("#edit_id").val(json.row_info.id);
                    jQuery("#final_remarks").jqxComboBox('val',json.row_info.final_remarks);


                    jQuery("#region").jqxComboBox('val',json.row_info.region);
                    jQuery("#territory").jqxComboBox('val',json.row_info.territory);
                    jQuery("#cma_district").jqxComboBox('val',json.row_info.cma_district);
                    jQuery("#loan_segment").jqxComboBox('val',json.row_info.loan_segment);
                    jQuery("#legal_region").jqxComboBox('val',json.row_info.legal_region);
                    jQuery("#district").jqxComboBox('val',json.row_info.district);

                    jQuery("#type_of_case").jqxComboBox('val',json.row_info.req_type);
                    if(json.row_info.re_case_sts==1){
                        jQuery("#type_of_case_name_row").show();
                        jQuery("#type_of_case_name").jqxComboBox('val',json.row_info.case_name);
                        jQuery("#re_case_sts").val(1);

                    }else{
                        jQuery("#type_of_case_name_row").hide();
                        jQuery("#re_case_sts").val(0);

                    }

                    





                    

                    // if (json.row_info.next_dt_sts==1)
                    // {
                    //     jQuery('#next_dt_sts').jqxCheckBox({ checked:true }); 
                    //     jQuery("#next_dt_sts_value").val(1); 
                    //     jQuery('#next_date').val(json.row_info.next_date);
                    //     jQuery("#next_date").show();
                    //     jQuery("#next_sts_text").html('');
                    //     jQuery("#next_sts_text").hide();
                    
                    // }else
                    // {
                    //    jQuery('#next_dt_sts').jqxCheckBox({ checked:false }); 
                    //    jQuery("#next_dt_sts_value").val(0); 
                    //     jQuery("#next_date").val(''); 
                    //     jQuery("#next_date").hide(); 
                    //     jQuery("#next_sts_text").html('<strong><?=$sys_config->next_dt_text?></strong>'); 
                    //     jQuery("#next_sts_text").show();
                    // }

                    if (json.row_info.next_dt_sts==1)
                    {
                        jQuery('#next_dt_sts').jqxCheckBox({ checked:true }); 
                        jQuery("#next_dt_sts_value").val(1); 
                        jQuery('#next_date').val(json.row_info.next_date);
                        jQuery("#next_date").show();
                        jQuery("#next_sts_text").html('');
                        jQuery("#next_sts_text").hide();
                    
                    }else
                    {
                        if (json.row_info.not_available_sts==1)
                        {
                            jQuery('#not_available_sts').jqxCheckBox({ checked:true }); 
                            jQuery("#not_available_sts_value").val(1); 
                            jQuery("#not_available_text").html('<strong><?=$sys_config->not_available_text?></strong>'); 
                            jQuery("#not_available_text").show();
                            jQuery("#not_available_row").show();
                        }
                        else
                        {
                            jQuery('#not_available_sts').jqxCheckBox({ checked:false }); 
                            jQuery("#not_available_sts_value").val(0); 
                            jQuery("#not_available_text").html(''); 
                            jQuery("#not_available_text").hide();
                            jQuery("#not_available_row").show();
                        }
                        jQuery('#next_dt_sts').jqxCheckBox({ checked:false }); 
                        jQuery("#next_dt_sts_value").val(0); 
                        jQuery("#next_date").val(''); 
                        jQuery("#next_date").hide(); 
                        jQuery("#next_sts_text").html('<strong><?=$sys_config->next_dt_text?></strong>'); 
                        jQuery("#next_sts_text").show();
                    }
                   
                    jQuery('#case_number').val(json.row_info.case_number);

                    jQuery('#prev_date').val(json.row_info.prev_date);
                    

                    jQuery('#filling_date').val(date_formater(json.row_info.filling_date));
                    jQuery('#remarks_next_date').val(json.row_info.remarks_next_date);
                    
                    var arji_copy = json.row_info.arji_copy;
                    var html = '';
                    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'arji_copy\')"/>';
                    html+='<input type="hidden" id="hidden_arji_copy_select" name="hidden_arji_copy_select" value="0">';
                    if(arji_copy!='' && arji_copy!=null)
                    {
                        html +='<span id="hidden_arji_copy"><img id="file_preview_arji_copy" onclick="popup(\'<?=base_url()?>cma_file/arji_copy/'+arji_copy+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                        html +='<input type="hidden" id="hidden_arji_copy_value" name="hidden_arji_copy_value" value="'+arji_copy+'">';
                        html +='<img id="file_delete_arji_copy" onclick="file_delete(\'arji_copy\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                        html +='<input type="hidden" id="file_delete_value_arji_copy" name="file_delete_value_arji_copy" value="0">';
                        html+='<span id="hidden_arji_copy"></span><input type="hidden" id="arji_select_add_edit" name="arji_select_add_edit" value="edit">';
                    }
                    else
                    {
                        html+='<span id="hidden_arji_copy"></span><input type="hidden" id="arji_select_add_edit" name="arji_select_add_edit" value="add">';
                    }
                    jQuery('#arji_copy').html(html);

                    jQuery('#jqxTabs').jqxTabs('enableAt', 0);
                    jQuery('#jqxTabs').jqxTabs('select', 0);
                }else{
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    alert("No Data Found");
                    jQuery('#add_edit').val('');
                }
            }
        });

    }
    function date_validation(date1,date2){
           
        var str_subsdt = date1.split("/")
        var subsdt = str_subsdt[1]+"/"+str_subsdt[0]+"/"+str_subsdt[2];
        var subdt = new Date(subsdt);

       
        var str_subsdt2 = date2.split("/")
        var subsdt2 = str_subsdt2[1]+"/"+str_subsdt2[0]+"/"+str_subsdt2[2];
        var subdt2 = new Date(subsdt2);

        if(Date.parse(subdt) < Date.parse(subdt2)){
        return false;
        }

        return true;
    }
    function CheckChanged_2(checkAllBox,counter)
    {
        var ChkState=checkAllBox.checked;
        if (ChkState==true) 
        {
            jQuery("#package_delete_"+counter).val(0);
        }
        else
        {
            jQuery("#package_delete_"+counter).val(1);
        }       
    }
    function clear_form() {
        jQuery("#prest_lawyer_name").jqxComboBox('clearSelection');
        jQuery("input[name='prest_lawyer_name']").val('');
        jQuery("#filling_plaintiff").jqxComboBox('clearSelection');
        jQuery("input[name='filling_plaintiff']").val('');
        jQuery("#case_deal_officer").jqxComboBox('clearSelection');
        jQuery("input[name='case_deal_officer']").val('');
        jQuery("#case_sts_prev_dt").jqxComboBox('clearSelection');
        jQuery("input[name='case_sts_prev_dt']").val('');
        jQuery("#case_sts_next_dt").jqxComboBox('clearSelection');
        jQuery("input[name='case_sts_next_dt']").val('');

        
        jQuery("#type_of_case_name").jqxComboBox('clearSelection');
        jQuery("input[name='type_of_case_name']").val('');

        jQuery("#type_of_case").jqxComboBox('clearSelection');
        jQuery("input[name='type_of_case']").val('');


        jQuery("#case_claim_amount").val('');
        jQuery('#judge_phone').val('');
        jQuery('#judge_name').val('');
        jQuery("#loan_ac_show").html('');
        jQuery("#ac_name_show").html('');
        jQuery("#case_number").val('');
        jQuery("#prev_date").val('');
        jQuery("#next_date").val('');
        jQuery("#remarks_next_date").val('');
        jQuery("#filling_date").val('');
        jQuery("#prest_court_name").jqxComboBox('clearSelection');
        jQuery("input[name='prest_court_name']").val('');
        jQuery("#hidden_cma_id").val('');
        jQuery("#next_dt_sts_value").val(0); 
        jQuery("#next_date").val(''); 
        jQuery("#next_date").show(); 
        jQuery("#next_sts_text").html(''); 
        jQuery("#next_sts_text").hide();
        jQuery("#next_dt_sts_value").val(1); 
        jQuery("#next_date").val(''); 
        jQuery("#next_date").show(); 
        jQuery("#next_sts_text").html(''); 
        jQuery("#next_sts_text").hide();
        jQuery("#not_available_sts_value").val(0); 
        jQuery("#not_available_row").hide(); 



        jQuery("#region").jqxComboBox('clearSelection');
        jQuery("#territory").jqxComboBox('clearSelection');
        jQuery("#cma_district").jqxComboBox('clearSelection');
        jQuery("#loan_segment").jqxComboBox('clearSelection');
        jQuery("#legal_region").jqxComboBox('clearSelection');
        jQuery("#district").jqxComboBox('clearSelection');



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
                   var legal_district = [];
                   jQuery.each(json['legal_district'],function(key,obj){
                       legal_district.push({ value: obj.id, label: obj.name });
                       //alert(obj.name);
                   });
                   jQuery("#new_legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: legal_district, width: 215, height: 25});
                   jQuery('#new_legal_district').focusout(function() {
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
    </script>
    <div id="container">
        <div id="body"  >
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                         <!---- Left Side Menu Start ------>
                        <?php $this->load->view('edit_suit_file/pages/left_side_nav'); ?>
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
                                    <div style="padding: 10px;">
                                        <div id="suit_form_div">
                                              <div id="suit_form_area">
                                                <form method="POST" name="suit_file_form" id="suit_file_form"  style="margin:0px;" action="<?=base_url()?>index.php/edit_suit_file/add_edit_suit_filling" enctype="multipart/form-data">
                                                    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                    <input type="hidden" id="edit_after_verify_sts" value="0" name="edit_after_verify_sts">
                                                    <input type="hidden" id="hidden_cma_id" value="" name="hidden_cma_id" value="">
                                                    <input type="hidden" id="edit_id" value="" name="edit_id" value="">
                                                    <input type="hidden" id="add_edit" value="" name="add_edit" value="">
                                                    <input type="hidden" id="next_dt_sts_value" value="" name="next_dt_sts_value" value="1">
                                                    <input type="hidden" id="not_available_sts_value" value="" name="not_available_sts_value" value="0">
                                                    <input type="hidden" id="re_case_sts" value="" name="re_case_sts" value="0">


                                                    

                                                    <table style="width:100%;margin-top:20px" id="tab1Table" >
                                                        <tbody>
                                                            <tr>
                                                                <td width="50%">
                                                                    <table style="width: 100%;">
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">A/C No./Card No.</td>
                                                                            <td width="60%" ><strong><span id="loan_ac_show"></span></strong></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Name</td>
                                                                            <td width="60%" ><strong><span id="ac_name_show"></span></strong></td>
                                                                        </tr>


                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">3 Type of Case<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="type_of_case" name="type_of_case"></div></td>
                                                                        </tr>
                                                                        <tr id="type_of_case_name_row">
                                                                            <td width="40%" style="font-weight: bold;">Type of Case<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="type_of_case_name" name="type_of_case_name"></div></td>
                                                                        </tr>




                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Filing Date<span style="color:red">*</span></td>
                                                                            <td width="60%" ><input type="text" name="filling_date" tabindex="11" placeholder="dd/mm/yyyy" onchange="set_expense_date('filling_date')" style="width:250px;" id="filling_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("filling_date");</script></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Case Number<span style="color:red">*</span> </td>
                                                                            <td width="60%" >
                                                                               <input name="case_number" type="text" tabindex="1" class="" style="width:250px;float:left" id="case_number" placeholder="case number" value="" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Case Claim Amount<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><input name="case_claim_amount" type="text" tabindex="3" class="" style="width:250px" id="case_claim_amount" value="" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Previous Date<span style="color:red">*</span></td>
                                                                            <td width="60%" ><input type="text" name="prev_date" tabindex="4" placeholder="dd/mm/yyyy" style="width:250px;" id="prev_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("prev_date");</script></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Case Status On The Previous Date<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="case_sts_prev_dt" name="case_sts_prev_dt" style="padding-left: 3px" tabindex="5"></div></td>
                                                                        </tr>
                                                                        <tr id="next_dt_row">
                                                                            <td width="40%" style="font-weight: bold;">Next Date<span style="color:red">*</span></td>
                                                                            <td width="60%" >
                                                                                <input type="text" name="next_date" tabindex="7" placeholder="dd/mm/yyyy" style="width:225px;" id="next_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("next_date");</script>
                                                                                <span id="next_sts_text" style="display:none;margin-left:10px"></span>
                                                                                <div name="next_dt_sts" tabindex="40" id="next_dt_sts" style="float:left; margin: 3px 0px 0 0;"></div>
                                                                            </td>
                                                                        </tr> 
                                                                        <tr id="not_available_row" style="display:none">
                                                                            <td width="40%" style="font-weight: bold;">Not Available</td>
                                                                            <td width="60%" >
                                                                                <span id="not_available_text" style="display:none;margin-left:10px"></span>
                                                                                <div name="not_available_sts" tabindex="40" id="not_available_sts" style="float:left; margin: 3px 0px 0 0;"></div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr id="next_sts_row">
                                                                            <td width="40%" style="font-weight: bold;">Next Case Status</td>
                                                                            <td width="60%" ><div id="case_sts_next_dt" name="case_sts_next_dt" style="padding-left: 3px" tabindex="8"></div></td>
                                                                        </tr>  
                                                                        <tr id="next_remarks_row">
                                                                            <td width="40%" style="font-weight: bold;">Remarks On Case Sts on the Next Date</td>
                                                                            <td width="60%" ><textarea name="remarks_next_date" tabindex="9" class="text-input-big" id="remarks_next_date" style="height:40px !important;width:250px"></textarea></td>
                                                                        </tr>     
                                                       
                                                                        
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Filing Plaintiff<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="filling_plaintiff" name="filling_plaintiff" style="padding-left: 3px" tabindex="10"></div></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>

                                                                <td width="50%" style="display: table-row;">
                                                                    <table style="width: 100%;">  
  
                                                                    <tr>
                                                                            <td width="40%" style="font-weight: bold;">Arji Copy<span style="color:red">*</span></td>
                                                                            <td width="60%" >
                                                                                <span id="arji_copy"></span>
                                                                            </td>
                                                                        </tr>            

                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Case Dealing Officer<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="case_deal_officer" name="case_deal_officer" style="padding-left: 3px" tabindex="12"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Dealing Lawyer<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="prest_lawyer_name" name="prest_lawyer_name" style="padding-left: 3px" tabindex="14"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Present Name Of The Court<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="prest_court_name" name="prest_court_name" style="padding-left: 3px" tabindex="16"></div></td>
                                                                        </tr>   
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Judge Name </td>
                                                                            <td width="60%" ><input name="judge_name" type="text" tabindex="3" class="" style="width:250px" id="judge_name" value="" /></td>
                                                                        </tr>  
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Judge Phone </td>
                                                                            <td width="60%" ><input name="judge_phone" type="text" tabindex="3" class="" style="width:250px" id="judge_phone" value="" /></td>
                                                                        </tr>  
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Final Remarks</td>
                                                                            <td width="60%" ><div id="final_remarks" name="final_remarks" style="padding-left: 3px" tabindex="9"></div></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Recovery Region<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="region" name="region" style="padding-left: 3px" tabindex="9"></div></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Recovery Territory<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="territory" name="territory" style="padding-left: 3px" tabindex="9"></div></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Recovery District<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="cma_district" name="cma_district" style="padding-left: 3px" tabindex="9"></div></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Portfolio<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="loan_segment" name="loan_segment" style="padding-left: 3px" tabindex="9"></div></td>
                                                                        </tr>


                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Legal Region<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="legal_region" name="legal_region" style="padding-left: 3px" tabindex="9"></div></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Legal District<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="district" name="district" style="padding-left: 3px" tabindex="9"></div></td>
                                                                        </tr>





                                                                
                                                                        
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="text-align: center;">
                                                                    <br/>
                                                                    <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;" id="suit_file_save_button" /> <span id="send_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                                    <br/><br/><br/>
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
                                    <div style="padding: 0.5%;width:98%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                        <input type="hidden" id="hidden_loan_ac_grid" value="" name="hidden_loan_ac_grid">
                                        <table id="deal_body" style="display:block;width:100%">
                                            <tr>
                                                <td style="text-align:right;width:7%"><strong>Case Type&nbsp;&nbsp;</strong> </td>
                                                <td style="width:10%"><div style="padding-left:1.8%" id="req_type_grid" name="req_type_grid"></div></td>
                                                <td style="text-align:right;width:9%"><strong>Proposed Type&nbsp;&nbsp;</strong> </td>
                                                <td style="width:10%"><div style="padding-left:1.8%" id="proposed_type_grid" name="proposed_type_grid"></div></td>
                                                <td style="text-align:right;width:8%"><strong><span id="l_or_c_no_grid"></span> No.</strong></td>
                                                <td style="width:10%"><input name="loan_ac_grid" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac_grid" value="" onKeyUp="javascript:return mask_grid(this.value,this);"/></td>
                                                <td style="text-align:right;width:7%"><strong>Case No.&nbsp;&nbsp;</strong> </td>
                                                <td style="width:10%"><input name="case_number_grid" tabindex="" type="text" class="" maxlength="" size="" style="width:150px" id="case_number_grid" value="" onKeyUp=""/></td>
                                                <td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="search_data()" style="width:58px" />
                                                    <span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                </td>
                                            </tr>
                                        </table>
                                  </div>
                                    <div style="border:none;" id="jqxgrid"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                        <strong>P = </strong> Preview,&nbsp;
                                        <strong>ESF = </strong>Edit Suit File&nbsp;
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
<!-- Modal for product details -->
    <div id="details" style="visibility:hidden;">
    <div style="padding-left: 17px"><strong><label id="header_title"></label></strong></div>
        <form method="POST" name="action_form" id="action_form"  style="margin:0px;">
            <input name="deleteEventId" id="deleteEventId" value="" type="hidden">
            <input name="verifyIndexId" id="verifyIndexId" value="" type="hidden">
            <input name="type" id="type" value="" type="hidden">
            <input name="cif" id="cif" value="" type="hidden">
            <input name="pre_legal_user" id="pre_legal_user" value="" type="hidden">
            <input name="sec_sts" id="sec_sts" value="" type="hidden">
            <input name="proposed_type" id="proposed_type" value="" type="hidden">
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
    <script type="text/javascript">
var theme = getDemoTheme();
    rules= [
            { input: '#case_number', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                if(jQuery("#case_number").val()=='')
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
            },
            { input: '#judge_name', message: 'more than 100 characters', action: 'keyup, blur, change', rule: function (input, commit)
             {
                if(input.val() != '')
                {
                    if(input.val().length>100)
                    {
                        jQuery("#judge_name").focus();
                        return false;

                    }
                }
                return true;

            } },
            { input: '#judge_phone', message: 'invalid', action: 'keyup, blur, change', rule: function (input, commit) {
                        if(input.val()!='') 
                        {   
                            if (input.val().length>11 || input.val().length<11) 
                            {
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
            { input: '#case_claim_amount', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                if(jQuery("#case_claim_amount").val()=='')
                {
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
            { input: '#prev_date', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                if(jQuery("#prev_date").val()=='')
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
            },
            { input: '#prev_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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


            { input: '#case_sts_prev_dt', message: 'required!', action: 'blur,change', rule: function (input) {                 
                if(input.val() != '')
                {
                    var item = jQuery("#case_sts_prev_dt").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='case_sts_prev_dt']").val(item.value);}
                    else 
                    {
                        jQuery("#case_sts_prev_dt").jqxComboBox('clearSelection');
                        jQuery("input[name='case_sts_prev_dt']").val('');
                        return false;
                    }
                    return true;                
                }
                else
                {
                    jQuery("#case_sts_prev_dt input").focus();
                    return false;
                }
            }  
            },


            { input: '#type_of_case', message: 'required!', action: 'blur,change', rule: function (input) {                 
                if(input.val() != '')
                {
                    var item = jQuery("#type_of_case").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='type_of_case']").val(item.value);}
                    else 
                    {
                        jQuery("#type_of_case").jqxComboBox('clearSelection');
                        jQuery("input[name='type_of_case']").val('');
                        return false;
                    }
                    return true;                
                }
                else
                {
                    jQuery("#type_of_case input").focus();
                    return false;
                }
            }  
            },


            { input: '#type_of_case_name', message: 'required!', action: 'blur,change', rule: function (input) {    
                
               var re_case_sts = jQuery("#re_case_sts").val();

               if(re_case_sts==1){
                    if(input.val() != '')
                    {
                        var item = jQuery("#type_of_case_name").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='type_of_case_name']").val(item.value);}
                        else 
                        {
                            jQuery("#type_of_case_name").jqxComboBox('clearSelection');
                            jQuery("input[name='type_of_case_name']").val('');
                            return false;
                        }
                        return true;                
                    }
                    else
                    {
                        jQuery("#type_of_case_name input").focus();
                        return false;
                    }
               }else{
                return true;
               }


            }  
            },






            { input: '#next_date', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                var item = jQuery("#final_remarks").jqxComboBox('getSelectedItem');
                var item2 = jQuery("#case_sts_prev_dt").jqxComboBox('getSelectedItem');
                if(jQuery("#next_date").val()=='' && jQuery("#next_dt_sts_value").val()==1 && item.value!=2 && item2!=null && item2.value!=15)
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
            },
            { input: '#next_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
            { input: '#next_date', message: 'old date from filling date not allowed!', action: 'keyup, blur, change', rule: function(input,commit){
                if(jQuery("#next_date").val()!='' && jQuery("#filling_date").val()!='' && jQuery("#next_dt_sts_value").val()==1)
                {
                    return date_validation(jQuery("#next_date").val(),jQuery("#filling_date").val());
                }
                else
                {
                    return true;
                }
            }
            },
            { input: '#next_date', message: 'Filing date & next date never will be the same date!', action: 'keyup, blur, change', rule: function(input,commit){
                if(jQuery("#next_date").val()!='' && jQuery("#filling_date").val()!='' && jQuery("#next_dt_sts_value").val()==1 && jQuery("#next_date").val()==jQuery("#filling_date").val())
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
            },
            { input: '#case_sts_next_dt', message: 'required!', action: 'blur,change', rule: function (input) {                 
                if(jQuery("#next_date").val()!='' && jQuery("#next_dt_sts_value").val()==1)
                {
                    if(input.val() != '')
                    {
                        var item = jQuery("#case_sts_next_dt").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='case_sts_next_dt']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#case_sts_next_dt input").focus();
                        return false;
                    }
                }
                else
                {
                    return true;
                }
                
            }  
            },
            { input: '#filling_plaintiff', message: 'required!', action: 'blur,change', rule: function (input) {                    
                if(input.val() != '')
                {
                    var item = jQuery("#filling_plaintiff").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='filling_plaintiff']").val(item.value);}
                    else 
                    {
                        jQuery("#filling_plaintiff").jqxComboBox('clearSelection');
                        jQuery("input[name='filling_plaintiff']").val('');
                        return false;
                    }
                    return true;                
                }
                else
                {
                    jQuery("#filling_plaintiff input").focus();
                    return false;
                }
            }  
            },
            { input: '#filling_date', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                if(jQuery("#filling_date").val()=='')
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
            },
            { input: '#filling_date', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
            { input: '#case_deal_officer', message: 'required!', action: 'blur,change', rule: function (input) {                    
                if(input.val() != '')
                {
                    var item = jQuery("#case_deal_officer").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='case_deal_officer']").val(item.value);}
                    else 
                    {
                        jQuery("#case_deal_officer").jqxComboBox('clearSelection');
                        jQuery("input[name='case_deal_officer']").val('');
                        return false;
                    }
                    return true;                
                }
                else
                {
                    jQuery("#case_deal_officer input").focus();
                    return false;
                }
            }  
            },
            { input: '#prest_lawyer_name', message: 'required!', action: 'blur,change', rule: function (input) {                    
                if(input.val() != '')
                {
                    var item = jQuery("#prest_lawyer_name").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='prest_lawyer_name']").val(item.value);}
                    else 
                    {
                        jQuery("#prest_lawyer_name").jqxComboBox('clearSelection');
                        jQuery("input[name='prest_lawyer_name']").val('');
                        return false;
                    }
                    return true;                
                }
                else
                {
                    jQuery("#prest_lawyer_name input").focus();
                    return false;
                }
            }  
            },
            { input: '#prest_court_name', message: 'required!', action: 'blur,change', rule: function (input) {                 
                if(input.val() != '')
                {
                    var item = jQuery("#prest_court_name").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='prest_court_name']").val(item.value);}
                    else 
                    {
                        jQuery("#prest_court_name").jqxComboBox('clearSelection');
                        jQuery("input[name='prest_court_name']").val('');
                        return false;
                    }
                    return true;                
                }
                else
                {
                    jQuery("#prest_court_name input").focus();
                    return false;
                }
            }  
            },

            { input: '#region', message: 'required!', action: 'blur,change', rule: function (input) {                 
                if(input.val() != '')
                {
                    var item = jQuery("#region").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='region']").val(item.value);}
                    else 
                    {
                        jQuery("#region").jqxComboBox('clearSelection');
                        jQuery("input[name='region']").val('');
                        return false;
                    }
                    return true;                
                }
                else
                {
                    jQuery("#region input").focus();
                    return false;
                }
            }  
            },{ input: '#territory', message: 'required!', action: 'blur,change', rule: function (input) {                 
                if(input.val() != '')
                {
                    var item = jQuery("#territory").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='territory']").val(item.value);}
                    else 
                    {
                        jQuery("#territory").jqxComboBox('clearSelection');
                        jQuery("input[name='territory']").val('');
                        return false;
                    }
                    return true;                
                }
                else
                {
                    jQuery("#territory input").focus();
                    return false;
                }
            }  
            },{ input: '#cma_district', message: 'required!', action: 'blur,change', rule: function (input) {                 
                if(input.val() != '')
                {
                    var item = jQuery("#cma_district").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='cma_district']").val(item.value);}
                    else 
                    {
                        jQuery("#cma_district").jqxComboBox('clearSelection');
                        jQuery("input[name='cma_district']").val('');
                        return false;
                    }
                    return true;                
                }
                else
                {
                    jQuery("#cma_district input").focus();
                    return false;
                }
            }  
            },{ input: '#loan_segment', message: 'required!', action: 'blur,change', rule: function (input) {                 
                if(input.val() != '')
                {
                    var item = jQuery("#loan_segment").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='loan_segment']").val(item.value);}
                    else 
                    {
                        jQuery("#loan_segment").jqxComboBox('clearSelection');
                        jQuery("input[name='loan_segment']").val('');
                        return false;
                    }
                    return true;                
                }
                else
                {
                    jQuery("#loan_segment input").focus();
                    return false;
                }
            }  
            },{ input: '#legal_region', message: 'required!', action: 'blur,change', rule: function (input) {                 
                if(input.val() != '')
                {
                    var item = jQuery("#legal_region").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='legal_region']").val(item.value);}
                    else 
                    {
                        jQuery("#legal_region").jqxComboBox('clearSelection');
                        jQuery("input[name='legal_region']").val('');
                        return false;
                    }
                    return true;                
                }
                else
                {
                    jQuery("#legal_region input").focus();
                    return false;
                }
            }  
            },{ input: '#district', message: 'required!', action: 'blur,change', rule: function (input) {                 
                if(input.val() != '')
                {
                    var item = jQuery("#district").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='district']").val(item.value);}
                    else 
                    {
                        jQuery("#district").jqxComboBox('clearSelection');
                        jQuery("input[name='district']").val('');
                        return false;
                    }
                    return true;                
                }
                else
                {
                    jQuery("#district input").focus();
                    return false;
                }
            }  
            }





            
            ];
    var options = { 
            complete: function(response) 
            {
                var json = jQuery.parseJSON(response.responseText); 
                window.parent.jQuery('.txt_csrfname').val(json.csrf_token);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if(json.Message!='OK')
                {   
                    jQuery("#suit_file_save_button").show();
                    jQuery("#send_loading").hide();     
                    alert(json.Message);                    
                    return false;
                }else{
                    jQuery("#suit_file_save_button").show();
                    jQuery("#send_loading").hide();
                    jQuery("#jqxgrid").jqxGrid('updatebounddata');
                    jQuery("#msgArea").val('');
                    jQuery("#error").show();
                    jQuery("#error").fadeOut(11500);
                    jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
                    clear_form();
                    jQuery('#jqxTabs').jqxTabs('select', 1);jQuery('#jqxTabs').jqxTabs('disableAt', 0);
                }
                            
            }  
        }; 
        jQuery("#suit_file_form").ajaxForm(options);
        jQuery("#suit_file_save_button").click( function() {
            jQuery('#suit_file_form').jqxValidator({
                    rules: rules, theme: theme
            });
            // if(jQuery("#edit_after_verify_sts").val()=='0')
            // {
            //     if ((jQuery("#hidden_arji_copy_select").val()=='0' && jQuery('#arji_select_add_edit').val()=='add') || (jQuery("#hidden_arji_copy_select").val()=='0' && jQuery("#file_delete_value_arji_copy").val()=='1' && jQuery('#arji_select_add_edit').val()=='edit') )
            //     {
            //         alert('Please Upload Arji Copy');
            //         return false;
            //     }
            // }
            
            var validationResult = function (isValid) {
                if (isValid) {
                    jQuery("#suit_file_save_button").hide();
                    jQuery("#send_loading").show();
                    jQuery("#suit_file_form").submit();
                }
                else{return;}
            }
            jQuery('#suit_file_form').jqxValidator('validate', validationResult);
        });
</script>