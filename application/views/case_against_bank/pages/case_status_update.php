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
    </style>
    <script type="text/javascript">
            var theme = getDemoTheme();
            //Some Global veriabale for expense
            var expense_activities = [];
            var cma_district = 0;
            var req_type = 0;
            var lawyer_id = 0;
            var proposed_type = ["Loan", "Card"];
            var staff = [];
            var district = [];
            var req_type = [<? $i=1; foreach($case_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var case_sts = [<? $i=1; foreach($case_sts as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var lawyer = [];
            var expense_type = [<? $i=1; foreach($expense_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var final_remarks = [<? $i=1; foreach($final_remarks as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            jQuery(document).ready(function () {
            jQuery("#req_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Type Of Case", source: req_type, width: 150, height: 30});
            var theme = 'classic';
            jQuery("#next_dt_sts").jqxCheckBox({width: 22, theme: theme ,checked:true });
            jQuery("#proposed_type").jqxComboBox({theme: theme, width: 100, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
           //var theme = 'energyblue';
           jQuery('#proposed_type').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
           jQuery("#case_sts").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Status", source: case_sts, width: 250, height: 25});
            jQuery("#next_date_sts_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight:100, promptText: "Case Status", source: case_sts, width: 250, height: 25});
            jQuery("#next_date_purpose").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Purpose", source: case_sts, width: 250, height: 25});
            jQuery("#final_remarks").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Rmarks", source: final_remarks, width: 250, height: 25});
            jQuery('#case_sts,#lawyer,#next_date_purpose,#final_remarks,#next_date_sts_grid').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
            
            jQuery('#final_remarks').jqxComboBox({ disabled: true });
           //jQuery("#proposed_type").jqxComboBox('val','Loan');
           change_caption();
            jQuery('#proposed_type').bind('change', function (event) {
                jQuery("#loan_ac").val('');
                jQuery("#hidden_loan_ac").val('');
                change_caption();       
            });

            jQuery('#case_sts').bind('change', function (event) {
                var item = jQuery("#case_sts").jqxComboBox('getSelectedItem');
                if (item!=null)
                {
                    if(item.value==29)//For W/a
                    {
                        jQuery("#optional_attachment_row").show(); 
                        jQuery("#attachment_name").html('W/A'); 
                    }
                    else if(item.value==15)//For judgement
                    {
                        jQuery("#optional_attachment_row").show(); 
                        jQuery("#attachment_name").html('Judgment'); 
                    }
                    else if(item.value==28)//For judgement
                    {
                        jQuery("#optional_attachment_row").show(); 
                        jQuery("#attachment_name").html('Summon'); 
                    }
                    else
                    {
                        //For Edit ACTION
                        if(jQuery("#add_edit").val()=='edit')
                        {
                            jQuery("#file_preview_optional_attachment").hide(); 
                            jQuery("#file_delete_optional_attachment").hide();  
                            jQuery("#file_delete_value_optional_attachment").val(1);
                        }
                        jQuery("#optional_attachment_row").hide(); 
                    }
                    set_final_remarks(item.value,req_type);
                }
                else
                {
                    jQuery("#optional_attachment_row").hide(); 
                }
            });
            
            jQuery("#sendtochecker").click(function () {
                jQuery("#sendtochecker").hide();
                jQuery("#SendTocheckercancel").hide();
                jQuery("#sendtochecker_loading").show();
                call_ajax_submit_delete();
             });
            jQuery("#reject").click(function () {
                jQuery("#return_row").show();
                jQuery('#type').val('reject_approval');
                if(jQuery("#return_reason").val()=='')
                {
                    alert('Please Give Reject Reason');
                    jQuery("#return_reason").focus();
                    return false; 
                }
                else
                {
                    jQuery("#reject").hide();
                    jQuery("#return").hide();
                    jQuery("#verify").hide();
                    jQuery("#Verifycancel").hide();
                    jQuery("#verify_loading").show();
                    call_ajax_submit_delete();
                }
             });
            jQuery("#return").click(function () {
                jQuery("#return_row").show();
                jQuery('#type').val('return_approval');
                if(jQuery("#return_reason").val()=='')
                {
                    alert('Please Give Return Reason');
                    jQuery("#return_reason").focus();
                    return false; 
                }
                else
                {
                    jQuery("#reject").hide();
                    jQuery("#return").hide();
                    jQuery("#verify").hide();
                    jQuery("#Verifycancel").hide();
                    jQuery("#verify_loading").show();
                    call_ajax_submit_delete();
                }
             });
            jQuery("#verify").click(function () {
                jQuery("#return").hide();
                jQuery("#reject").hide();
                jQuery('#type').val('verify');
                jQuery("#verify").hide();
                jQuery("#Verifycancel").hide();
                jQuery("#verify_loading").show();
                call_ajax_submit_delete();
             });
            rules2=[
                { input: '#new_next_date', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#new_next_date").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
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
                        jQuery("#next_date_sts_grid input").focus();
                        return false;
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
            jQuery("#delete_button").click(function () {
                jQuery('#action_form').jqxValidator({
                        rules: rules3, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#delete_button").hide();
                        jQuery("#deletecancel").hide();
                        jQuery("#delete_loading").show();
                        call_ajax_submit_delete();
                    }
                }
                jQuery('#action_form').jqxValidator('validate', validationResult);
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
                        call_ajax_submit_delete();
                    }
                }
                jQuery('#action_form').jqxValidator('validate', validationResult);
             });
            jQuery("#next_dt_sts").bind('change', function (event) {
                var checked = event.args.checked;
                if(checked==true){ 
                    jQuery("#next_dt_sts_value").val(1); 
                    jQuery("#next_case_dt").val(''); 
                    jQuery("#next_case_dt").show();
                    jQuery("#next_sts_text").html('');
                    jQuery("#next_sts_text").hide();

                               
                }else{
                    jQuery("#next_dt_sts_value").val(0); 
                    jQuery("#next_case_dt").val(''); 
                    jQuery("#next_case_dt").hide(); 
                    jQuery("#next_sts_text").html('<strong><?=$sys_config->next_dt_text?></strong>'); 
                    jQuery("#next_sts_text").show();
            }
            });
            jQuery('#district').bind('change', function (event) {
                get_information_by_district();
                
            });
            var initGrid = function () {
                var source =
                {
                   datatype: "json",
                   datafields: [
                            { name: 'id', type: 'int'},
                            { name: 'sts', type: 'int'},
                            { name: 'suit_file_id', type: 'int'},
                            { name: 'status', type: 'string'},
                            { name: 'loan_ac', type: 'string'},
                            { name: 'ac_name', type: 'string'},
                            { name: 'e_by', type: 'string'},
                            { name: 'e_by_id', type: 'int'},
                            { name: 'e_dt', type: 'string'},
                            { name: 'u_by', type: 'string'},
                            { name: 'u_dt', type: 'string'}
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
                        url: '<?=base_url()?>index.php/case_against_bank/case_sts_grid',
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
                    var win_h=jQuery( window ).height()-270;
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
                        <? if(CASESTSDELETE==1){?>
                          { text: 'D', datafield: 'delete', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 35 || dataRecord.sts == 39 || dataRecord.sts==69 || dataRecord.sts==90)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'delete\')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
                                }
                                else {
                                        return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(CASESTSEDIT==1){?>
                          { text: 'E', datafield: 'edit', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 35 || dataRecord.sts == 39 || dataRecord.sts==69 || dataRecord.sts==90)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                }
                                else
                                {
                                    return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                }
                            }
                          },
                        <? }?>
                        <? if(CASESTSSENDTOCHECKER==1){?>
                          { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 35 || dataRecord.sts == 39 || dataRecord.sts==90)){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'sendtochecker\','+editrow+')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
                                }
                                else if(dataRecord.sts == 37){
                                        return '<div style=" margin-top: 8px;text-align:center">S</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                          },
                        <? }?>
                        <? if(CASESTSVERIFY==1){?>
                          { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts==37){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'verify\','+dataRecord.suit_file_id+')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
                                }
                                else if(dataRecord.sts == 51){
                                        return '<div style=" margin-top: 8px;text-align:center">V</div>';
                                }
                                else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
                            }
                          },
                        <? }?>
                        <? if(UPDATENEXTDATE==1){?>
                          { text: 'U', datafield: 'updatenextdate', editable: false,align:'center', sortable: false, menu: false, width: 35,
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                if(dataRecord.sts == 51){
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'updatenextdate\','+dataRecord.suit_file_id+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
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
                        { text: 'Status', datafield: 'status',editable: false, width: '17%', align:'left',cellsalign:'left'},
                        { text: 'Loan A/C or Card No.', datafield: 'loan_ac', editable: false,align:'center',cellsalign:'center', sortable: true, menu: true, width: '13%',
                            cellsrenderer: function(row) {
                                editrow = row;
                                var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\')"><span>'+dataRecord.loan_ac+'</span></a></div>';
                                
                            }
                          },
                        { text: 'A/C Name or Name on Card', datafield: 'ac_name',editable: false, width: '15%', align:'left',cellsalign:'left'},
                        { text: 'Entry By', datafield: 'e_by',editable: false, width: '18%' , align:'left',cellsalign:'left'},
                        { text: 'Entry Date Time', datafield: 'e_dt',editable: false, width: '18%' , align:'center',cellsalign:'center'},
                        { text: 'Update By', datafield: 'u_by',editable: false, width: '18%' , align:'left',cellsalign:'left'},
                        { text: 'Update Date and Time', datafield: 'u_dt',editable: false, width: '18%' , align:'center',cellsalign:'center'},
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
               jQuery('#case_sts_form').jqxValidator('hide');
               reload();
            });
            jQuery('#jqxTabs').jqxTabs('select', 0);
            <? if(CASESTSADD!=1 && CASESTSEDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>
            //End check box update 
            jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#deletecancel,#Verifycancel,#nextdatecancel") });
            jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
            jQuery('#details').on('close', function (event) {
                jQuery('#action_form').jqxValidator('hide');
            });

            jQuery('#lawyer').bind('change', function (event) {
                var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
                if (item!=null)
                {
                    jQuery("#noc_attachment_row").show();
                   // set_expense_lawyer('lawyer'); 
                }
                else
                {
                    jQuery("#noc_attachment_row").hide(); 
                }
            });
            
        });
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
            url: "<?=base_url()?>case_against_bank/r_history_case_sts",
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
    function validatenewDate(date1)
    {
        var now = new Date();
        now.setHours(0, 0, 0, 0);
        var str = jQuery('#case_dt').val();
        tmp1 = str.split("/")
        yDate = tmp1[1]+"/"+tmp1[0]+"/"+tmp1[2];
        var prev = new Date(yDate);
        var today = prev.valueOf();

        tmp = date1.split("/")
        xDate = tmp[1]+"/"+tmp[0]+"/"+tmp[2];
        var curent = new Date(xDate);
        refDate = curent.valueOf();

        if (today > refDate)
        {
            return false;
        }
        return true;
    }
    function call_ajax_submit_delete()
    {
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        var postData = jQuery('#action_form').serialize()+"&"+csrfName+"="+csrfHash;
        jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?=base_url()?>index.php/case_against_bank/delete_action_case_sts/',
                data : postData,
                datatype: "json",
                success: function(response){
                  ///console.log(response);
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        if (jQuery("#type").val()=='delete')
                        {
                            jQuery("#delete_row").show();
                            jQuery("#delete_button").show();
                            jQuery("#deletecancel").show();
                            jQuery("#delete_loading").hide();
                        }
                        if (jQuery("#type").val()=='sendtochecker')
                        {
                            jQuery("#sendtochecker").show();
                            jQuery("#SendTocheckercancel").show();
                            jQuery("#sendtochecker_loading").hide();
                            jQuery("#delete_loading").hide();
                        }
                        if (jQuery("#type").val()=='updatenextdate')
                        {
                            jQuery("#updatenextdate").show();
                            jQuery("#nextdatecancel").show();
                            jQuery("#nextdate_loading").hide();
                        }
                        if (jQuery("#type").val()=='verify' || jQuery("#type").val()=='reject_approval' || jQuery("#type").val()=='return_approval')
                        {
                            jQuery("#reject").show();
                            jQuery("#return").show();
                            jQuery("#verify").show();
                            jQuery("#Verifycancel").show();
                            jQuery("#verify_loading").hide();
                        }
                        if(json.Message!='OK')
                        {
                            jQuery('#details').jqxWindow('close');
                            alert(json.Message);
                            return false;
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
    function details(id,operation,suit_file_id)
    {
        jQuery("#return_reason").val('');
        jQuery("#new_next_date").val('');
        jQuery("#return_row").hide();
        jQuery('#deleteEventId').val(id);
        jQuery('#type').val(operation);
        jQuery('#suit_file_id').val(suit_file_id);
        if (operation=='details') 
        {
            jQuery("#header_title").html('Request Details');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').show();
            jQuery('#verify_row').hide();
            jQuery('#next_date_row').hide();
        }
        else if (operation=='delete') 
        {
            jQuery("#header_title").html('Delete Request');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').show();
            jQuery('#close_btn_row').hide();
            jQuery('#comments').val('');
            jQuery('#verify_row').hide();
            jQuery('#next_date_row').hide();
        }
        else if (operation=='sendtochecker') 
        {
            jQuery("#header_title").html('Send To Checker');
            jQuery('#sendtochecker_row').show();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#verify_row').hide();
            jQuery('#next_date_row').hide();
        }
        else if (operation=='verify') 
        {
            jQuery("#header_title").html('Approve Changes');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#verify_row').show();
            jQuery('#next_date_row').hide();
        }
        else if (operation=='updatenextdate') 
        {
            jQuery("#header_title").html('Update Next Date');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#verify_row').hide();
            jQuery('#next_date_row').show();
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
            url: "<?=base_url()?>case_against_bank/details_case_sts",
            data : {[csrfName]: csrfHash,id: id},
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
    function change_caption()
    {   
        if (jQuery("#proposed_type").val()=='') 
        {
            document.getElementById("loan_ac").disabled = true;
            jQuery("#l_or_c_no").html('Loan A/C or Card');
        }
        else
        {
            document.getElementById("loan_ac").disabled = false;
            var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
            if (item.value=='Loan') {
                jQuery("#l_or_c_no").html('Loan A/C ');
            }
            else if(item.value=='Card'){
                jQuery("#l_or_c_no").html('Card');
            }
        }
        
    }
    function searchsuit()// customer search 
    {

        var loan_ac = jQuery('#loan_ac').val();
        var case_number = jQuery('#case_number').val();
        var item = jQuery("#proposed_type").jqxComboBox('getSelectedItem');
        var proposed_type=jQuery('#proposed_type').val();
        var case_number=jQuery('#case_number').val();
        var req_type=jQuery('#req_type').val();
        var hidden_loan_ac = jQuery('#hidden_loan_ac').val();
        if (item!=null && loan_ac=='')
        {
            alert('please provide Loan/Card Number');
            jQuery('#loan_ac').focus();
            return false;
        }
        else if(item==null && loan_ac!='')
        {
            alert('please select proposed type');
            jQuery("#proposed_type input").focus();
            return false;
        }
        jQuery("#grid_loading").show();
        jQuery("#grid_search").hide();
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            async:false,
            url: "<?=base_url()?>index.php/case_against_bank/search_suit_for_status/",
            data : {[csrfName]: csrfHash,case_number:case_number,proposed_type:proposed_type,req_type:req_type,loan_ac: loan_ac, case_number:case_number,hidden_loan_ac:hidden_loan_ac},
            datatype: "html",
            success: function(response){
                var data = response.split("####");
                jQuery('.txt_csrfname').val(data[1]);
                jQuery("#grid_loading").hide();
                jQuery("#grid_search").show();
                jQuery('#searchTable').html(data[0]);

            }
        });
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
    function edit(id,index){
        var val=id;
        jQuery('#next_button').hide();
        jQuery('#next_loading').show();
        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?=base_url()?>case_against_bank/get_edit_info_case_sts",
            data : {[csrfName]: csrfHash,id:val},
            datatype: "json",
            async:false,
            success: function(response){
               
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if(json.Message=='ok'){
                    var html = '';
                    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'noc_file\')"/>';
                    html+='<input type="hidden" id="hidden_noc_file_select" name="hidden_noc_file_select" value="0">';
                    html+='<span id="hidden_noc_file"></span><input type="hidden" id="noc_select_add_edit" name="noc_select_add_edit" value="add">';
                    jQuery('#noc_file').html(html);
                    var html = '';
                    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'optional_attachment\')"/>';
                    html+='<input type="hidden" id="hidden_optional_attachment_select" name="hidden_optional_attachment_select" value="0">';
                    html+='<span id="hidden_optional_attachment"></span><input type="hidden" id="optional_select_add_edit" name="optional_select_add_edit" value="add">';
                    jQuery('#optional_attachment').html(html);
                    jQuery('#jqxTabs').jqxTabs('select', 0);
                    jQuery('#add_edit').val('edit');
                    jQuery('#edit_id').val(json.id);
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    jQuery('#search_area').hide();
                    jQuery('#status_form_div').show();
                    jQuery("#suit_file_id").val(json.result.file_id);
                    jQuery('#case_dt').val(date_formater(json.result.case_dt));
                    jQuery('#next_case_dt').val(date_formater(json.result.next_case_dt));
                    jQuery('#remarks').val(json.result.remarks);
                    jQuery('#next_dt_remarks').val(json.result.next_dt_remarks);
                    if(json.result.next_date_purpose!=0 && json.result.next_date_purpose!=null && json.result.next_date_purpose!='')
                    {
                        jQuery('#next_date_purpose').jqxComboBox('val', json.result.next_date_purpose);
                    }
                    jQuery("#final_remarks").jqxComboBox('val',json.result.final_remarks);
                    jQuery('#case_sts').jqxComboBox('val', json.result.case_sts);
                    jQuery("#pre_case_sts").html(json.pre_case_sts.case_sts_next_dt);
                    jQuery("#pre_case_act").html(json.pre_case_sts.act_prev_date);
                    jQuery("#pre_case_date").html(json.pre_case_sts.prev_case_dt);
                    jQuery("#pre_case_sts_sl").val(json.pre_case_sts.pre_case_sts_sl);
                    jQuery("#present_lawyer_id").val(json.row_info.prest_lawyer_name);
                    var court = [];
                    jQuery.each(json['court'],function(key,obj){
                        court.push({ value: obj.id, label: obj.name });
                    });
                    jQuery.each(json['district_list'],function(key,obj){
                        district.push({ value: obj.id, label: obj.name });
                    });
                    var plaintiff = [];
                    jQuery.each(json['plaintiff'],function(key,obj){
                        plaintiff.push({ value: obj.id, label: obj.name+'('+obj.pin+')' });
                    });
                    lawyer = [];
                    jQuery.each(json['lawyer'],function(key,obj){
                        lawyer.push({ value: obj.id, label: obj.name });
                    });
                    jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
                    jQuery("#court").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court", source: court, width: 250, height: 25});
                    jQuery("#district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 250, height: 25});
                    jQuery("#plaintiff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Plaintiff", source: plaintiff, width: 250, height: 25});
                    jQuery('#lawyer,#court,#district,#plaintiff').focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
                    });
                    var dif=0;
                    var next_dt = '';
                    var next_sts = '';
                    var next_remarks = '';
                    var pre_remarks = '';
                    if (json.pre_case_sts.changed_id=== undefined || json.pre_case_sts.changed_id == null) { //when there is no case status data
                        dif = json.row_info.dif;
                        next_dt = json.row_info.next_date;
                        next_sts = json.row_info.case_sts_next_dt;
                        next_remarks = json.row_info.remarks_next_date;
                        pre_remarks = json.row_info.remarks_prev_date;
                    }
                    else //when there is case status data exists
                    {
                        dif = json.pre_case_sts.dif;
                        next_dt = json.pre_case_sts.next_date;
                        next_sts = json.pre_case_sts.next_date_sts;
                        next_remarks = json.pre_case_sts.next_dt_remarks;
                        pre_remarks = json.pre_case_sts.prev_case_sts_remarks;
                    }
                    //for set the date and status
                    if(parseInt(dif)<=0)//when next date is equal or over
                    {
                        jQuery('#case_dt').val(next_dt);
                        jQuery("#case_sts").jqxComboBox('val',next_sts);
                        //set_expense_date('case_dt');
                    }
                    else if(parseInt(dif)>0)//when next date is upcoming
                    {
                        jQuery('#next_case_dt').val(next_dt);
                        jQuery("#next_date_purpose").jqxComboBox('val',next_sts);
                        
                    }
                    //for set the remarks
                    if(parseInt(dif)<0)//when next date is over
                    {
                        jQuery("#pre_case_remarks").html(next_remarks);
                    }
                    else if(parseInt(dif)>0)//when next date is upcoming
                    {
                        jQuery("#pre_case_remarks").html(pre_remarks);
                        jQuery("#next_dt_remarks").val(next_remarks);
                    }
                    else if(parseInt(dif)==0)//when next date is equal
                    {
                        jQuery("#pre_case_remarks").html(pre_remarks);
                        jQuery("#present_case_remarks").html(next_remarks);
                    }
                    var optional_attachment = json.result.optional_attachment;
                    var html = '';
                    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'optional_attachment\')"/>';
                    html+='<input type="hidden" id="hidden_optional_attachment_select" name="hidden_optional_attachment_select" value="0">';
                    if(optional_attachment!='' && optional_attachment!=null)
                    {
                        html +='<span id="hidden_optional_attachment"><img id="file_preview_optional_attachment" onclick="popup(\'<?=base_url()?>cma_file/optional_attachment/'+optional_attachment+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                        html +='<input type="hidden" id="hidden_optional_attachment_value" name="hidden_optional_attachment_value" value="'+optional_attachment+'">';
                        html +='<img id="file_delete_optional_attachment" onclick="file_delete(\'optional_attachment\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                        html +='<input type="hidden" id="file_delete_value_optional_attachment" name="file_delete_value_optional_attachment" value="0">';
                        html+='<span id="hidden_optional_attachment"></span><input type="hidden" id="optional_select_add_edit" name="optional_select_add_edit" value="edit">';
                    }
                    else
                    {
                        html+='<span id="hidden_optional_attachment"></span><input type="hidden" id="optional_select_add_edit" name="optional_select_add_edit" value="add">';
                    }
                    jQuery('#optional_attachment').html(html);
                    if(json.result.new_district!='' && json.result.new_district!=null && json.result.new_district!=0)
                    {
                        jQuery('#district').jqxComboBox('val', json.result.new_district);
                    }
                    if(json.result.new_lawyer_name!='' && json.result.new_lawyer_name!=null && json.result.new_lawyer_name!=0)
                    {
                        jQuery("#noc_attachment_row").show();
                        jQuery('#lawyer').jqxComboBox('val', json.result.new_lawyer_name);

                        var noc_file = json.result.noc_file;
                        var html = '';
                        html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'noc_file\')"/>';
                        html+='<input type="hidden" id="hidden_noc_file_select" name="hidden_noc_file_select" value="0">';
                        if(noc_file!='' && noc_file!=null)
                        {
                            html +='<span id="hidden_noc_file"><img id="file_preview_noc_file" onclick="popup(\'<?=base_url()?>cma_file/noc_file/'+noc_file+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                            html +='<input type="hidden" id="hidden_noc_file_value" name="hidden_noc_file_value" value="'+noc_file+'">';
                            html +='<img id="file_delete_noc_file" onclick="file_delete(\'noc_file\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                            html +='<input type="hidden" id="file_delete_value_noc_file" name="file_delete_value_noc_file" value="0">';
                            html+='<span id="hidden_noc_file"></span><input type="hidden" id="noc_select_add_edit" name="noc_select_add_edit" value="edit">';
                        }
                        else
                        {
                            html+='<span id="hidden_noc_file"></span><input type="hidden" id="noc_select_add_edit" name="noc_select_add_edit" value="add">';
                        }
                        
                        jQuery('#noc_file').html(html);
                    }
                    if(json.result.new_plaintiff!='' && json.result.new_plaintiff!=null && json.result.new_plaintiff!=0)
                    {
                        jQuery('#plaintiff').jqxComboBox('val', json.result.new_plaintiff);
                    }
                    if(json.result.new_court!='' && json.result.new_court!=null && json.result.new_court!=0)
                    {
                        jQuery('#court').jqxComboBox('val', json.result.new_court);
                    }
                    if (json.result.next_dt_sts==1)
                    {
                        jQuery('#next_dt_sts').jqxCheckBox({ checked:true }); 
                        jQuery("#next_dt_sts_value").val(1); 
                        jQuery("#next_case_dt").val(date_formater(json.result.next_case_dt)); 
                        jQuery("#next_case_dt").show();
                        jQuery("#next_sts_text").html('');
                        jQuery("#next_sts_text").hide();
                    
                    }else
                    {
                       jQuery('#next_dt_sts').jqxCheckBox({ checked:false }); 
                       jQuery("#next_dt_sts_value").val(0); 
                        jQuery("#next_case_dt").val(''); 
                        jQuery("#next_case_dt").hide(); 
                        jQuery("#next_sts_text").html('<strong><?=$sys_config->next_dt_text?></strong>'); 
                        jQuery("#next_sts_text").show();
                    }
                    ///////For Expense Info
                    jQuery('#expense_counter').val('0');
                    jQuery('#expense_body').html('');
                    
                    lawyer_id = json.row_info.prest_lawyer_name;
                    cma_district = json.district;
                    req_type = json.req_type;
                    
                    jQuery.each(json['expense_activities'],function(key,obj){
                        expense_activities.push({ value: obj.id, label: obj.name });
                    });
                    //console.log(json['expense_data'])
                    var i=0;
                    jQuery.each(json['expense_data'],function(key,obj){
                        i++;
                        var counter = jQuery('#expense_counter').val();
                        var new_counter = parseInt(counter) + 1;
                        html_string = '';

                            html_string += '<tr id="expense_'+new_counter+'">';
                            html_string += '<td>';
                            html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="'+obj.id+'">';
                            html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                            if(i>1)
                            {
                                html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                            }
                            html_string += '</td>';
                            html_string += '<td><div id="expense_type_'+new_counter+'" name="expense_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange="change_vendor(\'expense_type_'+new_counter+'\','+new_counter+')"></div></td>';
                            html_string += '<td><div id="district_'+new_counter+'" name="district_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data('+new_counter+')"></div><div id="vendor_id_'+new_counter+'" name="vendor_id_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none" ></div><input name="vendor_name_'+new_counter+'" type="text" class="" style="width:98%" id="vendor_name_'+new_counter+'" /></td>';
                            html_string += '<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;"></div></td>';
                            html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="'+date_formater(obj.activities_date)+'" ></td>';
                            html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="'+obj.amount+'" ><input type="text" name="p_cost_'+new_counter+'" tabindex="" placeholder="" style="width:90%;display:none" id="p_cost_'+new_counter+'" value="" onkeypress="return numbersonly(event)"></td>';
                            html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%">'+obj.remarks+'</textarea></td>';
                            html_string += '</tr>';
                        if (i==1)
                        {
                            jQuery('#expense_body').html(html_string);
                        }
                        else
                        {
                            jQuery('#expense_' + counter).after(html_string);
                        }
                        jQuery('#expense_counter').val(new_counter);
                        
                        jQuery('#expense_type_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Expense Type", source: expense_type, height: 25});
                        jQuery('#expense_type_'+new_counter).focusout(function() {
                                    commbobox_check(jQuery(this).attr('id'));
                        });
                        jQuery('#district_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select District", source: district, height: 25});
                        jQuery('#district_'+new_counter).focusout(function() {
                                    commbobox_check(jQuery(this).attr('id'));
                        });
                        jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, height: 25});
                        jQuery('#activities_name_'+new_counter).focusout(function() {
                                    commbobox_check(jQuery(this).attr('id'));
                        });
                        datePicker('activities_date_'+new_counter);
                        
                        jQuery("#expense_type_"+new_counter).jqxComboBox('val',obj.expense_type);
                        change_vendor('expense_type_'+new_counter,new_counter);
                        get_dropdown_data(new_counter);                
                        jQuery("#district_"+new_counter).jqxComboBox('val',obj.district);
                        jQuery("#vendor_id_"+new_counter).jqxComboBox('val',obj.vendor_id);
                        jQuery("#activities_name_"+new_counter).jqxComboBox('val',obj.activities_name);
                    
                    });
                    var html='';
                    var size = Object.keys(json['status_history']).length;
                    if(size>0)
                    {
                        jQuery.each(json['status_history'],function(key,obj){
                            if (obj.back_case_status==1) {
                                var style_color='color:white;background-color:red';
                            }else
                            {
                                var style_color='';
                            }
                             html+='<tr>';
                                     html+='<td style="text-align:center">'+obj.prev_case_sts+'</td>';
                                     html+='<td style="text-align:center;'+obj.style_color+'">'+obj.present_case_sts+'</td>';
                                     html+='<td style="text-align:center">'+obj.e_by+'</td>';
                                     html+='<td style="text-align:center">'+obj.e_dt+'</td>';
                                     html+='<td style="text-align:center">'+obj.next_case_dt+'</td>';
                                     html+='<td style="text-align:center">'+obj.next_dt_purpose+'</td>';
                                     html+='<td style="text-align:center">'+obj.remarks+'</td>';
                             html+='</tr>';
                        });
                        jQuery('#history_row').show();
                    }
                    else
                    {
                        jQuery('#history_row').hide();
                    }
                    jQuery('#history_body').html(html);
                    

                }else{
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    alert("No Data Found");
                    jQuery('#add_edit').val('');
                }
            }
        });

    }
    function get_information_by_district()
    {
        var theme = getDemoTheme();
        var item = jQuery("#district").jqxComboBox('getSelectedItem');
        if(item!=null)
        {
            var act_id = item.value;
        }
        else
        {
            var act_id = 0;
        }
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
        url: '<?=base_url()?>index.php/Home/get_information_by_legal_district',
        async:false,
        type: "post",
        data: { [csrfName]: csrfHash,act_id:act_id},
        datatype: "json",
        success: function(response){
            var json = jQuery.parseJSON(response);
            jQuery('.txt_csrfname').val(json.csrf_token);
            var court = [];
            jQuery.each(json['court'],function(key,obj){
                court.push({ value: obj.id, label: obj.name });
            });
            var change_lawyer = [];
            jQuery.each(json['lawyer'],function(key,obj){
                change_lawyer.push({ value: obj.id, label: obj.name });
            });
            var plaintiff = [];
            jQuery.each(json['plaintiff'],function(key,obj){
                plaintiff.push({ value: obj.id, label: obj.name+'('+obj.pin+')' });
            });
            jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: change_lawyer, width: 250, height: 25});
            jQuery("#court").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court", source: court, width: 230, height: 25});
            jQuery("#plaintiff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Plaintiff", source: plaintiff, width: 250, height: 25});
            jQuery('#lawyer,#court,#plaintiff').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
        },
        error:   function(model, xhr, options){
            alert('failed');
        },
        });
    }
    function load_filing_info(){
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
            alert('Please Select a Loan Account!');
            return false;
        }
        jQuery('#next_button').hide();
        jQuery('#next_loading').show();
        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?=base_url()?>case_against_bank/get_add_info_case_sts",
            data : {[csrfName]: csrfHash,id:val},
            datatype: "json",
            async:false,
            success: function(response){
               
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if(json.Message=='ok'){

                    var html = '';
                    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'noc_file\')"/>';
                    html+='<input type="hidden" id="hidden_noc_file_select" name="hidden_noc_file_select" value="0">';
                    html+='<span id="hidden_noc_file"></span><input type="hidden" id="noc_select_add_edit" name="noc_select_add_edit" value="add">';
                    jQuery('#noc_file').html(html);

                    var html = '';
                    html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'optional_attachment\')"/>';
                    html+='<input type="hidden" id="hidden_optional_attachment_select" name="hidden_optional_attachment_select" value="0">';
                    html+='<span id="hidden_optional_attachment"></span><input type="hidden" id="optional_select_add_edit" name="optional_select_add_edit" value="add">';
                    jQuery('#optional_attachment').html(html);
                    jQuery('#add_edit').val('add');
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    jQuery('#search_area').hide();
                    jQuery('#status_form_div').show();
                    var form_html = '';
                    jQuery("#pre_case_sts").html(json.pre_case_sts.case_sts_next_dt);
                    jQuery("#pre_case_act").html(json.pre_case_sts.act_prev_date);
                    jQuery("#pre_case_date").html(json.pre_case_sts.prev_case_dt);
                    jQuery("#suit_file_id").val(json.id);
                    jQuery("#remarks").val(json.pre_case_sts.prev_case_sts_remarks);
                    jQuery("#pre_case_sts_sl").val(json.pre_case_sts.pre_case_sts_sl);
                    jQuery("#present_lawyer_id").val(json.row_info.prest_lawyer_name);
                    ///////For Expense Info
                    jQuery('#expense_counter').val('1');
                    jQuery("#final_remarks").jqxComboBox('val',1);
                    jQuery('#expense_body').html('');
                    jQuery('#next_dt_sts').jqxCheckBox({ checked:true }); 
                    jQuery("#next_dt_sts_value").val(1); 
                    jQuery("#next_case_dt").val(''); 
                    jQuery("#next_case_dt").show();
                    jQuery("#next_sts_text").html('');
                    jQuery("#next_sts_text").hide();
                    lawyer_id = json.row_info.prest_lawyer_name;
                    cma_district = json.district;
                    req_type = json.req_type;
                    
                    jQuery.each(json['expense_activities'],function(key,obj){
                        expense_activities.push({ value: obj.id, label: obj.name });
                    });
                    var court = [];
                    jQuery.each(json['court'],function(key,obj){
                        court.push({ value: obj.id, label: obj.name });
                    });
                    lawyer = [];
                    jQuery.each(json['lawyer'],function(key,obj){
                        lawyer.push({ value: obj.id, label: obj.name });
                    });
                    jQuery.each(json['district_list'],function(key,obj){
                        district.push({ value: obj.id, label: obj.name });
                    });
                    var plaintiff = [];
                    jQuery.each(json['plaintiff'],function(key,obj){
                        plaintiff.push({ value: obj.id, label: obj.name+'('+obj.pin+')' });
                    });
                    jQuery("#lawyer").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
                    jQuery("#court").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court", source: court, width: 250, height: 25});
                    jQuery("#district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 250, height: 25});
                    
                    jQuery("#plaintiff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Plaintiff", source: plaintiff, width: 250, height: 25});
                    jQuery('#lawyer,#court,#district,#plaintiff').focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
                    });
                    var html = '';      
                    html +='<tr id="expense_1">';
                            html +='<td></td>';
                            html +='<td>';
                                html +='<input type="hidden" id="expense_delete_1" name="expense_delete_1" value="0">';
                                html +='<input type="hidden" id="expense_edit_1" name="expense_edit_1" value="0">';
                                html +='<div id="expense_type_1" name="expense_type_1" style="padding-left: 3px;margin-left:5px" onchange="change_vendor(\'expense_type_1\',1)"></div>';
                            html +='</td>';
                            html += '<td><div id="district_1" name="district_1" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data(1)"></div><div id="vendor_id_1" name="vendor_id_1"  style="padding-left: 3px;margin-left:5px;display:none" ></div><input name="vendor_name_1" type="text" class="" style="width:98%" id="vendor_name_1" /></td>';
                            html +='<td><div id="activities_name_1" name="activities_name_1" style="padding-left: 3px;margin-left:5px;width:90%"></div></td>';
                            html +='<td><input type="text" name="activities_date_1" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_1" value="" ></td>';
                            html +='<td><input name="amount_1" type="text" class="" style="width:90%" id="amount_1" /></td>';
                            html +='<td><textarea name="remarks_1" class="text-input-big" id="remarks_1" style="height:40px !important;width:90%"></textarea></td>';
                    html +='</tr>';
                    jQuery('#expense_body').html(html);
                    jQuery("#district_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select District", source: district, width: 180, height: 25});
                    jQuery("#expense_type_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Vendor Type", source: expense_type, width: 180, height: 25});
                    jQuery("#activities_name_1").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, width: 180, height: 25});
                    jQuery('#vendor_id_1').jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, height: 25});
                    jQuery('#vendor_id_1').focusout(function() {
                                commbobox_check(jQuery(this).attr('id'));
                    });
                    jQuery('#expense_type_1').jqxComboBox('val', 1);
                    jQuery("#vendor_id_1").jqxComboBox('val', json.row_info.prest_lawyer_name);
                    jQuery('#activities_name_1,#expense_type_1').focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
                    });
                    datePicker('activities_date_1');
                    jQuery('#expense_type_1').jqxComboBox('val', 1);
                    jQuery("#vendor_id_1").jqxComboBox('val',json.row_info.prest_lawyer_name);
                    /////////End Expnese Info
                    var dif=0;
                    var next_dt = '';
                    var next_sts = '';
                    var next_remarks = '';

                    var pre_remarks = '';
                    if (json.pre_case_sts.changed_id=== undefined || json.pre_case_sts.changed_id == null) { //when there is no case status data
                        dif = json.row_info.dif;
                        next_dt = json.row_info.next_date;
                        next_sts = json.row_info.case_sts_next_dt;
                        next_remarks = json.row_info.remarks_next_date;
                        pre_remarks = json.row_info.remarks_prev_date;
                    }
                    else //when there is case status data exists
                    {
                        dif = json.pre_case_sts.dif;
                        next_dt = json.pre_case_sts.next_date;
                        next_sts = json.pre_case_sts.next_date_sts;
                        next_remarks = json.pre_case_sts.next_dt_remarks;
                        pre_remarks = json.pre_case_sts.prev_case_sts_remarks;
                    }
                    //for set the date and status
                    if(parseInt(dif)<=0)//when next date is equal or over
                    {
                        jQuery('#case_dt').val(next_dt);
                        jQuery("#case_sts").jqxComboBox('val',next_sts);
                        //set_expense_date('case_dt');
                    }
                    else if(parseInt(dif)>0)//when next date is upcoming
                    {
                        jQuery('#next_case_dt').val(next_dt);
                        jQuery("#next_date_purpose").jqxComboBox('val',next_sts);
                        
                    }
                    //for set the remarks
                    if(parseInt(dif)<0)//when next date is over
                    {
                        jQuery("#pre_case_remarks").html(next_remarks);
                    }
                    else if(parseInt(dif)>0)//when next date is upcoming
                    {
                        console.log(next_remarks);
                        jQuery("#pre_case_remarks").html(pre_remarks);
                        jQuery("#next_dt_remarks").val(next_remarks);
                    }
                    else if(parseInt(dif)==0)//when next date is equal
                    {
                        jQuery("#pre_case_remarks").html(pre_remarks);
                        jQuery("#present_case_remarks").html(next_remarks);
                    }
                    var html='';
                    var size = Object.keys(json['status_history']).length;
                    if(size>0)
                    {
                        jQuery.each(json['status_history'],function(key,obj){
                            if (obj.back_case_status==1) {
                                var style_color='color:white;background-color:red';
                            }else
                            {
                                var style_color='';
                            }
                             html+='<tr>';
                                     html+='<td style="text-align:center">'+obj.prev_case_sts+'</td>';
                                     html+='<td style="text-align:center;'+obj.style_color+'">'+obj.present_case_sts+'</td>';
                                     html+='<td style="text-align:center">'+obj.e_by+'</td>';
                                     html+='<td style="text-align:center">'+obj.e_dt+'</td>';
                                     html+='<td style="text-align:center">'+obj.next_case_dt+'</td>';
                                     html+='<td style="text-align:center">'+obj.next_dt_purpose+'</td>';
                                     html+='<td style="text-align:center">'+obj.remarks+'</td>';
                             html+='</tr>';
                        });
                        jQuery('#history_row').show();
                        jQuery('#history_body').html(html);
                    }
                    else
                    {
                        jQuery('#history_row').hide();
                        jQuery('#history_body').html('');
                    }
                    
                }else{
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    alert("No Data Found");
                    jQuery('#add_edit').val('');
                }
            }
        });

    }
    function add_more_expense()
    {
        var theme = getDemoTheme();
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
            html_string += '<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;"></div></td>';
            html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" ></td>';
            html_string += '<td><input type="text" name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
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
        jQuery('#district_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select District", source: district, height: 25});
        jQuery('#district_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#expense_type_'+new_counter).jqxComboBox('val', 1);
        jQuery("#vendor_id_"+new_counter).jqxComboBox('val', lawyer_id);
        datePicker('activities_date_'+new_counter);
        set_expense_date('case_dt',new_counter);  
        //set_expense_lawyer('lawyer',new_counter);      
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
    function delete_row_expense (row_id) {
        jQuery('#expense_' + row_id).hide();
        jQuery('#expense_delete_' + row_id).val(1);
    }
    function get_expense_amount(act_id,counter) 
    {
        var theme = getDemoTheme();
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
                        jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 180, height: 25});
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
    function change_vendor(id,counter)
    {
        var theme = getDemoTheme();
        var item = jQuery("#"+id).jqxComboBox('getSelectedItem');
        jQuery("#district_"+counter).jqxComboBox('clearSelection');
        jQuery("#district_"+counter).val('');
        jQuery("#district_"+counter).hide();
        if (item!=null)
        {
            if (item.value==1)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 180, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
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
                select_lawyer(counter);
            }else if(item.value==2)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Vendor", source: vendor, width: 180, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                un_select_lawyer(counter);
            }else if(item.value==3)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#district_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 180, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                un_select_lawyer(counter);
            }
            else if(item.value==5)
            {
                jQuery("#vendor_id_"+counter).show();
                jQuery("#district_"+counter).show();
                jQuery("#vendor_id_"+counter).jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Staff", source: staff, width: 180, height: 25});
                document.getElementById('vendor_name_'+counter).style.display = 'none';
                jQuery("#vendor_name_"+counter).val('');
                jQuery('#vendor_id_'+counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                un_select_lawyer(counter);
            }
            else{
                jQuery("#vendor_id_"+counter).hide();
                jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
                jQuery("#vendor_id_"+counter).val('');
                document.getElementById('vendor_name_'+counter).style.display = 'block';
                un_select_lawyer(counter);
            }
            
        }else{
            jQuery("#vendor_id_"+counter).hide();
            jQuery("#vendor_id_"+counter).jqxComboBox('clearSelection');
            jQuery("#vendor_id_"+counter).val('');
            document.getElementById('vendor_name_'+counter).style.display = 'block'
        }
    }
    function clear_form() {
        jQuery("#present_lawyer_id").val('');
        jQuery("#optional_attachment_row").hide(); 
        jQuery('#history_row').hide();
        jQuery('#history_body').html('');
        jQuery("#noc_attachment_row").hide(); 
        district = [];
        jQuery("#case_sts").jqxComboBox('clearSelection');
        jQuery("input[name='case_sts']").val('');
        jQuery("#lawyer").jqxComboBox('clearSelection');
        jQuery("input[name='lawyer']").val('');
        jQuery("#court").jqxComboBox('clearSelection');
        jQuery("input[name='court']").val('');
        jQuery("#district").jqxComboBox('clearSelection');
        jQuery("input[name='district']").val('');
        jQuery("#plaintiff").jqxComboBox('clearSelection');
        jQuery("input[name='plaintiff']").val('');
        jQuery("#next_date_purpose").jqxComboBox('clearSelection');
        jQuery("input[name='next_date_purpose']").val('');
        jQuery("#next_case_dt").val('');
        jQuery("#case_dt").val('');
        jQuery("#remarks").val('');
        jQuery("#next_dt_remarks").val('');
        jQuery("#pre_case_sts").html('');
        jQuery("#pre_case_act").html('');
        jQuery("#pre_case_date").html('');
        jQuery("#pre_case_remarks").html('');
        jQuery("#present_case_remarks").html('');
        jQuery("#suit_file_id").val('');
        jQuery("#pre_case_sts_sl").val('');
        jQuery('#history_body').html('');
        jQuery('#expense_counter').val('0');
        jQuery('#expense_body').html('');
        jQuery('#edit_id').val('');
        jQuery('#case_dt').val('');
        jQuery('#next_case_dt').val('');
        jQuery('#remarks').val('');
        expense_activities = [];
        lawyer_id = 0;
        cma_district = 0;
        req_type = 0;

        jQuery("#next_dt_sts_value").val(1); 
        jQuery("#next_case_dt").val(''); 
        jQuery("#next_case_dt").show(); 
        jQuery("#next_sts_text").html(''); 
        jQuery("#next_sts_text").hide();
        
    }
    function reload()
    {
        jQuery('#status_form_div').hide();
        jQuery('#search_area').show();
        jQuery('#searchTable').html('');
        jQuery("#edit_id").val('');
        clear_form();
        jQuery('#add_edit').val('');
        jQuery('#case_sts_form').jqxValidator('hide');
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
    function alert_proxy()
    {
        var changed_lawyer = jQuery("#lawyer").jqxComboBox('getSelectedItem');
        var old_lawyer = jQuery("#present_lawyer_id").val(); 
        var counter = jQuery('#expense_counter').val();
        for (i=1;i<=counter;i++) 
        {
            if(jQuery('#expense_delete_'+i).val()==0) 
            {
                var new_lawyer = jQuery("#vendor_id_"+i).jqxComboBox('getSelectedItem');
                if(new_lawyer!=null)
                {
                    if(new_lawyer.value!=old_lawyer && changed_lawyer==null)
                    {
                        if(!confirm("Are you sure you want to select a proxy lawyer?"))
                        {
                            //jQuery("#vendor_id_"+i).jqxComboBox('val',old_lawyer);
                            jQuery('#vendor_id_'+i+' input').focus();
                            return false;
                        }
                    }
                    else if(changed_lawyer!=null && new_lawyer.value!=changed_lawyer.value)
                    {
                        if(!confirm("Are you sure you want to select a proxy lawyer?"))
                        {
                            
                            //jQuery("#vendor_id_"+i).jqxComboBox('val',changed_lawyer.value);
                            jQuery('#vendor_id_'+i+' input').focus();
                            return false;
                        }
                    }
                }
            }
        }
        return true;

    }
    </script>
    <div id="container">
        <div id="body"  >
            <table class="">
                <tr id="widgetsNavigationTree">
                    <td valign="top" align="left" class='navigation'>
                         <!---- Left Side Menu Start ------>
                        <?php $this->load->view('case_against_bank/pages/left_side_nav'); ?>
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
                                        <div id="search_area">
                                            <form method="POST" name="form" id="form"  style="margin:0px;">
                                               <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                                               <div style="padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                                    <table id="deal_body" style="display:block;width:100%">
                                                        <tr>
                                                            <td style="text-align:right;width:13%"><strong>Type Of Case&nbsp;&nbsp;</strong> </td>
                                                            <td style="width:10%"><div style="padding-left:1.8%" id="req_type" name="req_type"></div></td>
                                                            <td style="text-align:right;width:12%"><strong>Propsed Type&nbsp;&nbsp;</strong> </td>
                                                            <td style="width:5%"><div style="padding-left:1.8%" id="proposed_type" name="proposed_type"></div></td>
                                                            <td style="text-align:right;width:11%"><strong><span id="l_or_c_no"></span> No.</strong></td>
                                                            <td style="width:15%"><input name="loan_ac" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac" value="" onKeyUp="javascript:return mask(this.value,this);"/></td>
                                                             <td style="text-align:right;width:8%"><strong>Case No.</strong></td>
                                                            <td style="width:10%"><input name="case_number" tabindex="" type="text" class="" maxlength="" size="" style="width:150px" id="case_number" value="" onKeyUp=""/></td>
                                                            <td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="searchsuit()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" />
                                                            </td>
                                                        </tr>
                                                    </table>
                                              </div>
                                              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                                              <div id="searchTable"></div>
                                            </form>
                                        </div>
                                        <div id="status_form_div" style="display:none">
                                            <div id="back_area" style="text-align: center;padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                                    <input type='button' class="buttonStyle" id="back" name='' value='Back' onclick="reload()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;margin-top:10px" />
                                              </div>
                                              <div id="suit_form_area">
                                                <form method="POST" name="case_sts_form" id="case_sts_form"  style="margin:0px;" action="<?=base_url()?>index.php/case_against_bank/add_edit_case_sts" enctype="multipart/form-data">
                                                    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                    <input type="hidden" name="pre_case_sts_sl" id="pre_case_sts_sl" value="0">
                                                    <input type="hidden" name="suit_file_id" id="suit_file_id" value="">
                                                    <input type="hidden" name="edit_id" id="edit_id" value="">
                                                    <input type="hidden" id="add_edit" value="" name="add_edit" value="">
                                                    <input type="hidden" id="next_dt_sts_value" value="" name="next_dt_sts_value" value="1">
                                                    <input type="hidden" id="present_lawyer_id" value="" name="present_lawyer_id" value="">
                                                    <table style="width:100%;margin-top:20px" id="tab1Table" >
                                                        <tbody>
                                                            <tr>
                                                                <td width="50%">
                                                                    <table style="width: 100%;">
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Previous Case Status</td>
                                                                            <td width="60%" style="font-weight: bold;"><span id="pre_case_sts"></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Previous Case Activities</td>
                                                                            <td width="60%" style="font-weight: bold;"><span id="pre_case_act"></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Previous Case Date</td>
                                                                            <td width="60%" style="font-weight: bold;"><span id="pre_case_date"></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Previous Date Case Status Remarks</td>
                                                                            <td width="60%" style="font-weight: bold;"><span id="pre_case_remarks"></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Present Case Date<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><input type="text" name="case_dt" tabindex="3" onchange="check_hiliday('case_dt'),set_expense_date('case_dt')" placeholder="dd/mm/yyyy" style="width:250px;" id="case_dt" value="" ><script type="text/javascript" charset="utf-8">datePicker ("case_dt");</script></td>
                                                                        </tr>   
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Present Case Status<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="case_sts" name="case_sts" style="padding-left: 3px" tabindex="4"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Present Case Status Remarks</td>
                                                                            <td width="60%" style="font-weight: bold;"><span id="present_case_remarks"></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Next Case Date<span style="color:green">*</span></td>
                                                                            <td width="60%" >
                                                                                <input type="text" name="next_case_dt" tabindex="5" onchange="check_hiliday('next_case_dt')" placeholder="dd/mm/yyyy" style="width:225px;" id="next_case_dt" value="" >
                                                                                <script type="text/javascript" charset="utf-8">datePicker ("next_case_dt");</script>
                                                                                <span id="next_sts_text" style="display:none;margin-left:10px"></span>
                                                                                <div name="next_dt_sts" tabindex="6" id="next_dt_sts" style="float:left; margin: 3px 0px 0 0;"></div>
                                                                            </td>
                                                                        </tr>   
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Purpose For Next Case Date<span style="color:green">*</span></td>
                                                                            <td width="60%" ><div id="next_date_purpose" name="next_date_purpose" style="padding-left: 3px"></div></td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Next Date Case Status Remarks</td>
                                                                            <td width="60%" ><textarea name="next_dt_remarks" tabindex="8" class="text-input-big" id="next_dt_remarks" style="height:40px !important;width:250px"></textarea></td>
                                                                        </tr> 
                                                                        <tr id="optional_attachment_row" style="display:none">
                                                                            <td width="40%" style="font-weight: bold;"><span id="attachment_name"></span> Copy<span style="color:green">*</span> </td>
                                                                            <td width="60%" >
                                                                                <span id="optional_attachment"></span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>

                                                                <td width="50%">
                                                                    <table style="width: 100%;">
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Transfer To Other District</td>
                                                                            <td width="60%" ><div id="district" name="district" style="padding-left: 3px" tabindex="10"></div></td>
                                                                        </tr>     
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">New Lawyer Name</td>
                                                                            <td width="60%" ><div id="lawyer" name="lawyer" style="padding-left: 3px" ></div></td>
                                                                        </tr>
                                                                        <tr id="noc_attachment_row" style="display:none">
                                                                            <td width="40%" style="font-weight: bold;">NOC Attachment<span style="color:red">*</span></td>
                                                                            <td width="60%" >
                                                                                <span id="noc_file"></span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">New Court Name</td>
                                                                            <td width="60%" ><div id="court" name="court" style="padding-left: 3px" tabindex="2"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Transfer To Other District Plaintiff</td>
                                                                            <td width="60%" ><div id="plaintiff" name="plaintiff" style="padding-left: 3px" tabindex="9"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Final Remarks</td>
                                                                            <td width="60%" ><div id="final_remarks" name="final_remarks" style="padding-left: 3px" tabindex="11"></div></td>
                                                                        </tr> 
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Remarks</td>
                                                                            <td width="60%" ><textarea name="remarks" tabindex="8" class="text-input-big" id="remarks" style="height:40px !important;width:250px"></textarea></td>
                                                                        </tr>  
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                                        <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Expenses</span>
                                                                        <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                                            <thead>
                                                                                <input type="hidden" name="expense_counter" id="expense_counter" value="1">
                                                                                <tr>
                                                                                    <td width="2%" style="font-weight: bold;text-align:center">D</td>
                                                                                    <td width="18%" style="font-weight: bold;text-align:center">Expense Type<span style="color:red">*</span></td>
                                                                                    <td width="20%" style="font-weight: bold;text-align:center">Vendor Name<span style="color:red">*</span></td>
                                                                                    <td width="20%" style="font-weight: bold;text-align:center">Activities Name<span style="color:red">*</span></td>
                                                                                    <td width="10%" style="font-weight: bold;text-align:center">Activities Date<span style="color:red">*</span></td>
                                                                                    <td width="10%" style="font-weight: bold;text-align:center">Total Amount<span style="color:red">*</span></td>
                                                                                    <td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="expense_body">
                                                                                
                                                                            </tbody>
                                                                            <tfoot>
                                                                                <tr id="add_guarantor_row">
                                                                                    <td colspan="9" style="text-align: right">
                                                                                        Add More <input tabindex="" type="button" title="Add More" onClick="add_more_expense()" class="addmore"><br>
                                                                                    </td>
                                                                                </tr>
                                                                            </tfoot>
                                                                            
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            
                                                            
                                                            <tr>
                                                                <td colspan="2" style="text-align: center;">
                                                                    <br/>
                                                                    <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;" id="sendButton" /> <span id="send_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                                                    <br/><br/><br/>
                                                                </td>
                                                            </tr>
                                                            <tr id="history_row" style="display:none">
                                                                <td colspan="2">
                                                                    <div style="padding:10px;margin:0 0px;padding-top:20px;overflow-x:hidden;height:250px">
                                                                        <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Case Status History</span>
                                                                        <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                                            <thead>
                                                                                <tr>
                                                                                    <td width="10%" style="font-weight: bold;text-align:center">Prev Case Status</td>
                                                                                    <td width="10%" style="font-weight: bold;text-align:center">New Case Status</td>
                                                                                    <td width="15%" style="font-weight: bold;text-align:center">Change By</td>
                                                                                    <td width="15%" style="font-weight: bold;text-align:center">Change Date</td>
                                                                                    <td width="15%" style="font-weight: bold;text-align:center">Next Case Date</td>
                                                                                    <td width="15%" style="font-weight: bold;text-align:center">Next Date Purpose</td>
                                                                                    <td width="20%" style="font-weight: bold;text-align:center">Remarks</td>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="history_body">
                                                                                
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
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
                                        <? if(CASESTSVERIFY==1){?>
                                            <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                            href="<?=base_url()?>index.php/case_against_bank/bulk_operation/apv" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
                                        <? }?>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <strong>D = </strong>Delete Request,&nbsp;
                                        <strong>E = </strong>Edit Request,&nbsp;
                                        <strong>P = </strong>Preview,&nbsp;
                                        <strong>STC = </strong>Send To Checker,&nbsp;
                                        <strong>V = </strong>Verify&nbsp;
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
            <input name="suit_file_id" id="suit_file_id" value="" type="hidden">
            <input name="cif" id="cif" value="" type="hidden">
            <input name="sec_sts" id="sec_sts" value="" type="hidden">
            <div id="loading_preview" style="text-align:center">
                <span id="loading_p" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
            </div>
            <div style="" id="details_table">
            &nbsp;&nbsp;&nbsp;<img  onClick="printpage('preview_table','gurantor_table','facility_table','facility_card','proposed_type_d')"   style="border:0;display: block;margin-left: auto;margin-right: auto; cursor:pointer" src="<?=base_url()?>old_assets/images/Print.png" alt="print-preview"  />
                <span id="main_body"></span>
                <br>
                <div id="preview_table"></div>
                <div id="gurantor_table"></div>
                <div id="facility_table"></div>
                <div id="facility_card"></div>
                <div id="proposed_type_d"></div>
                <div id="close_btn_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <input type="button" class="button6" id="codeOK" value="Close" />
                </div>
                <div id="sendtochecker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                        <input type="button" class="buttonsendtochecker" id="sendtochecker" value="Send" />
                        <input type="button" class="buttonclose" id="SendTocheckercancel" onclick="close()" value="Cancel" />
                        <span id="sendtochecker_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                    </div>
                </div>
                <div id="next_date_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr>
                                <td>Next Date<span style="color: red;">*</span></td>
                                <td>
                                    <input type="text" name="new_next_date" placeholder="dd/mm/yyyy" style="width:250px;" id="new_next_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("new_next_date");</script>
                                </td>
                            </tr>
                            <tr>
                                <td>Next Date Case Status<span style="color: red;">*</span></td>
                                <td><div id="next_date_sts_grid" name="next_date_sts_grid" style="padding-left: 3px" tabindex="6"></div></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonsendtochecker" id="updatenextdate" value="Save" />
                                    <input type="button" class="buttonclose" id="nextdatecancel" onclick="close()" value="Cancel" />
                                    <span id="nextdate_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="verify_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                        <table style="margin-left:auto;margin-right: auto;margin-top: 0px;">
                            <tr id="return_row" style="display:none">
                                <td>Return Reason<span style="color: red;">*</span></td>
                                <td>
                                    <textarea name="return_reason" id="return_reason" style="width:225px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="buttonsendtochecker" id="verify" value="Approve" />
                                    <input type="button" class="buttondelete" id="reject" value="Reject"/>
                                    <input type="button" class="buttondelete" id="return" value="Return"/>
                                    <input type="button" class="buttonclose" id="Verifycancel" onclick="close()" value="Cancel" />
                                    <span id="verify_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
                    <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
                    <textarea name="comments" id="comments" style="width:370px;"></textarea>
                    </br></br>
                    <input type="button" class="buttondelete" id="delete_button" value="Delete" />
                    <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel" />
                    <span id="delete_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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

    <script type="text/javascript">
var theme = getDemoTheme();
    rules= [
            { input: '#case_sts', message: 'required!', action: 'blur,change', rule: function (input) {                 
                if(input.val() != '')
                {
                    var item = jQuery("#case_sts").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='case_sts']").val(item.value);}
                    return true;                
                }
                else
                {
                    jQuery("#case_sts input").focus();
                    return false;
                }
            }  
            },
            { input: '#next_date_purpose', message: 'required!', action: 'blur,change', rule: function (input) {                    
                if (jQuery("#next_case_dt").val()!='')
                {
                if(input.val() != '')
                {
                    var item = jQuery("#next_date_purpose").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='next_date_purpose']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#next_date_purpose input").focus();
                                return false;
                            }
                        }
                        else
                        {
                            return true;
                        }
                    }  
                    },
                    { input: '#remarks', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                        var item = jQuery("#case_sts").jqxComboBox('getSelectedItem');
                        var item2 = jQuery("#lawyer").jqxComboBox('getSelectedItem');
                        if (item!=null)
                        {
                            if((jQuery("#pre_case_sts_sl").val()>item.value || item2!=null) && jQuery("#remarks").val()=='')
                            {
                                return false;
                                jQuery("#remarks").focus();
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
                    { input: '#remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                     {
                        if(input.val() != '')
                        {
                            if(input.val().length>250)
                            {
                                jQuery("#remarks").focus();
                                return false;

                            }
                        }
                        return true;

                    } },
                    { input: '#next_dt_remarks', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                        var item = jQuery("#next_date_purpose").jqxComboBox('getSelectedItem');
                        if (item!=null)
                        {
                            if(jQuery("#next_dt_remarks").val()=='')
                            {
                                return false;
                                jQuery("#next_dt_remarks").focus();
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
                    { input: '#next_dt_remarks', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                     {
                        if(input.val() != '')
                        {
                            if(input.val().length>250)
                            {
                                jQuery("#next_dt_remarks").focus();
                                return false;

                            }
                        }
                        return true;

                    } },
                    { input: '#case_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                        if(jQuery("#case_dt").val()=='')
                        {
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                    }
                    },
                    { input: '#case_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                    { input: '#next_case_dt', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                        if(jQuery("#next_case_dt").val()=='' && jQuery("#next_dt_sts_value").val()==1)
                        {
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                    }
                    },
                    { input: '#next_case_dt', message: 'Invalid', action: 'keyup, blur, change', rule: function (input, commit){
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
                    { input: '#next_case_dt', message: 'Old Date From Case Date Not allowed !', action: 'change', rule: function(input,commit){  
                            if(input.val()!="") { return validatenewDate(input.val()); } else{return true;}
                      }
                    },
            
            ];
    var options = { 
            complete: function(response) 
            {
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
                    jQuery("#jqxgrid").jqxGrid('updatebounddata');
                    jQuery("#msgArea").val('');
                    jQuery("#error").show();
                    jQuery("#error").fadeOut(11500);
                    jQuery("#error").html('<img align="absmiddle" src="'+baseurl+'images/drag.png" border="0" /> &nbsp;Successfully Saved');
                    reload();
                    jQuery('#jqxTabs').jqxTabs('select', 1);
                }
                            
            }  
        }; 
        jQuery("#case_sts_form").ajaxForm(options);
        jQuery("#sendButton").click( function() {
            jQuery('#case_sts_form').jqxValidator({
                    rules: rules, theme: theme
            });
            var item = jQuery("#lawyer").jqxComboBox('getSelectedItem');
            if(item!=null)
            {
                if ((jQuery("#hidden_noc_file_select").val()=='0' && jQuery('#noc_select_add_edit').val()=='add') || (jQuery("#hidden_noc_file_select").val()=='0' && jQuery("#file_delete_value_noc_file").val()=='1' && jQuery('#noc_select_add_edit').val()=='edit')) 
                {
                    alert('Please Upload Noc File');
                    return false;
                }
            }
            var item = jQuery("#case_sts").jqxComboBox('getSelectedItem');
            if(item!=null && item.value==29)
            {
                if ((jQuery("#hidden_optional_attachment_select").val()=='0' && jQuery('#optional_select_add_edit').val()=='add') || (jQuery("#hidden_optional_attachment_select").val()=='0' && jQuery("#file_delete_value_optional_attachment").val()=='1' && jQuery('#optional_select_add_edit').val()=='edit')) 
                {
                    alert('Please Upload W/A Copy');
                    return false;
                }
            }
            // if(item!=null && item.value==15)
            // {
            //     if ((jQuery("#hidden_optional_attachment_select").val()=='0' && jQuery('#optional_select_add_edit').val()=='add') || (jQuery("#hidden_optional_attachment_select").val()=='0' && jQuery("#file_delete_value_optional_attachment").val()=='1' && jQuery('#optional_select_add_edit').val()=='edit')) 
            //     {
            //         alert('Please Upload Summon Copy');
            //         return false;
            //     }
            // }
            // if(item!=null && item.value==28)
            // {
            //     if ((jQuery("#hidden_optional_attachment_select").val()=='0' && jQuery('#optional_select_add_edit').val()=='add') || (jQuery("#hidden_optional_attachment_select").val()=='0' && jQuery("#file_delete_value_optional_attachment").val()=='1' && jQuery('#optional_select_add_edit').val()=='edit')) 
            //     {
            //        alert('Please Upload Summon Copy');
            //         return false;
            //     }
            // }
                var validationResult = function (isValid) {
                    if (isValid && expense_validation()==true && alert_proxy()==true) {
                        jQuery("#sendButton").hide();
                        jQuery("#send_loading").show();
                        jQuery("#case_sts_form").submit();
                    }
                    else{return;}
                }
                jQuery('#case_sts_form').jqxValidator('validate', validationResult);     
        });
</script>