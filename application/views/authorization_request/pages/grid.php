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
            var authorization_type = [];
            var req_type = [<? $i=1; foreach($req_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var court = [<? $i=1; foreach($court as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var plaintiff = [<? $i=1; foreach($plaintiff as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'('.$row->pin.')"}'; $i++;}?>];
            jQuery(document).ready(function () {
            jQuery("#req_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Type Of Case", source: req_type, width: 100, height: 25});
            jQuery("#court").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Court", source: court, width: 250, height: 25});
            
            var theme = 'classic';
            jQuery("#pre_representive").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Representive", source: plaintiff, width: 250, height: 25});
            jQuery("#new_representive").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Representive", source: plaintiff, width: 250, height: 25});
            jQuery("#proposed_type").jqxComboBox({theme: theme, width: 100, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
           //var theme = 'energyblue';
           jQuery('#proposed_type,#new_representive,#pre_representive').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
           jQuery("#proposed_type").jqxComboBox('val','Loan');
           change_caption();
            jQuery('#proposed_type').bind('change', function (event) {
                jQuery("#loan_ac").val('');
                jQuery("#hidden_loan_ac").val('');
                change_caption();       
            });
            jQuery("#sendtochecker").click(function () {
				jQuery("#sendtochecker").hide();
				jQuery("#SendTocheckercancel").hide();
				jQuery("#sendtochecker_loading").show();
	    		call_ajax_submit();
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
							{ name: 'sts', type: 'int'},
							{ name: 'cma_id', type: 'int'},
							{ name: 'suit_file_id', type: 'int'},
							{ name: 'status', type: 'string'},
							{ name: 'loan_ac', type: 'string'},
							{ name: 'ac_name', type: 'string'},
							{ name: 'e_by', type: 'string'},
							{ name: 'super_v_id', type: 'int'},
							{ name: 'e_by_id', type: 'int'},
                            { name: 'auth_id', type: 'int'},
							{ name: 'change_type', type: 'int'},
							{ name: 'e_dt', type: 'string'},
                            { name: 'request_type_name', type: 'string'},
							{ name: 'u_by', type: 'string'},
                            { name: 'req_type_name', type: 'string'},
							{ name: 'u_dt', type: 'string'},
                            { name: 'authorization_type_name', type: 'string'}
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
                        url: '<?=base_url()?>index.php/authorization_request/grid',
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
                    var win_h=jQuery( window ).height()-265;
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
								<? if(DELETE==1){?>
								  { text: 'D', datafield: 'delete', editable: false,align:'center', sortable: false, menu: false, width: 35,
			                      	cellsrenderer: function(row) {
			                      		editrow = row;
										var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
										if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 35 || dataRecord.sts == 39 || dataRecord.sts==80 || dataRecord.sts==69)){
											return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'delete\','+editrow+','+dataRecord.change_type+')" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
									 	}
									 	else {
				                      			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
				                      	}
			                      	}
				                  },
								<? }?>
								<? if(EDIT==1){?>
								  { text: 'E', datafield: 'edit', editable: false,align:'center', sortable: false, menu: false, width: 35,
			                      	cellsrenderer: function(row) {
			                      		editrow = row;
										var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
										if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 35 || dataRecord.sts == 39 || dataRecord.sts==69  || dataRecord.sts==80)){
											return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="editt('+dataRecord.id+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
										}
										else
										{
											return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
										}
			                      	}
				                  },
								<? }?>
								<? if(SENDFORAUTHORIZATION==1){?>
								  { text: 'SFA', datafield: 'sendforauthorization', editable: false,align:'center', sortable: false, menu: false, width: 35,
			                      	cellsrenderer: function(row) {
			                      		editrow = row;
										var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
										if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.sts == 35 || dataRecord.sts == 39 || dataRecord.sts==69  || dataRecord.sts==80)){
											return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'sendtochecker\','+editrow+','+dataRecord.change_type+')" ><img align="center" src="<?=base_url()?>images/forward.png"></div>';
									 	}
									 	else if(dataRecord.sts == 66){
				                      			return '<div style=" margin-top: 8px;text-align:center">S</div>';
				                      	}
				                      	else{return '<div style=" margin-top: 8px;text-align:center"></div>';}
			                      	}
				                  },
								<? }?>
								<? if(SUPERVISORAPPROVAL==1){?>
								  { text: 'LMA', datafield: 'approveauthorization', editable: false,align:'center', sortable: false, menu: false, width: 35,
			                      	cellsrenderer: function(row) {
			                      		editrow = row;
										var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
										if(dataRecord.sts == 66 || dataRecord.sts == 79){
											return '<div style="text-align:center;margin-top: 3px; cursor:pointer" onclick="verify('+dataRecord.id+','+editrow+','+dataRecord.event_id+','+dataRecord.authorization_type+')" ><img align="center" src="<?=base_url()?>images/drag.png"></div>';
									 	}
									 	else {
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
                                        if(dataRecord.sts == 67 || dataRecord.sts == 78){
                                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center">&nbsp;<a id="inXLadfc" style="text-align:center;cursor:pointer;" href="<?=base_url()?>index.php/authorization_ho/download/'+dataRecord.auth_id+'/'+dataRecord.id+'" target="_blank" ><img align="center" src="<?=base_url()?>images/word_icon.gif"></a></div>';
                                        }
                                        else {
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
                                { text: 'Type', datafield: 'authorization_type_name',editable: false, width: '18%', align:'left',cellsalign:'left'},
							  	{ text: 'Status', datafield: 'status',editable: false, width: '20%', align:'left',cellsalign:'left'},
                                { text: 'Req. Type', datafield: 'req_type_name',editable: false, width: '15%', align:'left',cellsalign:'left'},
							  	{ text: 'Loan A/C or Card No.', datafield: 'loan_ac', editable: false,align:'center',cellsalign:'center', sortable: true, menu: true, width: '14%',
			                      	cellsrenderer: function(row) {
			                      		editrow = row;
			                      		var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
										return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\')"><span>'+dataRecord.loan_ac+'</span></a></div>';
				                      	
			                      	}
				                  },
							  	{ text: 'A/C Name or Name on Card', datafield: 'ac_name',editable: false, width: '15%', align:'left',cellsalign:'left'},
								{ text: 'Entry By', datafield: 'e_by',editable: false, width: '17%' , align:'left',cellsalign:'left'},
								{ text: 'Entry Date Time', datafield: 'e_dt',editable: false, width: '17%' , align:'center',cellsalign:'center'},
								{ text: 'Update By', datafield: 'u_by',editable: false, width: '17%' , align:'left',cellsalign:'left'},
								{ text: 'Update Date and Time', datafield: 'u_dt',editable: false, width: '17%' , align:'center',cellsalign:'center'},
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
               jQuery('#authorization_request_form').jqxValidator('hide');
               reload();
            });
            jQuery('#jqxTabs').jqxTabs('select', 0);
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>
            //End check box update 
            jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#sendnotificationcancel,#authorization_cancel,#confirm_cancel,#reassigncancel,#closeaccount_cancel,#deletecancel") });
            jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
            jQuery('#details').on('close', function (event) {
                jQuery('#action_form').jqxValidator('hide');
            });

            jQuery("#authorization_request_button").click(function () 
            {
                var item = jQuery("#authorization_type").jqxComboBox('getSelectedItem');
                if(item!=null)
                {
                    if(item.value==6 || item.value==12)
                    {
                        if ((jQuery("#hidden_y_flag_approval_file_select").val()=='0' && jQuery('#flag_approval_select_add_edit').val()=='add') || (jQuery("#hidden_y_flag_approval_file_select").val()=='0' && jQuery("#file_delete_value_y_flag_approval_file").val()=='1' && jQuery('#flag_approval_select_add_edit').val()=='edit')) 
                        {
                            alert('Please Upload Approval File');
                            return false;
                        }
                    }
                }
                var validationResult = function (isValid) {
                    if (isValid) {
                        jQuery("#authorization_request_button").hide();
                        jQuery("#send_loading").show();
                        save_data();
                    }
                    else{return;}
                }
                jQuery('#authorization_request_form').jqxValidator('validate', validationResult);
            });
            jQuery('#authorization_request_form').jqxValidator({
	            rules: [
	                    { input: '#authorization_type', message: 'required!', action: 'blur,change', rule: function (input) {                    
	                        if(input.val() != '')
	                        {
	                            var item = jQuery("#authorization_type").jqxComboBox('getSelectedItem');
	                            if(item != null){jQuery("input[name='authorization_type']").val(item.value);}
	                            return true;                
	                        }
	                        else
	                        {
	                            jQuery("#authorization_type input").focus();
	                            return false;
	                        }
	                    }  
	                    },
                        { input: '#pre_representive', message: 'required!', action: 'blur,change', rule: function (input) {                    
                            if(input.val() != '')
                            {
                                var item = jQuery("#pre_representive").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='pre_representive']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#pre_representive input").focus();
                                return false;
                            }
                        }  
                        },
                        { input: '#court', message: 'required!', action: 'blur,change', rule: function (input) {                    
                            if(input.val() != '')
                            {
                                var item = jQuery("#court").jqxComboBox('getSelectedItem');
                                if(item != null){jQuery("input[name='court']").val(item.value);}
                                return true;                
                            }
                            else
                            {
                                jQuery("#court input").focus();
                                return false;
                            }
                        }  
                        },
	                    { input: '#new_representive', message: 'required!', action: 'blur,change', rule: function (input) {                    
	                       var item = jQuery("#authorization_type").jqxComboBox('getSelectedItem'); 
	                        if(item!=null)
	                        {
	                        	if(input.val() == '' && (item.value==4 || item.value==9))
		                        {
		                            jQuery("#new_representive input").focus();
		                            return false;       
		                        }
		                        else
		                        {
		                        	var item = jQuery("#new_representive").jqxComboBox('getSelectedItem');
		                            if(item != null){jQuery("input[name='new_representive']").val(item.value);}
		                            return true; 
		                            
		                        }
	                        }
	                        else{
	                        	return true;
	                        }
	                    }  
	                    },
                        { input: '#approver_name', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                            var item = jQuery("#authorization_type").jqxComboBox('getSelectedItem');
                            if(item!=null && (item.value==6|| item.value==12))
                            {
                                if(jQuery("#approver_name").val()=='' && jQuery("#hidden_y_flag").val()!='Y')
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
                        { input: '#approver_pin', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                            var item = jQuery("#authorization_type").jqxComboBox('getSelectedItem');
                            if(item!=null && (item.value==6|| item.value==12))
                            {
                                if(jQuery("#approver_pin").val()=='' && jQuery("#hidden_y_flag").val()!='Y')
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
                        { input: '#remarks', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                            var item = jQuery("#authorization_type").jqxComboBox('getSelectedItem');
                            if(item!=null && (item.value==6|| item.value==12))
                            {
                                if(jQuery("#remarks").val()=='' && jQuery("#hidden_y_flag").val()!='Y')
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
                        { input: '#approver_pin', message: 'Numbers only', action: 'keyup, blur, change', rule: function (input, commit)
                         {
                            if(input.val() != '')
                            {
                                if(!checknumber_only('approver_pin'))
                                {
                                    jQuery("#approver_pin").focus();
                                    return false;

                                }
                            }
                            return true;

                        } },
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
                        { input: '#borrower_name', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                            if(jQuery("#borrower_name").val()=='')
                            {
                                return false;
                            }
                            else
                            {
                                return true;
                            }
                        }
                        },
                        { input: '#proprietor_address', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                            if(jQuery("#proprietor_address").val()=='')
                            {
                                return false;
                            }
                            else
                            {
                                return true;
                            }
                        }
                        },
                        { input: '#proprietor_address', message: 'more than 250 characters', action: 'keyup, blur, change', rule: function (input, commit)
                         {
                            if(input.val() != '')
                            {
                                if(input.val().length>250)
                                {
                                    jQuery("#proprietor_address").focus();
                                    return false;

                                }
                            }
                            return true;

                        } },
	                    
	                ]
	        });
        });
	function save_data()
	{
		var postData = jQuery('#authorization_request_form').serialize();
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: '<?=base_url()?>index.php/authorization_request/add_edit',
				data : postData,
				datatype: "json",
				success: function(response){
                  ///console.log(response);
					var json = jQuery.parseJSON(response);
					jQuery('.txt_csrfname').val(json.csrf_token);
						if(json.Message!='OK')
						{	
							jQuery("#authorization_request_button").show();
							jQuery("#send_loading").hide();		
							alert(json.Message);					
							return false;
						}else{
						jQuery("#authorization_request_button").show();
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
	function verify(id,indx,event_id,type)
	{
		jQuery("#jqxgrid").jqxGrid('clearselection');
		EOL.messageBoard.open('<?=base_url()?>index.php/authorization_request/formverify/'+id+'/'+indx+'/'+event_id+'/'+type, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
		return false;
	}
	function details(id,operation,index,change_type)
	{
		jQuery('#deleteEventId').val(id);
		jQuery('#type').val(operation);
		jQuery('#change_type').val(change_type);
		if (operation=='details') 
		{
			jQuery("#header_title").html('Request Details');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').show();
		}
		else if (operation=='delete') 
		{
			jQuery("#header_title").html('Delete Request');
			jQuery('#sendtochecker_row').hide();
			jQuery('#delete_row').show();
			jQuery('#close_btn_row').hide();
			jQuery('#comments').val('');
		}
		else if (operation=='sendtochecker') 
		{
			jQuery("#header_title").html('Send For Authorization Request');
			jQuery('#sendtochecker_row').show();
			jQuery('#delete_row').hide();
			jQuery('#close_btn_row').hide();
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
			url: "<?=base_url()?>authorization_request/details",
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
	function call_ajax_submit()
	{
		var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
		var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
		var postData = jQuery('#action_form').serialize()+"&"+csrfName+"="+csrfHash;
		jQuery.ajax({
				type: "POST",
				cache: false,
				url: '<?=base_url()?>index.php/authorization_request/delete_action/',
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
    function editt(id){
        var val=id;
        jQuery('#next_button').hide();
        jQuery('#next_loading').show();
        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?=base_url()?>authorization_request/get_edit_info",
            data : {[csrfName]: csrfHash,id:val},
            datatype: "json",
            async:false,
            success: function(response){
               
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if(json.Message=='ok'){
                    jQuery('#jqxTabs').jqxTabs('select', 0);
                    jQuery('#add_edit').val('edit');
                    jQuery('#edit_id').val(json.result.id);
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    jQuery('#search_area').hide();
                    jQuery('#suit_form_div').show();
                    var form_html = '';
                    jQuery('#hidden_suit_id').val(json.suit_info.id);
                    jQuery('#type_of_case_show').html(json.suit_info.case_type);
                    jQuery('#ent_name_show').html(json.suit_info.ac_name);
                    //jQuery('#present_plaintiff_name').html(json.suit_info.case_deal_officer);
                    
                    jQuery('#ac_number_show').html(json.suit_info.loan_ac);
                    jQuery('#ac_name_show').html(json.suit_info.ac_name);
                    jQuery('#case_number_show').html(json.suit_info.case_number);
                    jQuery('#court_name_show').html(json.suit_info.prest_court_name);
                    jQuery.each(json['authorization_type'],function(key,obj){
                        authorization_type.push({ value: obj.id, label: obj.name });
                    });
                    
                    //jQuery("#case_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Name", source: case_name, width: 250, height: 25});
                    jQuery("#authorization_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Authorization Type", source: authorization_type, width: 250, height: 25});
                    jQuery('#authorization_type').focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
                    });
                    jQuery('#authorization_type').jqxComboBox('val', json.result.authorization_type);
                    jQuery('#court').jqxComboBox('val', json.result.prev_court);
                    jQuery("#proprietor_address").val(json.result.proprietor_address);
                    jQuery("#borrower_name").val(json.result.borrower_name);
                    jQuery('#pre_representive').jqxComboBox('val', json.result.prev_item);
                    if(json.result.new_item!='' && json.result.new_item!=null && json.result.new_item!=0)
                    {
                    	jQuery('#new_representive').jqxComboBox('val', json.result.new_item);
                    }
                    jQuery('#approver_name').val(json.result.approver_name);
                    jQuery('#approver_pin').val(json.result.approver_pin);
                    if(json.result.y_flag=='' || json.result.y_flag==null)
                    {
                        jQuery('#hidden_y_flag').val('');
                        jQuery('#y_flag_show').html('');
                        jQuery('#y_flag_row').hide();
                    }
                    else
                    {

                        jQuery('#hidden_y_flag').val(json.result.y_flag);
                        jQuery('#y_flag_show').html(json.result.y_flag);
                        jQuery('#y_flag_row').show();
                        if(json.result.y_flag!='Y')
                        {
                            jQuery('#attachment_row').show();
                            jQuery('#approver_row_name').show();
                            jQuery('#approver_row_pin').show();
                            var y_flag_approval_file = json.result.y_flag_approval_file;
                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'y_flag_approval_file\')"/>';
                            html+='<input type="hidden" id="hidden_y_flag_approval_file_select" name="hidden_y_flag_approval_file_select" value="0">';
                            if(y_flag_approval_file!='' && y_flag_approval_file!=null)
                            {
                                html +='<span id="hidden_y_flag_approval_file"><img id="file_preview_y_flag_approval_file" onclick="popup(\'<?=base_url()?>cma_file/y_flag_approval_file/'+y_flag_approval_file+'\')" style=" cursor:pointer;text-align:center" height="18" src="<?=base_url()?>old_assets/images/print-preview.png"></span>';
                                html +='<input type="hidden" id="hidden_y_flag_approval_file_value" name="hidden_y_flag_approval_file_value" value="'+y_flag_approval_file+'">';
                                html +='<img id="file_delete_y_flag_approval_file" onclick="file_delete(\'y_flag_approval_file\')" src="<?=base_url()?>images/delete-New.png" style=" cursor:pointer;"  alt="Delete" title="Delete">';
                                html +='<input type="hidden" id="file_delete_value_y_flag_approval_file" name="file_delete_value_y_flag_approval_file" value="0">';
                                html+='<span id="hidden_y_flag_approval_file"></span><input type="hidden" id="flag_approval_select_add_edit" name="flag_approval_select_add_edit" value="edit">';
                            }
                            else
                            {
                                html+='<span id="hidden_y_flag_approval_file"></span><input type="hidden" id="flag_approval_select_add_edit" name="flag_approval_select_add_edit" value="add">';
                            }
                            jQuery('#y_flag_approval_file').html(html);
                        }
                        else
                        {
                            jQuery('#attachment_row').hide();
                            jQuery('#approver_row_name').hide();
                            jQuery('#approver_row_pin').hide();
                        }
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
            url: "<?=base_url()?>authorization_request/get_filing_info",
            data : {[csrfName]: csrfHash,id:val},
            datatype: "json",
            async:false,
            success: function(response){
               
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if(json.Message=='ok'){
                    jQuery('#add_edit').val('add');
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    jQuery('#search_area').hide();
                    jQuery('#suit_form_div').show();
                    var form_html = '';
                    jQuery('#hidden_suit_id').val(json.suit_info.id);
                    jQuery('#type_of_case_show').html(json.suit_info.case_type);
                    jQuery('#ent_name_show').html(json.suit_info.ac_name);
                    jQuery('#pro_name_show').html(json.suit_info.brrower_name);
                    jQuery('#ac_number_show').html(json.suit_info.loan_ac);
                    jQuery('#ac_name_show').html(json.suit_info.ac_name);
                    jQuery('#case_number_show').html(json.suit_info.case_number);
                    //jQuery('#court_name_show').html(json.suit_info.prest_court_name);
                    jQuery('#court').jqxComboBox('val', json.suit_info.present_court_id);
                    jQuery('#pre_representive').jqxComboBox('val', json.suit_info.case_deal_officer_id);
                    if(json.suit_info.current_address!=null)
                    {
                        jQuery("#proprietor_address").val(json.suit_info.current_address);
                        jQuery("#borrower_name").val(json.suit_info.brrower_name);
                    }
                    else
                    {
                        jQuery("#proprietor_address").val(json.current_address);
                        jQuery("#borrower_name").val(json.borrower_name);
                    }
                    jQuery.each(json['authorization_type'],function(key,obj){
                        authorization_type.push({ value: obj.id, label: obj.name });
                    });
                    
                    //jQuery("#case_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Case Name", source: case_name, width: 250, height: 25});
                    jQuery("#authorization_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Authorization Type", source: authorization_type, width: 250, height: 25});
                    jQuery('#authorization_type').focusout(function() {
                        commbobox_check(jQuery(this).attr('id'));
                    });
                    
                }else{
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    alert("No Data Found");
                    jQuery('#add_edit').val('');
                }
            }
        });

    }
    function clear_form() {
        jQuery("#court").jqxComboBox('clearSelection');
        jQuery("input[name='court']").val('');
        jQuery("#authorization_type").jqxComboBox('clearSelection');
        jQuery("#authorization_type").val('');
        jQuery("#proprietor_address").val('');
        jQuery("#borrower_name").val('');
        jQuery("#new_representive").jqxComboBox('clearSelection');
        jQuery("#new_representive").val('');
        jQuery("#pre_representive").jqxComboBox('clearSelection');
        jQuery("#pre_representive").val('');
        authorization_type = [];
        jQuery('#hidden_suit_id').val('');
        jQuery('#type_of_case_show').html('');
        jQuery('#ent_name_show').html('');
        jQuery('#ac_number_show').html('');
        jQuery('#ac_name_show').html('');
        jQuery('#case_number_show').html('');
        //jQuery('#court_name_show').html('');
        jQuery('#remarks').val('');
    }
    function reload()
    {
        jQuery('#attachment_row').hide();
        jQuery('#approver_row_name').hide();
        jQuery('#approver_row_pin').hide();
        jQuery('#approver_name').val('');
        jQuery('#approver_pin').val('');
        jQuery('#suit_form_div').hide();
        jQuery('#search_area').show();
        jQuery('#searchTable').html('');
        jQuery("#edit_id").val('');
        jQuery('#hidden_y_flag').val('');
        jQuery('#y_flag_show').html('');
        jQuery('#y_flag_row').hide();
        clear_form();
        jQuery('#add_edit').val('');
        jQuery('#authorization_request_form').jqxValidator('hide');
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
    function get_y_flag()
    {
        var item = jQuery("#authorization_type").jqxComboBox('getSelectedItem');
        if(item!=null && (item.value==6 || item.value==12) && jQuery('#add_edit').val()=='add')
        {
            var suit_id = jQuery("#hidden_suit_id").val();
            var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
            var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
            jQuery.ajax({
                type: "POST",
                cache: false,
                async:false,
                url: "<?=base_url()?>index.php/authorization_request/get_close_flag/",
                data : {[csrfName]: csrfHash,suit_id:suit_id},
                datatype: "json",
                beforeSend: function(){
                    jQuery("#loading-overlay").show();
                },
                success: function(response){
                    jQuery("#loading-overlay").hide();
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                    if(json.close_flag=='')
                    {
                        alert('Unable to get Y flag please try again!!');
                        jQuery('#hidden_y_flag').val('');
                        jQuery('#y_flag_show').html('');
                        jQuery('#y_flag_row').hide();
                        reload();
                    }
                    else
                    {
                        var acc_close_flag = json['close_flag'][0];
                        jQuery('#hidden_y_flag').val(acc_close_flag);
                        jQuery('#y_flag_show').html(acc_close_flag);
                        jQuery('#y_flag_row').show();
                        if(acc_close_flag!='Y')
                        {
                            jQuery('#attachment_row').show();
                            jQuery('#approver_row_name').show();
                            jQuery('#approver_row_pin').show();
                            var html = '';
                            html+='<img style="cursor:pointer" src="<?=base_url()?>/images/upload.png" alt="upload" title="Upload" onclick="CustomerPickList(\'cma\',\'y_flag_approval_file\')"/>';
                            html+='<input type="hidden" id="hidden_y_flag_approval_file_select" name="hidden_y_flag_approval_file_select" value="0">';
                            html+='<span id="hidden_y_flag_approval_file"></span><input type="hidden" id="flag_approval_select_add_edit" name="flag_approval_select_add_edit" value="add">';
                            jQuery('#y_flag_approval_file').html(html);
                        }
                        else
                        {
                            jQuery('#attachment_row').hide();
                            jQuery('#approver_row_name').hide();
                            jQuery('#approver_row_pin').hide();
                        }
                    }

                }
            });
        }
        else
        {
            jQuery('#hidden_y_flag').val('');
            jQuery('#y_flag_show').html('');
            jQuery('#y_flag_row').hide();
            jQuery('#attachment_row').hide();
            jQuery('#approver_row_name').hide();
            jQuery('#approver_row_pin').hide();
        }
        if(item!=null && (item.value==4 || item.value==9))
        {
            jQuery("#new_representive_row").show();
        }
        else
        {
            jQuery("#new_representive").jqxComboBox('clearSelection');
            jQuery("input[name='new_representive']").val('');
            jQuery("#new_representive_row").hide();
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
                url: "<?=base_url()?>index.php/authorization_request/search_suit/",
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
            url: "<?=base_url()?>authorization_request/r_history",
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
                                                            <td  style="text-align:right;width:5%">
                                                                <input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="searchsuit()" style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:100px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" />
                                                            </td>
                                                            <td  style="text-align:right;width:5%">
                                                                <? if(ADD==1 && EDIT==1){?>
                                                                    <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                                                        href="<?=base_url()?>index.php/authorization_request/bulk_request" title=""><input type='button' class="buttonStyle" id='bulk_request' name='bulk_request' value='Bulk Request' style="background-color:#fff;color:#000;border-radius: 20px !important;height:30px;width:115px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" /></a>
                                                                <? } ?>
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
                                                 <div id="loading-overlay">
                                                    <div class="loading-icon"></div>
                                                </div>
                                                <form method="POST" name="authorization_request_form" id="authorization_request_form"  style="margin:0px;">
                                                    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                    <input type="hidden" id="hidden_suit_id" value="" name="hidden_suit_id" value="">
                                                    <input type="hidden" id="edit_id" value="" name="edit_id" value="">
                                                    <input type="hidden" id="add_edit" value="" name="add_edit" value="">
                                                    <input type="hidden" id="hidden_y_flag" value="" name="hidden_y_flag" value="">
                                                    <table style="width:100%;margin-top:20px" id="tab1Table" >
                                                        <tbody>
                                                            <tr>
                                                                <td width="50%">
                                                                    <table style="width: 100%;">
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Type of Case</td>
                                                                            <td width="60%" ><strong><span id="type_of_case_show"></span></strong></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Type of Authorization</td>
                                                                            <td width="60%" ><div id="authorization_type" name="authorization_type" style="padding-left: 3px" tabindex="5" onchange="get_y_flag()"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Enterprise Name<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><strong><span id="ent_name_show"></span></strong></td>
                                                                        </tr>
                                                                        <tr style="display:none" id="y_flag_row">
                                                                            <td width="40%" style="font-weight: bold;">Account Close Flag</td>
                                                                            <td width="60%" ><strong><span id="y_flag_show"></span></strong></td>
                                                                        </tr>
                                                                        <tr style="display:none" id="attachment_row">
                                                                            <td width="40%" style="font-weight: bold;">Approval Attachement<span style="color:red">*</span></td>
                                                                            <td width="60%" ><span id="y_flag_approval_file"></span></td>
                                                                        </tr>
                                                                        <tr style="display:none" id="approver_row_name">
                                                                            <td width="40%" style="font-weight: bold;">Approver Name<span style="color:red">*</span></td>
                                                                            <td width="60%" ><input name="approver_name" type="text" class="" tabindex="5" style="width:250px" id="approver_name" value="" /></td>
                                                                        </tr>
                                                                        <tr style="display:none" id="approver_row_pin">
                                                                            <td width="40%" style="font-weight: bold;">Approver PIN<span style="color:red">*</span></td>
                                                                            <td width="60%" ><input name="approver_pin" type="text" class="" tabindex="5" style="width:250px" id="approver_pin" value="" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Proprietor Name<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><input name="borrower_name" type="text" class="" tabindex="5" style="width:250px" id="borrower_name" value="" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Present Representive<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="pre_representive" name="pre_representive" style="padding-left: 3px" tabindex="10"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Proprietor Address<span style="color:red">*</span> </td>
                                                                            <td width="60%" >
                                                                                <textarea name="proprietor_address" tabindex="12" class="text-input-big" id="proprietor_address" style="height:40px !important;width:250px"></textarea>
                                                                            </td>
                                                                        </tr>                      
                                                                    </table>
                                                                </td>

                                                                <td width="50%">
                                                                    <table style="width: 100%;">
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Account Number</td>
                                                                            <td width="60%" ><strong><span id="ac_number_show"></span></strong></td>
                                                                        </tr> 
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Account Name</td>
                                                                            <td width="60%" ><strong><span id="ac_name_show"></span></strong></td>
                                                                        </tr> 
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Case Number</td>
                                                                            <td width="60%" ><strong><span id="case_number_show"></span></strong></td>
                                                                        </tr> 
                                                                        <tr id="new_representive_row" style="display:none">
                                                                            <td width="40%" style="font-weight: bold;">New Representive</td>
                                                                            <td width="60%" ><div id="new_representive" name="new_representive" style="padding-left: 3px" tabindex="10"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Name of Court<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="court" name="court" style="padding-left: 3px" tabindex="10"></div></td>
                                                                        </tr>  
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Remarks</td>
                                                                            <td width="60%" ><textarea name="remarks" tabindex="12" class="text-input-big" id="remarks" style="height:40px !important;width:250px"></textarea></td>
                                                                        </tr>                  
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="text-align: center;">
                                                                    <br/>
                                                                    <input type="button" value="Save" class="buttonStyle" style="background-color:#185891;color:#fff;border-radius: 20px !important;height:50px;width:200px;font-family: sans-serif;font-size: 16px;" id="authorization_request_button" /> <span id="send_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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
                                    <div style="border:none;" id="jqxgrid"></div>
                                    <div style="float:left;padding-top: 5px;">
                                    <div style="font-family: Calibri; margin: 0 0 -10px 0;font-size:14px;color:#0000cc">
                                       <? if(SENDFORAUTHORIZATION==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                        href="<?=base_url()?>index.php/authorization_request/bulk_operation/sfa" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK SFA" id="sendButton" /></a>
                                       <? } ?>&nbsp;&nbsp;
                                       <? if(SUPERVISORAPPROVAL==1){?>
                                        <a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
                                        href="<?=base_url()?>index.php/authorization_request/bulk_operation/apv" title=""><input type="button" class="buttonStyle" style="background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:30px;width:100px;"  value="BULK APV" id="sendButton" /></a>
                                       <? } ?>&nbsp;&nbsp;

                                       
                                       <strong>D = </strong>Delete Request,&nbsp;
                                        <strong>E = </strong>Edit Request,&nbsp;
                                        <strong>AM = </strong>Authorization Memo,&nbsp;
                                        <strong>P = </strong>Preview,&nbsp;
                                        <strong>SFA = </strong>Send For Authorization,&nbsp;
                                        <strong>LMA = </strong>Legal Menager Authorization&nbsp;
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
    		<input name="change_type" id="change_type" value="" type="hidden">
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