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
    #new:hover{
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
    <?php 
         $case_sts = $this->User_model->get_parameter_data('ref_case_sts','name','data_status = 1');
         $retail_branch = $this->User_model->get_parameter_data('ref_retail_branch','name','data_status = 1');
         $branch_sol=$this->User_model->get_parameter_data('ref_branch_sol','name','data_status = 1');
         $case_type=$this->User_model->get_parameter_data('ref_case_type','name','data_status = 1');
         $district=$this->User_model->get_parameter_data('ref_legal_district','name','data_status = 1');
     ?>
    <script type="text/javascript">
            var theme = getDemoTheme();
            var proposed_type = ["Loan", "Card"];
            var req_type = [<? $i=1; foreach($req_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var case_type = [<? $i=1; foreach($case_type as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var district = [<? $i=1; foreach($district as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var case_name = [<? $i=1; foreach($suit_name as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var retail_branch = [<? $i=1; foreach($retail_branch as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            var court = [];
            var lawyer = [];
            var case_sts = [<? $i=1; foreach($case_sts as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->id.'", label:"'.$row->name.'"}'; $i++;}?>];
            
            var plaintiff = [];
            var branch_sol = [<? $i=1; foreach($branch_sol as $row){ if($i!=1){echo ',';} echo '{value:"'.$row->code.'", label:"'.$row->name.' ('.$row->code.')"}'; $i++;}?>];
            jQuery(document).ready(function () {
            jQuery("#req_type_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Type Of Case", source: case_type, width: 150, height: 30});
            jQuery("#proposed_type_grid").jqxComboBox({theme: theme, width: 100, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
            //jQuery("#req_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Type Of Case", source: req_type, width: 150, height: 25});
            jQuery("#next_date_sts_grid").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight:100, promptText: "Case Status", source: case_sts, width: 250, height: 25});
            jQuery("#req_type").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Type Of Case", source: req_type, width: 150, height: 25});
            jQuery("#case_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Case Name", source: case_name, width: 250, height: 25});
            jQuery("#req_type_f").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Type Of Case", source: case_type, width: 250, height: 25});
            jQuery("#retail_branch").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Retail Branch", source: retail_branch, width: 250, height: 25});
            jQuery("#prest_court_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Court Name", source: court, width: 250, height: 25});
            jQuery("#prest_lawyer_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select Lawyer", source: lawyer, width: 250, height: 25});
            jQuery("#district").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Select District", source: district, width: 250, height: 25});
            jQuery("#branch_sol").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Branch SOL", source: branch_sol, width: 250, height: 25});
            jQuery("#filling_plaintiff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Filling Plaintiff", source: plaintiff, width: 250, height: 25});
            jQuery("#case_sts").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false,dropDownHeight: 100, promptText: "Case Status", source: case_sts, width: 250, height: 25});
            var theme = 'classic';
            jQuery("#proposed_type").jqxComboBox({theme: theme, width: 150, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
            jQuery("#proposed_type_f").jqxComboBox({theme: theme, width: 250, autoOpen: false, autoDropDownHeight: false, promptText: "Proposed Type", source: proposed_type, height: 25});
           //var theme = 'energyblue';
           jQuery("#next_dt_sts").jqxCheckBox({width: 22, theme: theme ,checked:true });
           jQuery('#filling_plaintiff,#next_date_sts_grid,#proposed_type_grid,#req_type_grid,#case_sts,#district,#proposed_type_f,#proposed_type,#branch_sol,#proposed_type,#req_type,#req_type_f,#retail_branch,#prest_court_name,#prest_lawyer_name,#case_name').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
           let date =  new Date().getFullYear();
            jQuery('#case_year').val(date);
           jQuery("#proposed_type").jqxComboBox('val','Loan');
           
           change_caption();
           change_caption2();
            jQuery('#proposed_type').bind('change', function (event) {
                jQuery("#loan_ac").val('');
                jQuery("#hidden_loan_ac").val('');
                change_caption();       
            });
            jQuery("#proposed_type_grid").jqxComboBox('val','Loan');
            change_caption_grid();
            jQuery('#proposed_type_grid').bind('change', function (event) {
                jQuery("#loan_ac_grid").val('');
                jQuery("#hidden_loan_ac_grid").val('');
                change_caption_grid();       
            });
            jQuery('#proposed_type_f').bind('change', function (event) {
                jQuery("#loan_ac_f").val('');
                jQuery("#hidden_loan_ac_f").val('');
                change_caption2();       
            });
            jQuery("#proposed_type_f").jqxComboBox('val','Loan');
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
                jQuery('#suit_file_form').jqxValidator('validate', validationResult);
            });
            rules3= [
                { input: '#req_type_f', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#req_type_f").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='req_type_f']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#req_type_f input").focus();
                        return false;
                    }
                }  
                },
                { input: '#district', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#district").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='district']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#district input").focus();
                        return false;
                    }
                }  
                },
                { input: '#defendant_name', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#defendant_name").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#complaint_name', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#complaint_name").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#case_number_f', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#case_number_f").val()=='')
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                },
                { input: '#case_number_f', message: 'more than 50 characters', action: 'keyup, blur, change', rule: function (input, commit)
                 {
                    if(input.val() != '')
                    {
                        if(input.val().length>50)
                        {
                            jQuery("#case_number_f").focus();
                            return false;

                        }
                    }
                    return true;

                } },
                { input: '#case_year', message: 'required!', action: 'keyup, blur, change', rule: function(input,commit){
                    if(jQuery("#case_year").val()=='')
                    {
                        return false;
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
                { input: '#prest_court_name', message: 'required!', action: 'blur,change', rule: function (input) {                 
                    if(input.val() != '')
                    {
                        var item = jQuery("#prest_court_name").jqxComboBox('getSelectedItem');
                        if(item != null){jQuery("input[name='prest_court_name']").val(item.value);}
                        return true;                
                    }
                    else
                    {
                        jQuery("#prest_court_name input").focus();
                        return false;
                    }
                }  
                },
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
            ];
            rules6=[
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
            rules5=[
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
            jQuery("#send").click(function () {
                jQuery("#send").hide();
                jQuery("#confirm_cancel").hide();
                jQuery("#confirm_loading").show();
                call_ajax_submit();
             });
            jQuery("#updatenextdate").click(function () {
                jQuery('#action_form').jqxValidator({
                        rules: rules6, theme: theme
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
                        rules: rules5, theme: theme
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
           
            var initGrid = function () {
                var source =
                {
                   datatype: "json",
                   datafields: [
                             { name: 'id', type: 'int'},
                             { name: 'suit_sts', type: 'int'},
                             { name: 'e_by_id', type: 'int'},
                            { name: 'checker_id', type: 'int'},
                            { name: 'status', type: 'string'},
                            { name: 'loan_ac', type: 'string'},
                            { name: 'ac_name', type: 'string'},
                            { name: 'e_by', type: 'string'},
                            { name: 'e_dt', type: 'string'},
                            { name: 'case_number', type: 'string'},
                            { name: 'district', type: 'string'},
                            { name: 'req_type', type: 'string'},
                            { name: 'case_section', type: 'string'},
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
                        url: '<?=base_url()?>index.php/case_against_bank/grid',
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
                    var win_h=jQuery( window ).height()-300;
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
                                { text: 'suit_sts', datafield: 'suit_sts',hidden:true },
                                <? if(DELETE==1){?>
                                { text: 'D', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: '2%',
                                cellsrenderer: function (row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.suit_sts == 39 || dataRecord.suit_sts==35 || dataRecord.suit_sts==82)){
                                        return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'delete\');" ><img align="center" src="<?=base_url()?>images/delete-New.png"></div>';
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
                                        if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.suit_sts == 39 || dataRecord.suit_sts==35 || dataRecord.suit_sts==82)){
                                            return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit_suit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                        }
                                        else if(check_group_javascript(11) || check_group_javascript(10))
                                        {
                                           return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="edit_suit('+dataRecord.id+','+editrow+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                        }
                                        else
                                        {
                                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                        }
                                    }
                                  },
                              <?php } ?>
                              <? if(SENDTOCHECKER==1){?>
                              { text: 'STC', datafield: 'sendtochecker', editable: false,align:'center', sortable: false, menu: false, width: 35,
                                cellsrenderer: function(row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    if((<?=$this->session->userdata['ast_user']['user_id']?>==dataRecord.e_by_id || <?=$this->session->userdata['ast_user']['user_system_admin_sts']?>=='2') && (dataRecord.suit_sts == 39 || dataRecord.suit_sts==35 || dataRecord.suit_sts==82)){
                                        return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'sendtochecker\');" ><img align="center" src="<?=base_url()?>images/forward1.png"></div>';
                                    }
                                    else {
                                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                    }
                                }
                              },
                              <? }?>
                              <? if(VERIFY==1){?>
                              { text: 'V', datafield: 'verify', editable: false,align:'center', sortable: false, menu: false, width: 35,
                                cellsrenderer: function(row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    if(dataRecord.suit_sts == 37){
                                        return '<div style="margin-top: 5px;text-align:center; cursor:pointer" onclick="verify('+dataRecord.id+')" ><img align="center" src="<?=base_url()?>images/activate1.png"></div>';
                                    }
                                    else {
                                            return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
                                    }
                                    
                                }
                              },
                              <? }?>
                              <? if(UPDATENEXTDATE==1){?>
                                  { text: 'U', datafield: 'updatenextdate', editable: false,align:'center', sortable: false, menu: false, width: 35,
                                    cellsrenderer: function(row) {
                                        editrow = row;
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                        if(dataRecord.suit_sts == 51){
                                         return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'updatenextdate\','+editrow+','+dataRecord.cma_id+')" ><img align="center" src="<?=base_url()?>images/edit-new.png"></div>';
                                        }
                                    }
                                  },
                                <? }?>
                                { text: 'P', menu: false, datafield: 'Preview', align:'center', editable: false, sortable: false, width: '2%',
                                    cellsrenderer: function (row) {
                                    editrow = row;
                                    var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                    return '<div style="text-align:center;margin-top: 5px;  cursor:pointer" onclick="details('+dataRecord.id+',\'details\')" ><img align="center" src="<?=base_url()?>images/view_detail.png"></div>';

                                      }
                                },
                                { text: 'Status', datafield: 'status',editable: false, width: '17%', align:'left',cellsalign:'left'},
                                { text: 'Requisition', datafield: 'req_type',editable: false, width: '8%', align:'left',cellsalign:'left'},
                                { text: 'District', datafield: 'district',editable: false, width: '15%', align:'left',cellsalign:'left'},
                                { text: 'Loan A/C or Card No.', datafield: 'loan_ac', editable: false,align:'center',cellsalign:'center', sortable: true, menu: true, width: '13%',
                                    cellsrenderer: function(row) {
                                        editrow = row;
                                        var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);
                                        return '<div style=" margin-top: 7px;margin-left: 3px;text-align:left"><a href="#" style="color:black" onclick="return r_history('+dataRecord.id+',\'life_cycle\')"><span>'+dataRecord.loan_ac+'</span></a></div>';
                                        
                                    }
                                  },
                                { text: 'A/C Name or Name on Card', datafield: 'ac_name',editable: false, width: '15%', align:'left',cellsalign:'left'},
                                { text: 'Case Number', datafield: 'case_number',editable: false, width: '20%', align:'left',cellsalign:'left'},
                                { text: 'Case Section', datafield: 'case_section',editable: false, width: '10%', align:'left',cellsalign:'left'},
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
            <? if(ADD!=1 && EDIT!=1){?>
            jQuery('#jqxTabs').jqxTabs('disableAt', 0);
            jQuery('#jqxTabs').jqxTabs('select', 1);
            <? } ?>
            //End check box update 
            jQuery("#details").jqxWindow({ theme: theme,  width: '75%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#codeOK,#SendTocheckercancel,#sendnotificationcancel,#authorization_cancel,#confirm_cancel,#reassigncancel,#closeaccount_cancel,#deletecancel,#nextdatecancel") });
            jQuery("#r_history").jqxWindow({ theme: theme,  width: '100%', height:'90%', resizable: false,  isModal: true, autoOpen: false, cancelButton: jQuery("#r_ok") });
            jQuery('#details').on('close', function (event) {
                jQuery('#action_form').jqxValidator('hide');
            });

            jQuery("#suit_file_save_button").click(function () 
            {
                jQuery('#suit_file_form').jqxValidator({
                        rules: rules3, theme: theme
                });
                var validationResult = function (isValid) {
                    if (isValid && expense_validation()==true) {
                        jQuery("#suit_file_save_button").hide();
                        jQuery("#send_loading").show();
                        call_ajax_submit_suit();
                    }
                    else{return;}
                }
                jQuery('#suit_file_form').jqxValidator('validate', validationResult);
            });
            jQuery('#district').bind('change', function (event) {
                get_information_by_district();    
            });
        });
    function verify(id,indx)
    {
        jQuery("#jqxgrid").jqxGrid('clearselection');
        EOL.messageBoard.open('<?=base_url()?>index.php/case_against_bank/verify/'+id, (jQuery(window).width()-80), jQuery(window).height(), 'yes');
        return false;
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
            jQuery("#prest_lawyer_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Lawyer", source: change_lawyer, width: 250, height: 25});
            jQuery("#prest_court_name").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Court", source: court, width: 250, height: 25});
            jQuery("#filling_plaintiff").jqxComboBox({theme: theme,  autoOpen: false,autoDropDownHeight: false, promptText: "Select Plaintiff", source: plaintiff, width: 250, height: 25});
            jQuery('#prest_lawyer_name,#prest_court_name,#filling_plaintiff').focusout(function() {
                commbobox_check(jQuery(this).attr('id'));
            });
        },
        error:   function(model, xhr, options){
            alert('failed');
        },
        });
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
            url: "<?=base_url()?>case_against_bank/r_history",
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
                url: '<?=base_url()?>index.php/case_against_bank/add_edit_action/',
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
                url: '<?=base_url()?>index.php/case_against_bank/delete_action/',
                data : postData,
                datatype: "json",
                success: function(response){
                  ///console.log(response);
                    var json = jQuery.parseJSON(response);
                    jQuery('.txt_csrfname').val(json.csrf_token);
                        
                        if (jQuery("#type").val()=='sendtochecker')
                        {
                            jQuery("#send").show();
                            jQuery("#confirm_cancel").show();
                            jQuery("#confirm_loading").hide();
                        }
                        if ($('type').value=='delete') 
                        {
                            jQuery("#delete_button").show();
                            jQuery("#deletecancel").show();
                            jQuery("#delete_loading").hide();
                        }
                        if (jQuery("#type").val()=='updatenextdate')
                        {
                            jQuery("#updatenextdate").show();
                            jQuery("#nextdatecancel").show();
                            jQuery("#nextdate_loading").hide();
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
    function details(id,operation)
    {
        jQuery('#deleteEventId').val(id);
        jQuery('#type').val(operation);
        if (operation=='details') 
        {
            jQuery("#header_title").html('Case Against Bank Details');
            jQuery('#sendtochecker_row').hide();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').show();
            jQuery('#next_date_row').hide();
        }
        else if (operation=='delete') 
        {
            jQuery('#comments').val('');
            jQuery("#header_title").html('Delete Case Against Bank');
            jQuery('#delete_row').show();
            jQuery('#sendtochecker_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#next_date_row').hide();
        }
        else if(operation=='sendtochecker')
        {
            jQuery("#header_title").html('Send To Checker Case Against Bank');
            jQuery('#sendtochecker_row').show();
            jQuery('#delete_row').hide();
            jQuery('#close_btn_row').hide();
            jQuery('#next_date_row').hide();
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
            url: "<?=base_url()?>case_against_bank/suit_file_details",
            data : {[csrfName]: csrfHash,id: id,operation:operation},
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
    function mask2(str,textbox){
        var item = jQuery("#proposed_type_f").jqxComboBox('getSelectedItem');
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
                    jQuery("#hidden_loan_ac_f").val(str);
                    change_brunch();
                }
                else//For single value enter
                {
                    //For New value
                    var orginal_loan_ac=jQuery("#hidden_loan_ac_f").val();
                    if (orginal_loan_ac.length<str.length) 
                    {
                        var index = str.length-1;
                        var new_val=str.slice(index);
                        orginal_loan_ac+=new_val;
                        //alert(orginal_loan_ac);
                        jQuery("#hidden_loan_ac_f").val(orginal_loan_ac);
                    }
                    //For delete key
                    else{
                        var len=str.length;
                        var new_val=orginal_loan_ac.slice(0,len);
                        jQuery("#hidden_loan_ac_f").val(new_val);
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
                          if (letter_Count<6 || jQuery("#hidden_loan_ac_f").val().length!=16) 
                          {
                            textbox.value = '';
                            jQuery("#hidden_loan_ac_f").val('');
                            alert('Wrong way to input Card No please try again');
                          }
                    }
                }
            }
        }
        change_brunch();
    }
    function change_caption()
    {   
        if (jQuery("#proposed_type").val()=='') 
        {
            document.getElementById("loan_ac").disabled = true;
            jQuery("#l_or_c_no").html('');
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
    function change_caption2()
    {   
        if (jQuery("#proposed_type_f").val()=='') 
        {
            document.getElementById("loan_ac_f").disabled = true;
            jQuery("#l_or_c_no_f").html('');
        }
        else
        {
            document.getElementById("loan_ac_f").disabled = false;
            var item = jQuery("#proposed_type_f").jqxComboBox('getSelectedItem');
            if (item.value=='Loan') {
                jQuery("#l_or_c_no_f").html('Loan A/C ');
            }
            else if(item.value=='Card'){
                jQuery("#l_or_c_no_f").html('Card');
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
        var case_number=jQuery('#case_number').val();
        var ac_name=jQuery('#ac_name_search').val();
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
                url: "<?=base_url()?>index.php/case_against_bank/search_ac/",
                data : {[csrfName]: csrfHash,ac_name:ac_name,proposed_type:proposed_type,req_type:req_type,loan_ac: loan_ac, case_number:case_number,hidden_loan_ac:hidden_loan_ac},
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
    function edit_suit(id,index){
        var val=id;
        jQuery('#next_button').hide();
        jQuery('#next_loading').show();
        var csrfName = jQuery('.txt_csrfname').attr('name');
        var csrfHash = jQuery('.txt_csrfname').val();
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?=base_url()?>case_against_bank/get_filing_info_edit",
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
                    jQuery('#edit_id').val(json.suit_info.id);
                    jQuery('#req_type_f').jqxComboBox('val', json.suit_info.req_type);
                    jQuery('#district').jqxComboBox('val', json.suit_info.district);
                    if (json.suit_info.next_dt_sts==1)
                    {
                        jQuery('#next_dt_sts').jqxCheckBox({ checked:true }); 
                        jQuery("#next_dt_sts_value").val(1); 
                        jQuery('#next_date').val(date_formater(json.suit_info.next_date));
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
                    jQuery('#proposed_type_f').jqxComboBox('val', json.suit_info.proposed_type);
                    
                    if(json.suit_info.loan_ac=='')
                    {
                        jQuery("#loan_ac_f").show(); 
                    }
                    else
                    {
                        jQuery('#load_button').hide();
                        jQuery('#proposed_type_f').jqxComboBox({ disabled: true });
                        jQuery("#loan_ac_f").hide(); 
                        jQuery("#loan_card_show").html(json.suit_info.loan_ac); 
                    }
                    jQuery("#ac_name").val(json.suit_info.ac_name);
                    if(json.suit_info.retail_branch!='' && json.suit_info.retail_branch!=0)
                    {
                        jQuery('#retail_branch').jqxComboBox('val', json.suit_info.retail_branch);
                    }
                    if(json.suit_info.retail_branch!='' && json.suit_info.retail_branch!=0)
                    {
                        jQuery('#retail_branch').jqxComboBox('val', json.suit_info.retail_branch);
                    }
                    if(json.suit_info.branch_sol!='' && json.suit_info.branch_sol!=0)
                    {
                        jQuery('#branch_sol').jqxComboBox('val', json.suit_info.branch_sol);
                    }
                    if(json.suit_info.case_name!='' && json.suit_info.case_name!=0)
                    {
                        jQuery('#case_name').jqxComboBox('val', json.suit_info.case_name);
                    }
                    if(json.suit_info.case_sts_prev_dt!='' && json.suit_info.case_sts_prev_dt!=0)
                    {
                        jQuery('#case_sts').jqxComboBox('val', json.suit_info.case_sts_prev_dt);
                    }
                    if(json.suit_info.filling_plaintiff!='' && json.suit_info.filling_plaintiff!=0)
                    {
                        jQuery('#filling_plaintiff').jqxComboBox('val', json.suit_info.filling_plaintiff);
                    }
                    if(json.suit_info.prest_lawyer_name!='' && json.suit_info.prest_lawyer_name!=0)
                    {
                        jQuery('#prest_lawyer_name').jqxComboBox('val', json.suit_info.prest_lawyer_name);
                    }
                    if(json.suit_info.prest_court_name!='' && json.suit_info.prest_court_name!=0)
                    {
                        jQuery('#prest_court_name').jqxComboBox('val', json.suit_info.prest_court_name);
                    }
                    jQuery("#defendant_name").val(json.suit_info.defendant_name);
                    jQuery("#complaint_name").val(json.suit_info.complaint_name);
                    var str = json.suit_info.case_number.split("/");
                    var case_number = str[0];
                    var year = str[1];

                    jQuery('#case_number_f').val(case_number);
                    jQuery('#case_year').val(year);
                    jQuery('#case_history').val(json.suit_info.case_history);
                    jQuery('#case_section').val(json.suit_info.case_section);
                    jQuery('#remarks').val(json.suit_info.remarks);
                    jQuery('#filling_date').val(date_formater(json.suit_info.filling_date));
                    

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
            url: "<?=base_url()?>case_against_bank/get_filing_info",
            data : {[csrfName]: csrfHash,id:val},
            datatype: "json",
            async:false,
            success: function(response){
               
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                if(json.Message=='ok'){
                    
                    jQuery('#load_button').hide();
                    let date =  new Date().getFullYear();
                    jQuery('#case_year').val(date);
                    jQuery('#add_edit').val('add');
                    jQuery('#next_button').show();
                    jQuery('#next_loading').hide();
                    jQuery('#search_area').hide();
                    jQuery('#suit_form_div').show();
                    var form_html = '';
                    jQuery('#next_dt_sts').jqxCheckBox({ checked:true }); 
                    jQuery("#next_dt_sts_value").val(1); 
                    jQuery("#next_date").val(''); 
                    jQuery("#next_date").show();
                    jQuery("#next_sts_text").html('');
                    jQuery("#next_sts_text").hide();
                    jQuery('#hidden_suit_id').val(json.suit_info.id);
                    jQuery('#proposed_type_f').jqxComboBox('val', json.suit_info.proposed_type);
                    jQuery('#proposed_type_f').jqxComboBox({ disabled: true });
                    jQuery("#loan_ac_f").hide(); 
                    jQuery("#loan_card_show").html(json.suit_info.loan_ac); 
                    jQuery("#ac_name").hide(); 
                    jQuery("#ac_name_show").html(json.suit_info.ac_name); 
                    if(json.suit_info.proposed_type=='Card') //For Card
                    {
                        jQuery("#hidden_org_loan_ac").val(json.suit_info.org_loan_ac); 
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
    function clear_form() {
        jQuery('#add_edit').val('add');
        jQuery('#load_button').show();
        jQuery('#hidden_suit_id').val('');
        jQuery('#defendant_name').val('');
        jQuery('#complaint_name').val('');
        jQuery("#hidden_org_loan_ac").val(''); 
        jQuery('#req_type_f').jqxComboBox({ disabled: false });
        jQuery('#proposed_type_f').jqxComboBox({ disabled: false });
        jQuery("#loan_ac_f").show(); 
        jQuery("#ac_name").show(); 
        jQuery("#loan_card_show").html(''); 
        jQuery("#ac_name_show").html(''); 
        jQuery("#retail_branch").jqxComboBox('clearSelection');
        jQuery("input[name='retail_branch']").val('');
        jQuery("#district").jqxComboBox('clearSelection');
        jQuery("input[name='district']").val('');
        jQuery("#prest_court_name").jqxComboBox('clearSelection');
        jQuery("input[name='prest_court_name']").val('');
        jQuery("#prest_lawyer_name").jqxComboBox('clearSelection');
        jQuery("input[name='prest_lawyer_name']").val('');
        jQuery("#case_name").jqxComboBox('clearSelection');
        jQuery("input[name='case_name']").val('');
        jQuery("#branch_sol").jqxComboBox('clearSelection');
        jQuery("input[name='branch_sol']").val('');
        // jQuery("#proposed_type_f").jqxComboBox('clearSelection');
        // jQuery("#proposed_type_f").val('');
        jQuery("#req_type_f").jqxComboBox('clearSelection');
        jQuery("input[name='req_type_f']").val('');
        jQuery("#filling_plaintiff").jqxComboBox('clearSelection');
        jQuery("input[name='filling_plaintiff']").val('');
        jQuery("#case_sts").jqxComboBox('clearSelection');
        jQuery("input[name='case_sts']").val('');


        jQuery("#remarks").val(''); 
        jQuery("#filling_date").val(''); 
        jQuery("#case_section").val('');
        jQuery("#case_history").val('');
        jQuery("#case_number_f").val('');
        jQuery("#defendant_name").val('BRAC Bank Ltd.');
        jQuery("#loan_ac_f").val('');
        
        jQuery("#next_dt_sts_value").val(1); 
        jQuery("#next_date").val(''); 
        jQuery("#next_date").show(); 
        jQuery("#next_sts_text").html(''); 
        jQuery("#next_sts_text").hide();
    }
    function new_load()
    {
        clear_form();
        jQuery('#next_button').show();
        jQuery('#next_loading').hide();
        jQuery('#search_area').hide();
        jQuery('#suit_form_div').show();
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
        return true;
    }
    function change_brunch()
    {
        var item = jQuery("#proposed_type_f").jqxComboBox('getSelectedItem');
        
        if (item.value=='Loan') 
        {
            if (jQuery("#loan_ac_f").val().length==16) 
            {
                var str =jQuery("#loan_ac_f").val(); 
                var c_no = str.slice(0, 4);
                var cif = str.slice(5, 13);
                jQuery("#branch_sol").jqxComboBox('selectItem',c_no);
                jQuery("#cif").val(cif);
            }
        }
        
    }
    function validate_api_call()
    {
        jQuery('#suit_file_form').jqxValidator('hide');
        var theme = getDemoTheme();
        var  rules= [
            { input: '#proposed_type_f', message: 'required!', action: 'blur,change', rule: function (input) {                    
                if(input.val() != '')
                {
                    var item = jQuery("#proposed_type_f").jqxComboBox('getSelectedItem');
                    if(item != null){jQuery("input[name='proposed_type_f']").val(item.value);}
                    return true;                
                }
                else
                {
                    jQuery("#proposed_type_f input").focus();
                    return false;
                }
            }  
            },
        ];
        var item = jQuery("#proposed_type_f").jqxComboBox('getSelectedItem');
        
        if(item!=null)
        {
            if (item.value=='Loan') 
            {
                rules.push(
                    { input: '#loan_ac_f', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                        if(jQuery("#loan_ac_f").val()=='')
                        {
                            jQuery("#loan_ac_f").focus();
                            return false;
                        }
                        else
                        {
                            return true;
                        }
                        
                    }
                    },
                    { input: '#loan_ac_f', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                     {
                        if(input.val() != '')
                        {
                            if(!checknumber_alphabaticwithstar('loan_ac_f'))
                            {
                                jQuery("#loan_ac_f").focus();
                                return false;

                            }
                        }
                        return true;

                    } },
                    { input: '#loan_ac_f', message: 'must be 16 digits', action: 'keyup, blur, change', rule: function (input, commit)
                     {
                        if(input.val() != '')
                        {
                            if(input.val().length<16 || input.val().length>16)
                            {
                                jQuery("#loan_ac_f").focus();
                                return false;

                            }
                        }
                        return true;

                    } },
                    // { input: '#cif', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                    //     if(jQuery("#cif").val()=='')
                    //     {
                    //         jQuery("#cif").focus();
                    //         return false;
                    //     }
                    //     else
                    //     {
                    //         return true;
                    //     }
                    // }
                    // },
                    // { input: '#cif', message: 'must be 8 characters', action: 'keyup, blur, change', rule: function (input, commit)
                    //  {
                    //     if(input.val() != '')
                    //     {
                    //         if(input.val().length>8 || input.val().length<8)
                    //         {
                    //             jQuery("#cif").focus();
                    //             return false;

                    //         }
                    //     }
                    //     return true;

                    // } }
                );
            }
            else
            {
                rules.push(
                        { input: '#loan_ac_f', message: 'required!', action: 'keyup, blur', rule: function(input,commit){
                            if(jQuery("#loan_ac_f").val()=='')
                            {
                                jQuery("#loan_ac_f").focus();
                                return false;
                            }
                            else
                            {
                                return true;
                            }
                            
                        }
                        },
                        { input: '#loan_ac_f', message: 'only numeric', action: 'keyup, blur, change', rule: function (input, commit)
                         {
                            if(input.val() != '')
                            {
                                if(!checknumber_alphabaticwithstar('loan_ac_f'))
                                {
                                    jQuery("#loan_ac_f").focus();
                                    return false;

                                }
                            }
                            return true;

                        } },
                        { input: '#loan_ac_f', message: 'must be 16 digits', action: 'keyup, blur, change', rule: function (input, commit)
                         {
                            if(input.val() != '')
                            {
                                if(input.val().length<16 || input.val().length>16)
                                {
                                    jQuery("#loan_ac_f").focus();
                                    return false;

                                }
                            }
                            return true;

                        } }
                 );
            }
        }
        jQuery('#suit_file_form').jqxValidator({
                    rules: rules, theme: theme
            });
            var validationResult = function (isValid) {
                if (isValid) {
                    call_api();
                }
            }
            jQuery('#suit_file_form').jqxValidator('validate', validationResult);
    }
    function call_api()
    {   
        var item = jQuery("#proposed_type_f").jqxComboBox('getSelectedItem');
        var type =item.value;
        if (type=='Loan')
        {
            var loan_ac=jQuery('#loan_ac_f').val();
            var cif=jQuery('#cif').val();
        }
        if (type=='Card')
        {
            var loan_ac=jQuery('#hidden_loan_ac_f').val();
            var cif=jQuery('#cif').val();
        }
        var csrfName = jQuery('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = jQuery('.txt_csrfname').val(); // CSRF hash
        jQuery.ajax({
            type: "POST",
            cache: false,
            url: "<?=base_url()?>legal_notice/get_cif",
            data : {
                [csrfName]: csrfHash,
                type:type,
                ac:loan_ac,
                cif:cif
            },
            datatype: "json",
            beforeSend: function(){
                jQuery("#loading-overlay").show();
            },
            success: function(response){
                var json = jQuery.parseJSON(response);
                jQuery('.txt_csrfname').val(json.csrf_token);
                    var item = jQuery("#proposed_type_f").jqxComboBox('getSelectedItem');
                    var type =item.value;
                    if (type=='Card')
                    {
                        if(json.Message=='ok')
                        {
                            jQuery("#hidden_loan_ac_f").val(loan_ac);
                            jQuery("#cif").val(json.results['CIF_NO']);
                            jQuery("#ac_name").val(name_filter(json.results['CARDHOLDER_NAME']));
                            jQuery('#branch_sol').jqxComboBox('val',json.results['ISSUING_BRANCH_ID'].replace(/\s\s+/g, ' '));
                            jQuery("#loading-overlay").hide();
                        }
                        else {
                            jQuery("#hidden_loan_ac_f").val('');
                            jQuery("#loan_ac_f").val('');
                            jQuery("#loading-overlay").hide();
                            alert("No Data Please try again..")
                        }
                        
                    }
                    else
                    {
                        if (json.Message=='ok')
                        {
                            if (json.loan_segment)
                            {
                                var loan_segment=obj_cleaner_for_api_data(json.loan_segment);
                                
                            }else{var loan_segment='';}
                            
                            if (json.business_type)
                            {
                                var business_type=obj_cleaner_for_api_data(json.business_type);
                                
                            }else{var business_type='';}
                            
                            if (loan_segment!='R')
                            {
                                if (business_type!='' && business_type=='PROP')
                                {
                                    jQuery("#sub_type").val(1);//compant
                                }
                                else if(business_type!='')
                                {
                                    jQuery("#sub_type").val(2);//propotorship
                                }
                            }
                            if (json.ac_name)
                            {
                                var ac_name=obj_cleaner_for_api_data(json.ac_name);
                                
                            }else{var ac_name='';}
                            jQuery("#ac_name").val(ac_name);
                            jQuery("#loading-overlay").hide();
                        }
                        else
                        {
                            jQuery("#loading-overlay").hide();
                            alert("No Data Please try again..")
                        }
                    }
            }
        });
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
    function search_data(){
        jQuery("#grid_search").hide();
        jQuery("#grid_loading").show();
        jQuery("#jqxgrid").jqxGrid('updatebounddata');
        jQuery("#grid_search").show();
        jQuery("#grid_loading").hide();
        return;

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
                                               <div style="padding: 0px;width:100%;height:85px; border:1px solid #c0c0c0;font-family: Calibri;font-size: 14px">
                                                    <table id="deal_body" style="display:block;width:100%">
                                                        <tr>
                                                            <td style="text-align:center;width:10%"><strong>Type Of Case&nbsp;&nbsp;</strong> </td>
                                                            <td style="width:10%"><div style="padding-left:1.8%" id="req_type" name="req_type"></div></td>
                                                            <td style="text-align:center;width:10%"><strong>Propsed Type&nbsp;&nbsp;</strong> </td>
                                                            <td style="width:10%"><div style="padding-left:1.8%" id="proposed_type" name="proposed_type"></div></td>
                                                            <td style="text-align:right;width:9%"><strong><span id="l_or_c_no"></span> No.</strong></td>
                                                            <td style="width:15%"><input name="loan_ac" tabindex="" type="text" class="" maxlength="16" size="16" style="width:150px" id="loan_ac" value="" onKeyUp="javascript:return mask(this.value,this);"/></td>
                                                            <td style="text-align:right;width:9%"><strong>Case No.</strong></td>
                                                            <td style="width:7%"><input name="case_number" tabindex="" type="text" class="" style="width:100px" id="case_number" value=""/></td>
                                                            <td  style="text-align:left;width:20%">
                                                                <input type='button' class="buttonStyle" id='grid_search' name='grid_search' value='Search' onclick="searchsuit()" style="background-color:#fff;float: left;color:#000;border-radius: 20px !important;height:30px;width:70px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;" />
                                                                <input type='button' class="buttonStyle" id='new' name='new' value='New' onclick="new_load()" style="background-color:#fff;color:#000;float: left;border-radius: 20px !important;height:30px;width:70px;font-family: sans-serif;font-size: 16px;border: 1px solid #29cdff;margin-left:5px" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:center;width:10%"><strong>AC Name&nbsp;&nbsp;</strong> </td>
                                                            <td style="width:10%"><input name="ac_name_search" tabindex="" type="text" class="" style="width:150px" id="ac_name_search" value=""/></td>
                                                            <td style="text-align:center;width:10%"></td>
                                                            <td style="width:10%"></td>
                                                            <td style="text-align:right;width:9%"></td>
                                                            <td style="width:15%"></td>
                                                            <td style="text-align:right;width:9%"></td>
                                                            <td style="width:7%"></td>
                                                            <td  style="text-align:left;width:20%">
                                                                
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
                                                <form method="POST" name="suit_file_form" id="suit_file_form"  style="margin:0px;">
                                                    <input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                    <input type="hidden" id="hidden_suit_id" value="" name="hidden_suit_id" value="">
                                                    <input type="hidden" id="hidden_loan_ac_f" value="" name="hidden_loan_ac_f">
                                                    <input type="hidden" id="hidden_org_loan_ac" value="" name="hidden_org_loan_ac">
                                                    <input type="hidden" id="edit_id" value="" name="edit_id" value="">
                                                    <input type="hidden" id="add_edit" value="" name="add_edit" value="">
                                                    <input type="hidden" id="cif" name="cif" value="">
                                                    <input type="hidden" id="next_dt_sts_value" value="" name="next_dt_sts_value" value="1">
                                                    <table style="width:100%;margin-top:20px" id="tab1Table" >
                                                        <tbody>
                                                            <tr>
                                                                <td width="50%">
                                                                    <table style="width: 100%;">
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Case Type<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="req_type_f" name="req_type_f" style="padding-left: 3px" tabindex="1"></div></td>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Proposed Type</td>
                                                                            <td width="60%" ><div id="proposed_type_f" name="proposed_type_f" style="padding-left: 3px" tabindex="2"></div></td>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;"><strong><span id="l_or_c_no_f"></span> No.</strong></td>
                                                                            <td width="60%" >
                                                                                <input name="loan_ac_f" tabindex="3" type="text" class="" maxlength="16" size="16" style="width:195px" id="loan_ac_f" value="" onKeyUp="javascript:return mask2(this.value,this);"/>
                                                                                <input type="button" value="Load" id="load_button" class="" style="width:50px !important;height:25px" onclick="validate_api_call()" />
                                                                                <strong><span id="loan_card_show"></span></strong>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;"><strong>AC Name</td>
                                                                            <td width="60%" >
                                                                                <input name="ac_name" tabindex="4" type="text" class="" style="width:250px" id="ac_name" value=""/>
                                                                                <strong><span id="ac_name_show"></span></strong>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">complaint name:<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><input name="complaint_name" type="text" class="" tabindex="5" style="width:250px" id="complaint_name" value="" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Name Of Defendant/Accused:<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><input name="defendant_name" type="text" class="" tabindex="5" style="width:250px" id="defendant_name" value="" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Branch (SOL)</td>
                                                                            <td width="60%" ><div id="branch_sol" name="branch_sol" style="padding-left: 3px" tabindex="6"></div></td>
                                                                        </tr>
                                                                         <tr>
                                                                            <td width="40%" style="font-weight: bold;">District<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="district" tabindex="14" name="district" style="padding-left: 3px"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Case Number<span style="color:red">*</span> </td>
                                                                            <td width="60%" >
                                                                                <input name="case_number_f" type="text" tabindex="8" class="" style="width:145px;float:left" id="case_number_f" placeholder="case number" value="" /><input  readonly type="text" tabindex="" class="" style="width:5px;float:left" value="/" /><input name="case_year" placeholder="year" type="text" tabindex="9" onkeypress="return numbersonly(event)" maxlength="4" class="" style="width:89px;float:left" id="case_year" value="" /></td>
                                                                        </tr>   
                                                                         <tr>
                                                                            <td width="40%" style="font-weight: bold;">Background /Case history:</td>
                                                                            <td width="60%" ><textarea tabindex="13" name="case_history" class="text-input-big" id="case_history" style="height:40px !important;width:250px"></textarea></td>
                                                                        </tr>    
                                                                                             
                                                                    </table>
                                                                </td>

                                                                <td width="50%">
                                                                    <table style="width: 100%;">
                                                                       <tr>
                                                                            <td width="40%" style="font-weight: bold;">Case Name</td>
                                                                            <td width="60%" ><div id="case_name" tabindex="14" name="case_name" style="padding-left: 3px"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Case Section</td>
                                                                            <td width="60%" ><input name="case_section" tabindex="15" type="text" class="" style="width:250px" id="case_section" value="" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Current Case Status<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="case_sts" tabindex="16" name="case_sts" style="padding-left: 3px"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Case Dealing Officer<span style="color:red">*</span></td>
                                                                            <td width="60%" ><div id="filling_plaintiff" tabindex="17" name="filling_plaintiff" style="padding-left: 3px"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Filling Date<span style="color:red">*</span></td>
                                                                            <td width="60%" ><input type="text" name="filling_date" tabindex="18" placeholder="dd/mm/yyyy" style="width:250px;" id="filling_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("filling_date");</script></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Next Date<span style="color:red">*</span></td>
                                                                            <td width="60%" >
                                                                                <input type="text" name="next_date" tabindex="19" placeholder="dd/mm/yyyy" style="width:225px;" id="next_date" value="" ><script type="text/javascript" charset="utf-8">datePicker ("next_date");</script>
                                                                                <span id="next_sts_text" style="display:none;margin-left:10px"></span>
                                                                                <div name="next_dt_sts" tabindex="20" id="next_dt_sts" style="float:left; margin: 3px 0px 0 0;"></div>
                                                                            </td>
                                                                        </tr>  
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Conducting Lawyer name</td>
                                                                            <td width="60%" ><div id="prest_lawyer_name" tabindex="22" name="prest_lawyer_name" style="padding-left: 3px"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Present Name Of The Court<span style="color:red">*</span> </td>
                                                                            <td width="60%" ><div id="prest_court_name" name="prest_court_name" style="padding-left: 3px" tabindex="23"></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Retail Branch (If any)</td>
                                                                            <td width="60%" ><div id="retail_branch" tabindex="24" name="retail_branch" style="padding-left: 3px"></div></td>
                                                                        </tr>   
                                                                        <tr>
                                                                            <td width="40%" style="font-weight: bold;">Remarks</td>
                                                                            <td width="60%" ><textarea tabindex="25" name="remarks" class="text-input-big" id="remarks" style="height:40px !important;width:250px"></textarea></td>
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
                                        <strong>D = </strong>Delete,&nbsp;
                                        <strong>V = </strong> Verify,&nbsp;
                                        <strong>P = </strong> Preview,&nbsp;
                                        <strong>E = </strong>Edit Suit File,&nbsp;
                                        <strong>STC = </strong>Send To Checker&nbsp;
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
                <div id="sendtochecker_row" style="text-align:center;margin-bottom: 20px;font-family:calibri;font-size:15px;line-height:170%">
                    <div style="margin-bottom: 20px;margin-top:20px;font-family:calibri;font-size:15px;line-height:170%">
                        <input type="button" class="buttonsendtochecker" id="send" value="Send" />
                        <input type="button" class="buttonclose" id="confirm_cancel" onclick="close()" value="Cancel" />
                        <span id="confirm_loading" style="display:none">Please wait... <img src="<?=base_url()?>images/loader.gif" align="bottom"></span>
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