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
        background-position: -20px 108%;
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
    .error_div{
            border: 1px solid;
            margin: 10px 0px;
            padding: 15px 10px 15px 50px;
            background-repeat: no-repeat;
            background-position: 10px center;
        }
    .error_div{
            color: #D8000C;
            background-color: #FFBABA;
            text-align: center;
        }
    </style>
    <script type="text/javascript">
            var theme = getDemoTheme();
            var package_sts = 0;
            var proposed_type = ["Loan", "Card"];
            var expense_activities = [];
            var suit_req_type = 0;
            var suit_lawyer = 0;
            var suit_district = 0;
            var expense_type = [];
            var lawyer = [];
            var loan_segment = '';
            var filling_date = '';
            var legal_region = [<? $i=1; foreach($legal_region as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var case_sts_grid = [<? $i=1; foreach($case_sts as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var req_type = [<? $i=1; foreach($req_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            jQuery(document).ready(function () {
            jQuery("#req_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Type Of Case", source: req_type, width: 250, height: 25});
            var theme = 'classic';
            var legal_district = [];
            var court = [];
            jQuery("#new_legal_district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Legal District", source: legal_district, width: 215, height: 25});
            jQuery("#court").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Legal Court", source: court, width: 215, height: 25});
            jQuery("#legal_region").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Legal Region", source: legal_region, width: 215, height: 25});
            jQuery("#next_date_sts_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight:100, promptText: "Case Status", source: case_sts_grid, width: 250, height: 25});
            jQuery("#req_type_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Type Of Case", source: req_type, width: 150, height: 30});
            jQuery("#proposed_type_grid").jqxComboBox({theme: theme, width: 100, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
            jQuery("#proposed_type").jqxComboBox({theme: theme, width: 150, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
           //var theme = 'energyblue';
           jQuery('#new_legal_district').bind('change', function (event) {
                change_dropdown('court');       
            });
           jQuery("#next_dt_sts").jqxCheckBox({width: 22, theme: theme ,checked:true });
           jQuery("#both_case").jqxCheckBox({width: 22, theme: theme ,checked:false });
           jQuery("#merge_case").jqxCheckBox({width: 22, theme: theme ,checked:true });
           jQuery("#merge_case_sts").val(1); 
           jQuery('#proposed_type,#legal_region,#proposed_type_grid,#next_date_sts_grid,#req_type_grid').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
           jQuery("#proposed_type").jqxComboBox('val','Loan');
           change_caption();
           jQuery("#proposed_type_grid").jqxComboBox('val','Loan');
            change_caption_grid();
            jQuery('#proposed_type').bind('change', function (event) {
                jQuery("#loan_ac").val('');
                jQuery("#hidden_loan_ac").val('');
                change_caption();       
            });
            jQuery('#proposed_type_grid').bind('change', function (event) {
                jQuery("#loan_ac_grid").val('');
                jQuery("#hidden_loan_ac_grid").val('');
                change_caption_grid();       
            });
            jQuery("#next_dt_sts").bind('change', function (event) {
                var checked = event.args.checked;
                if(checked==true){ 
                    jQuery("#next_dt_sts_value").val(1); 
                    jQuery("#next_date").val(''); 
                    jQuery("#next_date").show();
                    jQuery("#next_sts_text").html('');
                    jQuery("#next_sts_text").hide();

                               
                }else{
                    jQuery("#next_dt_sts_value").val(0); 
                    jQuery("#next_date").val(''); 
                    jQuery("#next_date").hide(); 
                    jQuery("#next_sts_text").html('<strong><?=$sys_config->next_dt_text?></strong>'); 
                    jQuery("#next_sts_text").show();
            }
            });
            jQuery("#both_case").bind('change', function (event) {
                var checked = event.args.checked;
                if(checked==true){ 
                    jQuery("#both_case_sts").val(1); 
                    jQuery('#case_not_running_permission').val('')
                               
                }else{
                    jQuery('#case_not_running_permission').val('1')
                    jQuery("#both_case_sts").val(0); 
            }
            });
            jQuery("#merge_case").bind('change', function (event) {
                var checked = event.args.checked;
                if(checked==true){ 
                    jQuery("#merge_case_sts").val(1); 
                               
                }else{
                    jQuery("#merge_case_sts").val(0); 
            }
            });
            //For Additional input form
            
            jQuery("#confirm").click(function () {
                jQuery("#confirm").hide();
                jQuery("#confirm_cancel").hide();
                jQuery("#confirm_loading").show();
                call_ajax_submit();
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
                            { name: 'e_by_id', type: 'int'},
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
                        url: '<?=base_url()?>index.php/legal_file_process/recase_file_grid',
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
                    var win_h=jQuery( window ).height()-325;
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
                                <? if(RECASEFILEDELETE==1){?>
                                    { text: 'D', menu: false, datafield: 'delete', align:'center', editable: false, sortable: false, width: '2%',
                                    cellsrenderer: function (row) {
                                        editrow = row;
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                        if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.suit_sts==64 || dataRecord.suit_sts==65)){
                                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'delete\','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
                                        }
                                        else if(<?=RECASEFILEDELETE?>=='1' && (check_group_javascript(11) || check_group_javascript(10)))
                                        {
                                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'ho_delete\','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
                                        }
                                        else {
                                                return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                        }

                                        }
                                      },
                                <?php } ?>
                                <? if(RECASEFILEEDIT==1){?>
                                  { text: 'ESF', datafield: 'suitfileedit', editable: false,align:'center', sortable: false, menu: false, width: 35,
                                    cellsrenderer: function(row) {
                                        editrow = row;
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                        if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.suit_sts==64 || dataRecord.suit_sts==65)){
                                            return '<div style="text-align:center;margin-top: 2px; cursor:pointer" onclick="edit_suit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                        }
                                        else if(<?=EDIT?>=='1' && (check_group_javascript(11) || check_group_javascript(10) || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2'))
                                        {
                                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit_suit('+dataRecord.id+','+editrow+',\'1\')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                        }
                                        else{
                                            return '<div style=" margin-top: 7px;text-align:center"></div>';
                                        }
                                    }
                                  },
                                <? }?>
                                <? if(RECASEFILECONFIRM==1){?>
                                  { text: 'SFC', datafield: 'suitfileconfirm', editable: false,align:'center', sortable: false, menu: false, width: 35,
                                    cellsrenderer: function(row) {
                                        editrow = row;
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                        if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.suit_sts==64 || dataRecord.suit_sts==65)){

                                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'confirm\','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                        }
                                        else{
                                            return '<div style=" margin-top: 7px;text-align:center"></div>';
                                        }
                                    }
                                  },
                                <? }?>
                                <? if(REASSIGN==1){?>
                                  { text: 'RF', datafield: 'reassign', editable: false,align:'center', sortable: false, menu: false, width: 35,
                                    cellsrenderer: function(row) {
                                        editrow = row;
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                        if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.case_deal_officer || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2' || check_group_javascript(10) || check_group_javascript(11)) && (dataRecord.suit_sts==75)){
                                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'reassign_file\','+editrow+','+dataRecord.case_deal_officer+')" ><img align="center" src="<?=base_url()?>images/assign.jpg"></div>';
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
                                        if((check_group_javascript(1) || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && dataRecord.suit_sts == 84 ){
                                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'approve_reassign_file\','+editrow+','+dataRecord.case_deal_officer+')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
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
                                    return '<div style="text-align:center;margin-top: 4px;  cursor:pointer" onclick="details('+dataRecord.id+',\'details\','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                                      }
                                },
                                <? if(PUTUP==1){?>
                                  { text: 'PU', datafield: 'putup', editable: false,align:'center', sortable: false, menu: false, width: 35,
                                    cellsrenderer: function(row) {
                                        editrow = row;
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                        if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.case_deal_officer || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2' || check_group_javascript(10) || check_group_javascript(11)) && (dataRecord.suit_sts==76)){
                                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'putup_file\','+editrow+')" ><img align="center" src="<?=base_url()?>images/contactsIcon.png"></div>';
                                        }
                                        else{
                                            return '<div style=" margin-top: 7px;text-align:center"></div>';
                                        }
                                    }
                                  },
                                <? }?>
                                <? if(PUTUPAPPROVE==1){?>
                                  { text: 'AP', datafield: 'approveputup', editable: false,align:'center', sortable: false, menu: false, width: 35,
                                    cellsrenderer: function(row) {
                                        editrow = row;
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                        if(dataRecord.suit_sts == 97 ){
                                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'approve_putup\','+editrow+')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
                                        }
                                        else{
                                            return '<div style=" margin-top: 7px;text-align:center"></div>';
                                        }
                                    }
                                  },
                                <? }?>
                                <? if(UPDATENEXTDATE==1){?>
                                  { text: 'U', datafield: 'updatenextdate', editable: false,align:'center', sortable: false, menu: false, width: 35,
                                    cellsrenderer: function(row) {
                                        editrow = row;
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                        if(dataRecord.suit_sts == 75){
                                         return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'updatenextdate\','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                        }
                                    }
                                  },
                                <? }?>
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
               reload();
            });
            jQuery('#jqxTabs').jqxTabs('select', 0);
            <? if(RECASEFILEADD!=1 && RECASEFILEEDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>
            //End check box update 
            jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#sendnotificationcancel,#authorization_cancel,#confirm_cancel,#reassigncancel,#closeaccount_cancel,#deletecancel,#nextdatecancel,#reassign_approval_cancel") });
            jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
            jQuery('#details').on('close', function (event) {
                jQuery('#action_form').jqxValidator('hide');
            });
            jQuery('#case_name').bind('change', function (event) {
                var item = jQuery("#case_name").jqxComboBox('getSelectedItem');
                if (item!=null && item.value==4)
                {
                    jQuery("#both_case_row").hide(); 
                    jQuery("#both_case_sts").val(0); 
                    jQuery('#case_not_running_permission').val('1')
                }
                else
                {
                    jQuery("#both_case_row").show(); 
                    jQuery("#both_case_sts").val(0); 
                    jQuery('#case_not_running_permission').val('')
                }
                set_prefix();
                show_expense();//For Aurtho jari Only     
            });
            jQuery("#suit_file_save_button").click(function () 
            {
                var validationResult = function (isValid) {
                    if (isValid && expense_validation()==true) {
                        var item = jQuery("#case_name").jqxComboBox('getSelectedItem');
                        if(item!=null && item.value==4)
                        {
                            if(jQuery("#certified_copy_bill_sts").val()=='0' && jQuery("#edit_after_verify_sts").val()!=1)
                            {
                                jQuery('#error_message_row').show();
                                jQuery('#error_message_show').html('Please complete Certified Copy Bill Update');
                                //jQuery("#error_message_show").fadeIn();
                                jQuery("#case_name input").focus();
                                //jQuery("#error_message_show").fadeOut(5000);
                                return false;
                            }
                            if(confirm('Case Claim Amount For Jari case ok or not??'))
                            {
                                jQuery("#suit_file_save_button").hide();
                                jQuery("#send_loading").show();
                                call_ajax_submit_suit();
                                
                            }
                            else
                            {
                                jQuery("#case_claim_amount").focus();
                                return false;
                            }
                        }
                        else
                        {
                            jQuery("#suit_file_save_button").hide();
                            jQuery("#send_loading").show();
                            call_ajax_submit_suit();
                        }
                        
                    }
                    else{return;}
                }
                jQuery('#suit_file_form').jqxValidator('validate', validationResult);
            });
        jQuery('#suit_file_form').jqxValidator({
            rules: [
                    { input: '#case_name', message: 'required!', action: 'blur,change', rule: function (input) {                    
                        if(input.val() != '')
                        {
                            var item = jQuery("#case_name").jqxComboBox('getSelectedItem');
                            if(item != null){jQuery("input[name='case_name']").val(item.value);}
                            return true;                
                        }
                        else
                        {
                            jQuery("#case_name input").focus();
                            return false;
                        }
                    }  
                    },
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
                    { input: '#case_number', message: 'more than 50 characters', action: 'keyup, blur, change', rule: function (input, commit)
                     {
                        if(input.val() != '')
                        {
                            if(input.val().length>50)
                            {
                                jQuery("#case_number").focus();
                                return false;

                            }
                        }
                        return true;

                    } },
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
                    { input: '#next_date', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                        if(jQuery("#next_date").val()=='' && jQuery("#next_dt_sts_value").val()==1)
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
                    { input: '#filling_date', message: 'advance date not allowed!', action: 'keyup, blur, change', rule: function(input,commit){
                        if(jQuery("#filling_date").val()!='')
                        {
                            var today = new Date();
                            var arrDate = jQuery("#filling_date").val().split("/");
                            useDate1 = new Date(arrDate[2], arrDate[1] - 1, arrDate[0]);
                            if(useDate1>today){
                                return false;
                            }else {
                                return true;
                            }
                        }
                        else
                        {
                            return true;
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
                    }
                    
                ]
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
                            jQuery("#legal_district").jqxComboBox({theme: theme, autoDropDownHeight: false, promptText: "Legal District", source: legal_district, width: 215, height: 25});
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
            document.getElementById("loan_ac").disabled = true;
            jQuery("#l_or_c_no_grid").html('Loan A/C or Card');
        }
        else
        {
            document.getElementById("loan_ac").disabled = false;
            var item = jQuery("#proposed_type_grid").jqxComboBox('getSelectedItem');
            if (item.value=='Loan') {
                jQuery("#l_or_c_no_grid").html('Loan A/C ');
            }
            else if(item.value=='Card'){
                jQuery("#l_or_c_no_grid").html('Card');
            }
        }
        
    }
    function set_prefix() 
    {
        var item = jQuery("#case_name").jqxComboBox('getSelectedItem');
        if (item!=null)
        {
            var act_id = item.value;
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
            url: '<?=base_url()?>index.php/legal_file_process/get_case_prefix',
            async:false,
            type: "post",
            data: { [csrfName]: csrfHash,act_id:act_id},
            datatype: "json",
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                var str='';
                    jQuery('#case_prefix').val(json.case_prefix);
                    if(act_id==15)
                    {
                        jQuery('#filling_date').val(filling_date);
                    }
                    else
                    {
                        jQuery('#filling_date').val('');
                    }
                },
                error:   function(model, xhr, options){
                    alert('failed');
                },
                });
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
    function call_ajax_submit_suit()
    {
        var postData = jQuery('#suit_file_form').serialize();
        jQuery.ajax({
                type: "POST",
                cache: false,
                url: '<?=base_url()?>index.php/legal_file_process/add_edit_recase_filling/',
                data : postData,
                datatype: "json",
                success: function(response){
                  ///console.log(response);
                    var json = jQuery.parseJSON(response);
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
                        reload();
                        jQuery('#jqxTabs').jqxTabs('select', 1);
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
                url: '<?=base_url()?>index.php/legal_file_process/delete_action_recase/',
                data : postData,
                datatype: "json",
                success: function(response){
                  ///console.log(response);
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        
                        if (jQuery("#type").val()=='confirm')
                        {
                            jQuery("#confirm").show();
                            jQuery("#confirm_cancel").show();
                            jQuery("#confirm_loading").hide();
                        }
                        if ($('type').value=='delete' || $('type').value=='ho_delete') 
                        {
                            jQuery("#delete_button").show();
                            jQuery("#deletecancel").show();
                            jQuery("#delete_loading").hide();
                        }
                        if (jQuery("#type").val()=='closeaccount')
                        {
                            jQuery("#closeaccount").show();
                            jQuery("#closeaccount_cancel").show();
                            jQuery("#closeaccount_loading").hide();
                        }
                        if (jQuery("#type").val()=='reassign_file')
                        {
                            jQuery("#reassign").show();
                            jQuery("#reassigncancel").show();
                            jQuery("#reassign_loading").hide();
                        }
                        if (jQuery("#type").val()=='updatenextdate')
                        {
                            jQuery("#updatenextdate").show();
                            jQuery("#nextdatecancel").show();
                            jQuery("#nextdate_loading").hide();
                        }
                        if (jQuery("#type").val()=='reject_reassign_approval_file')
                        {
                            jQuery("#reject_reason_row").hide();
                            jQuery("#reject_reason").val('');
                            jQuery("#reject").show();
                            jQuery("#reassign_approval").show();
                            jQuery("#reassign_approval_cancel").show();
                            jQuery("#reassign_approval_loading").hide();
                        }
                        if (jQuery("#type").val()=='reassign_approval_file')
                        {
                            jQuery("#reject_reason_row").hide();
                            jQuery("#reject_reason").val('');
                            jQuery("#reject").show();
                            jQuery("#reassign_approval").show();
                            jQuery("#reassign_approval_cancel").show();
                            jQuery("#reassign_approval_loading").hide();
                        }
                        if (jQuery("#type").val()=='reject_putup_approval_file')
                        {
                            jQuery("#reject_reason_row_putup").hide();
                            jQuery("#reject_reason_putup").val('');
                            jQuery("#reject_putup").show();
                            jQuery("#putup_approval").show();
                            jQuery("#putup_approval_cancel").show();
                            jQuery("#putup_approval_loading").hide();
                        }
                        if (jQuery("#type").val()=='putup_approval_file')
                        {
                            jQuery("#reject_reason_row_putup").hide();
                            jQuery("#reject_reason_putup").val('');
                            jQuery("#reject_putup").show();
                            jQuery("#putup_approval").show();
                            jQuery("#putup_approval_cancel").show();
                            jQuery("#putup_approval_loading").hide();
                        }
                        if ($('type').value=='putup_file') 
                        {
                            jQuery("#putup_button").show();
                            jQuery("#putupcancel").show();
                            jQuery("#putup_loading").hide();
                        }
                        if(json.Message!='OK')
                        {
                            jQuery('#details').jqxWindow('close');
                            alert(json.Message);
                            return false;
                        }else{
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
    function details(id,operation,indx,cma_id,proposed_type,sec_sts)
    {
        jQuery('#deleteEventId').val(id);
        jQuery('#type').val(operation);
        jQuery('#sec_sts').val(sec_sts);
        jQuery("#new_legal_district").jqxComboBox('clearSelection');
        jQuery("input[name='new_legal_district']").val('');
        jQuery("#court").jqxComboBox('clearSelection');
        jQuery("input[name='court']").val('');
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
            jQuery('#reassign_approval_row').hide();
            jQuery('#putup_row').hide();
            jQuery('#putup_approval_row').hide();
        }
        else if (operation=='delete' || operation=='ho_delete') 
        {
            jQuery('#comments').val('');
            jQuery("#header_title").html('Delete Suit File');
            jQuery('#delete_row').show();
            jQuery('#sendtochecker_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#next_date_row').hide();
            jQuery('#reassign_approval_row').hide();
            jQuery('#putup_row').hide();
            jQuery('#putup_approval_row').hide();
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
            jQuery('#next_date_row').hide();
            jQuery('#reassign_approval_row').hide();
            jQuery('#putup_row').hide();
            jQuery('#putup_approval_row').hide();
        }
        else if (operation=='updatenextdate') 
        {
            jQuery('#new_next_date').val('');
            jQuery('#next_dt_remarks').val('');
            jQuery("#next_date_sts_grid").jqxComboBox('clearSelection');
            jQuery("input[name='next_date_sts_grid']").val('');
            jQuery("#header_title").html('Update Next Date');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#next_date_row').show();
            jQuery('#reassign_approval_row').hide();
            jQuery('#putup_row').hide();
            jQuery('#putup_approval_row').hide();
        }

        else if(operation=='reassign_file')
        {
            jQuery("#header_title").html('Reassign Case Deal Officer');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#next_date_row').hide();
            jQuery('#reassign_row').show();
            jQuery('#pre_legal_user').val(cma_id);
            jQuery('#reassign_approval_row').hide();
            jQuery('#putup_row').hide();
            jQuery('#putup_approval_row').hide();
        }
        else if(operation=='approve_reassign_file')
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
            jQuery('#next_date_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#reassign_approval_row').show();
            jQuery('#putup_row').hide();
            jQuery('#putup_approval_row').hide();
        }
        else if (operation=='putup_file') 
        {
            jQuery('#comments').val('');
            jQuery("#header_title").html('PUT-UP Suit File');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#next_date_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#reassign_approval_row').hide();
            jQuery('#putup_row').show();
            jQuery('#putup_approval_row').hide();
        }
        else if(operation=='approve_putup')
        {
            jQuery("#header_title").html('PUT-UP Approval');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#lawyer_notification_row').hide();
            jQuery('#authorization_row').hide();
            jQuery('#confirm_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#closeaccount_row').hide();
            jQuery('#next_date_row').hide();
            jQuery('#reassign_row').hide();
            jQuery('#reassign_approval_row').hide();
            jQuery('#putup_row').hide();
            jQuery('#putup_approval_row').show();
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
            url: "<?=base_url()?>legal_file_process/recase_file_details",
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
                        if (operation=='reassign_file')
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
        if(loan_ac=='' && case_number=='')
        {
            alert('Please provide at least one search parameter!!!');
        }
        else
        {
            jQuery("#grid_loading").show();
            jQuery("#grid_search").hide();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>index.php/legal_file_process/search_recase_suit/",
                data : {[csrfName]: csrfHash,proposed_type:proposed_type,req_type:req_type,loan_ac: loan_ac, case_number:case_number,hidden_loan_ac:hidden_loan_ac},
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
    function edit_suit(id,index,ho_edit_sts=null){
        var val=id;
        jQuery('#next_button').hide();
        jQuery('#next_loading').show();
        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?=base_url()?>legal_file_process/get_recase_info_edit",
            data : {[csrfName]: csrfHash,id:val},
            datatype: "json",
            async:false,
            success: function(response){
               
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if(json.Message=='ok'){
                    jQuery('#jqxTabs').jqxTabs('select', 0);
                    jQuery('#add_edit').val('edit');
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    jQuery('#search_area').hide();
                    jQuery('#suit_form_div').show();
                    var form_html = '';
                    var case_name = [];
                    jQuery.each(json['case_name'],function(key,obj){
                        case_name.push({ value: obj.id, label: obj.name });
                    });
                    var case_sts = [];
                    jQuery.each(json['case_sts'],function(key,obj){
                        case_sts.push({ value: obj.id, label: obj.name });
                    });
                    var plaintiff = [];
                    jQuery.each(json['plaintiff'],function(key,obj){
                        plaintiff.push({ value: obj.id, label: obj.name+' ('+obj.pin+')' });
                    });
                    
                    jQuery.each(json['lawyer'],function(key,obj){
                        lawyer.push({ value: obj.id, label: obj.name });
                    });
                    var court = [];
                    jQuery.each(json['court'],function(key,obj){
                        court.push({ value: obj.id, label: obj.name });
                    });
                    jQuery.each(json['expense_type'],function(key,obj){
                        expense_type.push({ value: obj.id, label: obj.name });
                    });
                    
                    jQuery.each(json['expense_activities'],function(key,obj){
                        expense_activities.push({ value: obj.id, label: obj.name });
                    });
                    var court_activities = [];
                    jQuery.each(json['court_activities'],function(key,obj){
                        court_activities.push({ value: obj.id, label: obj.name });
                    });
                    jQuery("#case_sts_prev_dt").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Status", source: case_sts, width: 250, height: 25});
                    jQuery("#case_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Name", source: case_name, width: 250, height: 25});
                    jQuery("#case_sts_next_dt").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Status", source: case_sts, width: 250, height: 25});
                    jQuery("#filling_plaintiff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Filling Plaintiff", source: plaintiff, width: 250, height: 25});
                    jQuery("#prest_lawyer_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
                    jQuery("#prest_court_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court", source: court, width: 250, height: 25});
                    jQuery('#case_name,#case_sts_next_dt,#case_sts_prev_dt,#filling_plaintiff,#prest_lawyer_name,#prest_court_name').focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
                    });
                    jQuery('#prest_lawyer_name').jqxComboBox('val', json.row_info.prest_lawyer_name);
                    jQuery('#filling_plaintiff').jqxComboBox('val', json.row_info.case_deal_officer);
                    jQuery('#case_name').jqxComboBox('val', json.row_info.case_name);
                    jQuery('#case_sts_prev_dt').jqxComboBox('val', json.row_info.case_sts_prev_dt);
                    jQuery('#case_sts_next_dt').jqxComboBox('val', json.row_info.case_sts_next_dt);
                    jQuery('#prest_court_name').jqxComboBox('val', json.row_info.prest_court_name);
                    jQuery("#case_claim_amount").val(json.row_info.case_claim_amount);
                    jQuery("#loan_ac_show").html(json.row_info.loan_ac);
                    jQuery("#ac_name_show").html(json.row_info.ac_name);
                    jQuery("#pre_case_number_show").html(json.row_info.pre_case_number);
                    jQuery("#hidden_pre_case_number").val(json.row_info.pre_case_number);
                    jQuery("#hidden_pre_suit_id").val(json.row_info.pre_suit_id);
                    jQuery("#hidden_pre_suit_close_sts").val(json.suit_info.final_remarks);
                    if(json.suit_info.final_remarks==2)
                    {
                        jQuery('#both_case').jqxCheckBox({ disabled: true });
                    }
                    certified_copy_bill_sts = json.certified_copy_bill_sts;//set global veriable
                    
                    jQuery("#certified_copy_bill_sts").val(certified_copy_bill_sts);
                    //console.log(json.row_info.pre_suit_id)
                    if (json.row_info.next_dt_sts==1)
                    {
                        jQuery('#next_dt_sts').jqxCheckBox({ checked:true }); 
                        jQuery("#next_dt_sts_value").val(1); 
                        jQuery('#next_date').val(date_formater(json.row_info.next_date));
                        jQuery("#next_date").show();
                        jQuery("#next_sts_text").html('');
                        jQuery("#next_sts_text").hide();
                    
                    }else
                    {
                       jQuery('#next_dt_sts').jqxCheckBox({ checked:false }); 
                       jQuery("#next_dt_sts_value").val(0); 
                        jQuery("#next_date").val(''); 
                        jQuery("#next_date").hide(); 
                        jQuery("#next_sts_text").html('<strong><?=$sys_config->next_dt_text?></strong>'); 
                        jQuery("#next_sts_text").show();
                    }
                    if (json.row_info.both_case_sts==1)
                    {
                        jQuery('#both_case').jqxCheckBox({ checked:true }); 
                        jQuery("#both_case_sts").val(1); 
                    
                    }else
                    {
                       jQuery('#both_case').jqxCheckBox({ checked:false }); 
                       jQuery("#both_case_sts").val(0); 
                    }
                    if (json.row_info.merge_case_sts==1)
                    {
                        jQuery('#merge_case').jqxCheckBox({ checked:true }); 
                        jQuery("#merge_case_sts").val(1); 
                        //old case number
                         var str0 = json.row_info.case_number.split(json.row_info.pre_case_number+'(');
                        // new case number
                        //console.log(str0)
                         var new_case_number = str0[1].substring(0, str0[1].length - 1);
                         var full_case_number = new_case_number.split("-");
                         var case_prefix = full_case_number[0];
                         var str = full_case_number[1].split("/");
                         var case_number = str[0];
                         var year = str[1];
                    
                    }else
                    {
                       jQuery('#merge_case').jqxCheckBox({ checked:false }); 
                       jQuery("#merge_case_sts").val(0); 
                        var full_case_number = json.row_info.case_number.split("-");
                        var case_prefix = full_case_number[0];
                       var str = full_case_number[1].split("/");
                       var case_number = str[0];
                       var year = str[1];
                    }
                    jQuery('#case_prefix').val(case_prefix);
                    jQuery('#case_number').val(case_number);
                    jQuery('#case_year').val(year);

                    suit_req_type = json.row_info.req_type;
                    suit_lawyer = json.row_info.filling_plaintiff;
                    suit_district = json.row_info.district;
                    
                    jQuery('#prev_date').val(date_formater(json.row_info.prev_date));
                    jQuery('#filling_date').val(date_formater(json.row_info.filling_date));
                    jQuery('#remarks_next_date').val(json.row_info.remarks_next_date);
                    //For Making Three expenses before suit file
                    jQuery('#expense_counter').val('0');
                    jQuery('#expense_body').html('');
                    jQuery("#hidden_cma_id").val(json.row_info.cma_id);
                    jQuery("#edit_id").val(json.row_info.id);
                    var i=0;
                    package_sts = json.package_sts;//set global veriable
                    var expense_counter_edit = 0;
                    jQuery.each(json['expense'],function(key,obj){
                        expense_counter_edit++;
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
                            html_string += '<td><div id="expense_type_'+new_counter+'" name="expense_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange=""></div></td>';
                            html_string += '<td><div id="district_'+new_counter+'" name="district_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none;width:90%"></div><div id="vendor_id_'+new_counter+'" name="vendor_id_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" ></div><input name="vendor_name_'+new_counter+'" type="text" class="" style="width:98%;display:none" id="vendor_name_'+new_counter+'" /></td>';
                            html_string += '<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange="get_expense_amount(\'activities_name_'+new_counter+'\','+suit_district+','+new_counter+','+suit_req_type+')"></div></td>';
                            html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="'+date_formater(obj.activities_date)+'" ></td>';
                            
                            html_string += '<td><input type="text" readonly name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="'+obj.amount+'" ><input type="text" name="p_cost_'+new_counter+'" tabindex="" placeholder="" style="width:90%;display:none" id="p_cost_'+new_counter+'" value="" onkeypress="return numbersonly(event)"></td>';
                            if(json.package_sts==1)//when package available
                            {
                                if(obj.package_select_sts==0)
                                {
                                    html_string +='<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'+new_counter+'" id="chkBoxSelect'+new_counter+'" onClick="CheckChanged_2(this,'+new_counter+')"/><input type="hidden" name="package_delete_'+new_counter+'" id="package_delete_'+new_counter+'" value="1"></td>';
                                }
                                else
                                {
                                    html_string +='<td style="text-align:center"><input type="checkbox" checked name="chkBoxSelect'+new_counter+'" id="chkBoxSelect'+new_counter+'" onClick="CheckChanged_2(this,'+new_counter+')"/><input type="hidden" name="package_delete_'+new_counter+'" id="package_delete_'+new_counter+'" value="0"></td>';
                                }
                            }
                            else
                            {
                                html_string +='<td>&nbsp;<input type="hidden" name="package_delete_'+new_counter+'" id="package_delete_'+new_counter+'" value="1"></td>';
                            }
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
                        jQuery('#vendor_id_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, height: 25});
                        jQuery('#vendor_id_'+new_counter).focusout(function() {
                                    commbobox_check(jQuery(this).attr('id'));
                        });
                        
                        datePicker('activities_date_'+new_counter);
                        jQuery('#expense_type_'+new_counter).jqxComboBox('val', obj.expense_type);
                        //jQuery('#expense_type_'+new_counter).jqxComboBox({ disabled: true });
                        jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, height: 25});
                        jQuery('#activities_name_'+new_counter).focusout(function() {
                                    commbobox_check(jQuery(this).attr('id'));
                        });
                        jQuery("#vendor_id_"+new_counter).jqxComboBox('val', obj.vendor_id);
                        jQuery('#activities_name_'+new_counter).jqxComboBox('val', obj.activities_name);
                        //jQuery('#activities_name_'+new_counter).jqxComboBox({ disabled: true });
                        
                    });
                    if(package_sts==1)//when package available
                    {
                        jQuery('#package_sts').val(package_sts);
                        jQuery('#package_id').val(json.package_info.package_id);
                        jQuery('#package_history_id').val(json.package_info.history_id);
                        var html = '';      
                        html +='<tr id="expense">';
                                html +='<td style="text-align:center">'+json.package_info.lawyer_name+'</td>';
                                html +='<td style="text-align:center">'+json.package_info.loan_ac+'</td>';
                                html +='<td style="text-align:center">'+json.package_info.case_number+'</td>';
                                html +='<td style="text-align:center">'+(parseFloat(json.package_info.package_amount)-parseFloat(json.package_info.disbursed_amount))+'<input type="hidden" id="remaining_amount" name="remaining_amount" value="'+(parseFloat(json.package_info.package_amount)-parseFloat(json.package_info.disbursed_amount))+'"></td>';
                                html +='<td style="text-align:center"><div id="activities_name_package" name="activities_name_package" style="padding-left: 3px;margin-left:5px;width:90%"></div></td>';
                                html +='<td style="text-align:center"><input type="radio" id="without_amount" name="package_amount" value="without_amount" onchange="check_package()"><label for="without_amount">Without Amount</label><input type="radio" onchange="check_package()" id="with_amount" name="package_amount" value="with_amount"><label for="with_amount">With Amount</label><input name="package_bill_amount" type="text" class="" style="width:90%;display:none" id="package_bill_amount" /><br></td>';
                        html +='</tr>';
                        jQuery('#package_body').html(html);
                        if(json.package_info.amount_selection==1)
                        {
                            const yesBtn = document.getElementById('with_amount');
                            yesBtn.checked = true;
                            jQuery('#package_bill_amount').val(json.package_info.amount);
                            jQuery('#package_bill_amount').show();
                        }
                        else
                        {
                            const yesBtn = document.getElementById('without_amount');
                            yesBtn.checked = true;
                            jQuery('#package_body').val('');
                        }
                        
                        jQuery("#activities_name_package").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, width: 180, height: 25});
                        if(json.package_info.activities_id!=null && json.package_info.activities_id!='' && json.package_info.activities_id!=0)
                        {
                            jQuery('#activities_name_package').jqxComboBox('val', json.package_info.activities_id);
                        }
                        
                        jQuery('#package_row').show();
                    }
                    else
                    {
                        jQuery('#package_row').hide();
                        jQuery('#package_body').html('');
                    }
                    loan_segment = json.row_info.loan_segment;
                    jQuery('#expense_counter_edit').val(expense_counter_edit);
                    make_expense_amount_editable('expense_counter',json.row_info.loan_segment);
                    //make_expense();
                    //show_expense();
                    jQuery('#expense_tr').show();
                    if(ho_edit_sts==1)
                    {
                        jQuery("#edit_after_verify_sts").val('1');
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
    function delete_row_expense (row_id) {
        jQuery('#expense_' + row_id).hide();
        jQuery('#expense_delete_' + row_id).val(1);
    }
    function load_filing_info(cma_id=null){
        //alert('ddd')
        var case_close_sts=0;
        if (cma_id==null)
        {
            var checkboxes = document.getElementsByName('suit_id');
            var val;var required = false;
            checkboxes.forEach((item) => {
                if(item.checked==true){
                    val=item.value;
                    case_close_sts = jQuery('#case_close_sts_' + val).val();
                    required = true;
                }
                
            });
            if(required==false){
                alert('Please Select a Loan Account!');
                return false;
            }
            if(case_close_sts=='2')
            {
                if (confirm("Selected Case was settled! continue suit file??") == false) {
                      return false;
                }
            }
        }
        else
        {
            var val=cma_id;
        }
        jQuery('#next_button').hide();
        jQuery('#next_loading').show();
        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?=base_url()?>legal_file_process/get_recase_filing_info",
            data : {[csrfName]: csrfHash,id:val},
            datatype: "json",
            async:false,
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if(json.Message=='ok'){
                    let date =  new Date().getFullYear();
                    jQuery('#case_year').val(date);
                    jQuery('#add_edit').val('add');
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    jQuery('#search_area').hide();
                    jQuery('#suit_form_div').show();
                    var form_html = '';
                    var case_name = [];
                    jQuery.each(json['case_name'],function(key,obj){
                        case_name.push({ value: obj.id, label: obj.name });
                    });
                    var case_sts = [];
                    jQuery.each(json['case_sts'],function(key,obj){
                        case_sts.push({ value: obj.id, label: obj.name });
                    });
                    var plaintiff = [];
                    jQuery.each(json['plaintiff'],function(key,obj){
                        plaintiff.push({ value: obj.id, label: obj.name+' ('+obj.pin+')' });
                    });
                    jQuery.each(json['lawyer'],function(key,obj){
                        lawyer.push({ value: obj.id, label: obj.name });
                    });
                    var court = [];
                    jQuery.each(json['court'],function(key,obj){
                        court.push({ value: obj.id, label: obj.name });
                    });
                    jQuery.each(json['expense_type'],function(key,obj){
                        expense_type.push({ value: obj.id, label: obj.name });
                    });
                    
                    jQuery.each(json['expense_activities'],function(key,obj){
                        expense_activities.push({ value: obj.id, label: obj.name });
                    });
                    var court_activities = [];
                    jQuery.each(json['court_activities'],function(key,obj){
                        court_activities.push({ value: obj.id, label: obj.name });
                    });
                    jQuery("#case_sts_prev_dt").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Status", source: case_sts, width: 250, height: 25});
                    jQuery("#case_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Name", source: case_name, width: 250, height: 25});
                    jQuery("#case_sts_next_dt").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Status", source: case_sts, width: 250, height: 25});
                    jQuery("#filling_plaintiff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Filling Plaintiff", source: plaintiff, width: 250, height: 25});
                    jQuery("#prest_lawyer_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
                    jQuery("#prest_court_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court", source: court, width: 250, height: 25});
                    jQuery('#case_name,#case_sts_next_dt,#case_sts_prev_dt,#filling_plaintiff,#prest_lawyer_name,#prest_court_name').focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
                    });
                    filling_date = date_formater(json.suit_info.filling_date);
                    jQuery('#next_dt_sts').jqxCheckBox({ checked:true }); 
                    jQuery("#next_dt_sts_value").val(1); 
                    jQuery("#next_date").val(''); 
                    jQuery("#next_date").show();
                    jQuery("#next_sts_text").html('');
                    jQuery("#next_sts_text").hide();
                    jQuery('#prest_lawyer_name').jqxComboBox('val', json.suit_info.prest_lawyer_name);
                    jQuery('#filling_plaintiff').jqxComboBox('val', json.suit_info.case_deal_officer);
                    jQuery('#prest_court_name').jqxComboBox('val', json.suit_info.prest_court_name);
                    jQuery("#case_claim_amount").val(json.suit_info.case_claim_amount);
                    jQuery("#hidden_pre_case_claim_amount").val(json.suit_info.case_claim_amount);
                    jQuery("#loan_ac_show").html(json.suit_info.loan_ac);
                    jQuery("#ac_name_show").html(json.suit_info.ac_name);
                    jQuery("#pre_case_number_show").html(json.suit_info.case_number);
                    //For Making Three expenses before suit file
                    suit_req_type = json.suit_info.req_type;
                    suit_lawyer = json.suit_info.prest_lawyer_name;
                    suit_district = json.suit_info.district;
                    package_sts = json.package_sts;//set global veriable
                    certified_copy_bill_sts = json.certified_copy_bill_sts;//set global veriable
                    
                    jQuery("#certified_copy_bill_sts").val(certified_copy_bill_sts);
                    jQuery('#expense_counter').val('0');
                    jQuery('#expense_body').html('');
                    jQuery("#hidden_cma_id").val(json.suit_info.cma_id);
                    jQuery("#hidden_pre_suit_id").val(json.suit_info.id);
                    jQuery("#hidden_pre_suit_close_sts").val(json.suit_info.final_remarks);
                    if(json.suit_info.final_remarks==2)
                    {
                        jQuery('#both_case').jqxCheckBox({ disabled: true });
                    }
                    jQuery("#hidden_pre_case_number").val(json.suit_info.case_number);
                    loan_segment = json.suit_info.loan_segment;
                    if(package_sts==1)//when package available
                    {
                        jQuery('#package_sts').val(package_sts);
                        jQuery('#package_id').val(json.package_info.id);
                        var html = '';      
                        html +='<tr id="expense">';
                                html +='<td style="text-align:center">'+json.package_info.lawyer_name+'</td>';
                                html +='<td style="text-align:center">'+json.package_info.loan_ac+'</td>';
                                html +='<td style="text-align:center">'+json.package_info.case_number+'</td>';
                                html +='<td style="text-align:center">'+(parseFloat(json.package_info.package_amount)-parseFloat(json.package_info.disbursed_amount))+'<input type="hidden" id="remaining_amount" name="remaining_amount" value="'+(parseFloat(json.package_info.package_amount)-parseFloat(json.package_info.disbursed_amount))+'"></td>';
                                html +='<td style="text-align:center"><div id="activities_name_package" name="activities_name_package" style="padding-left: 3px;margin-left:5px;width:90%"></div></td>';
                                html +='<td style="text-align:center"><input type="radio" id="without_amount" name="package_amount" value="without_amount" onchange="check_package()"><label for="without_amount">Without Amount</label><input type="radio" onchange="check_package()" id="with_amount" name="package_amount" value="with_amount"><label for="with_amount">With Amount</label><input name="package_bill_amount" type="text" class="" style="width:90%;display:none" id="package_bill_amount" /><br></td>';
                        html +='</tr>';
                        jQuery('#package_body').html(html);
                        const yesBtn = document.getElementById('without_amount');
                        yesBtn.checked = true;
                        jQuery("#activities_name_package").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, width: 180, height: 25});
                        jQuery('#package_row').show();
                    }
                    else
                    {
                        jQuery('#package_row').hide();
                        jQuery('#package_body').html('');
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
    function get_expense_amount(act_id,cma_district,counter,req_type) 
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
    function check_package()
    {
        var ele = document.querySelector('input[name="package_amount"]:checked').value;
        jQuery('#package_bill_amount').val('');
        if(ele=='with_amount')
        {
            jQuery('#package_bill_amount').show();
            jQuery('#package_bill_amount').focus();
        }
        else
        {
            jQuery('#package_bill_amount').hide();
        }
    }
    function clear_form() {
        jQuery("#edit_after_verify_sts").val('0');
        jQuery("#certified_copy_bill_sts").val('0');
        suit_req_type = 0;
        suit_lawyer = 0;
        suit_district = 0;
        loan_segment = '';
        filling_date = '';
        jQuery("#case_sts_prev_dt").jqxComboBox('clearSelection');
        jQuery("input[name='case_sts_prev_dt']").val('');
        jQuery('#both_case').jqxCheckBox({ disabled: false });
        jQuery("#prest_lawyer_name").jqxComboBox('clearSelection');
        jQuery("input[name='prest_lawyer_name']").val('');
        jQuery("#filling_plaintiff").jqxComboBox('clearSelection');
        jQuery("input[name='filling_plaintiff']").val('');
        jQuery("#case_name").jqxComboBox('clearSelection');
        jQuery("input[name='case_name']").val('');
        jQuery("#hidden_pre_case_claim_amount").val(0);
        jQuery("#expense_counter_edit").val(0);
        jQuery("#hidden_pre_suit_close_sts").val('');
        expense_activities = [];
        expense_type = [];
        jQuery("#case_sts_next_dt").jqxComboBox('clearSelection');
        jQuery("input[name='case_sts_next_dt']").val('');
        jQuery("#case_claim_amount").val('');
        jQuery("#loan_ac_show").html('');
        jQuery("#ac_name_show").html('');
        jQuery("#pre_case_number_show").html('');
        jQuery('#expense_counter').val('0');
        jQuery('#both_case_sts').val('');
        jQuery('#merge_case_sts').val('');
        jQuery('#hidden_pre_case_number').val('');
        jQuery('#expense_body').html('');
        jQuery("#case_number").val('');
        jQuery("#case_year").val('');
        jQuery("#prev_date").val('');
        jQuery("#next_date").val('');
        jQuery("#remarks_next_date").val('');
        jQuery("#filling_date").val('');
        jQuery("#prest_court_name").jqxComboBox('clearSelection');
        jQuery("input[name='prest_court_name']").val('');
        jQuery("#hidden_cma_id").val('');
        jQuery("#hidden_pre_suit_id").val('');
        // ln_cost = 0;
        // court_fee_25 = 0;
        // court_fee_15 = 0;
        // procurement = 500;
        // total_court_fee = 0;
        // single_ln_cost = 0;
        // total_ln = 0;
        // fixed_court_fee = 57500;
        jQuery('#next_dt_sts').jqxCheckBox({ checked:true }); 
        jQuery('#both_case').jqxCheckBox({ checked:false }); 
        jQuery('#merge_case').jqxCheckBox({ checked:true }); 
        jQuery("#next_dt_sts_value").val(0); 
        jQuery("#both_case_sts").val(''); 
        jQuery('#case_not_running_permission').val('');
        jQuery("#merge_case_sts").val(1); 
        jQuery("#next_date").val(''); 
        jQuery("#next_date").show(); 
        jQuery("#next_sts_text").html(''); 
        jQuery("#next_sts_text").hide();
        jQuery('#package_row').hide();
        jQuery('#package_body').html('');
        jQuery('#package_sts').val('');
        jQuery('#package_id').val('');
        jQuery('#package_history_id').val('');
        jQuery('#error_message_row').hide();
    }
    function reload()
    {
        jQuery('#suit_form_div').hide();
        jQuery('#search_area').show();
        jQuery('#searchTable').html('');
        jQuery("#edit_id").val('');
        clear_form();
        jQuery('#add_edit').val('');
        jQuery('#suit_file_form').jqxValidator('hide');
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
        if(package_sts==1)//package Validation
        {
           var ele = document.querySelector('input[name="package_amount"]:checked').value;
            if(ele=='with_amount')
            { 
                var act = jQuery("#activities_name_package").jqxComboBox('getSelectedItem');
                if (!act)
                {
                    alert('Activities Name Required');
                    jQuery('#activities_name_package input').focus();
                    return false;
                }
                if(jQuery.trim(jQuery('#package_bill_amount').val())=='')
                {
                    alert('Amount Required');
                    jQuery('#package_bill_amount').focus();
                    return false;
                }
                if(jQuery.trim(jQuery('#package_bill_amount').val())!='')
                {
                    if(!checknumber_alphabatic('package_bill_amount'))
                    {
                        alert('Amount Only Numeric');
                        jQuery('#package_bill_amount').focus();
                        return false;
                    }
                }
                if(jQuery.trim(jQuery('#package_bill_amount').val())!='')
                {
                    if(parseFloat(jQuery("#package_bill_amount").val())>parseFloat(jQuery("#remaining_amount").val()))
                      {
                        alert('Amount Bigger Then Remaining Amount');
                        jQuery('#package_bill_amount').focus();
                        return false;

                      }
                }
            }
        }
        if(jQuery('#both_case_sts').val()=='1' && jQuery('#case_not_running_permission').val()=='' && jQuery('#hidden_pre_suit_close_sts').val()!='2')
        {
            return show_confrimation_pop_up();
        }
        var filling_date = jQuery('#filling_date').val();
        var case_year = jQuery('#case_year').val();
        if(filling_date!='')
        {
            var item2 = jQuery("#case_name").jqxComboBox('getSelectedItem');
             const myArray = filling_date.split("/"); 
             if(myArray[2]!=case_year && item2!=null && item2.value!=15)
             {
                alert('Please rectify Case Year');
                jQuery('#case_year').focus();
                return false;
             }
        }
        return true;
    }
    function make_expense_jari()
    {
        jQuery('#expense_counter').val('0');
        jQuery('#expense_body').html('');
        for (var i = 1; i <=3; i++) 
        {
            var counter = jQuery('#expense_counter').val();
            var new_counter = parseInt(counter) + 1;
            html_string = '';

                html_string += '<tr id="expense_'+new_counter+'">';
                html_string += '<td>';
                html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
                html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
                //html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
                html_string += '</td>';
                html_string += '<td><div id="expense_type_'+new_counter+'" name="expense_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange=""></div></td>';
                html_string += '<td><div id="district_'+new_counter+'" name="district_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data('+new_counter+')"></div><div id="vendor_id_'+new_counter+'" name="vendor_id_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" ></div><input name="vendor_name_'+new_counter+'" type="text" class="" style="width:98%;display:none" id="vendor_name_'+new_counter+'" /></td>';
                html_string += '<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" ></div></td>';
                html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" ></td>';
                html_string += '<td><input type="text" readonly name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ><input type="text" name="p_cost_'+new_counter+'" tabindex="" placeholder="" style="width:90%;display:none" id="p_cost_'+new_counter+'" value="" onkeypress="return numbersonly(event)"></td>';
                if(package_sts==1)//when package available
                {
                    html_string +='<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'+new_counter+'" checked id="chkBoxSelect'+new_counter+'" onClick="CheckChanged_2(this,'+new_counter+')"/><input type="hidden" name="package_delete_'+new_counter+'" id="package_delete_'+new_counter+'" value="0"></td>';
                }
                else
                {
                    html_string +='<td>&nbsp;<input type="hidden" name="package_delete_'+new_counter+'" id="package_delete_'+new_counter+'" value="1"></td>';
                }
                html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
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
            jQuery('#vendor_id_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, height: 25});
            jQuery('#vendor_id_'+new_counter).focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
            });
            
            datePicker('activities_date_'+new_counter);
            if(i==1)//For Drafting COST
            {
                jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, height: 25});
                jQuery('#activities_name_'+new_counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                
                jQuery('#expense_type_'+new_counter).jqxComboBox('val', 1);
                jQuery('#expense_type_'+new_counter).jqxComboBox({ disabled: true });
                jQuery('#activities_name_'+new_counter).jqxComboBox('val', 20);
                jQuery("#vendor_id_"+new_counter).jqxComboBox('val', suit_lawyer);
                get_expense_amount('activities_name_'+new_counter,suit_district,new_counter,suit_req_type);
            }
            if(i==2)//For Filing COST
            {
                jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, height: 25});
                jQuery('#activities_name_'+new_counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                
                jQuery('#expense_type_'+new_counter).jqxComboBox('val', 1);
                jQuery('#expense_type_'+new_counter).jqxComboBox({ disabled: true });
                jQuery('#activities_name_'+new_counter).jqxComboBox('val', 21);
                jQuery("#vendor_id_"+new_counter).jqxComboBox('val', suit_lawyer);
                get_expense_amount('activities_name_'+new_counter,suit_district,new_counter,suit_req_type);
            }
            if(i==3)//For Summon Notice COST
            {
                jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, height: 25});
                jQuery('#activities_name_'+new_counter).focusout(function() {
                            commbobox_check(jQuery(this).attr('id'));
                });
                
                jQuery('#expense_type_'+new_counter).jqxComboBox('val', 1);
                jQuery('#expense_type_'+new_counter).jqxComboBox({ disabled: true });
                jQuery('#activities_name_'+new_counter).jqxComboBox('val', 22);
                jQuery("#vendor_id_"+new_counter).jqxComboBox('val', suit_lawyer);
                get_expense_amount('activities_name_'+new_counter,suit_district,new_counter,suit_req_type);
            }
            jQuery('#activities_name_'+new_counter).jqxComboBox({ disabled: true });
        }
        make_expense_amount_editable('expense_counter',loan_segment);
        
    }
    function make_expense_others()
    {
        jQuery('#expense_counter').val('0');
        jQuery('#expense_body').html('');
        var counter = jQuery('#expense_counter').val();
            var new_counter = parseInt(counter) + 1;
            html_string = '';

            html_string += '<tr id="expense_'+new_counter+'">';
            html_string += '<td>';
            html_string += '<input type="hidden" id="expense_edit_'+new_counter+'" name="expense_edit_'+new_counter+'" value="0">';
            html_string += '<input type="hidden" id="expense_delete_'+new_counter+'" name="expense_delete_'+new_counter+'" value="0">';
            //html_string += '<img src="<?=base_url()?>images/delete-New.png" onclick="delete_row_expense('+new_counter+')" style="margin-top: 5px;cursor:pointer">';
            html_string += '</td>';
            html_string += '<td><div id="expense_type_'+new_counter+'" name="expense_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange=""></div></td>';
            html_string += '<td><div id="district_'+new_counter+'" name="district_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none;width:90%" onchange="get_dropdown_data('+new_counter+')"></div><div id="vendor_id_'+new_counter+'" name="vendor_id_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" ></div><input name="vendor_name_'+new_counter+'" type="text" class="" style="width:98%;display:none" id="vendor_name_'+new_counter+'" /></td>';
            html_string += '<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange="get_expense_amount(\'activities_name_'+new_counter+'\','+suit_district+','+new_counter+','+suit_req_type+')"></div></td>';
            html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" ></td>';
            html_string += '<td><input type="text" readonly name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ><input type="text" name="p_cost_'+new_counter+'" tabindex="" placeholder="" style="width:90%;display:none" id="p_cost_'+new_counter+'" value="" onkeypress="return numbersonly(event)"></td>';
            if(package_sts==1)//when package available
            {
                html_string +='<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'+new_counter+'" checked id="chkBoxSelect'+new_counter+'" onClick="CheckChanged_2(this,'+new_counter+')"/><input type="hidden" name="package_delete_'+new_counter+'" id="package_delete_'+new_counter+'" value="0"></td>';
            }
            else
            {
                html_string +='<td>&nbsp;<input type="hidden" name="package_delete_'+new_counter+'" id="package_delete_'+new_counter+'" value="1"></td>';
            }
            html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
            html_string += '</tr>';
        jQuery('#expense_body').html(html_string);
        jQuery('#expense_counter').val(new_counter);
        jQuery('#expense_type_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Expense Type", source: expense_type, height: 25});
        jQuery('#expense_type_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#vendor_id_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, height: 25});
        jQuery('#vendor_id_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, height: 25});
        jQuery('#activities_name_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        
        datePicker('activities_date_'+new_counter);
        jQuery('#expense_type_'+new_counter).jqxComboBox('val', 1);
        jQuery("#vendor_id_"+new_counter).jqxComboBox('val', suit_lawyer);
        make_expense_amount_editable('expense_counter',loan_segment);
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
            html_string += '<td><div id="expense_type_'+new_counter+'" name="expense_type_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" ></div></td>';
            html_string += '<td><div id="district_'+new_counter+'" name="district_'+new_counter+'" style="padding-left: 3px;margin-left:5px;display:none;width:90%" ></div><div id="vendor_id_'+new_counter+'" name="vendor_id_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" ></div><input name="vendor_name_'+new_counter+'" type="text" class="" style="width:98%;display:none" id="vendor_name_'+new_counter+'" /></td>';
            html_string += '<td><div id="activities_name_'+new_counter+'" name="activities_name_'+new_counter+'" style="padding-left: 3px;margin-left:5px;" onchange="get_expense_amount(\'activities_name_'+new_counter+'\','+suit_district+','+new_counter+','+suit_req_type+')"></div></td>';
            html_string += '<td><input type="text" name="activities_date_'+new_counter+'" tabindex="11" placeholder="dd/mm/yyyy" style="width:98%;" id="activities_date_'+new_counter+'" value="" ></td>';
            html_string += '<td><input type="text" readonly name="amount_'+new_counter+'" tabindex="" placeholder="" style="width:90%;" id="amount_'+new_counter+'" value="" ></td>';
            if(package_sts==1)//when package available
            {
                html_string +='<td style="text-align:center"><input type="checkbox" name="chkBoxSelect'+new_counter+'" checked id="chkBoxSelect'+new_counter+'" onClick="CheckChanged_2(this,'+new_counter+')"/><input type="hidden" name="package_delete_'+new_counter+'" id="package_delete_'+new_counter+'" value="0"></td>';
            }
            else
            {
                html_string +='<td>&nbsp;<input type="hidden" name="package_delete_'+new_counter+'" id="package_delete_'+new_counter+'" value="1"></td>';
            }
            html_string += '<td><textarea name="remarks_'+new_counter+'" class="text-input-big" id="remarks_'+new_counter+'" style="height:40px !important;width:90%"></textarea></td>';
            html_string += '</tr>';

        jQuery('#expense_' + counter).after(html_string);
        jQuery('#expense_counter').val(new_counter);
        
        jQuery('#expense_type_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Expense Type", source: expense_type, height: 25});
        jQuery('#expense_type_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#vendor_id_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Lawyer", source: lawyer, height: 25});
        jQuery('#vendor_id_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#activities_name_'+new_counter).jqxComboBox({theme: theme, width: 180, autoOpen: false, autoDropDownHeight: false, promptText: "Select Activity", source: expense_activities, height: 25});
        jQuery('#activities_name_'+new_counter).focusout(function() {
                    commbobox_check(jQuery(this).attr('id'));
        });
        jQuery('#expense_type_'+new_counter).jqxComboBox('val', 1);
        jQuery("#vendor_id_"+new_counter).jqxComboBox('val', suit_lawyer);
        datePicker('activities_date_'+new_counter);
        set_expense_date('filling_date',new_counter,'1');
        make_expense_amount_editable('expense_counter',loan_segment);
    }
    function show_expense() 
    {
        var item = jQuery("#case_name").jqxComboBox('getSelectedItem');
        if(jQuery('#add_edit').val()=='add')//Making expenses only for add
        {
            if (item!=null && item.value==4)
            {
                make_expense_jari();
                jQuery('#expense_counter').val('3');
                jQuery('#expense_tr').show();
            }
            else
            {
                make_expense_others();
                jQuery('#expense_tr').show();
            }
            set_expense_date('filling_date','','1');

        }

    }
    function show_confrimation_pop_up()
    {
        $('sendToCheckerMessageDialogConfirm2').style.display = 'inline';
        $('sendToCheckerMessageDialogCancel2').style.display = 'inline';
        $('loadingReturn').style.display = 'none';
        sendToCheckerMessageDialog = new EOL.dialog($('sendToCheckerMessageDialogContent2'), {position: 'fixed', modal:true, width:470, close:true, id: 'sendToCheckerMessageDialog2' });
        sendToCheckerMessageDialog.show();
    }
    function give_permission()
    {
        sendToCheckerMessageDialog.hide();
        jQuery("#case_not_running_permission").val(1);
        return true;
    }
    function close_window()
    {
        sendToCheckerMessageDialog.hide();
        jQuery("#case_not_running_permission").val('');
        return false;
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
                                    <div style="padding: 10px;">
                                        <div id="search_area">
                                            <form method="POST" name="form" id="form"  style="margin:0px;">
                                               <input type="hidden" id="hidden_loan_ac" value="" name="hidden_loan_ac">
                                               <div style="padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                                    <table id="deal_body" style="display:block;width:90%">
                                                        <tr>
                                                            <td style="text-align:right;width:10%"><strong>Type Of Case&nbsp;&nbsp;</strong> </td>
                                                            <td style="width:10%"><div style="padding-left:1.8%" id="req_type" name="req_type"></div></td>
                                                            <td style="text-align:right;width:10%"><strong>Propsed Type&nbsp;&nbsp;</strong> </td>
                                                            <td style="width:10%"><div style="padding-left:1.8%" id="proposed_type" name="proposed_type"></div></td>
                                                            <td style="text-align:right;width:9%"><strong><span id="l_or_c_no"></span> No.</strong></td>
                                                            <td style="width:15%"><input name="loan_ac" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac" value="" onKeyUp="javascript:return mask(this.value,this);"/></td>
                                                            <td  style="text-align:right;width:5%"><input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="searchsuit()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" />
                                                            </td>
                                                        </tr>
                                                    </table>
                                              </div>
                                              <div style="text-align:center"><span id="grid_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span></div>
                                              <div id="searchTable"></div>
                                            </form>
                                        </div>
                                        <div id="suit_form_div" style="display:none">
                                            <div id="back_area" style="text-align: center;padding: 0px;width:100%;height:50px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                                    <input type='button' class="buttonStyle" id="back" name='' value='Back' onclick="reload()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;margin-top:10px" />
                                              </div>
                                              <div id="suit_form_area">
                                                <form method="POST" name="suit_file_form" id="suit_file_form"  style="margin:0px;">
                                                    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                    <input type="hidden" id="hidden_cma_id" value="" name="hidden_cma_id" value="">
                                                    <input type="hidden" id="hidden_pre_suit_id" value="" name="hidden_pre_suit_id" value="">
                                                    <input type="hidden" id="hidden_pre_suit_close_sts" value="" name="hidden_pre_suit_close_sts" value="">
                                                    <input type="hidden" id="edit_id" value="" name="edit_id" value="">
                                                    <input type="hidden" id="edit_after_verify_sts" value="0" name="edit_after_verify_sts">
                                                    <input type="hidden" id="add_edit" value="" name="add_edit" value="">
                                                    <input type="hidden" id="next_dt_sts_value" value="" name="next_dt_sts_value" value="1">
                                                    <input type="hidden" id="both_case_sts" value="" name="both_case_sts" value="">
                                                    <input type="hidden" id="hidden_pre_case_claim_amount" value="" name="hidden_pre_case_claim_amount" value="">
                                                    <input type="hidden" id="merge_case_sts" value="" name="merge_case_sts" value="">
                                                    <input type="hidden" id="hidden_pre_case_number" value="" name="hidden_pre_case_number" value="">
                                                    <input name="case_not_running_permission" id="case_not_running_permission" value="" type="hidden">
                                                    <input name="certified_copy_bill_sts" id="certified_copy_bill_sts" value="0" type="hidden">
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
                                                                            <td width="40%" style="font-weight: bold;">Case Name<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="case_name" name="case_name" style="padding-left: 3px" tabindex="1"></div></td>
                                                                        </tr>
                                                                         <tr>
                                                                            <td width="40%" style="font-weight: bold;">New Filing Date<span style="color:red">*</span></td>
                                                                            <td width="60%" ><input type="text" name="filling_date" tabindex="2" onchange="set_expense_date('filling_date','','1')" placeholder="dd/mm/yyyy" style="width:250px;" id="filling_date" value="" ><script type="text/javascript" charset="utf-8">datePicker_without_advance ("filling_date");</script></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Previous Case Number</td>
                                                                            <td width="60%" ><strong><span id="pre_case_number_show"></span></strong></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">New Case Number<span style="color:red">*</span> </td>
                                                                            <td width="60%" >
                                                                                <input name="case_prefix" placeholder="" readonly type="text" class="" style="width:77px;float:left" id="case_prefix" value="" /><input  readonly type="text" tabindex="" class="" style="width:5px;float:left" value="-" /> <input name="case_number" type="text" tabindex="1" class="" style="width:100px;float:left" id="case_number" placeholder="case number" value="" /><input  readonly type="text" tabindex="" class="" style="width:5px;float:left" value="/" /><input name="case_year" placeholder="year" type="text" tabindex="2" onkeypress="return numbersonly(event)" maxlength="4" class="" style="width:40px;float:left" id="case_year" value="" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Case Claim Amount<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><input name="case_claim_amount" type="text" tabindex="4" class="" style="width:250px" id="case_claim_amount" value="" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Previous Date<span style="color:red">*</span></td>
                                                                            <td width="60%" ><input type="text" name="prev_date" tabindex="4" placeholder="dd/mm/yyyy" style="width:250px;" id="prev_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("prev_date");</script></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Case Status On The Previous Date<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="case_sts_prev_dt" name="case_sts_prev_dt" style="padding-left: 3px" tabindex="5"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Next Date<span style="color:red">*</span></td>
                                                                            <td width="60%" >
                                                                                <input type="text" name="next_date" tabindex="5" placeholder="dd/mm/yyyy" style="width:225px;" id="next_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("next_date");</script>
                                                                                <span id="next_sts_text" style="display:none;margin-left:10px"></span>
                                                                                <div name="next_dt_sts" tabindex="40" id="next_dt_sts" style="float:left; margin: 3px 0px 0 0;"></div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Next Case Status<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="case_sts_next_dt" name="case_sts_next_dt" style="padding-left: 3px" tabindex="6"></div></td>
                                                                        </tr>                           
                                                                    </table>
                                                                </td>

                                                                <td width="50%">
                                                                    <table style="width: 100%;">
                                                                        <tr id="both_case_row">
                                                                            <td width="40%" style="font-weight: bold;">Both Case Running</td>
                                                                            <td width="60%" ><div name="both_case" tabindex="7" id="both_case" style="float:left; margin: 3px 0px 0 0;"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Previous Case Merge With New Case</td>
                                                                            <td width="60%" ><div name="merge_case" tabindex="8" id="merge_case" style="float:left; margin: 3px 0px 0 0;"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Filing Plaintiff<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="filling_plaintiff" name="filling_plaintiff" style="padding-left: 3px" tabindex="9"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Present Lawyer Name<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="prest_lawyer_name" name="prest_lawyer_name" style="padding-left: 3px" tabindex="10"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Present Name Of The Court<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="prest_court_name" name="prest_court_name" style="padding-left: 3px" tabindex="11"></div></td>
                                                                        </tr>   
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Remarks</td>
                                                                            <td width="60%" ><textarea name="remarks_next_date" tabindex="12" class="text-input-big" id="remarks_next_date" style="height:40px !important;width:250px"></textarea></td>
                                                                        </tr>                   
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr id="error_message_row" style="display:none">
                                                                <td colspan="2">
                                                                    <div class="error_div" id="error_message_show"><strong>Error message</strong></div>
                                                                </td>
                                                            </tr>
                                                            <tr id="expense_tr" style="display:none">
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
                                                                                    <td width="10%" style="font-weight: bold;text-align:center">Package Select(If available)</td>
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
                                                            <tr id="package_row" style="display:none">
                                                                <td colspan="2">
                                                                    <div style="padding:10px;margin:0 0px;padding-top:20px;">
                                                                        <span style="color:#185891; font-size:20px;font-weight:bold; margin-left:25px;">Package</span>
                                                                        <table border="1" id="gurantor_table" cellspacing="0" cellpadding="5" style="border-collapse: collapse;border-color:#c0c0c0;width:97%;margin:20px" >
                                                                            <thead>
                                                                                <input type="hidden" name="package_sts" id="package_sts" value="0">
                                                                                <input type="hidden" name="package_id" id="package_id" value="0">
                                                                                <input type="hidden" name="package_history_id" id="package_history_id" value="">
                                                                                <tr>
                                                                                    <td width="20%" style="font-weight: bold;text-align:center">Lawyer Name</td>
                                                                                    <td width="10%" style="font-weight: bold;text-align:center">Loan AC</td>
                                                                                    <td width="15%" style="font-weight: bold;text-align:center">Case Number</td>
                                                                                    <td width="10%" style="font-weight: bold;text-align:center">Remaining Package Amount</td>
                                                                                    <td width="10%" style="font-weight: bold;text-align:center">Activities<span style="color:red">*</span></td>
                                                                                    <td width="30%" style="font-weight: bold;text-align:center">Amount<span style="color:red">*</span></td>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="package_body">
                                                                                
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
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
                                        <? if(RECASEFILECONFIRM==1){?>
                                            <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                            href="<?=base_url()?>index.php/legal_file_process/bulk_operation_recase/confirm" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK Confirm" id="sendButton" /></a>
                                        <? }?>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <? if(REASSIGN==1){?>
                                            <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                            href="<?=base_url()?>index.php/legal_file_process/bulk_operation_suit_file/blk_rf_recase" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:80px;"  value="Bulk RF" /></a>
                                         <? }?>&nbsp;&nbsp;
                                         <? if(APPROVEREASSIGN==1){?>
                                            <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                            href="<?=base_url()?>index.php/legal_file_process/bulk_operation_suit_file/blk_rf_approve_recase" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:80px;"  value="Bulk AR" /></a>
                                         <? }?>&nbsp;
                                        <strong>P=</strong>Preview,&nbsp;
                                        <strong>ESF=</strong>Edit File,&nbsp;
                                        <strong>SFC=</strong>File Confirm,&nbsp;
                                        <strong>RF=</strong>Reassing File,&nbsp;
                                        <strong>AR=</strong>Approve Reassign,&nbsp;
                                        <strong>PU=</strong>PUT-UP,&nbsp;
                                        <strong>AP=</strong>Approve PUT-UP,&nbsp;
                                        <strong>U=</strong>Update Next Date&nbsp;
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
                <div id="delete_row" style="text-align:center;margin-bottom:30px;width:100%;">
                    <strong style="vertical-align:top">Delete Reason<span style="color: red;">*</span></strong>
                    <textarea name="comments" id="comments" style="width:370px;"></textarea>
                    </br></br>
                    <input type="button" class="buttondelete" id="delete_button" value="Delete" />
                    <input type="button" class="buttonclose" id="deletecancel" onclick="close()" value="Cancel" />
                    <span id="delete_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                </div>
                <div id="confirm_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                        <input type="button" class="buttonsendtochecker" id="confirm" value="Confirm" />
                        <input type="button" class="buttonclose" id="confirm_cancel" onclick="close()" value="Cancel" />
                        <span id="confirm_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                    </div>
                </div>
                <div id="closeaccount_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                        <input type="button" class="buttondelete" id="closeaccount" value="Close" />
                        <input type="button" class="buttonclose" id="closeaccount_cancel" onclick="close()" value="Cancel" />
                        <span id="closeaccount_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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
                                <td>Next Date Remarks</td>
                                <td><textarea name="next_dt_remarks" class="text-input-big" id="next_dt_remarks" style="height:40px !important;width:250px"></textarea></td>
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

                <div id="reassign_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;">
                        <table style="margin-left: auto;margin-right: auto;margin-top: 0px;">
                            <tr>
                                <td>Legal Region:</td>
                                <td><div id="legal_region" name="legal_region" style="padding-left: 3px" onchange="get_user_data_region_wise()"></div></td>
                            </tr>
                            <tr>
                                <td>Legal User:<span style="color: red;">*</span></td>
                                <td><div style="float:left" id="legal_user" name="legal_user" style="padding-left: 3px"></div></td>
                            </tr>
                            <tr>
                                <td>Legal District:</td>
                                <td><div style="float:left" id="new_legal_district" name="new_legal_district" style="padding-left: 3px"></div></td>
                            </tr>
                            <tr>
                                <td>New Court:</td>
                                <td><div style="float:left" id="court" name="court" style="padding-left: 3px"></div></td>
                            </tr>
                            <tr>
                                <td>Reassign Reason:<span style="color: red;">*</span></td>
                                <td><textarea name="reassign_reason" id="reassign_reason" style="width:370px;"></textarea></td>
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
                <div id="putup_row" style="text-align:center;margin-bottom:30px;width:100%;">
                    <strong style="vertical-align:top">PUT-UP Reason<span style="color: red;">*</span></strong>
                    <textarea name="putup_comments" id="putup_comments" style="width:370px;"></textarea>
                    </br></br>
                    <input type="button" class="buttondelete" id="putup_button" value="PUT-UP" />
                    <input type="button" class="buttonclose" id="putupcancel" onclick="close()" value="Cancel" />
                    <span id="putup_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
                </div>
                <div id="putup_approval_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                        <div id="reject_reason_row_putup" style="display:none">
                            <strong style="vertical-align:top">Reject Reason<span style="color: red;">*</span></strong>
                            <textarea name="reject_reason_putup" id="reject_reason_putup" style="width:370px;"></textarea>
                            </br></br>
                        </div>
                        <input type="button" class="buttondelete" id="reject_putup" value="Reject"/>
                        <input type="button" class="buttonsendtochecker" id="putup_approval" value="Approve" />
                        <input type="button" class="buttonclose" id="putup_approval_cancel" onclick="close()" value="Cancel" />
                        <span id="putup_approval_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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


    <div id="sendToCheckerMessageDialogContent2"  style="display:none;">
     <form method="POST" name="" id=""  style="margin-top:0px;">
        <input type="hidden" name="permission" id="permission" value="">
        <div class="hd"><h2 class="conf" style="margin-top:0px">Are you sure previous case & new case both are wants to running/ আপনি কি নিশ্চিত যে পূর্ববর্তী কেস এবং নতুন কেস উভয়ই চলছে</h2></div>
           <a class="btn-small btn-small-normal" id="sendToCheckerMessageDialogConfirm2" onclick="give_permission()">Confirm</a> 
            <a class="btn-small btn-small-secondary" id="sendToCheckerMessageDialogCancel2" onclick="close_window()"><span>Cancel</span></a> 
            <span id="loadingReturn" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
    </form>
    </div>